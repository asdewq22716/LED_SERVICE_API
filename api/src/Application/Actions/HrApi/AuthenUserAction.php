<?php
declare(strict_types=1);
namespace App\Application\Actions\HrApi;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use db;
error_reporting(0);
set_time_limit(0);
class AuthenUserAction extends Action
{
    /**
     * {@inheritdoc}
     */	 
 
    protected function action(): Response
    {        


	
		include('../../include/connect_db.php');
		include('../../function/config_db.php');
		
		$request = $this->getFormData();
		
		
		$host = "ad-srv.mrta.co.th";
		$ldap_password = $request->passWord;
		$ldap_username = "mrta\\".$request->userName;
		$response = array();
		
		
		if(empty($request->userName) OR empty($request->passWord)){
			
			$response['statusCode'] = "103";
			$response['statusDetail'] = "User Or Password Not Found";
		}
		
		
		
		
		
		if(!empty($request->userName) and !empty($request->passWord)){
			
			$ldap_connection = ldap_connect($host);
			if ($ldap_connection){
		
				ldap_set_option($ldap_connection, LDAP_OPT_PROTOCOL_VERSION, 3) or die('Unable to set LDAP protocol version');
				ldap_set_option($ldap_connection, LDAP_OPT_REFERRALS, 0); // We need this for doing an LDAP search.
				
				$bind = ldap_bind($ldap_connection, $ldap_username, $ldap_password);
				
				if($bind){
					
					$sql = "SELECT A.PER_ID, A.PER_CODE, dbo.GetPositionTextShortNonLevel(A.PER_ID) AS POS_SHORT, C.PREFIX_NAME_TH, 
							A.PREFIX_ID, A.PER_FIRSTNAME_TH, A.PER_LASTNAME_TH, org3.ORG_NAME_TH AS ORG_NAME_TH_3, 
							org4.ORG_NAME_TH AS ORG_NAME_TH_4, org5.ORG_NAME_TH AS ORG_NAME_TH_5, 
							org6.ORG_NAME_TH AS ORG_NAME_TH_6
							FROM PER_PROFILE A
							JOIN PER_PROFILE_AD B ON A.PER_ID = B.PER_ID
							LEFT JOIN SETUP_PREFIX C ON A.PREFIX_ID = C.PREFIX_ID
							LEFT JOIN SETUP_ORG org3 ON a.ORG_ID_3 = org3.ORG_ID 
							LEFT JOIN SETUP_ORG org4 ON a.ORG_ID_4 = org4.ORG_ID 
							LEFT JOIN SETUP_ORG org5 ON a.ORG_ID_5 = org5.ORG_ID 
							LEFT JOIN SETUP_ORG org6 ON a.ORG_ID_6 = org6.ORG_ID 
							WHERE B.USER_NAME = '".$request->userName."'";
					$q = db::query($sql);
					$r = db::fetch_array($q);
					
					$response['statusCode'] = "000";
					$response['statusDetail'] = "success";
					$response['perId'] = $r['PER_ID'];
					$response['employeeCode'] = $r['PER_CODE'];
					$response['prefixName'] = $r['PREFIX_NAME_TH'];
					$response['empName'] = $r['PER_FIRSTNAME_TH'];
					$response['empLastName'] = $r['PER_LASTNAME_TH'];
					$response['empPosition'] = $r['POS_SHORT'];
					$response['orgNameLevel3'] = $r['ORG_NAME_TH_3'];
					$response['orgNameLevel4'] = $r['ORG_NAME_TH_4'];
					$response['orgNameLevel5'] = $r['ORG_NAME_TH_5'];
					$response['orgNameLevel6'] = $r['ORG_NAME_TH_6'];
					
					
				}else{
					
					$response['statusCode'] = "101";
					$response['statusDetail'] = "Authen Not Found";
					
				}
				
				
				
				
				ldap_close($ldap_connection);
			
			


			}

		}

				
		

        return $this->respondWithData($response);
		// return $this->respondWithData($request);
		
		
    }
	
	
	
}



?>