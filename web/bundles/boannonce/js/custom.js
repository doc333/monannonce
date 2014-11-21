(function ($) { 
    $(document).ready(function(){
        $(".wrap").css('min-height', $(window).height()-$('#footer').height()-$('.navbar').height()-110);
      }); 
})(jQuery); 