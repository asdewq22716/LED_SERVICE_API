<?php
$WF_TYPE = "W";
include '../include/comtop_admin.php';
$W = conText($_GET['W']);
$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec = db::fetch_array($sql);

$sql_detail = db::query("select * from WF_DETAIL where WF_MAIN_ID = '".$W."' order by WFD_ORDER");

?>
	<link rel="stylesheet" type="text/css" href="../assets/css/sortable.css">

	<style>
		.move-td{
			cursor: move;
		}
	</style>
    <div class="content-wrapper">
        <!-- Container-fluid starts -->
        <div class="container-fluid" >
		<!-- Row Starts -->
		<div class="row"  id="animationSandbox">
			<div class="col-sm-8">
				<div class="main-header">
					<h4><?php echo $rec['WF_MAIN_NAME']; ?></h4>
						<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
							<li class="breadcrumb-item"><a href="index.php"><i class="icofont icofont-home"></i></a></li>
							<li class="breadcrumb-item"><a href="workflow.php">บริหาร Workflow</a></li>
							<li class="breadcrumb-item"><a href="workflow.php">บริหารขั้นตอน</a></li>
						</ol>
				</div>
			</div>
			<div class="col-sm-4">
				
						<div class="md-group-add-on col-sm-12">
							 <span class="md-add-on">
								<i class="icofont icofont-search-alt-2 chat-search"></i>
							 </span>
							<div class="md-input-wrapper">
								<input type="text" class="md-form-control"  name="wf_search" id="search-wf_mian">
								<label for="username">ค้นหา</label>
							</div>
							
						</div>
				<div class="f-right">
						<!--<a class="btn btn-primary waves-effect waves-light" href="workflow_detail_form.php?process=add&W=<?php echo $W; ?>" role="button"><i class="icofont icofont-ui-add"></i> เพิ่มขั้นตอน </a> &nbsp;-->
						<a class="btn btn-success waves-effect waves-light" href="workflow_edit.php?W=<?php echo $W; ?>" role="button"><i class="icofont icofont-ui-edit"></i> แก้ไข Workflow </a> &nbsp;
						<a class="btn btn-danger waves-effect waves-light" href="workflow.php" role="button"><i class="typcn typcn-chevron-left-outline"></i> ย้อนกลับ </a>
				</div>
			</div>
		</div>
		<!-- Row end -->
        

		<div class="row">
			<div class="col-lg-12">
				<div class="card">
				<div class="card-block tab-icon">
				<ul class="nav nav-tabs md-tabs " role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#wfstep" role="tab"><i class="fa fa-retweet"></i> บริหารขั้นตอน</a>
						<div class="slide"></div>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#wf_group_step" role="tab"><i class="fa fa-object-group"></i> กลุ่มของขั้นตอน <span id="show_wf_group_step"></span></a>
						<div class="slide"></div>
					</li>
					
				</ul> 
				
				
				<div class="tab-content">
					<div class="row tab-pane active" id="wfstep" role="tabpanel">
					<form action="workflow_detail_function.php" method="post"  id="form_wf">
						<input type="hidden" name="process" id="process" value="re_order">
						<input type="hidden" name="W" id="W" value="<?php echo $W; ?>">
						<!-- Row Starts -->
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h6 class="card-header-text">
										<i class="ion-unlocked"></i>
										<div class="btn-group" role="group"> 
										
										  <button type="button" class="btn btn-success active btn-mini waves-effect waves-light" data-toggle="modal" data-target="#bizModal" title="ตั้งค่าสิทธิ์รายบุคคล" onclick="open_modal('workflow_setting_add_department.php?ACCESS_TYPE=WFM&ACESS_REF_ID=<?php echo $rec["WF_MAIN_ID"]; ?>&USR_TYPE=U','ตั้งค่าสิทธิ์รายบุคคล');"><i class="ion-person"></i></button>
										  <button type="button" class="btn btn-primary active btn-mini waves-effect waves-light" data-toggle="modal" data-target="#bizModal" title="ตั้งค่าสิทธิ์ตามหน่วยงาน" onclick="open_modal('workflow_setting_add_department.php?ACCESS_TYPE=WFM&ACESS_REF_ID=<?php echo $rec["WF_MAIN_ID"]; ?>&USR_TYPE=D','ตั้งค่าสิทธิ์ตามหน่วยงาน');"><i class="ion-home"></i></button>
										  <button type="button" class="btn btn-warning active btn-mini waves-effect waves-light" data-toggle="modal" data-target="#bizModal" title="ตั้งค่าสิทธิ์ตามตำแหน่ง" onclick="open_modal('workflow_setting_add_department.php?ACCESS_TYPE=WFM&ACESS_REF_ID=<?php echo $rec["WF_MAIN_ID"]; ?>&USR_TYPE=P','ตั้งค่าสิทธิ์ตามตำแหน่ง');"><i class="ion-briefcase"></i></button>
										  <button type="button" class="btn btn-danger active btn-mini waves-effect waves-light" data-toggle="modal" data-target="#bizModal" title="ตั้งค่าสิทธิ์ตามกลุ่ม" onclick="open_modal('workflow_setting_add_department.php?ACCESS_TYPE=WFM&ACESS_REF_ID=<?php echo $rec["WF_MAIN_ID"]; ?>&USR_TYPE=G','ตั้งค่าสิทธิ์ตามกลุ่ม');"><i class="ion-person-stalker"></i></button>
										</div>
										
									</h6>
									<div class="f-right">
										<a class="btn btn-primary waves-effect waves-light" href="#" data-toggle="modal" data-target="#bizModal" onClick="open_modal('workflow_detail_form_m.php?process=add&W=<?php echo $W; ?>','เพิ่มขั้นตอน');" role="button"><i class="icofont icofont-ui-add"></i> เพิ่มขั้นตอน</a>
										<!--<a class="btn btn-primary waves-effect waves-light" href="workflow_detail_form.php?process=add&W=<?php echo $W; ?>" role="button"><i class="icofont icofont-ui-add"></i> เพิ่มขั้นตอน </a> -->&nbsp;
										<button class="btn btn-warning waves-effect waves-light" >
												<i class="icofont icofont-save"></i> บันทึกตำแหน่ง
										</button> &nbsp;
										<a class="btn btn-info waves-effect waves-light" href="flowchart2.php?W=<?php echo $rec["WF_MAIN_ID"];?>" role="button" target="_blank">
												<i class="fa fa-sitemap"></i> Flow Chart </a> &nbsp;
										<a class="btn btn-info waves-effect waves-light" href="swimlane2.php?W=<?php echo $rec["WF_MAIN_ID"];?>" role="button" target="_blank">
												<i class="icofont icofont-chart-flow-alt-2"></i> Chart </a> &nbsp;
										<a class="btn btn-info waves-effect waves-light" href="er.php?W=<?php echo $rec["WF_MAIN_ID"];?>" role="button" target="_blank">
												<i class="fa fa-table"></i>  ER 
										</a> &nbsp;
										<a class="btn btn-info waves-effect waves-light" href="#!" onclick="PopupCenter('export_flow_image.php?W=<?php echo $W;?>','Preview', (window.innerWidth-60), (window.innerHeight-100));">Load Interface 
										</a> &nbsp;
										<a class="btn btn-info waves-effect waves-light" href="prototype.php?W=<?php echo $rec["WF_MAIN_ID"];?>" role="button" target="_blank">Prototype  
										</a>
									</div>
								</div> 
								<div class="card-block">
									<div class="form-group row">
									  <div class="col-md-12">
										<div id="show_permission_<?php echo $rec["WF_MAIN_ID"]; ?>">
											
											<script type="text/javascript">
												var dataString = 'A_TYPE=WFM&A_ID=<?php echo $rec["WF_MAIN_ID"]; ?>';
												$.ajax({
												 type: "GET",
												 url: "workflow_setting_view_department.php",
												 data: dataString,
												 cache: false,
												 success: function(html){
												  $("#show_permission_<?php echo $rec["WF_MAIN_ID"]; ?>").html(html);
												 }
												 });

											</script>
										 </div>
									  </div>
									</div>
									<div class="table-responsive" data-pattern="priority-columns">
										<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
											<thead>
											<tr class="bg-primary">
												<th class="text-center" style="width:5%">ลำดับ</th>
												<th class="text-center" style="width:30%">ขั้นตอน</th>
												<th class="text-center" style="width:30%">ขั้นตอนถัดไป</th>
												<th class="text-center" style="width:20%">สิทธิ์</th>
												<th class="text-center" >Tools</th>
											</tr>
											</thead>
											<tbody>
												<?php
												$i=1;
												$m_icon_auto_submit = '<span data-toggle="tooltip" data-placement="top" title="Auto Submit" class="label bg-warning"><i class="zmdi zmdi-flash-auto"></i></span>';
												$m_icon_tab = '<span data-toggle="tooltip" data-placement="top" title="ใช้งาน Tab ในหน้า form" class="label bg-warning"><i class="zmdi zmdi-tab"></i></span>';
												$m_icon_previous = '<span data-toggle="tooltip" data-placement="top" title="แสดงขั้นตอนนี้ในหน้ารายละเอียดย้อนหลัง" class="label bg-warning"><i class="zmdi zmdi-window-restore"></i></span>';
												$m_icon_continue = '<span data-toggle="tooltip" data-placement="top" title="หลังจากบันทึก ไปขั้นตอนถัดไปทันที" class="label bg-warning"><i class="zmdi zmdi-redo"></i></span>';
												while($rec_detail = db::fetch_array($sql_detail))
												{
													$icon_type = "";
													if($rec_detail['WFD_TYPE'] == "S")
													{
														$icon_type = '<i class="ion-location"></i>';
													}
													elseif($rec_detail['WFD_TYPE'] == "P")
													{
														$icon_type = '<i class="ion-arrow-down-a"></i>';
													}
													elseif($rec_detail['WFD_TYPE'] == "M")
													{
														$icon_type = '<i class="ion-share"></i>';
													}
													elseif($rec_detail['WFD_TYPE'] == "T")
													{
														$icon_type = '<i class="ion-forward"></i>';
													}
													elseif($rec_detail['WFD_TYPE'] == "E")
													{
														$icon_type = '<i class="ion-checkmark-round"></i>';
													}

													$icon_continue = $rec_detail['WFD_CONTINUE_NEXT_STEP'] == "Y" ? $m_icon_continue : '';
													$icon_auto_submit = $rec_detail['WFD_AUTO_SUBMIT'] == "Y" ? $m_icon_auto_submit : '';
													$icon_tab = $rec_detail['WFD_TAB_STATUS'] == "Y" ? $m_icon_tab : '';
													$icon_previous = $rec_detail['WFD_VIEW_PREVIOUS_STEP'] == "Y" ? $m_icon_previous : '';
													
													
													$sql_g = db::query("SELECT * FROM WF_DETAIL_GROUP WHERE DETAIL_G_ID='".$rec_detail["DETAIL_G_ID"]."'");
													$rec_group = db::fetch_array($sql_g);
													$group = ($rec_group["DETAIL_G_NAME"] != '')?'('.'กลุ่ม'.''.$rec_group["DETAIL_G_NAME"].')<br>':'';
													
												?>
												<tr class="wf_keyword-box" id="TR_WFS<?php echo $rec_detail['WFD_ID']; ?>">
													<td class="text-center move-td">
														<input type="number" class="form-control input-success text-right" name="WFD_ORDER<?php echo $i; ?>" id="WFD_ORDER<?php echo $i; ?>" style="width:60px;" value="<?php echo $rec_detail['WFD_ORDER']; ?>">
														
													</td>
													<td class="wf_keyword">
														<input type="hidden" name="id<?php echo $i; ?>" id="id<?php echo $i; ?>" value="<?php echo $rec_detail['WFD_ID']; ?>">
														<a href="#!" onClick="PopupCenter('workflow_step_preview.php?W=<?php echo $W; ?>&WFD=<?php echo $rec_detail['WFD_ID']; ?>', 'Preview', (window.innerWidth-60), window.innerHeight) ;"  data-toggle="tooltip" data-placement="top" title="ดูหน้าจอ" class="label bg-primary">
															 <?php echo $icon_type." ".$rec_detail['WFD_ID']; ?>
														</a>
														<?php echo $rec_detail['WFD_NAME']."<br />".$group.$icon_continue.$icon_previous.$icon_auto_submit.$icon_tab; ?>
													</td>
													<td>
														<div id="show_step_condition<?php echo $rec_detail['WFD_ID']; ?>">
															<script type="text/javascript">
																
																var dataString = 'W=<?php echo $W;?>&WFD=<?php echo $rec_detail['WFD_ID'];?>';
																$.ajax({
																 type: "GET",
																 url: "workflow_step_con.php",
																 data: dataString,
																 cache: false,
																 success: function(html){
																	
																  $("#show_step_condition<?php echo $rec_detail['WFD_ID']; ?>").html(html);
																 }
																 });

															</script>
														</div>
													</td>
													<td>
														<div class="btn-group" role="group">
															<button type="button" class="btn btn-success active btn-mini waves-effect waves-light" data-toggle="modal" data-target="#bizModal"  title="ตั้งค่าสิทธิ์รายบุคคล" onclick="open_modal('workflow_setting_add_department.php?ACCESS_TYPE=DET&ACESS_REF_ID=<?php echo $rec_detail['WFD_ID']; ?>&USR_TYPE=U','ตั้งค่าสิทธิ์รายบุคคล');">
																<i class="ion-person"></i></button>
															<button type="button" class="btn btn-primary active btn-mini waves-effect waves-light" data-toggle="modal" data-target="#bizModal"title="ตั้งค่าสิทธิ์ตามหน่วยงาน" onclick="open_modal('workflow_setting_add_department.php?ACCESS_TYPE=DET&ACESS_REF_ID=<?php echo $rec_detail['WFD_ID']; ?>&USR_TYPE=D','ตั้งค่าสิทธิ์ตามหน่วยงาน');">
																<i class="ion-home"></i></button>
															<button type="button" class="btn btn-warning active btn-mini waves-effect waves-light" data-toggle="modal" data-target="#bizModal" title="ตั้งค่าสิทธิ์ตามตำแหน่ง" onclick="open_modal('workflow_setting_add_department.php?ACCESS_TYPE=DET&ACESS_REF_ID=<?php echo $rec_detail['WFD_ID']; ?>&USR_TYPE=P','ตั้งค่าสิทธิ์ตามตำแหน่ง');">
																<i class="ion-briefcase"></i></button>
															<button type="button" class="btn btn-danger active btn-mini waves-effect waves-light" data-toggle="modal" data-target="#bizModal" title="ตั้งค่าสิทธิ์ตามกลุ่ม" onclick="open_modal('workflow_setting_add_department.php?ACCESS_TYPE=DET&ACESS_REF_ID=<?php echo $rec_detail['WFD_ID']; ?>&USR_TYPE=G','ตั้งค่าสิทธิ์ตามกลุ่ม');">
																<i class="ion-person-stalker"></i></button>
														</div>
														
														
														<blockquote class="blockquote" id="show_permission_d<?php echo $rec_detail['WFD_ID']; ?>">
															<p class="m-b-0">
																<script type="text/javascript">
																	var dataString = 'A_TYPE=DET&A_ID=<?php echo $rec_detail['WFD_ID']; ?>';
																	$.ajax({
																	 type: "GET",
																	 url: "workflow_setting_view_department.php",
																	 data: dataString,
																	 cache: false,
																	 success: function(html){
																		
																	  $("#show_permission_d<?php echo $rec_detail['WFD_ID']; ?>").html(html);
																	 }
																	 });

																</script>
															</p>
														</blockquote>
														<!--<blockquote class="blockquote">
															<p class="m-b-0">
																<label class="badge bg-success">
																	<i class="ion-person"></i> นายธวัชมี่
																</label>
																<label class="badge bg-primary"><i class="ion-home"></i> AC
																</label>
																<label class="badge bg-warning">
																	<i class="ion-briefcase"></i> หัวหน้า
																</label>
																<label class="badge bg-danger">
																	<i class="ion-person-stalker"></i> Admin
																</label>
															</p>
														</blockquote>-->
														
													</td>
													<td class="text-center">
														<nobr>
															<button type="button" class="btn btn-warning btn-icon" title="แก้ไขขั้นตอน"  data-toggle="modal" data-target="#bizModal" onClick="open_modal('workflow_detail_form_m.php?process=edit&W=<?php echo $W; ?>&WFD=<?php echo $rec_detail['WFD_ID']; ?>','แก้ไขขั้นตอน');" >
																<i class="icofont icofont-edit-alt"></i>
															</button> &nbsp;
															<button type="button" class="btn btn-success btn-icon" data-toggle="tooltip" data-placement="top" title="ตั้งค่า Field" onclick="window.location.href='workflow_step_form.php?W=<?php echo $W; ?>&WFD=<?php echo $rec_detail['WFD_ID']; ?>'">
																<i class="typcn typcn-th-list"></i>
															</button> &nbsp;
															<button type="button" class="btn btn-primary btn-icon" data-toggle="tooltip" data-placement="top" title="Copy ขั้นตอน" onclick="window.location.href='copy_detail.php?W=<?php echo $W; ?>&WFD=<?php echo $rec_detail['WFD_ID']; ?>'">
																<i class="icofont icofont-copy-alt"></i>
															</button> &nbsp;
															<button type="button" class="btn btn-danger btn-icon" data-toggle="tooltip" data-placement="top" title="ลบขั้นตอน" onclick="deleteWFD('<?php echo $rec_detail['WFD_ID']; ?>');">
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
					</div>
					<!-- Row Starts -->
					<div class="row tab-pane" id="wf_group_step" role="tabpanel">
						<div class="col-md-12">
							<div id="group_step_list">
								<script type="text/javascript">
									var dataString = 'W=<?php echo $W;?>';
									$.ajax({
									 type: "GET",
									 url: "workflow_detail_group_list.php",
									 data: dataString,
									 cache: false,
									 success: function(html){
										
									  $("#group_step_list").html(html);
									  
									 }
									 });

								</script>
							</div>	
						</div>
					</div>
					<!-- Row end -->
					
					</div>
				</div>
				</div>
			</div>
			</div>
			

        <!-- Container-fluid ends -->
     </div>
</div>

<?php include '../include/combottom_js.php'; ?>
	<script src='../assets/js/jquery-sortable.js'></script>

<script>
$(document).ready(function() {
    $("#search-wf_mian").on("keyup", function() {

        var g = $(this).val().toLowerCase();
        $(".wf_keyword").each(function() {

            var s = $(this).text().toLowerCase();
            $(this).closest('.wf_keyword-box')[ s.indexOf(g) !== -1 ? 'show' : 'hide' ]();
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

function deleteWFD(id)
{
	if(confirm('คุณต้องการลบ Workflow ใช่หรือไม่'))
	{
		var dataString = 'process=delete&WFD='+id;
		$.ajax({
		 type: "GET",
		 url: "workflow_detail_function.php",
		 data: dataString,
		 cache: false,
		 success: function(html){
			$("#TR_WFS"+id).hide();
		 }
		 });
	}
}
function save_step(wfd){
	var url = "workflow_step_change_function.php"; // the script where you handle the form input.

	$.ajax({
		   type: "POST",
		   url: url,
		   data: $("#form_step_change").serialize(), // serializes the form's elements.
		   success: function(data)
		   {
				var dataString = 'W=<?php echo $W;?>&WFD='+wfd;
				$.ajax({
				 type: "GET",
				 url: "workflow_step_con.php",
				 data: dataString,
				 cache: false,
				 success: function(html){
				  $("#show_step_condition"+wfd).html(html);
				  $('#bizModal').modal('hide');
				 }
				 });
				 
		   }
		 });

	e.preventDefault(); // avoid to execute the actual submit of the form.
}

function select_all(){
	var i;
	var num_rows = $('#num_i').val();
	
	$("#check_all").change(function() {
		if(this.checked) {
			for(i=1;i<num_rows;i++){
		
				$('#access_check'+i).prop('checked', true);
			}
		}else{
			
			for(i=1;i<num_rows;i++){
				
				$('#access_check'+i).prop('checked', false);
			}
		}
	});
	
}	

function delete_group_detail(id){
	
	if(confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่ ?')){	
		
		var dataString = 'process=delete&W=<?php echo $W;?>&id='+id;
		$.ajax({
		 type: "POST",
		 url: "workflow_detail_group_function.php",
		 data: dataString,
		 cache: false,
		 success: function(html){
				
			$("#tr_"+id).hide();
			var total_rows = ($('#group_total_row').val()-1);
			$('#group_total_row').val(total_rows);
			var total_all = ($('#group_total_row').val()-1);
			if(total_all > 0){
				$('#show_wf_group_step').html('<label class="badge bg-success">'+total_all+'</label>');
			}else{
				
				$('#show_wf_group_step').html('');
			}
		 }
		 });

	}
	
}

function save_order_group_step(wfd){
	var url = "workflow_detail_group_function.php"; 

	$.ajax({
		   type: "POST",
		   url: url,
		   data: $("#wf_detail_group").serialize(),
		   success: function(data)
		   {
				if(data == 'Y'){
					
					swal({
						  title: "บันทึกตำแหน่งเรียบร้อยแล้ว", 
						  type: "success",
						  allowOutsideClick:true
						});
					
				}			 
		   }
		 });

	e.preventDefault(); // avoid to execute the actual submit of the form. 
}
	

	
</script>
<?php include '../include/combottom_admin.php'; ?>