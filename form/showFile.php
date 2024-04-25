<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include("../include/include.php");	

$DOC_MAS_ID_RES = '50718999';
$json_data = array(
    'DOC_MAS_ID' => $DOC_MAS_ID_RES
);
$json_data = json_encode($json_data);

$post = file_get_contents('http://103.40.146.152/LED_DOC/LED_EDOC_UAT/webservice/get_document_process_data.php', null, stream_context_create(array(
    'http' => array(
        'method' => 'POST',
        'header' => "Content-type: application/json\r\n" . "Connection: close\r\n" . "Content-length: " . strlen($json_data) . "\r\n",
        'content' => $json_data,
    ) ,
)));
if ($post)
{
    $arr_data = json_decode($post, true);
    if ($arr_data['status'] == 1 && $arr_data['data'] != '' )
    {
        $data = $arr_data['data'];
        foreach ($data as $key => $val) $destination =  rand(10, 99) . date('Ymdhis') . "." . $val['FILE_TYPE'];
        $datafile = base64_decode($val['FILE_DATA']);
        $h = fopen("../attach/edocService/FILEWEB/" . $destination, "w");
        fwrite($h, $datafile);
        fclose($h);
        // header('Location: ../attach/edocService/FILEWEB/' . $destination);
        print_pre($arr_data);
    }
    
    
    
}



// unset($data);
// $data['WFS_FIELD_NAME']      = 'ANC_NOTICE_FILE';
// $data['FILE_NAME']           = $val['FILE_NAME'];
// $data['WF_MAIN_ID']          = '106';
// $data['FILE_TYPE']           = 'application/'.$val['FILE_TYPE'];
// $data['FILE_EXT']            =  $val['FILE_TYPE'];
// $data['FILE_SAVE_NAME']      =  $destination;
// $data['FILE_DATE']           =  date('Y-m-d');
// $data['FILE_TIME']           =  date(' H:i:s');
// $data['FILE_STATUS']         =  "Y";

// db::db_insert("WF_FILE",$data,"FILE_ID");



?>
