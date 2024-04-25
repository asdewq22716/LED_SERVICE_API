<?php
declare(strict_types=1);

namespace App\Application\Actions\HrApi;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class BudgetPayUserAction extends Action
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
		if($request->Identification!=''){
			$filter = " AND WFR_ID = '".$request->Identification."' ";
		}
		
		$sql = "SELECT
					*
				FROM
                    FRM_BUDGET_PAY_USER
				WHERE
					1=1 AND WF_MAIN_ID = 322 ".$filter;
		$q = \db::query($sql);
		
		$obj = array();
		$row = array();
		
		$array_bdg_type = array('1' => 'ค่ารักษาพยาบาล (จ่ายตรง)', '2' => 'ค่ารักษาพยาบาล (สำรองจ่าย)' ,'3' => 'ค่าเล่าเรียนบุตร');
	
		
		while($r = \db::fetch_array($q)){
			
			$row['FormIdentification'] = $r['F_ID'];
			$row['WfrReserveBudget'] = $r['WFR_ID']; //มาจาก WFR_RESERVE_BUDGET (จองงบประมาณ)
			$row['WfrReference'] = $r['WFR_REFER_ID']; // ถ้าเป็นค่ารักษาพยาบาล Id มาจาก table M_WELFARE_MEDICAL (จ่ายตรง),WFR_REQ_WELFARE_MEDICAL (สำรองจ่าย) บุตรมากจาก table WFR_REQ_WELFARE_EDU

            // $row['IdentificationReference'] = $r['WFR_REFER_ID']; //WFR_REFER_ID

            $row['WelfareNo'] = $r['WELFARE_NO']; //เลขที่สวัสดิการ / เลขที่เอกสาร
			$row['TableName'] = $r['TABLE_NAME'];
            $row['BudgetThaiFullName'] = $r['BDG_NAME']; //เจ้าของสิทธิ	
			$row['OrganizationAllName'] = $r['ORG_ALL_REP_NAME'];
			$row['AmountMoney'] = $r['AMOUNT_MONEY'];
            
			array_push($obj,$row);
			
		}



        return $this->respondWithData($obj);
		// return $this->respondWithData($request);
		
		
    }
	
	
	
}



?>