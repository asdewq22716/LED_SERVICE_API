<?php
include 'include/comtop_user.php';
include 'comtop.php';
?>

<!--::header part start::-->
<?php include 'header.php';

$wf_page = $_GET['wf_page'];
$wf_limit = $_GET['wf_limit'] == "" ? 30 : $_GET['wf_limit'];
if ($wf_page == '') {
  $wf_page = 1;
}
$wf_offset = ($wf_page - 1) * $wf_limit;

$HOUSE_TYPE_CODE = conText(trim($_GET['HOUSE_TYPE_CODE']));
$HOUSE_TYPE_NAME_LAW = conText(trim($_GET['HOUSE_TYPE_NAME_LAW']));

$filter = pm::genFilter([
  array('HOUSE_TYPE_CODE', "%$HOUSE_TYPE_CODE%", 'LIKE'),
  array('HOUSE_TYPE_NAME_LAW', "%$HOUSE_TYPE_NAME_LAW%", 'LIKE')
]);

$sql = "SELECT * FROM M_HOUSE_TYPE_MAP WHERE 1=1 $filter ORDER BY HOUSE_TYPE_CODE ASC";
$qry = db::query($sql);
$total = db::num_rows($qry);
$data_main = db::query_limit($sql, $wf_offset, $wf_limit);
$data_report = db::query_limit($sql, $wf_offset, $wf_limit);

?>
<style>
  th {
    color: white;
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
        <?php include 'left_menu.php'; ?>

      </div>
      <div class="col-md-8">
        <div class="row">
          <div class="col-md-6"></div>
          <div class="col-md-6">
            <?php include 'service_code_list_menu.php'; ?>
          </div>
        </div>
        <div class="row">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" role="form" enctype="multipart/form-data" style="width: 100%;">
            <input type="hidden" name="wf_page" id="wf_page" value="<?php echo $wf_page; ?>">
            <div class="row">
              <?php
              echo pm::boxTxt('HOUSE_TYPE_CODE', $HOUSE_TYPE_CODE, 'รหัสประเภทสิ่งปลูกสร้าง', 6, 4, 8, '');
              echo pm::boxTxt('HOUSE_TYPE_NAME_LAW', $HOUSE_TYPE_NAME_LAW, 'ชื่อประเภทสิ่งปลูกสร้าง', 6, 4, 8, '');
              ?>
            </div>
            <div class="row">
              <div class="col-md-12 text-center">
                <button type="submit" name="search" id="search" value="Y" class="btn btn-info"><i class="icofont icofont-search-alt-2"></i> ค้นหา</button>
              </div>
            </div>
          </form>
        </div>
        <div class="row">
          <div class="col-md-6">
            <h4>ประเภทสิ่งปลูกสร้าง</h4>
          </div>
          <div class="col-md-6">
            <button class="iconlink button-search btn-success float-right" type="button" id="btnExport" value="Export" onclick="Export()" style="width: 120px"><span class="fas fa-download"></span>&nbsp;&nbsp;ดาวน์โหลด</button>
          </div>
        </div>
        <!-- show lis api -->

        <div class="table-responsive">
          <table class="table">
            <thead class="breadcrumb_bg">
              <tr>
                <th class="text-center">ลำดับ</th>
                <th class="text-center">รหัสประเภทสิ่งปลูกสร้าง</th>
                <th class="text-center">ชื่อประเภทสิ่งปลูกสร้าง</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($total > 0) {
                $i = 1;
                while ($data = db::fetch_array($data_main)) { ?>
                  <tr>
                    <td class="text-center"><?php echo $i + $wf_offset; ?></td>
                    <td class="text-center"><?php echo $data['HOUSE_TYPE_CODE']; ?></td>
                    <td><?php echo $data['HOUSE_TYPE_NAME_LAW']; ?></td>
                  </tr>
                <?php
                  $i++;
                }
              } else { ?>
                <tr>
                  <td class="text-center" colspan="3">ไม่พบข้อมูล</td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <div class="table-responsive" hidden>
          <table class="table" id="building_table">
            <thead class="breadcrumb_bg">
              <tr>
                <th class="text-center">รหัสประเภทสิ่งปลูกสร้าง</th>
                <th class="text-center">ชื่อประเภทสิ่งปลูกสร้าง</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($total > 0) {
                $i = 1;
                while ($data = db::fetch_array($qry)) { ?>
                  <tr>
                    <td class="text-center">&nbsp;<?php echo $data['HOUSE_TYPE_CODE']; ?></td>
                    <td><?php echo $data['HOUSE_TYPE_NAME_LAW']; ?></td>
                  </tr>
                <?php
                  $i++;
                }
              } else { ?>
                <tr>
                  <td class="text-center" colspan="3">ไม่พบข้อมูล</td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <?php echo ($total > 0) ? endPaging($total, $wf_limit, $wf_page) : ""; ?>
  </div>
</section>

<script>
  function Export() {
    $("#building_table").table2excel({
      filename: "building_type_code"
    });
  }
</script>
<!-- footer part start-->
<?php include 'footer-1.php'; ?>