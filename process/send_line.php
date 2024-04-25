<?php
echo date("H:i:s")."<br>";
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$txt = "คุณได้รับงานใหม่ จากธวัชมี่ อนุชาด

คลิ๊กที่ ".bsl_gen_direction('4', '../workflow/index.php')." เพื่อดูรายละเอียด";
$post = [
	'token_access' => 'VGO54TpsjKQPB2fpcY02n2SbfETsnV6bNxZPdaeLgohtqwi7wnNl6xF+9zgA5xiv8xZhkUTBjg1Hgog0E23gvI86et1O1YHqbjJZw7FEzScidVC3J7no8vS6U0oFeeuYFei0IxF1tWcOFpTxJb5z5AdB04t89/1O/w1cDnyilFU=',
    'process' => 'Y',
    'user_id' => 'U1e95864a488863bdf0c75fc685c94bb3',
    'message'   => $txt
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://bizsmartflow.herokuapp.com/send_message_function.php');
curl_setopt($ch, CURLOPT_POST, true );
curl_setopt($ch,CURLOPT_RETURNTRANSFER, false );
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
curl_exec($ch); 
curl_close($ch);
echo date("H:i:s")."<br>";
db::db_close();
 ?>