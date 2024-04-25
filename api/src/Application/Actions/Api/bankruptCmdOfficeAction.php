<?php
declare (strict_types = 1);

namespace App\Application\Actions\Api;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class bankruptCmdOfficeAction extends Action
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
        if (!empty($request->cmdDate)) {
            $filter .= "AND b.CMD_DATE = '" . $request->cmdDate . "'";
        }
        if (!empty($request->officeIdcard)) {
            $filter .= "AND b.OFFICE_IDCARD = '" . $request->officeIdcard . "'";
        }
        if (!empty($request->officeName)) {
            $filter .= "AND b.OFFICE_NAME = '" . $request->officeName . "'";
        }
        if (!empty($request->cmdTypeName)) {
            $filter .= "AND b.CMD_TYPE_NAME = '" . $request->cmdTypeName . "'";
        }

        $sql = "SELECT
            	a.*,
              b.REQ,
              b.CMD_DATE,
              b.OFFICE_IDCARD,
              b.OFFICE_NAME,
              b.CMD_TYPE_CODE,
              b.CMD_TYPE_NAME,
              b.CMD_DETAIL
            FROM
            	WH_BANKRUPT_CASE_DETAIL a
            	LEFT JOIN WH_BANKRUPT_CMD_OFFICE b ON a.BANKRUPT_CODE = b.BANKRUPT_CODE
            WHERE 1=1 {$filter} ";
        $data = \db::query($sql);
        $i = 0;
        while ($rec = \db::fetch_array($data)) {

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
            $obj[$i]['seq'] = $rec['REQ'];
            $obj[$i]['cmdDate'] = $rec['CMD_DATE'];
            $obj[$i]['officeIdcard'] = $rec['OFFICE_IDCARD'];
            $obj[$i]['officeName'] = $rec['OFFICE_NAME'];
            $obj[$i]['cmdTypeCode'] = $rec['CMD_TYPE_CODE'];
            $obj[$i]['cmdTypeName'] = $rec['CMD_TYPE_NAME'];
            $obj[$i]['cmdDetail'] = $rec['CMD_DETAIL'];

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
