<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$W = conText($_GET['W']);
$WFD = conText($_GET['WFD']);

$_system_type = "workflow"; 
$_url_function = "workflow_setting_doc_list_function.php";
$_url_add = "workflow_setting_doc_add.php";
?>

	<!-- Row Starts -->

	<form action="<?php echo $_url_function;?>" method="post" id="form_doc_list">
				<div class="card-header">
					<h5 class="card-header-text">
						<i class="fa fa-link"></i> เอกสารประกอบ
					</h5>
					<div class="f-right">
						<button type="button" class="btn btn-primary waves-effect waves-light" onclick="window.location.href='<?php echo $_url_add; ?>?process=add&W=<?php echo $W; ?>&WFD=<?php echo $WFD; ?>'">
							<i class="fa fa-plus-circle"></i> เพิ่มเอกสาร
						</button> &nbsp;
						<button type="button" class="btn btn-warning waves-effect waves-light" onclick="save_doc('<?php echo $WFD;?>')" >
							<i class="fa fa-save"></i> บันทึกตำแหน่ง
						</button>
					</div>
				</div>
				<div class="card-block">
					<div class="form-group row">
						<div class="col-md-12">
						<div class="table-responsive" data-pattern="priority-columns">
							<table id="tech-companies-1" class="table table-bordered sorted_table">
								<thead>
									<tr class="bg-primary">
										<th style="width: 15%;" class="text-center" data-priority="3">Order</th>
										<th style="width: 10%;" class="text-center" data-priority="4">Active</th>
										<th style="width: 55%;" class="text-center" data-priority="1">ชื่อเอกสาร</th>
										
										<th style="width: 20%;" class="text-center" data-priority="2">Tools</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i=1;
									$query_doc = db::query("SELECT * FROM DOC_MAIN WHERE WFD_ID = '".$WFD."'  AND WF_MAIN_ID = '".$W."' ORDER BY DOC_SORT ASC");
									while($rec_doc = db::fetch_array($query_doc))
										{
										$icon = "";
										$title = "";
										$type = '';
										if($rec_doc["DOC_TYPE"] == 'W'){
											$icon = "class=\"fa fa-file-word-o\"";
											$title = "class=\"label bg-primary\"";
											$type = 'Smart Word';
										}elseif($rec_doc["DOC_TYPE"] == 'L'){
											$icon = "class=\"fa fa-file-code-o\"";
											$title = "class=\"label bg-success\"";
											$type = 'Smart Link';
										}elseif($rec_doc["DOC_TYPE"] == 'D'){
											$icon = "class=\"fa fa-file-pdf-o\"";
											$title = "class=\"label bg-danger\"";
											$type = 'Smart Download';
										}else{
											$icon = "";
											$title = "";
											$type = '';
										}
										
									?>
										<tr id="tr_<?php echo $rec_doc["DOC_ID"];?>">
											<td class="text-center move-td">
												<input type="number" name="DOC_SORT<?php echo $i;?>" id="DOC_SORT<?php echo $i;?>" class="form-control input-success text-right" style="width:80px;" value="<?php echo $rec_doc["DOC_SORT"];?>">
											</td>
											<th class="text-center">
												<div class="rkmd-checkbox checkbox-rotate checkbox-ripple">
													<label class="input-checkbox checkbox-success">
														<input type="checkbox" name="DOC_STATUS<?php echo $i;?>" id="DOC_STATUS<?php echo $i;?>" value="Y" <?php if($rec_doc["DOC_STATUS"] == 'Y'){ echo 'checked';}?>>
														<span class="checkbox"></span>
													</label>
													<div class="captions"></div>
												</div>
											</th>
											<th>
												
												<a href="../doc/<?php echo $rec_doc["DOC_FILE"];?>" target="_blank" data-toggle="tooltip" data-placement="top" title="" <?php echo $title;?> data-original-title="<?php echo $type;?>">
													<i <?php echo $icon;?>></i></a>
												<?php echo $rec_doc["DOC_TITLE"]?>
											</th>
											
											<td class="text-center">
												<nobr>
													<button type="button" class="btn btn-warning btn-icon" data-toggle="tooltip" data-placement="top" title="แก้ไข <?php echo $p_name; ?>" onclick="window.location.href='workflow_setting_doc_var.php?W=<?php echo $W;?>&DOC_ID=<?php echo $rec_doc['DOC_ID']; ?>';">
														<i class="icofont icofont-edit-alt"></i>
													</button> &nbsp;
													<button type="button" class="btn btn-danger btn-icon" data-toggle="tooltip" data-placement="top" title="ลบ <?php echo $rec_doc["DOC_TITLE"]; ?>" onclick="delete_doc('<?php echo $rec_doc["DOC_ID"];?>');">
														<i class="icofont icofont-trash"></i>
													</button>
												</nobr>
											</td>
										</tr>
										<input type="hidden" name="DOC_ID<?php echo $i;?>" id="DOC_ID<?php echo $i;?>" value="<?php echo $rec_doc['DOC_ID'];?>">
										
									
									
									<?php $i++;}?>
									
								</tbody>
							</table>
							<input type="hidden" name="total_row" id="total_row" value="<?php echo $i; ?>">
							<input type="hidden" name="process" id="process" value="EDIT">
							<input type="hidden" name="W" id="W" value="<?php echo $W;?>">
							<input type="hidden" name="WFD" id="WFD" value="<?php echo $WFD;?>">
						</div>
					</div>
					</div>
				</div>
	</form>

	<!-- Row end -->
</div>
</div>

<?php if($i > 1){ ?>
<script>
	if( $('#wf_attach_show').length )
	{
		 $('#wf_attach_show').html('<label class="badge bg-success"><?php echo $i-1; ?></label>');
	}
</script>
<?php } 
db::db_close();
?>