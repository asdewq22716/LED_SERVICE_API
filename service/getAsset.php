<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);
$i=0;

$form_field['USERNAME'] 			= 'BankruptDt';// เปลี่ยนเป็นค่าที่จะส่ง
$form_field['PASSWORD'] 			= 'Debtor4321';// เปลี่ยนเป็นค่าที่จะส่ง


if($POST["prefixBlackCase"]!=""){
	$filter .= " and ASSET_PREFIX_BLACK_CASE = '".$POST['prefixBlackCase']."'	";
}
if($POST["blackCase"]!=""){
	$filter .= " and ASSET_BLACK_CASE = '".$POST['blackCase']."'	";
}
if($POST["blackYy"]!=""){
	$filter .= " and ASSET_PBLACK_YY = '".$POST['blackYy']."'	";
}
if($POST["prefixRedCase"]!=""){
	$filter .= " and ASSET_PREFIX_RED_CASE = '".$POST['prefixRedCase']."'	";
}
if($POST["redCase"]!=""){
	$filter .= " and ASSET_RED_CASE = '".$POST['redCase']."'	";
}
if($POST["redYy"]!=""){
	$filter .= " and ASSET_RED_YY = '".$POST['redYy']."'	";
}
if($POST["courtCode"]!=""){
	$filter .= " and ASSET_COURT_CODE = '".$POST['courtCode']."'	";
}

if($POST["WhCivilId"]!=""){
	//$filter .= " and WH_CIVIL_CASE_ASSETS.WH_CIVIL_ID = '".$POST['WhCivilId']."'	";
}

//$filter = "and rownum < 2";

########################################################################################## -- แพ่ง --############################################################################################################
//ที่ดิน
$sqlSelectData = "	select 	* 
					from 	WH_CIVIL_CASE_ASSETS_LAND
					where 	rownum < 1"; 
$arrFieldsLand = db::query_field($sqlSelectData);

$sqlSelectData = "	select 	* 
					from 	WH_CIVIL_CASE_ASSETS_LAND
					where 	1=1 {$filter}"; 


$querySelectData = db::query($sqlSelectData);
while($dataSelectData = db::fetch_array($querySelectData)){
	foreach($arrFieldsLand as $key => $val){
		$obj["civ"]["land"][$i][underToCamel($val)] = $dataSelectData[$val];
	}
	$i++;
}

//สิ่งปลูกสร้าง
$sqlSelectData = "	select 	* 
					from 	WH_CIVIL_CASE_ASSETS_BUILDING
					where 	rownum < 1"; 
$arrFieldsBuilding = db::query_field($sqlSelectData);

$sqlSelectDataBuilding = "	select 	* 
							from 	WH_CIVIL_CASE_ASSETS_BUILDING
							where 	1=1 {$filter}"; 


$querySelectDataBuilding = db::query($sqlSelectDataBuilding);
while($dataSelectDataBuilding = db::fetch_array($querySelectDataBuilding)){
	foreach($arrFieldsBuilding as $key => $val){
		$obj["civ"]["building"][$i][underToCamel($val)] = $dataSelectDataBuilding[$val];
	}
	$i++;
}

//ห้องชุด
$sqlSelectDataCondo = "	select 	* 
						from 	WH_CIVIL_CASE_ASSETS_CONDO
						where 	rownum < 1"; 
$arrFieldsCondo = db::query_field($sqlSelectDataCondo);

$sqlSelectDataCondo = "	select 	* 
						from 	WH_CIVIL_CASE_ASSETS_CONDO
						where 	1=1 {$filter}"; 


$querySelectDataCondo = db::query($sqlSelectDataCondo);
while($dataSelectDataCondo = db::fetch_array($querySelectDataCondo)){
	foreach($arrFieldsCondo as $key => $val){
		$obj["civ"]["condo"][$i][underToCamel($val)] = $dataSelectDataCondo[$val];
	}
	$i++;
}

//เครื่องจักร
$sqlSelectDataMachine = "	select 	* 
							from 	WH_CIVIL_CASE_ASSETS_MACHINE
							where 	rownum < 1"; 
$arrFieldsMachine = db::query_field($sqlSelectDataMachine);

