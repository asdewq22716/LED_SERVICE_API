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
include './check_case_Function.php';

$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);




$PAGE_CODE = $POST['pageCode'];
$WFR_API = strval($POST['WFR'] . "W" . $PAGE_CODE);
$SYSTEM_TYPE = $POST["systemCode"];
$toPersonId = $POST["toPersonId"];
$idCard = $POST["idCard"];

$url_api="http://103.208.27.224:81";

$sql_check_case = "SELECT *FROM M_CHECK_CASE_MEDIATE a WHERE a.PAGE_CODE='" . $PAGE_CODE . "'";
$queryWH_page = db::query($sql_check_case);
$rec_page = db::fetch_array($queryWH_page);
if ($rec_page['INFORMATION_API'] == 'OPEN') {
    getMedToWh($WFR_API, "");
}
if ($rec_page['STATUS_BUTTON'] == 'N') { //N คือปิดการใช้
    exit;
}

if ($PAGE_CODE == '167') {
    $REGISTERCODE = $idCard;
}

if (!empty($WFR_API)) {
    $sqlSelectData = "	SELECT *FROM WH_MEDIATE_CASE a 
WHERE a.REF_WFR_ID = '" . $WFR_API . "'";
    $querySelectData = db::query($sqlSelectData);
    $dataSelectData = db::fetch_array($querySelectData); //เอาข้อมูลไว้หาคดีดำเเดง
    $num1 = db::num_rows($querySelectData);
}
function check_bank_Mediate($input_array, $PAGE_CODE) //เอาธนาคารออกหรือไม่
{
    $data_Arr = "";
    $sql_check_bank = "SELECT a.DATA_BANK FROM M_CHECK_CASE_MEDIATE a WHERE a.PAGE_CODE='" . $PAGE_CODE . "' ";
    $querycheck_bank = db::query($sql_check_bank);
    $data_check = db::fetch_array($querycheck_bank);
    if ($data_check['DATA_BANK'] == 'YES') {
        return $input_array;
    } else {
        $arr = [];
        $arr = explode(",", trim($input_array, ","));
        $num_arr = count($arr);
        $ii = 1;
        foreach ($arr as $sh1) {
            $sql_num_bank =  "SELECT COUNT(a.ID_CARD_BANK)AS TOTAL_BANK FROM M_DATA_BANK a WHERE a.ID_CARD_BANK ='" . $sh1 . "'";
            $queryNum_bank = db::query($sql_num_bank);
            $dataNum_bank  = db::fetch_array($queryNum_bank);
            if ($dataNum_bank['TOTAL_BANK'] == '0') {
                $ii++;
                $data_Arr .=  $sh1 . ",";
            } else {
                $ii--;
            }
        }
        return cut_last_comma($data_Arr);
    }
}
function REGISTER_CODE_13_MEDIATE($WFR_API, $CONCERN_NAME)
{ //ส่งรหัสคดีPCC_CIVIL_GEN,ส่ง$CONCERN_NAME ='เจ้าหนี้,ลูกหนี้,จำเลย' =>ถ้า CONCERN_NAME ไม่ใส่คือเอาทุกสถานะ,
    $FILL = "";
    if ($CONCERN_NAME != '') {
        $FILL = "  AND b.CONCERN_NAME IN (" . result_array($CONCERN_NAME) . ")"; //การเลือกถ้านะที่เลือกเท่านั้น
    }
    $sql_WH_PERSON = "SELECT *FROM WH_MEDIATE_CASE a 
            LEFT JOIN WH_MEDIATE_PERSON b  ON a.WH_MEDAITE_ID =b.WH_MEDIATE_ID 
            WHERE a.REF_WFR_ID  = '" . $WFR_API . "' {$FILL}";
    $REGISTERCODE = '';
    $queryWH_PERSON = db::query($sql_WH_PERSON);
    while ($rec_WH = db::fetch_array($queryWH_PERSON)) {
        $REGISTERCODE .= $rec_WH["REGISTER_CODE"] . ",";
    }
    return cut_last_comma($REGISTERCODE);
}

