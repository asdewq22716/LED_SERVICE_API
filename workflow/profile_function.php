<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php'; 

$process = $_REQUEST['process'];
$table = "USR_MAIN";
$pk_name = "USR_ID";
$pk_id = conText($_SESSION['WF_USER_ID']);
$url_back = "profile.php?process=success";

$USR_PREFIX = conText($_POST['USR_PREFIX']);
$USR_FNAME = conText($_POST['USR_FNAME']);
$USR_LNAME = conText($_POST['USR_LNAME']);
$USR_EMAIL = conText($_POST['USR_EMAIL']);
$USR_TEL = conText($_POST['USR_TEL']);
$USR_LINE_ID = conText($_POST['USR_LINE_ID']);
$CANCLE_PICTURE = conText($_POST['CANCLE_PICTURE']);

$sql_check1 = db::query("SELECT * FROM USR_SETTING WHERE FIELD_TYPE='O' ORDER BY FIELD_ID");
while($rec_u = db::fetch_array($sql_check1)){
	if($rec_u["FIELD_RELETION"] == 'M'){
		
		if(count($_POST[$rec_u["FIELD_NAME"]]) > 0){
			$data = implode(',',$_POST[$rec_u["FIELD_NAME"]]);
			unset($_POST[$rec_u["FIELD_NAME"]]);
			
			$_POST[$rec_u["FIELD_NAME"]] = $data;
			$USR_OPTION = conText($_POST[$rec_u["FIELD_NAME"]]);
			$a_data[$rec_u["FIELD_NAME"]] = $USR_OPTION;
		}
	}elseif($rec_u["FIELD_RELETION"] == 'T' AND $rec_u["FIELD_EDIT"] == 'Y'){
		$USR_OPTION = conText($_POST[$rec_u["FIELD_NAME"]]);
		$a_data[$rec_u["FIELD_NAME"]] = $USR_OPTION;
	}
}
/*
$USR_OPTION1 = conText($_POST['USR_OPTION1']);
$USR_OPTION2 = conText($_POST['USR_OPTION2']);
$USR_OPTION3 = conText($_POST['USR_OPTION3']);
$USR_OPTION4 = conText($_POST['USR_OPTION4']);
$USR_OPTION5 = conText($_POST['USR_OPTION5']);
$USR_OPTION6 = conText($_POST['USR_OPTION6']);
$USR_OPTION7 = conText($_POST['USR_OPTION7']);
$USR_OPTION8 = conText($_POST['USR_OPTION8']);
$USR_OPTION9 = conText($_POST['USR_OPTION9']);
$USR_OPTION10 = conText($_POST['USR_OPTION10']);*/


if($_FILES["USR_PICTURE"]["size"] > 0){

	$type_name = explode(".",$_FILES['USR_PICTURE']['name']);
	$name = date("YmdHis").".".$type_name[1];
	$filename = "../profile/".$name;
	copy($_FILES["USR_PICTURE"]["tmp_name"],$filename);
	if($rec_p["USR_PICTURE"] != ''){
		unlink('../profile/'.$rec_p["USR_PICTURE"]);
	}
	$a_data['USR_PICTURE'] = $name;
}
if($CANCLE_PICTURE == 'Y'){
	$a_data['USR_PICTURE'] = '';
}
$a_data['USR_PREFIX'] = $USR_PREFIX;
$a_data['USR_FNAME'] = $USR_FNAME;
$a_data['USR_LNAME'] = $USR_LNAME;
$a_data['USR_EMAIL'] = $USR_EMAIL;
$a_data['USR_TEL'] = $USR_TEL;
$a_data['USR_LINE_ID'] = $USR_LINE_ID;
/*$a_data['USR_OPTION1'] = $USR_OPTION1;
$a_data['USR_OPTION2'] = $USR_OPTION2;
$a_data['USR_OPTION3'] = $USR_OPTION3;
$a_data['USR_OPTION4'] = $USR_OPTION4;
$a_data['USR_OPTION5'] = $USR_OPTION5;
$a_data['USR_OPTION6'] = $USR_OPTION6;
$a_data['USR_OPTION7'] = $USR_OPTION7;
$a_data['USR_OPTION8'] = $USR_OPTION8;
$a_data['USR_OPTION9'] = $USR_OPTION9;
$a_data['USR_OPTION10'] = $USR_OPTION10;*/
$a_cond[$pk_name] = $pk_id;

db::db_update($table, $a_data, $a_cond);


db::db_close();
redirect($url_back);
?>