<?php 
include "../include/include.php";
include("../assets/jwt/src/JWT.php");
use \Firebase\JWT\JWT;

$wfr = $_POST['wfr'];
$token = $_POST['token'];
function encode_jwt($user){  
        $key = "bizpotential";
        $payload = array(
            "user" => $user,
            "date_time" => date("Y-m-d H:i:s")
        );
        $jwt = JWT::encode($payload, $key);
        $jwt=encrypt_decrypt($jwt,"encrypt");
        return $jwt;
}

function decode_jwt($jwt){
        $key = "bizpotential";
        try{
            $jwt= encrypt_decrypt($jwt,"decrypt");
            $payload = JWT::decode($jwt, $key, array('HS256'));

        }catch(Exception $e)
        {
            return false;
        }
       
        
        return  (array)$payload;
    }
	
function encrypt_decrypt($str,$action){
        $key = 'bizpotential_ssl';
        $iv_key = 'bizpotential_iv_KEY';
        $method="AES-256-CBC";
        $iv=substr(md5($iv_key),0,16);
        $output="";

        if($action=="encrypt")
        {
            $output=openssl_encrypt($str, $method,$key,0,$iv);
        }
        else if($action=="decrypt")
        {
            $output=openssl_decrypt($str, $method,$key,0,$iv);
        }

        return $output;
}

if($wfr){
	$sql = "SELECT ID_CARD,USR_EMAIL FROM USER_API_SERVICE WHERE 1=1 AND USR_ID = '".$wfr."'";
	$query = db::query($sql);
	$data = db::fetch_array($query);

	$token = encode_jwt($data['ID_CARD']);

	$update['TOKEN_ID'] = $token;
	$cond['USR_ID'] = $wfr;
	db::db_update('USER_API_SERVICE',$update,$cond);
	
	
	$email = $data['USR_EMAIL'];
	$subject = 'ระบบบูรณาการฐานข้อมูล (LED-Service)';
	$formname = 'ระบบบูรณาการฐานข้อมูล (LED-Service)';
	$body = "ตามที่ท่านได้ลงทะเบียน ระบบบูรณาการฐานข้อมูล (LED-Service) ของกรมบังคับคดี <br>สามารถเข้าใช้งานระบบ API โดยใช้  TOKENAPI ดังนี้ <br>";
	$body .= "<b>".$token."</b><br>";
	$body .= "หากต้องการสอบถามข้อมูลเพิ่มเติม กรุณาติดต่อ สายด่วนกรมบังคับคดี : 1111 ต่อ 79";
	
	sendMail($email,$subject,$body,$formname);
	echo $token;
	exit;
}

if($token){
        $jwt=decode_jwt($token);
        if(!$jwt)
        {
            $err=array();
            $err["msg"]="Wrong Token !!!";
            echo json_encode($err);
        }
        else
        {
            echo  json_encode($jwt);
        }

}
?>


