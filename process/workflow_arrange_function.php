<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$process = $_REQUEST['process'];
$table = "WF_MAIN";
$pk_name = "WF_MAIN_ID";

if($process == "re_order")
{
	
	$TOTAL_ROW = conText($_POST['total_row']);
	
	for($i=1; $i<$TOTAL_ROW; $i++)
	{
		
		$WF_MAIN_STATUS = conText($_POST['WF_MAIN_STATUS'.$i]);
		$WF_MAIN_ORDER = conText($_POST['WF_MAIN_ORDER'.$i]);
		$id = conText($_POST['id'.$i]);

		
		$a_data['WF_MAIN_STATUS'] = $WF_MAIN_STATUS;
		$a_data['WF_MAIN_ORDER'] = $WF_MAIN_ORDER;
		/*$a_data['WF_BTN_ADD_STATUS'] = 'Y';
		$a_data['WF_BTN_CON_STATUS'] = 'Y';
		$a_data['WF_BTN_STEP_STATUS'] = 'Y';
		$a_data['WF_BTN_DEL_STATUS'] = 'Y';
		$a_data['WF_BTN_BACK_STATUS'] = 'Y';
		$a_data['WF_VIEW_COL_SHOW_NO'] = 'Y';*/
		$a_cond[$pk_name] = $id;
		
		db::db_update($table, $a_data, $a_cond);
		
	}
	echo 'Y';
	db::db_close();
	exit;
}

db::db_close();
?>