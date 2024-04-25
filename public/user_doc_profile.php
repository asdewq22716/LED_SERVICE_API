

<?php

include 'include/comtop_user.php';
include 'comtop.php';


?>
<!--::header part start::-->
<?php include 'header.php';?>

<style>
  th {
    color: white;
}
</style>
<!-- Header part end-->
<?php
    // $name = $_SESSION['username'];
$USR_ID = $_SESSION['USR_ID'];
$sql = db::query("SELECT * FROM USER_API_SERVICE WHERE USR_ID = '".$USR_ID."'");
$data_usr = db::fetch_array($sql);


$sql_sys = db::query("SELECT * FROM M_SYSTEM WHERE SYSTEM_ID = '".$data_usr['SYSTEM_TYPE']."'");
$data_sys = db::fetch_array($sql_sys);


?>
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
            <div class="col-md-10"><h4>PROFILE</h4> </div>
            <?php /* <div><h6>Reset/password</h6> </div> */ ?>
        </div>
        <!-- show lis api -->

        <div class="padding-20 shadow">
            <table>
                <tr>
                    <td><label>หน่วยงาน</label></td>
                    <td><input type="text" style="height:35px" class="form-control" value="<?php echo $data_sys['SYS_NAME'];?>" readonly ></td>
                </tr>
                <tr>
                    <td><label>บัญชีผู้ใช้</label></td>
                    <td><input type="text" style="height:35px" class="form-control" value="<?php echo $data_usr['USR_USERNAME'];?>" readonly></td>
                </tr>
                <tr>
                    <td><label>EMAIL</label></td>
                    <td><input type="text" style="height:35px" class="form-control" value="<?php echo $data_usr['USR_EMAIL'];?>"  readonly></td>
                </tr>
                <tr>
                    <td><label></label></td>
                    <td><h3>User Token</h3></td>
                </tr>
                <table>
                    <tr>
                        <td width="75"><label></label></td>
                        <td><textarea tabindex="10" style="width: 400px;  height: 150px;"  class="form-control form-txtAr-2rows" readonly><?php echo $data_usr['TOKEN_ID'];?></textarea></td>

                    </tr>
                </table>
            </table>
        </div>
                    <!-- <div class="content">
                        <?php if (isset($_SESSION['username'])) :?>
                            <p>Welcome <strong><?php echo $_SESSION['username'];?> </strong></p>
                            <p><a href="login.php?logout='1'" style="color: red;">Logout</a></p>
                        <?php endif ?>
                    </div> -->
                </div>
            </div>
        </div>
    </section>

    <!-- footer part start-->
    <?php include 'footer-1.php';?>
