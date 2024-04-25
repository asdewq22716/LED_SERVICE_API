<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", "0");
include "../include/config.php";
$arr_session = [];

$date = date("d/m/") . (date("Y") + 543);
$save = isset($_POST["save"]) ? conText($_POST["save"]) : "";
$PERMISSION_I = isset($_POST["PERMISSION_I"])
    ? conText($_POST["PERMISSION_I"])
    : "";

if ($PERMISSION_I == "H") {
    $str = "";
    $str_arr = [];
    $sql_usr = db::query(
        "SELECT * FROM USR_MAIN WHERE USR_ID='" .
            $_SESSION["TEMP_WF_USER_ID"] .
            "' "
    );
    $usr = db::fetch_array($sql_usr);

    $sql_permission = db::query(
        "SELECT * FROM PERMISSION_INSTEAD WHERE USR_ID='" .
            $usr["USR_ID"] .
            "' AND '" .
            date2db($date) .
            "' BETWEEN PI_STARTDATE AND PI_ENDDATE"
    );
    $p = db::fetch_array($sql_permission);

    $sql = db::query(
        "SELECT * FROM USR_SETTING WHERE ((FIELD_TYPE='O') OR (FIELD_TYPE='S' AND (FIELD_NAME = 'DEP_ID' OR FIELD_NAME='POS_ID')))  ORDER BY FIELD_ID"
    );

    while ($rec_o = db::fetch_array($sql)) {
        if ($p[$rec_o["FIELD_NAME"]] != "") {
            $arr_field = show_user_detail($p, $rec_o["FIELD_NAME"]);
            $str .= $arr_field["label"] . " " . $arr_field["value"] . " ";
            array_push(
                $str_arr,
                $arr_field["label"] . " " . $arr_field["value"]
            );
            $arr_session[$rec_o["FIELD_NAME"]] = $p[$rec_o["FIELD_NAME"]];
        }
    }

    foreach ($arr_session as $_key => $_val) {
        $_SESSION[$_key] = $_val;
    }
}
db::db_close();
?>
<script type="text/javascript">
	window.location.href="../workflow";
</script>
