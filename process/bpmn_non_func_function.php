<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$table = "WF_BPMN_NON_FUNC";
$proc = $_POST['process'];
$BPMN_ID = $_POST['BPMN_ID'];
$id = $_POST['id'];
$type = $_POST['type'];
$topic = $_POST['topic'];
$back_page_old = $_POST['back_page_old'];

if($proc == 'add_row'){
	$random = bsf_random(10);
	$arr_priority = array(1=>"สำคัญมาก",2=>"สำคัญ",3=>"ไม่สำคัญ");
	?>
	<tr id="tr_<?php echo $random; ?>">
		<input type="hidden" name="FID<?php echo $type;?>[]" value="<?php echo $random; ?>">
		<input type="hidden" name="NON_FUNC_TOPIC_<?php echo $type;?>_<?php echo $random;?>" id="NON_FUNC_TOPIC_<?php echo $type;?>_<?php echo $random;?>" value="<?php echo $topic;?>">
		<td class="text-center">
			<input type="text" name="NON_FUNC_ORDER_<?php echo $type;?>_<?php echo $random;?>" id="NON_FUNC_ORDER_<?php echo $type;?>_<?php echo $random;?>" class="form-control" style="width:80px;">
		</td>
		<td class="text-left">
			<textarea name="NON_FUNC_DET_<?php echo $type;?>_<?php echo $random;?>" id="NON_FUNC_DET_<?php echo $type;?>_<?php echo $random;?>" class="form-control"></textarea>
		</td>
		<td class="text-left">
			<select name="PRIORITY_NO_<?php echo $type;?>_<?php echo $random;?>" id="PRIORITY_NO_<?php echo $type;?>_<?php echo $random;?>" class="select2" placeholder="เลือก...">
				<option value=""></option>
				<?php foreach($arr_priority as $key => $val){?>
					<option value="<?php echo $key;?>"><?php echo $val;?></option>
				<?php } ?>
			</select>
		</td>
		<td class="text-center">
			<nobr>
				<button type="button" class="btn btn-danger btn-icon" data-toggle="tooltip" data-placement="top" title="ลบ" onclick="delete_non_func_bpmn('<?php echo $random;?>');">
					<i class="icofont icofont-trash"></i>
				</button>
			</nobr>
		</td>
	</tr>
	<?php
	exit;
}else if($proc == "add_non_func"){
	for($n=1;$n<=3;$n++){
		$TOTAL_ROW = count($_POST['FID'.$n]);
		for($i=0;$i<$TOTAL_ROW;$i++){
			
			$val = $_POST['FID'.$n][$i];
			$NON_FUNC_ORDER = $_POST['NON_FUNC_ORDER_'.$n.'_'.$val];
			$NON_FUNC_DET = $_POST['NON_FUNC_DET_'.$n.'_'.$val];
			$PRIORITY_NO = $_POST['PRIORITY_NO_'.$n.'_'.$val];
			$NON_FUNC_TYPE = $n;		
			$NON_FUNC_TOPIC = $_POST['NON_FUNC_TOPIC_'.$n.'_'.$val];		
			
			$a_data = array();
			$a_data['BPMN_ID'] = $BPMN_ID;
			$a_data['NON_FUNC_ORDER'] = $NON_FUNC_ORDER;
			$a_data['NON_FUNC_DET'] = $NON_FUNC_DET;
			$a_data['PRIORITY_NO'] = $PRIORITY_NO;
			$a_data['NON_FUNC_TYPE'] = $NON_FUNC_TYPE;
			$a_data['NON_FUNC_TOPIC'] = $NON_FUNC_TOPIC;
			
			if(is_numeric($val)){
				db::db_update($table, $a_data, array("NON_FUNC_ID" => $val));
			}else{
				db::db_insert($table, $a_data, "NON_FUNC_ID");
			}
		}
	}
	
	$url_back = ($back_page_old == 'Y') ? "bpmn_non_func_form.php?BPMN_ID=".$BPMN_ID."" : "bpmn_list.php";
	redirect($url_back);
	exit;
}else if($proc == 'delete'){
	$cond['NON_FUNC_ID'] = $id;
	db::db_delete($table, $cond);
}
db::db_close();
?>