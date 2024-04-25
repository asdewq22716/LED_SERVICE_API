<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$process = conText($_GET['process']);
$W = conText($_GET['W']);
$id = conText($_GET['id']);
$k_id = conText($_GET['k_id']);

$q_kan = db::query("SELECT K_NAME FROM WF_KANBAN_GROUP WHERE K_ID = '".$k_id."'");
$r_kan = db::fetch_array($q_kan);
$K_NAME = $r_kan['K_NAME'];

$p_url = "workflow_kanban_list";


if($process == "add"){
	$p_process = "เพิ่ม";
}elseif($process == "edit"){
	$p_process = "แก้ไข";
	
	$sql = db::query("SELECT * FROM WF_KANBAN_LIST WHERE K_LIST_ID = '".$id."'");
	$rec = db::fetch_array($sql);
}
?>

<form action="<?php echo $p_url; ?>_function.php" name="wf_g_step" id="wf_g_step" method="post" enctype="multipart/form-data">
	<input type="hidden" name="process" id="process" value="<?php echo $process; ?>">
	<input type="hidden" name="W" id="W" value="<?php echo $W; ?>">
	<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
	<input type="hidden" name="k_id" id="k_id" value="<?php echo $k_id; ?>">
	
	<!-- Row Starts -->
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-block">
					<div class="form-group row">
						<div class="col-md-3">
							<label for="KAN_LIST_NAME" class="form-control-label wf-left">ชื่อกลุ่ม Kanban</label>
						</div>
						<div class="col-md-9"><?php echo $K_NAME;?></div>
					</div>
					
					<div class="form-group row">
						<div class="col-md-3">
							<label for="KAN_LIST_NAME" class="form-control-label wf-left">ชื่อรายการ Kanban <span class="text-danger">*</span></label>
						</div>
						<div class="col-md-9">
							<input type="text" id="KAN_LIST_NAME" name="KAN_LIST_NAME" class="form-control" value="<?php echo $rec['KAN_LIST_NAME']; ?>" required >
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-md-12">
							<div class="form-radio">
								<div class="radio">
									<label>
										<input type="radio" name="KAN_CHOOSE_TYPE" id="KAN_CHOOSE_TYPE1" value="1" <?php echo ($rec['KAN_CHOOSE_TYPE'] == '1' OR $rec['KAN_CHOOSE_TYPE'] == '') ? 'checked' : ''; ?>>
										<i class="helper"></i> ดึงข้อมูลจาก
									</label>
								</div>
								
								<div class="form-group row">
									<div class="col-md-12">
										<select name="KAN_W_ID" id="KAN_W_ID" class="select2 form-control">
											<option value="">ไม่เลือก</option>
											<option value="" disabled>ข้อมูล Master</option>
											<?php
											$sql_list = db::query("select WF_MAIN_ID, WF_MAIN_NAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'M' ORDER BY WF_MAIN_ORDER");
											while($rec_m = db::fetch_array($sql_list)){	?>
												<option value="<?php echo $rec_m["WF_MAIN_ID"]; ?>" <?php if($rec['KAN_W_ID'] == $rec_m["WF_MAIN_ID"]){ echo "selected"; } ?>><?php echo $rec_m["WF_MAIN_NAME"]; ?></option>
											<?php } ?>
											<option value="" disabled>ข้อมูล Workflow</option>
											<?php
											$sql_list = db::query("select WF_MAIN_ID, WF_MAIN_NAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'W' ORDER BY WF_MAIN_ORDER");
											while($rec_m = db::fetch_array($sql_list)){?>
												<option value="<?php echo $rec_m["WF_MAIN_ID"]; ?>" <?php if($rec['KAN_W_ID'] == $rec_m["WF_MAIN_ID"]){ echo "selected"; } ?>><?php echo $rec_m["WF_MAIN_NAME"]; ?></option>
											<?php } ?>
											<option value="" disabled>ข้อมูล Form</option>
											<?php
											$sql_list = db::query("select WF_MAIN_ID, WF_MAIN_NAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'F' ORDER BY WF_MAIN_ORDER");
											while($rec_m = db::fetch_array($sql_list)){?>
												<option value="<?php echo $rec_m["WF_MAIN_ID"]; ?>" <?php if($rec['KAN_W_ID'] == $rec_m["WF_MAIN_ID"]){ echo "selected"; } ?>><?php echo $rec_m["WF_MAIN_NAME"]; ?></option>
											<?php } ?> 
											<option value="" disabled>ข้อมูล Report</option>
											<?php
											$sql_list = db::query("select WF_MAIN_ID, WF_MAIN_NAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'R' ORDER BY WF_MAIN_ORDER");
											while($rec_m = db::fetch_array($sql_list)){?>
												<option value="<?php echo $rec_m["WF_MAIN_ID"]; ?>" <?php if($rec['KAN_W_ID'] == $rec_m["WF_MAIN_ID"]){ echo "selected"; } ?>><?php echo $rec_m["WF_MAIN_NAME"]; ?></option>
											<?php } ?> 
										</select>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
									<label for="KAN_MORE_SQL" class="form-control-label ">SQL เงื่อนไขเพิ่มเติม</label>
										<textarea name="KAN_MORE_SQL" id="KAN_MORE_SQL" class="form-control"><?php echo $rec['KAN_MORE_SQL']; ?></textarea>
									</div>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="KAN_CHOOSE_TYPE" id="KAN_CHOOSE_TYPE2" value="2" <?php echo $rec['KAN_CHOOSE_TYPE'] == '2' ? 'checked' : ''; ?>>
										<i class="helper">
										</i> เขียน Sql เอง
									</label>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<textarea name="KAN_MAIN_SQL" id="KAN_MAIN_SQL" class="form-control"><?php echo $rec['KAN_MAIN_SQL']; ?></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-md-12"><label for="KAN_SHOW" class="form-control-label">การแสดงผล <span class="text-danger">*</span></label>
							<textarea id="KAN_SHOW" name="KAN_SHOW" class="form-control" required><?php echo $rec["KAN_SHOW"]; ?></textarea>
							<small class="form-text text-muted">ตั้งค่าในรูปแบบ ##FIELD!!</small>
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-md-2">
							<label for="KAN_LINK" class="form-control-label wf-left">Link DrillDown</label>
						</div>
						<div class="col-md-10">
							<input type="text" id="KAN_LINK" name="KAN_LINK" class="form-control" value="<?php echo $rec["KAN_LINK"]; ?>" >
							<small  class="form-text text-muted">ตั้งค่าในรูปแบบ ##FIELD!!</small>
						</div>
					</div>
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
		<div class="main-header"></div>
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
					url: "workflow_kanban.php",
					data: dataString,
					cache: false,
					success: function(html){
						$("#kanban_list").html(html);
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