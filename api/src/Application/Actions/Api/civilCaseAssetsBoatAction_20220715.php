<?php
declare(strict_types = 1);

namespace App\Application\Actions\Api;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class civilCaseAssetsBoatAction extends Action
{
    /**
     * {isset(inheritdoc}
     */

    protected function action():
        Response
        {
            if (isset($_SERVER['HTTP_TOKENAPI']))
            { //## <- this line
                include ('lib/connect_db.php');
                include ('lib/config_db.php');

                $sql = "SELECT PERMISSION_GROUP_ID FROM USER_API_SERVICE WHERE TOKEN_ID = '" . $_SERVER['HTTP_TOKENAPI'] . "'"; //## <- this line
                $qry = \db::query($sql); //## <- this line
				$numrows = \db::num_rows($qry);
                $rec = \db::fetch_array($qry); //## <- this line
				
				$sqlres = "SELECT
									a.RESPONSE_NAME
								FROM
									M_SERVICE_RESPONSE a
								JOIN M_API_SPEC_RESPONSE b ON b.RESPONSE_ID = a.RESPONSE_ID
								WHERE
									a.SERVICE_MANAGE_ID = '17' AND b.MAPPING_API_ID = '".$rec['PERMISSION_GROUP_ID']."'";
				$qryres = \db::query($sqlres);
				$arrResponse = array();
				while($res = \db::fetch_array($qryres)){
					
					$arrResponse[$res['RESPONSE_NAME']] = $res['RESPONSE_NAME'];
					 
				}
           
               
                
                if ($numrows > 0)
                { 
                    $obj = array();
                    $row = array();

                    $request = $this->getFormData();
                    $filter = "";
                    if (!empty($request->courtCode) != '')
                    {
                        $filter .= "AND wh_case.COURT_CODE = '" . $request->courtCode . "'";
                    }
                    if (!empty($request->prefixBlackCase) != '')
                    {
                        $filter .= "AND wh_case.PREFIX_BLACK_CASE = '" . $request->prefixBlackCase . "'";
                    }
                    if (!empty($request->blackCase) != '')
                    {
                        $filter .= "AND wh_case.BLACK_CASE = '" . $request->blackCase . "'";
                    }
                    if (!empty($request->blackYY) != '')
                    {
                        $filter .= "AND wh_case.BLACK_YY = '" . $request->blackYY . "'";
                    }
                    if (!empty($request->prefixRedCase) != '')
                    {
                        $filter .= "AND wh_case.PREFIX_RED_CASE = '" . $request->prefixRedCase . "'";
                    }
                    if (!empty($request->redCase) != '')
                    {
                        $filter .= "AND wh_case.RED_CASE = '" . $request->redCase . "'";
                    }
                    if (!empty($request->redYY) != '')
                    {
                        $filter .= "AND wh_case.RED_YY = '" . $request->redYY . "'";
                    }

                    if (!empty($request->assetId) != '')
                    {
                        $filter .= "AND boat.ASSET_ID = '" . $request->assetId . "'";
                    }

                    //  $request->registerCode
                    $sql = "SELECT 
        wh_case.COURT_CODE AS courtCode,
        wh_case.COURT_NAME AS courtName,
        wh_case.DEPT_CODE AS deptCode,
        wh_case.DEPT_NAME AS deptName,
        wh_case.PREFIX_BLACK_CASE AS prefixBlackCase,
        wh_case.BLACK_CASE AS blackCase,
        wh_case.BLACK_YY AS blackYY,
        wh_case.PREFIX_RED_CASE AS prefixRedCase,
        wh_case.RED_CASE AS redCase,
        wh_case.RED_YY AS redYY,
        boat.ASSET_CODE AS assetCode,
        boat.ASSET_STATUS AS assetStatus,
        boat.BOAT_NO AS boatNo,
        boat.BOAT_NAME AS boatName,
        boat.PRICE AS price,
		wh_case.CIVIL_CODE AS civilCode,
		map.PROP_TITLE AS propStatus,
		wcd.DOSS_OWNER_NAME AS ownerName,
		wh_case.WH_CIVIL_ID AS civilId
        FROM
			WH_CIVIL_CASE wh_case
		 LEFT JOIN WH_CIVIL_CASE_ASSETS map ON wh_case.WH_CIVIL_ID = map.WH_CIVIL_ID
		 LEFT JOIN WH_CIVIL_CASE_ASSET_OWNER c ON map.WH_ASSET_ID = c.WH_ASSET_ID
		 LEFT JOIN WH_CIVIL_CASE_ASSETS_BOAT boat ON map.ASSET_ID = boat.ASSET_CODE
		 LEFT JOIN WH_CIVIL_DOSS wcd ON wh_case.WH_CIVIL_ID = wcd.WH_CIVIL_ID AND wcd.DOSS_CODE = '101'
        WHERE 1=1 {$filter} ";

                    $data = \db::query($sql);
                    $array_obj = array();
                    while ($rec = \db::fetch_array($data))
                    {

                        $array_obj['courtCode'] = $rec['COURTCODE'];
                        $array_obj['courtName'] = $rec['COURTNAME'];
                        $array_obj['deptCode'] = $rec['DEPTCODE'];
                        $array_obj['deptName'] = $rec['DEPTNAME'];
                        $array_obj['prefixBlackCase'] = $rec['PREFIXBLACKCASE'];
                        $array_obj['blackCase'] = $rec['BLACKCASE'];
                        $array_obj['blackYY'] = $rec['BLACKYY'];
                        $array_obj['prefixRedCase'] = $rec['PREFIXREDCASE'];
                        $array_obj['redCase'] = $rec['REDCASE'];
                        $array_obj['redYY'] = $rec['REDYY'];
                        $array_obj['assetCode'] = $rec['ASSETCODE'];
                        $array_obj['assetId'] = $rec['ASSETID'];
                        $array_obj['assetStatus'] = $rec['ASSETSTATUS'];
                        $array_obj['boatNo'] = $rec['BOATNO'];
                        $array_obj['boatName'] = $rec['BOATNAME'];
                        $array_obj['price'] = $rec['PRICE'];
                        $array_obj['propStatus'] = $rec['PROPSTATUS'];
                        $array_obj['ownerName'] = $rec['OWNERNAME'];
                        $array_obj['propStatus'] = $rec['PROPSTATUS'];
                        $array_obj['ownerName'] = $rec['OWNERNAME'];
                        $array_obj['civilCode'] = $rec['CIVILCODE'];

                        $array_holing = array();

                        $sql_holing = "SELECT DISTINCT cmg.CONCERN_NAME AS concernName,
				ccp.FULL_NAME as holdingName,
				c.HOLDING_AMOUNT as holdingAmount,c.HOLDING_TYPE as holdingType
				FROM WH_CIVIL_CASE_MAP_GEN cmg LEFT JOIN WH_CIVIL_CASE_PERSON ccp ON cmg.WH_PERSON_ID = ccp.WH_PERSON_ID LEFT JOIN WH_CIVIL_CASE_ASSET_OWNER c ON c.WH_MAP_CASE_GEN_ID = cmg.WH_MAP_CASE_GEN_ID WHERE cmg.CONCERN_CODE NOT IN (01,02) AND cmg.WH_CIVIL_ID = '" . $rec['CIVILID'] . "'";
                        $data2 = \db::query($sql_holing);

                        while ($rec2 = \db::fetch_array($data2))
                        {
                            $array = array();
                            $array['concernName'] = $rec2['CONCERNNAME'];
                            $array['holdingType'] = $rec2['HOLDINGTYPE'];
                            $array['holdingName'] = $rec2['HOLDINGNAME'];
                            $array['holdingAmount'] = $rec2['HOLDINGAMOUNT'];
                            array_push($array_holing,array_intersect_key($array,$arrResponse));
						}
						$array_obj['holdingPerson'] = $array_holing;
						if(count($array_holing) > 0 ){
							$arrResponse['holdingPerson'] = 'holdingPerson';
						}
							

                        array_push($obj,array_intersect_key($array_obj,$arrResponse));

                    }
                    $num = count($obj);

                    if ($num > 0)
                    {

                        $row['ResponseCode'] = array(
                            'ResCode' => '000',
                            'ResMeassage' => "SUCCESS"
                        );
                        $row['Data'] = $obj;

                    }
                    else
                    {

                        $row['ResponseCode'] = array(
                            'ResCode' => '102',
                            'ResMeassage' => "NOT FOUND"
                        );

                    }
                }
                else
                { 
                    $row['ResponseCode'] = array(
                        'ResCode' => '401',
                        'ResMeassage' => "Unauthorized"
                    ); 
                    
                } 
                
            }
            else
            { 
                $row['ResponseCode'] = array(
                    'ResCode' => '401',
                    'ResMeassage' => "Unauthorized"
                ); 
                
            } 
            

            return $this->respondWithData($row);
        }

    }

?>
