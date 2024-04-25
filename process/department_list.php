<?php
include '../include/comtop_admin.php';

$p_name = "หน่วยงาน";
$p_url = "department";

$sql = db::query("select * from USR_DEPARTMENT ORDER BY DEP_ORDER ASC");
?>
<style>
	.move-td{
		cursor: move;
	}
</style>
	<!-- Range slider css -->
	<link rel="stylesheet" type="text/css" href="../assets/css/sortable.css">
	<div class="content-wrapper">
		<!-- Container-fluid starts -->
		<div class="container-fluid">
			<!-- Row Starts -->
			<div class="row" id="animationSandbox">
				<div class="col-sm-8">
					<div class="main-header">
						<h4><?php echo $p_name; ?></h4>
						<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
							<li class="breadcrumb-item">
								<a href="index.php"><i class="icofont icofont-home"></i></a>
							</li>
							<li class="breadcrumb-item">
								<a href="<?php echo $p_url; ?>_list.php">บริหารข้อมูล</a>
							</li>
						</ol>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="md-group-add-on col-sm-12">
							 <span class="md-add-on">
								<i class="icofont icofont-search-alt-2 chat-search"></i>
							 </span>
						<div class="md-input-wrapper">
							<input type="text" class="md-form-control" name="wf_search" id="search-wf_mian">
							<label for="username">ค้นหา</label>
						</div>
					</div>
					<div class="f-right">
						<a class="btn btn-primary waves-effect waves-light" href="<?php echo $p_url; ?>_form.php?process=add" role="button">
							<i class="icofont icofont-ui-add"></i> เพิ่มข้อมูล
						</a>
					</div>
				</div>
			</div>
			<!-- Row end -->
			<form action="<?php echo $p_url; ?>_function.php" method="post" enctype="multipart/form-data" id="form_wf">
				<input type="hidden" name="process" id="process" value="re_order">
				<!-- Row Starts -->
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h5 class="card-header-text">
									<i class="icofont icofont-ui-folder"></i> <?php echo $p_name; ?>
								</h5>
								<div class="f-right">
									<button class="btn btn-warning waves-effect waves-light" role="button">
										<i class="icofont icofont-save"></i> บันทึกตำแหน่ง
									</button>
								</div>
							</div>
							<div class="card-block">
								<div class="table-responsive" data-pattern="priority-columns">
									<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
										<thead>
											<tr class="bg-primary">
												<th style="width: 10%;" class="text-center" data-priority="1">Active</th>
												<th style="width: 10%;" class="text-center" data-priority="1">รหัส</th>
												<th style="width: 60%;" class="text-center" data-priority="1">ชื่อหน่วยงาน</th>
												<th style="width: 60%;" class="text-center" data-priority="1">ชื่อย่อ</th>
												<th style="width: 20%;" class="text-center" data-priority="2">Order</th>
												<th style="width: 20%;" class="text-center" data-priority="3">Tools</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$i=1;
											while($rec = db::fetch_array($sql))
											{
											?>
											<tr class="wf_keyword-box">
												<th class="text-center">
													<div class="rkmd-checkbox checkbox-rotate checkbox-ripple">
														<label class="input-checkbox checkbox-success">
															<input type="checkbox" name="DEP_STATUS<?php echo $i; ?>" id="DEP_STATUS<?php echo $i; ?>" <?php echo $rec['DEP_STATUS'] == "Y" ? 'checked' :''; ?> value="Y">
															<span class="checkbox"></span>
														</label>
														<div class="captions"></div>
													</div>
													<input type="hidden" name="id<?php echo $i; ?>" id="id<?php echo $i; ?>" value="<?php echo $rec['DEP_ID']; ?>">
												</th>
												<th class="wf_keyword">
													<?php echo $rec['DEP_CODE']; ?>
												</th>
												<th class="wf_keyword">
													<?php echo $rec['DEP_NAME']; ?>
												</th>
												<th class="wf_keyword">
													<?php echo $rec['DEP_SHORT_NAME']; ?>
												</th>
												<td class="text-center move-td">
													<input type="number" id="DEP_ORDER<?php echo $i; ?>" name="DEP_ORDER<?php echo $i; ?>" value="<?php echo $rec['DEP_ORDER']; ?>" class="form-control input-success text-right" style="width:80px;">
												</td>
												<td class="text-center">
													<nobr>
														<button type="button" class="btn btn-warning btn-icon" data-toggle="tooltip" data-placement="top" title="แก้ไข <?php echo $p_name; ?>" onclick="window.location.href='<?php echo $p_url; ?>_form.php?process=edit&D=<?php echo $rec['DEP_ID']; ?>';">
															<i class="icofont icofont-edit-alt"></i>
														</button> &nbsp;
														<button type="button" class="btn btn-danger btn-icon" data-toggle="tooltip" data-placement="top" title="ลบ <?php echo $p_name; ?>" onclick="if(confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่ ?')){window.location.href='<?php echo $p_url; ?>_function.php?process=delete&id=<?php echo $rec['DEP_ID']; ?>';}">
															<i class="icofont icofont-trash"></i>
														</button>
													</nobr>
												</td>
											</tr>
											<?php $i++; } ?>
										</tbody>
									</table>
									<input type="hidden" name="total_row" id="total_row" value="<?php echo $i; ?>">
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Row end -->
			</form>
			<!-- Container-fluid ends -->
		</div>
	</div>
<?php include '../include/combottom_js.php'; ?>
	<script src='../assets/js/jquery-sortable.js'></script>

	<script>
		$(document).ready(function()
		{
			$("#search-wf_mian").on("keyup", function()
			{

				var g = $(this).val().toLowerCase();
				$(".wf_keyword").each(function()
				{

					var s = $(this).text().toLowerCase();
					$(this).closest('.wf_keyword-box')[s.indexOf(g) !== -1 ? 'show' : 'hide']();
				});
			});

			// Sortable rows
			$('.sorted_table').sortable({
				containerSelector: 'table',
				itemPath: '> tbody',
				itemSelector: 'tr',
				handle: '.move-td',
				placeholder: '<tr class="placeholder"/>',
				onDrop: function($item, container, _super){
					_super($item, container);
					arrange_row('sorted_table');
				}
			});

		});

		function arrange_row(p_table)
		{
			var i = 0;
			$('.'+p_table+' tbody tr td.move-td').each(function(){
				$('.'+p_table+' tbody tr:eq('+i+') td.move-td input').val((i+1));
				i++;
			});
		}
	</script>
<?php include '../include/combottom_admin.php'; ?>