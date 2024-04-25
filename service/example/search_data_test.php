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
if ($_GET["registerCode"] != "") {
    $arrData["registerCode"] = $_GET["registerCode"];
} else {
    $arrData["registerCode"] = '0135558001347';
}
if ($_GET["registerCode2"] != "") {
    $arrData["registerCode2"] = $_GET["registerCode2"];
}
if ($_GET["concernCode"] != "") {
    $arrData["concernCode"] = $_GET["concernCode"];
}

// $arrData["systemType"] = 2;
/* $arrData["registerCode"] = '4459884784638';
$arrData["registerCode2"] = '9989985615951'; */
echo "ข้อมูลที่ส่งไป";
echo "<pre>";
print_r($arrData);
echo "</pre>";
$dataString = json_encode($arrData);

curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://103.208.27.224:81/led_service_api/service/GetPersonCaseList.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $dataString,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
));

$response = curl_exec($curl);

curl_close($curl);

$dataReturn = json_decode($response, true);

echo "###################### Response ######################";
/* echo "<pre>";
print_r($dataReturn);
echo "</pre>"; */
echo "###################### Response ######################";
echo "<br><br>";
$t = "$";
echo "ตัวอย่างเรียกใช้ : {$t}dataReturn['Data'][1]['prefixBlackCase']<br>";
echo "ผลลัพธ์ : <a href=\"GetPersonCase.php?registerCode=" . $dataReturn['Data'][1]["registerCode"] . "&systemType=" . $dataReturn['Data'][1]["systemType"] . "\" target=\"_blank\">" . $dataReturn['Data'][1]["prefixBlackCase"] . $dataReturn['Data'][1]["blackCase"] . "/" . $dataReturn['Data'][1]["blackYy"] . " " . $dataReturn['Data'][1]["fullName"] . " " . $dataReturn['Data'][1]["concernName"] . "</a>";
echo "<br><br>-------------------------exp-------------------------";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าค้นหาข้อมูล</title>
</head>

<body>
    <form action="search_data_test.php" method="GET" name="frm-input">
        <div class="row">
            <div class="content">
                <div class="row">
                    <div class="col-2"><label for="">โจทย์ </label></div>
                    <div class="col-4"><input type="text" name="registerCode" id="registerCode" value="<?php echo $_GET['registerCode']; ?>"></div>
                </div>
                <div class="row">
                    <div class="col-2"><label for="">จำเลย </label></div>
                    <div class="col-4"><input type="text" name="registerCode2" id="registerCode2" value="<?php echo $_GET['registerCode2']; ?>"></div>
                </div>
                <div>
                    <button name="submit" id="submit" type="submit">ค้นหาข้อมูล</button>
                </div>
                <table border="1">
                    <thead>
                        <?php
                        $ii = 0;
                        foreach ($dataReturn['Data'] as $tt1 => $th1) {
                        ?>
                            <?php
                            foreach ($th1 as $tt2 => $th2) {
                                if ($ii > 0) {
                                } else {
                            ?> <tr><?php
                                    foreach ($th2 as $tt3 => $th3) {
                                    ?>

                                            <td><?php echo $tt3;
                                                ?></td>

                                        <?php
                                    }
                                        ?>
                                    </tr><?php
                                        }
                                        $ii++;
                                    }
                                            ?>
                        <?php
                        }
                        ?>
                    </thead>
                    <?php
                    foreach ($dataReturn['Data'] as $sh1 => $ch1) {
                    ?>

                        <tr>
                            <td><?php echo $sh1; ?></td>
                        </tr>
                        <?php
                        foreach ($ch1 as $sh2 => $ch2) {
                        ?> <tr><?php
                                foreach ($ch2 as $sh3 => $ch3) {
                                ?>

                                    <td><?php echo $ch3; ?></td>

                                <?php
                                }
                                ?>
                            </tr><?php
                                }
                                    ?>
                    <?php
                    }
                    ?>
                </table>

            </div>
        </div>
    </form>
</body>

</html>