$sqlSelectDataMachine = "	select 	* 
							from 	WH_CIVIL_CASE_ASSETS_MACHINE
							where 	1=1 {$filter}"; 
$querySelectDataMachine = db::query($sqlSelectDataMachine);
while($dataSelectDataMachine = db::fetch_array($querySelectDataMachine)){
	foreach($arrFieldsMachine as $key => $val){
		$obj["civ"]["machine"][$i][underToCamel($val)] = $dataSelectDataMachine[$val];
	}
	$i++;
}

//พันธบัตร
$sqlSelectDataBond = "	select 	* 
							from 	WH_CIVIL_CASE_ASSETS_BOND
							where 	rownum < 1"; 
$arrFieldsBond = db::query_field($sqlSelectDataBond);

$sqlSelectDataBond = "	select 	* 
							from 	WH_CIVIL_CASE_ASSETS_BOND
							where 	1=1 {$filter}"; 
$querySelectDataBond = db::query($sqlSelectDataBond);
while($dataSelectDataBond = db::fetch_array($querySelectDataBond)){
	foreach($arrFieldsBond as $key => $val){
		$obj["civ"]["bond"][$i][underToCamel($val)] = $dataSelectDataBond[$val];
	}
	$i++;
}

//สลากออมทรัพย์
$sqlSelectDataLottery = "	select 	* 
							from 	WH_CIVIL_CASE_ASSETS_LOTTERY
							where 	rownum < 1"; 
$arrFieldsLottery = db::query_field($sqlSelectDataLottery);

$sqlSelectDataLottery = "	select 	* 
							from 	WH_CIVIL_CASE_ASSETS_LOTTERY
							where 	1=1 {$filter}"; 
$querySelectDataBond = db::query($sqlSelectDataLottery);
while($dataSelectDataLottery = db::fetch_array($querySelectDataBond)){
	foreach($arrFieldsLottery as $key => $val){
		$obj["civ"]["lottery"][$i][underToCamel($val)] = $dataSelectDataLottery[$val];
	}
	$i++;
}

//อาวุธปืน
$sqlSelectDataGun = "	select 	* 
						from 	WH_CIVIL_CASE_ASSETS_GUN
						where 	rownum < 1"; 
$arrFieldsGun = db::query_field($sqlSelectDataGun);

$sqlSelectDataGun = "	select 	* 
							from 	WH_CIVIL_CASE_ASSETS_GUN
							where 	1=1 {$filter}"; 
$querySelectDataGun = db::query($sqlSelectDataGun);
while($dataSelectDataGun = db::fetch_array($querySelectDataGun)){
	foreach($arrFieldsGun as $key => $val){
		$obj["civ"]["gun"][$i][underToCamel($val)] = $dataSelectDataGun[$val];
	}
	$i++;
}

//รถยนต์
$sqlSelectDataCar = "	select 	* 
						from 	WH_CIVIL_CASE_ASSETS_CAR
						where 	rownum < 1"; 
$arrFieldsCar = db::query_field($sqlSelectDataCar);

$sqlSelectDataCar = "	select 	* 
						from 	WH_CIVIL_CASE_ASSETS_CAR
						where 	1=1 {$filter}"; 
$querySelectDataCar = db::query($sqlSelectDataCar);
while($dataSelectDataCar = db::fetch_array($querySelectDataCar)){
	foreach($arrFieldsCar as $key => $val){
		$obj["civ"]["car"][$i][underToCamel($val)] = $dataSelectDataCar[$val];
	}
	$i++;
}

//หุ้น
$sqlSelectDataStock = "	select 	* 
						from 	WH_CIVIL_CASE_ASSETS_STOCK
						where 	rownum < 1"; 
$arrFieldsStock = db::query_field($sqlSelectDataStock);

$sqlSelectDataStock = "	select 	* 
						from 	WH_CIVIL_CASE_ASSETS_STOCK
						where 	1=1 {$filter}"; 
$querySelectDataStock = db::query($sqlSelectDataStock);
while($dataSelectDataStock = db::fetch_array($querySelectDataStock)){
	foreach($arrFieldsStock as $key => $val){
		$obj["civ"]["stock"][$i][underToCamel($val)] = $dataSelectDataStock[$val];
	}
	$i++;
}

