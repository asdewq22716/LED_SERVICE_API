<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$process = $_REQUEST['process'];

$table = "WF_MAIN";
$pk_name = "WF_MAIN_ID";
$pk_id = $_REQUEST['id'];
$WF_TYPE = conText($_POST['WF_TYPE']);
$WF_VIEW_ID = conText($_POST['WF_VIEW_ID']);
$back_page_old = conText($_POST['back_page_old']);

if($_POST['WF_MAIN_SHORTNAME'] == ''){
	$table_alias = '';
}else{
	$table_alias = $_POST['WF_ALIAS'];
	
}

if($WF_TYPE == "W"){
$url_back = "workflow.php";
$WF_FIELD_PK = "WFR_ID";
}elseif($WF_TYPE == "F"){
$url_back = "form.php";	
$WF_FIELD_PK = "F_ID";
}elseif($WF_TYPE == "M"){
$url_back = "master.php";
$WF_FIELD_PK = strtoupper(conText($_POST['WF_FIELD_PK']));
}elseif($WF_TYPE == "R"){
$url_back = "report.php";
$WF_FIELD_PK = strtoupper(conText($_POST['WF_FIELD_PK']));
}


$WF_GROUP_ID = conText($_POST['WF_GROUP_ID']); 

$WF_MAIN_ORDER = db::get_max("WF_MAIN", "WF_MAIN_ORDER",array('WF_GROUP_ID'=>$WF_GROUP_ID)) + 1;


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
$WF_VIEW_COL_FORMAT = conText($_POST['WF_VIEW_COL_FORMAT']);
$WF_VIEW_COL_DRILL = conText($_POST['WF_VIEW_COL_DRILL']);
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
$WF_BTN_COPY_STATUS = conText($_POST['WF_BTN_COPY_STATUS']);
$WF_BTN_COPY_RESIZE = conText($_POST['WF_BTN_COPY_RESIZE']);
$WF_BTN_COPY_LABEL = conText($_POST['WF_BTN_COPY_LABEL']);
$WF_BTN_COPY_LINK = conText($_POST['WF_BTN_COPY_LINK']);
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
$WF_PERMISS_EDIT = conText($_POST['WF_PERMISS_EDIT']);
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
$WF_EXCEL_FIELD = conText($_POST['WF_EXCEL_FIELD']);
$WF_PUPLIC_S_URL = conText($_POST['WF_PUPLIC_S_URL']);
/*if($WF_TYPE == "R"){
$WF_R_TOTAL = conText($_POST['WF_VIEW_COL_ORDER']);
}else{
$WF_VIEW_COL_ORDER = conText($_POST['WF_VIEW_COL_ORDER']);
}*/
$WF_R_TOTAL = conText($_POST['WF_R_TOTAL']);
$WF_VIEW_COL_ORDER = conText($_POST['WF_VIEW_COL_ORDER']);
$WF_DETAIL_FIRST_VIEW = conText($_POST['WF_DETAIL_FIRST_VIEW']);
$WF_SEARCH_SHOW = conText($_POST['WF_SEARCH_SHOW']);
$WF_SPLIT_PAGE = conText($_POST['WF_SPLIT_PAGE']);
$WF_TABLE_HTML = conText($_POST['WF_TABLE_HTML']);
$WF_MAIN_SEARCH = conText($_POST['WF_MAIN_SEARCH']);
$WF_MAIN_ID_SEARCH = conText($_POST['WF_MAIN_ID_SEARCH']);
$WF_MAIN_SEARCH_SQL = conText($_POST['WF_MAIN_SEARCH_SQL']);
$WF_DET_STEP_COL = conText($_POST['WF_DET_STEP_COL']);
$WF_DET_STEP_LABEL_COL = conText($_POST['WF_DET_STEP_LABEL_COL']);
$WF_DET_NEXT_COL = conText($_POST['WF_DET_NEXT_COL']);
$WF_DET_NEXT_LABEL_COL = conText($_POST['WF_DET_NEXT_LABEL_COL']);
$WF_CHANGE_FLOW_NAME = conText($_POST['WF_CHANGE_FLOW_NAME']);
$WF_CHANGE_STEP_NAME = conText($_POST['WF_CHANGE_STEP_NAME']);

