var jsonData = [];
$(function () {
    _apiRequest(
        "../include/_php/services/query/read.php",
        "GET",
        null,
        "json",
        function (result) {
            $.each(result, function (i) {
                let fieldOption = $("<option></option>", {
                    id: result[i]['id'],
                    value: result[i]['title'],
                });
                fieldOption.data('jsonQuery', result[i]['jsonQuery']);
                fieldOption.text(result[i]['title']);
                $('#data-select').append(fieldOption);
            });
            // Check if there's a return queryString then preselect the coresponding data
            if (window.location.search) {
                var id = window.location.search.split("?id=").pop();
                $('#data-select #' + id).attr('selected', 'selected');
            }
            dataChange();
        }
    );
    $('#data-select').on('change', dataChange);
    $('#chart-type').on('change', changeChart);
    $('#dimX-select').on('change', changeChart);
    $('#value-select').on('change', changeChart);
});

function dataChange() {
    let selectedOption = getSelectedOption($('#data-select'));
    const data = selectedOption.data('jsonQuery');
    _apiRequest(
        "../include/_php/services/query_builder.php",
        "POST",
        data,
        "json",
        result => {
            $('#value-select').empty();
            $('#dimX-select').empty();
            jsonData = result;
            for (const field in result[0]) {
                let fieldOption = $("<option></option>", {
                    value: field,
                });
                fieldOption.text(field);
                if (!isNaN(result[0][field])) {
                    $('#value-select').append($(fieldOption).clone());
                } else {
                    $('#dimX-select').append($(fieldOption).clone());
                }
            }
            changeChart();
        }
    );
}

function changeChart() {
    let dimXField = getSelectedOption($('#dimX-select')).val();
    let valueField = getSelectedOption($('#value-select')).val();
    let chartType = getSelectedOption($('#chart-type')).val();
    let dataArray = [];
    for (let i = 0; i < jsonData.length; i++) {
        const element = jsonData[i];
        let dimX = element[dimXField];
        let value = element[valueField];
        dataArray.push([
            dimX, +value
        ]);
    }
    drawChart([{
        name: 'Value',
        data: dataArray
    }], chartType);
}

function drawChart(seriesArray, hcType) {
    Highcharts.chart('chartContainer', {
        chart: {
            type: hcType,
            zoomType: 'x',
        },
        title: {
            text: ''
        },
        yAxis: {
            title: {
                text: null
            }
        },
        credits: {
            enabled: false
        },
        legend: {
            enabled: false
        },
        xAxis: {
            type: "category"
        },
        series: seriesArray
    });
}