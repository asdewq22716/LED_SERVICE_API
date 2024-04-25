<?php

include '../phpvendor/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
	/* stop */

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
					$fieldsOwner["CONCERNCODE"] 	= $data_owner["concernCode"];
					$fieldsOwner["CONCERNNAME"] 	= $data_owner["concernName"];
					$fieldsOwner["REGISTERID"] 	= $data_owner["registerId"];
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
/* Nop start ดึงเเพ่งเเบบเร็ว  */
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
					db::db_insert("WH_CIVIL_ROUTE",$fields,'WH_ROUTE_ID','WH_ROUTE_ID');
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


		unset($fields);
		$fields["WH_REHAB_ID"] 			= $WH_REHAB_ID;
		$fields["PERSON_CODE"] 			= $data_main["CONCERN_CODE"];
		$fields["REGISTER_CODE"] 		= (trim($data_main["CORPORATE"]) != "") ? str_replace('-', '', $data_main["CORPORATE"]) : str_replace('-', '', $data_main["DEB_ID"]);

		$fields["PREFIX_NAME"] 			= $data_main["PREFIX_REHAB"];
		$fields["FIRST_NAME"] 			= $data_main["NAME_REHAB"];
		//$fields["LAST_NAME"] 			= $data_main["NAME_REHAB"];
		$fields["FULL_NAME"] 			= $data_main["FULLNAME_REHAB"];

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
			$checkLoop = 1;
			foreach ($data_main["DATA"]["F20_DETAIL"] as $key => $val) {
				if ($checkLoop <= 10) {
					unset($fields);
					$fields["WH_REHAB_ID"] 			= $WH_REHAB_ID;
					$fields["PERSON_CODE"] 			= $val["CONCERN_CODE"];
					$fields["REGISTER_CODE"] 		= (trim($val["CORPORATE"]) != "") ? str_replace('-', '', $val["CORPORATE"]) : str_replace('-', '', $val["CRE20_CODE1"]);

					$fields["PREFIX_NAME"] 			= $val["CRE20_TITLE1"];
					$fields["FIRST_NAME"] 			= $val["CRE20_NAME1_TH"];
					//$fields["LAST_NAME"] 			= $val["NAME_REHAB"];
					$fields["FULL_NAME"] 			= $val["FULLNAME_REHAB20"];

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
				}
				$checkLoop++;
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
					$fields["REGISTER_CODE"] 		= str_replace('-', '', $val_data["registerCode"]);

					$fields["PREFIX_NAME"] 			= $val_data["prefixName"];
					$fields["FIRST_NAME"] 			= $val_data["fullName"];
					$fields["FULL_NAME"] 			= $val_data["fullName"];

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
				$fields["REGISTER_CODE"] 		= (trim($ObjPer["CORPORATE_ID"]) != "") ? str_replace('-', '', $ObjPer["CORPORATE_ID"]) : str_replace('-', '', $ObjPer["DEBT_CODE"]);

				$fields["PREFIX_NAME"] 			= $ObjPer["DEBTOR_NAME_TITLE"];
				$fields["FIRST_NAME"] 			= $ObjPer["FULLNAME_MIN_DEBT"];
				//$fields["LAST_NAME"] 			= $val["NAME_REHAB"];
				$fields["FULL_NAME"] 			= $ObjPer["FULLNAME_MIN_DEBT"];

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
				db::db_insert("WH_REHABILITATION_PERSON", $fields, 'WH_PERSON_ID', 'WH_PERSON_ID');
			}
		}


		if (count($data_main["DATA"]["MIN_CAN_DETAIL"]) > 0) {
			foreach ($data_main["DATA"]["MIN_CAN_DETAIL"] as $key => $ObjPer) {

				unset($fields);
				$fields["WH_REHAB_ID"] 			= $WH_REHAB_ID;
				$fields["PERSON_CODE"] 			= $ObjPer["CONCERN_CODE"];
				$fields["REGISTER_CODE"] 		= (trim($ObjPer["CORPORATE_ID"]) != "") ? str_replace('-', '', $ObjPer["CORPORATE_ID"]) : str_replace('-', '', $ObjPer["DEBT_CODE"]);

				$fields["PREFIX_NAME"] 			= $ObjPer["DEBTOR_NAME_TITLE"];
				$fields["FIRST_NAME"] 			= $ObjPer["FULLNAME_MIN_CAN"];
				//$fields["LAST_NAME"] 			= $val["NAME_REHAB"];
				$fields["FULL_NAME"] 			= $ObjPer["FULLNAME_MIN_CAN"];

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
				db::db_insert("WH_REHABILITATION_PERSON", $fields, 'WH_PERSON_ID', 'WH_PERSON_ID');
			}
		}

		if (count($data_main["DATA"]["MIN_CLE_DETAIL"]) > 0) {
			foreach ($data_main["DATA"]["MIN_CLE_DETAIL"] as $key => $ObjPer) {

				unset($fields);
				$fields["WH_REHAB_ID"] 			= $WH_REHAB_ID;
				$fields["PERSON_CODE"] 			= $ObjPer["CONCERN_CODE"];
				$fields["REGISTER_CODE"] 		= (trim($ObjPer["ID_CARD"]) != "") ? str_replace('-', '', $ObjPer["ID_CARD"]) : str_replace('-', '', $ObjPer["DEBT_CODE"]);

				$fields["PREFIX_NAME"] 			= $ObjPer["DEBTOR_NAME_TITLE"];
				$fields["FIRST_NAME"] 			= $ObjPer["CLE_NAME_TH"];
				//$fields["LAST_NAME"] 			= $val["NAME_REHAB"];
				$fields["FULL_NAME"] 			= $ObjPer["FULLNAME_MIN_CLE"];

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
	$fieldsPer["PERSON_CODE"] 		= $dataReturn["Data"]["plaintiffType"];
	$fieldsPer["REGISTER_CODE"] 	= $dataReturn["Data"]["plaintiffIdCard"];
	$fieldsPer["PREFIX_CODE"] 		= $dataReturn["Data"]["plaintiffPrefixCode"];
	$fieldsPer["PREFIX_NAME"] 		= $dataReturn["Data"]["plaintiffPrefixName"];
	$fieldsPer["FIRST_NAME"] 		= $dataReturn["Data"]["plaintiffFname"];
	$fieldsPer["LAST_NAME"] 		= $dataReturn["Data"]["plaintiffLname"];
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

	$fieldsPer["ADDRESS"] 			= $dataReturn["Data"]["plaintiffAddeNO"];
	$fieldsPer["TUM_NAME"] 			= $dataReturn["Data"]["plaintiffTum"];
	$fieldsPer["AMP_NAME"] 			= $dataReturn["Data"]["plaintiffAmph"];
	$fieldsPer["PROV_NAME"] 		= $dataReturn["Data"]["plaintiffProv"];
	$fieldsPer["ZIP_CODE"] 			= $dataReturn["Data"]["plaintiffZipcode"];

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
	$fieldsPer["PERSON_CODE"] 		= $dataReturn["Data"]["defendantType"];
	$fieldsPer["REGISTER_CODE"] 	= $dataReturn["Data"]["defendantIdCard"];
	$fieldsPer["PREFIX_CODE"] 		= $dataReturn["Data"]["defendantPrefixCode"];
	$fieldsPer["PREFIX_NAME"] 		= $dataReturn["Data"]["defendantPrefixName"];
	$fieldsPer["FIRST_NAME"] 		= $dataReturn["Data"]["defendantFname"];
	$fieldsPer["LAST_NAME"] 		= $dataReturn["Data"]["defendantLname"];
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

	$fieldsPer["ADDRESS"] 			= $dataReturn["Data"]["defendantAddeNO"];
	$fieldsPer["TUM_NAME"] 			= $dataReturn["Data"]["defendantTum"];
	$fieldsPer["AMP_NAME"] 			= $dataReturn["Data"]["defendantAmph"];
	$fieldsPer["PROV_NAME"] 		= $dataReturn["Data"]["defendantProv"];
	$fieldsPer["ZIP_CODE"] 			= $dataReturn["Data"]["defendantZipcode"];

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
	//ผลการไกล่เกลี่ย
	unset($fieldResult);
	$fieldResult["WH_MEDIATE_ID"] 		= $WH_MEDAITE_ID;
	$fieldResult["COURT_CODE"] 			= $dataReturn["Data"]["courtCode"];
	$fieldResult["COURT_NAME"] 			= $dataReturn["Data"]["courtName"];
	$fieldResult["PREFIX_BLACK_CASE"] 	= $dataReturn["Data"]["blackCaseTitle"];
	$fieldResult["BLACK_CASE"] 			= $dataReturn["Data"]["blackCase"];
	$fieldResult["BLACK_YY"] 			= $dataReturn["Data"]["blackYear"];
	$fieldResult["PREFIX_RED_CASE"] 	= $dataReturn["Data"]["redCaseTitile"];
	$fieldResult["RED_CASE"] 			= $dataReturn["Data"]["redCase"];
	$fieldResult["RED_YY"] 				= $dataReturn["Data"]["redYear"];

	$fieldResult["MEDIATOR_NAME"] 		= $dataReturn["Data"]["mediatorName"];
	$fieldResult["MEDIATE_NO"] 			= $dataReturn["Data"]["mediateNo"];
	$fieldResult["PAYMENT_AMOUNT_DEF"] 	= $dataReturn["Data"]["paymentAmountDef"];
	$fieldResult["MEDIATE_RESULT"] 		= $dataReturn["Data"]["mediatorResult"];
	$fieldResult["PLAINTIFF1"] 			=  $dataReturn["Data"]["plaintiffPrefix"] . $dataReturn["Data"]["plaintiffFname"] . " " . $dataReturn["Data"]["plaintiffLname"];
	$fieldResult["DEFFENDANT1"] 		=  $dataReturn["Data"]["defendantPrefix"] . $dataReturn["Data"]["defendantFname"] . " " . $dataReturn["Data"]["defendantLname"];
	$fieldResult["COURT_DATE"] 			=  $dataReturn["Data"]["reqDate"];
	$fieldResult["CAPITAL_AMOUNT"] 		=  $dataReturn["Data"]["CapitalAmount"];
	$fieldResult["CHANNEL_NAME"] 		=  $dataReturn["Data"]["channelName"];

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


/* Nop start ดึงล้มละลาย ให้เรียงโจทย์จำเลยตามลำดับ */

function getBankruptToWh_num($brcId = "", $show_data = "")
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
	//person คนในคดี
	db::db_delete("WH_BANKRUPT_CASE_PERSON", array('WH_BANKRUPT_ID' => $WH_BANKRUPT_ID));
	if (count($data_main['person']) > 0) {
		foreach ($data_main['person'] as $key => $data_person) {
			unset($fields);
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

			$fields["CONERNSEQ"] 					= $data_person["conernSeq"]; //Nop 

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


	/* start เพิ่มการบันทึก ทรัพ เเละ ทรัพเป็นของใคร */
	db::db_delete("WH_BANKRUPT_ASSETS", array('WH_BANKRUPT_ID' => $WH_BANKRUPT_ID));
	echo count($data_main["asset"]);
	if (count($data_main["asset"]) > 0) {
		foreach ($data_main["asset"] as $key => $valFile) {
			unset($fields);
			$fields["WH_BANKRUPT_ID"] 			=  $WH_BANKRUPT_ID;
			$fields["PROP_TITLE"] 			=  $valFile["assetsDisplay"]; //รายละเอียดทรัพย์
			$fields["PROP_STATUS_NAME"] 			=  $valFile["assetsStatus"];
			$fields["TYPE_CODE_NAME"] 			=  $valFile["assetsType"];
			$fields["EST_ASSET_PRICE1"] 			=  $valFile["assetsPrice"];
			//คดีดำ
			$fields["PREFIX_BLACK_CASE"] 	= $data_main["prefixBlackCase"];
			$fields["BLACK_CASE"] 			= $data_main["blackCase"];
			$fields["BLACK_YY"] 			= $data_main["blackYY"];
			//คดีเเดง
			$fields["PREFIX_RED_CASE"] 		= $data_main["prefixRedCase"];
			$fields["RED_CASE"] 			= $data_main["redCase"];
			$fields["RED_YY"] 				= $data_main["redYY"];

			db::db_insert("WH_BANKRUPT_ASSETS", $fields, 'WH_ASSET_ID', 'WH_ASSET_ID');
		}
	}

	/* stop เพิ่มการบันทึก ทรัพ เเละ ทรัพเป็นของใคร */
}
/* Nop stop ดึงล้มละลาย ให้เรียงโจทย์จำเลยตามลำดับ */