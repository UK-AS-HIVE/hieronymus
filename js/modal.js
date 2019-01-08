/**
 *
 * <a href="#" data-modal-name="my-modal-1">POP</a>
 * <a href="javascript:modal('my-modal-1');">UP</a>
 *
 * <div class="modal-wrapper" name="my-modal-1">
 *   <div class="modal-left">
 *     video goes here
 *   </div>
 *   <div class="modal-right">
 *     text goes here
 *   </div>
 * </div>
 *
**/

(function($) {
  $(document).ready(function() {
    const hideActiveModal = function() {
      var visibleModal = $('.modal-wrapper.show');
      var left = visibleModal.find('.modal-left');
      var leftContents = left.html();
      visibleModal.removeClass('show');
      left.html(leftContents);
      var iframe = left.find('iframe');
      if (iframe) {
        var src = iframe.attr('src');
        if (src) {
          src = src.replace('?autoplay=1', '?autoplay=0');
          iframe.attr('src', src);
        }
      }
    }

    $(document).click(function(e) {
      if ($(e.target).parent('.modal-wrapper').length === 0) {
        hideActiveModal();
        $('body').removeClass('modal-open');
      }
    });

    const wrappers = $('.modal-wrapper');
    wrappers.each(function(i,e) {
      console.log("modal ", i, e);
      $(e).attr('data-index', i);
    });

    const modalCount = wrappers.length;
    const navigateModal = function(inc) {
      return function(e) {
        const currentIndex = $('.modal-wrapper.show').data('index');
        const newIndex = currentIndex+inc;
        console.log("navigating from modal #" + currentIndex + " to #"+newIndex);
        if (newIndex < 0 || newIndex > modalCount-1) {
          e.preventDefault();
          return false;
        }
        hideActiveModal();
        modal($('.modal-wrapper[data-index='+newIndex+']').attr('name'));
      }
    }
    const nextModal = navigateModal(1);
    const prevModal = navigateModal(-1);

    window.modal = function(modalName) {
      console.log("showing modal: ", modalName);
      var m = $('.modal-wrapper[name='+modalName+']');
      m.toggleClass('show');
      $('body').addClass('modal-open');
      var left = m.find('.modal-left');
      var leftContents = left.html();
      left.html(leftContents);

      var iframe = left.find('iframe');
      if (iframe) {
        var src = iframe.attr('src');
        if (src) {
          src = src.replace('?autoplay=0', '?autoplay=1');
          iframe.attr('src', src);
        }
      }

      if (!m.find('div.back-arrow').length) {
        m.append($('<div class="back-arrow arrows"></div>'));
      }
      if (m.data('index') == 0) {
        m.find('div.back-arrow').css({'color': '#d0d0d0'});
      } else {
        m.find('div.back-arrow').css({'color': '#005daa'});
      }
      m.find('div.back-arrow').unbind('click');
      m.find('div.back-arrow').click(prevModal);

      if (!m.find('div.forward-arrow').length) {
        m.append($('<div class="forward-arrow arrows"></div>'));
      }
      if (m.data('index') == modalCount-1) {
        m.find('div.forward-arrow').css({'color': '#d0d0d0'});
      } else {
        m.find('div.forward-arrow').css({'color': '#005daa'});
      }
      m.find('div.forward-arrow').unbind('click');
      m.find('div.forward-arrow').click(nextModal);
    };

    $('a[data-modal-name]').click(function (e) {
      e.preventDefault();
      modal($(e.target).data('modal-name'));
      return false;
    });
  });
})(jQuery);

