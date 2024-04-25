<?php 

/*start ตรวจคนล้มละลาย */
$SEND_TO=2;
if ($SEND_TO == '2') {
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
			return $input_array;
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
			return cut_last_comma($data_Arr);
		}
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
				$REGISTERCODE = check_bank(REGISTER_CODE_13_BANKRUPT($brcID, ""), $PAGE_CODE); //เอาโจทย์เเละจำเลย พร้อมตัดธนาคารออก
			} else if ($dataDATA_SEARCH['DATA_SEARCH'] == 'COUPLE' || $dataDATA_SEARCH['DATA_SEARCH'] == 'CROSS' || $dataDATA_SEARCH['DATA_SEARCH'] == 'CROSS_AND_ALL') {
				$REGISTERCODE_C1 = check_bank(REGISTER_CODE_13_BANKRUPT($brcID, "โจทก์"), $PAGE_CODE); //เอาโจทย์เเละจำเลย พร้อมตัดธนาคารออก
				$REGISTERCODE_C2 = check_bank(REGISTER_CODE_13_BANKRUPT($brcID, "จำเลย"), $PAGE_CODE); //เอาโจทย์เเละจำเลย พร้อมตัดธนาคารออก

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
				$link .= "&TO_PERSON_ID=" . $_GET['TO_PERSON_ID'] . "&SEND_TO=2";
				(CONVERT_GET($link)); //แปลงข้อมูลเป็นGET
			}
		}
	}
}
/* ตรวจคน stop  จบ if*/
?>