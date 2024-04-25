<?php
/* function REGISTER_CODE_13_BANKRUPT($brcID, $CONCERN_NAME)
{ //ส่งรหัสคดีbrcID,ส่ง$CONCERN_NAME ='เจ้าหนี้,ลูกหนี้,จำเลย' =>ถ้า CONCERN_NAME ไม่ใส่คือเอาทุกสถานะ,
    $FILL = "";
    if ($CONCERN_NAME != '') {
        $FILL = "  AND a.CONCERN_NAME IN (" . ADD_SINGLE($CONCERN_NAME) . ")"; //การเลือกถ้านะที่เลือกเท่านั้น
    }

    $sql_WH_PERSON_COUPLE1 = "  SELECT *FROM WH_BANKRUPT_CASE_PERSON a
                            JOIN WH_BANKRUPT_CASE_DETAIL b ON a.WH_BANKRUPT_ID =b.WH_BANKRUPT_ID 
                            WHERE 1=1
                            AND a.REGISTER_CODE IS NOT NULL
                            AND b.BANKRUPT_CODE= '" . $brcID . "'{$FILL}
                            ";
    $REGISTERCODE_C1 = '';
    $queryWH_PERSON_COUPLE1 = db::query($sql_WH_PERSON_COUPLE1);
    while ($rec_WH = db::fetch_array($queryWH_PERSON_COUPLE1)) {
        $REGISTERCODE_C1 .= $rec_WH["REGISTER_CODE"] . ",";
    }
   return cut_last_comma($REGISTERCODE_C1);
} */
