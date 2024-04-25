<?php
error_reporting(E_ALL & ~E_NOTICE);
function conText($text, $format = "")
{
	$outText = stripslashes(htmlspecialchars(trim($text), ENT_QUOTES));

	if($format == "number")
	{
		$outText = str_replace(',', '', $outText);
	}
	elseif($format == "date")
	{
		$outText = date2db($outText);
	}

	return $outText;
}
$q = conText($_GET["q"]);
if($q==""){
?>
<script type="text/javascript">
window.location.href="index/";
</script>
<?php }else{
?>
<script type="text/javascript">
window.location.href="index/?BSL=<?php echo $q; ?>";
</script>
<?php
}
 
?>