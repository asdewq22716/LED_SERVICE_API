<?php
include "../include/include.php";

if (isset($_POST['function']) && $_POST['function'] == 'provinces') {
    $PROVINCE_NAME = $_POST['PROVINCE_NAME'];
    $sql = "SELECT * FROM M_G_AMPHUR WHERE PROVINCE_NAME='$PROVINCE_NAME'";
    $query = db::query($sql);
    echo '<option value="" selected disabled>-กรุณาเลือกอำเภอ-</option>';
    while ($value = db::fetch_array($query)){
        echo '<option value="'.$value['AMPHUR_NAME'].'" >'.$value['AMPHUR_NAME'].'</option>';
        // $AMPHUR_CODE = $value['AMPHUR_CODE'];
        // $AMPHUR_NAME = $value['AMPHUR_NAME'];
        // // เรียกใช้งานฟังก์ชัน onclick เพื่อส่งค่า $AMPHUR_CODE และ $TAMBON_CODE ไปยังฟังก์ชัน
        // echo '<option value="'.$TAMBON_CODE.'" onclick="optionClicked(\''.$AMPHUR_CODE.'\', \''.$TAMBON_CODE.'\')">'.$TAMBON_NAME.'</option>';
    }
}


if (isset($_POST['function']) && $_POST['function'] == 'amphures') {
  $AMPHUR_NAME = $_POST['AMPHUR_NAME'];
  $sql = "SELECT * FROM M_G_TAMBON WHERE AMPHUR_NAME='$AMPHUR_NAME'";
  $query = db::query($sql);
  echo '<option value="" selected disabled>-กรุณาเลือกตำบล-</option>';
  while ($value = db::fetch_array($query)){
    echo '<option value="'.$value['TAMBON_NAME'].'">'.$value['TAMBON_NAME'].'</option>';
        // $TAMBON_CODE = $value['TAMBON_CODE'];
        // $TAMBON_NAME = $value['TAMBON_NAME'];
        // // เรียกใช้งานฟังก์ชัน onclick เพื่อส่งค่า $AMPHUR_CODE และ $TAMBON_CODE ไปยังฟังก์ชัน
        // echo '<option value="'.$TAMBON_CODE.'" onclick="optionClicked(\''.$AMPHUR_CODE.'\', \''.$TAMBON_CODE.'\')">'.$TAMBON_NAME.'</option>';
}
}


// // ตัวอย่างข้อมูลยี่ห้อรถ
// $carBrands = array();

// if (isset($_POST['car[0]'])) {
//     $carType = $_POST['car[0]'];
//     echo $carType;
//     // สร้างข้อมูลยี่ห้อรถขึ้นมาตามประเภทรถที่เลือก
//     if ($carType === 'compact') {
//         $carBrands = array('Toyota', 'Honda', 'Nissan');
//     } elseif ($carType === 'bike') {
//         $carBrands = array('Honda', 'Yamaha', 'Suzuki');
//     } elseif ($carType === 'suv') {
//         $carBrands = array('Ford', 'Chevrolet', 'Jeep');
//     } elseif ($carType === 'truck') {
//         $carBrands = array('Ford', 'Chevrolet', 'Dodge');
//     }
// }

// // ส่งข้อมูลยี่ห้อรถกลับเป็น JSON
// header('Content-Type: application/json');
// echo json_encode($carBrands);

?>