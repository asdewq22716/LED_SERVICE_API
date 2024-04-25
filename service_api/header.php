<?php  
   
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }

?>
<header class="main_menu home_menu">
  <div class="container">
    <nav class="navbar navbar-light ">
      <a  href="index.php" class="navbar-brand"><img src="images/logo.png" style="width:60px;"> กรมบังคับคดี</a>
      <ul class="nav justify-content-end">
        
        <?php if($_SESSION['GROUP_ID'] == '1' || $_SESSION['GROUP_ID'] == '2') { ?> 

            <li class="nav-item">
              <a class="nav-link active" href="user_doc_profile.php">ข้อมูลผู้ใช้งานระบบ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">สำหรับนักพัฒนา</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="#">สมัครสมาชิก</a>
            </li> -->
            <?php if (isset($_SESSION['username'])) :?>
              <li class="nav-item">
                <a class="nav-link" href="login.php?logout='1'">ออกจากระบบ</a>
              </li>
            <?php endif ?>
            

         <?php  } else { ?>
 
         
            <li class="nav-item">
              <a class="nav-link active" href="user_document.php">สำหรับนักพัฒนา</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="register.php">สมัครสมาชิก</a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" href="login.php">เข้าสุ่ระบบ</a>
            </li>

         <?php    }?>
          
        
        <!-- <li class="nav-item">
          <a class="nav-link active" href="user_document.php">สำหรับนักพัฒนา</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">สมัครสมาชิก</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php">เข้าสุ่ระบบ</a>
        </li> -->
      </ul>
    </nav>
  </div>
</header>
