<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL & ~ E_WARNING & ~ E_NOTICE & ~ E_DEPRECATED);

include('led_service.php');
include('file.php');
include('template.php');

$a_method  = led_service::getMethod();
//print_r($a_method);
$regis = '';
$function = '';
foreach((array)$a_method as $_item) {
  led_service::callService($_item);
  $a_service = led_service::getService();

  $a_req = array();
  $a_param = array();
  $a_send = array();
  foreach((array)$a_service['request'] as $_key => $_val) {
    $a_req[] = "    '".$_key."'=>'xsd:string'";
    $a_param[] = '$'.$_key;
    $a_send[] = "    '".$_key."'".'=>$'.$_key;
  }

  $regis.= 
    "\$server->register(".PHP_EOL.
    "  '$_item',".PHP_EOL.
    "  array(".PHP_EOL.implode(','.PHP_EOL,$a_req).PHP_EOL.
    "  ),".PHP_EOL.
    "  array('return'=>'xsd:string'),".PHP_EOL.
    "  'urn:LED_SERVICE',".PHP_EOL.
    "  'urn:LED_SERVICE#$_item',".PHP_EOL.
    "  'rpc',".PHP_EOL.
    "  'encoded',".PHP_EOL.
    "  '".$a_service['service_info']."'".PHP_EOL.
    ");".PHP_EOL;
//  print_r($a_service );

  $function.= 
    "function ".$_item."(".implode(", ", $a_param).") {".PHP_EOL.
    "  \$req = array(".PHP_EOL.implode(','.PHP_EOL,$a_send).PHP_EOL.
    "  );".PHP_EOL.
    "  \$return = led_service::get('".$_item."', \$req);".PHP_EOL.
    "  \$xml = new SimpleXMLElement('<response/>');".PHP_EOL.
    "  array_to_xml(\$return,\$xml);".PHP_EOL.
    "  return \$xml->asXML();".PHP_EOL.
    "}".PHP_EOL;
}

$temp = new template();
$temp->load('temp.php');
$temp->setValue("NAMESPACE", "led_service");
$temp->setValue("REGISTER", $regis);
$temp->setValue("FUNCTIONS", $function);

$php = $temp->getTemplate();
file::saveFile("temp_wsdl.php", $php);


?>
<a href="temp_wsdl.php">Service</a>