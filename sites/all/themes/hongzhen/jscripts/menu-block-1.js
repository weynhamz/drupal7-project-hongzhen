(function($) {
  Drupal.behaviors.hongzhen_menu_block_1 = {};
  Drupal.behaviors.hongzhen_menu_block_1.attach = function(context){
    $('.menu').each(function(){
      $('li.expanded ul.menu', this).hide();
      $('li.active-trail > ul.menu', this).show();
      $('li a',this).click(function(e) {
        e.stopImmediatePropagation();
        var theElementParent = this.parentNode.parentNode;
        var theElementCurrent = $(this).next();
        var theElementVisiable = $('.menu:visible',theElementParent).first();
        if(theElementCurrent.hasClass('menu')) {
          if(theElementCurrent.is(':visible')) {
            if($(theElementParent).hasClass('collapsible')) {
              theElementVisiable.slideUp('normal');
            }
          } else {
            theElementVisiable.slideUp('normal');
            theElementCurrent.slideDown('normal');
          }
          return false;
        }
        return true;
      });
    });
  }
})(jQuery);