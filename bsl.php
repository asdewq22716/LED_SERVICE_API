<?php
error_reporting(E_ALL & ~E_NOTICE);
if($_GET["u"]!=""){
	function wf_decode($string) {
		$key = sha1("BSL");
		$strLen = strlen($string);
		$keyLen = strlen($key);
		for ($i = 0; $i < $strLen; $i+=2) {
			$ordStr = hexdec(base_convert(strrev(substr($string,$i,2)),36,16));
			if ($j == $keyLen) { $j = 0; }
			$ordKey = ord(substr($key,$j,1));
			$j++;
			$hash .= chr($ordStr - $ordKey);
		}
		if (is_numeric($hash)) {
			return $hash;
		} else {
			return '';
		}
	}
	$wf_url = wf_decode($_GET["u"])."?q=".$_GET["q"];
?>
<!DOCTYPE html>
<html lang="th">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ยินดีต้อนรับสู่ระบบ BizSmartFlow</title>
</head>
<body>
	<img src="img/logo bizsmartflow.png" alt="ยินดีต้อนรับสู่ระบบ BizSmartFlow" />
                <h1>ยินดีต้อนรับสู่ระบบ BizSmartFlow</h1>
</body>
<script type="text/javascript">
//	window.location.href="<?php echo $wf_url; ?>";
</script>
<?php
}
?>