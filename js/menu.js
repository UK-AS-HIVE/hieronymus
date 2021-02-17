(function($){
  $(document).ready(function(){
    var body = $('body');

    $('#menu-toggle').click(function(){
      body.toggleClass('menu-open');
    });
    $('#shadow').click(function(){
      body.removeClass('menu-open');
    });
    window.addEventListener('hashchange', function() {
      body.removeClass('menu-open');
    });

    $('.region-navigation .menu li.expanded').click(function(e){
      if (body.hasClass('menu-open')) {
        $(this).toggleClass('open');
        e.stopPropagation();
      }
    });

    $('.region-navigation .content > .menu > li.expanded').hover(function(){
      body.addClass('desktop-menu-open');
    }, function(){
      body.removeClass('desktop-menu-open');
    });
    $('.region-navigation .menu li.expanded a').click(function(e){
      e.stopPropagation();
    });

    // Book Nav
    $('.book-explorer li.expanded > a').after($('<a class="book-toggle"><i class="fa fa-caret-right"></i></a>'));
    $('.book-toggle').click(function(){
      $(this).next().slideToggle(200);
      $(this).parent().toggleClass('open');
    });
    $('.book-explorer > .menu .menu').each(function(i, item) {
      console.log(item);
      if ($(item).find('a.active').length == 0 && $(item).siblings('a.active').length == 0) {
        $(item).hide();
        console.log(item);
      }
      else {
        $(item).parent().addClass('open active-book');
      }
    });
  });
})(jQuery)
