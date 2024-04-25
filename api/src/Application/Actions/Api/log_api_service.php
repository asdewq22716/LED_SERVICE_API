<?php

$sqlUser = "SELECT * FROM USER_API_SERVICE A INNER JOIN M_SYSTEM B ON B.SYSTEM_ID = A.SYSTEM_TYPE WHERE A.TOKEN_ID =  '$tokenId' ";
$qryUser = db::query($sqlUser);
$dataUser = array();
while ($recUser = db::fetch_array($qryUser)) {
    $dataUser = $recUser;
}
if (count($dataUser) > 0) {
    //     // $token = $_SERVER['HTTP_TOKENAPI'];

    $sqlLogId = db::query("SELECT MAX(LOG_ID) AS LOG FROM M_LOG_API");
    $maxid = db::fetch_array($sqlLogId);

    $id = $maxid['LOG'] + 1;
    $USR_ID = $dataUser['USR_ID'];
    $USR_IDCARE = str_replace('-', '', $dataUser['ID_CARD']);
    $USR_FULLNAME = $dataUser['USR_PREFIX'] . $dataUser['USR_FNAME'] . ' ' . $dataUser['USR_LNAME'];
    $DEP_ID = $dataUser['SYSTEM_TYPE'];
    $DEP_NAME = $dataUser['SYS_NAME'];
    $LOG_DATE = date('Y-m-d');
    $LOG_TIME = date('h:i:s');

    db::query(
        "INSERT INTO M_LOG_API 
        (LOG_ID, API_NAME, USR_ID, USR_IDCARE, USR_FULLNAME, DEP_ID, DEP_NAME, TOKEN_ID, LOG_DATE, LOG_TIME) 
        VALUES 
        ($id, '$serviceName', '$USR_ID', '$USR_IDCARE', '$USR_FULLNAME', '$DEP_ID', '$DEP_NAME', '$tokenId', TO_DATE('$LOG_DATE' , 'YYYY/MM/DD'), '$LOG_TIME') "
    );

    $dir = '../logs_respones_service/';
    if (is_dir($dir) == false) {
        mkdir($dir, 0777);
    }
    $fileName = $serviceName . '_' . $id . '.txt';
    file_put_contents($dir . $fileName, json_encode($obj, JSON_UNESCAPED_UNICODE));

    // insert reqeuest 
    $sqlLogReq = db::query("SELECT MAX(REQUEST_LOG_ID) AS LOG FROM M_LOG_REQUEST");
    $maxReqId = db::fetch_array($sqlLogReq);
    $reqId = $maxReqId['LOG'] + 1;
    foreach ($request as $key_req => $val_req) {
        db::query("INSERT INTO M_LOG_REQUEST (REQUEST_LOG_ID, LOG_ID, REQUEST_NAME, REQUEST_DATA) VALUES ($reqId, $id, '$key_req', '$val_req') ");
        $reqId++;
    }
}
