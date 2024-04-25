<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include 'include/comtop_user.php';
include 'comtop.php';

?>
    <!--::header part start::-->
    <?php include 'header.php';

    $wf_page = $_GET['wf_page'];
  	$wf_limit = $_GET['wf_limit'] == "" ? 30 : $_GET['wf_limit'];
  	if($wf_page == ''){
  		$wf_page = 1;
  	}
  	$wf_offset = ($wf_page-1)*$wf_limit;

    $sql = "SELECT * FROM M_SERVICE_CODE_LIST";
    $qry = db::query($sql);
    $total = db::num_rows($qry);
    $data_code = db::query_limit($sql,$wf_offset,$wf_limit);

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
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                      <?php include 'service_code_list_menu.php';?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6"><h4>รายการรหัสที่ให้บริการ</h4></div>
                  </div>
                    <!-- show lis api -->

                    <div class="table-responsive">
                    <table class="table">
                        <thead class="breadcrumb_bg" align="center">
                            <tr>
                                <th>ลำดับ </th>
                                <th>SERVICE CODE NAME</th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php

                                while($row = db::fetch_array($data_code)){
                                    $i++;
                                    $TYPE = $row['SERVICE_LIST_TYPE'];
                                    if($TYPE == 1){}
                                ?>
                                    <tr>
                                        <td align="center"><?php echo $i;?></td>
                                        <td align="left"><?php echo $row['SERVICE_CODE_NAME'];?></td>

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
    </section>

    <!-- footer part start-->
<?php include 'footer-1.php';?>
