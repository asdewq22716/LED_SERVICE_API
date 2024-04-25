<?php
include '../include/include.php';
include '../include/func_Nop.php';
include './check_case_Function.php';

$str_json = file_get_contents("php://input");
$data = json_decode($str_json, true);


if ($res['ip']) {
	$ip = $res['ip'];
} else {
	$ip = get_client_ip();
}

$field = array();
$field['IP_ADDRESS'] = $ip;
$field['DEP_ID'] = $POST['depId'];
$field['REQUEST'] = 'getPersonInfo';
$field['LOG_DATE'] = date("Y-m-d");
$field['LOG_TIME'] = date("H:i:s");
$field['USR_ID'] = '';
$field['REQUEST_STATUS'] = '200';
$field['USR_IDCARD'] = $POST['idCard'];
$field['LOG_TYPE'] = '1';
//$field['REQUEST_DATA'] = $str_json;

$LOG_ID = db::db_insert('M_LOG', $field, 'LOG_ID', 'LOG_ID');

// $h = fopen("log_file/" . $LOG_ID . '.txt', "w");
// fwrite($h, $REQUEST_DATA);
// fclose($h);

$h = fopen("log_file/getPersonInfo-json_" . $LOG_ID . '.txt', "w");
fwrite($h, json_encode($data, JSON_UNESCAPED_UNICODE));
fclose($h);


