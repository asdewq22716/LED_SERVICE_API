<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$res = json_decode($str_json, true);
$systemArr = array(
				 "1"=>"ระบบงานบังคับคดีแพ่ง"
				,"2"=>"ระบบงานบังคับคดีล้มละลาย"
				,"3"=>"ระบบงานฟื้นฟูกิจการของลูกหนี้"
				,"4"=>"ระบบงานไกล่เกลี่ยข้อพิพาท"
				,"5"=>"Back OFFICE"
				,"6"=>"DEBTOR"
			);

if($res['userName'] == 'BankruptDt' && $res['passWord'] == 'Debtor4321'){
	
	if($res['courtCode'] != "" || $res['courtCode'] != null){
		$sql = "SELECT
			*
		  FROM
			M_COURT_CODE_MAP
		  WHERE
			COURT_CODE_MD = ".$res['courtCode'];
		$qry = db::query($sql);
		$qry_data = db::fetch_array($qry);
		$obj['courtCode'] = $qry_data['COURT_CODE_MD'];
		$court_name = $qry_data['COURT_NAME_LAW'];
		$court_code = $qry_data['COURT_CODE_MD'];
    }else{
		$court_name = $res['courtName'];
    } 
	
	$cmd = array();
	$cmd['cmdMain'] = array();
	$cmd['cmdPerson'] = array();
	$cmd['cmdDetail'] = array();
	
	$cmd['userName'] = 'BankruptDt';
    $cmd['passWord'] = 'Debtor4321';
	
	$cmdMain = $cmd['cmdMain'];
	
		$cmdMain['courtCode'] = $res['courtCode'];
		$cmdMain['reply'] = $res['reply'];
		$cmdMain['cmdId'] = $res['cmdId'];
		$cmdMain['refID'] = $res['refID'];
		$cmdMain['cmdAnswer'] = $res['cmdAnswer'];
		$cmdMain['cmdDate'] = $res['cmdDate'];
		$cmdMain['cmdTime'] = $res['cmdTime'];
		$cmdMain['cmdUpdateDate'] = $res['cmdUpdateDate'];
		$cmdMain['cmdUpdateTime'] = $res['cmdUpdateTime'];
		$cmdMain['cmdStaff'] = $res['cmdStaff'];
		$cmdMain['systemName'] = $res['systemName'];
		$cmdMain['cmdType'] = $res['cmdType'];
		$cmdMain['prefixBlackCase'] = $res['prefixBlackCase'];
		$cmdMain['blackCase'] = $res['blackCase'];
		$cmdMain['blackYY'] = $res['blackYY'];
		$cmdMain['prefixRedCase'] = $res['prefixRedCase'];
		$cmdMain['redCase'] = $res['redCase'];
		$cmdMain['redYY'] = $res['redYY'];
		$cmdMain['sendTo'] = $res['from'];
		$cmdMain['courtCode'] = $court_code;
		$cmdMain['courtName'] = $court_name;
	
	$cmdPerson = $cmd['cmdPerson'];
	
		$cmdPerson['prefixName'] = $res['prefixName'];
		$cmdPerson['firstName'] = $res['firstName'];
		$cmdPerson['lastName'] = $res['lastName'];
		$cmdPerson['registerCode'] = $res['registerCode'];
		$cmdPerson['address'] = $res['address'];
		$cmdPerson['phone'] = $res['phone'];
		$cmdPerson['fax'] = $res['fax'];
		$cmdPerson['mobile'] = $res['mobile'];
		$cmdPerson['email'] = $res['email'];
		
	$cmdDetail = $cmd['cmdDetail'];
	
		$cmdDetail['cmdNote'] = $res['cmdNote'];
		$cmdDetail['cmdDeDate']	=	$res['cmdDeDate'];
		$cmdDetail['cmdDeTime']	=	$res['cmdDeTime'];
		$cmdDetail['preNameHandle'] = $res['preNameHandle'];
		$cmdDetail['firstNameHandle'] = $res['firstNameHandle'];
		$cmdDetail['lastNameHandle'] = $res['lastNameHandle'];
		
	
	
// if($res['systemType'] == 'Revive'){
	if($res['sendTo'] == '3'){
	
		$url['Revive'] = connect_api_revive('insert_cmd_person_revive.php');
		curl($url['Revive'], $cmd);
	}

// if($res['systemType'] == 'Mediate'){
	if($res['sendTo'] == '4'){

		$data['Mediate'] = connect_api_mediate('insert_cmd_person_mediate.php');
		curl($url['Mediate'], $cmd);
	}

}
  $num = count($data);
  if($num > 0){

		$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");
		$row['Data'] = $data;

	}else{

		$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");

	}

	echo json_encode($row);

?>
