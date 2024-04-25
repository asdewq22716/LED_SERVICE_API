<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$res = json_decode($str_json, true);

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
	$field['REQUEST'] 			= 'updateSellerBackoffice';
	$field['LOG_DATE'] 			= date("Y-m-d");
	$field['LOG_TIME'] 			= date("H:i:s");
	$field['USR_ID'] 			= '' ;
	$field['REQUEST_STATUS'] 	= '200';
	$field['USR_IDCARD'] 		= $POST['idCard'];
	$field['LOG_TYPE'] 			= '1' ;
$LOG_ID = db::db_insert('M_LOG', $field, 'LOG_ID','LOG_ID');

db::db_delete("WH_SELLER",array('WH_VENDOR_ID'=>$res["id"]));

unset($fields);
	$fields["WH_SELLER_ID_CARD"] 	= $res["code"];
	$fields["WH_SELLER_FNAME"] 		= $res["fname"];
	$fields["WH_VENDOR_ID"] 		= $res["id"];
db::db_insert("WH_SELLER",$fields,'WH_SELLER_ID','WH_SELLER_ID');

?>