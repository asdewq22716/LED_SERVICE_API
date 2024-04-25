<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$process = conText($_POST['process']);
$GROUP_ID = conText($_POST['GROUP_ID']);
$num_rows = conText($_POST['num_i']);

$table = 'USR_GROUP_SETTING';
$pk_name = 'UGS_ID';

if($process == 'GROUP_SETTING'){
	
	for($i=1; $i<$num_rows; $i++){
		
		$setting_check = conText($_POST["setting_check".$i]);
		$USR_ID = conText($_POST["USR_ID".$i]);
		$UGS_ID = conText($_POST["UGS_ID".$i]);
		if($setting_check == 'Y')
		{
			$sql_chk = db::query("SELECT UGS_ID AS TOTAL FROM USR_GROUP_SETTING WHERE GROUP_ID = '".$GROUP_ID."' AND USR_ID = '".$USR_ID."'");
			$rec_chk = db::fetch_array($sql_chk);
		
			if($rec_chk['UGS_ID'] == '')
			{
				$a_data['GROUP_ID'] = $GROUP_ID;
				$a_data['USR_ID'] = $USR_ID;
				db::db_insert($table, $a_data, $pk_name);
			}
		}
		else
		{
			$a_cond[$pk_name] = $UGS_ID;
			db::db_delete($table, $a_cond);
		}
		
		
	}
	
}elseif($process == 'USR_SETTING'){
	//print_pre($_POST);exit;
	$USR_ID = conText($_POST["USR_ID"]);
	for($i=1; $i<$num_rows; $i++){
		$GROUP_ID = conText($_POST["GROUP_ID".$i]);
		$setting_check = conText($_POST["setting_check".$i]);
		$UGS_ID = conText($_POST["UGS_ID".$i]);
		if($setting_check == "Y"){
			$sql_chk = db::query("SELECT UGS_ID FROM USR_GROUP_SETTING WHERE GROUP_ID = '".$GROUP_ID."' AND USR_ID = '".$USR_ID."'");
			$rec_chk = db::fetch_array($sql_chk);
			
			if($rec_chk['UGS_ID'] == ''){
				
				$a_data['GROUP_ID'] = $GROUP_ID;
				$a_data['USR_ID'] = $USR_ID;
				db::db_insert($table, $a_data, $pk_name);

			}
		}else{
			$a_cond[$pk_name] = $UGS_ID;
			db::db_delete($table, $a_cond);
		}
	}

}

include '../include/combottom_admin.php'; ?>