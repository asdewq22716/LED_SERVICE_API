<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$res = json_decode($str_json, true);


$field = array();
$field['IP_ADDRESS'] = $ip ;
$field['DEP_ID'] = $POST['depId'];
$field['REQUEST'] = 'insertCmdNotification';
$field['LOG_DATE'] = date("Y-m-d");
$field['LOG_TIME'] = date("H:i:s");
$field['USR_ID'] = '' ;
$field['REQUEST_STATUS'] = '200';
$field['USR_IDCARD'] = $POST['idCard'];
$field['LOG_TYPE'] = '1' ;
$field['REQUEST_DATA'] = $str_json;

$LOG_ID = db::db_insert('M_LOG', $field, 'LOG_ID','LOG_ID');

if($res['userName'] == 'BankruptDt' && $res['passWord'] == 'Debtor4321'){


	//คำสั่งหลัก
	unset($fields);
		$fields["CMD_DOC_DATE"] 		= 		$res["cmdDate"];
		$fields["CMD_DOC_TIME"] 		= 		$res["cmdTime"];
		
		
		$sqlSelectCourt1 		= "select COURT_CODE from M_COURT where COURT_NAME = '".$res["courtName"]."'";
		$querySelectCourt1 		= db::query($sqlSelectCourt1);
		$recSelectCourt1 	 	= db::fetch_array($querySelectCourt1);
		
		$fields["COURT_CODE"] 			= 		$recSelectCourt1["COURT_CODE"];
		$fields["COURT_NAME"] 			= 		$res["courtName"];
		
		$fields["F_BLACK_CASE"] 		= 		$res["prefixBlackCase"].$res["blackCase"]."/".$res["blackYy"];
		$fields["T_BLACK_CASE"] 		= 		$res["prefixBlackCase"];
		$fields["BLACK_CASE"] 			= 		$res["blackCase"];
		$fields["BLACK_YY"] 			= 		$res["blackYy"];
		$fields["F_RED_CASE"] 			= 		$res["prefixRedCase"].$res["redCase"]."/".$res["redYy"];
		$fields["T_RED_CASE"] 			= 		$res["prefixRedCase"];
		$fields["RED_CASE"] 			= 		$res["redCase"];
		$fields["RED_YY"] 				= 		$res["redYy"];
		
		if($res['systemType'] == 'Civil'){
			$SEND_TO = 1;
		}else if($res['systemType'] == 'Bankrupt'){
			$SEND_TO = 2;
		}else if($res['systemType'] == 'Revive'){
			$SEND_TO = 3;
		}else if($res['systemType'] == 'Mediate'){
			$SEND_TO = 4;
		}
		
		$fields["SEND_TO"] 				= 		$SEND_TO;
		
		$fields["CASE_TYPE"] 			= 		$res["cmdStaff"];
		$fields["SEND_STATUS"] 			= 		1;
		$fields["CMD_NOTE"] 			= 		$res["cmdDetail"][0]["cmdNote"];
		
		$fields["APPROVE_STATUS"] 		= 		1;
		$fields["PLAINTIFF"] 			= 		$res["plaintiff"];
		$fields["DEFENDANT"] 			= 		$res["defendant"];
		$fields["CMD_READ_STATUS"] 		= 		0;
		$fields["CMD_DETAIL"] 			= 		$res["cmdDetail"]["cmdNote"];
		$fields["CMD_SYSTEM"] 			= 		$res["from"];	
		$fields["SYS_NAME"] 			= 		$res["from"];
		$fields["CMD_TYPE"] 			= 		$res["cmdType"];
		
		$sqlSelectCourt 		= "select COURT_CODE from M_COURT where COURT_NAME = '".$res["toCourtName"]."'";
		$querySelectCourt 		= db::query($sqlSelectCourt);
		$recSelectCourt 	 	= db::fetch_array($querySelectCourt);
		
		if($fields["SEND_TO"]==1){
			$sqlSelectCase = "	select 	DEFFENDANT1,PLAINTIFF1
								from 	WH_CIVIL_CASE 
								where 	PREFIX_BLACK_CASE = '".$res["toTBlackCase"]."'
										AND BLACK_CASE = '".$res["toBlackCase"]."'
										AND BLACK_YY = '".$res["toBlackYy"]."'
										AND PREFIX_RED_CASE = '".$res["toTRedCase"]."'
										AND RED_CASE = '".$res["toRedCase"]."'
										AND RED_YY = '".$res["toRedYy"]."'
										AND COURT_CODE = '".$recSelectCourt["COURT_CODE"]."'";
			$querySelectCase = db::query($sqlSelectCase);
			$recSelectCase 	 = db::fetch_array($querySelectCase);
		}else if($fields["SEND_TO"]==2){
			$sqlSelectCase = "	select 	DEFFENDANT1,PLAINTIFF1
								from 	WH_BANKRUPT_CASE_DETAIL 
								where 	PREFIX_BLACK_CASE = '".$res["toTBlackCase"]."'
										AND BLACK_CASE = '".$res["toBlackCase"]."'
										AND BLACK_YY = '".$res["toBlackYy"]."'
										AND PREFIX_RED_CASE = '".$res["toTRedCase"]."'
										AND RED_CASE = '".$res["toRedCase"]."'
										AND RED_YY = '".$res["toRedYy"]."'
										AND COURT_CODE = '".$recSelectCourt["COURT_CODE"]."'";
			$querySelectCase = db::query($sqlSelectCase);
			$recSelectCase 	 = db::fetch_array($querySelectCase);
		}else if($fields["SEND_TO"]==3){
			$sqlSelectCase = "	select 	DEFFENDANT1,PLAINTIFF2 as PLAINTIFF1
								from 	WH_REHABILITATION_CASE_DETAIL 
								where 	PREFIX_BLACK_CASE = '".$res["toTBlackCase"]."'
										AND BLACK_CASE = '".$res["toBlackCase"]."'
										AND BLACK_YY = '".$res["toBlackYy"]."'
										AND PREFIX_RED_CASE = '".$res["toTRedCase"]."'
										AND RED_CASE = '".$res["toRedCase"]."'
										AND RED_YY = '".$res["toRedYy"]."'
										AND COURT_CODE = '".$recSelectCourt["COURT_CODE"]."'";
			$querySelectCase = db::query($sqlSelectCase);
			$recSelectCase 	 = db::fetch_array($querySelectCase);
		}else if($fields["SEND_TO"]==4){
			$sqlSelectCase = "	select 	DEFENDANT_FNAME as DEFFENDANT1,PLAINTIFF_FNAME as PLAINTIFF1
								from 	WH_MEDIATE_CASE 
								where 	PREFIX_BLACK_CASE = '".$res["toPrefixBlackCase"]."'
										AND BLACK_CASE = '".$res["toBlackCase"]."'
										AND BLACK_YY = '".$res["toBlackYy"]."'
										AND PREFIX_RED_CASE = '".$res["toPrefixRedCase"]."'
										AND RED_CASE = '".$res["toRedCase"]."'
										AND RED_YY = '".$res["toRedYy"]."'
										AND COURT_ID = '".$recSelectCourt["COURT_CODE"]."'";
			$querySelectCase = db::query($sqlSelectCase);
			$recSelectCase 	 = db::fetch_array($querySelectCase);
		}
		
		$fields["TO_T_BLACK_CASE"] 		= 		$res["toPrefixBlackCase"];
		$fields["TO_BLACK_CASE"]		= 		$res["toBlackCase"];
		$fields["TO_BLACK_YY"] 			= 		$res["toBlackYy"];
		$fields["TO_T_RED_CASE"] 		= 		$res["toPrefixRedCase"];
		$fields["TO_RED_CASE"] 			= 		$res["toRedCase"];
		$fields["TO_RED_YY"] 			= 		$res["toRedYy"];
		
		$fields["TO_COURT_CODE"] 		= 		$recSelectCourt["COURT_CODE"];
		$fields["TO_COURT_NAME"] 		= 		$res["toCourtName"];

		$fields["TO_PLAINTIFF"] 		= 		$recSelectCase["PLAINTIFF1"];
		$fields["TO_DEFENDANT"] 		= 		$recSelectCase["DEFFENDANT1"];
		
		$fields["TO_PERSON_ID"] 		= 		"1103411005612";//$res["sendToPerson"];//*//
		
	$CMD_ID = db::db_insert("M_DOC_CMD",$fields,'ID','ID');
		
	//รายละเอียดคำสั่ง
	unset($fields);
		$fields["CMD_ID"] 	= 	$CMD_ID;
		$fields["CMD_NOTE"] =	$res["cmdDetail"][0]["cmdNote"];
	db::db_insert("M_CMD_DETAILS",$fields,'CMD_DETAIL_ID','CMD_DETAIL_ID');

	//คนในคำสั่ง
	unset($fields);
		$fields["CMD_ID"] 				= 	$CMD_ID;
		$fields["ID_CARD"] 				= 	$res["registerCode"];
		$fields["FIRST_NAME"] 			= 	$res["firstName"];
		$fields["FULL_NAME"] 			= 	$res["firstName"];
	db::db_insert("M_CMD_PERSON",$fields,'PERSON_ID','PERSON_ID');
	
	
	//บันทึกคนที่ตรวจพบของระบบล้มละลาย
	if($fields["SEND_TO"]==2){
		
		unset($chk);
			$chk['userName'] 		= 'BankruptDt';
			$chk['passWord'] 		= 'Debtor4321';
			
			$chk['prefixBlackCase'] = $res['toPrefixBlackCase'];
			$chk['blackCase'] 		= $res['toBlackCase'];
			$chk['blackYY'] 		= $res['toBlackYy'];
			$chk['prefixRedCase'] 	= $res['toPrefixRedCase'];
			$chk['redCase'] 		= $res['toRedCase'];
			$chk['redYY'] 			= $res['toRedYy'];
			$chk['courtName'] 		= $res['toCourtName'];
			
		$data_string = json_encode($chk);
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
				CURLOPT_URL => 'http://103.40.146.180/api/public/CheckCase',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS =>$data_string,
				CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json'
				),
			)
		);
		
		$response = curl_exec($curl);
		$res_case = json_decode($response, true);
		
		$case_data = $res_case['data']['Data'];
		foreach ($case_data as $key => $value) {
			$all_plaintiff = $value['plaintiff'];
			$all_defendant = $value['deffendant'];
			$bankruptCode = $value['bankruptCode'];
		}
		
		getBankruptToWh($bankruptCode);
		
		$sql = db::query("SELECT
			c.REGISTER_CODE AS SUPP_NUM,
			a.BANKRUPT_CODE AS WFR_ID,
			'' AS PERSON_TYPE
		FROM
			WH_BANKRUPT_CASE_DETAIL a
		LEFT JOIN WH_BANKRUPT_CASE_PERSON c ON a.WH_BANKRUPT_ID = c.WH_BANKRUPT_ID
		WHERE
			1 = 1
		AND a.BANKRUPT_CODE = '".$bankruptCode."' AND c.REGISTER_CODE IS NOT NULL");
		while($rec_main = db::fetch_array($sql)){
	
			$form_field['userName'] = 'BankruptDt';
			$form_field['passWord'] = 'Debtor4321';
			$form_field['registerCode'] = str_replace("-","",$rec_main['SUPP_NUM']);
			$data_string = json_encode($form_field);
			$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => 'http://103.208.27.224:81/led_service_api/service/verifyPerson.php',
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => '',
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 0,
				  CURLOPT_FOLLOWLOCATION => true,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => 'POST',
				  CURLOPT_POSTFIELDS =>$data_string,
				  CURLOPT_HTTPHEADER => array(
					'Content-Type: application/json'
				  ),
				)
				);

			$response = curl_exec($curl);
			$data = json_decode($response, true);
			curl_close($curl);
			if($data['ResponseCode']['ResCode'] == '000'){
			$data2 = $data['Data'];
				foreach($data2 as $k => $v){

					$redCase = $v['prefixRedCase'].$v['redCase']."/".$v['redYy'];
					$blackCase = $v['prefixBlackCase'].$v['blackCase']."/".$v['blackYy'];

					if($fullBlackCase != $blackCase){
						$id = $v['registerCode'];
							$newid = "";
							for($z=0;$z<=12;$z++){

								if($z == '0' || $z=='4'|| $z=='9'|| $z=='11'){
									$newid .= substr($id,$z,'1')."-";
								}else{
									$newid .= substr($id,$z,'1');
								}
							}

					if($v['systemType'] == 'Civil'){

						if($v['provName'] != "กรุงเทพมหานคร"){ $v['provName'] = " ".$v['provName'] ; }

							// INSER DB
								$sql = "SELECT PERSONAL_ID FROM M_PERSONAL_INFO_CASE WHERE REGISTERCODE = '".$newid."'
								AND COURT_NAME = '".$v['courtName']."' AND NO_BLACK_CASE = '".$v["blackCase"]."' AND BLACK_YEAR = '".$v["blackYy"]."'
								AND NO_RED_CASE = '".$v["redCase"]."' AND RED_YEAR = '".$v["redYy"]."' AND PERSON_TYPE_RE = '".$rec_main["PERSON_TYPE"]."'
								AND SYSTEM_TYPE_TYPE = '".$v["systemType"]."' AND BRC_ID = '".$bankruptCode."'
								";
								$qryinfo1 = db::query($sql);
								$rec = db::fetch_array($qryinfo1);
								$num = db::num_rows($qryinfo1);
								if( $num <= 0 ){
										unset($data_invat);
										$data_invat["REGISTERCODE"] = $newid;
										$data_invat["WFR_ID"] = $rec_main['WFR_ID'];
										$data_invat["F_NAME"] = $v["fullName"];
										$data_invat["CONERNNAME"] = $v["concernName"];
										$data_invat["ADDRESS"] = $v["address"];
										$data_invat["AMPNAME"] = $v["ampName"];
										$data_invat["TUMNAME"] = $v["tumName"];
										$data_invat["PROVNAME"] = $v["provName"];
										$data_invat["ZIPCODE"] = $v["zipCode"];
										$data_invat["T_NO_BLACK"] = $v["prefixBlackCase"];
										$data_invat["NO_BLACK_CASE"] = $v["blackCase"];
										$data_invat["BLACK_YEAR"] = $v["blackYy"];
										$data_invat["T_NO_RED"] = $v["prefixRedCase"];
										$data_invat["NO_RED_CASE"] = $v["redCase"];
										$data_invat["RED_YEAR"] = $v["redYy"];
										$data_invat["SYSTEM_TYPE"] = $v["systemType"];
										$data_invat["COURT_NAME"] = $v["courtName"];
										$data_invat["PERSON_TYPE_RE"] = $rec_main["PERSON_TYPE"];
										$data_invat["TITLE_NAME"] = $v["preFixName"];
										$data_invat["ORDER_STATUS"] = $v["orderStatus"];
										$data_invat["BRC_ID"] = $bankruptCode;

										db::db_insert($table , $data_invat, "PERSONAL_ID");

							// UPDATE DB
								}else{
									if(strstr($rec['CONERNNAME'],$v['concernName']) === false){
										unset($data_invat);
										$data_invat["CONERNNAME"] = $rec['CONERNNAME']."/".$v["concernName"];
										$data_invat["ORDER_STATUS"] = $v["orderStatus"];
										$data_update["PERSONAL_ID"] = $rec["PERSONAL_ID"];
										db::db_update($table , $data_invat, $data_update);
									}
								}
					}else if($v['systemType'] == 'Mediate'){
					// echo "CASE 2                 ";
						if($v['provName'] != "กรุงเทพมหานคร"){ $v['provName'] = " ".$v['provName'] ; }

						// INSER DB
								$sql2 = "SELECT PERSONAL_ID FROM M_PERSONAL_INFO_CASE WHERE REGISTERCODE = '".$newid."'
								AND COURT_NAME = '".$v['courtName']."' AND NO_BLACK_CASE = '".$v["blackCase"]."' AND BLACK_YEAR = '".$v["blackYy"]."'
								AND NO_RED_CASE = '".$v["redCase"]."' AND RED_YEAR = '".$v["redYy"]."' AND PERSON_TYPE_RE = '".$rec_main["PERSON_TYPE"]."'
								AND SYSTEM_TYPE_TYPE = '".$v["systemType"]."' AND BRC_ID = '".$bankruptCode."'
								";
								$qryinfo2 = db::query($sql2);
								$rec = db::fetch_array($qryinfo2);
								$num = db::num_rows($qryinfo2);
								if( $num <= 0 ){
						// INSER DB
										unset($data_invat);
										$data_invat["REGISTERCODE"] = $newid;
										$data_invat["WFR_ID"] = $rec_main['WFR_ID'];
										$data_invat["F_NAME"] = $v["fullName"];
										$data_invat["CONERNNAME"] = $v["concernName"];
										$data_invat["ADDRESS"] = $v["address"];
										$data_invat["AMPNAME"] = $v["ampName"];
										$data_invat["TUMNAME"] = $v["tumName"];
										$data_invat["PROVNAME"] = $v["provName"];
										$data_invat["ZIPCODE"] = $v["zipCode"];
										$data_invat["T_NO_BLACK"] = $v["prefixBlackCase"];
										$data_invat["NO_BLACK_CASE"] = $v["blackCase"];
										$data_invat["BLACK_YEAR"] = $v["blackYy"];
										$data_invat["T_NO_RED"] = $v["prefixRedCase"];
										$data_invat["NO_RED_CASE"] = $v["redCase"];
										$data_invat["RED_YEAR"] = $v["redYy"];
										$data_invat["SYSTEM_TYPE"] = $v["systemType"];
										$data_invat["COURT_NAME"] = $v["courtName"];
										$data_invat["PERSON_TYPE_RE"] = $rec_main["PERSON_TYPE"];
										$data_invat["TITLE_NAME"] = $v["preFixName"];
										$data_invat["ORDER_STATUS"] = $v["orderStatus"];
										$data_invat["BRC_ID"] = $bankruptCode;

										db::db_insert($table , $data_invat, "PERSONAL_ID");

								}
					}else if($v['systemType'] == 'Revive'){
						if($v['provName'] != "กรุงเทพมหานคร"){ $v['provName'] = " ".$v['provName'] ; }

						// INSER DB
								$sql3 = "SELECT PERSONAL_ID FROM M_PERSONAL_INFO_CASE WHERE REGISTERCODE = '".$newid."'
								AND COURT_NAME = '".$v['courtName']."' AND NO_BLACK_CASE = '".$v["blackCase"]."' AND BLACK_YEAR = '".$v["blackYy"]."'
								AND NO_RED_CASE = '".$v["redCase"]."' AND RED_YEAR = '".$v["redYy"]."' AND PERSON_TYPE_RE = '".$rec_main["PERSON_TYPE"]."'
								AND SYSTEM_TYPE_TYPE = '".$v["systemType"]."' AND BRC_ID = '".$bankruptCode."'
								";
								$qryinfo3 = db::query($sql3);
								$rec = db::fetch_array($qryinfo3);
								$num = db::num_rows($qryinfo3);
								if( $num <= 0 ){
						// INSER DB
										unset($data_invat);
										$data_invat["REGISTERCODE"] = $newid;
										$data_invat["WFR_ID"] = $rec_main['WFR_ID'];
										$data_invat["F_NAME"] = $v["fullName"];
										$data_invat["CONERNNAME"] = $v["concernName"];
										$data_invat["ADDRESS"] = $v["address"];
										$data_invat["AMPNAME"] = $v["ampName"];
										$data_invat["TUMNAME"] = $v["tumName"];
										$data_invat["PROVNAME"] = $v["provName"];
										$data_invat["ZIPCODE"] = $v["zipCode"];
										$data_invat["T_NO_BLACK"] = $v["prefixBlackCase"];
										$data_invat["NO_BLACK_CASE"] = $v["blackCase"];
										$data_invat["BLACK_YEAR"] = $v["blackYy"];
										$data_invat["T_NO_RED"] = $v["prefixRedCase"];
										$data_invat["NO_RED_CASE"] = $v["redCase"];
										$data_invat["RED_YEAR"] = $v["redYy"];
										$data_invat["SYSTEM_TYPE"] = $v["systemType"];
										$data_invat["COURT_NAME"] = $v["courtName"];
										$data_invat["PERSON_TYPE_RE"] = $rec_main["PERSON_TYPE"];
										$data_invat["TITLE_NAME"] = $v["preFixName"];
										$data_invat["ORDER_STATUS"] = $v["orderStatus"];
										$data_invat["BRC_ID"] = $bankruptCode;

										$personal_Id = db::db_insert($table , $data_invat, "PERSONAL_ID", "PERSONAL_ID");

								}else{
									$personal_Id = $rec["PERSONAL_ID"];
								}

								
						}else if($v['systemType'] == 'Bankrupt'){
							if($v['provName'] != "กรุงเทพมหานคร"){ $v['provName'] = " ".$v['provName'] ; }
							//เช็คไม่ให้แสดงตัวเอง
							if(!empty($v['personStatus']) && $v['concernName'] == "ผู้มีส่วนได้เสีย"){
								$personStatus = "(".$v['personStatus'].")";
							}
							
							// INSER DB
									$sql3 = "SELECT PERSONAL_ID FROM M_PERSONAL_INFO_CASE WHERE REGISTERCODE = '".$newid."'
									AND COURT_NAME = '".$v['courtName']."' AND NO_BLACK_CASE = '".$v["blackCase"]."' AND BLACK_YEAR = '".$v["blackYy"]."'
									AND NO_RED_CASE = '".$v["redCase"]."' AND RED_YEAR = '".$v["redYy"]."' AND PERSON_TYPE_RE = '".$rec_main["PERSON_TYPE"]."'
									AND SYSTEM_TYPE_TYPE = '".$v["systemType"]."' AND BRC_ID = '".$bankruptCode."'
									";
									$qryinfo3 = db::query($sql3);
									$rec = db::fetch_array($qryinfo3);
									$num = db::num_rows($qryinfo3);
									if( $num <= 0 ){
							// INSER DB
											unset($data_invat);
											$data_invat["REGISTERCODE"] = $newid;
											$data_invat["WFR_ID"] = $rec_main['WFR_ID'];
											$data_invat["F_NAME"] = $v["fullName"];
											$data_invat["CONERNNAME"] = $v["concernName"];
											$data_invat["ADDRESS"] = $v["address"];
											$data_invat["AMPNAME"] = $v["ampName"];
											$data_invat["TUMNAME"] = $v["tumName"];
											$data_invat["PROVNAME"] = $v["provName"];
											$data_invat["ZIPCODE"] = $v["zipCode"];
											$data_invat["T_NO_BLACK"] = $v["prefixBlackCase"];
											$data_invat["NO_BLACK_CASE"] = $v["blackCase"];
											$data_invat["BLACK_YEAR"] = $v["blackYy"];
											$data_invat["T_NO_RED"] = $v["prefixRedCase"];
											$data_invat["NO_RED_CASE"] = $v["redCase"];
											$data_invat["RED_YEAR"] = $v["redYy"];
											$data_invat["SYSTEM_TYPE"] = $v["systemType"];
											$data_invat["COURT_NAME"] = $v["courtName"];
											$data_invat["PERSON_TYPE_RE"] = $rec_main["PERSON_TYPE"];
											$data_invat["TITLE_NAME"] = $v["preFixName"];
											$data_invat["ORDER_STATUS"] = $v["orderStatus"];
											$data_invat["BRC_ID"] = $bankruptCode;

											$personal_Id = db::db_insert($table , $data_invat, "PERSONAL_ID", "PERSONAL_ID");

									}else{
										if(strstr($rec['CONERNNAME'],$v['concernName']) === false){
											unset($data_invat);
											$data_invat["CONERNNAME"] = $rec['CONERNNAME']."/".$v["concernName"];
											$data_update["PERSONAL_ID"] = $rec["PERSONAL_ID"];
											$personal_Id = $rec["PERSONAL_ID"];
											db::db_update($table , $data_invat, $data_update);
										}
									}
							}

					}
				}
			}
		}
		
		
		
	}


}

$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");
$row['Data'] = $resp['Data'];

echo json_encode($row);
 
?>
