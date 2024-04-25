<?php

include '../include/comtop_admin.php';
$dir = "../log_process/";

if($_POST['file_name'] != "")
{
	$filename = $_POST['file_name'];
	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	fclose($handle);
}


?>
	<style>
		.card-header{
			border-bottom: 0;
		}
		.form-control:disabled, .form-control[readonly] {
			background-color: #000;
			color:green;
			font-size:13px;
			opacity: 1;
		}
	</style>
	<div class="content-wrapper">
		<!-- Container-fluid starts -->
		<div class="container-fluid">
			<div class="row" id="animationSandbox">
				<div class="col-sm-8">
					<div class="main-header">
						<h4><?php echo $_POST['process']; ?></h4>
						<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
							<li class="breadcrumb-item">
								<a href="index.php"><i class="icofont icofont-home"></i></a>
							</li>
							<li class="breadcrumb-item">
								<a href="<?php echo $p_url; ?>_list.php"><?php echo $_POST['process']; ?></a>
							</li>
						</ol>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-header-text">
								<i class="icofont icofont-ui-folder"></i> <?php echo $_POST['process']; ?>
							</h5>
						</div>
						<div class="card-block">
							<div class="form-group">
								<div class="col-md-12">
									<textarea name="log" id="log" class="form-control" rows="30" style="min-height: 900px;" readonly><?php echo $contents; ?></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include '../include/combottom_admin.php'; ?>