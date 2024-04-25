<?php 
header("Content-Type: application/javascript");
require('../bizsmartdoc.config.php'); 
?>base_url = '<?php echo $config['base_url']; ?>bizsmartdoc/';
$(document).ready(function () {
    $('.md-input-file').each(function () {
        var WFS_FIELD_NAME = $(this).find('[type=file]').attr('id');

        if ($('#pe_box_' + WFS_FIELD_NAME).length === 0 && typeof WFS_FIELD_NAME != 'undefined') {
            var html_string =
                    '<div id="pe_box_' + WFS_FIELD_NAME + '" class="pdf-editor-box">\
				<span class="md-add-on-file" style="padding-right:10px;">\
					<button class="btn btn-primary waves-effect waves-light btn-scan" title="scan pdf"><i class="zmdi zmdi-scanner"></i> แสกนไฟล์</button>\
				</span>\
				<div class="hidden">\
					<input type="hidden" class="app-url" value="http://localhost:379/?service_config=' + btoa(base_url + 'bizsmartdoc.proc.php?proc=getMetaInfo&cookieHeader=' + document.cookie) + '">\
					<input type="hidden" name="pe_wfs_field_name[]" value="' + WFS_FIELD_NAME + '" />\
					<input type="hidden" name="pe_file_base64[]"  value="" />\
					<input type="hidden" name="pe_thumbnail_base64[]" value="" />\
					<input type="hidden" name="pe_ocrtext_base64[]" readonly />\
					<input type="hidden" name="pe_filename[]" readonly />\
				</div>\
			</div>';
			$(this).parent().prepend(html_string);
			var btn_upload_width= $(this).parent().find('.md-add-on-file').width();
			var btn_scan_width = $(this).parent().find(".pdf-editor-box>.md-add-on-file").width();
			
			$(this).find('[type=file]')
				.css({width:btn_upload_width, left:btn_scan_width})
				.click(function(){
					var div_bizsmartdoc_box = $(this).parent().parent().find('.pdf-editor-box');
					div_bizsmartdoc_box.find("[name='pe_file_base64[]']").val('');
					div_bizsmartdoc_box.find("[name='pe_ocrtext_base64[]']").val('');
					div_bizsmartdoc_box.find("[name='pe_thumbnail_base64[]']").val('');
					div_bizsmartdoc_box.find("[name='pe_filename[]']").val('');
					div_bizsmartdoc_box.parent().find('.md-input-file>.md-form-file').val('');
				});
            $(this).find('.md-form-file').prop('disabled',true);
            
        }
    });

    $('.btn-scan').click(function (event) {

        event.preventDefault();

		var app_url = $('.app-url').val();
        div_box = $(this).parent().parent();

        $.ajax({
            url: app_url,
            type: 'get',
            dataType: "json",
            cache: false,
			async: false,
            beforeSend: function () {
                swal({
                    title: "",
                    text: '<img src="'+base_url+'images/loading.gif" />',
					html:true,
                    showConfirmButton: false
                });
            },
            success: function (responseData) {

                if (responseData.result == 'OK') { 

					pe_file_base64 = responseData.data.pdfBase64;
					pe_thumbnail_base64 = responseData.data.thumbnailPngBase64;
					pe_ocrtext_base64 = responseData.data.ocrTextBase64;
					 swal(
                            {
                                title: '<div style="font-size:10pt;font-weight: bold;text-align:left">PDF Editor Service</div>',
                                text: '<br /><h6>กรุณาระบุชื่อไฟล์</h6><p><label style="width:100%;"><img src="data:image/png;base64,'+pe_thumbnail_base64+'" />  <input type="text" id="pe_filename" value="file" class="form-control" style="max-width:250px;display:inline-block;" required />.pdf</label></p>',
								html: true,
                                type: "",
                                showCancelButton: true,
                                confirmButtonClass: "btn-danger",
                                confirmButtonText: "ตกลง",
                                cancelButtonText: "ยกเลิก",
                                closeOnConfirm: true
                            },
                            function () {

								$(div_box).find("[name='pe_file_base64[]']").val(pe_file_base64);
								$(div_box).find("[name='pe_thumbnail_base64[]']").val(pe_thumbnail_base64);
								$(div_box).find("[name='pe_ocrtext_base64[]']").val(pe_ocrtext_base64);
								$(div_box).find("[name='pe_filename[]']").val($('#pe_filename').val()?$('#pe_filename').val()+'.pdf':'file.pdf');
								$(div_box).parent().find('.md-input-file>.md-form-file').val($(div_box).find("[name='pe_filename[]']").val());

						}
					);

                } else {
                    swal("Error!", responseData.message, "error");
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Error!", "Cannot Connect to the service.", "error");
            }
        });

    });

    $("[id^='BSA_FILE'][title$='.pdf']").each(function () {
        var func_onclick = $(this).find('div.f-right a').attr('onclick')
        func_onclick = func_onclick.replace('wf_file_d', 'wf_file_e');

        $(this).find('div.f-right').prepend('<a href="#!" onclick="' + func_onclick + '"><i class="icofont icofont-ui-edit"></i></a>');

    });
});

function wf_file_e(w, f, wfr, txt) {
    if (w != '' && f != '' && wfr != '') {

		var id = w + '-' + f + '-' + wfr;
        var app_url = 'http://localhost:379/?service_config=' + btoa(base_url + 'bizsmartdoc.proc.php?proc=getMetaInfo&cookieHeader=' + document.cookie + '&id=' + id);
        $.ajax({
            url: app_url,
            type: 'get',
            dataType: "json",
            cache: false,
            async: false,
            beforeSend: function () {
                swal({
                    title: "",
                    text: '<img src="'+base_url+'images/loading.gif" />',
					html:true,
                    showConfirmButton: false
                });
            },
            success: function (responseData) {
                if (responseData.result == 'OK') {
					pe_file_base64 = responseData.data.pdfBase64;
					pe_thumbnail_base64 = responseData.data.thumbnailPngBase64;
					pe_ocrtext_base64 = responseData.data.ocrTextBase64;
                
                    swal(
                            {
                                title: '<div style="font-size:10pt;font-weight: bold;text-align:left">PDF Editor Service</div>',
                                text: '<br /><h6>คุณต้องการบันทึกไฟล์หรือไม่?</h6><p><img src="data:image/png;base64,'+pe_thumbnail_base64+'" /> ' + txt + ' </p><br /><p><small><label><input type="checkbox" id="pe_replace_file" value="Y" checked /> เขียนทับไฟล์เวอร์ชันปัจจุบัน</label></small></p>',
								html: true,
                                type: "",
                                showCancelButton: true,
                                confirmButtonClass: "btn-danger",
                                confirmButtonText: "ยืนยันการบันทึก",
                                cancelButtonText: "ยกเลิก",
                                closeOnConfirm: true
                            },
                            function () {
                                /*var dataString = 'pe_wfr_id=' + wfr + '&pe_wf_main_id=' + w + '&pe_file_id=' + f + '&pe_filename='+txt+'&pe_file_base64=' + pe_file_base64 + '&pe_thumbnail_base64=' + pe_thumbnail_base64;*/
								proc =$("#pe_replace_file").is(':checked')?'updatePdf':'storePdf';
                                $.ajax({
                                    type: "POST",
                                    url: base_url+'bizsmartdoc.proc.php?proc='+proc,
                                    data: 
										{
											pe_wfr_id:wfr,
											pe_wf_main_id:w,
											pe_file_id:f,
											pe_filename:txt,
											pe_file_base64:pe_file_base64,
											pe_ocrtext_base64:pe_ocrtext_base64,
											pe_thumbnail_base64:pe_thumbnail_base64
										},
                                    cache: false,
									dataType: "json",
                                    success: function (responseData) {
										if (responseData.result == 'OK') {
											data = responseData.data
											swal({title: "Success!", text: responseData.message, type: "success"},
													function () {
														if(proc==='storePdf'){ 
															$('#BSA_FILE'+f)
																.attr('id','BSA_FILE'+data.pe_file_id)
																.attr('title',data.pe_filename)
																.html('<b class="fa fa-file-pdf-o text-danger"></b> <a href="'+data.pe_file_url+'" target="_blank">'+data.pe_filename+'</a><div class="f-right"><a href="#!" onclick="wf_file_e(\''+data.pe_wf_main_id+'\',\''+data.pe_file_id+'\',\''+data.pe_wfr_id+'\',\''+data.pe_filename+'\');"><i class="icofont icofont-ui-edit"></i></a><a href="#!" onclick="wf_file_d(\''+data.pe_wf_main_id+'\',\''+data.pe_file_id+'\',\''+data.pe_wfr_id+'\',\''+data.pe_filename+'\');"><i class="icofont icofont-ui-delete"></i></a></div>');
														}
													});
										}else{
											swal("Error!", responseData.message, "error");
										}
                                    },
                                    error: function (xhr, status, errorThrown) {
                                        //xhr.status;
                                        swal("Error!", xhr.responseText, "error");
                                    }
                                });

                            }
                    );



                } else {
                    swal("Error!", responseData.message, "error");
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Error!", "Cannot Connect to the service.", "error");
            }
        });

    }
}