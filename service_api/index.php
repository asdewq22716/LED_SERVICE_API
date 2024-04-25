<?php include 'comtop.php';?>
    <!--::header part start::-->
    <?php include 'header.php';?>
    <!-- Header part end-->

    <!-- login part start-->
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
                            <h1 class="font-poppins">DATA API LED</h1>
                            <form>
                              <div class="form-group">
                                <label for="exampleInputEmail1" hidden>ชื่อผู้ใช้</label>
                                <input type="text" autocomplete="off" class="form-control border-radius-50 " id="username" placeholder="ชื่อผู้ใช้">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1" hidden>รหัสผ่าน</label>
                                <input type="password" class="form-control border-radius-50 " id="password" placeholder="รหัสผ่าน">
                              </div>

                                <a class="button button-contactForm btn-block border-radius-50 btn_1" href="user_document.php" role="button">เข้าสู่ระบบ</a>


                              <div class="text-center mt-4">
                                <a href="register.php" title="ลงทะเบียน"><em class="fa fa-user"></em> ลงทะเบียน</a> | <a href="#ModalForgetPW" rel="modal:open" title="ลืมรหัสผ่าน"> <em class="fa fa-question"></em> ลืมรหัสผ่าน</a>
                              </div>
                            </form>
                            <!-- <a href="#" class="btn_1">login</a>
                            <a href="#" class="btn_2">register</a> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">

                </div>
            </div>
        </div>
    </section>
    <!-- login part start-->
    <!-- ModalForgetPW -->
    <div class="modal" id="ModalForgetPW" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="padding-20">
        <form>
          <div class="form-group">
            <label for="inputIDCard">รหัสบัตรประชาชน</label>
            <input type="text" name="inputIDCard" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
             required class="single-input" >
            <small id="emailHelp" class="form-text text-muted">กรุณากรอกเลขรหัสบัตรประชาชน 13 หลัก</small>
          </div>
          <div class="form-group">
            <label for="inputemail">อีเมล</label>
            <input type="text" name="inputemail" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
             required class="single-input" >
          </div>
          <button type="submit" class="btn btn-primary">ส่งคำขอรหัสผ่านใหม่</button>
        </form>
      </div>
    </div>

    <!-- footer part start-->
    <?php include 'footer-1.php';?>
<?php //include 'footer.php';?>
