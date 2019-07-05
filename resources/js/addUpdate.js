$(function () {
    // Tag inputs functionalities
    tagsManagerHandler('genre', '/api/genres');
    tagsManagerHandler('platform', '/api/platforms');
    tagsManagerHandler('publisher', '/api/publishers');
    $('#btn-submit').click(sendAddInfo);

});

// Tagmanager working with typeahead general function
function tagsManagerHandler(id, url) {
    const tagMan = $(`#${id}`).tagsManager();
    $(`#${id}`).typeahead({
        source: (query, process) => {
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
                }
            });
        },
        afterSelect: (item) => {
            tagMan.tagsManager('pushTag', item);
        }
    });
}

// Send data to php services
function sendAddInfo() {
    const data = $('form').serializeJSON();
    
}
