<?php
include '../include/comtop_admin.php';

$W = conText($_GET['W']);
$sql_data = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$R = db::fetch_array($sql_data);

$process = conText($_GET['process']);
$id = conText($_GET['FORM_QT_ID']);


$p_name = "ตั้งค่าการค้นหา";
$p_url = "workflow_search_setting";
if($process == "add")
{
	$p_process = "เพิ่ม";
	$mx = db::get_max("WF_WORKFLOW_CONFIG", "FORM_QT_ID") + 1;
}
elseif($process == "edit")
{
	$q_edit = db::query("select * from WF_WORKFLOW_CONFIG where FORM_QT_ID = '".$_GET['FORM_QT_ID']."'");
	$r_edit = db::fetch_array($q_edit);
	
	$p_process = "แก้ไข";
	$mx = $r_edit['FORM_QT_ID'];
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
						<li class="breadcrumb-item"><a href="index.php"><i class="icofont icofont-home"></i></a></li>
						<li class="breadcrumb-item"><a href="workflow.php">บริหาร Workflow</a></li>
						<li class="breadcrumb-item"><a href="<?php echo $p_url; ?>.php?W=<?php echo $R["WF_MAIN_ID"];?>"><?php echo $p_name; ?> <?php echo $R['WF_MAIN_NAME']; ?></a></li>
						<li class="breadcrumb-item">
							<a href="#"><?php echo $p_process; ?>ข้อมูล</a>
						</li>
					</ol>
					<div class="f-right">
						<a class="btn btn-danger waves-effect waves-light" href="<?php echo $p_url; ?>.php?W=<?php echo $R["WF_MAIN_ID"];?>" role="button">
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
			<input type="hidden" name="W" id="W" value="<?php echo $R['WF_MAIN_ID']; ?>">
			<input type="hidden" name="FORM_QT_ID" id="FORM_QT_ID" value="<?php echo $r_edit['FORM_QT_ID']; ?>">
			<!-- Row Starts -->
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header"><h5 class="card-header-text">
								<i class="typcn typcn-message"></i> ข้อมูล<?php echo $p_name; ?></h5>
						</div>
						<div class="card-block">
							<!---->
							<div class="form-group row">
								<div class="col-md-2">
									<label for="FORM_QT_NAME" class="form-control-label wf-right">ข้อความที่แสดง
										<span class="text-danger">*</span></label>
								</div>
								<div class="col-md-4">
									<input type="text" id="FORM_QT_NAME" name="FORM_QT_NAME" class="form-control" value="<?php echo $r_edit['FORM_QT_NAME']; ?>" required>
								</div>
								<div class="col-md-2">
									<label for="FORM_QT_FIELDNAME" class="form-control-label wf-right">ชื่อ Field ในตาราง</label>
								</div>
								<div class="col-md-4">
									<input type="text" id="FORM_QT_FIELDNAME" name="FORM_QT_FIELDNAME"  class="form-control" value="<?php echo $r_edit['FORM_QT_FIELDNAME']; ?>">
								</div>
							</div>
							<!---->
							<div class="form-group row">
								<div class="col-md-2">
									<label for="FORM_QT_OPERATOR" class="form-control-label wf-right">เงื่อนไขในการค้นหา</label>
								</div>
								<div class="col-md-4">
								<?php
									form_dropdown("FORM_QT_OPERATOR", $arr_operator, $r_edit['FORM_QT_OPERATOR']);
								?>
								</div>
								<div class="col-md-2">
									<label for="FORM_QT_SHORTNAME" class="form-control-label wf-right">ชื่อตัวแปร</label>
								</div>
								<div class="col-md-4">
									<input type="text" name="FORM_QT_SHORTNAME" id="FORM_QT_SHORTNAME" class="form-control" value="<?php echo $r_edit['FORM_QT_SHORTNAME']; ?>"/>
								</div>
							</div>
							<!---->
							<div class="form-group row">
								<div class="col-md-2">
									<label for="FORM_QT_INPUT_TYPE" class="form-control-label wf-right">ประเภทข้อมูล
										</label>
								</div>
								<div class="col-md-4">
									  <select name="FORM_QT_INPUT_TYPE" id="FORM_QT_INPUT_TYPE" class="form-control">
										<option value=""></option>
										<?php
										$q_form = db::query("SELECT * FROM form_system ORDER BY FORM_MAIN_ID ASC");
										$num_rows_input = db::num_rows($q_form);
											while($r_form = db::fetch_array($q_form)){
												?>
												<option value="<?php echo $r_form['FORM_MAIN_ID'];?>" <?php if($r_edit["FORM_QT_INPUT_TYPE"] == $r_form["FORM_MAIN_ID"]){ echo "selected";}?>><?php echo $r_form['FORM_MAIN_NAME'];?></option>
												<?php
											}
										?>
										</select>
								</div>
								<div class="col-md-2">
									<label for="FORM_QT_DETAIL" class="form-control-label wf-right">ข้อความหลัง Input</label>
								</div>
								<div class="col-md-4">
									<input type="text" name="FORM_QT_DETAIL" id="FORM_QT_DETAIL" value="<?php echo $r_edit['FORM_QT_DETAIL']; ?>" class="form-control"/>
								</div>
							</div>
							<!---->
							<div class="form-group row">
								<div class="col-md-2">
									<label for="FORM_QT_DEFAULT" class="form-control-label wf-right">Default Data</label>
								</div>
								<div class="col-md-4">
									<input type="text" name="FORM_QT_DEFAULT" id="FORM_QT_DEFAULT" value="<?php echo $r_edit['FORM_QT_DEFAULT']; ?>" class="form-control"/>
								</div>
								<div class="col-md-2">
									<label for="FORM_QT_CLASS" class="form-control-label wf-right">Class</label>
								</div>
								<div class="col-md-4">
									<select name="FORM_QT_CLASS" id="FORM_QT_CLASS" class="form-control">
										<option value=""></option>
										<?php 
										for($i=1;$i<=12;$i++){
											?>
											<option value="span<?php echo $i;?>" <?php if($r_edit['FORM_QT_CLASS'] == 'span'.$i){ echo "selected"; }?>>span<?php echo $i;?></option>
											<?php
										}
										?>
									</select>
								</div>
							</div>
							<!---->
							<div class="form-group row">
								<div class="col-md-2">
								</div>
								<div class="col-md-4">
									<label class="form-check-label form-control-label">
										<input class="form-check-input" type="checkbox"  name="FORM_QT_REQUIRED" id="FORM_QT_REQUIRED" value="Y" <?php if($r_edit['FORM_QT_REQUIRED'] == 'Y'){ echo "checked"; }?> class="form-control" />
										บังคับตอบข้อมูลนี้
									  </label>
								</div>
								<div class="col-md-2">
								</div>
								<div class="col-md-4">
									<label class="form-check-label form-control-label">
										<input class="form-check-input" type="checkbox"  name="FORM_QT_HIDDEN" id="FORM_QT_HIDDEN" value="Y" <?php if($r_edit['FORM_QT_HIDDEN'] == 'Y'){ echo "checked"; }?> class="form-control" />
										hidden
									  </label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="f-left">
						<button type="button" class="btn btn-md btn-danger active waves-effect waves-light" onclick="window.location.href='<?php echo $p_url; ?>.php?W=<?php echo $R["WF_MAIN_ID"];?>';">
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
	});
</script>

<?php include '../include/combottom_admin.php'; ?>
