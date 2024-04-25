<script>
    $(document).ready(function() {
        var setid = '<?php echo $_GET["SETTING_ID"]; ?>';
        var txt = 'กรุณาเลือก';
        var select_name = true;

        var table = '<?php echo $WF["API_TABLE_MAIN"]; ?>';
        var dataTable = 'proc=api_table&setid=' + setid + '&table=' + table;
        $.ajax({
            type: "GET",
            url: "../form/api_setting_ajax.php",
            data: dataTable,
            cache: false,
            dataType: 'Json',
            success: function(html) {
               // console.log(html);
                $('select#API_TABLE_MAIN').val(html.id).trigger('change');
                $('select#API_TABLE_MAIN').html('').select2().select2({
                    data: [{
                        id: '',
                        text: txt,
                        disabled: true,
                        selected: select_name
                    }]
                });
                $('select#API_TABLE_MAIN').select2({
                    data: html
                });
                $('select#API_TABLE_MAIN').select2("open");
                $('select#API_TABLE_MAIN').select2("close");
                $('select#API_TABLE_MAIN').select2({
                    placeholder: "เลือกรายการ",
                    allowClear: true
                });
            }
        });

        var field = '<?php echo $WF["API_FIELD"]; ?>';
        var dataField = 'proc=api_field&setid=' + setid + '&field=' + field + '&table=' + table;
        $.ajax({
            type: "GET",
            url: "../form/api_setting_ajax.php",
            data: dataField,
            cache: false,
            dataType: 'Json',
            success: function(html) {
               // console.log(html);
                $('select#API_FIELD').val(html.id).trigger('change');
                $('select#API_FIELD').html('').select2().select2({
                    data: [{
                        id: '',
                        text: txt,
                        disabled: true,
                        selected: select_name
                    }]
                });
                $('select#API_FIELD').select2({
                    data: html
                });
                $('select#API_FIELD').select2("open");
                $('select#API_FIELD').select2("close");
                $('select#API_FIELD').select2({
                    placeholder: "เลือกรายการ",
                    allowClear: true
                });
            }
        });
    });

    $("[name^=API_TABLE_MAIN]").change(function() {
        var tableMain = $(this).val();
        var setid = '<?php echo $_GET["SETTING_ID"]; ?>';
        var field = '<?php echo $WF["API_FIELD"]; ?>';

        var txt = 'กรุณาเลือก';
        var select_name = true;
        var dataField = 'proc=api_field&setid=' + setid + '&field=' + field + '&table=' + tableMain;
        $.ajax({
            type: "GET",
            url: "../form/api_setting_ajax.php",
            data: dataField,
            cache: false,
            dataType: 'Json',
            success: function(html) {
                //console.log(html);
                $('select#API_FIELD').val(html.id).trigger('change');
                $('select#API_FIELD').html('').select2().select2({
                    data: [{
                        id: '',
                        text: txt,
                        disabled: true,
                        selected: select_name
                    }]
                });
                $('select#API_FIELD').select2({
                    data: html
                });
                $('select#API_FIELD').select2("open");
                $('select#API_FIELD').select2("close");
                $('select#API_FIELD').select2({
                    placeholder: "เลือกรายการ",
                    allowClear: true
                });
            }
        });
    });
</script>