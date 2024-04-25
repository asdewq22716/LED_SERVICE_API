<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$table = "WF_CONFIG";
$pk_name = "CONFIG_ID";

$i=1;

db::query("DELETE FROM ".$table);
foreach($conf_code as $_key => $_val)
{
	if(array_key_exists($_val, $conf_data_type))
	{
		$config_type = $conf_data_type[$_val];
	}
	else
	{
		$config_type = "1";
	}
	$c_data = array();
	$c_data['CONFIG_NAME'] = $_val;
	$c_data['CONFIG_VALUE'] = conText($_POST[$_val]);
	$c_data['CONFIG_ID'] = $i;
	$c_data['CONFIG_LABEL'] = $conf_title[$_key];
	$c_data['CONFIG_TYPE'] = $config_type;
	$c_data['CONFIG_OPTION'] = "";

	db::db_insert($table, $c_data, $pk_name);
	unset($c_data);
	$i++;
}

?>
<script type="text/javascript">
	window.location.href = 'system_setting.php';
</script>

<?php
db::db_close();
?>