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

$ASS_ASSET_CODE = conText(trim($_GET['ASS_ASSET_CODE']));
$ASS_ASSET_NAME = conText(trim($_GET['ASS_ASSET_NAME']));

$filter = pm::genFilter([
  array('ASS_ASSET_CODE', "%$ASS_ASSET_CODE%", 'LIKE'),
  array('ASS_ASSET_NAME', "%$ASS_ASSET_NAME%", 'LIKE')
]);

$sql = "SELECT * FROM M_ASS_ASSET_MAPPING WHERE 1=1 $filter ORDER BY ASS_ASSET_CODE ASC";
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
              echo pm::boxTxt('ASS_ASSET_CODE', $ASS_ASSET_CODE, 'รหัสประเภททรัพย์', 6, 4, 8, '');
              echo pm::boxTxt('ASS_ASSET_NAME', $ASS_ASSET_NAME, 'ชื่อประเภททรัพย์', 6, 4, 8, '');
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
            <h4>ประเภททรัพย์</h4>
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
                <th class="text-center">รหัสประเภททรัพย์</th>
                <th class="text-center">ชื่อประเภททรัพย์</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($total > 0) {
                $i = 1;
                while ($data = db::fetch_array($data_main)) { ?>
                  <tr>
                    <td class="text-center"><?php echo $i + $wf_offset; ?></td>
                    <td class="text-center"><?php echo $data['ASS_ASSET_CODE']; ?></td>
                    <td><?php echo $data['ASS_ASSET_NAME']; ?></td>
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
          <table class="table" id="type_asset_table">
            <thead class="breadcrumb_bg">
              <tr>
                <th class="text-center">รหัสประเภททรัพย์</th>
                <th class="text-center">ชื่อประเภททรัพย์</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($total > 0) {
                $i = 1;
                while ($data = db::fetch_array($qry)) { ?>
                  <tr>
                    <td class="text-center">&nbsp;<?php echo $data['ASS_ASSET_CODE']; ?></td>
                    <td><?php echo $data['ASS_ASSET_NAME']; ?></td>
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
    $("#type_asset_table").table2excel({
      filename: "asset_type_code"
    });
  }
</script>
<!-- footer part start-->
<?php include 'footer-1.php'; ?>