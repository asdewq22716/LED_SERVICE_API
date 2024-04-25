<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$res = json_decode($str_json, true);
$i=0;

$form_field['USERNAME'] 			= 'BankruptDt';// เปลี่ยนเป็นค่าที่จะส่ง
$form_field['PASSWORD'] 			= 'Debtor4321';// เปลี่ยนเป็นค่าที่จะส่ง
$form_field['PREFIX_BLACK_CASE'] 	= $res['PREFIX_BLACK_CASE'];// เปลี่ยนเป็นค่าที่จะส่ง
$form_field['BLACK_CASE'] 			= $res['BLACK_CASE'];
$form_field['BLACK_YY'] 			= $res['BLACK_YY'];
$form_field['PREFIX_RED_CASE'] 		= $res['PREFIX_RED_CASE'];
$form_field['RED_CASE'] 			= $res['RED_CASE'];
$form_field['RED_YY'] 				= $res['RED_YY'];
$form_field['COURT_CODE'] 			= $res['COURT_CODE'];

// $res['PREFIX_BLACK_CASE'] 	= "ผบ";
// $res['BLACK_CASE'] 			= "1853";
// $res['BLACK_YY'] 			= "2563";
// $res['PREFIX_RED_CASE'] 	= "ผบ";
// $res['RED_CASE'] 			= "3044";
// $res['RED_YY'] 				= "2563";
// $res['COURT_CODE'] 			= "204";
/*
$sqlSelectData = "	select 	COURT_CODE,COURT_NAME,PCC_CASE_GEN,CIVIL_CODE,PREFIX_BLACK_CASE,BLACK_CASE,BLACK_YY,PREFIX_RED_CASE,RED_CASE,RED_YY,CASE_LAWS_CODE,CASE_LAWS_NAME,CAPITAL_AMOUNT,PLAINTIFF1,PLAINTIFF2,PLAINTIFF3,DEFFENDANT1,DEFFENDANT2,DEFFENDANT3
					from 	WH_CIVIL_CASE
					where 	PREFIX_BLACK_CASE = '".$res['PREFIX_BLACK_CASE']."'
							and BLACK_CASE = '".$res['BLACK_CASE']."'
							and BLACK_YY = '".$res['BLACK_YY']."'
							and PREFIX_RED_CASE = '".$res['PREFIX_RED_CASE']."'
							and RED_CASE = '".$res['RED_CASE']."'
							and RED_YY = '".$res['RED_YY']."'
							and COURT_CODE = '".$res['COURT_CODE']."'"; 


$querySelectData = db::query($sqlSelectData);
while($dataSelectData = db::fetch_array($querySelectData)){
	$obj[$i]['PccDossControl'] 		= $dataSelectData['PCC_CASE_GEN'];
	$obj[$i]['CivilCode'] 			= $dataSelectData['CIVIL_CODE'];
	$obj[$i]['PrefixBlackCase'] 	= $dataSelectData['PREFIX_BLACK_CASE'];
	$obj[$i]['BlackCase'] 			= $dataSelectData['BLACK_CASE'];
	$obj[$i]['BlackYY'] 			= $dataSelectData['BLACK_YY'];
	$obj[$i]['PrefixRedCase'] 		= $dataSelectData['PREFIX_RED_CASE'];
	$obj[$i]['RedCase'] 			= $dataSelectData['RED_CASE'];
	$obj[$i]['RedYY'] 				= $dataSelectData['RED_YY'];
	$obj[$i]['CaseLawsCode'] 		= $dataSelectData['CASE_LAWS_CODE'];
	$obj[$i]['CaseLawsName'] 		= $dataSelectData['CASE_LAWS_NAME'];
	$obj[$i]['CapitalAmount'] 		= $dataSelectData['CAPITAL_AMOUNT'];
	$obj[$i]['Plaintiff1'] 			= $dataSelectData['PLAINTIFF1'];
	$obj[$i]['Plaintiff2'] 			= $dataSelectData['Plaintiff2'];
	$obj[$i]['Plaintiff3'] 			= $dataSelectData['PLAINTIFF3'];
	$obj[$i]['Deffendant1'] 		= $dataSelectData['DEFFENDANT1'];
	$obj[$i]['Deffendant2'] 		= $dataSelectData['DEFFENDANT2'];
	$obj[$i]['Deffendant3'] 		= $dataSelectData['DEFFENDANT3'];
	$obj[$i]['CourtName'] 			= $dataSelectData['COURT_NAME'];
	$obj[$i]['CourtCode'] 			= $dataSelectData['COURT_CODE'];

	$i++;
}


*/
$con = curl_init();
curl_setopt($con, CURLOPT_CONNECTTIMEOUT, 120);
curl_setopt($con, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.6 (KHTML, like Gecko) Chrome/16.0.897.0 Safari/535.6");
curl_setopt($con, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
curl_setopt($con, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($con, CURLOPT_HEADER, 0);
curl_setopt($con, CURLOPT_TIMEOUT, 120);

curl_setopt($con, CURLOPT_URL, connect_api_civil('civilCaseDetail2'));
curl_setopt($con, CURLOPT_POST, 1);

$data_string = json_encode($form_field);
curl_setopt($con, CURLOPT_POSTFIELDS, $data_string);
$data = curl_exec($con);
$data = json_decode($data, true);

print_r($data);    

	if($data['ResponseCode']['ResCode'] == '000'){

			$data2 = $data['Data'];
			foreach($data2 as $k => $v){

				$obj[$i]['PccDossControl'] = $v['PCC_DOSS_CONTROL_GEN'];
				$obj[$i]['CivilCode'] = $v['CivilCode'];
				$obj[$i]['PrefixBlackCase'] = $v['PrefixBlackCase'];
				$obj[$i]['BlackCase'] = $v['BlackCase'];
				$obj[$i]['BlackYY'] = $v['BlackYY'];
				$obj[$i]['PrefixRedCase'] = $v['PrefixRedCase'];
				$obj[$i]['RedCase'] = $v['RedCase'];
				$obj[$i]['RedYY'] = $v['RedYY'];
				$obj[$i]['CaseLawsCode'] = $v['CaseLawsCode'];
				$obj[$i]['CaseLawsName'] = $v['CaseLawsName'];
				$obj[$i]['CapitalAmount'] = $v['CapitalAmount'];
				$obj[$i]['Plaintiff1'] = $v['Plaintiff1'];
				$obj[$i]['Plaintiff2'] = $v['Plaintiff2'];
				$obj[$i]['Plaintiff3'] = $v['Plaintiff3'];
				$obj[$i]['Deffendant1'] = $v['Deffendant1'];
				$obj[$i]['Deffendant2'] = $v['Deffendant2'];
				$obj[$i]['Deffendant3'] = $v['Deffendant3'];

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
