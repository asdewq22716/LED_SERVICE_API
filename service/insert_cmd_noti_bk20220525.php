<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$res = json_decode($str_json, true);
if ($POST['ip'])
{
    $ip = $POST['ip'];
}
else
{
    $ip = get_client_ip();
}
$field = array();
$field['IP_ADDRESS'] = $ip;
$field['DEP_ID'] = $POST['depId'];
$field['REQUEST'] = 'insert_cmd_noti';
$field['LOG_DATE'] = date("Y-m-d");
$field['USR_ID'] = '';
$field['REQUEST_STATUS'] = '200';
$field['USR_IDCARD'] = $POST['idCard'];
$field['LOG_TYPE'] = '1';

db::db_insert('M_LOG', $field, 'LOG_ID');

if ($res['userName'] == 'BankruptDt' && $res['passWord'] == 'Debtor4321')
{

    $obj['userName'] = 'BankruptDt';
    $obj['passWord'] = 'Debtor4321';
    $obj['reply'] = $res['reply'];
    $obj['notiStaff'] = $res['notiStaff'];

    $obj['prefixName'] = $res['prefixName'];
    $obj['firstName'] = $res['firstName'];
    $obj['lastName'] = $res['lastName'];
    $obj['registerCode'] = str_replace("-", "", $res['registerCode']);
    $obj['address'] = $res['address'];
    $obj['phone'] = $res['phone'];
    $obj['fax'] = $res['fax'];
    $obj['mobile'] = $res['mobile'];
    $obj['email'] = $res['email'];

    if ($res['courtCode'] != '')
    {
        $sql = "SELECT
    			*
    		  FROM
    			M_COURT_CODE_MAP
    		  WHERE
    			COURT_CODE_MD = '" . $res['courtCode'] ."' OR COURT_CODE_RV = '". $res['courtCode'] ."'" ;
        $qry = db::query($sql);
        $qry_data = db::fetch_array($qry);
        $court_name = $qry_data['COURT_NAME_LAW'];
        $court_code = $qry_data['COURT_CODE_MD'];
        $court_code_law = $qry_data['COURT_CODE_LAW'];
    }
    else
    {
        $court_name = $res['courtName'];
    }

    $obj['cmdId'] = $res['cmdId'];
    $obj['refID'] = $res['refID'];
    $obj['cmdAnswer'] = $res['cmdAnswer'];
    $obj['cmdDate'] = $res['cmdDate'];
    $obj['cmdTime'] = $res['cmdTime'];
    $obj['cmdUpdateDate'] = $res['cmdUpdateDate'];
    $obj['cmdUpdateTime'] = $res['cmdUpdateTime'];
    $obj['cmdStaff'] = $res['cmdStaff'];
    $obj['serviceCmdId'] = $res['serviceCmdId'];
    $obj['systemName'] = $res['systemName'];
    $obj['cmdType'] = $res['cmdType'];
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
	
	$cmdDate = $res['cmdDate'];
	
    if ($res['from'])
    {
        $obj['sendTo'] = $res['from'];
    }
    else
    {
        $obj['sendTo'] = $res['sendTo'];
    }
    $obj['priorityStatus'] = $res['priorityStatus'];
    $obj['readStatus'] = $res['readStatus'];
    $obj['approveStatus'] = $res['approveStatus'];
    $obj['defendant'] = $res['defendant'];
    $obj['plaintiff'] = $res['plaintiff'];
    $obj['toDefendant'] = $res['toDefendant'];
    $obj['toPlaintiff'] = $res['toPlaintiff'];
    $obj['courtCode'] = $court_code;
    $obj['courtName'] = $court_name;
    $obj['sendToPerson'] = $res['sendToPerson'];
    $obj['toCourtName'] = $res['toCourtName'];
    $obj['finalFlag'] = $res['finalFlag'];

    $res_detail = $res['cmdDetail'];
    foreach ($res_detail as $key => $val)
    {
        $obj['cmdDetail'][$key]['refDetailId'] = $val['refDetailId'];
        $obj['cmdDetail'][$key]['cmdId'] = $val['cmdId'];
        $obj['cmdDetail'][$key]['cmdNote'] = $val['cmdNote'];
        $obj['cmdDetail'][$key]['cmdDeDate'] = $val['cmdDeDate'];
        $obj['cmdDetail'][$key]['cmdDeTime'] = $val['cmdDeTime'];
        $obj['cmdDetail'][$key]['subApproveStatus'] = $val['subApproveStatus'];
        $obj['cmdDetail'][$key]['subApprovePerson'] = $val['subApprovePerson'];
        $obj['cmdDetail'][$key]['handleName'] = $val['handleName'];
		$userDisplayName = $val['handleName'];
		$cmdNote = $val['cmdNote'];
    }

    $res_file = $res['cmdFile'];
    foreach ($res_file as $key => $val)
    {
        $obj['cmdFile'][$key]['createDate'] = date("Y-m-d", strtotime($val['createDate']));
        $obj['cmdFile'][$key]['createTime'] = date("H:i:s", strtotime($val['createDate']));
        $obj['cmdFile'][$key]['updateDate'] = date("Y-m-d", strtotime($val['updateDate']));
        $obj['cmdFile'][$key]['updateTime'] = date("H:i:s", strtotime($val['updateDate']));
        $obj['cmdFile'][$key]['createByUserId'] = $val['createByUserid'];
        $obj['cmdFile'][$key]['updateByUserId'] = $val['updateByUserid'];
        $obj['cmdFile'][$key]['createByProgId'] = $val['createByProgid'];
        $obj['cmdFile'][$key]['updateByProgId'] = $val['updateByProgid'];
        $obj['cmdFile'][$key]['deptCode'] = $val['deptCode'];
        $obj['cmdFile'][$key]['eDocumentGen'] = $val['eDocumentGen'];
        $obj['cmdFile'][$key]['eDocumentName'] = $val['eDocumentName'];
        $obj['cmdFile'][$key]['eDocumentRemark'] = $val['eDocumentRemark'];
        $obj['cmdFile'][$key]['eDocumentUrl'] = $val['eDocumentUrl'];
        $obj['cmdFile'][$key]['activeFlag'] = $val['activeFlag'];
		
		$deptCode = $val['deptCode'];
		$eDocumentUrl = $val['eDocumentUrl'];
    }
    $res_asset = $res['cmdAsset'];
    if (count($res_asset) > 0)
    {
        foreach ($res_asset as $key => $v)
        {
            // $date = substr($v['createDate'],0,10);
            $date = $v['createDate'];
            $time = $v['createTime'];
            $creDate = strtotime("$time $date");
            $createDate = date("M d, Y h:i:sa", $creDate);

            // $d = substr($v['updateDate'],0,10);
            $d = $v['updateDate'];
            $t = $v['updateTime'];
            $upDate = strtotime("$t $d");
            $updateDate = date("M d, Y h:i:sa", $upDate);

            $obj['cmdAsset'][$key]['createDate'] = $createDate;
            $obj['cmdAsset'][$key]['updateDate'] = $updateDate;
            $obj['cmdAsset'][$key]['createByUserId'] = $v['createByUserid'];
            $obj['cmdAsset'][$key]['updateByUserId'] = $v['updateByUserid'];
            $obj['cmdAsset'][$key]['userDeptCode'] = $v['userDeptCode'];
            $obj['cmdAsset'][$key]['captionReqNo'] = $v['cfcCaptionReqGen'];
            $obj['cmdAsset'][$key]['captionNo'] = $v['cfcCaptionGen'];
            $obj['cmdAsset'][$key]['propDet'] = $v['propDet'];
            $obj['cmdAsset'][$key]['typeCode'] = $v['typeCode'];
            $obj['cmdAsset'][$key]['typeDesc'] = $v['typeDesc'];
            $obj['cmdAsset'][$key]['ratio'] = $v['ratio'];
            $obj['cmdAsset'][$key]['activeFlag'] = $v['activeFlag'];
            $obj['cmdAsset'][$key]['propStatusCode'] = $v['propStatusCode'];
            $obj['cmdAsset'][$key]['propStatusName'] = $v['propStatusName'];

            // CMD_ASSET_DETAILS
            $res_assetDetail = $res_asset[$key]['cmdAssetDetail'];
            foreach ($res_assetDetail as $ke => $va)
            {
                // $date = substr($va['createDate'],0,10);
                $date = $va['createDate'];
                $time = $va['createTime'];
                $creDate = strtotime("$time $date");
                $createDate = date("M d, Y h:i:sa", $creDate);

                // $d = substr($va['updateDate'],0,10);
                $d = $va['updateDate'];
                $t = $va['updateTime'];
                $upDate = strtotime("$t $d");
                $updateDate = date("M d, Y h:i:sa", $upDate);

                $obj['cmdAsset'][$key]['cmdAssetDetail'][$ke]['createDate'] = $createDate;
                $obj['cmdAsset'][$key]['cmdAssetDetail'][$ke]['updateDate'] = $updateDate;
                $obj['cmdAsset'][$key]['cmdAssetDetail'][$ke]['createByUserId'] = $va['createByUserid'];
                $obj['cmdAsset'][$key]['cmdAssetDetail'][$ke]['updateByUserId'] = $va['updateByUserid'];
                $obj['cmdAsset'][$key]['cmdAssetDetail'][$ke]['userDeptCode'] = $va['userDeptCode'];
                $obj['cmdAsset'][$key]['cmdAssetDetail'][$ke]['remark'] = $va['remark'];
                $obj['cmdAsset'][$key]['cmdAssetDetail'][$ke]['cmdType'] = $va['cmdType'];
                $obj['cmdAsset'][$key]['cmdAssetDetail'][$ke]['serviceCmd'] = $va['serviceCmd'];
                $obj['cmdAsset'][$key]['cmdAssetDetail'][$ke]['shrCmdAsset'] = $va['shrCmdAsset'];
            }
        }
    }
    $list_cmd_pail = $res['cmdPaid'];
    foreach ($list_cmd_pail as $k1 => $v1) {
       
        $obj['cmdPaid'][$k1]['doss']      = $v1['doss'];
        $obj['cmdPaid'][$k1]['trNoBook']  = $v1['trNoBook'];
        $obj['cmdPaid'][$k1]['trDate']    = $v1['trDate'];
        
    
        $list_pail_detail = $list_cmd_pail[$k1]['paidDetail'];
        foreach ($list_pail_detail as $ke1 => $va1) {
  
          $obj['cmdPaid'][$k1]['paidDetail'][$ke1]['sendwritBookNo'] = $va1['sendwritBookNo'];
          $obj['cmdPaid'][$k1]['paidDetail'][$ke1]['trAmount']       = $va1['trAmount'];
          $obj['cmdPaid'][$k1]['paidDetail'][$ke1]['recpayName']     = $va1['recpayName'];
          $obj['cmdPaid'][$k1]['paidDetail'][$ke1]['sendwritBookDate'] =  $va1['sendwritBookDate'];
          // print_pre(  $obj['cmdAssetDetail']);
		  $trAmount = $val['trAmount']; 
        }
    
        $list_pail_type = $list_cmd_pail[$k1]['typeDetail'];
        foreach ($list_pail_type as $ke2 => $va2) {
       
          $obj['cmdPaid'][$k1]['typeDetail'][$ke2]['rpayName']   = $va2['rpayName'];
          $obj['cmdPaid'][$k1]['typeDetail'][$ke2]['chqNo']      = $va2['chqNo'];
          $obj['cmdPaid'][$k1]['typeDetail'][$ke2]['chqDate']    = $va2['chqDate'];
          $obj['cmdPaid'][$k1]['typeDetail'][$ke2]['trAmount']   = $va2['trAmount'];
          $obj['cmdPaid'][$k1]['typeDetail'][$ke2]['bankName']   = $va2['bankName'];
    
          
        }
   
    }

    if ($res['cmdType'] == 1)
    {
        $sql_map_status = db::query("SELECT * FROM M_COURT_MAP WHERE COURT_CODE_REF ='" . $res['orderCode'] . "'");
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
        if ($rec_map_status['ACT_FLAG_1'] == 1)
        {
            $obj['orderStatus'] = "บังคับคดี";
        }
        if ($rec_map_status['ACT_FLAG_1'] == 0)
        {
            $obj['orderStatus'] = "ไม่ถูกบังคับคดี";
        }
        $obj['courtLevel'] = $res['courtLevel'];
    }
	/* if($res['cmdStaff'] == '10914'){
		
		$request = '';
		
		$request .='userDisplayName='.$userDisplayName;	
		$request .='&documentReceiveBeanJson={
					  "brCaseId": "",
					  "documentDateStr": "'.$cmdDate.'",
					  "docSubject": "บันทึกข้อความ สำนักงานบังคับคดีแพ่งกรุงเทพมหานคร 5",
					  "docAdditional": "",
					  "docUrgentLevel": 4,
					  "docFromId": "",
					  "docNumber": "",
					  "refSaraban": ""
					}';
		$request .='&detail='.$cmdNote;
		$request .='&processListJson=[
						{
							"subjectText": "ส่งกองบริหารการคลัง เพื่อตรวจสอบการโอนเงินเข้าบัญชีและออกใบเสร็จรับเงิน",
							"processCommonBean": {
							  "payerDepId": 52,
							  "amount": '.$trAmount.',
							  "transferDate": "'.$cmdDate.'",
							  "chequeAmount": '.$trAmount.',
							  "comCodeTxt": "comcode",
							  "partyBeanList": [
								  {
									  "partyCategory": 1,
									  "idCard": "2222222222222",
									  "companyCode": ""
								  }
							  ],
							  "assetBeanList": [
								  {
									  "brcaseAssetId": 21
								  }
							  ]
							}
						}
					]';
					
		$DOC_MAS_ID_RES = $eDocumentUrl];
		$json_data = array(
			'DOC_MAS_ID' => $DOC_MAS_ID_RES
		);
		$json_data = json_encode($json_data);

		$post = file_get_contents('http://103.40.146.152/LED_DOC/LED_EDOC_UAT/webservice/get_document_process_data.php', null, stream_context_create(array(
			'http' => array(
				'method' => 'POST',
				'header' => "Content-type: application/json\r\n" . "Connection: close\r\n" . "Content-length: " . strlen($json_data) . "\r\n",
				'content' => $json_data,
			) ,
		)));
		if ($post)
		{
			$arr_data = json_decode($post, true);
			if ($arr_data['status'] == 1)
			{
				$data = $arr_data['data'];
				foreach ($data as $key => $val){
					$fileName = $val['FILE_NAME'];
					$fileData = $val['FILE_DATA'];
				}

			}
		}			
		$request .='&documentFileListJson=[
						{
							"fileFileName": "'.$fileName.'",
							"fileBase64": "'.$fileData.'"
						}
					]'; 
					
					
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://103.40.146.73/LedService.php/insertTaskBackoffice',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => $request, 
		  CURLOPT_HTTPHEADER => array(
			'Content-Type: application/x-www-form-urlencoded',
			'Cookie: PHPSESSID=835e152re2tk1mbpmupj2n2ft6'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		echo $response;
		
	} */

    if ($res['systemType'] == 'Bankrupt')
    {
        $data_string = json_encode($obj);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://vpn.bizpotential.com:9090/save/insert_cmd_noti.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data_string,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ) ,
        ));
        $response = curl_exec($curl);
        $resp = json_decode($response, true);
        // echo $data_string;
        // exit;
        
    }

    if ($res['systemType'] == 'Revive')
    {
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
            CURLOPT_POSTFIELDS => $data_string,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ) ,
        ));
        $response = curl_exec($curl);
        $resp = json_decode($response, true);

    }

    if ($res['systemType'] == 'Mediate')
    {
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
            CURLOPT_POSTFIELDS => $data_string,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ) ,
        ));
        $response = curl_exec($curl);
        $resp = json_decode($response, true);
    }

    if ($res['systemType'] == 'Debtor')
    {

        $data_string = json_encode($obj);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://103.208.27.224/led_data/save/insert_cmd_noti.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data_string,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ) ,
        ));
        $response = curl_exec($curl);
        $resp = json_decode($response, true);
        // echo $data_string;
        // exit;
        
    }

    if ($res['systemType'] == 'Civil')
    {
        if ($res['toCourtName'])
        {
            $sql_court = db::query("SELECT * FROM M_COURT_CODE_MAP WHERE COURT_NAME_LAW = '" . $res['toCourtName'] . "'");
            $rec_court = db::fetch_array($sql_court);
            $obj['toCourtName'] = $rec_court['COURT_CODE_LAW'];
        }
        $obj['civilCode'] = $res['civilCode'];
        $obj['shrCivilPersonMapGen'] = $res['shrCivilPersonMapGen'];
        $obj['systemType'] = "Civil";
        // if($res['reply'] == '1'){
        // $obj['remark'] = $res['remark'];
        // $obj['activeFlag'] = 1;
        // $obj['shrCmdAsset'] = $res['shrCmdAsset'];
        // $obj['shrCmdOffice'] = $res['shrCmdOffice'];
        // $obj['centCmdType'] = $res['centCmdType'];
        // $obj['centCmd'] = $res['centCmd'];
        // }
        $url = connect_led_api('insertCmdNoti2.php');

        // echo $data = curl($url, $obj);
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
            CURLOPT_POSTFIELDS => $data_string,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ) ,
        ));
        $response = curl_exec($curl);
        $resp = json_decode($response, true);
        //  print_pre( $obj);
        // exit;
        
    }

}
$num = count($resp);
if ($num > 0)
{

    $row['ResponseCode'] = array(
        'ResCode' => '000',
        'ResMeassage' => "SUCCESS"
    );
    $row['Data'] = $resp;

}
else
{

    $row['ResponseCode'] = array(
        'ResCode' => '102',
        'ResMeassage' => "NOT FOUND"
    );

}


echo json_encode($row);

?>
