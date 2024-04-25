<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$res = json_decode($str_json, true);
if($res['userName'] == 'BankruptDt' && $res['passWord'] == 'Debtor4321' && $res['systemType'] == 'Mediate'){

  $sql = "SELECT
  	*
  FROM
  	M_COURT_CODE_MAP
  WHERE
  	COURT_CODE_RV = ".$res['courtCode'];
  $qry = db::query($sql);
  $qry_data = db::fetch_array($qry);

  $obj['userName'] = 'BankruptDt';
  $obj['passWord'] = 'Debtor4321';
  $obj['systemType'] = $value['systemType'];
  //----------------person-----------------//
  $obj['prefixName'] = $res['prefixName'];
  $obj['firstName'] = $res['firstName'];
  $obj['lastName']	=	$res['lastName'];
  $obj['registerCode'] = $res['registerCode'];
  $obj['address'] = $res['address'];
  $obj['phone'] = $res['phone'];
  $obj['fax'] = $res['fax'];
  $obj['mobile'] = $res['mobile'];
  $obj['email'] = $res['email'];
  //----------------cmd-----------------//
  $obj['cmdDate'] = $res['cmdDate'];
  $obj['cmdStaff'] = $res['cmdStaff'];
  $obj['courtCode'] = $qry_data['COURT_CODE_MD'];
  $obj['prefixBlackCase'] = $res['prefixBlackCase'];
  $obj['blackCase'] = $res['blackCase'];
  $obj['blackYY'] = $res['blackYY'];
  $obj['prefixRedCase'] = $res['prefixRedCase'];
  $obj['redCase'] = $res['redCase'];
  $obj['redYY'] = $res['redYY'];
  $obj['sendTo'] = $res['sendTo'];
  $obj['defendant'] = $res['defendant'];
  $obj['plaintiff'] = $res['plaintiff'];
  $obj['priorityStatus'] = $res['priorityStatus'];
  $obj['readStatus'] = $res['readStatus'];
  //----------------cmd details-----------------//
  $obj['cmdNote'] = $res['cmdNote'];
  $obj['cmdDeDate']	=	$res['cmdDeDate'];
  $obj['cmdDeTime']	=	$res['cmdDeTime'];
  $obj['preNameHandle'] = $res['preNameHandle'];
  $obj['firstNameHandle'] = $res['firstNameHandle'];
  $obj['lastNameHandle'] = $res['lastNameHandle'];

  $data_string = json_encode($obj);
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://103.208.27.224/ega_led_mediate/save/insert_cmd_person_mediate.php',
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
}
  $num = count($obj);
  if($num > 0){

		$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");
		$row['Data'] = $obj;

	}else{

		$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");

	}

	// print_pre($row);
	echo json_encode($row);

?>
