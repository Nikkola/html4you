"use strict";

var app = (function () {
	return {
        init: function () {
            app.setUpListeners();
        },
        setUpListeners: function () {
            $('.btn-up').on('click', app.scrollDown );
            $('.showmenu').on('click', app.showMenu);
            $('.section')
                .waypoint(function (direction) {
                    var activeItem = $(this.element).data('section');
                    if (direction == 'down') {
                        $('.nav__list-link').removeClass('active');
                        $('#' + activeItem).addClass('active');
                    }
                }, {
                    offset: '15%'
                });
            $('.section').waypoint(function (direction) {
                    var activeItem = $(this.element).data('section');
                    if (direction == 'up') {
                        $('.nav__list-link').removeClass('active');
                        $('#' + activeItem).addClass('active');
                    }

                }, {
                    offset: '-60%'
                });

        },
        scrollDown: function (e) {
            e.preventDefault();
            var
                scroll = $('.header'),
                destination = scroll.outerHeight(true),
                navHeight = $('.nav').outerHeight(true);

            $('body').animate({
                scrollTop: (destination - navHeight)
            }, 500);
        },
        showMenu: function (e) {
            e.preventDefault();
            var expression = parseInt($('.nav').css('left'));

            if (!expression) {
                $('.nav').animate({
                    'left': '100%'
                }, 300)
            } else {
                $('.nav').animate({
                    'left': '0'
                }, 300)
            }
        }
    }
})();

app.init();