<?php
include '../include/comtop_admin.php';

$W = conText($_GET['W']);
$WFD = conText($_GET['WFD']);

$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec = db::fetch_array($sql);
$start = conText($_GET['start']);


$query_step_num = db::query("select count(WFD_ID) AS NUM_ROWS_STEP from WF_DETAIL where WF_MAIN_ID = '".$W."'");
$step_num = db::fetch_array($query_step_num);

if($start == ''){
	$start = 0;
}

include '../include/combottom_js.php';
if(($step_num["NUM_ROWS_STEP"] <= $start) AND $start > 0){?>
	<script>
		swal({
		  title: "Load หน้าจอเรียบร้อยแล้ว", 
		  type: "success",
		  allowOutsideClick:true
		},
		function(isConfirm){
		  window.close();
		});

	</script>
<?php
	exit;
}else{



$sql_detail = db::query_limit("select WFD_ID,WFD_NAME,WFD_ORDER from WF_DETAIL where WF_MAIN_ID = '".$W."' ORDER BY WFD_ORDER",$start,1);
$rec_detail = db::fetch_array($sql_detail);

$WF_TYPE = $rec["WF_TYPE"];
	

?>
<style>
label { color:black;}
</style>
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
			<div id="my-node-parent" style="width:1080px;">
				<div id="my-node">
			<!-- Row Starts -->
							<div class="form-group row">
								<?php bsf_show_form($W,$rec_detail["WFD_ID"],array(),$WF_TYPE); ?> 
							</div>
            <!-- Row end -->
		</div>
		</div>
	</form>
        <!-- Container-fluid ends -->
     </div>
</div>
<?php include '../include/combottom_js.php';?>
 

<script type='text/javascript'>//<![CDATA[
function get_screen(){
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

       // parent.removeChild(node);
	    //alert(pngDataUrl);
		pngDataUrl = pngDataUrl.replace('data:image/png;base64,', '');
		var dataString = 'W=<?php echo $W;?>&WFD=<?php echo $rec_detail["WFD_ID"];?>&data_image='+pngDataUrl;
		$.ajax({
				 type: "POST",
				 url: "export_get_image.php",
				 data: dataString,
				 cache: false,
				 success: function(html){
					 //alert(html);
					 if(html == 'Y'){
						<?php $start++; ?>
						window.location.href='export_flow_image.php?W=<?php echo $W;?>&start=<?php echo $start;?>';
					 }
				 }
				 });

        parent.appendChild(canvas);
    };

    img.src = pngDataUrl;
});
}
setTimeout(get_screen, 5000);
</script>


<?php 
//phpinfo();
}
include '../include/combottom_admin.php'; ?>