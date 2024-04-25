<?php
/* error_reporting(E_ALL);
ini_set('display_errors', 1); */
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
$main = new checkMain();
$main->statusWork = ''; //เเสดงเวลาทำงานFunction



$PAGE_CODE = $POST['pageCode'];
$WFR_API = revive::convertWFR($PAGE_CODE, $POST['WFR']);
$main->time_function('revive::convertWFR', $PAGE_CODE, $POST['WFR']);

$SYSTEM_TYPE = $POST["systemCode"];
$toPersonId = !empty(cut_prefix($POST["toPersonName"])) ? cut_prefix($POST["toPersonName"]) : $POST["toPersonId"];

$url_api = "http://103.208.27.224:81";

$sql_check_case = "SELECT *FROM M_CHECK_CASE_REVIVE  a WHERE a.PAGE_CODE='" . $PAGE_CODE . "'";
$queryWH_page = db::query($sql_check_case);
$rec_page = db::fetch_array($queryWH_page);

if ($rec_page['INFORMATION_API'] == 'OPEN') {
    $dataSet["WFR"] = $WFR_API;
    getReviveToWh($dataSet, "");
    $main->time_function('getReviveToWh', $dataSet, '');
}
if ($rec_page['STATUS_BUTTON'] == 'N') { //N คือปิดการใช้
    exit;
}

if ($WFR_API != "") {
    $sqlSelectData = "	select * from WH_REHABILITATION_CASE_DETAIL where REHAB_CODE='" . $WFR_API . "' ";
    $querySelectData = db::query($sqlSelectData);
    $dataSelectData = db::fetch_array($querySelectData); //เอาข้อมูลไว้หาคดีดำเเดง
    $num1 = db::num_rows($querySelectData);
}
function like_url($Url, $img)
{
    global $url_api;
    return " <a href=\"javascript:openDGDialogWithExternalLink('$Url', 800, 800)\"><img src=\"{$url_api}/led_service_api/images/img_Revive/{$img}\" style=\"width:35px;\"></a>";
}
if ($num1 > 0) {
    //-------------------------------ค้นหาทั้งหมด------------------------------------
    if ($rec_page['DATA_SEARCH'] == 'ALL') {
        $REGISTERCODE = checkMain::check_bank_Revive(checkMain::REGISTER_CODE_13_REVIVE($WFR_API, "", ""), $PAGE_CODE);
    } else if ($rec_page['DATA_SEARCH'] == 'COUPLE' || $rec_page['DATA_SEARCH'] == 'CROSS' || $rec_page['DATA_SEARCH'] == 'CROSS_AND_ALL') {
        $REGISTERCODE_C1 = checkMain::check_bank_Revive(checkMain::REGISTER_CODE_13_REVIVE($WFR_API, "โจทก์,เจ้าหนี้", ""), $PAGE_CODE);
        $REGISTERCODE_C2 = checkMain::check_bank_Revive(checkMain::REGISTER_CODE_13_REVIVE($WFR_API, "จำเลย,ลูกหนี้", ""), $PAGE_CODE);
    } else if ($rec_page['DATA_SEARCH'] == '1COUPLE2ALL') { //ตรวจโจทก์ เป็นคู๋ เเละตรวจจำเลยเเละอื่นๆเป็นทั้งหมด

        $REGISTERCODE_C1 = checkMain::check_bank_Revive(checkMain::REGISTER_CODE_13_REVIVE($WFR_API, "โจทก์,เจ้าหนี้", ""), $PAGE_CODE); //เอาโจทก์
        $REGISTERCODE_C2 = checkMain::check_bank_Revive(checkMain::REGISTER_CODE_13_REVIVE($WFR_API, "จำเลย,ลูกหนี้", ""), $PAGE_CODE); //เอาจำเลย
        $REGISTERCODE_C3 = checkMain::check_bank_Revive(checkMain::REGISTER_CODE_13_REVIVE($WFR_API, "", "โจทก์,เจ้าหนี้,จำเลย,ลูกหนี้"), $PAGE_CODE); //เอาทุกสถานะยกเว้น โจทก์ จำเลย

    }
    $main->time_function('checkMain::REGISTER_CODE_13_REVIVE', $WFR_API, "โจทก์", "");
    $main->time_function('checkMain::REGISTER_CODE_13_REVIVE', $WFR_API, "จำเลย", "");
    $main->time_function('checkMain::REGISTER_CODE_13_REVIVE', $WFR_API, "", "โจทก์,จำเลย");
}

