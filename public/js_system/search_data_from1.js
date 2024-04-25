$(document).ready(function () {
});
function modal_case() {
  var T_BLACK_CASE = $('#T_BLACK_CASE').val();
  var BLACK_CASE = $('#BLACK_CASE').val();
  var BLACK_YY = $('#BLACK_YY').val();
  var T_RED_CASE = $('#T_RED_CASE').val();
  var RED_CASE = $('#RED_CASE').val();
  var RED_YY = $('#RED_YY').val();
  var SEND_COURT_NAME = $('#SEND_COURT_NAME').val();
  var SYSTEM_ID = $('#SYSTEM_ID').val();
  var case_sh1 = $('#case_sh1').val();

  var SEND_TO = $('#SEND_TO').val();
  var REGISTERCODE = $('#REGISTERCODE').val();
  if (SEND_TO == '' || SEND_TO == null) {
    alert('กรุณาเลือกระบบงาน')
    $('#SEND_TO').focus();
    return false;
  }
  $.post('./search_data_process_A.php', {
    proc: "TO_SEND",
    REGISTERCODE: REGISTERCODE,
    T_BLACK_CASE: T_BLACK_CASE,
    BLACK_CASE: BLACK_CASE,
    BLACK_YY: BLACK_YY,
    T_RED_CASE: T_RED_CASE,
    RED_CASE: RED_CASE,
    RED_YY: RED_YY,
    SEND_COURT_NAME: SEND_COURT_NAME,
    SYSTEM_ID: SYSTEM_ID,
    case_sh1:case_sh1,
    SEND_TO:SEND_TO

  },
    function (data) {
      let rst = JSON.parse(data)
      console.log(rst)
      $(".modal_case").modal();
      $("#table_reture").html(rst['html']);
    }
  );

}


/* ----------------------------------------------------------------------------- */
$(document).ready(function () {

  load_file('<?php echo $id; ?>');

});

$(document).on('hide.bs.modal', '#bizModal_3440', function () {
  load_file('<?php echo $id; ?>');
})

$('button[type="submit"]').click(function (event) {
  // load_file('<?php echo $id; ?>');
});

function load_file(id) {
  $.ajax({
    url: '../form/order_official_ajax.php',
    type: 'POST',
    data: {
      fn: 'data_form',
      wfr: id
    },
  })
    .done(function (data) {
      // $('#wfs_show1441').remove();
      $('#wfs_show1441').remove();
      $("#wfsflow-3440").append("<tbody id='wfs_show1441'></tbody>");
      $('#wfs_show1441').append(data);
    });
}

$(document).ready(function () {
  $('button.close-modal').click(function () {
    var modal_number = $(this).attr('data-number');
    var modal_id = $(this).parents(':eq(3)').attr('id');
    $('#' + modal_number).modal('hide');
    $('#' + modal_id + ' .modal-title, #' + modal_id + ' .modal-body').html('');
  });
});