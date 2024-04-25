<?php
declare(strict_types=1);

namespace App\Application\Actions\Api;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class bankruptAssetsFundAction extends Action
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
    if(!empty($request->registerCode)){
			$filter .= "AND c.REGISTER_CODE = '".$request->registerCode."'";
		}
    if(!empty($request->assetId)){
			$filter .= "AND e.ASSET_ID = '".$request->assetId."'";
		}

        //  $request->registerCode

		$sql = "SELECT
            	e.*
            FROM
            	WH_BANKRUPT_CASE_DETAIL a
            	LEFT JOIN WH_BANKRUPT_MAP_CASE b ON a.BANKRUPT_CODE = b.BANKRUPT_CODE
            	LEFT JOIN WH_BANKRUPT_CASE_PERSON c ON b.BANKRUPT_CODE = c.BANKRUPT_CODE
            	LEFT JOIN WH_BANKRUPT_MAPPING_ASSETS d ON b.ASS_ASSET_ID = d.ASS_ASSET_ID
            	LEFT JOIN WH_BANKRUPT_ASSETS_FUND e ON d.WH_ASS_ID = e.ASSET_ID
            WHERE 1=1 {$filter} ";
		$data = \db::query($sql);
		$i = 0;
		while($rec = \db::fetch_array($data)){

        $obj[$i]['assetDetial'] = $rec['ASSET_DETAIL'];
        $obj[$i]['assetCode'] = $rec['ASSET_CODE'];
        $obj[$i]['assetId'] = $rec['ASSET_ID'];
        $obj[$i]['assetStatus'] = $rec['ASSET_STATUS'];
        // $obj[$i]['stockKind'] = $rec[''];
        $obj[$i]['fundNo'] = $rec['FUND_NO'];
        $obj[$i]['fundAmount'] = $rec['FUND_AMOUNT'];
        $obj[$i]['ownerFund'] = $rec['OWNER_FUND'];
        $obj[$i]['tumCode'] = $rec['TUM_CODE'];
        $obj[$i]['tumName'] = $rec['TUM_NAME'];
        $obj[$i]['ampCode'] = $rec['AMP_CODE'];
        $obj[$i]['ampName'] = $rec['AMP_NAME'];
        $obj[$i]['provCode'] = $rec['PROV_CODE'];
        $obj[$i]['provName'] = $rec['PROV_NAME'];
        $obj[$i]['zipCode'] = $rec['ZIP_CODE'];
        $obj[$i]['detail'] = $rec['DETAIL'];
        $obj[$i]['price'] = $rec['PRICE'];
        $obj[$i]['seq'] = $rec['SEQ'];

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
