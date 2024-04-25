<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
include '../include/include.php';
include '../include/func_Nop.php';

$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);

$pageCode=$POST['pageCode'];
$systemCode=$POST["systemCode"];
$pccCivilGen=$POST["pccCivilGen"];
if ($systemCode == '1') {
    getCivilToWh($pccCivilGen); //เรียก api มาบันทึกข้อมูล
    $sqlSelectData = "	SELECT 	CIVIL_CODE,
								COURT_CODE,
                                COURT_NAME,
								PREFIX_BLACK_CASE,BLACK_CASE,BLACK_YY,
								PREFIX_RED_CASE,RED_CASE,RED_YY,
								PLAINTIFF1,DEFFENDANT1,PCC_CASE_GEN,WH_CIVIL_ID 
						FROM 	WH_CIVIL_CASE
						WHERE 	CIVIL_CODE = '" . $pccCivilGen . "'";
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
							WHERE 	CIVIL_CODE = '" . $pccCivilGen . "'";
        $querySelectData = db::query($sqlSelectData);
        $dataSelectData = db::fetch_array($querySelectData);
    }
    $num1 = db::num_rows($querySelectData);
    if ($num1 > 0) {
        $sql_WH_PERSON = "SELECT a.REGISTER_CODE ,a.FULL_NAME ,a.COURT_CODE ,a.COURT_NAME ,a.PREFIX_BLACK_CASE ,a.BLACK_CASE ,a.BLACK_YY 
        ,a.PREFIX_RED_CASE ,a.RED_CASE ,a.RED_YY ,a.CONCERN_CODE ,a.COURT_NAME 
        FROM ".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')." a 
        JOIN WH_CIVIL_CASE b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
        WHERE 	b.CIVIL_CODE = '" . $pccCivilGen . "'";
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
    }
}
$token = 1;
if ($token == 1) {
    $link = '';
    $obj = array();
    $sql_check_case = "SELECT *FROM M_CHECK_CASE a WHERE a.PAGE_CODE='" . $pageCode . "' ";
    $query_check_case = db::query($sql_check_case);
    $filter1 = "";
    while ($rec_check_case = db::fetch_array($query_check_case)) {
        if ($systemCode == 1) {
            if ($rec_check_case['URL_CODE'] == "http://103.208.27.224:81/led_service_api/public/search_data_WH.php") {
                $array_check = explode(",", $rec_check_case['NOTE']); //แปลงข้อมูล เป็นarray เพื่อเช็คค่า
                if (in_array("REGISTERCODE", $array_check)) {
                    if ($REGISTERCODE != '') { //รหัสบัตรประชาชน
                        $link .= "&REGISTERCODE=" . $REGISTERCODE;
                        $filter1 .= " and TB.REGISTER_CODE in (" . result_array($REGISTERCODE)  . ") ";
                    }
                }
                if (in_array("CONCERN_CODE", $array_check)) {
                    if ($CONCERN_CODE != '') { //สถานะคน โจทย์ จำเลย
                        $link .= "&CONCERN_CODE=" . $CONCERN_CODE;
                        $filter1 .= " AND TB.CONCERN_NAME in (" . result_array($CONCERN_CODE) . ")  ";
                    }
                }
                if (in_array("BLACK_CASE", $array_check)) {
                    $link .= "&T_BLACK_CASE=" . $dataSelectData['PREFIX_BLACK_CASE'] . "&BLACK_CASE=" . $dataSelectData['BLACK_CASE'] . "&BLACK_YY=" . $dataSelectData['BLACK_YY'];
                    $filter1 .= " AND TB.PREFIX_BLACK_CASE  like '%" . $dataSelectData['PREFIX_BLACK_CASE'] . "%' ";
                    $filter1 .= " AND TB.BLACK_CASE  like '%" . $dataSelectData['BLACK_CASE'] . "%' ";
                    $filter1 .= " AND TB.BLACK_YY  like '%" . $dataSelectData['BLACK_YY'] . "%' ";
                }
                if (in_array("RED_CASE", $array_check)) {
                    $link .= "&T_RED_CASE=" . $dataSelectData['PREFIX_RED_CASE'] . "&RED_CASE=" . $dataSelectData['RED_CASE'] . "&RED_YY=" . $dataSelectData['RED_YY'];
                    $filter1 .= " AND TB.PREFIX_RED_CASE  like '%" . $POST['PREFIX_RED_CASE'] . "%' ";
                    $filter1 .= " AND TB.RED_CASE  like '%" . $POST['RED_CASE'] . "%' ";
                    $filter1 .= " AND TB.RED_YY  like '%" . $POST['RED_YY'] . "%' ";
                }
                if (in_array("COURT_CODE", $array_check)) {
                    $link .= "&COURT_CODE=" . $dataSelectData['COURT_CODE'] . "&COURT_NAME=" . $dataSelectData['COURT_NAME'];
                    $filter1 .= " AND TB.COURT_NAME = '" . $dataSelectData['COURT_NAME'] . "' ";
                }
                /* sql start */
                if ($filter1 != "") {
                    $sqlSelectDataALL_e =        "
            SELECT 
            TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
            TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
            TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
            TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
            TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
            TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
            TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.CONERNSEQ
            FROM VIEW_WH_ALL_CASE_PERSON TB 
            WHERE 1=1 {$filter1}
            GROUP BY TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
            TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
            TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
            TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
            TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
            TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
            TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.CONERNSEQ
            ORDER BY 
            CASE
                WHEN TB.CONCERN_NAME = 'โจทก์' AND TB.CONERNSEQ IS NOT NULL THEN 1
                WHEN TB.CONCERN_NAME = 'โจทก์' AND TB.CONERNSEQ IS NULL THEN 2
                WHEN TB.CONCERN_NAME = 'จำเลย' AND TB.CONERNSEQ IS NOT NULL THEN 3
                WHEN TB.CONCERN_NAME = 'จำเลย' AND TB.CONERNSEQ IS NULL THEN 4
                ELSE 5
            END,TB.CONERNSEQ ASC ,TB.SYSTEM_TYPE ASC
            ";
                    $sql_count_system = "SELECT TBB1.SYSTEM_TYPE,COUNT(TBB1.SYSTEM_TYPE) AS total_record  
                                         FROM (" . $sqlSelectDataALL_e . ") TBB1
                                     GROUP BY TBB1.SYSTEM_TYPE";
                }

                $query_count_system = db::query($sql_count_system);
                while ($rec_count_system = db::fetch_array($query_count_system)) {
                    if ($rec_count_system['SYSTEM_TYPE'] == 'Bankrupt') {
                        $total_Bankrupt =  $rec_count_system['TOTAL_RECORD'];
                    }
                    if ($rec_count_system['SYSTEM_TYPE'] == 'Civil') {
                        $total_Civil =  $rec_count_system['TOTAL_RECORD'];
                    }
                    if ($rec_count_system['SYSTEM_TYPE'] == 'Mediate') {
                        $total_Mediate =  $rec_count_system['TOTAL_RECORD'];
                    }
                    if ($rec_count_system['SYSTEM_TYPE'] == 'Revive') {
                        $total_Revive =  $rec_count_system['TOTAL_RECORD'];
                    }
                }
                $total = $total_Bankrupt + $total_Civil + $total_Mediate + $total_Revive;
                /* stop */
            }
            $obj[] = $rec_check_case['URL_CODE'] . "?CODE=" . base64_encode($link);
        }
    }

    $pccCivilGen=$POST["pccCivilGen"];
}

$num = count($obj);

if ($num > 0) {

    $row['ResponseCode'] = array('ResCode' => '000', 'ResMeassage' => "SUCCESS");
    $row['link'] = $obj;
    $row['number_of_items'] = $total;
    $row['status'] = "YES";
    $row['variable'] = $array_check;
} else {

    $row['ResponseCode'] = array('ResCode' => '102', 'ResMeassage' => "NOT FOUND");
    $row['status'] = "NO";
   /*  $row['variable'] = "PAGE_CODE"; */
}

echo json_encode($row);
