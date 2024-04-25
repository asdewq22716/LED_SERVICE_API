<?php
$HIDE_HEADER = "Y";
include '../include/comtop_public.php';
$W = conText($_GET['W']);
$WFS = conText($_GET['WFS']);
$WFR = conText($_GET['WFR']);
if($W != ""){ ?>
<div id="wf_hidden_content"></div>
<script type="text/javascript">
get_wfs_show('wf_hidden_content','wf_main.php','W=<?php echo $W; ?>&WFS=<?php echo $WFS; ?>&WFR=<?php echo $WFR; ?>&wfp=<?php echo conText($_GET['wfp']); ?>','GET');
</script>
<?php
}
include '../include/combottom_user.php'; ?>