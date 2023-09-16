let selectors = document.querySelectorAll('.offer-carousel-1 .product-discount-timer-wrap');
if(selectors != null && selectors !== undefined){
    selectors.forEach((item) => {
        let datetime = item.dataset.time;
        if(datetime){
            ahuraDatetimeToCountdown(datetime, document.querySelector('.offer-carousel-1 .product-discount-timer-wrap-' + item.dataset.id));
        }
    });
}