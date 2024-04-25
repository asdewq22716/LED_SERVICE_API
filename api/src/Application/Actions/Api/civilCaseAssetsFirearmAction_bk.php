<?php
declare (strict_types = 1);

namespace App\Application\Actions\Api;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class civilCaseAssetsFirearmAction extends Action
{
    /**
     * {isset(inheritdoc}
     */

    protected function action(): Response
    {
        include 'lib/connect_db.php';
        include 'lib/config_db.php';

        $request = $this->getFormData();

        if (!\db::api_authen($request, $this->request->getUri())) {
            $row['ResponseCode'] = array('ResCode' => '401', 'ResMeassage' => \db::$_api_message);
            return $this->respondWithData($row);
        }

        if (!empty($request->logType) == '') {

            $sql = \db::query("SELECT MAX(LOG_ID) AS LOG FROM M_LOG");
            $maxid = \db::fetch_array($sql);
            $id = $maxid['LOG'] + 1;

            $sql2 = \db::query("SELECT MAX(RESPONSE_LOG_ID) AS LOG FROM M_LOG_RESPONSE");
            $maxid2 = \db::fetch_array($sql2);
            $responid = $maxid2['LOG'] + 1;

            $sql1 = \db::query("SELECT MAX(REQUEST_LOG_ID) AS LOG FROM M_LOG_REQUEST");
            $maxid1 = \db::fetch_array($sql1);
            $requestid = $maxid1['LOG'] + 1;

            $sqlid = "SELECT *  FROM USER_API_SERVICE WHERE TOKEN_ID = '" . $_SERVER['HTTP_TOKENAPI'] . "'";
            $qryid = \db::query($sqlid);
            $recid = \db::fetch_array($qryid);

            $date = date('Y-m-d');
            $time = date('h:i:s');
            $logdate = $date . ' ' . $time;
            $token = $_SERVER['HTTP_TOKENAPI'];
            $usr = $recid['USR_ID'];
            $idcard = $recid['ID_CARD'];
            $depid = $recid['SYSTEM_TYPE'];

            $query = \db::query("INSERT INTO M_LOG (LOG_ID,IP_ADDRESS,EVENT_CODE,TOKEN_ID,DEP_ID,REQUEST,LOG_DATE,USR_ID,REQUEST_STATUS,USR_IDCARD,LOG_TYPE)
                        VALUES ($id,'','','" . $token . "','" . $depid . "','civilCaseAssetsFirearmAction',TO_DATE('" . $logdate . "' , 'YYYY/MM/DD hh24:mi:ss'),'" . $usr . "','200','" . $idcard . "','2')");

            foreach ($request as $key => $value) {

                $query1 = \db::query("INSERT INTO M_LOG_REQUEST (REQUEST_LOG_ID,LOG_ID,REQUEST_NAME,REQUEST_DATA)
                            VALUES ($requestid,$id,'" . $key . "','" . $value . "')");
                $requestid++;
            }

        }

        $obj = array();
        $row = array();
        $filter = "";
        if (!empty($request->courtCode) != '') {
            $filter .= "AND wh_case.COURT_CODE = '" . $request->courtCode . "'";
        }
        if (!empty($request->prefixBlackCase) != '') {
            $filter .= "AND wh_case.PREFIX_BLACK_CASE = '" . $request->prefixBlackCase . "'";
        }
        if (!empty($request->blackCase) != '') {
            $filter .= "AND wh_case.BLACK_CASE = '" . $request->blackCase . "'";
        }
        if (!empty($request->blackYY) != '') {
            $filter .= "AND wh_case.BLACK_YY = '" . $request->blackYY . "'";
        }
        if (!empty($request->prefixRedCase) != '') {
            $filter .= "AND wh_case.PREFIX_RED_CASE = '" . $request->prefixRedCase . "'";
        }
        if (!empty($request->redCase) != '') {
            $filter .= "AND wh_case.RED_CASE = '" . $request->redCase . "'";
        }
        if (!empty($request->redYY) != '') {
            $filter .= "AND wh_case.RED_YY = '" . $request->redYY . "'";
        }
        if (!empty($request->assetId) != '') {
            $filter .= "AND gun.CFC_GUN_GEN = '" . $request->assetId . "'";
        }
        if (!empty($request->gunNo) != '') {
            $filter .= "AND gun.GUN_NO = '" . $request->gunNo . "'";
        }

        //  $request->registerCode
        $sql = "SELECT
                    wh_case.COURT_CODE,
                    wh_case.PREFIX_BLACK_CASE,
                    wh_case.BLACK_CASE,
                    wh_case.BLACK_YY,
                    wh_case.PREFIX_RED_CASE,
                    wh_case.RED_CASE,
                    wh_case.RED_YY,
                    gun.CFC_GUN_GEN AS cfcGunGen,
                    gun.CFC_CIVIL_GEN AS cfcCivilGen,
                    gun.CFC_GUN_REQ_GEN AS cfcGunReqGen,
                    gun.SEQ_NO AS seqNo,
                    gun.LICENSE_NO AS licenseNo,
                    gun.LICENSE_YR AS licenseYr,
                    gun.LICENSE_PLACE AS licensePlace,
                    gun.LICENSE_DATE AS licenseDate,
                    gun.TYPE_DESC AS typeDesc,
                    gun.GUN_SIZE AS gunSize,
                    gun.GUN_NO AS gunNo,
                    gun.MAKE_PERSON AS makePerson,
                    gun.GUN_SIGN AS gunSign,
                    gun.FROM_PERSON AS fromPerson,
                    gun.BULLET_DESC AS bulletDesc,
                    gun.ACCESSORY_DESC AS accessoryDesc,
                    gun.FEE_AMOUNT AS feeAmount,
                    gun.EST_PRICE_AMOUNT AS estPriceAmount,
                    gun.KEEP_PERSON_GEN AS keepPersonGen,
                    gun.KEEP_LOCATION AS keepLocation,
                    loc.TUM_NAME AS tumName,
                    loc.AMP_NAME AS ampName,
                    loc.PRV_NAME AS prvName,
                    loc.POSTCODE AS postCode,
                    gun.R_SELL_TYPE AS rSellType,
                    gun.ASSET_STATUS AS assetStatus,
                    gun.CENT_DEPT_GEN AS centDeptGen,
                    gun.CREATE_BY_USERID AS createByUserid,
                    gun.CREATE_DATE AS createDate,
                    gun.UPDATE_BY_USERID AS updateByUserid,
                    gun.UPDATE_DATE AS updateDate,
                    gun.CREATE_BY_PROGID AS createByProgid,
                    gun.UPDATE_BY_PROGID AS updateByProgid,
                    gun.VERSION AS version,
                    gun.DATA_ID AS dataId,
                    gun.COPY_FLAG AS copyFlag,
                    gun.USER_DEPT_CODE AS userDeptCode,
                    gun.DPD_STRUCTURE_GEN AS dpdStructureGen,
                    gun.BRAND_NAME AS brandName,
                    gun.GUN_COMMENT AS gunComment,
                    gun.GUN_REGISTRATION_FLAG AS gunRegistrationFlag,
                    gun.WH_CIVIL_ID AS whCivilId,
                    map.WH_ASSET_ID
                FROM
                    WH_CIVIL_CASE wh_case
                INNER JOIN WH_CIVIL_CASE_ASSETS map ON wh_case.WH_CIVIL_ID = map.WH_CIVIL_ID
                INNER JOIN WH_CIVIL_CASE_ASSETS_GUN gun ON wh_case.WH_CIVIL_ID = gun.WH_CIVIL_ID
                LEFT JOIN CENT_LOC loc ON loc.CENT_LOC_GEN = gun.KEEP_CENT_LOC_GEN
                WHERE
                    1 = 1 {$filter}";
        $data = \db::query($sql);
        $array_obj = array();
        while ($rec = \db::fetch_array($data)) {
            unset($array_obj);
            //$array_obj['cfcGunGen'] = $rec['CFCGUNGEN'];
            //$array_obj['cfcCivilGen'] = $rec['CFCCIVILGEN'];
            //$array_obj['cfcGunReqGen'] = $rec['CFCGUNREQGEN'];
            $array_obj['courtCode'] = $rec['COURT_CODE'];
            $array_obj['prefixBlackCase'] = $rec['PREFIX_BLACK_CASE'];
            $array_obj['blackCase'] = $rec['BLACK_CASE'];
            $array_obj['blackYY'] = $rec['BLACK_YY'];
            $array_obj['prefixRedCase'] = $rec['PREFIX_RED_CASE'];
            $array_obj['redCase'] = $rec['RED_CASE'];
            $array_obj['redYY'] = $rec['RED_YY'];
            $array_obj['seqNo'] = $rec['SEQNO'];
            $array_obj['licenseNo'] = $rec['LICENSENO'];
            $array_obj['licenseYr'] = $rec['LICENSEYR'];
            $array_obj['licensePlace'] = $rec['LICENSEPLACE'];
            $array_obj['licenseDate'] = $rec['LICENSEDATE'];
            $array_obj['typeDesc'] = $rec['TYPEDESC'];
            $array_obj['gunSize'] = $rec['GUNSIZE'];
            $array_obj['gunNo'] = $rec['GUNNO'];
            $array_obj['makePerson'] = $rec['MAKEPERSON'];
            $array_obj['gunSign'] = $rec['GUNSIGN'];
            $array_obj['fromPerson'] = $rec['FROMPERSON'];
            $array_obj['bulletDesc'] = $rec['BULLETDESC'];
            $array_obj['accessoryDesc'] = $rec['ACCESSORYDESC'];
            $array_obj['feeAmount'] = $rec['FEEAMOUNT'];
            $array_obj['estPriceAmount'] = $rec['ESTPRICEAMOUNT'];
            $array_obj['keepPersonGen'] = $rec['KEEPPERSONGEN'];
            $array_obj['keepLocation'] = $rec['KEEPLOCATION'];
            $array_obj['tumName'] = $rec['TUMNAME'];
            $array_obj['ampName'] = $rec['AMPNAME'];
            $array_obj['prvName'] = $rec['PRVNAME'];
            $array_obj['postCode'] = $rec['POSTCODE'];
            $array_obj['rSellType'] = $rec['RSELLTYPE'];
            $array_obj['assetStatus'] = $rec['ASSETSTATUS'];
            $array_obj['centDeptGen'] = $rec['CENTDEPTGEN'];
            //$array_obj['createByUserid'] = $rec['CREATEBYUSERID'];
            //$array_obj['createDate'] = $rec['CREATEDATE'];
            //$array_obj['updateByUserid'] = $rec['UPDATEBYUSERID'];
            //$array_obj['updateDate'] = $rec['UPDATEDATE'];
            //$array_obj['createByProgid'] = $rec['CREATEBYPROGID'];
            //$array_obj['updateByProgid'] = $rec['UPDATEBYPROGID'];
            //$array_obj['version'] = $rec['VERSION'];
            //$array_obj['dataId'] = $rec['DATAID'];
            //$array_obj['copyFlag'] = $rec['COPYFLAG'];
            $array_obj['userDeptCode'] = $rec['USERDEPTCODE'];
            $array_obj['dpdStructureGen'] = $rec['DPDSTRUCTUREGEN'];
            $array_obj['brandName'] = $rec['BRANDNAME'];
            $array_obj['gunComment'] = $rec['GUNCOMMENT'];
            $array_obj['gunRegistrationFlag'] = $rec['GUNREGISTRATIONFLAG'];
            //$array_obj['whCivilId'] = $rec['WHCIVILID'];

            $sqlSelectDataDetail = "SELECT * FROM WH_CIVIL_CASE_ASSET_OWNER WHERE 1=1 AND ASSET_ID = '" . $rec['CFCGUNGEN'] . "' AND WH_ASSET_ID = '" . $rec['WH_ASSET_ID'] . "' ";
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

            array_push($obj, $array_obj);

           /*  if (!empty($request->logType) == '') {

                foreach ($obj as $k => $v) {

                    foreach ($v as $_k => $_v) {

                        if ($_k != 'holdingPerson') {
                            if ($_v != null) {

                                $query2 = \db::query("INSERT INTO M_LOG_RESPONSE (RESPONSE_LOG_ID,LOG_ID,RESPONSE_NAME,RESPONSE_DATA) VALUES (" . $responid . "," . $id . ",'" . $_k . "','" . $_v . "')");
                                $responid++;

                            }
                        }
                    }

                    if (isset($v['holdingPerson'])) {
                        foreach ($v['holdingPerson'] as $k2 => $v2) {
                            foreach ($v2 as $_k2 => $_v2) {
                                if ($_v2 != null) {

                                    $query3 = \db::query("INSERT INTO M_LOG_RESPONSE (RESPONSE_LOG_ID,LOG_ID,RESPONSE_NAME,RESPONSE_DATA) VALUES (" . $responid . "," . $id . ",'" . $_k2 . "','" . $_v2 . "')");
                                    $responid++;

                                }
                            }
                        }
                    }
                }
            } */
        }

        $obj = \db::api_authen_response($obj);

        $num = count($obj);

        if ($num > 0) {

            $row['ResponseCode'] = array(
                'ResCode' => '000',
                'ResMeassage' => "SUCCESS",
            );
            $row['Data'] = $obj;

        } else {

            $row['ResponseCode'] = array(
                'ResCode' => '102',
                'ResMeassage' => "NOT FOUND",
            );

        }

        return $this->respondWithData($row);
    }

}
