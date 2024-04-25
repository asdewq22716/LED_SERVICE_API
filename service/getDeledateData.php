<?php
include '../include/include.php';


$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);


function getProvince($id){
	$sqlSelectData 		= "SELECT PROVINCE_NAME FROM G_PROVINCE WHERE PROVINCE_CODE = '".$id."' ";
	$querySelectData 	= db::query($sqlSelectData);
	$dataSelectData 	= db::fetch_array($querySelectData);
	return $dataSelectData["PROVINCE_NAME"];
}
function getAmphur($id){
	$sqlSelectData 		= "SELECT AMPHUR_NAME FROM G_AMPHUR WHERE PROVINCE_CODE||''||AMPHUR_CODE = '".$id."' ";
	$querySelectData 	= db::query($sqlSelectData);
	$dataSelectData 	= db::fetch_array($querySelectData);
	return $dataSelectData["AMPHUR_NAME"];
}
function getTumbon($id){
	$sqlSelectData 		= "SELECT TAMBON_NAME FROM G_TAMBON WHERE PROVINCE_CODE||''||AMPHUR_CODE||''||TAMBON_CODE = '".$id."' ";
	$querySelectData 	= db::query($sqlSelectData);
	$dataSelectData 	= db::fetch_array($querySelectData);
	return $dataSelectData["TAMBON_NAME"];
}


$filter = "";
if($POST["systemType"]!=""){
	$filter .= " AND SYSTEM_ID = '".$POST["systemType"]."'";
}
if($POST["prefixBlackCase"]!=""){
	$filter .= " and PREFIX_BLACK_CASE = '".$POST['prefixBlackCase']."'	";
}
if($POST["blackCase"]!=""){
	$filter .= " and BLACK_CASE = '".$POST['blackCase']."'	";
}
if($POST["blackYy"]!=""){
	$filter .= " and BLACK_YEAR = '".$POST['blackYy']."'	";
}
if($POST["prefixRedCase"]!=""){
	$filter .= " and PREFIX_RED_CASE = '".$POST['prefixRedCase']."'	";
}
if($POST["redCase"]!=""){
	$filter .= " and CASE_RED = '".$POST['redCase']."'	";
}
if($POST["redYy"]!=""){
	$filter .= " and RED_YEAR = '".$POST['redYy']."'	";
}
if($POST["CourtCode"]!=""){
	$filter .= " and COURT_CODE = '".$POST['CourtCode']."'	";
}
if($POST["registerCode"]!=""){
	$filter .= " and (DELEGATE_ID IN (SELECT AA.WFR_ID FROM FRM_DELEGATE_FORM AA WHERE DELEGATE_IDCARD = '".str_replace('-','',$POST["registerCode"])."' OR  DELEGATE_LP_NUMBER = '".str_replace('-','',$POST["registerCode"])."') OR DELEGATE_ID IN (SELECT AA.WFR_ID FROM FRM_DELEGATE_TO AA WHERE DELEGATE_IDCARD = '".str_replace('-','',$POST["registerCode"])."' OR  DELEGATE_LP_NUMBER = '".str_replace('-','',$POST["registerCode"])."'))	";
}

$sqlSelectData 		= "	select 	* 
						from 	FRM_DELEGATE_FORM
						where 	rownum < 1"; 
$arrFieldsDelegate 	= db::query_field($sqlSelectData);

