<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$data = json_decode($str_json, true);
if ($data['userName'] == 'BankruptDt' && $data['passWord'] == 'Debtor4321') {

    $api_token_url = 'https://trackapi.thailandpost.co.th/post/api/v1/authenticate/token';
    $api_track_url = 'https://trackapi.thailandpost.co.th/post/api/v1/track';
    $token_key = 'Y?KEOkYESQR8WIAGHYCMVcD3PlO@O6VWQHJTSyZmRYOkE-QHZwI8XnR8GpSEMLR&LMX8P9DLTjFyAyTcVnEoK$YeL0YWKVE4HbA+';


    if (count($data['trackingCode']) > 1) {
        foreach ($data['trackingCode'] as $k) {

            $track[] = $k;
        }
    } else {
        $track[] = $data['trackingCode'];
    }

    $items = [
        'status' => 'all',
        'language' => 'TH',
        'barcode' => $track
    ];

    $res_token = api_request($api_token_url, $token_key);
    $res_items = api_request($api_track_url, $res_token['token'], $items);


    $obj = $res_items['response']['items'];

    //$obj = (json_encode($obj));
    foreach ($obj as $A1 => $B1) {
        $num=0;
        $obj_array = [];
        for ($i = count($B1); $i > 0; $i--) {
            $num = $i - 1;
            $obj_array[$A1][]=($B1[$num]);
        }
    }

   // $obj = (json_encode($obj));//ของเดิม น้อยไปมาก  (ของใหม่ obj_array)
}
$trackingCode = $data['trackingCode'];
$datatrack = $res_items['response']['items'][$trackingCode];

foreach ($datatrack as $k => $v) {

    $newFormat = explode(" ", $v['status_date']);
    $newFormatTime = explode("+", $newFormat[1]);

    $data1['userName']        = "BankruptDt";
    $data1['passWord']        = "Debtor4321";
    $data1['trackingCode']    = $v['barcode'];
    $data1['trackDate']       = $newFormat[0];
    $data1['location']        = $v['location'];
    $data1['trackDetail']     = $v['status_description'];
    $data1['trackResult']     = $v['delivery_description'];
    $data1['receiverName']    = $v['receiver_name'];
    $data1['signature']          = $v['signature'];
    $data1['trackTime']          = $newFormatTime[0];
    $datastring = json_encode($data1);

    // print_pre( $data1 );
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_PORT => "81",
        CURLOPT_URL => "http://103.208.27.224:81/led_service_api/service/insertTracking.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>  $datastring,
        CURLOPT_HTTPHEADER => array(

            "content-type: application/json"

        ),
    ));

    $response = curl_exec($curl);
    $resp = json_decode($response, true);
}
//   exit;


$num = count($obj_array);
if ($num > 0) {

    $row['ResponseCode'] = array('ResCode' => '000', 'ResMeassage' => "SUCCESS");
    $row['Data'] = $obj_array;
} else {

    $row['ResponseCode'] = array('ResCode' => '102', 'ResMeassage' => "NOT FOUND");
}

echo json_encode($row);
