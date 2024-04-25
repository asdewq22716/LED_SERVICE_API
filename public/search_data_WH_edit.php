<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
$HIDE_HEADER = "P";


include('../include/include.php');


include('../include/paging.php');
include '../include/func_Nop.php';
include "./btn_function.php";



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

/* ตรวจคนล้มละลาย */
if ($_GET['SEND_TO'] == '2') {
	function REGISTER_CODE_13_BANKRUPT($brcID, $CONCERN_NAME)
	{ //ส่งรหัสคดีbrcID,ส่ง$CONCERN_NAME ='เจ้าหนี้,ลูกหนี้,จำเลย' =>ถ้า CONCERN_NAME ไม่ใส่คือเอาทุกสถานะ,
		$FILL = "";
		if ($CONCERN_NAME != '') {
			$FILL = "  AND a.CONCERN_NAME IN (" . result_array($CONCERN_NAME) . ")"; //การเลือกถ้านะที่เลือกเท่านั้น
		}

		$sql_WH_PERSON_COUPLE1 = "  SELECT *FROM WH_BANKRUPT_CASE_PERSON a
								JOIN WH_BANKRUPT_CASE_DETAIL b ON a.WH_BANKRUPT_ID =b.WH_BANKRUPT_ID 
								WHERE 1=1
								AND a.REGISTER_CODE IS NOT NULL
								AND b.BANKRUPT_CODE= '" . $brcID . "'{$FILL}
								";
		$REGISTERCODE_C1 = '';
		$queryWH_PERSON_COUPLE1 = db::query($sql_WH_PERSON_COUPLE1);
		while ($rec_WH = db::fetch_array($queryWH_PERSON_COUPLE1)) {
			$REGISTERCODE_C1 .= $rec_WH["REGISTER_CODE"] . ",";
		}
		return cut_last_comma($REGISTERCODE_C1);
	}
	function check_bank($input_array, $PAGE_CODE)
	{
		$data_Arr = "";
		$sql_check_bank = "SELECT a.DATA_BANK FROM M_CHECK_CASE_BANKRUPT  a WHERE a.PAGE_CODE='" . $PAGE_CODE . "' ";
		$querycheck_bank = db::query($sql_check_bank);
		$data_check = db::fetch_array($querycheck_bank);
		if ($data_check['DATA_BANK'] == 'YES') {
			$data_Arr = $input_array;
		} else {
			$arr = [];
			$arr = explode(",", trim($input_array, ","));
			$num_arr = count($arr);
			$ii = 1;
			foreach ($arr as $sh1) {
				$sql_num_bank =  "SELECT COUNT(a.ID_CARD_BANK)AS TOTAL_BANK FROM M_DATA_BANK a WHERE a.ID_CARD_BANK ='" . $sh1 . "'";
				$queryNum_bank = db::query($sql_num_bank);
				$dataNum_bank  = db::fetch_array($queryNum_bank);
				if ($dataNum_bank['TOTAL_BANK'] == '0') {
					$ii++;
					$data_Arr .=  $sh1 . ",";
				} else {
					$ii--;
				}
			}
		}
		return cut_last_comma($data_Arr);
	}
	if ($_GET['brcID'] != '') {
		$brcID = $_GET['brcID'];
		$PAGE_CODE = $_GET['PAGE_CODE'];
		$sqlSelectData = "	select 		*
		from 		WH_BANKRUPT_CASE_DETAIL
		where 		BANKRUPT_CODE = '" . $brcID . "' ";
		$querySelectData = db::query($sqlSelectData);
		$dataSelectData = db::fetch_array($querySelectData);
		$num1 = db::num_rows($querySelectData);

		if ($num1 > 0) {
			/* ดึงข้อมูลตั้งค่าหน้ามาใช้ว่าจะเเสดงเเบบใหน start */
			$sql_DATA_SEARCH = "SELECT *FROM  M_CHECK_CASE_BANKRUPT a WHERE a.PAGE_CODE='" . $PAGE_CODE . "' ";
			$queryDATA_SEARCH = db::query($sql_DATA_SEARCH);
			$dataDATA_SEARCH  = db::fetch_array($queryDATA_SEARCH);
			/*  stop  */
			if ($dataDATA_SEARCH['DATA_SEARCH'] == 'ALL') {/* start เอาเงื่อนไขเกี่ยวของเป็นมา เเบบ ALL คือการเอาทั้งหมด  */

				/* start เอาเงื่อนไขเกี่ยวของเป็นมาwhere TEMP_REF_PARTY_TYPE */
				$sql_A = "SELECT a.PAGE_CODE  ,c.PRE_ID_PK  ,c.PRE_NAME FROM M_CHECK_CASE_BANKRUPT  a
							JOIN WF_CHECKBOX b ON a.BANKRUPT_CHECK_ID =b.WFR_ID 
							JOIN TEMP_REF_PARTY_TYPE c ON b.CHECKBOX_VALUE =c.PRE_ID_PK 
							WHERE 1=1
							AND  a.PAGE_CODE='" . $PAGE_CODE . "'
							AND b.WFS_FIELD_NAME ='TEMP_REF_PARTY_TYPE'";

				$query_A = db::query($sql_A);
				$concerned = "";
				while ($rec_A = db::fetch_array($query_A)) {
					$concerned .= $rec_A['PRE_NAME'] . ",";
				}
				$concerned = result_array(cut_last_comma($concerned));
				$FILL = "";
				if ($concerned != '') {
					//$FILL = "  AND a.CONCERN_NAME IN (" . $concerned . ")";
				}
				/* stop เอาเงื่อนไขเกี่ยวของเป็นมาwhere  */

				$sql_WH_PERSON = "  SELECT *FROM WH_BANKRUPT_CASE_PERSON a
									JOIN WH_BANKRUPT_CASE_DETAIL b ON a.WH_BANKRUPT_ID =b.WH_BANKRUPT_ID 
									WHERE 1=1
									AND a.REGISTER_CODE IS NOT NULL
									AND b.BANKRUPT_CODE= '" . $brcID . "'{$FILL}
									";
				$queryWH_PERSON = db::query($sql_WH_PERSON);
				$REGISTERCODE = '';
				$CONCERN_CODE = '';
				$queryWH_PERSON = db::query($sql_WH_PERSON);
				while ($rec_WH = db::fetch_array($queryWH_PERSON)) {
					$REGISTERCODE .= $rec_WH["REGISTER_CODE"] . ",";
					//$CONCERN_CODE .= $rec_WH["CONCERN_CODE"]  . ",";
				}
				$REGISTERCODE = (cut_last_comma($REGISTERCODE));
				$REGISTERCODE = check_bank($REGISTERCODE, $PAGE_CODE);

				//$CONCERN_CODE = cut_last_comma($CONCERN_CODE);

			} else if ($dataDATA_SEARCH['DATA_SEARCH'] == 'COUPLE' || $dataDATA_SEARCH['DATA_SEARCH'] == 'CROSS') {
				$REGISTERCODE_C1 = REGISTER_CODE_13_BANKRUPT($brcID, "โจทก์");
				$REGISTERCODE_C2 = REGISTER_CODE_13_BANKRUPT($brcID, "จำเลย");
			}
		}

		$sql_check_case = "SELECT *FROM  M_CHECK_CASE_BANKRUPT a WHERE a.PAGE_CODE='" . $PAGE_CODE . "' ";
		$query_check_case = db::query($sql_check_case);
		while ($rec_check_case = db::fetch_array($query_check_case)) { //start while
			/* ตรวจคน start */
			if ($rec_check_case['URL_CODE_PERSON'] == "http://103.208.27.224:81/led_service_api/public/search_data_WH.php") {
				$array_check = explode(",", $rec_check_case['NOTE_PERSON']); //แปลงข้อมูล เป็นarray เพื่อเช็คค่า
				if ($rec_check_case['DATA_SEARCH'] == 'ALL') {
					if (in_array("REGISTERCODE", $array_check)) {
						if ($REGISTERCODE != '') { //รหัสบัตรประชาชน
							//$link .= "&REGISTERCODE=" . $REGISTERCODE;
							$link .= "&REGISTERCODE=" .  $REGISTERCODE;
						}
					}
				} else {
					if (in_array("REGISTERCODE", $array_check)) {
						if ($REGISTERCODE_C1 != '') {
							$link .= "&REGISTERCODE_C1=" . $REGISTERCODE_C1;
							// $link .= "&CONCERNED_C1=" . cut_last_comma($CONCERNED_C1);
						}
						if ($REGISTERCODE_C2 != '') {
							$link .= "&REGISTERCODE_C2=" . $REGISTERCODE_C2;
							// $link .= "&CONCERNED_C2=" . cut_last_comma($CONCERNED_C2);
						}
					}
				}
				if (in_array("BLACK_CASE", $array_check)) {
					$link .= "&T_BLACK_CASE=" . $dataSelectData['PREFIX_BLACK_CASE'] . "&BLACK_CASE=" . $dataSelectData['BLACK_CASE'] . "&BLACK_YY=" . $dataSelectData['BLACK_YY'];
				}
				if (in_array("RED_CASE", $array_check)) {
					$link .= "&T_RED_CASE=" . $dataSelectData['PREFIX_RED_CASE'] . "&RED_CASE=" . $dataSelectData['RED_CASE'] . "&RED_YY=" . $dataSelectData['RED_YY'];
				}
				if (in_array("COURT_CODE", $array_check)) {
					$link .= "&COURT_CODE=" . $dataSelectData['COURT_CODE'] . "&COURT_NAME=" . $dataSelectData['COURT_NAME'];
				}
				$link .= "&DATA_SEARCH=" . $rec_check_case['DATA_SEARCH'];
				$link .= "&brcID=" . $brcID;
				$link .= "&PAGE_CODE=" . $PAGE_CODE;
				$link .= "&TO_PERSON_ID=" . $toPersonId . "&SEND_TO=2";
				(CONVERT_GET($link)); //แปลงข้อมูลเป็นGET
			}
			/* ตรวจคน stop */
		}
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

$arr_system = array("Bankrupt" => "คดีล้มละลาย", "Civil" => "คดีแพ่ง", "Mediate" => "คดีไกล่เกลี่ย", "Revive" => "คดีฟื้นฟู");
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
									<?php if ($_GET['REGISTERCODE'] != "") { ?><div class="card-header">
											<h5 class="card-header-text">
												<b>เลขบัตรประชาชน :</b> <?php echo $_GET['REGISTERCODE']; ?>
											</h5>
										</div><?php } ?>
									<?php if ($_GET['COURT_NAME'] != "") { ?><div class="card-header">
											<h5 class="card-header-text">
												<b> ศาล :</b> <?php echo $_GET['COURT_NAME']; ?>
											</h5>
										</div><?php } ?>
									<?php if ($BLACK_CASE != "") { ?><div class="card-header">
											<h5 class="card-header-text">
												<b> หมายเลขคดีดำ :</b> <?php echo $T_BLACK_CASE; ?> <?php echo $BLACK_CASE; ?>
											</h5>
										</div><?php } ?>
									<?php if ($RED_CASE != "") { ?><div class="card-header">
											<h5 class="card-header-text">
												<b> หมายเลขคดีแดง :</b> <?php echo $T_RED_CASE; ?> <?php echo $RED_CASE; ?>
											</h5>
										</div><?php } ?>


									<?php
									$k = 0;
									$array_raw = [];
									foreach ($arr_system as $sys => $sys_name) {
										$k++;
										$filter1 = "";

										/* start ไม่เอาคดีตัวเอง */
										if ($_GET['PCC_CIVIL_GEN'] != "" && $sys == 'Civil') {
											$sqlSelectData = "	SELECT 	b.WH_CIVIL_ID
																FROM 	WH_CIVIL_CASE a
																JOIN ".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')."  b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
																WHERE 	CIVIL_CODE = '" . $_GET['PCC_CIVIL_GEN']  . "'";
											$querySelectData = db::query($sqlSelectData);
											$rec_PCC = db::fetch_array($querySelectData);
											$filter1 .= "AND TB.WH_ID !='" . $rec_PCC['WH_CIVIL_ID'] . "' ";
										}
										if ($_GET['brcID'] != ""  && $sys == 'Bankrupt') {
											$sqlSelectData = "	SELECT a.WH_BANKRUPT_ID  FROM WH_BANKRUPT_CASE_DETAIL a 
																WHERE a.BANKRUPT_CODE  = '" . $_GET['brcID']  . "'";
											$querySelectData = db::query($sqlSelectData);
											$rec_PCC = db::fetch_array($querySelectData);
											$filter1 .= "AND (TB.WH_ID !='" . $rec_PCC['WH_BANKRUPT_ID'] . "') ";
										}
										/* stop ไม่เอาคดีตัวเอง */

										if ($_GET['DATA_SEARCH'] == 'ALL') {

											if ($_GET['REGISTERCODE'] != "") {
												$filter1 .= " and TB.REGISTER_CODE in (" . result_array($_GET['REGISTERCODE'])  . ") ";
											}

											if ($_GET['COURT_NAME'] != "") {
												$filter1 .= " AND TB.COURT_NAME = '" . $_GET['COURT_NAME'] . "' ";
											}

											if ($_GET['T_BLACK_CASE'] != "" && $_GET['BLACK_CASE'] != "" && $_GET['BLACK_YY'] != "") {

												$filter1 .= " AND TB.PREFIX_BLACK_CASE  like '%" . $_GET['T_BLACK_CASE'] . "%' ";
												$filter1 .= " AND TB.BLACK_CASE  like '%" . $_GET['BLACK_CASE'] . "%' ";
												$filter1 .= " AND TB.BLACK_YY  like '%" . $_GET['BLACK_YY'] . "%' ";
											}

											if ($_GET['T_RED_CASE'] != "" && $_GET['RED_CASE'] != "" && $_GET['RED_YY'] != "") {

												$filter1 .= " AND TB.PREFIX_RED_CASE  like '%" . $_GET['T_RED_CASE'] . "%' ";
												$filter1 .= " AND TB.RED_CASE  like '%" . $_GET['RED_CASE'] . "%' ";
												$filter1 .= " AND TB.RED_YY  like '%" . $_GET['RED_YY'] . "%' ";
											}

											if ($_GET['PRE_CODE'] != "") {
												$text_N = 1;
												foreach ($_GET['PRE_CODE'] as $A1) {
													$result_PRE_CODE .= "'" . $A1 . "'" . (count($_GET['PRE_CODE']) == $text_N ? "" : ",");
													$text_N++;
												}
												$filter1 .= " AND TB.CONCERN_NAME in (" . $result_PRE_CODE . ")  ";
											}
											if ($_GET['CONCERNED'] != "") {
												$filter1 .= " AND TB.CONCERN_NAME in (" . result_array($_GET['CONCERNED']) . ")  ";
											}
											if ($_GET['case'] != "") {
												$text_N = 1;
												foreach ($_GET['case'] as $A1) {
													$result_case .= "'" . $A1 . "'" . (count($_GET['case']) == $text_N ? "" : ",");
													$text_N++;
												}
												$filter1 .= " AND TB.SYSTEM_TYPE in (" . $result_case . ") ";
											}
											if ($filter1 != "") {
												$sqlSelectDataALL_e =        "
	SELECT 
	TB.PK_ID ,TB.WH_ID,
	TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
	TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
	TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
	TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
	TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
	TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
	TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.CONERNSEQ
	FROM VIEW_WH_ALL_CASE_PERSON TB 
	WHERE TB.SYSTEM_TYPE = '" . $sys . "' {$filter1}
	GROUP BY TB.PK_ID ,TB.WH_ID,TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
	TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
	TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
	TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
	TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
	TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
	TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.CONERNSEQ
	ORDER BY TB.SYSTEM_TYPE ASC,
	CASE
		WHEN TB.CONCERN_NAME = 'โจทก์' AND TB.CONERNSEQ IS NOT NULL THEN 1
		WHEN TB.CONCERN_NAME = 'โจทก์' AND TB.CONERNSEQ IS NULL THEN 2
		WHEN TB.CONCERN_NAME = 'จำเลย' AND TB.CONERNSEQ IS NOT NULL THEN 3
		WHEN TB.CONCERN_NAME = 'จำเลย' AND TB.CONERNSEQ IS NULL THEN 4
		ELSE 5
	END,TB.CONERNSEQ ASC 
	";
												//echo "<br><br>".$sqlSelectDataALL_e ;
												$query_SelectDataALL_e[$k] = db::query($sqlSelectDataALL_e);
												$num_b[$k] = db::num_rows($query_SelectDataALL_e[$k]);
												while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
													$array_raw[$k][] = $recSelectDataAll;
												}
											}
										} else if ($_GET['DATA_SEARCH'] == 'COUPLE' || $_GET['DATA_SEARCH'] == 'CROSS') {
											if ($_GET['DATA_SEARCH'] == 'COUPLE') { //คู่ เลือกรายการที่REGISTERCODE_1 เป็นโจทย์ และREGISTERCODE_2 เป็นจำเลย
												$check = '1';
												if ($_GET['case'] != "") {
													$filter_SYSTEM_TYPE .= " AND TB3.SYSTEM_TYPE in (" . sort_array($_GET['case']) . ") ";
												}
												if ($_GET['REGISTERCODE_C1'] != "") {

													$filter_1 = "  AND TB2.REGISTER_CODE in (" . str_replace('-', '', result_array($_GET['REGISTERCODE_C1'])) . ")
																		AND TB2.CONCERN_NAME in ('โจทก์')";
												}
												if ($_GET['REGISTERCODE_C2'] != "") {
													$filter_2 = "AND TB2.REGISTER_CODE in (" . str_replace('-', '', result_array($_GET['REGISTERCODE_C2'])) . ")
																	   AND TB2.CONCERN_NAME in ('จำเลย')";
												}
											}
											if ($_GET['DATA_SEARCH'] == 'CROSS') { //ไขว้
												$check = '2';
												if ($_GET['case'] != "") {
													$filter_SYSTEM_TYPE .= " AND TB3.SYSTEM_TYPE in (" . sort_array($_GET['case']) . ") ";
												}
												if ($_GET['REGISTERCODE_C1'] != "") {

													$filter_1 = " AND TB2.REGISTER_CODE in (" . str_replace('-', '', result_array($_GET['REGISTERCODE_C1'])) . ")";
												}
												if ($_GET['REGISTERCODE_C2'] != "") {
													$filter_2 = "AND TB2.REGISTER_CODE in (" . str_replace('-', '', result_array($_GET['REGISTERCODE_C2'])) . ")";
												}
											}
											if ($check > 0) {
												$sql_ALL = "SELECT 
												TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
												TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
												TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
												TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
												TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
												TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
												TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.CONERNSEQ,TB.WH_ID
												FROM VIEW_WH_ALL_CASE_PERSON TB 
												WHERE 1=1 
												 AND EXISTS (	
												 SELECT *FROM VIEW_WH_ALL_CASE_PERSON TB2
												 WHERE 1=1 
												 AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE 
												 AND TB2.BLACK_CASE=TB.BLACK_CASE 
												 AND TB2.BLACK_YY=TB.BLACK_YY 
												 AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
												 AND TB2.RED_CASE = TB.RED_CASE 
												 AND TB2.RED_YY = TB.RED_YY 
												{$filter_1})
												 AND EXISTS (
												 SELECT *FROM VIEW_WH_ALL_CASE_PERSON TB2
												 WHERE 1=1
												 AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE
												 AND TB2.BLACK_CASE=TB.BLACK_CASE
												 AND TB2.BLACK_YY=TB.BLACK_YY 
												 AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
												 AND TB2.RED_CASE = TB.RED_CASE 
												 AND TB2.RED_YY = TB.RED_YY 
												 {$filter_2})
											AND TB.REGISTER_CODE in(" . result_array($_GET['REGISTERCODE_C1']) . "," . result_array($_GET['REGISTERCODE_C2']) . ")
											{$filter_SYSTEM_TYPE}
											{$filter1}
											AND TB.SYSTEM_TYPE = '" . $sys . "'
											GROUP BY TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
											TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
											TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
											TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
											TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
											TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
											TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.CONERNSEQ,TB.WH_ID
											ORDER BY TB.CONERNSEQ ASC,TB.SYSTEM_TYPE ASC,
											CASE
												 WHEN TB.CONCERN_NAME = 'โจทก์' AND TB.CONERNSEQ IS NOT NULL THEN 1
												 WHEN TB.CONCERN_NAME = 'โจทก์' AND TB.CONERNSEQ IS NULL THEN 2
												 WHEN TB.CONCERN_NAME = 'จำเลย' AND TB.CONERNSEQ IS NOT NULL THEN 3
												 WHEN TB.CONCERN_NAME = 'จำเลย' AND TB.CONERNSEQ IS NULL THEN 4
												ELSE 5
											END
											 ";
												//echo $sql_ALL . "<br><br>";
											}
											$query_SelectDataALL_e[$k] = db::query($sql_ALL);
											$num_b[$k] = db::num_rows($query_SelectDataALL_e[$k]);
											while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
												$array_raw[$k][] = $recSelectDataAll;
											}
										} else if ($_GET['DATA_SEARCH'] == 'CROSS_AND_ALL') {
											if ($_GET['DATA_SEARCH'] == 'COUPLE') { //คู่ เลือกรายการที่REGISTERCODE_1 เป็นโจทย์ และREGISTERCODE_2 เป็นจำเลย
												$check = '1';
												if ($_GET['case'] != "") {
													$filter_SYSTEM_TYPE .= " AND TB3.SYSTEM_TYPE in (" . sort_array($_GET['case']) . ") ";
												}
												if ($_GET['REGISTERCODE_C1'] != "") {

													$filter_1 = "  AND TB2.REGISTER_CODE in (" . str_replace('-', '', result_array($_GET['REGISTERCODE_C1'])) . ")
																		AND TB2.CONCERN_NAME in ('โจทก์')";
												}
												if ($_GET['REGISTERCODE_C2'] != "") {
													$filter_2 = "AND TB2.REGISTER_CODE in (" . str_replace('-', '', result_array($_GET['REGISTERCODE_C2'])) . ")
																	   AND TB2.CONCERN_NAME in ('จำเลย')";
												}
											}
											if ($_GET['DATA_SEARCH'] == 'CROSS') { //ไขว้
												$check = '2';
												if ($_GET['case'] != "") {
													$filter_SYSTEM_TYPE .= " AND TB3.SYSTEM_TYPE in (" . sort_array($_GET['case']) . ") ";
												}
												if ($_GET['REGISTERCODE_C1'] != "") {

													$filter_1 = " AND TB2.REGISTER_CODE in (" . str_replace('-', '', result_array($_GET['REGISTERCODE_C1'])) . ")";
												}
												if ($_GET['REGISTERCODE_C2'] != "") {
													$filter_2 = "AND TB2.REGISTER_CODE in (" . str_replace('-', '', result_array($_GET['REGISTERCODE_C2'])) . ")";
												}
											}
											if ($check > 0) {
												$sql_ALL = "SELECT 
												TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
												TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
												TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
												TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
												TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
												TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
												TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.CONERNSEQ,TB.WH_ID
												FROM VIEW_WH_ALL_CASE_PERSON TB 
												WHERE 1=1 
												 AND EXISTS (	
												 SELECT *FROM VIEW_WH_ALL_CASE_PERSON TB2
												 WHERE 1=1 
												 AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE 
												 AND TB2.BLACK_CASE=TB.BLACK_CASE 
												 AND TB2.BLACK_YY=TB.BLACK_YY 
												 AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
												 AND TB2.RED_CASE = TB.RED_CASE 
												 AND TB2.RED_YY = TB.RED_YY 
												{$filter_1})
												 AND EXISTS (
												 SELECT *FROM VIEW_WH_ALL_CASE_PERSON TB2
												 WHERE 1=1
												 AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE
												 AND TB2.BLACK_CASE=TB.BLACK_CASE
												 AND TB2.BLACK_YY=TB.BLACK_YY 
												 AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
												 AND TB2.RED_CASE = TB.RED_CASE 
												 AND TB2.RED_YY = TB.RED_YY 
												 {$filter_2})
											AND TB.REGISTER_CODE in(" . result_array($_GET['REGISTERCODE_C1']) . "," . result_array($_GET['REGISTERCODE_C2']) . ")
											{$filter_SYSTEM_TYPE}
											{$filter1}
											AND TB.SYSTEM_TYPE = '" . $sys . "'
											GROUP BY TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
											TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
											TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
											TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
											TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
											TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
											TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.CONERNSEQ,TB.WH_ID
											ORDER BY TB.CONERNSEQ ASC,TB.SYSTEM_TYPE ASC,
											CASE
												 WHEN TB.CONCERN_NAME = 'โจทก์' AND TB.CONERNSEQ IS NOT NULL THEN 1
												 WHEN TB.CONCERN_NAME = 'โจทก์' AND TB.CONERNSEQ IS NULL THEN 2
												 WHEN TB.CONCERN_NAME = 'จำเลย' AND TB.CONERNSEQ IS NOT NULL THEN 3
												 WHEN TB.CONCERN_NAME = 'จำเลย' AND TB.CONERNSEQ IS NULL THEN 4
												ELSE 5
											END
											 ";
												//echo $sql_ALL . "<br><br>";
											}
											$query_SelectDataALL_e[$k] = db::query($sql_ALL);
											$num_b[$k] = db::num_rows($query_SelectDataALL_e[$k]);
										}
										//echo  $sqlSelectDataALL_e."<br><br>";
									}

									?>

									<div class="card-block">
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
																				} ?>" data-toggle="tab" href="#<?php echo $sys; ?>" role="tab"><?php echo $sys_name; ?> <?php echo count($array_raw[$k]) == 0 ? "" : '<label class="badge bg-danger">' . count($array_raw[$k]) . '</label>'; ?></a>
														</li>
													<?php } ?>

												</ul>
												<!-- Tab panes -->
												<div class="tab-content tabs">
													<?php
													$k = 0;
													//print_r_pre($array_raw);
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
																		<th class="text-center">เลขบัตรประชาชน</th>
																		<th class="text-center">ชื่อ-สกุล</th>
																		<th class="text-center">สถานะ</th>
																		<th class="text-center">เลขคดีดำ/ปี</th>
																		<th class="text-center">เลขคดีแดง/ปี</th>
																		<th class="text-center">ศาล</th>
																		<th class="text-center">จัดการ</th>
																	</thead>
																	<?php
																	/* start  foreach */
																	$a = 1;
																	foreach ($array_raw[$k] as $SH1 => $AH1) {
																		if (count($SH1) > 0) {
																			//print_r_pre($AH1);
																			/* start A1 */
																	?>
																			<tr>
																				<div>
																					<td>
																						<div align='center'><?php echo $a; ?></div>
																					</td>
																					<td><?php echo $AH1['REGISTER_CODE']; ?> <span class="show_hide_area" style="display:none;cursor:pointer;" id="arr_<?php echo $sys; ?>_<?php echo $a; ?>"></span></td>
																					<td><?php echo $AH1['PREFIX_NAME'] . " " . $AH1['FIRST_NAME'] . " " . $AH1['LAST_NAME']; ?></td>
																					<td><?php echo $AH1['CONCERN_NAME']; ?></td>
																					<?php

																					$A = ($AH1['BLACK_CASE'] != '' && $AH1['BLACK_YY'] != '') ? "/" : "";
																					$B = ($AH1['RED_CASE'] != '' && $AH1['RED_YY'] != '') ? "/" : "";
																					?>
																					<td><a onclick="show_detial(
									'<?php echo $AH1['PREFIX_BLACK_CASE'] ?>',
									'<?php echo $AH1['BLACK_CASE'] ?>',
									'<?php echo $AH1['BLACK_YY'] ?>',
									'<?php echo $AH1['PREFIX_RED_CASE'] ?>',
									'<?php echo $AH1['RED_CASE'] ?>',
									'<?php echo $AH1['RED_YY'] ?>',
									'<?php echo $AH1['COURT_CODE'] ?>',
									'<?php echo convertSystem($AH1['SYSTEM_TYPE']) ?>',
									'<?php echo $AH1['REGISTER_CODE'] ?>',
									'<?php echo $AH1['SYSTEM_TYPE'] ?>');" href=""> <?php echo $AH1['PREFIX_BLACK_CASE'] . $AH1['BLACK_CASE'] . $A . $AH1['BLACK_YY']; ?></a></td>
																					<td><a onclick="show_detial(
									'<?php echo $AH1['PREFIX_BLACK_CASE'] ?>',
									'<?php echo $AH1['BLACK_CASE'] ?>',
									'<?php echo $AH1['BLACK_YY'] ?>',
									'<?php echo $AH1['PREFIX_RED_CASE'] ?>',
									'<?php echo $AH1['RED_CASE'] ?>',
									'<?php echo $AH1['RED_YY'] ?>',
									'<?php echo $AH1['COURT_CODE'] ?>',
									'<?php echo convertSystem($AH1['SYSTEM_TYPE']) ?>',
									'<?php echo $AH1['REGISTER_CODE'] ?>',
									'<?php echo $AH1['SYSTEM_TYPE'] ?>');" href=""><?php echo $AH1['PREFIX_RED_CASE'] . $AH1['RED_CASE'] . $B . $AH1['RED_YY']; ?></a></td>
																					<td><?php echo $AH1['COURT_NAME']; ?></td>
																					<td nowrap="true">
																						<nobr>
																							<div class="form-group row" align='center'>

																								<button type="button" data-toggle="tooltip" data-placement="top" title="ดูรายละเอียด" onclick="show_detial(
									'<?php echo $AH1['PREFIX_BLACK_CASE'] ?>',
									'<?php echo $AH1['BLACK_CASE'] ?>',
									'<?php echo $AH1['BLACK_YY'] ?>',
									'<?php echo $AH1['PREFIX_RED_CASE'] ?>',
									'<?php echo $AH1['RED_CASE'] ?>',
									'<?php echo $AH1['RED_YY'] ?>',
									'<?php echo $AH1['COURT_CODE'] ?>',
									'<?php echo convertSystem($AH1['SYSTEM_TYPE']) ?>',
									'<?php echo $AH1['REGISTER_CODE'] ?>',
									'<?php echo $AH1['SYSTEM_TYPE'] ?>');" class="btn btn-info btn-mini"> <i class="icofont icofont-search"></i></button>

																								<!-- 	<button type="button" data-toggle="tooltip" data-placement="top" title="ดูรายละเอียด" onclick="show_detial_btn(
									'<?php echo $AH1['WH_ID'] ?>','<?php echo $AH1['SYSTEM_TYPE'] ?>');" class="btn btn-info btn-mini"> <i class="icofont icofont-search"></i></button> -->
																								<!-- button show_detial stop-->

																								<button type="button" class="btn btn-success btn-mini" data-toggle="tooltip" data-placement="top" title="สอบถามความประสงค์" onclick="action_from('<?php echo $AH1['SYSTEM_TYPE']; ?>','<?php echo $AH1['PREFIX_BLACK_CASE']; ?>',  
								   '<?php echo $AH1['BLACK_CASE']; ?>','<?php echo $AH1['BLACK_YY']; ?>','<?php echo $AH1['PREFIX_RED_CASE']; ?>',
								   '<?php echo $AH1['RED_CASE']; ?>','<?php echo $AH1['RED_YY']; ?>','<?php echo $AH1['COURT_CODE']; ?>'
								   );"><i class="icofont icofont-ui-call"></i></button>

																								<button type="button" class="btn btn-primary btn-mini" data-toggle="tooltip" data-placement="top" title="คำสั่งเจ้าพนักงาน" onclick="action_from('<?php echo $AH1['SYSTEM_TYPE']; ?>','<?php echo $AH1['PREFIX_BLACK_CASE']; ?>',  
								   '<?php echo $AH1['BLACK_CASE']; ?>','<?php echo $AH1['BLACK_YY']; ?>','<?php echo $AH1['PREFIX_RED_CASE']; ?>',
								   '<?php echo $AH1['RED_CASE']; ?>','<?php echo $AH1['RED_YY']; ?>','<?php echo $AH1['COURT_CODE']; ?>'
								  );"><i class="icofont icofont-ui-messaging"></i></button>
																							</div>
																						</nobr>
																					</td>
																				</div>
																			</tr>
																			<tr id="<?php echo $sys; ?>_<?php echo $a; ?>">
																				<td id="td<?php echo $sys; ?>_<?php echo $a; ?>" colspan="8">
																					<table class="table"><?php

																											/* ทรัพ start*/
																											show_asset(
																												$AH1['PREFIX_BLACK_CASE'],
																												$AH1['BLACK_CASE'],
																												$AH1['BLACK_YY'],
																												$AH1['PREFIX_RED_CASE'],
																												$AH1['RED_CASE'],
																												$AH1['RED_YY'],
																												$AH1['COURT_CODE'],
																												convertSystem($AH1['SYSTEM_TYPE']),
																												$AH1['REGISTER_CODE']
																											);
																											/* ทรัพ stop*/
																											?></table>
																				</td>
																			</tr>
																			<script>
																				if ($('#td<?php echo $sys; ?>_<?php echo $a; ?>').html() == '<table class="table"></table>') {
																					$('#<?php echo $sys; ?>_<?php echo $a; ?>').hide();
																				} else {
																					$('#<?php echo $sys; ?>_<?php echo $a; ?>').hide();
																					$('#arr_<?php echo $sys; ?>_<?php echo $a; ?>').show();
																				}
																				$('#arr_<?php echo $sys; ?>_<?php echo $a; ?>').click(function() {
																					$(this).toggleClass('is-active');
																					$("#<?php echo $sys; ?>_<?php echo $a; ?>").slideToggle();


																				});
																			</script>
																		<?php
																			$a++;

																			/* stop A1 */
																		} else {
																		?>
																			<tr>
																				<td colspan="10">
																					<div align='center'><?php echo 'ไม่มีพบข้อมูล'; ?></div>
																				</td>
																			</tr>
																	<?php
																		}
																	}
																	/* stop foreach */
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

		function show_detial_btn(WH_ID, SYSTEM_TYPE) {

			$.ajax({
				url: './search_data_process_A.php',
				type: "POST",
				dataType: "html",
				data: {
					proc: "show_detial_btn",
					WH_ID: WH_ID,
					SYSTEM_TYPE: SYSTEM_TYPE
				},
				async: true,
				success: function(data) {
					data = JSON.parse(data)
					console.log('data')
					console.log(data)
					console.log(data['PREFIX_BLACK_CASE'])
					if (SYSTEM_TYPE = 'Civil') {
						SYSTEM_TYPE = 1;
					} else if (SYSTEM_TYPE = 'Bankrupt') {
						SYSTEM_TYPE = 2;
					}

					let url = "";
					url += "./search_data_show_detial.php?1=1"
					url += "&PREFIX_BLACK_CASE=" + data['PREFIX_BLACK_CASE']
					url += "&BLACK_CASE=" + data['BLACK_CASE']
					url += "&BLACK_YY=" + data['BLACK_YY']
					url += "&PREFIX_RED_CASE=" + data['PREFIX_RED_CASE']
					url += "&RED_CASE=" + data['RED_CASE']
					url += "&RED_YY=" + data['RED_YY']
					url += "&COURT_CODE=" + data['COURT_CODE']
					url += "&REGISTER_CODE=" + ""
					url += "&SYSTEM_TYPE=" + SYSTEM_TYPE
					window.open(url, 'Image', 'width=1000px.stylewidth,height=1000px.style.height,resizable=1');
				},
			});

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
			window.location = 'http://103.208.27.224:81/led_service_api/public/search_data.php'

		}

		function searchData() {
			let registerCode = $('#REGISTERCODE').val();

			let T_BLACK_CASE = $('#T_BLACK_CASE').val();
			let BLACK_CASE = $('#BLACK_CASE').val();
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

			if (registerCode != '' || (T_BLACK_CASE != '' && BLACK_CASE != '' && BLACK_YY != '') || (T_RED_CASE != '' && RED_CASE != '' && RED_YY != '')) {
				if ((T_BLACK_CASE != '' && BLACK_CASE != '' && BLACK_YY != '') || (T_RED_CASE != '' && RED_CASE != '' && RED_YY != '')) {
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