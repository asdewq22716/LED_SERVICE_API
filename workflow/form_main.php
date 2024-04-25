<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';
$W = conText($_GET['W']);
$WFS = conText($_GET['WFS']);
$WFD = conText($_GET['WFD']);
$WFR = conText($_GET['WFR']);
$_GET['WFR_ID'] = conText($_GET['WFR']);
$F_TEMP_ID = conText($_GET['F_TEMP_ID']);
$WF_VIEW = conText($_GET['WF_VIEW']);
$WF_LIST_DATA = 'Y';
if($WFR==""){
	$WFR = '0';
}
$WF_SEARCH = conText($_GET['WF_SEARCH']);
if($W != ""){
$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec_main = db::fetch_array($sql);
$wf_table = $rec_main["WF_MAIN_SHORTNAME"];

$sql_wfs = db::query("select * from WF_STEP_FORM where WFS_ID = '".$WFS."'");
$BSF_DET = db::fetch_array($sql_wfs);
if($BSF_DET["WFS_OPTION_COND"] != ""){
	$con = " AND ".$BSF_DET["WFS_OPTION_COND"];
}

if($BSF_DET["WFS_FORM_ADD_LABEL"] != ''){ $WF_TEXT_MAIN_ADD = $BSF_DET["WFS_FORM_ADD_LABEL"];} 
if($BSF_DET["WFS_FORM_EDIT_LABEL"] != ''){ $WF_TEXT_MAIN_EDIT = $BSF_DET["WFS_FORM_EDIT_LABEL"];} 
if($BSF_DET["WFS_FORM_DEL_LABEL"] != ''){ $WF_TEXT_MAIN_DEL = $BSF_DET["WFS_FORM_DEL_LABEL"];}



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
/* Table แสดงผล */
if(trim($BSF_DET['WF_VIEW_COL_HEADER']) != ''){
$tb_head = explode("|",$BSF_DET['WF_VIEW_COL_HEADER']);
$tb_data = explode("|",$BSF_DET['WF_VIEW_COL_DATA']);
$tb_align = explode("|",$BSF_DET['WF_VIEW_COL_ALIGN']);
$tb_size = explode("|",$BSF_DET['WF_VIEW_COL_SIZE']);
$tb_order = explode("|",$BSF_DET['WF_VIEW_COL_ORDER']);
$tb_total = explode("|",$BSF_DET['WF_VIEW_COL_TOTAL']);
$tb_trow = explode("|",$BSF_DET['WF_VIEW_COL_TROW']);
$tb_class = array("C"=>"text-center","L"=>"text-left","R"=>"text-right");
$column_n = count($tb_head);

}elseif(trim($rec_main['WF_VIEW_COL_HEADER']) != ''){
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
		$tb_head[$column_n] = bsf_language('WFS',$rec_sf["WFS_ID"],$rec_sf["WFS_NAME"],'');
		$tb_data[$column_n] = '##'.$rec_sf["WFS_FIELD_NAME"].'!!';
		$column_n++;
	}
	
}



					$filter = "";
					if($rec_main["WF_MAIN_TOP_INCLUDE"] != "" AND file_exists("../plugin/".$rec_main["WF_MAIN_TOP_INCLUDE"])){ include("../plugin/".$rec_main["WF_MAIN_TOP_INCLUDE"]); }

			if($rec_main["WF_MAIN_DEFAULT_ORDER"] != ""){
				$wf_order = " ORDER BY ".$rec_main["WF_MAIN_DEFAULT_ORDER"];
			}else{
				$wf_order = "  ORDER BY ".$rec_main["WF_FIELD_PK"]." DESC";
			}
		if($WF_VIEW != 'VIEW'){
			if($BSF_DET["WFS_FORM_ADD_STATUS"] == "Y"){
				if($BSF_DET["WFS_FORM_ADD_POPUP"] == "Y"){ 
					if($BSF_DET["WFS_FORM_POPUP"] == "P"){
						$WFS_ONCLICK = " onclick=\"PopupCenter('../workflow/form_mgt.php?W=".$W."&WFS=".$WFS."&WFD=".$WFD."&WFR_ID=".$WFR."&F_TEMP_ID=".$F_TEMP_ID."&WF_POP=P', '','900','600')\"";
					}else{
						$WFS_ONCLICK = "data-toggle=\"modal\" data-target=\"#bizModal_".$WFS."\" onclick=\"open_modal('../workflow/form_mgt.php?W=".$W."&WFS=".$WFS."&WFD=".$WFD."&WFR_ID=".$WFR."&F_TEMP_ID=".$F_TEMP_ID."', '','_".$WFS."')\"";
					}
				?><div class="f-right">
							<a class="btn btn-primary  active waves-effect waves-light" href="#!"  title="<?php if($BSF_DET["WFS_FORM_ADD_RESIZE"] == 'Y'){ echo $WF_TEXT_MAIN_ADD;}?>" <?php echo $WFS_ONCLICK; ?> ><i class="icofont icofont-ui-add"></i> <?php if($BSF_DET["WFS_FORM_ADD_RESIZE"] != 'Y'){ echo $WF_TEXT_MAIN_ADD;}?></a><small>&nbsp;</small></div><?php
				}elseif($BSF_DET["WFS_FORM_ADD_POPUP"] == "N" AND $BSF_DET["WFS_INLINE_FORM"] == ""){  ?><div class="f-right"> 
							<a class="btn btn-primary  active waves-effect waves-light" href="#!"  title="<?php if($BSF_DET["WFS_FORM_ADD_RESIZE"] == 'Y'){ echo $WF_TEXT_MAIN_ADD;}?>" onClick="get_wfs_show('wfs_show<?php echo $WFS; ?>','../workflow/form_add.php','W=<?php echo $W; ?>&WFD=<?php echo $WFD; ?>&WFS=<?php echo $WFS; ?>&WFR=<?php echo $WFR; ?>&F_TEMP_ID=<?php echo $WFR; ?>','GET','A');"><i class="icofont icofont-ui-add"></i> <?php if($BSF_DET["WFS_FORM_ADD_RESIZE"] != 'Y'){ echo $WF_TEXT_MAIN_ADD;}?></a><small>&nbsp;</small></div><?php 
				}elseif($BSF_DET["WFS_FORM_ADD_POPUP"] == "N" AND $BSF_DET["WFS_INLINE_FORM"] == "Y"){  ?><div class="text-right"> 
							<a class="btn btn-primary  active waves-effect waves-light" href="#!"  title="<?php if($BSF_DET["WFS_FORM_ADD_RESIZE"] == 'Y'){ echo $WF_TEXT_MAIN_ADD;}?>" onClick="get_wfs_show('wfs_show<?php echo $WFS; ?>','../workflow/form_add.php','W=<?php echo $W; ?>&WFD=<?php echo $WFD; ?>&WFS=<?php echo $WFS; ?>&WFR=<?php echo $WFR; ?>&F_TEMP_ID=<?php echo $WFR; ?>','GET','A');"><i class="icofont icofont-ui-add"></i> <?php if($BSF_DET["WFS_FORM_ADD_RESIZE"] != 'Y'){ echo $WF_TEXT_MAIN_ADD;}?></a><small>&nbsp;</small></div><?php }
			}
		}
		if($BSF_DET["WFS_FORM_ADD_POPUP"] == "N" AND $BSF_DET["WFS_INLINE_FORM"] == "Y"){
		?><div class="row" id="wfsflow-<?php echo $WFS; ?>" ><div class="col-md-12" id="wfs_show<?php echo $WFS; ?>"><?php bsf_load_form($W,$WFS,$WFR,$F_TEMP_ID,$WFD,$WF_VIEW); ?></div></div><?php	
		}else{
			
					?><div class="table-responsive">
								<table id="wfsflow-<?php echo $WFS; ?>" class="table table-bordered sorted_table">
									<thead class="bg-primary"><?php
			if($BSF_DET['WFS_REPORT_HEAD_STATUS'] == "Y"){
				$html = stripslashes($BSF_DET['WFS_REPORT_HEADER']);
				$table = explode('<tbody>',$html);
				$th = explode('</tbody>',$table[1]);
				$th_html = str_replace('<td','<th',$th[0]);
				$th_html = str_replace('</td','</th',$th_html);
				$th_html = str_replace('<p>','<div>',$th_html);
				$th_html = str_replace('</p>','</div>',$th_html);
				echo $th_html;
			}else{
									?>
										<tr class="bg-primary">
											<?php
											if($BSF_DET["WF_VIEW_COL_SHOW_NO"]=="Y"){
											?><th style="width: 5%;" class="text-center"><?php echo $WF_TEXT_MAIN_ORDER;?></th><?php
											}
											for($c=0;$c<$column_n;$c++){
											?><th style="width:<?php echo $tb_size[$c]; ?>;" class="text-center"><?php echo $tb_head[$c]; ?></th><?php	
											}
											if($WF_VIEW != 'VIEW'){
											if((($BSF_DET["WFS_FORM_EDIT_STATUS"] == "Y" OR $BSF_DET["WFS_FORM_DEL_STATUS"] == "Y" OR $BSF_DET["WFS_FORM_VIEW_STATUS"] == "Y") AND $BSF_DET["WFS_FORM_ADD_POPUP"]=="Y") OR ( $BSF_DET["WFS_FORM_DEL_STATUS"] == "Y" AND $BSF_DET["WFS_FORM_ADD_POPUP"]=="N")){
											?>
											<th style="width: 10%;" class="text-center"></th>
											<?php }} ?>
										</tr>
			<?php } ?>
									</thead>
									<tbody id="wfs_show<?php echo $WFS; ?>">
									 <?php bsf_load_form($W,$WFS,$WFR,$F_TEMP_ID,$WFD,$WF_VIEW); ?>
									</tbody>
									<?php if($BSF_DET['WF_VIEW_COL_TOTAL']!="" AND $BSF_DET['WF_VIEW_FOOTER'] == "Y"){ ?>
									<tfoot id="wfs-total<?php echo $WFS; ?>"  class="bg-info">
										<?php
											if($BSF_DET["WF_VIEW_COL_SHOW_NO"]=="Y"){
											?><td class="text-right"><?php if($BSF_DET["WF_TEXT_FOOTER"] != ''){ echo $BSF_DET["WF_TEXT_FOOTER"]; }else{ echo 'รวม'; } ?></td><?php
											}
											for($c=0;$c<$column_n;$c++){
											?><td class="<?php echo $tb_class[$tb_align[$c]]; ?>"></th><?php	
											}
if($WF_VIEW != 'VIEW'){
if((($BSF_DET["WFS_FORM_EDIT_STATUS"] == "Y" OR $BSF_DET["WFS_FORM_DEL_STATUS"] == "Y" OR $BSF_DET["WFS_FORM_VIEW_STATUS"] == "Y") AND $BSF_DET["WFS_FORM_ADD_POPUP"]=="Y") OR ( $BSF_DET["WFS_FORM_DEL_STATUS"] == "Y" AND $BSF_DET["WFS_FORM_ADD_POPUP"]=="N")){
											?>
											<td></td>
<?php }} ?>
									</tfoot>
									<?php } ?>
								</table>
							</div>
						<?php
		}
					}
			if($rec_main["WF_MAIN_BOTTOM_INCLUDE"] != "" AND file_exists("../plugin/".$rec_main["WF_MAIN_BOTTOM_INCLUDE"])){ 
						include("../plugin/".$rec_main["WF_MAIN_BOTTOM_INCLUDE"]); 
						}
