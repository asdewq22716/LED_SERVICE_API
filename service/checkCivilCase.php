<?php
include '../include/include.php';


$str_json = file_get_contents("php://input");
$res = json_decode($str_json, true);
$i=0;

if($POST['ip']){
	$ip = $POST['ip'];
}else{
	$ip = get_client_ip();
}
$field = array();
$field['IP_ADDRESS'] = $ip ;
$field['DEP_ID'] = $POST['depId'];
$field['REQUEST'] = 'checkCivilCase';
$field['LOG_DATE'] = date("Y-m-d");
$field['USR_ID'] = '' ;
$field['REQUEST_STATUS'] = '200';
$field['USR_IDCARD'] = $POST['idCard'];
$field['LOG_TYPE'] = '1' ;

db::db_insert('M_LOG',$field,'LOG_ID');	

$form_field['USERNAME'] = 'BankruptDt';// เปลี่ยนเป็นค่าที่จะส่ง
$form_field['PASSWORD'] = 'Debtor4321';// เปลี่ยนเป็นค่าที่จะส่ง
$form_field['PREFIX_BLACK_CASE'] = $res['PREFIX_BLACK_CASE'];// เปลี่ยนเป็นค่าที่จะส่ง
$form_field['BLACK_CASE'] = $res['BLACK_CASE'];
$form_field['BLACK_YY'] = $res['BLACK_YY'];
$form_field['PREFIX_RED_CASE'] = $res['PREFIX_RED_CASE'];
$form_field['RED_CASE'] = $res['RED_CASE'];
$form_field['RED_YY'] = $res['RED_YY'];
$form_field['COURT_CODE'] = $res['COURT_CODE'];



$con = curl_init();
curl_setopt($con, CURLOPT_CONNECTTIMEOUT, 120);
curl_setopt($con, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.6 (KHTML, like Gecko) Chrome/16.0.897.0 Safari/535.6");
curl_setopt($con, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
curl_setopt($con, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($con, CURLOPT_HEADER, 0);
curl_setopt($con, CURLOPT_TIMEOUT, 120);

curl_setopt($con, CURLOPT_URL, connect_api_civil('civilCaseDetail'));
curl_setopt($con, CURLOPT_POST, 1);

$data_string = json_encode($form_field);
curl_setopt($con, CURLOPT_POSTFIELDS, $data_string);
$data = curl_exec($con);
$data = json_decode($data, true);

	if($data['ResponseCode']['ResCode'] == '000'){

			$data2 = $data['Data'];
			foreach($data2 as $k => $v){

				$obj[$i]['PccDossControl'] = $v['PCC_DOSS_CONTROL_GEN'];
				$obj[$i]['CivilCode'] = $v['CivilCode'];
				$obj[$i]['PrefixBlackCase'] = $v['PrefixBlackCase'];
				$obj[$i]['BlackCase'] = $v['BlackCase'];
				$obj[$i]['BlackYY'] = $v['BlackYY'];
				$obj[$i]['PrefixRedCase'] = $v['PrefixRedCase'];
				$obj[$i]['RedCase'] = $v['RedCase'];
				$obj[$i]['RedYY'] = $v['RedYY'];
				$obj[$i]['CaseLawsCode'] = $v['CaseLawsCode'];
				$obj[$i]['CaseLawsName'] = $v['CaseLawsName'];
				$obj[$i]['CapitalAmount'] = $v['CapitalAmount'];
				$obj[$i]['Plaintiff1'] = $v['Plaintiff1'];
				$obj[$i]['Plaintiff2'] = $v['Plaintiff2'];
				$obj[$i]['Plaintiff3'] = $v['Plaintiff3'];
				$obj[$i]['Deffendant1'] = $v['Deffendant1'];
				$obj[$i]['Deffendant2'] = $v['Deffendant2'];
				$obj[$i]['Deffendant3'] = $v['Deffendant3'];

				$i++;


			}


}

$num = count($obj);

	if($num > 0){

		$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");
		$row['Data'] = $obj;

	}else{

		$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");

	}

echo json_encode($data);

 ?>
