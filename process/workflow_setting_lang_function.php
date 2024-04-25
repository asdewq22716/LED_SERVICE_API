<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$process = conText($_POST['process']);

$W = conText($_POST['W']); 
$all_i = conText($_POST['all_i']); 
$url_back = "workflow_setting_lang.php?W=".$W;

if($process == "save_lang"){
		$lang_arr = array();
		$sql_lang = db::query("select * from WF_LANGUAGE ORDER BY LANG_ORDER ASC");
		$lg = 0;
		while($L=db::fetch_array($sql_lang)){ 
		$lang_arr[$lg] = $L['LANG_ID'];
		$lg++;
		}
	for($i=0;$i<$all_i;$i++){
		$WF_CODE = conText($_POST['wfcode_'.$i]);
		$WF_REF = conText($_POST['wfref_'.$i]);	
		db::db_delete("WF_LANG_CONFIG", array('CONF_CODE' => $WF_CODE,'CONF_REF' => $WF_REF));
		foreach($lang_arr as $key=>$val){ //$_POST['wflang_'.$i.'_'.$key]
			$WF_VAL = substr(json_encode($_POST['wflang_'.$i.'_'.$key]), 1, -1);
			$a_data = array();
			$a_data['CONF_CODE'] = $WF_CODE;
			$a_data['CONF_REF'] = $WF_REF;
			$a_data['CONF_LANG'] = $val;
			$a_data['CONF_VALUE'] = $WF_VAL; 
			db::db_insert("WF_LANG_CONFIG", $a_data, "CONF_ID");
			unset($a_data);
		}
	}
}
 

if($process != "DEL"){
redirect($url_back);
}
?>