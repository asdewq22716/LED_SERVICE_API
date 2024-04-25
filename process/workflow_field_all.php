<?php
include '../include/comtop_admin.php';

$W = conText($_GET['W']);

$sql_data = db::query("SELECT WF_MAIN_NAME,WF_MAIN_SHORTNAME,WF_TYPE,WF_FIELD_PK FROM WF_MAIN WHERE WF_MAIN_ID = '".$W."' ");
$rec = db::fetch_array($sql_data);

$WF_ARR_FIELD = db::show_field($rec["WF_MAIN_SHORTNAME"]);


$sql_sf = db::query("select WFS_ID,FORM_MAIN_ID,WFS_FIELD_NAME,WFS_REQUIRED,WFS_CODING_FORM,WFS_CODING_SAVE,WFS_CODING_VIEW,WFS_CHECK_DUP,WFS_HIDDEN_FORM,WFS_HIDDEN_VIEW,WFS_READONLY from WF_STEP_FORM where WF_MAIN_ID = '".$W."' ORDER BY WFS_ORDER");

$arr_u = array();
if($rec["WF_TYPE"] == 'W'){
	$arr_u = array('WFR_ID','WFR_TIMESTAMP','WF_DET_STEP','WF_DET_NEXT','WFR_UID','WFR_STATUS','WFR_REF');

}elseif($rec["WF_TYPE"] == 'M'){
	$arr_u = array($rec["WF_FIELD_PK"]);
}elseif($rec["WF_TYPE"] == 'F'){
	$arr_u = array('F_ID','WF_MAIN_ID','WFD_ID','WFR_ID','WFS_ID','F_TEMP_ID','F_CREATE_DATE','F_CREATE_BY','F_UPDATE_DATE','F_UPDATE_BY');
}

//$table_field = db::show_field($rec["WF_MAIN_SHORTNAME"]);
$field_not_del = array_intersect($arr_u,$WF_ARR_FIELD);

?>
<div class="content-wrapper">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<div class="row" id="animationSandbox">
			<div class="col-sm-12">
				<div class="main-header">
					<h4><?php echo $rec['WF_MAIN_NAME'].' ('.$rec['WF_MAIN_SHORTNAME'].')'; ?></h4>
					<ol class="breadcrumb breadcrumb-title breadcrumb-arrow"></ol>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
                <div class="card">
					<div class="card-block">
					<table cellspacing="0" id="tech-companies-1" class="table table-bordered table-striped sorted_table">
						<thead>
							<tr class="bg-primary">
								<th class="text-center" style="width:12%">ข้อความที่แสดง</th>
								<th class="text-center" style="width:10%">ชื่อ Field ในตาราง</th>
								<th class="text-center" style="width:10%">ประเภท (ขนาด) ของ Field</th>
								<th class="text-center" style="width:10%"></th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($WF_ARR_FIELD as $key => $value){
									$length = '';
									$step_form = select_field($rec["WF_MAIN_SHORTNAME"], $value);
									?>
									<tr class="wf_keyword-box" id="H_<?php echo $value;?>">
										<td><?php echo $step_form["FIELD_COMMENT"];?></td>
										<td>
										<span id="field_setting_<?php echo $value;?>"><a href="#!" data-toggle="modal" data-target="#bizModal" title="แก้ไข Field" onclick="open_modal('setting_step_edit_field.php?W=<?php echo $W;?>&WFS=&FIELD=<?php echo $value; ?>&OBJ_HTML=field_setting_<?php echo $value;?>&SETTING_FIELD=Y','แก้ไข Field');">

										<?php
										if($step_form["FIELD_NAME"] != ''){
											echo $step_form["FIELD_NAME"];
										}else{
											if($value != ''){?>
											<code><?php echo $value;?></code>
											<?php }}?></a><span></td>
										<td><span id="LENGTH_<?php echo $value;?>"><?php 
										$length = ($step_form["FIELD_LENGTH"] != '')?' ('.$step_form["FIELD_LENGTH"].')':'';
										
										
										if(($step_form["FIELD_LENGTH"] > 0) AND ($step_form["FIELD_LENGTH"] <= 5)){
											echo '<code>'.$step_form["FIELD_TYPE"].$length.'</code>';
										}else{
											echo $step_form["FIELD_TYPE"].$length;
										}?></span></td>
										<td class="text-center">
										<?php //if($step_form["FIELD_COMMENT"] != ''){
											if(!in_array($step_form["FIELD_NAME"],$field_not_del)){
											?>
											<button type="button" class="btn btn-danger btn-icon" onclick="deleteSetting_WFS('<?php echo $rec["WF_MAIN_SHORTNAME"];?>','<?php echo $step_form["FIELD_NAME"];?>');" title="ลบ Field">
												<i class="icofont icofont-trash"></i></button>
										<?php }?>
										</td>
									</tr>
								<?php 
									//}
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
<script>  
  function deleteSetting_WFS(table,f_name){
		
		if(confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่ ?')){
			var dataString = '';
			if(confirm('คุณต้องการ Drop Field '+f_name+' ด้วยใช่หรือไม่'))
			{
				dataString = 'process=DELETE_FIELD&W=<?php echo $W;?>&TABLE_NAME='+table+'&FIELD_NAME='+f_name+'&drop_field=Y';
			}
			else
			{
				dataString = 'process=DELETE_FIELD&W=<?php echo $W;?>&TABLE_NAME='+table+'&FIELD_NAME='+f_name;
			}
			
			$.ajax({
			 type: "GET",
			 url: "setting_edit_field_function.php",
			 data: dataString,
			 cache: false,
			 success: function(html){
				if(html=="."){
					$("#H_"+f_name).hide();
					$('#bizModal').modal('hide');
					swal({
						  title: "ลบ Field เรียบร้อยแล้ว", 
						  type: "success",
						  allowOutsideClick:true
						});

				 
				 }else{
					$("#show_error1").show();
					$("#text_error").html(data);
				 }
				
				
			 }
			 });
		}
	}
</script>
<?php 
include '../include/combottom_js.php';
include "inc_js_step_form.php";
include '../include/combottom_admin.php'; ?>