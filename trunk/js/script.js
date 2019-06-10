const MENU_SLIDE_SPEED_MS = 500;
var versek = null;
var writings = [];

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

    get('api', function(response) {
        writings = response;
    });
});

function get(url, callback) {
    var result;

    $.ajax({
        method: "GET",
        url: url,
        dataType: "json",
        success: function(response) {
            if (Array.isArray(response)) {
                result = response;
            } else {
                result = JSON.parse(response);
            }
            
            callback(result);
        },
        error: function(response) {
            console.error(response);
        }
    });
}