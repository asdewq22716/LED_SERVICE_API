<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);
$i = 0;

$field = array();
$field['IP_ADDRESS'] = $ip;
$field['DEP_ID'] = $POST['depId'];
$field['REQUEST'] = 'getCourtLog';
$field['LOG_DATE'] = date("Y-m-d");
$field['LOG_TIME'] = date("H:i:s");
$field['USR_ID'] = '';
$field['REQUEST_STATUS'] = '200';
$field['USR_IDCARD'] = $POST['idCard'];
$field['LOG_TYPE'] = '1';
$field['REQUEST_DATA'] = $str_json;

db::db_insert('M_LOG', $field, 'LOG_ID');

$form_field['USERNAME'] 			= 'BankruptDt'; // เปลี่ยนเป็นค่าที่จะส่ง
$form_field['PASSWORD'] 			= 'Debtor4321'; // เปลี่ยนเป็นค่าที่จะส่ง

if ($POST["prefixBlackCase"] != "") {
	$filter .= " and PREFIX_BLACK_CASE = '" . $POST['prefixBlackCase'] . "'	";
}
if ($POST["blackCase"] != "") {
	$filter .= " and BLACK_CASE = '" . $POST['blackCase'] . "'	";
}
if ($POST["blackYy"] != "") {
	$filter .= " and BLACK_YY = '" . $POST['blackYy'] . "'	";
}
if ($POST["prefixRedCase"] != "") {
	$filter .= " and PREFIX_RED_CASE = '" . $POST['prefixRedCase'] . "'	";
}
if ($POST["redCase"] != "") {
	$filter .= " and RED_CASE = '" . $POST['redCase'] . "'	";
}
if ($POST["redYy"] != "") {
	$filter .= " and RED_YY = '" . $POST['redYy'] . "'	";
}
if ($POST["CourtCode"] != "") {
	$filter .= " and COURT_CODE = '" . $POST['CourtCode'] . "'	";
}
if ($POST["systemType"] != "") {
	$filter .= " and COURT_SYSTEM_TYPE = '" . $POST['systemType'] . "'	";
}
if ($POST["registerCode"] != "") {
	$filter .= " and COURT_REGISTER_CODE = '" . $POST['registerCode'] . "'	";
}

if ($filter != "") {
	$sqlSelectData = "	SELECT 		PREFIX_BLACK_CASE,BLACK_CASE,BLACK_YY,PREFIX_RED_CASE,RED_CASE,RED_YY,to_char(COURT_DATE, 'YYYY-MM-DD') as COURT_DATE,COURT_DETAIL,ORD_STATUS,ANN_BOOK_NO,ANN_LESSON_NO,ANN_PAGE_NO,ANN_NEWSPAPER_DATE,NEW_NAME,ANN_GAZETTE_DATE
						FROM 		WH_COURT_LOG 
						WHERE 		1=1 {$filter}
						AND COURT_DETAIL IS NOT NULL
						GROUP BY 
							PREFIX_BLACK_CASE,
							BLACK_CASE,
							BLACK_YY,
							PREFIX_RED_CASE,
							RED_CASE,
							RED_YY,
							COURT_DATE,
							COURT_DETAIL,
							ORD_STATUS,
							ANN_BOOK_NO,
							ANN_LESSON_NO,
							ANN_PAGE_NO,
							ANN_NEWSPAPER_DATE,
							NEW_NAME,
							ANN_GAZETTE_DATE
						ORDER BY
							COURT_DATE  ASC
						--ORDER BY 	WH_COURT_LOG_ID asc
						";


	$querySelectData = db::query($sqlSelectData);
	while ($dataSelectData = db::fetch_array($querySelectData)) {
		$obj[$i]['prefixBlackCase'] 		= $dataSelectData['PREFIX_BLACK_CASE'];
		$obj[$i]['blackCase'] 				= $dataSelectData['BLACK_CASE'];
		$obj[$i]['blackYy'] 				= $dataSelectData['BLACK_YY'];
		$obj[$i]['prefixRedCase'] 			= $dataSelectData['PREFIX_RED_CASE'];
		$obj[$i]['redCase'] 				= $dataSelectData['RED_CASE'];
		$obj[$i]['redYy'] 					= $dataSelectData['RED_YY'];

		$obj[$i]['CourtDate'] 				= $dataSelectData['COURT_DATE'];
		$obj[$i]['CourtDetail'] 			= $dataSelectData['COURT_DETAIL'];
		$obj[$i]['ordStatus'] 				= $dataSelectData['ORD_STATUS'];

		$obj[$i]['annBookNo'] 				= $dataSelectData['ANN_BOOK_NO'];
		$obj[$i]['annLessonNo'] 			= $dataSelectData['ANN_LESSON_NO'];
		$obj[$i]['annPageNo'] 				= $dataSelectData['ANN_PAGE_NO'];
		$obj[$i]['newsDate'] 				= $dataSelectData['ANN_NEWSPAPER_DATE'];
		$obj[$i]['newsName'] 				= $dataSelectData['NEW_NAME'];
		$obj[$i]['annDate'] 				= $dataSelectData['ANN_GAZETTE_DATE'];

		$i++;
	}
}
$num = count($obj);

if ($num > 0) {

	$row['ResponseCode'] = array('ResCode' => '000', 'ResMeassage' => "SUCCESS");
	$row['Data'] = $obj;

	$data = $row;
} else {

	$row['ResponseCode'] = array('ResCode' => '102', 'ResMeassage' => "NOT FOUND");
	$data = $row;
}

echo json_encode($data);
