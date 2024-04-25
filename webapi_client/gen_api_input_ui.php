<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);
	
	$_GET['api_code'] = 'revive-001';
	$sql = "select * from m_api_client_setting where api_code='".$_GET['api_code']."'";
	$result = db::query($sql);
	$rec = db::fetch_array($result);

	$arr_config = json_decode(html_entity_decode($rec['JSON_CONFIG']),true);
	$arr_request = $arr_config['request'];
	$arr_response = $arr_config['response'];
	

	$html = '<div class="form-group row">';
	foreach($arr_request['url']['query'] as $str_query){
	$html .='<div id="'. $str_query['value'].'_BSF_AREA" class="col-md-2 ">
			<label for="'. $str_query['value'].'" class="form-control-label wf-right">'. $str_query['description'].'</label>
			</div>
			<div id="'. $str_query['value'].'_BSF_AREA" class="col-md-3 wf-left">
			<input type="text" name="'. $str_query['value'].'" id="'. $str_query['value'].'" class="form-control" value="">
		
		</div>';
	}

	
	$html .=
		'<div class="col-md-5 wf-right">
			<button type="button" class="btn btn-primary waves-effect waves-light" onclick="call_api_service_'.str_replace('-','_',$rec['API_CODE']).'()">
			<i class="fa fa-plus-circle"></i> ตรวจสอบ</button>
		</div>
	</div>';
	
	$html .=	'<script>
		function call_api_service_'.str_replace('-','_',$rec['API_CODE']).'(){

			$.ajax({
				url : "http://103.208.27.224:81/led_service_api/webapi_client/call_api.php?api_code='.$rec['API_CODE'].'",
				type : "GET",
				dataType : "JSON",
				success : function(response){
					if(response.status == "success"){';
					foreach($arr_response['map_field'] as $web_field => $api_field){
	$html .=			'$("#'.$web_field.'").val(response.'.$api_field.');';
					}
	$html .=		'}';
	if(false){
	$html .=		'else{';
						//$("#IS_FF").val("N").trigger("change");
	$html .=		'}';
	}
	$html .=	'}
			});
		}
	</script>';
	echo $html;
?>