<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://103.208.27.224/ega_led_mediate/service/getMedDataService.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
	"USERNAME":"BankruptDt",
    "PASSWORD":"Debtor4321",
    "WFR":"'.$POST["WFR"].'"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$dataReturn = json_decode($response,true);

//echo "<pre>";print_r($dataReturn);echo "</pre>";

//หมายบังคับคดี
unset($fields);
	$fields["REF_MEDIATE_ID"] 		=  $dataReturn["Data"]["mediateNo"];
	$fields["RECEIVE_DATE"] 		=  $dataReturn["Data"]["reqDate"];
	$fields["REQ_FNAME"] 			=  $dataReturn["Data"]["regName"];
	$fields["PLAINTIFF_FNAME"] 		=  $dataReturn["Data"]["plaintiffPrefix"].$dataReturn["Data"]["plaintiffFname"]." ".$dataReturn["Data"]["plaintiffLname"];
	$fields["DEFENDANT_FNAME"] 		=  $dataReturn["Data"]["defendantPrefix"].$dataReturn["Data"]["defendantFname"]." ".$dataReturn["Data"]["defendantLname"];
	$fields["COURT_ID"] 			=  $dataReturn["Data"]["courtCode"];
	$fields["CHANNEL_ID"] 			=  $dataReturn["Data"]["channelId"];
	$fields["COURT_NAME"] 			=  $dataReturn["Data"]["courtName"];
	$fields["CHANNEL_NAME"] 		=  $dataReturn["Data"]["channelName"];
	$fields["PREFIX_BLACK_CASE"] 	=  $dataReturn["Data"]["blackCaseTitle"];
	$fields["BLACK_CASE"]			=  $dataReturn["Data"]["blackCase"];
	$fields["BLACK_YY"] 			=  $dataReturn["Data"]["blackYear"];
	$fields["PREFIX_RED_CASE"] 		=  $dataReturn["Data"]["redCaseTitile"];
	$fields["RED_CASE"] 			=  $dataReturn["Data"]["redCase"];
	$fields["RED_YY"] 				=  $dataReturn["Data"]["redYear"];
	$fields["REF_WFR_ID"] 			=  $dataReturn["Data"]["wfrId"];
	$fields["CAPITAL_AMOUNT"] 		=  $dataReturn["Data"]["CapitalAmount"];
	
$sqlSelectData = "select WH_MEDAITE_ID from WH_MEDIATE_CASE where REF_WFR_ID = '".$dataReturn["Data"]["wfrId"]."' ";
$querySelectData = db::query($sqlSelectData);
$dataSelectData = db::fetch_array($querySelectData);

if($dataSelectData["WH_MEDAITE_ID"]>0){
	$WH_MEDAITE_ID = $dataSelectData["WH_MEDAITE_ID"];
	db::db_update("WH_MEDIATE_CASE", $fields, array("WH_MEDAITE_ID"=>$dataSelectData["WH_MEDAITE_ID"]));
}else{
	$WH_MEDAITE_ID = db::db_insert("WH_MEDIATE_CASE",$fields,'WH_MEDAITE_ID','WH_MEDAITE_ID');
}

echo $WH_MEDAITE_ID;
$dataReturn["Data"]["plaintiffIdCard"] = str_replace('-','',$dataReturn["Data"]["plaintiffIdCard"]);
$dataReturn["Data"]["defendantIdCard"] = str_replace('-','',$dataReturn["Data"]["defendantIdCard"]);

