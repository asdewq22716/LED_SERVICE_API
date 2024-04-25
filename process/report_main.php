<?php
$WF_TYPE = 'R';
include '../include/comtop_admin.php';
foreach($_GET as $key => $val){
	$$key = conText($val);
}
$W = conText($_GET['W']);
if($W != ""){
$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec_main = db::fetch_array($sql);
$wf_table = $rec_main["WF_MAIN_SHORTNAME"];
$WF_FIELD_PK = $rec_main["WF_FIELD_PK"];
$TYPE = $rec_main["WF_TYPE"];
$WF_MAIN_ID = $W;
$WF_MAIN_NAME = $rec_main['WF_MAIN_NAME'];
if($rec_main["WF_MAIN_SEARCH"] == '1'){
	$sql_m = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$rec_main["WF_MAIN_ID_SEARCH"]."'");
	$rec_m = db::fetch_array($sql_m);
	$wf_table = $rec_m["WF_MAIN_SHORTNAME"];
	$WF_FIELD_PK = $rec_m["WF_FIELD_PK"];
	$TYPE = $rec_m["WF_TYPE"];
	$WF_MAIN_ID = $rec_m["WF_MAIN_ID"];
	$WF_MAIN_NAME = $rec_m['WF_MAIN_NAME'];
}



$wf_link = 'report_main.php';
$wf_limit = 20;
if($wf_page == ''){
	$wf_page = 1;
}
$wf_offset = ($wf_page-1)*$wf_limit;

if($rec_main["WF_BTN_ADD_LABEL"] != ''){ $WF_TEXT_MAIN_ADD = $rec_main["WF_BTN_ADD_LABEL"];}
if($rec_main["WF_BTN_BACK_LABEL"] != ''){ $WF_TEXT_MAIN_BACK = $rec_main["WF_BTN_BACK_LABEL"];}
if($rec_main["WF_BTN_CON_LABEL"] != ''){ $WF_TEXT_MAIN_EDIT = $rec_main["WF_BTN_CON_LABEL"];}
if($rec_main["WF_BTN_STEP_LABEL"] != ''){ $WF_TEXT_MAIN_VIEW = $rec_main["WF_BTN_STEP_LABEL"];}
if($rec_main["WF_BTN_DEL_LABEL"] != ''){ $WF_TEXT_MAIN_DEL = $rec_main["WF_BTN_DEL_LABEL"];}




if($rec_main["WF_BTN_CON_RESIZE"] == 'Y'){ 
    $tootip = 'data-toggle="tooltip"';
}else{
  $tootip = '';
}

if($rec_main["WF_BTN_STEP_RESIZE"] == 'Y'){ 
    $tootip_step = 'data-toggle="tooltip"';
}else{
  $tootip_step = '';
}

if($rec_main["WF_BTN_DEL_RESIZE"] == 'Y'){ 
    $tootip_del = 'data-toggle="tooltip"';
}else{
  $tootip_del = '';
}
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


/* Table แสดงผล */
if(trim($rec_main['WF_VIEW_COL_HEADER']) != ''){
$tb_head = explode("|",$rec_main['WF_VIEW_COL_HEADER']);
$tb_data = explode("|",$rec_main['WF_VIEW_COL_DATA']);
$tb_align = explode("|",$rec_main['WF_VIEW_COL_ALIGN']);
$tb_size = explode("|",$rec_main['WF_VIEW_COL_SIZE']);
$tb_order = explode("|",$rec_main['WF_VIEW_COL_ORDER']);
$tb_class = array("C"=>"text-center","L"=>"text-left","R"=>"text-right");
$column_n = count($tb_head);

}else{
	$tb_head = array();
	$tb_data = array();
	$column_n = 0;
	$sql_step_f = db::query("SELECT * FROM WF_STEP_FORM WHERE WF_MAIN_ID='".$W."' AND WF_TYPE = '".$rec_main["WF_TYPE"]."' ORDER BY WFS_ORDER,WFS_OFFSET");
	while($rec_sf = db::fetch_array($sql_step_f)){
		$tb_head[$column_n] = $rec_sf["WFS_NAME"];
		$tb_data[$column_n] = '##'.$rec_sf["WFS_FIELD_NAME"].'!!';
		$column_n++;
	}
	
}


