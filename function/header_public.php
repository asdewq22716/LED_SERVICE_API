<?php
if($WF_HOME == 'Y'){
	bsf_menu($system_conf["wf_show_menu"]);
}
?>
<!-- Navbar-->
<header class="main-header-top hidden-print">
    <a href="#" class="logo">ระบบบันทึกคำสั่งเจ้าพนักงาน</a>
    <nav class="navbar navbar-static-top" <?php if($CONF_HEADER_LOGO_STYLE != ''){ echo 'style="'.$CONF_HEADER_LOGO_STYLE.'"';}?>>
        <!-- Sidebar toggle button-->
         <a href="#!" data-toggle="offcanvas" class="sidebar-toggle hidden-md-up"></a>
		
        <!-- Navbar Right Menu-->
        <div class="navbar-custom-menu">     
			 <ul class="top-nav">
                <li class="dropdown notification-menu" id="load_notification">
                   
                </li>

				<?php
					
					$sql = db::query("select USR_ID,USR_PREFIX,USR_FNAME,USR_LNAME,USR_PICTURE from USR_MAIN where USR_ID = '".$_SESSION["WF_USER_ID"]."'");
					$rec = db::fetch_array($sql);
					
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
                        <span>
							<?php echo $rec["USR_PREFIX"].$rec["USR_FNAME"].' '.$rec["USR_LNAME"];?>
						</span>

                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>