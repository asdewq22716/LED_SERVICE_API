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
?>
<!-- Time line css -->
    <link rel="stylesheet" type="text/css" href="../assets/plugins/timeline/css/style.css">

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
						 <div class="main-timeline">
							 <div class="cd-timeline cd-container">
							 <?php
							$sql_step = db::query("select * from WF_STEP INNER JOIN WF_DETAIL ON WF_STEP.WFD_ID = WF_DETAIL.WFD_ID where WF_STEP.WF_MAIN_ID = '".$W."' AND WF_STEP.WFR_ID = '".$WFR."' AND WF_STEP.WF_STEP_STAUS = 'Y' ORDER BY WF_STEP.WF_STEP_ID");
							while($rec_step = db::fetch_array($sql_step)){
								$sql_usr = db::query("SELECT USR_PREFIX,USR_FNAME,USR_LNAME,USR_PICTURE FROM USR_MAIN WHERE USR_ID = '".$rec_step["USR_ID"]."' ");
								$G = db::fetch_array($sql_usr);
								$user = $G["USR_PREFIX"].$G["USR_FNAME"]." ".$G["USR_LNAME"];
								if($G["USR_PICTURE"] != "" AND file_exists("../profile/".$G["USR_PICTURE"])){
									$usr_pic = "../profile/".$G["USR_PICTURE"];
								}else{
									$usr_pic = "assets/images/avatar-1.png";
								}
							 ?>
								<!-- cd-timeline-block -->				 
								 <div class="cd-timeline-block">
									 <div class="cd-timeline-icon bg-success">
										 <i class="icofont icofont-ui-file"></i>
									 </div> <!-- cd-timeline-img -->

									 <div class="cd-timeline-content card_main">
										 <div class="media bg-white d-flex p-10 d-block-phone">
											 <div class="media-left media-middle col-xs-12">
												 <span><img class="img-circle " src="<?php echo $usr_pic; ?>" style="width:40px;" alt="User Image"></span>
											 </div>
											 <div class="media-body">
												 <div class="f-15 f-bold m-b-5"><?php echo $rec_step["WFD_NAME"]; ?></div>
												 <div class="f-13 text-muted"><?php echo $user; ?></div>
											 </div>
										 </div>
										 <span class="cd-date"><?php echo db2date($rec_step["WF_DATE_SAVE"]); ?> <?php echo $rec_step["WF_TIME_SAVE"]; ?></span>
										 <!--<span class="cd-details">You  posed an artical with public</span>-->
									 </div> <!-- cd-timeline-content -->
								 </div> <!-- cd-timeline-block -->
							<?php } ?>	 
							 </div> <!-- cd-timeline -->
						 </div>
					 </div>
				 </div>
			 </div>
		 </div>
		 <!-- Row end -->

     </div>
</div>
<?php include '../include/combottom_js_user.php'; ?>
<?php include '../include/combottom_user.php'; ?>
