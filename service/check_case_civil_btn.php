<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);  */
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
$SYSTEM_TYPE = $POST["systemCode"];
$PCC_CIVIL_GEN = $POST["pccCivilGen"];
$toPersonId = $POST['toPersonId'];



$subPageCode = $PAGE_CODE . (empty($POST['subPageCode']) ? "" : "_" . $POST['subPageCode']);

if ($PAGE_CODE == "CFC3I020") {
    $PAGE_CODE = $PAGE_CODE . (empty($POST['subPageCode']) ? "" : "_" . $POST['subPageCode']);
}


$url_api = "http://103.208.27.224:81";

/* print_r(civil::pccCivilGetIdcardForAsset($PCC_CIVIL_GEN)); */

if ($SYSTEM_TYPE == 1) {

    //แปลงKey เป็น PccCivil
    $PCC_CIVIL_GEN = civil::getPccCivilGen($POST);
    $sql_check_case = "SELECT *FROM M_CHECK_CASE a WHERE a.PAGE_CODE='" . $PAGE_CODE . "' AND  a.CMD_ID ='1'";
    $queryWH_page = db::query($sql_check_case);
    $rec_page = db::fetch_array($queryWH_page);

    //เรียก api มาบันทึกข้อมูล
    if ($rec_page['INFORMATION_API'] == 'OPEN') {
        getCivilToWh($PCC_CIVIL_GEN);
        $main->time_function('getCivilToWh', $PCC_CIVIL_GEN);
    }

    //N คือปิดการใช้
    if ($rec_page['STATUS_BUTTON'] == 'N') {
        exit;
    }

    $Civil = new Civil();
    $Civil->PCC_CIVIL_GEN = $PCC_CIVIL_GEN;

    function evalBtn($PAGE_CODE, $PCC_CIVIL_GEN)
    {
        global $url_api;
        $number = explode(",", "2,3,4,5,6,9,10,11,12,13,14,15,16");
        foreach ($number as $AA1 => $BB1) {
            switch ($PAGE_CODE) {
                case "CFC3I020_{$BB1}":
                    $strData[] = [
                        "page" => $PAGE_CODE,
                        "action" => "preCaption",
                        "apiUrl" => "$url_api/led_service_api/service/LedServiceQuery.php",
                        "params" => [
                            "cfcCaptionGen"
                        ]
                    ];
                    break;
            }
        }
        switch ($PAGE_CODE) {
            case "DPD2I010_1":
                $strData = array();
                unset($strData);
                $strData[] = [
                    "page" => $PAGE_CODE,
                    "action" => "sendCheck", //บันทึกส่งปฏิบัติงาน
                    "apiUrl" => "$url_api/led_service_api/service/LedServiceQuery.php",
                    "params" => [
                        "shrCaseGen"
                    ]
                ];
                $strData[] = [
                    "page" => $PAGE_CODE,
                    "action" => "processAccount", // ประมวลผล
                    "apiUrl" => "$url_api/led_service_api/service/LedServiceQuery.php",
                    "params" => [
                        "shrCaseGen"
                    ]
                ];
                $strData[] = [
                    "page" => $PAGE_CODE,
                    "action" => "saveByWorkStatus", // บันทึกเริ่มปฎิบัติงาน
                    "apiUrl" => "$url_api/led_service_api/service/LedServiceQuery.php",
                    "params" => [
                        "shrCaseGen"
                    ]
                ];
                break;

            case "DPD1I030":
                $strData[] = [
                    "page" => $PAGE_CODE,
                    "action" => "approveAccount",
                    "apiUrl" => "$url_api/led_service_api/service/LedServiceQuery.php",
                    "params" => [
                        "dpdCivilTrnGen"
                    ]
                ];
                break;
            case "AUC1I100_2":
                $strData[] = [
                    "page" => $PAGE_CODE,
                    "action" => "addPerson",
                    "apiUrl" => "$url_api/led_service_api/service/LedServiceQuery.php",
                    "params" => [
                        "aucSubOrderGen",
                        "plateNo",
                        "webuibidDate",
                        "centDeptGen"
                    ]
                ];
                $strData[] = [
                    "page" => $PAGE_CODE,
                    "action" => "save",
                    "apiUrl" => "$url_api/led_service_api/service/LedServiceQuery.php",
                    "params" => [
                        "_currentPccCivil",
                        "aucSubOrderGen"
                    ]
                ];
                break;
            case "AUD3I010":
                $strData[] = [
                    "page" => $PAGE_CODE,
                    "action" => "save",
                    "apiUrl" => "$url_api/led_service_api/service/LedServiceQuery.php",
                    "params" => [
                        "pccCaseGen"
                    ]
                ];
                break;
            case "CFC3I030":
                $strData[] = [
                    "page" => $PAGE_CODE,
                    "action" => "save",
                    "apiUrl" => "$url_api/led_service_api/service/LedServiceQuery.php",
                    "params" => [
                        "getWebUITableHiddenChecked:cfcCivilAndAssetTable:cfcCaptionGen"
                    ]
                ];
                break;
            case "CFC9I070_2":
                $strData[] = [
                    "page" => $PAGE_CODE,
                    "action" => "ok",
                    "apiUrl" => "$url_api/led_service_api/service/LedServiceQuery.php",
                    "params" => [
                        "getWebUITableHiddenChecked:propertyTable:cfcCaptionGen"
                    ]
                ];
                break;
        }
        return  $strData;
    }

    //ตรวจจำนวนการทำงานปุ่ม
    $DataPersonBankrupt = evalBtn($subPageCode, $PCC_CIVIL_GEN);

    //ส่ง pccCivil ไปค้นหาทีDBแพ่ง จากนั้นนำ13หลัก ไปตรวจในDBล้มละลาย
    //เมื่อตรวจทรัพย์เเล้วพบว่ามีคนล้ม จะส่งไปfunction LockCFC_CAPTION เพื่อ update IS_OWNER_BANKRUPT 
    $array_idcard = civil::pccCivilGetIdcardForAsset($PCC_CIVIL_GEN); //13หลักของคนในทรัพย์
    $IdCardOut = ($Civil->cutIdcardOutCaption($array_idcard)); //13หลักของคนในคดี ไม่เอาคนในทรัพย์
    //การล็อคทรัพย์ของคนที่อยู่ในทรัพย์เเละไม่อยู่ในทรัพย์
    ($Civil->LockAllCaption($IdCardOut)); //มีคนติดล้มเเละ ไม่มีการทำคำสั่งต้องล็อคทรัพย์ที่ไม่มีการส่งคำสั่ง
    (civil::LockCFC_CAPTION($array_idcard)); //ไปล็อก CFC_CAPTION คนในทรัพย์

    $sqlSelectData = "	SELECT 	CIVIL_CODE,
								COURT_CODE,
                                COURT_NAME,
								PREFIX_BLACK_CASE,BLACK_CASE,BLACK_YY,
								PREFIX_RED_CASE,RED_CASE,RED_YY,
								PLAINTIFF1,DEFFENDANT1,PCC_CASE_GEN,WH_CIVIL_ID 
						FROM 	WH_CIVIL_CASE
						WHERE 	CIVIL_CODE = '" . $PCC_CIVIL_GEN . "'";
    $querySelectData = db::query($sqlSelectData);
    $dataSelectData = db::fetch_array($querySelectData);

    //ตรวจว่ามีPccCivilGenนี้ในDBหรือไม่
    $num1 = db::num_rows($querySelectData);
    if ($num1 > 0) {
        //-------------------------------ค้นหาทั้งหมด------------------------------------
        if ($rec_page['DATA_SEARCH'] == 'ALL') {
            /* start เอาเงื่อนไขเกี่ยวของเป็นมา เเบบ ALL  */
            $REGISTERCODE = checkMain::check_bank_CIVIL(checkMain::REGISTER_CODE_13_CIVIL($PCC_CIVIL_GEN, "", ""), $PAGE_CODE);
        } else if ($rec_page['DATA_SEARCH'] == 'COUPLE' || $rec_page['DATA_SEARCH'] == 'CROSS' || $rec_page['DATA_SEARCH'] == 'CROSS_AND_ALL') {
            $REGISTERCODE_C1 = checkMain::check_bank_CIVIL(checkMain::REGISTER_CODE_13_CIVIL($PCC_CIVIL_GEN, "โจทก์,เจ้าหนี้", ""), $PAGE_CODE);
            $REGISTERCODE_C2 = checkMain::check_bank_CIVIL(checkMain::REGISTER_CODE_13_CIVIL($PCC_CIVIL_GEN, "จำเลย,ลูกหนี้", ""), $PAGE_CODE);
        } else if ($rec_page['DATA_SEARCH'] == '1COUPLE2ALL') { //ตรวจโจทก์ เป็นคู๋ เเละตรวจจำเลยเเละอื่นๆเป็นทั้งหมด
            $REGISTERCODE_C1 = checkMain::check_bank_CIVIL(checkMain::REGISTER_CODE_13_CIVIL($PCC_CIVIL_GEN, "โจทก์,เจ้าหนี้", ""), $PAGE_CODE); //เอาโจทก์
            $REGISTERCODE_C2 = checkMain::check_bank_CIVIL(checkMain::REGISTER_CODE_13_CIVIL($PCC_CIVIL_GEN, "จำเลย,ลูกหนี้", ""), $PAGE_CODE); //เอาจำเลย
            $REGISTERCODE_C3 = checkMain::check_bank_CIVIL(checkMain::REGISTER_CODE_13_CIVIL($PCC_CIVIL_GEN, "", "โจทก์,เจ้าหนี้,จำเลย,ลูกหนี้"), $PAGE_CODE); //เอาทุกสถานะยกเว้น โจทก์ จำเลย
        }
    } else {
        getCivilToWh($PCC_CIVIL_GEN); //เรียก api มาบันทึกข้อมูล
    }
}

