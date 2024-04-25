<?php
declare(strict_types=1);

namespace App\Application\Actions\HrApi;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class EmployeeChildrenAction extends Action
{
    /**
     * {@inheritdoc}
     */	 
 
    protected function action(): Response
    {        

		include('../../include/connect_db.php');
		include('../../function/config_db.php');
		include('../../function/function_for_api.php');
		
		$request = $this->getFormData();

		$filter = "";
		if($request->EmployeeIdentification!=''){
			$filter = " AND f.PER_ID = '".$request->EmployeeIdentification."' ";
		}

		$sql = "SELECT
					f.*,b.EL_NAME_TH,e.INS_NAME_TH,e.INS_TYPE
				FROM
					PER_FAMILY f
				LEFT JOIN PER_EDUCATEHIS_CHILD a ON f.FAMILY_ID = a.PER_ID AND a.REQUEST_RESULT = 2
				LEFT JOIN SETUP_EDU_LEVEL b ON a.EL_ID = b.EL_ID
				LEFT JOIN SETUP_EDU_INSTITUTE e ON a.INS_ID = e.INS_ID
				WHERE
					f.FAMILY_RELATIONSHIP IN (4,5) ".$filter." ORDER BY f.BIRTH_SEQ ASC";
		$q = \db::query($sql);
		
		$obj = array();
		$row = array();
		$array_Edu = array('1'=>'รัฐบาล','2'=>'เอกชน','3'=>'อื่นๆ');
		$arr_treaty_rights_4 = array(1=>'สิทธิเบิกตรงบิดา',2=>"สิทธิเบิกตรงมารดา",0=>'');
		$date_t = date('Y-m-d');
		while($r = \db::fetch_array($q)){
			
			$row['EmployeeIdentification'] = $r['PER_ID'];
			$row['ChildrenIdentification'] = $r['FAMILY_ID'];
			
			if($r['FAMILY_PREFIX_ID']){
				$row['ChildFullName'] = Showname($r['FAMILY_PREFIX_ID'],$r['FAMILY_FIRSTNAME_TH'],$r['FAMILY_MIDNAME_TH'],$r['FAMILY_LASTNAME_TH'],'th','');
			}else{
				$row['ChildFullName'] = $r['FAMILY_FIRSTNAME_TH']." ".$r['FAMILY_MIDNAME_TH']." ".$r['FAMILY_LASTNAME_TH'];
			}
			
			
			if($r['FAMILY_BIRTHDATE']){
				$age_c = CalAgePension($r['FAMILY_BIRTHDATE'],$date_t);
				$date_treaty1 = cal_Treaty($age_c['YEAR'],$r['FAMILY_BIRTHDATE'],1);
				$date_treaty2 = cal_Treaty($age_c['YEAR'],$r['FAMILY_BIRTHDATE'],2);
			}else{
				$age_c['YEAR'] = null;
				$date_treaty1 = null;
				$date_treaty2 = null;
			}
	
				
			$row['ChildAge'] = $age_c['YEAR'];
			$row['ChildBirthDate'] = $r['FAMILY_BIRTHDATE'];
			$row['ChildCitizenIdentification'] = $r['FAMILY_IDCARD'];
			$row['ChildEducationLevel'] = $r['EL_NAME_TH'];
			$row['ChildEducationName'] = $r['INS_NAME_TH'];
			$row['ChildEducationType'] = $r['INS_TYPE'];
			$row['ChildTreat'] = $arr_treaty_rights_4[(int)$r['TREATY_RIGHTS']];
			$row['ChildTreat1'] = $date_treaty1;
			$row['ChildTreat2'] = $date_treaty2;
			$row['ChildSeq'] = $r['BIRTH_SEQ'];
			if($r['INS_TYPE']){
				$row['ChildEducationTypeName'] = $array_Edu[$r['INS_TYPE']];	
			}else{
				$row['ChildEducationTypeName'] = null;
			}
			
			
			
			array_push($obj,$row);
			
		}



        return $this->respondWithData($obj);
    }
	
	
	
}



?>