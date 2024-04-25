<?php
session_start();
$path = "../";
include $path . 'include/comtop_user.php'; //connect db
include $path . 'include/combottom_js_user.php'; //function 
include($path . 'include/func_Nop');
$registerCode = "";

/* ถ้าเอาคดีดำเเดงต้องกรอกศาล */
$court_c = "";

$T_BLACK_CASE = "";
$BLACK_CASE = "";
$BLACK_YY = "";

$T_RED_CASE = "";
$RED_CASE = "";
$RED_YY = "";
/*  */

$CONCERN_CODE = ""; //โจทย์ จำเลย
$SYSTEM_TYPE = "เเพ่ง"; //ดึงประเภทศาล

?>


<div class="content-wrapper">
    <!-- Container-fluid starts -->
    <div class="container-fluid">

        <form method="GET" enctype="multipart/form-data" id="frm-input">
            <!-- Row Starts -->
            <div class="row" id="animationSandbox">
                <div class="col-sm-12">
                    <div class="main-header">
                        <div class="media m-b-12">
                            <a class="media-left" href="">
                                <img src="../icon/icon11.png" class="media-object"></a>
                            <div class="media-body">
                                <h4 class="m-t-5">&nbsp;</h4>
                                <h4>ค้นหา</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->
            <!-- Row Starts -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-block">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="form-group row">
                                    <div class="col-md-12 wf-left ">

                                        <!-- *04/09/2023 comment -->
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-xs-12 col-sm-2" align=""></div>
                                            <div class="col-xs-12 col-sm-2"> <button class="btn btn-primary"><a style="color: white;" href="search_data.php?REGISTERCODE=7875183559210">ค้นหาข้อมูล 13 หลัก</a></button></div>
                                        </div>
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-xs-12 col-sm-2" align=""></div>
                                            <div class="col-xs-12 col-sm-2"><button class="btn btn-primary"><a style="color: white;" href="search_data.php?court_c=ศาลจังหวัดฉะเชิงเทรา&T_BLACK_CASE=ผบ&BLACK_CASE=1785&BLACK_YY=2565">ค้นหาข้อมูล คดีดำ</a></button></div>
                                        </div>
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-xs-12 col-sm-2" align=""></div>
                                            <div class="col-xs-12 col-sm-2"> <button class="btn btn-primary"><a style="color: white;" href="search_data.php?court_c=ศาลล้มละลายกลาง&T_RED_CASE=ฟ.&RED_CASE=26&RED_YY=2563">ค้นหาข้อมูล คดีเเดง</a></button></div>
                                        </div>
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-xs-12 col-sm-2" align=""></div>
                                            <div class="col-xs-12 col-sm-2"> <button class="btn btn-primary" type="button" onclick="inser_data_case();">บันทึกคำสั่งเจ้าพนักงาน auto</button></div>
                                        </div>
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-xs-12 col-sm-2" align=""></div>
                                            <div class="col-xs-12 col-sm-2"> <button class="btn btn-primary"><a style="color: white;" href="cmd_add_from.php?DOC_ID=&sh1=Civil&prefixBlackCase=ผบ&blackCase=16830&blackYy=2565&prefixRedCase=ผบ&redCase=16831&redYy=2565&CourtCode=204&courtName=ศาลจังหวัดฉะเชิงเทรา&concernName=จำเลย&fullName=นายสรวิทย์+เลิศคุณวงส์&REGISTERCODE=7383254239533&court_c=&T_BLACK_CASE=&BLACK_CASE=&BLACK_YY=&T_RED_CASE=&RED_CASE=&RED_YY=">บันทึกคำสั่งเจ้าพนักงาน</a></button></div>
                                        </div>
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-xs-12 col-sm-2" align=""></div>
                                            <div class="col-xs-12 col-sm-2"> <button class="btn btn-primary"><a style="color: white;" href="page_test.php">หน้าทดสอบ</a></button></div>
                                        </div>
                                        <!-- *04/09/2023 comment -->



                                        <!--  <div class="row" style="margin-top: 10px;">
                                            <div class="col-xs-12 col-sm-2" align=""></div>
                                            <div class="col-xs-12 col-sm-2"> <button class="btn btn-primary"><a style="color: white;" target="_blank" href="http://103.208.27.224:81/led_service_api/service/getCivilToWh.php?show_data=Y&pccCivilGen=3816418">ดึงข้อมูลคดีแพ่ง</a></button></div>
                                        </div> -->
                                        <!--   <div class="row" style="margin-top: 10px;">
                                            <div class="col-xs-12 col-sm-2" align=""></div>
                                            <div class="col-xs-12 col-sm-2"> <button class="btn btn-primary"><a style="color: white;" target="_blank" href="http://103.208.27.224:81/led_service_api/service/getBankruptToWh.php?brcId=27036&show_data=Y">ดึงข้อมูลคดีล้มละลาย</a></button></div>
                                        </div> -->
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-xs-12 col-sm-2" align=""></div>
                                            <div class="col-xs-12 col-sm-2" align=""><input type="text" name="brcId_CivilToWh" id="brcId_CivilToWh" class="form-control"></div>
                                            <div class="col-xs-12 col-sm-2"> <button class="btn btn-primary" onClick="btn_CivilToWh();">ดึงข้อมูลคดีแพ่ง</button></div>
                                        </div>

                                        <!--    <div class="row" style="margin-top: 10px;">
                                            <div class="col-xs-12 col-sm-2" align=""></div>
                                            <div class="col-xs-12 col-sm-2" align=""><input type="text" name="brcId_Bankrupt" id="brcId_Bankrupt" class="form-control"></div>
                                            <div class="col-xs-12 col-sm-2"> <button class="btn btn-primary" onClick="btn_Bankrupt();">ดึงข้อมูลคดีล้มละลาย</button></div>
                                        </div> -->
                                        <!-- start Ak -->
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-xs-12 col-sm-2" align=""></div>
                                            <div class="col-xs-12 col-sm-2" align=""><input type="text" name="brcId_Bankrupt_num" id="brcId_Bankrupt_num" class="form-control"></div>
                                            <div class="col-xs-12 col-sm-2"> <button class="btn btn-primary" type="button" onClick="btn_Bankrupt();">ดึงข้อมูลคดีล้มละลาย</button></div>
                                        </div>
                                        <!-- stop Ak -->
                                        <!--  <div class="row" style="margin-top: 10px;">
                                            <div class="col-xs-12 col-sm-2" align=""></div>
                                            <div class="col-xs-12 col-sm-2" align=""><input type="text" name="brcId_CivilToWh_fast" id="brcId_CivilToWh_fast" class="form-control"></div>
                                            <div class="col-xs-12 col-sm-2"> <button class="btn btn-primary" onClick="btn_CivilToWh_fast();">ดึงข้อมูลคดีแพ่ง(เร็ว)</button></div>
                                        </div> -->
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-xs-12 col-sm-2" align=""></div>
                                            <div class="col-xs-12 col-sm-2" align=""><input type="text" name="wfr_revive" id="wfr_revive" class="form-control"></div>
                                            <div class="col-xs-12 col-sm-2"> <button class="btn btn-primary" type="button" onClick="btn_revive();">ดึงข้อมูลคดีฟื้นฟู</button></div>
                                        </div>
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-xs-12 col-sm-2" align=""></div>
                                            <div class="col-xs-12 col-sm-2" align=""><input type="text" name="wfr_mediate" id="wfr_mediate" class="form-control"></div>
                                            <div class="col-xs-12 col-sm-2"> <button class="btn btn-primary" type="button" onClick="btn_mediate();">ดึงข้อมูลคดีไกล่เกลี่ย</button></div>
                                        </div>
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-xs-12 col-sm-2" align=""></div>
                                            <div class="col-xs-12 col-sm-2" align=""><input type="text" name="wfr_backoffice" id="wfr_backoffice" class="form-control"></div>
                                            <div class="col-xs-12 col-sm-2"> <button class="btn btn-primary" type="button" onClick="btn_backoffice();">ดึงข้อมูลbackOffice</button></div>
                                        </div>
                                        <!-- <div class="row" style="margin-top: 10px;">
                                            <div class="col-xs-12 col-sm-2" align=""></div>
                                            <div class="col-xs-12 col-sm-2" align="">
                                                <?php
                                                $sql_SYSTEM = "SELECT a.CMD_SYSTEM_ID ,a.SERVICE_SYS_NAME FROM M_CMD_SYSTEM a 
                                                            WHERE 1=1 AND a.CMD_SYSTEM_ID NOT IN (6) ";
                                                $qry_SYSTEM = db::query($sql_SYSTEM);

                                                ?>
                                                <select name="CMD_SYSTEM" id="CMD_SYSTEM" class="form-control select2" tabindex="-1">
                                                    <option value="">กรุณาเลือกระบบงาน</option>
                                                    <?php
                                                    while ($rec = db::fetch_array($qry_SYSTEM)) {
                                                    ?>
                                                       <option value="<?php echo $rec['CMD_SYSTEM_ID']; ?>"><?php echo $rec['SERVICE_SYS_NAME']; ?></option>
                                                       <?php
                                                    }
                                                        ?>
                                                </select>

                                            </div>
                                            <div class="col-xs-12 col-sm-2"> <button class="btn btn-primary" type="button" onClick="add_info_tor();">เพิ่มข้อมูลตามtor</button></div>
                                        </div>
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-xs-12 col-sm-2" align=""></div>
                                            <div class="col-xs-12 col-sm-2"> <button class="btn btn-primary"><a style="color: white;" href="show_infomation_tor.php">ข้อมูลตามTOR</a></button></div>
                                        </div> -->
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-xs-12 col-sm-2" align=""></div>
                                            <div class="col-xs-12 col-sm-2" align=""><input type="text" name="brc_id_Bankrupt" id="brc_id_Bankrupt" class="form-control"></div>
                                            <div class="col-xs-12 col-sm-2"> <button class="btn btn-primary" onClick="showFromBankrupt();">Showล้มละลาย</button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="display: none;">
                <!-- send start -->
                <input type="text" id="CMD_DOC_DATE" name="CMD_DOC_DATE" value="<?php echo date('Y-m-d'); ?>"><!-- //วันที่ -->
                <input type="text" id="CMD_DOC_TIME" name="CMD_DOC_TIME" value="<?php echo date("H:i:s"); ?>"><!-- เวลา -->
                <input type="text" id="register_code_send" name="register_code_send" value="1234567890123"><!-- เลข13 หลักผู้ส่ง -->
                <input type="text" id="SYSTEM_ID_send" name="SYSTEM_ID_send" value="1"><!-- คำสั่ง/สอบถาม/แจ้ง จากระบบงาน  -->

                <input type="text" id="T_BLACK_CASE_send" name="T_BLACK_CASE_send" value="ผบ."><!-- หมายเลขคดีดำ ผู้ส่ง -->
                <input type="text" id="BLACK_CASE_send" name="BLACK_CASE_send" value="000"><!-- หมายเลขคดีดำ ผู้ส่ง -->
                <input type="text" id="BLACK_YY_send" name="BLACK_YY_send" value="111"><!-- หมายเลขคดีดำ ผู้ส่ง -->

                <input type="text" id="T_RED_CASE_send" name="T_RED_CASE_send" value="ผบ."><!-- หมายเลขคดีแดง ผู้ส่ง -->
                <input type="text" id="RED_CASE_send" name="RED_CASE_send" value="0000"><!-- หมายเลขคดีแดง ผู้ส่ง -->
                <input type="text" id="RED_YY_send" name="RED_YY_send" value="1111"><!-- หมายเลขคดีแดง ผู้ส่ง -->

                <input type="text" id="COUNT_CODE_send" name="COUNT_CODE_send" value="302"><!-- ศาล -->

                <input type="text" id="plaintiff_send" name="plaintiff_send" value="นายA"><!-- โจทก์ -->
                <input type="text" id="defendant_send" name="defendant_send" value="นายB"><!-- จำเลย -->

                <!-- send stop -->

                <!-- recive  start-->
                <input type="text" id="SEND_TO_receive" name="SEND_TO_receive" value="4"><!-- คำสั่ง/สอบถาม/แจ้ง จากระบบงาน  -->

                <input type="text" id="T_BLACK_CASE_receive" name="T_BLACK_CASE_receive" value="ล."><!-- หมายเลขคดีดำ ผู้ส่ง -->
                <input type="text" id="BLACK_CASE_receive" name="BLACK_CASE_receive" value="222"><!-- หมายเลขคดีดำ ผู้ส่ง -->
                <input type="text" id="BLACK_YY_receive" name="BLACK_YY_receive" value="2565"><!-- หมายเลขคดีดำ ผู้ส่ง -->

                <input type="text" id="T_RED_CASE_receive" name="T_RED_CASE_receive" value="ล."><!-- หมายเลขคดีแดง ผู้ส่ง -->
                <input type="text" id="RED_CASE_receive" name="RED_CASE_receive" value="333"><!-- หมายเลขคดีแดง ผู้ส่ง -->
                <input type="text" id="RED_YY_receive" name="RED_YY_receive" value="2565"><!-- หมายเลขคดีแดง ผู้ส่ง -->

                <input type="text" id="COUNT_CODE_receive" name="COUNT_CODE_receive" value="003"><!-- ศาล
 -->

                <input type="text" id="plaintiff_receive" name="plaintiff_receive" value="นายC"><!-- โจทก์  -->
                <input type="text" id="defendant_receive" name="defendant_receive" value="นายD"><!-- จำเลย -->

                <input type="text" id="note" name="note" value="รายละเอียด"><!-- รายละเอียด -->
                <input type="text" id="APPROVE_PERSON" name="APPROVE_PERSON" value="1311100009189"><!-- ผอ อนุมัติ เป็นเลข 13 หลัก ส่งถึงใคร -->
                <input type="text" id="OFFICE_IDCARD" name="OFFICE_IDCARD" value="1311100009189">
                <input type="text" id="OFFICE_NAME" name="OFFICE_NAME" value="นายกฤศวรรธน์ พิลาล้ำ">
                <!-- recive stop -->
            </div>
        </form>
    </div>
