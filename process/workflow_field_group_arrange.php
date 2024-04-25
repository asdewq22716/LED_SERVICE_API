<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$process = conText($_POST['process']);
$table = "WF_FIELD_GROUP";
$pk_name = "FIELD_G_ID";

$W = conText($_POST['W']);
$WFD = conText($_POST['WFD']);
$FIELD_G_NAME = conText($_POST['FIELD_G_NAME']);
$FIELD_G_ORDER = conText($_POST['FIELD_G_ORDER']);

if($process == "re_order")
{

	for($i=1; $i<$_POST['total_group']; $i++)
	{
		$id = '';
		$FIELD_G_ORDER = conText($_POST['FIELD_G_ORDER'.$i]);
		$id = conText($_POST['id'.$i]);

		$a_data['FIELD_G_ORDER'] = $FIELD_G_ORDER;

		$a_cond[$pk_name] = $id;

		db::db_update($table, $a_data, $a_cond);
	}
	echo 'Y';
db::db_close(); 
exit;
}

db::db_close();
?>