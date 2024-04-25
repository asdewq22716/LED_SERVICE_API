<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';


		$PRIVILEGE_GROUP_ID = $_POST['PRIVILEGE_GROUP_ID'];
		$SERVICE_MANAGE_ID = $_POST['SERVICE_MANAGE_ID'];

		db::db_delete("M_API_SPEC_REQUEST",array('MAPPING_API_ID' => $PRIVILEGE_GROUP_ID,'SERVICE_MANAGE_ID'=> $SERVICE_MANAGE_ID));

	foreach($_POST['chk_request']as $key => $val){

		$sql = db::query("SELECT REQUEST_NAME,REQUEST_TYPE,REQUEST_DESC,SERVICE_MANAGE_ID FROM M_SERVICE_REQUEST WHERE REQUEST_ID ='".$val."'");
		$query = db::fetch_array($sql);

		$field = array();

			$field['REQUEST_ID'] = $val;
			$field['SERVICE_MANAGE_ID'] = $query['SERVICE_MANAGE_ID'];
			$field['MAPPING_API_ID'] = $PRIVILEGE_GROUP_ID;
			if(isset($_POST['SETTING_ID'])){
				$field['API_SETTING_ID'] = $_POST['SETTING_ID'];
			}

		//print_pre($field);
		// print_pre($W=58);

		db::db_insert('M_API_SPEC_REQUEST', $field, 'API_SPEC_REQUEST_ID', 'API_SPEC_REQUEST_ID');

		$a = db::query("SELECT * FROM SERVICE_MAPPING_GROUP WHERE PRIVILEGE_GROUP_ID = '".$PRIVILEGE_GROUP_ID."' AND SERVICE_MANAGE_ID = '".$query['SERVICE_MANAGE_ID']."'");
				$n = db::num_rows($a);
		if($n > 0){

			$cond = array();

			$cond['SERVICE_MANAGE_ID'] = $query['SERVICE_MANAGE_ID'];
			$cond['PRIVILEGE_GROUP_ID'] = $PRIVILEGE_GROUP_ID;

			$data['MAPPING_STATUS'] = 1; 

			db::db_update('SERVICE_MAPPING_GROUP', $data, $cond);

		} else {
		unset($field);
			$field['SERVICE_MANAGE_ID'] = $query['SERVICE_MANAGE_ID'];
			$field['PRIVILEGE_GROUP_ID'] = $PRIVILEGE_GROUP_ID;

			$field['MAPPING_STATUS'] = 1;
			db::db_insert('SERVICE_MAPPING_GROUP', $field );

		}
	}

//RESPONSE
	db::db_delete("M_API_SPEC_RESPONSE",array('MAPPING_API_ID' => $PRIVILEGE_GROUP_ID,'SERVICE_MANAGE_ID'=> $SERVICE_MANAGE_ID,'API_SETTING_ID'=> $_POST['SETTING_ID']));

	foreach($_POST['chk_response']as $key => $val){

		$sql = db::query("SELECT RESPONSE_NAME,RESPONSE_TYPE,RESPONSE_DESC,SERVICE_MANAGE_ID FROM M_SERVICE_RESPONSE WHERE RESPONSE_ID ='".$val."'");
		$query = db::fetch_array($sql);

		$field = array();

			$field['RESPONSE_ID'] = $val;
			$field['SERVICE_MANAGE_ID'] = $query['SERVICE_MANAGE_ID'];
			$field['MAPPING_API_ID'] = $PRIVILEGE_GROUP_ID;
			if(isset($_POST['SETTING_ID'])){
				$field['API_SETTING_ID'] = $_POST['SETTING_ID'];
			}

		//print_pre($field);

		db::db_insert('M_API_SPEC_RESPONSE', $field, 'API_SPEC_RESPONSE_ID', 'API_SPEC_RESPONSE_ID');

		$a = db::query("SELECT * FROM SERVICE_MAPPING_GROUP WHERE PRIVILEGE_GROUP_ID = '".$PRIVILEGE_GROUP_ID."' AND SERVICE_MANAGE_ID = '".$query['SERVICE_MANAGE_ID']."'");
				$n = db::num_rows($a);
		if($n > 0){

		$cond = array();


			$cond['SERVICE_MANAGE_ID'] = $query['SERVICE_MANAGE_ID'];
			$cond['PRIVILEGE_GROUP_ID'] = $PRIVILEGE_GROUP_ID;

			$data['MAPPING_STATUS'] = 1;

			db::db_update('SERVICE_MAPPING_GROUP', $data, $cond);

			} else {

			unset($field);
			$field['SERVICE_MANAGE_ID'] = $query['SERVICE_MANAGE_ID'];
			$field['PRIVILEGE_GROUP_ID'] = $PRIVILEGE_GROUP_ID;

			$field['MAPPING_STATUS'] = 1;
			db::db_insert('SERVICE_MAPPING_GROUP', $field );

		}
		}

		header('Location: ../form/api_manual_info.php?SERVICE_ID='.$SERVICE_MANAGE_ID.'&PRIVILEGE_GROUP_ID='.$PRIVILEGE_GROUP_ID);
	exit;
?>
