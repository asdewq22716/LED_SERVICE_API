<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';
$offset = ($_POST['page']-1) * 20;
$sql = "SELECT ANC_WEBSITE_ID FROM M_ANC_WEBSITE WHERE 1=1 ORDER BY ANC_WEBSITE_ID DESC";
$query = db::query_limit($sql, $offset, '20');
$ANC_WEBSITE_ID = '';
while($res = db::fetch_array($query)){

	$ANC_WEBSITE_ID .= $res['ANC_WEBSITE_ID'].',';
	
}
$ANC_WEBSITE_ID = substr($ANC_WEBSITE_ID, 0, -1);

$sql = "UPDATE M_ANC_WEBSITE SET ANC_WEBSITE_STATUS  = 0 WHERE ANC_WEBSITE_ID IN (".$ANC_WEBSITE_ID.")";
$query = db::query($sql);

foreach($_POST['data'] as $val){
	
	$sql = "UPDATE M_ANC_WEBSITE SET ANC_WEBSITE_STATUS  = 1 WHERE ANC_WEBSITE_ID = '".$val."'";
	$query = db::query($sql);
}
echo "success";
exit;
?>
