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

$PAGE_CODE = $POST['pageCode'];
$SYSTEM_TYPE = $POST["systemCode"];
$PCC_CIVIL_GEN = $POST["pccCivilGen"];
$toPersonId = $POST['toPersonId'];
if ($SYSTEM_TYPE == 1) {

     getCivilToWh($PCC_CIVIL_GEN); //เรียก api มาบันทึกข้อมูล
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

            // $sql_WH_PERSON = "SELECT a.REGISTER_CODE ,a.FULL_NAME ,a.COURT_CODE ,a.COURT_NAME ,a.PREFIX_BLACK_CASE ,a.BLACK_CASE ,a.BLACK_YY 
        // ,a.PREFIX_RED_CASE ,a.RED_CASE ,a.RED_YY ,a.CONCERN_CODE ,a.COURT_NAME ,a.CONCERN_NAME
        // FROM WH_CIVIL_CASE_PERSON a 
        // JOIN WH_CIVIL_CASE b ON a.WH_CIVIL_ID = b.WH_CIVIL_ID 
        // WHERE 	1=1 AND b.CIVIL_CODE = '" . $PCC_CIVIL_GEN . "'{$FILL} 
        // AND REGEXP_LIKE ( a.REGISTER_CODE, '^[0-9]+$' ) AND a.REGISTER_CODE NOT IN ( SELECT REGISTER_CODE FROM VIEW_WH_ALL_CASE_PERSON WHERE FIRST_NAME LIKE '%ธนาคาร%' 
        // AND REGISTER_CODE IS NOT NULL AND REGEXP_LIKE ( REGISTER_CODE, '^[0-9]+$' ) GROUP BY REGISTER_CODE )
        // ";

        // $sqlbank = "SELECT REGISTER_CODE, FIRST_NAME
        //         FROM VIEW_WH_ALL_CASE_PERSON
        //         WHERE FIRST_NAME LIKE '%ธนาคาร%'
        //         AND REGISTER_CODE IS NOT NULL
        //         AND REGEXP_LIKE(REGISTER_CODE, '^[0-9]+$')
        //         GROUP BY REGISTER_CODE, FIRST_NAME";

        // $querybank = db::query($sqlbank);
        // $result_bank = array();
        // while ($res_bank = db::fetch_array($querybank)){
        //     $result_bank[] = $res_bank['REGISTER_CODE'];
        // }
		// print_r($result_bank);

        function findUniqueValues($array1, $array2) {
            // สร้างอาร์เรย์เพื่อเก็บค่าที่ไม่ซ้ำกันในชุดที่สอง
            $uniqueValues = array();
        
            // สร้างตัวแปรเพื่อใช้เก็บค่า register_code ในชุดแรก
            $registerCodes1 = array();
        
            // วนลูปผ่านชุดข้อมูลแรกเพื่อเก็บค่า register_code ในชุดแรก
            foreach ($array1 as $item) {
                $registerCode = $item['REGISTER_CODE'];
                $registerCodes1[$registerCode] = true;
            }
        
            // วนลูปผ่านชุดข้อมูลที่สอง
            foreach ($array2 as $item) {
                $registerCode = $item['REGISTER_CODE'];
        
                // เช็คว่าค่า register_code ไม่ซ้ำกันในชุดแรก
                if (!isset($registerCodes1[$registerCode])) {
                    $uniqueValues[] = $item;
                }
            }
        
            return $uniqueValues;
        }

            $sql_WH_PERSON = "SELECT a.REGISTER_CODE ,a.FULL_NAME ,a.COURT_CODE ,a.COURT_NAME ,a.PREFIX_BLACK_CASE ,a.BLACK_CASE ,a.BLACK_YY 
        ,a.PREFIX_RED_CASE ,a.RED_CASE ,a.RED_YY ,a.CONCERN_CODE ,a.COURT_NAME ,a.CONCERN_NAME
        FROM ".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')." a 
        JOIN WH_CIVIL_CASE b ON a.WH_CIVIL_ID = b.WH_CIVIL_ID 
        WHERE 	1=1 AND b.CIVIL_CODE = '" . $PCC_CIVIL_GEN . "'{$FILL} 
        ";
            $queryWH_PERSON = db::query($sql_WH_PERSON);
            $text_N = 1;
            $data_array = db::num_rows($queryWH_PERSON);
            $REGISTERCODE = '';
            $CONCERN_CODE = '';
            $queryWH_PERSON = db::query($sql_WH_PERSON);
            while ($rec_WH = db::fetch_array($queryWH_PERSON)) {
                $uniqueValuesInSecondSet = findUniqueValues($result_bank, $rec_WH);
                foreach ($uniqueValuesInSecondSet as $item) {
                    echo "REGISTER_CODE: " . $item['REGISTER_CODE'] . "<br>";
                    // แสดงค่าอื่น ๆ ตามที่ต้องการ
                }
                $REGISTERCODE .=  $rec_WH["REGISTER_CODE"] . ($data_array == $text_N ? "" : ",");
                $CONCERN_CODE .= $rec_WH["CONCERN_CODE"]  . ($data_array == $text_N ? "" : ",");
                $text_N++;
            }
        } else if ($dataDATA_SEARCH['DATA_SEARCH'] == 'COUPLE'|| $dataDATA_SEARCH['DATA_SEARCH'] == 'CROSS') {
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
            $FILL = "  AND a.CONCERN_NAME IN ('โจทก์')";//การเลือกคู่ต้อเป็นโจทย์จำเลยเท่านั้น
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
            $FILL = "  AND a.CONCERN_NAME IN ('จำเลย')";//การเลือกคู่ต้อเป็นโจทย์จำเลยเท่านั้น
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
        } else if ($dataDATA_SEARCH['DATA_SEARCH'] == 'CROSS') {
        }
    }
}



