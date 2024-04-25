<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$W = conText($_POST['W']);
$WFD_ID = conText($_POST['WFD']);
$WFS_ID = conText($_POST['WFS']);
$WF_TYPE = conText($_POST['WF_TYPE']);
$back_page_old = conText($_POST['back_page_old']);
$NUM_ROWS_FIELD = conText($_POST['NUM_ROWS_FIELD']);

$arr_edit = array();
$arr_view = array();

//echo $WF_TYPE;exit;
if($WF_TYPE == "W"){
$url_back = "workflow_step_form.php?W=".$W."&WFD=".$WFD_ID;
$url_back2 = "workflow_step_form_edit.php?process=add&W=".$W."&WFD=".$WFD_ID;
}
if($WF_TYPE == "F"){
$url_back = "form_step_form.php?W=".$W."&WFD=".$WFD_ID;
$url_back2 = "form_step_form_edit.php?process=add&W=".$W."&WFD=".$WFD_ID;
}
if($WF_TYPE == "M"){
$url_back = "master_step_form.php?W=".$W."&WFD=".$WFD_ID;
$url_back2 = "master_step_form_edit.php?process=add&W=".$W."&WFD=".$WFD_ID;
}
if($WF_TYPE == "S"){
$url_back = "search_step_form.php?W=".$W."&WFD=0";
$url_back2 = "search_step_form_edit.php?process=add&W=".$W."&WFD=0";
}

$sql = db::query("select WF_MAIN_SHORTNAME from WF_MAIN where WF_MAIN_ID = '".$W."' AND WF_TYPE = '".$WF_TYPE."'");
$rec = db::fetch_array($sql);

$table_wfr = $rec['WF_MAIN_SHORTNAME'];
$process = $_REQUEST['process'];
$table = "WF_STEP_FORM";
$pk_name = "WFS_ID";
$pk_id = $_REQUEST['WFS'];


## Main Form
$FORM_MAIN_ID = conText($_POST['FORM_MAIN_ID']);
$WFS_RELATION_TYPE = conText($_POST['WFS_RELATION_TYPE']);
$WFS_ORDER_BY = conText($_POST['WFS_ORDER_BY']);
$WFS_TOOLTIP = conText($_POST['WFS_TOOLTIP']);
$WFS_COMMENT = conText($_POST['WFS_COMMENT']);
$WFS_NAME = conText($_POST['WFS_NAME']);
$WFS_FIELD_NAME = conText($_POST['WFS_FIELD_NAME']);
$WFS_FIELD_TYPE = conText($_POST['WFS_FIELD_TYPE']);
$WFS_FIELD_LENGTH = conText($_POST['WFS_FIELD_LENGTH']);
$WFS_TXT_BEFORE_INPUT = conText($_POST['WFS_TXT_BEFORE_INPUT']);
$WFS_TXT_AFTER_INPUT = conText($_POST['WFS_TXT_AFTER_INPUT']);
$WFS_DEFAULT_DATA = conText($_POST['WFS_DEFAULT_DATA']);
$WFS_PLACEHOLDER = conText($_POST['WFS_PLACEHOLDER']);
$WFS_ONCHANGE = conText($_POST['WFS_ONCHANGE']);
$WFS_REQUIRED = conText($_POST['WFS_REQUIRED']);
$WFS_HIDDEN_FORM = conText($_POST['WFS_HIDDEN_FORM']);
$WFS_HIDDEN_VIEW = conText($_POST['WFS_HIDDEN_VIEW']);
$WFS_COLUMN_TYPE = conText($_POST['WFS_COLUMN_TYPE']);
$FIELD_G_ID = conText($_POST['FIELD_G_ID']);
$FIELD_G_ID = ($FIELD_G_ID != '')?$FIELD_G_ID:0;
$WFS_CHECK_DUP = conText($_POST['WFS_CHECK_DUP']);
$WFS_SEARCH_FIELD_NAME = conText($_POST['WFS_SEARCH_FIELD_NAME']);
$WF_VIEW_COL_HEADER = conText($_POST['WF_VIEW_COL_HEADER']);
$WF_VIEW_COL_DATA = conText($_POST['WF_VIEW_COL_DATA']);
$WF_VIEW_COL_ALIGN = conText($_POST['WF_VIEW_COL_ALIGN']);
$WF_VIEW_COL_SIZE = conText($_POST['WF_VIEW_COL_SIZE']);
$WF_VIEW_COL_ORDER = conText($_POST['WF_VIEW_COL_ORDER']);
$WF_VIEW_COL_TOTAL = conText($_POST['WF_VIEW_COL_TOTAL']);
$WFS_HELP = conText($_POST['WFS_HELP']);
$WFS_DEFINE_CLASS = conText($_POST['WFS_DEFINE_CLASS']);
$WFS_INPUT_EVENT = conText($_POST['WFS_INPUT_EVENT']);
$WFS_JAVASCRIPT_EVENT = conText($_POST['WFS_JAVASCRIPT_EVENT']);
$WFS_FORM_VIEW_STATUS = conText($_POST['WFS_FORM_VIEW_STATUS']);
$WFS_FORM_VIEW_RESIZE = conText($_POST['WFS_FORM_VIEW_RESIZE']);
$WFS_FORM_VIEW_LABEL = conText($_POST['WFS_FORM_VIEW_LABEL']);
$WFS_FORM_COPY_STATUS = conText($_POST['WFS_FORM_COPY_STATUS']);
$WFS_FORM_COPY_RESIZE = conText($_POST['WFS_FORM_COPY_RESIZE']);
$WFS_FORM_COPY_LABEL = conText($_POST['WFS_FORM_COPY_LABEL']);
$WFS_READONLY = conText($_POST['WFS_READONLY']);
$WFS_DISABLE = conText($_POST['WFS_DISABLE']);
$WFS_NO_BR = conText($_POST['WFS_NO_BR']);
$WFS_MAIN_SHOW = conText($_POST['WFS_MAIN_SHOW']);
$WFS_REPORT_HEAD_STATUS = conText($_POST['WFS_REPORT_HEAD_STATUS']);
$WFS_REPORT_HEADER = addslashes($_POST['WFS_REPORT_HEADER']);
$WFS_REPORT_HEADER = trim(preg_replace("/\r\n|\r|\n/", '', $WFS_REPORT_HEADER));
$WFS_VALIDATE_TEXT = conText($_POST['WFS_VALIDATE_TEXT']);


if($WFS_COLUMN_TYPE == "2")
{
	$WFS_COLUMN_LEFT = conText($_POST['WFS_COLUMN_LEFT']);
	$WFS_COLUMN_LEFT_ALIGN = conText($_POST['WFS_COLUMN_LEFT_ALIGN']);
	$WFS_COLUMN_RIGHT = conText($_POST['WFS_COLUMN_RIGHT']);
	$WFS_COLUMN_RIGHT_ALIGN = conText($_POST['WFS_COLUMN_RIGHT_ALIGN']);
}
else
{
	$WFS_COLUMN_LEFT = conText($_POST['WFS_COLUMN_CENTER']);
	$WFS_COLUMN_LEFT_ALIGN = conText($_POST['WFS_COLUMN_CENTER_ALIGN']);
	$WFS_COLUMN_RIGHT = "0";
	$WFS_COLUMN_RIGHT_ALIGN = conText($_POST['WFS_COLUMN_RIGHT_ALIGN']);
}
$WFS_REQUIRED = $WFS_REQUIRED == "" ? "N" : $WFS_REQUIRED;
$WFS_HIDDEN_FORM = $WFS_HIDDEN_FORM == "" ? "N" : $WFS_HIDDEN_FORM;
$WFS_HIDDEN_VIEW = $WFS_HIDDEN_VIEW == "" ? "N" : $WFS_HIDDEN_VIEW;


