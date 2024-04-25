<?php

session_start();
include('include/comtop_user.php');


// echo "1";
// exit;
// print_pre($_POST);

    $errors = array();
    if (isset($_POST['reg_user'])) {

        $SYSTEM_TYPE    = $_POST['SYS_TYPE'];
        $USR_USERNAME   = $_POST['USR_USERNAME'];
        $USR_EMAIL      = $_POST['USR_EMAIL'];
        $USR_PREFIX     = $_POST['USR_PREFIX'];
        $USR_FNAME      = $_POST['USR_FNAME'];
        $USR_LNAME      = $_POST['USR_LNAME'];
        $ID_CARD        = $_POST['ID_CARD'];
        $USR_PASSWORD   = $_POST['USR_PASSWORD'];
        $USR_PASSWORD1  = $_POST['USR_PASSWORD1'];



        $chk_user = "SELECT * FROM USER_API_SERVICE WHERE USR_USERNAME = '".$USR_USERNAME."' OR USR_EMAIL = '".$USR_EMAIL."' ";
        $qeury = db::query($chk_user);
        $result = db::fetch_array($qeury);

        // $num = db::num_rows($query);


        if (count($errors) == 0){
            $USR_PASSWORD = md5($USR_PASSWORD);

            unset($data);
            $data['SYSTEM_TYPE']    = $SYSTEM_TYPE;
            $data['USR_USERNAME']   = $USR_USERNAME;
            $data['USR_EMAIL']      = $USR_EMAIL;
            $data['USR_PREFIX']     = $USR_PREFIX;
            $data['USR_FNAME']      = $USR_FNAME;
            $data['USR_LNAME']      = $USR_LNAME;
            $data['ID_CARD']        = $ID_CARD;
            $data['USR_PASSWORD']   = $USR_PASSWORD;
            $data['GROUP_ID']       = 2;
            $id = db::db_insert("USER_API_SERVICE",$data,"USR_ID");


            $username = $USR_USERNAME;
            $emailto = $USR_EMAIL;
            $subject = 'เรียน ท่านผู้ใช้บริการ ระบบยื่นคำร้องอิเล็กทรอนิกส์ (e-Filing) กรมบังคับคดี ';
            $messages = 'ตามที่ท่านได้ลงทะเบียน ระบบยื่นคำร้องอิเล็กทรอนิกส์ (e-Filing) ของกรมบังคับคดี ผ่านทางเว็บไซต์';
            $messages .= 'ท่านสามารถเข้าใช้งานระบบโดยใช้ username ในการเข้าใช้งาน และ ระบุรหัสผ่าน (password) ดังนี้';
            $messages .= " Uername : " . str_replace("-", "", $username) . "\n</br></br>";
            $messages .= " Password : " . $_POST['USR_PASSWORD'] . "\n";
            $messages .= "ทั้งนี้คลิกเพื่อยืนยันการลงทะเบียน http://103.208.27.224:81/led_service_api/public/user_activate.php?name=".$USR_USERNAME."&uid=".$id."<br> ";
            $messages .= "หากต้องการสอบถามข้อมูลเพิ่มเติม กรุณาติดต่อ สายด่วนกรมบังคับคดี : 1111 ต่อ 79";


            send_mail($emailto, $subject, $messages);
// echo phpinfo();
EXIT;
             header('location: login.php');


        }
        else {

             header('location: login.php');

         }
    }




?>
