<?php
$WF_TYPE = 'R';
include '../include/comtop_user.php';
foreach($_GET as $key => $val){
	$$key = conText($val);
}
$W = conText($_GET['W']);
if($W != ""){
	$WF_SCREEN_NO = "RV#".$W;
	$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
	$rec_main = db::fetch_array($sql);
	$wf_table = $rec_main["WF_MAIN_SHORTNAME"];
	$WF_FIELD_PK = $rec_main["WF_FIELD_PK"];
	$TYPE = $rec_main["WF_TYPE"];
	if($rec_main['WF_MAIN_TYPE'] == "D"){
		include 'report_dash.php';
		exit;
	}
	if($rec_main['WF_MAIN_TYPE'] == "C"){
		include 'report_cal.php';
		exit;
	}
	if($rec_main['WF_MAIN_TYPE'] == "K"){
		include 'report_kan.php';
		exit;
	}
	if($rec_main['WF_MAIN_TYPE'] == 'S'){
		include 'report_serv.php';
		exit;
	}

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
	$link_add = ($rec_main["WF_BTN_ADD_LINK"] != '')?$rec_main["WF_BTN_ADD_LINK"]:"master_main_edit.php?W=".$W;
	$link_back = ($rec_main["WF_BTN_BACK_LINK"] != '')?$rec_main["WF_BTN_BACK_LINK"]:"index.php";
	
	$page_type = ($rec_main['WF_SET_PAGE_WORD'] == 1) ? 'L' : '';
	$type_doc = ($rec_main['WF_SET_PAGE_PDF'] == 1) ? 'pdfp' : 'pdfl';
	?>
	<style>
	.no-footer{margin-top: 10px !important;}
	</style>
	<!-- jqpagination css -->
	<link rel="stylesheet" type="text/css" href="../assets/plugins/jqpagination/css/jqpagination.css">
	<link rel="stylesheet" type="text/css" href="../assets/plugins/data-table/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/plugins/data-table/css/fixedColumns.bootstrap4.min.css">
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
								
								<?php if($rec_main['WF_EXPORT_PDF'] != "N"){ ?>
								<a class="btn btn-danger waves-effect waves-light" href="#export" role="button" onClick="type_doc('<?php echo $type_doc;?>'); export_file();"><i class="fa fa-file-pdf-o"></i> ส่งออก PDF</a>
								<?php } ?>
								
								<?php if($rec_main['WF_EXPORT_WORD'] != "N"){ ?>
								<a class="btn btn-info waves-effect waves-light" href="#export" role="button" onClick="type_doc('doc'); export_file();"><i class="fa fa-file-word-o"></i> ส่งออก word</a>
								<?php } ?>
								
								<?php if($rec_main['WF_EXPORT_EXCEL'] != "N"){ ?>
								<a class="btn btn-success waves-effect waves-light" href="#export" role="button" onClick="type_doc('xls'); export_file();"><i class="fa fa-file-excel-o"></i> ส่งออก excel</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<!-- Row end --> 
				<!--Report row start-->
				<div class="row" >
					<div class="showborder">
						<div class="col-md-12">
							<div class="card"> 
								<?php if($rec_main["WF_MAIN_TOP_INCLUDE"] != "" AND file_exists("../plugin/".$rec_main["WF_MAIN_TOP_INCLUDE"])){ include("../plugin/".$rec_main["WF_MAIN_TOP_INCLUDE"]); } ?> 
								<?php 
								$filter = "";
								$sql_search = db::query("select * from WF_STEP_FORM where WF_MAIN_ID = '".$W."' AND WF_TYPE = 'S' AND (WFS_HIDDEN_FORM IS NULL OR WFS_HIDDEN_FORM = '' OR WFS_HIDDEN_FORM = 'N') ");
								if(db::num_rows($sql_search)>0){
									?><form method="get" id="form_wf_search" name="form_wf_search" action="#">
									<div id="wf_space" class="card-block">
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
									</form></div>
									<?php
									//$filter = wf_search_function($W,$_GET);
								} ?>
						
								<?php
								if(($WF_SEARCH == "Y" AND $rec_main["WF_SEARCH_SHOW"]=="Y") OR ($rec_main["WF_SEARCH_SHOW"]=="N" OR $rec_main["WF_SEARCH_SHOW"]=="")){
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
											<h1 class="heading" ><?php echo bsf_show_text($W,$_GET,$rec_main["WF_DETAIL_TOPIC"],'S'); ?></h1>
										</div>
										<div style="text-align:<?php echo $align2;?>">
											<h5 class="heading" ><?php echo $rec_main["WF_DETAIL_DESC"]; ?></h5>
										</div>
										<div class="card-block" id="export_data">
											<div class="showborder">
												<div class="table-responsive" data-pattern="priority-columns">
													<?php bsf_report_show($W,'','Y'); ?>	
												</div>
											</div>
										</div>
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
		<input type="hidden" name="header_doc" id="header_doc" value="<?php echo ($header_doc ? $header_doc : ""); ?>">
		<input type="hidden" name="page_type" id="page_type" value="<?php echo ($page_type ? $page_type : ""); ?>">
		<input type="hidden" name="header_xls" id="header_xls" value="<?php echo ($header_xls ? $header_xls : ""); ?>">
		<input type="hidden" name="R_SET_FONT" id="R_SET_FONT" value="<?php echo $FONT; ?>">
	</form>
	<?php include '../include/combottom_js_user.php'; 
}
include '../include/combottom_user.php'; ?>