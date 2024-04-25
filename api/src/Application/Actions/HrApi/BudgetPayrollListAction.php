<?php
	declare(strict_types=1);
	
	namespace App\Application\Actions\HrApi;
	
	use App\Application\Actions\Action;
	use Psr\Http\Message\ResponseInterface as Response;
	use Psr\Http\Message\StreamInterface;
	use Psr\Http\Message\ServerRequestInterface as Request;
	use Psr\Http\Server\MiddlewareInterface;
	use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
	
	class BudgetPayrollList extends Action
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
			if($request->IdentificationReference!=''){
				$filter .= " AND a.WFR_ID = '".$request->Identification."' ";
			}
			
			$field = 
			" row_number() over (order by (select null)) as ROW
			, a.ROUND_NAME
			, a.TAX_MONTH
			, a.TAX_YEAR
			, a.PAYROLL_ID
			, a.PAY_LIST_NAME
			, a.FINAL_INCOME
			, a.TOTAL_PER ";
			$table = 
			" FRM_BUDGET_PAYROLL a ";
			$cond = " where 1=1 ";
			$order = " order by a.TAX_YEAR desc, a.ROUND_ID asc, c.SEQ_NO asc ";
			$sql_s = "select ".$field." from ".$table.$cond;
			$sql = $sql_s.$filter.$order;
			$q = \db::query($sql);
			
			$obj = array();
			$row = array();
			
			while($r = \db::fetch_array($q)){
			
				foreach($r as $field => $value){
					$row[$field] = $value;
				}
				
				array_push($obj,$row);
				
			}
			
			
			
			return $this->respondWithData($obj);
			// return $this->respondWithData($request);
			
			
		}
		
		
		
	}
	
	
	
?>