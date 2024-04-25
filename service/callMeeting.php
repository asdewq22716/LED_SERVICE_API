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



$idCard = $POST['idCard'];
$startDate = $POST['startDate'];
$endDate =!empty($POST['endDate'])?$POST['endDate']:date("Y-m-d");

/* update civil calendar */
civil::getAppointmentInCivil($idCard, $startDate, $endDate);

$fill = "";
if (!empty($startDate)) {
    $fill .= "AND a.UPDATE_DATE >= TO_DATE('" . $startDate . "', 'YYYY-MM-DD')";
}
if (!empty($endDate)) {
    $fill .= "AND a.UPDATE_DATE <= TO_DATE('" . $endDate . "', 'YYYY-MM-DD')";
}
if ($idCard != "") {
    $sql = "SELECT * FROM M_MEETING a WHERE a.APP_PERSON_IDCARD='" . $idCard . "' {$fill} ORDER BY a.MEETING_ID DESC ";
}

function get_data_civil($CODE_API)
{
    $sql = "SELECT a.PREFIX_BLACK_CASE ,a.BLACK_CASE ,a.BLACK_YY ,a.PREFIX_RED_CASE ,a.RED_CASE ,a.RED_YY ,a.COURT_NAME
    FROM WH_CIVIL_CASE a WHERE a.CIVIL_CODE = '" . $CODE_API . "'";
    $query = db::query($sql);
    $rec = db::fetch_array($query);
    $text="";
    $text.="คดีดำ ".$rec['PREFIX_BLACK_CASE'].$rec['BLACK_CASE']."/".$rec['BLACK_YY']."";
    $text.="คดีแดง ".$rec['PREFIX_RED_CASE'].$rec['RED_CASE']."/".$rec['RED_YY']."";
    $text.=" ".$rec['COURT_NAME'];
    return $text;
}

$query = db::query($sql);
$num_calendar = db::num_rows($query);
$obj = array();
while ($rec = db::fetch_array($query)) {
    $obj[] = [
        "MEETING_ID" => $rec["MEETING_ID"],
        "MEETING_TYPE" => $rec["MEETING_TYPE"],
        "MEETING_TOPIC" => $rec["MEETING_TOPIC"],
        "MEETING_DETAIL" => ($rec["SYSTEM_ID"]=='1')?$rec["MEETING_DETAIL"].get_data_civil($rec["CODE_API"]):$rec["MEETING_DETAIL"],
        "MEETING_SDATE" => date("Y-m-d", strtotime($rec["MEETING_SDATE"])),
        "MEETING_SDATE_TIME" => $rec["MEETING_SDATE_TIME"],
        "MEETING_EDATE" => date("Y-m-d", strtotime($rec["MEETING_EDATE"])),
        "MEETING_EDATE_TIME" => $rec["MEETING_EDATE_TIME"],
        "CREATE_BY_ID_CARD" => $rec["CREATE_BY_ID_CARD"],
        "CREATE_BY_NAME" => $rec["CREATE_BY_NAME"],
        "CREATE_DATE" => date("Y-m-d", strtotime($rec["CREATE_DATE"])),
        "CREATE_DATE_TIME" => $rec["CREATE_DATE_TIME"],
        "UPDATE_DATE" => date("Y-m-d", strtotime($rec["UPDATE_DATE"])),
        "UPDATE_DATE_TIME" => $rec["UPDATE_DATE_TIME"],
        "APP_PERSON_IDCARD" => $rec["APP_PERSON_IDCARD"],
        "APP_PERSON_NAME" => $rec["APP_PERSON_NAME"],
        "MEETING_LOCATION" => $rec["MEETING_LOCATION"],
        "CODE_API" => $rec["CODE_API"]
    ];
}


if ($num_calendar > 0) {
    $row['ResponseCode'] = array('ResCode' => '000', 'ResMeassage' => "SUCCESS");
    $row['Data'] = $obj;
} else {
    $row['ResponseCode'] = array('ResCode' => '102', 'ResMeassage' => "NOT FOUND");
    $row['status'] = "NO";
    $row['sql'] = $sql;
}

echo json_encode($row);
