<?php

$WF_TYPE = $_GET['WF_TYPE'];
$txt_system_name = "Workflow Management";
$txt_system_sub = "บริหาร ";
$smart = "Flow";
if($WF_TYPE == "W")
{
	$txt_type = "Workflow";
	$txt_link_back = "workflow.php";
	$table_alias = "WFR_";
}
elseif($WF_TYPE == "F")
{
	$txt_type = "Form";
	$txt_link_back = "form.php";
	$table_alias = "FRM_";
}
elseif($WF_TYPE == "M")
{
	$txt_type = "Master";
	$txt_link_back = "master.php";
	$table_alias = "M_";
}
$txt_system_sub .= $txt_type;
include("../include/comtop_admin.php");

//$txt_link_field = "workflow_step_form.php";

$sql_group = db::query("select * from WF_GROUP WHERE WF_TYPE= '".$WF_TYPE."' order by GROUP_ORDER asc");

$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."' AND WF_TYPE= '".$WF_TYPE."'");
$rec = db::fetch_array($sql);
if($rec["WF_MAIN_ID"] != "")
{
	?>
	<div class="content-wrapper">
		<!-- Container-fluid starts -->
		<div class="container-fluid">
			<div class="row"  id="animationSandbox">
				<div class="col-sm-12">
					<div class="main-header">
						<h4><?php echo $rec['WF_MAIN_NAME']; ?></h4>
						<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
							<li class="breadcrumb-item"><a href="index.php"><i class="icofont icofont-home"></i></a></li>
							<li class="breadcrumb-item"><a href="<?php echo $txt_link_back; ?>"><?php echo $txt_system_sub; ?></a></li>
							<li class="breadcrumb-item"><a href="#">Copy <?php echo $txt_type; ?></a></li>
						</ol>
						<div class="f-right">
							<a class="btn btn-danger waves-effect waves-light" href="<?php echo $txt_link_back; ?>" role="button"><i class="typcn typcn-chevron-left-outline"></i> ย้อนกลับ </a>
						</div>
					</div>
				</div>
			</div>
			<form action="copy_function.php" method="post" enctype="multipart/form-data" id="form_wf" autocomplete="off" onsubmit="return save_pos('data_position');">
				<input type="hidden" name="WF_TYPE" id="WF_TYPE" value="<?php echo $WF_TYPE ?>">
				<input type="hidden" name="id" id="id" value="<?php echo $W; ?>">
				<input type="hidden" name="WF_ALIAS" id="WF_ALIAS" value="<?php echo $table_alias; ?>">
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-block">
								<div class="form-group row">
									<div class="col-md-3">
										<label for="WF_MAIN_NAME" class="form-control-label wf-right">ชื่อ <?php echo $txt_type; ?> ต้นฉบับ</label>
									</div>
									<div class="col-md-3">
										<span class="biz-label"><?php echo $rec['WF_MAIN_NAME']; ?></span>
									</div>
									<div class="col-md-3">
										<label for="WF_MAIN_NAME" class="form-control-label wf-right">ตาราง <?php echo $txt_type; ?> ต้นฉบับ</label>
									</div>
									<div class="col-md-3">
										<span class="biz-label"><?php echo $rec['WF_MAIN_SHORTNAME']; ?></span>
									</div>
								</div>
								<!---->
								<div class="form-group row">
									<div class="col-md-3">
										<label for="WF_MAIN_NAME" class="form-control-label wf-right">ชื่อ <?php echo $txt_type; ?> ปลายทาง <span class="text-danger">*</span></label>
									</div>
									<div class="col-md-3">
										<input type="text" class="form-control" name="WF_DEST_NAME" id="WF_DEST_NAME" placeholder="ชื่อ <?php echo $txt_type; ?> ปลายทาง" required>
									</div>
									<div class="col-md-3">
										<label for="WF_MAIN_NAME" class="form-control-label wf-right">ตาราง <?php echo $txt_type; ?> ปลายทาง <span class="text-danger">*</span></label>
									</div>
									<div class="col-md-3">
										<div class="input-group">
											<span class="input-group-addon"><?php echo $table_alias; ?></span>
											<input type="text" name="WF_MAIN_SHORTNAME" id="WF_MAIN_SHORTNAME" class="form-control text-uppercase" placeholder="TABLE NAME"  autocomplete="off" maxlength="22" required>
										</div>
										<small class="text-muted">** ระบุได้เฉพาะ A-Z, 0-9 และ Underscore (_) **</small>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="f-left">
							<button type="button" class="btn btn-md btn-danger active waves-effect waves-light" onclick="window.location.href='workflow.php';"><i class="typcn typcn-chevron-left-outline"></i> ย้อนกลับ</button>
						</div>
						<div class="wf-right">&nbsp;
							<button type="submit" class="btn btn-md btn-success active waves-effect waves-light"><i class="icofont icofont-tick-mark"></i> บันทึก</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php
}
?>