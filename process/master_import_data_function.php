<?php
set_time_limit(0);
ini_set('memory_limit', '1024M');
ini_set('display_errors', '0');
$HIDE_HEADER = "Y";
$WF_TYPE = 'M';
include '../include/comtop_admin.php';

$W = conText($_POST['W']);
$filename = conText($_POST["filename"]); 
if($W != ''){
	$sql_data = db::query("SELECT WF_MAIN_SHORTNAME,WF_FIELD_PK FROM WF_MAIN WHERE WF_MAIN_ID = '".$W."' ");
	$rec_main =db::fetch_array($sql_data);
}
$table = $rec_main["WF_MAIN_SHORTNAME"];
$pk_name = $rec_main["WF_FIELD_PK"];
$url_back = "master_main.php?W=".$W;

if($filename != ""){ 

	/** PHPExcel */
	require_once '../Classes/PHPExcel.php';

	/** PHPExcel_IOFactory - Reader */
	include '../Classes/PHPExcel/IOFactory.php';

	$strPath = realpath(basename(getenv($_SERVER["SCRIPT_NAME"])));
	$inputFileName = "../import/".$filename;

	$inputFileType = PHPExcel_IOFactory::identify($inputFileName);  
	$objReader = PHPExcel_IOFactory::createReader($inputFileType);  
	$objReader->setReadDataOnly(true);
	$objPHPExcel = $objReader->load($inputFileName); 

	$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
	$highestRow = $objWorksheet->getHighestRow();
	$highestColumn = $objWorksheet->getHighestColumn();
	$row = 1;
	$dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);

	$i=1;
	$array_field = array();
	
	foreach($dataRow[$row] as &$value){ 
	
			$arr_field = array();
			$WFS_FIELD_NAME = conText(strtoupper($_POST['WFS_FIELD_NAME'.$i]));
			$array_field[$i] = $WFS_FIELD_NAME;
			$i++; 
	} 

	for($row=2;$row<=$highestRow;$row++){
		$dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
		$i=1;
		$a_data = array();
		foreach($dataRow[$row] as &$value){ 
			
			$a_data[$array_field[$i]] = conText($value);	
		$i++; 
		}
		db::db_insert($table, $a_data, $pk_name);
		unset($a_data);
	}
}  
db::db_close();
redirect($url_back);
?>