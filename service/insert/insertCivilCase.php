<?php
include '../include/include.php';
 

$str_json = file_get_contents("php://input");
$data = json_decode($str_json, true);
	
	$sql = "SELECT WH_CIVIL_ID FROM WH_CIVIL_CASE WHERE CIVIL_CODE = '".$data['civilCode']."'";
	$query = db::query($sql);
	$numrow = db::num_rows($query);
	$rec = db::fetch_array($query);
	
	$WH_CIVIL_ID = $rec['WH_CIVIL_ID']; 
	
	if($numrow > 0){

		$update = array();
		
		$update['CIVIL_CODE'] 	 		 = 	$data['civilCode'];
		$update['COURT_CODE']   		 = 	$data['courtCode'];
		$update['COURT_NAME'] 		  	 = 	$data['courtName'];
		$update['DEPT_CODE'] 		  	 = 	$data['deptCode'];
		$update['DEPT_NAME'] 		  	 = 	$data['deptName'];
		$update['CASE_TYPE_CODE'] 	  	 = 	$data['caseTypeCode'];
		$update['PREFIX_BLACK_CASE'] 	 =	$data['prefixBlackCase'];
		$update['BLACK_CASE'] 	  	 	 =  $data['blackCase'];
		$update['BLACK_YY'] 	  	 	 = 	$data['blackYy'];
		$update['PREFIX_RED_CASE'] 	  	 = 	$data['prefixRedCase'];
		$update['RED_CASE'] 	  	 	 = 	$data['redCase'];
		$update['RED_YY'] 	  	 		 = 	$data['redYy'];
		$update['COURT_DATE'] 	  	 	 = 	$data['courtDate'];
		$update['CAPITAL_AMOUNT']   	 = 	$data['carptalAmount'];
		$update['PLAINTIFF1']   	 	 = 	$data['plaintiff1'];
		$update['PLAINTIFF2']  	 	 	 = 	$data['plaintiff2'];
		$update['PLAINTIFF3'] 	  	 	 = 	$data['plaintiff3'];
		$update['DEFFENDANT1'] 	  	 	 = 	$data['deffendant1'];
		$update['DEFFENDANT2'] 		  	 = 	$data['deffendant2'];
		$update['DEFFENDANT3']	 	 	 = 	$data['deffendant3'];
		$update['IMAGE_COURT'] 			 = 	$data['imageCourt'];
		$update['LOCUTION'] 	   	 	 = 	$data['locition'];
		$update['CASE_TYPE_NAME'] 		 = 	$data['caseTypeName'];
		$update['CASE_LAWS_CODE']		 = 	$data['caseLawsCode'];
		$update['CASE_LAWS_NAME']		 = 	$data['caseLawsName'];
		$update['PCC_CASE_GEN']			 = 	$data['pccCaseGen'];
		
		
		$cond = array();
		
		$cond['WH_CIVIL_ID']			 = $WH_CIVIL_ID;
		
		db::db_update("WH_CIVIL_CASE",$update,$cond);
		
		
	}else{
		
		
		$insert = array();
		
		$insert['CIVIL_CODE'] 	 		 = 	$data['civilCode'];
		$insert['COURT_CODE']   		 = 	$data['courtCode'];
		$insert['COURT_NAME'] 		  	 = 	$data['courtName'];
		$insert['DEPT_CODE'] 		  	 = 	$data['deptCode'];
		$insert['DEPT_NAME'] 		  	 = 	$data['deptName'];
		$insert['CASE_TYPE_CODE'] 	  	 = 	$data['caseTypeCode'];
		$insert['PREFIX_BLACK_CASE'] 	 =	$data['prefixBlackCase'];
		$insert['BLACK_CASE'] 	  	 	 =  $data['blackCase'];
		$insert['BLACK_YY'] 	  	 	 = 	$data['blackYy'];
		$insert['PREFIX_RED_CASE'] 	  	 = 	$data['prefixRedCase'];
		$insert['RED_CASE'] 	  	 	 = 	$data['redCase'];
		$insert['RED_YY'] 	  	 		 = 	$data['redYy'];
		$insert['COURT_DATE'] 	  	 	 = 	$data['courtDate'];
		$insert['CAPITAL_AMOUNT']   	 = 	$data['carptalAmount'];
		$insert['PLAINTIFF1']   	 	 = 	$data['plaintiff1'];
		$insert['PLAINTIFF2']  	 	 	 = 	$data['plaintiff2'];
		$insert['PLAINTIFF3'] 	  	 	 = 	$data['plaintiff3'];
		$insert['DEFFENDANT1'] 	  	 	 = 	$data['deffendant1'];
		$insert['DEFFENDANT2'] 		  	 = 	$data['deffendant2'];
		$insert['DEFFENDANT3']	 	 	 = 	$data['deffendant3'];
		$insert['IMAGE_COURT'] 			 = 	$data['imageCourt'];
		$insert['LOCUTION'] 	   	 	 = 	$data['locition'];
		$insert['CASE_TYPE_NAME'] 		 = 	$data['caseTypeName'];
		$insert['CASE_LAWS_CODE']		 = 	$data['caseLawsCode'];
		$insert['CASE_LAWS_NAME']		 = 	$data['caseLawsName'];
		$insert['PCC_CASE_GEN']			 = 	$data['pccCaseGen'];
		
		db::db_insert("WH_CIVIL_CASE",$insert,'WH_CIVIL_ID','WH_CIVIL_ID');
		
	}
	$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");
	
echo json_encode($row); 
 ?>
  