<?php
include '../include/include.php';

$url = connect_api_mediate('MediateDocApi.php');

$con = curl_init();
curl_setopt($con, CURLOPT_CONNECTTIMEOUT, 120);
curl_setopt($con, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.6 (KHTML, like Gecko) Chrome/16.0.897.0 Safari/535.6");
curl_setopt($con, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
curl_setopt($con, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($con, CURLOPT_HEADER, 0);
curl_setopt($con, CURLOPT_TIMEOUT, 120);

//SERVICE
$ch = $con; 
$form_field['USERNAME'] = 'BankruptDt';// เปลี่ยนเป็นค่าที่จะส่ง
$form_field['PASSWORD'] = 'Debtor4321';// เปลี่ยนเป็นค่าที่จะส่ง

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);

$data_string = json_encode($form_field);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
$data = curl_exec($ch);
$data = json_decode($data, true);



if($data['ResponseCode']['ResCode'] == '000') {	
		
	$loop = count($data['Data']);
	for($i=0;$i < $loop;$i++){
		unset($field);
		$WH_DOCS_ID = db::get_max('WH_MEDIATE_DOC', 'WH_DOCS_ID', $cond = array())+1;
		$field['WH_DOCS_ID'] 		= 	$WH_DOCS_ID;
		//$field['CIVIL_CODE'] 		= 	$data['Data'][$i]['CASE_ENFORCE_ID'];
		$field['COURT_CODE'] 		= 	$data['Data'][$i]['COURT_CODE'];
		$field['COURT_NAME'] 		= 	$data['Data'][$i]['COURT_NAME'];
		$field['PREFIX_BLACKCASE'] 	= 	$data['Data'][$i]['PREFIX_BLACKCASE'];
		$field['BLACK_CASE'] 		= 	$data['Data'][$i]['BLACK_CASE'];
		$field['BLACK_YY'] 			= 	$data['Data'][$i]['BLACK_YY'];
		$field['PREFIX_REDCASE'] 	= 	$data['Data'][$i]['PREFIX_REDCASE'];
		$field['RED_CASE'] 			= 	$data['Data'][$i]['RED_CASE'];
		$field['RED_YY'] 			= 	$data['Data'][$i]['RED_YY'];
		$field['DOC_DATE'] 			= 	$data['Data'][$i]['DOC_DATE'];
		$field['DOC_NAME'] 			= 	$data['Data'][$i]['DOC_NAME'];
		print_pre($field);
		// db2::db_insert('WH_MEDIATE_DOC', $data, $pkSelectMax = "", $outID = "");
	}
}

?>
