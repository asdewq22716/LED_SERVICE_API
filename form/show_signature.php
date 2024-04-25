
<?php 


$sql = db::query("SELECT * FROM M_RESULT_POSTCODE A  JOIN WF_FILE B ON A.FILE_ID = B.FILE_ID  WHERE B.WFR_ID = '".$WF['POSTCODE_ID']."' AND B.WF_MAIN_ID = '78'");

$data = db::fetch_array($sql);

if($WF['FILE_ID'] !=  ''){ ?>

    <img src="http://103.208.27.224:81/led_service_api/attach/w78/<?php echo $data['FILE_SAVE_NAME'];?>" class="rounded img_show">

<?php  } else {

    echo '';
}

?>
