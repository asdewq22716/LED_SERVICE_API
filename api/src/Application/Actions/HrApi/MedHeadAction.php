<?php
declare(strict_types=1);

namespace App\Application\Actions\HrApi;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class MedHeadAction extends Action
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
		
		
		$sql = "SELECT
					a.*,b.LINE_ID,b.ORG_ID_3
				FROM
					M_WELFARE_MEDICAL a 
				LEFT JOIN PER_PROFILE b ON a.PER_ID = b.PER_ID
				";
		$q = \db::query($sql);
		
		$obj = array();
		$row = array();
		
		while($r = \db::fetch_array($q)){
			
			$row['MedicalHeadIdentification'] = $r['MDC_ID'];
			$row['MedicalDisbursementsNumber'] = $r['WELFARE_NO'];
			$row['MedicalDisbursementsDate'] = $r['MDC_DATE'];
			$row['EmployeeIdentification'] = $r['PER_ID'];
			
			if($r['PER_ID']){
				$row['EmployeeName'] = get_per_name($r['PER_ID']);
			}else{
				$row['EmployeeName'] = null;
			}
			
			$row['PositionIdentification'] = $r['LINE_ID'];
			$row['OrganizationIdentification'] = $r['ORG_ID_3'];
			$row['Disease'] = $r['MDC_DISEASE'];
			$row['PatientName'] = $r['MDC_NAME'];
			$row['ReceiptAmount'] = $r['MDC_AMOUNT'];
			
			array_push($obj,$row);
			
		}



        return $this->respondWithData($obj);
    }
	
	
	
}



?>