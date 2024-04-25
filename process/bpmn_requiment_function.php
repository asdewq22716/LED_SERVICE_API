<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$table = 'WF_BPMN_TOR';
$num_rows = conText($_POST['num_rows_tor']);
$BPMN_ID = conText($_POST['BPMN_ID']);
$back_page_old = conText($_POST['back_page_old']);

if($num_rows > 0){
	for($i=1; $i <= $num_rows; $i++){
		if($_POST["TOR_SELECT".$i] == 'Y'){
			if(conText($_POST["BPMN_TOR_ID".$i]) == ''){
				$a_data['TOR_ID'] = conText($_POST["TOR_ID".$i]);
				$a_data['BPMN_ID'] = $BPMN_ID;
				db::db_insert($table, $a_data, 'BPMN_TOR_ID');
				unset($a_data);
			}
		}else{
			if(conText($_POST["BPMN_TOR_ID".$i]) != ''){ //ไม่ได้เลือก แต่ record แล้ว
				$data_con["BPMN_TOR_ID"] = conText($_POST["BPMN_TOR_ID".$i]);
				db::db_delete($table, $data_con); 
				unset($data_con);
			}
		}
	}
}
$url_back = ($back_page_old == 'Y') ? "bpmn_requirment_form.php?BPMN_ID=".$BPMN_ID."" : "bpmn_list.php";
redirect($url_back);

db::db_close();
?>