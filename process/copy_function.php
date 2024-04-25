<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$process = $_REQUEST['process'];
$table = "WF_MAIN";
$pk_name = "WF_MAIN_ID";
$pk_id = $_REQUEST['id'];
$WF_TYPE = conText($_POST['WF_TYPE']);
$field_check = array();

$table_alias = $_POST['WF_ALIAS'];
$WF_MAIN_SHORTNAME = strtoupper($table_alias.$_POST['WF_MAIN_SHORTNAME']);

if($WF_TYPE == "W")
{
	$url_back = "workflow.php";
	$WF_FIELD_PK = "WFR_ID";
}
if($WF_TYPE == "F")
{
	$url_back = "form.php";
	$WF_FIELD_PK = "F_ID";
}
if($WF_TYPE == "M")
{
	$url_back = "master.php";
	$WF_FIELD_PK = strtoupper(conText($_POST['WF_FIELD_PK']));
}
$WF_GROUP_ID = conText($_POST['WF_GROUP_ID']);

/*
 * Function for use Workflow, Form, Master
 */
function copy_all_step($s_wf_main_id,$s_wg_id, $s_wfd_id, $wf_main_id, $wf_detail_id, $wf_field_group_id, $WF_TYPE)
{
	global $WF_MAIN_SHORTNAME, $field_check;
	if($WF_TYPE == "W")
	{
		$filter = " FIELD_G_ID = '".$s_wg_id."' AND WFD_ID = '".$s_wfd_id."' and WF_MAIN_ID = '".$s_wf_main_id."' ";
	}
	else
	{
		$filter = " WF_MAIN_ID = '".$s_wf_main_id."' ";
	}

	##### WF_STEP_FORM ##### 
	$sql_step_form = db::query("SELECT WFS_ID, WFS_FIELD_NAME, WFS_FIELD_TYPE, WFS_FIELD_LENGTH, WFS_NAME,WF_TYPE 
										FROM WF_STEP_FORM 
										WHERE $filter ORDER BY WFS_ORDER");
	while($rec_step_form = db::fetch_array($sql_step_form))
	{
		/* Add Field */
		if(!in_array($rec_step_form['WFS_FIELD_NAME'], $field_check) && $rec_step_form['WFS_FIELD_NAME'] != "" && $rec_step_form['WF_TYPE'] != 'S' )
		{
			add_field(
				$WF_MAIN_SHORTNAME,
				$rec_step_form['WFS_FIELD_NAME'],
				$rec_step_form['WFS_FIELD_TYPE'],
				$rec_step_form['WFS_FIELD_LENGTH'],
				$rec_step_form['WFS_NAME']
			);

			array_push($field_check, $rec_step_form['WFS_FIELD_NAME']);
		}

		copy_data(
			'WF_STEP_FORM',
			'WF_STEP_FORM',
			'WFS_ID',
			"WFS_ID = '".$rec_step_form['WFS_ID']."'",
			array('WFS_ID'),
			array(
				'WFD_ID' => $wf_detail_id,
				'WF_MAIN_ID' => $wf_main_id,
				'FIELD_G_ID' => $wf_field_group_id
			)
		);

		$wf_step_form_id = db::get_max('WF_STEP_FORM', 'WFS_ID');

		##### WF_STEP_OPTION #####
		$sql_step_option = db::query("SELECT WFSO_ID FROM WF_STEP_OPTION WHERE WFS_ID = '".$rec_step_form['WFS_ID']."' ORDER BY WFSO_ID");
		while($rec_step_option = db::fetch_array($sql_step_option))
		{
			copy_data(
				'WF_STEP_OPTION',
				'WF_STEP_OPTION',
				'WFSO_ID',
				"WFSO_ID = '".$rec_step_option['WFSO_ID']."'",
				array('WFSO_ID'),
				array('WFS_ID' => $wf_step_form_id)
			);
		}

		##### WF_STEP_JS #####
		$sql_step_js = db::query("SELECT WFSJ_ID FROM WF_STEP_JS WHERE WFS_ID = '".$rec_step_form['WFS_ID']."' ORDER BY WFSJ_ID");
		while($rec_step_js = db::fetch_array($sql_step_js))
		{
			copy_data(
				'WF_STEP_JS',
				'WF_STEP_JS',
				'WFSJ_ID',
				"WFSJ_ID = '".$rec_step_js['WFSJ_ID']."'",
				array('WFSJ_ID'),
				array('WFS_ID' => $wf_step_form_id)
			);
		}

		##### WF_ONCHANGE #####
		$sql_onchange = db::query("SELECT WFO_ID FROM WF_ONCHANGE WHERE WFS_ID = '".$rec_step_form['WFS_ID']."' ORDER BY WFO_ID");
		while($rec_onchange = db::fetch_array($sql_onchange))
		{
			copy_data(
				'WF_ONCHANGE',
				'WF_ONCHANGE',
				'WFO_ID',
				"WFO_ID = '".$rec_onchange['WFO_ID']."'",
				array('WFO_ID'),
				array(
					'WFS_ID' => $wf_step_form_id,
					'WF_MAIN_ID' => $wf_main_id
				)
			);
		}

		##### WF_STEP_THROW #####
		$sql_step_throw = db::query("SELECT WFST_ID FROM WF_STEP_THROW WHERE WFS_ID = '".$rec_step_form['WFS_ID']."' ORDER BY WFST_ID");
		while($rec_step_throw = db::fetch_array($sql_step_throw))
		{
			copy_data(
				'WF_STEP_THROW',
				'WF_STEP_THROW',
				'WFST_ID',
				"WFST_ID = '".$rec_step_throw['WFST_ID']."'",
				array('WFST_ID'),
				array('WFS_ID' => $wf_step_form_id)
			);
		}
	}
}


##### WF_MAIN #####
$wf_main_cond = "WF_MAIN_ID = '".$pk_id."' AND WF_TYPE = '".$WF_TYPE."'";

copy_data(
	'WF_MAIN',
	'WF_MAIN',
	'WF_MAIN_ID',
		$wf_main_cond,
		array('WF_MAIN_ID'),
		array(
			'WF_MAIN_NAME' => conText($_POST['WF_DEST_NAME']),
			'WF_MAIN_SHORTNAME' => $WF_MAIN_SHORTNAME
			)
);
$wf_main_id = db::get_max('WF_MAIN', 'WF_MAIN_ID');

/* Create Table */
if($WF_TYPE == "W")
{
	create_table_wf($WF_MAIN_SHORTNAME);
}
elseif($WF_TYPE == "F")
{
	if(db::$_dbType == "MSSQL")
	{
		$data_type = "int";
		//$data_length = "IDENTITY(1,1)";
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
elseif($WF_TYPE == "M")
{
	$sql_s_wf = db::query("SELECT WF_FIELD_PK FROM WF_MAIN WHERE WF_MAIN_ID = '".$pk_id."'");
	$rec_s_wf = db::fetch_array($sql_s_wf);

	if(db::$_dbType == "MSSQL")
	{
		$data_type = "int";
		//$data_length = "IDENTITY(1,1)";
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

	create_table($WF_MAIN_SHORTNAME, $rec_s_wf['WF_FIELD_PK'], $data_type, $data_length);
}

##### WF_DET #####
if($WF_TYPE == "W")
{
	$sql_detail = db::query("SELECT WFD_ID FROM WF_DETAIL WHERE WF_MAIN_ID = '".$pk_id."' ORDER BY WFD_ORDER");
	 
	while($rec_detail = db::fetch_array($sql_detail))
	{
		copy_data('WF_DETAIL', 'WF_DETAIL', 'WFD_ID', "WFD_ID = '".$rec_detail['WFD_ID']."'", array('WFD_ID'), array('WF_MAIN_ID' => $wf_main_id));

		$wf_detail_id = db::get_max('WF_DETAIL', 'WFD_ID');
 
		$array_step[$rec_detail['WFD_ID']] = $wf_detail_id;

		##### WF_STEP_CON #####
		$sql_step_con = db::query("SELECT WFSC_ID FROM WF_STEP_CON WHERE WFD_ID = '".$rec_detail['WFD_ID']."' ORDER BY WFSC_ID");
		while($rec_step_con = db::fetch_array($sql_step_con))
		{
			copy_data('WF_STEP_CON', 'WF_STEP_CON', 'WFSC_ID', "WFSC_ID = '".$rec_step_con['WFSC_ID']."'", array('WFSC_ID'), array('WFD_ID' => $wf_detail_id));
		}

		##### WF_FIELD_GROUP #####
		$sql_field_group = db::query("SELECT FIELD_G_ID FROM WF_FIELD_GROUP WHERE WFD_ID = '".$rec_detail['WFD_ID']."' ORDER BY FIELD_G_ORDER");
		$g_rows = db::num_rows($sql_field_group);
		if($g_rows == 0)
		{
			$wf_field_group_id = 0;
		## Call Function ## 
		copy_all_step($pk_id,'0', $rec_detail['WFD_ID'], $wf_main_id, $wf_detail_id, '0', $WF_TYPE);
		}
		else
		{ 
			$wf_field_group_id = 0;
			## Call Function ## 
			copy_all_step($pk_id,'0', $rec_detail['WFD_ID'], $wf_main_id, $wf_detail_id, '0', $WF_TYPE);
			while($rec_field_group = db::fetch_array($sql_field_group))
			{
				copy_data(
					'WF_FIELD_GROUP',
					'WF_FIELD_GROUP',
						'FIELD_G_ID',
						"FIELD_G_ID = '".$rec_field_group['FIELD_G_ID']."'",
						array('FIELD_G_ID'),
						array(
							'WFD_ID' => $wf_detail_id,
							'WF_MAIN_ID' => $wf_main_id
					)
				);
				
			$wf_field_group_id = db::get_max('WF_FIELD_GROUP', 'FIELD_G_ID'); 
			## Call Function ##
			copy_all_step($pk_id,$rec_field_group['FIELD_G_ID'], $rec_detail['WFD_ID'], $wf_main_id, $wf_detail_id, $wf_field_group_id, $WF_TYPE); 
			}

		
		}

		
	}

	##### Update Step Next #####
	$sql_update_detail = db::query("SELECT WFD_ID, WFD_DEFAULT_STEP FROM WF_DETAIL WHERE WF_MAIN_ID = '".$wf_main_id."'");
	while($rec_update_detail = db::fetch_array($sql_update_detail))
	{
		if($rec_update_detail["WFD_DEFAULT_STEP"] != "")
		{
			$step_next = $array_step[$rec_update_detail["WFD_DEFAULT_STEP"]];

			$u_data['WFD_DEFAULT_STEP'] = $step_next;
			$u_cond['WFD_ID'] = $rec_update_detail['WFD_ID'];

			db::db_update('WF_DETAIL', $u_data, $u_cond);
		}

		$sql_update_con = db::query("SELECT WFD_ID, WFSC_ID, WFSC_STEP FROM WF_STEP_CON WHERE WFD_ID = '".$rec_update_detail['WFD_ID']."'");
		while($rec_update_con = db::fetch_array($sql_update_con))
		{
			if($rec_update_con["WFD_ID"] != "")
			{
				$step_con = $array_step[$rec_update_con["WFSC_STEP"]];

				$c_data['WFSC_STEP'] = $step_con;
				$c_cond['WFSC_ID'] = $rec_update_con["WFSC_ID"];

				db::db_update('WF_STEP_CON', $c_data, $c_cond);
			}
		}

		/*$sql_update_field = db::query("SELECT WFD_ID, FIELD_G_ID FROM WF_FIELD_GROUP WHERE WFD_ID = '".$rec_update_detail['WFD_ID']."'");
		while($rec_update_field = db::fetch_array($sql_update_field))
		{
			if($rec_update_field["WFD_ID"] != "")
			{
				$step_con = $array_step[$rec_update_field["WFD_ID"]];

				$f_data['WFD_ID'] = $step_con;
				$f_cond['FIELD_G_ID'] = $rec_update_field["FIELD_G_ID"];

				db::db_update('WF_FIELD_GROUP', $f_data, $f_cond);
			}
		}
		*/
	}
}
else
{
	## Call Function ##
	copy_all_step($pk_id,'0', '0', $wf_main_id, '0', '0', $WF_TYPE);
}

db::db_close();
redirect($url_back);
?>