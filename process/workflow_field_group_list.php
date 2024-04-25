<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$p_name = "กลุ่มของฟิลด์";
$p_url = "workflow_field_group";
$W = conText($_GET['W']);
$WFD = conText($_GET['WFD']);
$WF_TYPE = conText($_GET['WF_TYPE']);

if($WF_TYPE == 'W'){
  $wh = " AND WF_TYPE='W' ";
  
}elseif($WF_TYPE == 'F'){
  $wh = " AND WF_TYPE='F' ";
  
}elseif($WF_TYPE == 'M'){
  $wh = " AND WF_TYPE='M' ";
  
}


$sql = db::query("select * from WF_FIELD_GROUP WHERE WF_MAIN_ID='".$W."' AND WFD_ID='".$WFD."'".$wh." ORDER BY FIELD_G_ORDER ASC");
?>
<style>
	.move-td{
		cursor: move;
	}
</style>

<form action="<?php echo $p_url; ?>_function.php" method="post" id="form_field_group">
	<input type="hidden" name="process" id="process" value="re_order">
	<!-- Row Starts -->
	<div class="card-header">
		<h5 class="card-header-text">
			<i class="fa fa-object-group"></i> กลุ่มของ Field
		</h5>
		<div class="f-right">
      <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#bizModal" title="บริหารกลุ่มฟิลด์" onclick="open_modal('<?php echo $p_url.'_form.php'; ?>?process=add&WF_TYPE=<?php echo $WF_TYPE ;?>&W=<?php echo $W; ?>&WFD=<?php echo $WFD; ?>','บริหารกลุ่มฟิลด์');"><i class="fa fa-plus-circle"></i> เพิ่มกลุ่ม</button>&nbsp;
			<button type="button" class="btn btn-warning waves-effect waves-light" onclick="save_field_group('<?php echo $WFD;?>')" >
				<i class="fa fa-save"></i> บันทึกตำแหน่ง
			</button>
		</div>
	</div>
	<div class="card-block">
		<div class="table-responsive" data-pattern="priority-columns">
			<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
				<thead>
					<tr class="bg-primary">
						<th style="width: 15%;" class="text-center" data-priority="3">ลำดับ</th>
						<th style="width: 50%;" class="text-center" data-priority="1">ชื่อกลุ่ม</th>
						<th style="width: 35%;" class="text-center" data-priority="3">Tools</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=1;
					while($rec = db::fetch_array($sql))
					{
					?>
					<tr class="wf_keyword-box" id="tr_g<?php echo $rec['FIELD_G_ID'];?>">
						<td class="text-center move-td">
							<input type="number" id="FIELD_G_ORDER<?php echo $i; ?>" name="FIELD_G_ORDER<?php echo $i; ?>" value="<?php echo $rec['FIELD_G_ORDER']; ?>" class="form-control input-success text-right" style="width:80px;">
						</td>
						<td class="wf_keyword"><?php echo $rec["FIELD_G_NAME"];?></td>
						<td class="text-center">
							<nobr>
								<button type="button" class="btn btn-warning btn-icon" data-toggle="modal" data-target="#bizModal" title="แก้ไข <?php echo $p_name; ?>" onclick="open_modal('<?php echo $p_url.'_form.php'; ?>?process=edit&S_TYPE=<?php echo $_GET["S_TYPE"];?>&W=<?php echo $W; ?>&WFD=<?php echo $WFD; ?>&WF_TYPE=<?php echo $WF_TYPE ;?>&id=<?php echo $rec['FIELD_G_ID']; ?>','แก้ไข <?php echo $p_name; ?>');" target="_blank">
									<i class="icofont icofont-edit-alt"></i>
								</button> &nbsp;
								<?php
								$sql_n = db::query("SELECT COUNT(WFS_ID) AS FIELD_NUM FROM WF_STEP_FORM WHERE WF_MAIN_ID = '".$_GET['W']."' AND WFD_ID = '".$_GET['WFD']."' AND FIELD_G_ID = '".$rec['FIELD_G_ID']."'");
										$data_n = db::fetch_array($sql_n);
									if($data_n['FIELD_NUM'] <= 0){
								
								?>
								<button type="button" class="btn btn-danger btn-icon" data-toggle="tooltip" data-placement="top" title="ลบ <?php echo $p_name; ?>" onclick="delete_group_field('<?php echo $rec['FIELD_G_ID'];?>');">
									<i class="icofont icofont-trash"></i>
								</button>
								<?php } ?>
							</nobr>
						</td>
					</tr>
					<input type="hidden" name="id<?php echo $i; ?>" id="id<?php echo $i; ?>" value="<?php echo $rec["FIELD_G_ID"]; ?>">
					<?php $i++; } ?>
				</tbody>
			</table>
			<input type="hidden" name="total_group" id="total_group" value="<?php echo $i; ?>">
			<input type="hidden" name="W" id="W" value="<?php echo $W; ?>">
			<input type="hidden" name="WFD" id="WFD" value="<?php echo $WFD; ?>">
		</div>
	</div>	
	<!-- Row end -->
</form>
<!-- Container-fluid ends -->
<?php if($i > 1){ ?>
<script>

	if( $('#wf_group_field_show').length )
	{
		 $('#wf_group_field_show').html('<label class="badge bg-success"><?php echo $i-1; ?></label>');
	}


</script>
<?php } 
db::db_close();
?>