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
									$k = 0;
									$array_data_table = [];
									foreach ($arr_system as $sys => $sys_name) {
										$k++;

										$land_data = $_GET['land_data'];
										$building = $_GET['building'];
										$condominium = $_GET['condominium'];
										$lease_rights = $_GET['lease_rights'];
										$share = $_GET['share'];
										$gun_registration = $_GET['gun_registration'];
										$bond = $_GET['bond'];
										$savings_lottery = $_GET['savings_lottery'];
										$car = $_GET['car'];
										$boat = $_GET['boat'];
										$machinery = $_GET['machinery'];
										$other_machinery = $_GET['other_machinery'];
										$property_location = $_GET['property_location'];
										$person_inspects = $_GET['person_inspects'];

										$search_data = [
											"land_data" => [
												"like" => $land_data,
												"IF" => $landToggle == 'on' ? "ที่ดิน" : "",
											],
											"building" => [
												"like" => $building,
												"IF" =>  $buildingToggle == 'on' ? "สิ่งปลูกสร้าง" : "",
											],
											"condominium" => [
												"like" => $condominium,
												"IF" => $condominiumToggle == 'on' ? "อาคารชุด" : "",
											],
											"lease_rights" => [
												"like" => $lease_rights,
												"IF" => $lease_rightsToggle == 'on' ? "เช่า" : "",
											],
											"share" => [
												"like" => $share,
												"IF" => $shareToggle == 'on' ? "หุ้น" : "",
											],
											"gun_registration" => [
												"like" => $gun_registration,
												"IF" => $gun_registrationToggle == 'on' ? "หมายเลขปืน" : "",
											],
											"bond" => [
												"like" => $bond,
												"IF" => $bondToggle == 'on' ? "พันธบัตร" : "",
											],
											"savings_lottery" => [
												"like" => $savings_lottery,
												"IF" => $savings_lotteryToggle == 'on' ? "สลาก" : "",
											],
											"car" => [
												"like" => $car,
												"IF" => $carToggle == 'on' ? "รถ" : "",
											],
											"boat" => [
												"like" => $boat,
												"IF" => $boatToggle == 'on' ? "เรือ" : "",
											],
											"machinery" => [
												"like" => $machinery,
												"IF" => $machineryToggle == 'on' ? "เครื่องจักร" : "",
											],
											"other_machinery" => [
												"like" => $other_machinery,
												"IF" => $other_machineryToggle == 'on' ? "ที่ดิน" : "",
											],
											"property_location" => [
												"like" => $property_location,
												"IF" => $property_locationToggle == 'on' ? "สถานที่" : "",
											],
											"person_inspects" => [
												"like" => $person_inspects,
												"IF" => $person_inspectsToggle == 'on' ? "เลขที่ประจำตัวประชาชน" : "",
											]
										];
										// print_r_pre($search_data);
										$queryConditions = [];
										$array_data = [];

										foreach ($search_data as $key => $value) {
											$data_a = "";
											if ($value['IF'] != '') { //ถ้าที่ดินถูกเลือกหรือรายการใหนถูกเลือกค่อยเอาไปค้น
												foreach ($value['like'] as $sh => $ch) {
													if ($ch != "") {
														$data_a .= " AND a.TABLE_DETAIL  like '%" . $ch . "%' ";
													}
												}
												$data_a .= " AND a.TABLE_DETAIL  like '%" . $value['IF'] . "%' ";
											}
											$array_data[$key] = $data_a;
										}
										// print_r_pre($array_data);
										$work = 2;
										foreach ($array_data as $A1 => $B1) {
											$sql = "";
											if ($B1 != "") {
												switch ($work) {
													case '1':
														$sql = "SELECT a.ASSET_CODE,
												a.TABLE_DETAIL  AS PROP_TITLE ,
												a.ASSET_PREFIX_BLACK_CASE AS PREFIX_BLACK_CASE ,
												a.ASSET_BLACK_CASE AS BLACK_CASE,
												a.ASSET_PBLACK_YY AS BLACK_YY,
												a.ASSET_PREFIX_BLACK_CASE AS PREFIX_BLACK_CASE,
												a.ASSET_RED_CASE AS RED_CASE,
												a.ASSET_RED_YY AS RED_YY,
												a.TYPE_ASSET 
												FROM WH_ASSET_MAIN a
												WHERE 1=1 
												AND a.TYPE_ASSET ='" . $sys . "'{$B1}
												";
														break;
													case '2':
														$sql = "SELECT  a.WH_ASSET_ID ,
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
														AND a.TYPE_ASSET ='" . $sys . "'{$B1}
														";
														break;
												}

												//echo $sql . "<br><br>";
											}
											$query_SelectDataALL_e = db::query($sql);
											$num_b[$k] = db::num_rows($query_SelectDataALL_e[$A1]);
											while ($recSelectDataAll1 = db::fetch_array($query_SelectDataALL_e)) {
												$array_data_table[$sys][] = $recSelectDataAll1;
											}
										}
									}
									?>
									<?php
									$sql_pro = "SELECT * FROM G_PROVINCE";
									$query_provinces = db::query($sql_pro);

									$sql_amp = "SELECT * FROM M_G_AMPHUR";
									$query_amp = db::query($sql_amp);

									$sql_distinct = "SELECT * FROM M_G_TAMBON";
									$query_distinct = db::query($sql_distinct);
									?>
									<form method="GET" action="search_data_assets_type.php" enctype="multipart/form-data" id="searchForm">
										<div class="card-block">
											<div class="card">
												<div class="header bg-primary" style=" padding: 20px; height: 50px; border: 3px; display:flex; align-items: center;">
													<label for="menuToggel" style="margin-right: 10px;">
														<input type="checkbox" id="menuToggel" name="menuToggel" style="transform: scale(1.5);">
													</label>
													<h5 id="displayText">แสดงแถบค้นหา</h5>
												</div>
												<div class="card-body">
													<div id="menuContent" style="padding: 10px;">
														<input type="hidden" id="proc" name="proc" value="<?php echo $proc;  ?>">
														<div class="card">
															<div class="header " style=" padding: 10px; height: 50px; border: 3px; display:flex; align-items: center;">
																<label for="landToggle" style="margin-left: 10px;">
																	<input type="checkbox" id="landToggle" name="landToggle" style="transform: scale(1.5);" <?php echo $_GET['landToggle'] == 'on' ? 'checked' : '';  ?>>
																</label>
																<h5 style="margin-left: 20px;">ที่ดิน</h5>
															</div>
															<div class="card-body">
																<div id="landContent">
																	<div class="row mt-4" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">ชนิดเอกสารสิทธิ์ </label>
																		</div>
																		<div class="col-xs-12 col-sm-4">
																			<?php
																			$sql_land = "SELECT * FROM M_LAND_TYPE_MAP";
																			$query_land = db::query($sql_land);
																			?>
																			<select name="land_data[]" id="land_data" class="form-control select2" tabindex="-1">
																				<option value="">ทั้งหมด</option>
																				<?php
																				while ($recSelectland = db::fetch_array($query_land)) { ?>
																					<option value="<?= $recSelectland['LAND_TYPE_NAME_LAW'] ?>" <?php echo $recSelectland['LAND_TYPE_NAME_LAW'] == $_GET['land_data'][0] ? 'selected' : ' '; ?>><?= $recSelectland['LAND_TYPE_NAME_LAW'] ?></option>
																				<?php	} ?>
																			</select>
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">เลขที่ </label>
																		</div>
																		<div class="col-xs-12 col-sm-2">
																			<input class="form-control" type="text" name="land_data[]" value="<?php echo $_GET['land_data'][1] ?>">
																		</div>
																		<div class="col-xs-6 col-sm-6">
																			<div class="col-xs-2 col-sm-2">
																				<label for="" class="form-control-label "></label>
																			</div>
																			<div class="col-xs-2 col-sm-2">
																				<label for="" class="form-control-label wf-right"></label>
																			</div>
																			<div class="col-xs-2 col-sm-2">
																			</div>
																			<div class="col-xs-2 col-sm-2">
																				<label for="" class="form-control-label wf-right">เลขที่ดิน </label>
																			</div>
																			<div class="col-xs-2 col-sm-4">
																				<input class="form-control" type="text" name="land_data[]" value="<?php echo $_GET['land_data'][2] ?>">
																			</div>
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">เล่มที่ </label>
																		</div>
																		<div class="col-xs-12 col-sm-2">
																			<input class="form-control" type="text" name="land_data[]" value="<?php echo $_GET['land_data'][3] ?>">
																		</div>
																		<div class="col-xs-6 col-sm-6">
																			<div class="col-xs-2 col-sm-2">
																				<label for="" class="form-control-label "></label>
																			</div>
																			<div class="col-xs-3 col-sm-3">
																				<label for="" class="form-control-label wf-right">หน้า </label>
																			</div>
																			<div class="col-xs-2 col-sm-2">
																				<input class="form-control" type="text" name="land_data[]" value="<?php echo $_GET['land_data'][4] ?>">
																			</div>
																			<div class="col-xs-2 col-sm-2">
																				<label for="" class="form-control-label wf-right">หน้าสำรวจ </label>
																			</div>
																			<div class="col-xs-2 col-sm-2">
																				<input class="form-control" type="text" name="land_data[]" value="<?php echo $_GET['land_data'][5] ?>">
																			</div>
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">สารบบเล่ม </label>
																		</div>
																		<div class="col-xs-12 col-sm-2">
																			<input class="form-control" type="text" name="land_data[]" value="<?php echo $_GET['land_data'][6] ?>">
																		</div>
																		<div class="col-xs-6 col-sm-6">
																			<div class="col-xs-2 col-sm-2">
																				<label for="" class="form-control-label "></label>
																			</div>
																			<div class="col-xs-3 col-sm-3">
																				<label for="" class="form-control-label wf-right">หน้า </label>
																			</div>
																			<div class="col-xs-2 col-sm-2">
																				<input class="form-control" type="text" name="land_data[]" value="<?php echo $_GET['land_data'][7] ?>">
																			</div>
																			<div class="col-xs-2 col-sm-2">
																				<label for="" class="form-control-label wf-right">หมู่ที่ </label>
																			</div>
																			<div class="col-xs-2 col-sm-2">
																				<input class="form-control" type="text" name="land_data[]" value="<?php echo $_GET['land_data'][8] ?>">
																			</div>
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">จังหวัด(ตามเอกสารสิทธิ์) </label>
																		</div>
																		<div class="col-xs-12 col-sm-4">
																			<select name="land_data[provinces]" id="provinces_land_data" name class="form-control select2" tabindex="-1">
																				<option value="">ทั้งหมด</option>
																				<?php
																				while ($recSelectPro = db::fetch_array($query_provinces)) { ?>
																					<option value="<?= $recSelectPro['PROVINCE_NAME'] ?>" <?php echo $recSelectPro['PROVINCE_NAME'] == $_GET['land_data']['provinces'] ? 'selected' : ' '; ?>><?= $recSelectPro['PROVINCE_NAME'] ?></option>
																				<?php	} ?>
																			</select>
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">เขต/อำเภอ(ตามเอกสารสิทธิ์)</label>
																		</div>
																		<div class="col-xs-12 col-sm-4">
																			<select class="form-control select2" name="land_data[amphures]" id="amphures_land_data" value="<?php echo $_GET['land_data']['amphures']; ?>">
																				<?php
																				if ($_GET['land_data']['amphures'] != "") {
																					$sql_a = "SELECT * FROM M_G_AMPHUR ";
																					$query_mp = db::query($sql_a);
																					while ($rec_amp = db::fetch_array($query_mp)) {
																				?>
																						<option <?php echo $_GET['land_data']['amphures'] == $rec_amp['AMPHUR_NAME'] ? "selected" : ""; ?> value="<?php echo $rec_amp['AMPHUR_NAME']; ?>"><?php echo $rec_amp['AMPHUR_NAME']; ?></option>
																				<?
																					}
																				}
																				?>
																			</select>
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">แขวง/ตำบล(ตามเอกสารสิทธิ์) </label>
																		</div>
																		<div class="col-xs-12 col-sm-4">
																			<select class="form-control select2" name="land_data[districts]" id="districts_land_data">
																				<?php
																				if ($_GET['land_data']['districts'] != "") {
																					$sql_d = "SELECT * FROM M_G_TAMBON";
																					$query_dt = db::query($sql_d);
																					while ($rec_dt = db::fetch_array($query_dt)) {
																				?>
																						<option <?php echo $_GET['land_data']['districts'] == $rec_dt['TAMBON_NAME'] ? "selected" : ""; ?> value="<?php echo $rec_dt['TAMBON_NAME']; ?>"><?php echo $rec_dt['TAMBON_NAME']; ?></option>
																				<?php

																					}
																				}
																				?>
																			</select>
																		</div>
																	</div><br>
																</div>
															</div>
														</div>

														<div class="card">
															<div class="header " style=" padding: 10px; height: 50px; border: 3px; display:flex; align-items: center;">
																<label for="buildingToggle" style="margin-left: 10px;">
																	<input type="checkbox" id="buildingToggle" name="buildingToggle" style="transform: scale(1.5);" <?php echo $_GET['buildingToggle'] == 'on' ? 'checked' : '';  ?>>
																</label>
																<h5 style="margin-left: 20px;">สิ่งปลูกสร้าง</h5>
															</div>
															<div class="card-body">
																<div id="buildingContent">
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">เลขที่ปลูกสร้าง </label>
																		</div>
																		<div class="col-xs-12 col-sm-3">
																			<input class="form-control" type="text" name="building[]" value="<?php echo $_GET['building'][0] ?>">
																		</div>
																		<div class="col-xs-6 col-sm-6">
																			<div class="col-xs-2 col-sm-2">
																				<label for="" class="form-control-label wf-right"></label>
																			</div>
																			<div class="col-xs-2 col-sm-1">
																			</div>
																			<div class="col-xs-2 col-sm-3">
																				<label for="" class="form-control-label wf-right">ชื่อหมู่บ้าน/โครงการ </label>
																			</div>
																			<div class="col-xs-2 col-sm-4">
																				<input class="form-control" type="text" name="building[]" value="<?php echo $_GET['building'][1] ?>">
																			</div>
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">หมู่ที่ </label>
																		</div>
																		<div class="col-xs-12 col-sm-2">
																			<input class="form-control" type="text" name="building[]" value="<?php echo $_GET['building'][2] ?>">
																		</div>
																		<div class="col-xs-6 col-sm-6">
																			<div class="col-xs-2 col-sm-2">
																				<label for="" class="form-control-label "></label>
																			</div>
																			<div class="col-xs-2 col-sm-2">
																				<label for="" class="form-control-label wf-right"></label>
																			</div>
																			<div class="col-xs-2 col-sm-2">
																			</div>
																			<div class="col-xs-2 col-sm-2">
																				<label for="" class="form-control-label wf-right">ซอย </label>
																			</div>
																			<div class="col-xs-2 col-sm-4">
																				<input class="form-control" type="text" name="building[]" value="<?php echo $_GET['building'][3] ?>">
																			</div>
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">ถนน </label>
																		</div>
																		<div class="col-xs-12 col-sm-4">
																			<input class="form-control" type="text" name="building[]" value="<?php echo $_GET['building'][4] ?>">
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">จังหวัด(ตามเอกสารสิทธิ์) </label>
																		</div>
																		<div class="col-xs-12 col-sm-4">
																			<select name="building[provinces]" id="provinces_building" class="form-control select2" tabindex="-1">
																				<option value="">ทั้งหมด</option>
																				<?php
																				$query_provinces2 = db::query($sql_pro);
																				while ($recSelectPro2 = db::fetch_array($query_provinces2)) { ?>
																					<option value="<?= $recSelectPro2['PROVINCE_NAME'] ?>" <?php echo $recSelectPro2['PROVINCE_NAME'] == $_GET['building']['provinces'] ? 'selected' : ' '; ?>><?= $recSelectPro2['PROVINCE_NAME'] ?></option>
																				<?php	} ?>
																			</select>
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">เขต/อำเภอ(ตามเอกสารสิทธิ์)</label>
																		</div>
																		<div class="col-xs-12 col-sm-4">
																			<select class="form-control select2" name="building[amphures]" id="amphures_building">
																				<?php
																				if ($_GET['building']['amphures'] != "") {

																					$sql_a = "SELECT ID_AMPHUR ,AMPHUR_NAME FROM M_G_AMPHUR";
																					$query_mp = db::query($sql_a);
																					while ($rec_amp = db::fetch_array($query_mp)) {
																				?>
																						<option value="<?php echo $rec_amp['AMPHUR_NAME']; ?>" <?php echo $rec_amp['AMPHUR_NAME'] == $_GET['building']['amphures'] ? "selected" : ""; ?>><?php echo $rec_amp['AMPHUR_NAME']; ?></option>
																				<?php
																					}
																				}
																				?>
																			</select>
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">แขวง/ตำบล(ตามเอกสารสิทธิ์) </label>
																		</div>
																		<div class="col-xs-12 col-sm-4">
																			<select class="form-control select2" name="building[districts]" id="districts_building">
																				<?php
																				if ($_GET['building']['districts'] != "") {
																					$sql_d = "SELECT * FROM M_G_TAMBON ";
																					$query_dt = db::query($sql_d);
																					while ($rec_dt = db::fetch_array($query_dt)) {
																				?>
																						<option <?php echo $_GET['building']['districts'] == $rec_dt['TAMBON_NAME'] ? "selected" : ""; ?> value="<?php echo $rec_dt['TAMBON_NAME']; ?>"><?php echo $rec_dt['TAMBON_NAME']; ?></option>
																				<?php
																					}
																				}
																				?>
																			</select>
																		</div>
																	</div><br>
																</div>
															</div>
														</div>

														<div class="card">
															<div class="header " style=" padding: 10px; height: 50px; border: 3px; display:flex; align-items: center;">
																<label for="condominiumToggle" style="margin-left: 10px;">
																	<input type="checkbox" id="condominiumToggle" name="condominiumToggle" style="transform: scale(1.5);" <?php echo $_GET['condominiumToggle'] == 'on' ? 'checked' : '';  ?>>
																</label>
																<h5 style="margin-left: 20px;">อาคารชุด</h5>
															</div>
															<div class="card-body">
																<div id="condominiumContent">
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">เลขที่ปลูกสร้าง </label>
																		</div>
																		<div class="col-xs-12 col-sm-3">
																			<input class="form-control" type="text" name="condominium[]" value="<?php echo $_GET['condominium'][0] ?>">
																		</div>
																		<div class="col-xs-6 col-sm-6">
																			<div class="col-xs-2 col-sm-2">
																				<label for="" class="form-control-label wf-right"></label>
																			</div>
																			<div class="col-xs-2 col-sm-1">
																			</div>
																			<div class="col-xs-2 col-sm-3">
																				<label for="" class="form-control-label wf-right">ชั้นที่</label>
																			</div>
																			<div class="col-xs-2 col-sm-4">
																				<input class="form-control" type="text" name="condominium[]" value="<?php echo $_GET['condominium'][1] ?>">
																			</div>
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">อาคารเลขที่ </label>
																		</div>
																		<div class="col-xs-12 col-sm-3">
																			<input class="form-control" type="text" name="condominium[]" value="<?php echo $_GET['condominium'][2] ?>">
																		</div>
																		<div class="col-xs-6 col-sm-6">
																			<div class="col-xs-2 col-sm-2">
																				<label for="" class="form-control-label wf-right"></label>
																			</div>
																			<div class="col-xs-2 col-sm-1">
																			</div>
																			<div class="col-xs-2 col-sm-3">
																				<label for="" class="form-control-label wf-right">ชื่ออาคารชุด</label>
																			</div>
																			<div class="col-xs-2 col-sm-4">
																				<input class="form-control" type="text" name="condominium[]" value="<?php echo $_GET['condominium'][3] ?>">
																			</div>
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">ทะเบียนอาคารชุดเลขที่ </label>
																		</div>
																		<div class="col-xs-12 col-sm-3">
																			<input class="form-control" type="text" name="condominium[]" value="<?php echo $_GET['condominium'][4] ?>">
																		</div>
																		<div class="col-xs-6 col-sm-6">
																			<div class="col-xs-2 col-sm-2">
																				<label for="" class="form-control-label wf-right"></label>
																			</div>
																			<div class="col-xs-2 col-sm-4">
																				<label for="" class="form-control-label wf-right">ตั้งอยู่บนเอกสารสิทธิ์เลขที่</label>
																			</div>
																			<div class="col-xs-2 col-sm-4">
																				<input class="form-control" type="text" name="condominium[]" value="<?php echo $_GET['condominium'][5] ?>">
																			</div>
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">จังหวัด(ตามเอกสารสิทธิ์) </label>
																		</div>
																		<div class="col-xs-12 col-sm-4">
																			<select name="condominium[provinces]" id="provinces_condominium" class="form-control select2" tabindex="-1">
																				<option value="">ทั้งหมด</option>
																				<?php
																				$query_provinces3 = db::query($sql_pro);
																				while ($recSelectPro3 = db::fetch_array($query_provinces3)) { ?>
																					<option value="<?= $recSelectPro3['PROVINCE_NAME'] ?>" <?php echo $recSelectPro3['PROVINCE_NAME'] == $_GET['condominium']['provinces'] ? 'selected' : ' '; ?>><?= $recSelectPro3['PROVINCE_NAME'] ?></option>
																				<?php	} ?>
																			</select>
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">เขต/อำเภอ(ตามเอกสารสิทธิ์)</label>
																		</div>
																		<div class="col-xs-12 col-sm-4">
																			<select class="form-control select2" name="condominium[amphures]" id="amphures_condominium">
																				<?php
																				if ($_GET['condominium']['amphures'] != "") {

																					$sql_a = "SELECT ID_AMPHUR ,AMPHUR_NAME FROM M_G_AMPHUR";
																					$query_mp = db::query($sql_a);
																					while ($rec_amp = db::fetch_array($query_mp)) {
																				?>
																						<option value="<?php echo $rec_amp['AMPHUR_NAME']; ?>" <?php echo $rec_amp['AMPHUR_NAME'] == $_GET['condominium']['amphures'] ? "selected" : ""; ?>><?php echo $rec_amp['AMPHUR_NAME']; ?></option>
																				<?php
																					}
																				}
																				?>
																			</select>
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">แขวง/ตำบล(ตามเอกสารสิทธิ์) </label>
																		</div>
																		<div class="col-xs-12 col-sm-4">
																			<select class="form-control select2" name="condominium[districts]" id="districts_condominium" value="<?php echo $_GET['condominium']['districts'] ?>">
																				<?php
																				if ($_GET['condominium']['districts'] != "") {
																					$sql_d = "SELECT * FROM M_G_TAMBON ";
																					$query_dt = db::query($sql_d);
																					while ($rec_dt = db::fetch_array($query_dt)) {
																				?>
																						<option <?php echo $_GET['condominium']['districts'] == $rec_dt['TAMBON_NAME'] ? "selected" : ""; ?> value="<?php echo $rec_dt['TAMBON_NAME']; ?>"><?php echo $rec_dt['TAMBON_NAME']; ?></option>
																				<?php
																					}
																				}
																				?>
																			</select>
																		</div>
																	</div><br>
																</div>
															</div>
														</div>

														<div class="card">
															<div class="header " style=" padding: 10px; height: 50px; border: 3px; display:flex; align-items: center;">
																<label for="lease_rightsToggle" style="margin-left: 10px;">
																	<input type="checkbox" id="lease_rightsToggle" name="lease_rightsToggle" style="transform: scale(1.5);" <?php echo $_GET['lease_rightsToggle'] == 'on' ? 'checked' : '';  ?>>
																</label>
																<h5 style="margin-left: 20px;">สิทธิ์การเช่า</h5>
															</div>
															<div class="card-body">
																<div id="lease_rightsContent">
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-4">
																			<label for="" class="form-control-label wf-right">ประเภททรัพย์ที่เช่า </label>
																		</div>
																		<div class="col-xs-12 col-sm-3">
																			<?php
																			$sql_rent = "SELECT * FROM M_RENT_TYPE_MAP";
																			$query_rent = db::query($sql_rent);
																			?>
																			<select name="lease_rights[]" id="lease_rights[]" class="form-control select2" tabindex="-1">
																				<option value="">ทั้งหมด</option>
																				<?php
																				while ($recSelectrent = db::fetch_array($query_rent)) { ?>
																					<option value="<?= $recSelectrent['RENT_TYPE_NAME_LAW'] ?>" <?php echo $recSelectrent['RENT_TYPE_NAME_LAW'] == $_GET['lease_rights'][0] ? 'selected' : ' '; ?>><?= $recSelectrent['RENT_TYPE_NAME_LAW'] ?></option>
																				<?php	} ?>
																			</select>
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-4">
																			<label for="" class="form-control-label wf-right">จังหวัด(ตามเอกสารสิทธิ์) </label>
																		</div>
																		<div class="col-xs-12 col-sm-4">
																			<select name="lease_rights[districts]" id="provinces_lease_rights" class="form-control select2" tabindex="-1">
																				<option value="">ทั้งหมด</option>
																				<?php
																				$query_provinces4 = db::query($sql_pro);
																				while ($recSelectPro4 = db::fetch_array($query_provinces4)) { ?>
																					<option value="<?= $recSelectPro4['PROVINCE_NAME'] ?>" <?php echo $recSelectPro4['PROVINCE_NAME'] == $_GET['lease_rights']['provinces'] ? 'selected' : ' '; ?>><?= $recSelectPro4['PROVINCE_NAME'] ?></option>
																				<?php	} ?>
																			</select>
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-4">
																			<label for="" class="form-control-label wf-right">เขต/อำเภอ(ตามเอกสารสิทธิ์)</label>
																		</div>
																		<div class="col-xs-12 col-sm-4">
																			<select class="form-control select2" name="lease_rights[amphures]" id="amphures_lease_rights">
																				<?php
																				if ($_GET['lease_rights']['amphures'] != "") {

																					$sql_a = "SELECT ID_AMPHUR,AMPHUR_NAME FROM M_G_AMPHUR";
																					$query_mp = db::query($sql_a);
																					while ($rec_amp = db::fetch_array($query_mp)) {
																				?>
																						<option value="<?php echo $rec_amp['AMPHUR_NAME']; ?>" <?php echo $rec_amp['AMPHUR_NAME'] == $_GET['lease_rights']['amphures'] ? "selected" : ""; ?>><?php echo $rec_amp['AMPHUR_NAME']; ?></option>
																				<?php
																					}
																				}
																				?>
																			</select>
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-4">
																			<label for="" class="form-control-label wf-right">แขวง/ตำบล(ตามเอกสารสิทธิ์) </label>
																		</div>
																		<div class="col-xs-12 col-sm-4">
																			<select class="form-control select2" name="lease_rights[districts]" id="districts_lease_rights">
																				<?php
																				if ($_GET['lease_rights']['districts'] != "") {
																					$sql_d = "SELECT * FROM M_G_TAMBON ";
																					$query_dt = db::query($sql_d);
																					while ($rec_dt = db::fetch_array($query_dt)) {
																				?>
																						<option <?php echo $_GET['lease_rights']['districts'] == $rec_dt['TAMBON_NAME'] ? "selected" : ""; ?> value="<?php echo $rec_dt['TAMBON_NAME']; ?>"><?php echo $rec_dt['TAMBON_NAME']; ?></option>
																				<?php
																					}
																				}
																				?>
																			</select>
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-4">
																			<label for="" class="form-control-label wf-right">สัญญาเช่าเลขที่ </label>
																		</div>
																		<div class="col-xs-12 col-sm-3">
																			<input class="form-control" type="text" name="lease_rights[]" value="<?php echo $_GET['lease_rights'][4] ?>">
																		</div>
																	</div><br>
																</div>
															</div>
														</div>

														<div class="card">
															<div class="header " style=" padding: 10px; height: 50px; border: 3px; display:flex; align-items: center;">
																<label for="shareToggle" style="margin-left: 10px;">
																	<input type="checkbox" id="shareToggle" name="shareToggle" style="transform: scale(1.5);" <?php echo $_GET['shareToggle'] == 'on' ? 'checked' : '';  ?>>
																</label>
																<h5 style="margin-left: 20px;">หุ้น</h5>
															</div>
															<div class="card-body">
																<div id="shareContent">
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">ประเภทหุ้น </label>
																		</div>
																		<div class="col-xs-12 col-sm-4">
																			<?php
																			$sql_stock = "SELECT * FROM M_STOCK_TYPE_MAP";
																			$query_stock = db::query($sql_stock);
																			?>
																			<select name="share[]" id="share[]" class="form-control select2" tabindex="-1">
																				<option value="">ทั้งหมด</option>
																				<?php
																				while ($recSelectstock = db::fetch_array($query_stock)) { ?>
																					<option value="<?= $recSelectstock['STOCK_TYPE_NAME_LAW'] ?>" <?php echo $recSelectstock['STOCK_TYPE_NAME_LAW'] == $_GET['share'][0] ? 'selected' : ' '; ?>><?= $recSelectstock['STOCK_TYPE_NAME_LAW'] ?></option>
																				<?php	} ?>
																			</select>
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">นิติบุคคลผู้ออกหุ้น </label>
																		</div>
																		<div class="col-xs-12 col-sm-3">
																			<input class="form-control" type="text" name="share[]" value="<?php echo $_GET['share'][1] ?>">
																		</div>
																		<div class="col-xs-12 col-sm-4">
																			<?php
																			$sql_per = "SELECT * FROM M_MAP_PER_TYPE";
																			$query_per = db::query($sql_per);
																			?>
																			<select name="share[]" id="share[]" class="form-control select2" tabindex="-1">
																				<option value="">ทั้งหมด</option>
																				<?php
																				while ($recSelectper = db::fetch_array($query_per)) { ?>
																					<option value="<?= $recSelectper['PERSON_TYPE_NAME'] ?>" <?php echo $recSelectper['PERSON_TYPE_NAME'] == $_GET['share'][2] ? 'selected' : ' '; ?>><?= $recSelectper['PERSON_TYPE_NAME'] ?></option>
																				<?php	} ?>
																			</select>
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">หมายเลขตั้งแต่เลขที่ </label>
																		</div>
																		<div class="col-xs-12 col-sm-3">
																			<input class="form-control" type="text" name="share[]" value="<?php echo $_GET['share'][3] ?>">
																		</div>
																		<div class="col-xs-6 col-sm-6">
																			<div class="col-xs-2 col-sm-2">
																				<label for="" class="form-control-label wf-right">ถึง</label>
																			</div>
																			<div class="col-xs-2 col-sm-4">
																				<input class="form-control" type="text" name="share[]" value="<?php echo $_GET['share'][4] ?>">
																			</div>
																		</div>
																	</div><br>
																</div>
															</div>
														</div>

														<div class="card">
															<div class="header " style=" padding: 10px; height: 50px; border: 3px; display:flex; align-items: center;">
																<label for="gun_registrationToggle" style="margin-left: 10px;">
																	<input type="checkbox" id="gun_registrationToggle" name="gun_registrationToggle" style="transform: scale(1.5);" <?php echo $_GET['gun_registrationToggle'] == 'on' ? 'checked' : '';  ?>>
																</label>
																<h5 style="margin-left: 20px;">ปืน</h5>
															</div>
															<div class="card-body">
																<div id="gun_registrationContent">
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">หมายเลขประจำปืน </label>
																		</div>
																		<div class="col-xs-12 col-sm-4">
																			<input class="form-control" type="text" name="gun_registration[]" value="<?php echo $_GET['gun_registration'][0] ?>">
																		</div>
																	</div><br>
																</div>
															</div>
														</div>

														<div class="card">
															<div class="header " style=" padding: 10px; height: 50px; border: 3px; display:flex; align-items: center;">
																<label for="bondToggle" style="margin-left: 10px;">
																	<input type="checkbox" id="bondToggle" name="bondToggle" style="transform: scale(1.5);" <?php echo $_GET['bondToggle'] == 'on' ? 'checked' : '';  ?>>
																</label>
																<h5 style="margin-left: 20px;">พันธบัตร</h5>
															</div>
															<div class="card-body">
																<div id="bondContent">
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">หน่วยงานที่ออกพันธบัตร </label>
																		</div>
																		<div class="col-xs-12 col-sm-3">
																			<input class="form-control" type="text" name="bond[]" value="<?php echo $_GET['bond'][0] ?>">
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">เลขทะเบียน </label>
																		</div>
																		<div class="col-xs-12 col-sm-2">
																			<input class="form-control" type="text" name="bond[]" value="<?php echo $_GET['bond'][1] ?>">
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">พันธบัตรเลขที่ต้น </label>
																		</div>
																		<div class="col-xs-12 col-sm-3">
																			<input class="form-control" type="text" name="bond[]" value="<?php echo $_GET['bond'][2] ?>">
																		</div>
																		<div class="col-xs-6 col-sm-6">
																			<div class="col-xs-2 col-sm-3">
																				<label for="" class="form-control-label wf-right">พันธบัตรเลขที่ท้าย</label>
																			</div>
																			<div class="col-xs-2 col-sm-6">
																				<input class="form-control" type="text" name="bond[]" value="<?php echo $_GET['bond'][3] ?>">
																			</div>
																		</div>
																	</div><br>
																</div>
															</div>
														</div>

														<div class="card">
															<div class="header " style=" padding: 10px; height: 50px; border: 3px; display:flex; align-items: center;">
																<label for="savings_lotteryToggle" style="margin-left: 10px;">
																	<input type="checkbox" id="savings_lotteryToggle" name="savings_lotteryToggle" style="transform: scale(1.5);" <?php echo $_GET['savings_lotteryToggle'] == 'on' ? 'checked' : '';  ?>>
																</label>
																<h5 style="margin-left: 20px;">สลากออมทรัพย์</h5>
															</div>
															<div class="card-body">
																<div id="savings_lotteryContent">
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">หน่วยงานที่ออกสลาก </label>
																		</div>
																		<div class="col-xs-12 col-sm-3">
																			<input class="form-control" type="text" name="savings_lottery[]" value="<?php echo $_GET['savings_lottery'][0] ?>">
																		</div>
																		<div class="col-xs-12 col-sm-4">
																			<?php
																			$sql_lottery = "SELECT * FROM M_SAVE_TYPE_MAP";
																			$query_lottery = db::query($sql_lottery);
																			?>
																			<select name="savings_lottery[]" id="savings_lottery[]" class="form-control select2" tabindex="-1">
																				<option value="">ทั้งหมด</option>
																				<?php
																				while ($recSelectlot = db::fetch_array($query_lottery)) { ?>
																					<option value="<?= $recSelectlot['SAVE_TYPE_NAME_BR'] ?>" <?php echo $recSelectlot['SAVE_TYPE_NAME_BR'] == $_GET['savings_lottery'][1] ? 'selected' : ' '; ?>><?= $recSelectlot['SAVE_TYPE_NAME_BR'] ?></option>
																				<?php	} ?>
																			</select>
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">เลขที่สลากออมทรัพย์ </label>
																		</div>
																		<div class="col-xs-12 col-sm-1">
																			<input class="form-control" type="text" name="savings_lottery[]" value="<?php echo $_GET['savings_lottery'][2] ?>">
																		</div>
																		<div class="col-xs-12 col-sm-2">
																			<input class="form-control" type="text" name="savings_lottery[]" value="<?php echo $_GET['savings_lottery'][3] ?>">
																		</div>
																		<div class="col-xs-12 col-sm-2">
																			<label for="" class="form-control-label wf-right">ถึง </label>
																		</div>
																		<div class="col-xs-12 col-sm-1">
																			<input class="form-control" type="text" name="savings_lottery[]" value="<?php echo $_GET['savings_lottery'][4] ?>">
																		</div>
																		<div class="col-xs-12 col-sm-2">
																			<input class="form-control" type="text" name="savings_lottery[]" value="<?php echo $_GET['savings_lottery'][5] ?>">
																		</div>
																	</div><br>
																</div>
															</div>
														</div>

														<div class="card">
															<div class="header " style=" padding: 10px; height: 50px; border: 3px; display:flex; align-items: center;">
																<label for="carToggle" style="margin-left: 10px;">
																	<input type="checkbox" id="carToggle" name="carToggle" style="transform: scale(1.5);" <?php echo $_GET['carToggle'] == 'on' ? 'checked' : '';  ?>>
																</label>
																<h5 style="margin-left: 20px;">รถ</h5>
															</div>
															<div class="card-body">
																<div id="carContent">
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">ประเภทรถ </label>
																		</div>
																		<div class="col-xs-12 col-sm-4">
																			<?php
																			$sql_car = "SELECT * FROM M_VEHICLE_TYPE_MAP";
																			$query_car = db::query($sql_car);
																			?>
																			<select name="car[0]" id="car" class="form-control select2" tabindex="-1">
																				<option value="">ทั้งหมด</option>
																				<?php
																				while ($recSelectcar = db::fetch_array($query_car)) { ?>
																					<option value="<?= $recSelectcar['VEHICLE_TYPE_NAME_LAW'] ?>" <?php echo $recSelectcar['VEHICLE_TYPE_NAME_LAW'] == $_GET['car'][0] ? 'selected' : ' '; ?>><?= $recSelectcar['VEHICLE_TYPE_NAME_LAW'] ?></option>
																				<?php	} ?>
																			</select>
																		</div>
																	</div>

																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">เลขที่ทะเบียน </label>
																		</div>
																		<div class="col-xs-12 col-sm-1">
																			<input class="form-control" type="text" name="car[]" value="<?php echo $_GET['car'][1] ?>">
																		</div>
																		<div class="col-xs-12 col-sm-2">
																			<input class="form-control" type="text" name="car[]" value="<?php echo $_GET['car'][2] ?>">
																		</div>
																		<div class="col-xs-12 col-sm-1">
																			<label for="" class="form-control-label wf-right">จังหวัด </label>
																		</div>
																		<div class="col-xs-12 col-sm-4">
																			<select name="car[provinces]" id="provinces_car" class="form-control select2" tabindex="-1">
																				<option value="">ทั้งหมด</option>
																				<?php
																				$query_provinces5 = db::query($sql_pro);
																				while ($recSelectPro5 = db::fetch_array($query_provinces5)) { ?>
																					<option value="<?= $recSelectPro5['PROVINCE_CODE'] ?>" <?php echo $recSelectPro5['PROVINCE_CODE'] == $_GET['car']['provinces'] ? 'selected' : ' '; ?>><?= $recSelectPro5['PROVINCE_NAME'] ?></option>
																				<?php	} ?>
																			</select>
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">เลขตัวรถ </label>
																		</div>
																		<div class="col-xs-12 col-sm-3">
																			<input class="form-control" type="text" name="car[]" value="<?php echo $_GET['car'][4] ?>">
																		</div>
																		<div class="col-xs-12 col-sm-1">
																			<label for="" class="form-control-label wf-right">ยี่ห้อรถ </label>
																		</div>
																		<div class="col-xs-12 col-sm-4">
																			<select name="car[]" id="car" class="form-control select2" tabindex="-1">
																				<option value="">ทั้งหมด</option>
																				<option value="Toyota" <?php if (isset($_GET['car'][5]) && $_GET['car'][5] == 'Toyota') echo ' selected'; ?>>Toyota</option>
																				<option value="Isuzu" <?php if (isset($_GET['car'][5]) && $_GET['car'][5] == 'Isuzu') echo ' selected'; ?>>Isuzu</option>
																				<option value="Honda" <?php if (isset($_GET['car'][5]) && $_GET['car'][5] == 'Honda') echo ' selected'; ?>>Honda</option>
																				<option value="Mitsubishi" <?php if (isset($_GET['car'][5]) && $_GET['car'][5] == 'Mitsubishi') echo ' selected'; ?>>Mitsubishi</option>
																				<option value="Nissan" <?php if (isset($_GET['car'][5]) && $_GET['car'][5] == 'Nissan') echo ' selected'; ?>>Nissan</option>
																				<option value="Mazda" <?php if (isset($_GET['car'][5]) && $_GET['car'][5] == 'Mazda') echo ' selected'; ?>>Mazda</option>
																				<option value="Ford" <?php if (isset($_GET['car'][5]) && $_GET['car'][5] == 'Ford') echo ' selected'; ?>>Ford</option>
																			</select>
																		</div>
																	</div><br>
																</div>
															</div>
														</div>

														<div class="card">
															<div class="header " style=" padding: 10px; height: 50px; border: 3px; display:flex; align-items: center;">
																<label for="boatToggle" style="margin-left: 10px;">
																	<input type="checkbox" id="boatToggle" name="boatToggle" style="transform: scale(1.5);" <?php echo $_GET['boatToggle'] == 'on' ? 'checked' : '';  ?>>
																</label>
																<h5 style="margin-left: 20px;">เรือ</h5>
															</div>
															<div class="card-body">
																<div id="boatContent">
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">ทะเบียนเรือ </label>
																		</div>
																		<div class="col-xs-12 col-sm-3">
																			<input class="form-control" type="text" name="boat[]" value="<?php echo $_GET['boat'][0] ?>">
																		</div>
																		<div class="col-xs-12 col-sm-1">
																			<label for="" class="form-control-label wf-right">จังหวัด </label>
																		</div>
																		<div class="col-xs-12 col-sm-3">
																			<select name="boat[provinces]" id="provinces_boat" class="form-control select2" tabindex="-1">
																				<option value="">ทั้งหมด</option>
																				<?php
																				$query_provinces6 = db::query($sql_pro);
																				while ($recSelectPro6 = db::fetch_array($query_provinces6)) { ?>
																					<option value="<?= $recSelectPro6['PROVINCE_CODE'] ?>" <?php echo $recSelectPro6['PROVINCE_CODE'] == $_GET['boat']['provinces'] ? 'selected' : ' '; ?>><?= $recSelectPro6['PROVINCE_NAME'] ?></option>
																				<?php	} ?>
																			</select>
																		</div><br>
																	</div><br>
																</div>
															</div>
														</div>

														<div class="card">
															<div class="header" style=" padding: 10px; height: 50px; border: 3px; display:flex; align-items: center;">
																<label for="machineryToggle" style="margin-left: 10px;">
																	<input type="checkbox" id="machineryToggle" name="machineryToggle" style="transform: scale(1.5);" <?php echo $_GET['machineryToggle'] == 'on' ? 'checked' : '';  ?>>
																</label>
																<h5 style="margin-left: 20px;">เครื่องจักร</h5>
															</div>
															<div class="card-body">
																<div id="machineryContent">
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">ชื่อเครื่องจักร </label>
																		</div>
																		<div class="col-xs-12 col-sm-3">
																			<input class="form-control" type="text" name="machinery[]" value="<?php echo $_GET['machinery'][0] ?>">
																		</div>
																		<div class="col-xs-12 col-sm-2">
																			<label for="" class="form-control-label wf-right">หมายเลขเครื่องจักร </label>
																		</div>
																		<div class="col-xs-12 col-sm-3">
																			<input class="form-control" type="text" name="machinery[]" value="<?php echo $_GET['machinery'][1] ?>">
																		</div>
																	</div><br>
																</div>
															</div>
														</div>

														<div class="card">
															<div class="header" style=" padding: 10px; height: 50px; border: 3px; display:flex; align-items: center;">
																<label for="other_machineryToggle" style="margin-left: 10px;">
																	<input type="checkbox" id="other_machineryToggle" name="other_machineryToggle" style="transform: scale(1.5);" <?php echo $_GET['other_machineryToggle'] == 'on' ? 'checked' : '';  ?>>
																</label>
																<h5 style="margin-left: 20px;">อื่น ๆ เครื่องจักร</h5>
															</div>
															<div class="card-body">
																<div id="other_machineryContent">
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">รายละเอียดทรัพย์ </label>
																		</div>
																		<div class="col-xs-12 col-sm-4">
																			<input class="form-control" type="text" name="other_machinery[]" value="<?php echo $_GET['other_machinery'][0] ?>">
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">ตั้งอยู่ที่เลขที่ </label>
																		</div>
																		<div class="col-xs-12 col-sm-2">
																			<input class="form-control" type="text" name="other_machinery[]" value="<?php echo $_GET['other_machinery'][1] ?>">
																		</div>
																		<div class="col-xs-12 col-sm-2">
																			<label for="" class="form-control-label wf-right">หมู่ที่ </label>
																		</div>
																		<div class="col-xs-12 col-sm-3">
																			<input class="form-control" type="text" name="other_machinery[]" value="<?php echo $_GET['other_machinery'][2] ?>">
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">ซอย </label>
																		</div>
																		<div class="col-xs-12 col-sm-2">
																			<input class="form-control" type="text" name="other_machinery[]" value="<?php echo $_GET['other_machinery'][3] ?>">
																		</div>
																		<div class="col-xs-12 col-sm-2">
																			<label for="" class="form-control-label wf-right">ถนน </label>
																		</div>
																		<div class="col-xs-12 col-sm-3">
																			<input class="form-control" type="text" name="other_machinery[]" value="<?php echo $_GET['other_machinery'][4] ?>">
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">จังหวัด </label>
																		</div>
																		<div class="col-xs-12 col-sm-4">
																			<select name="other_machinery[provinces]" id="provinces_other_machinery" class="form-control select2" tabindex="-1">
																				<option value="">ทั้งหมด</option>
																				<?php
																				$query_provinces7 = db::query($sql_pro);
																				while ($recSelectPro7 = db::fetch_array($query_provinces7)) { ?>
																					<option value="<?= $recSelectPro7['PROVINCE_NAME'] ?>" <?php echo $recSelectPro7['PROVINCE_NAME'] == $_GET['other_machinery']['provinces'] ? 'selected' : ' '; ?>><?= $recSelectPro7['PROVINCE_NAME'] ?></option>
																				<?php	} ?>
																			</select>
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">อำเภอ </label>
																		</div>
																		<div class="col-xs-12 col-sm-4">
																			<select class="form-control select2" name="other_machinery[amphures]" id="amphures_other_machinery">
																				<?php
																				if ($_GET['other_machinery']['amphures'] != "") {

																					$sql_a = "SELECT ID_AMPHUR,AMPHUR_NAME FROM M_G_AMPHUR";
																					$query_mp = db::query($sql_a);
																					while ($rec_amp = db::fetch_array($query_mp)) {
																				?>
																						<option value="<?php echo $rec_amp['AMPHUR_NAME']; ?>" <?php echo $rec_amp['AMPHUR_NAME'] == $_GET['other_machinery']['amphures'] ? "selected" : ""; ?>><?php echo $rec_amp['AMPHUR_NAME']; ?></option>
																				<?php
																					}
																				}
																				?>
																			</select>
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">ตำบล </label>
																		</div>
																		<div class="col-xs-12 col-sm-4">
																			<select class="form-control select2" name="other_machinery[districts]" id="districts_other_machinery">
																				<?php
																				if ($_GET['other_machinery']['districts'] != "") {
																					$sql_d = "SELECT * FROM M_G_TAMBON ";
																					$query_dt = db::query($sql_d);
																					while ($rec_dt = db::fetch_array($query_dt)) {
																				?>
																						<option <?php echo $_GET['other_machinery']['districts'] == $rec_dt['TAMBON_NAME'] ? "selected" : ""; ?> value="<?php echo $rec_dt['TAMBON_NAME']; ?>"><?php echo $rec_dt['TAMBON_NAME']; ?></option>
																				<?php
																					}
																				}
																				?>
																			</select>
																		</div>
																	</div><br>
																</div>
															</div>
														</div>

														<div class="card">
															<div class="header" style=" padding: 10px; height: 50px; border: 3px; display:flex; align-items: center;">
																<label for="property_locationToggle" style="margin-left: 10px;">
																	<input type="checkbox" id="property_locationToggle" name="property_locationToggle" style="transform: scale(1.5);" <?php echo $_GET['property_locationToggle'] == 'on' ? 'checked' : '';  ?>>
																</label>
																<h5 style="margin-left: 20px;">สถานที่ตั้งทรัพย์</h5>
															</div>
															<div class="card-body">
																<div id="property_locationContent">
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">เลขที่ </label>
																		</div>
																		<div class="col-xs-12 col-sm-2">
																			<input class="form-control" type="text" name="property_location[]" value="<?php echo $_GET['property_location'][0] ?>">
																		</div>
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">หมู่ที่ </label>
																		</div>
																		<div class="col-xs-12 col-sm-3">
																			<input class="form-control" type="text" name="property_location[]" value="<?php echo $_GET['property_location'][1] ?>">
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">ซอย </label>
																		</div>
																		<div class="col-xs-12 col-sm-3">
																			<input class="form-control" type="text" name="property_location[]" value="<?php echo $_GET['property_location'][2] ?>">
																		</div>
																		<div class="col-xs-12 col-sm-2">
																			<label for="" class="form-control-label wf-right">ถนน </label>
																		</div>
																		<div class="col-xs-12 col-sm-3">
																			<input class="form-control" type="text" name="property_location[]" value="<?php echo $_GET['property_location'][3] ?>">
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">จังหวัด </label>
																		</div>
																		<div class="col-xs-12 col-sm-4">
																			<select name="property_location[provinces]" id="provinces_property_location" class="form-control select2" tabindex="-1">
																				<option value="">ทั้งหมด</option>
																				<?php
																				$query_provinces8 = db::query($sql_pro);
																				while ($recSelectPro8 = db::fetch_array($query_provinces8)) { ?>
																					<option value="<?= $recSelectPro8['PROVINCE_NAME'] ?>" <?php echo $recSelectPro8['PROVINCE_NAME'] == $_GET['property_location']['provinces'] ? 'selected' : ' '; ?>><?= $recSelectPro8['PROVINCE_NAME'] ?></option>
																				<?php	} ?>
																			</select>
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">อำเภอ </label>
																		</div>
																		<div class="col-xs-12 col-sm-4">
																			<select class="form-control select2" name="property_location[amphures]" id="amphures_property_location">
																				<?php
																				if ($_GET['property_location']['amphures'] != "") {

																					$sql_a = "SELECT AMPHUR_CODE ,AMPHUR_NAME FROM G_AMPHUR";
																					$query_mp = db::query($sql_a);
																					while ($rec_amp = db::fetch_array($query_mp)) {
																				?>
																						<option value="<?php echo $rec_amp['AMPHUR_NAME']; ?>" <?php echo $rec_amp['AMPHUR_NAME'] == $_GET['property_location']['amphures'] ? "selected" : ""; ?>><?php echo $rec_amp['AMPHUR_NAME']; ?></option>
																				<?php
																					}
																				}
																				?>
																			</select>
																		</div>
																	</div>
																	<div class="row" style="margin-top: 10px;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">ตำบล </label>
																		</div>
																		<div class="col-xs-12 col-sm-4">
																			<select class="form-control select2" name="property_location[districts]" id="districts_property_location">
																				<?php
																				if ($_GET['property_location']['districts'] != "") {
																					$sql_d = "SELECT * FROM M_G_TAMBON ";
																					$query_dt = db::query($sql_d);
																					while ($rec_dt = db::fetch_array($query_dt)) {
																				?>
																						<option <?php echo $_GET['property_location']['districts'] == $rec_dt['TAMBON_NAME'] ? "selected" : ""; ?> value="<?php echo $rec_dt['TAMBON_NAME']; ?>"><?php echo $rec_dt['TAMBON_NAME']; ?></option>
																				<?php
																					}
																				}
																				?>
																			</select>
																		</div>
																	</div><br>
																</div>
															</div>
														</div>

														<div class="card">
															<div class="header" style=" padding: 10px; height: 50px; border: 3px; display:flex; align-items: center;">
																<label for="person_inspectsToggle" style="margin-left: 10px;">
																	<input type="checkbox" id="person_inspectsToggle" name="person_inspectsToggle" style="transform: scale(1.5);" <?php echo $_GET['person_inspectsToggle'] == 'on' ? 'checked' : '';  ?>>
																</label>
																<h5 style="margin-left: 20px;">บุคคลที่ตรวจทรัพย์</h5>
															</div>
															<div class="card-body">
																<div id="person_inspectsContent">
																	<div class="row" style="margin-top: 10px;width:100%;">
																		<div class="col-xs-12 col-sm-3">
																			<label for="" class="form-control-label wf-right">ชื่อผู้เกี่ยวข้องในทรัพย์ </label>
																		</div>
																		<div class="col-xs-12 col-sm-2">
																			<input class="form-control" type="text" name="person_inspects[]" value="<?php echo $_GET['person_inspects'][0] ?>">
																		</div>
																		<div class="col-xs-12 col-sm-2">
																			<input class="form-control" type="text" name="person_inspects[]" value="<?php echo $_GET['person_inspects'][1] ?>">
																		</div>
																		<div class="col-xs-12 col-sm-1">
																			<label for="" class="form-control-label wf-right">เลขที่ประจำตัวประชาชน </label>
																		</div>
																		<div class="col-xs-12 col-sm-2">
																			<input class="form-control" type="text" name="person_inspects[]" value="<?php echo $_GET['person_inspects'][2] ?>">
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-12 col-sm-6" align="right">
													<button type="submit" class="btn btn-primary">ค้นหา</button>
												</div>
												<div class="col-xs-12 col-sm-6" align="left">
													<button type="button" class="btn btn-info" onClick="btn_clear();"><i class="fa fa-refresh"></i></button>
												</div>
											</div>
											<hr>
										</div>
									</form>
									<div class="card-block">

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
																				} ?>" data-toggle="tab" href="#<?php echo $sys; ?>" role="tab"><?php echo $sys_name; ?><?php echo  count($array_data_table[$sys]) == 0 ? "" : '<label class="badge bg-danger">' . count($array_data_table[$sys]) . '</label>'; ?></a>
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
																	</thead>
																	<?php

																	if (count($array_data_table[$sys]) > 0) {
																		$a = 1;
																		foreach ($array_data_table[$sys] as $re => $recSelectDataAll) {
																			if ($recSelectDataAll['TYPE_ASSET'] == 'CIVIL') {
																				$SYSTEM_ID = 1;
																			} else if ($recSelectDataAll['TYPE_ASSET'] == 'BANKRUPT') {
																				$SYSTEM_ID = 2;
																			}

																	?>
																			<tr>
																				<div>
																					<td>
																						<div align='center'><?php echo $a; ?></div>
																					</td>
																					<td><?php echo $recSelectDataAll['ASSET_CODE']; ?></td>
																					<td><a onclick="show_asset_detail(<?php echo $recSelectDataAll['ASSET_CODE']; ?>)" href="javascript:void();"><?php echo $recSelectDataAll["PROP_TITLE"]; ?></a></td>
																					<td><?php echo $recSelectDataAll['PROP_STATUS_NAME']; ?></td>
																					<?php

																					$A = ($recSelectDataAll['BLACK_CASE'] != '' && $recSelectDataAll['BLACK_CASE'] != '') ? "/" : "";
																					$B = ($recSelectDataAll['RED_CASE'] != '' && $recSelectDataAll['RED_CASE'] != '') ? "/" : "";

																					?>
																					<td><a onclick="show_detial(
									'<?php echo $recSelectDataAll['PREFIX_BLACK_CASE'] ?>',
									'<?php echo $recSelectDataAll['BLACK_CASE'] ?>',
									'<?php echo $recSelectDataAll['BLACK_YY'] ?>',
									'<?php echo $recSelectDataAll['PREFIX_RED_CASE'] ?>',
									'<?php echo $recSelectDataAll['RED_CASE'] ?>',
									'<?php echo $recSelectDataAll['RED_YY'] ?>',
									'<?php echo $recSelectDataAll['COURT_CODE'] ?>',
									'<?php echo $SYSTEM_ID ?>',
									'<?php echo $recSelectDataAll['REGISTER_CODE'] ?>',
									'<?php echo $recSelectDataAll['SYSTEM_TYPE'] ?>');" href=""> <?php echo $recSelectDataAll['PREFIX_BLACK_CASE'] . $recSelectDataAll['BLACK_CASE'] . $A . $recSelectDataAll['BLACK_YY']; ?></a></td>
																					<td><a onclick="show_detial(
									'<?php echo $recSelectDataAll['PREFIX_BLACK_CASE'] ?>',
									'<?php echo $recSelectDataAll['BLACK_CASE'] ?>',
									'<?php echo $recSelectDataAll['BLACK_YY'] ?>',
									'<?php echo $recSelectDataAll['PREFIX_RED_CASE'] ?>',
									'<?php echo $recSelectDataAll['RED_CASE'] ?>',
									'<?php echo $recSelectDataAll['RED_YY'] ?>',
									'<?php echo $recSelectDataAll['COURT_CODE'] ?>',
									'<?php echo $SYSTEM_ID ?>',
									'<?php echo $recSelectDataAll['REGISTER_CODE'] ?>',
									'<?php echo $recSelectDataAll['SYSTEM_TYPE'] ?>');" href=""> <?php echo $recSelectDataAll['PREFIX_BLACK_CASE'] . $recSelectDataAll['BLACK_CASE'] . $A . $recSelectDataAll['BLACK_YY']; ?></a></td>
																				</div>
																			</tr>
																		<?php
																			$a++;
																			$num_a++;
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
										<!-- Row_end -->
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
	<!-- Modal -->

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
					<button type="button" class="btn btn-danger biz-close-modal" id="dismis_modal" data-number="payrollBizModal">ปิด</button>
				</div>
			</div>
		</div>
	</div>
	<script>
		// ใช้ jQuery เพื่อเปิด/ปิด content โดยใช้ checkbox
		$(document).ready(function() {

			// $('select[name^="car["]').change(function() {
			//     var carType = $(this).val();
			//     var carBrandSelect = $(this).closest('.row').find('select[name^="car["]').eq(5); // เลือกตัวเลือกที่ 2 (car[1])

			//     if (carType !== '') {
			//         $.ajax({
			//             url: 'ajax_provinces.php',
			//             type: 'POST',
			//             data: { 'car[0]': carType }, // ส่งข้อมูลเป็น { 'car[0]': ค่าที่ถูกเลือก }
			//             dataType: 'json',
			//             success: function(response) {
			//                 carBrandSelect.empty();
			//                 carBrandSelect.append('<option value="">ทั้งหมด</option>');
			//                 $.each(response, function(index, brand) {
			//                     carBrandSelect.append('<option value="' + brand + '">' + brand + '</option>');
			//                 });
			//             }
			//         });
			//     } else {
			//         carBrandSelect.empty();
			//         carBrandSelect.append('<option value="">ทั้งหมด</option>');
			//     }
			// });

			$('#searchButton').click(function() {
				$('#proc').val('show');
				$("#searchForm")
					.attr("target", "")
					.attr("action", "")
					.submit();
			});
			let proc = '<?php echo $_GET['proc']; ?>';
			if (proc == 'show') {
				$('#myModal').modal('show');
			} else {
				$('#myModal').modal('hide');
			}
			$('#menuToggel').change(function() {
				if ($('#menuToggel').prop("checked")) {
					$("#displayText").text("ซ้อนแถบค้นหา");
				} else {
					$("#displayText").text("แสดงแถบค้นหา");
				}
			});
			$('#menuToggel').change(function() {
				$('#menuContent').toggle(this.checked);
			});
			$('#close').click(function() {
				$('#myModal').modal('hide');
				btn_clear();
			});
			$('#boatToggle').change(function() {
				$('#boatContent').toggle(this.checked);
			});
			if ('<?php echo $_GET['landToggle']; ?>' == 'on') {
				$('#landContent').toggle(this.checked);
			}
			$('#landToggle').change(function() {
				$('#landContent').toggle(this.checked);
			});
			if ('<?php echo $_GET['buildingToggle']; ?>' == 'on') {
				$('#buildingContent').toggle(this.checked);
			}
			$('#buildingToggle').change(function() {
				$('#buildingContent').toggle(this.checked);
			});
			if ('<?php echo $_GET['condominiumToggle']; ?>' == 'on') {
				$('#condominiumContent').toggle(this.checked);
			}
			$('#condominiumToggle').change(function() {
				$('#condominiumContent').toggle(this.checked);
			});
			if ('<?php echo $_GET['lease_rightsToggle']; ?>' == 'on') {
				$('#lease_rightsContent').toggle(this.checked);
			}
			$('#lease_rightsToggle').change(function() {
				$('#lease_rightsContent').toggle(this.checked);
			});
			if ('<?php echo $_GET['shareToggle']; ?>' == 'on') {
				$('#shareContent').toggle(this.checked);
			}
			$('#shareToggle').change(function() {
				$('#shareContent').toggle(this.checked);
			});
			if ('<?php echo $_GET['gun_registrationToggle']; ?>' == 'on') {
				$('#gun_registrationContent').toggle(this.checked);
			}
			$('#gun_registrationToggle').change(function() {
				$('#gun_registrationContent').toggle(this.checked);
			});
			if ('<?php echo $_GET['bondToggle']; ?>' == 'on') {
				$('#bondContent').toggle(this.checked);
			}
			$('#bondToggle').change(function() {
				$('#bondContent').toggle(this.checked);
			});
			if ('<?php echo $_GET['savings_lotteryToggle']; ?>' == 'on') {
				$('#savings_lotteryContent').toggle(this.checked);
			}
			$('#savings_lotteryToggle').change(function() {
				$('#savings_lotteryContent').toggle(this.checked);
			});
			if ('<?php echo $_GET['carToggle']; ?>' == 'on') {
				$('#carContent').toggle(this.checked);
			}
			$('#carToggle').change(function() {
				$('#carContent').toggle(this.checked);
			});
			if ('<?php echo $_GET['machineryToggle']; ?>' == 'on') {
				$('#machineryContent').toggle(this.checked);
			}
			$('#machineryToggle').change(function() {
				$('#machineryContent').toggle(this.checked);
			});
			if ('<?php echo $_GET['other_machineryToggle']; ?>' == 'on') {
				$('#other_machineryContent').toggle(this.checked);
			}
			$('#other_machineryToggle').change(function() {
				$('#other_machineryContent').toggle(this.checked);
			});
			if ('<?php echo $_GET['property_locationToggle']; ?>' == 'on') {
				$('#property_locationContent').toggle(this.checked);
			}
			$('#property_locationToggle').change(function() {
				$('#property_locationContent').toggle(this.checked);
			});
			if ('<?php echo $_GET['person_inspectsToggle']; ?>' == 'on') {
				$('#person_inspectsContent').toggle(this.checked);
			}
			$('#person_inspectsToggle').change(function() {
				$('#person_inspectsContent').toggle(this.checked);
			});
		});
		// ตั้งค่าเริ่มต้นให้ content ถูกซ่อนไว้
		$('#menuContent').hide();
		$('#boatContent').hide();
		$('#landContent').hide();
		$('#buildingContent').hide();
		$('#condominiumContent').hide();
		$('#lease_rightsContent').hide();
		$('#shareContent').hide();
		$('#gun_registrationContent').hide();
		$('#bondContent').hide();
		$('#savings_lotteryContent').hide();
		$('#carContent').hide();
		$('#machineryContent').hide();
		$('#other_machineryContent').hide();
		$('#property_locationContent').hide();
		$('#person_inspectsContent').hide();
	</script>
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
			window.location = 'http://103.208.27.224:81/led_service_api/public/search_data_assets_type.php'

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

		function action_from(REGISTERCODE, sh1, prefixBlackCase, blackCase, blackYy, prefixRedCase, redCase, redYy, CourtCode, courtName, concernName, fullName) {
			let PCC_CIVIL_GEN = '<?php echo $_GET['PCC_CIVIL_GEN']; ?>'
			let url = "./cmd_add_from.php?";
			url += "&REGISTERCODE=" + REGISTERCODE;
			url += "&PCC_CIVIL_GEN=" + PCC_CIVIL_GEN;
			url += "&SEND_FROM=" + 'CIVIL';
			url += "&receive_case=" + sh1;

			url += "&receive_prefixBlackCase=" + prefixBlackCase;
			url += "&receive_blackCase=" + blackCase;
			url += "&receive_blackYy=" + blackYy;

			url += "&receive_prefixRedCase=" + prefixRedCase;
			url += "&receive_redCase=" + redCase;
			url += "&receive_redYy=" + redYy;

			url += "&receive_CourtCode=" + CourtCode;
			url += "&receive_courtName=" + courtName;
			url += "&receive_concernName=" + concernName;
			url += "&receive_fullName=" + fullName;
			url += "&TO_PERSON_ID=" + '<?php echo $_GET['TO_PERSON_ID']; ?>'
			url += "&proc=" + 'search_data_add';
			window.open(url, 'Image', 'width=1000px.stylewidth,height=1000px.style.height,resizable=1');
		}
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript">
		<?php foreach ($search_data as $ah1 => $bh1) { ?>
			$('#provinces_<?php echo $ah1; ?>').change(function() {
				var PROVINCE_NAME = $(this).val();

				$.ajax({
					type: "POST",
					url: "ajax_provinces.php",
					data: {
						PROVINCE_NAME: PROVINCE_NAME,
						function: 'provinces'
					},
					success: function(data) {
						$('#amphures_<?php echo $ah1; ?>').html(data);
						$('#districts_<?php echo $ah1; ?>').html(' ');
						$('#districts_<?php echo $ah1; ?>').val(' ');
						$('#zip_code').val(' ');
						//console.log(data);
					}
				});
			});


			$('#amphures_<?php echo $ah1; ?>').change(function() {
				var AMPHUR_NAME = $(this).val();
				$.ajax({
					type: "POST",
					url: "ajax_provinces.php",
					data: {
						AMPHUR_NAME: AMPHUR_NAME,
						function: 'amphures'
					},
					success: function(data) {
						$('#districts_<?php echo $ah1; ?>').html(data);
					}
				});
			});
		<?php } ?>
		//    $('#districts').change(function() {
		//     var id_districts= $(this).val();

		//       $.ajax({
		//       type: "POST",
		//       url: "ajax_provinces.php",
		//       data: {AMPHUR_CODE:id_districts,function:'districts'},
		//       success: function(data){
		//           $('#zip_code').val(data)
		//       }
		//     });

		//   });
	</script>
	<?php
	include '../include/combottom_js_user.php';
	include '../include/combottom_user.php'; ?>