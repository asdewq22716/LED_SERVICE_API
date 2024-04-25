<?php
declare(strict_types=1);

namespace App\Application\Actions\Api;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class bankruptCourtOrderAction extends Action
{
    /**
     * {isset(inheritdoc}
     */

    protected function action(): Response
    {

    include('lib/connect_db.php');
		include('lib/config_db.php');
		$obj = array();
		$row = array();


		$request = $this->getFormData();
		$filter = "";
		if(!empty($request->courtCode)){
			$filter .= "AND a.COURT_CODE = '".$request->courtCode."'";
		}
    if(!empty($request->prefixBlackCase)){
			$filter .= "AND a.PREFIX_BLACK_CASE = '".$request->prefixBlackCase."'";
		}
    if(!empty($request->blackCase)){
			$filter .= "AND a.BLACK_CASE = '".$request->blackCase."'";
		}
    if(!empty($request->blackYY)){
			$filter .= "AND a.BLACK_YY = '".$request->blackYY."'";
		}
    if(!empty($request->prefixRedCase)){
			$filter .= "AND a.PREFIX_RED_CASE = '".$request->prefixRedCase."'";
		}
    if(!empty($request->redCase)){
			$filter .= "AND a.RED_CASE = '".$request->redCase."'";
		}
    if(!empty($request->redYY)){
			$filter .= "AND a.RED_YY = '".$request->redYY."'";
		}

		$sql = "SELECT
            	a.*,
            	b.COURT_LEVEL,
            	b.COURT_TYPE_CODE,
            	b.COURT_TYPE_NAME,
            	b.COURT_APP_CODE,
            	b.COURT_APP_NAME,
            	b.COURT_DETAIL,
            	b.COURT_SDATE
            FROM
            	WH_BANKRUPT_CASE_DETAIL a
            	LEFT JOIN WH_BANKRUPT_COURT_ORDER b ON a.BANKRUPT_CODE = b.BANKRUPT_CODE
            WHERE 1=1 {$filter} ";
		$data = \db::query($sql);
		$i = 0;
		while($rec = \db::fetch_array($data)){

        $obj[$i]['bankruptCode'] = $rec['BANKRUPT_CODE'];
        $obj[$i]['courtCode'] = $rec['COURT_CODE'];
        $obj[$i]['courtName'] = $rec['COURT_NAME'];
        $obj[$i]['deptCode'] = $rec['DEPT_CODE'];
        $obj[$i]['deptName'] = $rec['DEPT_NAME'];
        $obj[$i]['prefixBlackCase'] = $rec['PREFIX_BLACK_CASE'];
        $obj[$i]['blackCase'] = $rec['BLACK_CASE'];
        $obj[$i]['blackYY'] = $rec['BLACK_YY'];
        $obj[$i]['prefixRedCase'] = $rec['PREFIX_RED_CASE'];
        $obj[$i]['redCase'] = $rec['RED_CASE'];
        $obj[$i]['redYY'] = $rec['RED_YY'];
        $obj[$i]['courtDate'] = $rec['COURT_DATE'];
        $obj[$i]['capitalAmount'] = $rec['CAPITAL_AMOUNT'];
        $obj[$i]['plaintiff1'] = $rec['PLAINTIFF1'];
        $obj[$i]['plaintiff2'] = $rec['PLAINTIFF2'];
        $obj[$i]['plaintiff3'] = $rec['PLAINTIFF3'];
        $obj[$i]['deffendant1'] = $rec['DEFFENDANT1'];
        $obj[$i]['deffendant2'] = $rec['DEFFENDANT2'];
        $obj[$i]['deffendant3'] = $rec['DEFFENDANT3'];
        $obj[$i]['recordCount'] = $rec['RECORD_COUNT'];
        // $obj[$i]['courtOrderList'] = $rec[''];
        // $obj[$i]['seq'] = $rec[''];
        $obj[$i]['courtLevel'] = $rec['COURT_LEVEL'];
        $obj[$i]['courtTypeCode'] = $rec['COURT_TYPE_CODE'];
        $obj[$i]['courtTypeName'] = $rec['COURT_TYPE_NAME'];
        $obj[$i]['courtAppCode'] = $rec['COURT_APP_CODE'];
        $obj[$i]['courtAppName'] = $rec['COURT_APP_NAME'];
        $obj[$i]['courtDetail'] = $rec['COURT_DETAIL'];
        $obj[$i]['courtSdate'] = $rec['COURT_SDATE'];

				$i++;
		}
		$num = count($obj);

		if($num > 0){

			$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");
			$row['Data'] = $obj;

		}else{

			$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");

		}


        return $this->respondWithData($row);
    }



}



?>