//คนในคดี
unset($fieldsPer);
	$fieldsPer["WH_MEDIATE_ID"] 	= $WH_MEDAITE_ID;
	$fieldsPer["PERSON_CODE"] 		= $dataReturn["Data"]["plaintiffType"];
	$fieldsPer["REGISTER_CODE"] 	= $dataReturn["Data"]["plaintiffIdCard"];
	$fieldsPer["PREFIX_CODE"] 		= $dataReturn["Data"]["plaintiffPrefixCode"];
	$fieldsPer["PREFIX_NAME"] 		= $dataReturn["Data"]["plaintiffPrefixName"];
	$fieldsPer["FIRST_NAME"] 		= $dataReturn["Data"]["plaintiffFname"];
	$fieldsPer["LAST_NAME"] 		= $dataReturn["Data"]["plaintiffLname"];
	$fieldsPer["CONCERN_CODE"] 		= '01';
	$fieldsPer["CONCERN_NAME"] 		= 'โจทก์';
	$fieldsPer["COURT_CODE"] 		= $dataReturn["Data"]["courtCode"];
	$fieldsPer["COURT_NAME"] 		= $dataReturn["Data"]["courtName"];
	$fieldsPer["PREFIX_BLACK_CASE"] = $dataReturn["Data"]["blackCaseTitle"];
	$fieldsPer["BLACK_CASE"] 		= $dataReturn["Data"]["blackCase"];
	$fieldsPer["BLACK_YY"] 			= $dataReturn["Data"]["blackYear"];
	$fieldsPer["PREFIX_RED_CASE"] 	= $dataReturn["Data"]["redCaseTitile"];
	$fieldsPer["RED_CASE"] 			= $dataReturn["Data"]["redCase"];
	$fieldsPer["RED_YY"] 			= $dataReturn["Data"]["redYear"];
	
	$fieldsPer["ADDRESS"] 			= $dataReturn["Data"]["plaintiffAddeNO"];
	$fieldsPer["TUM_NAME"] 			= $dataReturn["Data"]["plaintiffTum"];
	$fieldsPer["AMP_NAME"] 			= $dataReturn["Data"]["plaintiffAmph"];
	$fieldsPer["PROV_NAME"] 		= $dataReturn["Data"]["plaintiffProv"];
	$fieldsPer["ZIP_CODE"] 			= $dataReturn["Data"]["plaintiffZipcode"];
	
$sqlSelectDataPer1 		= "select WH_PERSON_ID from WH_MEDIATE_PERSON where WH_MEDIATE_ID = '".$WH_MEDAITE_ID."' and REGISTER_CODE = '".$dataReturn["Data"]["plaintiffIdCard"]."' and CONCERN_CODE = '01'";
$querySelectDataPer1 	= db::query($sqlSelectDataPer1);
$dataSelectDataPer1 	= db::fetch_array($querySelectDataPer1);
if($dataSelectDataPer1["WH_PERSON_ID"]>0){
	$WH_PERSON_ID = $dataSelectDataPer1["WH_PERSON_ID"];
	db::db_update("WH_MEDIATE_PERSON", $fieldsPer, array("WH_PERSON_ID"=>$dataSelectDataPer1["WH_PERSON_ID"]));
}else{
	$WH_PERSON_ID = db::db_insert("WH_MEDIATE_PERSON",$fieldsPer,'WH_PERSON_ID','WH_PERSON_ID');
}

unset($fieldsPer);
	$fieldsPer["WH_MEDIATE_ID"] 	= $WH_MEDAITE_ID;
	$fieldsPer["PERSON_CODE"] 		= $dataReturn["Data"]["defendantType"];
	$fieldsPer["REGISTER_CODE"] 	= $dataReturn["Data"]["defendantIdCard"];
	$fieldsPer["PREFIX_CODE"] 		= $dataReturn["Data"]["defendantPrefixCode"];
	$fieldsPer["PREFIX_NAME"] 		= $dataReturn["Data"]["defendantPrefixName"];
	$fieldsPer["FIRST_NAME"] 		= $dataReturn["Data"]["defendantFname"];
	$fieldsPer["LAST_NAME"] 		= $dataReturn["Data"]["defendantLname"];
	$fieldsPer["CONCERN_CODE"] 		= '02';
	$fieldsPer["CONCERN_NAME"] 		= 'จำเลย';
	$fieldsPer["COURT_CODE"] 		= $dataReturn["Data"]["courtCode"];
	$fieldsPer["COURT_NAME"] 		= $dataReturn["Data"]["courtName"];
	$fieldsPer["PREFIX_BLACK_CASE"] = $dataReturn["Data"]["blackCaseTitle"];
	$fieldsPer["BLACK_CASE"] 		= $dataReturn["Data"]["blackCase"];
	$fieldsPer["BLACK_YY"] 			= $dataReturn["Data"]["blackYear"];
	$fieldsPer["PREFIX_RED_CASE"] 	= $dataReturn["Data"]["redCaseTitile"];
	$fieldsPer["RED_CASE"] 			= $dataReturn["Data"]["redCase"];
	$fieldsPer["RED_YY"] 			= $dataReturn["Data"]["redYear"];
	
	$fieldsPer["ADDRESS"] 			= $dataReturn["Data"]["defendantAddeNO"];
	$fieldsPer["TUM_NAME"] 			= $dataReturn["Data"]["defendantTum"];
	$fieldsPer["AMP_NAME"] 			= $dataReturn["Data"]["defendantAmph"];
	$fieldsPer["PROV_NAME"] 		= $dataReturn["Data"]["defendantProv"];
	$fieldsPer["ZIP_CODE"] 			= $dataReturn["Data"]["defendantZipcode"];
	
