<?php
$HIDE_HEADER = 'Y';
include '../include/comtop_admin.php';

$p_name = "กลุ่ม Kanban";
$p_url = "workflow_kanban";
$W = conText($_GET['W']);
?>
<link rel="stylesheet" type="text/css" href="../assets/css/sortable.css">
<form action="#!" method="post" name="wf_kanban_group" id="wf_kanban_group">
	<div class="card-header">
		<h4 class="card-header-text">
			<i class="icofont icofont-ui-folder"></i> ตั้งค่าการดึงข้อมูลลง Kanban
		</h4>
		<div class="f-right">
			<button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#bizModal" title="เพิ่มข้อมูล" onclick="open_modal('<?php echo $p_url; ?>_form.php?process=add&W=<?php echo $W;?>','เพิ่มกลุ่ม Kanban');"><i class="fa fa-plus-circle"></i> เพิ่มกลุ่ม</button>&nbsp;
			<!--<button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#bizModal" title="เพิ่มข้อมูล" onclick="open_modal('<?php echo $p_url; ?>_list_form.php?process=add&W=<?php echo $W;?>','เพิ่มรายการ Kanban');"><i class="fa fa-plus-circle"></i> เพิ่มรายการ Kanban</button>&nbsp;-->
			<a href="#primary" class="btn btn-warning waves-effect waves-light" onclick="save_order_kan_group('<?php echo $W;?>')" role="button">
				<i class="icofont icofont-save"></i> บันทึกตำแหน่ง
			</a>
		</div>
	</div>
	<div class="card-block">
		<div class="table-responsive" data-pattern="priority-columns">
			<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
				<thead>
					<tr class="bg-primary">
						<th style="width: 10%;" class="text-center" >ลำดับ</th>
						<th style="width: 45%;" class="text-center">ชื่อกลุ่ม</th>
						<th style="width: 15%;" class="text-center">สถานะ</th>
						<th style="width: 15%;" class="text-center">Tools</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=1;
					$sql = db::query("SELECT * FROM WF_KANBAN_GROUP WHERE WF_MAIN_ID = '".$W."' ORDER BY K_ORDER ASC");
					while($rec = db::fetch_array($sql)){
						$sql_k_list = db::query("SELECT * FROM WF_KANBAN_LIST WHERE K_ID = '".$rec['K_ID']."' ORDER BY K_LIST_ID DESC");
						$rows_k_list = db::num_rows($sql_k_list);
						?>
						<tr id="tr_<?php echo $rec['K_ID'];?>"> 
							<td class="text-center move-td">
								<input type="number" id="K_ORDER<?php echo $i; ?>" name="K_ORDER<?php echo $i; ?>" value="<?php echo $rec['K_ORDER']; ?>" class="form-control input-success text-right" style="width:80px;">
							</td>
							<td class="wf_keyword"><?php echo $rec["K_NAME"];?></td>
							<td style="text-align:center;"><?php if($rec["K_STATUS"] == 'Y'){ echo "ใช้งาน"; }else{ echo "ไม่ใช้งาน"; }?></td>
							<td class="text-center">
								<nobr>
									<input type="hidden" name="id<?php echo $i; ?>" id="id<?php echo $i; ?>" value="<?php echo $rec["K_ID"]; ?>">
									<button type="button" class="btn btn-info btn-icon" data-toggle="modal" data-target="#bizModal" title="เพิ่มรายการ Kanban" onclick="open_modal('<?php echo $p_url; ?>_list_form.php?process=add&W=<?php echo $W;?>&k_id=<?php echo $rec['K_ID']; ?>','เพิ่มรายการ Kanban');">
										<i class="typcn typcn-plus"></i>
									</button> &nbsp; 
									<button type="button" class="btn btn-warning btn-icon" data-toggle="modal" data-target="#bizModal" title="แก้ไข<?php echo $p_name; ?>" onclick="open_modal('<?php echo $p_url; ?>_form.php?process=edit&W=<?php echo $W;?>&id=<?php echo $rec['K_ID']; ?>','แก้ไขกลุ่ม Kanban');">
										<i class="icofont icofont-edit-alt"></i>
									</button> &nbsp; 
									<?php if($rows_k_list == 0){ ?>
									<button type="button" class="btn btn-danger btn-icon" data-toggle="tooltip" data-placement="top" title="ลบ<?php echo $p_name; ?>" onclick="delete_kan('<?php echo $rec['K_ID'];?>');">
										<i class="icofont icofont-trash"></i>
									</button>
									<?php } ?>
								</nobr>
							</td>
						</tr>
						<?php 
						$i++; 
						
						
						while($rec_k_list = db::fetch_array($sql_k_list)){
							?>
							<tr id="tr_k_list_<?php echo $rec_k_list['K_LIST_ID'];?>">
								<td>&nbsp;</td>
								<td style="text-align:left;">&nbsp;&nbsp;&nbsp;-&nbsp;<?php echo $rec_k_list['KAN_LIST_NAME'];?></td>
								<td>&nbsp;</td>
								<td class="text-center">
									<nobr>
										<button type="button" class="btn btn-warning btn-icon" data-toggle="modal" data-target="#bizModal" title="แก้ไขรายการ Kanban" onclick="open_modal('<?php echo $p_url; ?>_list_form.php?process=edit&W=<?php echo $W;?>&id=<?php echo $rec_k_list['K_LIST_ID']; ?>&k_id=<?php echo $rec_k_list['K_ID'];?>','แก้ไขรายการ Kanban');">
											<i class="icofont icofont-edit-alt"></i>
										</button> &nbsp; 
										<button type="button" class="btn btn-danger btn-icon" data-toggle="tooltip" data-placement="top" title="ลบรายการ Kanban" onclick="delete_kan_list('<?php echo $rec_k_list['K_LIST_ID'];?>');">
											<i class="icofont icofont-trash"></i>
										</button>
									</nobr>
								</td>
							</tr>
							<?php
						}
					}
					?>
				</tbody>
			</table>
			<input type="hidden" name="group_total_row" id="group_total_row" value="<?php echo $i; ?>">
			<input type="hidden" name="process" id="process" value="re_order">
			<input type="hidden" name="W" id="W" value="<?php echo $W; ?>">
		</div>
	</div>
</form>
<?php include '../include/combottom_js.php'; ?>
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
<?php include '../include/combottom_admin.php'; ?>