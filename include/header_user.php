<?php
if($WF_HOME == 'Y'){
	if(!is_array($_SESSION['WF_MENU'])){
	if($_GET['G'] == ""){
	bsf_menu_new($system_conf["wf_show_menu"]); 
	
	}
	}
}
?>
<!-- Navbar-->
<header class="main-header-top hidden-print">
     <a href="../workflow/index.php" class="logo" <?php //if($CONF_HEADER_LOGO_WIDTH != ''){ echo 'style="'.$CONF_HEADER_LOGO_WIDTH.'"';}?>>ระบบบันทึกคำสั่งเจ้าพนักงาน</a>
    <nav class="navbar navbar-static-top" <?php //if($CONF_HEADER_LOGO_STYLE != ''){ echo 'style="'.$CONF_HEADER_LOGO_STYLE.'"';}?>>
        <!-- Sidebar toggle button-->
         <a href="#!" data-toggle="offcanvas" class="sidebar-toggle hidden-md-up"></a>
		
        <!-- Navbar Right Menu-->
        <div class="navbar-custom-menu">
            <ul class="top-nav">
                <li class="dropdown notification-menu" id="load_notification">
					<a href="#!" data-toggle="dropdown" aria-expanded="false" class="dropdown-toggle">
						<i class="icon-bell"></i>
					</a>
                   
                </li>
				

				<?php
					
					$sql = db::query("select USR_ID,USR_PREFIX,USR_FNAME,USR_LNAME,USR_PICTURE,POS_ID from USR_MAIN where USR_ID = '".$_SESSION["WF_USER_ID"]."'");
					$rec = db::fetch_array($sql);

					/* Nop start */
					$sql_status = db::query("SELECT POS_ID,POS_NAME FROM USR_POSITION WHERE POS_ID ='".$rec["POS_ID"]."'");
					$rec_status = db::fetch_array($sql_status);
					/* Nop stop */
					
					
					if($rec["USR_PICTURE"] != '' AND file_exists('../profile/'.$rec["USR_PICTURE"])){
						$profile_pic = '../profile/'.$rec["USR_PICTURE"];
					}else{
						$profile_pic = '../assets/images/avatar-2.png';
					}
					
				?>
                <!-- User Menu-->
                <li class="dropdown">
                    <a href="#!" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle drop icon-circle drop-image">
                        <span ><img class="img-circle" src="<?php echo $profile_pic;?>" style="width:40px;border:2px solid #fff;" alt="User Image"></span>
                        <span><?php echo $rec["USR_PREFIX"].$rec["USR_FNAME"].' '.$rec["USR_LNAME"]."(".$rec_status["POS_NAME"].")";?><i id="bsf_profile_icon" class=" icofont icofont-simple-down"></i></span>

                    </a>
                    <ul class="dropdown-menu settings-menu">
						<?php
						$sql_lang = db::query("select * from WF_LANGUAGE WHERE LANG_STATUS = 'Y' ORDER BY LANG_ORDER ASC");
						if(db::num_rows($sql_lang) > 0){ 
						?>
							<li id="bsf_lang_bar"><a href="../workflow/wf_language.php"><i class="fa fa-language"></i> Thai</a></li>
							<li  class="p-0"><div class="dropdown-divider m-0"></div></li>
						<?php
							$i=1;
						while($L=db::fetch_array($sql_lang)){  
						?><li id="bsf_lang_bar"><a href="../workflow/wf_language.php?LANG=<?php echo $L['LANG_ID']; ?>"><i class="fa fa-language"></i> <?php echo $L['LANG_NAME']; ?></a></li> <?php if($i!=1){ echo '<li class="p-0"><div class="dropdown-divider m-0"></div></li>';}
						$i++; }
						?><li class="p-0"><div class="dropdown-divider m-0"></div></li>
							<?php
						}
						?>
						<?php if($_SESSION['WF_ADMIN'] == "Y"){ ?>
                        <li id="bsf_backend_bar"><a href="../process/index.php"><i class="icon-wrench"></i> Backend</a></li>
                        <li class="p-0">
                            <div class="dropdown-divider m-0"></div>
                        </li>
						<?php } ?>
						<li  id="bsf_profile_bar"><a href="../workflow/profile.php"><i class="icon-user"></i> <?php echo $system_conf["conf_profile"];?></a></li>
						<li  id="bsf_profile_bar" class="p-0">
                            <div class="dropdown-divider m-0"></div>
                        </li>
                        <li id="bsf_logout_bar"><a href="../index/logout.php"><i class="icon-logout"></i> <?php echo $system_conf["conf_logout"];?></a></li>

                    </ul>
                </li>
            </ul>
		
            
        </div>
    </nav>
