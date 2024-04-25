<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';

$PREFIX_BLACK_CASE = conText($_POST['PREFIX_BLACK_CASE']);
$BLACK_CASE = conText($_POST['BLACK_CASE']);
$BLACK_YY = conText($_POST['BLACK_YY']);
$PREFIX_RED_CASE = conText($_POST['PREFIX_RED_CASE']);
$RED_CASE = conText($_POST['RED_CASE']);
$RED_YY = conText($_POST['RED_YY']);

$field = array(
    'PREFIX_BLACK_CASE' => $PREFIX_BLACK_CASE,
    'BLACK_CASE' => $BLACK_CASE,
    'BLACK_YY' => $BLACK_YY,
    'PREFIX_RED_CASE' => $PREFIX_RED_CASE,
    'RED_CASE' => $RED_CASE,
    'RED_YY' => $RED_YY,
);

// db::db_insert("Table", $field, "primaryKey", "");

$txt['result'] = 'success';
echo json_encode($txt);
