<?php
include '../include/comtop_admin.php';

$process = conText($_GET['process']);
$id = conText($_GET['G']);

$sql = db::query("select * from WF_MENU where MENU_ID = '".$id."'");
$rec = db::fetch_array($sql);

$p_url = "menu_group";
$p_name = "กลุ่มของ Menu";
$p_url_main = "menu_group";

if($process == "add")
{
	$p_process = "เพิ่ม";
	$mx = db::get_max("WF_MENU", "MENU_ORDER") + 1;
}
elseif($process == "edit")
{
	$p_process = "แก้ไข";
	$mx = $rec['MENU_ORDER'];
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
		<form action="<?php echo $p_url; ?>_function.php" name="menu_group" id="menu_group" method="post" enctype="multipart/form-data">
			<input type="hidden" name="process" id="process" value="<?php echo $process; ?>">
			<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
			<!-- Row Starts -->
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header"><h5 class="card-header-text">
								<i class="typcn typcn-message"></i> ข้อมูล<?php echo $p_name; ?></h5>
							<div class="f-right">
								<label for="MENU_STATUS" class="custom-control custom-checkbox">
									<input type="checkbox" name="MENU_STATUS" id="MENU_STATUS" class="custom-control-input" value="Y" <?php echo $rec['MENU_STATUS'] == "Y" ? 'checked' :''; ?>>
									<span class="custom-control-indicator"></span>
									<span class="custom-control-description">เปิดใช้งาน</span>
								</label>
							</div>
						</div>
						<div class="card-block">
							<!---->
							<div class="form-group row">
								<div class="col-md-3">
									<label for="MENU_ORDER" class="form-control-label wf-right">ลำดับ
										<span class="text-danger">*</span></label>
								</div>
								<div class="col-md-1">
									<input type="text" id="MENU_ORDER" name="MENU_ORDER" placeholder="ลำดับ" class="form-control" value="<?php echo $mx; ?>" required>
								</div>
							</div>
							<!---->
							<div class="form-group row">
								<div class="col-md-3">
									<label for="MENU_NAME" class="form-control-label wf-right">ชื่อ<?php echo $p_name; ?>
										<span class="text-danger">*</span></label>
								</div>
								<div class="col-md-9">
									<input type="text" id="MENU_NAME" name="MENU_NAME" placeholder="ตั้งชื่อ <?php echo $p_name; ?>" class="form-control" value="<?php echo $rec['MENU_NAME']; ?>" required>
								</div>
							</div>
							<!---->
							<div class="form-group row">
								<div class="col-md-3">
									<label for="MENU_ICON" class="form-control-label wf-right">ICON</label>
								</div>
								<div class="col-md-9">
									<input type="text" id="MENU_ICON" name="MENU_ICON" placeholder="" class="form-control" value="<?php echo $rec['MENU_ICON']; ?>" >
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
