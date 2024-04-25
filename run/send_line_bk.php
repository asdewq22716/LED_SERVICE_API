<?php
include "../include/config.php";
$sql_conf1 = db::query("SELECT CONFIG_VALUE FROM WF_CONFIG WHERE CONFIG_NAME = 'wf_line_token_access'");
$rec_conf1 = db::fetch_array($sql_conf1);
if($rec_conf1['CONFIG_VALUE'] != ""){

$sql_check0 = db::query("SELECT * FROM WF_ALERT WHERE A_LINE_USE = 'Y' AND A_STATUS = 'Y' AND A_LINE_SEND = 'N'");
while($A = db::fetch_array($sql_check0)){
$USR = wf_profile($A['A_SEND_USER']);

$sql_check1 = db::query("SELECT USR_LINE_API_KEY FROM usr_main WHERE USR_ID = '".$A["A_REC_USER"]."' AND USR_STATUS = 'Y'");

$U = db::fetch_array($sql_check1);
if($U['USR_LINE_API_KEY'] != ""){
	$txt = "คุณได้รับงานใหม่ จาก".$USR['name']."

	คลิ๊กที่  ".bsl_gen_direction($A["A_REC_USER"], '../workflow/workflow_process.php?W='.$A["WF_MAIN_ID"].'&WFR='.$A["WFR_ID"])."  เพื่อดูรายละเอียด";
	$post = [
		'token_access' => $rec_conf1['CONFIG_VALUE'],
		'process' => 'Y',
		'user_id' => $U['USR_LINE_API_KEY'],
		'message'   => $txt
	];
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://bizsmartflow.herokuapp.com/send_message_function.php');
	curl_setopt($ch, CURLOPT_POST, true );
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, false );
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false );
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
	curl_exec($ch);
	curl_close($ch);
	}
	db::query("UPDATE WF_ALERT SET A_LINE_SEND = 'Y' WHERE A_ID = '".$A['A_ID']."'");
 }
}
db::db_close();
 ?>