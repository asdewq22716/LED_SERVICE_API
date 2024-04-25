function WFS_UPDATE1441() {
    var row_num = $('#wfsflow-1441 tbody tr');
    if (row_num.length > 0) {
        $('#wfsflow-chk-1441').val(row_num.length);
    } else {
        $('#wfsflow-chk-1441').val('');
    }
    for (var x = 0; x < row_num.length; x++) {
        $('#wfsflow-1441 tbody tr:eq(' + x + ') td:eq(0)').html((x + 1));
    }
}

$('#wfs_show1441 input').blur(function() {
    WFS_UPDATE1441();
});
$(document).ready(function() {
    WFS_UPDATE1441();
});

$(document).ready(function() {
    $('select.select2').select2({
        allowClear: true,
        placeholder: function() {
            $(this).data('placeholder');
        }
    });
    $('select.select2-province').select2({
        allowClear: true,
        placeholder: 'เลือกจังหวัด'
    });
    $('select.select2-amphur').select2({
        allowClear: true,
        placeholder: 'เลือกอำเภอ'
    });
    $('select.select2-tambon').select2({
        allowClear: true,
        placeholder: 'เลือกตำบล'
    });
    $('textarea').autosize();
    $('input[maxlength]').maxlength();
    $(".datepicker, .datepicker_en").inputmask({
        mask: "99/99/9999"
    });
    $('.datepicker:not(:read-only)').datepicker({
        format: "dd/mm/yyyy",
        language: "th-th",
        autoclose: true,
        todayHighlight: true
    });
    $('.datepicker_en:not(:read-only)').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        todayHighlight: true
    });

    $("input:file[multiple]").change(function(e, v) {
        var input = document.getElementById(this.id);
        var img_name = [];
        for (var x = 0; x < input.files.length; x++) {
            img_name[x] = input.files[x].name;
        }
        $(this).parent().children('.md-form-file').val(img_name.join(', '));
    });
    $("input:file[single]").change(function(e, v) {
        var pathArray = $(this).val().split('\\');
        var img_name = pathArray[pathArray.length - 1];
        $(this).parent().children('.md-form-file').val(img_name);
    });
    $('textarea.max-textarea').maxlength({
        alwaysShow: true
    });
    $(".select2-single-amphur").select2({
        ajax: {
            url: "../process/load_area.php",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    qa: params.term
                };
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(obj) {
                        return {
                            id: obj.id,
                            text: obj.text
                        };
                    })
                };
            },
            cache: true
        },
        minimumInputLength: 2,
        allowClear: true
    });
    $(".select2-single-tambon").select2({
        ajax: {
            url: "../process/load_area.php",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    qt: params.term
                };
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(obj) {
                        return {
                            id: obj.id,
                            text: obj.text
                        };
                    })
                };
            },
            cache: true
        },
        minimumInputLength: 2,
        allowClear: true
    });
});
$(".wf_check_dup").blur(function() {
    var id_len = $(this).val().length;
    var chk_name = $(this).attr('name');
    var chk_val = $(this).val();
    if (id_len > 0) {
        var dataString = 'W=117&WFR=0&FIELD_N=' + chk_name + '&val=' + chk_val;
        $.ajax({
            type: "POST",
            url: "../workflow/load_dup.php",
            data: dataString,
            cache: false,
            success: function(data) {
                if (data == "D") {
                    $('#' + chk_name).addClass("bsf-warning");
                    $('#' + chk_name).removeClass("bsf-success");
                    $('#DUP_' + chk_name + '_ALERT').show();
                    $('#DUP_' + chk_name + '_ALERT').html('ข้อมูลนี้มีอยู่แล้วในระบบ');
                    $('#' + chk_name).attr('placeholder', chk_val);
                    $('#' + chk_name).val('');
                } else {
                    $('#' + chk_name).addClass("bsf-success");
                    $('#' + chk_name).removeClass("bsf-warning");
                    $('#DUP_' + chk_name + '_ALERT').hide();
                    $('#DUP_' + chk_name + '_ALERT').html('');
                }
            }
        });
    } else {
        $('#' + chk_name).attr('placeholder', '');
        $('#DUP_' + chk_name + '_ALERT').hide();
        $('#DUP_' + chk_name + '_ALERT').html('');
        $(this).removeClass("bsf-warning");
        $(this).removeClass("bsf-success");
    }
});
$(".idcard").inputmask({
    mask: "9-9999-99999-99-9"
});
$('.autonumber').autoNumeric('init');
$(".idcard").blur(function() {
    var id_len = $(this).val().length;
    if (id_len > 0) {
        var data = $(this).val().split('-');
        if (chkIDcard(data[0], data[1], data[2], data[3], data[4])) {
            $(this).addClass("bsf-success");
            $(this).removeClass("bsf-warning");
        } else {
            $(this).addClass("bsf-warning");
            $(this).removeClass("bsf-success");
            alert("กรุณากรอกข้อมูลให้ถูกต้อง");
            $(this).val('');
            $(this).focus();
        }
    } else {
        $(this).removeClass("bsf-warning");
        $(this).removeClass("bsf-success");
    }
});

