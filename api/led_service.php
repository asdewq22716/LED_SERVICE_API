<?php
class led_service
{
    private static $_url = 'http://103.208.27.224:81/led_service_api/api/';
    private static $_method = array(
        'bankruptCourtOrder',
        'bankruptDoc',
        'civilCase',
        'mediateCaseDetail',
        'mediateCmdOffice',
        'mediateCase',
        'mediateDoc',
        'mediatePerson',
        'debtRehabilitationCaseDetail',
        'debtRehabilitationCmdOffice',
        'debtRehabilitationCaseDebtor',
        'debtRehabilitationCaseCreditor',
        'debtRehabilitationCourtOrder',
        'debtRehabilitationDoc',
        'civilCaseReceipt',
        'civilCaseOrder',
        'civilCaseDetail',
        'civilCasePerson',
        'civilCaseAssetsLand',
        'civilCaseAssetsBuilding',
        'civilCaseAccount',
    );
    private static $_service;
    private static $_message = false;

    public static function getMethod()
    {
        return self::$_method;
    }

    public static function getService()
    {
        return self::$_service;
    }

    public static function getURL()
    {
        return self::$_url;
    }

    public static function callService($name)
    {
        $file_name = strtolower($name);
        if (is_file('services/' . $file_name . '.php')) {
            include 'services/' . $file_name . '.php';
            self::$_service = $service;
        }
    }

    public static function get($name, $request)
    {
        self::$_message = false;
        $file_name = strtolower($name);

        if ($request['manualApiName'] != '' and is_file('obj_json/' . $request['manualApiName'] . 'Json.php')) {
            include 'obj_json/' . $request['manualApiName'] . 'Json.php';
        }
        if (is_file('obj_json/' . $file_name . 'Json.php')) {
            include 'obj_json/' . $file_name . 'Json.php';
        }
        if (is_file('service/' . $file_name . 'Action.php') and is_file('response/' . $file_name . 'Response.php')) {

            include 'response/' . $file_name . 'Response.php';

            include 'service/' . $file_name . 'Action.php';

            return call_user_func(array($name . 'Action', 'dataResPonse'), $request);
        }
        
        return false;
    }

    public static function getMessage()
    {
        return self::$_message;
    }

    public static function setMessage($message)
    {
        self::$_message = $message;
    }

    public static function civilCase($request)
    {

        return array();
    }
    public static function mediateCaseDetail($request)
    {

        return array();
    }
    public static function mediateCmdOffice($request)
    {

        return array();
    }

    public static function civilCasePerson($request)
    {

        return array();
    }

}
