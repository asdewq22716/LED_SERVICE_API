<?php 
	// print_r($_POST);
		$sql = "SELECT * FROM M_ANC_WEBSITE WHERE 1=1 ORDER BY ANC_WEBSITE_ID DESC";
		$query = db::query($sql);
		$i=1;
		$checked = '';
			while($res = db::fetch_array($query)){
			
			if($res['ANC_WEBSITE_STATUS'] != 0){
				$checked = 'checked';
			}else{
				$checked = '';
			}

			echo '<script> setTimeout(function(){';

				if($i == 1 ){
					echo '$( "th:first" ).prepend(`<div class="checkbox-color checkbox-primary col-xs-12"><input type="checkbox" id="CHK_ALL" name="CHK_ALL value="" aria-required="true"><label for="CHK_ALL"></label></div>`);$("#CHK_ALL").click(function(){ $("input:checkbox").not(this).prop("checked", this.checked);});';
				}

			echo '$("#tr_wfr_'.$res["ANC_WEBSITE_ID"].' td:nth-child(1)").html(`<div class="checkbox-color checkbox-primary col-xs-12"><input type="checkbox" id="CHK_'.$res["ANC_WEBSITE_ID"].'" name="CHK[]" value="'.$res["ANC_WEBSITE_ID"].'" aria-required="true"'.$checked.'><label for="CHK_'.$res["ANC_WEBSITE_ID"].'"></label></div>`); $(".bg-primary th:nth-child(2)").text(`ลำดับ`); $("#tr_wfr_'.$res["ANC_WEBSITE_ID"].' td:nth-child(2)").html(`'.($i).'`);';
			// echo "  $(document).ready(function(){
						// $('input[id^=CHK_]').click(function(){
							// var data = $(this).val();
							// console.log(data);
						// });	
					// });  ";
			
			echo '}, 100);</script>';
			$i++;
			}
			
			?>