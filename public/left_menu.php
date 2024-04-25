<?php
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('location: login.php');
}

function show_sub_menu($SERVICE_MANAGE_ID,$permission_setting_id){

    echo "<ul>";
    $sql_set="SELECT
                    * 
                FROM 
                    M_API_SETTING 
                WHERE 
                    API_STATUS=1 AND 
                    SERVICE_ID='".$SERVICE_MANAGE_ID."' AND
                    API_SETTING_ID IN (".(count($permission_setting_id)?implode(',',$permission_setting_id):0).")";
    $exc_set=db::query($sql_set);
    while ($rec_set = db::fetch_array($exc_set)) {
        echo "<li style=\"padding-left:2.5em;\"><a href=\"user_doc_api_1.php?SERVICE_ID=".$SERVICE_MANAGE_ID."&SETTING_ID=".$rec_set['API_SETTING_ID']."\"><i class=\"fa fa-database\"></i> ".$rec_set['SERVICE_LIST']."</a></li>";
    }
    echo "</ul>";

}

if(isset($_SESSION['PERMISSION_GROUP_ID'])){
    $qry_permission = db::query("SELECT SERVICE_MANAGE_ID,API_SETTING_ID FROM SERVICE_MAPPING_GROUP WHERE PRIVILEGE_GROUP_ID = '".$_SESSION['PERMISSION_GROUP_ID']."' ORDER BY SERVICE_MANAGE_ID ASC");
    $permission_id = "";
    $permission_setting_id=[];
    while($rec_permission = db::fetch_array($qry_permission)) {
        if(empty($permission_id)){
            $permission_id .= $rec_permission['SERVICE_MANAGE_ID'];
        }else{
            $permission_id .= ",".$rec_permission['SERVICE_MANAGE_ID'];
        }

        $permission_setting_id[$rec_permission['API_SETTING_ID']]=$rec_permission['API_SETTING_ID'];
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

if($_SESSION['USER_MAIN']!='Y'){
    $sql_data = db::query("SELECT SERVICE_MANAGE_ID,API_SETTING_ID FROM USER_API_SERVICE WHERE USR_ID = '".$_SESSION['USR_ID']."'");
    $rec_data = db::fetch_array($sql_data);
    // $filter2 = $rec_data['SERVICE_MANAGE_ID'] != 0 ? " AND SERVICE_MANAGE_ID IN (".$rec_data['SERVICE_MANAGE_ID'].") " : "0";
    $filter2 = $rec_data['SERVICE_MANAGE_ID'] != 0 ? " AND SERVICE_MANAGE_ID IN (".$rec_data['SERVICE_MANAGE_ID'].") " : "AND 1 != 1";

    $SP_API_SETTING_ID=explode(',',$rec_data['API_SETTING_ID']);

    if(count($SP_API_SETTING_ID)){
        foreach($permission_setting_id as $aid){
            if(!in_array($aid,$SP_API_SETTING_ID)){
                unset($permission_setting_id[$aid]);
            }
        }
    }else{
        unset($permission_setting_id);
    }

}

// include 'include/comtop_user.php';
$civil_service = db::query("SELECT * FROM M_SERVICE_MANAGE WHERE SYS_DETAIL = 'ระบบงานบังคับคดีแพ่ง'  AND SERVICE_STATUS = '1'{$filter} {$filter2} ORDER BY SERVICE_CODE ASC ");
$bank_service = db::query("SELECT * FROM M_SERVICE_MANAGE WHERE SYS_DETAIL = 'ระบบงานบังคับคดีล้มละลาย' AND SERVICE_STATUS = '1' {$filter} {$filter2} ORDER BY SERVICE_CODE ASC");
$revive_service = db::query("SELECT * FROM M_SERVICE_MANAGE WHERE SYS_DETAIL = 'ระบบงานฟื้นฟูกิจการของลูกหนี้' AND SERVICE_STATUS = '1' {$filter} {$filter2} ORDER BY SERVICE_CODE ASC");
$mediate_service = db::query("SELECT * FROM M_SERVICE_MANAGE WHERE SYS_DETAIL = 'ระบบงานไกล่เกลี่ยข้อพิพาท' AND SERVICE_STATUS = '1' {$filter} {$filter2} ORDER BY SERVICE_CODE ASC");
$back_service = db::query("SELECT * FROM M_SERVICE_MANAGE WHERE SYS_DETAIL = 'ระบบ Back office' AND SERVICE_STATUS = '1' {$filter} {$filter2} ORDER BY SERVICE_CODE ASC");
?>
<div class="nav-side-menu">
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
                            echo "<li><a href=\"user_doc_api_1.php?SERVICE_ID=".$rec_service['SERVICE_MANAGE_ID']."\">".$rec_service['SERVICE_CODE']." : ".$rec_service['SERVICE_DESC']."xxx</a></li>";
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
                    <?php /* 
                    <li data-toggle="collapse" data-target="#backOffice_service" class="collapsed active"> - <a href="#">ระบบ Back office</a></li>
                    <ul class="sub-menu collapse" id="backOffice_service">
                        <?php
                        while ($rec_service = db::fetch_array($back_service)) {
                            echo "<li><a href=\"user_doc_api_1.php?SERVICE_ID=".$rec_service['SERVICE_MANAGE_ID']."\">".$rec_service['SERVICE_CODE']." : ".$rec_service['SERVICE_DESC']."</a></li>";
                        }?>
                    </ul>
                </ul> */ ?>

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
                            echo "<li>".$rec_service['SERVICE_CODE']." : ".$rec_service['SERVICE_DESC']."</li>";
                        
                            show_sub_menu($rec_service['SERVICE_MANAGE_ID'],$permission_setting_id);

                        }?>
                    </ul>
                    <li data-toggle="collapse" data-target="#bankrupt_service" class="collapsed active"> - <a href="#">ระบบงานบังคับคดีล้มละลาย</a></li>
                    <ul class="sub-menu collapse" id="bankrupt_service">
                        <?php
                        while ($rec_service = db::fetch_array($bank_service)) {
                            echo "<li>".$rec_service['SERVICE_CODE']." : ".$rec_service['SERVICE_DESC']."</li>";
                        
                            show_sub_menu($rec_service['SERVICE_MANAGE_ID'],$permission_setting_id);
                        }?>
                    </ul>
                    <li data-toggle="collapse" data-target="#revive_service" class="collapsed active"> - <a href="#">ระบบงานฟื้นฟูกิจการของลูกหนี้</a></li>
                    <ul class="sub-menu collapse" id="revive_service">
                        <?php
                        while ($rec_service = db::fetch_array($revive_service)) {
                            echo "<li>".$rec_service['SERVICE_CODE']." : ".$rec_service['SERVICE_DESC']."</li>";
                        
                            show_sub_menu($rec_service['SERVICE_MANAGE_ID'],$permission_setting_id);
                        }?>
                    </ul>
                    <li data-toggle="collapse" data-target="#mediate_service" class="collapsed active"> - <a href="#">ระบบงานไกล่เกลี่ยข้อพิพาท</a></li>
                    <ul class="sub-menu collapse" id="mediate_service">
                        <?php
                        while ($rec_service = db::fetch_array($mediate_service)) {
                            echo "<li>".$rec_service['SERVICE_CODE']." : ".$rec_service['SERVICE_DESC']."</li>";
                            
                            show_sub_menu($rec_service['SERVICE_MANAGE_ID'],$permission_setting_id);
                        }?>
                    </ul>
                    <?php /*
                    <li data-toggle="collapse" data-target="#backOffice_service" class="collapsed active"> - <a href="#">ระบบ Back office</a></li>
                    <ul class="sub-menu collapse" id="backOffice_service">
                        <?php
                        while ($rec_service = db::fetch_array($back_service)) {
                            echo "<li>".$rec_service['SERVICE_CODE']." : ".$rec_service['SERVICE_DESC']."</li>";
                            
                            show_sub_menu($rec_service['SERVICE_MANAGE_ID'],$permission_setting_id);
                        }?>
                    </ul>
                    */ ?>
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
                <a href="#"><i class="fa fa-user fa-lg"></i> PROFILE</a>
            </li>
            <ul class="sub-menu collapse" id="profile">
                <li><a href="user_doc_profile.php">PROFILE</a></li>
                <?php if($_SESSION['USER_MAIN'] == "Y"){ ?>
                    <li><a href="user_sub_doc_profile.php">จัดการผู้ใช้งาน</a></li>
                <?php } ?>
            </ul>
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
                                echo "<li>".$rec_service['SERVICE_CODE']." : ".$rec_service['SERVICE_DESC']."</li>";
                                
                                show_sub_menu($rec_service['SERVICE_MANAGE_ID'],$permission_setting_id);
                            }?>
                        </ul>
                        <li data-toggle="collapse" data-target="#bankrupt_service" class="collapsed active"> - <a href="#">ระบบงานบังคับคดีล้มละลาย</a></li>
                        <ul class="sub-menu collapse" id="bankrupt_service">
                            <?php
                            while ($rec_service = db::fetch_array($bank_service)) {
                                echo "<li>".$rec_service['SERVICE_CODE']." : ".$rec_service['SERVICE_DESC']."</li>";

                                show_sub_menu($rec_service['SERVICE_MANAGE_ID'],$permission_setting_id);
                            }?>
                        </ul>
                        <li data-toggle="collapse" data-target="#revive_service" class="collapsed active"> - <a href="#">ระบบงานฟื้นฟูกิจการของลูกหนี้</a></li>
                        <ul class="sub-menu collapse" id="revive_service">
                            <?php
                            while ($rec_service = db::fetch_array($revive_service)) {
                                echo "<li>".$rec_service['SERVICE_CODE']." : ".$rec_service['SERVICE_DESC']."</li>";
                            
                                show_sub_menu($rec_service['SERVICE_MANAGE_ID'],$permission_setting_id);
                            }?>
                        </ul>
                        <li data-toggle="collapse" data-target="#mediate_service" class="collapsed active"> - <a href="#">ระบบงานไกล่เกลี่ยข้อพิพาท</a></li>
                        <ul class="sub-menu collapse" id="mediate_service">
                            <?php
                            while ($rec_service = db::fetch_array($mediate_service)) {
                                echo "<li>".$rec_service['SERVICE_CODE']." : ".$rec_service['SERVICE_DESC']."</li>";

                                show_sub_menu($rec_service['SERVICE_MANAGE_ID'],$permission_setting_id);
                            }?>
                        </ul>
                        <li data-toggle="collapse" data-target="#backOffice_service" class="collapsed active"> - <a href="#">ระบบ Back office</a></li>
                        <ul class="sub-menu collapse" id="backOffice_service">
                            <?php
                            while ($rec_service = db::fetch_array($back_service)) {
                                echo "<li>".$rec_service['SERVICE_CODE']." : ".$rec_service['SERVICE_DESC']."</a>";

                                show_sub_menu($rec_service['SERVICE_MANAGE_ID'],$permission_setting_id);
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
