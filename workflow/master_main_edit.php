<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
$WF_TYPE = 'M';
$start_flow = "Y";
include '../include/comtop_user.php'; 
$W = conText($_GET['W']);
$WFR = conText($_GET['WFR']);
$PARENT = conText($_GET['PARENT']);
$align_pos = array(''=>'left','L'=>'left','C'=>'center','R'=>'right');

if($W != "" AND ($WFR != "" OR $start_flow == "Y" OR $flag_preview == 'Y')){
$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec_main = db::fetch_array($sql);
$wf_table = $rec_main["WF_MAIN_SHORTNAME"];

$txt_head1 = $rec_main["WF_DETAIL_TOPIC"];
$txt_h_align1 = $rec_main["WF_DETAIL_TOPIC_ALIGN"];
$txt_head2 = $rec_main["WF_DETAIL_DESC"];
$txt_h_align2 = $rec_main["WF_DETAIL_DESC_ALIGN"];

$WF_SCREEN_NO = "MA#".$W;

if($WFR != ""){
$WF_SCREEN_NO = "ME#".$W."-".$WFR;	
	$sql_workflow = "select * from ".$wf_table." where ".$rec_main["WF_FIELD_PK"]." = '".$WFR."' ";
	$query_workflow = db::query($sql_workflow);
	$WF = db::fetch_array($query_workflow); //ใช้ array นี้เป็นหลักในการดึง data	

}else{
	if($rec_main['WF_PARENT_USE'] != '' && $rec_main['WF_PARENT_FIELD'] != ''){
		$WF[$rec_main['WF_PARENT_FIELD']] = $PARENT;
	}
}

if($rec_main["WF_BTN_ADD_LABEL"] != ''){ $WF_TEXT_MAIN_ADD = $rec_main["WF_BTN_ADD_LABEL"];}

if($rec_detail["WFD_BTN_SAVE_LABEL"] != ''){ $WF_TEXT_DETAIL_SAVE = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_SAVE_LABEL"]);}
if($rec_detail["WFD_BTN_TEMP_LABEL"] != ''){ $WF_TEXT_DETAIL_SAVE_TEMP = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_TEMP_LABEL"]);}
if($rec_detail["WFD_BTN_ADD_LABEL"] != ''){ $WF_TEXT_DETAIL_BACK = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_ADD_LABEL"]);}
if($rec_detail["WFD_BTN_BACK_LABEL"] != ''){ $WF_TEXT_DETAIL_PROCESS_BACK = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_BACK_LABEL"]);}
if($rec_detail["WFD_BTN_CON_LABEL"] != ''){ $WF_TEXT_DETAIL_PROCESS = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_CON_LABEL"]);}

 
if($rec_detail["WFD_BTN_ADD_LINK"] != ''){
	$link_back_home = bsf_show_field($W,$WF,$rec_detail["WFD_BTN_ADD_LINK"]);
}else{
	$link_back_home = "master_main.php?W=".$W;
	if($PARENT != ""){
		$link_back_home .= "&PARENT=".$PARENT; 
	}
}

	if($rec_main['WF_JQUERY_VALIDATE'] == "Y")
	{
		echo '<script src="../assets/plugins/jquery-validation/dist/jquery.validate.js"></script>';
	}
?>
	<style>
		.popover{
			background-color: orangered;
		}
		.popover.bs-tether-element-attached-bottom .popover-arrow::after, .popover.popover-top .popover-arrow::after{
			border-top-color: orangered;
		}
		.popover-content{
			color: white;
		}
	</style>
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
								<h5><?php echo bsf_language("W",$rec_main['WF_MAIN_ID'],$rec_main['WF_MAIN_NAME']); ?></h5>
							</div>
						</div>
						<div class="f-right">
							<?php
							if($rec_detail["WFD_BTN_ADD_STATUS"] == 'Y'){	?>
								<a class="btn btn-danger waves-effect waves-light" href="<?php echo $link_back_home; ?>" role="button" <?php if($rec_detail["WFD_BTN_ADD_RESIZE"] == 'Y'){ echo 'data-toggle="tooltip"';}?> title="<?php if($rec_detail["WFD_BTN_ADD_RESIZE"] == 'Y'){ echo $WF_TEXT_DETAIL_BACK;}?>"><i class="icofont icofont-home"></i> <?php echo $WF_TEXT_DETAIL_BACK;?></a>
							<?php }
							
							if($rec_main["WF_BTN_BACK_STATUS"] == 'Y'){?>
							<a class="btn btn-danger waves-effect waves-light" href="<?php echo $link_back_home;?>" role="button" <?php echo $tootip_back;?>  title="<?php if($rec_main["WF_BTN_BACK_RESIZE"] == 'Y'){ echo $WF_TEXT_MAIN_BACK;}?>"><i class="icofont icofont-home"></i> <?php if($rec_main["WF_BTN_BACK_RESIZE"] != 'Y'){echo $WF_TEXT_MAIN_BACK;}?></a>
							<?php }?>
							
						</div>
					</div>
				</div>
			</div>
            <!-- Row end --> 
			<form method="post" enctype="multipart/form-data" id="form_wf" name="form_wf" action="master_main_function.php">
             <!--Workflow row start-->
                <div class="row">
					<div class="col-md-12">
						<div class="card">
							<?php if(($txt_head1 != "" OR $txt_head2 !="") AND ($start_flow != "Y" OR $rec_main["WF_DETAIL_FIRST_VIEW"]=="Y")){ ?><div class="card-header">
								<div align="<?php echo $align_pos[$txt_h_align1]; ?>">
								<h4><?php echo bsf_show_text($W,$WF,$txt_head1); ?></h4>
								</div>
								<div align="<?php echo $align_pos[$txt_h_align2]; ?>">
								<h5><?php echo bsf_show_text($W,$WF,$txt_head2);  ?></h5>
								</div>
							</div><?php } ?>
							<div id="wf_space" class="card-block">
								<div class="form-group row">
									<?php bsf_show_form($W,'0',$WF,'M'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
            <!-- Workflow Row end -->
			<div class="row">
				<div class="col-md-12">
                    <div class="wf-right">&nbsp;
							<button type="submit" class="btn btn-success waves-effect waves-light"><i class="icofont icofont-tick-mark" <?php if($rec_detail["WFD_BTN_SAVE_RESIZE"] == 'Y'){ echo 'data-toggle="tooltip"';}?> title="<?php if($rec_detail["WFD_BTN_SAVE_RESIZE"] == 'Y'){ echo $WF_TEXT_DETAIL_SAVE;}?>"></i> <?php if($rec_detail["WFD_BTN_SAVE_RESIZE"] != 'Y'){echo $WF_TEXT_DETAIL_SAVE;}?></button>
						<input type="hidden" name="W" value="<?php echo $W; ?>">
						<input type="hidden" name="WFR" value="<?php echo $WFR; ?>">
						<input type="hidden" name="WF_REF_URL" value="<?php echo $_SERVER["HTTP_REFERER"]; ?>">
                    </div>
                </div>
            </div>
			</form>
    </div>
			<div class="row">
				<div class="main-header">
				</div>
			</div>
        <!-- Container-fluid ends -->
     </div>
</div>
<?php include '../include/combottom_js_user.php'; ?>
<?php } include '../include/combottom_user.php'; ?>
