<?php

class check
{
    public static function check_person_test($data_Assets)
    { //ส่งคนเข้ามาเช็ค จำนวนคนที่ตรวจเจอที่อื่น
        $array_raw = [];
        $array_raw = main_case::checkPeopleAll($data_Assets);
        $num_A = 0;
        foreach ($array_raw as $SH1 => $AA1) {
            foreach ($AA1 as $SH2 => $AA2) {
                $num_A++;
            }
        }
        return $num_A;
    }
}

function ex_p($data) //แปลงข้อมูลที่เป็นtext GET ยาวๆมาใส่ค่า GET ตย.&brcID=5442&PAGE_CODE=BR010102&TO_PERSON_ID=1489900129401&SEND_TO=2&DATA_SEARCH=ALL แปลงเป็นGET
{
    $decodedCode = str_replace('&', '##', $data);
    $segments = explode("##", trim($decodedCode, "##"));
    $data = [];
    foreach ($segments as $segment) {
        list($key, $value) = explode("=", $segment, 2);
        $data[$key] = $value;
        $_GET[$key] = $value;
    }
    return  $_GET;
}

//เป็นfunction แปลงค่าtext ที่ดำ25 ตำบล55 เเขวง88 แปลงเอาเเต่ตัขเลขไปlike
function LikeArray($A, $fill_NAME) //$Aคือtext ที่ดำ25 ตำบล55 เเขวง88  $fill_NAME คือตัวที่เอาไปwhere
{
    $detail = $A;
    $str_array = "";
    $pattern = '/\d+/';
    if (preg_match_all($pattern, $detail, $matches)) {
        $numbers = $matches[0]; // 13, 55, 55, 22
        foreach ($numbers as $number) {
            $str_array .= " AND " . $fill_NAME . "  like '%" . $number . "%' ";
        }
    }
    return $str_array;
}
function system_($A = "")
{
    if ($A == 'BANKRUPT' || $A == 'Bankrupt') {
        $B = '2';
    }
    if ($A == 'CIVIL' || $A == 'Civil') {
        $B = '1';
    }
    if ($A == 'MEDIATE' || $A == 'Mediate') {
        $B = '4';
    }
    if ($A == 'REVIVE' || $A == 'Revive') {
        $B = '3';
    }
    return $B;
}
function ConvertSystem_text($A = "")
{
    if ($A == '2') {
        $B = 'BANKRUPT';
    }
    if ($A == '1') {
        $B = 'CIVIL';
    }
    if ($A == '4') {
        $B = 'MEDIATE';
    }
    if ($A == '3') {
        $B = 'REVIVE';
    }
    return $B;
}
function ConvertSystemToThai($A = "")
{
    if ($A == 'BANKRUPT' || $A == '2') {
        $B = 'ล้มละลาย';
    }
    if ($A == 'CIVIL' || $A == '1') {
        $B = 'แพ่ง';
    }
    if ($A == 'MEDIATE' || $A == '4') {
        $B = 'ไกล่เกลี่ย';
    }
    if ($A == 'REVIVE' || $A == '3') {
        $B = 'ฟื้นฟูกิจการ';
    }
    return $B;
}


function AssetsForCase_check($data_Assets)
{
    ex_p($data_Assets);
    $total_num = 0;
    $array_data_Assets = [];
    $arr_system = array("BANKRUPT" => "คดีล้มละลาย", "CIVIL" => "คดีแพ่ง", "MEDIATE" => "คดีไกล่เกลี่ย", "REVIVE" => "คดีฟื้นฟู");

    $array_Pcc = [];
    if ($_GET['SEND_TO'] == '1') { //ระบบเเพ่ง
        $sqlSelectData = "	SELECT a.PREFIX_BLACK_CASE ,a.BLACK_CASE ,a.BLACK_YY ,
                                    a.PREFIX_RED_CASE ,a.RED_CASE ,a.RED_YY,
                                    b.WH_ASSET_ID ,b.ASSET_ID ,b.PROP_TITLE 
        FROM WH_CIVIL_CASE a
        JOIN WH_CIVIL_CASE_ASSETS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
        WHERE  a.CIVIL_CODE = '" . $_GET['PCC_CIVIL_GEN'] . "'";
    }
    $query_PCC = db::query($sqlSelectData);
    while ($rec_pcc = db::fetch_array($query_PCC)) {
        $array_Pcc[] = $rec_pcc;
    }
    $k = 0;
    $array_sql = [];

    foreach ($arr_system as $sys => $sys_name) {
        $k++;
        $num_Pcc_Arr = 0;
        foreach ($array_Pcc as $Apcc => $Bpcc) {
            //echo $Bpcc['PROP_TITLE'] . "<br>";
            $sqlSelectDataALL_e = "";
            $num_Pcc_Arr++;
            if (LikeArray($Bpcc['PROP_TITLE'], 'a.BANKRUPT_DETAIL') != "") {
                if ($_GET['PCC_CIVIL_GEN'] != "") {
                    $CIVIL_GEN = "AND a.CODE_API !='" . $_GET['PCC_CIVIL_GEN'] . "'";
                }
                $sqlSelectDataALL_e = "SELECT  a.WH_ASSET_ID ,
													a.ASSET_ID as ASSET_CODE,
													a.TABLE_DETAIL as PROP_TITLE,
													a.PREFIX_BLACK_CASE ,
													a.BLACK_CASE ,
													a.BLACK_YY ,
													a.PREFIX_RED_CASE 
													,a.RED_CASE ,
													a.RED_YY ,
													a.TYPE_ASSET ,
													a.COURT_CODE,
													a.PROP_STATUS_NAME,
													a.CODE_API FROM WH_ALL_ASSETS_MAIN a
													WHERE 1=1 
													AND a.TYPE_ASSET ='" . $sys . "' 
													{$CIVIL_GEN}
													" . LikeArray($Bpcc['PROP_TITLE'], 'TABLE_DETAIL') .
                    func::conWhere($Bpcc['PROP_TITLE']) . "";
            }
            $array_sql[$sys][$num_Pcc_Arr] = $sqlSelectDataALL_e;
            $query_SelectDataALL_e = db::query($array_sql[$sys][$num_Pcc_Arr]);
            $array_num = 0;
            while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e)) {
                $total_num++;
                $array_data_Assets[$sys][$num_Pcc_Arr][$array_num]['ASSET_ID'] = $recSelectDataAll['ASSET_ID'];
                $array_data_Assets[$sys][$num_Pcc_Arr][$array_num]['PROP_TITLE'] = $recSelectDataAll['PROP_TITLE'];
                $array_data_Assets[$sys][$num_Pcc_Arr][$array_num]['PROP_STATUS_NAME'] = $recSelectDataAll['PROP_STATUS_NAME'];
                $array_data_Assets[$sys][$num_Pcc_Arr][$array_num]['PROP_STATUS'] = $recSelectDataAll['PROP_STATUS'];
                $array_data_Assets[$sys][$num_Pcc_Arr][$array_num]['PREFIX_BLACK_CASE'] = $recSelectDataAll['PREFIX_BLACK_CASE'];
                $array_data_Assets[$sys][$num_Pcc_Arr][$array_num]['BLACK_CASE'] = $recSelectDataAll['BLACK_CASE'];
                $array_data_Assets[$sys][$num_Pcc_Arr][$array_num]['BLACK_YY'] = $recSelectDataAll['BLACK_YY'];
                $array_data_Assets[$sys][$num_Pcc_Arr][$array_num]['PREFIX_RED_CASE'] = $recSelectDataAll['PREFIX_RED_CASE'];
                $array_data_Assets[$sys][$num_Pcc_Arr][$array_num]['RED_CASE'] = $recSelectDataAll['RED_CASE'];
                $array_data_Assets[$sys][$num_Pcc_Arr][$array_num]['RED_YY'] = $recSelectDataAll['RED_YY'];
                $array_num++;
            }
        }
    }
    if ($total_num == "" || $total_num = 0) {
        $total_num = 0;
    }
    return $total_num;
}


function DOSS_OWER($SYSTEM, $CODE_API, $paramiter) //IDของเจ้าของคดี function ไว้เอาID ของเจ้าของคดี
{
    $rec_show = '0';
    if ($SYSTEM == 'BANKRUPT' || $SYSTEM == 'Bankrupt' || $SYSTEM == '2') {
        $B = '2';
        $sql = "SELECT a.DOSS_OWNER_ID ,a.DOSS_OWNER_NAME ,a.BANKRUPT_CODE AS CODE_API ,a.WH_BANKRUPT_ID AS WH_ID 
                FROM WH_BANKRUPT_CASE_DETAIL a
                WHERE a.BANKRUPT_CODE = '" . $CODE_API . "' ";
        $query = db::query($sql);
        $rec = db::fetch_array($query);
        return $rec[$paramiter];
    }
    if ($SYSTEM == 'CIVIL' || $SYSTEM == 'Civil' || $SYSTEM == '1') {
        $B = '1';
        $sql = "SELECT *FROM WH_CIVIL_CASE a 
        JOIN WH_CIVIL_DOSS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
        WHERE a.CIVIL_CODE ='" . $CODE_API . "'";
        $query = db::query($sql);
        $rec = db::fetch_array($query);
        return $sql;
        // return $rec[$paramiter];
    }
    if ($SYSTEM == 'MEDIATE' || $SYSTEM == 'Mediate' || $SYSTEM == '4') {
        $B = '4';
    }
    if ($SYSTEM == 'REVIVE' || $SYSTEM == 'Revive' || $SYSTEM == '3') {
        $B = '3';
    }
}

function numberOfNotifications($SYSTEM_TYPE = "", $DOSS = "") //function กลาง
{ // SYSTEM_TYPE คือ ระบบอะไร CIVIL=เเพ่ง BANKRUPT=ล้มละลาย MEDIATE=ไกล่เกลี่ย REVIVE=ฟื้นฟู DOSS คือ 13หลักของเจ้าขอคดี
    $Fill = "";
    $Fill .= "AND a.SYSTEM_TYPE_RECEIVE ='" . $SYSTEM_TYPE . "'";
    $Fill .= "AND a.DOSS_OWNER_ID ='" . $DOSS . "'";
    $sqlNoti = "SELECT *FROM M_ALERT_NOTIFICATION a WHERE 1=1 {$Fill}";
    $queryNoti = db::query($sqlNoti);
    $numNoti = db::num_rows($queryNoti);
    return $numNoti;
}