$WF_DET_STEP_COL = $WF_DET_STEP_COL == "" ? "N" : $WF_DET_STEP_COL;
$WF_DET_NEXT_COL = $WF_DET_NEXT_COL == "" ? "N" : $WF_DET_NEXT_COL;

$WF_MAIN_STATUS = $WF_MAIN_STATUS == "" ? "N" : $WF_MAIN_STATUS;
$WF_MAIN_TAB_STATUS = $WF_MAIN_TAB_STATUS == "" ? "N" : $WF_MAIN_TAB_STATUS;
$WF_VIEW_COL_SHOW_NO = $WF_VIEW_COL_SHOW_NO == "" ? "N" : $WF_VIEW_COL_SHOW_NO;
$WF_SEARCH_SHOW = $WF_SEARCH_SHOW == "" ? "N" : $WF_SEARCH_SHOW;
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
$WF_BTN_COPY_STATUS = $WF_BTN_COPY_STATUS == "" ? "N" : $WF_BTN_COPY_STATUS;
$WF_BTN_COPY_RESIZE = $WF_BTN_COPY_RESIZE == "" ? "N" : $WF_BTN_COPY_RESIZE;
$WF_LINE_CODE = conText($_POST['WF_LINE_CODE']);
$WF_LINE_COL = conText($_POST['WF_LINE_COL']);
$WF_REPORT_HEAD_STATUS = conText($_POST['WF_REPORT_HEAD_STATUS']);
$WF_REPORT_HEADER = addslashes($_POST['WF_REPORT_HEADER']);
$WF_R_TYPE = conText($_POST['WF_R_TYPE']);
$WF_R_GFIELD = conText($_POST['WF_R_GFIELD']);
$WF_R_GTYPE = conText($_POST['WF_R_GTYPE']);
$WF_R_SFIELD = conText($_POST['WF_R_SFIELD']);
$WF_R_SQL = conText($_POST['WF_R_SQL']);
$WF_R_XFIELD = conText($_POST['WF_R_XFIELD']);
$WF_R_YFIELD = conText($_POST['WF_R_YFIELD']);
$WF_R_XORDER = conText($_POST['WF_R_XORDER']);
$WF_R_YORDER = conText($_POST['WF_R_YORDER']);
$WF_R_TOTAL_USE = conText($_POST['WF_R_TOTAL_USE']);
$WF_R_SCOL_USE = conText($_POST['WF_R_SCOL_USE']);
$WF_R_SCOL_TEXT = conText($_POST['WF_R_SCOL_TEXT']);
$WF_R_SCOL_TOTAL = conText($_POST['WF_R_SCOL_TOTAL']);
$WF_R_SCOL_ALIGN = conText($_POST['WF_R_SCOL_ALIGN']);
$WF_R_SCOL_SIZE = conText($_POST['WF_R_SCOL_SIZE']);
$WF_R_SCOL_FORMAT = conText($_POST['WF_R_SCOL_FORMAT']);
$WF_R_SCOL_DRILL = conText($_POST['WF_R_SCOL_DRILL']);
$WF_PER_PAGE = conText($_POST['WF_PER_PAGE']);
$WF_STEP_NEXT_TAB = conText($_POST['WF_STEP_NEXT_TAB']);
$WF_JQUERY_VALIDATE = conText($_POST['WF_JQUERY_VALIDATE']);
$WF_PARENT_USE = conText($_POST['WF_PARENT_USE']);
$WF_PARENT_FIELD = conText($_POST['WF_PARENT_FIELD']);
$WF_PARENT_SHOW = conText($_POST['WF_PARENT_SHOW']);
$WF_SERVICES_TYPE = conText($_POST['WF_SERVICES_TYPE']);
$WF_EXPORT_PDF = conText($_POST['WF_EXPORT_PDF']);
$WF_EXPORT_WORD = conText($_POST['WF_EXPORT_WORD']);
$WF_EXPORT_EXCEL = conText($_POST['WF_EXPORT_EXCEL']);
$WF_SET_PAGE_PDF = conText($_POST['WF_SET_PAGE_PDF']);
$WF_SET_PAGE_WORD = conText($_POST['WF_SET_PAGE_WORD']);

