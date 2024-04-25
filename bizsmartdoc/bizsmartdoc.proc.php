<?php

	require('../include/config.php '); 
	require('./bizsmartdoc.config.php');
	require('./bizsmartdoc.class.php');
	
	if(!isset($_SESSION)){ session_start(); }


	$bizSmartDoc = new BizSmartDoc();


	function getFileUrl($id){
		global $config;
		$arr_id = explode('-',$id);
		if(count($arr_id)>3){}
		list($WF_MAIN_ID,$FILE_ID,$WFR_ID) = explode('-',$id); /*$FILE_ID is pk*/
		$fileUrl =$config['base_url'].'attach/w'.$WF_MAIN_ID.'/';
		try{
			$query = db::query("SELECT FILE_SAVE_NAME FROM WF_FILE WHERE FILE_ID='".($FILE_ID*1)."'");
			$rec = db::fetch_array($query);
			$fileUrl .= $rec['FILE_SAVE_NAME'];
		}catch(Exception $ex){
			exit;
		}
		return $fileUrl;
	}

	switch($_GET['proc']){
		case 'getMetaInfo':
			$id=isset($_GET['id'])?$_GET['id']:null;
			$cookieHeader = isset($_GET['cookieHeader'])?$_GET['cookieHeader']:null;
			$data['fileUrl']= getFileUrl($id);
			$data['procUrl']= $config['base_url'].'bizsmartdoc/'.'bizsmartdoc.proc.php';
			$data['id']= $id;
			$data['cookieHeader']= $cookieHeader;
			$data['maxOcrChar']= $config['max_ocr_length'];

			echo json_encode($bizSmartDoc->genMetaInfo($data));
			break;

		case "storePdf":
			$id = $_GET['id'];		
			$return = array();
			try{

				$return['data'] = $bizSmartDoc->storeFile($_POST);

				
				$return['result'] = 'OK';
				$return['message'] = '';
			
				
			}catch(Exception $ex){
				$return['data'] = null;
				$return['result'] = 'ERROR';
				$return['message'] = $ex->getMessage();
			}
			echo json_encode($return);
			break;
			
		case "updatePdf":
			$id = $_GET['id'];		
			$return = array();
			try{

				$return['data'] = $bizSmartDoc->updateFile($_POST);
				
				$return['result'] = 'OK';
				$return['message'] = '';
			
				
			}catch(Exception $ex){
				$return['data'] = null;
				$return['result'] = 'ERROR';
				$return['message'] = $ex->getMessage();
			}
			echo json_encode($return);
			break;
		/*
		case "uploadAllPdf":
			$id = $_GET['id'];		
			$return = array();
			try{

				/////////////////////////
				
				$return['result'] = 'OK';
				$return['message'] = '';
				
			}catch(Exception $ex){
				$return['result'] = 'ERROR';
				$return['message'] = $ex->getMessage();
			}
			echo json_encode($return);
			break;
			
		case "downloadPdf":
			$id = $_GET['id'];	
			
			
			$sql = "SELECT * FROM {$table} WHERE {$tableInfo[$table]['pk_field']}='".($id*1)."'";
			$result = $db->query($sql);
			$rec = $db->db_fetch_array($result);
			$fileDownloadPath = $config['temp_path'].$uploadPath[$mode].$rec[$tableInfo[$table][$fieldConfig[$mode]]];
			
			
			$filename = pathinfo($rec[$tableInfo[$table]['display_filename']], PATHINFO_FILENAME );
			$ext = pathinfo($rec[$tableInfo[$table]['display_filename']], PATHINFO_EXTENSION);
			$ext = $ext?$ext:pathinfo($rec[$tableInfo[$table]['master_field']], PATHINFO_EXTENSION);
			$mine=  $bizSmartDoc->mime_content_type2($filename .'.'.$ext);

			//header('Content-Disposition: attachment; filename="'.$filename .'.'.$ext.'"');
			header('Content-Disposition: filename="'.$filename .'.'.$ext.'"');
			header('Content-Type: '.$mine);
			echo file_get_contents($fileDownloadPath);

			
		break;
		*/
		/*
		case 'uploadGoogleApiKey':
			$return = array();
			try{
				$json_key = file_get_contents($_FILES['googlevision_key']['tmp_name']);
				if (!$json_key) {
					throw new Exception("upload error");
				} 

				file_put_contents('./application_data/google-api-key.json.encrypted',$bizSmartDoc->encrypt($json_key));
				
				$return['result'] = 'OK';
				$return['message'] = '';
				
			}catch(Exception $ex){
				$return['result'] = 'ERROR';
				$return['message'] = $ex->getMessage();
			}
			echo json_encode($return);
		break;
		case 'downloadGoogleApiKeyToClient':
			$return = array();
			try{
				$return['data'] = array();
				$return['data']['proc'] = 'downloadGoogleApiKeyToClient';
				$return['data']['google_api_key'] = file_get_contents('./application_data/google-api-key.json.encrypted');
				$return['result'] = 'OK';
				$return['message'] = '';
				
			}catch(Exception $ex){
				$return['result'] = 'ERROR';
				$return['message'] = $ex->getMessage();
			}
			echo json_encode($return);
		break;*/
	}
?>