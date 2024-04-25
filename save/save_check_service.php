<?php
	$HIDE_HEADER = "Y";
	include '../include/comtop_user.php';

	//print_pre($_POST);
	$PRIVILEGE_GROUP_ID = $_POST['PRIVILEGE_GROUP_ID'];


	$del = implode (",",$_POST['chk_service']);

	/*$req = "delete FROM M_API_SPEC_REQUEST WHERE SERVICE_MANAGE_ID not in (".$del.") AND MAPPING_API_ID = '".$PRIVILEGE_GROUP_ID."'";
	$query = db::query($req);*/

	/*$res = "delete FROM M_API_SPEC_RESPONSE WHERE SERVICE_MANAGE_ID not in (".$del.") AND MAPPING_API_ID = '".$PRIVILEGE_GROUP_ID."'";
	$query = db::query($res);*/

	$req_cond['SERVICE_MANAGE_ID'] != $del;
	$req_cond['MAPPING_API_ID'] = $PRIVILEGE_GROUP_ID;
	
	$res_cond['SERVICE_MANAGE_ID'] != $del;
	$res_cond['MAPPING_API_ID'] = $PRIVILEGE_GROUP_ID;

	// db::db_delete("M_API_SPEC_REQUEST",$req_cond);
	// db::db_delete("M_API_SPEC_RESPONSE",$res_cond);

	// db::db_delete("SERVICE_MAPPING_GROUP",array('PRIVILEGE_GROUP_ID' => $PRIVILEGE_GROUP_ID)); ปิดไว้ก่อน
	//delete * FROM SERVICE_MAPPING_GROUP WHERE PRIVILEGE_GROUP_ID = '".$PRIVILEGE_GROUP_ID."'

	foreach($_POST['chk_service']as $key => $val){

			$field = array();
			$field['SERVICE_MANAGE_ID'] = $val;
			$field['PRIVILEGE_GROUP_ID'] = $PRIVILEGE_GROUP_ID;


			// db::db_insert('SERVICE_MAPPING_GROUP', $field, 'SERVICE_MANAGE_ID', 'SERVICE_MANAGE_ID'); ปิดไว้ก่อน
			//print_pre($field);
	}

	header('Location: ../form/mapping_api_form.php?W=59&PRIVILEGE_GROUP_ID='.$PRIVILEGE_GROUP_ID);
	exit;

?>
