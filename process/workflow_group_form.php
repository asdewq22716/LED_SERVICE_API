<?php
include '../include/comtop_admin.php';

$process = conText($_GET['process']);
$id = conText($_GET['G']);
$WF_TYPE = conText($_GET['WF_TYPE']);

$sql = db::query("select * from WF_GROUP where GROUP_ID = '".$id."'");
$rec = db::fetch_array($sql);

$p_url = "workflow_group";

if($WF_TYPE == 'W'){
	$p_name = "กลุ่มของ Workflow";
	$p_url_main = "workflow_group";
	
}elseif($WF_TYPE == 'F'){
	$p_name = "กลุ่มของ Form";
	$p_url_main = "form_group";

}elseif($WF_TYPE == 'M'){
	$p_name = "กลุ่มของ Master";
	$p_url_main = "master_group";
}elseif($WF_TYPE == 'R'){
	$p_name = "กลุ่มของ Report";
	$p_url_main = "report_group";
}


if($process == "add")
{
	$p_process = "เพิ่ม";
	$a_cond["WF_TYPE"] = $WF_TYPE;
	$mx = db::get_max("WF_GROUP", "GROUP_ORDER",$a_cond) + 1;
}
elseif($process == "edit")
{
	$p_process = "แก้ไข";
	$mx = $rec['GROUP_ORDER'];
}
?>
<div class="content-wrapper">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<!-- Row Starts -->
		<div class="row" id="animationSandbox">
			<div class="col-sm-12">
				<div class="main-header">
					<h4><?php echo $p_name; ?></h4>
					<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
						<li class="breadcrumb-item">
							<a href="index.php"><i class="icofont icofont-home"></i></a>
						</li>
						<li class="breadcrumb-item">
							<a href="<?php echo $p_url_main; ?>_list.php">บริหาร<?php echo $p_name; ?></a>
						</li>
						<li class="breadcrumb-item">
							<a href="#"><?php echo $p_process; ?>ข้อมูล</a>
						</li>
					</ol>
					<div class="f-right">
						<a class="btn btn-danger waves-effect waves-light" href="<?php echo $p_url_main; ?>_list.php" role="button">
							<i class="typcn typcn-chevron-left-outline"></i> ย้อนกลับ
						</a>
					</div>
				</div>
			</div>
		</div>
		<!-- Row end -->
		<form action="<?php echo $p_url; ?>_function.php" name="form_wf" id="form_wf" method="post" enctype="multipart/form-data">
			<input type="hidden" name="process" id="process" value="<?php echo $process; ?>">
			<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
			<input type="hidden" name="WF_TYPE" id="WF_TYPE" value="<?php echo $WF_TYPE; ?>">
			<!-- Row Starts -->
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header"><h5 class="card-header-text">
								<i class="typcn typcn-message"></i> ข้อมูล<?php echo $p_name; ?></h5>
							<div class="f-right">
								<label for="GROUP_STATUS" class="custom-control custom-checkbox">
									<input type="checkbox" name="GROUP_STATUS" id="GROUP_STATUS" class="custom-control-input" value="Y" <?php echo $rec['GROUP_STATUS'] == "Y" ? 'checked' :''; ?>>
									<span class="custom-control-indicator"></span>
									<span class="custom-control-description">เปิดใช้งาน</span>
								</label>
							</div>
						</div>
						<div class="card-block">
							<!---->
							<div class="form-group row">
								<div class="col-md-3">
									<label for="GROUP_ORDER" class="form-control-label wf-right">ลำดับ
										<span class="text-danger">*</span></label>
								</div>
								<div class="col-md-1">
									<input type="text" id="GROUP_ORDER" name="GROUP_ORDER" placeholder="ลำดับ" class="form-control" value="<?php echo $mx; ?>" required>
								</div>
							</div>
							<!---->
							<div class="form-group row">
								<div class="col-md-3">
									<label for="GROUP_NAME" class="form-control-label wf-right">ชื่อ<?php echo $p_name; ?>
										<span class="text-danger">*</span></label>
								</div>
								<div class="col-md-9">
									<input type="text" id="GROUP_NAME" name="GROUP_NAME" placeholder="ตั้งชื่อ <?php echo $p_name; ?>" class="form-control" value="<?php echo $rec['GROUP_NAME']; ?>" required>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-3">
									<label for="GROUP_ICON" class="form-control-label wf-right">ICON</label>
								</div>
								<div class="col-md-9">
									<input type="text" id="GROUP_ICON" name="GROUP_ICON" placeholder="ICON" class="form-control" value="<?php echo $rec['GROUP_ICON']; ?>" >
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="f-left">
						<button type="button" class="btn btn-md btn-danger active waves-effect waves-light" onclick="window.location.href='<?php echo $p_url; ?>_list.php';">
							<i class="typcn typcn-chevron-left-outline"></i> ย้อนกลับ
						</button>
					</div>
					<div class="wf-right">&nbsp;
						<button type="submit" class="btn btn-md btn-success active waves-effect waves-light">
							<i class="icofont icofont-tick-mark"></i> บันทึก
						</button>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="main-header">
				</div>
			</div>
		</form>
		<!-- Container-fluid ends -->
	</div>
</div>
<?php include '../include/combottom_js.php'; ?>

<script>
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
