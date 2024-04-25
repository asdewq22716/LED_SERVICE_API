<?php 
include '../include/comtop_user.php';

?>
<link href="../assets/css/hover-min.css" rel="stylesheet">
<style>
.prod-info a{
    font-size: 16px;
}
.ourpro-icon-wrap {
     text-align: center;
     margin: 0 auto;
     padding: 2em 0 3em;
 }
 .ourpro-icon {
     display: inline-block;
     font-size: 0;
     cursor: pointer;
     margin: 20px 30px 0px 30px;
     width: 70px;
     height: 70px;
     border-radius: 50%;
     text-align: center;
     position: relative;
     z-index: 1;
     color: #fff;
 }
 .ourpro-icon:after {
     pointer-events: none;
     position: absolute;
     width: 100%;
     height: 100%;
     border-radius: 50%;
     content: '';
     -webkit-box-sizing: content-box;
     -moz-box-sizing: content-box;
     box-sizing: content-box;
 }
 .ourpro-icon:before {
     speak: none;
     font-size: 30px;
     line-height: 70px;
     display: block;
     -webkit-font-smoothing: antialiased;
 }
 .box-process h6 , .box-process p{
     color: #222;
     margin-bottom: 15px;
 }
 /* Effect 8 */
 .ourpro-icon-effect-8 .ourpro-icon {
     background: #1b8bf9;
     -webkit-transition: -webkit-transform ease-out 0.1s, background 0.2s;
     -moz-transition: -moz-transform ease-out 0.1s, background 0.2s;
     transition: transform ease-out 0.1s, background 0.2s;
 }
 .ourpro-icon-effect-8 .ourpro-icon:after {
     top: 0;
     left: 0;
     padding: 0;
     z-index: -1;
     box-shadow: 0 0 0 2px rgba(255,255,255,0.1);
     opacity: 0;
     -webkit-transform: scale(0.9);
     -moz-transform: scale(0.9);
     -ms-transform: scale(0.9);
     transform: scale(0.9);
 }
 .ourpro-icon-effect-8 .ourpro-icon:hover {
     background: #1b8bf9;
     -webkit-transform: scale(0.93);
     -moz-transform: scale(0.93);
     -ms-transform: scale(0.93);
     transform: scale(0.93);
     color: #fff;
 }
 .ourpro-icon-effect-8 .ourpro-icon:hover:after {
     -webkit-animation: sonarEffect 1.3s ease-out 75ms;
     -moz-animation: sonarEffect 1.3s ease-out 75ms;
     animation: sonarEffect 1.3s ease-out 75ms;
 }
 @-webkit-keyframes sonarEffect {
     0% {
         opacity: 0.3;
     }
     40% {
         opacity: 0.5;
         box-shadow: 0 0 0 2px #1b8bf9, 0 0 10px 10px #00b9f5, 0 0 0 10px #00ACED;
     }
     100% {
         box-shadow: 0 0 0 2px #1b8bf9, 0 0 10px 10px #00b9f5, 0 0 0 10px #00ACED;
         -webkit-transform: scale(1.5);
         opacity: 0;
     }
 }
 @-moz-keyframes sonarEffect {
     0% {
         opacity: 0.3;
     }
     40% {
         opacity: 0.5;
         box-shadow: 0 0 0 2px #1b8bf9, 0 0 10px 10px #00b9f5, 0 0 0 10px #00ACED;
     }
     100% {
         box-shadow: 0 0 0 2px #1b8bf9, 0 0 10px 10px #00b9f5, 0 0 0 10px #00ACED;
         -moz-transform: scale(1.5);
         opacity: 0;
     }
 }
 @keyframes sonarEffect {
     0% {
         opacity: 0.3;
     }
     40% {
         opacity: 0.5;
         box-shadow: 0 0 0 2px #1b8bf9, 0 0 10px 10px #00b9f5, 0 0 0 10px #00ACED;
     }
     100% {
         box-shadow: 0 0 0 2px #1b8bf9, 0 0 10px 10px #00b9f5, 0 0 0 10px #00ACED;
         transform: scale(1.5);
         opacity: 0;
     }
 }
</style>
    <div class="content-wrapper">
	<?php
echo "<div class=\"container-fluid\">";
if($_GET['G'] == ""){
	$G=0;
	?>
	<div class="row">
		<div class="col-sm-8">
			<div class="main-header">
				<h4><i class="fa fa-home"></i> IFTTT GROUP</h4>
			</div>
		</div>
	</div>
	<?php
}else{
	$sql_ifttt_g = db::query("SELECT * FROM IFTTT_GROUP WHERE G_ID = '".conText($_GET["G"])."'");
	$IFG=db::fetch_array($sql_ifttt_g);
	?>
	<div class="row">
		<div class="col-sm-8">
			<div class="main-header"> 
			<h6>
				<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                  <li class="breadcrumb-item"><a href="../ifttt/index.php"> <i class="icofont icofont-home"></i> </a></li> 
				   <li class="breadcrumb-item"><?php echo $IFG['G_NAME']; ?></li> 
                </ol>
			</h6>
			</div>
		</div>
	</div>
	<?php
}
 
