<?php
$WF_TYPE = "S";
include '../include/comtop_admin.php';

$process = conText($_GET['process']);
$W = conText($_GET['W']);
$WFD = conText($_GET['WFD']);
$WFS = conText($_GET['WFS']);

$_txt_wf_text = "ตั้งค่าการสืบค้น";
$_txt_wf_link = "search_step_form.php?W=".$W."&WFD=0";
$_txt_wf_main = " Search";
$_txt_step_link = "search_step_form.php?W=".$W."&WFD=0";
$txt_head_search = 'ตั้งค่าการค้นหา';
 
include "inc_step_form_edit.php";
 
include '../include/combottom_js.php';
include 'inc_js_step_form_edit.php';
include '../include/combottom_admin.php';
?>