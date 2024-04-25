
<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include 'include/comtop_user.php';
include 'comtop.php';
if (($_SESSION['GROUP_ID'] != 2)) {
    session_destroy();
    unset($_SESSION['GROUP_ID']);
    header('location: login.php');
}
?>
    <!--::header part start::-->
    <?php include 'header.php';

    $wf_page = $_GET['wf_page'];
    $wf_limit = $_GET['wf_limit'] == "" ? 30 : $_GET['wf_limit'];
    if($wf_page == ''){
        $wf_page = 1;
    }
    $wf_offset = ($wf_page-1)*$wf_limit;

    $username = $_SESSION['username'];
    $sql_id = db::query("SELECT * FROM USER_API_SERVICE WHERE USR_USERNAME = '".$username."'");
    $data_id = db::fetch_array($sql_id);
    
    $sql = "SELECT * FROM M_LOG WHERE USR_ID = '".$data_id['USR_ID']."'";
    $qry = db::query($sql);
    $total = db::num_rows($qry);
    $data_code = db::query_limit($sql,$wf_offset,$wf_limit);

    
    ?>

    
    <style>
      th {
        color: #FFFF;
        width: 800px;
        background-color: #A8164E;
        height: 50px;
        text-align: center;
      }
      td {
        text-align: right;
        width: 800px;
      }
     
      table {
            width: 100%;
        }

      
  
    </style>
    <!-- Header part end-->

    <!-- breadcrumb start -->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>API Documentation</h2>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->


    <section id="tabs">
    	<div class="container">
      		<div class="row">
                <div class="col-md-4">
                <?php include 'left_menu.php';?>

                </div>
                <div class="col-md-8">
                  <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                      
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-10"><h4>Overview</h4> </div>
                    <div><h6>Reset/password</h6> </div>
                  </div>
                    <!-- show lis api -->

                    <div class="padding-20 shadow">
                        <h3>Data Transection Log</h3>
                            <div>
                                    <div id='calendar' ></div>
                               
                                <!-- <pre  style="width: 650px; height: 200px;" class="prism-editor__code language-text">
                                    <h5 align="center" style=" line-height: 8em;">Dashboard</h5>
                                </pre> -->
                            </div>
                            <div class="mt-4 "align="left">
                            <h3>History Log</h3>
                            </div>
                            <div class="mt-4 ">
                                <table class="table">
                                <thead class="breadcrumb_bg" align="center">
                                    <tr>
                                        <th  style="color: #FFFF; " >Web Service API </th>
                                        <th  style="color: #FFFF; " >IPADDRESS</th>
                                        <th  style="color: #FFFF; " >Date/Time</th>
                                        <th  style="color: #FFFF; " >Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                <?php

                                    while($row = db::fetch_array($data_code)){
                                      
                                        
                                    ?>
                                        <tr>
                                            <td align="center"><?php echo $row['REQUEST'];?></td>
                                            <td align="left"><?php echo $row['IP_ADDRESS'];?></td>
                                            <td align="center"><?php echo $row['LOG_DATE'];?></td>
                                            <td align="left"><?php echo $row['REQUEST_STATUS'];?></td>

                                        </tr>
                                    <?php  }
                                    ?>
                                </tbody>
                                </table>
                            </div>
                            <?php echo ($total>0)?endPaging($total,$wf_limit,$wf_page):"";?>
                    </div>

                </div>
            </div>
    	</div>
    </section>

    <!-- footer part start-->
<?php include 'footer-1.php';?>
<script src="../assets/plugins/calendar/js/moment.min.js"></script>
<script src="../assets/plugins/calendar/js/fullcalendar.min.js"></script>
<script src="../assets/plugins/calendar/js/locale-all.js"></script> 
<?php 
 $sql = "SELECT * FROM M_LOG WHERE USR_ID = '".$data_id['USR_ID']."'";
 $qry = db::query($sql);
 

?>
<script>
$(document).ready(function() {
    var initialLocaleCode = 'th';

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
            height:900,
            timeZone: 'UTC',
            defaultDate: <?php echo date("Y-m-d"); ?>, 
            locale: initialLocaleCode,
            businessHours: true,
            buttonIcons: true, // show the prev/next text
            weekNumbers: false,
            navLinks: true, // can click day/week names to navigate views
            editable: false,
            // eventLimit: false, // allow "more" link when too many events
            events : [
                <?php while($event_qry = db::fetch_array($qry)){
                    if($event_qry['REQUEST_STATUS'] == '200'){
                        $borderColor = '#213259';
                        $backgroundColor = '#85c8ff';
                    }
            
                echo "{ title: '".$event_qry['IP_ADDRESS']."' 
                    ,start: '".$event_qry['LOG_DATE']."'
                    ,end: '".$event_qry['LOG_DATE']."'
                    , borderColor: '".$borderColor."'
                    , backgroundColor: '".$backgroundColor."'
                    , color: '#FFFFFF' } ,";
                } ?>
                    ]
        
        
            
    });
});
</script>