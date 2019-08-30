// Tag inputs functionalities
tagsManagerHandler('genre', '/api/genres');
tagsManagerHandler('platform', '/api/platforms');
tagsManagerHandler('publisher', '/api/publishers');

// Tagmanager working with typeahead general function
function tagsManagerHandler(id, url) {
    const el = $(`#${id}`);
    const tagMan = el.tagsManager();
    el.typeahead({
        source: (query, process) => {
            el.addClass('input-loading');
            return $.ajax({
                url: url,
                type: 'GET',
                data: `search=${query}`,
                dataType: 'JSON',
                cache: false,
                success: (e) => {
                    const newData = [];
                    $.each(e, (_i, item) => {
                        newData.push(item.name);
                    });
                    process(newData);
                },
                complete: () => {
                    el.removeClass('input-loading');
                }
            });
        },
        afterSelect: (item) => {
            tagMan.tagsManager('pushTag', item);
        }
    });
}