function checkPeople($data) //ตรวจคนไม่เอาคดีตัวเองข้อมูลจะreturnกับมาเป็นชุดarray
{
    ex_p($data);
    $result_PRE_CODE = "";
    $result_case = "";
    $k = 0;
    $array_raw = [];
    $filter_SYSTEM_TYPE = "";
    $arr_system = array("Civil" => "คดีแพ่ง", "Bankrupt" => "คดีล้มละลาย", "Revive" => "คดีฟื้นฟู",  "Mediate" => "คดีไกล่เกลี่ย");
    foreach ($arr_system as $sys => $sys_name) {
        $k++;
        $filter1 = "";
        /* start ไม่เอาคดีตัวเอง */
        if ($_GET['PCC_CIVIL_GEN'] != "" && $_GET['SEND_TO'] == "1" && $sys == 'Civil') { //เเพ่ง
            $sqlSelectData = "	SELECT 	b.WH_CIVIL_ID
                                FROM 	WH_CIVIL_CASE a
                                JOIN " . Convert::ConvertTable('WH_CIVIL_CASE_PERSON') . "  b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
                                WHERE 	CIVIL_CODE = '" . $_GET['PCC_CIVIL_GEN']  . "'";
            $querySelectData = db::query($sqlSelectData);
            $rec_PCC = db::fetch_array($querySelectData);
            $filter1 .= "AND TB.WH_ID !='" . $rec_PCC['WH_CIVIL_ID'] . "' ";
        }
        if ($_GET['brcID'] != "" && $_GET['SEND_TO'] == '2' && $sys == 'Bankrupt') { //ไม่เอาคดีตัวเองในล้มละลาย
            $sqlSelectData = "	SELECT a.WH_BANKRUPT_ID  FROM WH_BANKRUPT_CASE_DETAIL a 
                                WHERE a.BANKRUPT_CODE  = '" . $_GET['brcID']  . "'";
            $querySelectData = db::query($sqlSelectData);
            $rec_PCC = db::fetch_array($querySelectData);
            $filter1 .= "AND (TB.WH_ID !='" . $rec_PCC['WH_BANKRUPT_ID'] . "') ";
        }
        if ($_GET['WFR_API'] != "" && $_GET['SEND_TO'] == '3'  && $sys == 'Revive') { //ไม่เอาคดีตัวเองในฟื้นฟู
            $sqlSelectData = "	SELECT a.WH_REHAB_ID FROM WH_REHABILITATION_CASE_DETAIL a  where a.REHAB_CODE='" . $_GET['WFR_API'] . "' ";
            $querySelectData = db::query($sqlSelectData);
            $rec_PCC = db::fetch_array($querySelectData);
            $filter1 .= "AND (TB.WH_ID !='" . $rec_PCC['WH_REHAB_ID'] . "') ";
        }
        if ($_GET['WFR_API'] != "" && $_GET['SEND_TO'] == '4'  && $sys == 'Mediate') { //ไม่เอาคดีตัวเองในไกล่เกลี่ย
            $sqlSelectData = "	SELECT a.WH_MEDAITE_ID FROM WH_MEDIATE_CASE a 
                                WHERE a.REF_WFR_ID = '" .  $_GET['WFR_API']  . "'";
            $querySelectData = db::query($sqlSelectData);
            $rec_PCC = db::fetch_array($querySelectData);
            $filter1 .= "AND (TB.WH_ID !='" . $rec_PCC['WH_MEDAITE_ID'] . "') ";
        }
        /* stop ไม่เอาคดีตัวเอง */


        $order = "   ORDER BY TB.SYSTEM_TYPE ASC,
        CASE
             WHEN TB.CONCERN_NAME = 'โจทก์' AND TO_NUMBER(TB.CONCERN_NO) IS NOT NULL THEN 1
             WHEN TB.CONCERN_NAME = 'โจทก์' AND TO_NUMBER(TB.CONCERN_NO) IS NULL THEN 2
             WHEN TB.CONCERN_NAME = 'จำเลย' AND TO_NUMBER(TB.CONCERN_NO) IS NOT NULL THEN 3
             WHEN TB.CONCERN_NAME = 'จำเลย' AND TO_NUMBER(TB.CONCERN_NO) IS NULL THEN 4
            ELSE 5
        END,TO_NUMBER(TB.CONCERN_NO) ASC";
        if ($_GET['DATA_SEARCH'] == 'ALL') {

            if ($_GET['REGISTERCODE'] != "") {
                $filter1 .= " and TB.REGISTER_CODE in (" . result_array($_GET['REGISTERCODE'])  . ") ";
            } else {
                return false;
            }

            if ($_GET['COURT_NAME'] != "") {
                $filter1 .= " AND TB.COURT_NAME = '" . $_GET['COURT_NAME'] . "' ";
            }

            if ($_GET['T_BLACK_CASE'] != "" && $_GET['BLACK_CASE'] != "" && $_GET['BLACK_YY'] != "") {

                $filter1 .= " AND TB.PREFIX_BLACK_CASE  like '%" . $_GET['T_BLACK_CASE'] . "%' ";
                $filter1 .= " AND TB.BLACK_CASE  like '%" . $_GET['BLACK_CASE'] . "%' ";
                $filter1 .= " AND TB.BLACK_YY  like '%" . $_GET['BLACK_YY'] . "%' ";
            }

            if ($_GET['T_RED_CASE'] != "" && $_GET['RED_CASE'] != "" && $_GET['RED_YY'] != "") {

                $filter1 .= " AND TB.PREFIX_RED_CASE  like '%" . $_GET['T_RED_CASE'] . "%' ";
                $filter1 .= " AND TB.RED_CASE  like '%" . $_GET['RED_CASE'] . "%' ";
                $filter1 .= " AND TB.RED_YY  like '%" . $_GET['RED_YY'] . "%' ";
            }

            if ($_GET['PRE_CODE'] != "") {
                $text_N = 1;
                foreach ($_GET['PRE_CODE'] as $A1) {
                    $result_PRE_CODE .= "'" . $A1 . "'" . (count($_GET['PRE_CODE']) == $text_N ? "" : ",");
                    $text_N++;
                }
                $filter1 .= " AND TB.CONCERN_NAME in (" . $result_PRE_CODE . ")  ";
            }
            if ($_GET['CONCERNED'] != "") {
                $filter1 .= " AND TB.CONCERN_NAME in (" . result_array($_GET['CONCERNED']) . ")  ";
            }
            if ($_GET['case'] != "") {
                $text_N = 1;
                foreach ($_GET['case'] as $A1) {
                    $result_case .= "'" . $A1 . "'" . (count($_GET['case']) == $text_N ? "" : ",");
                    $text_N++;
                }
                $filter1 .= " AND TB.SYSTEM_TYPE in (" . $result_case . ") ";
            }
            if ($filter1 != "") {
                $sqlSelectDataALL_e =        "
                                    SELECT 
                                    TB.PK_ID ,TB.WH_ID,
                                    TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
                                    TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
                                    TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
                                    TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
                                    TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
                                    TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
                                    TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME 
                                    FROM VIEW_WH_ALL_CASE_PERSON TB 
                                    WHERE TB.SYSTEM_TYPE = '" . $sys . "' {$filter1}
                                    GROUP BY TB.PK_ID ,TB.WH_ID,TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
                                    TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
                                    TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
                                    TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
                                    TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
                                    TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
                                    TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME
                                     {$order}
                                    ";
                //echo "<br><br>".$sqlSelectDataALL_e ;
                $query_SelectDataALL_e[$k] = db::query($sqlSelectDataALL_e);
                while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
                    $array_raw[$k][] = $recSelectDataAll;
                }
            }
        } else if ($_GET['DATA_SEARCH'] == 'COUPLE' || $_GET['DATA_SEARCH'] == 'CROSS') {
            if ($_GET['DATA_SEARCH'] == 'COUPLE') { //คู่ เลือกรายการที่REGISTERCODE_1 เป็นโจทย์ และREGISTERCODE_2 เป็นจำเลย
                $check = '1';
                if ($_GET['case'] != "") {
                    $filter_SYSTEM_TYPE .= " AND TB3.SYSTEM_TYPE in (" . sort_array($_GET['case']) . ") ";
                }
                if ($_GET['REGISTERCODE_C1'] != "") {

                    $filter_1 = "  AND TB2.REGISTER_CODE in (" . str_replace('-', '', result_array($_GET['REGISTERCODE_C1'])) . ")
                                        AND TB2.CONCERN_NAME in ('โจทก์','เจ้าหนี้')";
                }
                if ($_GET['REGISTERCODE_C2'] != "") {
                    $filter_2 = "AND TB2.REGISTER_CODE in (" . str_replace('-', '', result_array($_GET['REGISTERCODE_C2'])) . ")
                                       AND TB2.CONCERN_NAME in ('จำเลย','ลูกหนี้')";
                }
            }
            if ($_GET['DATA_SEARCH'] == 'CROSS') { //ไขว้
                $check = '2';
                if ($_GET['case'] != "") {
                    $filter_SYSTEM_TYPE .= " AND TB3.SYSTEM_TYPE in (" . sort_array($_GET['case']) . ") ";
                }
                if ($_GET['REGISTERCODE_C1'] != "") {

                    $filter_1 = " AND TB2.REGISTER_CODE in (" . str_replace('-', '', result_array($_GET['REGISTERCODE_C1'])) . ")";
                }
                if ($_GET['REGISTERCODE_C2'] != "") {
                    $filter_2 = "AND TB2.REGISTER_CODE in (" . str_replace('-', '', result_array($_GET['REGISTERCODE_C2'])) . ")";
                }
            }
            if ($check > 0) {
                $sql_ALL = "SELECT 
                TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
                TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
                TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
                TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
                TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
                TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
                TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.WH_ID
                FROM VIEW_WH_ALL_CASE_PERSON TB 
                WHERE 1=1 
                 AND EXISTS (	
                 SELECT *FROM VIEW_WH_ALL_CASE_PERSON TB2
                 WHERE 1=1 
                 AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE 
                 AND TB2.BLACK_CASE=TB.BLACK_CASE 
                 AND TB2.BLACK_YY=TB.BLACK_YY 
                 AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
                 AND TB2.RED_CASE = TB.RED_CASE 
                 AND TB2.RED_YY = TB.RED_YY 
                {$filter_1})
                 AND EXISTS (
                 SELECT *FROM VIEW_WH_ALL_CASE_PERSON TB2
                 WHERE 1=1
                 AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE
                 AND TB2.BLACK_CASE=TB.BLACK_CASE
                 AND TB2.BLACK_YY=TB.BLACK_YY 
                 AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
                 AND TB2.RED_CASE = TB.RED_CASE 
                 AND TB2.RED_YY = TB.RED_YY 
                 {$filter_2})
            AND TB.REGISTER_CODE in(" . result_array($_GET['REGISTERCODE_C1']) . "," . result_array($_GET['REGISTERCODE_C2']) . ")
            {$filter_SYSTEM_TYPE}
            {$filter1}
            AND TB.SYSTEM_TYPE = '" . $sys . "'
            GROUP BY TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
            TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
            TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
            TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
            TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
            TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
            TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.WH_ID
            {$order}
             ";
                //echo $sql_ALL . "<br><br>";
            }
            $query_SelectDataALL_e[$k] = db::query($sql_ALL);
            while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
                $array_raw[$k][] = $recSelectDataAll;
            }
        } else if ($_GET['DATA_SEARCH'] == 'CROSS_AND_ALL') { //การตรวจไขว์เเละทั้งหมดคือ เอาโจทย์เเละจำเลยไปตรวจ คู่กันเป็นอะไรก็ได้ในคดีอื่น จากนั้นนำโจทย์้้ละจำเลยไปตรวจ ที่สถาอื่นนอกจากสถานะตัวเอง
            if ($_GET['DATA_SEARCH'] == 'CROSS_AND_ALL') { //ไขว้
                $check = '2';
                if ($_GET['REGISTERCODE_C1'] != "") {
                    $filter_1 = " AND TB2.REGISTER_CODE in (" . str_replace('-', '', result_array($_GET['REGISTERCODE_C1'])) . ")";
                }
                if ($_GET['REGISTERCODE_C2'] != "") {
                    $filter_2 = "AND TB2.REGISTER_CODE in (" . str_replace('-', '', result_array($_GET['REGISTERCODE_C2'])) . ")";
                }
            }
            if ($check > 0) {
                $sql_ALL = "";
                $sql_ALL = "SELECT 
                TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
                TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
                TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
                TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
                TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
                TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
                TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.WH_ID
                FROM VIEW_WH_ALL_CASE_PERSON TB 
                WHERE 1=1 
                 AND EXISTS (	
                 SELECT *FROM VIEW_WH_ALL_CASE_PERSON TB2
                 WHERE 1=1 
                 AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE 
                 AND TB2.BLACK_CASE=TB.BLACK_CASE 
                 AND TB2.BLACK_YY=TB.BLACK_YY 
                 AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
                 AND TB2.RED_CASE = TB.RED_CASE 
                 AND TB2.RED_YY = TB.RED_YY 
                {$filter_1})
                 AND EXISTS (
                 SELECT *FROM VIEW_WH_ALL_CASE_PERSON TB2
                 WHERE 1=1
                 AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE
                 AND TB2.BLACK_CASE=TB.BLACK_CASE
                 AND TB2.BLACK_YY=TB.BLACK_YY 
                 AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
                 AND TB2.RED_CASE = TB.RED_CASE 
                 AND TB2.RED_YY = TB.RED_YY 
                 {$filter_2})
            AND TB.REGISTER_CODE in(" . result_array($_GET['REGISTERCODE_C1']) . "," . result_array($_GET['REGISTERCODE_C2']) . ")
            {$filter1}
            AND TB.SYSTEM_TYPE = '" . $sys . "'
            GROUP BY TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
            TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
            TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
            TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
            TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
            TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
            TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.WH_ID
            {$order}
             ";
                //echo $sql_ALL . "<br><br>";
            }
            $query_SelectDataALL_e[$k] = db::query($sql_ALL);
            while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
                $array_raw[$k][] = $recSelectDataAll;
            }
            /* start ตรวจโจทย์ในสถานะอื่น */
            $sql_ALL = "";
            $sql_ALL = "SELECT 
                TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
                TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
                TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
                TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
                TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
                TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
                TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.WH_ID
                FROM VIEW_WH_ALL_CASE_PERSON TB 
                WHERE 1=1 	
            AND TB.REGISTER_CODE in(" . result_array($_GET['REGISTERCODE_C1']) . ")
            AND TB.CONCERN_NAME !='โจทก์'
            {$filter1}
            AND TB.SYSTEM_TYPE = '" . $sys . "'
            GROUP BY TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
            TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
            TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
            TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
            TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
            TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
            TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.WH_ID
            {$order}
             ";
            $query_SelectDataALL_e[$k] = db::query($sql_ALL);
            while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
                $array_raw[$k][] = $recSelectDataAll;
            }
            /* stop ตรวจโจทย์ในสถานะอื่น */

            /* start ตรวจจำเลยในสถานะอื่น */
            $sql_ALL = "";
            $sql_ALL = "SELECT 
                TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
                TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
                TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
                TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
                TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
                TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
                TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.WH_ID
                FROM VIEW_WH_ALL_CASE_PERSON TB 
                WHERE 1=1 	
            AND TB.REGISTER_CODE in(" . result_array($_GET['REGISTERCODE_C2']) . ")
            AND TB.CONCERN_NAME !='จำเลย'
            {$filter1}
            AND TB.SYSTEM_TYPE = '" . $sys . "'
            GROUP BY TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
            TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
            TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
            TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
            TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
            TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
            TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.WH_ID
            {$order}
             ";
            $query_SelectDataALL_e[$k] = db::query($sql_ALL);
            while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
                $array_raw[$k][] = $recSelectDataAll;
            }
            /* stop ตรวจจำเลยในสถานะอื่น */
        } else if ($_GET['DATA_SEARCH'] == 'COUPLE_AND_ALL') { //การตรวจคู่เเละทั้งหมดคือ เอาโจทย์เเละจำเลยไปตรวจ คู่กันเป็นอะไรก็ได้ในคดีอื่น จากนั้นนำโจทย์้้ละจำเลยไปตรวจ ที่สถาอื่นนอกจากสถานะตัวเอง

            if ($_GET['DATA_SEARCH'] == 'COUPLE_AND_ALL') { //คู่ เลือกรายการที่REGISTERCODE_1 เป็นโจทย์ และREGISTERCODE_2 เป็นจำเลย
                $check = '1';
                if ($_GET['REGISTERCODE_C1'] != "") {

                    $filter_1 = "  AND TB2.REGISTER_CODE in (" . str_replace('-', '', result_array($_GET['REGISTERCODE_C1'])) . ")
                                        AND TB2.CONCERN_NAME in ('โจทก์','เจ้าหนี้')";
                }
                if ($_GET['REGISTERCODE_C2'] != "") {
                    $filter_2 = "AND TB2.REGISTER_CODE in (" . str_replace('-', '', result_array($_GET['REGISTERCODE_C2'])) . ")
                                       AND TB2.CONCERN_NAME in ('จำเลย','ลูกหนี้')";
                }
            }
            if ($check > 0) {
                $sql_ALL = "";
                $sql_ALL = "SELECT 
                TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
                TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
                TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
                TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
                TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
                TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
                TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.WH_ID
                FROM VIEW_WH_ALL_CASE_PERSON TB 
                WHERE 1=1 
                 AND EXISTS (	
                 SELECT *FROM VIEW_WH_ALL_CASE_PERSON TB2
                 WHERE 1=1 
                 AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE 
                 AND TB2.BLACK_CASE=TB.BLACK_CASE 
                 AND TB2.BLACK_YY=TB.BLACK_YY 
                 AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
                 AND TB2.RED_CASE = TB.RED_CASE 
                 AND TB2.RED_YY = TB.RED_YY 
                {$filter_1})
                 AND EXISTS (
                 SELECT *FROM VIEW_WH_ALL_CASE_PERSON TB2
                 WHERE 1=1
                 AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE
                 AND TB2.BLACK_CASE=TB.BLACK_CASE
                 AND TB2.BLACK_YY=TB.BLACK_YY 
                 AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
                 AND TB2.RED_CASE = TB.RED_CASE 
                 AND TB2.RED_YY = TB.RED_YY 
                 {$filter_2})
            AND TB.REGISTER_CODE in(" . result_array($_GET['REGISTERCODE_C1']) . "," . result_array($_GET['REGISTERCODE_C2']) . ")
            {$filter1}
            AND TB.SYSTEM_TYPE = '" . $sys . "'
            GROUP BY TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
            TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
            TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
            TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
            TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
            TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
            TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.WH_ID
            {$order}
             ";
                //echo $sql_ALL . "<br><br>";
            }
            $query_SelectDataALL_e[$k] = db::query($sql_ALL);
            while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
                $array_raw[$k][] = $recSelectDataAll;
            }
            /* start ตรวจโจทย์ในสถานะอื่น */
            $sql_ALL = "";
            $sql_ALL = "SELECT 
                TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
                TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
                TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
                TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
                TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
                TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
                TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.WH_ID
                FROM VIEW_WH_ALL_CASE_PERSON TB 
                WHERE 1=1 	
            AND TB.REGISTER_CODE in(" . result_array($_GET['REGISTERCODE_C1']) . ")
            AND TB.CONCERN_NAME !='โจทก์'
            {$filter1}
            AND TB.SYSTEM_TYPE = '" . $sys . "'
            GROUP BY TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
            TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
            TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
            TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
            TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
            TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
            TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.WH_ID
            {$order}
             ";
            $query_SelectDataALL_e[$k] = db::query($sql_ALL);
            while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
                $array_raw[$k][] = $recSelectDataAll;
            }
            /* stop ตรวจโจทย์ในสถานะอื่น */

            /* start ตรวจจำเลยในสถานะอื่น */
            $sql_ALL = "";
            $sql_ALL = "SELECT 
                TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
                TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
                TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
                TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
                TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
                TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
                TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.WH_ID
                FROM VIEW_WH_ALL_CASE_PERSON TB 
                WHERE 1=1 	
            AND TB.REGISTER_CODE in(" . result_array($_GET['REGISTERCODE_C2']) . ")
            AND TB.CONCERN_NAME !='จำเลย'
            {$filter1}
            AND TB.SYSTEM_TYPE = '" . $sys . "'
            GROUP BY TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
            TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
            TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
            TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
            TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
            TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
            TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.WH_ID
            {$order}
             ";
            $query_SelectDataALL_e[$k] = db::query($sql_ALL);
            while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
                $array_raw[$k][] = $recSelectDataAll;
            }
            /* stop ตรวจจำเลยในสถานะอื่น */
        }
    }
    return $array_raw;
}


function check_person_3($data)
{ //ส่งคนเข้ามาเช็ค จำนวนคนที่ตรวจเจอที่อื่น
    $array_raw = [];
    $array_raw = main_case::checkPeopleAll($data);
    $num_A = 0;
    foreach ($array_raw as $SH1 => $AA1) {
        foreach ($AA1 as $SH2 => $AA2) {
            $num_A++;
        }
    }
    return $num_A;
}

function addPerson($SYSTEM_TYPE = "", $data, $CODE_API, $toPersonId)
//เมื่อมีการส่งคนต้นทางไปตรวจเเละเจอที่ระบบอื่นจะทำการเเจ้งเตือนไประบบปลายทางว่ามีคนตรวจคนซ้ำ
//SYSTEM_TYPEระบบต้นทางที่ส่ง ,data_Assets ข้อมูลที่ส่งเข้ามาตรวจ ,CODE_API ค่าที่ดึงapi เช่น PCC_CIVIL WFR
{
    $array_raw = main_case::checkPeopleAll($data);
    //เรียกใช้เมื่อมีคนในbackoffice ซ้ำจะทำการเเจ้งเตือน
    backoffice::check_person_backoffice($CODE_API, $SYSTEM_TYPE, $toPersonId);
    foreach ($array_raw as $SH1 => $AA1) {
        foreach ($AA1 as $SH2 => $AA2) {
            ///ฝั่งรับ รับได้หลายระบบ ล้มละลาย ฟื้นฟู ไกล่เกลี่ย หรือส่งเข้าระบบตัวเอง เเพ่ง
            //DOSS เจ้าของคดีมีเเค่เเพ่งกับล้มละลาย
            if ($SYSTEM_TYPE == 1) { //เเพ่ง
                $sqlF = "SELECT a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,  
                                CASE WHEN a.COURT_CODE='010030' THEN '050' ELSE a.COURT_CODE END AS COURT_CODE  ,a.COURT_NAME,'1' as SYSTEM_ID
                                FROM WH_CIVIL_CASE a WHERE a.CIVIL_CODE ='" . $CODE_API . "'"; //ต้นทาง
            } else if ($SYSTEM_TYPE == 2) { //ล้มละลาย
                $sqlF = "SELECT a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY, 
                               CASE
                                    WHEN a.COURT_CODE = '010030' THEN '050'
                                    ELSE a.COURT_CODE END AS COURT_CODE,
                                    a.COURT_NAME,
                                    '2' AS SYSTEM_ID,a.COURT_NAME,'2' as SYSTEM_ID
                               FROM WH_BANKRUPT_CASE_DETAIL a WHERE a.BANKRUPT_CODE='" . $CODE_API . "'"; //ต้นทาง
            } else if ($SYSTEM_TYPE == 3) { //ฟื้นฟู
                $sqlF = "SELECT a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,
                                CASE WHEN a.COURT_CODE='010030' THEN '050' ELSE a.COURT_CODE END  AS COURT_CODE  ,a.COURT_NAME  ,'3' as SYSTEM_ID,a.REHAB_CODE 
                                FROM WH_REHABILITATION_CASE_DETAIL a WHERE a.REHAB_CODE ='" . $CODE_API . "'"; //ต้นทาง
            } else if ($SYSTEM_TYPE == 4) { //ไกล่เกลี่ย
                $sqlF = "SELECT a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,
                                CASE WHEN a.COURT_ID='010030' THEN 050 ELSE a.COURT_ID END AS COURT_CODE  ,a.COURT_NAME  ,'4' as SYSTEM_ID,a.REF_WFR_ID
                               FROM WH_MEDIATE_CASE a WHERE a.REF_WFR_ID ='" . $CODE_API . "'"; //ต้นทาง
            }
            $queryF = db::query($sqlF);
            $rowF = db::fetch_array($queryF);

            if ($SH1 == '1') { //เเพ่ง 
                $sql_DOSS = "SELECT a.DOSS_OWNER_ID ,a.DOSS_OWNER_NAME,b.CIVIL_CODE AS CODE_API  FROM WH_CIVIL_DOSS a 
                            JOIN WH_CIVIL_CASE b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
                            WHERE a.WH_CIVIL_ID ='" . $AA2['WH_ID'] . "'"; //ใช้กับฝั่งรับ
                $SYSTEM_RE = '1';
            } elseif ($SH1 == '2') { //ล้มละลาย
                $sql_DOSS = "SELECT a.DOSS_OWNER_ID ,a.DOSS_OWNER_NAME,a.BANKRUPT_CODE AS CODE_API FROM WH_BANKRUPT_CASE_DETAIL a 
                            WHERE a.WH_BANKRUPT_ID ='" .  $AA2['WH_ID'] . "'"; //ใช้กับฝั่งรับ
                $SYSTEM_RE = '2';
            } elseif ($SH1 == '3') { //ฟื้นฟู
                $sql_DOSS = "SELECT a.*,a.REHAB_CODE as CODE_API  FROM WH_REHABILITATION_CASE_DETAIL a WHERE a.WH_REHAB_ID='" .  $AA2['WH_ID'] . "'  "; //ใช้กับฝั่งรับ
                $SYSTEM_RE = '3';
            } elseif ($SH1 == '4') { //ไกล่เกลี่ย
                $sql_DOSS = "SELECT a.*,a.REF_WFR_ID AS CODE_API FROM WH_MEDIATE_CASE a WHERE a.WH_MEDAITE_ID='" .  $AA2['WH_ID'] . "' "; //ใช้กับฝั่งรับ
                $SYSTEM_RE = '4';
            }
            $queryDOSS = db::query($sql_DOSS);
            $rowDoss = db::fetch_array($queryDOSS);
            $DOSS_ID = $rowDoss['DOSS_OWNER_ID'] != "" ? $rowDoss['DOSS_OWNER_ID'] : "";
            $DOSS_NAME = $rowDoss['DOSS_OWNER_NAME'] != "" ? $rowDoss['DOSS_OWNER_NAME'] : "";

            $TextF = "คดีดำ" . $rowF['PREFIX_BLACK_CASE'] . $rowF['BLACK_CASE'] . "/" . $rowF['BLACK_YY'] . "คดีแดง" . $rowF['PREFIX_RED_CASE'] . $rowF['RED_CASE'] . $rowF['RED_YY'] . ""; //ต้นทาง
            $TextL = "คดีดำ" . $AA2['PREFIX_BLACK_CASE'] . $AA2['BLACK_CASE'] . "/" . $AA2['BLACK_YY'] . "คดีแดง" . $AA2['PREFIX_RED_CASE'] . $AA2['RED_CASE'] . $AA2['RED_YY'] . ""; //ปลายทาง
            $person_name = $AA2['PREFIX_NAME'] . $AA2['FIRST_NAME'] . $AA2['LAST_NAME'] . " " . "สถานะ " . $AA2['CONCERN_NAME'] . " " . $AA2['COURT_NAME']; //คนที่ตรวจพบปลายทาง
            $Text_1 = "มีการตรวจคนจากระบบ" . ConvertSystemToThai($SYSTEM_TYPE) . "ที่" . $TextF . " ตรวจพบ " . $person_name . "ที่คดี" . $TextL;
            //ฝั่งส่ง 

            //เช็คห้ามมีรายการซ้ำ
            $sql_alert = "SELECT COUNT(a.ID_ALERT) as ID_ALERT FROM M_ALERT_NOTIFICATION a 
                        WHERE 1=1 
                        AND a.NOTE='" . $Text_1 . "'";
            $query_alert = db::query($sql_alert);
            $num_alert = db::fetch_array($query_alert);
            if ($num_alert['ID_ALERT'] > 0) {
            } else {
                unset($fields);
                $fields["CREATE_DATE"]         =     date('Y-m-d'); //วันที่สร้าง
                $fields["CREATE_TIME"]         =     date('H:i:s'); //เวลาที่สรา้ง
                $fields["SEND_CODE_ID"]         =     $CODE_API; //IDของคดีที่เรียกapi ของผู้ส่ง pccCivilGen ,brc_id //มาจาก api
                $fields["SYSTEM_TYPE_SEND"]         =    $SYSTEM_TYPE; //ส่งจากระบบ 1=เเพ่ง 2=ล้มละลาย 

                $fields["ID_CARD_SEND"]         =     $toPersonId; //13หลักผู้ส่ง //มาจาก api
                $fields["DOSS_OWNER_ID"]         =     $DOSS_ID; //IDของเจ้าของคดีฝั่งรับ
                $fields["DOSS_OWNER_NAME"]         =    $DOSS_NAME; //ชื่อเจ้าของคดีฝั่งรับ
                $fields["REGISTER_CODE"]         =     $AA2['REGISTER_CODE']; //IDของคนที่ตรวจเจอ
                $fields["NOTE"]         =     $Text_1; //ข้อความที่เเสดงในการเเจ้งเตือน
                $fields["RECEIVE_CODE_ID"]         =     $rowDoss['CODE_API']; //IDของคดีที่เรียกapi ของผู้รับ
                $fields["SYSTEM_TYPE_RECEIVE"]         =     $SYSTEM_RE; //ระบบที่รับ system_($ss)
                $fields["STATUS"]         =     "PERSON"; //สถานะเป็นทรัพย์หรือเป็นคน
                db::db_insert("M_ALERT_NOTIFICATION", $fields, 'ID_ALERT', 'ID_ALERT');
                $data_log[] = $sql_DOSS;
            }
        }
    }
    // return $data_log;
}


