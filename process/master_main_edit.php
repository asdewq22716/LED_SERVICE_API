<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
$WF_TYPE = 'M';
$start_flow = "Y";
include '../include/comtop_admin.php'; 
$W = conText($_GET['W']);
$WFR = conText($_GET['WFR']);

$align_pos = array(''=>'left','L'=>'left','C'=>'center','R'=>'right');

if($W != "" AND ($WFR != "" OR $start_flow == "Y" OR $flag_preview == 'Y')){
$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec_main = db::fetch_array($sql);
$wf_table = $rec_main["WF_MAIN_SHORTNAME"];

$txt_head1 = $rec_main["WF_DETAIL_TOPIC"];
$txt_h_align1 = $rec_main["WF_DETAIL_TOPIC_ALIGN"];
$txt_head2 = $rec_main["WF_DETAIL_DESC"];
$txt_h_align2 = $rec_main["WF_DETAIL_DESC_ALIGN"];

if($WFR != ""){
	$sql_workflow = "select * from ".$wf_table." where ".$rec_main["WF_FIELD_PK"]." = '".$WFR."' ";
	$query_workflow = db::query($sql_workflow);
	$WF = db::fetch_array($query_workflow); //ใช้ array นี้เป็นหลักในการดึง data	

}

if($rec_main["WF_BTN_BACK_LABEL"] != ''){ $WF_TEXT_MAIN_BACK = $rec_main["WF_BTN_BACK_LABEL"];}

if($rec_main["WF_BTN_ADD_RESIZE"] == 'Y'){ 
    $tootip_add = 'data-toggle="tooltip"';
}else{
  $tootip_add = '';
}
if($rec_main["WF_BTN_BACK_RESIZE"] == 'Y'){ 
    $tootip_back = 'data-toggle="tooltip"';
}else{
  $tootip_back = '';
}

/*
if($rec_main["WF_BTN_ADD_LABEL"] != ''){ $WF_TEXT_MAIN_ADD = $rec_main["WF_BTN_ADD_LABEL"];}

if($rec_detail["WFD_BTN_SAVE_LABEL"] != ''){ $WF_TEXT_DETAIL_SAVE = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_SAVE_LABEL"]);}
if($rec_detail["WFD_BTN_TEMP_LABEL"] != ''){ $WF_TEXT_DETAIL_SAVE_TEMP = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_TEMP_LABEL"]);}
if($rec_detail["WFD_BTN_ADD_LABEL"] != ''){ $WF_TEXT_DETAIL_BACK = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_ADD_LABEL"]);}
if($rec_detail["WFD_BTN_BACK_LABEL"] != ''){ $WF_TEXT_DETAIL_PROCESS_BACK = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_BACK_LABEL"]);}
if($rec_detail["WFD_BTN_CON_LABEL"] != ''){ $WF_TEXT_DETAIL_PROCESS = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_CON_LABEL"]);}
*/

$link_back_home =  ($rec_detail["WFD_BTN_ADD_LINK"] != '')? bsf_show_field($W,$WF,$rec_detail["WFD_BTN_ADD_LINK"]):"master_main.php?W=".$W;

?>
    <div class="content-wrapper">
        <!-- Container-fluid starts -->
        <div class="container-fluid">

			<!-- Row Starts -->
            <div class="row">
				<div class="col-sm-12">
					<div class="main-header"> 
						<div class="media m-b-12">
							<a class="media-left" href="<?php echo $link_back_home; ?>"><?php if($rec_main['WF_MAIN_ICON'] != ""){ echo "<img src=\"../icon/".$rec_main['WF_MAIN_ICON']."\" class=\"media-object\">"; } ?></a>
							<div class="media-body">
								<h4 class="m-t-5"> &nbsp;</h4>
								<h4><?php echo $rec_main['WF_MAIN_NAME']; ?></h4>
							</div>
						</div>
						<!--<h4>
						<?php if($rec_main['WF_MAIN_ICON'] != ""){ echo "<img src=\"../icon/".$rec_main['WF_MAIN_ICON']."\" class=\"media-object\" onclick=\"window.location.href='".$link_back_home."';\">"; } ?>
						<?php echo $rec_main['WF_MAIN_NAME']; ?></h4>
					
						<div class="media m-b-12">-->
								
						<div class="f-right">
							<?php
							/*if($rec_detail["WFD_BTN_ADD_STATUS"] == 'Y'){	?>
								<a class="btn btn-danger waves-effect waves-light" href="<?php echo $link_back_home; ?>" role="button" <?php if($rec_detail["WFD_BTN_ADD_RESIZE"] == 'Y'){ echo 'data-toggle="tooltip"';}?> title="<?php if($rec_detail["WFD_BTN_ADD_RESIZE"] == 'Y'){ echo $WF_TEXT_DETAIL_BACK;}?>"><i class="icofont icofont-home"></i> <?php echo $WF_TEXT_DETAIL_BACK;?></a>
							<?php }*/?>
							
							<?php
							
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
<?php
/*$wfield = checkFieldDB('M_ANI2020','R_DATA');
print_r($wfield);
echo strlen($WF['R_DATA']);*/
 include '../include/combottom_js_user.php'; ?>
<?php } include '../include/combottom_user.php'; ?>
