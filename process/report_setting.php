<?php include '../include/comtop_admin.php'; ?>
<!-- gridstack css -->
<link rel="stylesheet" href="../assets/css/gridstack.css"/>
<script src="../assets/js/plotly-latest.min.js"></script>
<style>
 .grid-stack > .grid-stack-item > .grid-stack-item-content {
	overflow-y: hidden;
}
.profile-hvr {
	text-align:left;z-index:999;background:none ;
}
.social-profile {
    padding: 0px;
}
</style> 
 <link rel="stylesheet" href="../assets/plugins/charts/chartlist/css/chartlist.css" type="text/css" media="all">

    <div class="content-wrapper">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <!-- Row Starts -->
            <div class="row">
                <div class="col-sm-6">
				<div class="main-header">
					<h4>Dashboard Management</h4> 
					<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
							<li class="breadcrumb-item"><a href="home.php"><i class="icofont icofont-home"></i></a></li>
							<li class="breadcrumb-item"><a href="workflow.php">บริหาร Dashboard</a></li>
						</ol>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="f-right  m-t-50">
						<a class="btn btn-primary" href="report_setting_edit.php?W=<?php echo $W; ?>&process=add"><i class="fa fa-plus-circle"></i> New Widget</a>
						
						<button id="save-grid" type="button" class="btn btn-warning waves-effect waves-light">
								<i class="fa fa-save"></i> บันทึกตำแหน่ง
							</button>
						
						<a href="#!" onClick="PopupCenter('report_preview.php?W=<?php echo $W; ?>', 'Preview', (window.innerWidth-60), window.innerHeight) ;"  class="btn btn-info" href="#primary" ><i class="fa fa-search"></i> ดูหน้าจอ</a>
				</div>
			</div>
            </div>
            <!-- Row end -->
			<form method="post" enctype="multipart/form-data" id="form_wf">

			<!-- Row Starts -->
            <div class="row">
                <div class="col-md-12">
                            <div class="grid-stack" id="grid1" data-gs-width="12">
							<?php $sql_form = db::query("SELECT *FROM WF_WIDGET WHERE WF_MAIN_ID = '".$W."' ORDER BY WG_POS_Y ASC , WG_POS_X ASC");
					$txt_java = "";
						while($rec_form = db::fetch_array($sql_form)){ ?>
                                <div class="grid-stack-item " data-gs-id="<?php echo $rec_form['WG_ID']; ?>" data-gs-x="<?php echo $rec_form['WG_POS_X']; ?>" data-gs-y="<?php echo $rec_form['WG_POS_Y']; ?>" data-gs-width="<?php echo $rec_form['WG_POS_W']; ?>" data-gs-height="<?php echo $rec_form['WG_POS_H']; ?>" data-gs-type="<?php echo $rec_form['WG_TYPE']; ?>" data-gs-head="<?php if($rec_form['WG_HIDE_HEADER']=="Y"){ echo "0"; }else{ echo "60"; } ?>">
								
								<div class="grid-stack-item-content card social-profile <?php echo $rec_form['WG_BG']; ?>">
									<div class="profile-hvr ">
										<div class="f-right">
										<a href="../process/report_setting_edit.php?W=<?php echo $W; ?>&WG=<?php echo $rec_form['WG_ID']; ?>&process=edit"><i class="icofont icofont-ui-edit p-r-10"></i></a>
										<i class="icofont icofont-ui-delete p-r-10" onClick="deleteWG('<?php echo $rec_form['WG_ID']; ?>');"></i>
										</div>
									</div>
									<?php if($rec_form['WG_HIDE_HEADER']==""){ ?>
									<div class="card-header <?php echo $rec_form['WG_BG']; ?>"><h5 class="card-header-text"><?php if($rec_form['WG_ICON']!=""){ echo htmlspecialchars_decode($rec_form['WG_ICON'])." "; } ?><?php echo $rec_form['WG_NAME']; ?></h5></div><?php } ?>
									<div id="WG<?php echo $rec_form['WG_ID']; $txt_java .= "load_wg('".$rec_form['WG_ID']."');"; ?>" class="card-block <?php echo $rec_form['WG_BG']; ?>"><div class="loader-block">
										<svg id="loader2" viewBox="0 0 100 100">
											<circle id="circle-loader2" cx="50" cy="50" r="45"></circle>
										</svg>
									</div>

</div>
								</div>
							</div>
							<?php } ?>
                           </div> 
                </div>
            </div>
            <!-- Row end -->
			<div class="row">
				<div class="main-header">
				<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
				</div>
			</div>
			
			<textarea  name="re_order_grid" id="re_order_grid" cols="100" rows="20" style="display:none"></textarea>
		</form>

        <!-- Container-fluid ends -->
     </div>
