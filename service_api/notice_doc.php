
<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include 'include/comtop_user.php';
include 'comtop.php';

$wf_page = $_GET['wf_page'];
$wf_limit = $_GET['wf_limit'] == "" ? 30 : $_GET['wf_limit'];
if($wf_page == ''){
    $wf_page = 1;
}
$wf_offset = ($wf_page-1)*$wf_limit;
$filter = "";
if(!empty($_GET['type_id'])){
  $filter = " AND A.ANC_TYPE_CIVIL = '".$_GET['type_id']."'";
  if($_GET['type_id'] == 1){
    $ba = "selected";
    $re = "";
  }
  if($_GET['type_id'] == 2){
    $ba = "";
    $re = "selected";
  }
}
$sql = "SELECT
        	b.ANC_NOTICE_DATE,
        	a.PREFIX_BLACK_CASE,
        	a.BLACK_CASE,
        	a.BLACK_YEAR,
        	a.PREFIX_RED_CASE,
        	a.RED_CASE,
        	a.RED_YEAR,
        	d.COURT_NAME_LAW,
        	a.PLANTIFF_1,
        	a.PLANTIFF_2,
        	a.PLANTIFF_3,
          c.FILE_SAVE_NAME,
          c.FILE_NAME
        FROM
        	M_ANC_NOTICE_WEBSITE a
        	LEFT JOIN FRM_ANC_NOTICE b ON a.ANC_NOTICE_WEB_ID = b.WFR_ID
        	LEFT JOIN WF_FILE c ON b.F_ID = c.WFR_ID
        	LEFT JOIN M_COURT_CODE_MAP d ON a.COURT_ID = d.COURT_ID
        WHERE
        	c.WFS_FIELD_NAME = 'ANC_NOTICE_FILE'
        	AND b.ANC_PUBLIC_STATUS = '1'
          AND c.FILE_STATUS = 'Y'
        	AND b.ANC_NOTICE_DATE = TRUNC( SYSDATE )
          {$filter}";
$qry = db::query($sql);
$total = db::num_rows($qry);
$data_api = db::query_limit($sql,$wf_offset,$wf_limit);
$data_api = db::query_limit($sql,$wf_offset,$wf_limit);
?>
    <!--::header part start::-->
    <style>
      th {
        color: white;
      }
      .banner_part{
        height: auto;
      }
    </style>
    <!-- Header part end-->
    <header class="main_menu home_menu">
      <div class="container">
        <nav class="navbar navbar-light ">
          <div class="col-md-5"></div>
          <div class="col-lg-6">
            <a  href="#" class="navbar-brand"><img src="images/logo.png"> กรมบังคับคดี</a>
          </div>
          <div class="col-md-1"></div>
        </nav>
      </div>
    </header>
    <!-- breadcrumb start -->
    <section class="breadcrumb breadcrumb_bg ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>ประกาศเจ้าพนักงานพิทักษ์ทรัพย์</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->


    <section class="banner_part">
    	<div class="container">
        <div class="row">
          <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="breadcrumb_bg">
                  <table class="table">
                    <tbody>
                      <tr>
                          <th class="text-left" style="width:20%">ประเภทคดี	</th>
                          <th class="text-left">
                            <select id="data_type" class="form-control select2" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                              <option value="http://103.208.27.224:81/led_service_api/public/notice_doc.php" selected>ทั้งหมด</option>
                              <option value="http://103.208.27.224:81/led_service_api/public/notice_doc.php?type_id=1" <?php echo $ba;?>>ล้มละลาย</option>
                              <option value="http://103.208.27.224:81/led_service_api/public/notice_doc.php?type_id=2" <?php echo $re;?>>ฟื้นฟูกิจการของลูกหนี้</option>
                            </select>
                          </th>
                          <th class="text-center"><button class="iconlink button-search btn-success" onclick="window.location.href='http://203.151.166.132/LED_SINGLE_FORM/public/'"><i class="fas fa-search"></i></button></th>
                      </tr>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
      		<div class="row">
                <div class="col-md-12">
                    <!-- show lis api -->

                    <div class="table-responsive">
                    <table class="table">
                        <thead class="breadcrumb_bg">
                            <tr>
                                <th class="text-center" style="width:10%">วันที่ประกาศ</th>
                                <th class="text-center" style="width:15%">เลขคดีดำ</th>
                                <th class="text-center" style="width:15%">เลขคดีแดง</th>
                                <th class="text-center" style="width:20%">ศาล</th>
                                <th class="text-center" style="width:20%">โจทก์</th>
                                <th class="text-center" style="width:20%">ประกาศ</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                          if($total > 0){
                            while ($rec_data = db::fetch_array($data_api)) {
                              if(!empty($rec_data['BLACK_CASE']) && !empty($rec_data['BLACK_YEAR'])){
                                $blackCase = $rec_data['PREFIX_BLACK_CASE'].$rec_data['BLACK_CASE']."/".$rec_data['BLACK_YEAR'];
                              }else{
                                $blackCase = "";
                              }
                              if(!empty($rec_data['RED_CASE']) && !empty($rec_data['RED_YEAR'])){
                                $redCase = $rec_data['PREFIX_RED_CASE'].$rec_data['RED_CASE']."/".$rec_data['RED_YEAR'];
                              }else{
                                $redCase = "";
                              }
                              if(!empty($rec_data['PLANTIFF_1']) && !empty($rec_data['PLANTIFF_2']) && !empty($rec_data['PLANTIFF_3'])){
                                $plaintiff = $rec_data['PLANTIFF_1']." และพรรคพวกอีก 2 คน";
                              }
                              elseif(!empty($rec_data['PLANTIFF_1']) && !empty($rec_data['PLANTIFF_2']) && empty($rec_data['PLANTIFF_3'])){
                                $plaintiff = $rec_data['PLANTIFF_1']." และ ".$rec_data['PLANTIFF_2'];
                              }else{
                                $plaintiff = $rec_data['PLANTIFF_1'];
                              }
                              echo "<tr>
                                      <td class='text-center'>".db2date($rec_data['ANC_NOTICE_DATE'])."</td>
                                      <td class='text-left'>".$blackCase."</td>
                                      <td class='text-left'>".$redCase."</td>
                                      <td class='text-left'>".$rec_data['COURT_NAME_LAW']."</td>
                                      <td class='text-left'>".$plaintiff."</td>
                                      <td class='text-left'><a href='../attach/w106/".$rec_data['FILE_SAVE_NAME']."' target='_blank'>".$rec_data['FILE_NAME']."</a></td>
                                    </tr>";
                            }
                          }else{
                            echo "<tr>
                                    <td class='text-center' colspan='6'>ไม่พบข้อมูล</td>
                                  </tr>";
                          }
                          ?>
                        </tbody>
                    </table>
                  </div>
                  <?php echo ($total>0)?endPaging($total,$wf_limit,$wf_page):""; ?>
                </div>
            </div>
    	</div>
    </section>
    <!-- footer part start-->
