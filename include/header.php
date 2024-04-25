<?php
$W = conText($_GET['W']);
$WFD = conText($_GET['WFD']);
?>
<!-- Navbar-->
<header class="main-header-top hidden-print">
    <a href="index.php" class="logo" <?php if($CONF_HEADER_LOGO_WIDTH != ''){ echo 'style="'.$CONF_HEADER_LOGO_WIDTH.'"';}?>><img class="img-fluid able-logo" src="<?php echo $system_conf["conf_header_logo"]?>" alt="Theme-logo" ></a>
    <nav class="navbar navbar-static-top" <?php if($CONF_HEADER_LOGO_STYLE != ''){ echo 'style="'.$CONF_HEADER_LOGO_STYLE.'"';}?>>
        <!-- Sidebar toggle button-->
        <a href="#!" data-toggle="offcanvas" class="sidebar-toggle hidden-md-up"></a>
        <!-- Navbar Right Menu-->
        <div class="navbar-custom-menu">
            <ul class="top-nav">
				<?php 
				if($W != "" AND $WF_TYPE != ""){ ?>
                <!-- Help dropdown -->
                <li class="pc-rheader-submenu ">
                    <a href="javascript:void(0);" class="drop icon-circle displayChatbox">
                        <i class="ion-help-circled"></i> Help
                    </a>

                </li>
				<?php } ?>
                <!-- window screen 
                <li class="pc-rheader-submenu">
                    <a href="#!" class="drop icon-circle" onclick="javascript:toggleFullScreen()">
                        <i class="icon-size-fullscreen"></i>
                    </a>

                </li>-->
				<?php
					
					$sql = db::query("select USR_ID,USR_PREFIX,USR_FNAME,USR_LNAME,USR_PICTURE from USR_MAIN where USR_ID = '".$_SESSION["WF_USER_ID"]."'");
                  /*   echo "select USR_ID,USR_PREFIX,USR_FNAME,USR_LNAME,USR_PICTURE from USR_MAIN where USR_ID = '".$_SESSION["WF_USER_ID"]."'"; */
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
                        <span><img class="img-circle " src="<?php echo $profile_pic;?>" style="width:40px;border:2px solid #fff;" alt="User Image"></span>
                        <span><?php echo $rec["USR_PREFIX"].$rec["USR_FNAME"].' '.$rec["USR_LNAME"]."(".$rec_status["POS_NAME"].")";?><i class=" icofont icofont-simple-down"></i></span>

                    </a>
                    <ul class="dropdown-menu settings-menu">
                        <li><a href="../workflow/index.php"><i class="icon-wrench"></i> Frontend</a></li>
                        <li class="p-0">
                            <div class="dropdown-divider m-0"></div>
                        </li>
                        <li><a href="../process/profile.php"><i class="icon-user"></i> <?php echo $system_conf["conf_profile"];?></a></li>
                        <li class="p-0">
                            <div class="dropdown-divider m-0"></div>
                        </li>
                        <li><a href="logout.php"><i class="icon-logout"></i> <?php echo $system_conf["conf_logout"];?></a></li>

                    </ul>
                </li>
            </ul>

            
        </div>
    </nav>
