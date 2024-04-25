<?php
include '../include/include.php';
 

$str_json = file_get_contents("php://input");
$data = json_decode($str_json, true);
	
	$sql = "SELECT WH_CIVIL_ID FROM WH_CIVIL_CASE WHERE CIVIL_CODE = '".$data['civilCode']."'";
	$query = db::query($sql);
	$rec = db::fetch_array($query);
	
	$WH_CIVIL_ID = $rec['WH_CIVIL_ID'];
	
	$sql = "SELECT DOSS_ID FROM WH_CIVIL_DOSS WHERE DOSS_CONTROL_GEN = '".$data['pccDossControlGen']."'";
	$query = db::query($sql);
	$numrow = db::num_rows($query);
	$rec = db::fetch_array($query);
	
	$DOSS_ID = $rec['DOSS_ID']; 
	
	if($numrow > 0){

		$update = array();
		
		$update['DOSS_ID'] 	 			 = 	$DOSS_ID;
		$update['WH_CIVIL_ID']   		 = 	$WH_CIVIL_ID;
		$update['ACCOUNT_NO'] 		  	 = 	$data['accountNo'];
		$update['DOSS_CONTROL'] 		 = 	$data['dossName'];
		$update['DOSS_CONTROL_GEN'] 	 = 	$data['pccDossControlGen'];
		$update['DOSS_CODE'] 	  	 	 = 	$data['dossCode'];
		$update['DOSS_OWNER_ID'] 	 	 =	$data['centPersonGenOfficer'];
		$update['DOSS_OWNER_NAME'] 	  	 =  $data['dossOwnerName'];
		
		$cond = array();
		
		$cond['DOSS_ID']			 = $DOSS_ID;
		
		db::db_update("WH_CIVIL_DOSS",$update,$cond);
		
		
	}else{
		
		
		$insert = array();
		
		$insert['WH_CIVIL_ID']   		 = 	$WH_CIVIL_ID;
		$insert['ACCOUNT_NO'] 		  	 = 	$data['accountNo'];
		$insert['DOSS_CONTROL'] 		 = 	$data['dossName'];
		$insert['DOSS_CONTROL_GEN'] 	 = 	$data['pccDossControlGen'];
		$insert['DOSS_CODE'] 	  	 	 = 	$data['dossCode'];
		$insert['DOSS_OWNER_ID'] 	 	 =	$data['centPersonGenOfficer'];
		$insert['DOSS_OWNER_NAME'] 	  	 =  $data['dossOwnerName'];
		
		db::db_insert("WH_CIVIL_DOSS",$insert,'DOSS_ID','DOSS_ID');
		
	}
	$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");
	
echo json_encode($row); 
 ?>
  