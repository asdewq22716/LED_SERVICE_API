<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$process = $_REQUEST['process'];
$table = "MASTER_CONFIG";
$pk_name = "FORM_QT_ID";
$pk_id = $_REQUEST['FORM_QT_ID'];
$url_back = "master_search_setting.php?W=".$_REQUEST['W'];

$WF_MAIN_ID = conText($_POST['W']);
$FORM_QT_NAME = conText($_POST['FORM_QT_NAME']);
$FORM_QT_SHORTNAME = conText($_POST['FORM_QT_SHORTNAME']);
$FORM_QT_INPUT_TYPE = conText($_POST['FORM_QT_INPUT_TYPE']);
$FORM_QT_SQL = conText($_POST['FORM_QT_SQL']);
$FORM_QT_DETAIL = conText($_POST['FORM_QT_DETAIL']);
$FORM_QT_DEFAULT = conText($_POST['FORM_QT_DEFAULT']);
$FORM_QT_CLASS = conText($_POST['FORM_QT_CLASS']);
$FORM_QT_NOBR = conText($_POST['FORM_QT_NOBR']);
$FORM_QT_REQUIRED = conText($_POST['FORM_QT_REQUIRED']);
$FORM_QT_SHOW = conText($_POST['FORM_QT_SHOW']);
$FORM_QT_DATA = conText($_POST['FORM_QT_DATA']);
$FORM_QT_VALUE = conText($_POST['FORM_QT_VALUE']);
$FORM_QT_MASTER_FIELD = conText($_POST['FORM_QT_MASTER_FIELD']);
//$FORM_QT_MASTER_SQL = addslashes($_POST['FORM_QT_MASTER_SQL']);
$FORM_QT_FIELDNAME = conText($_POST['FORM_QT_FIELDNAME']);
$FORM_QT_OPERATOR = conText($_POST['FORM_QT_OPERATOR']);
$FORM_QT_HIDDEN = conText($_POST['FORM_QT_HIDDEN']);

if($process == "add")
{
	$q_max = db::query("select max(FORM_QT_SORT) as FORM_MAX from ".$table." where WF_MAIN_ID = '".$_POST['W']."'");
	$r_max = db::fetch_array($q_max);
	$FORM_QT_SORT = ($r_max['FORM_MAX']+1);
	
	$a_data['WF_MAIN_ID'] = $WF_MAIN_ID;
	$a_data['FORM_QT_NAME'] = $FORM_QT_NAME;
	$a_data['FORM_QT_SHORTNAME'] = $FORM_QT_SHORTNAME;
	$a_data['FORM_QT_INPUT_TYPE'] = $FORM_QT_INPUT_TYPE;
	$a_data['FORM_QT_SQL'] = $FORM_QT_SQL;
	$a_data['FORM_QT_DETAIL'] = $FORM_QT_DETAIL;
	$a_data['FORM_QT_DEFAULT'] = $FORM_QT_DEFAULT;
	$a_data['FORM_QT_CLASS'] = $FORM_QT_CLASS;
	$a_data['FORM_QT_NOBR'] = $FORM_QT_NOBR;
	$a_data['FORM_QT_REQUIRED'] = $FORM_QT_REQUIRED;
	$a_data['FORM_QT_HIDDEN'] = $FORM_QT_HIDDEN;
	$a_data['FORM_QT_SHOW'] = $FORM_QT_SHOW;
	$a_data['FORM_QT_DATA'] = $FORM_QT_DATA;
	$a_data['FORM_QT_VALUE'] = $FORM_QT_VALUE;
	$a_data['FORM_QT_MASTER_FIELD'] = $FORM_QT_MASTER_FIELD;
	//$a_data['FORM_QT_MASTER_SQL'] = $FORM_QT_MASTER_SQL;
	$a_data['FORM_QT_FIELDNAME'] = $FORM_QT_FIELDNAME;
	$a_data['FORM_QT_OPERATOR'] = $FORM_QT_OPERATOR;
	$a_data['FORM_QT_SORT'] = $FORM_QT_SORT;

	db::db_insert($table, $a_data, $pk_name);
}
elseif($process == "edit")
{
	$a_data['WF_MAIN_ID'] = $WF_MAIN_ID;
	$a_data['FORM_QT_NAME'] = $FORM_QT_NAME;
	$a_data['FORM_QT_SHORTNAME'] = $FORM_QT_SHORTNAME;
	$a_data['FORM_QT_INPUT_TYPE'] = $FORM_QT_INPUT_TYPE;
	//$a_data['FORM_QT_SQL'] = $FORM_QT_SQL;
	$a_data['FORM_QT_DETAIL'] = $FORM_QT_DETAIL;
	$a_data['FORM_QT_DEFAULT'] = $FORM_QT_DEFAULT;
	$a_data['FORM_QT_CLASS'] = $FORM_QT_CLASS;
	$a_data['FORM_QT_NOBR'] = $FORM_QT_NOBR;
	$a_data['FORM_QT_REQUIRED'] = $FORM_QT_REQUIRED;
	$a_data['FORM_QT_HIDDEN'] = $FORM_QT_HIDDEN;
	$a_data['FORM_QT_SHOW'] = $FORM_QT_SHOW;
	$a_data['FORM_QT_DATA'] = $FORM_QT_DATA;
	$a_data['FORM_QT_VALUE'] = $FORM_QT_VALUE;
	$a_data['FORM_QT_MASTER_FIELD'] = $FORM_QT_MASTER_FIELD;
	$a_data['FORM_QT_MASTER_SQL'] = $FORM_QT_MASTER_SQL;
	$a_data['FORM_QT_FIELDNAME'] = $FORM_QT_FIELDNAME;
	$a_data['FORM_QT_OPERATOR'] = $FORM_QT_OPERATOR;

	$a_cond[$pk_name] = $pk_id;

	db::db_update($table, $a_data, $a_cond);
}
elseif($process == "delete")
{
	$a_cond[$pk_name] = $pk_id;

	db::db_delete($table, $a_cond);
}
elseif($process == "re_order")
{
	for($i=1; $i<$_POST['total_row']; $i++)
	{
		$FORM_QT_SORT = conText($_POST['FORM_QT_SORT'.$i]);

		$a_data['FORM_QT_SORT'] = $FORM_QT_SORT;

		$a_cond[$pk_name] = $_POST['id'.$i];

		db::db_update($table, $a_data, $a_cond);
	}
}

db::db_close();
redirect($url_back);
?>