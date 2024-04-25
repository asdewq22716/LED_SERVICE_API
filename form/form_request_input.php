	<div class="form-group row">
		<div id="_BSF_AREA" class="col-md-2 ">
			<label for=":q1" class="form-control-label wf-right">Method/URL</label>
		</div>
		<div id="_BSF_AREA" class="col-md-10 wf-left">
			<div class="input-group">

					<select name="request_method" id="request_method" class="form-control input-group-addon"  style="width:100px;height: 35px;">
						<option value="GET">GET</option>
						<option value="POST" disabled>POST</option>
						<option value="PUT" disabled>PUT</option>
					</select>
				
				<input type="text" name="request_url" id="request_url" class="form-control" style="width: 600px;" value="" placeholder="กรอก URL https://domain/:param/?query_string=:value" />
			</div>

		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-2">
		<label for=":q1" class="form-control-label wf-right">Header</label>
		</div>
		<div class="col-md-10">
		<button type="button" id="bt_h_add" class="btn btn-danger">เพิ่ม</button>
		<table class="table" id="tb_header">
			<thead>
			<tr>
				<th>Key</th>
				<th>Value</th>
				<th>Description</th>
				<th></th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td><input type="text" name="h_key[]" class="form-control" /></td>
				<td><input type="text" name="h_value[]" class="form-control" /></td>
				<td><input type="text" name="h_description[]" class="form-control" /></td>
				<td><button type="button" class="btn btn-danger bt_h_del">ลบ</button></td>
			</tr>
			
			</tbody>
		</table>
		
			
		</div>
	</div>
	<div class="form-group row hidden">
		<div class="col-md-2">
		<label for=":q1" class="form-control-label wf-right">Param string</label>
		</div>
		<div class="col-md-10">
		<table class="table" id="tb_param">
			<thead>
			<tr>
				<th>API Field</th>
				<th>Input Field</th>
				<th>Description</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td><input type="text" name="p_key[]" class="form-control" readonly /></td>
				<td><input type="text" name="p_value[]" class="form-control" readonly /></td>
				<td><input type="text" name="p_description[]" class="form-control" /></td>
			</tr>
			</tbody>
		</table>
		
			
		</div>
	</div>
	
	<div class="form-group row">
		<div class="col-md-2">
		<label for=":q1" class="form-control-label wf-right">Query string</label>
		</div>
		<div class="col-md-10">
		<table class="table" id="tb_query_string">
			<thead>
			<tr>
				<th>API Field</th>
				<th>Input Field</th>
				<th>Description</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td><input type="text" name="q_key[]" class="form-control" readonly /></td>
				<td><input type="text" name="q_value[]" class="form-control" readonly /></td>
				<td><input type="text" name="q_description[]" class="form-control" /></td>
			</tr>
			</tbody>
		</table>
		
			
		</div>
	</div>
	<div class="form-group row hidden">
		<div class="col-md-2">
		<label for=":q1" class="form-control-label wf-right">Body</label>
		</div>
		<div class="col-md-10">
			<div id="body_option">
				<label><input type="radio" value="none" /> None</label>
				<label><input type="radio" value="raw" /> Raw (text/json,text/plain)</label>
				<label><input type="radio" value="input" /> Input Editor (x-www-form-urlencoded,form-data)</label>
			</div>
			<div id="body_raw">
				<textarea class="form-control"></textarea>
			</div>
			<div id="body_raw">
				<button type="button" id="bt_body_input_add" class="btn btn-danger">เพิ่ม</button>
				<table class="table" id="tb_body_input">
					<thead>
					<tr>
						<th>API Field</th>
						<th>Input Field</th>
						<th>Description</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td><input type="text" name="m_key[]" class="form-control" /></td>
						<td><input type="text" name="m_value[]" class="form-control" /></td>
						<td><input type="text" name="m_description[]" class="form-control" /></td>
						<td><button type="button" class="btn btn-danger bt_body_input_del">ลบ</button></td>
					</tr>
					
					</tbody>
				</table>
				
			</div>
		</div>
	</div>
		
	<div class="form-group row">
		<div class="col-md-2">
		<label for=":q1" class="form-control-label wf-right">Respone Field Mapping</label>
		</div>
		<div class="col-md-10">
		<button type="button" id="bt_m_add" class="btn btn-danger">เพิ่ม</button>
		<table class="table" id="tb_response_field_mapping">
			<thead>
			<tr>
				<th>API Field</th>
				<th>Input Field</th>
				<th>Description</th>
				<th></th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td><input type="text" name="m_key[]" class="form-control" /></td>
				<td><input type="text" name="m_value[]" class="form-control" /></td>
				<td><input type="text" name="m_description[]" class="form-control" /></td>
				<td><button type="button" class="btn btn-danger bt_m_del">ลบ</button></td>
			</tr>
			
			</tbody>
		</table>
		
			
		</div>
	</div>
	
	<div class="form-group row">
		<div class="col-md-2">
		<label for=":q1" class="form-control-label wf-right">เครื่องมือช่วยพัฒนา</label>
		</div>
		<div class="col-md-10">
		<button type="button" id="bt_m_add" class="btn btn-primary" onclick="alert('Under Construction')">Generate โค้ดเพือเรียกใช้ใน Bizsmartflow</button>
		
			
		</div>
	</div>
	<script>
	$('#request_url').change(function(){
		let arr_param = getParam($(this).val()).filter((item)=>item.startsWith(":"));
		var tb_param = $('#tb_param tbody').html('');
		for(let i = 0;i<arr_param.length;i++){
			tb_param.append('<tr>\
				<td><input type="text" name="p_key[]" class="form-control" value="'+arr_param[i]+'" readonly /></td>\
				<td><input type="text" name="p_value[]" class="form-control" value="'+arr_param[i]+'" readonly /></td>\
				<td><input type="text" name="p_description[]" class="form-control" /></td>\
			</tr>');
		}
		
		let arr_query_string = getQueryString($(this).val()).filter((item)=>item.key && item.value);
		var tb_query_string = $('#tb_query_string tbody').html('');
		for(let i = 0;i<arr_query_string.length;i++){
			tb_query_string.append('<tr>\
				<td><input type="text" name="q_key[]" class="form-control" value="'+arr_query_string[i].key+'" readonly /></td>\
				<td><input type="text" name="q_value[]" class="form-control" value="'+arr_query_string[i].value+'" readonly /></td>\
				<td><input type="text" name="q_description[]" class="form-control" /></td>\
			</tr>');
		}
		
	})
	
	$('#bt_h_add').click(function(){
		$('#tb_header tbody').append('<tr>\
				<td><input type="text" name="h_key[]" class="form-control" /></td>\
				<td><input type="text" name="h_value[]" class="form-control" /></td>\
				<td><input type="text" name="h_description[]" class="form-control" /></td>\
				<td><button type="button" class="btn btn-danger bt_h_del">ลบ</button></td>\
			</tr>');
	});
	$('#tb_header').on('click','.bt_h_del',function(){
		$(this).parents('tr').remove();
	});
	
	
	$('#bt_m_add').click(function(){
		$('#tb_response_field_mapping tbody').append('<tr>\
				<td><input type="text" name="m_key[]" class="form-control" /></td>\
				<td><input type="text" name="m_value[]" class="form-control" /></td>\
				<td><input type="text" name="m_description[]" class="form-control" /></td>\
				<td><button type="button" class="btn btn-danger bt_m_del">ลบ</button></td>\
			</tr>');
	});
	$('#tb_response_field_mapping').on('click','.bt_m_del',function(){
		$(this).parents('tr').remove();
	});
	
	$('#bt_body_input_add').click(function(){
		$('#tb_body_input tbody').append('<tr>\
				<td><input type="text" name="body_input_key[]" class="form-control" /></td>\
				<td><input type="text" name="body_input_value[]" class="form-control" /></td>\
				<td><input type="text" name="body_input_description[]" class="form-control" /></td>\
				<td><button type="button" class="btn btn-danger bt_body_input_del">ลบ</button></td>\
			</tr>');
	});
	$('#tb_body_input').on('click','.bt_body_input_del',function(){
		$(this).parents('tr').remove();
	});
	
	function getParam(url){
		let temp = url.split('?')
		let str_url = temp.length>0?temp[0]:''; //http://domain/param1/param2
		let arr_param = str_url.replace('//','++').split('/'); //http://domain/param1/param2
		arr_param.shift()
		return arr_param
	}
	function getQueryString(url){
		let temp = url.split('?')
		let str_query = temp.length==2?temp[1]:''; //a=1&b=2
		let arr_query = str_query.split('&').map((x)=>({key:x.split('=')[0],value:x.split('=')[1]}))
		return arr_query
	}
	
	function loadHeader(headers){
		var tb_header = $('#tb_header tbody').html('')
		for(let i=0;i<headers.length;i++){
			tb_header.append('<tr>\
					<td><input type="text" name="h_key[]" class="form-control" value="'+headers[i].key+'" /></td>\
					<td><input type="text" name="h_value[]" class="form-control" value="'+headers[i].value+'" /></td>\
					<td><input type="text" name="h_description[]" class="form-control" value="'+headers[i].description+'" /></td>\
					<td><button type="button" class="btn btn-danger bt_h_del">ลบ</button></td>\
				</tr>');
		}
	}
	
	function loadQueryString(queries){
		var tb_query_string = $('#tb_query_string tbody').html('');
		for(let i = 0;i<queries.length;i++){
			tb_query_string.append('<tr>\
				<td><input type="text" name="q_key[]" class="form-control" value="'+queries[i].key+'" readonly /></td>\
				<td><input type="text" name="q_value[]" class="form-control" value="'+queries[i].value+'" readonly /></td>\
				<td><input type="text" name="q_description[]" class="form-control" value="'+queries[i].description+'" /></td>\
			</tr>');
		}
	}
	
	function loadParam(params){
		var tb_param = $('#tb_param tbody').html('');
		for(let i = 0;i<params.length;i++){
			tb_param.append('<tr>\
				<td><input type="text" name="p_key[]" class="form-control" value="'+params[i].key+'" readonly /></td>\
				<td><input type="text" name="p_value[]" class="form-control" value="'+params[i].value+'" readonly /></td>\
				<td><input type="text" name="p_description[]" class="form-control" value="'+params[i].description+'" /></td>\
			</tr>');
		}
	}
	
	
	function loadMappingField(map_fields){
		var tb_response_field_mapping = $('#tb_response_field_mapping tbody').html('');
		for(let i = 0;i<map_fields.length;i++){
			tb_response_field_mapping.append('<tr>\
				<td><input type="text" name="m_key[]" class="form-control" value="'+map_fields[i].key+'" /></td>\
				<td><input type="text" name="m_value[]" class="form-control" value="'+map_fields[i].value+'" /></td>\
				<td><input type="text" name="m_description[]" class="form-control" value="'+map_fields[i].description+'" /></td>\
			</tr>');
		}
	}
	
	function genJsonConfig(){
		var jsObj = JSON.parse('{"code":null,"name":null,"request":{"url":{"raw":null,"protocol":null,"host":[null],"port":null,"path":[null,null],"query":[],"param":[],"variable":[]},"method":null,"header":[],"body":"","description":""},"response":{"map_field":[]}}');
		jsObj.code = $('#API_CODE').val()
		jsObj.name = $('#DESCRIPTION').val()
		jsObj.request.method = $('#request_method').val()
		jsObj.request.url.raw = $('#request_url').val()
		jsObj.request.url.query = []
		jsObj.request.header = []
		jsObj.response.map_field = []
		
		$('#tb_query_string tbody tr').each(function(){
			jsObj.request.url.query.push({key:$(this).find('input[name="q_key[]"]').val(),
			value:$(this).find('input[name="q_value[]"]').val(),
			description:$(this).find('input[name="q_description[]"]').val()});
		})
		$('#tb_header tbody tr').each(function(){
			jsObj.request.header.push({key:$(this).find('input[name="h_key[]"]').val(),
			value:$(this).find('input[name="h_value[]"]').val(),
			description:$(this).find('input[name="h_description[]"]').val()});
		})
		$('#tb_response_field_mapping tbody tr').each(function(){
			jsObj.response.map_field.push({key:$(this).find('input[name="m_key[]"]').val(),
			value:$(this).find('input[name="m_value[]"]').val(),
			description:$(this).find('input[name="m_description[]"]').val()});
		})
		return JSON.stringify(jsObj, null, "\t");
	}
	 
	$(document).ready(function(){
		var json_config = JSON.parse($('#JSON_CONFIG').val());
		$('#API_CODE').val(json_config.code) //.change();
		$('#DESCRIPTION').val(json_config.name) //.change();
		$('#request_url').val(json_config.request.url.raw) //.change();
		$('#request_method').val(json_config.request.method)
		
		loadHeader(json_config.request.header);
		loadQueryString(json_config.request.url.query);
		//loadParam(json_config.request.url.param);
		loadMappingField(json_config.response.map_field)
		
		$('#JSON_CONFIG').prop('readonly',true)
		
	});
	$('body').on('change','input,select',function(){
		$('#JSON_CONFIG').html(genJsonConfig())
	})
	
	</script>