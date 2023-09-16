document.addEventListener('DOMContentLoaded', function () {
  if(typeof window.Swiper != 'undefined'){
    const swiper = new Swiper('.swiper-items-carousel', {
      loop: true,
      slidesPerView: 1,
      observeParents: true,
      spaceBetween: 60,
      navigation: {
        nextEl: '.items-carousel-button-next',
        prevEl: '.items-carousel-button-prev',
      },
      autoplay: {
        delay: 1000,
      },
      breakpoints: {
        640: {
          slidesPerView: 1,
          spaceBetween: 15,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 30,
        },
        1024: {
            slidesPerView: 3,
            spaceBetween: 60,
        },
      },
    });
  }
})
