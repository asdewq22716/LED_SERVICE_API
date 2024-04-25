<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$table = "WF_BPMN_DESC";
$proc = $_POST['process'];
$BPMN_ID = $_POST['BPMN_ID'];
$id = $_POST['id'];
$type = $_POST['type'];
$back_page_old = $_POST['back_page_old'];

$attach_folder = '../bpmn_desc';

if($proc == 'add_row'){
	$random = bsf_random(10);
	?>
	<tr id="tr_<?php echo $random; ?>">
		<input type="hidden" name="FID[]" value="<?php echo $random; ?>">
		<td class="text-center">
			<input type="text" name="DESC_ORDER_<?php echo $random;?>" id="DESC_ORDER_<?php echo $random;?>" class="form-control" style="width:80px;">
		</td>
		<td class="text-left">
			<textarea name="DESC_DETAIL_<?php echo $random;?>" id="DESC_DETAIL_<?php echo $random;?>" class="form-control"></textarea>
		</td>
		<td class="text-left">
			<textarea name="FORM_DETAIL1_<?php echo $random;?>" id="FORM_DETAIL1_<?php echo $random;?>" class="form-control"></textarea>
			<?php echo form_ifile("FORM_ATTACH1_".$random,""," ","single","","");?>
		</td>
		<td class="text-left">
			<textarea name="FORM_DETAIL2_<?php echo $random;?>" id="FORM_DETAIL2_<?php echo $random;?>" class="form-control"></textarea>
			<?php echo form_ifile("FORM_ATTACH2_".$random,""," ","single","","");?>
		</td>
		<td class="text-left">
			<textarea name="FORM_DETAIL3_<?php echo $random;?>" id="FORM_DETAIL3_<?php echo $random;?>" class="form-control"></textarea>
			<?php echo form_ifile("FORM_ATTACH3_".$random,""," ","single","","");?>
		</td>
		<td class="text-left">
			<textarea name="REQ_DETAIL_<?php echo $random;?>" id="REQ_DETAIL_<?php echo $random;?>" class="form-control"></textarea>
			<?php echo form_ifile("REQ_ATTACH_".$random,""," ","single","","");?>
		</td>
		<td class="text-center">
			<nobr>
				<button type="button" class="btn btn-danger btn-icon" data-toggle="tooltip" data-placement="top" title="ลบ" onclick="delete_desc_bpmn('<?php echo $random;?>');">
					<i class="icofont icofont-trash"></i>
				</button>
			</nobr>
		</td>
	</tr>
	<?php
	exit;
}else if($proc == "add_desc"){
	if(!file_exists($attach_folder)){ mkdir($attach_folder,0777); }
	
	$TOTAL_ROW = count($_POST['FID']);
	for($i=0;$i<$TOTAL_ROW;$i++){
		
		$val = $_POST['FID'][$i];
		$DESC_ORDER = $_POST['DESC_ORDER_'.$val];
		$DESC_DETAIL = $_POST['DESC_DETAIL_'.$val];
		
		$FORM_DETAIL1 = $_POST['FORM_DETAIL1_'.$val];
		$FORM_ATTACH1 = $_FILES['FORM_ATTACH1_'.$val];
		$FORM_ATTACH1_OLD = $_POST['FORM_ATTACH1_OLD_'.$val];
		
		$FORM_DETAIL2 = $_POST['FORM_DETAIL2_'.$val];
		$FORM_ATTACH2 = $_FILES['FORM_ATTACH2_'.$val];
		$FORM_ATTACH2_OLD = $_POST['FORM_ATTACH2_OLD_'.$val];
		
		$FORM_DETAIL3 = $_POST['FORM_DETAIL3_'.$val];
		$FORM_ATTACH3 = $_FILES['FORM_ATTACH3_'.$val];
		$FORM_ATTACH3_OLD = $_POST['FORM_ATTACH3_OLD_'.$val];
		
		$REQ_DETAIL = $_POST['REQ_DETAIL_'.$val];
		$REQ_ATTACH = $_FILES['REQ_ATTACH_'.$val];
		$REQ_ATTACH_OLD = $_POST['REQ_ATTACH_OLD_'.$val];
		
		$a_data = array();
		
		if($FORM_ATTACH1['size'][0] > 0){
			$ext = explode('.',$FORM_ATTACH1["name"][0]);
			$extension = strtolower($ext[(count($ext) - 1)]);
			$file_name = 'b'.date('YmdHis').'_'.bsf_random(10).'.'.$extension;
			@unlink($attach_folder.'/'.$FORM_ATTACH1_OLD);
			@copy($FORM_ATTACH1["tmp_name"][0], $attach_folder.'/'.$file_name);
			$a_data['FORM_ATTACH1'] = $file_name;
			$a_data['FORM_ATTACH1_ORI'] = $FORM_ATTACH1['name'][0];
		}
		if($FORM_ATTACH2['size'][0] > 0){
			$ext = explode('.',$FORM_ATTACH2["name"][0]);
			$extension = strtolower($ext[(count($ext) - 1)]);
			$file_name = 'b'.date('YmdHis').'_'.bsf_random(10).'.'.$extension;
			@unlink($attach_folder.'/'.$FORM_ATTACH2_OLD);
			@copy($FORM_ATTACH2["tmp_name"][0], $attach_folder.'/'.$file_name);
			$a_data['FORM_ATTACH2'] = $file_name;
			$a_data['FORM_ATTACH2_ORI'] = $FORM_ATTACH2['name'][0];
		}
		if($FORM_ATTACH3['size'][0] > 0){
			$ext = explode('.',$FORM_ATTACH3["name"][0]);
			$extension = strtolower($ext[(count($ext) - 1)]);
			$file_name = 'b'.date('YmdHis').'_'.bsf_random(10).'.'.$extension;
			@unlink($attach_folder.'/'.$FORM_ATTACH3_OLD);
			@copy($FORM_ATTACH3["tmp_name"][0], $attach_folder.'/'.$file_name);
			$a_data['FORM_ATTACH3'] = $file_name;
			$a_data['FORM_ATTACH3_ORI'] = $FORM_ATTACH3['name'][0];
		}
		if($REQ_ATTACH['size'][0] > 0){
			$ext = explode('.',$REQ_ATTACH["name"][0]);
			$extension = strtolower($ext[(count($ext) - 1)]);
			$file_name = 'b'.date('YmdHis').'_'.bsf_random(10).'.'.$extension;
			@unlink($attach_folder.'/'.$REQ_ATTACH_OLD);
			@copy($REQ_ATTACH["tmp_name"][0], $attach_folder.'/'.$file_name);
			$a_data['REQ_ATTACH'] = $file_name;
			$a_data['REQ_ATTACH_ORI'] = $REQ_ATTACH['name'][0];
		}
		
		$a_data['BPMN_ID'] = $BPMN_ID;
		$a_data['DESC_ORDER'] = $DESC_ORDER;
		$a_data['DESC_DETAIL'] = $DESC_DETAIL;
		$a_data['FORM_DETAIL1'] = $FORM_DETAIL1;
		$a_data['FORM_DETAIL2'] = $FORM_DETAIL2;
		$a_data['FORM_DETAIL3'] = $FORM_DETAIL3;
		$a_data['REQ_DETAIL'] = $REQ_DETAIL;
		
		if(is_numeric($val)){
			db::db_update($table, $a_data, array("DESC_ID" => $val));
		}else{
			db::db_insert($table, $a_data, "DESC_ID");
		}
	}
	
	$url_back = ($back_page_old == 'Y') ? "bpmn_desc_form.php?BPMN_ID=".$BPMN_ID."" : "bpmn_list.php";
	redirect($url_back);
	exit;
}else if($proc == 'delete'){
	if(is_numeric($id)){
		$q_desc = db::query("SELECT * FROM WF_BPMN_DESC WHERE DESC_ID = '".$id."'");
		$r_desc = db::fetch_array($q_desc);
		
		@unlink($attach_folder.'/'.$r_desc['FORM_ATTACH1']);
		@unlink($attach_folder.'/'.$r_desc['FORM_ATTACH2']);
		@unlink($attach_folder.'/'.$r_desc['FORM_ATTACH3']);
		@unlink($attach_folder.'/'.$r_desc['REQ_ATTACH']);
		$cond['DESC_ID'] = $id;
		db::db_delete($table, $cond);
	}
}else if($proc == 'delete_file'){
	$q_desc = db::query("SELECT * FROM WF_BPMN_DESC WHERE DESC_ID = '".$id."'");
	$r_desc = db::fetch_array($q_desc);
	
	$a_data = array();
	if($type == 1){
		$a_data['FORM_ATTACH1'] = '';
		@unlink($attach_folder.'/'.$r_desc['FORM_ATTACH1']);
	}else if($type == 2){
		$a_data['FORM_ATTACH2'] = '';
		@unlink($attach_folder.'/'.$r_desc['FORM_ATTACH2']);
	}else if($type == 3){
		$a_data['FORM_ATTACH3'] = '';
		@unlink($attach_folder.'/'.$r_desc['FORM_ATTACH3']);
	}else if($type == 4){
		$a_data['REQ_ATTACH'] = '';
		@unlink($attach_folder.'/'.$r_desc['REQ_ATTACH']);
	}
	
	db::db_update($table, $a_data, array("DESC_ID" => $id));
}
db::db_close();
?>