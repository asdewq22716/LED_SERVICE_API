<?php include '../include/comtop_admin.php'; 
$sql_wf_main = db::query("SELECT WF_MAIN_ID FROM WF_MAIN WHERE WF_MAIN_STATUS='Y' AND WF_TYPE='W'");
$num_rows_wf = db::num_rows($sql_wf_main);

$sql_wf_form = db::query("SELECT WF_MAIN_ID FROM WF_MAIN WHERE WF_MAIN_STATUS='Y' AND WF_TYPE='F'");
$num_rows_form = db::num_rows($sql_wf_form);

$sql_wf_m = db::query("SELECT WF_MAIN_ID FROM WF_MAIN WHERE WF_MAIN_STATUS='Y' AND WF_TYPE='M'");
$num_rows_master = db::num_rows($sql_wf_m);

$sql_u = db::query("SELECT USR_ID FROM USR_MAIN WHERE USR_STATUS='Y'");
$num_rows_user = db::num_rows($sql_u);

/*$sql_update = "SELECT WFD_ID,USR_ID,WF_MAIN.WF_MAIN_ID,WF_MAIN_SHORTNAME,WF_FIELD_PK
FROM WF_STEP JOIN WF_MAIN on WF_STEP.WF_MAIN_ID=WF_MAIN.WF_MAIN_ID ORDER BY WF_STEP_ID DESC";*/
$sql_update = "SELECT WF_STEP_ID,WF_MAIN.WF_MAIN_ID,WF_MAIN.WF_MAIN_NAME,USR_ID,WF_DATE_SAVE,WF_TIME_SAVE,WF_VIEW_COL_DATA,WF_MAIN_SHORTNAME,WF_FIELD_PK,WFR_ID,WF_DATE_LOAD,WF_TIME_LOAD,WFD_ID FROM WF_STEP JOIN WF_MAIN on WF_STEP.WF_MAIN_ID=WF_MAIN.WF_MAIN_ID ORDER BY WF_STEP_ID DESC";
$query_update = db::query_limit($sql_update,0,10);
?>
   <div class="content-wrapper">
        <!-- Container-fluid starts -->
        <!-- Main content starts -->
        <div class="container-fluid">
            <div class="row">
                <div class="main-header">
                    <h4>Welcome to BizSmartFlow 4.0</h4>
                </div>
            </div>
            <!-- 4-blocks row start -->
            <div class="row m-b-30 dashboard-header">
                <div class="col-lg-3 col-sm-6">
                    <div class="dashboard-primary bg-success" onClick="window.location.href='workflow.php';" style="cursor:pointer">
                        <div class="sales-primary">
                            <i class="icofont icofont-chart-flow-alt-1"></i>
                            <div class="f-right">
                                <h2 class="counter"><?php echo $num_rows_wf;?></h2>
                                <span><nobr>Active Workflow</nobr></span>
                            </div>
                        </div>
                        <div class="bg-dark-success">
                            <p class="week-sales">Workflow Management</p> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="bg-warning dashboard-success" onClick="window.location.href='form.php';" style="cursor:pointer">
                        <div class="sales-success">
                            <i class="zmdi zmdi-format-list-bulleted"></i>
                            <div class="f-right">
                                <h2 class="counter"><?php echo $num_rows_form;?></h2>
                                <span><nobr>Active Form</nobr></span>
                            </div>
                        </div>
                        <div class="bg-dark-warning">
                            <p class="week-sales">Form Management</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="dashboard-primary bg-primary" onClick="window.location.href='master.php';" style="cursor:pointer">
                        <div class="sales-warning">
                            <i class="fa fa-table"></i>
                            <div class="f-right">
                                <h2 class="counter"><?php echo $num_rows_master;?></h2>
                                <span><nobr>Active Master Data</nobr></span>
                            </div>
                        </div>
                        <div class="bg-dark-primary">
                            <p class="week-sales">Master Management</p> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="bg-facebook dashboard-facebook" onClick="window.location.href='user_list.php';" style="cursor:pointer">
                        <div class="sales-facebook">
                            <i class="icon-people"></i>
                            <div class="f-right">
                                <h2 class="counter"><?php echo $num_rows_user;?></h2>
                                <span><nobr>User(s)</nobr></span>
                            </div>
                        </div>
                        <div class="bg-dark-facebook">
                            <p class="week-sales">User Management</p> 
                        </div>
                    </div>
                </div>

            </div>
            <!-- 4-blocks row end -->
			
			
            <!-- 2-1 block start -->
            <div class="row">
                <div class="col-xl-8 col-lg-12">
                    <div class="card">
						<div class="card-header"><h5 class="card-header-text"><i class="icon-clock"></i> Recent Activity</h5></div>
                        <div class="card-block">
                            <div class="table-responsive">
                                <table class="table m-b-0 photo-table">
                                    <thead>
                                    <tr class="text-uppercase">
                                        <th style="width:10%">Users</th>
                                        <th style="width:35%">Workflow</th>
                                        <th style="width:35%">รายการที่ทำ</th>
                                        <!--<th>Status</th>-->
                                        <th style="width:20%">วันที่ / เวลา</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
									while($rec_data = db::fetch_array($query_update)){
										$sql_user_u = db::query("select USR_ID,USR_PREFIX,USR_FNAME,USR_LNAME,USR_PICTURE,USR_USERNAME from USR_MAIN where USR_ID = '".$rec_data["USR_ID"]."'");
										$rec_u = db::fetch_array($sql_user_u);
										
										if($rec_u["USR_PICTURE"] != ''){
											$profile_pic_update = '../profile/'.$rec_u["USR_PICTURE"];
										}else{
											$profile_pic_update = '../assets/images/avatar-2.png';
										}
										
										$sql_workflow = "select * from ".$rec_data["WF_MAIN_SHORTNAME"]." where ".$rec_data['WF_FIELD_PK']." = '".$rec_data['WFR_ID']."' ";
										$query_workflow = db::query($sql_workflow);
										$WF = db::fetch_array($query_workflow);
									?>
										<tr>
											<th>
												<img class="img-fluid img-circle" src="<?php echo $profile_pic_update;?>" alt="User"><br>
												</p>
											</th>
											<td><?php echo step_name($rec_data["WFD_ID"]);?>
												<p><?php echo $rec_data["WF_MAIN_NAME"];?></p>
												
											</td>
											<td>
												<?php 
												$str = '';
												$tb_data = str_replace("|",' ',$rec_data['WF_VIEW_COL_DATA']);
												
												echo nl2br(bsf_show_text($rec_data["WF_MAIN_ID"],$WF,$tb_data));
												
												//echo $str;
												?>
											</td>
											<td>
											<?php echo $rec_u["USR_PREFIX"].$rec_u["USR_FNAME"].' '.$rec_u["USR_LNAME"].'<br><p>'.db2date($rec_data["WF_DATE_SAVE"]).'  '.$rec_data["WF_TIME_SAVE"].'</p>';?></td>
										</tr>
									
									
									<?php }?>
									

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-12">
                    <div class="card">
                        <div class="user-block-2">
                            <img class="img-fluid" style="width:128px;border:5px solid #fff;" src="<?php echo $profile_pic; ?>" alt="user-header">
                            <h5><?php echo $rec["USR_PREFIX"].$rec["USR_FNAME"].' '.$rec["USR_LNAME"];?></h5>
                        </div>
                        <div class="card-block">
                            <!--<div class="user-block-2-activities">
                                <div class="user-block-2-active">
                                    <i class="icofont icofont-clock-time"></i> Recent Activities
                                    <label class="label label-primary">480</label>
                                </div>
                            </div>
                            <div class="user-block-2-activities">
                                <div class="user-block-2-active">
                                    <i class="icofont icofont-users"></i> Current Employees
                                    <label class="label label-primary">390</label>
                                </div>
                            </div>

                            <div class="user-block-2-activities">
                                <div class="user-block-2-active">
                                    <i class="icofont icofont-ui-user"></i> Following
                                    <label class="label label-primary">485</label>
                                </div>

                            </div>
                            <div class="user-block-2-activities">
                                <div class="user-block-2-active">
                                    <i class="icofont icofont-picture"></i> Pictures
                                    <label class="label label-primary">506</label>
                                </div>

                            </div>-->
                            <div class="m-b-10 text-center">
                                <a href="../process/profile.php" class="btn btn-success waves-effect waves-light text-uppercase m-r-30" >
                                    <i class="icon-user"></i> <?php echo $system_conf["conf_profile"];?>
                                </a>
                                <a href="logout.php" class="btn btn-danger waves-effect waves-light text-uppercase" >
                                    <i class="icon-logout"></i> <?php echo $system_conf["conf_logout"];?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 2-1 block end -->
			
             
           
        </div>
        <!-- Main content ends -->



        <!-- Container-fluid ends -->
    </div>
</div>


<?php include '../include/combottom_js.php'; ?>
<?php include '../include/combottom_admin.php'; ?>
