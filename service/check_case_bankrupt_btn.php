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


/* echo "_REQUEST";
print_r($_REQUEST);


exit; */
$PAGE_CODE = $_REQUEST['pageCode'];
$SYSTEM_TYPE = $_REQUEST["systemCode"];
$brcID = $_REQUEST["brcID"];
$toPersonId = $_REQUEST['toPersonId'];

$url_api = "http://103.208.27.224:81";
/* $PAGE_CODE = $POST['pageCode'];
$SYSTEM_TYPE = $POST["systemCode"];
$brcID = $POST["brcID"];
$toPersonId = $POST['toPersonId']; */

$sql_check_case = "SELECT *FROM M_CHECK_CASE_BANKRUPT a WHERE a.PAGE_CODE='" . $PAGE_CODE . "' ";
$queryWH_page = db::query($sql_check_case);
$rec_page = db::fetch_array($queryWH_page);
if ($rec_page['INFORMATION_API'] == 'OPEN') {
    getBankruptToWh_num($brcID, ""); //เรียก api มาบันทึกข้อมูล
}
if ($rec_page['STATUS_BUTTON'] == 'N') { //N คือปิดการใช้
    exit;
}

$sqlSelectData = "	select 		*
		from 		WH_BANKRUPT_CASE_DETAIL
		where 		BANKRUPT_CODE = '" . $brcID . "' ";
$querySelectData = db::query($sqlSelectData);
$dataSelectData = db::fetch_array($querySelectData);
$num1 = db::num_rows($querySelectData);

