<?php
$HIDE_HEADER = "Y";
include("../include/comtop_admin.php");
$W = conText($_GET['W']);
$date = date('Y/m/d');

$sql = db::query("select WF_MAIN_SHORTNAME,WF_TYPE,WF_MAIN_NAME,WF_MAIN_REMARK,WF_FIELD_PK,WF_GROUP_ID from WF_MAIN  where WF_MAIN_ID ='".$W."'");
$rec_main = db::fetch_array($sql);


$sql_group = db::query("SELECT GROUP_NAME FROM WF_GROUP WHERE GROUP_ID='".$rec_main["WF_GROUP_ID"]."'");
$group = db::fetch_array($sql_group);



if($rec_main["WF_TYPE"] == 'W'){
	$sql_detail = db::query("SELECT * FROM WF_DETAIL WHERE WF_MAIN_ID='".$W."' AND ( WFD_TYPE = 'S' OR WFD_TYPE = 'P') ORDER BY WFD_ORDER");
	$num_rows = db::num_rows($sql_detail);
	$type = 'Workflow';
	
}elseif($rec_main["WF_TYPE"] == 'F' OR $rec_main["WF_TYPE"] == 'M'){
	
	
}

require_once '../PHPWord.php';
$obPHPWord = new PHPWord();
$obPHPWord->addFontStyle('rStyle1', array('name'=>'TH SarabunPSK','bold'=>true, 'italic'=>false, 'size'=>18,'align'=>'center'));
$obPHPWord->addFontStyle('rStyle2', array('name'=>'TH SarabunPSK','bold'=>true, 'italic'=>false, 'size'=>16,'align'=>'center'));
$obPHPWord->addFontStyle('rStyle', array('name'=>'TH SarabunPSK','bold'=>false, 'italic'=>false, 'size'=>16,'align'=>'center'));
$obPHPWord->addParagraphStyle('pStyle', array('align'=>'center', 'spaceAfter'=>50));
$obPHPWord->addParagraphStyle('pStyle1', array('align'=>'left', 'spaceAfter'=>80));
$styleTable = array('borderSize'=>6, 'borderColor'=>'000000', 'cellMargin'=>30);
$obPHPWord->addTableStyle('myOwnTableStyle', $styleTable);


