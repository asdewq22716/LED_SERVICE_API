<?php
declare(strict_types=1);

namespace App\Application\Actions\HrApi;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class OrganizationSignatureAction extends Action
{
    /**
     * {@inheritdoc}
     */	 
 
    protected function action(): Response
    {        

		include('../../include/connect_db.php');
		include('../../function/config_db.php');
		
		$sql = "SELECT
					*
				FROM
					SETUP_ORG_REP_SIGNATURE
				";
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
    }
	
	
	
}



?>