</header>
<!-- Side-Nav-->
<aside class="main-sidebar hidden-print " >
    <section class="sidebar <?php if($template['active_page']== 'form-elements-materialize.php' || $template['active_page']== 'form-elements-advance.php' ){ echo "m-b-0" ;}?>" id="sidebar-scroll">
        <div class="user-panel">
            <div class="f-left image"><img src="<?php echo $profile_pic;?>" alt="User Image" class="img-circle"></div>
            <div class="f-left info">
                <p><?php echo $rec["USR_PREFIX"].$rec["USR_FNAME"].' '.$rec["USR_LNAME"];?> <span class="designation"> <i class="icofont icofont-caret-down m-l-5"></i></span></p>
                
            </div>
        </div>
        <!-- sidebar profile Menu-->
        <ul class="nav sidebar-menu extra-profile-list">
            <li>
                <a class="waves-effect waves-dark" href="../process/profile.php">
                    <i class="icon-user"></i>
                    <span class="menu-text">Profile</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li>
                <a class="waves-effect waves-dark" href="logout.php">
                    <i class="icon-logout"></i>
                    <span class="menu-text">Logout</span>
                    <span class="selected"></span>
                </a>
            </li>
        </ul>
        <!-- Sidebar Menu-->
        <?php if ($primary_nav) { ?>
            <ul class="sidebar-menu">
                <?php foreach( $primary_nav as $key => $link ) {
                    $link_class = '';
                    $li_active  = '';
                    $menu_link  = '';
                    // Get 1st level link's vital info
                    $url        = (isset($link['url']) && $link['url']) ? $link['url'] : '#!';
                    $active     = (isset($link['url']) && ($template['active_page'] == $link['url'])) ? ' active ' : '';
                    $icon       = (isset($link['icon']) && $link['icon']) ? '<i class="' . $link['icon'] . '"></i>' : '';
                    // Check if the link has a submenu
                    if($url != 'widget.php') {
                        if (isset($link['sub']) && $link['sub']) {
                            // Since it has a submenu, we need to check if we have to add the class active
                            // to its parent li element (only if a 2nd or 3rd level link is active)
                            foreach ($link['sub'] as $sub_link) {
                                if (in_array($template['active_page'], $sub_link)) {
                                    $li_active = ' class="active"';
                                    break;
                                }
                                // 3rd level links
                                if (isset($sub_link['sub']) && $sub_link['sub']) {
                                    foreach ($sub_link['sub'] as $sub2_link) {
                                        if (in_array($template['active_page'], $sub2_link)) {
                                            $li_active = ' class="active "';
                                            break;
                                        }
                                    }
                                }
                            }
                        }
                    }else{
                        if($template['active_page'] == 'widget.php') {
                            $li_active = ' class="active"';
                        }
                    }
                    if($template['active_page'] != 'mega-menu.php'){
                        for($n=1; $n<=10; $n++) {
                            if (isset($link['sub'.$n]) && $link['sub'.$n]) {
                                foreach ($link['sub'.$n] as $sub_link) {
                                    if (in_array($template['active_page'], $sub_link)) {
                                        $li_active = ' class="active"';
                                        break;
                                    }
                                }
                            }
                        }
                    }
                    if($template['active_page'] == 'mega-menu.php'){
                        if($url == 'mega-menu.php') {
                            $li_active = ' class="active"';
                        }
                    }
                    /* exit; */
                    ?>

                    <?php if ($link['name'] == 'Components' || $link['name'] == 'Useful Elements' || $link['name'] == 'Setting' ||  $link['name'] == 'Mega menu' ) { // ?>
                        <li <?php echo $li_active;?>>
                            <a href="<?php echo $url; ?>"><?php echo $icon; ?><span>  <?php echo $link['name'];?>  </span><i class="icon-arrow-down"></i><?php if($link['name'] == 'Useful Elements'){if (isset($link['opt']) && $link['opt']) { // If the header has options set ?><?php echo $link['opt']; ?><?php }} ?></a>
                            <ul class="mega-menu treeview-menu">
                        <?php for($n=1; $n<=10; $n++): ?>
                        <?php  if (isset($link['sub'.$n]) && $link['sub'.$n]) { ?>
                                <?php if($link['sub-title'.$n] == 'Latest Collection'){?>
                                    <li class="col-sm-3">
                                        <div class="card-block mega-card">
                                            <h6 class="sub-title m-b-20"><?php  echo $link['sub-title'.$n]; ?></h6>
                                            <div class="row m-b-20">
                                           <?php foreach ($link['sub'.$n] as $sub2_link){
                                            // Get 2rd level link's vital info
                                            $url    = (isset($sub2_link['url']) && $sub2_link['url']) ? $sub2_link['url'] : '#';
                                            $active = (isset($sub2_link['url']) && ($template['active_page'] == $sub2_link['url'])) ? ' class="h-active"' : '';
                                            ?>
                                               <div class="col-sm-4"><img src="<?php echo $url; ?>" alt="<?php echo $sub2_link['name']; ?>" class="img-fluid img-thumbnail">
                                               </div>
                                          <?php }?>
                                          </div>
                                            <div class="text-left">
                                                <button type="button" class="btn btn-success waves-effect waves-light">Add To Cart</button>
                                            </div>
                                        </div>
                                    </li>
                                    <?php }?>
                                <?php if($link['sub-title'.$n] != 'Latest Collection'){?>
                                <li class="col-md-3">
                                    <div class="card-block mega-card">
                                        <h6 class="sub-title"><?php  echo $link['sub-title'.$n]; ?></h6>
                                        <ul class="mega-list row">
                                            <?php if($link['subin'.$n] == ''){?>
                                            <li class="col-sm-12">
                                            <?php }else{?>
                                            <li class="col-sm-6">
                                                <?php }?>
                                                <ul>
                                                    <?php foreach ($link['sub'.$n] as $sub2_link){
                                                            // Get 4rd level link's vital info
                                                            $url    = (isset($sub2_link['url']) && $sub2_link['url']) ? $sub2_link['url'] : '#';
                                                            $active = (isset($sub2_link['url']) && ($template['active_page'] == $sub2_link['url'])) ? ' class="h-active"' : '';
                                                            ?>
                                                            <li<?php echo $active; ?>>
                                                                <a class="waves-effect waves-dark" href="<?php echo $url; ?>"><i class="icon-arrow-right"></i> <?php echo $sub2_link['name']; ?></a>
                                                            </li>
                                                        <?php }?>
                                                    </ul>
                                                </li>
                                            </li>
                                            <li class="col-sm-6">
                                                <?php  if (isset($link['subin'.$n]) && $link['subin'.$n]) { ?>
                                                    <ul>
                                                        <?php foreach ($link['subin'.$n] as $sub5_link){
                                                            // Get 4rd level link's vital info
                                                            $url    = (isset($sub5_link['url']) && $sub5_link['url']) ? $sub5_link['url'] : '#';
                                                            $active = (isset($sub5_link['url']) && ($template['active_page'] == $sub5_link['url'])) ? ' class="h-active"' : '';
                                                            ?>
                                                            <li<?php echo $active; ?>>
                                                                <a class="waves-effect waves-dark" href="<?php echo $url; ?>"> <i class="icon-arrow-right"></i> <?php echo $sub5_link['name']; ?></a>
                                                            </li>
                                                        <?php }?>
                                                    </ul>
                                                <?php }?>
                                                </li>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            <?php }?>
                            <?php }?>
                        <?php endfor; ?>
                            </ul>
                        </li>
                    <?php } else { // If it is a link ?>
                        
                        <li<?php echo $li_active; ?>>
                            <a href="<?php echo $url; ?>"><?php if (isset($link['sub']) && $link['sub']) { // if the link has a submenu ?><?php } echo $icon; ?><span><?php echo $link['name']; ?></span> <?php if (isset($link['opt']) && $link['opt']) { // If the header has options set ?><?php echo $link['opt']; ?><?php } ?><?php if($url != 'widget.php'){?> <i class="icon-arrow-down"></i> <?php }?></a>
                            <?php if (isset($link['sub']) && $link['sub']) { // if the link has a submenu ?>
                                <ul class="treeview-menu">
                                    <?php foreach ($link['sub'] as $sub_link) {
                                        $link_class = '';
                                        $li_active = '';
                                        $submenu_link = '';

                                        // Get 2nd level link's vital info
                                        $url        = (isset($sub_link['url']) && $sub_link['url']) ? $sub_link['url'] : '#';
                                        $active     = (isset($sub_link['url']) && ($template['active_page'] == $sub_link['url'])) ? 'active' : '';

                                        // Check if the link has a submenu
                                        if (isset($sub_link['sub']) && $sub_link['sub']) {
                                            // Since it has a submenu, we need to check if we have to add the class active
                                            // to its parent li element (only if a 3rd level link is active)
                                            foreach ($sub_link['sub'] as $sub2_link) {
                                                if (in_array($template['active_page'], $sub2_link)) {
                                                    $li_active = ' class="active treeview"';
                                                    break;
                                                }
                                            }
                                        }
                                        ?>

                                        <li<?php echo $li_active; ?>>
                                            <a href="<?php echo $url; ?>" class="waves-effect waves-dark <?php echo $active; ?> "><i class="icon-arrow-right"></i><?php echo $sub_link['name']; ?><?php if (isset($sub_link['opt']) && $sub_link['opt']) { // If the header has options set ?><?php echo $sub_link['opt']; ?><?php } ?><?php if($sub_link['name'] != 'Social'){ if (isset($sub_link['sub']) && $sub_link['sub']) { ?> <i class="icofont icofont-caret-right"></i> <?php }}?><?php if($sub_link['name'] == 'Social'){?> <i class="icofont icofont-caret-right"></i> <?php } ?></a>
                                            <?php if (isset($sub_link['sub']) && $sub_link['sub']) { ?>
                                                <ul class="treeview-menu">
                                                    <?php foreach ($sub_link['sub'] as $sub2_link) {
                                                        $link_class = '';
                                                        $li_active = '';
                                                        $submenu_link = '';
                                                        // Get 3rd level link's vital info
                                                        $url    = (isset($sub2_link['url']) && $sub2_link['url']) ? $sub2_link['url'] : '#';
                                                        $active = (isset($sub2_link['url']) && ($template['active_page'] == $sub2_link['url'])) ? ' active' : '';
                                                        $submenu_link = 'waves-effect waves-dark';
                                                        if ($submenu_link || $active) {
                                                            $link_class = ' class="'. $submenu_link . $active .'"';
                                                        }
                                                        ?>
                                                        <li>
                                                            <a  href="<?php echo $url; ?>"<?php echo $link_class; ?> ><i class="icon-arrow-right"></i><?php echo $sub2_link['name']; ?><?php if (isset($sub2_link['sub']) && $sub2_link['sub']) { ?><i class="icofont icofont-caret-right"></i><?php }?></a>
                                                            <?php if (isset($sub_link['sub']) && $sub_link['sub']) {
                                                                if($sub2_link['name'] == 'Level Three' && $sub2_link['opt'] == 'Level Three') { ?>
                                                                    <ul class="treeview-menu">
                                                                        <?php foreach ($sub2_link['sub'] as $sub4_link){
                                                                            // Get 4rd level link's vital info
                                                                            $url    = (isset($sub4_link['url']) && $sub4_link['url']) ? $sub4_link['url'] : '#';
                                                                            $active = (isset($sub4_link['url']) && ($template['active_page'] == $sub4_link['url'])) ? ' class="active"' : '';
                                                                            ?>
                                                                            <li>
                                                                                <a href="<?php echo $url; ?>"<?php echo $active ?>><i class="icon-arrow-right"></i><?php echo $sub4_link['name']; ?></a>
                                                                            </li>
                                                                        <?php }?>
                                                                    </ul>
                                                                <?php }?>
                                                            <?php }?>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>

                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        <?php }?>
    </section>
</aside>
<?php 
if($W != "" AND $WF_TYPE != ""){ ?>
<!-- Sidebar chat start -->
<div id="sidebar" class="p-fixed header-users showChat">
    <div class="had-container">
        <div class="card card_main header-users-main">
            <div class="card-content user-box">

                <div class="md-group-add-on">
                                 <span class="md-add-on">
                                    <i class="icofont icofont-search-alt-2 chat-search"></i>
                                 </span>
                    <div class="md-input-wrapper">
                        <input type="text" class="md-form-control"  name="username" id="search-friends">
                        <label for="username">ค้นหาตัวแปร</label>
                    </div>
                </div>
				<?php
					$WF_ARR_FIELD = array();
					$WF_ARR_NAME = array();

					$query_main = db::query("SELECT WF_MAIN_SHORTNAME,WF_FIELD_PK,WF_TYPE, WF_MAIN_NAME FROM WF_MAIN WHERE WF_MAIN_ID='".$W."'");
					$rec_data = db::fetch_array($query_main);

				switch(db::$_dbType)
				{
					case 'MSSQL':
						$relate_select = " ISNULL(WFS_OPTION_SELECT_DATA, WFS_FORM_SELECT)";
						break;
					case 'MYSQL':
						$relate_select = " IFNULL(WFS_OPTION_SELECT_DATA, WFS_FORM_SELECT)";
						break;
					case 'ORACLE':
						$relate_select = " NVL(WFS_OPTION_SELECT_DATA, WFS_FORM_SELECT)";
						break;
				}
					/*$sql_table_relate = db::query("SELECT WF_MAIN_SHORTNAME, WF_TYPE, WF_MAIN_ID, WF_MAIN_NAME
														FROM WF_MAIN 
														WHERE WF_MAIN_ID IN (
															SELECT $relate_select 
															FROM WF_STEP_FORM 
															WHERE WF_TYPE = 'W' 
															AND WFD_ID = '{$WFD}' 
															AND FORM_MAIN_ID IN (4,5,9,16) 
															GROUP BY WFS_OPTION_SELECT_DATA, WFS_FORM_SELECT
														  )");*/

					$WF_ARR_FIELD = db::show_field($rec_data["WF_MAIN_SHORTNAME"]);

				?>
				<style>
					.h_field{
						white-space: inherit;
						display: table;
						text-align: left;
						padding: 4px 7px;
						margin-left: 10px;
						margin-bottom: 4px;
						font-size: 85%;
					}
				</style>
				<div class="row-fluid">
					<div class="col" >
						<button type="button" class="btn btn-info btn-mini" data-toggle="modal" data-target="#bizModal" style="margin-left: 10px; margin-bottom: 5px;" onclick="open_modal('search_table.php','เลือกตาราง');"><i class="fa fa-search"></i> ค้นหา Table</button>
						<label id="default_database_link" class="label label-default h_field" onclick="load_help_field('<?php echo $W; ?>', '<?php echo $rec_data["WF_MAIN_SHORTNAME"]; ?>', '<?php echo $rec_data["WF_TYPE"]; ?>', 'N')" style="cursor: pointer;"><i class="fa fa-database"></i> Table :  <?php echo $rec_data["WF_MAIN_SHORTNAME"];?> - <?php echo $rec_data['WF_MAIN_NAME']; ?> <i id="h_<?php echo $rec_data["WF_MAIN_SHORTNAME"]; ?>"></i></label>
						<?php
						$array_color = array('W' => 'label-default', 'F' => 'label-warning', 'M' => 'label-success');
						/*while($rec_table_relate = db::fetch_array($sql_table_relate))
						{
							$badge_color = array_key_exists($rec_table_relate['WF_TYPE'], $array_color) ? $array_color[$rec_table_relate['WF_TYPE']] : 'bg-default';
						?>
							<label class="label text-left <?php echo $badge_color; ?> h_field" onclick="load_help_field('<?php echo $rec_table_relate['WF_MAIN_ID']; ?>', '<?php echo $rec_table_relate["WF_MAIN_SHORTNAME"]; ?>', '<?php echo $rec_table_relate['WF_TYPE']; ?>', 'N')" style="cursor: pointer;"><i class="fa fa-database"></i> Table :  <?php echo $rec_table_relate["WF_MAIN_SHORTNAME"];?> - <?php echo $rec_table_relate['WF_MAIN_NAME']; ?> <i id="h_<?php echo $rec_table_relate["WF_MAIN_SHORTNAME"]; ?>"></i></label>
						<?php }*/ ?>
						<span id="other_table_choose" style="display: none;">
							<label id="default_database_link" class="label label-info h_field"><i class="fa fa-database"></i> Table :  <?php echo $rec_data["WF_MAIN_SHORTNAME"];?> - <?php echo $rec_data['WF_MAIN_NAME']; ?> </label>
						</span>
					</div>
				</div>
                <div class="main-friend-list">
					<div id="show_help_field"></div>
					<div class="media friendlist-box">
						<div class="media-body">
							<div class="friend-header">&nbsp;</div>
						</div>
					</div>
					<div class="media friendlist-box">
						<div class="media-body">
							<div class="friend-header">&nbsp;</div>
						</div>
					</div>
					<div class="media friendlist-box">
						<div class="media-body">
							<div class="friend-header">&nbsp;</div>
						</div>
					</div>
                </div>

            </div>
        </div>
    </div>

</div>
<!-- Sidebar chat end-->
<?php } ?>