var lineChartData = {
    labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
    datasets: [
        {
            label: "Profit",
            data: [2000, 2400, 2100, -219, 6000, 3000, 2601],
            pointBackgroundColor: "rgba(16,133,135,1)",
            pointBorderColor: "#fff",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(16,133,135,1)",
            tension: 0.4,
            fill: true,
        },
        {
            label: "Deposit",
            data: [1500, 1800, 1600, 1200, 1700, 2000, 1800],
            pointBackgroundColor: "rgba(255,100,50,1)",
            pointBorderColor: "#fff",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(255,100,50,1)",
            tension: 0.4,
            fill: false,
        },
        {
            label: "Withdrawal",
            data: [3000, 3500, 3000, 2400, 3800, 2800, 3200],
            pointBackgroundColor: "rgba(50,150,255,1)",
            pointBorderColor: "#fff",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(50,150,255,1)",
            tension: 0.4,
            fill: false,
        }
    ],
};

// Ensure the DOM is fully loaded before executing the script
window.addEventListener("load", function () {
    var canvas = document.getElementById("canvas");
    if (!canvas) {
        console.error("Canvas element not found!");
        return;
    }

    var ctx = canvas.getContext("2d");

    // Determine the current day of the week
    var currentDay = new Date().getDay(); // 0 (Sunday) to 6 (Saturday)

    // Rotate the labels and data arrays to place the current day at the right
    function rotateArrayToRightEnd(array, currentDay) {
        return array.slice(currentDay + 1).concat(array.slice(0, currentDay + 1));
    }

    lineChartData.labels = rotateArrayToRightEnd(lineChartData.labels, currentDay);
    lineChartData.datasets.forEach(function(dataset) {
        dataset.data = rotateArrayToRightEnd(dataset.data, currentDay);
    });

    // Create a gradient for the first dataset line (Profit)
    var gradientProfit = ctx.createLinearGradient(0, 0, canvas.width, 0); // Horizontal gradient
    gradientProfit.addColorStop(0, "rgba(16,133,135,1)");
    gradientProfit.addColorStop(1, "rgba(255,100,50,1)");

    // Assign the gradient to the first dataset's borderColor (Profit)
    lineChartData.datasets[0].borderColor = gradientProfit;

    // Create a gradient for the second dataset line (Expenses)
    var gradientExpenses = ctx.createLinearGradient(0, 0, canvas.width, 0); // Horizontal gradient
    gradientExpenses.addColorStop(0, "rgba(255,100,50,1)");
    gradientExpenses.addColorStop(1, "rgba(255,200,50,1)");

    // Assign the gradient to the second dataset's borderColor (Expenses)
    lineChartData.datasets[1].borderColor = gradientExpenses;

    // Create a gradient for the third dataset line (Revenue)
    var gradientRevenue = ctx.createLinearGradient(0, 0, canvas.width, 0); // Horizontal gradient
    gradientRevenue.addColorStop(0, "rgba(50,150,255,1)");
    gradientRevenue.addColorStop(1, "rgba(100,200,255,1)");

    // Assign the gradient to the third dataset's borderColor (Revenue)
    lineChartData.datasets[2].borderColor = gradientRevenue;

    // Create the chart
    new Chart(ctx, {
        type: "line",
        data: lineChartData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1000, // Interval between steps
                        color: "#1ED6FF",
                    },
                },
                x: {
                    beginAtZero: true,
                    ticks: {
                        color: "#1ED6FF",
                    },
                },
            },
            plugins: {
                legend: {
                    display: true,
                    position: "top",
                },
                tooltip: {
                    callbacks: {
                        title: function(tooltipItem) {
                            return `Day: ${tooltipItem[0].label}`;
                        },
                        label: function(tooltipItem) {
                            return `${tooltipItem.dataset.label}: ${tooltipItem.raw} units`;
                        },
                    },
                },
            },
        },
    });
});
