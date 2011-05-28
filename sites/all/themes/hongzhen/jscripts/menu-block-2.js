(function($) {
  Drupal.behaviors.hongzhen_menu_block_2 = {};
  Drupal.behaviors.hongzhen_menu_block_2.attach = function(context){
    $('.menu-block-2').slideTabs({    
      btnPrev : '.prev',
      btnNext : '.next',
      btnDisabledClass: 'disabled',
      tabsList : '.menu',
      tabClass: 'leaf',
      tabActiveClass: 'active',
      orientation: 'horizontal',
      slideLength: 568,
      contentAnim: 'slideH',
      contentEasing: 'easeInOutExpo',
      tabsAnimTime: 300,
      contentAnimTime: 600
    });
    
    theActive = $('.menu-block-2 li.active');
    $('.menu-block-2 li').hover(
      function (){
        theActive.removeClass('active');
        $(this).addClass('active');
      }, 
      function(){
        $(this).removeClass('active');
        theActive.addClass('active');
      }
    );
    $('.menu-block-2 > .menu-wrapper > ul').addClass('sf-menu').superfish();
  }
})(jQuery);