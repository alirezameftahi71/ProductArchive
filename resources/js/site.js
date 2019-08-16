// Mark the current page as active in navbar
let _url = $('ul.navbar-nav a').toArray().find(x => `${window.location.origin}${window.location.pathname}` === x.href);
_url && _url.parentElement.classList.add('active');

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
