<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);
$i=0;


// $h = fopen("log_file/insertCmdjson_".date('YmdHis').".txt", "w");
// fwrite($h, json_encode($POST,JSON_UNESCAPED_UNICODE));
// fclose($h);


//คำสั่งหลัก
unset($fields);
	$fields["CMD_DOC_DATE"] 		= 		$POST["cmdDocDate"];
	$fields["CMD_DOC_TIME"] 		= 		$POST["cmdDocTime"];
	$fields["COURT_CODE"] 			= 		$POST["courtCode"];
	$fields["COURT_NAME"] 			= 		$POST["courtName"];
	$fields["F_BLACK_CASE"] 		= 		$POST["fBlackCase"];
	$fields["T_BLACK_CASE"] 		= 		$POST["tBlackCase"];
	$fields["BLACK_CASE"] 			= 		$POST["blackCase"];
	$fields["BLACK_YY"] 			= 		$POST["blackYy"];
	$fields["F_RED_CASE"] 			= 		$POST["fRedCase"];
	$fields["T_RED_CASE"] 			= 		$POST["tRedCase"];
	$fields["RED_CASE"] 			= 		$POST["redCase"];
	$fields["RED_YY"] 				= 		$POST["redYy"];
	$fields["SEND_TO"] 				= 		$POST["sendTo"];
	$fields["CASE_TYPE"] 			= 		$POST["caseType"];
	$fields["SEND_STATUS"] 			= 		$POST["sendStatus"];
	$fields["CMD_NOTE"] 			= 		$POST["detail"];
	$fields["OFFICE_IDCARD"] 		= 		$POST["officeIdcard"];
	$fields["OFFICE_NAME"] 			= 		$POST["officeName"];
	$fields["DEPT_CODE"] 			= 		$POST["deptCode"];
	$fields["DEPT_NAME"] 			= 		$POST["deptName"];
	$fields["CIVIL_CODE"] 			= 		$POST["civilCode"];
	$fields["APPROVE_STATUS"] 		= 		$POST["approveStatus"];
	$fields["PLAINTIFF"] 			= 		$POST["plaintiff"];
	$fields["DEFENDANT"] 			= 		$POST["defendant"];
	$fields["SEND_TO_PERSON"] 		= 		$POST["sendToPerson"];
	$fields["CMD_PRIORITY_STATUS"] 	= 		$POST["cmdPriorityStatus"];
	$fields["CMD_READ_STATUS"] 		= 		0;
	$fields["CMD_DETAIL"] 			= 		$POST["cmdDetail"];
	$fields["CMD_DEPTCODE"] 		= 		$POST["cmdDeptcode"];
	$fields["CMD_DEPT_NAME"] 		= 		$POST["cmdDeptName"];
	$fields["CMD_RECORD_COUNT"] 	= 		$POST["cmdRecordCount"];
	$fields["CMD_REQ"] 				= 		$POST["cmdReq"];
	$fields["CMD_TODO_CMD_DATE"] 	= 		$POST["cmdTodoCmdDate"];
	$fields["CMD_NOTE_CODE"] 		= 		$POST["cmdNoteCode"];
	$fields["CMD_SYSTEM"] 			= 		$POST["cmdSystem"];
	$fields["CMD_DEFFENDANT1"] 		= 		$POST["cmdDeffendant1"];
	$fields["CMD_DEFFENDANT2"] 		= 		$POST["cmdDeffendant2"];
	$fields["CMD_DEFFENDANT3"] 		= 		$POST["cmdDeffendant3"];
	$fields["CMD_PLAINTIFF1"] 		= 		$POST["cmdPlaintiff1"];
	$fields["CMD_PLAINTIFF2"] 		= 		$POST["cmdPlaintiff2"];
	$fields["CMD_PLAINTIFF3"] 		= 		$POST["cmdPlaintiff3"];
	$fields["WF_CMD_DET_STEP"] 		= 		$POST["wfCmdDetStep"];
	$fields["WF_CMD_DET_NEXT"] 		= 		$POST["wfCmdDetNext"];
	$fields["CMD_TIMES"] 			= 		$POST["cmdTimes"];
	$fields["NOTI_CMD_ID"] 			= 		$POST["notiCmdId"];
	$fields["CMD_STEP"] 			= 		$POST["cmdStep"];
	$fields["PERSON_ID"] 			= 		$POST["personId"];
	$fields["LIST_NAME"] 			= 		$POST["listName"];
	$fields["CMD_SYSTEM_ID"] 		= 		$POST["cmdSystemId"];
	$fields["CMD_ANSWER"] 			= 		$POST["cmdAnswer"];
	$fields["SYS_NAME"] 			= 		$POST["sysName"];
	$fields["CMD_TYPE"] 			= 		$POST["cmdType"];
	$fields["CMD_NAME_ORDER"] 		= 		$POST["cmdNameOrder"];
	$fields["STATUS_PERSON"] 		= 		$POST["statusPerson"];
	$fields["SYSTEM_NAME"] 			= 		$POST["systemName"];
	$fields["REF_ID"] 				= 		$POST["refId"];
	$fields["CMD_UPDATE_DATE"] 		= 		$POST["cmdUpdateDate"];
	$fields["CMD_UPDATE_TIME"] 		= 		$POST["cmdUpdateTime"];
	$fields["APPROVE_PERSON"] 		= 		$POST["approvePerson"];
	$fields["APPROVE_PERSON_ID"] 	= 		$POST["approvePersonId"];
	$fields["TO_T_BLACK_CASE"] 		= 		$POST["toTBlackCase"];
	$fields["TO_BLACK_CASE"]		= 		$POST["toBlackCase"];
	$fields["TO_BLACK_YY"] 			= 		$POST["toBlackYy"];
	$fields["TO_T_RED_CASE"] 		= 		$POST["toTRedCase"];
	$fields["TO_RED_CASE"] 			= 		$POST["toRedCase"];
	$fields["TO_RED_YY"] 			= 		$POST["toRedYy"];
	$fields["TO_COURT_CODE"] 		= 		$POST["toCourtCode"];
	$fields["TO_COURT_NAME"] 		= 		$POST["toCourtName"];
	
	// $sqlSelectCase = "	select 	DEFFENDANT1,PLAINTIFF1
						// from 	WH_CIVIL_CASE 
						// where 	PREFIX_BLACK_CASE = '".$POST["toTBlackCase"]."'
								// AND BLACK_CASE = '".$POST["toBlackCase"]."'
								// AND BLACK_YY = '".$POST["toBlackYy"]."'
								// AND PREFIX_RED_CASE = '".$POST["toTRedCase"]."'
								// AND RED_CASE = '".$POST["toRedCase"]."'
								// AND RED_YY = '".$POST["toRedYy"]."'
								// AND COURT_CODE = '".$POST["toCourtCode"]."'";
	// $querySelectCase = db::query($sqlSelectCase);
	// $recSelectCase 	 = db::fetch_array($querySelectCase);
	
	$sqlSelectCourt 		= "select COURT_CODE from M_COURT where COURT_NAME = '".$POST["toCourtName"]."'";
	$querySelectCourt 		= db::query($sqlSelectCourt);
	$recSelectCourt 	 	= db::fetch_array($querySelectCourt);
	
	if($fields["SEND_TO"]==1){
		$sqlSelectCase = "	select 	DEFFENDANT1,PLAINTIFF1
							from 	WH_CIVIL_CASE 
							where 	PREFIX_BLACK_CASE = '".$POST["toTBlackCase"]."'
									AND BLACK_CASE = '".$POST["toBlackCase"]."'
									AND BLACK_YY = '".$POST["toBlackYy"]."'
									AND PREFIX_RED_CASE = '".$POST["toTRedCase"]."'
									AND RED_CASE = '".$POST["toRedCase"]."'
									AND RED_YY = '".$POST["toRedYy"]."'
									AND COURT_CODE = '".$recSelectCourt["COURT_CODE"]."'";
		$querySelectCase = db::query($sqlSelectCase);
		$recSelectCase 	 = db::fetch_array($querySelectCase);
		
		$fields["TO_PERSON_ID"] 		= 		"3920300038603";//$res["sendToPerson"];//*//
	}else if($fields["SEND_TO"]==2){
		
		$sqlSelectCase = "	select 	DEFFENDANT1,PLAINTIFF1
							from 	WH_BANKRUPT_CASE_DETAIL 
							where 	PREFIX_BLACK_CASE = '".$POST["toTBlackCase"]."'
									AND BLACK_CASE = '".$POST["toBlackCase"]."'
									AND BLACK_YY = '".$POST["toBlackYy"]."'
									AND PREFIX_RED_CASE = '".$POST["toTRedCase"]."'
									AND RED_CASE = '".$POST["toRedCase"]."'
									AND RED_YY = '".$POST["toRedYy"]."'";
		$querySelectCase = db::query($sqlSelectCase);
		$recSelectCase 	 = db::fetch_array($querySelectCase);
		
		$fields["TO_PERSON_ID"] 		= 		"3100903272320";//$res["sendToPerson"];//*//
	}else if($fields["SEND_TO"]==3){
		$sqlSelectCase = "	select 	DEFFENDANT1,PLAINTIFF2 as PLAINTIFF1
							from 	WH_REHABILITATION_CASE_DETAIL 
							where 	PREFIX_BLACK_CASE = '".$POST["toTBlackCase"]."'
									AND BLACK_CASE = '".$POST["toBlackCase"]."'
									AND BLACK_YY = '".$POST["toBlackYy"]."'
									AND PREFIX_RED_CASE = '".$POST["toTRedCase"]."'
									AND RED_CASE = '".$POST["toRedCase"]."'
									AND RED_YY = '".$POST["toRedYy"]."'
									AND COURT_CODE = '".$recSelectCourt["COURT_CODE"]."'";
		$querySelectCase = db::query($sqlSelectCase);
		$recSelectCase 	 = db::fetch_array($querySelectCase);
		
		$fields["TO_PERSON_ID"] 		= 		"1103411005612";//$res["sendToPerson"];//*//
	}else if($fields["SEND_TO"]==4){
		$sqlSelectCase = "	select 	DEFENDANT_FNAME as DEFFENDANT1,PLAINTIFF_FNAME as PLAINTIFF1
							from 	WH_MEDIATE_CASE 
							where 	PREFIX_BLACK_CASE = '".$POST["toPrefixBlackCase"]."'
									AND BLACK_CASE = '".$POST["toBlackCase"]."'
									AND BLACK_YY = '".$POST["toBlackYy"]."'
									AND PREFIX_RED_CASE = '".$POST["toPrefixRedCase"]."'
									AND RED_CASE = '".$POST["toRedCase"]."'
									AND RED_YY = '".$POST["toRedYy"]."'
									AND COURT_ID = '".$recSelectCourt["COURT_CODE"]."'";
		$querySelectCase = db::query($sqlSelectCase);
		$recSelectCase 	 = db::fetch_array($querySelectCase);
		
		$fields["TO_PERSON_ID"] 		= 		"1103411005612";//$res["sendToPerson"];//*//
	}
	
	$fields["TO_PLAINTIFF"] 		= 		$recSelectCase["PLAINTIFF1"];
	$fields["TO_DEFENDANT"] 		= 		$recSelectCase["DEFFENDANT1"];
	
	
	//$fields["TO_PERSON_ID"] 		= 		$POST["toPersonId"];
	$fields["CREATE_BY_USERID"] 	= 		$POST["createByUserid"];
	$fields["FINAL_FLAG"] 			= 		$POST["finalFlag"];
	$fields["CIVIL_PERSON_MAP"] 	= 		$POST["civilPersonMap"];
	$fields["CASE_CODE"] 			= 		$POST["caseCode"];
	$fields["UPDATE_BY_USERID"] 	= 		$POST["updateByUserid"];
	$fields["PERSON_CODE"] 			= 		$POST["personCode"];
	$fields["CREATE_BY_PROGID"] 	= 		$POST["createByProgid"];
	$fields["UPDATE_BY_PROGID"] 	= 		$POST["updateByProgid"];
	$fields["RECV_NO"] 				= 		$POST["recvNo"];
	$fields["RECV_YEAR"] 			= 		$POST["recvYear"];
	$fields["ACC_CODE"] 			= 		$POST["accCode"];
	$fields["CENT_DEPT_GEN"] 		= 		$POST["centDeptGen"];
	$fields["CASE_RECV_CODE"] 		= 		$POST["caseRecvCode"];
	$fields["DOSS_CONTROL_CODE"] 	= 		$POST["dossControlCode"];
	$fields["AUD_PRIVATE_CODE"] 	= 		$POST["audPrivateCode"];
	$fields["BRC_ID"] 				= 		$POST["brcId"];
	$fields["SOURCE_CMD_ID"] 		= 		$POST["sourceCmdId"];
	$fields["SOURCE_CMD_PARENT_ID"] = 		$POST["sourceCmdParentId"];
	$fields["APPROVE_STATUS"] 		= 		$POST["approveStatus"];
