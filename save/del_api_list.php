<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';

$API_LIST_ID = $_POST['API_LIST_ID'];

if ($API_LIST_ID != '') {
    db::db_delete('M_API_LIST', array('API_LIST_ID' => $API_LIST_ID));
    $txt['result'] = 'success';
} else {
    $txt['result'] = 'error';
}
echo json_encode($txt);
