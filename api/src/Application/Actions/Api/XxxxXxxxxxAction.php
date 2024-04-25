<?php
declare(strict_types=1);

namespace App\Application\Actions\Api;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class CheckAssetAction extends Action
{ 
    /**
     * {isset(inheritdoc}
     */	 
 
    protected function action(): Response 
    {        
 
		include('../../include/connect_db.php');
		include('../../function/config_db.php');
		$obj = array();
		$row = array();
		 
		$request = $this->getFormData();
		$filter = "";
		if(!empty($request->courtCode) !='' ){
			$filter .= "AND b.DFR_CODE = '".$request->courtCode."'";
		}
		if(!empty($request->courtName) !='' ){
			$filter .= "AND b.DFR_NAME LIKE '%".$request->courtName."%'";
		}
		if(!empty($request->prefixBlackCase) !='' && $request->blackCase !=''){
			
			$prefix = $request->prefixBlackCase;
			$Case = $request->blackCase;
			$filter .= "AND BRC_BLACK_CASE = '". $prefix.$Case ."'";
		}
		if(!empty($request->blackYy) !='' ){
			$filter .= "AND BRC_BLACK_YEAR = '".$request->blackYy."'";
		}
		if(!empty($request->prefixRedCase) !='' && !empty($request->redCase) !=''){
			$prefix = $request->prefixRedCase;
			$Case = $request->redCase;
			$filter .= "AND BRC_RED_CASE = '". $prefix.$Case ."'";
		}
		if(!empty($request->redYy) !='' ){
			$filter .= "AND BRC_RED_YEAR = '".$request->redYy."'";
		}
		$sql = "SELECT
        a.BRC_ID_PK AS BankruptCode,
        b.DFR_CODE AS CourtCode,
        b.DFR_NAME AS CourtName,
        c.DEP_CODE AS DeptCode,
        c.DEP_NAME AS DeptName,
        SUBSTR(BRC_BLACK_CASE, 1, 4) AS PrefixblackCase,
        SUBSTR(BRC_BLACK_CASE, INSTR(BRC_BLACK_CASE, '.') + 1) AS BlackCase,
        BRC_BLACK_YEAR AS BlackYY,
        SUBSTR(BRC_RED_CASE, 1, 4) AS PrefixRedCase,
        SUBSTR(BRC_RED_CASE, INSTR(BRC_RED_CASE, '.') + 1) AS RedCase,
        BRC_RED_YEAR AS RedYY,
        a.BRC_LODGE_DATE AS CourtDate,
        a.BRC_PROPERTY_NUM AS CapitalAmount
        FROM BR.BRC_BRCASE a JOIN BR.REF_DOCUMENT_FROM_DETAIL b ON a.BRC_DFR_ID_FK = b.DFR_ID_PK
        JOIN BR.REF_DEPARTMENT c ON a.BRC_DEP_OWNER_ID_FK = c.DEP_ID_PK
        WHERE 1=1 {$filter} AND a.BRC_ID_PK IS NOT NULL
		--AND a.BRC_CREATE_DATE BETWEEN  '2020-01-01' AND  '2020-12-31'
        ORDER BY a.BRC_BLACK_YEAR, a.BRC_BLACK_CASE ";
		$stmt = \db::query($sql);
		$i = 0;
		while($rec = \db::fetch_array($stmt)){

				
				
				$obj[$i]['bankruptCode'] = $rec['BANKRUPTCODE'];
				$obj[$i]['courtCode'] = $rec['COURTCODE'];
				$obj[$i]['courtName'] = $rec['COURTNAME'];
				$obj[$i]['deptCode'] = $rec['DEPTCODE'];
				$obj[$i]['deptName'] = $rec['DEPTNAME'];
				$obj[$i]['prefixBlackCase'] = $rec['PREFIXBLACKCASE'];
				$obj[$i]['blackCase'] = $rec['BLACKCASE'];
				$obj[$i]['blackYY'] = $rec['BLACKYY'];
				$obj[$i]['prefixRedCase'] = $rec['PREFIXREDCASE'];
				$obj[$i]['redCase'] = $rec['REDCASE'];
				$obj[$i]['redYY'] = $rec['REDYY'];
				$obj[$i]['courtDate'] = $rec['COURTDATE'];
				$obj[$i]['capitalAmount'] = $rec['CAPITALAMOUNT'];
							
			$s2 = "SELECT
						a.DOP_PLAINTIFF_JOIN_FLAG as plaintiffJoinFlag,
						d.PER_FULLNAME AS plaintiffFullName,
						a.DOP_PLAINTIFF_DESC as plaintiffDesc,
						e.TTL_NAME as titleName,
						d.PER_FIRSTNAME as firstName,
						d.PER_LASTNAME as lastName,
						a.DOP_COURT_SEQ as courtSeq
						FROM
						BR.BRC_BRCASE_PARTY a
						LEFT JOIN BR.BRC_BRCASE b ON
						a.DOP_BRC_ID_FK = b.BRC_ID_PK
						LEFT JOIN BR.REF_PARTY_TYPE c ON
						a.DOP_PTY_ID_FK = c.PRE_ID_PK
						LEFT JOIN BR.MAS_PARTY d ON  
						a.DOP_PER_ID_FK = d.PER_ID_PK
						LEFT JOIN BR.REF_TITLE e ON
						d.PER_TTL_ID_FK = e.TTL_ID_PK
						WHERE
						b.BRC_ID_PK IS NOT NULL
						AND a.DOP_STATUS != 'C'
						AND c.PRE_CODE IN ( '01' , '20' )
						AND a.DOP_PLAINTIFF_COURT_FLAG = 1 
						AND  b.BRC_ID_PK = '".$rec['BANKRUPTCODE']."'";
			$q2 = \db::query($s2);
			$n = 1;
			while($r2 = \db::fetch_array($q2)){
				// $obj[$i]['plaintiff'.$n] = $r2['PLAINTIFFFULLNAME'];
				$obj[$i]['plaintiff'][] = $r2['PLAINTIFFFULLNAME'];
				$n++;
			}
			
						$s1 = "SELECT
						a.DOP_PLAINTIFF_JOIN_FLAG as deffendantJoinFlag,
						d.PER_FULLNAME AS deffendantFullName,
						a.DOP_PLAINTIFF_DESC as deffendantDesc,
						e.TTL_NAME as titleName,
						d.PER_FIRSTNAME as firstName,
						d.PER_LASTNAME as lastName,
						a.DOP_COURT_SEQ as courtSeq,
						d.PER_COMPANY_CODE as perCompanyCode,
						d.PER_IDCARD as perIdcard
						FROM
						BR.BRC_BRCASE_PARTY a
						LEFT JOIN BR.BRC_BRCASE b ON
						a.DOP_BRC_ID_FK = b.BRC_ID_PK
						LEFT JOIN BR.REF_PARTY_TYPE c ON
						a.DOP_PTY_ID_FK = c.PRE_ID_PK
						LEFT JOIN BR.MAS_PARTY d ON
						a.DOP_PER_ID_FK = d.PER_ID_PK
						LEFT JOIN BR.REF_TITLE e ON
						d.PER_TTL_ID_FK = e.TTL_ID_PK
						WHERE
						b.BRC_ID_PK IS NOT NULL
						AND a.DOP_STATUS != 'C'
						AND c.PRE_CODE IN ( 06 , '21', '23' ) 
						AND  b.BRC_ID_PK = '".$rec['BANKRUPTCODE']."'";
			$q1 = \db::query($s1);
			$n = 1;
			while($r1 = \db::fetch_array($q1)){
				// $obj[$i]['deffendant'.$n] = $r1['DEFFENDANTFULLNAME'];
				$obj[$i]['deffendant'][] = $r1['DEFFENDANTFULLNAME'];
				$n++;
			}
				
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