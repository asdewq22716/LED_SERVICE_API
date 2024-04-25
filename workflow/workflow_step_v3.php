<?php
include '../include/comtop_user.php'; 
$W = conText($_GET['W']);
$WFR = conText($_GET['WFR']);

$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec_main = db::fetch_array($sql);
$wf_table = $rec_main["WF_MAIN_SHORTNAME"];

$txt_head1 = $rec_main["WF_DETAIL_TOPIC"];
$txt_h_align1 = $rec_main["WF_DETAIL_TOPIC_ALIGN"];
$txt_head2 = $rec_main["WF_DETAIL_DESC"];
$txt_h_align2 = $rec_main["WF_DETAIL_DESC_ALIGN"];


	$sql_workflow = "select * from ".$wf_table." where WFR_ID = '".$WFR."' ";
	$query_workflow = db::query($sql_workflow);
	$WF = db::fetch_array($query_workflow); //ใช้ array นี้เป็นหลักในการดึง data	
	
	
if($rec_detail["WFD_BTN_SAVE_LABEL"] != ''){ $WF_TEXT_DETAIL_SAVE = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_SAVE_LABEL"]);}
if($rec_detail["WFD_BTN_TEMP_LABEL"] != ''){ $WF_TEXT_DETAIL_SAVE_TEMP = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_TEMP_LABEL"]);}
if($rec_detail["WFD_BTN_ADD_LABEL"] != ''){ $WF_TEXT_DETAIL_BACK = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_ADD_LABEL"]);}
if($rec_detail["WFD_BTN_BACK_LABEL"] != ''){ $WF_TEXT_DETAIL_PROCESS_BACK = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_BACK_LABEL"]);}
if($rec_detail["WFD_BTN_CON_LABEL"] != ''){ $WF_TEXT_DETAIL_PROCESS = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_CON_LABEL"]);}


$link_back_home =  ($rec_detail["WFD_BTN_ADD_LINK"] != '')? bsf_show_field($W,$WF,$rec_detail["WFD_BTN_ADD_LINK"]):"workflow.php?W=".$W;
?>
    <div class="content-wrapper m-b-30">
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
								<h4 class="m-t-5"><?php echo $rec_detail["WFD_NAME"]; ?></h4>
								<h5><?php echo $rec_main['WF_MAIN_NAME']; ?></h5>
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

		 <!-- Row start -->
		 <div class="row">
			 <div class="col-sm-12">
				 <div class="card">
					 <!-- Timeline start -->
					 <?php if(($txt_head1 != "" OR $txt_head2 !="")){ ?><div class="card-header">
						<div align="<?php echo $align_pos[$txt_h_align1]; ?>">
						<h4><?php echo bsf_show_text($W,$WF,$txt_head1); ?></h4>
						</div>
						<div align="<?php echo $align_pos[$txt_h_align2]; ?>">
						<h5><?php echo bsf_show_text($W,$WF,$txt_head2);  ?></h5>
						</div>
					</div><?php } ?>
					 <div class="card-block">
						<ul class="nav nav-tabs md-tabs" role="tablist">
							<li class="nav-item">
							   <a class="nav-link active" data-toggle="tab" href="#tab_timeline" role="tab"><i class="icofont icofont-file-alt"></i> Timeline</a>
								<div class="slide"></div>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#tab_doc" role="tab"><i class="icofont icofont-print"></i> Document</a>
								<div class="slide"></div>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#tab_msg" role="tab"><i class="icofont icofont-ui-message"></i> Messages</a>
								<div class="slide"></div>
							</li>
						</ul>
					 </div>
				 </div>
				 <!----->
			<div class="tab-content">
				<div class="tab-pane active" id="tab_timeline" role="tabpanel">
				 <div class="row">
                    <div class="timeline-dot">
					<?php
						$sql_step = db::query("select * from WF_STEP INNER JOIN WF_DETAIL ON WF_STEP.WFD_ID = WF_DETAIL.WFD_ID where WF_STEP.WF_MAIN_ID = '".$W."' AND WF_STEP.WFR_ID = '".$WFR."' AND WF_STEP.WF_STEP_STAUS = 'Y' ORDER BY WF_STEP.WF_STEP_ID");
						while($rec_step = db::fetch_array($sql_step)){
							$sql_usr = db::query("SELECT USR_PREFIX,USR_FNAME,USR_LNAME,USR_PICTURE FROM USR_MAIN WHERE USR_ID = '".$rec_step["USR_ID"]."' ");
							$G = db::fetch_array($sql_usr);
							$user = $G["USR_PREFIX"].$G["USR_FNAME"]." ".$G["USR_LNAME"];
							if($G["USR_PICTURE"] != "" AND file_exists("../profile/".$G["USR_PICTURE"])){
								$usr_pic = "../profile/".$G["USR_PICTURE"];
							}else{
								$usr_pic = "../assets/images/avatar-1.png";
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
                            <div class="card m-0">
                              <div class="input-group wall-elips">
                                <span class="dropdown-toggle addon-btn text-muted f-right ellipsis" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="tooltip">
                                </span>
                                <div class="dropdown-menu dropdown-menu-right b-none elipsis-box">
                                  <a class="dropdown-item" href="#">แก้ไขขั้นตอน</a>
                                  <a class="dropdown-item" href="#">ย้อนขั้นตอน</a>
                                </div>
                              </div>
                              <div class="card-block post-timelines">
                                <div class="chat-header"><h5><?php echo $rec_step["WFD_NAME"]; ?></h5></div>
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
				  <!----->
				</div>
				<div class="tab-pane" id="tab_doc" role="tabpanel">
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-block">
					<p>4.Cras consequat in enim ut efficitur. Nulla posuere elit quis auctor>interdum praesent sit amet nulla vel enim amet. Donec convallis tellus neque, et imperdiet felis amet.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="tab_msg" role="tabpanel">
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
					<p>ssssssssssss</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!----->
			 </div>
		 </div>
		 <!-- Row end -->

     </div>
</div>
<?php include '../include/combottom_js_user.php'; ?>
<?php include '../include/combottom_user.php'; ?>
