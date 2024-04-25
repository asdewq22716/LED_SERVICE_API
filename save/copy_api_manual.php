<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';

// print_pre($_POST);
unset($data);

$api_setting_id = $_POST['api_setting_id'];

$data['SERVICE_ID'] = $_POST['service_id'];
$data['SERVICE_CODE'] = $_POST['service_code'];
$data['SERVICE_LIST'] = $_POST['setting_name'];
$data['API_STATUS'] = $_POST['setting_status'];
$data['API_DESC'] = conText($_POST['api_desc']);

$API_SETTING_ID = db::db_insert("M_API_SETTING", $data, "API_SETTING_ID", "API_SETTING_ID");

$sql = "SELECT * FROM M_API_LIST WHERE 1 = 1 AND API_SETTING_ID = '" . $api_setting_id . "' ORDER BY API_LIST_ID ASC";
$qry = db::query($sql);

while($rec_set = db::fetch_array($qry)){
    $feild['KEY'] = $rec_set['KEY'];
    $feild['TYPE'] = $rec_set['TYPE'];
    $feild['STATUS'] = $rec_set['STATUS'];
    $feild['API_DESC'] = $rec_set['API_DESC'];
    $feild['API_SETTING_ID'] = $API_SETTING_ID;
    $feild['API_STATUS'] = $rec_set['API_STATUS']; 

    db::db_insert("M_API_LIST", $feild, "API_LIST_ID");
}
$txt['result'] = 'success';
echo json_encode($txt);
