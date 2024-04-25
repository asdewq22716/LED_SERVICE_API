<?php

$HIDE_HEADER = "Y";
include '../include/comtop_user.php';

// ------------------------------------------------------------------------------------------------------------
$WF_GET_BANKRUPT_APPOINTMANT = "http://103.40.146.73/LedServiceBankrupt.php/GetAppointmant";
// ------------------------------------------------------------------------------------------------------------

$show_data = ($_GET['show_data']) ? $_GET['show_data'] : 'N';

$ownerIdcard = ($_GET['ownerIdcard']) ? $_GET['ownerIdcard'] : '';
$appointDateStart = ($_GET['appointDateStart']) ? $_GET['appointDateStart'] : '';
$appointDateEnd = ($_GET['appointDateEnd']) ? $_GET['appointDateEnd'] : '';

if ($ownerIdcard == '') {
    echo 'กรุณาใส่เลขบัตร';
    exit;
}

// "processDateStart": "2018-07-01",
// "processDateEnd": "2018-08-01",
// "appointDateStart": "2018-07-01",
// "appointDateEnd": "2018-07-05"

function getAppointmentInBankrupt($ownerIdcard, $show_data, $option = '', $appointDateStart = '', $appointDateEnd = '')
{
    global $WF_GET_BANKRUPT_APPOINTMANT;

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $WF_GET_BANKRUPT_APPOINTMANT,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 300,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
            "showQry": "' . $option . '",
            "ownerIdcard": "' . $ownerIdcard . '",
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


$dataCurl = getAppointmentInBankrupt($ownerIdcard, $show_data, $showQry, $appointDateStart, $appointDateEnd);

$updateRow = 0;
$insertRow = 0;

if (isset($dataCurl["data"]["ResponseCode"]) && $dataCurl["data"]["ResponseCode"]['ResCode']  == '000') {

    if (isset($dataCurl['data']['Data']) && count($dataCurl['data']['Data']) > 0) {
        $dataForInsert = $dataCurl['data']['Data'];

        foreach ($dataForInsert as $val) {
            unset($fieldInsert, $sqlChk);
            $MEETING_SDATE = '';
            $CREATE_DATE = '';
            $UPDATE_DATE = '';
            $MEETING_SDATE_TIME = '';
            $CREATE_DATE_TIME = '';
            $UPDATE_DATE_TIME = '';

            if ($val['appointmantDate']) {
                list($MEETING_SDATE, $MEETING_SDATE_TIME) = explode(' ', $val['appointmantDate']);
            }
            if ($val['appCreateDate']) {
                list($CREATE_DATE, $CREATE_DATE_TIME) = explode(' ', $val['appCreateDate']);
            }
            if ($val['appUpdateDate']) {
                list($UPDATE_DATE, $UPDATE_DATE_TIME) = explode(' ', $val['appUpdateDate']);
            }

            $MEETING_TOPIC = '';
            if ($val['aptName']) {
                $MEETING_TOPIC .= $val['aptName'];
            }
            if ($val['appAptDesc']) {
                $MEETING_TOPIC .= ' ' . $val['appAptDesc'];
            }
            if ($val['brkSubject']) {
                $MEETING_TOPIC .= ' สำนวนเรื่อง ' . $val['brkSubject'];
            }

            $APP_PERSON_IDCARD = "";
            if ($val['perIdcard'] != '') {
                $APP_PERSON_IDCARD = $val['perIdcard'];
            } else {
                $APP_PERSON_IDCARD = $val['perCompanyCode'];
            }

            $MEETING_LOCATION = "";
            if ($val['appPltIdFk']) {
                switch ($val['appPltIdFk']) {
                    case "1":
                    case "3":
                        $MEETING_LOCATION .= $val['pltName'];
                        if ($val['depName']) {
                            $MEETING_LOCATION .= ' ' . $val['depName'];
                        }
                        break;
                    case "4":
                        $MEETING_LOCATION .= $val['pltName'];
                        if ($val['appPltDesc']) {
                            $MEETING_LOCATION .= ' ' . $val['appPltDesc'];
                        }
                        break;
                }
            }

            $F_ID = ($val['apdDopIdFk']) ? $val['appIdPk'] . '-' . $val['apdDopIdFk'] : $val['appIdPk'];
            $fieldInsert['MEETING_TOPIC'] = $MEETING_TOPIC;
            $fieldInsert['MEETING_DETAIL'] = $val['appRemark'];
            $fieldInsert['MEETING_SDATE'] = $MEETING_SDATE;
            $fieldInsert['MEETING_SDATE_TIME'] = $MEETING_SDATE_TIME;
            $fieldInsert['MEETING_EDATE'] = "";
            $fieldInsert['MEETING_EDATE_TIME'] = "";
            $fieldInsert['CREATE_BY_ID_CARD'] = $val['usrIdCard'];
            $fieldInsert['CREATE_BY_NAME'] = $val['usrDisplayname'];
            $fieldInsert['CREATE_DATE'] = $CREATE_DATE;
            $fieldInsert['CREATE_DATE_TIME'] = $CREATE_DATE_TIME;
            $fieldInsert['APP_PERSON_IDCARD'] =  $APP_PERSON_IDCARD;
            $fieldInsert['APP_PERSON_NAME'] = $val['perFullname'];
            $fieldInsert['MEETING_LOCATION'] = $MEETING_LOCATION;
            $fieldInsert['SYSTEM_ID'] = 2;
            $fieldInsert['CODE_API'] = $val['brcIdPk'];
            $fieldInsert['F_ID'] = $F_ID;
            $fieldInsert['UPDATE_DATE'] = $UPDATE_DATE;
            $fieldInsert['UPDATE_DATE_TIME'] = $UPDATE_DATE_TIME;

            $sqlChk = "SELECT COUNT(*) AS NUM FROM M_MEETING WHERE CODE_API = '{$val['brcIdPk']}' AND F_ID = '$F_ID' AND APP_PERSON_IDCARD = '$APP_PERSON_IDCARD' AND SYSTEM_ID = 2 ";
            $qryChk = db::query($sqlChk);
            $recChk = db::fetch_array($qryChk);


            if ($recChk['NUM'] > 0) {
                db::db_update(
                    'M_MEETING',
                    $fieldInsert,
                    array(
                        "CODE_API" => $val['brcIdPk'],
                        "F_ID" => $F_ID,
                        "APP_PERSON_IDCARD" => $APP_PERSON_IDCARD,
                        "SYSTEM_ID" => 2
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
