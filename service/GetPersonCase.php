<?php
include '../include/include.php';


$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);


$filter = "";
if ($POST["registerCode"] != "") {
	$filter .= " and REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode']) . "'	";
}
if ($POST["prefixBlackCase"] != "") {
	$filter .= " and PREFIX_BLACK_CASE = '" . $POST['prefixBlackCase'] . "'	";
}
if ($POST["blackCase"] != "") {
	$filter .= " and BLACK_CASE = '" . $POST['blackCase'] . "'	";
}
if ($POST["blackYy"] != "") {
	$filter .= " and BLACK_YY = '" . $POST['blackYy'] . "'	";
}
if ($POST["prefixRedCase"] != "") {
	$filter .= " and PREFIX_RED_CASE = '" . $POST['prefixRedCase'] . "'	";
}
if ($POST["redCase"] != "") {
	$filter .= " and RED_CASE = '" . $POST['redCase'] . "'	";
}
if ($POST["redYy"] != "") {
	$filter .= " and RED_YY = '" . $POST['redYy'] . "'	";
}
if ($POST["CourtCode"] != "") {
	$filter .= " and COURT_CODE = '" . $POST['CourtCode'] . "'	";
}

$i = 1;

if ($filter != "") {
	if ($POST["systemType"] == 'Mediate') {
		$sqlSelectDataMed = "	select 		a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME
								from 		WH_MEDIATE_PERSON a
								where 		1=1	{$filter}
							";
		$querySelectDataMed = db::query($sqlSelectDataMed);
		while ($recSelectDataMed = db::fetch_array($querySelectDataMed)) {
			$obj[$i]['systemType'] 			= 'Mediate';
			$obj[$i]['prefixBlackCase'] 	= $recSelectDataMed['PREFIX_BLACK_CASE'];
			$obj[$i]['blackCase'] 			= $recSelectDataMed['BLACK_CASE'];
			$obj[$i]['blackYy'] 			= $recSelectDataMed['BLACK_YY'];
			$obj[$i]['prefixRedCase'] 		= $recSelectDataMed['PREFIX_RED_CASE'];
			$obj[$i]['redCase'] 			= $recSelectDataMed['RED_CASE'];
			$obj[$i]['redYy'] 				= $recSelectDataMed['RED_YY'];
			$obj[$i]['courtName'] 			= $recSelectDataMed['COURT_NAME'];
			$obj[$i]['registerCode'] 		= $recSelectDataMed['REGISTER_CODE'];
			$obj[$i]['prefixName'] 			= $recSelectDataMed['PREFIX_NAME'];
			$obj[$i]['firstName'] 			= $recSelectDataMed['FIRST_NAME'];
			$obj[$i]['lastName'] 			= $recSelectDataMed['LAST_NAME'];
			$obj[$i]['fullName'] 			= $recSelectDataMed['PREFIX_NAME'] . $recSelectDataMed['FIRST_NAME'] . " " . $recSelectDataMed['LAST_NAME'];
			$obj[$i]['personType'] 			= $recSelectDataMed['CONCERN_CODE'];
			$obj[$i]['concernName'] 		= $recSelectDataMed['CONCERN_NAME'];
			$obj[$i]['address'] 			= $recSelectDataMed['ADDRESS'];
			$obj[$i]['tumName'] 			= $recSelectDataMed['TUM_NAME'];
			$obj[$i]['ampName'] 			= $recSelectDataMed['AMP_NAME'];
			$obj[$i]['provName'] 			= $recSelectDataMed['PROV_NAME'];
			$obj[$i]['zipCode'] 			= $recSelectDataMed['ZIP_CODE'];
			$i++;
		}
	}

	if ($POST["systemType"] == 'Bankrupt') {
		$sqlSelectDataBank = "	select 		a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME
								from 		WH_BANKRUPT_CASE_PERSON a 
								where 		1=1	{$filter}
							";
		$querySelectDataBank = db::query($sqlSelectDataBank);
		while ($recSelectDataBank = db::fetch_array($querySelectDataBank)) {
			$obj[$i]['systemType'] 			= 'Bankrupt';
			$obj[$i]['prefixBlackCase'] 	= $recSelectDataBank['PREFIX_BLACK_CASE'];
			$obj[$i]['blackCase'] 			= $recSelectDataBank['BLACK_CASE'];
			$obj[$i]['blackYy'] 			= $recSelectDataBank['BLACK_YY'];
			$obj[$i]['prefixRedCase'] 		= $recSelectDataBank['PREFIX_RED_CASE'];
			$obj[$i]['redCase'] 			= $recSelectDataBank['RED_CASE'];
			$obj[$i]['redYy'] 				= $recSelectDataBank['RED_YY'];
			$obj[$i]['courtName'] 			= $recSelectDataBank['COURT_NAME'];
			$obj[$i]['registerCode'] 		= $recSelectDataBank['REGISTER_CODE'];
			$obj[$i]['prefixName'] 			= $recSelectDataBank['PREFIX_NAME'];
			$obj[$i]['firstName'] 			= $recSelectDataBank['FIRST_NAME'];
			$obj[$i]['lastName'] 			= $recSelectDataBank['LAST_NAME'];
			$obj[$i]['fullName'] 			= $recSelectDataBank['PREFIX_NAME'] . $recSelectDataBank['FIRST_NAME'] . " " . $recSelectDataBank['LAST_NAME'];
			$obj[$i]['personType'] 			= $recSelectDataBank['CONCERN_CODE'];
			$obj[$i]['concernName'] 		= $recSelectDataBank['CONCERN_NAME'];
			$obj[$i]['address'] 			= $recSelectDataBank['ADDRESS'];
			$obj[$i]['tumName'] 			= $recSelectDataBank['TUM_NAME'];
			$obj[$i]['ampName'] 			= $recSelectDataBank['AMP_NAME'];
			$obj[$i]['provName'] 			= $recSelectDataBank['PROV_NAME'];
			$obj[$i]['zipCode'] 			= $recSelectDataBank['ZIP_CODE'];
			$i++;
		}
	}

	if ($POST["systemType"] == 'Revive') {
		$sqlSelectDataReh = "	select 		a.REGISTER_CODE,PERSON_TYPE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME
								from 		WH_REHABILITATION_PERSON a
								where 		1=1	{$filter}
							";
		$querySelectDataReh = db::query($sqlSelectDataReh);
		while ($recSelectDataReh = db::fetch_array($querySelectDataReh)) {
			$obj[$i]['systemType'] 			= 'Revive';
			$obj[$i]['prefixBlackCase'] 	= $recSelectDataReh['PREFIX_BLACK_CASE'];
			$obj[$i]['blackCase'] 			= $recSelectDataReh['BLACK_CASE'];
			$obj[$i]['blackYy'] 			= $recSelectDataReh['BLACK_YY'];
			$obj[$i]['prefixRedCase'] 		= $recSelectDataReh['PREFIX_RED_CASE'];
			$obj[$i]['redCase'] 			= $recSelectDataReh['RED_CASE'];
			$obj[$i]['redYy'] 				= $recSelectDataReh['RED_YY'];
			$obj[$i]['courtName'] 			= $recSelectDataReh['COURT_NAME'];
			$obj[$i]['registerCode'] 		= $recSelectDataReh['REGISTER_CODE'];
			$obj[$i]['prefixName'] 			= $recSelectDataReh['PREFIX_NAME'];
			$obj[$i]['firstName'] 			= $recSelectDataReh['FIRST_NAME'];
			$obj[$i]['lastName'] 			= $recSelectDataReh['LAST_NAME'];
			$obj[$i]['fullName'] 			= $recSelectDataReh['PREFIX_NAME'] . $recSelectDataReh['FIRST_NAME'] . " " . $recSelectDataReh['LAST_NAME'];
			$obj[$i]['concernCode'] 		= $recSelectDataReh['CONCERN_CODE'];
			$obj[$i]['concernName'] 		= $recSelectDataReh['CONCERN_NAME'];
			$obj[$i]['address'] 			= $recSelectDataReh['ADDRESS'];
			$obj[$i]['tumName'] 			= $recSelectDataReh['TUM_NAME'];
			$obj[$i]['ampName'] 			= $recSelectDataReh['AMP_NAME'];
			$obj[$i]['provName'] 			= $recSelectDataReh['PROV_NAME'];
			$obj[$i]['zipCode'] 			= $recSelectDataReh['ZIP_CODE'];
			$obj[$i]['personType'] 			= $recSelectDataReh['PERSON_TYPE'];
			$i++;
		}
	}

	if ($POST["systemType"] == 'Civil') {
		$sqlSelectDataCivil = "	select 		a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,MOO,SOI,ROAD,ADDRESS,TUM_NAME,PROV_NAME,ZIP_CODE,AMP_NAME,PERSON_TYPE,CONCERN_NO
								from 		" . Convert::ConvertTable('WH_CIVIL_CASE_PERSON') . " a
								where 		1=1 and CONCERN_CODE in ('01','02')	{$filter}	
							";
		$querySelectDataCivil = db::query($sqlSelectDataCivil);
		while ($recSelectDataCivil = db::fetch_array($querySelectDataCivil)) {
			$obj[$i]['systemType'] 			= 'Civil';
			$obj[$i]['prefixBlackCase'] 	= $recSelectDataCivil['PREFIX_BLACK_CASE'];
			$obj[$i]['blackCase'] 			= $recSelectDataCivil['BLACK_CASE'];
			$obj[$i]['blackYy'] 			= $recSelectDataCivil['BLACK_YY'];
			$obj[$i]['prefixRedCase'] 		= $recSelectDataCivil['PREFIX_RED_CASE'];
			$obj[$i]['redCase'] 			= $recSelectDataCivil['RED_CASE'];
			$obj[$i]['redYy'] 				= $recSelectDataCivil['RED_YY'];
			$obj[$i]['courtName'] 			= $recSelectDataCivil['COURT_NAME'];
			$obj[$i]['registerCode'] 		= $recSelectDataCivil['REGISTER_CODE'];
			$obj[$i]['prefixName'] 			= $recSelectDataCivil['PREFIX_NAME'];
			$obj[$i]['firstName'] 			= $recSelectDataCivil['FIRST_NAME'];
			$obj[$i]['lastName'] 			= $recSelectDataCivil['LAST_NAME'];
			$obj[$i]['fullName'] 			= $recSelectDataCivil['PREFIX_NAME'] . $recSelectDataCivil['FIRST_NAME'] . " " . $recSelectDataCivil['LAST_NAME'];
			$obj[$i]['personType'] 			= $recSelectDataCivil['PERSON_TYPE'];
			$obj[$i]['concernName'] 		= $recSelectDataCivil['CONCERN_NAME'];
			$obj[$i]['address'] 			= $recSelectDataCivil['ADDRESS'];
			$obj[$i]['tumName'] 			= $recSelectDataCivil['TUM_NAME'];
			$obj[$i]['ampName'] 			= $recSelectDataCivil['AMP_NAME'];
			$obj[$i]['provName'] 			= $recSelectDataCivil['PROV_NAME'];
			$obj[$i]['zipCode'] 			= $recSelectDataCivil['ZIP_CODE'];
			$obj[$i]['moo'] 				= $recSelectDataCivil['MOO'];
			$obj[$i]['soi'] 				= $recSelectDataCivil['SOI'];
			$obj[$i]['road'] 				= $recSelectDataCivil['ROAD'];

			$obj[$i]['CONCERN_NO'] 				= $recSelectDataCivil['CONCERN_NO'];
			
			$i++;
		}
	}
}
$num = count($obj);

if ($num > 0) {

	$row['ResponseCode'] = array('ResCode' => '000', 'ResMeassage' => "SUCCESS");
	$row['Data'] = $obj;
} else {

	$row['ResponseCode'] = array('ResCode' => '102', 'ResMeassage' => "NOT FOUND");
}
// close current handler
curl_multi_close($mh);

echo json_encode($row);
