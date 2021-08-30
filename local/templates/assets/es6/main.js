"use strict";
! function (e) {
    e(function () {

        // Menu
        $('#menu-btn').on('click', function () {
            $(this).toggleClass('active');
            $('#menu').slideToggle();
        });

        // Search
        $('.search__icon').on('click', function () {
            $('.search-field').addClass('active');
            $(this).addClass('active');
            $('#cart-count,.header__phone').css('display', 'none');
            $('#menu').addClass('d-none');
        });

        $('.search__close').on('click', function () {
            $('.search-field').removeClass('active');
            $(this).removeClass('active');
            $('#cart-count,.header__phone').css('display', 'flex');
            $('#menu').removeClass('d-none');
        });

        // Main Slider
        $('#main-slider').slick({
            nextArrow: '',
            prevArrow: ''
        });


    })
}(jQuery);