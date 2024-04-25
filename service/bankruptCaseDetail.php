<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include '../include/include.php';

$str_json = file_get_contents("php://input");
$res = json_decode($str_json, true);

  $obj['userName'] = 'BankruptDt';
  $obj['passWord'] = 'Debtor4321';
 
  $data_string = json_encode($obj);
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://103.40.146.180/api/public/CheckCase',
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
$resp_data = $resp['data']['Data'];

foreach ($resp_data as $key => $value) {
	
	$sql = "SELECT BANKRUPT_CODE FROM WH_BANKRUPT_CASE_DETAIL WHERE BANKRUPT_CODE = '".$value['bankruptCode']."'";
	$query = db::query($sql);
	$num = db::num_rows($query);
	
	
	if($num > 0 ){
		unset($field);
		unset($cond);
	    $date = explode(' ',$value['courtDate']);
	    $cond['BANKRUPT_CODE'] = $value['bankruptCode'];
	    $field['COURT_CODE'] = $value['courtCode'];
	    $field['COURT_NAME'] = $value['courtName'];
	    $field['DEPT_CODE'] = $value['deptCode'];
	    $field['DEPT_NAME'] = $value['deptName'];
	    $field['COURT_DATE'] = $date[0];
	    $field['PREFIX_BLACK_CASE'] = $value['prefixBlackCase'];
	    $field['BLACK_CASE'] = $value['blackCase'];
	    $field['BLACK_YY'] = $value['blackYY'];
	    $field['PREFIX_RED_CASE'] = $value['prefixRedCase'];
	    $field['RED_CASE'] = $value['redCase'];
	    $field['RED_YY'] = $value['redYY'];
	    $field['CAPITAL_AMOUNT'] = $value['capitalAmount'];
		
		if(count($value['plaintiff']) > 0){ 
			foreach($value['plaintiff'] as $k => $v){
				$n = $k + 1;
				if($n < 4){
					$field['PLAINTIFF'.$n] = $v;
				}
			}
		}
		
		if(count($value['deffendant']) > 0){ 
			foreach($value['deffendant'] as $k => $v){
				$n = $k + 1;
				if($n < 4){
					$field['DEFFENDANT'.$n] = $v;
				}
			}
		}
		db::db_update('WH_BANKRUPT_CASE_DETAIL',$field,$cond);
		
	}else{
	   unset($field);
	    $date = explode(' ',$value['courtDate']);
	    $field['BANKRUPT_CODE'] = $value['bankruptCode'];
	    $field['COURT_CODE'] = $value['courtCode'];
	    $field['COURT_NAME'] = $value['courtName'];
	    $field['DEPT_CODE'] = $value['deptCode'];
	    $field['DEPT_NAME'] = $value['deptName'];
	    $field['COURT_DATE'] = $date[0];
	    $field['PREFIX_BLACK_CASE'] = $value['prefixBlackCase'];
	    $field['BLACK_CASE'] = $value['blackCase'];
	    $field['BLACK_YY'] = $value['blackYY'];
	    $field['PREFIX_RED_CASE'] = $value['prefixRedCase'];
	    $field['RED_CASE'] = $value['redCase'];
	    $field['RED_YY'] = $value['redYY'];
	    $field['CAPITAL_AMOUNT'] = $value['capitalAmount'];
		
		if(count($value['plaintiff']) > 0){ 
			foreach($value['plaintiff'] as $k => $v){
				$n = $k + 1;
				if($n < 4){
					$field['PLAINTIFF'.$n] = $v;
				}
			}
		}
		
		if(count($value['deffendant']) > 0){ 
			foreach($value['deffendant'] as $k => $v){
				$n = $k + 1;
				if($n < 4){
					$field['DEFFENDANT'.$n] = $v;
				}
			}
		}
		  
		db::db_insert('WH_BANKRUPT_CASE_DETAIL',$field);
	}
  
	$return = "success";
}
if($return == ''){
	$return = "fail";
}
echo $return;
?>
