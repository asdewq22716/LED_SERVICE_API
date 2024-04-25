<button onclick="show_modal(<?php echo $WF['SERVICE_ID']; ?>)" class="btn btn-info btn-mini">
	<i class="typcn typcn-th-list"></i> รายละเอียด
</button>

<div id="modal_html"></div>

<script type="text/javascript">

    function show_modal(id){

        var s_id = id;

        $.ajax({

            type: "POST",
            url: "../all_modal/modal_service_detail.php",
            data: {ID:s_id},
            dataType: "HTML",
            success: function (response) {

                $('#modal_html').html(response);
                $('#modal_service_detail').modal('show')
                
            }

        });

    }
 
</script> 