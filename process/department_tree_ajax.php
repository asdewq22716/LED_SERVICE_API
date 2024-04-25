<?php
error_reporting(E_ALL & ~E_NOTICE);
header('Content-Type: application/json');
$HIDE_HEADER = 'Y';
include '../include/comtop_admin.php'; 

$Flag = conText($_REQUEST["Flag"]);
$table = "USR_DEPARTMENT";
$array_a = array();

if($Flag == "Add"){
	$PARENT = conText($_GET["parent_id"]);
	if($PARENT == "#" OR $PARENT == ""){ $PARENT = 0; }
	$sql_max = db::query("SELECT MAX(DEP_ORDER) AS MX FROM ".$table." WHERE DEPT_PARENT_ID = '".$PARENT."'");
	$O = db::fetch_array($sql_max);
	
	if($O['MX'] != ''){
		$order = $O['MX']+1;
	}else{
		$order = 0;
	}
	if(conText($_GET["type"])=="file"){ $type = "file"; }else{ $type = ""; }
	$insert_wf = array();
	$insert_wf['DEP_NAME'] = conText($_GET["text"]);
	$insert_wf['DEPT_PARENT_ID'] = $PARENT;
	$insert_wf['DEP_STATUS'] = "Y";
	$insert_wf['DEP_ORDER'] = $order;
	$DEP_ID = db::db_insert($table, $insert_wf, "DEP_ID");
	unset($insert_wf);
	$array_a['id'] = $DEP_ID;
	echo json_encode($array_a,JSON_NUMERIC_CHECK);
}
if($Flag == "Rename"){
	$update_wf = array();
	$update_wf['DEP_NAME'] = conText($_GET["text"]);
	$wf_cond["DEP_ID"] = conText($_GET["id"]);
	db::db_update($table, $update_wf, $wf_cond);
	unset($update_wf);
	unset($wf_cond);
	$array_a['id'] = conText($_GET["id"]);
	echo json_encode($array_a,JSON_NUMERIC_CHECK);
}
if($Flag == "Move"){
	$PARENT = conText($_GET["parent_id"]);
	$m_order = 0;
	if($PARENT == "#" OR $PARENT == ""){ $PARENT = 0; }
	$sql_order = db::query("SELECT DEP_ID FROM USR_DEPARTMENT WHERE DEPT_PARENT_ID = '".$PARENT."' AND DEP_ID != '".conText($_GET["id"])."' ORDER BY DEP_ORDER ");
	while($M=db::fetch_array($sql_order)){
		if($_GET['position'] == $m_order){ $m_order++; }
		$update_wf = array();
		$update_wf['DEP_ORDER'] = $m_order;
		$wf_cond["DEP_ID"] = $M["DEP_ID"];
		db::db_update($table, $update_wf, $wf_cond);
		unset($update_wf);
		unset($wf_cond);
		$m_order++;
	}
	$update_wf = array();
	$update_wf['DEPT_PARENT_ID'] = $PARENT;
	$update_wf['DEP_ORDER'] = $_GET['position'];
	$wf_cond["DEP_ID"] = conText($_GET["id"]);
	db::db_update($table, $update_wf, $wf_cond);
	unset($update_wf);
	unset($wf_cond);
	
	$array_a['id'] = conText($_GET["id"]);
	echo json_encode($array_a,JSON_NUMERIC_CHECK);
}
if($Flag == "Remove" AND conText($_GET["id"]) != ""){
	
	function del_dep($mid){
		$sql_t = db::query("SELECT DEP_ID FROM USR_DEPARTMENT WHERE DEPT_PARENT_ID = '".$mid."'");
		while($M=db::fetch_array($sql_t)){
			del_dep($M['DEP_ID']);
		}
		db::query("DELETE FROM USR_DEPARTMENT WHERE DEP_ID = '".$mid."'");
	} 
	del_dep(conText($_GET["id"]));
	$array_a['id'] = conText($_GET["id"]);
	echo json_encode($array_a,JSON_NUMERIC_CHECK);

}
if($Flag == "Dep_Detail"){

	$DEP_ID = conText($_POST['DEP_ID']);
	
	$update_wf = array();
	$update_wf['DEP_NAME'] = conText($_POST["DEP_NAME"]);
	$update_wf['DEP_CODE'] = conText($_POST["DEP_CODE"]);
	$update_wf['DEP_SHORT_NAME'] = conText($_POST["DEP_SHORT_NAME"]);
	$update_wf['DEP_STATUS'] = conText($_POST["DEP_STATUS"]);
	
	$wf_cond["DEP_ID"] = $DEP_ID;
	db::db_update($table, $update_wf, $wf_cond);
	unset($update_wf);
	unset($wf_cond);
	
	$array_a['id'] = $DEP_ID;
	if(conText($_POST["DEP_NAME_OLD"]) != conText($_POST["DEP_NAME"])){
		$array_a['change'] = "Y";
		$array_a['menu'] = conText($_POST["DEP_NAME"]);
	}else{
		$array_a['change'] = "N";
		$array_a['menu'] = conText($_POST["DEP_NAME"]);
	}
	echo json_encode($array_a,JSON_NUMERIC_CHECK);
}
db::db_close();
?>