const myCanvas = document.getElementById("myCanvas");

let labels = [];
result.forEach(element => {
    labels.push(element["name"]);
});

let data = [];
result.forEach(element => {
    data.push(element["total"]);
});

const gChart = new Chart(myCanvas, {
    type: "pie",
    data: {
        labels: labels,
        datasets: [{
            data: data,
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(255, 159, 64, 0.5)',
                'rgba(255, 205, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(201, 203, 207, 0.5)'
              ],
        }]
    },
    options: {
        plugins: {
          legend: {
            display: true
          }
        }
    }
});

myCanvas.style.width = "100%";
myCanvas.style.height = "50%";