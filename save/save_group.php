<?php

if($_POST['proc'] == 'get_group'){
    include "../include/include.php";

    $sql = db::query("SELECT B.WFR_ID FROM  FRM_DEPARTMENT_GROUP B 
    LEFT JOIN M_PRIVILEGE_GROUP C ON B.WFR_ID = C.PRIVILEGE_GROUP_ID WHERE B.DEPARTMENT_ID = '".$_POST['sys_id']."'");
    $data_sql = db::fetch_array($sql);

    echo $data_sql['WFR_ID'];
    exit;
}


?>
<script>
 $(document).ready(function() {
    $("#SYSTEM_TYPE").change(function(){
        $.ajax({
					type: "POST",
					url: "../save/save_group.php",
					data: { proc: 'get_group', 
                            sys_id: $("#SYSTEM_TYPE").val()},
					cache: false,
					success: function(data){ 
                        setTimeout(function(){
                            $('#PERMISSION_GROUP_ID').val(data).trigger('change');
                          
                            },1000);
					}
		});

    }); 
}); 

</script>