<?php
declare(strict_types=1);

namespace App\Application\Actions\HrApi;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class TransferProfileAction extends Action
{
    /**
     * {@inheritdoc}
     */	 
 
    protected function action(): Response
    {        

		include('../../include/connect_db.php');
		include('../../function/config_db.php');
		include('../../function/function_for_api.php');

		$sql = "SELECT CASE WHEN PER_IDCARD = ' ' THEN PER_IDCARD ELSE
                FORMAT (
                    CAST (PER_IDCARD AS bigint),
                    '#-####-#####-##-#'
                )
                END AS PER_IDCARD,
                PREFIX_NAME_TH,
                PER_FIRSTNAME_TH,
                PER_MIDNAME_TH,
                PER_LASTNAME_TH,
                ORG_REP_ID,
                A.ORG_ALL_REP_ID,
                A.POSTYPE_ID,
                PER_STATUS_CIVIL as PER_STATUS,
                A.LEVEL_ID,
                LINE_ID,
                PER_ID AS DPIS_ID,
                dbo.GetPositionTextNonLevel (PER_ID) AS PL_NAME,
				dbo.GetOrgShortText(PER_ID) AS ORG_VIEW,
                dbo.GetPositionTextShort (PER_ID) AS POSITION_SHORT,
                PER_EMAIL,
                PER_CODE,
                c.LEVEL_NAME_TH
                FROM
                    PER_PROFILE a
                LEFT JOIN SETUP_PREFIX b ON a.PREFIX_ID = b.PREFIX_ID
                LEFT JOIN SETUP_POS_LEVEL c ON a.LEVEL_ID = c.LEVEL_ID
                WHERE
                    PER_STATUS_CIVIL IN (1, 2) ";
		$q = \db::query($sql);
		
		$obj = array();
		$row = array();
		
		while($r = \db::fetch_array($q)){

			
			$row['PrefixNameTh'] = $r['PREFIX_NAME_TH'];
            $row['PositionName'] = $r['PL_NAME'];
            $row['DpisIdentification'] = $r['DPIS_ID'];
            $row['CitizenIdentification'] = $r['PER_IDCARD'];
            $row['ThaiGivenName'] = $r['PER_FIRSTNAME_TH'];
            $row['ThaiFamilyName'] = $r['PER_LASTNAME_TH'];
            $row['OrganizationRepIdentification'] = $r['ORG_REP_ID'];
            $row['OrganizationRepAll'] = $r['ORG_ALL_REP_ID'];
			 $row['OrganizationView'] = $r['ORG_VIEW'];
            $row['EmployeeType'] = $r['POSTYPE_ID'];
            $row['PositionShortName'] = $r['POSITION_SHORT'];
            $row['Email'] = $r['PER_EMAIL'];
            $row['EmployeeCode'] = $r['PER_CODE'];
            $row['PositionLevelIdentification'] = $r['LEVEL_ID'];
            $row['PositionLevelName'] = $r['LEVEL_NAME_TH'];
            $row['PositionLineIdentification'] = $r['LINE_ID'];
			

			array_push($obj,$row);
			
		}



        return $this->respondWithData($obj);
    }
	
	
	
}



?>