<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL & ~ E_WARNING & ~ E_NOTICE & ~ E_DEPRECATED);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include '../include/include.php';
include('led_service.php');
include('xml.php');
include('nusoap/src/nusoap.php');

function array_to_xml( $arr, &$xml ) {
  foreach($arr as $key => $value) {
    if(is_array($value)) {
        if(!is_numeric($key)){
            $subnode = $xml->addChild("$key");
        } else {
            $subnode = $xml->addChild("data");
            $subnode->addAttribute('key', $key);
        }
        array_to_xml($value, $subnode);
    }
    else {
        if (is_numeric($key)) {
            $xml->addChild("data", $value)->addAttribute('key', $key);
        } else {
            $xml->addChild("$key",$value);
        }
    }
  }
}


$namespace = 'led_service';

$server = new soap_server();
$server->configureWSDL("LED_SERVICE", 'urn:LED_SERVICE');
$server->wsdl->schemaTargetNamespace = $namespace;

function getArray($name){
	global $server;

	// include 'obj_json/'.$name."Json.php";
	
	$array_request = array();
	$curl = curl_init();

	curl_setopt_array(
		$curl
		, array(
			CURLOPT_URL => "http://103.208.27.224:81/led_service_api/api/?MOD=manual&manualApiName=".$name,
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
	curl_close($curl);

	$json_data = json_decode($response,true);
	
	if($json_data['status'] == 1){
	
		$i = 0;
        foreach($json_data['data']['request'] as $key => $val){
			$array_request[$val['FIELD']] = array('name'=>$val['FIELD'],'type'=>'xsd:string');
			$array_request2[$val['FIELD']] = 'xsd:string';
		}
	}
		
	$server->wsdl->addComplexType(
	
			$name,
			'complexType',
			'struct',
			'all',
			'',
			$array_request
	);
	$server->wsdl->addComplexType(
			$name.'Array',
			'complexType',
			'array',
			'',
			'SOAP-ENC:Array',
			array(),
			 array(array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:'.$name.'[]')),
			'tns:'.$name
	);
		
		return array('req'=>$array_request2,'res'=>array($name => 'tns:'.$name.'Array'));
}
$array = getArray('civilCaseDetail');
$server->register(
  'civilCaseDetail',
  $array['req'],
  $array['res'],
  'urn:LED_SERVICE',
  'urn:LED_SERVICE#civilCaseDetail',
  'rpc',
  'encoded',
  ''
);

$array = getArray('civilCasePerson');
$server->register(
  'civilCasePerson',
  $array['req'],
  $array['res'],
  'urn:LED_SERVICE',
  'urn:LED_SERVICE#civilCasePerson',
  'rpc',
  'encoded',
  ''
);

function civilCaseDetail() {
  $req = array(

  );
  $return = led_service::get('civilCaseDetail', $req);
  $xml = new SimpleXMLElement('<response/>');
  array_to_xml($return,$xml);
  return $xml->asXML();
}

function civilCasePerson() {
  $req = array(

  );
  $return = led_service::get('civilCasePerson', $req);
  $xml = new SimpleXMLElement('<response/>');
  array_to_xml($return,$xml);
  return $return;
}


@$server->service(file_get_contents("php://input"));
exit();
?>