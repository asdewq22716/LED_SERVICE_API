<?php
    function call_sub_api($API_SERVICE_ID,$obj=array(),$obj_key,$req=array(),$ii){
        $sql_api = \db::query("SELECT * FROM M_API_SETTING WHERE API_SETTING_ID = '".$API_SERVICE_ID."'");
        $API = \db::fetch_array($sql_api);
        
        $filter = "";
        
        $sql_request = \db::query("SELECT * FROM M_API_LIST WHERE API_SETTING_ID = '".$API_SERVICE_ID."' AND API_STATUS = '0' ORDER BY ORDER_NO,API_LIST_ID ASC");
        while($K = \db::fetch_array($sql_request)){
            if (!empty($req[$K['KEY']])) {
                if($K['SEARCH_CUSTOM'] != ""){
                    $txt = " AND ".str_replace("#SEARCH#",$req[$K['KEY']],$K['SEARCH_CUSTOM']);
                    $filter .= $txt;
                }else{
                    $alias = "";
                    if($K['API_TABLE_ALIAS'] != ""){
                        $alias = $K['API_TABLE_ALIAS'].".";
                    }

                    if($K['API_OPERATOR'] == 'LIKE'){
                        $txt = " AND ".$alias.$K['API_FIELD']." LIKE '%" . $req[$K['KEY']] . "%'";
                    }else{
                        $txt = " AND ".$alias.$K['API_FIELD']." ".$K['API_OPERATOR']." '" . $req[$K['KEY']] . "'";
                    }

                    $filter .= $txt;
                }
            }
            
        }

        $sql = $API['API_SQL']." ".$filter;
        
        $exc = \db::query($sql);
        $i = 0;
        $obj_sub = array();
        while ($rec = \db::fetch_array($exc)) {
            $sql_response = \db::query("SELECT * FROM M_API_LIST WHERE API_SETTING_ID = '".$API_SERVICE_ID."' AND API_STATUS = '1' AND STATUS = 'S' ORDER BY ORDER_NO,API_LIST_ID ASC");
            while($RES = \db::fetch_array($sql_response)){
                if($RES['API_REF'] == ""){
                    $obj_sub[$i][$RES['KEY']] = $rec[$RES['API_FIELD']];
                }else{
                    $obj_sub = call_sub_api($RES['API_REF'],$obj_sub,$RES['KEY'],$rec,$i);
                }
            }
            $i++;
        }
        $obj[$ii][$obj_key] = $obj_sub;
        return $obj;
    }
    
    $obj = array();
    $row = array();
    
    $sql_api = \db::query("SELECT * FROM M_API_SETTING WHERE API_SETTING_ID = '".$_SERVER['HTTP_SETOPTION']."'");
    $API = \db::fetch_array($sql_api);
    
    $filter = "";
    $array_search_sub = array();
    $sql_request = \db::query("SELECT * FROM M_API_LIST WHERE API_SETTING_ID = '".$_SERVER['HTTP_SETOPTION']."' AND API_STATUS = '0' ORDER BY ORDER_NO,API_LIST_ID ASC");
    while($K = \db::fetch_array($sql_request)){
        $request = (array) $request;
        if (!empty($request[$K['KEY']])) {
            if($K['SEARCH_CUSTOM'] != ""){
				$txt = " AND ".str_replace("#SEARCH#",$request[$K['KEY']],$K['SEARCH_CUSTOM']);
				$filter .= $txt;
                if($K['API_FIELD'] != ""){
                    $array_search_sub[$K['API_FIELD']] = $request[$K['KEY']];
                }
			}else{
                $alias = "";
                if($K['API_TABLE_ALIAS'] != ""){
                    $alias = $K['API_TABLE_ALIAS'].".";
                }

                if($K['API_OPERATOR'] == 'LIKE'){
                    $txt = " AND ".$alias.$K['API_FIELD']." LIKE '%" . $request[$K['KEY']] . "%'";
                }else{
                    $txt = " AND ".$alias.$K['API_FIELD']." ".$K['API_OPERATOR']." '" . $request[$K['KEY']] . "'";
                }
                
                $filter .= $txt;
            }
        } 
    }

    $sql = $API['API_SQL']." ".$filter;
    $exc = \db::query($sql);
    $i = 0;
    while ($rec = \db::fetch_array($exc)){
        $sql_response = \db::query("SELECT * FROM M_API_LIST WHERE API_SETTING_ID = '".$_SERVER['HTTP_SETOPTION']."' AND API_STATUS = '1' AND STATUS = 'S' ORDER BY ORDER_NO,API_LIST_ID ASC");
        while($RES = \db::fetch_array($sql_response)){
            if($RES['API_REF'] == ""){
                $obj[$i][$RES['KEY']] = $rec[$RES['API_FIELD']];
            }else{
                $rec_all = array_merge($rec, $array_search_sub);
                $obj = call_sub_api($RES['API_REF'],$obj,$RES['KEY'],$rec_all,$i);
            }
        }

        $i++;
    }
?> 