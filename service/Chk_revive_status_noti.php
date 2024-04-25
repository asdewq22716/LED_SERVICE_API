<?php
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	header('Access-Control-Allow-Origin: *');
	header('Cache-Control: no-cache');
	header('Access-Control-Max-Age: 1728000');
	header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
	header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Access-Control-Request-Private-Network');
	header('Access-Control-Allow-Private-Network: true');
	die();
}

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include '../include/include.php';
include '../include/func_Nop.php';
include './check_case_Function.php';


$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);


/* ข้อมูลรับเข้า */
$PAGE_CODE = '000001';
$registerCode = $POST['registerCode'];
$systemType = $POST['systemType'];
$orderId = $POST['orderId'];
$orderName = $POST['orderName'];
$WFR_API = $POST['wfr_id'];
$TO_PERSON_ID = $POST['toPersonId'];

/* เก็บ log start */
$array_link = "";
foreach (json_decode($str_json, true) as $sh1 => $ch1) {
	$array_link .= "&" . $sh1 . "=" . $ch1;
}
unset($fields);
$fields["PAGE_CODE"]                 =    $PAGE_CODE;
$fields["COLUMN1"]                 =     $array_link;
$fields["CREATE_DATE"]                 =    date("Y-m-d");
$fields["SYSTEM_TYPE"]                 =   "3";
db::db_insert("TEST_DATA_RES", $fields, 'PK_ID', 'PK_ID');
/* เก็บ log stop */


$text = "";
$text .= "&REGISTERCODE=" . $registerCode;
$text .= "&WFR_API=" . $WFR_API;
$text .= "&TO_PERSON_ID=" . $TO_PERSON_ID;
$text .= "&PAGE_CODE=" . $PAGE_CODE;
$text .= "&SEND_TO=3";
$text .= "&DATA_SEARCH=ALL";
$sql_check_case = "SELECT *FROM M_CHECK_CASE_REVIVE  a WHERE a.PAGE_CODE='" . $PAGE_CODE . "'";
$queryWH_page = db::query($sql_check_case);
$rec_page = db::fetch_array($queryWH_page);

if ($rec_page['INFORMATION_API'] == 'OPEN') {
	$dataSet["WFR"] = $WFR_API;
	getReviveToWh($dataSet, "");
}
if ($rec_page['STATUS_BUTTON'] == 'N') { //N คือปิดการใช้
	exit;
}
//print_r_pre(checkPeople($text));
/* $A= revive::CaseInformation("3",$WFR_API,$orderId,$orderName); */
(revive::AlertCourtOrder('3', $text, $WFR_API, $TO_PERSON_ID, $orderId, $orderName,$registerCode)); //เรียกใช้การเเจ้งเตือน

$num = 1;
if ($num > 0) {
	$row['ResponseCode'] = array('ResCode' => '000', 'ResMeassage' => "SUCCESS");
	$row['Btns'] = $obj;
}
echo json_encode($row);
