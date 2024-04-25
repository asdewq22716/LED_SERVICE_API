<?php

include '../include/comtop_admin.php';
$dir = "../log_process/";

?>
<style>
.card-header{
	border-bottom:0;
}
</style>

<div class="content-wrapper">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<div class="row" id="animationSandbox">
			<div class="col-sm-8">
				<div class="main-header">
					<h4>Log Process</h4>
					<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
						<li class="breadcrumb-item">
							<a href="index.php"><i class="icofont icofont-home"></i></a>
						</li>
						<li class="breadcrumb-item">
							<a href="<?php echo $p_url; ?>_list.php">Log Process</a>
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
							<i class="icofont icofont-ui-folder"></i> Log Process
						</h5>
					</div>
					<div class="card-block">
						<div class="table-responsive" data-pattern="priority-columns">
							<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
								<thead>
									<tr class="bg-primary">
										<td class="text-center" style="width:20%">ลำดับ</td>
										<td style="width:80%">ไฟล์</td>
									</tr>
								<thead>
								<tbody>
									<?php
									$file_name = array();
									if (is_dir($dir)) {
										if ($dh = opendir($dir)) {
											$i=1;
											while(false !== ($file = readdir($dh)))
											{
												if($file == '.' || $file == '..')
												{
													continue;
												}
												else
												{
													array_push($file_name, $file);
												}
												$i++;
											}
											closedir($dh);
										}
									}

									rsort($file_name);
									$i=1;
									foreach($file_name as $_val)
									{?>
										<tr>
											<td class="text-center"><?php echo $i;?></td>
											<td><a href="javascript:void(0);" onclick="show_log('<?php echo $dir.$_val;?>', 'Log Process')"><?php echo $_val;?></a></td>
										</tr>
										<?php
									$i++; }
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<form action="log_view.php" name="form_log" id="form_log" method="post" target="_blank">
	<input type="hidden" name="file_name" id="file_name" value="">
	<input type="hidden" name="process" id="process" value="">
</form>

<script>
	function show_log(url, process)
	{
		$('#file_name').val(url);
		$('#process').val(process);
		$('#form_log').submit();
	}
</script>
<?php include '../include/combottom_js_user.php'; 
include '../include/combottom_admin.php'; ?>