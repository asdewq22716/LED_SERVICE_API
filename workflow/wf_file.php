<?php
ini_set('max_execution_time', 0);
ini_set('memory_limit', '2048M');
include("../include/include.php");
$F_ID = wf_decode(conText($_GET['F_ID']));
if(is_numeric($F_ID)){
$sql_attach = db::query("select * from WF_FILE where FILE_ID = '".$F_ID."'");
$rec_a = db::fetch_array($sql_attach);

$linesz= filesize('../attach/w'.$rec_a["WF_MAIN_ID"].'/'.$rec_a["FILE_SAVE_NAME"]);
if($linesz > 0){
header( 'Content-type: application/x-www-form-urlencoded' );
header( 'Content-Length: ' . $linesz );
header( 'Content-Disposition: filename="'.$rec_a["FILE_NAME"].'"' );
header( 'Content-Description: Download Data' );
header( 'Pragma: no-cache' );
header( 'Expires: 0' );
$fp = fopen('../attach/w'.$rec_a["WF_MAIN_ID"].'/'.$rec_a["FILE_SAVE_NAME"],'rb');

$ata = fread($fp, $linesz);
echo $ata;
@fclose($fp);
}
}
db::db_close();
?>