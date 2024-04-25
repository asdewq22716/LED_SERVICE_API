<?php
declare(strict_types=1);

namespace App\Application\Actions\HrApi;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class EduChildHeadAction extends Action
{
    /**
     * {@inheritdoc}
     */	 
 
    protected function action(): Response
    {        

		include('../../include/connect_db.php');
		include('../../function/config_db.php');
		include('../../function/function_for_api.php');
		
		$sql = "SELECT
					a.*,b.LINE_ID,b.ORG_ID_3
				FROM
					WFR_REQ_WELFARE_EDU a
				LEFT JOIN PER_PROFILE b ON a.PER_ID = b.PER_ID
				";
		$q = \db::query($sql);
		
		$obj = array();
		$row = array();
		
		while($r = \db::fetch_array($q)){
			
			$row['ChildEducationHeadIdentification'] = $r['WFR_ID'];
			$row['TuitionFeeDisbursementsNumber'] = $r['SCHOOL_NO'];
			$row['TuitionFeeDisbursementsDate'] = $r['EDU_DATE'];
			$row['EmployeeIdentification'] = $r['PER_ID']; 
			$row['PositionIdentification'] = $r['LINE_ID']; 
			$row['OrganizationIdentification'] = $r['ORG_ID_3']; 
			

			array_push($obj,$row);
			
		}



        return $this->respondWithData($obj);
    }
	
	
	
}



?>