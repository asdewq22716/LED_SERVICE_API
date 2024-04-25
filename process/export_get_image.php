<?php
if(!file_exists('../interface')){ mkdir('../interface',0777); }
$W = $_POST['W'];
$WFD = $_POST['WFD'];
$data_image = str_replace(' ','+',$_POST['data_image']);
$pic_name = $W.'_'.$WFD.'.png';

file_put_contents('../interface/'.$pic_name, base64_decode($data_image));
echo 'Y';

?>