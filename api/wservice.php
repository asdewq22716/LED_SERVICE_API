<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL & ~ E_WARNING & ~ E_NOTICE & ~ E_DEPRECATED);
include('nusoap/src/nusoap.php');

// Create the server instance
$server =new soap_server();
// Initialize WSDL support
$server->configureWSDL('hellowsdl', 'urn:hellowsdl');
// Register the method to expose
$server->register('hello',    // method name
 array('name' => 'xsd:string'),  // input parameters
 array('return' => 'xsd:string'), // output parameters
 'urn:hellowsdl',     // namespace
 'urn:hellowsdl#hello',    // soapaction
 'rpc',        // style
 'encoded',       // use
 'Says hello to the caller'   // documentation
);
// Define the method as a PHP function
function hello($name) {
        return 'Hello, ' . $name;
}
// Use the request to (try to) invoke the service
//$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';

// $POST_DATA = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
 
// $server->service($POST_DATA);
// exit();;

@$server->service(file_get_contents("php://input"));
?>