<?php
//$pic_name = date("YmdHis").'_'.rand(0,999).".png";
$pic_name = $_POST["w"].".png";
file_put_contents('../doc_image/tmp_img_flowchart/'.$pic_name, base64_decode($_POST["img_content"]));
echo $pic_name;
?>