<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	$data["cmdDocDate"] 		= 		'2022-05-03';
	$data["cmdDocTime"] 		= 		'10:58';
	
	$data["courtCode"] 			= 		'050';
	$data["courtName"] 			= 		'ศาลล้มละลายกลาง';
	
	$data["fBlackCase"] 		= 		'ฟ2527/2565';	
	$data["tBlackCase"] 		= 		'ฟ';
	$data["blackCase"] 			= 		'2527';
	$data["blackYy"] 			= 		'2565';
	
	$data["fRedCase"] 			= 		'ฟ2528/2565';	
	$data["tRedCase"] 			= 		'ฟ';
	$data["redCase"] 			= 		'2528';
	$data["redYy"] 				= 		'2565';
	
	$data["sendTo"] 			= 		4;//ระบบที่ส่งคำสั่งไปหา
	
	$data["cmdType"] 			= 		'1';//M_CMD_TYPE
	$data["caseType"] 			= 		'30103';//M_SERVICE_CMD
	
	$data["officeIdcard"] 		= 		'1212121212121';
	$data["officeName"] 		= 		'นายกิตติกร  ชัยชนะ';
	
	$data["deptCode"] 			= 		'0902020100000';
	$data["deptName"] 			= 		'สำนักงานบังคับคดีจังหวัดฉะเชิงเทรา';
	
	$data["plaintiff"] 			= 		'บริษัท สามเจริญพาณิชย์ จำกัด';
	$data["defendant"] 			= 		'พาสุข ภัทรกิจ จำกัด';
	
	$data["sysName"] 			= 		1;//M_CMD_SYSTEM
	
	$data["toTBlackCase"] 		= 		'ผบ';
	$data["toBlackCase"]		= 		'1240';
	$data["toBlackYy"] 			= 		'2565';
	$data["toTRedCase"] 		= 		'ผบ';
	$data["toRedCase"] 			= 		'1241';
	$data["toRedYy"] 			= 		'2565';
	
	$data["toCourtCode"] 		= 		204;
	$data["toCourtName"] 		= 		'ศาลจังหวัดฉะเชิงเทรา';
	
	$data["toPlaintiff"] 		= 		'บริษัท สามเจริญพาณิชย์ จำกัด';
	$data["toDefendant"] 		= 		'พาสุข ภัทรกิจ จำกัด';
	$data["toPersonId"] 		= 		'1103411005612';
	
	
//รายละเอีบด
	$data["detail"]	=	"ศาลมีคำสั่งอนุญาตให้ถอนคำร้องขอฟื้นฟูกิจการ";



//คน
	$data["person"][0] = array(
								"idCard" 			=> '0125544000998',
								"prefixName" 		=> '',
								"firstName" 		=> 'พาสุข ภัทรกิจ จำกัด',
								"lastName" 			=> '',
								"fullName" 			=> 'พาสุข ภัทรกิจ จำกัด',
								"address" 			=> '123 บางโพงพาง ยานนาวา กทม 10120',
								"phone" 			=> '0212547158',
								"fax" 				=> '021245885',
								"mobile" 			=> '0826541758',
								"email" 			=> 'test@gmail.com',
							  );
//เอกสารแนบ
$file_data 	= file_get_contents('ทดสอบ.pdf');
$file_data  = chunk_split(base64_encode($file_data));

$data["file"][0] = array(
						"fileData" 			=> $file_data,
						"fileType"		 	=> 'pdf',
						"eDocumentName" 	=> 'ทดสอบเอกสารแนบ.pdf'
						);


$dataJson = json_encode($data);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://103.208.27.224:81/led_service_api/service/insertCmd.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$dataJson,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

?>