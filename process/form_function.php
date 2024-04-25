<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$process = conText($_REQUEST['process']);
$table = "FORM_MAIN";
$pk_name = "FM_ID";
$pk_id = conText($_REQUEST['id']);
$url_back = "form.php";
$table_alias = conText($_POST['WF_ALIAS']);


$WF_GROUP_ID = conText($_POST['WF_GROUP_ID']);
$WF_MAIN_ORDER = conText($_POST['WF_MAIN_ORDER']);
$WF_MAIN_NAME = conText($_POST['WF_MAIN_NAME']);
$WF_MAIN_REMARK = conText($_POST['WF_MAIN_REMARK']);
$WF_MAIN_TYPE = conText($_POST['WF_MAIN_TYPE']);
$WF_MAIN_SHORTNAME = conText($_POST['WF_MAIN_SHORTNAME']);
$WF_MAIN_URL = conText($_POST['WF_MAIN_URL']);
$WF_MAIN_STATUS = conText($_POST['WF_MAIN_STATUS']);
$WF_MAIN_TAB_STATUS = conText($_POST['WF_MAIN_TAB_STATUS']);
$WF_MAIN_ICON = conText($_POST['WF_MAIN_ICON']);
$WF_VIEW_COL_HEADER = conText($_POST['WF_VIEW_COL_HEADER']);
$WF_VIEW_COL_DATA = conText($_POST['WF_VIEW_COL_DATA']);
$WF_VIEW_COL_ALIGN = conText($_POST['WF_VIEW_COL_ALIGN']);
$WF_VIEW_COL_SIZE = conText($_POST['WF_VIEW_COL_SIZE']);
$WF_BTN_ADD_STATUS = conText($_POST['WF_BTN_ADD_STATUS']);
$WF_BTN_ADD_RESIZE = conText($_POST['WF_BTN_ADD_RESIZE']);
$WF_BTN_ADD_LABEL = conText($_POST['WF_BTN_ADD_LABEL']);
$WF_BTN_ADD_LINK = conText($_POST['WF_BTN_ADD_LINK']);
$WF_BTN_CON_STATUS = conText($_POST['WF_BTN_CON_STATUS']);
$WF_BTN_CON_RESIZE = conText($_POST['WF_BTN_CON_RESIZE']);
$WF_BTN_CON_LABEL = conText($_POST['WF_BTN_CON_LABEL']);
$WF_BTN_CON_LINK = conText($_POST['WF_BTN_CON_LINK']);
$WF_BTN_STEP_STATUS = conText($_POST['WF_BTN_STEP_STATUS']);
$WF_BTN_STEP_RESIZE = conText($_POST['WF_BTN_STEP_RESIZE']);
$WF_BTN_STEP_LABEL = conText($_POST['WF_BTN_STEP_LABEL']);
$WF_BTN_STEP_LINK = conText($_POST['WF_BTN_STEP_LINK']);
$WF_BTN_DEL_STATUS = conText($_POST['WF_BTN_DEL_STATUS']);
$WF_BTN_DEL_RESIZE = conText($_POST['WF_BTN_DEL_RESIZE']);
$WF_BTN_DEL_LABEL = conText($_POST['WF_BTN_DEL_LABEL']);
$WF_BTN_DEL_LINK = conText($_POST['WF_BTN_DEL_LINK']);
$WF_BTN_BACK_STATUS = conText($_POST['WF_BTN_BACK_STATUS']);
$WF_BTN_BACK_RESIZE = conText($_POST['WF_BTN_BACK_RESIZE']);
$WF_BTN_BACK_LABEL = conText($_POST['WF_BTN_BACK_LABEL']);
$WF_BTN_BACK_LINK = conText($_POST['WF_BTN_BACK_LINK']);
$WF_DETAIL_TOPIC = conText($_POST['WF_DETAIL_TOPIC']);
$WF_DETAIL_TOPIC_ALIGN = conText($_POST['WF_DETAIL_TOPIC_ALIGN']);
$WF_DETAIL_DESC = conText($_POST['WF_DETAIL_DESC']);
$WF_DETAIL_DESC_ALIGN = conText($_POST['WF_DETAIL_DESC_ALIGN']);
$WF_PERMISS_VIEW = conText($_POST['WF_PERMISS_VIEW']);
$WF_PERMISS_ACTION = conText($_POST['WF_PERMISS_ACTION']);
$WF_PERMISS_DELETE = conText($_POST['WF_PERMISS_DELETE']);
$WF_M_TOPIC = conText($_POST['WF_M_TOPIC']);
$WF_M_TOPIC_DESC = conText($_POST['WF_M_TOPIC_DESC']);
$WF_M_ALERT = conText($_POST['WF_M_ALERT']);
$WF_M_ALERT_DESC = conText($_POST['WF_M_ALERT_DESC']);
$WF_VIEW_COL_SHOW_NO = conText($_POST['WF_VIEW_COL_SHOW_NO']);
$WF_MAIN_TOP_INCLUDE = conText($_POST['WF_MAIN_TOP_INCLUDE']);
$WF_MAIN_BOTTOM_INCLUDE = conText($_POST['WF_MAIN_BOTTOM_INCLUDE']);
$WF_MAIN_DEL_INCLUDE = conText($_POST['WF_MAIN_DEL_INCLUDE']);
$WF_MAIN_LIST_INCLUDE = conText($_POST['WF_MAIN_LIST_INCLUDE']);
$WF_MAIN_DEFAULT_ORDER = conText($_POST['WF_MAIN_DEFAULT_ORDER']);
$WF_VIEW_COL_ORDER = conText($_POST['WF_VIEW_COL_ORDER']);
$WF_DETAIL_FIRST_VIEW = conText($_POST['WF_DETAIL_FIRST_VIEW']);

