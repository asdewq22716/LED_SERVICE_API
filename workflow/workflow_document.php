<?php
$HIDE_HEADER = 'Y';
include '../include/comtop_user.php'; 

$DOC_ID = conText($_GET["DOC_ID"]);
$WFR = conText($_GET["WFR"]);
$DU_ID = conText($_GET['DU_ID']);



$sql_doc_main = db::query("SELECT * FROM DOC_MAIN WHERE DOC_ID = '".$DOC_ID."'");
$doc_main = db::fetch_array($sql_doc_main);

$sql_data1 = db::query("SELECT * FROM WF_MAIN WHERE WF_MAIN_ID = '".$doc_main["WF_MAIN_ID"]."' ");
$R1 = db::fetch_array($sql_data1);


if($doc_main["DOC_REQUEST_DATA"] == "S"){
	 $sql_form1 = db::query("SELECT * FROM ".$R1["WF_MAIN_SHORTNAME"]." WHERE ".$R1["WF_FIELD_PK"]." = '".$WFR."' ");
	$F1 = db::fetch_array($sql_form1);

	$sqlnew_doc = str_replace("&#039;","'",$doc_main["DOC_SQL"]);
	preg_match_all("/(##)([a-zA-Z0-9_]+)(!!)/", $sqlnew_doc, $new_sql, PREG_SET_ORDER);
	
	foreach ($new_sql as $val_new) {
		$sqlnew_doc = str_replace("##".$val_new[2]."!!",$F1[$val_new[2]],$sqlnew_doc);
	}
	
		preg_match_all("/(@@)([a-zA-Z0-9_]+)(!!)/", $sqlnew_doc, $new_sql1, PREG_SET_ORDER); 
	foreach ($new_sql1 as $val_new2) 
	{ 
		$sqlnew_doc = str_replace("@@".$val_new2[2]."!!",$_SESSION[$val_new2[2]],$sqlnew_doc); 
	}
	
	$sql_form = db::query($sqlnew_doc);
	$F = db::fetch_array($sql_form);
	
}else{
	$sql_form = db::query("SELECT * FROM ".$R1["WF_MAIN_SHORTNAME"]." WHERE ".$R1["WF_FIELD_PK"]." = '".$WFR."' ");
	$F = db::fetch_array($sql_form);
	
}

	$filename = "../doc/".$doc_main["DOC_FILE"];
	
		require_once '../PHPWord.php';
		$PHPWord = new PHPWord();
		
		if($DU_ID != "")
		{
			$sql_doc_user = db::query("SELECT * FROM DOC_USER WHERE DU_ID = '".$DU_ID."'");
			$rec_doc_user = db::fetch_array($sql_doc_user);
			$filename = $rec_doc_user['DU_FILE_NAME'];
		}

		$document = $PHPWord->loadTemplate($filename);

		$today = date("Y-m-d");
		foreach($arr_format_date as $_key => $_val){
			$date = conDateText($today, $_key);
			$document->setValue($_val, $date);
			
		}
		
		
	
	$search  = array();
	$replace = array();
	
	$sql_doc_var = db::query("SELECT * FROM DOC_VAR WHERE DOC_ID ='".$doc_main["DOC_ID"]."'");
	while($doc_var = db::fetch_array($sql_doc_var)){
		if($doc_var["VAR_FIELD"] !=''){

			$value = bsf_show_text($doc_main["WF_MAIN_ID"],$F,'##'.$doc_var["VAR_FIELD"].'!!',$R1["WF_TYPE"]);
			$value = str_replace("<br />","",$value); 
			$value = str_replace("&lt;br&gt;","<w:br />",$value); 
			
			$value = str_replace('&nbsp;<i class="fa fa-check-square text-primary"></i> ',"	&#9745; ",$value); 
			$value = str_replace('&nbsp;<i class="fa fa-square-o text-muted"></i> ',"&#11036; ",$value); 
			//echo $value."\n";
			$document->setValue($doc_var["VAR_NAME"], $value);
		
		}
	}
	
	$temp_file = 'Doc'.$doc_main["WF_MAIN_ID"].'_'.$WFR.'_'.$DOC_ID.'v'.date('YmdHis').'.docx';
	$document->save($temp_file);

	header('Content-Description: File Transfer');
	header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
	header('Content-Disposition: attachment; filename='.$temp_file);
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Content-Length: ' . filesize($temp_file));
	ob_clean();
	flush();
	readfile($temp_file);
	unlink($temp_file); // deletes the temporary file



db::db_close();?>