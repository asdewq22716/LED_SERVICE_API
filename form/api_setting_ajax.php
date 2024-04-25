<?php
    include '../include/include.php';
    header('Content-Type: application/json');

    $setid = conText($_GET['setid']);
    $field = conText($_GET['field']);
    $table = conText($_GET['table']);

    $sql_api = \db::query("SELECT * FROM M_API_SETTING WHERE API_SETTING_ID = '".$setid."' AND API_STATUS = '1' ");
    $API = \db::fetch_array($sql_api);

    if($_GET['proc'] == 'api_table'){
        $pattern = "/(from|join) [\\'\\´]?([a-zA-Z0-9_-]+)[\\'\\´]?/i";
        if (preg_match_all($pattern, $API['API_SQL'], $matches)) {
            $tables = array_unique($matches[2]);

            foreach($tables as $key => $val){
                $array_a[$key]["id"] = $val;
                $array_a[$key]["text"] = $val;
                $array_a[$key]["selected"] = $val == $table ? 'selected' : '';
            }

            echo json_encode($array_a);
        }
    }

    if($_GET['proc'] == 'api_field'){
        if($table == 'null'){
            $sqlnew_doc = $API['API_SQL'];
            $WF_ARR_FIELD = db::query_field($sqlnew_doc);

            foreach($WF_ARR_FIELD as $key1 => $val1){
                $array_b[$key1]["id"] = $val1;
                $array_b[$key1]["text"] = $val1;
                $array_b[$key1]["selected"] = $val1 == $field ? 'selected' : '';
            }

            echo json_encode($array_b);
        }else{
            $sql_api_list = \db::query("SELECT DISTINCT API_TABLE_ALIAS FROM M_API_LIST WHERE API_STATUS = '1' AND API_REF IS NULL AND API_SETTING_ID = '".$setid."' AND API_TABLE_MAIN = '".$table."'");
            $api_list = \db::fetch_array($sql_api_list);
            
            if($api_list["API_TABLE_ALIAS"] == ''){
                $pattern = "/(AS )([a-zA-Z0-9_-]+)?/i";
                $apiSQL = $API['API_SQL'];
            }else{
                $alias = $api_list["API_TABLE_ALIAS"].".";
                $pattern = "/(".$alias.")([a-zA-Z0-9_-]+)?/i";

                $start = strpos($API['API_SQL'],"FROM");
                $apiSQL = substr($API['API_SQL'],0,$start);
            }

            if(preg_match_all($pattern, $apiSQL, $matches)) {
                if($matches[2][0] == ''){
                    $sqlnew_doc = "SELECT * FROM ".$table;
                    $WF_ARR_FIELD = db::query_field($sqlnew_doc);
                    foreach($WF_ARR_FIELD as $key => $val){
                        $array_b[$key]["id"] = $val;
                        $array_b[$key]["text"] = $val;
                        $array_b[$key]["selected"] = $val == $field ? 'selected' : '';
                    }
                }else{
                    foreach($matches[2] as $key1 => $val1){
                        $array_b[$key1]["id"] = $val1;
                        $array_b[$key1]["text"] = $val1;
                        $array_b[$key1]["selected"] = $val1 == $field ? 'selected' : '';
                    }
                }
                echo json_encode($array_b);
            }
        }     
    }
?>