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

/* $str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true); */

$POST = $_REQUEST;
$PAGE_CODE = $POST['W'];
$WFR_API = $POST['WFR'];
$SYSTEM_TYPE = $POST["systemCode"];
if ($WFR_API != "") {
    $sqlSelectData = "	select * from WH_REHABILITATION_CASE_DETAIL
                            where 		REHAB_CODE='" . $WFR_API . "' 
						";
    $querySelectData = db::query($sqlSelectData);
    $dataSelectData = db::fetch_array($querySelectData);


    $sql_person_Revive = "SELECT b.* FROM WH_REHABILITATION_CASE_DETAIL a
    JOIN WH_REHABILITATION_PERSON b ON a.WH_REHAB_ID =b.WH_REHAB_ID 
    WHERE 1=1
     AND a.REHAB_CODE ='" . $WFR_API . "'
     AND b.REGISTER_CODE IS NOT NULL
     AND b.CONCERN_NAME ='เจ้าหนี้'";

    $query_Revive = db::query($sql_person_Revive);
    $data_array_Revive = db::num_rows($sql_person_Revive);
    $REGISTERCODE = '';
    $CONCERN_CODE = '';
    $query_Revive = db::query($sql_person_Revive);

    $array_register = [];
    $array_data_detial = [];
    $data_count = CEIL($data_array_Revive / 500);

    $data_count_num=0;
    $num_A = 0;
    $num_B = 0;
    while ($rec_Revive = db::fetch_array($query_Revive)) {
        $num_A++;
        $num_B++;
        $REGISTERCODE .=  $rec_Revive["REGISTER_CODE"] . ($rec_Revive["REGISTER_CODE"] != "" ? "," : "");
        $CONCERN_CODE .= $rec_Revive["CONCERN_CODE"]  . ($rec_Revive["CONCERN_CODE"] != "" ? "," : "");
        if ($num_A == 500||$data_array_Revive==$num_B) {
            $num_A = 0;
            $array_register[$data_count_num]=cut_last_comma($REGISTERCODE);
            $sql_Revive="SELECT a.REGISTER_CODE FROM VIEW_WH_ALL_CASE_PERSON a 
                                WHERE 1=1
                                AND a.REGISTER_CODE IN (".result_array(cut_last_comma($REGISTERCODE)).")
                                --AND a.SYSTEM_TYPE !='Revive'
                                GROUP BY a.REGISTER_CODE";
            $query_Revive_detial = db::query($sql_Revive);
            //echo $sql_Revive;
            while ($rec_Revive_detial = db::fetch_array($query_Revive_detial)) {
                $array_data_detial[]= $rec_Revive_detial['REGISTER_CODE'];
            }
            $data_count_num++;
            $REGISTERCODE="";
        }
    }
    
    $array_link = "";
    foreach (json_decode($str_json, true) as $sh1 => $ch1) {
        $array_link .= "&" . $sh1 . "=" . $ch1;
    }
    unset($fields);
    $fields["PAGE_CODE"]           =    $W;
    $fields["WFR"]                 =    $WFR;
    $fields["COLUMN1"]             =    $array_link;
    $fields["CREATE_DATE"]         =    date("Y-m-d");
    $fields["SYSTEM_TYPE"]         =    "4";
    db::db_insert("TEST_DATA_RES", $fields, 'PK_ID', 'PK_ID');
}

$num = count($array_data_detial);

if ($num > 0) {
    $row['ResponseCode'] = array('ResCode' => '000', 'ResMeassage' => "SUCCESS");
    $row['array_data_detial'] = $array_data_detial;
    $row['WFR'] = $WFR_API;
} else {
    $row['ResponseCode'] = array('ResCode' => '102', 'ResMeassage' => "NOT FOUND");
}

echo json_encode($row);
