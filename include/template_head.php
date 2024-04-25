    <title><?php echo $template['title'] ?> BizSmartFlow 4.0</title>
    <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]> -->

  <!--  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>-->
    
    <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="robots" content="noindex,nofollow">
       <!-- Favicon icon -->
      <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
      <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">

      <!-- Google font
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">-->

      <!-- iconfont -->
       <link rel="stylesheet" type="text/css" href="../assets/icon/icofont/css/icofont.css">

    <!-- simple line icon -->
    <link rel="stylesheet" type="text/css" href="../assets/icon/simple-line-icons/css/simple-line-icons.css">

    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">

	<!-- Responsive.css-->
	<link rel="stylesheet" type="text/css" href="../assets/css/main.css">
	
	<!-- Responsive.css-->
	<link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">

    <!-- Dark layout -->
	<!-- Uncomment this line for Dark layout
	<link rel="stylesheet" type="text/css" href="../assets/css/color/inverse.css" id="color">
	 -->
	
	<link rel="stylesheet" type="text/css" href="../assets/css/color/color-<?php if($WF_TYPE=="W"){ echo "w"; }elseif($WF_TYPE=="F"){ echo "f"; }elseif($WF_TYPE=="M"){ echo "m"; }else{ echo "4"; } ?>.css" id="color">
	
		<!-- Font Awesome -->
	<link href="../assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- select2 css -->
	<link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css" />
	<!-- Bootstrap Date-Picker css -->
	<!--<link rel="stylesheet" href="../assets/plugins/bootstrap-datepicker/css/bootstrap-datetimepicker.css" />
	<link rel="stylesheet" type="text/css" href="../assets/plugins/bootstrap-datepicker/css/daterangepicker.css" />-->
	<link rel="stylesheet" href="../assets/plugins/bootstrap-datepicker3/datepicker3.css">

	<!-- Material Icon -->
    <link rel="stylesheet" type="text/css" href="../assets/icon/material-design/css/material-design-iconic-font.min.css">
	<!-- typicon icon -->
    <link rel="stylesheet" type="text/css" href="../assets/icon/typicons-icons/css/typicons.min.css">
	<!-- ion icon css -->
    <link rel="stylesheet" type="text/css" href="../assets/icon/ion-icon/css/ionicons.min.css">
	<!-- Switchery css -->
	<link rel="stylesheet" type="text/css" href="../assets/plugins/switchery/css/switchery.min.css">
	<!-- Sweetalert CSS -->
	<link rel="stylesheet" type="text/css" href="../assets/plugins/sweetalert/css/sweetalert.css">
	<!-- Modal animation CSS -->
	<link rel="stylesheet" type="text/css" href="../assets/plugins/modal/css/component.css">
	<!-- Checkbox3 CSS -->
	<link rel="stylesheet" type="text/css" href="../assets/plugins/checkbox3/checkbox3.min.css">
	<!-- Light Box css -->
	<link rel="stylesheet" type="text/css" href="../assets/plugins/light-box/css/ekko-lightbox.css">
	<!-- Light Box 2 css -->
	<link rel="stylesheet" type="text/css" href="../assets/plugins/light-box2/css/lightbox.css">
	<script type="text/javascript" src="../assets/js/jquery-3.1.1.min.js"></script>
	<link href="../assets/summernote/summernote-lite.css" rel="stylesheet">
    <script src="../assets/summernote/summernote-lite.js"></script>
	<script type="text/javascript">
		function get_wfs_show(obj_target,url,dataString,w_method,show){ 
		if(w_method==""){ w_method = "GET";}
		if(show==""){ show = "W";}
			$.ajax({
				type: w_method,
				url: url,
				data: dataString,
				cache: false,
				success: function(data){
					if(show=='A'){
						$('#'+obj_target).append(data);
					}else{
						$('#'+obj_target).html(data);
					}
				} 
			 });
		}
		function get_wfs_form(obj_target,url,form_id,w_method,show){
		if(w_method==""){ w_method = "GET";}
		if(show==""){ show = "W";}
			var dataString = $("#"+form_id).serialize();
			$.ajax({
				type: w_method,
				url: url,
				data: dataString,
				cache: false,
				success: function(data){
					$('#'+obj_target).html(data);
				} 
			 });
		}
	</script>
	<style>
	 .scrollup {
		 position: fixed;
		 bottom: 100px;
		 right: 30px;
		 display: none;
		 z-index: 998;
		 background: #1b8bf9;
		 color: #fff;
		 border-radius: 100px;
		 height: 50px;
		 width: 50px;
		 line-height: 1.5;
		 padding-left: 0;
		 padding-right: 0;
	 }
	 .scrollup:hover {
		 border: 1px solid #1b8bf9;
	 }
	 .scrollup-icon{
		 color: #fff !important;
		 padding: 0 10px;
		 font-size: 31px;
	 }
	 .bg-primary a{
		font-weight:bold;
		color:#FFFFFF;
	 }
	input[type=text]{
		min-width: 100px;
	}
	textarea{
		min-width: 120px;
	}
	table.table thead th{
		vertical-align: middle;
		text-align:center
	}
	#wf_space{
		padding-top: 50px;
	}
	#wf_space .form-group {
		margin-bottom: 0px;
	}	
	#wf_space .card-header {
		margin-bottom: 1rem;
	}
	#wf_space div[class^="col-"] {
		margin-bottom: 1rem;
	} 
	.note-icon-caret{
		display:none;
	}
	</style>