class main_case
{ //class หลักที่ใช่ร่วมกัน
    private $z1;
    protected $z2;

    public $z3;
    public $WF_GET_APPOINTMENT_IN_CIVIL = "http://103.40.146.73/LedServiceCivilById.php/getAppointmant";
    public $LINK_CIVIL;

    public static $IS_OWNER_REVIVE;

    public static function checkPeopleAll($data) //ตรวจคนไม่เอาคดีตัวเองข้อมูลจะreturnกับมาเป็นชุดarray
    {
        ex_p($data);
        $result_PRE_CODE = "";
        $result_case = "";
        $k = 0;
        $array_raw = [];
        $filter_SYSTEM_TYPE = "";
        $arr_system = array("Civil" => "คดีแพ่ง", "Bankrupt" => "คดีล้มละลาย", "Revive" => "คดีฟื้นฟู", "Mediate" => "คดีไกล่เกลี่ย");
        foreach ($arr_system as $sys => $sys_name) {
            $k++;
            $filter1 = "";
            /* start ไม่เอาคดีตัวเอง */
            if (!empty($_GET['PCC_CIVIL_GEN'])) {
                $CodeApi = $_GET['PCC_CIVIL_GEN'];
            } elseif (!empty($_GET['brcID'])) {
                $CodeApi = $_GET['brcID'];
            } elseif (!empty($_GET['WFR_API'])) {
                $CodeApi = $_GET['WFR_API'];
            }
            $filter1 .= checkMain::NotInCaseMyself($CodeApi, $_GET['SEND_TO'], $sys);
            /* stop ไม่เอาคดีตัวเอง */

            // การเรียงของคิวรี่ตรวจคน
            $order = "	ORDER BY TB.SYSTEM_TYPE ASC,
                                            TB.REGISTER_CODE ASC,
                                            TO_NUMBER(TB.CONCERN_NO) ASC";


            // เป็น 13หลัก ใช้ในการตรวจคน
            $REGISTERCODE = result_array(str_replace('-', '', ($_GET['REGISTERCODE']))); //โจทก์ จำเลย สถานะอื่นๆ

            $REGISTERCODE_C1 = result_array(str_replace('-', '', ($_GET['REGISTERCODE_C1']))); //โจทก์
            $REGISTERCODE_C2 = result_array(str_replace('-', '', ($_GET['REGISTERCODE_C2']))); //จำเลย
            $REGISTERCODE_C3 = result_array(str_replace('-', '', ($_GET['REGISTERCODE_C3']))); //สถานะอื่นที่ไม่ใช่โจทก์เเละจำเลย

            if ($_GET['DATA_SEARCH'] == 'ALL') { //ทั้งหมด

                //ส่ง 13หลักมาตรวจตรงๆใช้ REGISTERCODE=11111,22222,33333
                $REGISTERCODE = $REGISTERCODE == "" ? "" : $REGISTERCODE;

                if ($REGISTERCODE != "") {
                    $filter1 .= " and TB.REGISTER_CODE in (" . $REGISTERCODE . ") ";
                }
                if ($_GET['COURT_NAME'] != "") {
                    $filter1 .= " AND TB.COURT_NAME = '" . $_GET['COURT_NAME'] . "' ";
                }

                if ($_GET['T_BLACK_CASE'] != "" && $_GET['BLACK_CASE'] != "" && $_GET['BLACK_YY'] != "") {

                    $filter1 .= " AND TB.PREFIX_BLACK_CASE  like '%" . $_GET['T_BLACK_CASE'] . "%' ";
                    $filter1 .= " AND TB.BLACK_CASE  like '%" . $_GET['BLACK_CASE'] . "%' ";
                    $filter1 .= " AND TB.BLACK_YY  like '%" . $_GET['BLACK_YY'] . "%' ";
                }

                if ($_GET['T_RED_CASE'] != "" && $_GET['RED_CASE'] != "" && $_GET['RED_YY'] != "") {

                    $filter1 .= " AND TB.PREFIX_RED_CASE  like '%" . $_GET['T_RED_CASE'] . "%' ";
                    $filter1 .= " AND TB.RED_CASE  like '%" . $_GET['RED_CASE'] . "%' ";
                    $filter1 .= " AND TB.RED_YY  like '%" . $_GET['RED_YY'] . "%' ";
                }

                if ($filter1 != "" &&  !empty($REGISTERCODE)) {
                    $sqlSelectDataALL_e = "SELECT * FROM VIEW_PERSON_GROUP TB 
                                                            WHERE TB.SYSTEM_TYPE = '" . $sys . "' 
                                                            {$filter1}{$order} ";
                    //echo "<br><br>" . $sqlSelectDataALL_e;
                    $query_SelectDataALL_e[$k] = db::query($sqlSelectDataALL_e);
                    while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
                        $array_raw[$k][] = $recSelectDataAll;
                    }
                }
            } else if ($_GET['DATA_SEARCH'] == 'COUPLE' || $_GET['DATA_SEARCH'] == 'CROSS') {
                $check = 0;
                //คู่ เลือกรายการที่REGISTERCODE_1 เป็นโจทย์ และREGISTERCODE_2 เป็นจำเลย
                if ($_GET['DATA_SEARCH'] == 'COUPLE') {
                    $check = '1';
                    if ($_GET['REGISTERCODE_C1'] != "") {

                        $filter_1 = "  AND TB2.REGISTER_CODE in (" . $REGISTERCODE_C1 . ")
                                                            AND TB2.CONCERN_NAME in ('โจทก์','เจ้าหนี้')";
                    }
                    if ($_GET['REGISTERCODE_C2'] != "") {
                        $filter_2 = "AND TB2.REGISTER_CODE in (" . $REGISTERCODE_C2 . ")
                                                           AND TB2.CONCERN_NAME in ('จำเลย','ลูกหนี้')";
                    }
                }
                //ไขว้ ส่งโจทก์เเละจำเลยไปตรวจเป็นสถานะอื่นๆ นอกจากจำเลย
                if ($_GET['DATA_SEARCH'] == 'CROSS') {
                    $check = '2';
                    if ($_GET['REGISTERCODE_C1'] != "") {

                        $filter_1 = " AND TB2.REGISTER_CODE in (" . $REGISTERCODE_C1 . ")";
                    }
                    if ($_GET['REGISTERCODE_C2'] != "") {
                        $filter_2 = "AND TB2.REGISTER_CODE in (" . $REGISTERCODE_C2 . ")";
                    }
                }
                if ($check > 0) {
                    $sql_ALL = "";
                    $sql_ALL = "SELECT *FROM VIEW_PERSON_GROUP TB 
                                                    WHERE 1=1 
                                                        AND EXISTS (	
                                                        SELECT *FROM VIEW_PERSON_GROUP TB2
                                                        WHERE 1=1 
                                                        AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE 
                                                        AND TB2.BLACK_CASE=TB.BLACK_CASE 
                                                        AND TB2.BLACK_YY=TB.BLACK_YY 
                                                        AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
                                                        AND TB2.RED_CASE = TB.RED_CASE 
                                                        AND TB2.RED_YY = TB.RED_YY 
                                                        {$filter_1})
                                                        AND EXISTS (
                                                        SELECT *FROM VIEW_PERSON_GROUP TB2
                                                        WHERE 1=1
                                                        AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE
                                                        AND TB2.BLACK_CASE=TB.BLACK_CASE
                                                        AND TB2.BLACK_YY=TB.BLACK_YY 
                                                        AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
                                                        AND TB2.RED_CASE = TB.RED_CASE 
                                                        AND TB2.RED_YY = TB.RED_YY 
                                                        {$filter_2})
                                                    AND TB.REGISTER_CODE in(" . $REGISTERCODE_C1 . "," . $REGISTERCODE_C2 . ")
                                                    {$filter1}
                                                    AND TB.SYSTEM_TYPE = '" . $sys . "'
                                                    {$order}
                                                    ";
                }
                $query_SelectDataALL_e[$k] = db::query($sql_ALL);
                while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
                    $array_raw[$k][] = $recSelectDataAll;
                }
            } else if ($_GET['DATA_SEARCH'] == 'CROSS_AND_ALL') {
                //การตรวจไขว์เเละทั้งหมดคือ เอาโจทย์เเละจำเลยไปตรวจ คู่กันเป็นอะไรก็ได้ในคดีอื่น 
                //จากนั้นนำโจทย์้้ละจำเลยไปตรวจ ที่สถาอื่นนอกจากสถานะตัวเอง
                $check = 0;
                if ($_GET['DATA_SEARCH'] == 'CROSS_AND_ALL') { //ไขว้
                    $check = '2';
                    if ($_GET['REGISTERCODE_C1'] != "") {
                        $filter_1 = " AND TB2.REGISTER_CODE in (" . $REGISTERCODE_C1 . ")";
                    }
                    if ($_GET['REGISTERCODE_C2'] != "") {
                        $filter_2 = "AND TB2.REGISTER_CODE in (" . $REGISTERCODE_C2 . ")";
                    }
                }
                if ($check > 0) {
                    $sql_ALL = "";
                    $sql_ALL = "SELECT * FROM VIEW_PERSON_GROUP TB 
                                                    WHERE 1=1 
                                                            AND EXISTS (	
                                                            SELECT *FROM VIEW_PERSON_GROUP TB2
                                                            WHERE 1=1 
                                                            AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE 
                                                            AND TB2.BLACK_CASE=TB.BLACK_CASE 
                                                            AND TB2.BLACK_YY=TB.BLACK_YY 
                                                            AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
                                                            AND TB2.RED_CASE = TB.RED_CASE 
                                                            AND TB2.RED_YY = TB.RED_YY 
                                                            {$filter_1})
                                                            AND EXISTS (
                                                            SELECT *FROM VIEW_PERSON_GROUP TB2
                                                            WHERE 1=1
                                                            AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE
                                                            AND TB2.BLACK_CASE=TB.BLACK_CASE
                                                            AND TB2.BLACK_YY=TB.BLACK_YY 
                                                            AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
                                                            AND TB2.RED_CASE = TB.RED_CASE 
                                                            AND TB2.RED_YY = TB.RED_YY 
                                                            {$filter_2})
                                                        AND TB.REGISTER_CODE in(" . $REGISTERCODE_C1 . "," . $REGISTERCODE_C2 . ")
                                                        {$filter1}
                                                        AND TB.SYSTEM_TYPE = '" . $sys . "'
                                                        {$order}
                                                        ";
                }
                $query_SelectDataALL_e[$k] = db::query($sql_ALL);
                while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
                    $array_raw[$k][] = $recSelectDataAll;
                }


