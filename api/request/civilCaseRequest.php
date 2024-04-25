<?php
class civilCaseRequest {
	
	private static $_obj;
	
	public static function GenRequest(){
		
		self::$_obj = array(
		  "apiCode" => "WS-01-002",
		  "serviceName" => "civilCase",
		  "serviceInfo" => "ข้อมูลหมายบังคับคดี",		
		  "request" => array(
			"prefixBlackCase" => array(
			  "TYPE" => "string",
			  "FIELD_TYPE" => "O", // M/O
			  "DESC" => "คํานําหน้าหมายเลข คดีดํา",
			  "EX" => "ผบ."
			),
			"blackCase" => array(
			  "TYPE" => "number",
			  "FIELD_TYPE" => "M", // M/O
			  "DESC" => "คดีหมายเลขดําที่",
			  "EX" => "1111"
			),
			"blackYY" => array(
			  "TYPE" => "number",
			  "FIELD_TYPE" => "M", // M/O
			  "DESC" => "คดีหมายเลขดําปีที่",
			  "EX" => "2563"
			),
			"brefixRedCase" => array(
			  "TYPE" => "string",
			  "FIELD_TYPE" => "O", // M/O
			  "DESC" => "คํานําหน้าหมายเลข คดีแดง",
			  "EX" => "ผบ."
			),
			"redCase" => array(
			  "TYPE" => "number",
			  "FIELD_TYPE" => "M", // M/O
			  "DESC" => "คดีหมายเลขแดงที่",
			  "EX" => "111"
			),
			"redYY" => array(
			  "TYPE" => "number",
			  "FIELD_TYPE" => "M", // M/O
			  "DESC" => "คดีหมายเลขแดงปีที่",
			  "EX" => "2563"
			)
		  )
		);

		return  json_encode(self::obj, JSON_UNESCAPED_UNICODE);
	}
		
		
		
}


?>