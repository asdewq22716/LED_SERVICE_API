<?php
$WF_TYPE = "F";
include '../include/comtop_admin.php';

$process = conText($_GET['process']);
$W = conText($_GET['W']);
$WFD = '0';
$WFS = conText($_GET['WFS']);

$_txt_wf_text = "บริหาร Form";
$_txt_wf_link = "form.php";
$_txt_wf_main = "บริหาร Form";
$_txt_step_link = "form_step_form.php";
 
include "inc_step_form_edit.php";
 
include '../include/combottom_js.php';
include 'inc_js_step_form_edit.php';
include '../include/combottom_admin.php';
?>