<?php
declare(strict_types = 1);

namespace App\Application\Actions\Api;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class civilCaseAssetsFundAction extends Action
{
    /**
     * {isset(inheritdoc}
     */

    protected function action():
        Response
        {

            if (isset($_SERVER['HTTP_TOKENAPI']))
            {
                include ('lib/connect_db.php');
                include ('lib/config_db.php');

                $sql = "SELECT COUNT(*) NR FROM USER_API_SERVICE WHERE TOKEN_ID = '" . $_SERVER['HTTP_TOKENAPI'] . "'"; ### <- this line
                $qry = \db::query($sql);
                $rec = \db::fetch_array($qry);

                if ($rec['NR'] > 0)
                {
                    $obj = array();
                    $row = array();

                    $request = $this->getFormData();
                    $filter = "";
                    if (!empty($request->courtCode) != '')
                    {
                        $filter .= "AND A.COURT_CODE = '" . $request->courtCode . "'";
                    }
                    if (!empty($request->prefixBlackCase) != '')
                    {
                        $filter .= "AND A.PREFIX_BLACK_CASE = '" . $request->prefixBlackCase . "'";
                    }
                    if (!empty($request->blackCase) != '')
                    {
                        $filter .= "AND A.BLACK_CASE = '" . $request->blackCase . "'";
                    }
                    if (!empty($request->blackYY) != '')
                    {
                        $filter .= "AND A.BLACK_YY = '" . $request->blackYY . "'";
                    }
                    if (!empty($request->prefixRedCase) != '')
                    {
                        $filter .= "AND A.PREFIX_RED_CASE = '" . $request->prefixRedCase . "'";
                    }
                    if (!empty($request->redCase) != '')
                    {
                        $filter .= "AND A.RED_CASE = '" . $request->redCase . "'";
                    }
                    if (!empty($request->redYY) != '')
                    {
                        $filter .= "AND A.RED_YY = '" . $request->redYY . "'";
                    }

                    if (!empty($request->assetId) != '')
                    {
                        $filter .= "AND B.CFC_FUND_GEN = '" . $request->assetId . "'";
                    }

                    //  $request->registerCode
                    /* $sql = "SELECT 
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
                                -- AS recodeCount,
                                -- AS assetDetail,
                                fund.ASSET_CODE AS assetCode,
                                fund.ASSET_ID AS assetId,
                                fund.ASSET_STATUS AS assetStatus,
                                fund.FUND_NO AS fundNo,
                                fund.FUND_AMOUNT AS fundAmount,
                                -- As price,
                                wh_case.CIVIL_CODE AS civilCode,
                                map.PROP_TITLE AS propStatus, 
                                wcd.DOSS_OWNER_NAME AS ownerName,
                                wh_case.WH_CIVIL_ID AS civilId
                                    

                                FROM
                                    WH_CIVIL_CASE wh_case
                                LEFT JOIN WH_CIVIL_CASE_ASSETS map ON wh_case.WH_CIVIL_ID = map.WH_CIVIL_ID
                                LEFT JOIN WH_CIVIL_CASE_ASSET_OWNER c ON map.WH_ASSET_ID = c.WH_ASSET_ID
                                LEFT JOIN WH_CIVIL_CASE_ASSETS_FUND fund ON map.ASSET_ID = fund.ASSET_CODE
                                LEFT JOIN WH_CIVIL_DOSS wcd ON wh_case.WH_CIVIL_ID = wcd.WH_CIVIL_ID AND wcd.DOSS_CODE = '101'
                                WHERE 1=1 {$filter} "; */
                    $sql = "SELECT
                                A.COURT_CODE,
                                A.PREFIX_BLACK_CASE,
                                A.BLACK_CASE,
                                A.BLACK_YY,
                                A.PREFIX_RED_CASE,
                                A.RED_CASE,
                                A.RED_YY,
                                B.CFC_FUND_GEN,
                                B.FUND_TYPE,
                                B.COMPANY_GEN,
                                B.FUND_NAME,
                                B.MANAGER_FUND_NAME,
                                B.HOLDER_LICENSE_NO,
                                B.FUND_QTY,
                                B.FUND_DATE,
                                B.FUND_RIGHT,
                                B.FUND_COMMENT,
                                B.EST_PRICE_AMOUNT,
                                B.KEEP_PERSON_GEN,
                                B.COMMIT_FLAG,
                                B.COMMIT_DESC,
                                B.CENT_DEPT_GEN,
                                B.CREATE_BY_USERID,
                                B.CREATE_DATE,
                                B.UPDATE_BY_USERID,
                                B.UPDATE_DATE,
                                B.CREATE_BY_PROGID,
                                B.UPDATE_BY_PROGID,
                                B.VERSION,
                                B.DATA_ID,
                                B.USER_DEPT_CODE,
                                B.DPD_STRUCTURE_GEN,
                                B.LICENSE_FLAG,
                                B.DIAGRAM_FLAG,
                                B.B_RIGHT_FLAG,
                                B.MAP_FLAG,
                                B.ESTIMATE_COST_FLAG,
                                B.CONTRACT_FLAG,
                                B.PICTURE_FLAG,
                                B.B_CONTRACT_FLAG,
                                B.OTHER_DOC_FLAG,
                                B.OTHER_DOC_DESC,
                                B.FUND_VALUE,
                                B.FUND_REGISTRATION_FLAG,
                                B.HOLDER_NAME,
                                B.WH_CIVIL_ID,
                                map.WH_ASSET_ID
                            FROM
                                WH_CIVIL_CASE A
                            INNER JOIN WH_CIVIL_CASE_ASSETS map ON A.WH_CIVIL_ID = map.WH_CIVIL_ID
                            INNER JOIN WH_CIVIL_CASE_ASSETS_FUND B ON A .WH_CIVIL_ID = B.WH_CIVIL_ID
                            WHERE
                                1 = 1 {$filter}";
                    $data = \db::query($sql);
                    $array_obj = array();
                    while ($rec = \db::fetch_array($data)) {
                        unset($array_obj);
                        $array_obj['courtCode'] = $rec['COURT_CODE'];
                        $array_obj['prefixBlackCase'] = $rec['PREFIX_BLACK_CASE'];
                        $array_obj['blackCase'] = $rec['BLACK_CASE'];
                        $array_obj['blackYY'] = $rec['BLACK_YY'];
                        $array_obj['prefixRedCase'] = $rec['PREFIX_RED_CASE'];
                        $array_obj['redCase'] = $rec['RED_CASE'];
                        $array_obj['redYY'] = $rec['RED_YY'];
                       //$array_obj['cfcFundGen']       = $rec['CFC_FUND_GEN'];
                        $array_obj['fundType']       = $rec['FUND_TYPE'];
                        $array_obj['companyGen']        = $rec['COMPANY_GEN'];
                        $array_obj['fundName']        = $rec['FUND_NAME'];
                        $array_obj['managerFundName'] = $rec['MANAGER_FUND_NAME'];
                        $array_obj['holderLicenseNo']       = $rec['HOLDER_LICENSE_NO'];
                        $array_obj['fundQty']         = $rec['FUND_QTY'];
                        $array_obj['fundDate']   = $rec['FUND_DATE'];
                        $array_obj['fundRight']         = $rec['FUND_RIGHT'];
                        $array_obj['fundComment']           = $rec['FUND_COMMENT'];
                        $array_obj['estPriceAmount']       = $rec['EST_PRICE_AMOUNT'];
                        $array_obj['keepPersonGen']         = $rec['KEEP_PERSON_GEN'];
                        $array_obj['commitFlag']     = $rec['COMMIT_FLAG'];
                        $array_obj['commitDesc']        	= $rec['COMMIT_DESC'];
                        $array_obj['centDeptGen']      = $rec['CENT_DEPT_GEN'];
                       // $array_obj['createByUserid']   	= $rec['CREATE_BY_USERID'];
                       // $array_obj['createDate']   	= $rec['CREATE_DATE'];
                       // $array_obj['updateByUserid']       = $rec['UPDATE_BY_USERID'];
                       // $array_obj['updateDate']       = $rec['UPDATE_DATE'];
                       // $array_obj['createByProgid']       = $rec['CREATE_BY_PROGID'];
                       // $array_obj['updateByProgid']       = $rec['UPDATE_BY_PROGID'];
                      //  $array_obj['version']       = $rec['VERSION'];
                      //  $array_obj['dataId']       = $rec['DATA_ID'];
                        $array_obj['userDeptCode']       = $rec['USER_DEPT_CODE'];
                        $array_obj['dpdStructureGen']       = $rec['DPD_STRUCTURE_GEN'];
                        $array_obj['licenseFlag']       = $rec['LICENSE_FLAG'];
                        $array_obj['diagramFlag']       = $rec['DIAGRAM_FLAG'];
                        $array_obj['bRightFlag']       = $rec['B_RIGHT_FLAG'];
                        $array_obj['mapFlag']       = $rec['MAP_FLAG'];
                        $array_obj['estimateCostFlag']       = $rec['ESTIMATE_COST_FLAG'];
                        $array_obj['contractFlag']       = $rec['CONTRACT_FLAG'];
                        $array_obj['pictureFlag']       = $rec['PICTURE_FLAG'];
                        $array_obj['bContractFlag']       = $rec['B_CONTRACT_FLAG'];
                        $array_obj['otherDocFlag']       = $rec['OTHER_DOC_FLAG'];
                        $array_obj['otherDocDesc']       = $rec['OTHER_DOC_DESC'];
                        $array_obj['fundValue']       = $rec['FUND_VALUE'];
                        $array_obj['fundRegistrationFlag']       = $rec['FUND_REGISTRATION_FLAG'];
                        $array_obj['holderName']       = $rec['HOLDER_NAME'];
                       // $array_obj['whCivilId']       = $rec['WH_CIVIL_ID'];
                        
                        $sqlSelectDataDetail = "SELECT * FROM WH_CIVIL_CASE_ASSET_OWNER WHERE 1=1 AND ASSET_ID = '" . $rec['CFC_FUND_GEN'] . "' AND WH_ASSET_ID = '" . $rec['WH_ASSET_ID'] . "' ";
                        $dataSelectDataDetail = \db::query($sqlSelectDataDetail);
                        $arrDataDetail = array();
                        while ($recSelectDataDetail = \db::fetch_array($dataSelectDataDetail)) {
                            $arrDataDetail[] = array(
                                                    "registerid" 	=> $recSelectDataDetail["REGISTERID"],
                                                    "personName" 	=> $recSelectDataDetail["PERSON_NAME"],
                                                    "concernname" 	=> $recSelectDataDetail["CONCERNNAME"],
                                                    "holdingAmount" => $recSelectDataDetail["HOLDING_AMOUNT"],
                                                );
                        }
                        //if(count($arrDataDetail)>0){
                            $array_obj["assetOwner"] = $arrDataDetail;
                        //}
                       
                        array_push($obj,$array_obj);
                    }
                    $num = count($obj);
                   /*  print_r($num);
                    exit; */
                    if ($num > 0){

                        $row['ResponseCode'] = array(
                            'ResCode' => '000',
                            'ResMeassage' => "SUCCESS"
                        );
                        $row['Data'] = $obj;

                    }else{

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