$(".email").blur(function() {
    var em_len = $(this).val().length;
    if (em_len > 0) {
        if (valid2EMail($(this).val())) {
            $(this).addClass("bsf-success");
            $(this).removeClass("bsf-warning");
        } else {
            $(this).addClass("bsf-warning");
            $(this).removeClass("bsf-success");
        }
    } else {
        $(this).removeClass("bsf-warning");
        $(this).removeClass("bsf-success");
    }
});

function open_modal(url, head, modal_id) {
    console.log(url);
    console.log(head);
    console.log(modal_id);
    var id = typeof modal_id === 'undefined' ? 'bizModal' : 'bizModal' + modal_id;
    $('#' + id + ' .modal-title').text(head);
    $('#' + id + ' .modal-body').load(url);
}

function PopupCenter(url, title, w, h) {
    // Fixes dual-screen position                         Most browsers      Firefox
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

    // Puts focus on the newWindow
    if (window.focus) {
        newWindow.focus();
    }
}

function chkIDcard(SubCardID1, SubCardID2, SubCardID3, SubCardID4, SubCardID5) {
    var CardID = SubCardID1 + SubCardID2 + SubCardID3 + SubCardID4 + SubCardID5;
    var FcardID = (CardID.substr(0, 1)) * 13;
    for (i = 1; i < 12; i++) {
        var subNum = CardID.substr(i, 1);
        FcardID = parseInt(FcardID) + (parseInt(subNum) * (14 - (i + 1)));
    }
    chk = CardID.substr(CardID.length - 1, 1);
    temp = 11 - (parseInt(FcardID) % 11);
    temtStr = temp + '';
    chkAnswer = temtStr.substr(temtStr.length - 1, 1);
    if (parseInt(chk) == parseInt(chkAnswer)) {
        return true;
    } else {
        return false;
    }
}

function validLength(item, min, max) {
    return (item.length >= min) && (item.length <= max)
}

function valid2EMail(mailObj) {
    if (validLength(mailObj, 1, 50)) {
        //return false;
        if (mailObj.search("^.+@.+\\..+$") != -1)
            return true;
        else return false;
    }
    return true;
}

function get_amphur(province_obj, amphur_obj, tambon_obj, zipcode_obj, default_data) {
    var dataString = 'P=' + $('select#' + province_obj).val();
    var txt_a = 'เลือกอำเภอ';
    if ($('select#' + province_obj).val() == '10') {
        txt_a = 'เลือกแขวง';
    }
    $.ajax({
        type: "GET",
        url: "../process/load_area.php",
        data: dataString,
        cache: false,
        success: function(html) {
            console.log(html);
            $('select#' + amphur_obj).html('').select2({
                data: [{
                    id: '',
                    text: txt_a,
                    disabled: true,
                    selected: true
                }]
            });
            $('select#' + amphur_obj).select2({
                data: html
            });
            $('select#' + amphur_obj).select2("open");
            $('select#' + amphur_obj).select2("close");
            if (tambon_obj != "") {
                $('select#' + tambon_obj).html('').select2({
                    data: [{
                        id: '',
                        text: '',
                        disabled: true,
                        selected: true
                    }]
                });
            }
            if (zipcode_obj != "") {
                $('#' + zipcode_obj).val('');
            }
        }
    });
}

