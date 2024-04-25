<?php
include('../include/include.php');

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include '../include/template_user.php'; ?>
</head>

<body>
    <div class="content m-t-20">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Row start -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">


                                <div class="row">
                                    <div class="col-lg-8"></div>

                                    <div class="col-lg-4" style="text-align: right;">
                                        <div id='show_control'></div>
                                        <!-- เรียก api start -->
                                        <script>
                                            $(document).ready(function() {
                                                var settings = {
                                                    "url": "http://localhost/led_service_api/service/check_case_bankrupt_btn.php",
                                                    "method": "POST",
                                                    "timeout": 0,
                                                    "headers": {
                                                        "Content-Type": "text/plain"
                                                    },
                                                    "data": "{\r\n     \"pageCode\":\"BR010102\",\r\n     \"systemCode\":\"2\",\r\n     \"brcID\":\"27503\",\r\n     \"toPersonId\":\"1489900129401\"\r\n}",
                                                };

                                                $.ajax(settings).done(function(response) {
                                                    console.log(response.Btns);
                                                    
                                                    for (let key in response.Btns) {
                                                        console.log(key)
                                                        ('#show_control').html(key['Html'])
                                                        for (let key1 in key) {
                                                        console.log(key1)
                                                        ('#show_control').html(key['Html'])
                                                    }
                                                    }
                                                });
                                            });
                                        </script>

                                    </div>


                                </div>

                                <iframe name="aaa" id="aaa" frameborder="0" width="100%" height="100%" class="webPage" src="http://bruat.led.go.th/ledbrlive2/authentication/logout.action" allowfullscreen> </iframe>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>