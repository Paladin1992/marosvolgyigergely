const MENU_SLIDE_SPEED_MS = 500;
const ACCORDION_SLIDE_SPEED_MS = 500;
const SCREEN_WIDTH_XS = 768;
const OFFSET_Y_XS = 60;
const OFFSET_Y_LG = 150;
const SCROLL_TIME_MS = 500;

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

    $('.accordion-caption').on('click', function (e) {
        var $accordionCaption = $(this);
        var $accordionHeader = $accordionCaption.parent();
        var $accordionBody = $accordionHeader.siblings('.accordion-body');
        var $accordion = $accordionHeader.parent();
        var $accordionGroup = $accordion.parent();
        var $arrow = $accordionHeader.find('i.material-icons');

        if ($arrow.hasClass('open')) {
            $accordionBody.slideUp(ACCORDION_SLIDE_SPEED_MS);
            $arrow.removeClass('open');
        } else {
            $arrow.addClass('open');

            if ($accordionGroup.hasClass('exclusive')) {
                // close all accordions but this
                var $siblings = $accordion.siblings('.accordion');
                $siblings.find('i.material-icons').removeClass('open');
                $siblings.find('.accordion-body').slideUp(ACCORDION_SLIDE_SPEED_MS);
            }

            $accordionBody.slideDown(ACCORDION_SLIDE_SPEED_MS);
        }
    })

    // scroll to section
    $('a[href*="#"]').not('[href="#"], [href^="#collapse"]').on('click', function() {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        var offset = window.innerWidth < SCREEN_WIDTH_XS ? OFFSET_Y_XS : OFFSET_Y_LG;
        var destination = target.offset().top - offset;
        var distance = Math.abs(destination - window.pageYOffset);
        var time = distance < OFFSET_Y_LG ? SCROLL_TIME_MS / 10 : SCROLL_TIME_MS;

        $('html, body').animate({
            scrollTop: destination
        }, time, 'linear');
    });

    //initNotifications();
});