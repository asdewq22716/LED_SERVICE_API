<?php
include '../include/include.php';

$url = connect_api_mediate('MediateCmdOfficeApi.php');

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
		//$field['CIVIL_CODE'] 		=  	$data['Data'][$i]['CASE_ENFORCE_ID'];
		$field['COURT_CODE'] 		=  	$data['Data'][$i]['COURT_CODE'];
		$field['COURT_NAME'] 		=  	$data['Data'][$i]['COURT_NAME'];
		$field['DEPT_CODE'] 			=   $data['Data'][$i]['DEP_CODE'];
		$field['DEPT_NAME'] 			=   $data['Data'][$i]['DEP_NAME'];
		$field['PREFIX_BLACK_CASE'] 	= 	$data['Data'][$i]['BLACK_CASE_TITLE'];
		$field['BLACK_CASE'] 		=   $data['Data'][$i]['BLACK_CASE_NO_SHW'];
		$field['BLACK_YY'] 			=   $data['Data'][$i]['YEAR_BLACK'];
		$field['PREFIX_RED_CASE'] 	=   $data['Data'][$i]['RED_CASE_TITLE'];
		$field['RED_CASE'] 			=   $data['Data'][$i]['RED_CASE_NO_SHW'];
		$field['RED_YY'] 			=   $data['Data'][$i]['YEAR_RED'];
		$field['COURT_DATE'] 		=   $data['Data'][$i]['APPOINT_DATE'];
		$field['CAPITAL_AMOUNT'] 	= 	$data['Data'][$i]['CAPITAL_AMOUNT'];
		
		$cp = count($data['Data'][$i]['PLAINTIFF']);
		for($j=1; $j<=$cp; $j++){
			$field['PLAINTIFF'.$j] = $data['Data'][$i]['PLAINTIFF']['PLAINTIFF'.$j];
		}
		
		$cd = count($data['Data'][$i]['DEFFENDANT']);
		for($k=1; $k<=$cd; $k++){
			$field['DEFFENDANT'.$k] = $data['Data'][$i]['DEFFENDANT']['DEFFENDANT'.$k];
		}

		$field['RECORD_COUNT'] 		=   '';
		$field['CMD_OFFICE_LIST'] 	= 	'';
		$field['SEQ'] 				=   '';
		$field['CMD_DATE'] 			=   '';
		$field['OFFICE_IDCARD'] 		=   $data['Data'][$i]['NITIKON_IDCARD'];
		$field['OFFICE_NAME'] 		=   $data['Data'][$i]['NITIKON_NAME'];
		$field['CMD_TYPE_CODE'] 		=   '';
		$field['CMD_TYPE_NAME'] 		=   '';
		$field['CMD_DETAIL'] 		=   '';
		
		// print_pre($field);
		db::db_insert('WH_MEDIATE_CMD_OFFICE', $field,"CMD_ID");
		
    }
	
}
?>
