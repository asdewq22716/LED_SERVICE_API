<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$W = conText($_POST['W']);
$WFS = conText($_POST['WFS']);
$FIELD = conText($_POST['FIELD']);
$OBJ_HTML = conText($_POST['OBJ_HTML']);
$process = conText($_REQUEST['process']);
$FIELD_NAME_NEW = conText($_POST['FIELD_NAME_NEW']);
$FIELD_NAME_OLD = conText($_POST['FIELD_NAME_OLD']);
$FIELD_TYPE = conText($_POST['FIELD_TYPE']);
$FIELD_TYPE_OLD = conText($_POST['FIELD_TYPE_OLD']);
$FIELD_LENGTH = conText($_POST['FIELD_LENGTH']);
$FIELD_LENGTH_OLD = conText($_POST['FIELD_LENGTH_OLD']);
$FIELD_COMMENT = conText($_POST['FIELD_COMMENT']);
$FIELD_COMMENT_O = conText($_POST['FIELD_COMMENT_O']);

$sql = db::query("select WF_MAIN_SHORTNAME from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec = db::fetch_array($sql);



if($process == 'ADD'){
	if($FIELD_NAME_OLD == ''){
		
		add_field($rec["WF_MAIN_SHORTNAME"], $FIELD_NAME_NEW, $FIELD_TYPE, $FIELD_LENGTH, "");
		$flag = 'change';
		echo ".";
		$a_data['WFS_FIELD_NAME'] = $FIELD_NAME_NEW;
		$a_data['WFS_FIELD_TYPE'] = $FIELD_TYPE;
		$a_data['WFS_FIELD_LENGTH'] = $FIELD_LENGTH;
		if($WFS != ''){
			$a_cond['WFS_ID'] = $WFS;
			db::db_update('WF_STEP_FORM', $a_data, $a_cond);
			unset($a_data);
			unset($a_cond);
		}
		
	}elseif($FIELD_NAME_OLD != $FIELD_NAME_NEW AND $FIELD_NAME_OLD != ''){
		
		rename_field($rec["WF_MAIN_SHORTNAME"], $FIELD_NAME_NEW, $FIELD_NAME_OLD);
		$a_data['WFS_FIELD_NAME'] = $FIELD_NAME_NEW;
		
		if(($FIELD_TYPE != $FIELD_TYPE_OLD) OR ($FIELD_LENGTH != $FIELD_LENGTH_OLD)){
			
			modify_field($rec["WF_MAIN_SHORTNAME"], $FIELD_NAME_NEW, $FIELD_TYPE,$FIELD_LENGTH);
			$a_data['WFS_FIELD_TYPE'] = $FIELD_TYPE;
			$a_data['WFS_FIELD_LENGTH'] = $FIELD_LENGTH;
			
		}

		
		if($WFS != ''){
			$a_cond['WFS_ID'] = $WFS;
			db::db_update('WF_STEP_FORM', $a_data, $a_cond);
			unset($a_data);
			unset($a_cond);
		}
		$flag = 'change';
		echo ".";

	}else{

		modify_field($rec["WF_MAIN_SHORTNAME"], $FIELD_NAME_NEW, $FIELD_TYPE,$FIELD_LENGTH);

		
		if($WFS != ''){
			$a_data['WFS_FIELD_TYPE'] = $FIELD_TYPE;
			$a_data['WFS_FIELD_LENGTH'] = $FIELD_LENGTH;
			$a_cond['WFS_ID'] = $WFS;
			
			db::db_update('WF_STEP_FORM', $a_data, $a_cond);
			unset($a_data);
			unset($a_cond);
		}
		echo ".";
			
		
	}

	if($FIELD_COMMENT != $FIELD_COMMENT_O AND $FIELD_NAME_NEW != ''){
		if(db::$_dbType == "ORACLE")
		{
			$comment_sql = "COMMENT ON COLUMN ".$rec["WF_MAIN_SHORTNAME"].".".$FIELD_NAME_NEW." IS '".$FIELD_COMMENT."' ";
			db::query($comment_sql);
		}
	}
	
}elseif($process == 'DEL'){
	
	$table = conText($_GET['TABLE_NAME']);
	$field = conText($_GET['FIELD_NAME']);
	Drop_field($table,$field);
	echo ".";
	
}elseif($process == 'DELETE_FIELD'){
	$W = conText($_GET['W']);
	$table = conText($_GET['TABLE_NAME']);
	$field = conText($_GET['FIELD_NAME']);
	$drop_field = conText($_GET['drop_field']);
	if($table != '' AND $field != ''){
		
		if($drop_field == 'Y'){
			Drop_field($table,$field);
		}
		
		$query_step_form = db::query("SELECT WFS_ID FROM WF_STEP_FORM WSF WHERE WSF.WF_MAIN_ID = '".$W."' AND (WFS_FIELD_NAME IS NOT NULL OR WFS_FIELD_NAME != '' ) AND WFS_FIELD_NAME='".$field."'");
		$step_form = db::fetch_array($query_step_form);
		if($step_form["WFS_ID"] != ''){
			$a_cond['WFS_ID'] = $step_form["WFS_ID"];
			db::db_delete('WF_STEP_FORM', $a_cond);
		}
	echo ".";
	}	
}

db::db_close();
?>