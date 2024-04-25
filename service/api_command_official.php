<?php
include '../include/include.php';
include '../include/func_Nop.php';
$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);

$toPersonId=$POST['toPersonId'];
$systemCode=$POST['systemCode'];
$token = 1;
if ($token == 1) {
    $link="";
    $obj = array();
    $sql_DOC_CMD = "SELECT COUNT(A.ID) AS COUNT_TOTAL  FROM M_DOC_CMD A
                        LEFT JOIN M_CMD_SYSTEM B ON A.SYS_NAME = B.CMD_SYSTEM_ID
                        LEFT JOIN M_SERVICE_CMD C ON A.CASE_TYPE = C.CMD_TYPE_CODE
                        LEFT JOIN M_CMD_PERSON D ON	D.PERSON_ID = A.PERSON_ID
                        LEFT JOIN M_CMD_TYPE E ON C.CMD_TYPE_ID = E.CMD_TYPE_ID
                        WHERE 1 = 1	
                       -- AND NVL(A.REF_ID, 0) = 0 
                       -- AND A.TO_PERSON_ID ='" . $toPersonId . "'
                       AND (A.SEND_TO = '".$systemCode."' and (A.TO_PERSON_ID = '" . $toPersonId . "' or A.TRANSACTION_APPROVE_PERSON = '" . $toPersonId . "'))
                        ORDER BY	
                        A.CMD_DOC_DATE DESC,
                        A.CMD_DOC_TIME DESC";
    $query_DOC_CMD = db::query($sql_DOC_CMD);
    $rec_DOC_CMD = db::fetch_array($query_DOC_CMD);
   
    $obj[] ="http://103.208.27.224:81/led_service_api/public/search_data_cmd.php?1=1" . "&TO_PERSON_ID=".$toPersonId."&SEND_TO=".$systemCode;
}
$num = count($obj);
if ($num > 0) {

    $row['ResponseCode'] = array('ResCode' => '000', 'ResMeassage' => "SUCCESS");
    $row['link'] = $obj;
    $row['amount'] =strval($rec_DOC_CMD['COUNT_TOTAL']);
} else {
    $row['ResponseCode'] = array('ResCode' => '102', 'ResMeassage' => "NOT FOUND");
}
echo json_encode($row);
