(function($) {

"use strict";

if ($.fn.niceSelect) {
    $('select').niceSelect();
}

/*------------------------------------------------------------------

[Table of contents]



1. CUSTOM PRE DEFINE FUNCTION

2. MEANMENU INIT JS

3. DROPDOWN MENU RIGHT SIDE CUT FIXED

-------------------------------------------------------------------*/


/*--------------------------------------------------------------

1. CUSTOM PRE DEFINE FUNCTION

------------------------------------------------------------*/

/* is_exist() */

jQuery.fn.is_exist = function(){

  return this.length;

}


$(function(){


/*--------------------------------------------------------------

3. DROPDOWN MENU RIGHT SIDE CUT FIXED

--------------------------------------------------------------*/

$("#primary-menu li").on('mouseenter mouseleave', function (e) {

  if ($('ul', this).length) {

    // alert('55');

      var elm = $('ul.sub-menu', this);

      var off = elm.offset();

      var l = off.left;

      var w = elm.width();

      var docH = $(window).height();

      var docW = $(window).width();



      var isEntirelyVisible = (l + w <= docW);



      if (!isEntirelyVisible) {

          $(this).addClass('edge-submenu');

      } else {

          $(this).removeClass('edge-submenu');

      }

  }

});


$(".slicko-menu-close").on('click', function(){
  $('#site-header-menu').removeClass('toggled-on');
});



if ('object' != typeof (elementorFrontend)) {


  $('.main-navigation ul.navbar-nav>li').each(function (i, v) {
      $(v).find('a').contents().wrap('<span class="menu-item-text"/>')
  });
  $(".menu-item-has-children > a").append('<span class="dropdownToggle"><i class="fas fa-angle-down"></i></span>');

  if (jQuery('.slicko-main-menu-wrap').hasClass('menu-style-inline')) {
      if (jQuery(window).width() < 1025) {
          jQuery('.slicko-main-menu-wrap').addClass('menu-style-flyout');
      } else {
          jQuery('.slicko-main-menu-wrap').removeClass('menu-style-flyout');
      }

      $(window).resize(function () {
          if (jQuery(window).width() < 1025) {
              jQuery('.slicko-main-menu-wrap').addClass('menu-style-flyout');
          } else {
              jQuery('.slicko-main-menu-wrap').removeClass('menu-style-flyout');
          }
      })
  }


  function navMenu() {
      // main menu toggleer icon (Mobile site only)
      $('[data-toggle="navbarToggler"]').on("click", function (e) {
          $('.navbar').toggleClass('active');
          $('.navbar-toggler-icon').toggleClass('active');
          $('body').toggleClass('offcanvas--open');
          e.stopPropagation();
          e.preventDefault();

      });
      $('.navbar-inner').on("click", function (e) {
          e.stopPropagation();
      });

      // Remove class when click on body
      $('body').on("click", function () {
          $('.navbar').removeClass('active');
          $('.navbar-toggler-icon').removeClass('active');
          $('body').removeClass('offcanvas--open');
      });
      $('.main-navigation ul.navbar-nav li.menu-item-has-children>a').on("click", function (e) {
          e.preventDefault();
          $(this).siblings('.sub-menu').toggle();
          $(this).parent('li').toggleClass('dropdown-active');
      })
      $(".slicko-mega-menu> ul.sub-menu > li > a").unbind('click'); // Navbar moved up
  }

  navMenu();

}


});/*End document ready*/


$(window).load(function () {

  if ($.fn.masonry) {

    $('.blog-content-row .posts-row').masonry({

        // options

        itemSelector: '.posts-row>div',



    });

}

})



})(jQuery);













