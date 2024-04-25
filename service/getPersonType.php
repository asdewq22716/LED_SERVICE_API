<?php
include '../include/include.php';


$str_json = file_get_contents("php://input");
$data = json_decode($str_json, true);

if($data['personType']!=''){
	$sql = "SELECT * FROM M_MAP_PERSON_TYPE WHERE PERSON_MAP_CODE = '".$data['personType']."'";
	$query = db::query($sql);
	$res = db::fetch_array($query);
	$row['personTypeLaw'] = $res['PERSON_CODE_LAW'];
	$row['personTypeBr'] = $res['PERSON_CODE_BR'];
	$row['personTypeRv'] = $res['PERSON_CODE_RV'];
	$row['personTypeMd'] = $res['PERSON_CODE_MD'];
}

if($data['personMapCode'] !='' ){
	
	if($data['systemType'] == '1'){
		
		$field = "AND PERSON_CODE_LAW = '".$data['personMapCode']."'";
		
	}else if($data['systemType'] == '2'){
		
		$field = "AND PERSON_CODE_BR = '".$data['personMapCode']."'";
		
	}else if($data['systemType'] == '3'){
		
		$field = "AND PERSON_CODE_RV = '".$data['personMapCode']."'";
		
	}else if($data['systemType'] == '4'){
		
		$field = "AND PERSON_CODE_MD = '".$data['personMapCode']."'";
	}
	$sql = "SELECT PERSON_MAP_CODE FROM M_MAP_PERSON_TYPE WHERE 1=1 {$field}";
	$query = db::query($sql);
	$res = db::fetch_array($query);
	$row['personMapCode'] = $res['PERSON_MAP_CODE'];
}	


echo json_encode($row); 
 ?>
 