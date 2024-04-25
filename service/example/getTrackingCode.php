<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://103.208.27.224:81/led_service_api/service/tracking_code.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "depName":"Mediate",
    "rowNum":"3"
}',
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
echo "ตัวอย่างเรียกใช้ : {$t}dataReturn['Data'][0]['trackingCode']<br>";
echo "ผลลัพธ์ : ".$dataReturn['Data'][0]["trackingCode"];

?>