document.addEventListener("DOMContentLoaded", function () {

    const myChart = document.querySelector(".my-chartIncome");

    new Chart(myChart, {
        type: "doughnut",
        data: {
            labels: chartData.labels,
            datasets: [{
                label: "Percentage",
                data: chartData.values,
                backgroundColor: [
                    'rgba(64, 67, 134, 1)',
                    'rgba(67, 133, 210, 1)',
                    'rgba(229, 235, 244, 1)',
                    'rgba(217, 217, 217, 1)',
                ],
            }],
        },
        options: {
            borderWidth: 15,
            borderRadius: 2,
            hoverBorderWidth: 0,
            plugins: {
                legend: {
                    display: false,
                },
            },
        },
    });
});

document.addEventListener("DOMContentLoaded", function () {

    const myChartt = document.querySelector(".my-chartExp");

    new Chart(myChartt, {
        type: "doughnut",
        data: {
            labels: charttData.labels,
            datasets: [{
                label: "Percentage",
                data: charttData.values,
                backgroundColor: [
                    'rgba(64, 67, 134, 1)',
                    'rgba(67, 133, 210, 1)',
                    'rgba(172, 202, 237, 1)',
                    'rgba(229, 235, 244, 1)',
                    'rgba(217, 217, 217, 1)',
                ],
            }],
        },
        options: {
            borderWidth: 15,
            borderRadius: 2,
            hoverBorderWidth: 0,
            plugins: {
                legend: {
                    display: false,
                },
            },
        },
    });
});

document.addEventListener("DOMContentLoaded", function () {

    const myCharttt = document.querySelector(".my-chartFin");

    new Chart(myCharttt, {
        type: "doughnut",
        data: {
            labels: chartttData.labels,
            datasets: [{
                label: "Percentage",
                data: chartttData.values,
                backgroundColor: [
                    'rgba(64, 67, 134, 1)',
                    'rgba(67, 133, 210, 1)',
                    'rgba(217, 217, 217, 1)',
                ],
            }],
        },
        options: {
            borderWidth: 15,
            borderRadius: 2,
            hoverBorderWidth: 0,
            plugins: {
                legend: {
                    display: false,
                },
            },
        },
    });
});