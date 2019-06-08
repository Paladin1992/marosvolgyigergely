const MENU_SLIDE_SPEED_MS = 500;

$(document).ready(function() {
    $('#btn-menu').on('click', function() {
        var $button = $(this);
        var $header = $button.parent();
        var $menuContainer = $('.menu-container');

        if ($button.hasClass('opened')) {
            $button.removeClass('opened');
            $header.removeClass('menu-opened');
            $menuContainer.removeClass('opened');
        } else {
            $button.addClass('opened');
            $header.addClass('menu-opened');
            $menuContainer.addClass('opened');
        }
    });
});