## Input
$WFS_INPUT_FORMAT = conText($_POST['WFS_INPUT_FORMAT']);
$WFS_MASKING = conText($_POST['WFS_MASKING']);
$WFS_MAX_LENGTH = conText($_POST['WFS_MAX_LENGTH']);

## Form
$WFS_CODING_FORM = conText($_POST['WFS_CODING_FORM']);
$WFS_CODING_SAVE = conText($_POST['WFS_CODING_SAVE']);
$WFS_CODING_VIEW = conText($_POST['WFS_CODING_VIEW']);
$WFS_CODING_AJAX = conText($_POST['WFS_CODING_AJAX']);

## Option
$WFS_OPTION_VALUE = conText($_POST['WFS_OPTION_VALUE']);
$WFS_OPTION_SELECT_DATA = conText($_POST['WFS_OPTION_SELECT_DATA']);
$WFS_OPTION_SHOW_FIELD = conText($_POST['WFS_OPTION_SHOW_FIELD']);
$WFS_OPTION_SHOW_VALUE = conText($_POST['WFS_OPTION_SHOW_VALUE']);
$WFS_OPTION_COND = conText($_POST['WFS_OPTION_COND']);
$WFS_OPTION_NEW_LINE = conText($_POST['WFS_OPTION_NEW_LINE']);

$WFS_OPTION_ADD_MAIN = conText($_POST['WFS_OPTION_ADD_MAIN']);
$WFS_OPTION_FULL_SQL = conText($_POST['WFS_OPTION_FULL_SQL']);
$WFS_OPTION_SQL_VALUE = conText($_POST['WFS_OPTION_SQL_VALUE']);
$WFS_OPTION_SHORT_SELECT = conText($_POST['WFS_OPTION_SHORT_SELECT']);

$WFS_OPTION_NEW_LINE = $WFS_OPTION_NEW_LINE == "" ? "N" : $WFS_OPTION_NEW_LINE;
if($FORM_MAIN_ID == "9"){
$WFS_OPTION_SELECT2 = conText($_POST['WFS_OPTION_SELECT2']);
$WFS_OPTION_SELECT2 = $WFS_OPTION_SELECT2 == "" ? "N" : $WFS_OPTION_SELECT2;
$WFS_OPTION_SELECT2COM = conText($_POST['WFS_OPTION_SELECT2COM']);
$WFS_OPTION_SELECT2COM = $WFS_OPTION_SELECT2COM == "" ? "N" : $WFS_OPTION_SELECT2COM;
}
$WFS_OPTION_ADD_MAIN = $WFS_OPTION_ADD_MAIN == "" ? "N" : $WFS_OPTION_ADD_MAIN;

$WFS_OPTION_TXT_HEIGHT = conText($_POST['WFS_OPTION_TXT_HEIGHT']);

## File
$WFS_FILE_EXTEND_ALLOW = conText($_POST['WFS_FILE_EXTEND_ALLOW']);
$WFS_FILE_LIGHTBOX = conText($_POST['WFS_FILE_LIGHTBOX']);
$WFS_FILE_ORDER = conText($_POST['WFS_FILE_ORDER']);

## Text
$WFS_TXT_C_LEFT = conText($_POST['WFS_TXT_C_LEFT']);
$WFS_TXT_C_LEFT_HIGHLIGHT = conText($_POST['WFS_TXT_C_LEFT_HIGHLIGHT']);
$WFS_TXT_C_RIGHT = conText($_POST['WFS_TXT_C_RIGHT']);
$WFS_TXT_C_RIGHT_HIGHLIGHT = conText($_POST['WFS_TXT_C_RIGHT_HIGHLIGHT']);

## Province ## Amphur ## Tambon
$WFS_SHOW_PROVINCE = conText($_POST['WFS_SHOW_PROVINCE']);
$WFS_SHOW_AMPHUR = conText($_POST['WFS_SHOW_AMPHUR']);
$WFS_SHOW_TAMBON = conText($_POST['WFS_SHOW_TAMBON']);
$WFS_SHOW_ZIPCODE = conText($_POST['WFS_SHOW_ZIPCODE']);
## Change Province
if($FORM_MAIN_ID == "11" AND $WFS_FIELD_NAME != ""){
	
	if($WFS_SHOW_AMPHUR != ""){
		$u_field = array();
		$u_cond = array();
		$u_field['WFS_SHOW_PROVINCE'] = $WFS_FIELD_NAME;
		if($WFS_SHOW_TAMBON != ""){ $u_field['WFS_SHOW_TAMBON'] = $WFS_SHOW_TAMBON;	 }
		if($WFS_SHOW_ZIPCODE != ""){ $u_field['WFS_SHOW_ZIPCODE'] = $WFS_SHOW_ZIPCODE;	 }
		$u_cond['FORM_MAIN_ID'] = '12';
		$u_cond['WFD_ID'] = $WFD_ID;
		$u_cond['WFS_FIELD_NAME'] = $WFS_SHOW_AMPHUR;

		db::db_update($table, $u_field, $u_cond);
	}
	if($WFS_SHOW_TAMBON != ""){
		$u_field = array();
		$u_cond = array();
		$u_field['WFS_SHOW_PROVINCE'] = $WFS_FIELD_NAME;
		if($WFS_SHOW_AMPHUR != ""){ $u_field['WFS_SHOW_AMPHUR'] = $WFS_SHOW_AMPHUR;	 }
		if($WFS_SHOW_ZIPCODE != ""){ $u_field['WFS_SHOW_ZIPCODE'] = $WFS_SHOW_ZIPCODE;	 }
		$u_cond['FORM_MAIN_ID'] = '13';
		$u_cond['WFD_ID'] = $WFD_ID;
		$u_cond['WFS_FIELD_NAME'] = $WFS_SHOW_TAMBON;

		db::db_update($table, $u_field, $u_cond);	
	}
}
## Change Amphur
if($FORM_MAIN_ID == "12" AND $WFS_FIELD_NAME != ""){
	if($WFS_SHOW_PROVINCE != ""){
		$u_field = array();
		$u_cond = array();
		$u_field['WFS_SHOW_AMPHUR'] = $WFS_FIELD_NAME;
		if($WFS_SHOW_TAMBON != ""){ $u_field['WFS_SHOW_TAMBON'] = $WFS_SHOW_TAMBON;	 }
		if($WFS_SHOW_ZIPCODE != ""){ $u_field['WFS_SHOW_ZIPCODE'] = $WFS_SHOW_ZIPCODE;	 }
		$u_cond['FORM_MAIN_ID'] = '11';
		$u_cond['WFD_ID'] = $WFD_ID;
		$u_cond['WFS_FIELD_NAME'] = $WFS_SHOW_PROVINCE;

		db::db_update($table, $u_field, $u_cond);
	}
	if($WFS_SHOW_TAMBON != ""){
		$u_field = array();
		$u_cond = array();
		$u_field['WFS_SHOW_AMPHUR'] = $WFS_FIELD_NAME;
		if($WFS_SHOW_PROVINCE != ""){ $u_field['WFS_SHOW_PROVINCE'] = $WFS_SHOW_PROVINCE; }
		if($WFS_SHOW_ZIPCODE != ""){ $u_field['WFS_SHOW_ZIPCODE'] = $WFS_SHOW_ZIPCODE;	 }
		$u_cond['FORM_MAIN_ID'] = '13';
		$u_cond['WFD_ID'] = $WFD_ID;
		$u_cond['WFS_FIELD_NAME'] = $WFS_SHOW_TAMBON;

		db::db_update($table, $u_field, $u_cond);	
	}
}
## Change Tambon
if($FORM_MAIN_ID == "13" AND $WFS_FIELD_NAME != ""){
	if($WFS_SHOW_PROVINCE != ""){
		$u_field = array();
		$u_cond = array();
		$u_field['WFS_SHOW_TAMBON'] = $WFS_FIELD_NAME;
		if($WFS_SHOW_AMPHUR != ""){ $u_field['WFS_SHOW_AMPHUR'] = $WFS_SHOW_AMPHUR; }
		if($WFS_SHOW_ZIPCODE != ""){ $u_field['WFS_SHOW_ZIPCODE'] = $WFS_SHOW_ZIPCODE;	 }
		$u_cond['FORM_MAIN_ID'] = '11';
		$u_cond['WFD_ID'] = $WFD_ID;
		$u_cond['WFS_FIELD_NAME'] = $WFS_SHOW_PROVINCE;

		db::db_update($table, $u_field, $u_cond);
	}
	if($WFS_SHOW_AMPHUR != ""){
		$u_field = array();
		$u_cond = array();
		$u_field['WFS_SHOW_TAMBON'] = $WFS_FIELD_NAME;
		if($WFS_SHOW_PROVINCE != ""){ $u_field['WFS_SHOW_PROVINCE'] = $WFS_SHOW_PROVINCE; }
		if($WFS_SHOW_ZIPCODE != ""){ $u_field['WFS_SHOW_ZIPCODE'] = $WFS_SHOW_ZIPCODE;	 }
		$u_cond['FORM_MAIN_ID'] = '12';
		$u_cond['WFD_ID'] = $WFD_ID;
		$u_cond['WFS_FIELD_NAME'] = $WFS_SHOW_AMPHUR;

		db::db_update($table, $u_field, $u_cond);
	}
}


