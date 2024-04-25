
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

$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);



$token = 1;
if ($token == 1) {
    $link = '';
    $obj = array();
    $sql_check_case = "SELECT *FROM M_CHECK_CASE a WHERE a.PAGE_CODE='" . $POST['PAGE_CODE'] . "' ";
    $query_check_case = db::query($sql_check_case);
    while ($rec_check_case = db::fetch_array($query_check_case)) {
        if ($rec_check_case['URL_CODE'] == "http://103.208.27.224:81/led_service_api/public/search_data_WH.php") {
            $array_check = explode(",", $rec_check_case['NOTE']); //แปลงข้อมูล เป็นarray เพื่อเช็คค่า
            if (in_array("REGISTERCODE", $array_check)) {
                if (count($POST["PERSON_CONCERN"]) > 0) { //รหัสบัตรประชาชน
                    $link .= "&REGISTERCODE=" . $REGISTERCODE;
                }
            }
            if (in_array("CONCERN_CODE", $array_check)) {
                if (count($POST["PERSON_CONCERN"]) > 0) { //สถานะคน โจทย์ จำเลย
                    $link .= "&CONCERN_CODE=" . $CONCERN_CODE;
                }
            }
            if (in_array("BLACK_CASE", $array_check)) {
                if (!empty($POST['T_BLACK_CASE']) && !empty($POST['BLACK_CASE']) && !empty($POST['BLACK_YY'])) { //คดีดำ
                    $link .= "&T_BLACK_CASE=" . $POST['T_BLACK_CASE'] . "&BLACK_CASE=" . $POST['BLACK_CASE'] . "&BLACK_YY=" . $POST['BLACK_YY'];
                }
            }
            if (in_array("RED_CASE", $array_check)) {
                if (!empty($POST['T_RED_CASE']) && !empty($POST['RED_CASE']) && !empty($POST['RED_YY'])) { //คดีแดง
                    $link .= "&T_RED_CASE=" . $POST['T_RED_CASE'] . "&RED_CASE=" . $POST['RED_CASE'] . "&RED_YY=" . $POST['RED_YY'];
                }
            }
            if (in_array("COURT_CODE", $array_check)) {
                if (!empty($POST['COURT_CODE']) && $POST['COURT_NAME'] == "") { //ถ้า COURT_CODE ไม่เป็นค่าว่าง เเละCOURT_CODEเป็นค่าว่าง
                    $sql_count = "SELECT 		a.COURT_CODE,a.COURT_NAME
                FROM 		M_COURT a
                WHERE 		1=1
                AND a.COURT_ID ='" . $POST['COURT_CODE'] . "'
                ORDER BY 	a.COURT_CODE ASC";
                    $query_check_case = db::query($sql_check_case);
                    $rec_count = db::fetch_array($query_check_case);
                    $link .= "&COURT_NAME=" . $rec_count['COURT_NAME'];
                } else {
                    $link .= "&COURT_NAME=" . $POST['COURT_NAME'];
                }
            }
            $obj[] = $rec_check_case['URL_CODE'] . "?1=1" . $link;
        }
    }
}

$num = count($obj);

if ($num > 0) {

    $row['ResponseCode'] = array('ResCode' => '000', 'ResMeassage' => "SUCCESS");
    $row['link'] = $obj;
    $row['variable'] = $array_check;
} else {

    $row['ResponseCode'] = array('ResCode' => '102', 'ResMeassage' => "NOT FOUND");
    $row['variable'] = "PAGE_CODE";
}

echo json_encode($row);
