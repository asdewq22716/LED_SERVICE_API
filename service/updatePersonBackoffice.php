<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$res = json_decode($str_json, true);

$REQUEST_DATA = "";
foreach($res as $key => $val){
	$REQUEST_DATA .= $key."=".$val."\n\r";
}


if ($res['ip'])
{
    $ip = $res['ip'];
}
else
{
    $ip = get_client_ip();
}

$field = array();
	$field['IP_ADDRESS'] 		= $ip ;
	$field['DEP_ID'] 			= $POST['depId'];
	$field['REQUEST'] 			= 'updatePersonBackoffice';
	$field['LOG_DATE'] 			= date("Y-m-d");
	$field['LOG_TIME'] 			= date("H:i:s");
	$field['USR_ID'] 			= '' ;
	$field['REQUEST_STATUS'] 	= '200';
	$field['USR_IDCARD'] 		= $POST['idCard'];
	$field['LOG_TYPE'] 			= '1' ;
$LOG_ID = db::db_insert('M_LOG', $field, 'LOG_ID','LOG_ID');


db::db_delete("WH_BACKOFFICE_PERSON",array('PER_ID'=>$res["id"]));

unset($fields);
	$fields["REGISTER_CODE"] 		= $res["code"];
	$fields["PREFIX_NAME"] 			= $res["title"];
	$fields["FIRST_NAME"] 			= $res["fname"];
	$fields["LAST_NAME"] 			= $res["lname"];
	$fields["LINE_NAME"] 			= $res["position"];
	$fields["ORG_NAME"] 			= $res["department"];
	$fields["ORG_ID"] 				= $res["departmentId"];
	$fields["LINE_ID"] 				= $res["positionId"];
	$fields["PER_ID"] 				= $res["id"];
	$fields["PER_STATUS_CIVIL"] 	= $res["status"];
db::db_insert("WH_BACKOFFICE_PERSON",$fields,'WH_PERSON_ID','WH_PERSON_ID');

?>