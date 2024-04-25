  'use strict';
  $(document).ready(function() {
    window.addEventListener('resize', setHorMenu, false);
    window.addEventListener('load', setHorMenu, false);
    function setHorMenu(){
      var $window = $(window);
    	if($(window).width()>767){
       if($("body").hasClass("box-layout") == true){
          $("body").removeClass("fixed");
          $("body").addClass("container");
                  }
                    else{
                        $("body").addClass("fixed");
                    }
    	}
    else if($window.width() < 540 && $window.width() < 767){
        $(".main-header").css('margin-top','50px');
        $("body").removeClass("fixed");
         $("body").removeClass("container");
    }
    else if($window.width() > 540 && $window.width() < 767){
        $(".main-header").css('margin-top','0px');
        $("body").removeClass("fixed");
        $("body").removeClass("container");
    }
    
   
   }
 });


