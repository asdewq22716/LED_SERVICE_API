<?php
include '../include/include.php';

$dataSet["WFR"] = $_GET["WFR"];
$show_data = $_GET["show_data"];

getReviveToWh($dataSet,$show_data);
?>