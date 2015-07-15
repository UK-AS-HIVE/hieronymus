(function($){
  var browserWidth;
  var executed = false;
  $(document).ready(function(){

    // Contact Form
    $('input, textarea').focus(function(){
        $(this).removeClass('edited');
    }).blur(function(){
        $(this).addClass('edited');
        if ($('form:valid').length > 0) {
            $('form:valid').addClass('valid');
        }
        else {
            $('form.valid').removeClass('valid');
        }
    });

    function doesSlider() {
      $('.slide').each(function(i, obj) {
        var slideWrapper = $(obj);
        var classes = slideWrapper.attr('class').split(' ');
        var fullPerRow;
        $.each(classes, function(j, cl){
          if (cl.match(/slide-\d/g) != null) {
            fullPerRow = cl.substr(cl.length-1);
          }
        });

        //Initialiaze slider functionality
        currentPerRow = fullPerRow;
        maxWidth = 1200;
        minColumnWidth = 0.95;
        browserWidth = $(window).width();

        while ((browserWidth/currentPerRow) < (maxWidth * minColumnWidth)/fullPerRow) {
          $('.view-content').css('left', 0 + "%");
          slideWrapper.attr('data-page', 1);
          currentPerRow--;
        }

        function setup() {
            if (!executed) {
                console.log(executed);
                executed = true;
                slideWrapper.attr('data-page', 1).attr('data-page-row', fullPerRow).attr('data-current-row', currentPerRow);
                console.log('ran');
            }
        };
        setup();
    
        galleryLength=$(this).find('.views-row').length; //finding number of elements in slider
        maxPage=Math.ceil(galleryLength/currentPerRow); //finding the max page number of slider depending on number of columns
        sliderWidth = maxPage * 100; //Finding the width as a percentage of the slider
        galleryRounded = Math.ceil(galleryLength/currentPerRow)*currentPerRow; //Rounding number of gallery elements to nearest multiple of number of columns
        $(this).find('.view-content').css('width', sliderWidth + '%'); //Setting width of slider using sliderWidth
        $(this).find('.views-row').css('width', (100/galleryRounded) + '%'); //Setting width of gallery elements as percentage based on galleryRounded

        $($('.has-columns').has($(this))[0]).find('#forward-arrow').unbind("click").click(function () {
            if(slideWrapper.attr('data-page') < maxPage) {
                slideWrapper.attr('data-page', Number(slideWrapper.attr('data-page'))+1);
                move=100*(Number(slideWrapper.attr('data-page')-1));
                $('.has-columns').has(this).find('.view-content').css('left', -move + "%");
            }
            updateSilder(slideWrapper,this)
        });
        $($('.has-columns').has($(this))[0]).find('#back-arrow').unbind("click").click(function () {
            if(slideWrapper.attr('data-page') > 1) {
                slideWrapper.attr('data-page', Number(slideWrapper.attr('data-page'))-1);
                move=100*(Number(slideWrapper.attr('data-page')-1));
                $('.has-columns').has(this).find('.view-content').css('left', -move + "%");
            }
            updateSilder(slideWrapper,this)
        });
        updateSilder(slideWrapper,this)
      });
    };

    function updateSilder(slideWrapper,that){
      if (slideWrapper.attr('data-page') == 1) {
        $('.has-columns').has(that).find('#back-arrow').css('display', 'none');
      }
      else if (slideWrapper.attr('data-page') > 1) {
        $('.has-columns').has(that).find('#back-arrow').css('display', 'block');
      }

      if (slideWrapper.attr('data-page') >= maxPage) {
        $('.has-columns').has(that).find('#forward-arrow').css('display', 'none');
      }
      else {
        $('.has-columns').has(that).find('#forward-arrow').css('display', 'block');
      }
    }

    function doesTabs() {

        $('ul.tabbed').each(function() {

            var tabs = $(this).find('li');
            var tabsNumber = tabs.length;
            var findWidth = ($(this).width())/tabsNumber;
            $(tabs).css('width', findWidth);
          
            var currentTab = 1;
            var currentContent = 1;

            var wrapperHas = $('.tab-all-wrapper').has($(this));

            $(this).find('li:first-of-type').addClass('current');
            wrapperHas.find('.tab-content div:first-of-type').addClass('current');
            
            tabs.each(function() {
                $(this).attr("data-tab", currentTab);
                currentTab++; 
            });
            
            wrapperHas.find('.tab-content div').each(function() {
                $(this).addClass('data-tab-' + currentContent);
                currentContent++;
            })

            tabs.click(function(){   
                tabs.removeClass('current');
                $(this).addClass('current');
                
                wrapperHas.find('.tab-content div').removeClass('current');
                var data = $(this).attr('data-tab');
                wrapperHas.find('.tab-content div.data-tab-' + data).addClass('current');
            });
            
        });
    };

    doesTabs();
    doesSlider();

    $(window).resize(function() {
      doesSlider();
      doesTabs();
    });
  });
})(jQuery)
