/*
* shortcodes.js v1.0.0
*/

jQuery(document).ready(function($){
  
  /* ------------------------------------------------------------------------ */
  /* Accordion */
  /* ------------------------------------------------------------------------ */
  
  if( $(".accordion .accordion-title").hasClass('active') ){
    $(".accordion .accordion-title.active").closest('.accordion').find('.accordion-inner').show();
  }
  
  $(".accordion .accordion-title").click(function(){
    if( $(this).hasClass('active') ){
      $(this).removeClass("active").closest('.accordion').find('.accordion-inner').slideUp(200);
    }
    else{
      $(this).addClass("active").closest('.accordion').find('.accordion-inner').slideDown(200);
    }
  });


  /* ------------------------------------------------------------------------ */
  /* Tabs */
  /* ------------------------------------------------------------------------ */
  
  $('div.tabset').tabset();

});



/* Tabset Function ---------------------------------- */
(function ($) {
$.fn.tabset = function () {
  var $tabsets = $(this);
  $tabsets.each(function (i) {
    var $tabs = $('li.tab a', this);
    $tabs.click(function (e) {
      var $this = $(this);
      panels = $.map($tabs, function (val, i) {
        return $(val).attr('href');
      });
      $(panels.join(',')).hide();
      $tabs.removeClass('selected');
      $this.addClass('selected').blur();
      $($this.attr('href')).show();
      e.preventDefault();
      return false;
    }).first().triggerHandler('click');
  });
};
})(jQuery);

/* ------------------------------------------------------------------------ */
/* EOF */
/* ------------------------------------------------------------------------ */