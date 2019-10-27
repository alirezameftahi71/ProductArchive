$('#grid-container').on('click', '.tile img', onTileClicked);

function onTileClicked(e) {
    redirectToItem(e.target.id);
}

function redirectToItem(id) {
    try {
        showPageLoading();
        checkNull(id);
        window.location.href = `/?id=${id}`;
    } catch (error) {
        hidePageLoading();
        // show flash message        
    }
}
