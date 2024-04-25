<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';

db::db_update('M_API_SETTING', array('API_SQL' => $_POST['SQL']), array('API_SETTING_ID' => $_POST['API_LIST_ID']));

$txt['result'] = 'success';
echo json_encode($txt);
