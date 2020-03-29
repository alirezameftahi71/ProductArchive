// Loading layout on ajax calls
$(document).ajaxStart(showPageLoading);
$(document).ajaxComplete(hidePageLoading);

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


function toggleCheckedIconByValue(isChecked) {
    if (isChecked) {
        $('#item-check').addClass('i-green');
    } else {
        $('#item-check').removeClass('i-green');
    }
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
