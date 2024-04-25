<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$W = conText($_GET['W_ID']);
$WF_VIEW_ID = conText($_GET['VIEW']);
?>  
<div class="row" id="animationSandbox">
	<div class="col-sm-12 f-right">
		<div class="f-right">
		
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
	<form name="form1" id="form_add_dep" method="post" action="workflow_setting_function_add.php" >

					<div class="table-responsive" data-pattern="priority-columns">
						<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
							<thead>
							<tr class="bg-primary">
								<th class="text-center">View</th>
								<th class="text-center" width="20%"></th>
							</tr>
							</thead>
							<tbody>
								<tr class="wf_modal_keyword-box">
									<td><a href="../process/workflow_edit.php?W=<?php echo $W; ?>"><i class="fa fa-toggle-<?php if($WF_VIEW_ID ==""){ echo "on  text-success"; }else{ echo "off"; } ?>"></i> Default</a></td>
									<td class="text-center"><a class="btn btn-primary waves-effect waves-light btn-mini" href="#addview" onClick="create_v('<?php echo $W; ?>','');" role="button">
										<i class="icofont icofont-ui-add"></i> เพิ่ม View ใหม่
									</a></td>
								</tr> 
								<?php
								$sql_d = db::query("SELECT * FROM WF_MAIN_VIEW WHERE WF_MAIN_ID = '".$W."'");
								while($rec_d = db::fetch_array($sql_d)){
									
								?>
									<tr id="v_<?php echo $rec_d["WF_VIEW_ID"]; ?>" class="wf_modal_keyword-box">
										<td class="wf_keyword"><a href="../process/workflow_edit.php?W=<?php echo $W; ?>&VIEW=<?php echo $rec_d["WF_VIEW_ID"]; ?>"><i class="fa fa-toggle-<?php if($WF_VIEW_ID ==$rec_d["WF_VIEW_ID"]){ echo "on  text-success"; }else{ echo "off"; } ?>"></i> <?php echo $rec_d["WF_MAIN_NAME"]; ?></td>
										<td class="text-center"><a class="btn btn-primary waves-effect waves-light btn-mini" href="#addview" onClick="create_v('<?php echo $W; ?>','<?php echo $rec_d["WF_VIEW_ID"]; ?>');" role="button">
										<i class="icofont icofont-copy-alt"></i> Copy</a>
										<a class="btn btn-danger waves-effect waves-light btn-mini" href="#delview" onClick="del_v('<?php echo $W; ?>','<?php echo $rec_d["WF_VIEW_ID"]; ?>');" role="button">
										<i class="icofont icofont-trash"></i> Delete</a>
										</td>
									</tr>
								<?php $i++;} ?>
							</tbody>
						</table>
					</div>

	</form>
	</div>
</div>
<script>
function create_v(w,v){
if(confirm('คุณต้องการสร้าง View ใหม่หรือไม่?')){
    var url = "workflow_setting_newview.php"; // the script where you handle the form input.
	var dataString = 'Flag=Add&W='+w+'&VIEW='+v;

    $.ajax({
           type: "POST",
           url: url,
           data: dataString,
           success: function(data)
           {
               window.location.href= "workflow_edit.php?W=<?php echo $W; ?>&VIEW="+data;
           }
         });
}
}
function del_v(w,v){
if(confirm('คุณต้องการลบ View หรือไม่?')){
    var url = "workflow_setting_newview.php"; // the script where you handle the form input.
	var dataString = 'Flag=Del&W='+w+'&VIEW='+v;

    $.ajax({
           type: "POST",
           url: url,
           data: dataString,
           success: function(data)
           {
			   if(v == '<?php echo $WF_VIEW_ID; ?>'){
               window.location.href= "workflow_edit.php?W=<?php echo $W; ?>";
			   }else{
				   $('#v_'+v).remove();
			   }
           }
         });
}
}
</script>
<?php
db::db_close();
?>