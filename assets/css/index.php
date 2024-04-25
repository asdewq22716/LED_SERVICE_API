<?php
header('Content-Type: text/css');
if($_GET["c"] !=''){
$color = str_replace('#','',$_GET["c"]);
$filename = "color/color-default.css";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
echo str_replace('1b8bf9',$color,$contents);
fclose($handle);
}
?>