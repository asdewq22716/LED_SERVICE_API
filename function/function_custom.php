<?php

include '../phpvendor/vendor/autoload.php';
include '../service/classCustom.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$WF_GET_CIVIL = "http://103.40.146.73/LedServiceCivilById.php/getCivil";
$WF_GET_CIVIL_ROUTE = "http://103.40.146.73/LedServiceCivilById.php/getCivilRoute";
$WF_GET_CIVIL_TRANSACTION = "http://103.40.146.73/LedServiceCivilById.php/getCivilTransaction";
$WF_GET_CIVIL_EDOCUMENT = "http://103.40.146.73/LedServiceCivilById.php/getCivilEdocument";
$WF_GET_RECIEPT = "http://103.40.146.73/LedServiceCivilById.php/getReciept";
$WF_CIVIL_GET_ACCOUNT_INCOME_EXPENSES = "http://103.40.146.73/LedServiceCivilById.php/getAccountIncomeExpenses";
$WF_GET_ORDER_CIVIL_CASE = "http://103.40.146.73/LedServiceCivilById.php/getOrderCivilCase";

$WF_BANKRUPT_CHACK_CASE_BY_ID = "http://103.40.146.73/LedServiceBankrupt.php/checkCaseByID";

function connect_led_api($path)
{ // แพ่ง

	$url = 'http://103.208.27.224:81/led_service_api/service/'; /// แก้ไขตรงนี้ กรณี  path เปลี่ยน

	$final_url = $url . $path;
	return $final_url;
}

function connect_api_bankrupt($path)
{ //ล้มละลาย

	$url = 'http://vpn.bizpotential.com:9090/save/'; /// แก้ไขตรงนี้ กรณี  path เปลี่ยน

	$final_url = $url . $path;
	return $final_url;
}

function connect_api_mediate($path)
{ //ไกล่เกลี่ย

	$url = 'http://103.208.27.224/ega_led_mediate/service/'; /// แก้ไขตรงนี้ กรณี  path เปลี่ยน

	$final_url = $url . $path;
	return $final_url;
}

function connect_api_revive($path)
{ // ฟื้นฟู

	$url = 'http://103.208.27.224/led_revive/service/'; /// แก้ไขตรงนี้ กรณี  path เปลี่ยน

	$final_url = $url . $path;
	return $final_url;
}
function connect_api_civil($path)
{ // แพ่ง

	$url = 'http://103.40.146.73/ledservicelaw.php/'; /// แก้ไขตรงนี้ กรณี  path เปลี่ยน

	$final_url = $url . $path;
	return $final_url;
}

function connect_api_backoffice($path)
{ //ไกล่เกลี่ย

	$url = 'http://203.150.224.249/LED_FINANCE/LED_PER/api/'; /// แก้ไขตรงนี้ กรณี  path เปลี่ยน

	$final_url = $url . $path;
	return $final_url;
}

function connect_bankrupt($path)
{ //ไกล่เกลี่ย

	$url = 'http://103.40.146.180/api/public/'; /// แก้ไขตรงนี้ กรณี  path เปลี่ยน

	$final_url = $url . $path;
	return $final_url;
}


function getSystem($sysCode)
{

	$sql = "SELECT * FROM M_SYSTEM WHERE SYSTEM_ID = '" . $sysCode . "'";
	$qry = db::query($sql);
	$rec = db::fetch_array($qry);

	return $rec['SYS_NAME'];
}
function api_request($url, $token, $content = null)
{

	$headers = [
		'Authorization: Token ' . $token,
		'Content-Type: application/json'
	];

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($content));
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	curl_close($ch);

	return json_decode($result, true);
}
function curl($url, $request)
{

	$data_string = json_encode($request);

	$curl = curl_init();
	curl_setopt_array(
		$curl,
		array(
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
			),
		)
	);

	$response = curl_exec($curl);
	curl_close($curl);

	return json_decode($response, true);
}
function send_mail($to = " ", $subject = " ", $body = " ", $file_path = " ", $file_name = " ")
{

	require '../sendmail/autoload.php';

	$from = "no-reply@led.mail.go.th";
	$mail = new PHPMailer();
	$mail->CharSet = 'UTF-8';
	$mail->SMTPDebug = 1;	// Enable verbose debug output
	//$mail->isSMTP();	// Set mailer to use SMTP
	$mail->Host = 'outgoing.mail.go.th';
	// $mail->Host = 'mgtrelay01.mail.go.th';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;
	//if ดักข้อมูลของแต่ละเมล์
	// Enable SMTP authentication
	$mail->Username = 'no-reply';	// SMTP username
	$mail->Password = 'Reply123';	// SMTP password
	$mail->isSMTP();
	$mail->SMTPSecure = 'tls';
	// $mail->SMTPSecure = 'tls';	// Enable TLS encryption, ssl also accepted
	$mail->Port = 25;
	$mail->setFrom($from, $from);

	if ($file_path != " " && $file_name != " ") {
		foreach ($file_name as $key => $val) {
			$mail->AddAttachment($file_path . $val, $val);
		}
	}

	$mail->addAddress($to);	// Add a recipient
	//Content
	$mail->isHTML(true);	// Set email format to HTML
	$mail->Subject = $subject;
	$mail->Body    = $body;

	$mail->send();
}

function send_mail_hr($to = " ", $subject = " ", $body = " ")
{
	$from = 'warunee@bizpotential.com';
	$from_email = 'noreply@bizpotential.com';
	$from_pass = 'P@ssw0rd';
	if ($to != '') {
		require '../sendmail/vendor/autoload.php';
		$mail = new PHPMailer();
		$mail->CharSet = 'UTF-8';
		$mail->SMTPDebug = 0;
		$mail->isSMTP();
		$mail->Host = 'mail.bizpotential.com';
		$mail->SMTPAuth = true;
		$mail->Username = $from_email;     // SMTP username
		$mail->Password = $from_pass;     // SMTP password
		$mail->SMTPSecure = 'SSL';
		$mail->Port = 25;

		// $attach[$key]['path'] = '../attach/wxxx/'.$rec['FILE_SAVE_NAME']; // Path File
		// $attach[$key]['file_name'] = $rec['FILE_NAME']; // File Name


		$mail->setFrom($from_email, $from_name);
		$mail->addAddress($to);

		$mail->isHTML(true);
		$mail->Subject = $subject;
		$mail->Body    = $body;
		$send_status = $mail->send();
		if (!$send_status) {
			$error =  $mail->ErrorInfo;
		}
	}
}

function sendMail($to = "", $subject = "", $body = "", $formname = "", $attach = array())
{

	// global $wfFromEmail,$wfFomPass;
	$from_email = "noreply@bizpotential.com";
	$from_pass  = 'P@ssw0rd!@#$noreply';

	if ($to != '') {

		$mail = new PHPMailer();

		$mail->CharSet = 'UTF-8';
		$mail->SMTPDebug = 0;
		$mail->isSMTP();
		$mail->Host = 'mail.bizpotential.com';
		$mail->SMTPAuth = true;
		$mail->Username = $from_email;     // SMTP username
		$mail->Password = $from_pass;     // SMTP password
		$mail->SMTPSecure = 'SSL';
		$mail->Port = 25;

		$mail->setFrom($from_email, $formname);
		$mail->addAddress($to);

		$mail->isHTML(true);
		$mail->Subject = $subject;
		$mail->Body = $body;
		$send_status = $mail->send();
		$error = null;
		if (!$send_status) {
			$error =  $mail->ErrorInfo;
		}
		return $error;
	}
}

function get_client_ip()
{
	$ipaddress = '';
	if ($_SERVER['HTTP_CLIENT_IP'])
		$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	else if ($_SERVER['HTTP_X_FORWARDED_FOR'])
		$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else if ($_SERVER['HTTP_X_FORWARDED'])
		$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	else if ($_SERVER['HTTP_FORWARDED_FOR'])
		$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	else if ($_SERVER['HTTP_FORWARDED'])
		$ipaddress = $_SERVER['HTTP_FORWARDED'];
	else if ($_SERVER['REMOTE_ADDR'])
		$ipaddress = $_SERVER['REMOTE_ADDR'];
	else
		$ipaddress = 'UNKNOWN';

	return $ipaddress;
}

function underToCamel($str)
{

	$out = lcfirst(implode('', array_map('ucfirst', explode('_', strtolower($str)))));
	return $out;
}

function random($len)
{
	srand((float)microtime() * 10000000);
	$chars = "ABCDEFGHJKMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz1234567890";
	$ret_str = "";
	$num = strlen($chars);
	for ($i = 0; $i < $len; $i++) {
		$ret_str .= $chars[rand() % $num];
	}
	return $ret_str;
}


function getcourtName($id = "")
{
	$sqlCourt = "	SELECT 	COURT_NAME
					FROM 	M_COURT
					WHERE 	COURT_CODE = '" . $id . "'
					";
	$queryCourt = db::query($sqlCourt);
	$recCourt = db::fetch_array($queryCourt);
	return $recCourt["COURT_NAME"];
}

function getsystemName($id = "")
{
	$sqlSystem = "	SELECT 	SERVICE_SYS_NAME
					FROM 	M_CMD_SYSTEM
					WHERE 	CMD_SYSTEM_ID = '" . $id . "'
					";
	$querySystem = db::query($sqlSystem);
	$recSystem = db::fetch_array($querySystem);
	return $recSystem["SERVICE_SYS_NAME"];
	/* return $sqlSystem; */
}

function getCmdName($id = "")
{
	$sqlCmdName = "	SELECT 	CMD_GRP_NAME
					FROM 	M_CMD_TYPE
					WHERE 	CMD_TYPE_ID = '" . $id . "'
					";
	$queryCmdName = db::query($sqlCmdName);
	$recCmdName = db::fetch_array($queryCmdName);
	return $recCmdName["CMD_GRP_NAME"];
}

function getCaseName($id = "")
{
	$sqlCmdName = "	SELECT 	CMD_TYPE_NAME
					FROM 	M_SERVICE_CMD
					WHERE 	CMD_TYPE_CODE = '" . $id . "'
					";
	$queryCmdName = db::query($sqlCmdName);
	$recCmdName = db::fetch_array($queryCmdName);
	return $recCmdName["CMD_TYPE_NAME"];
}

function api_led_service($url, $param = [])
{

	$curl = curl_init();
	curl_setopt_array(
		$curl,
		array(
			CURLOPT_URL => 'http://103.208.27.224:81/led_service_api/service/' . $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => json_encode($param),
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
			),
		)
	);

	$response = curl_exec($curl);

	curl_close($curl);

	return json_decode($response, true);
}

function getDataToWhAlert($registerCode = "")
{

	$sqlSelectCount 	= "delete from WH_ALERT_DATA where REGISTER_CODE = '" . $registerCode . "' ";
	$querySelectCount 	= db::query($sqlSelectCount);

	unset($fields);
	$fields["REGISTER_CODE"] = $registerCode;
	$WH_ALERT_ID = db::db_insert("WH_ALERT_DATA", $fields, 'WH_ALERT_ID', 'WH_ALERT_ID');

	//แจ้งให้ทราบ
	$sqlSelectData = "	select 		CAST(SEND_TO AS VARCHAR(100)) as SEND_TO,COUNT(1)  COUNT_DATA
						from 		M_DOC_CMD a 
						inner join 	M_SERVICE_CMD b on a.CASE_TYPE = b.CMD_TYPE_CODE
						where 		b.CMD_TYPE_ID = 11 and (a.TO_PERSON_ID = '" . $registerCode . "' or TRANSACTION_APPROVE_PERSON = '" . $registerCode . "')
									and CMD_READ_STATUS < 1
						group by 	SEND_TO
						union all
						select 		CAST(SYS_NAME AS VARCHAR(100)) as SEND_TO,COUNT(1)  COUNT_DATA
						from 		M_DOC_CMD a 
						inner join 	M_SERVICE_CMD b on a.CASE_TYPE = b.CMD_TYPE_CODE
						where 		b.CMD_TYPE_ID = 11 and a.APPROVE_PERSON = '" . $registerCode . "'
									and CMD_READ_STATUS < 1
						group by 	SYS_NAME";
	$querySelectData = db::query($sqlSelectData);
	while ($recSelectData = db::fetch_array($querySelectData)) {

		if ($recSelectData["SEND_TO"] == 1) {
			$fieldCountNotice 	= "COUNT_NOTICE1";
			$fieldUrlNotice 	= "URL_NOTICE1";
			$fieldCountWork 	= "COUNT_WORK1";
			$fieldUrlWork 		= "URL_WORK1";
		} else if ($recSelectData["SEND_TO"] == 2) {
			$fieldCountNotice 	= "COUNT_NOTICE2";
			$fieldUrlNotice 	= "URL_NOTICE2";
			$fieldCountWork 	= "COUNT_WORK2";
			$fieldUrlWork 		= "URL_WORK2";
		} else if ($recSelectData["SEND_TO"] == 3) {
			$fieldCountNotice 	= "COUNT_NOTICE3";
			$fieldUrlNotice 	= "URL_NOTICE3";
			$fieldCountWork 	= "COUNT_WORK3";
			$fieldUrlWork 		= "URL_WORK3";
		} else if ($recSelectData["SEND_TO"] == 4) {
			$fieldCountNotice 	= "COUNT_NOTICE4";
			$fieldUrlNotice 	= "URL_NOTICE4";
			$fieldCountWork 	= "COUNT_WORK4";
			$fieldUrlWork 		= "URL_WORK4";
		} else if ($recSelectData["SEND_TO"] == 5) {
			$fieldCountNotice 	= "COUNT_NOTICE5";
			$fieldUrlNotice 	= "URL_NOTICE5";
			$fieldCountWork 	= "COUNT_WORK5";
			$fieldUrlWork 		= "URL_WORK5";
		}

		$arrDataSub = array();
		$sqlSelectDataSub = "	select 		a.ID,CAST(CMD_NOTE AS VARCHAR(90)) as CMD_NOTE
								from 		M_DOC_CMD a 
								inner join 	M_SERVICE_CMD b on a.CASE_TYPE = b.CMD_TYPE_CODE
								where 		b.CMD_TYPE_ID = 11 and (a.TO_PERSON_ID = '" . $registerCode . "' or TRANSACTION_APPROVE_PERSON = '" . $registerCode . "')
											and CMD_READ_STATUS < 1
											and SEND_TO = '" . $recSelectData["SEND_TO"] . "'
											AND ROWNUM <5 
								union
								select 		a.ID,CAST(CMD_NOTE AS VARCHAR(90)) as CMD_NOTE
								from 		M_DOC_CMD a 
								inner join 	M_SERVICE_CMD b on a.CASE_TYPE = b.CMD_TYPE_CODE
								where 		b.CMD_TYPE_ID = 11 and a.APPROVE_PERSON = '" . $registerCode . "'
											and CMD_READ_STATUS < 1
											and SYS_NAME = '" . $recSelectData["SEND_TO"] . "'
											AND ROWNUM <5 
								";
		$querySelectDataSub = db::query($sqlSelectDataSub);
		while ($recSelectDataSub = db::fetch_array($querySelectDataSub)) {
			$arrDataSub[] = array(
				"url" => "http://103.208.27.224:81/led_service_api/public/cmd_view.php?ID=" . $recSelectDataSub["ID"] . "&update_view=Y&TO_PERSON_ID=" . $registerCode . "&SEND_TO=" . $recSelectData["SEND_TO"] . "",
				"showText" => $recSelectDataSub["CMD_NOTE"]
			);
		}

		$textJson = json_encode($arrDataSub);

		db::query("UPDATE WH_ALERT_DATA SET {$fieldCountNotice} = " . $recSelectData["COUNT_DATA"] . ", {$fieldUrlNotice} = '" . $textJson . "' WHERE WH_ALERT_ID = '" . $WH_ALERT_ID . "' ");
	}

	//แจ้งให้ทราบ
	$sqlSelectData = "	select 		CAST(SEND_TO AS VARCHAR(100)) as SEND_TO,COUNT(1)  COUNT_DATA
						from 		M_DOC_CMD a 
						inner join 	M_SERVICE_CMD b on a.CASE_TYPE = b.CMD_TYPE_CODE
						where 		b.CMD_TYPE_ID != 11 and (a.TO_PERSON_ID = '" . $registerCode . "' or TRANSACTION_APPROVE_PERSON = '" . $registerCode . "')
									and CMD_READ_STATUS < 1
						group by 	SEND_TO
						union all
						select 		CAST(SYS_NAME AS VARCHAR(100)) as SEND_TO,COUNT(1)  COUNT_DATA
						from 		M_DOC_CMD a 
						inner join 	M_SERVICE_CMD b on a.CASE_TYPE = b.CMD_TYPE_CODE
						where 		b.CMD_TYPE_ID != 11 and a.APPROVE_PERSON = '" . $registerCode . "'
									and CMD_READ_STATUS < 1
						group by 	SYS_NAME";
	$querySelectData = db::query($sqlSelectData);
	while ($recSelectData = db::fetch_array($querySelectData)) {

		if ($recSelectData["SEND_TO"] == 1) {
			$fieldCountNotice 	= "COUNT_NOTICE1";
			$fieldUrlNotice 	= "URL_NOTICE1";
			$fieldCountWork 	= "COUNT_WORK1";
			$fieldUrlWork 		= "URL_WORK1";
		} else if ($recSelectData["SEND_TO"] == 2) {
			$fieldCountNotice 	= "COUNT_NOTICE2";
			$fieldUrlNotice 	= "URL_NOTICE2";
			$fieldCountWork 	= "COUNT_WORK2";
			$fieldUrlWork 		= "URL_WORK2";
		} else if ($recSelectData["SEND_TO"] == 3) {
			$fieldCountNotice 	= "COUNT_NOTICE3";
			$fieldUrlNotice 	= "URL_NOTICE3";
			$fieldCountWork 	= "COUNT_WORK3";
			$fieldUrlWork 		= "URL_WORK3";
		} else if ($recSelectData["SEND_TO"] == 4) {
			$fieldCountNotice 	= "COUNT_NOTICE4";
			$fieldUrlNotice 	= "URL_NOTICE4";
			$fieldCountWork 	= "COUNT_WORK4";
			$fieldUrlWork 		= "URL_WORK4";
		} else if ($recSelectData["SEND_TO"] == 5) {
			$fieldCountNotice 	= "COUNT_NOTICE5";
			$fieldUrlNotice 	= "URL_NOTICE5";
			$fieldCountWork 	= "COUNT_WORK5";
			$fieldUrlWork 		= "URL_WORK5";
		}

		$arrDataSub = array();
		$sqlSelectDataSub = "	select 		a.ID,CAST(TRANSACTION_APPROVE_PERSON AS VARCHAR(100)) as TRANSACTION_APPROVE_PERSON ,1 as CHECK_TYPE,CAST(CMD_NOTE AS VARCHAR(90)) as CMD_NOTE
								from 		M_DOC_CMD a 
								inner join 	M_SERVICE_CMD b on a.CASE_TYPE = b.CMD_TYPE_CODE
								where 		b.CMD_TYPE_ID != 11 and (a.TO_PERSON_ID = '" . $registerCode . "' or TRANSACTION_APPROVE_PERSON = '" . $registerCode . "')
											and CMD_READ_STATUS < 1
											and SEND_TO = '" . $recSelectData["SEND_TO"] . "'
											AND ROWNUM <5
								union
								select 		a.ID,CAST(APPROVE_PERSON AS VARCHAR(100)) as TRANSACTION_APPROVE_PERSON,1 as CHECK_TYPE,CAST(CMD_NOTE AS VARCHAR(90)) as CMD_NOTE
								from 		M_DOC_CMD a 
								inner join 	M_SERVICE_CMD b on a.CASE_TYPE = b.CMD_TYPE_CODE
								where 		b.CMD_TYPE_ID != 11 and a.APPROVE_PERSON = '" . $registerCode . "'
											and CMD_READ_STATUS < 1
											and SYS_NAME = '" . $recSelectData["SEND_TO"] . "'
											AND ROWNUM <5
								";
		$querySelectDataSub = db::query($sqlSelectDataSub);
		while ($recSelectDataSub = db::fetch_array($querySelectDataSub)) {
			$param = "";
			if ($recSelectDataSub["CHECK_TYPE"] == 1 && $recSelectDataSub["TRANSACTION_APPROVE_PERSON"] == $registerCode) {
				$param = "&approve2=Y";
			} else if ($recSelectDataSub["CHECK_TYPE"] == 2 && $recSelectDataSub["TRANSACTION_APPROVE_PERSON"] == $registerCode) {
				$param = "&approve=Y";
			}
			$arrDataSub[] = array(
				"url" => "http://103.208.27.224:81/led_service_api/public/cmd_view.php?ID=" . $recSelectDataSub["ID"] . "&update_view=Y&TO_PERSON_ID=" . $registerCode . "&SEND_TO=" . $recSelectData["SEND_TO"] . $param . "",
				"showText" => $recSelectDataSub["CMD_NOTE"]
			);
		}

		$textJson = json_encode($arrDataSub);

		db::query("UPDATE WH_ALERT_DATA SET {$fieldCountWork} = " . $recSelectData["COUNT_DATA"] . ", {$fieldUrlWork} = '" . $textJson . "' WHERE WH_ALERT_ID = '" . $WH_ALERT_ID . "' ");
	}
}

function getCivilToWh($pccCivilGen = "", $show_data = "")
{
	/* start */
	$curl = curl_init();

	global $WF_GET_CIVIL;
	global $WF_GET_CIVIL_ROUTE;
	global $WF_GET_CIVIL_TRANSACTION;
	global $WF_GET_CIVIL_EDOCUMENT;

	curl_setopt_array($curl, array(
		CURLOPT_URL => $WF_GET_CIVIL,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => '{
		"USERNAME":"BankruptDt",
		"PASSWORD":"Debtor4321",
		"pccCivilGen":"' . $pccCivilGen . '"
	}',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
		),
	));

	$response = curl_exec($curl);

	curl_close($curl);

	$dataReturn = json_decode($response, true);
	/* stop */

	if ($show_data == 'Y') {
		print_pre($dataReturn);
	}
	// exit;
	$WH_CIVIL_ID = '-';
	if ($dataReturn["Data"]) {
		$data_main = $dataReturn["Data"];


		$sqlSelectData = "	select 		WH_CIVIL_ID
						from 		WH_CIVIL_CASE
						where 		CIVIL_CODE = '" . $data_main["pccCivilGen"] . "' ";


		$querySelectData = db::query($sqlSelectData);
		$dataSelectData = db::fetch_array($querySelectData);

		//case

		unset($fields);
		$fields["CIVIL_CODE"] 			= $data_main["pccCivilGen"];
		$fields["COURT_CODE"] 			= $data_main["courtCode"];
		$fields["COURT_NAME"] 			= $data_main["courtName"];
		$fields["DEPT_CODE"] 			= $data_main["deptCode"];
		$fields["DEPT_NAME"] 			= $data_main["deptName"];
		$fields["CASE_TYPE_CODE"] 		= $data_main["caseTypeCode"];
		$fields["PREFIX_BLACK_CASE"] 	= $data_main["prefixBlackCase"];
		$fields["BLACK_CASE"] 			= $data_main["blackCase"];
		$fields["BLACK_YY"] 			= $data_main["blackYy"];
		$fields["PREFIX_RED_CASE"] 		= $data_main["prefixRedCase"];
		$fields["RED_CASE"] 			= $data_main["redCase"];
		$fields["RED_YY"] 				= $data_main["redYy"];
		$fields["COURT_DATE"] 			= substr($data_main["courtDate"], 0, 10);
		$fields["CAPITAL_AMOUNT"] 		= $data_main["capitalAmount"];
		$fields["PLAINTIFF1"] 			= $data_main["plaintiff1"];
		$fields["PLAINTIFF2"] 			= $data_main["plaintiff2"];
		$fields["PLAINTIFF3"] 			= $data_main["plaintiff3"];
		$fields["DEFFENDANT1"] 			= $data_main["defendant1"];
		$fields["DEFFENDANT2"] 			= $data_main["defendant2"];
		$fields["DEFFENDANT3"] 			= $data_main["defendant3"];
		$fields["CASE_TYPE_NAME"] 		= $data_main["caseTypeDesc"];
		$fields["PCC_CASE_GEN"] 		= $data_main["pccCaseGen"];
		$fields["JUDGMENT_ABRIDGED"]	= substr($data_main["judgmentAbridged"], 0, 3998);
		$fields["REV_NO"] 				= $dataReturn['Data']['doss'][0]["recvNo"];
		$fields["REV_YEAR"] 			= $dataReturn['Data']['doss'][0]["recvYear"];

		if ($dataSelectData["WH_CIVIL_ID"] > 0) {
			db::db_update("WH_CIVIL_CASE", $fields, array('WH_CIVIL_ID' => $dataSelectData["WH_CIVIL_ID"]));
			$WH_CIVIL_ID = $dataSelectData["WH_CIVIL_ID"];
		} else {
			$WH_CIVIL_ID = db::db_insert("WH_CIVIL_CASE", $fields, 'WH_CIVIL_ID', 'WH_CIVIL_ID');
		}

		//doss

		db::db_delete("WH_CIVIL_DOSS", array('WH_CIVIL_ID' => $WH_CIVIL_ID));
		/* start */

		if (count($dataReturn['Data']['doss']) > 0) {
			foreach ($dataReturn['Data']['doss'] as $key => $data_doss) {
				unset($fields);
				$fields["ACCOUNT_NO"] 			= $data_doss["accCode"];
				$fields["DOSS_CONTROL"] 		= $data_doss["dossName"];
				$fields["DOSS_CONTROL_GEN"] 	= $data_doss["pccDossControlGen"];
				$fields["DOSS_CODE"] 			= $data_doss["dossCode"];
				$fields["DOSS_OWNER_ID"] 		= $data_doss["personCode"];
				$fields["DOSS_OWNER_NAME"] 		= $data_doss["dossOwnerName"];
				$fields["DOSS_REV_NO"] 			= $data_doss["recvNo"];
				$fields["DOSS_REV_YEAR"] 		= $data_doss["recvYear"];
				$fields["DOSS_DEPT_CODE"] 		= $data_doss["deptCode"];
				$fields["DOSS_DEPT_NAME"] 		= $data_doss["deptName"];
				$fields["WH_CIVIL_ID"] 			= $WH_CIVIL_ID;
				$fields["PCC_CASE_RECV_GEN"] 	= $data_doss["pccCaseRecvGen"];
				$DOSS_ID = db::db_insert("WH_CIVIL_DOSS", $fields, 'DOSS_ID', 'DOSS_ID');


				$curl = curl_init();

				curl_setopt_array($curl, array(
					CURLOPT_URL => $WF_GET_CIVIL_ROUTE,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'POST',
					CURLOPT_POSTFIELDS => '{
				"USERNAME":"BankruptDt",
				"PASSWORD":"Debtor4321",
				"pccDossControlGen":"' . $data_doss["pccDossControlGen"] . '"
			}',
					CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json'
					),
				));

				$responseRoute = curl_exec($curl);

				curl_close($curl);

				$dataReturnRoute = json_decode($responseRoute, true);
				if ($show_data == 'Y') {
					print_pre($dataReturnRoute);
				}

				db::db_delete("WH_CIVIL_ROUTE", array('WH_CIVIL_ID' => $WH_CIVIL_ID, 'DOSS_CONTROL_GEN' => $data_doss["pccDossControlGen"]));
				/* มีปัญหา start */
				if (count($dataReturnRoute["Data"]) > 0) {
					foreach ($dataReturnRoute["Data"] as $key => $val) {
						unset($fields);
						$fields["ROUTE_GEN"] 		= 	$val["routeGen"];
						$fields["CREATE_DATE"] 		= 	substr($val["trDate"], 0, 10);
						$fields["CREATE_TIME"] 		= 	substr($val["trDate"], 11);
						$fields["ACT_DESC"] 		= 	mb_substr($val["actDesc"], 0, 1300);
						$fields["WH_CIVIL_ID"] 		= 	$WH_CIVIL_ID;
						$fields["DOSS_ID"] 			= 	$DOSS_ID;
						$fields["DOSS_CONTROL_GEN"] = 	$data_doss["pccDossControlGen"];
						$fields["PCC_CASE_RECV_GEN"] =	$data_doss["pccCaseRecvGen"];
						db::db_insert("WH_CIVIL_ROUTE", $fields, 'WH_ROUTE_ID', 'WH_ROUTE_ID');
					}
				}
				/* มีปัญหา stop */
				$curlTransaction = curl_init();

				curl_setopt_array($curlTransaction, array(
					CURLOPT_URL => $WF_GET_CIVIL_TRANSACTION,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'POST',
					CURLOPT_POSTFIELDS => '{
				"USERNAME":"BankruptDt",
				"PASSWORD":"Debtor4321",
				"pccCaseRecvGen":"' . $data_doss["pccCaseRecvGen"] . '"
			}',
					CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json'
					),
				));

				$responseTransaction = curl_exec($curlTransaction);

				curl_close($curlTransaction);

				$dataReturnTransaction = json_decode($responseTransaction, true);

				if ($show_data == 'Y') {
					print_pre($responseTransaction);
				}
				//print_pre($dataReturnTransaction);

				db::db_delete("WH_CIVIL_TRANSACTION", array('WH_CIVIL_ID' => $WH_CIVIL_ID, 'PCC_CASE_RECV_GEN' => $data_doss["pccCaseRecvGen"]));
				if (count($dataReturnTransaction["Data"]) > 0) {
					foreach ($dataReturnTransaction["Data"] as $key => $valTransaction) {
						unset($fields);
						$fields["SETUP_DATE"] 		= 	substr($valTransaction["setupDate"], 0, 10);
						$fields["DOSS"] 			= 	$valTransaction["dossName"];
						$fields["SEND_DATE"] 		= 	substr($valTransaction["sendDate"], 0, 10);
						$fields["FROM_DEPT"] 		= 	$valTransaction["fromCentDeptName"];
						$fields["RECV_DOSS_DATE"] 	= 	substr($valTransaction["recvDate"], 0, 10);
						$fields["TO_DEPT"] 			= 	$valTransaction["toCentDeptName"];
						$fields["PROCESS_DESC"] 	= 	$valTransaction["processDesc"];
						$fields["REMARK"] 			= 	$valTransaction["remark"];
						$fields["WH_CIVIL_ID"] 		= 	$WH_CIVIL_ID;
						$fields["DOSS_ID"] 			= 	$DOSS_ID;
						$fields["DOSS_CONTROL_GEN"] = 	$data_doss["pccDossControlGen"];
						$fields["PCC_CASE_RECV_GEN"] = 	$data_doss["pccCaseRecvGen"];
						db::db_insert("WH_CIVIL_TRANSACTION", $fields, 'WH_ROUTE_ID', 'WH_ROUTE_ID');
					}
				}


				$curlEdoc = curl_init();

				curl_setopt_array($curlEdoc, array(
					CURLOPT_URL => $WF_GET_CIVIL_EDOCUMENT,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'POST',
					CURLOPT_POSTFIELDS => '{
				"USERNAME":"BankruptDt",
				"PASSWORD":"Debtor4321",
				"pccDossControlGen":"' . $data_doss["pccDossControlGen"] . '"
			}',
					CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json'
					),
				));

				$responseEdoc = curl_exec($curlEdoc);

				curl_close($curlEdoc);

				$dataReturnEdoc = json_decode($responseEdoc, true);

				if ($show_data == 'Y') {
					print_pre($responseEdoc);
				}
				//print_pre($dataReturnEdoc);

				db::db_delete("WH_CIVIL_EDOC", array('WH_CIVIL_ID' => $WH_CIVIL_ID, 'PCC_CASE_RECV_GEN' => $data_doss["pccCaseRecvGen"]));
				if (count($dataReturnEdoc["Data"]) > 0) {
					foreach ($dataReturnEdoc["Data"] as $key => $valEdoc) {
						unset($fields);
						$fields["WH_CIVIL_ID"] 			= 	$WH_CIVIL_ID;
						$fields["DOSS_ID"] 				= 	$DOSS_ID;
						$fields["PCC_DOSS_CONTROL_GEN"]	= 	$data_doss["pccDossControlGen"];
						$fields["PCC_CASE_RECV_GEN"] 	= 	$data_doss["pccCaseRecvGen"];
						$fields["SHR_E_DOCUMENT_NAME"] 	= 	$valEdoc["shrEDocumentName"];
						$fields["SHR_E_DOCUMENT_URL"] 	= 	$valEdoc["shrEDocumentUrl"];
						$fields["PCC_CASE_GEN"] 		= 	$data_main["pccCaseGen"];
						$fields["CREATE_DATE"] 			= 	substr($valEdoc["createDate"], 0, 10);
						db::db_insert("WH_CIVIL_EDOC", $fields, 'WH_CIVIL_EDOC_ID', 'WH_CIVIL_EDOC_ID');
					}
				}
			}
		}
		/* stop */
		//person



		//เรียกใช้function insert คน
		if (1 == 1) {
			(ClassCustom_php::insertPerson($dataReturn, $data_main, $WH_CIVIL_ID));
		}
		if (1 == 1) {
			db::db_delete("WH_CIVIL_CASE_PERSON", array('WH_CIVIL_ID' => $WH_CIVIL_ID));
			db::db_delete("WH_CIVIL_PETITION", array('WH_CIVIL_ID' => $WH_CIVIL_ID));


			if (count($dataReturn['Data']['person']) > 0) {
				foreach ($dataReturn['Data']['person'] as $key => $data_person) {
					unset($fields);
					$fields["WH_CIVIL_ID"] 			= $WH_CIVIL_ID;
					$fields["PERSON_CODE"] 			= $data_person["personCode"];
					$fields["REGISTER_CODE"] 		= $data_person["registerId"];
					$fields["PREFIX_CODE"] 			= $data_person["titleCode"];

					$fields["PREFIX_NAME"] 			= (trim($data_person["fname"]) == "") ? null : $data_person["titleName"];
					$fields["FIRST_NAME"] 			= (trim($data_person["fname"]) == "") ? $data_person["personFullName"] : $data_person["fname"];
					$fields["LAST_NAME"] 			= $data_person["lname"];
					$fields["FULL_NAME"] 			= $data_person["personFullName"];

					$fields["PERSON_TYPE"] 			= $data_person["personType"];
					$fields["PERSON_TYPE_NAME"]		= $data_person["personTypeName"];
					// $fields["PERSON_TYPE"] 			= (substr($data_person["registerId"], 0, 1) == '0') ? 2 : 1; //$data_person["personType"]
					// $fields["PERSON_TYPE_NAME"]		= ($fields["PERSON_TYPE"] == 1) ? 'บุคคลธรมดา' : 'นิติบุคคล';
					$fields["SEX"] 					= $data_person["sex"];
					$fields["RACE"] 				= $data_person["race"];
					$fields["NATIONALITY"] 			= $data_person["nationality"];

					$fields["COURT_CODE"] 			= $data_main["courtCode"];
					$fields["COURT_NAME"] 			= $data_main["courtName"];
					$fields["DEPT_CODE"] 			= $data_main["deptCode"];
					$fields["DEPT_NAME"] 			= $data_main["deptName"];
					$fields["PREFIX_BLACK_CASE"] 	= $data_main["prefixBlackCase"];
					$fields["BLACK_CASE"] 			= $data_main["blackCase"];
					$fields["BLACK_YY"] 			= $data_main["blackYy"];
					$fields["PREFIX_RED_CASE"] 		= $data_main["prefixRedCase"];
					$fields["RED_CASE"] 			= $data_main["redCase"];
					$fields["RED_YY"] 				= $data_main["redYy"];

					// ย้ายไปเก็บที่ WH_CIVIL_CASE_PERSON_CONN กันคนซ้ำ
					// $fields["ADDRESS"] 				= $data_person["houseNo"];
					// $fields["TUM_CODE"] 			= $data_person["tumCode"];
					// $fields["TUM_NAME"] 			= $data_person["tumName"];
					// $fields["AMP_CODE"] 			= $data_person["ampCode"];
					// $fields["AMP_NAME"] 			= $data_person["ampName"];
					// $fields["PROV_CODE"] 			= $data_person["provCode"];
					// $fields["PROV_NAME"] 			= $data_person["prvName"];
					// $fields["ZIP_CODE"] 			= $data_person["postCode"];
					// $fields["CONCERN_CODE"] 		= $data_person["concernCode"];
					// $fields["CONCERN_NAME"] 		= $data_person["concernName"];
					// $fields["CONCERN_NO"] 			= $data_person["concernNo"];
					// $fields["MOO"] 					= $data_person["moo"];
					// $fields["SOI"] 					= $data_person["soi"];

					$fields["PERSON_PCC_CASE_GEN"] 	= $data_person["pccCaseGen"];
					$fields["PER_ORDER_STATUS"] 	= $data_person["executionStatus"];
					db::db_insert("WH_CIVIL_CASE_PERSON", $fields, 'WH_PERSON_ID', 'WH_PERSON_ID');

					if (count($data_person["petition"]) > 0) {
						$CASE_CODE_TEXT = "ไม่ระบุ";
						if ($data_person["petition"]["caseCode"] == 1) {
							$CASE_CODE_TEXT = "แพ่ง";
						} else if ($data_person["petition"]["caseCode"] == 2) {
							$CASE_CODE_TEXT = "ล้มละลาย";
						} else if ($data_person["petition"]["caseCode"] == 3) {
							$CASE_CODE_TEXT = "วางทรัพย์";
						} else if ($data_person["petition"]["caseCode"] == 4) {
							$CASE_CODE_TEXT = "อาญา";
						} else if ($data_person["petition"]["caseCode"] == 5) {
							$CASE_CODE_TEXT = "บังคับทางปกครอง";
						}
						unset($fieldsPetition);
						$fieldsPetition["WH_CIVIL_ID"] 					= $WH_CIVIL_ID;
						$fieldsPetition["CASE_CODE_TEXT"] 				= $CASE_CODE_TEXT;
						$fieldsPetition["PREFIX_BLACK_CASE"] 			= $data_person["petition"]["prefixBlackCase"];
						$fieldsPetition["BLACK_CASE"] 					= $data_person["petition"]["blackCase"];
						$fieldsPetition["BLACK_YY"] 					= $data_person["petition"]["blackYy"];
						$fieldsPetition["PREFIX_RED_CASE"] 				= $data_person["petition"]["prefixRedCase"];
						$fieldsPetition["RED_CASE"] 					= $data_person["petition"]["redCase"];
						$fieldsPetition["RED_YY"] 						= $data_person["petition"]["redYy"];
						$fieldsPetition["COURTDATE"] 					= substr($data_person["petition"]["courtdate"], 0, 10);
						$fieldsPetition["PLAINTIFF"] 					= $data_person["petition"]["plaintiff"];
						$fieldsPetition["DEFENDANT"] 					= $data_person["petition"]["defendant"];
						$fieldsPetition["CAPITAL_AMT"] 					= $data_person["petition"]["capitalAmt"];
						$fieldsPetition["COURT_OBLIG_AMT"] 				= $data_person["petition"]["courtObligAmt"];
						$fieldsPetition["TAX_LAW_AMT"] 					= $data_person["petition"]["taxLawAmt"];
						$fieldsPetition["SOCIAL_SEC_LAW_AMT"] 			= $data_person["petition"]["socialSecLawAmt"];
						$fieldsPetition["LABOR_LAW_AMT"] 				= $data_person["petition"]["laborLawAmt"];
						$fieldsPetition["OTHER_LAW_NAME"] 				= $data_person["petition"]["otherLawName"];
						$fieldsPetition["OTHER_LAW_AMT"] 				= $data_person["petition"]["otherLawAmt"];
						$fieldsPetition["COURT_NAME"] 					= $data_person["petition"]["courtName"];
						$fieldsPetition["SOURCE_COURT_CODE"] 			= $data_main["courtCode"];
						$fieldsPetition["SOURCE_COURT_NAME"] 			= $data_main["courtName"];
						$fieldsPetition["SOURCE_PREFIX_BLACK_CASE"] 	= $data_main["prefixBlackCase"];
						$fieldsPetition["SOURCE_BLACK_CASE"] 			= $data_main["blackCase"];
						$fieldsPetition["SOURCE_BLACK_YY"] 				= $data_main["blackYy"];
						$fieldsPetition["SOURCE_PREFIX_RED_CASE"] 		= $data_main["prefixRedCase"];
						$fieldsPetition["SOURCE_RED_CASE"] 				= $data_main["redCase"];
						$fieldsPetition["SOURCE_RED_YY"] 				= $data_main["redYy"];
						$fieldsPetition["REGISTER_CODE"] 				= $data_person["registerId"];
						db::db_insert("WH_CIVIL_PETITION", $fieldsPetition, 'WH_CIVIL_PETITION_ID', 'WH_CIVIL_PETITION_ID');
					}
				}
			}
		}

		db::db_delete("WH_CIVIL_CASE_PERSON_CONN", array('WH_CIVIL_ID' => $WH_CIVIL_ID, 'PCC_CIVIL_GEN' => $pccCivilGen));
		if (count($dataReturn['Data']['personConnerName']) > 0) {
			foreach ($dataReturn['Data']['personConnerName'] as $key => $data_person) {
				unset($fieldConner);
				$fieldConner['WH_CIVIL_ID'] 	= $WH_CIVIL_ID;
				$fieldConner['PCC_CIVIL_GEN'] 	= $pccCivilGen;
				$fieldConner['CONCERN_CODE'] 	= $data_person['concernCode'];
				$fieldConner['CONCERN_NO'] 		= $data_person['concernNo'];
				$fieldConner['PERSON_CODE'] 	= $data_person['personCode'];
				$fieldConner['CONCERN_NAME'] 	= $data_person['concernName'];
				$fieldConner["ADDRESS"]			= $data_person["houseNo"];
				$fieldConner["MOO"] 			= $data_person["moo"];
				$fieldConner["SOI"] 			= $data_person["soi"];
				$fieldConner["ROAD"] 			= $data_person["mainStreet"];
				$fieldConner["TUM_CODE"] 		= $data_person["tumCode"];
				$fieldConner["TUM_NAME"] 		= $data_person["tumName"];
				$fieldConner["AMP_CODE"] 		= $data_person["ampCode"];
				$fieldConner["AMP_NAME"] 		= $data_person["ampName"];
				$fieldConner["PROV_CODE"] 		= $data_person["provCode"];
				$fieldConner["PROV_NAME"] 		= $data_person["prvName"];
				$fieldConner["ZIP_CODE"] 		= $data_person["postCode"];
				db::db_insert("WH_CIVIL_CASE_PERSON_CONN", $fieldConner);
			}
		}

		//asset
		//db::query("DELETE FROM WH_CIVIL_CASE_ASSET_OWNER WHERE WH_CIVIL_ID in (SELECT WH_ASSET_ID FROM WH_CIVIL_CASE_ASSETS WHERE WH_CIVIL_ID = '".$WH_CIVIL_ID."' )");
		db::db_delete("WH_CIVIL_CASE_ASSET_OWNER", array('WH_CIVIL_ID' => $WH_CIVIL_ID));
		db::db_delete("WH_CIVIL_CASE_ASSETS", array('WH_CIVIL_ID' => $WH_CIVIL_ID));


		if (count($dataReturn['Data']['asset']) > 0) {

			$sqlAssAssetMapping = "SELECT * FROM M_ASS_ASSET_MAPPING WHERE ASS_TYPE_ID = 1";
			$qryAssAssetMapping = db::query($sqlAssAssetMapping);
			$arrAssAssetMapping = array();

			while ($recAssAssetMapping = db::fetch_array($qryAssAssetMapping)) {
				$arrAssAssetMapping[$recAssAssetMapping['ASSET_LAW_CODE_1']] = $recAssAssetMapping;
				if ($recAssAssetMapping['ASSET_LAW_CODE_2']) {
					db::db_delete($recAssAssetMapping['ASSET_LAW_CODE_2'], array('WH_CIVIL_ID' => $WH_CIVIL_ID));
				}
			}

			foreach ($dataReturn['Data']['asset'] as $key => $data) {

				$sqlSelectDataDoss 		= "	select 		DOSS_ID
										from 		WH_CIVIL_DOSS
										where 		DOSS_CONTROL_GEN = '" . $data["pccDossControlGen"] . "' ";
				$querySelectDataDoss 	= db::query($sqlSelectDataDoss);
				$dataSelectDataDoss 	= db::fetch_array($querySelectDataDoss);

				unset($fields);
				$fields["ASSET_ID"] 		= $data["assetId"];
				$fields["TYPE_CODE"] 		= $data["typeCode"];


				$fields["TYPE_CODE_NAME"] = $arrAssAssetMapping[$data["typeCode"]]['ASS_ASSET_NAME'];
				/*
			if ($data["typeCode"] == '01') {
				$fields["TYPE_CODE_NAME"] = "ที่ดิน";
			} else if ($data["typeCode"] == '02') {
				$fields["TYPE_CODE_NAME"] = "สิ่งปลูกสร้าง";
			} else if ($data["typeCode"] == '03') {
				$fields["TYPE_CODE_NAME"] = "ห้องชุด";
			} else if ($data["typeCode"] == '04') {
				$fields["TYPE_CODE_NAME"] = "สิทธิการเช่าที่ดิน";
			} else if ($data["typeCode"] == '05') {
				$fields["TYPE_CODE_NAME"] = "สิทธิการเช่าห้องชุด";
			} else if ($data["typeCode"] == '14') {
				$fields["TYPE_CODE_NAME"] = "อาวุธปืน";
			} else if ($data["typeCode"] == '13') {
				$fields["TYPE_CODE_NAME"] = "เครื่องจักร";
			} else if ($data["typeCode"] == '11') {
				$fields["TYPE_CODE_NAME"] = "รถยนต์";
			} else if ($data["typeCode"] == '08') {
				$fields["TYPE_CODE_NAME"] = "หุ้น";
			} else if ($data["typeCode"] == '10') {
				$fields["TYPE_CODE_NAME"] = "สลากออมทรัพย์";
			} else if ($data["typeCode"] == '99') {
				$fields["TYPE_CODE_NAME"] = "บัญชีทรัพย์สินอื่นๆ";
			}
			*/

				$fields["PROP_TITLE"] 		= $data["propTitle"];
				$fields["PROP_STATUS"] 		= $data["propStatus"];
				$fields["PROP_STATUS_NAME"] = $data["propStatusName"];

				$fields["EST_VANG_SUB"] 	= $data["estVangSub"]; //ราคาประเมินเจ้าพนักงานประเมินราคาทรัพย์
				$fields["EST_GROUP_AMOUNT"] = $data["estGroupAmount"]; //ราคาประเมินคณะกรรมการกำหนดราคาทรัพย์
				$fields["EST_SUB_AMOUNT"] 	= $data["estSubAmount"]; //ราคากำหนดพิเศษ
				$fields["EST_DOL"] 			= $data["estDol"]; //ราคาประเมินกรมธนารักษ์
				$fields["EST_PRICE_AMOUNT"] = $data["estPriceAmount"]; //ราคาประเมินเจ้าพนักงานบังคับคดี
				$fields["SALE_PRICE"] 		= $data["salePrice"]; //ราคาขาย
				$fields["EST_SPECIALIST"] 	= $data["estSpecialist"]; //ราคาประเมินผู้เชี่ยวชาญราคาประเมิน
				$fields["EST_MORTGAGE"] 	= $data["estMortgage"]; //ราคาประเมินที่จำนำ/จำนองไว้
				$fields["EST_BANK"] 		= $data["estBank"]; //ราคาประเมินที่สถาบันการเงินแจ้งต่อธนาคารแห่งประเทศไทย

				$fields["COMMIT_TYPE"]		= $data["commitType"];
				$fields["DATE_SALE"] 		= substr($data["dateSale"], 0, 10);
				$fields["ADDRESS"] 			= $data["address"];
				//$fields["ASSET_DESC"] 		= $text_owner;
				$fields["WH_CIVIL_ID"] 		= $WH_CIVIL_ID;
				$fields["DOSS_ID"] 			= $dataSelectDataDoss["DOSS_ID"];
				$fields["DOSS_CONTROL_GEN"] = $data["pccDossControlGen"];
				$fields["CFC_CAPTION_GEN"]  = $data["cfcCaptionGen"];
				$fields["CAP_NO"]  			= $data["capNo"];
				$fields["CAP_DATE"]  		= substr($data["capDate"], 0, 10);
				$fields["CAP_TIME"]  		= $data["capTime"];
				$fields["COPY_FLAG_NAME"]	= $data["copyFlagName"];
				$fields["SEQ_NO"]  			= $data["seqNo"];
				$fields["CAP_QTY"]			= $data["capQty"];
				$fields["UNIT"]  			= $data["unit"];
				$fields["LATITUDE"]			= $data["latitude"];
				$fields["LONGITUDE"]		= $data["longitude"];
				$fields["PERSON_OFFICER_NAME"]	= $data["personOfficerName"];
				$fields["RATIO_FLAG"]		= $data["ratioFlag"];
				$fields["RATIO_FLAG_NAME"]	= $data["ratioFlagName"];
				$fields["R_SELL_TYPE"]		= $data["rSellType"];
				$fields["R_SELL_TYPE_NAME"]	= $data["rSellTypeName"];
				$fields["ASSET_DATA_TYPE"]  = 1;
				$WH_ASSET_ID = db::db_insert("WH_CIVIL_CASE_ASSETS", $fields, 'WH_ASSET_ID', 'WH_ASSET_ID');


				$tableInsertDetail = $arrAssAssetMapping[$data["typeCode"]]['ASSET_LAW_CODE_2'];
				// $centLocGen = $data["assetsDetail"]['centLocGen'];
				// $sqlCentLoc = "SELECT * FROM CENT_LOC WHERE CENT_LOC_GEN = '$centLocGen' ";
				// $qryCentLoc = db::query($sqlCentLoc);
				// $recCentLoc = db::fetch_array($qryCentLoc);
				// db::db_delete($tableInsertDetail, array('WH_CIVIL_ID' => $WH_CIVIL_ID));

				if ($data["typeCode"] == '01') { // ที่ดิน

					$fieldInsertDatail = array(
						"CFC_LAND_GEN" => $data["assetsDetail"]['cfcLandGen'],
						"CFC_CIVIL_GEN" => $data["assetsDetail"]['cfcCivilGen'],
						"CFC_LAND_REQ_GEN" => $data["assetsDetail"]['cfcLandReqGen'],
						"SEQ_NO" => $data["assetsDetail"]['seqNo'],
						"LAND_TYPE" => $data["assetsDetail"]["landType"],
						"LAND_TYPE_NAME" => ($data["assetsDetail"]["landTypeName"]) ? $data["assetsDetail"]["landTypeName"] : '',
						"DEED_NO" => $data["assetsDetail"]["deedNo"],
						"LAND_NO" => $data["assetsDetail"]["landNo"],
						"BOOK_NO" => $data["assetsDetail"]["bookNo"],
						"PAGE_NO" => $data["assetsDetail"]["pageNo"],
						"SURVEY" => $data["assetsDetail"]["survey"],
						"DOC_BOOK_NO" => $data["assetsDetail"]["docBookNo"],
						"DOC_PAGE_NO" => $data["assetsDetail"]["docPageNo"],
						"MOO_NO" => $data["assetsDetail"]["mooNo"],
						"DISTRICT_NAME" => $data["assetsDetail"]["districtName"],
						"AMPHUR_NAME" => $data["assetsDetail"]["amphurName"],
						"PROVINCE_NAME" =>  $data["assetsDetail"]["provinceName"],
						"CENT_LOC_GEN" => $data["assetsDetail"]["centLocGen"],
						"COMMIT_TYPE" => $data["assetsDetail"]["commitType"],
						"COMMIT_TYPE_NAME" => $data["assetsDetail"]["commitTypeName"],
						"COMMIT_DESC" => $data["assetsDetail"]["commitDesc"],
						"FARM" => $data["assetsDetail"]["farm"],
						"NGAN" => $data["assetsDetail"]["ngan"],
						"VA" => $data["assetsDetail"]["va"],
						"REMAIN_VA" =>  $data["assetsDetail"]["remainVa"],
						"REMAIN_BASE" => $data["assetsDetail"]["remainBase"],
						"SURRENDER_FARM" => $data["assetsDetail"]["surrenderFarm"],
						"SURRENDER_NGAN" => $data["assetsDetail"]["surrenderNgan"],
						"SURRENDER_VA" => $data["assetsDetail"]["surrenderVa"],
						"SURRENDER_REMAIN_VA" => $data["assetsDetail"]["surrenderRemainVa"],
						"SURRENDER_REMAIN_BASE" => $data["assetsDetail"]['surrenderRemainBase'],
						"PART_FARM" => $data["assetsDetail"]['partFarm'],
						"PART_NGAN" => $data["assetsDetail"]["partNgan"],
						"PART_VA" => $data["assetsDetail"]["partVa"],
						"PART_REMAIN_VA" => $data["assetsDetail"]["partRemainVa"],
						"PART_REMAIN_BASE" => $data["assetsDetail"]["partRemainBase"],
						"EST_PER_FARM_AMOUNT" => $data["assetsDetail"]["estPerFarmAmount"],
						"EST_PER_VA_AMOUNT" => $data["assetsDetail"]["estPerVaAmount"],
						"EST_AREA_AMOUNT" => $data["assetsDetail"]["estAreaAmount"],
						"ADD_PERCENT" => $data["assetsDetail"]["addPercent"],
						"ADD_AMOUNT" => $data["assetsDetail"]["addAmount"],
						"MINUS_PERCENT" => $data["assetsDetail"]["minusPercent"],
						"MINUS_AMOUNT" => $data["assetsDetail"]["minusAmount"],
						"EST_ASS_AMOUNT" => $data["assetsDetail"]["estAssAmount"],
						"EST_GOV_AMOUNT" => $data["assetsDetail"]["estGovAmount"],
						"EST_PRICE_AMOUNT" => $data["assetsDetail"]["estPriceAmount"],
						"LAND_DESC" => $data["assetsDetail"]["landDesc"],
						"LAND_COMMENT" => $data["assetsDetail"]["landComment"],
						"NEARLY_AREA" => $data["assetsDetail"]["nearlyArea"],
						"R_SELL_TYPE" => $data["assetsDetail"]["rSellType"],
						"ASSET_STATUS" => $data["assetsDetail"]["assetStatus"],
						"ASSET_STATUS_NAME" => ($data["assetsDetail"]["assetStatusName"]) ? $data["assetsDetail"]["assetStatusName"] : '',
						"CENT_DEPT_GEN" => $data["assetsDetail"]["centDeptGen"],
						"CREATE_BY_USERID" => $data["assetsDetail"]["createByUserid"],
						"UPDATE_BY_USERID" => $data["assetsDetail"]["updateByUserid"],
						"CREATE_BY_PROGID" => $data["assetsDetail"]["createByProgid"],
						"UPDATE_BY_PROGID" => $data["assetsDetail"]["updateByProgid"],
						"VERSION" => $data["assetsDetail"]["version"],
						"DATA_ID" => $data["assetsDetail"]["dataId"],
						"HOUSE_FLAG" => $data["assetsDetail"]["houseFlag"],
						"PLOT_SEQ" => $data["assetsDetail"]["plotSeq"],
						"COPY_FLAG" => $data["assetsDetail"]["copyFlag"],
						"USER_DEPT_CODE" => $data["assetsDetail"]["userDeptCode"],
						"DPD_STRUCTURE_GEN" => $data["assetsDetail"]["dpdStructureGen"],
						"LAND_FOR_ID" => $data["assetsDetail"]["landForId"],
						"LAND_REGISTRATION_FLAG" => $data["assetsDetail"]["landRegistrationFlag"],
						"LAND_TRAIN_FLAG" => $data["assetsDetail"]["landTrainFlag"],
						"SOME_PART_FLAG" => $data["assetsDetail"]["somePartFlag"],
						"CREATE_DATE" => ($data['assetsDetail']['createDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['createDate'])) : '',
						"UPDATE_DATE" => ($data['assetsDetail']['updateDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['updateDate'])) : '',
						"WH_CIVIL_ID" => $WH_CIVIL_ID
					);

					db::db_insert($tableInsertDetail, $fieldInsertDatail);

					//	. 
				} else if ($data["typeCode"] == '02') {	// สิ่งปลูกสร้าง 

					$fieldInsertDatail = array(
						"CFC_HOUSE_GEN" => $data["assetsDetail"]['cfcHouseGen'],
						"CFC_HOUSE_REQ_GEN" => $data["assetsDetail"]['cfcHouseReqGen'],
						"CFC_CIVIL_GEN" => $data["assetsDetail"]['cfcCivilGen'],
						"SEQ_NO" => $data["assetsDetail"]['seqNo'],
						"HOUSE_TYPE" => $data["assetsDetail"]['houseType'],
						"HOUSE_TYPE_NAME" => $data["assetsDetail"]['houseTypeName'],
						"LAND_TYPE" => $data["assetsDetail"]['landType'],
						"VILLAGE_NAME" => $data["assetsDetail"]['villageName'],
						"ADDR_NO" => $data["assetsDetail"]['addrNo'],
						"MOO_NO" => $data["assetsDetail"]['mooNo'],
						"SOI" => $data["assetsDetail"]['soi'],
						"ROAD" => $data["assetsDetail"]['road'],
						"CENT_LOC_GEN" => $data["assetsDetail"]['centLocGen'],
						"POST_CODE" => $data["assetsDetail"]['postCode'],
						"HOUSE_DESC" => $data["assetsDetail"]['houseDesc'],
						"WIDE" => $data["assetsDetail"]['wide'],
						"HOUSE_LONG" => $data["assetsDetail"]['houseLong'],
						"FLOOR" => $data["assetsDetail"]['floor'],
						"AREA" => $data["assetsDetail"]['area'],
						"EST_PER_METR_AMOUNT" => $data["assetsDetail"]['estPerMetrAmount'],
						"ADD_PERCENT" => $data["assetsDetail"]['addPercent'],
						"ADD_AMOUNT" => $data["assetsDetail"]['addAmount'],
						"MINUS_PERCENT" => $data["assetsDetail"]['minusPercent'],
						"MINUS_AMOUNT" => $data["assetsDetail"]['minusAmount'],
						"EST_ASS_AMOUNT" => $data["assetsDetail"]['estAssAmount'],
						"EST_GOV_AMOUNT" => $data["assetsDetail"]['estGovAmount'],
						"EST_PRICE_AMOUNT" => $data["assetsDetail"]['estPriceAmount'],
						"HOUSE_COMMENT" => $data["assetsDetail"]['houseComment'],
						"NEARLY_AREA" => $data["assetsDetail"]['nearlyArea'],
						"R_SELL_TYPE" => $data["assetsDetail"]['rSellType'],
						"ASSET_STATUS" => $data["assetsDetail"]['assetStatus'],
						"ASSET_STATUS_NAME" => ($data["assetsDetail"]["assetStatusName"]) ? $data["assetsDetail"]["assetStatusName"] : '',
						"CENT_DEPT_GEN" => $data["assetsDetail"]['centDeptGen'],
						"LAND_FLAG" => $data["assetsDetail"]['landFlag'],
						"LAND_DESC" => $data["assetsDetail"]['landDesc'],
						"LAND_OWNER" => $data["assetsDetail"]['landOwner'],
						"HOUSE_AGE" => $data["assetsDetail"]['houseAge'],
						"RELETE_TYPE" => $data["assetsDetail"]['releteType'],
						"CREATE_BY_PROGID" => $data["assetsDetail"]['createByProgid'],
						"UPDATE_BY_PROGID" => $data["assetsDetail"]['updateByProgid'],
						"UPDATE_BY_USERID" => $data["assetsDetail"]['updateByUserid'],
						"CREATE_BY_USERID" => $data["assetsDetail"]['createByUserid'],
						"DATA_ID" => $data["assetsDetail"]['dataId'],
						"VERSION" => $data["assetsDetail"]['version'],
						"COPY_FLAG" => $data["assetsDetail"]['copyFlag'],
						"USER_DEPT_CODE" => $data["assetsDetail"]['userDeptCode'],
						"DPD_STRUCTURE_GEN" => $data["assetsDetail"]['dpdStructureGen'],
						"HOUSE_REGISTRATION_FLAG" => $data["assetsDetail"]['houseRegistrationFlag'],
						"HOUSE_TRAIN_FLAG" => $data["assetsDetail"]['houseTrainFlag'],
						"CREATE_DATE" => ($data['assetsDetail']['createDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['createDate'])) : '',
						"UPDATE_DATE" => ($data['assetsDetail']['updateDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['updateDate'])) : '',
						"WH_CIVIL_ID" => $WH_CIVIL_ID
					);

					db::db_insert($tableInsertDetail, $fieldInsertDatail);

					// 	.
				} else if ($data["typeCode"] == '03') {	//ห้องชุด (คอนโด)

					$fieldInsertDatail = array(
						"CFC_BUILDING_GEN" => $data["assetsDetail"]['cfcBuildingGen'],
						"CFC_CIVIL_GEN" => $data["assetsDetail"]['cfcCivilGen'],
						"CFC_BUILDING_REQ_GEN" => $data["assetsDetail"]['cfcBuildingReqGen'],
						"SEQ_NO" => $data["assetsDetail"]['seqNo'],
						"ADDR_NO" => $data["assetsDetail"]['addrNo'],
						"FLOOR" => $data["assetsDetail"]['floor'],
						"BUILDING_NO" => $data["assetsDetail"]['buildingNo'],
						"BUILDING_NAME" => $data["assetsDetail"]['buildingName'],
						"LICENSE_NO" => $data["assetsDetail"]['licenseNo'],
						"DEED_NO" => $data["assetsDetail"]['deedNo'],
						"DISTRICT_NAME" => $data["assetsDetail"]['districtName'],
						"AMPHUR_NAME" => $data["assetsDetail"]['amphurName'],
						"PROVINCE_NAME" => $data["assetsDetail"]['provinceName'],
						"SOI" => $data["assetsDetail"]['soi'],
						"MOO_NO" => $data["assetsDetail"]['mooNo'],
						"ROAD" => $data["assetsDetail"]['road'],
						"CENT_LOC_GEN" => $data["assetsDetail"]['centLocGen'],
						"FARM" => $data["assetsDetail"]['farm'],
						"NGAN" => $data["assetsDetail"]['ngan'],
						"VA" => $data["assetsDetail"]['va'],
						"REMAIN_VA" => $data["assetsDetail"]['remainVa'],
						"REMAIN_BASE" => $data["assetsDetail"]['remainBase'],
						"EST_AREA" => $data["assetsDetail"]['estArea'],
						"HIGHT" => $data["assetsDetail"]['hight'],
						"R_SELL_TYPE" => $data["assetsDetail"]['rSellType'],
						"OWNER_DIVIDEND" => $data["assetsDetail"]['ownerDividend'],
						"OWNER_DIVISOR" => $data["assetsDetail"]['ownerDivisor'],
						"CENTER_AMOUNT" => $data["assetsDetail"]['centerAmount'],
						"CENTER_METR_AMOUNT" => $data["assetsDetail"]['centerMetrAmount'],
						"CENTER_PERIOD" => $data["assetsDetail"]['centerPeriod'],
						"CENTER_EXPENSE_AMOUNT" => $data["assetsDetail"]['centerExpenseAmount'],
						"CENTER_DEBT_PERIOD" => $data["assetsDetail"]['centerDebtPeriod'],
						"PER_METR_AMOUNT" => $data["assetsDetail"]['perMetrAmount'],
						"ADD_PERCENT" => $data["assetsDetail"]['addPercent'],
						"ADD_AMOUNT" => $data["assetsDetail"]['addAmount'],
						"MINUS_PERCENT" => $data["assetsDetail"]['minusPercent'],
						"MINUS_AMOUNT" => $data["assetsDetail"]['minusAmount'],
						"EST_ASS_AMOUNT" => $data["assetsDetail"]['estAssAmount'],
						"EST_GOV_AMOUNT" => $data["assetsDetail"]['estGovAmount'],
						"EST_PRICE_AMOUNT" => $data["assetsDetail"]['estPriceAmount'],
						"BUILDING_DESC" => $data["assetsDetail"]['buildingDesc'],
						"NEARLY_AREA" => $data["assetsDetail"]['nearlyArea'],
						"ASSET_STATUS" => $data["assetsDetail"]['assetStatus'],
						"ASSET_STATUS_NAME" => ($data["assetsDetail"]["assetStatusName"]) ? $data["assetsDetail"]["assetStatusName"] : '',
						"CENT_DEPT_GEN" => $data["assetsDetail"]['centDeptGen'],
						"UPDATE_BY_USERID" => $data["assetsDetail"]['updateByUserid'],
						"CREATE_BY_PROGID" => $data["assetsDetail"]['createByProgid'],
						"UPDATE_BY_PROGID" => $data["assetsDetail"]['updateByProgid'],
						"CREATE_BY_USERID" => $data["assetsDetail"]['createByUserid'],
						"VERSION" => $data["assetsDetail"]['version'],
						"DATA_ID" => $data["assetsDetail"]['dataId'],
						"COPY_FLAG" => $data["assetsDetail"]['copyFlag'],
						"USER_DEPT_CODE" => $data["assetsDetail"]['userDeptCode'],
						"DPD_STRUCTURE_GEN" => $data["assetsDetail"]['dpdStructureGen'],
						"BUILDING_AGE" => $data["assetsDetail"]['buildingAge'],
						"BUILDING_REGISTRATION_FLAG" => $data["assetsDetail"]['buildingRegistrationFlag'],
						"BUILDING_TRAIN_FLAG" => $data["assetsDetail"]['buildingTrainFlag'],
						"CENTER_DEBT_DATE" => ($data['assetsDetail']['centerDebtDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['centerDebtDate'])) : '',
						"CREATE_DATE" => ($data['assetsDetail']['createDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['createDate'])) : '',
						"UPDATE_DATE" => ($data['assetsDetail']['updateDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['updateDate'])) : '',
						"WH_CIVIL_ID" => $WH_CIVIL_ID
					);

					db::db_insert($tableInsertDetail, $fieldInsertDatail);

					// 	.
				} else if ($data["typeCode"] == '04' || $data["typeCode"] == '07') {
					//สิทธิการเช่า ที่ดินและสิ่งปลูกสร้าง || สิทธิการเช่า แผงลอย

					$fieldInsertDatail = array(
						"CFC_LAND_RENT_RIGHT_GEN" => $data["assetsDetail"]['cfcLandRentRightGen'],
						"CFC_CIVIL_GEN" => $data["assetsDetail"]['cfcCivilGen'],
						"CFC_LAND_RENT_RIGHT_REQ_GEN" => $data["assetsDetail"]['cfcLandRentRightReqGen'],
						"SEQ_NO" => $data["assetsDetail"]['seqNo'],
						"RENT_TYPE" => $data["assetsDetail"]['rentType'],
						"RENT_TYPE_NAME" => $data["assetsDetail"]['rentTypeName'],
						"VILLAGE_NAME1" => $data["assetsDetail"]['villageName1'],
						"LAND_TYPE" => $data["assetsDetail"]['landType'],
						"LAND_TYPE_NAME" => ($data["assetsDetail"]["landTypeName"]) ? $data["assetsDetail"]["landTypeName"] : '',
						"DEED_NO" => $data["assetsDetail"]['deedNo'],
						"LAND_NO" => $data["assetsDetail"]['landNo'],
						"BOOK_NO" => $data["assetsDetail"]['bookNo'],
						"PAGE_NO" => $data["assetsDetail"]['pageNo'],
						"SURVEY" => $data["assetsDetail"]['survey'],
						"DOC_BOOK_NO" => $data["assetsDetail"]['docBookNo'],
						"DOC_PAGE_NO" => $data["assetsDetail"]['docPageNo'],
						"DOC_MOO_NO" => $data["assetsDetail"]['docMooNo'],
						"DISTRICT_NAME" => $data["assetsDetail"]['districtName'],
						"AMPHUR_NAME" => $data["assetsDetail"]['amphurName'],
						"PROVINCE_NAME" => $data["assetsDetail"]['provinceName'],
						"CENT_LOC_GEN" => $data["assetsDetail"]['centLocGen'],
						"FARM" => $data["assetsDetail"]['farm'],
						"NGAN" => $data["assetsDetail"]['ngan'],
						"VA" => $data["assetsDetail"]['va'],
						"REMAIN_VA" => $data["assetsDetail"]['remainVa'],
						"REMAIN_BASE" => $data["assetsDetail"]['remainBase'],
						"HOUSE_TYPE" => $data["assetsDetail"]['houseType'],
						"VILLAGE_NAME2" => $data["assetsDetail"]['villageName2'],
						"ADDR_NO" => $data["assetsDetail"]['addrNo'],
						"SOI" => $data["assetsDetail"]['soi'],
						"MOO_NO" => $data["assetsDetail"]['mooNo'],
						"ROAD" => $data["assetsDetail"]['road'],
						"CENT_LOC_GEN1" => $data["assetsDetail"]['centLocGen1'],
						"POST_CODE" => $data["assetsDetail"]['postCode'],
						"HOUSE_DESC" => $data["assetsDetail"]['houseDesc'],
						"WIDE" => $data["assetsDetail"]['wide'],
						"HOUSE_LONG" => $data["assetsDetail"]['houseLong'],
						"FLOOR" => $data["assetsDetail"]['floor'],
						"AREA" => $data["assetsDetail"]['area'],
						"EST_PER_METR_AMOUNT" => $data["assetsDetail"]['estPerMetrAmount'],
						"CONTACT_NO" => $data["assetsDetail"]['contactNo'],
						"RENT_QTY" => $data["assetsDetail"]['rentQty'],
						"RENT_UNIT" => $data["assetsDetail"]['rentUnit'],
						"REMAIN_DAY" => $data["assetsDetail"]['remainDay'],
						"RATE_AMOUNT" => $data["assetsDetail"]['rateAmount'],
						"UNIT_AMT" => $data["assetsDetail"]['unitAmt'],
						"UNIT_PERIOD" => $data["assetsDetail"]['unitPeriod'],
						"REMAIN_YR" => $data["assetsDetail"]['remainYr'],
						"REMAIN_MM" => $data["assetsDetail"]['remainMm'],
						"REMAIN_DD" => $data["assetsDetail"]['remainDd'],
						"EST_UNIT_AMOUNT" => $data["assetsDetail"]['estUnitAmount'],
						"EST_RENT_AMOUNT" => $data["assetsDetail"]['estRentAmount'],
						"START_AMOUNT" => $data["assetsDetail"]['startAmount'],
						"EST_START_AMOUNT" => $data["assetsDetail"]['estStartAmount'],
						"ADD_PERCENT" => $data["assetsDetail"]['addPercent'],
						"ADD_AMOUNT" => $data["assetsDetail"]['addAmount'],
						"MINUS_PERCENT" => $data["assetsDetail"]['minusPercent'],
						"MINUS_AMOUNT" => $data["assetsDetail"]['minusAmount'],
						"RENT_COMMENT" => $data["assetsDetail"]['rentComment'],
						"EST_PRICE_AMOUNT" => $data["assetsDetail"]['estPriceAmount'],
						"ASSET_STATUS" => $data["assetsDetail"]['assetStatus'],
						"ASSET_STATUS_NAME" => ($data["assetsDetail"]["assetStatusName"]) ? $data["assetsDetail"]["assetStatusName"] : '',
						"CENT_DEPT_GEN" => $data["assetsDetail"]['centDeptGen'],
						"CREATE_BY_USERID" => $data["assetsDetail"]['createByUserid'],
						"UPDATE_BY_USERID" => $data["assetsDetail"]['updateByUserid'],
						"CREATE_BY_PROGID" => $data["assetsDetail"]['createByProgid'],
						"UPDATE_BY_PROGID" => $data["assetsDetail"]['updateByProgid'],
						"VERSION" => $data["assetsDetail"]['version'],
						"DATA_ID" => $data["assetsDetail"]['dataId'],
						"PLOT_SEQ" => $data["assetsDetail"]['plotSeq'],
						"COPY_FLAG" => $data["assetsDetail"]['copyFlag'],
						"USER_DEPT_CODE" => $data["assetsDetail"]['userDeptCode'],
						"DPD_STRUCTURE_GEN" => $data["assetsDetail"]['dpdStructureGen'],
						"RENT_REGISTER" => $data["assetsDetail"]['rentRegister'],
						"LAND_REGISTRATION_FLAG" => $data["assetsDetail"]['landRegistrationFlag'],
						"HOUSE_REGISTRATION_FLAG" => $data["assetsDetail"]['houseRegistrationFlag'],
						"LAND_TRAIN_FLAG" => $data["assetsDetail"]['landTrainFlag'],
						"HOUSE_TRAIN_FLAG" => $data["assetsDetail"]['houseTrainFlag'],
						"CONTACT_DATE" => ($data['assetsDetail']['contactDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['contactDate'])) : '',
						"START_DATE" => ($data['assetsDetail']['startDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['startDate'])) : '',
						"EXPIRE_DATE" => ($data['assetsDetail']['expireDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['expireDate'])) : '',
						"CREATE_DATE" => ($data['assetsDetail']['createDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['createDate'])) : '',
						"UPDATE_DATE" => ($data['assetsDetail']['updateDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['updateDate'])) : '',
						"WH_CIVIL_ID" => $WH_CIVIL_ID
					);

					db::db_insert($tableInsertDetail, $fieldInsertDatail);

					// .
				} else if ($data["typeCode"] == '05' || $data["typeCode"] == '06') {
					//สิทธิการเช่า ห้องชุด || สิทธิการเช่า พื้นที่ในอาคาร

					$fieldInsertDatail = array(
						"CFC_BUILDING_RENT_RIGHT_GEN" => $data["assetsDetail"]['cfcBuildingRentRightGen'],
						"CFC_BD_RENT_RIGHT_REQ_GEN" => $data["assetsDetail"]['cfcBdRentRightReqGen'],
						"CFC_CIVIL_GEN" => $data["assetsDetail"]['cfcCivilGen'],
						"SEQ_NO" => $data["assetsDetail"]['seqNo'],
						"RENT_TYPE" => $data["assetsDetail"]['rentType'],
						"RENT_TYPE_NAME" => $data["assetsDetail"]['rentTypeName'],
						"VILLAGE_NAME" => $data["assetsDetail"]['villageName'],
						"ADDR_NO" => $data["assetsDetail"]['addrNo'],
						"FLOOR" => $data["assetsDetail"]['floor'],
						"BUILDING_NO" => $data["assetsDetail"]['buildingNo'],
						"BUILDING_NAME" => $data["assetsDetail"]['buildingName'],
						"LICENSE_NO" => $data["assetsDetail"]['licenseNo'],
						"DEED_NO" => $data["assetsDetail"]['deedNo'],
						"DISTRICT_NAME" => $data["assetsDetail"]['districtName'],
						"AMPHUR_NAME" => $data["assetsDetail"]['amphurName'],
						"PROVINCE_NAME" => $data["assetsDetail"]['provinceName'],
						"SOI" => $data["assetsDetail"]['soi'],
						"MOO_NO" => $data["assetsDetail"]['mooNo'],
						"ROAD" => $data["assetsDetail"]['road'],
						"CENT_LOG_GEN" => $data["assetsDetail"]['centLogGen'],
						"FARM" => $data["assetsDetail"]['farm'],
						"NGAN" => $data["assetsDetail"]['ngan'],
						"VA" => $data["assetsDetail"]['va'],
						"REMAIN_VA" => $data["assetsDetail"]['remainVa'],
						"REMAIN_BASE" => $data["assetsDetail"]['remainBase'],
						"CONTACT_NO" => $data["assetsDetail"]['contactNo'],
						"RENT_QTY" => $data["assetsDetail"]['rentQty'],
						"RENT_UNIT" => $data["assetsDetail"]['rentUnit'],
						"REMAIN_DAY" => $data["assetsDetail"]['remainDay'],
						"RATE_AMOUNT" => $data["assetsDetail"]['rateAmount'],
						"UNIT_AMOUNT" => $data["assetsDetail"]['unitAmount'],
						"UNIT_PERIOD" => $data["assetsDetail"]['unitPeriod'],
						"REMAIN_YR" => $data["assetsDetail"]['remainYr'],
						"REMAIN_MM" => $data["assetsDetail"]['remainMm'],
						"REMAIN_DD" => $data["assetsDetail"]['remainDd'],
						"EST_UNIT_AMOUNT" => $data["assetsDetail"]['estUnitAmount'],
						"EST_RENT_AMOUNT" => $data["assetsDetail"]['estRentAmount'],
						"START_AMOUNT" => $data["assetsDetail"]['startAmount'],
						"EST_START_AMOUNT" => $data["assetsDetail"]['estStartAmount'],
						"ADD_PERCENT" => $data["assetsDetail"]['addPercent'],
						"ADD_AMOUNT" => $data["assetsDetail"]['addAmount'],
						"MINUS_PERCENT" => $data["assetsDetail"]['minusPercent'],
						"MINUS_AMOUNT" => $data["assetsDetail"]['minusAmount'],
						"RENT_COMMENT" => $data["assetsDetail"]['rentComment'],
						"EST_PRICE_AMOUNT" => $data["assetsDetail"]['estPriceAmount'],
						"ASSET_STATUS" => $data["assetsDetail"]['assetStatus'],
						"ASSET_STATUS_NAME" => ($data["assetsDetail"]["assetStatusName"]) ? $data["assetsDetail"]["assetStatusName"] : '',
						"CENT_DEPT_GEN" => $data["assetsDetail"]['centDeptGen'],
						"CREATE_BY_USERID" => $data["assetsDetail"]['createByUserid'],
						"UPDATE_BY_USERID" => $data["assetsDetail"]['updateByUserid'],
						"CREATE_BY_PROGID" => $data["assetsDetail"]['createByProgid'],
						"UPDATE_BY_PROGID" => $data["assetsDetail"]['updateByProgid'],
						"VERSION" => $data["assetsDetail"]['version'],
						"DATA_ID" => $data["assetsDetail"]['dataId'],
						"COPY_FLAG" => $data["assetsDetail"]['copyFlag'],
						"USER_DEPT_CODE" => $data["assetsDetail"]['userDeptCode'],
						"DPD_STRUCTURE_GEN" => $data["assetsDetail"]['dpdStructureGen'],
						"WIDE" => $data["assetsDetail"]['wide'],
						"LONGS" => $data["assetsDetail"]['longs'],
						"VERANDA_WIDE" => $data["assetsDetail"]['verandaWide'],
						"AREA" => $data["assetsDetail"]['area'],
						"BUILDING_REGISTRATION_FLAG" => $data["assetsDetail"]['buildingRegistrationFlag'],
						"BUILDING_TRAIN_FLAG" => $data["assetsDetail"]['buildingTrainFlag'],
						"CONTACT_DATE" => ($data['assetsDetail']['contactDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['contactDate'])) : '',
						"START_DATE" => ($data['assetsDetail']['startDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['startDate'])) : '',
						"EXPIRE_DATE" => ($data['assetsDetail']['expireDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['expireDate'])) : '',
						"CREATE_DATE" => ($data['assetsDetail']['createDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['createDate'])) : '',
						"UPDATE_DATE" => ($data['assetsDetail']['updateDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['updateDate'])) : '',
						"WH_CIVIL_ID" => $WH_CIVIL_ID
					);

					db::db_insert($tableInsertDetail, $fieldInsertDatail);


					// .
				} else if ($data["typeCode"] == '08') {	//หุ้น

					$fieldInsertDatail = array(
						"CFC_STOCK_GEN" => $data["assetsDetail"]['cfcStockGen'],
						"CFC_CIVIL_GEN" => $data["assetsDetail"]['cfcCivilGen'],
						"CFC_STOCK_REQ_GEN" => $data["assetsDetail"]['cfcStockReqGen'],
						"SEQ_NO" => $data["assetsDetail"]['seqNo'],
						"STOCK_TYPE" => $data["assetsDetail"]['stockType'],
						"STOCK_TYPE_NAME" => $data["assetsDetail"]['stockTypeName'],
						"COMPANY_GEN" => $data["assetsDetail"]['companyGen'],
						"COMPANY_ID_CARD" => $data["assetsDetail"]['companyIdCard'],
						"COMPANY_NAME" => $data["assetsDetail"]['companyName'],
						"STOCK_NAME" => $data["assetsDetail"]['stockName'],
						"MANAGER_STOCK_NAME" => $data["assetsDetail"]['managerStockName'],
						"UNIT_AMOUNT" => $data["assetsDetail"]['unitAmount'],
						"STOCK_NO" => $data["assetsDetail"]['stockNo'],
						"TOTAL_AMOUNT" => $data["assetsDetail"]['totalAmount'],
						"PAID_AMOUNT" => $data["assetsDetail"]['paidAmount'],
						"HOLDER_LICENSE_NO" => $data["assetsDetail"]['holderLicenseNo'],
						"STOCK_QTY" => $data["assetsDetail"]['stockQty'],
						"STOCK_ID_FROM" => $data["assetsDetail"]['stockIdFrom'],
						"STOCK_ID_TO" => $data["assetsDetail"]['stockIdTo'],
						"STOCK_IN_OUT" => $data["assetsDetail"]['stockInOut'],
						"STOCK_IN_OUT_NAME" => $data["assetsDetail"]['stockInOutName'],
						"STOCK_RIGHT" => $data["assetsDetail"]['stockRight'],
						"STOCK_RIGHT_NAME" => $data["assetsDetail"]['stockRightName'],
						"EST_PRICE_AMOUNT" => $data["assetsDetail"]['estPriceAmount'],
						"STOCK_COMMENT" => $data["assetsDetail"]['stockComment'],
						"R_SELL_TYPE" => $data["assetsDetail"]['rSellType'],
						"ASSET_STATUS" => $data["assetsDetail"]['assetStatus'],
						"ASSET_STATUS_NAME" => ($data["assetsDetail"]["assetStatusName"]) ? $data["assetsDetail"]["assetStatusName"] : '',
						"CENT_DEPT_GEN" => $data["assetsDetail"]['centDeptGen'],
						"CREATE_BY_USERID" => $data["assetsDetail"]['createByUserid'],
						"UPDATE_BY_USERID" => $data["assetsDetail"]['updateByUserid'],
						"CREATE_BY_PROGID" => $data["assetsDetail"]['createByProgid'],
						"UPDATE_BY_PROGID" => $data["assetsDetail"]['updateByProgid'],
						"VERSION" => $data["assetsDetail"]['version'],
						"DATA_ID" => $data["assetsDetail"]['dataId'],
						"COPY_FLAG" => $data["assetsDetail"]['copyFlag'],
						"STOCK_COPY_FLAG" => $data["assetsDetail"]['stockCopyFlag'],
						"USER_DEPT_CODE" => $data["assetsDetail"]['userDeptCode'],
						"DPD_STRUCTURE_GEN" => $data["assetsDetail"]['dpdStructureGen'],
						"STOCK_REGISTRATION_FLAG" => $data["assetsDetail"]['stockRegistrationFlag'],
						"STOCK_DATE" => ($data['assetsDetail']['stockDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['stockDate'])) : '',
						"CREATE_DATE" => ($data['assetsDetail']['createDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['createDate'])) : '',
						"UPDATE_DATE" => ($data['assetsDetail']['updateDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['updateDate'])) : '',
						"WH_CIVIL_ID" => $WH_CIVIL_ID
					);

					db::db_insert($tableInsertDetail, $fieldInsertDatail);

					// .
				} else if ($data["typeCode"] == '09') {	//พันธบัตร

					$fieldInsertDatail = array(
						"CFC_BONDS_GEN" => $data["assetsDetail"]['cfcBondsGen'],
						"CFC_BONDS_REQ_GEN" => $data["assetsDetail"]['cfcBondsReqGen'],
						"CFC_CIVIL_GEN" => $data["assetsDetail"]['cfcCivilGen'],
						"SEQ_NO" => $data["assetsDetail"]['seqNo'],
						"BONDS_PERSON_GEN" => $data["assetsDetail"]['bondsPersonGen'],
						"BONDS_PERSON_ID_CARD" => $data["assetsDetail"]['bondsPersonIdCard'],
						"BONDS_PERSON_NAME" => $data["assetsDetail"]['bondsPersonName'],
						"UNIT_AMOUNT" => $data["assetsDetail"]['unitAmount'],
						"BONDS_ID" => $data["assetsDetail"]['bondsId'],
						"BONDS_NO" => $data["assetsDetail"]['bondsNo'],
						"RECEIVE_AMOUNT" => $data["assetsDetail"]['receiveAmount'],
						"RECEIVE_PERIOD" => $data["assetsDetail"]['receivePeriod'],
						"INTEREST_RATE" => $data["assetsDetail"]['interestRate'],
						"BONDS_RIGHT" => $data["assetsDetail"]['bondsRight'],
						"EST_PRICE_AMOUNT" => $data["assetsDetail"]['estPriceAmount'],
						"R_SELL_TYPE" => $data["assetsDetail"]['rSellType'],
						"ASSET_STATUS" => $data["assetsDetail"]['assetStatus'],
						"ASSET_STATUS_NAME" => ($data["assetsDetail"]["assetStatusName"]) ? $data["assetsDetail"]["assetStatusName"] : '',
						"CENT_DEPT_GEN" => $data["assetsDetail"]['centDeptGen'],
						"CREATE_BY_USERID" => $data["assetsDetail"]['createByUserid'],
						"UPDATE_BY_USERID" => $data["assetsDetail"]['updateByUserid'],
						"CREATE_BY_PROGID" => $data["assetsDetail"]['createByProgid'],
						"UPDATE_BY_PROGID" => $data["assetsDetail"]['updateByProgid'],
						"VERSION" => $data["assetsDetail"]['version'],
						"DATA_ID" => $data["assetsDetail"]['dataId'],
						"COPY_FLAG" => $data["assetsDetail"]['copyFlag'],
						"BONDS_NAME" => $data["assetsDetail"]['bondsName'],
						"USER_DEPT_CODE" => $data["assetsDetail"]['userDeptCode'],
						"DPD_STRUCTURE_GEN" => $data["assetsDetail"]['dpdStructureGen'],
						"BONDS_NO_TO" => $data["assetsDetail"]['bondsNoTo'],
						"ISIN_CODE" => $data["assetsDetail"]['isinCode'],
						"BOND_AMT" => $data["assetsDetail"]['bondAmt'],
						"BONDS_REGISTRATION_FLAG" => $data["assetsDetail"]['bondsRegistrationFlag'],
						"BONDS_COMMENT" => $data["assetsDetail"]['bondsComment'],
						"FROM_DATE" => ($data['assetsDetail']['fromDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['fromDate'])) : '',
						"RECEIVE_DATE1" => ($data['assetsDetail']['receiveDate1']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['receiveDate1'])) : '',
						"RECEIVE_DATE2" => ($data['assetsDetail']['receiveDate2']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['receiveDate2'])) : '',
						"CREATE_DATE" => ($data['assetsDetail']['createDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['createDate'])) : '',
						"UPDATE_DATE" => ($data['assetsDetail']['updateDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['updateDate'])) : '',
						"WH_CIVIL_ID" => $WH_CIVIL_ID
					);

					db::db_insert($tableInsertDetail, $fieldInsertDatail);

					//  .
				} else if ($data["typeCode"] == '10') {	//สลากออมทรัพย์

					$fieldInsertDatail = array(
						"CFC_SAVE_GEN" => $data["assetsDetail"]['cfcSaveGen'],
						"CFC_CIVIL_GEN" => $data["assetsDetail"]['cfcCivilGen'],
						"SEQ_NO" => $data["assetsDetail"]['seqNo'],
						"SAVE_ORG_GEN" => $data["assetsDetail"]['saveOrgGen'],
						"SAVE_ORG_ID_CARD" => $data["assetsDetail"]['saveOrgIdCard'],
						"SAVE_ORG_NAME" => $data["assetsDetail"]['saveOrgName'],
						"SAVE_NO_FR" => $data["assetsDetail"]['saveNoFr'],
						"SAVE_NO_TO" => $data["assetsDetail"]['saveNoTo'],
						"SAVE_UNIT" => $data["assetsDetail"]['saveUnit'],
						"SAVE_UNIT_PRI" => $data["assetsDetail"]['saveUnitPri'],
						"SAVE_AMT" => $data["assetsDetail"]['saveAmt'],
						"SAVE_OFFICE" => $data["assetsDetail"]['saveOffice'],
						"SAVE_BOOK_NO" => $data["assetsDetail"]['saveBookNo'],
						"SAVE_VALUE" => $data["assetsDetail"]['saveValue'],
						"SAVE_RUN_NO" => $data["assetsDetail"]['saveRunNo'],
						"SAVE_DESC_OTH" => $data["assetsDetail"]['saveDescOth'],
						"ASSET_STATUS" => $data["assetsDetail"]['assetStatus'],
						"ASSET_STATUS_NAME" => ($data["assetsDetail"]["assetStatusName"]) ? $data["assetsDetail"]["assetStatusName"] : '',
						"CREATE_BY_USERID" => $data["assetsDetail"]['createByUserid'],
						"UPDATE_BY_USERID" => $data["assetsDetail"]['updateByUserid'],
						"CREATE_BY_PROGID" => $data["assetsDetail"]['createByProgid'],
						"UPDATE_BY_PROGID" => $data["assetsDetail"]['updateByProgid'],
						"VERSION" => $data["assetsDetail"]['version'],
						"DATA_ID" => $data["assetsDetail"]['dataId'],
						"CENT_DEPT_GEN" => $data["assetsDetail"]['centDeptGen'],
						"CFC_SAVE_REQ_GEN" => $data["assetsDetail"]['cfcSaveReqGen'],
						"EST_PRICE_AMOUNT" => $data["assetsDetail"]['estPriceAmount'],
						"COPY_FLAG" => $data["assetsDetail"]['copyFlag'],
						"SAVE_NAME" => $data["assetsDetail"]['saveName'],
						"USER_DEPT_CODE" => $data["assetsDetail"]['userDeptCode'],
						"DPD_STRUCTURE_GEN" => $data["assetsDetail"]['dpdStructureGen'],
						"ALIAS_NAME" => $data["assetsDetail"]['aliasName'],
						"PRE_SAVE_NO_FROM" => $data["assetsDetail"]['preSaveNoFrom'],
						"PRE_SAVE_NO_TO" => $data["assetsDetail"]['preSaveNoTo'],
						"SAVE_REGISTRATION_FLAG" => $data["assetsDetail"]['saveRegistrationFlag'],
						"SAVE_RECV_DATE" => ($data['assetsDetail']['saveRecvDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['saveRecvDate'])) : '',
						"SAVE_START_DATE" => ($data['assetsDetail']['saveStartDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['saveStartDate'])) : '',
						"SAVE_END_DATE" => ($data['assetsDetail']['saveEndDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['saveEndDate'])) : '',
						"SAVE_DEAD_LINE_DATE" => ($data['assetsDetail']['saveDeadLineDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['saveDeadLineDate'])) : '',
						"CREATE_DATE" => ($data['assetsDetail']['createDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['createDate'])) : '',
						"UPDATE_DATE" => ($data['assetsDetail']['updateDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['updateDate'])) : '',
						"WH_CIVIL_ID" => $WH_CIVIL_ID
					);

					db::db_insert($tableInsertDetail, $fieldInsertDatail);

					// .
				} else if ($data["typeCode"] == '11') { // รถ

					$fieldInsertDatail = array(
						"CFC_VEHICLE_GEN" => $data["assetsDetail"]['cfcVehicleGen'],
						"CFC_CIVIL_GEN" => $data["assetsDetail"]['cfcCivilGen'],
						"CFC_VEHICLE_REQ_GEN" => $data["assetsDetail"]['cfcVehicleReqGen'],
						"SEQ_NO" => $data["assetsDetail"]['seqNo'],
						"VEHICLE_TYPE" => $data["assetsDetail"]['vehicleType'],
						"PLATE_NO1" => $data["assetsDetail"]['plateNo1'],
						"PLATE_NO2" => $data["assetsDetail"]['plateNo2'],
						"CENT_LOC_GEN" => $data["assetsDetail"]['centLocGen'],
						"LICENSE_PLACE" => $data["assetsDetail"]['licensePlace'],
						"BRAND_TYPE" => $data["assetsDetail"]['brandType'],
						"MODEL" => $data["assetsDetail"]['model'],
						"BODY_NO" => $data["assetsDetail"]['bodyNo'],
						"ENGINE_BRAND" => $data["assetsDetail"]['engineBrand'],
						"ENGINE_NO" => $data["assetsDetail"]['engineNo'],
						"FUEL_NAME" => $data["assetsDetail"]['fuelName'],
						"SOOP_QTY" => $data["assetsDetail"]['soopQty'],
						"HORSE_POWER" => $data["assetsDetail"]['horsePower'],
						"AXLE_QTY" => $data["assetsDetail"]['axleQty'],
						"WHEEL_QTY" => $data["assetsDetail"]['wheelQty'],
						"TUBE_QTY" => $data["assetsDetail"]['tubeQty'],
						"COLOUR" => $data["assetsDetail"]['colour'],
						"SEAT_QTY" => $data["assetsDetail"]['seatQty'],
						"STAND_QTY" => $data["assetsDetail"]['standQty'],
						"BODY_WEIGHT" => $data["assetsDetail"]['bodyWeight'],
						"CARRY_WEIGHT" => $data["assetsDetail"]['carryWeight'],
						"TOTAL_WEIGHT" => $data["assetsDetail"]['totalWeight'],
						"DOOR_QTY" => $data["assetsDetail"]['doorQty'],
						"EST_PRICE_AMOUNT" => $data["assetsDetail"]['estPriceAmount'],
						"ACCESSORY_DESC" => $data["assetsDetail"]['accessoryDesc'],
						"VEHICLE_DESC" => $data["assetsDetail"]['vehicleDesc'],
						"OTH_DESC" => $data["assetsDetail"]['othDesc'],
						"KEEP_PERSON_GEN" => $data["assetsDetail"]['keepPersonGen'],
						"KEEP_LOCATION" => $data["assetsDetail"]['keepLocation'],
						"KEEP_CENT_LOC_GEN" => $data["assetsDetail"]['keepCentLocGen'],
						"R_SELL_TYPE" => $data["assetsDetail"]['rSellType'],
						"ASSET_STATUS" => $data["assetsDetail"]['assetStatus'],
						"ASSET_STATUS_NAME" => ($data["assetsDetail"]["assetStatusName"]) ? $data["assetsDetail"]["assetStatusName"] : '',
						"CENT_DEPT_GEN" => $data["assetsDetail"]['centDeptGen'],
						"CREATE_BY_USERID" => $data["assetsDetail"]['createByUserid'],
						"UPDATE_BY_USERID" => $data["assetsDetail"]['updateByUserid'],
						"CREATE_BY_PROGID" => $data["assetsDetail"]['createByProgid'],
						"UPDATE_BY_PROGID" => $data["assetsDetail"]['updateByProgid'],
						"VERSION" => $data["assetsDetail"]['version'],
						"DATA_ID" => $data["assetsDetail"]['dataId'],
						"COPY_FLAG" => $data["assetsDetail"]['copyFlag'],
						"USER_DEPT_CODE" => $data["assetsDetail"]['userDeptCode'],
						"DPD_STRUCTURE_GEN" => $data["assetsDetail"]['dpdStructureGen'],
						"TUBE_WHEEL" => $data["assetsDetail"]['tubeWheel'],
						"STARDARD_DESC" => $data["assetsDetail"]['stardardDesc'],
						"CLASS_DESC" => $data["assetsDetail"]['classDesc'],
						"VEHICLE_REGISTRATION_FLAG" => $data["assetsDetail"]['vehicleRegistrationFlag'],
						"VEHICLE_COMMENT" => $data["assetsDetail"]['vehicleComment'],
						"LICENSE_DATE" => ($data['assetsDetail']['licenseDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['licenseDate'])) : '',
						"CREATE_DATE" => ($data['assetsDetail']['createDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['createDate'])) : '',
						"UPDATE_DATE" => ($data['assetsDetail']['updateDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['updateDate'])) : '',
						"VEHICLE_TYPE_NAME" => $data["assetsDetail"]['vehicleTypeName'],
						"BRAND_TYPE_NAME" => $data["assetsDetail"]['brandTypeName'],
						"ENGINE_BRAND_NAME" => $data["assetsDetail"]['engineBrandName'],
						"WH_CIVIL_ID" => $WH_CIVIL_ID
					);

					db::db_insert($tableInsertDetail, $fieldInsertDatail);

					// .
				} else if ($data["typeCode"] == '12') {	//เรือ

					$fieldInsertDatail = array(
						"CFC_BOAT_GEN" => $data["assetsDetail"]['cfcBoatGen'],
						"CFC_BOAT_REQ_GEN" => $data["assetsDetail"]['cfcBoatReqGen'],
						"CFC_CIVIL_GEN" => $data["assetsDetail"]['cfcCivilGen'],
						"SEQ_NO" => $data["assetsDetail"]['seqNo'],
						"BOAT_TYPE" => $data["assetsDetail"]['boatType'],
						"BOAT_TYPE_NAME" => $data["assetsDetail"]['boatTypeName'],
						"BOAT_LOC_GEN" => $data["assetsDetail"]['boatLocGen'],
						"BOAT_NAME" => $data["assetsDetail"]['boatName'],
						"BOAT_ID" => $data["assetsDetail"]['boatId'],
						"FLAG_NAME" => $data["assetsDetail"]['flagName'],
						"PORT_NAME" => $data["assetsDetail"]['portName'],
						"BOAT_COMMENT" => $data["assetsDetail"]['boatComment'],
						"CHECK_COMMENT" => $data["assetsDetail"]['checkComment'],
						"EST_PRICE_AMOUNT" => $data["assetsDetail"]['estPriceAmount'],
						"KEEP_PERSON_GEN" => $data["assetsDetail"]['keepPersonGen'],
						"KEEP_LOCATION" => $data["assetsDetail"]['keepLocation'],
						"KEEP_CENT_LOC_GEN" => $data["assetsDetail"]['keepCentLocGen'],
						"ASSET_STATUS" => $data["assetsDetail"]['assetStatus'],
						"ASSET_STATUS_NAME" => ($data["assetsDetail"]["assetStatusName"]) ? $data["assetsDetail"]["assetStatusName"] : '',
						"CENT_DEPT_GEN" => $data["assetsDetail"]['centDeptGen'],
						"R_SELL_TYPE" => $data["assetsDetail"]['rSellType'],
						"CREATE_BY_USERID" => $data["assetsDetail"]['createByUserid'],
						"UPDATE_BY_USERID" => $data["assetsDetail"]['updateByUserid'],
						"CREATE_BY_PROGID" => $data["assetsDetail"]['createByProgid'],
						"UPDATE_BY_PROGID" => $data["assetsDetail"]['updateByProgid'],
						"VERSION" => $data["assetsDetail"]['version'],
						"DATA_ID" => $data["assetsDetail"]['dataId'],
						"COPY_FLAG" => $data["assetsDetail"]['copyFlag'],
						"USER_DEPT_CODE" => $data["assetsDetail"]['userDeptCode'],
						"DPD_STRUCTURE_GEN" => $data["assetsDetail"]['dpdStructureGen'],
						"BOAT_REGISTRATION_FLAG" => $data["assetsDetail"]['boatRegistrationFlag'],
						"CREATE_DATE" => ($data['assetsDetail']['createDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['createDate'])) : '',
						"UPDATE_DATE" => ($data['assetsDetail']['updateDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['updateDate'])) : '',
						"WH_CIVIL_ID" => $WH_CIVIL_ID
					);

					db::db_insert($tableInsertDetail, $fieldInsertDatail);

					// .
				} else if ($data["typeCode"] == '13') {	//เครื่องจักร

					$fieldInsertDatail = array(
						"CFC_MACHINE_GEN" => $data["assetsDetail"]['cfcMachineGen'],
						"CFC_CIVIL_GEN" => $data["assetsDetail"]['cfcCivilGen'],
						"SEQ_NO" => $data["assetsDetail"]['seqNo'],
						"MACHINE_NAME" => $data["assetsDetail"]['machineName'],
						"MACHINE_SIZE" => $data["assetsDetail"]['machineSize'],
						"BRAND_NAME" => $data["assetsDetail"]['brandName'],
						"COLOUR" => $data["assetsDetail"]['colour'],
						"MACHINE_MODEL" => $data["assetsDetail"]['machineModel'],
						"ENGINE_NO" => $data["assetsDetail"]['engineNo'],
						"LICENSE_NO" => $data["assetsDetail"]['licenseNo'],
						"MACHINE_COMMENT" => $data["assetsDetail"]['machineComment'],
						"ADDR_NO" => $data["assetsDetail"]['addrNo'],
						"MOO_NO" => $data["assetsDetail"]['mooNo'],
						"PROJECT_NAME" => $data["assetsDetail"]['projectName'],
						"FLOOR" => $data["assetsDetail"]['floor'],
						"SOI" => $data["assetsDetail"]['soi'],
						"ROAD" => $data["assetsDetail"]['road'],
						"CENT_LOC_GEN" => $data["assetsDetail"]['centLocGen'],
						"POST_CODE" => $data["assetsDetail"]['postCode'],
						"EST_PRICE_AMOUNT" => $data["assetsDetail"]['estPriceAmount'],
						"KEEP_PERSON_GEN" => $data["assetsDetail"]['keepPersonGen'],
						"KEEP_LOCATION" => $data["assetsDetail"]['keepLocation'],
						"KEEP_CENT_LOC_GEN" => $data["assetsDetail"]['keepCentLocGen'],
						"R_SELL_TYPE" => $data["assetsDetail"]['rSellType'],
						"ASSET_STATUS" => $data["assetsDetail"]['assetStatus'],
						"ASSET_STATUS_NAME" => ($data["assetsDetail"]["assetStatusName"]) ? $data["assetsDetail"]["assetStatusName"] : '',
						"CENT_DEPT_GEN" => $data["assetsDetail"]['centDeptGen'],
						"CREATE_BY_USERID" => $data["assetsDetail"]['createByUserid'],
						"UPDATE_BY_USERID" => $data["assetsDetail"]['updateByUserid'],
						"CREATE_BY_PROGID" => $data["assetsDetail"]['createByProgid'],
						"UPDATE_BY_PROGID" => $data["assetsDetail"]['updateByProgid'],
						"VERSION" => $data["assetsDetail"]['version'],
						"DATA_ID" => $data["assetsDetail"]['dataId'],
						"CFC_MACHINE_REQ_GEN" => $data["assetsDetail"]['cfcMachineReqGen'],
						"COPY_FLAG" => $data["assetsDetail"]['copyFlag'],
						"USER_DEPT_CODE" => $data["assetsDetail"]['userDeptCode'],
						"DPD_STRUCTURE_GEN" => $data["assetsDetail"]['dpdStructureGen'],
						"MODEL_DESC" => $data["assetsDetail"]['modelDesc'],
						"CLASS_DESC" => $data["assetsDetail"]['classDesc'],
						"MACHINE_REGISTRATION_FLAG" => $data["assetsDetail"]['machineRegistrationFlag'],
						"CREATE_DATE" => ($data['assetsDetail']['createDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['createDate'])) : '',
						"UPDATE_DATE" => ($data['assetsDetail']['updateDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['updateDate'])) : '',
						"WH_CIVIL_ID" => $WH_CIVIL_ID
					);

					db::db_insert($tableInsertDetail, $fieldInsertDatail);

					// .
				} else if ($data["typeCode"] == '14') {	//อาวุธปืน

					$fieldInsertDatail = array(
						"CFC_GUN_GEN" => $data["assetsDetail"]['cfcGunGen'],
						"CFC_CIVIL_GEN" => $data["assetsDetail"]['cfcCivilGen'],
						"CFC_GUN_REQ_GEN" => $data["assetsDetail"]['cfcGunReqGen'],
						"SEQ_NO" => $data["assetsDetail"]['seqNo'],
						"LICENSE_NO" => $data["assetsDetail"]['licenseNo'],
						"LICENSE_YR" => $data["assetsDetail"]['licenseYr'],
						"LICENSE_PLACE" => $data["assetsDetail"]['licensePlace'],
						"TYPE_DESC" => $data["assetsDetail"]['typeDesc'],
						"GUN_SIZE" => $data["assetsDetail"]['gunSize'],
						"GUN_NO" => $data["assetsDetail"]['gunNo'],
						"MAKE_PERSON" => $data["assetsDetail"]['makePerson'],
						"GUN_SIGN" => $data["assetsDetail"]['gunSign'],
						"FROM_PERSON" => $data["assetsDetail"]['fromPerson'],
						"BULLET_DESC" => $data["assetsDetail"]['bulletDesc'],
						"ACCESSORY_DESC" => $data["assetsDetail"]['accessoryDesc'],
						"FEE_AMOUNT" => $data["assetsDetail"]['feeAmount'],
						"EST_PRICE_AMOUNT" => $data["assetsDetail"]['estPriceAmount'],
						"KEEP_PERSON_GEN" => $data["assetsDetail"]['keepPersonGen'],
						"KEEP_LOCATION" => $data["assetsDetail"]['keepLocation'],
						"KEEP_CENT_LOC_GEN" => $data["assetsDetail"]['keepCentLocGen'],
						"R_SELL_TYPE" => $data["assetsDetail"]['rSellType'],
						"ASSET_STATUS" => $data["assetsDetail"]['assetStatus'],
						"ASSET_STATUS_NAME" => ($data["assetsDetail"]["assetStatusName"]) ? $data["assetsDetail"]["assetStatusName"] : '',
						"CENT_DEPT_GEN" => $data["assetsDetail"]['centDeptGen'],
						"CREATE_BY_USERID" => $data["assetsDetail"]['createByUserid'],
						"UPDATE_BY_USERID" => $data["assetsDetail"]['updateByUserid'],
						"CREATE_BY_PROGID" => $data["assetsDetail"]['createByProgid'],
						"UPDATE_BY_PROGID" => $data["assetsDetail"]['updateByProgid'],
						"VERSION" => $data["assetsDetail"]['version'],
						"DATA_ID" => $data["assetsDetail"]['dataId'],
						"COPY_FLAG" => $data["assetsDetail"]['copyFlag'],
						"USER_DEPT_CODE" => $data["assetsDetail"]['userDeptCode'],
						"DPD_STRUCTURE_GEN" => $data["assetsDetail"]['dpdStructureGen'],
						"BRAND_NAME" => $data["assetsDetail"]['brandName'],
						"GUN_COMMENT" => $data["assetsDetail"]['gunComment'],
						"GUN_REGISTRATION_FLAG" => $data["assetsDetail"]['gunRegistrationFlag'],
						"LICENSE_DATE" => ($data['assetsDetail']['licenseDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['licenseDate'])) : '',
						"EXPIRE_DATE" => ($data['assetsDetail']['expireDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['expireDate'])) : '',
						"CREATE_DATE" => ($data['assetsDetail']['createDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['createDate'])) : '',
						"UPDATE_DATE" => ($data['assetsDetail']['updateDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['updateDate'])) : '',
						"WH_CIVIL_ID" => $WH_CIVIL_ID
					);

					db::db_insert($tableInsertDetail, $fieldInsertDatail);

					// .
				} else if ($data["typeCode"] == '16') {	//หน่วยลงทุน

					$fieldInsertDatail = array(
						"CFC_FUND_GEN" => $data["assetsDetail"]['cfcFundGen'],
						"FUND_TYPE" => $data["assetsDetail"]['fundType'],
						"COMPANY_GEN" => $data["assetsDetail"]['companyGen'],
						"FUND_NAME" => $data["assetsDetail"]['fundName'],
						"MANAGER_FUND_NAME" => $data["assetsDetail"]['managerFundName'],
						"HOLDER_LICENSE_NO" => $data["assetsDetail"]['holderLicenseNo'],
						"FUND_QTY" => $data["assetsDetail"]['fundQty'],
						"FUND_RIGHT" => $data["assetsDetail"]['fundRight'],
						"FUND_COMMENT" => $data["assetsDetail"]['fundComment'],
						"EST_PRICE_AMOUNT" => $data["assetsDetail"]['estPriceAmount'],
						"KEEP_PERSON_GEN" => $data["assetsDetail"]['keepPersonGen'],
						"COMMIT_FLAG" => $data["assetsDetail"]['commitFlag'],
						"COMMIT_DESC" => $data["assetsDetail"]['commitDesc'],
						"CENT_DEPT_GEN" => $data["assetsDetail"]['centDeptGen'],
						"CREATE_BY_USERID" => $data["assetsDetail"]['createByUserid'],
						"UPDATE_BY_USERID" => $data["assetsDetail"]['updateByUserid'],
						"CREATE_BY_PROGID" => $data["assetsDetail"]['createByProgid'],
						"UPDATE_BY_PROGID" => $data["assetsDetail"]['updateByProgid'],
						"VERSION" => $data["assetsDetail"]['version'],
						"DATA_ID" => $data["assetsDetail"]['dataId'],
						"USER_DEPT_CODE" => $data["assetsDetail"]['userDeptCode'],
						"DPD_STRUCTURE_GEN" => $data["assetsDetail"]['dpdStructureGen'],
						"LICENSE_FLAG" => $data["assetsDetail"]['licenseFlag'],
						"DIAGRAM_FLAG" => $data["assetsDetail"]['diagramFlag'],
						"B_RIGHT_FLAG" => $data["assetsDetail"]['bRightFlag'],
						"MAP_FLAG" => $data["assetsDetail"]['mapFlag'],
						"ESTIMATE_COST_FLAG" => $data["assetsDetail"]['estimateCostFlag'],
						"CONTRACT_FLAG" => $data["assetsDetail"]['contractFlag'],
						"PICTURE_FLAG" => $data["assetsDetail"]['pictureFlag'],
						"B_CONTRACT_FLAG" => $data["assetsDetail"]['bContractFlag'],
						"OTHER_DOC_FLAG" => $data["assetsDetail"]['otherDocFlag'],
						"OTHER_DOC_DESC" => $data["assetsDetail"]['otherDocDesc'],
						"FUND_VALUE" => $data["assetsDetail"]['fundValue'],
						"FUND_REGISTRATION_FLAG" => $data["assetsDetail"]['fundRegistrationFlag'],
						"HOLDER_NAME" => $data["assetsDetail"]['holderName'],
						"FUND_DATE" => ($data['assetsDetail']['fundDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['fundDate'])) : '',
						"CREATE_DATE" => ($data['assetsDetail']['createDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['createDate'])) : '',
						"UPDATE_DATE" => ($data['assetsDetail']['updateDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['updateDate'])) : '',
						"WH_CIVIL_ID" => $WH_CIVIL_ID
					);

					db::db_insert($tableInsertDetail, $fieldInsertDatail);

					// .
				} else if ($data["typeCode"] == '99') {	//บัญชีทรัพย์สินอื่นๆ

					$fieldInsertDatail = array(
						"CFC_OTHER_CAPTION_GEN" => $data["assetsDetail"]['cfcOtherCaptionGen'],
						"CFC_CIVIL_GEN" => $data["assetsDetail"]['cfcCivilGen'],
						"CFC_OTHER_CAPTION_REQ_GEN" => $data["assetsDetail"]['cfcOtherCaptionReqGen'],
						"SEQ_NO" => $data["assetsDetail"]['seqNo'],
						"CAP_NAME" => $data["assetsDetail"]['capName'],
						"CAP_QTY" => $data["assetsDetail"]['capQty'],
						"ADDR_NO" => $data["assetsDetail"]['addrNo'],
						"MOO_NO" => $data["assetsDetail"]['mooNo'],
						"PROJECT_NAME" => $data["assetsDetail"]['projectName'],
						"FLOOR" => $data["assetsDetail"]['floor'],
						"SOI" => $data["assetsDetail"]['soi'],
						"ROAD" => $data["assetsDetail"]['road'],
						"CENT_LOC_GEN" => $data["assetsDetail"]['centLocGen'],
						"POST_CODE" => $data["assetsDetail"]['postCode'],
						"EST_PRICE_AMOUNT" => $data["assetsDetail"]['estPriceAmount'],
						"KEEP_PERSON_GEN" => $data["assetsDetail"]['keepPersonGen'],
						"KEEP_LOCATION" => $data["assetsDetail"]['keepLocation'],
						"KEEP_CENT_LOC_GEN" => $data["assetsDetail"]['keepCentLocGen'],
						"R_SELL_TYPE" => $data["assetsDetail"]['rSellType'],
						"ASSET_STATUS" => $data["assetsDetail"]['assetStatus'],
						"ASSET_STATUS_NAME" => ($data["assetsDetail"]["assetStatusName"]) ? $data["assetsDetail"]["assetStatusName"] : '',
						"CENT_DEPT_GEN" => $data["assetsDetail"]['centDeptGen'],
						"CREATE_BY_USERID" => $data["assetsDetail"]['createByUserid'],
						"UPDATE_BY_USERID" => $data["assetsDetail"]['updateByUserid'],
						"CREATE_BY_PROGID" => $data["assetsDetail"]['createByProgid'],
						"UPDATE_BY_PROGID" => $data["assetsDetail"]['updateByProgid'],
						"VERSION" => $data["assetsDetail"]['version'],
						"DATA_ID" => $data["assetsDetail"]['dataId'],
						"OTHER_COMMENT" => $data["assetsDetail"]['otherComment'],
						"UNIT_AMOUNT" => $data["assetsDetail"]['unitAmount'],
						"UNIT" => $data["assetsDetail"]['unit'],
						"REGISTER_NO" => $data["assetsDetail"]['registerNo'],
						"COPY_FLAG" => $data["assetsDetail"]['copyFlag'],
						"USER_DEPT_CODE" => $data["assetsDetail"]['userDeptCode'],
						"DPD_STRUCTURE_GEN" => $data["assetsDetail"]['dpdStructureGen'],
						"OTHER_CAPTION_REG_FLAG" => $data["assetsDetail"]['otherCaptionRegFlag'],
						"CASH_FLAG" => $data["assetsDetail"]['cashFlag'],
						"FRESH_PRODUCT_FLAG" => $data["assetsDetail"]['freshProductFlag'],
						"CREATE_DATE" => ($data['assetsDetail']['createDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['createDate'])) : '',
						"UPDATE_DATE" => ($data['assetsDetail']['updateDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['updateDate'])) : '',
						"SALE_DATE" => ($data['assetsDetail']['saleDate']) ? date('Y-m-d H:i:s', strtotime($data['assetsDetail']['saleDate'])) : '',
						"WH_CIVIL_ID" => $WH_CIVIL_ID
					);

					db::db_insert($tableInsertDetail, $fieldInsertDatail);

					// .
				}
				// } else if ($data["typeCode"] == '70') {	//ทรัพย์อายัดสิทธิ์เรียกร้อง
				// } else if ($data["typeCode"] == '90') {	//รวบรวมทรัพย์



				$text_owner = "";
				if (count($data["owner"]) > 0) {
					foreach ($data['owner'] as $key_owner => $data_owner) {

						$text_ratioFlag = "";
						if ($data_owner["ratioFlag"] == 1) {
							$text_ratioFlag = "เฉลี่ย";
						} else if ($data_owner["ratioFlag"] == 2) {
							$text_ratioFlag = "อัตราส่วน";
						} else if ($data_owner["ratioFlag"] == 3) {
							$text_ratioFlag = "อัตราส่วนเป็นเงิน " . $data_owner["holdingAmount"];
						} else if ($data_owner["ratioFlag"] == 4) {
							$text_ratioFlag = "อัตราส่วนเป็นเปอร์เซ็นต์ " . $data_owner["holdingAmount"];
						} else if ($data_owner["ratioFlag"] == 5) {
							$text_ratioFlag = "ตามลำดับ";
						}
						$text_owner .=  $data_owner["personFullName"] . " " . $data_owner["concernName"] . " " . $text_ratioFlag . "<br>";

						$HOLDING_GROUP = "02";
						if ($data_owner["concernCode"] == 11) {
							$HOLDING_GROUP = "01";
						} else if ($data_owner["concernCode"] == 13) {
							$HOLDING_GROUP = "03";
						}

						unset($fieldsOwner);
						$fieldsOwner["ASSET_ID"] 		= $data["assetId"];
						$fieldsOwner["WH_ASSET_ID"] 	= $WH_ASSET_ID;
						$fieldsOwner["WH_CIVIL_ID"] 	= $WH_CIVIL_ID;
						$fieldsOwner["HOLDING_GROUP"] 	= $HOLDING_GROUP;
						$fieldsOwner["PERSON_NAME"] 	= $data_owner["personFullName"];
						$fieldsOwner["HOLDING_TYPE"] 	= $data_owner["ratioFlag"];
						// $fieldsOwner["HOLDING_TYPE"] 	= $text_ratioFlag;
						$fieldsOwner["HOLDING_AMOUNT"] 	= ($data_owner["ratioFlag"] == 1) ? '' : $data_owner["holdingAmount"];
						$fieldsOwner["CONCERNCODE"] 	= $data_owner["concernCode"];
						$fieldsOwner["CONCERNNAME"] 	= $data_owner["concernName"];
						$fieldsOwner["REGISTERID"] 		= $data_owner["registerId"];
						$fieldsOwner["PERSON_TYPE"]		= $data_owner["personType"];
						$fieldsOwner["PERSON_TYPE_NAME"] = $data_owner["personTypeName"];
						db::db_insert("WH_CIVIL_CASE_ASSET_OWNER", $fieldsOwner, 'WH_OWNER_ASSET_ID', 'WH_OWNER_ASSET_ID');
					}
				}
			}
		}

		if (count($dataReturn['Data']['assetLandMapHouse']) > 0) {
			db::db_delete("WH_LAND_MAP_HOUSE", array('PCC_CIVIL_GEN' => $pccCivilGen));

			foreach ($dataReturn['Data']['assetLandMapHouse'] as $key => $lmh) {
				unset($arrLmh);
				$arrLmh['CFC_MAP_HOUSE_GEN'] = $lmh['cfcMapHouseGen'];
				$arrLmh['CFC_HOUSE_GEN'] = $lmh['cfcHouseGen'];
				$arrLmh['CFC_LAND_GEN'] = $lmh['cfcLandGen'];
				$arrLmh['CENT_DEPT_GEN'] = $lmh['centDeptGen'];
				$arrLmh['PCC_CIVIL_GEN'] = $pccCivilGen;
				db::db_insert("WH_LAND_MAP_HOUSE", $arrLmh);
			}
		}

		if (count($dataReturn['Data']['assetBuilOutSide']) > 0) {
			db::db_delete("WH_CIVIL_CASE_ASSETS_BUIL_ASS", array('PCC_CIVIL_GEN' => $pccCivilGen));

			foreach ($dataReturn['Data']['assetBuilOutSide'] as $key => $lmh) {
				unset($arrLmh);
				$arrLmh['CFC_BUILDING_ASSET_GEN'] = $lmh['cfcBuildingAssetGen'];
				$arrLmh['CFC_BUILDING_GEN'] = $lmh['cfcBuildingGen'];
				$arrLmh['BUILDING_ASSET_TYPE'] = $lmh['buildingAssetType'];
				$arrLmh['BUILDING_ASSET_TYPE_NAME'] = $lmh['buildingAssetTypeName'];
				$arrLmh['BUILDING_AREA'] = $lmh['buildingArea'];
				$arrLmh['BUILDINDG_ASSET_AMOUNT'] = $lmh['buildindgAssetAmount'];
				$arrLmh['CENT_DEPT_GEN'] = $lmh['centDeptGen'];
				$arrLmh['CREATE_BY_USERID'] = $lmh['createByUserid'];
				$arrLmh['UPDATE_BY_USERID'] = $lmh['updateByUserid'];
				$arrLmh['UPDATE_DATE'] = $lmh['updateDate'];
				$arrLmh['CREATE_BY_PROGID'] = $lmh['createByProgid'];
				$arrLmh['UPDATE_BY_PROGID'] = $lmh['updateByProgid'];
				$arrLmh['VERSION'] = $lmh['version'];
				$arrLmh['DATA_ID'] = $lmh['dataId'];
				$arrLmh['USER_DEPT_CODE'] = $lmh['userDeptCode'];
				$arrLmh['DPD_STRUCTURE_GEN'] = $lmh['dpdStructureGen'];
				$arrLmh['BUILDING_PER_ASSET_AMOUNT'] = $lmh['buildingPerAssetAmount'];
				$arrLmh['UNIT_NUMBER'] = $lmh['unitNumber'];
				$arrLmh['UNIT_NAME'] = $lmh['unitName'];
				$arrLmh['BUILDING_ASSET_DESC'] = $lmh['buildingAssetDesc'];
				$arrLmh['BUILDING_ASSET_TYPE_OTHER'] = $lmh['buildingAssetTypeOther'];
				$arrLmh['PCC_CIVIL_GEN'] = $pccCivilGen;
				db::db_insert("WH_CIVIL_CASE_ASSETS_BUIL_ASS", $arrLmh);
			}
		}

		if (count($dataReturn['Data']['dossAsset']) > 0) {
			foreach ($dataReturn['Data']['dossAsset'] as $key => $data) {

				$sqlSelectDataDoss 		= "	select 		DOSS_ID
										from 		WH_CIVIL_DOSS
										where 		DOSS_CONTROL_GEN = '" . $data["pccDossControlGen"] . "' ";
				$querySelectDataDoss 	= db::query($sqlSelectDataDoss);
				$dataSelectDataDoss 	= db::fetch_array($querySelectDataDoss);
				//1 = จำนวน 2 = %หรือร้อยละ 3 = เต็มหมายบังคับคดี
				$ratetypeText = "";
				if ($data["ratetype"] == 1) {
					$ratetypeText = "";
				} else if ($data["ratetype"] == 2) {
					$ratetypeText = "%";
				} else if ($data["ratetype"] == 3) {
					$ratetypeText = "เต็มหมายบังคับคดี";
				}
				unset($fields);
				$fields["PROP_TITLE"] 		= $data["sequestertypename"];
				$fields["GERNISSHEE"] 		= $data["garnisshee"];
				$fields["OUTSIDER"] 		= $data["outsider"];
				$fields["AMOUNT_TYPE"] 		= $data["amount"] . $ratetypeText;
				$fields["WH_CIVIL_ID"] 		= $WH_CIVIL_ID;
				$fields["DOSS_ID"] 			= $dataSelectDataDoss["DOSS_ID"];
				$fields["DOSS_CONTROL_GEN"] = $data["pccDossControlGen"];
				$fields["ASSET_DATA_TYPE"] 	= 2;
				$WH_ASSET_ID = db::db_insert("WH_CIVIL_CASE_ASSETS", $fields, 'WH_ASSET_ID', 'WH_ASSET_ID');
			}
		}

		//Payment
		db::db_delete("WH_CIVIL_PAYMENT", array('WH_CIVIL_ID' => $WH_CIVIL_ID));
		if (count($dataReturn['Data']['payDesc']) > 0) {
			foreach ($dataReturn['Data']['payDesc'] as $key => $data_payDesc) {
				unset($fields);
				$fields["WH_CIVIL_ID"] 			= $WH_CIVIL_ID;
				$fields["PREFIX_BLACK_CASE"] 	= $data_main["prefixBlackCase"];
				$fields["BLACK_CASE"] 			= $data_main["blackCase"];
				$fields["BLACK_YY"] 			= $data_main["blackYy"];
				$fields["PREFIX_RED_CASE"] 		= $data_main["prefixRedCase"];
				$fields["RED_CASE"] 			= $data_main["redCase"];
				$fields["RED_YY"] 				= $data_main["redYy"];
				$fields["COURT_CODE"] 			= $data_main["courtCode"];
				$fields["CIVIL_CODE"] 			= $data_main["pccCivilGen"];

				$fields["PERSON_FULL_NAME"] 	= $data_payDesc["personFullName"];
				$fields["EXECUTION_STATUS"] 	= $data_payDesc["executionStatus"];
				$fields["CAPITAL_AMOUNT"] 		= $data_payDesc["capitalAmount"];
				$fields["ASSET_AMOUNT_REMAIN"] 	= $data_payDesc["assetAmountRemain"];
				$fields["CONCERN_NAME"] 		= $data_payDesc["concernName"];
				$fields["CONCERN_CODE"] 		= $data_payDesc["concernCode"];


				db::db_insert("WH_CIVIL_PAYMENT", $fields, 'WH_CIVIL_PAYMENT_ID', 'WH_CIVIL_PAYMENT_ID');
			}
		}

		// รายละเอียดคำสั่งศาล
		db::db_delete(
			"WH_COURT_LOG",
			array(
				'COURT_SYSTEM_TYPE' => '1',
				'BLACK_CASE' => $data_main["blackCase"],
				'BLACK_YY' => $data_main["blackYy"],
				'RED_CASE' => $data_main["redCase"],
				'RED_YY' => $data_main["redYy"]
			)
		);

		if (isset($data_main['courtOrderHis']) && count($data_main['courtOrderHis']) > 0) {
			foreach ($data_main['courtOrderHis'] as $key => $datacourtOrderHis) {
				unset($fields);
				$fields["COURT_CODE"]				= $data_main["courtCode"];
				$fields["COURT_NAME"]				= $data_main["courtName"];
				$fields["PREFIX_BLACK_CASE"]		= $data_main["prefixBlackCase"];
				$fields["BLACK_CASE"]				= $data_main["blackCase"];
				$fields["BLACK_YY"]					= $data_main["blackYy"];
				$fields["PREFIX_RED_CASE"]			= $data_main["prefixRedCase"];
				$fields["RED_CASE"]					= $data_main["redCase"];
				$fields["RED_YY"]					= $data_main["redYy"];
				$fields["COURT_SYSTEM_TYPE"]		= 1;
				$fields["COURT_DATE"]				= substr($datacourtOrderHis["orderDate"], 0, 10);
				$fields["COURT_DETAIL"]				= $datacourtOrderHis["orderDetail"];
				$fields["ORD_STATUS"] 				= $datacourtOrderHis["shrtDecideName"];
				$fields["CIVIL_TITLE_TYPE_NAME"]	= $datacourtOrderHis["sqtTitleTypeName"];
				$fields["CIVIL_CLASS_COURT_NAME"]	= $datacourtOrderHis["classCourtName"];
				$fields["CIVIL_ORDER_COURT_CODE"]	= $datacourtOrderHis["orderCourtCode"];
				$fields["CIVIL_ORDER_COURT_NAME"]	= $datacourtOrderHis["orderCourtName"];

				db::db_insert("WH_COURT_LOG", $fields, 'WH_COURT_LOG_ID', 'WH_COURT_LOG_ID');
			}
		}

		db::db_delete("WH_CIVIL_SEQUESTRATE", array('PCC_CIVIL_GEN' => $pccCivilGen));
		db::db_delete("WH_CIVIL_SEQUESTRATE_CLAIM", array('PCC_CIVIL_GEN' => $pccCivilGen));
		db::db_delete("WH_CIVIL_SEQUESTRATE_DOC", array('PCC_CIVIL_GEN' => $pccCivilGen));

		if (count($dataReturn['Data']['SQT3I010']) > 0) {
			foreach ($dataReturn['Data']['SQT3I010'] as $key => $dataAryut) {
				unset($fieldConner);
				$fieldAryut['PCC_CIVIL_GEN'] 			= $pccCivilGen;
				$fieldAryut['PCC_CASE_GEN'] 			= $dataAryut['pccCaseGen'];
				$fieldAryut['PCC_DOSS_CONTROL_GEN']		= $dataAryut['pccDossControlGen'];
				$fieldAryut['CENT_DEPT_GEN']			= $dataAryut['centDeptGen'];
				$fieldAryut['SQT_REQ_SEQUESTER_GEN']	= $dataAryut['sqtReqSequesterGen'];
				$fieldAryut['SQT_SEQUESTER_GEN']		= $dataAryut['sqtSequesterGen'];
				$fieldAryut['DEPT_NAME'] 				= $dataAryut['deptName'];
				$fieldAryut['DOCUMENT_NO'] 				= $dataAryut['documentNo'];
				$fieldAryut['DOCUMENT_YY'] 				= $dataAryut['documentYy'];
				$fieldAryut['DOCUMENT_DATE'] 			= substr($dataAryut['documentDate'], 0, 10);
				$fieldAryut['RECV_NO'] 					= $dataAryut['recvNo'];
				$fieldAryut['RECV_YEAR'] 				= $dataAryut['recvYear'];
				$fieldAryut['COURT_CODE'] 				= $dataAryut['courtCode'];
				$fieldAryut['COURT_NAME'] 				= $dataAryut['courtName'];
				$fieldAryut['PREFIX_BLACK_CASE']		= $dataAryut['prefixBlackCase'];
				$fieldAryut['BLACK_CASE']				= $dataAryut['blackCase'];
				$fieldAryut['BLACK_YY']					= $dataAryut['blackYy'];
				$fieldAryut['PREFIX_RED_CASE']			= $dataAryut['prefixRedCase'];
				$fieldAryut['RED_CASE']					= $dataAryut['redCase'];
				$fieldAryut['RED_YY']					= $dataAryut['redYy'];
				$fieldAryut['COURT_DATE'] 				= substr($dataAryut['courtDate'], 0, 10);
				$fieldAryut['CAPIITAL_AMOUNT']			= $dataAryut['capitalAmount'];
				$fieldAryut['ACC_CODE']					= $dataAryut['accCode'];
				$fieldAryut['JUDGEMENT_DATE'] 			= substr($dataAryut['judgementDate'], 0, 10);
				$fieldAryut['DOSS_NAME']				= $dataAryut['dossName'];
				$fieldAryut['DEBT_TYPE_CODE']			= $dataAryut['debtTypeCode'];
				$fieldAryut['DEBT_TYPE_NAME']			= $dataAryut['debtTypeName'];
				$fieldAryut['FILL_IN_METHOD']			= $dataAryut['fillInMethod'];
				$fieldAryut['FILL_IN_METHOD_NAME']		= $dataAryut['fillInMethodName'];
				$fieldAryut['PLAINTIFF1']				= $dataAryut['plaintiff1'];
				$fieldAryut['PLAINTIFF2']				= $dataAryut['plaintiff2'];
				$fieldAryut['PLAINTIFF3']				= $dataAryut['plaintiff3'];
				$fieldAryut['DEFFENDANT1']				= $dataAryut['defendant1'];
				$fieldAryut['DEFFENDANT2']				= $dataAryut['defendant2'];
				$fieldAryut['DEFFENDANT3']				= $dataAryut['defendant3'];
				$fieldAryut['PERSON_FULLNAME']			= $dataAryut['personFullName'];
				$fieldAryut['CONCERN_TYPE_NAME_ABOUT']	= $dataAryut['concernTypeNameAbout'];
				// $fieldAryut['CARD_TYPE']				= $dataAryut['cardType'];
				$fieldAryut['CARD_TYPE_NAME']			= $dataAryut['cardTypeName'];
				$fieldAryut['REGISTER_CODE']			= $dataAryut['registerCode'];
				$fieldAryut['RACE']						= $dataAryut['race'];
				$fieldAryut['NATIONALITY']				= $dataAryut['nationality'];
				$fieldAryut['OCCUPATION_NAME']			= $dataAryut['occupationName'];
				$fieldAryut['BIRTHDAY'] 				= ($dataAryut['birthYy']) ? ($dataAryut['birthYy'] - 543) . '-' . $dataAryut['birthMm'] . '-' . $dataAryut['birthDd'] : '';
				// $fieldAryut['SHR_PERSON_ADDR_GEN']		= $dataAryut['shrPersonAddrGen'];
				// $fieldAryut['SHR_PERSON_ADDR_NOW_GEN']	= $dataAryut['shrPersonAddrNowGen'];
				$fieldAryut['TEL_EXT']					= $dataAryut['telExt'];
				$fieldAryut['TEL_CONTACT']				= $dataAryut['telContact'];
				$fieldAryut['PAYMENT_AMOUNT']			= $dataAryut['paymentAmount'];
				$fieldAryut['ASSET_RETURN_DATE'] 		= substr($dataAryut['assetReturnDate'], 0, 10);
				$fieldAryut['OTH_DESC']					= $dataAryut['othDesc'];
				$fieldAryut['REMARK']					= $dataAryut['remark'];
				$fieldAryut['CAPITAL_DEBT']				= $dataAryut['capitalDebt'];
				$fieldAryut['APPROVE_DATE'] 			= substr($dataAryut['approveDate'], 0, 10);
				// $fieldAryut['CENT_PERSON_GEN']			= $dataAryut['centPersonGen'];
				// $fieldAryut['TRANCENT_PERSON_GEN']		= $dataAryut['tranCentPersonGen'];
				$fieldAryut['APPOINT_DATE'] 			= substr($dataAryut['appointDate'], 0, 10);
				$fieldAryut['PROCEED_DESC']				= $dataAryut['proceedDesc'];
				$fieldAryut['NAME_HOUSE_REG']			= $dataAryut['nameHouseReg'];
				$fieldAryut['ROOM_REG']					= $dataAryut['roomNoReg'];
				$fieldAryut['HOUSE_REG']				= $dataAryut['houseNoReg'];
				$fieldAryut['MOO_REG']					= $dataAryut['mooReg'];
				$fieldAryut['SOI_REG']					= $dataAryut['soiReg'];
				$fieldAryut['ROAD_REG']					= $dataAryut['mainStreetReg'];
				$fieldAryut['TUM_NAME_REG']				= $dataAryut['tumNameReg'];
				$fieldAryut['AMP_NAME_REG']				= $dataAryut['ampNameReg'];
				$fieldAryut['PRV_NAME_REG']				= $dataAryut['prvNameReg'];
				$fieldAryut['POSTCODE_REG']				= $dataAryut['postCodeReg'];
				$fieldAryut['NEAR_PLACE_REG']			= $dataAryut['nearPlaceReg'];
				$fieldAryut['NAME_HOUSE_CON']			= $dataAryut['nameHouseCon'];
				$fieldAryut['ROOM_CON']					= $dataAryut['roomNoCon'];
				$fieldAryut['HOUSE_CON']				= $dataAryut['houseNoCon'];
				$fieldAryut['MOO_CON']					= $dataAryut['mooCon'];
				$fieldAryut['SOI_CON']					= $dataAryut['soiCon'];
				$fieldAryut['ROAD_CON']					= $dataAryut['mainStreetCon'];
				$fieldAryut['TUM_NAME_CON']				= $dataAryut['tumNameCon'];
				$fieldAryut['AMP_NAME_CON']				= $dataAryut['ampNameCon'];
				$fieldAryut['PRV_NAME_CON']				= $dataAryut['prvNameCon'];
				$fieldAryut['POSTCODE_CON']				= $dataAryut['postCodeCon'];
				$fieldAryut['NEAR_PLACE_CON']			= $dataAryut['nearPlaceCon'];
				$fieldAryut['CENT_PERSON_NAME']			= $dataAryut['centPersonName'];
				$fieldAryut['TRANCENT_PERSON_NAME']		= $dataAryut['tranCentPersonName'];
				db::db_insert("WH_CIVIL_SEQUESTRATE", $fieldAryut);

				if (count($dataAryut['freezeClaim']) > 0) {
					foreach ($dataAryut['freezeClaim'] as $keyFreezeClaim => $freezeClaim) {
						unset($fieldFreezeClaim);
						$fieldFreezeClaim['PCC_CIVIL_GEN'] 					= $pccCivilGen;
						$fieldFreezeClaim['PCC_CASE_GEN'] 					= $dataAryut['pccCaseGen'];
						$fieldFreezeClaim['PCC_DOSS_CONTROL_GEN']			= $dataAryut['pccDossControlGen'];
						$fieldFreezeClaim['CENT_DEPT_GEN']					= $dataAryut['centDeptGen'];
						$fieldFreezeClaim['SQT_REQ_SEQUESTER_GEN']			= $dataAryut['sqtReqSequesterGen'];
						$fieldFreezeClaim['SQT_SEQUESTER_GEN']				= $dataAryut['sqtSequesterGen'];
						$fieldFreezeClaim['GARNISSHEE']						= $freezeClaim['garnisshee'];
						$fieldFreezeClaim['OUTSIDER']						= $freezeClaim['outsider'];
						$fieldFreezeClaim['SEQUESTER_TYPE_NAME']			= $freezeClaim['sequesterTypeName'];
						$fieldFreezeClaim['AMOUNT_BAHT']					= $freezeClaim['amountBaht'];
						$fieldFreezeClaim['BEFORE_AMOUNT']					= $freezeClaim['beforeAmount'];
						$fieldFreezeClaim['BEFORE_TERM']					= $freezeClaim['beforeTerm'];
						$fieldFreezeClaim['APPROVE_STATUS']					= $freezeClaim['approveStatus'];
						$fieldFreezeClaim['AMOUNT']							= $freezeClaim['amount'];
						$fieldFreezeClaim['TERM']							= $freezeClaim['term'];
						$fieldFreezeClaim['REASON']							= $freezeClaim['reason'];
						$fieldFreezeClaim['REQREASON']						= $freezeClaim['reqreason'];
						$fieldFreezeClaim['DESCRIPTION']					= $freezeClaim['description'];
						$fieldFreezeClaim['ADDRESS_NOW']					= $freezeClaim['addressNow'];
						$fieldFreezeClaim['RATE_TYPE']						= $freezeClaim['rateType'];
						$fieldFreezeClaim['REMARK']							= $freezeClaim['remark'];
						$fieldFreezeClaim['LAST_SHR_PERSON_CASE_GEN']		= $freezeClaim['lastShrPersonCaseGen'];
						$fieldFreezeClaim['LAST_SHR_PROPERTY_CASE_GEN']		= $freezeClaim['lastShrPropertyCaseGen'];
						$fieldFreezeClaim['GARNISSHEE_GEN']					= $freezeClaim['garnissheeGen'];
						$fieldFreezeClaim['OUTSIDER_GEN']					= $freezeClaim['outsiderGen'];
						$fieldFreezeClaim['REQ_GARNISSHEE_GEN']				= $freezeClaim['reqGarnissheeGen'];
						$fieldFreezeClaim['REQ_OUTSIDER_GARNISSHEE_GEN']	= $freezeClaim['reqOutsiderGarnissheeGen'];
						$fieldFreezeClaim['SEQUESTER_TYPE_CODE']			= $freezeClaim['sequesterTypeCode'];
						$fieldFreezeClaim['SQT_REQ_PROPERTY_GEN']			= $freezeClaim['sqtReqPropertyGen'];
						$fieldFreezeClaim['SQT_PROPERTY_GEN']				= $freezeClaim['sqtPropertyGen'];
						$fieldFreezeClaim['SQT_REQ_GRPTYPE_GEN']			= $freezeClaim['sqtReqGrptypeGen'];
						$fieldFreezeClaim['FEE_FLAG']						= $freezeClaim['feeFlag'];
						$fieldFreezeClaim['PAY_STATUS']						= $freezeClaim['payStatus'];
						$fieldFreezeClaim['PAYFLAG']						= $freezeClaim['payflag'];
						$fieldFreezeClaim['SALARY']							= $freezeClaim['salary'];
						$fieldFreezeClaim['SQT_GRPTYPE_GEN']				= $freezeClaim['sqtGrptypeGen'];
						$fieldFreezeClaim['REGISTER_CODE']					= $freezeClaim['registerCode'];
						$fieldFreezeClaim['OUTSIDER_REGISTER_CODE']			= $freezeClaim['outsiderRegisterCode'];
						db::db_insert("WH_CIVIL_SEQUESTRATE_CLAIM", $fieldFreezeClaim);
					}
				}

				if (count($dataAryut['documentAbout']) > 0) {
					foreach ($dataAryut['documentAbout'] as $keyDocumentAbout => $documentAbout) {
						unset($fieldDocumentAbout);
						$fieldDocumentAbout['PCC_CIVIL_GEN']			= $pccCivilGen;
						$fieldDocumentAbout['PCC_CASE_GEN']				= $dataAryut['pccCaseGen'];
						$fieldDocumentAbout['PCC_DOSS_CONTROL_GEN']		= $dataAryut['pccDossControlGen'];
						$fieldDocumentAbout['CENT_DEPT_GEN']			= $dataAryut['centDeptGen'];
						$fieldDocumentAbout['SQT_REQ_SEQUESTER_GEN']	= $dataAryut['sqtReqSequesterGen'];
						$fieldDocumentAbout['SQT_SEQUESTER_GEN']		= $dataAryut['sqtSequesterGen'];
						$fieldDocumentAbout['SUBJECT']					= $documentAbout['subject'];
						$fieldDocumentAbout['SENDWRIT_BOOK_NO']			= $documentAbout['sendwritBookNo'];
						$fieldDocumentAbout['REPORT_TYPE']				= $documentAbout['reportType'];
						$fieldDocumentAbout['REPORT_NAME']				= $documentAbout['reportName'];
						$fieldDocumentAbout['ATTENTION']				= $documentAbout['attention'];
						$fieldDocumentAbout['SEND_METHOD']				= $documentAbout['sendMethod'];
						$fieldDocumentAbout['PRINTED_DATE']				= $documentAbout['printedDate'];
						$fieldDocumentAbout['ADDRESS']					= $documentAbout['address'];
						$fieldDocumentAbout['SENDWRIT_GEN']				= $documentAbout['sendwritGen'];
						$fieldDocumentAbout['SHR_PERSON_MAP_GEN']		= $documentAbout['shrPersonMapGen'];
						$fieldDocumentAbout['REPORT_ID']				= $documentAbout['reportId'];
						$fieldDocumentAbout['CFC_REPORTS_GEN']			= $documentAbout['cfcReportsGen'];
						$fieldDocumentAbout['SQT_PERSON_GEN']			= $documentAbout['sqtPersonGen'];
						$fieldDocumentAbout['IS_SIGNED']				= $documentAbout['isSigned'];
						db::db_insert("WH_CIVIL_SEQUESTRATE_DOC", $fieldDocumentAbout);
					}
				}
			}
		}

		getCivilReciept($pccCivilGen, $show_data);
		getAccountIncomeExpensesCivilCase($data_main["pccCaseGen"], $show_data);
		getOrderCivilCase($data_main["pccCaseGen"], $show_data);
	}
	return $WH_CIVIL_ID;
}

/*  start ดึงเเพ่งเเบบเร็ว  */
function getCivilToWh_fast($pccCivilGen = "", $show_data = "")
{

	$curl = curl_init();



	curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://103.40.146.73/LedServiceCivilById.php/getCivil',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => '{
		"USERNAME":"BankruptDt",
		"PASSWORD":"Debtor4321",
		"pccCivilGen":"' . $pccCivilGen . '"
	}',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
		),
	));

	$response = curl_exec($curl);

	curl_close($curl);

	$dataReturn = json_decode($response, true);

	if ($show_data == 'Y') {
		print_pre($dataReturn);
	}


	$data_main = $dataReturn["Data"];


	$sqlSelectData = "	select 		WH_CIVIL_ID
						from 		WH_CIVIL_CASE
						where 		CIVIL_CODE = '" . $data_main["pccCivilGen"] . "' ";


	$querySelectData = db::query($sqlSelectData);
	$dataSelectData = db::fetch_array($querySelectData);

	//case

	unset($fields);
	$fields["CIVIL_CODE"] 			= $data_main["pccCivilGen"];
	$fields["COURT_CODE"] 			= $data_main["courtCode"];
	$fields["COURT_NAME"] 			= $data_main["courtName"];
	$fields["DEPT_CODE"] 			= $data_main["deptCode"];
	$fields["DEPT_NAME"] 			= $data_main["deptName"];
	$fields["CASE_TYPE_CODE"] 		= $data_main["caseTypeCode"];
	$fields["PREFIX_BLACK_CASE"] 	= $data_main["prefixBlackCase"];
	$fields["BLACK_CASE"] 			= $data_main["blackCase"];
	$fields["BLACK_YY"] 			= $data_main["blackYy"];
	$fields["PREFIX_RED_CASE"] 		= $data_main["prefixRedCase"];
	$fields["RED_CASE"] 			= $data_main["redCase"];
	$fields["RED_YY"] 				= $data_main["redYy"];
	$fields["COURT_DATE"] 			= substr($data_main["courtDate"], 0, 10);
	$fields["CAPITAL_AMOUNT"] 		= $data_main["capitalAmount"];
	$fields["PLAINTIFF1"] 			= $data_main["plaintiff1"];
	$fields["PLAINTIFF2"] 			= $data_main["plaintiff2"];
	$fields["PLAINTIFF3"] 			= $data_main["plaintiff3"];
	$fields["DEFFENDANT1"] 			= $data_main["defendant1"];
	$fields["DEFFENDANT2"] 			= $data_main["defendant2"];
	$fields["DEFFENDANT3"] 			= $data_main["defendant3"];
	$fields["CASE_TYPE_NAME"] 		= $data_main["caseTypeDesc"];
	$fields["PCC_CASE_GEN"] 		= $data_main["pccCaseGen"];
	$fields["REV_NO"] 				= $dataReturn['Data']['doss'][0]["recvNo"];
	$fields["REV_YEAR"] 			= $dataReturn['Data']['doss'][0]["recvYear"];

	if ($dataSelectData["WH_CIVIL_ID"] > 0) {
		db::db_update("WH_CIVIL_CASE", $fields, array('WH_CIVIL_ID' => $dataSelectData["WH_CIVIL_ID"]));
		$WH_CIVIL_ID = $dataSelectData["WH_CIVIL_ID"];
	} else {
		$WH_CIVIL_ID = db::db_insert("WH_CIVIL_CASE", $fields, 'WH_CIVIL_ID', 'WH_CIVIL_ID');
	}

	//doss

	db::db_delete("WH_CIVIL_DOSS", array('WH_CIVIL_ID' => $WH_CIVIL_ID));
	/* start */

	if (count($dataReturn['Data']['doss']) > 0) {
		foreach ($dataReturn['Data']['doss'] as $key => $data_doss) {
			unset($fields);
			$fields["ACCOUNT_NO"] 			= $data_doss["accCode"];
			$fields["DOSS_CONTROL"] 		= $data_doss["dossName"];
			$fields["DOSS_CONTROL_GEN"] 	= $data_doss["pccDossControlGen"];
			$fields["DOSS_CODE"] 			= $data_doss["dossCode"];
			$fields["DOSS_OWNER_ID"] 		= $data_doss["personCode"];
			$fields["DOSS_OWNER_NAME"] 		= $data_doss["dossOwnerName"];
			$fields["DOSS_REV_NO"] 			= $data_doss["recvNo"];
			$fields["DOSS_REV_YEAR"] 		= $data_doss["recvYear"];
			$fields["DOSS_DEPT_CODE"] 		= $data_doss["deptCode"];
			$fields["DOSS_DEPT_NAME"] 		= $data_doss["deptName"];
			$fields["WH_CIVIL_ID"] 			= $WH_CIVIL_ID;
			$fields["PCC_CASE_RECV_GEN"] 	= $data_doss["pccCaseRecvGen"];
			$DOSS_ID = db::db_insert("WH_CIVIL_DOSS", $fields, 'DOSS_ID', 'DOSS_ID');


			$curl = curl_init();

			curl_setopt_array($curl, array(
				CURLOPT_URL => 'http://103.40.146.73/LedServiceCivilById.php/getCivilRoute',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => '{
				"USERNAME":"BankruptDt",
				"PASSWORD":"Debtor4321",
				"pccDossControlGen":"' . $data_doss["pccDossControlGen"] . '"
			}',
				CURLOPT_HTTPHEADER => array(
					'Content-Type: application/json'
				),
			));

			$responseRoute = curl_exec($curl);

			curl_close($curl);

			$dataReturnRoute = json_decode($responseRoute, true);


			db::db_delete("WH_CIVIL_ROUTE", array('WH_CIVIL_ID' => $WH_CIVIL_ID, 'DOSS_CONTROL_GEN' => $data_doss["pccDossControlGen"]));
			/* มีปัญหา start */
			if (count($dataReturnRoute["Data"]) > 0) {
				foreach ($dataReturnRoute["Data"] as $key => $val) {
					unset($fields);
					$fields["ROUTE_GEN"] 		= 	$val["routeGen"];
					$fields["CREATE_DATE"] 		= 	substr($val["trDate"], 0, 10);
					$fields["CREATE_TIME"] 		= 	substr($val["trDate"], 11);
					$fields["ACT_DESC"] 		= 	$val["actDesc"];
					$fields["WH_CIVIL_ID"] 		= 	$WH_CIVIL_ID;
					$fields["DOSS_ID"] 			= 	$DOSS_ID;
					$fields["DOSS_CONTROL_GEN"] = 	$data_doss["pccDossControlGen"];
					db::db_insert("WH_CIVIL_ROUTE", $fields, 'WH_ROUTE_ID', 'WH_ROUTE_ID');
				}
			}
			/* มีปัญหา stop */
			$curlTransaction = curl_init();

			curl_setopt_array($curlTransaction, array(
				CURLOPT_URL => 'http://103.40.146.73/LedServiceCivilById.php/getCivilTransaction',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => '{
				"USERNAME":"BankruptDt",
				"PASSWORD":"Debtor4321",
				"pccCaseRecvGen":"' . $data_doss["pccCaseRecvGen"] . '"
			}',
				CURLOPT_HTTPHEADER => array(
					'Content-Type: application/json'
				),
			));

			$responseTransaction = curl_exec($curlTransaction);

			curl_close($curlTransaction);

			$dataReturnTransaction = json_decode($responseTransaction, true);

			//print_pre($dataReturnTransaction);

			db::db_delete("WH_CIVIL_TRANSACTION", array('WH_CIVIL_ID' => $WH_CIVIL_ID, 'PCC_CASE_RECV_GEN' => $data_doss["pccCaseRecvGen"]));
			if (count($dataReturnTransaction["Data"]) > 0) {
				foreach ($dataReturnTransaction["Data"] as $key => $valTransaction) {
					unset($fields);
					$fields["SETUP_DATE"] 		= 	substr($valTransaction["setupDate"], 0, 10);
					$fields["DOSS"] 			= 	$valTransaction["dossName"];
					$fields["SEND_DATE"] 		= 	substr($valTransaction["sendDate"], 0, 10);
					$fields["FROM_DEPT"] 		= 	$valTransaction["fromCentDeptName"];
					$fields["RECV_DOSS_DATE"] 	= 	substr($valTransaction["recvDate"], 0, 10);
					$fields["TO_DEPT"] 			= 	$valTransaction["toCentDeptName"];
					$fields["PROCESS_DESC"] 	= 	$valTransaction["processDesc"];
					$fields["REMARK"] 			= 	$valTransaction["remark"];
					$fields["WH_CIVIL_ID"] 		= 	$WH_CIVIL_ID;
					$fields["DOSS_ID"] 			= 	$DOSS_ID;
					$fields["DOSS_CONTROL_GEN"] = 	$data_doss["pccDossControlGen"];
					$fields["PCC_CASE_RECV_GEN"] = 	$data_doss["pccCaseRecvGen"];
					/* db::db_insert("WH_CIVIL_TRANSACTION", $fields, 'WH_ROUTE_ID', 'WH_ROUTE_ID'); */
				}
			}


			$curlEdoc = curl_init();

			curl_setopt_array($curlEdoc, array(
				CURLOPT_URL => 'http://103.40.146.73/LedServiceCivilById.php/getCivilEdocument',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => '{
				"USERNAME":"BankruptDt",
				"PASSWORD":"Debtor4321",
				"pccDossControlGen":"' . $data_doss["pccDossControlGen"] . '"
			}',
				CURLOPT_HTTPHEADER => array(
					'Content-Type: application/json'
				),
			));

			$responseEdoc = curl_exec($curlEdoc);

			curl_close($curlEdoc);

			$dataReturnEdoc = json_decode($responseEdoc, true);

			//print_pre($dataReturnEdoc);

			db::db_delete("WH_CIVIL_EDOC", array('WH_CIVIL_ID' => $WH_CIVIL_ID, 'PCC_CASE_RECV_GEN' => $data_doss["pccCaseRecvGen"]));
			if (count($dataReturnEdoc["Data"]) > 0) {
				foreach ($dataReturnEdoc["Data"] as $key => $valEdoc) {
					unset($fields);
					$fields["WH_CIVIL_ID"] 			= 	$WH_CIVIL_ID;
					$fields["DOSS_ID"] 				= 	$DOSS_ID;
					$fields["PCC_DOSS_CONTROL_GEN"]	= 	$data_doss["pccDossControlGen"];
					$fields["PCC_CASE_RECV_GEN"] 	= 	$data_doss["pccCaseRecvGen"];
					$fields["SHR_E_DOCUMENT_NAME"] 	= 	$valEdoc["shrEDocumentName"];
					$fields["SHR_E_DOCUMENT_URL"] 	= 	$valEdoc["shrEDocumentUrl"];
					$fields["PCC_CASE_GEN"] 		= 	$data_main["pccCaseGen"];
					$fields["CREATE_DATE"] 			= 	substr($valEdoc["createDate"], 0, 10);
					/* db::db_insert("WH_CIVIL_EDOC", $fields, 'WH_CIVIL_EDOC_ID', 'WH_CIVIL_EDOC_ID'); */
				}
			}
		}
	}
	/* stop */
	//person
	db::db_delete("WH_CIVIL_CASE_PERSON", array('WH_CIVIL_ID' => $WH_CIVIL_ID));
	db::db_delete("WH_CIVIL_PETITION", array('WH_CIVIL_ID' => $WH_CIVIL_ID));


	if (count($dataReturn['Data']['person']) > 0) {
		foreach ($dataReturn['Data']['person'] as $key => $data_person) {
			unset($fields);
			$fields["WH_CIVIL_ID"] 			= $WH_CIVIL_ID;
			$fields["PERSON_CODE"] 			= $data_person["personCode"];
			$fields["REGISTER_CODE"] 		= $data_person["registerId"];
			$fields["PREFIX_CODE"] 			= $data_person["titleCode"];

			$fields["PREFIX_NAME"] 			= (trim($data_person["fname"]) == "") ? null : $data_person["titleName"];
			$fields["FIRST_NAME"] 			= (trim($data_person["fname"]) == "") ? $data_person["personFullName"] : $data_person["fname"];
			$fields["LAST_NAME"] 			= $data_person["lname"];
			$fields["FULL_NAME"] 			= $data_person["personFullName"];

			$fields["PERSON_TYPE"] 			= (substr($data_person["registerId"], 0, 1) == '0') ? 2 : 1; //$data_person["personType"]
			$fields["SEX"] 					= $data_person["sex"];
			$fields["RACE"] 				= $data_person["race"];
			$fields["NATIONALITY"] 			= $data_person["nationality"];

			$fields["COURT_CODE"] 			= $data_main["courtCode"];
			$fields["COURT_NAME"] 			= $data_main["courtName"];
			$fields["DEPT_CODE"] 			= $data_main["deptCode"];
			$fields["DEPT_NAME"] 			= $data_main["deptName"];
			$fields["PREFIX_BLACK_CASE"] 	= $data_main["prefixBlackCase"];
			$fields["BLACK_CASE"] 			= $data_main["blackCase"];
			$fields["BLACK_YY"] 			= $data_main["blackYy"];
			$fields["PREFIX_RED_CASE"] 		= $data_main["prefixRedCase"];
			$fields["RED_CASE"] 			= $data_main["redCase"];
			$fields["RED_YY"] 				= $data_main["redYy"];

			$fields["ADDRESS"] 				= $data_person["houseNo"];
			$fields["TUM_CODE"] 			= $data_person["tumCode"];
			$fields["TUM_NAME"] 			= $data_person["tumName"];
			$fields["AMP_CODE"] 			= $data_person["ampCode"];
			$fields["AMP_NAME"] 			= $data_person["ampName"];
			$fields["PROV_CODE"] 			= $data_person["provCode"];
			$fields["PROV_NAME"] 			= $data_person["prvName"];
			$fields["ZIP_CODE"] 			= $data_person["postCode"];
			$fields["CONCERN_CODE"] 		= $data_person["concernCode"];
			$fields["CONCERN_NAME"] 		= $data_person["concernName"];
			$fields["CONCERN_NO"] 			= $data_person["concernNo"];
			$fields["MOO"] 					= $data_person["moo"];
			$fields["SOI"] 					= $data_person["soi"];
			$fields["PERSON_PCC_CASE_GEN"] 	= $data_person["pccCaseGen"];
			$fields["PER_ORDER_STATUS"] 	= $data_person["executionStatus"];
			db::db_insert("WH_CIVIL_CASE_PERSON", $fields, 'WH_PERSON_ID', 'WH_PERSON_ID');
			if (count($data_person["petition"]) > 0) {
				$CASE_CODE_TEXT = "ไม่ระบุ";
				if ($data_person["petition"]["caseCode"] == 1) {
					$CASE_CODE_TEXT = "แพ่ง";
				} else if ($data_person["petition"]["caseCode"] == 2) {
					$CASE_CODE_TEXT = "ล้มละลาย";
				} else if ($data_person["petition"]["caseCode"] == 3) {
					$CASE_CODE_TEXT = "วางทรัพย์";
				} else if ($data_person["petition"]["caseCode"] == 4) {
					$CASE_CODE_TEXT = "อาญา";
				} else if ($data_person["petition"]["caseCode"] == 5) {
					$CASE_CODE_TEXT = "บังคับทางปกครอง";
				}
				unset($fieldsPetition);
				$fieldsPetition["WH_CIVIL_ID"] 					= $WH_CIVIL_ID;
				$fieldsPetition["CASE_CODE_TEXT"] 				= $CASE_CODE_TEXT;
				$fieldsPetition["PREFIX_BLACK_CASE"] 			= $data_person["petition"]["prefixBlackCase"];
				$fieldsPetition["BLACK_CASE"] 					= $data_person["petition"]["blackCase"];
				$fieldsPetition["BLACK_YY"] 					= $data_person["petition"]["blackYy"];
				$fieldsPetition["PREFIX_RED_CASE"] 				= $data_person["petition"]["prefixRedCase"];
				$fieldsPetition["RED_CASE"] 					= $data_person["petition"]["redCase"];
				$fieldsPetition["RED_YY"] 						= $data_person["petition"]["redYy"];
				$fieldsPetition["COURTDATE"] 					= substr($data_person["petition"]["courtdate"], 0, 10);
				$fieldsPetition["PLAINTIFF"] 					= $data_person["petition"]["plaintiff"];
				$fieldsPetition["DEFENDANT"] 					= $data_person["petition"]["defendant"];
				$fieldsPetition["CAPITAL_AMT"] 					= $data_person["petition"]["capitalAmt"];
				$fieldsPetition["COURT_OBLIG_AMT"] 				= $data_person["petition"]["courtObligAmt"];
				$fieldsPetition["TAX_LAW_AMT"] 					= $data_person["petition"]["taxLawAmt"];
				$fieldsPetition["SOCIAL_SEC_LAW_AMT"] 			= $data_person["petition"]["socialSecLawAmt"];
				$fieldsPetition["LABOR_LAW_AMT"] 				= $data_person["petition"]["laborLawAmt"];
				$fieldsPetition["OTHER_LAW_NAME"] 				= $data_person["petition"]["otherLawName"];
				$fieldsPetition["OTHER_LAW_AMT"] 				= $data_person["petition"]["otherLawAmt"];
				$fieldsPetition["COURT_NAME"] 					= $data_person["petition"]["courtName"];
				$fieldsPetition["SOURCE_COURT_CODE"] 			= $data_main["courtCode"];
				$fieldsPetition["SOURCE_COURT_NAME"] 			= $data_main["courtName"];
				$fieldsPetition["SOURCE_PREFIX_BLACK_CASE"] 	= $data_main["prefixBlackCase"];
				$fieldsPetition["SOURCE_BLACK_CASE"] 			= $data_main["blackCase"];
				$fieldsPetition["SOURCE_BLACK_YY"] 				= $data_main["blackYy"];
				$fieldsPetition["SOURCE_PREFIX_RED_CASE"] 		= $data_main["prefixRedCase"];
				$fieldsPetition["SOURCE_RED_CASE"] 				= $data_main["redCase"];
				$fieldsPetition["SOURCE_RED_YY"] 				= $data_main["redYy"];
				$fieldsPetition["REGISTER_CODE"] 				= $data_person["registerId"];
				db::db_insert("WH_CIVIL_PETITION", $fieldsPetition, 'WH_CIVIL_PETITION_ID', 'WH_CIVIL_PETITION_ID');
			}
		}
	}


	//asset
	//db::query("DELETE FROM WH_CIVIL_CASE_ASSET_OWNER WHERE WH_CIVIL_ID in (SELECT WH_ASSET_ID FROM WH_CIVIL_CASE_ASSETS WHERE WH_CIVIL_ID = '".$WH_CIVIL_ID."' )");
	db::db_delete("WH_CIVIL_CASE_ASSET_OWNER", array('WH_CIVIL_ID' => $WH_CIVIL_ID));
	db::db_delete("WH_CIVIL_CASE_ASSETS", array('WH_CIVIL_ID' => $WH_CIVIL_ID));

	if (count($dataReturn['Data']['asset']) > 0) {
		foreach ($dataReturn['Data']['asset'] as $key => $data) {

			$sqlSelectDataDoss 		= "	select 		DOSS_ID
										from 		WH_CIVIL_DOSS
										where 		DOSS_CONTROL_GEN = '" . $data["pccDossControlGen"] . "' ";
			$querySelectDataDoss 	= db::query($sqlSelectDataDoss);
			$dataSelectDataDoss 	= db::fetch_array($querySelectDataDoss);

			unset($fields);
			$fields["ASSET_ID"] 		= $data["assetId"];
			$fields["TYPE_CODE"] 		= $data["typeCode"];

			if ($data["typeCode"] == '01') {
				$fields["TYPE_CODE_NAME"] = "ที่ดิน";
			} else if ($data["typeCode"] == '02') {
				$fields["TYPE_CODE_NAME"] = "สิ่งปลูกสร้าง";
			} else if ($data["typeCode"] == '03') {
				$fields["TYPE_CODE_NAME"] = "ห้องชุด";
			} else if ($data["typeCode"] == '04') {
				$fields["TYPE_CODE_NAME"] = "สิทธิการเช่าที่ดิน";
			} else if ($data["typeCode"] == '05') {
				$fields["TYPE_CODE_NAME"] = "สิทธิการเช่าห้องชุด";
			} else if ($data["typeCode"] == '14') {
				$fields["TYPE_CODE_NAME"] = "อาวุธปืน";
			} else if ($data["typeCode"] == '13') {
				$fields["TYPE_CODE_NAME"] = "เครื่องจักร";
			} else if ($data["typeCode"] == '11') {
				$fields["TYPE_CODE_NAME"] = "รถยนต์";
			} else if ($data["typeCode"] == '08') {
				$fields["TYPE_CODE_NAME"] = "หุ้น";
			} else if ($data["typeCode"] == '10') {
				$fields["TYPE_CODE_NAME"] = "สลากออมทรัพย์";
			} else if ($data["typeCode"] == '99') {
				$fields["TYPE_CODE_NAME"] = "บัญชีทรัพย์สินอื่นๆ";
			}

			$fields["PROP_TITLE"] 		= $data["propTitle"];
			$fields["PROP_STATUS"] 		= $data["propStatus"];
			$fields["PROP_STATUS_NAME"] = $data["propStatusName"];

			$fields["EST_VANG_SUB"] 	= $data["estVangSub"]; //ราคาประเมินเจ้าพนักงานประเมินราคาทรัพย์
			$fields["EST_GROUP_AMOUNT"] = $data["estGroupAmount"]; //ราคาประเมินคณะกรรมการกำหนดราคาทรัพย์
			$fields["EST_SUB_AMOUNT"] 	= $data["estSubAmount"]; //ราคากำหนดพิเศษ
			$fields["EST_DOL"] 			= $data["estDol"]; //ราคาประเมินกรมธนารักษ์
			$fields["EST_PRICE_AMOUNT"] = $data["estPriceAmount"]; //ราคาประเมินเจ้าพนักงานบังคับคดี
			$fields["SALE_PRICE"] 		= $data["salePrice"]; //ราคาขาย
			$fields["EST_SPECIALIST"] 	= $data["estSpecialist"]; //ราคาประเมินผู้เชี่ยวชาญราคาประเมิน
			$fields["EST_MORTGAGE"] 	= $data["estMortgage"]; //ราคาประเมินที่จำนำ/จำนองไว้
			$fields["EST_BANK"] 		= $data["estBank"]; //ราคาประเมินที่สถาบันการเงินแจ้งต่อธนาคารแห่งประเทศไทย

			$fields["COMMIT_TYPE"]		= $data["commitType"];
			$fields["DATE_SALE"] 		= substr($data["dateSale"], 0, 10);
			$fields["ADDRESS"] 			= $data["address"];
			//$fields["ASSET_DESC"] 		= $text_owner;
			$fields["WH_CIVIL_ID"] 		= $WH_CIVIL_ID;
			$fields["DOSS_ID"] 			= $dataSelectDataDoss["DOSS_ID"];
			$fields["DOSS_CONTROL_GEN"] = $data["pccDossControlGen"];
			$fields["CFC_CAPTION_GEN"]  = $data["cfcCaptionGen"];
			$fields["CAP_NO"]  			= $data["capNo"];
			$fields["SEQ_NO"]  			= $data["seqNo"];
			$fields["ASSET_DATA_TYPE"]  = 1;
			$WH_ASSET_ID = db::db_insert("WH_CIVIL_CASE_ASSETS", $fields, 'WH_ASSET_ID', 'WH_ASSET_ID');


			$text_owner = "";
			if (count($data["owner"]) > 0) {
				foreach ($data['owner'] as $key_owner => $data_owner) {

					$text_ratioFlag = "";
					if ($data_owner["ratioFlag"] == 1) {
						$text_ratioFlag = "เฉลี่ย";
					} else if ($data_owner["ratioFlag"] == 2) {
						$text_ratioFlag = "อัตราส่วน";
					} else if ($data_owner["ratioFlag"] == 3) {
						$text_ratioFlag = "อัตราส่วนเป็นเงิน " . $data_owner["holdingAmount"];
					} else if ($data_owner["ratioFlag"] == 4) {
						$text_ratioFlag = "อัตราส่วนเป็นเปอร์เซ็นต์ " . $data_owner["holdingAmount"];
					} else if ($data_owner["ratioFlag"] == 5) {
						$text_ratioFlag = "ตามลำดับ";
					}
					$text_owner .=  $data_owner["personFullName"] . " " . $data_owner["concernName"] . " " . $text_ratioFlag . "<br>";

					$HOLDING_GROUP = "02";
					if ($data_owner["concernCode"] == 11) {
						$HOLDING_GROUP = "01";
					} else if ($data_owner["concernCode"] == 13) {
						$HOLDING_GROUP = "03";
					}

					unset($fieldsOwner);
					$fieldsOwner["ASSET_ID"] 		= $data["assetId"];
					$fieldsOwner["WH_ASSET_ID"] 	= $WH_ASSET_ID;
					$fieldsOwner["WH_CIVIL_ID"] 	= $WH_CIVIL_ID;
					$fieldsOwner["HOLDING_GROUP"] 	= $HOLDING_GROUP;
					$fieldsOwner["PERSON_NAME"] 	= $data_owner["personFullName"];
					$fieldsOwner["HOLDING_TYPE"] 	= $text_ratioFlag;
					$fieldsOwner["HOLDING_TYPE"] 	= $text_ratioFlag;
					db::db_insert("WH_CIVIL_CASE_ASSET_OWNER", $fieldsOwner, 'WH_OWNER_ASSET_ID', 'WH_OWNER_ASSET_ID');
				}
			}
		}
	}

	if (count($dataReturn['Data']['dossAsset']) > 0) {
		foreach ($dataReturn['Data']['dossAsset'] as $key => $data) {

			$sqlSelectDataDoss 		= "	select 		DOSS_ID
										from 		WH_CIVIL_DOSS
										where 		DOSS_CONTROL_GEN = '" . $data["pccDossControlGen"] . "' ";
			$querySelectDataDoss 	= db::query($sqlSelectDataDoss);
			$dataSelectDataDoss 	= db::fetch_array($querySelectDataDoss);
			//1 = จำนวน 2 = %หรือร้อยละ 3 = เต็มหมายบังคับคดี
			$ratetypeText = "";
			if ($data["ratetype"] == 1) {
				$ratetypeText = "";
			} else if ($data["ratetype"] == 2) {
				$ratetypeText = "%";
			} else if ($data["ratetype"] == 3) {
				$ratetypeText = "เต็มหมายบังคับคดี";
			}
			unset($fields);
			$fields["PROP_TITLE"] 		= $data["sequestertypename"];
			$fields["GERNISSHEE"] 		= $data["garnisshee"];
			$fields["OUTSIDER"] 		= $data["outsider"];
			$fields["AMOUNT_TYPE"] 		= $data["amount"] . $ratetypeText;
			$fields["WH_CIVIL_ID"] 		= $WH_CIVIL_ID;
			$fields["DOSS_ID"] 			= $dataSelectDataDoss["DOSS_ID"];
			$fields["DOSS_CONTROL_GEN"] = $data["pccDossControlGen"];
			$fields["ASSET_DATA_TYPE"] 	= 2;
			$WH_ASSET_ID = db::db_insert("WH_CIVIL_CASE_ASSETS", $fields, 'WH_ASSET_ID', 'WH_ASSET_ID');
		}
	}

	//Payment
	db::db_delete("WH_CIVIL_PAYMENT", array('WH_CIVIL_ID' => $WH_CIVIL_ID));
	if (count($dataReturn['Data']['payDesc']) > 0) {
		foreach ($dataReturn['Data']['payDesc'] as $key => $data_payDesc) {
			unset($fields);
			$fields["WH_CIVIL_ID"] 			= $WH_CIVIL_ID;
			$fields["PREFIX_BLACK_CASE"] 	= $data_main["prefixBlackCase"];
			$fields["BLACK_CASE"] 			= $data_main["blackCase"];
			$fields["BLACK_YY"] 			= $data_main["blackYy"];
			$fields["PREFIX_RED_CASE"] 		= $data_main["prefixRedCase"];
			$fields["RED_CASE"] 			= $data_main["redCase"];
			$fields["RED_YY"] 				= $data_main["redYy"];
			$fields["COURT_CODE"] 			= $data_main["courtCode"];
			$fields["CIVIL_CODE"] 			= $data_main["pccCivilGen"];

			$fields["PERSON_FULL_NAME"] 	= $data_payDesc["personFullName"];
			$fields["EXECUTION_STATUS"] 	= $data_payDesc["executionStatus"];
			$fields["CAPITAL_AMOUNT"] 		= $data_payDesc["capitalAmount"];
			$fields["ASSET_AMOUNT_REMAIN"] 	= $data_payDesc["assetAmountRemain"];
			$fields["CONCERN_NAME"] 		= $data_payDesc["concernName"];
			$fields["CONCERN_CODE"] 		= $data_payDesc["concernCode"];


			db::db_insert("WH_CIVIL_PAYMENT", $fields, 'WH_CIVIL_PAYMENT_ID', 'WH_CIVIL_PAYMENT_ID');
		}
	}

	return $WH_CIVIL_ID;
}
/* Nop stop ดึงเเพ่งเเบบเร็ว */

function getBankruptToWh($brcId = "", $show_data = "")
{


	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://103.40.146.180/api/public/CheckCaseByID',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 300,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => '{
		"brcId":"' . $brcId . '"
	}',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
		),
	));

	$response = curl_exec($curl);

	curl_close($curl);

	$dataJson = json_decode($response, true);


	if ($show_data == 'Y') {
		print_pre($dataJson);
	}
	//exit();
	// echo "<pre>";
	// print_r($dataJson["data"]["Data"]);
	// echo "</pre>";

	$data_main = $dataJson["data"]["Data"][0];

	$sqlSelectData = "	select 		WH_BANKRUPT_ID
						from 		WH_BANKRUPT_CASE_DETAIL
						where 		BANKRUPT_CODE = '" . $data_main["bankruptCode"] . "' ";


	$querySelectData = db::query($sqlSelectData);
	$dataSelectData = db::fetch_array($querySelectData);

	//case
	unset($fields);
	$fields["BANKRUPT_CODE"] 		= $data_main["bankruptCode"];
	$fields["COURT_CODE"] 			= $data_main["courtCode"];
	$fields["COURT_NAME"] 			= $data_main["courtName"];
	$fields["DEPT_CODE"] 			= $data_main["deptCode"];
	$fields["DEPT_NAME"] 			= $data_main["deptName"];
	$fields["PREFIX_BLACK_CASE"] 	= $data_main["prefixBlackCase"];
	$fields["BLACK_CASE"] 			= $data_main["blackCase"];
	$fields["BLACK_YY"] 			= $data_main["blackYY"];
	$fields["PREFIX_RED_CASE"] 		= $data_main["prefixRedCase"];
	$fields["RED_CASE"] 			= $data_main["redCase"];
	$fields["RED_YY"] 				= $data_main["redYY"];
	$fields["COURT_DATE"] 			= substr($data_main["courtDate"], 0, 10);
	$fields["CAPITAL_AMOUNT"] 		= $data_main["capitalAmount"];
	$fields["DOSS_OWNER_ID"] 		= $data_main["onwerIdcard"];
	$fields["DOSS_OWNER_NAME"] 		= $data_main["onwerName"];
	$fields["PLAINTIFF1"] 			= $data_main["plaintiff"][0];
	$fields["PLAINTIFF2"] 			= $data_main["plaintiff"][1];
	$fields["PLAINTIFF3"] 			= $data_main["plaintiff"][2];
	$fields["DEFFENDANT1"] 			= $data_main["deffendant"][0];
	$fields["DEFFENDANT2"] 			= $data_main["defendant2"][1];
	$fields["DEFFENDANT3"] 			= $data_main["defendant3"][2];
	if ($dataSelectData["WH_BANKRUPT_ID"] > 0) {
		db::db_update("WH_BANKRUPT_CASE_DETAIL", $fields, array('WH_BANKRUPT_ID' => $dataSelectData["WH_BANKRUPT_ID"]));
		$WH_BANKRUPT_ID = $dataSelectData["WH_BANKRUPT_ID"];
	} else {
		$WH_BANKRUPT_ID = db::db_insert("WH_BANKRUPT_CASE_DETAIL", $fields, 'WH_BANKRUPT_ID', 'WH_BANKRUPT_ID');
	}

	db::db_delete("WH_COURT_LOG", array('COURT_SYSTEM_TYPE' => '2', 'BLACK_CASE' => $data_main["blackCase"], 'BLACK_YY' => $data_main["blackYY"], 'RED_CASE' => $data_main["redCase"], 'RED_YY' => $data_main["redYY"]));

	$ORD_STATUS = "";
	if (count($data_main['courtOrderHis']) > 0) {
		foreach ($data_main['courtOrderHis'] as $key => $datacourtOrderHis) {
			unset($fields);
			$fields["COURT_CODE"] 			= $data_main["courtCode"];
			$fields["COURT_NAME"] 			= $data_main["courtName"];
			$fields["PREFIX_BLACK_CASE"] 	= $data_main["prefixBlackCase"];
			$fields["BLACK_CASE"] 			= $data_main["blackCase"];
			$fields["BLACK_YY"] 			= $data_main["blackYY"];
			$fields["PREFIX_RED_CASE"] 		= $data_main["prefixRedCase"];
			$fields["RED_CASE"] 			= $data_main["redCase"];
			$fields["RED_YY"] 				= $data_main["redYY"];
			$fields["COURT_SYSTEM_TYPE"] 	= 2;
			$fields["COURT_DATE"] 			= substr($datacourtOrderHis["courtOrderDate"], 0, 10);
			$fields["COURT_DETAIL"] 		= $datacourtOrderHis["annName"];


			if ($datacourtOrderHis["annName"] == 'คำสั่งพิทักษ์ทรัพย์เด็ดขาด' || $datacourtOrderHis["annName"] == 'คำสั่งพิทักษ์ทรัพย์ชั่วคราว' || $datacourtOrderHis["annName"] == 'คำพิพากษาจัดการทรัพย์มรดก' || $datacourtOrderHis["annName"] == 'ยกเลิกประนอมหนี้ก่อนล้มและพิพากษาล้มละลาย' || $datacourtOrderHis["annName"] == 'ยกเลิกประนอมหนี้หลังล้มและพิพากษาล้มละลาย' || $datacourtOrderHis["annName"] == 'พิพากษาล้มละลาย' || $datacourtOrderHis["annName"] == 'พิทักษ์ทรัพย์เด็ดขาดและจัดการทรัพย์มรดก' || $datacourtOrderHis["annName"] == 'เห็นชอบการประนอมหนี้หลังล้มละลายและยกเลิกการล้มละลาย') {
				$fields["ORD_STATUS"] = 'บังคับคดี';
			} else {
				$fields["ORD_STATUS"] = 'ไม่บังคับคดี';
			}

			$ORD_STATUS = $fields["ORD_STATUS"];
			db::db_insert("WH_COURT_LOG", $fields, 'WH_COURT_LOG_ID', 'WH_COURT_LOG_ID');
		}
	}

	$getRegisterCode = "";
	//person
	db::db_delete("WH_BANKRUPT_CASE_PERSON", array('WH_BANKRUPT_ID' => $WH_BANKRUPT_ID));
	if (count($data_main['person']) > 0) {
		foreach ($data_main['person'] as $key => $data_person) {
			unset($fields);
			func_bankrupt::getBankruptPersonInCivilByIdCard_custom($data_person["registerCode"], $show_data);
			$fields["WH_BANKRUPT_ID"] 		= $WH_BANKRUPT_ID;
			$fields["PERSON_CODE"] 			= $data_person["personCode"];
			$fields["REGISTER_CODE"] 		= $data_person["registerCode"];
			$fields["PREFIX_CODE"] 			= $data_person["preFixName"];

			$fields["PREFIX_NAME"] 			= $data_person["preFixName"];
			$fields["FIRST_NAME"] 			= (trim($data_person["firstName"]) != "") ? $data_person["firstName"] : $data_person["fullName"];
			$fields["LAST_NAME"] 			= $data_person["lastName"];
			//$fields["FULL_NAME"] 			= $data_person["personFullName"];

			$fields["COURT_CODE"] 			= $data_main["courtCode"];
			$fields["COURT_NAME"] 			= $data_main["courtName"];
			$fields["DEPT_CODE"] 			= $data_main["deptCode"];
			$fields["DEPT_NAME"] 			= $data_main["deptName"];
			$fields["PREFIX_BLACK_CASE"] 	= $data_main["prefixBlackCase"];
			$fields["BLACK_CASE"] 			= $data_main["blackCase"];
			$fields["BLACK_YY"] 			= $data_main["blackYY"];
			$fields["PREFIX_RED_CASE"] 		= $data_main["prefixRedCase"];
			$fields["RED_CASE"] 			= $data_main["redCase"];
			$fields["RED_YY"] 				= $data_main["redYY"];

			$fields["ADDRESS"] 				= $data_person["houseNo"];
			$fields["TUM_CODE"] 			= $data_person["tumCode"];
			$fields["TUM_NAME"] 			= $data_person["tumName"];
			$fields["AMP_CODE"] 			= $data_person["ampCode"];
			$fields["AMP_NAME"] 			= $data_person["ampName"];
			$fields["PROV_CODE"] 			= $data_person["provCode"];
			$fields["PROV_NAME"] 			= $data_person["prvName"];
			$fields["ZIP_CODE"] 			= $data_person["postCode"];
			$fields["CONCERN_CODE"] 		= ($data_person["personType"] == '06') ? '02' : $data_person["personType"];
			$fields["CONCERN_NAME"] 		= ($data_person["personStatus"] == 'เจ้าหนี้') ? $data_person["personStatus"] : $data_person["conernName"];
			$fields["CONCERN_NO"] 			= $data_person["concernNo"];
			$fields["MOO"] 					= $data_person["moo"];
			$fields["SOI"] 					= $data_person["soi"];
			$fields["COMP_PAY_DEPT_DATE"] 	= substr($data_person["appDate"], 0, 10);

			if ($data_person["personType"] == '06') {
				if ($ORD_STATUS == 'บังคับคดี') {
					$fields["LOCK_PERSON_STATUS_TEXT"] = "บุคคลล้มละลาย";
					$fields["PER_ORDER_STATUS"] = "บังคับคดี";
				} else {
					$fields["LOCK_PERSON_STATUS_TEXT"] = "ไม่เป็นบุคคลล้มละลาย";
					$fields["PER_ORDER_STATUS"] = "ไม่บังคับคดี";
				}
				$getRegisterCode = $data_person["registerCode"];
			}
			db::db_insert("WH_BANKRUPT_CASE_PERSON", $fields, 'WH_PERSON_ID', 'WH_PERSON_ID');
		}
	}

	unset($fieldsCourtLog);
	$fieldsCourtLog["COURT_REGISTER_CODE"] 	= $getRegisterCode;
	db::db_update("WH_COURT_LOG", $fieldsCourtLog, array('COURT_SYSTEM_TYPE' => '2', 'BLACK_CASE' => $data_main["blackCase"], 'BLACK_YY' => $data_main["blackYY"], 'RED_CASE' => $data_main["redCase"], 'RED_YY' => $data_main["redYY"]));

	//person
	db::db_delete("WH_BANKRUPT_DOCKET", array('WH_BANKRUPT_ID' => $WH_BANKRUPT_ID));
	db::db_delete("WH_BANKRUPT_BALANCE_PERSON", array('WH_BANKRUPT_ID' => $WH_BANKRUPT_ID));
	if (count($data_main['docket']) > 0) {
		foreach ($data_main['docket'] as $key => $data_docket) {
			unset($fields);
			$fields["WH_BANKRUPT_ID"] 		= $WH_BANKRUPT_ID;
			$fields["DOCKET_TYPE"] 			= $data_docket["dytCode"];
			$fields["DOCKET_NAME"] 			= $data_docket["dytName"];
			$fields["DOCKET_SUBJECT"] 		= $data_docket["subject"];
			$fields["AMOUNT_OF_DEBT"] 		= $data_docket["dobValue"];
			$fields["AMOUNT_OF_DEBT_ALLOW"] = $data_docket["debtAmount"];
			$fields["DOCKET_OWNER"] 		= $data_docket["usrName"];
			db::db_insert("WH_BANKRUPT_DOCKET", $fields, 'DOCKET_ID', 'DOCKET_ID');


			unset($fields);
			$fields["WH_BANKRUPT_ID"] 		= $WH_BANKRUPT_ID;
			$fields["COURT_CODE"] 			= $data_main["courtCode"];
			$fields["PREFIX_BLACK_CASE"] 	= $data_main["prefixBlackCase"];
			$fields["BLACK_CASE"] 			= $data_main["blackCase"];
			$fields["BLACK_YY"] 			= $data_main["blackYY"];
			$fields["PREFIX_RED_CASE"] 		= $data_main["prefixRedCase"];
			$fields["RED_CASE"] 			= $data_main["redCase"];
			$fields["RED_YY"] 				= $data_main["redYY"];
			$fields["BALANCE_ALL"] 			= $data_docket["dobValue"];
			$fields["BALANCE_1"] 			= $data_docket["debtAmount"];
			$fields["REGISTER_CODE"] 		= $data_docket["perIdcard"];
			db::db_insert("WH_BANKRUPT_BALANCE_PERSON", $fields, 'WH_REH_BAL_ID', 'WH_REH_BAL_ID');
		}
	}


	db::db_delete("WH_BANKRUPT_DOC", array('BANKRUPT_CODE' => $data_main["bankruptCode"]));
	if (count($data_main["DocFile"]) > 0) {
		foreach ($data_main["DocFile"] as $key => $valFile) {
			unset($fields);
			$fields["BANKRUPT_CODE"] 		= $data_main["bankruptCode"];
			$fields["COURT_CODE"] 			= $data_main["courtCode"];
			$fields["COURT_NAME"] 			= $data_main["courtName"];
			$fields["DEPT_CODE"] 			= $data_main["deptCode"];
			$fields["DEPT_NAME"] 			= $data_main["deptName"];
			$fields["PREFIX_BLACK_CASE"] 	= $data_main["prefixBlackCase"];
			$fields["BLACK_CASE"] 			= $data_main["blackCase"];
			$fields["BLACK_YY"] 			= $data_main["blackYY"];
			$fields["PREFIX_RED_CASE"] 		= $data_main["prefixRedCase"];
			$fields["RED_CASE"] 			= $data_main["redCase"];
			$fields["RED_YY"] 				= $data_main["redYY"];
			$fields["DOC_DATE"] 			= substr($valFile["dofCreateDate"], 0, 10);
			$fields["DOC_REF_ID"] 			= $valFile["dofIdPk"];
			$fields["DOC_NAME"] 			= $valFile["dofFileName"];
			$fields["PLAINTIFF1"] 			= $data_main["plaintiff"][0];
			$fields["PLAINTIFF2"] 			= $data_main["plaintiff"][1];
			$fields["PLAINTIFF3"] 			= $data_main["plaintiff"][2];
			$fields["DEFFENDANT1"] 			= $data_main["deffendant"][0];
			$fields["DEFFENDANT2"] 			= $data_main["defendant2"][1];
			$fields["DEFFENDANT3"] 			= $data_main["defendant3"][2];
			$fields["RECORD_COUNT"] 		= count($data_main["DocFile"]);
			db::db_insert("WH_BANKRUPT_DOC", $fields, 'DOC_ID', 'DOC_ID');
		}
	}
}

class func_bankrupt
{
	public static function getBankruptPersonInCivilByIdCard_custom($idCard, $SHOW = "") //function การดึงคำสั่งศาลของ 13หลัก ของคนๆนั้น
	{
		$url = "http://103.40.146.73/LedServiceCivilById.php/getBankruptPersonInCivilByIdCard";
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
			CURLOPT_POSTFIELDS => '{
            "USERNAME":"BankruptDt",
            "PASSWORD":"Debtor4321",
            "idCard":"' . $idCard . '",
            "showQry":"N"
        }',
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json'
			),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		$dataReturn = json_decode($response, true);

		$fileName = "../attach/getBankruptPersonInCivil/byIdCard.txt";
		if ($dataReturn['ResponseCode']['ResCode'] == '000' && count($dataReturn['Data']['data']) > 0) {

			$attach_folder = "../attach/getBankruptPersonInCivil";
			if (is_dir($attach_folder) == false) {
				mkdir($attach_folder, 0777);
			}
			unlink($fileName);
			$filename = fopen($fileName, "w");

			if ($dataReturn['Data']['data']) {
				foreach ($dataReturn['Data']['data'] as $key => $val) {
					unset($temp);
					$temp = str_replace("\n",  "", implode('|', $val));
					fwrite($filename,  $temp . PHP_EOL);
				}
			}
		}
		$file = fopen($fileName, 'r');

		if ($file) {
			$lineNumber = 1;

			while (!feof($file)) {
				$line = fgets($file);

				unset($field);
				$val = explode('|', $line);

				if (count($val) > 1) {

					db::db_delete('WH_BANKRUPT_EXECUTION', array('WH_EXECUTION_ID' => conText($val[168])));

					$field['WH_EXECUTION_ID'] = conText($val[168]);
					// ชื่อศาล
					$field['COURT_NAME'] = conText(trim($val[88]));
					// เลขคดีดำ
					$field['BLACK_CASE'] = conText(trim($val[57]));
					// ปีคดีดำ
					$field['BLACK_YY'] = conText(trim($val[58]));
					// เลขคดีเเดง
					$field['RED_CASE'] = conText(trim($val[128]));
					// ปีคดีเเดง
					$field['RED_YY'] = conText(trim($val[129]));
					// 13 หลักของจำเลย
					$field['DEFFENDANT_IDCARD'] = conText(trim($val[107]));
					// ชื่อจำเลย
					$field['DEFFENDANT_NAME'] = conText(trim($val[114] . ' ' . $val[116]));
					// วันประกาศราชกิจจาฯ
					$field['ANNOUNCEMENT_DATE_A'] = (checkdate($val[161], $val[160], $val[164])) ? date('Y-m-d', strtotime($val[164] . '-' . $val[161]) . '-' . $val[160]) : '';
					// วันประกาศราชกิจจาฯ
					$field['ANNOUNCEMENT_DATE_B'] = (checkdate($val[153], $val[152], $val[156])) ? date('Y-m-d', strtotime($val[156] . '-' . $val[153]) . '-' . $val[152]) : '';
					// วันประกาศราชกิจจาฯ
					$field['ANNOUNCEMENT_DATE_C'] = (checkdate($val[14], $val[13], $val[17])) ? date('Y-m-d', strtotime($val[17] . '-' . $val[14]) . '-' . $val[13]) : '';
					// วันประกาศราชกิจจาฯ
					$field['ANNOUNCEMENT_DATE_E'] =  (checkdate($val[6], $val[5], $val[9])) ? date('Y-m-d', strtotime($val[9] . '-' . $val[6]) . '-' . $val[5]) : '';
					// วันประกาศราชกิจจาฯ
					$field['ANNOUNCEMENT_DATE_F'] = (checkdate($val[79], $val[78], $val[82])) ? date('Y-m-d', strtotime($val[82] . '-' . $val[79]) . '-' . $val[78]) : '';
					// วันประกาศราชกิจจาฯ
					$field['ANNOUNCEMENT_DATE_G'] = (checkdate($val[61], $val[60], $val[64])) ? date('Y-m-d', strtotime($val[64] . '-' . $val[61]) . '-' . $val[60]) : '';
					// วันประกาศราชกิจจาฯ
					$field['ANNOUNCEMENT_DATE_I'] = (checkdate($val[50], $val[49], $val[53])) ? date('Y-m-d', strtotime($val[53] . '-' . $val[50]) . '-' . $val[49]) : '';
					// วันประกาศราชกิจจาฯ
					$field['ANNOUNCEMENT_DATE_J'] = (checkdate($val[44], $val[43], $val[47])) ? date('Y-m-d', strtotime($val[47] . '-' . $val[44]) . '-' . $val[43]) : '';
					// วันประกาศราชกิจจาฯ
					$field['ANNOUNCEMENT_DATE_K'] = (checkdate($val[26], $val[25], $val[29])) ? date('Y-m-d', strtotime($val[29] . '-' . $val[26]) . '-' . $val[25]) : '';
					// วันประกาศราชกิจจาฯ
					$field['ANNOUNCEMENT_DATE_M'] = (checkdate($val[96], $val[95], $val[99])) ? date('Y-m-d', strtotime($val[99] . '-' . $val[96]) . '-' . $val[95]) : '';
					// วันประกาศราชกิจจาฯ
					$field['ANNOUNCEMENT_DATE_N'] =  (checkdate($val[142], $val[141], $val[145])) ? date('Y-m-d', strtotime($val[145] . '-' . $val[142]) . '-' . $val[141]) : '';
					// วันที่พิทักษ์ทรัพย์ชั่วคราว
					$field['DATE_TEMPORARY_A'] = (checkdate($val[166], $val[165], $val[167])) ? date('Y-m-d', strtotime($val[167] . '-' . $val[166]) . '-' . $val[165]) : '';
					// วันถอนพิทักษ์ทรัพย์ชั่วคราว
					$field['WITHDRAWAL_DATE_B'] = (checkdate($val[157], $val[150], $val[158])) ? date('Y-m-d', strtotime($val[158] . '-' . $val[157]) . '-' . $val[150]) : '';
					// วันที่พิทักษ์ทรัพย์เด็ดขาด
					$field['ABSOLUT_RECEIVERSHIP_C'] = (checkdate($val[19], $val[18], $val[20])) ? date('Y-m-d', strtotime($val[20] . '-' . $val[19]) . '-' . $val[18]) : '';
					// วันถอนพิทักษ์ทรัพย์เด็ดขาด
					$field['ABSOLUTE_WITHDRAWAL_E'] = (checkdate($val[10], $val[3], $val[11])) ? date('Y-m-d', strtotime($val[11] . '-' . $val[10]) . '-' . $val[3]) : '';
					// วันที่ครบกำหนดยื่นคำขอรับชำระหนี้
					$field['PAYMENT_DUE_DATE_D'] = (checkdate($val[1], $val[0], $val[2])) ? date('Y-m-d', strtotime($val[2] . '-' . $val[1]) . '-' . $val[0]) : '';
					// นัดตรวจคำขอรับชำระหนี้
					$field['APPOINTMENT_DATE_D'] = (checkdate($val[22], $val[21], $val[23])) ? date('Y-m-d', strtotime($val[23] . '-' . $val[22]) . '-' . $val[21]) : '';
					// วันประนอมหนี้ก่อนล้มละลาย
					$field['DEBT_RECONCILIATION_F'] = (checkdate($val[69], $val[68], $val[70])) ? date('Y-m-d', strtotime($val[70] . '-' . $val[69]) . '-' . $val[68]) : '';
					// วันยกเลิกประนอมหนี้ก่อนล้มฯและพิพากษาให้ล้มฯ
					$field['CANCEL_DEBT_G'] = (checkdate($val[66], $val[65], $val[67])) ? date('Y-m-d', strtotime($val[67] . '-' . $val[66]) . '-' . $val[65]) : '';
					// วันประนอมหนี้หลังล้มละลาย
					$field['AFTER_BANKRUPTCY_J'] = (checkdate($val[34], $val[33], $val[35])) ? date('Y-m-d', strtotime($val[35] . '-' . $val[34]) . '-' . $val[33]) : '';
					// วันยกเลิกประนอมหนี้หลังล้มฯและพิพากษาให้ล้มฯ
					$field['CANCEL_DEBT_BACK_K'] = (checkdate($val[31], $val[30], $val[32])) ? date('Y-m-d', strtotime($val[32] . '-' . $val[31]) . '-' . $val[30]) : '';
					// วันพิพากษาให้ล้มละลาย
					$field['BANKRUPTCY_JUDGMENT_I'] = (checkdate($val[55], $val[54], $val[56])) ? date('Y-m-d', strtotime($val[56] . '-' . $val[55]) . '-' . $val[54]) : '';
					// วันยกเลิกการล้มละลาย
					$field['CANCEL_BANKRUPT_M'] = (checkdate($val[92], $val[91], $val[93])) ? date('Y-m-d', strtotime($val[93] . '-' . $val[92]) . '-' . $val[91]) : '';
					// วันปลดการล้มละลาย
					$field['BANKRUPT_DISCHARGE_N'] = (checkdate($val[138], $val[137], $val[139])) ? date('Y-m-d', strtotime($val[139] . '-' . $val[138]) . '-' . $val[137]) : '';
					// วันที่ศาลสั่งให้จัดการทรัพย์ย์มรดก
					$field['HERITAGE_O'] = (checkdate($val[112], $val[108], $val[113])) ? date('Y-m-d', strtotime($val[113] . '-' . $val[112]) . '-' . $val[108]) : '';
					// วันยกเลิกจัดการทรัพย์มรดก
					$field['CANCEL_HERITANCE_O'] = (checkdate($val[110], $val[109], $val[111])) ? date('Y-m-d', strtotime($val[111] . '-' . $val[110]) . '-' . $val[109]) : '';
					// วันจำหน่ายคดี
					$field['SELLING_CASE_Q'] = (checkdate($val[148], $val[147], $val[149])) ? date('Y-m-d', strtotime($val[149] . '-' . $val[148]) . '-' . $val[147]) : '';
					// วันพิจารณาคดีใหม่
					$field['RECONSIDER_P'] = (checkdate($val[135], $val[134], $val[136])) ? date('Y-m-d', strtotime($val[136] . '-' . $val[135]) . '-' . $val[134]) : '';
					// วันปิดคดี
					$field['CASE_CLOSING_DATE_Q'] = (checkdate($val[85], $val[84], $val[86])) ? date('Y-m-d', strtotime($val[86] . '-' . $val[85]) . '-' . $val[84]) : '';
					// วันที่ยกฟ้อง
					$field['DATE_OF_DISMISSAL_P'] = (checkdate($val[170], $val[169], $val[171])) ? date('Y-m-d', strtotime($val[171] . '-' . $val[170]) . '-' . $val[169]) : '';
					// เรื่องที่
					$field['SUBJECT'] = conText($val[130]);
					// IDศาล -> ประเภทศาล
					$field['COURT_CODE'] = conText($val[89]);
					// วันที่ครบกำหนดยื่นคำขอรับชำระหนี้ => ลูกหนี้พ้นจากการเป็นบุคคลล้มละลาย
					$field['SUBMIT_DEBT_PAYMENT_H'] = (checkdate($val[105], $val[104], $val[106])) ? date('Y-m-d', strtotime($val[106] . '-' . $val[105]) . '-' . $val[104]) : '';
					// วันที่ครบกำหนดยื่นคำขอรับชำระหนี้
					$field['PAYMENT_DUE_L'] = (checkdate($val[37], $val[36], $val[38])) ? date('Y-m-d', strtotime($val[38] . '-' . $val[37]) . '-' . $val[36]) : '';
					// นัดตรวจคำขอรับชำระหนี้
					$field['APPOINTMENT_DATE_H'] = (checkdate($val[132], $val[131], $val[133])) ? date('Y-m-d', strtotime($val[133] . '-' . $val[132]) . '-' . $val[131]) : '';
					// นัดตรวจคำขอรับชำระหนี้
					$field['APPOINTMENT_DATE_L'] = (checkdate($val[121], $val[120], $val[122])) ? date('Y-m-d', strtotime($val[122] . '-' . $val[121]) . '-' . $val[120]) : '';

					db::db_insert('WH_BANKRUPT_EXECUTION', $field);
				}
			}
			fclose($file);
		}
		if ($SHOW == 'Y') {
			echo "<pre>";
			print_r($dataReturn);
			echo "</pre>";
		}
	}
}

function sendCmdToBackoffice($dataSet)
{

	$sqlSelectPerson = "SELECT REGISTER_CODE FROM WH_BACKOFFICE_PERSON WHERE (LINE_NAME LIKE '%ผู้อำนวยการ%' ) AND (ORG_NAME LIKE '%กองบริหารการคลัง%' OR ORG_NAME LIKE '%กองบริหารทรัพยากรบุคคล%') AND PER_STATUS_CIVIL = 'ปกติ' ";
	$querySelectPerson = db::query($sqlSelectPerson);
	while ($dataSelectPerson = db::fetch_array($querySelectPerson)) {

		$cmdDetail = explode(' พบซ้ำในคดี  ', $dataSet["mDOcCmdDetail"]["CMD_NOTE"]);

		$dataSet["mDOcCmd"]["TO_PERSON_ID"] 		= $dataSelectPerson["REGISTER_CODE"];
		$dataSet["mDOcCmd"]["CMD_NOTE"] 			= $cmdDetail[0];
		$dataSet["mDOcCmd"]["SEND_TO"] 				= '5';
		$dataSet["mDOcCmd"]["TO_T_BLACK_CASE"] 		= '';
		$dataSet["mDOcCmd"]["TO_BLACK_CASE"] 		= '';
		$dataSet["mDOcCmd"]["TO_BLACK_YY"] 			= '';
		$dataSet["mDOcCmd"]["TO_T_RED_CASE"] 		= '';
		$dataSet["mDOcCmd"]["TO_RED_CASE"] 			= '';
		$dataSet["mDOcCmd"]["TO_RED_YY"] 			= '';
		$dataSet["mDOcCmd"]["TO_COURT_CODE"] 		= '';
		$dataSet["mDOcCmd"]["TO_COURT_NAME"] 		= '';
		$CMD_ID = db::db_insert("M_DOC_CMD", $dataSet["mDOcCmd"], 'ID', 'ID');

		$dataSet["mDOcCmdDetail"]["CMD_ID"] 		= $CMD_ID;
		$dataSet["mDOcCmdDetail"]["CMD_NOTE"] 		= $cmdDetail[0];
		db::db_insert("M_CMD_DETAILS", $dataSet["mDOcCmdDetail"], 'CMD_DETAIL_ID', 'CMD_DETAIL_ID');

		$dataSet["mDOcCmdPerson"]["CMD_ID"] 		= $CMD_ID;
		db::db_insert("M_CMD_PERSON", $dataSet["mDOcCmdPerson"], 'PERSON_ID', 'PERSON_ID');
	}
}

function sendCmdToBankruptDueDate($dataSet)
{

	$fullBlackCase 	= $dataSet["mDOcCmd"]["TO_T_BLACK_CASE"] . $dataSet["mDOcCmd"]["TO_BLACK_CASE"] . "/" . $dataSet["mDOcCmd"]["TO_BLACK_YY"];
	$fullRedCase 	= $dataSet["mDOcCmd"]["TO_T_RED_CASE"] . $dataSet["mDOcCmd"]["TO_RED_CASE"] . "/" . $dataSet["mDOcCmd"]["TO_RED_YY"];

	$sqlSelectDate   = "	SELECT 	COMP_PAY_DEPT_DATE
							FROM 	VIEW_PERSON_PAY_DUE 
							where 	REGISTER_CODE = '" . $dataSet["mDOcCmdPerson"]["ID_CARD"] . "' 
									and PREFIX_BLACK_CASE = '" . $dataSet["mDOcCmd"]["TO_T_BLACK_CASE"] . "' 
									and BLACK_CASE = '" . $dataSet["mDOcCmd"]["TO_BLACK_CASE"] . "' 
									and BLACK_YY = '" . $dataSet["mDOcCmd"]["TO_BLACK_YY"] . "' 
									and PREFIX_RED_CASE = '" . $dataSet["mDOcCmd"]["TO_T_RED_CASE"] . "' 
									and RED_CASE = '" . $dataSet["mDOcCmd"]["TO_RED_CASE"] . "'
									and RED_YY = '" . $dataSet["mDOcCmd"]["TO_RED_YY"] . "' ";
	$querySelectDate = db::query($sqlSelectDate);
	$recSelectDate   = db::fetch_array($querySelectDate);

	$cmdDetail = 'แจ้งเตือนครบกำหนดยื่นคำขอรับชำระหนี้ หมายเลขดำที่ ' . $fullBlackCase . ' คดีหมายเลขแดงที่ ' . $fullRedCase . ' ครบกำหนดยื่นคำขอรับชำระหนี้วันที่ ' . db2date($recSelectDate["COMP_PAY_DEPT_DATE"]);

	$sqlSelectDossOwner = "	select 	DOSS_OWNER_ID 
							from 	WH_BANKRUPT_CASE_DETAIL 
							where 	1=1
									AND PREFIX_BLACK_CASE = '" . $dataSet["mDOcCmd"]["T_BLACK_CASE"] . "'
									AND BLACK_CASE = '" . $dataSet["mDOcCmd"]["BLACK_CASE"] . "'
									AND BLACK_YY = '" . $dataSet["mDOcCmd"]["BLACK_YY"] . "'
									AND PREFIX_RED_CASE = '" . $dataSet["mDOcCmd"]["T_RED_CASE"] . "'
									AND RED_CASE = '" . $dataSet["mDOcCmd"]["RED_CASE"] . "'
									AND RED_YY = '" . $dataSet["mDOcCmd"]["RED_YY"] . "'";
	$querySelectDossOwner = db::query($sqlSelectDossOwner);
	$recSelectDossOwner 	= db::fetch_array($querySelectDossOwner);

	$dataSet["mDOcCmd"]["TO_PERSON_ID"] 		= $recSelectDossOwner["DOSS_OWNER_ID"];
	$dataSet["mDOcCmd"]["CMD_NOTE"] 			= $cmdDetail;
	$dataSet["mDOcCmd"]["SEND_TO"] 				= '2';

	$dataSet["mDOcCmd"]["TO_T_BLACK_CASE"] 		= $dataSet["mDOcCmd"]["T_BLACK_CASE"];
	$dataSet["mDOcCmd"]["TO_BLACK_CASE"] 		= $dataSet["mDOcCmd"]["BLACK_CASE"];
	$dataSet["mDOcCmd"]["TO_BLACK_YY"] 			= $dataSet["mDOcCmd"]["BLACK_YY"];
	$dataSet["mDOcCmd"]["TO_T_RED_CASE"] 		= $dataSet["mDOcCmd"]["T_RED_CASE"];
	$dataSet["mDOcCmd"]["TO_RED_CASE"] 			= $dataSet["mDOcCmd"]["RED_CASE"];
	$dataSet["mDOcCmd"]["TO_RED_YY"] 			= $dataSet["mDOcCmd"]["RED_YY"];

	$CMD_ID = db::db_insert("M_DOC_CMD", $dataSet["mDOcCmd"], 'ID', 'ID');

	$dataSet["mDOcCmdDetail"]["CMD_ID"] 		= $CMD_ID;
	$dataSet["mDOcCmdDetail"]["CMD_NOTE"] 		= $cmdDetail;
	db::db_insert("M_CMD_DETAILS", $dataSet["mDOcCmdDetail"], 'CMD_DETAIL_ID', 'CMD_DETAIL_ID');

	$dataSet["mDOcCmdPerson"]["CMD_ID"] 		= $CMD_ID;
	db::db_insert("M_CMD_PERSON", $dataSet["mDOcCmdPerson"], 'PERSON_ID', 'PERSON_ID');
}

function getReviveToWh($dataSet = array(), $show_data = "")
{

	$curl = curl_init();

	$dataRequest = array();
	if ($dataSet["WFR"] != "") {
		$dataRequest["WFR"] = $dataSet["WFR"];
	}
	if ($dataSet["prefixBlackCase"] != "") {
		$dataRequest["prefixBlackCase"] = $dataSet["prefixBlackCase"];
	}
	if ($dataSet["blackCase"] != "") {
		$dataRequest["blackCase"] = $dataSet["blackCase"];
	}
	if ($dataSet["blackYy"] != "") {
		$dataRequest["blackYy"] = $dataSet["blackYy"];
	}
	if ($dataSet["prefixRedCase"] != "") {
		$dataRequest["prefixRedCase"] = $dataSet["prefixRedCase"];
	}
	if ($dataSet["redCase"] != "") {
		$dataRequest["redCase"] = $dataSet["redCase"];
	}
	if ($dataSet["redYy"] != "") {
		$dataRequest["redYy"] = $dataSet["redYy"];
	}

	$dataString = json_encode($dataRequest);

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://103.208.27.224/led_revive/save/getDataToLedService.php',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 300,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => $dataString,
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
		),
	));

	$response = curl_exec($curl);

	curl_close($curl);

	$dataJson = json_decode($response, true);


	// echo "<pre>";print_r($dataJson);
	// exit();
	/* echo "<pre>";
	print_r($dataString);
	echo "</pre>"; */
	if ($show_data == "Y") {
		echo "<pre>";
		print_r($dataJson);
		echo "</pre>";
	}
	$data_main = $dataJson["Data"]["REVIVE_MAIN_REHAB"][0];

	if ($data_main["WFR_ID"] != "") {
		$sqlSelectData = "	select 		WH_REHAB_ID
						from 		WH_REHABILITATION_CASE_DETAIL
						where 		REHAB_CODE = " . $data_main["WFR_ID"] . " ";
		$querySelectData = db::query($sqlSelectData);
		$dataSelectData = db::fetch_array($querySelectData);

		//case
		unset($fields);
		$fields["REHAB_CODE"] 			= $data_main["WFR_ID"];
		$fields["COURT_CODE"] 			= $data_main["COURT_CODE"];
		$fields["COURT_NAME"] 			= $data_main["COURT_NAME"];
		$fields["DEPT_CODE"] 			= $data_main["deptCode"];
		$fields["DEPT_NAME"] 			= $data_main["deptName"];
		$fields["PREFIX_BLACK_CASE"] 	= $data_main["REHAB_TYPE_BLACK"];
		$fields["BLACK_CASE"] 			= $data_main["NUM_CASE_BLACK"];
		$fields["BLACK_YY"] 			= $data_main["YEAR_CASE_BLACK"];
		$fields["PREFIX_RED_CASE"] 		= $data_main["REHAB_TYPE_RED"];
		$fields["RED_CASE"] 			= $data_main["NUM_CASE_RED"];
		$fields["RED_YY"] 				= $data_main["YEAR_CASE_RED"];
		$fields["REGISTER_CODE"] 		= (trim($data_main["CORPORATE"]) != "") ? str_replace('-', '', $data_main["CORPORATE"]) : str_replace('-', '', $data_main["DEB_ID"]);
		$fields["COMP_PAY_DEPT_DATE"] 	= substr($data_main["COMP_PAY_DEPT_DATE"], 0, 10);

		if (count($data_main["DATA"]["F20_DETAIL"]) > 0) {
			$countLoop = 2;
			foreach ($data_main["DATA"]["F20_DETAIL"] as $key => $val) {
				if ($countLoop <= 3) {
					$fields["PLAINTIFF" . $countLoop] = $val["CRE20_NAME1_TH"];
				}
				$countLoop++;
			}
		}

		$fields["DEFFENDANT1"] 			= $data_main["FULLNAME_REHAB"];
		$fields["CASE_OWNER_NAME"] 		= $data_main["FULLNAME_REHAB"];
		$fields["CAPITAL_AMOUNT"] 		= $data_main["CAPITAL_AMOUNT"];
		$fields["REQ_REQUEST_NAME"] 	= $data_main["REQ_REQUEST_NAME"];
		$fields["REQ_RESULT"] 		= $data_main["REQ_RESULT"];
		$fields["REQ_RESULT_NAME"] 		= $data_main["REQ_RESULT_NAME"];

		$fields["COMP_PAY_DEPT_DATE_NAME"]		= $data_main["COMP_PAY_DEPT_DATE_NAME"]; // วันที่ครบกําหนดยื่นคําขอรับชําระหนี้
		$fields["RECEIVERSHIP_DATE_NAME"]		= $data_main["RECEIVERSHIP_DATE_NAME"]; // วันที่พิทักษ์ทรัพย์เด็ดขาด
		$fields["RECEIVERSHIP_DATE"] 			= substr($data_main["RECEIVERSHIP_DATE"], 0, 10);
		$fields["RESULT_ACCEPT_DATE_NAME"]		= $data_main["RESULT_ACCEPT_DATE_NAME"]; // วันที่ศาลรับคำร้อง
		$fields["RESULT_ACCEPT_DATE"] 			= substr($data_main["RESULT_ACCEPT_DATE"], 0, 10);
		$fields["RESULT_UNACCEPT_DATE_NAME"]	= $data_main["RESULT_UNACCEPT_DATE_NAME"]; // วันที่ศาลไม่รับคำร้อง
		$fields["RESULT_UNACCEPT_DATE"] 		= substr($data_main["RESULT_UNACCEPT_DATE"], 0, 10);
		$fields["ACCEPT_DATE_CANCEL_NAME"]		= $data_main["ACCEPT_DATE_CANCEL_NAME"]; // วันที่ถอนคำร้อง
		$fields["ACCEPT_DATE_CANCEL"] 			= substr($data_main["ACCEPT_DATE_CANCEL"], 0, 10);
		$fields["DISPOSE_DATE_NAME"]			= $data_main["DISPOSE_DATE_NAME"]; // วันที่จำหน่ายคดี
		$fields["DISPOSE_DATE"] 				= substr($data_main["DISPOSE_DATE"], 0, 10);
		$fields["REQ_DATE_NAME"]				= $data_main["REQ_DATE_NAME"]; // วันที่ยื่นคำร้อง
		$fields["REQ_DATE"] 					= substr($data_main["REQ_DATE"], 0, 10);
		$fields["JUDICIAL_DATE_REFETCH_NAME"]	= $data_main["JUDICIAL_DATE_REFETCH_NAME"]; // วันที่ศาลมีคำสั่งมีคำสั่งให้ฟื้นฟูและไม่ตั้งผู้ทำแผน
		$fields["JUDICIAL_DATE_REFETCH"] 		= substr($data_main["JUDICIAL_DATE_REFETCH"], 0, 10);
		$fields["JUDICIAL_DATE_PLANNER_NAME"]	= $data_main["JUDICIAL_DATE_PLANNER_NAME"]; // วันที่ศาลมีคำสั่งให้ฟื้นฟูกิจการและตั้งผู้ทำแผน
		$fields["JUDICIAL_DATE_PLANNER"] 		= substr($data_main["JUDICIAL_DATE_PLANNER"], 0, 10);
		$fields["SET_DATE_PLAN_TEMP_NAME"]		= $data_main["SET_DATE_PLAN_TEMP_NAME"]; // วันที่ศาลมีคำสั่งตั้งผู้บริหารชั่วคราว
		$fields["SET_DATE_PLAN_TEMP"] 			= substr($data_main["SET_DATE_PLAN_TEMP"], 0, 10);
		$fields["SET_DATE_PLANER_NAME"]			= $data_main["SET_DATE_PLANER_NAME"]; // วันที่คำสั่งให้ฟื้นฟูกิจการและตั้งผู้ทำแผน
		$fields["SET_DATE_PLANER"] 				= substr($data_main["SET_DATE_PLANER"], 0, 10);
		$fields["SET_MANAGER_DATE_NAME"]		= $data_main["SET_MANAGER_DATE_NAME"]; // วันที่ศาลมีคำสั่งตั้งผู้บริหารชั่วคราว
		$fields["SET_MANAGER_DATE"] 			= substr($data_main["SET_MANAGER_DATE"], 0, 10);
		$fields["SET_PLANNER_DATE_NAME"]		= $data_main["SET_PLANNER_DATE_NAME"]; // วันที่ศาลมีคำสั่งตั้งผู้ทำแผน
		$fields["SET_PLANNER_DATE"] 			= substr($data_main["SET_PLANNER_DATE"], 0, 10);
		$fields["SET_PLAN_REHAB_DATE_NAME"]		= $data_main["SET_PLAN_REHAB_DATE_NAME"]; // วันที่ศาลมีคำสั่งตั้งผู้บริหารแผน
		$fields["SET_PLAN_REHAB_DATE"] 			= substr($data_main["SET_PLAN_REHAB_DATE"], 0, 10);
		$fields["DATE_CMD_REHAB_CAN_NAME"]		= $data_main["DATE_CMD_REHAB_CAN_NAME"]; // วันที่คำสั่งยกเลิกคำสั่งให้ฟื้นฟูกิจการ
		$fields["DATE_CMD_REHAB_CAN"] 			= substr($data_main["DATE_CMD_REHAB_CAN"], 0, 10);
		$fields["DATE_REHAB_CAN_NAME"]			= $data_main["DATE_REHAB_CAN_NAME"]; // วันที่คำสั่งยกเลิกการฟื้นฟูกิจการ
		$fields["DATE_REHAB_CAN"] 				= substr($data_main["DATE_REHAB_CAN"], 0, 10);
		$fields["ORD_NAME_TH"]					= $data_main["ORD_NAME_TH"]; // คำสั่งให้ฟื้นฟูกิจการและตั้งผู้ทำแผน
		$fields["ORD_DATE"] 					= substr($data_main["ORD_DATE"], 0, 10);

		// $fields["DOSS_OWNER_ID"] 		= cut_prefix($data_main["DOSS_OWNER_NAME"]);
		$fields["DOSS_OWNER_NAME"] 		= $data_main["DOSS_OWNER_NAME"];

		if ($dataSelectData["WH_REHAB_ID"] > 0) {
			db::db_update("WH_REHABILITATION_CASE_DETAIL", $fields, array('WH_REHAB_ID' => $dataSelectData["WH_REHAB_ID"]));
			$WH_REHAB_ID = $dataSelectData["WH_REHAB_ID"];
		} else {
			$WH_REHAB_ID = db::db_insert("WH_REHABILITATION_CASE_DETAIL", $fields, 'WH_REHAB_ID', 'WH_REHAB_ID');
		}

		db::db_delete("WH_COURT_LOG", array('COURT_SYSTEM_TYPE' => 3, "PREFIX_BLACK_CASE" => $data_main["REHAB_TYPE_BLACK"], "BLACK_CASE" => $data_main["NUM_CASE_BLACK"], "BLACK_YY" => $data_main["YEAR_CASE_BLACK"], "ORG_ID" => $data_main["ORG_ID"]));
		unset($fieldsCourtLog);
		$fieldsCourtLog["COURT_DATE"] 				= 	(trim($data_main["ORD_DATE"]) == "") ? date('Y-m-d') : $data_main["ORD_DATE"];
		$fieldsCourtLog["COURT_DETAIL"] 			= 	$data_main["ORD_NAME_TH"];
		$fieldsCourtLog["ORD_STATUS"] 				= 	$data_main["ORD_STATUS"];
		$fieldsCourtLog["PREFIX_BLACK_CASE"] 		= 	$data_main["REHAB_TYPE_BLACK"];
		$fieldsCourtLog["BLACK_CASE"] 				= 	$data_main["NUM_CASE_BLACK"];
		$fieldsCourtLog["BLACK_YY"] 				= 	$data_main["YEAR_CASE_BLACK"];
		$fieldsCourtLog["PREFIX_RED_CASE"] 			= 	$data_main["REHAB_TYPE_RED"];
		$fieldsCourtLog["RED_CASE"] 				= 	$data_main["NUM_CASE_RED"];
		$fieldsCourtLog["RED_YY"] 					= 	$data_main["YEAR_CASE_RED"];
		$fieldsCourtLog["COURT_SYSTEM_TYPE"] 		= 	3;
		$fieldsCourtLog["COURT_CODE"] 				= 	$data_main["COURT_CODE"];
		$fieldsCourtLog["COURT_NAME"] 				= 	$data_main["COURT_NAME"];
		$fieldsCourtLog["ORG_ID"] 					= 	$data_main["ORG_ID"];
		$fieldsCourtLog["COURT_REGISTER_CODE"] 		=  (trim($data_main["CORPORATE"]) != "") ? str_replace('-', '', $data_main["CORPORATE"]) : str_replace('-', '', $data_main["DEB_ID"]);
		db::db_insert("WH_COURT_LOG", $fieldsCourtLog, 'WH_COURT_LOG_ID', 'WH_COURT_LOG_ID');


		db::db_delete("WH_REHABILITATION_PERSON", array('WH_REHAB_ID' => $WH_REHAB_ID));
		db::db_delete("WH_REHAB_BALANCE_PERSON", array('WH_REHAB_ID' => $WH_REHAB_ID));


		db::db_delete("WH_REHABILITATION_INSURE", array('WH_REHAB_ID' => $WH_REHAB_ID));
		db::db_delete("WH_REHABILITATION_NUM_DEBT", array('WH_REHAB_ID' => $WH_REHAB_ID));
		db::db_delete("WH_REHABILITATION_SUB", array('WH_REHAB_ID' => $WH_REHAB_ID));

		unset($fields);
		$fields["WH_REHAB_ID"] 			= $WH_REHAB_ID;
		$fields["PERSON_CODE"] 			= $data_main["CONCERN_CODE"];
		$fields["PERSON_CODE_NAME"] 	= $data_main["PERSON_CODE_NAME"];
		$fields["REGISTER_CODE"] 		= (trim($data_main["CORPORATE"]) != "") ? str_replace('-', '', $data_main["CORPORATE"]) : str_replace('-', '', $data_main["DEB_ID"]);

		$fields["PREFIX_NAME"] 			= $data_main["PREFIX_REHAB"];
		$fields["FIRST_NAME"] 			= $data_main["NAME_REHAB"];
		//$fields["LAST_NAME"] 			= $data_main["NAME_REHAB"];
		$fields["FULL_NAME"] 			= $data_main["FULLNAME_REHAB"];
		$fields["FULL_NAME_EN"] 		= $data_main["FULL_NAME_EN"];

		$fields["COURT_CODE"] 			= $data_main["COURT_CODE"];
		$fields["COURT_NAME"] 			= $data_main["COURT_NAME"];
		$fields["PREFIX_BLACK_CASE"] 	= $data_main["REHAB_TYPE_BLACK"];
		$fields["BLACK_CASE"] 			= $data_main["NUM_CASE_BLACK"];
		$fields["BLACK_YY"] 			= $data_main["YEAR_CASE_BLACK"];
		$fields["PREFIX_RED_CASE"] 		= $data_main["REHAB_TYPE_RED"];
		$fields["RED_CASE"] 			= $data_main["NUM_CASE_RED"];
		$fields["RED_YY"] 				= $data_main["YEAR_CASE_RED"];

		if (count($data_main["DATA"]["ARRDRESS_REHAB"]) > 0) {
			$checkLoop = 1;
			foreach ($data_main["DATA"]["ARRDRESS_REHAB"] as $key => $val) {
				if ($checkLoop == 1) {
					$fields["ADDRESS"] 				= $val["ADD_NO"];
					$fields["TUM_CODE"] 			= $val["SUB_DISTRICT"];
					$fields["TUM_NAME"] 			= $val["TAMBON_NAME"];
					$fields["AMP_CODE"] 			= $val["DIS_CODE"];
					$fields["AMP_NAME"] 			= $val["AMPHUR_NAME"];
					$fields["PROV_CODE"] 			= $val["PRO_CODE"];
					$fields["PROV_NAME"] 			= $val["PROVINCE_NAME"];
					$fields["ZIP_CODE"] 			= $val["ZIP_CODE"];
					$fields["MOO"] 					= $val["MOO"];
					$fields["SOI"] 					= $val["SOI"];
				}
				$checkLoop++;
			}
		}
		$fields["CONCERN_CODE"] 		= $data_main["CONCERN_CODE"];
		$fields["CONCERN_NAME"] 		= $data_main["CONCERN_NAME"];



		$sqlSelectLastCourtLog = "	select 		ORD_STATUS
									from 		WH_COURT_LOG
									where 		COURT_SYSTEM_TYPE = 3
												AND PREFIX_BLACK_CASE = '" . $data_main["REHAB_TYPE_BLACK"] . "' 
												AND BLACK_CASE = '" . $data_main["NUM_CASE_BLACK"] . "' 
												AND BLACK_YY = '" . $data_main["YEAR_CASE_BLACK"] . "' 
												AND PREFIX_RED_CASE = '" . $data_main["REHAB_TYPE_RED"] . "' 
												AND RED_CASE = '" . $data_main["NUM_CASE_RED"] . "' 
												AND RED_YY = '" . $data_main["YEAR_CASE_RED"] . "' 
									ORDER BY 	COURT_DATE DESC,WH_COURT_LOG_ID asc";
		$querySelectLastCourtLog = db::query($sqlSelectLastCourtLog);
		$dataSelectLastCourtLog = db::fetch_array($querySelectLastCourtLog);


		if ($dataSelectLastCourtLog["ORD_STATUS"] == 'บังคับคดี') {
			$fields["LOCK_PERSON_STATUS_TEXT"] = "อยู่ระหว่างฟื้นฟู";
			$fields["PER_ORDER_STATUS"] = "บังคับคดี";
		} else {
			$fields["LOCK_PERSON_STATUS_TEXT"] = "ไม่ฟื้นฟู";
			$fields["PER_ORDER_STATUS"] = "ไม่บังคับคดี";
		}

		$fields["COMP_PAY_DEPT_DATE"] 	= substr($data_main["COMP_PAY_DEPT_DATE"], 0, 10);

		db::db_insert("WH_REHABILITATION_PERSON", $fields, 'WH_PERSON_ID', 'WH_PERSON_ID');

		if (count($data_main["DATA"]["F20_DETAIL"]) > 0) {
			//$checkLoop = 1;
			foreach ($data_main["DATA"]["F20_DETAIL"] as $key => $val) {
				//if ($checkLoop <= 10) {
				unset($fields);
				$fields["WH_REHAB_ID"] 			= $WH_REHAB_ID;
				//$fields["PERSON_CODE"] 			= $val["CONCERN_CODE"];
				$fields["REGISTER_CODE"] 		= (trim($val["CORPORATE"]) != "") ? str_replace('-', '', $val["CORPORATE"]) : str_replace('-', '', $val["CRE20_CODE1"]);

				$fields["W_REHAB20"] 			= $val["W_REHAB20"]; //page
				$fields["WFR_ID_REHAB20"] 		= $val["WFR_ID_REHAB20"];

				$fields["PREFIX_NAME"] 			= $val["CRE20_TITLE1"];
				$fields["FIRST_NAME"] 			= $val["CRE20_NAME1_TH"];
				//$fields["LAST_NAME"] 			= $val["NAME_REHAB"];
				$fields["FULL_NAME"] 			= $val["FULLNAME_REHAB20"];
				$fields["FULL_NAME_EN"] 		= $val["FULL_NAME_EN"];

				$fields["COURT_CODE"] 			= $data_main["COURT_CODE"];
				$fields["COURT_NAME"] 			= $data_main["COURT_NAME"];
				$fields["PREFIX_BLACK_CASE"] 	= $data_main["REHAB_TYPE_BLACK"];
				$fields["BLACK_CASE"] 			= $data_main["NUM_CASE_BLACK"];
				$fields["BLACK_YY"] 			= $data_main["YEAR_CASE_BLACK"];
				$fields["PREFIX_RED_CASE"] 		= $data_main["REHAB_TYPE_RED"];
				$fields["RED_CASE"] 			= $data_main["NUM_CASE_RED"];
				$fields["RED_YY"] 				= $data_main["YEAR_CASE_RED"];

				$fields["ADDRESS"] 				= $val["ADD_NO"];
				$fields["TUM_CODE"] 			= $val["SUB_DISTRICT"];
				$fields["TUM_NAME"] 			= $val["TAMBON_NAME"];
				$fields["AMP_CODE"] 			= $val["DIS_CODE"];
				$fields["AMP_NAME"] 			= $val["AMPHUR_NAME"];
				$fields["PROV_CODE"] 			= $val["PRO_CODE"];
				$fields["PROV_NAME"] 			= $val["PROVINCE_NAME"];
				$fields["ZIP_CODE"] 			= $val["ZIP_CODE"];

				$fields["CONCERN_CODE"] 		= $val["CONCERN_CODE"];
				$fields["CONCERN_NAME"] 		= $val["CONCERN_NAME"];

				$fields["CONCERN_NO"] 			= $val["CRE20_NO"];

				$fields["MOO"] 					= $val["MOO"];
				$fields["SOI"] 					= $val["SOI"];

				$fields["CRE20_FILING_D"] 					= $val["CRE20_FILING_D"]; //วันที่ยื่น
				$fields["PERSON_CODE"] 					= $val["PERSON_CODE"]; //ประเภทบุคคล
				$fields["PERSON_CODE_NAME"] 					= $val["PERSON_CODE_NAME"]; //ชื่อประเภทบุคคล
				$fields["CRE20_NO"] 					= $val["CRE20_NO"]; //เจ้าหนี้รายที่
				$fields["CRE20_START_D"] 					= $val["CRE20_START_D"]; //ลงวันที่
				$fields["CRE20_DATE_D"] 					= $val["CRE20_DATE_D"]; //วันที่ตั้งสำนวน
				$fields["MIN_STATUS"] 					= $val["MIN_STATUS"]; //วันที่ตั้งสำนวน					
				$fields["TOTAL"] 					= $val["TOTAL"];
				db::db_insert("WH_REHABILITATION_PERSON", $fields, 'WH_PERSON_ID', 'WH_PERSON_ID');

				unset($fields);
				$fields["WH_REHAB_ID"] 			= $WH_REHAB_ID;
				$fields["COURT_CODE"] 			= $data_main["COURT_CODE"];
				$fields["PREFIX_BLACK_CASE"] 	= $data_main["REHAB_TYPE_BLACK"];
				$fields["BLACK_CASE"] 			= $data_main["NUM_CASE_BLACK"];
				$fields["BLACK_YY"] 			= $data_main["YEAR_CASE_BLACK"];
				$fields["PREFIX_RED_CASE"] 		= $data_main["REHAB_TYPE_BLACK"];
				$fields["RED_CASE"] 			= $data_main["NUM_CASE_RED"];
				$fields["RED_YY"] 				= $data_main["YEAR_CASE_RED"];
				$fields["BALANCE_ALL"] 			= $val["TOTAL"];
				$fields["BALANCE_1"] 			= $val["TOTAL_RIGHTS"];
				$fields["REGISTER_CODE"] 		= (trim($val["CORPORATE"]) != "") ? str_replace('-', '', $val["CORPORATE"]) : str_replace('-', '', $val["CRE20_CODE1"]);
				db::db_insert("WH_REHAB_BALANCE_PERSON", $fields, 'WH_REH_BAL_ID', 'WH_REH_BAL_ID');

				foreach ($data_main["DATA"]["F20_DETAIL"][$key]['F20_DEBT'] as $key1 => $val1) {

					unset($fields);
					$fields["WH_REHAB_ID"] 			= $WH_REHAB_ID;
					$fields["WFR_ID_REHAB20"] 		= $val1["WFR_ID_REHAB20"];
					$fields["DEBT_TYPE"] 			= $val1["DEBT_NAME_TH"];
					$fields["CRE20_DETAIL"] 		= $val1["CRE20_DETAIL"];
					$fields["CRE20_NUM_TOTAL_BATH"] = $val1["CRE20_NUM_TOTAL_BATH"];

					db::db_insert("WH_REHABILITATION_NUM_DEBT", $fields, 'NUM_DEBT_ID');
				}

				if (isset($data_main["DATA"]["F20_DETAIL"][$key]["F20_DEBT_INSURE"])) {
					foreach ($data_main["DATA"]["F20_DETAIL"][$key]["F20_DEBT_INSURE"] as $key2 => $val2) {
						unset($fields);
						$fields["WH_REHAB_ID"] 			= $WH_REHAB_ID;
						$fields["WFR_ID_REHAB20"] 		= $val2["WFR_ID_REHAB20"];
						$fields["CRE20_INSURE_NUM"] 	= $val2["CRE20_INSURE_NUM"];
						$fields["CRE20_INSURE_TYPE"] 	= $val2["CRE20_INSURE_TYPE"];
						$fields["CRE20_GRT_NAME"]		= $val2["CRE20_GRT_ID"];
						//$fields["CRE20_GRT_ETC"]		= $val2["CRE20_GRT_ETC"];
						$fields["CRE20_INSURE_TOTLE"] 	= $val2["CRE20_INSURE_TOTLE"];

						db::db_insert("WH_REHABILITATION_INSURE", $fields, 'INSURE_ID', 'INSURE_ID');
					}
				}

				if (isset($data_main["DATA"]["F20_DETAIL"][$key]["F20_DEBT_SUB"])) {
					foreach ($data_main["DATA"]["F20_DETAIL"][$key]["F20_DEBT_SUB"] as $key3 => $val3) {
						unset($fields);
						$fields["WH_REHAB_ID"] 			= $WH_REHAB_ID;
						$fields["WFR_ID_REHAB20"] 		= $val3["WFR_ID_REHAB20"];
						$fields["CRE20_SUB_NAME"] 		= $val3["CRE20_SUB_NAME"];
						$fields["CRE20_SUB_CODE"] 		= $val3["CRE20_SUB_CODE"];
						$fields["CRE20_SUB_COPER"]		= $val3["CRE20_SUB_COPER"];
						$fields["CRE20_CREDITOR"]		= $val3["CRE20_CREDITOR"];
						$fields["CRE20_FORMER_CREDITOR"] = $val3["CRE20_FORMER_CREDITOR"];
						$fields["CRE20_SUB_TITLE"] 		= $val3["CRE20_SUB_TITLE"];
						$fields["CRE20_SUB_RIGHT"] 		= $val3["CRE20_SUB_RIGHT"];
						$fields["CRE20_SUB_MONEY"] 		= $val3["CRE20_SUB_MONEY"];
						$fields["CRE20_SUB_OBJ"] 		= $val3["CRE20_SUB_OBJ"];
						$fields["CRE20_SUB_OBJ1"] 		= $val3["CRE20_SUB_OBJ1"];
						$fields["SUB_DATE"] 			= $val3["SUB_DATE"];
						$fields["CRE20_SUB_ID"] 		= $val3["CRE20_SUB_ID"];
						$fields["CRE20_SUB_ADD"] 		= $val3["CRE20_SUB_ADD"];
						$fields["PROVINCE_NAME"] 		= $val3["PROVINCE_NAME"];
						$fields["AMPHUR_NAME"] 			= $val3["AMPHUR_NAME"];
						$fields["TAMBON_NAME"] 			= $val3["TAMBON_NAME"];
						$fields["CRE20_SUB_POSTCODE"] 	= $val3["CRE20_SUB_POSTCODE"];

						db::db_insert("WH_REHABILITATION_SUB", $fields, 'SUB_ID', 'SUB_ID');
					}
				}
				//}
				//$checkLoop++;
			}
		}

		db::db_delete("WH_REVIVE_PER_RELATION", array("PREFIX_BLACK_CASE" => $data_main["REHAB_TYPE_BLACK"], "BLACK_CASE" => $data_main["NUM_CASE_BLACK"], "BLACK_YY" => $data_main["YEAR_CASE_BLACK"]));

		if (count($data_main["DATA"]["DATARELATION"]) > 0) {
			foreach ($data_main["DATA"]["DATARELATION"] as $key => $ObjPer) {

				$conName = "";
				if ($key == 'Objector') {
					$conName = 'ผู้คัดค้าน';
				} else if ($key == 'Manager') {
					$conName = 'ผู้บริหารชั่วคราว';
				} else if ($key == 'Planner') {
					$conName = 'ผู้ทำแผน';
				} else if ($key == 'ManagerPlan') {
					$conName = 'ผู้บริหารแผน';
				} else if ($key == 'ManagerPlanTmp') {
					$conName = 'ผู้บริหารแผนชั่วคราว';
				} else if ($key == 'MainSuppliant') {
					$conName = 'ผู้ร้องขอ';
				}
				unset($fieldRelation);
				$fieldRelation["PER_TYPE_NAME"] = $key;

				foreach ($ObjPer as $key_data => $val_data) {
					unset($fields);
					$fields["WH_REHAB_ID"] 			= $WH_REHAB_ID;
					$fields["PERSON_CODE"] 			= '00';
					$fields["PERSON_CODE_NAME"] 	= $val_data["PERSON_CODE_NAME"];
					$fields["REGISTER_CODE"] 		= str_replace('-', '', $val_data["registerCode"]);

					$fields["PREFIX_NAME"] 			= $val_data["prefixName"];
					$fields["FIRST_NAME"] 			= $val_data["fullName"];
					$fields["FULL_NAME"] 			= $val_data["fullName"];
					$fields["FULL_NAME_EN"] 		= $val_data["FULL_NAME_EN"];

					$fields["COURT_CODE"] 			= $data_main["COURT_CODE"];
					$fields["COURT_NAME"] 			= $data_main["COURT_NAME"];

					$fields["PREFIX_BLACK_CASE"] 	= $data_main["REHAB_TYPE_BLACK"];
					$fields["BLACK_CASE"] 			= $data_main["NUM_CASE_BLACK"];
					$fields["BLACK_YY"] 			= $data_main["YEAR_CASE_BLACK"];
					$fields["PREFIX_RED_CASE"] 		= $data_main["REHAB_TYPE_RED"];
					$fields["RED_CASE"] 			= $data_main["NUM_CASE_RED"];
					$fields["RED_YY"] 				= $data_main["YEAR_CASE_RED"];

					$fields["ADDRESS"] 				= $val_data["Address"];
					$fields["TUM_NAME"] 			= $val_data["tambonName"];
					$fields["AMP_NAME"] 			= $val_data["amphurName"];
					$fields["PROV_NAME"] 			= $val_data["provinceName"];
					$fields["ZIP_CODE"] 			= $val_data["zipCode"];

					$fields["CONCERN_CODE"] 		= '00';
					$fields["CONCERN_NAME"] 		= $conName;
					db::db_insert("WH_REHABILITATION_PERSON", $fields, 'WH_PERSON_ID', 'WH_PERSON_ID');

					$fieldRelation["PREFIX_BLACK_CASE"] 			= $data_main["REHAB_TYPE_BLACK"];
					$fieldRelation["BLACK_CASE"] 					= $data_main["NUM_CASE_BLACK"];
					$fieldRelation["BLACK_YY"] 						= $data_main["YEAR_CASE_BLACK"];
					$fieldRelation["PREFIX_RED_CASE"] 				= $data_main["REHAB_TYPE_RED"];
					$fieldRelation["RED_CASE"] 						= $data_main["NUM_CASE_RED"];
					$fieldRelation["RED_YY"] 						= $data_main["YEAR_CASE_RED"];
					$fieldRelation["MANAG_PREFIX"] 					= $val_data["prefixName"];
					$fieldRelation["MANAG_NAME_TH"] 				= $val_data["fullName"];
					$fieldRelation["MANAG_ADD"] 					= $val_data["Address"];
					$fieldRelation["MANAG_TAMBON"] 					= $val_data["tambonName"];
					$fieldRelation["MANAG_AMPHUR"] 					= $val_data["amphurName"];
					$fieldRelation["MANAG_PROVINCE"] 				= $val_data["provinceName"];
					$fieldRelation["MANAG_POSTCODE"] 				= $val_data["zipCode"];

					$fieldRelation["ORDER_DATE"] 					= $val_data["orderDate"];
					$fieldRelation["BEGIN_DATE"] 					= $val_data["beginDate"];
					$fieldRelation["FINISH_DATE"] 					= $val_data["finishDate"];
					$fieldRelation["NEWS_DATE"] 					= $val_data["newsDate"];
					$fieldRelation["NEWS_DATE_END"] 				= $val_data["newsDateEnd"];
					$fieldRelation["GAZETTE_DATE"] 					= $val_data["gazetteDate"];
					$fieldRelation["GAZETTE_DATE_END"] 				= $val_data["gazetteDateEnd"];
					$fieldRelation["WEBSITE_DATE"] 					= $val_data["websiteDate"];
					$fieldRelation["WEBSITE_DATE_END"] 				= $val_data["websiteDateEnd"];
					$fieldRelation["MANAG_TEL"] 					= $val_data["tel"];
					$fieldRelation["MANAG_FAX"] 					= $val_data["fax"];
					$fieldRelation["MANAG_MOBILE"] 					= $val_data["mobile"];
					$fieldRelation["MANAG_EMAIL"] 					= $val_data["email"];
					$fieldRelation["REGISTER_CODE"] 				= str_replace('-', '', $val_data["registerCode"]);
					$fieldRelation["PLAN_SEND_DATE"] 				= $val_data["plansendDate"];
					$fieldRelation["AGREE_PLAN_DATE"] 				= $val_data["agreePlanDate"];
					$fieldRelation["BEGIN_WITHOUT"] 				= $val_data["beginWithout"];
					if (trim($val_data["planPer"]) != "") {
						$fieldRelation["PLAN_PER"] 				= $val_data["planPer"];
					}
					if (trim($val_data["licenseNo"]) != "") {
						$fieldRelation["LICENSE_NO"] 				= $val_data["licenseNo"];
					}
					if (trim($val_data["orderCourtSetupDate"]) != "") {
						$fieldRelation["ORDER_COURT_SETUP_DATE"] 	= $val_data["orderCourtSetupDate"];
					}
					if (trim($val_data["orderCase"]) != "") {
						$fieldRelation["ORDER_CASE"] 	= $val_data["orderCase"];
					}

					db::db_insert("WH_REVIVE_PER_RELATION", $fieldRelation, 'WH_REVIVE_PER_ID', 'WH_REVIVE_PER_ID');
				}
			}
		}

		if (count($data_main["DATA"]["MIN_DEBT_DETAIL"]) > 0) {
			foreach ($data_main["DATA"]["MIN_DEBT_DETAIL"] as $key => $ObjPer) {

				unset($fields);
				$fields["WH_REHAB_ID"] 			= $WH_REHAB_ID;
				$fields["PERSON_CODE"] 			= $ObjPer["CONCERN_CODE"];
				$fields["PERSON_CODE_NAME"] 	= $val_data["PERSON_CODE_NAME"];
				$fields["REGISTER_CODE"] 		= (trim($ObjPer["CORPORATE_ID"]) != "") ? str_replace('-', '', $ObjPer["CORPORATE_ID"]) : str_replace('-', '', $ObjPer["DEBT_CODE"]);

				$fields["PREFIX_NAME"] 			= $ObjPer["DEBTOR_NAME_TITLE"];
				$fields["FIRST_NAME"] 			= $ObjPer["FULLNAME_MIN_DEBT"];
				//$fields["LAST_NAME"] 			= $val["NAME_REHAB"];
				$fields["FULL_NAME"] 			= $ObjPer["FULLNAME_MIN_DEBT"];
				$fields["FULL_NAME_EN"] 		= $ObjPer["FULL_NAME_EN"];

				$fields["COURT_CODE"] 			= $data_main["COURT_CODE"];
				$fields["COURT_NAME"] 			= $data_main["COURT_NAME"];
				$fields["PREFIX_BLACK_CASE"] 	= $data_main["REHAB_TYPE_BLACK"];
				$fields["BLACK_CASE"] 			= $data_main["NUM_CASE_BLACK"];
				$fields["BLACK_YY"] 			= $data_main["YEAR_CASE_BLACK"];
				$fields["PREFIX_RED_CASE"] 		= $data_main["REHAB_TYPE_RED"];
				$fields["RED_CASE"] 			= $data_main["NUM_CASE_RED"];
				$fields["RED_YY"] 				= $data_main["YEAR_CASE_RED"];

				$fields["ADDRESS"] 				= $ObjPer["ADD_NO"];
				$fields["TUM_CODE"] 			= $ObjPer["SUB_DISTRICT"];
				$fields["TUM_NAME"] 			= $ObjPer["TAMBON_NAME"];
				$fields["AMP_CODE"] 			= $ObjPer["DIS_CODE"];
				$fields["AMP_NAME"] 			= $ObjPer["AMPHUR_NAME"];
				$fields["PROV_CODE"] 			= $ObjPer["PRO_CODE"];
				$fields["PROV_NAME"] 			= $ObjPer["PROVINCE_NAME"];
				$fields["ZIP_CODE"] 			= $ObjPer["ZIP_CODE"];

				$fields["CONCERN_CODE"] 		= $ObjPer["CONCERN_CODE"];
				$fields["CONCERN_NAME"] 		= $ObjPer["CONCERN_NAME"];

				$fields["CONCERN_NO"] 			= $ObjPer["DEBT_NO"];

				$fields["MOO"] 					= $ObjPer["MOO"];
				$fields["SOI"] 					= $ObjPer["SOI"];

				$fields["W_REHAB20"] 			= $ObjPer["W_REHAB20"]; //page
				$fields["WFR_ID_REHAB20"] 		= $ObjPer["WFR_ID_REHAB20"];

				db::db_insert("WH_REHABILITATION_PERSON", $fields, 'WH_PERSON_ID', 'WH_PERSON_ID');
			}
		}


		if (count($data_main["DATA"]["MIN_CAN_DETAIL"]) > 0) {
			foreach ($data_main["DATA"]["MIN_CAN_DETAIL"] as $key => $ObjPer) {

				unset($fields);
				$fields["WH_REHAB_ID"] 			= $WH_REHAB_ID;
				$fields["PERSON_CODE"] 			= $ObjPer["CONCERN_CODE"];
				$fields["PERSON_CODE_NAME"] 	= $ObjPer["PERSON_CODE_NAME"];
				$fields["REGISTER_CODE"] 		= (trim($ObjPer["CORPORATE_ID"]) != "") ? str_replace('-', '', $ObjPer["CORPORATE_ID"]) : str_replace('-', '', $ObjPer["DEBT_CODE"]);

				$fields["PREFIX_NAME"] 			= $ObjPer["DEBTOR_NAME_TITLE"];
				$fields["FIRST_NAME"] 			= $ObjPer["FULLNAME_MIN_CAN"];
				//$fields["LAST_NAME"] 			= $val["NAME_REHAB"];
				$fields["FULL_NAME"] 			= $ObjPer["FULLNAME_MIN_CAN"];
				$fields["FULL_NAME_EN"] 		= $ObjPer["FULL_NAME_EN"];

				$fields["COURT_CODE"] 			= $data_main["COURT_CODE"];
				$fields["COURT_NAME"] 			= $data_main["COURT_NAME"];
				$fields["PREFIX_BLACK_CASE"] 	= $data_main["REHAB_TYPE_BLACK"];
				$fields["BLACK_CASE"] 			= $data_main["NUM_CASE_BLACK"];
				$fields["BLACK_YY"] 			= $data_main["YEAR_CASE_BLACK"];
				$fields["PREFIX_RED_CASE"] 		= $data_main["REHAB_TYPE_RED"];
				$fields["RED_CASE"] 			= $data_main["NUM_CASE_RED"];
				$fields["RED_YY"] 				= $data_main["YEAR_CASE_RED"];

				$fields["ADDRESS"] 				= $ObjPer["ADD_NO"];
				$fields["TUM_CODE"] 			= $ObjPer["SUB_DISTRICT"];
				$fields["TUM_NAME"] 			= $ObjPer["TAMBON_NAME"];
				$fields["AMP_CODE"] 			= $ObjPer["DIS_CODE"];
				$fields["AMP_NAME"] 			= $ObjPer["AMPHUR_NAME"];
				$fields["PROV_CODE"] 			= $ObjPer["PRO_CODE"];
				$fields["PROV_NAME"] 			= $ObjPer["PROVINCE_NAME"];
				$fields["ZIP_CODE"] 			= $ObjPer["ZIP_CODE"];

				$fields["CONCERN_CODE"] 		= $ObjPer["CONCERN_CODE"];
				$fields["CONCERN_NAME"] 		= $ObjPer["CONCERN_NAME"];

				$fields["CONCERN_NO"] 			= $ObjPer["CAN_NO"];

				$fields["MOO"] 					= $ObjPer["MOO"];
				$fields["SOI"] 					= $ObjPer["SOI"];

				$fields["W_REHAB20"] 			= $ObjPer["W_REHAB20"]; //page
				$fields["WFR_ID_REHAB20"] 		= $ObjPer["WFR_ID_REHAB20"];

				db::db_insert("WH_REHABILITATION_PERSON", $fields, 'WH_PERSON_ID', 'WH_PERSON_ID');
			}
		}

		if (count($data_main["DATA"]["MIN_CLE_DETAIL"]) > 0) {
			foreach ($data_main["DATA"]["MIN_CLE_DETAIL"] as $key => $ObjPer) {

				unset($fields);
				$fields["WH_REHAB_ID"] 			= $WH_REHAB_ID;
				$fields["PERSON_CODE"] 			= $ObjPer["CONCERN_CODE"];
				$fields["PERSON_CODE_NAME"] 	= $ObjPer["PERSON_CODE_NAME"];
				$fields["REGISTER_CODE"] 		= (trim($ObjPer["ID_CARD"]) != "") ? str_replace('-', '', $ObjPer["ID_CARD"]) : str_replace('-', '', $ObjPer["DEBT_CODE"]);

				$fields["PREFIX_NAME"] 			= $ObjPer["DEBTOR_NAME_TITLE"];
				$fields["FIRST_NAME"] 			= $ObjPer["CLE_NAME_TH"];
				//$fields["LAST_NAME"] 			= $val["NAME_REHAB"];
				$fields["FULL_NAME"] 			= $ObjPer["FULLNAME_MIN_CLE"];
				$fields["FULL_NAME_EN"] 		= $ObjPer["FULL_NAME_EN"];

				$fields["COURT_CODE"] 			= $data_main["COURT_CODE"];
				$fields["COURT_NAME"] 			= $data_main["COURT_NAME"];
				$fields["PREFIX_BLACK_CASE"] 	= $data_main["REHAB_TYPE_BLACK"];
				$fields["BLACK_CASE"] 			= $data_main["NUM_CASE_BLACK"];
				$fields["BLACK_YY"] 			= $data_main["YEAR_CASE_BLACK"];
				$fields["PREFIX_RED_CASE"] 		= $data_main["REHAB_TYPE_RED"];
				$fields["RED_CASE"] 			= $data_main["NUM_CASE_RED"];
				$fields["RED_YY"] 				= $data_main["YEAR_CASE_RED"];

				$fields["ADDRESS"] 				= $ObjPer["ADD_NO"];
				$fields["TUM_CODE"] 			= $ObjPer["SUB_DISTRICT"];
				$fields["TUM_NAME"] 			= $ObjPer["TAMBON_NAME"];
				$fields["AMP_CODE"] 			= $ObjPer["DIS_CODE"];
				$fields["AMP_NAME"] 			= $ObjPer["AMPHUR_NAME"];
				$fields["PROV_CODE"] 			= $ObjPer["PRO_CODE"];
				$fields["PROV_NAME"] 			= $ObjPer["PROVINCE_NAME"];
				$fields["ZIP_CODE"] 			= $ObjPer["ZIP_CODE"];

				$fields["CONCERN_CODE"] 		= $ObjPer["CONCERN_CODE"];
				$fields["CONCERN_NAME"] 		= $ObjPer["CONCERN_NAME"];

				$fields["CONCERN_NO"] 			= $ObjPer["CLE_NO"];

				$fields["MOO"] 					= $ObjPer["MOO"];
				$fields["SOI"] 					= $ObjPer["SOI"];

				$fields["W_REHAB20"] 			= $ObjPer["W_REHAB20"]; //page
				$fields["WFR_ID_REHAB20"] 		= $ObjPer["WFR_ID_REHAB20"];

				db::db_insert("WH_REHABILITATION_PERSON", $fields, 'WH_PERSON_ID', 'WH_PERSON_ID');
			}
		}
	}
}

function getMedToWh($WFR = "", $show_data = "")
{
	//echo $WFR;
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://103.208.27.224/ega_led_mediate/service/getMedDataService.php',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => '{
	"USERNAME":"BankruptDt",
    "PASSWORD":"Debtor4321",
    "WFR":"' . $WFR . '"
}',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
		),
	));

	$response = curl_exec($curl);

	curl_close($curl);

	$dataReturn = json_decode($response, true);
	if ($show_data == "Y") {
		echo "<pre>";
		print_r($dataReturn);
		echo "</pre>";
	}
	//หมายบังคับคดี
	unset($fields);
	$fields["REF_MEDIATE_ID"] 		=  $dataReturn["Data"]["mediateNo"];
	$fields["RECEIVE_DATE"] 		=  $dataReturn["Data"]["reqDate"];
	$fields["REQ_FNAME"] 			=  $dataReturn["Data"]["regName"];
	$fields["REQ_TYPE"] 			=  $dataReturn["Data"]["REQ_TYPE"];
	$fields["REQ_IDCARD"] 			=  $dataReturn["Data"]["REQ_IDCARD"];
	$fields["REQ_STATUS"] 			=  $dataReturn["Data"]["REQ_STATUS"];
	$fields["PLAINTIFF_FNAME"] 		=  $dataReturn["Data"]["plaintiffPrefix"] . $dataReturn["Data"]["plaintiffFname"] . " " . $dataReturn["Data"]["plaintiffLname"];
	$fields["DEFENDANT_FNAME"] 		=  $dataReturn["Data"]["defendantPrefix"] . $dataReturn["Data"]["defendantFname"] . " " . $dataReturn["Data"]["defendantLname"];
	$fields["COURT_ID"] 			=  $dataReturn["Data"]["courtCode"];
	$fields["CHANNEL_ID"] 			=  $dataReturn["Data"]["channelId"];
	$fields["COURT_NAME"] 			=  $dataReturn["Data"]["courtName"];
	$fields["CHANNEL_NAME"] 		=  $dataReturn["Data"]["channelName"];
	$fields["PREFIX_BLACK_CASE"] 	=  $dataReturn["Data"]["blackCaseTitle"];
	$fields["BLACK_CASE"]			=  $dataReturn["Data"]["blackCase"];
	$fields["BLACK_YY"] 			=  $dataReturn["Data"]["blackYear"];
	$fields["PREFIX_RED_CASE"] 		=  $dataReturn["Data"]["redCaseTitile"];
	$fields["RED_CASE"] 			=  $dataReturn["Data"]["redCase"];
	$fields["RED_YY"] 				=  $dataReturn["Data"]["redYear"];
	$fields["REF_WFR_ID"] 			=  $dataReturn["Data"]["wfrId"];
	$fields["CAPITAL_AMOUNT"] 		=  $dataReturn["Data"]["CapitalAmount"];
	$fields["STATUS_RESULT_NAME"] = $dataReturn["Data"]["status_result_name"];

	$fields["DOSS_OWNER_ID"] 		=  $dataReturn["Data"]["DOSS_OWNER_ID"];
	$fields["DOSS_OWNER_NAME"] 		=  $dataReturn["Data"]["DOSS_OWNER_NAME"];

	$sqlSelectData = "select WH_MEDAITE_ID from WH_MEDIATE_CASE where REF_WFR_ID = '" . $dataReturn["Data"]["wfrId"] . "' ";
	$querySelectData = db::query($sqlSelectData);
	$dataSelectData = db::fetch_array($querySelectData);

	if ($dataSelectData["WH_MEDAITE_ID"] > 0) {
		$WH_MEDAITE_ID = $dataSelectData["WH_MEDAITE_ID"];
		//db::db_update("WH_MEDIATE_CASE", $fields, array("WH_MEDAITE_ID" => $dataSelectData["WH_MEDAITE_ID"]));

		db::db_delete("WH_MEDIATE_CASE", array('WH_MEDAITE_ID' => $dataSelectData["WH_MEDAITE_ID"]));
		$WH_MEDAITE_ID = db::db_insert("WH_MEDIATE_CASE", $fields, 'WH_MEDAITE_ID', 'WH_MEDAITE_ID');
	} else {
		$WH_MEDAITE_ID = db::db_insert("WH_MEDIATE_CASE", $fields, 'WH_MEDAITE_ID', 'WH_MEDAITE_ID');
	}

	//echo $WH_MEDAITE_ID;
	$dataReturn["Data"]["plaintiffIdCard"] = str_replace('-', '', $dataReturn["Data"]["plaintiffIdCard"]);
	$dataReturn["Data"]["defendantIdCard"] = str_replace('-', '', $dataReturn["Data"]["defendantIdCard"]);

	//คนในคดี
	unset($fieldsPer);
	$fieldsPer["WH_MEDIATE_ID"] 	= $WH_MEDAITE_ID;
	$fieldsPer["MEDIATE_NO"] 		= $dataReturn["Data"]["mediateNo"];
	$fieldsPer["PERSON_CODE"] 		= $dataReturn["Data"]["plaintiffType"];
	$fieldsPer["PERSON_CODE_NAME"] 	= $dataReturn["Data"]["plaintiffTypeName"];
	$fieldsPer["REGISTER_CODE"] 	= $dataReturn["Data"]["plaintiffIdCard"];
	$fieldsPer["PREFIX_CODE"] 		= $dataReturn["Data"]["plaintiffPrefixCode"];
	$fieldsPer["PREFIX_NAME"] 		= $dataReturn["Data"]["plaintiffPrefixName"];
	$fieldsPer["FIRST_NAME"] 		= $dataReturn["Data"]["plaintiffFname"];
	$fieldsPer["LAST_NAME"] 		= $dataReturn["Data"]["plaintiffLname"];
	$fieldsPer["CONCERN_NO"] 		= '1';
	$fieldsPer["CONCERN_CODE"] 		= '01';
	$fieldsPer["CONCERN_NAME"] 		= 'โจทก์';
	$fieldsPer["COURT_CODE"] 		= $dataReturn["Data"]["courtCode"];
	$fieldsPer["COURT_NAME"] 		= $dataReturn["Data"]["courtName"];
	$fieldsPer["PREFIX_BLACK_CASE"] = $dataReturn["Data"]["blackCaseTitle"];
	$fieldsPer["BLACK_CASE"] 		= $dataReturn["Data"]["blackCase"];
	$fieldsPer["BLACK_YY"] 			= $dataReturn["Data"]["blackYear"];
	$fieldsPer["PREFIX_RED_CASE"] 	= $dataReturn["Data"]["redCaseTitile"];
	$fieldsPer["RED_CASE"] 			= $dataReturn["Data"]["redCase"];
	$fieldsPer["RED_YY"] 			= $dataReturn["Data"]["redYear"];
	$fieldsPer["DEPT_CODE"] 		= $dataReturn["Data"]["DEPT_CODE"];
	$fieldsPer["DEPT_NAME"] 		= $dataReturn["Data"]["DEPT_NAME"];

	$fieldsPer["ADDRESS"] 			= $dataReturn["Data"]["plaintiffAddeNO"]; //อยู่บ้านเลขที่
	$fieldsPer["BUILDINGNAME"] 		= $dataReturn["Data"]["PLAINTIFF_BUILDINGNAME"]; //ชื่ออาคารชุด
	$fieldsPer["BUILDING"] 			= $dataReturn["Data"]["PLAINTIFF_BUILDING"]; //อาคารเลขที่
	$fieldsPer["FLOOR"] 			= $dataReturn["Data"]["PLAINTIFF_FLOOR"]; //ชั้น
	$fieldsPer["MOO"] 				= $dataReturn["Data"]["PLAINTIFF_MOO"]; //หมู่ที่
	$fieldsPer["SOI"] 				= $dataReturn["Data"]["PLAINTIFF_SOI"]; //ตรอก/ซอย
	$fieldsPer["ROAD"] 				= $dataReturn["Data"]["PLAINTIFF_ROAD"]; //ถนน
	$fieldsPer["NEAR"] 				= $dataReturn["Data"]["PLAINTIFF_NEAR"]; //ใกล้เคียง
	$fieldsPer["TUM_NAME"] 			= $dataReturn["Data"]["plaintiffTum"]; //ตำบล
	$fieldsPer["AMP_NAME"] 			= $dataReturn["Data"]["plaintiffAmph"]; //อำเภอ
	$fieldsPer["PROV_NAME"] 		= $dataReturn["Data"]["plaintiffProv"]; //จังหวัด
	$fieldsPer["ZIP_CODE"] 			= $dataReturn["Data"]["plaintiffZipcode"]; //ไปรษณีย์

	// ที่อยู่ปัจจุบัน
	$fieldsPer["CUR_ADDR_NO"]		=  $dataReturn["Data"]["CUR_P_ADDR_NO"]; //อยู่บ้านเลขที่
	$fieldsPer["CUR_BUILDINGNAME"]	=  $dataReturn["Data"]["CUR_P_BUILDINGNAME"]; //ชื่ออาคารชุด
	$fieldsPer["CUR_BUILDING"]		=  $dataReturn["Data"]["CUR_P_BUILDING"]; //อาคารเลขที่
	$fieldsPer["CUR_FLOOR"]			=  $dataReturn["Data"]["CUR_P_FLOOR"]; //ชั้น
	$fieldsPer["CUR_MOO"]			=  $dataReturn["Data"]["CUR_P_MOO"]; //หมู่ที่
	$fieldsPer["CUR_SOI"]			=  $dataReturn["Data"]["CUR_P_SOI"]; //ตรอก/ซอย
	$fieldsPer["CUR_ROAD"]			=  $dataReturn["Data"]["CUR_P_ROAD"]; //ถนน
	$fieldsPer["CUR_NEAR"]			=  $dataReturn["Data"]["CUR_P_NEAR"]; //ใกล้เคียง
	$fieldsPer["CUR_PROVINCE"]		=  $dataReturn["Data"]["CUR_P_PROVINCE"]; //จังหวัด
	$fieldsPer["CUR_AMPHUR"]		=  $dataReturn["Data"]["CUR_P_AMPHUR"]; //อำเภอ
	$fieldsPer["CUR_TUMBON"]		=  $dataReturn["Data"]["CUR_P_TUMBON"]; //ตำบล
	$fieldsPer["CUR_ZIPCODE"]		=  $dataReturn["Data"]["CUR_P_ZIPCODE"]; //ไปรษณีย์

	$fieldsPer["STATUS_RESULT_NAME"] 	=  $dataReturn["Data"]["status_result_name"]; // ผลไกล่เกลี่ย

	$sqlSelectDataPer1 		= "select WH_PERSON_ID from WH_MEDIATE_PERSON where WH_MEDIATE_ID = '" . $WH_MEDAITE_ID . "' and REGISTER_CODE = '" . $dataReturn["Data"]["plaintiffIdCard"] . "' and CONCERN_CODE = '01'";
	$querySelectDataPer1 	= db::query($sqlSelectDataPer1);
	$dataSelectDataPer1 	= db::fetch_array($querySelectDataPer1);
	db::db_delete("WH_MEDIATE_PERSON", array('WH_MEDIATE_ID' => $dataSelectData["WH_MEDAITE_ID"])); //ลบคน
	if ($dataSelectDataPer1["WH_PERSON_ID"] > 0) {
		$WH_PERSON_ID = $dataSelectDataPer1["WH_PERSON_ID"];
		//db::db_update("WH_MEDIATE_PERSON", $fieldsPer, array("WH_PERSON_ID" => $dataSelectDataPer1["WH_PERSON_ID"]));
		$WH_PERSON_ID = db::db_insert("WH_MEDIATE_PERSON", $fieldsPer, 'WH_PERSON_ID', 'WH_PERSON_ID');
	} else {
		$WH_PERSON_ID = db::db_insert("WH_MEDIATE_PERSON", $fieldsPer, 'WH_PERSON_ID', 'WH_PERSON_ID');
	}

	unset($fieldsPer);
	$fieldsPer["WH_MEDIATE_ID"] 	= $WH_MEDAITE_ID;
	$fieldsPer["MEDIATE_NO"] 		= $dataReturn["Data"]["mediateNo"];
	$fieldsPer["PERSON_CODE"] 		= $dataReturn["Data"]["defendantType"];
	$fieldsPer["PERSON_CODE_NAME"] 	= $dataReturn["Data"]["defendantTypeName"];
	$fieldsPer["REGISTER_CODE"] 	= $dataReturn["Data"]["defendantIdCard"];
	$fieldsPer["PREFIX_CODE"] 		= $dataReturn["Data"]["defendantPrefixCode"];
	$fieldsPer["PREFIX_NAME"] 		= $dataReturn["Data"]["defendantPrefixName"];
	$fieldsPer["FIRST_NAME"] 		= $dataReturn["Data"]["defendantFname"];
	$fieldsPer["LAST_NAME"] 		= $dataReturn["Data"]["defendantLname"];
	$fieldsPer["CONCERN_NO"] 		= '1';
	$fieldsPer["CONCERN_CODE"] 		= '02';
	$fieldsPer["CONCERN_NAME"] 		= 'จำเลย';
	$fieldsPer["COURT_CODE"] 		= $dataReturn["Data"]["courtCode"];
	$fieldsPer["COURT_NAME"] 		= $dataReturn["Data"]["courtName"];
	$fieldsPer["PREFIX_BLACK_CASE"] = $dataReturn["Data"]["blackCaseTitle"];
	$fieldsPer["BLACK_CASE"] 		= $dataReturn["Data"]["blackCase"];
	$fieldsPer["BLACK_YY"] 			= $dataReturn["Data"]["blackYear"];
	$fieldsPer["PREFIX_RED_CASE"] 	= $dataReturn["Data"]["redCaseTitile"];
	$fieldsPer["RED_CASE"] 			= $dataReturn["Data"]["redCase"];
	$fieldsPer["RED_YY"] 			= $dataReturn["Data"]["redYear"];
	$fieldsPer["DEPT_CODE"] 		= $dataReturn["Data"]["DEPT_CODE"];
	$fieldsPer["DEPT_NAME"] 		= $dataReturn["Data"]["DEPT_NAME"];

	$fieldsPer["ADDRESS"] 			= $dataReturn["Data"]["defendantAddeNO"];
	$fieldsPer["BUILDINGNAME"] 		= $dataReturn["Data"]["DEFENDANT_BUILDINGNAME"]; //ชื่ออาคารชุด
	$fieldsPer["BUILDING"] 			= $dataReturn["Data"]["DEFENDANT_BUILDING"]; //อาคารเลขที่
	$fieldsPer["FLOOR"] 			= $dataReturn["Data"]["DEFENDANT_FLOOR"]; //ชั้น
	$fieldsPer["MOO"] 				= $dataReturn["Data"]["DEFENDANT_MOO"]; //หมู่ที่
	$fieldsPer["SOI"] 				= $dataReturn["Data"]["DEFENDANT_SOI"]; //ตรอก/ซอย
	$fieldsPer["ROAD"] 				= $dataReturn["Data"]["DEFENDANT_ROAD"]; //ถนน
	$fieldsPer["NEAR"] 				= $dataReturn["Data"]["DEFENDANT_NEAR"]; //ใกล้เคียง
	$fieldsPer["TUM_NAME"] 			= $dataReturn["Data"]["defendantTum"];
	$fieldsPer["AMP_NAME"] 			= $dataReturn["Data"]["defendantAmph"];
	$fieldsPer["PROV_NAME"] 		= $dataReturn["Data"]["defendantProv"];
	$fieldsPer["ZIP_CODE"] 			= $dataReturn["Data"]["defendantZipcode"];

	// ที่อยู่ปัจจุบัน
	$fieldsPer["CUR_ADDR_NO"]		=  $dataReturn["Data"]["CUR_D_ADDR_NO"]; //อยู่บ้านเลขที่
	$fieldsPer["CUR_BUILDINGNAME"]	=  $dataReturn["Data"]["CUR_D_BUILDINGNAME"]; //ชื่ออาคารชุด
	$fieldsPer["CUR_BUILDING"]		=  $dataReturn["Data"]["CUR_D_BUILDING"]; //อาคารเลขที่
	$fieldsPer["CUR_FLOOR"]			=  $dataReturn["Data"]["CUR_D_FLOOR"]; //ชั้น
	$fieldsPer["CUR_MOO"]			=  $dataReturn["Data"]["CUR_D_MOO"]; //หมู่ที่
	$fieldsPer["CUR_SOI"]			=  $dataReturn["Data"]["CUR_D_SOI"]; //ตรอก/ซอย
	$fieldsPer["CUR_ROAD"]			=  $dataReturn["Data"]["CUR_D_ROAD"]; //ถนน
	$fieldsPer["CUR_NEAR"]			=  $dataReturn["Data"]["CUR_D_NEAR"]; //ใกล้เคียง
	$fieldsPer["CUR_PROVINCE"]		=  $dataReturn["Data"]["CUR_D_PROVINCE"]; //จังหวัด
	$fieldsPer["CUR_AMPHUR"]		=  $dataReturn["Data"]["CUR_D_AMPHUR"]; //อำเภอ
	$fieldsPer["CUR_TUMBON"]		=  $dataReturn["Data"]["CUR_D_TUMBON"]; //ตำบล
	$fieldsPer["CUR_ZIPCODE"]		=  $dataReturn["Data"]["CUR_D_ZIPCODE"]; //ไปรษณีย์

	$fieldsPer["STATUS_RESULT_NAME"] 	=  $dataReturn["Data"]["status_result_name"]; // ผลไกล่เกลี่ย

	$sqlSelectDataPer1 		= "select WH_PERSON_ID from WH_MEDIATE_PERSON where WH_MEDIATE_ID = '" . $WH_MEDAITE_ID . "' and REGISTER_CODE = '" . $dataReturn["Data"]["defendantIdCard"] . "' and CONCERN_CODE = '02' ";
	$querySelectDataPer1 	= db::query($sqlSelectDataPer1);
	$dataSelectDataPer1 	= db::fetch_array($querySelectDataPer1);
	if ($dataSelectDataPer1["WH_PERSON_ID"] > 0) {
		$WH_PERSON_ID = $dataSelectDataPer1["WH_PERSON_ID"];
		//db::db_update("WH_MEDIATE_PERSON", $fieldsPer, array("WH_PERSON_ID" => $dataSelectDataPer1["WH_PERSON_ID"]));
		$WH_PERSON_ID = db::db_insert("WH_MEDIATE_PERSON", $fieldsPer, 'WH_PERSON_ID', 'WH_PERSON_ID');
	} else {
		$WH_PERSON_ID = db::db_insert("WH_MEDIATE_PERSON", $fieldsPer, 'WH_PERSON_ID', 'WH_PERSON_ID');
	}

	/* start ผู้มีส่วนได้เสีย */
	if ($dataReturn["Data"]["stakeholdersIdcard"] != "") { //ถ้ามีเลข13หลัก
		unset($fieldsPer);
		$fieldsPer["WH_MEDIATE_ID"] 	= $WH_MEDAITE_ID;
		$fieldsPer["PERSON_CODE"] 		= $dataReturn["Data"]["stakeholdersType"];
		$fieldsPer["REGISTER_CODE"] 	= str_replace("-", "", $dataReturn["Data"]["stakeholdersIdcard"]);
		$fieldsPer["PREFIX_CODE"] 		= $dataReturn["Data"]["stakeholdersPrefixCode"];
		$fieldsPer["PREFIX_NAME"] 		= $dataReturn["Data"]["stakeholdersPrefixName"];
		$fieldsPer["FIRST_NAME"] 		= $dataReturn["Data"]["stakeholdersFname"];
		$fieldsPer["LAST_NAME"] 		= $dataReturn["Data"]["stakeholdersLname"];
		$fieldsPer["CONCERN_CODE"] 		= '08';
		$fieldsPer["CONCERN_NAME"] 		= 'ผู้มีส่วนได้เสีย';
		$fieldsPer["COURT_CODE"] 		= $dataReturn["Data"]["courtCode"];
		$fieldsPer["COURT_NAME"] 		= $dataReturn["Data"]["courtName"];
		$fieldsPer["PREFIX_BLACK_CASE"] = $dataReturn["Data"]["blackCaseTitle"];
		$fieldsPer["BLACK_CASE"] 		= $dataReturn["Data"]["blackCase"];
		$fieldsPer["BLACK_YY"] 			= $dataReturn["Data"]["blackYear"];
		$fieldsPer["PREFIX_RED_CASE"] 	= $dataReturn["Data"]["redCaseTitile"];
		$fieldsPer["RED_CASE"] 			= $dataReturn["Data"]["redCase"];
		$fieldsPer["RED_YY"] 			= $dataReturn["Data"]["redYear"];
		$fieldsPer["DEPT_CODE"] 		= $dataReturn["Data"]["DEPT_CODE"];
		$fieldsPer["DEPT_NAME"] 		= $dataReturn["Data"]["DEPT_NAME"];

		$fieldsPer["ADDRESS"] 			= $dataReturn["Data"]["stakeholdersAddeNO"];
		$fieldsPer["TUM_NAME"] 			= $dataReturn["Data"]["stakeholdersTum"];
		$fieldsPer["AMP_NAME"] 			= $dataReturn["Data"]["stakeholdersAmph"];
		$fieldsPer["PROV_NAME"] 		= $dataReturn["Data"]["stakeholdersProv"];
		$fieldsPer["ZIP_CODE"] 			= $dataReturn["Data"]["stakeholdersZipcode"];
		$fieldsPer["STATUS_RESULT_NAME"] 	=  $dataReturn["Data"]["status_result_name"]; // ผลไกล่เกลี่ย

		$sqlSelectDataPer1 		= "select WH_PERSON_ID from WH_MEDIATE_PERSON where WH_MEDIATE_ID = '" . $WH_MEDAITE_ID . "' and REGISTER_CODE = '" . $dataReturn["Data"]["stakeholdersIdcard"] . "' and CONCERN_CODE = '08' ";
		$querySelectDataPer1 	= db::query($sqlSelectDataPer1);
		$dataSelectDataPer1 	= db::fetch_array($querySelectDataPer1);
		if ($dataSelectDataPer1["WH_PERSON_ID"] > 0) {
			$WH_PERSON_ID = $dataSelectDataPer1["WH_PERSON_ID"];
			//db::db_update("WH_MEDIATE_PERSON", $fieldsPer, array("WH_PERSON_ID" => $dataSelectDataPer1["WH_PERSON_ID"]));
			$WH_PERSON_ID = db::db_insert("WH_MEDIATE_PERSON", $fieldsPer, 'WH_PERSON_ID', 'WH_PERSON_ID');
		} else {
			$WH_PERSON_ID = db::db_insert("WH_MEDIATE_PERSON", $fieldsPer, 'WH_PERSON_ID', 'WH_PERSON_ID');
		}
	}
	/* stop ผู้มีส่วนได้เสีย */


	//ผลการไกล่เกลี่ย
	unset($fieldResult);
	$fieldResult["WH_MEDIATE_ID"] 		= $WH_MEDAITE_ID;
	$fieldResult["REF_MEDIATE_ID"] 		= $dataReturn["Data"]["mediateNo"];
	$fieldResult["COURT_CODE"] 			= $dataReturn["Data"]["courtCode"];
	$fieldResult["COURT_NAME"] 			= $dataReturn["Data"]["courtName"];
	$fieldResult["DEPT_CODE"] 			= $dataReturn["Data"]["DEPT_CODE"];
	$fieldResult["DEPT_NAME"] 			= $dataReturn["Data"]["DEPT_NAME"];
	$fieldResult["PREFIX_BLACK_CASE"] 	= $dataReturn["Data"]["blackCaseTitle"];
	$fieldResult["BLACK_CASE"] 			= $dataReturn["Data"]["blackCase"];
	$fieldResult["BLACK_YY"] 			= $dataReturn["Data"]["blackYear"];
	$fieldResult["PREFIX_RED_CASE"] 	= $dataReturn["Data"]["redCaseTitile"];
	$fieldResult["RED_CASE"] 			= $dataReturn["Data"]["redCase"];
	$fieldResult["RED_YY"] 				= $dataReturn["Data"]["redYear"];
	$fieldResult["CASE_TYPE_NAME"] 		= $dataReturn["Data"]["CASE_TYPE_NAME"];

	$fieldResult["MEDIATOR_NAME"] 		= $dataReturn["Data"]["mediatorName"];
	$fieldResult["MEDIATE_NO"] 			= $dataReturn["Data"]["mediateNo"];
	$fieldResult["PAYMENT_AMOUNT_DEF"] 	= $dataReturn["Data"]["paymentAmountDef"];
	$fieldResult["MEDIATE_RESULT"] 		= $dataReturn["Data"]["mediatorResult"]; // ผลการไกล่เกลี่ย
	$fieldResult["PLAINTIFF1"] 			=  $dataReturn["Data"]["plaintiffPrefix"] . $dataReturn["Data"]["plaintiffFname"] . " " . $dataReturn["Data"]["plaintiffLname"];
	$fieldResult["DEFFENDANT1"] 		=  $dataReturn["Data"]["defendantPrefix"] . $dataReturn["Data"]["defendantFname"] . " " . $dataReturn["Data"]["defendantLname"];
	$fieldResult["COURT_DATE"] 			=  $dataReturn["Data"]["reqDate"];
	$fieldResult["CAPITAL_AMOUNT"] 		=  $dataReturn["Data"]["CapitalAmount"];
	$fieldResult["CHANNEL_ID"] 			=  $dataReturn["Data"]["CHANNEL_ID"];
	$fieldResult["CHANNEL_NAME"] 		=  $dataReturn["Data"]["channelName"];

	$fieldResult["APPOINT_DATE"] 		=  $dataReturn["Data"]["APPOINT_DATE"]; // วันที่นัดหมาย
	$fieldResult["APPOINT_TIME"] 		=  $dataReturn["Data"]["APPOINT_TIME"]; // เวลานัดหมาย
	$fieldResult["APPOINT_PLACE"] 		=  $dataReturn["Data"]["APPOINT_PLACE"]; // สถานที่
	$fieldResult["OWNER_USR_NAME"] 		=  $dataReturn["Data"]["OwnerUsrName"]; // ชื่อนิติกร
	$fieldResult["RESP_APPOINT_STATUS"] =  $dataReturn["Data"]["RESP_APPOINT_STATUS"]; //ผลการได้รับหนังสือเชิญ
	$fieldResult["RESP_APPOINT_STATUS_NAME"] 	=  $dataReturn["Data"]["RESP_APPOINT_STATUS_NAME"];
	$fieldResult["STATUS_RESULT_NAME"] 	=  $dataReturn["Data"]["status_result_name"]; // ผลไกล่เกลี่ย

	$sqlSelectDataResult 	= "select WH_MEDIATE_ID from WH_MEDIATE_CASE_DETAIL where WH_MEDIATE_ID = '" . $WH_MEDAITE_ID . "' ";
	$querySelectDataResult 	= db::query($sqlSelectDataResult);
	$dataSelectDataResult 	= db::fetch_array($querySelectDataResult);
	db::db_delete("WH_MEDIATE_CASE_DETAIL", array('WH_MEDIATE_ID' => $dataSelectData["WH_MEDAITE_ID"]));
	if ($dataSelectDataResult["WH_MEDIATE_ID"] > 0) {
		//db::db_update("WH_MEDIATE_CASE_DETAIL", $fieldResult, array("WH_MEDIATE_ID" => $dataSelectDataResult["WH_MEDIATE_ID"]));
		db::db_insert("WH_MEDIATE_CASE_DETAIL", $fieldResult);
	} else {
		db::db_insert("WH_MEDIATE_CASE_DETAIL", $fieldResult);
	}
}
function getCivilEdocument($pccCaseGen = "")
{
	$sqlSelectFile = "SELECT SHR_E_DOCUMENT_URL FROM WH_CIVIL_EDOC WHERE PCC_CASE_GEN = '" . $pccCaseGen . "'";
	$querySelectFile = db::query($sqlSelectFile);
	$arrFileData = array();
	while ($dataSelectFile = db::fetch_array($querySelectFile)) {

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'http://103.40.146.152/LED_DOC/LED_EDOC/webservice/get_document_process.php',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => '{
			"DOC_MAS_ID":"' . $dataSelectFile["SHR_E_DOCUMENT_URL"] . '"
		}',
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Cookie: PHPSESSID=42ba47c21c73ca90436e9fe1e9c0dfe3'
			),
		));

		$response = curl_exec($curl);



		curl_close($curl);

		$dataJson = json_decode($response, true);

		//print_pre($dataJson);

		$arrFileData[] = array(
			"FILE_NAME" 	=> $dataJson["data"][0]["FILE_NAME"],
			"MAS_FILE" 		=> $dataJson["data"][0]["MAS_FILE"],
			"DOC_MAS_ID" 	=> $dataJson["data"][0]["DOC_MAS_ID"],
			"URL_SHOW_FILE"	=> 'http://103.40.146.152/LED_DOC/LED_EDOC/system/all/doc_preview.php?mas_file=' . $dataJson["data"][0]["MAS_FILE"] . '&DOC_ID=' . $dataJson["data"][0]["DOC_MAS_ID"] . ''
		);
	}
	return $arrFileData;
}
function insertCourtLogCommand($prefixBlackCase, $blackCase, $blackYy, $prefixRedCase, $redCase, $redYy, $courtName, $cmdNote)
{

	$mont_th_short = array("ม.ค." => "01", "ก.พ." => "02", "มี.ค" => "03", "เม.ย." => "04", "พ.ค." => "05", "มิ.ย." => "06", "ก.ค." => "07", "ส.ค." => "08", "ก.ย." => "09", "ต.ค." => "10", "พ.ย." => "11", "ธ.ค." => "12");

	$COURT_DETAIL = "";
	if (strpos($cmdNote, 'ยกเลิกประนอมหนี้ก่อนล้มและพิพากษาล้มละลาย') > 0) {
		$COURT_DETAIL = "ยกเลิกประนอมหนี้ก่อนล้มและพิพากษาล้มละลาย";
	} else if (strpos($cmdNote, 'ยกเลิกประนอมหนี้หลังล้มและพิพากษาล้มละลาย') > 0) {
		$COURT_DETAIL = "ยกเลิกประนอมหนี้หลังล้มและพิพากษาล้มละลาย";
	} else if (strpos($cmdNote, 'เห็นชอบการประนอมหนี้หลังล้มละลายและยกเลิกการล้มละลาย') > 0) {
		$COURT_DETAIL = "เห็นชอบการประนอมหนี้หลังล้มละลายและยกเลิกการล้มละลาย";
	} else if (strpos($cmdNote, 'หยุดนับปลดล้มละลาย') > 0) {
		$COURT_DETAIL = "หยุดนับปลดล้มละลาย";
	} else if (strpos($cmdNote, 'คำสั่งพิทักษ์ทรัพย์ชั่วคราว') > 0) {
		$COURT_DETAIL = "คำสั่งพิทักษ์ทรัพย์ชั่วคราว";
	} else if (strpos($cmdNote, 'คำสั่งพิทักษ์ทรัพย์เด็ดขาด') > 0) {
		$COURT_DETAIL = "คำสั่งพิทักษ์ทรัพย์เด็ดขาด";
	} else if (strpos($cmdNote, 'ปลดล้มละลาย') > 0) {
		$COURT_DETAIL = "ปลดล้มละลาย";
	} else if (strpos($cmdNote, 'ปิดคดี') > 0) {
		$COURT_DETAIL = "ปิดคดี";
	} else if (strpos($cmdNote, 'พิจารณาคดีใหม่') > 0) {
		$COURT_DETAIL = "พิจารณาคดีใหม่";
	} else if (strpos($cmdNote, 'พิพากษาล้มละลาย') > 0) {
		$COURT_DETAIL = "พิพากษาล้มละลาย";
	} else if (strpos($cmdNote, 'ยกฟ้อง') > 0) {
		$COURT_DETAIL = "ยกฟ้อง";
	} else if (strpos($cmdNote, 'ยกเลิกการประนอมหนี้') > 0) {
		$COURT_DETAIL = "ยกเลิกการประนอมหนี้";
	} else if (strpos($cmdNote, 'ยกเลิกการล้มละลาย') > 0) {
		$COURT_DETAIL = "ยกเลิกการล้มละลาย";
	} else if (strpos($cmdNote, 'เปิดคดี') > 0) {
		$COURT_DETAIL = "เปิดคดี";
	} else if (strpos($cmdNote, 'เห็นชอบการประนอมหนี้ก่อนล้มละลาย') > 0) {
		$COURT_DETAIL = "เห็นชอบด้วยการประนอมหนี้ก่อนล้มละลาย";
	} else if (strpos($cmdNote, 'เห็นชอบการประนอมหนี้หลังล้มละลาย') > 0) {
		$COURT_DETAIL = "เห็นชอบด้วยการประนอมหนี้หลังล้มละลาย";
	}

	if ($COURT_DETAIL == 'คำสั่งพิทักษ์ทรัพย์เด็ดขาด' || $COURT_DETAIL == 'คำสั่งพิทักษ์ทรัพย์ชั่วคราว' || $COURT_DETAIL == 'คำพิพากษาจัดการทรัพย์มรดก' || $COURT_DETAIL == 'ยกเลิกประนอมหนี้ก่อนล้มและพิพากษาล้มละลาย' || $COURT_DETAIL == 'ยกเลิกประนอมหนี้หลังล้มและพิพากษาล้มละลาย' || $COURT_DETAIL == 'พิพากษาล้มละลาย' || $COURT_DETAIL == 'พิทักษ์ทรัพย์เด็ดขาดและจัดการทรัพย์มรดก' || $COURT_DETAIL == 'เห็นชอบการประนอมหนี้หลังล้มละลายและยกเลิกการล้มละลาย') {
		$ORD_STATUS = 'บังคับคดี';
	} else {
		$ORD_STATUS = 'ไม่บังคับคดี';
	}

	$explodeTextDate 	= explode(' เมื่อวันที่ ', $cmdNote);
	$textDateExplode 	= explode(' ', $explodeTextDate[1]);
	$COURT_DATE			= ($textDateExplode[2] - 543) . "-" . $mont_th_short[$textDateExplode[1]] . "-" . $textDateExplode[0];

	db::db_delete("WH_COURT_LOG", array('COURT_SYSTEM_TYPE' => '2', 'BLACK_CASE' => $blackCase, 'BLACK_YY' => $blackYy, 'RED_CASE' => $redCase, 'RED_YY' => $redYy, 'COURT_DETAIL' => $COURT_DETAIL));
	unset($fields);
	$fields["COURT_NAME"] 			= $courtName;
	$fields["PREFIX_BLACK_CASE"] 	= $prefixBlackCase;
	$fields["BLACK_CASE"] 			= $blackCase;
	$fields["BLACK_YY"] 			= $blackYy;
	$fields["PREFIX_RED_CASE"] 		= $prefixRedCase;
	$fields["RED_CASE"] 			= $redCase;
	$fields["RED_YY"] 				= $redYy;
	$fields["COURT_SYSTEM_TYPE"] 	= 2;
	$fields["COURT_DATE"] 			= $COURT_DATE;
	$fields["COURT_DETAIL"] 		= $COURT_DETAIL;
	$fields["ORD_STATUS"] 			= $ORD_STATUS;
	db::db_insert("WH_COURT_LOG", $fields, 'WH_COURT_LOG_ID', 'WH_COURT_LOG_ID');
}

function thaiDate($date)
{
	return substr($date, 8, 2) . '/' . substr($date, 5, 2) . '/' . (substr($date, 0, 4) + 543);
}


/*  start ดึงล้มละลาย ให้เรียงโจทย์จำเลยตามลำดับ */

function getBankruptToWh_num($brcId = "", $show_data = "")
{
	$curl = curl_init();

	global $WF_BANKRUPT_CHACK_CASE_BY_ID;

	curl_setopt_array($curl, array(
		CURLOPT_URL => $WF_BANKRUPT_CHACK_CASE_BY_ID,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 300,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => '{
		"brcId":"' . $brcId . '"
	}',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
		),
	));

	$response = curl_exec($curl);

	curl_close($curl);

	$dataJson = json_decode($response, true);


	if ($show_data == 'Y') {
		print_pre($dataJson);
	}

	$WH_BANKRUPT_ID = '';
	if (isset($dataJson["data"]["Data"][0])) {

		$data_main = $dataJson["data"]["Data"][0];

		$sqlSelectData = "SELECT	WH_BANKRUPT_ID
						FROM 		WH_BANKRUPT_CASE_DETAIL
						WHERE 		BANKRUPT_CODE = '" . $data_main["bankruptCode"] . "' 
		";


		$querySelectData = db::query($sqlSelectData);
		$dataSelectData = db::fetch_array($querySelectData);

		//case
		unset($fields);
		$fields["BANKRUPT_CODE"]	= $data_main["bankruptCode"];
		$fields["BRC_SUBJECT_NUM"]	= $data_main["subjectNum"];
		$fields["NEW_ACCOUNT_NUMBER"]	= $data_main["newAccountNumber"];
		$fields["COURT_CODE"]		= $data_main["courtCode"];
		$fields["COURT_NAME"]		= $data_main["courtName"];
		$fields["DEPT_CODE"]		= $data_main["deptCode"];
		$fields["DEPT_NAME"]		= $data_main["deptName"];
		$fields["PREFIX_BLACK_CASE"] = $data_main["prefixBlackCase"];
		$fields["BLACK_CASE"]		= $data_main["blackCase"];
		$fields["BLACK_YY"]			= $data_main["blackYy"];
		$fields["PREFIX_RED_CASE"]	= $data_main["prefixRedCase"];
		$fields["RED_CASE"]			= $data_main["redCase"];
		$fields["RED_YY"]			= $data_main["redYy"];
		$fields["COURT_DATE"]		= substr($data_main["courtDate"], 0, 10);
		$fields["RECEIPT_DATE"]		= substr($data_main["docReceivedDate"], 0, 10);	// วันที่รับ
		$fields["RECEIPT_NUMBER"]	= $data_main["docReceivedNumber"];	// เลขที่รับเอกสาร
		$fields["DOC_NUMBER"]		= $data_main["docNumber"];	// เลขที่เอกสาร
		$fields["DOC_DATE"]			= substr($data_main["docDate"], 0, 10);	// วันที่เอกสาร
		$fields["DOC_STATUS"]		= $data_main["docStatus"];	// สถานะดำเนินการ
		$fields["DOC_STATUS_NAME"]	= $data_main["docStatusName"];	// สถานะดำเนินการ
		$fields["DOC_NAME"]			= $data_main["dotName"];	// คำสั่งศาล/คำพิพากษา
		$fields["DOC_FROM_NAME"]	= $data_main["docFromName"];	// จาก
		$fields["RECEIVERSHIP_DATE"] = substr($data_main["receivershipDate"], 0, 10);	// วันที่พิทักษ์ทรัพย์/จัดการทรัพย์มรดก
		$fields["INV_INVESTIGATE_DATE"] = substr($data_main["invInvestigateDate"], 0, 10);	// วันที่มาสอบสวน >> BR101002 หน้าค้นหาหมายเลขคดีและจำเลย
		$fields["INV_INVESTIGATE_NAME"] = $data_main["invInvestigateName"];	// สถานะมาสอบสวน >> BR101002 หน้าค้นหาหมายเลขคดีและจำเลย
		$fields["DEBT_RECONCILIATION"] = $data_main["debtReconciliation"];	// การขอประนอมหนี้ >> BR101002 หน้าค้นหาหมายเลขคดีและจำเลย
		$fields["END_DATE"] 		= substr($data_main["endDate"], 0, 10);	// วันที่ครบกำหนดยื่นคำขอฯ >> BR101002 หน้าค้นหาหมายเลขคดีและจำเลย
		$fields["APPOINTMENT_DATE"]	= $data_main["appointmentDate"]; // วันที่นัดตรวจคำขอ >> BR101002 หน้าค้นหาหมายเลขคดีและจำเลย
		$fields["PLAINTIFF_COUNT"]	= $data_main["plaintiffCount"];	// จำนวนเจ้าหนี้ที่ยื่นคำขอรับชำระหนี้ >> BR101002 หน้าค้นหาหมายเลขคดีและจำเลย
		$fields["AMOUNT_DEBT"]		= $data_main["amountDebt"];		// มูลหนี้รวม >> BR101002 หน้าค้นหาหมายเลขคดีและจำเลย
		$fields["CAPITAL_AMOUNT"]	= $data_main["capitalAmount"];
		$fields["DOSS_OWNER_ID"]	= $data_main["onwerIdcard"];
		$fields["WORK_GROUP"]		= $data_main["workGroup"];
		$fields["DOSS_OWNER_NAME"]	= $data_main["onwerName"];
		$fields["PLAINTIFF1"]		= $data_main["plaintiff"];
		$fields["DEFFENDANT1"]		= $data_main["deffendant"];

		if ($dataSelectData["WH_BANKRUPT_ID"] > 0) {
			db::db_update("WH_BANKRUPT_CASE_DETAIL", $fields, array('WH_BANKRUPT_ID' => $dataSelectData["WH_BANKRUPT_ID"]));
			$WH_BANKRUPT_ID = $dataSelectData["WH_BANKRUPT_ID"];
		} else {
			$WH_BANKRUPT_ID = db::db_insert("WH_BANKRUPT_CASE_DETAIL", $fields, 'WH_BANKRUPT_ID', 'WH_BANKRUPT_ID');
		}

		db::db_delete(
			"WH_COURT_LOG",
			array(
				'COURT_SYSTEM_TYPE' => '2',
				'MAIN_ID_PK' => $brcId,
				// 'BLACK_CASE' => $data_main["blackCase"],
				// 'BLACK_YY' => $data_main["blackYy"],
				// 'RED_CASE' => $data_main["redCase"],
				// 'RED_YY' => $data_main["redYy"]
			)
		);

		$listExecuteCase = array();
		if (isset($data_main['courtOrderHis']) && count($data_main['courtOrderHis']) > 0) {
			foreach ($data_main['courtOrderHis'] as $key => $datacourtOrderHis) {
				unset($fields);
				$fields["COURT_CODE"]			= $data_main["courtCode"];
				$fields["COURT_NAME"]			= $data_main["courtName"];
				$fields["PREFIX_BLACK_CASE"]	= $data_main["prefixBlackCase"];
				$fields["BLACK_CASE"]			= $data_main["blackCase"];
				$fields["BLACK_YY"]				= $data_main["blackYy"];
				$fields["PREFIX_RED_CASE"]		= $data_main["prefixRedCase"];
				$fields["RED_CASE"]				= $data_main["redCase"];
				$fields["RED_YY"]				= $data_main["redYy"];
				$fields["MAIN_ID_PK"]			= $data_main["bankruptCode"];	// $brcId
				$fields["COURT_SYSTEM_TYPE"]	= 2;
				$fields["COURT_DATE"]			= substr($datacourtOrderHis["courtOrderDate"], 0, 10);
				$fields["COURT_DETAIL"]			= $datacourtOrderHis["annName"];
				$fields["COURT_REGISTER_CODE"]	= $datacourtOrderHis["registerCode"];
				$fields["ANN_GAZETTE_DATE"]		= substr($datacourtOrderHis["annGazetteDate"], 0, 10);
				$fields["ANN_NEWSPAPER_DATE"]	= substr($datacourtOrderHis["annNewspaperDate"], 0, 10);
				$fields["ANN_BOOK_NO"]			= $datacourtOrderHis["annBookNo"];
				$fields["ANN_LESSON_NO"]		= $datacourtOrderHis["annLessonNo"];
				$fields["ANN_PAGE_NO"]			= $datacourtOrderHis["annPageNo"];
				$fields["ANN_LIMIT_DAY"]		= $datacourtOrderHis["annLimitDay"];
				$fields["NEW_NAME"]				= $datacourtOrderHis["newsName"];

				if (
					$datacourtOrderHis["annName"] == 'คำสั่งพิทักษ์ทรัพย์เด็ดขาด' ||
					$datacourtOrderHis["annName"] == 'คำสั่งพิทักษ์ทรัพย์ชั่วคราว' ||
					$datacourtOrderHis["annName"] == 'คำพิพากษาจัดการทรัพย์มรดก' ||
					$datacourtOrderHis["annName"] == 'ยกเลิกประนอมหนี้ก่อนล้มและพิพากษาล้มละลาย' ||
					$datacourtOrderHis["annName"] == 'ยกเลิกประนอมหนี้หลังล้มและพิพากษาล้มละลาย' ||
					$datacourtOrderHis["annName"] == 'พิพากษาล้มละลาย' ||
					$datacourtOrderHis["annName"] == 'พิทักษ์ทรัพย์เด็ดขาดและจัดการทรัพย์มรดก' ||
					$datacourtOrderHis["annName"] == 'เห็นชอบการประนอมหนี้หลังล้มละลายและยกเลิกการล้มละลาย'
				) {
					$fields["ORD_STATUS"] = 'บังคับคดี';
					$listExecuteCase[strval($datacourtOrderHis["registerCode"])] = 'บังคับคดี';
				} else {
					$fields["ORD_STATUS"] = 'ไม่บังคับคดี';
					$listExecuteCase[strval($datacourtOrderHis["registerCode"])] = 'ไม่บังคับคดี';
				}

				db::db_insert("WH_COURT_LOG", $fields, 'WH_COURT_LOG_ID', 'WH_COURT_LOG_ID');
			}
		}


		//person คนในคดี
		db::db_delete("WH_BANKRUPT_CASE_PERSON", array('WH_BANKRUPT_ID' => $WH_BANKRUPT_ID));

		if (isset($data_main['person']) && count($data_main['person']) > 0) {
			foreach ($data_main['person'] as $key => $data_person) {
				unset($fields);
				$fields["WH_BANKRUPT_ID"]	= $WH_BANKRUPT_ID;
				$fields["PERSON_CODE"]		= $data_person["perIdDockett"];
				$fields["REGISTER_CODE"]	= (trim($data_person['perIdcard']) != '') ? $data_person["perIdcard"] : $data_person["perCompanyCode"];
				$fields["PREFIX_CODE"]		= $data_person["titleId"];
				$fields["PREFIX_NAME"]		= $data_person["titleName"];
				$fields["FIRST_NAME"]		= (trim($data_person["firstName"]) != "") ? $data_person["firstName"] : $data_person["perFullname"];
				$fields["LAST_NAME"]		= $data_person["lastName"];
				$fields["COURT_CODE"]		= $data_main["courtCode"];
				$fields["COURT_NAME"]		= $data_main["courtName"];
				$fields["DEPT_CODE"]		= $data_main["deptCode"];
				$fields["DEPT_NAME"]		= $data_main["deptName"];
				$fields["PREFIX_BLACK_CASE"] = $data_main["prefixBlackCase"];
				$fields["BLACK_CASE"]		= $data_main["blackCase"];
				$fields["BLACK_YY"]			= $data_main["blackYy"];
				$fields["PREFIX_RED_CASE"]	= $data_main["prefixRedCase"];
				$fields["RED_CASE"]			= $data_main["redCase"];
				$fields["RED_YY"]			= $data_main["redYy"];
				$fields["ADDRESS"]			= $data_person["address"];
				$fields["TUM_CODE"]			= $data_person["tumCode"];
				$fields["TUM_NAME"]			= $data_person["tumName"];
				$fields["AMP_CODE"]			= $data_person["ampCode"];
				$fields["AMP_NAME"]			= $data_person["ampName"];
				$fields["PROV_CODE"]		= $data_person["provCode"];
				$fields["PROV_NAME"]		= $data_person["provName"];
				$fields["ZIP_CODE"]			= $data_person["zipCode"];
				$fields["PERSON_TYPE"]		= $data_person["perPartyCategory"];
				$fields["CONCERN_CODE"]		= ($data_person["preCode"] == '06') ? '02' : $data_person["preCode"];
				$fields["CONCERN_NAME"]		= ($data_person["courtSeq"]) ? $data_person["preName"] : $data_person["preP4hName"];
				$fields["CONERNSEQ"]		= ($data_person["courtSeq"]) ? $data_person["courtSeq"] : $data_person["plaintiffSeq"];
				$fields["COMP_PAY_DEPT_DATE"] = substr($data_person["appDate"], 0, 10);
				$fields["DOP_PLAINTIFF_COURT_FLAG"]	= $data_person["dopPlaintiffCourtFlag"];
				$fields["PER_ID"]			= $data_person["perId"];
				// ขอรับในฐานะ >> BR101002 หน้าค้นหาหมายเลขคดีและจำเลย
				$fields["PLAINTIFF_STATUS"]	= ($data_person["ledName"]) ? $data_person["rstInsuranceName"] . ' ม.' . $data_person["ledName"] : '';
				$fields["PLAINTIFF_AMOUNT"]	= $data_person["docReceiveMoney"];	//  จำนวนหนี้ขอรับชำระ(บาท) >> BR101002 หน้าค้นหาหมายเลขคดีและจำเลย

				if ($data_person["preCode"] == '06') {
					if ($listExecuteCase[strval($fields["REGISTER_CODE"])] == 'บังคับคดี') {
						$fields["LOCK_PERSON_STATUS_TEXT"] = "บุคคลล้มละลาย";
						$fields["PER_ORDER_STATUS"] = "บังคับคดี";
					} else {
						$fields["LOCK_PERSON_STATUS_TEXT"] = "ไม่เป็นบุคคลล้มละลาย";
						$fields["PER_ORDER_STATUS"] = "ไม่บังคับคดี";
					}
				}

				db::db_insert("WH_BANKRUPT_CASE_PERSON", $fields, 'WH_PERSON_ID', 'WH_PERSON_ID');
			}
		}

		// .person

		// สถานะของคนกรณีอยู่ในสำนวนต่างๆ
		db::db_delete("WH_BANKRUPT_PERSON_CONN", array('BANKRUPT_CODE' => $data_main["bankruptCode"]));

		if (isset($data_main["personConcern"]) && count($data_main["personConcern"]) > 0) {
			foreach ($data_main["personConcern"] as $key => $personConcern) {
				unset($fields);
				$fields["BANKRUPT_CODE"]    = $data_main["bankruptCode"];
				$fields["DOP_ID_PK"]        = $personConcern["perId"];
				$fields["DOCKETT_ID"]       = $personConcern["dockettId"];
				$fields["PERSON_CODE"]      = $personConcern["perIdDockett"];
				$fields["PER_FULLNAME"]     = $personConcern["perFullname"];
				$fields["DOCKET_NAME"]      = $personConcern["dtyName"];
				db::db_insert("WH_BANKRUPT_PERSON_CONN", $fields);
			}
		}
		// .สถานะของคนกรณีอยู่ในสำนวนต่างๆ


		// BR020104 ข้อมูลคำสั่งศาล/คำพิพากษา 
		db::db_delete("WH_BANKRUPT_COURT_LOG", array('BRC_ID_PK' => $data_main["bankruptCode"]));
		db::db_delete("WH_BANKRUPT_COURT_LOG_PERSON", array('BRC_ID_PK' => $data_main["bankruptCode"]));

		if (isset($data_main["BR02104"]) && count($data_main["BR02104"]) > 0) {
			foreach ($data_main["BR02104"] as $keyCl => $valCl) {
				unset($fields);
				$fields["BRC_ID_PK"]			= $data_main["bankruptCode"];
				$fields["DOC_COR_ID_FK"]		= $valCl["docCorIdFk"];
				$fields["RECEIPT_DOC"]			= $valCl["docReceivedNumber"];
				$fields["DOC_NUMBER"]      		= $valCl["docNumber"];
				$fields["RECEIPT_DATE"]			= substr($valCl["docReceivedDate"], 0, 10);
				$fields["DOC_DATE"]				= substr($valCl["docDate"], 0, 10);
				$fields["DOC_FROM_NAME"]		= $valCl["docFromName"];
				$fields["DOT_NAME"]				= $valCl["dotName"];
				$fields["DOC_SUBJECT"]			= $valCl["docSubject"];
				$fields["DOC_STATUS"]			= $valCl["docStatus"];
				$fields["DOC_STATUS_NAME"]		= $valCl["docStatusName"];
				$fields["COR_ORDER_DATE"]		= substr($valCl["corOrderDate"], 0, 10);
				$fields["BRC_PROPERTY_NUM"]		= $valCl["brcPropertyNum"];
				$fields["BRC_LODGE_DATE"]		= substr($valCl["brcLodgeDate"], 0, 10);
				db::db_insert("WH_BANKRUPT_COURT_LOG", $fields);

				if (isset($valCl["detail"]) && count($valCl["detail"]) > 0) {
					foreach ($valCl["detail"] as $keyDetail => $valDetail) {
						$fieldSub["BRC_ID_PK"]			= $data_main["bankruptCode"];
						$fieldSub["DOC_COR_ID_FK"]		= $valDetail["docCorIdFk"];
						$fieldSub["DOP_PTY_ID_FK"]		= $valDetail["dopPtyIdFk"];
						$fieldSub["PERSON_CODE"]		= $valDetail["personCode"];
						$fieldSub["PRE_NAME"]			= $valDetail["preName"];
						$fieldSub["DOT_ID_PK"]			= $valDetail["dotIdPk"];
						$fieldSub["DOP_ID_PK"]			= $valDetail["pdcDopId"];
						$fieldSub["DEFFENDANT_NO"]		= $valDetail["pdcCourtSeq"];
						$fieldSub["DEFFENDANT_REG_NO"]	= $valDetail["deffendantRegNo"];
						$fieldSub["DEFFENDANT_NAME"]	= $valDetail["pdcAliasname"];
						$fieldSub["BANKRUPT_NO"]		= $valDetail["pdcAftNo"];
						$fieldSub["PDC_APPNTMNT_TYPE_CODE"]		= $valDetail["pdcAppntmntTypeCode"];
						$fieldSub["PDC_APT_COMPOUND"]	= $valDetail["pdcAptCompound"];
						$fieldSub["DOC_FROM_NAME"]		= $valDetail["docFromName"];
						$fieldSub["DOC_BRCASE_DOCKETT_ID"]		= $valDetail["docBrcaseDockettId"];
						$fieldSub["COR_ORDER_DATE"]		= substr($valDetail["corOrderDate"], 0, 10);
						$fieldSub["OCC_NAME"]			= $valDetail["occName"];
						$fieldSub["COT_NAME"]			= $valDetail["cotName"];
						$fieldSub["APP_DATE1"]			= substr($valDetail["appDate1"], 0, 10);
						$fieldSub["APP_TIME1"]			= $valDetail["appTime1"];
						$fieldSub["APP_DATE2"]			= substr($valDetail["appDate2"], 0, 10);
						$fieldSub["APP_TIME2"]			= $valDetail["appTime2"];

						db::db_insert("WH_BANKRUPT_COURT_LOG_PERSON", $fieldSub);
					}
				}
			}
		}
		// .BR020104 ข้อมูลคำสั่งศาล/คำพิพากษา 


		// BR101001 หน้าค้นหาหมายเลขคดีและจำเลย
		db::db_delete("WH_BANKRUPT_COURT_DATE", array('BANKRUPT_CODE' => $data_main["bankruptCode"]));

		if (isset($data_main["BR101001"]) && count($data_main["BR101001"]) > 0) {
			foreach ($data_main["BR101001"] as $keyOl => $valOl) {
				unset($fields);
				$fields["BANKRUPT_CODE"]			= $data_main["bankruptCode"];
				$fields["BR_CASE_PARTY_ID"]			= $valOl["brCasePartyId"];
				$fields["BRC_IMPORT_FLAG"]			= $valOl["brcImportFlag"];
				$fields["DOP_COURT_SEQ"]			= $valOl["dopCourtSeq"];
				$fields["BRC_COURT_ID"]				= $valOl["brcCourtId"];
				$fields["BRC_RECV_NO"]				= $valOl["brcRecvNo"];
				$fields["BRC_RECV_YR"]				= $valOl["brcRecvYr"];
				$fields["PERSON_CODE"]				= $valOl["personCode"];
				$fields["PER_FULLNAME"]				= $valOl["perFullname"];
				$fields["BRC_SUBJECT_NUM"]			= $valOl["brcSubjectNum"];
				$fields["BRC_BLACK_CASE_CODE"]		= $valOl["brcBlackCaseCode"];
				$fields["BRC_RED_CASE_CODE"]		= $valOl["brcRedCaseCode"];
				$fields["BRP_PLAINTIFF1"]			= $valOl["brpPlaintiff1"];
				$fields["BRP_PLAINTIFF2"]			= $valOl["brpPlaintiff2"];
				$fields["BRP_PLAINTIFF3"]			= $valOl["brpPlaintiff3"];
				// --------------------------------------------------------------------------------
				$fields["TEMP_RECEIVERSHIP_DATE"]	= ($valOl["1_1_1"]) ? $valOl["1_1_1"] : '';		// วันพิทักษ์ทรัพย์ชั่วคราว
				$fields["TEMP_GAZETTE_DATE"]		= ($valOl["1_1_2"]) ? $valOl["1_1_2"] : '';		// วันประกาศราชกิจจาฯ
				$fields["TEMP_GAZETTE_NO"]			= $valOl["1_1_3"];								// ประกาศราชกิจจาฯ เล่มที่ 
				$fields["TEMP_GAZETTE_EP"]			= $valOl["1_1_4"];								// ประกาศราชกิจจาฯ ตอนที่ 
				$fields["TEMP_GAZETTE_PAGE"]		= $valOl["1_1_5"];								// ประกาศราชกิจจาฯ หน้า 
				// --------------------------------------------------------------------------------
				$fields["TEMP_REVOKE_RECE_DATE"]	= ($valOl["2_1_1"]) ? $valOl["2_1_1"] : '';		// วันถอนพิทักษ์ทรัพย์ชั่วคราว
				$fields["TEMP_REVOKE_GAZETTE_DATE"]	= ($valOl["2_1_2"]) ? $valOl["2_1_2"] : '';		// วันประกาศราชกิจจาฯ
				$fields["TEMP_REVOKE_GAZETTE_NO"]	= $valOl["2_1_3"];								// ประกาศราชกิจจาฯ เล่มที่ 
				$fields["TEMP_REVOKE_GAZETTE_EP"]	= $valOl["2_1_4"];								// ประกาศราชกิจจาฯ ตอนที่ 
				$fields["TEMP_REVOKE_GAZETTE_PAGE"]	= $valOl["2_1_5"];								// ประกาศราชกิจจาฯ หน้า 
				// --------------------------------------------------------------------------------
				$fields["RECEIVERSHIP_DATE"]		= ($valOl["3_1_1"]) ? $valOl["3_1_1"] : '';		// วันพิทักษ์ทรัพย์เด็ดขาด
				$fields["RECE_GAZETTE_DATE"]		= ($valOl["3_1_2"]) ? $valOl["3_1_2"] : '';		// วันประกาศราชกิจจาฯ
				$fields["RECE_GAZETTE_NO"]			= $valOl["3_1_3"];								// ประกาศราชกิจจาฯ เล่มที่ 
				$fields["RECE_GAZETTE_EP"]			= $valOl["3_1_4"];								// ประกาศราชกิจจาฯ ตอนที่ 
				$fields["RECE_GAZETTE_PAGE"]		= $valOl["3_1_5"];								// ประกาศราชกิจจาฯ หน้า 
				$fields["RECE_DUE_DATE"]			= ($valOl["3_1_6"]) ? $valOl["3_1_6"] : '';		// วันครบกำหนดยื่นคำขอรับชำระหนี้ 
				$fields["RECE_APP_DATE"]			= ($valOl["3_1_7"]) ? $valOl["3_1_7"] : '';		// นัดตรวจคำขอรับชำระหนี้
				// --------------------------------------------------------------------------------
				$fields["REVOKE_RECE_DATE"]			= ($valOl["4_1_1"]) ? $valOl["4_1_1"] : '';		// วันถอนพิทักษ์ทรัพย์เด็ดขาด 
				$fields["REVOKE_GAZETTE_DATE"]		= ($valOl["4_1_2"]) ? $valOl["4_1_2"] : '';		// วันประกาศราชกิจจาฯ
				$fields["REVOKE_GAZETTE_NO"]		= $valOl["4_1_3"];								// ประกาศราชกิจจาฯ เล่มที่
				$fields["REVOKE_GAZETTE_EP"]		= $valOl["4_1_4"];								// ประกาศราชกิจจาฯ ตอนที่ 
				$fields["REVOKE_GAZETTE_PAGE"]		= $valOl["4_1_5"];								// ประกาศราชกิจจาฯ หน้า 
				// --------------------------------------------------------------------------------
				$fields["COMPROMISE_BEFORE_DATE"]	= ($valOl["5_1_1"]) ? $valOl["5_1_1"] : '';		// วันประนอมหนี้ก่อนล้มละลาย
				$fields["COMP_BEFORE_GAZETTE_DATE"]	= ($valOl["5_1_2"]) ? $valOl["5_1_2"] : '';		// วันประกาศราชกิจจาฯ
				$fields["COMP_BEFORE_GAZETTE_NO"]	= $valOl["5_1_3"];								// ประกาศราชกิจจาฯ เล่มที่ 
				$fields["COMP_BEFORE_GAZETTE_EP"]	= $valOl["5_1_4"];								// ประกาศราชกิจจาฯ ตอนที่ 
				$fields["COMP_BEFORE_GAZETTE_PAGE"]	= $valOl["5_1_5"];								// ประกาศราชกิจจาฯ หน้า 
				// --------------------------------------------------------------------------------
				$fields["CANCEL_BEFORE_DATE"]		= ($valOl["6_1_1"]) ? $valOl["6_1_1"] : '';		// วันยกเลิกประนอมหนี้ก่อนล้มฯและพิพากษาให้ล้มฯ
				$fields["CC_BEFORE_GAZETTE_DATE"]	= ($valOl["6_1_2"]) ? $valOl["6_1_2"] : '';		// วันประกาศราชกิจจาฯ
				$fields["CC_BEFORE_GAZETTE_NO"]		= $valOl["6_1_3"];								// ประกาศราชกิจจาฯ เล่มที่ 
				$fields["CC_BEFORE_GAZETTE_EP"]		= $valOl["6_1_4"];								// ประกาศราชกิจจาฯ ตอนที่ 
				$fields["CC_BEFORE_GAZETTE_PAGE"]	= $valOl["6_1_5"];								// ประกาศราชกิจจาฯ หน้า 
				$fields["CC_BEFORE_DUE_DATE"]		= ($valOl["6_1_6"]) ? $valOl["6_1_6"] : '';		// วันครบกำหนดยื่นคำขอรับชำระหนี้ 
				$fields["CC_BEFORE_APP_DATE"]		= ($valOl["6_1_7"]) ? $valOl["6_1_7"] : '';		// นัดตรวจคำขอรับชำระหนี้
				// --------------------------------------------------------------------------------
				$fields["COMPROMISE_AFTER_DATE"]	= ($valOl["7_1_1"]) ? $valOl["7_1_1"] : '';		// วันประนอมหนี้หลังล้มละลาย
				$fields["COMP_AFTER_GAZETTE_DATE"]	= ($valOl["7_1_2"]) ? $valOl["7_1_2"] : '';		// วันประกาศราชกิจจาฯ
				$fields["COMP_AFTER_GAZETTE_NO"]	= $valOl["7_1_3"];								// ประกาศราชกิจจาฯ เล่มที่ 
				$fields["COMP_AFTER_GAZETTE_EP"]	= $valOl["7_1_4"];								// ประกาศราชกิจจาฯ ตอนที่ 
				$fields["COMP_AFTER_GAZETTE_PAGE"]	= $valOl["7_1_5"];								// ประกาศราชกิจจาฯ หน้า 
				// --------------------------------------------------------------------------------
				$fields["CANCEL_AFTER_DATE"]		= ($valOl["8_1_1"]) ? $valOl["8_1_1"] : '';		// วันยกเลิกประนอมหนี้หลังล้มฯและพิพากษาให้ล้มฯ 
				$fields["CC_AFTER_GAZETTE_DATE"]	= ($valOl["8_1_2"]) ? $valOl["8_1_2"] : '';		// วันประกาศราชกิจจาฯ
				$fields["CC_AFTER_GAZETTE_NO"]		= $valOl["8_1_3"];								// ประกาศราชกิจจาฯ เล่มที่ 
				$fields["CC_AFTER_GAZETTE_EP"]		= $valOl["8_1_4"];								// ประกาศราชกิจจาฯ ตอนที่ 
				$fields["CC_AFTER_GAZETTE_PAGE"]	= $valOl["8_1_5"];								// ประกาศราชกิจจาฯ หน้า 
				$fields["CC_AFTER_DUE_DATE"]		= ($valOl["8_1_6"]) ? $valOl["8_1_6"] : '';		// วันครบกำหนดยื่นคำขอรับชำระหนี้ 
				$fields["CC_AFTER_APP_DATE"]		= ($valOl["8_1_7"]) ? $valOl["8_1_7"] : '';		// นัดตรวจคำขอรับชำระหนี้
				// --------------------------------------------------------------------------------
				$fields["JUDGMENT_DATE"]			= ($valOl["9_1_1"]) ? $valOl["9_1_1"] : '';		// วันพิพากษาให้ล้มละลาย
				$fields["JUDG_GAZETTE_DATE"]		= ($valOl["9_1_2"]) ? $valOl["9_1_2"] : '';		// วันประกาศราชกิจจาฯ
				$fields["JUDG_GAZETTE_NO"]			= $valOl["9_1_3"];								// ประกาศราชกิจจาฯ เล่มที่
				$fields["JUDG_GAZETTE_EP"]			= $valOl["9_1_4"];								// ประกาศราชกิจจาฯ ตอนที่ 
				$fields["JUDG_GAZETTE_PAGE"]		= $valOl["9_1_5"];								// ประกาศราชกิจจาฯ หน้า 
				// --------------------------------------------------------------------------------
				$fields["CANCEL_DATE"]				= ($valOl["10_1_1"]) ? $valOl["10_1_1"] : '';	// วันยกเลิกการล้มละลาย
				$fields["CANCEL_GAZETTE_DATE"]		= ($valOl["10_1_2"]) ? $valOl["10_1_2"] : '';	// วันประกาศราชกิจจาฯ
				$fields["CANCEL_GAZETTE_NO"]		= $valOl["10_1_3"];								// ประกาศราชกิจจาฯ เล่มที่
				$fields["CANCEL_GAZETTE_EP"]		= $valOl["10_1_4"];								// ประกาศราชกิจจาฯ ตอนที่ 
				$fields["CANCEL_GAZETTE_PAGE"]		= $valOl["10_1_5"];								// ประกาศราชกิจจาฯ หน้า 
				// --------------------------------------------------------------------------------
				$fields["DISCHARGE_DATE"]			= ($valOl["11_1_1"]) ? $valOl["11_1_1"] : '';	// วันปลดการล้มละลาย
				$fields["DISC_GAZETTE_DATE"]		= ($valOl["11_1_2"]) ? $valOl["11_1_2"] : '';	// วันประกาศราชกิจจาฯ
				$fields["DISC_GAZETTE_NO"]			= $valOl["11_1_3"];								// ประกาศราชกิจจาฯ เล่มที่ 
				$fields["DISC_GAZETTE_EP"]			= $valOl["11_1_4"];								// ประกาศราชกิจจาฯ ตอนที่ 
				$fields["DISC_GAZETTE_PAGE"]		= $valOl["11_1_5"];								// ประกาศราชกิจจาฯ หน้า 
				// --------------------------------------------------------------------------------
				$fields["COURT_INHERITANCE_DATE"]	= $valOl["12_1_1"];								// วันที่ศาลสั่งให้จัดการทรัพย์มรดก 
				// --------------------------------------------------------------------------------
				$fields["CC_INHERITANCE_DATE"]		= $valOl["13_1_1"];								// วันยกเลิกจัดการทรัพย์มรดก 
				// --------------------------------------------------------------------------------
				$fields["CONSIDER_NEW_DATE"]		= $valOl["14_1_1"];								// วันพิจารณาคดีใหม่
				// --------------------------------------------------------------------------------
				$fields["DISMISS_DATE"]				= $valOl["15_1_1"];								// วันยกฟ้อง
				// --------------------------------------------------------------------------------
				$fields["DISTRIBUTE_DATE"]			= $valOl["16_1_1"];								// วันจำหน่ายคดี
				// --------------------------------------------------------------------------------
				$fields["CLOSED_DATE"]				= $valOl["17_1_1"];								// วันปิดคดี
				// --------------------------------------------------------------------------------
				$fields["DISRUPT_DATE"]				= null;											// วันที่ปลดทำลาย
				// --------------------------------------------------------------------------------
				$fields["COMPLAINT_DATE"]			= $valOl["19_1_1"];								// วันที่ฟ้อง
				// --------------------------------------------------------------------------------
				$fields["ESCAPE_DATE"]				= $valOl["19_1_2"];								// วันที่ลูกหนี้พ้นจากการเป็นบุคคลล้มละลาย
				// --------------------------------------------------------------------------------

				db::db_insert("WH_BANKRUPT_COURT_DATE", $fields);
			}
		}
		// .BR101001 หน้าค้นหาหมายเลขคดีและจำเลย

		// การขายทรัพย์
		db::db_delete("WH_BANKRUPT_ASSETS_AUCTION", array('BANKRUPT_CODE' => $data_main["bankruptCode"]));
		db::db_delete("WH_BANKRUPT_ASSETS_SALE", array('BANKRUPT_CODE' => $data_main["bankruptCode"]));

		if (isset($data_main["assetSaleResult"]) && count($data_main["assetSaleResult"]) > 0) {
			foreach ($data_main["assetSaleResult"] as $key => $SaleResult) {
				unset($fields);
				$fields["WH_BANKRUPT_ID"]			= $WH_BANKRUPT_ID;
				$fields["BANKRUPT_CODE"]			= $data_main["bankruptCode"];
				$fields["DEP_NAME"]					= $SaleResult["depName"];
				$fields["BRA_BRC_ID_FK"]			= $SaleResult["braBrcIdFk"];
				$fields["BRD_BRK_ID_FK"]			= $SaleResult["brdBrkIdFk"];
				$fields["ASS_ID_PK"]				= $SaleResult["assIdPk"];
				$fields["SGA_SGP_ID_FK"]			= $SaleResult["sgaSgpIdFk"];
				$fields["ADD_STATUS"]				= $SaleResult["addStatus"];
				$fields["ADD_PH4_AUC_SALE_STATUS"]	= $SaleResult["addPh4AucSaleStatus"];
				$fields["ADD_PH4_AUC_LOT_ID"]		= $SaleResult["addPh4AucLotId"];
				$fields["SAT_NAME"]					= $SaleResult["satName"];
				$fields["SAM_CODE"]					= $SaleResult["samCode"];
				$fields["EST_NAME"]					= $SaleResult["estName"];
				$fields["AESP_PRICE"]				= $SaleResult["aespPrice"];
				$fields["NUM_SALE_ASSET"]			= $SaleResult["numSaleAsset"];
				$fields["ASS_DISPLAY_NAME"]			= $SaleResult["assDisplayName"];
				$fields["BUYER_ASSET"]				= $SaleResult["buyerAsset"];
				$fields["LOT_NAME"]					= $SaleResult["lotName"];
				$fields["SALES_BY"]					= $SaleResult["salesBy"];
				$fields["ADD_STATUS_NAME"]			= $SaleResult["addStatusName"];
				$fields["SRE_SALE_AMOUNT"]			= $SaleResult["sreSaleAmount"];
				$fields["SRE_SALE_DUTY_PERCENT"]	= $SaleResult["sreSaleDutyPercent"];
				$fields["SRE_SALE_DUTY_AMOUNT"]		= $SaleResult["sreSaleDutyAmount"];
				$fields["SRE_SALE_VAT_PERCENT"]		= $SaleResult["sreSaleVatPercent"];
				$fields["SRE_SALE_VAT_AMOUNT"]		= $SaleResult["sreSaleVatAmount"];
				$fields["SRE_OFFSET_AMOUNT"]		= $SaleResult["sreOffsetAmount"];
				$fields["SUM_MONEY_BY"]				= $SaleResult["sumMoneyBy"];
				$fields["SUM_MONEY_WITH_OFFSET"]	= $SaleResult["sumMoneyWithOffset"];
				$fields["BRK_DTY_ID_FK"]			= $SaleResult["brkDtyIdFk"];
				db::db_insert("WH_BANKRUPT_ASSETS_AUCTION", $fields);

				if (isset($SaleResult['aucLotAppointments']) && count($SaleResult['aucLotAppointments']) > 0) {
					foreach ($SaleResult["aucLotAppointments"] as $keyAucLotAppointments => $aucLotAppointments) {
						unset($fields);
						$fieldsSub["WH_BANKRUPT_ID"]		= $WH_BANKRUPT_ID;
						$fieldsSub["SGA_SGP_ID_FK"]			= $SaleResult["sgaSgpIdFk"];
						$fieldsSub["BANKRUPT_CODE"]			= $data_main["bankruptCode"];
						$fieldsSub["BRD_BRK_ID_FK"]			= $SaleResult["brdBrkIdFk"];
						$fieldsSub["ASS_ID_PK"]				= $SaleResult["assIdPk"];
						$fieldsSub["ALE_EVENT_NUM"]			= $aucLotAppointments["aleEventNum"];
						$fieldsSub["ALE_DATE"]				= substr($aucLotAppointments["aleDate"], 0, 10);
						$fieldsSub["PRICE_PERCENT_AMT"]		= $aucLotAppointments["pricePercentAmt"];
						$fieldsSub["SALE_RESULT_TYPE_CODE"]		= $aucLotAppointments["saleResultTypeCode"];
						$fieldsSub["SALE_RESULT_TYPE_NAME"]		= $aucLotAppointments["saleResultTypeName"];
						$fieldsSub["SALE_RESULT_DETAIL_CODE"]	= $aucLotAppointments["saleResultDetailCode"];
						$fieldsSub["SALE_RESULT_DETAIL_NAME"]	= $aucLotAppointments["saleResultDetailName"];
						db::db_insert("WH_BANKRUPT_ASSETS_SALE", $fieldsSub);
					}
				}
			}
		}
		// .การขายทรัพย์

		db::db_delete("WH_BANKRUPT_DOCKET", array('WH_BANKRUPT_ID' => $WH_BANKRUPT_ID));
		db::db_delete("WH_BANKRUPT_BALANCE_PERSON", array('WH_BANKRUPT_ID' => $WH_BANKRUPT_ID));

		if (isset($data_main['docket']) && count($data_main['docket']) > 0) {
			foreach ($data_main['docket'] as $key => $data_docket) {
				unset($fields);
				$fields["WH_BANKRUPT_ID"]	= $WH_BANKRUPT_ID;
				$fields["BANKRUPT_CODE"]	= $data_docket["brcaseId"];
				$fields["DOCKET_TYPE"]		= $data_docket["dockettTypeCode"];
				$fields["DOCKET_NAME"]		= $data_docket["dockettTypeName"];
				$fields["DOCKET_SUBJECT"]	= $data_docket["dockettSubject"];
				$fields["DOCKET_OWNER"]		= $data_docket["userOwnerName"];
				$fields["DOCKET_CODE"]		= $data_docket["dockettId"];
				db::db_insert("WH_BANKRUPT_DOCKET", $fields, 'DOCKET_ID', 'DOCKET_ID');

				unset($fields);
				$fields["WH_BANKRUPT_ID"]		= $WH_BANKRUPT_ID;
				$fields["COURT_CODE"]			= $data_main["courtCode"];
				$fields["PREFIX_BLACK_CASE"]	= $data_main["prefixBlackCase"];
				$fields["BLACK_CASE"]			= $data_main["blackCase"];
				$fields["BLACK_YY"]				= $data_main["blackYy"];
				$fields["PREFIX_RED_CASE"]		= $data_main["prefixRedCase"];
				$fields["RED_CASE"]				= $data_main["redCase"];
				$fields["RED_YY"]				= $data_main["redYy"];
				$fields["DOCKET_CODE"]			= $data_docket["dockettId"];

				if ($data_docket["dockettTypeCode"] == '07') {
					$fields["BR_CASE_PERSON_REGISTER_CODE"] = $data_docket['dockettDebtor'][0]["perIdPk"];
				} else if ($data_docket["dockettTypeCode"] == '12') {
					$fields["CVC_ID_PK"] = $data_docket['dockettCivilDetail'][0]["cvcIdPk"];
					$fields["CVC_DOCKET_ID"] = $data_docket['dockettCivilDetail'][0]["cvcBrcaseDockettRefId"];
					$fields["CVC_CAPITAL"] = $data_docket['dockettCivilDetail'][0]["cvcCapital"];
					$fields["CVC_COMPLAIN_DATE"] = substr($data_docket["dockettCivilDetail"][0]["cvcComplainDate"], 0, 10);
					$fields["CVC_DATE"] = substr($data_docket["dockettCivilDetail"][0]["cvcDate"], 0, 10);
					$fields["CVC_DEFENDANT"] = $data_docket['dockettCivilDetail'][0]["cvcDefendant"];
					$fields["CVC_PREFIX_RED_CASE"] = $data_docket['dockettCivilDetail'][0]["cvcMajorRedCaseCode"];
					$fields["CVC_RED_CASE"] = $data_docket['dockettCivilDetail'][0]["cvcMinorRedCaseCode"];
					$fields["CVC_PREFIX_BLACK_CASE"] = $data_docket['dockettCivilDetail'][0]["cvcMajorBlackCaseCode"];
					$fields["CVC_BLACK_CASE"] = $data_docket['dockettCivilDetail'][0]["cvcMinorBlackCaseCode"];
					$fields["CVC_OPPONENT"] = $data_docket['dockettCivilDetail'][0]["cvcOpponent"];
					$fields["CVC_PETITIONER"] = $data_docket['dockettCivilDetail'][0]["cvcPetitioner"];
					$fields["CVC_PLAINTIFF"] = $data_docket['dockettCivilDetail'][0]["cvcPlaintiff"];
					$fields["CVC_STATUS"] = $data_docket['dockettCivilDetail'][0]["cvcStatus"];
					$fields["CVC_CCT_ID_FK"] = $data_docket['dockettCivilDetail'][0]["cvcCctIdFk"];
					$fields["CVC_CUT_ID_FK"] = $data_docket['dockettCivilDetail'][0]["cvcCutIdFk"];
					$fields["CVC_BRD_ID_FK"] = $data_docket['dockettCivilDetail'][0]["cvcBrdIdFk"];
					$fields["CVC_DOB_ID_FK"] = $data_docket['dockettCivilDetail'][0]["cvcDobIdFk"];
					$fields["CVC_DFR_ID_FK"] = $data_docket['dockettCivilDetail'][0]["cvcDfrIdFk"];
					$fields["CVC_CCT_NAME"] = $data_docket['dockettCivilDetail'][0]["cctName"];
					$fields["CVC_CUT_NAME"] = $data_docket['dockettCivilDetail'][0]["cutName"];
					$fields["CVC_DFR_NAME"] = $data_docket['dockettCivilDetail'][0]["dfrName"];
				} else {
					$fields["BR_CASE_PERSON_REGISTER_CODE"] = $data_docket['dockettPetitioner'][0]["perIdPk"];
				}

				db::db_insert("WH_BANKRUPT_BALANCE_PERSON", $fields, 'WH_REH_BAL_ID', 'WH_REH_BAL_ID');
			}
		}


		db::db_delete("WH_BANKRUPT_DOC", array('BANKRUPT_CODE' => $data_main["bankruptCode"]));

		if (isset($data_main["DocFile"]) && count($data_main["DocFile"]) > 0) {
			foreach ($data_main["DocFile"] as $key => $valFile) {
				unset($fields);
				$fields["BANKRUPT_CODE"]	= $data_main["bankruptCode"];
				$fields["COURT_CODE"]		= $data_main["courtCode"];
				$fields["COURT_NAME"]		= $data_main["courtName"];
				$fields["DEPT_CODE"]		= $data_main["deptCode"];
				$fields["DEPT_NAME"]		= $data_main["deptName"];
				$fields["PREFIX_BLACK_CASE"] = $data_main["prefixBlackCase"];
				$fields["BLACK_CASE"]		= $data_main["blackCase"];
				$fields["BLACK_YY"]			= $data_main["blackYy"];
				$fields["PREFIX_RED_CASE"]	= $data_main["prefixRedCase"];
				$fields["RED_CASE"]			= $data_main["redCase"];
				$fields["RED_YY"]			= $data_main["redYy"];
				$fields["DOC_DATE"]			= substr($valFile["dofCreateDate"], 0, 10);
				$fields["DOC_REF_ID"]		= $valFile["dofIdPk"];
				$fields["DOC_NAME"]			= $valFile["dofFileName"];
				$fields["DOF_FILE_TYPE"]	= $valFile["dofFileType"];
				$fields["PLAINTIFF1"]		= $data_main["plaintiff"];
				$fields["DEFFENDANT1"]		= $data_main["deffendant"];
				$fields["RECORD_COUNT"]		= count($data_main["DocFile"]);
				db::db_insert("WH_BANKRUPT_DOC", $fields, 'DOC_ID', 'DOC_ID');
			}
		}


		/* start เพิ่มการบันทึก ทรัพ เเละ ทรัพเป็นของใคร */
		db::db_delete("WH_BANKRUPT_ASSETS", array('WH_BANKRUPT_ID' => $WH_BANKRUPT_ID));

		if (isset($data_main["asset"]) && count($data_main["asset"]) > 0) {

			$sqlAssAssetMapping = "SELECT * FROM M_ASS_ASSET_MAPPING WHERE ASS_TYPE_ID = 2";
			$qryAssAssetMapping = db::query($sqlAssAssetMapping);
			$arrAssAssetMapping = array();

			while ($recAssAssetMapping = db::fetch_array($qryAssAssetMapping)) {
				$arrAssAssetMapping[$recAssAssetMapping['ASSET_BANKRUPT_CODE_1']] = $recAssAssetMapping;
				if ($recAssAssetMapping['ASSET_BANKRUPT_CODE_2']) {
					db::db_delete($recAssAssetMapping['ASSET_BANKRUPT_CODE_2'], array('WH_BANKRUPT_ID' => $WH_BANKRUPT_ID));
				}
			}

			db::db_delete('WH_BANKRUPT_ASSETS_CONDO_AREA', array('WH_BANKRUPT_ID' => $WH_BANKRUPT_ID));

			foreach ($data_main["asset"] as $key => $valAsset) {
				unset($fields);
				$fields["WH_BANKRUPT_ID"]	= $WH_BANKRUPT_ID;
				$fields["PROP_TITLE"]		= $valAsset["assDisplayName"]; //รายละเอียดทรัพย์
				$fields["PROP_STATUS_NAME"]	= $valAsset["asttName"];
				$fields["TYPE_CODE"]		= $valAsset["assAstIdFk"];
				$fields["TYPE_CODE_NAME"]	= $valAsset["astName"];
				$fields["EST_ASSET_PRICE1"]	= $valAsset["improveSellingPrice"];
				$fields["EST_ASSET_PRICE2"]	= $valAsset["treasuryDepartment"];
				$fields["EST_ASSET_PRICE3"]	= $valAsset["appraisalExpert"];
				$fields["EST_ASSET_PRICE4"]	= $valAsset["officialReceiver"];
				$fields["EST_ASSET_PRICE5"]	= $valAsset["appraisalOfficialLed"];
				$fields["EST_ASSET_PRICE6"]	= $valAsset["propertyPriceCommit"];
				$fields["ASSET_ID"]			= $valAsset["assIdPk"];
				$fields["BRA_ID_PK"]		= $valAsset["braIdPk"];
				$fields["SEQUESTER_DATE"]	= substr($valAsset["brdSequestrateDate"], 0, 10);
				$fields["SEQUESTER_TYPE"]	= $valAsset["brdSequestrateName"];
				//คดีดำ
				$fields["PREFIX_BLACK_CASE"] = $data_main["prefixBlackCase"];
				$fields["BLACK_CASE"]		= $data_main["blackCase"];
				$fields["BLACK_YY"]			= $data_main["blackYy"];
				//คดีเเดง
				$fields["PREFIX_RED_CASE"]	= $data_main["prefixRedCase"];
				$fields["RED_CASE"]			= $data_main["redCase"];
				$fields["RED_YY"]			= $data_main["redYy"];

				db::db_insert("WH_BANKRUPT_ASSETS", $fields, 'WH_ASSET_ID', 'WH_ASSET_ID');

				$tableInsertDetail = $arrAssAssetMapping[$valAsset["assAstIdFk"]]['ASSET_BANKRUPT_CODE_2'];
				$fieldInsertDatail = "";

				switch ($valAsset["assAstIdFk"]) {

					case '1': // ที่ดิน

						$fieldInsertDatail = array(
							"LAD_ID_PK" => $valAsset['assetsDetail']['ladIdPk'],
							"LAD_CREATOR" => $valAsset['assetsDetail']['ladCreator'],
							"LAD_CREATOR_ID" => $valAsset['assetsDetail']['ladCreatorId'],
							"LAD_UPDATER" => $valAsset['assetsDetail']['ladUpdater'],
							"LAD_UPDATER_ID" => $valAsset['assetsDetail']['ladUpdaterId'],
							"LAD_ASS_ID_FK" => $valAsset['assetsDetail']['ladAssIdFk'],
							"LAD_STATUS" => $valAsset['assetsDetail']['ladStatus'],
							"LAD_AREA_NGAN" => $valAsset['assetsDetail']['ladAreaNgan'],
							"LAD_AREA_RAI" => $valAsset['assetsDetail']['ladAreaRai'],
							"LAD_AREA_SQWAH" => $valAsset['assetsDetail']['ladAreaSqwah'],
							"LAD_ATD_NAME" => $valAsset['assetsDetail']['ladAtdName'],
							"LAD_DEALING_FILE_NUMBER" => $valAsset['assetsDetail']['ladDealingFileNumber'],
							"LAD_DISTRICT" => $valAsset['assetsDetail']['ladDistrict'],
							"LAD_DISTRICT_CODE" => $valAsset['assetsDetail']['ladDistrictCode'],
							"LAD_MAP_SHEET_NUMBER" => $valAsset['assetsDetail']['ladMapSheetNumber'],
							"LAD_PARCEL_NUMBER" => $valAsset['assetsDetail']['ladParcelNumber'],
							"LAD_PROVINCE" => $valAsset['assetsDetail']['ladProvince'],
							"LAD_PROVINCE_CODE" => $valAsset['assetsDetail']['ladProvinceCode'],
							"LAD_REG_DATE" => ($valAsset['assetsDetail']['ladRegDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['ladRegDate'])) : '',
							"LAD_REG_NUMBER" => $valAsset['assetsDetail']['ladRegNumber'],
							"LAD_REG_PAGE" => $valAsset['assetsDetail']['ladRegPage'],
							"LAD_REG_VOLUME" => $valAsset['assetsDetail']['ladRegVolume'],
							"LAD_SUBDISTRICT" => $valAsset['assetsDetail']['ladSubdistrict'],
							"LAD_SUBDISTRICT_CODE" => $valAsset['assetsDetail']['ladSubdistrictCode'],
							"LAD_ATD_ID_FK" => $valAsset['assetsDetail']['ladAtdIdFk'],
							"LAD_ADDITIONAL" => $valAsset['assetsDetail']['ladAdditional'],
							"LAD_AREA_PIECE_OF_WAH" => $valAsset['assetsDetail']['ladAreaPieceOfWah'],
							"LAD_DISTRICT_REG_DOC" => $valAsset['assetsDetail']['ladDistrictRegDoc'],
							"LAD_LAND_NUMBER" => $valAsset['assetsDetail']['ladLandNumber'],
							"LAD_LAND_STATE" => $valAsset['assetsDetail']['ladLandState'],
							"LAD_NEARBY" => $valAsset['assetsDetail']['ladNearby'],
							"LAD_PRICE_PER_UNIT" => $valAsset['assetsDetail']['ladPricePerUnit'],
							"LAD_PROVINCE_REG_DOC" => $valAsset['assetsDetail']['ladProvinceRegDoc'],
							"LAD_REMARK" => $valAsset['assetsDetail']['ladRemark'],
							"LAD_SUBDISTRICT_REG_DOC" => $valAsset['assetsDetail']['ladSubdistrictRegDoc'],
							"LAD_TOTAL_PRICE" => $valAsset['assetsDetail']['ladTotalPrice'],
							"LAD_ADP_ID_FK" => $valAsset['assetsDetail']['ladAdpIdFk'],
							"FIND_DOCUMENT_TYPE" => $valAsset['assetsDetail']['findDocumentType'],
							"LAD_CREATE_DATE" => ($valAsset['assetsDetail']['ladCreateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['ladCreateDate'])) : '',
							"LAD_UPDATE_DATE" => ($valAsset['assetsDetail']['ladUpdateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['ladUpdateDate'])) : '',
							"WH_BANKRUPT_ID" => $WH_BANKRUPT_ID,
							"CFR_ROUND_NUM" => $valAsset['assetsDetail']['cfrRoundNum'],
							"CFR_ROUND_DATE" => ($valAsset['assetsDetail']['cfrRoundDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundDate'])) : '',
							"CFR_ROUND_ACTION_DATE" => ($valAsset['assetsDetail']['cfrRoundActionDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundActionDate'])) : '',
							"CFR_ROUND_TIME" => $valAsset['assetsDetail']['cfrRoundTime'],
						);

						if (pm_check_dup('LAD_ID_PK', $valAsset['assetsDetail']['ladIdPk'], $tableInsertDetail) == 0) {
							db::db_insert($tableInsertDetail, $fieldInsertDatail);
						}

						break;

					case '2': // สิ่งปลูกสร้าง

						$fieldInsertDatail = array(
							"BUD_ID_PK" => $valAsset['assetsDetail']['budIdPk'],
							"WH_BANKRUPT_ID" => $WH_BANKRUPT_ID,
							"BUD_ASS_ID_FK" => $valAsset['assetsDetail']['budAssIdFk'],
							"BUD_ATD_ID_FK" => $valAsset['assetsDetail']['budAtdIdFk'],
							"BUD_ATD_NAME" => $valAsset['assetsDetail']['budAtdName'],
							"BUD_BD_ADDITIONAL" => $valAsset['assetsDetail']['budBdAdditional'],
							"BUD_BD_ADDRESS" => $valAsset['assetsDetail']['budBdAddress'],
							"BUD_BD_AREA_HEIGHT" => $valAsset['assetsDetail']['budBdAreaHeight'],
							"BUD_BD_AREA_SIZE" => $valAsset['assetsDetail']['budBdAreaSize'],
							"BUD_BD_AREA_TOTAL" => $valAsset['assetsDetail']['budBdAreaTotal'],
							"BUD_BD_AREA_WIDTH" => $valAsset['assetsDetail']['budBdAreaWidth'],
							"BUD_BD_BUILDING_CONDITION" => $valAsset['assetsDetail']['budBdBuildingCondition'],
							"BUD_BD_CONPERIOD_DAY" => $valAsset['assetsDetail']['budBdConperiodDay'],
							"BUD_BD_CONPERIOD_MONTH" => $valAsset['assetsDetail']['budBdConperiodMonth'],
							"BUD_BD_CONPERIOD_YEAR" => $valAsset['assetsDetail']['budBdConperiodYear'],
							"BUD_BD_LANDMARK" => $valAsset['assetsDetail']['budBdLandmark'],
							"BUD_BD_NAME" => $valAsset['assetsDetail']['budBdName'],
							"BUD_BD_NUMBER" => $valAsset['assetsDetail']['budBdNumber'],
							"BUD_BD_NUM_FLOOR" => $valAsset['assetsDetail']['budBdNumFloor'],
							"BUD_BD_ON_ID_FK" => $valAsset['assetsDetail']['budBdOnIdFk'],
							"BUD_BD_OWNER" => $valAsset['assetsDetail']['budBdOwner'],
							"BUD_BD_REG_NUMBER" => $valAsset['assetsDetail']['budBdRegNumber'],
							"BUD_BN_ON_NAME" => $valAsset['assetsDetail']['budBnOnName'],
							"BUD_CREATOR" => $valAsset['assetsDetail']['budCreator'],
							"BUD_CREATOR_ID" => $valAsset['assetsDetail']['budCreatorId'],
							"BUD_DIS_ID_FK" => $valAsset['assetsDetail']['budDisIdFk'],
							"BUD_HEIGHT" => $valAsset['assetsDetail']['budHeight'],
							"BUD_LD_DISTRICT" => $valAsset['assetsDetail']['budLdDistrict'],
							"BUD_LD_DISTRICT_CODE" => $valAsset['assetsDetail']['budLdDistrictCode'],
							"BUD_LD_PROVINCE" => $valAsset['assetsDetail']['budLdProvince'],
							"BUD_LD_PROVINCE_CODE" => $valAsset['assetsDetail']['budLdProvinceCode'],
							"BUD_LD_REG_NUMBER" => $valAsset['assetsDetail']['budLdRegNumber'],
							"BUD_LD_SUBDISTRICT" => $valAsset['assetsDetail']['budLdSubdistrict'],
							"BUD_LD_SUBDISTRICT_CODE" => $valAsset['assetsDetail']['budLdSubdistrictCode'],
							"BUD_POST_CODE" => $valAsset['assetsDetail']['budPostCode'],
							"BUD_PRICE_PER_UNIT" => $valAsset['assetsDetail']['budPricePerUnit'],
							"BUD_PRV_ID_FK" => $valAsset['assetsDetail']['budPrvIdFk'],
							"BUD_REDUCE_RATIO_PRICE" => $valAsset['assetsDetail']['budReduceRatioPrice'],
							"BUD_REG_DOC_TYPE_REF" => $valAsset['assetsDetail']['budRegDocTypeRef'],
							"BUD_REMARK" => $valAsset['assetsDetail']['budRemark'],
							"BUD_SDI_ID_FK" => $valAsset['assetsDetail']['budSdiIdFk'],
							"BUD_STATUS" => $valAsset['assetsDetail']['budStatus'],
							"BUD_TOTAL_AREA" => $valAsset['assetsDetail']['budTotalArea'],
							"BUD_TOTAL_PRICE" => $valAsset['assetsDetail']['budTotalPrice'],
							"BUD_UPDATER" => $valAsset['assetsDetail']['budUpdater'],
							"BUD_UPDATER_ID" => $valAsset['assetsDetail']['budUpdaterId'],
							"BUD_WIDTH" => $valAsset['assetsDetail']['budWidth'],
							"ASS_ASSET_GROUP" => $valAsset['assetsDetail']['assAssetGroup'],
							"FIND_ASSET_TYPE_DETAIL" => $valAsset['assetsDetail']['findAssetTypeDetail'],
							"FIND_BUILD_A_MODEL" => $valAsset['assetsDetail']['findBuildAModel'],
							"FIND_LAND_TYPE" => $valAsset['assetsDetail']['findLandType'],
							"BUD_CREATE_DATE" => ($valAsset['assetsDetail']['budCreateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['budCreateDate'])) : '',
							"BUD_UPDATE_DATE" => ($valAsset['assetsDetail']['budUpdateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['budUpdateDate'])) : '',
							"BUD_REG_DATE" => ($valAsset['assetsDetail']['budRegDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['budRegDate'])) : '',
							"CFR_ROUND_NUM" => $valAsset['assetsDetail']['cfrRoundNum'],
							"CFR_ROUND_DATE" => ($valAsset['assetsDetail']['cfrRoundDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundDate'])) : '',
							"CFR_ROUND_ACTION_DATE" => ($valAsset['assetsDetail']['cfrRoundActionDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundActionDate'])) : '',
							"CFR_ROUND_TIME" => $valAsset['assetsDetail']['cfrRoundTime'],
						);

						if (pm_check_dup('BUD_ID_PK', $valAsset['assetsDetail']['budIdPk'], $tableInsertDetail) == 0) {
							db::db_insert($tableInsertDetail, $fieldInsertDatail);
						}

						break;

					case '3': // ห้องชุด

						$fieldInsertDatail = array(
							"ROM_ID_PK" => $valAsset['assetsDetail']['romIdPk'],
							"WH_BANKRUPT_ID" => $WH_BANKRUPT_ID,
							"ROM_ASS_ID_FK" => $valAsset['assetsDetail']['romAssIdFk'],
							"ROM_BU_NAME" => $valAsset['assetsDetail']['romBuName'],
							"ROM_BU_NUMBER" => $valAsset['assetsDetail']['romBuNumber'],
							"ROM_BU_REG_NUMBER" => $valAsset['assetsDetail']['romBuRegNumber'],
							"ROM_CREATOR" => $valAsset['assetsDetail']['romCreator'],
							"ROM_CREATOR_ID" => $valAsset['assetsDetail']['romCreatorId'],
							"ROM_FLOOR" => $valAsset['assetsDetail']['romFloor'],
							"ROM_LD_AREA_NGAN" => $valAsset['assetsDetail']['romLdAreaNgan'],
							"ROM_LD_AREA_RAI" => $valAsset['assetsDetail']['romLdAreaRai'],
							"ROM_LD_AREA_SQWAH" => $valAsset['assetsDetail']['romLdAreaSqwah'],
							"ROM_RM_AREA_TOTAL" => $valAsset['assetsDetail']['romRmAreaTotal'],
							"ROM_LD_DISTRICT" => $valAsset['assetsDetail']['romLdDistrict'],
							"ROM_LD_DISTRICT_CODE" => $valAsset['assetsDetail']['romLdDistrictCode'],
							"ROM_LD_PROVINCE" => $valAsset['assetsDetail']['romLdProvince'],
							"ROM_LD_PROVINCE_CODE" => $valAsset['assetsDetail']['romLdProvinceCode'],
							"ROM_LD_REG_NUMBER" => $valAsset['assetsDetail']['romLdRegNumber'],
							"ROM_LD_SUBDISTRICT" => $valAsset['assetsDetail']['romLdSubdistrict'],
							"ROM_LD_SUBDISTRICT_CODE" => $valAsset['assetsDetail']['romLdSubdistrictCode'],
							"ROM_RATIO_OWNERSHIP" => $valAsset['assetsDetail']['romRatioOwnership'],
							"ROM_RATIO_PUBLIC" => $valAsset['assetsDetail']['romRatioPublic'],
							"ROM_RM_AREA_LIVING" => $valAsset['assetsDetail']['romRmAreaLiving'],
							"ROM_RM_AREA_TALL" => $valAsset['assetsDetail']['romRmAreaTall'],
							"ROM_RM_AREA_TERRACE" => $valAsset['assetsDetail']['romRmAreaTerrace'],
							"ROM_RM_NUMBER" => $valAsset['assetsDetail']['romRmNumber'],
							"ROM_UPDATER" => $valAsset['assetsDetail']['romUpdater'],
							"ROM_UPDATER_ID" => $valAsset['assetsDetail']['romUpdaterId'],
							"ROM_STATUS" => $valAsset['assetsDetail']['romStatus'],
							"ROM_ADDITIONAL" => $valAsset['assetsDetail']['romAdditional'],
							"ROM_ROOM_STATUS" => $valAsset['assetsDetail']['romRoomStatus'],
							"ROM_ATD_ID_FK" => $valAsset['assetsDetail']['romAtdIdFk'],
							"ROM_ATD_NAME" => $valAsset['assetsDetail']['romAtdName'],
							"ROM_DISTRICT_REG_DOC" => $valAsset['assetsDetail']['romDistrictRegDoc'],
							"ROM_EXPENSE_BALANCE" => $valAsset['assetsDetail']['romExpenseBalance'],
							"ROM_EXPENSE_PERMONTH" => $valAsset['assetsDetail']['romExpensePermonth'],
							"ROM_HEIGHT" => $valAsset['assetsDetail']['romHeight'],
							"ROM_PERUNIT_PRICE" => $valAsset['assetsDetail']['romPerunitPrice'],
							"ROM_POST_CODE" => $valAsset['assetsDetail']['romPostCode'],
							"ROM_PROVINCE_REG_DOC" => $valAsset['assetsDetail']['romProvinceRegDoc'],
							"ROM_REG_DOC_TYPE_REF" => $valAsset['assetsDetail']['romRegDocTypeRef'],
							"ROM_REMARK" => $valAsset['assetsDetail']['romRemark'],
							"ROM_COUNT" => $valAsset['assetsDetail']['romCount'],
							"ROM_SUBDISTRICT_REG_DOC" => $valAsset['assetsDetail']['romSubdistrictRegDoc'],
							"ROM_SUM_AREA" => $valAsset['assetsDetail']['romSumArea'],
							"ROM_SUM_PRICE" => $valAsset['assetsDetail']['romSumPrice'],
							"ROM_PRV_ID_FK" => $valAsset['assetsDetail']['romPrvIdFk'],
							"ROM_DIS_ID_FK" => $valAsset['assetsDetail']['romDisIdFk'],
							"ROM_SDI_ID_FK" => $valAsset['assetsDetail']['romSdiIdFk'],
							"ASS_ASSET_GROUP" => $valAsset['assetsDetail']['assAssetGroup'],
							"FIND_LAND_TYPE" => $valAsset['assetsDetail']['findLandType'],
							"ROM_CREATE_DATE" => ($valAsset['assetsDetail']['romCreateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['romCreateDate'])) : '',
							"ROM_UPDATE_DATE" => ($valAsset['assetsDetail']['romUpdateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['romUpdateDate'])) : '',
							"ROM_EXPENSE_DUEDATE" => ($valAsset['assetsDetail']['romExpenseDuedate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['romExpenseDuedate'])) : '',
							"ROM_BU_REG_DATE" => ($valAsset['assetsDetail']['romBuRegDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['romBuRegDate'])) : '',
							"CFR_ROUND_NUM" => $valAsset['assetsDetail']['cfrRoundNum'],
							"CFR_ROUND_DATE" => ($valAsset['assetsDetail']['cfrRoundDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundDate'])) : '',
							"CFR_ROUND_ACTION_DATE" => ($valAsset['assetsDetail']['cfrRoundActionDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundActionDate'])) : '',
							"CFR_ROUND_TIME" => $valAsset['assetsDetail']['cfrRoundTime'],
						);

						if (pm_check_dup('ROM_ID_PK', $valAsset['assetsDetail']['romIdPk'], $tableInsertDetail) == 0) {
							db::db_insert($tableInsertDetail, $fieldInsertDatail);
						}

						if (is_array($valAsset['assetsDetail']['findAreaDetails']) && count($valAsset['assetsDetail']['findAreaDetails']) > 0) {
							foreach ($valAsset['assetsDetail']['findAreaDetails'] as $keyAreaDetails => $valAreaDetails) {
								$fieldAreaDetails = array(
									'WH_BANKRUPT_ID' => $WH_BANKRUPT_ID,
									'ASAC_ID_PK' => $valAreaDetails['asacIdPk'],
									'ASAC_AREA_PRICE' => $valAreaDetails['asacAreaPrice'],
									'ASAC_CREATE_DATE' => ($valAreaDetails['asacCreateDate']) ? date('Y-m-d H:i:s', strtotime($valAreaDetails['asacCreateDate'])) : '',
									'ASAC_CREATOR' => $valAreaDetails['asacCreator'],
									'ASAC_CREATOR_ID' => $valAreaDetails['asacCreatorId'],
									'ASAC_HEIGHT' => $valAreaDetails['asacHeight'],
									'ASAC_MAIN_FLAG' => $valAreaDetails['asacMainFlag'],
									'ASAC_NAME' => $valAreaDetails['asacName'],
									'ASAC_PERUNIT_PRICE' => $valAreaDetails['asacPerunitPrice'],
									'ASAC_REMARK' => $valAreaDetails['asacRemark'],
									'ASAC_STATUS' => $valAreaDetails['asacStatus'],
									'ASAC_UPDATE_DATE' => ($valAreaDetails['asacUpdateDate']) ? date('Y-m-d H:i:s', strtotime($valAreaDetails['asacUpdateDate'])) : '',
									'ASAC_UPDATER' => $valAreaDetails['asacUpdater'],
									'ASAC_UPDATER_ID' => $valAreaDetails['asacUpdaterId'],
									'ASAC_WIDTH' => $valAreaDetails['asacWidth'],
									'ASSET_ID' => $valAreaDetails['asacRomIdFk']
								);
								db::db_insert('WH_BANKRUPT_ASSETS_CONDO_AREA', $fieldAreaDetails);
							}
						}

						break;

					case '4': // เครื่องจักร

						$fieldInsertDatail = array(
							"MAC_ID_PK" => $valAsset['assetsDetail']['macIdPk'],
							"WH_BANKRUPT_ID" => $WH_BANKRUPT_ID,
							"MAC_ASS_ID_FK" => $valAsset['assetsDetail']['macAssIdFk'],
							"MAC_ADDITIONAL" => $valAsset['assetsDetail']['macAdditional'],
							"MAC_ADDR_NO" => $valAsset['assetsDetail']['macAddrNo'],
							"MAC_ATD_ID_FK" => $valAsset['assetsDetail']['macAtdIdFk'],
							"MAC_CAPACITY" => $valAsset['assetsDetail']['macCapacity'],
							"MAC_COMPONENT" => $valAsset['assetsDetail']['macComponent'],
							"MAC_CREATOR" => $valAsset['assetsDetail']['macCreator'],
							"MAC_CREATOR_ID" => $valAsset['assetsDetail']['macCreatorId'],
							"MAC_DIMENSION" => $valAsset['assetsDetail']['macDimension'],
							"MAC_DIS_ID_FK" => $valAsset['assetsDetail']['macDisIdFk'],
							"MAC_LD_DISTRICT" => $valAsset['assetsDetail']['macLdDistrict'],
							"MAC_LD_DISTRICT_CODE" => $valAsset['assetsDetail']['macLdDistrictCode'],
							"MAC_LD_PROVINCE" => $valAsset['assetsDetail']['macLdProvince'],
							"MAC_LD_PROVINCE_CODE" => $valAsset['assetsDetail']['macLdProvinceCode'],
							"MAC_LD_SUBDISTRICT" => $valAsset['assetsDetail']['macLdSubdistrict'],
							"MAC_LD_SUBDISTRICT_CODE" => $valAsset['assetsDetail']['macLdSubdistrictCode'],
							"MAC_LOCATION_NEARLY" => $valAsset['assetsDetail']['macLocationNearly'],
							"MAC_LOCATION_OWNER" => $valAsset['assetsDetail']['macLocationOwner'],
							"MAC_MODEL" => $valAsset['assetsDetail']['macModel'],
							"MAC_NAME" => $valAsset['assetsDetail']['macName'],
							"MAC_POST_CODE" => $valAsset['assetsDetail']['macPostCode'],
							"MAC_POWER_CELL" => $valAsset['assetsDetail']['macPowerCell'],
							"MAC_PRODUCER" => $valAsset['assetsDetail']['macProducer'],
							"MAC_PRV_ID_FK" => $valAsset['assetsDetail']['macPrvIdFk'],
							"MAC_REG_DOC_TYPE_REF" => $valAsset['assetsDetail']['macRegDocTypeRef'],
							"MAC_REG_NUMBER" => $valAsset['assetsDetail']['macRegNumber'],
							"MAC_REMARK" => $valAsset['assetsDetail']['macRemark'],
							"MAC_SDI_ID_FK" => $valAsset['assetsDetail']['macSdiIdFk'],
							"MAC_SERIAL_NUMBER" => $valAsset['assetsDetail']['macSerialNumber'],
							"MAC_STATUS" => $valAsset['assetsDetail']['macStatus'],
							"MAC_STORE_ADDRESS_FLAG" => $valAsset['assetsDetail']['macStoreAddressFlag'],
							"MAC_STORE_ADDR_NO" => $valAsset['assetsDetail']['macStoreAddrNo'],
							"MAC_STORE_DIS_ID_FK" => $valAsset['assetsDetail']['macStoreDisIdFk'],
							"MAC_STORE_POST_CODE" => $valAsset['assetsDetail']['macStorePostCode'],
							"MAC_STORE_PRV_ID_FK" => $valAsset['assetsDetail']['macStorePrvIdFk'],
							"MAC_STORE_SDI_ID_FK" => $valAsset['assetsDetail']['macStoreSdiIdFk'],
							"MAC_TYPE" => $valAsset['assetsDetail']['macType'],
							"MAC_UPDATER" => $valAsset['assetsDetail']['macUpdater'],
							"MAC_UPDATER_ID" => $valAsset['assetsDetail']['macUpdaterId'],
							"MAC_USABILLITY" => $valAsset['assetsDetail']['macUsabillity'],
							"ASS_ASSET_GROUP" => $valAsset['assetsDetail']['assAssetGroup'],
							"FIND_ZIPCODE" => $valAsset['assetsDetail']['findZipcode'],
							"MAC_CREATE_DATE" => ($valAsset['assetsDetail']['macCreateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['macCreateDate'])) : '',
							"MAC_UPDATE_DATE" => ($valAsset['assetsDetail']['macUpdateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['macUpdateDate'])) : '',
							"MAC_REG_DATE" => ($valAsset['assetsDetail']['macRegDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['macRegDate'])) : '',
							"CFR_ROUND_NUM" => $valAsset['assetsDetail']['cfrRoundNum'],
							"CFR_ROUND_DATE" => ($valAsset['assetsDetail']['cfrRoundDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundDate'])) : '',
							"CFR_ROUND_ACTION_DATE" => ($valAsset['assetsDetail']['cfrRoundActionDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundActionDate'])) : '',
							"CFR_ROUND_TIME" => $valAsset['assetsDetail']['cfrRoundTime'],
						);

						if (pm_check_dup('MAC_ID_PK', $valAsset['assetsDetail']['macIdPk'], $tableInsertDetail) == 0) {
							db::db_insert($tableInsertDetail, $fieldInsertDatail);
						}

						break;

					case '5': // ยานพาหนะ

						$fieldInsertDatail = array(
							"VECL_ID_PK" => $valAsset['assetsDetail']['veclIdPk'],
							"WH_BANKRUPT_ID" => $WH_BANKRUPT_ID,
							"VECL_ASS_ID_FK" => $valAsset['assetsDetail']['veclAssIdFk'],
							"VECL_ADDRESS_NO" => $valAsset['assetsDetail']['veclAddressNo'],
							"VECL_APPEARANCE" => $valAsset['assetsDetail']['veclAppearance'],
							"VECL_ATD_ID_FK" => $valAsset['assetsDetail']['veclAtdIdFk'],
							"VECL_AXLE" => $valAsset['assetsDetail']['veclAxle'],
							"VECL_BRAND" => $valAsset['assetsDetail']['veclBrand'],
							"VECL_CAR_NUMBER" => $valAsset['assetsDetail']['veclCarNumber'],
							"VECL_COLOR" => $valAsset['assetsDetail']['veclColor'],
							"VECL_CREATOR" => $valAsset['assetsDetail']['veclCreator'],
							"VECL_CREATOR_ID" => $valAsset['assetsDetail']['veclCreatorId'],
							"VECL_DEPTH" => $valAsset['assetsDetail']['veclDepth'],
							"VECL_DEPTH_UNIT" => $valAsset['assetsDetail']['veclDepthUnit'],
							"VECL_DISTRICT_NAME" => $valAsset['assetsDetail']['veclDistrictName'],
							"VECL_DIS_ID_FK" => $valAsset['assetsDetail']['veclDisIdFk'],
							"VECL_FUEL" => $valAsset['assetsDetail']['veclFuel'],
							"VECL_GAS_TANK_NUMBER" => $valAsset['assetsDetail']['veclGasTankNumber'],
							"VECL_HEAD_SHIP" => $valAsset['assetsDetail']['veclHeadShip'],
							"VECL_HOURSEPOWER" => $valAsset['assetsDetail']['veclHoursepower'],
							"VECL_LENGTH" => $valAsset['assetsDetail']['veclLength'],
							"VECL_LENGTH_SCENE" => $valAsset['assetsDetail']['veclLengthScene'],
							"VECL_LENGTH_SCENE_UNIT" => $valAsset['assetsDetail']['veclLengthSceneUnit'],
							"VECL_LENGTH_UNIT" => $valAsset['assetsDetail']['veclLengthUnit'],
							"VECL_MACHINE_AMOUNT" => $valAsset['assetsDetail']['veclMachineAmount'],
							"VECL_MACHINE_NAME" => $valAsset['assetsDetail']['veclMachineName'],
							"VECL_MACHINE_TYPE" => $valAsset['assetsDetail']['veclMachineType'],
							"VECL_MATERIAL" => $valAsset['assetsDetail']['veclMaterial'],
							"VECL_MODEL" => $valAsset['assetsDetail']['veclModel'],
							"VECL_MOTOR_BRAND" => $valAsset['assetsDetail']['veclMotorBrand'],
							"VECL_MOTOT_NUMBER" => $valAsset['assetsDetail']['veclMototNumber'],
							"VECL_NAME" => $valAsset['assetsDetail']['veclName'],
							"VECL_OFFICER" => $valAsset['assetsDetail']['veclOfficer'],
							"VECL_OTHER_TEXT" => $valAsset['assetsDetail']['veclOtherText'],
							"VECL_OWNER" => $valAsset['assetsDetail']['veclOwner'],
							"VECL_POST_CODE" => $valAsset['assetsDetail']['veclPostCode'],
							"VECL_POST_REGISTRATION" => $valAsset['assetsDetail']['veclPostRegistration'],
							"VECL_POWER" => $valAsset['assetsDetail']['veclPower'],
							"VECL_PROVINCE_NAME" => $valAsset['assetsDetail']['veclProvinceName'],
							"VECL_PRV_ID_FK" => $valAsset['assetsDetail']['veclPrvIdFk'],
							"VECL_PUMP" => $valAsset['assetsDetail']['veclPump'],
							"VECL_REASON" => $valAsset['assetsDetail']['veclReason'],
							"VECL_REGISTER_NUMBER" => $valAsset['assetsDetail']['veclRegisterNumber'],
							"VECL_REG_DOC_TYPE_REF" => $valAsset['assetsDetail']['veclRegDocTypeRef'],
							"VECL_REG_PRV_ID_FK" => $valAsset['assetsDetail']['veclRegPrvIdFk'],
							"VECL_SDI_ID_FK" => $valAsset['assetsDetail']['veclSdiIdFk'],
							"VECL_SERIE_NUMBER" => $valAsset['assetsDetail']['veclSerieNumber'],
							"VECL_STATUS" => $valAsset['assetsDetail']['veclStatus'],
							"VECL_STERN" => $valAsset['assetsDetail']['veclStern'],
							"VECL_STORE_ADDRESS_FLAG" => $valAsset['assetsDetail']['veclStoreAddressFlag'],
							"VECL_STORE_ADDRESS_NO" => $valAsset['assetsDetail']['veclStoreAddressNo'],
							"VECL_STORE_DISTRICT_NAME" => $valAsset['assetsDetail']['veclStoreDistrictName'],
							"VECL_STORE_DIS_ID_FK" => $valAsset['assetsDetail']['veclStoreDisIdFk'],
							"VECL_STORE_POST_CODE" => $valAsset['assetsDetail']['veclStorePostCode'],
							"VECL_STORE_PROVINCE_NAME" => $valAsset['assetsDetail']['veclStoreProvinceName'],
							"VECL_STORE_PRV_ID_FK" => $valAsset['assetsDetail']['veclStorePrvIdFk'],
							"VECL_STORE_SDI_ID_FK" => $valAsset['assetsDetail']['veclStoreSdiIdFk'],
							"VECL_STORE_SUBDISTRICT_NAME" => $valAsset['assetsDetail']['veclStoreSubdistrictName'],
							"VECL_SUBDISTRICT_NAME" => $valAsset['assetsDetail']['veclSubdistrictName'],
							"VECL_TANK_NUMBER" => $valAsset['assetsDetail']['veclTankNumber'],
							"VECL_TIRES" => $valAsset['assetsDetail']['veclTires'],
							"VECL_TONGOSS" => $valAsset['assetsDetail']['veclTongoss'],
							"VECL_TONNAGE" => $valAsset['assetsDetail']['veclTonnage'],
							"VECL_TYPE" => $valAsset['assetsDetail']['veclType'],
							"VECL_UPDATER" => $valAsset['assetsDetail']['veclUpdater'],
							"VECL_UPDATER_ID" => $valAsset['assetsDetail']['veclUpdaterId'],
							"VECL_USE_TYPE" => $valAsset['assetsDetail']['veclUseType'],
							"VECL_VEHICLE_STYLE" => $valAsset['assetsDetail']['veclVehicleStyle'],
							"VECL_VOLUMN_YEAR" => $valAsset['assetsDetail']['veclVolumnYear'],
							"VECL_WHEEL" => $valAsset['assetsDetail']['veclWheel'],
							"VECL_WIDTH" => $valAsset['assetsDetail']['veclWidth'],
							"VECL_WIDTH_UNIT" => $valAsset['assetsDetail']['veclWidthUnit'],
							"ASS_ASSET_GROUP" => $valAsset['assetsDetail']['assAssetGroup'],
							"FIND_VEHICLE_TYPE" => $valAsset['assetsDetail']['findVehicleType'],
							"FIND_VECL_REG_PRV" => $valAsset['assetsDetail']['findVeclRegPrv'],
							"VECL_CREATE_DATE" => ($valAsset['assetsDetail']['veclCreateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['veclCreateDate'])) : '',
							"VECL_UPDATE_DATE" => ($valAsset['assetsDetail']['veclUpdateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['veclUpdateDate'])) : '',
							"VECL_REGISTER_DATE" => ($valAsset['assetsDetail']['veclRegisterDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['veclRegisterDate'])) : '',
							"CFR_ROUND_NUM" => $valAsset['assetsDetail']['cfrRoundNum'],
							"CFR_ROUND_DATE" => ($valAsset['assetsDetail']['cfrRoundDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundDate'])) : '',
							"CFR_ROUND_ACTION_DATE" => ($valAsset['assetsDetail']['cfrRoundActionDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundActionDate'])) : '',
							"CFR_ROUND_TIME" => $valAsset['assetsDetail']['cfrRoundTime'],
						);

						if (pm_check_dup('VECL_ID_PK', $valAsset['assetsDetail']['veclIdPk'], $tableInsertDetail) == 0) {
							db::db_insert($tableInsertDetail, $fieldInsertDatail);
						}

						break;

					case '6': // พันธบัตร

						$fieldInsertDatail = array(
							"BOND_ID_PK" => $valAsset['assetsDetail']['bondIdPk'],
							"WH_BANKRUPT_ID" => $WH_BANKRUPT_ID,
							"BOND_ASS_ID_FK" => $valAsset['assetsDetail']['bondAssIdFk'],
							"BOND_AMOUNT" => $valAsset['assetsDetail']['bondAmount'],
							"BOND_ATD_ID_FK" => $valAsset['assetsDetail']['bondAtdIdFk'],
							"BOND_ATD_NAME" => $valAsset['assetsDetail']['bondAtdName'],
							"BOND_CREATOR" => $valAsset['assetsDetail']['bondCreator'],
							"BOND_CREATOR_ID" => $valAsset['assetsDetail']['bondCreatorId'],
							"BOND_DISTRICT" => $valAsset['assetsDetail']['bondDistrict'],
							"BOND_DISTRICT_CODE" => $valAsset['assetsDetail']['bondDistrictCode'],
							"BOND_ISSUER_ADDRESS" => $valAsset['assetsDetail']['bondIssuerAddress'],
							"BOND_ISSUER_NAME" => $valAsset['assetsDetail']['bondIssuerName'],
							"BOND_NAME" => $valAsset['assetsDetail']['bondName'],
							"BOND_NBR" => $valAsset['assetsDetail']['bondNbr'],
							"BOND_NBR_EXT" => $valAsset['assetsDetail']['bondNbrExt'],
							"BOND_POST_CODE" => $valAsset['assetsDetail']['bondPostCode'],
							"BOND_PRICE_PER_UNIT" => $valAsset['assetsDetail']['bondPricePerUnit'],
							"BOND_PROVINCE" => $valAsset['assetsDetail']['bondProvince'],
							"BOND_PROVINCE_CODE" => $valAsset['assetsDetail']['bondProvinceCode'],
							"BOND_RECEIVE_PERSON" => $valAsset['assetsDetail']['bondReceivePerson'],
							"BOND_REG_DOC_TYPE_REF" => $valAsset['assetsDetail']['bondRegDocTypeRef'],
							"BOND_REG_NBR" => $valAsset['assetsDetail']['bondRegNbr'],
							"BOND_REMARK" => $valAsset['assetsDetail']['bondRemark'],
							"BOND_STATUS" => $valAsset['assetsDetail']['bondStatus'],
							"BOND_SUBDISTRICT" => $valAsset['assetsDetail']['bondSubdistrict'],
							"BOND_SUBDISTRICT_CODE" => $valAsset['assetsDetail']['bondSubdistrictCode'],
							"BOND_UPDATER" => $valAsset['assetsDetail']['bondUpdater'],
							"BOND_UPDATER_ID" => $valAsset['assetsDetail']['bondUpdaterId'],
							"ASS_ASSET_GROUP" => $valAsset['assetsDetail']['assAssetGroup'],
							"FIND_BOND_TYPE" => $valAsset['assetsDetail']['findBondType'],
							"BOND_CREATE_DATE" => ($valAsset['assetsDetail']['bondCreateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['bondCreateDate'])) : '',
							"BOND_UPDATE_DATE" => ($valAsset['assetsDetail']['bondUpdateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['bondUpdateDate'])) : '',
							"BOND_EXPIRE_DATE" => ($valAsset['assetsDetail']['bondExpireDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['bondExpireDate'])) : '',
							"CFR_ROUND_NUM" => $valAsset['assetsDetail']['cfrRoundNum'],
							"CFR_ROUND_DATE" => ($valAsset['assetsDetail']['cfrRoundDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundDate'])) : '',
							"CFR_ROUND_ACTION_DATE" => ($valAsset['assetsDetail']['cfrRoundActionDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundActionDate'])) : '',
							"CFR_ROUND_TIME" => $valAsset['assetsDetail']['cfrRoundTime'],

						);

						if (pm_check_dup('BOND_ID_PK', $valAsset['assetsDetail']['bondIdPk'], $tableInsertDetail) == 0) {
							db::db_insert($tableInsertDetail, $fieldInsertDatail);
						}

						break;

					case '7': // สลากออมทรัพย์

						$fieldInsertDatail = array(
							"LOT_ID_PK" => $valAsset['assetsDetail']['lotIdPk'],
							"WH_BANKRUPT_ID" => $WH_BANKRUPT_ID,
							"LOT_ASS_ID_FK" => $valAsset['assetsDetail']['lotAssIdFk'],
							"LOT_AMOUNT" => $valAsset['assetsDetail']['lotAmount'],
							"LOT_ATD_ID_FK" => $valAsset['assetsDetail']['lotAtdIdFk'],
							"LOT_ATD_NAME" => $valAsset['assetsDetail']['lotAtdName'],
							"LOT_BANK_BRANCH_NAME" => $valAsset['assetsDetail']['lotBankBranchName'],
							"LOT_BNK_ID_FK" => $valAsset['assetsDetail']['lotBnkIdFk'],
							"LOT_CREATE_DATE" => ($valAsset['assetsDetail']['lotCreateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['lotCreateDate'])) : '',
							"LOT_CREATOR" => $valAsset['assetsDetail']['lotCreator'],
							"LOT_CREATOR_ID" => $valAsset['assetsDetail']['lotCreatorId'],
							"LOT_DISTRICT" => $valAsset['assetsDetail']['lotDistrict'],
							"LOT_DISTRICT_CODE" => $valAsset['assetsDetail']['lotDistrictCode'],
							"LOT_EXPIRE_DATE" => ($valAsset['assetsDetail']['lotExpireDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['lotExpireDate'])) : '',
							"LOT_NAME" => $valAsset['assetsDetail']['lotName'],
							"LOT_NBR" => $valAsset['assetsDetail']['lotNbr'],
							"LOT_NBR_EXT" => $valAsset['assetsDetail']['lotNbrExt'],
							"LOT_PER_UNIT" => $valAsset['assetsDetail']['lotPerUnit'],
							"LOT_POSTCODE" => $valAsset['assetsDetail']['lotPostcode'],
							"LOT_PROVINCE" => $valAsset['assetsDetail']['lotProvince'],
							"LOT_PROVINCE_CODE" => $valAsset['assetsDetail']['lotProvinceCode'],
							"LOT_RECEIVE_ADDR" => $valAsset['assetsDetail']['lotReceiveAddr'],
							"LOT_RECEIVE_NAME" => $valAsset['assetsDetail']['lotReceiveName'],
							"LOT_REG_DOC_TYPE_REF" => $valAsset['assetsDetail']['lotRegDocTypeRef'],
							"LOT_REG_NAME" => $valAsset['assetsDetail']['lotRegName'],
							"LOT_REMARK" => $valAsset['assetsDetail']['lotRemark'],
							"LOT_STATUS" => $valAsset['assetsDetail']['lotStatus'],
							"LOT_SUBDISTRICT" => $valAsset['assetsDetail']['lotSubdistrict'],
							"LOT_SUBDISTRICT_CODE" => $valAsset['assetsDetail']['lotSubdistrictCode'],
							"LOT_UPDATER" => $valAsset['assetsDetail']['lotUpdater'],
							"LOT_UPDATER_ID" => $valAsset['assetsDetail']['lotUpdaterId'],
							"LOT_UPDATE_DATE" => ($valAsset['assetsDetail']['lotUpdateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['lotUpdateDate'])) : '',
							"ASS_ASSET_GROUP" => $valAsset['assetsDetail']['assAssetGroup'],
							"FIND_LOT_TYPE" => $valAsset['assetsDetail']['findLotType'],
							"FIND_BANK_NAME" => $valAsset['assetsDetail']['findBankName'],
							"SUM_AMOUNT" => $valAsset['assetsDetail']['sumAmount'],
							"CFR_ROUND_NUM" => $valAsset['assetsDetail']['cfrRoundNum'],
							"CFR_ROUND_DATE" => ($valAsset['assetsDetail']['cfrRoundDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundDate'])) : '',
							"CFR_ROUND_ACTION_DATE" => ($valAsset['assetsDetail']['cfrRoundActionDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundActionDate'])) : '',
							"CFR_ROUND_TIME" => $valAsset['assetsDetail']['cfrRoundTime'],
						);

						if (pm_check_dup('LOT_ID_PK', $valAsset['assetsDetail']['lotIdPk'], $tableInsertDetail) == 0) {
							db::db_insert($tableInsertDetail, $fieldInsertDatail);
						}
						break;
					case '8': // อาวุธปืน

						$fieldInsertDatail = array(
							"GUN_ID_PK" => $valAsset['assetsDetail']['gunIdPk'],
							"WH_BANKRUPT_ID" => $WH_BANKRUPT_ID,
							"GUN_ASS_ID_FK" => $valAsset['assetsDetail']['gunAssIdFk'],
							"GUN_ADDRESS_NO" => $valAsset['assetsDetail']['gunAddressNo'],
							"GUN_BARREL_LONG" => $valAsset['assetsDetail']['gunBarrelLong'],
							"GUN_BRAND" => $valAsset['assetsDetail']['gunBrand'],
							"GUN_BULLET_SIZE" => $valAsset['assetsDetail']['gunBulletSize'],
							"GUN_COLOR" => $valAsset['assetsDetail']['gunColor'],
							"GUN_CREATE_DATE" => ($valAsset['assetsDetail']['gunCreateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['gunCreateDate'])) : '',
							"GUN_CREATOR" => $valAsset['assetsDetail']['gunCreator'],
							"GUN_CREATOR_ID" => $valAsset['assetsDetail']['gunCreatorId'],
							"GUN_DISTRICT" => $valAsset['assetsDetail']['gunDistrict'],
							"GUN_DISTRICT_CODE" => $valAsset['assetsDetail']['gunDistrictCode'],
							"GUN_KIND" => $valAsset['assetsDetail']['gunKind'],
							"GUN_MAG_QUANTITY" => $valAsset['assetsDetail']['gunMagQuantity'],
							"GUN_MAG_SIZE" => $valAsset['assetsDetail']['gunMagSize'],
							"GUN_MODEL" => $valAsset['assetsDetail']['gunModel'],
							"GUN_NO" => $valAsset['assetsDetail']['gunNo'],
							"GUN_POSTCODE" => $valAsset['assetsDetail']['gunPostcode'],
							"GUN_PROVINCE" => $valAsset['assetsDetail']['gunProvince'],
							"GUN_PROVINCE_CODE" => $valAsset['assetsDetail']['gunProvinceCode'],
							"GUN_REGIST_NO" => $valAsset['assetsDetail']['gunRegistNo'],
							"GUN_REG_DOC_TYPE_REF" => $valAsset['assetsDetail']['gunRegDocTypeRef'],
							"GUN_REMARK" => $valAsset['assetsDetail']['gunRemark'],
							"GUN_SIZE" => $valAsset['assetsDetail']['gunSize'],
							"GUN_STATE" => $valAsset['assetsDetail']['gunState'],
							"GUN_STATUS" => $valAsset['assetsDetail']['gunStatus'],
							"GUN_STORE_ADDRESS_FLAG" => $valAsset['assetsDetail']['gunStoreAddressFlag'],
							"GUN_STORE_ADDRESS_NO" => $valAsset['assetsDetail']['gunStoreAddressNo'],
							"GUN_STORE_DISTRICT_NAME" => $valAsset['assetsDetail']['gunStoreDistrictName'],
							"GUN_STORE_DIS_ID_FK" => $valAsset['assetsDetail']['gunStoreDisIdFk'],
							"GUN_STORE_POST_CODE" => $valAsset['assetsDetail']['gunStorePostCode'],
							"GUN_STORE_PROVINCE_NAME" => $valAsset['assetsDetail']['gunStoreProvinceName'],
							"GUN_STORE_PRV_ID_FK" => $valAsset['assetsDetail']['gunStorePrvIdFk'],
							"GUN_STORE_SDI_ID_FK" => $valAsset['assetsDetail']['gunStoreSdiIdFk'],
							"GUN_STORE_SUBDISTRICT_NAME" => $valAsset['assetsDetail']['gunStoreSubdistrictName'],
							"GUN_SUBDISTRICT" => $valAsset['assetsDetail']['gunSubdistrict'],
							"GUN_SUBDISTRICT_CODE" => $valAsset['assetsDetail']['gunSubdistrictCode'],
							"GUN_TYPE" => $valAsset['assetsDetail']['gunType'],
							"GUN_UPDATER" => $valAsset['assetsDetail']['gunUpdater'],
							"GUN_UPDATER_ID" => $valAsset['assetsDetail']['gunUpdaterId'],
							"GUN_UPDATE_DATE" => ($valAsset['assetsDetail']['gunUpdateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['gunUpdateDate'])) : '',
							"ASS_ASSET_GROUP" => $valAsset['assetsDetail']['assAssetGroup'],
							"FIND_GUN_TYPE" => $valAsset['assetsDetail']['findGunType'],
							"CFR_ROUND_NUM" => $valAsset['assetsDetail']['cfrRoundNum'],
							"CFR_ROUND_DATE" => ($valAsset['assetsDetail']['cfrRoundDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundDate'])) : '',
							"CFR_ROUND_ACTION_DATE" => ($valAsset['assetsDetail']['cfrRoundActionDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundActionDate'])) : '',
							"CFR_ROUND_TIME" => $valAsset['assetsDetail']['cfrRoundTime'],
						);

						if (pm_check_dup('GUN_ID_PK', $valAsset['assetsDetail']['gunIdPk'], $tableInsertDetail) == 0) {
							db::db_insert($tableInsertDetail, $fieldInsertDatail);
						}

						break;

					case '9': // หุ้นบริษัท
						$fieldInsertDatail = array(
							"ASH_ID_PK" => $valAsset['assetsDetail']['ashIdPk'],
							"WH_BANKRUPT_ID" => $WH_BANKRUPT_ID,
							"ASH_ASS_ID_FK" => $valAsset['assetsDetail']['ashAssIdFk'],
							"ASH_ACCT_NO" => $valAsset['assetsDetail']['ashAcctNo'],
							"ASH_ACCT_TYP" => $valAsset['assetsDetail']['ashAcctTyp'],
							"ASH_AMOUNT" => $valAsset['assetsDetail']['ashAmount'],
							"ASH_BANK_ADDR" => $valAsset['assetsDetail']['ashBankAddr'],
							"ASH_BANK_BRANCH_NAME" => $valAsset['assetsDetail']['ashBankBranchName'],
							"ASH_BANK_DISTRICT_CODE" => $valAsset['assetsDetail']['ashBankDistrictCode'],
							"ASH_BANK_NAME" => $valAsset['assetsDetail']['ashBankName'],
							"ASH_BANK_POSTCODE" => $valAsset['assetsDetail']['ashBankPostcode'],
							"ASH_BANK_PROVINCE_CODE" => $valAsset['assetsDetail']['ashBankProvinceCode'],
							"ASH_BANK_SUBDISTRICT_CODE" => $valAsset['assetsDetail']['ashBankSubdistrictCode'],
							"ASH_BROKER" => $valAsset['assetsDetail']['ashBroker'],
							"ASH_CREATE_DATE" => ($valAsset['assetsDetail']['ashCreateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['ashCreateDate'])) : '',
							"ASH_CREATOR" => $valAsset['assetsDetail']['ashCreator'],
							"ASH_CREATOR_ID" => $valAsset['assetsDetail']['ashCreatorId'],
							"ASH_DATA_DATE" => ($valAsset['assetsDetail']['ashDataDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['ashDataDate'])) : '',
							"ASH_DISTRICT" => $valAsset['assetsDetail']['ashDistrict'],
							"ASH_DISTRICT_CODE" => $valAsset['assetsDetail']['ashDistrictCode'],
							"ASH_MAR_NAME" => $valAsset['assetsDetail']['ashMarName'],
							"ASH_MAR_PRC" => $valAsset['assetsDetail']['ashMarPrc'],
							"ASH_MEET_RES" => $valAsset['assetsDetail']['ashMeetRes'],
							"ASH_OWN_COMP_ADDR" => $valAsset['assetsDetail']['ashOwnCompAddr'],
							"ASH_OWN_COMP_NAME" => $valAsset['assetsDetail']['ashOwnCompName'],
							"ASH_OWN_NAME" => $valAsset['assetsDetail']['ashOwnName'],
							"ASH_OWN_REG_NO" => $valAsset['assetsDetail']['ashOwnRegNo'],
							"ASH_POSTCODE" => $valAsset['assetsDetail']['ashPostcode'],
							"ASH_PRICE" => $valAsset['assetsDetail']['ashPrice'],
							"ASH_PROVINCE" => $valAsset['assetsDetail']['ashProvince'],
							"ASH_PROVINCE_CODE" => $valAsset['assetsDetail']['ashProvinceCode'],
							"ASH_REG_DOC_TYPE_REF" => $valAsset['assetsDetail']['ashRegDocTypeRef'],
							"ASH_REMARK" => $valAsset['assetsDetail']['ashRemark'],
							"ASH_SECURITIES_NAME" => $valAsset['assetsDetail']['ashSecuritiesName'],
							"ASH_SECURITIES_SHORT_NAME" => $valAsset['assetsDetail']['ashSecuritiesShortName'],
							"ASH_SHR_CAT" => $valAsset['assetsDetail']['ashShrCat'],
							"ASH_STATUS" => $valAsset['assetsDetail']['ashStatus'],
							"ASH_STK_CER" => $valAsset['assetsDetail']['ashStkCer'],
							"ASH_STK_NO" => $valAsset['assetsDetail']['ashStkNo'],
							"ASH_STK_TYPE" => $valAsset['assetsDetail']['ashStkType'],
							"ASH_SUBDISTRICT" => $valAsset['assetsDetail']['ashSubdistrict'],
							"ASH_SUBDISTRICT_CODE" => $valAsset['assetsDetail']['ashSubdistrictCode'],
							"ASH_TO" => $valAsset['assetsDetail']['ashTo'],
							"ASH_UPDATER" => $valAsset['assetsDetail']['ashUpdater'],
							"ASH_UPDATER_ID" => $valAsset['assetsDetail']['ashUpdaterId'],
							"ASH_UPDATE_DATE" => ($valAsset['assetsDetail']['ashUpdateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['ashUpdateDate'])) : '',
							"ASS_ASSET_GROUP" => $valAsset['assetsDetail']['assAssetGroup'],
							"FIND_STOCK_TYPE" => $valAsset['assetsDetail']['findStockType'],
							"FIND_STOCK_FORM" => $valAsset['assetsDetail']['findStockForm'],
							"CFR_ROUND_NUM" => $valAsset['assetsDetail']['cfrRoundNum'],
							"CFR_ROUND_DATE" => ($valAsset['assetsDetail']['cfrRoundDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundDate'])) : '',
							"CFR_ROUND_ACTION_DATE" => ($valAsset['assetsDetail']['cfrRoundActionDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundActionDate'])) : '',
							"CFR_ROUND_TIME" => $valAsset['assetsDetail']['cfrRoundTime'],
						);

						if (pm_check_dup('ASH_ID_PK', $valAsset['assetsDetail']['ashIdPk'], $tableInsertDetail) == 0) {
							db::db_insert($tableInsertDetail, $fieldInsertDatail);
						}

						break;

					case '10': // เงินค่าหุ้นสหกรณ์

						$fieldInsertDatail = array(
							"CPMN_ID_PK" => $valAsset['assetsDetail']['cpmnIdPk'],
							"WH_BANKRUPT_ID" => $WH_BANKRUPT_ID,
							"CPMN_ASS_ID_FK" => $valAsset['assetsDetail']['cpmnAssIdFk'],
							"CPMN_ADDRESS_NO" => $valAsset['assetsDetail']['cpmnAddressNo'],
							"CPMN_AMOUNT" => $valAsset['assetsDetail']['cpmnAmount'],
							"CPMN_CREATE_DATE" => ($valAsset['assetsDetail']['cpmnCreateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cpmnCreateDate'])) : '',
							"CPMN_CREATOR" => $valAsset['assetsDetail']['cpmnCreator'],
							"CPMN_CREATOR_ID" => $valAsset['assetsDetail']['cpmnCreatorId'],
							"CPMN_DISTRICT_NAME" => $valAsset['assetsDetail']['cpmnDistrictName'],
							"CPMN_DIS_ID_FK" => $valAsset['assetsDetail']['cpmnDisIdFk'],
							"CPMN_LEAVE_DATE" => substr($valAsset['assetsDetail']['cpmnLeaveDate'], 0, 10),
							"CPMN_NAME" => $valAsset['assetsDetail']['cpmnName'],
							"CPMN_POST_CODE" => $valAsset['assetsDetail']['cpmnPostCode'],
							"CPMN_PROVINCE_NAME" => $valAsset['assetsDetail']['cpmnProvinceName'],
							"CPMN_PRV_ID_FK" => $valAsset['assetsDetail']['cpmnPrvIdFk'],
							"CPMN_REG_DOC_TYPE_REF" => $valAsset['assetsDetail']['cpmnRegDocTypeRef'],
							"CPMN_REG_NUMBER" => $valAsset['assetsDetail']['cpmnRegNumber'],
							"CPMN_REMARK" => $valAsset['assetsDetail']['cpmnRemark'],
							"CPMN_SDI_ID_FK" => $valAsset['assetsDetail']['cpmnSdiIdFk'],
							"CPMN_SHARE_CAPITAL" => $valAsset['assetsDetail']['cpmnShareCapital'],
							"CPMN_STATUS" => $valAsset['assetsDetail']['cpmnStatus'],
							"CPMN_SUBDISTRICT_NAME" => $valAsset['assetsDetail']['cpmnSubdistrictName'],
							"CPMN_UPDATER" => $valAsset['assetsDetail']['cpmnUpdater'],
							"CPMN_UPDATER_ID" => $valAsset['assetsDetail']['cpmnUpdaterId'],
							"CPMN_UPDATE_DATE" => ($valAsset['assetsDetail']['cpmnUpdateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cpmnUpdateDate'])) : '',
							"ASS_ASSET_GROUP" => $valAsset['assetsDetail']['assAssetGroup'],
							"CFR_ROUND_NUM" => $valAsset['assetsDetail']['cfrRoundNum'],
							"CFR_ROUND_DATE" => ($valAsset['assetsDetail']['cfrRoundDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundDate'])) : '',
							"CFR_ROUND_ACTION_DATE" => ($valAsset['assetsDetail']['cfrRoundActionDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundActionDate'])) : '',
							"CFR_ROUND_TIME" => $valAsset['assetsDetail']['cfrRoundTime'],
						);

						if (pm_check_dup('CPMN_ID_PK', $valAsset['assetsDetail']['cpmnIdPk'], $tableInsertDetail) == 0) {
							db::db_insert($tableInsertDetail, $fieldInsertDatail);
						}

						break;

					case '11': // สิทธิการเช่า

						$fieldInsertDatail = array(
							"ARR_ID_PK" => $valAsset['assetsDetail']['arrIdPk'],
							"WH_BANKRUPT_ID" => $WH_BANKRUPT_ID,
							"ARR_ASS_ID_FK" => $valAsset['assetsDetail']['arrAssIdFk'],
							"ARR_ATD_ID_FK" => $valAsset['assetsDetail']['arrAtdIdFk'],
							"ARR_ATD_NAME" => $valAsset['assetsDetail']['arrAtdName'],
							"ARR_CONT_DATE" => ($valAsset['assetsDetail']['arrContDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['arrContDate'])) : '',
							"ARR_CREATE_DATE" => ($valAsset['assetsDetail']['arrCreateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['arrCreateDate'])) : '',
							"ARR_CREATOR" => $valAsset['assetsDetail']['arrCreator'],
							"ARR_CREATOR_ID" => $valAsset['assetsDetail']['arrCreatorId'],
							"ARR_DISTRICT" => $valAsset['assetsDetail']['arrDistrict'],
							"ARR_DISTRICT_CODE" => $valAsset['assetsDetail']['arrDistrictCode'],
							"ARR_JSON_OBJECT" => $valAsset['assetsDetail']['arrJsonObject'],
							"ARR_LESSEE_SGN_DATE" => ($valAsset['assetsDetail']['arrLesseeSgnDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['arrLesseeSgnDate'])) : '',
							"ARR_LESSOR_ADDR" => $valAsset['assetsDetail']['arrLessorAddr'],
							"ARR_LESSOR_NAME" => $valAsset['assetsDetail']['arrLessorName'],
							"ARR_LESSOR_SGN_DATE" => ($valAsset['assetsDetail']['arrLessorSgnDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['arrLessorSgnDate'])) : '',
							"ARR_POSTCODE" => $valAsset['assetsDetail']['arrPostcode'],
							"ARR_PROP_ADDR" => $valAsset['assetsDetail']['arrPropAddr'],
							"ARR_PROP_DISTRICT" => $valAsset['assetsDetail']['arrPropDistrict'],
							"ARR_PROP_DISTRICT_CODE" => $valAsset['assetsDetail']['arrPropDistrictCode'],
							"ARR_PROP_POSTCODE" => $valAsset['assetsDetail']['arrPropPostcode'],
							"ARR_PROP_PROVINCE" => $valAsset['assetsDetail']['arrPropProvince'],
							"ARR_PROP_PROVINCE_CODE" => $valAsset['assetsDetail']['arrPropProvinceCode'],
							"ARR_PROP_SUBDISTRICT" => $valAsset['assetsDetail']['arrPropSubdistrict'],
							"ARR_PROP_SUBDISTRICT_CODE" => $valAsset['assetsDetail']['arrPropSubdistrictCode'],
							"ARR_PROVINCE" => $valAsset['assetsDetail']['arrProvince'],
							"ARR_PROVINCE_CODE" => $valAsset['assetsDetail']['arrProvinceCode'],
							"ARR_REG_DOC_TYPE_REF" => $valAsset['assetsDetail']['arrRegDocTypeRef'],
							"ARR_REMARK" => $valAsset['assetsDetail']['arrRemark'],
							"ARR_RENTAL_DETAIL" => $valAsset['assetsDetail']['arrRentalDetail'],
							"ARR_RENT_DATE" => $valAsset['assetsDetail']['arrRentDate'],
							"ARR_RENT_MONTH" => $valAsset['assetsDetail']['arrRentMonth'],
							"ARR_RENT_YEAR" => $valAsset['assetsDetail']['arrRentYear'],
							"ARR_RNT_STR_DATE" => ($valAsset['assetsDetail']['arrRntStrDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['arrRntStrDate'])) : '',
							"ARR_RNT_END_DATE" => ($valAsset['assetsDetail']['arrRntEndDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['arrRntEndDate'])) : '',
							"ARR_STATUS" => $valAsset['assetsDetail']['arrStatus'],
							"ARR_SUBDISTRICT" => $valAsset['assetsDetail']['arrSubdistrict'],
							"ARR_SUBDISTRICT_CODE" => $valAsset['assetsDetail']['arrSubdistrictCode'],
							"ARR_UPDATER" => $valAsset['assetsDetail']['arrUpdater'],
							"ARR_UPDATER_ID" => $valAsset['assetsDetail']['arrUpdaterId'],
							"ARR_UPDATE_DATE" => ($valAsset['assetsDetail']['arrUpdateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['arrUpdateDate'])) : '',
							"FIND_LEASEHOLD_RIGHTS_TYPE" => $valAsset['assetsDetail']['findLeaseholdRightsType'],
							"CFR_ROUND_NUM" => $valAsset['assetsDetail']['cfrRoundNum'],
							"CFR_ROUND_DATE" => ($valAsset['assetsDetail']['cfrRoundDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundDate'])) : '',
							"CFR_ROUND_ACTION_DATE" => ($valAsset['assetsDetail']['cfrRoundActionDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundActionDate'])) : '',
							"CFR_ROUND_TIME" => $valAsset['assetsDetail']['cfrRoundTime'],
						);

						if (pm_check_dup('ARR_ID_PK', $valAsset['assetsDetail']['arrIdPk'], $tableInsertDetail) == 0) {
							db::db_insert($tableInsertDetail, $fieldInsertDatail);
						}

						break;

					case '12': // กรมธรรม์

						$fieldInsertDatail = array(
							"INSPOL_ID_PK" => $valAsset['assetsDetail']['inspolIdPk'],
							"WH_BANKRUPT_ID" => $WH_BANKRUPT_ID,
							"INSPOL_ASS_ID_FK" => $valAsset['assetsDetail']['inspolAssIdFk'],
							"INCM_AMOUNT" => $valAsset['assetsDetail']['incmAmount'],
							"INSPOL_ASSURED_ADRESS" => $valAsset['assetsDetail']['inspolAssuredAdress'],
							"INSPOL_ASSURED_ID_FK" => $valAsset['assetsDetail']['inspolAssuredIdFk'],
							"INSPOL_BENEFICIARY_ID_FK" => $valAsset['assetsDetail']['inspolBeneficiaryIdFk'],
							"INSPOL_CREATE_DATE" => ($valAsset['assetsDetail']['inspolCreateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['inspolCreateDate'])) : '',
							"INSPOL_CREATOR" => $valAsset['assetsDetail']['inspolCreator'],
							"INSPOL_CREATOR_ID" => $valAsset['assetsDetail']['inspolCreatorId'],
							"INSPOL_DISTRICT_NAME" => $valAsset['assetsDetail']['inspolDistrictName'],
							"INSPOL_DIS_ID_FK" => $valAsset['assetsDetail']['inspolDisIdFk'],
							"INSPOL_INSURANCE_NAME" => $valAsset['assetsDetail']['inspolInsuranceName'],
							"INSPOL_INSURANCE_NUMBER" => $valAsset['assetsDetail']['inspolInsuranceNumber'],
							"INSPOL_INSURANCE_TYPE" => $valAsset['assetsDetail']['inspolInsuranceType'],
							"INSPOL_INSURER" => $valAsset['assetsDetail']['inspolInsurer'],
							"INSPOL_POST_CODE" => $valAsset['assetsDetail']['inspolPostCode'],
							"INSPOL_PROVINCE_NAME" => $valAsset['assetsDetail']['inspolProvinceName'],
							"INSPOL_PRV_ID_FK" => $valAsset['assetsDetail']['inspolPrvIdFk'],
							"INSPOL_REG_DOC_TYPE_REF" => $valAsset['assetsDetail']['inspolRegDocTypeRef'],
							"INSPOL_REMARK" => $valAsset['assetsDetail']['inspolRemark'],
							"INSPOL_RESOLUTION_OF_CREDITOR" => $valAsset['assetsDetail']['inspolResolutionOfCreditor'],
							"INSPOL_RESOLUTION_OF_DEBTOR" => $valAsset['assetsDetail']['inspolResolutionOfDebtor'],
							"INSPOL_SDI_ID_FK" => $valAsset['assetsDetail']['inspolSdiIdFk'],
							"INSPOL_START_DATE" => ($valAsset['assetsDetail']['inspolStartDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['inspolStartDate'])) : '',
							"INSPOL_END_DATE" => ($valAsset['assetsDetail']['inspolEndDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['inspolEndDate'])) : '',
							"INSPOL_STATUS" => $valAsset['assetsDetail']['inspolStatus'],
							"INSPOL_SUBDISTRICT_NAME" => $valAsset['assetsDetail']['inspolSubdistrictName'],
							"INSPOL_UPDATER" => $valAsset['assetsDetail']['inspolUpdater'],
							"INSPOL_UPDATER_ID" => $valAsset['assetsDetail']['inspolUpdaterId'],
							"INSPOL_UPDATE_DATE" => ($valAsset['assetsDetail']['inspolUpdateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['inspolUpdateDate'])) : '',
							"FIND_DEBTOR_WISHES" => $valAsset['assetsDetail']['findDebtorWishes'],
							"CFR_ROUND_NUM" => $valAsset['assetsDetail']['cfrRoundNum'],
							"CFR_ROUND_DATE" => ($valAsset['assetsDetail']['cfrRoundDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundDate'])) : '',
							"CFR_ROUND_ACTION_DATE" => ($valAsset['assetsDetail']['cfrRoundActionDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundActionDate'])) : '',
							"CFR_ROUND_TIME" => $valAsset['assetsDetail']['cfrRoundTime'],
						);

						if (pm_check_dup('INSPOL_ID_PK', $valAsset['assetsDetail']['inspolIdPk'], $tableInsertDetail) == 0) {
							db::db_insert($tableInsertDetail, $fieldInsertDatail);
						}

						break;

					case '13': // บัญชีเงินฝากธนาคาร

						$fieldInsertDatail = array(
							"BKA_ID_PK" => $valAsset['assetsDetail']['bkaIdPk'],
							"WH_BANKRUPT_ID" => $WH_BANKRUPT_ID,
							"BKA_ASS_ID_FK" => $valAsset['assetsDetail']['bkaAssIdFk'],
							"BKA_ADDRESS_NO" => $valAsset['assetsDetail']['bkaAddressNo'],
							"BKA_ATD_ID_FK" => $valAsset['assetsDetail']['bkaAtdIdFk'],
							"BKA_BANK_ACCOUNT_AMOUNT" => $valAsset['assetsDetail']['bkaBankAccountAmount'],
							"BKA_BANK_ACCOUNT_NAME" => $valAsset['assetsDetail']['bkaBankAccountName'],
							"BKA_BANK_ACCOUNT_NO" => $valAsset['assetsDetail']['bkaBankAccountNo'],
							"BKA_BANK_ACC_TYPE_OTH_NAME" => $valAsset['assetsDetail']['bkaBankAccTypeOthName'],
							"BKA_BANK_BRANCH_NAME" => $valAsset['assetsDetail']['bkaBankBranchName'],
							"BKA_BNK_ID_FK" => $valAsset['assetsDetail']['bkaBnkIdFk'],
							"BKA_CREATE_DATE" => ($valAsset['assetsDetail']['bkaCreateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['bkaCreateDate'])) : '',
							"BKA_CREATOR" => $valAsset['assetsDetail']['bkaCreator'],
							"BKA_CREATOR_ID" => $valAsset['assetsDetail']['bkaCreatorId'],
							"BKA_DISTRICT" => $valAsset['assetsDetail']['bkaDistrict'],
							"BKA_DISTRICT_CODE" => $valAsset['assetsDetail']['bkaDistrictCode'],
							"BKA_PROVINCE" => $valAsset['assetsDetail']['bkaProvince'],
							"BKA_PROVINCE_CODE" => $valAsset['assetsDetail']['bkaProvinceCode'],
							"BKA_REG_DOC_TYPE_REF" => $valAsset['assetsDetail']['bkaRegDocTypeRef'],
							"BKA_REMARK" => $valAsset['assetsDetail']['bkaRemark'],
							"BKA_STATUS" => $valAsset['assetsDetail']['bkaStatus'],
							"BKA_SUBDISTRICT" => $valAsset['assetsDetail']['bkaSubdistrict'],
							"BKA_SUBDISTRICT_CODE" => $valAsset['assetsDetail']['bkaSubdistrictCode'],
							"BKA_UPDATER" => $valAsset['assetsDetail']['bkaUpdater'],
							"BKA_UPDATER_ID" => $valAsset['assetsDetail']['bkaUpdaterId'],
							"BKA_UPDATE_DATE" => ($valAsset['assetsDetail']['bkaUpdateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['bkaUpdateDate'])) : '',
							"BKA_ZIPCODE" => $valAsset['assetsDetail']['bkaZipcode'],
							"FIND_ACCOUNT_TYPE" => $valAsset['assetsDetail']['findAccountType'],
							"FIND_BANK_NAME" => $valAsset['assetsDetail']['findBankName'],
							"CFR_ROUND_NUM" => $valAsset['assetsDetail']['cfrRoundNum'],
							"CFR_ROUND_DATE" => ($valAsset['assetsDetail']['cfrRoundDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundDate'])) : '',
							"CFR_ROUND_ACTION_DATE" => ($valAsset['assetsDetail']['cfrRoundActionDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundActionDate'])) : '',
							"CFR_ROUND_TIME" => $valAsset['assetsDetail']['cfrRoundTime'],
						);

						if (pm_check_dup('BKA_ID_PK', $valAsset['assetsDetail']['bkaIdPk'], $tableInsertDetail) == 0) {
							db::db_insert($tableInsertDetail, $fieldInsertDatail);
						}

						break;

					case '14': // บัญชีหลักทรัพย์
						break;

					case '15': // บัญชีทรัพย์สินอื่นๆ

						$fieldInsertDatail = array(
							"OTH_ID_PK" => $valAsset['assetsDetail']['othIdPk'],
							"WH_BANKRUPT_ID" => $WH_BANKRUPT_ID,
							"OTH_ASS_ID_FK" => $valAsset['assetsDetail']['othAssIdFk'],
							"OTH_ADDRESS_NO" => $valAsset['assetsDetail']['othaddressno'],
							"OTH_ASS_GRP" => $valAsset['assetsDetail']['othAssGrp'],
							"OTH_CREATE_DATE" => ($valAsset['assetsDetail']['othCreateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['othCreateDate'])) : '',
							"OTH_CREATOR" => $valAsset['assetsDetail']['othCreator'],
							"OTH_CREATOR_ID" => $valAsset['assetsDetail']['othCreatorId'],
							"OTH_CUR" => $valAsset['assetsDetail']['othCur'],
							"OTH_DISTRICT" => $valAsset['assetsDetail']['othDistrict'],
							"OTH_DISTRICT_CODE" => $valAsset['assetsDetail']['othDistrictCode'],
							"OTH_NAME" => $valAsset['assetsDetail']['othName'],
							"OTH_POSTCODE" => $valAsset['assetsDetail']['othPostcode'],
							"OTH_PROVINCE" => $valAsset['assetsDetail']['othProvince'],
							"OTH_PROVINCE_CODE" => $valAsset['assetsDetail']['othProvinceCode'],
							"OTH_REG_DOC_TYPE_REF" => $valAsset['assetsDetail']['othRegDocTypeRef'],
							"OTH_REG_NO" => $valAsset['assetsDetail']['othRegNo'],
							"OTH_REMARK" => $valAsset['assetsDetail']['othRemark'],
							"OTH_STATUS" => $valAsset['assetsDetail']['othStatus'],
							"OTH_STORE_ADDRESS_FLAG" => $valAsset['assetsDetail']['othStoreAddressFlag'],
							"OTH_STORE_ADDRESS_NO" => $valAsset['assetsDetail']['othStoreAddressNo'],
							"OTH_STORE_DISTRICT" => $valAsset['assetsDetail']['othStoreDistrict'],
							"OTH_STORE_DISTRICT_CODE" => $valAsset['assetsDetail']['othStoreDistrictCode'],
							"OTH_STORE_POSTCODE" => $valAsset['assetsDetail']['othStorePostcode'],
							"OTH_STORE_PROVINCE" => $valAsset['assetsDetail']['othStoreProvince'],
							"OTH_STORE_PROVINCE_CODE" => $valAsset['assetsDetail']['othStoreProvinceCode'],
							"OTH_STORE_SUBDISTRICT" => $valAsset['assetsDetail']['othStoreSubdistrict'],
							"OTH_STORE_SUBDISTRICT_CODE" => $valAsset['assetsDetail']['othStoreSubdistrictCode'],
							"OTH_SUBDISTRICT" => $valAsset['assetsDetail']['othSubdistrict'],
							"OTH_SUBDISTRICT_CODE" => $valAsset['assetsDetail']['othSubdistrictCode'],
							"OTH_UNIT_NAME" => $valAsset['assetsDetail']['othUnitName'],
							"OTH_UPDATER" => $valAsset['assetsDetail']['othUpdater'],
							"OTH_UPDATER_ID" => $valAsset['assetsDetail']['othUpdaterId'],
							"OTH_UPDATE_DATE" => ($valAsset['assetsDetail']['othUpdateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['othUpdateDate'])) : '',
							"OTH_USR_KEEP" => $valAsset['assetsDetail']['othUsrKeep'],
							"CFR_ROUND_NUM" => $valAsset['assetsDetail']['cfrRoundNum'],
							"CFR_ROUND_DATE" => ($valAsset['assetsDetail']['cfrRoundDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundDate'])) : '',
							"CFR_ROUND_ACTION_DATE" => ($valAsset['assetsDetail']['cfrRoundActionDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundActionDate'])) : '',
							"CFR_ROUND_TIME" => $valAsset['assetsDetail']['cfrRoundTime'],
						);

						if (pm_check_dup('OTH_ID_PK', $valAsset['assetsDetail']['othIdPk'], $tableInsertDetail) == 0) {
							db::db_insert($tableInsertDetail, $fieldInsertDatail);
						}

						break;

					case '21': // ที่ดินพร้อมสิ่งปลูกสร้าง

						$fieldInsertDatail = array(
							"WH_BANKRUPT_ID" => $WH_BANKRUPT_ID,
							"BOLD_ID_PK" => $valAsset['assetsDetail']['boldIdPk'],
							"BOLD_STATUS" => $valAsset['assetsDetail']['boldStatus'],
							"BOLD_LAD_ID_FK" => $valAsset['assetsDetail']['boldLadIdFk'],
							"BOLD_ASS_ID_FK" => $valAsset['assetsDetail']['boldAssIdFk'],
							"BOLD_BUD_ID_FK" => $valAsset['assetsDetail']['boldBudIdFk'],
							"BRC_ID_PK" => $brcId,
							"CFR_ROUND_NUM" => $valAsset['assetsDetail']['cfrRoundNum'],
							"CFR_ROUND_DATE" => ($valAsset['assetsDetail']['cfrRoundDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundDate'])) : '',
							"CFR_ROUND_ACTION_DATE" => ($valAsset['assetsDetail']['cfrRoundActionDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundActionDate'])) : '',
							"CFR_ROUND_TIME" => $valAsset['assetsDetail']['cfrRoundTime'],
						);

						if (pm_check_dup('BOLD_ID_PK', $valAsset['assetsDetail']['boldIdPk'], $tableInsertDetail) == 0) {
							db::db_insert($tableInsertDetail, $fieldInsertDatail);
						}
						break;

					case '22': // เงิน

						$fieldInsertDatail = array(
							"INCM_ID_PK" => $valAsset['assetsDetail']['incmIdPk'],
							"WH_BANKRUPT_ID" => $WH_BANKRUPT_ID,
							"INCM_ASS_ID_FK" => $valAsset['assetsDetail']['incmAssIdFk'],
							"INCM_ADDRESS_NO" => $valAsset['assetsDetail']['incmAddressNo'],
							"INCM_AMOUNT" => $valAsset['assetsDetail']['incmAmount'],
							"INCM_ATD_ID_FK" => $valAsset['assetsDetail']['incmAtdIdFk'],
							"INCM_CREATE_DATE" => ($valAsset['assetsDetail']['incmCreateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['incmCreateDate'])) : '',
							"INCM_CREATOR" => $valAsset['assetsDetail']['incmCreator'],
							"INCM_CREATOR_ID" => $valAsset['assetsDetail']['incmCreatorId'],
							"INCM_DISTRICT_NAME" => $valAsset['assetsDetail']['incmDistrictName'],
							"INCM_DIS_ID_FK" => $valAsset['assetsDetail']['incmDisIdFk'],
							"INCM_FIRST_RECEIVE_AMOUNT" => $valAsset['assetsDetail']['incmFirstReceiveAmount'],
							"INCM_OTHER_PERIOD_TYPE_TXT" => $valAsset['assetsDetail']['incmOtherPeriodTypeTxt'],
							"INCM_OTHER_SOURCE_TYPE_TXT" => $valAsset['assetsDetail']['incmOtherSourceTypeTxt'],
							"INCM_OTHER_TYPE_TXT" => $valAsset['assetsDetail']['incmOtherTypeTxt'],
							"INCM_PERIOD_TYPE" => $valAsset['assetsDetail']['incmPeriodType'],
							"INCM_POST_CODE" => $valAsset['assetsDetail']['incmPostCode'],
							"INCM_PROVINCE_NAME" => $valAsset['assetsDetail']['incmProvinceName'],
							"INCM_PRV_ID_FK" => $valAsset['assetsDetail']['incmPrvIdFk'],
							"INCM_REG_DOC_TYPE_REF" => $valAsset['assetsDetail']['incmRegDocTypeRef'],
							"INCM_REMARK" => $valAsset['assetsDetail']['incmRemark'],
							"INCM_SDI_ID_FK" => $valAsset['assetsDetail']['incmSdiIdFk'],
							"INCM_SOURCE_NAME" => $valAsset['assetsDetail']['incmSourceName'],
							"INCM_SOURCE_TYPE" => $valAsset['assetsDetail']['incmSourceType'],
							"INCM_STATUS" => $valAsset['assetsDetail']['incmStatus'],
							"INCM_SUBDISTRICT_NAME" => $valAsset['assetsDetail']['incmSubdistrictName'],
							"INCM_UPDATER" => $valAsset['assetsDetail']['incmUpdater'],
							"INCM_UPDATER_ID" => $valAsset['assetsDetail']['incmUpdaterId'],
							"INCM_UPDATE_DATE" => ($valAsset['assetsDetail']['incmUpdateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['incmUpdateDate'])) : '',
							"ASS_ASSET_GROUP" => $valAsset['assetsDetail']['assAssetGroup'],
							"FIND_MONEY_TYPE" => $valAsset['assetsDetail']['findMoneyType'],
							"FIND_MONEY_PERIOD" => $valAsset['assetsDetail']['findMoneyPeriod'],
							"FIND_GET_MONEY_FROM" => $valAsset['assetsDetail']['findGetMoneyFrom'],
							"CFR_ROUND_NUM" => $valAsset['assetsDetail']['cfrRoundNum'],
							"CFR_ROUND_DATE" => ($valAsset['assetsDetail']['cfrRoundDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundDate'])) : '',
							"CFR_ROUND_ACTION_DATE" => ($valAsset['assetsDetail']['cfrRoundActionDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundActionDate'])) : '',
							"CFR_ROUND_TIME" => $valAsset['assetsDetail']['cfrRoundTime'],
						);

						if (pm_check_dup('INCM_ID_PK', $valAsset['assetsDetail']['incmIdPk'], $tableInsertDetail) == 0) {
							db::db_insert($tableInsertDetail, $fieldInsertDatail);
						}

						break;

					case '23': // เงินกบข./เงินกองทุนสำรองเลี้ยงชีพ

						$fieldInsertDatail = array(
							"PROVF_ID_PK" => $valAsset['assetsDetail']['provfIdPk'],
							"WH_BANKRUPT_ID" => $WH_BANKRUPT_ID,
							"PROVF_ASS_ID_FK" => $valAsset['assetsDetail']['provfAssIdFk'],
							"PROVF_ADDRESS_NO" => $valAsset['assetsDetail']['provfAddressNo'],
							"PROVF_AMOUNT" => $valAsset['assetsDetail']['provfAmount'],
							"PROVF_CREATE_DATE" => ($valAsset['assetsDetail']['provfCreateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['provfCreateDate'])) : '',
							"PROVF_CREATOR" => $valAsset['assetsDetail']['provfCreator'],
							"PROVF_CREATOR_ID" => $valAsset['assetsDetail']['provfCreatorId'],
							"PROVF_DISTRICT_NAME" => $valAsset['assetsDetail']['provfDistrictName'],
							"PROVF_DIS_ID_FK" => $valAsset['assetsDetail']['provfDisIdFk'],
							"PROVF_OTHER_SOURCE_TYPE_TXT" => $valAsset['assetsDetail']['provfOtherSourceTypeTxt'],
							"PROVF_POST_CODE" => $valAsset['assetsDetail']['provfPostCode'],
							"PROVF_PROVINCE_NAME" => $valAsset['assetsDetail']['provfProvinceName'],
							"PROVF_PRV_ID_FK" => $valAsset['assetsDetail']['provfPrvIdFk'],
							"PROVF_REG_DOC_TYPE_REF" => $valAsset['assetsDetail']['provfRegDocTypeRef'],
							"PROVF_REMARK" => $valAsset['assetsDetail']['provfRemark'],
							"PROVF_SDI_ID_FK" => $valAsset['assetsDetail']['provfSdiIdFk'],
							"PROVF_SOURCE_NAME" => $valAsset['assetsDetail']['provfSourceName'],
							"PROVF_SOURCE_TYPE" => $valAsset['assetsDetail']['provfSourceType'],
							"PROVF_STATUS" => $valAsset['assetsDetail']['provfStatus'],
							"PROVF_SUBDISTRICT_NAME" => $valAsset['assetsDetail']['provfSubdistrictName'],
							"PROVF_UPDATER" => $valAsset['assetsDetail']['provfUpdater'],
							"PROVF_UPDATER_ID" => $valAsset['assetsDetail']['provfUpdaterId'],
							"PROVF_UPDATE_DATE" => ($valAsset['assetsDetail']['provfUpdateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['provfUpdateDate'])) : '',
							"ASS_ASSET_GROUP" => $valAsset['assetsDetail']['assAssetGroup'],
							"FIND_GET_MONEY_FROM" => $valAsset['assetsDetail']['findGetMoneyFrom'],
							"CFR_ROUND_NUM" => $valAsset['assetsDetail']['cfrRoundNum'],
							"CFR_ROUND_DATE" => ($valAsset['assetsDetail']['cfrRoundDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundDate'])) : '',
							"CFR_ROUND_ACTION_DATE" => ($valAsset['assetsDetail']['cfrRoundActionDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundActionDate'])) : '',
							"CFR_ROUND_TIME" => $valAsset['assetsDetail']['cfrRoundTime'],
						);

						if (pm_check_dup('PROVF_ID_PK', $valAsset['assetsDetail']['provfIdPk'], $tableInsertDetail) == 0) {
							db::db_insert($tableInsertDetail, $fieldInsertDatail);
						}

						break;
					case '24': // สิทธิเรียกร้อง

						$fieldInsertDatail = array(
							"LER_ID_PK" => $valAsset['assetsDetail']['lerIdPk'],
							"WH_BANKRUPT_ID" => $WH_BANKRUPT_ID,
							"LER_ASS_ID_FK" => $valAsset['assetsDetail']['lerAssIdFk'],
							"LER_ASSET_GROUP" => $valAsset['assetsDetail']['lerAssetGroup'],
							"LER_ASSET_VALUE" => $valAsset['assetsDetail']['lerAssetValue'],
							"LER_CREATE_DATE" => ($valAsset['assetsDetail']['lerCreateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['lerCreateDate'])) : '',
							"LER_CREATOR" => $valAsset['assetsDetail']['lerCreator'],
							"LER_CREATOR_ID" => $valAsset['assetsDetail']['lerCreatorId'],
							"LER_LEGAL_RIGHT_IN" => $valAsset['assetsDetail']['lerLegalRightIn'],
							"LER_REF_ASSET_TEXT" => $valAsset['assetsDetail']['lerRefAssetText'],
							"LER_REG_DOC_TYPE_REF" => $valAsset['assetsDetail']['lerRegDocTypeRef'],
							"LER_REMARK" => $valAsset['assetsDetail']['lerRemark'],
							"LER_STATUS" => $valAsset['assetsDetail']['lerStatus'],
							"LER_UPDATER" => $valAsset['assetsDetail']['lerUpdater'],
							"LER_UPDATER_ID" => $valAsset['assetsDetail']['lerUpdaterId'],
							"LER_UPDATE_DATE" => ($valAsset['assetsDetail']['lerUpdateDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['lerUpdateDate'])) : '',
							"CFR_ROUND_NUM" => $valAsset['assetsDetail']['cfrRoundNum'],
							"CFR_ROUND_DATE" => ($valAsset['assetsDetail']['cfrRoundDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundDate'])) : '',
							"CFR_ROUND_ACTION_DATE" => ($valAsset['assetsDetail']['cfrRoundActionDate']) ? date('Y-m-d H:i:s', strtotime($valAsset['assetsDetail']['cfrRoundActionDate'])) : '',
							"CFR_ROUND_TIME" => $valAsset['assetsDetail']['cfrRoundTime'],
						);

						if (pm_check_dup('LER_ID_PK', $valAsset['assetsDetail']['lerIdPk'], $tableInsertDetail) == 0) {
							db::db_insert($tableInsertDetail, $fieldInsertDatail);
						}

						break;
				}

				db::db_delete("WH_BANKRUPT_ASSETS_OWNER", array('ASSET_ID' => $valAsset["assIdPk"]));

				if (isset($valAsset['assetsOwner']) && count($valAsset['assetsOwner']) > 0) {
					foreach ($valAsset['assetsOwner'] as $keyOwner => $valOwner) {
						$fieldOwner = array(
							"ASSET_ID" => $valAsset["assIdPk"],
							"WH_BANKRUPT_ID" => $WH_BANKRUPT_ID,
							"PER_ID" => $valOwner['perId'],
							"RELATE_PROPERTY_TYPE" => $valOwner['relatePropertyType'],
							"RELATE_PROPERTY_NAME" => $valOwner['relatePropertyName'],
							"SEQ" => $valOwner['seq'],
							"PER_FULLNAME" => $valOwner['perFullname'],
							"RELATE_CASE_TYPE" => $valOwner['relateCaseType'],
							"RELATE_CASE_NAME" => $valOwner['relateCaseName'],
							"RELATE_CASE_SEQ" => $valOwner['relateCaseSeq'],
							"PER_TYPE_ID" => $valOwner['perTypeId'],
							"PER_TYPE_NAME" => $valOwner['perTypeName'],
							"NATIONALITY_ID" => $valOwner['nationalityId'],
							"NATIONALITY_NAME" => $valOwner['nationalityName'],
							"PER_IDCARD" => $valOwner['perIdcard'],
							"PREFIX_ID" => $valOwner['prefixId'],
							"PREFIX_NAME" => $valOwner['prefixName'],
							"PER_FNAME" => $valOwner['perFname'],
							"PER_LNAME" => $valOwner['perLname'],
							"COMPANY_IDCRAD" => $valOwner['companyIdcrad'],
							"COMPANY_IDCRAD_OLD" => $valOwner['companyIdcradOld'],
							"COMPANY_NAME_IN_LANE_CODE" => $valOwner['companyNameInLaneCode'],
							"COMPANY_TYPE_ID" => $valOwner['companyTypeId'],
							"COMPANY_TYPE_NAME" => $valOwner['companyTypeName'],
							"DOING_BUSINESS" => $valOwner['doingBusiness'],
							"BRP_RATIO_TYPE" => $valOwner['brpRatioType'],
							"BRP_RATIO_NAME" => $valOwner['brpRatioName'],
							"BRP_RATIO_AREA" => $valOwner['brpRatioArea'],
							"BRP_RATIO_PART" => $valOwner['brpRatioPart'],
							"BRP_RATIO_TOTAL" => $valOwner['brpRatioTotal'],
						);
						db::db_insert("WH_BANKRUPT_ASSETS_OWNER", $fieldOwner, 'WH_OWNER_ASSET_ID', 'WH_OWNER_ASSET_ID');
					}
				}

				db::db_delete("WH_BANKRUPT_ASSETS_MORTGAGE", array('ASSET_ID' => $valAsset["assIdPk"]));

				if (isset($valAsset['assetsMortgage']) && count($valAsset['assetsMortgage']) > 0) {
					foreach ($valAsset['assetsMortgage'] as $keyMortgage => $valMortgage) {
						$fieldMortgage = array(
							"ASSET_ID" => $valAsset["assIdPk"],
							"WH_BANKRUPT_ID" => $WH_BANKRUPT_ID,
							"AMO_ID_PK" => $valMortgage["amoIdPk"],
							"AMO_START_DATE" => ($valMortgage['amoStartDate']) ? date_format(date_create($valMortgage['amoStartDate']), 'Y-m-d') : NULL,
							"AMO_END_DATE" => ($valMortgage['amoEndDate']) ? date_format(date_create($valMortgage['amoEndDate']), 'Y-m-d') : NULL,
							"AMO_MOR_ID_FK" => $valMortgage['amoMorIdFk'],
							"MOR_NAME" => $valMortgage['morName'],
							"PER_FULLNAME" => $valMortgage['perFullname'],
							"AMO_AMOUNT" => $valMortgage['amoAmount'],
							"AMO_REMARK" => $valMortgage['amoRemark'],
							"ASS_DISPLAY_NAME" => $valMortgage['assDisplayName'],
						);
						db::db_insert("WH_BANKRUPT_ASSETS_MORTGAGE", $fieldMortgage);
					}
				}

				db::db_delete("WH_BANKRUPT_ASSETS_MOVEMENT", array('AST_BRA_ID_FK' => $valAsset["braIdPk"]));

				if (isset($valAsset['assetsMovement']) && count($valAsset['assetsMovement']) > 0) {
					foreach ($valAsset['assetsMovement'] as $keyMoveMent => $valMoveMent) {
						$fieldMortgage = array(
							"WH_BANKRUPT_ID" => $WH_BANKRUPT_ID,
							"AST_ID_PK" => $valMoveMent["astIdPk"],
							"AST_STATUS" => $valMoveMent["astStatus"],
							"AST_STATUS_TYPE" => $valMoveMent["astStatusType"],
							"AST_START_DATE" => ($valMoveMent["astStartDate"]) ? date('Y-m-d H:i:s', strtotime($valMoveMent["astStartDate"])) : '',
							"AST_END_DATE" => ($valMoveMent["astEndDate"]) ? date('Y-m-d H:i:s', strtotime($valMoveMent["astEndDate"])) : '',
							"AST_CREATOR" => $valMoveMent["astCreator"],
							"AST_CREATOR_ID" => $valMoveMent["astCreatorId"],
							"AST_CREATE_DATE" => ($valMoveMent["astCreateDate"]) ? date('Y-m-d H:i:s', strtotime($valMoveMent["astCreateDate"])) : '',
							"AST_UPDATER" => $valMoveMent["astUpdater"],
							"AST_UPDATER_ID" => $valMoveMent["astUpdaterId"],
							"AST_UPDATE_DATE" => ($valMoveMent["astUpdateDate"]) ? date('Y-m-d H:i:s', strtotime($valMoveMent["astUpdateDate"])) : '',
							"AST_ASS_ID_FK" => $valMoveMent["astAssIdFk"],
							"AST_REF_ID" => $valMoveMent["astRefId"],
							"AST_REMARK" => $valMoveMent["astRemark"],
							"AST_BRD_ID_FK" => $valMoveMent["astBrdIdFk"],
							"AST_MDT_ID_FK" => $valMoveMent["astMdtIdFk"],
							"AST_BRA_ID_FK" => $valMoveMent["astBraIdFk"],
							"AST_ASTT_ID_FK" => $valMoveMent["astAsttIdFk"],
							"AST_BRK_ID_FK" => $valMoveMent["astBrkIdFk"],
							"ASSET_STATUS_TYPE_NAME" => $valMoveMent["assetStatusTypeName"],
						);
						db::db_insert("WH_BANKRUPT_ASSETS_MOVEMENT", $fieldMortgage);
					}
				}
			}
		}
	}

	return $WH_BANKRUPT_ID;

	/* stop เพิ่มการบันทึก ทรัพ เเละ ทรัพเป็นของใคร */
}
/* Nop stop ดึงล้มละลาย ให้เรียงโจทย์จำเลยตามลำดับ */


function getCivilReciept($pccCivilGen, $show_data)
{
	$curl = curl_init();

	global $WF_GET_RECIEPT;

	curl_setopt_array($curl, array(
		CURLOPT_URL => $WF_GET_RECIEPT,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => '{
            "USERNAME":"BankruptDt",
            "PASSWORD":"Debtor4321",
            "pccCivilGen":"' . $pccCivilGen . '"
        }',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
		),
	));

	$response = curl_exec($curl);

	curl_close($curl);

	$dataReturn = json_decode($response, true);

	if ($show_data == 'Y') {
		print_pre($dataReturn);
	}

	$sqlSelectData = "	SELECT 		WH_CIVIL_ID
                        FROM 		WH_CIVIL_CASE
                        WHERE 		CIVIL_CODE = '$pccCivilGen'
                    ";
	$querySelectData = db::query($sqlSelectData);
	$num = db::num_rows($querySelectData);
	$dataSelectData = db::fetch_array($querySelectData);

	if ($dataSelectData["WH_CIVIL_ID"] > 0) {

		$WH_CIVIL_ID = $dataSelectData["WH_CIVIL_ID"];

		db::db_delete("WH_CIVIL_CASE_RECEIPT", array('WH_CIVIL_ID' => $WH_CIVIL_ID));
		db::db_delete("WH_CIVIL_CASE_RECEIPT_PERSON", array('WH_CIVIL_ID' => $WH_CIVIL_ID));
		db::db_delete("WH_CIVIL_CASE_RECEIPT_LIST", array('WH_CIVIL_ID' => $WH_CIVIL_ID));
		db::db_delete("WH_CIVIL_CASE_RECEIVING", array('WH_CIVIL_ID' => $WH_CIVIL_ID));

		if ($dataReturn['ResponseCode']['ResCode'] == '000') {
			foreach ($dataReturn['Data'] as $key => $val) {
				// echo "<pre>";
				// print_r($val);
				// echo "</pre><hr>";


				unset($Field);
				//--- คดีดำ
				$Field['PREFIX_BLACK_CASE'] = $val['prefixBlackCase'];
				$Field['BLACK_CASE'] = $val['blackCase'];
				$Field['BLACK_YY'] = $val['blackYy'];
				//--- คดีแดง
				$Field['PREFIX_RED_CASE'] = $val['prefixRedCase'];
				$Field['RED_CASE'] = $val['redCase'];
				$Field['RED_YY'] = $val['redYy'];
				//--- รายละเอียด

				$Field['WH_CIVIL_ID'] = $WH_CIVIL_ID;
				$Field['WH_RECEIPT_ID'] = $val['audReceiptGen'];    // pk
				$Field['RECEIPT_NO'] = ($val['trNo']) ? $val['trNo'] . '/' . $val['trBookNo'] : ''; // เลขที่ใบเสร็จรับเงิน
				$Field['RECEIPT_NAME'] = $val['trFrom'];    // ผู้ชำระระเงิน
				$Field['DOC_DATE'] = date_format(date_create($val['trDate']), "Y-m-d");
				$Field['RECORD_COUNT'] = '';    // จำนวนรายการ
				$Field['SEQ'] = $val['trSeq'];
				$Field['MONEY'] = $val['trAmount'];
				$Field['ACCOUNT_NO'] = $val['accCode'];
				$Field['"COMMENT"'] = $val['trComment'];
				$Field['VATRATE'] = $val['vatRate'];
				$Field['FY'] =  $val['fy'];    // ปีงบ	
				$Field['DEBTORNO'] = $val['debtorNo'];    // ลำดับที่ผู้ถูกทวงหนี้   
				$Field['CIVIL_CODE'] =  $pccCivilGen;
				$Field['CASE_CODE'] =  $val['caseCode'];
				$Field['CASE_NAME'] =  $val['caseName'];
				$Field['COURT_CODE'] =  $val['courtCode'];
				$Field['COURT_NAME'] =  $val['courtName'];
				$Field['DOSS_CODE'] =  $val['dossCode'];
				$Field['DOSS_NAME'] =  $val['dossName'];
				$Field['RECTYPE_CODE'] =  $val['rectypeCode'];
				$Field['RECTYPE_NAME'] =  $val['rectypeName'];
				$Field['FDOC_CODE'] =  $val['fdocCode'];
				$Field['FDOC_NAME'] =  $val['fdocName'];
				$Field['RECEIPT_DATE'] = date_format(date_create($val['receiptDate']), "Y-m-d");
				$Field['VAT_AMOUNT'] =  $val['vatAmount'];
				$Field['ACTUAL_AMOUNT'] =  $val['actualAmount'];
				$Field['CANCEL_FLAG'] =  $val['cancelFlag'];
				$Field['CANCEL_FLAG_NAME'] =  $val['cancelFlagName'];
				// $Field['WH_DOSS_ID'] = '';
				// $Field['RECEIPT_CODE'] = ''; // เลข Gen ใบเสร็จจากแพ่ง
				// $Field['PERSON_CODE'] = '';

				if (pm_check_dup('WH_RECEIPT_ID', $val['audReceiptGen'], "WH_CIVIL_CASE_RECEIPT")) {
					db::db_insert("WH_CIVIL_CASE_RECEIPT", $Field);
				}

				foreach ($val['person'] as $valperson) {
					unset($Field);
					$Field['WH_RECEIPT_ID'] = $val['audReceiptGen'];
					$Field['WH_CIVIL_ID'] = $WH_CIVIL_ID;
					$Field['NAME'] = $valperson['name'];
					$Field['CONCERN_NAME'] = $valperson['concernName'];
					$Field['CONCERN_NO'] = $valperson['concernNo'];
					$Field['PERSON_CODE'] = $valperson['shrPersonGen'];
					db::db_insert("WH_CIVIL_CASE_RECEIPT_PERSON", $Field);
				}

				foreach ($val['receiptList'] as $receiptList) {
					unset($Field);
					$Field['WH_RECEIPT_ID'] = $val['audReceiptGen'];
					$Field['WH_CIVIL_ID'] = $WH_CIVIL_ID;
					$Field['RECPAY_NAME'] = $receiptList['recpayName'];
					$Field['TR_COMMENT'] = $receiptList['trComment'];
					$Field['TR_AMOUNT'] = $receiptList['trAmount'];
					db::db_insert("WH_CIVIL_CASE_RECEIPT_LIST", $Field);
				}

				foreach ($val['receiving'] as $receiving) {
					unset($Field);
					$Field['WH_RECEIPT_ID'] = $val['audReceiptGen'];
					$Field['WH_CIVIL_ID'] = $WH_CIVIL_ID;
					$Field['RPAY_NAME'] = $receiving['rpayName'];
					$Field['CHQ_NO'] = $receiving['chqNo'];
					$Field['CHQ_DATE'] =  date_format(date_create($receiving['chqDate']), "Y-m-d");
					$Field['TR_DESC'] = $receiving['trDesc'];
					$Field['TRANSFER_DATE'] = ($receiving['transferDate']) ? date_format(date_create($receiving['transferDate']), "Y-m-d") : NULL;
					$Field['TR_AMOUNT'] = $receiving['trAmount'];
					db::db_insert("WH_CIVIL_CASE_RECEIVING", $Field);
				}
			}
		}
	} else {
	}
}

function getAccountIncomeExpensesCivilCase($pccCaseGen, $show_data = '')
{

	global $WF_CIVIL_GET_ACCOUNT_INCOME_EXPENSES;
	$txtFunc = 'บัญชีรับจ่าย';

	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => $WF_CIVIL_GET_ACCOUNT_INCOME_EXPENSES,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => '{
			"USERNAME":"BankruptDt",
			"PASSWORD":"Debtor4321",
			"pccCaseGen":"' . $pccCaseGen . '"
		}',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/x-www-form-urlencoded'
		),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	$dataReturn = json_decode($response, true);

	if ($show_data == 'Y') {
		print_pre($dataReturn);
	}

	// PC.PCC_CASE_GEN = 4716534 OR 
	// PC.PCC_CASE_GEN = 4716621 OR
	// PC.PCC_CASE_GEN = 1283099

	// WH_CIVIL_CASE_ACCOUNT_LIST
	// WH_CIVIL_CASE_ACCOUNT_INCEXP

	$txtAlert = '';

	if (isset($dataReturn["ResponseCode"])) {
		if (isset($dataReturn['Data']) && count($dataReturn['Data']) > 0) {

			db::db_delete('WH_CIVIL_CASE_ACCOUNT_LIST',	array("PCC_CASE_GEN" => $pccCaseGen));
			db::db_delete('WH_CIVIL_CASE_ACCOUNT_INCEXP', array("PCC_CASE_GEN" => $pccCaseGen));
			// exit;
			foreach ($dataReturn["Data"] as $dataMain) {

				unset($fields);
				$fields["AUD_PRIVATE_GEN"]		= $dataMain["AUD_PRIVATE_GEN"];
				$fields["AUD_PRIVATE_CENT_DEPT_GEN"]	= $dataMain["AUD_PRIVATE_CENT_DEPT_GEN"];
				$fields["PCC_CASE_GEN"]			= $dataMain["PCC_CASE_GEN"];
				$fields["ACC_CODE"]				= $dataMain["ACC_CODE"];
				$fields["ACC_NAME"]				= $dataMain["ACC_NAME"];
				$fields["CASE_CODE"]			= $dataMain["CASE_CODE"];
				$fields["CASE_NAME"]			= $dataMain["CASE_NAME"];
				$fields["DOSS_CODE"]			= $dataMain["DOSS_CODE"];
				$fields["DOSS_NAME"]			= $dataMain["DOSS_NAME"];
				$fields["COURT_CODE"]			= $dataMain["COURT_CODE"];
				$fields["COURT_NAME"]			= $dataMain["COURT_NAME"];
				$fields["RECV_NO"]				= $dataMain["RECV_NO"];
				$fields["RECV_YEAR"]			= $dataMain["RECV_YEAR"];
				$fields["PREFIX_BLACK_CASE"]	= $dataMain["PREFIX_BLACK_CASE"];
				$fields["BLACK_CASE"]			= $dataMain["BLACK_CASE"];
				$fields["BLACK_YY"]				= $dataMain["BLACK_YY"];
				$fields["PREFIX_RED_CASE"]		= $dataMain["PREFIX_RED_CASE"];
				$fields["RED_CASE"]				= $dataMain["RED_CASE"];
				$fields["RED_YY"]				= $dataMain["RED_YY"];
				$fields["PLAINTIFF1"]			= $dataMain["PLAINTIFF1"];
				$fields["PLAINTIFF2"]			= $dataMain["PLAINTIFF2"];
				$fields["DEFENDANT1"]			= $dataMain["DEFENDANT1"];
				$fields["DEFENDANT2"]			= $dataMain["DEFENDANT2"];
				$fields["ACC_AMOUNT"]			= $dataMain["ACC_AMOUNT"];
				$fields["ACC_DATE"]				= ($dataMain["ACC_DATE"]) ? date('Y-m-d', strtotime($dataMain["ACC_DATE"])) : '';
				$fields["MONEY_TOGETHER"]		= $dataMain["MONEY_TOGETHER"];
				$fields["INCOME"]				= $dataMain["INCOME"];
				$fields["EXPENSES"]				= $dataMain["EXPENSES"];
				$fields["BALANCE_AMOUNT"]		= $dataMain["BALANCE_AMOUNT"];
				// $fields["PLAINTIFF3"]		= $dataMain["PLAINTIFF3"];
				// $fields["DEFENDANT3"]		= $dataMain["DEFENDANT3"];

				db::db_insert("WH_CIVIL_CASE_ACCOUNT_LIST", $fields);
				$INCEXP_I = 1;
				foreach ($dataMain['INC_EXP'] as $incExp) {
					unset($fieldIncExp, $INCEXP_TYPE);

					if ($incExp["D_AMOUNT"] != '') {
						$INCEXP_TYPE = 1;
					} else {
						$INCEXP_TYPE = 2;
					}

					$fieldIncExp['AUD_PRIVATE_GEN'] = $dataMain["AUD_PRIVATE_GEN"];
					$fieldIncExp["PCC_CASE_GEN"] 	= $dataMain["PCC_CASE_GEN"];
					$fieldIncExp["TR_DATE"] 		= ($incExp["TR_DATE"]) ? date('Y-m-d', strtotime($incExp["TR_DATE"])) : '';
					$fieldIncExp["TR_NO_BOOK_NO"] 	= $incExp["TR_NO_BOOK_NO"];
					$fieldIncExp["RECPAY_NAME"] 	= $incExp["RECPAY_NAME"];
					$fieldIncExp["D_AMOUNT"] 		= $incExp["D_AMOUNT"];
					$fieldIncExp["C_AMOUNT"]		= $incExp["C_AMOUNT"];
					$fieldIncExp["INCEXP_TYPE"] 	= $INCEXP_TYPE;
					$fieldIncExp["SEQ"] 			= $INCEXP_I;

					db::db_insert("WH_CIVIL_CASE_ACCOUNT_INCEXP", $fieldIncExp);
					$INCEXP_I++;
				}
			}

			$txtAlert = 'ดึงข้อมูล "' . $txtFunc . '" เสร็จสิ้น';
		} else {
			$txtAlert = 'ไม่พบข้อมูล "' . $txtFunc . '" ';
		}
	} else {
		$txtAlert = 'ดึงข้อมูล "' . $txtFunc . '" ล้มเหลว';
	}

	return $txtAlert;
}

function getOrderCivilCase($pccCaseGen, $show_data = '')
{
	global $WF_GET_ORDER_CIVIL_CASE;
	$txtFunc = 'ใบสั่งจ่าย';

	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => $WF_GET_ORDER_CIVIL_CASE,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => '{
			"USERNAME":"BankruptDt",
			"PASSWORD":"Debtor4321",
			"pccCaseGen":"' . $pccCaseGen . '"
		}',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/x-www-form-urlencoded'
		),

	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	$dataReturn = json_decode($response, true);

	if ($show_data == 'Y') {
		print_pre($dataReturn);
	}

	$txtAlert = '';

	if (isset($dataReturn["ResponseCode"])) {
		if (isset($dataReturn['Data']) && count($dataReturn['Data']) > 0) {

			db::db_delete("WH_CIVIL_CASE_ORDER", array('PCC_CASE_GEN' => $pccCaseGen));
			db::db_delete("WH_CIVIL_ORDER_LIST", array('PCC_CASE_GEN' => $pccCaseGen));
			db::db_delete("WH_CIVIL_ORDER_FOREIGNER", array('PCC_CASE_GEN' => $pccCaseGen));

			foreach ($dataReturn["Data"] as $dataMain) {

				unset($fields);
				$fields["AUD_PAID_GEN"] 		= $dataMain["AUD_PAID_GEN"];
				$fields["PCC_CASE_GEN"] 		= $dataMain["PCC_CASE_GEN"];
				$fields["CASE_CODE"] 			= $dataMain["CASE_CODE"];
				$fields["CASE_NAME"] 			= $dataMain["CASE_NAME"];
				$fields["PAY_TYPES"] 			= $dataMain["PAY_TYPES"];
				$fields["PAY_NAME"] 			= $dataMain["PAY_NAME"];
				$fields["ACC_CODE"] 			= $dataMain["ACC_CODE"];
				$fields["COURT_CODE"] 			= $dataMain["COURT_CODE"];
				$fields["COURT_NAME"] 			= $dataMain["COURT_NAME"];
				$fields["RECV_NO"] 				= $dataMain["RECV_NO"];
				$fields["RECV_YEAR"] 			= $dataMain["RECV_YEAR"];
				$fields["PLAINTIFF1"] 			= $dataMain["PLAINTIFF1"];
				$fields["PLAINTIFF2"] 			= $dataMain["PLAINTIFF2"];
				$fields["PLAINTIFF3"] 			= $dataMain["PLAINTIFF3"];
				$fields["DEFENDANT1"] 			= $dataMain["DEFENDANT1"];
				$fields["DEFENDANT2"] 			= $dataMain["DEFENDANT2"];
				$fields["DEFENDANT3"] 			= $dataMain["DEFENDANT3"];
				$fields["DOSS_CODE"] 			= $dataMain["DOSS_CODE"];
				$fields["DOSS_NAME"] 			= $dataMain["DOSS_NAME"];
				$fields["CANCEL_FLAG"] 			= $dataMain["CANCEL_FLAG"];
				$fields["PREFIX_BLACK_CASE"]	= $dataMain["PREFIX_BLACK_CASE"];
				$fields["BLACK_CASE"] 			= $dataMain["BLACK_CASE"];
				$fields["BLACK_YY"] 			= $dataMain["BLACK_YY"];
				$fields["PREFIX_RED_CASE"] 		= $dataMain["PREFIX_RED_CASE"];
				$fields["RED_CASE"] 			= $dataMain["RED_CASE"];
				$fields["RED_YY"] 				= $dataMain["RED_YY"];
				$fields["TR_NO"] 				= $dataMain["TR_NO"];
				$fields["TR_BOOK_NO"] 			= $dataMain["TR_BOOK_NO"];
				$fields["PAID_TYPE"] 			= $dataMain["PAID_TYPE"];
				$fields["TR_DATE"] 				= ($dataMain["TR_DATE"]) ? date('Y-m-d', strtotime($dataMain["TR_DATE"])) : '';
				$fields["FY"] 					= $dataMain["FY"];
				$fields["FDOC_CODE"]			= $dataMain["FDOC_CODE"];
				$fields["FDOC_NAME"]			= $dataMain["FDOC_NAME"];
				$fields["TR_TO1"] 				= $dataMain["TR_TO1"];
				$fields["TR_TO2"] 				= $dataMain["TR_TO2"];
				$fields["TR_COMMENT"]			= $dataMain["TR_COMMENT"];
				$fields["OWNER_SAVE_NAME"] 		= $dataMain["OWNER_SAVE_NAME"];
				$fields["PAID_TYPE_NAME"] 		= $dataMain["PAID_TYPE_NAME"];
				$fields["CANCEL_FLAG_NAME"]		= $dataMain["CANCEL_FLAG_NAME"];

				db::db_insert("WH_CIVIL_CASE_ORDER", $fields);

				if (count($dataMain['FOREIGNER_LIST']) > 0) {
					foreach ($dataMain['FOREIGNER_LIST'] as $key => $foreignerList) {

						unset($fieldsList);
						$fieldsList["AUD_PAID_GEN"]		= $dataMain["AUD_PAID_GEN"];
						$fieldsList["PCC_CASE_GEN"]		= $dataMain["PCC_CASE_GEN"];
						$fieldsList["FY"]				= $foreignerList["FY"];
						$fieldsList["CONCERN_NO"]		= $foreignerList["CONCERNNO"];
						$fieldsList["TITLE_NAME"]		= $foreignerList["TITLENAME"];
						$fieldsList["FNAME"]			= $foreignerList["FNAME"];
						$fieldsList["LNAME"]			= $foreignerList["LNAME"];
						$fieldsList["CONCERN_CODE"]		= $foreignerList["CONCERN_CODE"];
						$fieldsList["CONCERN_NAME"]		= $foreignerList["CONCERN_NAME"];
						$fieldsList["TITLE_NAME_AUTH"]	= $foreignerList["TITLENAMEAUTH"];
						$fieldsList["FNAME_AUTH"]		= $foreignerList["FNAMEAUTH"];
						$fieldsList["LNAME_AUTH"]		= $foreignerList["LNAMEAUTH"];
						$fieldsList["PAY_TYPES"]		= $foreignerList["PAY_TYPES"];
						$fieldsList["PAY_TYPES_NAME"]	= $foreignerList["PAY_TYPES_NAME"];

						db::db_insert("WH_CIVIL_ORDER_FOREIGNER", $fieldsList);
					}
				}

				if (count($dataMain['ORDER_LIST']) > 0) {
					foreach ($dataMain['ORDER_LIST'] as $key => $orderList) {

						unset($fieldsList);
						$fieldsList["AUD_PAID_DETAIL_GEN"]	= $orderList["AUD_PAID_DETAIL_GEN"];
						$fieldsList["PCC_CASE_GEN"]			= $orderList["PCC_CASE_GEN"];
						$fieldsList["AUD_PAID_GEN"]			= $orderList["AUD_PAID_GEN"];
						$fieldsList["TR_SEQ"]				= $orderList["TR_SEQ"];
						$fieldsList["ACC_SEQ"]				= $orderList["ACC_SEQ"];
						$fieldsList["SENDWRIT_BOOK_NO"]		= $orderList["SENDWRIT_BOOK_NO"];
						$fieldsList["SENDWRIT_BOOK_DATE"]	= ($orderList["SENDWRIT_BOOK_DATE"]) ? date('Y-m-d', strtotime($orderList["SENDWRIT_BOOK_DATE"])) : '';
						$fieldsList["RECPAY_CODE"]			= $orderList["RECPAY_CODE"];
						$fieldsList["RECPAY_NAME"]			= $orderList["RECPAY_NAME"];
						$fieldsList["TR_AMOUNT"]			= $orderList["TR_AMOUNT"];

						db::db_insert("WH_CIVIL_ORDER_LIST", $fieldsList);
					}
				}

				if (count($dataMain['PAYMENT_LIST']) > 0) {
					foreach ($dataMain['PAYMENT_LIST'] as $key => $paymentList) {

						unset($fieldsList);
						$fieldsList["AUD_PAID_GEN"]		= $dataMain["AUD_PAID_GEN"];
						$fieldsList["PCC_CASE_GEN"]		= $dataMain["PCC_CASE_GEN"];
						$fieldsList["TR_SEQ"]			= $paymentList["TR_SEQ"];
						$fieldsList["RPAY_NAME"]		= $paymentList["RPAY_NAME"];
						$fieldsList["AUD_CASEBANK_GEN"]	= $paymentList["AUD_CASEBANK_GEN"];
						$fieldsList["BANK_NAME"]		= $paymentList["BANK_NAME"];
						$fieldsList["BBRANCH_NAME"]		= $paymentList["BBRANCH_NAME"];
						$fieldsList["TR_DESC"]			= $paymentList["TR_DESC"];
						$fieldsList["CHQ_NO"]			= $paymentList["CHQ_NO"];
						$fieldsList["CHQ_DATE"]			= ($paymentList['CHQ_DATE']) ? date_format(date_create($paymentList['CHQ_DATE']), "Y-m-d") : NULL;
						$fieldsList["TR_AMOUNT"]		= $paymentList["TR_AMOUNT"];

						db::db_insert("WH_CIVIL_ORDER_PAYMENT", $fieldsList);
					}
				}
			}

			$txtAlert = 'ดึงข้อมูล "' . $txtFunc . '" เสร็จสิ้น';
		} else {
			$txtAlert = 'ไม่พบข้อมูล "' . $txtFunc . '" ';
		}
	} else {
		$txtAlert = 'ดึงข้อมูล "' . $txtFunc . '" ล้มเหลว';
	}

	return $txtAlert;
}

function pm_check_dup($key, $val, $table)
{
	$sql = "SELECT COUNT($key) AS NUM FROM $table WHERE $key = '$val' ";
	$qry = db::query($sql);
	$num = 0;
	while ($rec = db::fetch_array($qry)) {
		$num = $rec['NUM'];
	}
	return $num;
}


function pm_check_dup_arr($condition, $table)
{
	$wh = "";
	$i = 0;
	foreach ($condition as $_k => $_v) {
		if ($i > 0) {
			$wh .= " AND ";
		}
		$wh .= " $_k = '{$_v}' ";
		$i++;
	}
	$sql = "SELECT * FROM $table WHERE $wh";
	$qry = db::query($sql);
	$arr = array();
	while ($rec = db::fetch_array($qry)) {
		$arr[] = $rec;
	}
	return count($arr);
}