if ($data['userName'] == "BankruptDt" && $data['passWord'] == "Debtor4321") {

	$filter = "";

	if (!empty($data['registerCode'])) {
		$filter .= "AND (REPLACE(REGISTERCODE,'-','') = '" . $data['registerCode'] . "' OR REGISTERCODE = '" . $data['registerCode'] . "')";
	}
	if (!empty($data['prefixBlackCase']) && !empty($data['blackCase']) && !empty($data['blackYy'])) {
		$filter .= "AND (T_NO_BLACK = '" . $data['prefixBlackCase'] . "' AND NO_BLACK_CASE = '" . $data['blackCase'] . "' AND BLACK_YEAR = '" . $data['blackYy'] . "')";
	}
	if (!empty($data['prefixRedCase']) && !empty($data['redCase']) && !empty($data['redYy'])) {
		$filter .= "AND (T_NO_RED = '" . $data['prefixRedCase'] . "' AND NO_RED_CASE = '" . $data['redCase'] . "' AND RED_YEAR = '" . $data['redYy'] . "')";
	}
	if (!empty($data['brcId'])) {
		$filter .= "AND BRC_ID = '" . $data['brcId'] . "' ";

		$url = connect_bankrupt('CheckCase');
		$form_field['userName'] = 'BankruptDt';
		$form_field['passWord'] = 'Debtor4321';
		$form_field['brcId'] = $data['brcId'];
		$data_string = json_encode($form_field);

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => $data_string,
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json'
			),
		));

		$response = curl_exec($curl);
		$res = json_decode($response, true);
		curl_close($curl);

		if ($res['statusCode'] == '200') {
			foreach ($res['data']['Data'] as $k => $v) {

				$br_prefixBlackCase = $v['prefixBlackCase'];
				$br_blackCase = $v['blackCase'];
				$br_blackYY = $v['blackYY'];
				$br_prefixRedCase = $v['prefixRedCase'];
				$br_redCase = $v['redCase'];
				$br_redYY = $v['redYY'];
			}
		}
	}

	/* start */
	$PAGE_CODE = "BR010102";
	$SYSTEM_TYPE = "2";
	$brcID = $data['brcId'];
	$toPersonId = '222222222222';

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
		$array_check = explode(",", $rec_check_case['NOTE_PERSON']); //แปลงข้อมูล เป็นarray เพื่อเช็คค่า
		if ($rec_check_case['DATA_SEARCH'] == 'ALL') {
			if (in_array("REGISTERCODE", $array_check)) {
				if ($REGISTERCODE != '') { //รหัสบัตรประชาชน
					$link_to_api .= "&REGISTERCODE=" .  $REGISTERCODE;
				}
			}
		} else {
			if (in_array("REGISTERCODE", $array_check)) {
				if ($REGISTERCODE_C1 != '') {
					$link_to_api .= "&REGISTERCODE_C1=" . $REGISTERCODE_C1;
				}
				if ($REGISTERCODE_C2 != '') {
					$link_to_api .= "&REGISTERCODE_C2=" . $REGISTERCODE_C2;
				}
			}
		}
		if (in_array("BLACK_CASE", $array_check)) {
			$link_to_api .= "&T_BLACK_CASE=" . $dataSelectData['PREFIX_BLACK_CASE'] . "&BLACK_CASE=" . $dataSelectData['BLACK_CASE'] . "&BLACK_YY=" . $dataSelectData['BLACK_YY'];
		}
		if (in_array("RED_CASE", $array_check)) {
			$link_to_api .= "&T_RED_CASE=" . $dataSelectData['PREFIX_RED_CASE'] . "&RED_CASE=" . $dataSelectData['RED_CASE'] . "&RED_YY=" . $dataSelectData['RED_YY'];
		}
		if (in_array("COURT_CODE", $array_check)) {
			$link_to_api .= "&COURT_CODE=" . $dataSelectData['COURT_CODE'] . "&COURT_NAME=" . $dataSelectData['COURT_NAME'];
		}

		/* ตรวจคน start -----------------------------------------------------------------------------*/
		$link .= "&brcID=" . $brcID;
		$link .= "&PAGE_CODE=" . $PAGE_CODE;
		$link .= "&TO_PERSON_ID=" . $toPersonId . "&SEND_TO=2";
		$link .= "&DATA_SEARCH=" . $rec_check_case['DATA_SEARCH'];
		//check_person_3 ตรวจคนว่ามีติดในคดีอื่นหรือไม่
		$text = $link_to_api . $link;


		$i = 0;
		//print_r(checkPeople($text));
		foreach (checkPeople($text) as $SH1 => $AA1) {
			foreach ($AA1 as $SH2 => $rec) {
				$obj[$i]['brcId'] = $brcID;
				$obj[$i]['prefixBlackCaseBr'] = $dataSelectData['PREFIX_BLACK_CASE'];
				$obj[$i]['blackCaseBr'] = $dataSelectData['BLACK_CASE'];
				$obj[$i]['blackYyBr'] = $dataSelectData['BLACK_YY'];
				$obj[$i]['prefixRedCaseBr'] = $dataSelectData['PREFIX_RED_CASE'];
				$obj[$i]['redCaseBr'] = $dataSelectData['RED_CASE'];
				$obj[$i]['redYyBr'] = $dataSelectData['RED_YY'];
				$obj[$i]['prefixBlackCase'] = $rec['PREFIX_BLACK_CASE'];
				$obj[$i]['blackCase'] = $rec['BLACK_CASE'];
				$obj[$i]['blackYy'] = $rec['BLACK_YY'];
				$obj[$i]['prefixRedCase'] = $rec['PREFIX_RED_CASE'];
				$obj[$i]['redCase'] = $rec['RED_CASE'];
				$obj[$i]['redYy'] = $rec['RED_YY'];
				$obj[$i]['systemType'] = $rec['SYSTEM_TYPE'];
				$obj[$i]['courtName'] = $rec['COURT_NAME'];
				$obj[$i]['registerCode'] = str_replace('-', '', $rec['REGISTER_CODE']);
				$obj[$i]['fullName'] = $rec['PREFIX_NAME']." ". $rec['FIRST_NAME']." ". $rec['LAST_NAME'];
				$obj[$i]['concernName'] = $rec['CONCERN_NAME'];
				$obj[$i]['personType'] = $rec['CONCERN_CODE'];
				$obj[$i]['address'] = $rec['ADDRESS'];
				$obj[$i]['orderStatus'] = $rec['PER_ORDER_STATUS'];
				$obj[$i]['bankruptCode'] = $rec['BANKRUPT_CODE'];
				$i++;
			}
		}

		/* ตรวจคน stop */
	}
	/* stop */
}
$num = count($obj);

if ($num > 0) {

	$row['ResponseCode'] = array('ResCode' => '000', 'ResMeassage' => "SUCCESS");
	$row['Data'] = $obj;
} else {

	$row['ResponseCode'] = array('ResCode' => '102', 'ResMeassage' => "NOT FOUND");
	// $row['Data'] = $sql;


}



echo json_encode($row);
