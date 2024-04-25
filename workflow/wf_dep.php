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

$sql_wfs = db::query("select * from WF_STEP_FORM where WFS_ID = '".$WFS."'");
$BSF_DET = db::fetch_array($sql_wfs);


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
					<div class="card-block">
 
							<div class="table-responsive" data-pattern="priority-columns">
								<table cellspacing="0" id="tech-companies-1" class="table table-bordered table-striped sorted_table">
									<thead>
										<tr class="bg-primary">
											<th class="text-center" width="10%"><?php echo $system_conf["wf_select"];?></th>
											<th style="width:<?php echo $tb_size[$c]; ?>;" class="text-center"><?php echo $tb_head[$c]; ?></th>
										</tr>
									</thead>
									<tbody>
									<?php
	function show_level($level){
		if($level > 1){
			for($i=0;$i<$level;$i++){
				echo "&nbsp;&nbsp;";
			}
		}
	}
	$level = 0;
	function show_dep($PARENT){
	global $t_array,$level;	
	$level ++;	
	if($PARENT == "" OR $PARENT == "0"){
		$cond = "( DEPT_PARENT_ID = '' OR DEPT_PARENT_ID IS NULL OR DEPT_PARENT_ID = '0' )";
	}else{
		$cond = "( DEPT_PARENT_ID = '".$PARENT."' )";
	}
	$sql_s = "select * from USR_DEPARTMENT where ".$cond;
					
	$sql_workflow = $sql_s.$filter."".$wfr_order; 
	$query_workflow = db::query($sql_workflow);								
	while($R=db::fetch_array($query_workflow)){
									 $pk_opt = $R['DEP_ID'];
if(trim($BSF_DET["WFS_OPTION_SHOW_FIELD"]) != ""){ $txt_opt = $BSF_DET["WFS_OPTION_SHOW_FIELD"]; }else{ $txt_opt = str_replace("|"," ",$rec_main["WF_VIEW_COL_DATA"]); }
									?><tr>
									<th class="text-center"><a href="#!" onClick="ChooseH('<?php echo $R['DEP_ID']; ?>');" class="btn btn-primary btn-mini">
														<i class="fa fa-check" style="font-size:16px;"></i>
													</a>
													<input type="hidden" id="WF_SHOW<?php echo $R['DEP_ID']; ?>" value="<?php echo $R['DEP_NAME']; ?>" />
													<input type="hidden" id="WF_VAL<?php echo $R['DEP_ID']; ?>" value="<?php echo $pk_opt; ?>" />
													</th>
													<td><?php echo show_level($level).$R['DEP_NAME']; ?></td><?php
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
				<?php 
				show_dep($R['DEP_ID']);
				}$level--; }
				show_dep('0');
				?>
									</tbody>
								</table>
							</div>
						</div> 
				</div>
			</div>
		</div>
            <!-- Workflow Row end -->
    </div>
<?php   include '../include/combottom_js_user.php';?>
<script type="text/javascript">
$('#form_wf_search_h input').on('keydown', function(e) {
    if (e.which == 13) {
		get_wfs_form('wf_hidden_content','../workflow/wf_main.php','form_wf_search_h','GET');
        e.preventDefault();
    }
});
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
		}else if ($('#<?php echo $arr_v['TARGET']; ?>').hasClass( "select2" )) { 		
		//$('select#<?php echo $arr_v['TARGET']; ?>').val($('#WF_TR'+pk+'_<?php echo $arr_v['ID']; ?>').val()).trigger("change");
		$('select#<?php echo $arr_v['TARGET']; ?>').val($('#WF_TR'+pk+'_<?php echo $arr_v['ID']; ?>').val()).trigger("change.select2");
		$('select#<?php echo $arr_v['TARGET']; ?>').on("select2:open", function(e) { 
			   $('select#<?php echo $arr_v['TARGET']; ?>').val($('#WF_TR'+pk+'_<?php echo $arr_v['ID']; ?>').val()).trigger("change");
			});
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