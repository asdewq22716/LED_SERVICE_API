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
	if($PARENT == ""){ $PARENT = 0; }
	$order = db::get_max($table, "MENU_ORDER", array("MENU_PARENT"=>$PARENT));
	if($order > 0){
		$order++;
	}else{
		$order = 0;
	}
	$insert_wf = array();
	$insert_wf['MENU_NAME'] = conText($_GET["text"]);
	$insert_wf['MENU_PARENT'] = $PARENT;
	$insert_wf['MENU_STATUS'] = "Y";
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
if($Flag == "Move"){
	$PARENT = conText($_GET["parent_id"]);
	if($PARENT == "#" OR $PARENT == ""){ $PARENT = 0; }
	db::query("UPDATE WF_MENU_TEMP SET MENU_ORDER = MENU_ORDER+1 WHERE MENU_PARENT = '".$PARENT."' AND MENU_ORDER >= '".$_GET['position']."'");
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
			$insert_wf['MENU_ORDER'] = $order;
			$M_ID = db::db_insert($table, $insert_wf, "MENU_ID");
			unset($insert_wf);
			$array_a[$x]['id'] = conText($M_ID);
			$array_a[$x]['parent'] = $MENU_ID;
			$array_a[$x]['text'] = $WF['WF_MAIN_NAME'];
			$order++;
			$x++;
			}
		}
	}
	echo json_encode($array_a,JSON_NUMERIC_CHECK);
}
db::db_close();
?>