/* Table แสดงผล */
$link_add = ($rec_main["WF_BTN_ADD_LINK"] != '')?$rec_main["WF_BTN_ADD_LINK"]:"master_main_edit.php?W=".$W;
$link_back = ($rec_main["WF_BTN_BACK_LINK"] != '')?$rec_main["WF_BTN_BACK_LINK"]:"index.php";
?>
 <!-- jqpagination css -->
  <link rel="stylesheet" type="text/css" href="../assets/plugins/jqpagination/css/jqpagination.css">

    <div class="content-wrapper">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
			
			<?php 
			if($rec_main["WF_MAIN_STATUS"] != 'Y'){?>
				<div class="row" id="animationSandbox">
					<div class="col-sm-12">
						<div class="main-header">
							<h4>ยังไม่เปิดใช้งาน</h4>
						</div>
					</div>
				</div>
			<?php
			}else{?>
            <!-- Row Starts -->
            <div class="row" id="animationSandbox">
				<div class="col-sm-12">
					<div class="main-header">
						<h4><?php echo $rec_main['WF_MAIN_NAME']; ?></h4>
						<ol class="breadcrumb breadcrumb-title breadcrumb-arrow"></ol>
						<div class="f-right">
							<?php 
							if($rec_main["WF_BTN_BACK_STATUS"] == 'Y'){?>
							<a class="btn btn-danger waves-effect waves-light" href="<?php echo $link_back;?>" role="button" <?php echo $tootip_back;?>  title="<?php if($rec_main["WF_BTN_BACK_RESIZE"] == 'Y'){ echo $WF_TEXT_MAIN_BACK;}?>"><i class="icofont icofont-home"></i> <?php if($rec_main["WF_BTN_BACK_RESIZE"] != 'Y'){echo $WF_TEXT_MAIN_BACK;}?></a>
							<?php }?>
							
							<a class="btn btn-danger" href="#export" onClick="type_doc('pdfl'); export_file();"><i class="fa fa-file-pdf-o"></i> ส่งออก PDF</a>
							<a class="btn btn-info" href="#export" onClick="type_doc('doc'); export_file();"><i class="fa fa-file-pdf-o"></i> ส่งออก word</a>
							<a class="btn btn-success" href="#export" onClick="type_doc('xls'); export_file();"><i class="fa fa-file-pdf-o"></i> ส่งออก excel</a>
						</div>
					</div>
				</div>
			</div>
            <!-- Row end --> 
             <!--Report row start-->
            <div class="row" id="export_data">
			<div class="showborder">
			<div class="col-md-12">
                <div class="card">
						<h5 class="card-header-text">
							<?php if($rec_main["WF_MAIN_TOP_INCLUDE"] != "" AND file_exists("../plugin/".$rec_main["WF_MAIN_TOP_INCLUDE"])){ include("../plugin/".$rec_main["WF_MAIN_TOP_INCLUDE"]); } ?>
						</h5>
					<?php 
						$filter = "";
							$sql_search = db::query("select * from WF_STEP_FORM where WF_MAIN_ID = '".$W."' AND WF_TYPE = 'S' AND (WFS_HIDDEN_FORM IS NULL OR WFS_HIDDEN_FORM = '' OR WFS_HIDDEN_FORM = 'N') ");
							if(db::num_rows($sql_search)>0){
							?><form method="get" id="form_wf_search" name="form_wf_search" action="#">
							<h4><i class="icofont icofont-search-alt-2"></i> ค้นหา</h4>
									<div class="form-group row">
									<?php bsf_show_form($W,0,$_GET,'S'); ?> 
									</div>
									<div class="form-group row">
										<div class="col-md-12 text-center">
											<button type="submit" name="wf_search" id="wf_search"  class="btn btn-info"><i class="icofont icofont-search-alt-2"></i> ค้นหา</button>
											&nbsp;&nbsp;
											<button type="button" name="wf_reset" id="wf_reset"  class="btn btn-warning" onClick="window.location.href='master_main.php?W=<?php echo $W; ?>';"><i class="zmdi zmdi-refresh-alt"></i> <?php echo $system_conf["wf_label_reset"];?></button>
											<input type="hidden" name="W" id="W" value="<?php echo $W; ?>"><input type="hidden" name="WF_SEARCH" id="WF_SEARCH" value="Y">
										</div>
									</div>
							</form>	
							<?php
							$filter = wf_search_function($W,$_GET);
							} ?>
					
				<?php
				if(($WF_SEARCH == "Y" AND $rec_main["WF_SEARCH_SHOW"]=="Y") OR ($rec_main["WF_SEARCH_SHOW"]=="N" OR $rec_main["WF_SEARCH_SHOW"]=="")){
				
					if($wf_order == ''){
						if($rec_main["WF_MAIN_DEFAULT_ORDER"] != ""){
							$wf_order = $rec_main["WF_MAIN_DEFAULT_ORDER"];
						}else{
							$wf_order = $WF_FIELD_PK;
							$wf_order_type = "DESC";
						}
					}
					
					$wfr_order = "  ORDER BY ".$wf_order." ".$wf_order_type;
					
					/*$sql_count = db::query("SELECT COUNT(".$rec_main["WF_FIELD_PK"].") AS C FROM ".$wf_table." WHERE 1=1 ".$filter);
					$C = db::fetch_array($sql_count);
					$wf_rows = $C["C"];*/
					if($rec_main["WF_MAIN_TYPE"] != 'WH'){
						
						if($rec_main["WF_MAIN_SEARCH"] == '1'){
							$sql_workflow = "select * from ".$wf_table." where 1=1 ".$filter."".$wfr_order;
							
						}elseif($rec_main["WF_MAIN_SEARCH"] == '2'){
							
							$sql_workflow = $rec_main["WF_MAIN_SEARCH_SQL"];
						}
					}
					
					
					$query_workflow = db::query_limit($sql_workflow,$wf_offset,$wf_limit);
			?>
					<div class="card-block">
					<?php
						if($rec_main["WF_DETAIL_TOPIC_ALIGN"] == 'L'){ $align = 'left';}
						elseif($rec_main["WF_DETAIL_TOPIC_ALIGN"] == 'C'){ $align = 'center';}
						elseif($rec_main["WF_DETAIL_TOPIC_ALIGN"] == 'R'){ $align = 'right';}
						
						if($rec_main["WF_DETAIL_DESC_ALIGN"] == 'L'){ $align2 = 'left';}
						elseif($rec_main["WF_DETAIL_DESC_ALIGN"] == 'C'){ $align2 = 'center';}
						elseif($rec_main["WF_DETAIL_DESC_ALIGN"] == 'R'){ $align2 = 'right';}
						
					?>
							<div style="text-align:<?php echo $align;?>">
								<h1 class="heading" ><?php echo $rec_main["WF_DETAIL_TOPIC"]; ?></h1>
							</div>
							<div style="text-align:<?php echo $align2;?>">
								<h5 class="heading" ><?php echo $rec_main["WF_DETAIL_DESC"]; ?></h5>
							</div>
							
							<div class="table-responsive" data-pattern="priority-columns">
								<table cellspacing="0" id="tech-companies-1" class="table table-bordered table-striped sorted_table">
									<thead>
										<tr class="bg-primary">
											<?php
											if($rec_main["WF_VIEW_COL_SHOW_NO"]=="Y"){
											?><th style="width: 5%;" class="text-center"><nobr><?php 
											?>ลำดับ </nobr></th><?php	
											}
											
											
											for($c=0;$c<$column_n;$c++){
											?><th style="width:<?php echo $tb_size[$c]; ?>;" class="text-center"><?php
											
												echo $tb_head[$c]; 
											?></th><?php	
											}
											?>
										</tr>
									</thead>
									<tbody>
									<?php
									$no = 1;
									while($R=db::fetch_array($query_workflow)){ ?>
										<tr id="tr_wfr_<?php echo $R[$WF_FIELD_PK];?>">
											<?php
                      $link_process = ($rec_main["WF_BTN_CON_LINK"] != '')?$rec_main["WF_BTN_CON_LINK"]: "master_main_edit.php?W=".$W."&WFR=".$R[$WF_FIELD_PK];
                      $link_process_step = ($rec_main["WF_BTN_STEP_LINK"] != '')?$rec_main["WF_BTN_STEP_LINK"]:"workflow_step.php?W=".$W."&WFR=".$R[$WF_FIELD_PK];
                      
					  if($rec_main["WF_BTN_DEL_LINK"] != ''){
						   $link_del = $rec_main["WF_BTN_DEL_LINK"];
						   $onclick = "";
					  }else{
						  $link_del = "#!";
						  $onclick = "onclick=\"delete_wfr('".$W."','".$R[$WF_FIELD_PK]."')\"";
					  }

						if($rec_main["WF_VIEW_COL_SHOW_NO"]=="Y"){
						?><td class="text-center"><?php echo $no; ?></td><?php	
						}
						for($c=0;$c<$column_n;$c++){
							if($rec_main["WF_MAIN_SEARCH"] == '1'){
						?><td class="<?php echo $tb_class[$tb_align[$c]]; ?>"><?php echo bsf_show_text($WF_MAIN_ID,$R,$tb_data[$c],$TYPE); ?></td><?php	
							}elseif($rec_main["WF_MAIN_SEARCH"] == '2'){?>
							<td class="<?php echo $tb_class[$tb_align[$c]]; ?>"><?php echo bsf_show_field($WF_MAIN_ID,$R,$tb_data[$c],$TYPE); ?></td>
							<?php
							}
						}?>
										</tr>
									<?php $no++; } ?>
									</tbody>
								</table>
							</div>
							
							<?php if($wf_rows > 0){ 
							$wf_page_all = floor($wf_rows/$wf_limit);
							if(($wf_rows%$wf_limit) > 0){
								$wf_page_all++;
							}
							?>หน้าที่ <?php echo $wf_page; ?> จากทั้งหมด <?php echo $wf_page_all; ?> หน้า
							<div aria-label="page list small" class="f-right">
							  <ul class="pagination pagination-sm">
								<?php if($wf_page > 1){ ?>
								<li class="page-item">
								  <a class="page-link waves-effect" href="<?php echo $link = create_link($wf_link,$_GET,array(),array('wf_page')).'&wf_page=1'; ?>" aria-label="First">
									<span aria-hidden="true"><i class="zmdi zmdi-fast-rewind"></i></span>
									<span class="sr-only">First</span>
								  </a>
								</li>
								<li class="page-item">
								  <a class="page-link waves-effect" href="<?php echo $link = create_link($wf_link,$_GET,array(),array('wf_page')).'&wf_page='.($wf_page-1); ?>" aria-label="Previous">
									<span aria-hidden="true"><i class="zmdi zmdi-skip-previous"></i></span>
									<span class="sr-only">Previous</span>
								  </a>
								</li>
								<?php
								}
								for($p=1;$p<=$wf_page_all;$p++){ 
									if($wf_page == $p){
										$act = ' active'; 
										$link = '#!';
									}else{
										$act = ''; 
										$link = create_link($wf_link,$_GET,array(),array('wf_page')).'&wf_page='.($p);
									}
								?>
								<li class="page-item<?php echo $act; ?>"><a class="page-link waves-effect" href="<?php echo $link; ?>" role="button"><?php echo $p; ?></a></li>
							<?php } 
							if($wf_page != $wf_page_all){ ?>
								<li class="page-item">
								  <a class="page-link waves-effect" href="<?php echo $link = create_link($wf_link,$_GET,array(),array('wf_page')).'&wf_page='.($wf_page+1); ?>" aria-label="Next">
									<span aria-hidden="true"><i class="zmdi zmdi-skip-next"></i></span>
									<span class="sr-only">Next</span>
								  </a>
								</li>
								<li class="page-item">
								  <a class="page-link waves-effect" href="<?php echo $link = create_link($wf_link,$_GET,array(),array('wf_page')).'&wf_page='.$wf_page_all; ?>" aria-label="Last">
									<span aria-hidden="true"><i class="zmdi zmdi-fast-forward"></i></span>
									<span class="sr-only">Last</span>
								  </a>
								</li>
							<?php } ?>
							  </ul>
							</div>
							<?php } ?>
						</div>
					<?php }?>
						<?php if($rec_main["WF_MAIN_BOTTOM_INCLUDE"] != "" AND file_exists("../plugin/".$rec_main["WF_MAIN_BOTTOM_INCLUDE"])){ 
						echo "<div class=\"card-block\">";
						include("../plugin/".$rec_main["WF_MAIN_BOTTOM_INCLUDE"]); 
						echo "</div>";
						} ?>
				</div>
			</div>
		</div>
		</div>
            <!-- Workflow Row end -->
		<?php }?>
    </div>

        <!-- Container-fluid ends -->
     </div>
