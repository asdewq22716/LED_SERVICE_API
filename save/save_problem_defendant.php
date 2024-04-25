<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';

$TYPE = conText($_POST['TYPE']);    //ประเภท 1 โจทย์, 2 จำเลย
$SEQ_NO = conText($_POST['SEQ_NO']);
$PER_TYPE = conText($_POST['PER_TYPE']);
$CONCERN = conText($_POST['CONCERN']);
$PREFIX = conText($_POST['PREFIX']);
$FNAME = conText($_POST['FNAME']);
$LNAME = conText($_POST['LNAME']);

$field = array(
    'TYPE' => $TYPE,
    'SEQ_NO' => $SEQ_NO,
    'PER_TYPE' => $PER_TYPE,
    'CONCERN' => $CONCERN,
    'PREFIX' => $PREFIX,
    'FNAME' => $FNAME,
    'LNAME' => $LNAME,
);

$txt['result'] = 'success';
echo json_encode($txt);
