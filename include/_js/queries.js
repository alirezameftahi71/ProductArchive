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
    var radioBtnId = uuidv4();
    let dropDownFields = $('<tr><td>' +
        '<input class="form-control btn btn-outline-dark" id="remove-row-btn" onclick="removeRow(this, event)" type="button" value="Delete">' +
        '</td><td>' +
        '<select id="all-fields" name="field" class="form-control">' +
        '</select>' +
        '</td><td>' +
        '<select name="mop" class="form-control">' +
        '<option value="like">Contains</option>' +
        '<option value="=">=</option>' +
        '<option value="<">&lt;</option>' +
        '<option value=">">&gt;</option>' +
        '<option value="<=">&lt;=</option>' +
        '<option value=">=">&gt;=</option>' +
        '<option value="<>">&lt;&gt;</option>' +
        '</select>' +
        '</td><td>' +
        '<input name="value" class="form-control" type="text">' +
        '</td><td>' +
        '<div class="form-check-inline">' +
        '<input name="cop-' + radioBtnId + '" class="form-check-input" id="radio-and" type="radio" checked="" value="AND">AND' +
        '</div><div class="form-check-inline">' +
        '<input name="cop-' + radioBtnId + '" class="form-check-input" id="radio-or" type="radio" value="OR">OR' +
        '</div>' +
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
        if (item.name.includes('cop')) {
            temp['cop'] = item.value;
            array.push(temp);
            temp = {};
        } else {
            temp[item.name] = item.value;
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