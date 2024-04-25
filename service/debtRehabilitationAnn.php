<?php
include '../include/include.php';

$url = connect_api_revive('aa.php');

$con = curl_init();
curl_setopt($con, CURLOPT_CONNECTTIMEOUT, 120);
curl_setopt($con, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.6 (KHTML, like Gecko) Chrome/16.0.897.0 Safari/535.6");
curl_setopt($con, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
curl_setopt($con, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($con, CURLOPT_HEADER, 0);
curl_setopt($con, CURLOPT_TIMEOUT, 120);

//SERVICE
$ch = $con; 
$form_field['USERNAME'] = 'BankruptDt';// เปลี่ยนเป็นค่าที่จะส่ง
$form_field['PASSWORD'] = 'Debtor4321';// เปลี่ยนเป็นค่าที่จะส่ง

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);

$data_string = json_encode($form_field);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
$data = curl_exec($ch);
$data = json_decode($data, true);

$field = array();

if($data['ResponseCode']['ResCode'] == '000') {	

		
	foreach($data['Data'] as $k => $v){

		$sql = "SELECT
					WH_REHAB_ID
				FROM
					WH_REHABILITATION_CASE_DETAIL
				WHERE
					PREFIX_BLACK_CASE = '".$v['prefixBlackCase']."'
				AND BLACK_CASE = '".$v['blackCase']."'
				AND BLACK_YY = '".$v['blackYy']."'
				AND PREFIX_RED_CASE = '".$v['prefixRedCase']."'
				AND RED_CASE = '".$v['redCase']."'
				AND RED_YY = '".$v['redYy']."'";
		$query = db::query($sql);
		$i = 0;
		while ($rec = db::fetch_array($query)) {
			
			$sql2 = "SELECT
						WH_COURT_REB_ID
					FROM
						WH_REHABILITATION_COURT
					WHERE
						WH_REHAB_ID = '".$rec['WH_REHAB_ID']."'
					AND COURT_ORDER_NAME = '".$v['order_subject']."'";
			$query2 = db::query($sql2);
			$i = 0;
			while ($rec2 = db::fetch_array($query2)) {
				unset($field);
				$field['ANC_DOC_NO'] = $rec['annNo'];
				$field['ANC_DOC_DATE'] = $rec2['annDate'];
				$field['ANC_NUM_1'] = $v['ann1'];
				$field['ANC_NUM_2'] = $v['ann2'];
				$field['ANC_NUM_3'] = $v['ann3'];
				$field['ANC_DETAILS'] = $v['remark'];
				$field['WH_COURT_REB_ID'] = $rec2['WH_COURT_REB_ID'];
				
				db::db_insert('WH_REHABILITATION_ANC', $field ,'ANC_ID');
			}
			
		}
		
		 
	}

}

?>