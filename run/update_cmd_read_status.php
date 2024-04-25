<?php
include "../include/config.php";

$sqlselectData = "UPDATE M_DOC_CMD SET SYSTEM_READ_STATUS = 'Y' where ID in (SELECT ID FROM M_DOC_CMD WHERE NVL(CMD_READ_STATUS,0) = 0 AND (to_date(TO_CHAR(sysdate,'YYYY-MM-DD'),'YYYY-MM-DD')-to_date(TO_CHAR(CMD_DOC_DATE,'YYYY-MM-DD'),'YYYY-MM-DD')) >= 15)";
$querySelectData = db::query($sqlselectData);

db::db_close();
?>

