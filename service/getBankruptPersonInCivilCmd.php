<?php

$HIDE_HEADER = "Y";
include '../include/comtop_user.php';
// exit;
$WF_GET_BANKRUPT_PERSON_IN_CIVIL = "http://103.40.146.73/LedServiceCivilById.php/getBankruptPersonInCivil";


$tableInset = "WH_BANKRUPT_EXECUTION";
$file_name = "../attach/getBankruptPersonInCivil/" . date('Ymd') . "_cmd.txt";
$limit = 10000;

function getBankruptPersonInCivil($page, $limit, $show_data = '', $getPage = '', $option = '')
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

$dataChk = getBankruptPersonInCivil('', $limit, 'Y', 'Y', 'N');
echo "\n";
if ($dataChk['ResponseCode']['ResCode'] == '000' && $dataChk['Data']['allPage'] > 0) {

    $attach_folder = "../attach/getBankruptPersonInCivil";
    if (is_dir($attach_folder) == false) {
        mkdir($attach_folder, 0777);
    }

    $allPage = $dataChk['Data']['allPage'];
    $page = 1;

    if (file_exists($file_name)) {
        unlink($file_name);
    }

    $filename = fopen($file_name, "w");

    try {
        while (($page <= $allPage) && $fail < $failTime) {
            $dataReturn = getBankruptPersonInCivil($page, $limit, '', '', '');

            if ($dataReturn['Data']['data']) {
                foreach ($dataReturn['Data']['data'] as $key => $val) {
                    unset($temp);
                    $temp = str_replace("\n",  "", implode('|', $val));
                    fwrite($filename,  $temp . PHP_EOL);
                }
                echo 'Page ' . $page . ' / ' . $allPage . "\n";
                $page++;
            } else {
                $fail++;
            }
        }
        echo "create file successful" . "\n";
    } catch (Exception $th) {
        throw $th;
    }
}
fclose($filename);


$file = fopen($file_name, 'r');
$lines = count(file($file_name));

