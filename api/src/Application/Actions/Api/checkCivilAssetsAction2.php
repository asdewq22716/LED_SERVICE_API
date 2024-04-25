<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
declare(strict_types=1);

namespace App\Application\Actions\Api;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class checkCivilAssets2Action extends Action

{ 

 
    protected function action(): Response 
    {        
 
		include('lib/connect_db.php');
		include('lib/config_db.php');
		include('lib/function_custom.php');

		
        
		$obj = array();
		$row = array();
        $token = '';

		$request = $this->getFormData();
		// request
		// if($request->ip){
		// 	$ip = $request->ip;
		// }
		// if($request['ip']){
		// 	$ip = $request['ip'];
		// }else{
		// 	$ip = get_client_ip();
		// }
		$sql = \db::query("SELECT MAX(LOG_ID) AS LOG FROM M_LOG");
		$maxid = \db::fetch_array($sql);
		$id = $maxid['LOG'] + 1;
		$date = date('Y-m-d');

		// print_r($id);
		
		// $query = \db::query("INSERT INTO M_LOG (LOG_ID,IP_ADDRESS,EVENT_CODE,TOKEN_ID,DEP_ID,REQUEST,LOG_DATE,USR_ID,REQUEST_STATUS,USR_IDCARD,LOG_TYPE)
		// VALUES ($id,'','','','','checkCivilAssetsAction','".$date ."','','200','','1')");
		

		foreach($request as $key => $value){
					
			$sql1 = \db::query("SELECT MAX(REQUEST_LOG_ID) AS LOG FROM M_LOG_REQUEST");
			$maxid1 = \db::fetch_array($sql1);
			$requestid = $maxid1['LOG'] + 1;

			// $query1 = \db::query("INSERT INTO M_LOG_REQUEST (REQUEST_LOG_ID,LOG_ID,REQUEST_NAME,REQUEST_DATA)
			// VALUES ($requestid,$id,'".$key."','".$value."')");
		
		

		}

		$url = "http://103.208.27.224:81/led_service_api/api/public/";
		
		
		if(isset($_SERVER['HTTP_TOKENAPI'])){
			$token = $_SERVER['HTTP_TOKENAPI'];
		}

	
    if(!empty($request->assetType)){
		
		if($request->assetType =='0001'){
			$url .= 'civilCaseAssetsLand';
		}
		if($request->assetType =='0002'){
			$url .= 'civilCaseAssetsBuilding';
		}
		if($request->assetType =='0003'){
			$url .= 'civilCaseAssetsCondo';
		}
		if($request->assetType =='0004'){
			$url .= 'civilCaseAssetsMachinery';
		}
		if($request->assetType =='0005'){
			$url .= 'civilCaseAssetsBond';
		} 
		if($request->assetType =='0006'){
			$url .= 'civilCaseAssetsLottery'; 
		}
		if($request->assetType =='0007'){
			$url .= 'civilCaseAssetsFirearm';
		}
		if($request->assetType =='0008'){
			$url .= 'civilCaseAssetsOther';
		}
		if($request->assetType =='0009'){
			$url .= 'civilCaseAssetsRent';
		}
		if($request->assetType =='0010'){
			if($request->vehicleType =='01'){
				$url .= 'civilCaseAssetsCar';
			}
			if($request->vehicleType =='02'){
				$url .= 'civilCaseAssetsBoat';
			}
		}
		if($request->assetType =='0011'){
			$url .= 'civilCaseAssetsStock';
		}
		if($request->assetType =='0012'){
			// $url = connect_bankrupt('CheckAssetBookBank');
		}
		if($request->assetType =='display'){
			// $url = connect_bankrupt('CheckAsset');
		}
		
		
	}
if($url != "http://103.208.27.224:81/led_service_api/api/public/"){        
	$data_string = json_encode($request);
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
      CURLOPT_POSTFIELDS =>$data_string,
      CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json',
	  'TOKENAPI: '.$token
      ),
    )
  );
  $response = curl_exec($curl);
  $resp = json_decode($response, true);
  
  $i = 0;
	if($resp['data']['ResponseCode']['ResCode'] == '000'){

		$data2 = $resp['data']['Data'];

		
		foreach($data2 as $k => $v){

			$obj[$k] = $v;
	
	
			$sql2 = \db::query("SELECT MAX(RESPONSE_LOG_ID) AS LOG FROM M_LOG_RESPONSE");
			$maxid2 = \db::fetch_array($sql2);
			$responid = $maxid2['LOG'] + 1;

			$query2 = \db::query("INSERT INTO M_LOG_RESPONSE (RESPONSE_LOG_ID,LOG_ID,RESPONSE_NAME,RESPONSE_DATA) VALUES ($responid,$id,'".$k."','".$v."')");

			
			foreach($val['holdingPerson'] as $ke2 => $val2 ){
				

				$sql3 = \db::query("SELECT MAX(RESPONSE_LOG_ID) AS LOG FROM M_LOG_RESPONSE");
				$maxid3 = \db::fetch_array($sql3);
				$responid = $maxid3['LOG'] + 1;
	
				$query3 = \db::query("INSERT INTO M_LOG_RESPONSE (RESPONSE_LOG_ID,LOG_ID,RESPONSE_NAME,RESPONSE_DATA) VALUES ($responid,$id,'".$ke2."','".$val2."')");	
				}
		
		}
	}
}
		
	

$num = count($obj);

	if($num > 0){

		$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");
		$row['Data'] = $obj;

	}else{

		$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");

	}
	



        return $this->respondWithData($row);
    }
	
	
	
}



?>