<?php
include "../include/config.php";
/*$sql_conf1 = db::query("SELECT CONFIG_VALUE FROM WF_CONFIG WHERE CONFIG_NAME = 'wf_line_token_access'");
$rec_conf1 = db::fetch_array($sql_conf1);
if($rec_conf1['CONFIG_VALUE'] != ""){*/
 
$sql_check0 = db::query("SELECT * FROM WF_ALERT WHERE A_LINE_USE = 'Y' AND A_STATUS = 'Y' AND A_LINE_SEND = 'N'");
//$sql_check0 = db::query_limit("SELECT * FROM WF_ALERT WHERE A_LINE_USE = 'Y' AND A_STATUS = 'Y' ORDER BY A_ID DESC", 0, 1);
while($A = db::fetch_array($sql_check0)){
$USR = wf_profile($A['A_SEND_USER']);

$sql_check1 = db::query("SELECT USR_LINE_API_KEY,USR_EMAIL,USR_FNAME,USR_LNAME FROM usr_main WHERE USR_ID = '".$A["A_REC_USER"]."' AND USR_STATUS = 'Y'");
 
$U = db::fetch_array($sql_check1);
	if($U['USR_EMAIL'] != "")
	{
		
$detail = "";	
$sql = db::query("select WF_MAIN_SHORTNAME,WF_FIELD_PK,WF_M_ALERT from WF_MAIN where WF_MAIN_ID = '".$A["WF_MAIN_ID"]."'");
$rec_main = db::fetch_array($sql);
if($rec_main["WF_M_ALERT"] != ""){
	$sql_workflow = "select * from ".$rec_main["WF_MAIN_SHORTNAME"]." where ".$rec_main['WF_FIELD_PK']." = '".$A["WFR_ID"]."' ";
	$query_workflow = db::query($sql_workflow);
	$WF = db::fetch_array($query_workflow);
	$text = bsf_show_text($A["WF_MAIN_ID"],$WF,$rec_main["WF_M_ALERT"]);
	$detail = "
\"".$text."\"";
}
		
		
$from_name = $system_conf["conf_title"];        
$from_address = "info@bizpotential.com";   	
$subject = "คุณได้รับข้อความใหม่ จาก".$USR['name'];
$to_address = $U['USR_EMAIL']; 

    //Create Email Headers
    $mime_boundary = "----Approve----".MD5(TIME());

    $headers = "From: ".$from_name." <".$from_address.">\n";
    $headers .= "Reply-To: ".$from_name." <".$from_address.">\n";
    $headers .= "MIME-Version: 1.0\n";
    $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
    $headers .= "Content-class: urn:content-classes:calendarmessage\n";
    
    //Create Email Body (HTML)
    $message = "--$mime_boundary\r\n";
    $message .= "Content-Type: text/html; charset=UTF-8\n";
    $message .= "Content-Transfer-Encoding: 8bit\n\n";
    $message .= "<html>\n";
    $message .= "<body>\n";
    $message .= "<p>เรียนคุณ".$U['USR_FNAME']." ".$U['USR_LNAME']."<br>".$detail."</p>"; 

    $mailsent = mail($to_address, $subject, $message, $headers);
	}
	if($U['USR_LINE_API_KEY'] != "")
	{
$detail = "";	
$sql = db::query("select WF_MAIN_SHORTNAME,WF_FIELD_PK,WF_M_ALERT from WF_MAIN where WF_MAIN_ID = '".$A["WF_MAIN_ID"]."'");
$rec_main = db::fetch_array($sql);
if($rec_main["WF_M_ALERT"] != ""){
	$sql_workflow = "select * from ".$rec_main["WF_MAIN_SHORTNAME"]." where ".$rec_main['WF_FIELD_PK']." = '".$A["WFR_ID"]."' ";
	$query_workflow = db::query($sql_workflow);
	$WF = db::fetch_array($query_workflow);
	$text = bsf_show_text($A["WF_MAIN_ID"],$WF,$rec_main["WF_M_ALERT"]);
	$detail = "
\"".$text."\"";
}
	
		$txt = "คุณได้รับงานใหม่ จาก".$USR['name'].$detail."

".bsl_gen_direction($A["A_REC_USER"], '../workflow/workflow_process.php?W='.$A["WF_MAIN_ID"].'&WFR='.$A["WFR_ID"]);
		/*$post = ['token_access' => $rec_conf1['CONFIG_VALUE'],
				 'process' => 'Y',
				 'user_id' => $U['USR_LINE_API_KEY'],
				 'message' => $txt
		];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://bizsmartflow.herokuapp.com/send_message_function.php');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
		curl_exec($ch);
		curl_close($ch);*/

		$set_header = array();
//		$set_header[] = "Content-Type: application/x-www-form-urlencoded";
		$set_header[] = "Authorization: Bearer {$U['USR_LINE_API_KEY']}";

		$set_data = array();
		$set_data['message'] = $txt;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://notify-api.line.me/api/notify");
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $set_header);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $set_data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_exec($ch);
		curl_close ($ch);
	}
	db::query("UPDATE WF_ALERT SET A_LINE_SEND = 'Y' WHERE A_ID = '".$A['A_ID']."'");
}
//}
db::db_close();
 ?>