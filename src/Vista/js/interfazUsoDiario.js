$(function () {

  var tablaTransaccionesCapital = null;
  listarTransaccionesCapital();
  
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
    
    // Formulario de Registro de ingreso al capital

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
            // alert(fechaIngreso + " " + horaIngresoFormateada);

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
                
                let objDataCapital = {"listarCapital":"ok"};
                let objRespuesta = new CapitalUsuario(objDataCapital);
                objRespuesta.listarCapital();

                form.reset();
                $("#ventanaAgregarIngresoCapital").modal('toggle');
                listarTransaccionesCapital();

              } else {
                  Swal.fire({
                      position: 'center',
                      icon: 'error',
                      title: response["mensaje"],
                      showConfirmButton: false,
                      timer: 1000
                  });
            }
            
            });
          }
        }, false)
      });


       // Formulario de Edición ingreso al capital

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

            var idingreso = $('btnEditarIngresoCapital').attr('idingreso');
            var montoIngreso = $("#txt-editmontoIngreso").val();
            var capitalIngreso = $("#txt-editcapitalIngreso").val();
            var formaPagoIngreso = $("#txt-editformaPagoIngreso").val();
            // alert(fechaIngreso + " " + horaIngresoFormateada);

            var objData = new FormData();

            objData.append("editIdIngreso", idingreso);
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
                
                let objDataCapital = {"listarCapital":"ok"};
                let objRespuesta = new CapitalUsuario(objDataCapital);
                objRespuesta.listarCapital();

                form.reset();
                $("#ventanaEditarIngresoCapital").modal('toggle');
                listarTransaccionesCapital();

              } else {
                  Swal.fire({
                      position: 'center',
                      icon: 'error',
                      title: response["mensaje"],
                      showConfirmButton: false,
                      timer: 1000
                  });
            }
            
            });
          }
        }, false)
      });





      // Formulario de ahorro del capital

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

                let objDataCapital = {"listarCapital":"ok"};
                let objRespuesta = new CapitalUsuario(objDataCapital);
                objRespuesta.listarCapital();

                form.reset();
                $("#ventanaAgregarAhorroCapital").modal('toggle');
                listarTransaccionesCapital();

              } else {
                  Swal.fire({
                      position: 'center',
                      icon: 'error',
                      title: response["mensaje"],
                      showConfirmButton: false,
                      timer: 1000
                  });
            }
            
            });

          }
        }, false)
      });

      // Función de listar Transacciones

      function listarTransaccionesCapital() {
        var objData = new FormData();
        objData.append("listaTransaccionesCapital", "ok");
    
        fetch('src/controladores/interfazUsoDiarioControl.php', {
          method: 'POST',
          body: objData
        }).then(response => response.json()).catch(error => {
          console.log(error);
        }).then(response => {
          cargarDatosTransacciones(response);
        });
      }
      
      function cargarDatosTransacciones(response) {
        var dataSetTransaccionesCapital = [];      
        response.forEach(listarDatos);

        function listarDatos(item, index) {
          var objBotones = '<div class="btn-group align-center">';

          if (item.tipoTransaccion === "Ingreso") {
            objBotones += '<button id="btnEditar" type="button" class="" idTransaccion="' + item.idTransaccion + '" idCapital="' + item.idCapital + '" idFormaPago="' + item.idFormaPago + '" tipoTransaccion="' + item.tipoTransaccion + '" horaTransaccion="' + item.horaTransaccion + '" descripcionTransaccion="' + item.descripcionTransaccion + '" montoTransaccion="' + item.montoTransaccion + '" data-bs-toggle="modal" data-bs-target="#ventanaEditarIngresoCapital"><img src="src/Vista/img/editarTransaccion1.png" alt="" style="width:25px;" class="ms-2 p-1"></button>';
            item.tipoTransaccion = '<img src="src/Vista/img/ingresoBoton.png" alt="Ingreso" style="width:20px;">';
            
          } else if (item.tipoTransaccion === "Ahorro") {
            objBotones += '<button id="btnEditar" type="button" class="" idTransaccion="' + item.idTransaccion + '" idCapital="' + item.idCapital + '" idFormaPago="' + item.idFormaPago + '" tipoTransaccion="' + item.tipoTransaccion + '" horaTransaccion="' + item.horaTransaccion + '" descripcionTransaccion="' + item.descripcionTransaccion + '" montoTransaccion="' + item.montoTransaccion + '" data-bs-toggle="modal" data-bs-target="#ventanaEditarAhorroCapital"><img src="src/Vista/img/editarTransaccion1.png" alt="" style="width:25px;" class="ms-2 p-1"></button>';
            item.tipoTransaccion = '<img src="src/Vista/img/ahorroBoton.png" alt="Ingreso" style="width:20px;">';
          }

          objBotones += '<button id="btnEliminar" type="button" class=""><img src="src/Vista/img/eliminarTransaccion.png" alt="" style="width:30px;" class="p-2"></button>';
          objBotones += '</div>';

          let date = new Date(`1970-01-01T${item.horaTransaccion}Z`);
          date.setHours(date.getHours() + 5);
          let strTime = date.toLocaleTimeString('es-CO', { hour: '2-digit', minute: '2-digit', hour12: true });

          item.horaTransaccion = strTime;
            
          dataSetTransaccionesCapital.push([item.horaTransaccion, item.tipoTransaccion,  item.descripcionTransaccion, parseFloat(item.montoTransaccion).toLocaleString('es-CO', { style: 'currency', currency: 'COP', minimumFractionDigits: 0 }), objBotones]);
        }
      
        if (tablaTransaccionesCapital != null) {
        $("#tablaTransaccionesCapital").dataTable().fnDestroy();        
        }
        tablaTransaccionesCapital = $("#tablaTransaccionesCapital").DataTable({
          data: dataSetTransaccionesCapital
        });
      };

      // Botón para editar Transacción
      
      $("#tablaTransaccionesCapital").on("click", "#btnEditar", function () {
        var idtransaccion = $(this).attr('idTransaccion');
        var horaTransaccion = $(this).attr('horaTransaccion');
        var descripcionTransaccion = $(this).attr('idCapital');
        var montoTransaccion = $(this).attr('montoTransaccion');
        var formaPago = $(this).attr('idFormaPago');

        if ($(this).attr('tipoTransaccion') === "Ingreso") {
          alert("Ingreso");
          $("#btnEditarIngresoCapital").attr("idingreso",idtransaccion);
          $("#txt-editmontoIngreso").val(montoTransaccion);
          $("#txt-editcapitalIngreso").val(descripcionTransaccion);
          $("#txt-editformaPagoIngreso").val(formaPago);
          alert(idtransaccion); 


        } else if ($(this).attr('tipoTransaccion') === "Ahorro") {
          alert("Ahorro");
        }
    
        $("#txt-editcolor").val(color);
        $("#txt-editmarca").val(marca);
        $("#txt-editmodelo").val(modelo);
        $("#txt-edittipoVehiculo").val(tipoVehiculo);
      });

    
});