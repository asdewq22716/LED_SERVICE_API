<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include 'include/comtop_user.php';
include 'comtop.php';
session_start();
?>
    <!--::header part start::-->
    <?php include 'header.php';

    if(isset($_SESSION['PERMISSION_GROUP_ID'])){
      $qry_permission = db::query("SELECT SERVICE_MANAGE_ID FROM SERVICE_MAPPING_GROUP WHERE PRIVILEGE_GROUP_ID = '".$_SESSION['PERMISSION_GROUP_ID']."' ORDER BY SERVICE_MANAGE_ID ASC");
      $permission_id = "";
      // $rec_permission = db::fetch_array($qry_permission)
      while($rec_permission = db::fetch_array($qry_permission)) {
        if(empty($permission_id)){
          $permission_id .= $rec_permission['SERVICE_MANAGE_ID'];
        }else{
          $permission_id .= ",".$rec_permission['SERVICE_MANAGE_ID'];
        }
      }
    }
    if(!empty($permission_id)){
      $filter = " AND SERVICE_MANAGE_ID IN ($permission_id)";
    }else{
      $filter = "";
    }

    $wf_page = $_GET['wf_page'];
    $wf_limit = $_GET['wf_limit'] == "" ? 30 : $_GET['wf_limit'];
    if($wf_page == ''){
        $wf_page = 1;
    }
    $wf_offset = ($wf_page-1)*$wf_limit;
    $sql = "SELECT * FROM M_SERVICE_MANAGE WHERE SERVICE_STATUS ='1' {$filter}";
    $qry = db::query($sql);
    $total = db::num_rows($qry);
    $data_api = db::query_limit($sql,$wf_offset,$wf_limit);

    ?>
    <style>
      th {
        color: white;
      }
    </style>
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
                        <div class="col-md-6"><h4>ตั้งค่ารายการ Service API</h4></div>
                        <div class="col-md-6">
                          <?php include 'api_service_list_menu.php';?>
                        </div>
                    </div>

                    <!-- show lis api -->

                    <div class="table-responsive">
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
                                        <td align="left"><?php echo $row['SERVICE_CODE'];?></td>
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
            </div>
    	</div>
    </section>

    <!-- footer part start-->
<?php include 'footer-1.php';?>
