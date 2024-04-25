<?php

//function Person start
class   ClassCustom_php
{
    //function Person start
    public static function insertPerson($dataReturn, $data_main, $WH_CIVIL_ID)
    {
        db::db_delete("WH_CIVIL_CASE_PERSON_MAIN", array('WH_CIVIL_ID' => $WH_CIVIL_ID));
        if (count($dataReturn['Data']['person']) > 0) {
            $personCode = "";
            $personAr = [];
            foreach ($dataReturn['Data']['person'] as $key => $data_person) {
                if ($personCode != $data_person["personCode"]) { //personCode ถ้าไม่เคยบันทึกมาก่อนให้บันทึก ถ้าบันทึกซ้ำกันจะไม่ทำงาน
                    $personCode = $data_person["personCode"];
                    //concern สถานะของคน start
                    //เมื่อPerson มีสถานนะมากกว่า1 เช่น นายA เป็น จำเลย,ผู้รับจำนอง จะทำการ insert 2 row 
                    if (count($dataReturn['Data']['personConnerName']) > 0) {
                        foreach ($dataReturn['Data']['personConnerName'] as $key => $data_person_concern) {
                            print_pre($data_person_concern);
                            unset($fieldConner);
                            $fieldConner['CONCERN_CODE']     = $data_person_concern['concernCode'];
                            $fieldConner['PERSON_CODE']     = $data_person_concern['personCode'];
                            $fieldConner['CONCERN_NAME']     = $data_person_concern['concernName'];

                            //ตรวจสอบว่า personCode เป็นคนเดียวกันหรือไม่ถ้าใช้ให้ทำการinsert
                            if ($data_person["personCode"] == $data_person_concern['personCode']) {
                                //WH_CIVIL_CASE_PERSON start
                                unset($fields);
                                $fields["WH_CIVIL_ID"]             = $WH_CIVIL_ID;
                                $fields["PERSON_CODE"]             = $data_person["personCode"];
                                $fields["REGISTER_CODE"]         = $data_person["registerId"];
                                $fields["PREFIX_CODE"]             = $data_person["titleCode"];

                                $fields["PREFIX_NAME"]             = (trim($data_person["fname"]) == "") ? null : $data_person["titleName"];
                                $fields["FIRST_NAME"]             = (trim($data_person["fname"]) == "") ? $data_person["personFullName"] : $data_person["fname"];
                                $fields["LAST_NAME"]             = $data_person["lname"];
                                $fields["FULL_NAME"]             = $data_person["personFullName"];

                                $fields["PERSON_TYPE"]             = $data_person["personType"];
                                $fields["PERSON_TYPE_NAME"]        = $data_person["personTypeName"];
                                // $fields["PERSON_TYPE"] 			= (substr($data_person["registerId"], 0, 1) == '0') ? 2 : 1; //$data_person["personType"]
                                // $fields["PERSON_TYPE_NAME"]		= ($fields["PERSON_TYPE"] == 1) ? 'บุคคลธรมดา' : 'นิติบุคคล';
                                $fields["SEX"]                     = $data_person["sex"];
                                $fields["RACE"]                 = $data_person["race"];
                                $fields["NATIONALITY"]             = $data_person["nationality"];

                                $fields["COURT_CODE"]             = $data_main["courtCode"];
                                $fields["COURT_NAME"]             = $data_main["courtName"];
                                $fields["DEPT_CODE"]             = $data_main["deptCode"];
                                $fields["DEPT_NAME"]             = $data_main["deptName"];
                                $fields["PREFIX_BLACK_CASE"]     = $data_main["prefixBlackCase"];
                                $fields["BLACK_CASE"]             = $data_main["blackCase"];
                                $fields["BLACK_YY"]             = $data_main["blackYy"];
                                $fields["PREFIX_RED_CASE"]         = $data_main["prefixRedCase"];
                                $fields["RED_CASE"]             = $data_main["redCase"];
                                $fields["RED_YY"]                 = $data_main["redYy"];

                                $fields["ADDRESS"]                 = $data_person["houseNo"];
                                $fields["TUM_CODE"]             = $data_person["tumCode"];
                                $fields["TUM_NAME"]             = $data_person["tumName"];
                                $fields["AMP_CODE"]             = $data_person["ampCode"];
                                $fields["AMP_NAME"]             = $data_person["ampName"];
                                $fields["PROV_CODE"]             = $data_person["provCode"];
                                $fields["PROV_NAME"]             = $data_person["prvName"];
                                $fields["ZIP_CODE"]             = $data_person["postCode"];
                                $fields["CONCERN_CODE"]         = $data_person_concern['concernCode'];
                                $fields["CONCERN_NAME"]         = $data_person_concern['concernName'];
                                $fields["CONCERN_NO"] 			= $data_person_concern["concernNo"];
                                $fields["MOO"]                     = $data_person["moo"];
                                $fields["SOI"]                     = $data_person["soi"];
                                $fields["PERSON_PCC_CASE_GEN"]     = $data_person["pccCaseGen"];
                                $fields["PER_ORDER_STATUS"]     = $data_person["executionStatus"];
                                db::db_insert("WH_CIVIL_CASE_PERSON_MAIN", $fields, 'WH_PERSON_ID', 'WH_PERSON_ID');
                                $personAr[] = $fields;
                                //WH_CIVIL_CASE_PERSON stop
                            }
                        }
                    }
                }
            }
            return $personAr;
        }
    } //function stop
}
