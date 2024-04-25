<?php
include '../include/comtop_admin.php';
?>
<link rel="stylesheet" type="text/css" href="../assets/css/sortable.css">
<div class="content-wrapper">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<div class="row" id="animationSandbox">
			<div class="col-sm-8">
				<div class="main-header">
					<h4>BPMN</h4>
					<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
						<li class="breadcrumb-item">
							<a href="index.php"><i class="icofont icofont-home"></i></a>
						</li>
						<li class="breadcrumb-item">
							<a href="#">BPMN</a>
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
					<nobr>
					<a class="btn btn-primary waves-effect waves-light" href="bpmn_form.php?process=add" role="button">
						<i class="icofont icofont-ui-add"></i> เพิ่มข้อมูล
					</a>
					</nobr>
				</div>
			</div>		
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<form method="post" id="form_wf_main" action="#" >
						<?php
						$i=1;
						$j=1;
						$sql_group = db::query("SELECT * FROM WF_GROUP WHERE WF_TYPE = 'W' ORDER BY GROUP_ORDER ASC");
						while($rec_group = db::fetch_array($sql_group)){ 
							?>
							<div class="card-header">
								<h5 class="card-header-text<?php if($rec_group['GROUP_STATUS']=="Y"){ echo " text-success"; }else{ echo " text-danger"; } ?>">
									<i class="<?php if($rec_group['GROUP_STATUS']=="Y"){ echo "fa fa-check-circle"; }else{ echo "fa fa-ban"; } ?>"></i> <?php echo $rec_group['GROUP_NAME']; ?>
								</h5>
								<div class="f-right">
									<a href="#primary" class="btn btn-warning waves-effect waves-light" onclick="save_bpmn_order();" role="button">
										<i class="icofont icofont-save"></i> บันทึกตำแหน่ง
									</a>
								</div>
							</div>
							<div class="card-block">
								<div class="table-responsive" data-pattern="priority-columns">
									<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
										<thead>
											<tr class="bg-primary">
												<td class="text-center" style="width:10%">ลำดับ</td>
												<td class="text-center" style="width:70%">หัวข้อ</td>
												<th class="text-center" style="width:20%"></th>
											</tr>
										<thead>
										<tbody>
											<?php
											$q_bpmn = db::query("SELECT * FROM WF_BPMN WHERE WF_GROUP_ID = '".$rec_group['GROUP_ID']."' ORDER BY BPMN_ORDER ASC");
											while($r_bpmn = db::fetch_array($q_bpmn)){
												?>
												<tr id="tr_<?php echo $r_bpmn['BPMN_ID'];?>" class="wf_keyword-box">
													<td class="text-center move-td">
														<input type="number" id="BPMN_ORDER<?php echo $j; ?>" name="BPMN_ORDER<?php echo $j; ?>" value="<?php echo $r_bpmn['BPMN_ORDER']; ?>" class="form-control input-success text-center" style="width:80px;">
													</td>
													<td class="wf_keyword"><?php echo $r_bpmn['BPMN_NAME'];?></td>
													<td class="text-center">
														<nobr>
															<input type="hidden" name="id<?php echo $j; ?>" id="id<?php echo $j; ?>" value="<?php echo $r_bpmn['BPMN_ID']; ?>">
															<button type="button" class="btn btn-warning btn-icon" data-toggle="modal" data-target="#bizModal" title="แก้ไข" onclick="window.location.href='bpmn_form.php?process=edit&id=<?php echo $r_bpmn['BPMN_ID']; ?>';">
																<i class="icofont icofont-edit-alt"></i>
															</button> &nbsp; 
															<button type="button" class="btn btn-primary btn-icon" data-toggle="modal" data-target="#bizModal" title="Copy" onclick="open_modal('bpmn_copy_form.php?BPMN_ID=<?php echo $r_bpmn['BPMN_ID'];?>','Copy BPMN');">
																<i class="icofont icofont-copy-alt"></i>
															</button> &nbsp; 
															
															
															
															<button type="button" class="btn btn-success btn-icon" title="Requirment" onclick="window.location.href='bpmn_requirment_form.php?BPMN_ID=<?php echo $r_bpmn['BPMN_ID'];?>';">
																<i class="fa fa-registered"></i>
															</button> &nbsp; 
															<button type="button" class="btn btn-info btn-icon" title="คำอธิบาย" onclick="window.location.href='bpmn_desc_form.php?BPMN_ID=<?php echo $r_bpmn['BPMN_ID'];?>';">
																<i class="fa fa-list-ul"></i>
															</button> &nbsp; 
															<button type="button" class="btn btn-warning btn-icon" title="Non-functional" onclick="window.location.href='bpmn_non_func_form.php?BPMN_ID=<?php echo $r_bpmn['BPMN_ID'];?>';">
																<i class="icofont icofont-social-nimbuss"></i>
															</button> &nbsp; 
															
															
															
															<button type="button" class="btn btn-danger btn-icon" data-toggle="tooltip" data-placement="top" title="ลบ" onclick="delete_bpmn('<?php echo $r_bpmn['BPMN_ID'];?>');">
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
							<?php
							$i++;
						}
						?>
						<input type="hidden" name="total_row" id="total_row" value="<?php echo $j;?>">
						<input type="hidden" name="process" id="process" value="re_order">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<form action="log_view.php" name="form_log" id="form_log" method="post" target="_blank">
	<input type="hidden" name="file_name" id="file_name" value="">
	<input type="hidden" name="process" id="process" value="">
</form>
<?php include '../include/combottom_js.php';?>
<script src='../assets/js/jquery-sortable.js'></script>
<script>
$('document').ready(function(){
	$("#search-wf_mian").on("keyup", function(){
		var g = $(this).val().toLowerCase();
		$(".wf_keyword").each(function(){
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
function arrange_row(p_table){
	var i = 0;
	$('.'+p_table+' tbody tr td.move-td').each(function(){
		$('.'+p_table+' tbody tr:eq('+i+') td.move-td input').val((i+1));
		i++;
	});
}
function save_bpmn_order(){
	var url = "bpmn_function.php";
	$.ajax({
	    type: "POST",
	    url: url,
	    data: $("#form_wf_main").serialize(),
	    success: function(html)
	    {
			if(html == 'Y')
			{
				swal({
					title: "บันทึกข้อมูลเรียบร้อยแล้ว", 
					type: "success",
					allowOutsideClick:true
				});
			}
	    }
	});
	e.preventDefault(); // avoid to execute the actual submit of the form.
}
function delete_bpmn(id){
	if(confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่ ?')){	
		var dataString = 'process=delete&id='+id;
		$.ajax({
			type: "POST",
			url: "bpmn_function.php",
			data: dataString,
			cache: false,
			success: function(html){
				$("#tr_"+id).hide();
			}
		});
	}
}
</script>
<?php 
include '../include/combottom_admin.php'; ?>