<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$W = conText($_POST['W']);
$process = conText($_REQUEST['process']);

 
$table = "WF_WIDGET";
 

if($process == "re_order")
{
	$data_grid = json_decode($_POST['re_order_grid'], true);
	foreach($data_grid as $_val)
	{
		$a_data['WG_POS_X'] = $_val['f_offset'];
		$a_data['WG_POS_Y'] = $_val['f_position'];
		$a_data['WG_POS_W'] = $_val['f_width'];
		$a_data['WG_POS_H'] = $_val['f_height'];

		$a_cond['WG_ID'] = $_val['f_id'];

		db::db_update($table, $a_data, $a_cond);
	}
	echo "Y";
db::db_close();
exit;
}
db::db_close();
?>