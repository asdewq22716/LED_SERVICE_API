<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);
$i=0;

$field = array();
	$field['IP_ADDRESS'] = $ip ;
	$field['DEP_ID'] = $POST['depId'];
	$field['REQUEST'] = 'insertCourtLog';
	$field['LOG_DATE'] = date("Y-m-d");
	$field['LOG_TIME'] = date("H:i:s");
	$field['USR_ID'] = '' ;
	$field['REQUEST_STATUS'] = '200';
	$field['USR_IDCARD'] = $POST['idCard'];
	$field['LOG_TYPE'] = '1' ;
	$field['REQUEST_DATA'] = $str_json;
$LOG_ID = db::db_insert('M_LOG', $field, 'LOG_ID','LOG_ID');

if($POST["ordId"]>0){
	db::db_delete("WH_COURT_LOG",array('COURT_SYSTEM_TYPE'=>3,"PREFIX_BLACK_CASE"=>$POST["prefixBlackCase"],"BLACK_CASE"=>$POST["blackCase"],"BLACK_YY"=>$POST["blackYy"],"ORG_ID"=>$POST["ordId"]));
}

unset($fields);
	$fields["COURT_DATE"] 				= 	(trim($POST["CourtDate"])=="")?date('Y-m-d'):$POST["CourtDate"];
	$fields["COURT_DETAIL"] 			= 	$POST["CourtDetail"];
	$fields["ORD_STATUS"] 				= 	$POST["ordStatus"];
	
	$fields["PREFIX_BLACK_CASE"] 		= 	$POST["prefixBlackCase"];
	$fields["BLACK_CASE"] 				= 	$POST["blackCase"];
	$fields["BLACK_YY"] 				= 	$POST["blackYy"];
	$fields["PREFIX_RED_CASE"] 			= 	$POST["prefixRedCase"];
	$fields["RED_CASE"] 				= 	$POST["redCase"];
	$fields["RED_YY"] 					= 	$POST["redYy"];
	$fields["COURT_SYSTEM_TYPE"] 		= 	$POST["systemType"];
	$fields["ORG_ID"] 					= 	$POST["ordId"];
	$fields["COURT_REGISTER_CODE"] 		= 	$POST["courtRegisterCode"];
	
db::db_insert("WH_COURT_LOG",$fields,'WH_COURT_LOG_ID','WH_COURT_LOG_ID');

?>
