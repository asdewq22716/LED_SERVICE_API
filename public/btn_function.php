<?php

class cmdMain
{
    public $recGetFullName;
    public $GetCaseData;

    public $mainData;
    public $ArraySend;
    public $ArraySendTo;

    public function pageAssets_cmd_from_send_to()
    {
        $mainData = $this->mainData;
        $ArraySend = $this->ArraySend;
?>
        <div class="form-group row">
            <div class="col-md-12 wf-center ">
                <label for="" class="form-control-label wf-center">รายการทรัพย์</label>
                <div class="table-responsive">
                    <table id="wfsflow" class="table table-bordered sorted_table">
                        <thead class="bg-primary">
                            <tr class="bg-primary">
                                <th style="width:5%;" class="text-center">ลำดับ</th>
                                <th style="width:25%;" class="text-center">รายการทรัพย์</th>
                                <th style="width:20%;" class="text-center">ประเภทกลุ่มคำสั่งเจ้าพนักงาน</th>
                                <th style="width:20%;" class="text-center">คำสั่งเจ้าพนักงาน</th>
                                <th style="width:10%;" class="text-center">สถานะ</th>
                                <th style="width:25%;" class="text-center">action</th>
                            </tr>
                        </thead>
                        <tbody id="show_asset"><!-- wfs_show_asset -->
                            <?php
                            $fileterAsset = "";

                            //ถ้ามาจากหน้า เเก้ไข หรือตอบกลับ จะใช้ข้อมูลที่เคย บันทึกเข้ามา M_CMD_ASSET
                            if ($mainData["proc"] == "edit") {
                                $fileterAsset = " AND CMD_ID = " . $mainData['ID'] . "";
                            } else {
                                if ($mainData['REF_ID'] > 0) {
                                    $fileterAsset = " AND CMD_ID = " . $mainData['REF_ID'] . "";
                                }
                            }
                            if ($fileterAsset != "") {
                                $i = 1;
                                $sqlSelectCmdAsset         = "select * from M_CMD_ASSET where 1=1 {$fileterAsset}";
                                $querySelectCmdAsset     = db::query($sqlSelectCmdAsset);
                                while ($recSelectCmdAsset = db::fetch_array($querySelectCmdAsset)) {
                            ?>
                                    <tr>
                                        <td align="center"><?php echo $i; ?></td>
                                        <td><a onclick="show_asset_detail(<?php echo $recSelectCmdAsset['ASSET_ID']; ?>)" href="javascript:void();"><?php echo $recSelectCmdAsset["PROP_DET"]; ?></a></td>
                                        <td>
                                            <div class="col-md-12">
                                                <select name="CMD_TYPE[<?php echo $recSelectCmdAsset["ASSET_ID"] ?>]" id="CMD_TYPE_<?php echo $recSelectCmdAsset["ASSET_ID"] ?>" style="width: 50%;" class="form-control select2" tabindex="-1" aria-hidden="true" required onChange="getCaseType('<?php echo $recSelectCmdAsset["ASSET_ID"] ?>')">
                                                    <option value="" disabled selected>เลือกประเภทกลุ่มคำสั่ง</option>
                                                    <?php $sql = "SELECT DISTINCT
															CMD_GRP_NAME,B.CMD_TYPE_ID
															FROM
															M_CMD_TYPE A
															LEFT JOIN M_SERVICE_CMD B ON A.CMD_TYPE_ID = B.CMD_TYPE_ID
															LEFT JOIN M_CMD_SYSTEM C ON B.CMD_SYS_ID = C.CMD_SYSTEM_ID
															WHERE GRP_NOTI_FLAG = '1'
															ORDER BY
															A.CMD_GRP_NAME ASC";
                                                    $query = db::query($sql);
                                                    while ($rec = db::fetch_array($query)) {
                                                    ?>
                                                        <option value="<?php echo $rec['CMD_TYPE_ID']; ?>" <?php echo ($recSelectCmdAsset["ASSET_CMD_TYPE"] == $rec['CMD_TYPE_ID']) ? "selected" : ""; ?>><?php echo $rec['CMD_GRP_NAME']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="col-md-12">
                                                <select name="CASE_TYPE[<?php echo $recSelectCmdAsset["ASSET_ID"] ?>]" id="CASE_TYPE_<?php echo $recSelectCmdAsset["ASSET_ID"] ?>" class="form-control select2" tabindex="-2">
                                                    <?php
                                                    $sql2 = "	SELECT 		DISTINCT CMD_TYPE_NAME,CMD_TYPE_CODE
																	FROM 		M_SERVICE_CMD A
																	LEFT JOIN 	M_CMD_SYSTEM B ON A.CMD_SYS_ID = B.CMD_SYSTEM_ID
																	LEFT JOIN 	M_CMD_TYPE C ON A.CMD_TYPE_ID = C.CMD_TYPE_ID
																	WHERE 		A.CMD_TYPE_ID = '" . $recSelectCmdAsset["ASSET_CMD_TYPE"] . "'AND CMD_STATUS = 1 and b.CMD_SYSTEM_ID = " . $ArraySend["SYSTEM_ID"] . "
																	ORDER BY 	A.CMD_TYPE_NAME ASC";
                                                    $query2 = db::query($sql2);
                                                    ?>
                                                    <option value="" disabled selected>เลือกคำสั่ง</option>
                                                    <?php
                                                    while ($dataqry = db::fetch_array($query2)) {
                                                    ?>
                                                        <option value="<?php echo $dataqry['CMD_TYPE_CODE']; ?>" <?php echo ($dataqry["CMD_TYPE_CODE"] == $dataqry['CMD_TYPE_CODE']) ? "selected" : ""; ?>><?php echo $dataqry['CMD_TYPE_NAME']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                        </td>
                                        <td>
                                            <?php echo $recSelectCmdAsset["PROP_STATUS_NAME"]; ?>
                                            <input type="hidden" name="ASSET_ID[<?php echo $recSelectCmdAsset["ASSET_ID"] ?>]" id="PROP_TITLE_<?php echo $recSelectCmdAsset["ASSET_ID"] ?>" value="<?php echo $recSelectCmdAsset["ASSET_ID"] ?>">
                                            <input type="hidden" name="PROP_TITLE[<?php echo $recSelectCmdAsset["ASSET_ID"] ?>]" id="PROP_TITLE_<?php echo $recSelectCmdAsset["ASSET_ID"] ?>" value="<?php echo $recSelectCmdAsset["PROP_DET"] ?>">
                                            <input type="hidden" name="TYPE_CODE[<?php echo $recSelectCmdAsset["ASSET_ID"] ?>]" id="TYPE_CODE_<?php echo $recSelectCmdAsset["ASSET_ID"] ?>" value="<?php echo $recSelectCmdAsset["TYPE_CODE"] ?>">
                                            <input type="hidden" name="TYPE_DESC_[<?php echo $recSelectCmdAsset["ASSET_ID"] ?>]" id="TYPE_DESC_<?php echo $recSelectCmdAsset["ASSET_ID"] ?>" value="<?php echo $recSelectCmdAsset["TYPE_DESC"] ?>">
                                            <input type="hidden" name="PROP_STATUS[<?php echo $recSelectCmdAsset["ASSET_ID"] ?>]" id="PROP_STATUS_<?php echo $recSelectCmdAsset["ASSET_ID"] ?>" value="<?php echo $recSelectCmdAsset["PROP_STATUS"] ?>">
                                            <input type="hidden" name="PROP_STATUS_NAME[<?php echo $recSelectCmdAsset["ASSET_ID"] ?>]" id="PROP_STATUS_NAME_<?php echo $recSelectCmdAsset["ASSET_ID"] ?>" value="<?php echo $recSelectCmdAsset["PROP_STATUS_NAME"] ?>">
                                            <input type="hidden" name="CFC_CAPTION_GEN[<?php echo $recSelectCmdAsset["ASSET_ID"] ?>]" id="CFC_CAPTION_GEN_<?php echo $recSelectCmdAsset["ASSET_ID"] ?>" value="<?php echo $recSelectCmdAsset["CFC_CAPTION_GEN"] ?>">
                                        </td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php
    }
    public function pagePerson_cmd_from_send_to()
    {
        $mainData = $this->mainData;
        $ArraySend = $this->ArraySend;
    ?>
        <?php
        unset($MData);
        $MData = [
            "REF_ID" => $mainData['REF_ID'],
        ];
        unset($Array);
        $Array = [
            "PREFIX_CASE_BLACK" => $ArraySend['PREFIX_CASE_BLACK'],
            "CASE_BLACK" => $ArraySend['CASE_BLACK'],
            "CASE_BLACK_YEAR" => $ArraySend['CASE_BLACK_YEAR'],
            "PREFIX_CASE_RED" => $ArraySend['PREFIX_CASE_RED'],
            "CASE_RED" => $ArraySend['CASE_RED'],
            "CASE_RED_YEAR" => $ArraySend['CASE_RED_YEAR'],
            "COURT_CODE" => $ArraySend['COURT_CODE']
        ];
        if ($ArraySend['SYSTEM_ID'] == 1) { //ระบบงานบังคับคดีแพ่ง
            $Civil = new func();
            $sqlSelectDataPerson = $Civil->DataPersonCivil($MData, $Array);
        } else if ($ArraySend['SYSTEM_ID'] == 2) { //ระบบงานบังคับคดีล้มละลาย
            $Bankrupt = new func();
            $sqlSelectDataPerson = $Bankrupt->DataPersonBankrupt($MData, $Array);
        } else if ($ArraySend['SYSTEM_ID'] == 3) { //ระบบงานฟื้นฟูกิจการของลูกหนี้
            $Revive = new func();
            $sqlSelectDataPerson = $Revive->DataPersonRevive($MData, $Array);
        } else if ($ArraySend['SYSTEM_ID'] == 4) { //ระบบงานไกล่เกลี่ยข้อพิพาท
            $Mediate = new func();
            $sqlSelectDataPerson = $Mediate->DataPersonMediate($MData, $Array);
        } else if ($ArraySend['SYSTEM_ID'] == 5) { //ระบบงานไกล่เกลี่ยข้อพิพาท
            unset($MData);
            $MData = [
                "GET_PER_TYPE" => $mainData["GET_PER_TYPE"],
                "GET_PER_CASE" => $mainData['GET_PER_CASE'],
                "REF_ID" => $mainData['REF_ID'],
            ];
            unset($Array);
            $Array = [
                "PREFIX_CASE_BLACK" => $ArraySend['PREFIX_CASE_BLACK'],
                "CASE_BLACK" => $ArraySend['CASE_BLACK'],
                "CASE_BLACK_YEAR" => $ArraySend['CASE_BLACK_YEAR'],
                "PREFIX_CASE_RED" => $ArraySend['PREFIX_CASE_RED'],
                "CASE_RED" => $ArraySend['CASE_RED'],
                "CASE_RED_YEAR" => $ArraySend['CASE_RED_YEAR'],
                "COURT_CODE" => $ArraySend['COURT_CODE']
            ];
            $Backoffice = new func();
            $sqlSelectDataPerson = $Backoffice->DataPersonMediate($MData, $Array);
        }
        // echo $sqlSelectDataPerson;
        $querySelectDataPerson = db::query($sqlSelectDataPerson);

        ?>
        <div class="form-group row">
            <div class="col-md-12 wf-center ">
                <label for="" class="form-control-label wf-center">บุคคลที่เกี่ยวข้องตามคำสั่ง</label>
                <div class="table-responsive">
                    <table id="wfsflow" class="table table-bordered sorted_table ">
                        <thead class="bg-primary">
                            <tr class="bg-primary">
                                <th style="width:5%;" class="text-center">ลำดับ</th>
                                <th style="width:35%;" class="text-center">ชื่อ</th>
                                <th style="width:30%;" class="text-center">ประเภทกลุ่มคำสั่งเจ้าพนักงาน</th>
                                <th style="width:30%;" class="text-center">คำสั่งเจ้าพนักงาน</th>
                            </tr>
                        </thead>
                        <tbody id="wfs_show_person">
                            <?php
                            $num_per = 1;
                            while ($recSelectDataPerson = db::fetch_array($querySelectDataPerson)) {

                                //เงื่อนไขคือถ้าทำการเเก้ไขรายการคนจะถูกcheckedไว้
                                if (($mainData['ID']) > 0) {
                                    $sqlSelectCmdPerson = "SELECT ID_CARD,PERSON_CMD_TYPE,PERSON_CASE_TYPE FROM M_CMD_PERSON WHERE CMD_ID = '" . $mainData['ID'] . "' AND ID_CARD = '" . $recSelectDataPerson["REGISTER_CODE"] . "'";
                                    $querySelectCmdPerson = db::query($sqlSelectCmdPerson);
                                    $recSelectCmdPerson = db::fetch_array($querySelectCmdPerson);
                                }
                            ?>
                                <tr>
                                    <td align="center">
                                        <?php
                                        if ($mainData["REF_ID"] != "") {
                                        ?>
                                            <input type="hidden" name="LIST_REGISTER_CODE[<?php echo $recSelectDataPerson["REGISTER_CODE"] ?>]" id="LIST_REGISTER_CODE<?php echo $recSelectDataPerson["REGISTER_CODE"] ?>" value="<?php echo $recSelectDataPerson["REGISTER_CODE"] ?>"><?php echo $num_per; ?>
                                            <?php
                                        } else {
                                            if ($recSelectDataPerson["REGISTER_CODE"] == $recSelectCmdPerson["ID_CARD"]) {
                                            ?>
                                                <label><input type="checkbox" style="display: none;" name="LIST_REGISTER_CODE[<?php echo $recSelectDataPerson["REGISTER_CODE"]; ?>]" id="LIST_REGISTER_CODE<?php echo $recSelectDataPerson["REGISTER_CODE"]; ?>" value="<?php echo $recSelectDataPerson["REGISTER_CODE"]; ?>" <?php echo ($recSelectDataPerson["REGISTER_CODE"] == $recSelectCmdPerson["ID_CARD"]) ? "checked" : ""; ?>> <i class='icofont icofont-tick-mark' title=''></i><?php echo $num_per; ?></label>
                                            <?php
                                            } else {
                                            ?>
                                                <label><input type="checkbox" name="LIST_REGISTER_CODE[<?php echo $recSelectDataPerson["REGISTER_CODE"]; ?>]" id="LIST_REGISTER_CODE<?php echo $recSelectDataPerson["REGISTER_CODE"]; ?>" value="<?php echo $recSelectDataPerson["REGISTER_CODE"]; ?>" <?php echo ($recSelectDataPerson["REGISTER_CODE"] == $recSelectCmdPerson["ID_CARD"]) ? "checked" : ""; ?>> <?php echo $num_per; ?></label>
                                            <?php
                                            }
                                            ?>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $recSelectDataPerson["CONCERN_NAME"] . " : " . $recSelectDataPerson["PREFIX_NAME"] . $recSelectDataPerson["FIRST_NAME"] . " " . $recSelectDataPerson["LAST_NAME"] ?></td>
                                    <?php
                                    /* เงื่อนไขการเลือกคำสั่ง */
                                    $fill_CMD_TYPE_ID = "";
                                    $PERSON_CMD_TYPE = "";
                                    $PERSON_CASE_TYPE = $recSelectCmdPerson["PERSON_CASE_TYPE"];
                                    $PERSON_CMD_TYPE = $recSelectCmdPerson["PERSON_CMD_TYPE"];
                                    if ($ArraySend['SYSTEM_ID'] == '1') {
                                        $fill_CMD_TYPE_ID = "AND A.CMD_TYPE_ID ='2'";
                                        $PERSON_CMD_TYPE = empty($PERSON_CMD_TYPE) ? "2" : $PERSON_CMD_TYPE;
                                        $PERSON_CASE_TYPE = empty($PERSON_CASE_TYPE) ? "10201" : $PERSON_CASE_TYPE;
                                    } else if ($ArraySend['SYSTEM_ID'] == '3') {
                                        $fill_CMD_TYPE_ID = "AND A.CMD_TYPE_ID ='2'";
                                        $PERSON_CMD_TYPE = empty($PERSON_CMD_TYPE) ? "2" : $PERSON_CMD_TYPE;
                                        $PERSON_CASE_TYPE = empty($PERSON_CASE_TYPE) ? "30201" : $PERSON_CASE_TYPE;
                                    } else if ($ArraySend['SYSTEM_ID'] == '4') {
                                        $fill_CMD_TYPE_ID = "AND A.CMD_TYPE_ID ='2'";
                                        $PERSON_CMD_TYPE = empty($PERSON_CMD_TYPE) ? "2" : $PERSON_CMD_TYPE;
                                        $PERSON_CASE_TYPE = empty($PERSON_CASE_TYPE) ? "40201" : $PERSON_CASE_TYPE;
                                    }
                                    /* stop */

                                    $sql = "SELECT DISTINCT
																		CMD_GRP_NAME,B.CMD_TYPE_ID
																		FROM
																		M_CMD_TYPE A
																		LEFT JOIN M_SERVICE_CMD B ON A.CMD_TYPE_ID = B.CMD_TYPE_ID
																		LEFT JOIN M_CMD_SYSTEM C ON B.CMD_SYS_ID = C.CMD_SYSTEM_ID
																		WHERE GRP_NOTI_FLAG = '1'
																		{$fill_CMD_TYPE_ID}
																		ORDER BY
																		A.CMD_GRP_NAME ASC";
                                    $query = db::query($sql);
                                    ?>
                                    <td>
                                        <select name="CMD_TYPE_PERSON[<?php echo $recSelectDataPerson["REGISTER_CODE"] ?>]" id="CMD_TYPE_PERSON_<?php echo $recSelectDataPerson["REGISTER_CODE"] ?>" class="form-control select2" tabindex="-1" aria-hidden="true" required onChange="getCaseTypePerson('<?php echo $recSelectDataPerson["REGISTER_CODE"] ?>')">
                                            <option value="" disabled selected>เลือกประเภทกลุ่มคำสั่ง</option>
                                            <?php
                                            $i = 0;
                                            while ($rec = db::fetch_array($query)) {
                                            ?>
                                                <option value="<?php echo $rec['CMD_TYPE_ID']; ?>" <?php echo ($PERSON_CMD_TYPE == $rec['CMD_TYPE_ID']) ? "selected" : ""; ?>><?php echo $rec['CMD_GRP_NAME']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <?php
                                    if (empty($recSelectCmdPerson["PERSON_CMD_TYPE"])) {
                                        $CMD_TYPE_ID = $ArraySend['SYSTEM_ID'];
                                    } else {
                                        $CMD_TYPE_ID = $recSelectCmdPerson["PERSON_CMD_TYPE"];
                                    }
                                    $sql2 = "	SELECT 		DISTINCT CMD_TYPE_NAME,CMD_TYPE_CODE
																FROM 		M_SERVICE_CMD A
																LEFT JOIN 	M_CMD_SYSTEM B ON A.CMD_SYS_ID = B.CMD_SYSTEM_ID
																LEFT JOIN 	M_CMD_TYPE C ON A.CMD_TYPE_ID = C.CMD_TYPE_ID
																WHERE 		A.CMD_TYPE_ID = '" . $PERSON_CMD_TYPE . "'AND CMD_STATUS = 1 and b.CMD_SYSTEM_ID = " . $ArraySend['SYSTEM_ID'] . "
																ORDER BY 	A.CMD_TYPE_NAME ASC";
                                    //echo $sql2."<br><br>";
                                    $query2 = db::query($sql2);
                                    ?>
                                    <td>

                                        <select name="CASE_TYPE_PERSON[<?php echo $recSelectDataPerson["REGISTER_CODE"] ?>]" id="CASE_TYPE_PERSON_<?php echo $recSelectDataPerson["REGISTER_CODE"] ?>" class="form-control select2" tabindex="-2">
                                            <?php

                                            $i = 0;
                                            ?>
                                            <option value="" disabled selected>เลือกคำสั่ง</option>
                                            <?php
                                            while ($dataqry = db::fetch_array($query2)) {
                                            ?>
                                                <option value="<?php echo $dataqry['CMD_TYPE_CODE']; ?>" <?php echo ($PERSON_CASE_TYPE == $dataqry['CMD_TYPE_CODE']) ? "selected" : ""; ?>><?php echo $dataqry['CMD_TYPE_NAME']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <input type="hidden" name="GET_PREFIX_NAME[<?php echo $recSelectDataPerson["REGISTER_CODE"] ?>]" id="GET_PREFIX_NAME<?php echo $recSelectDataPerson["REGISTER_CODE"] ?>" value="<?php echo $recSelectDataPerson["PREFIX_NAME"] ?>">
                                <input type="hidden" name="GET_FIRST_NAME[<?php echo $recSelectDataPerson["REGISTER_CODE"] ?>]" id="GET_FIRST_NAME<?php echo $recSelectDataPerson["REGISTER_CODE"] ?>" value="<?php echo $recSelectDataPerson["FIRST_NAME"] ?>">
                                <input type="hidden" name="GET_LAST_NAME[<?php echo $recSelectDataPerson["REGISTER_CODE"] ?>]" id="TYPE_CODE_<?php echo $recSelectDataPerson["REGISTER_CODE"] ?>" value="<?php echo $recSelectDataPerson["LAST_NAME"] ?>">
                            <?php
                                $num_per++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php
    }

    public function page_cmd_from_send_to()
    {
        $mainData = $this->mainData;
        $ArraySend = $this->ArraySend;
        $ArraySendTo = $this->ArraySendTo;
    ?>
        <div id="send">
            <div class="form-group row">
                <input type="hidden" name="F_TEMP_ID" id="F_TEMP_ID" value="<?php echo $mainData['id']; ?>">
                <input type="hidden" name="WFR" id="WFR" value="">
            </div>
            <div class="form-group row">
                <div id="CMD_DOC_DATE_BSF_AREA" class="col-md-2 ">
                    <label for="CMD_DOC_DATE" class="form-control-label wf-right">วันที่</label>
                </div>
                <div id="CMD_DOC_DATE_BSF_AREA" class="col-md-2 wf-left">
                    <label class="input-group">
                        <input <?php echo $mainData['inputReadonly']; ?> name="CMD_DOC_DATE" id="CMD_DOC_DATE" value="<?php echo date('d/m') . '/' . (date('Y') + 543)   ?>" class="form-control datepicker" placeholder="">
                        <span class="input-group-addon bg-primary"><span class="icofont icofont-ui-calendar"></span></span>
                    </label>
                </div>
                <div id="CMD_DOC_TIME_BSF_AREA" class="col-md-2 offset-md-1 ">
                    <label for="CMD_DOC_TIME" class="form-control-label wf-right">เวลา</label>
                </div>
                <div id="CMD_DOC_TIME_BSF_AREA" class="col-md-2 wf-left">
                    <input type="text" name="CMD_DOC_TIME" id="CMD_DOC_TIME" class="form-control" value="<?php echo date("H:i:s"); ?>" readonly="true">
                    <small id="DUP_CMD_DOC_TIME_ALERT" class="form-text text-danger" style="display:none"></small>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <div id="SEND_TO_BSF_AREA" class="col-md-2 "><label for="SEND_TO" class="form-control-label wf-right">คำสั่ง/สอบถาม/แจ้ง จากระบบงาน <span class="text-danger">*</span></label></div>
                <div id="SEND_TO_BSF_AREA" class="col-md-2 wf-left">
                    <select <?php echo $mainData['inputReadonly']; ?> name="SYSTEM_ID" id="SYSTEM_ID" class="form-control" tabindex="-1" aria-hidden="true" required onChange="showFormPerType();">
                        <option value="" disabled selected>เลือกระบบงาน</option>
                        <?php
                        $sql = "SELECT
										*
									  FROM M_CMD_SYSTEM
									  WHERE 1=1 AND CMD_SYSTEM_ID NOT IN (6)
									  ORDER BY SERVICE_SYS_NAME ASC
									  ";
                        $query = db::query($sql);
                        while ($rec = db::fetch_array($query)) {
                        ?>
                            <option value="<?php echo $rec['CMD_SYSTEM_ID']; ?>" <?php echo $ArraySend['SYSTEM_ID'] == $rec['CMD_SYSTEM_ID'] ? 'SELECTED' : '' ?>><?php echo $rec['SERVICE_SYS_NAME']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <!-- สำหรับBlackoffice -->
                <div class="show_per_type" style="display:none">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">ประเภทบุคคล</div>
                    <div class="col-md-2">
                        <label><input type="radio" name="GET_PER_TYPE" id="GET_PER_TYPE" value="1" checked> บุคลากร</label>
                        <label><input type="radio" name="GET_PER_TYPE" id="GET_PER_TYPE" value="2"> เจ้าหนี้</label>
                    </div>
                    <div id="CASE_TYPE_BSF_AREA" class="col-md-2 wf-left">
                        <button type="button" class="btn btn-success" id="getCaseDataBackoffice" style="background-color: #191970;border-color: #191970;">ดึงข้อมูล</button>
                    </div>
                </div>

                <div id="CMD_DOC_DATE_BSF_AREA" class="col-md-1 show_fix_bankrupt_date2" style="<?php echo ($mainData["CMD_FIX_DATE_STATUS"] == 'Y') ? "" : "display:none;" ?>">
                    <label for="CMD_FIX_DOC_DATE" class="form-control-label">วันที่คำสั่งมีผล</label>
                </div>
                <div id="CMD_DOC_DATE_BSF_AREA" class="col-md-2 wf-left show_fix_bankrupt_date2" style="<?php echo ($mainData["CMD_FIX_DATE_STATUS"] == 'Y') ? "" : "display:none;" ?>">
                    <label class="input-group">
                        <input name="CMD_FIX_DOC_DATE" id="CMD_FIX_DOC_DATE" value="<?php echo db2date($mainData["CMD_FIX_DOC_DATE"]) ?>" class="form-control datepicker" placeholder="">
                        <span class="input-group-addon bg-primary"><span class="icofont icofont-ui-calendar"></span></span>
                    </label>
                </div>


            </div>
            <span id="show_form_source_input">
                <div class="form-group row">
                    <div id="BLACK_CASE_BSF_AREA" class="col-md-2 ">
                        <label for="BLACK_CASE" class="form-control-label wf-right">หมายเลขคดีดำ <span class="text-danger show_class_required">*</span></label>
                    </div>
                    <div id="T_BLACK_CASE_BSF_AREA" class="col-md-1 wf-left">
                        <input type="text" name="T_BLACK_CASE" id="T_BLACK_CASE" class="form-control" value="<?php echo $ArraySend['PREFIX_CASE_BLACK']; ?>" <?php echo $mainData['inputReadonly']; ?>>
                        <small id="DUP_T_BLACK_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
                    </div>
                    <div id="BLACK_CASE_BSF_AREA" class="col-md-1 wf-left">
                        <input type="text" name="BLACK_CASE" id="BLACK_CASE" class="form-control" value="<?php echo $ArraySend['CASE_BLACK']; ?>" <?php echo $mainData['inputReadonly']; ?>>
                        <small id="DUP_BLACK_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
                    </div>
                    <div id="BLACK_YY_BSF_AREA" class="col-md-1 wf-left">
                        <div class="row">
                            <div id="" class="col-md-1 wf-left">
                                ปี
                            </div>
                            <div id="" class="col-md-5 wf-left">
                                <input type="text" name="BLACK_YY" id="BLACK_YY" class="form-control" value="<?php echo  $ArraySend['CASE_BLACK_YEAR']; ?>" <?php echo $mainData['inputReadonly']; ?>>
                                <small id="DUP_BLACK_YY_ALERT" class="form-text text-danger" style="display:none"></small>
                            </div>
                        </div>
                    </div>

                    <div id="RED_CASE_BSF_AREA" class="col-md-2 ">
                        <label for="RED_CASE" class="form-control-label wf-right">หมายเลขคดีแดง <span class="text-danger show_class_required">*</span></label>
                    </div>
                    <div id="T_RED_CASE_BSF_AREA" class="col-md-1 wf-left">
                        <input type="text" name="T_RED_CASE" id="T_RED_CASE" class="form-control" value="<?php echo $ArraySend['PREFIX_CASE_RED']; ?>" <?php echo $mainData['inputReadonly']; ?>>
                        <small id="DUPT_RED_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
                    </div>
                    <div id="RED_CASE_BSF_AREA" class="col-md-1 wf-left">
                        <input type="text" name="RED_CASE" id="RED_CASE" class="form-control" value="<?php echo $ArraySend['CASE_RED']; ?>" <?php echo $mainData['inputReadonly']; ?>>
                        <small id="DUP_RED_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
                    </div>
                    <div id="RED_YY_BSF_AREA" class="col-md-2 wf-left">
                        <div class="row">
                            <div id="RED_YY_BSF_AREA" class="col-md-1 wf-left">
                                ปี
                            </div>
                            <div id="RED_YY_BSF_AREA" class="col-md-5 wf-left">
                                <input type="text" name="RED_YY" id="RED_YY" class="form-control" value="<?php echo $ArraySend['CASE_RED_YEAR']; ?>" <?php echo $mainData['inputReadonly']; ?>>
                                <small id="DUP_RED_YY_ALERT" class="form-text text-danger" style="display:none"></small>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="form-group row">
                    <div id="CASE_TYPE_BSF_AREA" class="col-md-2 ">
                        <label for="CMD_TYPE" class="form-control-label wf-right">ศาล <span class="text-danger show_class_required">*</span></label>
                    </div>
                    <div id="CASE_TYPE_BSF_AREA" class="col-md-5 wf-left">
                        <select <?php echo $mainData['inputReadonly']; ?> name="COURT_CODE" id="COURT_CODE" class="form-control <?php echo ($mainData['inputReadonly'] != "") ? "" : "select2 select2-hidden-accessible" ?>" tabindex="-1" aria-hidden="true" required>
                            <option value="" disabled selected>ศาล</option>
                            <?php
                            $sqlCourt = "	SELECT 		COURT_CODE,COURT_NAME
												FROM 		M_COURT
												WHERE 		1=1 
												ORDER BY 	COURT_CODE ASC
												";
                            $queryCourt = db::query($sqlCourt);
                            while ($recCourt = db::fetch_array($queryCourt)) {
                            ?>
                                <option value="<?php echo $recCourt['COURT_CODE']; ?>" <?php echo ($ArraySend['COURT_CODE'] == $recCourt['COURT_CODE']) ? "selected" : ""; ?>><?php echo $recCourt['COURT_NAME']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div id="CASE_TYPE_BSF_AREA" class="col-md-1 wf-left">
                        <button type="button" class="btn btn-success" id="getCaseData" style="background-color: #191970;border-color: #191970;">ดึงข้อมูลคดี</button>
                    </div>
                    <div id="CASE_TYPE_BSF_AREA" class="col-md-1 wf-left">
                        <button type="button" class="btn btn-success" id="getCaseDataAsset1" style="background-color: #191970;border-color: #191970;">ดึงข้อมูลทรัพย์</button>
                    </div>
                </div>
                <div class="form-group row">
                    <div id="NAME_REQ" class="col-md-2 ">
                        <label for="NAME_REQ" class="form-control-label wf-right">โจทก์</label>
                    </div>
                    <div id="PLAINTIFF_PRE_NAME_AREA" class="col-md-8 wf-left">
                        <input type="text" name="D_C" id="D_C" class="form-control" value="<?php echo $ArraySend['PLAINTIFF']; ?>" <?php echo $mainData['inputReadonly']; ?>>
                        <small id="DUP_PLAINTIFF_PRE_NAME_ALERT" class="form-text text-danger" style="display:none"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="DEPT_NAME" class="form-control-label wf-right">จำเลย</label>
                    </div>
                    <div id="DEPT_NAME" class="col-md-8 wf-left">
                        <input type="text" name="D_NAME" id="D_NAME" class="form-control" value="<?php echo $ArraySend['DEFENDANT']; ?>" <?php echo $mainData['inputReadonly']; ?>>
                        <input type="hidden" id="CMD_PRIORITY_STATUS" value="">
                        <input type="hidden" id="CMD_READ_STATUS" value="0">
                        <small id="DEPT_NAME" class="form-text text-danger" style="display:none"></small>
                    </div>
                </div>
            </span>
        </div>
        <!-- ---------------------------------------------- -->
        <hr>
        <div id="sendTo">
            <span id="hide_form_send_to" style="<?php echo ($mainData["CMD_FIX_DATE_STATUS"] == 'Y') ? "display:none;" : "" ?>">
                <div class="form-group row">
                    <div id="CASE_TYPE_BSF_AREA" class="col-md-2 ">
                        <label for="CASE_TYPE" class="form-control-label wf-right">ส่งถึงระบบ <span class="text-danger">*</span></label>
                    </div>
                    <div id="SEND_TO_BSF_AREA" class="col-md-2 wf-left">
                        <select <?php echo $mainData['inputReadonly']; ?> name="SEND_TO" id="SEND_TO" class="form-control" tabindex="-1" aria-hidden="true" required onChange="showFormPerType2();">
                            <option value="" disabled selected>เลือกระบบงาน</option>
                            <?php
                            $sql = "SELECT
                                        *
                                        FROM M_CMD_SYSTEM
                                        WHERE 1=1 
                                        ORDER BY SERVICE_SYS_NAME ASC
                                        ";
                            $query = db::query($sql);
                            while ($rec = db::fetch_array($query)) {
                            ?>
                                <option value="<?php echo $rec['CMD_SYSTEM_ID']; ?>" <?php echo $ArraySendTo['SYSTEM_ID']  == $rec['CMD_SYSTEM_ID'] ? 'SELECTED' : '' ?>><?php echo $rec['SERVICE_SYS_NAME']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>



                </div>

                <span id="form_dept_to_backoffice">
                    <div id="CASE_TYPE_BSF_AREA" class="col-md-2 ">
                        <label for="CASE_TYPE" class="form-control-label wf-right">หน่วยงาน <span class="text-danger">*</span></label>
                    </div>
                    <div id="SEND_TO_BSF_AREA" class="col-md-2 wf-left">
                        <select name="TO_DEPT_NAME" id="TO_DEPT_NAME" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true" required>
                            <?php
                            $sqlDept = "	SELECT  ORG_NAME 
                                            FROM WH_BACKOFFICE_PERSON WHERE ORG_ID > 0
                                            GROUP BY 	ORG_NAME
                                            order by 	ORG_NAME";
                            $queryDept = db::query($sqlDept);
                            while ($recDept = db::fetch_array($queryDept)) {
                            ?>
                                <option value="<?php echo $recDept['ORG_NAME']; ?>"><?php echo $recDept['ORG_NAME']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </span>



                <span id="show_form_source_input2">
                    <div class="form-group row">
                        <div id="BLACK_CASE_BSF_AREA" class="col-md-2 ">
                            <label for="BLACK_CASE" class="form-control-label wf-right">หมายเลขคดีดำปลายทาง <span class="text-danger show_class_required2">*</span></label>
                        </div>
                        <div id="T_BLACK_CASE_BSF_AREA" class="col-md-1 wf-left">
                            <input type="text" name="TO_T_BLACK_CASE" id="TO_T_BLACK_CASE" class="form-control" value="<?php echo $ArraySendTo['PREFIX_CASE_BLACK']; ?>" <?php echo $mainData['inputReadonly']; ?>>
                            <small id="DUP_T_BLACK_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
                        </div>
                        <div id="BLACK_CASE_BSF_AREA" class="col-md-1 wf-left">
                            <input type="text" name="TO_BLACK_CASE" id="TO_BLACK_CASE" class="form-control" value="<?php echo $ArraySendTo['CASE_BLACK']; ?>" <?php echo $mainData['inputReadonly']; ?>>
                            <small id="DUP_BLACK_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
                        </div>
                        <div id="BLACK_YY_BSF_AREA" class="col-md-1 wf-left">
                            <div class="row">
                                <div id="" class="col-md-1 wf-left">
                                    ปี
                                </div>
                                <div id="" class="col-md-5 wf-left">
                                    <input type="text" name="TO_BLACK_YY" id="TO_BLACK_YY" class="form-control" value="<?php echo $ArraySendTo['CASE_BLACK_YEAR']; ?>" <?php echo $mainData['inputReadonly']; ?>>
                                    <small id="DUP_BLACK_YY_ALERT" class="form-text text-danger" style="display:none"></small>
                                </div>
                            </div>
                        </div>
                        <div id="RED_CASE_BSF_AREA" class="col-md-2 ">
                            <label for="RED_CASE" class="form-control-label wf-right">หมายเลขคดีแดงปลายทาง <span class="text-danger show_class_required2">*</span></label>
                        </div>
                        <div id="T_RED_CASE_BSF_AREA" class="col-md-1 wf-left">
                            <input type="text" name="TO_T_RED_CASE" id="TO_T_RED_CASE" class="form-control" value="<?php echo $ArraySendTo['PREFIX_CASE_RED']; ?>" <?php echo $mainData['inputReadonly']; ?>>
                            <small id="DUPT_RED_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
                        </div>
                        <div id="RED_CASE_BSF_AREA" class="col-md-1 wf-left">
                            <input type="text" name="TO_RED_CASE" id="TO_RED_CASE" class="form-control" value="<?php echo $ArraySendTo['CASE_RED']; ?>" <?php echo $mainData['inputReadonly']; ?>>
                            <small id="DUP_RED_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
                        </div>
                        <div id="RED_YY_BSF_AREA" class="col-md-2 wf-left">
                            <div class="row">
                                <div id="RED_YY_BSF_AREA" class="col-md-1 wf-left">
                                    ปี
                                </div>
                                <div id="RED_YY_BSF_AREA" class="col-md-5 wf-left">
                                    <input type="text" name="TO_RED_YY" id="TO_RED_YY" class="form-control" value="<?php echo $ArraySendTo['CASE_RED_YEAR']; ?>" <?php echo $mainData['inputReadonly']; ?>>
                                    <small id="DUP_RED_YY_ALERT" class="form-text text-danger" style="display:none"></small>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="form-group row">
                        <div id="TO_COURT_NAME_BSF_AREA" class="col-md-2 wf-left">
                            <label for="TO_COURT_NAME" class="form-control-label wf-right">ศาลปลายทาง <span class="text-danger show_class_required2">*</span></label>
                        </div>
                        <div id="TO_COURT_NAME_BSF_AREA" class="col-md-5 wf-left">
                            <?php
                            $Func = new func();
                            unset($COURT);
                            $COURT = [
                                'sql' => "SELECT COURT_CODE,COURT_NAME FROM M_COURT WHERE 1=1 ORDER BY COURT_CODE ASC", // sql
                                'name_id' => 'TO_COURT_CODE', // name_id =ชื่อเเละid
                                'Fill_vale' => 'COURT_CODE',   // Fill_vale ข้อมูลที่ต้องการ vale
                                'Fill_name' => 'COURT_NAME',  // Fill_name ข้อมูลที่ต้องการโชว์
                                'prosess' => " class='form-control' " . $mainData['inputReadonly'] . ($mainData['inputReadonly'] == "") ? "" : "select2 select2-hidden-accessible", //การทำงานเพิ่มเติม
                                'Selected' => $ArraySendTo['COURT_CODE'] // Selected ข้อมูลที่ต้องการเลือก
                            ];
                            //echo ($Func->getSelecter($COURT)); //ศาลปลายทาง*
                            ?>

                            <select <?php echo $mainData['inputReadonly']; ?> name="TO_COURT_CODE" id="TO_COURT_CODE" class="form-control <?php echo ($mainData['inputReadonly'] != "") ? "" : "select2 select2-hidden-accessible" ?>" tabindex="-1" aria-hidden="true" required>
                                <option value="" disabled selected>ศาล</option>
                                <?php
                                $sqlCourt = "SELECT
											COURT_CODE,COURT_NAME
										  FROM M_COURT
										  WHERE 1=1 
										  ORDER BY COURT_CODE ASC
										  ";
                                $queryCourt = db::query($sqlCourt);
                                while ($recCourt = db::fetch_array($queryCourt)) {
                                ?>
                                    <option value="<?php echo $recCourt['COURT_CODE']; ?>" <?php echo ($ArraySendTo['COURT_CODE'] == $recCourt['COURT_CODE']) ? "selected" : "" ?>><?php echo $recCourt['COURT_NAME']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div id="CASE_TYPE_BSF_AREA" class="col-md-1 wf-left">
                            <button type="button" class="btn btn-success" id="getCaseData2" style="background-color: #191970;border-color: #191970;">ดึงข้อมูลคดี</button>
                        </div>
                        <div id="CASE_TYPE_BSF_AREA" class="col-md-1 wf-left">
                            <button type="button" class="btn btn-success" id="getCaseDataAsset2" style="background-color: #191970;border-color: #191970;">ดึงข้อมูลทรัพย์</button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div id="NAME_REQ" class="col-md-2 ">
                            <label for="NAME_REQ" class="form-control-label wf-right">โจทก์</label>
                        </div>
                        <div id="PLAINTIFF_PRE_NAME_AREA" class="col-md-8 wf-left">
                            <input type="text" name="TO_PLAINTIFF" id="TO_PLAINTIFF" class="form-control" value="<?php echo $ArraySendTo['PLAINTIFF']; ?>" <?php echo $mainData['inputReadonly']; ?>>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="DEPT_NAME" class="form-control-label wf-right">จำเลย</label>
                        </div>
                        <div id="DEPT_NAME" class="col-md-8 wf-left">
                            <input type="text" name="TO_DEFENDANT" id="TO_DEFENDANT" class="form-control" value="<?php echo $ArraySendTo['DEFENDANT']; ?>" <?php echo $mainData['inputReadonly']; ?>>
                        </div>
                    </div>
                </span>
            </span>
        </div>
        <hr>
    <?php
    }

    public function GetFullNameSent($system, $CODE_API, $ID_CARD)
    {
        if ($_GET["GET_S_SYSTEM_ID"] == 1) {

            $sql = "   SELECT	a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.FULL_NAME 
             FROM	" . Convert::ConvertTable('WH_CIVIL_CASE_PERSON') . " a
            JOIN WH_CIVIL_CASE b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
            WHERE b.CIVIL_CODE ='{$CODE_API}'
            AND a.REGISTER_CODE='{$ID_CARD}'";
        } else if ($_GET["GET_S_SYSTEM_ID"] == 2) {
            $sql = "SELECT	a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME
            FROM	WH_BANKRUPT_CASE_PERSON a
            JOIN WH_BANKRUPT_CASE_DETAIL b ON a.WH_BANKRUPT_ID =b.WH_BANKRUPT_ID 
            WHERE b.BANKRUPT_CODE ='{$CODE_API}' 
            AND a.REGISTER_CODE ='{$ID_CARD}'";
        }
        $query = db::query($sql);
        $recGetFullName = db::fetch_array($query);
        $this->recGetFullName = $recGetFullName;
    }
    public function GetDataFormConcern($Array)
    {
    }

    public function GetCase($Array)
    {
        if ($Array['System'] == '1') {
            $sql = "SELECT *FROM 	WH_CIVIL_CASE 
					WHERE 	1=1 
                    AND PREFIX_BLACK_CASE = '" . $Array['prefixBlackCase'] . "'
					AND BLACK_CASE = '" . $Array['blackCase'] . "'
					AND BLACK_YY = '" . $Array['blackYy'] . "'
                    AND PREFIX_RED_CASE = '" . $Array['prefixRedCase'] . "'
					AND RED_CASE = '" . $Array['redCase'] . "'
					AND RED_YY = '" . $Array['redYy'] . "'
					AND COURT_CODE = '" . $Array['CourtCode'] . "'";
        } else if ($Array['System'] == '2') {
            $sql = "SELECT 	* FROM 	WH_BANKRUPT_CASE_DETAIL 
            WHERE 	1=1
                    AND PREFIX_BLACK_CASE = '" . $Array['prefixBlackCase'] . "'
                    AND BLACK_CASE = '" . $Array['blackCase'] . "'
                    AND BLACK_YY = '" . $Array['blackYy'] . "'
                    AND PREFIX_RED_CASE = '" . $Array['prefixRedCase'] . "'
                    AND RED_CASE = '" . $Array['redCase'] . "'
                    AND RED_YY = '" . $Array['redYy'] . "'
                    AND COURT_CODE = '010030'";
        } else if ($Array['System'] == '3') {
            $sql = "SELECT * FROM WH_REHABILITATION_CASE_DETAIL 
            WHERE 1=1 
                    AND PREFIX_BLACK_CASE = '" . $Array['prefixBlackCase'] . "'
					AND BLACK_CASE = '" . $Array['blackCase'] . "'
					AND BLACK_YY = '" . $Array['blackYy'] . "'
                    AND PREFIX_RED_CASE = '" . $Array['prefixRedCase'] . "'
					AND RED_CASE = '" . $Array['redCase'] . "'
					AND RED_YY = '" . $Array['redYy'] . "'
					AND COURT_CODE = '" . $Array['CourtCode'] . "'";
        } else if ($Array['System'] == '4') {
            $sql = "SELECT * FROM WH_MEDIATE_CASE 
            WHERE 1=1
                    AND PREFIX_BLACK_CASE = '" . $Array['prefixBlackCase'] . "'
			        AND BLACK_CASE = '" . $Array['blackCase'] . "'
			        AND BLACK_YY = '" . $Array['blackYy'] . "'
                    AND PREFIX_RED_CASE = '" . $Array['prefixRedCase'] . "'
					AND RED_CASE = '" . $Array['redCase'] . "'
					AND RED_YY = '" . $Array['redYy'] . "'
					AND COURT_CODE = '" . $Array['CourtCode'] . "'";
        }
        $query = db::query($sql);
        $this->GetCaseData = db::fetch_array($query);
        return $sql;
    }
    public function convertSystem($A) //รับเข้าBANKRUPTหรือBankrupt => 2
    {
        if ($A == 'BANKRUPT' || $A == 'Bankrupt') {
            $B = '2';
        }
        if ($A == 'CIVIL' || $A == 'Civil') {
            $B = '1';
        }
        if ($A == 'MEDIATE' || $A == 'Mediate') {
            $B = '4';
        }
        if ($A == 'REVIVE' || $A == 'Revive') {
            $B = '3';
        }
        return $B;
    }

    public function sqlCmd($REF_ID)
    {
        $sql_cmd = db::query("SELECT*
        FROM
            (
                SELECT
                    A .*, (
                        SELECT
                            CMD_NOTE
                        FROM
                            M_CMD_DETAILS B
                        WHERE
                            B.CMD_ID = A . ID
                        AND B.CMD_DETAIL_ID = (
                            SELECT
                                MAX (C.CMD_DETAIL_ID) AS aa
                            FROM
                                M_CMD_DETAILS C
                            WHERE
                                C.CMD_ID = A . ID
                            AND C.REF_DETAIL_ID IS NULL
                        )
                        AND ROWNUM = 1
                    ) AS CMD_DETAILS
                FROM
                    M_DOC_CMD A
                WHERE
                    1 = 1
                AND A . ID = '" . $REF_ID . "'
            ) CMD");
        $rec_cmd = db::fetch_array($sql_cmd);
        return $rec_cmd;
    }

    public function sqlCmdEdit($ID)
    {
        $sql_cmd = db::query("SELECT
									*
										FROM
											(
												SELECT
													A .*, (
														SELECT
															CMD_NOTE
														FROM
															M_CMD_DETAILS B
														WHERE
															B.CMD_ID = A . ID
														AND B.CMD_DETAIL_ID = (
															SELECT
																MAX (C.CMD_DETAIL_ID) AS aa
															FROM
																M_CMD_DETAILS C
															WHERE
																C.CMD_ID = A . ID
															AND C.REF_DETAIL_ID IS NULL
														)
														AND ROWNUM = 1
													) AS CMD_DETAILS
												FROM
													M_DOC_CMD A
												WHERE
													1 = 1
												AND A . ID = '" . $ID . "'
											) CMD");
        $rec_cmd = db::fetch_array($sql_cmd);
        return $rec_cmd;
    }
}
class Btn_function
{
    public $codeApi;
    public $systemType;

    public function BankruptAsset()
    {
        $codeApi = $this->codeApi;
        $Func = new func();
        $BankruptAssets = $Func->BankruptAssets($codeApi); //ข้อมูลทรัพย์ของล้ม
    ?>

        <div class="card text-white mb-3 " style="max-width:100%;margin: 15px 0px 15px 0px">
            <div class="card-header" style="padding: 10px 10px 10px 10px;background-color: #A8164E ;">
                <h4 style="color: #fff;">รายการทรัพย์</h4>
            </div>
            <div class="card-body" style="padding: 10px 10px 10px 10px;">
                <div class="row" style="margin:10px 5px 10px 5px;">
                    <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                        <thead class="thead-dark">
                            <tr>
                                <th style="background-color: #dc3545;color: white;">ที่</th>
                                <th style="background-color: #dc3545;color: white;">ประเภททรัพย์</th>
                                <th style="background-color: #dc3545;color: white;">ชื่อทรัพย์</th>
                                <th style="background-color: #dc3545;color: white;">สถานะ</th>
                                <th style="background-color: #dc3545;color: white;">ราคาประเมิน</th>
                                <th style="background-color: #dc3545;color: white;">รายละเอียด</th>
                            </tr>
                        </thead>
                        <?php
                        $i = 0;
                        foreach ($BankruptAssets as $AA1 => $BB1) {
                            $i++;
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td align='center'><?php echo $BB1['TYPE_CODE_NAME']; ?></td>
                                <td><?php echo $BB1['PROP_TITLE']; ?></td>
                                <td><?php echo $BB1['PROP_STATUS_NAME']; ?></td>
                                <td align='center'><?php echo !empty($BB1['EST_ASSET_PRICE1']) ? number_format($BB1['EST_ASSET_PRICE1'], 2) : "-"; ?></td>
                                <td><button type="button" onclick="dataAsset('<?php echo $codeApi; ?>','<?php echo $BB1['ASSET_ID']; ?>');" class=" btn btn-mini btn-primary form-control" id="BtnAssetBankrupt" data-toggle="modal" data-target="#modalAssetBankrupt">รายละเอียด</button></td>
                            </tr>
                        <?php
                        } ?>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalAssetBankrupt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ข้อมูลสำนวนกิจการและทรัพย์สิน</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="iframe_DataAssets"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end -->
        <script>
            function dataAsset(codeApi, ASSET_ID) {
                var iframe = document.createElement('iframe');
                iframe.src = './datailBankruptAssets.php?1=1&CODE_API=' + codeApi + '&ASSET_ID=' + ASSET_ID;
                // คำนวณความสูงที่ต้องการ (80% ของ viewport height)
                var viewportHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
                var iframeHeight = Math.round(viewportHeight * 0.8);
                iframe.style.width = '100%';
                iframe.style.height = 'calc(' + iframeHeight + 'px - 20px)'; // ลบความสูงขอบ header ออก (ประมาณ 20px)
                iframe.style.border = 'none';
                // เพิ่ม iframe ลงใน container
                var iframe_OrderCourt = document.getElementById('iframe_DataAssets');
                iframe_OrderCourt.innerHTML = ''; // ล้างเนื้อหาเดิม (ถ้ามี)
                iframe_OrderCourt.appendChild(iframe);
            }
        </script>
        <?php
    }
    public function orderCourt()
    {
        if ($this->systemType == '2') {
            $sql = "SELECT a.DOC_COR_ID_FK,a.RECEIPT_DOC,a.DOC_NUMBER ,a.DOC_DATE ,a.DOC_FROM_NAME ,a.DOT_NAME ,a.DOC_SUBJECT,
                        b.PREFIX_BLACK_CASE,b.BLACK_CASE ,b.BLACK_YY ,
                        b.PREFIX_RED_CASE ,b.RED_CASE ,b.RED_YY,
                        b.DOC_STATUS_NAME FROM WH_BANKRUPT_COURT_LOG a 
                        JOIN WH_BANKRUPT_CASE_DETAIL b ON a.BRC_ID_PK =b.BANKRUPT_CODE 
                        WHERE a.BRC_ID_PK ='" . $this->codeApi . "'
                        ORDER BY a.DOC_DATE DESC";
            //echo $sql ;
            $query = db::query($sql);
            $total = db::num_rows($query);

        ?>


            <div class="card text-white mb-3 " style="max-width:100%;margin: 15px 0px 15px 0px">
                <div class="card-header" style="padding: 10px 10px 10px 10px;background-color: #A8164E ;">
                    <h4 style="color: #fff;">คำสั่งศาล</h4>
                </div>
                <div class="card-body" style="padding: 10px 10px 10px 10px;">
                    <div class="row" style="margin:10px 5px 10px 5px;" width='100%'>
                        <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="background-color: #dc3545;color: white;" width='5%'>ลำดับที่</th>
                                    <th style="background-color: #dc3545;color: white;" width='5%'>เลขรับ</th>
                                    <th style="background-color: #dc3545;color: white;" width='5%'>เลขเอกสาร</th>
                                    <th style="background-color: #dc3545;color: white;" width='10%'>ลงวันที่</th>
                                    <th style="background-color: #dc3545;color: white;" width='5%'>จากศาล</th>
                                    <th style="background-color: #dc3545;color: white;" width='15%'>คำสั่งศาล/คำพิพากษา</th>
                                    <th style="background-color: #dc3545;color: white;" width='15%'>เรื่อง</th>
                                    <th style="background-color: #dc3545;color: white;" width='5%'>คดีหมายเลขดำที่</th>
                                    <th style="background-color: #dc3545;color: white;" width='5%'>คดีหมายเลขแดงที่</th>
                                    <th style="background-color: #dc3545;color: white;" width='5%'>สถานะ</th>
                                    <th style="background-color: #dc3545;color: white;" width='5%'>ดู</th>
                                </tr>
                            </thead>
                            <?php
                            $i = 0;
                            if ($total > 0) {
                                while ($rec = db::fetch_array($query)) {
                                    $i++;
                            ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $rec['RECEIPT_DOC']; ?></td>
                                        <td><?php echo $rec['DOC_NUMBER']; ?></td>
                                        <td><?php echo date_AK65(date('Y-m-d', strtotime($rec['DOC_DATE']))); ?></td>
                                        <td><?php echo $rec['DOC_FROM_NAME']; ?></td>
                                        <td><?php echo $rec['DOT_NAME']; ?></td>
                                        <td><?php echo $rec['DOC_SUBJECT']; ?></td>
                                        <td><?php echo $rec['PREFIX_BLACK_CASE'] . $rec['BLACK_CASE'] . "/" . $rec['BLACK_YY']; ?></td>
                                        <td><?php echo $rec['PREFIX_RED_CASE'] . $rec['RED_CASE'] . "/" . $rec['RED_YY']; ?></td>
                                        <td><?php echo $rec['DOC_STATUS_NAME']; ?></td>
                                        <td><button type="button" onclick="dataOrder('<?php echo $this->codeApi; ?>','<?php echo $rec['DOC_COR_ID_FK']; ?>');" class="btn btn-mini btn-primary form-control" id="BtnOrderCourt" data-toggle="modal" data-target="#modalOrderCourt">รายละเอียด</button></td>
                                    </tr>
                            <?php
                                }
                            } else {
                                tab::NotInformation(11);
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="modalOrderCourt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">คำสั่งศาล/คำพิพากษา</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="iframe_OrderCourt"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal end -->
            <script>
                function dataOrder(codeApi, DOC_COR_ID_FK) {
                    var iframe = document.createElement('iframe');
                    iframe.src = './detailOrderCourt.php?1=1&CODE_API=' + codeApi + '&DOC_COR_ID_FK=' + DOC_COR_ID_FK;
                    // คำนวณความสูงที่ต้องการ (80% ของ viewport height)
                    var viewportHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
                    var iframeHeight = Math.round(viewportHeight * 0.8);
                    iframe.style.width = '100%';
                    iframe.style.height = 'calc(' + iframeHeight + 'px - 20px)'; // ลบความสูงขอบ header ออก (ประมาณ 20px)
                    iframe.style.border = 'none';
                    // เพิ่ม iframe ลงใน container
                    var iframe_OrderCourt = document.getElementById('iframe_OrderCourt');
                    iframe_OrderCourt.innerHTML = ''; // ล้างเนื้อหาเดิม (ถ้ามี)
                    iframe_OrderCourt.appendChild(iframe);
                }
            </script>
        <?php
        }
    }


    public static function showCourtLogBankrupt(
        $PREFIX_BLACK_CASE = '',
        $BLACK_CASE = '',
        $BLACK_YY = '',
        $PREFIX_RED_CASE = '',
        $RED_CASE = '',
        $RED_YY = ''
    ) {
        $fill = "";
        if ($PREFIX_BLACK_CASE != "") {
            $fill .= " AND a.PREFIX_BLACK_CASE LIKE '%" . $PREFIX_BLACK_CASE . "%'";
        }
        if ($BLACK_CASE != "") {
            $fill .= " AND a.BLACK_CASE ='" . $BLACK_CASE . "'";
        }
        if ($BLACK_YY != "") {
            $fill .= "AND a.BLACK_YY ='" . $BLACK_YY . "'";
        }
        if ($PREFIX_RED_CASE != "") {
            $fill .= "AND a.PREFIX_RED_CASE LIKE '%" . $PREFIX_RED_CASE . "%'";
        }
        if ($RED_CASE != "") {
            $fill .= "AND a.RED_CASE ='" . $RED_CASE . "'";
        }
        if ($RED_YY != "") {
            $fill .= "  AND a.RED_YY ='" . $RED_YY . "'";
        }
        $SQL_ROUTE = "SELECT *FROM WH_COURT_LOG a 
       -- LEFT JOIN WH_BANKRUPT_CASE_PERSON b ON a.COURT_REGISTER_CODE =b.REGISTER_CODE 
        WHERE 1=1{$fill}";
        // echo  $SQL_ROUTE ;
        $queryROUTE = db::query($SQL_ROUTE);
        $total_ROUTE = db::num_rows(db::query($SQL_ROUTE));
        ?>
        <div class="row" class="col-md-12" style="margin: 10px 10px 10px 10px;">
            <div class="table-responsive">
                <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                    <thead class="thead-dark">
                        <tr>
                            <th style="background-color: #dc3545;color: white;">ลำดับ</th>
                            <th style="background-color: #dc3545;color: white;">คำสั่งศาล</th>
                            <th style="background-color: #dc3545;color: white;">วันที่มีคำสั่งศาล</th>
                        </tr>
                        <?php
                        if ($total_ROUTE == 0) {
                        ?>
                            <tr>
                                <td colspan="3">
                                    <div align='center'>ไม่พบข้อมูล</div>
                                </td>
                            </tr>
                            <?php
                        } else {
                            $i = 1;
                            while ($rec = db::fetch_array($queryROUTE)) { ?>
                                <tr>
                                    <td>
                                        <div align='center'><?php echo $i; ?></div>
                                    </td>
                                    <td>
                                        <div><?php echo $rec['COURT_DETAIL']; ?></div>
                                    </td>
                                    <td>
                                        <div><?php echo date_AK65(date("Y-m-d", strtotime($rec['COURT_DATE']))); ?></div>
                                    </td>
                                </tr>
                        <?php
                                $i++;
                            }
                        }
                        ?>
                    </thead>
                </table>
            </div>
        </div>
    <?php
    }
    public static function BankruptCheck($BANKRUPT_CODE, $TARGET_IDCARD)
    {

        function dash($data = "")
        {
            return !empty($data) ? $data : "-";
        }
        function DateCut($date_string)
        {
            $timestamp = strtotime($date_string);
            $date_formatted = date('d-m-Y', $timestamp);
            if (!empty($date_string)) {
                return $date_formatted;
            }
        }
        $sql_DETAIL = "SELECT a.PREFIX_BLACK_CASE ,a.BLACK_CASE ,a.BLACK_YY ,a.PREFIX_RED_CASE ,a.RED_CASE ,a.RED_YY 
        FROM WH_BANKRUPT_CASE_DETAIL a 
        WHERE a.BANKRUPT_CODE ='" . $BANKRUPT_CODE . "'";

        $query_DETAIL = db::query($sql_DETAIL);
        $recE = db::fetch_array($query_DETAIL);

        $sql_person = "SELECT a.FIRST_NAME ,a.LAST_NAME  FROM WH_BANKRUPT_CASE_PERSON a
                        WHERE a.REGISTER_CODE ='" . $TARGET_IDCARD . "'";
        $query_person = db::query($sql_person);
        $rec_person = db::fetch_array($query_person);

        $FIRST_NAME = $rec_person['FIRST_NAME'] == "" ? "" : "AND a.DEFFENDANT_NAME LIKE '%" . $rec_person['FIRST_NAME'] . "%'";
        $LAST_NAME = $rec_person['LAST_NAME'] == "" ? "" : "AND a.DEFFENDANT_NAME LIKE '%" . $rec_person['LAST_NAME'] . "%'";
        $sqlExecution = "SELECT *FROM WH_BANKRUPT_EXECUTION a
            WHERE a.BLACK_CASE ='" . $recE['PREFIX_BLACK_CASE'] . $recE['BLACK_CASE'] . "'
            AND a.BLACK_YY ='" . $recE['BLACK_YY'] . "'
            AND a.RED_CASE ='" . $recE['PREFIX_RED_CASE'] . $recE['RED_CASE'] . "'
            AND a.RED_YY ='" . $recE['RED_YY'] . "'
            {$FIRST_NAME}{$LAST_NAME}";

        $queryExecution = db::query($sqlExecution);
        $rec = db::fetch_array($queryExecution);
    ?>
        <div class="row " class="col-md-12">
            <div class="col-xs-12 col-sm-3">
                <label for="">พบจำเลยชื่อ</label>
            </div>
            <div class="col-xs-12 col-sm-3">
                <label for=""><?php echo dash($rec['DEFFENDANT_NAME']); ?></label><!-- ชื่อสกุล -->
            </div>
        </div>
        <div class="row " class="col-md-12">
            <div class="col-xs-12 col-sm-3">
                <label for="">เลขประจำตัวประชาชน/ทะเบียนนิติบุคคล</label>
            </div>
            <div class="col-xs-12 col-sm-3">
                <label for=""><?php echo dash($rec['DEFFENDANT_IDCARD']); ?></label><!--  -->
            </div>
        </div>
        <div class="row " class="col-md-12" style="margin-top: 15px;">
            <div class="col-xs-12 col-sm-3">
                <label for="">เรื่องที่</label>
            </div>
            <div class="col-xs-12 col-sm-3">
                <label for=""><?php echo dash($rec['SUBJECT']); ?></label><!--  -->
            </div>
        </div>
        <div class="row " class="col-md-12" style="margin-top: 15px;">
            <div class="col-xs-12 col-sm-3">
                <label for="">คดีล้มละลายหมายเลขคดีดำที่</label>
            </div>
            <div class="col-xs-12 col-sm-3">
                <label for=""><?php echo dash($rec['PREFIX_BLACK_CASE'] . $rec['BLACK_CASE'] . "/" . $rec['BLACK_YY']); ?></label><!--  -->
            </div>
            <div class="col-xs-12 col-sm-3">
                <label for="">คดีล้มละลายหมายเลขคดีแดงที่</label>
            </div>
            <div class="col-xs-12 col-sm-3">
                <label for=""><?php echo dash($rec['PREFIX_RED_CASE'] . $rec['RED_CASE'] . "/" . $rec['RED_YY']); ?></label><!--  -->
            </div>
        </div>
        <div class="row " class="col-md-12">
            <div class="col-xs-12 col-sm-3">
                <label for="">โดยโจทก์</label>
            </div>
            <div class="col-xs-12 col-sm-3">
                <label for=""><?php echo dash($rec['PLAINTIFF_NAME']); ?></label><!--  -->
            </div>
        </div>


        <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
            <tr>
                <td>
                    <div align='left'></div>วันที่พิทักษ์ทรัพย์ชั่วคราว
                    </div>
                </td>
                <td>
                    <div align='center'> <?php echo dash(DateCut($rec['DATE_TEMPORARY_A'])); ?></div><!--  -->
                </td>
                <td>
                    <div align='left'></div>วันประกาศราชกิจจาฯ
                    </div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['ANNOUNCEMENT_DATE_A'])); ?></div><!--  -->
                </td>
            </tr>
            <tr>
                <td>
                    <div align='left'></div>วันถอนพิทักษ์ทรัพย์ชั่วคราว
                    </div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['WITHDRAWAL_DATE_B'])); ?></div><!--  -->
                </td>
                <td>
                    <div align='left'></div>วันประกาศราชกิจจาฯ</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['ANNOUNCEMENT_DATE_B'])); ?></div><!--  -->
                </td>
            </tr>
            <tr>
                <td>
                    <div align='left'></div>*วันที่พิทักษ์ทรัพย์เด็ดขาด</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['ABSOLUT_RECEIVERSHIP_C'])); ?></div><!--  -->
                </td>
                <td>
                    <div align='left'></div>วันประกาศราชกิจจาฯ</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['ANNOUNCEMENT_DATE_C'])); ?></div><!--  -->
                </td>
            </tr>
            <tr>
                <td>
                    <div align='left'></div>*วันที่ครบกำหนดยื่นคำขอรับชำระหนี้</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['PAYMENT_DUE_DATE_D'])); ?></div><!--  -->
                </td>
                <td>
                    <div align='left'></div>นัดตรวจคำขอรับชำระหนี้</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['APPOINTMENT_DATE_D'])); ?></div><!--  -->
                </td>
            </tr>
            <tr>
                <td>
                    <div align='left'></div>วันถอนพิทักษ์ทรัพย์เด็ดขาด</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['ABSOLUTE_WITHDRAWAL_E'])); ?></div><!--  -->
                </td>
                <td>
                    <div align='left'></div>วันประกาศราชกิจจาฯ</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['ANNOUNCEMENT_DATE_E'])); ?></div><!--  -->
                </td>
            </tr>
            <tr>
                <td>
                    <div align='left'></div>วันประนอมหนี้ก่อนล้มละลาย</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['DEBT_RECONCILIATION_F'])); ?></div><!--  -->
                </td>
                <td>
                    <div align='left'></div>วันประกาศราชกิจจาฯ</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['ANNOUNCEMENT_DATE_F'])); ?></div><!--  -->
                </td>
            </tr>
            <tr>
                <td>
                    <div align='left'></div>วันยกเลิกประนอมหนี้ก่อนล้มฯและพิพากษาให้ล้มฯ</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['CANCEL_DEBT_G'])); ?></div><!--  -->
                </td>
                <td>
                    <div align='left'></div>วันประกาศราชกิจจาฯ</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['ANNOUNCEMENT_DATE_G'])); ?></div><!--  -->
                </td>
            </tr>
            <tr>
                <td>
                    <div align='left'></div>วันที่ครบกำหนดยื่นคำขอรับชำระหนี้</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['SUBMIT_DEBT_PAYMENT_H'])); ?></div><!--  -->
                </td>
                <td>
                    <div align='left'></div>นัดตรวจคำขอรับชำระหนี้</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['APPOINTMENT_DATE_H'])); ?></div><!--  -->
                </td>
            </tr>
            <tr>
                <td>
                    <div align='left'></div>วันพิพากษาให้ล้มละลาย</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['BANKRUPTCY_JUDGMENT_I'])); ?></div><!--  -->
                </td>
                <td>
                    <div align='left'></div>วันประกาศราชกิจจาฯ</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['ANNOUNCEMENT_DATE_I'])); ?></div><!--  -->
                </td>
            </tr>
            <tr>
                <td>
                    <div align='left'></div>วันประนอมหนี้หลังล้มละลาย</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['AFTER_BANKRUPTCY_J'])); ?></div><!--  -->
                </td>
                <td>
                    <div align='left'></div>วันประกาศราชกิจจาฯ</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['ANNOUNCEMENT_DATE_J'])); ?></div><!--  -->
                </td>
            </tr>
            <tr>
                <td>
                    <div align='left'></div>*วันยกเลิกประนอมหนี้หลังล้มฯและพิพากษาให้ล้มฯ</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['CANCEL_DEBT_BACK_K'])); ?></div><!--  -->
                </td>
                <td>
                    <div align='left'></div>วันประกาศราชกิจจาฯ</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['ANNOUNCEMENT_DATE_K'])); ?></div><!--  -->
                </td>
            </tr>
            <tr>
                <td>
                    <div align='left'></div>วันที่ครบกำหนดยื่นคำขอรับชำระหนี้</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['PAYMENT_DUE_L'])); ?></div><!--  -->
                </td>
                <td>
                    <div align='left'></div>นัดตรวจคำขอรับชำระหนี้</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['APPOINTMENT_DATE_L'])); ?></div><!--  -->
                </td>
            </tr>
            <tr>
                <td>
                    <div align='left'></div>วันยกเลิกการล้มละลาย</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['CANCEL_BANKRUPT_M'])); ?></div><!--  -->
                </td>
                <td>
                    <div align='left'></div>วันประกาศราชกิจจาฯ</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['ANNOUNCEMENT_DATE_M'])); ?></div><!--  -->
                </td>
            </tr>
            <tr>
                <td>
                    <div align='left'></div>วันปลดการล้มละลาย</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['BANKRUPT_DISCHARGE_N'])); ?></div><!--  -->
                </td>
                <td>
                    <div align='left'></div>วันประกาศราชกิจจาฯ</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['ANNOUNCEMENT_DATE_N'])); ?></div><!--  -->
                </td>
            </tr>
            <tr>
                <td>
                    <div align='left'></div>วันที่ศาลสั่งให้จัดการทรัพย์ย์มรดก</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['HERITAGE_O'])); ?></div><!--  -->
                </td>
                <td>
                    <div align='left'></div>วันยกเลิกจัดการทรัพย์มรดก</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['CANCEL_HERITANCE_O'])); ?></div><!--  -->
                </td>
            </tr>
            <tr>
                <td>
                    <div align='left'></div>วันพิจารณาคดีใหม่</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['RECONSIDER_P'])); ?></div><!--  -->
                </td>
                <td>
                    <div align='left'></div>วันที่ยกฟ้อง</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['DATE_OF_DISMISSAL_P'])); ?></div><!--  -->
                </td>
            </tr>
            <tr>
                <td>
                    <div align='left'></div>วันจำหน่ายคดี</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['SELLING_CASE_Q'])); ?></div><!--  -->
                </td>
                <td>
                    <div align='left'></div>วันปิดคดี</div>
                </td>
                <td>
                    <div align='center'><?php echo dash(DateCut($rec['CASE_CLOSING_DATE_Q'])); ?></div><!--  -->
                </td>
            </tr>
        </table>
    <?php
    }



    public static function btnHelp()
    {
        $sql = "SELECT DISTINCT a.CMD_SYS_ID ,a.CMD_TYPE_ID,b.CMD_GRP_NAME ,a.CMD_TYPE_NAME,a.ACTION,a.CMD_STATUS
		FROM M_SERVICE_CMD a 
		JOIN M_CMD_TYPE b ON a.CMD_TYPE_ID =b.CMD_TYPE_ID 
		WHERE a.CMD_STATUS ='1'
        AND a.CMD_SYS_ID IN ('1','2','3','4','5')
		ORDER BY a.CMD_SYS_ID ASC ,a.CMD_TYPE_ID ASC ";
        $query = db::query($sql);

    ?>
        <!-- Button trigger modal -->
        <div class="form-group row">
            <div class="col-md-12 wf-center" style="text-align: right;">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#BTN_HELP">HELP</button>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="BTN_HELP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">รายละเอียดคำสั่งเจ้าพนักงาน</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered sorted_table">
                                <tr>
                                    <th>ระบบงาน</th>
                                    <th>ประเภทกลุ่มคำสั่งเจ้าพนักงาน</th>
                                    <th>คำสั่งเจ้าพนักงาน</th>
                                    <th>การทำงาน</th>
                                </tr>

                                <?php
                                while ($rec = db::fetch_array($query)) {
                                ?>
                                    <tr>
                                        <td>
                                            <div><?php echo func::ConvertSystemToThai($rec['CMD_SYS_ID']); ?></div>
                                        </td>
                                        <td>
                                            <div><?php echo $rec['CMD_GRP_NAME']; ?></div>
                                        </td>
                                        <td>
                                            <div><?php echo $rec['CMD_TYPE_NAME']; ?></div>
                                        </td>
                                        <td>
                                            <div><?php echo $rec['ACTION']; ?></div>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}

/* java start */
?>
<script>
    function show_asset_detail(asset_id) {
        window.open("show_asset_detail.php?ASSET_ID=" + asset_id, "รายละเอียดทรัพย์", "width=800,height=700");
    }
</script>
<?php
/* java stop */
/* function กลาง start */
//print_r_pre($_POST);
//print_r_pre($page_size);
function get_top($sql = "", $page = "", $page_size = "")
{
    $P = $page_size - 1;
    $offset = ($page * $page_size) - $P;
    $limit = $page * $page_size;
    return $sql_limit = 'select * from ( select AAAA.*, rownum rnum from ( ' . $sql . ' ) AAAA ) where rnum between ' . $offset . ' and ' . $limit . ' ';
}

function bracket($A = "")
{
    if ($A != "") {
        return "(" . $A . ")";
    }
}

/* function กลาง stop */

function CONCERN_NUMBER($A = "")
{
    $text = "";
    if ($A == "ผู้ถือกรรมสิทธิ์" || $A == "ผู้ถือกรรมสิทธิ์") {
        $text = " ที่ ";
    } else {
        $text = " รายที่ ";
    }
    return $text;
}

function add_concern($data)
{
    if ($data == 'โจทก์') {
        return "โจทก์/เจ้าหนี้";
    }
}
function link_SUB($WFR, $TYPE_OPEN, $A)
{
?>
    <a href="http://103.208.27.224/led_revive/workflow/workflow_view_service.php?W=288&WFR=<?PHP echo $WFR; ?>&TYPE_OPEN=<?PHP echo $A; ?>&WFD=1654&REVIVE_59=3" class="link-button">
        <?php echo $TYPE_OPEN; ?>
    </a>
    <?php
}

function getLinkRevive($TYPE_OPEN, $WFR)
{

    $TYPE_OPEN_NUM = "";
    if ($TYPE_OPEN == "ผู้บริหารชั่วคราว") { //1
        $TYPE_OPEN_NUM = "1";
        return link_SUB($WFR, $TYPE_OPEN, $TYPE_OPEN_NUM);
    } else if ($TYPE_OPEN == "ผู้บริหารแผนชั่วคราว") { //2
        $TYPE_OPEN_NUM = "2";
        return link_SUB($WFR, $TYPE_OPEN, $TYPE_OPEN_NUM);
    } else if ($TYPE_OPEN == "เจ้าหนี้") { //3
        $TYPE_OPEN_NUM = "3";
        return link_SUB($WFR,  $TYPE_OPEN, $TYPE_OPEN_NUM);
    } else if ($TYPE_OPEN == "ผู้ทำแผน") { //9
        $TYPE_OPEN_NUM = "9";
        return link_SUB($WFR,  $TYPE_OPEN, $TYPE_OPEN_NUM);
    } else if ($TYPE_OPEN == "ผู้บริหารแผน") { //10
        $TYPE_OPEN_NUM = "10";
        return link_SUB($WFR, $TYPE_OPEN, $TYPE_OPEN_NUM);
    } else if ($TYPE_OPEN == "ผู้ร้องขอ") { //11
        $TYPE_OPEN_NUM = "11";
        return link_SUB($WFR, $TYPE_OPEN, $TYPE_OPEN_NUM);
    } else {
    ?>
        <label for=""><?php echo $TYPE_OPEN; ?></label>
    <?php
    }
    ?>
<?php

}

function show_person_table( //บุคคลในคดี
    $WH_ID,
    $IDCARD,
    $SYSTEM_TYPE,
    $WFR
) {
    $fill = "";

    if ($WH_ID != "") {
        $fill .= " AND TB.WH_ID ='" . $WH_ID . "'";
    }
    if ($IDCARD != "") {
        $fill_case = "WHEN TB.REGISTER_CODE IN (" . result_array($IDCARD) . ") THEN 1";
        $hilightIDCARD = explode(",", $IDCARD);
    }

    if ($SYSTEM_TYPE == '1') {
        $SYSTEM_TYPE = 'Civil';
        $fill .= "AND TB.SYSTEM_TYPE ='Civil'";
    } elseif ($SYSTEM_TYPE == '2') {
        $SYSTEM_TYPE = 'Bankrupt';
        $fill .= "AND TB.SYSTEM_TYPE ='Bankrupt'";
    } elseif ($SYSTEM_TYPE == '3') {
        $SYSTEM_TYPE = 'Revive';
        $fill .= "AND TB.SYSTEM_TYPE ='Revive'";
    } elseif ($SYSTEM_TYPE == '4') {
        $SYSTEM_TYPE = 'Mediate';
        $fill .= "AND TB.SYSTEM_TYPE ='Mediate'";
    }
    $sql_viwe_all = "
    SELECT 
    TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
    TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
    TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
    TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
    TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
    TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
    TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME 
    FROM VIEW_WH_ALL_CASE_PERSON TB 
    WHERE 1=1 
    {$fill}
    GROUP BY TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
    TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
    TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
    TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
    TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
    TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
    TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME 
    ORDER BY 
    CASE
        {$fill_case}
        WHEN TB.CONCERN_NAME = 'โจทก์' THEN 2
        WHEN TB.CONCERN_NAME = 'จำเลย' THEN 3
        ELSE 4
    END,TO_NUMBER(TB.CONCERN_NO) ASC ,
	TB.CONCERN_NAME DESC 
    ";

    $fill = "";
    //echo $sql_viwe_all;

    //$query_viwe_all = db::query($sql_viwe_all);
    //$num_viwe_all = db::num_rows($query_viwe_all);

    global $page2, $page_size2;
    //echo get_top($sql_viwe_all, $page2, $page_size2);
    $query_viwe_all = db::query(get_top($sql_viwe_all, $page2, $page_size2));
    $query = db::query($sql_viwe_all);
    $array_concern = array();
    while ($rec = db::fetch_array($query)) {
        $array_concern[$rec['CONCERN_NAME']] += 1;
    }
    function check_P($sql, $concern = "")
    {
        if ($concern == 'โจทก์' || $concern == 'จำเลย') {
            $query = db::query($sql);
            $array_concern = array();
            while ($rec = db::fetch_array($query)) {
                $array_concern[$rec['CONCERN_NAME']] += 1;
            }
            return $array_concern[$concern];
        }
        return '0';
    }
    $total_viwe_all = db::num_rows(db::query($sql_viwe_all));
?>
    <div class="card text-white mb-3 " style="max-width:100%;margin: 15px 0px 15px 0px">
        <div class="card-header" style="padding: 10px 10px 10px 10px;background-color: #A8164E ;">
            <h4 style="color: #fff;">บุคคลที่เกี่ยวข้อง</h4>
        </div>
        <div class="card-body" style="padding: 10px 10px 10px 10px;">
            <div class="row" style="margin:10px 5px 10px 5px;">
                <div class="table-responsive">
                    <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                        <thead class="bg-primary">
                            <th style="background-color: #dc3545;color: white;" class="text-center">ลำดับ</th>
                            <th style="background-color: #dc3545;color: white;" class="text-center">สถานะ</th>
                            <th style="background-color: #dc3545;color: white;" class="text-center">ชื่อ-สกุล</th>
                            <th style="background-color: #dc3545;color: white;" class="text-center">เลขทะเบียนนิติบุคคล/เลขบัตรประชาชน</th>
                        </thead>

                        <?php
                        // if ($num_viwe_all > 0) {
                        if ($total_viwe_all > 0) {
                            $a_viwe_all = 0;
                            while ($rec_viwe_all = db::fetch_array($query_viwe_all)) {
                                $a_viwe_all++;
                                if (!empty($hilightIDCARD)) {
                                    if (in_array($rec_viwe_all['REGISTER_CODE'], $hilightIDCARD)) {
                                        $background = "#e6ee9c";
                                    } else {
                                        $background = "#fff";
                                    }
                                }
                        ?>
                                <tr style="background-color:<?php echo  $background; ?>;">
                                    <div>

                                        <td>
                                            <div align='center'><?php echo $a_viwe_all; ?></div>
                                        </td>
                                        <?php
                                        /*  $text = $rec_viwe_all['CONCERN_NO'] != "" ? CONCERN_NUMBER($rec_viwe_all['CONCERN_NAME']) . (check_P($sql_viwe_all, $rec_viwe_all['CONCERN_NO']) == '1' ? "" : $rec_viwe_all['CONCERN_NO']) : ""; */

                                        $text =  (check_P($sql_viwe_all, $rec_viwe_all['CONCERN_NAME']) == '1' ? "" : ($rec_viwe_all['CONCERN_NO'] != '' ? ((CONCERN_NUMBER($rec_viwe_all['CONCERN_NAME']) . $rec_viwe_all['CONCERN_NO'])) : ''));
                                        ?>
                                        <td>
                                            <div align='center'><?php /* echo ($rec_viwe_all['SYSTEM_TYPE'] == 'Revive' ? getLinkRevive(($rec_viwe_all['CONCERN_NAME']), $WFR) : $rec_viwe_all['CONCERN_NAME']) . bracket($text); */
                                                                if ($rec_viwe_all['SYSTEM_TYPE'] == 'Revive') { //ฟื้นฟู
                                                                    echo getLinkRevive(($rec_viwe_all['CONCERN_NAME']), $WFR);
                                                                } else if ($rec_viwe_all['SYSTEM_TYPE'] == 'Bankrupt') { //ล้มละลาย
                                                                    /* echo "CONCERN_NAME".$rec_viwe_all['CONCERN_NAME']."<br>";
                                                        echo "WH_ID".$WH_ID."<br>";
                                                        echo "REGISTER_CODE".$rec_viwe_all['REGISTER_CODE']."<br>"; */
                                                                    echo addStatusBankrupt($rec_viwe_all['CONCERN_NAME'], $WH_ID, $rec_viwe_all['REGISTER_CODE']);
                                                                } else {
                                                                    echo $rec_viwe_all['CONCERN_NAME'];
                                                                }
                                                                echo bracket($text);
                                                                ?></div>
                                        </td>
                                        <td><?php echo $rec_viwe_all['PREFIX_NAME'] . " " . $rec_viwe_all['FIRST_NAME'] . " " . $rec_viwe_all['LAST_NAME']    ?></td>
                                        <?php /* print_pre($rec_viwe_all); */ ?>
                                        <td>
                                            <?php if (substr($rec_viwe_all['REGISTER_CODE'], 0, 1) == '0') { //ขึ้นต้นด้วย 0 นิติบุคคล
                                            ?>
                                                <a href="#" data-toggle="modal" data-target="#exampleModalLong" onclick="openModal_DBD('<?php echo $rec_viwe_all['REGISTER_CODE']; ?>');"><?php echo $rec_viwe_all['REGISTER_CODE']; ?></a>
                                            <?php
                                            } else {
                                            ?><!-- data-target="#openModal_Person" -->
                                                <a href="#" data-toggle="modal" data-target="#" onclick="openModal_Person('<?php echo $rec_viwe_all['REGISTER_CODE']; ?>');"><?php echo $rec_viwe_all['REGISTER_CODE']; ?></a>
                                            <?php
                                            }
                                            ?>


                                        </td>
                                    </div>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <td colspan="4">
                                <div align='center'>ไม่พบข้อมูล</div>
                            </td>
                        <?php
                        }
                        ?>
                    </table>
                </div>
                <div class="row">
                    <!-- <?php echo @(ceil($total_viwe_all / $page_size2) > 1) ? endPaging2("frm-input", $total_viwe_all) : ""; ?> -->
                    <?php echo endPaging2("frm-input", $total_viwe_all) ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    /* } */
    ?>


    <script>
        function openModal_Person(IDCARD) { // ตรวจทะเบียนราฏษร์
            if ($('#tkey').val() == '') {
                $.ajax({
                    url: "http://127.0.0.1:8001/api/LinkageLogin/00145",
                    async: false,
                    method: 'GET',
                    success: function(data) {
                        response_data = data
                        response_data.data = JSON.parse((data.raw + '').replace(/\0/g, ''))
                        delete data.raw
                        $('[id^=tkey]').val(response_data.data.tkey);
                        if (response_data.data.tkey != '') {
                            $('#bt_smartcacd_reader2').html('อ่านบัตรประชาชน');
                        } else {
                            alert('กรุณา LOGIN ฐานทะเบียนราษฎร์ก่อน');
                            return false;
                        }
                    },
                    error: function() {
                        alert('ไม่สามารถเชื่อม Linkage ได้')
                    }
                });
            } else {
                if (IDCARD == '') {
                    alert('กรุณาระบุ เลขบัตรประชาชน');
                    $('#s_idcard').focus();
                    return false;
                }
                $('#bt_smartcacd_reader2').html('อ่านบัตรประชาชน');
                $.get("http://127.0.0.1:8001/api/GetProfile/" + $('#tkey').val() + "/" + IDCARD,
                    function(data) {
                        var json_show = JSON.parse(data.raw);
                        console.log(json_show)
                    });
            }
            $.ajax({
                type: "POST",
                url: "../public/search_data_process_A.php",
                data: {
                    proc: 'IDCARD',
                    IDCARD: IDCARD
                },
                cache: false,
                success: function(data) {
                    const result = JSON.parse(data)
                    console.log(result)
                }
            });
        }

        function openModal_DBD(IDCARD) {
            const url = "http://103.40.146.73/JuristicByDBD.php/JuristicById";
            $('#S_DBD').hide("");
            $('#A_DBD').hide("");
            $('#juristicNameTh').text("");
            $('#juristicStatus').text("");
            $('#juristicType').text("");
            $("#juristicOldID").text("");
            $('#registerDate').text("");
            $('#registerCapital').text("");
            $('#juristicFullAddress').text("");
            $('#juristicDescription').text("");
            $('#juristicCommittee').html("");
            $.ajax({
                type: "POST",
                url: "../public/search_data_process_A.php",
                data: {
                    proc: 'DBD',
                    IDCARD: IDCARD,
                    url: url
                },
                cache: false,
                success: function(data) {
                    const result = JSON.parse(data)
                    console.log(result)
                    if (result['status'] == 'SUCCESS') {
                        $('#S_DBD').show("");
                        $('#A_DBD').hide("");
                        var address = result.juristicFullAddress;
                        var tumb = result.juristicTumbol;
                        var amp = result.juristicAmpur;
                        var prov = result.juristicProvince;
                        var date = result.registerDate;
                        var y = date.substring(0, 4);
                        var m = date.substring(4, 6);
                        var d = date.substring(6, 8);
                        // var board = result.addressInformation[0].juristicCommittee;
                        $('#juristicNameTh').text(result.juristicNameTh);
                        $('#juristicStatus').text(result.juristicStatus);
                        $('#juristicType').text(result.juristicType);
                        $("#juristicOldID").text(result.juristicOldID);
                        $('#registerDate').text(d + '-' + m + '-' + y);
                        var formattedNumber = new Intl.NumberFormat('en-US', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }).format(parseFloat(result.registerCapital));
                        $('#registerCapital').text(formattedNumber);

                        //$('#registerCapital').text(new Intl.NumberFormat().format(parseFloat(result.registerCapital)));
                        $('#juristicFullAddress').text(address + ' ' + tumb + ' ' + amp + ' ' + prov);
                        $('#juristicDescription').text(result.juristicDescription);
                        $('#juristicCommittee').html(result.board);
                    } else {
                        //hide();
                        $('#S_DBD').hide("");
                        $('#A_DBD').show("");
                        $('#juristicNameTh').text("");
                        $('#juristicStatus').text("");
                        $('#juristicType').text("");
                        $("#juristicOldID").text("");
                        $('#registerDate').text("");
                        $('#registerCapital').text("");
                        $('#juristicFullAddress').text("");
                        $('#juristicDescription').text("");
                        $('#juristicCommittee').html("");
                        $('#exampleModalLong').show("");
                    }
                }
            });
        }
    </script>

    <!-- Modal -->

    <div class="modal fade" id="openModal_Person" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="./search_data_show_detial2.php" enctype="multipart/form-data" id="frm-modal" name='frm-modal'>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">รายละเอียดตามทะเบียนราฏร์</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="openModal_Person-modal-body"><!-- เพิ่มเนื้อหาตามต้องการ -->

                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- modal stop -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">ตรวจสอบหมายเลขนิติบุคคล</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id='A_DBD'>
                    <div class="form-group row">
                        <div class="col-md-12 ">
                            <div align="center"><label class="">-----ไม่พบข้อมูล-----</label></div>
                        </div>
                    </div>
                </div>
                <div class="modal-body" id='S_DBD'>
                    <div class="form-group row">
                        <div class="col-md-2 ">
                            <label class="f-bold  wf-right">ชื่อ :</label>
                        </div>
                        <div class="col-md-3 wf-left">
                            <label class="label bg-primary" id="juristicNameTh"></label>
                        </div>
                        <div class="col-md-2 ">
                            <label class="f-bold  wf-right">ประเภทนิติบุคคล :</label>
                        </div>
                        <div class="col-md-3 wf-left">
                            <label class="label bg-primary" id="juristicType"></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2 ">
                            <label class="f-bold  wf-right">โทรศัพท์ :</label>
                        </div>
                        <div class="col-md-3 wf-left">
                            <label class="label bg-primary" id="juristicPhone"></label>
                        </div>
                        <div class="col-md-2 ">
                            <label class="f-bold  wf-right">สถานะนิติบุคคล :</label>
                        </div>
                        <div class="col-md-3 wf-left">
                            <label class="label bg-primary" id="juristicStatus"></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2 ">
                            <label class="f-bold  wf-right">โทรสาร :</label>
                        </div>
                        <div class="col-md-3 wf-left">
                            <label class="label bg-primary"></label>
                        </div>
                        <div class="col-md-2 ">
                            <label class="f-bold  wf-right">วันที่จดทะเบียนจัดตั้ง :</label>
                        </div>
                        <div class="col-md-3 wf-left">
                            <label class="label bg-primary" id="registerDate"></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2 ">
                            <label class="f-bold  wf-right">Website :</label>
                        </div>
                        <div class="col-md-3 wf-left">
                            <label class="label bg-primary"></label>
                        </div>
                        <div class="col-md-2 ">
                            <label class="f-bold  wf-right">ทุนจดทะเบียน :</label>
                        </div>
                        <div class="col-md-2 wf-left">
                            <label class="label bg-primary" id="registerCapital"></label>
                        </div>
                        <div class="col-md-1 wf-left">
                            <label class="f-bold  wf-right">บาท </label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2 "><label class="f-bold  wf-right">E-mail :</label></div>
                        <div class="col-md-3 wf-left"><label class="label bg-primary" id="juristicEmail"></label></div>
                        <div class="col-md-2 "><label class="f-bold  wf-right">เลขทะเบียนเดิม :</label></div>
                        <div class="col-md-3 wf-left"><label class="label bg-primary" id="juristicOldID"></label></div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2 "><label class="f-bold  wf-right">ปีที่ส่งงบการเงิน :</label></div>
                        <div class="col-md-3 wf-left"><label class="label bg-primary"></label></div>
                        <div class="col-md-2 ">
                            <label class="f-bold  wf-right">งบการเงิน :</label>
                        </div>
                        <div class="col-md-3 wf-left">
                            <label class="label bg-primary"></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2 ">
                            <label class="f-bold  wf-right">ที่ตั้ง :</label>
                        </div>
                        <div class="col-md-10 wf-left">
                            <label class="label bg-primary" id="juristicFullAddress"></label>
                        </div>
                    </div>
                    <!--   <div class="form-group row">
                        <div class="col-md-2"><label class="f-bold  wf-right">กรรมการผู้จัดการ :</label></div>
                        <div class="col-md-10 wf-left"><label class="label bg-primary" id="juristicCommittee"></label></div>
                    </div> -->
                    <div class="form-group row">
                        <div class="col-md-2"><label class="f-bold  wf-right">กรรมการลงชื่อผูกพัน :</label></div>
                        <div class="col-md-10 wf-left"><label class="label bg-primary" id="juristicDescription"></label></div>
                    </div>
                </div>
                <div id="juristicCommittee"></div><!-- ชื่อคณะกรรมการ -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!--    <button type="button" class="btn btn-primary" onclick="saveChanges()">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>

<?php
}

function show_table_ROUTE( //ทางเดินสำนวน ของเเพ่ง
    $PREFIX_BLACK_CASE = '',
    $BLACK_CASE = '',
    $BLACK_YY = '',
    $PREFIX_RED_CASE = '',
    $RED_CASE = '',
    $RED_YY = '',
    $COURT_CODE = ''
) {
    global $page, $page_size;

    $fill = "";
    if ($PREFIX_BLACK_CASE != "") {
        $fill .= " AND a.PREFIX_BLACK_CASE LIKE '%" . $PREFIX_BLACK_CASE . "%'";
    }
    if ($BLACK_CASE != "") {
        $fill .= " AND a.BLACK_CASE ='" . $BLACK_CASE . "'";
    }
    if ($BLACK_YY != "") {
        $fill .= "AND a.BLACK_YY ='" . $BLACK_YY . "'";
    }
    if ($PREFIX_RED_CASE != "") {
        $fill .= "AND a.PREFIX_RED_CASE LIKE '%" . $PREFIX_RED_CASE . "%'";
    }
    if ($RED_CASE != "") {
        $fill .= "AND a.RED_CASE ='" . $RED_CASE . "'";
    }
    if ($RED_YY != "") {
        $fill .= "  AND a.RED_YY ='" . $RED_YY . "'";
    }

    $SQL_ROUTE = "SELECT *
    FROM WH_CIVIL_CASE a 
    JOIN WH_CIVIL_DOSS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
    WHERE 1=1{$fill}
    AND a.COURT_CODE ='" . $COURT_CODE . "'
    ORDER BY b.DOSS_CONTROL_GEN ASC";

    /*  a.WH_ROUTE_ID ASC, */
    //echo $SQL_ROUTE;
    $queryROUTE = db::query(get_top($SQL_ROUTE, $page, $page_size));

    $total_ROUTE = db::num_rows(db::query($SQL_ROUTE));
    $fill = "";
?>

    <div class="row" class="col-md-12" style="margin: 10px 10px 10px 10px;">
        <div class="table-responsive">
            <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                <thead class="thead-dark">
                    <tr>
                        <th style="background-color: #dc3545;color: white;">ลำดับ</th>
                        <th style="background-color: #dc3545;color: white;">สำนักงาน</th>

                    </tr>
                </thead>
                <?php
                if ($total_ROUTE > 0) {
                    $n_ROUTE = 0;
                    while ($recROUTE = db::fetch_array($queryROUTE)) {
                        $n_ROUTE++;
                ?>
                        <tr style="background-color: #E6E6FA;">
                            <td>
                                <div align='center'><?php echo $n_ROUTE; ?></div>
                            </td>
                            <td>
                                <div><?php echo $recROUTE['DOSS_DEPT_NAME'] . "(" . $recROUTE['DOSS_CONTROL'] . ")"; ?><span class="show_hide_area" style="cursor:pointer;" id="arr_<?php echo $recROUTE['DOSS_DEPT_CODE']; ?>_<?php echo $n_ROUTE; ?>"> </span></div>
                            </td>
                        </tr>
                        <tr id="<?php echo $recROUTE['DOSS_DEPT_CODE']; ?>_<?php echo $n_ROUTE; ?>">
                            <td id="td<?php echo $recROUTE['DOSS_DEPT_CODE']; ?>_<?php echo $n_ROUTE; ?>" colspan="8">
                                <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th style="background-color: #d9adb2;color: white;">ลำดับ</th>
                                            <th style="background-color: #d9adb2;color: white;">วันที่ดำเนินการ</th>
                                            <th style="background-color: #d9adb2;color: white;">เวลา</th>
                                            <th style="background-color: #d9adb2;color: white;">รายการ</th>
                                        </tr>
                                    </thead>

                                    <?php
                                    $n_R = 0;
                                    $sql_R = "SELECT a.CIVIL_CODE  ,b.DOSS_DEPT_CODE ,b.DOSS_DEPT_NAME ,c.ACT_DESC ,c.CREATE_DATE,c.CREATE_TIME  ,c.ACT_DESC
                                        FROM WH_CIVIL_CASE a 
                                        JOIN WH_CIVIL_DOSS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
                                        INNER JOIN WH_CIVIL_ROUTE c ON b.DOSS_CONTROL_GEN = c.DOSS_CONTROL_GEN
                                        WHERE 1=1
                                        AND a.CIVIL_CODE ='" . $recROUTE['CIVIL_CODE'] . "' 
                                        AND b.DOSS_DEPT_CODE ='" . $recROUTE['DOSS_DEPT_CODE'] . "'
                                        AND b.DOSS_CONTROL_GEN ='" . $recROUTE['DOSS_CONTROL_GEN'] . "'
                                        ORDER BY  c.CREATE_DATE ASC,(c.CREATE_TIME) ASC ";
                                    //echo $sql_R."<br>";
                                    $queryR = db::query($sql_R);
                                    while ($recR = db::fetch_array($queryR)) {
                                        $n_R++;
                                    ?>
                                        <tr style="background-color: #f0f0f5;">
                                            <td>
                                                <div align='center'><?php echo $n_R; ?></div>
                                            </td>
                                            <td>
                                                <div><?php echo $recR['CREATE_DATE']; ?></div>
                                            </td>
                                            <td>
                                                <div><?php echo $recR['CREATE_TIME']; ?></div>
                                            </td>
                                            <td>
                                                <div><?php echo $recR['ACT_DESC']; ?></div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </td>
                        </tr>
                        <script>
                            if ($('#td<?php echo $recROUTE['DOSS_DEPT_CODE']; ?>_<?php echo $n_ROUTE; ?>').html() == '<table class="table"></table>') {
                                $('#<?php echo $recROUTE['DOSS_DEPT_CODE']; ?>_<?php echo $n_ROUTE; ?>').hide();
                            } else {
                                $('#<?php echo $recROUTE['DOSS_DEPT_CODE']; ?>_<?php echo $n_ROUTE; ?>').hide();
                                $('#arr_<?php echo $recROUTE['DOSS_DEPT_CODE']; ?>_<?php echo $n_ROUTE; ?>').show();
                            }
                            $('#arr_<?php echo $recROUTE['DOSS_DEPT_CODE']; ?>_<?php echo $n_ROUTE; ?>').click(function() {
                                $(this).toggleClass('is-active');
                                $("#<?php echo $recROUTE['DOSS_DEPT_CODE']; ?>_<?php echo $n_ROUTE; ?>").slideToggle();
                            });
                        </script>

                    <?php
                    }
                    ?>
            </table>
        <?php
                } else {
        ?>
            <tr>
                <td colspan="3">
                    <div align='center'>ไม่พบข้อมูล</div>
                </td>
            </tr>
        <?php
                }
        ?>
        </table>
        </div>
    </div>
    <div class="row">
        <?php echo @(ceil($total_ROUTE / $page_size) > 1) ? endPaging("frm-input", $total_ROUTE) : ""; ?>
    </div>
    <?php
}

class tab
{
    public static function TabUiMain($arr_system)
    {
    ?>
        <style>
            /* Add your custom styles here */
            /* Optional: You can style the tabs and panes according to your preference */
            .nav-tabs {
                border-bottom: 1px solid #ddd;
                margin-bottom: 15px;
            }

            .nav-tabs li {
                display: inline-block;
                margin-bottom: -1px;
            }

            .nav-tabs li a {
                margin-right: 2px;
                line-height: 1.42857143;
                border: 1px solid transparent;
                border-radius: 4px 4px 0 0;
                padding: 10px;
                text-decoration: none;
                color: #333;
                background-color: #eee;
                display: inline-block;
            }

            .nav-tabs li a:hover {
                background-color: #ddd;
            }

            .tab-pane {
                display: none;
                padding: 20px;
            }

            .tab-pane.active {
                display: block;
            }
        </style>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <?php
            $k = 0;
            foreach ($arr_system as $sys => $sys_name) {
                $k++;
            ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($k == 1) ? 'active' : ''; ?>" href="#<?php echo $sys; ?>" onclick="showTab(event, '<?php echo $sys; ?>')"><?php echo $sys_name; ?> </a>
                </li>
            <?php
            }
            ?>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <?php
            $k = 0;
            foreach ($arr_system as $sys => $sys_name) {
                $k++;
            ?>
                <div class="tab-pane <?php echo ($k == 1) ? 'active' : ''; ?>" id="<?php echo $sys; ?>">
                    <!-- Content of <?php echo $sys_name; ?> tab -->
                    <label for="<?php echo $sys; ?>" style="color: #A8164E; font-weight: bold;">
                        <h6><?php echo $sys_name; ?></h6>
                    </label>
                </div>
            <?php
            }
            ?>
        </div>
        <script>
            function showTab(event, tabId) {
                event.preventDefault();

                // Hide all tabs
                var tabs = document.querySelectorAll('.tab-pane');
                tabs.forEach(function(tab) {
                    tab.classList.remove('active');
                });

                // Show the selected tab
                var selectedTab = document.getElementById(tabId);
                selectedTab.classList.add('active');

                // Remove 'active' class from all tabs
                var tabLinks = document.querySelectorAll('.nav-tabs li a');
                tabLinks.forEach(function(link) {
                    link.classList.remove('active');
                });

                // Add 'active' class to the clicked tab link
                var clickedTabLink = document.querySelector('.nav-tabs li a[href="#' + tabId + '"]');
                clickedTabLink.classList.add('active');

                var clickedTabLink = document.querySelector('.nav-tabs li a[href="#' + tabId + '"]');
                clickedTabLink.classList.add('active');
            }
        </script>
    <?php
    }
    public static function TabCss()
    {
    ?>
        <style>
            .nav-tabs {
                border-bottom: 1px solid #ddd;
                margin-bottom: 15px;
            }

            .nav-tabs li {
                display: inline-block;
                margin-bottom: -1px;
            }

            .nav-tabs li a {
                margin-right: 2px;
                line-height: 1.42857143;
                border: 1px solid transparent;
                border-radius: 4px 4px 0 0;
                padding: 10px;
                text-decoration: none;
                color: #333;
                background-color: #eee;
                display: inline-block;
            }

            .nav-tabs li a:hover {
                background-color: #ddd;
            }

            .tab-pane {
                display: none;
                padding: 20px;
            }

            .tab-pane.active {
                display: block;
            }
        </style>
    <?php
    }
    public static function TabUiSub($array, $array_total)
    {
        //style
        self::TabCss();
    ?>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <?php
            $k = 0;
            foreach ($array as $sys => $sys_name) {
                $k++;
            ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($k == 1) ? 'active' : ''; ?>" href="#<?php echo $sys; ?>" onclick="showTab(event, '<?php echo $sys; ?>')"><?php echo $sys_name; ?> <?php echo $array_total[$sys] == 0 ? "" : '<label class="badge bg-danger">' . $array_total[$sys] . '</label>'; ?></a>
                </li>
            <?php
            }
            ?>
        </ul>
    <?php
    }
    public static function TabScript()
    {
    ?>
        <script>
            function showTab(event, tabId) {
                event.preventDefault();
                // Hide all tabs
                var tabs = document.querySelectorAll('.tab-pane');
                tabs.forEach(function(tab) {
                    tab.classList.remove('active');
                });

                // Show the selected tab
                var selectedTab = document.getElementById(tabId);
                selectedTab.classList.add('active');

                // Remove 'active' class from all tabs
                var tabLinks = document.querySelectorAll('.nav-tabs li a');
                tabLinks.forEach(function(link) {
                    link.classList.remove('active');
                });
                // Add 'active' class to the clicked tab link
                var clickedTabLink = document.querySelector('.nav-tabs li a[href="#' + tabId + '"]');
                clickedTabLink.classList.add('active');

                var clickedTabLink = document.querySelector('.nav-tabs li a[href="#' + tabId + '"]');
                clickedTabLink.classList.add('active');
            }
        </script>
    <?php
    }

    public static function TabUi($array)
    {
        self::TabUiMain($array);
    }
    public static function NotInformation($cospan)
    {
    ?>
        <tr>
            <td colspan="<?php echo $cospan; ?>">
                <div align='center'>ไม่พบข้อมูล</div>
            </td>
        </tr>
    <?php
    }
}


function exTabUi() //ตัวอย่างการใช้ Tab Nav bar 
{
    $arr_system = array(
        "101" => "รายการยึด",
        "102" => "รายการอายัด",
        "104" => "รายการขับไล่",
        "105" => "รายการรื้อถอน"
    );
    $array_total = array( //จำนวนของmenu
        "101" => "7",
        "102" => "2",
        "104" => "3",
        "105" => "4"
    );
    tab::TabUiSub($arr_system, $array_total);
    ?>
    <!-- start -->
    <!-- Tab panes -->
    <div class="tab-content">
        <?php
        $k = 0;
        foreach ($arr_system as $sys => $sys_name) {
            $k++;
        ?>
            <div class="tab-pane <?php echo ($k == 1) ? 'active' : ''; ?>" id="<?php echo $sys; ?>">
                <!-- Content of <?php echo $sys_name; ?> tab -->
                <label for="<?php echo $sys; ?>" style="color: #A8164E; font-weight: bold;">
                    <h6><?php echo $sys_name; ?></h6>
                </label>
            </div>
        <?php
        }
        ?>
    </div>
    <?php
    tab::TabScript();
    ?>
    <!-- stop -->
<?php
}

function tableRouteAsset( //ทางเดินสำนวน ของเเพ่ง
    $PREFIX_BLACK_CASE = '',
    $BLACK_CASE = '',
    $BLACK_YY = '',
    $PREFIX_RED_CASE = '',
    $RED_CASE = '',
    $RED_YY = '',
    $COURT_CODE = ''
) {
    global $page, $page_size;

    $fill = "";
    if ($PREFIX_BLACK_CASE != "") {
        $fill .= " AND a.PREFIX_BLACK_CASE LIKE '%" . $PREFIX_BLACK_CASE . "%'";
    }
    if ($BLACK_CASE != "") {
        $fill .= " AND a.BLACK_CASE ='" . $BLACK_CASE . "'";
    }
    if ($BLACK_YY != "") {
        $fill .= "AND a.BLACK_YY ='" . $BLACK_YY . "'";
    }
    if ($PREFIX_RED_CASE != "") {
        $fill .= "AND a.PREFIX_RED_CASE LIKE '%" . $PREFIX_RED_CASE . "%'";
    }
    if ($RED_CASE != "") {
        $fill .= "AND a.RED_CASE ='" . $RED_CASE . "'";
    }
    if ($RED_YY != "") {
        $fill .= "  AND a.RED_YY ='" . $RED_YY . "'";
    }
    $arr_system = array(
        "101" => "รายการยึด",
        "102" => "รายการอายัด",
        "104" => "รายการขับไล่",
        "105" => "รายการรื้อถอน"
    );
    foreach ($arr_system as $sys => $sys_name) {
        $n = 0;
        $sql = "SELECT *
                FROM WH_CIVIL_CASE a 
                JOIN WH_CIVIL_DOSS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
                WHERE 1=1{$fill}
                AND a.COURT_CODE ='" . $COURT_CODE . "'
                AND b.DOSS_CODE='" . $sys . "'
                ORDER BY b.DOSS_CONTROL_GEN ASC";
        $n = db::num_rows(db::query($sql));
        $array_total[$sys] = empty($n) ? 0 : $n;
    }
?>
    <div class="card text-white mb-3 " style="max-width:100%;margin: 15px 0px 15px 0px">
        <div class="card-header" style="padding: 10px 10px 10px 10px;background-color: #A8164E ;">
            <h4 style="color: #fff;">ทางเดินสำนวน</h4>
        </div>
        <div class="card-body" style="padding: 10px 10px 10px 10px;">
            <div class="row" style="margin:10px 5px 10px 5px;"><?php
                                                                tab::TabUiSub($arr_system, $array_total);
                                                                ?>
                <!-- start -->
                <!-- Tab panes -->
                <div class="tab-content">
                    <?php
                    $k = 0;
                    foreach ($arr_system as $sys => $sys_name) {
                        $k++;
                    ?>
                        <div class="tab-pane <?php echo ($k == 1) ? 'active' : ''; ?>" id="<?php echo $sys; ?>">
                            <!-- Content of <?php echo $sys_name; ?> tab -->
                            <label for="<?php echo $sys; ?>" style="color: #A8164E; font-weight: bold;">
                                <h6><?php echo $sys_name; ?></h6>
                            </label>
                            <!-- content start -->
                            <?php

                            $SQL_ROUTE = "SELECT *
                                FROM WH_CIVIL_CASE a 
                                JOIN WH_CIVIL_DOSS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
                                WHERE 1=1{$fill}
                                AND a.COURT_CODE ='" . $COURT_CODE . "'
                                AND b.DOSS_CODE='" . $sys . "'
                                ORDER BY b.DOSS_CONTROL_GEN ASC";
                            $queryROUTE = db::query($SQL_ROUTE);
                            //echo $SQL_ROUTE;
                            $total_ROUTE = db::num_rows(db::query($SQL_ROUTE));
                            ?>
                            <div class="row" class="col-md-12" style="margin: 10px 10px 10px 10px;">
                                <div class="table-responsive">
                                    <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th style="background-color: #dc3545;color: white;">ลำดับ</th>
                                                <th style="background-color: #dc3545;color: white;">สำนักงาน</th>
                                                <th style="background-color: #dc3545;color: white;">รายละเอียด</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        if ($total_ROUTE > 0) {
                                            $n_ROUTE = 0;
                                            while ($recROUTE = db::fetch_array($queryROUTE)) {
                                                $n_ROUTE++;
                                        ?>
                                                <tr style="background-color: #fff;">
                                                    <td>
                                                        <div align='center'><?php echo $n_ROUTE; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $recROUTE['DOSS_DEPT_NAME'] . "(" . $recROUTE['DOSS_CONTROL'] . ")"; ?></div>
                                                    </td>
                                                    <td>
                                                        <!-- <button type="button" class="btn btn-primary" onclick="webRoute('<?php echo $recROUTE['CIVIL_CODE']; ?>','<?php echo $recROUTE['DOSS_DEPT_CODE']; ?>','<?php echo $recROUTE['DOSS_CONTROL_GEN']; ?>')">รายละเอียด</button>
                                            <button type="button" data-toggle="modal" data-target="#ModalWebRoute" class="btn btn-primary" onclick="openModalWebRoute('<?php echo $recROUTE['CIVIL_CODE']; ?>','<?php echo $recROUTE['DOSS_DEPT_CODE']; ?>','<?php echo $recROUTE['DOSS_CONTROL_GEN']; ?>','<?php echo $sys_name; ?>','<?php echo $recROUTE['DOSS_DEPT_NAME']; ?>')">รายละเอียด</button> -->
                                                        <button type="button" data-toggle="modal" data-target="#ModalWebRoute" class="btn btn-primary" onclick="openModalWebRouteIframe('<?php echo $recROUTE['CIVIL_CODE']; ?>','<?php echo $recROUTE['DOSS_DEPT_CODE']; ?>','<?php echo $recROUTE['DOSS_CONTROL_GEN']; ?>','<?php echo $sys_name; ?>','<?php echo $recROUTE['DOSS_DEPT_NAME']; ?>')">รายละเอียด</button>
                                                    </td>
                                                </tr>

                                            <?php
                                            }
                                            ?>
                                    </table>
                                <?php
                                        } else {
                                            tab::NotInformation(3);
                                        }
                                ?>
                                </table>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <?php
                tab::TabScript();
                ?>
            </div>
        </div>
    </div>
    <!-- modal start -->
    <!-- Modal -->

    <div class="modal fade" id="ModalWebRoute" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="./search_data_show_detial2.php" enctype="multipart/form-data" id="frm-modal" name='frm-modal'>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">รายละเอียดคำสั่งเจ้าพนักงาน</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"><!-- เพิ่มเนื้อหาตามต้องการ -->
                        <!-- เพิ่ม iframe ในนี้ -->
                        <div id="iframeContainer"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- modal stop -->
    <script>
        function webRoute(civilCode, deptCode, controlGen) { //windows popup
            var url = "./CivilRoute.php?civilCode=" + civilCode + "&deptCode=" + deptCode + "&controlGen=" + controlGen
            window.open(url, 'Image', 'width=1000px.stylewidth,height=1000px.style.height,resizable=1');
        }

        function openModalWebRoute(civilCode, deptCode, controlGen, sys_name, DOSS_DEPT_NAME) {
            // นำข้อมูลไปแสดงใน Modal

            $('.modal-title').html("")
            $('.modal-body').html("กรุณารอสักครู่....")

            $('.modal-title').html(sys_name + " (" + DOSS_DEPT_NAME + ")")
            // เปิด Modal
            $.ajax({
                type: "POST",
                url: "../public/search_data_process_A.php",
                data: {
                    proc: 'openModalWebRoute',
                    civilCode: civilCode,
                    deptCode: deptCode,
                    controlGen: controlGen
                },
                cache: false,
                success: function(data) {
                    $('.modal-body').html(data)
                }
            });
            //$('#ModalWebRoute').modal('show');
            //ajax

        }

        function openModalWebRouteIframe(civilCode, deptCode, controlGen, sys_name, DOSS_DEPT_NAME) {
            // เพิ่ม iframe
            $('.modal-title').html(sys_name + " (" + DOSS_DEPT_NAME + ")")
            var iframe = document.createElement('iframe');
            iframe.src = './CivilRoute.php?1=1&civilCode=' + civilCode + '&deptCode=' + deptCode + '&controlGen=' + controlGen;

            // คำนวณความสูงที่ต้องการ (80% ของ viewport height)
            var viewportHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
            var iframeHeight = Math.round(viewportHeight * 0.8);

            iframe.style.width = '100%';
            iframe.style.height = 'calc(' + iframeHeight + 'px - 20px)'; // ลบความสูงขอบ header ออก (ประมาณ 20px)
            iframe.style.border = 'none';
            // เพิ่ม iframe ลงใน container
            var iframeContainer = document.getElementById('iframeContainer');
            iframeContainer.innerHTML = ''; // ล้างเนื้อหาเดิม (ถ้ามี)
            iframeContainer.appendChild(iframe);
            // ทำการ submit form
            /* $('#frm-modal').submit(); */
        }
    </script>
    <!-- content stop -->
    <!-- stop -->
<?php
}
function showMediateResult($WH_ID = '')
{
    $sqlMed = "SELECT 
    a.APPOINT_DATE,a.APPOINT_TIME,a.APPOINT_PLACE,a.RESP_APPOINT_STATUS,
    a.MEDIATE_NO ,a.MEDIATE_RESULT,a.PAYMENT_AMOUNT_DEF,a.OWNER_USR_NAME,a.*
    FROM WH_MEDIATE_CASE_DETAIL a 
    WHERE a.WH_MEDIATE_ID ='" . $WH_ID . "'";
    $queryMed = db::query($sqlMed);
    $rec = db::fetch_array($queryMed);
?>
    <style>
        /*  .label_Detail {
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: transparent;
            font-family: 'Open Sans', sans-serif;
            box-sizing: inherit;
            touch-action: manipulation;
            margin-bottom: .5rem;
            color: #fff;
            display: inline;
            padding: 2px 7px;
            font-weight: 700;
            line-height: 1.1;
            text-align: center;
            vertical-align: baseline;
            border-radius: .25em;
            margin-right: 10px;
            background-color: #A8164E;
            font-size: 14px;
        } */
    </style>
    <div class="card text-white mb-3 " style="max-width:100%;margin: 15px 0px 15px 0px">
        <div class="card-header" style="padding: 10px 10px 10px 10px;background-color: #A8164E ;">
            <h4 style="color: #fff;">ข้อมูลของคดี</h4>
        </div>
        <div class="card-body" style="padding: 10px 10px 10px 10px;">
            <div class="row">
                <div class="col-xs-12 col-sm-2 text-right">
                    <label for=""><b>วันที่นัดหมาย</b></label>
                </div>
                <div class="col-xs-12 col-sm-2">
                    <label for="" class="label_Detail"><?php echo date_AK65($rec['APPOINT_DATE']); ?></label>
                </div>
                <div class="col-xs-12 col-sm-2 text-right">
                    <label for=""><b>เวลานัดหมาย</b></label>
                </div>
                <div class="col-xs-12 col-sm-2">
                    <label for="" class="label_Detail"><?php echo $rec['APPOINT_TIME']; ?></label>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-2 text-right">
                    <label for=""><b>สถานที่</b></label>
                </div>
                <div class="col-xs-12 col-sm-2 text-left">
                    <label for="" class="label_Detail"><?php echo $rec['APPOINT_PLACE']; ?></label>
                </div>
                <div class="col-xs-12 col-sm-2 text-right">
                    <label for=""><b>ผลการตอบกลับการนัดหมาย</b></label>
                </div>
                <div class="col-xs-12 col-sm-2 text-left">
                    <?php if ($rec['RESP_APPOINT_STATUS'] == '1') {
                        $RESP_APPOINT_STATUS =  "ไม่มา/ไม่ประสงค์";
                    } else  if ($rec['RESP_APPOINT_STATUS'] == '2') {
                        $RESP_APPOINT_STATUS = "ตอบรับ";
                    } else  if ($rec['RESP_APPOINT_STATUS'] == '3') {
                        $RESP_APPOINT_STATUS =  "เลื่อนนัด";
                    } else  if ($rec['RESP_APPOINT_STATUS'] == '4') {
                        $RESP_APPOINT_STATUS = "ไม่ตอบกลับ";
                    } ?>
                    <label for="" class="label_Detail"><?php echo $RESP_APPOINT_STATUS; ?></label>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-2 text-right">
                    <label for=""><b>ชื่อนิติกร</b></label>
                </div>
                <div class="col-xs-12 col-sm-2 text-left">
                    <label for="" class="label_Detail"><?php echo $rec['OWNER_USR_NAME']; ?></label>
                </div>
                <div class="col-xs-12 col-sm-2 text-right">
                    <label for=""><b>หน่วยงาน</b></label>
                </div>
                <div class="col-xs-12 col-sm-3 text-left">
                    <label for="" class="label_Detail"><?php echo $rec['DEPT_NAME']; ?></label>
                </div>
            </div>
            <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                <thead class="bg-primary">
                    <tr class="bg-primary">
                        <th style="background-color: #dc3545;color: white;width: 30%;" class="text-center">เลขที่ไกล่เกลี่ย</th>
                        <th style="background-color: #dc3545;color: white;width: 40%;" class="text-center">ผลการไกล่เกลี่ย</th>
                        <th style="background-color: #dc3545;color: white;width: 30%;" class="text-center">ยอดหนี้ที่ได้รับชำระ</th>

                    </tr>
                </thead>
                <tr>
                    <td>
                        <div align='center'><?php echo (empty($rec['MEDIATE_NO']) ? "-" : $rec['MEDIATE_NO']); ?></div>
                    </td>
                    <td>
                        <div align='center'><?php echo (empty($rec['STATUS_RESULT_NAME']) ? "-" : $rec['STATUS_RESULT_NAME']); ?></div>
                    </td>
                    <td>
                        <div align='center'><?php echo (empty($rec['PAYMENT_AMOUNT_DEF']) ? "-" : number_format($rec['PAYMENT_AMOUNT_DEF'], 2)); ?></div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    </div>
<?php
}

function show_asset_table( //ทรัพ 
    $PREFIX_BLACK_CASE = '',
    $BLACK_CASE = '',
    $BLACK_YY = '',
    $PREFIX_RED_CASE = '',
    $RED_CASE = '',
    $RED_YY = '',
    $COURT_CODE = '',
    $SYSTEM_ID = '',
    $TARGET_ASSET
) {
    $filter = "";

    if ($PREFIX_BLACK_CASE != "") {
        $filter .= " and b.PREFIX_BLACK_CASE = '" .  $PREFIX_BLACK_CASE . "'	";
    }
    if ($BLACK_CASE != "") {
        $filter .= " and b.BLACK_CASE = '" . $BLACK_CASE . "'	";
    }
    if ($BLACK_YY != "") {
        $filter .= " and b.BLACK_YY = '" . $BLACK_YY . "'	";
    }
    if ($PREFIX_RED_CASE != "") {
        $filter .= " and b.PREFIX_RED_CASE = '" . $PREFIX_RED_CASE . "'	";
    }
    if ($RED_CASE != "") {
        $filter .= " and b.RED_CASE = '" . $RED_CASE . "'	";
    }
    if ($RED_YY != "") {
        $filter .= " and b.RED_YY = '" . $RED_YY . "'	";
    }

    if ($COURT_CODE != "" && $SYSTEM_ID != 6) {
        if ($SYSTEM_ID == 4) { //ระบบงานไกล่เกลี่ยข้อพิพาท
            //  $filter .= " and COURT_ID = '" . $_POST['COURT_CODE'] . "'	";
        } else {
            $filter .= " and COURT_CODE = '" . $COURT_CODE . "'	";
        }
    }

    $arrDataAsset = array();
    if ($SYSTEM_ID == '1') { //ระบบงานบังคับคดีแพ่ง
        if ($filter != '') {
            if (!empty($TARGET_ASSET)) {
                //  $filter .= "AND a.ASSET_ID IN (" . $TARGET_ASSET . ")";
            }
            $sqlSelectDataAsset = "	select 		ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE,CFC_CAPTION_GEN,a.EST_PRICE_AMOUNT AS ASSET_PRICE
         from 		WH_CIVIL_CASE_ASSETS a 
         inner join 	WH_CIVIL_CASE b on a.WH_CIVIL_ID = b.WH_CIVIL_ID
         where 		1=1 AND ASSET_ID IS NOT NULL  AND PROP_STATUS_NAME IS NOT NULL {$filter}";
        }
    } else if ($SYSTEM_ID == '2') { //ระบบงานบังคับคดีล้มละลาย
        if ($filter != '') {
            $sqlSelectDataAsset = "	select 		ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE,EST_ASSET_PRICE1 AS ASSET_PRICE
         from 		WH_BANKRUPT_ASSETS a 
         inner join 	WH_BANKRUPT_CASE_DETAIL b on a.WH_BANKRUPT_ID = b.WH_BANKRUPT_ID
         where 		1=1 AND PROP_STATUS_NAME IS NOT NULL {$filter}";
        }
    } else if ($SYSTEM_ID == '6') { //ระบบงาน DEBTOR
        if ($filter != '') {
            $sqlSelectDataAsset = "	select 		WH_ASSET_ID as ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE,M_ASSET_KEY,ASSET_TYPE_ID
         from 		WH_DEBTOR_ASSETS
         where 		1=1 AND PROP_TITLE is not null AND WH_ASSET_ID IS NOT NULL AND PROP_STATUS_NAME IS NOT NULL  {$filter}";
        }
    }

    //echo $sqlSelectDataAsset;
    $querySelectDataAsset = db::query($sqlSelectDataAsset);
    $num_r = db::num_rows($querySelectDataAsset);

?>
    <style>

    </style>
    <div class="row" class="col-md-12" style="margin: 10px 10px 10px 10px;">
        <div class="table-responsive">
            <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                <thead class="thead-dark">
                    <tr>
                        <th style="background-color: #dc3545;color: white;">ลำดับรายการทรัพย์</th>
                        <th style="background-color: #dc3545;color: white;">ชื่อรายการทรัพย์</th>
                        <th style="background-color: #dc3545;color: white;">สถานะ</th>
                        <th style="background-color: #dc3545;color: white;">ราคาประเมิน</th>
                        <th style="background-color: #dc3545;color: white;">เกี่ยวข้องเป็น</th>
                    </tr>
                </thead>
                <?php
                if ($num_r > 0) {
                ?>
                    <?php

                    $T = 1;
                    while ($recSelectDataAsset = db::fetch_array($querySelectDataAsset)) {
                    ?>
                        <tr style="background-color: #E6E6FA;">
                            <td>
                                <div align="center"><?php echo $T; ?></div>
                            </td>
                            <td><a onclick="show_asset_detail(<?php echo $recSelectDataAsset['ASSET_ID']; ?>)" href="javascript:void();"><?php echo $recSelectDataAsset["PROP_TITLE"]; ?></a></td>
                            <td> <?php echo $recSelectDataAsset['PROP_STATUS_NAME']; ?></td>
                            <td>
                                <div align='center'><?php echo $recSelectDataAsset['ASSET_PRICE'] != "0" ? $recSelectDataAsset['ASSET_PRICE'] : "-"; ?></div>
                            </td>
                            <?php
                            if ($SYSTEM_ID == '1') {
                                $sql_owner = "SELECT *FROM WH_CIVIL_CASE_ASSET_OWNER b 
                                JOIN " . Convert::ConvertTable('WH_CIVIL_CASE_PERSON') . " c ON b.WH_CIVIL_ID =c.WH_CIVIL_ID AND b.PERSON_NAME =c.FULL_NAME 
                                WHERE 1=1 
                                AND b.ASSET_ID ='" . $recSelectDataAsset['ASSET_ID'] . "'";
                            ?>
                                <td>
                                    <table>
                                        <?php
                                        $queryowner = db::query($sql_owner);
                                        while ($rec_owner = db::fetch_array($queryowner)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $rec_owner['FULL_NAME']; ?></td>
                                                <td><?php echo $rec_owner['CONCERN_NAME']; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </td>
                            <?php } else if ($SYSTEM_ID == '2') {
                                $sql_owner = "SELECT b.ASSET_ID ,b.PROP_TITLE ,c.PER_FULLNAME AS FULL_NAME,c.RELATE_PROPERTY_NAME AS CONCERN_NAME
                                            FROM WH_BANKRUPT_ASSETS b 
                                            JOIN WH_BANKRUPT_ASSETS_OWNER c ON b.ASSET_ID =c.ASSET_ID 
                                            WHERE b.ASSET_ID ='" . $recSelectDataAsset['ASSET_ID'] . "'";
                            ?>
                                <td>
                                    <table>
                                        <?php
                                        $queryowner = db::query($sql_owner);
                                        while ($rec_owner = db::fetch_array($queryowner)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $rec_owner['FULL_NAME']; ?></td>
                                                <td><?php echo $rec_owner['CONCERN_NAME']; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </td>
                            <?php
                            } ?>
                        </tr>
                    <?php
                        $T++;
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="4">
                            <div align='center'>ไม่พบข้อมูล</div>
                        </td>
                    </tr>
                <?php
                }
                ?>

            </table>
        </div>
    </div>
    <?php
    /* ทรัพ */
}

function show_asset( //ทรัพที่เเสดงใน search_data
    $PREFIX_BLACK_CASE = '',
    $BLACK_CASE = '',
    $BLACK_YY = '',
    $PREFIX_RED_CASE = '',
    $RED_CASE = '',
    $RED_YY = '',
    $COURT_CODE = '',
    $SYSTEM_ID = '',
    $REGISTER_CODE = ''
) {
    $filter = "";

    if ($PREFIX_BLACK_CASE != "") {
        $filter .= " and b.PREFIX_BLACK_CASE = '" .  $PREFIX_BLACK_CASE . "'	";
    }
    if ($BLACK_CASE != "") {
        $filter .= " and b.BLACK_CASE = '" . $BLACK_CASE . "'	";
    }
    if ($BLACK_YY != "") {
        $filter .= " and b.BLACK_YY = '" . $BLACK_YY . "'	";
    }
    if ($PREFIX_RED_CASE != "") {
        $filter .= " and b.PREFIX_RED_CASE = '" . $PREFIX_RED_CASE . "'	";
    }
    if ($RED_CASE != "") {
        $filter .= " and b.RED_CASE = '" . $RED_CASE . "'	";
    }
    if ($RED_YY != "") {
        $filter .= " and b.RED_YY = '" . $RED_YY . "'	";
    }

    if ($COURT_CODE != "" && $SYSTEM_ID != 6) {
        if ($SYSTEM_ID == 4) { //ระบบงานไกล่เกลี่ยข้อพิพาท
            //  $filter .= " and COURT_ID = '" . $_POST['COURT_CODE'] . "'	";
        } else {
            $filter .= " and COURT_CODE = '" . $COURT_CODE . "'	";
        }
    }

    $arrDataAsset = array();
    if ($SYSTEM_ID == '1') { //ระบบงานบังคับคดีแพ่ง
        if ($filter != '') {
            $sqlSelectDataAsset = "	select 		ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE,CFC_CAPTION_GEN
         from 		WH_CIVIL_CASE_ASSETS a 
         inner join 	WH_CIVIL_CASE b on a.WH_CIVIL_ID = b.WH_CIVIL_ID
         where 		1=1 AND ASSET_ID IS NOT NULL  {$filter}";
        }
    } else if ($SYSTEM_ID == '2') { //ระบบงานบังคับคดีล้มละลาย
        if ($filter != '') {
            $sqlSelectDataAsset = "	select 		ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE
         from 		WH_BANKRUPT_ASSETS a 
         inner join 	WH_BANKRUPT_CASE_DETAIL b on a.WH_BANKRUPT_ID = b.WH_BANKRUPT_ID
         where 		1=1 {$filter}";
        }
    } else if ($SYSTEM_ID == '6') { //ระบบงานบังคับคดีล้มละลาย
        if ($filter != '') {
            $sqlSelectDataAsset = "	select 		WH_ASSET_ID as ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE,M_ASSET_KEY,ASSET_TYPE_ID
         from 		WH_DEBTOR_ASSETS
         where 		1=1 AND PROP_TITLE is not null AND WH_ASSET_ID IS NOT NULL  {$filter}";
        }
    }
    //echo $filter;
    //echo  $sqlSelectDataAsset."<br><br>";

    $querySelectDataAsset = db::query($sqlSelectDataAsset);
    $num_r = db::num_rows($querySelectDataAsset);
    if ($num_r > 0) {
    ?>
        <tr>
            <td></td>
            <td style="background-color: #D4B6B8;">ลำดับรายการทรัพย์</td>
            <td style="background-color: #D4B6B8;">ชื่อรายการทรัพย์</td>
            <td style="background-color: #D4B6B8;">สถานะ</td>
            <td style="background-color: #D4B6B8;">เกี่ยวข้องเป็น</td>
        </tr>
    <?php
    }
    $T = 1;
    while ($recSelectDataAsset = db::fetch_array($querySelectDataAsset)) {
    ?>
        <tr>
            <td></td>
            <td style="background-color: #fff8ec;">
                <div align="center"><?php echo $T; ?></div>
            </td>
            <td style="background-color: #fff8ec;"> <?php echo $recSelectDataAsset['PROP_TITLE']; ?></td>
            <td style="background-color: #fff8ec;"> <?php echo $recSelectDataAsset['PROP_STATUS_NAME']; ?></td>
            <?php
            $sql_owner = "SELECT *FROM WH_CIVIL_CASE_ASSET_OWNER b 
                                            JOIN " . Convert::ConvertTable('WH_CIVIL_CASE_PERSON') . " c ON b.WH_CIVIL_ID =c.WH_CIVIL_ID AND b.PERSON_NAME =c.FULL_NAME 
                                            WHERE 1=1 
                                            AND b.ASSET_ID ='" . $recSelectDataAsset['ASSET_ID'] . "'";

            if ($SYSTEM_ID == '1') {
            ?>
                <td>
                    <table>
                        <?php
                        $queryowner = db::query($sql_owner);
                        while ($rec_owner = db::fetch_array($queryowner)) {
                            /*  if ($rec_owner['HOLDING_GROUP'] == '01') {
                                                $HOLDING_GROUP = "จำเลยและผู้ถือกรรมสิทธิ์ร่วม";
                                            } else if ($rec_owner['HOLDING_GROUP'] == '02') {
                                                $HOLDING_GROUP = "ทายาท ผู้จัดการมรดก หรือบุคคนอื่นๆที่เกี่ยวข้อง";
                                            } else if ($rec_owner['HOLDING_GROUP'] == '03') {
                                                $HOLDING_GROUP = "ผู้รับจำนอง";
                                            } */
                        ?>
                            <tr>
                                <td><?php echo $rec_owner['FULL_NAME']; ?></td>
                                <td><?php echo $rec_owner['CONCERN_NAME']; ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </td>
            <?php } else if ($SYSTEM_ID == '2') { ?>
                <td>

                </td>
            <?php
            } ?>
        </tr>
    <?php
        $T++;
    }
    /* ทรัพ */
}



function num_show_asset( //ทรัพที่เเสดงใน search_data
    $PREFIX_BLACK_CASE = '',
    $BLACK_CASE = '',
    $BLACK_YY = '',
    $PREFIX_RED_CASE = '',
    $RED_CASE = '',
    $RED_YY = '',
    $COURT_CODE = '',
    $SYSTEM_ID = '',
    $REGISTER_CODE = ''
) {
    $filter = "";

    if ($PREFIX_BLACK_CASE != "") {
        $filter .= " and b.PREFIX_BLACK_CASE = '" .  $PREFIX_BLACK_CASE . "'	";
    }
    if ($BLACK_CASE != "") {
        $filter .= " and b.BLACK_CASE = '" . $BLACK_CASE . "'	";
    }
    if ($BLACK_YY != "") {
        $filter .= " and b.BLACK_YY = '" . $BLACK_YY . "'	";
    }
    if ($PREFIX_RED_CASE != "") {
        $filter .= " and b.PREFIX_RED_CASE = '" . $PREFIX_RED_CASE . "'	";
    }
    if ($RED_CASE != "") {
        $filter .= " and b.RED_CASE = '" . $RED_CASE . "'	";
    }
    if ($RED_YY != "") {
        $filter .= " and b.RED_YY = '" . $RED_YY . "'	";
    }

    if ($COURT_CODE != "" && $SYSTEM_ID != 6) {
        if ($SYSTEM_ID == 4) { //ระบบงานไกล่เกลี่ยข้อพิพาท
            //  $filter .= " and COURT_ID = '" . $_POST['COURT_CODE'] . "'	";
        } else {
            $filter .= " and COURT_CODE = '" . $COURT_CODE . "'	";
        }
    }

    $arrDataAsset = array();
    if ($SYSTEM_ID == '1') { //ระบบงานบังคับคดีแพ่ง
        if ($filter != '') {
            $sqlSelectDataAsset = "	select 		ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE,CFC_CAPTION_GEN
         from 		WH_CIVIL_CASE_ASSETS a 
         inner join 	WH_CIVIL_CASE b on a.WH_CIVIL_ID = b.WH_CIVIL_ID
         where 		1=1 
         AND ASSET_ID IS NOT NULL  
         AND a.PROP_STATUS_NAME IS NOT NULL
         {$filter}";
        }
    } else if ($SYSTEM_ID == '2') { //ระบบงานบังคับคดีล้มละลาย
        if ($filter != '') {
            $sqlSelectDataAsset = "	select 		ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE
         from 		WH_BANKRUPT_ASSETS a 
         inner join 	WH_BANKRUPT_CASE_DETAIL b on a.WH_BANKRUPT_ID = b.WH_BANKRUPT_ID
         where 		1=1 {$filter}";
        }
    } else if ($SYSTEM_ID == '6') { //ระบบงานบังคับคดีล้มละลาย
        if ($filter != '') {
            $sqlSelectDataAsset = "	select 		WH_ASSET_ID as ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE,M_ASSET_KEY,ASSET_TYPE_ID
         from 		WH_DEBTOR_ASSETS
         where 		1=1 AND PROP_TITLE is not null AND WH_ASSET_ID IS NOT NULL  {$filter}";
        }
    }
    $querySelectDataAsset = db::query($sqlSelectDataAsset);
    $num_r = db::num_rows($querySelectDataAsset);

    return $num_r;
    /* ทรัพ */
}

function add_order_auto()
{/* เพิ่มคำสั่ง start*/
    ?>
    <!-- การป้อนข้อมูล start -->
    <div style="display: none;">
        <!-- send start -->
        <input type="text" id="CMD_DOC_DATE" name="CMD_DOC_DATE" value="<?php echo date('Y-m-d'); ?>"><!-- //วันที่ -->
        <input type="text" id="CMD_DOC_TIME" name="CMD_DOC_TIME" value="<?php echo date("H:i:s"); ?>"><!-- เวลา -->
        <input type="text" id="register_code_send" name="register_code_send" value="1234567890123"><!-- เลข13 หลักผู้ส่ง -->
        <input type="text" id="SYSTEM_ID_send" name="SYSTEM_ID_send" value="1"><!-- คำสั่ง/สอบถาม/แจ้ง จากระบบงาน  -->

        <input type="text" id="T_BLACK_CASE_send" name="T_BLACK_CASE_send" value="ผบ."><!-- หมายเลขคดีดำ ผู้ส่ง -->
        <input type="text" id="BLACK_CASE_send" name="BLACK_CASE_send" value="000"><!-- หมายเลขคดีดำ ผู้ส่ง -->
        <input type="text" id="BLACK_YY_send" name="BLACK_YY_send" value="111"><!-- หมายเลขคดีดำ ผู้ส่ง -->

        <input type="text" id="T_RED_CASE_send" name="T_RED_CASE_send" value="ผบ."><!-- หมายเลขคดีแดง ผู้ส่ง -->
        <input type="text" id="RED_CASE_send" name="RED_CASE_send" value="0000"><!-- หมายเลขคดีแดง ผู้ส่ง -->
        <input type="text" id="RED_YY_send" name="RED_YY_send" value="1111"><!-- หมายเลขคดีแดง ผู้ส่ง -->

        <input type="text" id="COUNT_CODE_send" name="COUNT_CODE_send" value="302"><!-- ศาล -->

        <input type="text" id="plaintiff_send" name="plaintiff_send" value="นายA"><!-- โจทก์ -->
        <input type="text" id="defendant_send" name="defendant_send" value="นายB"><!-- จำเลย -->

        <!-- send stop -->

        <!-- recive  start-->
        <input type="text" id="SEND_TO_receive" name="SEND_TO_receive" value="4"><!-- คำสั่ง/สอบถาม/แจ้ง จากระบบงาน  -->

        <input type="text" id="T_BLACK_CASE_receive" name="T_BLACK_CASE_receive" value="ล."><!-- หมายเลขคดีดำ ผู้ส่ง -->
        <input type="text" id="BLACK_CASE_receive" name="BLACK_CASE_receive" value="222"><!-- หมายเลขคดีดำ ผู้ส่ง -->
        <input type="text" id="BLACK_YY_receive" name="BLACK_YY_receive" value="2565"><!-- หมายเลขคดีดำ ผู้ส่ง -->

        <input type="text" id="T_RED_CASE_receive" name="T_RED_CASE_receive" value="ล."><!-- หมายเลขคดีแดง ผู้ส่ง -->
        <input type="text" id="RED_CASE_receive" name="RED_CASE_receive" value="333"><!-- หมายเลขคดีแดง ผู้ส่ง -->
        <input type="text" id="RED_YY_receive" name="RED_YY_receive" value="2565"><!-- หมายเลขคดีแดง ผู้ส่ง -->

        <input type="text" id="COUNT_CODE_receive" name="COUNT_CODE_receive" value="003"><!-- ศาล
 -->

        <input type="text" id="plaintiff_receive" name="plaintiff_receive" value="นายC"><!-- โจทก์  -->
        <input type="text" id="defendant_receive" name="defendant_receive" value="นายD"><!-- จำเลย -->

        <input type="text" id="note" name="note" value="รายละเอียด"><!-- รายละเอียด -->
        <input type="text" id="APPROVE_PERSON" name="APPROVE_PERSON" value="1311100009189"><!-- ผอ อนุมัติ เป็นเลข 13 หลัก ส่งถึงใคร -->
        <input type="text" id="OFFICE_IDCARD" name="OFFICE_IDCARD" value="1311100009189">
        <input type="text" id="OFFICE_NAME" name="OFFICE_NAME" value="นายกฤศวรรธน์ พิลาล้ำ">
        <!-- recive stop -->
    </div>
    <!-- การป้อนข้อมูล stop -->
    <!-- ปุ่ม start -->

    <button class="btn btn-primary" type="button" onclick="inser_data_case();">บันทึกคำสั่งเจ้าพนักงาน auto</button>

    <!-- ปุ่ม stop -->
    <script>
        function inser_data_case(register_code) {
            let attachid = '<?php echo random(50); ?>' //random
            /* ชุดผู้ส่ง start */
            let CMD_DOC_DATE = $('#CMD_DOC_DATE').val(); //วันที่
            let CMD_DOC_TIME = $('#CMD_DOC_TIME').val(); //เวลา

            let register_code_send = $('#register_code_send').val(); //เลข13 หลักผู้ส่ง

            let SYSTEM_ID_send = $('#SYSTEM_ID_send').val(); //คำสั่ง/สอบถาม/แจ้ง จากระบบงาน 

            let T_BLACK_CASE_send = $('#T_BLACK_CASE_send').val(); //หมายเลขคดีดำ ผู้ส่ง
            let BLACK_CASE_send = $('#BLACK_CASE_send').val(); //หมายเลขคดีดำ ผู้ส่ง
            let BLACK_YY_send = $('#BLACK_YY_send').val(); //หมายเลขคดีดำ ผู้ส่ง

            let T_RED_CASE_send = $('#T_RED_CASE_send').val(); //หมายเลขคดีแดง ผู้ส่ง
            let RED_CASE_send = $('#RED_CASE_send').val(); //หมายเลขคดีแดง ผู้ส่ง
            let RED_YY_send = $('#RED_YY_send').val(); //หมายเลขคดีแดง ผู้ส่ง

            let COUNT_CODE_send = $('#COUNT_CODE_send').val(); //ศาล

            let plaintiff_send = $('#plaintiff_send').val(); //โจทก์
            let defendant_send = $('#defendant_send').val(); //จำเลย
            /* ชุดผู้ส่ง stop */

            /* ชุดผู้รับ start */
            let SEND_TO_receive = $('#SEND_TO_receive').val(); //คำสั่ง/สอบถาม/แจ้ง จากระบบงาน 

            let T_BLACK_CASE_receive = $('#T_BLACK_CASE_receive').val(); //หมายเลขคดีดำ ผู้ส่ง
            let BLACK_CASE_receive = $('#BLACK_CASE_receive').val(); //หมายเลขคดีดำ ผู้ส่ง
            let BLACK_YY_receive = $('#BLACK_YY_receive').val(); //หมายเลขคดีดำ ผู้ส่ง

            let T_RED_CASE_receive = $('#T_RED_CASE_receive').val(); //หมายเลขคดีแดง ผู้ส่ง
            let RED_CASE_receive = $('#RED_CASE_receive').val(); //หมายเลขคดีแดง ผู้ส่ง
            let RED_YY_receive = $('#RED_YY_receive').val(); //หมายเลขคดีแดง ผู้ส่ง

            let COUNT_CODE_receive = $('#COUNT_CODE_receive').val(); //ศาล

            let plaintiff_receive = $('#plaintiff_receive').val(); //โจทก์
            let defendant_receive = $('#defendant_receive').val(); //จำเลย
            /* ชุดผู้รับ stop */

            let note = $('#note').val(); //รายละเอียด
            let APPROVE_PERSON = $('#APPROVE_PERSON').val(); //ผอ อนุมัติ เป็นเลข 13 หลัก ส่งถึงใคร
            let OFFICE_IDCARD = $('#OFFICE_IDCARD').val(); //รายละเอียด
            let OFFICE_NAME = $('#OFFICE_NAME').val(); //ผอ อนุมัติ เป็นเลข 13 หลัก ส่งถึงใคร

            /* console.log(APPROVE_PERSON)
            return false */
            $.ajax({
                type: "POST",
                /* url: "./search_data_process_A.php", */
                url: "./search_data_process_A.php",
                data: {
                    proc: 'btn_search_data',
                    attachid: attachid, //random
                    /* ส่ง start  */
                    CMD_DOC_DATE: CMD_DOC_DATE, //วันที่
                    CMD_DOC_TIME: CMD_DOC_TIME, //เวลา

                    REGISTERCODE: register_code_send, //เลข13 หลักผู้ส่ง

                    SYSTEM_ID: SYSTEM_ID_send, //คำสั่ง/สอบถาม/แจ้ง จากระบบงาน 

                    T_BLACK_CASE: T_BLACK_CASE_send, //หมายเลขคดีดำ ผู้ส่ง
                    BLACK_CASE: BLACK_CASE_send, //หมายเลขคดีดำ ผู้ส่ง
                    BLACK_YY: BLACK_YY_send, //หมายเลขคดีดำ ผู้ส่ง

                    T_RED_CASE: T_RED_CASE_send, //หมายเลขคดีแดง ผู้ส่ง
                    RED_CASE: RED_CASE_send, //หมายเลขคดีแดง ผู้ส่ง
                    RED_YY: RED_YY_send, //หมายเลขคดีแดง ผู้ส่ง

                    COURT_CODE: COUNT_CODE_send, //ศาล ส่ง

                    D_C: plaintiff_send, //โจทก์
                    D_NAME: defendant_send, //จำเลย
                    /* ส่ง stop  */
                    /* ------------------------------------------------------------------------------------- */
                    /* รับ start  */
                    SEND_TO: SEND_TO_receive, //คำสั่ง/สอบถาม/แจ้ง จากระบบงาน 

                    TO_T_BLACK_CASE: T_BLACK_CASE_receive, //หมายเลขคดีดำ ผู้ส่ง
                    TO_BLACK_CASE: BLACK_CASE_receive, //หมายเลขคดีดำ ผู้ส่ง
                    TO_BLACK_YY: BLACK_YY_receive, //หมายเลขคดีดำ ผู้ส่ง

                    TO_T_RED_CASE: T_RED_CASE_receive, //หมายเลขคดีแดง ผู้ส่ง
                    TO_RED_CASE: RED_CASE_receive, //หมายเลขคดีแดง ผู้ส่ง
                    TO_RED_YY: RED_YY_receive, //หมายเลขคดีแดง ผู้ส่ง

                    TO_COURT_CODE: COUNT_CODE_receive, //ศาล ส่ง

                    TO_PLAINTIFF: plaintiff_receive, //โจทก์
                    TO_DEFENDANT: defendant_receive, //จำเลย
                    /* รับ stop  */
                    /* ------------------------------------------------------------------------------------- */
                    CMD_NOTE: note, //รายละเอียด
                    APPROVE_PERSON: APPROVE_PERSON, //ผอ อนุมัติ เป็นเลข 13 หลัก ส่งถึงใคร
                    OFFICE_IDCARD: OFFICE_IDCARD,
                    OFFICE_NAME: OFFICE_NAME
                },
                dataType: "JSON",
                success: function(data) {
                    console.log()
                    if (1 == 1) {
                        window.location = 'search_data_cmd.php'
                    }
                }

            });
        }
    </script>
<?php
}
/* เพิ่มคำสั่ง stop*/


function add_order_have_input()/* บันทึกคำสั่งเจ้าพนักงาน ลิ้งไปหน้าคำสั่ง start */
{
?>
    <!-- send start -->
    <div class="form-group row">
        <div class="row">
            <div class="col-xs-12 col-sm-1"> </div>
            <div class="col-xs-12 col-sm-2" align="left">
                <h3><u>ผู้ส่ง</u></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-1"> </div>
            <div class="col-md-2 "><label for="SEND_TO">คำสั่ง/สอบถาม/แจ้ง จากระบบงาน </label></div>
            <div class="col-xs-12 col-sm-3">
                <select name="SYSTEM_ID_have_input" id="SYSTEM_ID_have_input" class="form-control select2">
                    <option value="" disabled selected>เลือกระบบงาน</option>
                    <?php
                    $sql = "SELECT	* FROM M_CMD_SYSTEM
									  WHERE 1=1 AND CMD_SYSTEM_ID NOT IN (6) 
									  ORDER BY SERVICE_SYS_NAME ASC
									  ";
                    $query = db::query($sql);
                    while ($rec = db::fetch_array($query)) {
                    ?>
                        <option value="<?php echo $rec['CMD_SYSTEM_ID']; ?>"><?php echo $rec['SERVICE_SYS_NAME']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-1"> </div>
            <div class="col-xs-12 col-sm-2"><label for="">หมายเลขคดีดำ</label></div>
            <div class="col-xs-12 col-sm-2">
                <input type="text" class="form-control" id="T_BLACK_CASE_send_have_input" name="T_BLACK_CASE_send_have_input" value="ผบ."><!-- หมายเลขคดีดำ ผู้ส่ง -->
            </div>
            <div class="col-xs-12 col-sm-2">
                <input type="text" class="form-control" id="BLACK_CASE_send_have_input" name="BLACK_CASE_send_have_input" value="000"><!-- หมายเลขคดีดำ ผู้ส่ง -->
            </div>
            <div class="col-xs-12 col-sm-1" align="right"><label for="">ปี</label></div>
            <div class="col-xs-12 col-sm-2">
                <input type="text" class="form-control" id="BLACK_YY_send_have_input" name="BLACK_YY_send_have_input" value="2560"><!-- หมายเลขคดีดำ ผู้ส่ง -->
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-1"> </div>
            <div class="col-xs-12 col-sm-2"><label for="">หมายเลขคดีแดง</label></div>
            <div class="col-xs-12 col-sm-2">
                <input type="text" class="form-control" id="T_RED_CASE_send_have_input" name="T_RED_CASE_send_have_input" value="ผบ."><!-- หมายเลขคดีแดง ผู้ส่ง -->
            </div>
            <div class="col-xs-12 col-sm-2">
                <input type="text" class="form-control" id="RED_CASE_send_have_input" name="RED_CASE_send_have_input" value="0000"><!-- หมายเลขคดีแดง ผู้ส่ง -->
            </div>
            <div class="col-xs-12 col-sm-1" align="right"><label for="">ปี</label></div>
            <div class="col-xs-12 col-sm-2">
                <input type="text" class="form-control" id="RED_YY_send_have_input" name="RED_YY_send_have_input" value="2560"><!-- หมายเลขคดีแดง ผู้ส่ง -->
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-1"> </div>
            <div class="col-xs-12 col-sm-2"><label for="">ศาล</label></div>
            <div class="col-xs-12 col-sm-2">
                <select name="COURT_CODE_have_input" id="COURT_CODE_have_input" class="form-control select2" tabindex="-1" aria-hidden="true" required>
                    <option value="" disabled selected>ศาล</option>
                    <?php
                    $sqlCourt = "	SELECT 		COURT_CODE,COURT_NAME
												FROM 		M_COURT
												WHERE 		1=1 
												ORDER BY 	COURT_CODE ASC
												";
                    $queryCourt = db::query($sqlCourt);
                    while ($recCourt = db::fetch_array($queryCourt)) {
                    ?>
                        <option value="<?php echo $recCourt['COURT_CODE']; ?>"><?php echo $recCourt['COURT_NAME']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-1"> </div>
            <div class="col-xs-12 col-sm-2"><label for="">โจทก์</label></div>
            <div class="col-xs-12 col-sm-4">
                <input type="text" class="form-control" id="plaintiff_send_have_input" name="plaintiff_send_have_input" value="นายA"><!-- โจทก์ -->
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-1"> </div>
            <div class="col-xs-12 col-sm-2"><label for="">จำเลย</label></div>
            <div class="col-xs-12 col-sm-4">
                <input type="text" class="form-control" id="defendant_send_have_input" name="defendant_send_have_input" value="นายB"><!-- จำเลย -->
            </div>
        </div>
    </div>
    <!-- send stop -->
    <button class="btn btn-primary" type="button" onclick="save_order_add_order_have_input();">บันทึกคำสั่งเจ้าพนักงาน</button>
    <script>
        function save_order_add_order_have_input() {
            let SYSTEM_ID = $('#SYSTEM_ID_have_input').val(); //คำสั่ง/สอบถาม/แจ้ง จากระบบงาน
            let T_BLACK_CASE_send = $('#T_BLACK_CASE_send_have_input').val(); //หมายเลขคดีดำ
            let BLACK_CASE_send = $('#BLACK_CASE_send_have_input').val(); //หมายเลขคดีดำ
            let BLACK_YY_send = $('#BLACK_YY_send_have_input').val(); //หมายเลขคดีดำ
            let T_RED_CASE_send = $('#T_RED_CASE_send_have_input').val(); //หมายเลขคดีแดง
            let RED_CASE_send = $('#RED_CASE_send_have_input').val(); //หมายเลขคดีแดง
            let RED_YY_send = $('#RED_YY_send_have_input').val(); //หมายเลขคดีแดง

            let COURT_CODE = $('#COURT_CODE_have_input').val(); //ศาล
            let plaintiff_send = $('#plaintiff_send_have_input').val(); //โจทก์
            let defendant_send = $('#defendant_send_have_input').val(); //จำเลย

            let url = "./cmd_add_from_send_to.php?proc=add";
            url += "&GET_S_SYSTEM_ID=" + SYSTEM_ID;

            url += "&GET_S_PREFIX_CASE_BLACK=" + T_BLACK_CASE_send;
            url += "&GET_S_CASE_BLACK=" + BLACK_CASE_send;
            url += "&GET_S_CASE_BLACK_YEAR=" + BLACK_YY_send;

            url += "&GET_S_PREFIX_CASE_RED=" + T_RED_CASE_send;
            url += "&GET_S_CASE_RED=" + RED_CASE_send;
            url += "&GET_S_CASE_RED_YEAR=" + RED_YY_send;

            url += "&GET_S_COURT_CODE=" + COURT_CODE;
            url += "&GET_PLAINTIFF=" + plaintiff_send;
            url += "&GET_DEFENDANT=" + defendant_send;
            window.location.href = url;

        }
    </script>
<?php
}
/* ลิ้งไปหน้าคำสั่ง stop */
function add_order()/* บันทึกคำสั่งเจ้าพนักงาน ลิ้งไปหน้าคำสั่ง start */
{
?>
    <!-- send start -->
    <input type="hidden" id="register_code_send" name="register_code_send" value="1234567890123"><!-- เลข13 หลักผู้ส่ง -->
    <input type="hidden" id="SYSTEM_ID_send" name="SYSTEM_ID_send" value="1"><!-- คำสั่ง/สอบถาม/แจ้ง จากระบบงาน  -->

    <input type="hidden" id="T_BLACK_CASE_send" name="T_BLACK_CASE_send" value="ผบ."><!-- หมายเลขคดีดำ ผู้ส่ง -->
    <input type="hidden" id="BLACK_CASE_send" name="BLACK_CASE_send" value="000"><!-- หมายเลขคดีดำ ผู้ส่ง -->
    <input type="hidden" id="BLACK_YY_send" name="BLACK_YY_send" value="111"><!-- หมายเลขคดีดำ ผู้ส่ง -->

    <input type="hidden" id="T_RED_CASE_send" name="T_RED_CASE_send" value="ผบ."><!-- หมายเลขคดีแดง ผู้ส่ง -->
    <input type="hidden" id="RED_CASE_send" name="RED_CASE_send" value="0000"><!-- หมายเลขคดีแดง ผู้ส่ง -->
    <input type="hidden" id="RED_YY_send" name="RED_YY_send" value="1111"><!-- หมายเลขคดีแดง ผู้ส่ง -->

    <input type="hidden" id="COUNT_CODE_send" name="COUNT_CODE_send" value="302"><!-- ศาล -->

    <input type="hidden" id="plaintiff_send" name="plaintiff_send" value="นายA"><!-- โจทก์ -->
    <input type="hidden" id="defendant_send" name="defendant_send" value="นายB"><!-- จำเลย -->

    <input type="hidden" id="defendant_send" name="defendant_send" value="">
    <!-- send stop -->
    <button class="btn btn-primary" type="button" onclick="save_order();">บันทึกคำสั่งเจ้าพนักงาน</button>
    <script>
        function save_order() {
            window.location.href = './cmd_add_from_send_to.php?GET_S_PREFIX_CASE_BLACK=ล.&GET_S_CASE_BLACK=20701&GET_S_CASE_BLACK_YEAR=2566&GET_S_PREFIX_CASE_RED=ล.&GET_S_CASE_RED=20702&GET_S_CASE_RED_YEAR=2566&GET_S_COURT_CODE=050&GET_S_SYSTEM_ID=2&SEND_TO=2&TO_PERSON_ID=1730500105717&GET_PLAINTIFF=บริษัท%20ซิตี้คอร์ป%20ลีสซิ่ง%20(ประเทศไทย)%20จำกัดฯ%20&GET_DEFENDANT=นางสาวน้ำค้าง%20วังเย็น&GET_T_PREFIX_CASE_BLACK=ผบ&GET_T_CASE_BLACK=177&GET_T_CASE_BLACK_YEAR=2553&GET_T_PREFIX_CASE_RED=ผบ.&GET_T_CASE_RED=342&GET_T_CASE_RED_YEAR=2553&GET_T_COURT_CODE=204&GET_T_SYSTEM_ID=1&ID_CARD=3809900078401&PCC_CASE_GEN=4716287&proc=add';

        }
    </script>
<?php
}
/* ลิ้งไปหน้าคำสั่ง stop */

function serch_data13()/* ค้นหาจากเลข 13หลัก start */
{
?> <div class="col-xs-12 col-sm-12">
        <div class="col-xs-12 col-sm-4"> <input type="text" name="data13" id="data13" oninput="input_Number(this)" class="form-control"> </div>
        <div class="col-xs-12 col-sm-2"> <button type="button" onclick="search13();" class="btn btn-primary">ค้นหา</button></div>
    </div>
    <script>
        function search13() {
            let data13 = $('#data13').val();
            window.location.href = './search_data.php?REGISTERCODE=' + data13;
        }

        function input_Number(input) {
            // ลบตัวอักษรที่ไม่ใช่ตัวเลขทั้งหมด
            input.value = input.value.replace(/[^,0-9]/g, '');

            // คั้นระหว่างตัวเลขทุก 13 ตัวด้วยเครื่องหมาย "-"
            const valueLength = input.value.length;
            if (valueLength > 13) {
                const formattedValue = input.value.replace(/(\d{13})(?=\d)/g, '$1,');
                input.value = formattedValue;
            }
        }
    </script>
<?php
}
/* ค้นหาจากเลข 13หลัก stop */
function link_order()
{
?><button type="button" onclick="link_();" class="btn btn-primary">คำสั่งเจ้าพนักงาน </button>
    <script>
        function link_() {
            window.location.href = './search_data_cmd.php';
        }
    </script>
<?php
}
?>
<?php
function WH_ID_CONVERT_TO_CODE_API($WH_ID, $SYSTEM) //แปลง 
{
    if ($SYSTEM == 'Civil' || $SYSTEM == 'CIVIL' || $SYSTEM == '1') {
        $sql = "SELECT a.CIVIL_CODE AS CODE_API FROM WH_CIVIL_CASE a WHERE a.WH_CIVIL_ID ='" . $WH_ID . "'";
    } else if ($SYSTEM == 'Bankrupt' || $SYSTEM == 'BANKRUPT' || $SYSTEM == '2') {
        $sql = "SELECT a.BANKRUPT_CODE AS CODE_API FROM WH_BANKRUPT_CASE_DETAIL a WHERE a.WH_BANKRUPT_ID ='" . $WH_ID . "'";
    } else if ($SYSTEM == 'Revive' || $SYSTEM == 'REVIVE' || $SYSTEM == '3') {
        $sql = "SELECT a.REHAB_CODE AS CODE_API FROM WH_REHABILITATION_CASE_DETAIL a WHERE a.WH_REHAB_ID ='" . $WH_ID . "'";
    } else if ($SYSTEM == 'Mediate' || $SYSTEM == 'MEDIATE' || $SYSTEM == '4') {
        $sql = "SELECT a.REF_WFR_ID AS CODE_API FROM WH_MEDIATE_CASE a WHERE a.WH_MEDAITE_ID ='" . $WH_ID . "'";
    }
    $query = db::query($sql);
    $rec = db::fetch_array($query);
    return $rec['CODE_API'];
}
?>
<script>
    function show_detial_2(SYSTEM_TYPE, IDCARD, CODE_API, TARGET_IDCARD) {
        var SEND_TO = '<?php echo $_GET['SEND_TO']; ?>'
        var url = "./search_data_show_detial2.php?SYSTEM_TYPE=" + SYSTEM_TYPE + "&IDCARD=" + IDCARD + "&SEND_TO=" + SEND_TO + "&CODE_API=" + CODE_API
        window.open(url, 'Image', 'width=1000px.stylewidth,height=1000px.style.height,resizable=1');
    }
</script>