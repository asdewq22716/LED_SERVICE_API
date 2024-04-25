<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$table = "WF_BPMN";
$proc = $_POST['process'];
$id = $_POST['id'];
$url_back = $_POST['url_back'];
$BPMN_NAME = $_POST['BPMN_NAME'];
$WF_GROUP_ID = $_POST['WF_GROUP_ID'];
$TOTAL_ROW = conText($_POST['total_row']);

if($proc == "add"){
	$BPMN_ORDER = db::get_max($table, "BPMN_ORDER", array()) + 1;
	
	$a_data = array();
	$a_data['BPMN_NAME'] = $BPMN_NAME;
	$a_data['BPMN_ORDER'] = $BPMN_ORDER;
	$a_data['WF_GROUP_ID'] = $WF_GROUP_ID;
	
	$id = db::db_insert($table, $a_data, "BPMN_ID", "BPMN_ID");
	
	if(!file_exists('../bpmn')){ 
		mkdir('../bpmn',0777); 
	}
	
	//if(!file_exists('../bpmn/bpmn_'.$id.'.tmp')){
		$fp = fopen('../bpmn/bpmn_'.$id.'.tmp', 'w');
		fwrite($fp, $_POST['M_DATA']);
		fclose($fp);	
	//}
	?>
	<script>
		self.parent.location.href = "bpmn_form.php?process=edit&id=<?php echo $id;?>";
	</script>
	<?php
	exit;
}else if($proc == 'edit'){
	$a_data = array();
	$a_data['BPMN_NAME'] = $BPMN_NAME;
	$a_data['WF_GROUP_ID'] = $WF_GROUP_ID;
	
	$cond['BPMN_ID'] = $id;
	db::db_update($table, $a_data, $cond);
	
	if(!file_exists('../bpmn')){ 
		mkdir('../bpmn',0777); 
	}
	//if(file_exists('../bpmn/bpmn_'.$id.'.tmp')){
		$fp = fopen('../bpmn/bpmn_'.$id.'.tmp', 'w');
		fwrite($fp, $_POST['M_DATA']);
		fclose($fp);	
	//}
	?><script>
			alert("Save success.");
		</script><?php
	if($url_back != ''){
		?>
		<script>
			self.parent.location.href = "<?php echo $url_back;?>";
		</script>
		<?php
		exit;
	}
}else if($proc == 'delete'){
	//@unlink("../bpmn/bpmn_".$id.".tmp");
	
	$cond['BPMN_ID'] = $id;
	db::db_delete($table, $cond);
}else if($proc == "re_order"){
	for($i=1; $i<$TOTAL_ROW; $i++){
		
		$BPMN_ORDER = conText($_POST['BPMN_ORDER'.$i]);
		$id = conText($_POST['id'.$i]);

		$a_data['BPMN_ORDER'] = $BPMN_ORDER;
		$a_cond['BPMN_ID'] = $id;
		db::db_update($table, $a_data, $a_cond);	
	}
	echo 'Y';
	db::db_close();
	exit;
}else if($proc == 'copy_bpmn'){
	$BPMN_ORDER = db::get_max($table, "BPMN_ORDER", array()) + 1;
	
	$a_data = array();
	$a_data['BPMN_NAME'] = $BPMN_NAME;
	$a_data['BPMN_ORDER'] = $BPMN_ORDER;
	$a_data['WF_GROUP_ID'] = $WF_GROUP_ID;
	
	$id = db::db_insert($table, $a_data, "BPMN_ID", "BPMN_ID");
	
	if(!file_exists('../bpmn')){ 
		mkdir('../bpmn',0777); 
	}
	
	if(file_exists('../bpmn/bpmn_'.$_POST['BPMN_ID'].'.tmp')){
		@copy('../bpmn/bpmn_'.$_POST['BPMN_ID'].'.tmp', '../bpmn/bpmn_'.$id.'.tmp');
	}
	?>
	<script>
		self.parent.location.href = "bpmn_list.php";
	</script>
	<?php
	exit;
}	
db::db_close();
?>