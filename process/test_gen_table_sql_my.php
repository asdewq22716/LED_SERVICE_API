<?php
include("../include/comtop_admin.php");
$db_name = "doa_sprayer"; 
echo "<br><br><br><hr>";
$sql_all_table = db::query("SELECT *
								FROM user_tables
								WHERE TABLE_NAME LIKE 'DOC_%' OR TABLE_NAME LIKE 'FORM_%' OR TABLE_NAME LIKE 'G_%'
								OR TABLE_NAME LIKE 'MASTER_%' OR TABLE_NAME LIKE 'USR_%' OR TABLE_NAME LIKE 'IFTTT_%' 
								OR TABLE_NAME IN ('POSITION', 'PERMISSION_INSTEAD', 'REPORT_GROUP')
								OR (TABLE_NAME LIKE 'WF_%' AND TABLE_NAME NOT LIKE 'WFR_%') OR TABLE_NAME = 'LOG_DETAIL'
								ORDER BY TABLE_NAME ASC");
								
/*$sql_all_table = db::query("SELECT *
								FROM user_tables
								WHERE TABLE_NAME = 'USR_MAIN'");	
$sql_all_table = db::query("SELECT *
								FROM user_tables
								WHERE 1=1 AND TABLE_NAME='WF_CONFIG' ORDER BY TABLE_NAME ASC");*/								
while($rec_all_table = db::fetch_array($sql_all_table))
{
	$field = array();
	$table_name = $rec_all_table['TABLE_NAME'];
	$sql_field = db::query("SELECT COLUMN_NAME, DATA_TYPE, DATA_LENGTH FROM all_tab_cols 
								WHERE table_name = '".$table_name."' AND OWNER = 'WORKFLOW_MASTER4' AND COLUMN_NAME not like 'SYS_STS%' 
								ORDER BY SEGMENT_COLUMN_ID");
	$i=0;
	$field_array = array();
	if($table_name != 'WF_CONFIG'){
		
		while($rec_field = db::fetch_array($sql_field))
		{

			if($rec_field['DATA_TYPE'] == "VARCHAR2")
			{
				if($rec_field['DATA_LENGTH'] <= 255)
				{
					$data_type = "varchar";
					$data_length = "(".$rec_field['DATA_LENGTH'].") CHARACTER SET utf8 COLLATE utf8_general_ci";
				}else{
					$data_type = "TEXT";
					//$data_length = " CHARACTER SET utf8 COLLATE utf8_general_ci";
					$data_length = "";
				}
			} 
			elseif($rec_field['DATA_TYPE'] == "NUMBER")
			{
				$data_type = "int";
				$data_length = "";
			}
			elseif($rec_field['DATA_TYPE'] == "CHAR")
			{
				$data_type = "varchar";
				$data_length = "(".$rec_field['DATA_LENGTH'].") CHARACTER SET utf8 COLLATE utf8_general_ci";
			}
			else
			{
				$data_type = strtolower($rec_field['DATA_TYPE']);
				$data_length = "";
			}

			$field[$i]['name'] = $rec_field['COLUMN_NAME'];
			$field[$i]['data_type'] = $data_type;
			$field[$i]['data_length'] = $data_length;

			array_push($field_array, $rec_field['COLUMN_NAME']);

			$i++;
		}
		echo $table_name."<br>";
		$field_name = $field[0]['name'];

		$create_field = "";
		foreach($field as $_key => $_val)
		{
			if($_key == 0) continue;
			$create_field .= ", ".$_val['name']." ".$_val['data_type'].$_val['data_length']."";
		}

		$sql_create = "CREATE TABLE ".$db_name.".".$table_name."( ".$field_name." ".$field[0]['data_type']." ".$field[0]['data_length']." NOT NULL ".$create_field." , PRIMARY KEY (".$field_name.") );";
	
	}else{
		$sql_create = "CREATE TABLE ".$db_name.".WF_CONFIG( CONFIG_ID int NOT NULL , CONFIG_VALUE TEXT, CONFIG_NAME TEXT, CONFIG_LABEL TEXT, CONFIG_TYPE TEXT, CONFIG_OPTION TEXT , PRIMARY KEY (CONFIG_ID) );";
	}
	
	echo $sql_create;
	echo "<hr>";

	$file_name = "create_table_for_mysql.txt";
	$content = $sql_create."\n";
	$handle = fopen('../index/'.$file_name, 'a');

	fwrite($handle, $content);
	fclose($handle);

	$all_field = implode(', ', $field_array);
	if($table_name != 'WF_CONFIG'){
		$sql_data = db::query("SELECT * FROM ".$table_name." ORDER BY $field_name ASC");
	}else{
		$sql_data = db::query("SELECT * FROM WF_CONFIG ORDER BY CONFIG_ID ASC");	
	} 
	while($rec_data = db::fetch_array($sql_data))
	{
		$i_data = array();

		foreach($field_array as $_val)
		{
			array_push($i_data, "'".$rec_data[$_val]."'");
		}

		$content_insert = "insert into ".$table_name." (".$all_field.") values (".implode(', ', $i_data).");";

		$file_name = "insert_data_for_mysql.txt";
		$content = $content_insert."\n";
		$handle = fopen('../index/'.$file_name, 'a');

		fwrite($handle, $content);
		fclose($handle);
	}
}


?>

<?php include '../include/combottom_admin.php'; ?>