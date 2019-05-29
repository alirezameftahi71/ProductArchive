$(() => {
    // Print the footer
    $('#footer').text(() => {
        const startYear = '2018';
        const currentYear = (new Date()).getFullYear().toString();
        const startYearText = startYear === currentYear ? '' : '2018';
        return `\u00A9 ${startYearText} - ${currentYear} Alireza Meftahi | All Rights Reserved`;
    });

    // Searchbox filter
    $('#searchBox').on('keyup change search', (e) => {
        const value = $(e.currentTarget).val().toLowerCase();
        $('#listItems a').filter((ei, item) => {
            $(item).toggle($(item).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // Mark the current page as active in navbar
    $('ul.navbar-nav a').filter((i, item) => {
        return window.location.href.includes(item.href);
    }).parent().addClass('active');

    // // Enabling confirmation
    // $('[data-toggle=confirmation]').confirmation({
    // 	rootSelector: '[data-toggle=confirmation]',
    // 	// other options
    // });
});
