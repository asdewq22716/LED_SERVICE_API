<?php
	include '../include/config.php';
	function send_curl($request){
		if (!function_exists('curl_init'))  
		{ 
			echo "curl_init"; 
			exit;
		} 
		
		$url = array_shift(explode('?',$request['url']['raw']));
		
		
		$url .= '?'. implode('&',array_map(function($item) {
				return "{$item['key']}={$_POST[$item['value']]}";
			},
			$request['url']['query']
		));

		
		//print_r($request);
		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_URL, $url);    
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $request['method']);
		if($request['method'] == 'POST'){
			curl_setopt($ch, CURLOPT_POST, 1);
		}
		/*
		if($json == true){
			curl_setopt($ch, CURLOPT_POSTFIELDS, $request_body);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json','Authorization: Bearer '.$token,'Content-Length: ' . strlen($request_body)));
		}else{
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($request_body));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		}*/
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSLVERSION, 6);
		
		if($ssl == false){
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		}
		// curl_setopt($ch, CURLOPT_HEADER, 0);     
		$r = curl_exec($ch);    
		if (curl_error($ch)) {
			$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			$err = curl_error($ch);
			print_r('Error: ' . $err . ' Status: ' . $statusCode);
			// Add error
			$this->error = $err;
		}
		curl_close($ch);
		return $r;
	}
	
	$sql = "select * from m_api_client_setting where api_code='".$_GET['api_code']."'";
	$result = db::query($sql);
	$rec = db::fetch_array($result);
	$arr_config = json_decode(html_entity_decode($rec['JSON_CONFIG']),true);
	$data = send_curl($arr_config['request']);

	
	echo $data;