</div>


<script>
    function showFromBankrupt() {
        var brc_id_Bankrupt = $('#brc_id_Bankrupt').val();
        if (brc_id_Bankrupt == '') {
            alert('กรุณากรอกbrcId')
            $('#brc_id_Bankrupt').focus('');
            return false;
        } else {
            var text = '&brc_id=' + brc_id_Bankrupt
        }
        var url = "/led_service_api/public/showFromBankrupt.php?1=1" + text;
        window.open(url, 'Image', 'width=1000px.stylewidth,height=1000px.style.height,resizable=1');
    }

    function add_info_tor() {
        let cmd_system = $('#CMD_SYSTEM').val();
        if (cmd_system == '') {
            alert('กรุณาเลือกระบบงาน');
            $('#CMD_SYSTEM').val('');
            $('#CMD_SYSTEM').focus();
            return false
        }
        window.location.href = './add_information_tor.php?cmd_system=' + cmd_system;
    }

    function btn_CivilToWh_fast() {
        let brcId_CivilToWh_fast = $('#brcId_CivilToWh_fast').val();
        var url = "../service/getCivilToWh_fast.php?show_data=Y&pccCivilGen=" + brcId_CivilToWh_fast;
        window.open(url, 'Image', 'width=1000px.stylewidth,height=1000px.style.height,resizable=1');
    }

    function btn_CivilToWh() {
        let brcId_CivilToWh = $('#brcId_CivilToWh').val();
        var url = "../service/getCivilToWh.php?show_data=Y&pccCivilGen=" + brcId_CivilToWh;
        window.open(url, 'Image', 'width=1000px.stylewidth,height=1000px.style.height,resizable=1');
    }

    function btn_Bankrupt() {
        let brcId_Bankrupt = $('#brcId_Bankrupt_num').val();
        var url = "../service/getBankruptToWh_num.php?brcId=" + brcId_Bankrupt + "&show_data=Y";
        window.open(url, 'Image', 'width=1000px.stylewidth,height=1000px.style.height,resizable=1');
    }

    function btn_Bankrupt_num() {
        let brcId_Bankrupt_num = $('#brcId_Bankrupt_num').val();

        var url = "../service/getBankruptToWh_num.php?brcId=" + brcId_Bankrupt_num + "&show_data=Y";

        window.open(url, 'Image', 'width=1000px.stylewidth,height=1000px.style.height,resizable=1');
    }

    function btn_revive() {
        let wfr_revive = $('#wfr_revive').val();

        var url = "../service/getReviveToWh.php?WFR=" + wfr_revive + "&show_data=Y";

        window.open(url, 'Image', 'width=1000px.stylewidth,height=1000px.style.height,resizable=1');
    }

    function btn_mediate() {
        let wfr_mediate = $('#wfr_mediate').val();

        var url = "../service/getMediate.php?WFR=" + wfr_mediate + "&show_data=Y";

        window.open(url, 'Image', 'width=1000px.stylewidth,height=1000px.style.height,resizable=1');
    }

    function btn_backoffice() {
        let wfr_backoffice = $('#wfr_backoffice').val();

        var url = "../service/getBackoffice.php?WFR=" + wfr_backoffice + "&show_data=Y";

        window.open(url, 'Image', 'width=1000px.stylewidth,height=1000px.style.height,resizable=1');
    }

    function inser_data_case(register_code) {
        let attachid = '<?php echo random(50); ?>' //random
        /* ชุดผู้ส่ง start */
        let CMD_DOC_DATE = $('#CMD_DOC_DATE').val(); //วันที่
        let CMD_DOC_TIME = $('#CMD_DOC_TIME').val(); //เวลา

        let register_code_send = $('#register_code_send').val(); //เลข13 หลักผู้ส่ง

        let SYSTEM_ID_send = $('#SYSTEM_ID_send').val(); //คำสั่ง/สอบถาม/แจ้ง จากระบบงาน 

        let T_BLACK_CASE_send = $('#T_BLACK_CASE_send').val(); //หมายเลขคดีดำ ผู้ส่ง
        let BLACK_CASE_send = $('#BLACK_CASE_send').val(); //หมายเลขคดีดำ ผู้ส่ง
        let BLACK_YY_send = $('#BLACK_YY_send').val(); //หมายเลขคดีดำ ผู้ส่ง

        let T_RED_CASE_send = $('#T_RED_CASE_send').val(); //หมายเลขคดีแดง ผู้ส่ง
        let RED_CASE_send = $('#RED_CASE_send').val(); //หมายเลขคดีแดง ผู้ส่ง
        let RED_YY_send = $('#RED_YY_send').val(); //หมายเลขคดีแดง ผู้ส่ง

        let COUNT_CODE_send = $('#COUNT_CODE_send').val(); //ศาล

        let plaintiff_send = $('#plaintiff_send').val(); //โจทก์
        let defendant_send = $('#defendant_send').val(); //จำเลย
        /* ชุดผู้ส่ง stop */

        /* ชุดผู้รับ start */
        let SEND_TO_receive = $('#SEND_TO_receive').val(); //คำสั่ง/สอบถาม/แจ้ง จากระบบงาน 

        let T_BLACK_CASE_receive = $('#T_BLACK_CASE_receive').val(); //หมายเลขคดีดำ ผู้ส่ง
        let BLACK_CASE_receive = $('#BLACK_CASE_receive').val(); //หมายเลขคดีดำ ผู้ส่ง
        let BLACK_YY_receive = $('#BLACK_YY_receive').val(); //หมายเลขคดีดำ ผู้ส่ง

        let T_RED_CASE_receive = $('#T_RED_CASE_receive').val(); //หมายเลขคดีแดง ผู้ส่ง
        let RED_CASE_receive = $('#RED_CASE_receive').val(); //หมายเลขคดีแดง ผู้ส่ง
        let RED_YY_receive = $('#RED_YY_receive').val(); //หมายเลขคดีแดง ผู้ส่ง

        let COUNT_CODE_receive = $('#COUNT_CODE_receive').val(); //ศาล

        let plaintiff_receive = $('#plaintiff_receive').val(); //โจทก์
        let defendant_receive = $('#defendant_receive').val(); //จำเลย
        /* ชุดผู้รับ stop */

        let note = $('#note').val(); //รายละเอียด
        let APPROVE_PERSON = $('#APPROVE_PERSON').val(); //ผอ อนุมัติ เป็นเลข 13 หลัก ส่งถึงใคร
        let OFFICE_IDCARD = $('#OFFICE_IDCARD').val(); //รายละเอียด
        let OFFICE_NAME = $('#OFFICE_NAME').val(); //ผอ อนุมัติ เป็นเลข 13 หลัก ส่งถึงใคร

        /* console.log(APPROVE_PERSON)
        return false */
        $.ajax({
            type: "POST",
            /* url: "./search_data_process_A.php", */
            url: "./search_data_process_A.php",
            data: {
                proc: 'btn_search_data',
                attachid: attachid, //random
                /* ส่ง start  */
                CMD_DOC_DATE: CMD_DOC_DATE, //วันที่
                CMD_DOC_TIME: CMD_DOC_TIME, //เวลา

                REGISTERCODE: register_code_send, //เลข13 หลักผู้ส่ง

                SYSTEM_ID: SYSTEM_ID_send, //คำสั่ง/สอบถาม/แจ้ง จากระบบงาน 

                T_BLACK_CASE: T_BLACK_CASE_send, //หมายเลขคดีดำ ผู้ส่ง
                BLACK_CASE: BLACK_CASE_send, //หมายเลขคดีดำ ผู้ส่ง
                BLACK_YY: BLACK_YY_send, //หมายเลขคดีดำ ผู้ส่ง

                T_RED_CASE: T_RED_CASE_send, //หมายเลขคดีแดง ผู้ส่ง
                RED_CASE: RED_CASE_send, //หมายเลขคดีแดง ผู้ส่ง
                RED_YY: RED_YY_send, //หมายเลขคดีแดง ผู้ส่ง

                COURT_CODE: COUNT_CODE_send, //ศาล ส่ง

                D_C: plaintiff_send, //โจทก์
                D_NAME: defendant_send, //จำเลย
                /* ส่ง stop  */
                /* ------------------------------------------------------------------------------------- */
                /* รับ start  */
                SEND_TO: SEND_TO_receive, //คำสั่ง/สอบถาม/แจ้ง จากระบบงาน 

                TO_T_BLACK_CASE: T_BLACK_CASE_receive, //หมายเลขคดีดำ ผู้ส่ง
                TO_BLACK_CASE: BLACK_CASE_receive, //หมายเลขคดีดำ ผู้ส่ง
                TO_BLACK_YY: BLACK_YY_receive, //หมายเลขคดีดำ ผู้ส่ง

                TO_T_RED_CASE: T_RED_CASE_receive, //หมายเลขคดีแดง ผู้ส่ง
                TO_RED_CASE: RED_CASE_receive, //หมายเลขคดีแดง ผู้ส่ง
                TO_RED_YY: RED_YY_receive, //หมายเลขคดีแดง ผู้ส่ง

                TO_COURT_CODE: COUNT_CODE_receive, //ศาล ส่ง

                TO_PLAINTIFF: plaintiff_receive, //โจทก์
                TO_DEFENDANT: defendant_receive, //จำเลย
                /* รับ stop  */
                /* ------------------------------------------------------------------------------------- */
                CMD_NOTE: note, //รายละเอียด
                APPROVE_PERSON: APPROVE_PERSON, //ผอ อนุมัติ เป็นเลข 13 หลัก ส่งถึงใคร
                OFFICE_IDCARD: OFFICE_IDCARD,
                OFFICE_NAME: OFFICE_NAME
            },
            dataType: "JSON",
            success: function(data) {
                console.log()
                if (1 == 1) {
                    window.location = 'search_data_cmd.php'
                }
            }

        });
    }
</script>