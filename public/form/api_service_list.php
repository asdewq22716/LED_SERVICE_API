<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include 'comtop_user.php';
include 'comtop.php';

?>

    <div class="breadcrumb_iner_item">
        <h2>ตั้งค่ารายการ Service API</h2>
    </div>

    <table  border="1">
		<thead>
            <tr>
                <th style="width: 5%;" class="text-center">ลำดับ </th>
                <th style="width:;" class="text-center">Service Code</th>
                <th style="width:;" class="text-center">Service Name</th>
                <th style="width:;" class="text-center">Service Description</th>
                <th style="width:;" class="text-center">SYSTEM</th>
                <th style="width:;" class="text-center">สถานะการใช้งาน</th>								
                <th style="width: 10%;text-align:center;" class="td_remove"></th>
            </tr>
        </thead>
        <?php 
        $sql = db::query("SELECT * FROM M_SERVICE_MANAGE ");

        while($row = db::fetch_array($sql)){
            $i++;
          ?>  
            <tr>
                <td align="center"><?php echo $i;?></td>
                <td align="left"><?php echo $row['SERVICE_CODE'];?></td>
                <td align="left"><?php echo $row['SERVICE_NAME'];?></td>
                <td align="left"><?php echo $row['SERVICE_DESC'];?></td>
                <td align="center"><?php echo $row['SYS_DETAIL'];?></td>
                <td align="center"><?php echo $row['SYS_DETAIL'];?></td>
                <td align="center"><?php echo $row['SYS_DETAIL'];?></td>
             
            </tr>
        <?php  } ?>
        
    </table>