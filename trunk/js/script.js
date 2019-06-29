const MENU_SLIDE_SPEED_MS = 500;
const SCREEN_WIDTH_XS = 768;
const OFFSET_Y = 150;
const SCROLL_TIME_MS = 1000;
//var writings = [];

$(document).ready(function() {
    $('#btn-menu').on('click', function() {
        var $button = $(this);
        var $header = $button.parent();
        var $menuContainer = $('.menu-container');

        if ($button.hasClass('open')) {
            $button.removeClass('open');
            $header.removeClass('menu-open');
            $menuContainer.removeClass('open');
        } else {
            $button.addClass('open');
            $header.addClass('menu-open');
            $menuContainer.addClass('open');
        }
    });

    $('.sub-nav-arrow-container').on('click', function() {
        var $listContainer = $('.sub-nav-list-container');
        var $arrow = $(this).find('i.material-icons');

        if ($arrow.hasClass('open')) {
            $arrow.removeClass('open');
            $listContainer.removeClass('open');
        } else {
            $arrow.addClass('open');
            $listContainer.addClass('open');
        }
    });

    // scroll to section
    $('a[href*="#"]').not('[href="#"], [href^="#collapse"]').on('click', function() {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        var offset = window.innerWidth < SCREEN_WIDTH_XS ? 0 : OFFSET_Y;
        var destination = target.offset().top - offset;
        var distance = Math.abs(destination - window.pageYOffset);
        var time = distance < OFFSET_Y ? SCROLL_TIME_MS / 10 : SCROLL_TIME_MS;

        $('html, body').animate({
            scrollTop: destination
        }, time, 'linear');
    });
});