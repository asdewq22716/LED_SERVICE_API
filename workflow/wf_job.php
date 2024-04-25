<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
include "../include/config.php"; 
$W = conText($_GET['W']);
$WF_LINK = conText($_GET['WF_LINK']);
$num_rows = 0;
	
if($W != "" AND $WF_LINK != '')
{
		$sql = db::query("select WF_MAIN_ID,WF_TYPE,WF_MAIN_TYPE,WF_MAIN_SHORTNAME,WF_PERMISS_VIEW,WF_MAIN_SEARCH,WF_MAIN_SEARCH_SQL,WF_R_SQL from WF_MAIN where WF_MAIN_ID = '".$W."'");
		$rec_main = db::fetch_array($sql);
		$wf_table = $rec_main["WF_MAIN_SHORTNAME"];
		if($wf_table != "" AND $rec_main['WF_MAIN_TYPE'] == "W"){
		$cond = "";
		$permission_view = gen_permission($rec_main["WF_PERMISS_VIEW"],$rec_main["WF_MAIN_ID"],$rec_main["WF_TYPE"]);
			if($permission_view != ''){
				$cond .= " AND ( ".$permission_view." )";
			} 
		
		if($rec_main["WF_MAIN_SEARCH"] == '2' AND $rec_main["WF_MAIN_SEARCH_SQL"] != ''){
			$sql_form = wf_convert_var($rec_main["WF_MAIN_SEARCH_SQL"]).$cond;
			$sql_form = str_replace("#SEARCH#",'',$sql_form);
		}else{
			if($rec_main["WF_MAIN_SEARCH"] == '1' AND $rec_main["WF_R_SQL"] != ''){
				$cond .= " AND ".wf_convert_var($rec_main["WF_R_SQL"]);
			}
			$sql_form = "SELECT WFR_ID,WF_DET_NEXT FROM ".$wf_table." WHERE (WF_DET_NEXT IS NOT NULL OR WF_DET_NEXT != '')  AND WF_DET_NEXT > 0 ".$cond;
		}
		 
 
 
		$sql_wfr_form = db::query($sql_form);
		$w_access = check_permission("WFM",$W);
		while($F = db::fetch_array($sql_wfr_form)){ 
		$notcheck = "N";
		if(($w_access OR check_permission("DET",$F["WF_DET_NEXT"])) AND check_det_permission($W,$F["WF_DET_NEXT"],$F,'ACTION')){
				$num_rows++;  }
			
		}
	if($num_rows > 0){ echo "<a href=\"".$WF_LINK."\">".number_format($num_rows,0)."</a>"; }
		}
}
db::db_close();
?>