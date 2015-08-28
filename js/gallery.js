(function($){
  $(document).ready(function(){
    // Initialize Gallery
    var gallery = $('.view-display-id-main_gallery');
    gallery.addClass('js-gallery').find('.views-row-first').addClass('photo-current');

    setPhotos();

    function setPhotos() {
      var current = $('.photo-current');
      var next = current.next();
      var prev = current.prev();

      if (next.length > 0) {
        next.addClass('photo-next');
        gallery.addClass('with-next');
      }
      else gallery.removeClass('with-next');

      if (prev.length > 0) {
        prev.addClass('photo-prev');
        gallery.addClass('with-prev');
      }
      else gallery.removeClass('with-prev');
    }
    function removeRowClasses() {
      gallery.find('.views-row').removeClass('photo-prev photo-current photo-next');
    }

    $('.gallery-control').click(function(){
      if($(this).hasClass('next') && gallery.hasClass('with-next')) {
        var newCurrent = $('.photo-next');
        removeRowClasses();
        newCurrent.addClass('photo-current');
        setPhotos();
      }
      else if($(this).hasClass('prev') && gallery.hasClass('with-prev')) {
        var newCurrent = $('.photo-prev');
        removeRowClasses();
        newCurrent.addClass('photo-current');
        setPhotos();
      }
    });

    // Thumbnail Navigation
    $('.view-display-id-thumbs .views-row').click(function(){
      removeRowClasses();
      console.log(gallery.find('.views-row'));
      gallery.find('.views-row').eq($(this).index()).addClass('photo-current');
      setPhotos();
    });
  });
})(jQuery);