## Form
$WFS_FORM_SELECT = conText($_POST['WFS_FORM_SELECT']);
$WFS_FORM_ADD_STATUS = conText($_POST['WFS_FORM_ADD_STATUS']);
$WFS_FORM_ADD_RESIZE = conText($_POST['WFS_FORM_ADD_RESIZE']);
$WFS_FORM_ADD_LABEL = conText($_POST['WFS_FORM_ADD_LABEL']);
$WFS_FORM_ADD_POPUP = conText($_POST['WFS_FORM_ADD_POPUP']);
$WFS_FORM_EDIT_STATUS = conText($_POST['WFS_FORM_EDIT_STATUS']);
$WFS_FORM_EDIT_RESIZE = conText($_POST['WFS_FORM_EDIT_RESIZE']);
$WFS_FORM_EDIT_LABEL = conText($_POST['WFS_FORM_EDIT_LABEL']);
$WFS_FORM_EDIT_POPUP = conText($_POST['WFS_FORM_EDIT_POPUP']);
$WFS_FORM_DEL_STATUS = conText($_POST['WFS_FORM_DEL_STATUS']);
$WFS_FORM_DEL_RESIZE = conText($_POST['WFS_FORM_DEL_RESIZE']);
$WFS_FORM_DEL_LABEL = conText($_POST['WFS_FORM_DEL_LABEL']);
$WFS_FORM_FIELD_EDIT = conText($_POST['WFS_FORM_FIELD_EDIT']);
$WFS_FORM_COL_TITLE = conText($_POST['WFS_FORM_COL_TITLE']);
$WFS_FORM_COL_DATA = conText($_POST['WFS_FORM_COL_DATA']);
$WFS_FORM_COL_ALIGN = conText($_POST['WFS_FORM_COL_ALIGN']);
$WFS_FORM_COL_WIDTH = conText($_POST['WFS_FORM_COL_WIDTH']);
$WFS_FORM_COL_SUM = conText($_POST['WFS_FORM_COL_SUM']);
$WFS_FORM_COL_NO = conText($_POST['WFS_FORM_COL_NO']);
$WFS_FORM_POPUP = conText($_POST['WFS_FORM_POPUP']);
$WFS_SEARCH_CON = conText($_POST['WFS_SEARCH_CON']);
$WF_VIEW_FOOTER = conText($_POST['WF_VIEW_FOOTER']);
$WF_TEXT_FOOTER = conText($_POST['WF_TEXT_FOOTER']);
$WF_VIEW_COL_SHOW_NO = conText($_POST['WF_VIEW_COL_SHOW_NO']);
$WFS_MASTER_CROSS = conText($_POST['WFS_MASTER_CROSS']);
$WF_VIEW_COL_TROW = conText($_POST['WF_VIEW_COL_TROW']);
$WFS_FORM_PRELOAD = conText($_POST['WFS_FORM_PRELOAD']);
$WFS_CODING_POST  = conText($_POST['WFS_CODING_POST']);
$WFS_FORM_INPUT_SHOW  = conText($_POST['WFS_FORM_INPUT_SHOW']);
$WFS_CALENDAR_EN  = conText($_POST['WFS_CALENDAR_EN']);
$WFS_INLINE_FORM  = conText($_POST['WFS_INLINE_FORM']);

$WFS_FORM_ADD_STATUS = $WFS_FORM_ADD_STATUS == "" ? "N" : $WFS_FORM_ADD_STATUS;
$WFS_FORM_ADD_RESIZE = $WFS_FORM_ADD_RESIZE == "" ? "N" : $WFS_FORM_ADD_RESIZE;
$WFS_FORM_ADD_POPUP = $WFS_FORM_ADD_POPUP == "" ? "N" : $WFS_FORM_ADD_POPUP;
$WFS_FORM_EDIT_STATUS = $WFS_FORM_EDIT_STATUS == "" ? "N" : $WFS_FORM_EDIT_STATUS;
$WFS_FORM_EDIT_RESIZE = $WFS_FORM_EDIT_RESIZE == "" ? "N" : $WFS_FORM_EDIT_RESIZE;
$WFS_FORM_EDIT_POPUP = $WFS_FORM_EDIT_POPUP == "" ? "N" : $WFS_FORM_EDIT_POPUP;
$WFS_FORM_DEL_STATUS = $WFS_FORM_DEL_STATUS == "" ? "N" : $WFS_FORM_DEL_STATUS;
$WFS_FORM_DEL_RESIZE = $WFS_FORM_DEL_RESIZE == "" ? "N" : $WFS_FORM_DEL_RESIZE;
$WFS_FORM_COL_SUM = $WFS_FORM_COL_SUM == "" ? "N" : $WFS_FORM_COL_SUM;
$WFS_FORM_COL_NO = $WFS_FORM_COL_NO == "" ? "N" : $WFS_FORM_COL_NO;
$WF_VIEW_FOOTER = $WF_VIEW_FOOTER == "" ? "N" : $WF_VIEW_FOOTER;
$WF_VIEW_COL_SHOW_NO = $WF_VIEW_COL_SHOW_NO == "" ? "N" : $WF_VIEW_COL_SHOW_NO;

