<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$W = conText($_POST['W']);
$WFD_ID = conText($_POST['WFD']);
$WFS_ID = conText($_POST['WFS']);
$WF_TYPE = conText($_POST['WF_TYPE']);
$process = conText($_REQUEST['process']);

 
$table = "WF_STEP_FORM";
 

if($process == "re_order")
{
	$data_grid = json_decode($_POST['re_order_grid'], true);
	foreach($data_grid as $_val)
	{
		$sql = db::query("select WFS_COLUMN_LEFT,WFS_COLUMN_TYPE from WF_STEP_FORM where WFS_ID = '".$_val['f_id']."'");
		$rec = db::fetch_array($sql);
		if($rec["WFS_COLUMN_TYPE"] == "1")
		{
			$a_data['WFS_COLUMN_LEFT'] = $_val['f_width'];
			$a_data['WFS_COLUMN_RIGHT'] = 0;
		}
		else
		{
			$a_data['WFS_COLUMN_LEFT'] = $rec['WFS_COLUMN_LEFT'];
			$a_data['WFS_COLUMN_RIGHT'] = $_val['f_width'] - $rec['WFS_COLUMN_LEFT'];
		}
		$a_data['WFS_ORDER'] = ($_val['f_position'] + 1);
		$a_data['WFS_OFFSET'] = $_val['f_offset'];

		$a_cond['WFS_ID'] = $_val['f_id'];

		db::db_update($table, $a_data, $a_cond);
	}
	echo "Y";
db::db_close();
exit;
}
db::db_close();
?>