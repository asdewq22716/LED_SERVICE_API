<!-- gridstack js -->
<script src="../assets/js/highlight.min.js"></script>
<script src="../assets/js/lodash.js"></script>
<script src="../assets/plugins/gridstack/js/gridstack.js"></script>
<script src="../assets/plugins/gridstack/js/gridstack.jQueryUI.js"></script>
<!-- custom js -->

<script type="text/javascript">
	'use strict';
	hljs.initHighlightingOnLoad();
	$(function()
	{
		$('.grid-stack').gridstack({
			width: 12,
			alwaysShowResizeHandle: /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)
		});
		this.saveGrid = function()
		{
			this.serializedData = _.map($('.grid-stack > .grid-stack-item:visible'), function(el)
			{
				el = $(el);
				var node = el.data('_gridstack_node');
				return {
					f_id: node.id, f_offset: node.x, f_position: node.y, f_width: node.width
				};
			}, this);
			$('#re_order_grid').val(JSON.stringify(this.serializedData, null, '    '));
			
			var dataString = 'process=re_order&re_order_grid=' + $('#re_order_grid').val() + '&W=<?php echo $W; ?>&WFD=<?php echo $WFD; ?>&WF_TYPE=<?php echo $WF_TYPE; ?>';
			$.ajax({
				type: "POST",
				url: "../process/workflow_step_form_arrange.php",
				data: dataString,
				cache: false,
				success: function(html)
				{
					if(html == 'Y')
					{ 
						swal({
						  title: "บันทึกตำแหน่งเรียบร้อยแล้ว", 
						  type: "success",
						  allowOutsideClick:true
						});
					}
				}
			}); 

			return false;
		}.bind(this);
		$('#save-grid').click(this.saveGrid);
		$('.loader-block').hide();
		$('#grid1').show();
	});
</script>
<script type="text/javascript">
$('.loader-block').hide();
  function deleteWFS(id,field_exist)
  {
	var dataString = '';
	  if(confirm('คุณต้องการลบ Input นี้ใช่หรือไม่'))
	  {
		if(field_exist == 'Y'){
			if(confirm('คุณต้องการ Drop Field ด้วยใช่หรือไม่'))
			{
				dataString = 'process=delete&W=<?php echo $W; ?>&WFD=<?php echo $WFD; ?>&WFS='+id+'&drop_field=Y';
			}else
			{
				dataString = 'process=delete&W=<?php echo $W; ?>&WFD=<?php echo $WFD; ?>&WFS='+id;
			}
		}
		else
		{
			dataString = 'process=delete&W=<?php echo $W; ?>&WFD=<?php echo $WFD; ?>&WFS='+id;
		}
		  
		  //window.location.href='workflow_step_form_function.php?process=delete&W=<?php echo $W; ?>&WFD=<?php echo $WFD; ?>&WFS='+id+dataString;
		  $.ajax({
				type: "GET",
				url: "../process/workflow_step_form_function.php",
				data: dataString,
				cache: false,
				success: function(html)
				{
					if(html != '')
					{ 
						var url_back = '';
						if(html == 'W'){
							url_back = 'workflow_step_form.php?W=<?php echo $W;?>&WFD=<?php echo $WFD;?>';
						}else if(html == 'F'){
							url_back = 'form_step_form.php?W=<?php echo $W;?>&WFD=<?php echo $WFD;?>';
							
						}else if(html == 'M'){
							url_back = 'master_step_form.php?W=<?php echo $W;?>&WFD=<?php echo $WFD;?>';
							
						}else if(html == 'S'){
							url_back = 'search_step_form.php?W=<?php echo $W;?>&WFD=<?php echo $WFD;?>';
							
						}
						swal({
						  title: "ลบข้อมูลเรียบร้อยแล้ว", 
						  type: "success",
						  allowOutsideClick:true
						},
						function(isConfirm){
						  window.location.href=url_back;
						});
						
					}
				}
			}); 
	  }
  
  } 
  function save_step(wfd){
		var url = "workflow_step_change_function.php"; // the script where you handle the form input.

		$.ajax({
			   type: "POST",
			   url: url,
			   data: $("#form_step_change").serialize(), // serializes the form's elements.
			   success: function(data)
			   {
					var dataString = 'W=<?php echo $W;?>&WFD=<?php echo $WFD;?>';
					$.ajax({
					 type: "GET",
					 url: "workflow_step_change.php",
					 data: dataString,
					 cache: false,
					 success: function(html){
					  $("#step_form_change").html(html);
					 }
					 });
					 
			   }
			 });

		e.preventDefault(); // avoid to execute the actual submit of the form.
	}
	function save_doc(wfd){
		var url = "workflow_setting_doc_list_function.php"; // the script where you handle the form input.

		$.ajax({
			   type: "POST",
			   url: url,
			   data: $("#form_doc_list").serialize(), // serializes the form's elements.
			   success: function(data)
			   {
			
					var dataString = 'W=<?php echo $W;?>&WFD=<?php echo $WFD;?>';
					$.ajax({
					 type: "GET",
					 url: "workflow_setting_doc_list.php",
					 data: dataString,
					 cache: false,
					 success: function(html){
					  $("#doc_list").html(html);
					 }
					 });
					 
			   }
			 });

		e.preventDefault(); // avoid to execute the actual submit of the form.
	}
	
	function delete_doc(id){
	
		if(confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่ ?')){		
			var dataString = 'process=DEL&W=<?php echo $W;?>&WFD=<?php echo $WFD;?>&DOC_ID='+id;
			$.ajax({
			 type: "GET",
			 url: "workflow_setting_doc_add_function.php",
			 data: dataString,
			 cache: false,
			 success: function(html){
				$("#tr_"+id).hide();
			 }
			 });

		}
		
	}
	
	
	function save_field_group(wfd){
		var url = "workflow_field_group_arrange.php"; 

		$.ajax({
			   type: "POST",
			   url: url,
			   data: $("#form_field_group").serialize(),
			   success: function(data)
			   {
					
					var dataString = 'W=<?php echo $W;?>&WFD=<?php echo $WFD;?>&WF_TYPE=<?php echo $WF_TYPE;?>';
					$.ajax({
					 type: "GET",
					 url: "workflow_field_group_list.php",
					 data: dataString,
					 cache: false,
					 success: function(html){
					  $("#field_group").html(html);
					 }
					 });
					 
			   }
			 });

		e.preventDefault(); // avoid to execute the actual submit of the form. 
	}
	
	function delete_group_field(id){
	
		if(confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่ ?')){		
			var dataString = 'process=DEL&W=<?php echo $W;?>&WFD=<?php echo $WFD;?>&id='+id;
			$.ajax({
			 type: "POST",
			 url: "workflow_field_group_function.php",
			 data: dataString,
			 cache: false,
			 success: function(html){
				$("#tr_g"+id).hide();
				var total_rows = ($('#total_group').val()-1);
				$('#total_group').val(total_rows);
				var total_all = ($('#total_group').val()-1);
				if(total_all > 0){
					$('#wf_group_field_show').html('<label class="badge bg-success">'+total_all+'</label>');
				}else{
					
					$('#wf_group_field_show').html('');
				}
				
			 }
			 });

		}
	}
</script>