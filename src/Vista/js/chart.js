
class graficoHoy {

    constructor(objData) {
        this.objGrafico = objData; // Cambiado el nombre y eliminado el guion bajo
    }

    
    traerValoresGrafico() {
        var objData = new FormData();
        objData.append("traerValoresGrafico", this.objGrafico.traerValoresGrafico);
        objData.append("fechaValoresGrafico", this.objGrafico.fechaValoresGrafico);
  
        fetch("src/controladores/chartControl.php", {
          method: 'POST',
          body: objData
        })
        .then(response => response.json())
        .catch(error => {
          console.log(error);
          return {};
        })
        .then(response => {
            var sumaGastos = response[0].suma_gastos;
            var sumaIngresos = response[0].suma_ingresos;
            var sumaRegAhorros = response[0].suma_regAhorros;

            // Llama a renderModelsChart después de obtener los valores
            this.renderModelsChart(sumaGastos, sumaIngresos, sumaRegAhorros);
        });
    }

    printChart = () => {
        // No es necesario llamar renderModelsChart aquí, ya que traerValoresGrafico lo hace
    };

    renderModelsChart = (sumaGastos, sumaIngresos, sumaRegAhorros) => {
        // Datos iniciales con los valores obtenidos
        const initialData = {
            labels: ["AHORROS", "GASTOS", "INGRESOS"],
            datasets: [{
                data: [sumaRegAhorros, sumaGastos, sumaIngresos],
                backgroundColor: ["#CCD1DF", "#E0D1D1", "#BADCC1"],
                borderColor: ["#0F175C", "#270000", "#004614"],
            }]
        };

        const options = {
            plugins: {
                legend: {
                    position: "bottom",
                    labels: {
                        usePointStyle: true,
                        boxWidth: 1000,
                        padding: 25,
                        font: {
                            family: "'Monda', sans-serif",
                            size: 16,
                            weight: 'bolder',
                        },
                        color: '#e1e1e1'
                    },
                },
            },
        };

        const myChart = new Chart("myChart", { type: "pie", data: initialData, options });
    };

    datosSelect = () => {
        // Código para datosSelect si es necesario
    };

    updateChart = (newData) => {
        const myChart = Chart.getChart("myChart");
        myChart.data = newData;
        myChart.update();
    };

    //  printChart();


    
}

