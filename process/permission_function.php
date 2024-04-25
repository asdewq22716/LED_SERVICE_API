<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';


$table = 'USR_ACCESS';
$pk_name = 'ACCESS_ID';
$num_rows = conText($_POST['num_rows']);
$U_ID = conText($_POST['U_ID']);
$USR_TYPE = conText($_POST['USR_TYPE']);
$url_back = "permission_list.php?U_ID=".$U_ID."&USR_TYPE=".$USR_TYPE;
if($num_rows > 0){
	
	for($i=1;$i<$num_rows;$i++){
		$WF_SELECT = conText($_POST['WF_SELECT'.$i]);
		$WF_MAIN_ID = conText($_POST['WF_MAIN_ID'.$i]);
		$ACC_TYPE = conText($_POST['ACC_TYPE'.$i]);
		
		$query_acc = db::query("SELECT ACCESS_ID FROM USR_ACCESS WHERE ACCESS_TYPE = '".$ACC_TYPE."' AND ACCESS_REF_ID = '".$WF_MAIN_ID."' AND USR_TYPE = '".$USR_TYPE."' AND USR_REF_ID = '".$U_ID."' ");
		$acc = db::fetch_array($query_acc);
		
		if($WF_SELECT == 'Y'){
			if($acc["ACCESS_ID"] == ''){
				$a_data['ACCESS_TYPE'] = $ACC_TYPE;
				$a_data['ACCESS_REF_ID'] = $WF_MAIN_ID;
				$a_data['USR_TYPE'] = $USR_TYPE;
				$a_data['USR_REF_ID'] = $U_ID;
				db::db_insert($table, $a_data, $pk_name);
				unset($a_data);
			}else{
				
			}
		}else{
			if($acc["ACCESS_ID"] != ''){
				$a_cond[$pk_name] = $acc["ACCESS_ID"];
				db::db_delete($table, $a_cond);
				
			}else{
				
			}
			
		}

?>




<?php
	}
}

db::db_close();
redirect($url_back);
?>