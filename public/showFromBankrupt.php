<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);

include('../include/include.php');

include('../include/paging.php');


if ($_POST) {
    foreach ($_POST as $key => $value) {
        ${$key} = $value;
    }
}

if ($_GET) {
    foreach ($_GET as $key => $value) {
        ${$key} = $value;
    }
}


$curl = curl_init();
$arr_data = [
    'prefixBlackCase' => $_GET['receive_prefixBlackCase'],
];
$arr = json_encode($arr_data);
curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://103.208.27.224:81/led_service_api/service/CheckCase.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $arr,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
));
$response = curl_exec($curl);
curl_close($curl);
$dataReturn = json_decode($response, true);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../include/template_user.php'; ?>
</head>

<!-- <body id="bsf_body" class="horizontal-fixed fixed">
    <div class="wrapper"></div> -->

<body id="bsf_body" class="">
    <div class="wrapper">
        <?php
        include '../include/combottom_js_user.php'; //function 
        include '../include/func_Nop.php';
        include "./btn_function.php";
        ?>
        <style>
            .content-wrapper {
                margin-top: -20px;
                /* ปรับระยะห่างด้านบนของ content-wrapper ให้มีค่า 20px */
            }
        </style>

        <div class="content">
            <!-- Container-fluid starts -->
            <div class="container-fluid">

                <form method="GET" action="./search_data.php" enctype="multipart/form-data" id="frm-input">


                    <input type="hidden" id="page" name="page" value="<?php echo $_GET["page"]; ?>">
                    <input type="hidden" id="page_size" name="page_size" value="<?php echo $_GET["page_size"]; ?>">
                    <!-- Row Starts -->
                    <div class="row" id="animationSandbox">
                        <div class="col-sm-12">
                            <div class="main-header">
                                <div class="media m-b-12">
                                    <!-- <a class="media-left" href="">
                                <img src="../icon/icon11.png" class="media-object"></a>
                            <div class="media-body">
                                <h4 class="m-t-5">&nbsp;</h4>
                                <h4>ค้นหา</h4>
                            </div> -->

                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Row end -->
                    <!-- Row Starts -->
                    <style>
                        .row {
                            display: flex;
                            /* กำหนดให้เป็น flex container */
                            align-items: center;
                            /* จัดตำแหน่งให้ไอคอนอยู่ตรงกลางแนวตั้ง */
                            justify-content: center;
                            /* จัดตำแหน่งให้ไอคอนอยู่ตรงกลางแนวนอน */
                        }

                        .fa.fa-inbox {
                            font-size: 36px;
                            /* ปรับขนาดไอคอนตามที่คุณต้องการ */

                        }

                        .header-badge1 {

                            position: absolute;
                            top: 2px;
                            left: 2px;
                            padding: 3px 7px;
                            font-size: 11px;

                        }
                    </style>


                    <div class='row' style="justify-content: right;margin-right: 7%;">
                        <!-- เรียก api start -->
                        <?php
                        $curl = curl_init();
                        $arr_data = [
                            "pageCode" => "BR010102",
                            "systemCode" => "2",
                            "brcID" => $_GET['brc_id'],
                            "toPersonId" => "3100903272320"
                        ];
                        $arr_data = json_encode($arr_data);
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'http://103.208.27.224:81/led_service_api/service/check_case_bankrupt_btn.php',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => $arr_data,
                            CURLOPT_HTTPHEADER => array(
                                'Content-Type: application/json'
                            ),
                        ));
                        $response = curl_exec($curl);
                        curl_close($curl);
                        $dataReturn = json_decode($response, true);
                        $dataReturn = $dataReturn['Btns'];
                        //print_r_pre($dataReturn);
                        foreach ($dataReturn as $sh1 => $ah1) {
                            echo ($ah1['Html']);
                        }
                        ?>
                        <!-- stop -->
                    </div>
                    <div id="callApi"></div>
                    <div class="row">
                        <div class="main-header">

                            <?php
                            $imagePath = '../icon/bank.png'; // เปลี่ยนเป็นพาทของรูปภาพที่คุณต้องการแสดง

                            // ตรวจสอบว่าไฟล์รูปภาพมีอยู่จริงหรือไม่
                            if (file_exists($imagePath)) {
                                echo '<img width="95%" src="' . $imagePath . '" alt="Image">';
                            } else {
                                echo 'Image not found.';
                            }
                            ?>
                        </div>
                    </div>
                    <!-- Container-fluid ends -->
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    function openDGDialogWithExternalLink(url, width, height) {
        console.log('Opening dialog with link:', url);
        // ทำอย่างไรต่อในการเปิดหน้าต่างหรือทำอื่นตามต้องการ
        // ตัวอย่างเปิดหน้าต่างในกรณีนี้:
        window.open(url, 'ExternalLinkDialog', `width=${width},height=${height}`);
    }

    function open_order() {
        url = 'http://103.208.27.224:81/led_service_api/public/search_data_cmd.php?1=1&TO_PERSON_ID=3100903272320&SEND_TO=2'
        window.open(url, 'Image', 'width=1000px.stylewidth,height=1000px.style.height,resizable=1')
    }

    function callBtnApi(pageCode, systemCode, brcID, toPersonId) {
        var arrData = {
            "pageCode": pageCode,
            "systemCode": systemCode,
            "brcID": brcID,
            "toPersonId": toPersonId
        };

        $.ajax({
            url: "http://localhost/led_service_api/service/check_case_bankrupt_btn.php",
            method: "POST",
            timeout: 0,
            headers: {
                "Content-Type": "application/x-www-form-urlencoded" // Change content type to x-www-form-urlencoded
            },
            data: {
                pageCode:pageCode,
                systemCode:systemCode,
                brcID:brcID,
                toPersonId:toPersonId,
            },
            success: function(response) {
                console.log(response);

                // Access Btns array from the nested structure
                var btnsArray = response.Btns;

                // Loop through each item in Btns array
                $.each(btnsArray, function(index, btn) {
                    // Access individual properties
                    var name = btn.Name;
                    var html = btn.Html;
                    var status = btn.Status;

                    // Append HTML to the element with id="callApi"
                    $("#callApi").append(html);
                });
            },
            error: function(error) {
                // Handle the error
                console.log(error);
            }
        });

    }

    $(document).ready(function() {
        callBtnApi("BR010102", "2", "27498", "3100903272320");
    });
</script>