$array_link = "";
foreach (json_decode($str_json, true) as $sh1 => $ch1) {
    $array_link .= "&" . $sh1 . "=" . $ch1;
}

unset($fields);
$fields["PAGE_CODE"]                 =    $PAGE_CODE;
$fields["COLUMN1"]                 =     $array_link;
$fields["CREATE_DATE"]                 =    date("Y-m-d");
db::db_insert("TEST_DATA_RES", $fields, 'PK_ID', 'PK_ID');

$token = 1;
if ($token == 1) {
    $link = '';
    $obj = array();
    $sql_check_case = "SELECT *FROM M_CHECK_CASE a WHERE a.PAGE_CODE='" . $PAGE_CODE . "' AND  a.CMD_ID ='1'";

    $query_check_case = db::query($sql_check_case);
    while ($rec_check_case = db::fetch_array($query_check_case)) {
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

            if (in_array("CONCERN_CODE", $array_check)) {
                if ($CONCERN_CODE != '') { //สถานะคน โจทย์ จำเลย
                    $link .= "&CONCERN_CODE=" . $CONCERN_CODE;
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
            $obj[] = $rec_check_case['URL_CODE'] . "?1=1" . $link;
           //  $obj[] = $rec_check_case['URL_CODE'] . "?CODE=" . base64_encode($link);
        }
    }

    /* api order start */


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
    //echo     $sql_DOC_CMD;
    $query_DOC_CMD = db::query($sql_DOC_CMD);
    $rec_DOC_CMD = db::fetch_array($query_DOC_CMD);
    $obj_order = "http://103.208.27.224:81/led_service_api/public/search_data_cmd.php?1=1" . "&TO_PERSON_ID=" . $toPersonId . "&SEND_TO=1";
    /* api order stop */
}

$num = count($obj);

if ($num > 0) {
    $row['ResponseCode'] = array('ResCode' => '000', 'ResMeassage' => "SUCCESS");
    $row['link'] = $obj;
    $row['variable'] = $array_check;
    $row['status'] = "YES";
    $row['commandOfficial'] = [
        "link" => $obj_order,
        "amount" => strval($rec_DOC_CMD['COUNT_TOTAL']),
        "newMessageStatus" => 'YES',
    ];
} else {
    $row['ResponseCode'] = array('ResCode' => '102', 'ResMeassage' => "NOT FOUND");
    $row['status'] = "NO";
    /*  $row['variable'] = ['PCC_CIVIL_GEN','PAGE_CODE','SYSTEM_TYPE']; */
}

echo json_encode($row);
