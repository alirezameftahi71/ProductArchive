"use strict";
// TODO: make use of vanilla js and vue.js instead of jQuery

// Print the footer
$('#footer').text(() => {
    const startYear = '2018';
    const currentYear = new Date().getFullYear();
    return `\u00A9 ${startYear} - ${currentYear} Alireza Meftahi | All Rights Reserved`;
});

// Mark the current page as active in navbar
$('ul.navbar-nav a').filter((_i, item) => {
    return window.location.href.includes(item.href);
}).parent().addClass('active');

$(() => {
    $(document).ajaxStart(() => {
        $("#loading").css('display', 'flex');
    });
    $(document).ajaxComplete(() => {
        $("#loading").hide();
    });

    // Searchbox filter
    $('#searchBox').on('keyup change search', (e) => {
        const value = $(e.currentTarget).val().toLowerCase();
        $('#list-items a').filter((_i, item) => {
            $(item).toggle($(item).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // Bind to click event of each item in list-items
    $('#list-items').on('click', 'a', (e) => {
        $('#list-items').children().removeClass('active');
        $(e.currentTarget).addClass('active');
        // Fill the info table and place the photo if exists
        $.ajax({
            url: `/api/games/${e.currentTarget.id}`,
            type: 'GET',
            data: null,
            dataType: 'JSON',
            cache: false,
            success: (e) => {
                console.log(e);
            },
            fail: () => {

            }
        });
    });

});
