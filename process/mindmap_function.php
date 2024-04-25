<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$table = "WF_MINDMAP";
$proc = $_POST['process'];
$id = $_POST['id'];
$url_back = $_POST['url_back'];
$MINDMAP_NAME = $_POST['MINDMAP_NAME'];

if($proc == "add"){
	
	$a_data = array();
	$a_data['MINDMAP_NAME'] = $MINDMAP_NAME;
	$id = db::db_insert($table, $a_data, "MINDMAP_ID", "MINDMAP_ID");
	
	if(!file_exists('../mindmap')){ 
		mkdir('../mindmap',0777); 
	}
	
//	if(!file_exists('../mindmap/mindmap_'.$id.'.tmp')){
		$fp = fopen('../mindmap/mindmap_'.$id.'.tmp', 'w');
		fwrite($fp, $_POST['M_DATA']);
		fclose($fp);	
//	}
	?>
	<script>
		self.parent.location.href = "mindmap_form.php?process=edit&id=<?php echo $id;?>";
	</script>
	<?php
	exit;
}else if($proc == 'edit'){
	$a_data = array();
	$a_data['MINDMAP_NAME'] = $MINDMAP_NAME;
	
	$cond['MINDMAP_ID'] = $id;
	db::db_update($table, $a_data, $cond);
	
//	if(file_exists('../mindmap/mindmap_'.$id.'.tmp')){
		$fp = fopen('../mindmap/mindmap_'.$id.'.tmp', 'w');
		fwrite($fp, $_POST['M_DATA']);
		fclose($fp);	
//	}
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
	//@unlink("../mindmap/mindmap_".$id.".tmp");
	
	$cond['MINDMAP_ID'] = $id;
	db::db_delete($table, $cond);
}	
db::db_close();
?>