// Scroll to Top
window.onscroll = function() {
  const car_exhibition_button = document.querySelector('.scroll-top-btn');
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    car_exhibition_button.style.display = "block";
  } else {
    car_exhibition_button.style.display = "none";
  }
};

document.querySelector('.scroll-top-btn a').onclick = function(event) {
  event.preventDefault();
  window.scrollTo({top: 0, behavior: 'smooth'});
};

// Main Slider
jQuery(document).ready(function($) {
  const section = $('.slider-section');
  const owl = section.find('.owl-carousel').owlCarousel({
    loop: true,
    nav: false,
    dots: false,
    rtl: false,
    items: 1,
    autoplay: true,
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',
  });

  // Custom navigation buttons
  section.find('.custom-next').click(function() {
    owl.trigger('next.owl.carousel');
  });

  section.find('.custom-prev').click(function() {
    owl.trigger('prev.owl.carousel');
  });
});

// event Slider
jQuery(document).ready(function($) {
  const section = $('.event-section');

  const owl = section.find('.owl-carousel').owlCarousel({
    loop: true,
    nav: false,
    dots: false,
    rtl: false,
    autoplay: true,
    margin: 30, // spacing between cards
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',

    responsive: {
      0: {        
        items: 1
      },
      768: {
        items: 2
      },
      992: {
        items: 3
      }
    }
  });

  // Custom navigation
  section.find('.custom-next').click(function() {
    owl.trigger('next.owl.carousel');
  });

  section.find('.custom-prev').click(function() {
    owl.trigger('prev.owl.carousel');
  });
});


