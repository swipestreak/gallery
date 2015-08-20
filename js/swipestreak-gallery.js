(function($) {
    // give the page time to do it's thing before loading carousel
    setTimeout(function() {
        var carousel = $('#swipeStreakGalleryCarousel').elastislide({
            start: 1,
            orientation: 'vertical',
            onClick: function (el, pos, evt) {
                evt.preventDefault();
                el.siblings().removeClass("active");
                el.addClass("active");
                carousel.setCurrent(pos);

                var galleryImage = $('#swipeStreakGalleryImage').data('imagezoom');
                galleryImage.changeImage(el.find('img').attr('src'), el.find('img').data('largeimg'));
            },
            select: function(el, pos) {

            },
            onReady: function () {

                $('#swipeStreakGalleryImage').ImageZoom({
                    type: 'standard',
                    zoomSize: [480, 300],
                    offset: [10, -4],
                    zoomViewerClass: 'standardViewer',
                    position: 'left',
                    onShow: function (obj) {
                        obj.$viewer.hide().fadeIn(500);
                    },
                    onHide: function (obj) {
                        obj.$viewer.show().fadeOut(500);
                    }
                });

                $('#swipeStreakGalleryCarousel li:eq(1)').addClass('active');

                // change zoomview size when window resize
                $(window).resize(function () {
                    var galleryImage = $('#swipeStreakGalleryImage').data('imagezoom');
                    winWidth = $(window).width();
                    if (winWidth > 900) {
                        galleryImage.changeZoomSize(480, 300);
                    }
                    else {
                        galleryImage.changeZoomSize(winWidth * 0.4, winWidth * 0.4 * 0.625);
                    }
                });

            }
        });

        $('select.attribute_option.dropdown').on('change', function(e) {
            var val = $(this).val(),
                thumb = $('#swipeStreakGalleryCarousel li[data-oid="' + val + '"]'),
                el = thumb.closest('li'),
                pos = thumb.data('index');

            el.siblings().removeClass("active");
            el.addClass("active");
            carousel.setCurrent(pos);

            var galleryImage = $('#swipeStreakGalleryImage').data('imagezoom');
            galleryImage.changeImage(el.find('img').attr('src'), el.find('img').data('largeimg'));


        });

    }, 500);
})(jQuery);