/* เก็บ log start */
revive::Log_TEST_DATA_RES($str_json, $PAGE_CODE, '1');
/* เก็บ log stop */
$token = 1;
if ($token == 1) {

    function convert_order_Asset($data)
    {
        $sql_data = "";
        $sql_data = "SELECT CMD_TYPE_CODE ,CMD_TYPE_NAME FROM M_SERVICE_CMD WHERE CMD_TYPE_CODE ='" . $data . "'";
        $query_data = db::query($sql_data);
        $data_check = db::fetch_array($query_data);
        return $data_check['CMD_TYPE_NAME'];
    }
    function like_url($Url, $img)
    {
        global $url_api;
        return " <a href=\"javascript:openDGDialogWithExternalLink('$Url', 800, 800)\"><img src=\"{$url_api}/led_service_api/images/{$img}\" style=\"width:45px;\"></a>";
    }

    function link_url_sup($Url, $img, $Total)
    {
        global $url_api;
        "<a href=\"javascript:openDGDialogWithExternalLink('$Url', 800, 800)\"><img  src=\"{$url_api}/led_service_api/images/{$img}\"  style=\"width:45px;\"><sup style=\"background-color: red;\">&nbsp;$Total&nbsp;</sup></a>";
    }
    $link = '';
    $link_to_api = '';
    $obj = array();
    /* ตรวจคน start */
    if ($rec_page['WEB_PERSON'] == "Y") {
        //ตรวจทั้งหมด
        if ($rec_page['DATA_SEARCH'] == 'ALL') {
            $link_to_api .= "&REGISTERCODE=" .  $REGISTERCODE;
        } //ตรวจ คู่ ไขว้ ทั้งหมดเเละคู่ ทั้งหมดเเละไขว้
        else if ($rec_page['DATA_SEARCH'] == 'COUPLE' || $rec_page['DATA_SEARCH'] == 'CROSS' || $rec_page['DATA_SEARCH'] == 'CROSS_AND_ALL') {
            $link_to_api .= "&REGISTERCODE_C1=" . $REGISTERCODE_C1;
            $link_to_api .= "&REGISTERCODE_C2=" . $REGISTERCODE_C2;
        } //ตรวจโจทก์ เป็นคู๋ เเละตรวจจำเลยเเละอื่นๆเป็นทั้งหมด
        else if ($rec_page['DATA_SEARCH'] == '1COUPLE2ALL') {
            $link_to_api .= "&REGISTERCODE_C1=" . $REGISTERCODE_C1;
            $link_to_api .= "&REGISTERCODE_C2=" . $REGISTERCODE_C2;
            $link_to_api .= "&REGISTERCODE_C3=" . $REGISTERCODE_C3;
        }
        $link .= "&DATA_SEARCH=" . $rec_page['DATA_SEARCH'];
        $link .= "&PAGE_CODE=" . $PAGE_CODE;
        $link .= "&PCC_CIVIL_GEN=" . $PCC_CIVIL_GEN;
        $link .= "&TO_PERSON_ID=" . $toPersonId . "&SEND_TO=1";
        $Url_Person = "$url_api/led_service_api/public/search_data_WH.php" . "?" . func::get_E_and_D("check_case_civil_btn", "E", $link);
        $img_person = "";
        $text = $link_to_api . $link;
        if ($PCC_CIVIL_GEN == "") {
            $img_person = "yellow.png";
        } else if (check_person_3($text) > 0) {
            $img_person = "red.png";
        } else if (check_person_3($text) == 0) {
            $img_person = "green.png";
        }
        if ($img_person == "") {
            $img_person = "red.png";
        }
        addPerson("1", $text, $PCC_CIVIL_GEN, $toPersonId); //1=ระบบต้นทาง 2=ค่าGETต้นทาง  
        //print_r(backoffice::check_person_backoffice($PCC_CIVIL_GEN, "1", $toPersonId));
        $obj[] = [
            'Name' => 'Person',
            'Html' => like_url($Url_Person, $img_person),
            'Status' => $PCC_CIVIL_GEN == "" ? "Yellow" : "Red"
            //  $obj[] = $rec_check_case['URL_CODE'] . "?CODE=" . base64_encode($link);
            // $obj['Person']['Status'] = $PCC_CIVIL_GEN == "" ? "incomplete" : "complete";
        ];
    }
    /* ตรวจคน stop */


    /* ----------------------------------------------------------------------------------------------------------- */
    /* ตรวจทรัพย์ที่อยู่ใน คดี Start */
    if ($rec_page['WEB_ASSETS_FOR_CASE'] == "Y") {
        $data_Assets = "";
        $data_Assets .= "&PCC_CIVIL_GEN=" . $PCC_CIVIL_GEN;
        $data_Assets .= "&TO_PERSON_ID=" . $toPersonId . "&SEND_TO=1";
        $Url_AssetsForCase = "$url_api/led_service_api/public/search_data_assetsFormCase.php?" . func::get_E_and_D("check_case_civil_btn", "E", $data_Assets);

        //alertAssetsRepeatCivilToBankrupt($PCC_CIVIL_GEN, $toPersonId); 
        //เมื่อเเพ่งมีการตรวจเจอทรัยพ์ซ้ำจะเเจ้งเตือนจากเเพ่งไปที่ล้มละลาย
        //$num_Asset = (civil::alertAssetsRepeatCivilToBankrupt_lock($PCC_CIVIL_GEN, $toPersonId));

        $num_Asset_new = (civil::alertAssetsRepeatCivilToBankrupt_lock_new($PCC_CIVIL_GEN, $toPersonId));
        //print_pre($num_Asset_new);
        //print_r(AssetsForCase_check($data_Assets));//เช็คเมื่อมีทรัพย์ซ้ำ
        $img_AssetsForCase = "";
        /*  if ($PCC_CIVIL_GEN == "") {
                $img_AssetsForCase = "AssetsForCase_yellow.png";
            } else {
                if ($num_Asset > 0) {
                    $img_AssetsForCase = "AssetsForCase_red1.png";
                } else {
                    $img_AssetsForCase = "AssetsForCase_red.gif";
                }
            } */
        $img_AssetsForCase = "AssetsForCase_red.png";
        $obj[] = [
            'Name' => 'AssetsForCase',
            'Status' => $PCC_CIVIL_GEN == "" ? "Yellow" : "Red",
            'Html' => like_url($Url_AssetsForCase, $img_AssetsForCase)
        ];
    }
    /* ตรวจทรัพย์ที่อยู่ใน คดี Stop */

    /* ----------------------------------------------------------------------------------------------------------- */
    /* ค้นหาทรัพย์ Start */
    if ($rec_page['WEB_SEARCH_FOR_ASSETS'] == "Y") {
        $Url_SearchForAssets = "$url_api/led_service_api/public/search_data_assets_type.php?1=1";
        $obj[] = [
            'Name' => 'SearchForAssets',
            'Html' => like_url($Url_SearchForAssets, "SearchForAssets.png"),
            'Status' => "Red"
        ];
    }
    /* ค้นหาทรัพย์ Stop */

    /* ----------------------------------------------------------------------------------------------------------- */
    /* api order start */
    if ($rec_page['WEB_MAIL'] == "Y") {
        /* use toPersonId  */
        $img_order = 'letter.png';
        $link_order = "";
        $link_order .= "&PCC_CIVIL_GEN=" . $PCC_CIVIL_GEN;
        $link_order .= "&TO_PERSON_ID=" . $toPersonId;
        $link_order .= "&SEND_TO=1";
        $url_order = "$url_api/led_service_api/public/search_data_cmd.php?" . func::get_E_and_D("check_case_civil_btn", "E", $link_order);
        $obj[] = [
            'Name' => 'Mail',
            'Html' => like_url($url_order, $img_order) . '<span id="alert_no_reply1" class="badge badge-danger">' . func_main::getNumOrder($toPersonId, "1") . '</span>',
            'Amount' => func_main::getNumOrder($toPersonId, "1"),
            'NewMessageStatus' => 'YES'
        ];
    }
    /* api order stop */

    /* Btn notification start */
    if ($rec_page['WEB_NOTIFICATION'] == "Y") {
        $link_NOTIFICATION .= "&PCC_CIVIL_GEN=" . $PCC_CIVIL_GEN;
        $link_NOTIFICATION .= "&TO_PERSON_ID=" . $toPersonId . "&SEND_TO=1";
        $Url_NOTIFICATION = "$url_api/led_service_api/public/NontificationAlert.php?" . func::get_E_and_D("check_case_civil_btn", "E", $link_NOTIFICATION);
        $obj[] = [
            'Name' => 'NOTIFICATION',
            'Html' => like_url($Url_NOTIFICATION, "NOTIFICATION.png") . '<span id="alert_no_reply1" class="badge badge-danger">' . numberOfNotifications("1", $toPersonId) . '</span>',
            'Status' => "Red"
        ];
    }
    /* Btn notification stop */
    /*  */
    if ($rec_page['WEB_ALERT_MESSAGE'] == "Y") {
        if ($PCC_CIVIL_GEN != "") {
            $sql_Message1 =   " SELECT a.ID_OF_M_DOC_CMD FROM M_COMMAND_HISTORY a WHERE a.CODE_API='" . $PCC_CIVIL_GEN . "'"; //หา pk รายการ
            $query_sql_Message1 = db::query($sql_Message1);
            $CMD_NOTE = "";
            while ($rec_Main_M = db::fetch_array($query_sql_Message1)) {
                $sql_Message2 =   "SELECT *FROM M_DOC_CMD a 
                JOIN M_CMD_ASSET b ON a.ID =b.CMD_ID 
                WHERE 1=1
                AND a.ID='" . $rec_Main_M['ID_OF_M_DOC_CMD'] . "'
                AND a.REF_ID IS NULL";

                $sql_Message3 =   "SELECT *FROM M_DOC_CMD a 
                JOIN M_CMD_ASSET b ON a.ID =b.CMD_ID 
                WHERE 1=1
                AND a.REF_ID ='" . $rec_Main_M['ID_OF_M_DOC_CMD'] . "'
                 ORDER BY a.ID DESC";


                $data_array_3 = db::num_rows(db::query($sql_Message3));
                $sql_main_message = "";
                if ($data_array_3 > 0) {
                    $sql_main_message = $sql_Message3; //ถ้ามีซับคิวรี่ให้เเสดงซับตัวลาสุด
                } else {
                    $sql_main_message = $sql_Message2; //ถ้าไม่มีเเสดงตัวหลัก
                }
                $query_sql_main_message = db::query($sql_main_message);
                $num_Main_M = db::num_rows($query_sql_main_message);
                //$CMD_NOTE .=$sql_main_message;
                while ($recrec_1_Main_M = db::fetch_array($query_sql_main_message)) {
                    $CMD_NOTE .= " " . $recrec_1_Main_M['PROP_DET'] . "   " . convert_order_Asset($recrec_1_Main_M['ASSET_CASE_TYPE']) . "\n\n";
                }
            }
        }
    }
    if ($rec_page['SEARCH_PERSON'] == 'on') {
        $link_SEARCH_PERSON .= "&STATUS=SEARCH";
        $link_SEARCH_PERSON .= "&PAGE_CODE=" . $PAGE_CODE;
        $link_SEARCH_PERSON .= "&TO_PERSON_ID=" . $toPersonId . "&SEND_TO=1";
        $link_SEARCH_PERSON .= "&DATA_SEARCH=ALL";
        $Url_SEARCH_PERSON = $rec_page['URL_CODE'] . "?" . func::get_E_and_D("check_case_civil_btn", "E", $link_SEARCH_PERSON);
        $img_SEARCH_PERSON = "searchPerson.png";
        $obj[] = [
            "Name" => "searchPerson",
            'Html' => like_url($Url_SEARCH_PERSON, $img_SEARCH_PERSON),
            'Status' => 'red',
        ];
    }
    /* ----------------------------------------------------------------------------------------------------------- */
}
$row1 = "openDGDialogWithExternalLink('$url_api/led_service_api/public/alert.php?message=alert+ข้อความด้วยฟังกัชันเว็บบูรณาการ',300,50);console.log('test');";
$num = count($obj);
if (1 == 2) {
    print_pre($main->report_function());
}
if ($num > 0 || count($DataPersonBankrupt) > 0) {
    $row['ResponseCode'] = array('ResCode' => '000', 'ResMeassage' => "SUCCESS");
    $row['Btns'] = $obj;
    // $row['AlertMessage'] = $CMD_NOTE;
    $row['ValidateConfig'] = $DataPersonBankrupt;
} else {
    // $row['ResponseCode'] = array('ResCode' => '102', 'ResMeassage' => "NOT FOUND");
    // $row['status'] = "NO";
    /*  $row['variable'] = ['PCC_CIVIL_GEN','PAGE_CODE','SYSTEM_TYPE']; */
}

echo json_encode($row);
