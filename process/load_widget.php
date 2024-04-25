<?php
session_start();
$HIDE_HEADER = "Y";
include '../include/config.php';
$WG = conText($_GET['WG']);
echo bsf_widget($WG,'N'); 
db::db_close();
?>