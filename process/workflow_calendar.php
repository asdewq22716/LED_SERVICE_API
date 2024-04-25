<?php
$HIDE_HEADER = 'Y';
include '../include/comtop_admin.php';

$p_name = "กลุ่มขั้นตอน";
$p_url = "workflow_calendar";
$W = conText($_GET['W']);

$sql = db::query("select * from WF_CALENDAR WHERE WF_MAIN_ID='".$W."' ORDER BY CAL_ID ASC");
$rows = db::num_rows($sql); 

//เช็คว่าเป็น search รึป่าว ถ้าใช่ให้ disabled checkbox
$sql_s = db::query("SELECT COUNT(WFS_ID) AS NUM_WFS FROM WF_STEP_FORM WHERE WF_TYPE='S' AND WF_MAIN_ID='".$W."'");
$data_s = db::fetch_array($sql_s);
$disable = ($data_s["NUM_WFS"] == 0)?'disabled':''; 

?>

			<!-- Row end -->
				<!-- Row Starts -->
				
							<div class="card-header">
								<h4 class="card-header-text">
									<i class="icofont icofont-ui-folder"></i> ตั้งค่าการดึงข้อมูลลง Calendar
								</h4>
								<div class="f-right">
									
									 <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#bizModal" title="เพิ่มข้อมูล" onclick="open_modal('<?php echo $p_url; ?>_form.php?process=add&W=<?php echo $W;?>','เพิ่ม Feeds');"><i class="fa fa-plus-circle"></i> เพิ่ม Feeds</button>&nbsp;

								</div>
							</div>
							<div class="card-block">
								<div class="table-responsive" data-pattern="priority-columns">
									<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
										<thead>
											<tr class="bg-primary">
												<th style="width: 45%;" class="text-center">ข้อมูล</th><th style="width: 10%;" class="text-center">วันเริ่มต้น</th>
												<th style="width: 10%;" class="text-center" >เวลาเริ่มต้น</th><th style="width: 10%;" class="text-center">วันสิ้นสุด</th>
												<th style="width: 10%;" class="text-center" >เวลาสิ้นสุด</th>
												<th style="width: 20%;" class="text-center">Tools</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$i=1;
											while($rec = db::fetch_array($sql))
											{
if($rec['CAL_TAG_COLOR'] == ""){ $tag_color = "#2196F3"; }else{ $tag_color = $rec['CAL_TAG_COLOR']; }
if($rec['CAL_BG_COLOR'] == ""){ $bg_color = "#EFF0F1"; }else{ $bg_color = $rec['CAL_BG_COLOR']; }
if($rec['CAL_TEXT_COLOR'] == ""){ $text_color = "#000000"; }else{ $text_color = $rec['CAL_TEXT_COLOR']; }
											?>
											<tr id="tr_<?php echo $rec['CAL_ID'];?>"> 
												<td class="wf_keyword"><span style="border-left:3px solid <?php echo $tag_color; ?>; padding:5px;background-color:<?php echo $bg_color; ?>;color:<?php echo $text_color; ?>;"><?php echo $rec["CAL_SHOW"];?></span></td>
												<td><?php echo $rec["CAL_START_DATE"];?></td>
												<td><?php echo $rec["CAL_START_TIME"];?></td>
												<td><?php echo $rec["CAL_END_DATE"];?></td>
												<td><?php echo $rec["CAL_END_TIME"];?></td>
												<td class="text-center">
													<nobr>
														<button type="button" class="btn btn-warning btn-icon" data-toggle="modal" data-target="#bizModal" title="แก้ไข <?php echo $p_name; ?>" onclick="open_modal('<?php echo $p_url; ?>_form.php?process=edit&W=<?php echo $W;?>&id=<?php echo $rec['CAL_ID']; ?>','ตั้งค่าการแสดงผล');">
															<i class="icofont icofont-edit-alt"></i>
														</button> &nbsp; 
														<?php
														if($rows!="1"){
														?><button type="button" class="btn btn-info btn-icon" data-toggle="modal" data-target="#bizModal" title="ตั้งค่าค้นหา" onclick="open_modal('<?php echo $p_url; ?>_form.php?process=edit&W=<?php echo $W;?>&id=<?php echo $rec['CAL_ID']; ?>','ตั้งค่าการค้นหา');">
															<i class="icofont icofont-search-alt-2"></i>
														</button> &nbsp; <?php } ?>														
														<button type="button" class="btn btn-danger btn-icon" data-toggle="tooltip" data-placement="top" title="ลบ<?php echo $p_name; ?>" onclick="delete_cal('<?php echo $rec['CAL_ID'];?>');">
															<i class="icofont icofont-trash"></i>
														</button>
													</nobr>
												</td>
											</tr>
											<?php $i++; } ?>
										</tbody>
									</table>
									<input type="hidden" name="group_total_row" id="group_total_row" value="<?php echo $i; ?>">
									<input type="hidden" name="W" id="W" value="<?php echo $W; ?>">
								</div>
							</div>
						
				<!-- Row end -->
		 
			<!-- Container-fluid ends -->

<?php include '../include/combottom_js.php'; ?>
	
	
<?php include '../include/combottom_admin.php'; ?>