<?php
$HIDE_HEADER = "Y";
include("../include/comtop_admin.php");
	
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");
	header("Content-Disposition: attachment;filename=export.doc "); 
	header("Content-Transfer-Encoding: binary ");
	echo '<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />';

	$array_table = array();
	$sql = db::query("SELECT table_name FROM user_tables ORDER BY table_name");

?>
	<h1>พจนานุกรมข้อมูล (Data Dictionary)</h1>
	<!--<table border="1">
		<thead>
			<tr>
				<th>Module</th>
				<th>Table Name</th>
				<th>Table Description</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$n = 1;
		while($rec_data = db::fetch_array($sql)){?>
			<tr>
				<td></td>
				<td><?php echo $rec_data['TABLE_NAME'];?></td>
				<td></td>
			</tr>
		<?php 
			$array_table[$n]['TABLE_NAME'] = $rec_data['TABLE_NAME'];
			$n++;
		} ?>
		</tbody>
	</table>-->
<?php

		$i=1;
		
		foreach($array_table as $_val){?>
			
			<!--<table border="0">
				<tbody>
					<tr>
						<td><?php //echo 'ตารางที่ '.$i.' ตาราง'.$_val["WF_MAIN_NAME"];?></td>
					</tr>
					<tr>
						<td><?php //echo 'Table Name : '.$_val["TABLE_NAME"];?></td>
					</tr>
				</tbody>
			</table>-->
			<h1><?php echo 'Table Name : '.$_val["TABLE_NAME"];?></h1>
			<table border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
 mso-yfti-tbllook:1184;mso-padding-alt:0in 5.4pt 0in 5.4pt'>
				<thead>
					<tr>
						<th>No.</th>
						<th>Name</th>
						<th>DataType</th>
						<th>Size</th>
						<th>Description</th>
						<th>Key</th>
						<th>Not Null</th>
						<th>Ref.Table</th>
					</tr>
				</thead>
				<tbody>
				<?php
				
				$query_pk = db::query("SELECT cols.column_name as col_name
										FROM user_constraints cons, user_cons_columns cols
										WHERE cols.table_name = '".$_val["TABLE_NAME"]."'
										AND cons.constraint_type = 'P'
										AND cons.constraint_name = cols.constraint_name
										AND cons.owner = cols.owner
										ORDER BY cols.table_name, cols.position");
				$rec_pk = db::fetch_array($query_pk);
				
				$column_pk = $rec_pk["COL_NAME"];
					
				$sql_f = db::query("SELECT COLUMN_NAME,DATA_TYPE,DATA_LENGTH FROM all_tab_cols WHERE table_name = '".$_val["TABLE_NAME"]."' AND OWNER = '".strtoupper('workflow_master4')."'  ORDER BY SEGMENT_COLUMN_ID");
					
				$key = 1;
				while($rec_f = db::fetch_array($sql_f)){
					$sql_comment = db::query("select COMMENTS from  user_col_comments where table_name = '".$_val["TABLE_NAME"]."' AND COLUMN_NAME='".$rec_f['COLUMN_NAME']."'");
					$rec_c = db::fetch_array($sql_comment);
					if(trim($column_pk) == trim($rec_f['COLUMN_NAME'])){$pk = 'PK';}else{ $pk = '';}?>
					<tr>
						<td><?php echo $key;?></td>
						<td><?php echo $rec_f['COLUMN_NAME'];?></td>
						<td><?php echo $rec_f['DATA_TYPE'];?></td>
						<td><?php echo $rec_f['DATA_LENGTH'];?></td>
						<td><?php echo $rec_c['COMMENTS'];?></td>
						<td><?php echo $pk;?></td>
						<td></td>
						<td></td>
					</tr>
				<?php $key++;	}?>
				</tbody>
			</table>
			<?php

			$i++;
		}

db::db_close();
?>