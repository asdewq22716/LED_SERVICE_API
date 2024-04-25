<?php
//$HIDE_HEADER = "Y";
include '../include/comtop_user.php';
$W = conText($_GET['W']);
$WFR = conText($_GET['WFR']);

$sql_step = db::query("SELECT WF_STEP.WFD_ID,WFD_NAME ,WFD_ORDER FROM WF_STEP INNER JOIN WF_DETAIL ON WF_STEP.WFD_ID=WF_DETAIL.WFD_ID AND WF_STEP.WF_MAIN_ID=WF_DETAIL.WF_MAIN_ID INNER JOIN WF_STEP_FORM ON WF_STEP_FORM.WFD_ID=WF_DETAIL.WFD_ID AND FORM_MAIN_ID='6' AND WF_STEP.WF_MAIN_ID=WF_STEP_FORM.WF_MAIN_ID  WHERE WF_STEP.WF_MAIN_ID='".$W."' AND WFR_ID='".$WFR."' AND WF_STEP_STAUS='Y'  GROUP BY WF_STEP.WFD_ID,WFD_NAME,WFD_ORDER ORDER BY WFD_ORDER");
//WFS_ORDER,WFS_OFFSET


$sql_main_wf = db::query("select WF_MAIN_SHORTNAME from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec_main = db::fetch_array($sql_main_wf);
$sql_mt = "SELECT * FROM ".$rec_main["WF_MAIN_SHORTNAME"]." WHERE WFR_ID='".$WFR."'";
$sql_m_t = db::query($sql_mt);
$data_m = db::fetch_array($sql_m_t);
?>



<div class="content-wrapper">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<!-- Row Starts -->
		<div class="row" id="animationSandbox">
			<div class="col-sm-8">
				<div class="main-header">
					<div class="media m-b-12">
						<a class="media-left" href="#!">
							<img src="../icon/icon7.png" class="media-object">
						</a>
						<div class="media-body">
							<h4>ไฟล์เอกสารแนบ</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php 
		
		while($step = db::fetch_array($sql_step)){?>
			<div class="row">
				<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-header-text">
							<h5><i class="fa fa-toggle-right"></i> <?php echo $step["WFD_NAME"]; ?></h5>
						</h5>
					</div> 
					<div class="card-block">
						<?php 
						
						$sql_wsf = db::query("SELECT WFS_FIELD_NAME FROM WF_STEP_FORM WHERE WFD_ID='".$step["WFD_ID"]."' AND FORM_MAIN_ID='6' AND WF_MAIN_ID='".$W."'");
			
						while($wsf = db::fetch_array($sql_wsf)){
							$sql_field = db::query("SELECT WF_STEP_FORM.WFS_NAME, WF_STEP_FORM.WFS_FIELD_NAME FROM WF_STEP_FORM JOIN WF_FILE ON WF_STEP_FORM.WFS_FIELD_NAME=WF_FILE.WFS_FIELD_NAME AND WF_STEP_FORM.WF_MAIN_ID=WF_FILE.WF_MAIN_ID WHERE WF_FILE.WF_MAIN_ID='".$W."' AND FORM_MAIN_ID='6' AND WFR_ID='".$WFR."' AND WF_FILE.WFS_FIELD_NAME='".$wsf["WFS_FIELD_NAME"]."' GROUP BY WF_STEP_FORM.WFS_NAME, WF_STEP_FORM.WFS_FIELD_NAME ");//ORDER BY WF_STEP_FORM.WFS_ORDER
						
						while($field = db::fetch_array($sql_field)){?>
							<div class="form-group row">
								<div class="col-md-1"></div>
								<div class="col-md-11">
									<h5 class="card-header-text"><label class="label bg-primary"><?php echo $field["WFS_NAME"];?></label></h5>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-1"></div>
								<div class="col-md-11">
									<label><?php echo bsf_show_text($W ,$data_m ,'##'.$field["WFS_FIELD_NAME"].'!!' ,'W');?></label>
								</div>
							</div>
							
						<?php	
						}	
						}
						?>	
					</div>
				</div>
			</div>
		</div>
	<?php   
		}?>
	</div>
</div>

<?php include '../include/combottom_js_user.php'; 
include '../include/combottom_user.php'; ?>