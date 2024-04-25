<?php
$HIDE_HEADER = 'Y';
include '../include/comtop_admin.php';

$p_name = "กลุ่มขั้นตอน";
$p_url = "workflow_detail_group";
$W = conText($_GET['W']);

$sql = db::query("select * from WF_DETAIL_GROUP WHERE WF_MAIN_ID='".$W."' ORDER BY DETAIL_G_ORDER ASC");
?>

			<!-- Row end -->
			<form action="#!" method="post" name="wf_detail_group" id="wf_detail_group">
				<input type="hidden" name="process" id="process" value="re_order">
				<!-- Row Starts -->
				
							<div class="card-header">
								<h4 class="card-header-text">
									<i class="icofont icofont-ui-folder"></i> <?php echo 'บริหาร'.$p_name; ?>
								</h4>
								<div class="f-right">
									<!--<a class="btn btn-primary waves-effect waves-light" href="<?php echo $p_url; ?>_form.php?process=add&W=<?php echo $W;?>" role="button">
									<i class="icofont icofont-ui-add"></i> เพิ่มกลุ่มของขั้นตอน
									</a>&nbsp;-->
									
									 <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#bizModal" title="บริหารกลุ่มของขั้นตอน" onclick="open_modal('<?php echo $p_url; ?>_form.php?process=add&W=<?php echo $W;?>','บริหารกลุ่มของขั้นตอน');"><i class="fa fa-plus-circle"></i> เพิ่มกลุ่มของขั้นตอน</button>&nbsp;
	
									<button class="btn btn-warning waves-effect waves-light" role="button" onclick="save_order_group_step('<?php echo $W;?>')">
										<i class="icofont icofont-save"></i> บันทึกตำแหน่ง
									</button>
								</div>
							</div>
							<div class="card-block">
								<div class="table-responsive" data-pattern="priority-columns">
									<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
										<thead>
											<tr class="bg-primary">
												<th style="width: 15%;" class="text-center" data-priority="2">Order</th>
												<th style="width: 45%;" class="text-center" data-priority="1">ชื่อกลุ่ม</th><th style="width: 10%;" class="text-center" data-priority="4">จำนวนวัน</th>
												<th style="width: 10%;" class="text-center" data-priority="4">Weight</th>
												<th style="width: 20%;" class="text-center" data-priority="3">Tools</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$i=1;
											while($rec = db::fetch_array($sql))
											{
											?>
											<tr class="wf_keyword-box" id="tr_<?php echo $rec['DETAIL_G_ID'];?>">
												<td class="text-center move-td">
													<input type="number" id="DETAIL_G_ORDER<?php echo $i; ?>" name="DETAIL_G_ORDER<?php echo $i; ?>" value="<?php echo $rec['DETAIL_G_ORDER']; ?>" class="form-control input-success text-right" style="width:80px;">
												</td>
												<td class="wf_keyword"><?php echo $rec["DETAIL_G_NAME"];?></td>
												<td class="text-center">
													<input type="text" name="DETAIL_G_NUMDAY<?php echo $i; ?>" id="DETAIL_G_NUMDAY<?php echo $i; ?>" class="form-control text-right" value="<?php echo $rec['DETAIL_G_NUMDAY']; ?>">
												</td>
												<td class="text-center">
													<input type="text" name="DETAIL_G_WEIGHT<?php echo $i; ?>" id="DETAIL_G_WEIGHT<?php echo $i; ?>" class="form-control text-right" value="<?php echo $rec['DETAIL_G_WEIGHT']; ?>">
												</td>
												
												<td class="text-center">
													<nobr>
														<button type="button" class="btn btn-warning btn-icon" data-toggle="modal" data-target="#bizModal" title="แก้ไข <?php echo $p_name; ?>" onclick="open_modal('<?php echo $p_url; ?>_form.php?process=edit&W=<?php echo $W;?>&id=<?php echo $rec['DETAIL_G_ID']; ?>','บริหารกลุ่มของขั้นตอน');">
															<i class="icofont icofont-edit-alt"></i>
														</button> &nbsp;
																												
														<button type="button" class="btn btn-danger btn-icon" data-toggle="tooltip" data-placement="top" title="ลบ<?php echo $p_name; ?>" onclick="delete_group_detail('<?php echo $rec['DETAIL_G_ID'];?>');">
															<i class="icofont icofont-trash"></i>
														</button>
													</nobr>
												</td>
											</tr>
											<input type="hidden" name="id<?php echo $i; ?>" id="id<?php echo $i; ?>" value="<?php echo $rec["DETAIL_G_ID"]; ?>">
											<?php $i++; } ?>
										</tbody>
									</table>
									<input type="hidden" name="group_total_row" id="group_total_row" value="<?php echo $i; ?>">
									<input type="hidden" name="W" id="W" value="<?php echo $W; ?>">
								</div>
							</div>
						
				<!-- Row end -->
			</form>
			<!-- Container-fluid ends -->

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

		function arrange_row(p_table) {

			var i = 0;
			$('.'+p_table+' tbody tr td.move-td').each(function(){
				$('.'+p_table+' tbody tr:eq('+i+') td.move-td input').val((i+1));
				i++;
			});


		}
		
		<?php if($i > 1){ ?>
		if( $('#show_wf_group_step').length )
		{
			 $('#show_wf_group_step').html('<label class="badge bg-success"><?php echo $i-1; ?></label>');
		}

	<?php }?>
			
		
		
		
	</script>
	
	
<?php include '../include/combottom_admin.php'; ?>