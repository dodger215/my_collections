const canvas = document.querySelector('canvas');
var ctx = canvas.getContext('2d');

// Correct data structure
const data = {
    labels: ['MALE', 'FEMALE'], // Changed 'label' to 'labels'
    datasets: [{
        data: [totalMale, totalFemale],
        backgroundColor: "rgb(45, 23, 111)",
        borderColor: "#000",
        borderWidth: 1
    }]
};

// Correct option structure
const options = {
    scales: { // Changed 'scale' to 'scales'
        y: {
            beginAtZero: true
        }
    }
};

// Create chart with corrected options and data
const chart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: options
});
