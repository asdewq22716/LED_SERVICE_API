<?php
$data["systemType"] 			= 		'4';
$data["prefixBlackCase"] 		= 		'ผบ';
$data["blackCase"] 				= 		'1240';
$data["blackYy"] 				= 		'2565';
$data["prefixRedCase"] 			= 		'ผบ';
$data["redCase"] 				= 		'1241';
$data["redYy"] 					= 		'2565';
$data["userIdCard"] 			= 		'1212121212121';
$data["userName"] 				= 		'ทดสอบ ทดสอบ';
$data["workDate"] 				= 		'2022-05-23';
$data["workTime"] 				= 		'20:13';
$data["stepRef"] 				= 		'1';

$dataJson = json_encode($data);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://103.208.27.224:81/led_service_api/service/insertWorkLoad.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$dataJson,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

echo $response = curl_exec($curl);

curl_close($curl);

?>