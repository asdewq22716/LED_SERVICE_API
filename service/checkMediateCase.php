<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$res = json_decode($str_json, true);

$i=0;

if($POST['ip']){
	$ip = $POST['ip'];
}else{
	$ip = get_client_ip();
}
$field = array();
$field['IP_ADDRESS'] = $ip ;
$field['DEP_ID'] = $POST['depId'];
$field['REQUEST'] = 'checkMediateCase';
$field['LOG_DATE'] = date("Y-m-d");
$field['USR_ID'] = '' ;
$field['REQUEST_STATUS'] = '200';
$field['USR_IDCARD'] = $POST['idCard'];
$field['LOG_TYPE'] = '1' ;
$field['REQUEST_DATA'] = json_encode($res,JSON_UNESCAPED_UNICODE);

db::db_insert('M_LOG',$field,'LOG_ID');	


$form_field['USERNAME'] = 'BankruptDt';// เปลี่ยนเป็นค่าที่จะส่ง
$form_field['PASSWORD'] = 'Debtor4321';// เปลี่ยนเป็นค่าที่จะส่ง

$form_field['prefixBlackCase'] = $res['prefixBlackCase'];
$form_field['blackCase'] = $res['blackCase'];
$form_field['blackYY'] = $res['blackYY'];


$sqlSelecMed = "SELECT 	WH_MEDAITE_ID,
						PREFIX_RED_CASE,
						RED_CASE,
						RED_YY,
						PREFIX_BLACK_CASE,
						BLACK_CASE,
						BLACK_YY,
						REF_WFR_ID,
						CAPITAL_AMOUNT,
						REF_MEDIATE_ID,
						RECEIVE_DATE,
						COURT_ID,
						COURT_NAME,
						CHANNEL_ID,
						CHANNEL_NAME,
						TYPE_MEDIATE_ID,
						'' AS TYPE_MEDIATE_NAME
				FROM 	WH_MEDIATE_CASE A
				WHERE 	1=1 
						AND PREFIX_BLACK_CASE = '".$res['prefixBlackCase']."'
						AND BLACK_CASE = '".$res['blackCase']."' 
						AND BLACK_YY = '".$res['blackYY']."' ";
