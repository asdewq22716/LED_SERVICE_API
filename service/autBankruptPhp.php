<?php
include '../include/include.php';
include("../assets/jwt/src/JWT.php");
use \Firebase\JWT\JWT;
$jwtToken = $_GET['jwtToken'];
	function decode_jwt($jwt)
    {
        $key = "ledbr";
        try{

            $payload = JWT::decode($jwt, $key, array('HS256'));

        }catch(Exception $e)
        {  
            return false;
        }
        return  (array)$payload;

    }
	
 //ถอดรหัส token
// echo "<pre>";
// print_r(decode_jwt($jwtToken));
// echo "</pre>";
// exit();
$jwtToken = json_encode(decode_jwt($jwtToken));
?>
<form id="frm1" action="http://vpn.bizpotential.com:9090/form/" method="post">
  <textarea name="jwtToken" style="display:none;"><?php echo $jwtToken ;?></textarea>
</form>
<script>
//$( document ).ready(function() {
	document.getElementById("frm1").submit();
	//$('#frm1').submit();
	
//});
</script>  