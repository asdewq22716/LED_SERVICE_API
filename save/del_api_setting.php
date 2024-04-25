<?php
 $HIDE_HEADER = "Y";
include '../include/comtop_user.php';
print_pre($_REQUEST['del_id']);
$id['API_SETTING_ID'] = $_POST['del_id'];
db::db_delete("M_API_SETTING", $id);

$lis_id['API_SETTING_ID'] = $_POST['del_id'];
db::db_delete("M_API_LIST", $lis_id);
?>
