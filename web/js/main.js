/**
 * Created by dasha on 12.11.2017.
 */
$(document).ready(function(){
    lightGallery(document.getElementById('animated-thumbnails'), {
        thumbnail:true,
        animateThumb: false,
        showThumbByDefault: false
    });

    $('.likes').click(function () {
        var data,
            element = $(this);
        data = new FormData();
        data.append('review_id', element.attr('data-review'));
        $.ajax({
            url: '/site/like-review',
            type: "POST",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            dataType : 'json',
            success: function (data) {
                var counter = element.parents('.likes-counter').find('.counter');
                if(data.amount > 0) {
                    counter.html('' + data.amount + '');
                } else {
                    counter.html('');
                }
            }
        });
    });
});