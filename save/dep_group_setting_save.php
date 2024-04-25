<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php'; 

$process = conText($_POST['process']);
$DEP_GROUP_ID = conText($_POST['DEP_GROUP_ID']);
$num_rows = conText($_POST['num_i']);

//$table = 'USR_GROUP_SETTING';
$table = 'M_DEP_GROUP_SETTING';
$pk_name = 'DGS_ID';

if($process == 'DEP_SETTING'){

	//print_pre($_POST);exit;
	$USR_ID = conText($_POST["USR_ID"]);
	for($i=1; $i<$num_rows; $i++){

		$DEP_GROUP_ID = conText($_POST["DEP_GROUP_ID".$i]);
		$setting_check = conText($_POST["setting_check".$i]);
		$DGS_ID = conText($_POST["DGS_ID".$i]);

		if($setting_check == "Y"){
			
			$sql_chk = db::query("SELECT DGS_ID FROM M_DEP_GROUP_SETTING WHERE DEP_GROUP_ID = '".$DEP_GROUP_ID."' AND USR_ID = '".$USR_ID."'");
			$rec_chk = db::fetch_array($sql_chk);
			
			if($rec_chk['DGS_ID'] == ''){
				
				$a_data['DEP_GROUP_ID'] = $DEP_GROUP_ID;
				$a_data['USR_ID'] = $USR_ID;
				db::db_insert($table, $a_data, $pk_name);

			}

		}else{

			$a_cond[$pk_name] = $DGS_ID;
			db::db_delete($table, $a_cond);

		}

	}

}

db::db_close();
?>