<div id="CASE_TYPE_BSF_AREA" class="col-md-1 wf-left">
	<button type="button" class="btn btn-success" id="getCaseData" style="background-color: #191970;border-color: #191970;">ดึงข้อมูล</button>
</div>

<script>
$(document).ready(function() {
	$( "#getCaseData" ).click(function() {
		getCaseData(1);
	});
});


function  getCaseData(type){

	var T_BLACK_CASE 	= $('#PREFIX_BLACK_CASE').val();
	var BLACK_CASE 		= $('#BLACK_CASE').val();
	var BLACK_YY 		= $('#BLACK_YEAR').val();
	var T_RED_CASE 		= $('#PREFIX_RED_CASE').val();
	var RED_CASE 		= $('#CASE_RED').val();
	var RED_YY 			= $('#RED_YEAR').val();
	var COURT_CODE 		= $('#COURT_CODE').val();
	var SYSTEM_ID 		= $('#SYSTEM_ID').val();

	$.ajax({
			type: "POST",
			url:  '../public/get_data_ajax.php',
			data: {
				  proc:"getCase",
				  T_BLACK_CASE:T_BLACK_CASE,
				  BLACK_CASE:BLACK_CASE,
				  BLACK_YY:BLACK_YY,
				  T_RED_CASE:T_RED_CASE,
				  RED_CASE:RED_CASE,					  
				  RED_YY:RED_YY,					  
				  COURT_CODE:COURT_CODE,				  
				  SYSTEM_ID:SYSTEM_ID
				}, // serializes the form's elements.
			success: function(response)
			{
				
				var data = JSON.parse(response);
				
				$('#PLAINTIFF').val(data.PLAINTIFF);
				$('#DEFFENDANT').val(data.DEFFENDANT);	
			}
		});
}
</script>