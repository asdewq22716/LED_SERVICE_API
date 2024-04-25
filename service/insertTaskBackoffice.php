<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$res      = json_decode($str_json, true);

$field = array();
$field['IP_ADDRESS'] = $ip ;
$field['DEP_ID'] = $POST['depId'];
$field['REQUEST'] = 'insertTaskBackoffice';
$field['LOG_DATE'] = date("Y-m-d");
$field['LOG_TIME'] = date("H:i:s");
$field['USR_ID'] = '' ;
$field['REQUEST_STATUS'] = '200';
$field['USR_IDCARD'] = $POST['idCard'];
$field['LOG_TYPE'] = '1' ;
$field['REQUEST_DATA'] = $str_json;

db::db_insert('M_LOG',$field,'LOG_ID');	



$request['userName']	  = 'BankruptDt';
$request['passWord'] 	  = 'Debtor4321';
$request['wfrId']         = $res['WFR_ID'];
$request['idCard']        = $res['ID_CARD'];
$request['mediateNo']     = $res['MEDIATE_NO'];
$request['depId']         = $res['DEP_ID'];
$request['appointPlace']  = $res['APPOINT_PLACE'];
$request['mediatorName']  = $res['MEDIATOR_ID'];
$request['appointDate']   = $res['APPOINT_DATE'];
$request['appointTime']   = $res['APPOINT_TIME'];
$request['meetingDetail'] = $res['DETAIL'];
$request['meetingType']   = $res['meetingType'];
// $url  = connect_api_backoffice('insertTaskApi.php');
// $data = curl($url, $request);


unset($field);
	$field["WH_CALENDAR_START_DATE"] 	= $res['APPOINT_DATE'];
	$field["WH_CALENDAR_USER"] 			= $res['ID_CARD'];
	$field["WH_CALENDAR_TOPIC"] 		= 'นัดหมายไกล่เกลี่ย';
	$field["WH_CALENDAR_PLACE"] 		= $res['APPOINT_PLACE'];
	$field["WH_CALENDAR_DETAIL"] 		= $res['DETAIL'];
	$field["WH_CALENDAR_END_DATE"] 		= $res['APPOINT_DATE'];
	$field["WH_CALENDAR_START_TIME"] 	= $res['APPOINT_TIME'];
	$field["WH_CALENDAR_END_TIME"] 		= $res['APPOINT_TIME'];
	$field["WH_MEETING_TYPE"] 			= $res['meetingType'];
db::db_insert("WH_CALENDAR",$field,'WH_CALENDAR_ID','WH_CALENDAR_ID');

$data = 1;

if ($data > 0) {
    
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

?>