if ($num1 > 0) {
    $sql_DATA_SEARCH = "SELECT a.DATA_SEARCH FROM M_CHECK_CASE_MEDIATE a  WHERE a.PAGE_CODE ='" . $PAGE_CODE . "'";
    $queryDATA_SEARCH = db::query($sql_DATA_SEARCH);
    $dataDATA_SEARCH  = db::fetch_array($queryDATA_SEARCH);
    //-------------------------------ค้นหาทั้งหมด------------------------------------
    if ($dataDATA_SEARCH['DATA_SEARCH'] == 'ALL') {
        $REGISTERCODE = checkMain::check_bank_Mediate(checkMain::REGISTER_CODE_13_MEDIATE($WFR_API, "", ""), $PAGE_CODE);
    } else if ($dataDATA_SEARCH['DATA_SEARCH'] == 'COUPLE' || $dataDATA_SEARCH['DATA_SEARCH'] == 'CROSS' || $dataDATA_SEARCH['DATA_SEARCH'] == 'CROSS_AND_ALL') {
        $REGISTERCODE_C1 = checkMain::check_bank_Mediate(checkMain::REGISTER_CODE_13_MEDIATE($WFR_API, "โจทก์", ""), $PAGE_CODE);
        $REGISTERCODE_C2 = checkMain::check_bank_Mediate(checkMain::REGISTER_CODE_13_MEDIATE($WFR_API, "จำเลย", ""), $PAGE_CODE);
    }else if ($dataDATA_SEARCH['DATA_SEARCH'] == '1COUPLE2ALL') { //ตรวจโจทก์ เป็นคู๋ เเละตรวจจำเลยเเละอื่นๆเป็นทั้งหมด
        $REGISTERCODE_C1 = checkMain::check_bank_Mediate(checkMain::REGISTER_CODE_13_MEDIATE($WFR_API, "โจทก์", ""), $PAGE_CODE); //เอาโจทก์
        $REGISTERCODE_C2 = checkMain::check_bank_Mediate(checkMain::REGISTER_CODE_13_MEDIATE($WFR_API, "จำเลย", ""), $PAGE_CODE); //เอาจำเลย
        $REGISTERCODE_C3 = checkMain::check_bank_Mediate(checkMain::REGISTER_CODE_13_MEDIATE($WFR_API, "", "โจทก์,จำเลย"), $PAGE_CODE); //เอาทุกสถานะยกเว้น โจทก์ จำเลย
    }
}
/* เก็บ log start */
$array_link = "";
foreach (json_decode($str_json, true) as $sh1 => $ch1) {
    $array_link .= "&" . $sh1 . "=" . $ch1;
}
unset($fields);
$fields["PAGE_CODE"]                 =    $PAGE_CODE;
$fields["COLUMN1"]                 =     $array_link;
$fields["CREATE_DATE"]                 =    date("Y-m-d");
$fields["SYSTEM_TYPE"]                 =   "4";
db::db_insert("TEST_DATA_RES", $fields, 'PK_ID', 'PK_ID');
/* เก็บ log stop */
$token = 1;


