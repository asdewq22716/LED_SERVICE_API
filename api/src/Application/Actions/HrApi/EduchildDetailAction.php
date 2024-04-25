<?php
declare(strict_types=1);

namespace App\Application\Actions\HrApi;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class EduchildDetailAction extends Action
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
					a.*,b.INS_NAME_TH,b.INS_TYPE
				FROM
					FRM_WELFARE_EDU_LIST a 
				LEFT JOIN SETUP_EDU_INSTITUTE b ON a.INS_ID = b.INS_ID
				WHERE
					WF_MAIN_ID = '3'
				";
		$q = \db::query($sql);
		
		$obj = array();
		$row = array();
		
		while($r = \db::fetch_array($q)){
			
			$row['ChildEducationHeadIdentification'] = $r['WFR_ID'];
			$row['ChildEducationDetailIdentification'] = $r['F_ID'];
			$row['TuituinFeeReceiptNumber'] = $r['RECEIPT_NO']."/".$r['RECEIPT_BOOK'];
			$row['TuituinFeeReceiptDate'] = $r['RECEIPT_DATE'];
			$row['ChildIdentification'] = $r['SCHOOL_SON'];
			$row['ChildEducationName'] = $r['INS_NAME_TH'];
			$row['ChildEducationType'] = $r['INS_TYPE'];
			$row['ChildEducationLevel'] = $r['SCHOOL_DEGREE']." ".$r['SCHOOL_CLASS'];
			$row['ChildEducationYear'] = $r['SCHOOL_YEAR'];
			$row['ChildEducationTerm'] = $r['SCHOOL_TERM'];
			// $row['TuituinFeeDisbursementsItem'] ;
			$row['NetDisbursements'] = $r['SCHOOL_REQ_AMOUNT']; 
			
			array_push($obj,$row);
			
		}



        return $this->respondWithData($obj);
    }
	
	
	
}



?>