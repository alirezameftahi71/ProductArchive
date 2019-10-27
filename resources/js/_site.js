// Mark the current page as active in navbar
let _url = $('ul.navbar-nav a').toArray().find(x => `${window.location.origin}${window.location.pathname}` === x.href);
_url && _url.parentElement.classList.add('active');

// Enabling confirmation
$('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    // other options
});

// Jquery custom plugin to get nearest item to a selector
(function ($) {
    $.fn.preOrNext = function () {
        const preElement = this.prev();
        if (preElement.length) {
            return preElement;
        } else {
            return this.next();
        }
    };
}(jQuery));

// return false if null
window.checkNull = data => {
    if (typeof data === 'undefined' || data === undefined || data === null) {
        throw new Error("Null Parameter Recieved!");
    }
}

// show full page loading layout
window.showPageLoading = () => {
    $('.loader').addClass('is-active');
}

// hide full page loading layout
window.hidePageLoading = () => {
    $('.loader').removeClass('is-active');
}