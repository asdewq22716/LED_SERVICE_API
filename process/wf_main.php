<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';
$W = conText($_GET['W']);
$WFS = conText($_GET['WFS']);
$WFR = conText($_GET['WFR']);
$WF_SEARCH = conText($_GET['WF_SEARCH']);
foreach($_GET as $key => $val){
	$$key = conText($val);
}
if($W != ""){
$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec_main = db::fetch_array($sql);
$wf_table = $rec_main["WF_MAIN_SHORTNAME"];

$sql_wfs = db::query("select * from WF_STEP_FORM where WFS_ID = '".$WFS."'");
$BSF_DET = db::fetch_array($sql_wfs);

if($BSF_DET["WFS_OPTION_COND"] != ""){
	$sql_s = db::query("select WF_FIELD_PK,WF_MAIN_SHORTNAME from WF_MAIN where WF_MAIN_ID = '".$BSF_DET["WF_MAIN_ID"]."'");
	$rec_main_s = db::fetch_array($sql_s);
	$wf_table_s = $rec_main_s["WF_MAIN_SHORTNAME"];
	$sql_res = db::query("select * from ".$wf_table_s." where ".$rec_main_s["WF_FIELD_PK"]." = '".$WFR."'");
	$WF = db::fetch_array($sql_res);
	$con = " AND ".bsf_show_text($BSF_DET["WF_MAIN_ID"],$WF,$BSF_DET["WFS_OPTION_COND"]);
}
$t_array = array();
$t=0;
$sql_wft = db::query("select * from WF_STEP_THROW where WFS_ID = '".$WFS."' ORDER BY WFST_ID ASC");
while($THROW = db::fetch_array($sql_wft)){
	if($THROW['WFST_VALUE'] != ''){
	$t_array[$t]['ID'] = $THROW['WFST_ID'];
	$t_array[$t]['SOURCE'] = $THROW['WFST_NAME'];
	$t_array[$t]['TARGET'] = $THROW['WFST_VALUE'];
	$t_array[$t]['TYPE'] = $THROW['WFST_TYPE'];
	$t++;
	}
}
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
$wf_link = '../workflow/wf_main.php';
$wf_limit = 20;
if($wf_page == ''){
	$wf_page = 1;
}
$wf_offset = ($wf_page-1)*$wf_limit;

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
	$sql_step_f = db::query("SELECT * FROM WF_STEP_FORM WHERE WF_MAIN_ID='".$W."' AND WF_TYPE = '".$rec_main["WF_TYPE"]."' AND FORM_MAIN_ID != '16'  AND FORM_MAIN_ID != '10' AND (WFS_NAME != '' OR WFS_NAME IS NOT NULL) ORDER BY WFS_ORDER,WFS_OFFSET");
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
<style>
.card-header{
	border-bottom:0px;
}
</style>
            <!-- Row Starts -->
            <div class="row" id="animationSandbox">
				<div class="col-sm-12">
					<div class="main-header">
						<div class="media m-b-12">
							<a class="media-left" >
								<?php if($rec_main['WF_MAIN_ICON'] != ""){ echo "<img src=\"../icon/".$rec_main['WF_MAIN_ICON']."\" class=\"media-object\">"; } ?>
							</a>
							<div class="media-body">
								<h4 class="m-t-5">&nbsp;</h4>
								<h4><?php echo $rec_main['WF_MAIN_NAME']; ?></h4>
							</div>
						</div> 
					</div>
					
				</div>
			</div>
            <!-- Row end --> 
             <!--Workflow row start-->
                <div class="row">
					<div class="col-md-12">
                    <div class="card">
						<div class="card-header">
						<?php 
					$filter = "";
					if($rec_main["WF_MAIN_TOP_INCLUDE"] != "" AND file_exists("../plugin/".$rec_main["WF_MAIN_TOP_INCLUDE"])){ include("../plugin/".$rec_main["WF_MAIN_TOP_INCLUDE"]); }
						$sql_search = db::query("select * from WF_STEP_FORM where WF_MAIN_ID = '".$W."' AND WF_TYPE = 'S'");
						if(db::num_rows($sql_search)>0){
						?><form method="get" id="form_wf_search" name="form_wf_search" action="#" ">
						<h4><i class="icofont icofont-search-alt-2"></i> <?php echo $system_conf["conf_search"];?></h4>
								<div class="form-group row">
								<?php bsf_show_form($W,0,$_GET,'S'); ?>
								</div>
								<div class="form-group row">
									<div class="col-md-12 text-center">
										<button type="button" name="wf_search" id="wf_search"  class="btn btn-info" onClick="get_wfs_form('wf_hidden_content','../workflow/wf_main.php','form_wf_search','GET');"><i class="icofont icofont-search-alt-2"></i> <?php echo $system_conf["conf_search"];?></button>
										&nbsp;&nbsp;
										<a href="#!" name="wf_reset" id="wf_reset"  class="btn btn-warning" onClick="get_wfs_show('wf_hidden_content','../workflow/wf_main.php','W=<?php echo $W; ?>&WFS=<?php echo $WFS; ?>&WFR=<?php echo $WFR; ?>','GET');" ><i class="zmdi zmdi-refresh-alt"></i> <?php echo $system_conf["wf_label_reset"];?></a>
										<input type="hidden" name="W" id="W" value="<?php echo $W; ?>"><input type="hidden" name="WFS" id="WFS" value="<?php echo $WFS; ?>"><input type="hidden" name="WFR" id="WFR" value="<?php echo $WFR; ?>"><input type="hidden" name="WF_SEARCH" id="WF_SEARCH" value="Y">
									</div>
								</div>
						</form>	
						<?php
						$filter = wf_search_function($W,$_GET);
						} ?>
						</div>
				<?php 
		if(($WF_SEARCH == "Y" AND $rec_main["WF_SEARCH_SHOW"]=="Y") OR ($rec_main["WF_SEARCH_SHOW"]=="N" OR $rec_main["WF_SEARCH_SHOW"]=="")){
			/*if($rec_main["WF_MAIN_DEFAULT_ORDER"] != ""){
				$wf_order = " ORDER BY ".$rec_main["WF_MAIN_DEFAULT_ORDER"];
			}else{
				$wf_order = "  ORDER BY ".$rec_main["WF_FIELD_PK"]." DESC";
			}
			$sql_workflow = "select * from ".$wf_table." where 1=1 ".$con.$filter."".$wf_order;
			$query_workflow = db::query($sql_workflow);*/
					if($wf_order == ''){
						if($rec_main["WF_MAIN_DEFAULT_ORDER"] != ""){
							$wf_order = $rec_main["WF_MAIN_DEFAULT_ORDER"];
						}else{
							$wf_order = $rec_main["WF_FIELD_PK"];
							$wf_order_type = "DESC"; 
						}
					}
					
					$wfr_order = "  ORDER BY ".$wf_order." ".$wf_order_type;
					
					if($rec_main["WF_MAIN_SEARCH"] == '2' AND $rec_main["WF_MAIN_SEARCH_SQL"] != ''){
						$sql_s = wf_convert_var($rec_main["WF_MAIN_SEARCH_SQL"]);
						
					}else{
						if($rec_main["WF_MAIN_SEARCH"] == '1' AND $rec_main["WF_R_SQL"] != ''){
							$cond = " AND ".wf_convert_var($rec_main["WF_R_SQL"]);
						}else{
							$cond = "";
						}
						$sql_s = "select * from ".$wf_table." where 1=1 ".$cond;
					}
					
					$sql_workflow = $sql_s.$filter."".$wfr_order;
					if($rec_main["WF_SPLIT_PAGE"] == 'Y'){
						$query_workflow = db::query_limit($sql_workflow,$wf_offset,$wf_limit);
						
					}else{
						$query_workflow = db::query($sql_workflow);
					}
					$query_num = db::query($sql_workflow);
					$num_rows_data = db::num_rows($query_num);
					?>
					<div class="card-block">
 
							<div class="table-responsive" data-pattern="priority-columns">
								<table cellspacing="0" id="tech-companies-1" class="table table-bordered table-striped sorted_table">
									<thead>
										<tr class="bg-primary">
											<th class="text-center"><?php echo $system_conf["wf_select"];?></th>
											<?php
											if($rec_main["WF_VIEW_COL_SHOW_NO"]=="Y"){
											?><th style="width: 5%;" class="text-center"><?php echo $WF_TEXT_MAIN_ORDER;?></th><?php	
											}
											for($c=0;$c<$column_n;$c++){
											?><th style="width:<?php echo $tb_size[$c]; ?>;" class="text-center"><?php echo $tb_head[$c]; ?></th><?php	
											}
											?>
										</tr>
									</thead>
									<tbody>
									<?php
									$no = 1+$wf_offset;
									while($R=db::fetch_array($query_workflow)){ 
									
if(trim($BSF_DET["WFS_OPTION_SHOW_VALUE"]) != ""){ $pk_opt = bsf_show_text($W,$R,$BSF_DET["WFS_OPTION_SHOW_VALUE"],$rec_main["WF_TYPE"]); }else{ $pk_opt = $R[$rec_main["WF_FIELD_PK"]]; }
if(trim($BSF_DET["WFS_OPTION_SHOW_FIELD"]) != ""){ $txt_opt = $BSF_DET["WFS_OPTION_SHOW_FIELD"]; }else{ $txt_opt = str_replace("|"," ",$rec_main["WF_VIEW_COL_DATA"]); }
									?>
										<tr>
											<th class="text-center"><a href="#!" onClick="ChooseH('<?php echo $R[$rec_main["WF_FIELD_PK"]]; ?>');" class="btn btn-primary btn-mini">
														<i class="fa fa-check" style="font-size:16px;"></i>
													</a>
													<input type="hidden" id="WF_SHOW<?php echo $R[$rec_main["WF_FIELD_PK"]]; ?>" value="<?php echo bsf_show_text($W,$R,$txt_opt,$rec_main["WF_TYPE"]); ?>" />
													<input type="hidden" id="WF_VAL<?php echo $R[$rec_main["WF_FIELD_PK"]]; ?>" value="<?php echo $pk_opt; ?>" />
													</th>
											<?php
											if($rec_main["WF_VIEW_COL_SHOW_NO"]=="Y"){
											?><td class="text-center"><?php echo $no; ?></td><?php	
											}
											for($c=0;$c<$column_n;$c++){
											?><td class="<?php echo $tb_class[$tb_align[$c]]; ?>"><?php echo bsf_show_text($W,$R,$tb_data[$c],$rec_main["WF_TYPE"]); ?></td><?php	
											}
											foreach($t_array as $arr_v){
												if($arr_v['TYPE'] == ""){
													$t_value = bsf_show_text($W,$R,$arr_v['SOURCE'],$rec_main["WF_TYPE"]);
												}else{
													$t_value = bsf_show_field($W,$R,$arr_v['SOURCE'],$rec_main["WF_TYPE"]);
												}
											?><input type="hidden" id="WF_TR<?php echo $R[$rec_main["WF_FIELD_PK"]]; ?>_<?php echo $arr_v['ID']; ?>" value="<?php echo $t_value; ?>" /><?php	
											}
											?>
										</tr>
									<?php $no++; } ?>
									</tbody>
								</table>
							</div>
					 
							<?php if($num_rows_data > 0 AND $rec_main["WF_SPLIT_PAGE"] == 'Y'){ 
							$wf_page_all = floor($num_rows_data/$wf_limit);
							if(($num_rows_data%$wf_limit) > 0){
								$wf_page_all++;
							}
							echo $WF_SPLIT_PAGE[0].' '.$wf_page.' '.$WF_SPLIT_PAGE[1].' '.$wf_page_all.' '. $WF_SPLIT_PAGE[2].' '. $WF_SPLIT_PAGE[3].' '.$num_rows_data.' '.$WF_SPLIT_PAGE[4];
							?>
							<div aria-label="page list small" class="f-right">
							  <ul class="pagination pagination-sm">
								<?php if($wf_page > 1){ ?>
								<li class="page-item">
								  <a class="page-link waves-effect" href="#f" onClick="get_wfs_show('wf_hidden_content','<?php echo $wf_link; ?>','<?php $link = create_link($wf_link,$_GET,array(),array('wf_page')).'&wf_page=1'; echo substr($link, 2); ?>','GET');" aria-label="First">
									<span aria-hidden="true"><i class="zmdi zmdi-fast-rewind"></i></span>
									<span class="sr-only">First</span>
								  </a>
								</li>
								<li class="page-item">
								  <a class="page-link waves-effect" href="#p" onClick="get_wfs_show('wf_hidden_content','<?php echo $wf_link; ?>','<?php $link = create_link($wf_link,$_GET,array(),array('wf_page')).'&wf_page='.($wf_page-1); echo substr($link, 2); ?>','GET');" aria-label="Previous">
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
										$link = '';
									}else{
										$act = ''; 
										$link = create_link('',$_GET,array(),array('wf_page')).'&wf_page='.($p);
										$link = substr($link, 2);
									}
 
								?>
								<li class="page-item<?php echo $act; ?>"><a class="page-link waves-effect" href="#f"  onClick="get_wfs_show('wf_hidden_content','<?php echo $wf_link; ?>','<?php echo $link; ?>','GET');" role="button"><?php echo $p; ?></a></li>
							<?php } 
							if($wf_page != $wf_page_all){ ?>
								<li class="page-item">
								  <a class="page-link waves-effect" href="#n" onClick="get_wfs_show('wf_hidden_content','<?php echo $wf_link; ?>','<?php $link = create_link($wf_link,$_GET,array(),array('wf_page')).'&wf_page='.($wf_page+1); echo substr($link, 2); ?>','GET');" aria-label="Next">
									<span aria-hidden="true"><i class="zmdi zmdi-skip-next"></i></span>
									<span class="sr-only">Next</span>
								  </a>
								</li>
								<li class="page-item">
								  <a class="page-link waves-effect" href="#l" onClick="get_wfs_show('wf_hidden_content','<?php echo $wf_link; ?>','<?php $link = create_link($wf_link,$_GET,array(),array('wf_page')).'&wf_page='.$wf_page_all; echo substr($link, 2); ?>','GET');" aria-label="Last">
									<span aria-hidden="true"><i class="zmdi zmdi-fast-forward"></i></span>
									<span class="sr-only">Last</span>
								  </a>
								</li>
							<?php } ?>
							  </ul>
							</div>
							<?php } ?>
							
							
							
						</div>
						<?php
					}
			if($rec_main["WF_MAIN_BOTTOM_INCLUDE"] != "" AND file_exists("../plugin/".$rec_main["WF_MAIN_BOTTOM_INCLUDE"])){ 
						echo "<div class=\"card-block\">";
						include("../plugin/".$rec_main["WF_MAIN_BOTTOM_INCLUDE"]); 
						echo "</div>";
						} ?>
				</div>
			</div>
		</div>
            <!-- Workflow Row end -->
    </div>
