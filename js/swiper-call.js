jQuery(document).ready(function () {
  //initialize swiper when document ready
    var swiperHaendlerBilder = new Swiper ('.swiper-bs-galerie', {
      // Optional parameters
      slidesPerView: 'auto',
      spaceBetween: 16,
      loop: true,
      slidesPerGroup:1,
      speed:10000,
      autoplay: {
        delay: 1,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    })
  });