if ($token == 1) {
    function like_url($Url, $img)
    {
        global $url_api;
        return " <a href=\"javascript:openDGDialogWithExternalLink('$Url', 800, 800)\"><img src=\"{$url_api}/led_service_api/images/img_Mediate/{$img}\" style=\"width:35px;\"></a>";
    }


    $link = '';
    $obj = array();
    $sql_check_case = "SELECT *FROM  M_CHECK_CASE_MEDIATE a WHERE a.PAGE_CODE='" . $PAGE_CODE . "' ";
    $query_check_case = db::query($sql_check_case);
    while ($rec_check_case = db::fetch_array($query_check_case)) { //start while
        $array_check = explode(",", $rec_check_case['NOTE_PERSON']); //แปลงข้อมูล เป็นarray เพื่อเช็คค่า
        /* ตรวจคน start -----------------------------------------------------------------------------*/
        if ($rec_check_case['URL_CODE_PERSON'] == "$url_api/led_service_api/public/search_data_WH.php") {
            if ($rec_check_case['DATA_SEARCH'] == 'ALL') {
                if (in_array("REGISTERCODE", $array_check)) {
                    if ($REGISTERCODE != '') { //รหัสบัตรประชาชน
                        $link_to_api .= "&REGISTERCODE=" .  $REGISTERCODE;
                    }
                }
            } else {
                if (in_array("REGISTERCODE", $array_check)) {
                    if ($REGISTERCODE_C1 != '') {
                        $link_to_api .= "&REGISTERCODE_C1=" . $REGISTERCODE_C1;
                    }
                    if ($REGISTERCODE_C2 != '') {
                        $link_to_api .= "&REGISTERCODE_C2=" . $REGISTERCODE_C2;
                    }
                    if ($REGISTERCODE_C3 != '') {
                        $link_to_api .= "&REGISTERCODE_C3=" . $REGISTERCODE_C3;
                    }
                }
            }

            if (in_array("BLACK_CASE", $array_check)) {
                $link_to_api .= "&T_BLACK_CASE=" . $dataSelectData['PREFIX_BLACK_CASE'] . "&BLACK_CASE=" . $dataSelectData['BLACK_CASE'] . "&BLACK_YY=" . $dataSelectData['BLACK_YY'];
            }
            if (in_array("RED_CASE", $array_check)) {
                $link_to_api .= "&T_RED_CASE=" . $dataSelectData['PREFIX_RED_CASE'] . "&RED_CASE=" . $dataSelectData['RED_CASE'] . "&RED_YY=" . $dataSelectData['RED_YY'];
            }
            if (in_array("COURT_CODE", $array_check)) {
                $link_to_api .= "&COURT_CODE=" . $dataSelectData['COURT_CODE'] . "&COURT_NAME=" . $dataSelectData['COURT_NAME'];
            }
            if ($PAGE_CODE == '167') {
                $link .= "&STATUS=";
                $link .= "&REGISTERCODE=" . $REGISTERCODE;
            } else {
                $link .= "&WFR_API=" . $WFR_API;
            }
            $link .= "&PAGE_CODE=" . $PAGE_CODE;
            $link .= "&TO_PERSON_ID=" . $toPersonId . "&SEND_TO=4";
            $link .= "&DATA_SEARCH=" . $rec_check_case['DATA_SEARCH'];
            $Url_Person = $rec_check_case['URL_CODE_PERSON'] . "?" . func::get_E_and_D("check_case_mediate_btn", "E", $link);
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


            if ($rec_check_case['WEB_PERSON'] == "Y") {
                // print_r(addPerson("4", $text, $WFR_API, $toPersonId)); //1=ระบบต้นทาง 2=ค่าGETต้นทาง 

                /*      echo "test" . check::check_person_test($text); */
                addPerson("4", $text, $WFR_API, $toPersonId); //1=ระบบต้นทาง 2=ค่าGETต้นทาง     

                $obj[] = [
                    "Name" => "Person",
                    'Html' => like_url($Url_Person, $img_person),
                    'Status' => 'red',
                ];
            }
        }
        /* ตรวจคน stop */

        /* หน้าตรวจทรัพย์จากWFR_API start */
        $data_Assets = "";
        $data_Assets .= "&WFR_API=" . $WFR_API;
        $data_Assets .= "&TO_PERSON_ID=" . $toPersonId . "&SEND_TO=4";
        $Url_AssetsForCase = "$url_api/led_service_api/public/search_data_assetsFormCase.php?" .func::get_E_and_D("check_case_mediate_btn", "E", $data_Assets);
        $img_AssetsForCase = "AssetsForCase_red.png";
        if ($rec_check_case['WEB_ASSETS_FOR_CASE'] == "Y") {

            $obj[] = [
                'Name' => 'AssetsForCase',
                'Html' => like_url($Url_AssetsForCase, $img_AssetsForCase),
                'Status' => 'red',
            ];
        }
        /* หน้าตรวจทรัพย์จากwfr stop */



        /* หน้าค้นหาทรัพย์จากการSEARCH Start */
        $Url_SearchForAssets = "$url_api/led_service_api/public/search_data_assets_type.php?1=1";
        if ($rec_check_case['WEB_SEARCH_FOR_ASSETS'] == "Y") {
            $obj[] = [
                'Name' => 'SearchForAssets',
                'Html' => like_url($Url_SearchForAssets, "SearchForAssets.png"),
                'Status' => "red"
            ];
        }
        /* หน้าค้นหาทรัพย์จากการSEARCH  Stop */
        /* คำสั่ง หน้าเเจ้งเตือนMail --------------------------------------------------------------------------------------*/
       
        $img_order = 'letter.png';
        $link_order .= "&WFR_API=" . $WFR_API;
        $link_order .= "&TO_PERSON_ID=" . $toPersonId . "&SEND_TO=4";
        $url_order = $url_api.'/led_service_api/public/search_data_cmd.php?' .func::get_E_and_D("check_case_mediate_btn", "E", $link_order);
        if ($rec_check_case['WEB_MAIL'] == "Y") {
            $obj[] = [
                "Name" => "Order",
                'Html' => like_url($url_order, $img_order) . '<span id="alert_no_reply1" class="badge badge-danger">' .func_main::getNumOrder($toPersonId,"4") . '</span>',
                'Status' => 'red',
            ];
        }
        /* เเจ้งเตือน หน้าเเจ้งเตือนMail stop*/
        /* Btn notification start */
        if ($rec_check_case['WEB_NOTIFICATION'] == "Y") {
            $link_NOTIFICATION .= "&TO_PERSON_ID=" . $toPersonId . "&SEND_TO=4";
            $Url_NOTIFICATION = "$url_api/led_service_api/public/NontificationAlert.php?" .func::get_E_and_D("check_case_mediate_btn", "E", $link_NOTIFICATION);
            $obj[] = [
                'Name' => 'NOTIFICATION',
                'Html' => like_url($Url_NOTIFICATION, "NOTIFICATION.png") . '<span id="alert_no_reply1" class="badge badge-danger">' . numberOfNotifications("4", $toPersonId) . '</span>',
                'Status' => "Red"
            ];
        }

        if ($rec_check_case['SEARCH_PERSON'] == 'on') {
            $link_SEARCH_PERSON .= "&STATUS=SEARCH";
            $link_SEARCH_PERSON .= "&PAGE_CODE=" . $PAGE_CODE;
            $link_SEARCH_PERSON .= "&TO_PERSON_ID=" . $toPersonId . "&SEND_TO=4";
            $link_SEARCH_PERSON .= "&DATA_SEARCH=ALL";
            $Url_SEARCH_PERSON = $rec_check_case['URL_CODE_PERSON'] . "?" . func::get_E_and_D("check_case_mediate_btn", "E", $link_SEARCH_PERSON);
            $img_SEARCH_PERSON = "searchPerson.png";
            $obj[] = [
                "Name" => "searchPerson",
                'Html' => like_url($Url_SEARCH_PERSON, $img_SEARCH_PERSON),
                'Status' => 'red',
            ];
        }
        /* Btn notification stop */
    }


    $num = count($obj);
} // end while
if ($num > 0) {
    $row['ResponseCode'] = array('ResCode' => '000', 'ResMeassage' => "SUCCESS");
    $row['Btns'] = $obj;
} else {
    // $row['ResponseCode'] = array('ResCode' => '102', 'ResMeassage' => "NOT FOUND");
    // $row['status'] = "NO";
    /*  $row['variable'] = ['PCC_CIVIL_GEN','PAGE_CODE','SYSTEM_TYPE']; */
}

echo json_encode($row);
