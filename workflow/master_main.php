<?php
$WF_TYPE = 'M';
include '../include/comtop_user.php';
foreach($_GET as $key => $val){
	$$key = conText($val);
}
$W = conText($_GET['W']);
$PARENT = conText($_GET['PARENT']);
if($W != ""){
	if(!check_permission("WFM",$W)){
		?>
		<script>
		window.location.href="index.php";
		</script>
		<?php
		exit;
	}
	$WF_SCREEN_NO = "MM#".$W;
	$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
	$rec_main = db::fetch_array($sql);
	$wf_table = $rec_main["WF_MAIN_SHORTNAME"];
	$wf_link = 'master_main.php';
	/*$sql_workflow = "select * from ".$wf_table." where 1=1  ";
	$query_workflow = db::query_limit($sql_workflow,0,10);*/

	$wf_limit = $_GET['wf_limit'] == "" ? 20 : $_GET['wf_limit'];
	if($wf_page == ''){
		$wf_page = 1;
	}
	$wf_offset = ($wf_page-1)*$wf_limit;

	$WF_TEXT_MAIN_COPY = "คัดลอก";

	if($rec_main["WF_BTN_ADD_LABEL"] != ''){ $WF_TEXT_MAIN_ADD = $rec_main["WF_BTN_ADD_LABEL"];}
	if($rec_main["WF_BTN_BACK_LABEL"] != ''){ $WF_TEXT_MAIN_BACK = $rec_main["WF_BTN_BACK_LABEL"];}
	if($rec_main["WF_BTN_CON_LABEL"] != ''){ $WF_TEXT_MAIN_EDIT = $rec_main["WF_BTN_CON_LABEL"];}
	if($rec_main["WF_BTN_STEP_LABEL"] != ''){ $WF_TEXT_MAIN_VIEW = $rec_main["WF_BTN_STEP_LABEL"];}
	if($rec_main["WF_BTN_DEL_LABEL"] != ''){ $WF_TEXT_MAIN_DEL = $rec_main["WF_BTN_DEL_LABEL"];}
	if($rec_main["WF_BTN_COPY_LABEL"] != ''){ $WF_TEXT_MAIN_COPY = $rec_main["WF_BTN_COPY_LABEL"];}

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
	if($rec_main["WF_BTN_COPY_RESIZE"] == 'Y'){ 
		$tootip_copy = 'data-toggle="tooltip"';
	}else{
	  $tootip_copy = '';
	}
	if($rec_main["WF_BTN_BACK_RESIZE"] == 'Y'){ 
		$tootip_back = 'data-toggle="tooltip"';
	}else{
	  $tootip_back = '';
	}
	$WF_LIST_DATA = "Y";

	/* Table แสดงผล */
	if(trim($rec_main['WF_VIEW_COL_HEADER']) != ''){
		$tb_head = explode("|",$rec_main['WF_VIEW_COL_HEADER']);
		$tb_data = explode("|",$rec_main['WF_VIEW_COL_DATA']);
		$tb_align = explode("|",$rec_main['WF_VIEW_COL_ALIGN']);
		$tb_size = explode("|",$rec_main['WF_VIEW_COL_SIZE']);
		$tb_order = explode("|",$rec_main['WF_VIEW_COL_ORDER']);
		$tb_class = array("C"=>"text-center","L"=>"text-left","R"=>"text-right");
		$column_n = count($tb_head);

		$WF_R_TOTAL = $rec_main['WF_R_TOTAL'];
		$total = explode("|",$WF_R_TOTAL);

	}else{
		$tb_head = array();
		$tb_data = array();
		$column_n = 0;
		$sql_step_f = db::query("SELECT * FROM WF_STEP_FORM WHERE WF_MAIN_ID='".$W."' AND WF_TYPE = '".$rec_main["WF_TYPE"]."' AND FORM_MAIN_ID != '16'  AND FORM_MAIN_ID != '10' AND (WFS_NAME != '' OR WFS_NAME IS NOT NULL) ORDER BY WFS_ORDER,WFS_OFFSET");
		while($rec_sf = db::fetch_array($sql_step_f)){
			$tb_head[$column_n] = $rec_sf["WFS_NAME"];
			$tb_data[$column_n] = '##'.$rec_sf["WFS_FIELD_NAME"].'!!';
			$column_n++;
		}
	}

	function bsf_parent($pk_id){
		global $W,$wf_table,$rec_main;
		if($pk_id > 0){
			$sql_s = "select * from ".$wf_table." where ".$rec_main['WF_FIELD_PK']." = '".$pk_id."'";
			$sql = db::query($sql_s);
			$REC = db::fetch_array($sql);
			if($REC[$rec_main['WF_PARENT_FIELD']] > 0){
				$link_text = bsf_parent($REC[$rec_main['WF_PARENT_FIELD']]);
			}
			if($rec_main['WF_PARENT_SHOW'] != ""){
				$text = bsf_show_text($W,$REC,$rec_main['WF_PARENT_SHOW'],'M');
			}else{
				$text = $REC[1];
			}
			$link_text .= '<li class="breadcrumb-item"><a href="master_main.php?W='.$W.'&PARENT='.$pk_id.'">'.$text.'</a></li>';
			return $link_text;
		}
	}

	/* Table แสดงผล */
	if($rec_main["WF_BTN_ADD_LINK"] != ''){
		$link_add = $rec_main["WF_BTN_ADD_LINK"];
	}else{
		$link_add = "master_main_edit.php?W=".$W;
		if($PARENT != ""){
			$link_add .= "&PARENT=".$PARENT; 
		}
	}

	$link_add = wf_convert_var($link_add);

	if($rec_main["WF_BTN_BACK_LINK"] != ''){
		$link_back = wf_convert_var($rec_main["WF_BTN_BACK_LINK"]);
	}else{
		if($system_conf["wf_show_menu"] == "A"){ 
			foreach($_SESSION['WF_MENU'] as $key=>$val){
				foreach($val as $key2=>$val2){
					if($val2['WF_MAIN_ID'] == $W){
						if($key > 0){
							$link_back = "../workflow/index.php?G=".$key;	
						}else{
							$link_back = "../workflow/index.php";
						}
					}
				}
			}
		}else{
			$link_back = "../workflow/index.php";
		}
	}
	?>
	<style>
	.card-header{
		border-bottom:0px;
	}
	<?php if($rec_main['WF_TABLE_HTML']=="Y"){ ?>
	.table-none-responsive{
		overflow-x:auto;
		background-color:#FFFFFF;
	}
	.table{
		background-color:#FFFFFF;
	}
	body{
		overflow-x:auto;
	}
	<?php } ?>
	</style>
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
							<h4><?php echo $system_conf["wf_not_activated"];?></h4>
						</div>
					</div>
				</div>
			<?php
			}else{?>
			
				<!-- Row Starts -->
				<div class="row" id="animationSandbox">
					<div class="col-sm-12">
						<div class="main-header">
							<div class="media m-b-12">
								<a class="media-left" href="<?php echo $link_back_home; ?>">
									<?php if($rec_main['WF_MAIN_ICON'] != ""){ echo "<img src=\"../icon/".$rec_main['WF_MAIN_ICON']."\" class=\"media-object\">"; } ?>
								</a>
								<div class="media-body">
									<h4 class="m-t-5">&nbsp;</h4>
									<h4><?php echo bsf_language("W",$rec_main['WF_MAIN_ID'],$rec_main['WF_MAIN_NAME']); ?></h4>
									<?php
									if($rec_main['WF_PARENT_USE'] != '' && $rec_main['WF_PARENT_FIELD'] != ''){
									?>
										<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
											<li class="breadcrumb-item">&nbsp; <a href="master_main.php?W=<?php echo $W; ?>"><i class="icofont icofont-home"></i></a>
											</li>
											<?php echo bsf_parent($PARENT); ?>
										</ol>
									<?php } ?>
								</div>
							</div>
							<div class="f-right">
								<?php
								if($rec_main["WF_BTN_ADD_STATUS"] == 'Y'  AND check_det_permission($W,'',$WF,'EDIT')){ ?>
								<a class="btn btn-primary active waves-effect waves-light" href="<?php echo $link_add;?>" role="button" <?php echo $tootip_add;?> title="<?php if($rec_main["WF_BTN_ADD_RESIZE"] == 'Y'){ echo $WF_TEXT_MAIN_ADD;}?>"><i class="icofont icofont-ui-add"></i> <?php if($rec_main["WF_BTN_ADD_RESIZE"] != 'Y'){ echo $WF_TEXT_MAIN_ADD;}?></a>
								<?php }
								if($rec_main["WF_BTN_BACK_STATUS"] == 'Y'){?>
								<a class="btn btn-danger waves-effect waves-light" href="<?php echo $link_back;?>" role="button" <?php echo $tootip_back;?>  title="<?php if($rec_main["WF_BTN_BACK_RESIZE"] == 'Y'){ echo $WF_TEXT_MAIN_BACK;}?>"><i class="icofont icofont-home"></i> <?php if($rec_main["WF_BTN_BACK_RESIZE"] != 'Y'){echo $WF_TEXT_MAIN_BACK;}?></a>
								<?php }?>
							</div>
						</div>
					</div>
				</div>
				<!-- Row end --> 
			
				<!--Workflow row start-->
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<?php if($rec_main["WF_MAIN_TOP_INCLUDE"] != "" AND file_exists("../plugin/".$rec_main["WF_MAIN_TOP_INCLUDE"])){ include("../plugin/".$rec_main["WF_MAIN_TOP_INCLUDE"]); } ?>
							<?php 
							$filter = "";
							$sql_search = db::query("select * from WF_STEP_FORM where WF_MAIN_ID = '".$W."' AND WF_TYPE = 'S' AND (WFS_HIDDEN_FORM IS NULL OR WFS_HIDDEN_FORM = '' OR WFS_HIDDEN_FORM = 'N') ");
							if(db::num_rows($sql_search)>0){
							?><div  id="wf_space" class="card-header">
							<form method="get" id="form_wf_search" name="form_wf_search" action="#">
								<h4><i class="icofont icofont-search-alt-2"></i> <?php echo $system_conf["conf_search"];?></h4>
								<div class="form-group row">
									<?php bsf_show_form($W,0,$_GET,'S'); ?> 
								</div>
								<div class="form-group row">
									<div class="col-md-12 text-center">
										<button type="submit" name="wf_search" id="wf_search"  class="btn btn-info"><i class="icofont icofont-search-alt-2"></i> <?php echo $system_conf["conf_search"];?></button>&nbsp;&nbsp;
										<button type="button" name="wf_reset" id="wf_reset"  class="btn btn-warning" onClick="window.location.href='master_main.php?W=<?php echo $W; ?>';"><i class="zmdi zmdi-refresh-alt"></i> <?php echo $system_conf["wf_label_reset"];?></button>
										<input type="hidden" name="W" id="W" value="<?php echo $W; ?>"><input type="hidden" name="WF_SEARCH" id="WF_SEARCH" value="Y">
									</div>
								</div>
							</form>	
							<?php
							$filter = wf_search_function($W,$_GET,$wf_table,$rec_main["WF_FIELD_PK"]);
							 ?>
							</div>
							<?php }?>
							<?php
							if(($WF_SEARCH == "Y" AND $rec_main["WF_SEARCH_SHOW"]=="Y") OR ($rec_main["WF_SEARCH_SHOW"]=="N" OR $rec_main["WF_SEARCH_SHOW"]=="")){
							
								if($wf_order == ''){
									if($rec_main["WF_MAIN_DEFAULT_ORDER"] != ""){
										$wf_order = wf_convert_var($rec_main["WF_MAIN_DEFAULT_ORDER"]);
									}else{
										$wf_order = $rec_main["WF_FIELD_PK"];
										$wf_order_type = "DESC";
									}
								}
								$wfr_order = "  ORDER BY ".$wf_order." ".$wf_order_type;

								if($rec_main["WF_MAIN_SEARCH"] == '2' AND $rec_main["WF_MAIN_SEARCH_SQL"] != ''){
									$sql_s = wf_convert_var($rec_main["WF_MAIN_SEARCH_SQL"]);
									$sql_s = str_replace("#SEARCH#",$filter,$sql_s);
									 
								}else{
									if($rec_main["WF_MAIN_SEARCH"] == '1' AND $rec_main["WF_R_SQL"] != ''){
										$cond = " AND ".wf_convert_var($rec_main["WF_R_SQL"]);
									}
									if($rec_main['WF_PARENT_USE'] != '' && $rec_main['WF_PARENT_FIELD'] != ''){//Parent-Child
										if($PARENT == ""){
											$cond .= " AND (".$rec_main['WF_PARENT_FIELD']." IS NULL OR ".$rec_main['WF_PARENT_FIELD']." = '' OR ".$rec_main['WF_PARENT_FIELD']." = '0') ";
										}else{
											$cond .= " AND (".$rec_main['WF_PARENT_FIELD']." = '".$PARENT."') ";	
										}
										
									}
									//$cond = "";
									$sql_s = "select * from ".$wf_table." where 1=1 ".$cond.$filter;
								}
					
								$sql_workflow = $sql_s.$wfr_order;
								if($rec_main["WF_SPLIT_PAGE"] == 'Y'){
									$query_workflow = db::query_limit($sql_workflow,$wf_offset,$wf_limit);
								}else{
									$query_workflow = db::query($sql_workflow);
								}
								$query_num = db::query($sql_workflow);
								$num_rows_data = db::num_rows($query_num);
								?>
								<div class="card-block">
									<?php if($num_rows_data > 0 AND $rec_main["WF_SPLIT_PAGE"] == 'Y'){ ?>
									<div class="form-group">
										<div class="col-md-1 offset-md-11">
											<select name="WF_PER_PAGE" id="WF_PER_PAGE" class="form-control" onchange="change_page_limit(this.value);">
												<?php
												if($rec_main['WF_PER_PAGE'] == "")
												{
													if($system_conf['wf_list_per_page'] == "")
													{
														$per_page_array = "20,50,100,200";
													}
													else
													{
														$per_page_array = $system_conf['wf_list_per_page'];
													}
												}
												else
												{
													$per_page_array = $rec_main['WF_PER_PAGE'];
												}
												
												$per_page_ex = explode(',', $per_page_array);
												foreach($per_page_ex as $_val)
												{
												?>
												<option value="<?php echo trim($_val); ?>" <?php echo $_GET['wf_limit']==trim($_val) ? 'selected' : ''; ?>><?php echo trim($_val); ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<?php } ?>
						
									<div class="f-right">
										<?php
										if($rec_main["WF_EXPORT_PDF"] == 'Y'){ ?>
										<a class="btn btn-danger btn-mini waves-effect waves-light" href="#export" role="button" onClick="export_data('pdfl');"><i class="fa fa-file-pdf-o"></i> ส่งออก PDF</a>
										<?php } ?>
										
										<?php if($rec_main['WF_EXPORT_WORD'] == "Y"){ ?>
										<a class="btn btn-info btn-mini waves-effect waves-light" href="#export" role="button" onClick="export_data('doc');"><i class="fa fa-file-word-o"></i> ส่งออก word</a>
										<?php } ?>
										
										<?php if($rec_main['WF_EXPORT_EXCEL'] == "Y"){ ?>
										<a class="btn btn-success btn-mini waves-effect waves-light" href="#export" role="button" onClick="export_data('xls');"><i class="fa fa-file-excel-o"></i> ส่งออก excel</a>
										<?php } ?>
									</div>
									
									<div class="table-responsive" data-pattern="priority-columns" id="export_data">
										<div class="showborder">
											<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
												<thead class="bg-primary">
													<?php
													if($rec_main['WF_REPORT_HEAD_STATUS'] == "Y"){
														$html = stripslashes($rec_main['WF_REPORT_HEADER']);
														$table = explode('<tbody>',$html);
														$th = explode('</tbody>',$table[1]);
														$th_html = str_replace('<td','<th',$th[0]);
														$th_html = str_replace('</td','</th',$th_html);
														echo $th_html;
													}else{
														?>
														<tr class="bg-primary">
															<?php
															if($rec_main["WF_VIEW_COL_SHOW_NO"]=="Y"){
															?><th style="width: 5%;" class="text-center"><nobr><?php
															$wf_order_n = $rec_main["WF_FIELD_PK"];
															if($wf_order == $rec_main["WF_FIELD_PK"]){
																
																$l_icon = order_ico($wf_order_type);
																$wf_order_type_n = convert_order($wf_order_type);
															}else{
																$wf_order_type_n = "DESC";
																$l_icon = "";
															} 
															?><a href="<?php echo create_link($wf_link,$_GET,array(),array('wf_order','wf_order_type')).'&wf_order='.$wf_order_n.'&wf_order_type='.$wf_order_type_n; ?>" class=""><?php echo $WF_TEXT_MAIN_ORDER;?> <?php echo $l_icon; ?></a></nobr></th><?php	
															}
															
															
															for($c=0;$c<$column_n;$c++){
															?><th style="width:<?php echo $tb_size[$c]; ?>;" class="text-center"><?php
															if($tb_order[$c] != ''){
																$wf_order_n = $tb_order[$c];
																?><nobr><?php
															if($wf_order == $tb_order[$c]){
																$l_icon = order_ico($wf_order_type);
																$wf_order_type_n = convert_order($wf_order_type);
															}else{ 
																$wf_order_type_n = "ASC";
																$l_icon = "";
															}
															?><a href="<?php echo create_link($wf_link,$_GET,array(),array('wf_order','wf_order_type')).'&wf_order='.$wf_order_n.'&wf_order_type='.$wf_order_type_n; ?>"><?php echo $tb_head[$c]; ?> <?php echo $l_icon; ?></a></nobr><?php
															}else{
																echo $tb_head[$c]; 
															}
															?></th><?php	
															}
															?>
															<th style="width: 10%;text-align:center;" class="td_remove"></th>
														</tr>
													<?php } ?>
												</thead>
												<tbody>
													<?php
													$no = 1+$wf_offset;
													while($WF=db::fetch_array($query_workflow)){ ?>
														<tr id="tr_wfr_<?php echo $WF[$rec_main["WF_FIELD_PK"]];?>">
															<?php
															$link_process = ($rec_main["WF_BTN_CON_LINK"] != '')? bsf_show_field($W,$WF,$rec_main["WF_BTN_CON_LINK"],'M'): "master_main_edit.php?W=".$W."&WFR=".$WF[$rec_main["WF_FIELD_PK"]];
														  
															//$link_process = bsf_show_text($W,$WF,$link_process,'M');
														  
														  
															$link_copy = ($rec_main["WF_BTN_COPY_LINK"] != '')?bsf_show_field($W,$WF,$rec_main["WF_BTN_COPY_LINK"],'M'): "master_main_copy.php?W=".$W."&WFR=".$WF[$rec_main["WF_FIELD_PK"]];
														  
															//$link_copy = bsf_show_text($W,$WF,$link_copy,'M');

															$link_process_step = ($rec_main["WF_BTN_STEP_LINK"] != '')?bsf_show_field($W,$WF,$rec_main["WF_BTN_STEP_LINK"],'M'):"master_view.php?W=".$W."&WFR=".$WF[$rec_main["WF_FIELD_PK"]];
														  
															//$link_process_step = bsf_show_text($W,$WF,$link_process_step,'M');
														  
															if($rec_main["WF_BTN_DEL_LINK"] != ''){
																$link_del = $rec_main["WF_BTN_DEL_LINK"];
																$onclick = "";
															}else{
																$link_del = "#!";
																$onclick = "onclick=\"delete_wfr('".$W."','".$WF[$rec_main["WF_FIELD_PK"]]."')\"";
															}
						  
															if($rec_main["WF_VIEW_COL_SHOW_NO"]=="Y"){
															?><td style="text-align:center;"><?php echo $no; ?></td><?php	
															}
															for($c=0;$c<$column_n;$c++){
																?><td class="<?php echo $tb_class[$tb_align[$c]]; ?>"><?php
																if($rec_main["WF_PARENT_USE"]=="2" AND $c==0){
																	echo "<a href=\"master_main.php?W=".$W."&PARENT=".$WF[$rec_main["WF_FIELD_PK"]]."\">";
																}
																echo $data_text = bsf_show_text($W,$WF,$tb_data[$c],'M'); 
																if($rec_main["WF_PARENT_USE"]=="2" AND $c==0){ echo "</a>"; }
																if($total[$c] != ''){ 
																	$total_all = str_replace(",","",$data_text);
																	$sum_amount[$c] += $total_all;
																} 
																?></td><?php	
															}
															?>
															<td style="text-align:center;" class="td_remove">
																<nobr>
																<?php if($rec_main["WF_MAIN_LIST_INCLUDE"] != "" AND file_exists("../plugin/".$rec_main["WF_MAIN_LIST_INCLUDE"])){ include("../plugin/".$rec_main["WF_MAIN_LIST_INCLUDE"]); }
																if($rec_main["WF_BTN_CON_STATUS"] == 'Y' AND check_det_permission($W,'',$WF,'VIEW')){?>
																	<a href="<?php echo $link_process;?>" class="btn btn-success btn-mini" <?php echo $tootip;?>  title="<?php if($rec_main["WF_BTN_CON_RESIZE"] == 'Y'){ echo $WF_TEXT_MAIN_EDIT;}?>" >
																		<i class="icofont icofont-ui-edit"></i> <?php if($rec_main["WF_BTN_CON_RESIZE"] != 'Y'){ echo $WF_TEXT_MAIN_EDIT;}?>
																	</a> &nbsp; 
																<?php 
																}
																if($rec_main["WF_BTN_STEP_STATUS"] == 'Y'){?>
																	<a href="<?php echo $link_process_step;?>" class="btn btn-info btn-mini" <?php echo $tootip_step;?> title="<?php if($rec_main["WF_BTN_STEP_RESIZE"] == 'Y'){echo $WF_TEXT_MAIN_VIEW;}?>"  >
																		<i class="icofont icofont-search"></i> <?php if($rec_main["WF_BTN_STEP_RESIZE"] != 'Y'){echo $WF_TEXT_MAIN_VIEW;}?>
																	</a> &nbsp;
																<?php } 
																if($rec_main["WF_BTN_COPY_STATUS"] == 'Y'){ ?>
																<a class="btn btn-primary btn-mini waves-effect waves-light" href="<?php echo $link_copy;?>" role="button" <?php echo $tootip_add;?> title="<?php if($rec_main["WF_BTN_COPY_RESIZE"] == 'Y'){ echo $WF_TEXT_MAIN_COPY;}?>"><i class="icofont icofont-copy-alt"></i> <?php if($rec_main["WF_BTN_COPY_RESIZE"] != 'Y'){ echo $WF_TEXT_MAIN_COPY;}?></a> &nbsp;
																<?php }
																if($rec_main["WF_BTN_DEL_STATUS"] == 'Y' AND check_det_permission($W,'',$WF,'DEL')){ ?>
																	<a href="<?php echo $link_del;?>" class="btn btn-danger btn-mini" <?php echo $tootip_del;?> title="<?php if($rec_main["WF_BTN_DEL_RESIZE"] == 'Y'){ echo $WF_TEXT_MAIN_DEL;}?>" <?php echo $onclick;?>>
																		<i class="icofont icofont-trash"></i> <?php if($rec_main["WF_BTN_DEL_RESIZE"] != 'Y'){ echo $WF_TEXT_MAIN_DEL;}?>
																	</a>
																<?php }
																?>
																</nobr>
															</td>
														</tr>
													<?php $no++; } ?>
													<?php
													if($rec_main["WF_R_TOTAL_USE"] == 'Y'){?>
														<tr class="bg-primary">
															<?php
															if($rec_main["WF_VIEW_COL_SHOW_NO"]=="Y"){
															?><th style="width: 5%;" class="text-center"><nobr></nobr></th>
															<?php
															}
															for($c=0;$c<$column_n;$c++){?>
																<th style="width:<?php echo $tb_size[$c]; ?>;" class="text-right"><?php if($total[$c] != ''){ echo number_format($sum_amount[$c],2);}?> 
																</th>
															
															<?php }?>
															<th style="width: 10%;text-align:center;" class="td_remove"></th>
														
														</tr>
													<?php	
													}
													?>
												</tbody>
											</table>
										</div>
									</div>
							
									<?php if($num_rows_data > 0 AND $rec_main["WF_SPLIT_PAGE"] == 'Y'){ 
									$wf_page_all = floor($num_rows_data/$wf_limit);
									if(($num_rows_data%$wf_limit) > 0){
										$wf_page_all++;
									}
									echo $WF_SPLIT_PAGE[0].' '.$wf_page.' '.$WF_SPLIT_PAGE[1].' '.$wf_page_all.' '. $WF_SPLIT_PAGE[2].' '. $WF_SPLIT_PAGE[3].' '.$num_rows_data.' '.$WF_SPLIT_PAGE[4];?>
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
											$c_start = $wf_page-5;
											if($c_start < 1){ $c_start = '1'; }
											$c_end = $wf_page+5;
											if($c_end > $wf_page_all){ $c_end = $wf_page_all; }
											for($p=$c_start;$p<=$c_end;$p++){ 
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
<?php include '../include/combottom_js_user.php';?>
<script>
function delete_wfr(w,wfr){
	if(w != '' && wfr != ''){
		swal({
			title: "",
			text: "<?php echo $system_conf["wf_delete_confirm_list"];?>",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "<?php echo $system_conf["wf_delete_confirm"];?>",
			cancelButtonText: "<?php echo $system_conf["wf_cancle"];?>",
			closeOnConfirm: true
		},
		function(){
			var dataString = 'process=del&W='+w+'&WFR='+wfr;
			$.ajax({
				type: "POST",
				url: "../workflow/workflow_del_function.php",
				data: dataString,
				cache: false,
				success: function(html){
					$('#tr_wfr_'+wfr).hide();
				} 
			});
		});
	}
}
function change_page_limit(limit)
{
	window.location.href="<?php echo create_link($wf_link,$_GET,array(),array('wf_limit','wf_page')).'&wf_page=1&wf_limit='; ?>"+limit+"";
}
function export_data(type){
	var alldata = $("#export_data").html();
	$('.td_remove').remove(); 
	
	type_doc(type); 
	export_file();
	
	$("#export_data").html(alldata);
	$("#form_wf_search").submit();
}
</script>
<?php
}
include '../include/combottom_user.php'; ?>