<?php
$HIDE_HEADER = "P";
include("../include/comtop_admin.php");
echo "<br><br><br><br><br><br>";
$array_table = array("DOC_MAIN",
					"DOC_VAR",
					"WF_CALENDAR",
					"WF_CHECKBOX",
					"WF_DETAIL",
					"WF_DETAIL_GROUP",
					"WF_FIELD_GROUP",
					"WF_MAIN",
					"WF_MAIN_VIEW",
					"WF_ONCHANGE",
					"WF_STEP_CON",
					"WF_STEP_FORM",
					"WF_STEP_JS",
					"WF_STEP_OPTION",
					"WF_STEP_THROW",
					"WF_WIDGET");
copy("../include/bsf.db","../export/bsf.db");
$db = new PDO('sqlite:../export/bsf.db'); 

function insert_db($table,$where){
	global $db;
	$sql_load = db::query("SELECT * FROM ".$table." WHERE ".$where);
	while($M = db::fetch_array($sql_load)){
		$f1 = array();
		$v1 = array();
		foreach($M as $key=>$val){
			if(!is_numeric($key)){
				$f1[] = $key;
				$v1[] = $val;
			}
		}
		$text = "INSERT INTO `".$table."` (".implode(",",$f1).") VALUES ('".implode("','",$v1)."')";
		$db->exec($text);
	}
	
}
function copy_wf($W){
global $db;	
	insert_db("WF_MAIN"," WF_MAIN_ID = '".$W."'");
	insert_db("WF_MAIN_VIEW"," WF_MAIN_ID = '".$W."'");
	insert_db("WF_DETAIL"," WF_MAIN_ID = '".$W."'");
	insert_db("WF_DETAIL_GROUP"," WF_MAIN_ID = '".$W."'");
	insert_db("WF_FIELD_GROUP"," WF_MAIN_ID = '".$W."'");
	insert_db("WF_STEP_FORM"," WF_MAIN_ID = '".$W."'");
	insert_db("WF_ONCHANGE"," WF_MAIN_ID = '".$W."'");
	insert_db("DOC_MAIN"," WF_MAIN_ID = '".$W."'");
	
	$sql_doc = db::query("SELECT DOC_ID FROM DOC_MAIN WHERE WF_MAIN_ID = '".$W."'");
	while($D = db::fetch_array($sql_doc)){	
	insert_db("DOC_VAR"," DOC_ID = '".$D['DOC_ID']."'");
	}
	$sql_detail = db::query("SELECT WFD_ID FROM WF_DETAIL WHERE WF_MAIN_ID = '".$W."'");
	while($D = db::fetch_array($sql_detail)){	
	insert_db("WF_STEP_CON"," WFD_ID = '".$D['WFD_ID']."'");
	}
	$sql_step_form = db::query("SELECT WFS_ID FROM WF_STEP_FORM WHERE WF_MAIN_ID = '".$W."'");
	while($S = db::fetch_array($sql_step_form)){	
	insert_db("WF_STEP_JS"," WFS_ID = '".$S['WFS_ID']."'");
	insert_db("WF_STEP_OPTION"," WFS_ID = '".$S['WFS_ID']."'");
	insert_db("WF_STEP_THROW"," WFS_ID = '".$S['WFS_ID']."'");
	}
}

foreach($array_table as $table){
$WF_ARR_FIELD = db::show_field($table);
$arr_f = array();
foreach($WF_ARR_FIELD as $val){
	$arr_f[] = "`".$val."`	TEXT ";
}
$txt = "CREATE TABLE `".$table."` (".implode(",",$arr_f).");";
$db->exec($txt);

}
copy_wf('19');

$db->NULL;
include '../include/combottom_js.php'; ?>
<?php include '../include/combottom_admin.php'; ?>