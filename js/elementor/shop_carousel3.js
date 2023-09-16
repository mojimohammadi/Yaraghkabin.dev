jQuery(document).ready(function($){
    let body = $('body');

    body.on('click', '.ahura-items-carousel .carousel-items .carousel-item', function(e){
        e.preventDefault();
        let btn = $(this), 
            contentID = btn.data('content'), 
            contentWrap = $('.carousel-content-' + contentID),
            contentWidth,
            contentCount,
            prevContentCount,
            contentWrapWidth, 
            position;
        if(contentWrap.length > 0){
            contentCount = contentWrap.parent().children('.carousel-content').length;
            contentWrapWidth = contentWrap.parent().width();
            contentWrap.parent().children('.carousel-content').removeClass('show');
            contentWrap.addClass('show');
            btn.parent().children('.carousel-item').removeClass('active');
            btn.addClass('active');
            prevContentCount = contentWrap.parent().children('.carousel-content').index(contentWrap.parent().children('.carousel-content.show'));
            position = prevContentCount * contentWrapWidth;
            contentWrap.parent().animate({
                left: $('body').hasClass('mw_ltr') ? -position : position
            }, 500, function () {
                contentWrap.parent().css('transform', '');
            });
        }
    });
});