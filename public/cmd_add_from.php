<?php
/* session_start(); */
$_SESSION["WF_USER_ID"] = "-1";
$_REQUEST['wfp'] = "WNzNrMmw0ZTR3NDA1ZzRhNHI0bzRmM3E1aTRwNHEzdzNiMjM0eTJ1Mm8zaTNvMw==";
include '../include/comtop_public.php';

include './btn_function.php';
include './check_case_Function.php';

$wf_limit = $_GET['wf_limit'] == "" ? 20 : $_GET['wf_limit'];
foreach ($_GET as $key => $val) {
    $$key = conText($val);
}
foreach ($_POST as $key => $val) {
    $$key = conText($val);
}
function check_function($functionName)
{
    $reflection = new ReflectionFunction($functionName);
    $filename = $reflection->getFileName();
    return $filename;
}
function print_r_pre($a = "")
{
    echo "<br><br><br><br><br><br><pre>";
    print_r($a);
    echo "</pre>";
}




/* เเพ่ง */
/* start AK ส่งจากเเพ่งไปหาปลายทาง */
if ($_GET["proc"] == "search_data_add" && $SEND_FROM == 'CIVIL' && $PCC_CIVIL_GEN != '') {
    //ต้นทาง start
    $sqlSelectData = "	SELECT 	CIVIL_CODE,COURT_CODE, PREFIX_BLACK_CASE,BLACK_CASE,BLACK_YY,
                                PREFIX_RED_CASE,RED_CASE,RED_YY,PLAINTIFF1,DEFFENDANT1,PCC_CASE_GEN,WH_CIVIL_ID
                        FROM 	WH_CIVIL_CASE
                        WHERE 	CIVIL_CODE = '" . $PCC_CIVIL_GEN . "'";
    $querySelectData = db::query($sqlSelectData);
    $dataSelectData = db::fetch_array($querySelectData);

    $text_param = "";
    $text_param .= "CODE_API_SEND=" . $PCC_CIVIL_GEN;
    $text_param .= "&GET_S_PREFIX_CASE_BLACK=" . $dataSelectData["PREFIX_BLACK_CASE"];
    $text_param .= "&GET_S_CASE_BLACK=" . $dataSelectData["BLACK_CASE"];
    $text_param .= "&GET_S_CASE_BLACK_YEAR=" . $dataSelectData["BLACK_YY"];
    $text_param .= "&GET_S_PREFIX_CASE_RED=" . $dataSelectData["PREFIX_RED_CASE"];
    $text_param .= "&GET_S_CASE_RED=" . $dataSelectData["RED_CASE"];
    $text_param .= "&GET_S_CASE_RED_YEAR=" . $dataSelectData["RED_YY"];
    $text_param .= "&GET_S_COURT_CODE=" . $dataSelectData["COURT_CODE"];
    $text_param .= "&GET_S_SYSTEM_ID=1";
    $text_param .= "&SEND_TO=1";
    // $TO_PERSON_ID = '1311100009189';
    $text_param .= "&TO_PERSON_ID=" . $TO_PERSON_ID;
    $text_param .= "&GET_PLAINTIFF=" . $dataSelectData["PLAINTIFF1"];
    $text_param .= "&GET_DEFENDANT=" . $dataSelectData["DEFFENDANT1"];
    $text_param .= "&add_from=" . 'search_data_add';
    //ต้นทาง stop

    //ปลายทาง start

    if ($_GET['receive_CourtCode'] == '010030') {
        $_GET['receive_CourtCode'] = '050';
    }

    $newCivil = new cmdMain();

    $text_param .= "&GET_T_PREFIX_CASE_BLACK=" . $_GET['receive_prefixBlackCase'];
    $text_param .= "&GET_T_CASE_BLACK=" . $_GET['receive_blackCase'];
    $text_param .= "&GET_T_CASE_BLACK_YEAR=" . $_GET['receive_blackYy'];
    $text_param .= "&GET_T_PREFIX_CASE_RED=" . $_GET['receive_prefixRedCase'];
    $text_param .= "&GET_T_CASE_RED=" . $_GET['receive_redCase'];
    $text_param .= "&GET_T_CASE_RED_YEAR=" . $_GET['receive_redYy'];
    $text_param .= "&GET_T_COURT_CODE=" . $_GET['receive_CourtCode'];
    $text_param .= "&GET_T_SYSTEM_ID=" . $newCivil->convertSystem($_GET['receive_case']);
}

