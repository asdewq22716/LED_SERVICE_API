<?php
include '../include/comtop_admin.php';

$W = conText($_GET['W']);
$WFD = conText($_GET['WFD']);
$WFR = conText($_GET['WFR']);
$WF_TYPE_SEARCH = conText($_GET['WF_TYPE_SEARCH']);

$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec = db::fetch_array($sql);
$wf_table = $rec["WF_MAIN_SHORTNAME"];
if($WFD != '0'){
$sql_detail = db::query("select * from WF_DETAIL where WFD_ID = '".$WFD."'");
$rec_detail = db::fetch_array($sql_detail);
}
if($WF_TYPE_SEARCH == 'Y'){
	$WF_TYPE = 'S';
}else{
	$WF_TYPE = $rec["WF_TYPE"];
	
}

$sql_workflow = "select * from ".$wf_table." where ".$rec['WF_FIELD_PK']." = '".$WFR."' ";
$query_workflow = db::query($sql_workflow);
$WF = db::fetch_array($query_workflow);

$link_back_home =  ($rec_detail["WFD_BTN_ADD_LINK"] != '')? bsf_show_field($W,$WF,$rec_detail["WFD_BTN_ADD_LINK"]):"master_main.php?W=".$W;

?>
<!--script type="text/javascript" src="../assets/js/dom-to-image.js"></script-->
	<div class="content-wrapper">
		<!-- Container-fluid starts -->
		<div class="container-fluid">
			<!-- Row Starts -->
			<form id="form_wf" name="form_wf">
			<div class="row">
				<div class="col-sm-12">
					<div class="main-header">
						<!--<h4><?php if($rec['WF_MAIN_ICON'] != ""){ echo "<img src=\"../icon/".$rec['WF_MAIN_ICON']."\">"; } ?>
						<?php echo $rec['WF_MAIN_NAME']; ?></h4>-->
						<div class="media m-b-12">
							<a class="media-left" href="<?php echo $link_back_home; ?>"><?php if($rec['WF_MAIN_ICON'] != ""){ echo "<img src=\"../icon/".$rec['WF_MAIN_ICON']."\" class=\"media-object\">"; } ?></a>
							<div class="media-body">
								<h4 class="m-t-5"> &nbsp;</h4>
								<h4><?php echo $rec['WF_MAIN_NAME']; ?></h4>
							</div>
						</div>
						<div class="f-right">
							<?php
							if($rec["WF_BTN_BACK_STATUS"] == 'Y'){?>
							<a class="btn btn-danger waves-effect waves-light" href="<?php echo $link_back_home;?>" role="button" <?php echo $tootip_back;?>  title="<?php if($rec["WF_BTN_BACK_RESIZE"] == 'Y'){ echo $WF_TEXT_MAIN_BACK;}?>"><i class="icofont icofont-home"></i> <?php if($rec["WF_BTN_BACK_RESIZE"] != 'Y'){echo $WF_TEXT_MAIN_BACK;}?></a>
							<?php }?>
							
							
						</div>
						
						
						
					</div>
					
				</div>
			</div>
            <!-- Row end -->
			<div id="my-node-parent">
				<div id="my-node">
			<!-- Row Starts -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
						
                        <div class="card-block">
							<div class="form-group row">
								<?php //bsf_show_form($W,$WFD,array(),$WF_TYPE); ?> 
								<?php bsf_show_form($W,$rec_detail["WFD_ID"],$WF,$rec['WF_TYPE'],'','','Y'); ?>
							</div>
                        </div>
                    </div>
                </div>
            </div> 
            <!-- Row end -->
		</div>
		</div>
	</form>
        <!-- Container-fluid ends -->
		
     </div>
</div>
<?php include '../include/combottom_js.php'; ?>
 
<!--
<script type='text/javascript'>//<![CDATA[
window.onload=function(){
var parent = document.getElementById('my-node-parent');
var node = document.getElementById('my-node');

var canvas = document.createElement('canvas');
canvas.width = node.scrollWidth;
canvas.height = node.scrollHeight;

domtoimage.toPng(node).then(function (pngDataUrl) {
    var img = new Image();
    img.onload = function () {
        var context = canvas.getContext('2d');

       // context.translate(canvas.width, 0);
        context.scale( 1, 1);
        context.drawImage(img, 0, 0);

        parent.removeChild(node);
        parent.appendChild(canvas);
    };

    img.src = pngDataUrl;
});
}//]]> 

</script>
-->
<?php include '../include/combottom_admin.php'; ?>