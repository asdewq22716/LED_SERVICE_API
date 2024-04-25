<?php
 if($_POST['proc'] == 'get_command') {

  
    }
    ?>
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
        $filter = "AND (USR_FNAME LIKE '%".$search."%' OR USR_LNAME LIKE '%".$search."%')";
      }
      
      $name = $_SESSION['username'];
      $sql_usr = db::query("SELECT * FROM USER_API_SERVICE WHERE USR_USERNAME = '$name'");
      $data_usr = db::fetch_array($sql_usr);
 
      $sql = "SELECT * FROM USER_API_SERVICE WHERE SYSTEM_TYPE = '".$data_usr[SYSTEM_TYPE]."' AND GROUP_ID NOT IN (1) AND 1=1 {$filter} ORDER BY USR_ID DESC";
      $qry = db::query($sql);
      $total = db::num_rows($qry);
      $data_main = db::query_limit($sql,$wf_offset,$wf_limit);
    // print_r($total);
    ?>
      <style>
        th {
          color: white;
        }
        .btn-mini {
            padding: 5px 10px;
            line-height: 14px;
            font-size: 10px;
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
                        <div class="col-md-6"><h4>ข้อมูลผู้ใช้งานระบบ</h4></div>
                        <div class="col-md-6">

                        </div>
                    </div>

                    <!-- show lis api -->

                    <form method="get" class="form-inline" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                      <label class="my-1 mr-2" for="inlineFormCustomSelectPref">ชื่อ-นามสกุล</label>
                      <input type="text" id="SEARCH" name="SEARCH" class="form-control" value="<?php echo $search;?>"> &nbsp;

                      <button type="submit" class="btn btn-primary my-1">ค้นหา</button>
                    </form>
                    <br>

                    <div class="table-responsive">
                    <table class="table">
                        <thead class="breadcrumb_bg">
                            <tr>
                                <th class="text-center" scope="col">ลำดับ</th>
                                <th class="text-center" scope="col">ชื่อ-สกุล</th>
                                <th class="text-center" scope="col">เลขประจำตัวประชาชน</th>
                                <th class="text-center" scope="col">สถานะการใช้ Token</th>
                                <th class="text-center" scope="col">เพิ่มเติม</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php if($total > 0){
                            $i = 1;
                            while ($data = db::fetch_array($data_main)) {?>
                              <tr>
                                <td class="text-center"><?php echo $i+$wf_offset;?></td>
                                <td><?php echo $data['USR_PREFIX'].$data['USR_FNAME']." ".$data['USR_LNAME'];?></td>
                                <td><?php echo $data['ID_CARD'];?></td>
                                <td><?php 
                                    if($data['TOKEN_ID'] != ''){
                                        echo 'พร้อมใช้งาน';
                                    }else {
                                        echo 'ไม่พร้อมใช้งาน';
                                    }
                                    
                                ?></td>
                                <td class="text-center"><button class="btn btn-success btn-mini"  onclick="gen_token(<?php echo $data['USR_ID'] ?>);">get token</button></td>
                              </tr>
                            <?php
                            $i++;
                          }
                        }else { ?>
                            <tr><td class="text-center" colspan="3">ไม่พบข้อมูล</td></tr>
                          <?php } ?>
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
<script>
	function gen_token(id){
		$.ajax({
			   type: "POST",
			   url: 'user_gen_token.php',
			   data: {USR_ID : id}, // serializes the form's elements.
			   success: function(data)
			   {
					alert("Gen Token สำเร็จ");
			   }

			});
	}


	</script>