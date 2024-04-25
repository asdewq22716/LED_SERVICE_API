	<!-- <a href="#" class="btn btn-warning btn-mini" data-toggle="modal" data-target="#bizModal" onclick="open_modal('../all_modal/modal_group_set.php?ID=<?php echo $WF['USR_ID']?>', '','')"><i class="fa fa-gear"></i> ตั้งค่ากลุ่มสิทธิ์</a> &nbsp; -->

	<a href="#" class="btn btn-primary btn-mini" onclick="gen_token(<?php echo $WF['USR_ID'] ?>);"><i class="fa fa-qrcode"></i> สร้าง Token</a> &nbsp;

	<script>
	function gen_token(id){
		$.ajax({
			   type: "POST",
			   url: '../form/gen_token.php',
			   data: {wfr : id}, // serializes the form's elements.
			   success: function(data)
			   {
					swal({
						  title: "Gen Token สำเร็จ",
						  type: "success",
						  allowOutsideClick:true
						});
			   }
			});
	}
	</script>
