<?php

$WF_TYPE = $_GET['WF_TYPE'];
$txt_system_name = "Workflow Management";
$txt_system_sub = "บริหาร ";
$smart = "Flow";

$txt_type = "Workflow";
$txt_link_back = "workflow.php";
$table_alias = "WFR_";

$W = $_GET['W'];
$WFD = $_GET['WFD'];

$txt_system_sub .= $txt_type;
include("../include/comtop_admin.php");

//$txt_link_field = "workflow_step_form.php";

$sql_group = db::query("select * from WF_GROUP WHERE WF_TYPE= 'W' order by GROUP_ORDER asc");

$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."' AND WF_TYPE= 'W'");
$rec = db::fetch_array($sql);

$sql_detail = db::query("select WFD_NAME from WF_DETAIL where WFD_ID = '".$WFD."'");
$rec_detail = db::fetch_array($sql_detail);
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
							<li class="breadcrumb-item"><a href="workflow_detail.php?W=<?php echo $W; ?>">บริหารขั้นตอน</a></li>
							<li class="breadcrumb-item"><a href="#">Copy ขั้นตอน</a></li>
						</ol>
						<div class="f-right">
							<a class="btn btn-danger waves-effect waves-light" href="workflow_detail.php?W=<?php echo $W; ?>" role="button"><i class="typcn typcn-chevron-left-outline"></i> ย้อนกลับ </a>
						</div>
					</div>
				</div>
			</div>
			<form action="copy_detail_function.php" method="post" enctype="multipart/form-data" id="form_wf" autocomplete="off" >
				<input type="hidden" name="WF_TYPE" id="WF_TYPE" value="<?php echo $WF_TYPE ?>">
				<input type="hidden" name="id" id="id" value="<?php echo $W; ?>">
				<input type="hidden" name="WFD_ID" id="WFD_ID" value="<?php echo $WFD; ?>">
				<input type="hidden" name="WF_ALIAS" id="WF_ALIAS" value="<?php echo $table_alias; ?>">
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-block">
								<div class="form-group row">
									<div class="col-md-3">
										<label for="WF_MAIN_NAME" class="form-control-label wf-right">ชื่อ <?php echo $txt_type; ?></label>
									</div>
									<div class="col-md-3">
										<span class="biz-label"><?php echo $rec['WF_MAIN_NAME']; ?></span>
									</div>
									<div class="col-md-3">
										<label for="WF_MAIN_NAME" class="form-control-label wf-right">ตาราง <?php echo $txt_type; ?></label>
									</div>
									<div class="col-md-3">
										<span class="biz-label"><?php echo $rec['WF_MAIN_SHORTNAME']; ?></span>
									</div>
								</div>
								<!---->
								<div class="form-group row">
									<div class="col-md-3">
										<label for="WF_MAIN_NAME" class="form-control-label wf-right">ชื่อขั้นตอนต้นฉบับ </label>
									</div>
									<div class="col-md-3">
										<span class="biz-label"><?php echo $rec_detail['WFD_NAME']; ?></span>
									</div>
									<div class="col-md-3">
										<label for="WF_MAIN_NAME" class="form-control-label wf-right">ชื่อขั้นตอนปลายทาง <span class="text-danger">*</span></label>
									</div>
									<div class="col-md-3">
										<input type="text" class="form-control" name="WFD_DEST_NAME" id="WFD_DEST_NAME" placeholder="ชื่อขั้นตอนปลายทาง" required>
									</div>
								</div>
								<!---->
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="f-left">
							<button type="button" class="btn btn-md btn-danger active waves-effect waves-light" onclick="window.location.href='workflow_detail.php?W=<?php echo $W; ?>';"><i class="typcn typcn-chevron-left-outline"></i> ย้อนกลับ</button>
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