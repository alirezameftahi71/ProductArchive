$('#grid-container').on('click', '.column img', onTileClicked);

function onTileClicked(e) {
    redirectToItem(e.target.id);
}

function redirectToItem(id) {
    try {
        showPageLoading();
        checkNull(id);
        window.location.replace(`/?id=${id}`);    
    } catch (error) {
        hidePageLoading();
        // show flash message        
    }
}
