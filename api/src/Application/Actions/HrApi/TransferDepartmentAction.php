<?php
declare(strict_types=1);

namespace App\Application\Actions\HrApi;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class TransferDepartmentAction extends Action
{
    /**
     * {@inheritdoc}
     */	 
 
    protected function action(): Response
    {        

		include('../../include/connect_db.php');
		include('../../function/config_db.php');
		include('../../function/function_for_api.php');

		$sql = "SELECT * FROM SETUP_ORG_REP where ORG_REP_HIS_ID = 1 ";
		$q = \db::query($sql);
		
		$obj = array();
		$row = array();
		
		while($r = \db::fetch_array($q)){

			// if($r['ORG_ID_REF']=='13'){
			// 	$r['ORG_ID_REF']="";
			// }
			
			$row['OrganizationRepIdentification'] = $r['ORG_REP_ID'];
            $row['OrganizationRepOrder'] = $r['ORG_REP_ORDER'];
            $row['OrganizationNameTh'] = $r['ORG_NAME_TH'];
            $row['OrganizationShortNameTh'] = $r['ORG_SHORTNAME_TH'];
            $row['OrganizationParentId'] = $r['ORG_REP_PARENT_ID'];
            $row['OrganizationLevelId'] = $r['OL_ID'];
			

			array_push($obj,$row);
			
		}



        return $this->respondWithData($obj);
    }
	
	
	
}



?>