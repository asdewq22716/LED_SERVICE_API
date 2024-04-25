<?php
declare(strict_types=1);

namespace App\Application\Actions\Api;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class CmdBankRuptAction extends Action
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
		if(!empty($request->prefixBlackCase)){
			$filter .= "AND a.T_BLACK_CASE = '".$request->prefixBlackCase."'";
		}
    if(!empty($request->blackCase)){
			$filter .= "AND a.BLACK_CASE = '".$request->blackCase."'";
		}
    if(!empty($request->blackYY)){
			$filter .= "AND a.BLACK_YY = '".$request->blackYY."'";
		}
    if(!empty($request->prefixRedCase)){
			$filter .= "AND a.T_RED_CASE = '".$request->prefixRedCase."'";
		}
    if(!empty($request->redCase)){
			$filter .= "AND a.RED_CASE = '".$request->redCase."'";
		}
    if(!empty($request->redYY)){
			$filter .= "AND a.RED_YY = '".$request->redYY."'";
		}
    if(!empty($request->courtName)){
			$filter .= "AND a.COURT_NAME Like '%".$request->courtName."%'";
		}
    if(!empty($request->toPrefixBlackCase)){
        $filter .= "AND a.TO_T_BLACK_CASE = '".$request->toPrefixBlackCase."'";
    }
    if(!empty($request->toBlackCase)){
        $filter .= "AND a.TO_BLACK_CASE = '".$request->toBlackCase."'";
    }
    if(!empty($request->toBlackYy)){
        $filter .= "AND a.TO_BLACK_YY = '".$request->toBlackYy."'";
    }

    if(!empty($request->toPrefixRedCase)){
        $filter .= "AND a.TO_T_RED_CASE = '".$request->toPrefixRedCase."'";
    }
    if(!empty($request->toRedCase)){
        $filter .= "AND a.TO_RED_CASE = '".$request->toRedCase."'";
    }
    if(!empty($request->toRedYy)){
        $filter .= "AND a.TO_RED_YY = '".$request->toRedYy."'";
    }
    if(!empty($request->toCourtName)){
        $filter .= "AND a.TO_COURT_NAME Like '%".$request->toCourtName."%'";
    }
    if(!empty($request->registerCode)){
      $filter .= "AND d.ID_CARD = '".$request->registerCode."'";
  }
  


		$sql = \db::query("SELECT
                        a.ID,
                      	a.CMD_DOC_DATE,
                      	a.CMD_DOC_TIME,
                      	a.COURT_NAME,
                      	a.F_BLACK_CASE,
                        a.T_BLACK_CASE,
                        a.BLACK_CASE,
                        a.BLACK_YY,
                      	a.F_RED_CASE,
                        a.T_RED_CASE,
                        a.RED_CASE,
                        a.RED_YY,
                      	b.CMD_GRP_NAME,
                      	c.CMD_TYPE_NAME,
                      	a.PLAINTIFF,
                      	a.DEFENDANT,
                        a.TO_COURT_NAME,
                        a.TO_T_BLACK_CASE,
                        a.TO_BLACK_CASE,
                        a.TO_BLACK_YY,
                        a.TO_T_RED_CASE,
                        a.TO_RED_CASE,
                        a.TO_RED_YY,
                        d.ID_CARD,
						e.SYS_NAME
                          
                      FROM
                      	M_DOC_CMD a
                      	LEFT JOIN M_CMD_TYPE b ON a.CMD_TYPE = b.CMD_TYPE_ID
                      	LEFT JOIN M_SERVICE_CMD c ON a.CASE_TYPE = c.CMD_TYPE_CODE
                        LEFT JOIN M_CMD_PERSON d ON a.PERSON_ID = d.PERSON_ID
						LEFT JOIN M_SYSTEM  e ON a.SEND_TO = e.SYSTEM_ID
                      WHERE
                        1=1 {$filter}
                      ORDER BY
                        a.ID");
		$i = 0;
		while($rec = \db::fetch_array($sql)){

      $obj[$i]['cmdId'] = $rec['ID'];
      $obj[$i]['cmdDate'] = db2date($rec['CMD_DOC_DATE']);
      $obj[$i]['cmdTime'] = $rec['CMD_DOC_TIME'];
      $obj[$i]['courtName'] = $rec['COURT_NAME'];
      $obj[$i]['fullBlackCase'] = $rec['F_BLACK_CASE'];
      $obj[$i]['prefixBlackCase'] = $rec['T_BLACK_CASE'];
      $obj[$i]['blackCase'] = $rec['BLACK_CASE'];
      $obj[$i]['blackYY'] = $rec['BLACK_YY'];
      $obj[$i]['fullRedCase'] = $rec['F_RED_CASE'];
      $obj[$i]['prefixRedCase'] = $rec['T_RED_CASE'];
      $obj[$i]['redCase'] = $rec['RED_CASE'];
      $obj[$i]['redYY'] = $rec['RED_YY'];
	  $obj[$i]['sysName'] = $rec['SYS_NAME'];
      $obj[$i]['cmdGroupType'] = $rec['CMD_GRP_NAME'];
      $obj[$i]['cmdType'] = $rec['CMD_TYPE_NAME'];
      $obj[$i]['plaintiff'] = $rec['PLAINTIFF'];
      $obj[$i]['defendant'] = $rec['DEFENDANT'];
      $obj[$i]['toCourtName'] = $rec['TO_COURT_NAME'];   
      $obj[$i]['toPrefixBlackCase'] = $rec['TO_T_BLACK_CASE'];
      $obj[$i]['toBlackCase'] = $rec['TO_BLACK_CASE'];
      $obj[$i]['toBlackYy'] = $rec['TO_BLACK_YY']; 
	  $obj[$i]['toPrefiRedCase'] = $rec['TO_T_RED_CASE'];
      $obj[$i]['toRedCase'] = $rec['TO_RED_CASE'];
      $obj[$i]['toRedYy'] = $rec['TO_RED_YY'];
	  $obj[$i]['registerCode'] = $rec['ID_CARD'];

      

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
