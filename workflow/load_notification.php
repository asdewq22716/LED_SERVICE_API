<?php
$HIDE_HEADER = 'Y';
include '../include/comtop_user.php';
	 $sql_alert_y = db::query("SELECT COUNT(A_ID) AS CT FROM WF_ALERT WHERE A_REC_USER = '".$_SESSION["WF_USER_ID"]."' AND A_STATUS = 'Y' ");
	 $a_rows = db::fetch_array($sql_alert_y);
	 
	 $sql_alert = db::query_limit("SELECT * FROM WF_ALERT WHERE A_REC_USER = '".$_SESSION["WF_USER_ID"]."' AND (A_STATUS = 'Y' OR A_STATUS = 'R') ORDER BY A_ID DESC ",0,20);
	 
?>
		<a href="#!" data-toggle="dropdown" aria-expanded="false" class="dropdown-toggle">
			<i class="icon-bell"></i>
			<?php if($a_rows['CT'] > 0){ ?>
			<span class="badge badge-danger header-badge"><?php echo number_format($a_rows['CT'],0); ?></span>
			<?php } ?>
		</a>
		<ul class="dropdown-menu">
			<li class="not-head">You have <b class="text-primary"><?php echo number_format($a_rows['CT'],0); ?></b> new notifications.</li>
			<div style="height: 450px; overflow-y: scroll;">
		<?php
		while($A=db::fetch_array($sql_alert)){
			$USR = wf_profile($A['A_SEND_USER']);
		?>
			<li class="bell-notification" <?php if($A['A_STATUS']!='R'){ echo 'style="background-color:#E7E7E7;"'; } ?>>
				<a href="<?php if($A['CUSTOM_URL'] == ""){ ?>../workflow/workflow_process.php?W=<?php echo $A['WF_MAIN_ID']; ?>&WFR=<?php echo $A['WFR_ID']; }else{  echo $A['CUSTOM_URL']; } ?>" class="media">
				<span class="media-left media-icon">
				<img class="img-circle" src="<?php echo $USR['img']; ?>" alt="<?php echo $USR['name']; ?>">
				</span>
					<div class="media-body"><span class="block"><?php
if($A['CUSTOM_TEXT'] == ""){
		echo $USR['name']; ?> ได้บันทึกขั้นตอน "<?php echo step_name($A['A_LAST_STEP']); ?>" ใน<?php echo workflow_name($A['WF_MAIN_ID']); }else{ echo $A['CUSTOM_TEXT']; } ?>  </span><span class="text-muted block-time"><?php echo db2date($A['A_SEND_DATE']).' '.$A['A_SEND_TIME']; ?></span></div></a>
			</li>
		<?php } ?> 
			</div>
		</ul>
<?php db::db_close(); ?>