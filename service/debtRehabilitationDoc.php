<?php
include '../include/include.php';

$url = connect_api_revive('DebtRehabilitationDocApi.php');

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
		$field['WH_DOCS_ID'] = $obj[$i]['WH_DOCS_ID'];
		$field['COURT_CODE'] = $obj[$i]['COURT_CODE'];
		$field['COURT_NAME'] = $obj[$i]['COURT_NAME'];
		$field['DEPT_CODE'] = $obj[$i]['DEPT_CODE'];
		$field['DEPT_NAME'] = $obj[$i]['DEPT_NAME'];
		$field['PREFIX_BLACKCASE'] = $obj[$i]['PREFIX_BLACKCASE'];
		$field['BLACK_CASE'] = $obj[$i]['BLACK_CASE'];
		$field['BLACK_YY'] = $obj[$i]['BLACK_YY'];
		$field['PREFIX_REDCASE'] = $obj[$i]['PREFIX_REDCASE'];
		$field['RED_CASE'] = $obj[$i]['RED_CASE'];
		$field['RED_YY'] = $obj[$i]['RED_YY'];
		$field['COURT_DATE'] = $obj[$i]['COURT_DATE'];
		$field['CAPITAL_AMOUNT'] = $obj[$i]['CAPITAL_AMOUNT'];
		$field['RECORD_COUNT'] = $obj[$i]['RECORD_COUNT'];
		$field['COURTDOC_LIST'] = $obj[$i]['COURTDOC_LIST'];
		$field['SEQ'] = $obj[$i]['SEQ'];
		$field['DOC_DATE'] = $obj[$i]['DOC_DATE'];
		$field['DOC_NAME'] = $obj[$i]['DOC_NAME'];
		$field['DOC_FILE'] = $obj[$i]['DOC_FILE'];		

		db::db_insert('WH_REHABILITATION_DOCS', $field);
		 
	}

}

?>