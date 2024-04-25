<?php
declare(strict_types=1);

namespace App\Application\Actions\HrApi;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class EmployeeHistoryAction extends Action
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
		
		// $filter = "";
		// if($request->EmployeeIdentification!=''){
		// 	$filter = " AND a.PER_ID = '".$request->EmployeeIdentification."' ";
		// }
		
		$sql = "SELECT
				*
				FROM PER_NAMEHIS
                WHERE 1=1 
				";
		$q = \db::query($sql);
		
		$obj = array();
		$row = array();

        $el_type = array(1=>"ต่ำกว่าปริญญาตรี",2=>"สูงกว่าปริญญาตรี");

		while($r = \db::fetch_array($q)){
			
			$row['EmployeeIdentification'] = $r['PER_ID'];
            $row['EmployeeDate'] = $r['NAMEHIS_CHANGEDATE'];
            $row['PrefixIdentification'] = $r['NAMEHIS_LAST_PREFIX_ID'];
            $row['FirstNameTh'] = $r['NAMEHIS_LAST_FIRSTNAME_TH'];
            $row['MindNameTh'] = $r['NAMEHIS_LAST_MINDNAME_TH'];
            $row['LastNameTh'] = $r['NAMEHIS_LAST_LASTNAME_TH'];
            $row['FirstNameEn'] = $r['NAMEHIS_LAST_FIRSTNAME_EN'];
            $row['MindNameEm'] = $r['NAMEHIS_LAST_MINDNAME_EN'];
            $row['LastNameEn'] = $r['NAMEHIS_LAST_LASTNAME_En'];
            

            
			
			array_push($obj,$row);
			
		}



        return $this->respondWithData($obj);
		// return $this->respondWithData($request);
		
		
    }
	
	
	
}



?>