var allFields;
const allOperators = [
  {
    title: "Equal to",
    value: "=",
    types: ["int", "float", "varchar", "text", "nvarchar", "date"]
  },
  {
    title: "Less than",
    value: "<",
    types: ["int", "float", "date"]
  },
  {
    title: "More than",
    value: ">",
    types: ["int", "float", "date"]
  },
  {
    title: "Less or equal",
    value: "<=",
    types: ["int", "float", "date"]
  },
  {
    title: "More or equal",
    value: ">=",
    types: ["int", "float", "date"]
  },
  {
    title: "Not Equal",
    value: "<>",
    types: ["int", "float", "varchar", "text", "nvarchar", "date"]
  },
  {
    title: "Contains",
    value: "like",
    types: ["varchar", "text", "nvarchar"]
  },
  {
    title: "Not contains",
    value: "not like",
    types: ["varchar", "text", "nvarchar"]
  },
  {
    title: "Between",
    value: "between",
    types: ["int", "float", "date"]
  }
];

$(() => {
  $("#add-row-btn").click(addRow);
  _apiRequest(
    "../include/_php/services/query_builder.php",
    "POST",
    null,
    "json",
    data => {
      data.unshift({ field: "", type: "" });
      allFields = data;
      addRow();
    }
  );
  $("#btn-submit").click(sendQuery);
  $("#btn-reset").click(resetForm);
  $("table#query-builder").on("change", "#all-fields", e => {
    let row = $(e.target).parents("tr");
    let type = $(e.target.selectedOptions).attr("datatype");
    let ops = allOperators.filter(e => {
      return e.types.indexOf(type.split("(")[0]) > -1;
    });
    fillOperatorsDropdown(ops, row);
    toggleBetweenOperator(row, false);
    toggleDateInput(row, type === 'date');
  });
  $("table#query-builder").on("change", "#operators", e => {
    let row = $(e.target).parents("tr");
    let op = $(e.target.selectedOptions).attr("value");
    toggleBetweenOperator(row, op === "between");
  });
});

function addRow() {
  const uid = uuidv4();
  let row = $(`
        <tr id=${uid} class="row-query">
            <td>
            <input
                id="remove-row-btn"
                class="form-control btn btn-outline-dark"
                onclick="removeRow(this, event)"
                type="button"
                value="&#10005;"
            />
            </td>
            <td><select id="all-fields" name="field" class="form-control"></select></td>
            <td><select id="operators" name="mop" class="form-control"></select></td>
            <td>
            <input id="simple-value" name="value" class="form-control" type="text" />
            <div id="between-value-row" class="row" style="display:none;">
              <div class="col-md-5">
                <input id="value-from" name="valueFrom" class="form-control" type="text">
              </div>
              <div class="col-md-2 text-center">
                <label style="vertical-align:sub;">And</label>
              </div>
              <div class="col-md-5">
                <input id="value-to" name="valueTo" class="form-control" type="text">
              </div>
            </div>
            </td>
            <td>
            <select name="cop" class="form-control">
                <option value="AND">AND</option>
                <option value="OR">OR</option>
            </select>
            </td>
        </tr>
    `);
  fillFieldsDropdown(allFields, $(row));
  $("table#query-builder tbody").append(row);
}

function removeRow(e) {
  $(e)
    .parents("tr")
    .remove();
}

function sendQuery() {
  $("#result-table").bootstrapTable("destroy");
  $("#result-table").hide();
  var data = $("form").serializeArray();
  var processedData = prepareRequestData(data);
  var processedDataStr = JSON.stringify(processedData);
  _apiRequest(
    "../include/_php/services/query_builder.php",
    "POST",
    processedDataStr,
    "json",
    result => {
      $("#result-table").bootstrapTable("destroy");
      $("#result-table")
        .bootstrapTable({
          data: result
        })
        .show();
    }
  );
}

function prepareRequestData(data) {
  var res = {};
  var temp = {};
  var array = [];
  for (var item of data) {
    temp[item.name] = item.value;
    if (item.name === "cop") {
      array.push(temp);
      temp = {};
    }
  }
  for (let index = array.length; index >= 0; index--) {
    const element = array[index];
    if (index > 0) array[index - 1].child = element;
  }
  res = array.length > 0 ? array[0] : {};
  return res;
}

function resetForm() {
  $("#result-table").bootstrapTable("destroy");
  $("#result-table").hide();
  $("#query-builder tbody").empty();
  addRow();
}

function fillOperatorsDropdown(ops, row) {
  let opSelector = row.find("#operators");
  opSelector.empty();
  for (let i = 0; i < ops.length; i++) {
    let operatorOption = $("<option></option>", {
      value: ops[i].value
    });
    operatorOption.text(ops[i].title);
    opSelector.append($(operatorOption));
  }
}

function fillFieldsDropdown(fields, row) {
  let fieldSelector = row.find("#all-fields");
  for (let i = 0; i < fields.length; i++) {
    let fieldOption = $("<option></option>", {
      value: fields[i].field,
      datatype: fields[i].type
    });
    fieldOption.text(fields[i].field.toUpperCase());
    fieldSelector.append($(fieldOption));
  }
}

function toggleBetweenOperator(row, opIsBetween){
  if (opIsBetween) {
    row.find("#between-value-row").show();
    row.find("#simple-value").val("").hide();
  } else {
    row.find("#between-value-row").hide();
    row.find("#simple-value").val("").show();
  }
}

function toggleDateInput(row, typeIsDate) {
  if (typeIsDate) {
    row.find('#between-value-row input').val("").attr('type', 'date');
    row.find('input#simple-value').val("").attr('type', 'date');
  } else {
    row.find('#between-value-row input').val("").attr('type', 'text');
    row.find('input#simple-value').val("").attr('type', 'text');
  }
}