<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$process = $_REQUEST['process'];
$table = "WF_STEP_CON";
$pk_name = "WFSC_ID";
$WFD_DEFAULT_STEP =  conText($_POST["WFD_DEFAULT_STEP"]);
$WFD =  conText($_POST["WFD"]);

if($process == 'ADD_STEP_CON'){
	$a_data['WFD_DEFAULT_STEP'] = $WFD_DEFAULT_STEP;
	$a_cond['WFD_ID'] = $WFD;
	db::db_update('WF_DETAIL', $a_data, $a_cond);
	unset($a_data);
	unset($a_cond);
	
	for($i=0;$i<$_POST["num_k"];$i++){
		$a_data = array();
		$a_cond = array();
		
		$WFSC_VAR =  conText($_POST["WFSC_VAR".$i]);
		$WFSC_VALUE =  conText($_POST["WFSC_VALUE".$i]);
		$WFSC_STEP =  conText($_POST["WFSC_STEP".$i]);
		$WFSC_OPERATE =  conText($_POST["WFSC_OPERATE".$i]);
		
		if($_POST["WF_CON_USE".$i] == "Y"){
			if($_POST["WFSC_ID".$i] ==""){
			
				$a_data['WFD_ID'] = $WFD;
				$a_data['WFSC_VAR'] = $WFSC_VAR;
				$a_data['WFSC_OPERATE'] = $WFSC_OPERATE;
				$a_data['WFSC_VALUE'] = $WFSC_VALUE;
				$a_data['WFSC_STEP'] = $WFSC_STEP;
				db::db_insert($table, $a_data, $pk_name);
				unset($a_data);
	
			}else{
			
				$a_data['WFD_ID'] = $WFD;
				$a_data['WFSC_VAR'] = $WFSC_VAR;
				$a_data['WFSC_OPERATE'] = $WFSC_OPERATE;
				$a_data['WFSC_VALUE'] = $WFSC_VALUE;
				$a_data['WFSC_STEP'] = $WFSC_STEP;
				$a_cond[$pk_name] = $_POST["WFSC_ID".$i];
				db::db_update($table, $a_data, $a_cond);
				unset($a_data);
				unset($a_cond);
			}
			
		}else{
			if($_POST["WFSC_ID".$i] !=""){
				$a_cond[$pk_name] = $_POST["WFSC_ID".$i];
				db::db_delete($table, $a_cond);
				unset($a_cond);
			}
		}
	}

}
db::db_close();
?>