$WFD_DETAIL_EMAIL = conText($_POST['WFD_DETAIL_EMAIL']);
$WFD_DETAIL_EMAIL_DESC = conText($_POST['WFD_DETAIL_EMAIL_DESC']);
$WFD_EMAIL_SETTING = conText($_POST['WFD_EMAIL_SETTING']);
$WFD_DETAIL_EMAIL_CAL = conText($_POST['WFD_DETAIL_EMAIL_CAL']);
$WFD_DETAIL_EMAIL_CAL_STIME = conText($_POST['WFD_DETAIL_EMAIL_CAL_STIME']);
$WFD_DETAIL_EMAIL_CAL_EDATE = conText($_POST['WFD_DETAIL_EMAIL_CAL_EDATE']);
$WFD_DETAIL_EMAIL_CAL_ETIME = conText($_POST['WFD_DETAIL_EMAIL_CAL_ETIME']);
$WFD_DETAIL_EMAIL_CAL_PLACE = conText($_POST['WFD_DETAIL_EMAIL_CAL_PLACE']);
$WFD_EMAIL_SETTING_EDIT = conText($_POST['WFD_EMAIL_SETTING_EDIT']);
$WFD_EMAIL_SEND_SETTING = conText($_POST['WFD_EMAIL_SEND_SETTING']);
$WFD_EMAIL_SETTING_FIELD = conText($_POST['WFD_EMAIL_SETTING_FIELD']);

if($WF_EXPORT_PDF != "Y"){
	$WF_EXPORT_PDF = "N";
}
if($WF_EXPORT_WORD != "Y"){
	$WF_EXPORT_WORD = "N";
}
if($WF_EXPORT_EXCEL != "Y"){
	$WF_EXPORT_EXCEL = "N";
}

$WF_REPORT_HEADER = trim(preg_replace("/\r\n|\r|\n/", '', $WF_REPORT_HEADER));
/*echo "<textarea>".$WF_REPORT_HEADER."</textarea>";
echo '<br><br>';
echo conText($WF_REPORT_HEADER);
echo '<br><br>';
echo $a = strlen($WF_REPORT_HEADER);
exit;
*/
/*
$WF_BTN_ADD_LABEL = $WF_BTN_ADD_LABEL == "" ? "เพิ่มข้อมูล" : $WF_BTN_ADD_LABEL;
$WF_BTN_CON_LABEL = $WF_BTN_CON_LABEL == "" ? "ดำเนินการ" : $WF_BTN_CON_LABEL;
$WF_BTN_BACK_LABEL = $WF_BTN_BACK_LABEL == "" ? "กลับหน้าหลัก" : $WF_BTN_BACK_LABEL;
$WF_BTN_STEP_LABEL = $WF_BTN_STEP_LABEL == "" ? "ขั้นตอนการทำงาน" : $WF_BTN_STEP_LABEL;
$WF_BTN_DEL_LABEL = $WF_BTN_DEL_LABEL == "" ? "ลบ" : $WF_BTN_DEL_LABEL;
*/

