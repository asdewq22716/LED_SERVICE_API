<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);
$i=0;

$form_field['USERNAME'] 			= 'BankruptDt';// เปลี่ยนเป็นค่าที่จะส่ง
$form_field['PASSWORD'] 			= 'Debtor4321';// เปลี่ยนเป็นค่าที่จะส่ง


if($POST['id']!=""){
	$sqlSelectData = "	SELECT 		COURT_NAME,T_BLACK_CASE,BLACK_CASE,BLACK_YY,OFFICE_NAME,T_RED_CASE,RED_CASE,RED_YY,PLAINTIFF,DEFENDANT,TO_COURT_NAME,TO_T_BLACK_CASE,TO_BLACK_CASE,TO_BLACK_YY,TO_T_RED_CASE,TO_RED_CASE,TO_RED_YY,SEND_TO,HANDLE_NAME,TO_PLAINTIFF,TO_DEFENDANT,CMD_TYPE_NAME,PREFIX_NAME,FIRST_NAME,LAST_NAME,F.CMD_NOTE
						FROM 		M_DOC_CMD A
						LEFT JOIN 	M_CMD_SYSTEM B ON A.SYS_NAME = B.CMD_SYSTEM_ID
						LEFT JOIN 	M_SERVICE_CMD C ON A.CASE_TYPE = C.CMD_TYPE_CODE
						LEFT JOIN 	M_CMD_PERSON D ON D.PERSON_ID = A.PERSON_ID
						LEFT JOIN 	M_CMD_TYPE E ON C.CMD_TYPE_ID = E.CMD_TYPE_ID
						LEFT JOIN 	M_CMD_DETAILS F ON A.ID = F.CMD_ID
						WHERE 		1=1 AND A.ID ='".$POST['id']."'
						ORDER BY 	F.CMD_DETAIL_DATE DESC,
									F.CMD_DETAIL_TIME DESC"; 


	$querySelectData = db::query($sqlSelectData);
	$dataSelectData = db::fetch_array($querySelectData);
	
	$obj[$i]['CourtName'] 			= $dataSelectData['COURT_NAME'];
	$obj[$i]['tBlackCase'] 			= $dataSelectData['T_BLACK_CASE'];
	$obj[$i]['blackCase'] 			= $dataSelectData['BLACK_CASE'];
	$obj[$i]['BlacyYy'] 			= $dataSelectData['BLACK_YY'];
	$obj[$i]['tRedCase'] 			= $dataSelectData['T_RED_CASE'];
	$obj[$i]['redCase'] 			= $dataSelectData['RED_CASE'];
	$obj[$i]['redYy'] 				= $dataSelectData['RED_YY'];
	$obj[$i]['plaintiff'] 			= $dataSelectData['PLAINTIFF'];
	$obj[$i]['defrndant'] 			= $dataSelectData['DEFENDANT'];
	$obj[$i]['toCortName'] 			= $dataSelectData['TO_COURT_NAME'];
	$obj[$i]['toTBlackCase'] 		= $dataSelectData['TO_T_BLACK_CASE'];
	$obj[$i]['toBlackCase'] 		= $dataSelectData['TO_BLACK_CASE'];
	$obj[$i]['toBlackYy'] 			= $dataSelectData['TO_BLACK_YY'];
	$obj[$i]['toTRedCase'] 			= $dataSelectData['TO_T_RED_CASE'];
	$obj[$i]['toRedCase'] 			= $dataSelectData['TO_RED_CASE'];
	$obj[$i]['toRedYy'] 			= $dataSelectData['TO_RED_YY'];
	$obj[$i]['sendTo'] 				= $dataSelectData['SEND_TO'];
	$obj[$i]['handleName'] 			= $dataSelectData['OFFICE_NAME'];
	$obj[$i]['toPlaintiff'] 		= $dataSelectData['PLAINTIFF'];
	$obj[$i]['toDefendant'] 		= $dataSelectData['DEFENDANT'];
	$obj[$i]['cmdTypeName'] 		= $dataSelectData['CMD_TYPE_NAME'];
	$obj[$i]['prefxName'] 			= $dataSelectData['PREFIX_NAME'];
	$obj[$i]['firstName'] 			= $dataSelectData['FIRST_NAME'];
	$obj[$i]['lastName'] 			= $dataSelectData['LAST_NAME'];
	$obj[$i]['cmdNote'] 			= $dataSelectData['CMD_NOTE'];
	
	$sql_person = db::query("SELECT * FROM M_CMD_PERSON WHERE CMD_ID = '".$POST['id']."'");
	$rec_person = db::fetch_array($sql_person);
	$obj[$i]['personInCase'] 		= $rec_person['FULL_NAME'];

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
