<table cellspacing="0" id="SERVICE_MANAGE_ID" class="table table-bordered sorted_table">
	<thead class="bg-primary">
		<tr>
			<th style="width:;" class="text-center">
			<input type="checkbox" id="chkall_service" name="checkall_service" value="1"></th>
			<th style="width:;" class="text-center">ลำดับ</th>
			<th style="width:;" class="text-center">Service Code</th>
			<th style="width:;" class="text-center">ชื่อ Service</th>
			<th style="width:;" class="text-center">คำอธิบาย Service</th>
			<th style="width:;" class="text-center">ระบบ</th>
			<th style="width:;" class="text-center"> </th>
		</tr>
	</thead>
	<tbody>
<?php	
		$sql = "SELECT * FROM M_SERVICE_MANAGE";
		$query = db::query($sql);
		$i = 1;
		while($data = db::fetch_array($query)){ ?>
		
		<tr>
			<td class="text-center" >
			<input type="checkbox" id="chk_service" name="check_service[]" value="1"></td>
			<td style="width:;" class="text-center"><?php echo $i;?></td>
			<td style="width:;" class="text-left"><?php echo $data['SERVICE_CODE'];?></td>
			<td style="width:;" class="text-left"><?php echo $data['SERVICE_NAME'];?></td>
			<td style="width:;" class="text-left"><?php echo $data['SERVICE_DESC'];?></td>
			<td style="width:;" class="text-left"><?php echo $data['SYS_DETAIL'];?></td>
			<td style="text-align:center;" class="td_remove">
			
			<nobr>
                                                    
                <a href="#!" class="btn btn-info btn-mini"  
				title="" data-toggle="modal" data-target="#bizModal" onclick="open_modal('../all_modal/modal_service_manage_detail.php?ID=<?php echo $data['SERVICE_MANAGE_ID']; ?>&WFR=<?php echo $_GET['WFR']; ?>', '','')">
                <i class="icofont icofont-ui-add"></i> ดูรายละเอียด

               </a>

     </nobr></td>


			
		</tr>

		<script>
				$('#chkall_service').click(function(){
  
					if($(this).is(':checked',true)){
   
					$('[id*=chk_service]').prop('checked',true);
   
						}else {
   
							$('[id*=chk_service]').prop('checked',false);
   
					}
  
				});
			 </script>

	<?php	
			$i++;
		}

	?>
	</tbody>
</table>