if(conText($_POST['process'])  == "add")
{
	if($WF_TYPE == "W"){
		if($WF_MAIN_TYPE == 'W'){
			create_table_wf($WF_MAIN_SHORTNAME);
		}
	}
	if($WF_TYPE == "F" AND $WF_MAIN_TYPE == 'W')
	{
		if(db::$_dbType == "MSSQL")
		{
			$data_type = "int";
			$data_length = "";
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

		$get_type_int = $data_type;
		//$get_type_int = array_search('int', $arr_data_type);

		create_table($WF_MAIN_SHORTNAME, $WF_FIELD_PK, $data_type, $data_length);

		add_field($WF_MAIN_SHORTNAME, 'WF_MAIN_ID', $get_type_int, '10', 'FK WF_MAIN');
		add_field($WF_MAIN_SHORTNAME, 'WFD_ID', $get_type_int, '10', 'FK WF_DETAIL');
		add_field($WF_MAIN_SHORTNAME, 'WFR_ID', $get_type_int, '10', 'FK Table_*');
		add_field($WF_MAIN_SHORTNAME, 'WFS_ID', $get_type_int, '10', 'FK WF_STEP_FORM');
		add_field($WF_MAIN_SHORTNAME, 'F_TEMP_ID', $get_type_int, '10', 'Temp ID ปกติค่าจะเท่ากับ WFR_ID ยกเว้นตอนเพิ่มครั้งแรก');
		add_field($WF_MAIN_SHORTNAME, 'F_CREATE_DATE', 'DATE', '', 'วันที่สร้าง');
		add_field($WF_MAIN_SHORTNAME, 'F_CREATE_BY', $get_type_int, '10', 'สร้างโดย');
		add_field($WF_MAIN_SHORTNAME, 'F_UPDATE_DATE', 'DATE', '', 'วันที่แก้ไข');
		add_field($WF_MAIN_SHORTNAME, 'F_UPDATE_BY', $get_type_int, '10', 'แก้ไขโดย');
	}
	if($WF_TYPE == "M" AND $WF_MAIN_TYPE == 'W')
	{
		if(db::$_dbType == "MSSQL")
		{
			$data_type = "int";
			$data_length = "";
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

		create_table($WF_MAIN_SHORTNAME, $WF_FIELD_PK, $data_type, $data_length);
	}

	if($_FILES["UPLOAD_FILE"]["size"]>0)
	{
		$name = $_FILES['UPLOAD_FILE']['name'];
		$filename = "../icon/".$name;
		copy($_FILES["UPLOAD_FILE"]["tmp_name"],$filename);

		$a_data['WF_MAIN_ICON'] = $name;
	}
	else
	{
		$a_data['WF_MAIN_ICON'] = $WF_MAIN_ICON;
	}
	$a_data['WF_TYPE'] = $WF_TYPE;
	$a_data['WF_FIELD_PK'] = $WF_FIELD_PK;
	$a_data['WF_GROUP_ID'] = $WF_GROUP_ID;
	$a_data['WF_MAIN_ORDER'] = $WF_MAIN_ORDER;
	$a_data['WF_MAIN_NAME'] = $WF_MAIN_NAME;
	$a_data['WF_MAIN_REMARK'] = $WF_MAIN_REMARK;
	$a_data['WF_MAIN_TYPE'] = $WF_MAIN_TYPE;
	$a_data['WF_MAIN_SHORTNAME'] = $WF_MAIN_SHORTNAME;
	$a_data['WF_MAIN_URL'] = $WF_MAIN_URL;
	$a_data['WF_MAIN_STATUS'] = $WF_MAIN_STATUS;
	$a_data['WF_MAIN_TAB_STATUS'] = $WF_MAIN_TAB_STATUS;
	$a_data['WF_SEARCH_SHOW'] = $WF_SEARCH_SHOW;
	$a_data['WF_PER_PAGE'] = $WF_PER_PAGE;

	$WF_MAIN_ID = db::db_insert($table, $a_data, $pk_name);
	
	if($_POST['STEP_DATA'] != ""){
		$step_data = json_decode($_POST['STEP_DATA']);
		$ORDER = 1;
		$arr_ref = array();
		$arr_ref_t = array();
		foreach($step_data->nodeDataArray as $mystep){
			//print_pre($mystep);
			if($mystep->category == "Module" OR $mystep->category == "Conditional"){
			$a_data = array();
			$a_data['WF_MAIN_ID'] = $WF_MAIN_ID;
			$a_data['WFD_NAME'] = conText($mystep->text);
			$a_data['WFD_ORDER'] = $ORDER;
			$a_data['WFD_TYPE'] = "P"; 
			$a_data['WFD_CONTINUE_NEXT_STEP'] = "Y";
			$a_data['WFD_VIEW_PREVIOUS_STEP'] = "Y";
			$a_data['WFD_BTN_ADD_STATUS'] = "Y";
			$a_data['WFD_BTN_TEMP_STATUS'] = "Y";
			$a_data['WFD_BTN_SAVE_STATUS'] = "Y";
			$a_data['WFD_BTN_CON_STATUS'] = "Y";
			$a_data['DETAIL_G_ID'] = "0";
			$a_data['WFD_REF'] = conText(',"loc":"'.$mystep->loc.'"');
			
			$WFD = db::db_insert("WF_DETAIL", $a_data, "WFD_ID");
			unset($a_data);
			$arr_ref[$mystep->key] = $WFD;
			$arr_ref_t[$mystep->key] = $mystep->category;
			$ORDER++;
			
			}
		}
		foreach($step_data->linkDataArray as $mylink){
			//print_pre($mylink);
			if($mylink->from == "1"){
				db::query("UPDATE WF_DETAIL SET WFD_TYPE = 'S' WHERE WFD_ID = '".$arr_ref[$mylink->to]."'");
			}else{
				if($arr_ref_t[$mylink->from] == "Module"){
				db::query("UPDATE WF_DETAIL SET WFD_DEFAULT_STEP = '".$arr_ref[$mylink->to]."' WHERE WFD_ID = '".$arr_ref[$mylink->from]."'");
				}else{
						$a_data = array();
						$a_data['WFD_ID'] = $arr_ref[$mylink->from];
						$a_data['WFSC_VAR'] = "Condition";
						$a_data['WFSC_OPERATE'] = "1";
						$a_data['WFSC_VALUE'] = conText($mylink->text);
						$a_data['WFSC_STEP'] = $arr_ref[$mylink->to];
						db::db_insert("WF_STEP_CON", $a_data, "WFSC_ID");
						unset($a_data);
				}
			}
		}
		//print_pre($step_data);
		redirect("workflow_detail.php?W=".$WF_MAIN_ID);
		exit;
		
	}
}
elseif(conText($_POST['process']) == "edit")
{
	if($_FILES["UPLOAD_FILE"]["size"]>0)
	{
		$name = $_FILES['UPLOAD_FILE']['name'];
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
	$a_data['WF_MAIN_NAME'] = $WF_MAIN_NAME;
	$a_data['WF_MAIN_REMARK'] = $WF_MAIN_REMARK;
	if($WF_MAIN_TYPE != ''){
	$a_data['WF_MAIN_TYPE'] = $WF_MAIN_TYPE;}
	$a_data['WF_MAIN_DEFAULT_ORDER'] = $WF_MAIN_DEFAULT_ORDER;
	//if($WF_TYPE=="R"){
	$a_data['WF_R_TOTAL'] = $WF_R_TOTAL;	
	//}else{
	$a_data['WF_VIEW_COL_ORDER'] = $WF_VIEW_COL_ORDER;
	//}
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
	$a_data['WF_BTN_COPY_STATUS'] = $WF_BTN_COPY_STATUS;
	$a_data['WF_BTN_COPY_RESIZE'] = $WF_BTN_COPY_RESIZE;
	$a_data['WF_BTN_COPY_LABEL'] = $WF_BTN_COPY_LABEL;
	$a_data['WF_BTN_COPY_LINK'] = $WF_BTN_COPY_LINK;
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
	$a_data['WF_PERMISS_EDIT'] = $WF_PERMISS_EDIT;
	$a_data['WF_M_TOPIC'] = $WF_M_TOPIC;
	$a_data['WF_M_TOPIC_DESC'] = $WF_M_TOPIC_DESC;
	$a_data['WF_M_ALERT'] = $WF_M_ALERT;
	$a_data['WF_M_ALERT_DESC'] = $WF_M_ALERT_DESC;
	$a_data['WF_VIEW_COL_SHOW_NO'] = $WF_VIEW_COL_SHOW_NO;
	$a_data['WF_SEARCH_SHOW'] = $WF_SEARCH_SHOW;
	$a_data['WF_LINE_CODE'] = $WF_LINE_CODE;
	$a_data['WF_LINE_COL'] = $WF_LINE_COL;
	$a_data['WF_SPLIT_PAGE'] = $WF_SPLIT_PAGE;	
	$a_data['WF_TABLE_HTML'] = $WF_TABLE_HTML;
	$a_data['WF_MAIN_SEARCH'] = $WF_MAIN_SEARCH;	
	$a_data['WF_MAIN_ID_SEARCH'] = $WF_MAIN_ID_SEARCH;	
	$a_data['WF_MAIN_SEARCH_SQL'] = $WF_MAIN_SEARCH_SQL;	
	$a_data['WF_REPORT_HEAD_STATUS'] = $WF_REPORT_HEAD_STATUS;
	$a_data['WF_REPORT_HEADER'] = $WF_REPORT_HEADER;
	$a_data['WF_R_TYPE'] = $WF_R_TYPE;
	$a_data['WF_R_GFIELD'] = $WF_R_GFIELD;
	$a_data['WF_R_GTYPE'] = $WF_R_GTYPE;
	$a_data['WF_R_SFIELD'] = $WF_R_SFIELD;
	$a_data['WF_R_SQL'] = $WF_R_SQL;
	$a_data['WF_R_XFIELD'] = $WF_R_XFIELD;
	$a_data['WF_R_YFIELD'] = $WF_R_YFIELD;
	$a_data['WF_R_XORDER'] = $WF_R_XORDER;
	$a_data['WF_R_YORDER'] = $WF_R_YORDER;
	$a_data['WF_R_TOTAL_USE'] = $WF_R_TOTAL_USE;
	$a_data['WF_VIEW_COL_FORMAT'] = $WF_VIEW_COL_FORMAT;
	$a_data['WF_VIEW_COL_DRILL'] = $WF_VIEW_COL_DRILL;
	$a_data['WF_DET_STEP_COL'] = $WF_DET_STEP_COL;
	$a_data['WF_DET_NEXT_COL'] = $WF_DET_NEXT_COL;
	$a_data['WF_DET_STEP_LABEL_COL'] = $WF_DET_STEP_LABEL_COL;
	$a_data['WF_DET_NEXT_LABEL_COL'] = $WF_DET_NEXT_LABEL_COL;
	$a_data['WF_R_SCOL_USE'] = $WF_R_SCOL_USE;
	$a_data['WF_R_SCOL_TEXT'] = $WF_R_SCOL_TEXT;
	$a_data['WF_R_SCOL_TOTAL'] = $WF_R_SCOL_TOTAL;
	$a_data['WF_R_SCOL_ALIGN'] = $WF_R_SCOL_ALIGN;
	$a_data['WF_R_SCOL_SIZE'] = $WF_R_SCOL_SIZE;
	$a_data['WF_R_SCOL_FORMAT'] = $WF_R_SCOL_FORMAT;
	$a_data['WF_R_SCOL_DRILL'] = $WF_R_SCOL_DRILL;
	$a_data['WF_PER_PAGE'] = $WF_PER_PAGE;
	$a_data['WF_STEP_NEXT_TAB'] = $WF_STEP_NEXT_TAB;
	$a_data['WF_JQUERY_VALIDATE'] = $WF_JQUERY_VALIDATE;
	$a_data['WF_EXCEL_FIELD'] = $WF_EXCEL_FIELD;
	$a_data['WF_CHANGE_FLOW_NAME'] = $WF_CHANGE_FLOW_NAME;
	$a_data['WF_CHANGE_STEP_NAME'] = $WF_CHANGE_STEP_NAME;
	$a_data['WF_PUPLIC_S_URL'] = $WF_PUPLIC_S_URL;
	$a_data['WF_PARENT_USE'] = $WF_PARENT_USE;
	$a_data['WF_PARENT_FIELD'] = $WF_PARENT_FIELD;
	$a_data['WF_PARENT_SHOW'] = $WF_PARENT_SHOW;
	$a_data['WF_SERVICES_TYPE'] = $WF_SERVICES_TYPE;
	$a_data['WF_EXPORT_PDF'] = $WF_EXPORT_PDF;
	$a_data['WF_EXPORT_WORD'] = $WF_EXPORT_WORD;
	$a_data['WF_EXPORT_EXCEL'] = $WF_EXPORT_EXCEL;
	$a_data['WF_SET_PAGE_PDF'] = $WF_SET_PAGE_PDF;
	$a_data['WF_SET_PAGE_WORD'] = $WF_SET_PAGE_WORD;
	$a_data['WFD_DETAIL_EMAIL'] = $WFD_DETAIL_EMAIL;
	$a_data['WFD_DETAIL_EMAIL_DESC'] = $WFD_DETAIL_EMAIL_DESC;
	$a_data['WFD_EMAIL_SETTING'] = $WFD_EMAIL_SETTING;
	$a_data['WFD_DETAIL_EMAIL_CAL'] = $WFD_DETAIL_EMAIL_CAL;
	$a_data['WFD_DETAIL_EMAIL_CAL_STIME'] = $WFD_DETAIL_EMAIL_CAL_STIME;
	$a_data['WFD_DETAIL_EMAIL_CAL_EDATE'] = $WFD_DETAIL_EMAIL_CAL_EDATE;
	$a_data['WFD_DETAIL_EMAIL_CAL_ETIME'] = $WFD_DETAIL_EMAIL_CAL_ETIME;
	$a_data['WFD_DETAIL_EMAIL_CAL_PLACE'] = $WFD_DETAIL_EMAIL_CAL_PLACE;
	$a_data['WFD_EMAIL_SETTING_EDIT'] = $WFD_EMAIL_SETTING_EDIT;
	$a_data['WFD_EMAIL_SEND_SETTING'] = $WFD_EMAIL_SEND_SETTING;
	$a_data['WFD_EMAIL_SETTING_FIELD'] = $WFD_EMAIL_SETTING_FIELD;
	
	if($WF_VIEW_ID == ""){
	$a_cond[$pk_name] = $pk_id;
	
	db::db_update($table, $a_data, $a_cond);
	}else{
	$a_cond['WF_VIEW_ID'] = $WF_VIEW_ID;
	db::db_update("WF_MAIN_VIEW", $a_data, $a_cond);
	}
}

elseif($process == "re_order")
{
	
	$TOTAL_ROW = conText($_POST['total_row']);
	
	for($i=1; $i<$TOTAL_ROW; $i++)
	{
		
		$WF_MAIN_STATUS = conText($_POST['WF_MAIN_STATUS'.$i]);
		$WF_MAIN_ORDER = conText($_POST['WF_MAIN_ORDER'.$i]);
		$id = conText($_POST['id'.$i]);

		$a_data['WF_MAIN_STATUS'] = $WF_MAIN_STATUS;
		$a_data['WF_MAIN_ORDER'] = $WF_MAIN_ORDER;
		$a_cond[$pk_name] = $id;
		
		db::db_update($table, $a_data, $a_cond);
		
	}
	echo 'Y';
	db::db_close();
	exit;
}

db::db_close();

if($process == "edit" && $back_page_old == "Y")
{
	$url_back = $_SERVER["HTTP_REFERER"];
}

if($url_back != "")
{
	redirect($url_back);
}
?>