<?php
$WF_TYPE = "M";
include '../include/comtop_admin.php';

$process = conText($_GET['process']);
$W = conText($_GET['W']);
$WFD = '0';
$WFS = conText($_GET['WFS']);

$_txt_wf_text = "บริหาร Master";
$_txt_wf_link = "master.php";
$_txt_wf_main = "บริหาร Master";
$_txt_step_link = "master_step_form.php";
 
include "inc_step_form_edit.php";
 
include '../include/combottom_js.php';
include 'inc_js_step_form_edit.php';
include '../include/combottom_admin.php';
?>