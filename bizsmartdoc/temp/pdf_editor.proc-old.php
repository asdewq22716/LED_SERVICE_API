<?php

	require('../include/config.php '); 
	require('./pdf_editor.config.php');
	require('./pdf_editor.class.php');
	
	$tableInfo = array(
		'DOCUMENT_TEMP_FILE'=>
			array('master_field'=>'TEMP_FILE','annotate_field'=>'TEMP_FILE_ANOTATE','black_marker_field'=>'TEMP_FILE_BLACK_MARKER','pk_field'=>'TEMP_DOC_ID','display_filename'=>'TEMP_FILE_NAME','thumbnail_field'=>'TEMP_THUMBNAIL_FILE'),
		'DOCUMENT_DETAIL_TXN'=>
			array('master_field'=>'MAS_FILE','annotate_field'=>'MAS_FILE_ANOTATE','black_marker_field'=>'MAS_FILE_BLACK_MARKER','pk_field'=>'DOC_DETAIL_ID','display_filename'=>'REFER_NAME','thumbnail_field'=>'THUMBNAIL_FILE')
	);

	$fieldConfig = array('scanPdf'=>'master_field','annotatePdf'=>'annotate_field','blackMarkerPdf'=>'black_marker_field');
			
	$uploadPath = array('scanPdf'=>'doc_master/','annotatePdf'=>'doc_annotation/','blackMarkerPdf'=>'doc_black_marker/','thumbnail'=>'thumbnail/');
	
	
	$pdfEditor = new PdfEditor($config['temp_path']);
	$tableDefault='DOCUMENT_TEMP_FILE';
	$mode=isset($_GET['mode'])?$_GET['mode']:'scanPdf';
			

	$table = $_GET['moduleCode'];
	if(!array_key_exists($table,$tableInfo)) { $table=$tableDefault; }
	

	function getFileUrl($table,$id,$mode,$isBaseFile){
		global $tableInfo,$db,$config,$uploadPath;
		if($isBaseFile){
			$mode=($mode=='scanPdf'?$mode:($mode=='annotatePdf'?'scanPdf':'annotatePdf'));
		}
		$fileUrl =$config['base_url'].'fileupload/document_file/';
		try{
			if(!array_key_exists($table,$tableInfo)) { $table=$tableDefault; }
			
			$sql = "SELECT * FROM {$table} WHERE {$tableInfo[$table]['pk_field']}='".($id*1)."'";
			$result = $db->query($sql);
			$rec = $db->db_fetch_array($result);

			switch($mode){
				case 'annotatePdf' :
					if($rec[$tableInfo[$table]['annotate_field']]!=''){
						$fileUrl.=$uploadPath['annotatePdf'].$rec[$tableInfo[$table]['annotate_field']];
					}else{
						$fileUrl.=$uploadPath['scanPdf'].$rec[$tableInfo[$table]['master_field']];
					}
					
				break;
				case 'blackMarkerPdf' :
					if($rec[$tableInfo[$table]['black_marker_field']]!=''){
						$fileUrl.=$uploadPath['blackMarkerPdf'].$rec[$tableInfo[$table]['black_marker_field']];
					}else if($rec[$tableInfo[$table]['annotate_field']]!=''){
						$fileUrl.=$uploadPath['annotatePdf'].$rec[$tableInfo[$table]['annotate_field']];
					}else{
						$fileUrl.=$uploadPath['scanPdf'].$rec[$tableInfo[$table]['master_field']];
					}
				break;
				case 'thumbnail' :
					$fileUrl.= $uploadPath['thumbnail'].$rec[$tableInfo[$table]['thumbnail_field']];
				break;
				case 'scanPdf' :
				default :
					
					if($isBaseFile){
						$fileUrl.=$uploadPath['scanPdf'].$rec[$tableInfo[$table]['master_field']];
					}else{
						$fileUrl=null;
					}
				break;
				
			}
			
		}catch(Exception $ex){
			exit;
		}
		return $fileUrl;
	}

	switch($_GET['proc']){
		case 'getMetaInfo':
			$id=isset($_GET['id'])?$_GET['id']:null;
			$uploadToken = isset($_GET['uploadToken'])?$_GET['uploadToken']:null;
			///$data['fileBaseUrl']= getFileUrl($table,$id,$mode,true);
			///$data['fileUrl']= getFileUrl($table,$id,$mode,false);
			$data['procUrl']= $config['base_url'].'pdf_editor/'.'pdf_editor.proc.php';
			$data['id']= $id;
			$data['moduleCode']= $table;
			$data['mode'] = $mode;
			$data['uploadToken']= $uploadToken;
			$data['maxOcrChar']= $config['maxOcrChar'];
			$data['uploadMethod']='browser';
			/*base64_encode(file_get_contents("xxx.png")); //only support png*/
			///$data['thumbnailPngBase64']= base64_encode(file_get_contents(getFileUrl($table,$id,'thumbnail',false)));

			echo json_encode($pdfEditor->genMetaInfo($data));
			break;
		case "storePdfTest":

			$WF_MAIN_ID = "999";
			$WFR_ID = "3";
			$WFS_FIELD_NAME = "SCAN_FILE";
			$scan_name = "scan.pdf";

			$attach_folder = '../attach/w'.$WF_MAIN_ID;
			$file_name = 's'.date('YmdHis').'_'.bsf_random(10).'.pdf';
     
			// copy($_FILES[$BSF_DET["WFS_FIELD_NAME"]]["tmp_name"][$a], $attach_folder.'/'.$file_name);
			// @chmod($attach_folder.'/'.$file_name,0777);
			
			$insert_opt = array();
			$insert_opt['WFS_FIELD_NAME'] = $WFS_FIELD_NAME;
			$insert_opt['WFR_ID'] = $WFR_ID;
			$insert_opt['FILE_NAME'] = $scan_name;
			$insert_opt['FILE_SAVE_NAME'] = $file_name;
			$insert_opt['FILE_EXT'] = "pdf";
			$insert_opt['FILE_SIZE'] = "";
			$insert_opt['FILE_TYPE'] = "";
			$insert_opt['FILE_DATE'] = date2db(date("d/m/").(date("Y")+543));
			$insert_opt['FILE_TIME'] = date("H:i:s");
			$insert_opt['FILE_STATUS'] = 'Y';
			$insert_opt['WF_MAIN_ID'] = $WF_MAIN_ID;
			//  $insert_opt['USR_ID'] = $_SESSION['WF_USER_ID'];
			db::db_insert("WF_FILE", $insert_opt, "FILE_ID");
			unset($insert_opt);
			db::db_close();
		case "storePdf":
			$return = array();
			try{

				$uploadToken = isset($_GET['uploadToken'])?$_GET['uploadToken']:'';
				$insert_data = array();
				$insert_data['TEMP_CODE'] = $uploadToken;
				$temp_name = rand(10,99).date('Ymdhis');
				$insert_data['TEMP_FILE_NAME'] = $temp_name.".pdf";
				$insert_data['TEMP_FILE'] = $insert_data['TEMP_FILE_NAME'];
				$insert_data['TEMP_THUMBNAIL_FILE'] = $temp_name.'.png';
				
				$path_parts = 'D:\\www\\THAIPOST_DOC\\THAIPOST_EDOC\\pdf_editor\\/';
				$path_parts2 = 'D:\\www\\THAIPOST_DOC\\THAIPOST_EDOC\\fileupload\\document_file\\doc_master\\/';
				
				$currentDir = $path_parts;
				
				$command = $currentDir.'pdftoimage -i "'.$path_parts2.'2620171003074013.pdf" -o "'.$currentDir.'output_pdf_'.$_GET['uploadToken'].'" -q 60 -z 60';
				exec ($command);				
				
				$objScan = scandir('output_pdf_'.$_GET['uploadToken']);
				foreach ($objScan as $value) {
					if ($value == '.' || $value == '..') { 
						continue; 
					}else{
						
					}
				}
				
				if($DOC_DETIAL_DESC=$pdfEditor->getOcrText($config['maxOcrChar'])){
					$insert_data['DOC_DETIAL_DESC'] = iconv("utf-8","tis-620",$DOC_DETIAL_DESC);;
				}
				
				$pdfEditor->savePDF($uploadPath[$mode].$insert_data['TEMP_FILE'],$uploadToken,array('saveThumbnail'=>true));
				
				$insert_data['USED_SPACE'] = filesize($config['temp_path'].$uploadPath[$mode].$insert_data['TEMP_FILE']);

				$db->db_insert('DOCUMENT_TEMP_FILE',$insert_data);

				$return['result'] = 'OK';
				$return['message'] = '';
				
			}catch(Exception $ex){
				$return['result'] = 'ERROR';
				$return['message'] = $ex->getMessage();
			}
			echo json_encode($return);
			break;
		case "updatePdf":
			$id = $_GET['id'];		
			$return = array();
			try{

				$uploadToken = isset($_GET['uploadToken'])?$_GET['uploadToken']:'';
				$update_data = array();
				
				$sql = "SELECT * FROM {$table} WHERE {$tableInfo[$table]['pk_field']}='".($id*1)."'";
				$result = $db->query($sql);
				$rec = $db->db_fetch_array($result);

				$temp_name = $rec[$tableInfo[$table][$fieldConfig[$mode]]];
				if(!$temp_name){
					$temp_name = rand(10,99).date('Ymdhis').".pdf";
				}
				$update_data[$tableInfo[$table][$fieldConfig[$mode]]] = $temp_name;

				
				$pdfEditor->savePDF($uploadPath[$mode].$update_data[$tableInfo[$table][$fieldConfig[$mode]]],$uploadToken,array('saveThumbnail'=>true));
				//$update_data['USED_SPACE'] = filesize($config['temp_path'].$update_data[$tableInfo[$table]['master_field']]);

				$update_data[$tableInfo[$table]['thumbnail_field']] = substr($temp_name,0,strlen($temp_name)-4).'.png';
				
				$db->db_update($table,$update_data,"{$tableInfo[$table]['pk_field']}='{$id}'");
				
				
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
			$mine=  $pdfEditor->mime_content_type2($filename .'.'.$ext);

			//header('Content-Disposition: attachment; filename="'.$filename .'.'.$ext.'"');
			header('Content-Disposition: filename="'.$filename .'.'.$ext.'"');
			header('Content-Type: '.$mine);
			echo file_get_contents($fileDownloadPath);
			
			/*
			require_once('vendor/TCPDF/WaterMarkPDF.php');
			$pdf = new WaterMarkPDF();

			if (file_exists($fileDownloadPath)){
				$pagecount = $pdf->setSourceFile($fileDownloadPath);
			} else {
				return FALSE;
			}

			$pdf->setWaterText("T h a i Post ", "B y B i z");

		
			for($i=1; $i <= $pagecount; $i++) { 
			 $tpl = $pdf->importPage($i);               
			 $pdf->addPage(); 
			 $pdf->useTemplate($tpl, 1, 1, 0, 0, TRUE);  
			}
			$pdf->Output(); */

			
		break;
		
		case 'uploadGoogleApiKey':
			$return = array();
			try{
				$json_key = file_get_contents($_FILES['googlevision_key']['tmp_name']);
				if (!$json_key) {
					throw new Exception("upload error");
				} 

				file_put_contents('./application_data/google-api-key.json.encrypted',$pdfEditor->encrypt($json_key));
				
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
		break;
	}
?>