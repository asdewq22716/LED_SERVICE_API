<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$process = conText($_GET['process']);
$W = conText($_GET['W']);
$id = conText($_GET['id']);


$sql = db::query("select * from WF_DETAIL_GROUP where DETAIL_G_ID = '".$id."'");
$rec = db::fetch_array($sql);

$p_name = "บริหารกลุ่มขั้นตอน";
$p_url = "workflow_detail_group";
if($process == "add")
{
	$p_process = "เพิ่ม";
	$con['WF_MAIN_ID'] = $W;
	$mx = db::get_max("WF_DETAIL_GROUP", "DETAIL_G_ORDER",$con) + 1;
}
elseif($process == "edit")
{
	$p_process = "แก้ไข";
	$mx = $rec['DETAIL_G_ORDER'];
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
								<div class="col-md-3">
									<label for="DETAIL_G_ORDER" class="form-control-label wf-right">ลำดับ
										<span class="text-danger">*</span></label>
								</div>
								<div class="col-md-1">
									<input type="text" id="DETAIL_G_ORDER" name="DETAIL_G_ORDER" placeholder="ลำดับ" class="form-control" value="<?php echo $mx; ?>" required>
								</div>
							</div>
							<!---->
							<!---->
							<div class="form-group row">
								<div class="col-md-3">
									<label for="DETAIL_G_NAME" class="form-control-label wf-right">ชื่อกลุ่มของขั้นตอน
										<span class="text-danger">*</span></label>
								</div>
								<div class="col-md-4">
									<input type="text" id="DETAIL_G_NAME" name="DETAIL_G_NAME" placeholder="ชื่อกลุ่มของขั้นตอน" class="form-control" value="<?php echo $rec["DETAIL_G_NAME"]; ?>" required>
								</div>
							</div>
							<!---->
							<!---->
							<div class="form-group row">
								<div class="col-md-3">
									<label for="DETAIL_G_NUMDAY" class="form-control-label wf-right">จำนวนวัน</label>
								</div>
								<div class="col-md-2">
									<input type="text" id="DETAIL_G_NUMDAY" name="DETAIL_G_NUMDAY" placeholder="จำนวนวัน" class="form-control" value="<?php echo $rec["DETAIL_G_NUMDAY"]; ?>" >
								</div>
							</div>
							<!---->
							<!---->
							<div class="form-group row">
								<div class="col-md-3">
									<label for="DETAIL_G_WEIGHT" class="form-control-label wf-right">Weight</label>
								</div>
								<div class="col-md-2">
									<input type="text" id="DETAIL_G_WEIGHT" name="DETAIL_G_WEIGHT" placeholder="Weight" class="form-control" value="<?php echo $rec["DETAIL_G_WEIGHT"]; ?>" >
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
				 url: "workflow_detail_group_list.php",
				 data: dataString,
				 cache: false,
				 success: function(html){
				  $("#group_step_list").html(html);
				  $('#bizModal').modal('hide');
				 }
				 });
			   }
			 });

		e.preventDefault(); // avoid to execute the actual submit of the form.
	});

	$(document).ready(function(){
		var elem1 = document.querySelector('.js-dynamic');
		var switchery = new Switchery(elem1, {});
		var elem_default = document.querySelector('.js-dynamic-default');
		var switchery = new Switchery(elem_default, {
			jackColor: '#fff',
			size: 'small'
		});
		var elem_primary = document.querySelector('.js-dynamic-primary');
		var switchery = new Switchery(elem_primary, {
			color: '#2196F3',
			jackColor: '#fff',
			size: 'small'
		});
		var elem_danger = document.querySelector('.js-dynamic-danger');
		var switchery = new Switchery(elem_danger, {
			color: '#ff5252',
			jackColor: '#fff',
			size: 'small'
		});
		var elem_info = document.querySelector('.js-dynamic-info');
		var switchery = new Switchery(elem_info, {
			color: '#40c4ff',
			jackColor: '#fff',
			size: 'small'
		});
		var elem_warning = document.querySelector('.js-dynamic-warning');
		var switchery = new Switchery(elem_warning, {
			color: '#f57c00',
			jackColor: '#fff',
			size: 'small'
		});
	});
</script>

<?php include '../include/combottom_admin.php'; ?>
