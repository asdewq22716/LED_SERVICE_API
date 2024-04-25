<?php
$HIDE_HEADER = "P";
include '../include/comtop_admin.php';

$W = conText($_GET['W']);
$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec_main = db::fetch_array($sql);
include '../workflow/report_dash.php';
 ?>