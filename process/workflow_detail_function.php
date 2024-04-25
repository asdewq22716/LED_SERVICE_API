<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$table = "WF_DETAIL";
$pk_name = "WFD_ID";
$pk_id = conText($_REQUEST['WFD']);
$process = conText($_REQUEST['process']);
$back_page_old = conText($_POST['back_page_old']);


$WF_MAIN_ID = conText($_REQUEST['W']);
$url_back = "workflow_detail.php?W=".$WF_MAIN_ID;

$WFD_NAME = conText($_POST['WFD_NAME']);
$WFD_ORDER = conText($_POST['WFD_ORDER']);
$WFD_TYPE = conText($_POST['WFD_TYPE']);
$WFD_DEFAULT_STEP = conText($_POST['WFD_DEFAULT_STEP']);
$WFD_AFTER_SAVE = conText($_POST['WFD_AFTER_SAVE']);
$WFD_TAB_STATUS = conText($_POST['WFD_TAB_STATUS']);
$WFD_CONTINUE_NEXT_STEP = conText($_POST['WFD_CONTINUE_NEXT_STEP']);
$WFD_VIEW_PREVIOUS_STEP = conText($_POST['WFD_VIEW_PREVIOUS_STEP']);
$WFD_AUTO_SUBMIT = conText($_POST['WFD_AUTO_SUBMIT']);
$WFD_ALERT_BEFORE_SUBMIT = conText($_POST['WFD_ALERT_BEFORE_SUBMIT']);
$WFD_THROW_ID = conText($_POST['WFD_THROW_ID']);
$WFD_THROW_FIELD_SOURCE = conText($_POST['WFD_THROW_FIELD_SOURCE']);
$WFD_THROW_FIELD_DESTINATION = conText($_POST['WFD_THROW_F_DESTINATION']);
$WFD_BTN_ADD_STATUS = conText($_POST['WFD_BTN_ADD_STATUS']);
$WFD_BTN_ADD_RESIZE = conText($_POST['WFD_BTN_ADD_RESIZE']);
$WFD_BTN_ADD_LABEL = conText($_POST['WFD_BTN_ADD_LABEL']);
$WFD_BTN_ADD_LINK = conText($_POST['WFD_BTN_ADD_LINK']);
$WFD_BTN_BACK_STATUS = conText($_POST['WFD_BTN_BACK_STATUS']);
$WFD_BTN_BACK_RESIZE = conText($_POST['WFD_BTN_BACK_RESIZE']);
$WFD_BTN_BACK_LABEL = conText($_POST['WFD_BTN_BACK_LABEL']);
$WFD_BTN_BACK_LINK = conText($_POST['WFD_BTN_BACK_LINK']);
$WFD_BTN_TEMP_STATUS = conText($_POST['WFD_BTN_TEMP_STATUS']);
$WFD_BTN_TEMP_RESIZE = conText($_POST['WFD_BTN_TEMP_RESIZE']);
$WFD_BTN_TEMP_LABEL = conText($_POST['WFD_BTN_TEMP_LABEL']);
$WFD_BTN_TEMP_LINK = conText($_POST['WFD_BTN_TEMP_LINK']);
$WFD_BTN_SAVE_STATUS = conText($_POST['WFD_BTN_SAVE_STATUS']);
$WFD_BTN_SAVE_RESIZE = conText($_POST['WFD_BTN_SAVE_RESIZE']);
$WFD_BTN_SAVE_LABEL = conText($_POST['WFD_BTN_SAVE_LABEL']);
$WFD_BTN_SAVE_LINK = conText($_POST['WFD_BTN_SAVE_LINK']);
$WFD_BTN_CON_STATUS = conText($_POST['WFD_BTN_CON_STATUS']);
$WFD_BTN_CON_RESIZE = conText($_POST['WFD_BTN_CON_RESIZE']);
$WFD_BTN_CON_LABEL = conText($_POST['WFD_BTN_CON_LABEL']);
$WFD_BTN_CON_LINK = conText($_POST['WFD_BTN_CON_LINK']);
$WFD_DETAIL_TOPIC = conText($_POST['WFD_DETAIL_TOPIC']);
$WFD_DETAIL_TOPIC_ALIGN = conText($_POST['WFD_DETAIL_TOPIC_ALIGN']);
$WFD_DETAIL_DESC = conText($_POST['WFD_DETAIL_DESC']);
$WFD_DETAIL_DESC_ALIGN = conText($_POST['WFD_DETAIL_DESC_ALIGN']);
$WFD_PERMISS_VIEW = conText($_POST['WFD_PERMISS_VIEW']);
$WFD_PERMISS_ACTION = conText($_POST['WFD_PERMISS_ACTION']);
$WFD_PERMISS_DELETE = conText($_POST['WFD_PERMISS_DELETE']);
$WFD_PERMISS_EDIT = conText($_POST['WFD_PERMISS_EDIT']);
$M_GROUP_ID = conText($_POST['M_GROUP_ID']);
$WFD_THROW_M_F_SOURCE = conText($_POST['WFD_THROW_M_F_SOURCE']);
$WFD_THROW_M_F_DESTINATION = conText($_POST['WFD_THROW_M_F_DESTINATION']);
$DETAIL_G_ID = conText($_POST['DETAIL_G_ID']);
$WFD_ALERT_STEP = conText($_POST['WFD_ALERT_STEP']);
$WFD_THROW_NEXT_STEP = conText($_POST['WFD_THROW_NEXT_STEP']);
$WFD_BTN_ATTACH_STATUS = conText($_POST['WFD_BTN_ATTACH_STATUS']);
$WFD_BTN_ATTACH_RESIZE = conText($_POST['WFD_BTN_ATTACH_RESIZE']);
$WFD_BTN_ATTACH_LABEL = conText($_POST['WFD_BTN_ATTACH_LABEL']);
$WFD_BTN_ATTACH_LINK = conText($_POST['WFD_BTN_ATTACH_LINK']);
$WFD_TOP_INCLUDE = conText($_POST['WFD_TOP_INCLUDE']);
$WFD_BOTTOM_INCLUDE = conText($_POST['WFD_BOTTOM_INCLUDE']);
$WFD_CHANGE_FLOW_NAME = conText($_POST['WFD_CHANGE_FLOW_NAME']);
$WFD_CHANGE_STEP_NAME = conText($_POST['WFD_CHANGE_STEP_NAME']);

