<?php

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }

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
      if(empty($_SESSION)){
        $filter = "AND 1 = 1";
      }else{
        $filter = "AND 1 != 1";
      }
    }
    // echo $permission_id;
?>
<?php
// include 'include/comtop_user.php';
$civil_service = db::query("SELECT * FROM M_SERVICE_MANAGE WHERE SYS_DETAIL = 'ระบบงานบังคับคดีแพ่ง' {$filter}");
$bank_service = db::query("SELECT * FROM M_SERVICE_MANAGE WHERE SYS_DETAIL = 'ระบบงานบังคับคดีล้มละลาย' {$filter}");
$revive_service = db::query("SELECT * FROM M_SERVICE_MANAGE WHERE SYS_DETAIL = 'ระบบงานฟื้นฟูกิจการของลูกหนี้' {$filter}");
$mediate_service = db::query("SELECT * FROM M_SERVICE_MANAGE WHERE SYS_DETAIL = 'ระบบงานไกล่เกลี่ยข้อพิพาท' {$filter}");
$back_service = db::query("SELECT * FROM M_SERVICE_MANAGE WHERE SYS_DETAIL = 'ระบบ Back office' {$filter}");
?>
<div class="nav-side-menu">
  <!-- <?php print_pre($_SESSION); ?> -->
    <div class="brand"><h3>API Documentation</h3></div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

        <div class="menu-list">
            <?php
                 if($_SESSION['GROUP_ID'] == '1'){ //admin  ?>
                    <ul id="menu-content" class="menu-content collapse out">
                        <li  data-toggle="collapse" data-target="#products" class="collapsed active">
                            <a href="#"><i class="fa fa-table" aria-hidden="true"></i> API SERVICE</a>
                        </li>
                    <ul class="sub-menu collapse" id="products">
                        <li  data-toggle="collapse" data-target="#products1" class="collapsed active">
                            <a href="#"> API SERVICE LIST </a>
                        </li>
                        <ul class="sub-menu collapse" id="products1">
                        <li>- <a href="api_service_list.php">ตั้งค่ารายการ Service API</a></li>
                        <li data-toggle="collapse" data-target="#civil_service" class="collapsed active"> - <a href="#">ระบบงานบังคับคดีแพ่ง</a></li>
                        <ul class="sub-menu collapse" id="civil_service">
                        <?php
                        while ($rec_service = db::fetch_array($civil_service)) {
                            echo "<li><a href=\"user_doc_api_1.php?SERVICE_ID=".$rec_service['SERVICE_MANAGE_ID']."\">".$rec_service['SERVICE_CODE']." : ".$rec_service['SERVICE_DESC']."</a></li>";
                        }?>
                        </ul>
                        <li data-toggle="collapse" data-target="#bankrupt_service" class="collapsed active"> - <a href="#">ระบบงานบังคับคดีล้มละลาย</a></li>
                        <ul class="sub-menu collapse" id="bankrupt_service">
                            <?php
                            while ($rec_service = db::fetch_array($bank_service)) {
                            echo "<li><a href=\"user_doc_api_1.php?SERVICE_ID=".$rec_service['SERVICE_MANAGE_ID']."\">".$rec_service['SERVICE_CODE']." : ".$rec_service['SERVICE_DESC']."</a></li>";
                            }?>
                        </ul>
                        <li data-toggle="collapse" data-target="#revive_service" class="collapsed active"> - <a href="#">ระบบงานฟื้นฟูกิจการของลูกหนี้</a></li>
                        <ul class="sub-menu collapse" id="revive_service">
                            <?php
                            while ($rec_service = db::fetch_array($revive_service)) {
                            echo "<li><a href=\"user_doc_api_1.php?SERVICE_ID=".$rec_service['SERVICE_MANAGE_ID']."\">".$rec_service['SERVICE_CODE']." : ".$rec_service['SERVICE_DESC']."</a></li>";
                            }?>
                        </ul>
                        <li data-toggle="collapse" data-target="#mediate_service" class="collapsed active"> - <a href="#">ระบบงานไกล่เกลี่ยข้อพิพาท</a></li>
                        <ul class="sub-menu collapse" id="mediate_service">
                            <?php
                            while ($rec_service = db::fetch_array($mediate_service)) {
                            echo "<li><a href=\"user_doc_api_1.php?SERVICE_ID=".$rec_service['SERVICE_MANAGE_ID']."\">".$rec_service['SERVICE_CODE']." : ".$rec_service['SERVICE_DESC']."</a></li>";
                            }?>
                        </ul>
                        <li data-toggle="collapse" data-target="#backOffice_service" class="collapsed active"> - <a href="#">ระบบ Back office</a></li>
                        <ul class="sub-menu collapse" id="backOffice_service">
                            <?php
                            while ($rec_service = db::fetch_array($back_service)) {
                            echo "<li><a href=\"user_doc_api_1.php?SERVICE_ID=".$rec_service['SERVICE_MANAGE_ID']."\">".$rec_service['SERVICE_CODE']." : ".$rec_service['SERVICE_DESC']."</a></li>";
                            }?>
                        </ul>
                    </ul>

                        <li  data-toggle="collapse" data-target="#products2" class="collapsed active">
                            <a href="#">SERVICE CODE</a>
                        </li>
                    <ul class="sub-menu collapse" id="products2">
                        <li>- <a href="api_service_code.php">รายการรหัสที่ให้บริการ</a></li>
                        <li>- <a href="user_doc_service_code_court.php">ศาล</a></li>
                        <li>- <a href="user_doc_service_code_court_command.php">คำสั่งศาล</a></li>
                        <li>- <a href="user_doc_service_code_type_person.php">ประเภทบุคคล</a></li>
                        <li>- <a href="user_doc_service_code_status_person.php">ประเภทสถานะบุคคล</a></li>
                        <li>- <a href="user_doc_service_code_office.php">สำนักงาน</a></li>
                        <li>- <a href="user_doc_service_code_idiom.php">สำนวน</a></li>
                        <li>- <a href="user_doc_service_code_province.php">จังหวัด</a></li>
                        <li>- <a href="user_doc_service_code_aphur.php">อำเภอ</a></li>
                        <li>- <a href="user_doc_service_code_tambon.php">ตำบล</a></li>
                        <li>- <a href="user_doc_service_code_type_asset.php">ประเภททรัพย์</a></li>
                        <li>- <a href="user_doc_service_code_type_asset_status.php">ประเภทสถานะทรัพย์</a></li>
                        <li>- <a href="user_doc_service_code_prefix_name.php">คำนำหน้าชื่อ</a></li>
                        <li>- <a href="user_doc_service_code_type_license.php">รหัสชนิดเอกสารสิทธิ์</a></li>
                        <li>- <a href="user_doc_service_code_type_building.php">รหัสประเภทสิ่งปลูกสร้าง</a></li>
                        <li>- <a href="user_doc_service_code_type_lottery.php">รหัสประเภทสลากออมทรัพย์</a></li>
                        <li>- <a href="user_doc_service_code_type_vehicle.php">รหัสประเภทยานพาหนะ</a></li>
                        <li>- <a href="user_doc_service_code_type_ship.php">รหัสประเภทเรือ</a></li>
                        <li>- <a href="user_doc_service_code_type_stock.php">รหัสประเภทหุ้น</a></li>
                        <li>- <a href="user_doc_service_code_type_leasehold.php">รหัสประเภทสิทธิการเช่า</a></li>
                    </ul>


                    </ul>
                        <li data-toggle="collapse" data-target="#service" class="collapsed">
                            <a href="#"><i class="fa fa-cube" aria-hidden="true"></i> API CONSOLE</a>
                        </li>
                    <ul class="sub-menu collapse" id="service">
                    <li><a href="user_doc_api_console_status_code.php">Status Code</a></li>
                    <li><a href="user_doc_api_guide.php">API Guide</a></li>

                    </ul>
                        <li data-toggle="collapse" data-target="#usermgt" class="collapsed">
                            <a href="#"><i class="fa fa-users"></i>  USER Management</a>
                        </li>
                    <ul class="sub-menu collapse" id="usermgt">
                        <li><a href="user_doc_user_info.php">ข้อมูลผู้ใช้งานระบบ</a></li>
                    </ul>
                        <?php if (isset($_SESSION['username'])) :?>
                        <li>
                            <a href="login.php?logout='1'"><i class="fa fa-sign-out-alt"></i> ออกจากระบบ</a>
                        </li>
                        <?php endif ?>
                </ul>
                <?php } else if ($_SESSION['GROUP_ID'] == '2'){ //user?>
                    <ul id="menu-content" class="menu-content collapse out">
                        <li  data-toggle="collapse" data-target="#products" class="collapsed active">
                            <a href="#"><i class="fa fa-table" aria-hidden="true"></i> API SERVICE</a>
                        </li>
                    <ul class="sub-menu collapse" id="products">
                        <li  data-toggle="collapse" data-target="#products1" class="collapsed active">
                            <a href="#"> API SERVICE LIST </a>
                        </li>
                        <ul class="sub-menu collapse" id="products1">
                        <li>- <a href="api_service_list.php">ตั้งค่ารายการ Service API</a></li>
                        <li data-toggle="collapse" data-target="#civil_service" class="collapsed active"> - <a href="#">ระบบงานบังคับคดีแพ่ง</a></li>
                        <ul class="sub-menu collapse" id="civil_service">
                        <?php
                        while ($rec_service = db::fetch_array($civil_service)) {
                            echo "<li><a href=\"user_doc_api_1.php?SERVICE_ID=".$rec_service['SERVICE_MANAGE_ID']."\">".$rec_service['SERVICE_CODE']." : ".$rec_service['SERVICE_DESC']."</a></li>";
                        }?>
                        </ul>
                        <li data-toggle="collapse" data-target="#bankrupt_service" class="collapsed active"> - <a href="#">ระบบงานบังคับคดีล้มละลาย</a></li>
                        <ul class="sub-menu collapse" id="bankrupt_service">
                            <?php
                            while ($rec_service = db::fetch_array($bank_service)) {
                            echo "<li><a href=\"user_doc_api_1.php?SERVICE_ID=".$rec_service['SERVICE_MANAGE_ID']."\">".$rec_service['SERVICE_CODE']." : ".$rec_service['SERVICE_DESC']."</a></li>";
                            }?>
                        </ul>
                        <li data-toggle="collapse" data-target="#revive_service" class="collapsed active"> - <a href="#">ระบบงานฟื้นฟูกิจการของลูกหนี้</a></li>
                        <ul class="sub-menu collapse" id="revive_service">
                            <?php
                            while ($rec_service = db::fetch_array($revive_service)) {
                            echo "<li><a href=\"user_doc_api_1.php?SERVICE_ID=".$rec_service['SERVICE_MANAGE_ID']."\">".$rec_service['SERVICE_CODE']." : ".$rec_service['SERVICE_DESC']."</a></li>";
                            }?>
                        </ul>
                        <li data-toggle="collapse" data-target="#mediate_service" class="collapsed active"> - <a href="#">ระบบงานไกล่เกลี่ยข้อพิพาท</a></li>
                        <ul class="sub-menu collapse" id="mediate_service">
                            <?php
                            while ($rec_service = db::fetch_array($mediate_service)) {
                            echo "<li><a href=\"user_doc_api_1.php?SERVICE_ID=".$rec_service['SERVICE_MANAGE_ID']."\">".$rec_service['SERVICE_CODE']." : ".$rec_service['SERVICE_DESC']."</a></li>";
                            }?>
                        </ul>
                        <li data-toggle="collapse" data-target="#backOffice_service" class="collapsed active"> - <a href="#">ระบบ Back office</a></li>
                        <ul class="sub-menu collapse" id="backOffice_service">
                            <?php
                            while ($rec_service = db::fetch_array($back_service)) {
                            echo "<li><a href=\"user_doc_api_1.php?SERVICE_ID=".$rec_service['SERVICE_MANAGE_ID']."\">".$rec_service['SERVICE_CODE']." : ".$rec_service['SERVICE_DESC']."</a></li>";
                            }?>
                        </ul>
                    </ul>

                        <li  data-toggle="collapse" data-target="#products2" class="collapsed active">
                            <a href="#">SERVICE CODE</a>
                        </li>
                    <ul class="sub-menu collapse" id="products2">
                        <li>- <a href="api_service_code.php">รายการรหัสที่ให้บริการ</a></li>
                        <li>- <a href="user_doc_service_code_court.php">ศาล</a></li>
                        <li>- <a href="user_doc_service_code_court_command.php">คำสั่งศาล</a></li>
                        <li>- <a href="user_doc_service_code_type_person.php">ประเภทบุคคล</a></li>
                        <li>- <a href="user_doc_service_code_status_person.php">ประเภทสถานะบุคคล</a></li>
                        <li>- <a href="user_doc_service_code_office.php">สำนักงาน</a></li>
                        <li>- <a href="user_doc_service_code_idiom.php">สำนวน</a></li>
                        <li>- <a href="user_doc_service_code_province.php">จังหวัด</a></li>
                        <li>- <a href="user_doc_service_code_aphur.php">อำเภอ</a></li>
                        <li>- <a href="user_doc_service_code_tambon.php">ตำบล</a></li>
                        <li>- <a href="user_doc_service_code_type_asset.php">ประเภททรัพย์</a></li>
                        <li>- <a href="user_doc_service_code_type_asset_status.php">ประเภทสถานะทรัพย์</a></li>
                        <li>- <a href="user_doc_service_code_prefix_name.php">คำนำหน้าชื่อ</a></li>
                        <li>- <a href="user_doc_service_code_type_license.php">รหัสชนิดเอกสารสิทธิ์</a></li>
                        <li>- <a href="user_doc_service_code_type_building.php">รหัสประเภทสิ่งปลูกสร้าง</a></li>
                        <li>- <a href="user_doc_service_code_type_lottery.php">รหัสประเภทสลากออมทรัพย์</a></li>
                        <li>- <a href="user_doc_service_code_type_vehicle.php">รหัสประเภทยานพาหนะ</a></li>
                        <li>- <a href="user_doc_service_code_type_ship.php">รหัสประเภทเรือ</a></li>
                        <li>- <a href="user_doc_service_code_type_stock.php">รหัสประเภทหุ้น</a></li>
                        <li>- <a href="user_doc_service_code_type_leasehold.php">รหัสประเภทสิทธิการเช่า</a></li>
                    </ul>


                    </ul>
                        <li data-toggle="collapse" data-target="#service" class="collapsed">
                            <a href="#"><i class="fa fa-cube" aria-hidden="true"></i> API CONSOLE</a>
                        </li>
                    <ul class="sub-menu collapse" id="service">
                    <li><a href="user_doc_api_console_status_code.php">Status Code</a></li>
                    <li><a href="user_doc_api_guide.php">API Guide</a></li>

                    </ul>

                        <li data-toggle="collapse" data-target="#profile" class="collapsed">
                            <a href="user_doc_profile.php"><i class="fa fa-user fa-lg"></i> PROFILE</a>
                        </li>

                        <li data-toggle="collapse" data-target="#overview" class="collapsed">
                            <a href="user_doc_overview.php"><i class="fa fa-database"></i> OVERVIEW</a>
                        </li>
                        <?php if (isset($_SESSION['username'])) :?>
                        <li>
                            <a href="login.php?logout='1'"><i class="fa fa-sign-out-alt"></i> ออกจากระบบ</a>
                        </li>
                        <?php endif ?>

                <?php } else { ?>

                    <ul id="menu-content" class="menu-content collapse out">
                        <li  data-toggle="collapse" data-target="#products" class="collapsed active">
                            <a href="#"><i class="fa fa-table" aria-hidden="true"></i> API SERVICE</a>
                        </li>
                    <ul class="sub-menu collapse" id="products">
                        <li  data-toggle="collapse" data-target="#products1" class="collapsed active">
                            <a href="#"> API SERVICE LIST </a>
                        </li>
                    <ul class="sub-menu collapse" id="products1">
                        <li>- <a href="api_service_list.php">ตั้งค่ารายการ Service API</a></li>
                        <li data-toggle="collapse" data-target="#civil_service" class="collapsed active"> - <a href="#">ระบบงานบังคับคดีแพ่ง</a></li>
                    <ul class="sub-menu collapse" id="civil_service">
                        <?php
                        while ($rec_service = db::fetch_array($civil_service)) {
                            echo "<li><a href=\"user_doc_api_1.php?SERVICE_ID=".$rec_service['SERVICE_MANAGE_ID']."\">".$rec_service['SERVICE_CODE']." : ".$rec_service['SERVICE_DESC']."</a></li>";
                        }?>
                    </ul>
                        <li data-toggle="collapse" data-target="#bankrupt_service" class="collapsed active"> - <a href="#">ระบบงานบังคับคดีล้มละลาย</a></li>
                    <ul class="sub-menu collapse" id="bankrupt_service">
                        <?php
                        while ($rec_service = db::fetch_array($bank_service)) {
                        echo "<li><a href=\"user_doc_api_1.php?SERVICE_ID=".$rec_service['SERVICE_MANAGE_ID']."\">".$rec_service['SERVICE_CODE']." : ".$rec_service['SERVICE_DESC']."</a></li>";
                        }?>
                    </ul>
                        <li data-toggle="collapse" data-target="#revive_service" class="collapsed active"> - <a href="#">ระบบงานฟื้นฟูกิจการของลูกหนี้</a></li>
                    <ul class="sub-menu collapse" id="revive_service">
                        <?php
                        while ($rec_service = db::fetch_array($revive_service)) {
                        echo "<li><a href=\"user_doc_api_1.php?SERVICE_ID=".$rec_service['SERVICE_MANAGE_ID']."\">".$rec_service['SERVICE_CODE']." : ".$rec_service['SERVICE_DESC']."</a></li>";
                        }?>
                    </ul>
                        <li data-toggle="collapse" data-target="#mediate_service" class="collapsed active"> - <a href="#">ระบบงานไกล่เกลี่ยข้อพิพาท</a></li>
                    <ul class="sub-menu collapse" id="mediate_service">
                        <?php
                        while ($rec_service = db::fetch_array($mediate_service)) {
                        echo "<li><a href=\"user_doc_api_1.php?SERVICE_ID=".$rec_service['SERVICE_MANAGE_ID']."\">".$rec_service['SERVICE_CODE']." : ".$rec_service['SERVICE_DESC']."</a></li>";
                        }?>
                    </ul>
                        <li data-toggle="collapse" data-target="#backOffice_service" class="collapsed active"> - <a href="#">ระบบ Back office</a></li>
                    <ul class="sub-menu collapse" id="backOffice_service">
                        <?php
                        while ($rec_service = db::fetch_array($back_service)) {
                        echo "<li><a href=\"user_doc_api_1.php?SERVICE_ID=".$rec_service['SERVICE_MANAGE_ID']."\">".$rec_service['SERVICE_CODE']." : ".$rec_service['SERVICE_DESC']."</a></li>";
                        }?>
                    </ul>
                    </ul>

                        <li  data-toggle="collapse" data-target="#products2" class="collapsed active">
                            <a href="#">SERVICE CODE</a>
                        </li>
                    <ul class="sub-menu collapse" id="products2">
                        <li>- <a href="api_service_code.php">รายการรหัสที่ให้บริการ</a></li>
                        <li>- <a href="user_doc_service_code_court.php">ศาล</a></li>
                        <li>- <a href="user_doc_service_code_court_command.php">คำสั่งศาล</a></li>
                        <li>- <a href="user_doc_service_code_type_person.php">ประเภทบุคคล</a></li>
                        <li>- <a href="user_doc_service_code_status_person.php">ประเภทสถานะบุคคล</a></li>
                        <li>- <a href="user_doc_service_code_office.php">สำนักงาน</a></li>
                        <li>- <a href="user_doc_service_code_idiom.php">สำนวน</a></li>
                        <li>- <a href="user_doc_service_code_province.php">จังหวัด</a></li>
                        <li>- <a href="user_doc_service_code_aphur.php">อำเภอ</a></li>
                        <li>- <a href="user_doc_service_code_tambon.php">ตำบล</a></li>
                        <li>- <a href="user_doc_service_code_type_asset.php">ประเภททรัพย์</a></li>
                        <li>- <a href="user_doc_service_code_type_asset_status.php">ประเภทสถานะทรัพย์</a></li>
                        <li>- <a href="user_doc_service_code_prefix_name.php">คำนำหน้าชื่อ</a></li>
                        <li>- <a href="user_doc_service_code_type_license.php">รหัสชนิดเอกสารสิทธิ์</a></li>
                        <li>- <a href="user_doc_service_code_type_building.php">รหัสประเภทสิ่งปลูกสร้าง</a></li>
                        <li>- <a href="user_doc_service_code_type_lottery.php">รหัสประเภทสลากออมทรัพย์</a></li>
                        <li>- <a href="user_doc_service_code_type_vehicle.php">รหัสประเภทยานพาหนะ</a></li>
                        <li>- <a href="user_doc_service_code_type_ship.php">รหัสประเภทเรือ</a></li>
                        <li>- <a href="user_doc_service_code_type_stock.php">รหัสประเภทหุ้น</a></li>
                        <li>- <a href="user_doc_service_code_type_leasehold.php">รหัสประเภทสิทธิการเช่า</a></li>
                    </ul>


                    </ul>
                        <li data-toggle="collapse" data-target="#service" class="collapsed">
                            <a href="#"><i class="fa fa-cube" aria-hidden="true"></i> API CONSOLE</a>
                        </li>
                    <ul class="sub-menu collapse" id="service">
                        <li><a href="user_doc_api_console_status_code.php">Status Code</a></li>
                        <li><a href="user_doc_api_guide.php">API Guide</a></li>

                    </ul>

               <?php } ?>





     </div>
</div>
