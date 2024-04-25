<?php
include "../include/config.php";
$source_folder = '../bizsmartdoc';
if(!file_exists($source_folder)){ mkdir($source_folder,0777); }
$target_folder = '../controlversion';
if(!file_exists($target_folder)){ mkdir($target_folder,0777); }

 

  if ($dh = opendir($source_folder)){
    while (($file = readdir($dh)) !== false){
		if($file !="." AND $file !=".."){
			
			$dir = explode('.',$file);
			if($dir[1] == "docx"){
				$fname = explode("v",$dir[0]);
				$fname1 = substr($fname[0], 3);
				$fname2 = explode("_",$fname1);
				if($fname2[0] != "" AND $fname2[1] != "" AND $fname2[2] != ""){
				$DOC_ID = $fname2[2];
				$WFR_ID = $fname2[1];
				$W_ID = $fname2[0];
				$sql_doc_main = db::query("SELECT DOC_ID FROM DOC_MAIN WHERE DOC_ID = '".$DOC_ID."' AND WF_MAIN_ID = '".$W_ID."'");
				$doc_main = db::fetch_array($sql_doc_main);
					if($doc_main['DOC_ID'] != ""){
						if(!file_exists($target_folder."/w".$W_ID)){ mkdir($target_folder."/w".$W_ID,0777); }
						$mysize = filesize($source_folder."/".$file);
						$new_file = "cv".date("YmdHis").'_'.$WFR_ID.'_'.$DOC_ID.'_'.bsf_random(18).".".$dir[1];
						copy($source_folder."/".$file,$target_folder."/w".$W_ID."/".$new_file);
						@chmod($target_folder."/w".$W_ID."/".$new_file,0777);
						unlink($source_folder."/".$file);
						$insert_opt = array();
						$insert_opt['WF_MAIN_ID'] = $W_ID;
						$insert_opt['WFR_ID'] = $WFR_ID;
						$insert_opt['DOC_ID'] = $DOC_ID;
						$insert_opt['DV_FILE_NAME'] = $file;
						$insert_opt['DV_PATH'] = $new_file;
						$insert_opt['DV_SIZE'] = $mysize;
						$insert_opt['DV_DATE'] = date2db(date("d/m/").(date("Y")+543));
						$insert_opt['DV_TIME'] = date("H:i:s"); 
						db::db_insert("DOC_VERSION", $insert_opt, "DV_ID");
						unset($insert_opt);
					}
				}
			}
		}
    }
    closedir($dh);
  }




db::db_close();
 ?>