<?php
session_start(); 
include '../include/include.php';

if ($_POST['COURT_CODE']) {
	$COURT_CODE = $_POST['COURT_CODE'];
}
$REGISTER_CODE = $_POST['REGISTER_CODE'];
$CONCERN_NAME = $_POST['CONCERN_NAME'];
if(count($REGISTER_CODE) > 0){
	foreach($REGISTER_CODE as $keys => $values){
		$form_field['registerCode'] = $values;
		$res = api_led_service('GetPersonCaseList.php', $form_field);

		if ($res['ResponseCode']['ResCode'] == '000') {
			$res_data = $res['Data'];
			foreach ($res_data as $key => $value1) {

				if (count($value1) > 0) {
					foreach ($value1 as $value) {

						$data["cmdDocDate"]   =   date('Y-m-d');
						$data["cmdDocTime"]   =   date('H:i:s');


						$sqlCourt   = "SELECT COURT_CODE,COURT_NAME FROM M_COURT WHERE COURT_CODE = '".$COURT_CODE."' ";
						$queryCourt  = db::query($sqlCourt);
						$dataCourt   = db::fetch_array($queryCourt);

						$data["courtCode"]    =   $dataCourt["COURT_CODE"];
						$data["courtName"]    =   $dataCourt["COURT_NAME"];

						$data["fBlackCase"]   =   $_POST["PREFIX_BLACK_CASE"].$_POST["BLACK_CASE"]."/".$_POST["BLACK_YY"];
						$data["tBlackCase"]   =   $_POST["PREFIX_BLACK_CASE"];
						$data["blackCase"]    =   $_POST["BLACK_CASE"];
						$data["blackYy"]    =   $_POST["BLACK_YY"];

						$data["fRedCase"]    =   $_POST["PREFIX_RED_CASE"].$_POST["RED_CASE"]."/".$_POST["RED_YY"];
						$data["tRedCase"]    =   $_POST["PREFIX_RED_CASE"];
						$data["redCase"]    =   $_POST["RED_CASE"];
						$data["redYy"]     =   $_POST["RED_YY"];

						if($key=='Civil'){
							$sendTo = 1;
						}else if($key=='Bankrupt'){
							$sendTo = 2;
						}else if($key=='Revive'){
							$sendTo = 3;
						}else if($key=='Mediate'){
							$sendTo = 4;
						}

    					$data["sendTo"]    =   $sendTo; //ระบบที่ส่งคำสั่งไปหา

    					$data["cmdType"]    =   '11'; //M_CMD_TYPE
    					$data["caseType"]    =   '41101'; //M_SERVICE_CMD

    					$data["officeIdcard"]   =   $_SESSION["USR_OPTION1"];
    					$data["officeName"]   =   $_SESSION["WF_USER_NAME"];

    					$data["deptCode"]    =   '0902020100000';
    					$data["deptName"]    =   'สำนักงานบังคับคดีจังหวัดฉะเชิงเทรา';

    					$data["plaintiff"]    =   $_POST["PLAINTIFF_PRE_NAME"].$_POST["PLAINTIFF_FNAME"]." ".$_POST["PLAINTIFF_LNAME"];
    					$data["defendant"]    =   $_POST["DEFENDANT_PRE_NAME"].$_POST["DEFENDANT_FNAME"]." ".$_POST["DEFENDANT_LNAME"];

    					$data["sysName"]    =   4;//M_CMD_SYSTEM

    					$data["toTBlackCase"]   =   $value['prefixBlackCase'];
    					$data["toBlackCase"]  =   $value['blackCase'];
    					$data["toBlackYy"]    =   $value['blackYy'];
    					$data["toTRedCase"]   =   $value['prefixRedCase'];
    					$data["toRedCase"]    =   $value['redCase'];
    					$data["toRedYy"]    =   $value['redYy'];

    					$data["toCourtCode"]   =   $value['CourtCode'];
    					$data["toCourtName"]   =   $value['courtName'];
    					$data["approveStatus"]   =   1;

    					if($sendTo==1){
    						$data["toPersonId"]   =   '3920300038603';
    					}else{
    						$data["toPersonId"]   =   '1103411005612';
    					}


	    				//รายละเอีบด
    					$data["detail"]  = "ตรวจพบ ".$value["prefixName"].$value["firstName"]." ".$value["lastName"]." สถานะ ".$value['concernName']." ในคดี  หมายเลขดำที่ ".$value['prefixBlackCase'].$value["blackCase"]."/".$value["blackYy"]." คดีหมายเลขแดงที่ ".$value['prefixRedCase'].$value['redCase']."/".$value['redYy'];
    					$data["detail"] .= " เป็น".$CONCERN_NAME[$keys]."ใน".$SYSTEM_NAME;
    					$data["detail"] .= " ในคดี  หมายเลขดำที่ ".$_POST["PREFIX_BLACK_CASE"].$_POST["BLACK_CASE"]."/".$_POST["BLACK_YY"]." คดีหมายเลขแดงที่ ".$_POST["PREFIX_RED_CASE"].$_POST["RED_CASE"]."/".$_POST["RED_YY"];




	   					//คน
    					$data["person"][0] = array(
    						"idCard"    => $values,
    						"prefixName"   => $value["prefixName"],
    						"firstName"   => $value["firstName"],
    						"lastName"    => $value["lastName"],
    						"fullName"    => $value['fullName'],
    						"address"    => $value["address"]
    					);

    					$dataJson = json_encode($data);
    					// if($value['concernName']=='ลูกหนี้' || $value['concernName']=='จำเลย/ลูกหนี้' || $value['concernName']=='โจทก์' || $value['concernName']=='เจ้าหนี้' || $value['concernName']=='โจทก์/เจ้าหนี้' || $value['concernName']=='จำเลย'){

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
    						)
    					));
    					$response = curl_exec($curl);
    					// echo json_encode($response);
    					curl_close($curl);
    					// }
    				}
    			}
    		}
    	}
    }
}
?>