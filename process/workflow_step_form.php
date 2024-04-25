<?php
$WF_TYPE = "W";
include '../include/comtop_admin.php';
$W = conText($_GET['W']);
$WFD = conText($_GET['WFD']);

$_url_edit = "workflow_step_form_edit.php"; 

$txt_head_text = "บริหาร Workflow";
$txt_head_url = "workflow.php";

$sql_detail = db::query("select * from WF_DETAIL where WFD_ID = '".$WFD."'");
$rec_detail = db::fetch_array($sql_detail);

include "inc_step_form.php";
include '../include/combottom_js.php';
include "inc_js_step_form.php";
include '../include/combottom_admin.php'; ?>