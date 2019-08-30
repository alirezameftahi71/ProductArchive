// Searchbox filter
$('#searchBox').on('keyup change search', e => {
    const value = $(e.currentTarget).val().toLowerCase();
    $('#list-items a').toArray().filter(x => $(x).toggle($(x).text().toLowerCase().indexOf(value) > -1));
});

// Loading layout on ajax calls
$(document).ajaxStart(() => {
    $('.loader').addClass('is-active');
});
$(document).ajaxComplete(() => {
    $('.loader').removeClass('is-active');
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
$('#item-delete').on('click', () => {
    let id = getCurrentProductId();
    try {
        checkNull(id);
        $.ajax({
            url: `/api/games/${id}`,
            type: 'DELETE',
            data: null,
            dataType: 'JSON',
            cache: false,
            success: () => {
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
    } catch (error) {
        // show flash message 
    }
});

// update a single item (redirects to edit form)
$('#item-edit').on('click', () => {
    let id = getCurrentProductId();
    try {
        checkNull(id);
        window.location.replace(`/edit/${id}`);
    } catch (error) {
        // show flash message        
    }
});

// Mark first entry on list-items as active on first load
const urlParams = new URLSearchParams(window.location.search);
const id = urlParams.get('id') || 1;
const item = $(`#list-items > a#${id}`);
if (item.length > 0) {
    item.addClass('active');
    item[0].scrollIntoView();
}

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
    $('#cover-pic').attr('src', '/storage/assets/default.png');
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

// return false if null
function checkNull(data) {
    if (typeof data === 'undefined' || data === undefined || data === null) {
        throw new Error("Null Parameter Recieved!");
    }
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

// Find the selected product's id
function getCurrentProductId() {
    return $('#list-items .active').attr('id');
}