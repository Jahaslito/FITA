var temperatureData;



$(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       $.ajax(
        {
            url:'/chart_data',
            method: 'post',
            data:{},
            success: function(result) {
                let barData= result.barData;
                let groupedBarData= result.groupedBarData;
                console.log("Grouped Data: ",groupedBarData);
                $("#temperatureData").val= barData;
                populateBarChart(barData, 'bar', 'myBarChart');
                populateBarChart(barData, 'pie', 'myPieChart');
                populateBarChart(barData, 'line', 'myLineChart');
                populateGroupedBarChart(groupedBarData,'bar','myGroupedBarChart');
            },
            error: function(result) {
                console.log(result);
            },
        });

        $("#chartType").change(function() {
            let chartType= $("#chartType").val();
            switch (chartType) {
                case 'bar':
                    $("#line-chart-card").hide();
                    $("#pie-chart-card").hide();
                    $("#bar-chart-card").show();
                    break;
                case 'pie':
                    $("#bar-chart-card").hide();
                    $("#line-chart-card").hide();
                    $("#pie-chart-card").show();
                    break;
                case 'line':
                    $("#bar-chart-card").hide();
                    $("#pie-chart-card").hide();
                    $("#line-chart-card").show();
                default:
                    break;
            }
        });
    });



function populateBarChart(temperatureData, chartType, chartId){
    const ctx = document.getElementById(chartId).getContext('2d');
    document.getElementById(chartId).style.height ="250px";
    var myChart = new Chart(ctx, {
        type: chartType,
        data: {
            labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', "Saturday"],
            datasets: [{
                label: 'Average Temperature',
                data: temperatureData,
                barPercentage: 40,
                barThickness: 55,

                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(13, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(13, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 4
            }]
        },
        options: {
            scales: {
            },
            title:{
                display: true,
                text: "Title"
            },
            legend:{
                display: true,
                position: 'right'
            }
        }
    });
    
}

function populateGroupedBarChart(temperatureData, chartType, chartId){
    let datasets=[
        {
            label: "Highest",
            backgroundColor: ["#e96562"],
            data: [
                temperatureData[0][0],temperatureData[1][0],temperatureData[2][0],temperatureData[3][0],
                temperatureData[4][0],temperatureData[5][0]
            ]
        },
        {
            label: "Lowest",
            backgroundColor: ["#414e63"],
            data: [
                temperatureData[0][1],temperatureData[1][1],temperatureData[2][1],temperatureData[3][1],
                temperatureData[4][1],temperatureData[5][1]
            ]
        },
       
    ]
    const ctx = document.getElementById(chartId).getContext('2d');
    document.getElementById(chartId).style.height ="250px";
    var myChart = new Chart(ctx, {
        type: chartType,
        data: {
            labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', "Saturday"],
            datasets: datasets
        },
        options: {
            scales: {
            },
            title:{
                display: true,
                text: "Title"
            },
            legend:{
                display: true,
                position: 'right'
            }
        }
    });
    
}
