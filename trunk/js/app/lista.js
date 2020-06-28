$(document).ready(function() {
    $('.menu a').on('click', function() {
		localStorage.setItem('openAccordionId', null);
	});

    $('.accordion-caption').on('click', function (e) {
        const $accordionCaption = $(this);
        const $accordionHeader = $accordionCaption.parent();
        const $accordionBody = $accordionHeader.siblings('.accordion-body');
        const $accordion = $accordionHeader.parent();
        const $accordionGroup = $accordion.parent();
        const $arrow = $accordionHeader.find('i.material-icons');

        if ($arrow.hasClass('open')) { // close
            $accordionBody.slideUp(app.ACCORDION_SLIDE_SPEED_MS);
            $arrow.removeClass('open');

            localStorage.setItem('openAccordionId', '');
        } else { // open
            $arrow.addClass('open');

            if ($accordionGroup.hasClass('exclusive')) {
                // close all accordions but this
                const $siblings = $accordion.siblings('.accordion');
                $siblings.find('i.material-icons').removeClass('open');
                $siblings.find('.accordion-body').slideUp(app.ACCORDION_SLIDE_SPEED_MS);
            }

            $accordionBody.slideDown(app.ACCORDION_SLIDE_SPEED_MS);

            localStorage.setItem('openAccordionId', $accordion.attr('id'));
        }
    });

    if (localStorage.openAccordionId) {
        $('#' + localStorage.openAccordionId)
            .find('.accordion-caption')
            .trigger('click');
    }
});