<?php
/* session_start(); */
$_SESSION["WF_USER_ID"] = "-1";
$_REQUEST['wfp'] = "WNzNrMmw0ZTR3NDA1ZzRhNHI0bzRmM3E1aTRwNHEzdzNiMjM0eTJ1Mm8zaTNvMw==";
include '../include/comtop_public.php';

foreach ($_GET as $key => $val) {
	$$key = conText($val);
}
foreach ($_POST as $key => $val) {
	$$key = conText($val);
}
$wf_limit = $_GET['wf_limit'] == "" ? 20 : $_GET['wf_limit'];

$tab_active = $_GET['tab_active'];
if ($tab_active == "") {
	$tab_active = 1;
}

$S_SYSTEM_READ_STATUS = ($S_SYSTEM_READ_STATUS == "") ? 1 : 2;

// print_pre($_POST);

if ($SEND_FROM == 1) {

	getCivilToWh($PCC_CIVIL_GEN);

	$sqlSelectData = "	SELECT 	CIVIL_CODE,
								COURT_CODE,
								PREFIX_BLACK_CASE,BLACK_CASE,BLACK_YY,
								PREFIX_RED_CASE,RED_CASE,RED_YY,
								PLAINTIFF1,DEFFENDANT1,PCC_CASE_GEN
						FROM 	WH_CIVIL_CASE
						WHERE 	CIVIL_CODE = '" . $PCC_CIVIL_GEN . "'";
	$querySelectData = db::query($sqlSelectData);
	$dataSelectData = db::fetch_array($querySelectData);
	if ($dataSelectData["CIVIL_CODE"] == "") {
		//getCivilToWh($PCC_CIVIL_GEN);

		$sqlSelectData = "	SELECT 	CIVIL_CODE,
									COURT_CODE,
									PREFIX_BLACK_CASE,BLACK_CASE,BLACK_YY,
									PREFIX_RED_CASE,RED_CASE,RED_YY,
									PLAINTIFF1,DEFFENDANT1,PCC_CASE_GEN
							FROM 	WH_CIVIL_CASE
							WHERE 	CIVIL_CODE = '" . $PCC_CIVIL_GEN . "'";
		$querySelectData = db::query($sqlSelectData);
		$dataSelectData = db::fetch_array($querySelectData);
	}

	$text_param  = "";

	//ต้นทาง
	$text_param .= "GET_S_PREFIX_CASE_BLACK=" . $dataSelectData["PREFIX_BLACK_CASE"];
	$text_param .= "&GET_S_CASE_BLACK=" . $dataSelectData["BLACK_CASE"];
	$text_param .= "&GET_S_CASE_BLACK_YEAR=" . $dataSelectData["BLACK_YY"];
	$text_param .= "&GET_S_PREFIX_CASE_RED=" . $dataSelectData["PREFIX_RED_CASE"];
	$text_param .= "&GET_S_CASE_RED=" . $dataSelectData["RED_CASE"];
	$text_param .= "&GET_S_CASE_RED_YEAR=" . $dataSelectData["RED_YY"];
	$text_param .= "&GET_S_COURT_CODE=" . $dataSelectData["COURT_CODE"];
	$text_param .= "&GET_S_SYSTEM_ID=1";
	$text_param .= "&SEND_TO=1";
	$text_param .= "&TO_PERSON_ID=" . $TO_PERSON_ID;
	$text_param .= "&GET_PLAINTIFF=" . $dataSelectData["PLAINTIFF1"];
	$text_param .= "&GET_DEFENDANT=" . $dataSelectData["DEFFENDANT1"];

	//ปลายทาง
	$text_param .= "&GET_T_PREFIX_CASE_BLACK=" . $TO_PREFIX_BLACK_CASE;
	$text_param .= "&GET_T_CASE_BLACK=" . $TO_BLACK_CASE;
	$text_param .= "&GET_T_CASE_BLACK_YEAR=" . $TO_BLACK_YY;
	$text_param .= "&GET_T_PREFIX_CASE_RED=" . $TO_PREFIX_RED_CASE;
	$text_param .= "&GET_T_CASE_RED=" . $TO_RED_CASE;
	$text_param .= "&GET_T_CASE_RED_YEAR=" . $TO_RED_YY;
	$text_param .= "&GET_T_COURT_CODE=" . $TO_COURT_CODE;
	$text_param .= "&GET_T_SYSTEM_ID=" . $SEND_TO;
	$text_param .= "&ID_CARD=" . $CARD_ID;
	$text_param .= "&PCC_CASE_GEN=" . $dataSelectData["PCC_CASE_GEN"];
} else {

	$text_param = "";
	if (count($_GET) > 0) {
		foreach ($_GET as $key => $val) {
			$text_param .= $key . "=" . $val . "&";
		}
	}
	if (count($_POST) > 0) {
		foreach ($_POST as $key => $val) {
			$text_param .= $key . "=" . $val . "&";
		}
	}
	$text_param = substr($text_param, 0, -1);
}
?>
<div class="content-wrapper">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<div class="row" id="animationSandbox">
			<div class="col-sm-12">
				<div class="main-header">
					<div class="f-right">
						<a class="btn btn-primary active waves-effect waves-light" href="show_cmd_form.php?<?php echo $text_param; ?>&proc=add" role="button" title="<?php if ($rec_main["WF_BTN_ADD_RESIZE"] == 'Y') {
																																											echo $WF_TEXT_MAIN_ADD;
																																										} ?>"><i class="icofont icofont-ui-add"></i> <?php if ($rec_main["WF_BTN_ADD_RESIZE"] != 'Y') {
																																																							echo $WF_TEXT_MAIN_ADD;
																																																						} ?></a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div id="wf_space" class="card-header">
						<form method="get" id="form_wf_search" name="form_wf_search" action="#">
							<input type="hidden" name="process" id="process" value="">
							<input type="hidden" name="wf_page" id="wf_page" value="<?php echo $_GET["wf_page"]; ?>">
							<input type="hidden" name="tab_active" id="tab_active" value="<?php echo $_GET["tab_active"]; ?>">

							<?php

							if (count($_GET) > 0) {
								foreach ($_GET as $key => $val) {
									if ($T_BLACK_CASE == "" && $key == "GET_S_PREFIX_CASE_BLACK") {
										$T_BLACK_CASE = $val;
									}
									if ($BLACK_CASE == "" && $key == "GET_S_CASE_BLACK") {
										$BLACK_CASE = $val;
									}
									if ($BLACK_YY == "" && $key == "GET_S_CASE_BLACK_YEAR") {
										$BLACK_YY = $val;
									}
									if ($T_RED_CASE == "" && $key == "GET_S_PREFIX_CASE_RED") {
										$T_RED_CASE = $val;
									}
									if ($RED_CASE == "" && $key == "GET_S_CASE_RED") {
										$RED_CASE = $val;
									}
									if ($RED_YY == "" && $key == "GET_S_CASE_RED_YEAR") {
										$RED_YY = $val;
									}
							?>
									<input type="hidden" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo $val; ?>">
								<?php
								}
							}
							if (count($_POST) > 0) {
								foreach ($_POST as $key => $val) {
									if ($T_BLACK_CASE == "" && $key == "GET_S_PREFIX_CASE_BLACK") {
										$T_BLACK_CASE = $val;
									}
									if ($BLACK_CASE == "" && $key == "GET_S_CASE_BLACK") {
										$BLACK_CASE = $val;
									}
									if ($BLACK_YY == "" && $key == "GET_S_CASE_BLACK_YEAR") {
										$BLACK_YY = $val;
									}
									if ($T_RED_CASE == "" && $key == "GET_S_PREFIX_CASE_RED") {
										$T_RED_CASE = $val;
									}
									if ($RED_CASE == "" && $key == "GET_S_CASE_RED") {
										$RED_CASE = $val;
									}
									if ($RED_YY == "" && $key == "GET_S_CASE_RED_YEAR") {
										$RED_YY = $val;
									}
								?>
									<input type="hidden" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo $val; ?>">
							<?php
								}
							}
							?>

							<div class="form-group row">
								<div id="BLACK_CASE_BSF_AREA" class="col-md-2 ">
									<label for="BLACK_CASE" class="form-control-label wf-right">หมายเลขคดีดำ</label>
								</div>
								<div id="T_BLACK_CASE_BSF_AREA" class="col-md-1 wf-left">
									<input type="text" name="T_BLACK_CASE" id="T_BLACK_CASE" class="form-control" value="<?php echo $T_BLACK_CASE; ?>">
									<small id="DUP_T_BLACK_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
								</div>
								<div id="BLACK_CASE_BSF_AREA" class="col-md-1 wf-left">
									<input type="text" name="BLACK_CASE" id="BLACK_CASE" class="form-control" value="<?php echo $BLACK_CASE; ?>">
									<small id="DUP_BLACK_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
								</div>
								<div id="BLACK_YY_BSF_AREA" class="col-md-1 wf-left">
									<div class="row">
										<div id="" class="col-md-1 wf-left">
											ปี
										</div>
										<div id="" class="col-md-5 wf-left">
											<input type="text" name="BLACK_YY" id="BLACK_YY" class="form-control" value="<?php echo $BLACK_YY; ?>">
											<small id="DUP_BLACK_YY_ALERT" class="form-text text-danger" style="display:none"></small>
										</div>
									</div>
								</div>

								<div id="RED_CASE_BSF_AREA" class="col-md-2 ">
									<label for="RED_CASE" class="form-control-label wf-right">หมายเลขคดีแดง</label>
								</div>
								<div id="T_RED_CASE_BSF_AREA" class="col-md-1 wf-left">
									<input type="text" name="T_RED_CASE" id="T_RED_CASE" class="form-control" value="<?php echo $T_RED_CASE; ?>">
									<small id="DUPT_RED_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
								</div>
								<div id="RED_CASE_BSF_AREA" class="col-md-1 wf-left">
									<input type="text" name="RED_CASE" id="RED_CASE" class="form-control" value="<?php echo $RED_CASE; ?>">
									<small id="DUP_RED_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
								</div>
								<div id="RED_YY_BSF_AREA" class="col-md-2 wf-left">
									<div class="row">
										<div id="RED_YY_BSF_AREA" class="col-md-1 wf-left">
											ปี
										</div>
										<div id="RED_YY_BSF_AREA" class="col-md-5 wf-left">
											<input type="text" name="RED_YY" id="RED_YY" class="form-control" value="<?php echo $RED_YY; ?>">
											<small id="DUP_RED_YY_ALERT" class="form-text text-danger" style="display:none"></small>
										</div>
									</div>
								</div>

							</div>
							<div class="form-group row">
								<div id="CASE_TYPE_BSF_AREA" class="col-md-2 ">
									<label for="CMD_TYPE" class="form-control-label wf-right">สถานะคำสั่ง</label>
								</div>
								<div class="col-md-2 wf-left">
									<select name="S_COM_STATUS" id="S_COM_STATUS" class="form-control select2" tabindex="-1">
										<option value="1" <?php echo $_GET["S_COM_STATUS"] == 1 ? "selected" : ""; ?>>คำสั่งเข้าใหม่</option>
										<option value="2" <?php echo $_GET["S_COM_STATUS"] == 2 ? "selected" : ""; ?>>ทั้งหมด</option>
									</select>
								</div>
								<div class="col-md-1 wf-left"></div>
								<div id="CASE_TYPE_BSF_AREA" class="col-md-2 ">
									<label for="CMD_TYPE" class="form-control-label wf-right">การแสดงข้อมูล</label>
								</div>
								<div class="col-md-2 wf-left">
									<select name="S_SYSTEM_READ_STATUS" id="S_SYSTEM_READ_STATUS" class="form-control select2" tabindex="-1">
										<option value="1" <?php echo $S_SYSTEM_READ_STATUS == 1 ? "selected" : ""; ?>>ที่ยังไม่ได้อ่าน</option>
										<option value="2" <?php echo $S_SYSTEM_READ_STATUS == 2 ? "selected" : ""; ?>>ทั้งหมด</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12 text-center">
									<button type="submit" name="wf_search" id="wf_search" class="btn btn-primary"> ค้นหา</button>&nbsp;&nbsp;
								</div>
							</div>

							<!--<ul class="nav nav-tabs  tabs" role="tablist">
								<li class="nav-item"><a class="nav-link <?php echo ($tab_active == 1) ? "active" : ""; ?>" data-toggle="tab" href="javascript:void(0)" onClick="changeSubmit(1);" role="tab">คำสั่งเข้า</a></li>
								<li class="nav-item"><a class="nav-link <?php echo ($tab_active == 2) ? "active" : ""; ?>" data-toggle="tab" href="javascript:void(0)" onClick="changeSubmit(2);" role="tab">คำสั่งออก </a></li>
							</ul>-->
							<div class="table-responsive">
								<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
									<thead class="bg-primary">
										<tr class="bg-primary">
											<th style="width: 5%;" class="text-center">ลำดับ</th>
											<th style="width: 7%;" class="text-center">วันที่/เวลา</th>
											<th style="width: 20%;" class="text-center">คำสั่งเจ้าพนักงาน</th>
											<th style="width: 7%;" class="text-center">ประเภท</th>
											<th style="width: 10%;" class="text-center">ระบบงานต้นทาง</th>
											<th style="width: 10%;" class="text-center">ระบบงานปลายทาง</th>
											<th style="width: 10%;" class="text-center">ศาล</th>
											<th style="width: 7%;" class="text-center">หมายเลขคดีดำ</th>
											<th style="width: 7%;" class="text-center">หมายเลขคดีแดง</th>
											<th style="width: 10%;" class="text-center">เอกสารแนบ</th>
											<th style="width: 7%;" class="text-center">สถานะ</th>
											<th style="width: 10%;" class="text-center">จัดการ</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$filterCom = "";
										$orderBy = "";

										if ($_GET["GET_S_PREFIX_CASE_BLACK"] != "" && $_GET["GET_T_PREFIX_CASE_BLACK"]) {
											//จากระบบต้นทางไปหาระบบอื่นๆ
											$filterCom .= " AND ((T_BLACK_CASE = '" . $_GET["GET_S_PREFIX_CASE_BLACK"] . "'";
											$filterCom .= " AND BLACK_CASE = '" . $_GET["GET_S_CASE_BLACK"] . "'";
											$filterCom .= " AND BLACK_YY = '" . $_GET["GET_S_CASE_BLACK_YEAR"] . "'";
											if (trim($_GET["GET_S_PREFIX_CASE_RED"]) != "") {
												$filterCom .= " AND T_RED_CASE = '" . $_GET["GET_S_PREFIX_CASE_RED"] . "'";
											}
											$filterCom .= " AND RED_CASE = '" . $_GET["GET_S_CASE_RED"] . "'";
											$filterCom .= " AND RED_YY = '" . $_GET["GET_S_CASE_RED_YEAR"] . "'";

											$filterCom .= " AND TO_T_BLACK_CASE = '" . $_GET["GET_T_PREFIX_CASE_BLACK"] . "'";
											$filterCom .= " AND TO_BLACK_CASE = '" . $_GET["GET_T_CASE_BLACK"] . "'";
											$filterCom .= " AND TO_BLACK_YY = '" . $_GET["GET_T_CASE_BLACK_YEAR"] . "'";
											if (trim($_GET["GET_T_PREFIX_CASE_RED"]) != "") {
												$filterCom .= " AND TO_T_RED_CASE = '" . $_GET["GET_T_PREFIX_CASE_RED"] . "'";
											}
											$filterCom .= " AND TO_RED_CASE = '" . $_GET["GET_T_CASE_RED"] . "'";
											$filterCom .= " AND TO_RED_YY = '" . $_GET["GET_T_CASE_RED_YEAR"] . "') or ";

											//จากระบบอื่นเข้ามาที่ระบบต้นทาง
											$filterCom .= " (T_BLACK_CASE = '" . $_GET["GET_T_PREFIX_CASE_BLACK"] . "'";
											$filterCom .= " AND BLACK_CASE = '" . $_GET["GET_T_CASE_BLACK"] . "'";
											$filterCom .= " AND BLACK_YY = '" . $_GET["GET_T_CASE_BLACK_YEAR"] . "'";
											if (trim($_GET["GET_T_PREFIX_CASE_RED"]) != "") {
												$filterCom .= " AND T_RED_CASE = '" . $_GET["GET_T_PREFIX_CASE_RED"] . "'";
											}
											$filterCom .= " AND RED_CASE = '" . $_GET["GET_T_CASE_RED"] . "'";
											$filterCom .= " AND RED_YY = '" . $_GET["GET_T_CASE_RED_YEAR"] . "'";

											$filterCom .= " AND TO_T_BLACK_CASE = '" . $_GET["GET_S_PREFIX_CASE_BLACK"] . "'";
											$filterCom .= " AND TO_BLACK_CASE = '" . $_GET["GET_S_CASE_BLACK"] . "'";
											$filterCom .= " AND TO_BLACK_YY = '" . $_GET["GET_S_CASE_BLACK_YEAR"] . "'";
											if (trim($_GET["GET_S_PREFIX_CASE_RED"]) != "") {
												$filterCom .= " AND TO_T_RED_CASE = '" . $_GET["GET_S_PREFIX_CASE_RED"] . "'";
											}
											$filterCom .= " AND TO_RED_CASE = '" . $_GET["GET_S_CASE_RED"] . "'";
											$filterCom .= " AND TO_RED_YY = '" . $_GET["GET_S_CASE_RED_YEAR"] . "') ) ";
										} else {
											if ($T_BLACK_CASE != "") {
												$filterCom .= " AND (T_BLACK_CASE = '" . $T_BLACK_CASE . "' or TO_T_BLACK_CASE = '" . $T_BLACK_CASE . "')";
											}
											if ($BLACK_CASE != "") {
												$filterCom .= " AND (BLACK_CASE = '" . $BLACK_CASE . "'  or TO_BLACK_CASE = '" . $BLACK_CASE . "')";
											}
											if ($BLACK_YY != "") {
												$filterCom .= " AND (BLACK_YY = '" . $BLACK_YY . "'  or TO_BLACK_YY = '" . $BLACK_YY . "')";
											}
											if (trim($T_RED_CASE) != "") {
												$filterCom .= " AND (T_RED_CASE = '" . $T_RED_CASE . "'  or TO_T_RED_CASE = '" . $T_RED_CASE . "')";
											}
											if (trim($RED_CASE) != "") {
												$filterCom .= " AND (RED_CASE = '" . $RED_CASE . "'  or TO_RED_CASE = '" . $RED_CASE . "')";
											}
											if (trim($RED_YY) != "") {
												$filterCom .= " AND (RED_YY = '" . $RED_YY . "'  or TO_RED_YY = '" . $RED_YY . "')";
											}
										}

										if ($S_SYSTEM_READ_STATUS == 1) {
											$filterCom .= " AND NVL(SYSTEM_READ_STATUS,'N')= 'N' ";
										}



										$sqlSelectData = "	SELECT 		TRANSACTION_APPROVE_PERSON,TRANSACTION_STATUS_APP,A.APPROVE_STATUS,A.APPROVE_PERSON,A.ID,CMD_READ_STATUS,CMD_DOC_DATE,CMD_DOC_TIME,CMD_TYPE_NAME,C.FLAG_CMD_NOTI,SERVICE_SYS_NAME,TO_COURT_NAME,A.ID,T_BLACK_CASE,BLACK_CASE,BLACK_YY,T_RED_CASE,RED_CASE,RED_YY,CMD_NOTE,CMD_GRP_NAME ,ALERT_NOTI,SEND_TO,TO_T_BLACK_CASE,TO_BLACK_CASE,TO_BLACK_YY,TO_T_RED_CASE,TO_RED_CASE,TO_RED_YY,CMD_NOTE
																		FROM		M_DOC_CMD A
																		LEFT JOIN 	M_CMD_SYSTEM B ON A.SYS_NAME = B.CMD_SYSTEM_ID
																		LEFT JOIN 	M_SERVICE_CMD C ON A.CASE_TYPE = C.CMD_TYPE_CODE
																		LEFT JOIN 	M_CMD_PERSON D ON D.PERSON_ID = A.PERSON_ID
																		LEFT JOIN 	M_CMD_TYPE E ON C.CMD_TYPE_ID = E.CMD_TYPE_ID 
																		WHERE		1=1 AND 
																					(
																					(A.SEND_TO = '" . $_GET["SEND_TO"] . "' and (A.TO_PERSON_ID = '" . $_GET["TO_PERSON_ID"] . "' or A.TRANSACTION_APPROVE_PERSON = '" . $_GET["TO_PERSON_ID"] . "')) 
																					 OR 
																					 (A.SYS_NAME = '" . $_GET["SEND_TO"] . "' AND ( A.OFFICE_IDCARD = '" . $_GET["TO_PERSON_ID"] . "' OR APPROVE_PERSON = '" . $_GET["TO_PERSON_ID"] . "' or A.OFFICE_IDCARD is null ))
																					 OR A.ID in (SELECT REF_ID FROM M_DOC_CMD AA WHERE ( A.OFFICE_IDCARD = '" . $_GET["TO_PERSON_ID"] . "' OR APPROVE_PERSON = '" . $_GET["TO_PERSON_ID"] . "'))
																					 )
																					 AND NVL(REF_ID,0) = 0
																					 {$filterCom}
																		ORDER BY	CMD_DOC_DATE DESC,CMD_DOC_TIME DESC
																					";

										//echo $sqlSelectData;
										$i = 1;

										$querySelectData = db::query($sqlSelectData);
										while ($dataSelectData = db::fetch_array($querySelectData)) {

										?>
											<tr style="background-color: #E6E6FA;">
												<td align="center">
													<?php echo $i; ?>
													<?php
													if ($tab_active == 1) {
														if ($dataSelectData["CMD_READ_STATUS"] == 0) {
													?>
															<img src="icon_img_new.png" width="30px;">
														<?php
														} else {
														?>
															<img src="icon_img_read.png" width="30px;">
													<?php
														}
													}
													?>
												</td>
												<td><?php echo db2date($dataSelectData["CMD_DOC_DATE"]) . " " . substr($dataSelectData["CMD_DOC_TIME"], 0, 5); ?></td>
												<td>
													<?php
													if ($dataSelectData["ALERT_NOTI"] == 1) {
													?>
														<img src="Alert.gif" width="30px;">
													<?php
													}
													echo $dataSelectData["CMD_NOTE"];
													/*echo $dataSelectData["CMD_TYPE_NAME"];
													if($dataSelectData["ALERT_NOTI"]==1){
														echo "<br> <strong><font color=\"red\">โดยมีรายละเอียดทรัพย์ดังต่อไปนี้</font></strong><br>";
														
														$sqlSelectCountAsset 	= "select count(1) as COUNT_ASSET from M_CMD_ASSET where CMD_ID = ".$dataSelectData['ID']." ";
														$querySelectCountAsset 	= db::query($sqlSelectCountAsset);
														$recSelectCountAsset 	= db::fetch_array($querySelectCountAsset);
														
														$sqlSelectCmdAsset 		= "select * from M_CMD_ASSET where CMD_ID = ".$dataSelectData['ID']." and ROWNUM <= 2";
														$querySelectCmdAsset 	= db::query($sqlSelectCmdAsset);
														$i_asset = 1;
														while($recSelectCmdAsset = db::fetch_array($querySelectCmdAsset)){
															echo $i_asset.".".$recSelectCmdAsset["PROP_DET"]." <a href=\"javascript:viod(0)\" onClick=\"showAssetComList(".$recSelectCmdAsset["ASSET_ID"].",'".$_GET["TO_PERSON_ID"]."')\" class=\"btn btn-success btn-mini\" title=\"\"><i class=\"icofont icofont-search\">คำสั่ง</i></a><br>";
															echo "<hr>";
															$i_asset++;
														}
														if($recSelectCountAsset["COUNT_ASSET"]>2){
															echo "* มีรายการทรัพย์เพิ่มเติมสามารถดูได้จากปุ่มรายละเอียด *";
														}
													}*/
													?>
												</td>
												<td align="center">
													<?php
													$update_view = "";
													if ($dataSelectData["SEND_TO"] == $_GET["SEND_TO"]) {
														echo "ขาเข้า";
														$update_view = "Y";
													} else {
														echo "ขาออก";
													}
													?>
												</td>
												<td><?php echo $dataSelectData["SERVICE_SYS_NAME"]; ?></td>
												<td><?php echo getsystemName($dataSelectData["SEND_TO"]); ?></td>
												<td align="center"><?php echo $dataSelectData["TO_COURT_NAME"]; ?></td>
												<td align="center"><?php echo $dataSelectData["TO_T_BLACK_CASE"] . $dataSelectData["TO_BLACK_CASE"] . "/" . $dataSelectData["TO_BLACK_YY"]; ?></td>
												<td align="center"><?php echo $dataSelectData["TO_T_RED_CASE"] . $dataSelectData["TO_RED_CASE"] . "/" . $dataSelectData["TO_RED_YY"]; ?></td>
												<td>
													<?php
													$sqlFile = "	SELECT 		DF.FILE_SAVE_NAME,
																			DF.FILE_NAME
																FROM 		FRM_CMD_FILE A
																LEFT JOIN 	WF_FILE DF ON DF.WFR_ID = A.F_ID AND DF.WF_MAIN_ID = '109'
																WHERE 		A.WF_MAIN_ID = '110' AND
																			(A.WFR_ID = '" . $dataSelectData['ID'] . "' OR A.F_TEMP_ID = '" . $dataSelectData['ID'] . "')
																ORDER BY 	A.F_ID ASC
																";
													$queryFile = db::query($sqlFile);
													$i_file = 0;
													while ($recFile = db::fetch_array($queryFile)) {
													?>
														<li>
															<a href="../attach/w109/<?php echo $recFile['FILE_SAVE_NAME']; ?>" target="_blank">
																<?php echo $recFile['FILE_NAME']; ?>
															</a>
														</li>
													<?php
													}
													?>
												</td>
												<td align="center">
													<?php
													if ($dataSelectData["FLAG_CMD_NOTI"] == 'Y') {
														echo "ส่งแจ้งแล้ว";
													} else {
														if ($dataSelectData["SEND_TO"] == $_GET["SEND_TO"]) {
															$sqlSelectCountSend = "select count(1) as COUNT_DATA from M_DOC_CMD where NVL(REF_ID,0) = " . $dataSelectData['ID'] . "";
															$querySelectCountSend = db::query($sqlSelectCountSend);
															$dataSelectDataSub = db::fetch_array($querySelectCountSend);
															if ($dataSelectDataSub["COUNT_DATA"] > 0) {
																echo "ตอบกลับเเล้ว";
															} else {
																echo "รอตอบกลับ";
															}
														} else {
															if ($dataSelectData["APPROVE_STATUS"] == 0) {
																echo "รออนุมัติ";
															} else if ($dataSelectData["APPROVE_STATUS"] == 2) {
																echo "ส่งกลับแก้ไข";
															} else {
																echo "อนุมัติเเล้ว";
															}
														}
													}
													?>
												</td>
												<td align="center">
													<?php
													if ($dataSelectData["APPROVE_STATUS"] == 2 || $dataSelectData["APPROVE_STATUS"] == 0) {
													?>
														<a href="show_cmd_form.php?ID=<?php echo $dataSelectData["ID"] ?>&proc=edit&TO_PERSON_ID=<?php echo $_GET["TO_PERSON_ID"]; ?>&SEND_TO=<?php echo $_GET["SEND_TO"] ?>" class="btn btn-success btn-mini" title=""> <i class="icofont icofont-ui-edit"></i> แก้ไข </a>
														<a href="#!" class="btn btn-danger btn-mini" title="" onclick="delete_cmd('<?php echo $dataSelectData["ID"] ?>')">
															<i class="icofont icofont-trash"></i> ลบ
														</a>
													<?php

													}
													?>
													<a href="cmd_view.php?ID=<?php echo $dataSelectData["ID"] ?>&update_view=<?php echo $update_view; ?>&TO_PERSON_ID=<?php echo $_GET["TO_PERSON_ID"]; ?>&SEND_TO=<?php echo $_GET["SEND_TO"] ?>" target="_blank" class="btn btn-info btn-mini" title="">
														<i class="icofont icofont-search"></i> ดูรายละเอียด
													</a>
													<?php
													if ($dataSelectData["APPROVE_PERSON"] == $_GET["TO_PERSON_ID"] && $dataSelectData["APPROVE_STATUS"] == 0) {
													?>
														<a href="cmd_view.php?ID=<?php echo $dataSelectData["ID"] ?>&approve=Y&TO_PERSON_ID=<?php echo $_GET["TO_PERSON_ID"]; ?>&SEND_TO=<?php echo $_GET["SEND_TO"]; ?>" target="_blank" class="btn btn-success btn-mini" title="">
															<i class="icofont icofont-search"></i> อนุมัติ
														</a>
													<?php
													}
													//if ($dataSelectData["TRANSACTION_APPROVE_PERSON"] == $_GET["TO_PERSON_ID"] && $dataSelectData["TRANSACTION_STATUS_APP"] == 0) {
													?>
													<a href="cmd_view.php?ID=<?php echo $dataSelectData["ID"] ?>&approve2=Y&TO_PERSON_ID=<?php echo $_GET["TO_PERSON_ID"]; ?>&SEND_TO=<?php echo $_GET["SEND_TO"]; ?>" target="_blank" class="btn btn-success btn-mini" title="">
														<i class="icofont icofont-search"></i> รับทราบ
													</a>
													<?php
													//}
													?>
													<a href="print_doc_cmd_form.php?ID=<?php echo $dataSelectData["ID"] ?>" target="_blank" class="btn btn-warning btn-mini" title="">
														<i class="icofont icofont-print"></i> พิมพ์
													</a>
												</td>
											</tr>
											<?php

											$sqlSelectDataSub = "	SELECT 		TRANSACTION_APPROVE_PERSON,TRANSACTION_STATUS_APP,A.APPROVE_STATUS,A.APPROVE_PERSON,A.ID,CMD_READ_STATUS,CMD_DOC_DATE,CMD_DOC_TIME,CMD_TYPE_NAME,C.FLAG_CMD_NOTI,SERVICE_SYS_NAME,TO_COURT_NAME,A.ID,T_BLACK_CASE,BLACK_CASE,BLACK_YY,T_RED_CASE,RED_CASE,RED_YY,CMD_NOTE,CMD_GRP_NAME ,ALERT_NOTI,SEND_TO,TO_T_BLACK_CASE,TO_BLACK_CASE,TO_BLACK_YY,TO_T_RED_CASE,TO_RED_CASE,TO_RED_YY,CMD_NOTE
																	FROM		M_DOC_CMD A
																	LEFT JOIN 	M_CMD_SYSTEM B ON A.SYS_NAME = B.CMD_SYSTEM_ID
																	LEFT JOIN 	M_SERVICE_CMD C ON A.CASE_TYPE = C.CMD_TYPE_CODE
																	LEFT JOIN 	M_CMD_PERSON D ON D.PERSON_ID = A.PERSON_ID
																	LEFT JOIN 	M_CMD_TYPE E ON C.CMD_TYPE_ID = E.CMD_TYPE_ID 
																	WHERE		1=1 
																				AND NVL(REF_ID,0) = " . $dataSelectData['ID'] . "
																				{$filterCom}
																	order by 	 CMD_DOC_DATE asc,CMD_DOC_TIME asc
																			";

											$querySelectDataSub = db::query($sqlSelectDataSub);
											while ($dataSelectDataSub = db::fetch_array($querySelectDataSub)) {
											?>
												<tr>
													<td align="center">
														<i class="fa fa-mail-reply"></i>
													</td>
													<td nowrap><?php echo db2date($dataSelectDataSub["CMD_DOC_DATE"]) . " " . substr($dataSelectDataSub["CMD_DOC_TIME"], 0, 5); ?></td>
													<td>
														<?php
														if ($dataSelectDataSub["ALERT_NOTI"] == 1) {
														?>
															<img src="Alert.gif" width="30px;">
														<?php
														}
														echo $dataSelectDataSub["CMD_NOTE"];
														/*echo $dataSelectDataSub["CMD_TYPE_NAME"];
														if($dataSelectDataSub["ALERT_NOTI"]==1){
															echo "<br> <strong><font color=\"red\">โดยมีรายละเอียดทรัพย์ดังต่อไปนี้</font></strong><br>";
																	
															$sqlSelectCountAsset 	= "select count(1) as COUNT_ASSET from M_CMD_ASSET where CMD_ID = ".$dataSelectDataSub['ID']." ";
															$querySelectCountAsset 	= db::query($sqlSelectCountAsset);
															$recSelectCountAsset 	= db::fetch_array($querySelectCountAsset);
															
															$sqlSelectCmdAsset 		= "select * from M_CMD_ASSET where CMD_ID = ".$dataSelectDataSub['ID']." and ROWNUM <= 2";
															$querySelectCmdAsset 	= db::query($sqlSelectCmdAsset);
															$i_asset = 1;
															while($recSelectCmdAsset = db::fetch_array($querySelectCmdAsset)){
																echo $i_asset.".".$recSelectCmdAsset["PROP_DET"]." <a href=\"javascript:viod(0)\" onClick=\"showAssetComList(".$recSelectCmdAsset["ASSET_ID"].",'".$_GET["TO_PERSON_ID"]."')\" class=\"btn btn-success btn-mini\" title=\"\"><i class=\"icofont icofont-search\">คำสั่ง</i></a><br>";
																echo "<hr>";
																$i_asset++;
															}
															if($recSelectCountAsset["COUNT_ASSET"]>2){
																echo "* มีรายการทรัพย์เพิ่มเติมสามารถดูได้จากปุ่มรายละเอียด *";
															}
														}*/
														?>
													</td>
													<td align="center">
														<?php

														$update_view = "";
														if ($dataSelectDataSub["SEND_TO"] == $_GET["SEND_TO"]) {
															echo "ขาเข้า";
															$update_view = "Y";
														} else {
															echo "ขาออก";
														}
														?>
													</td>
													<td><?php echo $dataSelectDataSub["SERVICE_SYS_NAME"]; ?></td>
													<td><?php echo getsystemName($dataSelectDataSub["SEND_TO"]); ?></td>
													<td align="center"><?php echo $dataSelectDataSub["TO_COURT_NAME"]; ?></td>
													<td align="center"><?php echo $dataSelectDataSub["TO_T_BLACK_CASE"] . $dataSelectDataSub["TO_BLACK_CASE"] . "/" . $dataSelectDataSub["TO_BLACK_YY"]; ?></td>
													<td align="center"><?php echo $dataSelectDataSub["TO_T_RED_CASE"] . $dataSelectDataSub["TO_RED_CASE"] . "/" . $dataSelectDataSub["TO_RED_YY"]; ?></td>
													<td>
														<?php
														$sqlFileSub = "	SELECT 		DF.FILE_SAVE_NAME,
																				DF.FILE_NAME
																	FROM 		FRM_CMD_FILE A
																	LEFT JOIN 	WF_FILE DF ON DF.WFR_ID = A.F_ID AND DF.WF_MAIN_ID = '109'
																	WHERE 		A.WF_MAIN_ID = '110' AND
																				(A.WFR_ID = '" . $dataSelectDataSub['ID'] . "' OR A.F_TEMP_ID = '" . $dataSelectDataSub['ID'] . "')
																	ORDER BY 	A.F_ID ASC
																	";
														$queryFileSub = db::query($sqlFileSub);
														$i_file = 0;
														while ($recFileSub = db::fetch_array($queryFileSub)) {
														?>
															<li>
																<a href="../attach/w109/<?php echo $recFileSub['FILE_SAVE_NAME']; ?>" target="_blank">
																	<?php echo $recFileSub['FILE_NAME']; ?>
																</a>
															</li>
														<?php
														}
														?>
													</td>
													<td align="center" nowrap>
														<?php
														if ($dataSelectDataSub["SEND_TO"] == $_GET["SEND_TO"]) {
															echo "รอดำเนินการ";
														} else {
															if ($dataSelectDataSub["FLAG_CMD_NOTI"] == 'Y') {
																echo "ส่งแจ้งแล้ว";
															} else {
																if ($dataSelectDataSub["APPROVE_STATUS"] == 0) {
																	echo "รออนุมัติ";
																} else {
																	echo "อนุมัติเเล้ว";
																}
															}
														}
														?>
													</td>
													<td align="center">
														<a href="cmd_view.php?ID=<?php echo $dataSelectDataSub["ID"] ?>&update_view=<?php echo $update_view; ?>&TO_PERSON_ID=<?php echo $_GET["TO_PERSON_ID"]; ?>&SEND_TO=<?php echo $_GET["SEND_TO"] ?>" target="_blank" class="btn btn-info btn-mini" title="">
															<i class="icofont icofont-search"></i> ดูรายละเอียด
														</a>
														<?php
														if ($dataSelectDataSub["APPROVE_PERSON"] == $_GET["TO_PERSON_ID"] && $dataSelectDataSub["APPROVE_STATUS"] == 0) {
														?>
															<a href="cmd_view.php?ID=<?php echo $dataSelectDataSub["ID"] ?>&approve=Y&TO_PERSON_ID=<?php echo $_GET["TO_PERSON_ID"]; ?>&SEND_TO=<?php echo $_GET["SEND_TO"]; ?>" target="_blank" class="btn btn-success btn-mini" title="">
																<i class="icofont icofont-search"></i> อนุมัติ
															</a>
														<?php
														}
														if ($dataSelectDataSub["TRANSACTION_APPROVE_PERSON"] == $_GET["TO_PERSON_ID"] && $dataSelectDataSub["TRANSACTION_STATUS_APP"] == 0) {
														?>
															<a href="cmd_view.php?ID=<?php echo $dataSelectDataSub["ID"] ?>&approve2=Y&TO_PERSON_ID=<?php echo $_GET["TO_PERSON_ID"]; ?>&SEND_TO=<?php echo $_GET["SEND_TO"]; ?>" target="_blank" class="btn btn-success btn-mini" title="">
																<i class="icofont icofont-search"></i> รับทราบ
															</a>
														<?php
														}
														?>
													</td>
												</tr>
										<?php
											}

											$i++;
										}
										?>
									<tbody>
								</table>
							</div>


						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ข้ามตรวจทาน -->
