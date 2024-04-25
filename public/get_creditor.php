<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
$HIDE_HEADER = "P";
include('../include/include.php');
include('../include/paging.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../include/template_user.php'; ?>
</head>
<script>
    window.resizeTo(screen.availWidth, screen.height);
</script>
<!-- <body id="bsf_body" class="horizontal-fixed fixed">
    <div class="wrapper"></div> -->

<body id="bsf_body" class="">
    <div class="wrapper">
        <?php
        //  include '../include/combottom_js_user.php'; //function 
        include '../include/func_Nop.php';
        include "./btn_function.php";
        ?>
        <style>
            .content-wrapper {
                margin-top: -20px;
                /* ปรับระยะห่างด้านบนของ content-wrapper ให้มีค่า 20px */
            }

            .show_hide_area:after {
                font-family: 'IcoFont' !important;
                content: "\eb25";
            }

            .show_hide_area.is-active:after {
                font-family: 'IcoFont' !important;
                content: "\eb28";
            }
        </style>

        <div class="content m-t-20">
            <!-- Container-fluid starts -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Row start -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-block">
                                        <!-- Row start -->
                                        <div class="row">
                                            <div class="col-lg-12">

                                                <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                                                    <thead class="bg-primary">
                                                        <th class="text-center">ลำดับ</th>
                                                        <th class="text-center">ชื่อ-สกุล</th>

                                                    </thead>
                                                    <?php
                                                    $response = api_request('http://103.40.146.73/LedLaw.php/getCreditor', '', array(
                                                        "prefixRedCase" => $_GET['prefixRedCase'],
                                                        "redCase" => $_GET['redCase'],
                                                        "redYy" => $_GET['redYy'],
                                                        "sqtReqSequesterGen" => $_GET['sqtReqSequesterGen']
                                                    ));



                                                    if ($response['ResponseCode']['ResCode'] == '000' && count($response['Data']) > 0) {
                                                        $a = 1;
                                                        foreach ($response['Data'] as $rec) {


                                                    ?>
                                                            <tr>
                                                                <td>
                                                                    <div align='center'><?php echo $a; ?></div>
                                                                </td>
                                                                <td><?php echo $rec['personFullName']; ?> </td>

                                                            </tr>


                                                        <?php
                                                            $a++;
                                                        }
                                                    } else {
                                                        ?>
                                                        <tr>
                                                            <td colspan="2">
                                                                <div align='center'><?php echo 'ไม่มีพบข้อมูล'; ?></div>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }


                                                    ?>
                                                </table>

                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <?php
    include '../include/combottom_js_user.php';
    include '../include/combottom_user.php'; ?>