<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';

db::db_update('M_API_LIST', array('API_STATUS' => $_POST['STATUS']), array('API_LIST_ID' => $_POST['ID']));

$txt['result'] = 'success';
echo json_encode($txt);
