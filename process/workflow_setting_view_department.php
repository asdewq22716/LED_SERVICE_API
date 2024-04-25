<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$A_TYPE = $_GET["A_TYPE"];
$A_ID = $_GET["A_ID"];

	$sql_per_uc = db::query("SELECT count(ACCESS_ID) AS NUM_ROWS FROM USR_ACCESS WHERE USR_TYPE = 'U' AND ACCESS_TYPE = '".$A_TYPE."' AND ACCESS_REF_ID = '".$A_ID."'  ");
	$data_uc = db::fetch_array($sql_per_uc);
	
	 if($data_uc["NUM_ROWS"] > 0){
		$sql_per_u = db::query("SELECT * FROM USR_ACCESS WHERE USR_TYPE = 'U' AND ACCESS_TYPE = '".$A_TYPE."' AND ACCESS_REF_ID = '".$A_ID."'  ");
		while($F=db::fetch_array($sql_per_u)){ 
		
		$sql_u = db::query("SELECT USR_PREFIX,USR_FNAME,USR_LNAME FROM USR_MAIN WHERE USR_ID = '".$F["USR_REF_ID"]."' ");
			while($U=db::fetch_array($sql_u)){ 
			 echo "<label class=\"badge bg-success\"><i class=\"ion-person\"></i>".$U["USR_PREFIX"].$U["USR_FNAME"]." ".$U["USR_LNAME"]."</label> ";
			 }
		}
	}  
     
	$sql_per_dc = db::query("SELECT count(ACCESS_ID) AS NUM_ROWS FROM USR_ACCESS WHERE USR_TYPE = 'D' AND ACCESS_TYPE = '".$A_TYPE."' AND ACCESS_REF_ID = '".$A_ID."' ");
	$data_dc = db::fetch_array($sql_per_dc);
		 if($data_dc["NUM_ROWS"] > 0){
				$sql_per_d = db::query("SELECT * FROM USR_ACCESS WHERE USR_TYPE = 'D' AND ACCESS_TYPE = '".$A_TYPE."' AND ACCESS_REF_ID = '".$A_ID."' ");
			while($F=db::fetch_array($sql_per_d)){ 
			
			$sql_d = db::query("SELECT DEP_NAME FROM USR_DEPARTMENT WHERE DEP_ID = '".$F["USR_REF_ID"]."' ");
				while($D=db::fetch_array($sql_d)){ 
				echo "<label class=\"badge bg-primary\"><i class=\"ion-home\"></i>".$D["DEP_NAME"]."</label> ";
				}
			}
		}
	
	$sql_per_pc = db::query("SELECT count(ACCESS_ID) AS NUM_ROWS FROM USR_ACCESS WHERE USR_TYPE = 'P' AND ACCESS_TYPE = '".$A_TYPE."' AND ACCESS_REF_ID = '".$A_ID."' ");
	$data_pc = db::fetch_array($sql_per_pc);
		 if( $data_pc["NUM_ROWS"] > 0){
			$sql_per_d = db::query("SELECT * FROM USR_ACCESS WHERE USR_TYPE = 'P' AND ACCESS_TYPE = '".$A_TYPE."' AND ACCESS_REF_ID = '".$A_ID."' ");
			while($F=db::fetch_array($sql_per_d)){ 
			
				$sql_p = db::query("SELECT POS_NAME FROM USR_POSITION WHERE POS_ID = '".$F["USR_REF_ID"]."' ");
				while($P=db::fetch_array($sql_p)){ 
					echo "<label class=\"badge bg-warning\"><i class=\"ion-briefcase\"></i>".$P["POS_NAME"]."</label> ";
				}
			}
		}
		
		
	$sql_per_gc = db::query("SELECT count(ACCESS_ID) AS NUM_ROWS FROM USR_ACCESS WHERE USR_TYPE = 'G' AND ACCESS_TYPE = '".$A_TYPE."' AND ACCESS_REF_ID = '".$A_ID."' ");
	$data_gc = db::fetch_array($sql_per_gc);
		 if($data_gc["NUM_ROWS"] > 0){
			$sql_per_d = db::query("SELECT * FROM USR_ACCESS WHERE USR_TYPE = 'G' AND ACCESS_TYPE = '".$A_TYPE."' AND ACCESS_REF_ID = '".$A_ID."' ");
			while($F=db::fetch_array($sql_per_d)){ 
				$sql_g = db::query("SELECT * FROM USR_GROUP WHERE GROUP_ID = '".$F["USR_REF_ID"]."' ");
				while($G=db::fetch_array($sql_g)){ 
					echo "<label class=\"badge bg-danger\"><i class=\"ion-person-stalker\"></i>".$G["GROUP_NAME"]."</label> ";  
				}
			}
		} 

db::db_close();
?>
