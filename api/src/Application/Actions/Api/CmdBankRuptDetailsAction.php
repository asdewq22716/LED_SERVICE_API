<?php
declare(strict_types=1);

namespace App\Application\Actions\Api;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class CmdBankRuptDetailsAction extends Action
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
			$filter .= "AND a.COURT_NAME = '".$request->courtName."'";
		}
    if(!empty($request->cmdId)){
			$filter .= "AND a.ID = '".$request->cmdId."'";
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
                      	a.DEFENDANT
                      FROM
                      	M_DOC_CMD a
                      	LEFT JOIN M_CMD_TYPE b ON a.CMD_TYPE = b.CMD_TYPE_ID
                      	LEFT JOIN M_SERVICE_CMD c ON a.CASE_TYPE = c.CMD_TYPE_CODE
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
      $obj[$i]['cmdGroupType'] = $rec['CMD_GRP_NAME'];
      $obj[$i]['cmdType'] = $rec['CMD_TYPE_NAME'];
      $obj[$i]['plaintiff'] = $rec['PLAINTIFF'];
      $obj[$i]['defendant'] = $rec['DEFENDANT'];
      $id[$i] = $rec['ID'];

      $i++;
		}

    foreach($id as $key => $value){
      $a = $b = $c = $d = 0;
      $assetId = array();
      $qry_de = \db::query("SELECT CMD_DETAIL_DATE, CMD_DETAIL_TIME, CMD_NOTE FROM M_CMD_DETAILS WHERE CMD_ID = '".$value."'");
      while($details = \db::fetch_array($qry_de)){

        $obj[$key]['details'][$a]['detailsDate'] = db2date($details['CMD_DETAIL_DATE']);
        $obj[$key]['details'][$a]['detailsTime'] = $details['CMD_DETAIL_TIME'];
        $obj[$key]['details'][$a]['cmdDetails'] = $details['CMD_NOTE'];
        $a++;
      }

      $qry_asset = \db::query("SELECT CMD_ASSET_ID, PROP_DET, RATIO, TYPE_DESC, PROP_STATUS_NAME, CREATE_DATE, CREATE_TIME,TYPE_CODE, PROP_STATUS
                               FROM M_CMD_ASSET
                               WHERE CMD_ID = '".$value."'");
      while ($asset = \db::fetch_array($qry_asset)) {
        $obj[$key]['asset'][$b]['createDate'] = db2date($asset['CREATE_DATE']);
        $obj[$key]['asset'][$b]['createTime'] = $asset['CREATE_TIME'];
        $obj[$key]['asset'][$b]['propDet'] = $asset['PROP_DET'];
        $obj[$key]['asset'][$b]['ratio'] = $asset['RATIO'];
        $obj[$key]['asset'][$b]['typeCode'] = $asset['TYPE_CODE'];
        $obj[$key]['asset'][$b]['typeDesc'] = $asset['TYPE_DESC'];
        $obj[$key]['asset'][$b]['propStatusCode'] = $asset['PROP_STATUS'];
        $obj[$key]['asset'][$b]['propStatusName'] = $asset['PROP_STATUS_NAME'];
        $assetId[$key] = $asset['CMD_ASSET_ID'];
        $b++;
      }

      foreach ($assetId as $k => $v) {
        $qry_assetDe = \db::query("SELECT a.CREATE_DATE, a.CREATE_TIME, a.REMARK, b.CMD_GRP_NAME, c.CMD_TYPE_NAME
                                   FROM M_CMD_LIST_ASSET a
                                   LEFT JOIN M_CMD_TYPE b ON a.CMD_TYPE = b.CMD_TYPE_ID
                                   LEFT JOIN M_SERVICE_CMD c ON a.SERVICE_CMD = c.CMD_TYPE_CODE
                                   WHERE CMD_ASSET_ID = '".$v."'");
        while ($assetDetails = \db::fetch_array($qry_assetDe)) {
          $obj[$key]['asset'][$k]['assetDetails'][$c]['createDate'] = db2date($assetDetails['CREATE_DATE']);
          $obj[$key]['asset'][$k]['assetDetails'][$c]['createTime'] = $assetDetails['CREATE_TIME'];
          $obj[$key]['asset'][$k]['assetDetails'][$c]['remark'] = $assetDetails['REMARK'];
          $obj[$key]['asset'][$k]['assetDetails'][$c]['cmdGroupType'] = $assetDetails['CMD_GRP_NAME'];
          $obj[$key]['asset'][$k]['assetDetails'][$c]['cmdType'] = $assetDetails['CMD_TYPE_NAME'];
          $c++;
        }
      }

      $qry_file = \db::query("SELECT DEPT_CODE, E_DOCUMENT_GEN, E_DOCUMENT_NAME, E_DOCUMENT_REMARK, E_DOCUMENT_URL, CREATE_DATE, CREATE_TIME, DOSS_CONTROL_ID
                              FROM M_CMD_FILE
                              WHERE CMD_ID = '".$value."'");
      while ($file = \db::fetch_array($qry_file)) {
        $obj[$key]['files'][$d]['createDate'] = db2date($file['CREATE_DATE']);
        $obj[$key]['files'][$d]['createTime'] = $file['CREATE_TIME'];
        $obj[$key]['files'][$d]['deptCode'] = $file['DEPT_CODE'];
        $obj[$key]['files'][$d]['eDocGen'] = $file['E_DOCUMENT_GEN'];
        $obj[$key]['files'][$d]['eDocName'] = $file['E_DOCUMENT_NAME'];
        $obj[$key]['files'][$d]['eDocRemark'] = $file['E_DOCUMENT_REMARK'];
        $obj[$key]['files'][$d]['eDocUrl'] = $file['E_DOCUMENT_URL'];
        $obj[$key]['files'][$d]['dossControlId'] = $file['DOSS_CONTROL_ID'];
        $d++;
      }
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
