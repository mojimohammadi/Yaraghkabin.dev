jQuery(document).ready(function ($) {
    $('.owl-post-carousel2').owlCarousel({
        center: false,
        loop: true,
        items: 6,
        lazyLoad: true,
        margin: 0,
        navigation: true,
        navText: ["<i class='fa fa-3x fa-chevron-left'></i>", "<i class='fa fa-3x fa-chevron-right'></i>"],
        responsive: {
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    });

});