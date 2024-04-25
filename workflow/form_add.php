<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';
$W = conText($_GET['W']);
$WFS = conText($_GET['WFS']);
$WFD = conText($_GET['WFD']);
$WFR = conText($_GET['WFR']);
$ROUND = conText($_GET['ROUND']);
$F_TEMP_ID = conText($_GET['F_TEMP_ID']);
if($WFR==""){
	$WFR = '0';
}
$WF_SEARCH = conText($_GET['WF_SEARCH']);

if($W != ""){ 
	if($ROUND > 0){
		for($i=0;$i<$ROUND;$i++){
		bsf_load_form($W,$WFS,$WFR,$F_TEMP_ID,$WFD,'ADD');	
		}
	}else{
	bsf_load_form($W,$WFS,$WFR,$F_TEMP_ID,$WFD,'ADD');
	}
}
if(!(strpos($_SERVER["HTTP_REFERER"], 'export_flow_image.php') !== false OR strpos($_SERVER["HTTP_REFERER"], 'workflow_step_preview.php') !== false)){
include '../include/combottom_js_user.php';

$sql_java = db::query("SELECT WFS_INPUT_EVENT,WFS_JAVASCRIPT_EVENT FROM WF_STEP_FORM where WFS_ID = '".$WFS."' ");
$WS = db::fetch_array($sql_java);
if($WS['WFS_INPUT_EVENT'] == "change"){
?>
<script>
<?php echo htmlspecialchars_decode($WS['WFS_JAVASCRIPT_EVENT'], ENT_QUOTES);; ?>
</script>
<?php
}
}
db::db_close() ?>