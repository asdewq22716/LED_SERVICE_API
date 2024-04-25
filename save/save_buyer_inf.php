<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';

$process = $_POST['process'];

if ($process != 'del') {
    $HERITAGE_TYPE = conText($_POST['HERITAGE_TYPE']);
    $HERITAGE_ID_CARD = conText(str_replace('-', '', $_POST['HERITAGE_ID_CARD']));
    $PREFIX = conText($_POST['PREFIX']);
    $FNAME = conText($_POST['FNAME']);
    $LNAME = conText($_POST['LNAME']);
    $ADDRESS = conText($_POST['ADDRESS']);
    $PROVINCE = conText($_POST['PROVINCE']);
    $APHUR = conText($_POST['APHUR']);
    $TAMBON = conText($_POST['TAMBON']);
    $ADD_ZIPCODE = conText($_POST['ADD_ZIPCODE']);
}

switch ($process) {
    case "add":

        $field = array(
            'HERITAGE_TYPE' => $HERITAGE_TYPE,
            'HERITAGE_ID_CARD' => $HERITAGE_ID_CARD,
            'PREFIX' => $PREFIX,
            'FNAME' => $FNAME,
            'LNAME' => $LNAME,
            'ADDRESS' => $ADDRESS,
            'PROVINCE' => $PROVINCE,
            'APHUR' => $APHUR,
            'TAMBON' => $TAMBON,
            'ADD_ZIPCODE' => $ADD_ZIPCODE,
        );
        // db::db_insert("Table", $field, "primaryKey", "");

        $txt['result'] = 'success';
        echo json_encode($txt);


        break;
    case "edit":

        $WFR_ID = $_POST['WFR_ID'];

        if (isset($WFR_ID)) {
            $field = array(
                'HERITAGE_TYPE' => $HERITAGE_TYPE,
                'HERITAGE_ID_CARD' => $HERITAGE_ID_CARD,
                'PREFIX' => $PREFIX,
                'FNAME' => $FNAME,
                'LNAME' => $LNAME,
                'ADDRESS' => $ADDRESS,
                'PROVINCE' => $PROVINCE,
                'APHUR' => $APHUR,
                'TAMBON' => $TAMBON,
                'ADD_ZIPCODE' => $ADD_ZIPCODE,
            );

            $cond['WFR_ID'] = $WFR_ID;

            // db::db_update('Table', $field, $cond);
            $txt['result'] = 'success';
        } else {
            $txt['result'] = 'error';
        }
        echo json_encode($txt);


        break;
    case "del":
        $WFR_ID = $_POST['WFR_ID'];

        if (isset($WFR_ID)) {
            // db::db_delete('Table', array('WFR_ID' =>  $WFR_ID));
            $txt['result'] = 'success';
        } else {
            $txt['result'] = 'error';
        }
        echo json_encode($txt);


        break;
}
