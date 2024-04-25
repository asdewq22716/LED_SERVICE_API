
<?php 
	include 'comtop.php';
    include 'include/comtop_user.php';
?>
    <!--::header part start::-->
    <?php include 'header.php';?>
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
                        <div class="col-md-6"><h4>HTTP Status Code</h4></div>
                        <div class="col-md-6">
                        
                        </div>
                    </div>
                    
                    <!-- show lis api -->
                    
                    <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ลำดับ</th>
                                <th scope="col">HTTP</th>
                                <th scope="col">คำอธิบาย</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $sql_http = db::query("SELECT * FROM M_HTTP_STATUS_CODE ");
                                while($row = db::fetch_array($sql_http)){ 
                                    $i++;
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $i;?></td>
                                        <td align="left"><?php echo $row['HTTP_CODE'];?></td>
                                        <td align="left"><?php echo $row['HTTP_DETAILS'];?></td>
                                    </tr>

                                <?php }
                            ?>
                        </tbody>
                    </table>
        </div>
                    
                
  
                    

                </div>
            </div>
    	</div>
    </section>

    <!-- footer part start-->
<?php include 'footer-1.php';?>