                /* start ตรวจโจทย์ในสถานะอื่น */
                $sql_ALL = "";
                $sql_ALL = "SELECT* FROM VIEW_PERSON_GROUP TB 
                                                    WHERE 1=1 	
                                                AND TB.REGISTER_CODE in(" . $REGISTERCODE_C1 . ")
                                                AND TB.CONCERN_NAME NOT IN ('โจทก์','เจ้าหนี้')				
                                                AND TB.SYSTEM_TYPE = '" . $sys . "'
                                                {$filter1}{$order}
                                                ";
                $query_SelectDataALL_e[$k] = db::query($sql_ALL);
                while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
                    $array_raw[$k][] = $recSelectDataAll;
                }
                /* stop ตรวจโจทย์ในสถานะอื่น */

                /* start ตรวจจำเลยในสถานะอื่น */
                $sql_ALL = "";
                $sql_ALL = "SELECT * FROM VIEW_PERSON_GROUP TB 
                                                    WHERE 1=1 	
                                                AND TB.REGISTER_CODE in(" . $REGISTERCODE_C2 . ")
                                                AND TB.CONCERN_NAME NOT IN ('จำเลย','ลูกหนี้')	
                                                AND TB.SYSTEM_TYPE = '" . $sys . "'
                                                {$filter1}{$order}
                                                ";
                $query_SelectDataALL_e[$k] = db::query($sql_ALL);
                while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
                    $array_raw[$k][] = $recSelectDataAll;
                }
                /* stop ตรวจจำเลยในสถานะอื่น */
            } else if ($_GET['DATA_SEARCH'] == 'COUPLE_AND_ALL') { //การตรวจคู่เเละทั้งหมดคือ เอาโจทย์เเละจำเลยไปตรวจ คู่กันเป็นอะไรก็ได้ในคดีอื่น จากนั้นนำโจทย์้้ละจำเลยไปตรวจ ที่สถาอื่นนอกจากสถานะตัวเอง
                $check = 0;
                if ($_GET['DATA_SEARCH'] == 'COUPLE_AND_ALL') { //คู่ เลือกรายการที่REGISTERCODE_1 เป็นโจทย์ และREGISTERCODE_2 เป็นจำเลย
                    $check = '1';
                    if ($_GET['REGISTERCODE_C1'] != "") { //ส่ง โจทก์ เจ้าหนี้ มาตรวจ
                        $filter_1 = "  AND TB2.REGISTER_CODE in (" . $REGISTERCODE_C1 . ")
                                                            AND TB2.CONCERN_NAME in ('โจทก์','เจ้าหนี้')";
                    }
                    if ($_GET['REGISTERCODE_C2'] != "") { //ส่ง จำเลย ลูกหนี้ มาตรวจ
                        $filter_2 = "AND TB2.REGISTER_CODE in (" . $REGISTERCODE_C2 . ")
                                                           AND TB2.CONCERN_NAME in ('จำเลย','ลูกหนี้')";
                    }
                }
                if ($check > 0) {
                    $sql_ALL = "";
                    $sql_ALL = "SELECT * FROM VIEW_PERSON_GROUP TB 
                                                            WHERE 1=1 
                                                        AND EXISTS (	
                                                        SELECT *FROM VIEW_PERSON_GROUP TB2
                                                        WHERE 1=1 
                                                        AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE 
                                                        AND TB2.BLACK_CASE=TB.BLACK_CASE 
                                                        AND TB2.BLACK_YY=TB.BLACK_YY 
                                                        AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
                                                        AND TB2.RED_CASE = TB.RED_CASE 
                                                        AND TB2.RED_YY = TB.RED_YY 
                                                        {$filter_1})
                                                        AND EXISTS (
                                                        SELECT *FROM VIEW_PERSON_GROUP TB2
                                                        WHERE 1=1
                                                        AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE
                                                        AND TB2.BLACK_CASE=TB.BLACK_CASE
                                                        AND TB2.BLACK_YY=TB.BLACK_YY 
                                                        AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
                                                        AND TB2.RED_CASE = TB.RED_CASE 
                                                        AND TB2.RED_YY = TB.RED_YY 
                                                        {$filter_2})
                                                    AND TB.REGISTER_CODE in(" . $REGISTERCODE_C1 . "," . $REGISTERCODE_C2 . ")			
                                                    AND TB.SYSTEM_TYPE = '" . $sys . "'
                                                    {$filter1}{$order}
                                                    ";
                    //echo $sql_ALL . "<br><br>";
                }
                $query_SelectDataALL_e[$k] = db::query($sql_ALL);
                while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
                    $array_raw[$k][] = $recSelectDataAll;
                }
                /* start ตรวจโจทย์ในสถานะอื่น */
                $sql_ALL = "";
                $sql_ALL = "SELECT *
                                                    FROM VIEW_PERSON_GROUP TB 
                                                    WHERE 1=1 	
                                                AND TB.REGISTER_CODE in(" . $REGISTERCODE_C1 . ")
                                                AND TB.CONCERN_NAME  NOT IN ('โจทก์','เจ้าหนี้')
                                                AND TB.SYSTEM_TYPE = '" . $sys . "'
                                                {$filter1}{$order}
                                         ";
                $query_SelectDataALL_e[$k] = db::query($sql_ALL);
                while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
                    $array_raw[$k][] = $recSelectDataAll;
                }
                /* stop ตรวจโจทย์ในสถานะอื่น */

                /* start ตรวจจำเลยในสถานะอื่น */
                $sql_ALL = "";
                $sql_ALL = "SELECT * FROM VIEW_WH_ALL_CASE_PERSON TB 
                                                    WHERE 1=1 	
                                                AND TB.REGISTER_CODE in(" . $REGISTERCODE_C2 . ")
                                                AND TB.CONCERN_NAME NOT IN ('จำเลย','ลูกหนี้')	
                                                AND TB.SYSTEM_TYPE = '" . $sys . "'
                                                {$filter1}{$order}
                                                 ";
                $query_SelectDataALL_e[$k] = db::query($sql_ALL);
                while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
                    $array_raw[$k][] = $recSelectDataAll;
                }
                /* stop ตรวจจำเลยในสถานะอื่น */
            } else if ($_GET['DATA_SEARCH'] == '1COUPLE2ALL') {
                //ตรวจโจทก์เป็นคู่เเละตรวจจำเลยหรือสถานะอื่่นๆเป็นทั้งหมด


                //ตรวจโจทก์ เจ้าหนี้ มาตรวจเป็นคู๋กับ จำเลย ลูกหนี้ ในคดี
                if ($_GET['REGISTERCODE_C1'] != "") {
                    $filter_1 = "  AND TB2.REGISTER_CODE in (" . $REGISTERCODE_C1 . ")
                                                        AND TB2.CONCERN_NAME in ('โจทก์','เจ้าหนี้')";
                }
                if ($_GET['REGISTERCODE_C2'] != "") {
                    $filter_2 = "AND TB2.REGISTER_CODE in (" . $REGISTERCODE_C2 . ")
                                                       AND TB2.CONCERN_NAME in ('จำเลย','ลูกหนี้')";
                }
                $sql_ALL = "";
                $sql_ALL = "SELECT *FROM VIEW_PERSON_GROUP TB 
                                                        WHERE 1=1 
                                                    AND EXISTS (	
                                                    SELECT *FROM VIEW_PERSON_GROUP TB2
                                                    WHERE 1=1 
                                                    AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE 
                                                    AND TB2.BLACK_CASE=TB.BLACK_CASE 
                                                    AND TB2.BLACK_YY=TB.BLACK_YY 
                                                    AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
                                                    AND TB2.RED_CASE = TB.RED_CASE 
                                                    AND TB2.RED_YY = TB.RED_YY 
                                                    {$filter_1})
                                                    AND EXISTS (
                                                    SELECT *FROM VIEW_PERSON_GROUP TB2
                                                    WHERE 1=1
                                                    AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE
                                                    AND TB2.BLACK_CASE=TB.BLACK_CASE
                                                    AND TB2.BLACK_YY=TB.BLACK_YY 
                                                    AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
                                                    AND TB2.RED_CASE = TB.RED_CASE 
                                                    AND TB2.RED_YY = TB.RED_YY 
                                                    {$filter_2})
                                                AND TB.REGISTER_CODE in(" . $REGISTERCODE_C1 . "," . $REGISTERCODE_C2 . ")
                                                AND TB.SYSTEM_TYPE = '" . $sys . "'
                                                {$filter1}{$order}
                                                ";
                $query_SelectDataALL_e[$k] = db::query($sql_ALL);
                while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
                    $array_raw[$k][] = $recSelectDataAll;
                }


                //ส่งจำเลย ลูกหนี้ มาตรวจ Allในทุกสถานะ
                $sql_ALL = "";
                $sql_ALL = "SELECT * FROM VIEW_WH_ALL_CASE_PERSON TB 
                                                    WHERE 1=1 	
                                                AND TB.REGISTER_CODE in(" . $REGISTERCODE_C2 . ")
                                                AND TB.SYSTEM_TYPE = '" . $sys . "'
                                                {$filter1}{$order}
                                                 ";
                $query_SelectDataALL_e[$k] = db::query($sql_ALL);
                while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
                    $array_raw[$k][] = $recSelectDataAll;
                }

                /* start ตรวจโจทย์ในสถานะอื่น */
                $sql_ALL = "";
                $sql_ALL = "SELECT *
								FROM VIEW_PERSON_GROUP TB 
								WHERE 1=1 	
								AND TB.REGISTER_CODE in(" . $REGISTERCODE_C1 . ")
								AND TB.CONCERN_NAME  NOT IN ('โจทก์','เจ้าหนี้')
								AND TB.SYSTEM_TYPE = '" . $sys . "'
								{$filter1}{$order}
														 ";
                $query_SelectDataALL_e[$k] = db::query($sql_ALL);
                while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
                    $array_raw[$k][] = $recSelectDataAll;
                }
                /* stop ตรวจโจทย์ในสถานะอื่น */


                //ส่งสถานะอื่นๆ นอกจากโจทก์ เจ้าหนี้ จำเลย ลูกหนี้  มาตรวจ All ในทุกสถานะ
                $sql_ALL = "";
                $sql_ALL = "SELECT * FROM VIEW_WH_ALL_CASE_PERSON TB 
                                                        WHERE 1=1 	
                                                    AND TB.REGISTER_CODE in(" . $REGISTERCODE_C3 . ")
                                                    AND TB.SYSTEM_TYPE = '" . $sys . "'
                                                    {$filter1}{$order}
                                                     ";
                $query_SelectDataALL_e[$k] = db::query($sql_ALL);
                while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
                    $array_raw[$k][] = $recSelectDataAll;
                }
            }
        }
        return $array_raw;
    }

    public static function  getNumOrder($TO_PERSON_ID, $SYSTEM_TYPE)
    {
        $sql = "SELECT COUNT(A.ID) AS COUNT_TOTAL  FROM
                            M_DOC_CMD A
                        LEFT JOIN M_CMD_SYSTEM B ON
                            A.SYS_NAME = B.CMD_SYSTEM_ID
                        LEFT JOIN M_SERVICE_CMD C ON
                            A.CASE_TYPE = C.CMD_TYPE_CODE
                        LEFT JOIN M_CMD_PERSON D ON
                            D.PERSON_ID = A.PERSON_ID
                        LEFT JOIN M_CMD_TYPE E ON
                            C.CMD_TYPE_ID = E.CMD_TYPE_ID
                        WHERE
                            1 = 1
                            AND ( (A.SEND_TO = '{$SYSTEM_TYPE}'
                                AND (A.TO_PERSON_ID = '{$TO_PERSON_ID}'
                                    OR A.TRANSACTION_APPROVE_PERSON = '{$TO_PERSON_ID}'))
                            OR (A.SYS_NAME = '{$SYSTEM_TYPE}'
                                AND ( A.OFFICE_IDCARD = '{$TO_PERSON_ID}'
                                    OR APPROVE_PERSON = '{$TO_PERSON_ID}'
                                    OR A.OFFICE_IDCARD = '{$TO_PERSON_ID}' ))
                            OR A.ID IN (
                            SELECT
                                REF_ID
                            FROM
                                M_DOC_CMD AA
                            WHERE
                                ( A.OFFICE_IDCARD = '{$TO_PERSON_ID}'
                                    OR APPROVE_PERSON = '{$TO_PERSON_ID}')) )
                            AND NVL(REF_ID, 0) = 0
                            --AND A.OFFICE_IDCARD IS NOT null 
                            ORDER BY CMD_DOC_DATE DESC,CMD_DOC_TIME DESC";
        $query = db::query($sql);
        $rec = db::fetch_array($query);
        $num_order = $rec['COUNT_TOTAL'] == "" ? "0" : $rec['COUNT_TOTAL'];
        return $num_order;
    }
    public static function CaseInformation($SYSTEM_TYPE = "", $CODE_API) //เอาข้อมูลคดี
    {
        if ($SYSTEM_TYPE == 1) { //เเพ่ง
            $sqlF = "SELECT a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.WH_CIVIL_ID AS WH_ID ,
                            CASE WHEN a.COURT_CODE='010030' THEN '050' ELSE a.COURT_CODE END AS COURT_CODE  ,a.COURT_NAME,'1' as SYSTEM_ID
                            FROM WH_CIVIL_CASE a WHERE a.CIVIL_CODE ='" . $CODE_API . "'"; //ต้นทาง
        } else if ($SYSTEM_TYPE == 2) { //ล้มละลาย
            $sqlF = "SELECT a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY, a.WH_BANKRUPT_ID  AS WH_ID,
                           CASE
                                WHEN a.COURT_CODE = '010030' THEN '050'
                                ELSE a.COURT_CODE END AS COURT_CODE,
                                a.COURT_NAME,
                                '2' AS SYSTEM_ID,a.COURT_NAME,'2' as SYSTEM_ID
                           FROM WH_BANKRUPT_CASE_DETAIL a WHERE a.BANKRUPT_CODE='" . $CODE_API . "'"; //ต้นทาง
        } else if ($SYSTEM_TYPE == 3) { //ฟื้นฟู
            $sqlF = "SELECT a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.WH_REHAB_ID  AS WH_ID,
                            CASE WHEN a.COURT_CODE='010030' THEN '050' ELSE a.COURT_CODE END  AS COURT_CODE  ,a.COURT_NAME  ,'3' as SYSTEM_ID,a.REHAB_CODE 
                            FROM WH_REHABILITATION_CASE_DETAIL a WHERE a.REHAB_CODE ='" . $CODE_API . "'"; //ต้นทาง
        } else if ($SYSTEM_TYPE == 4) { //ไกล่เกลี่ย
            $sqlF = "SELECT a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.WH_MEDAITE_ID AS WH_ID,
                            CASE WHEN a.COURT_ID='010030' THEN 050 ELSE a.COURT_ID END AS COURT_CODE  ,a.COURT_NAME  ,'4' as SYSTEM_ID,a.REF_WFR_ID
                           FROM WH_MEDIATE_CASE a WHERE a.REF_WFR_ID ='" . $CODE_API . "'"; //ต้นทาง
        }
        $queryF = db::query($sqlF);
        $rowF = db::fetch_array($queryF);
        return $rowF;
    }

    public static function Switch_WhId_TO_CodeApi($SYSTEM_TYPE, $WH_ID) //เอาข้อมูลคดี
    {
        if ($SYSTEM_TYPE == '1' || $SYSTEM_TYPE == 'Civil' || $SYSTEM_TYPE == 'CIVIL') {
            $sql = "SELECT a.CIVIL_CODE AS CODE_API,a.* FROM  WH_CIVIL_CASE a WHERE a.WH_CIVIL_ID ='" . $WH_ID . "'";
        } else if ($SYSTEM_TYPE == '2' || $SYSTEM_TYPE == 'Bankrupt' || $SYSTEM_TYPE == 'BANKRUPT') {
            $sql = "SELECT a.BANKRUPT_CODE AS CODE_API,a.* FROM WH_BANKRUPT_CASE_DETAIL a WHERE a.WH_BANKRUPT_ID =''";
        } else if ($SYSTEM_TYPE == '3' || $SYSTEM_TYPE == 'Revive' || $SYSTEM_TYPE == 'REVIVE') {
            $sql = "SELECT a.REHAB_CODE AS CODE_API,a.* FROM WH_REHABILITATION_CASE_DETAIL a WHERE a.WH_REHAB_ID =''";
        } else if ($SYSTEM_TYPE == '4' || $SYSTEM_TYPE == 'Mediate' || $SYSTEM_TYPE == 'MEDIATE') {
            $sql = "SELECT a.REF_WFR_ID AS CODE_API ,a.*FROM WH_MEDIATE_CASE a WHERE a.WH_MEDAITE_ID =''";
        }
        $query = db::query($sql);
        return $rec = db::fetch_array($query);
    }

    public static function getDataPerson($SYSTEM_TYPE, $codeApi) //เอาข้อมูลคดี
    {
        if ($SYSTEM_TYPE == '1' || $SYSTEM_TYPE == 'Civil' || $SYSTEM_TYPE == 'CIVIL') {
            $sql = "SELECT a.CIVIL_CODE AS CODE_API,b.*
                    FROM  WH_CIVIL_CASE a 
                    JOIN " . Convert::ConvertTable('WH_CIVIL_CASE_PERSON') . " b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
                    WHERE a.CIVIL_CODE ='" . $codeApi . "'";
        } else if ($SYSTEM_TYPE == '2' || $SYSTEM_TYPE == 'Bankrupt' || $SYSTEM_TYPE == 'BANKRUPT') {
            $sql = "SELECT a.BANKRUPT_CODE AS CODE_API,b.*
                    FROM WH_BANKRUPT_CASE_DETAIL a 
                    JOIN WH_BANKRUPT_CASE_PERSON b ON a.WH_BANKRUPT_ID =b.WH_BANKRUPT_ID 
                    WHERE a.BANKRUPT_CODE ='" . $codeApi . "'";
        } else if ($SYSTEM_TYPE == '3' || $SYSTEM_TYPE == 'Revive' || $SYSTEM_TYPE == 'REVIVE') {
            $sql = "SELECT a.REHAB_CODE AS CODE_API,b.*
                    FROM WH_REHABILITATION_CASE_DETAIL a 
                    JOIN WH_REHABILITATION_PERSON b ON a.WH_REHAB_ID =b.WH_REHAB_ID 
                    WHERE a.REHAB_CODE ='" . $codeApi . "'";
        } else if ($SYSTEM_TYPE == '4' || $SYSTEM_TYPE == 'Mediate' || $SYSTEM_TYPE == 'MEDIATE') {
            $sql = "SELECT a.REF_WFR_ID AS CODE_API ,b.*
                    FROM WH_MEDIATE_CASE a
                    JOIN WH_MEDIATE_PERSON b ON a.WH_MEDAITE_ID =b.WH_MEDIATE_ID 
                    WHERE a.REF_WFR_ID ='" . $codeApi . "'";
        }
        $query = db::query($sql);
        $array_data = array();
        while ($rec = db::fetch_array($query)) {
            $array_data[] = $rec;
        }
        return $array_data;
    }
    public static function lockPerson($InputPccCaseGen = '', $InputRegisterCode = '', $InputConncernName = '') //ต้นทางคำสั่งศาลจากฟื้นฟู ไปล็อกคนที่ปลายทางแพ่ง
    { //ล็อคคนที่เเพ่งจากฟื้นฟู

        $curl = curl_init();

        $arrDataSet = array();

        $arrDataSet["USERNAME"]     = "BankruptDt";
        $arrDataSet["PASSWORD"]     = "Debtor4321";
        $arrDataSet["PCC_CASE_GEN"] = $InputPccCaseGen;
        // $arrDataSet["CARD_ID"]         = $InputRegisterCode;
        // $arrDataSet["CONCERN_CODE"] = ($InputConncernName == 'โจทก์') ? '01' : '02';
        //$arrDataSet["IS_REVIVE"]     = 1;
        //$arrDataSet["IS_BANKRUPT"]     = 0;
        //$arrDataSet["IS_MEDIATE"]     = 0;
        //$arrDataSet["IS_CIVIL"]     = 0;

        $sql = "  SELECT a.WH_CIVIL_ID  FROM WH_CIVIL_CASE a WHERE a.CIVIL_CODE ='" . $InputPccCaseGen . "'";
        $query = db::query($sql);
        $row = db::fetch_array($query);

        $SEQUEST_STATUS = 0;
        $SALE_STATUS = 0;
        $ACCOUNTANCY_STATUS = 0;

        $sqlSelectCmdAsset         = "	select 		CFC_CAPTION_GEN,DOSS_CONTROL_GEN,PROP_STATUS
                                        from 		WH_CIVIL_CASE_ASSETS
                                        where 		WH_CIVIL_ID = '" . $row['WH_CIVIL_ID'] . "'";

        $querySelectCmdAsset     = db::query($sqlSelectCmdAsset);
        while ($recSelectCmdAsset = db::fetch_array($querySelectCmdAsset)) {
            $arrDataSet["CFC_CAPTION_GEN"][$recSelectCmdAsset["CFC_CAPTION_GEN"]] = $recSelectCmdAsset["CFC_CAPTION_GEN"];
            $arrDataSet["PROP_STATUS"][$recSelectCmdAsset["CFC_CAPTION_GEN"]] = $recSelectCmdAsset["PROP_STATUS"];
            $arrDataSet["DOSS_CONTROL_GEN"][$recSelectCmdAsset["DOSS_CONTROL_GEN"]] = array(
                "SEQUEST_STATUS"         => $SEQUEST_STATUS,
                "SALE_STATUS"             => $SALE_STATUS,
                "ACCOUNTANCY_STATUS"     => $ACCOUNTANCY_STATUS
            );
        }

        if (count($arrDataSet) > 0) {
            $data_string = json_encode($arrDataSet);
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://103.40.146.73/LedService.php/lockPersonCivil',
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
        }
        return $data_string;
    }
    public static function uplockPerson($InputPccCaseGen) //upLockAssetCivil  //ปลดล็อคคนที่เเพ่งจากฟื้นฟู
    {
        $arrCFC_CAPTION_GEN = array();
        $sql = "  SELECT a.WH_CIVIL_ID  FROM WH_CIVIL_CASE a WHERE a.CIVIL_CODE ='" . $InputPccCaseGen . "'";
        $query = db::query($sql);
        $row = db::fetch_array($query);
        $sqlSelectCmdAsset         = "	select 		CFC_CAPTION_GEN,DOSS_CONTROL_GEN,PROP_STATUS
                    from 		WH_CIVIL_CASE_ASSETS
                    where 		WH_CIVIL_ID = '" . $row['WH_CIVIL_ID'] . "'";
        $SEQUEST_STATUS = 0;
        $SALE_STATUS = 0;
        $ACCOUNTANCY_STATUS = 1;
        $querySelectCmdAsset     = db::query($sqlSelectCmdAsset);
        while ($recSelectCmdAsset = db::fetch_array($querySelectCmdAsset)) {
            $arrCFC_CAPTION_GEN["CFC_CAPTION_GEN"][$recSelectCmdAsset["CFC_CAPTION_GEN"]] = $recSelectCmdAsset["CFC_CAPTION_GEN"];
            $arrCFC_CAPTION_GEN["DOSS_CONTROL_GEN"][$recSelectCmdAsset["DOSS_CONTROL_GEN"]] = array(
                "SEQUEST_STATUS" => $SEQUEST_STATUS,
                "SALE_STATUS" => $SALE_STATUS,
                "ACCOUNTANCY_STATUS" => $ACCOUNTANCY_STATUS
            );
        }

        if (count($arrCFC_CAPTION_GEN) > 0) {

            $data_string = json_encode($arrCFC_CAPTION_GEN);

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://103.40.146.73/LedService.php/upLockAssetCivil',
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
        }
        return $data_string;
    }
    public function ConvertArrayToStr($Array, $putSigle)
    //เอาarrayมาเรียง
    //Ans 1111,222,333
    {
        foreach ($Array as $AA1 => $BB1) {
            $A = $BB1 . ",";
        }
        if ($putSigle == 'Y' || $putSigle == 'y') {
            $A = result_array(cut_last_comma($A));
        } else {
            $A =  cut_last_comma($A);
        }
        return $A;
    }
    public static function curl($link, $Array, $endcode)
    {
        $data_string = json_encode($Array);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$link",
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
        if ($endcode != "") {
            $dataReturn = json_decode($response, true);
        } else {
            $dataReturn = $response;
        }
        return $dataReturn;
    }
}

class civil extends main_case
{
    public $PCC_CIVIL_GEN;

    public $LINK_CIVIL = '"http://103.40.146.73/"';

    public $LINK_SERVICE = "";

    public $PerosnBankRupt;


    public $CFC_CAPTION;
    public $AR_IS_OWNER_BANKRUPT; //ติดล้ม
    public $AR_IS_OWNER_REVIVE; //ติดฟื้นฟู
    public $AR_LOCK_CONFISCATE_FLAG; //ห้ามยึด
    public $AR_LOCK_SELL_FLAG; //ห้ามขาย
    public $AR_LOCK_ACCOUNTING_FLAG; //ห้ามทำบันชี

   

