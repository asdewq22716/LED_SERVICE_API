<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */
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
include './check_case_Function.php';

$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);

$PCC_CIVIL_GEN = $POST["pccCivilGen"];
$PAGE_CODE = $POST["pageCode"];
$subPageCode = $PAGE_CODE . (empty($POST['subPageCode']) ? "" : "_" . $POST['subPageCode']);
//echo $subPageCode;
switch ($subPageCode) {
    case "CFC3I020_1":
        $array_idcard = civil::pccCivilGetIdcardForAsset($PCC_CIVIL_GEN);
        $ArrayData = (civil::LockCFC_CAPTION($array_idcard)); //ไปล็อก CFC_CAPTION
        break;
    case "DPD2I010_1":
        $array_idcard = civil::pccCivilGetIdcardForAsset($PCC_CIVIL_GEN);
        ($array_idcard);
        $ArrayData = (civil::LockCFC_CAPTION($array_idcard)); //ไปล็อก CFC_CAPTION
        break;
}
$num = count($ArrayData);
if ($num > 0) {
    $row['ResponseCode'] = array('ResCode' => '000', 'ResMeassage' => "SUCCESS");
    $row['Information'] = $ArrayData;
} else {
}

echo json_encode($row);
