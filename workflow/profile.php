<?php
include '../include/comtop_user.php'; 

$process = conText($_GET['process']);
$p_process = "แก้ไข";
$id = conText($_SESSION['WF_USER_ID']);

$sql = db::query("select * from USR_MAIN where USR_ID = '".$id."'");
$rec = db::fetch_array($sql);

/* echo "<br><br><br><br><pre>";
print_r($_SESSION);
echo "</pre>"; */

$p_name = "Profile";
$p_url = "profile";

function show_field($field_name){
	$sql_m = db::query("SELECT FIELD_LABEL,FIELD_REQUIRED,FIELD_STATUS,FIELD_EDIT FROM USR_SETTING WHERE FIELD_NAME='".$field_name."'");
	$data = db::fetch_array($sql_m);
	
	return $data;
}

include '../process/inc_profile.php';
include '../include/combottom_js.php';
include '../include/combottom_user.php'; 
if($process == 'success'){
	echo '<script>swal({
						  title: "บันทึกเรียบร้อยแล้ว", 
						  type: "success",
						  allowOutsideClick:true
						});</script>';
}

?>