/* ล้มละลาย */
if ($_GET["proc"] == "search_data_add" && $SEND_FROM == 'BANKRUPT' && $brcID != '') {
    //ต้นทาง start
    $sqlSelectData = "	SELECT 
                                a.PREFIX_BLACK_CASE ,a.BLACK_CASE ,a.BLACK_YY ,
                                a.PREFIX_RED_CASE ,a.RED_CASE ,a.RED_YY ,
                                a.COURT_CODE,a.PLAINTIFF1 ,a.DEFFENDANT1 
                        FROM WH_BANKRUPT_CASE_DETAIL a
                        WHERE a.BANKRUPT_CODE = '" . $brcID . "'";
    $querySelectData = db::query($sqlSelectData);
    $dataSelectData = db::fetch_array($querySelectData);
    if ($dataSelectData['COURT_CODE'] == '010030') {
        $dataSelectData['COURT_CODE'] = '050';
    }
    $text_param = "";
    $text_param .= "CODE_API_SEND=" . $brcId;
    $text_param .= "&GET_S_PREFIX_CASE_BLACK=" . $dataSelectData["PREFIX_BLACK_CASE"];
    $text_param .= "&GET_S_CASE_BLACK=" . $dataSelectData["BLACK_CASE"];
    $text_param .= "&GET_S_CASE_BLACK_YEAR=" . $dataSelectData["BLACK_YY"];
    $text_param .= "&GET_S_PREFIX_CASE_RED=" . $dataSelectData["PREFIX_RED_CASE"];
    $text_param .= "&GET_S_CASE_RED=" . $dataSelectData["RED_CASE"];
    $text_param .= "&GET_S_CASE_RED_YEAR=" . $dataSelectData["RED_YY"];
    $text_param .= "&GET_S_COURT_CODE=" . $dataSelectData["COURT_CODE"];
    $text_param .= "&GET_S_SYSTEM_ID=2";
    $text_param .= "&SEND_TO=2";
    // $TO_PERSON_ID = '1311100009189';
    $text_param .= "&TO_PERSON_ID=" . $TO_PERSON_ID;
    $text_param .= "&GET_PLAINTIFF=" . $dataSelectData["PLAINTIFF1"];
    $text_param .= "&GET_DEFENDANT=" . $dataSelectData["DEFFENDANT1"];
    $text_param .= "&add_from=" . 'search_data_add';
    //ต้นทาง stop


    //ปลายทาง start
    if ($_GET['receive_CourtCode'] == '010030') {
        $_GET['receive_CourtCode'] = '050';
    }

    $newBankrupt = new cmdMain();
    $text_param .= "&GET_T_PREFIX_CASE_BLACK=" . $_GET['receive_prefixBlackCase'];
    $text_param .= "&GET_T_CASE_BLACK=" . $_GET['receive_blackCase'];
    $text_param .= "&GET_T_CASE_BLACK_YEAR=" . $_GET['receive_blackYy'];
    $text_param .= "&GET_T_PREFIX_CASE_RED=" . $_GET['receive_prefixRedCase'];
    $text_param .= "&GET_T_CASE_RED=" . $_GET['receive_redCase'];
    $text_param .= "&GET_T_CASE_RED_YEAR=" . $_GET['receive_redYy'];
    $text_param .= "&GET_T_COURT_CODE=" . $_GET['receive_CourtCode'];
    $text_param .= "&GET_T_SYSTEM_ID=" . $newBankrupt->convertSystem($_GET['receive_case']);
}


