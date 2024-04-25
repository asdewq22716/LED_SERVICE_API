<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
$HIDE_HEADER = "P";


include('../include/include.php');


include('../include/paging.php');
include '../include/func_Nop.php';
include "./btn_function.php";
include '../service/check_case_Function.php';

CONVERT_GET((func::get_E_and_D("search_data_WH", "D", $_GET)));

function convertSystem_WH($A) //รับเข้าBANKRUPTหรือBankrupt => 2
{
	if ($A == 'BANKRUPT' || $A == 'Bankrupt') {
		$B = '2';
	}
	if ($A == 'CIVIL' || $A == 'Civil') {
		$B = '1';
	}
	if ($A == 'MEDIATE' || $A == 'Mediate') {
		$B = '4';
	}
	if ($A == 'REVIVE' || $A == 'Revive') {
		$B = '3';
	}
	return $B;
}


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

$_GET['pageCivil'] = (empty($_GET['pageCivil']) ? "1" : $_GET['pageCivil']);
$_GET['page_size_Civil'] = (empty($_GET['page_size_Civil']) ? "20" : $_GET['page_size_Civil']);

$_GET['pageBankrupt'] = (empty($_GET['pageBankrupt']) ? "1" : $_GET['pageBankrupt']);
$_GET['page_size_Bankrupt'] = (empty($_GET['page_size_Bankrupt']) ? "20" : $_GET['page_size_Bankrupt']);

$_GET['pageRevive'] = (empty($_GET['pageRevive']) ? "1" : $_GET['pageRevive']);
$_GET['page_size_Revive'] = (empty($_GET['page_size_Revive']) ? "20" : $_GET['page_size_Revive']);

$_GET['pageMediate'] = (empty($_GET['pageMediate']) ? "1" : $_GET['pageMediate']);
$_GET['page_size_Mediate'] = (empty($_GET['page_size_Mediate']) ? "20" : $_GET['page_size_Mediate']);