//กองทุน
$sqlSelectDataFund = "	select 	* 
						from 	WH_CIVIL_CASE_ASSETS_FUND
						where 	rownum < 1"; 
$arrFieldsFund = db::query_field($sqlSelectDataFund);

$sqlSelectDataFund = "	select 	* 
						from 	WH_CIVIL_CASE_ASSETS_FUND
						where 	1=1 {$filter}"; 
$querySelectDataFund = db::query($sqlSelectDataFund);
while($dataSelectDataFund = db::fetch_array($querySelectDataFund)){
	foreach($arrFieldsFund as $key => $val){
		$obj["civ"]["fund"][$i][underToCamel($val)] = $dataSelectDataFund[$val];
	}
	$i++;
}

//สิทธิการเช่า
$sqlSelectDataRent = "	select 	* 
						from 	WH_CIVIL_CASE_ASSETS_BUIL_RENT
						where 	rownum < 1"; 
$arrFieldsRent = db::query_field($sqlSelectDataRent);

$sqlSelectDataRent = "	select 	* 
						from 	WH_CIVIL_CASE_ASSETS_BUIL_RENT
						where 	1=1 {$filter}"; 
$querySelectDataRent = db::query($sqlSelectDataRent);
while($dataSelectDataRent = db::fetch_array($querySelectDataRent)){
	foreach($arrFieldsRent as $key => $val){
		$obj["civ"]["rent"][$i][underToCamel($val)] = $dataSelectDataRent[$val];
	}
	$i++;
}

//ทรัพย์สินต่างๆ
$sqlSelectDataOther = "	select 	* 
						from 	WH_CIVIL_CASE_ASSETS_OTHER
						where 	rownum < 1"; 
$arrFieldsOther = db::query_field($sqlSelectDataOther);

$sqlSelectDataOther = "	select 	* 
						from 	WH_CIVIL_CASE_ASSETS_OTHER
						where 	1=1 {$filter}"; 
$querySelectDataOther = db::query($sqlSelectDataOther);
while($dataSelectDataOther = db::fetch_array($querySelectDataOther)){
	foreach($arrFieldsOther as $key => $val){
		$obj["civ"]["other"][$i][underToCamel($val)] = $dataSelectDataOther[$val];
	}
	$i++;
}

//เรือ
$sqlSelectDataBoat = "	select 	* 
						from 	WH_CIVIL_CASE_ASSETS_BOAT
						where 	rownum < 1"; 
$arrFieldsBoat = db::query_field($sqlSelectDataBoat);

$sqlSelectDataBoat = "	select 	* 
						from 	WH_CIVIL_CASE_ASSETS_BOAT
						where 	1=1 {$filter}"; 
$querySelectDataBoat = db::query($sqlSelectDataBoat);
while($dataSelectDataBoat = db::fetch_array($querySelectDataBoat)){
	foreach($arrFieldsBoat as $key => $val){
		$obj["civ"]["boat"][$i][underToCamel($val)] = $dataSelectDataBoat[$val];
	}
	$i++;
}

########################################################################################## -- แพ่ง --############################################################################################################


//unset($obj);

######################################################################################## -- ล้มละลาย --##########################################################################################################
//ที่ดิน (ล้มละลาย)
$sqlSelectDataLand2 = "	select 	* 
						from 	WH_BANKRUPT_ASSETS_LAND
						where 	rownum < 1"; 
$arrFieldsLand2 = db::query_field($sqlSelectDataLand2);

$sqlSelectDataLand2 = "	select 	* 
						from 	WH_BANKRUPT_ASSETS_LAND
						where 	1=1 {$filter}"; 
