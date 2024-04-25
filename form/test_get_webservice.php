<div class="modal" tabindex="-1" role="dialog" id="modal_webservice">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">ค้นหาข้อมูลจาก webservice</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="form-group row">
			<div id="S_COURT_NAME_BSF_AREA" class="col-md-2 ">
				<label for="S_COURT_NAME" class="form-control-label wf-right">ศาล</label>
			</div>
			<div id="S_COURT_NAME_BSF_AREA" class="col-md-3 wf-left">
				<input type="text" name="S_COURT_NAME" id="S_COURT_NAME" class="form-control" value=""></div>
		</div>	
		<div class="form-group row">
			<div id="S_BLACK_CASE_TITLE_BSF_AREA" class="col-md-2 ">
				<label for="S_BLACK_CASE_TITLE" class="form-control-label wf-right">หมายเลขคดีดำ</label>
			</div>
			<div id="S_BLACK_CASE_TITLE_BSF_AREA" class="col-md-2 wf-left">
				<input type="text" name="S_BLACK_CASE_TITLE" id="S_BLACK_CASE_TITLE" class="form-control" value=""></div>
			<div id="S_BLACK_CASE_NO_SHW_BSF_AREA" class="col-md-2 wf-left ">
				<input type="text" name="S_BLACK_CASE_NO_SHW" id="S_BLACK_CASE_NO_SHW" class="form-control" value=""></div>
			<div id="S_YEAR_BLACK_BSF_AREA" class="col-md-2 wf-left ">
				<input type="text" name="S_YEAR_BLACK" id="S_YEAR_BLACK" class="form-control" value=""></div>
			
		</div>

		<div class="form-group row">
			<div class="col-md-10">
				<div class="col-md-5 wf-right">
					<button type="button" class="btn btn-primary waves-effect waves-light" onclick="call_api_service_efiling_001()">
						<i class="fa fa-plus-circle"></i> ค้นหา</button>
				</div>
			</div>
			
		</div>
		<div class="form-group row">
			<div class="col-md-10">
				<table id="webservice-data" class="table">
					<thead>
						<tr>
							<th>ศาล</th>
							<th>เลขคดีดำ</th>
							<th>โจทย์</th>
							<th>จำเลย</th>
							<th>ทุนทรัพย์<th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
			
		</div>
      </div>
      
    </div>
  </div>
</div>
<div class="form-group row">
	<div class="col-md-10 wf-right ">
		<div class="col-md-5 wf-right">
			<button type="button" class="btn btn-primary waves-effect waves-light" onclick="$('#modal_webservice').modal('show')">
				<i class="fa fa-plus-circle"></i> ดึงข้อมูล</button>
		</div>
	</div>
</div>
<script>
	function call_api_service_efiling_001(){

		$.ajax({
			url : "http://103.208.27.224:81/led_service_api/webapi_client/call_api.php?api_code=efiling-001",
			type : "POST",
			dataType : "JSON",
			data:{
				court_name:$('#S_COURT_NAME').val(),
				black_name:$('#S_BLACK_CASE_TITLE').val(),
				black_num:$('#S_BLACK_CASE_NO_SHW').val(),
				black_year:$('#S_YEAR_BLACK').val()
			},
			success : function(response){
				window.apidata = response.data;
				var webservice_data_tbody = $('#webservice-data tbody').html('')
				if(response.status == "success"){
					for(let i=0;i<response.data.length;i++){
					webservice_data_tbody.append(
					'<tr>\
							<td>'+response.data[i].court_name+'</td>\
							<td>'+response.data[i].black_name+'-'+response.data[i].black_num+'-'+response.data[i].black_year+'</td>\
							<td>'+response.data[i].plaintiff_name+'</td>\
							<td>'+response.data[i].defendant_title+' '+response.data[i].defendant_name+' '+response.data[i].defendant_lname+'</td>\
							<td class="text-right">'+response.data[i].capital_amount+'<td>\
							<td><button type="button" class="btn btn-info" onclick="select_data('+i+')">เลือก</button></td>\
						</tr>');
					}
				}else{
					alert('error')
				}
			}
		});
	}
	function select_data(i){
		var data = apidata[i];
		$('#COURT_NAME').val(data.court_name);
		
		$('#BLACK_CASE_TITLE').val(data.black_name)
		$('#BLACK_CASE_NO_SHW').val(data.black_num)
		$('#YEAR_BLACK').val(data.black_year)
		$('#RED_CASE_TITLE').val(data.red_name)
		$('#RED_CASE_NO_SHW').val(data.red_num)
		$('#RED_BLACK').val(data.red_year)
		
		$('#PLAINTIFF').val(data.plaintiff_name);
		$('#DEFENDANT').val(data.defendant_title+' '+data.defendant_name+' '+data.defendant_lname);
		
		$('#CAPITAL_AMOUNT').val(data.capital_amount);
		
		$('#modal_webservice').modal('hide')
	}
</script>