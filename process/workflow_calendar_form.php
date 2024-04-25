<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$process = conText($_GET['process']);
$W = conText($_GET['W']);
$id = conText($_GET['id']);




$p_url = "workflow_calendar";
if($process == "add")
{
	$p_process = "เพิ่ม";
}
elseif($process == "edit")
{
	$p_process = "แก้ไข";
	$sql = db::query("select * from WF_CALENDAR where CAL_ID = '".$id."'");
	$rec = db::fetch_array($sql);
}
?>

		<form action="<?php echo $p_url; ?>_function.php" name="wf_g_step" id="wf_g_step" method="post" enctype="multipart/form-data">
			<input type="hidden" name="process" id="process" value="<?php echo $process; ?>">
			<input type="hidden" name="W" id="W" value="<?php echo $W; ?>">
			<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
			<!-- Row Starts -->
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-block">
							<!---->
							<div class="form-group row">
								<div class="col-md-12">
									<div class="form-radio">
										<div class="radio"> <!-- radio-inline -->
											<label>
												<input type="radio" name="CAL_CHOOSE_TYPE" id="CAL_CHOOSE_TYPE1" value="1" <?php echo ($rec['CAL_CHOOSE_TYPE'] == '1' OR $rec['CAL_CHOOSE_TYPE'] == '') ? 'checked' : ''; ?>>
												<i class="helper"></i> ดึงข้อมูลจาก
											</label>
										</div>
										<div class="form-group row">
											<div class="col-md-12">
												<select name="CAL_W_ID" id="CAL_W_ID" class="select2 form-control">
													<option value="">ไม่เลือก</option>
													<option value="" disabled>ข้อมูล Master</option>
													<?php
													$sql_list = db::query("select WF_MAIN_ID,WF_MAIN_NAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'M' ORDER BY WF_MAIN_ORDER");
													
													while($rec_m = db::fetch_array($sql_list)){	?>
														<option value="<?php echo $rec_m["WF_MAIN_ID"]; ?>" <?php if($rec['CAL_W_ID'] == $rec_m["WF_MAIN_ID"]){ echo "selected"; } ?>><?php echo $rec_m["WF_MAIN_NAME"]; ?></option>
													<?php } ?>
													<option value="" disabled>ข้อมูล Workflow</option>
													<?php
													$sql_list = db::query("select WF_MAIN_ID,WF_MAIN_NAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'W' ORDER BY WF_MAIN_ORDER");
													
													while($rec_m = db::fetch_array($sql_list)){?>
														<option value="<?php echo $rec_m["WF_MAIN_ID"]; ?>" <?php if($rec['CAL_W_ID'] == $rec_m["WF_MAIN_ID"]){ echo "selected"; } ?>><?php echo $rec_m["WF_MAIN_NAME"]; ?></option>
													<?php } ?>
													<option value="" disabled>ข้อมูล Form</option>
													<?php
													$sql_list = db::query("select WF_MAIN_ID,WF_MAIN_NAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'F' ORDER BY WF_MAIN_ORDER");
													
													while($rec_m = db::fetch_array($sql_list)){?>
														<option value="<?php echo $rec_m["WF_MAIN_ID"]; ?>" <?php if($rec['CAL_W_ID'] == $rec_m["WF_MAIN_ID"]){ echo "selected"; } ?>><?php echo $rec_m["WF_MAIN_NAME"]; ?></option>
													<?php } ?> 
													<option value="" disabled>ข้อมูล Report</option>
													<?php
													$sql_list = db::query("select WF_MAIN_ID,WF_MAIN_NAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'R' ORDER BY WF_MAIN_ORDER");
													
													while($rec_m = db::fetch_array($sql_list)){?>
														<option value="<?php echo $rec_m["WF_MAIN_ID"]; ?>" <?php if($rec['CAL_W_ID'] == $rec_m["WF_MAIN_ID"]){ echo "selected"; } ?>><?php echo $rec_m["WF_MAIN_NAME"]; ?></option>
													<?php } ?> 
												</select>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-12">
											<label for="CAL_MORE_SQL" class="form-control-label ">SQL เงื่อนไขเพิ่มเติม</label>
												<textarea name="CAL_MORE_SQL" id="CAL_MORE_SQL" class="form-control"><?php echo $rec['CAL_MORE_SQL']; ?></textarea>
											</div>
										</div>
										<div class="radio">
											<label>
												<input type="radio" name="CAL_CHOOSE_TYPE" id="CAL_CHOOSE_TYPE2" value="2" <?php echo $rec['CAL_CHOOSE_TYPE'] == '2' ? 'checked' : ''; ?>>
												<i class="helper">
												</i> เขียน Sql เอง
											</label>
										</div>
										<div class="form-group row">
											<div class="col-md-12">
												<textarea name="CAL_MAIN_SQL" id="CAL_MAIN_SQL" class="form-control"><?php echo $rec['CAL_MAIN_SQL']; ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!---->
							<!---->
							<div class="form-group row">
								<div class="col-md-12"><label for="CAL_SHOW" class="form-control-label">การแสดงผล
										<span class="text-danger">*</span></label>
									<textarea id="CAL_SHOW" name="CAL_SHOW" class="form-control" required><?php echo $rec["CAL_SHOW"]; ?></textarea>
									<small  class="form-text text-muted">ตั้งค่าในรูปแบบ ##FIELD!!</small>

								</div>
							</div>
							<!---->
							<!---->
							<div class="form-group row">
								<div class="col-md-2">
									<label for="CAL_TAG_COLOR" class="form-control-label wf-right">สี Header</label>
								</div>
								<div class="col-md-2">
									<input type="text" id="CAL_TAG_COLOR" name="CAL_TAG_COLOR" placeholder="#" class="form-control" value="<?php echo $rec["CAL_TAG_COLOR"]; ?>" >
								</div>
								<div class="col-md-2">
									<label for="CAL_BG_COLOR" class="form-control-label wf-right">สีพื้นหลัง</label>
								</div>
								<div class="col-md-2">
									<input type="text" id="CAL_BG_COLOR" name="CAL_BG_COLOR" placeholder="#" class="form-control" value="<?php echo $rec["CAL_BG_COLOR"]; ?>" >
								</div>
								<div class="col-md-2">
									<label for="CAL_TEXT_COLOR" class="form-control-label wf-right">สีตัวอักษร</label>
								</div>
								<div class="col-md-2">
									<input type="text" id="CAL_TEXT_COLOR" name="CAL_TEXT_COLOR" placeholder="#" class="form-control" value="<?php echo $rec["CAL_TEXT_COLOR"]; ?>" >
								</div>
							</div>
							<!---->
							<!---->
							<div class="form-group row">
								<div class="col-md-2">
									<label for="CAL_START_DATE" class="form-control-label wf-right">Field วันที่เริ่ม <span class="text-danger">*</span></label>
								</div>
								<div class="col-md-3">
									<input type="text" id="CAL_START_DATE" name="CAL_START_DATE" class="form-control text-uppercase" value="<?php echo $rec["CAL_START_DATE"]; ?>" required>
								</div>
								<div class="col-md-2">
									<label for="CAL_START_TIME" class="form-control-label wf-right">Field เวลาเริ่ม</label>
								</div>
								<div class="col-md-3">
									<input type="text" id="CAL_START_TIME" name="CAL_START_TIME" class="form-control text-uppercase" value="<?php echo $rec["CAL_START_TIME"]; ?>" >
								</div>
							</div>
							<!---->
							<!---->
							<div class="form-group row">
								<div class="col-md-2">
									<label for="CAL_END_DATE" class="form-control-label wf-right">Field วันที่สิ้นสุด</label>
								</div>
								<div class="col-md-3">
									<input type="text" id="CAL_END_DATE" name="CAL_END_DATE" class="form-control text-uppercase" value="<?php echo $rec["CAL_END_DATE"]; ?>" >
								</div>
								<div class="col-md-2">
									<label for="CAL_END_TIME" class="form-control-label wf-right">Field เวลาสิ้นสุด</label>
								</div>
								<div class="col-md-3">
									<input type="text" id="CAL_END_TIME" name="CAL_END_TIME" class="form-control text-uppercase" value="<?php echo $rec["CAL_END_TIME"]; ?>" >
								</div>
							</div>
							<!---->
							<!---->
							<div class="form-group row">
								<div class="col-md-2">
									<label for="CAL_LINK" class="form-control-label wf-right">Link DrillDown</label>
								</div>
								<div class="col-md-10">
									<input type="text" id="CAL_LINK" name="CAL_LINK" class="form-control" value="<?php echo $rec["CAL_LINK"]; ?>" >
									<small  class="form-text text-muted">ตั้งค่าในรูปแบบ ##FIELD!!</small>
								</div>
							</div>
							<!---->
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					
					
						<button type="submit" class="btn btn-md btn-success active waves-effect waves-light">
							<i class="icofont icofont-tick-mark"></i> บันทึก
						</button>
					
				</div>
			</div>
			<div class="row">
				<div class="main-header">
				</div>
			</div>
		</form>
		<!-- Container-fluid ends -->

<?php include '../include/combottom_js.php'; ?>

<script>
	$("#wf_g_step").submit(function(e) {

		var url = "<?php echo $p_url; ?>_function.php"; 

		$.ajax({
			   type: "POST",
			   url: url,
			   data: $("#wf_g_step").serialize(), 
			   success: function(data)
			   {
				var dataString = 'W=<?php echo $W;?>';
				$.ajax({
				 type: "GET",
				 url: "workflow_calendar.php",
				 data: dataString,
				 cache: false,
				 success: function(html){
				  $("#calendar_list").html(html);
				  $('#bizModal').modal('hide');
				 }
				 });
			   }
			 });

		e.preventDefault(); // avoid to execute the actual submit of the form.
	});

	$(document).ready(function(){
		$('select.select2').select2({ 
				allowClear: true,
				placeholder: function(){
					$(this).data('placeholder');
				}
			});

	});
</script>

<?php include '../include/combottom_admin.php'; ?>