    public function AssetDouble($get)
    {
        //เช็คว่ามีเเจ้งเตือนทรัพย์ซ้ำหรือไม่
        $sql = "SELECT a.NOTE FROM M_ALERT_NOTIFICATION a 
               WHERE a.CFC_CAPTION_GEN='" . $this->CFC_CAPTION . "' 
               AND a.STATUS='DoubleASSETS' 
               ORDER BY a.ID_ALERT DESC ";
        $query = db::query($sql);
        $rec = db::fetch_array($query);
        $numDoubleAssets = db::num_rows($query);
        if ($get == 'data') {
            return $rec['NOTE'];
        } else if ($get == 'num') {
            return $numDoubleAssets;
        }
    }
    public function textAlert($text, $get)
    {
        //เช็คว่ามีเเจ้งเตือนทรัพย์ซ้ำหรือไม่
        $sql = "SELECT a.NOTE FROM M_ALERT_NOTIFICATION a 
        WHERE a.CFC_CAPTION_GEN='" . $this->CFC_CAPTION . "' 
        AND a.STATUS='DoubleASSETS' 
        ORDER BY a.ID_ALERT DESC ";
        $query = db::query($sql);
        $rec = db::fetch_array($query);
        $numDoubleAssets = db::num_rows($query);

        //ตรวจว่ามีทรัพย์ซ้ำหรือไม่

        //ทรัพย์ซ้ำ =2
        //ติดล้มละลาย=3
        //ติดฟื้นฟู=4
        $work = 0;
        if ($numDoubleAssets > 0 && $this->AR_LOCK_CONFISCATE_FLAG == '1' && $this->AR_LOCK_SELL_FLAG == '1' && $this->AR_LOCK_ACCOUNTING_FLAG == '1') {
            $NOTE = $rec['NOTE'];
            $work = 2;
        } else {
            if ($text == 'LOCK_CONFISCATE_FLAG') {
                //ถ้าติดล้มละลาย เเละไม่ติดฟื้นฟู
                if ($this->AR_IS_OWNER_BANKRUPT == '1' && $this->AR_IS_OWNER_REVIVE != '1') {
                    if ($this->AR_LOCK_CONFISCATE_FLAG == '1') {
                        $NOTE =  "ไม่สามารถบักทึกได้ ตรวจพบบุคคลล้มละลาย ";
                        $work = 3;
                    }
                }
                //ติดฟื้นฟู เเละไม่ติดล้ม
                if ($this->AR_IS_OWNER_REVIVE == '1' && $this->AR_IS_OWNER_BANKRUPT != '1') {
                    if ($this->AR_LOCK_CONFISCATE_FLAG == '1') {
                        $NOTE =  "ไม่สามารถบักทึกได้ เนื่องจากตรวจพบลูกหนี้ในระบบฟื้นฟู ";
                        $work = 4;
                    }
                }
            } else if ($text == 'LOCK_SELL_FLAG') {
                //ถ้าติดล้มละลาย เเละไม่ติดฟื้นฟู
                if ($this->AR_IS_OWNER_BANKRUPT == '1' && $this->AR_IS_OWNER_REVIVE != '1') {
                    if ($this->AR_LOCK_SELL_FLAG == '1') {
                        $NOTE =  "ไม่สามารถบักทึกได้ ตรวจพบบุคคลล้มละลาย ";
                        $work = 3;
                    }
                }
                //ติดฟื้นฟู เเละไม่ติดล้ม
                if ($this->AR_IS_OWNER_REVIVE == '1' && $this->AR_IS_OWNER_BANKRUPT != '1') {
                    if ($this->AR_LOCK_SELL_FLAG == '1') {
                        $NOTE = "ไม่สามารถบักทึกได้ เนื่องจากตรวจพบลูกหนี้ในระบบฟื้นฟู ";
                        $work = 4;
                    }
                }
            } else if ($text == 'LOCK_ACCOUNTING_FLAG') {
                //ถ้าติดล้มละลาย เเละไม่ติดฟื้นฟู
                if ($this->AR_IS_OWNER_BANKRUPT == '1' && $this->AR_IS_OWNER_REVIVE != '1') {
                    if ($this->AR_LOCK_ACCOUNTING_FLAG == '1') {
                        $NOTE =  "ไม่สามารถบักทึกได้ ตรวจพบบุคคลล้มละลาย ";
                        $work = 3;
                    }
                }
                //ติดฟื้นฟู เเละไม่ติดล้ม
                if ($this->AR_IS_OWNER_REVIVE == '1' && $this->AR_IS_OWNER_BANKRUPT != '1') {
                    if ($this->AR_LOCK_ACCOUNTING_FLAG == '1') {
                        $NOTE =  "ไม่สามารถบักทึกได้ เนื่องจากตรวจพบลูกหนี้ในระบบฟื้นฟู ";
                        $work = 4;
                    }
                }
            }
        }
        if ($get == 'num') {
            return $work;
        } else if ($get == 'note') {
            return $NOTE;
        }
    }
    public function only_ledQuery_checkPerson($array_idcard)
    {
        $IdCardOut = (self::cutIdcardOutCaption($array_idcard)); //13หลักของคนในคดี ไม่เอาคนในทรัพย์
        $IdCard = self::ConvertArrayToStr($IdCardOut, '');
        $numBankrupt = bankrupt::checkPersonBanrupt($IdCard, 'จำเลย'); //ตรวจจำนวนคนติดล้ม
        return $numBankrupt;
    }


    public static function logOrder_update($URL_API, $CFC_CAPTION, $LOCK_CONFISCATE_FLAG, $LOCK_SELL_FLAG, $LOCK_ACCOUNTING_FLAG, $ARRAY)
    {
        $fields["URL_API"]                 =   $URL_API;
        $fields["PCC_CIVIL_GEN"]           =   self::convertCaptionToPccCivil($CFC_CAPTION);
        $fields["ARRAY_DATA"]              =   "";
        $fields["CFC_CAPTION_GEN"]         =   $CFC_CAPTION;
        $fields["ID_CARD"]                 =   $ARRAY['ID_CARD'];
        $fields["SEQUEST_STATUS"]          =   $LOCK_CONFISCATE_FLAG;
        $fields["SALE_STATUS"]             =   $LOCK_SELL_FLAG;
        $fields["ACCOUNTANCY_STATUS"]      =   $LOCK_ACCOUNTING_FLAG;
        $fields["CREATE_DATE"]             =   date("Y-m-d");
        $fields["CREATE_TIME"]             =   date("h:i:sa");
        db::db_insert("M_LOG_ORDER ", $fields, 'ID_ORDER', 'ID_ORDER');
    }


    //ล็อคคนติดฟื้นฟู
    public function CurlLock_LED_SERVICE_REVIVE($ArrayDATA)
    {
        $data_string = json_encode($ArrayDATA);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://103.40.146.73/LedService.php/UPDATE_CFC_CAPTION_REVIVE',
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
        return json_decode($response, true);
    }

    //ล็อคเเละปลดล็อคทรัพย์ CFC_CAPTION
    public function CurlLock_LED_SERVICE($ArrayDATA)
    {
        $data_string = json_encode($ArrayDATA);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://103.40.146.73/LedService.php/UPDATE_CFC_CAPTION',
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
        return json_decode($response, true);
    }

    public function LockAllCaption($IdCardOut)
    {
        //13หลักของคนในคดี
        //ตรวจล้มเเละคำสั่ง
        $IdCard = $this->ConvertArrayToStr($IdCardOut, '');
        $numBankrupt = bankrupt::checkPersonBanrupt($IdCard, 'จำเลย'); //ตรวจจำนวนคนติดล้ม
        $numRevive = revive::checkPersonRevive(result_array($IdCard), 'จำเลย,ลูกหนี้');


        //ตรวจว่าในคดีมีทรัพย์กี่ตัว
        $Array = [
            "PCC_CIVIL_GEN" => $this->PCC_CIVIL_GEN
        ];
        $Asset = (self::curl('http://103.40.146.73/LedService.php/pccCivilGetIdcardForAsset', $Array, 'Y'));

        //ตรวจคำสั่ง ตรวจคำนวนคำสั่งที่เกิดขึ้นในคดี
        //return $Asset;//ทรัพย์เป็นArray
        foreach ($Asset['CFC_CAPTION_GEN'] as $CFC_CAPTION_GEN => $B1) {
            //ใช้PccCivilGenเเละCFC_CAPTION ในการการจำนวนคำสั่ง
            $sqlCFC = "SELECT a.ID_ORDER FROM M_LOG_ORDER a 
                        WHERE  1=1 
                        AND a.URL_API ='UPDATE_CFC_CAPTION_FOR_CMD'
                        AND a.PCC_CIVIL_GEN ='" . $this->PCC_CIVIL_GEN . "'
                        AND a.CFC_CAPTION_GEN ='" . $CFC_CAPTION_GEN . "'";
            $queryCFC = db::query($sqlCFC);
            $num_CFC = db::num_rows($queryCFC);
            if ($num_CFC > 0) { //ถ้ามีคำสั่ง

            } else { //ถ้าไม่มีการส่งคำสั่ง
                if ($numBankrupt > 0) { //มีคนติดล้มเเละ ไม่มีการทำคำสั่งต้องล็อคทรัพย์ที่ไม่มีการส่งคำสั่ง
                    unset($ArraySql);
                    $ArraySql['work'] = [
                        'CFC_CAPTION_GEN' => $CFC_CAPTION_GEN,
                        'IS_OWNER_BANKRUPT' => '1',
                        'LOCK_CONFISCATE_FLAG' => '1',
                        'LOCK_SELL_FLAG' => '1',
                        'LOCK_ACCOUNTING_FLAG' => '1',
                    ];
                    $DataA = $this->CurlLock_LED_SERVICE($ArraySql);
                }
                /*       if ($numRevive > 0) {
                    unset($ArraySql);
                    $ArraySql['work'] = [
                        'CFC_CAPTION_GEN' => $CFC_CAPTION_GEN,
                        'IS_OWNER_REVIVE' => '1',
                        'LOCK_CONFISCATE_FLAG' => '1',
                        'LOCK_SELL_FLAG' => '1',
                        'LOCK_ACCOUNTING_FLAG' => '1',
                    ];
                    $DataB = $this->CurlLock_LED_SERVICE_REVIVE($ArraySql);
                } */
            }
        }
        $AR = [
            "numBankrupt" => $DataA,
            "Bankrupt" => $numBankrupt,
            "numRevive" => $DataB,
            "Revive" => $numRevive,
        ];
        return $AR;
    }

    public function cutIdcardOutCaption($idcardInCaption)
    {
        //idcardInCaption 13หลักของคนที่อยู่ในทรัพย์
        //ตัด Idcard ของคนที่อยู่ในทรัพย์ออก เอาเเต่13 หลักของคนไม่เกี่ยวกับทรัพย์
        $IdCard1 = [];
        foreach ($idcardInCaption as $AA1 => $BB1) { //13หลัก ของคนที่อยู่ในทรัพย์ 
            foreach ($BB1 as $AA2 => $BB2) {
                foreach ($BB2 as $AA3 => $BB3) {
                    $IdCard1[$BB3] = $BB3;
                };
            };
        };
        $IdCard1 = array_values($IdCard1);
        $IdCard2 = checkMain::REGISTER_CODE_13_CIVIL($this->PCC_CIVIL_GEN, "", ""); //13หลัก ของคนในคดีทุกคน
        $IdCard2 = explode(",", $IdCard2);
        $A = array_diff($IdCard2, $IdCard1); //คัดคนที่ซ้ำออก
        return $A;
    }

    public static function pccCaseGenConvertCfcCaption($pccCaseGen)
    {
        $ArraySql['proc'] = 'pccCaseGenConvertCfcCaption';
        $ArraySql['pccCaseGen'] = $pccCaseGen;
        //self::curl('LedServiceCustom.php',$ArraySql,'Y');
        $data_string = json_encode($ArraySql);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://103.40.146.73/LedServiceCustom.php',
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
        return $dataReturn;
    }

    //ส่งdpdCivilTrnGen เพื่อเอา CFC_CAPTION
    public static function DPD_GET_CFC_CAPTION($dpdCivilTrnGen)
    {
        $ArraySql['proc'] = 'DPD_GET_CFC_CAPTION';
        $ArraySql['dpdCivilTrnGen'] = $dpdCivilTrnGen;
        $data_string = json_encode($ArraySql);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://103.40.146.73/LedServiceCustom.php',
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
        return $dataReturn;
    }

    public static function DATA_CFC_CAPTION($cfcCaptionGen)
    {
        $ArraySql['proc'] = 'DATA_CFC_CAPTION';
        $ArraySql['CFC_CAPTION_GEN'] = $cfcCaptionGen;
        $data_string = json_encode($ArraySql);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://103.40.146.73/LedServiceCustom.php',
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
        return $dataReturn;
    }

    public static function convertCaptionToPccCivil($CFC_CAPTION_GEN)
    {
        //แปลงCFC_CAPTION เป็น PccCivilGen
        $sql = " SELECT a.CIVIL_CODE FROM WH_CIVIL_CASE a
        JOIN WH_CIVIL_CASE_ASSETS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID
        WHERE b.CFC_CAPTION_GEN ='" . $CFC_CAPTION_GEN . "'
        GROUP BY a.CIVIL_CODE ";
        $query = db::query($sql);
        $row = db::fetch_array($query);
        return $row['CIVIL_CODE'];
    }


    //ใช้เฉพาะบ็อคโจทก์ สามารถล็อคให้ติดล้มได้
    public static function UPDATE_CFC_CAPTION_MANUAL($CFC_CAPTION, $IS_OWNER_BANKRUPT, $LOCK_CONFISCATE_FLAG, $LOCK_SELL_FLAG, $LOCK_ACCOUNTING_FLAG, $IS_OWNER_REVIVE)
    {
        $ArraySql['proc'] = 'UPDATE_CFC_CAPTION_MANUAL';
        $ArraySql['work'][1] = [
            'CFC_CAPTION_GEN' => $CFC_CAPTION,

            'LOCK_CONFISCATE_FLAG' => $LOCK_CONFISCATE_FLAG,
            'LOCK_SELL_FLAG' => $LOCK_SELL_FLAG,
            'LOCK_ACCOUNTING_FLAG' => $LOCK_ACCOUNTING_FLAG,
        ];
        if (!empty($IS_OWNER_BANKRUPT)) {
            $ArraySql['work'][1]['IS_OWNER_BANKRUPT'] = $IS_OWNER_BANKRUPT;
        }
        if (!empty($IS_OWNER_REVIVE)) {
            $ArraySql['work'][1]['IS_OWNER_REVIVE'] = $IS_OWNER_REVIVE;
        }


        $data_string = json_encode($ArraySql);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://103.40.146.73/LedServiceCustom.php',
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
        return $dataReturn;
    }

    //ใช้ในการupdate CFC_CAPTION ให้ทำงานต่อได้หรือไม่
    public static function UPDATE_CFC_CAPTION_FOR_CMD($CFC_CAPTION, $LOCK_CONFISCATE_FLAG, $LOCK_SELL_FLAG, $LOCK_ACCOUNTING_FLAG)
    {

        $ArraySql['proc'] = 'UPDATE_CFC_CAPTION_FOR_CMD';
        $ArraySql['work'][1] = [
            'CFC_CAPTION_GEN' => $CFC_CAPTION,
            /* 'IS_OWNER_BANKRUPT' => '1', */
            'LOCK_CONFISCATE_FLAG' => $LOCK_CONFISCATE_FLAG,
            'LOCK_SELL_FLAG' => $LOCK_SELL_FLAG,
            'LOCK_ACCOUNTING_FLAG' => $LOCK_ACCOUNTING_FLAG,
        ];

        $data_string = json_encode($ArraySql);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://103.40.146.73/LedServiceCustom.php',
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
        return $dataReturn;
    }



    //ส่งCFC_CAPTIOP ไปค้นหา13หลักในทรัพย์นั้น
    public static function selectCfcCaption($cfcCaptionGen)
    {
        $array_ = [
            "cfcCaptionGen" => $cfcCaptionGen
        ];
        $data_string = json_encode($array_);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://103.40.146.73/LedService.php/SELECT_CFC_CAPTION',
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
        return $dataReturn;
    }
    public static function DATA_CFCCAPTION_FROM_SHR($shr_case_gen)
    {
        $ArraySql['proc'] = 'DATA_CFCCAPTION_FROM_SHR';
        $ArraySql['shr_case_gen'] = $shr_case_gen;
        $data_string = json_encode($ArraySql);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://103.40.146.73/LedServiceCustom.php',
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
        return $dataReturn;
    }
    public static function pccCivilGetIdcardForAsset($PCC_CIVIL_GEN)
    {
        $array_ = [
            "PCC_CIVIL_GEN" => $PCC_CIVIL_GEN
        ];
        $data_string = json_encode($array_);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://103.40.146.73/LedService.php/pccCivilGetIdcardForAsset',
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
        return $dataReturn;
    }

    public static function checkCfcCaption($array) //ส่งคน(13หลัก) ที่อยู่ในทรัพย์มาตรวจ
    {
        $ArrayCFC = [];
        foreach ($array as $AA1 => $BB1) {
            foreach ($BB1 as $AA2 => $BB2) {
                $AA2; //CFC_CAPTION_GEN;
                $i = 0;
                foreach ($BB2 as $AA3 => $BB3) {
                    if ((bankrupt::checkPersonBanrupt($BB3, 'จำเลย')) >= 1) { //หาเเต่คนที่สถานะจำเลย
                        $i++;
                    }
                }
                $ArrayCFC[$AA2] = $i;
            }
        }
        $i = 0;
        foreach ($ArrayCFC as $CC1 => $DD1) { //รายการ
            if ($DD1 > 0) { //เมื่อเจอคนติดล้มละลาย
                $i++;
            } else { //สำหรับไม่ติดล้ม
            }
        }
        return $i;
    }


    //ล็อคทรัพย์เมื่อมีการตรวจเจอคนติดล้มครั้งเเรก
    public static function LockCFC_CAPTION($array)
    {
        $arrayPersonBankrupt = [];
        $ArrayCFC = [];
        foreach ($array as $AA1 => $BB1) {
            foreach ($BB1 as $AA2 => $BB2) {
                $AA2; //CFC_CAPTION_GEN;
                $i = 0;
                $r = 0;
                foreach ($BB2 as $AA3 => $BB3) {
                    if ((bankrupt::checkPersonBanrupt($BB3, 'จำเลย')) >= 1) { //หาเเต่คนที่สถานะจำเลย
                        $i++;
                    }
                    //เมื่อเจอคนติดล้มละลาย
                    //checkOrderRevive จะเช็คว่ามีการทำคำสั่งก่อนถ้าคำสั่ง=0 จะทำการล็อคทรัพย์ในเเพ่ง
                    if (revive::checkPersonRevive(result_array($BB3), 'จำเลย,ลูกหนี้') > 0) {
                        unset($Array);
                        $Array = [
                            "CFC_CAPTION_GEN" => $AA2,
                            "ID_CARD" => $BB3,
                        ];
                        $checkOrderRevive = revive::checkOrderRevive($Array);
                        if ($checkOrderRevive == '0') {
                            $r++;
                        }
                    }
                }
                $ArrayBankRupt[$AA2] = $i;
                $ArrayRevive[$AA2] = $r;
            }
        }
        //$ArraySql['proc'] = 'UPDATE_CFC_CAPTION';
        foreach ($ArrayBankRupt as $CC1 => $DD1) { //รายการ
            if ($DD1 > 0) {
                $ArraySql['work'] = [
                    'CFC_CAPTION_GEN' => $CC1,
                    'IS_OWNER_BANKRUPT' => '1',
                    'LOCK_CONFISCATE_FLAG' => '1',
                    'LOCK_SELL_FLAG' => '1',
                    'LOCK_ACCOUNTING_FLAG' => '1',
                ];
                $Lock = new civil();
                $DataA = $Lock->CurlLock_LED_SERVICE($ArraySql);
            } else {
                /*   $ArraySql['work'][] = [
                    'CFC_CAPTION_GEN' => $CC1,
                    'IS_OWNER_BANKRUPT' => '0',
                    'LOCK_CONFISCATE_FLAG' => '',
                    'LOCK_SELL_FLAG' => '',
                    'LOCK_ACCOUNTING_FLAG' => '',
                ]; */
            }
        }
        foreach ($ArrayRevive as $CC1 => $DD1) { //รายการ
            if ($DD1 > 0) {
                unset($ArraySql);
                $ArraySql['work'] = [
                    'CFC_CAPTION_GEN' => $CC1,
                    'IS_OWNER_REVIVE' => '1',
                    'LOCK_CONFISCATE_FLAG' => '1',
                    'LOCK_SELL_FLAG' => '1',
                    'LOCK_ACCOUNTING_FLAG' => '1',
                ];
                $LockRevive = new civil();
                $DataB = $LockRevive->CurlLock_LED_SERVICE_REVIVE($ArraySql);
            }
        }
        $returnData = [
            "numBankrupt" => $DataA,
            "Bankrupt" => $ArrayBankRupt[$AA2],
            "numRevive" => $DataB,
            "Revive" => $ArrayRevive[$AA2],
        ];
        return $returnData;
    }

    public static function getPccCivilGen($post)
    {

        //start
        if ($post["_currentPccCivil"]) {
            $pccCivilGen = $post["_currentPccCivil"];
        } else  if ($post["pccCivilGen"]) {
            $pccCivilGen = $post["pccCivilGen"];
        } elseif ($post["shrCaseGen"]) {
            $pccCivilGen = self::convertShrCaseGenToPccCivilGen($post["shrCaseGen"]);
        } elseif ($post["pccCaseGen"]) {
            $pccCivilGen = self::convertPccCivilCaseToPccCivilGen($post["pccCaseGen"]);
        } elseif ($post["dpdCivilTrnGen"]) {
            $pccCivilGen = self::ConvertDpdCivilTrnGenToPccCivilGen($post["dpdCivilTrnGen"]);
        }

        return $pccCivilGen;
    }
    public static function AUC_ASSET_GEN_CFC_CAPTION($aucSubOrderGen)
    {
        $ArraySql['proc'] = 'AUC_ASSET_GEN_CFC_CAPTION';
        $ArraySql['aucSubOrderGen'] = $aucSubOrderGen;
        $data_string = json_encode($ArraySql);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://103.40.146.73/LedServiceCustom.php',
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
        return $dataReturn;
    }

