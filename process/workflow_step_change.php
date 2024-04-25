<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$W = conText($_GET['W']);
$WFD = conText($_GET['WFD']);

$_system_type = "workflow"; 
$_url_edit = "workflow_step_form_edit.php";
$_url_function = "workflow_step_form_function.php";

$sql_detail = db::query("select WFD_DEFAULT_STEP,WFD_NAME from WF_DETAIL where WFD_ID = '".$WFD."'");
$rec_detail = db::fetch_array($sql_detail);

$sql_form_n = db::query("SELECT WFD_ID,WFD_ORDER,WFD_NAME FROM WF_DETAIL where WF_MAIN_ID = '".$W."' ORDER BY WFD_ORDER ASC ");
while($FN= db::fetch_array($sql_form_n)){
 $arr_list[$FN['WFD_ID']] = "(".$FN["WFD_ORDER"].") ".$FN["WFD_NAME"];
}
?>
	<!-- Row Starts -->

	<form action="workflow_detail_function.php" method="post" id="form_step_change">
				<div class="card-header">
					<h5 class="card-header-text">
						<i class="fa fa-random"></i> เงื่อนไขการเปลี่ยน Flow<br/>
						<span class="label bg-success">
							Default Flow <i class="fa fa-caret-right"></i> 
						</span>
						<?php form_dropdown('WFD_DEFAULT_STEP', $arr_list, $rec_detail['WFD_DEFAULT_STEP'], ' '); ?>
						
					</h5>
					<div class="f-right">
						<button type="button" class="btn btn-warning waves-effect waves-light" onclick="save_step('<?php echo $WFD;?>')"> <!-- onclick="submit_step_change()" -->
							<i class="fa fa-save"></i> บันทึกเงื่อนไข
						</button>
					</div>
				</div>
				<div class="card-block">
					<div class="form-group row">
						<div class="col-md-12">
							<div class="table-responsive" data-pattern="priority-columns">
								<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
									<thead>
										<tr class="bg-primary">
											<th style="width: 10%;" class="text-center" data-priority="1">Active</th>
											<th style="width: 25%;" class="text-center" data-priority="1">ชื่อ Field ในตาราง</th>
											<th style="width: 15%;" class="text-center" data-priority="2">เงื่อนไข</th>
											<th style="width: 25%;" class="text-center" data-priority="1">ค่าตัวแปร</th>
											<th style="width: 25%;" class="text-center" data-priority="3">ขั้นตอนถัดไป</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$j=0;
										$sql_step1 = db::query("SELECT * FROM WF_STEP_CON WHERE WFD_ID = '".$WFD."' ORDER BY WFSC_ID");
										while($O=db::fetch_array($sql_step1)){ ?>
											<tr>
												<th class="text-center">
													<div class="rkmd-checkbox checkbox-rotate checkbox-ripple">
														<label class="input-checkbox checkbox-success">
															<input type="checkbox" name="WF_CON_USE<?php echo $j; ?>" id="WF_CON_USE<?php echo $j; ?>" value="Y" checked onClick="use_data(this,'<?php echo $j; ?>');">
															<span class="checkbox"></span>
															<input type="hidden" name="WFSC_ID<?php echo $j; ?>" id="WFSC_ID<?php echo $j; ?>" value="<?php echo $O["WFSC_ID"]; ?>">
														</label>
														<div class="captions"></div>
													</div>
												</th>
												<th>
													<input type="text" name="WFSC_VAR<?php echo $j; ?>" id="WFSC_VAR<?php echo $j; ?>"  value="<?php echo $O["WFSC_VAR"];?>"class="form-control input-success">
												</th>
												<td>
													<select class="form-control" name="WFSC_OPERATE<?php echo $j; ?>" id="WFSC_OPERATE<?php echo $j; ?>" >
														<option value="" disabled selected>เลือก</option>
														<option value="1" <?php if($O["WFSC_OPERATE"] == "1"){ echo "selected"; } ?>>เท่ากับ (=)</option>
														<option value="2" <?php if($O["WFSC_OPERATE"] == "2"){ echo "selected"; } ?>>มากกว่า (>)</option>
														<option value="3" <?php if($O["WFSC_OPERATE"] == "3"){ echo "selected"; } ?>>มากกว่าเท่ากับ (>=)</option>
														<option value="4" <?php if($O["WFSC_OPERATE"] == "4"){ echo "selected"; } ?>>น้อยกว่า (<)</option>
														<option value="5" <?php if($O["WFSC_OPERATE"] == "5"){ echo "selected"; } ?>>น้อยกว่าเท่ากับ (<=)</option>
														<option value="6" <?php if($O["WFSC_OPERATE"] == "6"){ echo "selected"; } ?>>ไม่เท่ากับ (!=)</option>
														
													</select>
												</td>
												<td class="text-center">
													<input type="text" class="form-control input-warning" name="WFSC_VALUE<?php echo $j; ?>" id="WFSC_VALUE<?php echo $j; ?>" value="<?php echo $O["WFSC_VALUE"]; ?>" >
													
												</td>
												<td>
												<?php form_dropdown('WFSC_STEP'.$j, $arr_list, $O["WFSC_STEP"], ' '); ?>
												</td>
											</tr>
										
										<?php
										$j++;
										}
										$round = 5+$j;
										
										for($k=$j;$k<$round;$k++)
										{ ?>
											<tr>
												<th class="text-center">
													<div class="rkmd-checkbox checkbox-rotate checkbox-ripple">
														<label class="input-checkbox checkbox-success">
															<input type="checkbox" name="WF_CON_USE<?php echo $k; ?>" id="WF_CON_USE<?php echo $k; ?>" value="Y" onClick="use_data(this,'<?php echo $k; ?>');">
															<span class="checkbox"></span>
														</label>
														<div class="captions"></div>
													</div>
												</th>
												<th>
													<input type="text" name="WFSC_VAR<?php echo $k; ?>" id="WFSC_VAR<?php echo $k; ?>"  class="form-control input-success" disabled>
												</th>
												<td>
													<select class="form-control" name="WFSC_OPERATE<?php echo $k; ?>" id="WFSC_OPERATE<?php echo $k; ?>" disabled >
														<option value="" disabled selected>เลือก</option>
														<option value="1" >เท่ากับ (=)</option>
														<option value="2" >มากกว่า (>)</option>
														<option value="3" >มากกว่าเท่ากับ (>=)</option>
														<option value="4" >น้อยกว่า (<)</option>
														<option value="5" >น้อยกว่าเท่ากับ (<=)</option>
														<option value="6" >ไม่เท่ากับ (!=)</option>
														
													</select>
												</td>
												<td class="text-center">
													<input type="text" class="form-control input-warning" name="WFSC_VALUE<?php echo $k; ?>" id="WFSC_VALUE<?php echo $k; ?>"  disabled>
													
												</td>
												<td>
													<?php form_dropdown('WFSC_STEP'.$k, $arr_list, '', ' disabled'); ?>
												</td>
											</tr>
										<?php } ?>
											<tr>
												<td class="text-center" colspan="5">
													
													<input type="hidden" name="num_k" id="num_k" value="<?php echo $round; ?>" />
													<input type="hidden" name="process" id="process" value="ADD_STEP_CON">
													<input type="hidden" name="WFD" id="WFD" value="<?php echo $WFD;?>">
												</td>
											</tr>
									</tbody>
								</table>
							
								
							</div>
						</div>
					</div>
				</div>
	</form>

	<!-- Row end -->
