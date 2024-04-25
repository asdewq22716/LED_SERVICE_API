
<?php
include 'include/comtop_user.php';
include 'comtop.php';
?>
    <!--::header part start::-->
    <?php
      include 'header.php';
      $wf_page = $_GET['wf_page'];
    	$wf_limit = $_GET['wf_limit'] == "" ? 30 : $_GET['wf_limit'];
    	if($wf_page == ''){
    		$wf_page = 1;
    	}
    	$wf_offset = ($wf_page-1)*$wf_limit;

      $search = $_GET['SEARCH'];

      $filter = "";
      if($search){
        $filter = "AND DEP_GROUP_NAME LIKE '%".$search."%'";
      }

      $sql = "SELECT * FROM M_DEP_GROUP WHERE 1=1 {$filter} ORDER BY DEP_GROUP_ID DESC";
      $qry = db::query($sql);
      $total = db::num_rows($qry);
      $data_main = db::query_limit($sql,$wf_offset,$wf_limit);
    // print_r($total);
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
                        <!-- <div class="col-md-6"><h4>จัดการข้อมูลผู้ใช้</h4></div> -->
                        <div class="col-md-6"><h4>กลุ่มสิทธิ์ภายในหน่วยงาน</h4></div>
                        <div class="col-md-6">

                        </div>
                    </div>

                    <!-- show lis api -->

                    <form method="get" class="form-inline" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                      <label class="my-1 mr-2" for="inlineFormCustomSelectPref">ชื่อกลุ่มสิทธิ์</label>
                      <input type="text" id="SEARCH" name="SEARCH" class="form-control" value="<?php echo $search;?>">

                      <button type="submit" class="btn btn-primary my-1">ค้นหา</button>
                    </form>


                    <div class="table-responsive">
                    <table class="table">
                        <thead class="breadcrumb_bg">
                            <tr>
                                <th class="text-center" scope="col">ลำดับ</th>
                                <th class="text-center" scope="col">ชื่อกลุ่มสิทธิ์</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php if($total > 0){
                            $i = 1;
                            while ($data = db::fetch_array($data_main)) {?>
                              <tr>
                                <td class="text-center"><?php echo $i+$wf_offset;?></td>
                                <td><?php echo $data['DEP_GROUP_NAME'];?></td>
                              </tr>
                            <?php
                            $i++;
                          }
                        }else{?>
                            <tr><td class="text-center" colspan="3">ไม่พบข้อมูล</td></tr>
                          <?php }?>
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
            <?php echo ($total>0)?endPaging($total,$wf_limit,$wf_page):"";?>
    	</div>
    </section>

    <!-- footer part start-->
<?php include 'footer-1.php';?>
