$(function() {


    let appNav = $('#app-nav');

    $(window).on('scroll', function() {


        let navHeight = appNav.innerHeight();
        let widowScrollTop = $(window).scrollTop();


        if (widowScrollTop > navHeight) {
            appNav.addClass('fixed');
        } else {
            appNav.removeClass('fixed');
        }




    })




})