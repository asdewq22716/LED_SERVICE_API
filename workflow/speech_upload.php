<?php
$default_path_cmd = "D:\\www_php56\\workflow_master4\\attach\\voice_upload\\";
ini_set('max_execution_time', 0);
if($_FILES['data']['error'] == 0)
{
	#### Upload ####
	$path = "../attach/voice_upload/";
	$file_name = 'ori_'.date('YmdHis').".wav";
	$file_name_cont = 'con_'.date('YmdHis').".wav";

	copy($_FILES['data']['tmp_name'], $path.$file_name);

	#### Convert rate sample and Stereo to mono chanel ####
	$command = $default_path_cmd."ffmpeg -i ".$default_path_cmd.$file_name." -ac 1 -ar 48000 ".$default_path_cmd.$file_name_cont;
	exec($command);

	unlink($path.$file_name);

	#### GCP Speech ####

	/* เขียนแบบใช้ SDK (ต้องใช้ Composer โหลดไฟล์เข้ามา) */

	# Instantiates a client
	/*$speech = new SpeechClient([
		'languageCode' => 'th-TH',
		'keyFile' => json_decode(file_get_contents('cloud_speech.json'), true)
	]);

	# The audio file's encoding and sample rate
	$options = [
		'encoding' => 'LINEAR16',
		'sampleRateHertz' => 48000,
	];

	# Detects speech in the audio file
	$results = $speech->recognize(fopen($path.$file_name_cont, 'r'), $options);

	$transcription = "";
	foreach ($results as $result) {
		$transcription .= $result->alternatives()[0]['transcript'] . PHP_EOL;
	}*/


	/* เขียนแบบใช้ API */

	$file_encode = file_get_contents($path.$file_name_cont);

	$data = array(
		"config" => array(
			"encoding" => "LINEAR16",
			"sampleRateHertz" => '48000',
			"language_code" => "th-TH"
		),
		"audio" => array(
			"content" => base64_encode($file_encode)
		)
	);

	$data_string = json_encode($data);

	$ch = curl_init("https://speech.googleapis.com/v1/speech:recognize?key=AIzaSyD5k_SfC_Hl-21YM3IyQs--f67wGcxaDXc");
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($data_string))
	);

	$result = curl_exec($ch);
	$result_array = json_decode($result, true);

	$transcription = $result_array['results'][0]['alternatives'][0]['transcript'];

	echo $transcription;
}
?>