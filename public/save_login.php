<?php


include('include/comtop_user.php');
session_start();
$errors = array();

	// print_pre($_POST);
	// exit;

if(isset($_POST['login_user'])) {
    $username = conText($_POST['username']);
    $password = conText($_POST['password']);

    if(empty($username)) {
        array_push($errors, "Username is required");
    }

    if(empty($password)) {
        array_push($errors, "password is required");
    }

    if(count($errors) == 0) {

        $password = md5($password);
        $query = db::query("SELECT * FROM USER_API_SERVICE WHERE USR_USERNAME = '$username' AND USR_PASSWORD = '$password' AND USER_STATUS = '1'");
        $result = db::fetch_array($query);

        $num = db::num_rows($query);
        if($num == 1){
            $_SESSION['USR_ID'] = $result['USR_ID'];
            $_SESSION['username'] = $username;
            $_SESSION['GROUP_ID'] = $result['GROUP_ID'];
            // $_SESSION['PERMISSION_GROUP_ID'] = $result['PERMISSION_GROUP_ID'];
            $_SESSION['PERMISSION_GROUP_ID'] = $result['SYSTEM_TYPE'];
            $_SESSION['USER_MAIN'] = $result['USER_MAIN'];
            $_SESSION['SYSTEM_TYPE'] = $result['SYSTEM_TYPE'];

            $redirect = 'user_doc_profile.php';
        } else {
            array_push($errors, "wrong username/password ");
            $_SESSION['error'] = "Username หรือ Password ไม่ถูกต้อง";

            $redirect = 'login.php';
        }

    } else {
        array_push($errors, "Username & Password is required");
        $_SESSION['error'] = "Username & Password is required";

        $redirect = 'login.php';
    }


}

?>
<script type="text/javascript">
	window.location.href="<?php echo $redirect; ?>";
</script>
