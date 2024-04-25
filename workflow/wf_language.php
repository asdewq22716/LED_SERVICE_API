<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';
$LANG = conText($_GET['LANG']); 
$_SESSION['WF_LANGUAGE'] = $LANG;
?>
<script type="text/javascript">
window.location.href="<?php echo $_SERVER['HTTP_REFERER']; ?>";
</script>
<?php
include '../include/combottom_user.php'; ?>