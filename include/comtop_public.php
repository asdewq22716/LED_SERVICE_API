<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
//echo $_REQUEST['wfp'];
if($_REQUEST['wfp'] == "" OR substr($_REQUEST['wfp'], 0, 1) != "W"){
	//exit;
}


include '../include/include.php';


if($_SESSION["WF_USER_ID"]=="-1"){
	$sqlSelectUser = "select USR_ID from USR_MAIN where USR_OPTION9 = '".$_GET["TO_PERSON_ID"]."' ";
	$querySelectUser = db::query($sqlSelectUser);
	$dataSelectUser = db::fetch_array($querySelectUser);
	$_SESSION["WF_USER_ID"] = $dataSelectUser["USR_ID"];
	
}

$W = wf_public();
if($HIDE_HEADER != "Y"){
 ?><!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../function/template_public.php'; ?>
</head>

<body id="bsf_body" class="horizontal-fixed fixed">
 <div class="wrapper">
  <!--<div class="loader-bg">
    <div class="loader-bar"> 
    </div>
</div>-->
<!-- Navbar-->
<?php if($HIDE_HEADER != "P"){ include '../function/header_public.php'; }
}	 
?>