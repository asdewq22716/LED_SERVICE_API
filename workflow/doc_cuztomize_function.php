<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php'; 
$process = conText($_REQUEST['process']);
$table = "DOC_USER";
$pk_name = "DU_ID";
$path_file = "../attach/";
$DOC_ID = conText($_REQUEST['DOC_ID']);
$W = conText($_REQUEST['W']);
$WFR = conText($_REQUEST['WFR']);
$DU_EDIT_NAME = conText($_POST['DU_EDIT_NAME']);
$DU_ID = conText($_GET['DU_ID']);
if($process == "add_doc")
{
	
	if($_FILES['DU_FILE_NAME']['error'] == 0)
	{
		$dir = explode(".", $_FILES['DU_FILE_NAME']["name"]);
		$exten = $dir[count($dir) - 1];
		$exten = strtolower($exten);
		$pic = "doc_".date("YmdHis").".".$exten;

		copy($_FILES['DU_FILE_NAME']["tmp_name"], $path_file.$pic);

		$a_data['DOC_ID'] = $DOC_ID;
		$a_data['USR_ID'] = $_SESSION['WF_USER_ID'];
		$a_data['DU_FILE_NAME'] = $path_file.$pic;
		$a_data['DU_EDIT_NAME'] = $DU_EDIT_NAME;

		db::db_insert($table, $a_data, $pk_name);
		unset($a_data);
	}
}elseif($process == "del_doc"){
	$a_cond1["DU_ID"] = $DU_ID;
	db::db_delete('DOC_USER', $a_cond1);
	
}



db::db_close();
?>
<script type="text/javascript">
	window.location.href="doc_customize.php?W=<?php echo $W; ?>&WFR=<?php echo $WFR; ?>&DOC_ID=<?php echo $DOC_ID; ?>";
</script>