if(conText($_GET["G"])==""){
?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-block p-t-30">
				<?php
				$i=0;
				$sql_ifttt_g = db::query("SELECT * FROM IFTTT_GROUP WHERE G_STATUS = 'Y'");
				while($IFG=db::fetch_array($sql_ifttt_g)){ ?>
				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="card prod-view">
						<div class="prod-item text-center">
							<div class="prod-img">
							<div class="box-process">
								<a href="index.php?G=<?php echo $IFG['G_ID']; ?>" class="ourpro-icon-wrap ourpro-icon-effect-8">
								<i class="fa fa-lightbulb-o ourpro-icon"></i>
								</a>
							</div>
							</div>
							<div class="prod-info">
								<h6><a href="index.php?G=<?php echo $IFG['G_ID']; ?>" <?php echo $target; ?> class="txt-muted"> <?php echo $IFG['G_NAME']; ?> </a></h6>
							</div>
						</div>
					</div>
				</div>
				<?php
				$i++;
				if($i%4==0){ ?><div class="clearfix"></div><?php }
				}
			 	?>
			</div>
		</div>
	</div>
</div>
<?php }else{ ?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-block p-t-30">
				<?php
				$i=0;
				$sql_ifttt_g = db::query("SELECT * FROM IFTTT_LIST WHERE IFTTT_GROUP = '".conText($_GET["G"])."'");
				while($IFG=db::fetch_array($sql_ifttt_g)){ 
				if($IFG['IFTTT_SHOW'] == "1"){
				?>
				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="col-md-12">
							<div class="row advance-elements">
								<div class="col-md-12">
									<h5 class="sub-title"><?php echo $IFG['IFTTT_TITLE']; ?></h5>
										
									<input type="checkbox" name="switch<?php echo $IFG['IFTTT_ID']; ?>" id="switch<?php echo $IFG['IFTTT_ID']; ?>" class="js-switch" data-switchery="true" value="Y" onChange="show_switch<?php echo $IFG['IFTTT_ID']; ?>(this);" checked="">
								
								</div>
							</div>
					  </div>
				</div><?php
				$sql_form = db::query("SELECT * FROM IFTTT_ACTION WHERE WFR_ID = '".$IFG['IFTTT_ID']."' ORDER BY F_ID");
				$F1 = db::fetch_array($sql_form);
				$F2 = db::fetch_array($sql_form);
				?>
				<script type="text/javascript">
				
					function show_switch<?php echo $IFG['IFTTT_ID']; ?>(c){
						if(c.checked==false){
							document.getElementById('switch_to<?php echo $IFG['IFTTT_ID']; ?>').src="<?php echo $F1['IFTTT_ACTION_URL']; ?>";
						}else{
							document.getElementById('switch_to<?php echo $IFG['IFTTT_ID']; ?>').src="<?php echo $F2['IFTTT_ACTION_URL']; ?>";
						}
					}
				</script>
				<iframe id="switch_to<?php echo $IFG['IFTTT_ID']; ?>" style="display:none"></iframe>
				<?php
				}elseif($IFG['IFTTT_SHOW'] == "2"){
				?>
				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="col-md-12">
							<div class="row advance-elements">
								<div class="col-md-12">
									<h5 class="sub-title"><?php echo $IFG['IFTTT_TITLE']; ?></h5>
									<div class="form-radio">
									<?php
									$sql_form = db::query("SELECT * FROM IFTTT_ACTION WHERE WFR_ID = '".$IFG['IFTTT_ID']."' ORDER BY F_ID");
									while($F1 = db::fetch_array($sql_form)){
									?>
									<div class="radio"><label><input type="radio" name="switch<?php echo $IFG['IFTTT_ID']; ?>" onClick="show_switch<?php echo $IFG['IFTTT_ID']; ?>('<?php echo $F1['F_ID']; ?>');"> <i class="helper"></i> <?php echo $F1['IFTTT_ACTION_NAME']; ?></label></div>
									<?php } ?>
									</div>
								</div>
							</div>
					  </div>
				</div>
				<script type="text/javascript">
					function show_switch<?php echo $IFG['IFTTT_ID']; ?>(c){
				<?php
				$sql_form = db::query("SELECT * FROM IFTTT_ACTION WHERE WFR_ID = '".$IFG['IFTTT_ID']."' ORDER BY F_ID");
				while($F1 = db::fetch_array($sql_form)){
				?>
						if(c=='<?php echo $F1['F_ID']; ?>'){
							document.getElementById('switch_to<?php echo $IFG['IFTTT_ID']; ?>').src="<?php echo $F1['IFTTT_ACTION_URL']; ?>";
						}
				<?php } ?>
					}
				</script>
				<iframe id="switch_to<?php echo $IFG['IFTTT_ID']; ?>" style="display:none"></iframe>
				<?php
				}elseif($IFG['IFTTT_SHOW'] == "4"){
				?>
				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="col-md-12">
							<div class="row advance-elements">
								<div class="col-md-12">
									<h5 class="sub-title"><?php echo $IFG['IFTTT_TITLE']; ?></h5>
									<select name="switch<?php echo $IFG['IFTTT_ID']; ?>" class="select2" onChange="show_switch<?php echo $IFG['IFTTT_ID']; ?>(this.value);">
									<option value="" disabled selected>-</option>
									<?php
									$sql_form = db::query("SELECT * FROM IFTTT_ACTION WHERE WFR_ID = '".$IFG['IFTTT_ID']."' ORDER BY F_ID");
									while($F1 = db::fetch_array($sql_form)){
									?>
									<option value="<?php echo $F1['F_ID']; ?>"><?php echo $F1['IFTTT_ACTION_NAME']; ?></option>
									<?php } ?>
									</select>
								</div>
							</div>
					  </div>
				</div>
				<script type="text/javascript">
					function show_switch<?php echo $IFG['IFTTT_ID']; ?>(c){
				<?php
				$sql_form = db::query("SELECT * FROM IFTTT_ACTION WHERE WFR_ID = '".$IFG['IFTTT_ID']."' ORDER BY F_ID");
				while($F1 = db::fetch_array($sql_form)){
				?>
						if(c=='<?php echo $F1['F_ID']; ?>'){
							document.getElementById('switch_to<?php echo $IFG['IFTTT_ID']; ?>').src="<?php echo $F1['IFTTT_ACTION_URL']; ?>";
						}
				<?php } ?>
					}
				</script>
				<iframe id="switch_to<?php echo $IFG['IFTTT_ID']; ?>" style="display:none"></iframe>
				<?php
				}elseif($IFG['IFTTT_SHOW'] == "5"){
				?>
				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="col-md-12">
							<div class="row advance-elements">
								<div class="col-md-12">
									<h5 class="sub-title"><?php echo $IFG['IFTTT_TITLE']; ?></h5>
										
									<input type="checkbox" name="switch<?php echo $IFG['IFTTT_ID']; ?>" id="switch<?php echo $IFG['IFTTT_ID']; ?>" class="js-switch" data-switchery="true" value="Y" onChange="show_switch<?php echo $IFG['IFTTT_ID']; ?>(this);" checked="">
								
								</div>
							</div>
					  </div>
				</div> 
				<script type="text/javascript">
				
					function show_switch<?php echo $IFG['IFTTT_ID']; ?>(c){
						if(c.checked==false){
							<?php 
							$sql_form = db::query("SELECT * FROM IFTTT_ACTION WHERE WFR_ID = '".$IFG['IFTTT_ID']."' ORDER BY F_ID");
							while($F1 = db::fetch_array($sql_form)){ 
							?>
							document.getElementById('switch_to<?php echo $IFG['IFTTT_ID']; ?>_<?php echo $F1['F_ID']; ?>').src="<?php echo $F1['IFTTT_ACTION_URL']; ?>";
							<?php } ?>
						}else{
							<?php
							$sql_form = db::query("SELECT * FROM IFTTT_ACTION WHERE WFR_ID = '".$IFG['IFTTT_ID']."' ORDER BY F_ID");
							while($F1 = db::fetch_array($sql_form)){ 
							if (strpos($F1['IFTTT_ACTION_URL'], 'Off/') !== false) {
								$url = str_replace("Off/","On/",$F1['IFTTT_ACTION_URL']);
							}
							if (strpos($F1['IFTTT_ACTION_URL'], 'On/') !== false) {
								$url = str_replace("On/","Off/",$F1['IFTTT_ACTION_URL']);
							}
							?>
							document.getElementById('switch_to<?php echo $IFG['IFTTT_ID']; ?>_<?php echo $F1['F_ID']; ?>').src="<?php echo $url; ?>";
							<?php } ?>
						}
					}
				</script>
				<?php
				$sql_form = db::query("SELECT * FROM IFTTT_ACTION WHERE WFR_ID = '".$IFG['IFTTT_ID']."' ORDER BY F_ID");
				while($F1 = db::fetch_array($sql_form)){
				?>
				<iframe id="switch_to<?php echo $IFG['IFTTT_ID']; ?>_<?php echo $F1['F_ID']; ?>" style="display:none"></iframe>
				<?php
				}
				}
				$i++;
				if($i%4==0){ ?><div class="clearfix"></div><?php }
				}
			 	?>
			</div>
		</div>
	</div>
</div>
<?php } ?>
            <!-- Workflow Row end -->
		</div> 
        <!-- Container-fluid ends -->

     </div>
</div>
<?php
 include '../include/combottom_js_user.php'; ?>
<script type="text/javascript" src="../assets/pages/advance-form.js"></script>
<?php include '../include/combottom_user.php'; ?>
