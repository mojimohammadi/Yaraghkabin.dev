const handleShopCarousel2Element = function (){
    let is_rtl = jQuery('body').hasClass('mw_rtl') ? true : false;
    jQuery('.shop-carousel2-element .owl-shop-carousel2').owlCarousel({
        center: false,
        loop: true,
        items: 6,
        lazyLoad: true,
        rtl: is_rtl,
        margin: 0,
        navigation:true,
        navText : ["<i class='fa fa-3x fa-chevron-left'></i>","<i class='fa fa-3x fa-chevron-right'></i>"],
        responsive:{
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
}

jQuery(document).ready(function ($) {
    handleShopCarousel2Element();
});