for($i=1;$i<$NUM_ROWS_FIELD;$i++){
	$type_form_field = conText($_POST['WFS_FORM_FIELD_EDIT'.$i]);
	$FIELD_WFS_ID = conText($_POST['WFS_ID'.$i]);
	if($type_form_field == 'E'){
		$arr_edit[] = $FIELD_WFS_ID;

	}else if($type_form_field == 'V'){
		$arr_view[] = $FIELD_WFS_ID;
	}
	
}
//print_pre($arr_edit);
//print_pre($arr_view);
if(count($arr_edit) > 0){
	$WFS_FORM_FIELD_EDIT = implode(',',$arr_edit);
	
}
if(count($arr_view) > 0){
	$WFS_FORM_FIELD_VIEW = implode(',',$arr_view);
}


## Upload Files
if($_FILES["WFS_CODING_FORM_FILE"]["size"] > 0)
{
	$file_name = $_FILES["WFS_CODING_FORM_FILE"]["name"];
	copy($_FILES["WFS_CODING_FORM_FILE"]["tmp_name"], "../form/".strtolower($_FILES["WFS_CODING_FORM_FILE"]["name"]));
	@chmod("../form/".strtolower($_FILES["WFS_CODING_FORM_FILE"]["name"]),0777);

	$WFS_CODING_FORM = $file_name;
}

if($_FILES["WFS_CODING_SAVE_FILE"]["size"] > 0)
{
	$file_name_save = $_FILES["WFS_CODING_SAVE_FILE"]["name"];
	copy($_FILES["WFS_CODING_SAVE_FILE"]["tmp_name"], "../save/".strtolower($_FILES["WFS_CODING_SAVE_FILE"]["name"]));
	@chmod("../save/".strtolower($_FILES["WFS_CODING_SAVE_FILE"]["name"]),0777);
	$WFS_CODING_SAVE = $file_name_save;
}

if($_FILES["WFS_CODING_VIEW_FILE"]["size"] > 0)
{
	$file_name_view = $_FILES["WFS_CODING_VIEW_FILE"]["name"];
	copy($_FILES["WFS_CODING_VIEW_FILE"]["tmp_name"], "../view/".strtolower($_FILES["WFS_CODING_VIEW_FILE"]["name"]));
	@chmod("../view/".strtolower($_FILES["WFS_CODING_VIEW_FILE"]["name"]),0777);
	$WFS_CODING_VIEW = $file_name_view;
}

