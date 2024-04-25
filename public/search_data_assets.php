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

$arr_system = array("BANKRUPT" => "คดีล้มละลาย", "CIVIL" => "คดีแพ่ง");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include '../include/template_user.php'; ?>
</head>

<!-- <body id="bsf_body" class="horizontal-fixed fixed">
    <div class="wrapper"></div> -->

<body id="bsf_body" class="">
	<div class="wrapper">
		<?php
		//  include '../include/combottom_js_user.php'; //function 
		include '../include/func_Nop.php';
		include "./btn_function.php";
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
									/* ไม่ได้ใช้ start */


									$k = 0;
									$array_data_Assets = [];

									function LikeArray($A, $fill_NAME)
									{
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
									$work = 2;
									foreach ($arr_system as $sys => $sys_name) {
										$k++;
										if ($number_assets != '') {
											switch ($work) {
												case '1':
													$sqlSelectDataALL_e = "SELECT a.TABLE_DETAIL  AS PROP_TITLE ,
												a.ASSET_PREFIX_BLACK_CASE AS PREFIX_BLACK_CASE ,
												a.ASSET_BLACK_CASE AS BLACK_CASE,
												a.ASSET_PBLACK_YY AS BLACK_YY,
												a.ASSET_PREFIX_BLACK_CASE AS PREFIX_BLACK_CASE,
												a.ASSET_RED_CASE AS RED_CASE,
												a.ASSET_RED_YY AS RED_YY,
												a.TYPE_ASSET 
												FROM WH_ASSET_MAIN a
												WHERE 1=1 
												AND a.TYPE_ASSET ='" . $sys . "'
												" . LikeArray($_POST['number_assets'], 'TABLE_DETAIL') . "";
													break;
												case '2':
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
											a.CODE_API FROM WH_ALL_ASSETS_MAIN a
											WHERE 1=1 
											AND a.TYPE_ASSET ='" . $sys . "'
											" . LikeArray($_POST['number_assets'], 'TABLE_DETAIL') . "";
													break;
											}
										}

										//echo $sqlSelectDataALL_e;

										$query_SelectDataALL_e[$k] = db::query($sqlSelectDataALL_e);
										$array_num = 0;
										while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
											/* $array_data_Assets[$sys][$array_num]['ASSET_ID'] = $recSelectDataAll['ASSET_ID'];
											$array_data_Assets[$sys][$array_num]['PROP_TITLE'] = $recSelectDataAll['PROP_TITLE'];
											$array_data_Assets[$sys][$array_num]['PROP_STATUS_NAME'] = $recSelectDataAll['PROP_STATUS_NAME'];
											$array_data_Assets[$sys][$array_num]['PROP_STATUS'] = $recSelectDataAll['PROP_STATUS'];
											$array_data_Assets[$sys][$array_num]['PREFIX_BLACK_CASE'] = $recSelectDataAll['PREFIX_BLACK_CASE'];
											$array_data_Assets[$sys][$array_num]['BLACK_CASE'] = $recSelectDataAll['BLACK_CASE'];
											$array_data_Assets[$sys][$array_num]['BLACK_YY'] = $recSelectDataAll['BLACK_YY'];
											$array_data_Assets[$sys][$array_num]['PREFIX_RED_CASE'] = $recSelectDataAll['PREFIX_RED_CASE'];
											$array_data_Assets[$sys][$array_num]['RED_CASE'] = $recSelectDataAll['RED_CASE'];
											$array_data_Assets[$sys][$array_num]['RED_YY'] = $recSelectDataAll['RED_YY']; */
											$array_data_Assets[$sys][$array_num] = $recSelectDataAll;
											$array_num++;
										}
									}

									/* create SQL เเละ ARRAY Stop */
									/* ไม่ได้ใช้ Stop */

									?>

									<div class="card-block">
										<form method="POST" action="./search_data_assets.php" enctype="multipart/form-data" id="frm-input">
											<div class="row" style="margin-top: 10px;">
												<br>
												<div class="col-xs-12 col-sm-3">
													<label for="" class="form-control-label wf-right">คำค้นเลขที่ </label>
												</div>
												<div class="col-xs-12 col-sm-6">

													<input type="text" name="number_assets" value="<?php echo $number_assets; ?>" id="number_assets" class="form-control">
												</div>
											</div><br><br>
											<div class="row">
												<div class="col-xs-12 col-sm-6" align="right">
													<button type="button" class="btn btn-primary" onClick="searchData();">ค้นหา</button>
												</div>
												<div class="col-xs-12 col-sm-6" align="left">
													<button type="button" class="btn btn-info" onClick="btn_clear();"><i class="fa fa-refresh"></i></button>
												</div>
											</div>
											<hr>
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
																				} ?>" data-toggle="tab" href="#<?php echo $sys; ?>" role="tab"><?php echo $sys_name; ?> <?php echo  count($array_data_Assets[$sys]) == 0 ? "" : '<label class="badge bg-danger">' . count($array_data_Assets[$sys]) . '</label>'; ?></a>
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
																		<th class="text-center">หมายเลขทะเบียน</th>
																		<th class="text-center">รายการทรัพย์สิน</th>
																		<th class="text-center">สถานะ</th>
																		<th class="text-center">เลขคดีดำ/ปี</th>
																		<th class="text-center">เลขคดีแดง/ปี</th>
																		<!-- <th class="text-center">ศาล</th> -->
																		<!-- <th class="text-center">จัดการ</th> -->
																	</thead>
																	<?php
																	//print_r_pre($array_data_Assets);
																	if (count($array_data_Assets[$sys]) > 0) {
																		$a = 1;

																		foreach ($array_data_Assets[$sys] as $CH1 => $SH1) {
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
																					<td><?php echo $SH1['ASSET_ID']; ?></td>
																					<td>
																						<div style="width: 300px;"><a onclick="show_asset_detail(<?php echo $SH1['ASSET_CODE']; ?>)" href="javascript:void();"><?php echo $SH1["PROP_TITLE"]; ?></a></div>
																					</td>
																					<td><?php echo $SH1['PROP_STATUS_NAME']; ?></td>
																					<?php
																					$A = ($SH1['BLACK_CASE'] != '' && $SH1['BLACK_CASE'] != '') ? "/" : "";
																					$B = ($SH1['RED_CASE'] != '' && $SH1['RED_CASE'] != '') ? "/" : "";
																					?>
																					<td><a onclick="show_detial(
									'<?php echo $SH1['PREFIX_BLACK_CASE'] ?>',
									'<?php echo $SH1['BLACK_CASE'] ?>',
									'<?php echo $SH1['BLACK_YY'] ?>',
									'<?php echo $SH1['PREFIX_RED_CASE'] ?>',
									'<?php echo $SH1['RED_CASE'] ?>',
									'<?php echo $SH1['RED_YY'] ?>',
									'<?php echo $SH1['COURT_CODE'] ?>',
									'<?php echo $SYSTEM_ID ?>',
									'<?php echo $SH1['REGISTER_CODE'] ?>',
									'<?php echo $SH1['SYSTEM_TYPE'] ?>');" href=""> <?php echo $SH1['PREFIX_BLACK_CASE'] . $SH1['BLACK_CASE'] . $A . $SH1['BLACK_YY']; ?></a></td>
																					<td><a onclick="show_detial(
									'<?php echo $SH1['PREFIX_BLACK_CASE'] ?>',
									'<?php echo $SH1['BLACK_CASE'] ?>',
									'<?php echo $SH1['BLACK_YY'] ?>',
									'<?php echo $SH1['PREFIX_RED_CASE'] ?>',
									'<?php echo $SH1['RED_CASE'] ?>',
									'<?php echo $SH1['RED_YY'] ?>',
									'<?php echo $SH1['COURT_CODE'] ?>',
									'<?php echo $SYSTEM_ID ?>',
									'<?php echo $SH1['REGISTER_CODE'] ?>',
									'<?php echo $SH1['SYSTEM_TYPE'] ?>');" href=""> <?php echo $SH1['PREFIX_BLACK_CASE'] . $SH1['BLACK_CASE'] . $A . $SH1['BLACK_YY']; ?></a></td>
																					<!-- <td><?php //echo $recSelectDataAll['COURT_NAME']; 
																								?></td> -->
																				</div>
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
			window.location = 'http://103.208.27.224:81/led_service_api/public/search_data_assets.php'

		}

		function searchData() {
			$("#page").val(1);
			$("#page_size").val(20);
			$("#frm-input").attr("target", "").attr("action", "").submit();
		}
	</script>
	<?php
	include '../include/combottom_js_user.php';
	include '../include/combottom_user.php'; ?>