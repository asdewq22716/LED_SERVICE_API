<?php
if($HIDE_HEADER != "Y"){
?>
	<script>
		<?php if($W != "" AND $WF_TYPE != ""){ ?>
		function load_help_field(w_id, w_name, w_type, flag)
		{
			var url = "ajax_function.php";
			var dataString = {w_name: w_name, w_id: w_id, w_type: w_type, process: 'help_field'};
			$.get(url, dataString, function(msg){
				$('#show_help_field').html(msg);
				$('.h_field i[id^=h_]').removeClass();

				if(flag == "N")
				{
					$('#other_table_choose').hide();
					$('i#h_'+w_name).addClass('fa fa-check');
				}
				else
				{
					$('#other_table_choose').show();
					$('#other_table_choose label').html('<i class="fa fa-database"></i> Table : '+w_name+' - '+flag+' <i class="fa fa-check"></i>');
				}
			});
		}

		$('#default_database_link').trigger('click');
		<?php } ?>
	</script>
<!-- Modal -->
<div class="modal fade modal-flex" id="bizModal" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
	<div class="modal-dialog modal-lg " role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"></h4>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade modal-flex" id="bizModal2" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
	<div class="modal-dialog modal-lg " role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"></h4>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade modal-flex" id="bizModal3" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
	<div class="modal-dialog modal-lg " role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"></h4>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
			</div>
		</div>
	</div>
</div>


	</body>
</html>
<?php
}
db::db_close();
?>