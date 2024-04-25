<?php
include '../include/comtop_admin.php';

$process = conText($_GET['process']);
$id = conText($_GET['D']);

$sql = db::query("select * from USR_DEPARTMENT where DEP_ID = '".$id."'");
$rec = db::fetch_array($sql);

$p_name = "หน่วยงาน";
$p_url = "department";
if($process == "add")
{
	$p_process = "เพิ่ม";
	$mx = db::get_max("USR_DEPARTMENT", "DEP_ORDER") + 1;
}
elseif($process == "edit")
{
	$p_process = "แก้ไข";
	$mx = $rec['DEP_ORDER'];
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
							<a href="<?php echo $p_url; ?>_list.php">บริหาร<?php echo $p_name; ?></a>
						</li>
						<li class="breadcrumb-item">
							<a href="#"><?php echo $p_process; ?>ข้อมูล</a>
						</li>
					</ol>
					<div class="f-right">
						<a class="btn btn-danger waves-effect waves-light" href="<?php echo $p_url; ?>_list.php" role="button">
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
			<!-- Row Starts -->
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header"><h5 class="card-header-text">
								<i class="typcn typcn-message"></i> ข้อมูล<?php echo $p_name; ?></h5>
							<div class="f-right">
								<label for="DEP_STATUS" class="custom-control custom-checkbox">
									<input type="checkbox" name="DEP_STATUS" id="DEP_STATUS" class="custom-control-input" value="Y" <?php echo $rec['DEP_STATUS'] == "Y" ? 'checked' :''; ?>>
									<span class="custom-control-indicator"></span>
									<span class="custom-control-description">เปิดใช้งาน</span>
								</label>
							</div>
						</div>
						<div class="card-block">
							<!---->
							<div class="form-group row">
								<div class="col-md-2">
									<label for="DEP_ORDER" class="form-control-label wf-right">ลำดับ
										<span class="text-danger">*</span></label>
								</div>
								<div class="col-md-1">
									<input type="text" id="DEP_ORDER" name="DEP_ORDER" placeholder="ลำดับ" class="form-control" value="<?php echo $mx; ?>" required>
								</div>
								<div class="col-md-2 offset-md-3">
									<label for="DEP_CODE" class="form-control-label wf-right">รหัส<?php echo $p_name; ?></label>
								</div>
								<div class="col-md-4">
									<input type="text" id="DEP_CODE" name="DEP_CODE" placeholder="ตั้งรหัส <?php echo $p_name; ?>" class="form-control" value="<?php echo $rec['DEP_CODE']; ?>">
								</div>
							</div>
							<!---->
							<div class="form-group row">
								<div class="col-md-2">
									<label for="DEP_NAME" class="form-control-label wf-right">ชื่อ<?php echo $p_name; ?>
										<span class="text-danger">*</span></label>
								</div>
								<div class="col-md-4">
									<input type="text" id="DEP_NAME" name="DEP_NAME" placeholder="ตั้งชื่อ <?php echo $p_name; ?>" class="form-control" value="<?php echo $rec['DEP_NAME']; ?>" required>
								</div>
								<div class="col-md-2">
									<label for="DEP_SHORT_NAME" class="form-control-label wf-right">ชื่อย่อ<?php echo $p_name; ?></label>
								</div>
								<div class="col-md-4">
									<input type="text" id="DEP_SHORT_NAME" name="DEP_SHORT_NAME" placeholder="ตั้งชื่อย่อ <?php echo $p_name; ?>" class="form-control" value="<?php echo $rec['DEP_SHORT_NAME']; ?>">
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
