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
use Encrypt;


class EmployeeSalaryAction extends Action
{
    /**
     * {@inheritdoc}
     */	 
 
    protected function action(): Response
    {        

		include('../../include/connect_db.php');
		include('../../function/config_db.php');
        include('../../function/function_for_api.php');
        include('../../function/Encrypt.php');

        $_SESSION['WF_USER_ID'] = 1;
		$EncryptSal = new Encrypt();

		$sql = "SELECT 
				sp.*, 
				pp.*,
				pi.SALARY,
				pi.COM_SDATE,
				pi.COM_DATE,
				pi.COM_NO,
				dbo.GetPositionText (pp.PER_ID) AS pos_txt,
				dbo.GetOrgShortText (pp.PER_ID) AS org_txt,
				org1.ORG_NAME_TH AS ORG_NAME_TH_1,
				org2.ORG_NAME_TH AS ORG_NAME_TH_2,
				org3.ORG_NAME_TH AS ORG_NAME_TH_3,
				org4.ORG_NAME_TH AS ORG_NAME_TH_4,
				org5.ORG_NAME_TH AS ORG_NAME_TH_5,
				org6.ORG_NAME_TH AS ORG_NAME_TH_6,  
				pl.LINE_ID ,  
				pl.LINE_NAME_TH ,  
				ol.LEVEL_ID ,  
				ol.LEVEL_NAME_TH
			FROM
				PER_PROFILE pp
			LEFT JOIN SETUP_PREFIX sp ON pp.PREFIX_ID = sp.PREFIX_ID
			LEFT JOIN SETUP_POS_LINE pl ON pp.LINE_ID = pl.LINE_ID
			LEFT JOIN SETUP_POS_LEVEL ol ON pp.LEVEL_ID = ol.LEVEL_ID
			LEFT JOIN SETUP_ORG org1 ON pp.ORG_ID_1 = org1.ORG_ID
			LEFT JOIN SETUP_ORG org2 ON pp.ORG_ID_2 = org2.ORG_ID
			LEFT JOIN SETUP_ORG org3 ON pp.ORG_ID_3 = org3.ORG_ID
			LEFT JOIN SETUP_ORG org4 ON pp.ORG_ID_4 = org4.ORG_ID
			LEFT JOIN SETUP_ORG org5 ON pp.ORG_ID_5 = org5.ORG_ID
			LEFT JOIN SETUP_ORG org6 ON pp.ORG_ID_6 = org6.ORG_ID
			LEFT JOIN PER_SALARYHIS pi ON pp.PER_ID = pi.PER_ID
			WHERE pp.PER_STATUS_CIVIL in (1,2)
			ORDER BY PER_CODE ,COM_SDATE ASC";
			
		$q = db::query($sql);
		
		$obj = array();
		$row = array();
		while($r = db::fetch_array($q)){
			
			$row['EmployeeIdentification'] = $r['PER_ID'];
			$row['EmployeeCode'] = $r['PER_CODE'];
			$row['EmployeeType'] = $r['POSTYPE_ID'];
            $row['CitizenIdentification'] = $r['PER_IDCARD'];

			$row['ThaiPrefixIdentification'] = $r['PREFIX_ID'];
			$row['FirstNameTh'] = $r['PER_FIRSTNAME_TH'];
			$row['MindNameTh'] = $r['PER_MIDNAME_TH'];
			$row['LastNameTh'] = $r['PER_LASTNAME_TH'];

			$row['EngPrefixIdentification'] = $r['PREFIX_ID'];
			$row['FirstNameEn'] = $r['PER_FIRSTNAME_EN'];
			$row['MindNameEn'] = $r['PER_MIDNAME_EN'];
			$row['LastNameEn'] = $r['PER_LASTNAME_EN'];
		 
            $row['PositionIdentification'] = $r['LINE_ID']; 
			$row['PositionName'] = $r['LINE_NAME_TH'];

            $row['PositionLevelIdentification'] = $r['LEVEL_ID'];
			$row['PositionLevelName'] = $r['LEVEL_NAME_TH'];

            $row['OrganizationIdentification_1'] = $r['ORG_ID_1'];
			$row['OrganizationIdentification_2'] = $r['ORG_ID_2'];
			$row['OrganizationIdentification_3'] = $r['ORG_ID_3'];
			$row['OrganizationIdentification_4'] = $r['ORG_ID_4'];
			$row['OrganizationIdentification_5'] = $r['ORG_ID_5'];
			$row['OrganizationIdentification_6'] = $r['ORG_ID_6'];

			$row['OrganizationName_1'] = $r['ORG_NAME_TH_1'];
			$row['OrganizationName_2'] = $r['ORG_NAME_TH_2'];
			$row['OrganizationName_3'] = $r['ORG_NAME_TH_3'];
			$row['OrganizationName_4'] = $r['ORG_NAME_TH_4'];
			$row['OrganizationName_5'] = $r['ORG_NAME_TH_5'];
			$row['OrganizationName_6'] = $r['ORG_NAME_TH_6'];

            $row['Salary'] = $EncryptSal->Decrypted($r['SALARY']);
            $row['ComSdate'] = $r['COM_SDATE'];
            $row['ComDate'] = $r['COM_DATE'];
            $row['ComNo'] = $r['COM_NO'];
         
         
            array_push($obj,$row);
            
		}


        return $this->respondWithData($obj);
    }
}

?>