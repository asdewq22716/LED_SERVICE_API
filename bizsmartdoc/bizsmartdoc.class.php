<?php 
	class BizSmartDoc{
		private $temp_path;
		private $encrypt_key;
		function __construct(){
			$this->encrypt_key = 'oGSxcSNVPfqp8tWSMCgD5wzqaU9O1zc4'; /*must be the some key with the Pdf Editor Service (WinApp)*/
		}
		/*
		private function writeFile($destPath){
			$putdata = fopen("php://input", "r");

			/* Open a file for writing * /
			$fp = fopen($destPath, "w");

			/* Read the data 1 KB at a time
			   and write to the file * /
			while ($data = fread($putdata, 1024))
			  fwrite($fp, $data);

			/* Close the streams * /
			fclose($fp);
			fclose($putdata);
		}
		
		private function writeBase64ToFile($destPath,$postKey){
			$putdata = base64_decode($_POST[$postKey]);
			if($putdata){
				file_put_contents($destPath, $putdata);
			}
		}
		*/
		public function getOcrText($length=1000){
			$ocrText = str_replace("'", "''", base64_decode($_POST['ocrTextBase64']));
			return substr($ocrText,0,min($length,strlen($ocrText)));
		}
		
		public function genMetaInfo($a_input){
			///get json info for pdf editor
			if($a_input['id']){
				$arr_data = array();
				$arr_data['data'] = array();
				$arr_data['data']['procUrl'] = $a_input['procUrl'];
				$arr_data['data']['cookieHeader'] = $a_input['cookieHeader'];
				$arr_data['data']['id'] = $a_input['id'];
				$arr_data['data']['fileUrl'] = $a_input['fileUrl'];
				$arr_data['data']['proc'] = 'editPdf';
				$arr_data['data']['mode'] = 'default';
				$arr_data['data']['thumbnailPngBase64'] = $a_input['thumbnailPngBase64'];
				$arr_data['data']['maxOcrChar'] = $a_input['maxOcrChar'];
				$arr_data['data']['uploadMethod'] = 'browser';/*'webapi';*/
			}else{
				$arr_data = array();
				$arr_data['data'] = array();
				$arr_data['data']['procUrl'] = $a_input['procUrl'];
				$arr_data['data']['cookieHeader'] = $a_input['cookieHeader'];
				$arr_data['data']['id'] = null;
				$arr_data['data']['fileUrl'] = null;
				$arr_data['data']['proc'] = 'scanPdf';
				$arr_data['data']['mode'] = null;
				$arr_data['data']['thumbnailPngBase64'] = $a_input['thumbnailPngBase64'];
				$arr_data['data']['maxOcrChar'] = $a_input['maxOcrChar'];
				$arr_data['data']['uploadMethod'] = 'browser';
			}
			return $arr_data;
		}
		
		public function formInjection(){
			return '<script src="../bizsmartdoc/js/bizsmartdoc.js.php"></script>';

		}
		
		public function saveAllFile($WF_MAIN_ID,$WFR_ID){
			/*$WF_MAIN_ID = $W; /*"999";* /
			$WFR_ID = $WFR; /*"3";*/

			foreach($_POST['pe_wfs_field_name'] as $key=>$WFS_FIELD_NAME){

				if($_POST['pe_file_base64'][$key]==''){ continue; }
				
				$file_name = $_POST['pe_filename'][$key];
				$file_bin = base64_decode($_POST['pe_file_base64'][$key]);
				
				///$ocrtext_base64 = base64_decode($_POST['pe_ocrtext_base64'][$key]);
				
				
				$attach_folder = '../attach/w'.$WF_MAIN_ID;
				$file_save_name = 's'.date('YmdHis').'_'.bsf_random(10).'.pdf';
				file_put_contents ($attach_folder.'/'.$file_save_name,$file_bin);
				$file_size = filesize ($attach_folder.'/'.$file_save_name);
				
				$insert_opt = array();
				$insert_opt['WFS_FIELD_NAME'] = $WFS_FIELD_NAME;
				$insert_opt['WFR_ID'] = $WFR_ID;
				$insert_opt['WF_MAIN_ID'] = $WF_MAIN_ID;
				
				$insert_opt['FILE_NAME'] = $file_name;
				$insert_opt['FILE_SAVE_NAME'] = $file_save_name;
				$insert_opt['FILE_EXT'] = 'pdf';
				$insert_opt['FILE_SIZE'] = $file_size;
				$insert_opt['FILE_TYPE'] = 'application/pdf';
				$insert_opt['FILE_DATE'] = date2db(date('d/m/').(date('Y')+543));
				$insert_opt['FILE_TIME'] = date('H:i:s');
				$insert_opt['FILE_STATUS'] = 'Y';
	
				$insert_opt['USR_ID'] = $_SESSION['WF_USER_ID'];
				
				db::db_update("WF_FILE", array('FILE_STATUS'=>'R'), array('WF_MAIN_ID'=>$WF_MAIN_ID,'WFR_ID'=>$WFR_ID,'WFS_FIELD_NAME'=>$WFS_FIELD_NAME));
								
				db::db_insert("WF_FILE", $insert_opt, "FILE_ID");
				

				
				unset($insert_opt);
			
			}
		}

		public function storeFile($data){

			$query = db::query("SELECT FILE_SAVE_NAME,WFS_FIELD_NAME FROM WF_FILE WHERE FILE_ID='".($data['pe_file_id']*1)."'");
			$rec = db::fetch_array($query);
			if($data['pe_file_base64'] && is_array($rec)){ 
			
				$file_name = $data['pe_filename'];
				$file_bin = base64_decode($data['pe_file_base64']);
				///$ocrtext_base64 = base64_decode($data['pe_ocrtext_base64']);
				
				
				$attach_folder = '../attach/w'.$data['pe_wf_main_id'];
				$file_save_name = 's'.date('YmdHis').'_'.bsf_random(10).'.pdf';
				
				file_put_contents ($attach_folder.'/'.$file_save_name,$file_bin);
				$file_size = filesize ($attach_folder.'/'.$file_save_name);
				
				$insert_opt = array();
				$insert_opt['WF_MAIN_ID'] = $data['pe_wf_main_id'];
				$insert_opt['USR_ID'] = $_SESSION['WF_USER_ID'];
				$insert_opt['WFS_FIELD_NAME'] = $rec['WFS_FIELD_NAME'];
				
				$insert_opt['WFR_ID'] = $data['pe_wfr_id'];
				$insert_opt['FILE_NAME'] = $file_name;
				$insert_opt['FILE_SAVE_NAME'] = $file_save_name;
				$insert_opt['FILE_EXT'] = 'pdf';
				$insert_opt['FILE_SIZE'] = $file_size;
				$insert_opt['FILE_TYPE'] = 'application/pdf';
				$insert_opt['FILE_DATE'] = date2db(date('d/m/').(date('Y')+543));
				$insert_opt['FILE_TIME'] = date('H:i:s');
				$insert_opt['FILE_STATUS'] = 'Y';
				
				$pe_file_id = db::db_insert("WF_FILE", $insert_opt, "FILE_ID");
				
				db::db_update("WF_FILE", array('FILE_STATUS'=>'R'), array('FILE_ID'=>$data['pe_file_id']));
				
				unset($insert_opt);
				
				return array('pe_file_id'=>$pe_file_id,
					'pe_filename'=>$file_name,
					'pe_file_url'=>$attach_folder.'/'.$file_save_name,
					'pe_wf_main_id'=>$data['pe_wf_main_id'],
					'pe_wfr_id'=>$data['pe_wfr_id']);
			
			}
			
		}
		
		public function updateFile($data){

			$query = db::query("SELECT FILE_SAVE_NAME,WFS_FIELD_NAME,FILE_NAME FROM WF_FILE WHERE FILE_ID='".($data['pe_file_id']*1)."'");
			$rec = db::fetch_array($query);
			if($data['pe_file_base64'] && is_array($rec)){ 
			

				$file_bin = base64_decode($data['pe_file_base64']);
				///$ocrtext_base64 = base64_decode($data['pe_ocrtext_base64']);
				
				$attach_folder = '../attach/w'.$data['pe_wf_main_id'];
				
				
				file_put_contents ($attach_folder.'/'.$rec['FILE_SAVE_NAME'],$file_bin);
				$file_size = filesize($attach_folder.'/'.$file_save_name);
				
				$insert_opt = array();
				$insert_opt['WF_MAIN_ID'] = $data['pe_wf_main_id'];
				$insert_opt['WFR_ID'] = $data['pe_wfr_id'];
				$insert_opt['WFS_FIELD_NAME'] = $rec['WFS_FIELD_NAME'];
				
				//$insert_opt['FILE_NAME'] = $file_name;
				//$insert_opt['FILE_SAVE_NAME'] = $rec['FILE_SAVE_NAME'];
				//$insert_opt['FILE_EXT'] = 'pdf';
				$insert_opt['FILE_SIZE'] = $file_size;
				$insert_opt['FILE_TYPE'] = 'application/pdf';
				$insert_opt['FILE_DATE'] = date2db(date('d/m/').(date('Y')+543));
				$insert_opt['FILE_TIME'] = date('H:i:s');
				$insert_opt['FILE_STATUS'] = 'Y';
	
				

				$insert_opt['USR_ID'] = $_SESSION['WF_USER_ID'];
				db::db_update("WF_FILE", $insert_opt, array('FILE_ID'=>$data['pe_file_id']));
				unset($insert_opt);
				
				return array('pe_file_id'=>$data['pe_file_id'],
					'pe_filename'=>$rec['FILE_NAME'],
					'pe_file_url'=>$attach_folder.'/'.$file_save_name,
					'pe_wf_main_id'=>$data['pe_wf_main_id'],
					'pe_wfr_id'=>$data['pe_wfr_id']);
			}
			
			
		}	
		/*
		public function mime_content_type2($filename) {

			$mime_types = array(

				'txt' => 'text/plain',
				'htm' => 'text/html',
				'html' => 'text/html',
				'php' => 'text/html',
				'css' => 'text/css',
				'js' => 'application/javascript',
				'json' => 'application/json',
				'xml' => 'application/xml',
				'swf' => 'application/x-shockwave-flash',
				'flv' => 'video/x-flv',

				// images
				'png' => 'image/png',
				'jpe' => 'image/jpeg',
				'jpeg' => 'image/jpeg',
				'jpg' => 'image/jpeg',
				'gif' => 'image/gif',
				'bmp' => 'image/bmp',
				'ico' => 'image/vnd.microsoft.icon',
				'tiff' => 'image/tiff',
				'tif' => 'image/tiff',
				'svg' => 'image/svg+xml',
				'svgz' => 'image/svg+xml',

				// archives
				'zip' => 'application/zip',
				'rar' => 'application/x-rar-compressed',
				'exe' => 'application/x-msdownload',
				'msi' => 'application/x-msdownload',
				'cab' => 'application/vnd.ms-cab-compressed',

				// audio/video
				'mp3' => 'audio/mpeg',
				'qt' => 'video/quicktime',
				'mov' => 'video/quicktime',

				// adobe
				'pdf' => 'application/pdf',
				'psd' => 'image/vnd.adobe.photoshop',
				'ai' => 'application/postscript',
				'eps' => 'application/postscript',
				'ps' => 'application/postscript',

				// ms office
				'doc' => 'application/msword',
				'rtf' => 'application/rtf',
				'xls' => 'application/vnd.ms-excel',
				'ppt' => 'application/vnd.ms-powerpoint',

				// open office
				'odt' => 'application/vnd.oasis.opendocument.text',
				'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
			);

			$ext = strtolower(array_pop(explode('.',$filename)));
			if (array_key_exists($ext, $mime_types)) {
				return $mime_types[$ext];
			}
			elseif (function_exists('finfo_open')) {
				$finfo = finfo_open(FILEINFO_MIME);
				$mimetype = finfo_file($finfo, $filename);
				finfo_close($finfo);
				return $mimetype;
			}
			else {
				return 'application/octet-stream';
			}
		}*/
		
		public function encrypt($text)
		{ 
			$key = $this->encrypt_key;  
			$IV = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_RAND); 

			return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_CBC, $IV)."-[--IV-[-".$IV);
		}

		public function decrypt($text)
		{
			$key = $this->encrypt_key;   
			$text = base64_decode($text); 
			$IV = substr($text, strrpos($text, "-[--IV-[-") + 9);
			$text = str_replace("-[--IV-[-".$IV, "", $text);

			return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_CBC, $IV), "\0");
		}
	}
?>