!(function($) {
  "use strict";

  // Porfolio isotope and filter
  $(window).on('load', function() {
    var portfolioIsotope = $('.gallery-container').isotope({
      itemSelector: '.gallery-item'
    });

    $('#gallery-flters li').on('click', function() {
      $("#gallery-flters li").removeClass('filter-active');
      $(this).addClass('filter-active');

      portfolioIsotope.isotope({
        filter: $(this).data('filter')
      });
    });

    // Initiate venobox (lightbox feature used in portofilo)
    $(document).ready(function() {
      $('.venobox').venobox({
        'share': false
      });
    });
  });

  // Portfolio details carousel
  $(".gallery-details-carousel").owlCarousel({
    autoplay: true,
    dots: true,
    loop: true,
    items: 1
  });

})(jQuery);