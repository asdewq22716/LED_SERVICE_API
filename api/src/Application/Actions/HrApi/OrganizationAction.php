<?php
declare(strict_types=1);

namespace App\Application\Actions\HrApi;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use ClassFillter;
use db;

class OrganizationAction extends Action
{
    /**
     * {@inheritdoc}
     */	 
 
    protected function action(): Response
    {        

		include('../../include/connect_db.php');
		include('../../function/config_db.php');
		include('../../function/ClassFillter.php');
		$ObjFilter = new ClassFillter();

		$org = array();
		$obj = array();

		$ObjFilter->getOrgSearchAll(15,$org);

		$sql = "SELECT A.ORG_ID, A.ORG_SEQ, A.ORG_CODE, A.OL_ID, A.ORG_PARENT_ID, A.ORG_NAME_TH, A.ORG_SHORTNAME_TH, A.OrgaOID, B.OL_SEQ FROM SETUP_ORG A
		LEFT JOIN SETUP_ORG_LEVEL B ON A.OL_ID = B.OL_ID
		WHERE A.ACTIVE_STATUS = 1 AND  A.DELETE_FLAG='0' 
		ORDER BY A.ORG_SEQ ASC ";
		$q = db::query($sql);

			
		while($r = db::fetch_array($q)){

			$org_space_name = "";
			if(isset($org[$r['ORG_ID']])){

				$org_space_name =   $org[$r['ORG_ID']];

			}

			
			$row['OrganizationIdentification'] = $r['ORG_ID'];
			$row['OrganizationParent'] = $r['ORG_PARENT_ID'];
			$row['OrganizationLevel'] = $r['OL_ID'];
			$row['OrganizationCode'] = $r['ORG_CODE'];
			$row['OrganizationSeq'] = $r['ORG_SEQ'];
			$row['OrganizationOID'] = $r['OrgaOID'];
			$row['ThaiOrganizationName'] = $r['ORG_NAME_TH'];
			$row['ThaiOrganizationNameSe'] = $org_space_name;
			$row['ThaiShortName'] = $r['ORG_SHORTNAME_TH'];
			
			
			array_push($obj,$row);
		}	
		



        return $this->respondWithData($obj);
    }
	
	
	
}



?>