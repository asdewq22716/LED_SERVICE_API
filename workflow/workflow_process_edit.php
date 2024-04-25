<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
if($flag_preview == 'Y'){
	include '../include/comtop_admin.php'; 
}else{
	include '../include/comtop_user.php'; 
}
$W = conText($_GET['W']);
$WFR = conText($_GET['WFR']);
$WFD = conText($_GET['WFD']);

$align_pos = array(''=>'left','L'=>'left','C'=>'center','R'=>'right');

if($W != "" AND ($WFR != "" OR $start_flow == "Y" OR $flag_preview == 'Y')){
$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec_main = db::fetch_array($sql);
$wf_table = $rec_main["WF_MAIN_SHORTNAME"];

$txt_head1 = $rec_main["WF_DETAIL_TOPIC"];
$txt_h_align1 = $rec_main["WF_DETAIL_TOPIC_ALIGN"];
$txt_head2 = $rec_main["WF_DETAIL_DESC"];
$txt_h_align2 = $rec_main["WF_DETAIL_DESC_ALIGN"];

if($flag_preview == 'Y'){
	$sql_detail = db::query("select * from WF_DETAIL where WFD_ID = '".$WFD."' ");
}else{
if($start_flow == "Y"){
	$sql_detail = db::query("select * from WF_DETAIL where WF_MAIN_ID = '".$W."' AND WFD_TYPE = 'S' ");
}else{
	
	$sql_workflow = "select * from ".$wf_table." where ".$rec_main['WF_FIELD_PK']." = '".$WFR."' ";
	$query_workflow = db::query($sql_workflow);
	$WF = db::fetch_array($query_workflow); //ใช้ array นี้เป็นหลักในการดึง data	
	if($view_flow == "Y"){ 
	$sql_detail = db::query("select * from WF_DETAIL where WFD_ID = '".$WFD."' ");
	}else{
	$sql_detail = db::query("select * from WF_DETAIL where WFD_ID = '".$WFD."' ");
	}
}
}

$rec_detail = db::fetch_array($sql_detail);

if($rec_detail["WFD_DETAIL_TOPIC"] != ""){
$txt_head1 = $rec_detail["WFD_DETAIL_TOPIC"];
	if($rec_detail["WFD_DETAIL_TOPIC_ALIGN"] != ""){
	$txt_h_align1 = $rec_detail["WFD_DETAIL_TOPIC_ALIGN"];
	}
}

if($rec_detail["WFD_DETAIL_DESC"] != ""){
$txt_head2 = $rec_detail["WFD_DETAIL_DESC"];
	if($rec_detail["WFD_DETAIL_DESC_ALIGN"] != ""){
	$txt_h_align2 = $rec_detail["WFD_DETAIL_DESC_ALIGN"];
	}
}

if($rec_detail["WFD_BTN_SAVE_LABEL"] != ''){ $WF_TEXT_DETAIL_SAVE = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_SAVE_LABEL"]);}
if($rec_detail["WFD_BTN_TEMP_LABEL"] != ''){ $WF_TEXT_DETAIL_SAVE_TEMP = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_TEMP_LABEL"]);}
if($rec_detail["WFD_BTN_ADD_LABEL"] != ''){ $WF_TEXT_DETAIL_BACK = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_ADD_LABEL"]);}
if($rec_detail["WFD_BTN_BACK_LABEL"] != ''){ $WF_TEXT_DETAIL_PROCESS_BACK = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_BACK_LABEL"]);}
if($rec_detail["WFD_BTN_CON_LABEL"] != ''){ $WF_TEXT_DETAIL_PROCESS = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_CON_LABEL"]);}


$link_back_home =  ($rec_detail["WFD_BTN_ADD_LINK"] != '')? bsf_show_field($W,$WF,$rec_detail["WFD_BTN_ADD_LINK"]):"workflow.php?W=".$W;


$sql_step_pre = db::query("SELECT COUNT(WF_STEP_ID) AS NUM_STEP FROM WF_STEP WHERE WF_MAIN_ID='".$W."' AND WF_STEP_STAUS='Y' AND WFR_ID='".$WFR."'");
$step_pre = db::fetch_array($sql_step_pre);

?>
    <div class="content-wrapper">
        <!-- Container-fluid starts -->
        <div class="container-fluid">

			<!-- Row Starts -->
            <div class="row">
				<div class="col-sm-12">
					<div class="main-header">
						<div class="media m-b-12">
							<a class="media-left" href="<?php echo $link_back_home; ?>">
								<?php if($rec_main['WF_MAIN_ICON'] != ""){ echo "<img src=\"../icon/".$rec_main['WF_MAIN_ICON']."\" class=\"media-object\">"; } ?>
							</a>
							<div class="media-body">
								<?php
								if($rec_detail["WFD_CHANGE_STEP_NAME"] != ''){
									$wfd_name = bsf_language("WFD",$rec_detail["WFD_ID"],$rec_detail["WFD_CHANGE_STEP_NAME"]);
									
								}else{
									
									if($rec_main["WF_CHANGE_STEP_NAME"] != ''){
										$wfd_name = bsf_language("WFD",$rec_detail["WFD_ID"],$rec_main["WF_CHANGE_STEP_NAME"]);
										
									}else{
										$wfd_name = bsf_language("WFD",$rec_detail["WFD_ID"],$rec_detail["WFD_NAME"]);
									}
								}
								
								if($rec_detail["WFD_CHANGE_FLOW_NAME"] != ''){
									$wf_name = bsf_language("WFD",$rec_detail["WFD_ID"],$rec_detail["WFD_CHANGE_FLOW_NAME"]);
									
								}else{
									
									if($rec_main["WF_CHANGE_FLOW_NAME"] != ''){
										$wf_name = bsf_language("WFD",$rec_detail["WFD_ID"],$rec_main["WF_CHANGE_FLOW_NAME"]);
										
									}else{
										$wf_name = bsf_language("W",$rec_main['WF_MAIN_ID'],$rec_main['WF_MAIN_NAME']);
									}
								}
								?>
							
								<h4 class="m-t-5"><?php echo $wfd_name;//echo bsf_language("WFD",$rec_detail["WFD_ID"],$rec_detail["WFD_NAME"]); ?></h4>
								<h5><?php echo $wf_name;//echo bsf_language("W",$rec_main['WF_MAIN_ID'],$rec_main['WF_MAIN_NAME']); ?></h5>
							</div>
						</div>
						<div class="f-right">
							<?php
							if($rec_detail["WFD_BTN_ADD_STATUS"] == 'Y'){	?>
								<a class="btn btn-danger waves-effect waves-light" href="<?php echo $link_back_home; ?>" role="button" <?php if($rec_detail["WFD_BTN_ADD_RESIZE"] == 'Y'){ echo 'data-toggle="tooltip"';}?> title="<?php if($rec_detail["WFD_BTN_ADD_RESIZE"] == 'Y'){ echo $WF_TEXT_DETAIL_BACK;}?>"><i class="icofont icofont-home"></i> <?php echo $WF_TEXT_DETAIL_BACK;?></a>
							<?php }?>
							
						</div>
					</div>
				</div>
			</div>
            <!-- Row end --> 
			<?php if($flag_preview != 'Y'){ ?><form method="post" enctype="multipart/form-data" id="form_wf" name="form_wf" action="<?php
			if($flag_preview == 'Y'){ echo "#"; }else{
			if($rec_detail["WFD_BTN_SAVE_LINK"] != ''){ echo bsf_show_field($W,$WF,$rec_detail["WFD_BTN_SAVE_LINK"]);}else{ echo "workflow_edit_function.php";}} ?>"><?php } ?>
             <!--Workflow row start-->
                <div class="row">
					<div class="col-md-12">
						<div class="card">
							<?php if(($txt_head1 != "" OR $txt_head2 !="") AND ($start_flow != "Y" OR $rec_main["WF_DETAIL_FIRST_VIEW"]=="Y")){ ?><div class="card-header">
								<div align="<?php echo $align_pos[$txt_h_align1]; ?>">
								<h4><?php echo nl2br(bsf_show_text($W,$WF,$txt_head1)); ?></h4>
								</div>
								<div align="<?php echo $align_pos[$txt_h_align2]; ?>">
								<h5><?php echo nl2br(bsf_show_text($W,$WF,$txt_head2));  ?></h5>
								</div>
							</div><?php } ?>
							<div class="card-block">
								<div class="form-group row">
									<?php bsf_show_form($W,$rec_detail["WFD_ID"],$WF,$rec_main['WF_TYPE'],'','',$view_flow); ?>
								</div>
							</div>
							
			<?php 
			$sql_doc = db::query("select * from DOC_MAIN WHERE WFD_ID = '".$rec_detail["WFD_ID"]."' AND DOC_STATUS='Y' ORDER BY DOC_SORT ASC");
			$num_rows_doc = db::num_rows($sql_doc);
			
			
			if($num_rows_doc > 0){	?>
			<div class="card-header">
				 <div class="col-sm-12">
					<div class="card m-t-40">
						<div class="card-header">
							<h5 class="card-header-text"><i class="icofont icofont-attachment"></i> เอกสารแนบ</h5>
						</div>
						<div class="card-block">
							<ul class="media-list">
								<?php 
								while($rec_doc = db::fetch_array($sql_doc)){
									
									$icon = "";
									$title = "";
									
									
									if($rec_doc["DOC_TYPE"] == 'W'){
										$icon = "class=\"fa fa-file-word-o\"";
										$title = "class=\"label bg-primary\"";
									
									}elseif($rec_doc["DOC_TYPE"] == 'L'){
										$icon = "class=\"fa fa-file-pdf-o\"";
										$title = "class=\"label bg-success\"";
										
									}elseif($rec_doc["DOC_TYPE"] == 'D'){
										$icon = "class=\"fa fa-file-pdf-o\"";
										$title = "class=\"label bg-danger\"";
										
									}else{
										$icon = "";
										$title = "";
										
									}

								?>
									<li class="media d-flex m-b-10">
										<div class="m-r-20 v-middle">
											<i <?php echo $icon;?>></i>
										</div>
										<div class="media-body"> 
											<?php if($rec_doc["DOC_TYPE"] == 'W'){ ?>
											<a href="workflow_document.php?DOC_ID=<?php echo $rec_doc["DOC_ID"];?>&WFR=<?php echo $WFR;?>" class="m-b-5 d-block" target="_blank" <?php echo $title;?>><?php echo $rec_doc["DOC_TITLE"];?></a><?php 
											if($rec_doc["DOC_USER_ADD"] == 'Y'){
											?>
											[<i class="fa fa-plus-circle"></i> <a href="doc_customize.php?W=<?php echo $W;?>&WFR=<?php echo $WFR;?>&DOC_ID=<?php echo $rec_doc["DOC_ID"];?>" target="_blank">เอกสารเพิ่มเติม</a> ]
											<?php }?>
											<?php } ?>
											<?php if($rec_doc["DOC_TYPE"] == 'L'){ ?>
											<a href="<?php echo bsf_show_text($W,$WF,$rec_doc["DOC_FILE"]);?>" class="m-b-5 d-block" target="_blank" <?php echo $title;?>><?php echo $rec_doc["DOC_TITLE"];?></a>
											<?php } ?>
											<?php if($rec_doc["DOC_TYPE"] == 'D'){ ?>
											<a href="<?php echo bsf_show_text($W,$WF,$rec_doc["DOC_FILE"]);?>" class="m-b-5 d-block" target="_blank" <?php echo $title;?>><?php echo $rec_doc["DOC_TITLE"];?></a>
											<?php } ?>
										</div> 
									</li>
								<?php }?>
							</ul>
						</div>
					</div>
				</div>
			</div>
					<?php 
					}?>
							
				</div>		
					</div>
				</div>
            <!-- Workflow Row end -->
			<?php if($view_flow != 'Y'){ ?>
			<div class="row">
				<div class="col-md-12">
                    <div class="wf-right">&nbsp;
						<?php
						
						if($rec_detail["WFD_BTN_SAVE_STATUS"] == 'Y'){?>
							<button type="submit" class="btn btn-success waves-effect waves-light"><i class="icofont icofont-tick-mark" <?php if($rec_detail["WFD_BTN_SAVE_RESIZE"] == 'Y'){ echo 'data-toggle="tooltip"';}?> title="<?php if($rec_detail["WFD_BTN_SAVE_RESIZE"] == 'Y'){ echo $WF_TEXT_DETAIL_SAVE;}?>"></i> <?php if($rec_detail["WFD_BTN_SAVE_RESIZE"] != 'Y'){echo $WF_TEXT_DETAIL_SAVE;}?></button>
						<?php 
						}?>
						<input type="hidden" name="W" value="<?php echo $W; ?>">
						<input type="hidden" name="WFR" value="<?php echo $WFR; ?>">
						<input type="hidden" name="WF_NEXT_STEP" id="WF_NEXT_STEP" value="<?php echo $WF["WF_DET_NEXT"]; ?>">
						<input type="hidden" name="SAVE_STEP" id="SAVE_STEP" value="">
						<input type="hidden" name="WF_LOAD_DATE" id="WF_LOAD_DATE" value="<?php echo date("d/m/").(date("Y")+543); ?>">
						<input type="hidden" name="WF_LOAD_TIME" id="WF_LOAD_TIME" value="<?php echo date("H:i:s"); ?>">
						<input type="hidden" name="WF_REF_URL" value="<?php echo $_SERVER["HTTP_REFERER"]; ?>">
						<input type="hidden" name="WFD" value="<?php echo $WFD; ?>">
                    </div>
                </div>
            </div>
			<?php
			}
			if($flag_preview != 'Y'){ ?></form><?php } ?>
			
			<?php
			if($rec_detail["WFD_TYPE"] == 'T'){ //โยนค่าไปกระบวนการอื่น
				$sql_main = db::query("select WF_MAIN_SHORTNAME,WF_FIELD_PK,WF_TYPE from WF_MAIN where WF_MAIN_ID = '".$rec_detail["WFD_THROW_ID"]."'");
				$data_main = db::fetch_array($sql_main);
				
				$S = explode(",",$rec_detail["WFD_THROW_FIELD_SOURCE"]);
				$T = explode(",",$rec_detail["WFD_THROW_FIELD_DESTINATION"]);
				
				foreach($T as $key=>$val){
					$a_data[$val] = $WF[$S[$key]];
				}
				
				if($WF["WFR_REF"] != ''){ 
					$a_cond[$data_main["WF_FIELD_PK"]] = $WF["WFR_REF"];
					db::db_update($data_main["WF_MAIN_SHORTNAME"], $a_data, $a_cond);
					unset($a_data);
					unset($a_cond);
				}else{
					if($data_main["WF_TYPE"] == 'W'){ 
						$a_data['WFR_TIMESTAMP'] = date2db(date("d/m/").(date("Y")+543));
						$a_data['WFR_UID'] = $_SESSION['WF_USER_ID'];
					}
					$ref = db::db_insert($data_main["WF_MAIN_SHORTNAME"],$a_data,$data_main["WF_FIELD_PK"]);
					unset($a_data);
					unset($a_cond);
					
					
					$a_data_m["WFR_REF"] = $ref;
					$a_cond_m["WFR_ID"] = $WFR;
					db::db_update($wf_table, $a_data_m, $a_cond_m);
					unset($a_data_m);
					unset($a_cond_m);
					
					
					if($data_main["WF_TYPE"] == 'W'){ 
						$sql_detail1 = db::query("select WFD_ID,WFD_DEFAULT_STEP from WF_DETAIL where WF_MAIN_ID = '".$rec_detail["WFD_THROW_ID"]."' AND WFD_TYPE='S' ");
						$detail_s = db::fetch_array($sql_detail1);
						
						if($rec_detail["WFD_THROW_NEXT_STEP"] == 'Y'){
							$WF_DET_NEXT = $detail_s["WFD_DEFAULT_STEP"];
						}else{
							$WF_DET_NEXT = $detail_s["WFD_ID"];
						}
						
						$a_data1['WF_DET_STEP'] = $detail_s["WFD_ID"];
						$a_data1['WF_DET_NEXT'] = $WF_DET_NEXT;
						$a_cond1['WFR_ID'] = $ref;
						
						db::db_update($data_main["WF_MAIN_SHORTNAME"], $a_data1, $a_cond1);
						unset($a_data1);
						unset($a_cond1);
						
						if($rec_detail["WFD_THROW_NEXT_STEP"] == 'Y'){//กรณีโยนค่าไปยัง Workflow ให้ไปขั้นตอนถัดไป

							$insert_step['WFR_ID'] = $ref;
							$insert_step['WFD_ID'] = $detail_s["WFD_ID"];
							$insert_step['WF_MAIN_ID'] = $rec_detail["WFD_THROW_ID"];
							$insert_step['WF_DATE_SAVE'] = date2db(date("d/m/").(date("Y")+543));
							$insert_step['WF_TIME_SAVE'] = date("H:i:s");
							$insert_step['WF_DATE_LOAD'] = date2db(date("d/m/").(date("Y")+543));
							$insert_step['WF_TIME_LOAD'] = date("H:i:s");
							$insert_step['WF_STEP_STAUS'] = 'Y';
							$insert_step['WFD_NEXT'] = $detail_s["WFD_DEFAULT_STEP"];

							db::db_insert('WF_STEP',$insert_step,'WF_STEP_ID');
							unset($insert_step);
						}
						
					}
				}?> 
				<script type="text/javascript">
					$('#form_wf').submit();
				</script>
				<?php
				exit;
			}
			
			
			?>
			
    </div>
			<div class="row">
				<div class="main-header">
				</div>
			</div>
        <!-- Container-fluid ends -->
     </div>
</div>
<?php include '../include/combottom_js_user.php';
	if(trim($rec_detail["WFD_ALERT_BEFORE_SUBMIT"]) != ""){
		?>
<script type="text/javascript">
	$('#form_wf').submit(function(e){
	e.preventDefault(); 	
			swal({
					title: "",
					text: "<?php echo wf_nl2br(trim($rec_detail["WFD_ALERT_BEFORE_SUBMIT"])); ?>",
					type: "warning",
					html: true,
					showCancelButton: true,
					confirmButtonClass: "btn-success",
					confirmButtonText: "ตกลง",
					cancelButtonText: "ยกเลิก",
					closeOnConfirm: true,
					closeOnCancel: true
				},
			function(isConfirm){
				if (isConfirm) {
					 $("#form_wf").off("submit").submit();
					return true;
				}else{
					 return false;
				}

			});
	});

</script>
		<?php
	}
 } include '../include/combottom_user.php'; ?>
