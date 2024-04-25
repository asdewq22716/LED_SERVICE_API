<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';

$pccCivilGen    = conText($_POST['pccCivilGen']);
$concernType    = conText($_POST['concernType']);
$concernNo      = conText($_POST['concernNo']);
$concernCode    = conText($_POST['concernCode']);
$executionStatus = conText($_POST['executionStatus']);
$personType = conText($_POST['personType']);

$prefix = $_POST['prefix'];
$fname  = $_POST['fname'];
$lname  = $_POST['lname'];
$remark  = $_POST['remark'];
// print_pre(sizeof($_POST));
// print_pre($_POST);
// exit;
if (sizeof($prefix) > 0 && sizeof($fname) > 0 && sizeof($lname) > 0 ) {

    $param = array(
        'pccCivilGen' => $pccCivilGen,
        'concernType' => $concernType,
        'concernNo' => $concernNo,
        'concernCode' => $concernCode,
        'executionStatus' => $executionStatus,
        'titleCode' => $prefix,
        'personType' => $personType,
        'fname' => $fname,
        'lname' => $lname,
        'remark' => $remark
    );

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://103.40.146.73/LedLaw.php/saveCivilConcern',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($param),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $res = json_decode($response, true);

    // print_pre($res);
    // exit;
    echo ($res['ResponseCode']['ResCode']);

    if ($res['ResponseCode']['ResCode'] == '000') {
        echo "<script>alert('บันทึกสำเร็จ');</script>";
        echo "<script>window.close();</script>";
    } else {
        echo "<script>alert('บันทึกไม่สำเร็จ');</script>";
        echo "<script>window.close();</script>";
    }
    // echo "</pre><hr>";
}



$txt['result'] = 'success';
// echo json_encode($txt);
