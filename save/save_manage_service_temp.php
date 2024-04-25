<?php

$tbServiceMappingApiTemp = 'SERVICE_MAPPING_API_TEMP';

$cond = array(
    'PRIVILEGE_GROUP_ID' => $WFR,
);
db::db_delete($tbServiceMappingApiTemp, $cond);

$arrApiSetting = array();

$sqlApiSetting = "SELECT API_SETTING_ID,SERVICE_ID FROM M_API_SETTING WHERE 1=1 ";
$qryApiSetting = db::query($sqlApiSetting);
while ($recApiSetting = db::fetch_assoc($qryApiSetting)) {
    $arrApiSetting[$recApiSetting['API_SETTING_ID']] = $recApiSetting['SERVICE_ID'];
}

// จากหน้าเมนู mapping จัดการสิิทธิ
foreach ($_POST['chk_set'] as $key => $value) {
    $feild = [];
    $feild['MAPPING_STATUS'] = 1;
    $feild['SERVICE_MANAGE_ID'] = $arrApiSetting[$value];
    $feild['PRIVILEGE_GROUP_ID'] = $WFR;
    $feild['API_SETTING_ID'] = $value;
    db::db_insert($tbServiceMappingApiTemp, $feild);
}