</div>
</div>
<script>
	$(document).ready(function() {
			$('.select2').select2({
				placeholder: 'กรุณาเลือก...',
				allowClear: true
			});
	});
	<?php if($j > 0){ ?>
	if( $('#wf_process_way_show').length )
	{
		 $('#wf_process_way_show').html('<label class="badge bg-success"><?php echo $j; ?></label>');
	}
	<?php }else{ ?>
	if( $('#wf_process_way_show').length )
	{
		 $('#wf_process_way_show').html('');
	}
	<?php } ?>
	function use_data(c,i){
	if(c.checked==true){ 
		document.getElementById("WFSC_VAR"+i).disabled = false;
		document.getElementById("WFSC_VALUE"+i).disabled = false;
		document.getElementById("WFSC_STEP"+i).disabled = false;	
		document.getElementById("WFSC_OPERATE"+i).disabled = false;	
		$("#WFSC_OPERATE"+i).trigger('chosen:open');
	}else{
		document.getElementById("WFSC_VAR"+i).disabled = true;
		document.getElementById("WFSC_VALUE"+i).disabled = true;
		document.getElementById("WFSC_STEP"+i).disabled = true;
		document.getElementById("WFSC_OPERATE"+i).disabled = true;
		$("#WFSC_OPERATE"+i).trigger('chosen:open');
	}
}

</script>
<?php
db::db_close();
?>