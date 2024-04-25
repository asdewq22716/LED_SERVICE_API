<?php
	echo 'session.gc_maxlifetime:'.ini_get('session.gc_maxlifetime').'<br>'.PHP_EOL;
	
	$fname=  session_save_path().'/sess_'.'p2v63feqrum6suvq0s77fn31u4';
	
	echo 'file_exists:'.file_exists($fname).'<br>'.PHP_EOL;
	$contents = file_get_contents($fname);
	session_start();
	echo 'WF_USER_NAME:'.$_SESSION['WF_USER_NAME'].'<br>'.PHP_EOL;
	session_decode($contents);
	echo 'WF_USER_NAME:'.$_SESSION['WF_USER_NAME'].'<br>'.PHP_EOL;
?>