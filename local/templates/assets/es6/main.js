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

        // Show more in main  page
        $('#show_more').on('click', () => {
            $('.category-items').css('display', 'flex');
        });

        $('#signup-form').ajaxForm({
            url: '/ajax/signup.php',
            type: 'post',
            success: d => {
                let res = JSON.parse(d);

                $('#signup-form input[name="email"]').siblings('label').html('E-mail *');
                $('#signup-form input[name="password"]').siblings('label').html('Пароль *');
                $('#signup-form input[name="repeat_password"]').siblings('label').html('Повторите пароль *');

                $('#signup-form .item').removeClass('error');

                if (!res.result && res.errors) {
                    let label = $('#signup-form input[name="email"]').siblings('label');
                    if (res.errors.email) {
                        $('#signup-form input[name="email"]').parent().addClass('error');
                        label.html(res.errors.email[0]);
                    } else label.html('E-mail *');

                    label = $('#signup-form input[name="password"]').siblings('label');
                    if (res.errors.password) {
                        $('#signup-form input[name="password"]').parent().addClass('error');
                        label.html(res.errors.password[0]);
                    } else label.html('Пароль *');

                    label = $('#signup-form input[name="repeat_password"]').siblings('label');
                    if (res.errors.repeat_password) {
                        $('#signup-form input[name="repeat_password"]').parent().addClass('error');
                        label.html(res.errors.repeat_password[0]);
                    } else label.html('Повторите пароль *');
                } else if (res.cerror) {
                    let label = $('#signup-form input[name="email"]').siblings('label');
                    $('#signup-form input[name="email"]').parent().addClass('error');
                    label.html(res.cerror);
                } else
                    window.location.reload(false);

            }
        });

        $('#login-form').ajaxForm({
            url: '/ajax/login.php',
            type: 'post',
            success: d => {

                let res = JSON.parse(d);

                $('#login-form input[name="email"]').siblings('label').html('E-mail *');
                $('#login-form input[name="password"]').siblings('label').html('Пароль *');

                $('#login-form .item').removeClass('error');

                if (res.result) {
                    window.location.reload(false);
                } else {

                    if (res.errors) {
                        let label = $('#login-form input[name="email"]').siblings('label');
                        if (res.errors.email) {
                            $('#login-form input[name="email"]').parent().addClass('error');
                            label.html(res.errors.email[0]);
                        } else label.html('E-mail *');

                        label = $('#login-form input[name="password"]').siblings('label');
                        if (res.errors.password) {
                            $('#login-form input[name="password"]').parent().addClass('error');
                            label.html(res.errors.password[0]);
                        } else label.html('Пароль *');
                    } else if (res.cerror) {
                        $('#login-form input[name="email"]').parent().addClass('error');
                        $('#login-form input[name="email"]').siblings('label').html(res.cerror);
                    }

                }


            }
        });

        $('#signup .modal-close').on('click', function () {
            $('#signup').parent().toggle();
        });

        if (!$('.user').attr('href')) {
            $('.user').on('click', function () {
                $('#signup').parent().toggle();
            });
        }

        $('#login .modal-close').on('click', function () {
            $('#login').parent().toggle();
        });

        $('#login .remember').on('change', () => {
            $('#login .bx-filter-param-label').toggleClass('active');
        });

        $('#login .btn, #signup .btn').on('click', () => {
            $('#login').parent().toggle();
            $('#signup').parent().toggle();
        });

        $('input[type="tel"]').inputmask('+9 999 999-99-99');

        $('#ava').on('click', () => {
            $('#ava-input').click();
        });

        $('#ava-input').on('change', function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    let src = e.target.result;
                    $('#ava').css('background-image', `url(${src})`);
                };

                reader.readAsDataURL($('#ava-input')[0].files[0]);
            }
        });

        $('.order-detailed').on('click', function () {
            if (!$(this).parent().hasClass('active')) {
                $('.order .active .btn').html('Подробнее');
                $('.order .active').parent().find('.order-content').slideToggle();
                $('.order .active').toggleClass('active');
            }
            let order = $(this).parent().parent();
            order.find('.order-content').slideToggle();
            order.find('.order-head').toggleClass('active');
            order.find('.btn').html() == 'Свернуть' ? order.find('.btn').html('Подробнее') : order.find('.btn').html('Свернуть');
        })

    })
}(jQuery);

function favourites(e, reload = false) {
    let productId = $(e).data('id');
    let a = $(e).attr('data-a');
    $.ajax({
        url: "/ajax/favourites.php",
        data: {
            action: a,
            id: productId
        },
        method: 'get',
        dataType: 'json',
        success: d => {
            if (d.result) {
                if (a == 'add') {
                    $(e).addClass('active');
                    $(e).attr('data-a', 'del');
                } else {
                    $(e).removeClass('active');
                    $(e).attr('data-a', 'add');
                }
                $('.heart .header-count').html(d.count)

                if (d.count == 0) {
                    $('.heart .header-count').addClass('hide-block');
                } else {
                    $('.heart .header-count').removeClass('hide-block');
                }

                if (reload)
                    window.location.reload(false);

            }
        }
    });
}

function toggleCart() {
    $('.cart-modal').toggleClass('active');
}