<?php
$curl = curl_init();

$form_field["registerCode"] = '0205558010221';
$form_field["systemType"] = 'Civil';
$form_field["prefixBlackCase"] = 'ผบ';
$form_field["blackCase"] = '13060101';
$form_field["blackYy"] = '2565';
$form_field["prefixRedCase"] = 'ผบ';
$form_field["redCase"] = '13060102';
$form_field["redYy"] = '2565';
$form_field["CourtCode"] = '204';
$data_string = json_encode($form_field);

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://103.208.27.224:81/led_service_api/service/GetPersonCase.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$data_string,
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
echo "ผลลัพธ์ : ".$dataReturn['Data'][1]["prefixBlackCase"].$dataReturn['Data'][1]["blackCase"]."/".$dataReturn['Data'][1]["blackYy"]." ".$dataReturn['Data'][1]["fullName"]." ".$dataReturn['Data'][1]["concernName"];



?>