<?php	
include 'comtop.php';

include 'include/comtop_user.php';

	$sql = db::query("SELECT * FROM USER_API_SERVICE WHERE USR_USERNAME = '".$_GET['name']."' AND USR_ID = '".$_GET['uid']."' ");
	
	$objResult = db::fetch_array($sql);
	
        unset($cond);
	    unset($field);
        $cond['USR_USERNAME'] = $_GET['name'];
        $cond['USR_ID'] = $_GET['uid'];
        $field['USER_STATUS'] = "1";
        db::db_update('USER_API_SERVICE', $field, $cond);

		
?>        


<header class="main_menu home_menu">
    <div class="container">
        <nav class="navbar navbar-light ">
            <a  href="login.php" class="navbar-brand"><img src="images/logo.png" style="width:60px;"> กรมบังคับคดี</a>
        </nav>
       
    </div>
</header>
<section class="banner_part">
        <div class="container">
            <div class="row  text-center">
              <div class="col-lg-3  ">

              </div>
                <div class="col-lg-6">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <!-- <img src="images/logo.png" class="mb-3"/> -->
                            <!-- <h5>กรมบังคับคดี</h5></h5> -->
                            <div class="modal" id="ModalForgetPW" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: inline-block;">
                            <div class="padding-20">
                           
                                <form align="center">
                                <h2 class="font-poppins">ยืนยันการลงทะเบียนสำเร็จ</h2>
                                <a type="button"  class="btn btn-primary" href="login.php">เข้าสุ่ระบบ</a>
                               
                                </form>
                            </div>
                            </div>
                            <!-- <a href="#" class="btn_1">login</a>
                            <a href="#" class="btn_2">register</a> -->
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
