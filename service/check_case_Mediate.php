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
header('Content-Type: application/json');
include '../include/include.php';
include '../include/func_Nop.php';
include './check_case_Function.php';

$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);
/* $POST = $_REQUEST; */
$PAGE_CODE = $POST['W'];
$WFR_API = $POST['WFR'];
$SYSTEM_TYPE = $POST["systemCode"];
/* $REGISTERCODE = $POST["REGISTERCODE"]; */

if ($WFR_API != "") {
    $WFR = $WFR_API;
    $show_data = "";
    getMedToWh($WFR, $show_data);
    $sqlSelectData = "	SELECT *FROM WH_MEDIATE_CASE a 
                    WHERE a.REF_WFR_ID = " . $WFR_API . " 
						";
    $querySelectData = db::query($sqlSelectData);
    $dataSelectData = db::fetch_array($querySelectData);


    $sql_person_Med = "SELECT *FROM WH_MEDIATE_CASE a 
LEFT JOIN WH_MEDIATE_PERSON b  ON a.WH_MEDAITE_ID =b.WH_MEDIATE_ID 
WHERE a.REF_WFR_ID  = " . $WFR_API . "";
    $query_Med = db::query($sql_person_Med);
    $text_N = 1;
    $data_array_med = db::num_rows($query_Med);
    $REGISTERCODE = '';
    $CONCERN_CODE = '';
    $query_Med = db::query($sql_person_Med);
    $rec_WH = "";
    while ($rec_Med = db::fetch_array($query_Med)) {
        $REGISTERCODE .=  $rec_Med["REGISTER_CODE"] . ($data_array_med == $text_N ? "" : ",");
        $CONCERN_CODE .= $rec_Med["CONCERN_CODE"]  . ($data_array_med == $text_N ? "" : ",");
        $text_N++;
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
    $fields["SYSTEM_TYPE"]         =    "4";
    db::db_insert("TEST_DATA_RES", $fields, 'PK_ID', 'PK_ID');


    $token = 1;
    if ($token == 1) {
        $link = '';
        $obj = array();
        $sql_check_case = "SELECT *FROM M_CHECK_CASE_MEDIATE  a WHERE a.PAGE_CODE='" . $PAGE_CODE . "'  ";
        $query_check_case = db::query($sql_check_case);
        while ($rec_check_case = db::fetch_array($query_check_case)) {
            if ($rec_check_case['URL_CODE'] == "http://103.208.27.224:81/led_service_api/public/search_data_WH.php") {
                $array_check = explode(",", $rec_check_case['NOTE']); //แปลงข้อมูล เป็นarray เพื่อเช็คค่า
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
                $obj[] = $rec_check_case['URL_CODE'] . "?1=1" . $link;
                // $obj[] = $rec_check_case['URL_CODE'] . "?CODE=" . base64_encode($link);
            }
        }

        /* api order start */

        /*     $toPersonId = $POST['toPersonId'];
    $sql_DOC_CMD = "SELECT * FROM M_DOC_CMD A
                        LEFT JOIN M_CMD_SYSTEM B ON A.SYS_NAME = B.CMD_SYSTEM_ID
                        LEFT JOIN M_SERVICE_CMD C ON A.CASE_TYPE = C.CMD_TYPE_CODE
                        LEFT JOIN M_CMD_PERSON D ON	D.PERSON_ID = A.PERSON_ID
                        LEFT JOIN M_CMD_TYPE E ON C.CMD_TYPE_ID = E.CMD_TYPE_ID
                        WHERE 1 = 1	
                        AND NVL(A.REF_ID, 0) = 0 
                        AND A.OFFICE_IDCARD IS NOT NULL
                        AND A.TO_PERSON_ID ='" . $toPersonId . "'
                        ORDER BY	
                        A.CMD_DOC_DATE DESC,
                        A.CMD_DOC_TIME DESC";
    $query_DOC_CMD = db::query($sql_DOC_CMD);
    while ($rec_DOC_CMD = db::fetch_array($query_DOC_CMD)) {
        $AMOUNT += 1;
    }
    $obj_order = "http://103.208.27.224:81/led_service_api/service/search_data_cmd.php?1=1" . "&TO_PERSON_ID=" . $toPersonId; */

        /* api order stop */
    }
}

$num = count($obj);

if ($num > 0) {
    $row['ResponseCode'] = array('ResCode' => '000', 'ResMeassage' => "SUCCESS");
    $row['link'] = $obj;
} else {
    $row['ResponseCode'] = array('ResCode' => '102', 'ResMeassage' => "NOT FOUND");
    $row['link'] = $sql_check_case;
}

echo json_encode($row);
