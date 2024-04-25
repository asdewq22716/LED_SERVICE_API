<?php 

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
 
include 'include/comtop_user.php';
$sUser = $_POST['sUser'];
$sEmail = $_POST['sEmail'];
if($_POST['proc'] == 'chk_username'){
    
    $chk_user = "SELECT * FROM USER_API_SERVICE WHERE USR_USERNAME =  '".$sUser."' ";
    $qeury = db::query($chk_user);
    $result = db::fetch_array($qeury);
    $num = db::num_rows($query);

echo $num;
exit;
} 
if($_POST['proc'] == 'chk_Email'){
    
    $chk_user = "SELECT * FROM USER_API_SERVICE WHERE USR_EMAIL =  '".$sEmail."' ";
    $qeury = db::query($chk_user);
    $result = db::fetch_array($qeury);
    $num = db::num_rows($query);

echo $num;
exit;
}





    
?>