if ($file) {
    $lineNumber = 1;

    // db::query("TRUNCATE TABLE $tableInset");

    while (!feof($file)) {
        $line = fgets($file);

        unset($field);
        $val = explode('|', $line);

        if (count($val) > 1) {

            db::db_delete($tableInset, array('WH_EXECUTION_ID' => conText($val[168])));

            $field['WH_EXECUTION_ID'] = conText($val[168]);
            // ชื่อศาล
            $field['COURT_NAME'] = conText(trim($val[88]));
            // เลขคดีดำ
            $field['BLACK_CASE'] = conText(trim($val[57]));
            // ปีคดีดำ
            $field['BLACK_YY'] = conText(trim($val[58]));
            // เลขคดีเเดง
            $field['RED_CASE'] = conText(trim($val[128]));
            // ปีคดีเเดง
            $field['RED_YY'] = conText(trim($val[129]));
            // 13 หลักของจำเลย
            $field['DEFFENDANT_IDCARD'] = conText(trim($val[107]));
            // ชื่อจำเลย
            $field['DEFFENDANT_NAME'] = conText(trim($val[114] . ' ' . $val[116]));
            // วันประกาศราชกิจจาฯ
            $field['ANNOUNCEMENT_DATE_A'] = (checkdate($val[161], $val[160], ($val[164] - 543))) ? date('Y-m-d', strtotime(($val[164] - 543) . '-' . $val[161] . '-' . $val[160])) : '';
            // วันประกาศราชกิจจาฯ
            $field['ANNOUNCEMENT_DATE_B'] = (checkdate($val[153], $val[152], ($val[156] - 543))) ? date('Y-m-d', strtotime(($val[156] - 543) . '-' . $val[153] . '-' . $val[152])) : '';
            // วันประกาศราชกิจจาฯ
            $field['ANNOUNCEMENT_DATE_C'] = (checkdate($val[14], $val[13], ($val[17] - 543))) ? date('Y-m-d', strtotime(($val[17] - 543) . '-' . $val[14] . '-' . $val[13])) : '';
            // วันประกาศราชกิจจาฯ
            $field['ANNOUNCEMENT_DATE_E'] =  (checkdate($val[6], $val[5], ($val[9] - 543))) ? date('Y-m-d', strtotime(($val[9] - 543) . '-' . $val[6]) . '-' . $val[5]) : '';
            // วันประกาศราชกิจจาฯ
            $field['ANNOUNCEMENT_DATE_F'] = (checkdate($val[79], $val[78], ($val[82] - 543))) ? date('Y-m-d', strtotime(($val[82] - 543) . '-' . $val[79]) . '-' . $val[78]) : '';
            // วันประกาศราชกิจจาฯ
            $field['ANNOUNCEMENT_DATE_G'] = (checkdate($val[61], $val[60], ($val[64] - 543))) ? date('Y-m-d', strtotime(($val[64] - 543) . '-' . $val[61]) . '-' . $val[60]) : '';
            // วันประกาศราชกิจจาฯ
            $field['ANNOUNCEMENT_DATE_I'] = (checkdate($val[50], $val[49], ($val[53] - 543))) ? date('Y-m-d', strtotime(($val[53] - 543) . '-' . $val[50] . '-' . $val[49])) : '';
            // วันประกาศราชกิจจาฯ
            $field['ANNOUNCEMENT_DATE_J'] = (checkdate($val[44], $val[43], ($val[47] - 543))) ? date('Y-m-d', strtotime(($val[47] - 543) . '-' . $val[44] . '-' . $val[43])) : '';
            // วันประกาศราชกิจจาฯ
            $field['ANNOUNCEMENT_DATE_K'] = (checkdate($val[26], $val[25], ($val[29] - 543))) ? date('Y-m-d', strtotime(($val[29] - 543) . '-' . $val[26] . '-' . $val[25])) : '';
            // วันประกาศราชกิจจาฯ
            $field['ANNOUNCEMENT_DATE_M'] = (checkdate($val[96], $val[95], ($val[99] - 543))) ? date('Y-m-d', strtotime(($val[99] - 543) . '-' . $val[96] . '-' . $val[95])) : '';
            // วันประกาศราชกิจจาฯ
            $field['ANNOUNCEMENT_DATE_N'] =  (checkdate($val[142], $val[141], ($val[145] - 543))) ? date('Y-m-d', strtotime(($val[145] - 543) . '-' . $val[142] . '-' . $val[141])) : '';
            // วันที่พิทักษ์ทรัพย์ชั่วคราว
            $field['DATE_TEMPORARY_A'] = (checkdate($val[166], $val[165], ($val[167] - 543))) ? date('Y-m-d', strtotime(($val[167] - 543) . '-' . $val[166] . '-' . $val[165])) : '';
            // วันถอนพิทักษ์ทรัพย์ชั่วคราว
            $field['WITHDRAWAL_DATE_B'] = (checkdate($val[157], $val[150], ($val[158] - 543))) ? date('Y-m-d', strtotime(($val[158] - 543) . '-' . $val[157] . '-' . $val[150])) : '';
            // วันที่พิทักษ์ทรัพย์เด็ดขาด
            $field['ABSOLUT_RECEIVERSHIP_C'] = (checkdate($val[19], $val[18], ($val[20] - 543))) ? date('Y-m-d', strtotime(($val[20] - 543) . '-' . $val[19] . '-' . $val[18])) : '';
            // วันถอนพิทักษ์ทรัพย์เด็ดขาด
            $field['ABSOLUTE_WITHDRAWAL_E'] = (checkdate($val[10], $val[3], ($val[11] - 543))) ? date('Y-m-d', strtotime(($val[11] - 543) . '-' . $val[10] . '-' . $val[3])) : '';
            // วันที่ครบกำหนดยื่นคำขอรับชำระหนี้
            $field['PAYMENT_DUE_DATE_D'] = (checkdate($val[1], $val[0], ($val[2] - 543))) ? date('Y-m-d', strtotime(($val[2] - 543) . '-' . $val[1] . '-' . $val[0])) : '';
            // นัดตรวจคำขอรับชำระหนี้
            $field['APPOINTMENT_DATE_D'] = (checkdate($val[22], $val[21], ($val[23] - 543))) ? date('Y-m-d', strtotime(($val[23] - 543) . '-' . $val[22] . '-' . $val[21])) : '';
            // วันประนอมหนี้ก่อนล้มละลาย
            $field['DEBT_RECONCILIATION_F'] = (checkdate($val[69], $val[68], ($val[70] - 543))) ? date('Y-m-d', strtotime(($val[70] - 543) . '-' . $val[69] . '-' . $val[68])) : '';
            // วันยกเลิกประนอมหนี้ก่อนล้มฯและพิพากษาให้ล้มฯ
            $field['CANCEL_DEBT_G'] = (checkdate($val[66], $val[65], ($val[67] - 543))) ? date('Y-m-d', strtotime(($val[67] - 543) . '-' . $val[66] . '-' . $val[65])) : '';
            // วันประนอมหนี้หลังล้มละลาย
            $field['AFTER_BANKRUPTCY_J'] = (checkdate($val[34], $val[33], ($val[35] - 543))) ? date('Y-m-d', strtotime(($val[35] - 543) . '-' . $val[34] . '-' . $val[33])) : '';
            // วันยกเลิกประนอมหนี้หลังล้มฯและพิพากษาให้ล้มฯ
            $field['CANCEL_DEBT_BACK_K'] = (checkdate($val[31], $val[30], ($val[32] - 543))) ? date('Y-m-d', strtotime(($val[32] - 543) . '-' . $val[31] . '-' . $val[30])) : '';
            // วันพิพากษาให้ล้มละลาย
            $field['BANKRUPTCY_JUDGMENT_I'] = (checkdate($val[55], $val[54], ($val[56] - 543))) ? date('Y-m-d', strtotime(($val[56] - 543) . '-' . $val[55] . '-' . $val[54])) : '';
            // วันยกเลิกการล้มละลาย
            $field['CANCEL_BANKRUPT_M'] = (checkdate($val[92], $val[91], ($val[93] - 543))) ? date('Y-m-d', strtotime(($val[93] - 543) . '-' . $val[92] . '-' . $val[91])) : '';
            // วันปลดการล้มละลาย
            $field['BANKRUPT_DISCHARGE_N'] = (checkdate($val[138], $val[137], ($val[139] - 543))) ? date('Y-m-d', strtotime(($val[139] - 543) . '-' . $val[138] . '-' . $val[137])) : '';
            // วันที่ศาลสั่งให้จัดการทรัพย์ย์มรดก
            $field['HERITAGE_O'] = (checkdate($val[112], $val[108], ($val[113] - 543))) ? date('Y-m-d', strtotime(($val[113] - 543) . '-' . $val[112] . '-' . $val[108])) : '';
            // วันยกเลิกจัดการทรัพย์มรดก
            $field['CANCEL_HERITANCE_O'] = (checkdate($val[110], $val[109], ($val[111] - 543))) ? date('Y-m-d', strtotime(($val[111] - 543) . '-' . $val[110] . '-' . $val[109])) : '';
            // วันจำหน่ายคดี
            $field['SELLING_CASE_Q'] = (checkdate($val[148], $val[147], ($val[149] - 543))) ? date('Y-m-d', strtotime(($val[149] - 543) . '-' . $val[148] . '-' . $val[147])) : '';
            // วันพิจารณาคดีใหม่
            $field['RECONSIDER_P'] = (checkdate($val[135], $val[134], ($val[136] - 543))) ? date('Y-m-d', strtotime(($val[136] - 543) . '-' . $val[135] . '-' . $val[134])) : '';
            // วันปิดคดี
            $field['CASE_CLOSING_DATE_Q'] = (checkdate($val[85], $val[84], ($val[86] - 543))) ? date('Y-m-d', strtotime(($val[86] - 543) . '-' . $val[85] . '-' . $val[84])) : '';
            // วันที่ยกฟ้อง
            $field['DATE_OF_DISMISSAL_P'] = (checkdate($val[170], $val[169], ($val[171] - 543))) ? date('Y-m-d', strtotime(($val[171] - 543) . '-' . $val[170] . '-' . $val[169])) : '';
            // เรื่องที่
            $field['SUBJECT'] = conText($val[130]);
            // IDศาล -> ประเภทศาล
            $field['COURT_CODE'] = conText($val[89]);
            // วันที่ครบกำหนดยื่นคำขอรับชำระหนี้ => ลูกหนี้พ้นจากการเป็นบุคคลล้มละลาย
            $field['SUBMIT_DEBT_PAYMENT_H'] = (checkdate($val[105], $val[104], ($val[106] - 543))) ? date('Y-m-d', strtotime(($val[106] - 543) . '-' . $val[105] . '-' . $val[104])) : '';
            // วันที่ครบกำหนดยื่นคำขอรับชำระหนี้
            $field['PAYMENT_DUE_L'] = (checkdate($val[37], $val[36], ($val[38] - 543))) ? date('Y-m-d', strtotime(($val[38] - 543) . '-' . $val[37] . '-' . $val[36])) : '';
            // นัดตรวจคำขอรับชำระหนี้
            $field['APPOINTMENT_DATE_H'] = (checkdate($val[132], $val[131], ($val[133] - 543))) ? date('Y-m-d', strtotime(($val[133] - 543) . '-' . $val[132] . '-' . $val[131])) : '';
            // นัดตรวจคำขอรับชำระหนี้
            $field['APPOINTMENT_DATE_L'] = (checkdate($val[121], $val[120], ($val[122] - 543))) ? date('Y-m-d', strtotime(($val[122] - 543) . '-' . $val[121] . '-' . $val[120])) : '';

            db::db_insert($tableInset, $field);

            echo 'Insert : ' . $lineNumber . '/' . $lines . "\n";
        }
    }

    echo "successful";

    fclose($file);
} else {
    echo "Unable to open file.";
}
