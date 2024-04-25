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


$namespace = '<#NAMESPACE#>';

$server = new soap_server();
$server->configureWSDL("LED_SERVICE", 'urn:LED_SERVICE');
$server->wsdl->schemaTargetNamespace = $namespace;

<#REGISTER#>

<#FUNCTIONS#>

@$server->service(file_get_contents("php://input"));
exit();
?>