$sqlSelectDataPer1 		= "select WH_PERSON_ID from WH_MEDIATE_PERSON where WH_MEDIATE_ID = '".$WH_MEDAITE_ID."' and REGISTER_CODE = '".$dataReturn["Data"]["defendantIdCard"]."' and CONCERN_CODE = '02' ";
$querySelectDataPer1 	= db::query($sqlSelectDataPer1);
$dataSelectDataPer1 	= db::fetch_array($querySelectDataPer1);
if($dataSelectDataPer1["WH_PERSON_ID"]>0){
	$WH_PERSON_ID = $dataSelectDataPer1["WH_PERSON_ID"];
	db::db_update("WH_MEDIATE_PERSON", $fieldsPer, array("WH_PERSON_ID"=>$dataSelectDataPer1["WH_PERSON_ID"]));
}else{
	$WH_PERSON_ID = db::db_insert("WH_MEDIATE_PERSON",$fieldsPer,'WH_PERSON_ID','WH_PERSON_ID');
}

//ผลการไกล่เกลี่ย
unset($fieldResult);
	$fieldResult["WH_MEDIATE_ID"] 		= $WH_MEDAITE_ID;
	$fieldResult["COURT_CODE"] 			= $dataReturn["Data"]["courtCode"];
	$fieldResult["COURT_NAME"] 			= $dataReturn["Data"]["courtName"];
	$fieldResult["PREFIX_BLACK_CASE"] 	= $dataReturn["Data"]["blackCaseTitle"];
	$fieldResult["BLACK_CASE"] 			= $dataReturn["Data"]["blackCase"];
	$fieldResult["BLACK_YY"] 			= $dataReturn["Data"]["blackYear"];
	$fieldResult["PREFIX_RED_CASE"] 	= $dataReturn["Data"]["redCaseTitile"];
	$fieldResult["RED_CASE"] 			= $dataReturn["Data"]["redCase"];
	$fieldResult["RED_YY"] 				= $dataReturn["Data"]["redYear"];
	
	$fieldResult["MEDIATOR_NAME"] 		= $dataReturn["Data"]["mediatorName"];
	$fieldResult["MEDIATE_NO"] 			= $dataReturn["Data"]["mediateNo"];
	$fieldResult["PAYMENT_AMOUNT_DEF"] 	= $dataReturn["Data"]["paymentAmountDef"];
	$fieldResult["MEDIATE_RESULT"] 		= $dataReturn["Data"]["mediatorResult"];
	$fieldResult["PLAINTIFF1"] 			=  $dataReturn["Data"]["plaintiffPrefix"].$dataReturn["Data"]["plaintiffFname"]." ".$dataReturn["Data"]["plaintiffLname"];
	$fieldResult["DEFFENDANT1"] 		=  $dataReturn["Data"]["defendantPrefix"].$dataReturn["Data"]["defendantFname"]." ".$dataReturn["Data"]["defendantLname"];
	$fieldResult["COURT_DATE"] 			=  $dataReturn["Data"]["reqDate"];
	$fieldResult["CAPITAL_AMOUNT"] 		=  $dataReturn["Data"]["CapitalAmount"];
	$fieldResult["CHANNEL_NAME"] 		=  $dataReturn["Data"]["channelName"];
	
$sqlSelectDataResult 	= "select WH_MEDIATE_ID from WH_MEDIATE_CASE_DETAIL where WH_MEDIATE_ID = '".$WH_MEDAITE_ID."' ";
$querySelectDataResult 	= db::query($sqlSelectDataResult);
$dataSelectDataResult 	= db::fetch_array($querySelectDataResult);

if($dataSelectDataResult["WH_MEDIATE_ID"]>0){
	db::db_update("WH_MEDIATE_CASE_DETAIL", $fieldResult, array("WH_MEDIATE_ID"=>$dataSelectDataResult["WH_MEDIATE_ID"]));
}else{
	db::db_insert("WH_MEDIATE_CASE_DETAIL",$fieldResult);
}

?>