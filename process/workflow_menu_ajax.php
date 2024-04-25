<?php
error_reporting(E_ALL & ~E_NOTICE);
header('Content-Type: application/json');
$HIDE_HEADER = 'Y';
include '../include/comtop_admin.php'; 

$Flag = conText($_REQUEST["Flag"]);
$table = "WF_MENU_TEMP";
$array_a = array();

if($Flag == "Add"){
	$PARENT = conText($_GET["parent_id"]);
	if($PARENT == "#" OR $PARENT == ""){ $PARENT = 0; }
	$sql_max = db::query("SELECT MAX(MENU_ORDER) AS MX FROM ".$table." WHERE MENU_PARENT = '".$PARENT."'");
	$O = db::fetch_array($sql_max);
	
	if($O['MX'] != ''){
		$order = $O['MX']+1;
	}else{
		$order = 0;
	}
	if(conText($_GET["type"])=="file"){ $type = "file"; }else{ $type = ""; }
	$insert_wf = array();
	$insert_wf['MENU_NAME'] = conText($_GET["text"]);
	$insert_wf['MENU_PARENT'] = $PARENT;
	$insert_wf['MENU_STATUS'] = "Y";
	$insert_wf['MENU_FLAG'] = $type;
	$insert_wf['MENU_ORDER'] = $order;
	$MENU_ID = db::db_insert($table, $insert_wf, "MENU_ID");
	unset($insert_wf);
	$array_a['id'] = $MENU_ID;
	echo json_encode($array_a,JSON_NUMERIC_CHECK);
}
if($Flag == "Rename"){
	$update_wf = array();
	$update_wf['MENU_NAME'] = conText($_GET["text"]);
	$wf_cond["MENU_ID"] = conText($_GET["id"]);
	db::db_update($table, $update_wf, $wf_cond);
	unset($update_wf);
	unset($wf_cond);
	$array_a['id'] = conText($_GET["id"]);
	echo json_encode($array_a,JSON_NUMERIC_CHECK);
}
if($Flag == "Active"){
	db::query("UPDATE WF_CONFIG SET CONFIG_VALUE = '".conText($_POST["MenuUse"])."' WHERE CONFIG_NAME = 'wf_show_menu' ");
	$array_a['id'] = "1";
	echo json_encode($array_a,JSON_NUMERIC_CHECK);
}
if($Flag == "Move"){
	$PARENT = conText($_GET["parent_id"]);
	$m_order = 0;
	if($PARENT == "#" OR $PARENT == ""){ $PARENT = 0; }
	$sql_order = db::query("SELECT MENU_ID FROM WF_MENU_TEMP WHERE MENU_PARENT = '".$PARENT."' AND MENU_ID != '".conText($_GET["id"])."' ORDER BY MENU_ORDER ");
	while($M=db::fetch_array($sql_order)){
		if($_GET['position'] == $m_order){ $m_order++; }
		$update_wf = array();
		$update_wf['MENU_ORDER'] = $m_order;
		$wf_cond["MENU_ID"] = $M["MENU_ID"];
		db::db_update($table, $update_wf, $wf_cond);
		unset($update_wf);
		unset($wf_cond);
		$m_order++;
	}
	//db::query("UPDATE WF_MENU_TEMP SET MENU_ORDER = MENU_ORDER+1 WHERE MENU_PARENT = '".$PARENT."' AND MENU_ORDER >= '".$_GET['position']."'");
	$update_wf = array();
	$update_wf['MENU_PARENT'] = $PARENT;
	$update_wf['MENU_ORDER'] = $_GET['position'];
	$wf_cond["MENU_ID"] = conText($_GET["id"]);
	db::db_update($table, $update_wf, $wf_cond);
	unset($update_wf);
	unset($wf_cond);
	
	$array_a['id'] = conText($_GET["id"]);
	echo json_encode($array_a,JSON_NUMERIC_CHECK);
}
if($Flag == "Remove" AND conText($_GET["id"]) != ""){
	
	function del_menu_tmp($mid){
		$sql_t = db::query("SELECT MENU_ID FROM WF_MENU_TEMP WHERE MENU_PARENT = '".$mid."'");
		while($M=db::fetch_array($sql_t)){
			del_menu_tmp($M['MENU_ID']);
		}
		db::query("DELETE FROM WF_MENU_TEMP WHERE MENU_ID = '".$mid."'");
	} 
	del_menu_tmp(conText($_GET["id"]));
	$array_a['id'] = conText($_GET["id"]);
	echo json_encode($array_a,JSON_NUMERIC_CHECK);

}
if($Flag == "AddGroup"){

	$MENU_ID = conText($_POST['MENU_ID']);
	$num_rows = conText($_POST['num_rows']);
	
	if($MENU_ID == ""){ $MENU_ID = 0; }
	$order = db::get_max($table, "MENU_ORDER", array("MENU_PARENT"=>$MENU_ID));
	if($order > 0){
		$order++;
	}else{
		$order = 0;
	}
	$x=0;
	if(count($_POST['WF_SELECT'] > 0)){
		for($i=0; $i<$num_rows; $i++)
		{
			
			$WF_MAIN_ID = conText($_POST['WF_SELECT'][$i]);
			if($WF_MAIN_ID != ""){
			$sql_name = db::query("select WF_MAIN_ID,WF_TYPE,WF_MAIN_NAME,WF_MENU from WF_MAIN where WF_MAIN_ID = '".$WF_MAIN_ID."' ");
			$WF = db::fetch_array($sql_name);
			$insert_wf = array();
			$insert_wf['MENU_NAME'] = $WF['WF_MAIN_NAME'];
			$insert_wf['MENU_PARENT'] = $MENU_ID;
			$insert_wf['MENU_STATUS'] = "Y";
			$insert_wf['MENU_FLAG'] = "file";
			$insert_wf['MENU_ORDER'] = $order;
			$insert_wf['MENU_TYPE'] = "W";
			$insert_wf['WF_MAIN_ID'] = $WF['WF_MAIN_ID'];
			$M_ID = db::db_insert($table, $insert_wf, "MENU_ID");
			unset($insert_wf);
			$array_a[$x]['id'] = conText($M_ID);
			$array_a[$x]['parent'] = $MENU_ID;
			$array_a[$x]['text'] = $WF['WF_MAIN_NAME'];
			$array_a[$x]['type'] = 'file';
			$order++;
			$x++;
			}
		}
	}
	echo json_encode($array_a,JSON_NUMERIC_CHECK);
}
if($Flag == "Menu_Detail"){

	$MENU_ID = conText($_POST['MENU_ID']);
	
	$update_wf = array();
	$update_wf['MENU_NAME'] = conText($_POST["MENU_NAME"]);
	$update_wf['MENU_SHOW'] = conText($_POST["MENU_SHOW"]);
	$update_wf['MENU_TYPE'] = conText($_POST["MENU_TYPE"]);
	$update_wf['WF_MAIN_ID'] = conText($_POST["WF_MAIN_ID"]);
	$update_wf['MENU_URL'] = conText($_POST["MENU_URL"]);
	$update_wf['MENU_ICON'] = conText($_POST["MENU_ICON"]);
	$update_wf['MENU_TARGET'] = conText($_POST["MENU_TARGET"]);
	$update_wf['MENU_S_ICON'] = conText($_POST["MENU_S_ICON"]);
	
	$wf_cond["MENU_ID"] = $MENU_ID;
	db::db_update($table, $update_wf, $wf_cond);
	unset($update_wf);
	unset($wf_cond);
	
	$array_a['id'] = $MENU_ID;
	if(conText($_POST["MENU_NAME_OLD"]) != conText($_POST["MENU_NAME"])){
		$array_a['change'] = "Y";
		$array_a['menu'] = conText($_POST["MENU_NAME"]);
	}else{
		$array_a['change'] = "N";
		$array_a['menu'] = conText($_POST["MENU_NAME"]);
	}
	echo json_encode($array_a,JSON_NUMERIC_CHECK);
}
if($Flag == "Apply"){

	db::query("DELETE FROM WF_MENU");
	$sql_load = db::query("SELECT * FROM WF_MENU_TEMP ORDER BY MENU_ID");
	while($M = db::fetch_array($sql_load)){
		$insert_wf = array();
		foreach($M as $key=>$val){
			if(!is_numeric($key)){
			$insert_wf[$key] = $val;
			}
		}
		db::db_insert("WF_MENU", $insert_wf, "MENU_ID");
		unset($insert_wf);
	}
	
	$array_a['id'] = 'Y';

	echo json_encode($array_a,JSON_NUMERIC_CHECK);
}
db::db_close();
?>