<div class="modal fade" id="skip_send_form" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg " role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="col-sm-12">
					<div class="media m-b-12">
						<div class="media-body">
							<h5>เปลี่ยนผู้ตรวจทาน</h5>
						</div>
					</div>
					<div class="f-right">

					</div>
				</div>

			</div>
			<div class="modal-body">
				<div class="form-group row" id="SHOW_DATA_REVIEW">
					<div class="col-md-12">

					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
			</div>
		</div>
	</div>
</div>
<!-- ข้ามตรวจทาน -->
<?php
include '../include/combottom_js_user.php';
include '../include/combottom_user.php';
?>
<script>
	function change_page_limit(limit) {
		window.location.href = "<?php echo create_link($wf_link, $_GET, array(), array('wf_limit', 'wf_page')) . '&wf_page=1&wf_limit='; ?>" + limit + "";
	}

	function change_page_no(page) {
		if (page != "") {
			$('#wf_page').val(page);
		}
	}

	function changeSubmit(tab_active) {
		window.location.href = "show_cmd_disp.php?tab_active=" + tab_active + '&SEND_TO=' + $('#SEND_TO').val() + '&TO_PERSON_ID=' + $('#TO_PERSON_ID').val();
	}

	function showAssetComList(ASSET_ID, TO_PERSON_ID) {
		window.open("show_cmd_list.php?ASSET_ID=" + ASSET_ID + '&TO_PERSON_ID=' + TO_PERSON_ID, "รายการคำสั่งเจ้าพนักงาน", "width=800,height=700");
	}

	function delete_cmd(CMD_ID) {
		swal({
				title: "",
				text: "คุณต้องการลบรายการนี้หรือไม่?",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "ยืนยันการลบ",
				cancelButtonText: "ยกเลิก",
				closeOnConfirm: true
			},
			function() {

				var dataString = 'proc=delete&CMD_ID=' + CMD_ID + '&HIDDEN_SEND_TO=' + $('#SEND_TO').val() + '&HIDDEN_TO_PERSON_ID=' + $('#TO_PERSON_ID').val();
				$.ajax({
					type: "POST",
					url: "show_cmd_process.php",
					data: dataString,
					cache: false,
					success: function(html) {
						window.location.href = "show_cmd_disp.php?SEND_TO=" + $('#SEND_TO').val() + "&TO_PERSON_ID=" + $('#TO_PERSON_ID').val();
					}
				});

			});
	}
</script>