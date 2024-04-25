<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$res = json_decode($str_json, true);
// if($res['userName'] == 'BankruptDt' && $res['passWord'] == 'Debtor4321'){
    $array_person = '';
	$datacivil = '';
	$datacase = '';
	$brcId = $res['brcId'];
	$i = 0;
    $array = array(
         '01'
     

    );
    foreach($array as $val ){
		$i++;
        $data_ck['userName']        = $res['userName'];
        $data_ck['passWord']        = $res['passWord'];
        $data_ck['assetTypeCode']  = $val;
        $data_ck['cfcCaption']      = $res['cfcCaption'];

        $data_string = json_encode($data_ck);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://103.40.146.73/ledtest.php/getAsset',
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
        $response_person = curl_exec($curl);
        $result = json_decode($response_person, true);
		
		if($result['ResponseCode']['ResCode'] == '000' ){

			$data['assetTypeCode']  =  $val;
			
			// foreach($result['Data'] as $_k => $_v){
				// print_pre($_v['pccCivilGen']);
				foreach($result['Data'] as $k => $v){
			
					if($val == '01' ){

						$data['assetLandBean']['assetTypeDetailCode']   =  $v['landType'];
						$data['assetLandBean']['regNumber']             =  $v['landNo'];
						$data['assetLandBean']['landAdditional']        =  $v['propDet'];
						// $data['assetLandBean']['a']        =  $v['pccCivilGen'];
						$datacivil =  $v['pccCivilGen'];
						//locCode > check Map > ส่ง code ล้มละลายlocCode > check Map > ส่ง code ล้มละลาย
						// $data['assetLandBean']['provinceCode']        =  $v['']; 
						// $data['assetLandBean']['districtCode']        =  $v[''];
						// $data['assetLandBean']['subDistrictCode']     =  $v[''];

						// print_pre($data);
					} 
					else if($val == '02' ){

						 $data['assetBuildingBean']['assetTypeDetailCode']        =  $v['houseType'];
						 $data['assetBuildingBean']['buildingRegNumber']          =  $v['addrNo'];
						 $data['assetBuildingBean']['buildingNumFloor']           =  $v['floor'];
						 $data['assetBuildingBean']['buidingCondition']           =  $v['houseDesc'];
						//locCode > check Map > ส่ง code ล้มละลายlocCode > check Map > ส่ง code ล้มละลาย
						// $data['landProvinceCode']   =  $v[''];
						// $data['landDistrictCode']   =  $v[''];
						// $data['landSubDistrictCode']   =  $v[''];
						$data['assetBuildingBean']['remark']                     =  $v['houseComment'];

					} 
					else if($val == '03' ){

						$data['assetRoomBean']['roomNumber']         =  $v['addrNo'];
						$data['assetRoomBean']['floor']              =  $v['floor'];
						$data['assetRoomBean']['buildingRegNumber']  =  $v['licenseNo'];
						$data['assetRoomBean']['buildingNumber']     =  $v['buildingNo'];

					} 
					else if($val == '04' ){

						$data['assetMachineBean']['name']         =  $v['machineName'];
						$data['assetMachineBean']['regNumber']    =  $v['licenseNo'];
						$data['assetMachineBean']['remark']       =  $v['propDet'];
						
					} 
					else if($val == '05' ){

						if($v[''] == '032'){ //รถยนต์

							$data['assetVehicleBean']['registerNumber']     =  $v['plateNo1'];

						}
						if($v[''] == '035'){ //เรือ

							$data['assetVehicleBean']['registerNumber']     =  $v['plateNo1'];

						}

						$data['assetVehicleBean']['province']       =  $v['prvName']; //Array CentLoc >>> prvName
						$data['assetVehicleBean']['type']           =  $v['vehicleType'];


					
					} 
					else if($val == '06' ){

					
						$data['assetBondBean']['name']               =  $v['bondsName']; 
						$data['assetBondBean']['regNumber']          =  $v['bondsId'];
						$data['assetBondBean']['nbr']                =  $v['bondsNo'];
						$data['assetBondBean']['nbrExt']             =  $v['bondsNoTo'];
						$data['assetBondBean']['expireDate']         =  $v['receiveDate2'];
						$data['assetBondBean']['amount']             =  $v['receiveAmount'];
						$data['assetBondBean']['perUnit']            =  $v['unitAmount'];
						$data['assetBondBean']['issuerName']         =  $v['bondsPersonName'];
						$data['assetBondBean']['issuerAddr']         =  $v['bondsPersonAddr'];
						$data['assetBondBean']['provinceCode']       =  $v['provCode'];
						$data['assetBondBean']['districtCode']       =  $v['ampCode'];
						$data['assetBondBean']['subDistrictCode']    =  $v['tumCode'];
						$data['assetBondBean']['postCode']           =  $v['postCode'];
						
					}
					else if($val == '07' ){

						$data['assetLotteryBean']['bankCode ']          =  $v['saveOrgName '];  //>>> เอา gen check v
						$data['assetLotteryBean']['name']               =  $v['saveName'];
						$data['assetLotteryBean']['bankBranchName']     =  $v['saveOffice'];
						$data['assetLotteryBean']['provinceCode']       =  $v['provCode'];
						$data['assetLotteryBean']['districtCode']       =  $v['ampCode'];
						$data['assetLotteryBean']['subDistrictCode']    =  $v['tumCode'];
						$data['assetLotteryBean']['postCode']           =  $v['postCode'];
						$data['assetLotteryBean']['regNumber']          =  $v['saveBookNo'];
						$data['assetLotteryBean']['nbr']                =  $v['saveNoFr'];
						$data['assetLotteryBean']['nbrExt']             =  $v['saveNoTo'];
						$data['assetLotteryBean']['expireDate']         =  $v['saveEndDate'];
						$data['assetLotteryBean']['amount']             =  $v['saveUnit'];
						$data['assetLotteryBean']['perUnit']            =  $v['saveUnitPri'];
					

						
					}
					else if($val == '08' ){

						$data['assetGunBean']['no']         =  $v['gunNo'];
						$data['assetGunBean']['registNo']   =  $v['gunSign'];
						$data['assetGunBean']['type']       =  $v['typeDesc'];
						$data['assetGunBean']['kind']       =  $v['gunSize'];
						$data['assetGunBean']['state']      =  $v['propDet'];
						
					}
					else if($val == '09' ){

						$data['assetShareBean']['stockType']          =  $v['stockType'];
						$data['assetShareBean']['shareCategory']      =  $v['stockName'];
						$data['assetShareBean']['stockCer']           =  $v['stockNo'];
						$data['assetShareBean']['ownerRegNo']         =  $v['holderLicenseNo'];
						$data['assetShareBean']['stockNo']            =  $v['stockIdFrom'];
						$data['assetShareBean']['toTxt']              =  $v['stockIdTo'];
						$data['assetShareBean']['amount']             =  $v['unitAmount'];
						$data['assetShareBean']['provinceCode']       =  $v['provCode'];
						$data['assetShareBean']['districtCode']       =  $v['ampCode'];
						$data['assetShareBean']['subDistrictCode']    =  $v['tumCode'];
						$data['assetShareBean']['postCode']           =  $v['postCode'];
						$data['assetShareBean']['remark']             =  $v['propDet'];
						
					}
					else if($val == '11' ){

						if($v['assetTypeDetailCode'] == '44'){ //01 ที่ดิน 02 ห้องชุด >> 44

							$data['assetRentRightBean']['lessorName ']     =  $v['villageName1 '];
						}
						if($v['assetTypeDetailCode'] == '65'){ //03 พื้นที่ในอาคาร  04 แผงลอย >> 65

							$data['assetRentRightBean']['lessorName ']  =  $v['buildingName '];

						}

						$data['assetRentRightBean']['contractDate']        =  $v['contactDate']; //Array CentLoc >>> prvName
						$data['assetRentRightBean']['rentalDetail']        =  $v['propDet'];
						
					}
					else if($val == '15' ){

						$data['assetOtherBean']['name']               =  $v['capName'];
						$data['assetOtherBean']['currency']           =  $v['unitAmount'];
						$data['assetOtherBean']['unitName']           =  $v['unit'];
						$data['assetOtherBean']['addressNo']          =  $v['addrNo'];
						$data['assetOtherBean']['provinceCode']       =  $v['provCode'];
						$data['assetOtherBean']['districtCode']       =  $v['ampCode'];
						$data['assetOtherBean']['subDistrictCode']    =  $v['tumCode'];
						$data['assetOtherBean']['postCode']           =  $v['postCode'];

					}
					unset($array_person);
					$array_person = $data;
					$array_person['assetPartyDocument'] = array();
					
						$sql = db::query("SELECT * FROM WH_CIVIL_CASE A 
						LEFT JOIN WH_CIVIL_CASE_ASSETS B ON A.WH_CIVIL_ID = B.WH_CIVIL_ID
						WHERE A.CIVIL_CODE = '".$datacivil ."'");
							$query  = db::fetch_array($sql);
						$datacase = array();
						$datacase['systemType']      =  '1';
						$datacase['blackCaseCode']   =  $query['PREFIX_BLACK_CASE'].$query['BLACK_CASE']."/".$query['BLACK_YY'];
						$datacase['redCaseCode']     =  $query['PREFIX_RED_CASE'].$query['RED_CASE']."/".$query['RED_YY'];
						$datacase['courtName']       =  $query['COURT_NAME'];
						$datacase['propTitle']       =  $query['PROP_TITLE'];
						$datacase['propStatusCode']  =  $query['PROP_STATUS'];
						$datacase['propStatusName']  =  $query['PROP_STATUS_NAME'];
						$datacase['dossId']          =  $query['DOSS_ID'];
						$datacase['assetId']         =  $query['ASSET_ID'];

						$datacase = json_encode($datacase);
						$sql_holing = "SELECT DISTINCT cmg.CONCERN_NAME AS concernName,
						ccp.*,
						c.HOLDING_AMOUNT as holdingAmount,c.HOLDING_TYPE as holdingType 
						FROM WH_CIVIL_CASE_MAP_GEN cmg 
						LEFT JOIN ".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')." ccp ON cmg.WH_PERSON_ID = ccp.WH_PERSON_ID 
						LEFT JOIN WH_CIVIL_CASE_ASSET_OWNER c ON c.WH_MAP_CASE_GEN_ID = cmg.WH_MAP_CASE_GEN_ID 
						WHERE cmg.CONCERN_CODE NOT IN (01,02) AND cmg.WH_CIVIL_ID =  '" . $query['WH_CIVIL_ID'] . "'";
						$holingdata2 = db::query($sql_holing);
				 
						 $i = 1;
						while ( $data2 = db::fetch_array($holingdata2))
						{
							$dataperson = array();
							$dataperson['assetPartyTypeCode']       =  '';
							$dataperson['sequenceTxt']              =  '';
							$dataperson['nameInLandDocumentTxt']    =  '';
							$dataperson['retioTypeSel']             =  '';
							$dataperson['retioTotalTxt']            =  '';
							$dataperson['retioPartTxt']             =  '';
							$dataperson['retioAreaTxt']             =  $data2['HOLDINGTYPE'];
						
							$dataperson['partyBean']['partyCategory']    =  $data2['PERSON_TYPE'];
							$dataperson['partyBean']['nationality']      =  $data2['NATIONALITY'];
							$dataperson['partyBean']['idCard']           =  $data2['REGISTER_CODE'];
							$dataperson['partyBean']['titleCode']        =  $data2['PREFIX_CODE'];
							$dataperson['partyBean']['firstName']        =  $data2['FIRST_NAME'];
							$dataperson['partyBean']['lastName']         =  $data2['LAST_NAME'];
							$dataperson['partyBean']['gender']           =  $data2['SEX'];
							$i++;

							$sqladdr = db::query("SELECT * FROM WH_CIVIL_CASE_PERSON_ADDR WHERE WH_PERSON_ID = '" . $data2['WH_CIVIL_ID'] . "'  ");
							while($dataaddr = db::fetch_array($sqladdr))
							{

								$dataperson['partyBean']['addressCurrent']['addressNo']          =  $dataaddr['ADDRESS'];
								$dataperson['partyBean']['addressCurrent']['provinceCode']       =  $dataaddr['PROV_CODE'];
								$dataperson['partyBean']['addressCurrent']['districtCode']       =  $dataaddr['AMP_CODE'];
								$dataperson['partyBean']['addressCurrent']['subDistrictCode']    =  $dataaddr['TUM_CODE'];
								$dataperson['partyBean']['addressCurrent']['zipcode']            =  $dataaddr['ZIP_CODE'];
						

							}
							
							array_push($array_person['assetPartyDocument'], $dataperson);
						} 
						$array_person = json_encode($array_person);
						$dataAsset = "brcaseId=".$brcId."&proxyAssetBeanJson=".$datacase."&assetDocumentBeanJson=".$array_person;

												
						$curl = curl_init();

						curl_setopt_array($curl, array(
						  CURLOPT_URL => 'http://bruat.led.go.th/ledbrlive2/api/asset/create.action',
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => '',
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 0,
						  CURLOPT_FOLLOWLOCATION => true,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => 'POST',
						  CURLOPT_POSTFIELDS => $dataAsset,
						  CURLOPT_HTTPHEADER => array(
							'Content-Type: application/x-www-form-urlencoded'
						  ),
						));

						$response = curl_exec($curl);
						$err = curl_error($curl);

						curl_close($curl);
							
					
				}	
						
			// }
			
		}
    
    }
	
	$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");
	echo $dataAsset; 