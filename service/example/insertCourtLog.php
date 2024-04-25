<?php
if($_GET["DATA"]==1){
	$data["CourtDate"] 				= 		'2022-05-24';
	$data["CourtDetail"] 			= 		'ยกเลิกการล้มละลาย';
	$data["ordStatus"] 				= 		'ไม่บังคับคดี';
	$data["prefixBlackCase"] 		= 		'ล';
	$data["blackCase"] 				= 		'1907';
	$data["blackYy"] 				= 		'2565';
	$data["prefixRedCase"] 			= 		'ล';
	$data["redCase"] 				= 		'1908';
	$data["redYy"] 					= 		'2565';
	$data["systemType"] 			= 		'2';
}else if($_GET["DATA"]==2){
	$data["CourtDate"] 				= 		'2022-05-24';
	$data["CourtDetail"] 			= 		'ศาลมีคำสั่งอนุญาตให้ถอนคำร้องขอฟื้นฟูกิจการ';
	$data["ordStatus"] 				= 		'ไม่บังคับคดี';
	$data["prefixBlackCase"] 		= 		'ฟ';
	$data["blackCase"] 				= 		'1905';
	$data["blackYy"] 				= 		'2565';
	$data["prefixRedCase"] 			= 		'ฟ';
	$data["redCase"] 				= 		'1906';
	$data["redYy"] 					= 		'2565';
	$data["systemType"] 			= 		'3';

}





$dataJson = json_encode($data);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://103.208.27.224:81/led_service_api/service/insertCourtLog.php',
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