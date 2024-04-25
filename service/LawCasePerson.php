<?php
include '../include/include.php';
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
$form_field['USERNAME'] = 'BankruptDt'; // เปลี่ยนเป็นค่าที่จะส่ง
$form_field['PASSWORD'] = 'Debtor4321'; // เปลี่ยนเป็นค่าที่จะส่ง

curl_setopt($ch, CURLOPT_URL, 'http://103.40.146.73/ledservicelaw.php/CivilCasePerson');
curl_setopt($ch, CURLOPT_POST, 1);

$data_string = json_encode($form_field);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
$data = curl_exec($ch);
$data = json_decode($data, true);

if ($data['ResponseCode']['ResCode'] == '000') {

	$loop = count($data['Data']);

	for ($i = 0; $i < $loop; $i++) {

		$loop2 = count($data['Data'][$i]);
		for ($j = 0; $j < $loop2; $j++) {

			$Field = array();
			$Field['REGISTER_CODE'] = $data['Data'][$i][$j]['REGISTERCODE'];
			$Field['PREFIX_CODE'] = $data['Data'][$i][$j]['TITLE_CODE'];
			$Field['PREFIX_NAME'] = $data['Data'][$i][$j]['TITLE_NAME'];
			$Field['FIRST_NAME'] = $data['Data'][$i][$j]['FIRSTNAME'];
			$Field['LAST_NAME'] = $data['Data'][$i][$j]['LNAME'];
			$Field['CONCERN_CODE'] = $data['Data'][$i][$j]['CONCERN_CODE'];
			$Field['CONCERN_NAME'] = $data['Data'][$i][$j]['CONCERN_NAME'];
			$Field['CONCERN_NO'] = $data['Data'][$i][$j]['OWNER_NO'];
			$Field['ADDRESS'] = $data['Data'][$i][$j]['NAME_HOUSE']
				. $data['Data'][$i][$j]['HOUSE_NO']
				. $data['Data'][$i][$j]['ROOM_NO']
				. $data['Data'][$i][$j]['MOO']
				. $data['Data'][$i][$j]['SOI']
				. $data['Data'][$i][$j]['MAIN_STREET'];
			$Field['TUM_CODE'] = $data['Data'][$i][$j]['TUM_CODE'];
			$Field['AMP_CODE'] = $data['Data'][$i][$j]['AMP_CODE'];
			$Field['PROV_CODE'] = $data['Data'][$i][$j]['PROV_CODE'];
			$Field['TUM_NAME'] = $data['Data'][$i][$j]['TUM_NAME'];
			$Field['AMP_NAME'] = $data['Data'][$i][$j]['AMP_NAME'];
			$Field['PROV_NAME'] = $data['Data'][$i][$j]['PRV_NAME'];
			// $Field['PLAINTIFF1'] = $data['Data'][$i][$j]['LOC_GEN_PRV'];				
			$Field['DOSS_ID'] = $data['Data'][$i][$j]['DOSS_ID'];
			$Field['CIVIL_CODE'] = $data['Data'][$i][$j]['CIVIL_CODE'];
			// $Field['CFC_CAPTION_GEN'] = $data['Data'][$i][$j]['CFC_CAPTION_GEN'];				


			$PERSON_CODE = db::db_insert("WH_CIVIL_CASE_PERSON", $Field, 'PERSON_CODE', 'PERSON_CODE');
			$PERSON_CODE = db::db_insert(Convert::ConvertTable('WH_CIVIL_CASE_PERSON'), $Field, 'PERSON_CODE', 'PERSON_CODE');
			$Field2 = array();
			$Field2['PERSON_CODE'] = $PERSON_CODE;
			$Field2['ASSET_CODE'] = $data['Data'][$i][$j]['CFC_TYPE_CODE_GEN'];


			db::db_insert('WH_CIVIL_ASSET_OWNER', $Field2, 'OWNER_ASSET_ID', 'OWNER_ASSET_ID');
		}
	}
}
