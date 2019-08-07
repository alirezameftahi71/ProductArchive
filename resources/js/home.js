$(() => {
    // Searchbox filter
    $('#searchBox').on('keyup change search', e => {
        const value = $(e.currentTarget).val().toLowerCase();
        $('#list-items a').filter((_i, item) => {
            $(item).toggle($(item).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // Bind to click event of each item in list-items
    $('#list-items').on('click', 'a', e => {
        $('#list-items').children().removeClass('active');
        $(e.currentTarget).addClass('active');
        // Fill the info table and place the photo if exists
        $.ajax({
            url: `/api/games/${e.currentTarget.id}`,
            type: 'GET',
            data: null,
            dataType: 'JSON',
            cache: false,
            success: e => {
                fillInfoTable(e);
            },
            fail: () => {}
        });
    });

    // Delete a single item
    $('#item-delete').on('click', e => {
        $.ajax({
            url: `/api/games/${$('#list-items .active').attr('id')}`,
            type: 'DELETE',
            data: null,
            dataType: 'JSON',
            cache: false,
            success: e => {
                let _deleteItem = $('#list-items .active');
                let _preItem = _deleteItem.prev();
                let _preItemId = _preItem.attr('id');
                _preItem.addClass('active');
                _deleteItem.remove();
                if (_preItemId != undefined)
                    getProductById(_preItemId, fillInfoTable);
                else
                    clearInfoTable();
            },
            fail: () => {}
        });
    });

    // Mark first entry on list-items as active on first load
    $('#list-items > a:first').addClass('active');
});

// Fills the info table with the passed data
function fillInfoTable(dataItem) {
    $('#info-table #name').html(dataItem.name);
    $('#info-table #releasedDate').html(dataItem.released_date);
    $('#info-table #rate').html(`${dataItem.rate}/5`);
    $('#info-table #genre').html(joinJsonNames(dataItem.genres));
    $('#info-table #platform').html(joinJsonNames(dataItem.platforms));
    $('#info-table #publisher').html(joinJsonNames(dataItem.publishers));
    $('#cover-pic').attr('src', `/storage/${dataItem.cover_pic}`);
    $('#description').html(dataItem.description);
}

// Clears the info table 
function clearInfoTable() {
    $('#info-table #name').html('Example Product Name');
    $('#info-table #releasedDate').html('YYYY-MM-DD');
    $('#info-table #rate').html('#/5');
    $('#info-table #genre').html('Example Genre(s)');
    $('#info-table #platform').html('Example Platform(s)');
    $('#info-table #publisher').html('Example Company(s)');
    $('#cover-pic').attr('src', `/storage/${dataItem.cover_pic}`);
    $('#description').html('Full Description goes here in multiple lines providing more and detailed information about the product, like story line or history.');
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

// Read the data by passed id
function getProductById(id, successFunc) {
    $.ajax({
        url: `/api/games/${id}`,
        type: 'GET',
        data: null,
        dataType: 'JSON',
        cache: false,
        success: e => {
            successFunc(e);
        },
        fail: () => {}
    });
}