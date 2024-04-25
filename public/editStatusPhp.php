<?php
include '../include/include.php';
include '../include/func_Nop.php';

if ($_POST['proc'] == 'showCMD') {
    $data_array = [];
    $sql = "SELECT DISTINCT
            CMD_GRP_NAME,B.CMD_TYPE_ID,C.CMD_SYSTEM_ID ,C.SERVICE_SYS_NAME 
            FROM
            M_CMD_TYPE A
            LEFT JOIN M_SERVICE_CMD B ON A.CMD_TYPE_ID = B.CMD_TYPE_ID
            LEFT JOIN M_CMD_SYSTEM C ON B.CMD_SYS_ID = C.CMD_SYSTEM_ID
            WHERE GRP_NOTI_FLAG = '1'
            AND C.CMD_SYSTEM_ID  ='" . $_POST['system_type'] . "'
            ORDER BY
            A.CMD_GRP_NAME ASC";
    $qry = db::query($sql);
    while ($rec = db::fetch_array($qry)) {
        $data_array[$rec['CMD_TYPE_ID']] = $rec['CMD_GRP_NAME'];
    }
    echo json_encode($data_array);
}

if ($_POST['proc'] == 'getCaseType') {
    $data_array = [];
    $sql = "SELECT 		A.CMD_TYPE_ID ,B.*,B.CMD_SYSTEM_ID ,B.SERVICE_SYS_NAME ,CMD_TYPE_CODE,CMD_TYPE_NAME
                FROM 		M_SERVICE_CMD A
                LEFT JOIN 	M_CMD_SYSTEM B ON A.CMD_SYS_ID = B.CMD_SYSTEM_ID
                LEFT JOIN 	M_CMD_TYPE C ON A.CMD_TYPE_ID = C.CMD_TYPE_ID
                WHERE 		1=1
                AND CMD_STATUS = 1 
                AND A.CMD_TYPE_ID ='" . $_POST['CMD_TYPE'] . "'
                AND B.CMD_SYSTEM_ID ='" . $_POST['SYSTEM_ID'] . "'
                ORDER BY 	A.CMD_TYPE_NAME ASC";
    $qry = db::query($sql);
    while ($rec = db::fetch_array($qry)) {
        $data_array[$rec['CMD_TYPE_CODE']] = $rec['CMD_TYPE_NAME'];
    }
    echo json_encode($data_array);
}

if ($_POST['proc'] == 'lock_asset') {
    $sql_type_code = "   SELECT *FROM M_SERVICE_CMD a WHERE a.CMD_TYPE_CODE ='" . $_POST['CASE_TYPE'] . "'";
    $qry_type_code = db::query($sql_type_code);
    $rec_type_code = db::fetch_array($qry_type_code);
    $arrDataSet = array();

    $arrDataSet["USERNAME"]     = "BankruptDt";
    $arrDataSet["PASSWORD"]     = "Debtor4321";
    $arrDataSet["PCC_CASE_GEN"] = $_POST["PCC_CASE_GEN"];
    $arrDataSet["CARD_ID"]         = $_POST["ID_CARD"];
    $arrDataSet["CFC_CAPTION_GEN"][$_POST["CFC_CAPTION_GEN"]] = $_POST["CFC_CAPTION_GEN"];
    $arrDataSet["DOSS_CONTROL_GEN"][$_POST["DOSS_CONTROL_GEN"]] = array(
        "SEQUEST_STATUS" => $rec_type_code["SEQUEST_STATUS"],
        "SALE_STATUS" => $rec_type_code["SALE_STATUS"],
        "ACCOUNTANCY_STATUS" => $rec_type_code["ACCOUNTANCY_STATUS"]
    );
    $data_string = json_encode($arrDataSet);

    /* เก็บ log start AK*/
    unset($fields);
    $fields["PAGE_CODE"]               =   'http://103.40.146.73/LedService.php/lockPersonCivil';
    $fields["COLUMN1"]                 =     $data_string;
    $fields["CREATE_DATE"]                 =    date("Y-m-d");
    $fields["SYSTEM_TYPE"]                 =   "1";
    $fields["NOTE"]                 =   "ล็อคคน";
    $fields["REF_ID"]                 =   $_GET['ID'];
    db::db_insert("TEST_DATA_RES", $fields, 'PK_ID', 'PK_ID');
    /* เก็บ log stop AK*/

    echo $data_string;


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
if ($_POST['proc'] == 'uplock_asset') {

    $sql_type_code = "   SELECT *FROM M_SERVICE_CMD a WHERE a.CMD_TYPE_CODE ='" . $_POST['CASE_TYPE'] . "'";
    $qry_type_code = db::query($sql_type_code);
    $rec_type_code = db::fetch_array($qry_type_code);
    $arrCFC_CAPTION_GEN = array();
    $arrCFC_CAPTION_GEN["CFC_CAPTION_GEN"][$_POST["CFC_CAPTION_GEN"]] = $_POST["CFC_CAPTION_GEN"];
    $arrCFC_CAPTION_GEN["DOSS_CONTROL_GEN"][$recSelectCmdAsset["DOSS_CONTROL_GEN"]] = array(
        "SEQUEST_STATUS" => $rec_type_code["SEQUEST_STATUS"],
        "SALE_STATUS" => $rec_type_code["SALE_STATUS"],
        "ACCOUNTANCY_STATUS" => $rec_type_code["ACCOUNTANCY_STATUS"]
    );

    $data_string = json_encode($arrCFC_CAPTION_GEN);

    /* เก็บ log start AK*/
    unset($fields);
    $fields["PAGE_CODE"]               =   'http://103.40.146.73/LedService.php/upLockAssetCivil';
    $fields["COLUMN1"]                 =     $data_string;
    $fields["CREATE_DATE"]                 =    date("Y-m-d");
    $fields["SYSTEM_TYPE"]                 =   "1";
    $fields["NOTE"]                 =   "ปลดล็อคทรัพย์ เงื่อนไขการทำงาน count(arrCFC_CAPTION_GEN) > 0";
    $fields["REF_ID"]                 =   $_GET['ID'];
    db::db_insert("TEST_DATA_RES", $fields, 'PK_ID', 'PK_ID');
    /* เก็บ log stop AK*/
    $curl = curl_init();

    echo json_encode($arrCFC_CAPTION_GEN);
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
