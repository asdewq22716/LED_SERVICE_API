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
/* echo "<pre>";
print_r($_GET);
echo "</pre>";
exit;
 */
/* ตรวจพบ start */
$sql_cmd_note = "SELECT
	B.*
FROM
	WH_CIVIL_CASE A
	JOIN ".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')." B ON A.WH_CIVIL_ID =B.WH_CIVIL_ID 
WHERE 1=1
    AND A.CIVIL_CODE = '" . $_GET['PCC_CIVIL_GEN'] . "'
    AND B.REGISTER_CODE ='" . $_GET['REGISTERCODE'] . "'";
$query_cmd_note = db::query($sql_cmd_note);
$data_cmd_note = db::fetch_array($query_cmd_note);

$text_param_cmd = "ตรวจพบ" . $data_cmd_note['FULL_NAME'] . " สถานะ " . $data_cmd_note['CONCERN_NAME'] .
	" ในคดี แพ่ง หมายเลขดำที่ " . $data_cmd_note['PREFIX_BLACK_CASE'] . $data_cmd_note['BLACK_CASE'] . "/" . $data_cmd_note['BLACK_YY'] .
	"หมายเลขแดงที่" . $data_cmd_note['PREFIX_RED_CASE'] . $data_cmd_note['RED_CASE'] . "/" . $data_cmd_note['RED_YY'] .
	"เป็น " . $_GET['receive_concernName'] . " ใน" . $_GET['CASE_NAMETHAI'] .
	" ในคดี หมายเลขดำที่" . $_GET['receive_prefixBlackCase'] . $_GET['receive_blackCase'] . "/" . $_GET['receive_blackYy'] .
	" ในคดี หมายเลขแดงที่" . $_GET['receive_prefixRedCase'] . $_GET['receive_redCase'] . "/" . $_GET['receive_redYy'];
