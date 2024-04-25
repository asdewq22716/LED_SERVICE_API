<?php
include '../include/comtop_admin.php';

$W = conText($_GET['W']);
$WFD = conText($_GET['WFD']);
$WF_TYPE_SEARCH = conText($_GET['WF_TYPE_SEARCH']);

$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec = db::fetch_array($sql);
if($WFD != '0'){
$sql_detail = db::query("select * from WF_DETAIL where WFD_ID = '".$WFD."'");
$rec_detail = db::fetch_array($sql_detail);
}
if($WF_TYPE_SEARCH == 'Y'){
	$WF_TYPE = 'S';
}else{
	$WF_TYPE = $rec["WF_TYPE"];
	
}
?>
<script type="text/javascript" src="../assets/js/dom-to-image.js"></script>
	<div class="content-wrapper">
		<!-- Container-fluid starts -->
		<div class="container-fluid">
			<!-- Row Starts -->
			<form id="form_wf" name="form_wf">
			<div class="row">
				<div class="col-sm-12">
					<div class="main-header">
						<h4><?php if($rec['WF_MAIN_ICON'] != ""){ echo "<img src=\"../icon/".$rec['WF_MAIN_ICON']."\">"; } ?> <?php echo $rec['WF_MAIN_NAME']; ?></h4>
					</div>
				</div>
			</div>
            <!-- Row end -->
			<div id="my-node-parent2">
				<div id="my-node2">
			<!-- Row Starts -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div id="wf_space" class="card-block">
							<div class="form-group row">
								<?php bsf_show_form($W,$WFD,array(),$WF_TYPE); ?> 
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
		<div align="center"><input type="button" value="Capture Screen" onClick="get_screen();"></div>
     </div>
	 <img id="screen">
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
 

<?php include '../include/combottom_admin.php'; ?>