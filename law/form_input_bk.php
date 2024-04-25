<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);

$HIDE_HEADER = "Y";
include '../include/comtop_user.php';


// Variable
$arr_prefix = array();

$sql_prefix = db::query("SELECT * FROM M_PREFIX_MAP WHERE P_ID_LAW IS NOT NULL");
while ($rec = db::fetch_array($sql_prefix)) {
    $arr_prefix[] = $rec;
}
// echo "<pre>";
// print_r($_GET);
// echo "</pre><hr>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>

    <div class="" style="margin-top: 5%;"></div>
    <form action="#" method="get">
        <div class="container">
            <div class="card">
                <div class="card-header text-right">
                    บันทึกข้อมูล
                </div>
                <div class="card-body">

                    <div class="form-group row">
                        <div class="col-md-2 text-right">คำนำหน้าชื่อ</div>
                        <div class="col-md-6">
                            <select class="select2" name="prefix[]" id="prefix" multiple="multiple" style="width: 100%;">
                                <?php foreach ($arr_prefix as $k_pf => $v_pf) { ?>
                                    <option value="<?php echo $v_pf['P_ID_LAW']; ?>"><?php echo $v_pf['P_NAME_BOF']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2 text-right">ชื่อ</div>
                        <div class="col-md-6">
                            <select class="select2" name="fname[]" id="fname" multiple="multiple" style="width: 100%;"></select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2 text-right">นามสกุล</div>
                        <div class="col-md-6">
                            <select class="select2" name="lname[]" id="lname" multiple="multiple" style="width: 100%;" required></select>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">ยืนยัน</button>
                </div>
            </div>
        </div>
    </form>


    <script>
        $("#prefix").select2({
            tags: true, // Allow adding tags
            tokenSeparators: [',', ' '], // Define the separators
        });
        $("#fname").select2({
            tags: true,
        });
        $("#lname").select2({
            tags: true,
        });
    </script>

</body>

</html>