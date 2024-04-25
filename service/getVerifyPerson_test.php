<?php
include '../include/include.php';


$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);

$obj   = array();

$sqlSelectDataMed = "	select 		a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,b.PREFIX_BLACK_CASE,b.BLACK_CASE,b.BLACK_YY,b.PREFIX_RED_CASE,b.RED_CASE,b.RED_YY,b.COURT_NAME
						from 		WH_MEDIATE_PERSON a 
						inner join 	WH_MEDIATE_CASE b on a.WH_MEDIATE_ID = b.WH_MEDAITE_ID
						where 		REGISTER_CODE = '9020419376589'		
					";
$querySelectDataMed = db::query($sqlSelectDataMed);
while($recSelectDataMed = db::fetch_array($querySelectDataMed)){
	$temp['systemType'] 		= 'Mediate';
	$temp['prefixBlackCase'] 	= $recSelectDataMed['PREFIX_BLACK_CASE'];
	$temp['blackCase'] 			= $recSelectDataMed['BLACK_CASE'];
	$temp['blackYy'] 			= $recSelectDataMed['BLACK_YY'];
	$temp['prefixRedCase'] 		= $recSelectDataMed['PREFIX_RED_CASE'];
	$temp['redCase'] 			= $recSelectDataMed['RED_CASE'];
	$temp['redYy'] 				= $recSelectDataMed['RED_YY'];
	$temp['courtName'] 			= $recSelectDataMed['COURT_NAME'];
	$temp['registerCode'] 		= $recSelectDataMed['REGISTERCODE'];
	$temp['prefixName'] 		= $recSelectDataMed['PREFIX_NAME'];
	$temp['firstName'] 			= $recSelectDataMed['FIRST_NAME'];
	$temp['lastName'] 			= $recSelectDataMed['LAST_NAME'];
	$temp['fullName'] 			= $recSelectDataMed['PREFIX_NAME'].$v['FIRST_NAME']." ".$v['LAST_NAME'];
	$temp['personType'] 		= $recSelectDataMed['CONCERN_CODE'];
	$temp['concernName'] 		= $recSelectDataMed['CONCERN_NAME'];
	// $temp['address'] 			= $recSelectDataMed['ADDR'];
	// $temp['tumName'] 			= $recSelectDataMed['TUM_NAME'];
	// $temp['ampName'] 			= $recSelectDataMed['AMP_NAME'];
	// $temp['provName'] 			= $recSelectDataMed['PRV_NAME'];
	// $temp['zipCode'] 			= $recSelectDataMed['POSTCODE'];
	array_push($obj,$temp);
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