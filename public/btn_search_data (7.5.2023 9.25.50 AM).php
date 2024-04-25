<?php
session_start();

include '../include/comtop_user.php'; //connect db
include '../include/combottom_js_user.php'; //function 

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
                                            <div class="col-xs-12 col-sm-2"> <button class="btn btn-primary" type="button" onclick="inser_data_case('4459884784638');">บันทึก</button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
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
        let register_code_receive = $('#register_code_receive').val(); //เลข13 หลักผู้ส่ง
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


        $.ajax({
            type: "POST",
            url: "./search_data_process_A.php",
            data: {
                proc: 'btn_search_data',
                attachid:attachid,//random
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
            },
            dataType: "JSON",
            success: function(data) {
                console.log(data);
            }

        });
    }
</script>