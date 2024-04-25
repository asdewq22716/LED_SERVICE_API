

<script>

$(document).ready(function () {
    
    $.ajax({
        type: "POST",
        url: "../api/services/<?php echo $rec['SERVICE_URL']; ?>",
        data: "data",
        dataType: "HTML",
        success: function (response) {
            
        }
    });

});

</script>