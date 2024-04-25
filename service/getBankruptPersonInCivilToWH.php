<?php

$HIDE_HEADER = "Y";
include '../include/comtop_user.php';

$arrList = array(
    "absDueDd", "absDueMm", "absDueYy", "absEjcDd", "absEjcGazBook", "absEjcGazDd", "absEjcGazMm", "absEjcGazPage", "absEjcGazPart", "absEjcGazYy", "absEjcMm", "absEjcYy", "absGazBook", "absGazDd", "absGazMm", "absGazPage", "absGazPart", "absGazYy", "absProtDd", "absProtMm", "absProtYy", "absReqDd", "absReqMm", "absReqYy", "aCanGazBook", "aCanGazDd", "aCanGazMm", "aCanGazPage", "aCanGazPart", "aCanGazYy", "aCanSetDd", "aCanSetMm", "aCanSetYy", "aCouSetDd", "aCouSetMm", "aCouSetYy", "aDueSetDd", "aDueSetMm", "aDueSetYy", "aReqSetDd", "aReqSetMm", "aReqSetYy", "aSetGazBook", "aSetGazDd", "aSetGazMm", "aSetGazPage", "aSetGazPart", "aSetGazYy", "bkrGazBook", "bkrGazDd", "bkrGazMm", "bkrGazPage", "bkrGazPart", "bkrGazYy", "bkrProtDd", "bkrProtMm", "bkrProtYy", "blackCase", "blackYy", "bCanGazBook", "bCanGazDd", "bCanGazMm", "bCanGazPage", "bCanGazPart", "bCanGazYy", "bCanSetDd", "bCanSetMm", "bCanSetYy", "bCouSetDd", "bCouSetMm", "bCouSetYy", "bDueSetDd", "bDueSetMm", "bDueSetYy", "bReqSetDd", "bReqSetMm", "bReqSetYy", "bSetGazBook", "bSetGazDd", "bSetGazMm", "bSetGazPage", "bSetGazPart", "bSetGazYy", "caseCapital", "closeDd", "closeMm", "closeYy", "corrupt", "courtName", "courtType", "createDate", "cBkrDd", "cBkrMm", "cBkrYy", "cGazBook", "cGazDd", "cGazMm", "cGazPage", "cGazPart", "cGazYy", "defendant1", "defendant2", "defendant3", "depOwner", "dfExpireDd", "dfExpireMm", "dfExpireYy", "dfId", "dfManageDd", "dfManageEjcDd", "dfManageEjcMm", "dfManageEjcYy", "dfManageMm", "dfManageYy", "dfName", "dfNo", "dfSurname", "dfTitle", "firstConferenceDate", "lastupdate", "othDd", "othMm", "othYy", "plaintiff1", "plaintiff2", "plaintiff3", "recvNo", "recvYr", "redCase", "redYy", "remark", "reqDd", "reqMm", "reqYy", "reBkrDd", "reBkrMm", "reBkrYy", "rBkrDd", "rBkrMm", "rBkrYy", "rGazBook", "rGazDd", "rGazMm", "rGazPage", "rGazPart", "rGazYy", "scBrkDate", "sBkrDd", "sBkrMm", "sBkrYy", "tmpEjcDd", "tmpEjcGazBook", "tmpEjcGazDd", "tmpEjcGazMm", "tmpEjcGazPage", "tmpEjcGazPart", "tmpEjcGazYy", "tmpEjcMm", "tmpEjcYy", "tmpGazBook", "tmpGazDd", "tmpGazMm", "tmpGazPage", "tmpGazPart", "tmpGazYy", "tmpProtDd", "tmpProtMm", "tmpProtYy", "twsId", "uaccDd", "uaccMm", "uaccYy", "userOwner",
);

$fileName = "../attach/getBankruptPersonInCivil/" . date('Ymd') . ".txt";
// $fileName = "../attach/getBankruptPersonInCivil/20231219.txt";

$file = fopen($fileName, 'r');


$lines = count(file($fileName));

$start = $_GET['start'] ? $_GET['start'] : 0;
$stop = $_GET['stop'] ? $_GET['stop'] : 0;
$limit = 1000;


$end = $start + $limit;

if ($stop == 1) {
    echo "success";
    exit;
}

if ($start == 0) {
    db::query("TRUNCATE TABLE WH_BANKRUPT_EXECUTION");
} else {
    $percent = ($start / $lines) * 100;
}

if ($end >= $lines) {
    $end = $lines;
    $stop = 1;
}
// exit;
?>
<a href="../service/getBankruptPersonInCivilToWH.php?show_data=N&start=<?php echo $end ?>&stop=<?php echo $stop ?>" id="btn_new"></a>
<style>
    #progress-container {
        width: 50%;
        margin: 50px auto;
        border: 1px solid #ccc;
        border-radius: 5px;
        overflow: hidden;
    }

    #progress-bar {
        width: 0%;
        height: 30px;
        background-color: #4CAF50;
        color: black;
        text-align: center;
        line-height: 30px;
    }
</style>
<div id="progress-container">
    <div id="progress-bar">0%</div>
</div>

<script>
    function updateProgressBar(value) {
        var progressBar = document.getElementById('progress-bar');
        progressBar.style.width = value + '%';
        progressBar.innerHTML = value + '%';
    }

    updateProgressBar(<?php echo round($percent, 4); ?>);
</script>
<?php
// exit;
if ($file) {
    $lineNumber = 1;

    while (!feof($file)) {
        $line = fgets($file);

        if (($lineNumber >= $start  && $lineNumber < $end) || $lineNumber == $lines) {
            unset($field);
            $val = explode('|', $line);

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

            db::db_insert('WH_BANKRUPT_EXECUTION', $field);
        }

        $lineNumber++;

        if ($lineNumber > $end) {
            break;
        }
    }

    fclose($file);

    echo '<script>
            (function() {
                const myTimeout = setTimeout(newPage, 2000);
            })();
            function newPage(){
                document.getElementById("btn_new").click();
                window.close();
            }
        </script>';
} else {
    echo "Unable to open file.";
}

exit;
