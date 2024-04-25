
	<!-- Multi Select js -->
<script src="../assets/plugins/multi-select/js/bootstrap-multiselect.js"></script>
<script src="../assets/plugins/multi-select/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="../assets/plugins/multi-select/js/jquery.quicksearch.js"></script>
<!-- Range slider js -->
<script type="text/javascript" src="../assets/js/modernizr.js"></script>
<script type="text/javascript" src="../assets/plugins/range-slider/js/bootstrap-slider.js"></script>
<script src='../assets/js/jquery-sortable.js'></script>
<!-- ace editor js -->
<script src="../assets/plugins/ace-editor/build/aui/aui.js"></script>
<!-- custom js -->
<script src="../assets/pages/form-validation.js"></script>
<script src='../assets/js/jquery-sortable.js'></script>
<script src='../assets/js/typeahead.min.js'></script>
<script type="text/javascript">

$(document).ready(function() {
	var data_field = ['<?php echo implode("','", $WF_ARR_FIELD);?>'];
	$('#WFS_FIELD_NAME').typeahead({
		source: data_field
	});
	
	<?php
	if($WF_TYPE != 'S'){
	?>
	$('#WFS_FIELD_NAME').blur(function()
	{
		if(this.value != "")
		{

				if($.inArray(this.value, data_field) != -1)
				{
					$('#ALTER_FIELD').prop('checked', false);
					$('.alter_field').hide();
				}
				else
				{
					$('#ALTER_FIELD').prop('checked', true);
					$('.alter_field').show();
				}
		}
	});
	<?php }?>

	$('#WFS_FIELD_NAME').blur(); 
		$('#WFS_FIELD_NAME').keyup(function()
		{
			if(this.value != "")
			{
				var chk_key = change_th2eng(this.value);
				 var data = chk_key.replace('-','_');
					 data = data.replace(' ','_');
					 data = data.toUpperCase();
				 $('#WFS_FIELD_NAME').val(data); 
			}
		});
	if($('#process').val() == "add")
	{
		change_form_type(1);
	}
	else
	{
		change_form_type('<?php echo $rec_form['FORM_MAIN_ID']; ?>');
	}

});

	$("#WFS_COLUMN_ALIGN").slider({tooltip:'hide'});
	$("#WFS_COLUMN_ALIGN").on('slide', function(slideEvt) {
		var w_val = 'w,'+slideEvt.value;
		var data = w_val.split(",");
		var l_val = data[1];
		var r_val = data[2]-data[1];
				$("#WFS_COLUMN_LEFT").val(l_val);
				$("#WFS_COLUMN_RIGHT").val(r_val);
			});
	$("#WFS_COLUMN_CENTER").slider();
	$("#WFS_COLUMN_CENTER").on('slide', function(slideEvt) {
				$("#WFS_COLUMN_CENTER_val").text('span'+slideEvt.value);
			});

	function show_div_url(txt){
		if(txt === "W")
		{
			$('#DIV_WF_MAIN_URL').hide();
			$('#WF_MAIN_URL').val('');
		}
		else if(txt === "L")
		{
			$('#DIV_WF_MAIN_URL').show();
		}
	}

function column_choose(c)
{
	if(c == "2")
	{
		$("#column_use2").show();
		$("#column_use1").hide();
	}
	else
	{
		$("#column_use1").show();
		$("#column_use2").hide();
	}
}

function change_form_type(c)
{
	var url = "";
	if(c == "1" || c == "2")
	{
		url = "option_textbox.php";
	}
	else if(c == "4" || c == "5" || c== "7" || c== "9")
	{
		url = "option_select.php";
	}
	else if(c == "3")
	{
		url = "option_date.php";
	}
	else if(c == "6")
	{
		url = "option_file.php";
	}
	else if(c == "8")
	{
		url = "option_text.php";
	}
	else if(c == "10")
	{
		url = "option_coding.php";
	}
	else if(c == "11")
	{
		url = "option_province.php";
	}
	else if(c == "12")
	{
		url = "option_amphur.php";
	}
	else if(c == "13")
	{
		url = "option_tambon.php";
	}
	else if(c == "16")
	{
		url = "option_form.php";
	}
	<?php if($process=="add"){ ?>
	if(c == "3"){
		$('#WFS_FIELD_TYPE').val("date").trigger("change");
	}else{
		$('#WFS_FIELD_TYPE').val("<?php echo $data_type_default;?>").trigger("change");
	}
	<?php } ?>
	if(url == "")
	{
		$('#form_type').html('');
	}
	else
	{
		var dataString = {process: $('#process').val(), W:$('#W').val(), WFD:$('#WFD').val(), WFS:$('#WFS').val(), WF_TYPE:$('#WF_TYPE').val(), form_type: c};
		$.get(url, dataString, function(msg){
			$('#form_type').html(msg);
		});
	}
}
function save_positions(){
	if( $('#data_position').length ){
		save_pos('data_position');
	}
}
</script>