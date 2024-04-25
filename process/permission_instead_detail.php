	<div class="form-group row">
		<div class="col-md-3">
			<label for="USR_FNAME" class="form-control-label wf-right">ชื่อ</label>
		</div>
		<div class="col-md-9">
			<?php echo $rec['USR_PREFIX'].$rec['USR_FNAME'].' '.$rec['USR_LNAME'];?>
		</div>
	</div>
	<!---->
	<div class="form-group row">
		<?php
		$data_s = show_field('USR_EMAIL');
		?>
		<div class="col-md-3">
			<label for="USR_EMAIL" class="form-control-label wf-right"><?php echo $data_s["FIELD_LABEL"]; ?></label>
		</div>
		
		<div class="col-md-4">
			<?php echo $rec['USR_EMAIL']; ?>
		</div>
		<?php 
		$data_t = show_field('USR_TEL');?>
		<div class="col-md-1">
			<label for="USR_TEL" class="form-control-label wf-right"><?php echo $data_t["FIELD_LABEL"];?></label>
		</div>
		<div class="col-md-4">
			<?php echo $rec['USR_TEL']; ?>
		</div>
	</div>
	<!---->
	<?php
	$data_d = show_field('DEP_ID');?>
	<div class="form-group row">
		<div class="col-md-3">
			<label for="DEP_ID" class="form-control-label wf-right"><?php echo $data_d["FIELD_LABEL"]; ?></label>
		</div>
		<div class="col-md-6">
			<?php
			$department_data = build_data('USR_DEPARTMENT', 'DEP_ID', 'DEP_NAME');
			echo $department_data[$rec['DEP_ID']];
			
			?>
		</div>
	</div>
	<!---->
	<?php
	$data_p = show_field('POS_ID');?>
	<div class="form-group row">
		<div class="col-md-3">
			<label for="USR_TEL" class="form-control-label wf-right"><?php echo $data_p["FIELD_LABEL"]; ?></label>
		</div>
		<div class="col-md-6">
			<?php
			
			$position_data = build_data('USR_POSITION', 'POS_ID', 'POS_NAME');
			echo $position_data[$rec['POS_ID']];
			
			?>
		</div>
	</div>
	<!---->
	<?php
	$data_l = show_field('USR_LINE_ID');?>
	<div class="form-group row">
		<div class="col-md-3">
			<label for="USR_LINE_ID" class="form-control-label wf-right"><?php echo $data_l["FIELD_LABEL"]; ?></label>
		</div>
		<div class="col-md-4">
			<?php echo $rec['USR_LINE_ID']; ?>
		</div>
	</div>
	<!---->
	<?php

	$sql = db::query("SELECT * FROM USR_SETTING WHERE FIELD_TYPE='O' AND FIELD_STATUS='Y' ORDER BY FIELD_ID");
	$i=1;
	while($rec_o = db::fetch_array($sql)){	
		$wh = '';
		if($rec_o["FIELD_ID"] != ''){
			$sql_master = db::query("SELECT WF_MAIN_ID,WF_MAIN_NAME,WF_MAIN_SHORTNAME,WF_FIELD_PK,WF_TYPE FROM WF_MAIN WHERE WF_MAIN_ID = '".$rec_o["WF_MAIN_ID"]."'");
			$rec_m = db::fetch_array($sql_master);
				
				
			$sql_mpk = db::query("SELECT WFS_FIELD_NAME as WFS_FIELD_NAME FROM WF_STEP_FORM WHERE WF_MAIN_ID = '". $rec_o["WF_MAIN_ID"]."' ");
			$rec_ms = db::fetch_array($sql_mpk);
			
			if($rec_o['FIELD_TEXT'] != '' AND ($rec_o['FIELD_RELETION'] == '' OR $rec_o['FIELD_RELETION'] == 'M')){
				$rec_ms["WFS_FIELD_NAME"] = $rec_o['FIELD_TEXT']; 
				
			}
			
			if($rec_o['FIELD_RELETION'] == 'T'){ //TEXT?>
				<div class="form-group row">
					<div class="col-md-3">
						<label for="USR_OPTION<?php echo $i; ?>" class="form-control-label wf-right"><?php echo $rec_o['FIELD_LABEL']; ?>
						</label>
					</div>
					<div class="col-md-4">
						<?php echo $rec[$rec_o["FIELD_NAME"]]; ?>
						
					</div>
				</div>
			<?php
			}elseif(($rec_o['FIELD_RELETION'] == 'M' OR $rec_o['FIELD_RELETION'] == '') AND $rec_m["WF_MAIN_ID"] != ''){ //1:M,1:1
				if($rec_o['FIELD_STATEMENT'] != ''){
					$wh = " where ".str_replace("&#039;","'",$rec_o['FIELD_STATEMENT']);
					
				}else{
					$wh = '';
				}
				
				if($rec_o['FIELD_RELETION'] == 'M'){$arr = '[]';$multi = 'multiple';}else{ $arr = '';$multi ='';}
				
				$sql_mt = "SELECT * FROM ".$rec_m["WF_MAIN_SHORTNAME"].$wh;
				$sql_m_t = db::query($sql_mt);?>
				<div class="form-group row">
					<div class="col-md-3">
						<label for="USR_OPTION<?php echo $i; ?>" class="form-control-label wf-right"><?php echo $rec_o["FIELD_LABEL"]; ?></label>
					</div>
					<div class="col-md-6">
						
						<?php
						if($rec["USR_OPTION".$i] != ''){
							$data = explode(',',$rec["USR_OPTION".$i]);
						}else{
							$data = array();
							
						}
						$arr_show = array();
						while($data_m = db::fetch_array($sql_m_t)){
						
							if($rec_o['FIELD_RELETION'] == 'M'){
								if(in_array($data_m[$rec_m["WF_FIELD_PK"]], $data)){
									 $arr_show[] = bsf_show_text($rec_m["WF_MAIN_ID"],$data_m,$rec_o['FIELD_TEXT'],$rec_m["WF_TYPE"]);
								}
							}else{
								if(in_array($data_m[$rec_m["WF_FIELD_PK"]], $data)){
									echo bsf_show_text($rec_m["WF_MAIN_ID"],$data_m,$rec_o['FIELD_TEXT'],$rec_m["WF_TYPE"]);
								}
								
							}
						}	
						if(count($arr_show) > 0){
							echo $option = implode(' , ',$arr_show);
							
						}
						?>
					</div>
			</div>

			<?php									
			}
		}
	$i++;}
	?>