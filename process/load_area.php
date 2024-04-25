<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
$HIDE_HEADER = "Y";
include '../include/config.php';
$P = conText($_GET['P']);
$A = conText($_GET['A']);
$T = conText($_GET['T']);
$Q_A = conText($_GET['qa']);
$Q_T = conText($_GET['qt']);
if($P != ""){
header('Content-Type: application/json');
$array_a = array();
if($_SESSION['WF_LANGUAGE'] == ""){ $amp_name = "AMPHUR_NAME"; }else{ $amp_name = "AMPHUR_NAME_EN"; }
$sql_form_a = db::query("select PROVINCE_CODE,AMPHUR_CODE,".$amp_name." from G_AMPHUR where PROVINCE_CODE = '".$P."' AND AMPHUR_NAME NOT LIKE '%*%' ORDER BY AMPHUR_CODE ASC");
$i=0;
	while($rec_form_a = db::fetch_array($sql_form_a)){ 
	$array_a[$i]["id"] = $rec_form_a["PROVINCE_CODE"].$rec_form_a["AMPHUR_CODE"]; 
	$array_a[$i]["text"] = str_replace("*","",$rec_form_a[$amp_name]); 
	if($A == $rec_form_a["PROVINCE_CODE"].$rec_form_a["AMPHUR_CODE"]){
	$array_a[$i]["selected"] = "selected";
	}
	$i++;
	}
	echo json_encode($array_a,JSON_NUMERIC_CHECK);
}
if($A != ""){
header('Content-Type: application/json');
$Prov = substr($A,0,2);
$Amphur = substr($A,2,2);
$array_a = array();
if($_SESSION['WF_LANGUAGE'] == ""){ $tam_name = "TAMBON_NAME"; }else{ $tam_name = "TAMBON_NAME_EN"; }
$sql_form_a = db::query("select PROVINCE_CODE,AMPHUR_CODE,TAMBON_CODE,".$tam_name." from G_TAMBON where PROVINCE_CODE = '".$Prov."' AND AMPHUR_CODE = '".$Amphur."' AND TAMBON_NAME NOT LIKE '%*%' ORDER BY TAMBON_CODE ASC");
$i=0;
	while($rec_form_a = db::fetch_array($sql_form_a)){ 
	$array_a[$i]["id"] = $rec_form_a["PROVINCE_CODE"].$rec_form_a["AMPHUR_CODE"].$rec_form_a["TAMBON_CODE"];  
	$array_a[$i]["text"] = str_replace("*","",$rec_form_a[$tam_name]);  
	$i++;
	}
	echo json_encode($array_a,JSON_NUMERIC_CHECK);
}
if($T != ""){
$Prov = substr($T,0,2);
$Amphur = substr($T,2,2);
$Tambon = substr($T,4,2);
$array_a = array();
$sql_form_a = db::query("select ZIP_CODE from G_TAMBON where PROVINCE_CODE = '".$Prov."' AND AMPHUR_CODE = '".$Amphur."' AND TAMBON_CODE = '".$Tambon."'  ");
$i=0;
		$rec_form_a = db::fetch_array($sql_form_a); 
		echo $rec_form_a["ZIP_CODE"]; 
}
if($Q_A != ""){
header('Content-Type: application/json');
$array_a = array();
$sql_form_a = db::query("select PROVINCE_CODE,AMPHUR_CODE,AMPHUR_NAME,PROVINCE_NAME from G_AMPHUR where AMPHUR_NAME LIKE '%".$Q_A."%' ORDER BY PROVINCE_NAME,AMPHUR_NAME ASC");
$i=0;
	while($rec_form_a = db::fetch_array($sql_form_a)){
	if($rec_form_a["PROVINCE_CODE"]=="10"){
	$p_txt = ' ';
	$a_txt = ' เขต';
	}else{
	$p_txt = ' จ.';
	$a_txt = ' อ.';
	}		
	$array_a[$i]["id"] = $rec_form_a["PROVINCE_CODE"].$rec_form_a["AMPHUR_CODE"]; 
	$array_a[$i]["text"] = $a_txt.str_replace("*","",$rec_form_a["AMPHUR_NAME"]).$p_txt.$rec_form_a["PROVINCE_NAME"];  
	$i++;
	}
	echo json_encode($array_a,JSON_NUMERIC_CHECK);
}
if($Q_T != ""){
header('Content-Type: application/json');
$array_a = array();
$sql_form_a = db::query("select PROVINCE_CODE,AMPHUR_CODE,TAMBON_CODE,TAMBON_NAME,AMPHUR_NAME,PROVINCE_NAME from G_TAMBON where TAMBON_NAME LIKE '%".$Q_T."%' ORDER BY PROVINCE_NAME,AMPHUR_NAME,TAMBON_NAME ASC");
$i=0;
	while($rec_form_a = db::fetch_array($sql_form_a)){
	if($rec_form_a["PROVINCE_CODE"]=="10"){
	$p_txt = ' ';
	$a_txt = ' เขต';
	$t_txt = ' แขวง';
	}else{
	$p_txt = ' จ.';
	$a_txt = ' อ.';
	$t_txt = 'ต.';	
	}
	$array_a[$i]["id"] = $rec_form_a["PROVINCE_CODE"].$rec_form_a["AMPHUR_CODE"].$rec_form_a["TAMBON_CODE"]; 
	$array_a[$i]["text"] = $t_txt.str_replace("*","",$rec_form_a["TAMBON_NAME"]).$a_txt.str_replace("*","",$rec_form_a["AMPHUR_NAME"]).$p_txt.$rec_form_a["PROVINCE_NAME"];
	$i++;
	}
	echo json_encode($array_a,JSON_NUMERIC_CHECK);
}
db::db_close();

/*UPDATE G_AMPHUR SET PROVINCE_NAME = (SELECT PROVINCE_NAME FROM G_PROVINCE WHERE G_PROVINCE.PROVINCE_CODE = G_AMPHUR.PROVINCE_CODE)

UPDATE G_TAMBON SET PROVINCE_NAME = (SELECT PROVINCE_NAME FROM G_PROVINCE WHERE G_PROVINCE.PROVINCE_CODE = G_TAMBON.PROVINCE_CODE)

UPDATE G_TAMBON SET AMPHUR_NAME = (SELECT AMPHUR_NAME FROM G_AMPHUR WHERE G_AMPHUR.PROVINCE_CODE = G_TAMBON.PROVINCE_CODE AND  G_AMPHUR.AMPHUR_CODE = G_TAMBON.AMPHUR_CODE)
*/
?>