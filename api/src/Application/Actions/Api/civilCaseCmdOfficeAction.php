<?php
declare (strict_types = 1);

namespace App\Application\Actions\Api;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class civilCaseCmdOffice extends Action
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

        $obj = array();
        $row = array();
        $filter = "";

        if (!empty($request->officeName) != '') {
            $filter .= "AND office.OFFICE_NAME = '" . $request->officeName . "'";
        }
        if (!empty($request->courtCode) != '') {
            $filter .= "AND wh_case.COURT_CODE = '" . $request->courtCode . "'";
        }
        if (!empty($request->cmdTypeName) != '') {
            $filter .= "AND office.CMD_TYPE_NAME = '" . $request->cmdTypeName . "'";
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

        if (!empty($request->cmdDate) != '') {
            $filter .= "AND office.CMD_DATE = '" . $request->cmdDate . "'";
        }
        if (!empty($request->officeIdcard) != '') {
            $filter .= "AND office.OFFICE_IDCARD = '" . $request->officeIdcard . "'";
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
        office.RECORD_COUNT AS recodeCount,
        office.CMD_DATE AS cmdDate,
        office.OFFICE_NAME AS officeName,
        office.CMD_TYPE_CODE AS cmdTypeCode,
        office.CMD_TYPE_NAME AS cmdTypeName,
        office.CMD_DETAIL AS cmdDetail,
        wh_case.CIVIL_CODE AS civilCode,
        office.OFFICE_IDCARD AS officeIdcard

        FROM WH_CIVIL_CASE wh_case LEFT JOIN WH_CIVIL_CASE_CMD_OFFICE office ON wh_case.CIVIL_CODE = office.CIVIL_CODE

        WHERE 1=1 {$filter} ";
        $data = \db::query($sql);
        $i = 0;
        while ($rec = \db::fetch_array($data)) {

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
            $obj[$i]['recodeCount'] = $rec['RECODECOUNT'];
            $obj[$i]['cmdDate'] = $rec['CMDDATE'];
            $obj[$i]['officeName'] = $rec['OFFICENAME'];
            $obj[$i]['cmdTypeCode'] = $rec['CMDTYPPECODE'];
            $obj[$i]['cmdTypeName'] = $rec['CMDTYPENAME'];
            $obj[$i]['cmdDetail'] = $rec['CMDDETAIL'];
            $obj[$i]['civilCode'] = $rec['CIVILCODE'];
            $i++;
        }

        $obj = \db::api_authen_response($obj);

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
