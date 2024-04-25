<?php
declare(strict_types=1);

namespace App\Application\Actions\HrApi;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class HospitalAction extends Action
{
    /**
     * {@inheritdoc}
     */	 
 
    protected function action(): Response
    {        

		include('../../include/connect_db.php');
		include('../../function/config_db.php');
		
		$sql = "SELECT HOSPITAL_ID, HOSPITAL_NAME_TH, HOSPITAL_NAME_EN, HOSPITAL_TYPE FROM SETUP_HOSPITAL";
		$q = \db::query($sql);
		
		$obj = array();
		$row = array();
		while($r = \db::fetch_array($q)){
			
			$row['HospitalIdentification'] = $r['HOSPITAL_ID'];
			$row['HospitalName'] = $r['HOSPITAL_NAME_TH'];
			$row['HospitalType'] = $r['HOSPITAL_TYPE'];
			
			array_push($obj,$row);
			
		}



        return $this->respondWithData($obj);
    }
}

?>