<?php
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Cache-Control: no-cache');
    header('Access-Control-Max-Age: 1728000');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Access-Control-Request-Private-Network');
    header('Access-Control-Allow-Private-Network: true');
    die();
}

header('Access-Control-Allow-Origin: *');
/* header('Content-Type: application/json'); */

include '../include/include.php';
include '../include/func_Nop.php';

/* $str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true); */

$POST = $_REQUEST;
$PAGE_CODE = $POST['W'];
$WFR_API = $POST['WFR'];
$REGISTERCODE = $POST['REGISTERCODE'];
/* echo $REGISTERCODE;
exit; */

if ($WFR_API != "") {
    $dataSet["WFR"] = $WFR_API;
    $show_data = "";
    //getReviveToWh($dataSet, $show_data);
    $sqlSelectData = "	select * from WH_REHABILITATION_CASE_DETAIL
                            where 		REHAB_CODE='" . $WFR_API . "' ";
    $querySelectData = db::query($sqlSelectData);
    $dataSelectData = db::fetch_array($querySelectData);


    $sql_person_Revive = "SELECT b.* FROM WH_REHABILITATION_CASE_DETAIL a
    JOIN WH_REHABILITATION_PERSON b ON a.WH_REHAB_ID =b.WH_REHAB_ID 
    WHERE a.REHAB_CODE ='" . $WFR_API . "'";
    $query_Revive = db::query($sql_person_Revive);

    if ($REGISTERCODE == "") {
        $text_N = 1;
        $data_array_Revive = db::num_rows($sql_person_Revive);
        $REGISTERCODE = '';
        $CONCERN_CODE = '';
        $query_Med = db::query($sql_person_Revive);
        $rec_WH = "";
        while ($rec_Med = db::fetch_array($query_Med)) {
            $REGISTERCODE .=  $rec_Med["REGISTER_CODE"] . ($rec_Med["REGISTER_CODE"] != "" ? "," : "");
            $CONCERN_CODE .= $rec_Med["CONCERN_CODE"]  . ($rec_Med["CONCERN_CODE"] != "" ? "," : "");
            $text_N++;
        }
        $REGISTERCODE = cut_last_comma($REGISTERCODE);
    }
    $array_link = "";
    foreach (json_decode($str_json, true) as $sh1 => $ch1) {
        $array_link .= "&" . $sh1 . "=" . $ch1;
    }

    unset($fields);
    $fields["PAGE_CODE"]           =    $W;
    $fields["WFR"]                 =    $WFR;
    $fields["COLUMN1"]             =    $array_link;
    $fields["CREATE_DATE"]         =    date("Y-m-d");
    $fields["SYSTEM_TYPE"]         =    "3";
    db::db_insert("TEST_DATA_RES", $fields, 'PK_ID', 'PK_ID');


    $token = 1;
    if ($token == 1) {
        $link = '';
        $obj = array();
        $sql_check_case = "SELECT *FROM M_CHECK_CASE_REVIVE  a WHERE a.PAGE_CODE='" . $PAGE_CODE . "' ";
        //echo  $sql_check_case;
        $query_check_case = db::query($sql_check_case);
        while ($rec_check_case = db::fetch_array($query_check_case)) {
            if ($rec_check_case['URL_CODE_PERSON'] == "http://103.208.27.224:81/led_service_api/public/search_data_WH.php") {
                $array_check = explode(",", $rec_check_case['NOTE_PERSON']); //แปลงข้อมูล เป็นarray เพื่อเช็คค่า
                if (in_array("REGISTERCODE", $array_check)) {
                    if ($REGISTERCODE != '') { //รหัสบัตรประชาชน
                        $link .= "&REGISTERCODE=" . $REGISTERCODE;
                    }
                }
                if (in_array("CONCERN_CODE", $array_check)) {
                    if ($CONCERN_CODE != '') { //สถานะคน โจทย์ จำเลย
                        $link .= "&CONCERN_CODE=" . $CONCERN_CODE;
                    }
                }
                if (in_array("BLACK_CASE", $array_check)) {
                    $link .= "&T_BLACK_CASE=" . $dataSelectData['PREFIX_BLACK_CASE'] . "&BLACK_CASE=" . $dataSelectData['BLACK_CASE'] . "&BLACK_YY=" . $dataSelectData['BLACK_YY'];
                }
                if (in_array("RED_CASE", $array_check)) {
                    $link .= "&T_RED_CASE=" . $dataSelectData['PREFIX_RED_CASE'] . "&RED_CASE=" . $dataSelectData['RED_CASE'] . "&RED_YY=" . $dataSelectData['RED_YY'];
                }
                if (in_array("COURT_CODE", $array_check)) {
                    $link .= "&COURT_CODE=" . $dataSelectData['COURT_CODE'] . "&COURT_NAME=" . $dataSelectData['COURT_NAME'];
                }
                $link .= "&WFR_API=" . $WFR_API;
                $link .= "&DATA_SEARCH=ALL";
                $obj[] = $rec_check_case['URL_CODE_PERSON'] . "?1=1" . $link;
                // $obj[] = $rec_check_case['URL_CODE'] . "?CODE=" . base64_encode($link);
            }
        }
    }
}

$num = count($obj);

if ($num > 0) {
    $row['ResponseCode'] = array('ResCode' => '000', 'ResMeassage' => "SUCCESS");
    $row['link'] = $obj;
} else {
    $row['ResponseCode'] = array('ResCode' => '102', 'ResMeassage' => "NOT FOUND");
}

echo json_encode($row);
