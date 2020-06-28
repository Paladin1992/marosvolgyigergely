$(document).ready(function() {
    $('#btn-menu').on('click', function() {
        const $button = $(this);
        const $header = $button.parent();
        const $menuContainer = $('.menu-container');

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

    $('.author-note-load').one('click', function(e) {
        loadAuthorNotes(e.target.dataset.writingurl, e.target.dataset.typename);
    });
    
    // scroll to section
    $('a[href*="#"]').not('[href="#"], [href^="#collapse"]').on('click', function() {
        let target = $(decodeURI(this.hash));
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        
        const offset = window.innerWidth < app.SCREEN_WIDTH_XS
            ? app.OFFSET_Y_XS
            : app.OFFSET_Y_LG;

        const destination = target.offset().top - offset;
        const distance = Math.abs(destination - window.pageYOffset);

        const time = distance < app.OFFSET_Y_LG
            ? app.SCROLL_TIME_MS / 10
            : app.SCROLL_TIME_MS;

        $('html, body').animate({
            scrollTop: destination
        }, time, 'linear');
    });
});

function loadAuthorNotes(writingUrl, typeName) {
    const $authorNoteContainer = $('#' + writingUrl).find('.author-note');

    if (!writingUrl) {
        console.error('Parameter `writingUrl` of function `loadAuthorNotes` cannot be empty.');
        return;
    }

    if (!typeName) {
        console.error('Parameter `typeName` of function `loadAuthorNotes` cannot be empty.');
        return;
    }

    if ($authorNoteContainer.hasClass('filled')) {
        return;
    }

    $.when(
        $.ajax({
            url: 'db/api/controller.php',
            method: 'GET',
            data: {
                action: 'getAuthorNote',
                writingUrl: writingUrl,
                typeName: typeName
            },
            cache: false
        })
    ).done(function(data) {
        $authorNoteContainer
            .html(data)
            .addClass('filled')
            .prev().addClass('inactive');
    }).fail(function(data) {
        console.error(data);
    });
}

function loadWritingsDynamically(typeName, skip, take) {
    if (!typeName) {
        console.error('Parameter `typeName` of function `loadWritingsDynamically` cannot be empty.');
        return;
    }

    if (!skip || skip < 0) {
        skip = 0;
    }

    if (!take || take < 0) {
        take = 10;
    }

    $.when(
        $.ajax({
            url: 'db/api/controller.php',
            method: 'GET',
            data: {
                action: 'loadWritingsDynamically',
                typeName: typeName,
                skip: skip,
                take: take
            },
            cache: false
        })
    ).done(function(data) {
        $('#dynamicContent').append(data);
        app.loadedWritingsCount += app.LOAD_WRITINGS_MAX_COUNT;
        
        if (app.totalWritingsCount - app.loadedWritingsCount <= 0) {
            $('.load-more-writings').hide();
        }

        $('.author-note-load').one('click', function(e) {
            loadAuthorNotes(e.target.dataset.writingurl, e.target.dataset.typename);
        });
    }).fail(function(data) {
        console.error(data);
    });
}