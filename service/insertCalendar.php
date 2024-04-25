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
$res      = json_decode($str_json, true);

$MEETING_ID = "";

/* เก็บ log start */
$array_link = "";
foreach (json_decode($str_json, true) as $sh1 => $ch1) {
	$array_link .= "&" . $sh1 . "=" . $ch1;
}
unset($fields);
$fields["PAGE_CODE"]                 =    "insertCalendar";
$fields["COLUMN1"]                 =     $array_link;
$fields["CREATE_DATE"]                 =    date("Y-m-d");
$fields["SYSTEM_TYPE"]                 =  $res['SYSTEM_TYPE'];
db::db_insert("TEST_DATA_RES", $fields, 'PK_ID', 'PK_ID');
/* เก็บ log stop *//* 
function cut_prefix($fullname)
{
	$fullNameArray = explode(" ", $fullname);
	$sql = "SELECT a.PREFIX_NAME FROM WH_BACKOFFICE_PERSON a WHERE a.PREFIX_NAME IS NOT NULL GROUP BY a.PREFIX_NAME";
	$qry = db::query($sql);
	$array_prefix = array();
	while ($rec = db::fetch_array($qry)) {
		$array_prefix[] = $rec['PREFIX_NAME'];
	}
	$array_prefix[] = "สาว";
	//return $array_prefix;
	foreach ($array_prefix as $key => $value) {
		//return $value;
		if (strpos($fullNameArray[0], $value) !== false) {
			// ใช้ str_replace เพื่อลบคำนำหน้า
			$fullNameArray[0] = str_replace($value, "", $fullNameArray[0]);
		}
	}
	$sql_idcard = "  SELECT a.REGISTER_CODE FROM WH_BACKOFFICE_PERSON a WHERE a.FIRST_NAME ='" . $fullNameArray[0] . "' AND a.LAST_NAME ='" . $fullNameArray[1] . "'";
	$qry_idcard = db::query($sql_idcard);
	$rec = db::fetch_array($qry_idcard);
	return $rec['REGISTER_CODE'];
}
//(cut_prefix('นางสาวกชพร รุ่งทวีชัย')); */

