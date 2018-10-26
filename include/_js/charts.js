$(function () {
    _apiRequest(
        "../include/_php/services/json_builder.php",
        "GET",
        null,
        "json",
        function (data) {
            Highcharts.chart('chartContainer', {
                chart: {
                    renderTo: 'container',
                    type: 'column',
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
                series: [{
                    name: 'Count of Games',
                    data: data
                }]
            });
        }
    );
});