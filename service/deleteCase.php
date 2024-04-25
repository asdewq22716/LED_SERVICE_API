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

$sqlSelectData = "select WH_MEDAITE_ID from WH_MEDIATE_CASE where REF_WFR_ID = '" . $POST['WFR']."W".$POST['W']. "' ";
$querySelectData = db::query($sqlSelectData);
$dataSelectData = db::fetch_array($querySelectData);


/* เก็บ log start */
$array_link = "";
foreach (json_decode($str_json, true) as $sh1 => $ch1) {
    $array_link .= "&" . $sh1 . "=" . $ch1;
}
unset($fields);
$fields["PAGE_CODE"]                 =    $POST['W'];
$fields["COLUMN1"]                 =     $array_link;
$fields["CREATE_DATE"]                 =    date("Y-m-d");
$fields["WFR"]                 =   "Delete";
db::db_insert("TEST_DATA_RES", $fields, 'PK_ID', 'PK_ID');
/* เก็บ log stop */
db::db_delete("WH_MEDIATE_CASE", array('WH_MEDAITE_ID' => $dataSelectData["WH_MEDAITE_ID"]));
db::db_delete("WH_MEDIATE_PERSON", array('WH_MEDIATE_ID' => $dataSelectData["WH_MEDAITE_ID"]));
db::db_delete("WH_MEDIATE_CASE_DETAIL", array('WH_MEDIATE_ID' => $dataSelectData["WH_MEDAITE_ID"]));

?>