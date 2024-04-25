<?php
include "../include/config.php";

$sqlselectData = "select * from M_DOC_CMD where TO_CHAR(CMD_FIX_DOC_DATE,'YYYY-MM-DD') = '".date('Y-m-d')."'";
$querySelectData = db::query($sqlselectData);
while($recSelectData = db::fetch_array($querySelectData)){
	
	$sqSelectPerson = "select * from M_CMD_PERSON where CMD_ID = '".$recSelectData["ID"]."'";
	$querySelectPerson = db::query($sqSelectPerson);
	$recSelectPerson = db::fetch_array($querySelectPerson);
	
	//คำสั่งหลัก
	unset($fields);
		$fields["CMD_DOC_DATE"] 		= 		date('Y-m-d');
		$fields["CMD_DOC_TIME"] 		= 		date('H:i:s');
		$fields["COURT_CODE"] 			= 		$recSelectData["COURT_CODE"];
		$fields["COURT_NAME"] 			= 		$recSelectData["COURT_NAME"];
		$fields["F_BLACK_CASE"] 		= 		$recSelectData["F_BLACK_CASE"];
		$fields["T_BLACK_CASE"] 		= 		$recSelectData["T_BLACK_CASE"];
		$fields["BLACK_CASE"] 			= 		$recSelectData["BLACK_CASE"];
		$fields["BLACK_YY"] 			= 		$recSelectData["BLACK_YY"];		
		$fields["F_RED_CASE"] 			= 		$recSelectData["F_RED_CASE"];
		$fields["T_RED_CASE"] 			= 		$recSelectData["T_RED_CASE"];
		$fields["RED_CASE"] 			= 		$recSelectData["RED_CASE"];
		$fields["RED_YY"] 				= 		$recSelectData["RED_YY"];		
		$fields["REF_ID"] 				= 		$recSelectData["REF_ID"];			
		$fields["CASE_TYPE"] 			= 		$recSelectData["CASE_TYPE"];
		$fields["CASE_TYPE_NAME"] 		= 		$recSelectData["CASE_TYPE_NAME"];		
		$fields["SEND_STATUS"] 			= 		0;		
		$fields["CMD_NOTE"] 			= 		$recSelectData["CMD_NOTE"];		
		$fields["OFFICE_IDCARD"] 		= 		$recSelectData["OFFICE_IDCARD"];
		$fields["OFFICE_NAME"] 			= 		$recSelectData["OFFICE_NAME"];
		$fields["APPROVE_STATUS"] 		= 		1;
		$fields["PLAINTIFF"] 			= 		$recSelectData["PLAINTIFF"];
		$fields["DEFENDANT"] 			= 		$recSelectData["DEFENDANT"];		
		$fields["SEND_TO_PERSON"] 		= 		$recSelectData["SEND_TO_PERSON"];
		$fields["CMD_READ_STATUS"] 		= 		0;
		$fields["CMD_DETAIL"] 			= 		$recSelectData["CMD_NOTE"];
		$fields["CMD_SYSTEM"] 			= 		$recSelectData["CMD_SYSTEM"];
		$fields["CMD_SYSTEM_ID"] 		= 		$recSelectData["CMD_SYSTEM_ID"];
		$fields["SYSTEM_NAME"] 			= 		$recSelectData["SYSTEM_NAME"];
		$fields["SYS_NAME"] 			= 		$recSelectData["SYS_NAME"];		
		$fields["CMD_TYPE"] 			= 		$recSelectData["CMD_TYPE"];		
		$fields["APPROVE_PERSON"] 		= 		$recSelectData["APPROVE_PERSON"];		
		
		//แพ่ง
		$sqlSelectCivil = "	select 		a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE
							from 		".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')." a
							where 		1=1 
										AND REGISTER_CODE = '".$recSelectPerson["ID_CARD"]."'
							order by 	CONCERN_CODE asc";
		
		$querySelectCivil = db::query($sqlSelectCivil);
		while($recSelectCivil = db::fetch_array($querySelectCivil)){
			
			$sqlSelectDataCase = "	select 		PLAINTIFF1 as PLAINTIFF,DEFFENDANT1 as DEFFENDANT,DOSS_OWNER_ID,PCC_CASE_GEN
									from 		WH_CIVIL_CASE a 
									inner join 	WH_CIVIL_DOSS b on a.WH_CIVIL_ID = b.WH_CIVIL_ID
									where		1=1
												AND PREFIX_BLACK_CASE = '".$recSelectCivil["PREFIX_BLACK_CASE"]."'
												AND BLACK_CASE = '".$recSelectCivil["BLACK_CASE"]."'
												AND BLACK_YY = '".$recSelectCivil["BLACK_YY"]."'
												AND PREFIX_RED_CASE = '".$recSelectCivil["PREFIX_RED_CASE"]."'
												AND RED_CASE = '".$recSelectCivil["RED_CASE"]."'
												AND RED_YY = '".$recSelectCivil["RED_YY"]."'
												AND COURT_CODE = '".$recSelectCivil["COURT_CODE"]."'";
			$querySelectDataCase = db::query($sqlSelectDataCase);
			$recSelectDataCase 	= db::fetch_array($querySelectDataCase);
					
			$fields["TO_T_BLACK_CASE"] 		= 		$recSelectCivil["PREFIX_BLACK_CASE"];
			$fields["TO_BLACK_CASE"]		= 		$recSelectCivil["BLACK_CASE"];
			$fields["TO_BLACK_YY"] 			= 		$recSelectCivil["BLACK_YY"];			
			$fields["TO_T_RED_CASE"] 		= 		$recSelectCivil["PREFIX_RED_CASE"];
			$fields["TO_RED_CASE"] 			= 		$recSelectCivil["RED_CASE"];
			$fields["TO_RED_YY"] 			= 		$recSelectCivil["RED_YY"];			
			$fields["TO_COURT_CODE"] 		= 		$recSelectCivil["COURT_CODE"];
			$fields["TO_COURT_NAME"] 		= 		$recSelectCivil["COURT_NAME"];
			
			$fields["TO_PLAINTIFF"] 		= 		$recSelectDataCase["PLAINTIFF"];
			$fields["TO_DEFENDANT"] 		= 		$recSelectDataCase["DEFFENDANT"];			
			$fields["TO_PERSON_ID"] 		= 		$recSelectDataCase["DOSS_OWNER_ID"];
			$fields["PCC_CASE_GEN"] 		= 		$recSelectDataCase["PCC_CASE_GEN"];
			$fields["SEND_TO"] 				= 		1;
			
			$CMD_ID = db::db_insert("M_DOC_CMD",$fields,'ID','ID');
		
			//รายละเอียดคำสั่ง
			unset($fieldsDeatil);
				$fieldsDeatil["CMD_ID"] 	= 	$CMD_ID;
				$fieldsDeatil["CMD_NOTE"] =	$recSelectData["CMD_NOTE"];
			db::db_insert("M_CMD_DETAILS",$fieldsDeatil,'CMD_DETAIL_ID','CMD_DETAIL_ID');
			
			unset($fieldsPerson);
				$fieldsPerson["CMD_ID"] 				= 	$CMD_ID;
				$fieldsPerson["ID_CARD"] 				= 	$recSelectPerson["ID_CARD"];
				$fieldsPerson["PREFIX_NAME"] 			= 	$recSelectPerson["PREFIX_NAME"];
				$fieldsPerson["FIRST_NAME"] 			= 	$recSelectPerson["FIRST_NAME"];
				$fieldsPerson["LAST_NAME"] 				= 	$recSelectPerson["LAST_NAME"];
				$fieldsPerson["FULL_NAME"] 				= 	$recSelectPerson["FULL_NAME"];
				$fieldsPerson["ADDRESS"] 				= 	$recSelectPerson["ADDRESS"];
				$fieldsPerson["PHONE"] 					= 	$recSelectPerson["PHONE"];
				$fieldsPerson["FAX"] 					= 	$recSelectPerson["FAX"];
				$fieldsPerson["MOBILE"] 				= 	$recSelectPerson["MOBILE"];
				$fieldsPerson["EMAIL"] 					= 	$recSelectPerson["EMAIL"];
				$fieldsPerson["PERSON_CMD_TYPE"] 		= 	$recSelectPerson["PERSON_CMD_TYPE"];
				$fieldsPerson["PERSON_CASE_TYPE"] 		= 	$recSelectPerson["PERSON_CASE_TYPE"];
			db::db_insert("M_CMD_PERSON",$fieldsPerson,'PERSON_ID','PERSON_ID');
			
		}
		
		//ฟื้นฟู
		$fields["PCC_CASE_GEN"] 		= 		'';
		$sqlSelectReh = "	select 		a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE
							from 		WH_REHABILITATION_PERSON a
							where 		1=1 
										AND REGISTER_CODE = '".$recSelectPerson["ID_CARD"]."'
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
				$fieldsDeatil["CMD_NOTE"] =	$recSelectData["CMD_NOTE"];
			db::db_insert("M_CMD_DETAILS",$fieldsDeatil,'CMD_DETAIL_ID','CMD_DETAIL_ID');
			
			unset($fieldsPerson);
				$fieldsPerson["CMD_ID"] 				= 	$CMD_ID;
				$fieldsPerson["ID_CARD"] 				= 	$recSelectPerson["ID_CARD"];
				$fieldsPerson["PREFIX_NAME"] 			= 	$recSelectPerson["PREFIX_NAME"];
				$fieldsPerson["FIRST_NAME"] 			= 	$recSelectPerson["FIRST_NAME"];
				$fieldsPerson["LAST_NAME"] 				= 	$recSelectPerson["LAST_NAME"];
				$fieldsPerson["FULL_NAME"] 				= 	$recSelectPerson["FULL_NAME"];
				$fieldsPerson["ADDRESS"] 				= 	$recSelectPerson["ADDRESS"];
				$fieldsPerson["PHONE"] 					= 	$recSelectPerson["PHONE"];
				$fieldsPerson["FAX"] 					= 	$recSelectPerson["FAX"];
				$fieldsPerson["MOBILE"] 				= 	$recSelectPerson["MOBILE"];
				$fieldsPerson["EMAIL"] 					= 	$recSelectPerson["EMAIL"];
				$fieldsPerson["PERSON_CMD_TYPE"] 		= 	$recSelectPerson["PERSON_CMD_TYPE"];
				$fieldsPerson["PERSON_CASE_TYPE"] 		= 	$recSelectPerson["PERSON_CASE_TYPE"];
			db::db_insert("M_CMD_PERSON",$fieldsPerson,'PERSON_ID','PERSON_ID');
			
		}
		
		
		//ไกล่เกลี่ย
		$fields["PCC_CASE_GEN"] 		= 		'';
		$sqlSelectMed = "	select 		a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE
							from 		WH_MEDIATE_PERSON a
							where 		1=1 
										AND REGISTER_CODE = '".$recSelectPerson["ID_CARD"]."'
							order by 	CONCERN_CODE asc";		
		$querySelectMed = db::query($sqlSelectMed);
		while($recSelectMed = db::fetch_array($querySelectMed)){
			
			$sqlSelectDataCase = "	select 		PLAINTIFF_FNAME as PLAINTIFF,DEFENDANT_FNAME as DEFFENDANT,'' as DOSS_OWNER_ID,'' as PCC_CASE_GEN
									from 		WH_MEDIATE_CASE a 
									where		1=1
												AND PREFIX_BLACK_CASE = '".$recSelectMed["PREFIX_BLACK_CASE"]."'
												AND BLACK_CASE = '".$recSelectMed["BLACK_CASE"]."'
												AND BLACK_YY = '".$recSelectMed["BLACK_YY"]."'
												AND PREFIX_RED_CASE = '".$recSelectMed["PREFIX_RED_CASE"]."'
												AND RED_CASE = '".$recSelectMed["RED_CASE"]."'
												AND RED_YY = '".$recSelectMed["RED_YY"]."'
												AND COURT_ID = '".$recSelectMed["COURT_CODE"]."'";
			$querySelectDataCase = db::query($sqlSelectDataCase);
			$recSelectDataCase 	= db::fetch_array($querySelectDataCase);
					
			$fields["TO_T_BLACK_CASE"] 		= 		$recSelectMed["PREFIX_BLACK_CASE"];
			$fields["TO_BLACK_CASE"]		= 		$recSelectMed["BLACK_CASE"];
			$fields["TO_BLACK_YY"] 			= 		$recSelectMed["BLACK_YY"];			
			$fields["TO_T_RED_CASE"] 		= 		$recSelectMed["PREFIX_RED_CASE"];
			$fields["TO_RED_CASE"] 			= 		$recSelectMed["RED_CASE"];
			$fields["TO_RED_YY"] 			= 		$recSelectMed["RED_YY"];			
			$fields["TO_COURT_CODE"] 		= 		$recSelectMed["COURT_CODE"];
			$fields["TO_COURT_NAME"] 		= 		$recSelectMed["COURT_NAME"];
			
			$fields["TO_PLAINTIFF"] 		= 		$recSelectDataCase["PLAINTIFF"];
			$fields["TO_DEFENDANT"] 		= 		$recSelectDataCase["DEFFENDANT"];			
			$fields["TO_PERSON_ID"] 		= 		'1103411005612';//$recSelectDataCase["DOSS_OWNER_ID"];
			$fields["SEND_TO"] 				= 		4;
			
			$CMD_ID = db::db_insert("M_DOC_CMD",$fields,'ID','ID');
		
			//รายละเอียดคำสั่ง
			unset($fieldsDeatil);
				$fieldsDeatil["CMD_ID"] 	= 	$CMD_ID;
				$fieldsDeatil["CMD_NOTE"] =	$recSelectData["CMD_NOTE"];
			db::db_insert("M_CMD_DETAILS",$fieldsDeatil,'CMD_DETAIL_ID','CMD_DETAIL_ID');
			
			unset($fieldsPerson);
				$fieldsPerson["CMD_ID"] 				= 	$CMD_ID;
				$fieldsPerson["ID_CARD"] 				= 	$recSelectPerson["ID_CARD"];
				$fieldsPerson["PREFIX_NAME"] 			= 	$recSelectPerson["PREFIX_NAME"];
				$fieldsPerson["FIRST_NAME"] 			= 	$recSelectPerson["FIRST_NAME"];
				$fieldsPerson["LAST_NAME"] 				= 	$recSelectPerson["LAST_NAME"];
				$fieldsPerson["FULL_NAME"] 				= 	$recSelectPerson["FULL_NAME"];
				$fieldsPerson["ADDRESS"] 				= 	$recSelectPerson["ADDRESS"];
				$fieldsPerson["PHONE"] 					= 	$recSelectPerson["PHONE"];
				$fieldsPerson["FAX"] 					= 	$recSelectPerson["FAX"];
				$fieldsPerson["MOBILE"] 				= 	$recSelectPerson["MOBILE"];
				$fieldsPerson["EMAIL"] 					= 	$recSelectPerson["EMAIL"];
				$fieldsPerson["PERSON_CMD_TYPE"] 		= 	$recSelectPerson["PERSON_CMD_TYPE"];
				$fieldsPerson["PERSON_CASE_TYPE"] 		= 	$recSelectPerson["PERSON_CASE_TYPE"];
			db::db_insert("M_CMD_PERSON",$fieldsPerson,'PERSON_ID','PERSON_ID');
			
		}
		
		
		//ล้มละลาย
		$fields["PCC_CASE_GEN"] 		= 		'';
		$sqlSelectBan = "	select 		a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE
							from 		WH_BANKRUPT_CASE_PERSON a
							where 		1=1 
										AND REGISTER_CODE = '".$recSelectPerson["ID_CARD"]."'
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
				$fieldsDeatil["CMD_NOTE"] =	$recSelectData["CMD_NOTE"];
			db::db_insert("M_CMD_DETAILS",$fieldsDeatil,'CMD_DETAIL_ID','CMD_DETAIL_ID');
			
			unset($fieldsPerson);
				$fieldsPerson["CMD_ID"] 				= 	$CMD_ID;
				$fieldsPerson["ID_CARD"] 				= 	$recSelectPerson["ID_CARD"];
				$fieldsPerson["PREFIX_NAME"] 			= 	$recSelectPerson["PREFIX_NAME"];
				$fieldsPerson["FIRST_NAME"] 			= 	$recSelectPerson["FIRST_NAME"];
				$fieldsPerson["LAST_NAME"] 				= 	$recSelectPerson["LAST_NAME"];
				$fieldsPerson["FULL_NAME"] 				= 	$recSelectPerson["FULL_NAME"];
				$fieldsPerson["ADDRESS"] 				= 	$recSelectPerson["ADDRESS"];
				$fieldsPerson["PHONE"] 					= 	$recSelectPerson["PHONE"];
				$fieldsPerson["FAX"] 					= 	$recSelectPerson["FAX"];
				$fieldsPerson["MOBILE"] 				= 	$recSelectPerson["MOBILE"];
				$fieldsPerson["EMAIL"] 					= 	$recSelectPerson["EMAIL"];
				$fieldsPerson["PERSON_CMD_TYPE"] 		= 	$recSelectPerson["PERSON_CMD_TYPE"];
				$fieldsPerson["PERSON_CASE_TYPE"] 		= 	$recSelectPerson["PERSON_CASE_TYPE"];
			db::db_insert("M_CMD_PERSON",$fieldsPerson,'PERSON_ID','PERSON_ID');
			
		}
		
		
		
		
		
	
	
}
db::db_close();
?>
