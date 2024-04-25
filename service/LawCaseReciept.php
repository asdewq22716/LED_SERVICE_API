<?php
include '../include/include.php';
$con = curl_init();
curl_setopt($con, CURLOPT_CONNECTTIMEOUT, 120);
curl_setopt($con, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.6 (KHTML, like Gecko) Chrome/16.0.897.0 Safari/535.6");
curl_setopt($con, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
curl_setopt($con, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($con, CURLOPT_HEADER, 0);
curl_setopt($con, CURLOPT_TIMEOUT, 120);

//SERVICE
$ch = $con; 
$form_field['USERNAME'] = 'BankruptDt';// เปลี่ยนเป็นค่าที่จะส่ง
$form_field['PASSWORD'] = 'Debtor4321';// เปลี่ยนเป็นค่าที่จะส่ง

curl_setopt($ch, CURLOPT_URL, 'http://103.40.146.73/ledservicelaw.php/CivilOrder');
curl_setopt($ch, CURLOPT_POST, 1);

$data_string = json_encode($form_field);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
$data = curl_exec($ch);
$data = json_decode($data, true);
// print_pre($data);
 if($data['ResponseCode']['ResCode'] == '000') {	
		// print_pre($data);
	$loop = count($data['Data']);
	for($i=0;$i < $loop;$i++){
		
		$sql= "SELECT ORDER_NO FROM WH_CIVIL_CASE_ORDER WHERE ORDER_NO = '".$data['Data'][$i]['C13']."'";
		$query = db::query($sql);
		$num = db::num_rows($query);
		
		if($num <= 0){
			unset($Field);
			$Field['CIVIL_CODE'] = $data['Data'][$i]['C1'];
			$Field['COURT_CODE'] = $data['Data'][$i]['C2'];
			$Field['COURT_NAME'] = $data['Data'][$i]['C3'];
			$Field['DEPT_CODE'] = $data['Data'][$i]['C4'];
			$Field['DEPT_NAME'] = $data['Data'][$i]['C5'];
			$Field['PREFIX_BLACK_CASE'] = $data['Data'][$i]['C6'];
			$Field['BLACK_CASE'] = $data['Data'][$i]['C7'];
			$Field['BLACK_YY'] = $data['Data'][$i]['C8'];
			$Field['PREFIX_RED_CASE'] = $data['Data'][$i]['C9'];
			$Field['RED_CASE'] = $data['Data'][$i]['C10'];
			$Field['RED_YY'] = $data['Data'][$i]['C11'];
			$Field['REC_BOOK_NO'] = $data['Data'][$i]['C12'];
			$Field['REC_NO'] = $data['Data'][$i]['C13'];
			$Field['DOC_DATE'] = date_format(date_create($data['Data'][$i]['C14']),"Y-m-d");
			$Field['RECEIPT_DATE'] = date_format(date_create($data['Data'][$i]['C15']),"Y-m-d");
			$Field['RECEIPT_NAME'] = $data['Data'][$i]['C16'];
			$Field['CONCERN_NAME'] = $data['Data'][$i]['C17'];

			
			// print_pre($Field);
			db::db_insert("WH_CIVIL_CASE_RECEIPT",$Field);
		}
		
		unset($Field);
		$Field['ORDER_LIST_ID'] = db::get_max('WH_CIVIL_ORDER_LIST', 'ORDER_LIST_ID')+1;
		$Field['ORDER_NO'] = $data['Data'][$i]['C13'];
		$Field['ORDER_REC_GEN'] = $data['Data'][$i]['C23'];
		$Field['ORDER_REC_TYPE'] = '';
		$Field['CHECK_NO'] = '';
		$Field['CHECK_NAME'] = '';
		$Field['ORDER_TYPE'] = '';
		$Field['ORDER_DETAIL'] = $data['Data'][$i]['C24'];
		db::db_insert("WH_CIVIL_ORDER_LIST",$Field);
		
		
		unset($Field);
		$Field['ORDER_TYPE_ID'] = db::get_max('WH_CIVIL_ORDER_LIST', 'ORDER_TYPE_ID')+1;
		$Field['ORDER_NO'] = $data['Data'][$i]['C13'];
		$Field['ORDER_REC_GEN'] = $data['Data'][$i]['C23'];
		$Field['ORDER_SEQ'] = $data['Data'][$i]['C18'];
		$Field['ORDER_MONEY'] = $data['Data'][$i]['C21'];
		$Field['ORDER_BY'] = $data['Data'][$i]['C22'];
		$Field['ORDER_CODE'] = $data['Data'][$i]['C19'];
		$Field['ORDER_NAME'] = $data['Data'][$i]['C20'];
		db::db_insert("WH_CIVIL_ORDER_TYPE",$Field);
		
	}		
 } 
 
 ?>