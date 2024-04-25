<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$process = conText($_REQUEST['process']);
$table = "DOC_MAIN";
$pk_name = "DOC_ID";

$W =  conText($_POST["W"]);
$WFD =  conText($_POST["WFD"]);
$TOTAL_ROWS = conText($_POST["total_row"]);




if($TOTAL_ROWS > 0){
	for($i=0;$i<$TOTAL_ROWS;$i++){
	
		$DOC_STATUS = conText($_POST["DOC_STATUS".$i]);
		$DOC_SORT = conText($_POST["DOC_SORT".$i]);
		$DOC_ID = conText($_POST["DOC_ID".$i]);
	
		$a_data['DOC_STATUS'] = $DOC_STATUS;
		$a_data['DOC_SORT'] = $DOC_SORT;
		$a_cond[$pk_name] = $DOC_ID;
		
		db::db_update($table, $a_data, $a_cond);
		unset($a_data);
		unset($a_cond);
		
	}
}
db::db_close();
?>