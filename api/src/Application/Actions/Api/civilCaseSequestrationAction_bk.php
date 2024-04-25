<?php
declare (strict_types = 1);

namespace App\Application\Actions\Api;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class civilCaseSequestrationAction extends Action
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

        if (!empty($request->courtCode)) {
            $filter .= "AND A.COURT_CODE = '" . $request->courtCode . "'";
        }
        if (!empty($request->courtName)) {
            $filter .= "AND A.COURT_NAME = '" . $request->courtName . "'";
        }
        if (!empty($request->deptName)) {
            $filter .= "AND A.DEPT_NAME = '" . $request->deptName . "'";
        }
        if (!empty($request->prefixBlackCase)) {
            $filter .= "AND A.PREFIX_BLACK_CASE = '" . $request->prefixBlackCase . "'";
        }
        if (!empty($request->blackCase)) {
            $filter .= "AND A.BLACK_CASE = '" . $request->blackCase . "'";
        }
        if (!empty($request->blackYY)) {
            $filter .= "AND A.BLACK_YY = '" . $request->blackYY . "'";
        }
        if (!empty($request->prefixRedCase)) {
            $filter .= "AND A.PREFIX_RED_CASE = '" . $request->prefixRedCase . "'";
        }
        if (!empty($request->redCase)) {
            $filter .= "AND A.RED_CASE = '" . $request->redCase . "'";
        }
        if (!empty($request->redYY)) {
            $filter .= "AND A.RED_YY = '" . $request->redYY . "'";
        }

        $sql = \db::query("SELECT A.*,B.OFFICE_IDCARD,B.OFFICE_NAME,B.SEQUEST_ID FROM WH_CIVIL_CASE A LEFT JOIN WH_CIVIL_CASE_SEQUEST B ON A.CIVIL_CODE = B.CIVIL_CODE  WHERE 1=1 {$filter}");
        $i = $j = $k = 0;

        while ($rec = \db::fetch_array($sql)) {

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
            $obj[$i]['plaintiff1'] = $rec['PLAINTIFF1'];
            $obj[$i]['plaintiff2'] = $rec['PLAINTIFF2'];
            $obj[$i]['plaintiff3'] = $rec['PLAINTIFF3'];
            $obj[$i]['deffendant1'] = $rec['DEFFENDANT1'];
            $obj[$i]['deffendant2'] = $rec['DEFFENDANT2'];
            $obj[$i]['deffendant3'] = $rec['DEFFENDANT3'];
            $obj[$i]['officeIdCard'] = $rec['OFFICE_IDCARD'];
            $obj[$i]['officeName'] = $rec['OFFICE_NAME'];
            // $obj[$i]['a']               = $rec['SEQUEST_ID'];

            $sqlmap = \db::query("SELECT * FROM WH_CIVIL_MAP_CASE_SEQUEST
            WHERE SEQUEST_ID = '" . $rec['SEQUEST_ID'] . "' ");
            $datamap = \db::fetch_array($sqlmap);

            $sqlowner = \db::query("SELECT * FROM WH_CIVIL_SEQUEST_OWNER WHERE SEQUEST_OWNER_ID = '" . $datamap['SEQUEST_OWNER_ID'] . "' ");

            while ($dataowner = \db::fetch_array($sqlowner)) {

                $obj[$i]['ownerList'][$j]['ownerName'] = $dataowner['SEQUEST_OWNER_NAME'];
                $obj[$i]['ownerList'][$j]['ownerPayroll'] = $dataowner['SEQUEST_PAYROLL_AMOUNT'];

                $sqllist = \db::query("SELECT * FROM  WH_CIVIL_SEQUEST_LIST WHERE SEQUEST_LIST_ID = '" . $datamap['SEQUEST_LIST_ID'] . "'  ");
                while ($datalist = \db::fetch_array($sqllist)) {

                    $obj[$i]['ownerList'][$j]['seqList'][$k]['sequestListName'] = $datalist['SEQUEST_LIST_NAME'];
                    $obj[$i]['ownerList'][$j]['seqList'][$k]['sequestDetailRq'] = $datalist['SEQUEST_DETAILS_RQ'];
                    $obj[$i]['ownerList'][$j]['seqList'][$k]['sequestMoneyRq'] = $datalist['SEQUEST_MONEY_RQ'];
                    $obj[$i]['ownerList'][$j]['seqList'][$k]['sequestPercentRq'] = $datalist['SEQUEST_PERCENT_RQ'];
                    $obj[$i]['ownerList'][$j]['seqList'][$k]['sequestTimeRq'] = $datalist['SEQUEST_TIME_RQ'];
                    $obj[$i]['ownerList'][$j]['seqList'][$k]['sequestTypeName'] = $datalist['SEQUEST_TYPE_NAME'];
                    $obj[$i]['ownerList'][$j]['seqList'][$k]['sequestMoney'] = $datalist['SEQUEST_MONEY'];
                    $obj[$i]['ownerList'][$j]['seqList'][$k]['sequestPercent'] = $datalist['SEQUEST_PERCENT'];
                    $obj[$i]['ownerList'][$j]['seqList'][$k]['sequestTime'] = $datalist['SEQUEST_TIME'];
                    $obj[$i]['ownerList'][$j]['seqList'][$k]['sequestDetail'] = $datalist['SEQUEST_DETAILS'];
                    $obj[$i]['ownerList'][$j]['seqList'][$k]['sequestBankCode'] = $datalist['SEQUEST_BANK_CODE'];
                    $obj[$i]['ownerList'][$j]['seqList'][$k]['sequestBankName'] = $datalist['SEQUEST_BANK_NAME'];
                    $obj[$i]['ownerList'][$j]['seqList'][$k]['sequestAccCode'] = $datalist['SEQUEST_ACC_CODE'];
                    $obj[$i]['ownerList'][$j]['seqList'][$k]['sequestAccType'] = $datalist['SEQUEST_ACC_TYPE'];
                    $obj[$i]['ownerList'][$j]['seqList'][$k]['sequestAccName'] = $datalist['SEQUEST_ACC_NAME'];

                    $k++;
                }
                $j++;
            }

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