$querySelectDataLand2 = db::query($sqlSelectDataLand2);
while($dataSelectDataLand2 = db::fetch_array($querySelectDataLand2)){
	foreach($arrFieldsLand2 as $key => $val){
		$obj["ban"]["land"][$i][underToCamel($val)] = $dataSelectDataLand2[$val];
	}
	$sqlSelectDataLand2Sub = "	select 	PROP_TITLE, PROP_STATUS_NAME
								from 	WH_BANKRUPT_ASSETS
								where	WH_ASSET_ID = '".$dataSelectDataLand2["WH_ASSET_ID"]."'";
	$querySelectDataLand2Sub = db::query($sqlSelectDataLand2Sub);
	while($dataSelectDataLand2Sub = db::fetch_array($querySelectDataLand2Sub)){
		$obj["ban"]["land"][$i][underToCamel("PROP_TITLE")] 		= $dataSelectDataLand2Sub["PROP_TITLE"];
		$obj["ban"]["land"][$i][underToCamel("PROP_STATUS_NAME")] 	= $dataSelectDataLand2Sub["PROP_STATUS_NAME"];
	}
	$obj["ban"]["land"][$i][underToCamel("ASSET_TYPE_NAME")] 	= 'ที่ดิน';
	$i++;
}

//สิ่งปลูกสร้าง (ล้มละลาย)
$sqlSelectDataBuilding2 = "	select 	* 
							from 	WH_BANKRUPT_ASSETS_BUILDING
							where 	rownum < 1"; 
$arrFieldsBuilding2 = db::query_field($sqlSelectDataBuilding2);

$sqlSelectDataBuilding2 = "	select 	* 
							from 	WH_BANKRUPT_ASSETS_BUILDING
							where 	1=1 {$filter}"; 
$querySelectDataBuilding2 = db::query($sqlSelectDataBuilding2);
while($dataSelectDataBuilding2 = db::fetch_array($querySelectDataBuilding2)){
	foreach($arrFieldsBuilding2 as $key => $val){
		$obj["ban"]["building"][$i][underToCamel($val)] = $dataSelectDataBuilding2[$val];
	}
	$i++;
}


//ห้องชุด (ล้มละลาย)
$sqlSelectDataCondo2 = "	select 	* 
							from 	WH_BANKRUPT_ASSETS_CONDO
							where 	rownum < 1"; 
$arrFieldsCondo2 = db::query_field($sqlSelectDataCondo2);

$sqlSelectDataCondo2 = "	select 	* 
							from 	WH_BANKRUPT_ASSETS_CONDO
							where 	1=1 {$filter}"; 
$querySelectDataCondo2 = db::query($sqlSelectDataCondo2);
while($dataSelectDataCondo2 = db::fetch_array($querySelectDataCondo2)){
	foreach($arrFieldsCondo2 as $key => $val){
		$obj["ban"]["condo"][$i][underToCamel($val)] = $dataSelectDataCondo2[$val];
	}
	$i++;
}

//เครื่องจักร (ล้มละลาย)
$sqlSelectDataMachine2 = "	select 	* 
							from 	WH_BANKRUPT_ASSETS_MACHINERY
							where 	rownum < 1"; 
$arrFieldsMachine2 = db::query_field($sqlSelectDataMachine2);

$sqlSelectDataMachine2 = "	select 	* 
							from 	WH_BANKRUPT_ASSETS_MACHINERY
							where 	1=1 {$filter}"; 
$querySelectDataMachine2 = db::query($sqlSelectDataMachine2);
while($dataSelectDataMachine2 = db::fetch_array($querySelectDataMachine2)){
	foreach($arrFieldsMachine2 as $key => $val){
		$obj["ban"]["machine"][$i][underToCamel($val)] = $dataSelectDataMachine2[$val];
	}
	$i++;
}

//พันธบัตร (ล้มละลาย)
$sqlSelectDataBond2 = "	select 	* 
						from 	WH_BANKRUPT_ASSETS_BOND
						where 	rownum < 1"; 
$arrFieldsBond2 = db::query_field($sqlSelectDataBond2);

$sqlSelectDataBond2 = "	select 	* 
						from 	WH_BANKRUPT_ASSETS_BOND
						where 	1=1 {$filter}"; 
$querySelectDataBond2 = db::query($sqlSelectDataBond2);
while($dataSelectDataBond2 = db::fetch_array($querySelectDataBond2)){
	foreach($arrFieldsBond2 as $key => $val){
		$obj["ban"]["bond"][$i][underToCamel($val)] = $dataSelectDataBond2[$val];
	}
	$i++;
}

