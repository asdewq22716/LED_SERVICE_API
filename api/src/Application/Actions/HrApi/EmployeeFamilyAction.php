<?php
declare(strict_types=1);

namespace App\Application\Actions\HrApi;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class EmployeeFamilyAction extends Action
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
			$filter = " AND PER_ID = '".$request->EmployeeIdentification."' ";
		}
		
		$sql = "SELECT
					*
				FROM
					PER_FAMILY
				WHERE
				1=1
				AND ACTIVE_STATUS = '1'
				AND REQUEST_RESULT = '2'
				".$filter;
		$q = \db::query($sql);
		
		$obj = array();
		$row = array();
		$arr_family_relation = array(1=>'บิดา', 2=>'มารดา', 3=>'คู่สมรส', 4=>'บุตร', 5=>'บุตรบุญธรรม');
		$arr_family_status = array(1=>"มีชีวิต",2=>"เสียชีวิต",3=>"สาบสูญ");
		
		
		while($r = \db::fetch_array($q)){
			
			$row['FamilyFullName'] = Showname($r['FAMILY_PREFIX_ID'],$r['FAMILY_FIRSTNAME_TH'],$r['FAMILY_MIDNAME_TH'],$r['FAMILY_LASTNAME_TH'],'th','');
			$row['CitizenIdentification'] = $r['FAMILY_IDCARD'];
			
			if($r['FAMILY_RELATIONSHIP']){
				$row['Relationship'] = $arr_family_relation[$r['FAMILY_RELATIONSHIP']];	
			}else{
				$row['Relationship'] = null;	
			}
			
			if($r['FAMILY_STATUS']){
				$row['Status'] = $arr_family_status[$r['FAMILY_STATUS']];
			}else{
				$row['Status'] = null;	
			}
			
			// $row['CitizenIdentification'] = "test";
			
			array_push($obj,$row);
			
		}



        return $this->respondWithData($obj);
		// return $this->respondWithData($request);
		
		
    }
	
	
	
}



?>