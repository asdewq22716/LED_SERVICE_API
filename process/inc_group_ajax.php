<?php
error_reporting(E_ALL & ~E_NOTICE);
$HIDE_HEADER = 'Y';
include '../include/comtop_admin.php'; 

$Flag = conText($_REQUEST["Flag"]);
$WF_TYPE = conText($_REQUEST['WF_TYPE']);
$table = "WF_GROUP";
$array_a = array();

if($Flag != 're_order' && $Flag != 'add_workflow'){
	header('Content-Type: application/json');
}

//############# ของกรณี add_workflow #############//
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

if($_POST['WF_MAIN_SHORTNAME'] == ''){
	$table_alias = '';
}else{
	$table_alias = $_POST['WF_ALIAS'];
}

$WF_FIELD_PK = conText($_POST['WF_FIELD_PK']);
$WF_MAIN_ICON = conText($_POST['WF_MAIN_ICON']);
$WF_GROUP_ID = conText($_POST['WF_GROUP_ID']);
$WF_MAIN_NAME = conText($_POST['WF_MAIN_NAME']);
$WF_MAIN_REMARK = conText($_POST['WF_MAIN_REMARK']);
$WF_MAIN_TYPE = conText($_POST['WF_MAIN_TYPE']);
$WF_MAIN_SHORTNAME = conText($_POST['WF_MAIN_SHORTNAME']);
$WF_MAIN_SHORTNAME = strtoupper($table_alias.$WF_MAIN_SHORTNAME);
$WF_MAIN_URL = conText($_POST['WF_MAIN_URL']);
$WF_MAIN_STATUS = conText($_POST['WF_MAIN_STATUS']);
$WF_MAIN_TAB_STATUS = conText($_POST['WF_MAIN_TAB_STATUS']);
$WF_SEARCH_SHOW = conText($_POST['WF_SEARCH_SHOW']);
$WF_PER_PAGE = conText($_POST['WF_PER_PAGE']);
//############# ของกรณี add_workflow #############//

if($Flag == "Add"){
	$PARENT = conText($_GET["parent_id"]);
	if($PARENT == "#" OR $PARENT == ""){ $PARENT = 0; }
	$sql_max = db::query("SELECT MAX(GROUP_ORDER) AS MX FROM ".$table." WHERE GROUP_PARENT = '".$PARENT."' AND WF_TYPE = '".$WF_TYPE."'");
	$O = db::fetch_array($sql_max);
	
	if($O['MX'] != ''){
		$order = $O['MX']+1;
	}else{
		$order = 1;
	}
	$insert_wf = array();
	$insert_wf['GROUP_NAME'] = conText($_GET["text"]);
	$insert_wf['GROUP_STATUS'] = "Y";
	$insert_wf['GROUP_ORDER'] = $order;
	$insert_wf['WF_TYPE'] = $WF_TYPE;
	$insert_wf['GROUP_PARENT'] = $PARENT;
	
	$GROUP_ID = db::db_insert($table, $insert_wf, "GROUP_ID");
	unset($insert_wf);
	$array_a['id'] = $GROUP_ID;
	echo json_encode($array_a,JSON_NUMERIC_CHECK);
}

if($Flag == "Rename"){
	$update_wf = array();
	$update_wf['GROUP_NAME'] = conText($_GET["text"]);
	$wf_cond["GROUP_ID"] = conText($_GET["id"]);
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
	$sql_order = db::query("SELECT GROUP_ID FROM WF_GROUP WHERE GROUP_PARENT = '".$PARENT."' AND GROUP_ID != '".conText($_GET["id"])."' ORDER BY GROUP_ORDER ");
	while($M=db::fetch_array($sql_order)){
		if($_GET['position'] == $m_order){ $m_order++; }
		$update_wf = array();
		$update_wf['GROUP_ORDER'] = $m_order;
		$wf_cond["GROUP_ID"] = $M["GROUP_ID"];
		db::db_update($table, $update_wf, $wf_cond);
		unset($update_wf);
		unset($wf_cond);
		$m_order++;
	}
	$update_wf = array();
	$update_wf['GROUP_PARENT'] = $PARENT;
	$update_wf['GROUP_ORDER'] = $_GET['position'];
	$wf_cond["GROUP_ID"] = conText($_GET["id"]);
	db::db_update($table, $update_wf, $wf_cond);
	unset($update_wf);
	unset($wf_cond);
	
	$array_a['id'] = conText($_GET["id"]);
	echo json_encode($array_a,JSON_NUMERIC_CHECK);
}

if($Flag == "Remove" AND conText($_GET["id"]) != ""){
	function del_group($gid){
		$sql_t = db::query("SELECT GROUP_ID FROM WF_GROUP WHERE GROUP_PARENT = '".$gid."'");
		while($M=db::fetch_array($sql_t)){
			del_group($M['GROUP_ID']);
		}
		db::query("DELETE FROM WF_GROUP WHERE GROUP_ID = '".$gid."'");
	} 
	del_group(conText($_GET["id"]));
	$array_a['id'] = conText($_GET["id"]);
	echo json_encode($array_a,JSON_NUMERIC_CHECK);
}

if($Flag == "add_workflow"){

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
	$WF_MAIN_ORDER = db::get_max("WF_MAIN", "WF_MAIN_ORDER",array('WF_GROUP_ID'=>$WF_GROUP_ID)) + 1;
	
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

	$WF_MAIN_ID = db::db_insert("WF_MAIN", $a_data, "WF_MAIN_ID");
	
	if($_POST['STEP_DATA'] != ""){
		$step_data = json_decode($_POST['STEP_DATA']);
		$ORDER = 1;
		$arr_ref = array();
		$arr_ref_t = array();
		foreach($step_data->nodeDataArray as $mystep){
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
	}
	?>
	<script type="text/javascript" src="../assets/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript">
		function get_wfs_show1(obj_target,url,dataString,w_method,show){ 
			if(w_method==""){ w_method = "GET";}
			if(show==""){ show = "W";}
			$.ajax({
				type: w_method,
				url: url,
				data: dataString,
				cache: false,
				success: function(data){
					if(show=='A'){
						
						parent.$('#'+obj_target).append(data);
						
					}else{
						
						parent.$('#'+obj_target).html(data);
						
					}
				} 
			 });
		}
		get_wfs_show1('GROUP_DETAIL','inc_group_workflow_list.php','G=<?php echo $WF_GROUP_ID; ?>&WF_TYPE=<?php echo $WF_TYPE;?>','GET');
		parent.$('#bizModal').modal('hide');
	</script>
	<?php
	exit;
}

if($Flag == "re_order"){
	$TOTAL_ROW = conText($_POST['total_row']);
	for($i=1; $i<$TOTAL_ROW; $i++)
	{
		$WF_MAIN_STATUS = conText($_POST['WF_MAIN_STATUS'.$i]);
		$WF_MAIN_ORDER = conText($_POST['WF_MAIN_ORDER'.$i]);
		$id = conText($_POST['id'.$i]);
		
		$a_data['WF_MAIN_STATUS'] = $WF_MAIN_STATUS;
		$a_data['WF_MAIN_ORDER'] = $WF_MAIN_ORDER;
		
		$a_cond['WF_MAIN_ID'] = $id;
		
		db::db_update("WF_MAIN", $a_data, $a_cond);
		
	}
	echo 'Y';
	db::db_close();
	exit;
}
db::db_close();
?>