//สลากออมทรัพย์ (ล้มละลาย)
$sqlSelectDataLottery2 = "	select 	* 
							from 	WH_BANKRUPT_ASSETS_LOTTERY
							where 	rownum < 1"; 
$arrFieldsLottery2 = db::query_field($sqlSelectDataLottery2);

$sqlSelectDataLottery2 = "	select 	* 
							from 	WH_BANKRUPT_ASSETS_LOTTERY
							where 	1=1 {$filter}"; 
$querySelectDataLottery2 = db::query($sqlSelectDataLottery2);
while($dataSelectDataLottery2 = db::fetch_array($querySelectDataLottery2)){
	foreach($arrFieldsLottery2 as $key => $val){
		$obj["ban"]["lottery"][$i][underToCamel($val)] = $dataSelectDataLottery2[$val];
	}
	$i++;
}

//อาวุธปืน (ล้มละลาย)
$sqlSelectDataGun2 = "	select 	* 
						from 	WH_BANKRUPT_ASSETS_FIREARM
						where 	rownum < 1"; 
$arrFieldsGun2 = db::query_field($sqlSelectDataGun2);

$sqlSelectDataGun2 = "	select 	* 
						from 	WH_BANKRUPT_ASSETS_FIREARM
						where 	1=1 {$filter}"; 
$querySelectDataGun2 = db::query($sqlSelectDataGun2);
while($dataSelectDataGun2 = db::fetch_array($querySelectDataGun2)){
	foreach($arrFieldsGun2 as $key => $val){
		$obj["ban"]["lottery"][$i][underToCamel($val)] = $dataSelectDataGun2[$val];
	}
	$i++;
}


//รถยนต์ (ล้มละลาย)
$sqlSelectDataCar2 = "	select 	* 
						from 	WH_BANKRUPT_ASSETS_CAR
						where 	rownum < 1"; 
$arrFieldsCar2 = db::query_field($sqlSelectDataCar2);

$sqlSelectDataCar2 = "	select 	* 
						from 	WH_BANKRUPT_ASSETS_CAR
						where 	1=1 {$filter}"; 
$querySelectDataCar2 = db::query($sqlSelectDataCar2);
while($dataSelectDataCar2 = db::fetch_array($querySelectDataCar2)){
	foreach($arrFieldsCar2 as $key => $val){
		$obj["ban"]["car"][$i][underToCamel($val)] = $dataSelectDataCar2[$val];
	}
	$i++;
}

//หุ้น (ล้มละลาย)
$sqlSelectDataStock2 = "	select 	* 
							from 	WH_BANKRUPT_ASSETS_STOCK
							where 	rownum < 1"; 
$arrFieldsStock2 = db::query_field($sqlSelectDataStock2);

$sqlSelectDataStock2 = "	select 	* 
							from 	WH_BANKRUPT_ASSETS_STOCK
							where 	1=1 {$filter}"; 
$querySelectDataStock2 = db::query($sqlSelectDataStock2);
while($dataSelectDataStock2 = db::fetch_array($querySelectDataStock2)){
	foreach($arrFieldsStock2 as $key => $val){
		$obj["ban"]["stock"][$i][underToCamel($val)] = $dataSelectDataStock2[$val];
	}
	$i++;
}

//สิทธิการเช่า (ล้มละลาย)
$sqlSelectDataRent2 = "	select 	* 
						from 	WH_BANKRUPT_ASSETS_RENT_RIGHT
						where 	rownum < 1"; 
$arrFieldsRent2 = db::query_field($sqlSelectDataRent2);

$sqlSelectDataRent2 = "	select 	* 
						from 	WH_BANKRUPT_ASSETS_RENT_RIGHT
						where 	1=1 {$filter}"; 
$querySelectDataRent2 = db::query($sqlSelectDataRent2);
while($dataSelectDataRent2 = db::fetch_array($querySelectDataRent2)){
	foreach($arrFieldsRent2 as $key => $val){
		$obj["ban"]["rent"][$i][underToCamel($val)] = $dataSelectDataRent2[$val];
	}
	$i++;
}