    public static function convertPccCivilCaseToPccCivilGen($PCC_CASE_GEN)
    {
        $array_dpdCivilTrnGen = [
            "PCC_CASE_GEN" => $PCC_CASE_GEN
        ];
        $data_string = json_encode($array_dpdCivilTrnGen);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://103.40.146.73/LedService.php/convertPccCivilCaseToPccCivilGen',
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
        return $PCC_CIVIL_GEN;
    }
    public static function convertShrCaseGenToPccCivilGen($ShrCaseGen)
    {
        $array_ = [
            "ShrCaseGen" => $ShrCaseGen
        ];
        $data_string = json_encode($array_);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://103.40.146.73/LedService.php/convertShrCaseGenToPccCivilGen',
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
        return $PCC_CIVIL_GEN;
    }

    public static function ConvertDpdCivilTrnGenToPccCivilGen($dpdCivilTrnGen)
    {
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
        return $PCC_CIVIL_GEN;
    }
    public static function checkPersonMountBankrupt($PccCivil, $concernCivil, $concernBankrupt) //ตรวจสอบคนในเเพ่งติดในล้มละลาย (PccCivil,"โจทก์,จำเลย หรือถ้าไม่ใส่ เท่ากับเอาทั้งหมด")
    {
        $arrayPerson = array();
        $arrayPerson = self::getDataPerson("1", $PccCivil);
        $arrayConcernCivil = explode(",", $concernCivil); //แปลงข้อมูล เป็นarray เพื่อเช็คค่า

        $idCard = "";
        foreach ($arrayPerson as $AA => $AB) {
            if (empty($concernCivil)) { //ถ้าเท่ากับค่าว่าง คือเอาทุกสถานะ
                $idCard .= $AB['REGISTER_CODE'] . ",";
            } else {
                if (in_array($AB['CONCERN_NAME'], $arrayConcernCivil)) {
                    $idCard .= $AB['REGISTER_CODE'] . ",";
                }
            }
        }

        if (!empty($concernBankrupt)) {
            $concernBankrupt = "AND a.CONCERN_NAME  IN (" . result_array($concernBankrupt) . ")";
        }
        $sql = "SELECT *FROM WH_BANKRUPT_CASE_PERSON a 
        WHERE a.REGISTER_CODE IN (" . result_array(cut_last_comma($idCard)) . ")
        {$concernBankrupt}
        ";
        $query = db::query($sql);
        $num = 0;
        $array_data = array();
        while ($row = db::fetch_array($query)) {
            $num++;
            $array_data[] = $row;
        }
        return $num;
    }

    public static function checkIdCardToBankrupt($idCard, $concernBankrupt)
    {
        //ส่ง 13 หลัก เข้ามาตรวจที่ล้มละลาย
        //("13หลักคนที่ส่งมาตรวจ","ส่งมาตรวจที่สถานะล้มอะไร")
        if (!empty($concernBankrupt)) {
            $concernBankrupt = "AND a.CONCERN_NAME  IN (" . result_array($concernBankrupt) . ")";
        }
        $sql = "SELECT *FROM WH_BANKRUPT_CASE_PERSON a 
        WHERE a.REGISTER_CODE IN (" . result_array($idCard) . ")
        {$concernBankrupt}
        ";
        $query = db::query($sql);
        $num = 0;
        $array_data = array();
        while ($row = db::fetch_array($query)) {
            $num++;
            $array_data[] = $row;
        }
        //  return $sql; //ส่ง ข้อมูลของคนที่ล้มละลายกลับมา
        return $num; //ส่งจำนวนคนที่ติดล้มละลายกลับไป
    }
    public static function get_query_plateNo($plateNo, $webuibidDate, $centDeptGen)
    {
        $array = [
            "plateNo" => $plateNo,
            "webuibidDate" => $webuibidDate,
            "centDeptGen" => $centDeptGen
        ];
        $data_string = json_encode($array);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://103.40.146.73/LedService.php/getQueryPlateNo',
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
        // $response=json_decode($response);
        $idCard = "";
        $arrayData = json_decode($response, true);
        foreach ($arrayData as $A1 => $B1) {
            foreach ($B1 as $A2 => $B2) {
                $idCard .= $B2['CARD_ID'] . ",";
            }
        }
        curl_close($curl);
        return $idCard;
    }

    public static function conWhere($A = "")
    {
        $array = explode(" ", $A);
        $fill = "";
        foreach ($array as $key => $value) {
            if (is_string($value) && strpos($value, "ตำบล") !== false) {
                $DISTRICT = str_replace("ตำบล", "", $value);
                $fill .= "AND b.DISTRICT_NAME like '%" . $DISTRICT . "%'";
            }
            if (is_string($value) && strpos($value, "อำเภอ") !== false) {
                $AMPHUR_NAME = str_replace("อำเภอ", "", $value);
                $fill .= "AND b.AMPHUR_NAME like '%" . $AMPHUR_NAME . "%'";
            }
            if (is_string($value) && strpos($value, "จังหวัด") !== false) {
                $PROVINCE_NAME = str_replace("จังหวัด", "", $value);
                $fill .= "AND b.PROVINCE_NAME like'%" . $PROVINCE_NAME . "%'";
            }
        }
        return $fill;
    }