/* ฟื้นฟู */
if ($_GET["proc"] == "search_data_add" && $SEND_FROM == 'REVIVE' && $WFR_API != '') {
    //ต้นทาง start
    $WFR_API = $_GET["WFR_API"];
    $sqlSelectData = "select * from WH_REHABILITATION_CASE_DETAIL where REHAB_CODE='" . $WFR_API . "'";
    $querySelectData = db::query($sqlSelectData);
    $dataSelectData = db::fetch_array($querySelectData);
    if ($dataSelectData['COURT_CODE'] == '010030') {
        $dataSelectData['COURT_CODE'] = '050';
    }
    $text_param = "";
    $text_param .= "CODE_API_SEND=" . $WFR_API;
    $text_param .= "&GET_S_PREFIX_CASE_BLACK=" . $dataSelectData["PREFIX_BLACK_CASE"];
    $text_param .= "&GET_S_CASE_BLACK=" . $dataSelectData["BLACK_CASE"];
    $text_param .= "&GET_S_CASE_BLACK_YEAR=" . $dataSelectData["BLACK_YY"];
    $text_param .= "&GET_S_PREFIX_CASE_RED=" . $dataSelectData["PREFIX_RED_CASE"];
    $text_param .= "&GET_S_CASE_RED=" . $dataSelectData["RED_CASE"];
    $text_param .= "&GET_S_CASE_RED_YEAR=" . $dataSelectData["RED_YY"];
    $text_param .= "&GET_S_COURT_CODE=" . $dataSelectData["COURT_CODE"];
    $text_param .= "&GET_S_SYSTEM_ID=3";
    $text_param .= "&SEND_TO=3";
    // $TO_PERSON_ID = '1311100009189';
    $text_param .= "&TO_PERSON_ID=" . $TO_PERSON_ID;
    $text_param .= "&GET_PLAINTIFF=" . $dataSelectData["PLAINTIFF2"];
    $text_param .= "&GET_DEFENDANT=" . $dataSelectData["DEFFENDANT1"];
    $text_param .= "&add_from=" . 'search_data_add';
    //ต้นทาง stop


    //ปลายทาง start


    if ($_GET['receive_CourtCode'] == '010030') {
        $_GET['receive_CourtCode'] = '050';
    }

    $newRevive = new cmdMain();

    $text_param .= "&GET_T_PREFIX_CASE_BLACK=" . $_GET['receive_prefixBlackCase'];
    $text_param .= "&GET_T_CASE_BLACK=" . $_GET['receive_blackCase'];
    $text_param .= "&GET_T_CASE_BLACK_YEAR=" . $_GET['receive_blackYy'];
    $text_param .= "&GET_T_PREFIX_CASE_RED=" . $_GET['receive_prefixRedCase'];
    $text_param .= "&GET_T_CASE_RED=" . $_GET['receive_redCase'];
    $text_param .= "&GET_T_CASE_RED_YEAR=" . $_GET['receive_redYy'];
    $text_param .= "&GET_T_COURT_CODE=" . $_GET['receive_CourtCode'];
    $text_param .= "&GET_T_SYSTEM_ID=" . $newRevive->convertSystem($_GET['receive_case']);
}



