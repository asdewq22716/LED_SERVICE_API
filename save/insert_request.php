<?php 
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';


$sql_serv = "SELECT * FROM M_SERVICE_MANAGE   ";
$query_serv = db::query($sql_serv);
while($serv = db::fetch_array($query_serv)){

// $api_name = 'DebtRehabilitationCaseDebtor';
$api_name = $serv['SERVICE_NAME'];

$curl = curl_init();

curl_setopt_array(
    $curl
    , array(
        CURLOPT_URL => "http://103.208.27.224:81/led_service_api/api/?MOD=manual&manualApiName=".$api_name,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    )
);

$response = curl_exec($curl);
echo $err = curl_error($curl);

curl_close($curl);

$json_data = json_decode($response,true);


	if($json_data['status'] == 1){
		$i = 0;
		// foreach($json_data['data']['request'] as $key => $val){
		// 	$field = array();
		// 	// $field['REQUEST_ID'] = $val['FIELD'];
		// 	$field['REQUEST_NAME'] = $val['FIELD'];
		// 	$field['REQUEST_TYPE'] = $val['TYPE'];
		// 	$field['REQUEST_DESC'] = $val['DESC'];
		// 	$field['REQUEST_EX'] = $val['EX'];
		// 	$field['SERVICE_MANAGE_ID'] = $serv['SERVICE_MANAGE_ID'];
		// 	// print_pre($field);
		// 	db::db_insert('M_SERVICE_REQUEST', $field, 'REQUEST_ID', 'REQUEST_ID');
		// 	// echo $serv['SERVICE_NAME']." Insert REQUEST Success !!! \n";
		// }
		
		foreach($json_data['data']['response'] as $key => $val){
			$field = array();
			// $field['REQUEST_ID'] = $val['FIELD'];
			$field['RESPONSE_NAME'] = $val['FIELD'];
			$field['RESPONSE_TYPE'] = $val['TYPE'];
			$field['RESPONSE_DESC'] = $val['DESC'];
			$field['RESPONSE_EX'] = $val['EX'];
			$field['SERVICE_MANAGE_ID'] = $serv['SERVICE_MANAGE_ID'];
			 print_pre($field);
			db::db_insert('M_SERVICE_RESPONSE', $field, 'RESPONSE_ID', 'RESPONSE_ID');
			// echo $serv['SERVICE_NAME']." Insert RESPONSE Success !!! \n";
		} 
	}
}