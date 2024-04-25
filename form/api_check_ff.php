<?php
?>
<button type="button" class="btn btn-primary waves-effect waves-light" onclick="check_api_service()">
    <i class="fa fa-plus-circle"></i> ตรวจสอบ
</button>
<script>
    function check_api_service(){
        var idCard = $('#ID_CARD').val().replace(/-/g, '');
        $('#IS_FF').val('W').trigger('change');
        $.ajax({
            url : 'http://103.208.27.224/led_revive/apiservice/service01_process.php?pid='+idCard,
            type : 'GET',
            dataType : 'JSON',
            success : function(respon){
                console.log(respon);
                if(respon.status == "success"){
                    $('#IS_FF').val('Y').trigger('change');
                    $('#DUM_NO').val(respon.detail.UNDECIDED_CASE);
                    $('#DANG_NO').val(respon.detail.DECIDED_CASE);
                }else{
                    $('#IS_FF').val('N').trigger('change');
                    $('#DUM_NO').val('');
                    $('#DANG_NO').val('');
                }
            }
        });
    }
</script>