$(function () {
    $('#add-row-btn').click(addRow);
    for (let index = 0; index < 8; index++) {
        addRow();
    }
});

function addRow() {
    var radioBtnId = uuidv4();
    $('table#query-builder tbody').append(
        '<tr><td>'+
            '<input class="form-control btn btn-outline-dark" id="remove-row-btn" onclick="removeRow(this, event)" type="button" value="Delete">'+
        '</td><td>'+
            '<select name="fields" class="form-control">'+
                '<option value="volvo">Volvo</option>'+
                '<option value="saab">Saab</option>'+
                '<option value="fiat">Fiat</option>'+
                '<option value="audi">Audi</option>'+
            '</select>'+
        '</td><td>'+
            '<select name="mops" class="form-control">'+
                '<option value="=">=</option>'+
                '<option value="<"> &lt;</option>'+
                '<option value=">">&gt;</option>'+
                '<option value="<=">&lt;=</option>'+
                '<option value=">=">&gt;=</option>'+
                '<option value="<>">&lt;&gt;</option>'+
            '</select>'+
        '</td><td>'+
            '<input class="form-control" type="text">'+
        '</td><td>'+
            '<div class="form-check-inline">'+
                '<input name="cops-'+ radioBtnId +'" class="form-check-input" id="radio-and" type="radio" checked="" value="AND">AND'+
            '</div><div class="form-check-inline">'+
                '<input name="cops-'+ radioBtnId +'" class="form-check-input" id="radio-or" type="radio" value="OR">OR'+
            '</div>'+
        '</td></tr>');
}

function removeRow(e, event) {
    $(event.target).parents('tr').remove();
}