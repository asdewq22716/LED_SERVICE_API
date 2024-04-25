<?php
/*
##### Request #####
systemType : 1
##### Request #####

##### systemType #####
1 : ระบบงานบังคับคดีแพ่ง
2 : ระบบงานบังคับคดีล้มละลาย
3 : ระบบงานฟื้นฟูกิจการของลูกหนี้
4 : ระบบงานไกล่เกลี่ยข้อพิพาท
##### systemType #####
*/

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://103.208.27.224:81/led_service_api/service/getBookNumber.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "systemType":"1"
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
echo "ตัวอย่างเรียกใช้ : {$t}dataReturn['Data']['bookNumber']<br>";
echo "ผลลัพธ์ : ".$dataReturn['Data']["bookNumber"];

?>