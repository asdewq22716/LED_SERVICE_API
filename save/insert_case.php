<?php
include '../include/include.php';
$handle = fopen("../attach/CaseDetail.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {

		$sql =  str_replace("CASE_TYPE,","CASE_TYPE_CODE,",$line);
		$sql = str_replace(";","",$sql);
		// echo trim($sql);
		$query = db::query($sql);
    }
    fclose($handle);
} else {
    // error opening the file.
} 
?>