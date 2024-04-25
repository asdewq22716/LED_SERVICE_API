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
if($POST["registerCode"]!=""){
	$filter .= " and REGISTER_CODE = '".$POST['registerCode']."'	";
}
if($POST["type"]!=""){
	$filter .= " and PER_TYPE_NAME = '".$POST['type']."'	";
}


if($filter!=""){
	$arr_count = array();
	
	$arr_count['Objector'] = 0;
	$arr_count['Manager'] = 0;
	$arr_count['Planner'] = 0;
	$arr_count['ManagerPlan'] = 0;
	$arr_count['ManagerPlanTmp'] = 0;
	
	$max_date = "";
	
	$obj = array();
	$obj_temp = array();
	$sqlSelectData = "	SELECT 		*
						FROM 		WH_REVIVE_PER_RELATION 
						WHERE 		1=1 {$filter}
						ORDER BY 	PER_TYPE_NAME ASC,WH_REVIVE_PER_ID ASC"; 


	$querySelectData = db::query($sqlSelectData);
	while($dataSelectData = db::fetch_array($querySelectData)){
		$countData = $arr_count[$dataSelectData["PER_TYPE_NAME"]]++;
		
		$obj[$dataSelectData["PER_TYPE_NAME"]][$countData]['prefixName'] 		= $dataSelectData['MANAG_PREFIX'];
		$obj[$dataSelectData["PER_TYPE_NAME"]][$countData]['fullName'] 			= $dataSelectData['MANAG_NAME_TH'];
		$obj[$dataSelectData["PER_TYPE_NAME"]][$countData]['Address'] 			= $dataSelectData['MANAG_ADD'];
		$obj[$dataSelectData["PER_TYPE_NAME"]][$countData]['tambonName'] 		= $dataSelectData['MANAG_TAMBON'];
		$obj[$dataSelectData["PER_TYPE_NAME"]][$countData]['amphurName'] 		= $dataSelectData['MANAG_AMPHUR'];
		$obj[$dataSelectData["PER_TYPE_NAME"]][$countData]['provinceName'] 		= $dataSelectData['MANAG_PROVINCE'];
		$obj[$dataSelectData["PER_TYPE_NAME"]][$countData]['zipCode'] 			= $dataSelectData['MANAG_POSTCODE'];
		$obj[$dataSelectData["PER_TYPE_NAME"]][$countData]['tel'] 				= $dataSelectData['MANAG_TEL'];
		$obj[$dataSelectData["PER_TYPE_NAME"]][$countData]['fax'] 				= $dataSelectData['MANAG_FAX'];
		$obj[$dataSelectData["PER_TYPE_NAME"]][$countData]['mobile'] 			= $dataSelectData['MANAG_MOBILE'];
		$obj[$dataSelectData["PER_TYPE_NAME"]][$countData]['email'] 			= $dataSelectData['MANAG_EMAIL'];
		$obj[$dataSelectData["PER_TYPE_NAME"]][$countData]['orderDate'] 		= $dataSelectData['ORDER_DATE'];
		$obj[$dataSelectData["PER_TYPE_NAME"]][$countData]['beginDate'] 		= $dataSelectData['BEGIN_DATE'];
		$obj[$dataSelectData["PER_TYPE_NAME"]][$countData]['finishDate'] 		= $dataSelectData['FINISH_DATE'];
		$obj[$dataSelectData["PER_TYPE_NAME"]][$countData]['newsDate'] 			= $dataSelectData['NEWS_DATE'];
		$obj[$dataSelectData["PER_TYPE_NAME"]][$countData]['newsDateEnd'] 		= $dataSelectData['NEWS_DATE_END'];
		$obj[$dataSelectData["PER_TYPE_NAME"]][$countData]['gazetteDate'] 		= $dataSelectData['GAZETTE_DATE'];
		$obj[$dataSelectData["PER_TYPE_NAME"]][$countData]['gazetteDateEnd'] 	= $dataSelectData['GAZETTE_DATE_END'];
		$obj[$dataSelectData["PER_TYPE_NAME"]][$countData]['websiteDate'] 		= $dataSelectData['WEBSITE_DATE'];
		$obj[$dataSelectData["PER_TYPE_NAME"]][$countData]['websiteDateEnd'] 	= $dataSelectData['WEBSITE_DATE_END'];
		$obj[$dataSelectData["PER_TYPE_NAME"]][$countData]['registerCode'] 		= $dataSelectData['REGISTER_CODE'];
		$obj[$dataSelectData["PER_TYPE_NAME"]][$countData]['plansendDate'] 		= $dataSelectData['PLAN_SEND_DATE'];
		$obj[$dataSelectData["PER_TYPE_NAME"]][$countData]['agreePlanDate'] 	= $dataSelectData['AGREE_PLAN_DATE'];
		$obj[$dataSelectData["PER_TYPE_NAME"]][$countData]['beginWithout'] 		= $dataSelectData['BEGIN_WITHOUT'];
		
		if(substr($dataSelectData['BEGIN_DATE'],0,10)<=date('Y-m-d') && date('Y-m-d') <= substr($dataSelectData['FINISH_DATE'],0,10) && trim($dataSelectData['BEGIN_DATE'])!=""){
			$obj_temp['prefixName'] 		= $dataSelectData['MANAG_PREFIX'];
			$obj_temp['fullName'] 			= $dataSelectData['MANAG_NAME_TH'];
			$obj_temp['Address'] 			= $dataSelectData['MANAG_ADD'];
			$obj_temp['tambonName'] 		= $dataSelectData['MANAG_TAMBON'];
			$obj_temp['amphurName'] 		= $dataSelectData['MANAG_AMPHUR'];
			$obj_temp['provinceName'] 		= $dataSelectData['MANAG_PROVINCE'];
			$obj_temp['zipCode'] 			= $dataSelectData['MANAG_POSTCODE'];
			$obj_temp['tel'] 				= $dataSelectData['MANAG_TEL'];
			$obj_temp['fax'] 				= $dataSelectData['MANAG_FAX'];
			$obj_temp['mobile'] 			= $dataSelectData['MANAG_MOBILE'];
			$obj_temp['email'] 				= $dataSelectData['MANAG_EMAIL'];
			$obj_temp['orderDate'] 			= $dataSelectData['ORDER_DATE'];
			$obj_temp['beginDate'] 			= $dataSelectData['BEGIN_DATE'];
			$obj_temp['finishDate'] 		= $dataSelectData['FINISH_DATE'];
			$obj_temp['newsDate'] 			= $dataSelectData['NEWS_DATE'];
			$obj_temp['newsDateEnd'] 		= $dataSelectData['NEWS_DATE_END'];
			$obj_temp['gazetteDate'] 		= $dataSelectData['GAZETTE_DATE'];
			$obj_temp['gazetteDateEnd'] 	= $dataSelectData['GAZETTE_DATE_END'];
			$obj_temp['websiteDate'] 		= $dataSelectData['WEBSITE_DATE'];
			$obj_temp['websiteDateEnd'] 	= $dataSelectData['WEBSITE_DATE_END'];
			$obj_temp['registerCode'] 		= $dataSelectData['REGISTER_CODE'];
			$obj_temp['plansendDate'] 		= $dataSelectData['PLAN_SEND_DATE'];
			$obj_temp['agreePlanDate'] 		= $dataSelectData['AGREE_PLAN_DATE'];
			$obj_temp['beginWithout'] 		= $dataSelectData['BEGIN_WITHOUT'];
			$obj_temp['perTypeName'] 		= lcfirst($dataSelectData["PER_TYPE_NAME"]);
			
			$obj["Auth"][] = $obj_temp;
		}
		
		$i++;
	}
	// print_pre($obj_temp);
	// array_push($obj["Auth"],$obj_temp);
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
