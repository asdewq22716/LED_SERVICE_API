<?php
declare(strict_types=1);

namespace App\Application\Actions\HrApi;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class TitleAction extends Action
{
    /**
     * {@inheritdoc}
     */	 
 
    protected function action(): Response
    {        

		include('../../include/connect_db.php');
		include('../../function/config_db.php');
		
		
		$request = $this->getFormData();
		
		$filter = "";
		if($request->PrefixIdentification!=''){
			$filter = " AND PREFIX_ID = '".$request->PrefixIdentification."' ";
		}
		
		$sql = "SELECT
					*
				FROM
					SETUP_PREFIX
				WHERE
					1=1 ".$filter;
		$q = \db::query($sql);
		
		
		
		$obj = array();
		$row = array();
		
		while($r = \db::fetch_array($q)){
			
			$row['PrefixIdentification'] = $r['PREFIX_ID'];
			$row['EngPrefix'] = $r['PREFIX_NAME_EN'];
			$row['ThaiPrefix'] = $r['PREFIX_NAME_TH'];
			
			array_push($obj,$row);
			
		}



        return $this->respondWithData($obj);
    }
	
	
	
}



?>