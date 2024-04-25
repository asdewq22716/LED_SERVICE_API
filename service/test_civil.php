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
$SYSTEM_TYPE = $POST["systemCode"];
$PCC_CIVIL_GEN = $POST["pccCivilGen"];
$toPersonId = $POST['toPersonId'];

$dpdCivilTrnGen = $POST['dpdCivilTrnGen'];

if ($SYSTEM_TYPE == 1) {

    if ($dpdCivilTrnGen != "" && $PCC_CIVIL_GEN == "") {
        $array_dpdCivilTrnGen = [
            "dpdCivilTrnGen" => $dpdCivilTrnGen
        ];
        $data_string = json_encode($array_dpdCivilTrnGen);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://103.40.146.73/LedService.php/ConvertDpdCivilTrnGenToPccCivilGen',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data_string,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $dataReturn = json_decode($response, true);
        $PCC_CIVIL_GEN = $dataReturn['PCC_CIVIL_GEN'];
    }

    function check_bank($input_array, $PAGE_CODE)
    {
        $data_Arr = "";
        $sql_check_bank = "SELECT a.DATA_BANK FROM M_CHECK_CASE a WHERE a.PAGE_CODE='" . $PAGE_CODE . "' ";
        $querycheck_bank = db::query($sql_check_bank);
        $data_check = db::fetch_array($querycheck_bank);
        if ($data_check['DATA_BANK'] == 'YES') {
            $data_Arr = $input_array;
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
        }
        return ($data_Arr);
    }
    // getCivilToWh($PCC_CIVIL_GEN); //เรียก api มาบันทึกข้อมูล
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
    if ($dataSelectData["CIVIL_CODE"] == "") {
        //getCivilToWh($PCC_CIVIL_GEN);

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
    }
    $num1 = db::num_rows($querySelectData);
    if ($num1 > 0) {
        $sql_DATA_SEARCH = "SELECT a.DATA_SEARCH FROM M_CHECK_CASE a  WHERE a.PAGE_CODE ='" . $PAGE_CODE . "'";
        $queryDATA_SEARCH = db::query($sql_DATA_SEARCH);
        $dataDATA_SEARCH  = db::fetch_array($queryDATA_SEARCH);
        //-------------------------------ค้นหาทั้งหมด------------------------------------
        if ($dataDATA_SEARCH['DATA_SEARCH'] == 'ALL') {
            /* start เอาเงื่อนไขเกี่ยวของเป็นมา เเบบ ALL  */
            $sql_A = "SELECT a.PAGE_CODE ,a.CMD_ID ,c.PRE_ID_PK  ,c.PRE_NAME FROM M_CHECK_CASE  a
        JOIN WF_CHECKBOX b ON a.CHECK_ID =b.WFR_ID 
        JOIN TEMP_REF_PARTY_TYPE c ON b.CHECKBOX_VALUE =c.PRE_ID_PK 
        WHERE 1=1
        AND  a.PAGE_CODE='" . $PAGE_CODE . "'
        AND b.WFS_FIELD_NAME ='TEMP_REF_PARTY_TYPE'
        AND  a.CMD_ID ='1'";

            $query_A = db::query($sql_A);
            $concerned = "";
            while ($rec_A = db::fetch_array($query_A)) {
                $concerned .= $rec_A['PRE_NAME'] . ",";
            }
            $concerned1 = result_array(cut_last_comma($concerned));
            $FILL = "";
            if ($concerned != '') {
                //$FILL = "  AND a.CONCERN_NAME IN (" . $concerned1 . ")";
            }
            /* stop เอาเงื่อนไขเกี่ยวของเป็นมาwhere  */

            $sql_WH_PERSON = "SELECT a.REGISTER_CODE ,a.FULL_NAME ,a.COURT_CODE ,a.COURT_NAME ,a.PREFIX_BLACK_CASE ,a.BLACK_CASE ,a.BLACK_YY 
        ,a.PREFIX_RED_CASE ,a.RED_CASE ,a.RED_YY ,a.CONCERN_CODE ,a.COURT_NAME ,a.CONCERN_NAME
        FROM ".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')." a 
        JOIN WH_CIVIL_CASE b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
        WHERE 	1=1 AND b.CIVIL_CODE = '" . $PCC_CIVIL_GEN . "'{$FILL}
        ";

            $queryWH_PERSON = db::query($sql_WH_PERSON);
            $text_N = 1;
            $data_array = db::num_rows($queryWH_PERSON);
            $REGISTERCODE = '';
            $CONCERN_CODE = '';
            $queryWH_PERSON = db::query($sql_WH_PERSON);
            while ($rec_WH = db::fetch_array($queryWH_PERSON)) {
                $REGISTERCODE .=  $rec_WH["REGISTER_CODE"] . ($data_array == $text_N ? "" : ",");
                $CONCERN_CODE .= $rec_WH["CONCERN_CODE"]  . ($data_array == $text_N ? "" : ",");
                $text_N++;
            }
        } else if ($dataDATA_SEARCH['DATA_SEARCH'] == 'COUPLE' || $dataDATA_SEARCH['DATA_SEARCH'] == 'CROSS') {
            /* start เอาเงื่อนไขเกี่ยวของเป็นมา เเบบ CONCERN_COUPLE1  */
            $sql_COUPLE1 = "SELECT a.PAGE_CODE ,a.CMD_ID ,c.PRE_ID_PK  ,c.PRE_NAME FROM M_CHECK_CASE  a
                            JOIN WF_CHECKBOX b ON a.CHECK_ID =b.WFR_ID 
                            JOIN TEMP_REF_PARTY_TYPE c ON b.CHECKBOX_VALUE =c.PRE_ID_PK 
                            WHERE 1=1
                            AND  a.PAGE_CODE='" . $PAGE_CODE . "'
                            AND b.WFS_FIELD_NAME ='CONCERN_COUPLE1'
                            AND  a.CMD_ID ='1'";
            $query_COUPLE1 = db::query($sql_COUPLE1);
            $CONCERNED_C1 = "";
            while ($rec_A = db::fetch_array($query_COUPLE1)) {
                $CONCERNED_C1 .= $rec_A['PRE_NAME'] . ",";
            }
            $concerned1 = "";
            $concerned1 = result_array(cut_last_comma($CONCERNED_C1));
            $FILL = "";
            if ($concerned != '') {
                // $FILL = "  AND a.CONCERN_NAME IN (" . $concerned1 . ")";
            }
            $FILL = "  AND a.CONCERN_NAME IN ('โจทก์')"; //การเลือกคู่ต้อเป็นโจทย์จำเลยเท่านั้น
            $sql_WH_PERSON_COUPLE1 = "SELECT a.REGISTER_CODE ,a.FULL_NAME ,a.COURT_CODE ,a.COURT_NAME ,a.PREFIX_BLACK_CASE ,a.BLACK_CASE ,a.BLACK_YY 
        ,a.PREFIX_RED_CASE ,a.RED_CASE ,a.RED_YY ,a.CONCERN_CODE ,a.COURT_NAME ,a.CONCERN_NAME
        FROM ".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')." a 
        JOIN WH_CIVIL_CASE b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
        WHERE 	1=1 AND b.CIVIL_CODE = '" . $PCC_CIVIL_GEN . "'{$FILL}
        ";

            $queryWH_PERSON_COUPLE1 = db::query($sql_WH_PERSON_COUPLE1);
            $text_N = 1;
            $data_array_COUPLE1 = db::num_rows($queryWH_PERSON_COUPLE1);
            $REGISTERCODE_C1 = '';
            $queryWH_PERSON_COUPLE1 = db::query($sql_WH_PERSON_COUPLE1);
            while ($rec_WH = db::fetch_array($queryWH_PERSON_COUPLE1)) {
                $REGISTERCODE_C1 .=  $rec_WH["REGISTER_CODE"] . ($data_array_COUPLE1 == $text_N ? "" : ",");
                $text_N++;
            }
            /* stop เอาเงื่อนไขเกี่ยวของเป็นมา เเบบ CONCERN_COUPLE1  */

            /* start เอาเงื่อนไขเกี่ยวของเป็นมา เเบบ CONCERN_COUPLE2  */
            $sql_COUPLE2 = "SELECT a.PAGE_CODE ,a.CMD_ID ,c.PRE_ID_PK  ,c.PRE_NAME FROM M_CHECK_CASE  a
              JOIN WF_CHECKBOX b ON a.CHECK_ID =b.WFR_ID 
              JOIN TEMP_REF_PARTY_TYPE c ON b.CHECKBOX_VALUE =c.PRE_ID_PK 
              WHERE 1=1
              AND  a.PAGE_CODE='" . $PAGE_CODE . "'
              AND b.WFS_FIELD_NAME ='CONCERN_COUPLE2'
              AND  a.CMD_ID ='1'";

            $query_COUPLE2 = db::query($sql_COUPLE2);
            $concerned = "";
            $CONCERNED_C2 = "";
            while ($rec_A = db::fetch_array($query_COUPLE2)) {
                $CONCERNED_C2 .= $rec_A['PRE_NAME'] . ",";
            }

            $concerned1 = result_array(cut_last_comma($CONCERNED_C2));
            $FILL = "";
            if ($concerned != '') {
                //$FILL = "  AND a.CONCERN_NAME IN (" . $concerned1 . ")";
            }
            $FILL = "  AND a.CONCERN_NAME IN ('จำเลย')"; //การเลือกคู่ต้อเป็นโจทย์จำเลยเท่านั้น
            $sql_WH_PERSON_COUPLE2 = "SELECT a.REGISTER_CODE ,a.FULL_NAME ,a.COURT_CODE ,a.COURT_NAME ,a.PREFIX_BLACK_CASE ,a.BLACK_CASE ,a.BLACK_YY 
                      ,a.PREFIX_RED_CASE ,a.RED_CASE ,a.RED_YY ,a.CONCERN_CODE ,a.COURT_NAME ,a.CONCERN_NAME
                      FROM ".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')." a 
                      JOIN WH_CIVIL_CASE b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
                      WHERE 	1=1 AND b.CIVIL_CODE = '" . $PCC_CIVIL_GEN . "'{$FILL}
                      ";
            $queryWH_PERSON_COUPLE2 = db::query($sql_WH_PERSON_COUPLE2);
            $text_N = 1;
            $data_array_COUPLE2 = db::num_rows($queryWH_PERSON_COUPLE2);
            $REGISTERCODE_C2 = '';
            $queryWH_PERSON_COUPLE2 = db::query($sql_WH_PERSON_COUPLE2);
            while ($rec_WH = db::fetch_array($queryWH_PERSON_COUPLE2)) {
                $REGISTERCODE_C2 .=  $rec_WH["REGISTER_CODE"] . ($data_array_COUPLE2 == $text_N ? "" : ",");
                $text_N++;
            }
            /* stop เอาเงื่อนไขเกี่ยวของเป็นมา เเบบ CONCERN_COUPLE1  */
        }
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
db::db_insert("TEST_DATA_RES", $fields, 'PK_ID', 'PK_ID');
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
    $link = '';
    $obj = array();
    $sql_check_case = "SELECT *FROM M_CHECK_CASE a WHERE a.PAGE_CODE='" . $PAGE_CODE . "' AND  a.CMD_ID ='1'";

    $REGISTERCODE =  check_bank($REGISTERCODE, $PAGE_CODE);

    //$REGISTERCODE_C1 =  check_bank($REGISTERCODE_C1, $PAGE_CODE);
    //$REGISTERCODE_C2 =  check_bank($REGISTERCODE_C2, $PAGE_CODE);
    $query_check_case = db::query($sql_check_case);
    function like_url($Url, $img)
    {
        return " <a href=\"javascript:openDGDialogWithExternalLink('$Url', 800, 800)\"><img src=\"http://103.208.27.224:81/led_service_api/images/{$img}\" style=\"width:45px;\"></a>";
    }

    function link_url_sup($Url, $img, $Total)
    {
        "<a href=\"javascript:openDGDialogWithExternalLink('$Url', 800, 800)\"><img  src=\"http://103.208.27.224:81/led_service_api/images/{$img}\"  style=\"width:45px;\"><sup style=\"background-color: red;\">&nbsp;$Total&nbsp;</sup></a>";
    }
    $array_test = [];

    while ($rec_check_case = db::fetch_array($query_check_case)) { //start while
        $array_test = $rec_check_case;
        /* ----------------------------------------------------------------------------------------------------------- */
        /* ตรวจคน start */
        if ($rec_check_case['URL_CODE'] == "http://103.208.27.224:81/led_service_api/public/search_data_WH.php") {
            $array_check = explode(",", $rec_check_case['NOTE']); //แปลงข้อมูล เป็นarray เพื่อเช็คค่า
            if ($rec_check_case['DATA_SEARCH'] == 'ALL') {
                if (in_array("REGISTERCODE", $array_check)) {
                    if ($REGISTERCODE != '') { //รหัสบัตรประชาชน
                        $link .= "&REGISTERCODE=" . $REGISTERCODE;
                        $link .= "&CONCERNED=" . cut_last_comma($concerned);
                    }
                }
            } else {
                if (in_array("REGISTERCODE", $array_check)) {
                    if ($REGISTERCODE_C1 != '') { //รหัสบัตรประชาชน
                        $link .= "&REGISTERCODE_C1=" . $REGISTERCODE_C1;
                        $link .= "&CONCERNED_C1=" . cut_last_comma($CONCERNED_C1);
                    }
                    if ($REGISTERCODE_C2 != '') { //รหัสบัตรประชาชน
                        $link .= "&REGISTERCODE_C2=" . $REGISTERCODE_C2;
                        $link .= "&CONCERNED_C2=" . cut_last_comma($CONCERNED_C2);
                    }
                }
            }
            if (in_array("BLACK_CASE", $array_check)) {
                $link .= "&T_BLACK_CASE=" . $dataSelectData['PREFIX_BLACK_CASE'] . "&BLACK_CASE=" . $dataSelectData['BLACK_CASE'] . "&BLACK_YY=" . $dataSelectData['BLACK_YY'];
            }
            if (in_array("RED_CASE", $array_check)) {
                $link .= "&T_RED_CASE=" . $dataSelectData['PREFIX_RED_CASE'] . "&RED_CASE=" . $dataSelectData['RED_CASE'] . "&RED_YY=" . $dataSelectData['RED_YY'];
            }
            if (in_array("COURT_CODE", $array_check)) {
                $link .= "&COURT_CODE=" . $dataSelectData['COURT_CODE'] . "&COURT_NAME=" . $dataSelectData['COURT_NAME'];
            }
            $link .= "&DATA_SEARCH=" . $rec_check_case['DATA_SEARCH'];
            $link .= "&PCC_CIVIL_GEN=" . $PCC_CIVIL_GEN;
            $link .= "&TO_PERSON_ID=" . $toPersonId . "&SEND_TO=1";
            $Url_Person = $rec_check_case['URL_CODE'] . "?1=1" . $link;


            //check_person เช็คคนที่อยู่ในคดีไปเจอติดอยู่ที่คดีอื่น
            $img_person = "";
            if ($PCC_CIVIL_GEN == "") {
                $img_person = "yellow.png";
            } else if (check_person($link) > 0) {
                $img_person = "red.png";
            } else if (check_person($link) == 0) {
                $img_person = "green.png";
            }
            if ($img_person == "") {
                $img_person = "red.png";
            }
            // $img_person = "red.gif";
            //echo check_person($link);
            if ($rec_check_case['WEB_PERSON'] == "Y") {
                $obj[] = [
                    'Name' => 'Person',
                    'Html' => like_url($Url_Person, $img_person),
                    'Status' => $PCC_CIVIL_GEN == "" ? "Yellow" : "Red"
                    //  $obj[] = $rec_check_case['URL_CODE'] . "?CODE=" . base64_encode($link);
                    // $obj['Person']['Status'] = $PCC_CIVIL_GEN == "" ? "incomplete" : "complete";
                ];
            }
        }
        /* ตรวจคน stop */


        /* ----------------------------------------------------------------------------------------------------------- */
        /* ตรวจทรัพย์ที่อยู่ใน คดี Start */
        $data_Assets = "";
        $data_Assets .= "&PCC_CIVIL_GEN=" . $PCC_CIVIL_GEN;
        $data_Assets .= "&TO_PERSON_ID=" . $toPersonId . "&SEND_TO=1";
        $Url_AssetsForCase = "http://103.208.27.224:81/led_service_api/public/search_data_assetsFormCase.php?1=1" . $data_Assets;
        print_r(alertAssetsRepeatCivilToBankrupt($PCC_CIVIL_GEN,$toPersonId)); //เมื่อเเพ่งมีการตรวจเจอทรัยพ์ซ้ำจะเเจ้งเตือนจากเเพ่งไปที่ล้มละลาย
        //print_r(AssetsForCase_check($data_Assets));
        $img_AssetsForCase = "";

        /*   if ($PCC_CIVIL_GEN == "") {
        $img_AssetsForCase = "AssetsForCase_yellow.gif";
    }else {
        if(AssetsForCase_check($data_Assets)>0){
            $img_AssetsForCase = "AssetsForCase_red.gif";
        }else {
            $img_AssetsForCase = "AssetsForCase_green.gif";
        }
    } */
        $img_AssetsForCase = "AssetsForCase_red.png";
        if ($rec_check_case['WEB_ASSETS_FOR_CASE'] == "Y") {
            $obj[] = [
                'Name' => 'AssetsForCase',
                'Status' => $PCC_CIVIL_GEN == "" ? "Yellow" : "Red",
                'Html' => like_url($Url_AssetsForCase, $img_AssetsForCase)
            ];
        }
        /* ตรวจทรัพย์ที่อยู่ใน คดี Stop */

        /* ----------------------------------------------------------------------------------------------------------- */
        /* ค้นหาทรัพย์ Start */
        $Url_SearchForAssets = "http://103.208.27.224:81/led_service_api/public/search_data_assets_type.php?1=1";
        if ($rec_check_case['WEB_SEARCH_FOR_ASSETS'] == "Y") {
            $obj[] = [
                'Name' => 'SearchForAssets',
                'Html' => like_url($Url_SearchForAssets, "SearchForAssets.png"),
                'Status' => "Red"
            ];
        }
        /* ค้นหาทรัพย์ Stop */

        /* ----------------------------------------------------------------------------------------------------------- */
        /* api order start */
        /* use toPersonId  */
        $sql_DOC_CMD = "SELECT COUNT(A.ID) AS COUNT_TOTAL  FROM M_DOC_CMD A
                        LEFT JOIN M_CMD_SYSTEM B ON A.SYS_NAME = B.CMD_SYSTEM_ID
                        LEFT JOIN M_SERVICE_CMD C ON A.CASE_TYPE = C.CMD_TYPE_CODE
                        LEFT JOIN M_CMD_PERSON D ON	D.PERSON_ID = A.PERSON_ID
                        LEFT JOIN M_CMD_TYPE E ON C.CMD_TYPE_ID = E.CMD_TYPE_ID
                        WHERE 1 = 1	
                       -- AND NVL(A.REF_ID, 0) = 0 
                       -- AND A.TO_PERSON_ID ='" . $toPersonId . "'
                       AND (A.SEND_TO = '1' and (A.TO_PERSON_ID = '" . $toPersonId . "' or A.TRANSACTION_APPROVE_PERSON = '" . $toPersonId . "'))
                        ORDER BY	
                        A.CMD_DOC_DATE DESC,
                        A.CMD_DOC_TIME DESC";
        $query_DOC_CMD = db::query($sql_DOC_CMD);
        $rec_DOC_CMD = db::fetch_array($query_DOC_CMD);
        $obj_order = "http://103.208.27.224:81/led_service_api/public/search_data_cmd.php?1=1" . "&TO_PERSON_ID=" . $toPersonId . "&SEND_TO=1";

        $COUNT_TOTAL = strval($rec_DOC_CMD['COUNT_TOTAL']);
        if ($rec_check_case['WEB_MAIL'] == "Y") {
            $obj[] = [


                'Name' => 'Mail',
                'Html' => "<a href=\"javascript:openDGDialogWithExternalLink('$obj_order', 800, 800)\"><img  src=\"http://103.208.27.224:81/led_service_api/images/letter.png\"  style=\"width:45px;\"><sup style=\"background-color: red;\">&nbsp;$COUNT_TOTAL&nbsp;</sup></a>",
                'Amount' => strval($rec_DOC_CMD['COUNT_TOTAL']),
                'NewMessageStatus' => 'YES'
            ];
        }
        /* api order stop */
        /*  */
        if ($rec_check_case['WEB_ALERT_MESSAGE'] == "Y") {
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

        /* ----------------------------------------------------------------------------------------------------------- */
    }
    $row1 = "openDGDialogWithExternalLink('http://103.208.27.224:81/led_service_api/public/alert.php?message=alert+ข้อความด้วยฟังกัชันเว็บบูรณาการ',300,50);console.log('test');";
    $num = count($obj);
} // end while
if ($num > 0) {
    $row['ResponseCode'] = array('ResCode' => '000', 'ResMeassage' => "SUCCESS");
    $row['Btns'] = $obj;
    $row['AlertMessage'] = $CMD_NOTE;
    $row['JsEval'] = "";
} else {
    // $row['ResponseCode'] = array('ResCode' => '102', 'ResMeassage' => "NOT FOUND");
    // $row['status'] = "NO";
    /*  $row['variable'] = ['PCC_CIVIL_GEN','PAGE_CODE','SYSTEM_TYPE']; */
}

echo json_encode($row);
