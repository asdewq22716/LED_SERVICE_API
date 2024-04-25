<?php
$HIDE_HEADER = "Y";
include("../include/comtop_admin.php");

//$WF_SELECT = conText($_REQUEST["WF_SELECT"]);
if(count($_REQUEST["WF_SELECT"] > 0)){
	$W = implode(',',$_REQUEST["WF_SELECT"]);
	$W = conText($W);
	
	$array_wf = array();
	
	$sql = db::query("select WF_MAIN_SHORTNAME,WF_TYPE,WF_MAIN_NAME,WF_MAIN_REMARK,WF_FIELD_PK from WF_MAIN where WF_MAIN_ID IN (".$W.") ORDER BY WF_MAIN_SHORTNAME");


	require_once '../PHPWord.php';
	$obPHPWord = new PHPWord();
	$section = $obPHPWord->createSection();
	$obPHPWord->addFontStyle('rStyle1', array('name'=>'TH SarabunPSK','bold'=>true, 'italic'=>false, 'size'=>16,'align'=>'center'));
	$obPHPWord->addFontStyle('rStyle2', array('name'=>'TH SarabunPSK','bold'=>true, 'italic'=>false, 'size'=>14,'align'=>'center'));
	$obPHPWord->addFontStyle('rStyle3', array('name'=>'TH SarabunPSK','bold'=>true, 'italic'=>false, 'size'=>14,'align'=>'center'));
	$obPHPWord->addFontStyle('rStyle', array('name'=>'TH SarabunPSK','bold'=>false, 'italic'=>false, 'size'=>14,'align'=>'center'));
	$obPHPWord->addParagraphStyle('pStyle', array('align'=>'center', 'spaceAfter'=>50));
	$obPHPWord->addParagraphStyle('pStyle1', array('align'=>'left', 'spaceAfter'=>80));
	$obPHPWord->addParagraphStyle('pStyleH', array('align'=>'center', 'spaceAfter'=>80,'background'=>'000000'));
	$styleTable = array('borderSize'=>6, 'borderColor'=>'000000', 'cellMargin'=>80);
	$obPHPWord->addTableStyle('myOwnTableStyle', $styleTable);
	$section->addText('พจนานุกรมข้อมูล (Data Dictionary)', 'rStyle1','pStyle');
	$table = $section->addTable('myOwnTableStyle');
	$table->addRow(300);
	$table->addCell(1000)->addText('Module','rStyle1','pStyle');
	$table->addCell(4000)->addText('Table Name','rStyle1','pStyle');
	$table->addCell(4000)->addText('Table Description','rStyle1','pStyle');

	$obPHPWord->addFontStyle('rStyle1', array('name'=>'TH SarabunPSK','bold'=>false, 'italic'=>false, 'size'=>16,'align'=>'center'));
	$n = 1;
	while($rec_data = db::fetch_array($sql)){
		$detail = '';
		if($rec_data['WF_MAIN_REMARK'] != ''){
			$detail = $rec_data['WF_MAIN_REMARK'];
		}else{
			$detail = $rec_data['WF_MAIN_NAME'];
		}
		$table->addRow(300);
		$table->addCell(1000)->addText('','rStyle','pStyle');
		$table->addCell(4000)->addText($rec_data['WF_MAIN_SHORTNAME'],'rStyle','pStyle1');
		$table->addCell(4000)->addText($detail,'rStyle','pStyle1');
		$array_wf[$n]['WF_MAIN_SHORTNAME'] = $rec_data['WF_MAIN_SHORTNAME'];
		$array_wf[$n]['WF_MAIN_NAME'] = $rec_data['WF_MAIN_NAME'];
		$array_wf[$n]['WF_MAIN_REMARK'] = $rec_data['WF_MAIN_REMARK'];
		$array_wf[$n]['WF_FIELD_PK'] = $rec_data['WF_FIELD_PK'];
		$array_wf[$n]['WF_TYPE'] = $rec_data['WF_TYPE'];
		$n++;
	}

		$i=1;
		foreach($array_wf as $_val){
			$remark = ($_val["WF_MAIN_REMARK"] != '')?$_val["WF_MAIN_REMARK"]:$_val["WF_MAIN_NAME"];
			$section = $obPHPWord->createSection(array('orientation'=>'landscape'));
			
			$obPHPWord->addParagraphStyle('pStyle', array('align'=>'center', 'spaceAfter'=>50));
			$obPHPWord->addParagraphStyle('pStyle1', array('align'=>'left', 'spaceAfter'=>80));
			
			$section->addText('ตารางที่ '.$i.' ตาราง'.$_val["WF_MAIN_NAME"].' ('.$_val["WF_MAIN_SHORTNAME"].')','rStyle1','pStyle1');
			$styleTable = array('borderSize'=>6, 'borderColor'=>'000000', 'cellMargin'=>80 );
			$obPHPWord->addTableStyle('myOwnTableStyle', $styleTable);
			$table = $section->addTable('myOwnTableStyle');
			//$table->addRow(300);
			//$table->addCell(15000)->addText('Table Name : '.$_val["WF_MAIN_SHORTNAME"], 'rStyle2','pStyle1');
			//$table->addRow(300);
			//$table->addCell(15000)->addText('Table Description : '.$remark, 'rStyle2','pStyle1');
			
			$obPHPWord->addTableStyle('myOwnTableStyle1', $styleTable);
			$table = $section->addTable('myOwnTableStyle1');
			
			$table->addRow(300, array('tblHeader' => true));
			$table->addCell(800)->addText('ลำดับ','rStyle3','pStyle');
			$table->addCell(3000)->addText('ชื่อแอตทริบิวต์','rStyle3','pStyle');
			$table->addCell(1000)->addText('ชนิดข้อมูล','rStyle3','pStyle');
			$table->addCell(800)->addText('ขนาด','rStyle3','pStyle');
			$table->addCell(700)->addText('คีย์','rStyle3','pStyle');
			$table->addCell(5000)->addText('คำอธิบาย','rStyle3','pStyle'); 
			$table->addCell(2000)->addText('ตารางอ้างอิง','rStyle3','pStyle');
			
			$table->addRow(300, array('tblHeader' => true));
			$table->addCell(800)->addText('No.','rStyle3','pStyleH');
			$table->addCell(3000)->addText('(Attribute Name)','rStyle3','pStyle');
			$table->addCell(1000)->addText('(Type)','rStyle3','pStyle');
			$table->addCell(800)->addText('(Size)','rStyle3','pStyle');
			$table->addCell(700)->addText('(PK/FK)','rStyle3','pStyle');
			$table->addCell(5000)->addText('(Description)','rStyle3','pStyle'); 
			$table->addCell(2000)->addText('(Reference)','rStyle3','pStyle');
			
			$WF_ARR_FIELD = db::show_field($_val["WF_MAIN_SHORTNAME"]);
							
			foreach($WF_ARR_FIELD as $key => $value){
				
				$step_form = select_field($_val["WF_MAIN_SHORTNAME"], $value);
				if($step_form['FIELD_COMMENT'] == ''){
					$description = show_sys_comment($_val["WF_TYPE"], $value);
					$step_form['FIELD_COMMENT'] = $description;
					if($step_form['FIELD_NAME'] == $_val["WF_FIELD_PK"] && $_val["WF_TYPE"] == 'M'){
						$step_form['FIELD_COMMENT'] = 'รหัส PK ของตาราง';
					}
				}
				if($step_form['FIELD_NAME'] == $_val["WF_FIELD_PK"]){$pk = 'PK';}else{
					if($step_form['FIELD_REF_TABLE'] != ''){
						$pk = 'FK';
					}else{
						$pk = '';
						
					}
				} 
				//$ref_table = ($step_form['FIELD_REF_TABLE'] != '')?$step_form['FIELD_REF_TABLE'].' ('.$step_form["FIELD_REF_PK"].')':'';
				$ref_table = ($step_form['FIELD_REF_TABLE'] != '')?$step_form['FIELD_REF_TABLE']:'';
				$table->addRow();
				$table->addCell(800)->addText(($key+1),'rStyle','pStyle');
				$table->addCell(3000)->addText($step_form['FIELD_NAME'],'rStyle','pStyle1');
				$table->addCell(1000)->addText($step_form['FIELD_TYPE'],'rStyle','pStyle1');
				$table->addCell(800)->addText($step_form['FIELD_LENGTH'],'rStyle','pStyle');
				$table->addCell(700)->addText($pk,'rStyle','pStyle'); 
				$table->addCell(5000)->addText($step_form['FIELD_COMMENT'],'rStyle','pStyle1');
				$table->addCell(2000)->addText($ref_table,'rStyle','pStyle1');
								
			}
			$i++;
		}

	// Save File
	$temp_file = 'DOC_DATADICTIONARY_'.$_val['WF_MAIN_SHORTNAME'].'.docx';
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

}
db::db_close();
?>