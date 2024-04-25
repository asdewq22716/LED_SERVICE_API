<?php
include '../include/include.php';


/* echo "<pre>";
print_r($_POST);
echo "</pre>";
exit; */

if($_POST["proc"]=='add'){
		
	//คำสั่งหลัก
	unset($fields);
		$fields["CMD_DOC_DATE"] 		= 		date2db($_POST["CMD_DOC_DATE"]);
		$fields["CMD_DOC_TIME"] 		= 		$_POST["CMD_DOC_TIME"];
		$fields["COURT_CODE"] 			= 		$_POST["COURT_CODE"];
		$fields["COURT_NAME"] 			= 		getcourtName($_POST["COURT_CODE"]);
		$fields["F_BLACK_CASE"] 		= 		$_POST["T_BLACK_CASE"].$_POST["BLACK_CASE"]."/".$_POST["BLACK_YY"];
		$fields["T_BLACK_CASE"] 		= 		$_POST["T_BLACK_CASE"];
		$fields["BLACK_CASE"] 			= 		$_POST["BLACK_CASE"];
		$fields["BLACK_YY"] 			= 		$_POST["BLACK_YY"];
		
		$fields["F_RED_CASE"] 			= 		$_POST["T_RED_CASE"].$_POST["RED_CASE"]."/".$_POST["RED_YY"];
		$fields["T_RED_CASE"] 			= 		$_POST["T_RED_CASE"];	
		$fields["RED_CASE"] 			= 		$_POST["RED_CASE"];
		$fields["RED_YY"] 				= 		$_POST["RED_YY"];
		
		$fields["SEND_TO"] 				= 		$_POST["SEND_TO"];
		$fields["REF_ID"] 				= 		$_POST["REF_ID"];
		
		$fields["COURT_CODE"] 			= 		$_POST["COURT_CODE"];//ศาล
		
		$fields["CASE_TYPE"] 			= 		$_POST["CASE_TYPE"];
		$fields["CASE_TYPE_NAME"] 		= 		getCaseName($_POST["CASE_TYPE"]);
		
		$fields["SEND_STATUS"] 			= 		0;
		
		$fields["CMD_NOTE"] 			= 		$_POST["CMD_NOTE"];
		
		$fields["OFFICE_IDCARD"] 		= 		$_POST["OFFICE_IDCARD"];
		$fields["OFFICE_NAME"] 			= 		$_POST["OFFICE_NAME"];
			

		$fields["APPROVE_STATUS"] 		= 		0;
		$fields["PLAINTIFF"] 			= 		$_POST["D_C"];
		$fields["DEFENDANT"] 			= 		$_POST["D_NAME"];
		
		$fields["SEND_TO_PERSON"] 		= 		$_POST["sendToPerson"];

		$fields["CMD_READ_STATUS"] 		= 		0;
		$fields["CMD_DETAIL"] 			= 		$_POST["CMD_NOTE"];

		
		$fields["CMD_SYSTEM"] 			= 		$_POST["SYSTEM_ID"];
		$fields["CMD_SYSTEM_ID"] 		= 		$_POST["SYSTEM_ID"];
		$fields["SYSTEM_NAME"] 			= 		getsystemName($_POST["SYSTEM_ID"]);	
		$fields["SYS_NAME"] 			= 		$_POST["SYSTEM_ID"];
		
		$fields["CMD_TYPE"] 			= 		$_POST["CMD_TYPE"];
		//$fields["CMD_NAME_ORDER"] 		= 		getCmdName($_POST["CMD_TYPE"]);
		

		
		$fields["APPROVE_PERSON"] 		= 		$_POST["APPROVE_PERSON"];
		$fields["APPROVE_STATUS"] 		= 		0;
		
		$fields["TO_T_BLACK_CASE"] 		= 		$_POST["TO_T_BLACK_CASE"];
		$fields["TO_BLACK_CASE"]		= 		$_POST["TO_BLACK_CASE"];
		$fields["TO_BLACK_YY"] 			= 		$_POST["TO_BLACK_YY"];
		
		$fields["TO_T_RED_CASE"] 		= 		$_POST["TO_T_RED_CASE"];
		$fields["TO_RED_CASE"] 			= 		$_POST["TO_RED_CASE"];
		$fields["TO_RED_YY"] 			= 		$_POST["TO_RED_YY"];
		
		$fields["TO_COURT_CODE"] 		= 		$_POST["TO_COURT_CODE"];
		$fields["TO_COURT_NAME"] 		= 		getcourtName($_POST["TO_COURT_CODE"]);
		
		$fields["TO_PLAINTIFF"] 		= 		$_POST["TO_PLAINTIFF"];
		$fields["TO_DEFENDANT"] 		= 		$_POST["TO_DEFENDANT"];
		
		$fields["PCC_CASE_GEN"] 		= 		$_POST["PCC_CASE_GEN"];
		$fields["CMD_MANUAL_STATUS"] 	= 		$_POST["CMD_MANUAL_STATUS"];
		$fields["GET_PER_TYPE"] 		= 		$_POST["GET_PER_TYPE"];
		
		$filter = "";
		if($_POST["T_BLACK_CASE"]!=""){
			$filter .= " and PREFIX_BLACK_CASE = '".$_POST['T_BLACK_CASE']."'	";
		}
		if($_POST["BLACK_CASE"]!=""){
			$filter .= " and BLACK_CASE = '".$_POST['BLACK_CASE']."'	";
		}
		if($_POST["BLACK_YY"]!=""){
			$filter .= " and BLACK_YY = '".$_POST['BLACK_YY']."'	";
		}
		if($_POST["T_RED_CASE"]!=""){
			$filter .= " and PREFIX_RED_CASE = '".$_POST['T_RED_CASE']."'	";
		}
		if($_POST["RED_CASE"]!=""){
			$filter .= " and RED_CASE = '".$_POST['RED_CASE']."'	";
		}
		if($_POST["RED_YY"]!=""){
			$filter .= " and RED_YY = '".$_POST['RED_YY']."'	";
		}
		if($_POST["TO_COURT_CODE"]!=""){
			if($_POST["SEND_TO"]==4){//ระบบงานไกล่เกลี่ยข้อพิพาท
				$filter .= " and COURT_ID = '".$_POST['TO_COURT_CODE']."'	";
			}else if($_POST["SEND_TO"]==2){
				$filter .= " and COURT_CODE = '010030'	";
			}else{
				$filter .= " and COURT_CODE = '".$_POST['TO_COURT_CODE']."'	";
			}
		}
		if($_REQUEST["REF_ID"]>0){
			
			$filterTo = "";
			if($_POST["TO_T_BLACK_CASE"]!=""){
				$filterTo .= " and PREFIX_BLACK_CASE = '".$_POST['TO_T_BLACK_CASE']."'	";
			}
			if($_POST["TO_BLACK_CASE"]!=""){
				$filterTo .= " and BLACK_CASE = '".$_POST['TO_BLACK_CASE']."'	";
			}
			if($_POST["TO_BLACK_YY"]!=""){
				$filterTo .= " and BLACK_YY = '".$_POST['TO_BLACK_YY']."'	";
			}
			if($_POST["TO_T_RED_CASE"]!=""){
				$filterTo .= " and PREFIX_RED_CASE = '".$_POST['TO_T_RED_CASE']."'	";
			}
			if($_POST["TO_RED_CASE"]!=""){
				$filterTo .= " and RED_CASE = '".$_POST['TO_RED_CASE']."'	";
			}
			if($_POST["TO_RED_YY"]!=""){
				$filterTo .= " and RED_YY = '".$_POST['TO_RED_YY']."'	";
			}
			if($_POST["TO_COURT_CODE"]!=""){
				if($_POST["SEND_TO"]==4){//ระบบงานไกล่เกลี่ยข้อพิพาท
					$filterTo .= " and COURT_ID = '".$_POST['TO_COURT_CODE']."'	";
				}else if($_POST["SEND_TO"]==2){
					$filterTo .= " and COURT_CODE = '010030'	";
				}else{
					$filterTo .= " and COURT_CODE = '".$_POST['TO_COURT_CODE']."'	";
				}
			}
			
			if($_POST["DOSS_OWNER_ID"]==""){
				if($_POST["SEND_TO"]==1){//ระบบงานบังคับคดีแพ่ง
					$sqlSelectData = "	select 		DOSS_OWNER_ID
										from 		WH_CIVIL_CASE a 
										inner join 	WH_CIVIL_DOSS b on a.WH_CIVIL_ID = b.WH_CIVIL_ID
										where		1=1 {$filterTo}";
				}else if($_POST["SEND_TO"]==2){//ระบบงานบังคับคดีล้มละลาย
					$sqlSelectData = "	select 	DOSS_OWNER_ID
										from 	WH_BANKRUPT_CASE_DETAIL
										where	1=1 {$filterTo}	";
				}else if($_POST["SEND_TO"]==3){//ระบบงานฟื้นฟูกิจการของลูกหนี้
					$sqlSelectData = "	select 	PLAINTIFF2 as PLAINTIFF,DEFFENDANT1 as DEFFENDANT
										from 	WH_REHABILITATION_CASE_DETAIL
										where	1=1 {$filterTo}	";
				}else if($_POST["SEND_TO"]==4){//ระบบงานไกล่เกลี่ยข้อพิพาท
					$sqlSelectData = "
										select 	PLAINTIFF_FNAME as PLAINTIFF,DEFENDANT_FNAME as DEFFENDANT
										from 	WH_MEDIATE_CASE
										where	1=1 	{$filterTo}	";
				}
				// echo $sqlSelectData;
				// exit();
				$querySelectData = db::query($sqlSelectData);
				$recSelectData = db::fetch_array($querySelectData);
				
				$fields["TO_PERSON_ID"] 		= 		$recSelectData["DOSS_OWNER_ID"];
				
			}else{
				$fields["TO_PERSON_ID"] 		= 		$_POST["DOSS_OWNER_ID"];
			}
		}else{
			if($_POST["SEND_TO"]==1){//ระบบงานบังคับคดีแพ่ง
				$sqlSelectData = "	select 		DOSS_OWNER_ID
									from 		WH_CIVIL_CASE a 
									inner join 	WH_CIVIL_DOSS b on a.WH_CIVIL_ID = b.WH_CIVIL_ID
									where		1=1 {$filter}";
			}else if($_POST["SEND_TO"]==2){//ระบบงานบังคับคดีล้มละลาย
				$sqlSelectData = "	select 	DOSS_OWNER_ID
									from 	WH_BANKRUPT_CASE_DETAIL
									where	1=1 {$filter}	";
			}else if($_POST["SEND_TO"]==3){//ระบบงานฟื้นฟูกิจการของลูกหนี้
				$sqlSelectData = "	select 	PLAINTIFF2 as PLAINTIFF,DEFFENDANT1 as DEFFENDANT
									from 	WH_REHABILITATION_CASE_DETAIL
									where	1=1 {$filter}	";
			}else if($_POST["SEND_TO"]==4){//ระบบงานไกล่เกลี่ยข้อพิพาท
				$sqlSelectData = "
									select 	PLAINTIFF_FNAME as PLAINTIFF,DEFENDANT_FNAME as DEFFENDANT
									from 	WH_MEDIATE_CASE
									where	1=1 	{$filter}	";
			}
			$querySelectData = db::query($sqlSelectData);
			$recSelectData = db::fetch_array($querySelectData);
			
			if($_POST["SEND_TO"]==2){
				$recSelectData["DOSS_OWNER_ID"] = "3100903272320";
			}else if($_POST["SEND_TO"]==3){
				$recSelectData["DOSS_OWNER_ID"] = "1103411005612";
			}else if($_POST["SEND_TO"]==4){
				$recSelectData["DOSS_OWNER_ID"] = "1103411005612";
			}else{
				$recSelectData["DOSS_OWNER_ID"] = "3920300038603";
			}
			
			$fields["TO_PERSON_ID"] 		= 		$recSelectData["DOSS_OWNER_ID"];//$_POST["TO_PERSON_ID"];
		}
		
		$fields["CMD_FIX_DATE_STATUS"] = $_POST["CMD_FIX_DATE_STATUS"];
		if($_POST["CMD_FIX_DATE_STATUS"]=='Y'){
			$fields["CMD_FIX_DOC_DATE"] = date2db($_POST["CMD_FIX_DOC_DATE"]);
		}
		
	
	$CMD_ID = db::db_insert("M_DOC_CMD",$fields,'ID','ID');
		
	//รายละเอียดคำสั่ง
	unset($fields);
		$fields["CMD_ID"] 	= 	$CMD_ID;
		$fields["CMD_NOTE"] =	$_POST["CMD_NOTE"];
	db::db_insert("M_CMD_DETAILS",$fields,'CMD_DETAIL_ID','CMD_DETAIL_ID');

	//รายการทรัพย์ในคำสั่ง
	if(count($_POST["ASSET_ID"])>0){
		foreach($_POST["ASSET_ID"] as $key => $val){
			unset($fields);
				$fields["CMD_ID"] 				= 	$CMD_ID;
				$fields["ASSET_ID"] 			= 	$val;
				$fields["PROP_DET"] 			= 	$_POST["PROP_TITLE"][$key];
				$fields["TYPE_CODE"] 			= 	$_POST["TYPE_CODE"][$key];
				$fields["TYPE_DESC"] 			= 	$_POST["TYPE_DESC"][$key];
				$fields["PROP_STATUS"] 			= 	$_POST["PROP_STATUS"][$key];
				$fields["PROP_STATUS_NAME"] 	= 	$_POST["PROP_STATUS_NAME"][$key];
				$fields["CFC_CAPTION_GEN"] 		= 	$_POST["CFC_CAPTION_GEN"][$key];
				$fields["ASSET_CMD_TYPE"] 		= 	$_POST["CMD_TYPE"][$key];
				$fields["ASSET_CASE_TYPE"] 		= 	$_POST["CASE_TYPE"][$key];
			db::db_insert("M_CMD_ASSET",$fields,'CMD_ASSET_ID','CMD_ASSET_ID');
		}
	}

	//คนในคำสั่ง
	if(count($_POST["LIST_REGISTER_CODE"])>0){
		foreach($_POST["LIST_REGISTER_CODE"] as $key => $val){
			unset($fields);
				$fields["CMD_ID"] 				= 	$CMD_ID;
				$fields["ID_CARD"] 				= 	$val;
				$fields["PREFIX_NAME"] 			= 	$_POST["GET_PREFIX_NAME"][$val];
				$fields["FIRST_NAME"] 			= 	$_POST["GET_FIRST_NAME"][$val];
				$fields["LAST_NAME"] 			= 	$_POST["GET_LAST_NAME"][$val];
				$fields["FULL_NAME"] 			= 	$_POST["GET_PREFIX_NAME"][$val].$_POST["GET_FIRST_NAME"][$val]." ".$_POST["GET_LAST_NAME"][$val];
				$fields["ADDRESS"] 				= 	$val["address"];
				$fields["PHONE"] 				= 	$val["phone"];
				$fields["FAX"] 					= 	$val["fax"];
				$fields["MOBILE"] 				= 	$val["mobile"];
				$fields["EMAIL"] 				= 	$val["email"];
				$fields["PERSON_CMD_TYPE"] 		= 	$_POST["CMD_TYPE_PERSON"][$key];
				$fields["PERSON_CASE_TYPE"] 	= 	$_POST["CASE_TYPE_PERSON"][$key];
			db::db_insert("M_CMD_PERSON",$fields,'PERSON_ID','PERSON_ID');
		}
	}


	db::query("UPDATE FRM_CMD_FILE SET WFR_ID = ".$CMD_ID." WHERE WFR_ID = '".$_POST["attachid"]."' ");
	
	getDataToWhAlert($_POST["APPROVE_PERSON"]);

}else if($_POST["proc"]=='edit'){
		//คำสั่งหลัก
	unset($fields);
		$fields["CMD_DOC_DATE"] 		= 		date2db($_POST["CMD_DOC_DATE"]);
		$fields["CMD_DOC_TIME"] 		= 		$_POST["CMD_DOC_TIME"];
		$fields["COURT_CODE"] 			= 		$_POST["COURT_CODE"];
		$fields["COURT_NAME"] 			= 		getcourtName($_POST["COURT_CODE"]);
		$fields["F_BLACK_CASE"] 		= 		$_POST["T_BLACK_CASE"].$_POST["BLACK_CASE"]."/".$_POST["BLACK_YY"];
		$fields["T_BLACK_CASE"] 		= 		$_POST["T_BLACK_CASE"];
		$fields["BLACK_CASE"] 			= 		$_POST["BLACK_CASE"];
		$fields["BLACK_YY"] 			= 		$_POST["BLACK_YY"];
		
		$fields["F_RED_CASE"] 			= 		$_POST["T_RED_CASE"].$_POST["RED_CASE"]."/".$_POST["RED_YY"];
		$fields["T_RED_CASE"] 			= 		$_POST["T_RED_CASE"];	
		$fields["RED_CASE"] 			= 		$_POST["RED_CASE"];
		$fields["RED_YY"] 				= 		$_POST["RED_YY"];
		
		$fields["SEND_TO"] 				= 		$_POST["SEND_TO"];
		$fields["REF_ID"] 				= 		$_POST["REF_ID"];
		
		$fields["COURT_CODE"] 			= 		$_POST["COURT_CODE"];//ศาล
		
		$fields["CASE_TYPE"] 			= 		$_POST["CASE_TYPE"];
		$fields["CASE_TYPE_NAME"] 		= 		getCaseName($_POST["CASE_TYPE"]);
		
		$fields["SEND_STATUS"] 			= 		0;
		
		$fields["CMD_NOTE"] 			= 		$_POST["CMD_NOTE"];
		
		$fields["OFFICE_IDCARD"] 		= 		$_POST["OFFICE_IDCARD"];
		$fields["OFFICE_NAME"] 			= 		$_POST["OFFICE_NAME"];
			

		$fields["APPROVE_STATUS"] 		= 		0;
		$fields["PLAINTIFF"] 			= 		$_POST["D_C"];
		$fields["DEFENDANT"] 			= 		$_POST["D_NAME"];
		
		$fields["SEND_TO_PERSON"] 		= 		$_POST["sendToPerson"];

		$fields["CMD_READ_STATUS"] 		= 		0;
		$fields["CMD_DETAIL"] 			= 		$_POST["CMD_NOTE"];

		
		$fields["CMD_SYSTEM"] 			= 		$_POST["SYSTEM_ID"];
		$fields["CMD_SYSTEM_ID"] 		= 		$_POST["SYSTEM_ID"];
		$fields["SYSTEM_NAME"] 			= 		getsystemName($_POST["SYSTEM_ID"]);	
		$fields["SYS_NAME"] 			= 		$_POST["SYSTEM_ID"];
		
		$fields["CMD_TYPE"] 			= 		$_POST["CMD_TYPE"];
		//$fields["CMD_NAME_ORDER"] 		= 		getCmdName($_POST["CMD_TYPE"]);
		

		
		$fields["APPROVE_PERSON"] 		= 		$_POST["APPROVE_PERSON"];
		$fields["APPROVE_STATUS"] 		= 		0;
		
		$fields["TO_T_BLACK_CASE"] 		= 		$_POST["TO_T_BLACK_CASE"];
		$fields["TO_BLACK_CASE"]		= 		$_POST["TO_BLACK_CASE"];
		$fields["TO_BLACK_YY"] 			= 		$_POST["TO_BLACK_YY"];
		
		$fields["TO_T_RED_CASE"] 		= 		$_POST["TO_T_RED_CASE"];
		$fields["TO_RED_CASE"] 			= 		$_POST["TO_RED_CASE"];
		$fields["TO_RED_YY"] 			= 		$_POST["TO_RED_YY"];
		
		$fields["TO_COURT_CODE"] 		= 		$_POST["TO_COURT_CODE"];
		$fields["TO_COURT_NAME"] 		= 		getcourtName($_POST["TO_COURT_CODE"]);
		
		$fields["TO_PLAINTIFF"] 		= 		$_POST["TO_PLAINTIFF"];
		$fields["TO_DEFENDANT"] 		= 		$_POST["TO_DEFENDANT"];
		
		$fields["CMD_MANUAL_STATUS"] 	= 		$_POST["CMD_MANUAL_STATUS"];
		
		
		
		$filter = "";
		if($_POST["T_BLACK_CASE"]!=""){
			$filter .= " and PREFIX_BLACK_CASE = '".$_POST['T_BLACK_CASE']."'	";
		}
		if($_POST["BLACK_CASE"]!=""){
			$filter .= " and BLACK_CASE = '".$_POST['BLACK_CASE']."'	";
		}
		if($_POST["BLACK_YY"]!=""){
			$filter .= " and BLACK_YY = '".$_POST['BLACK_YY']."'	";
		}
		if($_POST["T_RED_CASE"]!=""){
			$filter .= " and PREFIX_RED_CASE = '".$_POST['T_RED_CASE']."'	";
		}
		if($_POST["RED_CASE"]!=""){
			$filter .= " and RED_CASE = '".$_POST['RED_CASE']."'	";
		}
		if($_POST["RED_YY"]!=""){
			$filter .= " and RED_YY = '".$_POST['RED_YY']."'	";
		}
		if($_POST["TO_COURT_CODE"]!=""){
			if($_POST["SEND_TO"]==4){//ระบบงานไกล่เกลี่ยข้อพิพาท
				$filter .= " and COURT_ID = '".$_POST['TO_COURT_CODE']."'	";
			}else if($_POST["SEND_TO"]==2){
				$filter .= " and COURT_CODE = '010030'	";
			}else{
				$filter .= " and COURT_CODE = '".$_POST['TO_COURT_CODE']."'	";
			}
		}
		if($_REQUEST["REF_ID"]>0){
			$fields["TO_PERSON_ID"] 		= 		$_POST["DOSS_OWNER_ID"];
		}else{
			if($_POST["SEND_TO"]==1){//ระบบงานบังคับคดีแพ่ง
				$sqlSelectData = "	select 		DOSS_OWNER_ID
									from 		WH_CIVIL_CASE a 
									inner join 	WH_CIVIL_DOSS b on a.WH_CIVIL_ID = b.WH_CIVIL_ID
									where		1=1 {$filter}";
			}else if($_POST["SEND_TO"]==2){//ระบบงานบังคับคดีล้มละลาย
				$sqlSelectData = "	select 	DOSS_OWNER_ID
									from 	WH_BANKRUPT_CASE_DETAIL
									where	1=1 {$filter}	";
			}else if($_POST["SEND_TO"]==3){//ระบบงานฟื้นฟูกิจการของลูกหนี้
				$sqlSelectData = "	select 	PLAINTIFF2 as PLAINTIFF,DEFFENDANT1 as DEFFENDANT
									from 	WH_REHABILITATION_CASE_DETAIL
									where	1=1 {$filter}	";
			}else if($_POST["SEND_TO"]==4){//ระบบงานไกล่เกลี่ยข้อพิพาท
				$sqlSelectData = "
									select 	PLAINTIFF_FNAME as PLAINTIFF,DEFENDANT_FNAME as DEFFENDANT
									from 	WH_MEDIATE_CASE
									where	1=1 	{$filter}	";
			}
			$querySelectData = db::query($sqlSelectData);
			$recSelectData = db::fetch_array($querySelectData);
			
			if($_POST["SEND_TO"]==2){
				$recSelectData["DOSS_OWNER_ID"] = "3100903272320";
			}
			
			$fields["TO_PERSON_ID"] 		= 		$recSelectData["DOSS_OWNER_ID"];//$_POST["TO_PERSON_ID"];
		}
		
		$fields["CMD_FIX_DATE_STATUS"] = $_POST["CMD_FIX_DATE_STATUS"];
		if($_POST["CMD_FIX_DATE_STATUS"]=='Y'){
			$fields["CMD_FIX_DOC_DATE"] = date2db($_POST["CMD_FIX_DOC_DATE"]);
		}else{
			$fields["CMD_FIX_DOC_DATE"] = NULL;
		}
		
		
	db::db_update("M_DOC_CMD",$fields,array('ID'=>$_POST["CMD_ID"]));
	
	
	//รายละเอียดคำสั่ง
	db::db_delete("M_CMD_DETAILS", array('CMD_ID'=>$_POST["CMD_ID"]));
	unset($fields);
		$fields["CMD_ID"] 	= 	$_POST["CMD_ID"];
		$fields["CMD_NOTE"] =	$_POST["CMD_NOTE"];
	db::db_insert("M_CMD_DETAILS",$fields,'CMD_DETAIL_ID','CMD_DETAIL_ID');
	
	//รายการทรัพย์ในคำสั่ง
	db::db_delete("M_CMD_ASSET", array('CMD_ID'=>$_POST["CMD_ID"]));
	//รายการทรัพย์ในคำสั่ง
	if(count($_POST["ASSET_ID"])>0){
		foreach($_POST["ASSET_ID"] as $key => $val){
			unset($fields);
				$fields["CMD_ID"] 				= 	$_POST["CMD_ID"];
				$fields["ASSET_ID"] 			= 	$val;
				$fields["PROP_DET"] 			= 	$_POST["PROP_TITLE"][$key];
				$fields["TYPE_CODE"] 			= 	$_POST["TYPE_CODE"][$key];
				$fields["TYPE_DESC"] 			= 	$_POST["TYPE_DESC"][$key];
				$fields["PROP_STATUS"] 			= 	$_POST["PROP_STATUS"][$key];
				$fields["PROP_STATUS_NAME"] 	= 	$_POST["PROP_STATUS_NAME"][$key];
				$fields["CFC_CAPTION_GEN"] 		= 	$_POST["CFC_CAPTION_GEN"][$key];
				$fields["ASSET_CMD_TYPE"] 		= 	$_POST["CMD_TYPE"][$key];
				$fields["ASSET_CASE_TYPE"] 		= 	$_POST["CASE_TYPE"][$key];
			db::db_insert("M_CMD_ASSET",$fields,'CMD_ASSET_ID','CMD_ASSET_ID');
		}
	}

	//คนในคำสั่ง
	db::db_delete("M_CMD_PERSON", array('CMD_ID'=>$_POST["CMD_ID"]));
	//คนในคำสั่ง
	if(count($_POST["LIST_REGISTER_CODE"])>0){
		foreach($_POST["LIST_REGISTER_CODE"] as $key => $val){
			unset($fields);
				$fields["CMD_ID"] 				= 	$_POST["CMD_ID"];
				$fields["ID_CARD"] 				= 	$val;
				$fields["PREFIX_NAME"] 			= 	$_POST["GET_PREFIX_NAME"][$val];
				$fields["FIRST_NAME"] 			= 	$_POST["GET_FIRST_NAME"][$val];
				$fields["LAST_NAME"] 			= 	$_POST["GET_LAST_NAME"][$val];
				$fields["FULL_NAME"] 			= 	$_POST["GET_PREFIX_NAME"][$val].$_POST["GET_FIRST_NAME"][$val]." ".$_POST["GET_LAST_NAME"][$val];
				$fields["ADDRESS"] 				= 	$val["address"];
				$fields["PHONE"] 				= 	$val["phone"];
				$fields["FAX"] 					= 	$val["fax"];
				$fields["MOBILE"] 				= 	$val["mobile"];
				$fields["EMAIL"] 				= 	$val["email"];
				$fields["PERSON_CMD_TYPE"] 		= 	$_POST["CMD_TYPE_PERSON"][$key];
				$fields["PERSON_CASE_TYPE"] 	= 	$_POST["CASE_TYPE_PERSON"][$key];
			db::db_insert("M_CMD_PERSON",$fields,'PERSON_ID','PERSON_ID');
		}
	}


	db::query("UPDATE FRM_CMD_FILE SET WFR_ID = ".$_POST["CMD_ID"]." WHERE WFR_ID = '".$_POST["attachid"]."' ");
	
	getDataToWhAlert($_POST["APPROVE_PERSON"]);
	
}elseif($_POST["proc"]=='delete'){
	db::db_delete("M_DOC_CMD", array('ID'=>$_POST["CMD_ID"]));
	db::db_delete("M_CMD_ASSET", array('CMD_ID'=>$_POST["CMD_ID"]));
	db::db_delete("M_CMD_PERSON", array('CMD_ID'=>$_POST["CMD_ID"]));
	db::db_delete("M_CMD_DETAILS", array('CMD_ID'=>$_POST["CMD_ID"]));
}

?>
<script type="text/javascript">
	self.location.href='show_cmd_disp.php?SEND_TO=<?php echo $_POST["HIDDEN_SEND_TO"];?>&TO_PERSON_ID=<?php echo $_POST["HIDDEN_TO_PERSON_ID"];?>';
</script>