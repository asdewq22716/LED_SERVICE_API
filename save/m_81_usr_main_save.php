<?php
	$USR_PASSWORD = trim($_POST['USR_PASSWORD']);
	$USR_PASSWORD_CONFIRM = trim($_POST['USR_PASSWORD_CONFIRM']);
	
	
	if($USR_PASSWORD != "" and $USR_PASSWORD_CONFIRM != ""){
		
		$ENCODE_PASSWORD = hash('sha1', $USR_PASSWORD);
		db::db_update("USR_MAIN", array('USR_PASSWORD'=>$ENCODE_PASSWORD), array('USR_ID'=>$WF['USR_ID']));
	}

?>