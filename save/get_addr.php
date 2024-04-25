<?php
//$HIDE_HEADER = "Y";
include '../include/include.php';

if ($_POST['type'] == 'province') {

    $html = '<option value="" disabled="" selected="">เลือกอำเภอ</option>';
    $qry = db::query("SELECT AMPHUR_CODE_LAW,AMPHUR_NAME_BOF FROM M_APHUR_MAP WHERE AMPHUR_CODE_LAW LIKE '" . $_POST['province'] . "%' ");
    while ($rec = db::fetch_array($qry)) {
        $html .= '<option value="' . $rec['AMPHUR_CODE_LAW'] . '">' . $rec['AMPHUR_NAME_BOF'] . '</option>';
    }
    $json = array(
        'html' => $html
    );
    echo json_encode($json);
    exit;
}


if ($_POST['type'] == 'aphur') {
    $html = '<option value="" disabled="" selected="">เลือกตำบล</option>';
    $qry = db::query("SELECT TAMBON_CODE_LAW,TAMBON_NAME_BOF FROM M_TAMBON_MAP WHERE TAMBON_CODE_LAW LIKE '" . $_POST['aphur'] . "%' ");
    while ($rec = db::fetch_array($qry)) {

        $html .= '<option value="' . $rec['TAMBON_CODE_LAW'] . '">' . $rec['TAMBON_NAME_BOF'] . '</option>';
    }
    $json = array(
        'html' => $html
    );
    echo json_encode($json);
    exit;
}
/*
if ($_POST['type'] == 'tambon') {

    $sql = "SELECT ADDR_CODE,ADDR_ZIPCODE FROM M_ADDRESS 
			WHERE ADDR_PROVINCE_TH = '" . $_POST['province'] . "' 
			AND ADDR_AMPHUR_TH = '" . $_POST['amphur'] . "' AND ADDR_TAMBON_TH = '" . $_POST['tambon'] . "'";

    $qry = db::query($sql);
    while ($rec = db::fetch_array($qry)) {

        $json = array(
            'zipcode' => $rec['ADDR_ZIPCODE'],
            'addr_code' => $rec['ADDR_CODE']
        );
    }
    echo json_encode($json);
    exit;
}
*/