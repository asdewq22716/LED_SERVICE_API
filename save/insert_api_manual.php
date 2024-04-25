<?php
 $HIDE_HEADER = "Y";
include '../include/comtop_user.php';

 print_pre($_POST);
 unset($data);
 $data['SERVICE_CODE'] = $_POST['service_code'];
 $data['SERVICE_LIST'] = $_POST['setting_name'];
 $data['API_STATUS'] = $_POST['setting_status'];
 $data['SERVICE_ID'] = $_POST['service_id'];
 $data['API_DESC'] = conText($_POST['api_desc']);

 $API_SETTING_ID = db::db_insert("M_API_SETTING",$data,"API_SETTING_ID","API_SETTING_ID");

foreach($_POST['request_key'] as $k => $v){
	// echo ."<br>";
	$feild['KEY'] = $v;
   $feild['TYPE'] = $_POST['request_type'][$k];
   $feild['STATUS'] = $_POST['request_select'][$k];
   $feild['API_DESC'] = $_POST['request_desc'][$k];
   $feild['API_SETTING_ID'] = $API_SETTING_ID;
   $feild['API_STATUS'] = 0; //0 = request; 1 = response;

   db::db_insert("M_API_LIST",$feild,"API_LIST_ID");

}

foreach($_POST['response_key'] as $k => $v){
	// echo ."<br>";
	 $feild['KEY'] = $v;
   $feild['TYPE'] = $_POST['response_type'][$k];
   $feild['STATUS'] = $_POST['response_select'][$k];
   $feild['API_DESC'] = $_POST['response_desc'][$k];
   $feild['API_SETTING_ID'] = $API_SETTING_ID;
   $feild['API_STATUS'] = 1; //0 = request; 1 = response;

   db::db_insert("M_API_LIST",$feild,"API_LIST_ID");

}

?>
