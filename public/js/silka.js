$(function () {

    $('input:not([type="submit"])').on('focus',function () {
        let input= $(this);
        let text = input.attr('placeholder');
        let value = input.val();
        if(value == text) {
            input.val("");
        }


    });
    $('input:not([type="submit"])').on('blur',function () {
        let input= $(this);
        let text = input.attr('placeholder');
        let value = input.val();
        if(value === ""){
            input.val(text);
        }
    });


    $('.products').on('mouseover','.product-item',function () {
        let pro= $(this);
        pro.children('.cover-text').css({
            "display":"block",
        });
        pro.children('.cover').css({
            "display":"block",
        });
    });


    $('.products').on('mouseleave','.product-item',function (){
        let pro= $(this);
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


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


let flag= false;
   $('#sendMail').on('submit',function (e) {
       e.preventDefault();
       let form= new FormData($(this)[0]);
        let parent = $(this);

       if(flag === false){
          flag= true;
           $.ajax({
               url:'http://localhost:8000/sendMail',
               type:'post',
               dateType:'json',
               processData: false,
               contentType: false,
               cache: false,
               data:form,
               success:function (data) {
                   flag= true;
                   $('input:not([type="submit"]) , textarea').val('');
                    $('.message').removeClass('alert-danger').addClass('alert-success').html(data).slideDown(1000,function () {
                        $(this).delay(2000).slideUp(1000);
                    });
               },
               error:function (errors) {
                   flag= false;
                   message= $('.message');
                 errors= errors.responseJSON.errors;
                 let ap= [];
                   message.html('');
                  if(errors.name){
                      ap.push(errors.name[0]);
                  }
                   if(errors.sender){
                       ap.push(errors.sender[0]);
                   }
                   if(errors.phone){
                       ap.push(errors.phone[0]);
                   }
                   if(errors.message){
                       ap.push(errors.message[0]);
                   }

                   message.removeClass('alert-success').addClass('alert-danger');

                   for (let i =0 ; i<=ap.length -1 ;i++) {
                       message.append($('<p/>',{"text":ap[i ]}))
                   }
                   message.slideDown(1000,function () {
                       $(this).delay(2000).slideUp(1000,function () {
                           message.html('');
                       });
                   });
                    ap=[];




               }
           });

       }




   })











   /* $('.product-item').hover(function () {
       let pro= $(this);
       pro.children('.cover-text').css({
           "display":"block",
       });
            pro.children('.cover').css({
                "display":"block",
            });


    },
        function () {
            let pro= $(this);
            pro.children('.cover-text').css({
                "display":"none",

            });
            pro.children('.cover').css({
                "display":"none",
            });


        }
        );*/

});