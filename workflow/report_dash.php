<!-- gridstack css -->
<link rel="stylesheet" href="../assets/css/gridstack.css"/>
<script src="../assets/js/plotly-latest.min.js"></script>
<style>
 .grid-stack > .grid-stack-item > .grid-stack-item-content {
	overflow-y: hidden;
	cursor: default;
}
.profile-hvr {
	text-align:left;z-index:999;background:none ;
}
.social-profile {
    padding: 0px;
}
.no-footer{margin-top: 10px !important;}
</style>
	<link rel="stylesheet" type="text/css" href="../assets/plugins/data-table/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/plugins/data-table/css/fixedColumns.bootstrap4.min.css">
	
<script type="text/javascript" src="../assets/js/dom-to-image.js"></script>
 <link rel="stylesheet" href="../assets/plugins/charts/chartlist/css/chartlist.css" type="text/css" media="all">

    <div class="content-wrapper">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <!-- Row Starts -->
            <div class="row">
                <div class="col-sm-12">
				<div class="main-header">
					<h4><?php echo $rec_main['WF_MAIN_NAME']; ?></h4>
				</div>
			</div>
            </div>
			<?php if($rec_main["WF_MAIN_TOP_INCLUDE"] != "" AND file_exists("../plugin/".$rec_main["WF_MAIN_TOP_INCLUDE"])){ include("../plugin/".$rec_main["WF_MAIN_TOP_INCLUDE"]); } 
						$filter = "";
							$sql_search = db::query("select * from WF_STEP_FORM where WF_MAIN_ID = '".$W."' AND WF_TYPE = 'S' AND (WFS_HIDDEN_FORM IS NULL OR WFS_HIDDEN_FORM = '' OR WFS_HIDDEN_FORM = 'N') ");
							if(db::num_rows($sql_search)>0){
							?>
							<div class="row">
				<div class="col-md-12">
                    <div class="card">
						<div class="card-header">
							<form method="get" id="form_wf_search" name="form_wf_search" action="#">
							<h4><i class="icofont icofont-search-alt-2"></i> ค้นหา</h4>
									<div class="form-group row">
									<?php bsf_show_form($W,0,$_GET,'S'); ?> 
									</div>
									<div class="form-group row">
										<div class="col-md-12 text-center">
											<button type="submit" name="wf_search" id="wf_search"  class="btn btn-info"><i class="icofont icofont-search-alt-2"></i> ค้นหา</button>
											&nbsp;&nbsp;
											<button type="button" name="wf_reset" id="wf_reset"  class="btn btn-warning" onClick="window.location.href='<?php echo $wf_link;?>?W=<?php echo $W; ?>';"><i class="zmdi zmdi-refresh-alt"></i> <?php echo $system_conf["wf_label_reset"];?></button> 
											<input type="hidden" name="W" id="W" value="<?php echo $W; ?>"><input type="hidden" name="WF_SEARCH" id="WF_SEARCH" value="Y">
										</div>
									</div>
							</form>	
					</div>
					</div>
				</div>
			</div>
							<?php
							$filter = wf_search_function($W,$_GET);
							} ?>
            <!-- Row end -->
			<form method="post" enctype="multipart/form-data" id="form_wf">
			<!-- Row Starts -->
			
            <div id="my-node-parent2">
				<div id="my-node2">
                            <div class="grid-stack" id="grid1" data-gs-width="12">
							<?php $sql_form = db::query("SELECT *FROM WF_WIDGET WHERE WF_MAIN_ID = '".$W."' ORDER BY WG_POS_Y ASC , WG_POS_X ASC");
					$txt_java = "";
						while($rec_form = db::fetch_array($sql_form)){ ?>
                                <div class="grid-stack-item " data-gs-id="<?php echo $rec_form['WG_ID']; ?>" data-gs-x="<?php echo $rec_form['WG_POS_X']; ?>" data-gs-y="<?php echo $rec_form['WG_POS_Y']; ?>" data-gs-width="<?php echo $rec_form['WG_POS_W']; ?>" data-gs-height="<?php echo $rec_form['WG_POS_H']; ?>" data-gs-type="<?php echo $rec_form['WG_TYPE']; ?>" data-gs-head="<?php if($rec_form['WG_HIDE_HEADER']=="Y"){ echo "0"; }else{ echo "60"; } ?>">
								
								<div class="grid-stack-item-content card social-profile <?php echo $rec_form['WG_BG']; ?>">
									
									<?php if($rec_form['WG_HIDE_HEADER']==""){ ?>
									<div class="card-header <?php echo $rec_form['WG_BG']; ?>"><h5 class="card-header-text"><?php if($rec_form['WG_ICON']!=""){ echo htmlspecialchars_decode($rec_form['WG_ICON'])." "; } ?><?php echo $rec_form['WG_NAME']; ?></h5></div><?php } ?>
									<div id="WG<?php echo $rec_form['WG_ID']; $txt_java .= "load_wg('".$rec_form['WG_ID']."');"; ?>" class="card-block <?php echo $rec_form['WG_BG']; ?>">
<div class="loader-block">
										<svg id="loader2" viewBox="0 0 100 100">
											<circle id="circle-loader2" cx="50" cy="50" r="45"></circle>
										</svg>
									</div>
								</div>
								</div>
							</div>
		<?php if($rec_form['WG_TYPE'] == "1"){ ?>
			<script>
				$(function(){
				$('#WG<?php echo $rec_form['WG_ID']; ?>').slimScroll({
					height: <?php echo ($rec_form['WG_POS_H']*40)+(($rec_form['WG_POS_H']-1)*20); ?>,
					 allowPageScroll: false,
					 wheelStep:5,
					 color: '#000'
					});
					});
			</script>
		<?php }} ?>
                           </div> 
                </div>
            </div>
            <!-- Row end -->
			<div class="row">
				<div class="main-header">
				<br />
				</div>
			</div>
			
			<textarea  name="re_order_grid" id="re_order_grid" cols="100" rows="20" style="display:none"></textarea>
		</form>
		<!--<div align="center"><input type="button" value="Capture Screen" onClick="get_screen();"></div>-->
        <!-- Container-fluid ends -->
		<img id="screen">
     </div>
