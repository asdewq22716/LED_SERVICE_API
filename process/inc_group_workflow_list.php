<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$process = conText($_GET['process']);
$id = conText($_GET['G']);
$WF_TYPE = conText($_GET['WF_TYPE']);

if($id != ""){
	?>
	<!-- select2 css -->
	<link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css" />
	<link rel="stylesheet" type="text/css" href="../assets/css/sortable.css">
	
	<form action="#" name="form_wf_group" id="form_wf_group" method="post" enctype="multipart/form-data">
		<input type="hidden" name="GROUP_ID" id="GROUP_ID" value="<?php echo $id; ?>">
		<!-- Row Starts -->
		<div class="card">
			<!-- Row Starts -->
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<!--<h5 class="card-header-text<?php if($r_group['GROUP_STATUS']=="Y"){ echo " text-success"; }else{ echo " text-danger"; } ?>">
								<i class="<?php if($r_group['GROUP_STATUS']=="Y"){ echo "fa fa-check-circle"; }else{ echo "fa fa-ban"; } ?>"></i> <?php echo $r_group['GROUP_NAME']; ?>
							</h5>-->
							<div class="f-right">
								<a href="#btnaddwf" id="group_create_f" class="btn btn-success btn-mini" onclick="group_create_more();" role="button">
									<i class="icofont icofont-ui-add"></i> เพิ่ม Workflow
								</a>
								<a href="#primary" class="btn btn-warning btn-mini waves-effect waves-light" onclick="save_wf_order();" role="button">
									<i class="icofont icofont-save"></i> บันทึกตำแหน่ง
								</a>
							</div>
						</div>
						<div class="card-block">
							<div class="table-responsive" data-pattern="priority-columns">
								<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
									<thead>
										<tr class="bg-primary">
											<th class="text-center" data-priority="2" style="width:10%">ลำดับ</th>
											<th class="text-center" data-priority="1" style="width:10%">ใช้งาน</th>
											<th class="text-center" data-priority="1" style="width:50%">ชื่อ</th>
											<th class="text-center" data-priority="3"></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$j=1;
										$sql_main = db::query("SELECT * FROM WF_MAIN WHERE WF_GROUP_ID = '".$id."' AND WF_TYPE = '".$WF_TYPE."' ORDER BY WF_MAIN_ORDER ASC"); 
										while($rec_main = db::fetch_array($sql_main)){
											?>
											<tr class="wf_keyword-box" id="tr_main<?php echo $rec_main['WF_MAIN_ID'];?>">
												<td class="text-center move-td">
													<input type="number" id="WF_MAIN_ORDER<?php echo $j; ?>" name="WF_MAIN_ORDER<?php echo $j; ?>" value="<?php echo $rec_main['WF_MAIN_ORDER']; ?>" class="form-control input-success text-right" style="width:80px;">
												</td>
												<th class="text-center">
													<div class="rkmd-checkbox checkbox-rotate checkbox-ripple">
														<label class="input-checkbox checkbox-success">
															<input type="checkbox" name="WF_MAIN_STATUS<?php echo $j; ?>" id="WF_MAIN_STATUS<?php echo $j; ?>" <?php echo $rec_main['WF_MAIN_STATUS'] == "Y" ? 'checked' :''; ?> value="Y">
															<span class="checkbox"></span>
														</label>
														<div class="captions"></div>
													</div>
												</th>
												<th class="wf_keyword">
													<?php echo $rec_main['WF_MAIN_NAME']; ?>
													<small class="form-text">
														<label class="label label-md bg-success">ID : <?php echo $rec_main['WF_MAIN_ID']; ?></label>
														<?php
														if($rec_main['WF_MAIN_TYPE'] == "W")
														{
															echo $rec_main['WF_MAIN_SHORTNAME'];
														}
														elseif($rec_main['WF_MAIN_TYPE'] == "L")
														{
															echo $rec_main['WF_MAIN_URL'];
														}
														?>
													</small>
												</th>
												<td class="text-center">
													<nobr>
														<input type="hidden" name="id<?php echo $j; ?>" id="id<?php echo $j; ?>" value="<?php echo $rec_main['WF_MAIN_ID']; ?>">
														<button type="button" class="btn btn-warning btn-mini" data-toggle="tooltip"  title="แก้ไข <?php echo $s_system_name[$WF_TYPE];?>" onclick="window.location.href='workflow_edit.php?W=<?php echo $rec_main['WF_MAIN_ID']; ?>'">
															<i class="icofont icofont-edit-alt"></i>
														</button> &nbsp;
														<?php if($WF_TYPE == "W"){ ?>
														<button type="button" class="btn btn-success btn-mini" data-toggle="tooltip"  title="เพิ่ม/แก้ไข Step" onclick="window.location.href='workflow_detail.php?W=<?php echo $rec_main['WF_MAIN_ID']; ?>'">
															<i class="icofont icofont-settings"></i>
														</button> &nbsp;
														<?php }elseif($WF_TYPE != "R"){ ?>
														<button type="button" class="btn btn-success btn-mini" data-toggle="tooltip"  title="ตั้งค่า Field" onclick="window.location.href='<?php echo $txt_link_field; ?>?W=<?php echo $rec_main['WF_MAIN_ID']; ?>&WFD=0'">
															<i class="icofont icofont-settings"></i>
														</button> &nbsp;
														<?php } ?>
														<?php if($WF_TYPE == "R" AND $rec_main['WF_MAIN_TYPE'] == "D"){ ?>
														<button type="button" onclick="window.location.href='report_setting.php?W=<?php echo $rec_main['WF_MAIN_ID']; ?>';" class="btn btn-success btn-mini" data-toggle="tooltip"  title="บริหาร Dashboard" role="button">
															<i class="icofont icofont-chart-bar-graph"></i>
														</button> &nbsp;
														<?php } ?>
														<?php if($WF_TYPE == "M"){ ?>
														<button type="button" onclick="window.open('master_main.php?W=<?php echo $rec_main['WF_MAIN_ID']; ?>','','');" class="btn btn-primary btn-mini" data-toggle="tooltip"  title="บริหารข้อมูล" role="button">
															<i class="fa fa-table"></i>
														</button> &nbsp;
														<?php } ?>
														<button type="button" class="btn btn-info btn-mini" data-toggle="tooltip"  title="ตั้งค่าการค้นหา" onclick="window.location.href='search_step_form.php?W=<?php echo $rec_main['WF_MAIN_ID']; ?>&WFD=0'">
															<i class="icofont icofont-search-alt-2"></i>
														</button> &nbsp;
														<button type="button" class="btn btn-primary btn-mini" data-toggle="tooltip"  title="Copy <?php echo $s_system_name[$WF_TYPE];?>" onclick="window.location.href='copy_workflow.php?W=<?php echo $rec_main['WF_MAIN_ID']; ?>&WF_TYPE=<?php echo $WF_TYPE; ?>';">
															<i class="icofont icofont-copy-alt"></i>
														</button> &nbsp;
														<button type="button" class="btn btn-danger btn-mini" data-toggle="tooltip"  title="ลบ" onclick="deleteWorkflow('<?php echo $rec_main['WF_MAIN_ID']; ?>','<?php echo $rec_main['WF_MAIN_TYPE']; ?>')">
															<i class="icofont icofont-trash"></i>
														</button>
													</nobr>
												</td>
											</tr>
											<?php 
											$j++;
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<input type="hidden" name="total_row" id="total_row" value="<?php echo $j;?>">
			<input type="hidden" name="Flag" id="Flag" value="re_order">
			<!-- Row end -->
		</div>
	</form> 
	<?php
	include '../include/combottom_js.php';	
}
?>
<script src='../assets/js/jquery-sortable.js'></script>
<!-- Sweetalert js -->
<script src="../assets/plugins/sweetalert/js/sweetalert.js"></script>
<script>
$(document).ready(function(){
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
	
	$('select.select2').select2({ 
		allowClear: true,
		placeholder: function(){
			$(this).data('placeholder');
		}
	});
	
	$(".dasboard-4-table-scroll").slimScroll({
		height: 220,
		size: '10px',
		allowPageScroll: true,
		wheelStep:5,
		color: '#000'
	});
});
		
function arrange_row(p_table){
	var i = 0;
	$('.'+p_table+' tbody tr td.move-td').each(function(){
		$('.'+p_table+' tbody tr:eq('+i+') td.move-td input').val((i+1));
		i++;
	});
}
		
function deleteWorkflow(id, type)
{
	var dataString = '';
	if(confirm('คุณต้องการลบ Workflow ใช่หรือไม่'))
	{
		if(type === "W")
		{
			if(confirm('คุณต้องการ Drop Table ด้วยใช่หรือไม่'))
			{
				dataString = 'process=delete&drop=Y&id='+id;
			}
			else
			{
				dataString = 'process=delete&drop=N&id='+id;
			}
		}else{
			dataString = 'process=delete&drop=N&id='+id;
		}
		
		$.ajax({
			type: "GET",
			url: "workflow_del_function.php",
			data: dataString,
			cache: false,
			success: function(html){
				$("#tr_main"+id).hide();
			}
		});
	}
}
</script>
<?php include '../include/combottom_admin.php'; ?>