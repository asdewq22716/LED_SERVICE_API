<?php
	declare(strict_types=1);
	
	namespace App\Application\Actions\HrApi;
	
	use App\Application\Actions\Action;
	use Psr\Http\Message\ResponseInterface as Response;
	use Psr\Http\Message\StreamInterface;
	use Psr\Http\Message\ServerRequestInterface as Request;
	use Psr\Http\Server\MiddlewareInterface;
	use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
	
	class EmployeeAction extends Action
	{
		/**
			* {@inheritdoc}
		*/	 
		
		protected function action(): Response
		{        
			
			include('../../include/connect_db.php');
			include('../../function/config_db.php');
			include('../../function/function_for_api.php');
			// include('../../function/function_custom.php');
			
			$request = $this->getFormData();
			
			$filter = "";
			if($request->EmployeeIdentification!=''){
				$filter = " AND a.PER_ID = '".$request->EmployeeIdentification."' ";
			}
			
			$sql = "SELECT 
			dbo.GetPositionTextShortNonLevel(a.PER_ID) AS POS_SHORT, 
			dbo.GetPositionTextNonLevel(a.PER_ID) AS POS_FULL, 
			a.*, b.NATION_NAME_TH, 
			c.RELIGION_NAME_TH, 
			d.LINE_NAME_TH, 
			e.ORG_NAME_TH, 
			f.FAMILY_PREFIX_ID AS F_PREFIX_ID, 
			pf.PREFIX_NAME_TH AS F_PREFIX_NAME_TH, 
			f.FAMILY_FIRSTNAME_TH AS F_FNAME_TH, 
			f.FAMILY_MIDNAME_TH AS F_MNAME_TH, 
			f.FAMILY_LASTNAME_TH AS F_LNAME_TH, 
			f.FAMILY_JOB_ID AS F_JOB_ID, 
			CASE 
			WHEN f.FAMILY_JOB_ID = '6' THEN 
			f.FAMILY_JOB_OTHER 
			ELSE 
			jf.JOB_NAME_TH 
			END AS FATHER_JOB, 
			f.FAMILY_STATUS AS F_STATUS, 
			f.DIED_SDATE AS F_DIED_DATE, 
			f.FAMILY_BIRTHDATE AS F_BIRTHDATE, 
			f.FAMILY_IDCARD AS F_IDCARD, 
			m.FAMILY_PREFIX_ID AS M_PREFIX_ID, 
			pm.PREFIX_NAME_TH AS M_PREFIX_NAME_TH, 
			m.FAMILY_FIRSTNAME_TH AS M_FNAME_TH, 
			m.FAMILY_MIDNAME_TH AS M_MNAME_TH, 
			m.FAMILY_LASTNAME_TH AS M_LNAME_TH, 
			m.FAMILY_JOB_ID AS M_JOB_ID, 
			CASE 
			WHEN m.FAMILY_JOB_ID = '6' THEN 
			m.FAMILY_JOB_OTHER 
			ELSE 
			jm.JOB_NAME_TH 
			END AS MOTHER_JOB, 
			m.FAMILY_STATUS AS M_STATUS, 
			m.DIED_SDATE AS M_DIED_DATE, 
			m.FAMILY_BIRTHDATE AS M_BIRTHDATE, 
			m.FAMILY_IDCARD AS M_IDCARD, 
			s.FAMILY_PREFIX_ID AS S_PREFIX_ID, 
			ps.PREFIX_NAME_TH AS S_PREFIX_NAME_TH, 
			s.FAMILY_FIRSTNAME_TH AS S_FNAME_TH, 
			s.FAMILY_MIDNAME_TH AS S_MNAME_TH, 
			s.FAMILY_LASTNAME_TH AS S_LNAME_TH, 
			s.FAMILY_JOB_ID AS S_JOB_ID, 
			CASE 
			WHEN s.FAMILY_JOB_ID = '6' THEN 
			s.FAMILY_JOB_OTHER 
			ELSE 
			js.JOB_NAME_TH 
			END AS SPOUSE_JOB, 
			s.FAMILY_STATUS AS S_STATUS, 
			s.DIED_SDATE AS S_DIED_DATE, 
			s.FAMILY_BIRTHDATE AS S_BIRTHDATE, 
			s.FAMILY_IDCARD AS S_IDCARD, 
			s.MARRY_DATE, 
			s.DIVORCE_DATE, 
			s.WORK_PLACE, 
			g.PER_BANK_ACCOUNT, 
			/* tf.TREATY_RIGHTS AS FTR,
			tf.TREATY_RIGHTS_SUB AS FTR_S,
			tf.HOSPITAL_NAME AS FTR_H_NAME,
			tm.TREATY_RIGHTS AS MTR,
			tm.TREATY_RIGHTS_SUB AS MTR_S,
			tm.HOSPITAL_NAME AS MTR_H_NAME,
			ts.TREATY_RIGHTS AS STR,
			ts.TREATY_RIGHTS_SUB AS STR_S,
			ts.HOSPITAL_NAME AS STR_H_NAME,*/
			a.TREATY_RIGHTS AS PTR, 
			org1.ORG_NAME_TH AS ORG_NAME_TH_1, 
			org2.ORG_NAME_TH AS ORG_NAME_TH_2, 
			org3.ORG_NAME_TH AS ORG_NAME_TH_3, 
			org4.ORG_NAME_TH AS ORG_NAME_TH_4, 
			org5.ORG_NAME_TH AS ORG_NAME_TH_5, 
			org6.ORG_NAME_TH AS ORG_NAME_TH_6, 
			posl.LEVEL_NAME_TH 
			FROM 
			PER_PROFILE a 
			LEFT JOIN SETUP_NATION b ON a.NATION_ID = b.NATION_ID 
			LEFT JOIN SETUP_RELIGION c ON a.RELIGION_ID = c.RELIGION_ID 
			LEFT JOIN SETUP_POS_LINE d ON a.LINE_ID = d.LINE_ID 
			LEFT JOIN SETUP_ORG e ON a.ORG_ID_3 = e.ORG_ID 
			LEFT JOIN SETUP_ORG org1 ON a.ORG_ID_1 = org1.ORG_ID 
			LEFT JOIN SETUP_ORG org2 ON a.ORG_ID_2 = org2.ORG_ID 
			LEFT JOIN SETUP_ORG org3 ON a.ORG_ID_3 = org3.ORG_ID 
			LEFT JOIN SETUP_ORG org4 ON a.ORG_ID_4 = org4.ORG_ID 
			LEFT JOIN SETUP_ORG org5 ON a.ORG_ID_5 = org5.ORG_ID 
			LEFT JOIN SETUP_ORG org6 ON a.ORG_ID_6 = org6.ORG_ID 
			LEFT JOIN SETUP_POS_LEVEL posl ON a.LEVEL_ID = posl.LEVEL_ID 
			/*LEFT JOIN WFR_MED_TREAT_RIGHTS af ON af.PER_ID = a.PER_ID AND REG_ACTIVE = '1'*/
			LEFT JOIN PER_FAMILY f ON a.PER_ID = f.PER_ID AND f.FAMILY_RELATIONSHIP = '1' AND f.ACTIVE_STATUS = '1' 
			LEFT JOIN SETUP_JOB jf ON jf.JOB_ID = f.FAMILY_JOB_ID 
			LEFT JOIN SETUP_PREFIX pf ON pf.PREFIX_ID = f.FAMILY_PREFIX_ID 
			LEFT JOIN FAMILY_MED_TREAT_RIGHTS tf ON tf.PER_ID = f.FAMILY_ID 
			LEFT JOIN PER_FAMILY m ON a.PER_ID = m.PER_ID AND m.FAMILY_RELATIONSHIP = '2' AND m.ACTIVE_STATUS = '1' 
			LEFT JOIN SETUP_JOB jm ON jm.JOB_ID = m.FAMILY_JOB_ID 
			LEFT JOIN SETUP_PREFIX pm ON pm.PREFIX_ID = m.FAMILY_PREFIX_ID 
			LEFT JOIN FAMILY_MED_TREAT_RIGHTS tm ON tm.PER_ID = m.FAMILY_ID 
			LEFT JOIN PER_FAMILY s ON a.PER_ID = s.PER_ID AND s.FAMILY_RELATIONSHIP = '3' AND s.FAMILY_STATUS = '1' AND s.ACTIVE_STATUS = '1' AND s.MARRY_TYPE = '0' 
			LEFT JOIN SETUP_JOB js ON js.JOB_ID = s.FAMILY_JOB_ID 
			LEFT JOIN SETUP_PREFIX ps ON ps.PREFIX_ID = s.FAMILY_PREFIX_ID 
			LEFT JOIN PER_BOOKBANK g ON a.PER_ID = g.PER_ID AND g.ACTIVE_STATUS = '1' 
			LEFT JOIN FAMILY_MED_TREAT_RIGHTS ts ON ts.PER_ID = s.FAMILY_ID 
			WHERE 
			1=1 ".$filter."
			ORDER BY a.PER_ID";
			$q = \db::query($sql);
			
			$obj = array();
			$row = array();
			
			$array_Military = array('1' => 'ไม่ต้องรับราชการทหาร', '2' => 'ผ่านเกณฑ์ทหาร' ,'3' => 'ได้รับการยกเว้น');
			$array_Blood = array('1'=>'O','2'=>'A','3'=>'B','4'=>'AB','5'=>'Rh-');
			$array_Marital = array('1'=>'โสด','2'=>'สมรส','3'=>'หย่า','4'=>'หม้าย');
			$date_t = date('Y-m-d');
			
			$title2 = array('1'=>"หน่วยงานราชการ (เบิกตรงต้นสังกัด/กรมบัญชีกลาง)",'2'=>"เบิกหน่วยงานรัฐวิสาหกิจ",'3'=>"หน่วยงานเอกชน",'4'=>"เบิกประกันสังคม");
			$arr_family_name = array('1'=>"บิดา",'2'=>"มารดา",'3'=>"คู่สมรส",'4'=>"บุตร",'6'=>"พนักงาน");
			$per_t =  array('1'=>'รฟม.','2'=>'สิทธิเบิกตรงกรมบัญชีกลาง/ต้นสังกัด','3'=>'สิทธิเบิกประกันสังคม','4'=>'ประกันตนเอง');
			
			$STR_S = "";
			
			while($r = \db::fetch_array($q)){
			
				/* 
				$STR_S = $r['STR_S']; 
				
				if($r['FTR'] == '1'){
					if($r['FTR_S'] != '4'){
						$row['FatherTreat'] = $title2[$r['FTR_S']];
						}else{
						$row['FatherTreat'] = $title2[$r['FTR_S']]." ".$r['FTR_H_NAME'];
					}
					}else if($r['FTR'] == '2'){
					$row['FatherTreat'] = $arr_family_name[$r['FTR_S']];
					
				}
				
				if($r['MTR'] == '1'){
					if($r['MTR_S'] != '4'){
						$row['MotherTreat'] = $title2[$r['MTR_S']];
						}else{
						$row['MotherTreat'] = $title2[$r['MTR_S']]." ".$r['MTR_H_NAME'];
					}
					}else if($r['MTR'] == '2'){
					$row['MotherTreat'] = $arr_family_name[$r['MTR_S']];
					
					}else{
					$row['MotherTreat'] = "";
				}
				
				
				if($r['STR'] == '1'){
					if(is_null($STR_S)){
						if($STR_S != '4'){
							$row['SpouseTreat'] = $title2[$STR_S];
							}else{
							$row['SpouseTreat'] = $title2[$STR_S]." ".$r['STR_H_NAME'];	
						}
						}else{
						$row['SpouseTreat'] = "";	
					}
					
					}else if($r['MTR'] == '2'){
					if(is_null($STR_S)){
						$row['SpouseTreat'] = $arr_family_name[$r['STR_S']];
						}else{
						$row['SpouseTreat'] = $arr_family_name[$STR_S];
					}
					}else{
					$row['SpouseTreat'] = "";	
				}
				
				if($r['PTR']){
					$row['EmployeeTreat'] = $per_t[$r['PTR']];
				}
				
				 */
				
				$row['EmployeeIdentification'] = $r['PER_ID'];
				$row['EmployeeCode'] = $r['PER_CODE'];
				$row['EmployeeType'] = $r['POSTYPE_ID'];
				$row['ThaiPrefixIdentification'] = $r['PREFIX_ID'];
				$row['ThaiGivenName'] = $r['PER_FIRSTNAME_TH'];
				$row['ThaiFamilyName'] = $r['PER_LASTNAME_TH'];
				$row['EngPrefixIdentification'] = $r['PREFIX_ID'];
				$row['EngGivenName'] = $r['PER_FIRSTNAME_EN'];
				$row['EngFamilyName'] = $r['PER_LASTNAME_EN'];
				$row['CitizenIdentification'] = $r['PER_IDCARD'];
				// $row['ExpiryDate'] = $r[''];
				
				// (1=M,2=F)
				// if( $r['PER_GENDER'] == '1'){
				// $GENDER = 0;
				// }else if( $r['PER_GENDER'] == '2'){
				// $GENDER = 1;
				// }
				
				$row['Gender'] = $r['PER_GENDER'];
				$row['Birth'] = $r['PER_DATE_BIRTH'];
				$row['Weight'] = $r['PER_WEIGHT'];
				$row['Height'] = $r['PER_HEIGHT'];
				$row['BloodType'] = $r['PER_BLOOD_TYPE'];
				
				if($r['PER_BLOOD_TYPE']){
					$row['BloodNAME'] = $array_Blood[$r['PER_BLOOD_TYPE']];
					}else{
					$row['BloodNAME'] = null;
				}
				
				
				$row['NationalityIdentification'] = $r['NATION_ID'];
				$row['NationalityName'] = $r['NATION_NAME_TH'];
				$row['Religion'] = $r['RELIGION_ID'];
				$row['ReligionName'] = $r['RELIGION_NAME_TH'];
				$row['TelephoneNumber'] = $r['TEL_PER'];
				$row['MobileNumber'] = $r['TEL_PER_MOBILE'];
				$row['Email'] = $r['PER_EMAIL'];
				$row['BankAccount'] = $r['PER_BANK_ACCOUNT'];
				
				// if( $r['PER_STATUS_MILITARY'] == '1' ){
				// $Military = 2;
				// }else if( $r['PER_STATUS_MILITARY'] == '2' ){
				// $Military = 3;
				// }else if( $r['PER_STATUS_MILITARY'] == '3' ){
				// $Military = 0;
				// }else{
				// $Military = '';
				// }
				
				$row['MilitaryStatus'] = $r['PER_STATUS_MILITARY'];
				
				if($r['PER_STATUS_MILITARY']){
					$row['MilitaryName'] = $array_Military[$r['PER_STATUS_MILITARY']];
					}else{
					$row['MilitaryName'] = null;
				}
				
				$row['MaritalStatus'] = $r['PER_STATUS_MARRY'];
				
				if($r['PER_STATUS_MARRY']){
					$row['MaritalName'] = $array_Marital[$r['PER_STATUS_MARRY']];
					}else{
					$row['MaritalName'] = null;
				}
				
				
				$row['EmploymentDate'] = $r['PER_DATE_ENTRANCE'];
				$row['ResignationDate'] = $r['PER_DATE_RESIGN'];
				$row['RetirementDate'] = $r['PER_DATE_RETIRE'];
				// $row['EmployeeLevel'] = $r['LEVEL_ID'];
				$row['PositionLevelIdentification'] = $r['LEVEL_ID'];
				$row['PositionLevelName'] = $r['LEVEL_NAME_TH'];
				
				$row['PositionIdentification'] = $r['LINE_ID'];
				$row['PositionName'] = $r['LINE_NAME_TH'];
				$row['OrganizationIdentification'] = $r['ORG_ID_3']; //ฝ่าย
				$row['OrganizationName'] = $r['ORG_NAME_TH']; //ฝ่าย
				// $row['FatherFullName'] = $r['FATHER_NAME'];			
				$row['FatherFullName'] = Showname($r['F_PREFIX_NAME_TH'],$r['F_FNAME_TH'],$r['F_MNAME_TH'],$r['F_LNAME_TH'],'text','');
				
				$row['FatherOccupation'] = $r['FATHER_JOB'];
				$row['FatherCitizenIdentification'] = $r['F_IDCARD'];
				$row['status'] = $r['F_STATUS'];
				
				if($r['F_BIRTHDATE']){
					if($r['F_STATUS'] == '1'){
						$age_f = CalAgePension($r['F_BIRTHDATE'],$date_t);
						}else if($r['F_DIED_DATE']){
						$age_f = CalAgePension($r['F_BIRTHDATE'],$r['F_DIED_DATE']);
						}else{
						$age_f['YEAR'] = null;
					}
					}else{
					$age_f['YEAR'] = null;
				}
				
				$row['FatherDiedDate'] = $r['F_DIED_DATE'];
				
				$row['FatherAge'] = $age_f['YEAR'];
				
				// $row['MotherFullName'] = $r['MOTHER_NAME'];
				$row['MotherFullName'] = Showname($r['M_PREFIX_NAME_TH'],$r['M_FNAME_TH'],$r['M_MNAME_TH'],$r['M_LNAME_TH'],'text','');
				$row['MotherOccupation'] = $r['MOTHER_JOB'];
				$row['MotherCitizenIdentification'] = $r['M_IDCARD'];
				
				if($r['M_BIRTHDATE']){
					if($r['M_STATUS'] == '1'){
						$age_m = CalAgePension($r['M_BIRTHDATE'],$date_t);
						}else if($r['M_DIED_DATE']){
						$age_m = CalAgePension($r['M_BIRTHDATE'],$r['M_DIED_DATE']);
						}else{
						$age_m['YEAR'] = null;
					}
					}else{
					$age_m['YEAR'] = null;
				}
				
				$row['MotherAge'] = $age_m['YEAR'];
				
				$row['MotherDiedDate'] = $r['M_DIED_DATE'];
				
				// $row['SpouseFullName'] = $r['SPOUSE_NAME'];
				
				$row['SpouseFullName'] = Showname($r['S_PREFIX_NAME_TH'],$r['S_FNAME_TH'],$r['S_MNAME_TH'],$r['S_LNAME_TH'],'text','');
				$row['SpouseOccupation'] = $r['SPOUSE_JOB'];
				$row['SpouseCitizenIdentification'] = $r['S_IDCARD'];
				
				if($r['S_BIRTHDATE']){
					if($r['S_STATUS'] == '1'){
						$age_s = CalAgePension($r['S_BIRTHDATE'],$date_t);
						}else if($r['S_DIED_DATE']){
						$age_s = CalAgePension($r['S_BIRTHDATE'],$r['S_DIED_DATE']);
						}else{
						$age_s['YEAR'] = null;
					}
					}else{
					$age_s['YEAR'] = null;
				}
				
				
				$row['SpouseAge'] = $age_s['YEAR'];
				
				$row['SpouseDiedDate'] = $r['S_DIED_DATE'];
				$row['SpouseMarryDate'] = $r['MARRY_DATE'];
				$row['SpouseDivorceDate'] = $r['DIVORCE_DATE'];
				$row['SpouseWorkPlace'] = $r['WORK_PLACE'];
				
				
				$row['PositionShortName'] = $r['POS_SHORT'];
				$row['PositionFullName'] = $r['POS_FULL'];
				
				//ORG_ID 1-6
				$row['OrganizationIdentification_1'] = $r['ORG_ID_1'];
				$row['OrganizationIdentification_2'] = $r['ORG_ID_2'];
				$row['OrganizationIdentification_3'] = $r['ORG_ID_3'];
				$row['OrganizationIdentification_4'] = $r['ORG_ID_4'];
				$row['OrganizationIdentification_5'] = $r['ORG_ID_5'];
				$row['OrganizationIdentification_6'] = $r['ORG_ID_6'];
				
				$row['OrganizationName_1'] = $r['ORG_NAME_TH_1'];
				$row['OrganizationName_2'] = $r['ORG_NAME_TH_2'];
				$row['OrganizationName_3'] = $r['ORG_NAME_TH_3'];
				$row['OrganizationName_4'] = $r['ORG_NAME_TH_4'];
				$row['OrganizationName_5'] = $r['ORG_NAME_TH_5'];
				$row['OrganizationName_6'] = $r['ORG_NAME_TH_6'];
				
				$aa = array();
				GetOrgParent($r['ORG_REP_ID'],$aa);
				
				$row['OrganizationRef'] = $aa;
				
				
				
				array_push($obj,$row);
				
			}
			
			
			
			return $this->respondWithData($obj);
			// return $this->respondWithData($request);
			
			
		}
		
		
		
	}
	
	
	
?>