$WFD_TAB_STATUS = $WFD_TAB_STATUS == "" ? "N" : $WFD_TAB_STATUS;
$WFD_CONTINUE_NEXT_STEP = $WFD_CONTINUE_NEXT_STEP == "" ? "N" : $WFD_CONTINUE_NEXT_STEP;
$WFD_VIEW_PREVIOUS_STEP = $WFD_VIEW_PREVIOUS_STEP == "" ? "N" : $WFD_VIEW_PREVIOUS_STEP;
$WFD_AUTO_SUBMIT = $WFD_AUTO_SUBMIT == "" ? "N" : $WFD_AUTO_SUBMIT;
$WFD_BTN_ADD_STATUS = $WFD_BTN_ADD_STATUS == "" ? "N" : $WFD_BTN_ADD_STATUS;
$WFD_BTN_ADD_RESIZE = $WFD_BTN_ADD_RESIZE == "" ? "N" : $WFD_BTN_ADD_RESIZE;
$WFD_BTN_BACK_STATUS = $WFD_BTN_BACK_STATUS == "" ? "N" : $WFD_BTN_BACK_STATUS;
$WFD_BTN_BACK_RESIZE = $WFD_BTN_BACK_RESIZE == "" ? "N" : $WFD_BTN_BACK_RESIZE;
$WFD_BTN_TEMP_STATUS = $WFD_BTN_TEMP_STATUS == "" ? "N" : $WFD_BTN_TEMP_STATUS;
$WFD_BTN_TEMP_RESIZE = $WFD_BTN_TEMP_RESIZE == "" ? "N" : $WFD_BTN_TEMP_RESIZE;
$WFD_BTN_SAVE_STATUS = $WFD_BTN_SAVE_STATUS == "" ? "N" : $WFD_BTN_SAVE_STATUS;
$WFD_BTN_SAVE_RESIZE = $WFD_BTN_SAVE_RESIZE == "" ? "N" : $WFD_BTN_SAVE_RESIZE;
$WFD_BTN_CON_STATUS = $WFD_BTN_CON_STATUS == "" ? "N" : $WFD_BTN_CON_STATUS;
$WFD_BTN_CON_RESIZE = $WFD_BTN_CON_RESIZE == "" ? "N" : $WFD_BTN_CON_RESIZE;