$WF_MAIN_STATUS = $WF_MAIN_STATUS == "" ? "N" : $WF_MAIN_STATUS;
$WF_MAIN_TAB_STATUS = $WF_MAIN_TAB_STATUS == "" ? "N" : $WF_MAIN_TAB_STATUS;
$WF_VIEW_COL_SHOW_NO = $WF_VIEW_COL_SHOW_NO == "" ? "N" : $WF_VIEW_COL_SHOW_NO;
$WF_MAIN_SHORTNAME = strtoupper($table_alias.$WF_MAIN_SHORTNAME);

$WF_BTN_ADD_RESIZE = $WF_BTN_ADD_RESIZE == "" ? "N" : $WF_BTN_ADD_RESIZE;
$WF_BTN_ADD_STATUS = $WF_BTN_ADD_STATUS == "" ? "N" : $WF_BTN_ADD_STATUS;
$WF_BTN_CON_STATUS = $WF_BTN_CON_STATUS == "" ? "N" : $WF_BTN_CON_STATUS;
$WF_BTN_CON_RESIZE = $WF_BTN_CON_RESIZE == "" ? "N" : $WF_BTN_CON_RESIZE;
$WF_BTN_BACK_STATUS = $WF_BTN_BACK_STATUS == "" ? "N" : $WF_BTN_BACK_STATUS;
$WF_BTN_BACK_RESIZE = $WF_BTN_BACK_RESIZE == "" ? "N" : $WF_BTN_BACK_RESIZE;
$WF_BTN_STEP_STATUS = $WF_BTN_STEP_STATUS == "" ? "N" : $WF_BTN_STEP_STATUS;
$WF_BTN_STEP_RESIZE = $WF_BTN_STEP_RESIZE == "" ? "N" : $WF_BTN_STEP_RESIZE;
$WF_BTN_DEL_STATUS = $WF_BTN_DEL_STATUS == "" ? "N" : $WF_BTN_DEL_STATUS;
$WF_BTN_DEL_RESIZE = $WF_BTN_DEL_RESIZE == "" ? "N" : $WF_BTN_DEL_RESIZE;
/*
$WF_BTN_ADD_LABEL = $WF_BTN_ADD_LABEL == "" ? "เพิ่มข้อมูล" : $WF_BTN_ADD_LABEL;
$WF_BTN_CON_LABEL = $WF_BTN_CON_LABEL == "" ? "ดำเนินการ" : $WF_BTN_CON_LABEL;
$WF_BTN_BACK_LABEL = $WF_BTN_BACK_LABEL == "" ? "กลับหน้าหลัก" : $WF_BTN_BACK_LABEL;
$WF_BTN_STEP_LABEL = $WF_BTN_STEP_LABEL == "" ? "ขั้นตอนการทำงาน" : $WF_BTN_STEP_LABEL;
$WF_BTN_DEL_LABEL = $WF_BTN_DEL_LABEL == "" ? "ลบ" : $WF_BTN_DEL_LABEL;
*/

