<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$W = conText($_POST['W']);
$VIEW = conText($_POST['VIEW']);
$Flag = conText($_POST['Flag']);
if($W != ""){
if($Flag == "Add"){
if($VIEW == ""){
	$sql_c = db::query("SELECT * FROM WF_MAIN WHERE WF_MAIN_ID = '".$W."'");
}else{
	$sql_c = db::query("SELECT * FROM WF_MAIN_VIEW WHERE WF_MAIN_ID = '".$W."' AND WF_VIEW_ID = '".$VIEW."'");
}
$R = db::fetch_array($sql_c);
if($R['WF_MAIN_ID'] == $W){
	$copy = array();
	foreach($R as $k=>$val){
		if(!is_numeric($k)){
		$copy[$k] = $val;
		}
	} 
	unset($copy["WF_VIEW_ID"]);
	$ID = db::db_insert("WF_MAIN_VIEW", $copy, "WF_VIEW_ID");
	echo $ID;
}
}
if($Flag == "Del"){
	$a_cond['WF_VIEW_ID'] = $VIEW;
	db::db_delete("WF_MAIN_VIEW", $a_cond);
}
}
db::db_close();
?>