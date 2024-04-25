<?php
include '../include/include.php';


$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);

$ARRAY_POST = $POST;


$field = array();
$field['IP_ADDRESS'] = $ip;
$field['DEP_ID'] = $POST['depId'];
$field['REQUEST'] = 'getPersonCaseList';
$field['LOG_DATE'] = date("Y-m-d");
$field['LOG_TIME'] = date("H:i:s");
$field['USR_ID'] = '';
$field['REQUEST_STATUS'] = '200';
$field['USR_IDCARD'] = $POST['idCard'];
$field['LOG_TYPE'] = '1';
$field['REQUEST_DATA'] = $str_json;

db::db_insert('M_LOG', $field, 'LOG_ID');

$i = 1;

$h = fopen("log_file/json_" . $LOG_ID . '.txt', "w");
fwrite($h, json_encode($POST, JSON_UNESCAPED_UNICODE));
fclose($h);
/* 
$filter = "";
if($POST['registerCode']!=""){
	$filter .= " and REGISTER_CODE = '".str_replace('-','',$POST['registerCode'])."' ";
}

$POST['registerCode2'] = str_replace('null','',$POST['registerCode2']);
$filter1="";
if($POST["systemType"]==3 || $POST["fromSystemType"]==3 || $POST["systemType"]==2 || $POST["systemType"]==1 || $POST["fromSystemType"]==1 ){
	if($POST['registerCode2']=="" || $POST['registerCode2']=="null"){
		$filterAll = "";
	}else{
		//$filterAll = "and CONCERN_CODE != '01'";
		if($POST['registerCode2']!=""){
			$filterAll .= " AND CONCERN_CODE != '02' ";
		}
	}
}else{

	if($POST['concernCode']!=""){
		$filterAll .= " AND CONCERN_CODE = '".$POST['concernCode']."' ";
	}else{
		if($POST['registerCode2']!=""){
			$filterAll .= " AND CONCERN_CODE != '02' ";
		}
	}
}
 */
/* start */
$num_check = 0;
if ($POST['registerCode'] != "") {
	$filter1 .= " and TB.REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode']) . "' ";
	$num_check = 1;
}

if ($POST['COURT_NAME'] != "") {
	$filter1 .= " AND TB.COURT_NAME = '" . $POST['COURT_NAME'] . "' ";
}

if ($POST['PREFIXBLACKCASE'] != "" && $POST['BLACKCASE'] != "" && $POST['BLACKYY'] != "") {
	$num_check = 1;
	$filter1 .= " AND TB.PREFIX_BLACK_CASE  = '" . $POST['PREFIXBLACKCASE'] . "' ";
	$filter1 .= " AND TB.BLACK_CASE  = '" . $POST['BLACKCASE'] . "' ";
	$filter1 .= " AND TB.BLACK_YY  = '" . $POST['BLACKYY'] . "' ";
}

if ($POST['PREFIXREDCASE'] != "" && $POST['REDCASE'] != "" && $POST['REDYY'] != "") {
	$num_check = 1;
	$filter1 .= " AND TB.PREFIX_RED_CASE  = '" . $POST['PREFIXREDCASE'] . "' ";
	$filter1 .= " AND TB.RED_CASE  = '" . $POST['REDCASE'] . "' ";
	$filter1 .= " AND TB.RED_YY  = '" . $POST['REDYY'] . "' ";
}


if ($POST['PRE_CODE'] != "") {
	$text_N = 1;
    foreach ($POST['PRE_CODE'] as $A1) {
        $result_PRE_CODE .= "'" . $A1 . "'" . (count($POST['PRE_CODE']) == $text_N ? "" : ",");
        $text_N++;
    }
	$filter1 .= " AND TB.CONCERN_NAME in (" . $result_PRE_CODE. ")  ";
}
if ($POST['case'] != "") {
	$text_N = 1;
    foreach ($POST['case'] as $A1) {
        $result_case .= "'" . $A1 . "'" . (count($POST['case']) == $text_N ? "" : ",");
        $text_N++;
    }
	$filter1 .= " AND TB.SYSTEM_TYPE in (" . $result_case. ") ";
}
/* stop */

