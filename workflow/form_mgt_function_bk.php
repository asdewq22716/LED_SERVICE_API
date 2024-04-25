<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';
$W = conText($_POST['W']);
$WFR = conText($_POST['WFR']);
$WFR_ID = conText($_POST['WFR_ID']);
$F_TEMP_ID = conText($_POST['F_TEMP_ID']);
$WFD = conText($_POST['WFD']);
$WFS = conText($_POST['WFS']); 
if($W != ""){

$sql_main = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec_main = db::fetch_array($sql_main);
$wf_table = $rec_main["WF_MAIN_SHORTNAME"];
$WF_TYPE = $rec_main['WF_TYPE'];
$pk_name = $rec_main["WF_FIELD_PK"];
$update_wf = array();
$wf_cond = array();

$sql_wfs = db::query("select WF_MAIN_ID from WF_STEP_FORM where WFS_ID = '".$WFS."'");
$rec_wfs = db::fetch_array($sql_wfs);

if($WFR == ""){ //new data
	$insert_wf = array();
	$insert_wf["WF_MAIN_ID"] = $rec_wfs['WF_MAIN_ID'];
	$insert_wf["WFD_ID"] = $WFD;
	$insert_wf["WFR_ID"] = $WFR_ID;
	$insert_wf["WFS_ID"] = $WFS;
	$insert_wf["F_TEMP_ID"] = $F_TEMP_ID;
	$insert_wf["F_CREATE_DATE"] = date2db(date("d/m/").(date("Y")+543));
	$insert_wf["F_CREATE_BY"] = $_SESSION['WF_USER_ID'];
	$WFR = db::db_insert($wf_table, $insert_wf, $pk_name);
	unset($insert_wf);	
	$FLAG_ADD = "Y";
}

	$insert_step = array();

	$update_wf = bsf_save_form($W,$WFD,$WFR,$WF_TYPE,$update_wf,$FLAG_ADD,$WFS);

	$wf_cond[$pk_name] = $WFR;
	db::db_update($wf_table, $update_wf, $wf_cond);
	unset($update_wf);
	unset($wf_cond);
//echo "ssss";
db::db_close();
if($_POST["WF_POP"]=="P"){ //$WF_TARGRT = ".opener"; 
}
?>
<script src="../assets/js/jquery-3.1.1.min.js"></script>
<script>
function get_wfs_show1(obj_target,url,dataString,w_method='GET',show='W'){ 
			$.ajax({
				type: w_method,
				url: url,
				data: dataString,
				cache: false,
				success: function(data){
					if(show=='A'){
						<?php if($_POST["WF_POP"]=="P"){ ?>
						window.top.opener.$('#'+obj_target).append(data);
						top.close();
						<?php }else{ ?>
						parent.$('#'+obj_target).append(data);
						<?php } ?>
					}else{
						<?php if($_POST["WF_POP"]=="P"){ ?>
						window.top.opener.$('#'+obj_target).html(data);
						top.close();
						<?php }else{ ?>
						parent.$('#'+obj_target).html(data);
						<?php } ?>
					}
				} 
			 });
		}

get_wfs_show1('WFS_FORM_<?php echo $WFS; ?>','../workflow/form_main.php','W=<?php echo $W; ?>&WFD=<?php echo $WFD; ?>&WFS=<?php echo $WFS; ?>&WFR=<?php echo $WFR_ID; ?>&F_TEMP_ID=<?php echo $F_TEMP_ID; ?>','GET');
<?php if($_POST["WF_POP"]!="P"){ ?>
parent.$('#bizModal_<?php echo $WFS; ?>').modal('hide');
<?php } ?>

</script>
<?php
}
?>