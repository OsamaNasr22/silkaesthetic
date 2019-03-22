
(function () {

    var currentImage= $('#currentImage');


    $('#content-slider').on('click touchstart','.image',   function changeCurrent(e) {
        var el =$(this);
        //img on it
        var image= el.children('picture').children('img');
        //all li element
        var images = $('.image');
        //remove all selected and active class on img element
        images.children('picture').children('img').removeClass('selected active')
        //all source element
        var sibsImage= image.siblings('source')
        //img src
        var imageSrc= image.attr('src');
        // remove class element from current image
        currentImage.removeClass('active');
        //add classes to the new current
        image.addClass('selected active');

        //sibs of current image
        var sibs=currentImage.siblings('source');
        // replace src of current image
        currentImage.attr('src',imageSrc)

        // replace srcset attribute in source element
        for (var i=0 ,c=sibs.length ;i< c ; i++ ){
            sibs[i].srcset = sibsImage[i].srcset
        }
    });


    $("#content-slider").lightSlider({
        loop:true,
        keyPress:true
    });
    $('#image-gallery').lightSlider({
        autoWidth: "106",
        gallery:true,
        item:1,
        thumbItem:9,
        slideMargin: 0,
        speed:500,
        auto:true,
        loop:true,
        onSliderLoad: function() {
            $('#image-gallery').removeClass('cS-hidden');
        }
    });
})();



//
// $(function () {
//
// });