/* ไกล่เกลี่ย */
if ($_GET["proc"] == "search_data_add" && $SEND_FROM == 'MEDIATE' && $WFR_API != '') {
    //ต้นทาง start
    $WFR_API = $_GET["WFR_API"];
    $sqlSelectData = "	SELECT *FROM WH_MEDIATE_CASE a 
WHERE a.REF_WFR_ID = '" . $WFR_API . "'";

    $querySelectData = db::query($sqlSelectData);
    $dataSelectData = db::fetch_array($querySelectData);
    if ($dataSelectData['COURT_CODE'] == '010030') {
        $dataSelectData['COURT_CODE'] = '050';
    }
    $text_param = "";
    $text_param .= "CODE_API_SEND=" . $WFR_API;
    $text_param .= "&GET_S_PREFIX_CASE_BLACK=" . $dataSelectData["PREFIX_BLACK_CASE"];
    $text_param .= "&GET_S_CASE_BLACK=" . $dataSelectData["BLACK_CASE"];
    $text_param .= "&GET_S_CASE_BLACK_YEAR=" . $dataSelectData["BLACK_YY"];
    $text_param .= "&GET_S_PREFIX_CASE_RED=" . $dataSelectData["PREFIX_RED_CASE"];
    $text_param .= "&GET_S_CASE_RED=" . $dataSelectData["RED_CASE"];
    $text_param .= "&GET_S_CASE_RED_YEAR=" . $dataSelectData["RED_YY"];
    $text_param .= "&GET_S_COURT_CODE=" . $dataSelectData["COURT_ID"];
    $text_param .= "&GET_S_SYSTEM_ID=4";
    $text_param .= "&SEND_TO=4";
    // $TO_PERSON_ID = '1311100009189';
    $text_param .= "&TO_PERSON_ID=" . $TO_PERSON_ID;
    $text_param .= "&GET_PLAINTIFF=" . $dataSelectData["PLAINTIFF_FNAME"];
    $text_param .= "&GET_DEFENDANT=" . $dataSelectData["DEFENDANT_FNAME"];
    $text_param .= "&add_from=" . 'search_data_add';
    //ต้นทาง stop


    //ปลายทาง start
    if ($_GET['receive_CourtCode'] == '010030') {
        $_GET['receive_CourtCode'] = '050';
    }

    if ($_GET['receive_case'] == 'Mediate') {
        $receive_case = "4"; //ข้อมูลที่เกี่ยวข้องกับบุคคลในระบบไกล่เกลี่ย
        $CASE_NAMETHAI = 'คดีไกล่เกลี่ย';
    } else if ($_GET['receive_case'] == 'Bankrupt') {
        $receive_case = "2"; //ข้อมูลที่เกี่ยวข้องกับบุคคลในระบบล้มละลาย
        $CASE_NAMETHAI = 'คดีล้มละลาย';
    } else if ($_GET['receive_case'] == 'Revive') {
        $receive_case = "3"; //ข้อมูลที่เกี่ยวข้องกับบุคคลในระบบฟื้นฟู
        $CASE_NAMETHAI = 'คดีฟื้นฟู';
    } else if ($_GET['receive_case'] == 'Backoffice') {
        $receive_case = "5"; //ข้อมูลที่เกี่ยวข้องกับบุคคลในระบบBackoffice
    } else if ($_GET['receive_case'] == 'Civil') {
        $receive_case = "1"; //ข้อมูลที่เกี่ยวข้องกับบุคคลในระบบเเพ่ง
        $CASE_NAMETHAI = 'คดีเเพ่ง';
    }

    $newMediate = new cmdMain();
    $text_param .= "&GET_T_PREFIX_CASE_BLACK=" . $_GET['receive_prefixBlackCase'];
    $text_param .= "&GET_T_CASE_BLACK=" . $_GET['receive_blackCase'];
    $text_param .= "&GET_T_CASE_BLACK_YEAR=" . $_GET['receive_blackYy'];
    $text_param .= "&GET_T_PREFIX_CASE_RED=" . $_GET['receive_prefixRedCase'];
    $text_param .= "&GET_T_CASE_RED=" . $_GET['receive_redCase'];
    $text_param .= "&GET_T_CASE_RED_YEAR=" . $_GET['receive_redYy'];
    $text_param .= "&GET_T_COURT_CODE=" . $_GET['receive_CourtCode'];
    $text_param .= "&GET_T_SYSTEM_ID=" . $newMediate->convertSystem($_GET['receive_case']);
}

