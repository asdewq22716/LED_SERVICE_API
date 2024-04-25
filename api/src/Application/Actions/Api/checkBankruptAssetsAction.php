<?php
declare(strict_types=1);

namespace App\Application\Actions\Api;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class checkBankruptAssetsAction extends Action
{ 
    /**
     * {isset(inheritdoc}
     */	 
 
    protected function action(): Response 
    {        
 
		include('lib/connect_db.php');
		include('lib/config_db.php');
		include('lib/function_custom.php');
		$obj = array();
		$objTemp = array();
		$row = array();
        

		$request = $this->getFormData();
		//request
		// if($request['ip']){
		// 	$ip = $request['ip'];
		// }
		// if($request['ip']){
			// $ip = $request['ip'];
		// }else{
			// $ip = get_client_ip();
		// }
		$sql = \db::query("SELECT MAX(LOG_ID) AS LOG FROM M_LOG");
            $maxid = \db::fetch_array($sql);
            $id = $maxid['LOG'] + 1;

            $sql2 = \db::query("SELECT MAX(RESPONSE_LOG_ID) AS LOG FROM M_LOG_RESPONSE");
            $maxid2 = \db::fetch_array($sql2);
            $responid = $maxid2['LOG'] + 1;
			
			$sql1 = \db::query("SELECT MAX(REQUEST_LOG_ID) AS LOG FROM M_LOG_REQUEST");
            $maxid1 = \db::fetch_array($sql1);
            $requestid = $maxid1['LOG'] + 1;

            $date = date('Y-m-d');
			$time = date('h:i:s');
			$logdate = $date.' '.$time;

            // print_r($id);
            $query = \db::query("INSERT INTO M_LOG (LOG_ID,IP_ADDRESS,EVENT_CODE,TOKEN_ID,DEP_ID,REQUEST,LOG_DATE,USR_ID,REQUEST_STATUS,USR_IDCARD,LOG_TYPE)
            VALUES ($id,'','','','','checkBankruptAssetsAction',TO_DATE('".$logdate."' , 'YYYY/MM/DD hh24:mi:ss'),'','200','','1')");
            

            foreach ($request as $key => $value)
            {

                $query1 = \db::query("INSERT INTO M_LOG_REQUEST (REQUEST_LOG_ID,LOG_ID,REQUEST_NAME,REQUEST_DATA) VALUES ($requestid,$id,'".$key."','".$value."')");
                $requestid++;
            }


		$filter = "";
		$url = "http://103.208.27.224:81/led_service_api/api/public/";
		
	if(!empty($request->assetType)){
		
		if($request->assetType =='0001'){
			$url .= 'bankruptAssetsLand';
		}
		if($request->assetType =='0002'){
			$url .= 'bankruptAssetsBuilding';
		}
		if($request->assetType =='0003'){
			$url .= 'bankruptAssetsCondo';
		}
		if($request->assetType =='0004'){
			$url .= 'bankruptAssetsMachinery';
		}
		if($request->assetType =='0005'){
			$url .= 'bankruptAssetsBond';
		}
		if($request->assetType =='0006'){
			$url .= 'bankruptAssetsLottery';
		}
		if($request->assetType =='0007'){
			$url .= 'bankruptAssetsFirearm';
		}
		if($request->assetType =='0008'){
			$url .= 'bankruptAssetsOther';
		}
		if($request->assetType =='0009'){
			$url .= 'bankruptAssetsRent';
		}
		if($request->assetType =='0010'){
			$url .= 'bankruptAssetsVechicle';
		}
		if($request->assetType =='0011'){
			$url .= 'bankruptAssetsStock';
		}
		if($request->assetType =='0012'){
			$url .= 'bankruptAssetsBookBank';
		}
		if($request->assetType =='display'){
			$url = connect_bankrupt('CheckAsset');
		}
		
		
	}
	$request->logType = '1';
	$con = curl_init();
	curl_setopt($con, CURLOPT_CONNECTTIMEOUT, 120);
	curl_setopt($con, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.6 (KHTML, like Gecko) Chrome/16.0.897.0 Safari/535.6");
	curl_setopt($con, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($con, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($con, CURLOPT_HEADER, 0);
	curl_setopt($con, CURLOPT_TIMEOUT, 120);

	curl_setopt($con, CURLOPT_URL, $url);
	curl_setopt($con, CURLOPT_POST, 1);

	$data_string = json_encode($request);
	curl_setopt($con, CURLOPT_POSTFIELDS, $data_string);
	$data = curl_exec($con);
	$data = json_decode($data, true);
	$i = '0';
    if ($data['data']['ResponseCode']['ResCode'] == '000')
    {

        $data2 = $data['data']['Data'];

        foreach ($data2 as $k => $v)
        {

           

            foreach ($v as $_k => $_v)
            {
                 $objTemp[$_k] = $_v;
                if($_k != 'holdingPerson'){
                    if($_v != null){
                        
                        $query2 = \db::query("INSERT INTO M_LOG_RESPONSE (RESPONSE_LOG_ID,LOG_ID,RESPONSE_NAME,RESPONSE_DATA) VALUES (" . $responid . "," . $id . ",'" . $_k . "','" . $_v . "')");
                        $responid++;
                        
                    }
                }
            }
            if(isset($v['holdingPerson'])){
				foreach ($v['holdingPerson'] as $k2 => $v2)
				{
					foreach ($v2 as $_k2 => $_v2)
					{
						if($_v2 != null){
							
							$query3 = \db::query("INSERT INTO M_LOG_RESPONSE (RESPONSE_LOG_ID,LOG_ID,RESPONSE_NAME,RESPONSE_DATA) VALUES (" . $responid . "," . $id . ",'" . $_k2 . "','" . $_v2 . "')");
							$responid++;
							
						}
					}
				}
			}
			array_push($obj,$objTemp);
        }
    }
	



$num = count($obj);

	if($num > 0){

		$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");
		$row['Data'] = $obj;

	}else{

		$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");

	}

		//Respon
		// $respon = $data['data']['Data'];
		// foreach($respon as $k => $val){
	
		// 	unset($insert);
		// 	$insert['LOG_ID'] = $log_id;
		// 	$insert['RESPONSE_NAME'] = $k;
		// 	$insert['RESPONSE_DATA'] = $val;
	
		// 	db::db_insert('M_LOG_RESPONSE',$insert,'RESPONSE_LOG_ID');	
	
		// }

        return $this->respondWithData($row); 
    }
	
	
	
}



?>