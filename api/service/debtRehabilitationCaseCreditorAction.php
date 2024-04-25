<?php
class debtRehabilitationCaseCreditorAction {
	
	protected static $_response;
		
	public static function dataResPonse($request){
		 
		 $objResPonse = new debtRehabilitationCaseCreditorResponse($request);
		 self::$_response = $objResPonse->getResponse();
		
		return self::$_response;
	}
	
}
?>