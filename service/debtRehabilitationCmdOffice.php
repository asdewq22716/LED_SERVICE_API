<?php
include '../include/include.php';

$url = connect_api_revive('DebtRehabilitationCmdOfficeApi.php');

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
		$field['CIVIL_CODE'] = $obj[$i]['CIVIL_CODE'];
		$field['COURT_CODE'] = $obj[$i]['COURT_CODE'];
		$field['COURT_NAME'] = $obj[$i]['COURT_NAME'];
		$field['DEPT_CODE'] = $obj[$i]['DEPT_CODE'];
		$field['DEPT_NAME'] = $obj[$i]['DEPT_NAME'];
		$field['PREFIX_BLACK_CASE'] = $obj[$i]['PREFIX_BLACK_CASE'];
		$field['BLACK_CASE'] = $obj[$i]['BLACK_CASE'];
		$field['BLACK_YY'] = $obj[$i]['BLACK_YY'];
		$field['PREFIX_RED_CASE'] = $obj[$i]['PREFIX_RED_CASE'];
		$field['RED_CASE'] = $obj[$i]['RED_CASE'];
		$field['RED_YY'] = $obj[$i]['RED_YY'];
		$field['CMD_DATE'] = $obj[$i]['CMD_DATE'];
		$field['OFFICE_IDCARD'] = $obj[$i]['OFFICE_IDCARD'];
		$field['OFFICE_NAME'] = $obj[$i]['OFFICE_NAME'];
		$field['CMD_TYPE_CODE'] = $obj[$i]['CMD_TYPE_CODE'];
		$field['CMD_TYPE_NAME'] = $obj[$i]['CMD_TYPE_NAME'];
		$field['CMD_DETAIL'] = $obj[$i]['CMD_DETAIL'];		

		db::db_insert('WH_REHABILITATION_CMD_OFFICE', $field);
		 
	}

}

?>