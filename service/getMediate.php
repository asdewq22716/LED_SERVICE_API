<?php
include '../include/include.php';

$WFR = $_GET["WFR"];
$show_data = $_GET["show_data"];
getMedToWh($WFR, $show_data);
