<footer class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="copyright_part_text text-center">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="footer-text m-0">
Copyright &copy; กรมบังคับคดี All rights reserved </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer part end-->

<!-- jquery plugins here-->
<!-- jquery
<script src="js/jquery-1.12.1.min.js"></script>-->
<!-- popper js -->
<script src="js/popper.min.js"></script>
<!-- bootstrap js -->
<script src="js/bootstrap.min.js"></script>
<!-- easing js -->
<script src="js/jquery.magnific-popup.js"></script>
<!-- swiper js -->
<script src="js/swiper.min.js"></script>
<!-- swiper js -->
<script src="js/masonry.pkgd.js"></script>
<!-- particles js -->
<script src="js/owl.carousel.min.js"></script>
<!--<script src="js/jquery.nice-select.min.js"></script>-->
<!-- swiper js
<script src="js/slick.min.js"></script>
<script src="js/jquery.counterup.min.js"></script>
<script src="js/waypoints.min.js"></script>-->
<!-- custom js
<script src="js/custom.js"></script>-->

<!-- Date Picker -->
<script>
  // $(document).ready(function(){
  //
  //   $('.input-daterange').datepicker({
  //   format: 'dd-mm-yyyy',
  //   autoclose: true,
  //   calendarWeeks : true,
  //   clearBtn: true,
  //   disableTouchKeyboard: true
  //   });
  //
  // });

  $(function () {

    // INITIALIZE DATEPICKER PLUGIN
    $('.datepicker12').datepicker({
        /*clearBtn: true,
        format: "dd/mm/yyyy"*/

        format: 'dd-mm-yyyy',
        autoclose: true,
        calendarWeeks : true,
        clearBtn: true,
        disableTouchKeyboard: true,
        orientation: "top" // add this for placemenet
    });



    // FOR DEMO PURPOSE
    $('#reservationDate').on('change', function () {
        var pickedDate = $('input').val();
        $('#pickedDate').html(pickedDate);
    });

    // select2
    $('select.select2').select2({
      allowClear: true,
      placeholder: "เลือก service"
    });


});



</script>


</body>
</html>
