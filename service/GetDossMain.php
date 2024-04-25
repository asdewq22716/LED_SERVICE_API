<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);
$i=0;

$form_field['USERNAME'] 			= 'BankruptDt';// เปลี่ยนเป็นค่าที่จะส่ง
$form_field['PASSWORD'] 			= 'Debtor4321';// เปลี่ยนเป็นค่าที่จะส่ง

if($POST["prefixBlackCase"]!=""){
	$filter .= " and PREFIX_BLACK_CASE = '".$POST['prefixBlackCase']."'	";
}
if($POST["blackCase"]!=""){
	$filter .= " and BLACK_CASE = '".$POST['blackCase']."'	";
}
if($POST["blackYy"]!=""){
	$filter .= " and BLACK_YY = '".$POST['blackYy']."'	";
}
if($POST["prefixRedCase"]!=""){
	$filter .= " and PREFIX_RED_CASE = '".$POST['prefixRedCase']."'	";
}
if($POST["redCase"]!=""){
	$filter .= " and RED_CASE = '".$POST['redCase']."'	";
}
if($POST["redYy"]!=""){
	$filter .= " and RED_YY = '".$POST['redYy']."'	";
}
if($POST["CourtCode"]!=""){
	$filter .= " and COURT_CODE = '".$POST['CourtCode']."'	";
}
if($POST["courtName"]!=""){
	$filter .= " and COURT_NAME = '".$POST['courtName']."'	";
}


if($filter!=""){
	$sqlSelectData = "	select 		WH_CIVIL_CASE.WH_CIVIL_ID,WH_CIVIL_CASE.DEPT_NAME,REV_NO,REV_YEAR,COURT_CODE,COURT_NAME,DOSS_CONTROL_GEN,PCC_CASE_GEN,CIVIL_CODE,PREFIX_BLACK_CASE,BLACK_CASE,BLACK_YY,PREFIX_RED_CASE,RED_CASE,RED_YY,CASE_LAWS_CODE,CASE_LAWS_NAME,CAPITAL_AMOUNT,PLAINTIFF1,PLAINTIFF2,PLAINTIFF3,DEFFENDANT1,DEFFENDANT2,DEFFENDANT3,DOSS_CONTROL,DOSS_ID,DOSS_REV_NO,DOSS_REV_YEAR,DOSS_DEPT_CODE,DOSS_DEPT_NAME
						from 		WH_CIVIL_CASE
						left join 	WH_CIVIL_DOSS on WH_CIVIL_CASE.WH_CIVIL_ID = WH_CIVIL_DOSS.WH_CIVIL_ID
						where 		1=1 
									{$filter}"; 


	$querySelectData = db::query($sqlSelectData);
	while($dataSelectData = db::fetch_array($querySelectData)){
		$obj[$i]['PCC_CASE_GEN'] 			= $dataSelectData['PCC_CASE_GEN'];		
		$obj[$i]['SHR_CASE_GEN'] 			= $dataSelectData['SHR_CASE_GEN'];		
		$obj[$i]['PccDossControl'] 			= $dataSelectData['DOSS_CONTROL_GEN'];		
		$obj[$i]['PCC_DOSS_CONTROL_GEN'] 	= $dataSelectData['DOSS_CONTROL_GEN'];		
		$obj[$i]['CivilCode'] 				= $dataSelectData['CIVIL_CODE'];
		$obj[$i]['PrefixBlackCase'] 		= $dataSelectData['PREFIX_BLACK_CASE'];
		$obj[$i]['BlackCase'] 				= $dataSelectData['BLACK_CASE'];
		$obj[$i]['BlackYY'] 				= $dataSelectData['BLACK_YY'];
		$obj[$i]['PrefixRedCase'] 			= $dataSelectData['PREFIX_RED_CASE'];
		$obj[$i]['RedCase'] 				= $dataSelectData['RED_CASE'];
		$obj[$i]['RedYY'] 					= $dataSelectData['RED_YY'];
		$obj[$i]['CaseLawsCode'] 			= $dataSelectData['CASE_LAWS_CODE'];
		$obj[$i]['CaseLawsName'] 			= $dataSelectData['CASE_LAWS_NAME'];
		$obj[$i]['CapitalAmount'] 			= $dataSelectData['CAPITAL_AMOUNT'];
		$obj[$i]['Plaintiff1'] 				= $dataSelectData['PLAINTIFF1'];
		$obj[$i]['Plaintiff2'] 				= $dataSelectData['Plaintiff2'];
		$obj[$i]['Plaintiff3'] 				= $dataSelectData['PLAINTIFF3'];
		$obj[$i]['Deffendant1'] 			= $dataSelectData['DEFFENDANT1'];
		$obj[$i]['Deffendant2'] 			= $dataSelectData['DEFFENDANT2'];
		$obj[$i]['Deffendant3'] 			= $dataSelectData['DEFFENDANT3'];
		$obj[$i]['CourtName'] 				= $dataSelectData['COURT_NAME'];
		$obj[$i]['CourtCode'] 				= $dataSelectData['COURT_CODE'];
		$obj[$i]['DossControl'] 			= $dataSelectData['DOSS_CONTROL'];
		$obj[$i]['DOSS'] 					= $dataSelectData['DOSS_CONTROL'];
		$obj[$i]['WhCivilId'] 				= $dataSelectData['WH_CIVIL_ID'];
		$obj[$i]['dossId'] 					= $dataSelectData['DOSS_ID'];
		
		$obj[$i]['DeptName'] 				= $dataSelectData['DOSS_DEPT_NAME'];
		$obj[$i]['RecvNo'] 					= $dataSelectData['DOSS_REV_NO'];
		$obj[$i]['RecvYear'] 				= $dataSelectData['DOSS_REV_YEAR'];
	
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