if ($num_check == 1) {
	if ($POST["getSystemType"] != "") {

		$test_data = "working1";
		if ($POST["getSystemType"] == '01') {
			$sqlSelectDataALL = "	select 		a.CONCERN_NO,a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'Civil' as SYSTEM_TYPE,'' as LOCK_PERSON_STATUS,'' as LOCK_PERSON_STATUS_TEXT,PER_ORDER_STATUS,PERSON_PLAINTIFF,PERSON_DEFENDANT,PERSON_CAPITAL_AMT,a.DEPT_NAME
									from 		".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')." a
									where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode']) . "'
												{$filterAll}";
		} else if ($POST["getSystemType"] == '02') {
			$sqlSelectDataALL = "	select 		a.CONCERN_NO,a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'Bankrupt' as SYSTEM_TYPE,LOCK_PERSON_STATUS,LOCK_PERSON_STATUS_TEXT,PER_ORDER_STATUS,PERSON_PLAINTIFF,PERSON_DEFENDANT,PERSON_CAPITAL_AMT,a.DEPT_NAME
									from 		WH_BANKRUPT_CASE_PERSON a 
									where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode']) . "'
												{$filterAll}";
		} else if ($POST["getSystemType"] == '03') {
			$sqlSelectDataALL = "	select 		a.CONCERN_NO,a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'Revive' as SYSTEM_TYPE,LOCK_PERSON_STATUS,LOCK_PERSON_STATUS_TEXT,PER_ORDER_STATUS,PERSON_PLAINTIFF,PERSON_DEFENDANT,PERSON_CAPITAL_AMT,a.DEPT_NAME
									from 		WH_REHABILITATION_PERSON a
									where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode']) . "'
												{$filterAll}";
		} else if ($POST["getSystemType"] == '04') {
			$sqlSelectDataALL = "	select 		a.CONCERN_NO,a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'Mediate' as SYSTEM_TYPE,'' as LOCK_PERSON_STATUS,'' as LOCK_PERSON_STATUS_TEXT,PER_ORDER_STATUS,PERSON_PLAINTIFF,PERSON_DEFENDANT,PERSON_CAPITAL_AMT,a.DEPT_NAME
									from 		WH_MEDIATE_PERSON a
									where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode']) . "'	
												{$filterAll}";
		}
	} else {
		$test_data = "working2";
		//ตรวจทุกสถานะยกเว้นโจทก์
		$sqlSelectDataALL = "	select 		a.CONCERN_NO,a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'Mediate' as SYSTEM_TYPE,'' as LOCK_PERSON_STATUS,'' as LOCK_PERSON_STATUS_TEXT,PER_ORDER_STATUS,PERSON_PLAINTIFF,PERSON_DEFENDANT,PERSON_CAPITAL_AMT,null as COMP_PAY_DEPT_DATE,a.DEPT_NAME
								from 		WH_MEDIATE_PERSON a
								where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode']) . "'	
											{$filterAll}
								union all	
								select 		a.CONCERN_NO,a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'Bankrupt' as SYSTEM_TYPE,LOCK_PERSON_STATUS,LOCK_PERSON_STATUS_TEXT,PER_ORDER_STATUS,PERSON_PLAINTIFF,PERSON_DEFENDANT,PERSON_CAPITAL_AMT,null as COMP_PAY_DEPT_DATE,a.DEPT_NAME
								from 		WH_BANKRUPT_CASE_PERSON a 
								where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode']) . "'
											{$filterAll}
								union all	
								select 		a.CONCERN_NO,a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'Revive' as SYSTEM_TYPE,LOCK_PERSON_STATUS,LOCK_PERSON_STATUS_TEXT,PER_ORDER_STATUS,PERSON_PLAINTIFF,PERSON_DEFENDANT,PERSON_CAPITAL_AMT,COMP_PAY_DEPT_DATE,a.DEPT_NAME
								from 		WH_REHABILITATION_PERSON a
								where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode']) . "'
											{$filterAll}
								union all
								select 		a.CONCERN_NO,a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'Civil' as SYSTEM_TYPE,'' as LOCK_PERSON_STATUS,'' as LOCK_PERSON_STATUS_TEXT,PER_ORDER_STATUS,PERSON_PLAINTIFF,PERSON_DEFENDANT,PERSON_CAPITAL_AMT,null as COMP_PAY_DEPT_DATE,a.DEPT_NAME
								from 		".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')." a
								where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode']) . "'
											{$filterAll}
							";

		/* Nop start */
		$sqlSelectDataALL_e =		"								
							SELECT TB.CONCERN_NO,TB.REGISTER_CODE,TB.PREFIX_NAME,TB.FIRST_NAME,TB.LAST_NAME,TB.CONCERN_CODE,TB.CONCERN_NAME,
									TB.PREFIX_BLACK_CASE,TB.BLACK_CASE,TB.BLACK_YY,TB.PREFIX_RED_CASE,TB.RED_CASE,TB.RED_YY,
									TB.COURT_NAME,TB.COURT_CODE,TB.ADDRESS,TB.TUM_NAME,TB.AMP_NAME,TB.PROV_NAME,TB.ZIP_CODE,
									TB.SYSTEM_TYPE,TB.LOCK_PERSON_STATUS,TB.LOCK_PERSON_STATUS_TEXT,TB.PER_ORDER_STATUS,
									TB.PERSON_PLAINTIFF,TB.PERSON_DEFENDANT,TB.PERSON_CAPITAL_AMT,TB.COMP_PAY_DEPT_DATE,TB.DEPT_NAME
							FROM (
								SELECT a.CONCERN_NO, a.REGISTER_CODE, a.PREFIX_NAME, a.FIRST_NAME, a.LAST_NAME, a.CONCERN_CODE, a.CONCERN_NAME,
									   a.PREFIX_BLACK_CASE, a.BLACK_CASE, a.BLACK_YY, a.PREFIX_RED_CASE, a.RED_CASE, a.RED_YY,
									   a.COURT_NAME, a.COURT_CODE, ADDRESS, TUM_NAME, AMP_NAME, PROV_NAME, ZIP_CODE,
									   'Mediate' AS SYSTEM_TYPE, '' AS LOCK_PERSON_STATUS, '' AS LOCK_PERSON_STATUS_TEXT, PER_ORDER_STATUS,
									   PERSON_PLAINTIFF, PERSON_DEFENDANT, PERSON_CAPITAL_AMT, NULL AS COMP_PAY_DEPT_DATE, a.DEPT_NAME
								FROM WH_MEDIATE_PERSON a
								UNION ALL
								SELECT a.CONCERN_NO, a.REGISTER_CODE, a.PREFIX_NAME, a.FIRST_NAME, a.LAST_NAME, a.CONCERN_CODE, a.CONCERN_NAME,
									   a.PREFIX_BLACK_CASE, a.BLACK_CASE, a.BLACK_YY, a.PREFIX_RED_CASE, a.RED_CASE, a.RED_YY,
									   a.COURT_NAME, a.COURT_CODE, ADDRESS, TUM_NAME, AMP_NAME, PROV_NAME, ZIP_CODE,
									   'Bankrupt' AS SYSTEM_TYPE, LOCK_PERSON_STATUS, LOCK_PERSON_STATUS_TEXT, PER_ORDER_STATUS,
									   PERSON_PLAINTIFF, PERSON_DEFENDANT, PERSON_CAPITAL_AMT, NULL AS COMP_PAY_DEPT_DATE, a.DEPT_NAME
								FROM WH_BANKRUPT_CASE_PERSON a
								UNION ALL
								SELECT a.CONCERN_NO, a.REGISTER_CODE, a.PREFIX_NAME, a.FIRST_NAME, a.LAST_NAME, a.CONCERN_CODE, a.CONCERN_NAME,
									   a.PREFIX_BLACK_CASE, a.BLACK_CASE, a.BLACK_YY, a.PREFIX_RED_CASE, a.RED_CASE, a.RED_YY,
									   a.COURT_NAME, a.COURT_CODE, ADDRESS, TUM_NAME, AMP_NAME, PROV_NAME, ZIP_CODE,
									   'Revive' AS SYSTEM_TYPE, LOCK_PERSON_STATUS, LOCK_PERSON_STATUS_TEXT, PER_ORDER_STATUS,
									   PERSON_PLAINTIFF, PERSON_DEFENDANT, PERSON_CAPITAL_AMT, COMP_PAY_DEPT_DATE, a.DEPT_NAME
								FROM WH_REHABILITATION_PERSON a
								UNION ALL
								SELECT a.CONCERN_NO, a.REGISTER_CODE, a.PREFIX_NAME, a.FIRST_NAME, a.LAST_NAME, a.CONCERN_CODE, a.CONCERN_NAME,
									   a.PREFIX_BLACK_CASE, a.BLACK_CASE, a.BLACK_YY, a.PREFIX_RED_CASE, a.RED_CASE, a.RED_YY,
									   a.COURT_NAME, a.COURT_CODE, ADDRESS, TUM_NAME, AMP_NAME, PROV_NAME, ZIP_CODE,
									   'Civil' AS SYSTEM_TYPE, '' AS LOCK_PERSON_STATUS, '' AS LOCK_PERSON_STATUS_TEXT, PER_ORDER_STATUS,
									   PERSON_PLAINTIFF, PERSON_DEFENDANT, PERSON_CAPITAL_AMT, NULL AS COMP_PAY_DEPT_DATE, a.DEPT_NAME
								FROM ".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')." a
							) TB
							WHERE 1=1 {$filter1}
							";
		/* Nop stop */
	}
	//$sqlSelectDataALL;
	$querySelectDataALL = db::query($sqlSelectDataALL_e);
	while ($recSelectDataAll = db::fetch_array($querySelectDataALL)) {
		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['prefixBlackCase'] 		= $recSelectDataAll['PREFIX_BLACK_CASE'];
		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['blackCase'] 			= $recSelectDataAll['BLACK_CASE'];
		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['blackYy'] 				= $recSelectDataAll['BLACK_YY'];
		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['prefixRedCase'] 		= $recSelectDataAll['PREFIX_RED_CASE'];
		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['redCase'] 				= $recSelectDataAll['RED_CASE'];
		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['redYy'] 				= $recSelectDataAll['RED_YY'];
		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['CourtCode'] 			= $recSelectDataAll['COURT_CODE'];
		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['courtName'] 			= $recSelectDataAll['COURT_NAME'];
		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['registerCode'] 			= $recSelectDataAll['REGISTER_CODE'];
		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['prefixName'] 			= $recSelectDataAll['PREFIX_NAME'];
		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['firstName'] 			= $recSelectDataAll['FIRST_NAME'];
		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['lastName'] 				= $recSelectDataAll['LAST_NAME'];
		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['fullName'] 				= $recSelectDataAll['PREFIX_NAME'] . $recSelectDataAll['FIRST_NAME'] . " " . $recSelectDataAll['LAST_NAME'];
		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['personType'] 			= $recSelectDataAll['CONCERN_CODE'];
		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['concernName'] 			= $recSelectDataAll['CONCERN_NAME'];
		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['address'] 				= $recSelectDataAll['ADDRESS'];
		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['tumName'] 				= $recSelectDataAll['TUM_NAME'];
		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['ampName'] 				= $recSelectDataAll['AMP_NAME'];
		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['provName'] 				= $recSelectDataAll['PROV_NAME'];
		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['zipCode'] 				= $recSelectDataAll['ZIP_CODE'];
		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['concernNo'] 			= $recSelectDataAll['CONCERN_NO'];
		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['lockPersonStatus'] 		= $recSelectDataAll['LOCK_PERSON_STATUS'];
		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['lockPersonStatusText'] 	= $recSelectDataAll['LOCK_PERSON_STATUS_TEXT'];
		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['orderStatus'] 			= (trim($recSelectDataAll['PER_ORDER_STATUS']) == "") ? "-" : $recSelectDataAll['PER_ORDER_STATUS'];
		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['comPayDeptDate'] 		= $recSelectDataAll['COMP_PAY_DEPT_DATE'];

		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['personPlaintiff'] 		= $recSelectDataAll['PERSON_PLAINTIFF'];
		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['personDefendant'] 		= $recSelectDataAll['PERSON_DEFENDANT'];
		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['personCapital'] 		= $recSelectDataAll['PERSON_CAPITAL_AMT'];
		$obj[$recSelectDataAll['SYSTEM_TYPE']][$i]['deptName'] 				= $recSelectDataAll['DEPT_NAME'];


		$i++;
	}

	$sqlSelectBackoffice = "SELECT	REGISTER_CODE,PREFIX_NAME,FIRST_NAME,LAST_NAME
							FROM 	WH_BACKOFFICE_PERSON
							WHERE	REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode']) . "' ";
	$querySelectBackoffice = db::query($sqlSelectBackoffice);
	while ($recSelectBackoffice = db::fetch_array($querySelectBackoffice)) {
		$obj["Backoffice"][$i]['prefixBlackCase'] 		= '';
		$obj["Backoffice"][$i]['blackCase'] 			= '';
		$obj["Backoffice"][$i]['blackYy'] 				= '';
		$obj["Backoffice"][$i]['prefixRedCase'] 		= '';
		$obj["Backoffice"][$i]['redCase'] 				= '';
		$obj["Backoffice"][$i]['redYy'] 				= '';
		$obj["Backoffice"][$i]['CourtCode'] 			= '';
		$obj["Backoffice"][$i]['courtName'] 			= '';
		$obj["Backoffice"][$i]['registerCode'] 			= $recSelectBackoffice['REGISTER_CODE'];
		$obj["Backoffice"][$i]['prefixName'] 			= $recSelectBackoffice['PREFIX_NAME'];
		$obj["Backoffice"][$i]['firstName'] 			= $recSelectBackoffice['FIRST_NAME'];
		$obj["Backoffice"][$i]['lastName'] 				= $recSelectBackoffice['LAST_NAME'];
		$obj["Backoffice"][$i]['fullName'] 				= $recSelectBackoffice['PREFIX_NAME'] . $recSelectBackoffice['FIRST_NAME'] . " " . $recSelectBackoffice['LAST_NAME'];
		$obj["Backoffice"][$i]['personType'] 			= '';
		$obj["Backoffice"][$i]['concernName'] 			= '';
		$obj["Backoffice"][$i]['address'] 				= '';
		$obj["Backoffice"][$i]['tumName'] 				= '';
		$obj["Backoffice"][$i]['ampName'] 				= '';
		$obj["Backoffice"][$i]['provName'] 				= '';
		$obj["Backoffice"][$i]['zipCode'] 				= '';
		$obj["Backoffice"][$i]['concernNo'] 			= '';
		$obj['Backoffice'][$i]['lockPersonStatus'] 		= '';
		$obj['Backoffice'][$i]['lockPersonStatusText'] 	= '';
		$obj['Backoffice'][$i]['orderStatus'] 			= '';
		$i++;
	}



	/* -------------------------------------------------------------------------------------------------------- */
	if ($POST['registerCode2'] != "") {


		$sqlSelectBackoffice2 = "	SELECT	REGISTER_CODE,PREFIX_NAME,FIRST_NAME,LAST_NAME
									FROM 	WH_BACKOFFICE_PERSON
									WHERE	REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode2']) . "' ";
		$querySelectBackoffice2 = db::query($sqlSelectBackoffice2);
		while ($recSelectBackoffice2 = db::fetch_array($querySelectBackoffice2)) {
			$obj["Backoffice"][$i]['prefixBlackCase'] 		= '';
			$obj["Backoffice"][$i]['blackCase'] 			= '';
			$obj["Backoffice"][$i]['blackYy'] 				= '';
			$obj["Backoffice"][$i]['prefixRedCase'] 		= '';
			$obj["Backoffice"][$i]['redCase'] 				= '';
			$obj["Backoffice"][$i]['redYy'] 				= '';
			$obj["Backoffice"][$i]['CourtCode'] 			= '';
			$obj["Backoffice"][$i]['courtName'] 			= '';
			$obj["Backoffice"][$i]['registerCode'] 			= $recSelectBackoffice2['REGISTER_CODE'];
			$obj["Backoffice"][$i]['prefixName'] 			= $recSelectBackoffice2['PREFIX_NAME'];
			$obj["Backoffice"][$i]['firstName'] 			= $recSelectBackoffice2['FIRST_NAME'];
			$obj["Backoffice"][$i]['lastName'] 				= $recSelectBackoffice2['LAST_NAME'];
			$obj["Backoffice"][$i]['fullName'] 				= $recSelectBackoffice2['PREFIX_NAME'] . $recSelectBackoffice2['FIRST_NAME'] . " " . $recSelectBackoffice2['LAST_NAME'];
			$obj["Backoffice"][$i]['personType'] 			= '';
			$obj["Backoffice"][$i]['concernName'] 			= '';
			$obj["Backoffice"][$i]['address'] 				= '';
			$obj["Backoffice"][$i]['tumName'] 				= '';
			$obj["Backoffice"][$i]['ampName'] 				= '';
			$obj["Backoffice"][$i]['provName'] 				= '';
			$obj["Backoffice"][$i]['zipCode'] 				= '';
			$obj["Backoffice"][$i]['concernNo'] 			= '';
			$obj['Backoffice'][$i]['lockPersonStatus'] 		= '';
			$obj['Backoffice'][$i]['lockPersonStatusText'] 	= '';
			$obj['Backoffice'][$i]['orderStatus'] 			= '';
			$i++;
		}

		//โจทก์เป็นโจทก์ในคดีอื่น
		$filterMediate = "";
		$filterMediate = " and CONCERN_CODE = '01' and WH_MEDIATE_ID in ( 	select 		WH_MEDIATE_ID
																			from 		WH_MEDIATE_PERSON a
																			where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode2']) . "'
																						and CONCERN_CODE = '02')";

		$sqlSelectDataMed = "	select 		a.CONCERN_NO,a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'' as LOCK_PERSON_STATUS,'' as LOCK_PERSON_STATUS_TEXT,PER_ORDER_STATUS,DEPT_NAME
								from 		WH_MEDIATE_PERSON a
								where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode']) . "'	 {$filterMediate}	
							";
		$querySelectDataMed = db::query($sqlSelectDataMed);
		while ($recSelectDataMed = db::fetch_array($querySelectDataMed)) {
			$obj["Mediate"][$i]['prefixBlackCase'] 		= $recSelectDataMed['PREFIX_BLACK_CASE'];
			$obj["Mediate"][$i]['blackCase'] 			= $recSelectDataMed['BLACK_CASE'];
			$obj["Mediate"][$i]['blackYy'] 				= $recSelectDataMed['BLACK_YY'];
			$obj["Mediate"][$i]['prefixRedCase'] 		= $recSelectDataMed['PREFIX_RED_CASE'];
			$obj["Mediate"][$i]['redCase'] 				= $recSelectDataMed['RED_CASE'];
			$obj["Mediate"][$i]['redYy'] 				= $recSelectDataMed['RED_YY'];
			$obj["Mediate"][$i]['CourtCode'] 			= $recSelectDataMed['COURT_CODE'];
			$obj["Mediate"][$i]['courtName'] 			= $recSelectDataMed['COURT_NAME'];
			$obj["Mediate"][$i]['registerCode'] 		= $recSelectDataMed['REGISTER_CODE'];
			$obj["Mediate"][$i]['prefixName'] 			= $recSelectDataMed['PREFIX_NAME'];
			$obj["Mediate"][$i]['firstName'] 			= $recSelectDataMed['FIRST_NAME'];
			$obj["Mediate"][$i]['lastName'] 			= $recSelectDataMed['LAST_NAME'];
			$obj["Mediate"][$i]['fullName'] 			= $recSelectDataMed['PREFIX_NAME'] . $recSelectDataMed['FIRST_NAME'] . " " . $recSelectDataMed['LAST_NAME'];
			$obj["Mediate"][$i]['personType'] 			= $recSelectDataMed['CONCERN_CODE'];
			$obj["Mediate"][$i]['concernName'] 			= $recSelectDataMed['CONCERN_NAME'];
			$obj["Mediate"][$i]['address'] 				= $recSelectDataMed['ADDRESS'];
			$obj["Mediate"][$i]['tumName'] 				= $recSelectDataMed['TUM_NAME'];
			$obj["Mediate"][$i]['ampName'] 				= $recSelectDataMed['AMP_NAME'];
			$obj["Mediate"][$i]['provName'] 			= $recSelectDataMed['PROV_NAME'];
			$obj["Mediate"][$i]['zipCode'] 				= $recSelectDataMed['ZIP_CODE'];
			$obj["Mediate"][$i]['concernNo'] 			= $recSelectDataMed['CONCERN_NO'];
			$obj["Mediate"][$i]['deptName'] 			= $recSelectDataMed['DEPT_NAME'];
			$obj['Mediate'][$i]['lockPersonStatus'] 	= $recSelectDataMed['LOCK_PERSON_STATUS'];
			$obj['Mediate'][$i]['lockPersonStatusText'] = $recSelectDataMed['LOCK_PERSON_STATUS_TEXT'];
			$obj['Mediate'][$i]['orderStatus'] 			= (trim($recSelectDataMed['PER_ORDER_STATUS']) == "") ? "-" : $recSelectDataMed['PER_ORDER_STATUS'];
			$i++;
		}

		$filterBankrupt = "";
		$filterBankrupt = " and CONCERN_CODE = '01' and WH_BANKRUPT_ID in ( 	select 		WH_BANKRUPT_ID
																				from 		WH_BANKRUPT_CASE_PERSON a
																				where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode2']) . "'
																							and CONCERN_CODE = '02')";
		$sqlSelectDataBank = "	select 		a.CONCERN_NO,a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,LOCK_PERSON_STATUS,LOCK_PERSON_STATUS_TEXT,PER_ORDER_STATUS,DEPT_NAME
								from 		WH_BANKRUPT_CASE_PERSON a 
								where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode']) . "'	{$filterBankrupt}	
							";
		$querySelectDataBank = db::query($sqlSelectDataBank);
		while ($recSelectDataBank = db::fetch_array($querySelectDataBank)) {
			$obj["Bankrupt"][$i]['prefixBlackCase'] 		= $recSelectDataBank['PREFIX_BLACK_CASE'];
			$obj["Bankrupt"][$i]['blackCase'] 				= $recSelectDataBank['BLACK_CASE'];
			$obj["Bankrupt"][$i]['blackYy'] 				= $recSelectDataBank['BLACK_YY'];
			$obj["Bankrupt"][$i]['prefixRedCase'] 			= $recSelectDataBank['PREFIX_RED_CASE'];
			$obj["Bankrupt"][$i]['redCase'] 				= $recSelectDataBank['RED_CASE'];
			$obj["Bankrupt"][$i]['redYy'] 					= $recSelectDataBank['RED_YY'];
			$obj["Bankrupt"][$i]['CourtCode'] 				= $recSelectDataBank['COURT_CODE'];
			$obj["Bankrupt"][$i]['courtName'] 				= $recSelectDataBank['COURT_NAME'];
			$obj["Bankrupt"][$i]['registerCode'] 			= $recSelectDataBank['REGISTER_CODE'];
			$obj["Bankrupt"][$i]['prefixName'] 				= $recSelectDataBank['PREFIX_NAME'];
			$obj["Bankrupt"][$i]['firstName'] 				= $recSelectDataBank['FIRST_NAME'];
			$obj["Bankrupt"][$i]['lastName'] 				= $recSelectDataBank['LAST_NAME'];
			$obj["Bankrupt"][$i]['fullName'] 				= $recSelectDataBank['PREFIX_NAME'] . $recSelectDataBank['FIRST_NAME'] . " " . $recSelectDataBank['LAST_NAME'];
			$obj["Bankrupt"][$i]['personType'] 				= $recSelectDataBank['CONCERN_CODE'];
			$obj["Bankrupt"][$i]['concernName'] 			= $recSelectDataBank['CONCERN_NAME'];
			$obj["Bankrupt"][$i]['address'] 				= $recSelectDataBank['ADDRESS'];
			$obj["Bankrupt"][$i]['tumName'] 				= $recSelectDataBank['TUM_NAME'];
			$obj["Bankrupt"][$i]['ampName'] 				= $recSelectDataBank['AMP_NAME'];
			$obj["Bankrupt"][$i]['provName'] 				= $recSelectDataBank['PROV_NAME'];
			$obj["Bankrupt"][$i]['zipCode'] 				= $recSelectDataBank['ZIP_CODE'];
			$obj["Bankrupt"][$i]['concernNo'] 				= $recSelectDataBank['CONCERN_NO'];
			$obj["Bankrupt"][$i]['deptName'] 				= $recSelectDataBank['DEPT_NAME'];
			$obj['Bankrupt'][$i]['lockPersonStatus'] 		= $recSelectDataBank['LOCK_PERSON_STATUS'];
			$obj['Bankrupt'][$i]['lockPersonStatusText'] 	= $recSelectDataBank['LOCK_PERSON_STATUS_TEXT'];
			$obj['Bankrupt'][$i]['orderStatus'] 			= $recSelectDataBank['PER_ORDER_STATUS'];
			$i++;
		}

		$filterRevive = "";
		$filterRevive = " and CONCERN_CODE = '01' and WH_REHAB_ID in ( 	select 		WH_REHAB_ID
																		from 		WH_REHABILITATION_PERSON a
																		where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode2']) . "'
																					and CONCERN_CODE = '02')";
		$sqlSelectDataReh = "	select 		a.CONCERN_NO,a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,LOCK_PERSON_STATUS,LOCK_PERSON_STATUS_TEXT,PER_ORDER_STATUS,DEPT_NAME
								from 		WH_REHABILITATION_PERSON a
								where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode']) . "'	{$filterRevive}	
							";
		$querySelectDataReh = db::query($sqlSelectDataReh);
		while ($recSelectDataReh = db::fetch_array($querySelectDataReh)) {
			$obj["Revive"][$i]['prefixBlackCase'] 			= $recSelectDataReh['PREFIX_BLACK_CASE'];
			$obj["Revive"][$i]['blackCase'] 				= $recSelectDataReh['BLACK_CASE'];
			$obj["Revive"][$i]['blackYy'] 					= $recSelectDataReh['BLACK_YY'];
			$obj["Revive"][$i]['prefixRedCase'] 			= $recSelectDataReh['PREFIX_RED_CASE'];
			$obj["Revive"][$i]['redCase'] 					= $recSelectDataReh['RED_CASE'];
			$obj["Revive"][$i]['redYy'] 					= $recSelectDataReh['RED_YY'];
			$obj["Revive"][$i]['CourtCode'] 				= $recSelectDataMed['COURT_CODE'];
			$obj["Revive"][$i]['courtName'] 				= $recSelectDataReh['COURT_NAME'];
			$obj["Revive"][$i]['registerCode'] 				= $recSelectDataReh['REGISTER_CODE'];
			$obj["Revive"][$i]['prefixName'] 				= $recSelectDataReh['PREFIX_NAME'];
			$obj["Revive"][$i]['firstName'] 				= $recSelectDataReh['FIRST_NAME'];
			$obj["Revive"][$i]['lastName'] 					= $recSelectDataReh['LAST_NAME'];
			$obj["Revive"][$i]['fullName'] 					= $recSelectDataReh['PREFIX_NAME'] . $recSelectDataReh['FIRST_NAME'] . " " . $recSelectDataReh['LAST_NAME'];
			$obj["Revive"][$i]['personType'] 				= $recSelectDataReh['CONCERN_CODE'];
			$obj["Revive"][$i]['concernName'] 				= $recSelectDataReh['CONCERN_NAME'];
			$obj["Revive"][$i]['address'] 					= $recSelectDataReh['ADDRESS'];
			$obj["Revive"][$i]['tumName'] 					= $recSelectDataReh['TUM_NAME'];
			$obj["Revive"][$i]['ampName'] 					= $recSelectDataReh['AMP_NAME'];
			$obj["Revive"][$i]['provName'] 					= $recSelectDataReh['PROV_NAME'];
			$obj["Revive"][$i]['zipCode'] 					= $recSelectDataReh['ZIP_CODE'];
			$obj["Revive"][$i]['concernNo'] 				= $recSelectDataReh['CONCERN_NO'];
			$obj["Revive"][$i]['deptName'] 					= $recSelectDataReh['DEPT_NAME'];
			$obj['Revive'][$i]['lockPersonStatus'] 			= $recSelectDataReh['LOCK_PERSON_STATUS'];
			$obj['Revive'][$i]['lockPersonStatusText'] 		= $recSelectDataReh['LOCK_PERSON_STATUS_TEXT'];
			$obj['Revive'][$i]['orderStatus'] 				= $recSelectDataReh['PER_ORDER_STATUS'];
			$i++;
		}

		$filterCivil = "";
		$filterCivil = " and CONCERN_CODE = '01' and WH_CIVIL_ID in (	select 		WH_CIVIL_ID
																		from 		".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')." a
																		where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode2']) . "'
																					and CONCERN_CODE = '02')";

		$sqlSelectDataCivil = "	select 		a.CONCERN_NO,a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'' as LOCK_PERSON_STATUS,'' as LOCK_PERSON_STATUS_TEXT,PER_ORDER_STATUS,DEPT_NAME
								from 		".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')." a
								where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode']) . "'	 {$filterCivil}	
							";
		$querySelectDataCivil = db::query($sqlSelectDataCivil);
		while ($recSelectDataCivil = db::fetch_array($querySelectDataCivil)) {
			$obj["Civil"][$i]['prefixBlackCase'] 			= $recSelectDataCivil['PREFIX_BLACK_CASE'];
			$obj["Civil"][$i]['blackCase'] 					= $recSelectDataCivil['BLACK_CASE'];
			$obj["Civil"][$i]['blackYy'] 					= $recSelectDataCivil['BLACK_YY'];
			$obj["Civil"][$i]['prefixRedCase'] 				= $recSelectDataCivil['PREFIX_RED_CASE'];
			$obj["Civil"][$i]['redCase'] 					= $recSelectDataCivil['RED_CASE'];
			$obj["Civil"][$i]['redYy'] 						= $recSelectDataCivil['RED_YY'];
			$obj["Civil"][$i]['CourtCode'] 					= $recSelectDataCivil['COURT_CODE'];
			$obj["Civil"][$i]['courtName'] 					= $recSelectDataCivil['COURT_NAME'];
			$obj["Civil"][$i]['registerCode'] 				= $recSelectDataCivil['REGISTER_CODE'];
			$obj["Civil"][$i]['prefixName'] 				= $recSelectDataCivil['PREFIX_NAME'];
			$obj["Civil"][$i]['firstName'] 					= $recSelectDataCivil['FIRST_NAME'];
			$obj["Civil"][$i]['lastName'] 					= $recSelectDataCivil['LAST_NAME'];
			$obj["Civil"][$i]['fullName'] 					= $recSelectDataCivil['PREFIX_NAME'] . $recSelectDataCivil['FIRST_NAME'] . " " . $recSelectDataCivil['LAST_NAME'];
			$obj["Civil"][$i]['personType'] 				= $recSelectDataCivil['CONCERN_CODE'];
			$obj["Civil"][$i]['concernName'] 				= $recSelectDataCivil['CONCERN_NAME'];
			$obj["Civil"][$i]['address'] 					= $recSelectDataCivil['ADDRESS'];
			$obj["Civil"][$i]['tumName'] 					= $recSelectDataCivil['TUM_NAME'];
			$obj["Civil"][$i]['ampName'] 					= $recSelectDataCivil['AMP_NAME'];
			$obj["Civil"][$i]['provName'] 					= $recSelectDataCivil['PROV_NAME'];
			$obj["Civil"][$i]['zipCode'] 					= $recSelectDataCivil['ZIP_CODE'];
			$obj["Civil"][$i]['concernNo'] 					= $recSelectDataCivil['CONCERN_NO'];
			$obj["Civil"][$i]['deptName'] 					= $recSelectDataCivil['DEPT_NAME'];
			$obj['Civil'][$i]['lockPersonStatus'] 			= $recSelectDataCivil['LOCK_PERSON_STATUS'];
			$obj['Civil'][$i]['lockPersonStatusText'] 		= $recSelectDataCivil['LOCK_PERSON_STATUS_TEXT'];
			$obj['Civil'][$i]['orderStatus'] 				= $recSelectDataCivil['PER_ORDER_STATUS'];
			$i++;
		}


		//จำเลยเป็นโจทก์ในคดีอื่น
		$filterMediate = "";
		if ($POST["systemType"] == 2) {
			$filterMediate = " and CONCERN_CODE = '01'";
		} else {
			$filterMediate = " and CONCERN_CODE = '01' and WH_MEDIATE_ID in ( 	select 		WH_MEDIATE_ID
																				from 		WH_MEDIATE_PERSON a
																				where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode']) . "'
																							and CONCERN_CODE = '02')";
		}

		$sqlSelectDataMed = "	select 		a.CONCERN_NO,a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'' as LOCK_PERSON_STATUS,'' as LOCK_PERSON_STATUS_TEXT,PER_ORDER_STATUS,DEPT_NAME
								from 		WH_MEDIATE_PERSON a
								where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode2']) . "'	 {$filterMediate}	
							";
		$querySelectDataMed = db::query($sqlSelectDataMed);
		while ($recSelectDataMed = db::fetch_array($querySelectDataMed)) {
			$obj["Mediate"][$i]['prefixBlackCase'] 				= $recSelectDataMed['PREFIX_BLACK_CASE'];
			$obj["Mediate"][$i]['blackCase'] 					= $recSelectDataMed['BLACK_CASE'];
			$obj["Mediate"][$i]['blackYy'] 						= $recSelectDataMed['BLACK_YY'];
			$obj["Mediate"][$i]['prefixRedCase'] 				= $recSelectDataMed['PREFIX_RED_CASE'];
			$obj["Mediate"][$i]['redCase'] 						= $recSelectDataMed['RED_CASE'];
			$obj["Mediate"][$i]['redYy'] 						= $recSelectDataMed['RED_YY'];
			$obj["Mediate"][$i]['CourtCode'] 					= $recSelectDataMed['COURT_CODE'];
			$obj["Mediate"][$i]['courtName'] 					= $recSelectDataMed['COURT_NAME'];
			$obj["Mediate"][$i]['registerCode'] 				= $recSelectDataMed['REGISTER_CODE'];
			$obj["Mediate"][$i]['prefixName'] 					= $recSelectDataMed['PREFIX_NAME'];
			$obj["Mediate"][$i]['firstName'] 					= $recSelectDataMed['FIRST_NAME'];
			$obj["Mediate"][$i]['lastName'] 					= $recSelectDataMed['LAST_NAME'];
			$obj["Mediate"][$i]['fullName'] 					= $recSelectDataMed['PREFIX_NAME'] . $recSelectDataMed['FIRST_NAME'] . " " . $recSelectDataMed['LAST_NAME'];
			$obj["Mediate"][$i]['personType'] 					= $recSelectDataMed['CONCERN_CODE'];
			$obj["Mediate"][$i]['concernName'] 					= $recSelectDataMed['CONCERN_NAME'];
			$obj["Mediate"][$i]['address'] 						= $recSelectDataMed['ADDRESS'];
			$obj["Mediate"][$i]['tumName'] 						= $recSelectDataMed['TUM_NAME'];
			$obj["Mediate"][$i]['ampName'] 						= $recSelectDataMed['AMP_NAME'];
			$obj["Mediate"][$i]['provName'] 					= $recSelectDataMed['PROV_NAME'];
			$obj["Mediate"][$i]['zipCode'] 						= $recSelectDataMed['ZIP_CODE'];
			$obj["Mediate"][$i]['concernNo'] 					= $recSelectDataMed['CONCERN_NO'];
			$obj["Mediate"][$i]['deptName'] 					= $recSelectDataMed['DEPT_NAME'];
			$obj['Mediate'][$i]['lockPersonStatus'] 			= $recSelectDataMed['LOCK_PERSON_STATUS'];
			$obj['Mediate'][$i]['lockPersonStatusText'] 		= $recSelectDataMed['LOCK_PERSON_STATUS_TEXT'];
			$obj['Mediate'][$i]['orderStatus'] 					= $recSelectDataMed['PER_ORDER_STATUS'];
			$i++;
		}

		$filterBankrupt = "";
		if ($POST["systemType"] == 2) {
			$filterBankrupt = " and CONCERN_CODE = '01'";
		} else {
			$filterBankrupt = " and CONCERN_CODE = '01' and WH_BANKRUPT_ID in ( 	select 		WH_BANKRUPT_ID
																					from 		WH_BANKRUPT_CASE_PERSON a
																					where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode']) . "'
																								and CONCERN_CODE = '02')";
		}
		$filterBankrupt = " and CONCERN_CODE = '01'";
		$sqlSelectDataBank = "	select 		a.CONCERN_NO,a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,LOCK_PERSON_STATUS,LOCK_PERSON_STATUS_TEXT,PER_ORDER_STATUS,DEPT_NAME
								from 		WH_BANKRUPT_CASE_PERSON a 
								where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode2']) . "'	{$filterBankrupt}	
							";
		$querySelectDataBank = db::query($sqlSelectDataBank);
		while ($recSelectDataBank = db::fetch_array($querySelectDataBank)) {
			$obj["Bankrupt"][$i]['prefixBlackCase'] 			= $recSelectDataBank['PREFIX_BLACK_CASE'];
			$obj["Bankrupt"][$i]['blackCase'] 					= $recSelectDataBank['BLACK_CASE'];
			$obj["Bankrupt"][$i]['blackYy'] 					= $recSelectDataBank['BLACK_YY'];
			$obj["Bankrupt"][$i]['prefixRedCase'] 				= $recSelectDataBank['PREFIX_RED_CASE'];
			$obj["Bankrupt"][$i]['redCase'] 					= $recSelectDataBank['RED_CASE'];
			$obj["Bankrupt"][$i]['redYy'] 						= $recSelectDataBank['RED_YY'];
			$obj["Bankrupt"][$i]['CourtCode'] 					= $recSelectDataBank['COURT_CODE'];
			$obj["Bankrupt"][$i]['courtName'] 					= $recSelectDataBank['COURT_NAME'];
			$obj["Bankrupt"][$i]['registerCode'] 				= $recSelectDataBank['REGISTER_CODE'];
			$obj["Bankrupt"][$i]['prefixName'] 					= $recSelectDataBank['PREFIX_NAME'];
			$obj["Bankrupt"][$i]['firstName'] 					= $recSelectDataBank['FIRST_NAME'];
			$obj["Bankrupt"][$i]['lastName'] 					= $recSelectDataBank['LAST_NAME'];
			$obj["Bankrupt"][$i]['fullName'] 					= $recSelectDataBank['PREFIX_NAME'] . $recSelectDataBank['FIRST_NAME'] . " " . $recSelectDataBank['LAST_NAME'];
			$obj["Bankrupt"][$i]['personType'] 					= $recSelectDataBank['CONCERN_CODE'];
			$obj["Bankrupt"][$i]['concernName'] 				= $recSelectDataBank['CONCERN_NAME'];
			$obj["Bankrupt"][$i]['address'] 					= $recSelectDataBank['ADDRESS'];
			$obj["Bankrupt"][$i]['tumName'] 					= $recSelectDataBank['TUM_NAME'];
			$obj["Bankrupt"][$i]['ampName'] 					= $recSelectDataBank['AMP_NAME'];
			$obj["Bankrupt"][$i]['provName'] 					= $recSelectDataBank['PROV_NAME'];
			$obj["Bankrupt"][$i]['zipCode'] 					= $recSelectDataBank['ZIP_CODE'];
			$obj["Bankrupt"][$i]['concernNo'] 					= $recSelectDataBank['CONCERN_NO'];
			$obj["Bankrupt"][$i]['deptName'] 					= $recSelectDataBank['DEPT_NAME'];
			$obj['Bankrupt'][$i]['lockPersonStatus'] 			= $recSelectDataBank['LOCK_PERSON_STATUS'];
			$obj['Bankrupt'][$i]['lockPersonStatusText'] 		= $recSelectDataBank['LOCK_PERSON_STATUS_TEXT'];
			$obj['Bankrupt'][$i]['orderStatus'] 				= $recSelectDataBank['PER_ORDER_STATUS'];
			$i++;
		}

		$filterRevive = "";
		if ($POST["systemType"] == 3) {
			$filterRevive = " and CONCERN_CODE = '01'";
		} else {
			$filterRevive = " and CONCERN_CODE = '01' and WH_REHAB_ID in ( 	select 		WH_REHAB_ID
																			from 		WH_REHABILITATION_PERSON a
																			where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode']) . "'
																						and CONCERN_CODE = '02')";
		}
		$sqlSelectDataReh = "	select 		a.CONCERN_NO,a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,LOCK_PERSON_STATUS,LOCK_PERSON_STATUS_TEXT,PER_ORDER_STATUS,DEPT_NAME
								from 		WH_REHABILITATION_PERSON a
								where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode2']) . "'	{$filterRevive}	
							";
		$querySelectDataReh = db::query($sqlSelectDataReh);
		while ($recSelectDataReh = db::fetch_array($querySelectDataReh)) {
			$obj["Revive"][$i]['prefixBlackCase'] 			= $recSelectDataReh['PREFIX_BLACK_CASE'];
			$obj["Revive"][$i]['blackCase'] 				= $recSelectDataReh['BLACK_CASE'];
			$obj["Revive"][$i]['blackYy'] 					= $recSelectDataReh['BLACK_YY'];
			$obj["Revive"][$i]['prefixRedCase'] 			= $recSelectDataReh['PREFIX_RED_CASE'];
			$obj["Revive"][$i]['redCase'] 					= $recSelectDataReh['RED_CASE'];
			$obj["Revive"][$i]['redYy'] 					= $recSelectDataReh['RED_YY'];
			$obj["Revive"][$i]['CourtCode'] 				= $recSelectDataMed['COURT_CODE'];
			$obj["Revive"][$i]['courtName'] 				= $recSelectDataReh['COURT_NAME'];
			$obj["Revive"][$i]['registerCode'] 				= $recSelectDataReh['REGISTER_CODE'];
			$obj["Revive"][$i]['prefixName'] 				= $recSelectDataReh['PREFIX_NAME'];
			$obj["Revive"][$i]['firstName'] 				= $recSelectDataReh['FIRST_NAME'];
			$obj["Revive"][$i]['lastName'] 					= $recSelectDataReh['LAST_NAME'];
			$obj["Revive"][$i]['fullName'] 					= $recSelectDataReh['PREFIX_NAME'] . $recSelectDataReh['FIRST_NAME'] . " " . $recSelectDataReh['LAST_NAME'];
			$obj["Revive"][$i]['personType'] 				= $recSelectDataReh['CONCERN_CODE'];
			$obj["Revive"][$i]['concernName'] 				= $recSelectDataReh['CONCERN_NAME'];
			$obj["Revive"][$i]['address'] 					= $recSelectDataReh['ADDRESS'];
			$obj["Revive"][$i]['tumName'] 					= $recSelectDataReh['TUM_NAME'];
			$obj["Revive"][$i]['ampName'] 					= $recSelectDataReh['AMP_NAME'];
			$obj["Revive"][$i]['provName'] 					= $recSelectDataReh['PROV_NAME'];
			$obj["Revive"][$i]['zipCode'] 					= $recSelectDataReh['ZIP_CODE'];
			$obj["Revive"][$i]['concernNo'] 				= $recSelectDataReh['CONCERN_NO'];
			$obj["Revive"][$i]['deptName'] 					= $recSelectDataReh['DEPT_NAME'];
			$obj['Revive'][$i]['lockPersonStatus'] 			= $recSelectDataReh['LOCK_PERSON_STATUS'];
			$obj['Revive'][$i]['lockPersonStatusText'] 		= $recSelectDataReh['LOCK_PERSON_STATUS_TEXT'];
			$obj['Revive'][$i]['orderStatus'] 				= $recSelectDataReh['PER_ORDER_STATUS'];
			$i++;
		}

		$filterCivil = "";
		$filterCivil = " and CONCERN_CODE = '01' and WH_CIVIL_ID in (	select 		WH_CIVIL_ID
																		from 		".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')." a
																		where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode']) . "'
																					and CONCERN_CODE = '02')";

		$sqlSelectDataCivil = "	select 		a.CONCERN_NO,a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'' as LOCK_PERSON_STATUS,'' as LOCK_PERSON_STATUS_TEXT,PER_ORDER_STATUS,DEPT_NAME
								from 		".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')." a
								where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode2']) . "'	 {$filterCivil}	
							";
		$querySelectDataCivil = db::query($sqlSelectDataCivil);
		while ($recSelectDataCivil = db::fetch_array($querySelectDataCivil)) {
			$obj["Civil"][$i]['prefixBlackCase'] 			= $recSelectDataCivil['PREFIX_BLACK_CASE'];
			$obj["Civil"][$i]['blackCase'] 					= $recSelectDataCivil['BLACK_CASE'];
			$obj["Civil"][$i]['blackYy'] 					= $recSelectDataCivil['BLACK_YY'];
			$obj["Civil"][$i]['prefixRedCase'] 				= $recSelectDataCivil['PREFIX_RED_CASE'];
			$obj["Civil"][$i]['redCase'] 					= $recSelectDataCivil['RED_CASE'];
			$obj["Civil"][$i]['redYy'] 						= $recSelectDataCivil['RED_YY'];
			$obj["Civil"][$i]['CourtCode'] 					= $recSelectDataCivil['COURT_CODE'];
			$obj["Civil"][$i]['courtName'] 					= $recSelectDataCivil['COURT_NAME'];
			$obj["Civil"][$i]['registerCode'] 				= $recSelectDataCivil['REGISTER_CODE'];
			$obj["Civil"][$i]['prefixName'] 				= $recSelectDataCivil['PREFIX_NAME'];
			$obj["Civil"][$i]['firstName'] 					= $recSelectDataCivil['FIRST_NAME'];
			$obj["Civil"][$i]['lastName'] 					= $recSelectDataCivil['LAST_NAME'];
			$obj["Civil"][$i]['fullName'] 					= $recSelectDataCivil['PREFIX_NAME'] . $recSelectDataCivil['FIRST_NAME'] . " " . $recSelectDataCivil['LAST_NAME'];
			$obj["Civil"][$i]['personType'] 				= $recSelectDataCivil['CONCERN_CODE'];
			$obj["Civil"][$i]['concernName'] 				= $recSelectDataCivil['CONCERN_NAME'];
			$obj["Civil"][$i]['address'] 					= $recSelectDataCivil['ADDRESS'];
			$obj["Civil"][$i]['tumName'] 					= $recSelectDataCivil['TUM_NAME'];
			$obj["Civil"][$i]['ampName'] 					= $recSelectDataCivil['AMP_NAME'];
			$obj["Civil"][$i]['provName'] 					= $recSelectDataCivil['PROV_NAME'];
			$obj["Civil"][$i]['zipCode'] 					= $recSelectDataCivil['ZIP_CODE'];
			$obj["Civil"][$i]['concernNo'] 					= $recSelectDataCivil['CONCERN_NO'];
			$obj["Civil"][$i]['deptName'] 					= $recSelectDataCivil['DEPT_NAME'];
			$obj['Civil'][$i]['lockPersonStatus'] 			= $recSelectDataCivil['LOCK_PERSON_STATUS'];
			$obj['Civil'][$i]['lockPersonStatusText'] 		= $recSelectDataCivil['LOCK_PERSON_STATUS_TEXT'];
			$obj['Civil'][$i]['orderStatus'] 				= $recSelectDataCivil['PER_ORDER_STATUS'];
			$i++;
		}

		//โจทก์เป็นเป็นจำเลยในคดีอื่น
		$filterMediate = "";
		$filterMediate = " and CONCERN_CODE = '02' and WH_MEDIATE_ID in ( 	select 		WH_MEDIATE_ID
																			from 		WH_MEDIATE_PERSON a
																			where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode2']) . "'
																						and CONCERN_CODE = '01')";

		$sqlSelectDataMed = "	select 		a.CONCERN_NO,a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'' as LOCK_PERSON_STATUS,'' as LOCK_PERSON_STATUS_TEXT,PER_ORDER_STATUS,DEPT_NAME
								from 		WH_MEDIATE_PERSON a
								where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode']) . "'	 {$filterMediate}	
							";
		$querySelectDataMed = db::query($sqlSelectDataMed);
		while ($recSelectDataMed = db::fetch_array($querySelectDataMed)) {
			$obj["Mediate"][$i]['prefixBlackCase'] 				= $recSelectDataMed['PREFIX_BLACK_CASE'];
			$obj["Mediate"][$i]['blackCase'] 					= $recSelectDataMed['BLACK_CASE'];
			$obj["Mediate"][$i]['blackYy'] 						= $recSelectDataMed['BLACK_YY'];
			$obj["Mediate"][$i]['prefixRedCase'] 				= $recSelectDataMed['PREFIX_RED_CASE'];
			$obj["Mediate"][$i]['redCase'] 						= $recSelectDataMed['RED_CASE'];
			$obj["Mediate"][$i]['redYy'] 						= $recSelectDataMed['RED_YY'];
			$obj["Mediate"][$i]['CourtCode'] 					= $recSelectDataMed['COURT_CODE'];
			$obj["Mediate"][$i]['courtName'] 					= $recSelectDataMed['COURT_NAME'];
			$obj["Mediate"][$i]['registerCode'] 				= $recSelectDataMed['REGISTER_CODE'];
			$obj["Mediate"][$i]['prefixName'] 					= $recSelectDataMed['PREFIX_NAME'];
			$obj["Mediate"][$i]['firstName'] 					= $recSelectDataMed['FIRST_NAME'];
			$obj["Mediate"][$i]['lastName'] 					= $recSelectDataMed['LAST_NAME'];
			$obj["Mediate"][$i]['fullName'] 					= $recSelectDataMed['PREFIX_NAME'] . $recSelectDataMed['FIRST_NAME'] . " " . $recSelectDataMed['LAST_NAME'];
			$obj["Mediate"][$i]['personType'] 					= $recSelectDataMed['CONCERN_CODE'];
			$obj["Mediate"][$i]['concernName'] 					= $recSelectDataMed['CONCERN_NAME'];
			$obj["Mediate"][$i]['address'] 						= $recSelectDataMed['ADDRESS'];
			$obj["Mediate"][$i]['tumName'] 						= $recSelectDataMed['TUM_NAME'];
			$obj["Mediate"][$i]['ampName'] 						= $recSelectDataMed['AMP_NAME'];
			$obj["Mediate"][$i]['provName'] 					= $recSelectDataMed['PROV_NAME'];
			$obj["Mediate"][$i]['zipCode'] 						= $recSelectDataMed['ZIP_CODE'];
			$obj["Mediate"][$i]['concernNo'] 					= $recSelectDataMed['CONCERN_NO'];
			$obj["Mediate"][$i]['deptName'] 					= $recSelectDataMed['DEPT_NAME'];
			$obj['Mediate'][$i]['lockPersonStatus'] 			= $recSelectDataCivil['LOCK_PERSON_STATUS'];
			$obj['Mediate'][$i]['lockPersonStatusText'] 		= $recSelectDataCivil['LOCK_PERSON_STATUS_TEXT'];
			$obj['Mediate'][$i]['orderStatus'] 					= $recSelectDataCivil['PER_ORDER_STATUS'];
			$i++;
		}

		$filterBankrupt = "";
		$filterBankrupt = " and CONCERN_CODE = '02'";
		$sqlSelectDataBank = "	select 		a.CONCERN_NO,a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,LOCK_PERSON_STATUS,LOCK_PERSON_STATUS_TEXT,PER_ORDER_STATUS,DEPT_NAME
								from 		WH_BANKRUPT_CASE_PERSON a 
								where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode']) . "'	{$filterBankrupt}	
							";
		$querySelectDataBank = db::query($sqlSelectDataBank);
		while ($recSelectDataBank = db::fetch_array($querySelectDataBank)) {
			$obj["Bankrupt"][$i]['prefixBlackCase'] 			= $recSelectDataBank['PREFIX_BLACK_CASE'];
			$obj["Bankrupt"][$i]['blackCase'] 					= $recSelectDataBank['BLACK_CASE'];
			$obj["Bankrupt"][$i]['blackYy'] 					= $recSelectDataBank['BLACK_YY'];
			$obj["Bankrupt"][$i]['prefixRedCase'] 				= $recSelectDataBank['PREFIX_RED_CASE'];
			$obj["Bankrupt"][$i]['redCase'] 					= $recSelectDataBank['RED_CASE'];
			$obj["Bankrupt"][$i]['redYy'] 						= $recSelectDataBank['RED_YY'];
			$obj["Bankrupt"][$i]['CourtCode'] 					= $recSelectDataBank['COURT_CODE'];
			$obj["Bankrupt"][$i]['courtName'] 					= $recSelectDataBank['COURT_NAME'];
			$obj["Bankrupt"][$i]['registerCode'] 				= $recSelectDataBank['REGISTER_CODE'];
			$obj["Bankrupt"][$i]['prefixName'] 					= $recSelectDataBank['PREFIX_NAME'];
			$obj["Bankrupt"][$i]['firstName'] 					= $recSelectDataBank['FIRST_NAME'];
			$obj["Bankrupt"][$i]['lastName'] 					= $recSelectDataBank['LAST_NAME'];
			$obj["Bankrupt"][$i]['fullName'] 					= $recSelectDataBank['PREFIX_NAME'] . $recSelectDataBank['FIRST_NAME'] . " " . $recSelectDataBank['LAST_NAME'];
			$obj["Bankrupt"][$i]['personType'] 					= $recSelectDataBank['CONCERN_CODE'];
			$obj["Bankrupt"][$i]['concernName'] 				= $recSelectDataBank['CONCERN_NAME'];
			$obj["Bankrupt"][$i]['address'] 					= $recSelectDataBank['ADDRESS'];
			$obj["Bankrupt"][$i]['tumName'] 					= $recSelectDataBank['TUM_NAME'];
			$obj["Bankrupt"][$i]['ampName'] 					= $recSelectDataBank['AMP_NAME'];
			$obj["Bankrupt"][$i]['provName'] 					= $recSelectDataBank['PROV_NAME'];
			$obj["Bankrupt"][$i]['zipCode'] 					= $recSelectDataBank['ZIP_CODE'];
			$obj["Bankrupt"][$i]['concernNo'] 					= $recSelectDataBank['CONCERN_NO'];
			$obj["Bankrupt"][$i]['deptName'] 					= $recSelectDataBank['DEPT_NAME'];
			$obj['Bankrupt'][$i]['lockPersonStatus'] 			= $recSelectDataBank['LOCK_PERSON_STATUS'];
			$obj['Bankrupt'][$i]['lockPersonStatusText'] 		= $recSelectDataBank['LOCK_PERSON_STATUS_TEXT'];
			$obj['Bankrupt'][$i]['orderStatus'] 				= $recSelectDataBank['PER_ORDER_STATUS'];
			$i++;
		}

		$filterRevive = "";
		$filterRevive = " and CONCERN_CODE = '02' ";
		$sqlSelectDataReh = "	select 		a.CONCERN_NO,a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,LOCK_PERSON_STATUS,LOCK_PERSON_STATUS_TEXT,PER_ORDER_STATUS,DEPT_NAME
								from 		WH_REHABILITATION_PERSON a
								where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode']) . "'	{$filterRevive}	
							";
		$querySelectDataReh = db::query($sqlSelectDataReh);
		while ($recSelectDataReh = db::fetch_array($querySelectDataReh)) {
			$obj["Revive"][$i]['prefixBlackCase'] 				= $recSelectDataReh['PREFIX_BLACK_CASE'];
			$obj["Revive"][$i]['blackCase'] 					= $recSelectDataReh['BLACK_CASE'];
			$obj["Revive"][$i]['blackYy'] 						= $recSelectDataReh['BLACK_YY'];
			$obj["Revive"][$i]['prefixRedCase'] 				= $recSelectDataReh['PREFIX_RED_CASE'];
			$obj["Revive"][$i]['redCase'] 						= $recSelectDataReh['RED_CASE'];
			$obj["Revive"][$i]['redYy'] 						= $recSelectDataReh['RED_YY'];
			$obj["Revive"][$i]['CourtCode'] 					= $recSelectDataMed['COURT_CODE'];
			$obj["Revive"][$i]['courtName'] 					= $recSelectDataReh['COURT_NAME'];
			$obj["Revive"][$i]['registerCode'] 					= $recSelectDataReh['REGISTER_CODE'];
			$obj["Revive"][$i]['prefixName'] 					= $recSelectDataReh['PREFIX_NAME'];
			$obj["Revive"][$i]['firstName'] 					= $recSelectDataReh['FIRST_NAME'];
			$obj["Revive"][$i]['lastName'] 						= $recSelectDataReh['LAST_NAME'];
			$obj["Revive"][$i]['fullName'] 						= $recSelectDataReh['PREFIX_NAME'] . $recSelectDataReh['FIRST_NAME'] . " " . $recSelectDataReh['LAST_NAME'];
			$obj["Revive"][$i]['personType'] 					= $recSelectDataReh['CONCERN_CODE'];
			$obj["Revive"][$i]['concernName'] 					= $recSelectDataReh['CONCERN_NAME'];
			$obj["Revive"][$i]['address'] 						= $recSelectDataReh['ADDRESS'];
			$obj["Revive"][$i]['tumName'] 						= $recSelectDataReh['TUM_NAME'];
			$obj["Revive"][$i]['ampName'] 						= $recSelectDataReh['AMP_NAME'];
			$obj["Revive"][$i]['provName'] 						= $recSelectDataReh['PROV_NAME'];
			$obj["Revive"][$i]['zipCode'] 						= $recSelectDataReh['ZIP_CODE'];
			$obj["Revive"][$i]['concernNo'] 					= $recSelectDataReh['CONCERN_NO'];
			$obj["Revive"][$i]['deptName'] 					= $recSelectDataReh['DEPT_NAME'];
			$obj['Revive'][$i]['lockPersonStatus'] 				= $recSelectDataReh['LOCK_PERSON_STATUS'];
			$obj['Revive'][$i]['lockPersonStatusText'] 			= $recSelectDataReh['LOCK_PERSON_STATUS_TEXT'];
			$obj['Revive'][$i]['orderStatus'] 					= $recSelectDataReh['PER_ORDER_STATUS'];
			$obj['Revive'][$i]['comPayDeptDate'] 				= $recSelectDataReh['COMP_PAY_DEPT_DATE'];
			$i++;
		}

		$filterCivil = "";
		$filterCivil = " and CONCERN_CODE = '02' and WH_CIVIL_ID in (	select 		WH_CIVIL_ID
																		from 		".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')." a
																		where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode2']) . "'
																					and CONCERN_CODE = '01')";

		$sqlSelectDataCivil = "	select 		a.CONCERN_NO,a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'' as LOCK_PERSON_STATUS,'' as LOCK_PERSON_STATUS_TEXT,PER_ORDER_STATUS,DEPT_NAME
								from 		".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')." a
								where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode']) . "'	 {$filterCivil}	
							";
		$querySelectDataCivil = db::query($sqlSelectDataCivil);
		while ($recSelectDataCivil = db::fetch_array($querySelectDataCivil)) {
			$obj["Civil"][$i]['prefixBlackCase'] 				= $recSelectDataCivil['PREFIX_BLACK_CASE'];
			$obj["Civil"][$i]['blackCase'] 						= $recSelectDataCivil['BLACK_CASE'];
			$obj["Civil"][$i]['blackYy'] 						= $recSelectDataCivil['BLACK_YY'];
			$obj["Civil"][$i]['prefixRedCase'] 					= $recSelectDataCivil['PREFIX_RED_CASE'];
			$obj["Civil"][$i]['redCase'] 						= $recSelectDataCivil['RED_CASE'];
			$obj["Civil"][$i]['redYy'] 							= $recSelectDataCivil['RED_YY'];
			$obj["Civil"][$i]['CourtCode'] 						= $recSelectDataCivil['COURT_CODE'];
			$obj["Civil"][$i]['courtName'] 						= $recSelectDataCivil['COURT_NAME'];
			$obj["Civil"][$i]['registerCode'] 					= $recSelectDataCivil['REGISTER_CODE'];
			$obj["Civil"][$i]['prefixName'] 					= $recSelectDataCivil['PREFIX_NAME'];
			$obj["Civil"][$i]['firstName'] 						= $recSelectDataCivil['FIRST_NAME'];
			$obj["Civil"][$i]['lastName'] 						= $recSelectDataCivil['LAST_NAME'];
			$obj["Civil"][$i]['fullName'] 						= $recSelectDataCivil['PREFIX_NAME'] . $recSelectDataCivil['FIRST_NAME'] . " " . $recSelectDataCivil['LAST_NAME'];
			$obj["Civil"][$i]['personType'] 					= $recSelectDataCivil['CONCERN_CODE'];
			$obj["Civil"][$i]['concernName'] 					= $recSelectDataCivil['CONCERN_NAME'];
			$obj["Civil"][$i]['address'] 						= $recSelectDataCivil['ADDRESS'];
			$obj["Civil"][$i]['tumName'] 						= $recSelectDataCivil['TUM_NAME'];
			$obj["Civil"][$i]['ampName'] 						= $recSelectDataCivil['AMP_NAME'];
			$obj["Civil"][$i]['provName'] 						= $recSelectDataCivil['PROV_NAME'];
			$obj["Civil"][$i]['zipCode'] 						= $recSelectDataCivil['ZIP_CODE'];
			$obj["Civil"][$i]['concernNo'] 						= $recSelectDataCivil['CONCERN_NO'];
			$obj["Civil"][$i]['deptName'] 						= $recSelectDataCivil['DEPT_NAME'];
			$obj['Civil'][$i]['lockPersonStatus'] 				= $recSelectDataCivil['LOCK_PERSON_STATUS'];
			$obj['Civil'][$i]['lockPersonStatusText'] 			= $recSelectDataCivil['LOCK_PERSON_STATUS_TEXT'];
			$obj['Civil'][$i]['orderStatus'] 					= $recSelectDataCivil['PER_ORDER_STATUS'];
			$i++;
		}



		//จำเลยเป็นจำเลยในคดีอื่น
		$filterCivil = "";
		$filterCivil = " and CONCERN_CODE = '02' and WH_CIVIL_ID in (	select 		WH_CIVIL_ID
																		from 		".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')." a
																		where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode']) . "'
																					and CONCERN_CODE = '01')";
		$sqlSelectDataCivil = "	select 		a.CONCERN_NO,a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'' as LOCK_PERSON_STATUS,'' as LOCK_PERSON_STATUS_TEXT,PER_ORDER_STATUS,DEPT_NAME
								from 		".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')." a
								where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode2']) . "'	 {$filterCivil}	
							";
		$querySelectDataCivil = db::query($sqlSelectDataCivil);
		while ($recSelectDataCivil = db::fetch_array($querySelectDataCivil)) {
			$obj["Civil"][$i]['prefixBlackCase'] 		= $recSelectDataCivil['PREFIX_BLACK_CASE'];
			$obj["Civil"][$i]['blackCase'] 				= $recSelectDataCivil['BLACK_CASE'];
			$obj["Civil"][$i]['blackYy'] 				= $recSelectDataCivil['BLACK_YY'];
			$obj["Civil"][$i]['prefixRedCase'] 			= $recSelectDataCivil['PREFIX_RED_CASE'];
			$obj["Civil"][$i]['redCase'] 				= $recSelectDataCivil['RED_CASE'];
			$obj["Civil"][$i]['redYy'] 					= $recSelectDataCivil['RED_YY'];
			$obj["Civil"][$i]['CourtCode'] 				= $recSelectDataCivil['COURT_CODE'];
			$obj["Civil"][$i]['courtName'] 				= $recSelectDataCivil['COURT_NAME'];
			$obj["Civil"][$i]['registerCode'] 			= $recSelectDataCivil['REGISTER_CODE'];
			$obj["Civil"][$i]['prefixName'] 			= $recSelectDataCivil['PREFIX_NAME'];
			$obj["Civil"][$i]['firstName'] 				= $recSelectDataCivil['FIRST_NAME'];
			$obj["Civil"][$i]['lastName'] 				= $recSelectDataCivil['LAST_NAME'];
			$obj["Civil"][$i]['fullName'] 				= $recSelectDataCivil['PREFIX_NAME'] . $recSelectDataCivil['FIRST_NAME'] . " " . $recSelectDataCivil['LAST_NAME'];
			$obj["Civil"][$i]['personType'] 			= $recSelectDataCivil['CONCERN_CODE'];
			$obj["Civil"][$i]['concernName'] 			= $recSelectDataCivil['CONCERN_NAME'];
			$obj["Civil"][$i]['address'] 				= $recSelectDataCivil['ADDRESS'];
			$obj["Civil"][$i]['tumName'] 				= $recSelectDataCivil['TUM_NAME'];
			$obj["Civil"][$i]['ampName'] 				= $recSelectDataCivil['AMP_NAME'];
			$obj["Civil"][$i]['provName'] 				= $recSelectDataCivil['PROV_NAME'];
			$obj["Civil"][$i]['zipCode'] 				= $recSelectDataCivil['ZIP_CODE'];
			$obj["Civil"][$i]['concernNo'] 				= $recSelectDataCivil['CONCERN_NO'];
			$obj["Civil"][$i]['deptName'] 				= $recSelectDataCivil['DEPT_NAME'];
			$obj['Civil'][$i]['lockPersonStatus'] 		= $recSelectDataCivil['LOCK_PERSON_STATUS'];
			$obj['Civil'][$i]['lockPersonStatusText'] 	= $recSelectDataCivil['LOCK_PERSON_STATUS_TEXT'];
			$obj['Civil'][$i]['orderStatus'] 			= $recSelectDataCivil['PER_ORDER_STATUS'];
			$i++;
		}

		$filterRevive = "";
		$filterRevive = " and CONCERN_CODE = '02' ";
		$sqlSelectDataReh = "	select 		a.CONCERN_NO,a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,LOCK_PERSON_STATUS,LOCK_PERSON_STATUS_TEXT,PER_ORDER_STATUS,DEPT_NAME
								from 		WH_REHABILITATION_PERSON a
								where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode2']) . "'	{$filterRevive}	
							";
		$querySelectDataReh = db::query($sqlSelectDataReh);
		while ($recSelectDataReh = db::fetch_array($querySelectDataReh)) {
			$obj["Revive"][$i]['prefixBlackCase'] 		= $recSelectDataReh['PREFIX_BLACK_CASE'];
			$obj["Revive"][$i]['blackCase'] 			= $recSelectDataReh['BLACK_CASE'];
			$obj["Revive"][$i]['blackYy'] 				= $recSelectDataReh['BLACK_YY'];
			$obj["Revive"][$i]['prefixRedCase'] 		= $recSelectDataReh['PREFIX_RED_CASE'];
			$obj["Revive"][$i]['redCase'] 				= $recSelectDataReh['RED_CASE'];
			$obj["Revive"][$i]['redYy'] 				= $recSelectDataReh['RED_YY'];
			$obj["Revive"][$i]['CourtCode'] 			= $recSelectDataReh['COURT_CODE'];
			$obj["Revive"][$i]['courtName'] 			= $recSelectDataReh['COURT_NAME'];
			$obj["Revive"][$i]['registerCode'] 			= $recSelectDataReh['REGISTER_CODE'];
			$obj["Revive"][$i]['prefixName'] 			= $recSelectDataReh['PREFIX_NAME'];
			$obj["Revive"][$i]['firstName'] 			= $recSelectDataReh['FIRST_NAME'];
			$obj["Revive"][$i]['lastName'] 				= $recSelectDataReh['LAST_NAME'];
			$obj["Revive"][$i]['fullName'] 				= $recSelectDataReh['PREFIX_NAME'] . $recSelectDataReh['FIRST_NAME'] . " " . $recSelectDataReh['LAST_NAME'];
			$obj["Revive"][$i]['personType'] 			= $recSelectDataReh['CONCERN_CODE'];
			$obj["Revive"][$i]['concernName'] 			= $recSelectDataReh['CONCERN_NAME'];
			$obj["Revive"][$i]['address'] 				= $recSelectDataReh['ADDRESS'];
			$obj["Revive"][$i]['tumName'] 				= $recSelectDataReh['TUM_NAME'];
			$obj["Revive"][$i]['ampName'] 				= $recSelectDataReh['AMP_NAME'];
			$obj["Revive"][$i]['provName'] 				= $recSelectDataReh['PROV_NAME'];
			$obj["Revive"][$i]['zipCode'] 				= $recSelectDataReh['ZIP_CODE'];
			$obj["Revive"][$i]['concernNo'] 			= $recSelectDataReh['CONCERN_NO'];
			$obj["Revive"][$i]['deptName'] 				= $recSelectDataReh['DEPT_NAME'];
			$obj['Revive'][$i]['lockPersonStatus'] 		= $recSelectDataReh['LOCK_PERSON_STATUS'];
			$obj['Revive'][$i]['lockPersonStatusText'] 	= $recSelectDataReh['LOCK_PERSON_STATUS_TEXT'];
			$obj['Revive'][$i]['orderStatus'] 			= $recSelectDataReh['PER_ORDER_STATUS'];
			$obj['Revive'][$i]['comPayDeptDate'] 		= $recSelectDataReh['COMP_PAY_DEPT_DATE'];
			$i++;
		}

		$filterBankrupt = "";
		$filterBankrupt = " and CONCERN_CODE = '02' ";
		$sqlSelectDataBank = "	select 		a.CONCERN_NO,a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,LOCK_PERSON_STATUS,LOCK_PERSON_STATUS_TEXT,PER_ORDER_STATUS,DEPT_NAME
								from 		WH_BANKRUPT_CASE_PERSON a 
								where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode2']) . "'	{$filterBankrupt}	
							";
		$querySelectDataBank = db::query($sqlSelectDataBank);
		while ($recSelectDataBank = db::fetch_array($querySelectDataBank)) {
			$obj["Bankrupt"][$i]['prefixBlackCase'] 		= $recSelectDataBank['PREFIX_BLACK_CASE'];
			$obj["Bankrupt"][$i]['blackCase'] 				= $recSelectDataBank['BLACK_CASE'];
			$obj["Bankrupt"][$i]['blackYy'] 				= $recSelectDataBank['BLACK_YY'];
			$obj["Bankrupt"][$i]['prefixRedCase'] 			= $recSelectDataBank['PREFIX_RED_CASE'];
			$obj["Bankrupt"][$i]['redCase'] 				= $recSelectDataBank['RED_CASE'];
			$obj["Bankrupt"][$i]['redYy'] 					= $recSelectDataBank['RED_YY'];
			$obj["Bankrupt"][$i]['CourtCode'] 				= $recSelectDataBank['COURT_CODE'];
			$obj["Bankrupt"][$i]['courtName'] 				= $recSelectDataBank['COURT_NAME'];
			$obj["Bankrupt"][$i]['registerCode'] 			= $recSelectDataBank['REGISTER_CODE'];
			$obj["Bankrupt"][$i]['prefixName'] 				= $recSelectDataBank['PREFIX_NAME'];
			$obj["Bankrupt"][$i]['firstName'] 				= $recSelectDataBank['FIRST_NAME'];
			$obj["Bankrupt"][$i]['lastName'] 				= $recSelectDataBank['LAST_NAME'];
			$obj["Bankrupt"][$i]['fullName'] 				= $recSelectDataBank['PREFIX_NAME'] . $recSelectDataBank['FIRST_NAME'] . " " . $recSelectDataBank['LAST_NAME'];
			$obj["Bankrupt"][$i]['personType'] 				= $recSelectDataBank['CONCERN_CODE'];
			$obj["Bankrupt"][$i]['concernName'] 			= $recSelectDataBank['CONCERN_NAME'];
			$obj["Bankrupt"][$i]['address'] 				= $recSelectDataBank['ADDRESS'];
			$obj["Bankrupt"][$i]['tumName'] 				= $recSelectDataBank['TUM_NAME'];
			$obj["Bankrupt"][$i]['ampName'] 				= $recSelectDataBank['AMP_NAME'];
			$obj["Bankrupt"][$i]['provName'] 				= $recSelectDataBank['PROV_NAME'];
			$obj["Bankrupt"][$i]['zipCode'] 				= $recSelectDataBank['ZIP_CODE'];
			$obj["Bankrupt"][$i]['concernNo'] 				= $recSelectDataBank['CONCERN_NO'];
			$obj["Bankrupt"][$i]['deptName'] 				= $recSelectDataBank['DEPT_NAME'];
			$obj['Bankrupt'][$i]['lockPersonStatus'] 		= $recSelectDataBank['LOCK_PERSON_STATUS'];
			$obj['Bankrupt'][$i]['lockPersonStatusText'] 	= $recSelectDataBank['LOCK_PERSON_STATUS_TEXT'];
			$obj['Bankrupt'][$i]['orderStatus'] 			= $recSelectDataBank['PER_ORDER_STATUS'];
			$i++;
		}

		//โจทก์เป็นเป็นจำเลยในคดีอื่น
		$filterMediate = "";
		$filterMediate = " and CONCERN_CODE = '02' and WH_MEDIATE_ID in ( 	select 		WH_MEDIATE_ID
																			from 		WH_MEDIATE_PERSON a
																			where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode']) . "'
																						and CONCERN_CODE = '01')";

		$sqlSelectDataMed = "	select 		a.CONCERN_NO,a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'' as LOCK_PERSON_STATUS,'' as LOCK_PERSON_STATUS_TEXT,PER_ORDER_STATUS,DEPT_NAME
								from 		WH_MEDIATE_PERSON a
								where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode2']) . "'	 {$filterMediate}	
							";
		$querySelectDataMed = db::query($sqlSelectDataMed);
		while ($recSelectDataMed = db::fetch_array($querySelectDataMed)) {
			$obj["Mediate"][$i]['prefixBlackCase'] 				= $recSelectDataMed['PREFIX_BLACK_CASE'];
			$obj["Mediate"][$i]['blackCase'] 					= $recSelectDataMed['BLACK_CASE'];
			$obj["Mediate"][$i]['blackYy'] 						= $recSelectDataMed['BLACK_YY'];
			$obj["Mediate"][$i]['prefixRedCase'] 				= $recSelectDataMed['PREFIX_RED_CASE'];
			$obj["Mediate"][$i]['redCase'] 						= $recSelectDataMed['RED_CASE'];
			$obj["Mediate"][$i]['redYy'] 						= $recSelectDataMed['RED_YY'];
			$obj["Mediate"][$i]['CourtCode'] 					= $recSelectDataMed['COURT_CODE'];
			$obj["Mediate"][$i]['courtName'] 					= $recSelectDataMed['COURT_NAME'];
			$obj["Mediate"][$i]['registerCode'] 				= $recSelectDataMed['REGISTER_CODE'];
			$obj["Mediate"][$i]['prefixName'] 					= $recSelectDataMed['PREFIX_NAME'];
			$obj["Mediate"][$i]['firstName'] 					= $recSelectDataMed['FIRST_NAME'];
			$obj["Mediate"][$i]['lastName'] 					= $recSelectDataMed['LAST_NAME'];
			$obj["Mediate"][$i]['fullName'] 					= $recSelectDataMed['PREFIX_NAME'] . $recSelectDataMed['FIRST_NAME'] . " " . $recSelectDataMed['LAST_NAME'];
			$obj["Mediate"][$i]['personType'] 					= $recSelectDataMed['CONCERN_CODE'];
			$obj["Mediate"][$i]['concernName'] 					= $recSelectDataMed['CONCERN_NAME'];
			$obj["Mediate"][$i]['address'] 						= $recSelectDataMed['ADDRESS'];
			$obj["Mediate"][$i]['tumName'] 						= $recSelectDataMed['TUM_NAME'];
			$obj["Mediate"][$i]['ampName'] 						= $recSelectDataMed['AMP_NAME'];
			$obj["Mediate"][$i]['provName'] 					= $recSelectDataMed['PROV_NAME'];
			$obj["Mediate"][$i]['zipCode'] 						= $recSelectDataMed['ZIP_CODE'];
			$obj["Mediate"][$i]['concernNo'] 					= $recSelectDataMed['CONCERN_NO'];
			$obj["Mediate"][$i]['deptName'] 					= $recSelectDataMed['DEPT_NAME'];
			$obj['Mediate'][$i]['lockPersonStatus'] 			= $recSelectDataCivil['LOCK_PERSON_STATUS'];
			$obj['Mediate'][$i]['lockPersonStatusText'] 		= $recSelectDataCivil['LOCK_PERSON_STATUS_TEXT'];
			$obj['Mediate'][$i]['orderStatus'] 					= $recSelectDataCivil['PER_ORDER_STATUS'];
			$i++;
		}


		//จำเป็นเลนสถานอื่นๆ
		$filterRevive = "";
		$filterRevive = " and CONCERN_CODE NOT IN ('01','02')";
		$sqlSelectDataReh = "	select 		a.CONCERN_NO,a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,LOCK_PERSON_STATUS,LOCK_PERSON_STATUS_TEXT,PER_ORDER_STATUS,DEPT_NAME
								from 		WH_REHABILITATION_PERSON a
								where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode2']) . "'	{$filterRevive}	
							";
		$querySelectDataReh = db::query($sqlSelectDataReh);
		while ($recSelectDataReh = db::fetch_array($querySelectDataReh)) {
			$obj["Revive"][$i]['prefixBlackCase'] 			= $recSelectDataReh['PREFIX_BLACK_CASE'];
			$obj["Revive"][$i]['blackCase'] 				= $recSelectDataReh['BLACK_CASE'];
			$obj["Revive"][$i]['blackYy'] 					= $recSelectDataReh['BLACK_YY'];
			$obj["Revive"][$i]['prefixRedCase'] 			= $recSelectDataReh['PREFIX_RED_CASE'];
			$obj["Revive"][$i]['redCase'] 					= $recSelectDataReh['RED_CASE'];
			$obj["Revive"][$i]['redYy'] 					= $recSelectDataReh['RED_YY'];
			$obj["Revive"][$i]['CourtCode'] 				= $recSelectDataMed['COURT_CODE'];
			$obj["Revive"][$i]['courtName'] 				= $recSelectDataReh['COURT_NAME'];
			$obj["Revive"][$i]['registerCode'] 				= $recSelectDataReh['REGISTER_CODE'];
			$obj["Revive"][$i]['prefixName'] 				= $recSelectDataReh['PREFIX_NAME'];
			$obj["Revive"][$i]['firstName'] 				= $recSelectDataReh['FIRST_NAME'];
			$obj["Revive"][$i]['lastName'] 					= $recSelectDataReh['LAST_NAME'];
			$obj["Revive"][$i]['fullName'] 					= $recSelectDataReh['PREFIX_NAME'] . $recSelectDataReh['FIRST_NAME'] . " " . $recSelectDataReh['LAST_NAME'];
			$obj["Revive"][$i]['personType'] 				= $recSelectDataReh['CONCERN_CODE'];
			$obj["Revive"][$i]['concernName'] 				= $recSelectDataReh['CONCERN_NAME'];
			$obj["Revive"][$i]['address'] 					= $recSelectDataReh['ADDRESS'];
			$obj["Revive"][$i]['tumName'] 					= $recSelectDataReh['TUM_NAME'];
			$obj["Revive"][$i]['ampName'] 					= $recSelectDataReh['AMP_NAME'];
			$obj["Revive"][$i]['provName'] 					= $recSelectDataReh['PROV_NAME'];
			$obj["Revive"][$i]['zipCode'] 					= $recSelectDataReh['ZIP_CODE'];
			$obj["Revive"][$i]['concernNo'] 				= $recSelectDataReh['CONCERN_NO'];
			$obj["Revive"][$i]['deptName'] 					= $recSelectDataReh['DEPT_NAME'];
			$obj['Revive'][$i]['lockPersonStatus'] 			= $recSelectDataReh['LOCK_PERSON_STATUS'];
			$obj['Revive'][$i]['lockPersonStatusText'] 		= $recSelectDataReh['LOCK_PERSON_STATUS_TEXT'];
			$obj['Revive'][$i]['orderStatus'] 				= $recSelectDataReh['PER_ORDER_STATUS'];
			$i++;
		}

		$filterBankrupt = "";
		$filterBankrupt = " and CONCERN_CODE NOT IN ('01','02')";
		$sqlSelectDataBank = "	select 		a.CONCERN_NO,a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,LOCK_PERSON_STATUS,LOCK_PERSON_STATUS_TEXT,PER_ORDER_STATUS,DEPT_NAME
								from 		WH_BANKRUPT_CASE_PERSON a 
								where 		REGISTER_CODE = '" . str_replace('-', '', $POST['registerCode2']) . "'	{$filterBankrupt}	
							";

		$querySelectDataBank = db::query($sqlSelectDataBank);
		while ($recSelectDataBank = db::fetch_array($querySelectDataBank)) {
			$obj["Bankrupt"][$i]['prefixBlackCase'] 			= $recSelectDataBank['PREFIX_BLACK_CASE'];
			$obj["Bankrupt"][$i]['blackCase'] 					= $recSelectDataBank['BLACK_CASE'];
			$obj["Bankrupt"][$i]['blackYy'] 					= $recSelectDataBank['BLACK_YY'];
			$obj["Bankrupt"][$i]['prefixRedCase'] 				= $recSelectDataBank['PREFIX_RED_CASE'];
			$obj["Bankrupt"][$i]['redCase'] 					= $recSelectDataBank['RED_CASE'];
			$obj["Bankrupt"][$i]['redYy'] 						= $recSelectDataBank['RED_YY'];
			$obj["Bankrupt"][$i]['CourtCode'] 					= $recSelectDataBank['COURT_CODE'];
			$obj["Bankrupt"][$i]['courtName'] 					= $recSelectDataBank['COURT_NAME'];
			$obj["Bankrupt"][$i]['registerCode'] 				= $recSelectDataBank['REGISTER_CODE'];
			$obj["Bankrupt"][$i]['prefixName'] 					= $recSelectDataBank['PREFIX_NAME'];
			$obj["Bankrupt"][$i]['firstName'] 					= $recSelectDataBank['FIRST_NAME'];
			$obj["Bankrupt"][$i]['lastName'] 					= $recSelectDataBank['LAST_NAME'];
			$obj["Bankrupt"][$i]['fullName'] 					= $recSelectDataBank['PREFIX_NAME'] . $recSelectDataBank['FIRST_NAME'] . " " . $recSelectDataBank['LAST_NAME'];
			$obj["Bankrupt"][$i]['personType'] 					= $recSelectDataBank['CONCERN_CODE'];
			$obj["Bankrupt"][$i]['concernName'] 				= $recSelectDataBank['CONCERN_NAME'];
			$obj["Bankrupt"][$i]['address'] 					= $recSelectDataBank['ADDRESS'];
			$obj["Bankrupt"][$i]['tumName'] 					= $recSelectDataBank['TUM_NAME'];
			$obj["Bankrupt"][$i]['ampName'] 					= $recSelectDataBank['AMP_NAME'];
			$obj["Bankrupt"][$i]['provName'] 					= $recSelectDataBank['PROV_NAME'];
			$obj["Bankrupt"][$i]['zipCode'] 					= $recSelectDataBank['ZIP_CODE'];
			$obj["Bankrupt"][$i]['concernNo'] 					= $recSelectDataBank['CONCERN_NO'];
			$obj["Bankrupt"][$i]['deptName'] 					= $recSelectDataBank['DEPT_NAME'];
			$obj['Bankrupt'][$i]['lockPersonStatus'] 			= $recSelectDataBank['LOCK_PERSON_STATUS'];
			$obj['Bankrupt'][$i]['lockPersonStatusText'] 		= $recSelectDataBank['LOCK_PERSON_STATUS_TEXT'];
			$obj['Bankrupt'][$i]['orderStatus'] 				= $recSelectDataBank['PER_ORDER_STATUS'];
			$i++;
		}
	}
}
$num = count($obj);

if ($num > 0) {

	$row['ResponseCode'] = array('ResCode' => '000', 'ResMeassage' => "SUCCESS");
	$row['Data'] = $obj;
	$row['POST'] = $ARRAY_POST;
	$row['sqlSelectDataALL_e'] = $sqlSelectDataALL_e;
	$row['result_PRE_CODE'] = $result_PRE_CODE;
	/* $row['test']=$test_data;
		$row['registerCode']=$POST['registerCode'];
		$row['registerCode2']=$POST['registerCode2']; */

	/* 	$row['qry']=[
			"sqlSelectDataBank"=>"$sqlSelectDataBank",
			"sqlSelectDataReh"=>$sqlSelectDataReh,
			"sqlSelectDataMed"=>$sqlSelectDataMed ,
		]; */
} else {

	$row['ResponseCode'] = array('ResCode' => '102', 'ResMeassage' => "NOT FOUND");
	$row['Data'] = $obj;
	$row['POST'] = $ARRAY_POST;
	$row['sqlSelectDataALL_e'] = $sqlSelectDataALL_e;
}

echo json_encode($row);
