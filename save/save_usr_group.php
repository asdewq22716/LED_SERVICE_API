<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';
// print_pre($_POST);

$cond['USR_ID'] = $_POST['usr_id'];
$data['PERMISSION_GROUP_ID'] = $_POST['group_id'];

db::db_update("USER_API_SERVICE",$data,$cond);
?>
