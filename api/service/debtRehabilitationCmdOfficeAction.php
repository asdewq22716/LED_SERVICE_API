<?php
class debtRehabilitationCmdOfficeAction {
	
	protected static $_response;
		
	public static function dataResPonse($request){
		 
		 $objResPonse = new debtRehabilitationCmdOfficeResponse($request);
		 self::$_response = $objResPonse->getResponse();
		
		return self::$_response;
	}
	
}
?>