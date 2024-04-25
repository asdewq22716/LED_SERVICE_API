<?php
function check_function($functionName) {
    $reflection = new ReflectionFunction($functionName);
    $filename = $reflection->getFileName();
    return $filename;
  }
echo check_function('nl2br');
echo nl2br(file_get_contents($_GET["sevice_file"]));
?>