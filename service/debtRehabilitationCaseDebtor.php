<?php
include '../include/include.php';

$url = connect_api_revive('DebtRehabilitationCaseDebtorApi.php');

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
print_pre($data);
if($data['ResponseCode']['ResCode'] == '000') {	

		
	$loop = count($data['Data']);
	for($i=0;$i < $loop;$i++){

		unset($field);
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
		$field['PERSON_LIST'] = $obj[$i]['PERSON_LIST'];
		$field['REQ'] = $obj[$i]['REQ'];
		$field['PERSON_CODE'] = $obj[$i]['PERSON_CODE'];
		$field['REGISTER_CODE'] = $obj[$i]['REGISTER_CODE'];
		$field['PREFIX_CODE'] = $obj[$i]['PREFIX_CODE'];
		$field['PREFIX_NAME'] = $obj[$i]['PREFIX_NAME'];
		$field['FIRST_NAME'] = $obj[$i]['FIRST_NAME'];
		$field['LAST_NAME'] = $obj[$i]['LAST_NAME'];
		$field['MONEY_DEBT'] = $obj[$i]['MONEY_DEBT'];
		$field['CONCERN_NO'] = $obj[$i]['CONCERN_NO'];
		$field['ADDRESS'] = $obj[$i]['ADDRESS'];
		$field['TUM_CODE'] = $obj[$i]['TUM_CODE'];
		$field['TUM_NAME'] = $obj[$i]['TUM_NAME'];
		$field['AMP_CODE'] = $obj[$i]['AMP_CODE'];
		$field['AMP_NAME'] = $obj[$i]['AMP_NAME'];
		$field['PROV_CODE'] = $obj[$i]['PROV_CODE'];
		$field['PROV_NAME'] = $obj[$i]['PROV_NAME'];
		$field['ZIP_CODE'] = $obj[$i]['ZIP_CODE'];

		db::db_insert('WH_REHABILITATION_DEBTOR', $field);
		 
	}

}

?>