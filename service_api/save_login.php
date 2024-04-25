<?php

    session_start();
    include('include/comtop_user.php');
    $errors = array();


    if(isset($_POST['login_user'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

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
                $_SESSION['username'] = $username;
                $_SESSION['GROUP_ID'] = $result['GROUP_ID'];
                  $_SESSION['PERMISSION_GROUP_ID'] = $result['PERMISSION_GROUP_ID'];
                // $_SESSION['success'] = "ํYou are now logged in";
                header("location: user_doc_profile.php");
            } else {
                array_push($errors, "wrong username/password ");
                $_SESSION['error'] = "Username หรือ Password ไม่ถูกต้อง";
                header("location: login.php");
            }

        } else {
            array_push($errors, "Username & Password is required");
            $_SESSION['error'] = "Username & Password is required";
            header("location: login.php");
        }


    }



// unset($a);
//  $a['IP_ADDRESS']  = '192.178.13.1';
//  $a['EVENT_CODE']  = '1';
//  $a['TOKEN_ID']  = '2441112412';
//  $a['DEP_ID']  =  10;
//  $a['REQUEST']  = 'WS-CIVIL-01-001';
//  $a['LOG_DATE']  = '2021-06-25';
//  $a['USR_ID']  = 3;
//  $a['REQUEST_STATUS']  = '500';
//  db::db_insert("M_LOG" , $a , "LOG_ID");
// print_pre($a);



?>