while($detail = db::fetch_array($sql_detail)){

$section = $obPHPWord->createSection();
$table = $section->addTable('myOwnTableStyle');

$table->addRow(100);
$table->addCell(2000)->addText('ระบบ','rStyle2','pStyle1');
$table->addCell(8000)->addText($group["GROUP_NAME"],'rStyle2','pStyle1');
$table->addRow(300);
$table->addCell(2000)->addText('กระบวนงาน','rStyle2','pStyle1');
$table->addCell(8000)->addText($rec_main["WF_MAIN_NAME"],'rStyle2','pStyle1');
$table->addRow(300);
$table->addCell(2000)->addText('หน้าจอ','rStyle2','pStyle1');
$table->addCell(8000)->addText($detail["WFD_NAME"],'rStyle2','pStyle1');
$table->addRow(300);
$table->addCell(2000)->addText('วันที่อัพเดทล่าสุด','rStyle2','pStyle1');
$table->addCell(8000)->addText($date,'rStyle2','pStyle1');

//$section->addText('', 'rStyle2','pStyle1');
$section->addTextBreak(2);
$section->addText('หน้าจอ: '.$detail["WFD_NAME"], 'rStyle2','pStyle1');
//รูปหน้าจอ
$img_name = '../interface/'.$W.'_'.$detail["WFD_ID"].'.png';
$img = getimagesize($img_name);

$h = floor(($img[1]*(640/$img[0])));
//print_pre($img);exit;
$section->addImage($img_name, array('width'=>640, 'height'=> $h,'align'=>'center','borderStyle' => 'solid','borderWidth' => 6,'borderColor' => '000000'));
$section->addTextBreak(2);

$sql_field = db::query("SELECT * FROM WF_STEP_FORM WHERE WF_MAIN_ID='".$W."' AND WFD_ID='".$detail["WFD_ID"]."' ORDER BY WFS_ORDER");
$section = $obPHPWord->createSection();
$obPHPWord->addParagraphStyle('pStyle', array('align'=>'center', 'spaceAfter'=>50));
$obPHPWord->addParagraphStyle('pStyle1', array('align'=>'left', 'spaceAfter'=>80));
$section->addText('ข้อมูลในหน้าจอ: '.$detail["WFD_NAME"], 'rStyle2','pStyle1');
$obPHPWord->addTableStyle('myOwnTableStyle1', $styleTable);
$table = $section->addTable('myOwnTableStyle1');
$table->addRow(300, array('tblHeader' => true));
$table->addCell(2000)->addText('Input','rStyle2','pStyle');
$table->addCell(1500)->addText('Field Name','rStyle2','pStyle');
$table->addCell(4000)->addText('Description','rStyle2','pStyle');
$table->addCell(2500)->addText('Remark','rStyle2','pStyle');


	//foreach($WF_ARR_FIELD as $key => $value){
	while($field = db::fetch_array($sql_field)){
		$step_form = select_field($rec_main["WF_MAIN_SHORTNAME"], $field['WFS_FIELD_NAME']);
		if($step_form["FIELD_REF_TABLE"] != ''){
			$sql_ref = db::query("SELECT WF_TYPE FROM WF_MAIN WHERE WF_MAIN_SHORTNAME = '".$step_form["FIELD_REF_TABLE"]."'");
			$ref = db::fetch_array($sql_ref);
			if($ref["WF_TYPE"] == 'W'){ $type = 'Workflow';}
			elseif($ref["WF_TYPE"] == 'F'){$type = 'Form';}
			elseif($ref["WF_TYPE"] == 'M'){$type = 'Master';}
			else{$type = '';}
			$str = ' ('.$type.' : '.$step_form["FIELD_REF_TABLE"].')';
		}else{
			$str = '';
			
		}
		$table->addRow();
		$table->addCell(2000)->addText($field['WFS_NAME'],'rStyle','pStyle1');	
		$table->addCell(1500)->addText($field['WFS_FIELD_NAME'].$str,'rStyle','pStyle1');	
		$table->addCell(4000)->addText($field['WFS_HELP'],'rStyle','pStyle1');
		$table->addCell(2500)->addText($field['WFS_COMMENT'],'rStyle','pStyle1');
	}	


$section->addText('', 'rStyle2','pStyle1');
$section->addText('ปุ่มควบคุม: '.$detail["WFD_NAME"], 'rStyle2','pStyle1');
$obPHPWord->addTableStyle('myOwnTableStyle2', $styleTable);
$table = $section->addTable('myOwnTableStyle2');

$table->addRow(300, array('tblHeader' => true));
$table->addCell(3500)->addText('Button Name','rStyle2','pStyle');
$table->addCell(4000)->addText('Description','rStyle2','pStyle');
$table->addCell(2500)->addText('Remark','rStyle2','pStyle');			

$btn_name =  '';

//ปุ่มย้อนขั้นตอน
if($detail["WFD_BTN_BACK_STATUS"] == 'Y'){
	
	$btn_name = ($detail["WFD_BTN_BACK_LABEL"] != '')?$detail["WFD_BTN_BACK_LABEL"]:'ปุ่มย้อนขั้นตอน';
	$table->addRow();
	$table->addCell(3500)->addText($btn_name,'rStyle','pStyle1');	
	$table->addCell(4000)->addText('ย้อนไปยังขั้นตอนก่อนหน้า','rStyle','pStyle1');	
	$table->addCell(2500)->addText('','rStyle','pStyle1');	
	
}else{$btn_name =  '';}
//ปุ่มบันทึกชั่วคราว
if($detail["WFD_BTN_TEMP_STATUS"] == 'Y'){
	$btn_name = ($detail["WFD_BTN_TEMP_LABEL"] != '')?$detail["WFD_BTN_TEMP_LABEL"]:'ปุ่มบันทึกชั่วคราว';
	$table->addRow();
	$table->addCell(3500)->addText($btn_name,'rStyle','pStyle1');	
	$table->addCell(4000)->addText('บันทึกข้อมูลแล้วยังไม่ไปขั้นตอนถัดไป','rStyle','pStyle1');	
	$table->addCell(2500)->addText('','rStyle','pStyle1');	
	
}else{$btn_name =  '';}
//ปุ่มบันทึก
if($detail["WFD_BTN_SAVE_STATUS"] == 'Y'){
	$sql_stepnext = db::query("SELECT WFD_NAME FROM WF_DETAIL WHERE WFD_ID='".$detail["WFD_DEFAULT_STEP"]."'");
	$step_next = db::fetch_array($sql_stepnext);
	
	$btn_name = ($detail["WFD_BTN_SAVE_LABEL"] != '')?$detail["WFD_BTN_SAVE_LABEL"]:'ปุ่มบันทึก';
	$table->addRow();
	$table->addCell(3500)->addText($btn_name,'rStyle','pStyle1');	
	$table->addCell(4000)->addText('บันทึกข้อมูลแล้วไปยังหน้า “'.$step_next["WFD_NAME"].'”','rStyle','pStyle1');	
	$table->addCell(2500)->addText('','rStyle','pStyle1');	
	
}else{$btn_name =  '';}
//ปุ่มดำเนินการ
/*
if($detail["WFD_BTN_CON_STATUS"] == 'Y'){
	$btn_name = ($detail["WFD_BTN_CON_LABEL"] != '')?$detail["WFD_BTN_CON_LABEL"]:'ปุ่มดำเนินการ';
	$table->addRow();
	$table->addCell(3500)->addText($btn_name,'rStyle','pStyle1');	
	$table->addCell(4000)->addText('บันทึกแล้วไปยังหน้า “อนุมัติข้อมูล”','rStyle','pStyle1');	
	$table->addCell(2500)->addText('','rStyle','pStyle1');	
	
}else{$btn_name =  '';}	*/

}

// Save File
$temp_file = 'prototype.docx';
$objWriter = PHPWord_IOFactory::createWriter($obPHPWord, 'Word2007');
$objWriter->save($temp_file);

header('Content-Description: File Transfer');
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment; filename='.$temp_file);
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . filesize($temp_file));
ob_clean();
flush();
readfile($temp_file);
unlink($temp_file); // deletes the temporary file

?>




<?php
db::db_close();
?>