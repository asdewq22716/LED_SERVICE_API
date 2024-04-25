<?php
$WF_TYPE = "W";
include '../include/comtop_admin.php';

$process = conText($_GET['process']);
$W = conText($_GET['W']);
$WFD = conText($_GET['WFD']);
$WFS = conText($_GET['WFS']);

$_txt_wf_text = "บริหาร Workflow";
$_txt_wf_link = "workflow.php";
$_txt_wf_main = "บริหาร Workflow";
$_txt_step_link = "workflow_step_form.php";
 
include "inc_step_form_edit.php";
 
include '../include/combottom_js.php';
include 'inc_js_step_form_edit.php';
include '../include/combottom_admin.php';
?>