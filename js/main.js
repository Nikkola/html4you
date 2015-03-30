"use strict";

var app = (function () {
	return {
        init: function () {
            app.setUpListeners();
        },
        setUpListeners: function () {
            $('.btn-up').on('click', app.scrollDown );
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
        }
    }
})();

app.init();