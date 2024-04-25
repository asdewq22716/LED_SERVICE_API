<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://103.208.27.224:81/led_service_api/service/getDossRoute.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "WhCivilId":"995"
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
echo "ตัวอย่างเรียกใช้ : {$t}dataReturn['Data'][0]['detail']<br>";
echo "ผลลัพธ์ : ".$dataReturn['Data'][0]["detail"];

?>