$obj = array();
$sqlSelectData = "SELECT * FROM M_DELEGATE WHERE 1=1 {$filter}";
$querySelectData = db::query($sqlSelectData);
$loopMain = 1;
while($dataSelectData = db::fetch_array($querySelectData)){
	
	$obj[$loopMain]['main']["prefixBlackCase"] 	= $dataSelectData["PREFIX_BLACK_CASE"];
	$obj[$loopMain]['main']["blackCase"] 		= $dataSelectData["BLACK_CASE"];
	$obj[$loopMain]['main']["blackYy"] 			= $dataSelectData["BLACK_YEAR"];
	$obj[$loopMain]['main']["prefixRedCase"] 	= $dataSelectData["PREFIX_RED_CASE"];
	$obj[$loopMain]['main']["redCase"] 			= $dataSelectData["CASE_RED"];
	$obj[$loopMain]['main']["redYy"] 			= $dataSelectData["RED_YEAR"];
	$obj[$loopMain]['main']["plaintiff"] 		= $dataSelectData["PLAINTIFF"];
	$obj[$loopMain]['main']["deffendant"] 		= $dataSelectData["DEFFENDANT"];
	
	$i = 1;
	$sqlSelectDelecateFrom = "	SELECT 		a.*,b.P_NAME_BOF as PREFIX_NAME
								FROM 		FRM_DELEGATE_FORM a 
								INNER JOIN 	M_PREFIX_MAP b on a.DELEGATE_PREFIX = b.P_CODE
								WHERE 		WFR_ID = '".$dataSelectData["DELEGATE_ID"]."' ";
	$queryDelecateFrom = db::query($sqlSelectDelecateFrom);
	while($dataDelecateFrom = db::fetch_array($queryDelecateFrom)){
		foreach($arrFieldsDelegate as $key => $val){
			if($val!="F_ID" && $val!="WF_MAIN_ID" && $val!="WFR_ID" && $val!="WFD_ID" && $val!="WFS_ID" && $val!="F_TEMP_ID" && $val!="F_CREATE_DATE" && $val!="F_CREATE_BY" && $val!="F_UPDATE_DATE" && $val!="F_UPDATE_BY"){
				$obj[$loopMain]["delegateFrom"][$i][underToCamel($val)] = $dataDelecateFrom[$val];
				
				if($val=='DELEGATE_PROVINCE'){
					$obj[$loopMain]["delegateFrom"][$i][underToCamel("DELEGATE_PROVINCE")] = getProvince($dataDelecateFrom["DELEGATE_PROVINCE"]);
				}
				
				if($val=='DELEGATE_AMPHUR'){
					$obj[$loopMain]["delegateFrom"][$i][underToCamel("DELEGATE_AMPHUR")] = getAmphur($dataDelecateFrom["DELEGATE_AMPHUR"]);
				}
				
				if($val=='DELEGATE_TAMBOM'){
					$obj[$loopMain]["delegateFrom"][$i][underToCamel("DELEGATE_TAMBOM")] = getTumbon($dataDelecateFrom["DELEGATE_TAMBOM"]);
				}
				
				if($val=='CUR_DELEGATE_PROVINCE'){
					$obj[$loopMain]["delegateFrom"][$i][underToCamel("CUR_DELEGATE_PROVINCE")] = getProvince($dataDelecateFrom["CUR_DELEGATE_PROVINCE"]);
				}
				
				if($val=='CUR_DELEGATE_AMPHUR'){
					$obj[$loopMain]["delegateFrom"][$i][underToCamel("CUR_DELEGATE_AMPHUR")] = getAmphur($dataDelecateFrom["CUR_DELEGATE_AMPHUR"]);
				}
				
				if($val=='CUR_DELEGATE_TUMBON'){
					$obj[$loopMain]["delegateFrom"][$i][underToCamel("CUR_DELEGATE_TUMBON")] = getTumbon($dataDelecateFrom["CUR_DELEGATE_TUMBON"]);
				}
			}
		}
		$obj[$loopMain]["delegateFrom"][$i][underToCamel("PREFIX_NAME")] 	= $dataDelecateFrom["PREFIX_NAME"];
		$i++;
	}
	
	$i = 1;
	$sqlSelectDelecateTo = "SELECT 		a.*,b.P_NAME_BOF as PREFIX_NAME
							FROM 		FRM_DELEGATE_TO a  
							INNER JOIN 	M_PREFIX_MAP b on a.DELEGATE_PREFIX = b.P_CODE
							WHERE 		WFR_ID = '".$dataSelectData["DELEGATE_ID"]."' ";
	$queryDelecateTo = db::query($sqlSelectDelecateTo);
	while($dataDelecateTo = db::fetch_array($queryDelecateTo)){
		foreach($arrFieldsDelegate as $key => $val){
			if($val!="F_ID" && $val!="WF_MAIN_ID" && $val!="WFR_ID" && $val!="WFD_ID" && $val!="WFS_ID" && $val!="F_TEMP_ID" && $val!="F_CREATE_DATE" && $val!="F_CREATE_BY" && $val!="F_UPDATE_DATE" && $val!="F_UPDATE_BY"){
				$obj[$loopMain]["delegateTo"][$i][underToCamel($val)] = $dataDelecateTo[$val];
				
				if($val=='DELEGATE_PROVINCE'){
					$obj[$loopMain]["delegateTo"][$i][underToCamel("DELEGATE_PROVINCE")] = getProvince($dataDelecateTo["DELEGATE_PROVINCE"]);
				}
				
				if($val=='DELEGATE_AMPHUR'){
					$obj[$loopMain]["delegateTo"][$i][underToCamel("DELEGATE_AMPHUR")] = getAmphur($dataDelecateTo["DELEGATE_AMPHUR"]);
				}
				
				if($val=='DELEGATE_TAMBOM'){
					$obj[$loopMain]["delegateTo"][$i][underToCamel("DELEGATE_TAMBOM")] = getTumbon($dataDelecateTo["DELEGATE_TAMBOM"]);
				}
				
				if($val=='CUR_DELEGATE_PROVINCE'){
					$obj[$loopMain]["delegateTo"][$i][underToCamel("CUR_DELEGATE_PROVINCE")] = getProvince($dataDelecateTo["CUR_DELEGATE_PROVINCE"]);
				}
				
				if($val=='CUR_DELEGATE_AMPHUR'){
					$obj[$loopMain]["delegateTo"][$i][underToCamel("CUR_DELEGATE_AMPHUR")] = getAmphur($dataDelecateTo["CUR_DELEGATE_AMPHUR"]);
				}
				
				if($val=='CUR_DELEGATE_TUMBON'){
					$obj[$loopMain]["delegateTo"][$i][underToCamel("CUR_DELEGATE_TUMBON")] = getTumbon($dataDelecateTo["CUR_DELEGATE_TUMBON"]);
				}
			}
		}
		$obj[$loopMain]["delegateTo"][$i][underToCamel("PREFIX_NAME")] 	= $dataDelecateTo["PREFIX_NAME"];
		$i++;
	}
	
	$i = 1;
	$sqlSelectDelecateFile = "	SELECT 		a.DELEGATE_NAME,b.FILE_EXT,FILE_SAVE_NAME
								FROM 		FRM_DELEGATE_FILE a 
								INNER JOIN 	WF_FILE b on a.F_ID = b.WFR_ID AND WFS_FIELD_NAME = 'DELEGATE_FILE'
								WHERE 		a.WFR_ID = '".$dataSelectData["DELEGATE_ID"]."' ";
	$queryDelecateFile = db::query($sqlSelectDelecateFile);
	while($dataDelecateFile = db::fetch_array($queryDelecateFile)){
		
		$obj[$loopMain]["fileAttach"][$i][underToCamel("DELEGATE_NAME")] 	= $dataDelecateFile["DELEGATE_NAME"];
		$obj[$loopMain]["fileAttach"][$i][underToCamel("FILE_EXT")] 		= $dataDelecateFile["FILE_EXT"];
		
		$file_data  = file_get_contents('../attach/w123/'.$dataDelecateFile["FILE_SAVE_NAME"]);//ไฟล์ที่ต้องการส่ง
		$file_data = chunk_split(base64_encode($file_data));

		$obj[$loopMain]["fileAttach"][$i][underToCamel("FILE_DATE")] 		= $file_data;
		
		
	}
	$loopMain++;
	
}

$num = count($obj);

if($num > 0){

	$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");	
	$row['Data'] = $obj;
		
}else{
		
	$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");

}

echo json_encode($row); 



?>