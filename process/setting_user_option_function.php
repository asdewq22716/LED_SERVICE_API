<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$table = "USR_SETTING";
$pk_name = "FIELD_ID";
$num_rows = conText($_POST['num_rows']);

for($i = 1;$i < $num_rows;$i++)
{
	$MASTER_ID = conText($_POST['MASTER_ID'.$i]);
	$OPTION_RELATION = conText($_POST['OPTION_RELATION'.$i]);
	$OPTION_TEXT = conText($_POST['FIELD_LABEL'.$i]);
	$OPTION_USE = conText($_POST["OPTION_USE".$i]);
	$OPTION_ID = conText($_POST["OPTION_ID".$i]);
	$FIELD_LIST_SHOW = conText($_POST["FIELD_LIST_SHOW".$i]);
	$FIELD_EDIT = conText($_POST["FIELD_EDIT".$i]);
	$FIELD_TEXT = conText($_POST["FIELD_TEXT".$i]);
	$FIELD_REQUIRED = conText($_POST["FIELD_REQUIRED".$i]);
	$FIELD_STATEMENT = conText($_POST["FIELD_STATEMENT".$i]);
	$FIELD_SEARCH = conText($_POST["FIELD_SEARCH".$i]);
		//if($OPTION_USE == 'Y'){
			if($OPTION_ID != "")
			{
								
				$a_data['WF_MAIN_ID'] = $MASTER_ID;
				$a_data['FIELD_LABEL'] = $OPTION_TEXT;
				$a_data['FIELD_RELETION'] = $OPTION_RELATION;
				$a_data['FIELD_LIST_SHOW'] = $FIELD_LIST_SHOW;
				$a_data['FIELD_EDIT'] = $FIELD_EDIT;
				$a_data['FIELD_TEXT'] = $FIELD_TEXT;
				$a_data['FIELD_STATUS'] = $OPTION_USE;
				$a_data['FIELD_REQUIRED'] = $FIELD_REQUIRED;
				$a_data['FIELD_STATEMENT'] = $FIELD_STATEMENT;
				$a_data['FIELD_SEARCH'] = $FIELD_SEARCH;

				$a_cond[$pk_name] = $OPTION_ID;
				db::db_update($table, $a_data, $a_cond);
				unset($a_data);
				unset($a_cond);

			}else{
				$a_data['WF_MAIN_ID'] = $MASTER_ID;
				$a_data['FIELD_LABEL'] = $OPTION_TEXT;
				$a_data['FIELD_RELETION'] = $OPTION_RELATION;
				$a_data['FIELD_LIST_SHOW'] = $FIELD_LIST_SHOW;
				$a_data['FIELD_EDIT'] = $FIELD_EDIT;
				$a_data['FIELD_TEXT'] = $FIELD_TEXT;
				$a_data['FIELD_STATUS'] = $OPTION_USE;
				$a_data['FIELD_REQUIRED'] = $FIELD_REQUIRED;
				$a_data['FIELD_STATEMENT'] = $FIELD_STATEMENT;
				$a_data['FIELD_SEARCH'] = $FIELD_SEARCH;
				
				db::db_insert($table, $a_data, $pk_name);
				unset($a_data);
			
			
			}
		/*}
		else
		{
			
			if($OPTION_ID !=""){
				$a_cond[$pk_name] = $_POST["OPTION_ID".$i];
				db::db_delete($table, $a_cond);
				unset($a_cond);
			}
			
		}*/
}
?>
<script type="text/javascript">
	window.location.href = 'setting_user_option.php';
</script>

<?php
db::db_close();
?>