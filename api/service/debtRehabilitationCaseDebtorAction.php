<?php
class debtRehabilitationCaseDebtorAction {
	
	protected static $_response;
		
	public static function dataResPonse($request){
		 
		 $objResPonse = new debtRehabilitationCaseDebtorResponse($request);
		 self::$_response = $objResPonse->getResponse();
		
		return self::$_response;
	}
	
}
?>