var allFields;
$(function () {
    $('#add-row-btn').click(addRow);
    _apiRequest(
        "../include/_php/services/query_builder.php",
        "POST",
        null,
        "json",
        function (data) {
            allFields = data;
            addRow();
        }
    );
    $('#btn-submit').click(sendQuery);
});

function addRow() {
    let dropDownFields = $('<tr><td>' +
        '<input class="form-control btn btn-outline-dark" id="remove-row-btn" onclick="removeRow(this, event)" type="button" value="&#10005;">' +
        '</td><td>' +
        '<select id="all-fields" name="field" class="form-control">' +
        '</select>' +
        '</td><td>' +
        '<select name="mop" class="form-control">' +
        '<option value="=">Equal to</option>' +
        '<option value="<">Less than</option>' +
        '<option value=">">More than</option>' +
        '<option value="<=">Less or equal</option>' +
        '<option value=">=">More or equal</option>' +
        '<option value="<>">Not Equal</option>' +
        '<option value="like">Contains</option>' +
        '<option value="not like">Not contains</option>' +
        '</select>' +
        '</td><td>' +
        '<input name="value" class="form-control" type="text">' +
        '</td><td>' +
        '<select name="cop" class="form-control">' +
        '<option value="AND">AND</option>' +
        '<option value="OR">OR</option>' +
        '</select>' +
        '</td></tr>');
    for (let i = 0; i < allFields.length; i++) {
        let element = $('<option></option>', {
            value: allFields[i]
        });
        element.text(allFields[i]);
        $(dropDownFields).find('#all-fields').append($(element));
    }
    $('table#query-builder tbody').append($(dropDownFields));
}

function removeRow(e, event) {
    $(event.target).parents('tr').remove();
}

function sendQuery() {
    var data = $('form').serializeArray();
    var processedData = prepareRequestData(data);
    var processedDataStr = JSON.stringify(processedData);
    _apiRequest(
        "../include/_php/services/query_builder.php",
        "POST",
        processedDataStr,
        "json",
        function (result) {
            $('#result-table').bootstrapTable('destroy');
            $('#result-table').bootstrapTable({
                data: result
            }).show();
        }
    );
}

function prepareRequestData(data) {
    var res = {};
    var temp = {};
    var array = [];
    for (var item of data) {
        temp[item.name] = item.value;
        if (item.name === 'cop') {
            array.push(temp);
            temp = {};
        }
    }
    for (let index = array.length; index >= 0; index--) {
        const element = array[index];
        if (index > 0)
            array[index - 1].child = element;
    }
    res = array.length > 0 ? array[0] : {};
    return res;
}