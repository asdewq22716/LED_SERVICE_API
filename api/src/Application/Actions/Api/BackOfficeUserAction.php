<?php
declare (strict_types = 1);

namespace App\Application\Actions\Api;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class BackOfficeUserAction extends Action
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

        if (!empty($request->perIdCard)) {
            $filter .= "AND PER_IDCARD = '" . $request->perIdCard . "'";
        }
        if (!empty($request->prefixNameTh)) {
            $filter .= "AND PREFIX_NAME_TH = '" . $request->prefixNameTh . "'";
        }
        if (!empty($request->perFirstNameTh)) {
            $filter .= "AND PER_FIRST_NAME_TH = '" . $request->perFirstNameTh . "'";
        }

        $sql = \db::query("SELECT * FROM WH_BACK_OFFICE_USER WHERE 1=1 {$filter}");
        $i = 0;
        while ($rec = \db::fetch_array($sql)) {

            $obj[$i]['perld'] = $rec['PER_ID'];
            $obj[$i]['perfixld'] = $rec['PREFIX_ID'];
            $obj[$i]['perldcard'] = $rec['PER_IDCARD'];
            $obj[$i]['prefixNameTh'] = $rec['PREFIX_NAME_TH'];
            $obj[$i]['perFirstNameTh'] = $rec['PER_FIRST_NAME_TH'];
            $obj[$i]['perFirstNameEn'] = $rec['PER_FIRST_NAME_EN'];
            $obj[$i]['perLastNameTh'] = $rec['PER_LAST_NAME_TH'];
            $obj[$i]['perLastNameEn'] = $rec['PER_LAST_NAME_EN'];
            $obj[$i]['perDateBirth'] = $rec['PER_DATE_BIRTH'];
            $obj[$i]['postypeld'] = $rec['POSTYPE_ID'];
            $obj[$i]['typeld'] = $rec['TYPE_ID'];
            $obj[$i]['lineld'] = $rec['LINE_ID'];
            $obj[$i]['levelld'] = $rec['LEVEL_ID'];
            $obj[$i]['manageld'] = $rec['MANAGE_ID'];
            $obj[$i]['orgld1'] = $rec['ORG_ID1'];
            $obj[$i]['orgld2'] = $rec['ORG_ID2'];
            $obj[$i]['orgld3'] = $rec['ORG_ID3'];
            $obj[$i]['orgld4'] = $rec['ORG_ID4'];
            $obj[$i]['postypeNameTh'] = $rec['POSTYPE_NAME_TH'];
            $obj[$i]['typeNameTh'] = $rec['TYPE_NAME_TH'];
            $obj[$i]['lineNameTh'] = $rec['LINE_NAME_TH'];
            $obj[$i]['levelNameTh'] = $rec['LEVEL_NAME_TH'];
            $obj[$i]['manageNameTh'] = $rec['MANAGE_NAME_TH'];
            $obj[$i]['org1NameTh'] = $rec['ORG1_NAME_TH'];
            $obj[$i]['org2NameTh'] = $rec['ORG2_NAME_TH'];
            $obj[$i]['org3NameTh'] = $rec['ORG3_NAME_TH'];
            $obj[$i]['org4NameTh'] = $rec['ORG4_NAME_TH'];
            $obj[$i]['activeStatus'] = $rec['ACTIVE_STATUS'];
            $obj[$i]['updateDate'] = $rec['UPDATE_DATE'];

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
