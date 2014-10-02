/**
 *
 * Functions
 *
 * @file           functions.js
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.1
 * @filesource     wp-content/themes/editit/framework/ja/functions.js
 */

jQuery(document).ready(function($){

  /* ------------------------------------------------------------------------ */
  /* Image Hovers */
  /* ------------------------------------------------------------------------ */

  /* ------ Link (Archive Page)------- */
  $("a.link").hover(function(){

    $(this).has('img').append('<div class="overlay"></div>');
    $(this).has('img').append('<div class="overlay-link"><i class="icon icon-plus"></i></div>');
    $(this).find('.overlay').animate({opacity : '1'}, 300);
    $(this).find('.overlay-link').animate({opacity : '1'}, 300);
  }, function(){
    $(this).find('.overlay').animate({opacity : '0'}, 300 ,function(){ 
      $(this).remove(); 
    });
    $(this).find('.overlay-link').animate({opacity : '0'}, 300 ,function(){ 
      $(this).remove(); 
    });
  });


  /* ------ External Link (Archive Page)------- */
  $("a.external-link").hover(function(){

    $(this).has('img').append('<div class="overlay"></div>');
    $(this).has('img').append('<div class="overlay-link"><i class="icon icon-external-link-square"></i></div>');
    $(this).find('.overlay').animate({opacity : '1'}, 300);
    $(this).find('.overlay-link').animate({opacity : '1'}, 300);
  }, function(){
    $(this).find('.overlay').animate({opacity : '0'}, 300 ,function(){ 
      $(this).remove(); 
    });
    $(this).find('.overlay-link').animate({opacity : '0'}, 300 ,function(){ 
      $(this).remove(); 
    });
  });


  /* ------ Lightbox (Single Page)------- */
  $("a.lightbox").hover(function(){

    $(this).has('img').append('<div class="overlay"></div>');
    $(this).has('img').append('<div class="overlay-lightbox"><i class="icon icon-search"></i></div>');
    $(this).find('.overlay').animate({opacity : '1'}, 300);
    $(this).find('.overlay-lightbox').animate({opacity : '1'}, 300);
  }, function(){
    $(this).find('.overlay').animate({opacity : '0'}, 300 ,function(){ 
      $(this).remove(); 
    });
    $(this).find('.overlay-lightbox').animate({opacity : '0'}, 300 ,function(){ 
      $(this).remove(); 
    });
  });



  /* ------------------------------------------------------------------------ */
  /* Back To Top */
  /* ------------------------------------------------------------------------ */
  $(window).scroll(function(){
    if($(window).scrollTop() > 200){
      $("#back-to-top").fadeIn(200);
    } else{
      $("#back-to-top").fadeOut(200);
    }
  });
  
  $('#back-to-top').click(function() {
      $('html, body').animate({ scrollTop:0 }, '800');
      return false;
  });



  /* ------------------------------------------------------------------------ */
  /* FAQ */
  /* ------------------------------------------------------------------------ */
  $('.faq-categories a').click(function(){
    $('.faq-categories a').removeClass('active');
    $(this).addClass('active');
    var selector = $(this).attr('data-filter');
    $('.faq-list section').not(selector).fadeOut("normal");
    $('.faq-list section' + selector).fadeIn("normal");
    if(selector == '*'){ $('.faq-list section').fadeIn("normal"); }
    return false;
  });

  $(".faq-item dt").click(function(){
    if( $(this).hasClass('active') ){
      $(this).removeClass("active").closest('.faq-item').find('dd').slideUp(
        {
          duration: "normal",
          easing: "linear",
        }
      );
    }else{
      $(this).addClass("active").closest('.faq-item').find('dd').slideDown(
        {
          duration: "normal",
          easing: "linear",
        }
      );
    }
  });


  /* ------------------------------------------------------------------------ */
  /* Tooltip */
  /* ------------------------------------------------------------------------ */

  $('.topbar .social-icons li a').tooltip({placement: 'bottom'});
  $('.copyright .social-icons li a').tooltip({placement: 'top'});
  $('.sharebox .social-icons li a').tooltip({placement: 'bottom'});
  $('.author-info .social-icons li a').tooltip({placement: 'bottom'});
  $('.member-social .social-icons li a').tooltip({placement: 'top'});



});
/* ------------------------------------------------------------------------ */
/* EOF
/* ------------------------------------------------------------------------ */