
<?php
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Cache-Control: no-cache');
    header('Access-Control-Max-Age: 1728000');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Access-Control-Request-Private-Network');
    header('Access-Control-Allow-Private-Network: true');
    die();
}

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include '../include/include.php';
include '../include/func_Nop.php';

$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);



$token = 1;
if ($token == 1) {
    $link = '';
    $obj = array();
    $obj[] ="http://103.208.27.224:81/led_service_api/public/search_data_assets.php?1=1&number_assets=".$POST['number_assets'];

}

$num = count($obj);

if ($num > 0) {

    $row['ResponseCode'] = array('ResCode' => '000', 'ResMeassage' => "SUCCESS");
    $row['link'] = $obj;
} else {

    $row['ResponseCode'] = array('ResCode' => '102', 'ResMeassage' => "NOT FOUND");

}

echo json_encode($row);
