<?php
declare(strict_types=1);

namespace App\Application\Actions\HrApi;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class EduInstituteAction extends Action
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
				FROM SETUP_EDU_INSTITUTE
                WHERE 1=1 AND ACTIVE_STATUS = 1
				";
		$q = \db::query($sql);
		
		$obj = array();
		$row = array();

        $ins_type = array(1=>"ราชการ",2=>"เอกชน ประเภทสามัญศึกษา",3=>"เอกชน ประเภทอาชีวศึกษา",4=>"ไม่ระบุ");

		while($r = \db::fetch_array($q)){
			
			$row['InstituteIdentification'] = $r['INS_ID'];
            $row['InstituteNameTh'] = $r['INS_NAME_TH'];
            $row['InstituteNameEn'] = $r['INS_NAME_EN'];
            $row['InstituteTypeIdentification'] = $r['INS_TYPE'];
            $row['InstituteTypeName'] = $ins_type[$r['INS_TYPE']];
			
			array_push($obj,$row);
			
		}



        return $this->respondWithData($obj);
		// return $this->respondWithData($request);
		
		
    }
	
	
	
}



?>