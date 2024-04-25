<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL & ~ E_WARNING & ~ E_NOTICE & ~ E_DEPRECATED);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

// define('PATH_ROOT', '../');
// include(PATH_ROOT.'configs/config.php');
include '../include/include.php';
//include('mots_sport.php');
include('led_service.php');

function is_json($string) {
  json_decode($string);
  return (json_last_error() == JSON_ERROR_NONE);
  // return ((is_string($string) &&
  // (is_object(json_decode($string)) ||
  // is_array(json_decode($string))))) ? true : false;
}

function parse_raw_http_request(array &$a_data)
{
  // read incoming data
  $input = file_get_contents('php://input');
  // grab multipart boundary from content type header
  preg_match('/boundary=(.*)$/', $_SERVER['CONTENT_TYPE'], $matches);
  $boundary = $matches[1];
  // split content by boundary and get rid of last -- element
  $a_blocks = preg_split("/-+$boundary/", $input);
  array_pop($a_blocks);
  // loop data blocks
  foreach ($a_blocks as $id => $block)
  {
    if (empty($block))
      continue;
    // you'll have to var_dump $block to understand this and maybe replace \n or \r with a visibile char
    // parse uploaded files
    if (strpos($block, 'application/octet-stream') !== FALSE)
    {
      // match "name", then everything after "stream" (optional) except for prepending newlines 
      preg_match("/name=\"([^\"]*)\".*stream[\n|\r]+([^\n\r].*)?$/s", $block, $matches);
    }
    // parse all other fields
    else
    {
      // match "name" and optional value in between newline sequences
      preg_match('/name=\"([^\"]*)\"[\n|\r]+([^\n\r].*)?\r$/s', $block, $matches);
    }
    $a_data[$matches[1]] = $matches[2];
  }
}

//use basic authen
//if($_SERVER['PHP_AUTH_USER']=='test' && $_SERVER['PHP_AUTH_PW']=='test') {
  $mod = strtolower($_SERVER['REQUEST_METHOD']);
  $call = $_GET['MOD'];
  $str = file_get_contents("php://input");
  //for json
  if(is_json($str) && $str) {
    $data_request = json_decode($str, true);
    $type = 'json';
  }
  //for form-data
  else if(preg_match('/form-data;/', $str)) {
    $data_request = array();
    parse_raw_http_request($data_request);
    $type = 'form-data';
  }
  //for x-www-form-urlencode -> a=2&b=3
  else if(preg_match("~([^&]+)=([^&]+)~", $str)) {
    parse_str($str, $data_request);
    $type = 'urlencode';
  }
  //for form-data method POST
  else if($_POST) {
    $data_request = $_POST;
    $type = 'POST';
  }

  switch($mod) {
    case 'get' :
      if(!$data_request) {
        $data_request =(is_array($data_request))?array_merge($data_request, $_GET):$_GET;

      }
      $res = web_service::get($call, $data_request);
      if($res) {
        $response = array(
          'status' => 1,
          'data' => $res,
        );
      }
      else {
        $response = array(
          'status' => 0,
          'message' => web_service::getMessage(),
        );
      }
      break;
    case 'post' :
    case 'put' :
    case 'delete' :
      $response = array(
        'status' => 0,
        'message' => 'service comming soon!!!',
      );
      break;
    default : $response = array(
      'status' => 0,
      'message' => 'service error',
    );
  }
  echo json_encode($response, JSON_UNESCAPED_UNICODE);
  exit;
// }
// else {
//   $response = array(
//     'status' => 0,
//     'message' => 'Cannot use service'
//   );
//   echo json_encode($response, JSON_UNESCAPED_UNICODE);
//   exit;
// }


?>