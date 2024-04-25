<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';
$arr = json_decode($_POST['save_data'], true);
$pk_name = conText($_POST['PK_MIAN']);
$wf_table = conText($_POST['TB_MIAN']);
foreach($arr['data'] as $data_k){
	$insert_wf = array();
	$wf_cond = array();
	$is_null = "Y";
	foreach($data_k as $key=>$val){
		if($key != "WFR"){
		$insert_wf[$key] = $val;
			if($val != ""){
				$is_null = "N";
			}
		}
	}
	if($data_k['WFR'] == ''){
		if($is_null == "N"){	
		db::db_insert($wf_table, $insert_wf, $pk_name);
		}
	}else{
		$wf_cond[$pk_name] = $data_k['WFR'];
		db::db_update($wf_table, $insert_wf, $wf_cond);	
	}
	unset($insert_wf);
	unset($wf_cond);
}
include '../include/combottom_user.php'; ?>