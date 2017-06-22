'use strict';

/*------------------------------------------------------------------
 SLIDER
 -----------------------------------------------------------------*/

$('#sl2').slider();

/*------------------------------------------------------------------
 CARTEGORIES
 -----------------------------------------------------------------*/
$('.catalog').dcAccordion();

/*------------------------------------------------------------------
 CART
 -----------------------------------------------------------------*/

function showCart(cart) {
    $('#cart .modal-body').html(cart);
    $('#cart').modal();
}

$('.add-to-cart').on('click', function (e) {
    e.preventDefault();
    var id = $(this).data('id'),
        qty = $('#qty').val();
    $.ajax({
        url: '/cart/add',
        data: {id: id, qty: qty},
        type: 'GET',
        success: function (res) {
            if (!res) throw new Error('Error add to cart!');
            showCart(res);
        },
        error: function () {
            throw new Error('Error ajax!');
        }
    });
});

$('#clearCart').on('click', function (e) {
    e.preventDefault();
    $.ajax({
        url: '/cart/clear',
        type: 'GET',
        success: function (res) {
            if (!res) throw new Error('Error!');
            showCart(res);
        },
        error: function () {
            throw new Error('Error ajax!');
        }
    });
});

$('#cart .modal-body').on('click', '.del-item', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: '/cart/del-item',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            if (!res) throw new Error('Error add to cart!');
            showCart(res);
        },
        error: function () {
            throw new Error('Error ajax!');
        }
    });
});

$('#cartBtn').on('click', function (e) {
    e.preventDefault();

    $.ajax({
        url: '/cart/show',
        type: 'GET',
        success: function (res) {
            if (!res) throw new Error('Error add to cart!');
            showCart(res);
        },
        error: function () {
            throw new Error('Error ajax!');
        }
    });
});

/*------------------------------------------------------------------
 delete product image
 -----------------------------------------------------------------*/
//клик на удалении
$(document).on("click", '.delete_img', function (e) {
    e.preventDefault();
    var isTrue = confirm("Удалить изображение?");
    if(isTrue==true){
        var href=$(this).attr('href');
        $(this).parent('div').remove();
        $.get( href );
    }
});

/*------------------------------------------------------------------------------
 DEBOUNCE
 ------------------------------------------------------------------------------*/
Function.prototype.debounce = function (milliseconds) {
    var baseFunction = this,
        timer = null,
        wait = milliseconds;

    return function () {
        var self = this,
            args = arguments;

        function complete() {
            baseFunction.apply(self, args);
            timer = null;
        }

        if (timer) {
            clearTimeout(timer);
        }

        timer = setTimeout(complete, wait);
    };
};

/* -----------------------------------------------------------------------------
 STICKY FOOTER
 ----------------------------------------------------------------------------- */

function stickyFooter(footerContainer, wrapCont) {

    function stick() {
        var footerHeight = document.querySelector(footerContainer).offsetHeight;
        document.querySelector(footerContainer).style.cssText = 'margin-top: -' + footerHeight + 'px;';
        document.querySelector(wrapCont).style.cssText = 'padding-bottom: ' + footerHeight + 'px;';
    }

    window.addEventListener('load', function (event) {
        stick()
    }.debounce(10));
    window.addEventListener('resize', function (event) {
        stick()
    }.debounce(10));

}

// initialization
stickyFooter('#footer', '.main-wrapper');

/*------------------------------------------------------------------

 -----------------------------------------------------------------*/
var RGBChange = function () {
    $('#RGB').css('background', 'rgb(' + r.getValue() + ',' + g.getValue() + ',' + b.getValue() + ')')
};

/*-----------------------------------------
 product detail carousel
 -----------------------------------------*/

$('#myCarousel').carousel({
    interval: 0
});

//Handles the carousel thumbnails
$('[id^=carousel-selector-]').click(function () {
    var id_selector = $(this).attr("id");
    try {
        var id = /-(\d+)$/.exec(id_selector)[1];
        console.log(id_selector, id);
        jQuery('#myCarousel').carousel(parseInt(id));
    } catch (e) {
        console.log('Regex failed!', e);
    }
});
// When the carousel slides, auto update the text
$('#myCarousel').on('slid.bs.carousel', function (e) {
    var id = $('.item.active').data('slide-number');
    $('#carousel-text').html($('#slide-content-'+id).html());
});


/*------------------------------------------------------------------
 SCROLL
 -----------------------------------------------------------------*/
$(document).ready(function () {
    $(function () {
        $.scrollUp({
            scrollName: 'scrollUp', // Element ID
            scrollDistance: 300, // Distance from top/bottom before showing element (px)
            scrollFrom: 'top', // 'top' or 'bottom'
            scrollSpeed: 300, // Speed back to top (ms)
            easingType: 'linear', // Scroll to top easing (see http://easings.net/)
            animation: 'fade', // Fade, slide, none
            animationSpeed: 200, // Animation in speed (ms)
            scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
            //scrollTarget: false, // Set a custom target element for scrolling to the top
            scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
            scrollTitle: false, // Set a custom <a> title if required.
            scrollImg: false, // Set true to use image
            activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
            zIndex: 2147483647 // Z-Index for the overlay
        });
    });
});
