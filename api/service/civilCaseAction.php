<?php
class civilCaseAssetsLandAction {
	
	protected static $_response;
		
	public static function dataResPonse($request){
		 
		 $objResPonse = new civilCaseAssetsLandResponse($request);
		 self::$_response = $objResPonse->getResponse();
		
		return self::$_response;
	}
	
}
?>