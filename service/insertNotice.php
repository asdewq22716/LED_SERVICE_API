<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$data = json_decode($str_json, true);

$field = array();
$field['IP_ADDRESS'] = $ip ;
$field['DEP_ID'] = $POST['depId'];
$field['REQUEST'] = 'insertNotice';
$field['LOG_DATE'] = date("Y-m-d");
$field['LOG_TIME'] = date("H:i:s");
$field['USR_ID'] = '' ;
$field['REQUEST_STATUS'] = '200';
$field['USR_IDCARD'] = $POST['idCard'];
$field['LOG_TYPE'] = '1' ;
$field['REQUEST_DATA'] = $str_json;

$LOG_ID = db::db_insert('M_LOG', $field, 'LOG_ID','LOG_ID');

if($data['userName'] == "BankruptDt" && $data['passWord'] == "Debtor4321"){
	
 $sql = "SELECT ANC_NOTICE_WEB_ID FROM M_ANC_NOTICE_WEBSITE WHERE CIVIL_CASE_ID = '".$data['civilCaseId']."'";
 $query = db::query($sql);
 $num = db::num_rows($query);
 $rec = db::fetch_array($query);
  
	if($num == 0){
		
		$sql2 = "SELECT COURT_ID FROM M_COURT_CODE_MAP WHERE COURT_CODE_LAW = '".$data['courtId']."' OR COURT_CODE_BR = '".$data['courtId']."' OR COURT_CODE_MD = '".$data['courtId']."' OR COURT_CODE_RV = '".$data['courtId']."'";
		$query2 = db::query($sql2);
		$rec2 = db::fetch_array($query2);
		
		if($rec2['COURT_ID'] != ''){
			$courtId = $rec2['COURT_ID'];
		}else{
			$courtId = $data['courtId'];
		}
		
		$insert['ANC_TYPE_CIVIL'] = $data['ancTypeCivil'];
		$insert['COURT_ID'] = $courtId;
		$insert['PREFIX_BLACK_CASE'] = $data['prefixBlackCase'];
		$insert['BLACK_CASE'] = $data['blackCase'];
		$insert['BLACK_YEAR'] = $data['blackYear'];
		$insert['PREFIX_RED_CASE'] = $data['prefixRedCase'];
		$insert['RED_CASE'] = $data['redCase'];
		$insert['RED_YEAR'] = $data['redYear'];
		$insert['DEFENDANT_1'] = $data['defendantName'];
		$insert['PLANTIFF_1'] = $data['plantiffName'];
		$insert['CIVIL_CASE_ID'] = $data['civilCaseId'];

		$idMaster = db::db_insert("M_ANC_NOTICE_WEBSITE",$insert,'ANC_NOTICE_WEB_ID','ANC_NOTICE_WEB_ID');
	}
	
	
	$insertFrm['WF_MAIN_ID'] = '105';
	$insertFrm['WFD_ID'] = '0';
	$insertFrm['WFR_ID'] = ($idMaster!=''?$idMaster:$rec['ANC_NOTICE_WEB_ID']);
	$insertFrm['WFS_ID'] = '1310';
	$insertFrm['F_TEMP_ID'] = ($idMaster!=''?$idMaster:$rec['ANC_NOTICE_WEB_ID']);

	$insertFrm['ANC_NOTICE_ID'] = $data['ancNoticeId'];
	$insertFrm['ANC_NOTICE_DATE'] = $data['ancNoticeDate'];
	$insertFrm['ANC_PUBLIC_STATUS'] = $data['ancPublicStatus'];
	
	if($data['documentFileId'] != ''){
		$insertFrm['ANC_NOTICE_FILE'] = $data['documentFileId'];
	}
	## เอา documentFileId เรียกผ่าน --> http://bruat.led.go.th/ledbrlive2/showFile.action?docId=

	$idFrm = db::db_insert("FRM_ANC_NOTICE",$insertFrm,'F_ID','F_ID');
	
	
	// FILE
	
	if($data['documentFileId'] == ''){
		
		$DOC_MAS_ID_RES = $data['ancNoticeFileName'];
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
			if ($arr_data['status'] == 1 )
				{
				
					$data = $arr_data['data'];
					foreach ($data as $key => $val) $destination =  rand(10, 99) . date('Ymdhis') . "." . $val['FILE_TYPE'];
					$datafile = base64_decode($val['FILE_DATA']);
					$h = fopen("../attach/edocService/FILEWEB/" . $destination, "w");
					fwrite($h, $datafile);
					fclose($h);
					// header('Location: FILEWEB/' . $destination);
					unset($data); 
					$data['WFS_FIELD_NAME']      =  'ANC_NOTICE_FILE';
					$data['WFR_ID']              =  $idFrm;
					$data['FILE_NAME']           =  $val['FILE_NAME'];
					$data['WF_MAIN_ID']          =  '106';
					$data['FILE_TYPE']           =  'application/'.$val['FILE_TYPE'];
					$data['FILE_EXT']            =  $val['FILE_TYPE'];
					$data['FILE_SAVE_NAME']      =  $destination;
					$data['FILE_DATE']           =  date('Y-m-d');
					$data['FILE_TIME']           =  date(' H:i:s');
					$data['FILE_STATUS']         =  "Y";

					db::db_insert("WF_FILE",$data,"FILE_ID");
				
				}	
		}	
	}
}
	if($idMaster != '' && $idFrm != ''){
		$row['Status'] = '1';
		$row['Data'] = '1';
	}else if($idMaster == '' && $idFrm != ''){
		$row['Status'] = '1';
		$row['Data'] = '2';
	}else{
		$row['Status'] = '0';
		$row['Data'] = '0';
	}



echo json_encode($row); 
 ?>
  