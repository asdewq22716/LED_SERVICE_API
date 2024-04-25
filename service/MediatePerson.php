<?php
include '../include/include.php'; 
include 'include/connect_db_service.php'; 
include "include/config_db_service.php";

if($_GET['RegisterCode'] != '' || $_GET['FirstName'] != '' || $_GET['LastName'] != '' || $_GET['CourtCode'] != '' || $_GET['PrefixBlackCase'] != '' || $_GET['BlackCase'] != '' || $_GET['BlackYY'] != '' || $_GET['PrefixRedCase'] != '' || $_GET['RedCase'] != '' || $_GET['RedYY'] != ''){
	//=============GET
	$filter = "";
	$filter_2 = "";
	if($_GET['RegisterCode'] != ''){
		$filter_2 .= " AND (FRM_RELATED_PERSONS.RP_IDCARD = '".$_GET['RegisterCode']."' OR FRM_RELATED_PERSONS.RP_LP_NUMBER = '".$_GET['RegisterCode']."')";
	}
	if($_GET['FirstName'] != ''){
		$filter_2 .= " AND FRM_RELATED_PERSONS.RP_FNAME = '".$_GET['FirstName']."'";
	}
	if($_GET['LastName'] != ''){
		$filter_2 .= " AND FRM_RELATED_PERSONS.RP_LNAME = '".$_GET['LastName']."'";
	}
	if($_GET['CourtCode'] != ''){
		$filter .= " AND M_COURT.COURT_CODE = '".$_GET['CourtCode']."'";
	}
	if($_GET['PrefixBlackCase'] != ''){
		$filter .= " AND WFR_PETITION_NOR.BLACK_CASE_TITLE = '".$_GET['PrefixBlackCase']."'";
	}
	if($_GET['BlackCase'] != ''){
		$filter .= " AND WFR_PETITION_NOR.BLACK_CASE_NO_SHW = '".$_GET['BlackCase']."'";
	}
	if($_GET['BlackYY'] != ''){
		$filter .= " AND WFR_PETITION_NOR.YEAR_BLACK = '".$_GET['BlackYY']."'";
	}
	if($_GET['PrefixRedCase'] != ''){ 
		$filter .= " AND WFR_PETITION_NOR.RED_CASE_TITLE = '".$_GET['PrefixRedCase']."'";
	}
	if($_GET['RedCase'] != ''){
		$filter .= " AND WFR_PETITION_NOR.RED_CASE_NO_SHW = '".$_GET['RedCase']."'";
	}
	if($_GET['RedYY '] != ''){
		$filter .= " AND WFR_PETITION_NOR.YEAR_RED = '".$_GET['RedYY ']."'";
	}

	//=======LED_MEDIATE
	$query = db::query("SELECT
							WFR_PETITION_NOR.WFR_ID,
							M_COURT.COURT_CODE,
							M_COURT.COURT_NAME,
							USR_DEPARTMENT.DEP_ID,
							USR_DEPARTMENT.DEP_NAME,
							WFR_PETITION_NOR.BLACK_CASE_TITLE,
							WFR_PETITION_NOR.BLACK_CASE_NO_SHW,
							WFR_PETITION_NOR.YEAR_BLACK,
							WFR_PETITION_NOR.RED_CASE_TITLE,
							WFR_PETITION_NOR.RED_CASE_NO_SHW,
							WFR_PETITION_NOR.YEAR_RED
						FROM
						WFR_PETITION_NOR 
						LEFT JOIN M_COURT ON M_COURT.COURT_ID = WFR_PETITION_NOR.COURT_ID
						LEFT JOIN USR_DEPARTMENT ON USR_DEPARTMENT.DEP_ID = WFR_PETITION_NOR.DEP_ID
						WHERE 1=1 {$filter}
						");
	while($rec = db::fetch_array($query)){
		$sql_p = "SELECT
						*
					FROM FRM_RELATED_PERSONS
					LEFT JOIN M_PREFIX_NAME TP ON TP.PREFIX_ID = FRM_RELATED_PERSONS.RP_PREFIX
					WHERE
						FRM_RELATED_PERSONS.WFR_ID = '".$rec['WFR_ID']."' {$filter2}
					ORDER BY F_ID
					";
		$query_p = db::query($sql_p);
		while($rec_p = db::fetch_array($query_p)){
			unset($data);
			$data['COURT_CODE'] 		= 	$rec['COURT_CODE'];
			$data['COURT_NAME'] 		= 	$rec['COURT_NAME'];
			$data['DEPT_CODE'] 			= 	$rec['DEP_ID'];
			$data['DEPT_NAME'] 			= 	$rec['DEP_NAME'];
			$data['PREFIX_BLACK_CASE'] 	= 	$rec['BLACK_CASE_TITLE'];
			$data['BLACK_CASE'] 		= 	$rec['BLACK_CASE_NO_SHW'];
			$data['BLACK_YY'] 			= 	$rec['YEAR_BLACK'];
			$data['PREFIX_RED_CASE'] 	= 	$rec['RED_CASE_TITLE'];
			$data['RED_CASE'] 			= 	$rec['RED_CASE_NO_SHW'];
			$data['RED_YY'] 			= 	$rec['YEAR_RED'];
			$data['RECORD_COUNT'] 		= 	'';
			// $data['PERSON_LIST'] 	=  	'';
			$data['REQ'] 				= 	'';
			$data['PERSON_CODE'] 		= 	'';
			if($rec_p['RP_TYPE']=='1'){
				$data['REGISTER_CODE'] 	= 	$rec_p['RP_IDCARD'];
			}else if($rec_p['RP_TYPE']=='2'){
				$data['REGISTER_CODE'] 	= 	$rec_p['RP_LP_NUMBER'];
			}
			$data['PREFIX_CODE'] 		= 	$rec_p['RP_PREFIX'];
			$data['PREFIX_NAME'] 		= 	$rec_p['PREFIX_NAME'];
			$data['FIRST_NAME'] 		= 	$rec_p['RP_FNAME'];
			$data['LAST_NAME'] 			= 	$rec_p['RP_LNAME'];
			$data['CONCERN_CODE'] 		= 	$rec_p['RP_ANOTHER_TYPE'];
			if($rec_p['RP_ANOTHER_TYPE']==1){
				$data['CONCERN_NAME'] 	= 	'โจทก์/ผู้รับมอบอำนาจโจทก์';
			}else if($rec_p['RP_ANOTHER_TYPE']==2){
				$data['CONCERN_NAME'] 	= 	'จำเลย/ผู้รับมอบอำนาจจำเลย';
			}else if($rec_p['RP_ANOTHER_TYPE']==3){
				$data['CONCERN_NAME'] 	= 	'ผู้ยื่น/ผู้มีส่วนได้ส่วนเสีย/ผู้สวมสิทธิ์';
			}
			$data['CONCERN_NO'] 		= 	$rec_p['RP_RANK'];
			$data['ADDRESS'] 			= 	$rec_p['RP_NO'].' '.$rec_p['RP_MOO'].' '.$rec_p['RP_SOI'].' '.$rec_p['RP_ROAD'];
		   
			$tum = substr($rec_p['RP_TUMBON_ID'],0,2);
			$tum2 = substr($rec_p['RP_TUMBON_ID'],2,2);
			$tum3 = substr($rec_p['RP_TUMBON_ID'],4,2);
			$sql_t = "SELECT
						*
					FROM G_TAMBON
					WHERE
						PROVINCE_CODE = '".$tum."' AND AMPHUR_CODE = '".$tum2."' AND TAMBON_CODE = '".$tum3."'
					ORDER BY F_ID
					";
			$query_t = db::query($sql_t);
			$rec_t = db::fetch_array($query_t);

			$data['TUM_CODE'] 		= 	$rec_p['RP_TUMBON_ID'];
			$data['TUM_NAME'] 		= 	$rec_t['TAMBON_NAME'];
			$data['AMP_CODE'] 		= 	$rec_p['RP_AMPHUR_ID'];
			$data['AMP_NAME'] 		= 	$rec_t['AMPHUR_NAME'];
			$data['PROV_CODE'] 		= 	$rec_p['RP_PROVINCE_ID'];
			$data['PROV_NAME'] 		= 	$rec_t['PROVINCE_NAME'];
			$data['ZIP_CODE'] 		= 	$rec_p['RP_ZIPCODE'];

			db2::db_insert('WH_MEDIATE_PERSON', $data);
		}
	}
}
?>