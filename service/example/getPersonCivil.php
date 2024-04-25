<?php
/*
##### Request #####
registerCode : เลข 13 หลัก 
registerCode2 : เลข 13 หลัก  (จำเลย)
concernCode : xx
##### Request #####
กรณีที่ต้องการสถานะเดียวของคนเดียวให้ค่า registerCode มาพร้อมกับ concernCode
*/

$curl = curl_init();

$arrData = array();
if($_GET["registerCode"]!=""){
	$arrData["registerCode"] = $_GET["registerCode"];
}else{
	$arrData["registerCode"] = '0135558001347';
}
if($_GET["registerCode2"]!=""){
	$arrData["registerCode2"] = $_GET["registerCode2"];
}
if($_GET["concernCode"]!=""){
	$arrData["concernCode"] = $_GET["concernCode"];
}
$arrData["systemType"] = 2;
$arrData["registerCode"] = '0135558001347';
//$arrData["registerCode2"] = '0113550002431';
//$arrData["concernCode"] = '02';

$dataString = json_encode($arrData);

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://103.208.27.224:81/led_service_api/service/getPersonCivil.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$dataString,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$dataReturn = json_decode($response,true);

echo "###################### Response ######################";
echo "<pre>";print_r($dataReturn); echo "</pre>";
echo "###################### Response ######################";
echo "<br><br>";
$t = "$";
echo "ตัวอย่างเรียกใช้ : {$t}dataReturn['Data'][1]['prefixBlackCase']<br>";
echo "ผลลัพธ์ : <a href=\"GetPersonCase.php?registerCode=".$dataReturn['Data'][1]["registerCode"]."&systemType=".$dataReturn['Data'][1]["systemType"]."\" target=\"_blank\">".$dataReturn['Data'][1]["prefixBlackCase"].$dataReturn['Data'][1]["blackCase"]."/".$dataReturn['Data'][1]["blackYy"]." ".$dataReturn['Data'][1]["fullName"]." ".$dataReturn['Data'][1]["concernName"]."</a>";

?>