if ($res['SYSTEM_TYPE'] == '4') { //ไกลีเกลี่ย
	db::db_delete("M_MEETING", array('F_ID' => $res['F_ID'], 'SYSTEM_ID' => $res['SYSTEM_TYPE']));
	unset($field);
	$field["F_ID"] 	= $res['F_ID']; //F_ID
	$field["MEETING_TOPIC"] 	= $res['MEETING_TOPIC']; //หัวข้อเรื่อง
	$field["MEETING_DETAIL"] 	= $res['MEETING_DETAIL']; //รายละเอียด
	$field["MEETING_SDATE"] 	= date_AK($res['MEETING_SDATE']); //วันที่เริ่ม
	$field["MEETING_SDATE_TIME"] 	= $res['MEETING_SDATE_TIME']; //เวลาที่เลือก
	$field["CREATE_BY_ID_CARD"] 	= $res['CREATE_BY_ID_CARD']; //13หลักของผู้สร้างข้อมูล
	$field["CREATE_BY_NAME"] 	= $res['CREATE_BY_NAME']; //ชื่อผู้สร้าง
	$field["CREATE_DATE"] 	= $res['CREATE_DATE']; //วันที่สรา้ง
	$field["CREATE_DATE_TIME"] 	= $res['CREATE_DATE_TIME']; //เวลาที่สร้าง
	$field["MEETING_LOCATION"] 	= $res['MEETING_LOCATION']; //สถานที่นัดหมาย
	$field["APP_PERSON_NAME"] = $res['CREATE_BY_NAME'];
	$field["APP_PERSON_IDCARD"]= $res['CREATE_BY_ID_CARD'];
	//$field["APP_PERSON_NAME"] 	= $res['APP_PERSON_NAME']; //ชื่อของผู้ถูกนัด
	//$field["APP_PERSON_IDCARD"] 	= func::convert_idcode($res['APP_PERSON_IDCARD']); //13หลักของผู้ถูกนัด
	$field["SYSTEM_ID"] 	= $res['SYSTEM_TYPE']; //นัดหมายจากระบบ
	$field["CODE_API"] 	= $res['WFR_ID'] . "W" . $res['W']; //CODE_API
	$field["UPDATE_DATE"] 	= $res['CREATE_DATE']; //วันที่อัพเดท
	$field["UPDATE_DATE_TIME"] 	= $res['CREATE_DATE_TIME']; //เวลาที่อัพเดท
	$MEETING_ID = db::db_insert("M_MEETING", $field, 'MEETING_ID', 'MEETING_ID');
}
if ($res['SYSTEM_TYPE'] == '3') { //ฟื้นฟู
	db::db_delete("M_MEETING", array('F_ID' => $res['F_ID'], 'SYSTEM_ID' => $res['SYSTEM_TYPE']));
	unset($field);
	$field["F_ID"] 	= $res['F_ID']; //F_ID
	$field["MEETING_TOPIC"] 	= $res['MEETING_TOPIC']; //หัวข้อเรื่อง
	$field["MEETING_DETAIL"] 	= $res['MEETING_DETAIL']; //รายละเอียด
	$field["MEETING_SDATE"] 	= ($res['MEETING_SDATE']); //วันที่เริ่ม
	$field["MEETING_SDATE_TIME"] 	= $res['MEETING_SDATE_TIME']; //เวลาที่เลือก
	$field["CREATE_BY_ID_CARD"] 	= cut_prefix($res['CREATE_BY_NAME']); //13หลักของผู้สร้างข้อมูล
	$field["CREATE_BY_NAME"] 	= $res['CREATE_BY_NAME']; //ชื่อผู้สร้าง
	$field["CREATE_DATE"] 	= $res['CREATE_DATE']; //วันที่สรา้ง
	$field["CREATE_DATE_TIME"] 	= $res['CREATE_DATE_TIME']; //เวลาที่สร้าง
	$field["MEETING_LOCATION"] 	= $res['MEETING_LOCATION']; //สถานที่นัดหมาย
	$field["APP_PERSON_NAME"] 	= $res['CREATE_BY_NAME']; //ชื่อของผู้ถูกนัด
	//$field["APP_PERSON_NAME"] 	= $res['APP_PERSON_NAME']; //ชื่อของผู้ถูกนัด
	//$field["APP_PERSON_IDCARD"] 	= func::convert_idcode($res['APP_PERSON_IDCARD']); //13หลักของผู้ถูกนัด
	//$field["APP_PERSON_IDCARD"] 	= cut_prefix($res['APP_PERSON_NAME']); //13หลักของผู้ถูกนัด
	$field["APP_PERSON_IDCARD"] 	= cut_prefix($res['CREATE_BY_NAME']); //13หลักของผู้ถูกนัด
	$field["SYSTEM_ID"] 	= $res['SYSTEM_TYPE']; //นัดหมายจากระบบ
	//$field["CODE_API"] 	= $res['WFR_ID'] . "W" . $res['W']; //CODE_API
	$field["CODE_API"] 	= $res['WFR_ID'];
	$field["UPDATE_DATE"] 	= $res['CREATE_DATE']; //วันที่อัพเดท
	$field["UPDATE_DATE_TIME"] 	= $res['CREATE_DATE_TIME']; //เวลาที่อัพเดท
	$MEETING_ID = db::db_insert("M_MEETING", $field, 'MEETING_ID', 'MEETING_ID');
}

if ($MEETING_ID != '') {
	$row['ResponseCode'] = array(
		'ResCode' => '000',
		'ResMeassage' => "SUCCESS",
		'field' => $field,
		'res' => $res
	);
} else {

	$row['ResponseCode'] = array(
		'ResCode' => '102',
		'ResMeassage' => "NOT FOUND"
	);
}

echo json_encode($row);
