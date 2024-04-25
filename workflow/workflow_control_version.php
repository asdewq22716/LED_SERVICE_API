<?php
//$HIDE_HEADER = "Y";
include '../include/comtop_user.php';
$W = conText($_GET['W']);
$WFR = conText($_GET['WFR']);
$DOC_ID = conText($_GET['DOC_ID']);

$sql_step = db::query("SELECT * FROM DOC_VERSION WHERE WF_MAIN_ID='".$W."' AND WFR_ID='".$WFR."' AND DOC_ID='".$DOC_ID."' ORDER BY DV_ID DESC");
//WFS_ORDER,WFS_OFFSET


$sql_main_wf = db::query("select WF_MAIN_SHORTNAME from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec_main = db::fetch_array($sql_main_wf);
$sql_mt = "SELECT * FROM ".$rec_main["WF_MAIN_SHORTNAME"]." WHERE WFR_ID='".$WFR."'";
$sql_m_t = db::query($sql_mt);
$data_m = db::fetch_array($sql_m_t);
?>
<iframe style="display:none;height:1px;width:1px" src="../run/control_v.php"></iframe> 


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
							<h4>Version ไฟล์เอกสาร</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
			<div class="row">
				<div class="col-md-12">
				<div class="card">
					<div class="card-block">
						<?php 					
						while($step = db::fetch_array($sql_step)){?>
							<div class="form-group row">
								<div class="col-md-1"></div>
								<div class="col-md-11">
									<h5 class="card-header-text"><label class="label bg-primary"><a href="workflow_control_version_load.php?DOC_ID=<?php echo $DOC_ID;?>&WFR=<?php echo $WFR;?>&W=<?php echo $W; ?>&DV=<?php echo $step["DV_ID"]; ?>" target="_blank""><i class="ion-document"></i> เอกสาร วันที่ <?php echo db2date($step["DV_DATE"]);?> <?php echo $step["DV_TIME"];?></a></label></h5>
								</div>
							</div>
							
						<?php	 
						}
						?>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include '../include/combottom_js_user.php'; 
include '../include/combottom_user.php'; ?>