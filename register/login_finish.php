<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', '0');
include "../include/config.php";

$api_url = "https://notify-bot.line.me/oauth/token";
$set_header = "Content-Type: application/x-www-form-urlencoded";

$set_data = array();
$set_data['grant_type'] = "authorization_code";
$set_data['code'] = trim($_GET['code']);
$set_data['redirect_uri'] = LINE_REDIRECT_URI;
$set_data['client_id'] = LINE_CLIENT_ID;
$set_data['client_secret'] = LINE_CLIENT_SECRET;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$api_url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $set_header);
curl_setopt($ch, CURLOPT_POSTFIELDS, $set_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
$result = curl_exec($ch);
curl_close ($ch);

$line_result = json_decode($result, true);

if($line_result['status'] == "200")
{
	db::query("UPDATE USR_MAIN SET USR_LINE_API_KEY = '".$line_result['access_token']."' WHERE USR_ID = '".$_GET['state']."' AND USR_STATUS = 'Y' ");

	$url_success = "../register/?error=N";
}
else
{
	$url_success = "../register/?error=2";
}

?>
	<script type="text/javascript">
		window.location.href = "<?php echo $url_success; ?>";
	</script>
<?php

db::db_close();
?>