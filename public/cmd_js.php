<?php
?>
<script>
    //ของใหม่ เดิมใช้ getCasePersonData 
    function getCasePersonData(type) { //ดึงข้อมูลคน

        if (type == 1) { //คดีต้นทาง
            T_BLACK_CASE = $('#T_BLACK_CASE').val();
            BLACK_CASE = $('#BLACK_CASE').val();
            BLACK_YY = $('#BLACK_YY').val();
            T_RED_CASE = $('#T_RED_CASE').val();
            RED_CASE = $('#RED_CASE').val();
            RED_YY = $('#RED_YY').val();
            COURT_CODE = $('#COURT_CODE').val();
            SYSTEM_ID = $('#SYSTEM_ID').val();
        } else { //คดีปลายทาง
            T_BLACK_CASE = $('#TO_T_BLACK_CASE').val();
            BLACK_CASE = $('#TO_BLACK_CASE').val();
            BLACK_YY = $('#TO_BLACK_YY').val();
            T_RED_CASE = $('#TO_T_RED_CASE').val();
            RED_CASE = $('#TO_RED_CASE').val();
            RED_YY = $('#TO_RED_YY').val();
            COURT_CODE = $('#TO_COURT_CODE').val();
            SYSTEM_ID = $('#SEND_TO').val();
        }

        //สำหรับ bankoffice 
        //ถ้าไม่ใช้คนในbankoffice จะเยอะ
        var GET_PER_TYPE = "";
        var GET_PER_CASE = "<?php echo $_GET['GET_PERSON_CASE'] ?>";
        if (SYSTEM_ID == 5) {
            GET_PER_TYPE = $('input[name="GET_PER_TYPE"]:checked').val();
        }
        //stop

        //13 หลักของคนที่เลือกจากหน้าตรวจคน
        var REGISTER_CODE_MAIN = '<?php echo $_GET['REGISTER_CODE_MAIN']; ?>';
        var Ar = {
            'SYSTEM_ID': SYSTEM_ID, //ระบบงาน
            'REGISTER_CODE_MAIN': REGISTER_CODE_MAIN,
            'GET_PER_CASE': GET_PER_CASE
        };

        $.ajax({
            type: "POST",
            url: 'get_data_ajax.php',
            data: {
                proc: "getPersonJson_new",
                T_BLACK_CASE: T_BLACK_CASE,
                BLACK_CASE: BLACK_CASE,
                BLACK_YY: BLACK_YY,
                T_RED_CASE: T_RED_CASE,
                RED_CASE: RED_CASE,
                RED_YY: RED_YY,
                COURT_CODE: COURT_CODE,
                SYSTEM_ID: SYSTEM_ID,
                GET_PER_TYPE: GET_PER_TYPE,
                GET_PER_CASE: GET_PER_CASE,
                AR: Ar
            }, // serializes the form's elements.
            success: function(data) {
                $('#WF_Person_edit').hide();
                console.log(data)
                $('#wfs_show_person_new').html('');
                $('#wfs_show_person_new').html(data);
                $(document).ready(function() {
                    // เรียกใช้งาน select2 บน element ที่มีคลาส form-control select2
                    $('.form-control.select2').select2();
                });

                function getCaseTypePerson(register_code) {
                    $.ajax({
                            url: 'order_official_ajax.php',
                            type: 'POST',
                            data: {
                                fn2: 'get_service2',
                                id: $('#CMD_TYPE_PERSON_' + register_code).val(),
                                code: $('#SYSTEM_ID').val()
                            }
                        })
                        .done(function(data) {
                            $('#CASE_TYPE_PERSON_' + register_code).find('option').remove().end()
                            $('#CASE_TYPE_PERSON_' + register_code).append(data);
                        });
                }
            }
        });

    }

    function getCaseAsset(type) {
        if (type == 1) { //คดีต้นทาง
            T_BLACK_CASE = $('#T_BLACK_CASE').val();
            BLACK_CASE = $('#BLACK_CASE').val();
            BLACK_YY = $('#BLACK_YY').val();
            T_RED_CASE = $('#T_RED_CASE').val();
            RED_CASE = $('#RED_CASE').val();
            RED_YY = $('#RED_YY').val();
            COURT_CODE = $('#COURT_CODE').val();
            SYSTEM_ID = $('#SYSTEM_ID').val();
        } else { //คดีปลายทาง
            T_BLACK_CASE = $('#TO_T_BLACK_CASE').val();
            BLACK_CASE = $('#TO_BLACK_CASE').val();
            BLACK_YY = $('#TO_BLACK_YY').val();
            T_RED_CASE = $('#TO_T_RED_CASE').val();
            RED_CASE = $('#TO_RED_CASE').val();
            RED_YY = $('#TO_RED_YY').val();
            COURT_CODE = $('#TO_COURT_CODE').val();
            SYSTEM_ID = $('#SEND_TO').val();
        }

        //ข้อมูลเพิ่มเติม
        var Ar = {
            'data': '', //ระบบงาน
        };
        $.ajax({
            type: "POST",
            url: 'get_data_ajax.php',
            data: {
                proc: "getAsset_new",
                T_BLACK_CASE: T_BLACK_CASE,
                BLACK_CASE: BLACK_CASE,
                BLACK_YY: BLACK_YY,
                T_RED_CASE: T_RED_CASE,
                RED_CASE: RED_CASE,
                RED_YY: RED_YY,
                COURT_CODE: COURT_CODE,
                SYSTEM_ID: SYSTEM_ID,
                Ar: Ar
            }, // serializes the form's elements.
            success: function(response) {
                //console.log(response)
                $('#wfs_show_Asset_new').html(response);
                $('#WF_Asset_edit').hide();
                //function เรียกใช้หลังโหลดเสร็จ
                $(document).ready(function() {
                    // เรียกใช้งาน select2 บน element ที่มีคลาส form-control select2
                    $('.form-control.select2').select2();
                });


            }
        });
    }

    //ถ้าต้องการใช้ของเดิมให้ลบ _new ออก
    function getCasePersonData_new(type) { //ดึงข้อมูลคน
        if (type == 1) { //คดีต้นทาง
            T_BLACK_CASE = $('#T_BLACK_CASE').val();
            BLACK_CASE = $('#BLACK_CASE').val();
            BLACK_YY = $('#BLACK_YY').val();
            T_RED_CASE = $('#T_RED_CASE').val();
            RED_CASE = $('#RED_CASE').val();
            RED_YY = $('#RED_YY').val();
            COURT_CODE = $('#COURT_CODE').val();
            SYSTEM_ID = $('#SYSTEM_ID').val();
        } else { //คดีปลายทาง
            T_BLACK_CASE = $('#TO_T_BLACK_CASE').val();
            BLACK_CASE = $('#TO_BLACK_CASE').val();
            BLACK_YY = $('#TO_BLACK_YY').val();
            T_RED_CASE = $('#TO_T_RED_CASE').val();
            RED_CASE = $('#TO_RED_CASE').val();
            RED_YY = $('#TO_RED_YY').val();
            COURT_CODE = $('#TO_COURT_CODE').val();
            SYSTEM_ID = $('#SEND_TO').val();
        }

        //สำหรับ bankoffice 
        //ถ้าไม่ใช้คนในbankoffice จะเยอะ
        var GET_PER_TYPE = "";
        var GET_PER_CASE = "<?php echo $_GET['GET_PERSON_CASE'] ?>";
        if (SYSTEM_ID == 5) {
            GET_PER_TYPE = $('input[name="GET_PER_TYPE"]:checked').val();
        }
        //stop

        $.ajax({
            type: "POST",
            url: 'get_data_ajax.php',
            data: {
                proc: "getPersonJson",
                T_BLACK_CASE: T_BLACK_CASE,
                BLACK_CASE: BLACK_CASE,
                BLACK_YY: BLACK_YY,
                T_RED_CASE: T_RED_CASE,
                RED_CASE: RED_CASE,
                RED_YY: RED_YY,
                COURT_CODE: COURT_CODE,
                SYSTEM_ID: SYSTEM_ID,
                GET_PER_TYPE: GET_PER_TYPE,
                GET_PER_CASE: GET_PER_CASE
            }, // serializes the form's elements.
            success: function(data) {
                //exit();
                if (type > 0) {
                    var tb_person = "";
                    var i = 1;
                    const jsObject = JSON.parse(data);
                    const response = jsObject['data']
                    console.log('response')
                    console.log(response)
                    let disabled_status = "";
                    var checkedIdCard = "";
                    $.each(response, function(key, data_value) {

                        checkedIdCard = "";
                        disabled_status = "";
                        //alert($('#proc').val());

                        var REGISTER_CODE_MAIN = '<?php echo $_GET['REGISTER_CODE_MAIN']; ?>'
                        if ($('#proc').val() == 'add' && String(data_value.REGISTER_CODE) == REGISTER_CODE_MAIN) {
                            checkedIdCard = "checked";
                        }
                        /* AK 24/11/2023 */
                        if (SYSTEM_ID == 5) {
                            if ($('#proc').val() == 'add' && String(data_value.REGISTER_CODE) == GET_PER_CASE) {
                                checkedIdCard = "checked";
                            }
                        }

                        //alert(checkedIdCard);

                        var inputHidden = "";

                        var full_name = "";

                        if (data_value.PREFIX_NAME != null) {
                            full_name = data_value.PREFIX_NAME;
                            inputHidden = "<input type=\"hidden\" name=\"GET_PREFIX_NAME[" + data_value.REGISTER_CODE + "]\" id=\"GET_PREFIX_NAME\" value=\"" + data_value.PREFIX_NAME + "\">";
                        }
                        if (data_value.FIRST_NAME != null) {
                            full_name += data_value.FIRST_NAME;
                            inputHidden += "<input type=\"hidden\" name=\"GET_FIRST_NAME[" + data_value.REGISTER_CODE + "]\" id=\"GET_PREFIX_NAME\" value=\"" + data_value.FIRST_NAME + "\">";
                        }
                        if (data_value.LAST_NAME != null) {
                            full_name += " " + data_value.LAST_NAME;
                            inputHidden += "<input type=\"hidden\" name=\"GET_LAST_NAME[" + data_value.REGISTER_CODE + "]\" id=\"GET_PREFIX_NAME\" value=\"" + data_value.LAST_NAME + "\">";
                        }

                        var full_name = (data_value.PREFIX_NAME != null ? data_value.PREFIX_NAME : "") + '' + (data_value.FIRST_NAME != null ? data_value.FIRST_NAME : "") + ' ' + (data_value.LAST_NAME != null ? data_value.LAST_NAME : "");

                        tb_person += "<tr>";
                        if (checkedIdCard == 'checked') {
                            tb_person += "<td><label><input type=\"checkbox\"  name=\"LIST_REGISTER_CODE[" + data_value.REGISTER_CODE + "]\" id=\"LIST_REGISTER_CODE" + data_value.REGISTER_CODE + "\" value=\"" + data_value.REGISTER_CODE + "\" " + checkedIdCard + "  style='display: none;' ><i class='icofont icofont-tick-mark' title=''></i> " + i + "</label></td>";
                        } else {
                            tb_person += "<td><label><input type=\"checkbox\"  name=\"LIST_REGISTER_CODE[" + data_value.REGISTER_CODE + "]\" id=\"LIST_REGISTER_CODE" + data_value.REGISTER_CODE + "\" value=\"" + data_value.REGISTER_CODE + "\" " + checkedIdCard + " > " + i + "</label></td>";
                        }

                        tb_person += "<td>" + data_value.CONCERN_NAME + " : " + full_name + inputHidden + "</td>";

                        /* สอบถามความประสงค์ start AK */
                        var SEND_TO = "<?php echo $_GET['SEND_TO'] ?>";
                        if (SEND_TO == '1' || SEND_TO == '3' || SEND_TO == '4') { //เเพ่ง ฟื้นฟู ไกล่เกลี่ย
                            var CMD_TYPE_ID = '2';
                            if (SEND_TO == '1') {
                                var CMD_TYPE_CODE = "10201";
                            } else if (SEND_TO == '2') {
                                var CMD_TYPE_CODE = "20201";
                            } else if (SEND_TO == '3') {
                                var CMD_TYPE_CODE = "30201";
                            } else if (SEND_TO == '4') {
                                var CMD_TYPE_CODE = "40201";
                            }
                            getCaseTypePerson_edit(2, data_value.REGISTER_CODE, CMD_TYPE_CODE)
                        }
                        /* สอบถามความประสงค์ stop AK */
                        $.ajax({
                            type: "POST",
                            url: 'get_data_ajax.php',
                            async: false,
                            data: {
                                proc: 'getCmdType2',
                                REGISTER_CODE: data_value.REGISTER_CODE,
                                GET_CMD_TYPE_ID: CMD_TYPE_ID, //สอบถามความประสงค์
                                SEND_TO: SEND_TO
                            },
                            success: function(response2) {
                                tb_person += "<td>" + response2 + "</td>";
                            }
                        });
                        tb_person += "<td ><select  name=\"CASE_TYPE_PERSON[" + data_value.REGISTER_CODE + "]\" id=\"CASE_TYPE_PERSON_" + data_value.REGISTER_CODE + "\"  class=\"form-control select2\" tabindex=\"-2\" onChange=\"createTextDetail('" + data_value.REGISTER_CODE + "','" + full_name + "',$(this).val())\"></select></td>";
                        tb_person += "</tr>";
                        i++;
                    });

                    $('#wfs_show_person').html('');
                    $('#wfs_show_person').append(tb_person);

                    $('select.select2').select2({
                        allowClear: true,
                        placeholder: function() {
                            $(this).data('placeholder');
                        }
                    });

                }

            }
        });

    }
    //ถ้าต้องการใช้ของเดิมให้ลบ _new ออก
    function getCaseAsset_new(type) {

        var T_BLACK_CASE = "";
        var BLACK_CASE = "";
        var BLACK_YY = "";
        var T_RED_CASE = "";
        var RED_CASE = "";
        var RED_YY = "";
        var COURT_CODE = "";
        var SYSTEM_ID = "";
        console.log('getCaseAsset')
        console.log(type)
        if (type == 1) {
            T_BLACK_CASE = $('#T_BLACK_CASE').val();
            BLACK_CASE = $('#BLACK_CASE').val();
            BLACK_YY = $('#BLACK_YY').val();
            T_RED_CASE = $('#T_RED_CASE').val();
            RED_CASE = $('#RED_CASE').val();
            RED_YY = $('#RED_YY').val();
            COURT_CODE = $('#COURT_CODE').val();
            SYSTEM_ID = $('#SYSTEM_ID').val();
        } else {
            T_BLACK_CASE = $('#TO_T_BLACK_CASE').val();
            BLACK_CASE = $('#TO_BLACK_CASE').val();
            BLACK_YY = $('#TO_BLACK_YY').val();
            T_RED_CASE = $('#TO_T_RED_CASE').val();
            RED_CASE = $('#TO_RED_CASE').val();
            RED_YY = $('#TO_RED_YY').val();
            COURT_CODE = $('#TO_COURT_CODE').val();
            SYSTEM_ID = $('#SEND_TO').val();
        }

        $.ajax({
            type: "POST",
            url: 'get_data_ajax.php',
            data: {
                proc: "getAsset",
                T_BLACK_CASE: T_BLACK_CASE,
                BLACK_CASE: BLACK_CASE,
                BLACK_YY: BLACK_YY,
                T_RED_CASE: T_RED_CASE,
                RED_CASE: RED_CASE,
                RED_YY: RED_YY,
                COURT_CODE: COURT_CODE,
                SYSTEM_ID: SYSTEM_ID
            }, // serializes the form's elements.
            success: function(response) {
                var tb_asset = "";
                var i = 1;
                var data = JSON.parse(response);
                console.log(data)
                data = data['ASSET']
                $.each(data, function(key, data_value) {
                    console.log(key);
                    var inputHidden = "";

                    inputHidden = "<input type=\"hidden\" name=\"PROP_TITLE[" + data_value.ASSET_ID + "]\" id=\"PROP_TITLE_" + data_value.ASSET_ID + "\" value=\"" + data_value.PROP_TITLE + "\">";
                    inputHidden += "<input type=\"hidden\" name=\"PROP_STATUS_NAME[" + data_value.ASSET_ID + "]\" id=\"PROP_STATUS_NAME_" + data_value.ASSET_ID + "\" value=\"" + data_value.PROP_STATUS_NAME + "\">";
                    inputHidden += "<input type=\"hidden\" name=\"PROP_STATUS[" + data_value.ASSET_ID + "]\" id=\"PROP_STATUS_" + data_value.ASSET_ID + "\" value=\"" + data_value.PROP_STATUS + "\">";
                    inputHidden += "<input type=\"hidden\" name=\"TYPE_CODE[" + data_value.ASSET_ID + "]\" id=\"PROP_STATUS_" + data_value.ASSET_ID + "\" value=\"" + data_value.TYPE_CODE + "\">";
                    inputHidden += "<input type=\"hidden\" name=\"TYPE_DESC[" + data_value.ASSET_ID + "]\" id=\"TYPE_DESC_" + data_value.ASSET_ID + "\" value=\"" + data_value.TYPE_DESC + "\">";
                    inputHidden += "<input type=\"hidden\" name=\"CFC_CAPTION_GEN[" + data_value.ASSET_ID + "]\" id=\"CFC_CAPTION_GEN_" + data_value.ASSET_ID + "\" value=\"" + data_value.CFC_CAPTION_GEN + "\">";
                    inputHidden += "<input type=\"hidden\" name=\"M_ASSET_KEY[" + data_value.ASSET_ID + "]\" id=\"M_ASSET_KEY_" + data_value.ASSET_ID + "\" value=\"" + data_value.M_ASSET_KEY + "\">";
                    inputHidden += "<input type=\"hidden\" name=\"ASSET_TYPE_ID[" + data_value.ASSET_ID + "]\" id=\"ASSET_TYPE_ID_" + data_value.ASSET_ID + "\" value=\"" + data_value.ASSET_TYPE_ID + "\">";

                    tb_asset += "<tr>";
                    tb_asset += "<td><label><input type=\"checkbox\" name=\"ASSET_ID[" + data_value.ASSET_ID + "]\" id=\"ASSET_ID_" + data_value.ASSET_ID + "\" value=\"" + data_value.ASSET_ID + "\"> " + i + "</label></td>";
                    tb_asset += "<td><a onclick=\"show_asset_detail(" + data_value.ASSET_ID + ")\" href=\"javascript:void();\">" + data_value.PROP_TITLE + "" + inputHidden + "</a></td>";

                    /* สอบถามความประสงค์ start AK*/
                    var SEND_TO = "<?php echo $_GET['SEND_TO'] ?>";
                    console.log('SEND_TO')
                    console.log(SEND_TO)
                    if (SEND_TO == '1' || SEND_TO == '3' || SEND_TO == '4') { //เเพ่ง ฟื้นฟู ไกล่เกลี่ย
                        var CMD_TYPE_ID = '2';
                        if (SEND_TO == '1') {
                            var CMD_TYPE_CODE = "10202";
                        } else if (SEND_TO == '2') {
                            var CMD_TYPE_CODE = "20202";
                        } else if (SEND_TO == '3') {
                            var CMD_TYPE_CODE = "30202";
                        } else if (SEND_TO == '4') {
                            var CMD_TYPE_CODE = "40202";
                        }
                        getCaseType_edit(2, data_value.ASSET_ID, CMD_TYPE_CODE)
                    }
                    /* สอบถามความประสงค์ stop AK*/

                    $.ajax({
                        type: "POST",
                        url: 'get_data_ajax.php',
                        async: false,
                        data: {
                            proc: 'getCmdType',
                            ASSET_ID: data_value.ASSET_ID,
                            GET_CMD_TYPE_ID: CMD_TYPE_ID //สอบถามความประสงค์ห
                        },
                        success: function(response2) {
                            tb_asset += "<td>" + response2 + "</td>";

                        }
                    });

                    tb_asset += "<td><select name=\"CASE_TYPE[" + data_value.ASSET_ID + "]\" onchange=\"show_action_cmd(this.value,'" + data_value.ASSET_ID + "')\" id=\"CASE_TYPE_" + data_value.ASSET_ID + "\"  class=\"form-control select2\" tabindex=\"-2\"></select></td>";
                    tb_asset += "<td align=\"center\">" + data_value.PROP_STATUS_NAME + "</td>";
                    tb_asset += "<td align=\"center\"><input type='text' readonly name='input_show_action' id=\"input_show_action_" + data_value.ASSET_ID + "\"  class=\"form-control\"></td>";
                    tb_asset += "</tr>";

                    i++;
                });

                $('#wfs_show_asset').html('');
                $('#wfs_show_asset').append(tb_asset);

                $('select.select2').select2({
                    allowClear: true,
                    placeholder: function() {
                        $(this).data('placeholder');
                    }
                });
            }
        });
    }
</script>