<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';

unset($data);

if (isset($_POST['group_id'])) {

    $group_id = $_POST['group_id'];
    $service_id = $_POST['service_id'];

    $cond = [
        'PRIVILEGE_GROUP_ID' => $group_id,
        'SERVICE_MANAGE_ID' => $service_id,
    ];
    db::db_delete('SERVICE_MAPPING_GROUP', $cond);

    // จากหน้าเมนู mapping จัดการสิิทธิ
    foreach ($_POST['chk_set'] as $key => $value) {
        $feild = [];
        $feild['MAPPING_STATUS'] = 1;
        $feild['SERVICE_MANAGE_ID'] = $service_id;
        $feild['PRIVILEGE_GROUP_ID'] = $group_id;
        $feild['API_SETTING_ID'] = $value;
        db::db_insert("SERVICE_MAPPING_GROUP", $feild);
    }
} else {

    $data['SERVICE_CODE'] = $_POST['service_code'];
    $data['SERVICE_LIST'] = conText($_POST['setting_name']);
    $data['API_STATUS'] = $_POST['setting_status'];
    $data['SERVICE_ID'] = $_POST['service_id'];
    $data['API_DESC'] = conText($_POST['api_desc']);
    $data['EXPORT_REPORT'] = $_POST['export_report'];

    if ($_POST['export_report'] == 1) {
        db::db_update("M_API_SETTING", array('EXPORT_REPORT' => 2), array('SERVICE_ID' => $_POST['service_id']));
    }

    $API_SETTING_ID = db::db_update("M_API_SETTING", $data, array('API_SETTING_ID' => $_POST['setting_id']));

    //จากเมนู api manaul เป็นตัวจัดการหลัก
    foreach ($_POST['request_key'] as $k => $v) {
        $feild=[];
        $feild['KEY'] = $v;
        $feild['TYPE'] = $_POST['request_type'][$k];
        $feild['STATUS'] = $_POST['request_select'][$k];
        $feild['API_DESC'] = $_POST['request_desc'][$k];
        $feild['API_SETTING_ID'] = $_POST['setting_id'];
        
        db::db_update("M_API_LIST", $feild, array('API_LIST_ID' => $_POST['list_id_req'][$k]));

    }

    foreach ($_POST['response_key'] as $k => $v) {
        $feild=[];
        $feild['KEY'] = $v;
        $feild['TYPE'] = $_POST['response_type'][$k];
        $feild['STATUS'] = $_POST['response_select'][$k];
        $feild['API_DESC'] = $_POST['response_desc'][$k];
        $feild['API_SETTING_ID'] = $_POST['setting_id'];

        db::db_update("M_API_LIST", $feild, array('API_LIST_ID' => $_POST['list_id_res'][$k]));

    }

}
