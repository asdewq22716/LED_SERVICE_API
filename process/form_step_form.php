<?php
$WF_TYPE = "F";
include '../include/comtop_admin.php';
$W = conText($_GET['W']);
$WFD = '0';

$_url_edit = "form_step_form_edit.php"; 

$txt_head_text = "บริหาร Form";
$txt_head_url = "form.php";

include "inc_step_form.php";
include '../include/combottom_js.php';
include "inc_js_step_form.php";
include '../include/combottom_admin.php'; ?>