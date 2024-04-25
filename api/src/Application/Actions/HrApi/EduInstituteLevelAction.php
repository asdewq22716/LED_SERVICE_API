<?php
declare(strict_types=1);

namespace App\Application\Actions\HrApi;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class EduInstituteLevelAction extends Action
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
				FROM SETUP_EDU_LEVEL
                WHERE 1=1 AND ACTIVE_STATUS = 1
				";
		$q = \db::query($sql);
		
		$obj = array();
		$row = array();

        $el_type = array(1=>"ต่ำกว่าปริญญาตรี",2=>"สูงกว่าปริญญาตรี");

		while($r = \db::fetch_array($q)){
			
			$row['InstituteLevelIdentification'] = $r['EL_ID'];
            $row['InstituteLevelNameTh'] = $r['EL_NAME_TH'];
            $row['InstituteLevelNameEn'] = $r['EL_NAME_EN'];
            $row['InstituteLevelShortNameTh'] = $r['EL_SHORTNAME_TH'];
            $row['InstituteLevelShortNameEn'] = $r['EL_SHORTNAME_EN'];
            $row['InstituteLevelTypeIdentification'] = $r['EL_TYPE'];
            $row['InstituteLevelTypeName'] = $el_type[$r['EL_TYPE']];

            
			
			array_push($obj,$row);
			
		}



        return $this->respondWithData($obj);
		// return $this->respondWithData($request);
		
		
    }
	
	
	
}



?>