if($process == "add")
{
	$a_data['WF_MAIN_ID'] = $WF_MAIN_ID;
	$a_data['WFD_NAME'] = $WFD_NAME;
	$a_data['WFD_ORDER'] = $WFD_ORDER;
	$a_data['WFD_TYPE'] = $WFD_TYPE;
	$a_data['WFD_DEFAULT_STEP'] = $WFD_DEFAULT_STEP;
	$a_data['WFD_AFTER_SAVE'] = $WFD_AFTER_SAVE;
	$a_data['WFD_TAB_STATUS'] = $WFD_TAB_STATUS;
	$a_data['WFD_CONTINUE_NEXT_STEP'] = $WFD_CONTINUE_NEXT_STEP;
	$a_data['WFD_VIEW_PREVIOUS_STEP'] = $WFD_VIEW_PREVIOUS_STEP;
	$a_data['WFD_AUTO_SUBMIT'] = $WFD_AUTO_SUBMIT;
	$a_data['WFD_ALERT_BEFORE_SUBMIT'] = $WFD_ALERT_BEFORE_SUBMIT;
	$a_data['WFD_THROW_ID'] = $WFD_THROW_ID;
	$a_data['WFD_THROW_FIELD_SOURCE'] = $WFD_THROW_FIELD_SOURCE;
	$a_data['WFD_THROW_FIELD_DESTINATION'] = $WFD_THROW_FIELD_DESTINATION;
	$a_data['WFD_BTN_ADD_STATUS'] = $WFD_BTN_ADD_STATUS;
	$a_data['WFD_BTN_ADD_RESIZE'] = $WFD_BTN_ADD_RESIZE;
	$a_data['WFD_BTN_ADD_LABEL'] = $WFD_BTN_ADD_LABEL;
	$a_data['WFD_BTN_ADD_LINK'] = $WFD_BTN_ADD_LINK;
	$a_data['WFD_BTN_BACK_STATUS'] = $WFD_BTN_BACK_STATUS;
	$a_data['WFD_BTN_BACK_RESIZE'] = $WFD_BTN_BACK_RESIZE;
	$a_data['WFD_BTN_BACK_LABEL'] = $WFD_BTN_BACK_LABEL;
	$a_data['WFD_BTN_BACK_LINK'] = $WFD_BTN_BACK_LINK;
	$a_data['WFD_BTN_TEMP_STATUS'] = $WFD_BTN_TEMP_STATUS;
	$a_data['WFD_BTN_TEMP_RESIZE'] = $WFD_BTN_TEMP_RESIZE;
	$a_data['WFD_BTN_TEMP_LABEL'] = $WFD_BTN_TEMP_LABEL;
	$a_data['WFD_BTN_TEMP_LINK'] = $WFD_BTN_TEMP_LINK;
	$a_data['WFD_BTN_SAVE_STATUS'] = $WFD_BTN_SAVE_STATUS;
	$a_data['WFD_BTN_SAVE_RESIZE'] = $WFD_BTN_SAVE_RESIZE;
	$a_data['WFD_BTN_SAVE_LABEL'] = $WFD_BTN_SAVE_LABEL;
	$a_data['WFD_BTN_SAVE_LINK'] = $WFD_BTN_SAVE_LINK;
	$a_data['WFD_BTN_CON_STATUS'] = $WFD_BTN_CON_STATUS;
	$a_data['WFD_BTN_CON_RESIZE'] = $WFD_BTN_CON_RESIZE;
	$a_data['WFD_BTN_CON_LABEL'] = $WFD_BTN_CON_LABEL;
	$a_data['WFD_BTN_CON_LINK'] = $WFD_BTN_CON_LINK;
	$a_data['WFD_DETAIL_TOPIC'] = $WFD_DETAIL_TOPIC;
	$a_data['WFD_DETAIL_TOPIC_ALIGN'] = $WFD_DETAIL_TOPIC_ALIGN;
	$a_data['WFD_DETAIL_DESC'] = $WFD_DETAIL_DESC;
	$a_data['WFD_DETAIL_DESC_ALIGN'] = $WFD_DETAIL_DESC_ALIGN;
	$a_data['WFD_PERMISS_VIEW'] = $WFD_PERMISS_VIEW;
	$a_data['WFD_PERMISS_ACTION'] = $WFD_PERMISS_ACTION;
	$a_data['WFD_PERMISS_DELETE'] = $WFD_PERMISS_DELETE;
	$a_data['WFD_PERMISS_EDIT'] = $WFD_PERMISS_EDIT;
	$a_data['M_GROUP_ID'] = $M_GROUP_ID;
	$a_data['WFD_THROW_M_F_SOURCE'] = $WFD_THROW_M_F_SOURCE;
	$a_data['WFD_THROW_M_F_DESTINATION'] = $WFD_THROW_M_F_DESTINATION;
	$a_data['DETAIL_G_ID'] = $DETAIL_G_ID;
	$a_data['WFD_ALERT_STEP'] = $WFD_ALERT_STEP;
	$a_data['WFD_THROW_NEXT_STEP'] = $WFD_THROW_NEXT_STEP;
	$a_data['WFD_BTN_ATTACH_STATUS'] = $WFD_BTN_ATTACH_STATUS;
	$a_data['WFD_BTN_ATTACH_RESIZE'] = $WFD_BTN_ATTACH_RESIZE;
	$a_data['WFD_BTN_ATTACH_LABEL'] = $WFD_BTN_ATTACH_LABEL;
	$a_data['WFD_BTN_ATTACH_LINK'] = $WFD_BTN_ATTACH_LINK;
	$a_data['WFD_CHANGE_FLOW_NAME'] = $WFD_CHANGE_FLOW_NAME;
	$a_data['WFD_CHANGE_STEP_NAME'] = $WFD_CHANGE_STEP_NAME;

	db::db_insert($table, $a_data, $pk_name);
}
elseif($process == "edit")
{
	$a_data['WF_MAIN_ID'] = $WF_MAIN_ID;
	$a_data['WFD_NAME'] = $WFD_NAME;
	$a_data['WFD_ORDER'] = $WFD_ORDER;
	$a_data['WFD_TYPE'] = $WFD_TYPE;
	$a_data['WFD_DEFAULT_STEP'] = $WFD_DEFAULT_STEP;
	$a_data['WFD_AFTER_SAVE'] = $WFD_AFTER_SAVE;
	$a_data['WFD_TAB_STATUS'] = $WFD_TAB_STATUS;
	$a_data['WFD_CONTINUE_NEXT_STEP'] = $WFD_CONTINUE_NEXT_STEP;
	$a_data['WFD_VIEW_PREVIOUS_STEP'] = $WFD_VIEW_PREVIOUS_STEP;
	$a_data['WFD_AUTO_SUBMIT'] = $WFD_AUTO_SUBMIT;
	$a_data['WFD_ALERT_BEFORE_SUBMIT'] = $WFD_ALERT_BEFORE_SUBMIT;
	$a_data['WFD_THROW_ID'] = $WFD_THROW_ID;
	$a_data['WFD_THROW_FIELD_SOURCE'] = $WFD_THROW_FIELD_SOURCE;
	$a_data['WFD_THROW_FIELD_DESTINATION'] = $WFD_THROW_FIELD_DESTINATION;
	$a_data['WFD_BTN_ADD_STATUS'] = $WFD_BTN_ADD_STATUS;
	$a_data['WFD_BTN_ADD_RESIZE'] = $WFD_BTN_ADD_RESIZE;
	$a_data['WFD_BTN_ADD_LABEL'] = $WFD_BTN_ADD_LABEL;
	$a_data['WFD_BTN_ADD_LINK'] = $WFD_BTN_ADD_LINK;
	$a_data['WFD_BTN_BACK_STATUS'] = $WFD_BTN_BACK_STATUS;
	$a_data['WFD_BTN_BACK_RESIZE'] = $WFD_BTN_BACK_RESIZE;
	$a_data['WFD_BTN_BACK_LABEL'] = $WFD_BTN_BACK_LABEL;
	$a_data['WFD_BTN_BACK_LINK'] = $WFD_BTN_BACK_LINK;
	$a_data['WFD_BTN_TEMP_STATUS'] = $WFD_BTN_TEMP_STATUS;
	$a_data['WFD_BTN_TEMP_RESIZE'] = $WFD_BTN_TEMP_RESIZE;
	$a_data['WFD_BTN_TEMP_LABEL'] = $WFD_BTN_TEMP_LABEL;
	$a_data['WFD_BTN_TEMP_LINK'] = $WFD_BTN_TEMP_LINK;
	$a_data['WFD_BTN_SAVE_STATUS'] = $WFD_BTN_SAVE_STATUS;
	$a_data['WFD_BTN_SAVE_RESIZE'] = $WFD_BTN_SAVE_RESIZE;
	$a_data['WFD_BTN_SAVE_LABEL'] = $WFD_BTN_SAVE_LABEL;
	$a_data['WFD_BTN_SAVE_LINK'] = $WFD_BTN_SAVE_LINK;
	$a_data['WFD_BTN_CON_STATUS'] = $WFD_BTN_CON_STATUS;
	$a_data['WFD_BTN_CON_RESIZE'] = $WFD_BTN_CON_RESIZE;
	$a_data['WFD_BTN_CON_LABEL'] = $WFD_BTN_CON_LABEL;
	$a_data['WFD_BTN_CON_LINK'] = $WFD_BTN_CON_LINK;
	$a_data['WFD_DETAIL_TOPIC'] = $WFD_DETAIL_TOPIC;
	$a_data['WFD_DETAIL_TOPIC_ALIGN'] = $WFD_DETAIL_TOPIC_ALIGN;
	$a_data['WFD_DETAIL_DESC'] = $WFD_DETAIL_DESC;
	$a_data['WFD_DETAIL_DESC_ALIGN'] = $WFD_DETAIL_DESC_ALIGN;
	$a_data['WFD_PERMISS_VIEW'] = $WFD_PERMISS_VIEW;
	$a_data['WFD_PERMISS_ACTION'] = $WFD_PERMISS_ACTION;
	$a_data['WFD_PERMISS_DELETE'] = $WFD_PERMISS_DELETE;
	$a_data['WFD_PERMISS_EDIT'] = $WFD_PERMISS_EDIT;
	$a_data['M_GROUP_ID'] = $M_GROUP_ID;
	$a_data['WFD_THROW_M_F_SOURCE'] = $WFD_THROW_M_F_SOURCE;
	$a_data['WFD_THROW_M_F_DESTINATION'] = $WFD_THROW_M_F_DESTINATION;
	$a_data['DETAIL_G_ID'] = $DETAIL_G_ID;
	$a_data['WFD_ALERT_STEP'] = $WFD_ALERT_STEP;
	$a_data['WFD_THROW_NEXT_STEP'] = $WFD_THROW_NEXT_STEP;
	$a_data['WFD_BTN_ATTACH_STATUS'] = $WFD_BTN_ATTACH_STATUS;
	$a_data['WFD_BTN_ATTACH_RESIZE'] = $WFD_BTN_ATTACH_RESIZE;
	$a_data['WFD_BTN_ATTACH_LABEL'] = $WFD_BTN_ATTACH_LABEL;
	$a_data['WFD_BTN_ATTACH_LINK'] = $WFD_BTN_ATTACH_LINK;
	$a_data['WFD_CHANGE_FLOW_NAME'] = $WFD_CHANGE_FLOW_NAME;
	$a_data['WFD_CHANGE_STEP_NAME'] = $WFD_CHANGE_STEP_NAME;
	if($_FILES["WFD_TOP_INCLUDE_N"]["size"]>0)
	{
		$name = $_FILES['WFD_TOP_INCLUDE_N']['name'];
		$filename = "../plugin/".$name;
		copy($_FILES["WFD_TOP_INCLUDE_N"]["tmp_name"],$filename); 
		$a_data['WFD_TOP_INCLUDE'] = $name;
	}else{
		$a_data['WFD_TOP_INCLUDE'] = $WFD_TOP_INCLUDE;
	}
	if($_FILES["WFD_BOTTOM_INCLUDE_N"]["size"]>0)
	{
		$name = $_FILES['WFD_BOTTOM_INCLUDE_N']['name'];
		$filename = "../plugin/".$name;
		copy($_FILES["WFD_BOTTOM_INCLUDE_N"]["tmp_name"],$filename);

		$a_data['WFD_BOTTOM_INCLUDE'] = $name;
	}else{
		$a_data['WFD_BOTTOM_INCLUDE'] = $WFD_BOTTOM_INCLUDE;
	}
	
	
	$a_cond[$pk_name] = $pk_id;

	db::db_update($table, $a_data, $a_cond);
}
elseif($process == "delete")
{
	/*$a_cond[$pk_name] = $pk_id;

	db::db_delete($table, $a_cond);*/

	delete_wf_detail($pk_id);
	
	db::db_close();
	exit;
}
elseif($process == "re_order")
{
	$total_row = conText($_POST['total_row']);
	for($i=1; $i<$total_row; $i++)
	{
		$WFD_ORDER = conText($_POST['WFD_ORDER'.$i]);
		$id = conText($_POST['id'.$i]);
 
		$a_data['WFD_ORDER'] = $WFD_ORDER;
		$a_cond[$pk_name] = $id;
		
		db::db_update($table, $a_data, $a_cond);
	}

}

db::db_close();

if($process == "edit" && $back_page_old == "Y")
{
	$url_back = $_SERVER["HTTP_REFERER"];
}

redirect($url_back);
?>