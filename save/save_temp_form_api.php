<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';

$type = $_POST['type'];
$API_SETTING_ID = $_POST['setting_id'];

if ($type == 1) {
    $W = 180;
    $API_STATUS = 0;
} else {
    $W = 181;
    $API_STATUS = 1;
}

$insert_wf = array();
$insert_wf = bsf_save_form($W, $WFD, $WFR, 'F', $insert_wf, 'Y', $WFS);
$insert_wf['API_SETTING_ID'] = $API_SETTING_ID;
$insert_wf['API_STATUS'] = $API_STATUS;

if ($_POST['API_LIST_ID']) {
    $pk = $_POST['API_LIST_ID'];
    db::db_update('M_API_LIST', $insert_wf, array('API_LIST_ID' => $pk));
} else {
    $pk = db::db_insert('M_API_LIST', $insert_wf, 'API_LIST_ID', 'API_LIST_ID');
}

if ($pk) {
    $txt['result'] = 'success';
} else {
    $txt['result'] = 'error';
}

echo json_encode($txt);
