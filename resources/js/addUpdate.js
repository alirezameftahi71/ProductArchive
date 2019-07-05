$(function () {
    // Tag inputs functionalities
    tagsManagerHandler('genre', '/api/genres');
    tagsManagerHandler('platform', '/api/platforms');
    tagsManagerHandler('publisher', '/api/publishers');
});

// Tagmanager working with typeahead general function
function tagsManagerHandler(_id, _url) {
    const tagMan = $(`#${_id}`).tagsManager();
    $(`#${_id}`).typeahead({
        source: (query, process) => {
            return $.ajax({
                url: _url,
                type: 'GET',
                data: `search=${query}`,
                dataType: 'JSON',
                cache: false,
                success: (e) => {
                    var newData = [];
                    $.each(e, (_i, item) => {
                        newData.push(item.name);
                    });
                    process(newData);
                }
            });
        },
        afterSelect: (item) => {
            tagMan.tagsManager('pushTag', item);
        }
    });
}
