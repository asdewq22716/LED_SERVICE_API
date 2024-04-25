<?php

declare(strict_types=1);

namespace App\Application\Actions\Api;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class civilCaseAssetsLandAction extends Action
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
            return $this->respondWithData($row); //เเก้ไป AK
        }
        
        $serviceName = 'civilCaseAssetsLandAction';
        $tokenId = $_SERVER['HTTP_TOKENAPI'];

        include "serviceApiCenter.php";

        $obj = \db::api_authen_response($obj);

        include 'log_api_service.php';
        //print_r($obj);
        //exit;
        $num = count($obj);

        if ($num > 0) {
            $row['ResponseCode'] = array(
                'ResCode' => '000',
                'ResMeassage' => "SUCCESS",
            );
            $row['Data'] = $obj;
            /* $row['sql'] = json_encode($sql_holing1); */
        } else {
            $row['ResponseCode'] = array(
                'ResCode' => '102',
                'ResMeassage' => "NOT FOUND",
            );
            /* $row['sql'] = json_encode($sql); */
        }

        //ทำให้ show_sql ออกมา
        /*if (isset($request->SHOW_SQL)) {
            if ($request->SHOW_SQL == 1) {
                $sql = str_replace("\t", ' ', $sql);
                $sql = str_replace("\n", ' ', $sql);
                $row['ResponseCode']['SQL'] = $sql;
            }
        }*/

        return $this->respondWithData($row);
    }
}
