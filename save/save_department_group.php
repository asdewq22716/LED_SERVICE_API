<?php

db::db_delete("FRM_DEPARTMENT_GROUP",array("DEPARTMENT_ID"=>$WFR));

if(count($_POST["FID_1487"])>0){
	foreach($_POST["FID_1487"] as $key => $val){
		unset($fields);
			$fields["WF_MAIN_ID"] 		=  56;
			$fields["WFD_ID"] 			=  0;
			$fields["WFR_ID"] 			=  $_POST["PRIVILEGE_GROUP_ID_".$val];
			$fields["WFS_ID"] 			=  624;
			$fields["F_TEMP_ID"] 		=  $_POST["PRIVILEGE_GROUP_ID_".$val];
			$fields["DEPARTMENT_ID"] 	=  $WFR;
		db::db_insert("FRM_DEPARTMENT_GROUP",$fields,'F_ID');	
	}	
}
?>