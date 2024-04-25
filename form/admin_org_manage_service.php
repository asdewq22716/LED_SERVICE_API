<div class="container-fluid" style="margin-top: 0; width: 80%; margin-left: 10%; margin-right: 10%;">
    <div class="f-right">
        <!-- <button type="button" onclick="open_add_user();" class="btn btn-primary btn-mini">
                                                <i class="fa fa-plus"></i> เพิ่มข้อมูล
                                            </button> -->
        <button type="button" onclick="open_add_user();" class="btn btn-primary btn-mini" data-toggle="modal" data-target="#bizModalEdit">
            <i class="fa fa-plus"></i> เพิ่มข้อมูล
        </button>

    </div>
    <table cellspacing="0" id="SERVICE_MANAGE_ID" class="table table-bordered sorted_table">
        <thead class="bg-primary">
            <tr>
                <th class="text-center" style="width:10%;">ที่</th>
                <th class="text-left" style="width:30%;">ชื่อเจ้าหน้าที่</th>
                <th class="text-left" style="width:20%;">USERNAME</th>
                <th class="text-center" style="width:10%;">ผู้ดูแลหน่วยงาน</th>
                <th class="text-center" style="width:10%;">สถานะ</th>
                <th class="text-center" style="width:20%;"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sqlUser = "SELECT * FROM USER_API_SERVICE WHERE SYSTEM_TYPE = '$orgId' ";
            $qryUser = db::query($sqlUser);
            $iUser = 1;
            while ($recUser = db::fetch_array($qryUser)) {
            ?>
                <tr>
                    <td class="text-center">
                        <?php echo $iUser; ?>
                    </td>
                    <td class="text-left">
                        <?php echo conTextD($recUser['USR_PREFIX']) . conTextD($recUser['USR_FNAME']) . ' ' . conTextD($recUser['USR_LNAME']); ?>
                    </td>
                    <td class="text-left">
                        <?php echo conTextD($recUser['USR_USERNAME']); ?>
                    </td>
                    <td class="text-center">
                        <?php echo bsf_show_text(97, $recUser, '##USER_MAIN!!', 'M'); ?>
                    </td>
                    <td class="text-center">
                        <?php echo  bsf_show_text(97, $recUser, '##USER_STATUS!!', 'M'); ?>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-success btn-mini" data-toggle="modal" data-target="#bizModalEdit" onclick="open_edit_user('<?php echo $recUser['USR_ID']; ?>');">
                            <i class="icofont icofont-ui-edit"></i> แก้ไข
                        </button>
                        <a href="#" class="btn btn-primary btn-mini" onclick="gen_token(<?php echo $recUser['USR_ID'] ?>);"><i class="fa fa-qrcode"></i> สร้าง Token</a> &nbsp;
                    </td>
                </tr>
            <?php
                $iUser++;
            }
            ?>
        </tbody>
    </table>
</div>