$querySelecMed = db::query($sqlSelecMed);
while($recSelecMed = db::fetch_array($querySelecMed)){
								
						/*A .REQ_PRE_NAME,
						A .REQ_FNAME,
						A .REQ_LNAME,
						
						REPLACE(A.PLAINTIFF_IDCARD,'-','') AS PLAINTIFF_IDCARD,
						A .PLAINTIFF_TYPE,
						A .PLAINTIFF_PRE_NAME,
						A .PLAINTIFF_FNAME,
						A .PLAINTIFF_LNAME,
						
						REPLACE(A.DEFENDANT_IDCARD,'-','') AS DEFENDANT_IDCARD,
						A .DEFENDANT_TYPE,
						A .DEFENDANT_PRE_NAME,
						A .DEFENDANT_FNAME,
						A .DEFENDANT_LNAME,*/
						
	
						
	$sqlSelectPlaintiff 	= "SELECT	PERSON_CODE,REGISTER_CODE,PREFIX_CODE,FIRST_NAME,LAST_NAME,PERSON_CODE
							   FROM 	WH_MEDIATE_PERSON
							   WHERE 	WH_MEDIATE_ID = '".$recSelecMed["WH_MEDAITE_ID"]."'
										AND CONCERN_CODE = '01' ";
	$querySelectPlaintiff 	= db::query($sqlSelectPlaintiff);
	$recSelectPlaintiff 	= db::fetch_array($querySelectPlaintiff);
	
	$sqlSelectDefendant 	= "SELECT	PERSON_CODE,REGISTER_CODE,PREFIX_CODE,FIRST_NAME,LAST_NAME,PERSON_CODE
							   FROM 	WH_MEDIATE_PERSON
							   WHERE 	WH_MEDIATE_ID = '".$recSelecMed["WH_MEDAITE_ID"]."'
										AND CONCERN_CODE = '02' ";
	$querySelectDefendant 	= db::query($sqlSelectDefendant);
	$recSelectDefendant 	= db::fetch_array($querySelectDefendant);
	
	$spp = "SELECT P_ID_LAW FROM M_PREFIX_MAP WHERE P_ID_MD = '".$recSelectPlaintiff['PREFIX_CODE']."'";
	$qpp = db::query($spp);
	$r1 = db::fetch_array($qpp);
	
	$sdp = "SELECT P_ID_LAW FROM M_PREFIX_MAP WHERE P_ID_MD = '".$recSelectDefendant['PREFIX_CODE']."'";
	$qdp = db::query($sdp);
	$r2 = db::fetch_array($qdp);
	
	$sdp = "SELECT PERSON_CODE_LAW FROM M_MAP_PER_TYPE WHERE PERSON_CODE_MD = '".$recSelectPlaintiff['PERSON_CODE']."'";
	$qdp = db::query($sdp);
	$r3 = db::fetch_array($qdp);
	
	$sdp = "SELECT PERSON_CODE_LAW FROM M_MAP_PER_TYPE WHERE PERSON_CODE_MD = '".$recSelectDefendant['PERSON_CODE']."'";
	$qdp = db::query($sdp);
	$r4 = db::fetch_array($qdp);
	
	
	$obj[$i]['PrefixBlackCase'] 	= 	$recSelecMed['PREFIX_BLACK_CASE'];
	$obj[$i]['BlackCase'] 			= 	$recSelecMed['BLACK_CASE'];
	$obj[$i]['BlackYY'] 			= 	$recSelecMed['BLACK_YY'];
	$obj[$i]['PrefixRedCase'] 		= 	$recSelecMed['PREFIX_RED_CASE'];
	$obj[$i]['RedCase'] 			= 	$recSelecMed['RED_CASE'];
	$obj[$i]['RedYY'] 				= 	$recSelecMed['RED_YY'];
	$obj[$i]['CourtCode'] 			= 	$recSelecMed['COURT_ID'];
	$obj[$i]['CourtName'] 			= 	$recSelecMed['COURT_NAME'];
	$obj[$i]['CapitalAmount'] 		= 	$recSelecMed['CAPITAL_AMOUNT'];
	$obj[$i]['PaymentHistory'] 		= 	$recSelecMed['PAYMENT_HISTORY'];
	$obj[$i]['MediateTypeId'] 		= 	$recSelecMed['TYPE_MEDIATE_ID'];
	$obj[$i]['MediateTypeName'] 	= 	$recSelecMed['TYPE_MEDIATE_NAME'];
	
	$obj[$i]['PlaintiffType'] 		= 	$r3['PERSON_CODE_LAW'];
	$obj[$i]['PlaintiffCardId'] 	= 	$recSelectPlaintiff['REGISTER_CODE'];
	$obj[$i]['PlaintiffPrefix'] 	= 	$r1['P_ID_LAW']; // โจทก์
	$obj[$i]['PlaintiffFname'] 		= 	$recSelectPlaintiff['FIRST_NAME']; // โจทก์
	$obj[$i]['PlaintiffLname'] 		= 	$recSelectPlaintiff['LAST_NAME']; // โจทก์
	
	$obj[$i]['DeffendantType'] 		= 	$r4['PERSON_CODE_LAW']; // จำเลย
	$obj[$i]['DeffendantCardId'] 	= 	$recSelectDefendant['REGISTER_CODE']; // จำเลย
	$obj[$i]['DeffendantPrefix'] 	= 	$r2['P_ID_LAW']; // จำเลย
	$obj[$i]['DeffendantFname'] 	= 	$recSelectDefendant['FIRST_NAME']; // จำเลย
	$obj[$i]['DeffendantLname'] 	= 	$recSelectDefendant['LAST_NAME']; // จำเลย
		
	$obj[$i]['MediateNo'] 			= 	$recSelecMed['REF_MEDIATE_ID'];
	$obj[$i]['ChannelId'] 			= 	$recSelecMed['CHANNEL_ID'];
	$obj[$i]['ChannelName'] 		= 	$recSelecMed['CHANNEL_NAME'];
										
						
}
				


