<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';
$W = conText($_GET['W']);
$WFS = conText($_GET['WFS']);
$WFR = conText($_GET['WFR']);
if($W != ""){
$sql_wfs = db::query("select WFS_OPTION_SELECT_DATA from WF_STEP_FORM where WFS_ID = '".$WFS."'");
$BSF_DET = db::fetch_array($sql_wfs);
if($BSF_DET['WFS_OPTION_SELECT_DATA'] == "S_D"){
	$link = "wf_dep.php";
}else{
	$link = "wf_main.php";
}
?>
<div id="wf_hidden_content"></div>
<script type="text/javascript">
get_wfs_show('wf_hidden_content','../workflow/<?php echo $link; ?>','W=<?php echo $W; ?>&WFS=<?php echo $WFS; ?>&WFR=<?php echo $WFR; ?>','GET');
</script>
<?php
}
include '../include/combottom_user.php'; ?>