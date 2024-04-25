<?php

include '../include/include.php';

$str_json = file_get_contents("php://input");
$res = json_decode($str_json, true);

$REQUEST_DATA = "";
foreach($res as $key => $val){
	$REQUEST_DATA .= $key."=".$val."\n\r";
}
/* เก็บ log start */
/* $array_link = "";
foreach (json_decode($str_json, true) as $sh1 => $ch1) {
    $array_link .= "&" . $sh1 . "=" . $ch1;
}
unset($fields);
$fields["PAGE_CODE"]                 =    "insert_cmd_noti";
$fields["COLUMN1"]                 =     $array_link;
$fields["CREATE_DATE"]                 =    date("Y-m-d");
$fields["SYSTEM_TYPE"]                 =   "1";
db::db_insert("TEST_DATA_RES", $fields, 'PK_ID', 'PK_ID'); */
/* เก็บ log stop */

if ($res['ip'])
{
    $ip = $res['ip'];
}
else
{
    $ip = get_client_ip();
}

$field = array();
$field['IP_ADDRESS'] = $ip ;
$field['DEP_ID'] = $POST['depId'];
$field['REQUEST'] = 'insertCmdNoti';
$field['LOG_DATE'] = date("Y-m-d");
$field['LOG_TIME'] = date("H:i:s");
$field['USR_ID'] = '' ;
$field['REQUEST_STATUS'] = '200';
$field['USR_IDCARD'] = $POST['idCard'];
$field['LOG_TYPE'] = '1' ;
//$field['REQUEST_DATA'] = $str_json;

$LOG_ID = db::db_insert('M_LOG', $field, 'LOG_ID','LOG_ID');

// $h = fopen("log_file/" . $LOG_ID . '.txt', "w");
// fwrite($h, $REQUEST_DATA);
// fclose($h);

$h = fopen("log_file/json_" . $LOG_ID . '.txt', "w");
fwrite($h, json_encode($res,JSON_UNESCAPED_UNICODE));
fclose($h);