if ($_GET['SEND_TO'] == '1' && $_GET['PCC_CIVIL_GEN'] != ''  && $_GET['PAGE_CODE'] != '') {
	$PCC_CIVIL_GEN = $_GET['PCC_CIVIL_GEN'];
	$PAGE_CODE = $_GET['PAGE_CODE'];
	$sqlSelectData = "	SELECT 	CIVIL_CODE,
	COURT_CODE,
	COURT_NAME,
	PREFIX_BLACK_CASE,BLACK_CASE,BLACK_YY,
	PREFIX_RED_CASE,RED_CASE,RED_YY,
	PLAINTIFF1,DEFFENDANT1,PCC_CASE_GEN,WH_CIVIL_ID 
FROM 	WH_CIVIL_CASE
WHERE 	CIVIL_CODE = '" . $PCC_CIVIL_GEN . "'";
	$querySelectData = db::query($sqlSelectData);
	$dataSelectData = db::fetch_array($querySelectData);
	$num1 = db::num_rows($querySelectData);
	if ($num1 > 0) {
		$sql_DATA_SEARCH = "SELECT a.DATA_SEARCH FROM M_CHECK_CASE a  WHERE a.PAGE_CODE ='" . $PAGE_CODE . "'";
		$queryDATA_SEARCH = db::query($sql_DATA_SEARCH);
		$dataDATA_SEARCH  = db::fetch_array($queryDATA_SEARCH);
		//-------------------------------ค้นหาทั้งหมด------------------------------------
		if ($dataDATA_SEARCH['DATA_SEARCH'] == 'ALL') {
			$REGISTERCODE = checkMain::check_bank_CIVIL(checkMain::REGISTER_CODE_13_CIVIL($PCC_CIVIL_GEN, "", ""), $PAGE_CODE);
		} else if ($dataDATA_SEARCH['DATA_SEARCH'] == 'COUPLE' || $dataDATA_SEARCH['DATA_SEARCH'] == 'CROSS' || $dataDATA_SEARCH['DATA_SEARCH'] == 'CROSS_AND_ALL') {
			$REGISTERCODE_C1 = checkMain::check_bank_CIVIL(checkMain::REGISTER_CODE_13_CIVIL($PCC_CIVIL_GEN, "โจทก์,เจ้าหนี้", ""), $PAGE_CODE);
			$REGISTERCODE_C2 = checkMain::check_bank_CIVIL(checkMain::REGISTER_CODE_13_CIVIL($PCC_CIVIL_GEN, "จำเลย,ลูกหนี้", ""), $PAGE_CODE);
		} else if ($dataDATA_SEARCH['DATA_SEARCH'] == '1COUPLE2ALL') { //ตรวจโจทก์ เป็นคู๋ เเละตรวจจำเลยเเละอื่นๆเป็นทั้งหมด
			$REGISTERCODE_C1 = checkMain::check_bank_CIVIL(checkMain::REGISTER_CODE_13_CIVIL($PCC_CIVIL_GEN, "โจทก์,เจ้าหนี้", ""), $PAGE_CODE); //เอาโจทก์
			$REGISTERCODE_C2 = checkMain::check_bank_CIVIL(checkMain::REGISTER_CODE_13_CIVIL($PCC_CIVIL_GEN, "จำเลย,ลูกหนี้", ""), $PAGE_CODE); //เอาจำเลย
			$REGISTERCODE_C3 = checkMain::check_bank_CIVIL(checkMain::REGISTER_CODE_13_CIVIL($PCC_CIVIL_GEN, "", "โจทก์,เจ้าหนี้,จำเลย,ลูกหนี้"), $PAGE_CODE); //เอาทุกสถานะยกเว้น โจทก์ จำเลย
		}
	}
	$sql_check_case = "SELECT *FROM M_CHECK_CASE a WHERE a.PAGE_CODE='" . $PAGE_CODE . "' AND  a.CMD_ID ='1'";
	$query_check_case = db::query($sql_check_case);
	while ($rec_check_case = db::fetch_array($query_check_case)) { //start while
		if ($rec_check_case['URL_CODE'] == "http://103.208.27.224:81/led_service_api/public/search_data_WH.php") {
			$array_check = explode(",", $rec_check_case['NOTE']); //แปลงข้อมูล เป็นarray เพื่อเช็คค่า
			if ($rec_check_case['DATA_SEARCH'] == 'ALL') {
				if (in_array("REGISTERCODE", $array_check)) {
					if ($REGISTERCODE != '') { //รหัสบัตรประชาชน
						$link .= "&REGISTERCODE=" .  $REGISTERCODE;
					}
				}
			} else { //DATA_SEARCH เท่ากับอย่างอื่นนอกจากALL
				if (in_array("REGISTERCODE", $array_check)) {
					if ($REGISTERCODE_C1 != '') { //โจทก์
						$link .= "&REGISTERCODE_C1=" . $REGISTERCODE_C1;
					}
					if ($REGISTERCODE_C2 != '') { //จำเลย
						$link .= "&REGISTERCODE_C2=" . $REGISTERCODE_C2;
					}
					if ($REGISTERCODE_C3 != '') { //อื่นๆที่ไม่ใช่ โจทก์ จำเลย
						$link .= "&REGISTERCODE_C3=" . $REGISTERCODE_C3;
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
			$link .= "&pageCivil=" . $_GET['pageCivil'];
			$link .= "&page_size_Civil=" . $_GET['page_size_Civil'];

			$link .= "&DATA_SEARCH=" . $rec_check_case['DATA_SEARCH'];
			$link .= "&PAGE_CODE=" . $PAGE_CODE;
			$link .= "&PCC_CIVIL_GEN=" . $PCC_CIVIL_GEN;
			$link .= "&TO_PERSON_ID=" . $_GET['TO_PERSON_ID'] . "&SEND_TO=1";
		}
	}
	(CONVERT_GET($link)); //แปลงข้อมูลเป็นGET
	//print_r_pre(CONVERT_GET($link));
}
/* stop เเพ่ง */


/*start ตรวจคนล้มละลาย */
if ($_GET['SEND_TO'] == '2' && $_GET['brcID'] != ''  && $_GET['PAGE_CODE'] != '') {


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
				$REGISTERCODE = checkMain::check_bank_Bankrupt(checkMain::REGISTER_CODE_13_BANKRUPT($brcID, "", ""), $PAGE_CODE); //เอาโจทย์เเละจำเลย พร้อมตัดธนาคารออก
			} else if ($dataDATA_SEARCH['DATA_SEARCH'] == 'COUPLE' || $dataDATA_SEARCH['DATA_SEARCH'] == 'CROSS' || $dataDATA_SEARCH['DATA_SEARCH'] == 'CROSS_AND_ALL') {
				$REGISTERCODE_C1 = checkMain::check_bank_Bankrupt(checkMain::REGISTER_CODE_13_BANKRUPT($brcID, "โจทก์,เจ้าหนี้", ""), $PAGE_CODE); //เอาโจทย์เเละจำเลย พร้อมตัดธนาคารออก
				$REGISTERCODE_C2 = checkMain::check_bank_Bankrupt(checkMain::REGISTER_CODE_13_BANKRUPT($brcID, "จำเลย,ลูกหนี้", ""), $PAGE_CODE); //เอาโจทย์เเละจำเลย พร้อมตัดธนาคารออก
			} else if ($dataDATA_SEARCH['DATA_SEARCH'] == '1COUPLE2ALL') { //ตรวจโจทก์ เป็นคู๋ เเละตรวจจำเลยเเละอื่นๆเป็นทั้งหมด
				$REGISTERCODE_C1 = checkMain::check_bank_Bankrupt(checkMain::REGISTER_CODE_13_BANKRUPT($brcID, "โจทก์,เจ้าหนี้", ""), $PAGE_CODE); //เอาโจทก์
				$REGISTERCODE_C2 = checkMain::check_bank_Bankrupt(checkMain::REGISTER_CODE_13_BANKRUPT($brcID, "จำเลย,ลูกหนี้", ""), $PAGE_CODE); //เอาจำเลย
				$REGISTERCODE_C3 = checkMain::check_bank_Bankrupt(checkMain::REGISTER_CODE_13_BANKRUPT($brcID, "", "โจทก์,เจ้าหนี้,จำเลย,ลูกหนี้"), $PAGE_CODE); //เอาทุกสถานะยกเว้น โจทก์ จำเลย
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
						if ($REGISTERCODE_C1 != '') { //โจทก์
							$link .= "&REGISTERCODE_C1=" . $REGISTERCODE_C1;
						}
						if ($REGISTERCODE_C2 != '') { //จำเลย
							$link .= "&REGISTERCODE_C2=" . $REGISTERCODE_C2;
							// $link .= "&CONCERNED_C2=" . cut_last_comma($CONCERNED_C2);
						}
						if ($REGISTERCODE_C3 != '') { //อื่นๆที่ไม่ใช่ โจทก์ จำเลย
							$link .= "&REGISTERCODE_C3=" . $REGISTERCODE_C3;
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
				$link .= "&pageBankrupt=" . $_GET['pageBankrupt'];
				$link .= "&page_size_Bankrupt=" . $_GET['page_size_Bankrupt'];

				$link .= "&DATA_SEARCH=" . $rec_check_case['DATA_SEARCH'];
				$link .= "&brcID=" . $brcID;
				$link .= "&PAGE_CODE=" . $PAGE_CODE;
				$link .= "&TO_PERSON_ID=" . $_GET['TO_PERSON_ID'] . "&SEND_TO=2";
				(CONVERT_GET($link)); //แปลงข้อมูลเป็นGET
			}
		}
	}
}
/* ตรวจคน stop  จบ if*/

/* ตรวจคนระบบฟื้นฟู */
if ($_GET['SEND_TO'] == '3' && $_GET['WFR_API'] != ''  && $_GET['PAGE_CODE'] != '') {
	if ($_GET['WFR_API'] != '') {
		$WFR_API = $_GET['WFR_API'];
		$PAGE_CODE = $_GET['PAGE_CODE'];
		$toPersonId = $_GET['TO_PERSON_ID'];

		if ($PAGE_CODE == '234') {
			$sql_page234 = "SELECT a.REHAB_CODE,b.REGISTER_CODE  FROM WH_REHABILITATION_CASE_DETAIL a 
			JOIN WH_REHABILITATION_PERSON b ON a.WH_REHAB_ID =b.WH_REHAB_ID 
			WHERE b.WFR_ID_REHAB20 ='" . $WFR_API . "'";
			$query_page234 = db::query($sql_page234);
			$rec_page234 = db::fetch_array($query_page234);
			$WFR_API_IDCARD = $_GET['WFR_API'];
			$WFR_API = $rec_page234["REHAB_CODE"];
		}
		function convert_IDCARD_234($WFR_API)
		{
			$sql_page234 = "SELECT a.REHAB_CODE,b.REGISTER_CODE  FROM WH_REHABILITATION_CASE_DETAIL a 
			JOIN WH_REHABILITATION_PERSON b ON a.WH_REHAB_ID =b.WH_REHAB_ID 
			WHERE b.WFR_ID_REHAB20 ='" . $WFR_API . "'";
			$query_page234 = db::query($sql_page234);
			$rec_page234 = db::fetch_array($query_page234);
			return $rec_page234["REGISTER_CODE"];
		}

		$sqlSelectData = "	select * from WH_REHABILITATION_CASE_DETAIL where REHAB_CODE='" . $WFR_API . "' ";
		$querySelectData = db::query($sqlSelectData);
		$dataSelectData = db::fetch_array($querySelectData); //เอาข้อมูลไว้หาคดีดำเเดง
		$num1 = db::num_rows($querySelectData);


		if ($num1 > 0) {
			$sql_DATA_SEARCH = "SELECT a.DATA_SEARCH FROM M_CHECK_CASE_REVIVE a  WHERE a.PAGE_CODE ='" . $PAGE_CODE . "'";
			$queryDATA_SEARCH = db::query($sql_DATA_SEARCH);
			$dataDATA_SEARCH  = db::fetch_array($queryDATA_SEARCH);
			//-------------------------------ค้นหาทั้งหมด------------------------------------
			if ($dataDATA_SEARCH['DATA_SEARCH'] == 'ALL') {
				$REGISTERCODE = checkMain::check_bank_Revive(checkMain::REGISTER_CODE_13_REVIVE($WFR_API, "", ""), $PAGE_CODE);
				if ($PAGE_CODE == '234') {
					$REGISTERCODE = convert_IDCARD_234($WFR_API_IDCARD);
				}
			} else if ($dataDATA_SEARCH['DATA_SEARCH'] == 'COUPLE' || $dataDATA_SEARCH['DATA_SEARCH'] == 'CROSS' || $dataDATA_SEARCH['DATA_SEARCH'] == 'CROSS_AND_ALL') {
				$REGISTERCODE_C1 = checkMain::check_bank_Revive(checkMain::REGISTER_CODE_13_REVIVE($WFR_API, "โจทก์,เจ้าหนี้", ""), $PAGE_CODE);
				$REGISTERCODE_C2 = checkMain::check_bank_Revive(checkMain::REGISTER_CODE_13_REVIVE($WFR_API, "จำเลย,ลูกหนี้", ""), $PAGE_CODE);
			} else if ($dataDATA_SEARCH['DATA_SEARCH'] == '1COUPLE2ALL') { //ตรวจโจทก์ เป็นคู๋ เเละตรวจจำเลยเเละอื่นๆเป็นทั้งหมด
				$REGISTERCODE_C1 = checkMain::check_bank_Revive(checkMain::REGISTER_CODE_13_REVIVE($WFR_API, "โจทก์,เจ้าหนี้", ""), $PAGE_CODE); //เอาโจทก์
				$REGISTERCODE_C2 = checkMain::check_bank_Revive(checkMain::REGISTER_CODE_13_REVIVE($WFR_API, "จำเลย,ลูกหนี้", ""), $PAGE_CODE); //เอาจำเลย
				$REGISTERCODE_C3 = checkMain::check_bank_Revive(checkMain::REGISTER_CODE_13_REVIVE($WFR_API, "", "โจทก์,เจ้าหนี้,จำเลย,ลูกหนี้"), $PAGE_CODE); //เอาทุกสถานะยกเว้น โจทก์ จำเลย
			}

			$sql_check_case = "SELECT *FROM  M_CHECK_CASE_REVIVE a WHERE a.PAGE_CODE='" . $PAGE_CODE . "' ";
			$query_check_case = db::query($sql_check_case);
			while ($rec_check_case = db::fetch_array($query_check_case)) { //start while
				$array_check = explode(",", $rec_check_case['NOTE_PERSON']); //แปลงข้อมูล เป็นarray เพื่อเช็คค่า
				/* ตรวจคน start -----------------------------------------------------------------------------*/
				if ($rec_check_case['URL_CODE_PERSON'] == "http://103.208.27.224:81/led_service_api/public/search_data_WH.php") {
					if ($rec_check_case['DATA_SEARCH'] == 'ALL') {
						if (in_array("REGISTERCODE", $array_check)) {
							if ($REGISTERCODE != '') { //รหัสบัตรประชาชน
								$link .= "&REGISTERCODE=" .  $REGISTERCODE;
							}
						}
					} else {
						if (in_array("REGISTERCODE", $array_check)) {
							if ($REGISTERCODE_C1 != '') { //โจทก์
								$link .= "&REGISTERCODE_C1=" . $REGISTERCODE_C1;
							}
							if ($REGISTERCODE_C2 != '') { //จำเลย
								$link .= "&REGISTERCODE_C2=" . $REGISTERCODE_C2;
							}
							if ($REGISTERCODE_C3 != '') { //อื่นๆที่ไม่ใช่ โจทก์ จำเลย
								$link .= "&REGISTERCODE_C3=" . $REGISTERCODE_C3;
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
					$link .= "&pageRevive=" . $_GET['pageRevive'];
					$link .= "&page_size_Revive=" . $_GET['page_size_Revive'];

					$link .= "&WFR_API=" . $WFR_API;
					$link .= "&PAGE_CODE=" . $PAGE_CODE;
					$link .= "&TO_PERSON_ID=" . $_GET['TO_PERSON_ID'] . "&SEND_TO=3";
					$link .= "&DATA_SEARCH=" . $rec_check_case['DATA_SEARCH'];
				}
				(CONVERT_GET($link)); //แปลงข้อมูลเป็นGET
			}
		}
	}
}
/* ตรวจคนระบบฟื้นฟู stop */

/* ตรวจคนระบบไกล่เกลี่ย */
if ($_GET['SEND_TO'] == '4' && $_GET['WFR_API'] != '' && $_GET['PAGE_CODE'] != '') {
	if ($_GET['WFR_API'] != '') {
		$WFR_API = $_GET['WFR_API'];
		$PAGE_CODE = $_GET['PAGE_CODE'];
		$toPersonId = $_GET['TO_PERSON_ID'];

		$sqlSelectData = "	SELECT *FROM WH_MEDIATE_CASE a WHERE a.REF_WFR_ID = '" . $WFR_API . "'";
		$querySelectData = db::query($sqlSelectData);
		$dataSelectData = db::fetch_array($querySelectData); //เอาข้อมูลไว้หาคดีดำเเดง
		$num1 = db::num_rows($querySelectData);

		if ($num1 > 0) {
			$sql_DATA_SEARCH = "SELECT a.DATA_SEARCH FROM M_CHECK_CASE_MEDIATE a  WHERE a.PAGE_CODE ='" . $PAGE_CODE . "'";
			$queryDATA_SEARCH = db::query($sql_DATA_SEARCH);
			$dataDATA_SEARCH  = db::fetch_array($queryDATA_SEARCH);
			//-------------------------------ค้นหาทั้งหมด------------------------------------
			if ($dataDATA_SEARCH['DATA_SEARCH'] == 'ALL') {
				$REGISTERCODE = checkMain::check_bank_Mediate(checkMain::REGISTER_CODE_13_MEDIATE($WFR_API, "", ""), $PAGE_CODE);
			} else if ($dataDATA_SEARCH['DATA_SEARCH'] == 'COUPLE' || $dataDATA_SEARCH['DATA_SEARCH'] == 'CROSS' || $dataDATA_SEARCH['DATA_SEARCH'] == 'CROSS_AND_ALL') {
				$REGISTERCODE_C1 = checkMain::check_bank_Mediate(checkMain::REGISTER_CODE_13_MEDIATE($WFR_API, "โจทก์,เจ้าหนี้", ""), $PAGE_CODE);
				$REGISTERCODE_C2 = checkMain::check_bank_Mediate(checkMain::REGISTER_CODE_13_MEDIATE($WFR_API, "จำเลย,ลูกหนี้", ""), $PAGE_CODE);
			} else if ($dataDATA_SEARCH['DATA_SEARCH'] == '1COUPLE2ALL') { //ตรวจโจทก์ เป็นคู๋ เเละตรวจจำเลยเเละอื่นๆเป็นทั้งหมด
				$REGISTERCODE_C1 = checkMain::check_bank_Mediate(checkMain::REGISTER_CODE_13_MEDIATE($WFR_API, "โจทก์,เจ้าหนี้", ""), $PAGE_CODE); //เอาโจทก์
				$REGISTERCODE_C2 = checkMain::check_bank_Mediate(checkMain::REGISTER_CODE_13_MEDIATE($WFR_API, "จำเลย,ลูกหนี้", ""), $PAGE_CODE); //เอาจำเลย
				$REGISTERCODE_C3 = checkMain::check_bank_Mediate(checkMain::REGISTER_CODE_13_MEDIATE($WFR_API, "", "โจทก์,เจ้าหนี้,จำเลย,ลูกหนี้"), $PAGE_CODE); //เอาทุกสถานะยกเว้น โจทก์ จำเลย
			}
			$sql_check_case = "SELECT *FROM  M_CHECK_CASE_MEDIATE a WHERE a.PAGE_CODE='" . $PAGE_CODE . "' ";
			$query_check_case = db::query($sql_check_case);
			while ($rec_check_case = db::fetch_array($query_check_case)) { //start while
				$array_check = explode(",", $rec_check_case['NOTE_PERSON']); //แปลงข้อมูล เป็นarray เพื่อเช็คค่า
				/* ตรวจคน start -----------------------------------------------------------------------------*/
				if ($rec_check_case['URL_CODE_PERSON'] == "http://103.208.27.224:81/led_service_api/public/search_data_WH.php") {
					if ($rec_check_case['DATA_SEARCH'] == 'ALL') {
						if (in_array("REGISTERCODE", $array_check)) {
							if ($REGISTERCODE != '') { //รหัสบัตรประชาชน
								$link .= "&REGISTERCODE=" .  $REGISTERCODE;
							}
						}
					} else {
						if (in_array("REGISTERCODE", $array_check)) {
							if ($REGISTERCODE_C1 != '') { //โจทก์
								$link .= "&REGISTERCODE_C1=" . $REGISTERCODE_C1;
							}
							if ($REGISTERCODE_C2 != '') { //จำเลย
								$link .= "&REGISTERCODE_C2=" . $REGISTERCODE_C2;
							}
							if ($REGISTERCODE_C3 != '') { //อื่นๆที่ไม่ใช่ โจทก์ จำเลย
								$link .= "&REGISTERCODE_C3=" . $REGISTERCODE_C3;
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
					$link .= "&pageMediate=" . $_GET['pageMediate'];
					$link .= "&page_size_Mediate=" . $_GET['page_size_Mediate'];

					$link .= "&WFR_API=" . $WFR_API;
					$link .= "&PAGE_CODE=" . $PAGE_CODE;
					$link .= "&TO_PERSON_ID=" . $_GET['TO_PERSON_ID'] . "&SEND_TO=4";
					$link .= "&DATA_SEARCH=" . $rec_check_case['DATA_SEARCH'];
				}
				(CONVERT_GET($link)); //แปลงข้อมูลเป็นGET
			}
		}
	}
}

//print_r_pre($_GET);
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
/* print_pre(main_case::checkPeopleAll($link)); */
$arr_system = array("Civil" => "คดีแพ่ง", "Bankrupt" => "คดีล้มละลาย", "Revive" => "คดีฟื้นฟู", "Mediate" => "คดีไกล่เกลี่ย");

/* $arr_system = array("Civil" => "คดีแพ่ง", "Bankrupt" => "คดีล้มละลาย", "Revive" => "คดีฟื้นฟู",  "Mediate" => "คดีไกล่เกลี่ย"); */
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include '../include/template_user.php'; ?>
</head>

<!-- <body id="bsf_body" class="horizontal-fixed fixed">
    <div class="wrapper"></div> -->

<body id="bsf_body" class="">
	<form method="GET" action="./search_data.php" enctype="multipart/form-data" id="frm-input">
		<!-- PAGE_CODE=123&=1103411005612&=4&=ALL&STATUS=SEARCH -->
		<input type="hidden" name="DATA_SEARCH" id="DATA_SEARCH" value="<?php echo $_GET['DATA_SEARCH']; ?>">
		<input type="hidden" name="PAGE_CODE" id="PAGE_CODE" value="<?php echo $_GET['PAGE_CODE']; ?>">
		<input type="hidden" name="PCC_CIVIL_GEN" id="PCC_CIVIL_GEN" value="<?php echo $_GET['PCC_CIVIL_GEN']; ?>">
		<input type="hidden" name="brcID" id="brcID" value="<?php echo $_GET['brcID']; ?>">
		<input type="hidden" name="WFR_API" id="WFR_API" value="<?php echo $_GET['WFR_API']; ?>">

		<input type="hidden" name="TO_PERSON_ID" id="TO_PERSON_ID" value="<?php echo $_GET['TO_PERSON_ID']; ?>">
		<input type="hidden" name="SEND_TO" id="SEND_TO" value="<?php echo $_GET['SEND_TO']; ?>">
		<input type="hidden" name="REGISTERCODE_C1" id="REGISTERCODE_C1" value="<?php echo $_GET['REGISTERCODE_C1']; ?>">
		<input type="hidden" name="REGISTERCODE_C2" id="REGISTERCODE_C2" value="<?php echo $_GET['REGISTERCODE_C2']; ?>">
		<input type="hidden" name="REGISTERCODE_C3" id="REGISTERCODE_C3" value="<?php echo $_GET['REGISTERCODE_C3']; ?>">


		<input type="hidden" id="pageCivil" name="pageCivil" value="<?php echo $_GET['pageCivil']; ?>">
		<input type="hidden" id="pageBankrupt" name="pageBankrupt" value="<?php echo $_GET['pageBankrupt']; ?>">
		<input type="hidden" id="pageRevive" name="pageRevive" value="<?php echo $_GET['pageRevive']; ?>">
		<input type="hidden" id="pageMediate" name="pageMediate" value="<?php echo $_GET['pageMediate']; ?>">

		<input type="hidden" id="page_size_Civil" name="page_size_Civil" value="<?php echo $_GET['page_size_Civil']; ?>">
		<input type="hidden" id="page_size_Bankrupt" name="page_size_Bankrupt" value="<?php echo $_GET['page_size_Bankrupt']; ?>">
		<input type="hidden" id="page_size_Revive" name="page_size_Revive" value="<?php echo $_GET['page_size_Revive']; ?>">
		<input type="hidden" id="page_size_Mediate" name="page_size_Mediate" value="<?php echo $_GET['page_size_Mediate']; ?>">

		<input type="hidden" id="STATUS" name="STATUS" value="<?php echo $_GET['STATUS']; ?>">


		<div class="wrapper">
			<?php
			//  include '../include/combottom_js_user.php'; //function 
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

			<style>
				/* กำหนดสไตล์สำหรับ Pagination */
				.pagination {
					display: flex;
					list-style: none;
					padding: 0;
					margin: 20px 0;
					justify-content: center;
				}

				/* กำหนดสไตล์สำหรับรายการหน้า */
				.pagination li {
					margin: 0 0px;
					display: flex;
				}

				/* กำหนดสไตล์สำหรับลิงค์ของหน้า */
				.pagination li a {
					text-decoration: none;
					color: #333;
					padding: 5px 10px;
					border: 1px solid #ccc;
					border-radius: 3px;
				}

				/* กำหนดสไตล์สำหรับลิงค์ของหน้า (เมื่อนอกเนื้อหาปัจจุบัน) */
				.pagination li a:hover {
					background-color: #f4f4f4;
				}

				/* กำหนดสไตล์สำหรับลิงค์ของหน้าปัจจุบัน */
				.pagination li.active a {
					background-color: #007bff;
					color: #fff;
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
										<div class="form-group">
											<div class="card-header">
												<h4 class="card-header-text">
													<b>ตรวจคน</b>
												</h4>
											</div>
										</div>
										<?php if ($_GET['REGISTERCODE'] != "") { ?>
											<div class="form-group">
												<div class="card-header">
													<h5 class="card-header-text">
														<b>เลขทะเบียนนิติบุคคล/เลขบัตรประชาชน :</b>
														<?php echo $_GET['REGISTERCODE']; ?>
													</h5>
												</div>
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


										//print_r_pre($_GET);
										/* เเสดงคดีตัวเอง start */
										function idcard_status($sql, $idcard)
										{
											$qry = db::query($sql);
											$array_rec = array();
											while ($rec = db::fetch_array($qry)) {
												$array_rec[$rec['REGISTER_CODE']][] = $rec['CONCERN_NAME'];
											}
											return implode(',', array_unique($array_rec[$idcard]));;
										}
										if ($_GET['STATUS'] == 'SEARCH') {
										?>

											<div class="form-group row">
												<div class="col-xs-12 col-sm-2" align=""><label for="" class="form-control-label wf-right">ค้นหาจาก13หลัก </label></div>
												<div class="col-xs-12 col-sm-3"><input class="form-control" type="text" oninput="input_Number(this)" name="REGISTERCODE" id="REGISTERCODE"></div>
											</div>
											<div class="row">
												<div class="col-xs-12 col-sm-6" align="right">
													<button type="button" class="btn btn-primary" onClick="searchData();">ค้นหา</button>
												</div>
											</div>
										<?php
										} else if (!empty($_GET['PCC_CIVIL_GEN']) || !empty($_GET['brcID']) || !empty($_GET['WFR_API'])) {

										?>
											<div class="col-lg-12">
												<div class="card-header">
													<h5 class="card-header-text">ข้อมูลคดีที่ส่งมาตรวจ</h5>
												</div>
											</div>
											<?php
											if ($_GET['PCC_CIVIL_GEN'] != "" && $SEND_TO == '1') { //คดีต้นทางในเเพ่ง
												$CivilFill = "  b.REGISTER_CODE,b.PREFIX_NAME,b.FIRST_NAME,b.LAST_NAME,
																b.CONCERN_NAME,b.BLACK_CASE,b.BLACK_YY,b.RED_CASE,b.RED_YY,
																b.RED_CASE,b.PREFIX_BLACK_CASE,b.PREFIX_RED_CASE,b.COURT_NAME,";
												$sqlSelectData_main = "	SELECT 	{$CivilFill}
																			a.WH_CIVIL_ID as WH_ID,'Civil' as SYSTEM_TYPE
															FROM 	WH_CIVIL_CASE a
															JOIN " . Convert::ConvertTable('WH_CIVIL_CASE_PERSON') . "  b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
															WHERE 	CIVIL_CODE = '" . $_GET['PCC_CIVIL_GEN']  . "'
															GROUP BY {$CivilFill}a.WH_CIVIL_ID";
												$querySelectData = db::query($sqlSelectData_main);
											}
											if ($_GET['brcID'] != "" && $SEND_TO == '2') { //คดีต้นทางในล้มละลาย
												$BankruptFill = "  b.REGISTER_CODE,b.PREFIX_NAME,b.FIRST_NAME,b.LAST_NAME,
																b.CONCERN_NAME,b.BLACK_CASE,b.BLACK_YY,b.RED_CASE,b.RED_YY,
																b.RED_CASE,b.PREFIX_BLACK_CASE,b.PREFIX_RED_CASE,b.COURT_NAME,";
												$sqlSelectData_main = "	SELECT {$BankruptFill} 
																			a.WH_BANKRUPT_ID as WH_ID,'Bankrupt' as SYSTEM_TYPE
															FROM WH_BANKRUPT_CASE_DETAIL a 
															JOIN WH_BANKRUPT_CASE_PERSON b ON a.WH_BANKRUPT_ID =b.WH_BANKRUPT_ID 
															WHERE a.BANKRUPT_CODE  = '" . $_GET['brcID']  . "'
															GROUP BY {$BankruptFill}a.WH_BANKRUPT_ID";
												$querySelectData = db::query($sqlSelectData_main);
											}
											if ($_GET['WFR_API'] != "" && $SEND_TO == '3') { //คดีต้นทางในฟื้นฟู
												$ReviveFill = "  b.REGISTER_CODE,b.PREFIX_NAME,b.FIRST_NAME,b.LAST_NAME,
																b.CONCERN_NAME,b.BLACK_CASE,b.BLACK_YY,b.RED_CASE,b.RED_YY,
																b.RED_CASE,b.PREFIX_BLACK_CASE,b.PREFIX_RED_CASE,b.COURT_NAME,";
												if ($PAGE_CODE == '234') {
													$REGISTERCODE = convert_IDCARD_234($WFR_API_IDCARD);
													$Fill_F = "AND b.REGISTER_CODE ='" . $REGISTERCODE . "'";
												}
												$sqlSelectData_main = "	SELECT {$ReviveFill} 
																		a.WH_REHAB_ID as WH_ID ,'Revive' as SYSTEM_TYPE
															FROM WH_REHABILITATION_CASE_DETAIL a  
															JOIN WH_REHABILITATION_PERSON b ON a.WH_REHAB_ID  = b.WH_REHAB_ID 
															where a.REHAB_CODE='" . $_GET['WFR_API'] . "' {$Fill_F}
															GROUP BY {$ReviveFill} a.WH_REHAB_ID";
												$querySelectData = db::query($sqlSelectData_main);
											}
											if ($_GET['WFR_API'] != "" && $SEND_TO == '4') { //คดีต้นทาง ไกล่เกลี่ย
												$MediateFill = "  b.REGISTER_CODE,b.PREFIX_NAME,b.FIRST_NAME,b.LAST_NAME,
																b.CONCERN_NAME,b.BLACK_CASE,b.BLACK_YY,b.RED_CASE,b.RED_YY,
																b.RED_CASE,b.PREFIX_BLACK_CASE,b.PREFIX_RED_CASE,b.COURT_NAME,";
												$sqlSelectData_main = "	SELECT {$MediateFill} 
																			a.WH_MEDAITE_ID as WH_ID,'Mediate' as SYSTEM_TYPE
															 FROM WH_MEDIATE_CASE a 
															 JOIN WH_MEDIATE_PERSON b ON a.WH_MEDAITE_ID =b.WH_MEDIATE_ID 
															WHERE a.REF_WFR_ID = '" .  $_GET['WFR_API']  . "'
															GROUP BY {$MediateFill} a.WH_MEDAITE_ID";
												$querySelectData = db::query($sqlSelectData_main);
											}
											//echo $sqlSelectData_main;
											?>
											<div class="card-block">
												<!-- Row start -->
												<div class="row">
													<div class="col-lg-12">
														<div class="tab-content tabs">
															<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
																<thead class="bg-primary">
																	<th class="text-center">ลำดับ</th>
																	<th class="text-center">เลขทะเบียนนิติบุคคล/เลขบัตรประชาชน</th>
																	<th class="text-center">ชื่อ-สกุล</th>
																	<th class="text-center">สถานะ</th>
																	<th class="text-center">เลขคดีดำ/ปี</th>
																	<th class="text-center">เลขคดีแดง/ปี</th>
																	<th class="text-center">ศาล</th>
																	<th class="text-center">จัดการ</th>
																</thead>
																<?php
																$a = 0;
																while ($rec_PCC = db::fetch_array($querySelectData)) {

																	$a++;
																?>
																	<tr>
																		<div>
																			<td>
																				<div align='center'><?php echo $a; ?></div>
																			</td>
																			<td><?php echo $rec_PCC['REGISTER_CODE']; ?></td>
																			<td><?php echo $rec_PCC['PREFIX_NAME'] . " " . $rec_PCC['FIRST_NAME'] . " " . $rec_PCC['LAST_NAME']; ?></td>
																			<td><?php echo $rec_PCC['CONCERN_NAME']; ?></td>
																			<?php
																			$A = ($rec_PCC['BLACK_CASE'] != '' && $rec_PCC['BLACK_YY'] != '') ? "/" : "";
																			$B = ($rec_PCC['RED_CASE'] != '' && $rec_PCC['RED_YY'] != '') ? "/" : "";
																			?>
																			<?php
																			if ($_GET['DATA_SEARCH'] == 'ALL') { // ส่ง13หลักของคนที่ตรวจไปด้วย
																				$IDCARD = $_GET['REGISTERCODE'];
																			} else {
																				$IDCARD = $_GET['REGISTERCODE_C1'] . "," . $_GET['REGISTERCODE_C2'];
																			}
																			?>
																			<td><a href="" onclick="show_detial_2(
									'<?php echo $rec_PCC['SYSTEM_TYPE'] ?>',
									'<?php echo ($IDCARD) ?>','<?php echo WH_ID_CONVERT_TO_CODE_API($rec_PCC['WH_ID'], $rec_PCC['SYSTEM_TYPE']); ?>','<?php echo $rec_PCC['REGISTER_CODE']; ?>');"><?php echo $rec_PCC['PREFIX_BLACK_CASE'] . $rec_PCC['BLACK_CASE'] . $A . $rec_PCC['BLACK_YY']; ?></a></td>
																			<td><a href="" onclick="show_detial_2(
									'<?php echo $rec_PCC['SYSTEM_TYPE'] ?>',
									'<?php echo ($IDCARD) ?>','<?php echo WH_ID_CONVERT_TO_CODE_API($rec_PCC['WH_ID'], $rec_PCC['SYSTEM_TYPE']); ?>','<?php echo $rec_PCC['REGISTER_CODE']; ?>');"><?php echo $rec_PCC['PREFIX_RED_CASE'] . $rec_PCC['RED_CASE'] . $B . $rec_PCC['RED_YY']; ?></a></td>
																			<td><?php echo $rec_PCC['COURT_NAME']; ?></td>
																			<td nowrap="true">
																				<nobr>
																					<div class="form-group row" align='center'>

																						<button type="button" data-toggle="tooltip" data-placement="top" title="ดูรายละเอียด" onclick="show_detial_2(
									'<?php echo $rec_PCC['SYSTEM_TYPE'] ?>',
									'<?php echo ($IDCARD) ?>','<?php echo WH_ID_CONVERT_TO_CODE_API($rec_PCC['WH_ID'], $rec_PCC['SYSTEM_TYPE']); ?>','<?php echo $rec_PCC['REGISTER_CODE']; ?>');" class="btn btn-info btn-mini"> <i class="icofont icofont-search"></i></button>
																					</div>
																				</nobr>
																			</td>
																		</div>
																	</tr>
																<?php } ?>
															</table>
														</div>
													</div>
												</div>
											</div>
										<?php } ?>
										<?php
										/* แสดงคดีตัวเอง stop */
										$array_raw = [];
										unset($array_raw);
										foreach ($arr_system as $sys => $sys_name) {
											$k++;
											$filter1 = "";

											/* start ไม่เอาคดีตัวเอง */
											if (!empty($_GET['PCC_CIVIL_GEN'])) {
												$CodeApi = $_GET['PCC_CIVIL_GEN'];
											} elseif (!empty($_GET['brcID'])) {
												$CodeApi = $_GET['brcID'];
											} elseif (!empty($_GET['WFR_API'])) {
												$CodeApi = $_GET['WFR_API'];
											}
											$filter1 .= checkMain::NotInCaseMyself($CodeApi, $SEND_TO, $sys);
											/* stop ไม่เอาคดีตัวเอง */

											// การเรียงของคิวรี่ตรวจคน
											$order = "	ORDER BY TB.SYSTEM_TYPE ASC,
														TB.REGISTER_CODE ASC,
														TO_NUMBER(TB.CONCERN_NO) ASC";


											// เป็น 13หลัก ใช้ในการตรวจคน
											$REGISTERCODE = result_array(str_replace('-', '', ($_GET['REGISTERCODE']))); //โจทก์ จำเลย สถานะอื่นๆ

											$REGISTERCODE_C1 = result_array(str_replace('-', '', ($_GET['REGISTERCODE_C1']))); //โจทก์
											$REGISTERCODE_C2 = result_array(str_replace('-', '', ($_GET['REGISTERCODE_C2']))); //จำเลย
											$REGISTERCODE_C3 = result_array(str_replace('-', '', ($_GET['REGISTERCODE_C3']))); //สถานะอื่นที่ไม่ใช่โจทก์เเละจำเลย

											if ($_GET['DATA_SEARCH'] == 'ALL') { //ทั้งหมด

												//ส่ง 13หลักมาตรวจตรงๆใช้ REGISTERCODE=11111,22222,33333
												$REGISTERCODE = $REGISTERCODE == "" ? "" : $REGISTERCODE;

												if ($REGISTERCODE != "") {
													$filter1 .= " and TB.REGISTER_CODE in (" . $REGISTERCODE . ") ";
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

												if ($filter1 != "" &&  !empty($REGISTERCODE)) {
													$sqlSelectDataALL_e = "SELECT * FROM VIEW_PERSON_GROUP TB 
																		WHERE TB.SYSTEM_TYPE = '" . $sys . "' 
																		{$filter1}{$order} ";
													//echo "<br><br>" . $sqlSelectDataALL_e;
													$query_SelectDataALL_e[$k] = db::query($sqlSelectDataALL_e);
													while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
														$array_raw[$k][] = $recSelectDataAll;
													}
												}
											} else if ($_GET['DATA_SEARCH'] == 'COUPLE' || $_GET['DATA_SEARCH'] == 'CROSS') {
												$check = 0;
												//คู่ เลือกรายการที่REGISTERCODE_1 เป็นโจทย์ และREGISTERCODE_2 เป็นจำเลย
												if ($_GET['DATA_SEARCH'] == 'COUPLE') {
													$check = '1';
													if ($_GET['REGISTERCODE_C1'] != "") {

														$filter_1 = "  AND TB2.REGISTER_CODE in (" . $REGISTERCODE_C1 . ")
																		AND TB2.CONCERN_NAME in ('โจทก์','เจ้าหนี้')";
													}
													if ($_GET['REGISTERCODE_C2'] != "") {
														$filter_2 = "AND TB2.REGISTER_CODE in (" . $REGISTERCODE_C2 . ")
																	   AND TB2.CONCERN_NAME in ('จำเลย','ลูกหนี้')";
													}
												}
												//ไขว้ ส่งโจทก์เเละจำเลยไปตรวจเป็นสถานะอื่นๆ นอกจากจำเลย
												if ($_GET['DATA_SEARCH'] == 'CROSS') {
													$check = '2';
													if ($_GET['REGISTERCODE_C1'] != "") {

														$filter_1 = " AND TB2.REGISTER_CODE in (" . $REGISTERCODE_C1 . ")";
													}
													if ($_GET['REGISTERCODE_C2'] != "") {
														$filter_2 = "AND TB2.REGISTER_CODE in (" . $REGISTERCODE_C2 . ")";
													}
												}
												if ($check > 0) {
													$sql_ALL = "";
													$sql_ALL = "SELECT *FROM VIEW_PERSON_GROUP TB 
																WHERE 1=1 
																	AND EXISTS (	
																	SELECT *FROM VIEW_PERSON_GROUP TB2
																	WHERE 1=1 
																	AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE 
																	AND TB2.BLACK_CASE=TB.BLACK_CASE 
																	AND TB2.BLACK_YY=TB.BLACK_YY 
																	AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
																	AND TB2.RED_CASE = TB.RED_CASE 
																	AND TB2.RED_YY = TB.RED_YY 
																	{$filter_1})
																	AND EXISTS (
																	SELECT *FROM VIEW_PERSON_GROUP TB2
																	WHERE 1=1
																	AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE
																	AND TB2.BLACK_CASE=TB.BLACK_CASE
																	AND TB2.BLACK_YY=TB.BLACK_YY 
																	AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
																	AND TB2.RED_CASE = TB.RED_CASE 
																	AND TB2.RED_YY = TB.RED_YY 
																	{$filter_2})
																AND TB.REGISTER_CODE in(" . $REGISTERCODE_C1 . "," . $REGISTERCODE_C2 . ")
																{$filter1}
																AND TB.SYSTEM_TYPE = '" . $sys . "'
																{$order}
																";
												}
												$query_SelectDataALL_e[$k] = db::query($sql_ALL);
												while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
													$array_raw[$k][] = $recSelectDataAll;
												}
											} else if ($_GET['DATA_SEARCH'] == 'CROSS_AND_ALL') {
												//การตรวจไขว์เเละทั้งหมดคือ เอาโจทย์เเละจำเลยไปตรวจ คู่กันเป็นอะไรก็ได้ในคดีอื่น 
												//จากนั้นนำโจทย์้้ละจำเลยไปตรวจ ที่สถาอื่นนอกจากสถานะตัวเอง
												$check = 0;
												if ($_GET['DATA_SEARCH'] == 'CROSS_AND_ALL') { //ไขว้
													$check = '2';
													if ($_GET['REGISTERCODE_C1'] != "") {
														$filter_1 = " AND TB2.REGISTER_CODE in (" . $REGISTERCODE_C1 . ")";
													}
													if ($_GET['REGISTERCODE_C2'] != "") {
														$filter_2 = "AND TB2.REGISTER_CODE in (" . $REGISTERCODE_C2 . ")";
													}
												}
												if ($check > 0) {
													$sql_ALL = "";
													$sql_ALL = "SELECT * FROM VIEW_PERSON_GROUP TB 
																WHERE 1=1 
																		AND EXISTS (	
																		SELECT *FROM VIEW_PERSON_GROUP TB2
																		WHERE 1=1 
																		AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE 
																		AND TB2.BLACK_CASE=TB.BLACK_CASE 
																		AND TB2.BLACK_YY=TB.BLACK_YY 
																		AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
																		AND TB2.RED_CASE = TB.RED_CASE 
																		AND TB2.RED_YY = TB.RED_YY 
																		{$filter_1})
																		AND EXISTS (
																		SELECT *FROM VIEW_PERSON_GROUP TB2
																		WHERE 1=1
																		AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE
																		AND TB2.BLACK_CASE=TB.BLACK_CASE
																		AND TB2.BLACK_YY=TB.BLACK_YY 
																		AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
																		AND TB2.RED_CASE = TB.RED_CASE 
																		AND TB2.RED_YY = TB.RED_YY 
																		{$filter_2})
																	AND TB.REGISTER_CODE in(" . $REGISTERCODE_C1 . "," . $REGISTERCODE_C2 . ")
																	{$filter1}
																	AND TB.SYSTEM_TYPE = '" . $sys . "'
																	{$order}
																	";
												}
												$query_SelectDataALL_e[$k] = db::query($sql_ALL);
												while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
													$array_raw[$k][] = $recSelectDataAll;
												}


												/* start ตรวจโจทย์ในสถานะอื่น */
												$sql_ALL = "";
												$sql_ALL = "SELECT* FROM VIEW_PERSON_GROUP TB 
																WHERE 1=1 	
															AND TB.REGISTER_CODE in(" . $REGISTERCODE_C1 . ")
															AND TB.CONCERN_NAME NOT IN ('โจทก์','เจ้าหนี้')				
															AND TB.SYSTEM_TYPE = '" . $sys . "'
															{$filter1}{$order}
															";
												$query_SelectDataALL_e[$k] = db::query($sql_ALL);
												while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
													$array_raw[$k][] = $recSelectDataAll;
												}
												/* stop ตรวจโจทย์ในสถานะอื่น */

												/* start ตรวจจำเลยในสถานะอื่น */
												$sql_ALL = "";
												$sql_ALL = "SELECT * FROM VIEW_PERSON_GROUP TB 
																WHERE 1=1 	
															AND TB.REGISTER_CODE in(" . $REGISTERCODE_C2 . ")
															AND TB.CONCERN_NAME NOT IN ('จำเลย','ลูกหนี้')	
															AND TB.SYSTEM_TYPE = '" . $sys . "'
															{$filter1}{$order}
															";
												$query_SelectDataALL_e[$k] = db::query($sql_ALL);
												while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
													$array_raw[$k][] = $recSelectDataAll;
												}
												/* stop ตรวจจำเลยในสถานะอื่น */
											} else if ($_GET['DATA_SEARCH'] == 'COUPLE_AND_ALL') { //การตรวจคู่เเละทั้งหมดคือ เอาโจทย์เเละจำเลยไปตรวจ คู่กันเป็นอะไรก็ได้ในคดีอื่น จากนั้นนำโจทย์้้ละจำเลยไปตรวจ ที่สถาอื่นนอกจากสถานะตัวเอง
												$check = 0;
												if ($_GET['DATA_SEARCH'] == 'COUPLE_AND_ALL') { //คู่ เลือกรายการที่REGISTERCODE_1 เป็นโจทย์ และREGISTERCODE_2 เป็นจำเลย
													$check = '1';
													if ($_GET['REGISTERCODE_C1'] != "") { //ส่ง โจทก์ เจ้าหนี้ มาตรวจ
														$filter_1 = "  AND TB2.REGISTER_CODE in (" . $REGISTERCODE_C1 . ")
																		AND TB2.CONCERN_NAME in ('โจทก์','เจ้าหนี้')";
													}
													if ($_GET['REGISTERCODE_C2'] != "") { //ส่ง จำเลย ลูกหนี้ มาตรวจ
														$filter_2 = "AND TB2.REGISTER_CODE in (" . $REGISTERCODE_C2 . ")
																	   AND TB2.CONCERN_NAME in ('จำเลย','ลูกหนี้')";
													}
												}
												if ($check > 0) {
													$sql_ALL = "";
													$sql_ALL = "SELECT * FROM VIEW_PERSON_GROUP TB 
																		WHERE 1=1 
																	AND EXISTS (	
																	SELECT *FROM VIEW_PERSON_GROUP TB2
																	WHERE 1=1 
																	AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE 
																	AND TB2.BLACK_CASE=TB.BLACK_CASE 
																	AND TB2.BLACK_YY=TB.BLACK_YY 
																	AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
																	AND TB2.RED_CASE = TB.RED_CASE 
																	AND TB2.RED_YY = TB.RED_YY 
																	{$filter_1})
																	AND EXISTS (
																	SELECT *FROM VIEW_PERSON_GROUP TB2
																	WHERE 1=1
																	AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE
																	AND TB2.BLACK_CASE=TB.BLACK_CASE
																	AND TB2.BLACK_YY=TB.BLACK_YY 
																	AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
																	AND TB2.RED_CASE = TB.RED_CASE 
																	AND TB2.RED_YY = TB.RED_YY 
																	{$filter_2})
																AND TB.REGISTER_CODE in(" . $REGISTERCODE_C1 . "," . $REGISTERCODE_C2 . ")			
																AND TB.SYSTEM_TYPE = '" . $sys . "'
																{$filter1}{$order}
																";
													//echo $sql_ALL . "<br><br>";
												}
												$query_SelectDataALL_e[$k] = db::query($sql_ALL);
												while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
													$array_raw[$k][] = $recSelectDataAll;
												}
												/* start ตรวจโจทย์ในสถานะอื่น */
												$sql_ALL = "";
												$sql_ALL = "SELECT *
																FROM VIEW_PERSON_GROUP TB 
																WHERE 1=1 	
															AND TB.REGISTER_CODE in(" . $REGISTERCODE_C1 . ")
															AND TB.CONCERN_NAME  NOT IN ('โจทก์','เจ้าหนี้')
															AND TB.SYSTEM_TYPE = '" . $sys . "'
															{$filter1}{$order}
													 ";
												$query_SelectDataALL_e[$k] = db::query($sql_ALL);
												while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
													$array_raw[$k][] = $recSelectDataAll;
												}
												/* stop ตรวจโจทย์ในสถานะอื่น */

												/* start ตรวจจำเลยในสถานะอื่น */
												$sql_ALL = "";
												$sql_ALL = "SELECT * FROM VIEW_WH_ALL_CASE_PERSON TB 
																WHERE 1=1 	
															AND TB.REGISTER_CODE in(" . $REGISTERCODE_C2 . ")
															AND TB.CONCERN_NAME NOT IN ('จำเลย','ลูกหนี้')	
															AND TB.SYSTEM_TYPE = '" . $sys . "'
															{$filter1}{$order}
															 ";
												$query_SelectDataALL_e[$k] = db::query($sql_ALL);
												while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
													$array_raw[$k][] = $recSelectDataAll;
												}
												/* stop ตรวจจำเลยในสถานะอื่น */
											} else if ($_GET['DATA_SEARCH'] == '1COUPLE2ALL') {
												//ตรวจโจทก์เป็นคู่เเละตรวจจำเลยหรือสถานะอื่่นๆเป็นทั้งหมด


												//ตรวจโจทก์ เจ้าหนี้ มาตรวจเป็นคู๋กับ จำเลย ลูกหนี้ ในคดี
												if ($_GET['REGISTERCODE_C1'] != "") {
													$filter_1 = "  AND TB2.REGISTER_CODE in (" . $REGISTERCODE_C1 . ")
																	AND TB2.CONCERN_NAME in ('โจทก์','เจ้าหนี้')";
												}
												if ($_GET['REGISTERCODE_C2'] != "") {
													$filter_2 = "AND TB2.REGISTER_CODE in (" . $REGISTERCODE_C2 . ")
																   AND TB2.CONCERN_NAME in ('จำเลย','ลูกหนี้')";
												}
												$sql_ALL = "";
												$sql_ALL = "SELECT *FROM VIEW_PERSON_GROUP TB 
																	WHERE 1=1 
																AND EXISTS (	
																SELECT *FROM VIEW_PERSON_GROUP TB2
																WHERE 1=1 
																AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE 
																AND TB2.BLACK_CASE=TB.BLACK_CASE 
																AND TB2.BLACK_YY=TB.BLACK_YY 
																AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
																AND TB2.RED_CASE = TB.RED_CASE 
																AND TB2.RED_YY = TB.RED_YY 
																{$filter_1})
																AND EXISTS (
																SELECT *FROM VIEW_PERSON_GROUP TB2
																WHERE 1=1
																AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE
																AND TB2.BLACK_CASE=TB.BLACK_CASE
																AND TB2.BLACK_YY=TB.BLACK_YY 
																AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
																AND TB2.RED_CASE = TB.RED_CASE 
																AND TB2.RED_YY = TB.RED_YY 
																{$filter_2})
															AND TB.REGISTER_CODE in(" . $REGISTERCODE_C1 . "," . $REGISTERCODE_C2 . ")
															AND TB.SYSTEM_TYPE = '" . $sys . "'
															{$filter1}{$order}
															";
												//echo $sql_ALL . "<br><br>";
												$query_SelectDataALL_e[$k] = db::query($sql_ALL);
												while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
													$array_raw[$k][] = $recSelectDataAll;
												}

												/* start ตรวจโจทย์ในสถานะอื่น */
												$sql_ALL = "";
												//ตรวจล้ม ถ้าเจอโจทก์ติดล้ม โจทก์ตรวจAll
												if (!empty($REGISTERCODE_C1)) {
													$num = 0;
													$num = bankrupt::checkPersonBanrupt2($REGISTERCODE_C1, 'จำเลย');
													if ($num = 0) {
														$fill = "AND TB.CONCERN_NAME  NOT IN ('โจทก์','เจ้าหนี้')";
													}
													$sql_ALL = "SELECT *
																	FROM VIEW_PERSON_GROUP TB 
																	WHERE 1=1 	
																AND TB.REGISTER_CODE in(" . $REGISTERCODE_C1 . ")
																{$fill}
																AND TB.SYSTEM_TYPE = '" . $sys . "'
																{$filter1}{$order}
														 ";
													$query_SelectDataALL_e[$k] = db::query($sql_ALL);
												}
												//echo $sql_ALL."<br><br>";
												while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
													$array_raw[$k][] = $recSelectDataAll;
												}
												/* stop ตรวจโจทย์ในสถานะอื่น */


												//ส่งจำเลย ลูกหนี้ มาตรวจ Allในทุกสถานะ
												$sql_ALL = "";
												$sql_ALL = "SELECT * FROM VIEW_WH_ALL_CASE_PERSON TB 
																WHERE 1=1 	
															AND TB.REGISTER_CODE in(" . $REGISTERCODE_C2 . ")
															AND TB.SYSTEM_TYPE = '" . $sys . "'
															{$filter1}{$order}
															 ";
												//echo $sql_ALL . "<br><br>";
												$query_SelectDataALL_e[$k] = db::query($sql_ALL);
												while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
													$array_raw[$k][] = $recSelectDataAll;
												}


												//ส่งสถานะอื่นๆ นอกจากโจทก์ เจ้าหนี้ จำเลย ลูกหนี้  มาตรวจ All ในทุกสถานะ
												$sql_ALL = "";
												$sql_ALL = "SELECT * FROM VIEW_WH_ALL_CASE_PERSON TB 
																	WHERE 1=1 	
																AND TB.REGISTER_CODE in(" . $REGISTERCODE_C3 . ")
																AND TB.SYSTEM_TYPE = '" . $sys . "'
																{$filter1}{$order}
																 ";
												//echo $sql_ALL . "<br><br>";
												$query_SelectDataALL_e[$k] = db::query($sql_ALL);
												while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
													$array_raw[$k][] = $recSelectDataAll;
												}
											}
										}
										//echo  $sqlSelectDataALL_e."<br><br>";
										//unset($array_raw);
										//$array_raw=main_case::checkPeopleAll($link);
										?>

										<div class="card-block">
											<!-- Row start -->
											<div class="row">
												<div class="col-lg-12">
													<!-- Nav tabs -->
													<ul class="nav nav-tabs  tabs" role="tablist">
														<?php


														$A = 0;
														//เรียงข้อมูล unique
														foreach ($arr_system as $sys => $sys_name) {
															$A++;
															$ArrayCase[$A] = func::unique_Array($array_raw[$A]);
															//$ArrayCase[$A] = $array_raw[$A];
														}

														$k = 0;
														foreach ($arr_system as $sys => $sys_name) {
															$k++;

														?>
															<li class="nav-item">
																<a class="nav-link <?php if ($k == 1) {
																						echo "active";
																					} ?>" data-toggle="tab" href="#<?php echo $sys; ?>" role="tab"><?php echo $sys_name; ?> <?php echo count($ArrayCase[$k]) == 0 ? "" : '<label class="badge bg-danger">' . count($ArrayCase[$k]) . '</label>'; ?></a>
															</li>
														<?php } ?>

													</ul>

													<!-- Tab panes -->
													<div class="tab-content tabs">
														<?php
														$k = 0;
														//print_r_pre($array_raw);
														//print_r_pre($ArrayCase);
														//print_r_pre($array_raw[1]);
														$P = [];
														$offset = [];
														$limit = [];
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
																			<th class="text-center">เลขทะเบียนนิติบุคคล/เลขบัตรประชาชน</th>
																			<th class="text-center">ชื่อ-สกุล</th>
																			<th class="text-center">สถานะที่ส่งมาตรวจ</th>
																			<th class="text-center">สถานะบุคคลในระบบ</th>
																			<th class="text-center">เลขคดีดำ/ปี</th>
																			<th class="text-center">เลขคดีแดง/ปี</th>
																			<th class="text-center">ศาล</th>
																			<?php
																			if ($sys == 'Mediate') {
																			?>
																				<th class="text-center">เลขที่ไกล่เกลี่ย</th>
																			<?php
																			}
																			?>
																			<th class="text-center">จัดการ</th>
																		</thead>
																		<?php
																		/* start  foreach */
																		$a = 0;
																		//print_r_pre($array_raw);

																		if ($sys == "Civil") {
																			$P[$sys] = $_GET['page_size_Civil'] - 1;
																			$offset[$sys] = ($_GET['pageCivil'] * $_GET['page_size_Civil']) - $P[$sys];
																			$limit[$sys] = $_GET['pageCivil'] * $_GET['page_size_Civil'];
																		}
																		if ($sys == "Bankrupt") {
																			$P[$sys] = $_GET['page_size_Bankrupt'] - 1;
																			$offset[$sys] = ($_GET['pageBankrupt'] * $_GET['page_size_Bankrupt']) - $P[$sys];
																			$limit[$sys] = $_GET['pageBankrupt'] * $_GET['page_size_Bankrupt'];
																		}
																		if ($sys == "Revive") {
																			$P[$sys] = $_GET['page_size_Revive'] - 1;
																			$offset[$sys] = ($_GET['pageRevive'] * $_GET['page_size_Revive']) - $P[$sys];
																			$limit[$sys] = $_GET['pageRevive'] * $_GET['page_size_Revive'];
																		}
																		if ($sys == "Mediate") {
																			$P[$sys] = $_GET['page_size_Mediate'] - 1;
																			$offset[$sys] = ($_GET['pageMediate'] * $_GET['page_size_Mediate']) - $P[$sys];
																			$limit[$sys] = $_GET['pageMediate'] * $_GET['page_size_Mediate'];
																		}

																		foreach ($ArrayCase[$k] as $SH1 => $AH1) {
																			$a++;
																			if (count($SH1) > 0) {
																				if ($a >= $offset[$sys] && $a <= $limit[$sys]) {
																					//print_r_pre($AH1);
																					/* start A1 */
																					$num_show_asset = num_show_asset(
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
																		?>
																					<tr>
																						<div>
																							<td>
																								<div align='center'><?php echo $a; ?></div>
																							</td>
																							<td><?php echo $AH1['REGISTER_CODE']; ?> <?php if ($num_show_asset > 0) { ?><span class="show_hide_area" style="display:none;cursor:pointer;" id="arr_<?php echo $sys; ?>_<?php echo $a; ?>"></span><?php } ?></td>
																							<td><?php echo $AH1['PREFIX_NAME'] . " " . $AH1['FIRST_NAME'] . " " . $AH1['LAST_NAME']; ?></td>
																							<td><?php echo (idcard_status($sqlSelectData_main, $AH1['REGISTER_CODE'])); ?></td>
																							<td><?php if ($k == '2') {
																									echo addStatusBankrupt($AH1['CONCERN_NAME'], $AH1['WH_ID'], $AH1['REGISTER_CODE']);
																								} else {
																									echo $AH1['CONCERN_NAME'];
																								}
																								?></td>
																							<?php

																							$A = ($AH1['BLACK_CASE'] != '' && $AH1['BLACK_YY'] != '') ? "/" : "";
																							$B = ($AH1['RED_CASE'] != '' && $AH1['RED_YY'] != '') ? "/" : "";
																							?>
																							<td><a onclick="show_detial_2(
									'<?php echo $AH1['SYSTEM_TYPE'] ?>',
									'<?php echo ($IDCARD) ?>',
									'<?php echo WH_ID_CONVERT_TO_CODE_API($AH1['WH_ID'], $AH1['SYSTEM_TYPE']); ?>','<?php echo $AH1['REGISTER_CODE']; ?>');" href=""> <?php echo $AH1['PREFIX_BLACK_CASE'] . $AH1['BLACK_CASE'] . $A . $AH1['BLACK_YY']; ?></a></td>
																							<td><a onclick="show_detial_2(
									'<?php echo $AH1['SYSTEM_TYPE'] ?>',
									'<?php echo ($IDCARD) ?>',
									'<?php echo WH_ID_CONVERT_TO_CODE_API($AH1['WH_ID'], $AH1['SYSTEM_TYPE']); ?>','<?php echo $AH1['REGISTER_CODE']; ?>');" href=""><?php echo $AH1['PREFIX_RED_CASE'] . $AH1['RED_CASE'] . $B . $AH1['RED_YY']; ?></a></td>
																							<td><?php echo $AH1['COURT_NAME']; ?></td>
																							<?php
																							if ($sys == 'Mediate') {
																								$sql_med = "SELECT a.MEDIATE_NO  ,a.*
																						FROM WH_MEDIATE_CASE_DETAIL a 
																						WHERE a.WH_MEDIATE_ID ='" . $AH1['WH_ID'] . "'";
																								$query = db::query($sql_med);
																								$rec_med = db::fetch_array($query)
																							?>
																								<td><?php echo $rec_med['MEDIATE_NO']; ?></td>
																							<?php
																							}
																							?>
																							<td nowrap="true">
																								<nobr>
																									<div class="form-group row" align='center'>
																										<button type="button" data-toggle="tooltip" data-placement="top" title="ดูรายละเอียด" onclick="show_detial_2(
									'<?php echo $AH1['SYSTEM_TYPE'] ?>',
									'<?php echo ($IDCARD) ?>',
									'<?php echo WH_ID_CONVERT_TO_CODE_API($AH1['WH_ID'], $AH1['SYSTEM_TYPE']); ?>','<?php echo $AH1['REGISTER_CODE']; ?>');" class="btn btn-info btn-mini"> <i class="icofont icofont-search"></i></button>

																										<?php if ($_GET['STATUS'] != 'SEARCH') { ?>
																											<button type="button" class="btn btn-primary btn-mini" data-toggle="tooltip" data-placement="top" title="คำสั่งเจ้าพนักงาน" onclick="action_from('<?php echo $AH1['SYSTEM_TYPE']; ?>','<?php echo $AH1['PREFIX_BLACK_CASE']; ?>',  
								   '<?php echo $AH1['BLACK_CASE']; ?>','<?php echo $AH1['BLACK_YY']; ?>','<?php echo $AH1['PREFIX_RED_CASE']; ?>',
								   '<?php echo $AH1['RED_CASE']; ?>','<?php echo $AH1['RED_YY']; ?>','<?php echo $AH1['COURT_CODE']; ?>','<?php echo $AH1['REGISTER_CODE']; ?>'
								  );"><i class="icofont icofont-ui-messaging"></i></button>
																										<?php } ?>
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
																				}
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
																<!-- <div class="row">
																	<?php echo @(ceil(count($ArrayCase[$k]) / $_GET['page_size']) > 1) ? endPaging("frm-input", count($ArrayCase[$k])) : ""; ?>
																</div> -->
																<?php
																if ($sys == "Civil") {
																?>
																	<div class="row">
																		<?php
																		$requestPage = $_REQUEST['pageCivil'];
																		$RequestPageSize = $_REQUEST['page_size_Civil'];
																		$pageCivilFunc = new PagingMain($requestPage, $RequestPageSize, "pageCivil", "page_size_Civil");
																		echo  @(ceil(count($ArrayCase[$k]) / $_GET['page_size']) > 1) ? $pageCivilFunc->endPaging("frm-input", count($ArrayCase[$k])) : ""; ?>
																	</div>
																<?php
																}
																if ($sys == "Bankrupt") {
																?>
																	<div class="row">
																		<?php
																		$requestPage = $_REQUEST['pageBankrupt'];
																		$RequestPageSize = $_REQUEST['page_size_Bankrupt'];
																		$pageBankruptFunc = new PagingMain($requestPage, $RequestPageSize, "pageBankrupt", "page_size_Bankrupt");
																		echo  @(ceil(count($ArrayCase[$k]) / $_GET['page_size']) > 1) ? $pageBankruptFunc->endPaging("frm-input", count($ArrayCase[$k])) : ""; ?>
																	</div>
																<?php
																}
																if ($sys == "Revive") {
																?>
																	<div class="row">
																		<?php
																		$requestPage = $_REQUEST['pageRevive'];
																		$RequestPageSize = $_REQUEST['page_size_Revive'];
																		$pageReviveFunc = new PagingMain($requestPage, $RequestPageSize, "pageRevive", "page_size_Revive");
																		echo  @(ceil(count($ArrayCase[$k]) / $_GET['page_size']) > 1) ? $pageReviveFunc->endPaging("frm-input", count($ArrayCase[$k])) : ""; ?>
																	</div>
																<?php
																}
																if ($sys == "Mediate") {
																?>
																	<div class="row">
																		<?php
																		$requestPage = $_REQUEST['pageMediate'];
																		$RequestPageSize = $_REQUEST['page_size_Mediate'];
																		$pageMediateFunc = new PagingMain($requestPage, $RequestPageSize, "pageMediate", "page_size_Mediate");
																		echo  @(ceil(count($ArrayCase[$k]) / $_GET['page_size']) > 1) ? $pageMediateFunc->endPaging("frm-input", count($ArrayCase[$k])) : ""; ?>
																	</div>
																<?php
																}

																?>
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
	</form>





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

			const TO_PERSON_ID = $('#TO_PERSON_ID').val();
			const idCard = $('#REGISTERCODE').val();
			if (TO_PERSON_ID == "") {
				alert('กรุณาติดต่อAdmin');
				return false;
			}
			$.ajax({
				type: "POST",
				url: "../public/search_data_process_A.php",
				data: {
					proc: 'log_searchPerson',
					TO_PERSON_ID: TO_PERSON_ID,
					idCard: idCard
				},
				cache: false,
				success: function(data) {

				}
			});
			$("#frm-input")
				.attr("target", "")
				.attr("action", "")
				.submit();
		}

		function action_from(sh1, prefixBlackCase, blackCase, blackYy, prefixRedCase, redCase, redYy, CourtCode, REGISTER_CODE) {

			let SEND_TO = '<?php echo $_GET['SEND_TO']; ?>'
			let PCC_CIVIL_GEN = '<?php echo $_GET['PCC_CIVIL_GEN']; ?>'
			let brcID = '<?php echo $_GET['brcID']; ?>'
			let WFR_API = '<?php echo $_GET['WFR_API']; ?>'
			let url = "./cmd_add_from.php?";
			if (SEND_TO == '1') { //เเพ่ง
				url += "&SEND_FROM=" + 'CIVIL'; //ส่งเพื่อเข้าif
				url += "&PCC_CIVIL_GEN=" + PCC_CIVIL_GEN;
			}
			if (SEND_TO == '2') { //ล้มละลาย
				url += "&SEND_FROM=" + 'BANKRUPT'; //ส่งเพื่อเข้าif
				url += "&brcID=" + brcID;
			}
			if (SEND_TO == '3') { //ฟื้นฟู
				url += "&SEND_FROM=" + 'REVIVE'; //ส่งเพื่อเข้าif
				url += "&WFR_API=" + WFR_API;
			}
			if (SEND_TO == '4') { //ไกล่เกลี่ย
				url += "&SEND_FROM=" + 'MEDIATE'; //ส่งเพื่อเข้าif
				url += "&WFR_API=" + WFR_API;
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
			url += "&REGISTER_CODE=" + REGISTER_CODE; // มี2สถานะ 1 สอบถามความประส่ง เเละค่าว่างคือเลือกได้หมด
			// window.location.href = url;
			window.open(url, 'Image', 'width=1000px.stylewidth,height=1000px.style.height,resizable=1');
			//$('#frm-input').attr('action', './cmd_add_from.php').submit();
		}
	</script>
	<?php
	include '../include/combottom_js_user.php';
	include '../include/combottom_user.php'; ?>