<?php
include '../include/include.php';

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
  CURLOPT_POSTFIELDS =>'{
	"USERNAME":"BankruptDt",
    "PASSWORD":"Debtor4321",
    "pccDossControlGen":"7243"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$dataReturn = json_decode($response,true);

db::db_delete("WH_CIVIL_ROUTE",array('WH_CIVIL_ID'=>5927995));

if(count($dataReturn["Data"])>0){
	foreach($dataReturn["Data"] as $key => $val){
		unset($fields);
			$fields["ROUTE_GEN"] 		= 	$val["routeGen"];
			$fields["CREATE_DATE"] 		= 	$val["trDate"];
			$fields["ACT_DESC"] 		= 	$val["actDesc"];
			$fields["WH_CIVIL_ID"] 		= 	'5927995';
		db::db_insert("WH_CIVIL_ROUTE",$fields,'WH_ROUTE_ID','WH_ROUTE_ID');
	}
}

?>