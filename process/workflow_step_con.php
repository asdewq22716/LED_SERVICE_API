<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$W = conText($_GET['W']);
$WFD = conText($_GET['WFD']);

$sql_detail = db::query("select WFD_DEFAULT_STEP,WFD_NAME from WF_DETAIL where  WFD_ID = '".$WFD ."'");
$rec_detail = db::fetch_array($sql_detail);
?>
	<!-- Row Starts -->
<?php if($rec_detail['WFD_DEFAULT_STEP'] != ''){?>
<a href="#!" onClick="PopupCenter('workflow_step_preview.php?W=<?php echo $W; ?>&WFD=<?php echo $rec_detail['WFD_DEFAULT_STEP']; ?>', 'Preview', (window.innerWidth-60), window.innerHeight) ;" data-toggle="tooltip" data-placement="top" title="ดูหน้าจอ" class="label bg-success">
	<i class="ion-arrow-down-b"></i> <?php echo $rec_detail['WFD_DEFAULT_STEP']; ?>
</a>
<?php }?>
<?php echo get_data('WF_DETAIL', 'WFD_ID', 'WFD_NAME', $rec_detail['WFD_DEFAULT_STEP']); ?>
<div class="f-right">
	<span data-toggle="modal" data-target="#bizModal" onclick="open_modal('workflow_step_change.php?W=<?php echo $W; ?>&WFD=<?php echo $WFD; ?>', 'เปลี่ยนเส้นทางของขั้นตอน<?php echo $rec_detail['WFD_NAME'];?>')">
		<button type="button" class="btn btn-info active btn-mini waves-effect waves-light" data-placement="top" title="เปลี่ยนเส้นทาง" data-toggle="tooltip">
		<i class="ion-shuffle"></i></button>
	</span>
</div>
<blockquote class="blockquote">
	<?php
	$sql_step1 = db::query("SELECT * FROM WF_STEP_CON WHERE WFD_ID = '".$WFD."' ORDER BY WFSC_ID");
	while($con=db::fetch_array($sql_step1)){
		if($con["WFSC_VAR"] != ''){
		$str_detail = $con["WFSC_VAR"].' = '.'"'.$con["WFSC_VALUE"].'"';
		$sql_form_n1 = db::query("SELECT WFD_NAME FROM WF_DETAIL where WF_MAIN_ID = '".$W."' AND WFD_ID='".$con["WFSC_STEP"]."' ");
		$step= db::fetch_array($sql_form_n1);
		
	?>
	<p class="m-b-0"><?php echo $str_detail;?>
		<a href="#!" onClick="PopupCenter('workflow_step_preview.php?W=<?php echo $W; ?>&WFD=<?php echo $con["WFSC_STEP"]; ?>', 'Preview', (window.innerWidth-60), window.innerHeight) ;" data-toggle="tooltip" data-placement="top" title="ดูหน้าจอ" class="label bg-success">
			<i class="ion-arrow-down-b"></i> <?php echo $con["WFSC_STEP"];?>
		</a>
		<?php echo $step["WFD_NAME"];?>
	</p>
	<?php }}?>
	<!--<p class="m-b-0">FC_APPROVE = "U" :
		<a href="workflow_step_preview.php" target="_blank" data-toggle="tooltip" data-placement="top" title="ดูหน้าจอ" class="label bg-info">
			<i class="ion-checkmark"></i> 4
		</a>
		จบกระบวนงาน
	</p>-->
</blockquote>

<script>
	$(document).ready(function() {
			$('.select2').select2({
				placeholder: 'กรุณาเลือก...',
				allowClear: true
			});
	});
	
	function use_data(c,i){
	if(c.checked==true){ 
		document.getElementById("WFSC_VAR"+i).disabled = false;
		document.getElementById("WFSC_VALUE"+i).disabled = false;
		document.getElementById("WFSC_STEP"+i).disabled = false;	
		document.getElementById("WFSC_OPERATE"+i).disabled = false;	
		$("#WFSC_OPERATE"+i).trigger('chosen:open');
	}else{
		document.getElementById("WFSC_VAR"+i).disabled = true;
		document.getElementById("WFSC_VALUE"+i).disabled = true;
		document.getElementById("WFSC_STEP"+i).disabled = true;
		document.getElementById("WFSC_OPERATE"+i).disabled = true;
		$("#WFSC_OPERATE"+i).trigger('chosen:open');
	}
}

</script>
<?php
db::db_close();
?>