<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$res      = json_decode($str_json, true);

$field = array();
$field['IP_ADDRESS'] = $ip;
$field['DEP_ID'] = $POST['depId'];
$field['REQUEST'] = 'insertTaskBackoffice2';
$field['LOG_DATE'] = date("Y-m-d");
$field['LOG_TIME'] = date("H:i:s");
$field['USR_ID'] = '';
$field['REQUEST_STATUS'] = '200';
$field['USR_IDCARD'] = $POST['idCard'];
$field['LOG_TYPE'] = '1';
//$field['REQUEST_DATA'] = $str_json;

db::db_insert('M_LOG', $field, 'LOG_ID');


$row = array();
if ($request['meetingType'] == '') {
	$meetingType = '5';
} else {
	$meetingType = $request['meetingType'];
}
if ($res['userName'] == 'BankruptDt' && $res['passWord'] == 'Debtor4321') {
	$request['userName']	  	= $res['userName'];
	$request['passWord'] 	  	= $res['passWord'];
	$request['meetingType']     = $meetingType;
	$request['meetingTopic']    = $res['meetingTopic'];
	$request['meetingLocation'] = $res['meetingLocation'];
	// $request['meetingSdate']  	= $res['appointSDate'];
	$request['meetingSdate']  	= $res['appointEDate'];
	$request['meetingEdate']   	= $res['appointEDate'];
	$request['meetingDetail'] 	= $res['meetingDetail'];
	$request['idCard'] 		 	= $res['idCard'];


	unset($fields);
	$fields["WH_CALENDAR_START_DATE"] 	= $res['appointEDate'];
	$fields["WH_CALENDAR_START_TIME"] 	= '';
	$fields["WH_CALENDAR_END_DATE"] 	= $res['appointEDate'];
	$fields["WH_CALENDAR_END_TIME"] 	= '';
	$fields["WH_CALENDAR_TOPIC"] 		= $res['meetingTopic'];
	$fields["WH_CALENDAR_PLACE"] 		= $res['meetingLocation'];
	$fields["WH_CALENDAR_DETAIL"] 		= $res['meetingDetail'];
	$fields["WH_CALENDAR_USER"] 		= $res['idCard'];
	$fields["WH_MEETING_TYPE"] 			= $meetingType;
	$WH_CALENDAR_ID = db::db_insert('WH_CALENDAR', $fields, 'WH_CALENDAR_ID', 'WH_CALENDAR_ID');


	if ($res['SYSTEM_TYPE'] != 3) {
		/* start AK */
		unset($field);
		$field["MEETING_TOPIC"] 	= $res['meetingTopic']; //หัวข้อเรื่อง
		$field["MEETING_DETAIL"] 	= $res['meetingDetail']; //รายละเอียด
		$field["MEETING_SDATE"] 	= $res['appointEDate']; //วันที่เริ่ม
		$field["MEETING_SDATE_TIME"] 	= ""; //เวลาที่เริ่ม
		$field["CREATE_BY_ID_CARD"] 	= ""; //13หลักของผู้สร้างข้อมูล
		$field["CREATE_BY_NAME"] 	= ""; //ชื่อผู้สร้าง
		$field["CREATE_DATE"] 	= $res['appointEDate']; //วันที่สรา้ง
		$field["CREATE_DATE_TIME"] 	= ""; //เวลาที่สร้าง
		$field["MEETING_LOCATION"] 	= $res['meetingLocation']; //สถานที่นัดหมาย
		$field["APP_PERSON_NAME"] 	= ""; //ชื่อของผู้ถูกนัด
		$field["APP_PERSON_IDCARD"] 	= $res['idCard']; //13หลักของผู้ถูกนัด
		$field["MEETING_TYPE"] 	= $meetingType; //ชนิดการนัดหมาย
		$field["SYSTEM_ID"] 	= ""; //นัดหมายจากระบบ 
		$MEETING_ID = db::db_insert("M_MEETING", $field, 'MEETING_ID', 'MEETING_ID');
		/* stop AK */
	}
	if ($res["pccDossControlGen"] != "") { //กรณีมาจากระบบแพ่ง ต้องนัดเข้าของสำนวนอัตโนมัติ
		$sqlSelectDosOwner	 	= "	select  DOSS_OWNER_ID
									from 	WH_CIVIL_DOSS
									where 	DOSS_CONTROL_GEN = '" . $res["pccDossControlGen"] . "'";
		$querySelectDosOwner 	= db::query($sqlSelectDosOwner);
		$recSelectDosOwner 	 	= db::fetch_array($querySelectDosOwner);
		if ($recSelectDosOwner['DOSS_OWNER_ID'] != $res['idCard']) {
			unset($fields);
			$fields["WH_CALENDAR_START_DATE"] 	= $res['appointEDate'];
			$fields["WH_CALENDAR_START_TIME"] 	= '';
			$fields["WH_CALENDAR_END_DATE"] 	= $res['appointEDate'];
			$fields["WH_CALENDAR_END_TIME"] 	= '';
			$fields["WH_CALENDAR_TOPIC"] 		= $res['meetingTopic'];
			$fields["WH_CALENDAR_PLACE"] 		= $res['meetingLocation'];
			$fields["WH_CALENDAR_DETAIL"] 		= $res['meetingDetail'];
			$fields["WH_CALENDAR_USER"] 		= $recSelectDosOwner['DOSS_OWNER_ID'];
			$fields["WH_MEETING_TYPE"] 			= $meetingType;
			$WH_CALENDAR_ID = db::db_insert('WH_CALENDAR', $fields, 'WH_CALENDAR_ID', 'WH_CALENDAR_ID');

			if ($res['SYSTEM_TYPE'] != 3) {
				/* start AK */
				unset($field);
				$field["MEETING_TOPIC"] 	= $res['meetingTopic']; //หัวข้อเรื่อง
				$field["MEETING_DETAIL"] 	= $res['meetingDetail']; //รายละเอียด
				$field["MEETING_SDATE"] 	= $res['appointEDate']; //วันที่เริ่ม
				$field["MEETING_SDATE_TIME"] 	= ""; //เวลาที่เริ่ม
				$field["CREATE_BY_ID_CARD"] 	= ""; //13หลักของผู้สร้างข้อมูล
				$field["CREATE_BY_NAME"] 	= ""; //ชื่อผู้สร้าง
				$field["CREATE_DATE"] 	= $res['appointEDate']; //วันที่สรา้ง
				$field["CREATE_DATE_TIME"] 	= ""; //เวลาที่สร้าง
				$field["MEETING_LOCATION"] 	= $res['meetingLocation']; //สถานที่นัดหมาย
				$field["APP_PERSON_NAME"] 	= ""; //ชื่อของผู้ถูกนัด
				$field["APP_PERSON_IDCARD"] 	= $recSelectDosOwner['DOSS_OWNER_ID']; //13หลักของผู้ถูกนัด
				$field["MEETING_TYPE"] 	= $meetingType; //ชนิดการนัดหมาย
				$field["SYSTEM_ID"] 	= ""; //นัดหมายจากระบบ 
				$MEETING_ID = db::db_insert("M_MEETING", $field, 'MEETING_ID', 'MEETING_ID');
				/* stop AK */
			}
		}
	}
}

// $url  = connect_api_backoffice('insertTaskApi2.php');
// $data = curl($url, $request);

if ($WH_CALENDAR_ID > 0) {

	$row['ResponseCode'] = array(
		'ResCode' => '000',
		'ResMeassage' => "SUCCESS"
	);
} else {

	$row['ResponseCode'] = array(
		'ResCode' => '102',
		'ResMeassage' => "NOT FOUND"
	);
}

echo json_encode($row);