?>
<input type="text" id="wfsflow-chk-<?php echo $WFS; ?>" value="" <?php if($BSF_DET["WFS_REQUIRED"]=="Y"){ echo "required"; } ?> style="opacity: 0;width:1px;height:1px;position:absolute;top:15px;">
<script type="text/javascript">
	function WFS_UPDATE<?php echo $WFS; ?>(){
		<?php if($BSF_DET["WFS_INLINE_FORM"]=="Y" AND $BSF_DET["WFS_FORM_ADD_POPUP"]=="N"){ ?>
		var row_num = $('#wfsflow-<?php echo $WFS; ?> blockquote');
		if(row_num.length > 0){
		$('#wfsflow-chk-<?php echo $WFS; ?>').val(row_num.length);
		}else{
		$('#wfsflow-chk-<?php echo $WFS; ?>').val('');	
		}
		<?php }else{ ?>
		var row_num = $('#wfsflow-<?php echo $WFS; ?> tbody tr');
		if(row_num.length > 0){
		$('#wfsflow-chk-<?php echo $WFS; ?>').val(row_num.length);
		}else{
		$('#wfsflow-chk-<?php echo $WFS; ?>').val('');	
		}
		<?php if($BSF_DET["WF_VIEW_COL_SHOW_NO"]=="Y"){ ?>
		for (var x = 0; x < row_num.length; x++) {
			$('#wfsflow-<?php echo $WFS; ?> tbody tr:eq('+x+') td:eq(0)').html((x+1));
		}
		<?php
			$start = 1;
		}else{
			$start = 0;
		}
		if($BSF_DET['WF_VIEW_COL_TOTAL']!="" AND $BSF_DET['WF_VIEW_FOOTER'] == "Y"){ ?>
		var total = row_num.length;
		
		var row_col = $('#wfsflow-<?php echo $WFS; ?> thead th');
		<?php for($c=0;$c<$column_n;$c++){
		if($tb_total[$c] =="C"){ ?>
		$('#wfs-total<?php echo $WFS; ?> td:eq(<?php echo ($c+$start); ?>)').html(total);
		var result = number_format(total,0);
		<?php }elseif($tb_total[$c] !=""){ 
		$CAL = substr($tb_total[$c],0,1);
		$DIGIT = substr($tb_total[$c],1,1);
		?>
		var sum_total = 0;
		var row_avg = 0;
		for (var x = 0; x < row_num.length; x++) {
			var sum_col = $('#wfsflow-<?php echo $WFS; ?> tbody tr:eq('+x+') td:eq(<?php echo ($c+$start); ?>) input').val();
			var sumc = sum_col.replace(/,/g , "");
			if(parseFloat(sumc)>0){
			sum_total = parseFloat(sum_total)+parseFloat(sumc);
			row_avg++;
			}
		}
		<?php if($CAL == "A"){ ?> 
		if(row_avg > 0){
			var result = sum_total/row_avg;
			result = number_format(result,<?php echo $DIGIT; ?>);
		}
		<?php }else{ ?>
			var result = number_format(sum_total,<?php echo $DIGIT; ?>);
		<?php } ?>
		$('#wfs-total<?php echo $WFS; ?> td:eq(<?php echo ($c+$start); ?>)').html(result);
		<?php
		}
		if($tb_trow[$c] != ''){ ?>
		if($('#<?php echo $tb_trow[$c]; ?>').length){
			$('#<?php echo $tb_trow[$c]; ?>').val(result);
			$('#<?php echo $tb_trow[$c]; ?>').trigger('blur');
		}
		<?php } } } } ?>
<?php $sql_java = db::query("SELECT WFS_INPUT_EVENT,WFS_JAVASCRIPT_EVENT FROM WF_STEP_FORM where WFS_ID = '".$WFS."' ");
$WS = db::fetch_array($sql_java);
if($WS['WFS_INPUT_EVENT'] == "change"){
 echo htmlspecialchars_decode($WS['WFS_JAVASCRIPT_EVENT'], ENT_QUOTES); 
}
?>
	}
	
	$('#wfs_show<?php echo $WFS; ?> input').blur(function (){
		WFS_UPDATE<?php echo $WFS; ?>();
	});
	$(document).ready(function() {
	WFS_UPDATE<?php echo $WFS; ?>();
	});
</script>
<?php
include '../include/combottom_js_user.php';
include '../include/combottom_user.php'; ?>