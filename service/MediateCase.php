<?php
include '../include/include.php';

$url = connect_api_mediate('MediateCaseApi.php');

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
		$field['REF_MEDIATE_ID'] 	= 	$data['Data'][$i]['REF_MEDIATE_ID'];
		$field['RECEIVE_DATE'] 		= 	$data['Data'][$i]['RECEIVE_DATE'];
		$field['REQ_FNAME'] 			= 	$data['Data'][$i]['REQ_FNAME']; // ผู้ร้อง
		$field['PLAINTIFF_FNAME'] 	= 	$data['Data'][$i]['PLAINTIFF_FNAME']; // โจทก์
		$field['DEFENDANT_FNAME'] 	= 	$data['Data'][$i]['DEFENDANT_FNAME']; // จำเลย
		$field['COURT_ID'] 			= 	$data['Data'][$i]['COURT_ID'];
		$field['COURT_NAME'] 		= 	$data['Data'][$i]['COURT_NAME'];
		$field['CHANNEL_ID'] 		= 	$data['Data'][$i]['CHANNEL_ID'];
		$field['CHANNEL_NAME'] 		= 	$data['Data'][$i]['CHANNEL_NAME'];
		$field['TYPE_MEDIATE_ID'] 	= 	$data['Data'][$i]['TYPE_MEDIATE_ID'];
		$field['TYPE_MEDIATE_NAME'] = 	$data['Data'][$i]['TYPE_MEDIATE_NAME'];
		// $field['TYPE_MEDIATE_ID'] 	= 	$data['Data'][$i]['TYPE_MEDIATE_ID'];
		// $field['TYPE_MEDIATE_NAME'] 	= 	$data['Data'][$i]['TYPE_MEDIATE_NAME'];
		$field['PREFIX_BLACK_CASE'] 	= 	$data['Data'][$i]['PrefixBlackCase'];
		$field['BLACK_CASE'] 			= 	$data['Data'][$i]['BlackCase'];
		$field['BLACK_YY'] 			= 	$data['Data'][$i]['BlackYY'];
		$field['PREFIX_RED_CASE'] 		= 	$data['Data'][$i]['PrefixRedCase'];
		$field['RED_CASE'] 			= 	$data['Data'][$i]['RedCase'];
		$field['RED_YY'] 				= 	$data['Data'][$i]['RedYY'];

		db::db_insert('WH_MEDIATE_CASE', $field,'WH_MEDAITE_ID');
		// print_pre($field);
		
	}
}


?>
