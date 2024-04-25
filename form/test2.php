<?php

$url = 'https://trackimage.thailandpost.co.th/f/signature/QDgyMTk2YjVzMGx1VDMz/QGI1c1JJMGx1VDMx/QGI1czBsVEh1VDM0/QGI1czBsdTEzMjRUMzI=';
 

$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$genName = '';

for ($i = 0;$i < 10;$i++)
{
    $genName .= $characters[rand(0, $charactersLength - 1) ];
}

$target_dir = '../attach/w3/';
$file_save_name = "f" . date("YmdHis") . "_" . $genName . ".png";
$target_file = $target_dir . $file_save_name;

file_put_contents( $target_file,file_get_contents($url)); 
?>