</div>
<?php include '../include/combottom_js.php'; ?>
<!-- Scrollbar JS-->
<script src="../assets/plugins/slimscroll/js/jquery.slimscroll.js"></script>
<script src="../assets/plugins/slimscroll/js/jquery.nicescroll.min.js"></script>

<!-- gridstack js -->
<script src="../assets/js/highlight.min.js"></script>
<script src="../assets/js/lodash.js"></script>
<script src="../assets/plugins/gridstack/js/gridstack.js"></script>
<script src="../assets/plugins/gridstack/js/gridstack.jQueryUI.js"></script>
<script type="text/javascript" src="../assets/pages/dashboard4.js"></script>
<!-- Counter js 
<script src="../assets/plugins/countdown/js/waypoints.min.js"></script>
<script src="../assets/plugins/countdown/js/jquery.counterup.js"></script>
 -->
<!-- custom js -->
<script type="text/javascript">
	'use strict';
	hljs.initHighlightingOnLoad();
	$(function()
	{
		$('.grid-stack').gridstack({ 
			width: 12,
			alwaysShowResizeHandle: /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),
			resizable: {
				handles: 'e, se, s, sw, w'
			}
		});
		
		this.saveGrid = function()
		{
			this.serializedData = _.map($('.grid-stack > .grid-stack-item:visible'), function(el)
			{
				el = $(el);
				var node = el.data('_gridstack_node');
				return {
					f_id: node.id, f_offset: node.x, f_position: node.y, f_width: node.width, f_height: node.height
				};
			}, this);
			$('#re_order_grid').val(JSON.stringify(this.serializedData, null, '    '));
			
			var dataString = 'process=re_order&re_order_grid=' + $('#re_order_grid').val() + '&W=<?php echo $W; ?>';
			$.ajax({
				type: "POST",
				url: "../process/workflow_widget_arrange.php",
				data: dataString,
				cache: false,
				success: function(html)
				{
					if(html == 'Y')
					{ 
						swal({
						  title: "บันทึกตำแหน่งเรียบร้อยแล้ว", 
						  type: "success",
						  allowOutsideClick:true
						});
					}
				}
			}); 

			return false;
		}.bind(this);
		$('#save-grid').click(this.saveGrid);
		//$('.loader-block').hide();
		//$('#grid1').show();
		$('.grid-stack').on('resizestop', function (event, ui) { 
		setTimeout(function(){ wf_update(ui); }, 100);
		});
		/*$(".dasboard-4-table-scroll").slimScroll({
                height: 230,
                 allowPageScroll: false,
                 wheelStep:5,
                 color: '#000'
           });*/
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
				/*var g_height = ui.element[0].attributes.getNamedItem("data-gs-height").value*68;
				alert(g_height);
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
		var dataString = 'WG='+WG; 
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
function deleteWG(id)
  {
	var dataString = '';
	  if(confirm('คุณต้องการลบ Widget นี้ใช่หรือไม่'))
	  {

		var dataString = 'process=delete&W=<?php echo $W; ?>&WG='+id;
		  $.ajax({
				type: "GET",
				url: "../process/report_setting_edit_function.php",
				data: dataString,
				cache: false,
				success: function(html)
				{ 
					if(html != '')
					{ 
						 
						var url_back = 'report_setting.php?W=<?php echo $W; ?>';
						swal({
						  title: "ลบข้อมูลเรียบร้อยแล้ว", 
						  type: "success",
						  allowOutsideClick:true
						},
						function(isConfirm){
						  window.location.href=url_back;
						});
						
					}
				}
			}); 
	  }
  
  }
 
</script>
<?php include '../include/combottom_admin.php'; ?>