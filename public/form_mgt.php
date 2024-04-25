<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
if($_REQUEST['WF_POP']=="P"){
$HIDE_HEADER = "P";
}else{
$HIDE_HEADER = "Y";
}
$start_flow = "Y";
include '../include/comtop_public.php';
$W = conText($_GET['W']);
$WFS = conText($_GET['WFS']);
$WFD = conText($_GET['WFD']);
$WFR = conText($_GET['WFR']);
$WFR_ID = conText($_GET['WFR_ID']);
$F_TEMP_ID = conText($_GET['F_TEMP_ID']);
$WF_VIEW = conText($_GET['WF_VIEW']);
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

if($rec_main["WF_BTN_ADD_LABEL"] != ''){ $WF_TEXT_MAIN_ADD = $rec_main["WF_BTN_ADD_LABEL"];}

if($rec_detail["WFD_BTN_SAVE_LABEL"] != ''){ $WF_TEXT_DETAIL_SAVE = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_SAVE_LABEL"]);}
if($rec_detail["WFD_BTN_TEMP_LABEL"] != ''){ $WF_TEXT_DETAIL_SAVE_TEMP = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_TEMP_LABEL"]);}
if($rec_detail["WFD_BTN_ADD_LABEL"] != ''){ $WF_TEXT_DETAIL_BACK = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_ADD_LABEL"]);}
if($rec_detail["WFD_BTN_BACK_LABEL"] != ''){ $WF_TEXT_DETAIL_PROCESS_BACK = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_BACK_LABEL"]);}
if($rec_detail["WFD_BTN_CON_LABEL"] != ''){ $WF_TEXT_DETAIL_PROCESS = bsf_show_text($W,$WF,$rec_detail["WFD_BTN_CON_LABEL"]);}

?>

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
            <!-- Row end --> 
			<form method="post" enctype="multipart/form-data" id="form_wf_mgt" name="form_wf_mgt" target="TARGET<?php echo $WFS; ?>" action="form_mgt_function.php">
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
							<div class="card-block">
								<div class="form-group row">
<?php bsf_show_form($W,'0',$WF,$rec_main['WF_TYPE'],'','',$WF_VIEW,$WFS); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
            <!-- Workflow Row end -->
			<?php if($WF_VIEW == ''){ ?>
			<div class="row">
				<div class="col-md-12">
                    <div align="center">&nbsp;
							<button type="submit"  class="btn btn-success waves-effect waves-light"><i class="icofont icofont-tick-mark" <?php if($rec_detail["WFD_BTN_SAVE_RESIZE"] == 'Y'){ echo 'data-toggle="tooltip"';}?> title="<?php if($rec_detail["WFD_BTN_SAVE_RESIZE"] == 'Y'){ echo $WF_TEXT_DETAIL_SAVE;}?>"></i> <?php if($rec_detail["WFD_BTN_SAVE_RESIZE"] != 'Y'){echo $WF_TEXT_DETAIL_SAVE;}?></button>
						<input type="hidden" name="W" value="<?php echo $W; ?>">
						<input type="hidden" name="WFD" value="<?php echo $WFD; ?>">
						<input type="hidden" name="WFS" value="<?php echo $WFS; ?>">
						<input type="hidden" name="F_TEMP_ID" value="<?php echo $F_TEMP_ID; ?>">
						<input type="hidden" name="WFR" value="<?php echo $WFR; ?>">
						<input type="hidden" name="WFR_ID" value="<?php echo $WFR_ID; ?>">
						<input type="hidden" name="wfp" value="<?php echo $_REQUEST['wfp']; ?>">
						<input type="hidden" name="WF_POP" value="<?php echo $_REQUEST['WF_POP']; ?>">
                    </div>
                </div>
            </div>
			
			<?php } ?>
			</form>
			<div class="row" style="display:none">
				<iframe name="TARGET<?php echo $WFS; ?>" id="TARGET<?php echo $WFS; ?>"></iframe>
			</div>
    </div>
<?php include '../include/combottom_js_user.php'; 
include '../include/combottom_user.php';
?>
<script type="text/javascript">
/*$('#form_wf_mgt').submit(function(e){
	var url = "../workflow/form_mgt_function.php"; // the script where you handle the form input. 
	$.ajax({
		   type: "POST",
		   url: url,
		   data: $("#form_wf_mgt").serialize(), // serializes the form's elements.
		   cache: false,
		   success: function(data)
		   { 
				get_wfs_show('WFS_FORM_<?php echo $WFS; ?>','../workflow/form_main.php','W=<?php echo $W; ?>&WFD=<?php echo $WFD; ?>&WFS=<?php echo $WFS; ?>&WFR=<?php echo $WFR_ID; ?>&F_TEMP_ID=<?php echo $F_TEMP_ID; ?>','GET');
				$('#bizModal').modal('hide');
		   }
		 });

	return false;  // avoid to execute the actual submit of the form.
});*/
</script>
<?php
}
?>