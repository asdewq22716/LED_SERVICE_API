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
      COURT_CODE_MD = '".$res['courtCode']."'
      OR COURT_CODE_LAW = '".$res['courtCode']."'";
    $qry = db::query($sql);
    $qry_data = db::fetch_array($qry);
    $court_name = $qry_data['COURT_NAME_LAW'];
    $court_code = $qry_data['COURT_CODE_MD'];
    }else{
    // $court_name = $res['courtName'];
    }

    $data_ck['userName'] = $obj['userName'] = 'BankruptDt';
    $data_ck['passWord'] = $obj['passWord'] = 'Debtor4321';
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

      // CMD_PERSON
        $obj['personMap'] = $person['Data'][0][0]['SHR_CIVIL_PERSON_MAP_GEN'];
  		$obj['firstName'] = $person['Data'][0][0]['PERSON_FULL_NAME'];
  		$obj['registerCode'] = $person['Data'][0][0]['REGISTERCODE'];
  		$obj['address'] = $person['Data'][0][0]['ADDR'];

      // CMD_MAIN
      $obj['createByUserid'] = $res['createByUserid'];
      $obj['createDate'] = date("Y-m-d", strtotime($res['createDate']));
      $obj['createTime'] = date("H:i:s", strtotime($res['createDate']));
      $obj['updateDate'] = date("Y-m-d", strtotime($res['updateDate']));
      $obj['updateTime'] = date("H:i:s", strtotime($res['updateDate']));
      $obj['updateByUserid'] = $res['updateByUserid'];
      $obj['createByProgid'] = $res['createByProgid'];
      $obj['updateByProgid'] = $res['updateByProgid'];
      $obj['cmdId'] = $res['shrCmdOfficeGen'];
      $obj['prefixBlackCase'] = $res['prefixBlackCase'];
      $obj['blackCase'] = $res['blackCase'];
      $obj['blackYy'] = $res['blackYy'];
      $obj['prefixRedCase'] = $res['prefixRedCase'];
      $obj['redCase'] = $res['redCase'];
      $obj['redYy'] = $res['redYy'];
      $obj['defendant'] = $res['defendant'];
      $obj['plaintiff'] = $res['plaintiff'];
      $obj['courtCode'] = $court_code;
      $obj['courtName'] = $court_name;
      $obj['systemName'] = $res['centCmdSysGen'];
      $obj['cmdType'] = $res['centCmdTypeGen'];
      $obj['caseType'] = $res['cmdCode'];
      $obj['personCode'] = $res['personCode'];
      $obj['toPersonCode'] = $res['toPersonCode'];
      $obj['toSystemName'] = $res['toCentCmdSysGen'];
      $obj['toPrefixBlackCase'] = $res['toPrefixBlackCase'];
      $obj['toBlackCase'] = $res['toBlackCase'];
      $obj['toBlackYy'] = $res['toBlackYy'];
      $obj['toPrefixRedCase'] = $res['toPrefixRedCase'];
      $obj['toRedCase'] = $res['toRedCase'];
      $obj['toRedYy'] = $res['toRedYy'];
      $obj['toDefendant'] = $res['toDefendant'];
      $obj['toPlaintiff'] = $res['toPlaintiff'];
      $obj['toCourtName'] = $res['toCourtName'];
      $obj['finalFlag'] = $res['finalFlag'];
      $obj['civilPersonMap'] = $res['shrCivilPersonMapGen'];
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
        // $obj['cmdDetail'][$key]['refDetailId'] = $val['refDetailId'];
        $obj['cmdDetail'][$key]['cmdId'] = $value['shrCmdOffice']['shrCmdOfficeGen'];
        $obj['cmdDetail'][$key]['cmdNote'] = $value['remark'];
    	$obj['cmdDetail'][$key]['cmdDeDate']	=	date("Y-m-d", strtotime($value['createDate']));
    	$obj['cmdDetail'][$key]['cmdDeTime']	=	date("H:i:s", strtotime($value['createDate']));
        $obj['cmdDetail'][$key]['updateDate']	=	date("Y-m-d", strtotime($value['updateDate']));
    	$obj['cmdDetail'][$key]['updateTime']	=	date("H:i:s", strtotime($value['updateDate']));
        $obj['cmdDetail'][$key]['seq']	=	$value['seq'];
        $obj['cmdDetail'][$key]['createByUserId']	=	$value['createByUserid'];
        $obj['cmdDetail'][$key]['updateByUserId']	=	$value['updateByUserid'];
        $obj['cmdDetail'][$key]['createByProgId']	=	$value['createByProgid'];
        $obj['cmdDetail'][$key]['updateByProgId']	=	$value['updateByProgid'];
        $obj['cmdDetail'][$key]['activeFlag']	=	$value['activeFlag'];
        $obj['cmdDetail'][$key]['approveHandle'] = $value['approveHandle'];
        $obj['cmdDetail'][$key]['handleName'] = $value['handleName'];
        $obj['cmdDetail'][$key]['positionName'] = $value['approvePos'];
        $obj['cmdDetail'][$key]['approveStatus'] = $value['approveStatus'];
      }

      // CMD_FILES
      $res_file = $res['listFiles'];
      foreach($res_file as $key => $val){
        $obj['cmdFile'][$key]['createDate']	=	date("Y-m-d", strtotime($val['createDate']));
    	$obj['cmdFile'][$key]['createTime']	=	date("H:i:s", strtotime($val['createDate']));
        $obj['cmdFile'][$key]['updateDate']	=	date("Y-m-d", strtotime($val['updateDate']));
    	$obj['cmdFile'][$key]['updateTime']	=	date("H:i:s", strtotime($val['updateDate']));
        $obj['cmdFile'][$key]['createByUserId']	=	$val['createByUserid'];
        $obj['cmdFile'][$key]['updateByUserId']	=	$val['updateByUserid'];
        $obj['cmdFile'][$key]['createByProgId']	=	$val['createByProgid'];
        $obj['cmdFile'][$key]['updateByProgId']	=	$val['updateByProgid'];
        $obj['cmdFile'][$key]['deptCode'] = $val['userDeptCode'];
    	$obj['cmdFile'][$key]['eDocumentGen']	=	$val['shrEDocumentGen'];
    	$obj['cmdFile'][$key]['eDocumentName']	=	$val['shrEDocumentName'];
        $obj['cmdFile'][$key]['eDocumentRemark']	=	$val['shrEDocumentRemark'];
        $obj['cmdFile'][$key]['eDocumentUrl']	=	$val['shrEDocumentUrl'];
    	$obj['cmdFile'][$key]['activeFlag'] = $val['activeFlag'];
    	$obj['cmdFile'][$key]['cmdId'] = $val['shrCmdOffice']['shrCmdOfficeGen'];
    	$obj['cmdFile'][$key]['dossControlId'] = $val['pccDossControl']['pccDossControlGen'];
      }

      // CMD_ASSET
      $res_asset = $res['listAsset'];
      foreach($res_asset as $key => $v){
        $obj['cmdAsset'][$key]['cmdAssetId'] = $v['shrCmdAssetGen'];
        $obj['cmdAsset'][$key]['shrCmdOffice'] = $v['shrCmdOffice']['shrCmdOfficeGen'];
        $obj['cmdAsset'][$key]['centCmdType'] = $v['shrCmdOffice']['centCmdTypeGen'];
        $obj['cmdAsset'][$key]['centCmd'] = $v['shrCmdOffice']['centCmdGen'];
        $obj['cmdAsset'][$key]['createDate']	=	date("Y-m-d", strtotime($v['createDate']));
    	$obj['cmdAsset'][$key]['createTime']	=	date("H:i:s", strtotime($v['createDate']));
        $obj['cmdAsset'][$key]['updateDate']	=	date("Y-m-d", strtotime($v['updateDate']));
    	$obj['cmdAsset'][$key]['updateTime']	=	date("H:i:s", strtotime($v['updateDate']));
        $obj['cmdAsset'][$key]['createByUserId']	=	$v['createByUserid'];
        $obj['cmdAsset'][$key]['updateByUserId']	=	$v['updateByUserid'];
        $obj['cmdAsset'][$key]['createByProgId']	=	$v['createByProgid'];
        $obj['cmdAsset'][$key]['updateByProgId']	=	$v['updateByProgid'];
        $obj['cmdAsset'][$key]['userDeptCode'] = $v['userDeptCode'];
    	$obj['cmdAsset'][$key]['captionReqNo']	=	$v['cfcCaptionReqGen'];
    	$obj['cmdAsset'][$key]['captionNo']	=	$v['cfcCaptionGen'];
    	$obj['cmdAsset'][$key]['propDet']	=	$v['propDet'];
        $obj['cmdAsset'][$key]['propStatus']	=	$v['propStatus'];
    	$obj['cmdAsset'][$key]['propStatusName'] = $v['propStatusName'];
        $obj['cmdAsset'][$key]['typeCode']	=	$v['typeCode'];
        $obj['cmdAsset'][$key]['typeDesc']	=	$v['typeDesc'];
    	$obj['cmdAsset'][$key]['ratio'] = $v['ratio'];
    	$obj['cmdAsset'][$key]['activeFlag'] = $v['activeFlag'];

      // CMD_ASSET_DETAILS
			$res_assetDetail = $res_asset[$key]['shrCmdAssetDetailList'];
      foreach ($res_assetDetail as $ke => $va) {
        $obj['cmdAsset'][$key]['cmdAssetDetail'][$ke]['listAssetId'] = $va['shrCmdAssetDetailGen'];
        $obj['cmdAsset'][$key]['cmdAssetDetail'][$ke]['assetId'] = $va['shrCmdAssetGen'];
        $obj['cmdAsset'][$key]['cmdAssetDetail'][$ke]['createDate']	=	date("Y-m-d", strtotime($va['createDate']));
    	$obj['cmdAsset'][$key]['cmdAssetDetail'][$ke]['createTime']	=	date("H:i:s", strtotime($va['createDate']));
        $obj['cmdAsset'][$key]['cmdAssetDetail'][$ke]['updateDate']	=	date("Y-m-d", strtotime($va['updateDate']));
    	$obj['cmdAsset'][$key]['cmdAssetDetail'][$ke]['updateTime']	=	date("H:i:s", strtotime($va['updateDate']));
        $obj['cmdAsset'][$key]['cmdAssetDetail'][$ke]['createByUserId']	=	$va['createByUserid'];
        $obj['cmdAsset'][$key]['cmdAssetDetail'][$ke]['updateByUserId']	=	$va['updateByUserid'];
        $obj['cmdAsset'][$key]['cmdAssetDetail'][$ke]['createByProgId']	=	$va['createByProgid'];
        $obj['cmdAsset'][$key]['cmdAssetDetail'][$ke]['updateByProgId']	=	$va['updateByProgid'];
        $obj['cmdAsset'][$key]['cmdAssetDetail'][$ke]['userDeptCode'] = $va['userDeptCode'];
    	$obj['cmdAsset'][$key]['cmdAssetDetail'][$ke]['remark']	=	$va['remark'];
    	$obj['cmdAsset'][$key]['cmdAssetDetail'][$ke]['activeFlag']	=	$va['activeFlag'];
      }
    }

    // CMD_Paild การเงิน 
    $res_paild = $res['listPaid'];
    foreach($res_paild as $k => $value){
        $obj['cmdlistPaid'][$k]['audPaidGen']        = $value['audPaidGen'];
        $obj['cmdlistPaid'][$k]['activeFlag']        = $value['activeFlag'];
        $obj['cmdlistPaid'][$k]['pccDossControlGen'] = $value['pccDossControlGen'];
        $obj['cmdlistPaid'][$k]['doss']              = $value['doss'];
        $obj['cmdlistPaid'][$k]['trNoBook']          = $value['trNoBook'];
        $obj['cmdlistPaid'][$k]['trDate']            = date("Y-m-d", strtotime($value['trDate']));

        $res_paild_Detail = $res_paild[$k]['shrCmdPaidtDetailList'];
        foreach ($res_paild_Detail as $ke1 => $va1) {
          $obj['cmdlistPaid'][$k]['cmdPaidDetail'][$ke1]['version']          = $va1['version'];
          $obj['cmdlistPaid'][$k]['cmdPaidDetail'][$ke1]['sendwritBookNo']   = $va1['sendwritBookNo'];
          $obj['cmdlistPaid'][$k]['cmdPaidDetail'][$ke1]['trAmount']	     = $va1['trAmount'];
          $obj['cmdlistPaid'][$k]['cmdPaidDetail'][$ke1]['recpayName']	     = $va1['recpayName'];
          $obj['cmdlistPaid'][$k]['cmdPaidDetail'][$ke1]['sendwritBookDate'] = date("Y-m-d", strtotime($va1['sendwritBookDate']));
        
        }

        $res_paild_Type = $res_paild[$k]['shrCmdPaidTypeDetailList'];
        foreach ($res_paild_Type as $ke2 => $va2) {
          $obj['cmdlistPaid'][$k]['cmdPaidType'][$ke2]['rpayName']  = $va2['rpayName'];
          $obj['cmdlistPaid'][$k]['cmdPaidType'][$ke2]['chqNo']     = $va2['chqNo'];
          $obj['cmdlistPaid'][$k]['cmdPaidType'][$ke2]['chqDate']	= date("Y-m-d", strtotime($va2['chqDate']));
          $obj['cmdlistPaid'][$k]['cmdPaidType'][$ke2]['trAmount']	= $va2['trAmount'];
          $obj['cmdlistPaid'][$k]['cmdPaidType'][$ke2]['bankName']	= $va2['bankName'];
        
        }
    }

#### เงื่อนไขเปลี่ยนจาก $res['CentCmdSysGen'] เป็น $res['toCentCmdSysGen'] ณ วันที่ 30/3/2565 
#### ถ้าคำสั่งสอบถามหรือตอบกลับไม่เข้า ลองเปลี่ยนดูนะ

// Bankrupt
if($res['toCentCmdSysGen'] == 2){
    $data_string = json_encode($obj);
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://vpn.bizpotential.com:9090/save/insert_cmd_notification.php',
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
// Revive
if($res['toCentCmdSysGen'] == 3){
    $data_string = json_encode($obj);
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://103.208.27.224/led_revive/save/insert_cmd_noti.php',
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
// Mediate
  if($res['toCentCmdSysGen'] == 4){
    $data_string = json_encode($obj);
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://103.208.27.224/ega_led_mediate/save/insert_cmd_noti.php',
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
  // $num = count($obj);
  $num = count($resp);
  if($num > 0){

		$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");
		$row['Data'] = $resp['Data'];

	}else{

		$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");

	}
 
	// print_pre($row); 
	echo json_encode($row);
 
?>
