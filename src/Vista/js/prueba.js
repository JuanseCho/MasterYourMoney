const printChart2 = () => {
    renderModelsChart2();
};

const renderModelsChart2 = () => {
    // Datos para el gráfico de anillo
    const data = {
        labels: ["A", "B", "C"],
        datasets: [
            {
                data: [30, 40, 30],
                backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56"],
            },
            {
                data: [10, 20, 30],
                backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56"],
                borderWidth: 0,
            },
        ],
    };

    // Etiquetas personalizadas para cada capa del anillo
    const layer1Labels = ["Gastos", "Ahorros", "Presupuestos"];
    const layer2Labels = ["Transporte", "Comida", "Salud"];

    // Calcular los porcentajes relativos para la subdivisión del segundo anillo
    const totalPercentage = data.datasets[1].data.reduce((acc, val) => acc + val, 0);
    const subdividedData = data.datasets[1].data.map(value => (value / totalPercentage) * 100);

    const options = {
        cutoutPercentage: 75,
        plugins: {
            legend: {
                position: "bottom",
            }
        },
        tooltips: {
            callbacks: {
                label: function (tooltipItem, data) {
                    const datasetIndex = tooltipItem.datasetIndex;
                    const dataIndex = tooltipItem.index;

                    if (datasetIndex === 0) {
                        return layer1Labels[dataIndex];
                    } else if (datasetIndex === 1) {
                        const subdividedValue = subdividedData[dataIndex];
                        return `${layer2Labels[dataIndex]}: ${subdividedValue.toFixed(1)}%`;
                    }
                },
            },
        },
        onClick: (event, elements) => {
            if (elements.length > 0) {
                const clickedIndex = elements[0].index;
                const datasetIndex = elements[0].datasetIndex;
                const clickedLabel = (datasetIndex === 0) ? layer1Labels[clickedIndex] : layer2Labels[clickedIndex];
                console.log(`Hiciste clic en: ${clickedLabel}`);
            }
        }
    };

    const myChart2 = new Chart("myChart2", {
        type: "doughnut",
        data,
        options,
    });
};

printChart2();
