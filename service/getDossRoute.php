<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);
$i = 0;

$form_field['USERNAME'] 			= 'BankruptDt'; // เปลี่ยนเป็นค่าที่จะส่ง
$form_field['PASSWORD'] 			= 'Debtor4321'; // เปลี่ยนเป็นค่าที่จะส่ง

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
if ($POST["WhCivilId"] != "") {
	$filter .= " and WH_CIVIL_ROUTE.WH_CIVIL_ID = '" . $POST['WhCivilId'] . "'	";
}
if ($POST["WhCivilId"] != "") {
	//$filter .= " and WH_CIVIL_ROUTE.WH_CIVIL_ID = '".$POST['WhCivilId']."'	";
}
if ($POST["dossId"] != "") {
	$filter .= " and WH_CIVIL_ROUTE.DOSS_ID = '" . $POST['dossId'] . "'	";
}
if ($POST["PccDossControl"] != "") {
	$filter .= " and WH_CIVIL_ROUTE.DOSS_CONTROL_GEN = '" . $POST['PccDossControl'] . "'	";
}
if ($POST["pccDossControl"] != "") {
	$filter .= " and WH_CIVIL_ROUTE.DOSS_CONTROL_GEN = '" . $POST['pccDossControl'] . "'	";
}


if ($filter != "") {


	$sqlSelectData = "	SELECT 		CREATE_DATE,ACT_DESC
						FROM 		WH_CIVIL_ROUTE 
						WHERE 		1=1 {$filter}
						ORDER BY 	CREATE_DATE ASC,ROUTE_GEN asc";


	$querySelectData = db::query($sqlSelectData);
	while ($dataSelectData = db::fetch_array($querySelectData)) {
		$CREATE_DATE = explode('-', $dataSelectData["CREATE_DATE"]);
		//$obj[$i]['createDate'] 		= $CREATE_DATE[2]."/".$CREATE_DATE[1]."/".$CREATE_DATE[0];	
		$obj[$i]['createDate'] 		= date("Y-m-d", strtotime($dataSelectData["CREATE_DATE"]));
		$obj[$i]['detail'] 			= $dataSelectData['ACT_DESC'];
		$i++;
	}
}
$num = count($obj);

if ($num > 0) {

	$row['ResponseCode'] = array('ResCode' => '000', 'ResMeassage' => "SUCCESS");
	$row['Data'] = $obj;

	$data = $row;
} else {

	$row['ResponseCode'] = array('ResCode' => '102', 'ResMeassage' => "NOT FOUND");
	$data = $row;
}

echo json_encode($data);
