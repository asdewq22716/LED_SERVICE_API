<?php
//$HIDE_HEADER = "Y";
include '../include/comtop_user.php'; 
$W = conText($_GET['W']);
$WFR = conText($_GET['WFR']);
$WF_SCREEN_NO = "WS#".$W."-".$WFR;	
$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec_main = db::fetch_array($sql);
$wf_table = $rec_main["WF_MAIN_SHORTNAME"];

$txt_head1 = $rec_main["WF_DETAIL_TOPIC"];
$txt_h_align1 = $rec_main["WF_DETAIL_TOPIC_ALIGN"];
$txt_head2 = $rec_main["WF_DETAIL_DESC"];
$txt_h_align2 = $rec_main["WF_DETAIL_DESC_ALIGN"];



	$sql_workflow = "select * from ".$wf_table." where ".$rec_main['WF_FIELD_PK']." = '".$WFR."' ";
	$query_workflow = db::query($sql_workflow);
	$WF = db::fetch_array($query_workflow); //ใช้ array นี้เป็นหลักในการดึง data	

if($rec_detail["WFD_BTN_SAVE_LABEL"] != ''){ $WF_TEXT_DETAIL_SAVE = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_SAVE_LABEL"]);}
if($rec_detail["WFD_BTN_TEMP_LABEL"] != ''){ $WF_TEXT_DETAIL_SAVE_TEMP = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_TEMP_LABEL"]);}
if($rec_detail["WFD_BTN_ADD_LABEL"] != ''){ $WF_TEXT_DETAIL_BACK = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_ADD_LABEL"]);}
if($rec_detail["WFD_BTN_BACK_LABEL"] != ''){ $WF_TEXT_DETAIL_PROCESS_BACK = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_BACK_LABEL"]);}
if($rec_detail["WFD_BTN_CON_LABEL"] != ''){ $WF_TEXT_DETAIL_PROCESS = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_CON_LABEL"]);}


$link_back_home =  ($rec_detail["WFD_BTN_ADD_LINK"] != '')? bsf_show_field($W,$WF,$rec_detail["WFD_BTN_ADD_LINK"]):"workflow.php?W=".$W;
?>
    <!--<div class="content-wrapper m-b-30">-->
        <!-- Container-fluid starts -->
        <!-- <div class="container-fluid">-->

			<!-- Row Starts -->
            <div class="row">
				<div class="col-sm-12">
					<div class="main-header">
						<div class="media m-b-12">
							<a class="media-left" href="<?php echo $link_back_home; ?>">
								<?php if($rec_main['WF_MAIN_ICON'] != ""){ echo "<img src=\"../icon/".$rec_main['WF_MAIN_ICON']."\" class=\"media-object\">"; } ?>
							</a>
							<div class="media-body">
								<h4 class="m-t-5"><?php echo bsf_language("WFD",$rec_detail["WFD_ID"],$rec_detail["WFD_NAME"]); ?></h4>
								<h5><?php echo bsf_language("W",$rec_main['WF_MAIN_ID'],$rec_main['WF_MAIN_NAME']); ?></h5>
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
		<?php if(($txt_head1 != "" OR $txt_head2 !="")){ ?>
		 <!-- Row start -->
		 <div class="row">
			 <div class="col-sm-12">
				 <div class="card">
					 <!-- Timeline start -->
					 <div class="card-header">
						<div align="<?php echo $align_pos[$txt_h_align1]; ?>">
						<h4><?php echo bsf_show_text($W,$WF,$txt_head1); ?></h4>
						</div>
						<div align="<?php echo $align_pos[$txt_h_align2]; ?>">
						<h5><?php echo bsf_show_text($W,$WF,$txt_head2);  ?></h5>
						</div>
					</div>
				 </div>
			</div>
		</div>
		<?php } ?>
		<div class="row">
		<!---Column --->
			<div class="col-sm-8">
				<div class="row">
				<div class="timeline-dot">
					<?php
						$sql_step = db::query("select * from WF_STEP INNER JOIN WF_DETAIL ON WF_STEP.WFD_ID = WF_DETAIL.WFD_ID where WF_STEP.WF_MAIN_ID = '".$W."' AND WF_STEP.WFR_ID = '".$WFR."' AND WF_STEP.WF_STEP_STAUS = 'Y' AND WFD_VIEW_PREVIOUS_STEP = 'Y' ORDER BY WF_STEP.WF_STEP_ID");
						while($rec_step = db::fetch_array($sql_step)){
							$sql_usr = db::query("SELECT USR_PREFIX,USR_FNAME,USR_LNAME,USR_PICTURE FROM USR_MAIN WHERE USR_ID = '".$rec_step["USR_ID"]."' ");
							$G = db::fetch_array($sql_usr);
							$user = $G["USR_PREFIX"].$G["USR_FNAME"]." ".$G["USR_LNAME"];
							if($G["USR_PICTURE"] != "" AND file_exists("../profile/".$G["USR_PICTURE"])){
								$usr_pic = "../profile/".$G["USR_PICTURE"];
							}else{
								$usr_pic = "../assets/images/avatar-2.png";
							}
						 ?>
					<!----->
                      <div class="social-timelines p-relative o-auto">
                        <div class="timeline-right p-t-35">
                          <div class="col-xs-2 col-sm-1">
                            <div class="social-timelines-left">
                              <img class="img-circle timeline-icon" src="<?php echo $usr_pic; ?>" alt="">
                            </div>
                          </div>
                          <div class="col-xs-10 col-sm-11 p-l-5 p-b-35">
                            <div class="card m-0 z-depth-right-2">
                              <span class="f-right p-10"><a href="../workflow/workflow_view.php?W=<?php echo $W; ?>&WFR=<?php echo $WFR; ?>&WFD=<?php echo $rec_step["WFD_ID"]; ?>" class="btn btn-flat flat-info txt-info waves-effect waves-light" title="View" ><i class="icofont icofont-search-alt-1"></i></a> &nbsp;
							  <?php
							  if(check_det_permission($W,$WF["WF_DET_NEXT"],$WF,'VIEW')){
							  ?>
							  <a href="workflow_process_edit.php?W=<?php echo $W; ?>&WFR=<?php echo $WFR; ?>&WFD=<?php echo $rec_step["WFD_ID"]; ?>" class="btn btn-flat flat-info txt-info waves-effect waves-light" title="Edit" ><i class="icofont icofont-edit-alt"></i></a>
							  <?php }?>
							  </span>
                              <div class="card-block post-timelines">
                                <div class="chat-header"><h5><?php echo bsf_language("WFD",$rec_step["WFD_ID"],$rec_step["WFD_NAME"]); ?></h5></div>
                                <div class="text-muted social-time"><i class="icofont icofont-user-alt-3"></i> <?php echo $user; ?>  &nbsp;&nbsp;&nbsp;<i class="icofont icofont-time"></i> <?php echo db2date($rec_step["WF_DATE_SAVE"]); ?> <?php echo $rec_step["WF_TIME_SAVE"]; ?></div>
                              </div>
                              <!--<div class="card-block b-b-muted b-t-muted social-msg">
                                 form
                              </div>-->
                            </div>
                          </div>
                        </div>
                      </div>
					  <!----->
					  <?php } ?>
                    </div>
				</div>
 			</div>
		<!---Column --->
			<div class="col-sm-4">
			<?php
			
			$sql_doc = db::query("select DOC_ID,DOC_TYPE,DOC_TITLE,DOC_USER_ADD,DOC_FILE from WF_STEP INNER JOIN WF_DETAIL ON WF_STEP.WFD_ID = WF_DETAIL.WFD_ID INNER JOIN DOC_MAIN ON WF_STEP.WFD_ID=DOC_MAIN.WFD_ID where WF_STEP.WF_MAIN_ID = '".$W."' AND WF_STEP.WFR_ID = '".$WFR."' AND WF_STEP.WF_STEP_STAUS = 'Y' AND DOC_STATUS='Y' ORDER BY WF_STEP.WF_STEP_ID,DOC_ID");
			$num_rows_doc = db::num_rows($sql_doc);
			
			
			if($num_rows_doc > 0){	?>
			
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
											<!--<i class="icofont icofont-file-word f-28 text-muted"></i>-->
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
										<!--<div class="f-right v-middle text-muted">
											
											<a href="workflow_document.php?DOC_ID=<?php echo $rec_doc["DOC_ID"];?>&WFR=<?php echo $WFR;?>" class="m-b-5 d-block" target="_blank" <?php echo $title;?>><i class="icofont icofont-download-alt f-18"></i></a>-->
											
											<!--<a href="../doc/<?php echo $rec_doc["DOC_FILE"];?>" class="m-b-5 d-block" target="_blank" <?php echo $title;?>><i class="icofont icofont-download-alt f-18"></i></a>-->
											
										<!--</div>-->
									</li>
								<?php }?>
							</ul>
						</div>
					</div>
					<?php 
					}?>
					<div id="message_detail">
						<script type="text/javascript">
							var dataString = 'W=<?php echo $W;?>&WFR=<?php echo $WFR;?>';
							$.ajax({
							 type: "GET",
							 url: "message_form.php",
							 data: dataString,
							 cache: false,
							 success: function(html){
							  $("#message_detail").html(html);
							 }
							 });

						</script>
					</div>
                </div>
					
					

			</div>
		</div>
				 <!----->
			 </div>
		 </div>
		 <!-- Row end -->

     <!--</div>
</div>-->

<?php include '../include/combottom_js_user.php'; ?>
<?php include '../include/combottom_user.php'; ?>