<?php   include '../include/combottom_js_user.php';?>
<script type="text/javascript">
function ChooseH(pk){
	$('#<?php echo $BSF_DET["WFS_FIELD_NAME"]; ?>').val($('#WF_VAL'+pk).val());
	$('#WFH_<?php echo $BSF_DET["WFS_FIELD_NAME"]; ?>_SHOW').html($('#WF_SHOW'+pk).val());
	<?php
	foreach($t_array as $arr_v){
	?>
	if($('#<?php echo $arr_v['TARGET']; ?>').length){
		if ($('#<?php echo $arr_v['TARGET']; ?>').hasClass( "select2-amphur" )) {
			
			$('select#<?php echo $arr_v['TARGET']; ?>').on("select2:open", function(e) { 
			   $('select#<?php echo $arr_v['TARGET']; ?>').val($('#WF_TR'+pk+'_<?php echo $arr_v['ID']; ?>').val()).trigger("change");
			});
		}else if ($('#<?php echo $arr_v['TARGET']; ?>').hasClass( "select2-tambon" )) {
			$('select#<?php echo $arr_v['TARGET']; ?>').on("select2:open", function(e) { 
			   $('select#<?php echo $arr_v['TARGET']; ?>').val($('#WF_TR'+pk+'_<?php echo $arr_v['ID']; ?>').val()).trigger("change");
			});

		}else if ($('#<?php echo $arr_v['TARGET']; ?>').hasClass( "select2-province" )) { 
		$('select#<?php echo $arr_v['TARGET']; ?>').val($('#WF_TR'+pk+'_<?php echo $arr_v['ID']; ?>').val()).trigger("change");
		}else{
		$('#<?php echo $arr_v['TARGET']; ?>').val($('#WF_TR'+pk+'_<?php echo $arr_v['ID']; ?>').val());
		}
	}
	<?php	
	}
	?>
	$('#<?php echo $BSF_DET["WFS_FIELD_NAME"]; ?>').trigger("change");
	$('#bizModal3').modal('hide'); 
	
}
</script>
<?php
}
include '../include/combottom_user.php'; ?>