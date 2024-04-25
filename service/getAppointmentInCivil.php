<?php

$HIDE_HEADER = "Y";
include '../include/comtop_user.php';

// ------------------------------------------------------------------------------------------------------------
$WF_GET_APPOINTMENT_IN_CIVIL = "http://103.40.146.73/LedServiceCivilById.php/getAppointmant";
// ------------------------------------------------------------------------------------------------------------

$show_data = ($_GET['show_data']) ? $_GET['show_data'] : 'N';
$showQry = ($_GET['showQry']) ? $_GET['showQry'] : '';
$idCard = ($_GET['idCard']) ? $_GET['idCard'] : '';

$processDateStart = ($_GET['processDateStart']) ? $_GET['processDateStart'] : '';
$processDateEnd = ($_GET['processDateEnd']) ? $_GET['processDateEnd'] : '';
$appointDateStart = ($_GET['appointDateStart']) ? $_GET['appointDateStart'] : '';
$appointDateEnd = ($_GET['appointDateEnd']) ? $_GET['appointDateEnd'] : '';

if ($idCard == '') {
    echo 'กรุณาใส่เลขบัตร';
    exit;
}

// "processDateStart": "2018-07-01",
// "processDateEnd": "2018-08-01",
// "appointDateStart": "2018-07-01",
// "appointDateEnd": "2018-07-05"

function getAppointmentInCivil($idCard, $show_data, $option = '', $processDateStart = '', $processDateEnd = '', $appointDateStart = '', $appointDateEnd = '')
{
    global $WF_GET_APPOINTMENT_IN_CIVIL;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $WF_GET_APPOINTMENT_IN_CIVIL,
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
            "showQry": "' . $option . '",
            "idCard": "' . $idCard . '",
            "processDateStart": "' . $processDateStart . '",
            "processDateEnd": "' . $processDateEnd . '",
            "appointDateStart": "' . $appointDateStart . '",
            "appointDateEnd": "' . $appointDateEnd . '"
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


$dataCurl = getAppointmentInCivil($idCard, $show_data, $showQry, $processDateStart, $processDateEnd, $appointDateStart, $appointDateEnd);
$updateRow = 0;
$insertRow = 0;

if ($dataCurl['ResponseCode']['ResCode'] == '000') {
    if (count($dataCurl['Data']['data']) > 0) {
        $dataForInsert = $dataCurl['Data']['data'];

        foreach ($dataForInsert as $val) {
            unset($fieldInsert, $sqlChk);
            $MEETING_SDATE = '';
            $MEETING_EDATE = '';
            $CREATE_DATE = '';
            $UPDATE_DATE = '';
            $MEETING_SDATE_TIME = '';
            $MEETING_EDATE_TIME = '';
            $CREATE_DATE_TIME = '';
            $UPDATE_DATE_TIME = '';
            // if ($val['processDate']) {
            //     list($MEETING_SDATE, $MEETING_SDATE_TIME) = explode(' ', $val['processDate']);
            // }
            if ($val['appointDate']) {
                list($MEETING_SDATE, $MEETING_SDATE_TIME) = explode(' ', $val['appointDate']);
                // list($MEETING_EDATE, $MEETING_EDATE_TIME) = explode(' ', $val['appointDate']);
            }
            if ($val['createDate']) {
                list($CREATE_DATE, $CREATE_DATE_TIME) = explode(' ', $val['createDate']);
            }
            if ($val['updateDate']) {
                list($UPDATE_DATE, $UPDATE_DATE_TIME) = explode(' ', $val['updateDate']);
            }
            $fieldInsert['MEETING_TOPIC'] = $val['proceedDesc'];
            $fieldInsert['MEETING_DETAIL'] = $val['appointMemo'];
            $fieldInsert['MEETING_SDATE'] = $MEETING_SDATE;
            $fieldInsert['MEETING_SDATE_TIME'] = $MEETING_SDATE_TIME;
            $fieldInsert['MEETING_EDATE'] = $MEETING_EDATE;
            $fieldInsert['MEETING_EDATE_TIME'] = $MEETING_EDATE_TIME;
            $fieldInsert['CREATE_BY_ID_CARD'] = $val['personCode'];
            $fieldInsert['CREATE_BY_NAME'] = $val['ownerPerfix'] . $val['ownerFname'] . ' ' . $val['ownerLname'];
            $fieldInsert['CREATE_DATE'] = $CREATE_DATE;
            $fieldInsert['CREATE_DATE_TIME'] = $CREATE_DATE_TIME;
            $fieldInsert['APP_PERSON_IDCARD'] = $val['personCode'];
            $fieldInsert['APP_PERSON_NAME'] = $val['ownerPerfix'] . $val['ownerFname'] . ' ' . $val['ownerLname'];
            $fieldInsert['MEETING_LOCATION'] = 'กรมบังคับคดี';
            $fieldInsert['SYSTEM_ID'] = 1;
            $fieldInsert['CODE_API'] = $val['pccCivilGen'];
            $fieldInsert['F_ID'] = $val['appointmentGen'];
            $fieldInsert['UPDATE_DATE'] = $UPDATE_DATE;
            $fieldInsert['UPDATE_DATE_TIME'] = $UPDATE_DATE_TIME;

            $sqlChk = "SELECT COUNT(*) AS NUM FROM M_MEETING WHERE CODE_API = '{$val['pccCivilGen']}' AND F_ID = '{$val['appointmentGen']}' AND APP_PERSON_IDCARD = '{$val['personCode']}' AND SYSTEM_ID = 1 ";
            $qryChk = db::query($sqlChk);
            $recChk = db::fetch_array($qryChk);

            if ($recChk['NUM'] > 0) {
                db::db_update(
                    'M_MEETING',
                    $fieldInsert,
                    array(
                        "CODE_API" => $val['pccCivilGen'],
                        "F_ID" => $val['appointmentGen'],
                        "APP_PERSON_IDCARD" => $val['personCode'],
                        "SYSTEM_ID" => 1
                    )
                );
                $updateRow++;
            } else {
                db::db_insert('M_MEETING', $fieldInsert, 'MEETING_ID', 'MEETING_ID');
                $insertRow++;
            }
        }

        echo "<script>alert('ดึงข้อมูลเสร็จสิ้น\\nInsert $insertRow แถว \\nUpdate $updateRow แถว')</script>";
    } else {
        echo "<script>alert('ไม่พบข้อมูล')</script>";
    }
} else {
    echo "<script>alert('ดึงข้อมูลล้มเหลว')</script>";
}

exit;
