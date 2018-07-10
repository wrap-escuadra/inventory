$(document).ready(function() {
    $('.js-like-article').on('click',function (e) {
        e.preventDefault();
        var $link = $(this);
        $link.toggleClass('fa-heart-o').toggleClass('fa-heart');

        $.ajax({
            method: 'POST',
            url: $link.attr('href'),
        }).done(function(data){
            $('.js-like-article-count').html(data.hearts);
        });

        // var likeCtr = parseInt($('.js-like-article-count').html());
        // if($link.hasClass('fa-heart')){
        //     likeCtr ++;
        // }else{
        //     likeCtr --;
        // }
        // $('.js-like-article-count').html( likeCtr);
    })
});