</div>
<form method="post" id="form_export" name="form_export" target="_blank"  action="export_report.php">
        <input type="hidden" name="export_content" id="export_content" />
        <input type="hidden" name="export_type" id="export_type" value="" />
        <input type="hidden" name="margin_left" id="margin_left" value="<?php echo ($margin_left ? $margin_left : "15"); ?>">
        <input type="hidden" name="margin_right" id="margin_right" value="<?php echo ($margin_right ? $margin_right : "15"); ?>">
        <input type="hidden" name="margin_top" id="margin_top" value="<?php echo ($margin_top ? $margin_top : "16"); ?>">
        <input type="hidden" name="margin_bottom" id="margin_bottom" value="<?php echo ($margin_bottom ? $margin_bottom : "16"); ?>">
        <input type="hidden" name="margin_header" id="margin_header " value="<?php echo ($margin_header ? $margin_header : "16"); ?>">
        
		<input type="hidden" name="margin_footer" id="margin_footer" value="<?php echo ($margin_footer ? $margin_footer : "9"); ?>"> 
		
		<input type="hidden" name="header_pdf" id="header_pdf" value="<?php echo ($header_pdf ? $header_pdf : ""); ?>">
		
		
		
		<input type="hidden" name="R_SET_FONT" id="R_SET_FONT" value="<?php echo $FONT; ?>">
 </form>
<?php include '../include/combottom_js.php'; 
}
include '../include/combottom_admin.php'; ?>