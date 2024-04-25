<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php'; 

$W = conText($_POST["W"]);
$WFR = conText($_POST["WFR"]);

$sql = db::query("SELECT WF_MAIN_SHORTNAME,WF_FIELD_PK FROM WF_MAIN WHERE WF_MAIN_ID='".$W."'");
$rec = db::fetch_array($sql);

$a_cond[$rec["WF_FIELD_PK"]] = $WFR;
db::db_delete($rec["WF_MAIN_SHORTNAME"], $a_cond);

db::db_close();

?>