/* backoffice */
if ($_GET["proc"] == "search_data_add" && $SEND_FROM == 'BACKOFFICE' && $SEND_TO == '5') {
    /* ต้นทาง */
    $text_param = "";
    $text_param .= "&add_from=search_data_add";
    $text_param .= "&GET_S_SYSTEM_ID=5";
    $text_param .= "&GET_PERSON_CASE=" . $_GET["GET_PERSON_CASE"]; // 13หลักของคนในbackoffice ที่ส่งมาตรวจ

    //ปลายทาง start
    /* ทำข้อมูลปลายทาง */
    if ($_GET['TARGET_SYSTEM'] == 'BANKRUPT') {
        $sql = "SELECT *FROM WH_BANKRUPT_CASE_DETAIL a 
        WHERE 1=1
        AND a.PREFIX_BLACK_CASE ='" . $_GET['T_BLACK_CASE'] . "'
        AND a.BLACK_CASE ='" . $_GET['BLACK_CASE'] . "'
        AND a.BLACK_YY ='" . $_GET['BLACK_YY'] . "'
        AND a.PREFIX_RED_CASE ='" . $_GET['T_RED_CASE'] . "'
        AND a.RED_CASE ='" . $_GET['RED_CASE'] . "'
        AND a.RED_YY ='" . $_GET['RED_YY'] . "'";
        $receive_case = "2";
    } else  if ($_GET['TARGET_SYSTEM'] == 'CIVIL') {
        $sql = "SELECT *FROM WH_CIVIL_CASE a 
        WHERE 1=1
        AND a.PREFIX_BLACK_CASE ='" . $_GET['T_BLACK_CASE'] . "'
        AND a.BLACK_CASE ='" . $_GET['BLACK_CASE'] . "'
        AND a.BLACK_YY ='" . $_GET['BLACK_YY'] . "'
        AND a.PREFIX_RED_CASE ='" . $_GET['T_RED_CASE'] . "'
        AND a.RED_CASE ='" . $_GET['RED_CASE'] . "'
        AND a.RED_YY ='" . $_GET['RED_YY'] . "'";
        $receive_case = "1";
    } else if ($_GET['TARGET_SYSTEM'] == 'REVIVE') {
        $sql = "SELECT *FROM WH_REHABILITATION_CASE_DETAIL a 
        WHERE 1=1
        AND a.PREFIX_BLACK_CASE ='" . $_GET['T_BLACK_CASE'] . "'
        AND a.BLACK_CASE ='" . $_GET['BLACK_CASE'] . "'
        AND a.BLACK_YY ='" . $_GET['BLACK_YY'] . "'
        AND a.PREFIX_RED_CASE ='" . $_GET['T_RED_CASE'] . "'
        AND a.RED_CASE ='" . $_GET['RED_CASE'] . "'
        AND a.RED_YY ='" . $_GET['RED_YY'] . "'";
        $receive_case = "3";
    } else if ($_GET['TARGET_SYSTEM'] == 'MEDIATE') {
        $sql = "SELECT *FROM WH_MEDIATE_CASE a 
        WHERE 1=1
        AND a.PREFIX_BLACK_CASE ='" . $_GET['T_BLACK_CASE'] . "'
        AND a.BLACK_CASE ='" . $_GET['BLACK_CASE'] . "'
        AND a.BLACK_YY ='" . $_GET['BLACK_YY'] . "'
        AND a.PREFIX_RED_CASE ='" . $_GET['T_RED_CASE'] . "'
        AND a.RED_CASE ='" . $_GET['RED_CASE'] . "'
        AND a.RED_YY ='" . $_GET['RED_YY'] . "'";
        $receive_case = "4";
    }
    $query = db::query($sql);
    $dataSelectData = db::fetch_array($query);

    $text_param .= "&GET_T_PREFIX_CASE_BLACK=" . $dataSelectData['PREFIX_BLACK_CASE'];
    $text_param .= "&GET_T_CASE_BLACK=" . $dataSelectData['BLACK_CASE'];
    $text_param .= "&GET_T_CASE_BLACK_YEAR=" . $dataSelectData['BLACK_YY'];
    $text_param .= "&GET_T_PREFIX_CASE_RED=" . $dataSelectData['PREFIX_RED_CASE'];
    $text_param .= "&GET_T_CASE_RED=" . $dataSelectData['RED_CASE'];
    $text_param .= "&GET_T_CASE_RED_YEAR=" . $dataSelectData['RED_YY'];
    $text_param .= "&GET_T_COURT_CODE=" . $dataSelectData['COURT_CODE'];

    $text_param .= "&PLAINTIFF1=" . $dataSelectData['PLAINTIFF1']; //โจทก์
    $text_param .= "&DEFFENDANT1=" . $dataSelectData['DEFFENDANT1']; //จำเลย
    $text_param .= "&GET_T_SYSTEM_ID=" . $receive_case;

    $text_param .= "&TO_PERSON_ID=" . $TO_PERSON_ID;
    $text_param .= "&SEND_TO=5";
}
$text_param .= "&NewPage=" . $_GET["NewPage"];
/* stop AK */
/* echo "<br><br><br><br><br><pre>";
print_r($_GET);
echo "</pre>"; */
/* stop */
?>
<script>
    let REGISTER_CODE = '<?php echo $_GET['REGISTER_CODE']; ?>' // มี2สถานะ 1 สอบถามความประส่ง เเละค่าว่างคือเลือกได้หมด
    let url = 'cmd_add_from_send_to.php?<?php echo $text_param; ?>&proc=add&REGISTER_CODE_MAIN=' + REGISTER_CODE
    // console.log(url)
    window.location.href = url;
</script>