if ($num1 > 0) {
    /* ดึงข้อมูลตั้งค่าหน้ามาใช้ว่าจะเเสดงเเบบใหน start */
    $sql_DATA_SEARCH = "SELECT *FROM  M_CHECK_CASE_BANKRUPT a WHERE a.PAGE_CODE='" . $PAGE_CODE . "' ";
    $queryDATA_SEARCH = db::query($sql_DATA_SEARCH);
    $dataDATA_SEARCH  = db::fetch_array($queryDATA_SEARCH);
    /*  stop  */
    if ($dataDATA_SEARCH['DATA_SEARCH'] == 'ALL') {/* start เอาเงื่อนไขเกี่ยวของเป็นมา เเบบ ALL คือการเอาทั้งหมด  */
        $REGISTERCODE = checkMain::check_bank_Bankrupt(checkMain::REGISTER_CODE_13_BANKRUPT($brcID, "", ""), $PAGE_CODE); //เอาโจทย์เเละจำเลย พร้อมตัดธนาคารออก
    } else if ($dataDATA_SEARCH['DATA_SEARCH'] == 'COUPLE' || $dataDATA_SEARCH['DATA_SEARCH'] == 'CROSS' || $dataDATA_SEARCH['DATA_SEARCH'] == 'CROSS_AND_ALL') {
        $REGISTERCODE_C1 = checkMain::check_bank_Bankrupt(checkMain::REGISTER_CODE_13_BANKRUPT($brcID, "โจทก์", ""), $PAGE_CODE); //เอาโจทย์เเละจำเลย พร้อมตัดธนาคารออก
        $REGISTERCODE_C2 = checkMain::check_bank_Bankrupt(checkMain::REGISTER_CODE_13_BANKRUPT($brcID, "จำเลย", ""), $PAGE_CODE); //เอาโจทย์เเละจำเลย พร้อมตัดธนาคารออก
    } else if ($dataDATA_SEARCH['DATA_SEARCH'] == '1COUPLE2ALL') { //ตรวจโจทก์ เป็นคู๋ เเละตรวจจำเลยเเละอื่นๆเป็นทั้งหมด
        $REGISTERCODE_C1 = checkMain::check_bank_Bankrupt(checkMain::REGISTER_CODE_13_BANKRUPT($brcID, "โจทก์", ""), $PAGE_CODE); //เอาโจทก์
        $REGISTERCODE_C2 = checkMain::check_bank_Bankrupt(checkMain::REGISTER_CODE_13_BANKRUPT($brcID, "จำเลย", ""), $PAGE_CODE); //เอาจำเลย
        $REGISTERCODE_C3 = checkMain::check_bank_Bankrupt(checkMain::REGISTER_CODE_13_BANKRUPT($brcID, "", "โจทก์,จำเลย"), $PAGE_CODE); //เอาทุกสถานะยกเว้น โจทก์ จำเลย
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
$fields["SYSTEM_TYPE"]                 =   "2";
db::db_insert("TEST_DATA_RES", $fields, 'PK_ID', 'PK_ID');
/* เก็บ log stop */
$token = 1;


if ($token == 1) {
    function like_url($Url, $img)
    {
        global $url_api;
        return " <a href=\"javascript:openDGDialogWithExternalLink('$Url', 800, 800)\"><img src=\"{$url_api}/led_service_api/images/img_Bankrupt/{$img}\" style=\"width:23px;\"></a>";
    }


    $link = '';
    $obj = array();
    $sql_check_case = "SELECT *FROM  M_CHECK_CASE_BANKRUPT a WHERE a.PAGE_CODE='" . $PAGE_CODE . "' ";
    $query_check_case = db::query($sql_check_case);
    while ($rec_check_case = db::fetch_array($query_check_case)) { //start while
        $array_check = explode(",", $rec_check_case['NOTE_PERSON']); //แปลงข้อมูล เป็นarray เพื่อเช็คค่า
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

        /* ตรวจคน start -----------------------------------------------------------------------------*/
        if ($rec_check_case['URL_CODE_PERSON'] == "$url_api/led_service_api/public/search_data_WH.php") {
            $link .= "&brcID=" . $brcID;
            $link .= "&PAGE_CODE=" . $PAGE_CODE;
            $link .= "&TO_PERSON_ID=" . $toPersonId . "&SEND_TO=2";
            $link .= "&DATA_SEARCH=" . $rec_check_case['DATA_SEARCH'];
            $Url_Person = $rec_check_case['URL_CODE_PERSON'] . "?" . func::get_E_and_D("check_case_bankrupt_btn", "E", $link);


            //check_person_3 ตรวจคนว่ามีติดในคดีอื่นหรือไม่
            $text = $link_to_api . $link;
            if ($brcID == "") {
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
                addPerson("2", $text, $brcID, $toPersonId); //1=ระบบต้นทาง 2=ค่าGETต้นทาง    
                $obj[] = [
                    "Name" => "Person",
                    'Html' => like_url($Url_Person, $img_person),
                    'Status' => 'red',
                ];
            }
        }
        /* ตรวจคน stop */

        /* หน้าตรวจทรัพย์จากBrcId start */
        $data_Assets = "";
        $data_Assets .= "&brcID=" . $brcID;
        $data_Assets .= "&TO_PERSON_ID=" . $toPersonId . "&SEND_TO=2";
        $Url_AssetsForCase = "$url_api/led_service_api/public/search_data_assetsFormCase.php?" . func::get_E_and_D("check_case_bankrupt_btn", "E", $data_Assets);
        $img_AssetsForCase = "AssetsForCase_red.png";
        if ($rec_check_case['WEB_ASSETS_FOR_CASE'] == "Y") {
            $obj[] = [
                'Name' => 'AssetsForCase',
                'Html' => like_url($Url_AssetsForCase, $img_AssetsForCase),
                'Status' => $brcID
            ];
        }
        /* หน้าตรวจทรัพย์จากBrcId stop */


        /* หน้าค้นหาทรัพย์จากการSEARCH Start */
        $Url_SearchForAssets = "$url_api/led_service_api/public/search_data_assets_type.php?1=1";
        if ($rec_check_case['WEB_SEARCH_FOR_ASSETS'] == "Y") {
            $obj[] = [
                'Name' => 'SearchForAssets',
                'Html' => like_url($Url_SearchForAssets, "SearchForAssets.png"),
                'Status' => "Red"
            ];
        }
        /* หน้าค้นหาทรัพย์จากการSEARCH  Stop */



        /* คำสั่ง หน้าเเจ้งเตือนMail --------------------------------------------------------------------------------------*/
        $img_order = 'letter.png';
        $link_order .= "&brcID=" . $brcID;
        $link_order .= "&TO_PERSON_ID=" . $toPersonId . "&SEND_TO=2";
        $url_order = "$url_api/led_service_api/public/search_data_cmd.php?" . func::get_E_and_D("check_case_bankrupt_btn", "E", $link_order);
        if ($rec_check_case['WEB_MAIL'] == "Y") {
            $obj[] = [
                "Name" => "Order",
                'Html' => "<div style=\"display: flex;\">" . like_url($url_order, $img_order) . '<span id="alert_no_reply1" class="badge badge-danger">' . func_main::getNumOrder($toPersonId, "2") . '</span>' . "</div>",
                'Status' => 'red',
            ];
        }
        /* เเจ้งเตือน หน้าเเจ้งเตือนMail stop*/



        /* WEB_NOTIFICATION start  */
        /* Btn notification start */
        if ($rec_check_case['WEB_NOTIFICATION'] == "Y") {
            $link_NOTIFICATION .= "&TO_PERSON_ID=" . $toPersonId . "&SEND_TO=2";
            $Url_NOTIFICATION = "$url_api/led_service_api/public/NontificationAlert.php?" . func::get_E_and_D("check_case_bankrupt_btn", "E", $link_NOTIFICATION);
            $obj[] = [
                'Name' => 'NOTIFICATION',
                'Html' => "<div style=\"display: flex;\">" . like_url($Url_NOTIFICATION, "NOTIFICATION.png") . '<span id="alert_no_reply1" class="badge badge-danger">' . numberOfNotifications("2", $toPersonId) . '</span>' . "</div>",
                'Status' => "Red"
            ];
        }
        /* Btn notification stop */
        /* WEB_NOTIFICATION stop  */

        if ($rec_check_case['SEARCH_PERSON'] == 'on') {
            $link_SEARCH_PERSON .= "&STATUS=SEARCH";
            $link_SEARCH_PERSON .= "&PAGE_CODE=" . $PAGE_CODE;
            $link_SEARCH_PERSON .= "&TO_PERSON_ID=" . $toPersonId . "&SEND_TO=2";
            $link_SEARCH_PERSON .= "&DATA_SEARCH=ALL";
            $Url_SEARCH_PERSON = $rec_check_case['URL_CODE_PERSON'] . "?1=1" . $link_SEARCH_PERSON;
            $img_SEARCH_PERSON = "searchPerson.png";
            $obj[] = [
                "Name" => "searchPerson",
                'Html' => like_url($Url_SEARCH_PERSON, $img_SEARCH_PERSON),
                'Status' => 'red',
            ];
        }
    }


    $num = count($obj);
} // end while
if ($num > 0) {
    $row['ResponseCode'] = array('ResCode' => '000', 'ResMeassage' => "SUCCESS");
    $row['Btns'] = $obj;
} else {
    $row['ResponseCode'] = array('ResCode' => '102', 'ResMeassage' => "NOT FOUND");
    // $row['status'] = "NO";
    /*  $row['variable'] = ['PCC_CIVIL_GEN','PAGE_CODE','SYSTEM_TYPE']; */
}

echo json_encode($row);
