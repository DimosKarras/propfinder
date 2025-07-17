// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("criminalityBuildings");
var buildingsCriminalityChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["Άνδρες", "Γυναίκες"],
        datasets: [{
            data: [40000, 60000],
            backgroundColor: [
                '#007bff', '#6610f2', '#6f42c1', '#d63384', '#dc3545',
                '#fd7e14', '#ffc107', '#28a745', '#20c997', '#17a2b8',
                '#e83e8c', '#fd7e14', '#f6c23e', '#4e73df', '#1cc88a',
                '#36b9cc', '#4b7bec', '#cc969e', '#a4de02', '#d8a60b'
            ],
            hoverBackgroundColor: [
                '#0056b3', '#520d8b', '#563d7c', '#bd316a', '#b52a31',
                '#c56109', '#b38600', '#1d8735', '#178e77', '#117a8b',
                '#c71585', '#cb6502', '#daa520', '#3758b0', '#158a7c',
                '#2a9d8f', '#3954a5', '#b28690', '#8cc000', '#bf8f00'
            ],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
        },
        legend: {
            display: false
        },
        cutoutPercentage: 80,
    },
});
