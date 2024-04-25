<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);

include ('../include/include.php');

include('../include/paging.php');



if ($_SESSION["WF_USER_ID"] == "-1") {
	$sqlSelectUser = "select USR_ID from USR_MAIN where USR_OPTION9 = '" . $_GET["TO_PERSON_ID"] . "' ";
	$querySelectUser = db::query($sqlSelectUser);
	$dataSelectUser = db::fetch_array($querySelectUser);
	$_SESSION["WF_USER_ID"] = $dataSelectUser["USR_ID"];
}

/* if($_GET){
	foreach($_GET as $key => $param){
		$arrParam = @explode("&",url2param($key));
		if($arrParam){
			foreach($arrParam as $index => $var){
				$arrVar = explode("=",$var);
				${$arrVar[0]} = $arrVar[1];
			}	
		}
	}
} */

if ($_POST) {
	foreach ($_POST as $key => $value) {
		${$key} = $value;
	}
}

if ($_GET) {
	foreach ($_GET as $key => $value) {
		${$key} = $value;
	}
}


if ($HIDE_HEADER != "Y") {
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<?php include '../include/template_user.php'; ?>
	</head>

	<body id="bsf_body" class="horizontal-fixed fixed">
		<div class="wrapper">
			<!--<div class="loader-bg">
    <div class="loader-bar"> 
    </div>
</div>-->
			<!-- Navbar-->
		<?php if ($HIDE_HEADER != "P") {
			include '../include/header_user.php';
		}
	}
		?>