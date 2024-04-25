<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$table = 'USR_ACCESS';
$pk_name = 'ACCESS_ID';
$id = '';

$ACCESS_TYPE = conText($_POST['ACCESS_TYPE']);
$ACCESS_REF_ID = conText($_POST['ACCESS_REF_ID']);
$USR_TYPE = conText($_POST['USR_TYPE']);
$USR_REF_ID = conText($_POST['USR_REF_ID']);


if($_REQUEST['process'] == 'ADD'){
	for($i=1; $i < $_POST["num_i"]; $i++){	
		if($_POST["access_check".$i] == 'Y' ){
			if($_POST["ac_id".$i] == "" )	{
				$a_data['ACCESS_TYPE'] = $ACCESS_TYPE;
				$a_data['ACCESS_REF_ID'] = $ACCESS_REF_ID;
				$a_data['USR_TYPE'] = $USR_TYPE;
				$a_data['USR_REF_ID'] = $USR_REF_ID;
				$a_data['USR_REF_ID'] = $_POST["u_id".$i];
				db::db_insert($table, $a_data, $pk_name);
				
			}
		}else{
			if($_POST["ac_id".$i] != "" )	{
				$a_cond[$pk_name] = $_POST["ac_id".$i];
				db::db_delete($table, $a_cond);
			}
		}
	}
}


db::db_close();
?>