/* ตรวจพบ stop */

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
		?>
		<style>
			.content-wrapper {
				margin-top: -20px;
				/* ปรับระยะห่างด้านบนของ content-wrapper ให้มีค่า 20px */
			}
		</style>

		<?php

		$_SESSION["WF_USER_ID"] = 1;
		/* include '../include/comtop_user.php';
include("../include/combottom_js_user.php"); */
		$wfr = $_GET['WFR'];

		$id_wfr = '';
		$id = '';
		$attachid  = random(50);
		$attachid  =  $attachid .  date('dmyhis'); //ต้องต่อ id ของคนล็อกอิน กับวันที่และเวลา ต่อท้ายไฟล์แนบ เพื่อจะไม่ได้ แรนด้อมซ้ำ 
		$id_wfr = $id = $attachid;

		$T_NO_BLACK = $_GET["T_NO_BLACK"];
		$NO_BLACK_CASE = $_GET["NO_BLACK_CASE"];
		$BLACK_YEAR = $_GET["BLACK_YEAR"];
		/* print_r_pre($_GET); */
		if ($_GET["REF_ID"] != "") {
			$sql_cmd = db::query("SELECT
                        	*
								FROM
									(
										SELECT
											A .*, (
												SELECT
													CMD_NOTE
												FROM
													M_CMD_DETAILS B
												WHERE
													B.CMD_ID = A . ID
												AND B.CMD_DETAIL_ID = (
													SELECT
														MAX (C.CMD_DETAIL_ID) AS aa
													FROM
														M_CMD_DETAILS C
													WHERE
														C.CMD_ID = A . ID
													AND C.REF_DETAIL_ID IS NULL
												)
												AND ROWNUM = 1
											) AS CMD_DETAILS
										FROM
											M_DOC_CMD A
										WHERE
											1 = 1
										AND A . ID = '" . $_GET['REF_ID'] . "'
									) CMD");
			$rec_cmd = db::fetch_array($sql_cmd);


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
			//$GET_CMD_TYPE_ID 		= $rec_cmd['CMD_TYPE'];
			$GET_SEND_TO 			= $rec_cmd['CMD_SYSTEM'];
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


			$sql_person = db::query("SELECT * FROM M_CMD_PERSON WHERE CMD_ID = '" . $_GET['REF_ID'] . "'");
			$rec_person = db::fetch_array($sql_person);

			$sqlSelectCase = "	select 	DEFFENDANT1,PLAINTIFF1
							from 	WH_CIVIL_CASE 
							where 	PREFIX_BLACK_CASE = '" . $GET_FORM_PREFIX_BCASE . "'
									AND BLACK_CASE = '" . $GET_FORM_BLACK_CASE . "'
									AND BLACK_YY = '" . $GET_FORM_BLACK_YY . "'
									AND PREFIX_RED_CASE = '" . $GET_FORM_PREFIX_RCASE . "'
									AND RED_CASE = '" . $GET_FORM_RED_CASE . "'
									AND RED_YY = '" . $GET_FORM_RED_YY . "'
									AND COURT_CODE = '" . $GET_TO_COURT_CODE . "'";
			$sqlSelectCase = db::query($sqlSelectCase);
			$recSelectCase = db::fetch_array($sqlSelectCase);
			/* $TO_PLAINTIFF = $recSelectCase["PLAINTIFF1"];
			$TO_DEFENDANT = $recSelectCase["DEFFENDANT1"]; */


			if ($rec_cmd["REF_ID"] > 0) {
				$_REQUEST["REF_ID"] = $rec_cmd["REF_ID"];
			}
		} else {
			if ($_GET["proc"] == 'edit') {
				$sql_cmd = db::query("SELECT
									*
										FROM
											(
												SELECT
													A .*, (
														SELECT
															CMD_NOTE
														FROM
															M_CMD_DETAILS B
														WHERE
															B.CMD_ID = A . ID
														AND B.CMD_DETAIL_ID = (
															SELECT
																MAX (C.CMD_DETAIL_ID) AS aa
															FROM
																M_CMD_DETAILS C
															WHERE
																C.CMD_ID = A . ID
															AND C.REF_DETAIL_ID IS NULL
														)
														AND ROWNUM = 1
													) AS CMD_DETAILS
												FROM
													M_DOC_CMD A
												WHERE
													1 = 1
												AND A . ID = '" . $_GET['ID'] . "'
											) CMD");
				$rec_cmd = db::fetch_array($sql_cmd);


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
			} else if ($_GET["proc"] == 'add' && $_GET["add_from"] != 'search_data_add') {
				//ข้อมูลต้นทาง
				$GET_SYSTEM_ID 			= $_GET["GET_S_SYSTEM_ID"];
				$GET_T_NO_BLACK 		= $_GET['GET_S_PREFIX_CASE_BLACK'];
				$GET_TO_BLACK_CASE 		= $_GET['GET_S_CASE_BLACK'];
				$GET_TO_BLACK_YY 		= $_GET['GET_S_CASE_BLACK_YEAR'];
				$GET_TO_T_RED_CASE 		= $_GET['GET_S_PREFIX_CASE_RED'];
				$GET_TO_RED_CASE 		= $_GET['GET_S_CASE_RED'];
				$GET_TO_RED_YY 			= $_GET['GET_S_CASE_RED_YEAR'];
				$GET_COURT_CODE 		= $_GET['GET_S_COURT_CODE'];

				//ข้อมูลปลายทาง
				$GET_SEND_TO 			= $_GET["GET_T_SYSTEM_ID"];
				$GET_FORM_PREFIX_BCASE	= $_GET['GET_T_PREFIX_CASE_BLACK'];
				$GET_FORM_BLACK_CASE	= $_GET['GET_T_CASE_BLACK'];
				$GET_FORM_BLACK_YY		= $_GET['GET_T_CASE_BLACK_YEAR'];
				$GET_FORM_PREFIX_RCASE	= $_GET['GET_T_PREFIX_CASE_RED'];
				$GET_FORM_RED_CASE		= $_GET['GET_T_CASE_RED'];
				$GET_FORM_RED_YY		= $_GET['GET_T_CASE_RED_YEAR'];

				if ($_GET["GET_T_SYSTEM_ID"] == 2) {
					if ($_GET['GET_T_COURT_CODE'] == "") {
						$_GET['GET_T_COURT_CODE'] = '050';
					}
				}
				$GET_TO_COURT_CODE		= $_GET['GET_T_COURT_CODE'];

				$GET_PLAINTIFF			= $_GET['GET_PLAINTIFF'];
				$GET_DEFENDANT			= $_GET['GET_DEFENDANT'];
				$PCC_CASE_GEN			= $_GET['PCC_CASE_GEN'];

				$rec_person["ID_CARD"]		= str_replace('-', '', $_GET['ID_CARD']);

				if ($_GET["GET_S_SYSTEM_ID"] == 1) {
					$sqlSelectPerson = "SELECT	PREFIX_NAME,FIRST_NAME,LAST_NAME,FULL_NAME
									FROM	".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')."
									WHERE	PREFIX_BLACK_CASE = '" . $_GET['GET_S_PREFIX_CASE_BLACK'] . "'
											AND BLACK_CASE = '" . $_GET['GET_S_CASE_BLACK'] . "'
											AND BLACK_YY = '" . $_GET['GET_S_CASE_BLACK_YEAR'] . "'
											AND PREFIX_RED_CASE = '" . $_GET['GET_S_PREFIX_CASE_RED'] . "'
											AND RED_CASE = '" . $_GET['GET_S_CASE_RED'] . "'
											AND RED_YY = '" . $_GET['GET_S_CASE_RED_YEAR'] . "'
											AND COURT_CODE = '" . $_GET['GET_S_COURT_CODE'] . "'
											AND REGISTER_CODE = '" . $rec_person["ID_CARD"] . "'
								   ";
					$querySelectPerson = db::query($sqlSelectPerson);
					$recSelectPerson = db::fetch_array($querySelectPerson);
				} else if ($_GET["GET_S_SYSTEM_ID"] == 2) {
					$sqlSelectPerson = "SELECT	PREFIX_NAME,FIRST_NAME,LAST_NAME
									FROM	WH_BANKRUPT_CASE_PERSON
									WHERE	1=1
											AND PREFIX_BLACK_CASE = '" . $_GET['GET_S_PREFIX_CASE_BLACK'] . "'
											AND BLACK_CASE = '" . $_GET['GET_S_CASE_BLACK'] . "'
											AND BLACK_YY = '" . $_GET['GET_S_CASE_BLACK_YEAR'] . "'
											AND PREFIX_RED_CASE = '" . $_GET['GET_S_PREFIX_CASE_RED'] . "'
											AND RED_CASE = '" . $_GET['GET_S_CASE_RED'] . "'
											AND RED_YY = '" . $_GET['GET_S_CASE_RED_YEAR'] . "'
											AND REGISTER_CODE = '" . $rec_person["ID_CARD"] . "'
								   ";
					$querySelectPerson = db::query($sqlSelectPerson);
					$recSelectPerson = db::fetch_array($querySelectPerson);
				}

				$rec_person["PREFIX_NAME"]	= $recSelectPerson['PREFIX_NAME'];
				$rec_person["FIRST_NAME"]	= $recSelectPerson['FIRST_NAME'];
				$rec_person["LAST_NAME"]	= $recSelectPerson['LAST_NAME'];

				if ($_GET["GET_T_SYSTEM_ID"] == 1) {
					$Fill = "";
					$Fill .= $_GET['GET_T_PREFIX_CASE_BLACK'] == "" ? "" : "AND PREFIX_BLACK_CASE = '" . $_GET['GET_T_PREFIX_CASE_BLACK'] . "'";
					$Fill .= $_GET['GET_T_PREFIX_CASE_RED'] == "" ? "" : "AND PREFIX_RED_CASE = '" . $_GET['GET_T_PREFIX_CASE_RED'] . "'";
					$sqlSelectCase = "	select 	DEFFENDANT1,DEFFENDANT2,DEFFENDANT3,PLAINTIFF1,PLAINTIFF2,PLAINTIFF3
									from 	WH_CIVIL_CASE 
									where 	1=1 
											{$Fill}
											AND BLACK_CASE = '" . $_GET['GET_T_CASE_BLACK'] . "'
											AND BLACK_YY = '" . $_GET['GET_T_CASE_BLACK_YEAR'] . "'
											AND RED_CASE = '" . $_GET['GET_T_CASE_RED'] . "'
											AND RED_YY = '" . $_GET['GET_T_CASE_RED_YEAR'] . "'
											AND COURT_CODE = '" . $_GET['GET_T_COURT_CODE'] . "'";
					$sqlSelectCase = db::query($sqlSelectCase);
					$recSelectCase = db::fetch_array($sqlSelectCase);
					$TO_PLAINTIFF = $recSelectCase["PLAINTIFF1"] . "," . $recSelectCase["PLAINTIFF2"] . "," . $recSelectCase["PLAINTIFF3"];
					$TO_DEFENDANT = $recSelectCase["DEFFENDANT1"] . "," . $recSelectCase["DEFFENDANT2"] . "," . $recSelectCase["DEFFENDANT3"];
				} else if ($_GET["GET_T_SYSTEM_ID"] == 2) {
					$sqlSelectCase = "	select 	PLAINTIFF1,DEFFENDANT1
									from 	WH_BANKRUPT_CASE_DETAIL 
									where 	PREFIX_BLACK_CASE = '" . $_GET['GET_T_PREFIX_CASE_BLACK'] . "'
											AND BLACK_CASE = '" . $_GET['GET_T_CASE_BLACK'] . "'
											AND BLACK_YY = '" . $_GET['GET_T_CASE_BLACK_YEAR'] . "'
											AND PREFIX_RED_CASE = '" . $_GET['GET_T_PREFIX_CASE_RED'] . "'
											AND RED_CASE = '" . $_GET['GET_T_CASE_RED'] . "'
											AND RED_YY = '" . $_GET['GET_T_CASE_RED_YEAR'] . "'
											AND COURT_CODE = '010030' ";
					$sqlSelectCase = db::query($sqlSelectCase);
					$recSelectCase = db::fetch_array($sqlSelectCase);
					$A1 = ($recSelectCase["PLAINTIFF2"] == "") ? "" : " , ";
					$A2 = ($recSelectCase["PLAINTIFF3"] == "") ? "" : " , ";
					$B1 = ($recSelectCase["DEFFENDANT2"] == "") ? "" : " , ";
					$B2 = ($recSelectCase["DEFFENDANT2"] == "") ? "" : " , ";
					$TO_PLAINTIFF = $recSelectCase["PLAINTIFF1"] . $A1 . $recSelectCase["PLAINTIFF2"] . $A2 . $recSelectCase["PLAINTIFF3"];
					$TO_DEFENDANT = $recSelectCase["DEFFENDANT1"] . $B1 . $recSelectCase["DEFFENDANT2"] . $B2 . $recSelectCase["DEFFENDANT3"];
				}
			} else if ($_GET["proc"] == 'add' && $_GET["add_from"] == 'search_data_add') {
				//ข้อมูลต้นทาง
				$GET_SYSTEM_ID 			= $_GET["GET_S_SYSTEM_ID"];
				$GET_T_NO_BLACK 		= $_GET['GET_S_PREFIX_CASE_BLACK'];
				$GET_TO_BLACK_CASE 		= $_GET['GET_S_CASE_BLACK'];
				$GET_TO_BLACK_YY 		= $_GET['GET_S_CASE_BLACK_YEAR'];
				$GET_TO_T_RED_CASE 		= $_GET['GET_S_PREFIX_CASE_RED'];
				$GET_TO_RED_CASE 		= $_GET['GET_S_CASE_RED'];
				$GET_TO_RED_YY 			= $_GET['GET_S_CASE_RED_YEAR'];
				$GET_COURT_CODE 		= $_GET['GET_S_COURT_CODE'];

				//ข้อมูลปลายทาง
				$GET_SEND_TO 			= $_GET["GET_T_SYSTEM_ID"];
				$GET_FORM_PREFIX_BCASE	= $_GET['GET_T_PREFIX_CASE_BLACK'];
				$GET_FORM_BLACK_CASE	= $_GET['GET_T_CASE_BLACK'];
				$GET_FORM_BLACK_YY		= $_GET['GET_T_CASE_BLACK_YEAR'];
				$GET_FORM_PREFIX_RCASE	= $_GET['GET_T_PREFIX_CASE_RED'];
				$GET_FORM_RED_CASE		= $_GET['GET_T_CASE_RED'];
				$GET_FORM_RED_YY		= $_GET['GET_T_CASE_RED_YEAR'];

				if ($_GET["GET_T_SYSTEM_ID"] == 2) {
					if ($_GET['GET_T_COURT_CODE'] == "") {
						$_GET['GET_T_COURT_CODE'] = '050';
					}
				}
				$GET_TO_COURT_CODE		= $_GET['GET_T_COURT_CODE'];

				$GET_PLAINTIFF			= $_GET['GET_PLAINTIFF'];
				$GET_DEFENDANT			= $_GET['GET_DEFENDANT'];
				$PCC_CASE_GEN			= $_GET['PCC_CASE_GEN'];

				$rec_person["ID_CARD"]		= str_replace('-', '', $_GET['ID_CARD']);

				if ($_GET["GET_S_SYSTEM_ID"] == 1) {
					$sqlSelectPerson = "SELECT	PREFIX_NAME,FIRST_NAME,LAST_NAME,FULL_NAME
									FROM	".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')."
									WHERE	PREFIX_BLACK_CASE = '" . $_GET['GET_S_PREFIX_CASE_BLACK'] . "'
											AND BLACK_CASE = '" . $_GET['GET_S_CASE_BLACK'] . "'
											AND BLACK_YY = '" . $_GET['GET_S_CASE_BLACK_YEAR'] . "'
											AND PREFIX_RED_CASE = '" . $_GET['GET_S_PREFIX_CASE_RED'] . "'
											AND RED_CASE = '" . $_GET['GET_S_CASE_RED'] . "'
											AND RED_YY = '" . $_GET['GET_S_CASE_RED_YEAR'] . "'
											AND COURT_CODE = '" . $_GET['GET_S_COURT_CODE'] . "'
											AND REGISTER_CODE = '" . $rec_person["ID_CARD"] . "'
								   ";
					$querySelectPerson = db::query($sqlSelectPerson);
					$recSelectPerson = db::fetch_array($querySelectPerson);
				} else if ($_GET["GET_S_SYSTEM_ID"] == 2) {
					$sqlSelectPerson = "SELECT	PREFIX_NAME,FIRST_NAME,LAST_NAME
									FROM	WH_BANKRUPT_CASE_PERSON
									WHERE	PREFIX_BLACK_CASE = '" . $_GET['GET_S_PREFIX_CASE_BLACK'] . "'
											AND BLACK_CASE = '" . $_GET['GET_S_CASE_BLACK'] . "'
											AND BLACK_YY = '" . $_GET['GET_S_CASE_BLACK_YEAR'] . "'
											AND PREFIX_RED_CASE = '" . $_GET['GET_S_PREFIX_CASE_RED'] . "'
											AND RED_CASE = '" . $_GET['GET_S_CASE_RED'] . "'
											AND RED_YY = '" . $_GET['GET_S_CASE_RED_YEAR'] . "'
											AND REGISTER_CODE = '" . $rec_person["ID_CARD"] . "'
								   ";
					$querySelectPerson = db::query($sqlSelectPerson);
					$recSelectPerson = db::fetch_array($querySelectPerson);
				}


				$rec_person["PREFIX_NAME"]	= $recSelectPerson['PREFIX_NAME'];
				$rec_person["FIRST_NAME"]	= $recSelectPerson['FIRST_NAME'];
				$rec_person["LAST_NAME"]	= $recSelectPerson['LAST_NAME'];

				if ($_GET["GET_T_SYSTEM_ID"] == 1) {
					$Fill = "";
					$Fill .= $_GET['GET_T_PREFIX_CASE_BLACK'] == "" ? "" : "AND PREFIX_BLACK_CASE = '" . $_GET['GET_T_PREFIX_CASE_BLACK'] . "'";
					$Fill .= $_GET['GET_T_PREFIX_CASE_RED'] == "" ? "" : "AND PREFIX_RED_CASE = '" . $_GET['GET_T_PREFIX_CASE_RED'] . "'";
					$sqlSelectCase = "	select 	DEFFENDANT1,DEFFENDANT2,DEFFENDANT3,PLAINTIFF1,PLAINTIFF2,PLAINTIFF3
									from 	WH_CIVIL_CASE 
									where 	1=1 
											{$Fill}
											AND BLACK_CASE = '" . $_GET['GET_T_CASE_BLACK'] . "'
											AND BLACK_YY = '" . $_GET['GET_T_CASE_BLACK_YEAR'] . "'
											AND RED_CASE = '" . $_GET['GET_T_CASE_RED'] . "'
											AND RED_YY = '" . $_GET['GET_T_CASE_RED_YEAR'] . "'
											AND COURT_CODE = '" . $_GET['GET_T_COURT_CODE'] . "'";
					$sqlSelectCase = db::query($sqlSelectCase);
					$recSelectCase = db::fetch_array($sqlSelectCase);
					$A1 = ($recSelectCase["PLAINTIFF2"] == "") ? "" : " , ";
					$A2 = ($recSelectCase["PLAINTIFF3"] == "") ? "" : " , ";
					$B1 = ($recSelectCase["DEFFENDANT2"] == "") ? "" : " , ";
					$B2 = ($recSelectCase["DEFFENDANT2"] == "") ? "" : " , ";
					$TO_PLAINTIFF = $recSelectCase["PLAINTIFF1"] . $A1 . $recSelectCase["PLAINTIFF2"] . $A2 . $recSelectCase["PLAINTIFF3"];
					$TO_DEFENDANT = $recSelectCase["DEFFENDANT1"] . $B1 . $recSelectCase["DEFFENDANT2"] . $B2 . $recSelectCase["DEFFENDANT3"];
				} else if ($_GET["GET_T_SYSTEM_ID"] == 2) {
					$sqlSelectCase = "	select 	PLAINTIFF1,DEFFENDANT1
									from 	WH_BANKRUPT_CASE_DETAIL 
									where 	PREFIX_BLACK_CASE = '" . $_GET['GET_T_PREFIX_CASE_BLACK'] . "'
											AND BLACK_CASE = '" . $_GET['GET_T_CASE_BLACK'] . "'
											AND BLACK_YY = '" . $_GET['GET_T_CASE_BLACK_YEAR'] . "'
											AND PREFIX_RED_CASE = '" . $_GET['GET_T_PREFIX_CASE_RED'] . "'
											AND RED_CASE = '" . $_GET['GET_T_CASE_RED'] . "'
											AND RED_YY = '" . $_GET['GET_T_CASE_RED_YEAR'] . "'
											AND COURT_CODE = '010030' ";
					$sqlSelectCase = db::query($sqlSelectCase);
					$recSelectCase = db::fetch_array($sqlSelectCase);
					$TO_PLAINTIFF = $recSelectCase["PLAINTIFF1"];
					$TO_DEFENDANT = $recSelectCase["DEFFENDANT1"];
				}

				if ($_GET["GET_S_SYSTEM_ID"] == '5') { //ถ้ามาจากระบบbackoffice AK
					$TO_PLAINTIFF = $_GET["PLAINTIFF1"];
					$TO_DEFENDANT = $_GET["DEFFENDANT1"];
				}
			}
		}

		$inputReadonly 		= "";
		$filterSystemId1 	= "";
		$filterSystemId2 	= "";
		$filterCourt1 		= "";
		$filterCourt2 		= "";
		if ($_GET["proc"] == "add" && $_GET["GET_S_CASE_BLACK"] != "") {
			/* AK */
			/* $inputReadonly 			= "readonly";
	$filterSystemId1 		= "and CMD_SYSTEM_ID = '" . $_GET["GET_S_SYSTEM_ID"] . "'";
	$filterSystemId2 		= "and CMD_SYSTEM_ID = '" . $_GET["GET_T_SYSTEM_ID"] . "'";
	$filterCourt1		 	= "and COURT_CODE = '" . $GET_COURT_CODE . "'";
	$filterCourt2		 	= "and COURT_CODE = '" . $GET_TO_COURT_CODE . "'"; */
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
							<div class="f-right">
								<a class="btn btn-danger waves-effect waves-light" href="show_cmd_disp.php?TO_PERSON_ID=<?php echo $_GET["TO_PERSON_ID"]; ?>&SEND_TO=<?php echo $_GET["SEND_TO"]; ?>" role="button"><i class="icofont icofont-home"></i> กลับหน้าหลัก</a>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-12">
						<div class="card">
							<div id="wf_space" class="card-block">
								<form id="frm-input" method="post" action="search_data_process.php">

									<input type="hidden" name="GET_PREFIX_NAME" id="GET_PREFIX_NAME" value="<?php echo $rec_person["PREFIX_NAME"] ?>">
									<input type="hidden" name="GET_FIRST_NAME" id="GET_FIRST_NAME" value="<?php echo $rec_person["FIRST_NAME"] ?>">
									<input type="hidden" name="GET_LAST_NAME" id="GET_LAST_NAME" value="<?php echo $rec_person["LAST_NAME"] ?>">
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

									<div class="form-group row">
										<input type="hidden" name="F_TEMP_ID" id="F_TEMP_ID" value="<?php echo $id; ?>">
										<input type="hidden" name="WFR" id="WFR" value="">
									</div>
									<div class="form-group row">
										<div id="CMD_DOC_DATE_BSF_AREA" class="col-md-2 ">
											<label for="CMD_DOC_DATE" class="form-control-label wf-right">วันที่</label>
										</div>
										<div id="CMD_DOC_DATE_BSF_AREA" class="col-md-2 wf-left">
											<label class="input-group">
												<input name="CMD_DOC_DATE" id="CMD_DOC_DATE" value="<?php echo date('d/m') . '/' . (date('Y') + 543)   ?>" class="form-control datepicker" placeholder="">
												<span class="input-group-addon bg-primary"><span class="icofont icofont-ui-calendar"></span></span>
											</label>
										</div>
										<div id="CMD_DOC_TIME_BSF_AREA" class="col-md-2 offset-md-1 ">
											<label for="CMD_DOC_TIME" class="form-control-label wf-right">เวลา</label>
										</div>
										<div id="CMD_DOC_TIME_BSF_AREA" class="col-md-2 wf-left">
											<input type="text" name="CMD_DOC_TIME" id="CMD_DOC_TIME" class="form-control" value="<?php echo date("H:i:s"); ?>" readonly="true">
											<small id="DUP_CMD_DOC_TIME_ALERT" class="form-text text-danger" style="display:none"></small>
										</div>
									</div>
									<div class="form-group row">
										<div id="SEND_TO_BSF_AREA" class="col-md-2 "><label for="SEND_TO" class="form-control-label wf-right">คำสั่ง/สอบถาม/แจ้ง จากระบบงาน <span class="text-danger">*</span></label></div>
										<div id="SEND_TO_BSF_AREA" class="col-md-2 wf-left">

											<select name="SYSTEM_ID" id="SYSTEM_ID" class="form-control" tabindex="-1" aria-hidden="true" required onChange="showFormPerType();">
												<option value="" disabled selected>เลือกระบบงาน</option>
												<?php
												$sql = "SELECT
										*
									  FROM M_CMD_SYSTEM
									  WHERE 1=1 AND CMD_SYSTEM_ID NOT IN (6) {$filterSystemId1}
									  ORDER BY SERVICE_SYS_NAME ASC
									  ";
												$query = db::query($sql);
												while ($rec = db::fetch_array($query)) {
												?>
													<option value="<?php echo $rec['CMD_SYSTEM_ID']; ?>" <?php echo $GET_SYSTEM_ID == $rec['CMD_SYSTEM_ID'] ? 'SELECTED' : '' ?>><?php echo $rec['SERVICE_SYS_NAME']; ?></option>
												<?php
												}
												?>
											</select>
										</div>

										<div class="col-md-2 show_per_type" style="display:none"></div>
										<div class="col-md-1 show_per_type" style="display:none">ประเภทบุคคล</div>
										<div class="col-md-2 show_per_type" style="display:none">
											<label><input type="radio" name="GET_PER_TYPE" id="GET_PER_TYPE" value="1" checked> บุคลากร</label>
											<label><input type="radio" name="GET_PER_TYPE" id="GET_PER_TYPE" value="2"> เจ้าหนี้</label>
										</div>
										<div id="CASE_TYPE_BSF_AREA" class="
								
								ol-md-1 wf-left show_per_type" style="display:none">
											<button type="button" class="btn btn-success" id="getCaseDataBackoffice" style="background-color: #191970;border-color: #191970;">ดึงข้อมูล</button>
										</div>
										<!-- <div class="col-md-2 show_fix_bankrupt_date" style="<?php echo ($rec_cmd["CMD_FIX_DATE_STATUS"] == 'Y') ? "" : "display:none;" ?>white-space:nowrap"><label><input type="checkbox" name="CMD_FIX_DATE_STATUS" id="CMD_FIX_DATE_STATUS" value="Y" onclick="showFormFixData();" <?php echo ($rec_cmd["CMD_FIX_DATE_STATUS"] == 'Y') ? "checked" : "" ?>> กำหนดวันปลดล้มละลายไว้ล่วงหน้า</label></div> -->
										<div id="CMD_DOC_DATE_BSF_AREA" class="col-md-1 show_fix_bankrupt_date2" style="<?php echo ($rec_cmd["CMD_FIX_DATE_STATUS"] == 'Y') ? "" : "display:none;" ?>">
											<label for="CMD_FIX_DOC_DATE" class="form-control-label">วันที่คำสั่งมีผล</label>
										</div>
										<div id="CMD_DOC_DATE_BSF_AREA" class="col-md-2 wf-left show_fix_bankrupt_date2" style="<?php echo ($rec_cmd["CMD_FIX_DATE_STATUS"] == 'Y') ? "" : "display:none;" ?>">
											<label class="input-group">
												<input name="CMD_FIX_DOC_DATE" id="CMD_FIX_DOC_DATE" value="<?php echo db2date($rec_cmd["CMD_FIX_DOC_DATE"]) ?>" class="form-control datepicker" placeholder="">
												<span class="input-group-addon bg-primary"><span class="icofont icofont-ui-calendar"></span></span>
											</label>
										</div>

									</div>

									<span id="show_form_source_input">
										<div class="form-group row">
											<div id="BLACK_CASE_BSF_AREA" class="col-md-2 ">
												<label for="BLACK_CASE" class="form-control-label wf-right">หมายเลขคดีดำ <span class="text-danger show_class_required">*</span></label>
											</div>
											<div id="T_BLACK_CASE_BSF_AREA" class="col-md-1 wf-left">
												<input type="text" name="T_BLACK_CASE" id="T_BLACK_CASE" class="form-control" value="<?php echo $GET_T_NO_BLACK; ?>" <?php echo $inputReadonly; ?>>
												<small id="DUP_T_BLACK_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
											</div>
											<div id="BLACK_CASE_BSF_AREA" class="col-md-1 wf-left">
												<input type="text" name="BLACK_CASE" id="BLACK_CASE" class="form-control" value="<?php echo $GET_TO_BLACK_CASE; ?>" <?php echo $inputReadonly; ?>>
												<small id="DUP_BLACK_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
											</div>
											<div id="BLACK_YY_BSF_AREA" class="col-md-1 wf-left">
												<div class="row">
													<div id="" class="col-md-1 wf-left">
														ปี
													</div>
													<div id="" class="col-md-5 wf-left">
														<input type="text" name="BLACK_YY" id="BLACK_YY" class="form-control" value="<?php echo $GET_TO_BLACK_YY; ?>" <?php echo $inputReadonly; ?>>
														<small id="DUP_BLACK_YY_ALERT" class="form-text text-danger" style="display:none"></small>
													</div>
												</div>
											</div>

											<div id="RED_CASE_BSF_AREA" class="col-md-2 ">
												<label for="RED_CASE" class="form-control-label wf-right">หมายเลขคดีแดง <span class="text-danger show_class_required">*</span></label>
											</div>
											<div id="T_RED_CASE_BSF_AREA" class="col-md-1 wf-left">
												<input type="text" name="T_RED_CASE" id="T_RED_CASE" class="form-control" value="<?php echo $GET_TO_T_RED_CASE; ?>" <?php echo $inputReadonly; ?>>
												<small id="DUPT_RED_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
											</div>
											<div id="RED_CASE_BSF_AREA" class="col-md-1 wf-left">
												<input type="text" name="RED_CASE" id="RED_CASE" class="form-control" value="<?php echo $GET_TO_RED_CASE; ?>" <?php echo $inputReadonly; ?>>
												<small id="DUP_RED_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
											</div>
											<div id="RED_YY_BSF_AREA" class="col-md-2 wf-left">
												<div class="row">
													<div id="RED_YY_BSF_AREA" class="col-md-1 wf-left">
														ปี
													</div>
													<div id="RED_YY_BSF_AREA" class="col-md-5 wf-left">
														<input type="text" name="RED_YY" id="RED_YY" class="form-control" value="<?php echo $GET_TO_RED_YY; ?>" <?php echo $inputReadonly; ?>>
														<small id="DUP_RED_YY_ALERT" class="form-text text-danger" style="display:none"></small>
													</div>
												</div>
											</div>

										</div>

										<div class="form-group row">
											<div id="CASE_TYPE_BSF_AREA" class="col-md-2 ">
												<label for="CMD_TYPE" class="form-control-label wf-right">ศาล <span class="text-danger show_class_required">*</span></label>
											</div>
											<div id="CASE_TYPE_BSF_AREA" class="col-md-5 wf-left">
												<select name="COURT_CODE" id="COURT_CODE" class="form-control <?php echo ($inputReadonly != "") ? "" : "select2 select2-hidden-accessible" ?>" tabindex="-1" aria-hidden="true" required>
													<option value="" disabled selected>ศาล</option>
													<?php
													$sqlCourt = "	SELECT 		COURT_CODE,COURT_NAME
												FROM 		M_COURT
												WHERE 		1=1 {$filterCourt1}
												ORDER BY 	COURT_CODE ASC
												";
													$queryCourt = db::query($sqlCourt);
													while ($recCourt = db::fetch_array($queryCourt)) {
													?>
														<option value="<?php echo $recCourt['COURT_CODE']; ?>" <?php echo ($GET_COURT_CODE == $recCourt['COURT_CODE']) ? "selected" : ""; ?>><?php echo $recCourt['COURT_NAME']; ?></option>
													<?php
													}
													?>
												</select>
											</div>
											<div id="CASE_TYPE_BSF_AREA" class="col-md-1 wf-left">
												<button type="button" class="btn btn-success" id="getCaseData" style="background-color: #191970;border-color: #191970;">ดึงข้อมูลคดี</button>
											</div>
											<!-- <div id="CASE_TYPE_BSF_AREA" class="col-md-1 wf-left">
										<button type="button" class="btn btn-success" id="getCaseDataAsset1" style="background-color: #191970;border-color: #191970;">ดึงข้อมูลทรัพย์</button>
									</div> -->
										</div>
										<div class="form-group row">
											<div id="NAME_REQ" class="col-md-2 ">
												<label for="NAME_REQ" class="form-control-label wf-right">โจทก์</label>
											</div>
											<div id="PLAINTIFF_PRE_NAME_AREA" class="col-md-8 wf-left">
												<input type="text" name="D_C" id="D_C" class="form-control" value="<?php echo $GET_PLAINTIFF; ?>">
												<small id="DUP_PLAINTIFF_PRE_NAME_ALERT" class="form-text text-danger" style="display:none"></small>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-2">
												<label for="DEPT_NAME" class="form-control-label wf-right">จำเลย</label>
											</div>
											<div id="DEPT_NAME" class="col-md-8 wf-left">
												<input type="text" name="D_NAME" id="D_NAME" class="form-control" value="<?php echo $GET_DEFENDANT; ?>">
												<input type="hidden" id="CMD_PRIORITY_STATUS" value="">
												<input type="hidden" id="CMD_READ_STATUS" value="0">
												<small id="DEPT_NAME" class="form-text text-danger" style="display:none"></small>
											</div>
										</div>
									</span>




									<span id="hide_form_send_to" style="<?php echo ($rec_cmd["CMD_FIX_DATE_STATUS"] == 'Y') ? "display:none;" : "" ?>">


										<div class="form-group row">
											<div id="CASE_TYPE_BSF_AREA" class="col-md-12 ">
												<hr>
											</div>
										</div>

										<div class="form-group row">
											<div id="CASE_TYPE_BSF_AREA" class="col-md-2 ">
												<label for="CASE_TYPE" class="form-control-label wf-right">ส่งถึงระบบ <span class="text-danger">*</span></label>
											</div>
											<div id="SEND_TO_BSF_AREA" class="col-md-2 wf-left">
												<select name="SEND_TO" id="SEND_TO" class="form-control" tabindex="-1" aria-hidden="true" required onChange="showFormPerType2();">
													<option value="" disabled selected>เลือกระบบงาน</option>
													<?php
													$sql = "SELECT
									*
								  FROM M_CMD_SYSTEM
								  WHERE 1=1 {$filterSystemId2}
								  ORDER BY SERVICE_SYS_NAME ASC
								  ";
													$query = db::query($sql);
													while ($rec = db::fetch_array($query)) {
													?>
														<option value="<?php echo $rec['CMD_SYSTEM_ID']; ?>" <?php echo $GET_SEND_TO  == $rec['CMD_SYSTEM_ID'] ? 'SELECTED' : '' ?>><?php echo $rec['SERVICE_SYS_NAME']; ?></option>
													<?php
													}
													?>
												</select>
											</div>



										</div>

										<span id="form_dept_to_backoffice">
											<div id="CASE_TYPE_BSF_AREA" class="col-md-2 ">
												<label for="CASE_TYPE" class="form-control-label wf-right">หน่วยงาน <span class="text-danger">*</span></label>
											</div>
											<div id="SEND_TO_BSF_AREA" class="col-md-2 wf-left">
												<select name="TO_DEPT_NAME" id="TO_DEPT_NAME" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true" required>
													<?php
													$sqlDept = "	SELECT 		ORG_NAME
											FROM 		WH_BACKOFFICE_PERSON
											WHERE 		ORG_ID > 0
											GROUP BY 	ORG_NAME
											order by 	ORG_NAME
									  ";
													$queryDept = db::query($sqlDept);
													while ($recDept = db::fetch_array($queryDept)) {
													?>
														<option value="<?php echo $recDept['ORG_NAME']; ?>"><?php echo $recDept['ORG_NAME']; ?></option>
													<?php
													}
													?>
												</select>
											</div>
										</span>


										<div class="form-group row">
											<div class="col-md-12"></div>
										</div>

										<span id="show_form_source_input2">

											<div class="form-group row">
												<div id="BLACK_CASE_BSF_AREA" class="col-md-2 ">
													<label for="BLACK_CASE" class="form-control-label wf-right">หมายเลขคดีดำปลายทาง <span class="text-danger show_class_required2">*</span></label>
												</div>
												<div id="T_BLACK_CASE_BSF_AREA" class="col-md-1 wf-left">
													<input type="text" name="TO_T_BLACK_CASE" id="TO_T_BLACK_CASE" class="form-control" value="<?php echo $GET_FORM_PREFIX_BCASE; ?>" <?php echo $inputReadonly; ?>>
													<small id="DUP_T_BLACK_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
												</div>
												<div id="BLACK_CASE_BSF_AREA" class="col-md-1 wf-left">
													<input type="text" name="TO_BLACK_CASE" id="TO_BLACK_CASE" class="form-control" value="<?php echo $GET_FORM_BLACK_CASE; ?>" <?php echo $inputReadonly; ?>>
													<small id="DUP_BLACK_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
												</div>
												<div id="BLACK_YY_BSF_AREA" class="col-md-1 wf-left">
													<div class="row">
														<div id="" class="col-md-1 wf-left">
															ปี
														</div>
														<div id="" class="col-md-5 wf-left">
															<input type="text" name="TO_BLACK_YY" id="TO_BLACK_YY" class="form-control" value="<?php echo $GET_FORM_BLACK_YY; ?>" <?php echo $inputReadonly; ?>>
															<small id="DUP_BLACK_YY_ALERT" class="form-text text-danger" style="display:none"></small>
														</div>
													</div>
												</div>
												<div id="RED_CASE_BSF_AREA" class="col-md-2 ">
													<label for="RED_CASE" class="form-control-label wf-right">หมายเลขคดีแดงปลายทาง <span class="text-danger show_class_required2">*</span></label>
												</div>
												<div id="T_RED_CASE_BSF_AREA" class="col-md-1 wf-left">
													<input type="text" name="TO_T_RED_CASE" id="TO_T_RED_CASE" class="form-control" value="<?php echo $GET_FORM_PREFIX_RCASE; ?>" <?php echo $inputReadonly; ?>>
													<small id="DUPT_RED_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
												</div>
												<div id="RED_CASE_BSF_AREA" class="col-md-1 wf-left">
													<input type="text" name="TO_RED_CASE" id="TO_RED_CASE" class="form-control" value="<?php echo $GET_FORM_RED_CASE; ?>" <?php echo $inputReadonly; ?>>
													<small id="DUP_RED_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
												</div>
												<div id="RED_YY_BSF_AREA" class="col-md-2 wf-left">
													<div class="row">
														<div id="RED_YY_BSF_AREA" class="col-md-1 wf-left">
															ปี
														</div>
														<div id="RED_YY_BSF_AREA" class="col-md-5 wf-left">
															<input type="text" name="TO_RED_YY" id="TO_RED_YY" class="form-control" value="<?php echo $GET_FORM_RED_YY; ?>" <?php echo $inputReadonly; ?>>
															<small id="DUP_RED_YY_ALERT" class="form-text text-danger" style="display:none"></small>
														</div>
													</div>
												</div>

											</div>

											<div class="form-group row">
												<div id="TO_COURT_NAME_BSF_AREA" class="col-md-2 wf-left">
													<label for="TO_COURT_NAME" class="form-control-label wf-right">ศาลปลายทาง <span class="text-danger show_class_required2">*</span></label>
												</div>
												<div id="TO_COURT_NAME_BSF_AREA" class="col-md-5 wf-left">
													<select name="TO_COURT_CODE" id="TO_COURT_CODE" class="form-control <?php echo ($inputReadonly != "") ? "" : "select2 select2-hidden-accessible" ?>" tabindex="-1" aria-hidden="true" required>
														<option value="" disabled selected>ศาล</option>
														<?php
														$sqlCourt = "SELECT
											COURT_CODE,COURT_NAME
										  FROM M_COURT
										  WHERE 1=1 {$filterCourt2}
										  ORDER BY COURT_CODE ASC
										  ";
														$queryCourt = db::query($sqlCourt);
														while ($recCourt = db::fetch_array($queryCourt)) {
														?>
															<option value="<?php echo $recCourt['COURT_CODE']; ?>" <?php echo ($GET_TO_COURT_CODE == $recCourt['COURT_CODE']) ? "selected" : "" ?>><?php echo $recCourt['COURT_NAME']; ?></option>
														<?php
														}
														?>
													</select>

												</div>
												<!-- <div id="CASE_TYPE_BSF_AREA" class="col-md-1 wf-left">
											<button type="button" class="btn btn-success" id="getCaseData2" style="background-color: #191970;border-color: #191970;">ดึงข้อมูลคดี</button>
										</div> -->
												<!-- <div id="CASE_TYPE_BSF_AREA" class="col-md-1 wf-left">
											<button type="button" class="btn btn-success" id="getCaseDataAsset2" style="background-color: #191970;border-color: #191970;">ดึงข้อมูลทรัพย์</button>
										</div> -->
											</div>
											<div class="form-group row">
												<div id="NAME_REQ" class="col-md-2 ">
													<label for="NAME_REQ" class="form-control-label wf-right">โจทก์</label>
												</div>
												<div id="PLAINTIFF_PRE_NAME_AREA" class="col-md-8 wf-left">
													<input type="text" name="TO_PLAINTIFF" id="TO_PLAINTIFF" class="form-control" value="<?php echo $TO_PLAINTIFF; ?>" <?php echo $inputReadonly; ?>>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-md-2">
													<label for="DEPT_NAME" class="form-control-label wf-right">จำเลย</label>
												</div>
												<div id="DEPT_NAME" class="col-md-8 wf-left">
													<input type="text" name="TO_DEFENDANT" id="TO_DEFENDANT" class="form-control" value="<?php echo $TO_DEFENDANT; ?>" <?php echo $inputReadonly; ?>>
												</div>
											</div>
										</span>

									</span>



									<div class="form-group row">
										<div id="CASE_TYPE_BSF_AREA" class="col-md-12 ">
											<hr>
										</div>
									</div>

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

									<!------------------------------------------------------------------------------------------------------------------------------------------------------------------->

									<div class="form-group row">
										<div class="col-md-12 wf-center ">
											<label for="" class="form-control-label wf-center">บุคคลที่เกี่ยวข้องตามคำสั่ง</label>
											<div class="table-responsive">
												<table id="wfsflow" class="table table-bordered sorted_table">
													<thead class="bg-primary">
														<tr class="bg-primary">
															<th style="width:5%;" class="text-center">ลำดับ</th>
															<th style="width:35%;" class="text-center">ชื่อ</th>
															<th style="width:30%;" class="text-center">ประเภทกลุ่มคำสั่งเจ้าพนักงาน</th>
															<th style="width:30%;" class="text-center">คำสั่งเจ้าพนักงาน</th>
														</tr>
													</thead>
													<tbody id="wfs_show_person">
														<?php
														$filter = "";
														if ($rec_cmd["T_BLACK_CASE"] != "") {
															$filter .= " and PREFIX_BLACK_CASE = '" . $rec_cmd['T_BLACK_CASE'] . "'	";
														}
														if ($rec_cmd["BLACK_CASE"] != "") {
															$filter .= " and BLACK_CASE = '" . $rec_cmd['BLACK_CASE'] . "'	";
														}
														if ($rec_cmd["BLACK_YY"] != "") {
															$filter .= " and BLACK_YY = '" . $rec_cmd['BLACK_YY'] . "'	";
														}
														if ($rec_cmd["T_RED_CASE"] != "") {
															$filter .= " and PREFIX_RED_CASE = '" . $rec_cmd['T_RED_CASE'] . "'	";
														}
														if ($rec_cmd["RED_CASE"] != "") {
															$filter .= " and RED_CASE = '" . $rec_cmd['RED_CASE'] . "'	";
														}
														if ($rec_cmd["RED_YY"] != "") {
															$filter .= " and RED_YY = '" . $rec_cmd['RED_YY'] . "'	";
														}
														if ($rec_cmd["COURT_CODE"] != "") {
															if ($rec_cmd['COURT_CODE'] == '010030' || $rec_cmd['COURT_CODE'] == '050') {
																$filter .= " and (COURT_CODE = '010030'	or COURT_CODE = '050')";
															} else {
																$filter .= " and COURT_CODE = '" . $rec_cmd['COURT_CODE'] . "'	";
															}
														}
														if ($_GET["REF_ID"] != "") {
															$filter .= " and REGISTER_CODE in (SELECT ID_CARD FROM M_CMD_PERSON WHERE CMD_ID = '" . $_GET['REF_ID'] . "')	";
														}


														if ($rec_cmd["CMD_SYSTEM"] == 1) { //ระบบงานบังคับคดีแพ่ง
															$sqlSelectDataPerson = "	select 		a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'Mediate' as SYSTEM_TYPE
															from 		".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')." a
															where 		1=1 {$filter}
															order by 	CONCERN_CODE asc
															";
														} else if ($rec_cmd["CMD_SYSTEM"] == 2) { //ระบบงานบังคับคดีล้มละลาย
															$sqlSelectDataPerson = "	select 		a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'Bankrupt' as SYSTEM_TYPE
															from 		WH_BANKRUPT_CASE_PERSON a 
															where 		1=1 {$filter}
															order by 	CONCERN_CODE asc";
														} else if ($rec_cmd["CMD_SYSTEM"] == 3) { //ระบบงานฟื้นฟูกิจการของลูกหนี้
															$sqlSelectDataPerson = "	select 		a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'Revive' as SYSTEM_TYPE
															from 		WH_REHABILITATION_PERSON a
															where 		1=1 {$filter}
															order by 	CONCERN_CODE asc";
														} else if ($rec_cmd["CMD_SYSTEM"] == 4) { //ระบบงานไกล่เกลี่ยข้อพิพาท
															$sqlSelectDataPerson = "	select 		a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'Civil' as SYSTEM_TYPE
															from 		WH_MEDIATE_PERSON a
															where 		1=1 {$filter}
															order by 	CONCERN_CODE asc";
														} else if ($rec_cmd["CMD_SYSTEM"] == 5) { //ระบบงานไกล่เกลี่ยข้อพิพาท
															if ($rec_cmd["GET_PER_TYPE"] == 1) {
																$filter = "";
																if ($_GET["REF_ID"] != "") {
																	$filter = " and USR_OPTION9 in (SELECT ID_CARD FROM M_CMD_PERSON WHERE CMD_ID = '" . $_GET['REF_ID'] . "')	";
																}
																$sqlSelectDataPerson = "	select 		USR_OPTION9 as REGISTER_CODE,USR_PREFIX as PREFIX_NAME,USR_FNAME as FIRST_NAME,USR_LNAME as LAST_NAME,'' as CONCERN_CODE,'' as CONCERN_NAME,USR_OPTION9 as REGISTER_CODE,'' as PREFIX_BLACK_CASE,'' as BLACK_CASE,'' as BLACK_YY,'' as PREFIX_RED_CASE,'' as RED_CASE,'' as RED_YY,'' as COURT_NAME,'' as COURT_CODE,'' as ADDRESS,'' as TUM_NAME,'' as AMP_NAME,'' as PROV_NAME,'' as ZIP_CODE,'Backoffice' as SYSTEM_TYPE
																		from 		USR_MAIN a
																		where 		1=1 {$filter}";
															} else {
																if ($_GET["REF_ID"] != "") {
																	$filter = " and WH_CREDITOR_ID_CARD in (SELECT ID_CARD FROM M_CMD_PERSON WHERE CMD_ID = '" . $_GET['REF_ID'] . "')	";
																}
																$sqlSelectDataPerson = "	select 		WH_CREDITOR_ID_CARD as REGISTER_CODE,WH_CREDITOR_PREFIX as PREFIX_NAME,WH_CREDITOR_FNAME as FIRST_NAME,WH_CREDITOR_LNAME as LAST_NAME,'' as CONCERN_CODE,WH_CREDITOR_ID_CARD as CONCERN_NAME,WH_CREDITOR_ID_CARD as REGISTER_CODE,'' as PREFIX_BLACK_CASE,'' as BLACK_CASE,'' as BLACK_YY,'' as PREFIX_RED_CASE,'' as RED_CASE,'' as RED_YY,'' as COURT_NAME,'' as COURT_CODE,'' as ADDRESS,'' as TUM_NAME,'' as AMP_NAME,'' as PROV_NAME,'' as ZIP_CODE,'Backoffice' as SYSTEM_TYPE
																		from 		WH_CREDITOR a
																		where 		1=1 {$filter}";
															}
														}
														//echo $sqlSelectDataPerson;
														$querySelectDataPerson = db::query($sqlSelectDataPerson);
														$num_per = 1;
														while ($recSelectDataPerson = db::fetch_array($querySelectDataPerson)) {

															$sqlSelectCmdPerson = "SELECT ID_CARD,PERSON_CMD_TYPE,PERSON_CASE_TYPE FROM M_CMD_PERSON WHERE CMD_ID = '" . $_GET['ID'] . "' AND ID_CARD = '" . $recSelectDataPerson["REGISTER_CODE"] . "'";
															$querySelectCmdPerson = db::query($sqlSelectCmdPerson);
															$recSelectCmdPerson = db::fetch_array($querySelectCmdPerson);
														?>
															<tr>
																<td align="center">
																	<?php
																	if ($_GET["REF_ID"] != "") {
																	?>
																		<input type="hidden" name="LIST_REGISTER_CODE[<?php echo $recSelectDataPerson["REGISTER_CODE"] ?>]" id="LIST_REGISTER_CODE<?php echo $recSelectDataPerson["REGISTER_CODE"] ?>" value="<?php echo $recSelectDataPerson["REGISTER_CODE"] ?>"><?php echo $num_per; ?>
																	<?php
																	} else {
																	?>
																		<label><input type="checkbox" name="LIST_REGISTER_CODE[<?php echo $recSelectDataPerson["REGISTER_CODE"]; ?>]" id="LIST_REGISTER_CODE<?php echo $recSelectDataPerson["REGISTER_CODE"]; ?>" value="<?php echo $recSelectDataPerson["REGISTER_CODE"]; ?>" <?php echo ($recSelectDataPerson["REGISTER_CODE"] == $recSelectCmdPerson["ID_CARD"]) ? "checked" : ""; ?>> <?php echo $num_per; ?></label>
																	<?php
																	}
																	?>
																</td>
																<td><?php echo $recSelectDataPerson["CONCERN_NAME"] . " : " . $recSelectDataPerson["PREFIX_NAME"] . $recSelectDataPerson["FIRST_NAME"] . " " . $recSelectDataPerson["LAST_NAME"] ?></td>
																<td>
																	<select name="CMD_TYPE_PERSON[<?php echo $recSelectDataPerson["REGISTER_CODE"] ?>]" id="CMD_TYPE_PERSON_<?php echo $recSelectDataPerson["REGISTER_CODE"] ?>" class="form-control select2" tabindex="-1" aria-hidden="true" required onChange="getCaseTypePerson('<?php echo $recSelectDataPerson["REGISTER_CODE"] ?>')">
																		<option value="" disabled selected>เลือกประเภทกลุ่มคำสั่ง</option>
																		<?php $sql = "SELECT DISTINCT
													CMD_GRP_NAME,B.CMD_TYPE_ID
													FROM
													M_CMD_TYPE A
													LEFT JOIN M_SERVICE_CMD B ON A.CMD_TYPE_ID = B.CMD_TYPE_ID
													LEFT JOIN M_CMD_SYSTEM C ON B.CMD_SYS_ID = C.CMD_SYSTEM_ID
													WHERE GRP_NOTI_FLAG = '1'
													ORDER BY
													A.CMD_GRP_NAME ASC";
																		$query = db::query($sql);
																		$i = 0;
																		while ($rec = db::fetch_array($query)) {
																		?>
																			<option value="<?php echo $rec['CMD_TYPE_ID']; ?>" <?php echo ($recSelectCmdPerson["PERSON_CMD_TYPE"] == $rec['CMD_TYPE_ID']) ? "selected" : ""; ?>><?php echo $rec['CMD_GRP_NAME']; ?></option>
																		<?php
																		}
																		?>
																	</select>
																</td>
																<td>
																	<select name="CASE_TYPE_PERSON[<?php echo $recSelectDataPerson["REGISTER_CODE"] ?>]" id="CASE_TYPE_PERSON_<?php echo $recSelectDataPerson["REGISTER_CODE"] ?>" class="form-control select2" tabindex="-2">
																		<?php
																		$sql2 = "	SELECT 		DISTINCT CMD_TYPE_NAME,CMD_TYPE_CODE
															FROM 		M_SERVICE_CMD A
															LEFT JOIN 	M_CMD_SYSTEM B ON A.CMD_SYS_ID = B.CMD_SYSTEM_ID
															LEFT JOIN 	M_CMD_TYPE C ON A.CMD_TYPE_ID = C.CMD_TYPE_ID
															WHERE 		A.CMD_TYPE_ID = '" . $recSelectCmdPerson["PERSON_CMD_TYPE"] . "'AND CMD_STATUS = 1 and b.CMD_SYSTEM_ID = " . $rec_cmd["CMD_SYSTEM"] . "
															ORDER BY 	A.CMD_TYPE_NAME ASC";
																		$query2 = db::query($sql2);
																		$i = 0;
																		?>
																		<option value="" disabled selected>เลือกคำสั่ง</option>
																		<?php
																		while ($dataqry = db::fetch_array($query2)) {
																		?>
																			<option value="<?php echo $dataqry['CMD_TYPE_CODE']; ?>" <?php echo ($recSelectCmdPerson["PERSON_CASE_TYPE"] == $dataqry['CMD_TYPE_CODE']) ? "selected" : ""; ?>><?php echo $dataqry['CMD_TYPE_NAME']; ?></option>
																		<?php
																		}
																		?>
																	</select>
																</td>
															</tr>
															<input type="hidden" name="GET_PREFIX_NAME[<?php echo $recSelectDataPerson["REGISTER_CODE"] ?>]" id="GET_PREFIX_NAME<?php echo $recSelectDataPerson["REGISTER_CODE"] ?>" value="<?php echo $recSelectDataPerson["PREFIX_NAME"] ?>">
															<input type="hidden" name="GET_FIRST_NAME[<?php echo $recSelectDataPerson["REGISTER_CODE"] ?>]" id="GET_FIRST_NAME<?php echo $recSelectDataPerson["REGISTER_CODE"] ?>" value="<?php echo $recSelectDataPerson["FIRST_NAME"] ?>">
															<input type="hidden" name="GET_LAST_NAME[<?php echo $recSelectDataPerson["REGISTER_CODE"] ?>]" id="TYPE_CODE_<?php echo $recSelectDataPerson["REGISTER_CODE"] ?>" value="<?php echo $recSelectDataPerson["LAST_NAME"] ?>">
														<?php
															$num_per++;
														}
														?>
													</tbody>
												</table>
											</div>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-md-12 wf-center ">
											<label for="" class="form-control-label wf-center">รายการทรัพย์</label>

											<div class="table-responsive">
												<table id="wfsflow" class="table table-bordered sorted_table">
													<thead class="bg-primary">
														<tr class="bg-primary">
															<th style="width:5%;" class="text-center">ลำดับ</th>
															<th style="width:25%;" class="text-center">รายการทรัพย์</th>
															<th style="width:20%;" class="text-center">ประเภทกลุ่มคำสั่งเจ้าพนักงาน</th>
															<th style="width:20%;" class="text-center">คำสั่งเจ้าพนักงาน</th>
															<th style="width:10%;" class="text-center">สถานะ</th>
															<th style="width:25%;" class="text-center">action</th>
														</tr>
													</thead>
													<style>
														/* .select2-selection__rendered {
															width: 300px;
														} */
													</style>

													<tbody id="wfs_show_asset">
														<?php
														$fileterAsset = "";
														if ($_GET["proc"] == "edit") {
															$fileterAsset = " AND CMD_ID = " . $_GET['ID'] . "";
														} else {
															if ($_GET['REF_ID'] > 0) {
																$fileterAsset = " AND CMD_ID = " . $_GET['REF_ID'] . "";
															}
														}
														if ($fileterAsset != "") {
															$i = 1;
															$sqlSelectCmdAsset 		= "select * from M_CMD_ASSET where 1=1 {$fileterAsset}";
															$querySelectCmdAsset 	= db::query($sqlSelectCmdAsset);
															while ($recSelectCmdAsset = db::fetch_array($querySelectCmdAsset)) {
														?>
																<tr>
																	<td align="center"><?php echo $i; ?></td>
																	<td><a onclick="show_asset_detail(<?php echo $recSelectCmdAsset['ASSET_ID']; ?>)" href="javascript:void();"><?php echo $recSelectCmdAsset["PROP_DET"]; ?></a></td>
																	<td>

																		<select name="CMD_TYPE[<?php echo $recSelectCmdAsset["ASSET_ID"] ?>]" id="CMD_TYPE_<?php echo $recSelectCmdAsset["ASSET_ID"] ?>" class="form-control select2" tabindex="-1" aria-hidden="true" required onChange="getCaseType('<?php echo $recSelectCmdAsset["ASSET_ID"] ?>')">
																			<option value="" disabled selected>เลือกประเภทกลุ่มคำสั่ง</option>
																			<?php $sql = "SELECT DISTINCT
															CMD_GRP_NAME,B.CMD_TYPE_ID
															FROM
															M_CMD_TYPE A
															LEFT JOIN M_SERVICE_CMD B ON A.CMD_TYPE_ID = B.CMD_TYPE_ID
															LEFT JOIN M_CMD_SYSTEM C ON B.CMD_SYS_ID = C.CMD_SYSTEM_ID
															WHERE GRP_NOTI_FLAG = '1'
															ORDER BY
															A.CMD_GRP_NAME ASC";
																			$query = db::query($sql);
																			while ($rec = db::fetch_array($query)) {
																			?>
																				<option value="<?php echo $rec['CMD_TYPE_ID']; ?>" <?php echo ($recSelectCmdAsset["ASSET_CMD_TYPE"] == $rec['CMD_TYPE_ID']) ? "selected" : ""; ?>><?php echo $rec['CMD_GRP_NAME']; ?></option>
																			<?php
																			}
																			?>
																		</select>
																	</td>
																	<td>
																		<div class="col-md-2">
																			<select name="CASE_TYPE[<?php echo $recSelectCmdAsset["ASSET_ID"] ?>]" id="CASE_TYPE_<?php echo $recSelectCmdAsset["ASSET_ID"] ?>" class="form-control select2" tabindex="-2">
																				<?php
																				$sql2 = "	SELECT 		DISTINCT CMD_TYPE_NAME,CMD_TYPE_CODE
																	FROM 		M_SERVICE_CMD A
																	LEFT JOIN 	M_CMD_SYSTEM B ON A.CMD_SYS_ID = B.CMD_SYSTEM_ID
																	LEFT JOIN 	M_CMD_TYPE C ON A.CMD_TYPE_ID = C.CMD_TYPE_ID
																	WHERE 		A.CMD_TYPE_ID = '" . $recSelectCmdAsset["ASSET_CMD_TYPE"] . "'AND CMD_STATUS = 1 and b.CMD_SYSTEM_ID = " . $rec_cmd["CMD_SYSTEM"] . "
																	ORDER BY 	A.CMD_TYPE_NAME ASC";
																				$query2 = db::query($sql2);
																				?>
																				<option value="" disabled selected>เลือกคำสั่ง</option>
																				<?php
																				while ($dataqry = db::fetch_array($query2)) {
																				?>
																					<option value="<?php echo $dataqry['CMD_TYPE_CODE']; ?>" <?php echo ($dataqry["CMD_TYPE_CODE"] == $dataqry['CMD_TYPE_CODE']) ? "selected" : ""; ?>><?php echo $dataqry['CMD_TYPE_NAME']; ?></option>
																				<?php
																				}
																				?>
																			</select>
																		</div>

																	</td>
																	<td>
																		<?php echo $recSelectCmdAsset["PROP_STATUS_NAME"]; ?>
																		<input type="hidden" name="ASSET_ID[<?php echo $recSelectCmdAsset["ASSET_ID"] ?>]" id="PROP_TITLE_<?php echo $recSelectCmdAsset["ASSET_ID"] ?>" value="<?php echo $recSelectCmdAsset["ASSET_ID"] ?>">
																		<input type="hidden" name="PROP_TITLE[<?php echo $recSelectCmdAsset["ASSET_ID"] ?>]" id="PROP_TITLE_<?php echo $recSelectCmdAsset["ASSET_ID"] ?>" value="<?php echo $recSelectCmdAsset["PROP_DET"] ?>">
																		<input type="hidden" name="TYPE_CODE[<?php echo $recSelectCmdAsset["ASSET_ID"] ?>]" id="TYPE_CODE_<?php echo $recSelectCmdAsset["ASSET_ID"] ?>" value="<?php echo $recSelectCmdAsset["TYPE_CODE"] ?>">
																		<input type="hidden" name="TYPE_DESC_[<?php echo $recSelectCmdAsset["ASSET_ID"] ?>]" id="TYPE_DESC_<?php echo $recSelectCmdAsset["ASSET_ID"] ?>" value="<?php echo $recSelectCmdAsset["TYPE_DESC"] ?>">
																		<input type="hidden" name="PROP_STATUS[<?php echo $recSelectCmdAsset["ASSET_ID"] ?>]" id="PROP_STATUS_<?php echo $recSelectCmdAsset["ASSET_ID"] ?>" value="<?php echo $recSelectCmdAsset["PROP_STATUS"] ?>">
																		<input type="hidden" name="PROP_STATUS_NAME[<?php echo $recSelectCmdAsset["ASSET_ID"] ?>]" id="PROP_STATUS_NAME_<?php echo $recSelectCmdAsset["ASSET_ID"] ?>" value="<?php echo $recSelectCmdAsset["PROP_STATUS_NAME"] ?>">
																		<input type="hidden" name="CFC_CAPTION_GEN[<?php echo $recSelectCmdAsset["ASSET_ID"] ?>]" id="CFC_CAPTION_GEN_<?php echo $recSelectCmdAsset["ASSET_ID"] ?>" value="<?php echo $recSelectCmdAsset["CFC_CAPTION_GEN"] ?>">
																	</td>
																</tr>
														<?php
																$i++;
															}
														}
														?>
													</tbody>
												</table>
											</div>
										</div>
									</div>


									<script>
										$(document).ready(function() {
											let text_cmd_not = "ตรวจพบ" +
												$('#CMD_NOTE').val(text_cmd_not);

										});
									</script>
									<div class="form-group row">
										<div id="CMD_NOTE_BSF_AREA" class="col-md-2 ">
											<label for="CMD_NOTE" class="form-control-label wf-right">รายละเอียด <!-- <span class="text-danger">*</span> --></label>
										</div>
										<div id="CMD_NOTE_BSF_AREA" class="col-md-6 wf-left">
											<textarea class="form-control" name="CMD_NOTE" id="CMD_NOTE" cols="80" rows="10"><?php echo $text_param_cmd;  ?></textarea>
										</div>
									</div>
									<div class="form-group row">
										<div id="CASE_TYPE_BSF_AREA" class="col-md-2 ">
											<label for="CASE_TYPE" class="form-control-label wf-right">เสนอผู้พิจารณา <!-- <span class="text-danger">*</span> --></label>
										</div>
										<div id="SEND_TO_BSF_AREA" class="col-md-5 wf-left">
											<select name="APPROVE_PERSON" id="APPROVE_PERSON" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
												<option value="" disabled selected>เลือกผู้พิจารณาคำสั่ง</option>
												<?php
												/* $sql = "SELECT 	DISTINCT REGISTER_CODE,PREFIX_NAME,FIRST_NAME,LAST_NAME
								  FROM		WH_BACKOFFICE_PERSON A
								  WHERE		1=1 AND ORG_ID IN (SELECT AA.ORG_ID FROM WH_BACKOFFICE_PERSON AA WHERE AA.REGISTER_CODE = '" . $_REQUEST["TO_PERSON_ID"] . "')
								  ORDER BY 	FIRST_NAME ASC"; */
												$sql = "SELECT 	DISTINCT REGISTER_CODE,PREFIX_NAME,FIRST_NAME,LAST_NAME
								  FROM		WH_BACKOFFICE_PERSON A
								  WHERE		1=1 
								  ORDER BY 	FIRST_NAME ASC";
												$query = db::query($sql);
												while ($rec = db::fetch_array($query)) {
												?>
													<option value="<?php echo $rec['REGISTER_CODE']; ?>" <?php echo ($rec_cmd["APPROVE_PERSON"] == $rec['REGISTER_CODE'] && $rec_cmd["APPROVE_PERSON"] != "") ? "selected" : "" ?>><?php echo $rec['PREFIX_NAME'] . $rec['FIRST_NAME'] . " " . $rec['LAST_NAME'] ?></option>
												<?php
												}
												?>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-12"></div>
									</div>

									<div class="form-group row">
										<div id="SEND_TO_BSF_AREA" class="col-md-2 "><label for="SEND_TO" class="form-control-label wf-right"></label></div>
										<div id="SEND_TO_BSF_AREA" class="col-md-5 wf-left"><label><input type="checkbox" name="CMD_MANUAL_STATUS" id="CMD_MANUAL_STATUS" value="Y"> ดำเนินการด้วยคำสั่งศาล/จพท ที่มีอยู่</label></div>
									</div>

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
																	<th style="width:;" class="text-center">ประเภทเอกสาร</th>
																	<th style="width:;" class="text-center">แนบไฟล์</th>
																	<th style="width: 10%;" class="text-center"></th>
																</tr>
															</thead>
															<tbody id="wfs_show1441">

															</tbody>
														</table>
													</div>
													<input type="text" id="wfsflow-chk-1441" value="" style="opacity: 0;width:1px;height:1px;position:absolute;top:15px;">
													<script type="text/javascript">
														function WFS_UPDATE1441() {
															var row_num = $('#wfsflow-1441 tbody tr');
															if (row_num.length > 0) {
																$('#wfsflow-chk-1441').val(row_num.length);
															} else {
																$('#wfsflow-chk-1441').val('');
															}
															for (var x = 0; x < row_num.length; x++) {
																$('#wfsflow-1441 tbody tr:eq(' + x + ') td:eq(0)').html((x + 1));
															}
														}

														$('#wfs_show1441 input').blur(function() {
															WFS_UPDATE1441();
														});
														$(document).ready(function() {
															WFS_UPDATE1441();
														});
													</script>
													<script type="text/javascript">
														$(document).ready(function() {
															$('select.select2').select2({
																allowClear: true,
																placeholder: function() {
																	$(this).data('placeholder');
																}
															});
															$('select.select2-province').select2({
																allowClear: true,
																placeholder: 'เลือกจังหวัด'
															});
															$('select.select2-amphur').select2({
																allowClear: true,
																placeholder: 'เลือกอำเภอ'
															});
															$('select.select2-tambon').select2({
																allowClear: true,
																placeholder: 'เลือกตำบล'
															});
															$('textarea').autosize();
															$('input[maxlength]').maxlength();
															$(".datepicker, .datepicker_en").inputmask({
																mask: "99/99/9999"
															});
															$('.datepicker:not(:read-only)').datepicker({
																format: "dd/mm/yyyy",
																language: "th-th",
																autoclose: true,
																todayHighlight: true
															});
															$('.datepicker_en:not(:read-only)').datepicker({
																format: "dd/mm/yyyy",
																autoclose: true,
																todayHighlight: true
															});
															/*$(".datepicker").inputmask({ mask: "99/99/9999"});
															$('.datepicker').datepicker({
															format: "dd/mm/yyyy",
															language: 'th-th',
															autoclose: true,
															todayHighlight: true,
															}).on('changeDate', function (ev) {
															$(this).datepicker('hide');
															$(this).blur();
															});
															$(".datepicker_en").inputmask({ mask: "99/99/9999"});
															$('.datepicker_en').datepicker({
															format: "dd/mm/yyyy",
															language: 'en',
															autoclose: true,
															todayHighlight: true,
															}).on('changeDate', function (ev) {
															$(this).datepicker('hide');
															$(this).blur();
															});*/
															$("input:file[multiple]").change(function(e, v) {
																var input = document.getElementById(this.id);
																var img_name = [];
																for (var x = 0; x < input.files.length; x++) {
																	img_name[x] = input.files[x].name;
																}
																$(this).parent().children('.md-form-file').val(img_name.join(', '));
															});
															$("input:file[single]").change(function(e, v) {
																var pathArray = $(this).val().split('\\');
																var img_name = pathArray[pathArray.length - 1];
																$(this).parent().children('.md-form-file').val(img_name);
															});
															$('textarea.max-textarea').maxlength({
																alwaysShow: true
															});
															$(".select2-single-amphur").select2({
																ajax: {
																	url: "../process/load_area.php",
																	dataType: 'json',
																	delay: 250,
																	data: function(params) {
																		return {
																			qa: params.term
																		};
																	},
																	processResults: function(data) {
																		return {
																			results: $.map(data, function(obj) {
																				return {
																					id: obj.id,
																					text: obj.text
																				};
																			})
																		};
																	},
																	cache: true
																},
																minimumInputLength: 2,
																allowClear: true
															});
															$(".select2-single-tambon").select2({
																ajax: {
																	url: "../process/load_area.php",
																	dataType: 'json',
																	delay: 250,
																	data: function(params) {
																		return {
																			qt: params.term
																		};
																	},
																	processResults: function(data) {
																		return {
																			results: $.map(data, function(obj) {
																				return {
																					id: obj.id,
																					text: obj.text
																				};
																			})
																		};
																	},
																	cache: true
																},
																minimumInputLength: 2,
																allowClear: true
															});
														});
														$(".wf_check_dup").blur(function() {
															var id_len = $(this).val().length;
															var chk_name = $(this).attr('name');
															var chk_val = $(this).val();
															if (id_len > 0) {
																var dataString = 'W=117&WFR=0&FIELD_N=' + chk_name + '&val=' + chk_val;
																$.ajax({
																	type: "POST",
																	url: "../workflow/load_dup.php",
																	data: dataString,
																	cache: false,
																	success: function(data) {
																		if (data == "D") {
																			$('#' + chk_name).addClass("bsf-warning");
																			$('#' + chk_name).removeClass("bsf-success");
																			$('#DUP_' + chk_name + '_ALERT').show();
																			$('#DUP_' + chk_name + '_ALERT').html('ข้อมูลนี้มีอยู่แล้วในระบบ');
																			$('#' + chk_name).attr('placeholder', chk_val);
																			$('#' + chk_name).val('');
																		} else {
																			$('#' + chk_name).addClass("bsf-success");
																			$('#' + chk_name).removeClass("bsf-warning");
																			$('#DUP_' + chk_name + '_ALERT').hide();
																			$('#DUP_' + chk_name + '_ALERT').html('');
																		}
																	}
																});
															} else {
																$('#' + chk_name).attr('placeholder', '');
																$('#DUP_' + chk_name + '_ALERT').hide();
																$('#DUP_' + chk_name + '_ALERT').html('');
																$(this).removeClass("bsf-warning");
																$(this).removeClass("bsf-success");
															}
														});
														$(".idcard").inputmask({
															mask: "9-9999-99999-99-9"
														});
														$('.autonumber').autoNumeric('init');
														$(".idcard").blur(function() {
															var id_len = $(this).val().length;
															if (id_len > 0) {
																var data = $(this).val().split('-');
																if (chkIDcard(data[0], data[1], data[2], data[3], data[4])) {
																	$(this).addClass("bsf-success");
																	$(this).removeClass("bsf-warning");
																} else {
																	$(this).addClass("bsf-warning");
																	$(this).removeClass("bsf-success");
																	alert("กรุณากรอกข้อมูลให้ถูกต้อง");
																	$(this).val('');
																	$(this).focus();
																}
															} else {
																$(this).removeClass("bsf-warning");
																$(this).removeClass("bsf-success");
															}
														});

														$(".email").blur(function() {
															var em_len = $(this).val().length;
															if (em_len > 0) {
																if (valid2EMail($(this).val())) {
																	$(this).addClass("bsf-success");
																	$(this).removeClass("bsf-warning");
																} else {
																	$(this).addClass("bsf-warning");
																	$(this).removeClass("bsf-success");
																}
															} else {
																$(this).removeClass("bsf-warning");
																$(this).removeClass("bsf-success");
															}
														});

														function open_modal(url, head, modal_id) {
															console.log(url);
															console.log(head);
															console.log(modal_id);
															var id = typeof modal_id === 'undefined' ? 'bizModal' : 'bizModal' + modal_id;
															$('#' + id + ' .modal-title').text(head);
															$('#' + id + ' .modal-body').load(url);
														}

														function PopupCenter(url, title, w, h) {
															// Fixes dual-screen position                         Most browsers      Firefox
															var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
															var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

															var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
															var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

															var left = ((width / 2) - (w / 2)) + dualScreenLeft;
															var top = ((height / 2) - (h / 2)) + dualScreenTop;
															var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

															// Puts focus on the newWindow
															if (window.focus) {
																newWindow.focus();
															}
														}

														function chkIDcard(SubCardID1, SubCardID2, SubCardID3, SubCardID4, SubCardID5) {
															var CardID = SubCardID1 + SubCardID2 + SubCardID3 + SubCardID4 + SubCardID5;
															var FcardID = (CardID.substr(0, 1)) * 13;
															for (i = 1; i < 12; i++) {
																var subNum = CardID.substr(i, 1);
																FcardID = parseInt(FcardID) + (parseInt(subNum) * (14 - (i + 1)));
															}
															chk = CardID.substr(CardID.length - 1, 1);
															temp = 11 - (parseInt(FcardID) % 11);
															temtStr = temp + '';
															chkAnswer = temtStr.substr(temtStr.length - 1, 1);
															if (parseInt(chk) == parseInt(chkAnswer)) {
																return true;
															} else {
																return false;
															}
														}

														function validLength(item, min, max) {
															return (item.length >= min) && (item.length <= max)
														}

														function valid2EMail(mailObj) {
															if (validLength(mailObj, 1, 50)) {
																//return false;
																if (mailObj.search("^.+@.+\\..+$") != -1)
																	return true;
																else return false;
															}
															return true;
														}

														function get_amphur(province_obj, amphur_obj, tambon_obj, zipcode_obj, default_data) {
															var dataString = 'P=' + $('select#' + province_obj).val();
															var txt_a = 'เลือกอำเภอ';
															if ($('select#' + province_obj).val() == '10') {
																txt_a = 'เลือกแขวง';
															}
															$.ajax({
																type: "GET",
																url: "../process/load_area.php",
																data: dataString,
																cache: false,
																success: function(html) {
																	console.log(html);
																	$('select#' + amphur_obj).html('').select2({
																		data: [{
																			id: '',
																			text: txt_a,
																			disabled: true,
																			selected: true
																		}]
																	});
																	$('select#' + amphur_obj).select2({
																		data: html
																	});
																	$('select#' + amphur_obj).select2("open");
																	$('select#' + amphur_obj).select2("close");
																	if (tambon_obj != "") {
																		$('select#' + tambon_obj).html('').select2({
																			data: [{
																				id: '',
																				text: '',
																				disabled: true,
																				selected: true
																			}]
																		});
																	}
																	if (zipcode_obj != "") {
																		$('#' + zipcode_obj).val('');
																	}
																}
															});
														}

														function get_tambon(province_obj, amphur_obj, tambon_obj, zipcode_obj, default_data) {
															var dataString = 'A=' + $('select#' + amphur_obj).val();
															var txt_a = 'เลือกตำบล';
															if ($('select#' + amphur_obj).val() != '') {
																if ($('select#' + amphur_obj).val().substring(0, 2) == '10') {
																	txt_a = 'เลือกแขวง';
																}
															}
															$.ajax({
																type: "GET",
																url: "../process/load_area.php",
																data: dataString,
																cache: false,
																success: function(html) {
																	$('select#' + tambon_obj).html('').select2({
																		data: [{
																			id: '',
																			text: txt_a,
																			disabled: true,
																			selected: true
																		}]
																	});
																	$('select#' + tambon_obj).select2({
																		data: html
																	});
																	$('select#' + tambon_obj).select2("open");
																	$('select#' + tambon_obj).select2("close");
																	if (zipcode_obj != "") {
																		$('#' + zipcode_obj).val('');
																	}
																}
															});
														}

														function get_zipcode(province_obj, amphur_obj, tambon_obj, zipcode_obj) {

															if (zipcode_obj != "") {

																var dataString = 'T=' + $('#' + tambon_obj).val();

																$.ajax({
																	type: "GET",
																	url: "../process/load_area.php",
																	data: dataString,
																	cache: false,
																	success: function(html) {
																		$('#' + zipcode_obj).val(html);
																	}
																});
															}
														}

														function wf_file_d(w, f, wfr, txt) {
															if (w != '' && f != '' && wfr != '') {
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
																		var dataString = 'process=d&wfr=' + wfr + '&W=' + w + '&f=' + f;
																		$.ajax({
																			type: "POST",
																			url: "../workflow/wf_file_d.php",
																			data: dataString,
																			cache: false,
																			success: function(html) {
																				/*swal({
																				title: "บันทึกตำแหน่งเรียบร้อยแล้ว",
																				type: "success",
																				allowOutsideClick:true
																				});*/
																				$('#BSA_FILE' + f).hide();
																			}
																		});

																	});
															}
														}
														$(window).scroll(function() {
															if ($(this).scrollTop() > 600) {
																$('.scrollup').fadeIn();
															} else {
																$('.scrollup').fadeOut();
															}
														});

														$('.scrollup').click(function() {
															$("html, body").animate({
																scrollTop: 0
															}, 600);
															return false;
														});

														function delete_wf_main(w, wfr) {
															if (w != '' && wfr != '') {
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
																		var dataString = 'process=del&W=' + w + '&WFR=' + wfr;
																		$.ajax({
																			type: "POST",
																			url: "../workflow/workflow_del_function.php",
																			data: dataString,
																			cache: false,
																			success: function(html) {
																				$('#tr_wf_' + wfr).hide();
																			}
																		});
																	});
															}
														}

														function number_format(num, digit) {
															var p = num.toFixed(digit).split(".");
															var x = p[0].split("").reverse().reduce(function(acc, num, i, orig) {
																return num + (i && !(i % 3) ? "," : "") + acc;
															}, "");
															if (digit > 0) {
																return x + "." + p[1];
															} else {
																return x;
															}

														}

														function bsf_del_form(W, WFS, WFR, F_TEMP_ID, WFD, FID) {
															if (W != '' && WFS != '' && FID != '') {
																swal({
																		title: "",
																		text: "คุณต้องการลบรายการนี้หรือไม่??",
																		type: "warning",
																		showCancelButton: true,
																		confirmButtonClass: "btn-danger",
																		confirmButtonText: "ยืนยันการลบ",
																		cancelButtonText: "ยกเลิก",
																		closeOnConfirm: true
																	},
																	function() {
																		var dataString = 'process=d&W=' + W + '&f=' + FID;
																		$.ajax({
																			type: "POST",
																			url: "../workflow/wf_form_d.php",
																			data: dataString,
																			cache: false,
																			success: function(html) {
																				$('#bsf_f_id' + FID).remove();
																				var func = 'WFS_UPDATE' + WFS + '()';
																				setTimeout(func, 1);
																			}
																		});
																	});
															}
														}

														function type_doc(id) {
															document.getElementById("export_type").value = id;
														}

														function export_file() {
															document.getElementById("export_content").value = document.getElementById("export_data").innerHTML;
															document.getElementById("form_export").action = "../workflow/export_report.php";
															document.getElementById("form_export").submit();
														}
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

											$('button[type="submit"]').click(function(event) {
												// load_file('<?php echo $id; ?>');
											});

											function load_file(id) {
												console.log('load_file');
												console.log(url);
												console.log(id);
												console.log(modal_id);
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

			<?php
			// if (isset($_POST['get_data'])) {
			//   $sql = "SELECT
			//             *
			//           FROM  WFR_PETITION_NOR
			//           WHERE 1=1
			//             -- AND BLACK_CASE_NO_SHW IS NOT NULL
			//             -- AND YEAR_BLACK IS NOT NULL
			//             -- AND RED_CASE_NO_SHW IS NOT NULL
			//             -- AND YEAR_RED IS NOT NULL
			//             AND MEDIATE_NO IS NOT NULL
			//             AND MEDIATE_NO IS NOT NULL
			//           ORDER BY WFR_ID DESC
			//           ";
			//   $query = db::query($sql);
			//   $i = 0;
			//   $rec = db::fetch_array($query);
			// }
			?>

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
					/* showFormPerType2(); */
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
					// if($('#ID_CARD').val()==null){
					// swal({
					// title: "",
					// text: "กรุณาระบุบบุคคลที่เกี่ยวข้องตามคำสั่ง",
					// type: "warning",
					// showCancelButton: false,
					// confirmButtonClass: "btn-success",
					// confirmButtonText: "ตกลง",
					// closeOnConfirm: true
					// });
					// return false;
					// }

					// if($('#CMD_TYPE').val()==null){
					// swal({
					// title: "",
					// text: "กรุณาระบุประเภทกลุ่มคำสั่งเจ้าพนักงาน",
					// type: "warning",
					// showCancelButton: false,
					// confirmButtonClass: "btn-success",
					// confirmButtonText: "ตกลง",
					// closeOnConfirm: true
					// });
					// return false;
					// }

					// if($('#CASE_TYPE').val()==null){
					// swal({
					// title: "",
					// text: "กรุณาระบุคำสั่งเจ้าพนักงาน",
					// type: "warning",
					// showCancelButton: false,
					// confirmButtonClass: "btn-success",
					// confirmButtonText: "ตกลง",
					// closeOnConfirm: true
					// });
					// return false;
					// }

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

					if ($('#APPROVE_PERSON').val() == null) {
						swal({
							title: "",
							text: "กรุณาระบุเสนอผู้พิจารณา",
							type: "warning",
							showCancelButton: false,
							confirmButtonClass: "btn-success",
							confirmButtonText: "ตกลง",
							closeOnConfirm: true
						});
						return false;
					}

					if ($.trim($('#CMD_NOTE').val()) == '') {
						swal({
							title: "",
							text: "กรุณาระบุเสนอผู้พิจารณา",
							type: "warning",
							showCancelButton: false,
							confirmButtonClass: "btn-success",
							confirmButtonText: "ตกลง",
							closeOnConfirm: true
						});
						return false;
					}

					$('#frm-input').submit();
				});

				<?php
				if ($_GET["GET_S_SYSTEM_ID"] != "") {

				?>
					/* getCaseData();
					getCasePersonData();
					getCaseAsset(); */
				<?php
				}
				?>
			</script>

			<script type="text/javascript">
				function getCaseData(type) {

					var T_BLACK_CASE = "";
					var BLACK_CASE = "";
					var BLACK_YY = "";
					var T_RED_CASE = "";
					var RED_CASE = "";
					var RED_YY = "";
					var COURT_CODE = "";
					var SYSTEM_ID = "";

					if (type == 1) {
						T_BLACK_CASE = $('#T_BLACK_CASE').val();
						BLACK_CASE = $('#BLACK_CASE').val();
						BLACK_YY = $('#BLACK_YY').val();
						T_RED_CASE = $('#T_RED_CASE').val();
						RED_CASE = $('#RED_CASE').val();
						RED_YY = $('#RED_YY').val();
						COURT_CODE = $('#COURT_CODE').val();
						SYSTEM_ID = $('#SYSTEM_ID').val();
					} else {
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
						success: function(response) {

							var data = JSON.parse(response);

							if (type == 1) {
								$('#D_C').val(data.PLAINTIFF);
								$('#D_NAME').val(data.DEFFENDANT);

								var tb_file = "";
								if (data.CivilFile.length > 0) {
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

				function getCasePersonData(type) {
					/* type = 1; */
					/* ของเดิม start */
					/* 		
							var T_BLACK_CASE = $('#T_BLACK_CASE').val();
							var BLACK_CASE = $('#BLACK_CASE').val();
							var BLACK_YY = $('#BLACK_YY').val();
							var T_RED_CASE = $('#T_RED_CASE').val();
							var RED_CASE = $('#RED_CASE').val();
							var RED_YY = $('#RED_YY').val();
							var COURT_CODE = $('#COURT_CODE').val();
							var SYSTEM_ID = $('#SYSTEM_ID').val();
							var SEND_TO = $('#SEND_TO').val(); */
					/* ของเดิม stop */
					/* ของใหม่ start */
					if (type == 1) {
						T_BLACK_CASE = $('#T_BLACK_CASE').val();
						BLACK_CASE = $('#BLACK_CASE').val();
						BLACK_YY = $('#BLACK_YY').val();
						T_RED_CASE = $('#T_RED_CASE').val();
						RED_CASE = $('#RED_CASE').val();
						RED_YY = $('#RED_YY').val();
						COURT_CODE = $('#COURT_CODE').val();
						SYSTEM_ID = $('#SYSTEM_ID').val();
					} else {
						T_BLACK_CASE = $('#TO_T_BLACK_CASE').val();
						BLACK_CASE = $('#TO_BLACK_CASE').val();
						BLACK_YY = $('#TO_BLACK_YY').val();
						T_RED_CASE = $('#TO_T_RED_CASE').val();
						RED_CASE = $('#TO_RED_CASE').val();
						RED_YY = $('#TO_RED_YY').val();
						COURT_CODE = $('#TO_COURT_CODE').val();
						SYSTEM_ID = $('#SEND_TO').val();
					}
					/* ของใหม่ stop */


					var GET_PER_TYPE = "";
					var GET_PER_CASE = "<?php echo $_GET['GET_PERSON_CASE'] ?>";

					if (SYSTEM_ID == 5) {
						GET_PER_TYPE = $('input[name="GET_PER_TYPE"]:checked').val();
					}

					/*$.ajax({
							type: "POST",
							url:  'get_data_ajax.php',
							data: {
								  proc:"getPerson",
								  T_BLACK_CASE:T_BLACK_CASE,
								  BLACK_CASE:BLACK_CASE,
								  BLACK_YY:BLACK_YY,
								  T_RED_CASE:T_RED_CASE,
								  RED_CASE:RED_CASE,					  
								  RED_YY:RED_YY,					  
								  COURT_CODE:COURT_CODE,				  
								  SYSTEM_ID:SYSTEM_ID,
								  GET_PER_TYPE:GET_PER_TYPE				  
								}, // serializes the form's elements.
							success: function(response)
							{
								if(type==1){
									$('#ID_CARD').find('option').remove().end()
									$('#ID_CARD').append(response);
								}
								
							}
						});*/
					$.ajax({
						type: "POST",
						url: 'get_data_ajax.php',
						data: {
							proc: "getPersonJson",
							T_BLACK_CASE: T_BLACK_CASE,
							BLACK_CASE: BLACK_CASE,
							BLACK_YY: BLACK_YY,
							T_RED_CASE: T_RED_CASE,
							RED_CASE: RED_CASE,
							RED_YY: RED_YY,
							COURT_CODE: COURT_CODE,
							SYSTEM_ID: SYSTEM_ID,
							GET_PER_TYPE: GET_PER_TYPE,
							GET_PER_CASE: GET_PER_CASE
						}, // serializes the form's elements.
						success: function(response) {
							//exit();
							if (type > 0) {
								var tb_person = "";
								var i = 1;
								var data = JSON.parse(response);
								console.log(data)
								data = data['data']

								$.each(data, function(key, data_value) {
									var checkedIdCard = "";
									//alert($('#proc').val());
									if ($('#proc').val() == 'add' && String(data_value.REGISTER_CODE) == String($('#HIDDEN_REGISTER_CODE').val())) {
										checkedIdCard = "checked";
									}


									/* AK 24/11/2023 */
									if (SYSTEM_ID == 5) {
										if ($('#proc').val() == 'add' && String(data_value.REGISTER_CODE) == GET_PER_CASE) {
											checkedIdCard = "checked";
										}
									}

									//alert(checkedIdCard);

									var inputHidden = "";

									var full_name = "";

									if (data_value.PREFIX_NAME != null) {
										full_name = data_value.PREFIX_NAME;

										inputHidden = "<input type=\"hidden\" name=\"GET_PREFIX_NAME[" + data_value.REGISTER_CODE + "]\" id=\"GET_PREFIX_NAME\" value=\"" + data_value.PREFIX_NAME + "\">";
									}
									if (data_value.FIRST_NAME != null) {
										full_name += data_value.FIRST_NAME;
										inputHidden += "<input type=\"hidden\" name=\"GET_FIRST_NAME[" + data_value.REGISTER_CODE + "]\" id=\"GET_PREFIX_NAME\" value=\"" + data_value.FIRST_NAME + "\">";
									}
									if (data_value.LAST_NAME != null) {
										full_name += " " + data_value.LAST_NAME;
										inputHidden += "<input type=\"hidden\" name=\"GET_LAST_NAME[" + data_value.REGISTER_CODE + "]\" id=\"GET_PREFIX_NAME\" value=\"" + data_value.LAST_NAME + "\">";
									}

									var full_name = (data_value.PREFIX_NAME != null ? data_value.PREFIX_NAME : "") + '' + (data_value.FIRST_NAME != null ? data_value.FIRST_NAME : "") + ' ' + (data_value.LAST_NAME != null ? data_value.LAST_NAME : "");

									// alert(data_value.REGISTER_CODE);
									// alert($('#HIDDEN_REGISTER_CODE').val());

									tb_person += "<tr>";
									tb_person += "<td><label><input type=\"checkbox\" name=\"LIST_REGISTER_CODE[" + data_value.REGISTER_CODE + "]\" id=\"LIST_REGISTER_CODE" + data_value.REGISTER_CODE + "\" value=\"" + data_value.REGISTER_CODE + "\" " + checkedIdCard + "> " + i + "</label></td>";
									tb_person += "<td>" + data_value.CONCERN_NAME + " : " + full_name + inputHidden + "</td>";



									$.ajax({
										type: "POST",
										url: 'get_data_ajax.php',
										async: false,
										data: {
											proc: 'getCmdType2',
											REGISTER_CODE: data_value.REGISTER_CODE
										},
										success: function(response2) {
											tb_person += "<td>" + response2 + "</td>";

										}
									});

									tb_person += "<td><select name=\"CASE_TYPE_PERSON[" + data_value.REGISTER_CODE + "]\" id=\"CASE_TYPE_PERSON_" + data_value.REGISTER_CODE + "\"  class=\"form-control select2\" tabindex=\"-2\" onChange=\"createTextDetail('" + data_value.REGISTER_CODE + "','" + full_name + "',$(this).val())\"></select></td>";
									tb_person += "</tr>";
									i++;
								});

								$('#wfs_show_person').html('');
								$('#wfs_show_person').append(tb_person);

								$('select.select2').select2({
									allowClear: true,
									placeholder: function() {
										$(this).data('placeholder');
									}
								});

							}

						}
					});

				}


				// function addRowPerson(){

				// }

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

				function getCaseAsset(type) {

					var T_BLACK_CASE = "";
					var BLACK_CASE = "";
					var BLACK_YY = "";
					var T_RED_CASE = "";
					var RED_CASE = "";
					var RED_YY = "";
					var COURT_CODE = "";
					var SYSTEM_ID = "";
					console.log('getCaseAsset')
					console.log(type)
					if (type == 1) {
						T_BLACK_CASE = $('#T_BLACK_CASE').val();
						BLACK_CASE = $('#BLACK_CASE').val();
						BLACK_YY = $('#BLACK_YY').val();
						T_RED_CASE = $('#T_RED_CASE').val();
						RED_CASE = $('#RED_CASE').val();
						RED_YY = $('#RED_YY').val();
						COURT_CODE = $('#COURT_CODE').val();
						SYSTEM_ID = $('#SYSTEM_ID').val();
					} else {
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
							proc: "getAsset",
							T_BLACK_CASE: T_BLACK_CASE,
							BLACK_CASE: BLACK_CASE,
							BLACK_YY: BLACK_YY,
							T_RED_CASE: T_RED_CASE,
							RED_CASE: RED_CASE,
							RED_YY: RED_YY,
							COURT_CODE: COURT_CODE,
							SYSTEM_ID: SYSTEM_ID
						}, // serializes the form's elements.
						success: function(response) {
							var tb_asset = "";
							var i = 1;
							var data = JSON.parse(response);
							console.log(data)
							data = data['ASSET']
							$.each(data, function(key, data_value) {
								console.log(key);
								var inputHidden = "";

								inputHidden = "<input type=\"hidden\" name=\"PROP_TITLE[" + data_value.ASSET_ID + "]\" id=\"PROP_TITLE_" + data_value.ASSET_ID + "\" value=\"" + data_value.PROP_TITLE + "\">";
								inputHidden += "<input type=\"hidden\" name=\"PROP_STATUS_NAME[" + data_value.ASSET_ID + "]\" id=\"PROP_STATUS_NAME_" + data_value.ASSET_ID + "\" value=\"" + data_value.PROP_STATUS_NAME + "\">";
								inputHidden += "<input type=\"hidden\" name=\"PROP_STATUS[" + data_value.ASSET_ID + "]\" id=\"PROP_STATUS_" + data_value.ASSET_ID + "\" value=\"" + data_value.PROP_STATUS + "\">";
								inputHidden += "<input type=\"hidden\" name=\"TYPE_CODE[" + data_value.ASSET_ID + "]\" id=\"PROP_STATUS_" + data_value.ASSET_ID + "\" value=\"" + data_value.TYPE_CODE + "\">";
								inputHidden += "<input type=\"hidden\" name=\"TYPE_DESC[" + data_value.ASSET_ID + "]\" id=\"TYPE_DESC_" + data_value.ASSET_ID + "\" value=\"" + data_value.TYPE_DESC + "\">";
								inputHidden += "<input type=\"hidden\" name=\"CFC_CAPTION_GEN[" + data_value.ASSET_ID + "]\" id=\"CFC_CAPTION_GEN_" + data_value.ASSET_ID + "\" value=\"" + data_value.CFC_CAPTION_GEN + "\">";
								inputHidden += "<input type=\"hidden\" name=\"M_ASSET_KEY[" + data_value.ASSET_ID + "]\" id=\"M_ASSET_KEY_" + data_value.ASSET_ID + "\" value=\"" + data_value.M_ASSET_KEY + "\">";
								inputHidden += "<input type=\"hidden\" name=\"ASSET_TYPE_ID[" + data_value.ASSET_ID + "]\" id=\"ASSET_TYPE_ID_" + data_value.ASSET_ID + "\" value=\"" + data_value.ASSET_TYPE_ID + "\">";

								tb_asset += "<tr>";
								tb_asset += "<td><label><input type=\"checkbox\" name=\"ASSET_ID[" + data_value.ASSET_ID + "]\" id=\"ASSET_ID_" + data_value.ASSET_ID + "\" value=\"" + data_value.ASSET_ID + "\"> " + i + "</label></td>";
								tb_asset += "<td><a onclick=\"show_asset_detail(" + data_value.ASSET_ID + ")\" href=\"javascript:void();\">" + data_value.PROP_TITLE + "" + inputHidden + "</a></td>";

								$.ajax({
									type: "POST",
									url: 'get_data_ajax.php',
									async: false,
									data: {
										proc: 'getCmdType',
										ASSET_ID: data_value.ASSET_ID
									},
									success: function(response2) {
										tb_asset += "<td>" + response2 + "</td>";

									}
								});

								tb_asset += "<td><select name=\"CASE_TYPE[" + data_value.ASSET_ID + "]\" onchange=\"show_action(this.value,'" + data_value.ASSET_ID + "')\" id=\"CASE_TYPE_" + data_value.ASSET_ID + "\"  class=\"form-control select2\" tabindex=\"-2\"></select></td>";
								tb_asset += "<td align=\"center\">" + data_value.PROP_STATUS_NAME + "</td>";
								tb_asset += "<td align=\"center\"><input type='text' readonly name='input_show_action' id=\"input_show_action_" + data_value.ASSET_ID + "\"  class=\"form-control\"></td>";
								tb_asset += "</tr>";

								i++;
							});

							$('#wfs_show_asset').html('');
							$('#wfs_show_asset').append(tb_asset);

							$('select.select2').select2({
								allowClear: true,
								placeholder: function() {
									$(this).data('placeholder');
								}
							});
						}
					});
				}

				function show_action(CMD_TYPE_CODE, data_value) {
					console.log(CMD_TYPE_CODE)
					console.log(data_value)
					$.ajax({
							url: 'search_data_process_A.php',
							type: 'POST',
							data: {
								proc: 'show_action',
								CMD_TYPE_CODE: CMD_TYPE_CODE
							}
						})
						.done(function(data) {
							let show = JSON.parse(data)
							/* console.log(show) */
							let D = (show == null ? 'ไม่มีข้อมูล' : show);

							console.log(D)
							$('#input_show_action_' + data_value).val(D);
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

				function showFormPerType2() { //function ซ่อนเเละเเสดง
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
							console.log(data)
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
							console.log('getCaseTypePerson')
							console.log(data)
							$('#CASE_TYPE_PERSON_' + register_code).find('option').remove().end()
							$('#CASE_TYPE_PERSON_' + register_code).append(data);
						});
				}


				<?php
				if (($_GET["proc"] == "" || $_GET["proc"] == 'add') && $_GET["REF_ID"] == "") {/* ดึงข้อมูลทรัพย์เเละคดี ถ้าเป็นหน้าadd */
				?>
					$(document).ready(function() {
						getCasePersonData(1);
						getCaseAsset(1);
						showFormPerType();
						showFormPerType2();
					});
					<?php
				} else if (($_GET["proc"] == "" || $_GET["proc"] == 'add') && $_GET["REF_ID"] != "") {


					$sql_111 = db::query("SELECT a.T_BLACK_CASE ,a.BLACK_CASE ,a.BLACK_YY FROM M_DOC_CMD a 
					WHERE a.ID ='" . $_GET["REF_ID_MAIN"] . "'");
					$rec_111 = db::fetch_array($sql_111);

					if ($GET_T_NO_BLACK == $rec_111['T_BLACK_CASE'] && $GET_TO_BLACK_CASE == $rec_111['BLACK_CASE'] && $GET_TO_BLACK_YY == $rec_111['BLACK_YY']) {
					?>
						$(document).ready(function() {
							console.log(<?php echo "111"; ?>)
							console.log(<?php echo json_encode($GET_T_NO_BLACK); ?>)
							console.log(<?php echo json_encode($GET_TO_BLACK_CASE); ?>)
							console.log(<?php echo json_encode($GET_TO_BLACK_YY); ?>)
							console.log(<?php echo json_encode($_GET["REF_ID_MAIN"]); ?>)
							console.log(<?php echo json_encode($rec_111['T_BLACK_CASE']); ?>)
							console.log(<?php echo json_encode($rec_111['BLACK_CASE']); ?>)
							console.log(<?php echo json_encode($rec_111['BLACK_YY']); ?>)
							getCasePersonData(1);
							getCaseAsset(1);
							showFormPerType();
							showFormPerType2();

						});
					<?php
					} else {
					?>
						$(document).ready(function() {
							console.log(<?php echo "111"; ?>)
							console.log(<?php echo json_encode($GET_T_NO_BLACK); ?>)
							console.log(<?php echo json_encode($GET_TO_BLACK_CASE); ?>)
							console.log(<?php echo json_encode($GET_TO_BLACK_YY); ?>)
							console.log(<?php echo json_encode($_GET["REF_ID_MAIN"]); ?>)
							console.log(<?php echo json_encode($rec_111['T_BLACK_CASE']); ?>)
							console.log(<?php echo json_encode($rec_111['BLACK_CASE']); ?>)
							console.log(<?php echo json_encode($rec_111['BLACK_YY']); ?>)
							getCasePersonData(2);
							getCaseAsset(2);
							showFormPerType();
							showFormPerType2();
						});
				<?php
					}
				}
				?>

				function createTextDetail(idcard, name, caseType) {

					var case_black = $('#T_BLACK_CASE').val() + '.' + $('#BLACK_CASE').val() + '/' + $('#BLACK_YY').val();
					var case_red = $('#T_RED_CASE').val() + '.' + $('#RED_CASE').val() + '/' + $('#RED_YY').val();
					if (caseType = '20112' && $('#CMD_FIX_DATE_STATUS').prop('checked') == true) {
						$('#CMD_NOTE').val('คดีหมายเลขดำที่ ล.14921/2565 คดีหมายเลขแดงที่ ล.14922/2565 ศาลล้มละลายกลาง ศาลมีคำสั่งปลดล้มละลาย ' + name + ' เลขประจำตัวประชาชน ' + idcard + ' เมื่อวันที่ ' + $('#CMD_FIX_DOC_DATE').val());
					}
				}
			</script>