revive::Log_TEST_DATA_RES($str_json, $PAGE_CODE,'3');
$main->time_function('revive::Log_TEST_DATA_RES', $str_json, $PAGE_CODE);


if ($num1 > 0) {
    $link = '';
    $obj = array();

    /* ตรวจคน start -----------------------------------------------------------------------------*/
    if ($rec_page['WEB_PERSON'] == "Y") {
        if ($rec_page['DATA_SEARCH'] == 'ALL') {
            $link_to_api .= "&REGISTERCODE=" .  $REGISTERCODE;
        } else if ($rec_page['DATA_SEARCH'] == 'COUPLE' || $rec_page['DATA_SEARCH'] == 'CROSS' || $rec_page['DATA_SEARCH'] == 'CROSS_AND_ALL') {
            $link_to_api .= "&REGISTERCODE_C1=" . $REGISTERCODE_C1;
            $link_to_api .= "&REGISTERCODE_C2=" . $REGISTERCODE_C2;
        } else if ($rec_page['DATA_SEARCH'] == '1COUPLE2ALL') { //ตรวจโจทก์ เป็นคู๋ เเละตรวจจำเลยเเละอื่นๆเป็นทั้งหมด
            $link_to_api .= "&REGISTERCODE_C1=" . $REGISTERCODE_C1;
            $link_to_api .= "&REGISTERCODE_C2=" . $REGISTERCODE_C2;
            $link_to_api .= "&REGISTERCODE_C3=" . $REGISTERCODE_C3;
        }
        $link .= "&WFR_API=" . $WFR_API;
        $link .= "&PAGE_CODE=" . $PAGE_CODE;
        $link .= "&TO_PERSON_ID=" . $toPersonId . "&SEND_TO=3";
        $link .= "&DATA_SEARCH=" . $rec_page['DATA_SEARCH'];
        $Url_Person = "$url_api/led_service_api/public/search_data_WH.php" . "?" . func::get_E_and_D("check_case_revive_btn", "E", $link);
        $text = $link_to_api . $link;
        if ($WFR_API == "") {
            $img_person = "yellow.png";
        } else if (check_person_3($text) > 0) {
            $img_person = "red.png";
        } else if (check_person_3($text) == 0) {
            $img_person = "green.png";
        }
        if ($img_person == "") {
            $img_person = "red.png";
        }
        $main->time_function('check_person_3', $text);
        addPerson("3", $text, $WFR_API, $toPersonId); //1=ระบบต้นทาง 2=ค่าGETต้นทาง  
        $main->time_function('addPerson', "3", $text, $WFR_API, $toPersonId);
        $obj[] = [
            "Name" => "Person",
            'Html' => like_url($Url_Person, $img_person),
            'Status' => 'red',
        ];
    }
    /* ตรวจคน stop */


    /* หน้าตรวจทรัพย์จากWFR_API start */
    if ($rec_page['WEB_ASSETS_FOR_CASE'] == "Y") {
        $data_Assets = "";
        $data_Assets .= "&WFR_API=" . $WFR_API;
        $data_Assets .= "&TO_PERSON_ID=" . $toPersonId . "&SEND_TO=3";
        $Url_AssetsForCase = "$url_api/led_service_api/public/search_data_assetsFormCase.php?" . func::get_E_and_D("check_case_revive_btn", "E", $data_Assets);
        $img_AssetsForCase = "AssetsForCase_red.png";
        $obj[] = [
            'Name' => 'AssetsForCase',
            'Html' => like_url($Url_AssetsForCase, $img_AssetsForCase),
            'Status' => 'red',
        ];
    }
    /* หน้าตรวจทรัพย์จากwfr stop */


    /* หน้าค้นหาทรัพย์จากการSEARCH Start */
    if ($rec_page['WEB_SEARCH_FOR_ASSETS'] == "Y") {
        $Url_SearchForAssets = "$url_api/led_service_api/public/search_data_assets_type.php?1=1";
        $obj[] = [
            'Name' => 'SearchForAssets',
            'Html' => like_url($Url_SearchForAssets, "SearchForAssets.png"),
            'Status' => "red"
        ];
    }
    /* หน้าค้นหาทรัพย์จากการSEARCH  Stop */


    /* คำสั่ง หน้าเเจ้งเตือนMail --------------------------------------------------------------------------------------*/
    if ($rec_page['WEB_MAIL'] == "Y") {
        $img_order = 'letter.png';
        $link_order .= "&WFR_API=" . $WFR_API;
        $link_order .= "&TO_PERSON_ID=" . $toPersonId . "&SEND_TO=3";
        $url_order = $url_api . '/led_service_api/public/search_data_cmd.php?' . func::get_E_and_D("check_case_revive_btn", "E", $link_order);
        $obj[] = [
            "Name" => "Order",
            'Html' => like_url($url_order, $img_order) . '<span id="alert_no_reply1" class="badge badge-danger">' . func_main::getNumOrder($toPersonId, "3") . '</span>',
            'Status' => 'red',
        ];
    }
    /* เเจ้งเตือน หน้าเเจ้งเตือนMail stop*/

    /* Btn notification start */
    if ($rec_page['WEB_NOTIFICATION'] == "Y") {
        // $link_NOTIFICATION .= "&TO_PERSON_ID=" . $toPersonId;
        $link_NOTIFICATION .= "&SEND_TO=3";
        $Url_NOTIFICATION = "$url_api/led_service_api/public/NontificationAlert.php?1=1" . $link_NOTIFICATION;
        $obj[] = [
            'Name' => 'NOTIFICATION',
            'Html' => like_url($Url_NOTIFICATION, "NOTIFICATION.png") . '<span id="alert_no_reply1" class="badge badge-danger">' . numberOfNotifications("3", $toPersonId) . '</span>',
            'Status' => "Red"
        ];
    }
    /* Btn notification stop */
    if ($rec_page['SEARCH_PERSON'] == 'on') {
        $link_SEARCH_PERSON .= "&STATUS=SEARCH";
        $link_SEARCH_PERSON .= "&PAGE_CODE=" . $PAGE_CODE;
        $link_SEARCH_PERSON .= "&TO_PERSON_ID=" . $toPersonId . "&SEND_TO=3";
        $link_SEARCH_PERSON .= "&DATA_SEARCH=ALL";
        $Url_SEARCH_PERSON = $rec_page['URL_CODE_PERSON'] . "?" . func::get_E_and_D("check_case_revive_btn", "E", $link_SEARCH_PERSON);
        $img_SEARCH_PERSON = "searchPerson.png";
        $obj[] = [
            "Name" => "searchPerson",
            'Html' => like_url($Url_SEARCH_PERSON, $img_SEARCH_PERSON),
            'Status' => 'red',
        ];
    }



    $num = count($obj);
} // end while
if (1 == 2) {
    print_pre($main->report_function());
}
if ($num > 0) {
    $row['ResponseCode'] = array('ResCode' => '000', 'ResMeassage' => "SUCCESS");
    $row['Btns'] = $obj;
} else {
    // $row['ResponseCode'] = array('ResCode' => '102', 'ResMeassage' => "NOT FOUND");
    // $row['status'] = "NO";
    /*  $row['variable'] = ['PCC_CIVIL_GEN','PAGE_CODE','SYSTEM_TYPE']; */
}

echo json_encode($row);
