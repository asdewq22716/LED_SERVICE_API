<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);

include('../include/include.php');

include('../include/paging.php');

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
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include '../include/template_user.php'; ?>
</head>

<!-- <body id="bsf_body" class="horizontal-fixed fixed">
    <div class="wrapper"></div> -->
<script>
	window.resizeTo(screen.availWidth, screen.height);
</script>

<body id="bsf_body" class="">
	<div class="wrapper">
		<?php
		include '../include/combottom_js_user.php'; //function 
		include '../include/func_Nop.php';
		include "./btn_function.php";
		include './check_case_Function.php';
		$_SESSION["WF_USER_ID"] = 1;
		$id_wfr = random(50) .  date('dmyhis'); //ต้องต่อ id ของคนล็อกอิน กับวันที่และเวลา ต่อท้ายไฟล์แนบ เพื่อจะไม่ได้ แรนด้อมซ้ำ 
		$id = $id_wfr;

		$CF = new func();
		$Cmd = new cmdMain();
		//ถ้าเข้ามาเเก้ไขจะมี REF_ID 

		//การทำงาน ส่วนเเรก
		$inputReadonly 		= "";
		if ($NewPage != 'New') {
			$inputReadonly 			= "readonly";
		}

		if ($_GET["REF_ID"] != "") {
			//ข้อมูลหลักคดี
			$Cmd = new cmdMain();
			$rec_cmd = $Cmd->sqlCmd($_GET["REF_ID"]);
			$GET_SYSTEM_ID 			= $rec_cmd["SEND_TO"];
			$GET_T_NO_BLACK 		= $rec_cmd['TO_T_BLACK_CASE'];
			$GET_TO_BLACK_CASE 		= $rec_cmd['TO_BLACK_CASE'];
			$GET_TO_BLACK_YY 		= $rec_cmd['TO_BLACK_YY'];
			$GET_TO_T_RED_CASE 		= $rec_cmd['TO_T_RED_CASE'];
			$GET_TO_RED_CASE 		= $rec_cmd['TO_RED_CASE'];
			$GET_TO_RED_YY 			= $rec_cmd['TO_RED_YY'];
			$GET_COURT_CODE 		= $rec_cmd['TO_COURT_CODE'];
			$GET_PLAINTIFF 			= $rec_cmd['TO_PLAINTIFF'];
			$GET_DEFENDANT 			= $rec_cmd['TO_DEFENDANT'];

			$GET_SEND_TO 			= $rec_cmd['CMD_SYSTEM'];
			$GET_FORM_PREFIX_BCASE	= $rec_cmd['T_BLACK_CASE'];
			$GET_FORM_BLACK_CASE	= $rec_cmd['BLACK_CASE'];
			$GET_FORM_BLACK_YY		= $rec_cmd['BLACK_YY'];
			$GET_FORM_PREFIX_RCASE	= $rec_cmd['T_RED_CASE'];
			$GET_FORM_RED_CASE		= $rec_cmd['RED_CASE'];
			$GET_FORM_RED_YY		= $rec_cmd['RED_YY'];
			$GET_TO_COURT_CODE		= $rec_cmd['COURT_CODE'];
			$PCC_CASE_GEN			= $rec_cmd['PCC_CASE_GEN'];

			$TO_PLAINTIFF 			= $rec_cmd["PLAINTIFF"];
			$TO_DEFENDANT 			= $rec_cmd["DEFENDANT"];

			if ($rec_cmd["REF_ID"] > 0) {
				$_REQUEST["REF_ID"] = $rec_cmd["REF_ID"];
			}
		} else {
			if ($_GET["proc"] == 'add') {
				//เดิม
				//else if ($_GET["proc"] == 'add' && $_GET["add_from"] == 'search_data_add') {
				//ข้อมูลต้นทาง
				$GET_SYSTEM_ID 			= $_GET["GET_S_SYSTEM_ID"];
				$GET_T_NO_BLACK 		= $_GET['GET_S_PREFIX_CASE_BLACK'];
				$GET_TO_BLACK_CASE 		= $_GET['GET_S_CASE_BLACK'];
				$GET_TO_BLACK_YY 		= $_GET['GET_S_CASE_BLACK_YEAR'];
				$GET_TO_T_RED_CASE 		= $_GET['GET_S_PREFIX_CASE_RED'];
				$GET_TO_RED_CASE 		= $_GET['GET_S_CASE_RED'];
				$GET_TO_RED_YY 			= $_GET['GET_S_CASE_RED_YEAR'];
				$GET_COURT_CODE 		= $_GET['GET_S_COURT_CODE'];
				$GET_PLAINTIFF			= $_GET['GET_PLAINTIFF'];
				$GET_DEFENDANT			= $_GET['GET_DEFENDANT'];
				$PCC_CASE_GEN			= $_GET['PCC_CASE_GEN'];
				//ข้อมูลปลายทาง
				$GET_SEND_TO 			= $_GET["GET_T_SYSTEM_ID"];
				$GET_FORM_PREFIX_BCASE	= $_GET['GET_T_PREFIX_CASE_BLACK'];
				$GET_FORM_BLACK_CASE	= $_GET['GET_T_CASE_BLACK'];
				$GET_FORM_BLACK_YY		= $_GET['GET_T_CASE_BLACK_YEAR'];
				$GET_FORM_PREFIX_RCASE	= $_GET['GET_T_PREFIX_CASE_RED'];
				$GET_FORM_RED_CASE		= $_GET['GET_T_CASE_RED'];
				$GET_FORM_RED_YY		= $_GET['GET_T_CASE_RED_YEAR'];
				$GET_TO_COURT_CODE		= ($_GET["GET_T_SYSTEM_ID"] == 2) ? "50" : $_GET['GET_T_COURT_CODE'];
				$rec_person["ID_CARD"]		= str_replace('-', '', $_GET['ID_CARD']);

				// โจทก์ หรือ จำเลยในฝั่งรับ
				$arrayData = [
					"System" => $_GET['GET_T_SYSTEM_ID'],
					"prefixBlackCase" => $_GET['GET_T_PREFIX_CASE_BLACK'],
					"blackCase" => $_GET['GET_T_CASE_BLACK'],
					"blackYy" => $_GET['GET_T_CASE_BLACK_YEAR'],
					"prefixRedCase" => $_GET['GET_T_PREFIX_CASE_RED'],
					"redCase" => $_GET['GET_T_CASE_RED'],
					"redYy" => $_GET['GET_T_CASE_RED_YEAR'],
					"CourtCode" => $_GET['GET_T_COURT_CODE'],
				];
				($Cmd->GetCase($arrayData));

				if ($_GET["GET_T_SYSTEM_ID"] == 1) {
					$A1 = ($Cmd->GetCaseData["PLAINTIFF2"] == "") ? "" : " , ";
					$A2 = ($Cmd->GetCaseData["PLAINTIFF3"] == "") ? "" : " , ";
					$B1 = ($Cmd->GetCaseData["DEFFENDANT2"] == "") ? "" : " , ";
					$B2 = ($Cmd->GetCaseData["DEFFENDANT2"] == "") ? "" : " , ";
					$TO_PLAINTIFF = $Cmd->GetCaseData["PLAINTIFF1"] . $A1 . $Cmd->GetCaseData["PLAINTIFF2"] . $A2 . $Cmd->GetCaseData["PLAINTIFF3"];
					$TO_DEFENDANT = $Cmd->GetCaseData["DEFFENDANT1"] . $B1 . $Cmd->GetCaseData["DEFFENDANT2"] . $B2 . $Cmd->GetCaseData["DEFFENDANT3"];
				} else if ($_GET["GET_T_SYSTEM_ID"] == 2) {
					$TO_PLAINTIFF = $Cmd->GetCaseData["PLAINTIFF1"];
					$TO_DEFENDANT = $Cmd->GetCaseData["DEFFENDANT1"];
				} else if ($_GET["GET_T_SYSTEM_ID"] == 3) { //ฟื้นฟู
					$TO_PLAINTIFF = $Cmd->GetCaseData['PLAINTIFF2'];
					$TO_DEFENDANT = $Cmd->GetCaseData['DEFFENDANT1'];
				} else if ($_GET["GET_T_SYSTEM_ID"] == 4) { //ฟื้นฟู
					$TO_PLAINTIFF = $Cmd->GetCaseData['PLAINTIFF_FNAME'];
					$TO_DEFENDANT = $Cmd->GetCaseData['DEFENDANT_FNAME'];
				}
				//ฝั่งส่ง
				/* $CmdFunc->GetFullNameSent($_GET["GET_S_SYSTEM_ID"], $_GET["CODE_API"], $rec_person["ID_CARD"]);
				$rec_person["PREFIX_NAME"]	= $CmdFunc->recGetFullName['PREFIX_NAME'];
				$rec_person["FIRST_NAME"]	= $CmdFunc->recGetFullName['FIRST_NAME'];
				$rec_person["LAST_NAME"]	= $CmdFunc->recGetFullName['LAST_NAME']; */


				//$CmdFuncAdd->page_cmd_from_send_to();//การเรียกใช้
			} else if ($_GET["proc"] == 'edit') {
				$Cmd = new cmdMain();
				$rec_cmd = $Cmd->sqlCmdEdit($_GET['ID']);
				$GET_SYSTEM_ID 			= $rec_cmd["CMD_SYSTEM"];
				$GET_T_NO_BLACK 		= $rec_cmd['T_BLACK_CASE'];
				$GET_TO_BLACK_CASE 		= $rec_cmd['BLACK_CASE'];
				$GET_TO_BLACK_YY 		= $rec_cmd['BLACK_YY'];
				$GET_TO_T_RED_CASE 		= $rec_cmd['T_RED_CASE'];
				$GET_TO_RED_CASE 		= $rec_cmd['RED_CASE'];
				$GET_TO_RED_YY 			= $rec_cmd['RED_YY'];
				$GET_COURT_CODE 		= $rec_cmd['COURT_CODE'];

				//ข้อมูลปลายทาง
				$GET_SEND_TO 			= $rec_cmd["SEND_TO"];
				$GET_FORM_PREFIX_BCASE	= $rec_cmd['TO_T_BLACK_CASE'];
				$GET_FORM_BLACK_CASE	= $rec_cmd['TO_BLACK_CASE'];
				$GET_FORM_BLACK_YY		= $rec_cmd['TO_BLACK_YY'];
				$GET_FORM_PREFIX_RCASE	= $rec_cmd['TO_T_RED_CASE'];
				$GET_FORM_RED_CASE		= $rec_cmd['TO_RED_CASE'];
				$GET_FORM_RED_YY		= $rec_cmd['TO_RED_YY'];
				$GET_TO_COURT_CODE		= $rec_cmd['TO_COURT_CODE'];

				$GET_PLAINTIFF			= $rec_cmd['PLAINTIFF'];
				$GET_DEFENDANT			= $rec_cmd['DEFENDANT'];

				$TO_PLAINTIFF 			= $rec_cmd["TO_PLAINTIFF"];
				$TO_DEFENDANT 			= $rec_cmd["TO_DEFENDANT"];
				$PCC_CASE_GEN 			= $rec_cmd["PCC_CASE_GEN"];

				$sql_person = db::query("SELECT * FROM M_CMD_PERSON WHERE CMD_ID = '" . $_GET['ID'] . "'");
				$rec_person = db::fetch_array($sql_person);

				$sql_cmd_type 		= db::query("select CMD_TYPE_ID from M_SERVICE_CMD where CMD_TYPE_CODE = '" . $rec_cmd['CASE_TYPE'] . "'");
				$rec_cmd_type 		= db::fetch_array($sql_cmd_type);
				$GET_CMD_TYPE_ID	= $rec_cmd_type['CMD_TYPE_ID'];
				$GET_CMD_TYPE_CODE	= $rec_cmd['CASE_TYPE'];
			}
		}



		?>
		<!-- <div class="content-wrapper"> -->
		<div class="content">
			<!-- Container-fluid starts -->
			<div class="container-fluid">
				<!-- Row Starts -->
				<div class="row" id="animationSandbox">
					<div class="col-md-12">
						<div class="main-header">
							<h4> ระบบบันทึกคำสั่งเจ้าพนักงาน </h4>
							<ol class="breadcrumb breadcrumb-title breadcrumb-arrow"></ol>
							<!-- 	<div class="f-right">
								<a class="btn btn-danger waves-effect waves-light" href="show_cmd_disp.php?TO_PERSON_ID=<?php echo $_GET["TO_PERSON_ID"]; ?>&SEND_TO=<?php echo $_GET["SEND_TO"]; ?>" role="button"><i class="icofont icofont-home"></i> กลับหน้าหลัก</a>
							</div> -->
						</div>
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-12">
						<div class="card">
							<div id="wf_space" class="card-block">
								<form id="frm-input" method="post" action="search_data_process.php">
									<!-- <input type="hidden" name="GET_PREFIX_NAME" id="GET_PREFIX_NAME" value="<?php echo $rec_person["PREFIX_NAME"] ?>">
									<input type="hidden" name="GET_FIRST_NAME" id="GET_FIRST_NAME" value="<?php echo $rec_person["FIRST_NAME"] ?>">
									<input type="hidden" name="GET_LAST_NAME" id="GET_LAST_NAME" value="<?php echo $rec_person["LAST_NAME"] ?>"> -->
									<input type="hidden" name="attachid" id="attachid" value="<?php echo $attachid; ?>">
									<input type="hidden" name="PCC_CASE_GEN" id="PCC_CASE_GEN" value="<?php echo $PCC_CASE_GEN; ?>">
									<input type="hidden" name="REF_ID" id="REF_ID" value="<?php echo $_REQUEST["REF_ID"]; ?>">
									<input type="hidden" name="HIDDEN_SEND_TO" id="HIDDEN_SEND_TO" value="<?php echo $_REQUEST["SEND_TO"]; ?>">
									<!-- <input type="hidden" name="HIDDEN_SEND_TO" id="HIDDEN_SEND_TO" value="<?php echo $_REQUEST["HIDDEN_SEND_TO"]; ?>"> -->
									<input type="hidden" name="HIDDEN_TO_PERSON_ID" id="HIDDEN_TO_PERSON_ID" value="<?php echo $_REQUEST["TO_PERSON_ID"]; ?>">
									<input type="hidden" name="DOSS_OWNER_ID" id="DOSS_OWNER_ID" value="<?php echo $rec_cmd["OFFICE_IDCARD"] ?>">
									<input type="hidden" name="proc" id="proc" value="<?php echo ($_GET["proc"] == "") ? "add" : $_GET["proc"]; ?>">
									<input type="hidden" name="CMD_ID" id="CMD_ID" value="<?php echo $_GET["ID"] ?>">
									<input type="hidden" name="HIDDEN_REGISTER_CODE" id="HIDDEN_REGISTER_CODE" value="<?php echo $_GET["ID_CARD"] ?>">
									<input type="hidden" name="PCC_CIVIL_GEN" id="PCC_CIVIL_GEN" value="<?php echo $_GET["PCC_CIVIL_GEN"] ?>">
									<?php
									$sqlOfficer = db::query("select USR_ID,USR_PREFIX,USR_FNAME,USR_LNAME,USR_PICTURE from USR_MAIN where USR_OPTION9 = '" . $_REQUEST["TO_PERSON_ID"] . "'");
									$recOfficer = db::fetch_array($sqlOfficer);
									?>
									<input type="hidden" name="OFFICE_IDCARD" id="OFFICE_IDCARD" value="<?php echo $_REQUEST['TO_PERSON_ID']; ?>">
									<input type="hidden" name="OFFICE_NAME" id="OFFICE_NAME" value="<?php echo $recOfficer['USR_PREFIX'] . $recOfficer['USR_FNAME'] . " " . $recOfficer['USR_LNAME']; ?>">

									<input type="hidden" name="DEPT_CODE" id="DEPT_CODE" value="">
									<input type="hidden" name="DEPT_NAME" id="DEPT_NAME" value="">
									<input type="hidden" name="WFR_ID" id="WFR_ID" value="">

									<input type="hidden" name="IDCARD" id="IDCARD" value=""> <!-- to_personId -->
									<?php

									//ส่วนของการเเสดงหน้า
									unset($mainData);
									$mainData = [
										"id" => $id, //idสำหรับrun workflow
										"inputReadonly" => $inputReadonly,
										"REF_ID" => $_GET['REF_ID'], //สำหรับการตอบกลับ
										"ID" => $_GET['ID'], //ID สำหรับEdit รายการ
										"GET_PER_TYPE" => $_GET['GET_PER_TYPE'], //Bankoffcie ชนิดของคน บุคคลกร หรือ นิติกร
										"GET_PER_CASE" => $_GET['GET_PER_CASE'], //Bankoffcie 13 หลัก
										"proc" => $_GET['proc'],
									];

									//ฝั่งส่ง
									unset($ArraySend);
									$ArraySend = [
										"SYSTEM_ID" => $GET_SYSTEM_ID,
										"PREFIX_CASE_BLACK" => $GET_T_NO_BLACK,
										"CASE_BLACK" => $GET_TO_BLACK_CASE,
										"CASE_BLACK_YEAR" => $GET_TO_BLACK_YY,
										"PREFIX_CASE_RED" => $GET_TO_T_RED_CASE,
										"CASE_RED" => $GET_TO_RED_CASE,
										"CASE_RED_YEAR" => $GET_TO_RED_YY,
										"COURT_CODE" => $GET_COURT_CODE,
										"PLAINTIFF" => $GET_PLAINTIFF,
										"DEFENDANT" => $GET_DEFENDANT,
									];

									//ฝั่งรับ
									unset($ArraySendTo);
									$ArraySendTo =  [
										"SYSTEM_ID" => $GET_SEND_TO,
										"PREFIX_CASE_BLACK" => $GET_FORM_PREFIX_BCASE,
										"CASE_BLACK" => $GET_FORM_BLACK_CASE,
										"CASE_BLACK_YEAR" => $GET_FORM_BLACK_YY,
										"PREFIX_CASE_RED" => $GET_FORM_PREFIX_RCASE,
										"CASE_RED" => $GET_FORM_RED_CASE,
										"CASE_RED_YEAR" => $GET_FORM_RED_YY,
										"COURT_CODE" => $GET_TO_COURT_CODE,
										"PLAINTIFF" => $TO_PLAINTIFF,
										"DEFENDANT" => $TO_DEFENDANT,
									];

									if ($_GET["REF_ID"] != "") {
										$Cmd->mainData = $mainData;
										$Cmd->ArraySend = $ArraySend;
										$Cmd->ArraySendTo = $ArraySendTo;
										echo $Cmd->page_cmd_from_send_to();
									} else {
										if ($_GET["proc"] == 'add') {
											$Cmd->mainData = $mainData;
											$Cmd->ArraySend = $ArraySend;
											$Cmd->ArraySendTo = $ArraySendTo;
											echo $Cmd->page_cmd_from_send_to();
										} else if ($_GET["proc"] == 'edit') {
											$Cmd->mainData = $mainData;
											$Cmd->ArraySend = $ArraySend;
											$Cmd->ArraySendTo = $ArraySendTo;
											echo $Cmd->page_cmd_from_send_to();
										}
										if ($_GET["NewPage"] == 'New') {
											$NewPage = new cmdMain();
											$NewPage->mainData = $mainData;
											echo $NewPage->page_cmd_from_send_to();
										}
									}
									//print_pre($Cmd->mainData);
									//print_pre($Cmd->ArraySend);
									//print_pre($Cmd->ArraySendTo);
									?>
									<?php Btn_function::btnHelp(); ?><!-- เเสดง menu HELP -->

									<!-- การแสดงคน  -->
									<div id="wfs_show_person_new"></div>
									<?php
									if ($_GET["REF_ID"] != "") {
										//echo $Cmd->pagePerson_cmd_from_send_to();
									} else {
										if ($_GET["proc"] == 'add') {
										} else if ($_GET["proc"] == 'edit') {
											/* เมื่อเข้าหน้าเเก้ไข จะเอาโหลดมาใช้ข้อมูลเดิม  */
											/* โดยใช้ function pagePerson_cmd_from_send_to */
											/* เมื่อมีการใช้ปุ่มดึงข้อมูล WF_Person_edit จะถูกซ่อน */
									?>
											<div id="WF_Person_edit">
												<?php
												$A = $Cmd->pagePerson_cmd_from_send_to();
												?>
											</div>
									<?php
										}
										if ($_GET["NewPage"] == 'New') {
										}
									}
									?>

									<?php
									/* การเเสดงทรัพย์ */
									?><div id="wfs_show_Asset_new"></div>
									<?php
									if ($_GET["REF_ID"] != "") {
									} else {
										if ($_GET["proc"] == 'add') {
										} else if ($_GET["proc"] == 'edit') {
											/* เมื่อเข้าหน้าเเก้ไข จะเอาโหลดมาใช้ข้อมูลเดิม  */
											/* โดยใช้ function pagePerson_cmd_from_send_to */
											/* เมื่อมีการใช้ปุ่มดึงข้อมูล WF_Person_edit จะถูกซ่อน */
									?>
											<div id="WF_Asset_edit">
												<?php
												$A = $Cmd->pageAssets_cmd_from_send_to();
												?>
											</div>
									<?php
										}
									}
									?>
									<div class="form-group row">
										<div id="CMD_NOTE_BSF_AREA" class="col-md-2 ">
											<label for="CMD_NOTE" class="form-control-label wf-right">รายละเอียด <!-- <span class="text-danger">*</span> --></label>
										</div>
										<div id="CMD_NOTE_BSF_AREA" class="col-md-6 wf-left">
											<textarea class="form-control" name="CMD_NOTE" id="CMD_NOTE" cols="80" rows="10"><?php /* echo $text_param_cmd */;  ?></textarea>
										</div>
									</div>
									<?php
									if ($GET_SYSTEM_ID != 5) {
									?>
										<div class="form-group row">
											<div id="CASE_TYPE_BSF_AREA" class="col-md-2 ">
												<label for="CASE_TYPE" class="form-control-label wf-right">เสนอผู้พิจารณา <!-- <span class="text-danger">*</span> --></label>
											</div>
											<div id="SEND_TO_BSF_AREA" class="col-md-5 wf-left">
												<?php
												$sql = "SELECT 	DISTINCT REGISTER_CODE,PREFIX_NAME,FIRST_NAME,LAST_NAME
												FROM		WH_BACKOFFICE_PERSON A
												WHERE		1=1 AND ORG_ID IN (SELECT AA.ORG_ID FROM WH_BACKOFFICE_PERSON AA WHERE AA.REGISTER_CODE = '" . $_REQUEST["TO_PERSON_ID"] . "')
												ORDER BY 	FIRST_NAME ASC";
												//echo $sql;
												/* $sql = "SELECT 	DISTINCT REGISTER_CODE,PREFIX_NAME,FIRST_NAME,LAST_NAME
												FROM		WH_BACKOFFICE_PERSON A
												WHERE		1=1 
												ORDER BY 	FIRST_NAME ASC"; */
												$query = db::query($sql);
												?>
												<select name="APPROVE_PERSON" id="APPROVE_PERSON" class="form-control select2" tabindex="-1" aria-hidden="true"><!-- class="form-control select2 select2-hidden-accessible" -->
													<option value="" disabled selected>เลือกผู้พิจารณาคำสั่ง</option>
													<?php
													while ($rec = db::fetch_array($query)) {
													?>
														<option value="<?php echo $rec['REGISTER_CODE']; ?>" <?php echo ($rec_cmd["APPROVE_PERSON"] == $rec['REGISTER_CODE'] && $rec_cmd["APPROVE_PERSON"] != "") ? "selected" : "" ?>><?php echo $rec['PREFIX_NAME'] . $rec['FIRST_NAME'] . " " . $rec['LAST_NAME'] ?></option>
													<?php
													}
													?>
												</select>
											</div>
										</div>
									<?php } ?>

									<div class="form-group row">
										<div class="col-md-12"></div>
									</div>

									<?php if (1 == 2) { ?>
										<div class="form-group row">
											<div id="SEND_TO_BSF_AREA" class="col-md-2 "><label for="SEND_TO" class="form-control-label wf-right"></label></div>
											<div id="SEND_TO_BSF_AREA" class="col-md-5 wf-left"><label><input type="checkbox" name="CMD_MANUAL_STATUS" id="CMD_MANUAL_STATUS" value="Y"> ดำเนินการด้วยคำสั่งศาล/จพท ที่มีอยู่</label></div>
										</div>
									<?php } ?>
									<div class="form-group row">
										<div class="col-md-2 ">
											<label class="form-control-label wf-left"></label>
										</div>
										<div class="col-md-8 wf-left">
											<label>
												<font color="red"> ** บันทึกคำสั่งเจ้าพนักงาน</font>
											</label><br>
											<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red">- กรณีที่ผู้บันทึกคำสั่งเจ้าพนักงาน ไม่ใช่ระดับหัวหน้างาน ให้เลือกเสนอผู้พิจารณา ระบบจะจัดส่งคำสั่งเจ้าพนักงานไปให้หัวหน้างานอนุมัติ ก่อนไปยังคดีปลายทาง</font></label>
											<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red">- กรณีที่ผู้บันทึกคำสั่งเจ้าพนักงานเป็นระดับหัวหน้างาน ให้เลือกเสนอผู้พิจารณา เป็นตนเอง ระบบจะไม่ส่งการอนุมัติ และจัดส่งคำสั่งเจ้าพนักงานไปยังคดีปลายทางโดยอัตโนมัติ</font></label>
										</div>

										<div class="form-group row">
											<div class="col-md-12 wf-center ">
												<label for="" class="form-control-label wf-center">รายการเอกสารในคดี</label>
												<div class="table-responsive">
													<table id="wfsflow" class="table table-bordered sorted_table">
														<thead class="bg-primary">
															<tr class="bg-primary">
																<th style="width:5%;" class="text-center">ลำดับ</th>
																<th style="width:95%;" class="text-center">ชื่อเอกสาร</th>
															</tr>
														</thead>
														<tbody id="wfs_show_file_case">
															<?php
															if (trim($rec_cmd["PCC_CASE_GEN"]) != "") {
																$arr_file = getCivilEdocument($rec_cmd["PCC_CASE_GEN"]);
																$no_file = 1;
																foreach ($arr_file as $key => $val) {
															?>
																	<tr>
																		<td align="center"><?php echo $no_file; ?></td>
																		<td><a href="<?php echo $val["URL_SHOW_FILE"] ?>" target="_blank"><?php echo $val["FILE_NAME"] ?></a></td>
																	</tr>
															<?php
																	$no_file++;
																}
															}
															?>
														</tbody>
													</table>
												</div>
											</div>
										</div>

										<div class="form-group row">
											<div class="col-md-12 wf-center ">
												<label for="" class="form-control-label wf-center">เอกสารแนบเพิ่มเติม</label>
												<span id="WFS_FORM_3440">
													<div class="f-right">
														<a class="btn btn-primary  active waves-effect waves-light" href="#!" title="" data-toggle="modal" data-target="#bizModal_1441" onclick="open_modal('../workflow/form_mgt.php?W=109&amp;WFS=1441&amp;WFD=0&amp;WFR_ID=<?php echo $id_wfr; ?>&amp;F_TEMP_ID=<?php echo $id; ?>', '','_1441')">

															<i class="icofont icofont-ui-add"></i> เพิ่มข้อมูล
														</a><small>&nbsp;</small>
													</div>
													<div class="table-responsive">
														<table id="wfsflow-1441" class="table table-bordered sorted_table">
															<thead class="bg-primary">
																<tr class="bg-primary">
																	<th style="width: 5%;" class="text-center">ลำดับ</th>
																	<th style="width:20;" class="text-center">ประเภทเอกสาร</th>
																	<th style="width:20;" class="text-center">แนบไฟล์</th>
																	<th style="width: 10%;" class="text-center"></th>
																</tr>
															</thead>
															<tbody id="wfs_show1441">

															</tbody>
														</table>
													</div>
													<input type="text" id="wfsflow-chk-1441" value="" style="opacity: 0;width:1px;height:1px;position:absolute;top:15px;">
													<script type="text/javascript" src="./script_cmd_WF.js?V=<?php echo date('YmdHis'); ?>">
													</script>
												</span>
											</div>
										</div>

										<script type="text/javascript">
											// get_wfs_show('WFS_FORM_3440','../process/form_main.php','W=132&WFD=0&WFS=3440&WFR=<?php echo $id_wfr; ?>&F_TEMP_ID=<?php echo $id; ?>&wfp=','GET','');
											$(document).ready(function() {
												load_file('<?php echo $id; ?>');
											});

											$(document).on('hide.bs.modal', '#bizModal_3440', function() {
												load_file('<?php echo $id; ?>');
											})

											function load_file(id) {
												$.ajax({
														url: '../form/order_official_ajax.php',
														type: 'POST',
														data: {
															fn: 'data_form',
															wfr: id
														},
													})
													.done(function(data) {
														// $('#wfs_show1441').remove();
														$('#wfs_show1441').remove();
														$("#wfsflow-3440").append("<tbody id='wfs_show1441'></tbody>");
														$('#wfs_show1441').append(data);
													});
											}

											$(document).ready(function() {
												$('button.close-modal').click(function() {
													var modal_number = $(this).attr('data-number');
													var modal_id = $(this).parents(':eq(3)').attr('id');
													$('#' + modal_number).modal('hide');
													$('#' + modal_id + ' .modal-title, #' + modal_id + ' .modal-body').html('');
												});
											});
										</script>

										<div class="modal fade modal-flex" id="bizModal_1441" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
											<div class="modal-dialog modal-lg " role="document">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close close-modal" data-number="bizModal_1441" aria-label="Close"><span aria-hidden="true">×</span></button>
														<h4 class="modal-title" id="myModalLabel"></h4>
													</div>
													<div class="modal-body"></div>
													<div class="modal-footer">
														<button type="button" class="btn btn-danger close-modal" data-number="bizModal_1441">ปิด</button>
													</div>
												</div>
											</div>
										</div>

									</div>
							</div>
						</div>
						</form>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="wf-right">
								<button type="button" id="btn_save" class="btn btn-success waves-effect waves-light"><i class="icofont icofont-tick-mark" title=""></i> บันทึก</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal -->
			<div class="modal fade modal-flex" id="bizModal" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
				<div class="modal-dialog modal-lg " role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close biz-close-modal" data-number="bizModal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel"></h4>
						</div>
						<div class="modal-body">

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger biz-close-modal" data-number="bizModal">ปิด</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade modal-flex" id="bizModal2" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
				<div class="modal-dialog modal-lg " role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close biz-close-modal" data-number="bizModal2" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel"></h4>
						</div>
						<div class="modal-body">

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger biz-close-modal" data-number="bizModal2">ปิด</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade modal-flex" id="bizModal3" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
				<div class="modal-dialog modal-lg " role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close biz-close-modal" data-number="bizModal3" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel"></h4>
						</div>
						<div class="modal-body">

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger biz-close-modal" data-number="bizModal3">ปิด</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade modal-flex" id="bizModal4" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
				<div class="modal-dialog modal-lg " role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close biz-close-modal" data-number="bizModal4" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel"></h4>
						</div>
						<div class="modal-body" style="height:500px;overflow-y:auto;">

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger biz-close-modal" data-number="bizModal4">ปิด</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade modal-flex" id="bizModal5" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
				<div class="modal-dialog modal-lg " role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close biz-close-modal" data-number="bizModal5" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel"></h4>
						</div>
						<div class="modal-body" style="height:500px;overflow-y:auto;">

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger biz-close-modal" data-number="bizModal5">ปิด</button>
						</div>
					</div>
				</div>
			</div>

			<script type="text/javascript">
				$(document).ready(function() {
					$('button.biz-close-modal').click(function(event) {
						$('#bizModal3').modal('hide');
					});
					showFormPerType2();
				});

				//ดึงข้อมูลคดีและคนในคดีต้นทาง
				$("#getCaseData").click(function() {
					getCaseData(1);
					getCasePersonData(1);
				});
				$("#getCaseDataBackoffice").click(function() {
					getCaseData(1);
					getCasePersonData(1);
				});
				$("#getCaseDataAsset1").click(function() {
					getCaseAsset(1);
				});


				//ดึงข้อมูลคดีและคนในคดีปลายทาง
				$("#getCaseData2").click(function() {
					getCaseData(2);
					getCasePersonData(2);
				});
				$("#getCaseDataAsset2").click(function() {
					getCaseAsset(2);
				});

				//การเรียกข้อมูลคนเเละทรัพย์
				<?php
				if ($_GET["FLAG_ADD_CMD"] == 'Y') {
				?>
					$(document).ready(function() {
						getCaseData(2);
						getCasePersonData(2);
						getCaseAsset(2);
					});
				<?php
				}
				?>
				var proc = '<?php echo $_GET["proc"] ?>';
				var REF_ID = '<?php echo $_GET["REF_ID"] ?>';
				if (proc == 'add') {
					$(document).ready(function() {
						console.log('work1')
						//getCasePersonData_new(1);
						getCasePersonData(1);
						getCaseAsset(1);
						showFormPerType();
						showFormPerType2();
					});
				} else {
					<?php
					if ($_GET["REF_ID"] != "") {
						$sql_111 = db::query("SELECT a.T_BLACK_CASE ,a.BLACK_CASE ,a.BLACK_YY FROM M_DOC_CMD a 
					WHERE a.ID ='" . $_GET["REF_ID_MAIN"] . "'");
						$rec_111 = db::fetch_array($sql_111);

						if ($GET_T_NO_BLACK == $rec_111['T_BLACK_CASE'] && $GET_TO_BLACK_CASE == $rec_111['BLACK_CASE'] && $GET_TO_BLACK_YY == $rec_111['BLACK_YY']) {
					?>
							$(document).ready(function() {
								console.log('workREF_ID1')
								getCasePersonData(1);
								getCaseAsset(1);
								showFormPerType();
								showFormPerType2();
							});
						<?php
						} else {
						?>
							$(document).ready(function() {
								console.log('workREF_ID2')
								getCasePersonData(2);
								getCaseAsset(2);
								showFormPerType();
								showFormPerType2();
							});
					<?php
						}
					}
					?>
				}

				$('#btn_save').click(function() {
					if ($('#SYSTEM_ID').val() == null) {
						swal({
							title: "",
							text: "กรุณาระบุคำสั่งระบบงาน",
							type: "warning",
							showCancelButton: false,
							confirmButtonClass: "btn-success",
							confirmButtonText: "ตกลง",
							closeOnConfirm: true
						});
						return false;
					}
					var SYSTEM_ID = $('#SYSTEM_ID').val();
					var SEND_TO = $('#SEND_TO').val();

					if (SYSTEM_ID != 5) {
						if ($('#BLACK_CASE').val() == "" || $('#BLACK_YY').val() == "") {
							swal({
								title: "",
								text: "กรุณาระบุหมายเลขคดีดำ",
								type: "warning",
								showCancelButton: false,
								confirmButtonClass: "btn-success",
								confirmButtonText: "ตกลง",
								closeOnConfirm: true
							});
							return false;
						}
						if ($('#RED_CASE').val() == "" || $('#RED_YY').val() == "") {
							swal({
								title: "",
								text: "กรุณาระบุหมายเลขคดีแดง",
								type: "warning",
								showCancelButton: false,
								confirmButtonClass: "btn-success",
								confirmButtonText: "ตกลง",
								closeOnConfirm: true
							});
							return false;
						}

						if ($('#COURT_CODE').val() == null) {
							swal({
								title: "",
								text: "กรุณาระบุศาล",
								type: "warning",
								showCancelButton: false,
								confirmButtonClass: "btn-success",
								confirmButtonText: "ตกลง",
								closeOnConfirm: true
							});
							return false;
						}
					}

					if ($('#SEND_TO').val() == null && $('#CMD_FIX_DATE_STATUS').prop('checked') == false) {
						swal({
							title: "",
							text: "กรุณาระบุส่งถึงระบบ",
							type: "warning",
							showCancelButton: false,
							confirmButtonClass: "btn-success",
							confirmButtonText: "ตกลง",
							closeOnConfirm: true
						});
						return false;
					}
					if (SEND_TO != 5 && $('#CMD_FIX_DATE_STATUS').prop('checked') == false) {
						if ($('#TO_T_BLACK_CASE').val() == "" || $('#TO_BLACK_CASE').val() == "" || $('#TO_BLACK_YY').val() == "") {
							swal({
								title: "",
								text: "กรุณาระบุหมายเลขคดีดำ",
								type: "warning",
								showCancelButton: false,
								confirmButtonClass: "btn-success",
								confirmButtonText: "ตกลง",
								closeOnConfirm: true
							});
							return false;
						}
						if ($('#TO_T_RED_CASE').val() == "" || $('#TO_RED_CASE').val() == "" || $('#TO_RED_YY').val() == "") {
							swal({
								title: "",
								text: "กรุณาระบุหมายเลขคดีแดง",
								type: "warning",
								showCancelButton: false,
								confirmButtonClass: "btn-success",
								confirmButtonText: "ตกลง",
								closeOnConfirm: true
							});
							return false;
						}

						if ($('#TO_COURT_CODE').val() == null) {
							swal({
								title: "",
								text: "กรุณาระบุศาล",
								type: "warning",
								showCancelButton: false,
								confirmButtonClass: "btn-success",
								confirmButtonText: "ตกลง",
								closeOnConfirm: true
							});
							return false;
						}
					}

					var work = "";
					if ($.trim($('#CMD_NOTE').val()) == "") {
						swal({
							title: "",
							text: "กรุณากรอกรายละเอียด",
							type: "warning",
							showCancelButton: false,
							confirmButtonClass: "btn-success",
							confirmButtonText: "ตกลง",
							closeOnConfirm: true
						});
						$('#CMD_NOTE').focus();
						return false;
					}


					var GET_SYSTEM_ID = '<?php echo $GET_SYSTEM_ID; ?>'
					if (GET_SYSTEM_ID == '1' || GET_SYSTEM_ID == '3' || GET_SYSTEM_ID == '4') { //ถ้าเป็นระบบอื่นที่ไม่ใช่ล้มละลาย คือเเพ่ง ฟื้นฟู ไกล่เกลี่ย
						if ($('#APPROVE_PERSON').val() == null || $('#APPROVE_PERSON').val() == "") {
							swal({
									title: "",
									text: "คุณต้องการเสนอผู้พิจารณาหรือไม่",
									type: "warning",
									showCancelButton: true, // เปลี่ยนเป็น true เพื่อให้แสดงปุ่มยกเลิก
									confirmButtonClass: "btn-success",
									confirmButtonText: "ไม่เสนอ",
									cancelButtonText: "เสนอ", // เพิ่มข้อความที่ต้องการบนปุ่มยกเลิก
									closeOnConfirm: true,
									closeOnCancel: true, // เพิ่มบรรทัดนี้เพื่อให้ปิดหน้าต่างเมื่อคลิกยกเลิก
								},
								function(isConfirm) {
									if (isConfirm) { //ไม่เสนอ
										submit_input();
									} else { //เสนอ
										$('#APPROVE_PERSON').focus();
										return false;
									}
								});

						} else {
							submit_input();
						}
					} else if (GET_SYSTEM_ID == '2') { // ล้มละลาย
						if ($('#APPROVE_PERSON').val() == null || $('#APPROVE_PERSON').val() == "") {
							swal({
								title: "",
								text: "กรุณาเสนอผู้พิจารณา",
								type: "warning",
								showCancelButton: false,
								confirmButtonClass: "btn-success",
								confirmButtonText: "ตกลง",
								closeOnConfirm: true
							});
							return false;

						} else {
							submit_input();
						}
					} else if (GET_SYSTEM_ID == '5') {

						swal({
							title: "",
							text: "คุณต้องการบันทึกคำสั่งเจ้าพนักงานหรือไม่",
							type: "warning",
							showCancelButton: true, // แสดงปุ่มยกเลิก
							confirmButtonClass: "btn-success",
							confirmButtonText: "ตกลง",
							cancelButtonText: "ยกเลิก", // ข้อความบนปุ่มยกเลิก
							closeOnConfirm: true
						}, function(isConfirmed) {
							// ฟังก์ชันที่จะทำงานหลังจากผู้ใช้คลิก "ตกลง" หรือ "ยกเลิก"
							if (isConfirmed) {
								submit_input();
								//console.log(isConfirmed);
							} else {

							}
						});

					}

					function submit_input() {
						//เช็คเมื่อติ๊กเลือกคนเเละไม่ยอมเลือกคำสั่ง
						var formData = $("#frm-input").serialize();
						formData += "&proc=checkPerson";
						$.ajax({
							type: "POST",
							url: "search_data_process_A.php",
							data: formData,
							success: function(response) {
								console.log('ตรวจคนเเละทรัพย์');
								const data = JSON.parse(response)
								console.log(data);
								if (data.nPerson > 0 || data.nAsset > 0) {
									swal({
										title: "",
										text: "กรุณาเลือกคำสั่งให้ครบถ้วน",
										type: "warning",
										showCancelButton: false,
										confirmButtonClass: "btn-success",
										confirmButtonText: "ตกลง",
										closeOnConfirm: true
									});
									return false
								} else if (data.check_person == 'targetPerson') {
									swal({
										title: "",
										text: "กรุณาเลือกคน",
										type: "warning",
										showCancelButton: false,
										confirmButtonClass: "btn-success",
										confirmButtonText: "ตกลง",
										closeOnConfirm: true
									});
									return false
								} else if (data.check_asset == 'targetAssets') {
									swal({
										title: "",
										text: "กรุณาเลือกรายการทรัพย์",
										type: "warning",
										showCancelButton: false,
										confirmButtonClass: "btn-success",
										confirmButtonText: "ตกลง",
										closeOnConfirm: true
									});
									return false
								} else {
									swal({
										title: "",
										text: "คุณต้องการบันทึกรายการคำสั่งหรือไม่",
										type: "warning",
										showCancelButton: true, // แสดงปุ่มยกเลิก
										confirmButtonClass: "btn-success",
										confirmButtonText: "ตกลง",
										cancelButtonText: "ยกเลิก", // ข้อความบนปุ่มยกเลิก
										closeOnConfirm: true
									}, function(isConfirmed) {
										// ฟังก์ชันที่จะทำงานหลังจากผู้ใช้คลิก "ตกลง" หรือ "ยกเลิก"
										if (isConfirmed) {
											$('#frm-input').unbind('submit').submit();
										} else {

										}
									});

								}
							},
							error: function(error) {
								console.log(error);
							}
						});
					}

				});
			</script>
			<script type="text/javascript">
				function getCaseData(type) { //เอกสารในคดี
					var T_BLACK_CASE = "";
					var BLACK_CASE = "";
					var BLACK_YY = "";
					var T_RED_CASE = "";
					var RED_CASE = "";
					var RED_YY = "";
					var COURT_CODE = "";
					var SYSTEM_ID = "";
					if (type == 1) { //1 คือดึงข้อมูลคนของต้นทาง
						T_BLACK_CASE = $('#T_BLACK_CASE').val();
						BLACK_CASE = $('#BLACK_CASE').val();
						BLACK_YY = $('#BLACK_YY').val();
						T_RED_CASE = $('#T_RED_CASE').val();
						RED_CASE = $('#RED_CASE').val();
						RED_YY = $('#RED_YY').val();
						COURT_CODE = $('#COURT_CODE').val();
						SYSTEM_ID = $('#SYSTEM_ID').val();
					} else { /// คือดึงข้อมูลคนของปลายทาง
						T_BLACK_CASE = $('#TO_T_BLACK_CASE').val();
						BLACK_CASE = $('#TO_BLACK_CASE').val();
						BLACK_YY = $('#TO_BLACK_YY').val();
						T_RED_CASE = $('#TO_T_RED_CASE').val();
						RED_CASE = $('#TO_RED_CASE').val();
						RED_YY = $('#TO_RED_YY').val();
						COURT_CODE = $('#TO_COURT_CODE').val();
						SYSTEM_ID = $('#SEND_TO').val();
					}
					$.ajax({
						type: "POST",
						url: 'get_data_ajax.php',
						data: {
							proc: "getCase",
							T_BLACK_CASE: T_BLACK_CASE,
							BLACK_CASE: BLACK_CASE,
							BLACK_YY: BLACK_YY,
							T_RED_CASE: T_RED_CASE,
							RED_CASE: RED_CASE,
							RED_YY: RED_YY,
							COURT_CODE: COURT_CODE,
							SYSTEM_ID: SYSTEM_ID
						}, // serializes the form's elements.
						success: function(response) { //ส่งคดีดำแดงไป ส่งข้อมูลคนกลับมา
							var data = JSON.parse(response);
							if (type == 1) {
								$('#D_C').val(data.PLAINTIFF); //โจทก์ ต้นทาง
								$('#D_NAME').val(data.DEFFENDANT); //จำเลย ต้นทาง
								var tb_file = "";
								if (data.CivilFile.length > 0) { //เอกสารในคดี
									var count = 1;
									$.each(data.CivilFile, function(i, item) {
										tb_file += "<tr>";
										tb_file += "<td align=\"center\">" + count + "</td>";
										tb_file += "<td><a href=\"" + item.URL_SHOW_FILE + "\" target=\"_blank\">" + item.FILE_NAME + "</a></td>";
										tb_file += "</tr>";
										count++;
									});
								}
								$('#wfs_show_file_case').html('');
								$('#wfs_show_file_case').append(tb_file);

							} else {
								$('#TO_PLAINTIFF').val(data.PLAINTIFF);
								$('#TO_DEFENDANT').val(data.DEFFENDANT);
							}

							$('#PCC_CASE_GEN').val(data.PCC_CASE_GEN);
							$('#DOSS_OWNER_ID').val(data.DOSS_OWNER_ID);
						}
					});
				}




				function showFormFixData() {
					$('#CMD_FIX_DOC_DATE').val('');
					if ($('#CMD_FIX_DATE_STATUS').prop('checked') == true) {
						$('.show_fix_bankrupt_date2').show();
						$('#hide_form_send_to').hide();
					} else {
						$('.show_fix_bankrupt_date2').hide();
						$('#hide_form_send_to').show();
					}
				}



				function show_action_cmd(CMD_TYPE_CODE, ASSET_ID) {
					console.log(CMD_TYPE_CODE)
					console.log(ASSET_ID)
					$.ajax({
							url: 'search_data_process_A.php',
							type: 'POST',
							data: {
								proc: 'show_action',
								CMD_TYPE_CODE: $('#CMD_TYPE_' + ASSET_ID).val(),
							}
						})
						.done(function(data) {
							let show = JSON.parse(data)
							/* console.log(show) */
							let D = (show == null ? 'ไม่มีข้อมูล' : show);

							console.log(D)
							$('#input_show_action_' + ASSET_ID).val(D);
						});
				}

				function getPersonDetail() {
					var GET_PREFIX_NAME = $('#ID_CARD').find('option:selected').attr('GET_PREFIX_NAME');
					var GET_FIRST_NAME = $('#ID_CARD').find('option:selected').attr('GET_FIRST_NAME');
					var LAST_NAME = $('#ID_CARD').find('option:selected').attr('LAST_NAME');
					$('#GET_PREFIX_NAME').val(GET_PREFIX_NAME);
					$('#GET_FIRST_NAME').val(GET_FIRST_NAME);
					$('#LAST_NAME').val(LAST_NAME);
				}


				$(document).ready(function() {
					load_file('<?php echo $id; ?>');

				});

				$(document).on('hide.bs.modal', '#bizModal_1441', function() {
					load_file('<?php echo $id; ?>');
				})

				$('button[type="submit"]').click(function(event) {
					// load_file('<?php echo $id; ?>');
				});

				function load_file(id) {
					$.ajax({
							url: 'get_data_ajax.php',
							type: 'POST',
							data: {
								proc: 'getFileList',
								wfr: id
							},
						})
						.done(function(data) {
							$('#wfs_show1441').remove();
							$("#wfsflow-1441").append("<tbody id='wfs_show1441'></tbody>");
							$('#wfs_show1441').append(data);
						});
				}


				function show_asset_detail(asset_id) {
					window.open("show_asset_detail.php?ASSET_ID=" + asset_id, "รายละเอียดทรัพย์", "width=800,height=700");
				}

				function showFormPerType() {
					if ($('#SYSTEM_ID').val() == 5) {
						$('.show_per_type').show();
						$('.show_class_required').hide();
						$('#show_form_source_input').hide();
						$('.show_fix_bankrupt_date').hide();
					} else {
						$('.show_per_type').hide();
						$('.show_class_required').show();
						$('#show_form_source_input').show();
						if ($('#SYSTEM_ID').val() == 2) {
							$('.show_fix_bankrupt_date').show();
						} else {
							$('.show_fix_bankrupt_date').hide();
						}
					}
				}

				function showFormPerType2() {
					if ($('#SEND_TO').val() == 5) {
						$('.show_class_required2').hide();
						$('#show_form_source_input2').hide();
						$('#form_dept_to_backoffice').show();
					} else {
						if ($('#SEND_TO').val() == 6) {
							$('#TO_T_BLACK_CASE').val($('#T_BLACK_CASE').val());
							$('#TO_BLACK_CASE').val($('#BLACK_CASE').val());
							$('#TO_BLACK_YY').val($('#BLACK_YY').val());
							$('#TO_T_RED_CASE').val($('#T_RED_CASE').val());
							$('#TO_RED_CASE').val($('#RED_CASE').val());
							$('#TO_RED_YY').val($('#RED_YY').val());
							$('#TO_COURT_CODE').val($('#COURT_CODE').val()).trigger('change');
							$('#TO_PLAINTIFF').val($('#D_C').val());
							$('#TO_DEFENDANT').val($('#D_NAME').val());
						}
						$('.show_class_required2').show();
						$('#show_form_source_input2').show();
						$('#form_dept_to_backoffice').hide();
					}
				}


				function getCaseType(asset_id) {
					$.ajax({
							url: 'order_official_ajax.php',
							type: 'POST',
							data: {
								fn2: 'get_service2',
								id: $('#CMD_TYPE_' + asset_id).val(),
								code: $('#SYSTEM_ID').val()
							}
						})
						.done(function(data) {
							$('#CASE_TYPE_' + asset_id).find('option').remove().end()
							$('#CASE_TYPE_' + asset_id).append(data);
						});
				}

				function getCaseTypePerson(register_code) {
					$.ajax({
							url: 'order_official_ajax.php',
							type: 'POST',
							data: {
								fn2: 'get_service2',
								id: $('#CMD_TYPE_PERSON_' + register_code).val(),
								code: $('#SYSTEM_ID').val()
							}
						})
						.done(function(data) {
							$('#CASE_TYPE_PERSON_' + register_code).find('option').remove().end()
							$('#CASE_TYPE_PERSON_' + register_code).append(data);
						});
				}


				/* สอบถามความประสงค์ AK*/
				function getCaseTypePerson_edit(val, register_code, CMD_TYPE_CODE) {
					$.ajax({
							url: 'order_official_ajax.php',
							type: 'POST',
							data: {
								fn2: 'get_serviceEdit',
								id: val,
								code: $('#SYSTEM_ID').val(),
								CMD_TYPE_CODE: CMD_TYPE_CODE
							}
						})
						.done(function(data) {
							$('#CASE_TYPE_PERSON_' + register_code).find('option').remove().end()
							$('#CASE_TYPE_PERSON_' + register_code).append(data);
						});
				}
				/* สอบถามความประสงค์ AK*/
				function getCaseType_edit(val, asset_id, CMD_TYPE_CODE) {
					$.ajax({
							url: 'order_official_ajax.php',
							type: 'POST',
							data: {
								fn2: 'get_serviceEdit',
								id: val,
								code: $('#SYSTEM_ID').val(),
								CMD_TYPE_CODE: CMD_TYPE_CODE
							}
						})
						.done(function(data) {
							$('#CASE_TYPE_' + asset_id).find('option').remove().end()
							$('#CASE_TYPE_' + asset_id).append(data);
						});
				}



				function createTextDetail(idcard, name, caseType) {
					var case_black = $('#T_BLACK_CASE').val() + '.' + $('#BLACK_CASE').val() + '/' + $('#BLACK_YY').val();
					var case_red = $('#T_RED_CASE').val() + '.' + $('#RED_CASE').val() + '/' + $('#RED_YY').val();
					if (caseType = '20112' && $('#CMD_FIX_DATE_STATUS').prop('checked') == true) {
						$('#CMD_NOTE').val('คดีหมายเลขดำที่ ล.14921/2565 คดีหมายเลขแดงที่ ล.14922/2565 ศาลล้มละลายกลาง ศาลมีคำสั่งปลดล้มละลาย ' + name + ' เลขประจำตัวประชาชน ' + idcard + ' เมื่อวันที่ ' + $('#CMD_FIX_DOC_DATE').val());
					}
				}
			</script>
			<?php include "../public/cmd_js.php"; ?>