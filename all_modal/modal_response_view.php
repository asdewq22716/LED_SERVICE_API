<?php

$HIDE_HEADER = "Y";
include '../include/comtop_user.php';

$api_name = $_GET['API_NAME'];
$api_setting_id = $_GET['SETTING_ID'];

$sql = "SELECT
              *
        FROM
            M_SERVICE_MANAGE
        WHERE
            1 = 1 AND SERVICE_NAME = '$api_name'";
$qry = db::query($sql);
$rec = db::fetch_array($qry);

$sql = "SELECT
              *
        FROM
            M_API_SETTING
        WHERE
            1 = 1 AND API_SETTING_ID = '$api_setting_id'";
$qry = db::query($sql);
$rec_set = db::fetch_array($qry);
?>
<div class="row" id="animationSandbox">
    <div class="col-sm-12">

        <div class="main-header">

            <div class="media m-b-12">


                <div class="media-body text-left">

                    <h4 class="form-control-label">รายละเอียดบริการของ ฐานข้อมูล</h4>

                    <br><br>

                    <input name="service_id" id="service_id"
                        value="<?php if (empty($rec_set)) {echo $rec['SERVICE_MANAGE_ID'];} else {echo $rec_set['SERVICE_ID'];}?>"
                        hidden />
                    <input name="service_code" id="service_code"
                        value="<?php if (empty($rec_set)) {echo $rec['SERVICE_CODE'];} else {echo $rec_set['SERVICE_CODE'];}?>"
                        hidden />
                    <div class="row">
                        <div class="col-md-2 offset-md-1">
                            <div class="form-control-label">ชื่อการตั้งค่า</div>
                        </div>
                        <div class="col-md-6"><?php echo $rec_set['SERVICE_LIST']; ?></div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-2 offset-md-1">
                            <div class="form-control-label">รายละเอียด</div>
                        </div>
                        <div class="col-md-6"><?php echo $rec_set['API_DESC']; ?></div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-2 offset-md-1">
                            <div class="form-control-label">สถานะ</div>
                        </div>
                        <div class="col-md-4 radio-inline">
                            <?php if ($rec_set['API_STATUS'] == 1) { echo "ใช้งาน";}else{ echo "ไม่ใช้งาน"; } ?></div>
                    </div>
                    <br>
                    <h5 class="form-control-label">• รูปแบบการส่งข้อมูล</h5>
                    รูปแบบ
                    <label class="label bg-primary">5000 [0]</label>
                    <label class="label bg-success">T [0]</label>
                    <label class="label bg-warning">Office ID [0]</label>
                    <label class="label bg-danger">Service Version [0]</label>
                    <label class="label bg-info">Service ID [0]</label>
                    <label class="label bg-inverse">PID [0]</label>
                    <br><br><br>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="card">

                <div class="card-block">

                    <div class="f-right"></div>

                    <div class="table-responsive" data-pattern="priority-columns" id="export_data">

                        <div class="showborder">

                            <h5 class="form-control-label">• พจนานุกรมข้อมูลที่ร้องขอ</h5>

                            <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                                <thead class="bg-primary">
                                    <tr class="bg-primary">
                                        <th style="width: 5%;" class="text-center">ลำดับ</th>
                                        <th style="width: 15%;" class="text-center">Key</th>
                                        <th style="width: 15%;" class="text-center">Type</th>
                                        <th style="width: 10%;" class="text-center">M/O</th>
                                        <th style="width: 15%;" class="text-center">รายละเอียด</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            $sql = "SELECT
                                                            *
                                                    FROM
                                                        M_API_LIST
                                                    WHERE
                                                        1 = 1 AND API_SETTING_ID = $api_setting_id AND API_STATUS = 0 ORDER BY API_LIST_ID ASC";
                                            $qry = db::query($sql);
                                            $i = 1;
                                            while ($rec = db::fetch_array($qry)) {
                                        ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td class="text-center"><?php echo $rec['KEY']; ?></td>
                                        <td class="text-center"><?php echo $rec['TYPE']; ?></td>
                                        <td class="text-center"><?php echo $rec['STATUS']; ?></td>
                                        <td><?php echo $rec['API_DESC']; ?></td>
                                    </tr>
                                    <?php
                                                $i++;
                                            }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="table-responsive" data-pattern="priority-columns" id="export_data">

                        <div class="showborder">

                            <h5 class="form-control-label">• พจนานุกรมข้อมูลที่ตอบกลับ</h5>

                            <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                                <thead class="bg-primary">
                                    <tr class="bg-primary">
                                        <th style="width: 5%;" class="text-center">ลำดับ</th>
                                        <th style="width: 15%;" class="text-center">Key</th>
                                        <th style="width: 15%;" class="text-center">Type</th>
                                        <th style="width: 10%;" class="text-center">แสดงผล</th>
                                        <th style="width: 15%;" class="text-center">รายละเอียด</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            $sql = "SELECT
                                                            *
                                                    FROM
                                                        M_API_LIST
                                                    WHERE
                                                        1 = 1 AND API_SETTING_ID = $api_setting_id AND API_STATUS = 1 ORDER BY API_LIST_ID ASC";
                                            $qry = db::query($sql);
                                            $i = 1;
                                            while ($rec = db::fetch_array($qry)) {
                                        ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td class="text-center"><?php echo $rec['KEY']; ?></td>
                                        <td class="text-center"><?php echo $rec['TYPE']; ?></td>
                                        <td class="text-center">
                                            <?php echo ($rec['STATUS']=="S"?"แสดง":""); ?>
                                            <?php echo ($rec['STATUS']=="H"?"ซ่อน":""); ?>
                                        </td>
                                        <td><?php echo $rec['API_DESC']; ?></td>
                                    </tr>
                                    <?php
                                                $i++;
                                            }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>