if($process == "add")
{
	if($_FILES["WF_MAIN_TOP_INCLUDE"]["size"]>0)
	{
		$type_name = explode(".",$_FILES['WF_MAIN_TOP_INCLUDE']['name']);
		$extend = $type_name[(count($type_name) - 1)];
		$name = "icon_".$WF_MAIN_SHORTNAME."_".date("YmdHis").".".$extend;
		$filename = "../form/".$name;
		copy($_FILES["WF_MAIN_TOP_INCLUDE"]["tmp_name"],$filename);

		$a_data['WF_MAIN_TOP_INCLUDE'] = $name;
	}
	if($_FILES["WF_MAIN_BOTTOM_INCLUDE"]["size"]>0)
	{
		$type_name = explode(".",$_FILES['WF_MAIN_BOTTOM_INCLUDE']['name']);
		$extend = $type_name[(count($type_name) - 1)];
		$name = "icon_".$WF_MAIN_SHORTNAME."_".date("YmdHis").".".$extend;
		$filename = "../form/".$name;
		copy($_FILES["WF_MAIN_BOTTOM_INCLUDE"]["tmp_name"],$filename);

		$a_data['WF_MAIN_BOTTOM_INCLUDE'] = $name;
	}
	if($_FILES["WF_MAIN_DEL_INCLUDE"]["size"]>0)
	{
		$type_name = explode(".",$_FILES['WF_MAIN_DEL_INCLUDE']['name']);
		$extend = $type_name[(count($type_name) - 1)];
		$name = "icon_".$WF_MAIN_SHORTNAME."_".date("YmdHis").".".$extend;
		$filename = "../form/".$name;
		copy($_FILES["WF_MAIN_DEL_INCLUDE"]["tmp_name"],$filename);

		$a_data['WF_MAIN_DEL_INCLUDE'] = $name;
	}
	
	
	

	$a_data['WF_GROUP_ID'] = $WF_GROUP_ID;
	$a_data['WF_MAIN_ORDER'] = $WF_MAIN_ORDER;
	$a_data['WF_MAIN_NAME'] = $WF_MAIN_NAME;
	$a_data['WF_MAIN_REMARK'] = $WF_MAIN_REMARK;
	$a_data['WF_MAIN_TYPE'] = $WF_MAIN_TYPE;
	$a_data['WF_MAIN_SHORTNAME'] = $WF_MAIN_SHORTNAME;
	$a_data['WF_MAIN_URL'] = $WF_MAIN_URL;
	$a_data['WF_MAIN_STATUS'] = $WF_MAIN_STATUS;
	$a_data['WF_MAIN_TAB_STATUS'] = $WF_MAIN_TAB_STATUS;

	db::db_insert($table, $a_data, $pk_name);


	if(db::$_dbType == "MSSQL")
	{
		$data_type = "int";
		$data_length = "IDENTITY(1,1)";
	}
	elseif(db::$_dbType == "MYSQL")
	{
		$data_type = "int";
		$data_length = "10";
	}
	elseif(db::$_dbType == "ORACLE")
	{
		$data_type = "NUMBER";
		$data_length = "20";
	}


	$get_type_int = array_search('int', $arr_data_type);

	create_table($WF_MAIN_SHORTNAME, 'F_ID', $data_type, $data_length);

	add_field($WF_MAIN_SHORTNAME, 'WF_MAIN_ID', $get_type_int, '10', 'FK WF_MAIN');
	add_field($WF_MAIN_SHORTNAME, 'WFD_ID', $get_type_int, '10', 'FK WF_DETAIL');
	add_field($WF_MAIN_SHORTNAME, 'WFR_ID', $get_type_int, '10', 'FK WFR_*');
	add_field($WF_MAIN_SHORTNAME, 'WF_TYPE', $get_type_int, '10', 'ประเภท');
	add_field($WF_MAIN_SHORTNAME, 'F_TEMP_ID', $get_type_int, '10', 'Temp ID');
	add_field($WF_MAIN_SHORTNAME, 'F_CREATE_DATE', 'DATE', '', 'วันที่สร้าง');
	add_field($WF_MAIN_SHORTNAME, 'F_CREATE_BY', $get_type_int, '10', 'สร้างโดย');
	add_field($WF_MAIN_SHORTNAME, 'F_UPDATE_DATE', 'DATE', '', 'วันที่แก้ไข');
	add_field($WF_MAIN_SHORTNAME, 'F_UPDATE_BY', $get_type_int, '10', 'แก้ไขโดย');
}
elseif($process == "edit")
{
	if($_FILES["UPLOAD_FILE"]["size"]>0)
	{
		$type_name = explode(".",$_FILES['UPLOAD_FILE']['name']);
		$extend = $type_name[(count($type_name) - 1)];
		$name = "icon_".$WF_MAIN_SHORTNAME."_".date("YmdHis").".".$extend;
		$filename = "../icon/".$name;
		copy($_FILES["UPLOAD_FILE"]["tmp_name"],$filename);

		$a_data['WF_MAIN_ICON'] = $name;
	}else{
		$a_data['WF_MAIN_ICON'] = $WF_MAIN_ICON;
	}
	
	if($_FILES["WF_MAIN_TOP_INCLUDE_N"]["size"]>0)
	{
		$name = $_FILES['WF_MAIN_TOP_INCLUDE_N']['name'];
		$filename = "../plugin/".$name;
		copy($_FILES["WF_MAIN_TOP_INCLUDE_N"]["tmp_name"],$filename); 
		$a_data['WF_MAIN_TOP_INCLUDE'] = $name;
	}else{
		$a_data['WF_MAIN_TOP_INCLUDE'] = $WF_MAIN_TOP_INCLUDE;
	}
	if($_FILES["WF_MAIN_LIST_INCLUDE_N"]["size"]>0)
	{
		$name = $_FILES['WF_MAIN_LIST_INCLUDE_N']['name'];
		$filename = "../plugin/".$name;
		copy($_FILES["WF_MAIN_LIST_INCLUDE_N"]["tmp_name"],$filename); 
		$a_data['WF_MAIN_LIST_INCLUDE'] = $name;
	}else{
		$a_data['WF_MAIN_LIST_INCLUDE'] = $WF_MAIN_LIST_INCLUDE;
	}
	if($_FILES["WF_MAIN_BOTTOM_INCLUDE_N"]["size"]>0)
	{
		$name = $_FILES['WF_MAIN_BOTTOM_INCLUDE_N']['name'];
		$filename = "../plugin/".$name;
		copy($_FILES["WF_MAIN_BOTTOM_INCLUDE_N"]["tmp_name"],$filename);

		$a_data['WF_MAIN_BOTTOM_INCLUDE'] = $name;
	}else{
		$a_data['WF_MAIN_BOTTOM_INCLUDE'] = $WF_MAIN_BOTTOM_INCLUDE;
	}
	
	if($_FILES["WF_MAIN_DEL_INCLUDE_N"]["size"]>0)
	{
		$name = $_FILES['WF_MAIN_DEL_INCLUDE_N']['name'];
		$filename = "../plugin/".$name;
		copy($_FILES["WF_MAIN_DEL_INCLUDE_N"]["tmp_name"],$filename);

		$a_data['WF_MAIN_DEL_INCLUDE'] = $name;
	}else{
		$a_data['WF_MAIN_DEL_INCLUDE'] = $WF_MAIN_DEL_INCLUDE;
	}
	
	
	
	$a_data['WF_GROUP_ID'] = $WF_GROUP_ID;
	$a_data['WF_MAIN_ORDER'] = $WF_MAIN_ORDER;
	$a_data['WF_MAIN_NAME'] = $WF_MAIN_NAME;
	$a_data['WF_MAIN_REMARK'] = $WF_MAIN_REMARK;
	$a_data['WF_MAIN_TYPE'] = $WF_MAIN_TYPE;
	$a_data['WF_MAIN_DEFAULT_ORDER'] = $WF_MAIN_DEFAULT_ORDER;
	$a_data['WF_VIEW_COL_ORDER'] = $WF_VIEW_COL_ORDER;
	$a_data['WF_MAIN_URL'] = $WF_MAIN_URL;
	$a_data['WF_DETAIL_FIRST_VIEW'] = $WF_DETAIL_FIRST_VIEW;
	$a_data['WF_MAIN_STATUS'] = $WF_MAIN_STATUS;
	$a_data['WF_MAIN_TAB_STATUS'] = $WF_MAIN_TAB_STATUS;
	$a_data['WF_VIEW_COL_HEADER'] = $WF_VIEW_COL_HEADER;
	$a_data['WF_VIEW_COL_DATA'] = $WF_VIEW_COL_DATA;
	$a_data['WF_VIEW_COL_ALIGN'] = $WF_VIEW_COL_ALIGN;
	$a_data['WF_VIEW_COL_SIZE'] = $WF_VIEW_COL_SIZE;
	$a_data['WF_BTN_ADD_STATUS'] = $WF_BTN_ADD_STATUS;
	$a_data['WF_BTN_ADD_RESIZE'] = $WF_BTN_ADD_RESIZE;
	$a_data['WF_BTN_ADD_LABEL'] = $WF_BTN_ADD_LABEL;
	$a_data['WF_BTN_ADD_LINK'] = $WF_BTN_ADD_LINK;
	$a_data['WF_BTN_CON_STATUS'] = $WF_BTN_CON_STATUS;
	$a_data['WF_BTN_CON_RESIZE'] = $WF_BTN_CON_RESIZE;
	$a_data['WF_BTN_CON_LABEL'] = $WF_BTN_CON_LABEL;
	$a_data['WF_BTN_CON_LINK'] = $WF_BTN_CON_LINK;
	$a_data['WF_BTN_STEP_STATUS'] = $WF_BTN_STEP_STATUS;
	$a_data['WF_BTN_STEP_RESIZE'] = $WF_BTN_STEP_RESIZE;
	$a_data['WF_BTN_STEP_LABEL'] = $WF_BTN_STEP_LABEL;
	$a_data['WF_BTN_STEP_LINK'] = $WF_BTN_STEP_LINK;
	$a_data['WF_BTN_DEL_STATUS'] = $WF_BTN_DEL_STATUS;
	$a_data['WF_BTN_DEL_RESIZE'] = $WF_BTN_DEL_RESIZE;
	$a_data['WF_BTN_DEL_LABEL'] = $WF_BTN_DEL_LABEL;
	$a_data['WF_BTN_DEL_LINK'] = $WF_BTN_DEL_LINK;
	$a_data['WF_BTN_BACK_STATUS'] = $WF_BTN_BACK_STATUS;
	$a_data['WF_BTN_BACK_RESIZE'] = $WF_BTN_BACK_RESIZE;
	$a_data['WF_BTN_BACK_LABEL'] = $WF_BTN_BACK_LABEL;
	$a_data['WF_BTN_BACK_LINK'] = $WF_BTN_BACK_LINK;
	$a_data['WF_DETAIL_TOPIC'] = $WF_DETAIL_TOPIC;
	$a_data['WF_DETAIL_TOPIC_ALIGN'] = $WF_DETAIL_TOPIC_ALIGN;
	$a_data['WF_DETAIL_DESC'] = $WF_DETAIL_DESC;
	$a_data['WF_DETAIL_DESC_ALIGN'] = $WF_DETAIL_DESC_ALIGN;
	$a_data['WF_PERMISS_VIEW'] = $WF_PERMISS_VIEW;
	$a_data['WF_PERMISS_ACTION'] = $WF_PERMISS_ACTION;
	$a_data['WF_PERMISS_DELETE'] = $WF_PERMISS_DELETE;
	$a_data['WF_M_TOPIC'] = $WF_M_TOPIC;
	$a_data['WF_M_TOPIC_DESC'] = $WF_M_TOPIC_DESC;
	$a_data['WF_M_ALERT'] = $WF_M_ALERT;
	$a_data['WF_M_ALERT_DESC'] = $WF_M_ALERT_DESC;
	$a_data['WF_VIEW_COL_SHOW_NO'] = $WF_VIEW_COL_SHOW_NO;
	
	$a_cond[$pk_name] = $pk_id;

	db::db_update($table, $a_data, $a_cond);
	
}
elseif($process == "delete")
{
	$a_cond[$pk_name] = $pk_id;

	$sql_main = db::query("select WF_MAIN_SHORTNAME from WF_MAIN where WF_MAIN_ID = '".$pk_id."'");
	$rec_main = db::fetch_array($sql_main);

	if($_GET['drop'] == "Y" && $rec_main['WF_MAIN_SHORTNAME'] != "")
	{

		drop_table($rec_main['WF_MAIN_SHORTNAME']);
	}
	db::db_delete($table, $a_cond);
}
elseif($process == "re_order")
{
	
	$TOTAL_ROW = conText($_POST['total_row']);
	
	for($i=1; $i<=$TOTAL_ROW; $i++)
	{
		$TOTAL_J = conText($_POST['total_row'.$i]);
		for($j=1; $j<$TOTAL_J; $j++)
		{
			$WF_MAIN_STATUS = conText($_POST['WF_MAIN_STATUS'.$i."_".$j]);
			$WF_MAIN_ORDER = conText($_POST['WF_MAIN_ORDER'.$i."_".$j]);
			$id = conText($_POST['id'.$i."_".$j]);

			$a_data['WF_MAIN_STATUS'] = $WF_MAIN_STATUS;
			$a_data['WF_MAIN_ORDER'] = $WF_MAIN_ORDER;
			$a_cond[$pk_name] = $id;
			
			db::db_update($table, $a_data, $a_cond);
		}
	}
	echo 'Y';
	db::db_close();
	exit;
}

db::db_close();
redirect($url_back);
?>