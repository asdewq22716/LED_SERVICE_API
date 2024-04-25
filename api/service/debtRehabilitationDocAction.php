<?php
class debtRehabilitationDocAction {
	
	protected static $_response;
		
	public static function dataResPonse($request){
		 
		 $objResPonse = new debtRehabilitationDocResponse($request);
		 self::$_response = $objResPonse->getResponse();
		
		return self::$_response;
	}
	
}
?>