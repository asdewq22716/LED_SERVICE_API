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

function getArray($name,$func = ""){
	global $server;

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
	
	if($func !='' ){
		$i=0;
		$array_request3 = array();
		foreach($array_request2 as $k => $v){
			
			$array_request3[$k] = $func[$i];
		$i++;	
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
		
		return array('req'=>$array_request2,'res'=>array($name => 'tns:'.$name.'Array'),'arrfunc' => $array_request3);
}
$array = getArray('bankruptCourtOrder');
$server->register(
  'bankruptCourtOrder',
  $array['req'],
  $array['res'],
  'urn:LED_SERVICE',
  'urn:LED_SERVICE#bankruptCourtOrder',
  'rpc',
  'encoded',
  ''
);
$array = getArray('bankruptDoc');
$server->register(
  'bankruptDoc',
  $array['req'],
  $array['res'],
  'urn:LED_SERVICE',
  'urn:LED_SERVICE#bankruptDoc',
  'rpc',
  'encoded',
  ''
);
// $array = getArray('civilCase');
// $server->register(
  // 'civilCase',
  // $array['req'],
  // $array['res'],
  // 'urn:LED_SERVICE',
  // 'urn:LED_SERVICE#civilCase',
  // 'rpc',
  // 'encoded',
  // ''
// );
$array = getArray('mediateCaseDetail');
$server->register(
  'mediateCaseDetail',
  $array['req'],
  $array['res'],
  'urn:LED_SERVICE',
  'urn:LED_SERVICE#mediateCaseDetail',
  'rpc',
  'encoded',
  ''
);
$array = getArray('mediateCmdOffice');
$server->register(
  'mediateCmdOffice',
  $array['req'],
  $array['res'],
  'urn:LED_SERVICE',
  'urn:LED_SERVICE#mediateCmdOffice',
  'rpc',
  'encoded',
  ''
);
$array = getArray('mediateCase');
$server->register(
  'mediateCase',
  $array['req'],
  $array['res'],
  'urn:LED_SERVICE',
  'urn:LED_SERVICE#mediateCase',
  'rpc',
  'encoded',
  ''
);
$array = getArray('mediateDoc');
$server->register(
  'mediateDoc',
  $array['req'],
  $array['res'],
  'urn:LED_SERVICE',
  'urn:LED_SERVICE#mediateDoc',
  'rpc',
  'encoded',
  ''
);
$array = getArray('mediatePerson');
$server->register(
  'mediatePerson',
  $array['req'],
  $array['res'],
  'urn:LED_SERVICE',
  'urn:LED_SERVICE#mediatePerson',
  'rpc',
  'encoded',
  ''
);
$array = getArray('debtRehabilitationCaseDetail');
$server->register(
  'debtRehabilitationCaseDetail',
  $array['req'],
  $array['res'],
  'urn:LED_SERVICE',
  'urn:LED_SERVICE#debtRehabilitationCaseDetail',
  'rpc',
  'encoded',
  ''
);
$array = getArray('debtRehabilitationCmdOffice');
$server->register(
  'debtRehabilitationCmdOffice',
  $array['req'],
  $array['res'],
  'urn:LED_SERVICE',
  'urn:LED_SERVICE#debtRehabilitationCmdOffice',
  'rpc',
  'encoded',
  ''
);
$array = getArray('debtRehabilitationCaseDebtor');
$server->register(
  'debtRehabilitationCaseDebtor',
  $array['req'],
  $array['res'],
  'urn:LED_SERVICE',
  'urn:LED_SERVICE#debtRehabilitationCaseDebtor',
  'rpc',
  'encoded',
  ''
);
$array = getArray('debtRehabilitationCaseCreditor');
$server->register(
  'debtRehabilitationCaseCreditor',
  $array['req'],
  $array['res'],
  'urn:LED_SERVICE',
  'urn:LED_SERVICE#debtRehabilitationCaseCreditor',
  'rpc',
  'encoded',
  ''
);
$array = getArray('debtRehabilitationCourtOrder');
$server->register(
  'debtRehabilitationCourtOrder',
  $array['req'],
  $array['res'],
  'urn:LED_SERVICE',
  'urn:LED_SERVICE#debtRehabilitationCourtOrder',
  'rpc',
  'encoded',
  ''
);
$array = getArray('debtRehabilitationDoc');
$server->register(
  'debtRehabilitationDoc',
  $array['req'],
  $array['res'],
  'urn:LED_SERVICE',
  'urn:LED_SERVICE#debtRehabilitationDoc',
  'rpc',
  'encoded',
  ''
);
$array = getArray('civilCaseReceipt');
$server->register(
  'civilCaseReceipt',
  $array['req'],
  $array['res'],
  'urn:LED_SERVICE',
  'urn:LED_SERVICE#civilCaseReceipt',
  'rpc',
  'encoded',
  ''
);
$array = getArray('civilCaseOrder');
$server->register(
  'civilCaseOrder',
  $array['req'],
  $array['res'],
  'urn:LED_SERVICE',
  'urn:LED_SERVICE#civilCaseOrder',
  'rpc',
  'encoded',
  ''
);
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

$array = getArray('civilCaseAssetsLand');
$server->register(
  'civilCaseAssetsLand',
  $array['req'],
  $array['res'],
  'urn:LED_SERVICE',
  'urn:LED_SERVICE#civilCaseAssetsLand',
  'rpc',
  'encoded',
  ''
);
$array = getArray('civilCaseAssetsBuilding');
$server->register(
  'civilCaseAssetsBuilding',
  $array['req'],
  $array['res'],
  'urn:LED_SERVICE',
  'urn:LED_SERVICE#civilCaseAssetsBuilding',
  'rpc',
  'encoded',
  ''
);
$array = getArray('civilCaseAccount');
$server->register(
  'civilCaseAccount',
  $array['req'],
  $array['res'],
  'urn:LED_SERVICE',
  'urn:LED_SERVICE#civilCaseAccount',
  'rpc',
  'encoded',
  ''
);


function bankruptCourtOrder() {
  $array = getArray('bankruptCourtOrder',func_get_args());
  $return = led_service::get('bankruptCourtOrder', $array);
  
 return $return;
}
function bankruptDoc() {
	
  $array = getArray('bankruptDoc',func_get_args());
  $return = led_service::get('bankruptDoc', $array);
  
 return $return;
}
function civilCase() {
  $array = getArray('civilCase',func_get_args());
  $return = led_service::get('civilCase', $array);
  
 return $return;
}
function mediateCaseDetail() {
  $array = getArray('mediateCaseDetail',func_get_args());
  $return = led_service::get('mediateCaseDetail', $array);
  
 return $return;
}
function mediateCmdOffice() {
  $array = getArray('mediateCmdOffice',func_get_args());
  $return = led_service::get('mediateCmdOffice', $array);
  
 return $return;
}
function mediateCase() {
  $array = getArray('mediateCase',func_get_args());
  $return = led_service::get('mediateCase', $array);
  
 return $return;
}
function mediateDoc() {
  $array = getArray('mediateDoc',func_get_args());
  $return = led_service::get('mediateDoc', $array);
  
 return $return;
}
function mediatePerson() {
  $array = getArray('mediatePerson',func_get_args());
  $return = led_service::get('mediatePerson', $array);
  
 return $return;
}
function debtRehabilitationCaseDetail() {
  $array = getArray('debtRehabilitationCaseDetail',func_get_args());
  $return = led_service::get('debtRehabilitationCaseDetail', $array);
  
 return $return;
}
function debtRehabilitationCmdOffice() {
  $array = getArray('debtRehabilitationCmdOffice',func_get_args());
  $return = led_service::get('debtRehabilitationCmdOffice', $array);
  
 return $return;
}
function debtRehabilitationCaseDebtor() {
  $array = getArray('debtRehabilitationCaseDebtor',func_get_args());
  $return = led_service::get('debtRehabilitationCaseDebtor', $array);
  
 return $return;
}
function debtRehabilitationCaseCreditor() {
  $array = getArray('debtRehabilitationCaseCreditor',func_get_args());
  $return = led_service::get('debtRehabilitationCaseCreditor', $array);
  
 return $return;
}
function debtRehabilitationCourtOrder() {
  $array = getArray('debtRehabilitationCourtOrder',func_get_args());
  $return = led_service::get('debtRehabilitationCourtOrder', $array);
  
 return $return;
}
function debtRehabilitationDoc() {
  $array = getArray('debtRehabilitationDoc',func_get_args());
  $return = led_service::get('debtRehabilitationDoc', $array);
  
 return $return;
}
function civilCaseReceipt() {
  $array = getArray('civilCaseReceipt',func_get_args());
  $return = led_service::get('civilCaseReceipt', $array);
  
 return $return;
}
function civilCaseOrder() {
  $array = getArray('civilCaseOrder',func_get_args());
  $return = led_service::get('civilCaseOrder', $array);
  
 return $return;
}
function civilCaseDetail() {
  $array = getArray('civilCaseDetail',func_get_args());
  $return = led_service::get('civilCaseDetail', $array);
  
 return $return;
}
function civilCasePerson() {
  $array = getArray('civilCasePerson',func_get_args());
  $return = led_service::get('civilCasePerson', $array['arrfunc']);
 return $return;
}
function civilCaseAssetsLand() {
  $array = getArray('civilCaseAssetsLand',func_get_args());
  $return = led_service::get('civilCaseAssetsLand', $array);
  
 return $return;
}
function civilCaseAssetsBuilding() {
  $array = getArray('civilCaseAssetsBuilding',func_get_args());
  $return = led_service::get('civilCaseAssetsBuilding', $array);
  
 return $return;
}
function civilCaseAccount() {
  $array = getArray('civilCaseAccount',func_get_args());
  $return = led_service::get('civilCaseAccount', $array);
  
 return $return;
}


@$server->service(file_get_contents("php://input"));
exit();
?>