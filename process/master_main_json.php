<?php
header('Content-Type: application/json');
$HIDE_HEADER = "Y";
$WF_TYPE = 'M';
include '../include/comtop_admin.php';
foreach($_GET as $key => $val){
	$$key = conText($val);
}
$W = conText($_GET['W']);
if($W != ""){
$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec_main = db::fetch_array($sql);
$wf_table = $rec_main["WF_MAIN_SHORTNAME"];


	$tb_head = array();
	$tb_data = array();
	$column_n = 0;
	if($rec_main["WF_EXCEL_FIELD"] == ""){
	$sql_step_f = db::query("SELECT * FROM WF_STEP_FORM WHERE WF_MAIN_ID='".$W."' AND WF_TYPE = '".$rec_main["WF_TYPE"]."' AND FORM_MAIN_ID != '16'  AND FORM_MAIN_ID != '10' AND (WFS_NAME != '' OR WFS_NAME IS NOT NULL) ORDER BY WFS_ORDER,WFS_OFFSET");
	}else{
 
	$sql_step_f = db::query("SELECT * FROM WF_STEP_FORM WHERE WF_MAIN_ID='".$W."' AND WF_TYPE = '".$rec_main["WF_TYPE"]."' AND FORM_MAIN_ID != '16'  AND FORM_MAIN_ID != '10' AND WFS_FIELD_NAME IN ('".str_replace(",","','",$rec_main["WF_EXCEL_FIELD"])."') ORDER BY WFS_ORDER,WFS_OFFSET"); 
	
	}
	while($rec_sf = db::fetch_array($sql_step_f)){
		$tb_head[$column_n] = $rec_sf["WFS_FIELD_NAME"];
		$tb_data[$column_n] = '##'.$rec_sf["WFS_FIELD_NAME"].'!!';
		$column_n++;
	}

					if($wf_order == ''){
						if($rec_main["WF_MAIN_DEFAULT_ORDER"] != ""){
							$wf_order = $rec_main["WF_MAIN_DEFAULT_ORDER"];
						}else{
							$wf_order = $rec_main["WF_FIELD_PK"];
							$wf_order_type = "ASC"; 
						}
					}
					
					$wfr_order = "  ORDER BY ".$wf_order." ".$wf_order_type;
					
					if($rec_main["WF_MAIN_SEARCH"] == '2' AND $rec_main["WF_MAIN_SEARCH_SQL"] != ''){
						$sql_s = wf_convert_var($rec_main["WF_MAIN_SEARCH_SQL"]);
						
					}else{
						if($rec_main["WF_MAIN_SEARCH"] == '1' AND $rec_main["WF_R_SQL"] != ''){
							$cond = " AND ".wf_convert_var($rec_main["WF_R_SQL"]);
						}else{
							$cond = "";
						}
						$sql_s = "select * from ".$wf_table." where 1=1 ".$cond;
					}
					
					$sql_workflow = $sql_s."".$wfr_order;

					$query_workflow = db::query($sql_workflow);

							$i=0;
							$arr = array();	
							while($R=db::fetch_array($query_workflow)){
							$arr[$i]["WFR"] = $R[$rec_main["WF_FIELD_PK"]]; 
									for($c=0;$c<$column_n;$c++){
									$arr[$i][$tb_head[$c]] =  bsf_show_field($W,$R,$tb_data[$c],'M');
									}
							$i++;
							}
		$array_a['data'] = $arr;
		echo json_encode($array_a);
}
include '../include/combottom_admin.php'; ?>