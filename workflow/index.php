<?php 
$WF_HOME = 'Y';
include '../include/comtop_user.php';

$menu_array = $_SESSION['WF_MENU'];
$menu_parent_array = $_SESSION['WF_MENU_PARENT'];
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
<script>
	function load_job(WID,WF_LINK){ 
		var dataString = 'W='+WID+'&WF_LINK='+WF_LINK; 
		$.ajax({
			type: "GET",
			url: "../workflow/wf_job.php",
			data: dataString,
			cache: false,
			success: function(html){
				$('#w_'+WID).html(html);
			}
		 });
	}
</script>
    <div class="content-wrapper">
	<?php
if($system_conf["wf_show_menu"] != "A"){ 
	if($system_conf["wf_sub_menu"] == ""){ ?>
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <!-- Row Starts -->
            <div class="row" id="animationSandbox">
				<div class="col-sm-8">
					<div class="main-header">
						<h4><?php echo $system_conf["conf_title"];?></h4>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="md-group-add-on col-sm-12">
							 <span class="md-add-on">
								<i class="icofont icofont-search-alt-2 chat-search"></i>
							 </span>
						<div class="md-input-wrapper">
							<input type="text" class="md-form-control" name="wf_search" id="search-wf_main">
							<label for="wf_search"><?php echo $system_conf["conf_search"];?></label>
						</div>
					</div> 
				</div>
			</div>
            <!-- Row end --> 
			<?php
				foreach($menu_array as $key=>$val){ 
				?>
				<!--Workflow row start-->
                <div class="row">
					<div class="col-md-12">
                    <div class="card">
						<div class="card-header">
                            <h5 class="card-header-text">
								<h5><i class="fa fa-toggle-right"></i> <?php echo $menu_array[$key][0]['GNAME']; ?></h5>
                            </h5>
                        </div> 
					<div class="card-block">
					<?php
					$wf_menu = $menu_array[$key];
					foreach($wf_menu as $k => $v){
						if($k % 4 == 0)
						{
							echo '<div class="clearfix visible-sm-block"></div>'; 
						}
					?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 wf_keyword-box">
                        <div class="card prod-view">
                            <div class="prod-item text-center">
                                <div class="prod-img ">
                                    <a href="<?php echo $wf_menu[$k]['LINK']; ?>" class="hvr-shrink">
                                        <img src="../icon/<?php echo $wf_menu[$k]['ICON']; ?>" class="img-fluid o-hidden m-t-20">
                                    </a>
									<?php if($wf_menu[$k]['TYPE']=="W" AND $wf_menu[$k]['SUBTYPE']=="W"){ ?>
                                    <div id="w_<?php echo $wf_menu[$k]['ID']; ?>" class="p-new"></div><?php } ?>
                                </div>
                                <div class="prod-info">
                                    <h6><a href="<?php echo $wf_menu[$k]['LINK']; ?>" class="txt-muted wf_keyword"><?php echo $wf_menu[$k]['TITLE']; ?></a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
					<?php 
					if($wf_menu[$k]['TYPE']=="W" AND $wf_menu[$k]['SUBTYPE']=="W"){ ?>
					<script>load_job('<?php echo $wf_menu[$k]['ID']; ?>','<?php echo $wf_menu[$k]['LINK']; ?>');</script>
					<?php }} ?>
							</div>
						</div>
					</div>
				</div>
            <!-- Workflow Row end -->
			<?php } ?>
		</div> 
        <!-- Container-fluid ends -->
		<?php }
		if($system_conf["wf_sub_menu"] == "1" AND $_GET['G'] == ""){ ?>
		<!-- Container-fluid starts -->
        <div class="container-fluid">
            <!-- Row Starts -->
            <div class="row" id="animationSandbox">
				<div class="col-sm-8">
					&nbsp;
				</div> 
			</div>
            <!-- Row end --> 
				<!--Workflow row start-->
                <div class="row">
					<div class="col-md-12">
                    <div class="card">
						<div class="card-header">
                            <h5 class="card-header-text">
								<h5><i class="fa fa-toggle-right"></i> <?php echo $system_conf["conf_title"];?></h5>
                            </h5>
                        </div> 
					<div class="card-block">
					<?php
					$k=0;
					foreach($menu_array as $key=>$val){ 
						if($k % 4 == 0)
						{
							echo '<div class="clearfix visible-sm-block"></div>';
						}
					?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 wf_keyword-box">
                        <div class="card prod-view">
                            <div class="prod-item text-center">
                                <div class="prod-img ">
                                    <a href="index.php?G=<?php echo $key; ?>" class="hvr-shrink">
                                        <img src="../icon/<?php echo $menu_array[$key][0]['ICON']; ?>" class="img-fluid o-hidden m-t-20">
                                    </a> 
                                </div>
                                <div class="prod-info">
                                    <h6><a href="index.php?G=<?php echo $key; ?>" class="txt-muted wf_keyword"><?php echo $menu_array[$key][0]['GNAME']; ?></a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
					<?php $k++; } ?>
							</div>
						</div>
					</div>
				</div>
            <!-- Workflow Row end -->
		</div> 
        <!-- Container-fluid ends -->
		<?php }
		if($system_conf["wf_sub_menu"] == "1" AND $_GET['G'] != "" AND is_numeric($_GET['G'])){ 
		$G = conText($_GET['G']);
		?>
		<!-- Container-fluid starts -->
        <div class="container-fluid">
            <!-- Row Starts -->
            <div class="row" id="animationSandbox">
				<div class="col-sm-12">
				&nbsp;
				</div> 
			</div>
            <!-- Row end --> 
				<!--Workflow row start-->
                <div class="row">
					<div class="col-md-12">
                    <div class="card">
						<div class="card-header">
                            <h5 class="card-header-text">
								<h5><ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
						<li class="breadcrumb-item"><a href="index.php"><i class="icofont icofont-home"> </i></a>
						</li>
						<li class="breadcrumb-item"> <?php echo $menu_array[$G][0]['GNAME']; ?>
						</li>
                  </ol></h5>
                            </h5>
                        </div> 
					<div class="card-block">
					<?php
					$wf_menu = $menu_array[$G];
					foreach($wf_menu as $k => $v){
						if($k % 4 == 0)
						{
							echo '<div class="clearfix visible-sm-block"></div>'; 
						}
					?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 wf_keyword-box">
                        <div class="card prod-view">
                            <div class="prod-item text-center">
                                <div class="prod-img ">
                                    <a href="<?php echo $wf_menu[$k]['LINK']; ?>" class="hvr-shrink">
                                        <img src="../icon/<?php echo $wf_menu[$k]['ICON']; ?>" class="img-fluid o-hidden m-t-20">
                                    </a>
									<?php if($wf_menu[$k]['TYPE']=="W" AND $wf_menu[$k]['SUBTYPE']=="W"){ ?>
                                    <div id="w_<?php echo $wf_menu[$k]['ID']; ?>" class="p-new"></div><?php } ?>
                                </div>
                                <div class="prod-info">
                                    <h6><a href="<?php echo $wf_menu[$k]['LINK']; ?>" class="txt-muted wf_keyword"><?php echo $wf_menu[$k]['TITLE']; ?></a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
					<?php 
					if($wf_menu[$k]['TYPE']=="W" AND $wf_menu[$k]['SUBTYPE']=="W"){ ?>
					<script>load_job('<?php echo $wf_menu[$k]['ID']; ?>','<?php echo $wf_menu[$k]['LINK']; ?>');</script>
					<?php }} ?>
							</div>
						</div>
					</div>
				</div>
            <!-- Workflow Row end -->
		</div> 
        <!-- Container-fluid ends -->
		<?php }
		if($system_conf["wf_show_menu"] == "2" AND $_GET['G'] == ""){ ?>
		<!-- Container-fluid starts -->
        <div class="container-fluid">
            <!-- Row Starts -->
            <div class="row" id="animationSandbox">
				<div class="col-sm-8">
					<div class="main-header">
						<h4><?php echo $system_conf["conf_title"];?></h4>
					</div>
				</div>
			</div>
            <!-- Row end --> 
				<!--Workflow row start-->
                <div class="row">

					<?php
					$k=0;
					foreach($menu_array_parent as $key=>$val){ 
						if($k % 4 == 0)
						{
							echo '<div class="clearfix visible-sm-block"></div>';
						}
						 $m_val = explode("||",$val); 
					?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 wf_keyword-box">
                        <div class="card prod-view">
                            <div class="card-block text-center">
                                <div class="prod-img ">
                                    <a href="index.php?G=<?php echo $key; ?>" class="hvr-shrink">
                                        <img src="../icon/<?php echo $m_val[1]; ?>" class="img-fluid o-hidden m-t-20">
                                    </a> 
                                </div>
                                <div class="prod-info">
                                    <h6><a href="index.php?G=<?php echo $key; ?>" class="txt-muted wf_keyword"><?php echo $m_val[0]; ?></a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
					<?php $k++; } ?> 
				</div>
            <!-- Workflow Row end -->
		</div> 
        <!-- Container-fluid ends -->
		<?php } 
		if($system_conf["wf_show_menu"] == "2" AND $_GET['G'] != "" AND is_numeric($_GET['G'])){ 
		$G = conText($_GET['G']);
		?>
		<!-- Container-fluid starts -->
        <div class="container-fluid">
            <!-- Row Starts -->
            <div class="row" id="animationSandbox">
				<div class="col-sm-8">
					<div class="main-header">
						<h4><?php $m_val = explode("||",$menu_array_parent[$G]);  echo $m_val[0];?></h4>
					</div>
				</div>
			</div>
            <!-- Row end --> 
				<!--Workflow row start-->
                <?php
				foreach($menu_array as $key=>$val){ 
				if($menu_array[$key][0]['PARENT_ID']==$G){
				?>
				<!--Workflow row start-->
                <div class="row">
					<div class="col-md-12">
                    <div class="card">
						<div class="card-header">
                            <h5 class="card-header-text">
								<h5><i class="fa fa-toggle-right"></i> <?php echo $menu_array[$key][0]['GNAME']; ?></h5>
                            </h5>
                        </div> 
					<div class="card-block">
					<?php
					$wf_menu = $menu_array[$key];
					foreach($wf_menu as $k => $v){
						if($k % 4 == 0)
						{
							echo '<div class="clearfix visible-sm-block"></div>'; 
						}
					?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 wf_keyword-box">
                        <div class="card prod-view">
                            <div class="prod-item text-center">
                                <div class="prod-img ">
                                    <a href="<?php echo $wf_menu[$k]['LINK']; ?>" class="hvr-shrink">
                                        <img src="../icon/<?php echo $wf_menu[$k]['ICON']; ?>" class="img-fluid o-hidden m-t-20">
                                    </a>
									<?php if($wf_menu[$k]['TYPE']=="W" AND $wf_menu[$k]['SUBTYPE']=="W"){ ?>
                                    <div id="w_<?php echo $wf_menu[$k]['ID']; ?>" class="p-new"></div><?php } ?>
                                </div>
                                <div class="prod-info">
                                    <h6><a href="<?php echo $wf_menu[$k]['LINK']; ?>" class="txt-muted wf_keyword"><?php echo $wf_menu[$k]['TITLE']; ?></a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
					<?php 
					if($wf_menu[$k]['TYPE']=="W" AND $wf_menu[$k]['SUBTYPE']=="W"){ ?>
					<script>load_job('<?php echo $wf_menu[$k]['ID']; ?>','<?php echo $wf_menu[$k]['LINK']; ?>');</script>
					<?php }} ?>
							</div>
						</div>
					</div>
				</div>
            <!-- Workflow Row end -->
		<?php }} ?>
            <!-- Workflow Row end -->
		</div> 
        <!-- Container-fluid ends -->
<?php }}else{ //Advance 
echo "<div class=\"container-fluid\">";
if($_GET['G'] == ""){
	$G=0;
	?>
	<div class="row">
		<div class="col-sm-8">
			<div class="main-header">
				<h4><?php echo $system_conf["conf_title"];?></h4>
			</div>
		</div>
	</div>
	<?php
}else{
$gtxt_menu = "";
function m_get_parent($G){
	global $gtxt_menu;
	foreach($_SESSION['WF_MENU'] as $k=>$val){
		foreach($val as $kk=>$M){
			if ($M['MENU_ID'] == $G){ 
				$txt = " <li class=\"breadcrumb-item\"><a href=\"".$M['MENU_URL']."\">".$M['MENU_NAME']."</a></li> ";
				$gtxt_menu = $txt.$gtxt_menu;
				if($k > 0){
					m_get_parent($k);
				}
			}
		}
	}
}
	$G = $_GET['G'];
	
	?>
	<div class="row">
		<div class="col-sm-8">
			<div class="main-header"> 
			<h6>
				<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                  <li class="breadcrumb-item"><a href="../workflow/index.php"> <i class="icofont icofont-home"></i> </a></li> 
				  <?php m_get_parent($G); echo $gtxt_menu; ?>
                </ol>
			</h6>
			</div>
		</div>
	</div>
	<?php
}
//print_pre($menu_array);
function gen_menu_adv($menu_array,$parent){
	$i=0;
	foreach($menu_array[$parent] as $m){
		if($m['WF_MAIN_TYPE'] == "C" AND $m['MENU_SHOW'] == "C"){ 
		$i=0;
			?><div class="row">
				<div class="col-sm-12">
					<div class="main-header">
						<h4><?php 
						echo "<i class=\"";
				if($m['MENU_S_ICON'] != ""){ echo $m['MENU_S_ICON']; }else{ echo "fa fa-toggle-right"; }
				echo "\"></i> ".$m['MENU_NAME']; ?></h4>
					</div>
				</div>
			</div><?php
			gen_menu_adv($menu_array,$m['MENU_ID']);
		}else{
			if($m['MENU_TARGET'] != ""){ $target = " target=\"".$m['MENU_TARGET']."\""; }else{ $target = ""; }
			?>
			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="card prod-view">
					<div class="prod-item text-center">
						<div class="prod-img">
						<?php if($m['MENU_ICON']==""){ ?>
						<div class="box-process">
							<a href="<?php echo $m['MENU_URL']; ?>" <?php echo $target; ?> class="ourpro-icon-wrap ourpro-icon-effect-8">
                            <i class="icofont icofont-folder-open ourpro-icon"></i>
							</a>
						</div>
						<?php }else{ ?>
						
							<a href="<?php echo $m['MENU_URL']; ?>" <?php echo $target; ?> class="hvr-shrink">
								<img src="../icon/<?php echo $m['MENU_ICON']; ?>" class="img-fluid o-hidden m-t-20 m-b-5"  style="height:64px">
							</a>
							
						<?php }
					if($m['WF_MAIN_TYPE'] == "W"){ 
							?>
						<div id="w_<?php echo $m['WF_MAIN_ID']; ?>" class="p-new"></div>
						<script>load_job('<?php echo $m['WF_MAIN_ID']; ?>','<?php echo $m['MENU_URL']; ?>');</script>
					<?php } ?>
						</div>
						<div class="prod-info">
							<h6><a href="<?php echo $m['MENU_URL']; ?>" <?php echo $target; ?> class="txt-muted"> <?php echo $m['MENU_NAME']; ?> </a></h6>
						</div>
					</div>
				</div>
			</div>
			<?php
			$i++;
			if($i%4==0){ ?><div class="clearfix"></div><?php }
			
		}
	}
}

?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-block p-t-30">
				<?php
			if(count($menu_array[$G])>0){
				gen_menu_adv($menu_array,$G);
			}	?>
			</div>
		</div>
	</div>
</div>
            <!-- Workflow Row end -->
		</div> 
        <!-- Container-fluid ends -->

<?php } ?>
     </div>
</div>
<?php
 include '../include/combottom_js_user.php'; ?>
<script>
	$(document).ready(function()
	{
		$("#search-wf_main").on("keyup", function()
		{

			var g = $(this).val().toLowerCase();
			$(".wf_keyword").each(function()
			{

				var s = $(this).text().toLowerCase();
				$(this).closest('.wf_keyword-box')[s.indexOf(g) !== -1 ? 'show' : 'hide']();
			});
		});
		
	});

</script>
<?php include '../include/combottom_user.php'; ?>
