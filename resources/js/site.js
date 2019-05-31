'use strict';
// TODO: make use of vanilla js and vue.js instead of jQuery

// Mark the current page as active in navbar
$('ul.navbar-nav a').filter((_i, item) => {
    return window.location.href.includes(item.href);
}).parent().addClass('active');

$(() => {
    // Loading layout on ajax calls handling
    $(document).ajaxStart(() => {
        $('#loading').css('display', 'flex');
    });
    $(document).ajaxComplete(() => {
        $('#loading').hide();
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
                fillInfoTable(e);
            },
            fail: () => {

            }
        });
    });

    // Mark first entry on list-items as active on first load
    $('#list-items > a:first').addClass('active');
    // const activeItem = $('#list-items > a.active:first');
    // activeItem && activeItem.trigger('click');
});

// Fills the info table with the passed data
function fillInfoTable(dataItem) {
    $('table #name').html(dataItem.name);
    $('table #releasedDate').html(dataItem.released_date);
    $('table #rate').html(dataItem.rate + '/5');
    $('table #genre').html(joinJsonNames(dataItem.genres));
    $('table #platform').html(joinJsonNames(dataItem.platforms));
    $('table #publisher').html(joinJsonNames(dataItem.publishers));
    $('#description').html(dataItem.description);
}

// Joins each item's name in a list with a separator
function joinJsonNames(arr, separator) {
    let joinedNames = '';
    for (const item of arr) {
        joinedNames += `${item.name}${(separator || ', ')}`;
    }
    joinedNames = joinedNames.endsWith(', ') ? joinedNames.substr(0, joinedNames.length - 2) : joinedNames;
    return joinedNames;
}
