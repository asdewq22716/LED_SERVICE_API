<?php
include '../include/comtop_admin.php';
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
					<h4>MindMap</h4>
					<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
						<li class="breadcrumb-item">
							<a href="index.php"><i class="icofont icofont-home"></i></a>
						</li>
						<li class="breadcrumb-item">
							<a href="#">MindMap</a>
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
					<a class="btn btn-primary waves-effect waves-light" href="mindmap_form.php?process=add" role="button">
						<i class="icofont icofont-ui-add"></i> เพิ่มข้อมูล
					</a>
					</nobr>
				</div>
			</div>		
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-header-text">
							<i class="icofont icofont-ui-folder"></i> MindMap
						</h5>
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
									$i=1;
									$q_mindmap = db::query("SELECT * FROM WF_MINDMAP ORDER BY MINDMAP_ID ASC");
									while($r_mindmap = db::fetch_array($q_mindmap)){
										?>
										<tr id="tr_<?php echo $r_mindmap['MINDMAP_ID'];?>" class="wf_keyword-box">
											<td class="text-center"><?php echo $i;?></td>
											<td class="wf_keyword"><?php echo $r_mindmap['MINDMAP_NAME'];?></td>
											<td class="text-center">
												<nobr>
													<button type="button" class="btn btn-warning btn-icon" data-toggle="modal" data-target="#bizModal" title="แก้ไข" onclick="window.location.href='mindmap_form.php?process=edit&id=<?php echo $r_mindmap['MINDMAP_ID']; ?>';">
														<i class="icofont icofont-edit-alt"></i>
													</button> &nbsp; 
													<button type="button" class="btn btn-danger btn-icon" data-toggle="tooltip" data-placement="top" title="ลบ" onclick="delete_mindmap('<?php echo $r_mindmap['MINDMAP_ID'];?>');">
														<i class="icofont icofont-trash"></i>
													</button>
												</nobr>
											</td>
										</tr>
										<?php
										$i++;
									}
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
$('document').ready(function(){
	$("#search-wf_mian").on("keyup", function(){
		var g = $(this).val().toLowerCase();
		$(".wf_keyword").each(function(){
			var s = $(this).text().toLowerCase();
			$(this).closest('.wf_keyword-box')[s.indexOf(g) !== -1 ? 'show' : 'hide']();
		});
	});
});
function delete_mindmap(id){
	if(confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่ ?')){	
		var dataString = 'process=delete&id='+id;
		$.ajax({
			type: "POST",
			url: "mindmap_function.php",
			data: dataString,
			cache: false,
			success: function(html){
				$("#tr_"+id).hide();
			}
		});
	}
}
function show_log(url, process)
{
	$('#file_name').val(url);
	$('#process').val(process);
	$('#form_log').submit();
}
</script>
<?php include '../include/combottom_js_user.php'; 
include '../include/combottom_admin.php'; ?>