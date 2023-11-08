$(function () {

  var tablaIngresosCapital = null;
  var dataSetIngresosCapital = null;
  listarIngresosCapital();

    var months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    var date = new Date();
    var day = date.getDate();
    var month = months[date.getMonth()];
    var year = date.getFullYear();
    document.querySelector('.barraFecha').innerHTML = '<div class="d-flex flex-row">';
    document.querySelector('.barraFecha').innerHTML += '<div>'+ day + ' de ' + month + ' de ' + year+'</div>';
    document.querySelector('.barraFecha').innerHTML += '<a href="#myModal" data-toggle="modal"><img src="src/Vista/img/calendario.png" alt="" style="width:28px;" class="ms-3"></a>';

    var dayNumber = date.getDay();
    
    var dayNames = [
        'Domingo',
        'Lunes',
        'Martes',
        'Miércoles',
        'Jueves',
        'Viernes',
        'Sábado'
      ];

    var dayName = dayNames[dayNumber];

    document.querySelector('.nombreDia').innerHTML = dayName;

    
    // Formulario de ingreso de capital

    var formAgregarIngresoCapital = document.querySelectorAll('#formAgregarIngresoCapital');

    Array.prototype.slice.call(formAgregarIngresoCapital)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
            form.classList.add('was-validated')
          } else {
            event.preventDefault();

            // Formateo de fecha
            var fechaIngreso = new Date();
            const año = fechaIngreso.getFullYear();
            const mes = fechaIngreso.getMonth() + 1; // Sumamos 1 para obtener un valor de mes entre 1 y 12
            const dia = fechaIngreso.getDate();
            const fechaIngresoFormateada = `${año}-${mes.toString().padStart(2, '0')}-${dia.toString().padStart(2, '0')}`;

            // Formateo de hora
            let horaActual = date.getHours();
            let minutosActuales = date.getMinutes();
            let segundosActuales = date.getSeconds();
            let horaIngresoFormateada = `${horaActual}:${minutosActuales.toString().padStart(2, '0')}:${segundosActuales.toString().padStart(2, '0')}`; 

            var montoIngreso = $("#txt-montoIngreso").val();
            var capitalIngreso = $("#txt-capitalIngreso").val();
            var formaPagoIngreso = $("#txt-formaPagoIngreso").val();
            
            alert(fechaIngreso + " " + horaIngresoFormateada);

            var objData = new FormData();
            objData.append("regFechaIngreso", fechaIngresoFormateada);
            objData.append("regHoraIngreso", horaIngresoFormateada);
            objData.append("regMontoIngreso", montoIngreso);
            objData.append("regCapitalIngreso", capitalIngreso);
            objData.append("regFormaPagoIngreso", formaPagoIngreso);

            fetch('src/controladores/interfazUsoDiarioControl.php', {
              method: 'POST',
              body: objData
            }).then(response => response.json()).catch(error => {
              console.log(error);
            }).then(response => {
              if (response["codigo"] == "200") {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: response["respuesta"],
                    showConfirmButton: false,
                    timer: 1000,
                    customClass: {
                        title: 'swal'
                    }
                });

              } else {
                  Swal.fire({
                      position: 'center',
                      icon: 'error',
                      title: response["mensaje"],
                      showConfirmButton: false,
                      timer: 1000
                  });
            }
            form.reset();
            $("#ventanaAgregarIngresoCapital").modal('toggle');
            listarIngresosCapital();
            });

          }
        }, false)
      });

      // Función de listar Ingresos

      function listarIngresosCapital() {
        var objData = new FormData();
        objData.append("listaIngresosCapital", "ok");
    
        fetch('src/controladores/interfazUsoDiarioControl.php', {
          method: 'POST',
          body: objData
        }).then(response => response.json()).catch(error => {
          console.log(error);
        }).then(response => {
          cargarDatos(response);
        });
      }
      
      function cargarDatos(response) {
        var dataSetIngresosCapital = [];      
        response.forEach(listarDatos);
    
        function listarDatos(item, index) {
          // var objBotones = '<div class="btn-group align-center">';
          // objBotones += '<button id="btnEditar" type="button" class="btn btn-warning" idvehiculo="' + item.idvehiculo + '" placa="' + item.placa + '" color="' + item.color + '" marca="' + item.marca + '" modelo="' + item.modelo + '" tipoVehiculo="' + item.nombre_tipo_vehiculo + '" data-bs-toggle="modal" data-bs-target="#ventanaEditarVehiculo"><img src="vista/img/edit.png" alt="" style="width:25px;" class="ms-2 p-1"></button>';
          // objBotones += '<button id="btnEliminar" type="button" class="btn btn-danger" idvehiculo="' + item.idvehiculo + '"><img src="vista/img/trash.png" alt="" style="width:30px;" class="p-2"></button>';
          // objBotones += '</div>';
            
          dataSetIngresosCapital.push(["Ingreso",item.horaIngreso, item.descripcionIngreso, item.valorIngreso]);
        }
      
        if (tablaIngresosCapital != null) {
        $("#tablaIngresosCapital").dataTable().fnDestroy();        
        }
        tablaIngresosCapital = $("#tablaIngresosCapital").DataTable({
          data: dataSetIngresosCapital
        });
      };


    // Formulario de ahorro de capital

    var formAgregarAhorroCapital = document.querySelectorAll('#formAgregarAhorroCapital');

    Array.prototype.slice.call(formAgregarAhorroCapital)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
            form.classList.add('was-validated')
          } else {
            event.preventDefault();

            // Formateo de fecha
            var fechaAhorro = new Date();
            const año = fechaAhorro.getFullYear();
            const mes = fechaAhorro.getMonth() + 1; // Sumamos 1 para obtener un valor de mes entre 1 y 12
            const dia = fechaAhorro.getDate();
            const fechaAhorroFormateada = `${año}-${mes.toString().padStart(2, '0')}-${dia.toString().padStart(2, '0')}`;

            // Formateo de hora
            let horaActual = date.getHours();
            let minutosActuales = date.getMinutes();
            let segundosActuales = date.getSeconds();
            let horaAhorroFormateada = `${horaActual}:${minutosActuales.toString().padStart(2, '0')}:${segundosActuales.toString().padStart(2, '0')}`; 

            var montoAhorro = $("#txt-montoAhorro").val();
            var descripcionAhorro = $("#txt-descripcionAhorro").val();
            var capitalAhorro = $("#txt-capitalAhorro").val();
            
            alert(fechaAhorro + " " + horaAhorroFormateada);

            var objData = new FormData();
            objData.append("regFechaAhorro", fechaAhorroFormateada);
            objData.append("regHoraAhorro", horaAhorroFormateada);
            objData.append("regMontoAhorro", montoAhorro);
            objData.append("regDescripcionAhorro", descripcionAhorro);
            objData.append("regCapitalAhorro", capitalAhorro);

            fetch('src/controladores/interfazUsoDiarioControl.php', {
              method: 'POST',
              body: objData
            }).then(response => response.json()).catch(error => {
              console.log(error);
            }).then(response => {
              if (response["codigo"] == "200") {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: response["respuesta"],
                    showConfirmButton: false,
                    timer: 1000,
                    customClass: {
                        title: 'swal'
                    }
                });

              } else {
                  Swal.fire({
                      position: 'center',
                      icon: 'error',
                      title: response["mensaje"],
                      showConfirmButton: false,
                      timer: 1000
                  });
            }
            form.reset();
            $("#ventanaAgregarAhorroCapital").modal('toggle');
            listarAhorrosCapital();
            });

          }
        }, false)
      });

});