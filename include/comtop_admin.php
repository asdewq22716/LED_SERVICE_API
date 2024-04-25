<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);

if($_SESSION["WF_USER_ID"] == "" OR $_SESSION["WF_ADMIN"] != "Y"){
	?>
<script type="text/javascript">
	self.location.href='login.php';
</script>
<?php	
exit;
	}
include '../include/config.php';
if($HIDE_HEADER != "Y"){
 ?><!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../include/template_head.php'; ?>

</head>

<body class="horizontal-fixed fixed">
 <div class="wrapper">
  <!--<div class="loader-bg">
    <div class="loader-bar"> 
    </div>
</div>-->
<!-- Navbar-->
     <?php include '../include/header.php'; 
}	 
	 ?>