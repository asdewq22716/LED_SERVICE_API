<?php
include '../include/include.php';
?>
<input type="text" name="page" id="page" value="<?php echo $_GET['page']; ?>">
<?php

$load_page_num = 1;
$sql_total = "SELECT count(a.PCC_CIVIL_ID) AS TOTAL FROM M_PCC_CIVIL_CASE  a";
$query_total = db::query($sql_total);
$rec_PCC = db::fetch_array($query_total);
$result = ceil($rec_PCC['TOTAL'] / $load_page_num);


if ($_GET['page'] == "") {
    $page = 1;
} else {
    $page = $_GET['page'];
}


function page_num1($a)
{
    global $load_page_num;
    $a--;
    $num = "";
    $num = $a * $load_page_num;
    return $num + 1;
}

function page_num2($a)
{
    global $load_page_num;
    $num = "";
    $num = $a * $load_page_num;
    return $num;
}

function sql_paging_londing($sql = "", $page = "")
{
    $sql_load = "SELECT *
    FROM (
        SELECT a.*, ROWNUM AS RN
        FROM (
            " . $sql . "
        ) a
        WHERE ROWNUM <=" . page_num2($page) . "
    )
    WHERE RN >= " . page_num1($page) . "";
    return $sql_load;
}
function load_page($sql = "", $page = "")
{
    $sql_row_data = sql_paging_londing($sql, $page);
    $query_row_data = db::query($sql_row_data);
    while ($recRow_data = db::fetch_array($query_row_data)) {
        unset($fields);
        $fields["SYSTEM"]  = 1;
        $fields["PCC_CIVIL_GEN"]  = $recRow_data['PCC_CIVIL_GEN'];
        db::db_insert("M_LOG_HISTORY", $fields, 'LOG_HISTORY_ID', 'LOG_HISTORY_ID'); //เก็บประวัติการใช้งาน
        unset($fields);
        getCivilToWh($recRow_data['PCC_CIVIL_GEN'], "Y");
    }
}
?>
<script>
    setTimeout(loadUp, 50000);

    function loadUp() {
        window.location = "GetCivilApi.php?page=<?php echo ($page + 1); ?>";
    }
</script>
<?php
echo "<div style=\"text-align:center; margin-top:250px;\"><H1>Processing [ " . $page . " / " . $result . " ]</H1></div>";
$sql = " SELECT a.PCC_CIVIL_ID, a.PCC_CIVIL_GEN FROM M_PCC_CIVIL_CASE a WHERE a.STATUS ='Y'";
echo sql_paging_londing($sql, $page);
load_page($sql, $page);


?>
<script>
    // กำหนดการทำงานหลังจากเวลาดีเลย์




    window.location = "GetCivilApi.php?page=<?php echo ($page + 1); ?>";
</script>