</header>
<!-- Side-Nav-->
<aside class="main-sidebar hidden-print " >
    <section class="sidebar" id="sidebar-scroll">
        <div class="user-panel" style="white-space: inherit;">
            <div class="f-left image"><img src="<?php echo $profile_pic;?>" alt="User Image" class="img-circle"></div>
            <div class="f-left info">
                <p><?php echo $rec["USR_PREFIX"].$rec["USR_FNAME"].' '.$rec["USR_LNAME"];?> <span class="designation"> <i class="icofont icofont-caret-down m-l-5"></i></span></p>
                
            </div>
        </div>
        <!-- sidebar profile Menu-->
        <ul class="nav sidebar-menu extra-profile-list">
            <li>
                <a class="waves-effect waves-dark" href="profile.php">
                    <i class="icon-user"></i>
                    <span class="menu-text"><?php echo $system_conf["conf_profile"];?></span>
                    <span class="selected"></span>
                </a>
            </li>
            <li>
                <a class="waves-effect waves-dark" href="../index/logout.php">
                    <i class="icon-logout"></i>
                    <span class="menu-text"><?php echo $system_conf["conf_logout"];?></span>
                    <span class="selected"></span>
                </a>
            </li>
        </ul>
        <!-- Sidebar Menu-->
	
<?php
function get_menu_multi2($m_arr,$m_id){
	if($m_id == "" OR $m_id == "0"){
		$parent = "0";
		$class = "sidebar-menu\" id=\"sidebar-menu";
		$icon = "icon-grid";
	}else{
		$parent = $m_id;
		$class = "treeview-menu";
		$icon = "icon-arrow-right";
	}

	if(@count($m_arr[$parent]) > 0){ 
		echo "\n<ul class=\"".$class."\">\n"; 
			foreach($m_arr[$parent] as $M){
				if($M['MENU_FLAG'] == "file" OR count($m_arr[$M["MENU_ID"]]) > 0){
				$arrow = "";
				$target = "";
				$link = $M["MENU_URL"];
				if($M['MENU_TARGET'] != ""){ $target = " target=\"".$M['MENU_TARGET']."\" "; }
				if($M["MENU_S_ICON"] != ""){ $s_icon = $M["MENU_S_ICON"]; }else{ $s_icon = $icon; }
				if($m_id != "" AND $m_id != "0"){
					if(@count($m_arr[$M["MENU_ID"]]) > 0){ 
					$arrow = "<i class=\"icofont icofont-caret-right   text-right\"></i>";
					}else{
					$arrow = " ";	
					}
				}else{
					if(@count($m_arr[$M["MENU_ID"]]) > 0){ 
					$arrow = "<i class=\"ion-ios-arrow-down m-l-10\"></i>";
					}else{
					$arrow = " ";
					}
				}
				echo "<li><a href=\"".$link."\"".$target."><i class=\"".$s_icon."\"></i> <span>".$M["MENU_NAME"]."  </span> ".$arrow."</a>";
				if(@count($m_arr[$M["MENU_ID"]]) > 0){
				get_menu_multi($m_arr,$M["MENU_ID"]);
				}
				echo "</li>\n";
				}
			}
		echo "</ul>\n";
	}
}
if($system_conf["wf_show_menu"] == "A"){
get_menu_multi2($_SESSION['WF_MENU'],'0'); 
}else{
?><ul class="sidebar-menu"><?php
if($system_conf["wf_show_menu"] == "2"){
$menu_array_parent = $_SESSION['WF_MENU_PARENT'];		
if(count($menu_array_parent)){
foreach($menu_array_parent as $key=>$val){ 
		?>
		 <li>
			<a href="index.php?G=<?php echo $key; ?>"><i class="icon-grid"></i><span><?php $m_val = explode("||",$val); echo $m_val[0]; ?></span> </a>
		</li>
<?php }}	
}else{
$menu_array = $_SESSION['WF_MENU'];		
if(count($menu_array)){
foreach($menu_array as $key=>$val){ 
		?>
		 <li>
			<a href="#!"><i class="icon-grid"></i><span><?php echo $menu_array[$key][0]['GNAME']; ?></span>  <i class="icon-arrow-down"></i> </a>
			<ul class="treeview-menu">
			<?php
					$wf_menu = $menu_array[$key];
					foreach($wf_menu as $k => $v){ 
					?>
				<li><a href="<?php echo $wf_menu[$k]['LINK']; ?>" class="waves-effect waves-dark  "><i class="icon-arrow-right"></i><?php echo $wf_menu[$k]['TITLE']; ?></a></li>
				<?php } ?>
			</ul>
		</li>
<?php }}} echo "</ul>"; } ?>
	
    </section>
</aside>
<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			type: 'GET',
			url: '../workflow/load_notification.php',
			data: '',
			cache: false,
			success: function(data){
				$('#load_notification').html(data);
			} 
		 });
	});
</script>
