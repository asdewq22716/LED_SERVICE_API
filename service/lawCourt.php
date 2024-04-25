<?php
include '../include/include.php';


$str_json = file_get_contents("php://input");
$data = json_decode($str_json, true);

if($data['COURT_CODE_BR']!=''){
	$sql = "SELECT COURT_CODE_LAW FROM M_COURT_CODE_MAP WHERE COURT_CODE_BR = '".$data['COURT_CODE_BR']."'";
	$query = db::query($sql);
	$res = db::fetch_array($query);
	$row = $res['COURT_CODE_LAW'];
}else if($data['COURT_CODE_LAW']!=''){
	$sql = "SELECT COURT_CODE_BR FROM M_COURT_CODE_MAP WHERE COURT_CODE_LAW = '".$data['COURT_CODE_LAW']."'";
	$query = db::query($sql);
	$res = db::fetch_array($query);
	$row = $res['COURT_CODE_BR'];
}else if($data['COURT_CODE_MD']!=''){
	$sql = "SELECT COURT_CODE_MD FROM M_COURT_CODE_MAP WHERE COURT_CODE_LAW = '".$data['COURT_CODE_MD']."'";
	$query = db::query($sql);
	$res = db::fetch_array($query);
	$row = $res['COURT_CODE_MD'];
}

echo json_encode($row); 
 ?>