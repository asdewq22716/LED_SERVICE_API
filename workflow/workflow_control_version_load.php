<?php
$HIDE_HEADER = 'Y';
include '../include/comtop_user.php'; 

$DOC_ID = conText($_GET["DOC_ID"]);
$WFR = conText($_GET["WFR"]);
$W = conText($_GET['W']);
$DV = conText($_GET['DV']);


$sql_doc_main = db::query("SELECT * FROM DOC_VERSION WHERE WF_MAIN_ID='".$W."' AND WFR_ID='".$WFR."' AND DOC_ID='".$DOC_ID."' AND  DV_ID = '".$DV."'");
$doc_main = db::fetch_array($sql_doc_main);
if($doc_main['DV_ID'] != ""){


	$filename = "../controlversion/w".$W."/".$doc_main["DV_PATH"];
	
		require_once '../PHPWord.php';
		$PHPWord = new PHPWord();
		
		$document = $PHPWord->loadTemplate($filename);


	
	$temp_file = 'Doc'.$W.'_'.$WFR.'_'.$DOC_ID.'v'.date('YmdHis').'.docx';
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


}
db::db_close();?>