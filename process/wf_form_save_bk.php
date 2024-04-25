<?php
while($BSF_DET=db::fetch_array($sql_form)){
	
	switch($BSF_DET["FORM_MAIN_ID"]){
		case '1':	//textbox
		case '2': 	//textarea 
		case '4': 	//radio 
		case '7': 	//hidden 
		case '9': 	//select
		case '11': 	//Province
		case '12': 	//Amphur
		case '13': 	//Tambon
		case '14': 	//Zipcode
			if(trim($BSF_DET["WFS_FIELD_NAME"]) != ""){
				$wfield = checkFieldDB($wf_table,$BSF_DET["WFS_FIELD_NAME"]);
				$data_val = conText($_POST[$BSF_DET["WFS_FIELD_NAME"]]);
				if($wfield["type"] == "N"){ $data_val = str_replace(",","",$data_val); }
				if($wfield["type"] == "T" AND $wfield["len"] > 0){ $data_val = substr($data_val,0,$wfield["len"]); }
			
				$update_wf[$BSF_DET["WFS_FIELD_NAME"]] = $data_val;
			}
			break;
		case '3': //date
			$update_wf[$BSF_DET["WFS_FIELD_NAME"]] = date2db(conText($_POST[$BSF_DET["WFS_FIELD_NAME"]]));
			break;
		case '5': //checkbox
			if(trim($BSF_DET["WFS_FIELD_NAME"]) != ""){
				if($BSF_DET["WFS_INPUT_FORMAT"]=="M"){ //1 To M
					$num_c = conText($_POST[$BSF_DET["WFS_FIELD_NAME"].'_COUNT']);
					 for($c=0;$c<$num_c;$c++){
						 $chk_val = conText($_POST[$BSF_DET["WFS_FIELD_NAME"].'_'.$c]);
						 $REF_OPT = conText($_POST[$BSF_DET["WFS_FIELD_NAME"].'_'.$c.'_TYPE']);
						 $REF = explode("_",$REF_OPT);
						 if($chk_val != ""){
							$sql_opt = db::query("SELECT COUNT(CHECKBOX_ID) AS CHECKBOX_ID FROM WF_CHECKBOX WHERE WFS_FIELD_NAME = '".$BSF_DET["WFS_FIELD_NAME"]."' AND WFR_ID = '".$WFR."' AND CHECKBOX_TYPE = '".$REF[0]."' AND CHECKBOX_REF = '".$REF[1]."' AND W_ID = '".$W."'");
							$num_opt=db::fetch_array($sql_opt);
							if($num_opt["CHECKBOX_ID"] == 0){
								$insert_opt = array();
								$insert_opt['WFS_FIELD_NAME'] = $BSF_DET["WFS_FIELD_NAME"];
								$insert_opt['WFR_ID'] = $WFR;
								$insert_opt['CHECKBOX_VALUE'] = $chk_val;
								$insert_opt['CHECKBOX_TYPE'] = $REF[0];
								$insert_opt['CHECKBOX_REF'] = $REF[1];
								$insert_opt['W_ID'] = $W;
								db::db_insert("WF_CHECKBOX", $insert_opt, "CHECKBOX_ID");
								unset($insert_opt);
							}
						 }else{
								$del_opt = array();
								$del_opt['WFS_FIELD_NAME'] = $BSF_DET["WFS_FIELD_NAME"];
								$del_opt['WFR_ID'] = $WFR;
								$del_opt['CHECKBOX_TYPE'] = $REF[0];
								$del_opt['CHECKBOX_REF'] = $REF[1];
								$del_opt['W_ID'] = $W;
								db::db_delete("WF_CHECKBOX", $del_opt);
								unset($del_opt);
						 }
					 }
				}else{ //1 to 1
					$update_wf[$BSF_DET["WFS_FIELD_NAME"]] = conText($_POST[$BSF_DET["WFS_FIELD_NAME"]]);
				}
			}
			break;
		case '6': //browsefile 
		if($BSF_DET["WFS_FIELD_NAME"] != ""){
		$attach_folder = '../attach/w'.$W;
		if(!file_exists($attach_folder)){ mkdir($attach_folder,0777); }
			$rowsfile = count($_FILES[$BSF_DET["WFS_FIELD_NAME"]]["tmp_name"]);
				if($rowsfile > 0 AND trim($BSF_DET["WFS_INPUT_FORMAT"]) == "O" AND $_FILES[$BSF_DET["WFS_FIELD_NAME"]]["size"][0]>0){ //ตั้งค่าไฟล์เดียว
					$sql_attach = db::query("select FILE_ID,FILE_SAVE_NAME from WF_FILE where WFS_FIELD_NAME ='".$BSF_DET["WFS_FIELD_NAME"]."' AND WFR_ID='".$WFR."' AND WF_MAIN_ID = '".$W."' AND FILE_STATUS = 'Y' ");
					while($rec_a = db::fetch_array($sql_attach)){
						if(!file_exists($attach_folder.'/'.$rec_a["FILE_SAVE_NAME"])){ unlink($attach_folder.'/'.$rec_a["FILE_SAVE_NAME"]); }
							$up_opt = array();
							$at_cond = array();
							$up_opt['FILE_STATUS'] = 'R';
							$up_opt['DEL_USR'] = $_SESSION['WF_USER_ID'];
							$up_opt['DEL_DATE'] = date2db(date("d/m/").(date("Y")+543));
							$up_opt['DEL_TIME'] = date("H:i:s");
							$at_cond["FILE_ID"] = $rec_a["FILE_ID"];
							db::db_update("WF_FILE", $up_opt, $at_cond);
							unset($up_opt);
							unset($at_cond);
					}
				}
			for($a=0;$a<$rowsfile;$a++){
				if($_FILES[$BSF_DET["WFS_FIELD_NAME"]]["size"][$a]>0){
				
				$ext = explode('.',$_FILES[$BSF_DET["WFS_FIELD_NAME"]]["name"][$a]);
				$extension = strtolower($ext[(count($ext) - 1)]);
				$file_name = 'f'.date('YmdHis').'_'.bsf_random(10).'.'.$extension;
				
				copy($_FILES[$BSF_DET["WFS_FIELD_NAME"]]["tmp_name"][$a], $attach_folder.'/'.$file_name);
				@chmod($attach_folder.'/'.$file_name,0777);
					$insert_opt = array();
					$insert_opt['WFS_FIELD_NAME'] = $BSF_DET["WFS_FIELD_NAME"];
					$insert_opt['WFR_ID'] = $WFR;
					$insert_opt['FILE_NAME'] = conText($_FILES[$BSF_DET["WFS_FIELD_NAME"]]["name"][$a]);
					$insert_opt['FILE_SAVE_NAME'] = $file_name;
					$insert_opt['FILE_EXT'] = $extension;
					$insert_opt['FILE_SIZE'] = $_FILES[$BSF_DET["WFS_FIELD_NAME"]]["size"][$a];
					$insert_opt['FILE_TYPE'] = $_FILES[$BSF_DET["WFS_FIELD_NAME"]]["type"][$a];
					$insert_opt['FILE_DATE'] = date2db(date("d/m/").(date("Y")+543));
					$insert_opt['FILE_TIME'] = date("H:i:s");
					$insert_opt['FILE_STATUS'] = 'Y';
					$insert_opt['WF_MAIN_ID'] = $W;
					$insert_opt['USR_ID'] = $_SESSION['WF_USER_ID'];
					db::db_insert("WF_FILE", $insert_opt, "FILE_ID");
					unset($insert_opt);
				}
			}
		}
			break;
		case '10': //Coding
			if(trim($BSF_DET["WFS_CODING_POST"]) != ''){
				$c_save = explode(',',trim($BSF_DET["WFS_CODING_POST"]));
				foreach($c_save as $val){
					$update_wf[trim($val)] = conText($_POST[trim($val)]);
				}
			}
			if($BSF_DET["WFS_CODING_SAVE"] != '' AND file_exists('../save/'.$BSF_DET["WFS_CODING_SAVE"])){
				include('../save/'.$BSF_DET["WFS_CODING_SAVE"]);
			}
			break;
		case '16': //Form
			if(trim($BSF_DET["WFS_FORM_ADD_POPUP"]) == 'Y' AND $FLAG_ADD == "Y" AND conText($_POST["F_TEMP_ID"]) != "" AND $BSF_DET["WFS_FORM_SELECT"] != ''){
				$sql_form = db::query("select WF_MAIN_SHORTNAME,WF_FIELD_PK from WF_MAIN where WF_MAIN_ID = '".$BSF_DET["WFS_FORM_SELECT"]."'");
				$rec_main_form = db::fetch_array($sql_form);
					$up_opt = array();
					$at_cond = array();
					$up_opt['WFR_ID'] = $WFR;
					$up_opt['F_TEMP_ID'] = $WFR;
					$at_cond["F_TEMP_ID"] = conText($_POST["F_TEMP_ID"]);
					db::db_update($rec_main_form['WF_MAIN_SHORTNAME'], $up_opt, $at_cond);
					unset($up_opt);
					unset($at_cond);
			}
			break;
	}
}
?>