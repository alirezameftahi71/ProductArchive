$(function () {
    _apiRequest(
        "../include/_php/services/json_builder.php",
        "GET",
        null,
        "json",
        function (data) {
            var seriesArray = [{
                name: 'Count of Games',
                data: data
            }];
            var config = hcConfigBuilder(seriesArray, 'column');
            drawChart('chartContainer', config);
        }
    );
});

function drawChart(chartContainerId, config) {
    Highcharts.chart(chartContainerId, config);
}

function hcConfigBuilder(seriesArray, hcType){
    return {
        chart: {
            type: hcType,
            margin: [100, 100, 100, 100]
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
    };
}