<?php
$WF_TYPE = "S";
$WF_TYPE_SEARCH = 'Y'; //ตัวแปรของการค้นหาเพื่อใช้ where เงื่อนไข WF_TYPE = 'S' ในหน้าดูหน้าจอ
include '../include/comtop_admin.php';
$W = conText($_GET['W']);
$WFD = '0';

$_url_edit = "search_step_form_edit.php";



$txt_head_search = 'ตั้งค่าการค้นหา';

$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec = db::fetch_array($sql);
if($rec["WF_TYPE"]=="W"){
$txt_head_text = "บริหาร Workflow";
$txt_head_url = "workflow.php";
}
if($rec["WF_TYPE"]=="F"){
$txt_head_text = "บริหาร Form";
$txt_head_url = "form.php";
}
if($rec["WF_TYPE"]=="M"){
$txt_head_text = "บริหาร Master";
$txt_head_url = "master.php";	
}
if($rec["WF_TYPE"]=="R"){
$txt_head_text = "บริหาร Report";
$txt_head_url = "report.php";	
}
include "inc_step_form.php";
include '../include/combottom_js.php';
include "inc_js_step_form.php";
include '../include/combottom_admin.php'; ?>