$CMD_ID = db::db_insert("M_DOC_CMD",$fields,'ID','ID');
	
//รายละเอียดคำสั่ง
unset($fields);
	$fields["CMD_ID"] 	= 	$CMD_ID;
	$fields["CMD_NOTE"] =	$POST["detail"];
db::db_insert("M_CMD_DETAILS",$fields,'CMD_DETAIL_ID','CMD_DETAIL_ID');

//รายการทรัพย์ในคำสั่ง
if(count($POST["asset"])>0){
	foreach($POST["asset"] as $key => $val){
		unset($fields);
			$fields["CMD_ID"] 				= 	$CMD_ID;
			$fields["ASSET_ID"] 			= 	$val["assetId"];
			$fields["PROP_DET"] 			= 	$val["propDet"];
			$fields["TYPE_CODE"] 			= 	$val["typeCode"];
			$fields["TYPE_DESC"] 			= 	$val["typeDesc"];
			$fields["PROP_STATUS"] 			= 	$val["propStatus"];
			$fields["PROP_STATUS_NAME"] 	= 	$val["propStatusName"];
		db::db_insert("M_CMD_ASSET",$fields,'CMD_ASSET_ID','CMD_ASSET_ID');
	}
}

//คนในคำสั่ง
if(count($POST["person"])>0){
	foreach($POST["person"] as $key => $val){
		unset($fields);
			$fields["CMD_ID"] 				= 	$CMD_ID;
			$fields["ID_CARD"] 				= 	$val["idCard"];
			$fields["PREFIX_NAME"] 			= 	$val["prefixName"];
			$fields["FIRST_NAME"] 			= 	$val["firstName"];
			$fields["LAST_NAME"] 			= 	$val["lastName"];
			$fields["FULL_NAME"] 			= 	$val["fullName"];
			$fields["ADDRESS"] 				= 	$val["address"];
			$fields["PHONE"] 				= 	$val["phone"];
			$fields["FAX"] 					= 	$val["fax"];
			$fields["MOBILE"] 				= 	$val["mobile"];
			$fields["EMAIL"] 				= 	$val["email"];
			$fields["PERSON_CMD_TYPE"] 		= 	$POST["cmdType"];
			$fields["PERSON_CASE_TYPE"] 	= 	$POST["cmdNameOrder"];
		db::db_insert("M_CMD_PERSON",$fields,'PERSON_ID','PERSON_ID');
	}
}

//ไฟล์แนบ
if(count($POST["file"])>0){
	foreach($POST["file"] as $key => $val){
				
		$attachid  = random(50);
		$attachid  =  $attachid .  date('dmyhis'); //ต้องต่อ id ของคนล็อกอิน กับวันที่และเวลา ต่อท้ายไฟล์แนบ เพื่อจะไม่ได้ แรนด้อมซ้ำ 

		$datafile  = base64_decode($val['fileData']);
		$h    = fopen("../attach/file_cmd/" . $attachid . '.' . $val["fileType"], "w");
		fwrite($h, $datafile);
		fclose($h);
				
		unset($fields);
			$fields["CMD_ID"] 				= 	$CMD_ID;
			$fields["E_DOCUMENT_NAME"] 		= 	$val["eDocumentName"];
			$fields["FILE_SAVE_NAME"] 		= 	$attachid . '.' . $val["fileType"];
			$fields["TYPE"] 				= 	$val["fileType"];
		db::db_insert("M_CMD_FILE",$fields,'FILE_ID','FILE_ID');
		
	}
}
?>
