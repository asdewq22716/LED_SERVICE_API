<?php
include('../include/include.php');

	$username = 'ssssssssssssssssss';
            $emailto = 'kuyttt@hotmail.com';
            $subject = 'เรียน ท่านผู้ใช้บริการ ระบบยื่นคำร้องอิเล็กทรอนิกส์ (e-Filing) กรมบังคับคดี ';
            $messages = 'ตามที่ท่านได้ลงทะเบียน ระบบยื่นคำร้องอิเล็กทรอนิกส์ (e-Filing) ของกรมบังคับคดี ผ่านทางเว็บไซต์';
            $messages .= 'ท่านสามารถเข้าใช้งานระบบโดยใช้ username ในการเข้าใช้งาน และ ระบุรหัสผ่าน (password) ดังนี้';
            $messages .= "หากต้องการสอบถามข้อมูลเพิ่มเติม กรุณาติดต่อ สายด่วนกรมบังคับคดี : 1111 ต่อ 79";
            
        
            send_mail_hr($emailto, $subject, $messages);
?>