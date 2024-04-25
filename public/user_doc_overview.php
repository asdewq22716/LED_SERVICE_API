
<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include 'include/comtop_user.php';
include 'comtop.php';
if (($_SESSION['GROUP_ID'] != 2)) {
    session_destroy();
    unset($_SESSION['GROUP_ID']);
    header('location: login.php');
}
?>
    <!--::header part start::-->
    <?php include 'header.php';

    $wf_page = $_GET['wf_page'];
    $wf_limit = $_GET['wf_limit'] == "" ? 30 : $_GET['wf_limit'];
    if($wf_page == ''){
        $wf_page = 1;
    }
    $wf_offset = ($wf_page-1)*$wf_limit;

    $username = $_SESSION['username'];
    $sql_id = db::query("SELECT * FROM USER_API_SERVICE WHERE USR_USERNAME = '".$username."'");
    $data_id = db::fetch_array($sql_id);
    
    $sql = "SELECT * FROM M_LOG WHERE USR_ID = '".$data_id['USR_ID']."'";
    $qry = db::query($sql);
    $total = db::num_rows($qry);
    $data_code = db::query_limit($sql,$wf_offset,$wf_limit);

    $date = date2db(date("d/m/").(date("Y")+543));
    ?>

    
    <!-- Header part end-->

    <!-- breadcrumb start -->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>API Documentation</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->


    <section id="tabs">
    	<div class="container">
      		<div class="row">
                <div class="col-md-4">
                <?php include 'left_menu.php';?>

                </div>
                <div class="col-md-8">
                  <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                      
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-10"><h4>Overview</h4> </div>
                    <div><h6>Reset/password</h6> </div>
                  </div>
                    <!-- show lis api -->

                    <div class="padding-20 shadow">
                        <h3>Data Transection Log <?php echo db2date($date);?></h3>
                        
            
                        <?php 
                           
                                
                            $chk_y = db::query("SELECT LOG_ID FROM M_LOG WHERE USR_ID = '".$data_id['USR_ID']."' AND REQUEST_STATUS = '200'  AND LOG_DATE = '".$date."' ");
                            $log_y = db::num_rows($chk_y);
                           

                    
                            $chk_n = db::query("SELECT LOG_ID FROM M_LOG WHERE USR_ID = '".$data_id['USR_ID']."' AND REQUEST_STATUS NOT IN ('200') AND LOG_DATE = '".$date."'");
                            $log_n = db::num_rows($chk_n);
                            

                            $sum = $log_y['logy'] + $log_n['logn'];

                           
                            // print_pre($data_log);     
                        ?>
                        <div class="form-row" align="center" >
                           
                            <div class="form-group col-md-4 col-sm-4 padding-20 shadow">
                            <i class="fa fa-link" style="font-size: 50pt; color: #A8164E"></i><?php  echo  '<br><br>จำนวนครั้งที่ Request '.$sum;?>
                            </div> 
                            <div class="form-group col-md-4 col-sm-4 padding-20 shadow">
                            <i class="fa fa-check-square"  style="font-size: 50pt; color: #28a745"></i><?php echo  '<br><br>ผ่าน '.$log_y['logy'];?>
                            </div>
                            <div class="form-group col-md-4 col-sm-4 padding-20 shadow">
                            <i class="fa fa-exclamation-triangle"  style="font-size: 50pt;color: #ffc107"></i><?php echo  '<br><br>ไม่ผ่าน '.$log_n['logn'];?>
                            </div>
                        
                         </div>
                        
                        
                                    
                            <div class="mt-4 "align="left">
                            <h3>History Log</h3>
                            </div>
                            <div class="mt-4 ">
                                <table class="table">
                                <thead class="breadcrumb_bg" align="center">
                                    <tr>
                                        <th style="color: #FFFF;" >Web Service API </th>
                                        <th style="color: #FFFF;" >IPADDRESS</th>
                                        <th style="color: #FFFF;" >Date/Time</th>
                                        <th style="color: #FFFF;" >Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                <?php

                                    while($row = db::fetch_array($data_code)){
                                      
                                        
                                    ?>
                                        <tr>
                                            <td align="center"><?php echo $row['REQUEST'];?></td>
                                            <td align="left"><?php echo $row['IP_ADDRESS'];?></td>
                                            <td align="center"><?php echo db2date($row['LOG_DATE']);?></td>
                                            <td align="left"><?php echo $row['REQUEST_STATUS'];?></td>

                                        </tr>
                                    <?php  }
                                    ?>
                                </tbody>
                                </table>
                            </div>
                            <?php echo ($total>0)?endPaging($total,$wf_limit,$wf_page):"";?>
                    </div>

                </div>
            </div>
    	</div>
    </section>

    <!-- footer part start-->
<?php include 'footer-1.php';?>
