// Searchbox filter
$('#search-box').on('keyup change search', e => {
    const value = $(e.currentTarget).val().toLowerCase();
    $('#list-items a').toArray().filter(x => $(x).toggle($(x).text().toLowerCase().indexOf(value) > -1));
});

// Loading layout on ajax calls
$(document).ajaxStart(showPageLoading);
$(document).ajaxComplete(hidePageLoading);

// Bind to click event of each item in list-items
$('#list-items').on('click', 'a', e => {
    $('#list-items').children().removeClass('active');
    $(e.currentTarget).addClass('active');
    // Fill the info table and place the photo if exists
    getProductById(e.currentTarget.id, fillInfoTable);
});

// Delete a single item
$('#item-delete').on('click', () => {
    let id = getCurrentProductId();
    checkNull(id);
    $.ajax({
        url: `/api/games/${id}`,
        type: 'DELETE',
        data: null,
        dataType: 'JSON',
        cache: false,
        success: () => {
            let _deleteItem = $('#list-items .active');
            let _nearestItem = _deleteItem.preOrNext();
            let _nearestItemId = _nearestItem.attr('id');
            _nearestItem.addClass('active');
            _deleteItem.remove();
            if (_nearestItemId != undefined)
                getProductById(_nearestItemId, fillInfoTable);
            else
                clearInfoTable();
        },
        fail: () => {}
    });
});

// Update a single item (redirects to edit form)
$('#item-edit').on('click', () => {
    let id = getCurrentProductId();
    try {
        checkNull(id);
        window.location.replace(`/edit/${id}`);
    } catch (error) {
        // show flash message        
    }
});

// Toggle a single item as checked
$('#item-check').on('click', () => {
    let id = getCurrentProductId();
    try {
        checkNull(id);
        $.ajax({
            url: `/api/games/toggleChecked/${id}`,
            type: 'POST',
            data: null,
            dataType: 'JSON',
            cache: false,
            success: e => {
                getProductById(id, fillInfoTable);
            },
            fail: () => { }
        });
    } catch (error) { 
        // show flash message        
    }
});

// Mark first entry on list-items as active on first load
const urlParams = new URLSearchParams(window.location.search);
const id = urlParams.get('id') || getIdOfListItem(getFirstItemInList());
const item = $(`#list-items > a#${id}`);
if (item.length > 0) {
    item.addClass('active');
    item[0].scrollIntoView();
}

function getIdOfListItem(item) {
    if (item && item.length) {
        return item.attr('id');
    } else {
        return null;
    }
}

function getFirstItemInList() {
    return $('#list-items a').first();
}

// Fills the info table with the passed data
function fillInfoTable(dataItem) {
    $('#info-table #name').html(dataItem.name);
    $('#info-table #releasedDate').html(dataItem.released_date);
    $('#info-table #rate').html(`${dataItem.rate != null ? dataItem.rate : ''} / 5.0`);
    $('#info-table #genre').html(joinJsonNames(dataItem.genres));
    $('#info-table #platform').html(joinJsonNames(dataItem.platforms));
    $('#info-table #publisher').html(joinJsonNames(dataItem.publishers));
    $('#cover-pic').attr('src', `/storage/${dataItem.cover_pic}`);
    $('#description').html(dataItem.description);
    toggleCheckedIconByValue(!!+dataItem.checked);
}

function toggleCheckedIconByValue(isChecked) {
    if (isChecked) {
        $('#item-check').addClass('i-green');
    } else {
        $('#item-check').removeClass('i-green');
    }
}

// Clears the info table 
function clearInfoTable() {
    $('#info-table #name').empty();
    $('#info-table #releasedDate').empty();
    $('#info-table #rate').empty()
    $('#info-table #genre').empty();
    $('#info-table #platform').empty();
    $('#info-table #publisher').empty();
    $('#cover-pic').attr('src', '/storage/assets/default.png');
    $('#description').empty();
    $('#item-check').removeClass('i-green');
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
        fail: (e) => {
            console.error(e);
        }
    });
}

// Find the selected product's id
function getCurrentProductId() {
    return $('#list-items .active').attr('id');
}