if ($res['userName'] == 'BankruptDt' && $res['passWord'] == 'Debtor4321')
{
	
	//คำสั่งหลัก
	unset($fields);
		$fields["CMD_DOC_DATE"] 		= 		date('Y-m-d');
		$fields["CMD_DOC_TIME"] 		= 		date('H:i:s');
		$fields["CIVIL_PROCESS_TYPE"] 	= 		$res["cmdDetail"][0]["civilProcessType"];
		$fields["MEDIATE_NO"] 			= 		$res["cmdDetail"][0]["mediateNo"];
		$fields["CMD_HEADER_ALERT"] 	= 		$res["cmdDetail"][0]["cmdHeaderAlert"];
		
		if($res["courtCode"]!=""){
			$sqlSelectCourt1 		= "select COURT_NAME from M_COURT where COURT_CODE = '".$res["courtCode"]."'";
			$querySelectCourt1 		= db::query($sqlSelectCourt1);
			$recSelectCourt1 	 	= db::fetch_array($querySelectCourt1);
			
			$fields["COURT_CODE"] 			= 		$res["courtCode"];
			$fields["COURT_NAME"] 			= 		$recSelectCourt1["COURT_NAME"];
		}else{
			$sqlSelectCourt1 		= "select COURT_CODE from M_COURT where COURT_NAME = '".$res["courtName"]."'";
			$querySelectCourt1 		= db::query($sqlSelectCourt1);
			$recSelectCourt1 	 	= db::fetch_array($querySelectCourt1);
			
			$fields["COURT_CODE"] 			= 		$recSelectCourt1["COURT_CODE"];
			$fields["COURT_NAME"] 			= 		$res["courtName"];
			
			$res["courtCode"] = $recSelectCourt1["COURT_CODE"];
		}
		
		$SourceCmdCourtName = $fields["COURT_NAME"];
		
		$fields["F_BLACK_CASE"] 		= 		$res["prefixBlackCase"].$res["blackCase"]."/".$res["blackYy"];
		$fields["T_BLACK_CASE"] 		= 		$res["prefixBlackCase"];
		$fields["BLACK_CASE"] 			= 		$res["blackCase"];
		$fields["BLACK_YY"] 			= 		$res["blackYy"];
		$fields["F_RED_CASE"] 			= 		$res["prefixRedCase"].$res["redCase"]."/".$res["redYy"];
		$fields["T_RED_CASE"] 			= 		$res["prefixRedCase"];
		$fields["RED_CASE"] 			= 		$res["redCase"];
		$fields["RED_YY"] 				= 		$res["redYy"];
		
		
		
		$fields["CASE_TYPE"] 			= 		$res["cmdStaff"];
		$fields["SEND_STATUS"] 			= 		1;
		$fields["CMD_NOTE"] 			= 		$res["cmdDetail"][0]["cmdNote"];
		
		$fields["APPROVE_STATUS"] 		= 		1;
		$fields["CMD_READ_STATUS"] 		= 		0;
		$fields["CMD_DETAIL"] 			= 		$res["cmdDetail"]["cmdNote"];
		$fields["CMD_SYSTEM"] 			= 		($res["systemName"]!="")?$res["systemName"]:$res["from"];	
		$fields["SYS_NAME"] 			= 		($res["systemName"]!="")?$res["systemName"]:$res["from"];	
		$fields["CMD_TYPE"] 			= 		$res["cmdType"];
		
		$FORM_SYSTEM = $fields["CMD_SYSTEM"];
		
		
		$formName = ($res["systemName"]!="")?$res["systemName"]:$res["from"];	
		
		$sqlSelectCourt 		= "select COURT_CODE from M_COURT where COURT_NAME = '".$res["toCourtName"]."'";
		$querySelectCourt 		= db::query($sqlSelectCourt);
		$recSelectCourt 	 	= db::fetch_array($querySelectCourt);
		
		
		//ดึงสถานะการบังคับคดีของล้มลายว่าคำสั่งนั้นจะผลต่อการบังคับคดีหรือไม่
		$sqlCmdActionLog 		= "select CMD_ACT_FLAG_1 from M_SERVICE_CMD where CMD_TYPE_ID = 1 and CMD_TYPE_CODE = '".$res["cmdStaff"]."' and CMD_SYS_ID = 2 ";
		$queryCmdActionLog 		= db::query($sqlCmdActionLog);
		$recCmdActionLog 	 	= db::fetch_array($queryCmdActionLog);
		$getCmdActFlag			= $recCmdActionLog["CMD_ACT_FLAG_1"];
		
		
		if($res['systemType'] == 'Civil'){
			$SEND_TO = 1;
			
			$sqlSelectPersonConcern = "	SELECT 	CONCERN_NAME
										FROM 	".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')." 
										WHERE 	REGISTER_CODE = '".$res["registerCode"]."' 
												AND PREFIX_BLACK_CASE = '".$res["toPrefixBlackCase"]."'
												AND BLACK_CASE = '".$res["toBlackCase"]."'
												AND BLACK_YY = '".$res["toBlackYy"]."'
												AND PREFIX_RED_CASE = '".$res["toPrefixRedCase"]."'
												AND RED_CASE = '".$res["toRedCase"]."'
												AND RED_YY = '".$res["toRedYy"]."'
												AND COURT_CODE = '".$recSelectCourt["COURT_CODE"]."'";
			$querySelectPersonConcern 		= db::query($sqlSelectPersonConcern);
			$recSelectPersonConcern 	 	= db::fetch_array($querySelectPersonConcern);
			
		}else if($res['systemType'] == 'Bankrupt'){
			$SEND_TO = 2;
		}else if($res['systemType'] == 'Revive'){
			$SEND_TO = 3;
		}else if($res['systemType'] == 'Mediate'){
			$SEND_TO = 4;
			$sqlSelectPersonConcern = "	SELECT 	CONCERN_NAME
										FROM 	WH_MEDIATE_PERSON 
										WHERE 	REGISTER_CODE = '".$res["registerCode"]."' AND PREFIX_BLACK_CASE = '".$res["toPrefixBlackCase"]."'
												AND BLACK_CASE = '".$res["toBlackCase"]."'
												AND BLACK_YY = '".$res["toBlackYy"]."'
												AND PREFIX_RED_CASE = '".$res["toPrefixRedCase"]."'
												AND RED_CASE = '".$res["toRedCase"]."'
												AND RED_YY = '".$res["toRedYy"]."'
												AND COURT_CODE = '".$recSelectCourt["COURT_CODE"]."'";
			$querySelectPersonConcern 		= db::query($sqlSelectPersonConcern);
			$recSelectPersonConcern 	 	= db::fetch_array($querySelectPersonConcern);
		}
		
		$fields["SEND_TO"] 		= 		$SEND_TO;
		
		
		if($fields["SEND_TO"]==1){
			$sqlSelectCase = "	select 	DEFFENDANT1,PLAINTIFF1,WH_CIVIL_ID,PCC_CASE_GEN
								from 	WH_CIVIL_CASE 
								where 	PREFIX_BLACK_CASE = '".$res["toPrefixBlackCase"]."'
										AND BLACK_CASE = '".$res["toBlackCase"]."'
										AND BLACK_YY = '".$res["toBlackYy"]."'
										AND PREFIX_RED_CASE = '".$res["toPrefixRedCase"]."'
										AND RED_CASE = '".$res["toRedCase"]."'
										AND RED_YY = '".$res["toRedYy"]."'
										AND COURT_CODE = '".$recSelectCourt["COURT_CODE"]."'";
			$querySelectCase = db::query($sqlSelectCase);
			$recSelectCase 	 = db::fetch_array($querySelectCase);
			
			$sqlSelectDataOnwer = "	select 		DOSS_OWNER_ID
									from 		WH_CIVIL_DOSS
									where		WH_CIVIL_ID = '".$recSelectCase["WH_CIVIL_ID"]."' ";
			$querySelectOnwer 	= db::query($sqlSelectDataOnwer);
			$recSelectOnwer 	= db::fetch_array($querySelectOnwer);
			
			$fields["TO_PERSON_ID"] = $recSelectOnwer["DOSS_OWNER_ID"];
			
		}else if($fields["SEND_TO"]==2){
			$sqlSelectCase = "	select 	DEFFENDANT1,PLAINTIFF1,DOSS_OWNER_ID
								from 	WH_BANKRUPT_CASE_DETAIL 
								where 	PREFIX_BLACK_CASE = '".$res["toPrefixBlackCase"]."'
										AND BLACK_CASE = '".$res["toBlackCase"]."'
										AND BLACK_YY = '".$res["toBlackYy"]."'
										AND PREFIX_RED_CASE = '".$res["toPrefixRedCase"]."'
										AND RED_CASE = '".$res["toRedCase"]."'
										AND RED_YY = '".$res["toRedYy"]."'";
			$querySelectCase = db::query($sqlSelectCase);
			$recSelectCase 	 = db::fetch_array($querySelectCase);
			
			$fields["TO_PERSON_ID"] = $recSelectCase["DOSS_OWNER_ID"];//$res["sendToPerson"];//*//
		}else if($fields["SEND_TO"]==3){
			$sqlSelectCase = "	select 	DEFFENDANT1,PLAINTIFF2 as PLAINTIFF1
								from 	WH_REHABILITATION_CASE_DETAIL 
								where 	PREFIX_BLACK_CASE = '".$res["toPrefixBlackCase"]."'
										AND BLACK_CASE = '".$res["toBlackCase"]."'
										AND BLACK_YY = '".$res["toBlackYy"]."'
										AND PREFIX_RED_CASE = '".$res["toPrefixRedCase"]."'
										AND RED_CASE = '".$res["toRedCase"]."'
										AND RED_YY = '".$res["toRedYy"]."' ";
			$querySelectCase = db::query($sqlSelectCase);
			$recSelectCase 	 = db::fetch_array($querySelectCase);
			
			$fields["TO_PERSON_ID"] 		= 		"1103411005612";//$res["sendToPerson"];//*//
		}else if($fields["SEND_TO"]==4){
			$sqlSelectCase = "	select 	DEFENDANT_FNAME as DEFFENDANT1,PLAINTIFF_FNAME as PLAINTIFF1,REF_WFR_ID
								from 	WH_MEDIATE_CASE 
								where 	PREFIX_BLACK_CASE = '".$res["toPrefixBlackCase"]."'
										AND BLACK_CASE = '".$res["toBlackCase"]."'
										AND BLACK_YY = '".$res["toBlackYy"]."'
										AND PREFIX_RED_CASE = '".$res["toPrefixRedCase"]."'
										AND RED_CASE = '".$res["toRedCase"]."'
										AND RED_YY = '".$res["toRedYy"]."'
										AND COURT_ID = '".$recSelectCourt["COURT_CODE"]."'";
			$querySelectCase = db::query($sqlSelectCase);
			$recSelectCase 	 = db::fetch_array($querySelectCase);
			
			$fields["TO_PERSON_ID"] 		= 		"1103411005612";//$res["sendToPerson"];//*//
		}
		if($res["ToPersonFix"]!=""){
			$fields["TO_PERSON_ID"] 		= 		$res["ToPersonFix"];
		}
		
		
		
		$fields["PLAINTIFF"] 			= 		(trim($res["plaintiff"])!="")?$res["plaintiff"]:$recSelectCase["PLAINTIFF1"];
		$fields["DEFENDANT"] 			= 		(trim($res["defendant"])!="")?$res["defendant"]:$recSelectCase["DEFFENDANT1"];
		
		
		$fields["TO_T_BLACK_CASE"] 		= 		$res["toPrefixBlackCase"];
		$fields["TO_BLACK_CASE"]		= 		$res["toBlackCase"];
		$fields["TO_BLACK_YY"] 			= 		$res["toBlackYy"];
		$fields["TO_T_RED_CASE"] 		= 		$res["toPrefixRedCase"];
		$fields["TO_RED_CASE"] 			= 		$res["toRedCase"];
		$fields["TO_RED_YY"] 			= 		$res["toRedYy"];
		
		$fields["TO_COURT_CODE"] 		= 		$recSelectCourt["COURT_CODE"];
		$fields["TO_COURT_NAME"] 		= 		$res["toCourtName"];
		
		$targerCmdCourtName 			= 		$res["toCourtName"];

		$fields["TO_PLAINTIFF"] 		= 		$recSelectCase["PLAINTIFF1"];
		$fields["TO_DEFENDANT"] 		= 		$recSelectCase["DEFFENDANT1"];
	
		$FieldToFunc["mDOcCmd"] = $fields;
		
	$CMD_ID = db::db_insert("M_DOC_CMD",$fields,'ID','ID');
	
	getDataToWhAlert($fields["TO_PERSON_ID"]);
	
		
	//รายละเอียดคำสั่ง
	unset($fields);
		$fields["CMD_ID"] 				= 	$CMD_ID;
		$fields["CMD_NOTE"] 			=	$res["cmdDetail"][0]["cmdNote"];
		$FieldToFunc["mDOcCmdDetail"] 	= 	$fields;
	db::db_insert("M_CMD_DETAILS",$fields,'CMD_DETAIL_ID','CMD_DETAIL_ID');

	//คนในคำสั่ง
	unset($fields);
		$fields["CMD_ID"] 				= 	$CMD_ID;
		$fields["ID_CARD"] 				= 	$res["registerCode"];
		$fields["FIRST_NAME"] 			= 	$res["firstName"];
		$fields["FULL_NAME"] 			= 	$res["firstName"];
		$fields["PERSON_CMD_TYPE"] 		= 	$res["cmdStaff"];
		$fields["PERSON_CASE_TYPE"] 	= 	$res["cmdType"];
		$FieldToFunc["mDOcCmdPerson"] 	= $fields;
	db::db_insert("M_CMD_PERSON",$fields,'PERSON_ID','PERSON_ID');
	
	
	
	if(count($res["cmdAsset"])>0){
		foreach($res["cmdAsset"] as $key => $dataAsset){
			unset($fields);
				$fields["CMD_ID"] 				= 	$CMD_ID;
				$fields["PROP_DET"] 			= 	$dataAsset["propDet"];
				$fields["M_ASSET_KEY"] 			= 	$dataAsset["mAssetKey"];
				$fields["ASSET_TYPE_ID"] 		= 	$dataAsset["assetTypeId"];
				$fields["PROP_STATUS_NAME"] 	= 	$dataAsset["propStatusName"];
				$fields["ASSET_CMD_TYPE"] 		= 	$res["cmdStaff"];
				$fields["ASSET_CASE_TYPE"] 		= 	$res["cmdType"];
			db::db_insert("M_CMD_ASSET",$fields,'CMD_ASSET_ID','CMD_ASSET_ID');
			
			if($dataAsset["mAssetKey"]!=""){
				unset($fields);
					$fields["PREFIX_BLACK_CASE"] 	= 	$res["toPrefixBlackCase"];
					$fields["BLACK_CASE"] 			= 	$res["toBlackCase"];
					$fields["BLACK_YY"] 			= 	$res["toBlackYy"];
					$fields["PREFIX_RED_CASE"] 		= 	$res["toPrefixRedCase"];
					$fields["RED_CASE"] 			= 	$res["toRedCase"];
					$fields["RED_YY"] 				= 	$res["toRedYy"];
					
					$fields["M_ASSET_KEY"] 			= 	$dataAsset["mAssetKey"];
					$fields["ASSET_TYPE_ID"] 		= 	$dataAsset["assetTypeId"];
					$fields["PROP_TITLE"] 			= 	$dataAsset["propDet"];
					$fields["PROP_STATUS_NAME"] 	= 	$dataAsset["propStatusName"];
				db::db_insert("WH_DEBTOR_ASSETS",$fields,'WH_ASSET_ID','WH_ASSET_ID');
			}
			
		}
	}
	
	
	if($formName==3){
		unset($arrGetReviveToWh);
			$arrGetReviveToWh["prefixBlackCase"] 	= $res["prefixBlackCase"];
			$arrGetReviveToWh["blackCase"] 			= $res["blackCase"];
			$arrGetReviveToWh["blackYy"] 			= $res["blackYy"];
			$arrGetReviveToWh["prefixRedCase"] 		= $res["prefixRedCase"];
			$arrGetReviveToWh["redCase"] 			= $res["redCase"];
			$arrGetReviveToWh["redYy"] 				= $res["redYy"];
		getReviveToWh($arrGetReviveToWh);
	}else if($formName==1){
		$sqlSelectCaseWh 	= "	select 	CIVIL_CODE
								from 	WH_CIVIL_CASE 
								where 	PREFIX_BLACK_CASE = '".$res["prefixBlackCase"]."'
										AND BLACK_CASE = '".$res["blackCase"]."'
										AND BLACK_YY = '".$res["blackYy"]."'
										AND PREFIX_RED_CASE = '".$res["prefixRedCase"]."'
										AND RED_CASE = '".$res["redCase"]."'
										AND RED_YY = '".$res["redYy"]."'
										AND COURT_CODE = '".$res["courtCode"]."'";
		$querySelectCaseWh 	= db::query($sqlSelectCaseWh);
		$recSelectCaseWh 	= db::fetch_array($querySelectCaseWh);
		getCivilToWh($recSelectCaseWh["CIVIL_CODE"]);
	}
	
	//กรณีเป็นบุคลากรใน backoffice ต้องแจ้งเตือนไปยัง ผอ กบท และ ผอ กองคลังให้ทราบ
	//บุคลากร
	$sqlSelectPersonBackoffice = "SELECT count(1) as COUNT_DATA FROM WH_BACKOFFICE_PERSON WHERE REGISTER_CODE = '".str_replace('-','',$res["registerCode"])."'";
	$querySelectPersonBackoffice = db::query($sqlSelectPersonBackoffice);
	$recSelectPersonBackoffice = db::fetch_array($querySelectPersonBackoffice);
	if($recSelectPersonBackoffice["COUNT_DATA"]>0){
		sendCmdToBackoffice($FieldToFunc);
	}
	//เจ้าหนี้
	$sqlSelectPersonBackoffice2 = "SELECT count(1) as COUNT_DATA FROM WH_CREDITOR WHERE WH_CREDITOR_ID_CARD = '".str_replace('-','',$res["registerCode"])."'";
	$querySelectPersonBackoffice2 = db::query($sqlSelectPersonBackoffice2);
	$recSelectPersonBackoffice2 = db::fetch_array($querySelectPersonBackoffice2);
	if($recSelectPersonBackoffice2["COUNT_DATA"]>0){
		sendCmdToBackoffice($FieldToFunc);
	}
	//ผู้ขาย
	$sqlSelectPersonBackoffice3 = "SELECT count(1) as COUNT_DATA FROM WH_SELLER WHERE WH_SELLER_ID_CARD = '".str_replace('-','',$res["registerCode"])."'";
	$querySelectPersonBackoffice3 = db::query($sqlSelectPersonBackoffice3);
	$recSelectPersonBackoffice3 = db::fetch_array($querySelectPersonBackoffice3);
	if($recSelectPersonBackoffice3["COUNT_DATA"]>0){
		sendCmdToBackoffice($FieldToFunc);
	}
	
	//สถานะผู้ถูกทวงหนี้ เป็นลูกหนี้
	$pos 	= strpos($res["cmdDetail"][0]["cmdNote"], 'สถานะผู้ถูกทวงหนี้');
	$pos1_1 = strpos($res["cmdDetail"][0]["cmdNote"], 'สถานะผู้ร้อง');
	$pos2 	= strpos($res["cmdDetail"][0]["cmdNote"], 'สถานะจำเลย');
	if(($pos>0 || $pos1_1>0) && $pos2>0 && $SEND_TO==2){
		sendCmdToBankruptDueDate($FieldToFunc);
	}
	
	//บันทึกคนที่ตรวจพบของระบบล้มละลาย
	if($SEND_TO==2 || $FORM_SYSTEM==2){
		
		$table = "M_PERSONAL_INFO_CASE";
		
		if($FORM_SYSTEM==2){
			if(($pos>0 || $pos1_1>0) && $pos2>0){
				unset($chk);
					$chk['userName'] 		= 'BankruptDt';
					$chk['passWord'] 		= 'Debtor4321';
					
					$chk['prefixBlackCase'] = $res['toPrefixBlackCase'];
					$chk['blackCase'] 		= $res['toBlackCase'];
					$chk['blackYY'] 		= $res['toBlackYy'];
					$chk['prefixRedCase'] 	= $res['toPrefixRedCase'];
					$chk['redCase'] 		= $res['toRedCase'];
					$chk['redYY'] 			= $res['toRedYy'];
					$chk['courtName'] 		= $res['toCourtName'];
			}else{
				unset($chk);
					$chk['userName'] 		= 'BankruptDt';
					$chk['passWord'] 		= 'Debtor4321';
					
					$chk['prefixBlackCase'] = $res['prefixBlackCase'];
					$chk['blackCase'] 		= $res['blackCase'];
					$chk['blackYY'] 		= $res['blackYy'];
					$chk['prefixRedCase'] 	= $res['prefixRedCase'];
					$chk['redCase'] 		= $res['redCase'];
					$chk['redYY'] 			= $res['redYy'];
					$chk['courtName'] 		= $res['courtName'];
			}
		}else{
			unset($chk);
				$chk['userName'] 		= 'BankruptDt';
				$chk['passWord'] 		= 'Debtor4321';
				
				$chk['prefixBlackCase'] = $res['toPrefixBlackCase'];
				$chk['blackCase'] 		= $res['toBlackCase'];
				$chk['blackYY'] 		= $res['toBlackYy'];
				$chk['prefixRedCase'] 	= $res['toPrefixRedCase'];
				$chk['redCase'] 		= $res['toRedCase'];
				$chk['redYY'] 			= $res['toRedYy'];
				$chk['courtName'] 		= $res['toCourtName'];
		}
		
		//sleep(20);
		
		$data_string = json_encode($chk);
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
				CURLOPT_URL => 'http://103.40.146.180/api/public/CheckCase',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS =>$data_string,
				CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json'
				),
			)
		);
		
		$response = curl_exec($curl);
		$res_case = json_decode($response, true);
		
		$case_data = $res_case['data']['Data'];
		foreach ($case_data as $key => $value) {
			$all_plaintiff = $value['plaintiff'];
			$all_defendant = $value['deffendant'];
			$bankruptCode = $value['bankruptCode'];
		}
		
		getBankruptToWh($bankruptCode);
		
		if($FORM_SYSTEM==2){
			insertCourtLogCommand($res['prefixBlackCase'],$res['blackCase'],$res['blackYy'],$res['prefixRedCase'],$res['redCase'],$res['redYy'],$res['courtName'],$res["cmdDetail"][0]["cmdNote"]);
		}
		
		$filter = "";
		if($_POST["BLACK_CASE"]!=""){
			$filter .= " and BLACK_CASE = '".$res["blackCase"]."'	";
		}
		if($_POST["BLACK_YY"]!=""){
			$filter .= " and BLACK_YY = '".$res["blackYy"]."'	";
		}
		if($_POST["RED_CASE"]!=""){
			$filter .= " and RED_CASE = '".$_POST['redCase']."'	";
		}
		if($_POST["RED_YY"]!=""){
			$filter .= " and RED_YY = '".$_POST['redYy']."'	";
		}
		$filter .= " and COURT_NAME = '".$SourceCmdCourtName."'	";
		$filter .= " and REGISTER_CODE = '".$res["registerCode"]."'	";
		
		
		$insertSystemType = "";
		if($formName==1){
			$sqlSelectPerson = "select 	CONCERN_NAME,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME ,PER_ORDER_STATUS,ZIP_CODE
								from 	".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')."
								where	1=1 {$filter}";
			$insertSystemType = "Civil";
		}else if($formName==2){
			$sqlSelectPerson = "select 	CONCERN_NAME,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME ,'' as PER_ORDER_STATUS,ZIP_CODE
								from 	WH_BANKRUPT_CASE_PERSON
								where	1=1 {$filter}";
			$insertSystemType = "Bankrupt";
		}else if($formName==3){
			$sqlSelectPerson = "select 	CONCERN_NAME,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME ,'' as PER_ORDER_STATUS,ZIP_CODE
								from 	WH_REHABILITATION_PERSON
								where	1=1 {$filter}";
			$insertSystemType = "Revive";
		}else if($formName==4){
			$sqlSelectPerson = "select 	CONCERN_NAME,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME ,'' as PER_ORDER_STATUS,ZIP_CODE
								from 	WH_MEDIATE_PERSON
								where	1=1 {$filter}";
			$insertSystemType = "Mediate";
		}
		$querySelectPerson = db::query($sqlSelectPerson);
		$recSelectPerson = db::fetch_array($querySelectPerson);
		
		if(trim($recSelectPerson["CONCERN_NAME"])!=""){
				unset($data_invat);
				$data_invat["REGISTERCODE"] 	= $res["registerCode"];
				$data_invat["F_NAME"] 			= $res["firstName"];
				if(($pos>0 || $pos1_1>0) && $pos2>0){
					if($pos>0){
						$data_invat["CONERNNAME"] 		= 'ผู้ถูกทวงหนี้';
					}else{
						$data_invat["CONERNNAME"] 		= 'ผู้ร้อง';
					}
				}else{
					$data_invat["CONERNNAME"] 		= $recSelectPerson["CONCERN_NAME"];
				}
				
				$data_invat["ADDRESS"] 			= $recSelectPerson["ADDRESS"];
				$data_invat["AMPNAME"] 			= $recSelectPerson["AMP_NAME"];
				$data_invat["TUMNAME"] 			= $recSelectPerson["TUM_NAME"];
				$data_invat["PROVNAME"] 		= $recSelectPerson["PROV_NAME"];;
				$data_invat["ZIPCODE"] 			= $recSelectPerson["ZIP_CODE"];
				
				if($FORM_SYSTEM==2){
					if(($pos>0 || $pos1_1>0) && $pos2>0){
						$data_invat["T_NO_BLACK"] 		= $res["prefixBlackCase"];
						$data_invat["NO_BLACK_CASE"] 	= $res["blackCase"];
						$data_invat["BLACK_YEAR"] 		= $res["blackYy"];
						
						$data_invat["T_NO_RED"] 		= $res["prefixRedCase"];
						$data_invat["NO_RED_CASE"] 		= $res["redCase"];
						$data_invat["RED_YEAR"] 		= $res["redYy"];
					}else{
						$data_invat["T_NO_BLACK"] 		= $res["toPrefixBlackCase"];
						$data_invat["NO_BLACK_CASE"] 	= $res["toBlackCase"];
						$data_invat["BLACK_YEAR"] 		= $res["toBlackYy"];
						
						$data_invat["T_NO_RED"] 		= $res["toPrefixRedCase"];
						$data_invat["NO_RED_CASE"] 		= $res["toRedCase"];
						$data_invat["RED_YEAR"] 		= $res["toRedYy"];
					}
				}else{
					$data_invat["T_NO_BLACK"] 		= $res["prefixBlackCase"];
					$data_invat["NO_BLACK_CASE"] 	= $res["blackCase"];
					$data_invat["BLACK_YEAR"] 		= $res["blackYy"];
					
					$data_invat["T_NO_RED"] 		= $res["prefixRedCase"];
					$data_invat["NO_RED_CASE"] 		= $res["redCase"];
					$data_invat["RED_YEAR"] 		= $res["redYy"];
				}
				
				$data_invat["SYSTEM_TYPE"] 		= $insertSystemType;
				$data_invat["COURT_NAME"] 		= $targerCmdCourtName;
				$data_invat["PERSON_TYPE_RE"] 	= $recSelectPerson["CONCERN_NAME"];
				$data_invat["ORDER_STATUS"] 	= $recSelectPerson["PER_ORDER_STATUS"];
				$data_invat["BRC_ID"] 			= $bankruptCode;
				
				
				if($FORM_SYSTEM==2){
					$sql = "SELECT 	PERSONAL_ID 
							FROM 	M_PERSONAL_INFO_CASE 
							WHERE 	REGISTERCODE = '".$res["registerCode"]."'
									AND COURT_NAME = '".$targerCmdCourtName."' 
									AND NO_BLACK_CASE = '".$res["toBlackCase"]."' 
									AND BLACK_YEAR = '".$res["toBlackYy"]."'
									AND NO_RED_CASE = '".$res["toRedCase"]."' 
									AND RED_YEAR = '".$res["toRedYy"]."' 
									AND SYSTEM_TYPE = '".$insertSystemType."' 
									AND BRC_ID = '".$bankruptCode."' ";
				}else{
					$sql = "SELECT 	PERSONAL_ID 
							FROM 	M_PERSONAL_INFO_CASE 
							WHERE 	REGISTERCODE = '".$res["registerCode"]."'
									AND COURT_NAME = '".$targerCmdCourtName."' 
									AND NO_BLACK_CASE = '".$res["blackCase"]."' 
									AND BLACK_YEAR = '".$res["blackYy"]."'
									AND NO_RED_CASE = '".$res["redCase"]."' 
									AND RED_YEAR = '".$res["redYy"]."' 
									AND SYSTEM_TYPE = '".$insertSystemType."' 
									AND BRC_ID = '".$bankruptCode."' ";
				}
					// echo $sql;			
				$qryinfo1 = db::query($sql);
				$rec = db::fetch_array($qryinfo1);
				$num = db::num_rows($qryinfo1);
				
				if($num<1){
					db::db_insert($table , $data_invat, "PERSONAL_ID");
				}				
				
				if(($recSelectPerson["CONCERN_NAME"]=='ลูกหนี้' || $recSelectPerson["CONCERN_NAME"]=='จำเลย') && ($recSelectPersonConcern["CONCERN_NAME"]=='โจทก์' || $recSelectPersonConcern["CONCERN_NAME"]=='จำเลย' || $recSelectPersonConcern["CONCERN_NAME"]=='ลูกหนี้')){//กรณีส่งแจ้งไปยังระบบแพ่ง และเป็นกรณีลูกหนี้ระบบล้มละลาย
					
						$sqlSelectCourtLog = "	select 		ORD_STATUS,COURT_DETAIL
												from 		WH_COURT_LOG 
												where  		COURT_SYSTEM_TYPE = 2
															AND PREFIX_BLACK_CASE = '".$res["prefixBlackCase"]."'
															AND BLACK_CASE = '".$res["blackCase"]."'
															AND BLACK_YY = '".$res["blackYy"]."'
															AND PREFIX_RED_CASE = '".$res["prefixRedCase"]."'
															AND RED_CASE = '".$res["redCase"]."'
															AND RED_YY = '".$res["redYy"]."'
												order by 	COURT_DATE desc,WH_COURT_LOG_ID desc";
						$querySelectCourtLog 	= db::query($sqlSelectCourtLog);
						$recSelectCourtLog = db::fetch_array($querySelectCourtLog);
						$SEQUEST_STATUS = 0;
						$SALE_STATUS = 0;
						$ACCOUNTANCY_STATUS = 0;
						$UNLOCK_PERSON_STATUS = 0;
						if($recSelectCourtLog["ORD_STATUS"]=='บังคับคดี'){
							$SEQUEST_STATUS = 1;
							$SALE_STATUS = 1;
							$ACCOUNTANCY_STATUS = 1;
						}
						if($recSelectCourtLog["COURT_DETAIL"]=='ยกเลิกการล้มละลาย'){
							$UNLOCK_PERSON_STATUS = 1;
						}
						if($recSelectCourtLog["COURT_DETAIL"]=='ปลดล้มละลาย'){
							$UNLOCK_PERSON_STATUS = 2;
						}
				
					if($SEND_TO==1){				
						
						$curl = curl_init();
		
						$arrDataSet = array();
						
						$arrDataSet["USERNAME"] 				= "BankruptDt";
						$arrDataSet["PASSWORD"] 				= "Debtor4321";
						$arrDataSet["PCC_CASE_GEN"] 			= $recSelectCase["PCC_CASE_GEN"];
						$arrDataSet["CARD_ID"] 					= $res["registerCode"];
						$arrDataSet["CONCERN_CODE"] 			= ($recSelectPersonConcern["CONCERN_NAME"]=='โจทก์')?'01':'02';
						$arrDataSet["IS_REVIVE"] 				= 0;
						$arrDataSet["IS_BANKRUPT"] 				= 1;
						$arrDataSet["IS_MEDIATE"] 				= 0;
						$arrDataSet["IS_CIVIL"] 				= 0;
						$arrDataSet["UNLOCK_PERSON_STATUS"] 	= $UNLOCK_PERSON_STATUS;
						
						$sqlSelectCmdAsset 		= "	select 		CFC_CAPTION_GEN,DOSS_CONTROL_GEN,PROP_STATUS
													from 		WH_CIVIL_CASE_ASSETS
													where 		WH_CIVIL_ID = ".$recSelectCase['WH_CIVIL_ID']."";
						$querySelectCmdAsset 	= db::query($sqlSelectCmdAsset);
						while($recSelectCmdAsset = db::fetch_array($querySelectCmdAsset)){
							$arrDataSet["CFC_CAPTION_GEN"][$recSelectCmdAsset["CFC_CAPTION_GEN"]] = $recSelectCmdAsset["CFC_CAPTION_GEN"];
							$arrDataSet["PROP_STATUS"][$recSelectCmdAsset["CFC_CAPTION_GEN"]] = $recSelectCmdAsset["PROP_STATUS"];
							$arrDataSet["DOSS_CONTROL_GEN"][$recSelectCmdAsset["DOSS_CONTROL_GEN"]] = array(
																											"SEQUEST_STATUS" 		=> $SEQUEST_STATUS,
																											"SALE_STATUS" 			=> $SALE_STATUS,
																											"ACCOUNTANCY_STATUS" 	=> $ACCOUNTANCY_STATUS
																											);
						}
						
						$data_string = json_encode($arrDataSet);
						
						curl_setopt_array($curl, array(
						  CURLOPT_URL => 'http://103.40.146.73/LedService.php/lockPersonCivil',
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => '',
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 0,
						  CURLOPT_FOLLOWLOCATION => true,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => 'POST',
						  CURLOPT_POSTFIELDS =>$data_string,
						  CURLOPT_HTTPHEADER => array(
							'Content-Type: application/json'
						  ),
						));

						$response = curl_exec($curl);

						curl_close($curl);
						
						
						
						 
					}else if($SEND_TO==4){
						
						$curl = curl_init();
			
						$arrDataSet = array();
						
						$arrDataSet["USERNAME"] 		= "BankruptDt";
						$arrDataSet["PASSWORD"] 		= "Debtor4321";
						$arrDataSet["refWfrId"] 		= $recSelectCase["REF_WFR_ID"];
						$arrDataSet["registerCode"] 	= $res["registerCode"];
						$arrDataSet["prefixBlackCase"] 	= $res["prefixBlackCase"];
						$arrDataSet["blackCase"] 		= $res["blackCase"];
						$arrDataSet["blackYy"] 			= $res["blackYy"];
						$arrDataSet["prefixRedCase"] 	= $res["prefixRedCase"];
						$arrDataSet["redCase"] 			= $res["redCase"];
						$arrDataSet["redYy"] 			= $res["redYy"];
						$arrDataSet["fName"] 			= $res["firstName"];
						$arrDataSet["courtCode"] 		= $res["courtCode"];
						$arrDataSet["courtName"] 		= $res['courtName'];
						$arrDataSet["system"] 			= 'Bankrupt';
						$arrDataSet["concernName"] 		= $recSelectPersonConcern["CONCERN_NAME"];
						$arrDataSet["cmdActFlag"] 		= ($SEQUEST_STATUS==1)?1:0;
						
						$data_string = json_encode($arrDataSet);
						
						curl_setopt_array($curl, array(
						  CURLOPT_URL => 'http://103.208.27.224/ega_led_mediate/service/service_log_proces.php',
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => '',
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 0,
						  CURLOPT_FOLLOWLOCATION => true,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => 'POST',
						  CURLOPT_POSTFIELDS =>$data_string,
						  CURLOPT_HTTPHEADER => array(
							'Content-Type: application/json'
						  ),
						));
		
						echo $response = curl_exec($curl);

						curl_close($curl);
					}
					
				}else if(($recSelectPerson["CONCERN_NAME"]=='ลูกหนี้' || $recSelectPerson["CONCERN_NAME"]=='จำเลย') && ($recSelectPersonConcern["CONCERN_NAME"]=='ผู้ถือกรรมสิทธิ์' || $recSelectPersonConcern["CONCERN_NAME"]=='ผู้ถือกรรมสิทธิ์ร่วม' || $recSelectPersonConcern["CONCERN_NAME"]=='ผู้รับจำนอง' || $recSelectPersonConcern["CONCERN_NAME"]=='ทายาท' || $recSelectPersonConcern["CONCERN_NAME"]=='ผู้ร้องขอเฉลี่ย' || $recSelectPersonConcern["CONCERN_NAME"]=='ผู้ร้องกันส่วน' || $recSelectPersonConcern["CONCERN_NAME"]=='ผู้ร้องขัดทรัพย์' || $recSelectPersonConcern["CONCERN_NAME"]=='ผู้มีส่วนได้ในทรัพย์')){
					if($SEND_TO==1){				
						
						$curl = curl_init();
		
						$arrDataSet = array();
						
						$arrDataSet["USERNAME"] 	= "BankruptDt";
						$arrDataSet["PASSWORD"] 	= "Debtor4321";
						$arrDataSet["PCC_CASE_GEN"] = $recSelectCase["PCC_CASE_GEN"];
						$arrDataSet["CARD_ID"] 		= $res["registerCode"];
			
						$data_string = json_encode($arrDataSet);
						
						curl_setopt_array($curl, array(
						  CURLOPT_URL => 'http://103.40.146.73/LedService.php/lockOtherPersonCivil',
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => '',
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 0,
						  CURLOPT_FOLLOWLOCATION => true,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => 'POST',
						  CURLOPT_POSTFIELDS =>$data_string,
						  CURLOPT_HTTPHEADER => array(
							'Content-Type: application/json'
						  ),
						));

						$response = curl_exec($curl);

						curl_close($curl);
						
						
						
						 
					}
				}else if(($recSelectPerson["CONCERN_NAME"]=='โจทก์') && ($recSelectPersonConcern["CONCERN_NAME"]=='โจทก์' || $recSelectPersonConcern["CONCERN_NAME"]=='จำเลย' || $recSelectPersonConcern["CONCERN_NAME"]=='ผู้ถือกรรมสิทธิ์' || $recSelectPersonConcern["CONCERN_NAME"]=='ผู้ถือกรรมสิทธิ์ร่วม' || $recSelectPersonConcern["CONCERN_NAME"]=='ผู้รับจำนอง' || $recSelectPersonConcern["CONCERN_NAME"]=='ทายาท' || $recSelectPersonConcern["CONCERN_NAME"]=='ผู้ร้องขอเฉลี่ย' || $recSelectPersonConcern["CONCERN_NAME"]=='ผู้ร้องกันส่วน' || $recSelectPersonConcern["CONCERN_NAME"]=='ผู้ร้องขัดทรัพย์' || $recSelectPersonConcern["CONCERN_NAME"]=='ผู้มีส่วนได้ในทรัพย์')){
					if($SEND_TO==1){				
						
						$curl = curl_init();
		
						$arrDataSet = array();
						
						$arrDataSet["USERNAME"] 	= "BankruptDt";
						$arrDataSet["PASSWORD"] 	= "Debtor4321";
						$arrDataSet["PCC_CASE_GEN"] = $recSelectCase["PCC_CASE_GEN"];
						$arrDataSet["CARD_ID"] 		= $res["registerCode"];
			
						$data_string = json_encode($arrDataSet);
						
						curl_setopt_array($curl, array(
						  CURLOPT_URL => 'http://103.40.146.73/LedService.php/lockOtherPersonCivil',
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => '',
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 0,
						  CURLOPT_FOLLOWLOCATION => true,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => 'POST',
						  CURLOPT_POSTFIELDS =>$data_string,
						  CURLOPT_HTTPHEADER => array(
							'Content-Type: application/json'
						  ),
						));

						$response = curl_exec($curl);

						curl_close($curl);
						
						
						
						 
					}
				}


		}
		
		$resp = $res_case;
		
	}else if($formName==3){
		
		$filter = "";
		if($res["blackCase"]!=""){
			$filter .= " and BLACK_CASE = '".$res["blackCase"]."'	";
		}
		if($res["blackYy"]!=""){
			$filter .= " and BLACK_YY = '".$res["blackYy"]."'	";
		}
		if($rec["redCase"]!=""){
			$filter .= " and RED_CASE = '".$res['redCase']."'	";
		}
		if($rec["redYy"]!=""){
			$filter .= " and RED_YY = '".$rec['redYy']."'	";
		}
		$filter .= " and COURT_NAME = '".$SourceCmdCourtName."'	";
		$filter .= " and REGISTER_CODE = '".$res["registerCode"]."'	";
		
		$sqlSelectPerson = "	select 	CONCERN_NAME,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME ,'' as PER_ORDER_STATUS,ZIP_CODE
								from 	WH_REHABILITATION_PERSON
								where	1=1 {$filter}";
		$querySelectPerson = db::query($sqlSelectPerson);
		$recSelectPerson = db::fetch_array($querySelectPerson);
		
		//ประวัติคำสั่งศาล
		$sqlSelectCourtLog = "	select 		ORD_STATUS
								from 		WH_COURT_LOG 
								where  		COURT_SYSTEM_TYPE = 3
											AND PREFIX_BLACK_CASE = '".$res["prefixBlackCase"]."'
											AND BLACK_CASE = '".$res["blackCase"]."'
											AND BLACK_YY = '".$res["blackYy"]."'
											AND PREFIX_RED_CASE = '".$res["prefixRedCase"]."'
											AND RED_CASE = '".$res["redCase"]."'
											AND RED_YY = '".$res["redYy"]."'
								order by 	COURT_DATE desc";
		$querySelectCourtLog 	= db::query($sqlSelectCourtLog);
		$recSelectCourtLog = db::fetch_array($querySelectCourtLog);
		$SEQUEST_STATUS = 0;
		$SALE_STATUS = 0;
		$ACCOUNTANCY_STATUS = 0;
		if($recSelectCourtLog["ORD_STATUS"]=='บังคับคดี'){
			$SEQUEST_STATUS = 1;
			$SALE_STATUS = 1;
			$ACCOUNTANCY_STATUS = 1;
		}
		
		if($SEND_TO==1){//ระบบแพ่ง
			
			if(($recSelectPerson["CONCERN_NAME"]=='ลูกหนี้' || $recSelectPerson["CONCERN_NAME"]=='จำเลย') && ($recSelectPersonConcern["CONCERN_NAME"]=='โจทก์' || $recSelectPersonConcern["CONCERN_NAME"]=='จำเลย' || $recSelectPersonConcern["CONCERN_NAME"]=='ลูกหนี้' || $recSelectPersonConcern["CONCERN_NAME"]=='ผู้ถือกรรมสิทธิ์' || $recSelectPersonConcern["CONCERN_NAME"]=='ผู้ถือกรรมสิทธิ์ร่วม' || $recSelectPersonConcern["CONCERN_NAME"]=='ผู้รับจำนอง' || $recSelectPersonConcern["CONCERN_NAME"]=='ทายาท' || $recSelectPersonConcern["CONCERN_NAME"]=='ผู้ร้องขอเฉลี่ย' || $recSelectPersonConcern["CONCERN_NAME"]=='ผู้ร้องกันส่วน' || $recSelectPersonConcern["CONCERN_NAME"]=='ผู้ร้องขัดทรัพย์' || $recSelectPersonConcern["CONCERN_NAME"]=='ผู้มีส่วนได้ในทรัพย์')){//กรณีส่งแจ้งไปยังระบบแพ่ง และเป็นกรณีลูกหนี้ระบบล้มละลาย
					
				if($SEND_TO==1){				
					
					$curl = curl_init();

					$arrDataSet = array();
					
					$arrDataSet["USERNAME"] 	= "BankruptDt";
					$arrDataSet["PASSWORD"] 	= "Debtor4321";
					$arrDataSet["PCC_CASE_GEN"] = $recSelectCase["PCC_CASE_GEN"];
					$arrDataSet["CARD_ID"] 		= $res["registerCode"];
					$arrDataSet["CONCERN_CODE"] = ($recSelectPersonConcern["CONCERN_NAME"]=='โจทก์')?'01':'02';
					$arrDataSet["IS_REVIVE"] 	= 1;
					$arrDataSet["IS_BANKRUPT"] 	= 0;
					$arrDataSet["IS_MEDIATE"] 	= 0;
					$arrDataSet["IS_CIVIL"] 	= 0;
					
					$sqlSelectCmdAsset 		= "	select 		CFC_CAPTION_GEN,DOSS_CONTROL_GEN,PROP_STATUS
												from 		WH_CIVIL_CASE_ASSETS
												where 		WH_CIVIL_ID = ".$recSelectCase['WH_CIVIL_ID']."";
					$querySelectCmdAsset 	= db::query($sqlSelectCmdAsset);
					while($recSelectCmdAsset = db::fetch_array($querySelectCmdAsset)){
						$arrDataSet["CFC_CAPTION_GEN"][$recSelectCmdAsset["CFC_CAPTION_GEN"]] = $recSelectCmdAsset["CFC_CAPTION_GEN"];
						$arrDataSet["PROP_STATUS"][$recSelectCmdAsset["CFC_CAPTION_GEN"]] = $recSelectCmdAsset["PROP_STATUS"];
						$arrDataSet["DOSS_CONTROL_GEN"][$recSelectCmdAsset["DOSS_CONTROL_GEN"]] = array(
																										"SEQUEST_STATUS" 		=> $SEQUEST_STATUS,
																										"SALE_STATUS" 			=> $SALE_STATUS,
																										"ACCOUNTANCY_STATUS" 	=> $ACCOUNTANCY_STATUS
																										);
					}
					
					$data_string = json_encode($arrDataSet);
					
					curl_setopt_array($curl, array(
					  CURLOPT_URL => 'http://103.40.146.73/LedService.php/lockPersonCivil',
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => '',
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 0,
					  CURLOPT_FOLLOWLOCATION => true,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => 'POST',
					  CURLOPT_POSTFIELDS =>$data_string,
					  CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json'
					  ),
					));

					$response = curl_exec($curl);

					curl_close($curl);
					
					
				}
			}
			
			
			
			
		}else if($SEND_TO==2){//ระบบล้มละลาย
			
		}else if($SEND_TO==3){//ระบบฟื้นฟู
			
		}else if($SEND_TO==4){//ระบบไกล่เกลี่ย
			$curl = curl_init();
			
			$arrDataSet = array();
			
			$arrDataSet["USERNAME"] 		= "BankruptDt";
			$arrDataSet["PASSWORD"] 		= "Debtor4321";
			$arrDataSet["refWfrId"] 		= $recSelectCase["REF_WFR_ID"];
			$arrDataSet["registerCode"] 	= $res["registerCode"];
			$arrDataSet["prefixBlackCase"] 	= $res["prefixBlackCase"];
			$arrDataSet["blackCase"] 		= $res["blackCase"];
			$arrDataSet["blackYy"] 			= $res["blackYy"];
			$arrDataSet["prefixRedCase"] 	= $res["prefixRedCase"];
			$arrDataSet["redCase"] 			= $res["redCase"];
			$arrDataSet["redYy"] 			= $res["redYy"];
			$arrDataSet["fName"] 			= $res["firstName"];
			$arrDataSet["courtCode"] 		= $res["courtCode"];
			$arrDataSet["courtName"] 		= $SourceCmdCourtName;
			$arrDataSet["system"] 			= 'Revive';
			$arrDataSet["concernName"] 		= $recSelectPersonConcern["CONCERN_NAME"];
			$arrDataSet["cmdActFlag"] 		= ($SEQUEST_STATUS==1)?1:0;
			
			$data_string = json_encode($arrDataSet);
			
			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'http://103.208.27.224/ega_led_mediate/service/service_log_proces.php',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS =>$data_string,
			  CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json'
			  ),
			));

			$response = curl_exec($curl);

			curl_close($curl);
		}
	
		
		
	}

}

$num = 1;
$row['ResponseCode'] = array( 'ResCode' => '000','ResMeassage' => "SUCCESS");


echo json_encode($row);

?>
