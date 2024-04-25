<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$res = json_decode($str_json, true);
if($res['userName'] == 'BankruptDt' && $res['passWord'] == 'Debtor4321'){
  if($res['systemType'] == 'Revive'){
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

    $obj['userName'] = 'BankruptDt';
    $obj['passWord'] = 'Debtor4321';
    $obj['reply'] = $res['reply'];
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
    $obj['cmdId'] = $res['cmdId'];
    $obj['refID'] = $res['refID'];
    $obj['cmdAnswer'] = $res['cmdAnswer'];
    $obj['cmdDate'] = $res['cmdDate'];
    $obj['cmdTime'] = $res['cmdTime'];
    $obj['cmdUpdateDate'] = $res['cmdUpdateDate'];
    $obj['cmdUpdateTime'] = $res['cmdUpdateTime'];
    $obj['cmdStaff'] = $res['cmdStaff'];
    $obj['courtCode'] = $court_code;
    $obj['courtName'] = $court_name;
    $obj['systemName'] = $res['systemName'];
    $obj['cmdType'] = $res['cmdType'];
    $obj['prefixBlackCase'] = $res['prefixBlackCase'];
    $obj['blackCase'] = $res['blackCase'];
    $obj['blackYY'] = $res['blackYY'];
    $obj['prefixRedCase'] = $res['prefixRedCase'];
    $obj['redCase'] = $res['redCase'];
    $obj['redYY'] = $res['redYY'];
    if($res['from']){
      $obj['sendTo'] = $res['from'];
    }else{
      $obj['sendTo'] = $res['sendTo'];
    }
    $obj['defendant'] = $res['defendant'];
    $obj['plaintiff'] = $res['plaintiff'];
    $obj['priorityStatus'] = $res['priorityStatus'];
    $obj['readStatus'] = $res['readStatus'];
    $obj['approveStatus'] = $res['approveStatus'];
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
      CURLOPT_URL => 'http://103.208.27.224/led_revive/save/insert_cmd_person_revive.php',
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
  $re = json_decode($response, true);
  }

  if($res['systemType'] == 'Mediate'){
      if($res['courtCode'] != "" || $res['courtCode'] != null){
        $sql = "SELECT
        	*
        FROM
        	M_COURT_CODE_MAP
        WHERE
        	COURT_CODE_MD = ".$res['courtCode'];
        $qry = db::query($sql);
        $qry_data = db::fetch_array($qry);
        $court_name = $qry_data['COURT_NAME_LAW'];
        $court_code = $qry_data['COURT_CODE_MD'];
      }else{
        $court_name = $res['courtName'];
      }

    $obj['userName'] = 'BankruptDt';
    $obj['passWord'] = 'Debtor4321';
    $obj['reply'] = $res['reply'];
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
    $obj['cmdId'] = $res['cmdId'];
    $obj['refID'] = $res['refID'];
    $obj['cmdAnswer'] = $res['cmdAnswer'];
    $obj['cmdDate'] = $res['cmdDate'];
    $obj['cmdTime'] = $res['cmdTime'];
    $obj['cmdUpdateDate'] = $res['cmdUpdateDate'];
    $obj['cmdUpdateTime'] = $res['cmdUpdateTime'];
    $obj['cmdStaff'] = $res['cmdStaff'];
    $obj['courtCode'] = $court_code;
    $obj['courtName'] = $court_name;
    $obj['systemName'] = $res['systemName'];
    $obj['cmdType'] = $res['cmdType'];
    $obj['prefixBlackCase'] = $res['prefixBlackCase'];
    $obj['blackCase'] = $res['blackCase'];
    $obj['blackYY'] = $res['blackYY'];
    $obj['prefixRedCase'] = $res['prefixRedCase'];
    $obj['redCase'] = $res['redCase'];
    $obj['redYY'] = $res['redYY'];
    if($res['from']){
      $obj['sendTo'] = $res['from'];
    }else{
      $obj['sendTo'] = $res['sendTo'];
    }
    $obj['sendTo'] = $res['from'];
    $obj['defendant'] = $res['defendant'];
    $obj['plaintiff'] = $res['plaintiff'];
    $obj['priorityStatus'] = $res['priorityStatus'];
    $obj['readStatus'] = $res['readStatus'];
    $obj['approveStatus'] = $res['approveStatus'];
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
