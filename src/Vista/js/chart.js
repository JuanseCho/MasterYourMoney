const printChart = () => {
  renderModelsChart();
  datosSelect(); // Llama a la función datosSelect para manejar cambios en el select
};

const renderModelsChart = () => {
  // Datos iniciales (puedes ajustar estos valores según tus necesidades)
  const initialData = {
      labels: ["ahorros", "gastos", "presupuestos"],
      datasets: [{
          data: [50, 50, 50],
      }]
  };

  const options = {
      plugins: {
          legend: {
              position: "bottom",
          }
      }
  };

  const myChart = new Chart("myChart", { type: "pie", data: initialData, options });
};

const datosSelect = () => {
  const selectElement = document.querySelector("#selectChart");

  // Manejar el evento de cambio en el select
  selectElement.onchange = e => {
      const selectedValue = e.target.value;
      
      // Cambiar los datos del gráfico según el valor seleccionado
      const newData = getChartDataForOption(selectedValue);
      
      // Actualizar el gráfico con los nuevos datos
      updateChart(newData);
  };
};

const getChartDataForOption = (selectedOption) => {
  // Define y devuelve los datos del gráfico según la opción seleccionada
  switch (selectedOption) {
      case "gastos":
          return {
              labels: ["Categoria1", "Categoria2", "Categoria3"],
              datasets: [{
                  data: [10, 50, 50],
              }]
          };
      case "ahorros":
          return {
              labels: ["Item1", "Item2", "Item3"],
              datasets: [{
                  data: [10, 20, 30],
              }]
          };
      case "ingresos":
          return {
              labels: ["Item1", "Item2", "Item3"],
              datasets: [{
                  data: [10, 20, 30],
              }]
          };
      // Agrega más casos según sea necesario
      default:
          return {
              labels: ["Ingresos", "Gastos", "Ahorros"],
              datasets: [{
                  data: [20, 10, 40],
              }]
          };
  }
};

const updateChart = (newData) => {
  const myChart = Chart.getChart("myChart");

  // Actualizar los datos del gráfico
  myChart.data = newData;

  // Redibujar el gráfico con los nuevos datos
  myChart.update();
};

printChart();
