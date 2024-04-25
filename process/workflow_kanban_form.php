<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$process = conText($_GET['process']);
$W = conText($_GET['W']);
$id = conText($_GET['id']);

$p_url = "workflow_kanban";
if($process == "add"){
	$p_process = "เพิ่ม";
	
	$con['WF_MAIN_ID'] = $W;
	$K_ORDER = db::get_max("WF_KANBAN_GROUP", "K_ORDER", $con) + 1;
	
}elseif($process == "edit"){
	$p_process = "แก้ไข";
	
	$sql = db::query("SELECT * FROM WF_KANBAN_GROUP WHERE K_ID = '".$id."'");
	$rec = db::fetch_array($sql);
	$K_ORDER = $rec['K_ORDER'];
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
					<div class="form-group row">
						<div class="col-md-3">
							<label for="K_ORDER" class="form-control-label wf-right">ลำดับ <span class="text-danger">*</span></label>
						</div>
						<div class="col-md-1">
							<input type="text" id="K_ORDER" name="K_ORDER" class="form-control" value="<?php echo $K_ORDER; ?>" required>
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-md-3">
							<label for="K_NAME" class="form-control-label wf-right">ชื่อกลุ่ม Kanban <span class="text-danger">*</span></label>
						</div>
						<div class="col-md-8">
							<input type="text" id="K_NAME" name="K_NAME" class="form-control" value="<?php echo $rec["K_NAME"]; ?>" required>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-md-3">
							<label for="K_NAME" class="form-control-label wf-right">สถานะการใช้งาน </label>
						</div>
						<div class="col-md-1">
							<input type="checkbox" id="K_STATUS" name="K_STATUS" class="form-control" value="Y" <?php if($rec['K_STATUS'] == 'Y'){ echo "checked";} ?>>
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