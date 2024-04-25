<?php
include "../include/config.php";

$sqlselectData = "select * from VIEW_PERSON_PAY_DUE";
$querySelectData = db::query($sqlselectData);
while($recSelectData = db::fetch_array($querySelectData)){
	
	if($recSelectData["CASE_TYPE"]==1){//ระบบงานฟื้นฟูกิจการของลูกหนี้
		$sqlSelectDataCase = "	select 	PLAINTIFF2 as PLAINTIFF,DEFFENDANT1 as DEFFENDANT
								from 	WH_REHABILITATION_CASE_DETAIL
								where	1=1 AND WH_REHAB_ID = '".$recSelectData["WFR_ID_PK"]."' ";								
	}else if($recSelectData["CASE_TYPE"]==2){//ระบบงานบังคับคดีล้มละลาย	
		$sqlSelectDataCase = "	select 	PLAINTIFF1 as PLAINTIFF,DEFFENDANT1 as DEFFENDANT
								from 	WH_BANKRUPT_CASE_DETAIL
								where	1=1 AND WH_BANKRUPT_ID = '".$recSelectData["WFR_ID_PK"]."'";								
	}
	$querySelectDataCase = db::query($sqlSelectDataCase);
	$recSelectDataCase = db::fetch_array($querySelectDataCase);
	
	//คำสั่งหลัก
	unset($fields);
		$fields["CMD_DOC_DATE"] 		= 		date('Y-m-d');
		$fields["CMD_DOC_TIME"] 		= 		date('H:i:s');
		
		$fields["COURT_CODE"] 			= 		$recSelectData["COURT_CODE"];
		$fields["COURT_NAME"] 			= 		$recSelectData["COURT_NAME"];
		
		$fields["F_BLACK_CASE"] 		= 		$recSelectData["PREFIX_BLACK_CASE"].$recSelectData["BLACK_CASE"]."/".$recSelectData["BLACK_YY"];
		$fields["T_BLACK_CASE"] 		= 		$recSelectData["PREFIX_BLACK_CASE"];
		$fields["BLACK_CASE"] 			= 		$recSelectData["BLACK_CASE"];
		$fields["BLACK_YY"] 			= 		$recSelectData["BLACK_YY"];	
		
		$fields["F_RED_CASE"] 			= 		$recSelectData["PREFIX_RED_CASE"].$recSelectData["RED_CASE"]."/".$recSelectData["RED_YY"];
		$fields["T_RED_CASE"] 			= 		$recSelectData["PREFIX_RED_CASE"];
		$fields["RED_CASE"] 			= 		$recSelectData["RED_CASE"];
		$fields["RED_YY"] 				= 		$recSelectData["RED_YY"];
		
		$fields["CASE_TYPE"] 			= 		'99000';
		$fields["CASE_TYPE_NAME"] 		= 		'แจ้งเตือนครบกำหนดยื่นคำขอรับชำระหนี้';	
		
		$fields["SEND_STATUS"] 			= 		0;	
		
		$fields["CMD_NOTE"] 			= 		'แจ้งเตือนครบกำหนดยื่นคำขอรับชำระหนี้ หมายเลขดำที่ '.$fields["F_BLACK_CASE"].' คดีหมายเลขแดงที่ '.$fields["F_RED_CASE"].' ครบกำหนดยื่นคำขอรับชำระหนี้วันที่ '.db2date($recSelectData["COMP_PAY_DEPT_DATE"]);		
		
		$fields["APPROVE_STATUS"] 		= 		1;

		$fields["PLAINTIFF"] 			= 		$recSelectDataCase["PLAINTIFF"];
		$fields["DEFENDANT"] 			= 		$recSelectDataCase["DEFFENDANT"];
		
		$fields["CMD_READ_STATUS"] 		= 		0;
		$fields["CMD_DETAIL"] 			= 		$fields["CMD_NOTE"];
		$fields["CMD_SYSTEM"] 			= 		($recSelectData["CASE_TYPE"]==1)?3:2;
		$fields["CMD_SYSTEM_ID"] 		= 		($recSelectData["CASE_TYPE"]==1)?3:2;
		$fields["SYSTEM_NAME"] 			= 		'ระบบงานฟื้นฟูกิจการของลูกหนี้';
		$fields["SYS_NAME"] 			= 		($recSelectData["CASE_TYPE"]==1)?3:2;
		$fields["CMD_TYPE"] 			= 		20;			
		
				
		//ฟื้นฟู
		$fields["PCC_CASE_GEN"] 		= 		'';
		$sqlSelectReh = "	select 		a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE
							from 		WH_REHABILITATION_PERSON a
							where 		1=1 
										AND REGISTER_CODE = '".$recSelectData["REGISTER_CODE"]."'
							order by 	CONCERN_CODE asc";		
		$querySelectReh = db::query($sqlSelectReh);
		while($recSelectReh = db::fetch_array($querySelectReh)){
			
			$sqlSelectDataCase = "	select 		PLAINTIFF2 as PLAINTIFF,DEFFENDANT1 as DEFFENDANT,'' as DOSS_OWNER_ID,'' as PCC_CASE_GEN
									from 		WH_REHABILITATION_CASE_DETAIL a 
									where		1=1
												AND PREFIX_BLACK_CASE = '".$recSelectReh["PREFIX_BLACK_CASE"]."'
												AND BLACK_CASE = '".$recSelectReh["BLACK_CASE"]."'
												AND BLACK_YY = '".$recSelectReh["BLACK_YY"]."'
												AND PREFIX_RED_CASE = '".$recSelectReh["PREFIX_RED_CASE"]."'
												AND RED_CASE = '".$recSelectReh["RED_CASE"]."'
												AND RED_YY = '".$recSelectReh["RED_YY"]."'
												AND COURT_CODE = '".$recSelectReh["COURT_CODE"]."'";
			$querySelectDataCase = db::query($sqlSelectDataCase);
			$recSelectDataCase 	= db::fetch_array($querySelectDataCase);
					
			$fields["TO_T_BLACK_CASE"] 		= 		$recSelectReh["PREFIX_BLACK_CASE"];
			$fields["TO_BLACK_CASE"]		= 		$recSelectReh["BLACK_CASE"];
			$fields["TO_BLACK_YY"] 			= 		$recSelectReh["BLACK_YY"];			
			$fields["TO_T_RED_CASE"] 		= 		$recSelectReh["PREFIX_RED_CASE"];
			$fields["TO_RED_CASE"] 			= 		$recSelectReh["RED_CASE"];
			$fields["TO_RED_YY"] 			= 		$recSelectReh["RED_YY"];			
			$fields["TO_COURT_CODE"] 		= 		$recSelectReh["COURT_CODE"];
			$fields["TO_COURT_NAME"] 		= 		$recSelectReh["COURT_NAME"];
			
			$fields["TO_PLAINTIFF"] 		= 		$recSelectDataCase["PLAINTIFF"];
			$fields["TO_DEFENDANT"] 		= 		$recSelectDataCase["DEFFENDANT"];			
			$fields["TO_PERSON_ID"] 		= 		$recSelectDataCase["DOSS_OWNER_ID"];
			$fields["PCC_CASE_GEN"] 		= 		$recSelectDataCase["PCC_CASE_GEN"];
			$fields["SEND_TO"] 				= 		3;
			
			$CMD_ID = db::db_insert("M_DOC_CMD",$fields,'ID','ID');
		
			//รายละเอียดคำสั่ง
			unset($fieldsDeatil);
				$fieldsDeatil["CMD_ID"] 	= 	$CMD_ID;
				$fieldsDeatil["CMD_NOTE"]   =	$fields["CMD_NOTE"];
			db::db_insert("M_CMD_DETAILS",$fieldsDeatil,'CMD_DETAIL_ID','CMD_DETAIL_ID');
			
			unset($fieldsPerson);
				$fieldsPerson["CMD_ID"] 				= 	$CMD_ID;
				$fieldsPerson["ID_CARD"] 				= 	$recSelectData["REGISTER_CODE"];
				$fieldsPerson["PREFIX_NAME"] 			= 	$recSelectData["PREFIX_NAME"];
				$fieldsPerson["FIRST_NAME"] 			= 	$recSelectData["FIRST_NAME"];
				$fieldsPerson["LAST_NAME"] 				= 	$recSelectData["LAST_NAME"];
				$fieldsPerson["FULL_NAME"] 				= 	$recSelectData["FULL_NAME"];
				$fieldsPerson["PERSON_CMD_TYPE"] 		= 	20;
				$fieldsPerson["PERSON_CASE_TYPE"] 		= 	'99000';
			db::db_insert("M_CMD_PERSON",$fieldsPerson,'PERSON_ID','PERSON_ID');
			
		}
		
		//ล้มละลาย
		$fields["PCC_CASE_GEN"] 		= 		'';
		$sqlSelectBan = "	select 		a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE
							from 		WH_BANKRUPT_CASE_PERSON a
							where 		1=1 
										AND REGISTER_CODE = '".$recSelectData["REGISTER_CODE"]."'
							order by 	CONCERN_CODE asc";		
		$querySelectBan = db::query($sqlSelectBan);
		while($recSelectBan = db::fetch_array($querySelectBan)){
			
			$sqlSelectDataCase = "	select 		PLAINTIFF1 as PLAINTIFF,DEFFENDANT1 as DEFFENDANT,'' as DOSS_OWNER_ID,'' as PCC_CASE_GEN
									from 		WH_BANKRUPT_CASE_DETAIL a 
									where		1=1
												AND PREFIX_BLACK_CASE = '".$recSelectBan["PREFIX_BLACK_CASE"]."'
												AND BLACK_CASE = '".$recSelectBan["BLACK_CASE"]."'
												AND BLACK_YY = '".$recSelectBan["BLACK_YY"]."'
												AND PREFIX_RED_CASE = '".$recSelectBan["PREFIX_RED_CASE"]."'
												AND RED_CASE = '".$recSelectBan["RED_CASE"]."'
												AND RED_YY = '".$recSelectBan["RED_YY"]."'
												AND COURT_CODE = '".$recSelectBan["COURT_CODE"]."'";
			$querySelectDataCase = db::query($sqlSelectDataCase);
			$recSelectDataCase 	= db::fetch_array($querySelectDataCase);
					
			$fields["TO_T_BLACK_CASE"] 		= 		$recSelectBan["PREFIX_BLACK_CASE"];
			$fields["TO_BLACK_CASE"]		= 		$recSelectBan["BLACK_CASE"];
			$fields["TO_BLACK_YY"] 			= 		$recSelectBan["BLACK_YY"];			
			$fields["TO_T_RED_CASE"] 		= 		$recSelectBan["PREFIX_RED_CASE"];
			$fields["TO_RED_CASE"] 			= 		$recSelectBan["RED_CASE"];
			$fields["TO_RED_YY"] 			= 		$recSelectBan["RED_YY"];			
			$fields["TO_COURT_CODE"] 		= 		$recSelectBan["COURT_CODE"];
			$fields["TO_COURT_NAME"] 		= 		$recSelectBan["COURT_NAME"];
			
			$fields["TO_PLAINTIFF"] 		= 		$recSelectDataCase["PLAINTIFF"];
			$fields["TO_DEFENDANT"] 		= 		$recSelectDataCase["DEFFENDANT"];			
			$fields["TO_PERSON_ID"] 		= 		'3100903272320';//$recSelectDataCase["DOSS_OWNER_ID"];
			$fields["SEND_TO"] 				= 		2;
			
			$CMD_ID = db::db_insert("M_DOC_CMD",$fields,'ID','ID');
		
			//รายละเอียดคำสั่ง
			unset($fieldsDeatil);
				$fieldsDeatil["CMD_ID"] 	= 	$CMD_ID;
				$fieldsDeatil["CMD_NOTE"] 	=	$fields["CMD_NOTE"];
			db::db_insert("M_CMD_DETAILS",$fieldsDeatil,'CMD_DETAIL_ID','CMD_DETAIL_ID');
			
			unset($fieldsPerson);
				$fieldsPerson["CMD_ID"] 				= 	$CMD_ID;
				$fieldsPerson["ID_CARD"] 				= 	$recSelectData["REGISTER_CODE"];
				$fieldsPerson["PREFIX_NAME"] 			= 	$recSelectData["PREFIX_NAME"];
				$fieldsPerson["FIRST_NAME"] 			= 	$recSelectData["FIRST_NAME"];
				$fieldsPerson["LAST_NAME"] 				= 	$recSelectData["LAST_NAME"];
				$fieldsPerson["FULL_NAME"] 				= 	$recSelectData["FULL_NAME"];
				$fieldsPerson["PERSON_CMD_TYPE"] 		= 	20;
				$fieldsPerson["PERSON_CASE_TYPE"] 		= 	'99000';
			db::db_insert("M_CMD_PERSON",$fieldsPerson,'PERSON_ID','PERSON_ID');
			
		}
}

db::db_close();

?>
