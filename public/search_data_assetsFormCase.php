<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
$HIDE_HEADER = "P";
include('../include/include.php');

include('../include/paging.php');

if (isset($_GET['CODE'])) { //ตรวจสอบว่ามีตัวแปร CODE ที่ถูกส่งมาผ่านค่า GET (query parameter) หรือไม่ 
	$decodedCode = base64_decode($_GET['CODE']);
	$decodedCode = str_replace('&', '##', $decodedCode);
	$segments = explode("##", trim($decodedCode, "##"));
	$data = [];
	foreach ($segments as $segment) {
		list($key, $value) = explode("=", $segment, 2);
		$data[$key] = $value;
		$_GET[$key] = $value;
	}
}



$arr_system = array("BANKRUPT" => "คดีล้มละลาย", "CIVIL" => "คดีแพ่ง");




?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include '../include/template_user.php'; ?>
</head>



<body id="bsf_body" class="">
	<div class="wrapper">
		<?php
		//  include '../include/combottom_js_user.php'; //function 
		include '../include/func_Nop.php';
		include "./btn_function.php";

		CONVERT_GET((func::get_E_and_D("search_data_assetsFormCase", "D", $_GET)));
		if ($_POST) {
			foreach ($_POST as $key => $value) {
				${$key} = $value;
			}
		}

		if ($_GET) {
			foreach ($_GET as $key => $value) {
				${$key} = $value;
			}
		}
		//print_pre($_GET);
		?>
		<style>
			.content-wrapper {
				margin-top: -20px;
				/* ปรับระยะห่างด้านบนของ content-wrapper ให้มีค่า 20px */
			}

			.show_hide_area:after {
				font-family: 'IcoFont' !important;
				content: "\eb25";
			}

			.show_hide_area.is-active:after {
				font-family: 'IcoFont' !important;
				content: "\eb28";
			}
		</style>

		<div class="content m-t-20">
			<!-- Container-fluid starts -->
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<!-- Row start -->
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<!-- Radio-Button start -->

									<?php
									/* PCC_CIVIL_GEN Start */
									$array_Pcc = [];
									if ($SEND_TO == '1') { //ระบบเเพ่ง
										//เเพ่งกับเเพ่ง
										$AssetCivil = new Asset_();
										$AssetCivil->CIVIL_CODE = $PCC_CIVIL_GEN;

										//คดีต้นทางของเเพ่ง นำเก็บในตัวแปรให้ searchDataCivilToCivil
										$Array_Data_Civil = ($AssetCivil->DataAssetCivil());

										//แพ่งไปแพ่ง
										$Array_CivilToCivil = ($AssetCivil->searchDataCivilToCivil());

										//เเพ่งไปล้ม (ยังไม่เสร็จดี)
										$Array_CivilToBankrupt = ($AssetCivil->searchDataCivilToBankrupt());
									}

									if ($SEND_TO == '2') { //ล้มละลาย
										$AssetBankrupt = new Asset_();
										//$AssetCivil->BANKRUPT_CODE = '27565';
										$AssetBankrupt->BANKRUPT_CODE = $_GET['brcID'];

										//คดีต้นทางของล้มละลาย นำเก็บในตัวแปรให้ searchDataCivilToBankrupt
										$Array_Data_ฺBankrupt = ($AssetBankrupt->DataAssetBankrupt());
										//print_pre($Array_Data_ฺBankrupt);

										//ล้มไปล้ม
										$AssetBankrupt->searchDataBankruptToBankrupt();
										
									}
									//ข้อมูลหลักที่ส่งมาตรวจ
									$ArrayMain = [];
									$ArrayMain = [
										"CIVIL" => $Array_Data_Civil,
										"BANKRUPT" => $Array_Data_ฺBankrupt
									];
									//print_pre($ArrayMain);
									//ข้อมูลที่ตรวจพบเจอ
									$ArrayDetectedInformation = [];
									$ArrayDetectedInformation = [
										"CIVIL" => [
											"CIVIL_TO_CIVIL" => $Array_CivilToCivil,
											"CIVIL_TO_BANKRUPT" => $Array_CivilToBankrupt,
										],
										"BANKRUPT" => [
											"BANKRUPT_TO_BANKRUPT" => $Array_BankruptToBankrupt,
											"BANKRUPT_TO_CIVIL" => $Array_BankruptToCivil,
										]
									];
									//print_pre($ArrayDetectedInformation);

									//print_pre($ArrayMain);
									?>
									<div class="card-block">
										<div class="col-lg-12">
											<div class="col-lg-12">
												<h4>ข้อมูลทรัพย์ต้นทาง</h4>
											</div>
											<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
												<thead class="bg-primary">
													<th class="text-center">ลำดับ</th>
													<th class="text-center">รายการทรัพย์สิน</th>
													<th class="text-center">สถานะ</th>
													<th class="text-center">เลขคดีดำ/ปี</th>
													<th class="text-center">เลขคดีแดง/ปี</th>
												</thead>
												<?php
												$i = 0;
												foreach ($ArrayMain as $AA1 => $BB1) {
													foreach ($BB1 as $AA2 => $BB2) {
														foreach ($BB2 as $AA3 => $BB3) {
															$i++;
															if ($AA1 == 'CIVIL') {
																$WH_ID =	$BB3['WH_CIVIL_ID'];
															} else if ($AA1 == 'BANKRUPT') {
																$WH_ID =	$BB3['WH_BANKRUPT_ID'];
															}
												?>
															<tr>
																<td align='center'><?php echo $i; ?></td>
																<td>
																	<div style="width:100%;"><a onclick="show_asset_detail(<?php echo $BB3['ASSET_ID']; ?>)" href="javascript:void();"><?php echo $BB3["PROP_TITLE"]; ?></a></div>
																</td>
																<td align='center'><?php echo !empty($BB3['PROP_STATUS_NAME']) ? $BB3['PROP_STATUS_NAME'] : "-"; ?></td>
																<?php
																$A = ($BB3['BLACK_CASE'] != '' && $BB3['BLACK_CASE'] != '') ? "/" : "";
																$B = ($BB3['RED_CASE'] != '' && $BB3['RED_CASE'] != '') ? "/" : "";
																?>
																<td><a onclick="show_detial_2(
									'<?php echo $AA1 ?>',
									'<?php echo ($IDCARD) ?>',
									'<?php echo WH_ID_CONVERT_TO_CODE_API($WH_ID, $AA1); ?>'
									);" href=""> <?php echo $BB3['PREFIX_BLACK_CASE'] . $BB3['BLACK_CASE'] . $A . $BB3['BLACK_YY']; ?></a></td>
																<td><a onclick="show_detial_2(
									'<?php echo $AA1 ?>',
									'<?php echo ($IDCARD) ?>',
									'<?php echo WH_ID_CONVERT_TO_CODE_API($WH_ID, $AA1); ?>'
									);" href=""> <?php echo $BB3['PREFIX_RED_CASE'] . $BB3['RED_CASE'] . $A . $BB3['RED_YY']; ?></a></td>
															</tr>
												<?php
														}
													}
												}
												?>
											</table>
										</div>
									</div>

									<div class="card-block">
										<form method="GET" action="./search_data_assets.php" enctype="multipart/form-data" id="frm-input">
											<input type="hidden" name="PCC_CIVIL_GEN" id="PCC_CIVIL_GEN" value="<?php echo $PCC_CIVIL_GEN; ?>">
											<input type="hidden" name="TO_PERSON_ID" id="TO_PERSON_ID" value="<?php echo $TO_PERSON_ID; ?>">
											<input type="hidden" name="SEND_TO" id="SEND_TO" value="<?php echo $SEND_TO; ?>">

										</form>
										<br>
										<!-- Row start -->
										<div class="row">
											<div class="col-lg-12">
												<!-- start new -->
												<?php
												$arr_system = array(
													"CIVIL" => "คดีแพ่ง",
													"BANKRUPT" => "คดีล้มละลาย",
												);
												foreach ($arr_system as $sys => $sys_name) {
													$n = 0;
													foreach ($ArrayDetectedInformation[$sys] as $AA1 => $BB1) {
														foreach ($BB1 as $AA2 => $BB2) {
															foreach ($BB2 as $AA3 => $BB3) {
																$n += count($BB3);
															}
														}
													}
													$array_total[$sys] = empty($n) ? 0 : $n;
												}
												tab::TabUiSub($arr_system, $array_total);

												?>
												<!-- start -->
												<!-- Tab panes -->
												<div class="tab-content">
													<?php
													$k = 0;
													foreach ($arr_system as $sys => $sys_name) {

														$k++;
													?>
														<div class="tab-pane <?php echo ($k == 1) ? 'active' : ''; ?>" id="<?php echo $sys; ?>">
															<!-- Content of <?php echo $sys_name; ?> tab -->
															<label for="<?php echo $sys; ?>" style="color: #A8164E; font-weight: bold;">
																<h6><?php echo $sys_name; ?></h6>
															</label>
															<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
																<thead class="bg-primary">
																	<th class="text-center">ลำดับ</th>
																	<!-- <th class="text-center">หมายเลขทะเบียน</th> -->
																	<th class="text-center">รายการทรัพย์สิน</th>
																	<th class="text-center">สถานะ</th>
																	<th class="text-center">เลขคดีดำ/ปี</th>
																	<th class="text-center">เลขคดีแดง/ปี</th>
																	<th class="text-center"></th>
																</thead>

																<?php
																$i = 0;
																if ($array_total[$sys] > 0) {

																	foreach ($ArrayDetectedInformation[$sys] as $AA1 => $BB1) {
																		foreach ($BB1 as $AA2 => $BB2) {
																			foreach ($BB2 as $AA3 => $BB3) {
																				foreach ($BB3 as $AA4 => $BB4) {
																					$i++;
																					if ($sys == 'CIVIL') {
																						$WH_ID =	$BB4['WH_CIVIL_ID'];
																					} else if ($sys == 'BANKRUPT') {
																						$WH_ID =	$BB4['WH_BANKRUPT_ID'];
																					}


																?>
																					<tr>
																						<td align='center'><?php echo $i; ?></td>
																						<td>
																							<div style="width:100%;"><a onclick="show_asset_detail(<?php echo $BB4['ASSET_ID']; ?>)" href="javascript:void();"><?php echo $BB4["PROP_TITLE"]; ?></a></div>
																						</td>
																						<td align='center'><?php echo !empty($BB4['PROP_STATUS_NAME']) ? $BB4['PROP_STATUS_NAME'] : "-"; ?></td>
																						<?php
																						$A = ($BB4['BLACK_CASE'] != '' && $BB4['BLACK_CASE'] != '') ? "/" : "";
																						$B = ($BB4['RED_CASE'] != '' && $BB4['RED_CASE'] != '') ? "/" : "";
																						?>
																						<td><a onclick="show_detial_2(
												'<?php echo $sys ?>',
												'<?php echo ($IDCARD) ?>',
												'<?php echo WH_ID_CONVERT_TO_CODE_API($WH_ID, $sys); ?>'
												);" href=""> <?php echo $BB4['PREFIX_BLACK_CASE'] . $BB4['BLACK_CASE'] . $A . $BB4['BLACK_YY']; ?></a></td>
																						<td><a onclick="show_detial_2(
												'<?php echo $sys ?>',
												'<?php echo ($IDCARD) ?>',
												'<?php echo WH_ID_CONVERT_TO_CODE_API($WH_ID, $sys); ?>'
												);" href=""> <?php echo $BB4['PREFIX_RED_CASE'] . $BB4['RED_CASE'] . $A . $BB4['RED_YY']; ?></a></td>

																						<td>
																							<button type="button" data-toggle="tooltip" data-placement="top" title="ดูรายละเอียด" onclick="show_detial_2(
									'<?php echo $sys ?>',
									'<?php echo ($IDCARD) ?>',
									'<?php echo WH_ID_CONVERT_TO_CODE_API($WH_ID, $sys); ?>'
									);" class="btn btn-info btn-mini"> <i class="icofont icofont-search"></i></button>
																							<button type="button" class="btn btn-success btn-mini" data-toggle="tooltip" data-placement="top" title="สอบถามความประสงค์" onclick="action_from('<?php echo convertSystem($sys); ?>','<?php echo $BB4['PREFIX_BLACK_CASE']; ?>',  
								   '<?php echo $BB4['BLACK_CASE']; ?>','<?php echo $BB4['BLACK_YY']; ?>','<?php echo $BB4['PREFIX_RED_CASE']; ?>',
								   '<?php echo $BB4['RED_CASE']; ?>','<?php echo $BB4['RED_YY']; ?>','<?php echo $BB4['COURT_CODE']; ?>'
								   );"><i class="icofont icofont-ui-call"></i></button>
																						</td>
																					</tr>
																<?php
																				}
																			}
																		}
																	}
																} else {
																	tab::NotInformation(6);
																}

																?>
															</table>
														</div>
													<?php
													}
													?>
												</div>
												<?php
												tab::TabScript();
												?>
												<!-- stop -->
												<!-- stop  new -->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>





	<!-- Modal Upload File -->
	<div class="modal fade modal-flex " id="payrollBizModal" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close biz-close-modal" data-number="payrollBizModal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body" id="modal_content">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger biz-close-modal" data-number="payrollBizModal">ปิด</button>
				</div>
			</div>
		</div>
	</div>
	<!-- //. Modal Upload File  -->
	<script>
		function show_detial(PREFIX_BLACK_CASE, BLACK_CASE, BLACK_YY, PREFIX_RED_CASE, RED_CASE, RED_YY, COURT_CODE, SYSTEM_ID, REGISTER_CODE, SYSTEM_TYPE) {
			//let brcId_CivilToWh_fast = $('#brcId_CivilToWh_fast').val();
			var url = "./search_data_show_detial.php?PREFIX_BLACK_CASE=" + PREFIX_BLACK_CASE + "&BLACK_CASE=" + BLACK_CASE + "&BLACK_YY=" + BLACK_YY +
				"&PREFIX_RED_CASE=" + PREFIX_RED_CASE + "&RED_CASE=" + RED_CASE + "&RED_YY=" + RED_YY +
				"&COURT_CODE=" + COURT_CODE + "&SYSTEM_ID=" + SYSTEM_ID + "&REGISTER_CODE=" + REGISTER_CODE + "&SYSTEM_TYPE=" + SYSTEM_TYPE;
			window.open(url, 'Image', 'width=1000px.stylewidth,height=1000px.style.height,resizable=1');
		}


		function input_Number(input) {
			// ลบตัวอักษรที่ไม่ใช่ตัวเลขทั้งหมด
			input.value = input.value.replace(/[^,0-9]/g, '');

			// คั้นระหว่างตัวเลขทุก 13 ตัวด้วยเครื่องหมาย "-"
			const valueLength = input.value.length;
			if (valueLength > 13) {
				const formattedValue = input.value.replace(/(\d{13})(?=\d)/g, '$1,');
				input.value = formattedValue;
			}
		}

		function btn_clear() {
			history.replaceState({}, document.title, window.location.pathname);
			window.location = 'http://103.208.27.224:81/led_service_api/public/search_data_asset.php'

		}

		function searchData() {
			let registerCode = $('#REGISTERCODE').val();

			let T_BLACK_CASE = $('#T_BLACK_CASE').val();
			let TABLE_DETAIL = $('#TABLE_DETAIL').val();
			let BLACK_YY = $('#BLACK_YY').val();
			let T_RED_CASE = $('#T_RED_CASE').val();
			let RED_CASE = $('#RED_CASE').val();
			let RED_YY = $('#RED_YY').val();

			let COURT_NAME = $('#COURT_NAME').val();
			let PRE_CODE = $('#PRE_CODE').val();
			let case_c = $('#case').val();
			/* console.log(registerCode)
			console.log(T_BLACK_CASE)
			console.log(BLACK_CASE)
			console.log(BLACK_YY)
			console.log(T_RED_CASE)
			console.log(RED_CASE)
			console.log(RED_YY) */

			if (registerCode != '' || (T_BLACK_CASE != '' && TABLE_DETAIL != '' && BLACK_YY != '') || (T_RED_CASE != '' && RED_CASE != '' && RED_YY != '')) {
				if ((T_BLACK_CASE != '' && TABLE_DETAIL != '' && BLACK_YY != '') || (T_RED_CASE != '' && RED_CASE != '' && RED_YY != '')) {
					if (COURT_NAME == '') {
						alert('กรุณาเลือกศาล')
						$('#COURT_NAME').focus()
						return false
					}
				}
				location.reload()
				$("#page").val(1);
				$("#page_size").val(20);
				$("#frm-input")
					.attr("target", "")
					.attr("action", "")
					.submit();
			} else {
				alert('กรุณากรอกเลขบัตรประชาชน หรือ เลขคดีดำ คดีแดง')
				$('#registerCode').focus()
				return false
			}
		}

		function action_from(sh1, prefixBlackCase, blackCase, blackYy, prefixRedCase, redCase, redYy, CourtCode) {

			let SEND_TO = '<?php echo $_GET['SEND_TO']; ?>'
			let PCC_CIVIL_GEN = '<?php echo $_GET['PCC_CIVIL_GEN']; ?>'
			let brcID = '<?php echo $_GET['brcID']; ?>'
			let url = "./cmd_add_from.php?";
			if (SEND_TO == '1') { //เเพ่ง
				url += "&SEND_FROM=" + 'CIVIL'; //ส่งเพื่อเข้าif
				url += "&PCC_CIVIL_GEN=" + PCC_CIVIL_GEN;
			}
			if (SEND_TO == '2') { //ล้มละลาย
				url += "&SEND_FROM=" + 'BANKRUPT'; //ส่งเพื่อเข้าif
				url += "&brcID=" + brcID;
			}

			url += "&receive_case=" + sh1;

			url += "&receive_prefixBlackCase=" + prefixBlackCase;
			url += "&receive_blackCase=" + blackCase;
			url += "&receive_blackYy=" + blackYy;

			url += "&receive_prefixRedCase=" + prefixRedCase;
			url += "&receive_redCase=" + redCase;
			url += "&receive_redYy=" + redYy;

			url += "&receive_CourtCode=" + CourtCode;
			url += "&TO_PERSON_ID=" + '<?php echo $_GET['TO_PERSON_ID']; ?>'
			url += "&proc=" + 'search_data_add';
			// window.location.href = url;
			window.open(url, 'Image', 'width=1000px.stylewidth,height=1000px.style.height,resizable=1');
			//$('#frm-input').attr('action', './cmd_add_from.php').submit();
		}
	</script>
	<?php
	include '../include/combottom_js_user.php';
	include '../include/combottom_user.php'; ?>