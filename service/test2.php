<?php 
	$form_field['docId'] = '380381';
	$data_string = json_encode($form_field);
	$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://103.40.146.73/ledservice.php/bankruptFile',
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
	$data = json_decode($response, true);
	
	print_r($data);
	curl_close($response);
?>