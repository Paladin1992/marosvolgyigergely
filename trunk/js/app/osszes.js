$(document).ready(function() {
    switch (page) {
        case 'versek':
            loadWritingsDynamically('vers', 0, app.LOAD_WRITINGS_MAX_COUNT);

            $('.load-more-writings').on('click', function() {
                loadWritingsDynamically('vers', app.loadedWritingsCount, app.LOAD_WRITINGS_MAX_COUNT);
            });
            break;
        case 'novellak':
            loadWritingsDynamically('novella', 0, app.LOAD_WRITINGS_MAX_COUNT);

            $('.load-more-writings').on('click', function() {
                loadWritingsDynamically('novella', app.loadedWritingsCount, app.LOAD_WRITINGS_MAX_COUNT);
            });
            break;
        default: break;
    }

    $('.load-more-writings').show();
});