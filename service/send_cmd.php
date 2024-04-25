<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$res = json_decode($str_json, true);
if($res['userName'] == 'BankruptDt' && $res['passWord'] == 'Debtor4321'){
  if($res['courtCode']){
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

  $obj['userName'] = $res['userName'];
  $obj['passWord'] = $res['passWord'];
  //-------------ประเภทการส่ง------------//
  $obj['reply'] = $res['reply'];  // 1 = การตอบกลับ
  $obj['notiPlanner'] = $res['notiPlanner'];  //  1 = แจ้งดำเนินการผู้ทำแผน
  //-------------Person----------------//
  if($res['centCmdSysGen'] == 1){
    $data_ck['userName'] = $obj['userName'];
    $data_ck['passWord'] = $obj['passWord'];
    $data_ck['shrCivilPersonMapGen'] = $res['shrCivilPersonMapGen'];

    $data_string = json_encode($data_ck);
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://103.40.146.73/ledservicelaw.php/CivilCheckPerson',
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
    $response_person = curl_exec($curl);
    $person = json_decode($response_person, true);

    $obj['personMap'] = $person['Data'][0][0]['SHR_CIVIL_PERSON_MAP_GEN'];
    $obj['firstName'] = $person['Data'][0][0]['PERSON_FULL_NAME'];
    $obj['registerCode'] = $person['Data'][0][0]['REGISTERCODE'];
    $obj['address'] = $person['Data'][0][0]['ADDR'];
    //-------------CMD_Main----------------//
    $obj['createByUserid'] = $res['createByUserid'];
    $obj['createDate'] = date("Y-m-d", strtotime($res['createDate']));
    $obj['createTime'] = date("h:i:s a", strtotime($res['createDate']));
    $obj['updateDate'] = date("Y-m-d", strtotime($res['updateDate']));
    $obj['updateTime'] = date("h:i:s a", strtotime($res['updateDate']));
    $obj['updateByUserid'] = $res['updateByUserid'];
    $obj['createByProgid'] = $res['createByProgid'];
    $obj['updateByProgid'] = $res['updateByProgid'];
    $obj['cmdId'] = $res['shrCmdOfficeGen'];
    // $obj['refID'] = $res[''];
    $obj['prefixBlackCase'] = $res['prefixBlackCase'];
    $obj['blackCase'] = $res['blackCase'];
    $obj['blackYy'] = $res['blackYy'];
    $obj['prefixRedCase'] = $res['prefixRedCase'];
    $obj['redCase'] = $res['redCase'];
    $obj['redYy'] = $res['redYy'];
    $obj['courtCode'] = $court_code;
    $obj['courtName'] = $court_name;
    $obj['systemName'] = $res['centCmdSysGen'];
    $obj['cmdType'] = $res['centCmdTypeGen'];
    $obj['caseType'] = $res['cmdCode'];
    $obj['personCode'] = $res['personCode'];
    $obj['toPersonCode'] = $res['toPersonCode'];
    $obj['sendTo'] = $res['toCentCmdSysGen'];
    $obj['toPrefixBlackCase'] = $res['toPrefixBlackCase'];
    $obj['toBlackCase'] = $res['toBlackCase'];
    $obj['toBlackYy'] = $res['toBlackYy'];
    $obj['toPrefixRedCase'] = $res['toPrefixRedCase'];
    $obj['toRedCase'] = $res['toRedCase'];
    $obj['toRedYy'] = $res['toRedYy'];
    $obj['toCourtName'] = $res['toCourtName'];
    // $obj['activeFlag'] = $res['activeFlag'];
    $obj['cmdAnswer'] = $res['finalFlag'];
    // $obj['civilPersonMap'] = $res['shrCivilPersonMapGen'];
    $obj['deptCode'] = $res['userDeptCode'];
    $obj['caseCode'] = $res['pccCaseGen'];
    $obj['civilCode'] = $res['pccCivilGen'];
    $obj['caseRecvCode'] = $res['pccCaseRecvGen'];
    $obj['dossControlCode'] = $res['pccDossControlGen'];
    $obj['audPrivateCode'] = $res['audPrivateGen'];
    $obj['accCode'] = $res['accCode'];
    $obj['centDeptGen'] = $res['centDeptGen'];
    $obj['recvNo'] = $res['recvNo'];
    $obj['recvYear'] = $res['recvYear'];

    // CMD_DETAILS
    $res_detail = $res['listDetails'];
    foreach($res_detail as $key => $value){
      // $obj['listDetails'][$key]['refDetailId'] = $val['refDetailId'];
      $obj['listDetails'][$key]['cmdId'] = $value['shrCmdOffice']['shrCmdOfficeGen'];
      $obj['listDetails'][$key]['cmdNote'] = $value['remark'];
      $obj['listDetails'][$key]['cmdDeDate']	=	date("Y-m-d", strtotime($value['createDate']));
      $obj['listDetails'][$key]['cmdDeTime']	=	date("h:i:s a", strtotime($value['createDate']));
      $obj['listDetails'][$key]['updateDate']	=	date("Y-m-d", strtotime($value['updateDate']));
      $obj['listDetails'][$key]['updateTime']	=	date("h:i:s a", strtotime($value['updateDate']));
      $obj['listDetails'][$key]['seq']	=	$value['seq'];
      $obj['listDetails'][$key]['createByUserId']	=	$value['createByUserid'];
      $obj['listDetails'][$key]['updateByUserId']	=	$value['updateByUserid'];
      $obj['listDetails'][$key]['createByProgId']	=	$value['createByProgid'];
      $obj['listDetails'][$key]['updateByProgId']	=	$value['updateByProgid'];
      $obj['listDetails'][$key]['activeFlag']	=	$value['activeFlag'];
      $obj['listDetails'][$key]['approveFlag']	=	$value['approveFlag'];
      $obj['listDetails'][$key]['approvePos']	=	$value['positionName'];
      $obj['listDetails'][$key]['subApprovePerson']	=	$value['toPersonCode'];
      $obj['listDetails'][$key]['approveHandle']	=	$value['approveHandle'];
    }

    // CMD_FILES
    $res_file = $res['listFiles'];
    foreach($res_file as $key => $val){
      $obj['listFiles'][$key]['createDate']	=	date("Y-m-d", strtotime($val['createDate']));
      $obj['listFiles'][$key]['createTime']	=	date("h:i:s a", strtotime($val['createDate']));
      $obj['listFiles'][$key]['updateDate']	=	date("Y-m-d", strtotime($val['updateDate']));
      $obj['listFiles'][$key]['updateTime']	=	date("h:i:s a", strtotime($val['updateDate']));
      $obj['listFiles'][$key]['createByUserId']	=	$val['createByUserid'];
      $obj['listFiles'][$key]['updateByUserId']	=	$val['updateByUserid'];
      $obj['listFiles'][$key]['createByProgId']	=	$val['createByProgid'];
      $obj['listFiles'][$key]['updateByProgId']	=	$val['updateByProgid'];
      $obj['listFiles'][$key]['deptCode'] = $val['userDeptCode'];
      $obj['listFiles'][$key]['eDocumentGen']	=	$val['shrEDocumentGen'];
      $obj['listFiles'][$key]['eDocumentName']	=	$val['shrEDocumentName'];
      $obj['listFiles'][$key]['eDocumentRemark']	=	$val['shrEDocumentRemark'];
      $obj['listFiles'][$key]['eDocumentUrl']	=	$val['shrEDocumentUrl'];
      $obj['listFiles'][$key]['activeFlag'] = $val['activeFlag'];
      $obj['listFiles'][$key]['cmdId'] = $val['shrCmdOffice']['shrCmdOfficeGen'];
      $obj['listFiles'][$key]['dossControlId'] = $val['pccDossControl']['pccDossControlGen'];
    }

      // CMD_ASSET
    $res_asset = $res['listAsset'];
    foreach($res_asset as $key => $v){
      $obj['listAsset'][$key]['createDate']	=	date("Y-m-d", strtotime($v['createDate']));
      $obj['listAsset'][$key]['createTime']	=	date("h:i:s a", strtotime($v['createDate']));
      $obj['listAsset'][$key]['updateDate']	=	date("Y-m-d", strtotime($v['updateDate']));
      $obj['listAsset'][$key]['updateTime']	=	date("h:i:s a", strtotime($v['updateDate']));
      $obj['listAsset'][$key]['createByUserId']	=	$v['createByUserid'];
      $obj['listAsset'][$key]['updateByUserId']	=	$v['updateByUserid'];
      $obj['listAsset'][$key]['createByProgId']	=	$v['createByProgid'];
      $obj['listAsset'][$key]['updateByProgId']	=	$v['updateByProgid'];
      $obj['listAsset'][$key]['userDeptCode'] = $v['userDeptCode'];
      $obj['listAsset'][$key]['captionReqNo']	=	$v['cfcCaptionReqGen'];
      $obj['listAsset'][$key]['propDet']	=	$v['propDet'];
      $obj['listAsset'][$key]['typeCode']	=	$v['typeCode'];
      $obj['listAsset'][$key]['typeDesc']	=	$v['typeDesc'];
      $obj['listAsset'][$key]['ratio'] = $v['ratio'];
      $obj['listAsset'][$key]['activeFlag'] = $v['activeFlag'];

      // CMD_ASSET_DETAILS
      $res_assetDetail = $v['shrCmdAssetDetailList'];
      foreach ($res_assetDetail as $ke => $va) {
        $obj['listAsset'][$key]['listAssetDetail'][$key]['createDate']	=	date("Y-m-d", strtotime($va['createDate']));
        $obj['listAsset'][$key]['listAssetDetail'][$key]['createTime']	=	date("h:i:s a", strtotime($va['createDate']));
        $obj['listAsset'][$key]['listAssetDetail'][$key]['updateDate']	=	date("Y-m-d", strtotime($va['updateDate']));
        $obj['listAsset'][$key]['listAssetDetail'][$key]['updateTime']	=	date("h:i:s a", strtotime($va['updateDate']));
        $obj['listAsset'][$key]['listAssetDetail'][$key]['createByUserId']	=	$va['createByUserid'];
        $obj['listAsset'][$key]['listAssetDetail'][$key]['updateByUserId']	=	$va['updateByUserid'];
        $obj['listAsset'][$key]['listAssetDetail'][$key]['createByProgId']	=	$va['createByProgid'];
        $obj['listAsset'][$key]['listAssetDetail'][$key]['updateByProgId']	=	$va['updateByProgid'];
        $obj['listAsset'][$key]['listAssetDetail'][$key]['userDeptCode'] = $va['userDeptCode'];
        $obj['listAsset'][$key]['listAssetDetail'][$key]['remark']	=	$va['remark'];
        $obj['listAsset'][$key]['listAssetDetail'][$key]['activeFlag']	=	$va['activeFlag'];
      }
    }
  }else{
    $obj['prefixName'] = $res['prefixName'];
    $obj['firstName'] = $res['firstName'];
    $obj['lastName'] = $res['lastName'];
    $obj['registerCode'] = str_replace("-","",$res['registerCode']);
    $obj['address'] = $res['address'];
    $obj['phone'] = $res['phone'];
    $obj['fax'] = $res['fax'];
    $obj['mobile'] = $res['mobile'];
    $obj['email'] = $res['email'];

    $obj['cmdId'] = $res['cmdId'];
    $obj['refID'] = $res['refID'];
    $obj['cmdAnswer'] = $res['cmdAnswer'];
    $obj['createDate'] = $res['cmdDate'];
    $obj['createTime'] = $res['cmdTime'];
    $obj['updateDate'] = $res['cmdUpdateDate'];
    $obj['updateTime'] = $res['cmdUpdateTime'];
    $obj['systemName'] = $res['systemName'];
    $obj['cmdType'] = $res['cmdType'];
    $obj['caseType'] = $res['cmdStaff'];
    $obj['serviceCmdId'] = $res['serviceCmdId'];
    $obj['prefixBlackCase'] = $res['prefixBlackCase'];
    $obj['blackCase'] = $res['blackCase'];
    $obj['blackYy'] = $res['blackYy'];
    $obj['prefixRedCase'] = $res['prefixRedCase'];
    $obj['redCase'] = $res['redCase'];
    $obj['redYy'] = $res['redYy'];
    $obj['toPrefixBlackCase'] = $res['toPrefixBlackCase'];
    $obj['toBlackCase'] = $res['toBlackCase'];
    $obj['toBlackYy'] = $res['toBlackYy'];
    $obj['toPrefixRedCase'] = $res['toPrefixRedCase'];
    $obj['toRedCase'] = $res['toRedCase'];
    $obj['toRedYy'] = $res['toRedYy'];
    $obj['sendTo'] = $res['sendTo'];
    $obj['approveStatus'] = $res['approveStatus'];
    $obj['defendant'] = $res['defendant'];
    $obj['plaintiff'] = $res['plaintiff'];
    $obj['toDefendant'] = $res['toDefendant'];
    $obj['toPlaintiff'] = $res['toPlaintiff'];
    // $obj['courtCode'] = $court_code;
    $obj['courtName'] = $court_name;
    $obj['toCourtName'] = $res['toCourtName'];

    $res_detail = $res['cmdDetail'];
    foreach($res_detail as $key => $val){
      $obj['listDetails'][$key]['refDetailId'] = $val['refDetailId'];
      // $obj['listDetails'][$key]['cmdId'] = $val['cmdId'];
      $obj['listDetails'][$key]['cmdNote'] = $val['cmdNote'];
      $obj['listDetails'][$key]['cmdDeDate']	=	$val['cmdDeDate'];
      $obj['listDetails'][$key]['cmdDeTime']	=	$val['cmdDeTime'];
      $obj['listDetails'][$key]['updateDate']	=	$val['updateDate'];
      $obj['listDetails'][$key]['updateTime']	=	$val['updateTime'];
      $obj['listDetails'][$key]['approvePos']	=	$val['positionName'];
      $obj['listDetails'][$key]['approveFlag']	=	$val['subApproveStatus'];
      $obj['listDetails'][$key]['subApprovePerson']	=	$val['subApprovePerson'];
      $obj['listDetails'][$key]['approveHandle'] = $val['approveHandle'];
    }

    // CMD_FILES
    $res_file = $res['listFiles'];
    foreach($res_file as $key => $val){
      $obj['listFiles'][$key]['createDate']	=	date("Y-m-d", strtotime($val['createDate']));
      $obj['listFiles'][$key]['createTime']	=	date("h:i:s a", strtotime($val['createDate']));
      $obj['listFiles'][$key]['updateDate']	=	date("Y-m-d", strtotime($val['updateDate']));
      $obj['listFiles'][$key]['updateTime']	=	date("h:i:s a", strtotime($val['updateDate']));
      $obj['listFiles'][$key]['createByUserId']	=	$val['createByUserid'];
      $obj['listFiles'][$key]['updateByUserId']	=	$val['updateByUserid'];
      $obj['listFiles'][$key]['createByProgId']	=	$val['createByProgid'];
      $obj['listFiles'][$key]['updateByProgId']	=	$val['updateByProgid'];
      $obj['listFiles'][$key]['deptCode'] = $val['userDeptCode'];
      $obj['listFiles'][$key]['eDocumentGen']	=	$val['shrEDocumentGen'];
      $obj['listFiles'][$key]['eDocumentName']	=	$val['shrEDocumentName'];
      $obj['listFiles'][$key]['eDocumentRemark']	=	$val['shrEDocumentRemark'];
      $obj['listFiles'][$key]['eDocumentUrl']	=	$val['shrEDocumentUrl'];
      $obj['listFiles'][$key]['activeFlag'] = $val['activeFlag'];
      $obj['listFiles'][$key]['cmdId'] = $val['shrCmdOffice']['shrCmdOfficeGen'];
      $obj['listFiles'][$key]['dossControlId'] = $val['pccDossControl']['pccDossControlGen'];
    }

      // CMD_ASSET
    $res_asset = $res['listAsset'];
    foreach($res_asset as $key => $v){
      $obj['listAsset'][$key]['cmdAssetId'] = $v['shrCmdAssetGen'];
      $obj['listAsset'][$key]['cmdId'] = $v['shrCmdOffice']['shrCmdOfficeGen'];
      $obj['listAsset'][$key]['createDate']	=	date("Y-m-d", strtotime($v['createDate']));
      $obj['listAsset'][$key]['createTime']	=	date("h:i:s a", strtotime($v['createDate']));
      $obj['listAsset'][$key]['updateDate']	=	date("Y-m-d", strtotime($v['updateDate']));
      $obj['listAsset'][$key]['updateTime']	=	date("h:i:s a", strtotime($v['updateDate']));
      $obj['listAsset'][$key]['createByUserId']	=	$v['createByUserid'];
      $obj['listAsset'][$key]['updateByUserId']	=	$v['updateByUserid'];
      $obj['listAsset'][$key]['createByProgId']	=	$v['createByProgid'];
      $obj['listAsset'][$key]['updateByProgId']	=	$v['updateByProgid'];
      $obj['listAsset'][$key]['userDeptCode'] = $v['userDeptCode'];
      $obj['listAsset'][$key]['captionReqNo']	=	$v['cfcCaptionReqGen'];
      $obj['listAsset'][$key]['propDet']	=	$v['propDet'];
      $obj['listAsset'][$key]['typeCode']	=	$v['typeCode'];
      $obj['listAsset'][$key]['typeDesc']	=	$v['typeDesc'];
      $obj['listAsset'][$key]['ratio'] = $v['ratio'];
      $obj['listAsset'][$key]['activeFlag'] = $v['activeFlag'];

      // CMD_ASSET_DETAILS
      $res_assetDetail = $v['listAssetDetail'];
      foreach ($res_assetDetail as $ke => $va) {
        $obj['listAsset'][$key]['listAssetDetail'][$key]['listAssetId'] = $va['shrCmdAssetDetailGen'];
        $obj['listAsset'][$key]['listAssetDetail'][$key]['assetId'] = $va['shrCmdAssetGen'];
        $obj['listAsset'][$key]['listAssetDetail'][$key]['createDate']	=	date("Y-m-d", strtotime($va['createDate']));
        $obj['listAsset'][$key]['listAssetDetail'][$key]['createTime']	=	date("h:i:s a", strtotime($va['createDate']));
        $obj['listAsset'][$key]['listAssetDetail'][$key]['updateDate']	=	date("Y-m-d", strtotime($va['updateDate']));
        $obj['listAsset'][$key]['listAssetDetail'][$key]['updateTime']	=	date("h:i:s a", strtotime($va['updateDate']));
        $obj['listAsset'][$key]['listAssetDetail'][$key]['createByUserId']	=	$va['createByUserid'];
        $obj['listAsset'][$key]['listAssetDetail'][$key]['updateByUserId']	=	$va['updateByUserid'];
        $obj['listAsset'][$key]['listAssetDetail'][$key]['createByProgId']	=	$va['createByProgid'];
        $obj['listAsset'][$key]['listAssetDetail'][$key]['updateByProgId']	=	$va['updateByProgid'];
        $obj['listAsset'][$key]['listAssetDetail'][$key]['userDeptCode'] = $va['userDeptCode'];
        $obj['listAsset'][$key]['listAssetDetail'][$key]['remark']	=	$va['remark'];
        $obj['listAsset'][$key]['listAssetDetail'][$key]['activeFlag']	=	$va['activeFlag'];
      }
    }

    if($res['cmdType'] == 1){
      $sql_map_status = db::query("SELECT * FROM M_COURT_MAP WHERE COURT_CODE_REF ='".$res['orderCode']."'");
      $rec_map_status = db::fetch_array($sql_map_status);
      $obj['historyDate'] = $res['historyDate'];
      $obj['historyTime'] = $res['historyTime'];
      $obj['prefixBlackCaseHistory'] = $res['prefixBlackCaseHistory'];
      $obj['balckCaseHistory'] = $res['balckCaseHistory'];
      $obj['blackYyHistory'] = $res['blackYyHistory'];
      $obj['prefixRedCaseHistory'] = $res['prefixRedCaseHistory'];
      $obj['redCaseHistory'] = $res['redCaseHistory'];
      $obj['redYyHistory'] = $res['redYyHistory'];
      $obj['courtOrder'] = $res['courtOrder'];
      $obj['courtOrderDate'] = $res['courtOrderDate'];
      $obj['orderCode'] = $res['orderCode'];
      if($rec_map_status['ACT_FLAG_1'] == 1){
        $obj['orderStatus'] = "บังคับคดี";
      }
      if($rec_map_status['ACT_FLAG_1'] == 0){
        $obj['orderStatus'] = "ไม่ถูกบังคับคดี";
      }
    }
  }


  if($res['systemType'] == 'Civil' || $res['sendTo'] == 1 || $res['toCentCmdSysGen'] == 1){
    $url = connect_led_api('insertCmdNoti2');

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
    $response = curl_exec($curl);
    $resp = json_decode($response, true);
  }
  if($res['systemType'] == 'Bankrupt' || $res['sendTo'] == 2 || $res['toCentCmdSysGen'] == 2){
    $url = connect_api_bankrupt('insert_cmd.php');

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
    $response = curl_exec($curl);
    $resp = json_decode($response, true);
  }
  if($res['systemType'] == 'Revive' || $res['sendTo'] == 3 || $res['toCentCmdSysGen'] == 3){
    $url = connect_api_revive('insert_cmd.php');

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
    $response = curl_exec($curl);
    $resp = json_decode($response, true);
  }
  if($res['systemType'] == 'Mediate' || $res['sendTo'] == 4 || $res['toCentCmdSysGen'] == 4){
    $url = connect_api_mediate('insert_cmd.php');

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
    $response = curl_exec($curl);
    $resp = json_decode($response, true);
  }
}
  $num = count($obj);
  if($num > 0){

		$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");
		// $row['Data'] = $resp['Data'];
    $row['Data'] = $obj;

	}else{

		$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");

	}

	// print_pre($row);
	echo json_encode($row);

?>
