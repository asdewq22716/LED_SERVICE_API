<?php
class mediateCmdOfficeAction {
	
	protected static $_response;
		
	public static function dataResPonse($request){
		 
		 $objResPonse = new mediateCmdOfficeResponse($request);
		 self::$_response = $objResPonse->getResponse();
		
		return self::$_response;
	}
	
}
?>