    public static function checkAssetInCivil($PCC_CIVIL_GEN = "") //ตรวจทรัพย์ที่ซ้ำ
    {
        $arr_system = [
            "BANKRUPT" => "คดีล้มละลาย",
            "CIVIL" => "คดีแพ่ง"
        ];
        $array_Pcc = [];
        $arraySystem = [];
        $sqlSelectData = "	SELECT a.PREFIX_BLACK_CASE ,a.BLACK_CASE ,a.BLACK_YY ,
                                                                        a.PREFIX_RED_CASE ,a.RED_CASE ,a.RED_YY,
                                                                        b.WH_ASSET_ID ,b.ASSET_ID ,b.PROP_TITLE 
                                            FROM WH_CIVIL_CASE a
                                            JOIN WH_CIVIL_CASE_ASSETS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
                                            WHERE  a.CIVIL_CODE = '" . $PCC_CIVIL_GEN . "'";

        $query_PCC = db::query($sqlSelectData);
        while ($rec_pcc = db::fetch_array($query_PCC)) {
            $array_Pcc[] = $rec_pcc;
        }

        $k = 0;
        $array_sql = [];
        $arrayAlert = array();
        $total_num = "";
        foreach ($arr_system as $sys => $sys_name) {
            $k++;
            $num_Pcc_Arr = 0;
            foreach ($array_Pcc as $Apcc => $Bpcc) {
                $sqlSelectDataALL_e = "";
                //echo $Bpcc['PROP_TITLE'] . "<br>";
                $num_Pcc_Arr++;
                if (LikeArray($Bpcc['PROP_TITLE'], 'TABLE_DETAIL') != "") {
                    if ($PCC_CIVIL_GEN != "" && $sys == 'CIVIL') { //ไม่เอาคดีตัวเอง
                        $CIVIL_GEN = "AND a.CODE_API !='" . $PCC_CIVIL_GEN . "'";
                    }
                    $LikeArray = LikeArray($Bpcc['PROP_TITLE'], 'TABLE_DETAIL');
                    $conWhere = self::conWhere($Bpcc['PROP_TITLE']);
                    $sqlSelectDataALL_e = "SELECT  a.WH_ASSET_ID ,
                                                        a.ASSET_ID as ASSET_CODE,
                                                        a.TABLE_DETAIL as PROP_TITLE,
                                                        a.PREFIX_BLACK_CASE ,
                                                        a.BLACK_CASE ,
                                                        a.BLACK_YY ,
                                                        a.PREFIX_RED_CASE 
                                                        ,a.RED_CASE ,
                                                        a.RED_YY ,
                                                        a.TYPE_ASSET ,
                                                        a.COURT_CODE,
                                                        a.PROP_STATUS_NAME,
                                                        a.CODE_API FROM WH_ALL_ASSETS_MAIN a
                                                        LEFT JOIN VIEW_WH_ALL_ASSET_DETAIL b ON a.ASSET_ID =b.WH_ASSET_ID AND a.SYSTEM_TYPE ='Civil'
                                                        WHERE 1=1 
                                                        AND a.TYPE_ASSET ='" . $sys . "' 
                                                        AND (a.PROP_STATUS_NAME IS NOT NULL OR a.PROP_STATUS_NAME !='')
                                                        {$CIVIL_GEN}{$LikeArray}{$conWhere}";
                }
                $array_sql[$sys][$num_Pcc_Arr] = $sqlSelectDataALL_e;
                $query_SelectDataALL_e = db::query($array_sql[$sys][$num_Pcc_Arr]);
                $array_num = 0;
                // print_r($array_sql);
                //$array_data_Assets[$sys][$num_Pcc_Arr][$array_num]['ASSET_ID'] = $recSelectDataAll['ASSET_ID'];
                //การทำงานคำ เก็บไว้ในระบบอะไร sys เเละ ตำเเหน่งของ sql เเละ array_num(วนค่าเมื่อเจอข้อมูลซ้ำกัน)
                while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e)) {
                    $total_num++;
                    //$arrayAlert[$sys][$num_Pcc_Arr][$array_num] = $recSelectDataAll;
                    $arrayAlert[] = [
                        "WH_ASSET_ID" =>  $recSelectDataAll['WH_ASSET_ID'],
                        "CODE_API" =>  $recSelectDataAll['CODE_API'],
                        "TYPE_ASSET" =>  $recSelectDataAll['TYPE_ASSET'],
                        "PROP_STATUS_NAME" =>  $recSelectDataAll['PROP_STATUS_NAME'],
                        "SYSTEM_ID" =>  $sys,
                    ];
                    $arraySystem[$sys] = $sys;
                    $array_num++;
                }
            }
        }
        return $arrayAlert;
    }
    public $DossData_getDossForAssets = [];
    public $DossData_getDoss = [];
    public function convert_getDossForAssets($SYSTEM, $Assets)
    {
        if ($SYSTEM == 'BANKRUPT' || $SYSTEM == 'Bankrupt' || $SYSTEM == '2') {
            $B = '2';
        } else if ($SYSTEM == 'CIVIL' || $SYSTEM == 'Civil' || $SYSTEM == '1') {
            $B = '1';
            $sql = "SELECT b.* FROM WH_CIVIL_CASE_ASSETS a 
            JOIN WH_CIVIL_DOSS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
            WHERE a.CFC_CAPTION_GEN ='" . $Assets . "'";
            $query = db::query($sql);
            $rec = db::fetch_array($query);
            $this->DossData_getDossForAssets = $rec;
        }
    }
    public function getDoss($SYSTEM, $CODE_API)
    {
        if ($SYSTEM == 'BANKRUPT' || $SYSTEM == 'Bankrupt' || $SYSTEM == '2') {
            $B = '2';
            $sql = "SELECT a.DOSS_OWNER_ID ,a.DOSS_OWNER_NAME ,a.BANKRUPT_CODE AS CODE_API ,a.WH_BANKRUPT_ID AS WH_ID 
                    FROM WH_BANKRUPT_CASE_DETAIL a
                    WHERE a.BANKRUPT_CODE = '" . $CODE_API . "' ";
            $query = db::query($sql);
            $rec = db::fetch_array($query);
            $this->DossData_getDoss = $rec;
        }
        if ($SYSTEM == 'CIVIL' || $SYSTEM == 'Civil' || $SYSTEM == '1') {
            $B = '1';
            $sql = "SELECT b.* FROM WH_CIVIL_CASE a 
            JOIN WH_CIVIL_DOSS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
            WHERE a.CIVIL_CODE ='" . $CODE_API . "'";
            $query = db::query($sql);
            $rec = db::fetch_array($query);
            $this->DossData_getDoss = $rec;
        }
        if ($SYSTEM == 'MEDIATE' || $SYSTEM == 'Mediate' || $SYSTEM == '4') {
            $B = '4';
        }
        if ($SYSTEM == 'REVIVE' || $SYSTEM == 'Revive' || $SYSTEM == '3') {
            $B = '3';
        }
    }
    //เเจ้งเตือน เมื่อมีทรัพย์ซ้ำ
    public static function alertAssetsRepeatCivilToBankrupt_lock_new($PCC_CIVIL_GEN = "", $toPersonId = "")
    {
        $AssetCivil = new Asset_();
        $AssetCivil->CIVIL_CODE = $PCC_CIVIL_GEN;

        //คดีต้นทางของเเพ่ง นำเก็บในตัวแปรให้ searchDataCivilToCivil
        $Array_Data_Civil = ($AssetCivil->DataAssetCivil());

        //แพ่งไปแพ่ง
        $Array_CivilToCivil = ($AssetCivil->searchDataCivilToCivil());
        //เเพ่งไปล้ม (ยังไม่เสร็จดี)
        $Array_CivilToBankrupt = ($AssetCivil->searchDataCivilToBankrupt());

        //ข้อมูลที่ตรวจพบเจอ
        $ArrayDetectedInformation = [];
        $ArrayDetectedInformation = [
            "CIVIL" => [
                "CIVIL_TO_CIVIL" => $Array_CivilToCivil,
                "CIVIL_TO_BANKRUPT" => $Array_CivilToBankrupt,
            ]
        ];
        $arr_system = array(
            "CIVIL" => "คดีแพ่ง"
        );

        //เช็คว่ามีทรัพย์ที่ตรวจซ้ำเจอหรือไม่
        foreach ($arr_system as $sys => $sys_name) {
            $n = 0;
            foreach ($ArrayDetectedInformation[$sys] as $AA1 => $BB1) {
                foreach ($BB1 as $AA2 => $BB2) {
                    foreach ($BB2 as $AA3 => $BB3) {
                        $n += count($BB3);
                    }
                }
            }
            $CIVIL = empty($n) ? 0 : $n;
        }

        //เจอคดีที่ซ้ำ
        if ($CIVIL > 0) {
            $numTotalAsset = 0;
            $rec_re = main_case::CaseInformation('1', $AssetCivil->CIVIL_CODE);
            $text = "คดีดำ" . $rec_re['PREFIX_BLACK_CASE'] . $rec_re['BLACK_CASE'] . "/" . $rec_re['BLACK_YY'] . "  คดีแดง" . $rec_re['PREFIX_RED_CASE'] . $rec_re['RED_CASE'] . "/" . $rec_re['RED_YY'];
            foreach ($ArrayDetectedInformation['CIVIL'] as $AA1 => $BB1) {
                foreach ($BB1 as $AA2 => $BB2) {
                    $CFC_CAPTION = $AA2;
                    foreach ($BB2 as $AA3 => $BB3) {
                        foreach ($BB3 as $AA4 => $BB4) {
                            $numTotalAsset++;

                            //ถ้าทรัพย์ มีสถานะในเเพ่งจึงจะทำการเเจ้งเตือนเเละล็อคทรัพย์
                            if (!empty($BB4['PROP_STATUS_NAME'])) {
                                //คดีปลายทางที่เจอซ้ำ
                                $text2 = "คดีดำ" . $BB4['PREFIX_BLACK_CASE'] . $BB4['BLACK_CASE'] . "/" . $BB4['BLACK_YY'] . "  คดีแดง" . $BB4['PREFIX_RED_CASE'] . $BB4['RED_CASE'] . "/" . $BB4['RED_YY'];
                                //$Text3 = "ตรวจพบทรัพย์ซ้ำในคดีเเพ่ง " . $text . "ซ้ำในคดี " . $text2;
                                $Text3 = "มีการตรวจพบทรัพย์ " . $BB4['PROP_TITLE'] . " ถูก " . $BB4['PROP_STATUS_NAME'] . " ไว้ ที่ " . $BB4['COURT_NAME'] . " " . $text2;
                                $sql_check = "SELECT *FROM M_ALERT_NOTIFICATION a 
                                                WHERE 1=1 
                                                AND a.NOTE ='" . $Text3 . "'
                                                AND a.ID_CARD_SEND='" . $toPersonId . "'";
                                $query_check = db::query($sql_check);
                                $num_check = db::num_rows($query_check);
                                if ($num_check == 0) {
                                    unset($fields);
                                    //เป็นการ ตรวจAuto ด้วยระบบตัวเอง ส่งทรัพย์ไปตรวจที่ระบบเเพ่งเเละล้มละลาย
                                    //ถ้าเจอจะทำการล็อคทรัพย์ ตัวนั้นในคดีตัวเอง
                                    //ระบบจะทำการล็อคทรัพย์ เเละเเจ้งเตือนที่ตัวเองว่าไปเจอทรัพย์ซ้ำอยู่ที่ใหน
                                    if ($AA1 == 'CIVIL_TO_CIVIL') {
                                        $SYSTEM_TYPE_RECEIVE = 1;
                                        $CODE_API = $BB4['CIVIL_CODE'];
                                    } else if ($AA1 == 'CIVIL_TO_BANKRUPT') {
                                        $SYSTEM_TYPE_RECEIVE = 2;
                                        $CODE_API = $BB4['BANKRUPT_CODE'];
                                    }

                                    //ทำการล็อคทรัพย์
                                    $LOCK_CONFISCATE_FLAG = "1";
                                    $LOCK_SELL_FLAG = "1";
                                    $LOCK_ACCOUNTING_FLAG = "1";
                                    civil::UPDATE_CFC_CAPTION_FOR_CMD($CFC_CAPTION, $LOCK_CONFISCATE_FLAG, $LOCK_SELL_FLAG, $LOCK_ACCOUNTING_FLAG);

                                    $DataA = new civil;
                                    $DataA->convert_getDossForAssets($SYSTEM_TYPE_RECEIVE, $CFC_CAPTION);
                                    $fields["CREATE_DATE"]              =     date('Y-m-d'); //วันที่สร้าง
                                    $fields["CREATE_TIME"]              =     date('H:i:s'); //เวลาที่สรา้ง
                                    $fields["SEND_CODE_ID"]             =     $CODE_API; //IDของคดีที่เรียกapi ของผู้ส่ง pccCivilGen ,brc_id //มาจาก api
                                    $fields["SYSTEM_TYPE_SEND"]         =     $SYSTEM_TYPE_RECEIVE; //ส่งจากระบบ 1=เเพ่ง 2=ล้มละลาย
                                    $fields["ID_CARD_SEND"]             =     $toPersonId; //13หลักของผู้ทำรายการในขณะนั้น 
                                    $fields["DOSS_OWNER_ID_F"]            =   $DataA->DossData_getDossForAssets['DOSS_OWNER_ID'];  //IDของเจ้าของคดี
                                    $fields["DOSS_OWNER_NAME_F"]          =   $DataA->DossData_getDossForAssets['DOSS_OWNER_NAME'];  //ชื่อเจ้าของคดีฝั่งรับ

                                    ///ฝั่งรับ
                                    $DataB = new civil;
                                    $DataB->getDoss('1', $AssetCivil->CIVIL_CODE);
                                    $fields["DOSS_OWNER_ID"]            =     $DataB->DossData_getDoss['DOSS_OWNER_ID']; //IDของเจ้าของคดี
                                    $fields["DOSS_OWNER_NAME"]          =     $DataB->DossData_getDoss['DOSS_OWNER_NAME']; //ชื่อเจ้าของคดีฝั่งรับ
                                    $fields["WH_ASSET_ID"]              =     ""; //IDของทรัพย์ที่ซ้ำ
                                    $fields["CFC_CAPTION_GEN"]          =     $CFC_CAPTION; //CFC_CAPTION_GEN
                                    $fields["NOTE"]                     =     $Text3; //ข้อความที่เเสดงในการเเจ้งเตือน
                                    $fields["RECEIVE_CODE_ID"]          =     $AssetCivil->CIVIL_CODE; //IDของคดีที่เรียกapi ของผู้รับ
                                    $fields["SYSTEM_TYPE_RECEIVE"]      =     $SYSTEM_TYPE_RECEIVE; //ระบบที่รับ system_($ss)
                                    $fields["STATUS"]                   =     "DoubleASSETS"; //สถานะเป็นทรัพย์หรือเป็นคน
                                    db::db_insert("M_ALERT_NOTIFICATION", $fields, 'ID_ALERT', 'ID_ALERT');
                                    $data['M_ALERT_NOTIFICATION'][] = $fields;
                                }
                            }
                        }
                    }
                }
            }
        }
        return $Array_Data_Civil;
    }
    public static function alertAssetsRepeatCivilToBankrupt_lock($PCC_CIVIL_GEN = "", $toPersonId = "")
    {
        $arr_system = [
            "BANKRUPT" => "คดีล้มละลาย",
            "CIVIL" => "คดีแพ่ง"
        ];
        $array_Pcc = [];
        $arraySystem = [];
        $sqlSelectData = "	SELECT a.PREFIX_BLACK_CASE ,a.BLACK_CASE ,a.BLACK_YY ,
                                                                        a.PREFIX_RED_CASE ,a.RED_CASE ,a.RED_YY,
                                                                        b.WH_ASSET_ID ,b.ASSET_ID ,b.PROP_TITLE 
                                            FROM WH_CIVIL_CASE a
                                            JOIN WH_CIVIL_CASE_ASSETS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
                                            WHERE  a.CIVIL_CODE = '" . $PCC_CIVIL_GEN . "'";

        $query_PCC = db::query($sqlSelectData);
        while ($rec_pcc = db::fetch_array($query_PCC)) {
            $array_Pcc[] = $rec_pcc;
        }

        $k = 0;
        $array_sql = [];
        $arrayAlert = array();
        $total_num = "";
        foreach ($arr_system as $sys => $sys_name) {
            $k++;
            $num_Pcc_Arr = 0;
            foreach ($array_Pcc as $Apcc => $Bpcc) {
                $sqlSelectDataALL_e = "";
                //echo $Bpcc['PROP_TITLE'] . "<br>";
                $num_Pcc_Arr++;
                if (LikeArray($Bpcc['PROP_TITLE'], 'TABLE_DETAIL') != "") {

                    if ($PCC_CIVIL_GEN != "") {
                        $CIVIL_GEN = "AND a.CODE_API !='" . $PCC_CIVIL_GEN . "'";
                    }
                    $sqlSelectDataALL_e = "SELECT  a.WH_ASSET_ID ,
                                                        a.ASSET_ID as ASSET_CODE,
                                                        a.TABLE_DETAIL as PROP_TITLE,
                                                        a.PREFIX_BLACK_CASE ,
                                                        a.BLACK_CASE ,
                                                        a.BLACK_YY ,
                                                        a.PREFIX_RED_CASE 
                                                        ,a.RED_CASE ,
                                                        a.RED_YY ,
                                                        a.TYPE_ASSET ,
                                                        a.COURT_CODE,
                                                        a.PROP_STATUS_NAME,
                                                        a.CODE_API FROM WH_ALL_ASSETS_MAIN a
                                                        LEFT JOIN VIEW_WH_ALL_ASSET_DETAIL b ON a.ASSET_ID =b.WH_ASSET_ID AND a.SYSTEM_TYPE ='Civil'
                                                        WHERE 1=1 
                                                        AND a.TYPE_ASSET ='" . $sys . "' 
                                                        AND (a.PROP_STATUS_NAME IS NOT NULL OR a.PROP_STATUS_NAME !='')
                                                        {$CIVIL_GEN}
                                                        " . LikeArray($Bpcc['PROP_TITLE'], 'TABLE_DETAIL')
                        . self::conWhere($Bpcc['PROP_TITLE']) . "";
                }
                $array_sql[$sys][$num_Pcc_Arr] = $sqlSelectDataALL_e;
                $query_SelectDataALL_e = db::query($array_sql[$sys][$num_Pcc_Arr]);
                $array_num = 0;
                // print_r($array_sql);
                //$array_data_Assets[$sys][$num_Pcc_Arr][$array_num]['ASSET_ID'] = $recSelectDataAll['ASSET_ID'];
                //การทำงานคำ เก็บไว้ในระบบอะไร sys เเละ ตำเเหน่งของ sql เเละ array_num(วนค่าเมื่อเจอข้อมูลซ้ำกัน)
                while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e)) {
                    $total_num++;
                    //$arrayAlert[$sys][$num_Pcc_Arr][$array_num] = $recSelectDataAll;
                    $arrayAlert[] = [
                        "WH_ASSET_ID" =>  $recSelectDataAll['WH_ASSET_ID'],
                        "CODE_API" =>  $recSelectDataAll['CODE_API'],
                        "TYPE_ASSET" =>  $recSelectDataAll['TYPE_ASSET'],
                        "PROP_STATUS_NAME" =>  $recSelectDataAll['PROP_STATUS_NAME'],
                    ];
                    $arraySystem[$sys] = $sys;
                    $array_num++;
                }
            }
        }
        if ($total_num > 0) { //ถ้า total_num มากกว่า 0 เเสดงว่ามีทรัพย์ซ้ำ
            $sql_re = "SELECT a.PREFIX_BLACK_CASE ,a.BLACK_CASE ,a.BLACK_YY ,a.PREFIX_RED_CASE ,a.RED_CASE ,a.RED_YY 
            FROM WH_CIVIL_CASE a WHERE a.CIVIL_CODE ='" . $PCC_CIVIL_GEN . "'";
            $query_re = db::query($sql_re);
            $rec_re = db::fetch_array($query_re);
            $text = "คดีดำ" . $rec_re['PREFIX_BLACK_CASE'] . $rec_re['BLACK_CASE'] . "/" . $rec_re['BLACK_YY'] . "  คดีแดง" . $rec_re['PREFIX_RED_CASE'] . $rec_re['RED_CASE'] . "/" . $rec_re['RED_YY'];

            foreach ($arraySystem as $sh => $ss) { //ทำงานเพื่อดูว่า ระบบงานคดีอะไรบ้างที่มีทรัพย์ซ้ำ
                foreach ($arrayAlert as $ar => $ab) { // วนเอาทรัพย์ที่เก็บไว้ในarray มาใช้ที่ละตัวเเละบันทึกเพื่อเเจ้งเตือน
                    if ($ss = "BANKRUPT") {
                        $sql_array_alert = "SELECT a.WH_ASSET_ID ,a.TABLE_DETAIL ,a.PROP_STATUS_NAME ,
                        a.PREFIX_BLACK_CASE ,a.BLACK_CASE ,a.BLACK_YY ,a.PREFIX_RED_CASE ,a.RED_CASE ,a.RED_YY ,
                        a.TYPE_ASSET 
                        FROM WH_ALL_ASSETS_MAIN a WHERE a.WH_ASSET_ID ='" . $ab['WH_ASSET_ID'] . "' AND a.CODE_API ='" . $ab['CODE_API'] . "' AND a.TYPE_ASSET ='" . $ss . "'";
                    }
                    if ($ss = "CIVIL") {
                        $sql_array_alert = "SELECT a.WH_ASSET_ID ,a.TABLE_DETAIL ,a.PROP_STATUS_NAME ,
                        a.PREFIX_BLACK_CASE ,a.BLACK_CASE ,a.BLACK_YY ,a.PREFIX_RED_CASE ,a.RED_CASE ,a.RED_YY ,
                        a.TYPE_ASSET 
                        FROM WH_ALL_ASSETS_MAIN a WHERE a.WH_ASSET_ID ='" . $ab['WH_ASSET_ID'] . "' AND a.CODE_API ='" . $ab['CODE_API'] . "' AND a.TYPE_ASSET ='" . $ss . "'";
                    }
                    $query_array_alert = db::query($sql_array_alert);
                    $r_B = db::fetch_array($query_array_alert);
                    $text2 = "คดีดำ" . $r_B['PREFIX_BLACK_CASE'] . $r_B['BLACK_CASE'] . "/" . $r_B['BLACK_YY'] . "  คดีแดง" . $r_B['PREFIX_RED_CASE'] . $r_B['RED_CASE'] . "/" . $r_B['RED_YY'] .
                        " ID " . $r_B['WH_ASSET_ID'] . $r_B['TABLE_DETAIL'];
                    $Text_1 = "ตรวจพบทรัพย์ซ้ำในคดีเเพ่ง " . $text . "ซ้ำในคดี " . $text2;
                    //คิวรี่ตัวสอบว่ามีการเเจ้งเตือนซ้ำหรือไม่
                    $sql_check = "SELECT *FROM M_ALERT_NOTIFICATION a 
                    WHERE 1=1 
                    AND a.SEND_CODE_ID ='" . $PCC_CIVIL_GEN . "'
                    AND a.WH_ASSET_ID ='" . $ab['WH_ASSET_ID'] . "'
                    AND a.NOTE ='" . $Text_1 . "'
                    AND a.RECEIVE_CODE_ID ='" . $ab['CODE_API'] . "'
                    AND a.SYSTEM_TYPE_RECEIVE ='" . system_($ss) . "'";
                    $query_check = db::query($sql_check);
                    $num_check = db::num_rows($query_check);

                    if ($num_check == 0) {
                        if (!empty($ab['WH_ASSET_ID'])) {
                            //ถ้าทรัพย์ที่ซ้ำมีสถานะหรือไม่เป็นค่าว่างนั้นเอง เช่น ยึดหรืออยู่ระหว่างรอจำหน่าย 
                            //จะทำการlockทรัพย์
                            self::lockPerson($PCC_CIVIL_GEN);
                        }
                        unset($fields);
                        //ฝั่งส่ง ส่งจากเเพ่ง
                        $fields["CREATE_DATE"]         =     date('Y-m-d'); //วันที่สร้าง
                        $fields["CREATE_TIME"]         =     date('H:i:s'); //เวลาที่สรา้ง
                        $fields["SEND_CODE_ID"]         =     $PCC_CIVIL_GEN; //IDของคดีที่เรียกapi ของผู้ส่ง pccCivilGen ,brc_id //มาจาก api
                        $fields["SYSTEM_TYPE_SEND"]         =     "1"; //ส่งจากระบบ 1=เเพ่ง 2=ล้มละลาย 
                        ///ฝั่งรับ รับได้หลายระบบ ล้มละลาย ฟื้นฟู ไกล่เกลี่ย หรือส่งเข้าระบบตัวเอง เเพ่ง
                        $fields["ID_CARD_SEND"]         =     $toPersonId; //13หลักผู้ส่ง //มาจาก api
                        $fields["DOSS_OWNER_ID"]         =     DOSS_OWER($ss, $ab['CODE_API'], "DOSS_OWNER_ID"); //IDของเจ้าของคดี
                        $fields["DOSS_OWNER_NAME"]         =    DOSS_OWER($ss, $ab['CODE_API'], "DOSS_OWNER_NAME"); //ชื่อเจ้าของคดีฝั่งรับ
                        $fields["WH_ASSET_ID"]         =     $ab['WH_ASSET_ID']; //IDของทรัพย์ที่ซ้ำ
                        $fields["NOTE"]         =     $Text_1; //ข้อความที่เเสดงในการเเจ้งเตือน
                        $fields["RECEIVE_CODE_ID"]         =     $ab['CODE_API']; //IDของคดีที่เรียกapi ของผู้รับ
                        $fields["SYSTEM_TYPE_RECEIVE"]         =     system_($ss); //ระบบที่รับ system_($ss)
                        $fields["STATUS"]         =     "ASSETS"; //สถานะเป็นทรัพย์หรือเป็นคน
                        db::db_insert("M_ALERT_NOTIFICATION", $fields, 'ID_ALERT', 'ID_ALERT');
                    }
                }
            }
        }
        return $total_num;
    }

    public static function getAppointmentInCivil($idCard = "", $appointDateStart = '', $appointDateEnd = '')
    {

        $WF_GET_APPOINTMENT_IN_CIVIL = 'http://103.40.146.73/LedServiceCivilById.php/getAppointmant';

        // JSON payload
        $jsonPayload = '{
            "USERNAME":"BankruptDt",
            "PASSWORD":"Debtor4321",
            "showQry":"",
            "idCard":"' . $idCard . '",
            "processDateStart":"",
            "processDateEnd":"",
            "appointDateStart":"' . $appointDateStart . '",
            "appointDateEnd":"' . $appointDateEnd . '"
        }';

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $WF_GET_APPOINTMENT_IN_CIVIL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $jsonPayload,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        if ($response === false) {
            echo 'cURL Error: ' . curl_error($curl);
        } else {
            $dataReturn = json_decode($response, true);
            self::processAndInsertData($dataReturn);
            // return ($dataReturn);
        }

        curl_close($curl);
    }

    public static function processAndInsertData($dataCurl)
    {
        $updateRow = 0;
        $insertRow = 0;

        if ($dataCurl['ResponseCode']['ResCode'] == '000') {
            if (count($dataCurl['Data']['data']) > 0) {
                $dataForInsert = $dataCurl['Data']['data'];

                foreach ($dataForInsert as $val) {
                    unset($fieldInsert, $sqlChk);
                    $MEETING_SDATE = '';
                    $MEETING_EDATE = '';
                    $CREATE_DATE = '';
                    $UPDATE_DATE = '';
                    $MEETING_SDATE_TIME = '';
                    $MEETING_EDATE_TIME = '';
                    $CREATE_DATE_TIME = '';
                    $UPDATE_DATE_TIME = '';
                    if ($val['processDate']) {
                        list($MEETING_SDATE, $MEETING_SDATE_TIME) = explode(' ', $val['processDate']);
                    }
                    if ($val['appointDate']) {
                        list($MEETING_EDATE, $MEETING_EDATE_TIME) = explode(' ', $val['appointDate']);
                    }
                    if ($val['createDate']) {
                        list($CREATE_DATE, $CREATE_DATE_TIME) = explode(' ', $val['createDate']);
                    }
                    if ($val['updateDate']) {
                        list($UPDATE_DATE, $UPDATE_DATE_TIME) = explode(' ', $val['updateDate']);
                    }
                    $fieldInsert['MEETING_TOPIC'] = $val['proceedDesc'];
                    $fieldInsert['MEETING_DETAIL'] = $val['appointMemo'];
                    $fieldInsert['MEETING_SDATE'] = $MEETING_EDATE; //$MEETING_SDATE
                    $fieldInsert['MEETING_SDATE_TIME'] = $MEETING_EDATE_TIME; //$MEETING_SDATE_TIME
                    $fieldInsert['MEETING_EDATE'] = $MEETING_EDATE;
                    $fieldInsert['MEETING_EDATE_TIME'] = $MEETING_EDATE_TIME;
                    $fieldInsert['CREATE_BY_ID_CARD'] = $val['personCode'];
                    $fieldInsert['CREATE_BY_NAME'] = $val['ownerPerfix'] . $val['ownerFname'] . ' ' . $val['ownerLname'];
                    $fieldInsert['CREATE_DATE'] = $CREATE_DATE;
                    $fieldInsert['CREATE_DATE_TIME'] = $CREATE_DATE_TIME;
                    $fieldInsert['APP_PERSON_IDCARD'] = $val['personCode'];
                    $fieldInsert['APP_PERSON_NAME'] = $val['ownerPerfix'] . $val['ownerFname'] . ' ' . $val['ownerLname'];
                    $fieldInsert['MEETING_LOCATION'] = 'กรมบังคับคดี';
                    $fieldInsert['SYSTEM_ID'] = 1;
                    $fieldInsert['CODE_API'] = $val['pccCivilGen'];
                    $fieldInsert['F_ID'] = $val['appointmentGen'];
                    $fieldInsert['UPDATE_DATE'] = $UPDATE_DATE;
                    $fieldInsert['UPDATE_DATE_TIME'] = $UPDATE_DATE_TIME;

                    $sqlChk = "SELECT COUNT(*) AS NUM FROM M_MEETING WHERE CODE_API = '{$val['pccCivilGen']}' AND F_ID = '{$val['appointmentGen']}' AND APP_PERSON_IDCARD = '{$val['personCode']}' AND SYSTEM_ID = 1 ";
                    $qryChk = db::query($sqlChk);
                    $recChk = db::fetch_array($qryChk);

                    if ($recChk['NUM'] > 0) {
                        db::db_update(
                            'M_MEETING',
                            $fieldInsert,
                            array(
                                "CODE_API" => $val['pccCivilGen'],
                                "F_ID" => $val['appointmentGen'],
                                "APP_PERSON_IDCARD" => $val['personCode'],
                                "SYSTEM_ID" => 1
                            )
                        );
                        $updateRow++;
                    } else {
                        db::db_insert('M_MEETING', $fieldInsert, 'MEETING_ID', 'MEETING_ID');
                        $insertRow++;
                    }
                }

                // echo "<script>alert('ดึงข้อมูลเสร็จสิ้น\\nInsert $insertRow แถว \\nUpdate $updateRow แถว')</script>";
            } else {
                // echo "<script>alert('ไม่พบข้อมูล')</script>";
            }
        } else {
            // echo "<script>alert('ดึงข้อมูลล้มเหลว')</script>";
        }
    }
}

class bankrupt extends main_case
{
    public static function checkPersonBanrupt($idcard, $concern)
    {
        $fill = "";
        if (!empty($concern)) {
            $fill .= "AND a.CONCERN_NAME IN (" . result_array($concern) . ")";
        }
        $sql = "SELECT* FROM WH_BANKRUPT_CASE_PERSON a 
        WHERE 1=1
        AND a.REGISTER_CODE in (" . result_array($idcard) . "){$fill}
        ";
        $qry = db::query($sql);
        $rec = db::fetch_array($qry);
        return db::num_rows($qry);
    }
    public static function checkPersonBanrupt2($idcard, $concern)
    {
        $fill = "";
        if (!empty($concern)) {
            $fill .= "AND a.CONCERN_NAME IN (" . result_array($concern) . ")";
        }
        $sql = "SELECT count(a.REGISTER_CODE) AS TOTAL FROM WH_BANKRUPT_CASE_PERSON a 
        WHERE 1=1
        AND a.REGISTER_CODE in (" . ($idcard) . "){$fill}
        ";
        $qry = db::query($sql);
        $rec = db::fetch_array($qry);
        if ($rec['TOTAL'] == 0) {
            return 0;
        } else {
            return $rec['TOTAL'];
        }
    }
}

