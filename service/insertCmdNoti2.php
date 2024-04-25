<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include '../include/include.php';

$str_json = file_get_contents("php://input");
$res = json_decode($str_json, true);

if($res['userName'] == 'BankruptDt' && $res['passWord'] == 'Debtor4321'){

  $obj['userName'] = 'BankruptDt';
  $obj['passWord'] = 'Debtor4321';
  $obj['reply'] = $res['reply'];

  if($res['reply']=='1'){
	
    $url = connect_api_civil('replyCmd');
  }else{
	  
    $url = connect_api_civil('InsertCMD');
  }
	    if($res['courtCode']){
			
			$sql = "SELECT
					 *
				  FROM
					 M_COURT_CODE_MAP
				  WHERE
					COURT_CODE_LAW = '".$res['courtCode']."'";
			$qry = db::query($sql);
			$qry_data = db::fetch_array($qry);
			$court_name = $qry_data['COURT_NAME_LAW'];
			$court_code = $qry_data['COURT_CODE_MD'];
	    }else{
			
		  $court_name = $res['courtName'];
		  
	    }
		
	  $obj['registerCode'] = $res['registerCode'];
	  $obj['civilCode'] = $res['civilCode'];
	  $obj['cmdId'] = $res['cmdId'];
	  $obj['refID'] = $res['refID'];
	  $obj['createDate'] = $res['createDate'];
	  $obj['createTime'] = $res['createTime'];
	  $obj['updateDate'] = $res['updateDate'];
	  $obj['updateTime'] = $res['updateTime'];
	  $obj['prefixBlackCase'] = $res['toPrefixBlackCase'];
	  $obj['blackCase'] = $res['toBlackCase'];
	  $obj['blackYy'] = $res['toBlackYy'];
	  $obj['prefixRedCase'] = $res['toPrefixRedCase'];
	  $obj['redCase'] = $res['toRedCase'];
	  $obj['redYy'] = $res['toRedYy'];
	  $obj['courtCode'] = $court_code;
	  $obj['courtName'] = $court_name;
	  $obj['from'] = $res['sendTo'];
	  $obj['cmdType'] = $res['cmdType'];
	  $obj['cmdCode'] = $res['cmdStaff'];
	  $obj['serviceCmdId'] = $res['serviceCmdId'];
	  $obj['personCode'] = $res['personCode'];
	  $obj['toPersonCode'] = $res['toPersonCode'];
	  $obj['isApprove'] = $res['approveStatus'];
	  $obj['sendTo'] = $res['systemName'];
	  $obj['toPrefixBlackCase'] = $res['prefixBlackCase'];
	  $obj['toBlackCase'] = $res['blackCase'];
	  $obj['toBlackYy'] = $res['blackYy'];
	  $obj['toPrefixRedCase'] = $res['prefixRedCase'];
	  $obj['toRedCase'] = $res['redCase'];
	  $obj['toRedYy'] = $res['redYy'];
	  $obj['toCourtName'] = $res['toCourtName'];
	  $obj['toDefendant'] = $res['defendant'];
	  $obj['toPlaintiff'] = $res['plaintiff'];
	  $obj['defendant'] = $res['toDefendant'];
	  $obj['plaintiff'] = $res['toPlaintiff'];
	  $obj['finalFlag'] = $res['cmdAnswer'];
	  $obj['shrCivilPersonMapGen'] = $res['shrCivilPersonMapGen'];
	  
	  $sql = "SELECT CMD_ACT_FLAG_1 FROM M_SERVICE_CMD WHERE CMD_TYPE_CODE = '".$res['cmdStaff']."'";
	  $query = db::query($sql);
	  $data = db::fetch_array($query);
	  if($data){
		$obj['lockStatus'] = $data['CMD_ACT_FLAG_1']; 
	  }
	

	  $res_detail = $res['cmdDetail'];
	  foreach($res_detail as $key => $val){
		if($val['refDetailId']){
			$obj['approveText'] = $val['cmdNote'];
		}else{
			// $obj['refDetailId'] = $val['refDetailId'];
			// $obj['cmdId'] = $val['cmdId'];
			$obj['approveText'] = $val['cmdNote'];
			$obj['remark'] = $val['cmdNote'];
			$obj['approveFlag']	=	$val['subApproveStatus'];
			$obj['toPersonCodeDetail']	=	$val['subApprovePerson'];
			$obj['approveHandle'] = $val['handleName'];
		}
	  } 
	   $obj['cmdAsset'] = $res['cmdAsset']; 
	$data_string = json_encode($obj);
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
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
   $reponse = curl_exec($curl);
   $data = json_decode($reponse ,true);
	// print_pre($data);

}

  if($data['ResponseCode']['ResMeassage'] == 'SUCCESS'){

		$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");
		// $row['Url'] = $url;
		// $row['obj'] = $obj;

	}else{

		$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");

	}

	echo json_encode($row);

?>
