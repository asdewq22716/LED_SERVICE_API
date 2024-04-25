<?php
header('Content-Type: application/json');
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';
$VAL = conText($_GET['VAL']);
$TARGET = conText($_GET['wfs']);
//if($W != ""){ 
echo json_encode($data_list = wf_call_relation($TARGET,'',$WF,$VAL));
db::db_close(); //}
 ?>