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
									function LikeArray($A = "", $fill_NAME = "")
									{
										//ตัดข้อมูลเอาเเต่ข้อมูลตัวเลข
										$detail = $A;
										$str_array = "";
										$pattern = '/\d+/';
										if (preg_match_all($pattern, $detail, $matches)) {
											$numbers = $matches[0]; // 13, 55, 55, 22
											foreach ($numbers as $number) {
												$str_array .= " AND " . $fill_NAME . "  like '%" . $number . "%' ";
											}
										}
										return $str_array;
									}





									$array_Pcc = [];
									if ($SEND_TO == '1') { //ระบบเเพ่ง
										$sqlSelectData = "	SELECT a.PREFIX_BLACK_CASE ,a.BLACK_CASE ,a.BLACK_YY ,
																	a.PREFIX_RED_CASE ,a.RED_CASE ,a.RED_YY,
																	b.WH_ASSET_ID ,b.ASSET_ID ,b.PROP_TITLE 
										FROM WH_CIVIL_CASE a
										JOIN WH_CIVIL_CASE_ASSETS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
										WHERE  a.CIVIL_CODE = '" . $PCC_CIVIL_GEN . "'";
										$AssetCivil = new Asset_civil();
										$AssetCivil->CIVIL_CODE = $PCC_CIVIL_GEN;
										//print_pre($AssetCivil->DataAssetCivil());
										print_pre($AssetCivil->searchDataCivil());
									}

									if ($SEND_TO == '2') { //ล้มละลาย
										$sqlSelectData = "	SELECT 	a.PREFIX_BLACK_CASE ,a.BLACK_CASE ,a.BLACK_YY ,
																	a.PREFIX_RED_CASE ,a.RED_CASE ,a.RED_YY ,
																	b.WH_ASSET_ID ,b.ASSET_ID ,b.PROP_TITLE 
										FROM WH_BANKRUPT_CASE_DETAIL a
										JOIN  WH_BANKRUPT_ASSETS b ON a.WH_BANKRUPT_ID =b.WH_BANKRUPT_ID 
									    WHERE a.BANKRUPT_CODE ='" . $_GET['brcID'] . "'";
									}
									$query_PCC = db::query($sqlSelectData);
									while ($rec_pcc = db::fetch_array($query_PCC)) {
										$array_Pcc[] = $rec_pcc;
									}
									//print_r_pre($array_Pcc); //ข้อมูลในคดี
									/* PCC_CIVIL_GEN Stop */
									$k = 0;
									$array_sql = [];
									$work = 2;
									foreach ($arr_system as $sys => $sys_name) {
										$k++;
										$num_Pcc_Arr = 0;
										foreach ($array_Pcc as $Apcc => $Bpcc) {
											$sqlSelectDataALL_e = "";
											echo $Bpcc['PROP_TITLE'] . "<br>";
											$num_Pcc_Arr++;
											if (LikeArray($Bpcc['PROP_TITLE'], 'TABLE_DETAIL') != "") {
												switch ($work) {
													case '1':
														break;
													case '2':

														if ($PCC_CIVIL_GEN != "" && $sys == 'CIVIL') {
															$NOT_CODE_API_GEN = "AND a.CODE_API !='" . $PCC_CIVIL_GEN . "'";
														}
														if ($brcID != "" && $sys == 'BANKRUPT') {
															$NOT_CODE_API_GEN = "AND a.CODE_API !='" . $brcID . "'";
														}
														$sqlSelectDataALL_e = "SELECT  a.WH_ASSET_ID ,
													a.ASSET_ID as ASSET_CODE,
													a.TABLE_DETAIL as PROP_TITLE,
													a.PREFIX_BLACK_CASE ,
													a.BLACK_CASE ,
													a.BLACK_YY ,
													a.PREFIX_RED_CASE 
													,a.RED_CASE ,
													a.RED_YY ,
													a.TYPE_ASSET ,
													a.COURT_CODE,
													a.PROP_STATUS_NAME,
													a.CODE_API,
													a.WH_ID,
													a.SYSTEM_TYPE  FROM WH_ALL_ASSETS_MAIN a
													WHERE 1=1 
													AND a.TYPE_ASSET ='" . $sys . "' 
													AND (a.PROP_STATUS_NAME IS NOT NULL OR a.PROP_STATUS_NAME !='')
													{$NOT_CODE_API_GEN}
													" .
															LikeArray($Bpcc['PROP_TITLE'], 'a.TABLE_DETAIL') .
															func::conWhere($Bpcc['PROP_TITLE']) . "";
														//echo $sqlSelectDataALL_e ;
														break;
												}
											}

											//echo $sqlSelectDataALL_e . "<br><br>";
											//print_r_pre($Bpcc);



											//echo $sqlSelectDataALL_e."<br><br>"; //เเสดง sql
											$array_sql[$sys][$num_Pcc_Arr] = $sqlSelectDataALL_e;
											$query_SelectDataALL_e = db::query($array_sql[$sys][$num_Pcc_Arr]);
											$array_num = 0;

											//การทำงานคำ เก็บไว้ในระบบอะไร sys เเละ ตำเเหน่งของ sql เเละ array_num(วนค่าเมื่อเจอข้อมูลซ้ำกัน)
											while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e)) {
												$array_data_Assets[$sys][$num_Pcc_Arr][$array_num] = $recSelectDataAll;
												$array_num++;
											}
										}
									}
									//print_r_pre($array_data_Assets);//ข้อมูลที่เจอ
									$array_data3 = [];
									foreach ($array_data_Assets as $AA1 => $BB1) {
										foreach ($BB1 as $AA2 => $BB2) {
											foreach ($BB2 as $AA3 => $BB3) {
												if ($BB3['WH_ASSET_ID'] == ${$BB3['WH_ASSET_ID']}) { //ถ้าWH_ASSET_ID ซ้ำให้ข้าม
												} else {
													${$BB3['WH_ASSET_ID']} = $BB3['WH_ASSET_ID'];
													$array_data3[$AA1][] = $BB3;
												}
											}
										}
									}
									//	print_r_pre($array_sql);
									//print_r_pre($array_data3);

									/* create SQL เเละ ARRAY Start */


									?>

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
												<!-- Nav tabs -->
												<ul class="nav nav-tabs  tabs" role="tablist">
													<?php
													$k = 0;
													foreach ($arr_system as $sys => $sys_name) {
														$k++;
													?>
														<li class="nav-item">
															<a class="nav-link <?php if ($k == 1) {
																					echo "active";
																				} ?>" data-toggle="tab" href="#<?php echo $sys; ?>" role="tab"><?php echo $sys_name; ?> <?php echo  count($array_data3[$sys]) == 0 ? "" : '<label class="badge bg-danger">' . count($array_data3[$sys]) . '</label>'; ?></a>
														</li>
													<?php } ?>
												</ul>
												<!-- Tab panes -->
												<div class="tab-content tabs">
													<?php
													$k = 0;
													foreach ($arr_system as $sys => $sys_name) {
														$k++;
													?>
														<div class="tab-pane m-t-20 <?php if ($k == 1) {
																						echo "active";
																					} ?>" id="<?php echo $sys; ?>" role="tabpanel">
															<h6><i class="icofont icofont-dotted-right"></i> <?php echo $sys_name; ?></h6>
															<div>

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
																	//print_r_pre($array_data_Assets);


																	if (count($array_data3[$sys]) > 0) {
																		$a = 1;

																		foreach ($array_data3[$sys] as $CH1 => $SH1) {
																			if ($SH1['TYPE_ASSET'] == 'CIVIL') {
																				$SYSTEM_ID = 1;
																			} else if ($SH1['TYPE_ASSET'] == 'BANKRUPT') {
																				$SYSTEM_ID = 2;
																			}

																	?>
																			<tr>
																				<div>
																					<td>
																						<div align='center'><?php echo $a; ?></div>
																					</td>
																					<!-- <td><?php echo $SH1['ASSET_ID']; ?></td> -->
																					<td>
																						<div style="width: 300px;"><a onclick="show_asset_detail(<?php echo $SH1['ASSET_CODE']; ?>)" href="javascript:void();"><?php echo $SH1["PROP_TITLE"]; ?></a></div>
																					</td>
																					<td><?php echo $SH1['PROP_STATUS_NAME']; ?></td>
																					<?php
																					$A = ($SH1['BLACK_CASE'] != '' && $SH1['BLACK_CASE'] != '') ? "/" : "";
																					$B = ($SH1['RED_CASE'] != '' && $SH1['RED_CASE'] != '') ? "/" : "";
																					?>
																					<td><a onclick="show_detial_2(
									'<?php echo $SH1['SYSTEM_TYPE'] ?>',
									'<?php echo ($IDCARD) ?>',
									'<?php echo WH_ID_CONVERT_TO_CODE_API($SH1['WH_ID'], $SH1['SYSTEM_TYPE']); ?>'
									);" href=""> <?php echo $SH1['PREFIX_BLACK_CASE'] . $SH1['BLACK_CASE'] . $A . $SH1['BLACK_YY']; ?></a></td>
																					<td><a onclick="show_detial_2(
									'<?php echo $SH1['SYSTEM_TYPE'] ?>',
									'<?php echo ($IDCARD) ?>',
									'<?php echo WH_ID_CONVERT_TO_CODE_API($SH1['WH_ID'], $SH1['SYSTEM_TYPE']); ?>'
									);" href=""> <?php echo $SH1['PREFIX_RED_CASE'] . $SH1['RED_CASE'] . $A . $SH1['RED_YY']; ?></a></td>

																					<!-- <td><?php //echo $recSelectDataAll['COURT_NAME']; 
																								?></td> -->
																				</div>

																				<td>
																					<button type="button" data-toggle="tooltip" data-placement="top" title="ดูรายละเอียด" onclick="show_detial_2(
									'<?php echo $SH1['SYSTEM_TYPE'] ?>',
									'<?php echo ($IDCARD) ?>',
									'<?php echo WH_ID_CONVERT_TO_CODE_API($SH1['WH_ID'], $SH1['SYSTEM_TYPE']); ?>'
									);" class="btn btn-info btn-mini"> <i class="icofont icofont-search"></i></button>
																					<button type="button" class="btn btn-success btn-mini" data-toggle="tooltip" data-placement="top" title="สอบถามความประสงค์" onclick="action_from('<?php echo convertSystem($sys); ?>','<?php echo $SH1['PREFIX_BLACK_CASE']; ?>',  
								   '<?php echo $SH1['BLACK_CASE']; ?>','<?php echo $SH1['BLACK_YY']; ?>','<?php echo $SH1['PREFIX_RED_CASE']; ?>',
								   '<?php echo $SH1['RED_CASE']; ?>','<?php echo $SH1['RED_YY']; ?>','<?php echo $SH1['COURT_CODE']; ?>'
								   );"><i class="icofont icofont-ui-call"></i></button>
																				</td>
																			</tr>
																		<?php
																			$a++;
																		}
																	} else {
																		?>
																		<tr>
																			<td colspan="10">
																				<div align='center'><?php echo 'ไม่มีพบข้อมูล'; ?></div>
																			</td>
																		</tr>
																	<?php
																	}


																	?>
																</table>


															</div>


														</div>
													<?php } ?>

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