<?php
declare(strict_types=1);

namespace App\Application\Actions\HrApi;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class MedFeeDetailAction extends Action
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
					*
				FROM
					FRM_WELFARE_LIST
				WHERE
					WF_MAIN_ID = '1'
				";
		$q = \db::query($sql);
		
		$obj = array();
		$row = array();
		
		while($r = \db::fetch_array($q)){
			
			$row['MedicalFeeHeadIdentification'] = $r['WFR_ID'];
			$row['MedicalFeeDetailIdentification'] = $r['F_ID'];
			$row['MedicalFeeReceiptNumber'] = $r['RECEIPT_NO']."/".$r['RECEIPT_BOOK'];
			$row['MedicalFeeReceiptDate'] = $r['RECEIPT_DATE']; 
			$row['HospitalIdentification'] = $r['HOSPITAL_ID']; 
			$row['Disease'] = $r['MEDICAL_DISEASE']; 
			$row['PatientName'] = $r['MEDICAL_NAME']; 
			// $row['MedicalFeeDisbursementsItem'] ; 
			$row['ReceiptAmount'] = $r['MEDICAL_AMOUNT']; 
			
			array_push($obj,$row);
			
		}



        return $this->respondWithData($obj);
    }
	
	
	
}



?>