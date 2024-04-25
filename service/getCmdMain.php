<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);
$i=0;

$form_field['USERNAME'] 			= 'BankruptDt';// เปลี่ยนเป็นค่าที่จะส่ง
$form_field['PASSWORD'] 			= 'Debtor4321';// เปลี่ยนเป็นค่าที่จะส่ง

$filter = "";
if($POST['idCard']!=""){
	$filter .= " AND REPLACE ( D.ID_CARD, '-', '' ) = '".$POST['idCard']."' ";
}

if($POST['prefixBlackCaseTo']!=""){
	$filter .= "AND (
					( A.TO_T_BLACK_CASE = '".$POST['prefixBlackCaseTo']."' AND A.TO_BLACK_CASE = '".$POST['blackCaseTo']."' AND A.TO_BLACK_YY = '".$POST['blackYyTo']."' ) 
					OR 
					( A.TO_T_RED_CASE = '".$POST['prefixRedCaseTo']."' AND A.TO_RED_CASE = '".$POST['prefixRedCaseTo']."' AND A.TO_RED_YY = '".$POST['redCaseTo']."' ) 
					)";
}
if($POST["sendTo"]!=""){
	$sqlSelectData = "	SELECT 		A.ID,CMD_DOC_DATE,CMD_DOC_TIME,CMD_TYPE_NAME,SERVICE_SYS_NAME,COURT_NAME,A.ID,T_BLACK_CASE,BLACK_CASE,BLACK_YY,T_RED_CASE,RED_CASE,RED_YY,CMD_NOTE,CMD_GRP_NAME 
						FROM		M_DOC_CMD A
						LEFT JOIN 	M_CMD_SYSTEM B ON A.SYS_NAME = B.CMD_SYSTEM_ID
						LEFT JOIN 	M_SERVICE_CMD C ON A.CASE_TYPE = C.CMD_TYPE_CODE
						LEFT JOIN 	M_CMD_PERSON D ON D.PERSON_ID = A.PERSON_ID
						LEFT JOIN 	M_CMD_TYPE E ON C.CMD_TYPE_ID = E.CMD_TYPE_ID 
						WHERE		A.SEND_TO = '".$POST["sendTo"]."'
									AND (
										( A.T_BLACK_CASE = '".$POST['prefixBlackCase']."' AND A.BLACK_CASE = '".$POST['blackCase']."' AND A.BLACK_YY = '".$POST['blackYy']."' ) 
										OR 
										( A.T_RED_CASE = '".$POST['prefixRedCase']."' AND A.RED_CASE = '".$POST['prefixRedCase']."' AND A.RED_YY = '".$POST['redCase']."' ) 
										) 
									 {$filter}"; 


	$querySelectData = db::query($sqlSelectData);
	while($dataSelectData = db::fetch_array($querySelectData)){
		$obj[$i]['cmdDocDate'] 			= $dataSelectData['CMD_DOC_DATE'];
		$obj[$i]['cmdDocTime'] 			= $dataSelectData['CMD_DOC_TIME'];
		$obj[$i]['cmdTypeName'] 		= $dataSelectData['CMD_TYPE_NAME'];
		$obj[$i]['serviceSysName'] 		= $dataSelectData['SERVICE_SYS_NAME'];
		$obj[$i]['courtName'] 			= $dataSelectData['COURT_NAME'];
		$obj[$i]['id'] 					= $dataSelectData['ID'];
		$obj[$i]['blackCase'] 			= $dataSelectData['T_BLACK_CASE'].''. $dataSelectData['BLACK_CASE'].' / '.$dataSelectData['BLACK_YY'];
		$obj[$i]['redCase'] 			= $dataSelectData['T_RED_CASE'].''. $dataSelectData['RED_CASE'].' / '.$dataSelectData['RED_YY'];
		$i++;
	}

}
$num = count($obj);

if($num > 0){

	$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");
	$row['Data'] = $obj;
	
	$data = $row;

}else{

	$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");
	$data = $row;
}

echo json_encode($data);

 ?>
