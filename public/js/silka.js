$(function () {

    $('.spinner').fadeOut(500,function(){
        $(this).parent().fadeOut(1000);
        $('body').css({overflow:"auto"});
        $('.loading').remove();
    });


    $(function () {

        $('.delete').on('click',function (event) {
            event.preventDefault();
            var form= $(this).parent();
            if(confirm('This Item will be deleted, Are you sure?')){
                form.submit();
            }
        })


    });
    $('input:not([type="submit"])').on('focus',function () {
        var input= $(this);
        var text = input.attr('placeholder');
        var value = input.val();
        if(value == text) {
            input.val("");
        }


    });
    $('input:not([type="submit"])').on('blur',function () {
        var input= $(this);
        var text = input.attr('placeholder');
        var value = input.val();
        if(value === ""){
            input.val(text);
        }
    });


    $('.products').on('mouseover','.product-item',function () {
        var pro= $(this);
        pro.children('.cover-text').css({
            "display":"block",
        });
        pro.children('.cover').css({
            "display":"block",
        });
    });


    $('.products').on('mouseleave','.product-item',function (){
        var pro= $(this);
        pro.children('.cover-text').css({
            "display":"none",

        });
        pro.children('.cover').css({
            "display":"none",
        });

    });

    $('.res-work').on('click','p',function () {
        $(this).siblings('ul').slideToggle();
    });
    $('.res-work').on('click','li',function () {
        $(this).parent().slideToggle();
    });





   $('.our-work').on('click','.our-work-nav li',function () {
       $(this).addClass('active');
       $(this).siblings('li').removeClass('active');
   })




    $('.message').slideDown('slow',function () {
        $(this).delay(2000).slideUp('slow');
    })

});