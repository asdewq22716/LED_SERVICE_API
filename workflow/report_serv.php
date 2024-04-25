<?php
$HIDE_HEADER = "Y";
if($rec_main['WF_SERVICES_TYPE'] == ''){ //Json
	header('Content-Type: application/json');
	
	$arr_report = array();
	$arr_report = bsf_load_report($_GET['W']);
	$arr_head = array();
	$array_a = array();
	foreach($arr_report as $key => $arr_data){
		if($key == 0){
			foreach($arr_data as $k_head => $v_head){
				$arr_head[$k_head] = $arr_data[$k_head]['text'];
			}
		}else if($key != 'T'){
			foreach($arr_data as $k_data => $v_data){
				$array_a[$key-1][$arr_head[$k_data]] = $v_data['text']; 
			}
		}
	}
	$data = json_encode($array_a,JSON_NUMERIC_CHECK);
}else if($rec_main['WF_SERVICES_TYPE'] == 1){ //Soap
	
}
?>
<div class="content-wrapper">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<div class="row" id="animationSandbox">
			<div class="col-sm-12">
				<div class="main-header">
					<h4><?php echo $rec_main['WF_MAIN_NAME']; ?></h4>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-block">
						<div class="form-group row">
							<div class="col-md-12"> 
								<label for="" class="form-control-label"><?php echo $data;?>&nbsp;</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Container-fluid ends -->
</div>
<?php include '../include/combottom_js_user.php'; 
include '../include/combottom_user.php'; ?>