## Process
if(conText($_POST['process']) == "add")
{
	if($_POST['ALTER_FIELD'] == "Y" && $WFS_FIELD_NAME != "")
	{
		add_field($table_wfr, $WFS_FIELD_NAME, $WFS_FIELD_TYPE, $WFS_FIELD_LENGTH, $WFS_NAME);
	}

	if($FORM_MAIN_ID == "11" AND $WF_TYPE != 'S')
	{
		$all_field = db::show_field($table_wfr);

		if(!in_array($WFS_FIELD_NAME, $all_field))
		{
			add_field($table_wfr, $WFS_FIELD_NAME, $WFS_FIELD_TYPE, $WFS_FIELD_LENGTH, $WFS_NAME." (จังหวัด)");
		}
	}

	if($WFS_ORDER_BY == "" OR $WFS_ORDER_BY == "last")
	{
		$mx = db::get_max("WF_STEP_FORM", "WFS_ORDER", array('WFD_ID' => $WFD_ID,'WF_MAIN_ID' => $W,'WF_TYPE' => $WF_TYPE));
		$WFS_ORDER = $mx + 1;
	}
	else
	{
		$sql_pos = db::query("select WFS_ORDER from WF_STEP_FORM where WFS_ID = '".$WFS_ORDER_BY."'");
		$rec_pos = db::fetch_array($sql_pos);
		$WFS_ORDER = $rec_pos["WFS_ORDER"];
		db::query("update WF_STEP_FORM SET WFS_ORDER = WFS_ORDER+1 where WFS_ORDER >= '".$rec_pos["WFS_ORDER"]."' AND WFD_ID = '".$WFD_ID."' AND WF_MAIN_ID = '".$W."' AND WF_TYPE = '".$WF_TYPE."'");
	}
	$a_data['WFD_ID'] = $WFD_ID;
	$a_data['WF_MAIN_ID'] = $W;
	$a_data['WF_TYPE'] = $WF_TYPE;
	$a_data['FORM_MAIN_ID'] = $FORM_MAIN_ID;
	$a_data['WFS_RELATION_TYPE'] = $WFS_RELATION_TYPE;
	$a_data['WFS_TOOLTIP'] = $WFS_TOOLTIP;
	$a_data['WFS_ORDER'] = $WFS_ORDER;
	$a_data['WFS_OFFSET'] = "0";
	$a_data['WFS_NAME'] = $WFS_NAME;
	$a_data['WFS_COMMENT'] = $WFS_COMMENT;
	$a_data['WFS_FIELD_NAME'] = strtoupper($WFS_FIELD_NAME);
	$a_data['WFS_FIELD_TYPE'] = $WFS_FIELD_TYPE;
	$a_data['WFS_FIELD_LENGTH'] = $WFS_FIELD_LENGTH;
	$a_data['WFS_TXT_BEFORE_INPUT'] = $WFS_TXT_BEFORE_INPUT;
	$a_data['WFS_TXT_AFTER_INPUT'] = $WFS_TXT_AFTER_INPUT;
	$a_data['WFS_DEFAULT_DATA'] = $WFS_DEFAULT_DATA;
	$a_data['WFS_PLACEHOLDER'] = $WFS_PLACEHOLDER;
	$a_data['WFS_ONCHANGE'] = $WFS_ONCHANGE;
	$a_data['WFS_REQUIRED'] = $WFS_REQUIRED;
	$a_data['WFS_HIDDEN_FORM'] = $WFS_HIDDEN_FORM;
	$a_data['WFS_HIDDEN_VIEW'] = $WFS_HIDDEN_VIEW;
	$a_data['WFS_COLUMN_TYPE'] = $WFS_COLUMN_TYPE;
	$a_data['WFS_COLUMN_LEFT'] = $WFS_COLUMN_LEFT;
	$a_data['WFS_COLUMN_LEFT_ALIGN'] = $WFS_COLUMN_LEFT_ALIGN;
	$a_data['WFS_COLUMN_RIGHT'] = $WFS_COLUMN_RIGHT;
	$a_data['WFS_COLUMN_RIGHT_ALIGN'] = $WFS_COLUMN_RIGHT_ALIGN;
	$a_data['WFS_CODING_FORM'] = $WFS_CODING_FORM;
	$a_data['WFS_CODING_SAVE'] = $WFS_CODING_SAVE;
	$a_data['WFS_CODING_VIEW'] = $WFS_CODING_VIEW;
	$a_data['WFS_CODING_AJAX'] = $WFS_CODING_AJAX;
	$a_data['WFS_INPUT_FORMAT'] = $WFS_INPUT_FORMAT;
	$a_data['WFS_MASKING'] = $WFS_MASKING;
	$a_data['WFS_MAX_LENGTH'] = $WFS_MAX_LENGTH;
	$a_data['WFS_OPTION_VALUE'] = $WFS_OPTION_VALUE;
	$a_data['WFS_OPTION_SELECT_DATA'] = $WFS_OPTION_SELECT_DATA;
	$a_data['WFS_OPTION_SHOW_FIELD'] = $WFS_OPTION_SHOW_FIELD;
	$a_data['WFS_OPTION_SHOW_VALUE'] = $WFS_OPTION_SHOW_VALUE;
	$a_data['WFS_OPTION_COND'] = $WFS_OPTION_COND;
	$a_data['WFS_OPTION_NEW_LINE'] = $WFS_OPTION_NEW_LINE;
	$a_data['WFS_OPTION_SELECT2'] = $WFS_OPTION_SELECT2;
	$a_data['WFS_FILE_EXTEND_ALLOW'] = $WFS_FILE_EXTEND_ALLOW;
	$a_data['WFS_FILE_LIGHTBOX'] = $WFS_FILE_LIGHTBOX;
	$a_data['WFS_TXT_C_LEFT'] = $WFS_TXT_C_LEFT;
	$a_data['WFS_TXT_C_LEFT_HIGHLIGHT'] = $WFS_TXT_C_LEFT_HIGHLIGHT;
	$a_data['WFS_TXT_C_RIGHT'] = $WFS_TXT_C_RIGHT;
	$a_data['WFS_TXT_C_RIGHT_HIGHLIGHT'] = $WFS_TXT_C_RIGHT_HIGHLIGHT;
	$a_data['WFS_SHOW_PROVINCE'] = $WFS_SHOW_PROVINCE;
	$a_data['WFS_SHOW_AMPHUR'] = $WFS_SHOW_AMPHUR;
	$a_data['WFS_SHOW_TAMBON'] = $WFS_SHOW_TAMBON;
	$a_data['WFS_SHOW_ZIPCODE'] = $WFS_SHOW_ZIPCODE;
	$a_data['WFS_SHOW_SPLIT_COLUMN'] = $WFS_SHOW_SPLIT_COLUMN;
	$a_data['WFS_FORM_SELECT'] = $WFS_FORM_SELECT;
	$a_data['WFS_FORM_ADD_STATUS'] = $WFS_FORM_ADD_STATUS;
	$a_data['WFS_FORM_ADD_RESIZE'] = $WFS_FORM_ADD_RESIZE;
	$a_data['WFS_FORM_ADD_LABEL'] = $WFS_FORM_ADD_LABEL;
	$a_data['WFS_FORM_ADD_POPUP'] = $WFS_FORM_ADD_POPUP;
	$a_data['WFS_FORM_EDIT_STATUS'] = $WFS_FORM_EDIT_STATUS;
	$a_data['WFS_FORM_EDIT_RESIZE'] = $WFS_FORM_EDIT_RESIZE;
	$a_data['WFS_FORM_EDIT_LABEL'] = $WFS_FORM_EDIT_LABEL;
	$a_data['WFS_FORM_EDIT_POPUP'] = $WFS_FORM_EDIT_POPUP;
	$a_data['WFS_FORM_DEL_STATUS'] = $WFS_FORM_DEL_STATUS;
	$a_data['WFS_FORM_DEL_RESIZE'] = $WFS_FORM_DEL_RESIZE;
	$a_data['WFS_FORM_DEL_LABEL'] = $WFS_FORM_DEL_LABEL;
	$a_data['WFS_FORM_FIELD_EDIT'] = $WFS_FORM_FIELD_EDIT;
	$a_data['WFS_FORM_FIELD_VIEW'] = $WFS_FORM_FIELD_VIEW;
	$a_data['WFS_FORM_COL_TITLE'] = $WFS_FORM_COL_TITLE;
	$a_data['WFS_FORM_COL_DATA'] = $WFS_FORM_COL_DATA;
	$a_data['WFS_FORM_COL_ALIGN'] = $WFS_FORM_COL_ALIGN;
	$a_data['WFS_FORM_COL_WIDTH'] = $WFS_FORM_COL_WIDTH;
	$a_data['WFS_FORM_COL_SUM'] = $WFS_FORM_COL_SUM;
	$a_data['FIELD_G_ID'] = $FIELD_G_ID;
	$a_data['WFS_SEARCH_CON'] = $WFS_SEARCH_CON;
	$a_data['WFS_FILE_ORDER'] = $WFS_FILE_ORDER;
	$a_data['WFS_OPTION_ADD_MAIN'] = $WFS_OPTION_ADD_MAIN;
	$a_data['WFS_CHECK_DUP'] = $WFS_CHECK_DUP;
	$a_data['WF_VIEW_FOOTER'] = $WF_VIEW_FOOTER;
	$a_data['WF_TEXT_FOOTER'] = $WF_TEXT_FOOTER;
	$a_data['WF_VIEW_COL_SHOW_NO'] = $WF_VIEW_COL_SHOW_NO;
	$a_data['WFS_MASTER_CROSS'] = $WFS_MASTER_CROSS;
	$a_data['WFS_SEARCH_FIELD_NAME'] = $WFS_SEARCH_FIELD_NAME;
	$a_data['WF_VIEW_COL_HEADER'] = $WF_VIEW_COL_HEADER;
	$a_data['WF_VIEW_COL_DATA'] = $WF_VIEW_COL_DATA;
	$a_data['WF_VIEW_COL_ALIGN'] = $WF_VIEW_COL_ALIGN;
	$a_data['WF_VIEW_COL_SIZE'] = $WF_VIEW_COL_SIZE;
	$a_data['WF_VIEW_COL_ORDER'] = $WF_VIEW_COL_ORDER;
	$a_data['WF_VIEW_COL_TOTAL'] = $WF_VIEW_COL_TOTAL;
	$a_data['WFS_HELP'] = $WFS_HELP;
	$a_data['WFS_DEFINE_CLASS'] = $WFS_DEFINE_CLASS;
	$a_data['WFS_INPUT_EVENT'] = $WFS_INPUT_EVENT;
	$a_data['WFS_JAVASCRIPT_EVENT'] = $WFS_JAVASCRIPT_EVENT;
	$a_data['WFS_FORM_VIEW_STATUS'] = $WFS_FORM_VIEW_STATUS;
	$a_data['WFS_FORM_VIEW_RESIZE'] = $WFS_FORM_VIEW_RESIZE;
	$a_data['WFS_FORM_VIEW_LABEL'] = $WFS_FORM_VIEW_LABEL;
	$a_data['WFS_FORM_COPY_STATUS'] = $WFS_FORM_COPY_STATUS;
	$a_data['WFS_FORM_COPY_RESIZE'] = $WFS_FORM_COPY_RESIZE;
	$a_data['WFS_FORM_COPY_LABEL'] = $WFS_FORM_COPY_LABEL;
	$a_data['WF_VIEW_COL_TROW'] = $WF_VIEW_COL_TROW;
	$a_data['WFS_FORM_PRELOAD'] = $WFS_FORM_PRELOAD;
	$a_data['WFS_READONLY'] = $WFS_READONLY;
	$a_data['WFS_CODING_POST'] =$WFS_CODING_POST;
	$a_data['WFS_FORM_INPUT_SHOW'] =$WFS_FORM_INPUT_SHOW;
	$a_data['WFS_DISABLE'] =$WFS_DISABLE;
	$a_data['WFS_NO_BR'] =$WFS_NO_BR;
	$a_data['WFS_MAIN_SHOW'] =$WFS_MAIN_SHOW;
	$a_data['WFS_OPTION_FULL_SQL'] =$WFS_OPTION_FULL_SQL;
	$a_data['WFS_OPTION_SQL_VALUE'] =$WFS_OPTION_SQL_VALUE;
	$a_data['WFS_FORM_POPUP'] =$WFS_FORM_POPUP;
	$a_data['WFS_OPTION_SHORT_SELECT'] =$WFS_OPTION_SHORT_SELECT;
	$a_data['WFS_REPORT_HEAD_STATUS'] = $WFS_REPORT_HEAD_STATUS;
	$a_data['WFS_REPORT_HEADER'] = $WFS_REPORT_HEADER;
	$a_data['WFS_CALENDAR_EN'] = $WFS_CALENDAR_EN;
	$a_data['WFS_INLINE_FORM'] = $WFS_INLINE_FORM;
	$a_data['WFS_VALIDATE_TEXT'] = $WFS_VALIDATE_TEXT;
	$a_data['WFS_OPTION_TXT_HEIGHT'] = $WFS_OPTION_TXT_HEIGHT;
	$a_data['WFS_OPTION_SELECT2COM'] = $WFS_OPTION_SELECT2COM;
	
	$WFS_ID = db::db_insert($table, $a_data, $pk_name, $pk_name);

	for($i=1; $i<=$_POST['total_row_wfso_option']; $i++)
	{
		if($_POST['wfso_option_chk'.$i] == "Y")
		{
			$b_data['WFS_ID'] = $WFS_ID;
			$b_data['WFSO_NAME'] = conText($_POST['WFSO_NAME'.$i]);
			$b_data['WFSO_VALUE'] = conText($_POST['WFSO_VALUE'.$i]);
			$b_data['WFSO_ORDER'] = conText($_POST['WFSO_ORDER'.$i]);

			db::db_insert("WF_STEP_OPTION", $b_data, 'WFSO_ID');
		}
	}
	
	## Step Option Throw
	
	$total_row_throw = conText($_POST['total_row_throw']);
	$throw_cond = array();
	for($i=1; $i<=$total_row_throw; $i++)
	{
		if($_POST['wfst_option_chk'.$i] == "Y")
		{
			unset($b_data);
			$b_data['WFS_ID'] = $WFS_ID;
			$b_data['WFST_NAME'] = conText($_POST['WFST_NAME'.$i]);
			$b_data['WFST_VALUE'] = conText($_POST['WFST_VALUE'.$i]);
			$b_data['WFST_ORDER'] = conText($_POST['WFST_ORDER'.$i]);
			$b_data['WFST_TYPE'] = conText($_POST['WFST_TYPE'.$i]);
			db::db_insert("WF_STEP_THROW", $b_data, 'WFST_ID');
		}
	}

	for($i=1; $i<=$_POST['total_row_js']; $i++)
	{
		if($_POST['WFSJ_CHK'.$i] == "Y")
		{
			$c_data['WFS_ID'] = $WFS_ID;
			$c_data['WFSJ_VAR'] = conText($_POST['WFSJ_VAR'.$i]);
			$c_data['WFSJ_OPERATE'] = conText($_POST['WFSJ_OPERATE'.$i]);
			$c_data['WFSJ_SHOW'] = conText($_POST['WFSJ_SHOW'.$i]);
			$c_data['WFSJ_HIDE'] = conText($_POST['WFSJ_HIDE'.$i]);
			$c_data['WFSJ_JAVASCRIPT'] = conText($_POST['WFSJ_JAVASCRIPT'.$i]);

			db::db_insert("WF_STEP_JS", $c_data, 'WFSJ_ID');
		}
	}
}
elseif(conText($_POST['process']) == "edit")
{
	if($WF_TYPE == 'S'){ 
		$a_data['WFS_FIELD_NAME'] = strtoupper($WFS_FIELD_NAME);
	}
	$a_data['FORM_MAIN_ID'] = $FORM_MAIN_ID;
	$a_data['WFS_RELATION_TYPE'] = $WFS_RELATION_TYPE;
	$a_data['WFS_TOOLTIP'] = $WFS_TOOLTIP;
	$a_data['WFS_NAME'] = $WFS_NAME;
	$a_data['WFS_COMMENT'] = $WFS_COMMENT;
	$a_data['WFS_TXT_BEFORE_INPUT'] = $WFS_TXT_BEFORE_INPUT;
	$a_data['WFS_TXT_AFTER_INPUT'] = $WFS_TXT_AFTER_INPUT;
	$a_data['WFS_DEFAULT_DATA'] = $WFS_DEFAULT_DATA;
	$a_data['WFS_PLACEHOLDER'] = $WFS_PLACEHOLDER;
	$a_data['WFS_ONCHANGE'] = $WFS_ONCHANGE;
	$a_data['WFS_REQUIRED'] = $WFS_REQUIRED;
	$a_data['WFS_HIDDEN_FORM'] = $WFS_HIDDEN_FORM;
	$a_data['WFS_HIDDEN_VIEW'] = $WFS_HIDDEN_VIEW;
	$a_data['WFS_COLUMN_TYPE'] = $WFS_COLUMN_TYPE;
	$a_data['WFS_COLUMN_LEFT'] = $WFS_COLUMN_LEFT;
	$a_data['WFS_COLUMN_LEFT_ALIGN'] = $WFS_COLUMN_LEFT_ALIGN;
	$a_data['WFS_COLUMN_RIGHT'] = $WFS_COLUMN_RIGHT;
	$a_data['WFS_COLUMN_RIGHT_ALIGN'] = $WFS_COLUMN_RIGHT_ALIGN;
	$a_data['WFS_CODING_FORM'] = $WFS_CODING_FORM;
	$a_data['WFS_CODING_SAVE'] = $WFS_CODING_SAVE;
	$a_data['WFS_CODING_VIEW'] = $WFS_CODING_VIEW;
	$a_data['WFS_CODING_AJAX'] = $WFS_CODING_AJAX;
	$a_data['WFS_INPUT_FORMAT'] = $WFS_INPUT_FORMAT;
	$a_data['WFS_MASKING'] = $WFS_MASKING;
	$a_data['WFS_MAX_LENGTH'] = $WFS_MAX_LENGTH;
	$a_data['WFS_OPTION_VALUE'] = $WFS_OPTION_VALUE;
	$a_data['WFS_OPTION_SELECT_DATA'] = $WFS_OPTION_SELECT_DATA;
	$a_data['WFS_OPTION_SHOW_FIELD'] = $WFS_OPTION_SHOW_FIELD;
	$a_data['WFS_OPTION_SHOW_VALUE'] = $WFS_OPTION_SHOW_VALUE;
	$a_data['WFS_OPTION_COND'] = $WFS_OPTION_COND;
	$a_data['WFS_OPTION_NEW_LINE'] = $WFS_OPTION_NEW_LINE;
	$a_data['WFS_OPTION_SELECT2'] = $WFS_OPTION_SELECT2;
	$a_data['WFS_FILE_EXTEND_ALLOW'] = $WFS_FILE_EXTEND_ALLOW;
	$a_data['WFS_FILE_LIGHTBOX'] = $WFS_FILE_LIGHTBOX;
	$a_data['WFS_TXT_C_LEFT'] = $WFS_TXT_C_LEFT;
	$a_data['WFS_TXT_C_LEFT_HIGHLIGHT'] = $WFS_TXT_C_LEFT_HIGHLIGHT;
	$a_data['WFS_TXT_C_RIGHT'] = $WFS_TXT_C_RIGHT;
	$a_data['WFS_TXT_C_RIGHT_HIGHLIGHT'] = $WFS_TXT_C_RIGHT_HIGHLIGHT;
	$a_data['WFS_SHOW_PROVINCE'] = $WFS_SHOW_PROVINCE;
	$a_data['WFS_SHOW_AMPHUR'] = $WFS_SHOW_AMPHUR;
	$a_data['WFS_SHOW_TAMBON'] = $WFS_SHOW_TAMBON;
	$a_data['WFS_SHOW_ZIPCODE'] = $WFS_SHOW_ZIPCODE;
	$a_data['WFS_SHOW_SPLIT_COLUMN'] = $WFS_SHOW_SPLIT_COLUMN;
	$a_data['WFS_FORM_SELECT'] = $WFS_FORM_SELECT;
	$a_data['WFS_FORM_ADD_STATUS'] = $WFS_FORM_ADD_STATUS;
	$a_data['WFS_FORM_ADD_RESIZE'] = $WFS_FORM_ADD_RESIZE;
	$a_data['WFS_FORM_ADD_LABEL'] = $WFS_FORM_ADD_LABEL;
	$a_data['WFS_FORM_ADD_POPUP'] = $WFS_FORM_ADD_POPUP;
	$a_data['WFS_FORM_EDIT_STATUS'] = $WFS_FORM_EDIT_STATUS;
	$a_data['WFS_FORM_EDIT_RESIZE'] = $WFS_FORM_EDIT_RESIZE;
	$a_data['WFS_FORM_EDIT_LABEL'] = $WFS_FORM_EDIT_LABEL;
	$a_data['WFS_FORM_EDIT_POPUP'] = $WFS_FORM_EDIT_POPUP;
	$a_data['WFS_FORM_DEL_STATUS'] = $WFS_FORM_DEL_STATUS;
	$a_data['WFS_FORM_DEL_RESIZE'] = $WFS_FORM_DEL_RESIZE;
	$a_data['WFS_FORM_DEL_LABEL'] = $WFS_FORM_DEL_LABEL;
	$a_data['WFS_FORM_FIELD_EDIT'] = $WFS_FORM_FIELD_EDIT;
	$a_data['WFS_FORM_FIELD_VIEW'] = $WFS_FORM_FIELD_VIEW;
	$a_data['WFS_FORM_COL_TITLE'] = $WFS_FORM_COL_TITLE;
	$a_data['WFS_FORM_COL_DATA'] = $WFS_FORM_COL_DATA;
	$a_data['WFS_FORM_COL_ALIGN'] = $WFS_FORM_COL_ALIGN;
	$a_data['WFS_FORM_COL_WIDTH'] = $WFS_FORM_COL_WIDTH;
	$a_data['WFS_FORM_COL_SUM'] = $WFS_FORM_COL_SUM;
	$a_data['FIELD_G_ID'] = $FIELD_G_ID;
	$a_data['WFS_SEARCH_CON'] = $WFS_SEARCH_CON;
	$a_data['WFS_FILE_ORDER'] = $WFS_FILE_ORDER;
	$a_data['WFS_OPTION_ADD_MAIN'] = $WFS_OPTION_ADD_MAIN;
	$a_data['WFS_CHECK_DUP'] = $WFS_CHECK_DUP;
	$a_data['WF_VIEW_FOOTER'] = $WF_VIEW_FOOTER;
	$a_data['WF_TEXT_FOOTER'] = $WF_TEXT_FOOTER;
	$a_data['WF_VIEW_COL_SHOW_NO'] = $WF_VIEW_COL_SHOW_NO;
	$a_data['WFS_MASTER_CROSS'] = $WFS_MASTER_CROSS;
	$a_data['WFS_SEARCH_FIELD_NAME'] = $WFS_SEARCH_FIELD_NAME;
	$a_data['WF_VIEW_COL_HEADER'] = $WF_VIEW_COL_HEADER;
	$a_data['WF_VIEW_COL_DATA'] = $WF_VIEW_COL_DATA;
	$a_data['WF_VIEW_COL_ALIGN'] = $WF_VIEW_COL_ALIGN;
	$a_data['WF_VIEW_COL_SIZE'] = $WF_VIEW_COL_SIZE;
	$a_data['WF_VIEW_COL_ORDER'] = $WF_VIEW_COL_ORDER;
	$a_data['WF_VIEW_COL_TOTAL'] = $WF_VIEW_COL_TOTAL;
	$a_data['WFS_HELP'] = $WFS_HELP;
	$a_data['WFS_DEFINE_CLASS'] = $WFS_DEFINE_CLASS;
	$a_data['WFS_INPUT_EVENT'] = $WFS_INPUT_EVENT;
	$a_data['WFS_JAVASCRIPT_EVENT'] = $WFS_JAVASCRIPT_EVENT;
	$a_data['WFS_FORM_VIEW_STATUS'] = $WFS_FORM_VIEW_STATUS;
	$a_data['WFS_FORM_VIEW_RESIZE'] = $WFS_FORM_VIEW_RESIZE;
	$a_data['WFS_FORM_VIEW_LABEL'] = $WFS_FORM_VIEW_LABEL;
	$a_data['WFS_FORM_COPY_STATUS'] = $WFS_FORM_COPY_STATUS;
	$a_data['WFS_FORM_COPY_RESIZE'] = $WFS_FORM_COPY_RESIZE;
	$a_data['WFS_FORM_COPY_LABEL'] = $WFS_FORM_COPY_LABEL;	
	$a_data['WF_VIEW_COL_TROW'] = $WF_VIEW_COL_TROW;
	$a_data['WFS_FORM_PRELOAD'] = $WFS_FORM_PRELOAD;
	$a_data['WFS_READONLY'] = $WFS_READONLY;
	$a_data['WFS_CODING_POST'] =$WFS_CODING_POST;
	$a_data['WFS_FORM_INPUT_SHOW'] =$WFS_FORM_INPUT_SHOW;
	$a_data['WFS_DISABLE'] =$WFS_DISABLE;
	$a_data['WFS_NO_BR'] =$WFS_NO_BR;
	$a_data['WFS_MAIN_SHOW'] =$WFS_MAIN_SHOW;
	$a_data['WFS_OPTION_FULL_SQL'] =$WFS_OPTION_FULL_SQL;
	$a_data['WFS_OPTION_SQL_VALUE'] =$WFS_OPTION_SQL_VALUE;
	$a_data['WFS_FORM_POPUP'] =$WFS_FORM_POPUP;
	$a_data['WFS_OPTION_SHORT_SELECT'] =$WFS_OPTION_SHORT_SELECT;
	$a_data['WFS_REPORT_HEAD_STATUS'] = $WFS_REPORT_HEAD_STATUS;
	$a_data['WFS_REPORT_HEADER'] = $WFS_REPORT_HEADER;
	$a_data['WFS_CALENDAR_EN'] = $WFS_CALENDAR_EN;
	$a_data['WFS_INLINE_FORM'] = $WFS_INLINE_FORM;
	$a_data['WFS_VALIDATE_TEXT'] = $WFS_VALIDATE_TEXT;
	$a_data['WFS_OPTION_TXT_HEIGHT'] = $WFS_OPTION_TXT_HEIGHT;
	$a_data['WFS_OPTION_SELECT2COM'] = $WFS_OPTION_SELECT2COM;

	$a_cond[$pk_name] = $pk_id;

	db::db_update($table, $a_data, $a_cond);

	## Step Option
	for($i=1; $i<=$_POST['total_row_wfso_option']; $i++)
	{
		$b_cond['WFSO_ID'] = $_POST['WFSO_ID'.$i];

		if($_POST['wfso_option_chk'.$i] == "Y")
		{
			unset($b_data);
			$b_data['WFS_ID'] = $WFS_ID;
			$b_data['WFSO_NAME'] = conText($_POST['WFSO_NAME'.$i]);
			$b_data['WFSO_VALUE'] = conText($_POST['WFSO_VALUE'.$i]);
			$b_data['WFSO_ORDER'] = conText($_POST['WFSO_ORDER'.$i]);


			if($_POST['WFSO_ID'.$i] == "")
			{
				db::db_insert("WF_STEP_OPTION", $b_data, 'WFSO_ID');
			}
			else
			{
				db::db_update("WF_STEP_OPTION", $b_data, $b_cond);
			}
		}
		else
		{
			db::db_delete("WF_STEP_OPTION", $b_cond);
		}
	}
	
	## Step Option Throw
	
	$total_row_throw = conText($_POST['total_row_throw']);
	$throw_cond = array();
	for($i=1; $i<=$total_row_throw; $i++)
	{
		$WFST_ID = conText($_POST['WFST_ID'.$i]);
		$throw_cond['WFST_ID'] = $WFST_ID;
		
		if($_POST['wfst_option_chk'.$i] == "Y")
		{
			unset($b_data);
			$b_data['WFS_ID'] = $WFS_ID;
			$b_data['WFST_NAME'] = conText($_POST['WFST_NAME'.$i]);
			$b_data['WFST_VALUE'] = conText($_POST['WFST_VALUE'.$i]);
			$b_data['WFST_ORDER'] = conText($_POST['WFST_ORDER'.$i]);
			$b_data['WFST_TYPE'] = conText($_POST['WFST_TYPE'.$i]);

			if($WFST_ID == "")
			{
				db::db_insert("WF_STEP_THROW", $b_data, 'WFST_ID');
			}
			else
			{
				db::db_update("WF_STEP_THROW", $b_data, $throw_cond);
			}
		}
		else
		{
			db::db_delete("WF_STEP_THROW", $throw_cond);
		}
	}

	## Step JS
	for($i=1; $i<=$_POST['total_row_js']; $i++)
	{
		$c_cond['WFSJ_ID'] = $_POST['WFSJ_ID'.$i];

		if($_POST['WFSJ_CHK'.$i] == "Y")
		{
			$c_data['WFS_ID'] = $WFS_ID;
			$c_data['WFSJ_VAR'] = conText($_POST['WFSJ_VAR'.$i]);
			$c_data['WFSJ_OPERATE'] = conText($_POST['WFSJ_OPERATE'.$i]);
			$c_data['WFSJ_SHOW'] = conText($_POST['WFSJ_SHOW'.$i]);
			$c_data['WFSJ_HIDE'] = conText($_POST['WFSJ_HIDE'.$i]);
			$c_data['WFSJ_JAVASCRIPT'] = conText($_POST['WFSJ_JAVASCRIPT'.$i]);
			$c_data['WFSJ_TYPE'] = $_POST['W_TYPE'];

			if($_POST['WFSJ_ID'.$i] == "")
			{
				db::db_insert("WF_STEP_JS", $c_data, 'WFSJ_ID');
			}
			else
			{
				db::db_update("WF_STEP_JS", $c_data, $c_cond);
			}
		}
		else
		{
			db::db_delete("WF_STEP_JS", $c_cond);
		}
	}
}
elseif($process == "delete")
{
	$W = conText($_GET['W']);
	$WFD_ID = conText($_GET['WFD']);
	$WFS_ID = conText($_GET['WFS']);
	$drop_field = conText($_GET['drop_field']);
	
	$sql = db::query("select WF_MAIN_SHORTNAME from WF_MAIN where WF_MAIN_ID = '".$W."'");
	$rec = db::fetch_array($sql);
	
	$sql = db::query("SELECT WF_TYPE,WFS_FIELD_NAME FROM WF_STEP_FORM WHERE WFS_ID='".$pk_id."'");
	$data = db::fetch_array($sql);
	$a_cond[$pk_name] = $pk_id;

	$field = select_field($rec["WF_MAIN_SHORTNAME"], $data["WFS_FIELD_NAME"]);
	
	if($field["FIELD_NAME"] != '' AND $drop_field == 'Y'){
		Drop_field($rec["WF_MAIN_SHORTNAME"], $field["FIELD_NAME"]);
		
	}

	delete_wf_step_form($pk_id);

	/*db::db_delete($table, $a_cond);
	db::db_delete("WF_STEP_JS", array('WFS_ID' => $pk_id));
	db::db_delete("WF_STEP_OPTION", array('WFS_ID' => $pk_id));*/
	if($WFD_ID != '')
	{
		echo $data["WF_TYPE"];
		exit;
	}
	else
	{
		exit;
	}
}
if($WFS_ID != '' AND (conText($_POST['process']) == "add" OR conText($_POST['process']) == "edit")){
db::db_delete("WF_ONCHANGE", array('WFS_ID' => $WFS_ID));

	preg_match_all("/(#@)([a-zA-Z0-9_]+)(!!)/", $WFS_OPTION_COND, $new_sql2, PREG_SET_ORDER);
		foreach ($new_sql2 as $val_new) { 
				$obj = $val_new[2];
				$o_data = array();
				$o_data['WF_MAIN_ID'] = $W;
				$o_data['WF_TYPE'] = $WF_TYPE;
				$o_data['WFS_ID'] = $WFS_ID;
				$o_data['WFS_FIELD_SEND'] = trim($obj);
				db::db_insert("WF_ONCHANGE", $o_data, 'WFO_ID');
				unset($o_data);
		}
}


db::db_close();
if($back_page_old == 'Y'){
	if(conText($_POST['process']) == 'add'){
		$url_back = $url_back2;	
	}else{
		$url_back = $_SERVER["HTTP_REFERER"];
	}
	
}
if($url_back != ""){
redirect($url_back);
}
?>