//กองทุน (ล้มละลาย)
$sqlSelectDataFund2 = "	select 	* 
						from 	WH_BANKRUPT_ASSETS_FUND
						where 	rownum < 1"; 
$arrFieldsFund2 = db::query_field($sqlSelectDataFund2);

$sqlSelectDataFund2 = "	select 	* 
						from 	WH_BANKRUPT_ASSETS_FUND
						where 	1=1 {$filter}"; 
$querySelectDataFund2 = db::query($sqlSelectDataFund2);
while($dataSelectDataFund2 = db::fetch_array($querySelectDataFund2)){
	foreach($arrFieldsFund2 as $key => $val){
		$obj["ban"]["fund"][$i][underToCamel($val)] = $dataSelectDataFund2[$val];
	}
	$i++;
}

//กรมธรรม์ (ล้มละลาย)
$sqlSelectDataInsurance = "	select 	* 
							from 	WH_BANKRUPT_ASSETS_INSURANCE
							where 	rownum < 1"; 
$arrFieldsInsurance = db::query_field($sqlSelectDataInsurance);

$sqlSelectDataInsurance = "	select 	* 
						from 	WH_BANKRUPT_ASSETS_INSURANCE
						where 	1=1 {$filter}"; 
$querySelectDataInsurance = db::query($sqlSelectDataInsurance);
while($dataSelectDataInsurance = db::fetch_array($querySelectDataInsurance)){
	foreach($arrFieldsInsurance as $key => $val){
		$obj["ban"]["insurance"][$i][underToCamel($val)] = $dataSelectDataInsurance[$val];
	}
	$i++;
}

//ข้อมูลเงิน (ล้มละลาย)
$sqlSelectDataIncome = "	select 	* 
							from 	WH_BANKRUPT_ASSETS_INCOME
							where 	rownum < 1"; 
$arrFieldsIncome = db::query_field($sqlSelectDataIncome);

$sqlSelectDataIncome = "	select 	* 
							from 	WH_BANKRUPT_ASSETS_INCOME
							where 	1=1 {$filter}"; 
$querySelectDataIncome = db::query($sqlSelectDataIncome);
while($dataSelectDataIncome = db::fetch_array($querySelectDataIncome)){
	foreach($arrFieldsIncome as $key => $val){
		$obj["ban"]["income"][$i][underToCamel($val)] = $dataSelectDataIncome[$val];
	}
	$i++;
}

//ทรัพย์สินต่างๆ (ล้มละลาย)
$sqlSelectDataOther2 = "	select 	* 
							from 	WH_BANKRUPT_ASSETS_OTHER
							where 	rownum < 1"; 
$arrFieldsOther2 = db::query_field($sqlSelectDataOther2);

$sqlSelectDataOther2 = "	select 	* 
							from 	WH_BANKRUPT_ASSETS_OTHER
							where 	1=1 {$filter}"; 
$querySelectDataOther2 = db::query($sqlSelectDataOther2);
while($dataSelectDataOther2 = db::fetch_array($querySelectDataOther2)){
	foreach($arrFieldsOther2 as $key => $val){
		$obj["ban"]["other"][$i][underToCamel($val)] = $dataSelectDataOther2[$val];
	}
	$i++;
}

//บัญชีธนาคาร (ล้มละลาย)
$sqlSelectDataBank = "	select 	* 
							from 	WH_BANKRUPT_ASSETS_BOOKBANK
							where 	rownum < 1"; 
$arrFieldsBank = db::query_field($sqlSelectDataBank);

$sqlSelectDataBank = "	select 	* 
							from 	WH_BANKRUPT_ASSETS_BOOKBANK
							where 	1=1 {$filter}"; 
$querySelectDataBank = db::query($sqlSelectDataBank);
while($dataSelectDataBank = db::fetch_array($querySelectDataBank)){
	foreach($arrFieldsBank as $key => $val){
		$obj["ban"]["bank"][$i][underToCamel($val)] = $dataSelectDataBank[$val];
	}
	$i++;
}



######################################################################################## -- ล้มละลาย --##########################################################################################################



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
