$(function () {

    $('.spinner').fadeOut(500,function(){
        $(this).parent().fadeOut(1000);
        $('body').css({overflow:"auto"});
        $('.loading').remove();
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




//
// var flag= false;
//    $('#sendMail').on('submit',function (e) {
//        e.preventDefault();
//        var form= new FormData($(this)[0]);
//         var parent = $(this);
//
//        if(flag === false){
//           flag= true;
//            $.ajaxSetup({
//                headers: {
//                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
//                    'Access-Control-Allow-Origin': "*",
//                    'content-type':'application/json'
//                }
//            });
//            $.ajax({
//                'url':'http://localhost:8000/sendMail',
//                'type':'post',
//                'dateType':'json',
//                'processData': false,
//                'contentType': 'application/json',
//                'cacheProcess':false,
//                'cache': false,
//                'data':form,
//                'success':function (data) {
//                    flag= true;
//                    $('input:not([type="submit"]) , textarea').val('');
//                     $('.message').removeClass('alert-danger').addClass('alert-success').html(data).slideDown(1000,function () {
//                         $(this).delay(2000).slideUp(1000);
//                     });
//                },
//                'error':function (errors) {
//                    flag= false;
//                    message= $('.message');
//                  errors= errors.responseJSON.errors;
//                  var ap= [];
//                    message.html('');
//                   if(errors.name){
//                       ap.push(errors.name[0]);
//                   }
//                    if(errors.sender){
//                        ap.push(errors.sender[0]);
//                    }
//                    if(errors.phone){
//                        ap.push(errors.phone[0]);
//                    }
//                    if(errors.message){
//                        ap.push(errors.message[0]);
//                    }
//
//                    message.removeClass('alert-success').addClass('alert-danger');
//
//                    for (var i =0 ; i<=ap.length -1 ;i++) {
//                        message.append($('<p/>',{"text":ap[i ]}))
//                    }
//                    message.slideDown(1000,function () {
//                        $(this).delay(2000).slideUp(1000,function () {
//                            message.html('');
//                        });
//                    });
//                     ap=[];
//
//
//
//
//                }
//            });
//
//        }
//
//
//
//
//    })
    $('.message').slideDown('slow',function () {
        $(this).delay(2000).slideUp('slow');
    })










   /* $('.product-item').hover(function () {
       var pro= $(this);
       pro.children('.cover-text').css({
           "display":"block",
       });
            pro.children('.cover').css({
                "display":"block",
            });


    },
        function () {
            var pro= $(this);
            pro.children('.cover-text').css({
                "display":"none",

            });
            pro.children('.cover').css({
                "display":"none",
            });


        }
        );*/

});