<?php
/*
##### Request #####
prefixBlackCase : ตัวย่อคดีดำ
blackCase : เลขคดีดำ
blackYy : ปีคดีดำ
prefixRedCase : ตัวย่อคดีแดง
redCase : เลขคดีแดง
redYy : ปีคดีแดง
CourtCode : ศาล
systemType : รหัสระบบ


##### systemType #####
1 : ระบบงานบังคับคดีแพ่ง
2 : ระบบงานบังคับคดีล้มละลาย
3 : ระบบงานฟื้นฟูกิจการของลูกหนี้
4 : ระบบงานไกล่เกลี่ยข้อพิพาท
##### systemType #####

##### Request #####
*/

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://103.208.27.224:81/led_service_api/service/getReviveDebtBalance.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "prefixBlackCase":"ฟ",
    "blackCase":"1245",
    "blackYy":"2565",
    "prefixRedCase":"ฟ",
    "redCase":"1246",
    "redYy":"2565",
    "registerCode":"0135558001347"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

echo $response = curl_exec($curl);

curl_close($curl);

$dataReturn = json_decode($response,true);

echo "###################### Response ######################";
echo "<pre>";print_r($dataReturn); echo "</pre>";
echo "###################### Response ######################";
echo "<br><br>";
$t = "$";
echo "ตัวอย่างเรียกใช้ : {$t}dataReturn['Data'][0]['Plaintiff1']<br>";
echo "ผลลัพธ์ : ".$dataReturn['Data'][0]["Plaintiff1"];

?>