<?php
$HIDE_HEADER = "Y";
$WF_TYPE = 'M';
include '../include/comtop_admin.php';
$table = 'WF_MAIN';
$pk_name = 'WF_MAIN_ID';
$url_back = "master.php";


$WF_FIELD_PK = conText($_POST['WF_FIELD_PK']);
$PK = conText($_POST['WFS_FIELD_NAME'.$WF_FIELD_PK]);
$WF_GROUP_ID = conText($_POST['WF_GROUP_ID']);
$WF_MAIN_ORDER = db::get_max("WF_MAIN", "WF_MAIN_ORDER",array('WF_GROUP_ID'=>$WF_GROUP_ID)) + 1;
$WF_MAIN_NAME = conText($_POST['WF_MAIN_NAME']);
$WF_MAIN_SHORTNAME = conText($_POST['WF_MAIN_SHORTNAME']);
$NUM_ROWS = conText($_POST['NUM_ROWS']);

if($WF_MAIN_NAME != ""){ 
	$a_data = array();
	//Insert WF_MAIN
	$a_data['WF_TYPE'] = $WF_TYPE;
	$a_data['WF_FIELD_PK'] = $PK;
	$a_data['WF_GROUP_ID'] = $WF_GROUP_ID;
	$a_data['WF_MAIN_ORDER'] = $WF_MAIN_ORDER;
	$a_data['WF_MAIN_NAME'] = $WF_MAIN_NAME;
	$a_data['WF_MAIN_TYPE'] = 'W';
	$a_data['WF_MAIN_SHORTNAME'] = $WF_MAIN_SHORTNAME;
	$W = db::db_insert($table, $a_data, $pk_name);

	for($i=1;$i<$NUM_ROWS;$i++){
		$a_data = array();
		$WFS_NAME = conText($_POST['WFS_NAME'.$i]);
		$WFS_FIELD_NAME = conText(strtoupper($_POST['WFS_FIELD_NAME'.$i]));
		$WFS_FIELD_TYPE = conText($_POST['WFS_FIELD_TYPE'.$i]);
		$WFS_FIELD_LENGTH = conText($_POST['WFS_FIELD_LENGTH'.$i]);
		$WF_FIELD_PK = conText($_POST['WF_FIELD_PK']);
		
		if($WF_FIELD_PK  != $i){
			$a_data['WF_MAIN_ID'] = $W;
			$a_data['WF_TYPE'] = $WF_TYPE;
			$a_data['WFD_ID'] = 0;
			$a_data['FORM_MAIN_ID'] = '1';
			$a_data['WFS_ORDER'] = $i;
			$a_data['WFS_OFFSET'] = "0";
			$a_data['WFS_NAME'] = $WFS_NAME;
			$a_data['WFS_FIELD_NAME'] = $WFS_FIELD_NAME;
			$a_data['WFS_FIELD_TYPE'] = $WFS_FIELD_TYPE;
			$a_data['WFS_FIELD_LENGTH'] = $WFS_FIELD_LENGTH;
			$a_data['WFS_COLUMN_TYPE'] = '2';
			$a_data['WFS_COLUMN_LEFT'] = '2';
			$a_data['WFS_COLUMN_RIGHT'] = '8';
			$a_data['WFS_COLUMN_LEFT_ALIGN'] = 'R';
			$a_data['WFS_COLUMN_RIGHT_ALIGN'] = 'L';
			$a_data['FIELD_G_ID'] = '0';
			$WFS_ID = db::db_insert('WF_STEP_FORM', $a_data, 'WFS_ID');
			unset($a_data); 
		}
		
	}


}





db::db_close();
redirect($url_back);
?>