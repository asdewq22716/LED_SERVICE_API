<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$process = $_REQUEST['process'];
$table = "WF_MAIN";
$pk_name = "WF_MAIN_ID";
$pk_id = $_REQUEST['id'];
$WF_TYPE = "W";
$field_check = array();

$table_alias = $_POST['WF_ALIAS'];
$WF_MAIN_SHORTNAME = strtoupper($table_alias.$_POST['WF_MAIN_SHORTNAME']);

$url_back = "workflow_detail.php";
$WF_FIELD_PK = "WFR_ID";
$WF_GROUP_ID = conText($_POST['WF_GROUP_ID']);

/*
 * Function for use Workflow, Form, Master
 */
function copy_all_step($s_wf_main_id, $s_wfd_id, $s_group_id, $wf_main_id, $wf_detail_id, $wf_field_group_id, $WF_TYPE)
{
//	global $WF_MAIN_SHORTNAME, $field_check;
	$filter = " WFD_ID = '".$s_wfd_id."' and WF_MAIN_ID = '".$s_wf_main_id."' AND FIELD_G_ID = '".$s_group_id."'";

	##### WF_STEP_FORM ##### 
	$sql_step_form = db::query("SELECT WFS_ID, WFS_FIELD_NAME, WFS_FIELD_TYPE, WFS_FIELD_LENGTH, WFS_NAME,WF_TYPE 
										FROM WF_STEP_FORM 
										WHERE $filter ORDER BY WFS_ORDER");
	while($rec_step_form = db::fetch_array($sql_step_form))
	{
		/* Add Field */
		## ไม่ใช้ เพราะ copy ขั้นตอน ให้ใช้ฟิลเดิม ##
		/*if(!in_array($rec_step_form['WFS_FIELD_NAME'], $field_check) && $rec_step_form['WFS_FIELD_NAME'] != "" && $rec_step_form['WF_TYPE'] != 'S' )
		{
			add_field(
				$WF_MAIN_SHORTNAME,
				$rec_step_form['WFS_FIELD_NAME'],
				$rec_step_form['WFS_FIELD_TYPE'],
				$rec_step_form['WFS_FIELD_LENGTH'],
				$rec_step_form['WFS_NAME']
			);

			array_push($field_check, $rec_step_form['WFS_FIELD_NAME']);
		}*/

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

##### WF_DET #####

$wf_main_id = $_POST['id'];
$WFD = $_POST['WFD_ID'];

$sql_detail = db::query("SELECT WFD_ID FROM WF_DETAIL WHERE WFD_ID = '".$WFD."' ");
while($rec_detail = db::fetch_array($sql_detail))
{
	copy_data('WF_DETAIL',
		'WF_DETAIL',
		'WFD_ID',
		"WFD_ID = '".$rec_detail['WFD_ID']."'",
		array('WFD_ID', 'WFD_DEFAULT_STEP'),
		array('WFD_NAME' => $_POST['WFD_DEST_NAME']));

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
		copy_all_step($pk_id, $rec_detail['WFD_ID'],'0', $wf_main_id, $wf_detail_id, $wf_field_group_id, $WF_TYPE);
	}
	else
	{
	copy_all_step($pk_id, $rec_detail['WFD_ID'],'0', $wf_main_id, $wf_detail_id, '0', $WF_TYPE);	
	
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
		copy_all_step($pk_id, $rec_detail['WFD_ID'],$rec_field_group['FIELD_G_ID'], $wf_main_id, $wf_detail_id, $wf_field_group_id, $WF_TYPE);
	}
	
	}


	
}

db::db_close();
redirect("workflow_detail.php?W=".$wf_main_id);
?>