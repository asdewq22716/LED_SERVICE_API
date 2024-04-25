<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';

$GUARANTEE = conText($_POST['GUARANTEE']);
$SEQ_NO = conText($_POST['SEQ_NO']);
$DETAIL = conText($_POST['DETAIL']);
$LOCATION = conText($_POST['LOCATION']);

$field = array(
    'GUARANTEE' => $GUARANTEE,
    'SEQ_NO' => $SEQ_NO,
    'DETAIL' => $DETAIL,
    'LOCATION' => $LOCATION,
);

// db::db_insert("Table", $field, "primaryKey", "");

$txt['result'] = 'success';
echo json_encode($txt);
