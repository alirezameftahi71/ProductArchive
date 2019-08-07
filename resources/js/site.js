'use strict';
// TODO: make use of vanilla js and vue.js instead of jQuery

// Mark the current page as active in navbar
let _url = $('ul.navbar-nav a').filter((_i, item) => {
    return window.location.href === item.href;
});
_url.length === 1 ? _url.parent().addClass('active') : $('ul.navbar-nav a')[0].parent().addClass('active');

$(() => {
    // Loading layout on ajax calls handling
    $(document).ajaxStart(() => {
        $('#loading').css('display', 'flex');
    });
    $(document).ajaxComplete(() => {
        $('#loading').hide();
    });

    // Enabling confirmation
	$('[data-toggle=confirmation]').confirmation({
		rootSelector: '[data-toggle=confirmation]',
		// other options
	});
});