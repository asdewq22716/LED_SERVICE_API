<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php'; 
$WFS = conText($_GET['WFS']);
$VAL = conText($_GET['VAL']);

if($WFS != ""){


$sql_wfs = db::query("select * from WF_STEP_FORM where WFS_ID = '".$WFS."'");
$BSF_DET = db::fetch_array($sql_wfs);

$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$BSF_DET["WFS_OPTION_SELECT_DATA"]."'");
$rec_main = db::fetch_array($sql);
$wf_table = $rec_main["WF_MAIN_SHORTNAME"];

$W = $BSF_DET["WFS_OPTION_SELECT_DATA"];
?>
<script type="text/javascript">						 
				<?php 

					
					if(trim($BSF_DET["WFS_OPTION_SHOW_VALUE"]) != ""){
						$opt_where .= " AND ".bsf_gen_select(trim($BSF_DET["WFS_OPTION_SHOW_VALUE"]))." = '".$VAL."'";
					}else{
						$opt_where .= " AND ".$rec_main["WF_FIELD_PK"]." = '".$VAL."'";
					}
					$sql_workflow = "select * from ".$wf_table." where 1=1 ".$opt_where;
					

					$query_workflow = db::query($sql_workflow); 
					$num_rows_data = db::num_rows($query_workflow);
					if($num_rows_data > 0){
						$WF=db::fetch_array($query_workflow);
						$sql_wft = db::query("select * from WF_STEP_THROW where WFS_ID = '".$WFS."' ORDER BY WFST_ID ASC");
						while($THROW = db::fetch_array($sql_wft)){
							if($THROW['WFST_VALUE'] != ''){
							if($THROW['WFST_TYPE'] == ""){
								$t_value = bsf_show_text($W,$WF,$THROW['WFST_NAME'],$rec_main["WF_TYPE"]);
							}else{
								$t_value = bsf_show_field($W,$WF,$THROW['WFST_NAME'],$rec_main["WF_TYPE"]);
							}
							?>
	if($('#<?php echo $THROW['WFST_VALUE']; ?>').length){
		if ($('#<?php echo $THROW['WFST_VALUE']; ?>').hasClass( "select2-amphur" )) {
			
			$('select#<?php echo $THROW['WFST_VALUE']; ?>').on("select2:open", function(e) { 
			   $('select#<?php echo $THROW['WFST_VALUE']; ?>').val('<?php echo $t_value; ?>').trigger("change");
			});
		}else if ($('#<?php echo $THROW['WFST_VALUE']; ?>').hasClass( "select2-tambon" )) {
			$('select#<?php echo $THROW['WFST_VALUE']; ?>').on("select2:open", function(e) { 
			   $('select#<?php echo $THROW['WFST_VALUE']; ?>').val('<?php echo $t_value; ?>').trigger("change");
			});

		}else if ($('#<?php echo $THROW['WFST_VALUE']; ?>').hasClass( "select2-province" )) { 
		$('select#<?php echo $THROW['WFST_VALUE']; ?>').val('<?php echo $t_value; ?>').trigger("change");
		}else if ($('#<?php echo $THROW['WFST_VALUE']; ?>').hasClass( "select2" )) { 
		$('select#<?php echo $THROW['WFST_VALUE']; ?>').val('<?php echo $t_value; ?>').trigger("change.select2");
		$('select#<?php echo $THROW['WFST_VALUE']; ?>').on("select2:open", function(e) { 
			   $('select#<?php echo $THROW['WFST_VALUE']; ?>').val('<?php echo $t_value; ?>').trigger("change");
			});
		}else{
		$('#<?php echo $THROW['WFST_VALUE']; ?>').val('<?php echo $t_value; ?>');
		}
	}
	<?php 
							}
						}
					}
					?>
</script> 
<?php
}
include '../include/combottom_user.php'; ?>