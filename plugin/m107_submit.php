<div class="wf-right">
    <button type="button" id="submit" name="submit" class="btn btn-md btn-success active waves-effect waves-light"><i class="icofont icofont-tick-mark"></i> บันทึก</button>
</div>

<script>
$('#submit').click(function(){
	
	var data_chk = [];
	var page = '<?php echo $_GET["wf_page"]!=""?$_GET["wf_page"]:1; ?>';
	$('input:checkbox:checked[id^="CHK_"]').not('#CHK_ALL').each(function(i){
		if($(this).val()!=''){
			data_chk[i] = $(this).val();
		}	
	});
	// console.log(data_chk);
	// alert(page);
	
	$.ajax({
		type: "POST",
		url: "../save/save_checkbox_m107.php",
		data:{data:data_chk,page:page},

		success: function(result) {
			swal({
			    title: "บันทึกสำเร็จ",
				type: "success",
				allowOutsideClick:true
			});
			// console.log(result);
			// window.location.reload();
		}
	});
});


</script>