function get_tambon(province_obj, amphur_obj, tambon_obj, zipcode_obj, default_data) {
    var dataString = 'A=' + $('select#' + amphur_obj).val();
    var txt_a = 'เลือกตำบล';
    if ($('select#' + amphur_obj).val() != '') {
        if ($('select#' + amphur_obj).val().substring(0, 2) == '10') {
            txt_a = 'เลือกแขวง';
        }
    }
    $.ajax({
        type: "GET",
        url: "../process/load_area.php",
        data: dataString,
        cache: false,
        success: function(html) {
            $('select#' + tambon_obj).html('').select2({
                data: [{
                    id: '',
                    text: txt_a,
                    disabled: true,
                    selected: true
                }]
            });
            $('select#' + tambon_obj).select2({
                data: html
            });
            $('select#' + tambon_obj).select2("open");
            $('select#' + tambon_obj).select2("close");
            if (zipcode_obj != "") {
                $('#' + zipcode_obj).val('');
            }
        }
    });
}

function get_zipcode(province_obj, amphur_obj, tambon_obj, zipcode_obj) {

    if (zipcode_obj != "") {

        var dataString = 'T=' + $('#' + tambon_obj).val();

        $.ajax({
            type: "GET",
            url: "../process/load_area.php",
            data: dataString,
            cache: false,
            success: function(html) {
                $('#' + zipcode_obj).val(html);
            }
        });
    }
}

function wf_file_d(w, f, wfr, txt) {
    if (w != '' && f != '' && wfr != '') {
        swal({
                title: "",
                text: "คุณต้องการลบรายการนี้หรือไม่?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "ยืนยันการลบ",
                cancelButtonText: "ยกเลิก",
                closeOnConfirm: true
            },
            function() {
                var dataString = 'process=d&wfr=' + wfr + '&W=' + w + '&f=' + f;
                $.ajax({
                    type: "POST",
                    url: "../workflow/wf_file_d.php",
                    data: dataString,
                    cache: false,
                    success: function(html) {
                        /*swal({
                        title: "บันทึกตำแหน่งเรียบร้อยแล้ว",
                        type: "success",
                        allowOutsideClick:true
                        });*/
                        $('#BSA_FILE' + f).hide();
                    }
                });

            });
    }
}
$(window).scroll(function() {
    if ($(this).scrollTop() > 600) {
        $('.scrollup').fadeIn();
    } else {
        $('.scrollup').fadeOut();
    }
});

$('.scrollup').click(function() {
    $("html, body").animate({
        scrollTop: 0
    }, 600);
    return false;
});

function delete_wf_main(w, wfr) {
    if (w != '' && wfr != '') {
        swal({
                title: "",
                text: "คุณต้องการลบรายการนี้หรือไม่?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "ยืนยันการลบ",
                cancelButtonText: "ยกเลิก",
                closeOnConfirm: true
            },
            function() {
                var dataString = 'process=del&W=' + w + '&WFR=' + wfr;
                $.ajax({
                    type: "POST",
                    url: "../workflow/workflow_del_function.php",
                    data: dataString,
                    cache: false,
                    success: function(html) {
                        $('#tr_wf_' + wfr).hide();
                    }
                });
            });
    }
}

function number_format(num, digit) {
    var p = num.toFixed(digit).split(".");
    var x = p[0].split("").reverse().reduce(function(acc, num, i, orig) {
        return num + (i && !(i % 3) ? "," : "") + acc;
    }, "");
    if (digit > 0) {
        return x + "." + p[1];
    } else {
        return x;
    }

}

function bsf_del_form(W, WFS, WFR, F_TEMP_ID, WFD, FID) {
    if (W != '' && WFS != '' && FID != '') {
        swal({
                title: "",
                text: "คุณต้องการลบรายการนี้หรือไม่??",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "ยืนยันการลบ",
                cancelButtonText: "ยกเลิก",
                closeOnConfirm: true
            },
            function() {
                var dataString = 'process=d&W=' + W + '&f=' + FID;
                $.ajax({
                    type: "POST",
                    url: "../workflow/wf_form_d.php",
                    data: dataString,
                    cache: false,
                    success: function(html) {
                        $('#bsf_f_id' + FID).remove();
                        var func = 'WFS_UPDATE' + WFS + '()';
                        setTimeout(func, 1);
                    }
                });
            });
    }
}

function type_doc(id) {
    document.getElementById("export_type").value = id;
}

function export_file() {
    document.getElementById("export_content").value = document.getElementById("export_data").innerHTML;
    document.getElementById("form_export").action = "../workflow/export_report.php";
    document.getElementById("form_export").submit();
}
														
                                                        </script>