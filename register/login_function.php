<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', '0');
include "../include/config.php";

$USER_NAME = conText($_POST['LN_USER_NAME']);
$PASSWORD = conText($_POST['LN_USER_PASSWORD']);
//$LINE_ID = conText($_POST['LINE_ID']);
$PASSWORD = hash('sha1',$PASSWORD);

$sql_usr = db::query("SELECT USR_ID FROM USR_MAIN WHERE USR_USERNAME = '".$USER_NAME."' AND USR_PASSWORD = '".$PASSWORD."' AND USR_STATUS = 'Y' ");
$G = db::fetch_array($sql_usr);

if($G["USR_ID"] != ''){

	$line_url = "https://notify-bot.line.me/oauth/authorize?response_type=code&scope=notify&state=".$G["USR_ID"]."&client_id=".LINE_CLIENT_ID."&redirect_uri=".LINE_REDIRECT_URI."";

	?>
	<script type="text/javascript">
	window.location.href="<?php echo $line_url; ?>";
	</script>
<?php
}else{?>
	<script type="text/javascript">
	window.location.href="../register/?error=1";
	</script>
<?php
}
db::db_close();
?>