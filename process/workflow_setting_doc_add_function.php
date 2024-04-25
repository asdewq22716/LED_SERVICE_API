<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$process = conText($_REQUEST['process']);
$table = "DOC_MAIN";
$pk_name = "DOC_ID";

$W =  conText($_POST["W"]);
$WFD =  conText($_POST["WFD"]);
$DOC_TITLE = conText($_POST["DOC_TITLE"]);
$DOC_SORT = conText($_POST["DOC_SORT"]);
$DOC_TYPE = conText($_POST["DOC_TYPE"]);
//$DOC_FILE = conText($_FILES["DOC_FILE"]);
$DOC_LINK = conText($_POST["DOC_LINK"]);
//$DOC_UPLOAD = conText($_FILES["DOC_UPLOAD"]);
$DOC_ID = conText($_POST["DOC_ID"]);
$DOC_STATUS = conText($_POST["DOC_STATUS"]);
$REQUEST_DATA = conText($_POST["REQUEST_DATA"]);
$DOC_USER_ADD = conText($_POST["DOC_USER_ADD"]);

if($DOC_ID != ''){
	$sql_doc = db::query("select * from DOC_MAIN where DOC_ID='".$DOC_ID."' ");
	$rec_doc = db::fetch_array($sql_doc);
}

if($process == 'DOC_ADD'){
	
	if($DOC_TYPE == 'W'){
		
		if($_FILES["DOC_FILE"]["size"] > 0){
		
			$explodeFile = explode('.', $_FILES["DOC_FILE"]["name"]);
			$getExt = strtolower($explodeFile[(count($explodeFile) - 1)]);
			$name = "d_".$W."_".$WFD."_".date("YmdHis").".".$getExt;
			$filename = "../doc/".$name;
			copy($_FILES["DOC_FILE"]["tmp_name"],$filename);
		
			$a_data['WF_MAIN_ID'] = $W;
			$a_data['WFD_ID'] = $WFD;
			$a_data['DOC_TITLE'] = $DOC_TITLE;
			$a_data['DOC_FILE'] = $name;
			$a_data['DOC_IMG'] = '';
			$a_data['DOC_STATUS'] = '';
			$a_data['DOC_SQL'] = '';
			$a_data['DOC_SORT'] = $DOC_SORT;
			$a_data['DOC_TYPE'] = $DOC_TYPE;
			$doc_id = db::db_insert($table, $a_data, $pk_name,$pk_name);
		
		}

		
	}elseif($DOC_TYPE == 'L'){
	
		$a_data['WF_MAIN_ID'] = $W;
		$a_data['WFD_ID'] = $WFD;
		$a_data['DOC_TITLE'] = $DOC_TITLE;
		$a_data['DOC_FILE'] = $DOC_LINK;
		$a_data['DOC_IMG'] = '';
		$a_data['DOC_STATUS'] = '';
		$a_data['DOC_SQL'] = '';
		$a_data['DOC_SORT'] = $DOC_SORT;
		$a_data['DOC_TYPE'] = $DOC_TYPE;
		$doc_id = db::db_insert($table, $a_data, $pk_name,$pk_name);
	
	
	}
	elseif($DOC_TYPE == 'D'){
		if($_FILES["DOC_UPLOAD"]["size"] > 0){
		
			$explodeFile = explode('.', $_FILES["DOC_UPLOAD"]["name"]);
			$getExt = strtolower($explodeFile[(count($explodeFile) - 1)]);
			$name = "ref_".$W."_".$WFD."_".date("YmdHis").".".$getExt;
			$filename = "../doc/".$name;
			copy($_FILES["DOC_UPLOAD"]["tmp_name"],$filename);
		
			$a_data['WF_MAIN_ID'] = $W;
			$a_data['WFD_ID'] = $WFD;
			$a_data['DOC_TITLE'] = $DOC_TITLE;
			$a_data['DOC_FILE'] = $name;
			$a_data['DOC_IMG'] = '';
			$a_data['DOC_STATUS'] = '';
			$a_data['DOC_SQL'] = '';
			$a_data['DOC_SORT'] = $DOC_SORT;
			$a_data['DOC_TYPE'] = $DOC_TYPE;
			$doc_id = db::db_insert($table, $a_data, $pk_name,$pk_name);
		
		
		}
	}
	?>
	<script type="text/javascript">
    self.location.href = 'workflow_setting_doc_var.php?DOC_ID=<?php echo $doc_id;?>';
	</script>
<?php
}elseif($process == 'DOC_EDIT'){ 

	if($rec_doc["DOC_TYPE"] == 'W'){
		
		if($_FILES["DOC_FILE"]["size"] > 0){
			$explodeFile = explode('.', $_FILES["DOC_FILE"]["name"]);
			$getExt = strtolower($explodeFile[(count($explodeFile) - 1)]);
			$name = "d_".$W."_".$WFD."_".date("YmdHis").".".$getExt;
			$filename = "../doc/".$name;
			copy($_FILES["DOC_FILE"]["tmp_name"],$filename);
			if($rec_doc["DOC_FILE"] != ''){
				unlink('../doc/'.$rec_doc["DOC_FILE"]);
			}
			$a_data['DOC_FILE'] = $name;
		}
		
		$a_data['DOC_TITLE'] = $DOC_TITLE;
		$a_data['DOC_STATUS'] = $DOC_STATUS;
		$a_data['DOC_USER_ADD'] = $DOC_USER_ADD;
		$a_cond[$pk_name] = $rec_doc["DOC_ID"];
		db::db_update($table, $a_data, $a_cond);
		$doc_id = $rec_doc["DOC_ID"];
		$doc_id = $DOC_ID;
	}elseif($rec_doc["DOC_TYPE"] == 'L'){
	
		$a_data['DOC_TITLE'] = $DOC_TITLE;
		$a_data['DOC_FILE'] = $DOC_LINK;
		$a_data['DOC_STATUS'] = $DOC_STATUS;
		$a_cond[$pk_name] = $rec_doc["DOC_ID"];
		db::db_update($table, $a_data, $a_cond);
		$doc_id = $rec_doc["DOC_ID"];
	
	}
	elseif($rec_doc["DOC_TYPE"] == 'D'){
		if($_FILES["DOC_UPLOAD"]["size"] > 0){
			$explodeFile = explode('.', $_FILES["DOC_UPLOAD"]["name"]);
			$getExt = strtolower($explodeFile[(count($explodeFile) - 1)]);
			$name = "ref_".$W."_".$WFD."_".date("YmdHis").".".$getExt;
			$filename = "../doc/".$name;
			copy($_FILES["DOC_UPLOAD"]["tmp_name"],$filename);
			unlink('../doc/'.$rec_doc["DOC_FILE"]);
			$a_data['DOC_FILE'] = $name;
		}
		
		$a_data['DOC_TITLE'] = $DOC_TITLE;
		$a_data['DOC_STATUS'] = $DOC_STATUS;
		$a_cond[$pk_name] = $rec_doc["DOC_ID"];
		db::db_update($table, $a_data, $a_cond);
		$doc_id = $rec_doc["DOC_ID"];
	}
	?>
	<script type="text/javascript">
    self.location.href = 'workflow_setting_doc_var.php?DOC_ID=<?php echo $doc_id;?>';
	</script>
<?php
}elseif($process == 'REQUEST_DATA_EDIT'){

	if($REQUEST_DATA == 'S'){ 
		$DOC_SQL = conText($_POST["DOC_SQL"]);
	}else if($REQUEST_DATA  == 'T'){ 
		$DOC_SQL ='';
	}
		
	$a_data['DOC_SQL'] = $DOC_SQL;
	$a_data['DOC_REQUEST_DATA'] = $REQUEST_DATA;
	$a_cond[$pk_name] = $rec_doc["DOC_ID"];
	db::db_update($table, $a_data, $a_cond);
	$doc_id = $rec_doc["DOC_ID"];
	?>
	<script type="text/javascript">
    self.location.href = 'workflow_setting_doc_var.php?DOC_ID=<?php echo $doc_id;?>';
	</script>
<?php
}elseif($process == 'MAP_FIELD_AUTO'){

	$DOC_ID = conText($_POST["DOC_ID"]);		
	//$DOC_STATUS = conText($_POST["DOC_STATUS"]);
	$IMG_STATUS = conText($_POST["IMG_STATUS"]);
	
	
	for($i=1; $i<$_POST["num_i"];$i++){

		$VAR_NAME = conText($_POST["VAR_NAME".$i]);
		$VAR_FIELD = conText($_POST["VAR_FIELD".$i]);
		$VAR_ID = conText($_POST["VAR_ID".$i]);

		
		if($VAR_ID ==''){
			
			$a_data["DOC_ID"] = $DOC_ID;
			$a_data["VAR_NAME"] = $VAR_NAME;
			$a_data["VAR_FIELD"] = $VAR_FIELD;
			$a_data["VAR_TYPE"] = 'V';
			db::db_insert('DOC_VAR', $a_data, 'VAR_ID');

			//$a_doc["DOC_STATUS"] = $DOC_STATUS;
			//$a_doc["DOC_IMG"] = $name;
			$a_cond[$pk_name] = $DOC_ID;
			db::db_update($table, $a_doc, $a_cond);
			unset($a_data);
			unset($a_doc);
			unset($a_cond);
			
		}else{
			
			$a_data["VAR_NAME"] = $VAR_NAME;
			$a_data["VAR_FIELD"] = $VAR_FIELD;
			$a_cond["VAR_ID"] = $VAR_ID;
			db::db_update('DOC_VAR', $a_data, $a_cond);
			
			//$a_doc["DOC_STATUS"] = $DOC_STATUS;
			//$a_doc["DOC_IMG"] = $name;
			$a_cond_doc[$pk_name] = $DOC_ID;
			db::db_update($table, $a_doc, $a_cond_doc);
			unset($a_data);
			unset($a_doc);
			unset($a_cond);
		}

	}
	
	
	for($s=1; $s<$_POST["num_s"];$s++){
	
		$LABEL_NAME = conText($_POST["LABEL_NAME".$s]);
		$LABEL_INPUT = conText($_POST["LABEL_INPUT".$s]);
		$LABEL_VALUES = conText($_POST["LABEL_VALUES".$s]);
		$LABEL_ID = conText($_POST["LABEL_ID".$s]);
	
		/*if($_FILES["DOC_IMG"]["size"]>0){ //// เช็คว่ามีการอัพโหลดไฟล์ไหม คือเช็คจากขนาดไฟล์ ถ้ามากว่า 0 ให้ทำงานต่อ
	
			$type_name = explode(".",$_FILES['DOC_IMG']['name']); ////นามสกุลไฟล์ที่จะต่อ	**
			$name = "doc_".date("YmdHis").".".$type_name[1];///// ** name ชื่อไฟล์ที่จะเก็บลงฐานข้อมูล
			$filename = "../doc_image/".$name; /// icon โฟเดอร์ที่จะเก็บไฟล์
			copy($_FILES["DOC_IMG"]["tmp_name"],$filename);
	
		}else{
			//$name = $_POST["M_ICON_OLD"];
		}*/
		
		if($LABEL_ID ==''){
		
			$a_data["DOC_ID"] = $DOC_ID;
			$a_data["LABEL_NAME"] = $LABEL_NAME;
			$a_data["LABEL_INPUT"] = $LABEL_INPUT;
			$a_data["LABEL_TYPE"] = 'V';
			$a_data["LABEL_VALUES"] = $LABEL_VALUES;
			db::db_insert('DOC_LABEL', $a_data, 'LABEL_ID');
			
			//$a_doc["DOC_STATUS"] = $DOC_STATUS;
			//$a_doc["DOC_IMG"] = $name;
			$a_cond[$pk_name] = $DOC_ID;
			db::db_update($table, $a_doc, $a_cond);
			unset($a_data);
			unset($a_doc);
			unset($a_cond);
		
		}else{
			
			$a_data["LABEL_NAME"] = $LABEL_NAME;
			$a_data["LABEL_INPUT"] = $LABEL_INPUT;
			$a_data["LABEL_VALUES"] = $LABEL_VALUES;
			$a_cond["LABEL_ID"] = $LABEL_ID;
			db::db_update('DOC_LABEL', $a_data, $a_cond);
			
			//$a_doc["DOC_STATUS"] = $DOC_STATUS;
			//$a_doc["DOC_IMG"] = $name;
			$a_cond_doc[$pk_name] = $DOC_ID;
			db::db_update($table, $a_doc, $a_cond_doc);
			
			unset($a_data);
			unset($a_doc);
			unset($a_cond);
		}
	}
	$doc_id = $DOC_ID;
?>
	<script type="text/javascript">
    self.location.href = 'workflow_setting_doc_var.php?DOC_ID=<?php echo $doc_id;?>';
	</script>
<?php
}elseif($process == 'DEL'){
	$DOC_ID = conText($_GET["DOC_ID"]);
	$W = conText($_GET["W"]);
	$WFD = conText($_GET["WFD"]);
	$a_cond["DOC_ID"] = $DOC_ID;
	db::db_delete('DOC_LABEL', $a_cond);
	
	db::db_delete('DOC_VAR', $a_cond);
	
	db::db_delete('DOC_MAIN', $a_cond);

}
?>


<?php
include '../include/combottom_admin.php'; 
?>