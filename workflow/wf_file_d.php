<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
$HIDE_HEADER = "Y";
include '../include/comtop_user.php'; 
$W = conText($_POST['W']);
$process = conText($_POST['process']);
$f = conText($_POST['f']);
$wfr = conText($_POST['wfr']);
$table = "WF_FILE";

if($process == "d")
{
	$attach_folder = '../attach/w'.$W;
	$sql_attach = db::query("select FILE_ID,FILE_SAVE_NAME from WF_FILE where FILE_ID ='".$f."' AND WFR_ID='".$wfr."' AND WF_MAIN_ID = '".$W."' AND FILE_STATUS = 'Y' ");
		$rec_a = db::fetch_array($sql_attach);
		if($rec_a["FILE_ID"] != ""){
			if(!file_exists($attach_folder.'/'.$rec_a["FILE_SAVE_NAME"])){ unlink($attach_folder.'/'.$rec_a["FILE_SAVE_NAME"]); }
				$up_opt = array();
				$at_cond = array();
				$up_opt['FILE_STATUS'] = 'D';
				$up_opt['DEL_USR'] = $_SESSION['WF_USER_ID'];
				$up_opt['DEL_DATE'] = date2db(date("d/m/").(date("Y")+543));
				$up_opt['DEL_TIME'] = date("H:i:s");
				$at_cond["FILE_ID"] = $rec_a["FILE_ID"];
				db::db_update("WF_FILE", $up_opt, $at_cond);
				unset($up_opt);
				unset($at_cond);
		}
}

db::db_close();
?>