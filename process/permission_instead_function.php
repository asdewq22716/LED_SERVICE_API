<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$U_ID = conText($_POST["U_ID"]);
$process = conText($_POST["process"]);
$table = 'PERMISSION_INSTEAD';
$pk_name = 'PI_ID';
$url_back = 'permission_instead_list.php?process=permission_instead&U_ID='.$U_ID;

$sql_check1 = db::query("SELECT * FROM USR_SETTING WHERE FIELD_TYPE='O' ORDER BY FIELD_ID");
while($rec_u = db::fetch_array($sql_check1)){
	if($rec_u["FIELD_RELETION"] == 'M'){
		if(count($_POST[$rec_u["FIELD_NAME"]]) > 0){
			$data = implode(',',$_POST[$rec_u["FIELD_NAME"]]);
			unset($_POST[$rec_u["FIELD_NAME"]]);
			
			$_POST[$rec_u["FIELD_NAME"]] = $data;
			
		}
	}
}

$DEP_ID = conText($_POST['DEP_ID']);
$POS_ID = conText($_POST['POS_ID']);
$USR_OPTION1 = conText($_POST['USR_OPTION1']);
$USR_OPTION2 = conText($_POST['USR_OPTION2']);
$USR_OPTION3 = conText($_POST['USR_OPTION3']);
$USR_OPTION4 = conText($_POST['USR_OPTION4']);
$USR_OPTION5 = conText($_POST['USR_OPTION5']);
$USR_OPTION6 = conText($_POST['USR_OPTION6']);
$USR_OPTION7 = conText($_POST['USR_OPTION7']);
$USR_OPTION8 = conText($_POST['USR_OPTION8']);
$USR_OPTION9 = conText($_POST['USR_OPTION9']);
$USR_OPTION10 = conText($_POST['USR_OPTION10']);
$PI_STARTDATE = conText($_POST['PI_STARTDATE']);
$PI_ENDDATE = conText($_POST['PI_ENDDATE']);


if($process == 'permission_instead'){
	$a_data['USR_ID'] = $U_ID;
	$a_data['DEP_ID'] = $DEP_ID;
	$a_data['POS_ID'] = $POS_ID;
	$a_data['USR_OPTION1'] = $USR_OPTION1;
	$a_data['USR_OPTION2'] = $USR_OPTION2;
	$a_data['USR_OPTION3'] = $USR_OPTION3;
	$a_data['USR_OPTION4'] = $USR_OPTION4;
	$a_data['USR_OPTION5'] = $USR_OPTION5;
	$a_data['USR_OPTION6'] = $USR_OPTION6;
	$a_data['USR_OPTION7'] = $USR_OPTION7;
	$a_data['USR_OPTION8'] = $USR_OPTION8;
	$a_data['USR_OPTION9'] = $USR_OPTION9;
	$a_data['USR_OPTION10'] = $USR_OPTION10;
	$a_data['PI_STARTDATE'] = date2db($PI_STARTDATE);
	$a_data['PI_ENDDATE'] = date2db($PI_ENDDATE);
	
	db::db_insert($table, $a_data, $pk_name);
}


db::db_close();
redirect($url_back);


?>