var allFields;
const allOperators = [{
    title: 'Equal to',
    value: '='
}, {
    title: 'Less than',
    value: '<'
}, {
    title: 'More than',
    value: '>'
}, {
    title: 'Less or equal',
    value: '<='
}, {
    title: 'More or equal',
    value: '>='
}, {
    title: 'Not Equal',
    value: '<>'
}, {
    title: 'Contains',
    value: 'like'
}, {
    title: 'Not contains',
    value: 'not like'
}];

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
    $('#btn-reset').click(resetForm);
});

function addRow() {
    let element = $('<tr><td>' +
        '<input class="form-control btn btn-outline-dark" id="remove-row-btn" onclick="removeRow(this, event)" type="button" value="&#10005;">' +
        '</td><td>' +
        '<select id="all-fields" name="field" class="form-control">' +
        '</select>' +
        '</td><td>' +
        '<select id="all-operators" name="mop" class="form-control">' +
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
        let fieldOption = $('<option></option>', {
            value: allFields[i].field,
            dataType: allFields[i].type,
        });
        fieldOption.text(allFields[i].field.toUpperCase());
        $(element).find('#all-fields').append($(fieldOption));

    }
    for (let i = 0; i < allOperators.length; i++) {
        let operatorOption = $('<option></option>', {
            value: allOperators[i].value
        });
        operatorOption.text(allOperators[i].title);
        $(element).find('#all-operators').append($(operatorOption));
    }

    $('table#query-builder tbody').append($(element));
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

function resetForm(){
    $('#result-table').bootstrapTable('destroy');
    $('#result-table').hide();
    $('#query-builder tbody').empty();
    addRow();
}