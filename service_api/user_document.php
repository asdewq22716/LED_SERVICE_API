<?php
    // session_start();

    // if (!isset($_SESSION['username'])) {
    //     $_SESSION['msg'] = "log in";
    //     header('location: login.php');
    // }

    // if (isset($_GET['logout'])) {
    //     session_destroy();
    //     unset($_SESSION['username']);
    //     header('location: login.php');
    // }


?>
<?php include 'comtop.php';
 include 'include/comtop_user.php';?>
    <!--::header part start::-->
    <?php include 'header.php';
    $wf_page = $_GET['wf_page'];
    $wf_limit = $_GET['wf_limit'] == "" ? 30 : $_GET['wf_limit'];
    if($wf_page == ''){
        $wf_page = 1;
    }
    $wf_offset = ($wf_page-1)*$wf_limit;
    $sql = "SELECT * FROM M_SERVICE_MANAGE WHERE SERVICE_STATUS ='1' ";
    $qry = db::query($sql);
    $total = db::num_rows($qry);
    $data_api = db::query_limit($sql,$wf_offset,$wf_limit);
    ?>
    <!-- Header part end-->
    <style>
      th {
        color: white;
      }
    </style>
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
                    
                        <div class="col-md-6"><h4>รายการ Service ที่ให้บริการ</h4></div>
                        
                        <div class="col-md-6">
                          <?php include 'api_service_list_menu.php';?>
                        </div>
                    </div>

                    <div class="table-responsive">
                    <h5 style="color:#ff0000; ">* รายละเอียด Service สามารถดูได้ในกรณีที่ทำ MOU กับทางกรมบังคับคดีแล้ว</h5>
                    <table class="table">
                        <thead class="breadcrumb_bg" align="center">
                            <tr>
                                <th>ลำดับ </th>
                                <th>Service Code</th>
                                <th>Service Name</th>
                                <th>Service Description</th>
                                <th>SYSTEM</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if($total > 0){
                                $i = 1;
                                while($row = db::fetch_array($data_api)){ ?>


                                    <tr>
                                        <td align="center"><?php echo $i+$wf_offset;?></td>
                                        <td align="left"><a href="user_doc_api_1.php?SERVICE_ID=<?php echo $row['SERVICE_MANAGE_ID'];?>"><?php echo $row['SERVICE_CODE'];?></a></td>
                                        <td align="left"><?php echo $row['SERVICE_NAME'];?></td>
                                        <td align="left"><?php echo $row['SERVICE_DESC'];?></td>
                                        <td align="left"><?php echo $row['SYS_DETAIL'];?></td>
                                    </tr>
                                <?php  $i++; }
                            }else{ ?>
                            <tr><td class="text-center" colspan="3">ไม่พบข้อมูล</td></tr>
                            <?php }?>
                        </tbody>
                    </table>
                  </div>
                  <?php echo ($total>0)?endPaging($total,$wf_limit,$wf_page):"";?>
                </div>

                <div class="content">
                    <?php //if (isset($_SESSION['username'])) :?>
                        <!-- <p>Welcome <strong><?php //echo $_SESSION['username'];?> </strong></p> -->
                    <?php //endif ?>
                </div>
            </div>
    	</div>
    </section>

    <!-- footer part start-->
<?php include 'footer-1.php';?>
