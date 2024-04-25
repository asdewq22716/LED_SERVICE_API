<?php

$HIDE_HEADER = "Y";
include '../include/comtop_user.php';
// exit;
$WF_GET_BANKRUPT_PERSON_IN_CIVIL = "http://103.40.146.73/LedServiceCivilById.php/getBankruptPersonInCivil";
$show_data = ($_GET['show_data']) ? $_GET['show_data'] : 'N';

function getBankruptPersonInCivil($page, $limit, $show_data, $getPage = '', $option = '')
{
    global $WF_GET_BANKRUPT_PERSON_IN_CIVIL;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $WF_GET_BANKRUPT_PERSON_IN_CIVIL,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
            "USERNAME":"BankruptDt",
            "PASSWORD":"Debtor4321",
            "page":"' . $page . '",
            "limit":"' . $limit . '",
            "getPage":"' . $getPage . '",
            "showQry":"' . $option . '"
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $dataReturn = json_decode($response, true);

    if ($show_data == 'Y') {
        print_pre($dataReturn);
    }

    return $dataReturn;
}


$fail = 0;
$failTime = 5;
$limit = 10000;

if (isset($_GET['fixLine']) && $_GET['fixLine'] != '') {
    $limit = 1;
}

$dataChk = getBankruptPersonInCivil('', $limit, 'Y', 'Y', 'N');
// exit;
if ($dataChk['ResponseCode']['ResCode'] == '000' && $dataChk['Data']['allPage'] > 0) {

    $attach_folder = "../attach/getBankruptPersonInCivil";
    if (is_dir($attach_folder) == false) {
        mkdir($attach_folder, 0777);
    }

    $allPage = $dataChk['Data']['allPage'];
    $page = 1;
    if (isset($_GET['fixLine']) && $_GET['fixLine'] != '') {
        $page = $_GET['fixLine'];
        $allPage = $_GET['fixLine'];
        unlink("../attach/getBankruptPersonInCivil/" . date('Ymd') . "Fix.txt");
        $filename = fopen("../attach/getBankruptPersonInCivil/" . date('Ymd') . "Fix.txt", "w");
    } else {
        unlink("../attach/getBankruptPersonInCivil/" . date('Ymd') . ".txt");
        $filename = fopen("../attach/getBankruptPersonInCivil/" . date('Ymd') . ".txt", "w");
    }

    try {
        while (($page <= $allPage) && $fail < $failTime) {
            $dataReturn = getBankruptPersonInCivil($page, $limit, $show_data, '', '');

            if ($dataReturn['Data']['data']) {
                foreach ($dataReturn['Data']['data'] as $key => $val) {
                    unset($temp);
                    $temp = str_replace("\n",  "", implode('|', $val));
                    fwrite($filename,  $temp . PHP_EOL);
                }
                $page++;
            } else {
                $fail++;
            }
        }
    } catch (Exception $th) {
        throw $th;
    }
}
fclose($filename);

echo '<hr>จำนวนการล้มเหลว : ' . $fail . ' ครั้ง<hr>';

if ($fail >= $failTime) {
    echo "ดึงข้อมูลจากแพ่งไม่สำเร็จ";
} else {
    echo "ดึงข้อมูลจากแพ่งสำเร็จ";
    echo '<script>window.location = "../service/getBankruptPersonInCivilToWH.php?show_data=N";</script>';
}
