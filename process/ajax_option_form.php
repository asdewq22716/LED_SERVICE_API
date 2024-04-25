<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$W = conText($_GET['ID']);
$WFS = conText($_GET['WFS']);
$WFS_FIELD_EDIT = conText($_GET['WFS_FORM_FIELD_EDIT']);
$WFS_FIELD_VIEW = conText($_GET['WFS_FORM_FIELD_VIEW']);
$e = explode(',',$WFS_FIELD_EDIT);
$v = explode(',',$WFS_FIELD_VIEW);

if($W != ''){
	
	$sql_step_form = db::query("select WF_STEP_FORM.WFS_ID,WFS_NAME,WFS_FIELD_NAME,WFS_FIELD_TYPE,WFS_FORM_FIELD_EDIT,WFS_FORM_FIELD_VIEW,FORM_MAIN_NAME from WF_STEP_FORM INNER JOIN FORM_SYSTEM ON FORM_SYSTEM.FORM_MAIN_ID=WF_STEP_FORM.FORM_MAIN_ID WHERE WF_MAIN_ID = '".$W."' AND WF_TYPE = 'F' ORDER BY FIELD_G_ID,WFS_ORDER,WFS_OFFSET");

	?>
	<table class='table table-bordered'>
		<thead class='sorted_head'>
			<tr class="bg-primary">
				<td class="text-center">ชื่อ</td>
				<td class="text-center">Field</td>
				<td class="text-center">ประเภท</td>
				<td class="text-center">ไม่แสดง</td>
				<td class="text-center">แสดงในส่วนแก้ไขข้อมูล</td>
				<td class="text-center">แสดงในส่วนดูข้อมูล</td>
			</tr>
		</thead>
		<tbody>
			<?php
			$i=1;
			/*echo '='.$WFS_FIELD_EDIT;
			echo '<br>';
			echo '='.$WFS_FORM_FIELD_VIEW;*/
			while($step_form = db::fetch_array($sql_step_form)){
				if(in_array($step_form["WFS_ID"],$e)){//edit
					$check_e = 'checked';
					$check_v = '';
					$check_n = '';
				}elseif(in_array($step_form["WFS_ID"],$v)){//view
					$check_e = '';
					$check_v = 'checked';
					$check_n = '';
				}else{//ไม่แสดง
					if(($e == 0) AND ($v == 0)){
						$check_e = 'checked';
						$check_n = '';
					}else{
						$check_e = '';
						$check_n = 'checked';
					}
					$check_v = '';
					
				}
			?>
			<tr>
				<td><?php echo $step_form["WFS_NAME"];?></td>
				<td><?php echo $step_form["WFS_FIELD_NAME"];?></td>
				<td><?php echo $step_form["FORM_MAIN_NAME"];?></td>
				<td class="text-center">
					<input type="radio" name="WFS_FORM_FIELD_EDIT<?php echo $i;?>" id="WFS_FORM_FIELD_N<?php echo $i;?>" value="N" <?php echo $check_n;?>></input>		
				<td class="text-center">
					<input type="radio" name="WFS_FORM_FIELD_EDIT<?php echo $i;?>" id="WFS_FORM_FIELD_EDIT<?php echo $i;?>" value="E" <?php echo $check_e;?>></input>
				</td>
				<td class="text-center">
					<input type="radio" name="WFS_FORM_FIELD_EDIT<?php echo $i;?>" id="WFS_FORM_FIELD_VIEW<?php echo $i;?>" value="V" <?php echo $check_v;?>></input>
							
				</td>
				<input type="hidden" name="WFS_ID<?php echo $i;?>" id="WFS_ID<?php echo $i;?>" value="<?php echo $step_form["WFS_ID"];?>">
			</tr>
			<?php $i++;}?>
			<input type="hidden" name="NUM_ROWS_FIELD" id="NUM_ROWS_FIELD" value="<?php echo $i;?>">
		</tbody>
	</table>
	
<?php	
	/*if($WFS != ''){
		$sql_field_show = db::query("select WFS_FORM_FIELD_EDIT from WF_STEP_FORM WHERE WFS_ID = '".$WFS."'");
		$show_field = db::fetch_array($sql_field_show);
		$e = explode(',',$show_field["WFS_FORM_FIELD_EDIT"]);
	}
	
	while($step_form = db::fetch_array($sql_step_form)){
		if(in_array($step_form["WFS_ID"], $e)){ $selected = 'selected';}else{$selected = '';}
		$str .= "<option value='".$step_form["WFS_ID"]."' ".$selected.">".$step_form["WFS_NAME"]."</option>";
	}
	echo $str;*/
}
db::db_close();
?>