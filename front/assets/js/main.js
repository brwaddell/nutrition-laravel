(function($) {
  "use strict";
  /*-------------------------------------------
  preloader active
  --------------------------------------------- */
  jQuery(window).on('load',function() {
    jQuery('.preloader').fadeOut('slow');
  });
  
  jQuery(document).ready(function(){
    // mobile menu active code 
    $('.menu-bar').on('click', function(e) {
      e.preventDefault();
      $('.main-sidebar').toggleClass('show');
      $('.body-overlay').toggleClass('active');
    });
    $('.body-overlay').on('click', function() {
      $('.main-sidebar').removeClass('show');
      $(this).removeClass('active');
    });
    // search bar active 
    $('.mobile-search-icon').on('click', function() {
      $('.header-search').toggleClass('show');
    });
    /*-------------------------------------------
    niceSelect Active
    --------------------------------------------- */
    $('.select').niceSelect();
    /*-------------------------------------------
    js DataTable Active
    --------------------------------------------- */
    $('#myTable').DataTable();
    /*-------------------------------------------
    metismenu Active
    --------------------------------------------- */
    $("#metismenu").metisMenu();
    /*-------------------------------------------
    slider active
    --------------------------------------------- */
    $('.slider-active').slick({
      infinite: true,
      speed: 500,
      slidesToShow: 3,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 3000,
      centerMode: false,
      dots: false,
      arrows: true,
      prevArrow: '<i class="slick-prev arrow fas fa-angle-left"></i> ',
      nextArrow: '<i class="slick-next arrow fas fa-angle-right"></i> ',
      vertical: false,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
    /*-------------------------------------------
    js counterUp
    --------------------------------------------- */
    $('.counter').counterUp({
      delay: 10,
      time: 1000
    });
    /*-------------------------------------------
    toggle-password Active
    --------------------------------------------- */
    $(".toggle-password").on('click',function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $(this).parent().find("input");
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
    /*---------------------------------
    uplode profile image
    -----------------------------------*/
    $(function() {
      $('#fileuplode').change(function(event) {
        var imgurl = URL.createObjectURL(event.target.files[0]);
        $('#uplode-img').attr('src', imgurl);
      })
    });

  });

})(jQuery);