class revive extends main_case
{
    public static function checkOrderRevive($Array)
    {
        $sql = "SELECT *FROM M_LOG_ORDER a 
        WHERE 1=1 
        AND a.URL_API ='UPDATE_CFC_CAPTION_MANUAL_LOG_REVIVE'
        AND a.CFC_CAPTION_GEN ='" . $Array['CFC_CAPTION_GEN'] . "'
        AND a.ID_CARD='" . $Array['ID_CARD'] . "'";
        $qry = db::query($sql);
        //$rec = db::fetch_array($qry);
        return db::num_rows($qry);
    }
    public static function checkPersonRevive($idcard, $concern)
    {
        $fill = "";
        if (!empty($concern)) {
            $fill .= "AND a.CONCERN_NAME IN (" . result_array($concern) . ")";
        }
        $sql = "SELECT *FROM WH_REHABILITATION_PERSON a 
                WHERE a.REGISTER_CODE IN (" . ($idcard) . ") 
                {$fill}";
        $qry = db::query($sql);
        $rec = db::fetch_array($qry);
        return db::num_rows($qry);
    }
    public static function Log_TEST_DATA_RES($str_json, $PAGE_CODE, $SYSTEM_TYPE)
    {
        /* เก็บ log start */
        $array_link = "";
        foreach (json_decode($str_json, true) as $sh1 => $ch1) {
            $array_link .= "&" . $sh1 . "=" . $ch1;
        }
        unset($fields);
        $fields["PAGE_CODE"]                 =    $PAGE_CODE;
        $fields["COLUMN1"]                 =     $array_link;
        $fields["CREATE_DATE"]                 =    date("Y-m-d");
        $fields["SYSTEM_TYPE"]                 =   $SYSTEM_TYPE;
        db::db_insert("TEST_DATA_RES", $fields, 'PK_ID', 'PK_ID');
        /* เก็บ log stop */
    }
    public static function convertWFR($PAGE_CODE, $WFR_API)
    {
        if ($PAGE_CODE == '234' || $PAGE_CODE == '320' || $PAGE_CODE == '317' || $PAGE_CODE == '336') {
            $sql_ = "SELECT a.REHAB_CODE,b.REGISTER_CODE  FROM WH_REHABILITATION_CASE_DETAIL a 
            JOIN WH_REHABILITATION_PERSON b ON a.WH_REHAB_ID =b.WH_REHAB_ID 
            WHERE 1=1
            AND b.W_REHAB20 ='$PAGE_CODE'
            AND b.WFR_ID_REHAB20 ='$WFR_API'";
            $query_ = db::query($sql_);
            $rec_ = db::fetch_array($query_);
            return $rec_["REHAB_CODE"];
            //return $sql_;
        } else {
            return $WFR_API;
        }
    }

    public function AlertCourtOrder_New()
    {
    }
    public static function AlertCourtOrder($SYSTEM_TYPE = "", $data_Assets, $CODE_API, $toPersonId, $orderId, $orderName, $registerCode)
    {
        //checkPeople เรียกใช้โดยไปคนส่ง 13หลักไปค้นหาโดย เเสดงรายการที่ค้นหาเจอทั้งหมดยกเว้นคดีตัวเอง
        //ส่งลูกหนี้เเละคดีไปหา
        $array_raw = self::checkPeopleAll($data_Assets);


        foreach ($array_raw as $SH1 => $AA1) {
            foreach ($AA1 as $SH2 => $AA2) {
                ///ฝั่งรับ รับได้หลายระบบ ล้มละลาย ฟื้นฟู ไกล่เกลี่ย หรือส่งเข้าระบบตัวเอง เเพ่ง
                //DOSS เจ้าของคดีมีเเค่เเพ่งกับล้มละลาย
                $rowF = self::CaseInformation($SYSTEM_TYPE, $CODE_API); //SYSTEM_TYPE ระบบใหน ,CODE_API เลขที่ดึงคดี
                if ($SH1 == '1') { //เเพ่ง 
                    $sql_DOSS = "SELECT a.DOSS_OWNER_ID ,a.DOSS_OWNER_NAME,b.CIVIL_CODE AS CODE_API  FROM WH_CIVIL_DOSS a 
                                JOIN WH_CIVIL_CASE b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
                                WHERE a.WH_CIVIL_ID ='" . $AA2['WH_ID'] . "'"; //ใช้กับฝั่งรับ
                    $SYSTEM_RE = '1';
                } elseif ($SH1 == '2') { //ล้มละลาย
                    $sql_DOSS = "SELECT a.DOSS_OWNER_ID ,a.DOSS_OWNER_NAME,a.BANKRUPT_CODE AS CODE_API FROM WH_BANKRUPT_CASE_DETAIL a 
                                WHERE a.WH_BANKRUPT_ID ='" .  $AA2['WH_ID'] . "'"; //ใช้กับฝั่งรับ
                    $SYSTEM_RE = '2';
                } elseif ($SH1 == '3') { //ฟื้นฟู
                    $sql_DOSS = "SELECT a.*,a.REHAB_CODE as CODE_API  FROM WH_REHABILITATION_CASE_DETAIL a WHERE a.WH_REHAB_ID='" .  $AA2['WH_ID'] . "'  "; //ใช้กับฝั่งรับ
                    $SYSTEM_RE = '3';
                } elseif ($SH1 == '4') { //ไกล่เกลี่ย
                    $sql_DOSS = "SELECT a.*,a.REF_WFR_ID AS CODE_API FROM WH_MEDIATE_CASE a WHERE a.WH_MEDAITE_ID='" .  $AA2['WH_ID'] . "' "; //ใช้กับฝั่งรับ
                    $SYSTEM_RE = '4';
                }
                $queryDOSS = db::query($sql_DOSS);
                $rowDoss = db::fetch_array($queryDOSS);
                $DOSS_ID = $rowDoss['DOSS_OWNER_ID'] != "" ? $rowDoss['DOSS_OWNER_ID'] : "";
                $DOSS_NAME = $rowDoss['DOSS_OWNER_NAME'] != "" ? $rowDoss['DOSS_OWNER_NAME'] : "";

                $TextF = " คดีดำ " . $rowF['PREFIX_BLACK_CASE'] . $rowF['BLACK_CASE'] . "/" . $rowF['BLACK_YY'] . " คดีแดง " . $rowF['PREFIX_RED_CASE'] . $rowF['RED_CASE'] . $rowF['RED_YY'] . ""; //ต้นทาง
                $TextL = " คดีดำ " . $AA2['PREFIX_BLACK_CASE'] . $AA2['BLACK_CASE'] . "/" . $AA2['BLACK_YY'] . " คดีแดง " . $AA2['PREFIX_RED_CASE'] . $AA2['RED_CASE'] . $AA2['RED_YY'] . ""; //ปลายทาง
                $person_name = $AA2['PREFIX_NAME'] . $AA2['FIRST_NAME'] . $AA2['LAST_NAME'] . " " . "สถานะ " . $AA2['CONCERN_NAME'] . " "; //คนที่ตรวจพบปลายทาง
                $Text_1 = "ศาลมีคำสั่งให้" . $person_name . " ใน คดี" . ConvertSystemToThai($SYSTEM_TYPE) . " " . $TextF . " " . $AA2['COURT_NAME'] . " มี " . $orderName;

                //ฝั่งส่ง 
                $sql_alert = "SELECT*FROM M_ALERT_NOTIFICATION a 
                WHERE 1=1
                AND a.SEND_CODE_ID ='" . $CODE_API . "'
                AND a.SYSTEM_TYPE_SEND='" . $SYSTEM_TYPE . "'
                AND a.REGISTER_CODE='" . $AA2['REGISTER_CODE'] . "'
                AND a.RECEIVE_CODE_ID='" . $rowDoss['CODE_API'] . "'
                AND a.SYSTEM_TYPE_RECEIVE='" . $SYSTEM_RE . "'
                AND a.NOTE='" . $Text_1 . "'"; //เช็คห้ามมีรายการซ้ำ
                $query_alert = db::query($sql_alert);
                $num_alert = db::num_rows($query_alert);

                if ($num_alert > 100) {
                } else {
                    unset($fields);
                    $fields["CREATE_DATE"]         =     date('Y-m-d'); //วันที่สร้าง
                    $fields["CREATE_TIME"]         =     date('H:i:s'); //เวลาที่สรา้ง
                    $fields["SEND_CODE_ID"]         =     $CODE_API; //IDของคดีที่เรียกapi ของผู้ส่ง pccCivilGen ,brc_id //มาจาก api
                    $fields["SYSTEM_TYPE_SEND"]         =    $SYSTEM_TYPE; //ส่งจากระบบ 1=เเพ่ง 2=ล้มละลาย 

                    $fields["ID_CARD_SEND"]         =     $toPersonId; //13หลักผู้ส่ง //มาจาก api
                    $fields["DOSS_OWNER_ID"]         =     $DOSS_ID; //IDของเจ้าของคดีฝั่งรับ
                    $fields["DOSS_OWNER_NAME"]         =    $DOSS_NAME; //ชื่อเจ้าของคดีฝั่งรับ
                    $fields["REGISTER_CODE"]         =     $AA2['REGISTER_CODE']; //IDของคนที่ตรวจเจอ
                    $fields["NOTE"]         =     $Text_1; //ข้อความที่เเสดงในการเเจ้งเตือน
                    $fields["RECEIVE_CODE_ID"]         =     $rowDoss['CODE_API']; //IDของคดีที่เรียกapi ของผู้รับ
                    $fields["SYSTEM_TYPE_RECEIVE"]         =     $SYSTEM_RE; //ระบบที่รับ system_($ss)
                    $fields["STATUS"]         =     "PERSON"; //สถานะเป็นทรัพย์หรือเป็นคน
                    db::db_insert("M_ALERT_NOTIFICATION", $fields, 'ID_ALERT', 'ID_ALERT');
                    $data_log[] = $sql_DOSS;
                }
                //ถ้าตรวจเจอคนในคดีเเพ่ง
                if ($SH1 == '1') {
                    $array_lock = explode(",", "2,9,10,11,12,13,14,15,16,19,20,22,23"); //ล็อค
                    if (in_array($orderId, $array_lock)) {
                        //ถ้าตรวจเจอคนในคดีเเพ่ง ในสถานะ 02=จำเลย
                        if ($AA2['CONCERN_CODE'] == '02') {
                            //ส่ง13หลักไปหาทรัพย์ของคนๆนั้น
                            $sql = "";
                            $sql = "SELECT a.CIVIL_CODE ,b.CFC_CAPTION_GEN ,b.PROP_TITLE ,c.REGISTERID FROM WH_CIVIL_CASE a
                                JOIN WH_CIVIL_CASE_ASSETS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
                                JOIN WH_CIVIL_CASE_ASSET_OWNER c ON a.WH_CIVIL_ID =c.WH_CIVIL_ID AND b.ASSET_ID =c.ASSET_ID 
                                WHERE 1=1
                                AND a.WH_CIVIL_ID ='" . $AA2['WH_ID'] . "'
                                AND c.REGISTERID ='" . $AA2['REGISTER_CODE'] . "'";
                            $query = db::query($sql);
                            while ($rec = db::fetch_array($query)) {
                                $CFC_CAPTION = $rec['CFC_CAPTION_GEN'];
                                $IS_OWNER_BANKRUPT = "";
                                $LOCK_CONFISCATE_FLAG = "1";
                                $LOCK_SELL_FLAG = "1";
                                $LOCK_ACCOUNTING_FLAG = "1";
                                $IS_OWNER_REVIVE = "1";
                                //ตรวจคนในเเพ่งเป็นจำเลย ให้ล็อคทรัพย์ทั้งหมดในคดีนั้นๆ
                                unset($Array);
                                $Array = [
                                    "ID_CARD" => $AA2['REGISTER_CODE']
                                ];
                                civil::logOrder_update('UPDATE_CFC_CAPTION_MANUAL_LOG_REVIVE', $CFC_CAPTION, $LOCK_CONFISCATE_FLAG, $LOCK_SELL_FLAG, $LOCK_ACCOUNTING_FLAG, $Array);
                                civil::UPDATE_CFC_CAPTION_MANUAL($CFC_CAPTION, $IS_OWNER_BANKRUPT, $LOCK_CONFISCATE_FLAG, $LOCK_SELL_FLAG, $LOCK_ACCOUNTING_FLAG, $IS_OWNER_REVIVE);
                            }
                        }
                        $lock['lockPerson'][] = self::lockPerson($rowDoss['CODE_API']);
                    }
                    $array_lock = explode(",", "17,21"); //ปลดล็อค
                    if (in_array($orderId, $array_lock)) {
                        if ($AA2['CONCERN_CODE'] == '02') {
                            //ส่ง13หลักไปหาทรัพย์ของคนๆนั้น
                            $sql = "";
                            $sql = "SELECT a.CIVIL_CODE ,b.CFC_CAPTION_GEN ,b.PROP_TITLE ,c.REGISTERID FROM WH_CIVIL_CASE a
                                JOIN WH_CIVIL_CASE_ASSETS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
                                JOIN WH_CIVIL_CASE_ASSET_OWNER c ON a.WH_CIVIL_ID =c.WH_CIVIL_ID AND b.ASSET_ID =c.ASSET_ID 
                                WHERE 1=1
                                AND a.WH_CIVIL_ID ='" . $AA2['WH_ID'] . "'
                                AND c.REGISTERID ='" . $AA2['REGISTER_CODE'] . "'";
                            $query = db::query($sql);
                            while ($rec = db::fetch_array($query)) {
                                $CFC_CAPTION = $rec['CFC_CAPTION_GEN'];
                                $IS_OWNER_BANKRUPT = "";
                                $LOCK_CONFISCATE_FLAG = "";
                                $LOCK_SELL_FLAG = "";
                                $LOCK_ACCOUNTING_FLAG = "";
                                //ตรวจคนในเเพ่งเป็นจำเลย ให้ล็อคทรัพย์ทั้งหมดในคดีนั้นๆ
                                $IS_OWNER_REVIVE = "0";
                                unset($Array);
                                $Array = [
                                    "ID_CARD" => $AA2['REGISTER_CODE']
                                ];
                                civil::logOrder_update('UPDATE_CFC_CAPTION_MANUAL_LOG_REVIVE', $CFC_CAPTION, $LOCK_CONFISCATE_FLAG, $LOCK_SELL_FLAG, $LOCK_ACCOUNTING_FLAG, $Array);
                                civil::UPDATE_CFC_CAPTION_MANUAL($CFC_CAPTION, $IS_OWNER_BANKRUPT, $LOCK_CONFISCATE_FLAG, $LOCK_SELL_FLAG, $LOCK_ACCOUNTING_FLAG, $IS_OWNER_REVIVE);
                            }
                        }
                        $lock['uplockPerson'][] = self::uplockPerson($rowDoss['CODE_API']);
                    }
                }
            }
        }
        //return $array_raw;
        //return $data_log;
        return $array_raw;
    }
}

class backoffice extends main_case
{
    public static function check_person_backoffice($CODE_API, $SYSTEM_TYPE, $toPersonId)
    {
        $DataPerson = array();
        $DataPerson = self::getDataPerson($SYSTEM_TYPE, $CODE_API); //ส่งระบบงานเเละcodeApiเข้าไปเพื่อเอาข้อมูลคนออกมา

        $aar = array();
        foreach ($DataPerson as $key => $value) {
            $COURT_CODE_notin = ""; //ใส่รายการ CONCERN ที่ไม่ต้องเเจ้งเตือน เช่น 01,02,07
            $array_check = explode(",", $COURT_CODE_notin); //แปลงข้อมูล เป็นarray เพื่อเช็คค่า
            if (in_array($value['COURT_CODE'], $array_check)) {
                return false;
            }
            $sql = "SELECT*FROM WH_BACKOFFICE_PERSON TB WHERE TB.REGISTER_CODE ='" . $value['REGISTER_CODE'] . "'"; //ส่ง 13หลักมาเช็ค ถ้ามีรายการซ้ำในbackofficeจะทำการเเจ้งเตือน
            $aar[] = $sql;
            $query = db::query($sql);
            $rec = db::fetch_array($query);
            $num_value = db::num_rows($query);
            if ($num_value > 0) {
                $Text_1 = '';
                $Text_1 .= 'ตรวจพบ สถานะ ' . $value[''] . " " . $value['PREFIX_NAME'] . $value['FIRST_NAME'] . " " . $value['LAST_NAME'];
                $Text_1 .= ' ' . $rec['ORG_NAME'];
                $Text_1 .= ' ' . 'คดีดำที่ ' . $value['PREFIX_BLACK_CASE'] . $value['BLACK_CASE'] . '/' . $value['BLACK_YY'];
                $Text_1 .= ' ' . 'คดีแดงที่ ' . $value['PREFIX_RED_CASE'] . $value['RED_CASE'] . '/' . $value['RED_YY'];
                $Text_1 .= ' ' . $value['COURT_NAME'];
                $sql_alert = "SELECT*FROM M_ALERT_NOTIFICATION a 
            WHERE 1=1
            AND a.SEND_CODE_ID ='" . $value['CODE_API'] . "'
            AND a.REGISTER_CODE='" . $rec['REGISTER_CODE'] . "'
            AND a.NOTE='" . $Text_1 . "'"; //เช็คห้ามมีรายการซ้ำ
                $query_alert = db::query($sql_alert);
                $num_alert = db::num_rows($query_alert);
                if ($num_alert == 0) {
                    unset($fields);
                    $fields["CREATE_DATE"]         =     date('Y-m-d'); //วันที่สร้าง
                    $fields["CREATE_TIME"]         =     date('H:i:s'); //เวลาที่สรา้ง
                    $fields["SEND_CODE_ID"]         =    $value['CODE_API']; //IDของคดีที่เรียกapi ของผู้ส่ง pccCivilGen ,brc_id //มาจาก api
                    $fields["SYSTEM_TYPE_SEND"]         =    $SYSTEM_TYPE; //ส่งจากระบบ 1=เเพ่ง 2=ล้มละลาย 
                    $fields["ID_CARD_SEND"]         =     $toPersonId; //13หลักผู้ส่ง //มาจาก api

                    $fields["DOSS_OWNER_ID"]         =     ''; //IDของเจ้าของคดีฝั่งรับ
                    $fields["DOSS_OWNER_NAME"]         =    ''; //ชื่อเจ้าของคดีฝั่งรับ
                    $fields["REGISTER_CODE"]         =     $rec['REGISTER_CODE']; //IDของคนที่ตรวจเจอ
                    $fields["NOTE"]         =     $Text_1; //ข้อความที่เเสดงในการเเจ้งเตือน
                    $fields["RECEIVE_CODE_ID"]         =     ''; //IDของคดีที่เรียกapi ของผู้รับ
                    $fields["SYSTEM_TYPE_RECEIVE"]         =     '5'; //ระบบที่รับ system_($ss)
                    $fields["STATUS"]         =     "PERSON"; //สถานะเป็นทรัพย์หรือเป็นคน
                    db::db_insert("M_ALERT_NOTIFICATION", $fields, 'ID_ALERT', 'ID_ALERT');
                }
            }
        }
        // return $aar;
    }
    public static function getMeetingBackoffice($idCard)
    {

        unset($fields);
        $fields["MEETING_TYPE"]         = "";
        $fields["MEETING_TOPIC"]         = "";
        $fields["MEETING_DETAIL"]         = "";
        $fields["MEETING_SDATE"]         = "";
        $fields["MEETING_SDATE_TIME"]         = "";
        $fields["MEETING_EDATE"]         = "";
        $fields["MEETING_EDATE_TIME"]         = "";
        $fields["CREATE_BY_ID_CARD"]         = "";
        $fields["CREATE_BY_NAME"]         = "";
        $fields["CREATE_DATE"]         = "";
        $fields["CREATE_DATE_TIME"]         = "";
        $fields["APP_PERSON_IDCARD"]         = "";
        $fields["APP_PERSON_NAME"]         = "";
        $fields["MEETING_LOCATION"]         = "";
        // db::db_insert("M_MEETING", $fields, 'ID_ALERT', 'ID_ALERT');
    }
}

class func_main extends main_case
{
    public $A;
    public static $B;
    public function AAA()
    {
        //$this->z1 = 0;
        $this->z2 = 0;
        return  $this->A;
    }
    public static function BBB()
    {
        self::$B;
    }
}

/* $OBJ1=new func_main();
$OBJ2=new func_main();

$OBJ1->A = 1;
$OBJ2->A = 2;

$OBJ2->z1 = 0;
$OBJ2->z2 = 0;
$OBJ2->z3 = 0;

func_main::$B = 1;
func_main::$B = 2; */
