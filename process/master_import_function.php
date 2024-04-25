<?php
set_time_limit(0);
ini_set('memory_limit', '1024M');
ini_set('display_errors', '0');
$HIDE_HEADER = "Y";
$WF_TYPE = 'M';
include '../include/comtop_admin.php';

$table = 'WF_MAIN';
$pk_name = 'WF_MAIN_ID';
$url_back = "master.php";
$filename = $_POST["filename"]; 

$process = conText($_REQUEST['process']);

$WF_FIELD_PK = conText(strtoupper($_POST['WFS_FIELD_NAME1']));
$WF_GROUP_ID = conText($_POST['WF_GROUP_ID']);

$WF_MAIN_ORDER = db::get_max("WF_MAIN", "WF_MAIN_ORDER",array('WF_GROUP_ID'=>$WF_GROUP_ID)) + 1;
$WF_MAIN_NAME = conText($_POST['WF_MAIN_NAME']);
$WF_MAIN_SHORTNAME = conText($_POST['WF_MAIN_SHORTNAME']);
$WF_MAIN_SHORTNAME = strtoupper('M_'.$WF_MAIN_SHORTNAME);

if($process == 'ADD'){
	if($filename != ""){ 
		
		//Insert WF_MAIN
		$a_data['WF_TYPE'] = $WF_TYPE;
		$a_data['WF_FIELD_PK'] = $WF_FIELD_PK;
		$a_data['WF_GROUP_ID'] = $WF_GROUP_ID;
		$a_data['WF_MAIN_ORDER'] = $WF_MAIN_ORDER;
		$a_data['WF_MAIN_NAME'] = $WF_MAIN_NAME;
		$a_data['WF_MAIN_TYPE'] = 'W';
		$a_data['WF_MAIN_SHORTNAME'] = $WF_MAIN_SHORTNAME;

		$W = db::db_insert($table, $a_data, $pk_name, $pk_name);
		
		$a_data_h['WIH_DATE'] = date2db(date('d/m/').(date('Y')+543));
		$a_data_h['WF_MAIN_ID'] = $W;
		$a_data_h['WIH_FILE_NAME'] = $filename;
		$a_data_h['USR_ID'] = $_SESSION["WF_USER_ID"];
		$a_data_h['USR_NAME'] = $_SESSION["WF_USER_NAME"];
		$a_data_h['WIH_TIME'] = date('H:i:s');

		$history = db::db_insert('WF_IMPORT_HISTORY', $a_data_h, 'WIH_ID');

		if($WF_TYPE == "M"){
			if(db::$_dbType == "MSSQL")
			{
				$data_type = "int";
				$data_length = "";
			}
			elseif(db::$_dbType == "MYSQL")
			{
				$data_type = "int";
				$data_length = "10";
			}
			elseif(db::$_dbType == "ORACLE")
			{
				$data_type = "NUMBER";
				$data_length = "20";
			}

			
		}
		//End Insert WF_MAIN



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
			
				$a_data = array();
				
				$WFS_NAME = conText($_POST['WFS_NAME'.$i]);
				$WFS_FIELD_NAME = conText(strtoupper($_POST['WFS_FIELD_NAME'.$i]));
				$array_field[$i] = $WFS_FIELD_NAME;
				$WFS_FIELD_TYPE = conText($_POST['WFS_FIELD_TYPE'.$i]);
				$WFS_FIELD_LENGTH = conText($_POST['WFS_FIELD_LENGTH'.$i]);
				if($i == 1){
					create_table($WF_MAIN_SHORTNAME, $WFS_FIELD_NAME, $data_type, $data_length);
					
				}else{
					$a_data['WF_MAIN_ID'] = $W;
					$a_data['WF_TYPE'] = $WF_TYPE;
					$a_data['WFD_ID'] = 0;
					$a_data['FORM_MAIN_ID'] = '1';
					$a_data['WFS_ORDER'] = $i;
					$a_data['WFS_OFFSET'] = "0";
					$a_data['WFS_NAME'] = $WFS_NAME;
					//$a_data['WFS_COMMENT'] = $WFS_NAME;
					$a_data['WFS_FIELD_NAME'] = $WFS_FIELD_NAME;
					$a_data['WFS_FIELD_TYPE'] = $WFS_FIELD_TYPE;
					$a_data['WFS_FIELD_LENGTH'] = $WFS_FIELD_LENGTH;
					$a_data['WFS_COLUMN_TYPE'] = '2';
					$a_data['WFS_COLUMN_LEFT'] = '2';
					$a_data['WFS_COLUMN_RIGHT'] = '8';
					$a_data['WFS_COLUMN_LEFT_ALIGN'] = 'R';
					$a_data['WFS_COLUMN_RIGHT_ALIGN'] = 'L';
					$a_data['FIELD_G_ID'] = '0';
					
					$WFS_ID = db::db_insert('WF_STEP_FORM', $a_data, 'WFS_ID');
					add_field($WF_MAIN_SHORTNAME, $WFS_FIELD_NAME, $WFS_FIELD_TYPE, $WFS_FIELD_LENGTH, $WFS_NAME);
					unset($a_data);
				}

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
			$id = db::db_insert($WF_MAIN_SHORTNAME, $a_data, $WF_FIELD_PK);
			unset($a_data);

			$a_data_d['WIH_ID'] = $history;
			$a_data_d['REF_ID'] = $id;
			$W = db::db_insert('WF_IMPORT_DATA', $a_data_d, 'WIMD_ID');
			
		}
	}  
}elseif($process == 'delete'){

	$W = conText($_GET['w']);
	$WIH_ID = conText($_GET['h']);
	$sql_main = db::query("SELECT WF_MAIN_SHORTNAME,WF_FIELD_PK FROM WF_MAIN WHERE WF_MAIN_ID='".$W."'");
	
	$rec_main = db::fetch_array($sql_main);
	$sql_his = db::query("SELECT REF_ID FROM WF_IMPORT_DATA WHERE WIH_ID='".$WIH_ID."'");
	while($rec_his = db::fetch_array($sql_his)){
		
		$c_cond[$rec_main["WF_FIELD_PK"]] = $rec_his['REF_ID'];
		db::db_delete($rec_main["WF_MAIN_SHORTNAME"], $c_cond);
		unset($c_cond);
	}
	
	$c_cond_hd["WIH_ID"] = $WIH_ID;
	db::db_delete('WF_IMPORT_DATA', $c_cond_hd);
	unset($c_cond_hd);
	
	$c_cond_h["WIH_ID"] = $WIH_ID;
	db::db_delete('WF_IMPORT_HISTORY', $c_cond_h);
	unset($c_cond_h);
	echo 'Y';
}
db::db_close();
if($process != 'delete'){
	redirect($url_back);
}
?>