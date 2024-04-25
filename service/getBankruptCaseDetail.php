<?php
include '../include/include.php';


$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);

$filter = "";
if($POST["PREFIX_BLACK_CASE"]!=""){
	$filter .= " AND PREFIX_BLACK_CASE = '".$POST["PREFIX_BLACK_CASE"]."' ";
}
if($POST["BLACK_CASE"]!=""){
	$filter .= " AND BLACK_CASE = '".$POST["BLACK_CASE"]."' ";
}
if($POST["BLACK_YY"]!=""){
	$filter .= " AND BLACK_YY = '".$POST["BLACK_YY"]."' ";
}
if($POST["PREFIX_RED_CASE"]!=""){
	$filter .= " AND PREFIX_RED_CASE = '".$POST["PREFIX_RED_CASE"]."' ";
}
if($POST["RED_CASE"]!=""){
	$filter .= " AND RED_CASE = '".$POST["RED_CASE"]."' ";
}
if($POST["RED_YY"]!=""){
	$filter .= " AND RED_YY = '".$POST["RED_YY"]."' ";
}


$obj = array();

//Field ข้อมูลหลัก
$sqlSelectCase= "	select 	* 
					from 	WH_BANKRUPT_CASE_DETAIL
					where 	rownum < 1"; 
$arrFieldsCase = db::query_field($sqlSelectCase);

//Field คนในคดี
$sqlSelectCasePer= "	select 	* 
					from 	WH_BANKRUPT_CASE_PERSON
					where 	rownum < 1"; 
$arrFieldsCasePer = db::query_field($sqlSelectCasePer);

//Field ทรัพย์ในคดี
$sqlSelectCaseAsset= "	select 	* 
					from 	WH_BANKRUPT_ASSETS
					where 	rownum < 1"; 
$arrFieldsCaseAsset = db::query_field($sqlSelectCaseAsset);

//Field คำสั่งศาล
$sqlSelectCaseCourtLog= "	select 	* 
							from 	WH_COURT_LOG
							where 	rownum < 1"; 
$arrFieldsCaseCourtLog = db::query_field($sqlSelectCaseCourtLog);

$i = 1;
$sqlSelectMain = "	select 	* 
					from 	WH_BANKRUPT_CASE_DETAIL
					where 	1=1 {$filter}
				 ";
$querySelectMain = db::query($sqlSelectMain);
while($dataSelectMain = db::fetch_array($querySelectMain)){
	foreach($arrFieldsCase as $key => $val){
		$obj[$i][underToCamel($val)] = $dataSelectMain[$val];
	}
	//คนในคดี
	$arrPer = array();
	$countPer = 1;
	$sqlSelectDataPer = "SELECT * 
						 FROM	WH_BANKRUPT_CASE_PERSON
						 WHERE	WH_BANKRUPT_ID = '".$dataSelectMain["WH_BANKRUPT_ID"]."' ";
	$querySelectDataPer = db::query($sqlSelectDataPer);
	while($dataSelectDataPer = db::fetch_array($querySelectDataPer)){
		foreach($arrFieldsCasePer as $key => $val){
			$arrPer[$countPer][underToCamel($val)] = $dataSelectDataPer[$val];
		}
		$countPer++;
	}
	//ทรัพย์ในคดี
	$arrAsset = array();
	$countAsset = 1;
	$sqlSelectDataAsset = "	SELECT * 
							FROM	WH_BANKRUPT_ASSETS
							WHERE	WH_BANKRUPT_ID = '".$dataSelectMain["WH_BANKRUPT_ID"]."' ";
	$querySelectDataAsset = db::query($sqlSelectDataAsset);
	while($dataSelectDataAsset = db::fetch_array($querySelectDataAsset)){
		foreach($arrFieldsCaseAsset as $key => $val){
			$arrAsset[$countAsset][underToCamel($val)] = $dataSelectDataAsset[$val];
		}
		$countAsset++;
	}
	//ประวัติคำสั่งศาล
	$arrCourtLog = array();
	$countCourtLog = 1;
	$sqlSelectDataCourtLog = "	SELECT  	* 
								FROM		WH_COURT_LOG
								WHERE		COURT_SYSTEM_TYPE = '2' 
											AND PREFIX_BLACK_CASE = '".$dataSelectMain["PREFIX_BLACK_CASE"]."' 
											AND BLACK_CASE = '".$dataSelectMain["BLACK_CASE"]."'
											AND BLACK_YY = '".$dataSelectMain["BLACK_YY"]."'
											AND PREFIX_RED_CASE = '".$dataSelectMain["PREFIX_RED_CASE"]."'
											AND RED_CASE = '".$dataSelectMain["RED_CASE"]."'
											AND RED_YY = '".$dataSelectMain["RED_YY"]."'
								ORDER BY 	WH_COURT_LOG_ID ASC";
	$querySelectDataCourtLog = db::query($sqlSelectDataCourtLog);
	while($dataSelectCourtLog = db::fetch_array($querySelectDataCourtLog)){
		foreach($arrFieldsCaseCourtLog as $key => $val){
			$arrCourtLog[$countCourtLog][underToCamel($val)] = $dataSelectCourtLog[$val];
		}
		$countCourtLog++;
	}
	
	$obj[$i]["person"] 		= $arrPer;
	$obj[$i]["asset"] 		= $arrAsset;
	$obj[$i]["courtLog"] 	= $arrCourtLog;
	
	$i++;
	
	
}
				 
echo json_encode($obj);


?>