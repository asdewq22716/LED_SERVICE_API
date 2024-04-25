<?php
declare (strict_types = 1);

namespace App\Application\Actions\Api;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class civilCaseDocAction extends Action
{
    /**
     * {isset(inheritdoc}
     */

    protected function action(): Response
    {

        include 'lib/connect_db.php';
        include 'lib/config_db.php';

        $obj = array();
        $row = array();

        $request = $this->getFormData();
        $filter = "";
        if (!empty($request->courtCode) != '') {
            $filter .= "AND a.COURT_CODE = '" . $request->courtCode . "'";
        }
        if (!empty($request->prefixBlackCase) != '') {
            $filter .= "AND a.PREFIX_BLACK_CASE = '" . $request->prefixBlackCase . "'";
        }
        if (!empty($request->blackCase) != '') {
            $filter .= "AND a.BLACK_CASE = '" . $request->blackCase . "'";
        }
        if (!empty($request->blackYY) != '') {
            $filter .= "AND a.BLACK_YY = '" . $request->blackYY . "'";
        }
        if (!empty($request->prefixRedCase) != '') {
            $filter .= "AND a.PREFIX_RED_CASE = '" . $request->prefixRedCase . "'";
        }
        if (!empty($request->redCase) != '') {
            $filter .= "AND a.RED_CASE = '" . $request->redCase . "'";
        }
        if (!empty($request->redYY) != '') {
            $filter .= "AND a.RED_YY = '" . $request->redYY . "'";
        }
        if (!empty($request->docDate) != '') {
            $filter .= "AND b.CREATE_DATE = '" . $request->docDate . "'";
        }
        if (!empty($request->docName) != '') {
            $filter .= "AND b.SHR_E_DOCUMENT_NAME = '" . $request->docName . "'";
        }

        //  $request->registerCode

        $sql = "select 		a.CIVIL_CODE,COURT_CODE,COURT_NAME,DEPT_CODE,DEPT_NAME,PREFIX_BLACK_CASE,BLACK_CASE,BLACK_YY,PREFIX_RED_CASE,RED_CASE,RED_YY,TO_CHAR(CREATE_DATE,'YYYY-MM-DD') as CREATE_DATE,SHR_E_DOCUMENT_NAME,SHR_E_DOCUMENT_URL
				from 		WH_CIVIL_CASE a 
				inner join 	WH_CIVIL_EDOC b on a.WH_CIVIL_ID = b.WH_CIVIL_ID
				where 		1=1 {$filter} ORDER BY b.SHR_E_DOCUMENT_URL ASC";
        $data = \db::query($sql);
        $i = 0;
        while ($rec = \db::fetch_array($data)) {

            $obj[$i]['civilCode'] 			= $rec['CIVIL_CODE'];
            $obj[$i]['courtCode'] 			= $rec['COURT_CODE'];
            $obj[$i]['courtName'] 			= $rec['COURT_NAME'];
            $obj[$i]['deptCode'] 			= $rec['DEPT_CODE'];
            $obj[$i]['deptName'] 			= $rec['DEPT_NAME'];
            $obj[$i]['prefixBlackCase'] 	= $rec['PREFIX_BLACK_CASE'];
            $obj[$i]['blackCase'] 			= $rec['BLACK_CASE'];
            $obj[$i]['blackYY'] 			= $rec['BLACK_YY'];
            $obj[$i]['prefixRedCase'] 		= $rec['PREFIX_RED_CASE'];
            $obj[$i]['redCase'] 			= $rec['RED_CASE'];
            $obj[$i]['redYY'] 				= $rec['RED_YY'];
            $obj[$i]['docDate'] 			= $rec['CREATE_DATE'];
            $obj[$i]['docName'] 			= $rec['SHR_E_DOCUMENT_NAME'];
			
			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'http://103.40.146.152/LED_DOC/LED_EDOC/webservice/get_document_process.php',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS =>'{
				"DOC_MAS_ID":"'.$rec["SHR_E_DOCUMENT_URL"].'"
			}',
			  CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Cookie: PHPSESSID=42ba47c21c73ca90436e9fe1e9c0dfe3'
			  ),
			));

			$response = curl_exec($curl);
			
			

			curl_close($curl);

			$dataJson = json_decode($response,true);	
			
            $obj[$i]['docFile'] 	= $dataJson["data"][0]["FILE_DATA"];
            $obj[$i]['docFileType'] = $dataJson["data"][0]["FILE_TYPE"];

            $i++;
        }

        $serviceName = 'civilCaseDocAction';
        $tokenId = $_SERVER['HTTP_TOKENAPI'];

        include 'log_api_service.php';
		
        $num = count($obj);

        if ($num > 0) {

            $row['ResponseCode'] = array('ResCode' => '000', 'ResMeassage' => "SUCCESS");
            $row['Data'] = $obj;

        } else {

            $row['ResponseCode'] = array('ResCode' => '102', 'ResMeassage' => "NOT FOUND");

        }

        return $this->respondWithData($row);
    }

}