/*
$data_string = json_encode($form_field);
	
$con = curl_init();
	curl_setopt($con, CURLOPT_CONNECTTIMEOUT, 120);
	curl_setopt($con, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.6 (KHTML, like Gecko) Chrome/16.0.897.0 Safari/535.6");
	curl_setopt($con, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($con, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($con, CURLOPT_HEADER, 0);
	curl_setopt($con, CURLOPT_TIMEOUT, 120);
	curl_setopt($con, CURLOPT_URL, connect_api_mediate('MediateCaseApi.php'));
	curl_setopt($con, CURLOPT_POST, 1);
	curl_setopt($con, CURLOPT_POSTFIELDS, $data_string);
$data = curl_exec($con);
$data = json_decode($data, true);

	if($data['ResponseCode']['ResCode'] == '000'){
			$data2 = $data['Data'];
			foreach($data2 as $k => $v){
				
				$spp = "SELECT P_ID_LAW FROM M_PREFIX_MAP WHERE P_ID_MD = '".$v['PLAINTIFF_PREFIX']."'";
				$qpp = db::query($spp);
				$r1 = db::fetch_array($qpp);
				
				$sdp = "SELECT P_ID_LAW FROM M_PREFIX_MAP WHERE P_ID_MD = '".$v['DEFENDANT_PREFIX']."'";
				$qdp = db::query($sdp);
				$r2 = db::fetch_array($qdp);
				
				$sdp = "SELECT PERSON_CODE_LAW FROM M_MAP_PER_TYPE WHERE PERSON_CODE_MD = '".$v['PLAINTIFF_TYPE']."'";
				$qdp = db::query($sdp);
				$r3 = db::fetch_array($qdp);
				
				$sdp = "SELECT PERSON_CODE_LAW FROM M_MAP_PER_TYPE WHERE PERSON_CODE_MD = '".$v['DEFENDANT_TYPE']."'";
				$qdp = db::query($sdp);
				$r4 = db::fetch_array($qdp);
				
				$obj[$i]['PrefixBlackCase'] = $v['PrefixBlackCase'];
				$obj[$i]['BlackCase'] = $v['BlackCase'];
				$obj[$i]['BlackYY'] = $v['BlackYY'];
				$obj[$i]['PrefixRedCase'] = $v['PrefixRedCase'];
				$obj[$i]['RedCase'] = $v['RedCase'];
				$obj[$i]['RedYY'] = $v['RedYY'];
				$obj[$i]['CourtCode'] = $v['COURT_ID'];
				$obj[$i]['CourtName'] = $v['COURT_NAME'];
				$obj[$i]['CapitalAmount'] = $v['CAPITAL_AMOUNT'];
				$obj[$i]['PaymentHistory'] = $v['PAYMENT_HISTORY'];
				$obj[$i]['MediateTypeId'] = $v['TYPE_MEDIATE_ID'];
				$obj[$i]['MediateTypeName'] = $v['TYPE_MEDIATE_NAME'];
				
				$obj[$i]['PlaintiffType'] 		= 	$r3['PERSON_CODE_LAW'];
				$obj[$i]['PlaintiffCardId'] 		= 	$v['PLAINTIFF_IDCARD'];
				$obj[$i]['PlaintiffPrefix'] 	= 	$r1['P_ID_LAW']; // โจทก์
				$obj[$i]['PlaintiffFname'] 		= 	$v['PLAINTIFF_FNAME']; // โจทก์
				$obj[$i]['PlaintiffLname'] 		= 	$v['PLAINTIFF_LNAME']; // โจทก์
				
				$obj[$i]['DeffendantType'] 		= 	$r4['PERSON_CODE_LAW']; // จำเลย
				$obj[$i]['DeffendantCardId'] 		= 	$v['DEFENDANT_IDCARD']; // จำเลย
				$obj[$i]['DeffendantPrefix'] 	= 	$r2['P_ID_LAW']; // จำเลย
				$obj[$i]['DeffendantFname'] 	= 	$v['DEFENDANT_FNAME']; // จำเลย
				$obj[$i]['DeffendantLname'] 	= 	$v['DEFENDANT_LNAME']; // จำเลย
				
				// $obj[$i]['Plaintiff1'] = $v['PLAINTIFF_FNAME'];
				// $obj[$i]['Deffendant1'] = $v['DEFENDANT_FNAME'];
				
				$obj[$i]['MediateNo'] = $v['REF_MEDIATE_ID'];
				$obj[$i]['ChannelId'] = $v['CHANNEL_ID'];
				$obj[$i]['ChannelName'] = $v['CHANNEL_NAME'];
			
				$i++;
				
				
			}
			

} 
*/


$num = count($obj);
	
	if($num > 0){

		$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");	
		$row['Data'] = $obj;
			
	}else{
			
		$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");	

	}

echo json_encode($row);

 ?>