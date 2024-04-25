<?php
$HIDE_HEADER = 'Y';
include '../include/comtop_user.php'; 

$W = conText($_GET['W']);
$WFR = conText($_GET['WFR']);
$WF_TYPE = conText($_GET['WF_TYPE']);

if($_GET["WFD_ID"] == ''){
	$WFD_ID = 0;
}else{
	$WFD_ID = conText($_GET['WFD_ID']);
}

	$sql = db::query("SELECT MESSAGE_ID,USR_ID,MESSAGE_DETAIL,MESSAGE_DATE,MESSAGE_TIME FROM WF_MESSAGE WHERE WF_MAIN_ID='".$W."' AND WFR_ID='".$WFR."' AND WFD_ID='".$WFD_ID."'");


?>

	<form method="post" name="form_message" id="form_message" action="message_form_function.php">
        <!-- Row Starts -->
        <div class="card" >
			<div class="card-header">
				<h5 class="card-header-text"><i class="icofont icofont-comment m-r-5"></i>Message</h5> 
			</div>
			<div class="card-block" >
				<ul class="media-list">
					<?php
					while($rec_field = db::fetch_array($sql)){
						$sql_usr = db::query("SELECT USR_PREFIX,USR_FNAME,USR_LNAME,USR_PICTURE FROM USR_MAIN WHERE USR_ID = '".$rec_field["USR_ID"]."' ");
						$G = db::fetch_array($sql_usr);
						$user = $G["USR_PREFIX"].$G["USR_FNAME"]." ".$G["USR_LNAME"];
						if($G["USR_PICTURE"] != "" AND file_exists("../profile/".$G["USR_PICTURE"])){
							$usr_pic = "../profile/".$G["USR_PICTURE"];
						}else{
							$usr_pic = "../assets/images/avatar-2.png";
						}
					?>
						<li class="media">
						
							<div class="media-left">
								<a href="#">
									<img class="media-object img-circle comment-img" src="<?php echo $usr_pic;?>" alt="Generic placeholder image">
								</a>
								
							</div>
							<div class="media-body">
								<h6 class="media-heading txt-primary"><?php echo $user;?><span class="f-12 text-muted m-l-5"><?php echo db2date($rec_field["MESSAGE_DATE"]).' '.$rec_field["MESSAGE_TIME"];?></span>
								<?php 
								if($_SESSION["WF_USER_ID"] == $rec_field["USR_ID"]){?>
									<span class="f-right"><button type="button"  class="btn btn-flat flat-danger btn-mini txt-danger waves-effect waves-light" title="ลบ Message" onclick="delete_message('<?php echo $rec_field["MESSAGE_ID"];?>');"><i class="icofont icofont-trash"></i></button></span>
							<?php }?>
								
								</h6>
								
								<p><?php echo nl2br($rec_field["MESSAGE_DETAIL"]);?></p>
								<hr>
							</div>
							
						</li>			
					<?php }?>
				</ul>
				<div class="md-float-material d-flex">
					<div class="md-group-add-on p-relative col-xs-12">
					  <!--<span class="md-add-on">
					  <i class="icofont icofont-comment"></i>
					  </span>
						<div class="md-input-wrapper">
							<input type="text" name="MESSAGE_DETAIL" id="MESSAGE_DETAIL" class="md-form-control" required>
							<label>Write Comment</label>
						</div>-->
						<textarea name="MESSAGE_DETAIL" id="MESSAGE_DETAIL" class="form-control" required></textarea>
						
					</div>
				</div>
				<div class="md-float-material d-flex">
					<div class="col-lg-4 text-right">
						<button type="submit" class="btn btn-primary btn-mini waves-effect waves-light">
							<i class="icofont icofont-plus"></i><span class="m-l-10">Send</span>
						</button>
					</div>
				</div>
			</div>
		</div>
            <!-- Row end -->
			 
        <div class="row">
			<div class="col-md-12 text-center"> 
				
				<!--<input type="submit" name="btnSave" id="btnSave" class="btn btn-md btn-success" value="บันทึก" />-->
				<input type="hidden" name="WF_TYPE" id="WF_TYPE" value="<?php echo $WF_TYPE;?>" />
				<input type="hidden" name="process" id="process" value="add">
				<input type="hidden" name="WFR" id="WFR" value="<?php echo $WFR;?>" />
				<input type="hidden" name="WFD_ID" id="WFD_ID" value="<?php echo $WFD_ID;?>" />
				<input type="hidden" name="W" id="W" value="<?php echo $W;?>" />
				

			</div> 
        </div>
        <div class="row"> 
          <div class="main-header">
          </div>
        </div>
    </form>
	<!-- Container-fluid ends -->
	
<script type="text/javascript">
	$("#form_message").submit(function(e) {
		var url = "message_form_function.php"; 
		$.ajax({
			   type: "POST",
			   url: url,
			   data: $("#form_message").serialize(),
			   success: function(data)
			   {
				 
				 if(data == "."){
					 
					var dataString = 'W=<?php echo $W;?>&WFD=<?php echo $WFD_ID;?>&WFR=<?php echo $WFR;?>&WF_TYPE=<?php echo $WF_TYPE;?>';
					$.ajax({
					 type: "GET",
					 url: "message_form.php",
					 data: dataString,
					 cache: false,
					 success: function(html){
					  $("#message_detail").html(html);
					 }
					 });
				 }else{
					$("#show_error1").show();
					$("#text_error").html(data);
				 }
			   }
			 });

		e.preventDefault(); 
	});	
	
	function delete_message(id){
	
		swal({
				title: "",
				text: "คุณต้องการลบข้อความนี้ใช่หรือไม่ ?",
				type: "warning",
				html: true,
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "ลบข้อมูล",
				cancelButtonText: "ยกเลิก",
				closeOnConfirm: true,
				closeOnCancel: true
			},
		function(isConfirm){
			if (isConfirm) {
				var dataString = 'process=del&W=<?php echo $W;?>&WFD=<?php echo $WFD_ID;?>&WFR=<?php echo $WFR;?>&MS_ID='+id;
				$.ajax({
				 type: "GET",
				 url: "message_form_function.php",
				 data: dataString,
				 cache: false,
				 success: function(html){
						
					if(html == "."){
						var dataString = 'W=<?php echo $W;?>&WFD=<?php echo $WFD_ID;?>&WFR=<?php echo $WFR;?>&WF_TYPE=<?php echo $WF_TYPE;?>';
						$.ajax({
						 type: "GET",
						 url: "message_form.php",
						 data: dataString,
						 cache: false,
						 success: function(html){
						  $("#message_detail").html(html);
						 }
						 });
					 }
				 }
				 });

				return true;
			}else{
				 return false;
			}

		});
		
	}

	
	
</script>
<?php 
include '../include/combottom_user.php'; ?>
