<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);
$i=0;

$form_field['USERNAME'] 			= 'BankruptDt';// เปลี่ยนเป็นค่าที่จะส่ง
$form_field['PASSWORD'] 			= 'Debtor4321';// เปลี่ยนเป็นค่าที่จะส่ง

// if($POST["prefixBlackCase"]!=""){
	// $filter .= " and PREFIX_BLACK_CASE = '".$POST['prefixBlackCase']."'	";
// }
// if($POST["blackCase"]!=""){
	// $filter .= " and BLACK_CASE = '".$POST['blackCase']."'	";
// }
// if($POST["blackYy"]!=""){
	// $filter .= " and BLACK_YY = '".$POST['blackYy']."'	";
// }
// if($POST["prefixRedCase"]!=""){
	// $filter .= " and PREFIX_RED_CASE = '".$POST['prefixRedCase']."'	";
// }
// if($POST["redCase"]!=""){
	// $filter .= " and RED_CASE = '".$POST['redCase']."'	";
// }
// if($POST["redYy"]!=""){
	// $filter .= " and RED_YY = '".$POST['redYy']."'	";
// }
// if($POST["CourtCode"]!=""){
	// $filter .= " and COURT_CODE = '".$POST['CourtCode']."'	";
// }

if($POST["WhCivilId"]!=""){
	$filter .= " and WH_CIVIL_TRANSACTION.WH_CIVIL_ID = '".$POST['WhCivilId']."'	";
}
if($POST["dossId"]!=""){
	$filter .= " and WH_CIVIL_TRANSACTION.DOSS_ID = '".$POST['dossId']."'	";
}
if($POST["PccDossControl"]!=""){
	$filter .= " and WH_CIVIL_TRANSACTION.DOSS_CONTROL_GEN = '".$POST['PccDossControl']."'	";
}
if($POST["pccDossControl"]!=""){
	$filter .= " and WH_CIVIL_TRANSACTION.DOSS_CONTROL_GEN = '".$POST['pccDossControl']."'	";
}


if($filter!=""){
	$sqlSelectData = "	SELECT 		DOSS,to_char(SEND_DATE, 'DD/MM/YYYY') AS SEND_DATE,to_char(RECV_DOSS_DATE, 'DD/MM/YYYY') AS RECV_DOSS_DATE,FROM_DEPT,TO_DEPT,PROCESS_DESC,REMARK,to_char(SETUP_DATE, 'DD/MM/YYYY') AS SETUP_DATE
						FROM 		WH_CIVIL_TRANSACTION 
						WHERE		1=1 {$filter}
						ORDER BY 	SETUP_DATE,SEND_DATE ASC"; 


	$querySelectData = db::query($sqlSelectData);
	while($dataSelectData = db::fetch_array($querySelectData)){
		$obj[$i]['setupDate'] 	= $dataSelectData['SETUP_DATE'];
		$obj[$i]['dossName'] 	= $dataSelectData['DOSS'];
		$obj[$i]['sendDate'] 	= $dataSelectData['SEND_DATE'];
		$obj[$i]['fromDept'] 	= $dataSelectData['FROM_DEPT'];
		$obj[$i]['recvDate'] 	= $dataSelectData['RECV_DOSS_DATE'];
		$obj[$i]['toDept'] 		= $dataSelectData['TO_DEPT'];
		$obj[$i]['processDesc'] = $dataSelectData['PROCESS_DESC'];
		$obj[$i]['remark'] 		= $dataSelectData['REMARK'];
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
