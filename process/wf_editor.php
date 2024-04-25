<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php'; 
$coding = wf_decode(wf_decode(conText($_GET["p"])));
if(file_exists($coding) AND $coding !=""){
	$size= filesize($coding);
	$fp = fopen ($coding,'r');
	$file_code = fread( $fp, $size);
	@fclose($fp);
function nl2br2($string) { 
$string = str_replace(array("\r\n", "\r", "\n"), "\\n", $string); 
$string = str_replace("<script","<'+'script", $string);
$string = str_replace("</script>","</'+'script>", $string);
return $string; 
}
?>
			<!-- Row end -->
			<form action="wf_editor_function.php" method="post"  id="form_editor" name="form_editor">
				<!-- Row Starts -->

								<div class="row">
									<div class="col-lg-12">
										<div id="editor"></div>

										</div>
										<input type="hidden" name="php_code" id="php_code"><input type="hidden" name="pcode" id="pcode" value="<?php echo wf_encode(wf_encode($coding)); ?>">
										
								</div>
										<div align="center"><br />
											<button type="button" class="btn btn-success waves-effect waves-light" onclick="save_editor()"> 
												<i class="fa fa-save"></i> บันทึกการแก้ไข
											</button>
										</div>
							
				<!-- Row end -->
			</form>
			<!-- Container-fluid ends -->
<!-- custom js -->
<script type="text/javascript">
"use strict";
AUI().ready('aui-ace-editor', function(A) {
    var editor = new A.AceEditor(
        {
            boundingBox: '#editor',

            //highlightActiveLine: true,
            // readOnly: true,
             //tabSize: 16,
             //useSoftTabs: true,
             useWrapMode: true,
            // showPrintMargin: false,
            mode: 'php',
			value:'<?php echo str_replace("<?php","<'+'?php",nl2br2(addslashes($file_code))); ?>'
        }
    ).render();

		editor.getEditor().setTheme('ace/theme/vibrant_ink');
		editor.getEditor().setFontSize('14px');
		var input = $('#php_code');
		input.val(editor.getSession().getValue());
        editor.getSession().on("change", function () {
        input.val(editor.getSession().getValue());
		});
});

function save_editor(){
	var url = "wf_editor_function.php"; // the script where you handle the form input.

	$.ajax({
		   type: "POST",
		   url: url,
		   data: $("#form_editor").serialize(), // serializes the form's elements.
		   success: function(data)
		   {
				$('#bizModal').modal('hide');
				swal({
							  title: "บันทึกเรียบร้อยแล้ว", 
							  type: "success",
							  allowOutsideClick:true
							});
		   }
		 });

	e.preventDefault(); // avoid to execute the actual submit of the form.
}
</script>

<?php db::db_close(); } ?>