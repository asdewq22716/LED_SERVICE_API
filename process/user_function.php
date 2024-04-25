<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$process = $_REQUEST['process'];
$table = "USR_MAIN";
$pk_name = "USR_ID";
$pk_id = $_REQUEST['id'];
$url_back = "user_list.php";

if($pk_id != ''){
	$sql_p = db::query("select USR_PICTURE from USR_MAIN where USR_ID='".$pk_id."' ");
	$rec_p = db::fetch_array($sql_p);
}


$USR_PREFIX = conText($_POST['USR_PREFIX']);
$USR_FNAME = conText($_POST['USR_FNAME']);
$USR_LNAME = conText($_POST['USR_LNAME']);
$USR_USERNAME = conText($_POST['USR_USERNAME']);
$USR_PASSWORD = conText($_POST['USR_PASSWORD']);
$USR_EMAIL = conText($_POST['USR_EMAIL']);
$USR_TEL = conText($_POST['USR_TEL']);
$DEP_ID = conText($_POST['DEP_ID']);
$POS_ID = conText($_POST['POS_ID']);
$USR_STATUS = conText($_POST['USR_STATUS']);
$USR_LINE_ID = conText($_POST['USR_LINE_ID']);
$USR_2FA_STATUS = conText($_POST['USR_2FA_STATUS']);
$USR_ADM = conText($_POST['USR_ADM']);
$NUM_ROWS = conText($_POST['num_rows_o']);


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

$USR_STATUS = $USR_STATUS == "" ? "N" : $USR_STATUS;
$USR_2FA_STATUS = $USR_2FA_STATUS == "" ? "N" : $USR_2FA_STATUS;
$USR_PASSWORD = hash('sha1', $USR_PASSWORD);


if($process == "add")
{
	
	if($_FILES["USR_PICTURE"]["size"] > 0){

		$explodeFile = explode('.', $_FILES["USR_PICTURE"]["name"]);
		$getExt = strtolower($explodeFile[(count($explodeFile) - 1)]);
		$name = date("YmdHis").".".$getExt;
		$filename = "../profile/".$name;
		copy($_FILES["USR_PICTURE"]["tmp_name"],$filename);

	}


	
	$a_data['USR_PREFIX'] = $USR_PREFIX;
	$a_data['USR_FNAME'] = $USR_FNAME;
	$a_data['USR_LNAME'] = $USR_LNAME;
	$a_data['USR_USERNAME'] = $USR_USERNAME;
	$a_data['USR_PASSWORD'] = $USR_PASSWORD;
	$a_data['USR_EMAIL'] = $USR_EMAIL;
	$a_data['USR_TEL'] = $USR_TEL;
	$a_data['DEP_ID'] = $DEP_ID;
	$a_data['POS_ID'] = $POS_ID;
	$a_data['USR_STATUS'] = $USR_STATUS;
	$a_data['USR_LINE_ID'] = $USR_LINE_ID;
	$a_data['USR_2FA_STATUS'] = $USR_2FA_STATUS;
	$a_data['USR_ADM'] = $USR_ADM;
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
	$a_data['USR_PICTURE'] = $name;
	$USR_ID = db::db_insert($table, $a_data, $pk_name,$pk_name);


}
elseif($process == "edit")
{
	
	if($_FILES["USR_PICTURE"]["size"] > 0){
	
		$type_name = explode(".",$_FILES['USR_PICTURE']['name']);
		$name = date("YmdHis").".".$type_name[1];
		$filename = "../profile/".$name;
		copy($_FILES["USR_PICTURE"]["tmp_name"],$filename);
		unlink('../profile/'.$rec_p["USR_PICTURE"]);
		$a_data['USR_PICTURE'] = $name;
	}

	
	$a_data['USR_PREFIX'] = $USR_PREFIX;
	$a_data['USR_FNAME'] = $USR_FNAME;
	$a_data['USR_LNAME'] = $USR_LNAME;
	$a_data['USR_USERNAME'] = $USR_USERNAME;
	//$a_data['USR_PASSWORD'] = $USR_PASSWORD;
	$a_data['USR_EMAIL'] = $USR_EMAIL;
	$a_data['USR_TEL'] = $USR_TEL;
	$a_data['DEP_ID'] = $DEP_ID;
	$a_data['POS_ID'] = $POS_ID;
	$a_data['USR_STATUS'] = $USR_STATUS;
	$a_data['USR_LINE_ID'] = $USR_LINE_ID;
	$a_data['USR_2FA_STATUS'] = $USR_2FA_STATUS;
	$a_data['USR_ADM'] = $USR_ADM;
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

	
	$a_cond[$pk_name] = $pk_id;

	db::db_update($table, $a_data, $a_cond);
}
elseif($process == "delete")
{
	$a_cond[$pk_name] = $pk_id;

	db::db_delete($table, $a_cond);
}
elseif($process == "re_order")
{
	$total_row = conText($_POST['total_row']);
	for($i=1; $i<$total_row; $i++)
	{
		$USR_STATUS = conText($_POST['USR_STATUS'.$i]);

		$USR_STATUS = $USR_STATUS == "" ? "N" : $USR_STATUS;

		$a_data['USR_STATUS'] = $USR_STATUS;

		$a_cond[$pk_name] = $_POST['id'.$i];

		db::db_update($table, $a_data, $a_cond);
	}
}

db::db_close();
redirect($url_back);
?>