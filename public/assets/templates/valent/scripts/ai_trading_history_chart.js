var lineChartData = {
    labels: [], // This will be populated dynamically with date ranges
    datasets: [
        {
            label: "Profit",
            data: Array(30 * 24).fill(0).map(() => Math.floor(Math.random() * 5000) - 1000), // Random data for past 30 days (24 hours per day)
            pointBackgroundColor: "rgba(16,133,135,1)",
            pointBorderColor: "#fff",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(16,133,135,1)",
            tension: 0.4,
            fill: true,
        },
        {
            label: "Loss",
            data: Array(30 * 24).fill(0).map(() => Math.floor(Math.random() * 3000) - 500), // Random data for past 30 days (24 hours per day)
            pointBackgroundColor: "rgba(255,100,50,1)",
            pointBorderColor: "#fff",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(255,100,50,1)",
            tension: 0.4,
            fill: false,
        },
    ],
};

// Generate day ranges for the past 30 days
function generateDayLabels(days) {
    let labels = [];
    let now = new Date();

    for (let i = days - 1; i >= 0; i--) {
        let currentDate = new Date(now.getTime() - i * 24 * 60 * 60 * 1000); // Subtract i days from now

        // Format start and end days (the same for each day in this case)
        let startDay = String(currentDate.getDate()).padStart(2, "0");
        let endDay = String(currentDate.getDate()).padStart(2, "0");

        // Combine into (DD-DD)
        //labels.push(`(${startDay}-${endDay})`);
        labels.push(`${startDay}-${endDay}`);
    }
    return labels;
}

// Populate the labels with corresponding date ranges for the past 30 days
lineChartData.labels = generateDayLabels(30); // 30 days

// Ensure the DOM is fully loaded before executing the script
window.addEventListener("load", function () {
    var canvas = document.getElementById("canvas");
    if (!canvas) {
        console.error("Canvas element not found!");
        return;
    }

    var ctx = canvas.getContext("2d");

    // Create a gradient for the first line (Profit)
    var gradientProfit = ctx.createLinearGradient(0, 0, canvas.width, 0); // Horizontal gradient
    gradientProfit.addColorStop(0, "rgba(16,133,135,1)");
    gradientProfit.addColorStop(1, "rgba(255,100,50,1)");

    // Create a gradient for the second line (Expenses)
    var gradientExpenses = ctx.createLinearGradient(0, 0, canvas.width, 0); // Horizontal gradient
    gradientExpenses.addColorStop(0, "rgba(255,100,50,1)");
    gradientExpenses.addColorStop(1, "rgba(255,200,50,1)");

    // Assign the gradients to the datasets' borderColors
    lineChartData.datasets[0].borderColor = gradientProfit;
    lineChartData.datasets[1].borderColor = gradientExpenses;

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
                    ticks: {
                        color: "#1ED6FF",
                        maxRotation: 90,
                        minRotation: 45,
                    },
                },
            },
            plugins: {
                legend: {
                    display: true,
                    position: "top",
                },
            },
        },
    });
});