</div>
<script type='text/javascript'>//<![CDATA[
function get_screen(){
var parent = document.getElementById('my-node-parent2');
var node = document.getElementById('my-node2');
var img2 = document.getElementById('screen');
img2.src = '';
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

       // parent.removeChild(node);
		pngDataUrl = pngDataUrl.replace('data:image/png;base64,', '');
		var dataString = 'W=<?php echo $W;?>&WFD=<?php echo $rec_detail["WFD_ID"];?>&data_image='+pngDataUrl;
		$.ajax({
				 type: "POST",
				 url: "export_get_image.php",
				 data: dataString,
				 cache: false,
				 success: function(html){
					 
				 }
				 });

		
        //parent.appendChild(canvas);
	   
    };
img2.src = pngDataUrl;
    
});
} 
</script>
<?php include '../include/combottom_js.php'; ?>
<!-- Scrollbar JS-->
<script src="../assets/plugins/slimscroll/js/jquery.slimscroll.js"></script>
<script src="../assets/plugins/slimscroll/js/jquery.nicescroll.min.js"></script>


<!-- gridstack js -->
<script src="../assets/js/highlight.min.js"></script>
<script src="../assets/js/lodash.js"></script>
<script src="../assets/plugins/gridstack/js/gridstack.js"></script>
<script src="../assets/plugins/gridstack/js/gridstack.jQueryUI.js"></script>

<!-- custom js -->
<script type="text/javascript">
	'use strict';
	hljs.initHighlightingOnLoad();
	$(function()
	{
		$('.grid-stack').gridstack({ 
			width: 12,
			disableDrag: true,
			disableResize : true
		});
		//$('.loader-block').hide();
		//$('#grid1').show();
		
		function wf_update(ui){
			var g_type = ui.element[0].attributes.getNamedItem("data-gs-type").value;
			if(g_type != '1'){
			var g_head = ui.element[0].attributes.getNamedItem("data-gs-head").value;
			var g_height = (ui.element[0].attributes.getNamedItem("data-gs-height").value*68)-g_head;
			var g_id = ui.element[0].attributes.getNamedItem("data-gs-id").value; 
			var g_width = $('#wf_container'+g_id).width();
				var chart = $('#wf_container'+g_id).highcharts();
				chart.setSize(g_width,g_height,true);
			}else{
				/*var g_height = ui.element[0].attributes.getNamedItem("data-gs-height").value*50;
				//alert(g_height);
				$('#wf_container'+g_id).slimScroll({destroy: true});
				
				$('#wf_container'+g_id).slimScroll({
				height: g_height,
                 allowPageScroll: false,
                 wheelStep:5,
                 color: '#FF0'
				});*/
			}
		}
 
	function load_wg(WG){ 
		var dataString = 'WG='+WG+'&<?php echo $_SERVER["QUERY_STRING"]; ?>';
		$.ajax({
			type: "GET",
			url: "../process/load_widget.php",
			data: dataString,
			cache: false,
			success: function(html){
				$('#WG'+WG).html(html);
			}
		 });
	}
<?php echo $txt_java; ?> 
			
	}); 
 
</script>
<?php include '../include/combottom_admin.php'; ?>