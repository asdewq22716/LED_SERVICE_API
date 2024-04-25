<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$coding = wf_decode(wf_decode(conText($_POST["pcode"])));
$filename = $coding;
$somecontent = $_POST["php_code"];

// Let's make sure the file exists and is writable first.
if (is_writable($filename)) {

    // In our example we're opening $filename in append mode.
    // The file pointer is at the bottom of the file hence
    // that's where $somecontent will go when we fwrite() it.
    if (!$handle = fopen($filename, 'w')) {
         echo "Cannot open file ($filename)";
         exit;
    }

    // Write $somecontent to our opened file.
    if (fwrite($handle, $somecontent) === FALSE) {
        echo "Cannot write to file ($filename)";
        exit;
    }
	echo "Y";
    fclose($handle);
}
db::db_close();
?>