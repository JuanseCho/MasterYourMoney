
$(document).ready(function () {

  let objDataCapital = { "listarCapital": "ok" };
  let objRespuesta = new CapitalUsuario(objDataCapital);
  objRespuesta.listarCapital();
  
  var objData = { listarPresupuesto: "ok" };
  var instance = new presupuestos(objData);
  instance.listarPresupuestos();

  let months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
  let dayNames = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
  let date = new Date();
  let day = date.getDate();
  let dayNumber = date.getDay();
  let dayName = dayNames[dayNumber];
  let monthName = months[date.getMonth()];
  const mes = date.getMonth() + 1; // Sumamos 1 para obtener un valor de mes entre 1 y 12
  let year = date.getFullYear();
  let horaActual = date.getHours();
  let minutosActuales = date.getMinutes();
  let segundosActuales = date.getSeconds();

  let fechaFormateada = `${year}-${mes.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
  let horaFormateada = `${horaActual}:${minutosActuales.toString().padStart(2, '0')}:${segundosActuales.toString().padStart(2, '0')}`;
  
  listarTransaccionesCapital();

  // let objDataGrafico = { "traerValoresGrafico": "ok", "fechaValoresGrafico": fechaFormateada };
  // let objRespuestaGrafico = new graficoHoy(objDataGrafico);
  // objRespuestaGrafico.traerValoresGrafico();

  var contenidoBarraFecha = `<div class="d-flex flex-row">
                                <div>`+ day + ' de ' + monthName + ' de ' + year + `</div>
                                <a href="#myModal" data-toggle="modal"><img src="src/Vista/img/calendario.png" alt="" style="width:28px;" class="ms-3"></a>
                                </div>`;

  $('#barraFecha').html(contenidoBarraFecha);
  $('#nombreDia').html(dayName);

  let objGrafico = { traerValoresGrafico: "ok", fechaValoresGrafico: fechaFormateada };
  let objRespuestaGrafico = new graficoHoy(objGrafico);
  objRespuestaGrafico.traerValoresGrafico();


  // Formulario de Registro de ingreso al capital

  var formAgregarIngresoCapital = document.querySelectorAll('#formAgregarIngresoCapital');

  Array.prototype.slice.call(formAgregarIngresoCapital).forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
          form.classList.add('was-validated')
        } else {
          event.preventDefault();

          var montoIngreso = $("#txt-montoIngreso").val();
          var capitalIngreso = $("#txt-capitalIngreso").val();
          var formaPagoIngreso = $("#txt-formaPagoIngreso").val();

          var objData = new FormData();
          objData.append("regFechaIngreso", fechaFormateada);
          objData.append("regHoraIngreso", horaFormateada);
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
                timer: 2500,
                customClass: {
                  title: 'swal'
                }
              });

              form.reset();
              $("#ventanaAgregarIngresoCapital").modal('toggle');
              objRespuesta.listarCapital();

              listarTransaccionesCapital();

              let objGrafico = { traerValoresGrafico: "ok", fechaValoresGrafico: fechaFormateada };
              let objRespuestaGrafico = new graficoHoy(objGrafico);
              objRespuestaGrafico.traerValoresGrafico();

            } else {
              Swal.fire({
                position: 'center',
                icon: 'error',
                title: response["mensaje"],
                showConfirmButton: false,
                timer: 2500
              });
            }

          });
        }
      }, false)
    });


  // Formulario de Edición ingreso al capital

  // var formEditarIngresoCapital = document.querySelectorAll('#formEditarIngresoCapital');

  // Array.prototype.slice.call(formEditarIngresoCapital)
  //   .forEach(function (form) {
  //     form.addEventListener('submit', function (event) {
  //       if (!form.checkValidity()) {
  //         event.preventDefault()
  //         event.stopPropagation()
  //         form.classList.add('was-validated')
  //       } else {
  //         event.preventDefault();

  //         var idingreso = $('#btnEditarIngresoCapital').attr('idingreso');
  //         var montoIngreso = $("#txt-editmontoIngreso").val();
  //         var capitalIngreso = $("#txt-editcapitalIngreso").val();
  //         var formaPagoIngreso = $("#txt-editformaPagoIngreso").val();

  //         var objData = new FormData();
  //         objData.append("editIdIngreso", idingreso);
  //         objData.append("regMontoIngreso", montoIngreso);
  //         objData.append("regCapitalIngreso", capitalIngreso);
  //         objData.append("regFormaPagoIngreso", formaPagoIngreso);

  //         fetch('src/controladores/interfazUsoDiarioControl.php', {
  //           method: 'POST',
  //           body: objData
  //         }).then(response => response.json()).catch(error => {
  //           console.log(error);
  //         }).then(response => {
  //           if (response["codigo"] == "200") {
  //             Swal.fire({
  //               position: 'center',
  //               icon: 'success',
  //               title: response["respuesta"],
  //               showConfirmButton: false,
  //               timer: 2500,
  //               customClass: {
  //                 title: 'swal'
  //               }
  //             });

  //             let objDataCapital = { "listarCapital": "ok" };
  //             let objRespuesta = new CapitalUsuario(objDataCapital);
  //             objRespuesta.listarCapital();

  //             form.reset();
  //             $("#ventanaEditarIngresoCapital").modal('toggle');
  //             listarTransaccionesCapital();

  //           } else {
  //             Swal.fire({
  //               position: 'center',
  //               icon: 'error',
  //               title: response["mensaje"],
  //               showConfirmButton: false,
  //               timer: 2500
  //             });
  //           }

  //         });
  //       }
  //     }, false)
  //   });


  // Formulario de ahorro del capital

  var formAgregarAhorroCapital = document.querySelectorAll('#formAgregarAhorroCapital');

  Array.prototype.slice.call(formAgregarAhorroCapital).forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
          form.classList.add('was-validated')
        } else {
          event.preventDefault();

          var montoRegAhorro = $("#txt-montoRegAhorro").val();
          var ahorroRegAhorro = $("#txt-ahorroRegAhorro").val();
          var capitalRegAhorro = $("#txt-capitalRegAhorro").val();
          // alert(fechaAhorro + " " + horaAhorroFormateada);

          var objData = new FormData();
          objData.append("regFechaAhorro", fechaFormateada);
          objData.append("regHoraAhorro", horaFormateada);
          objData.append("regMontoAhorro", montoRegAhorro);
          objData.append("regDescripcionAhorro", ahorroRegAhorro);
          objData.append("regCapitalAhorro", capitalRegAhorro);

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
                timer: 2500,
                customClass: {
                  title: 'swal'
                }
              });

              form.reset();
              $("#ventanaAgregarAhorroCapital").modal('toggle');
              objRespuesta.listarCapital();

              listarTransaccionesCapital();

            } else {
              Swal.fire({
                position: 'center',
                icon: 'error',
                title: response["respuesta"],
                showConfirmButton: false,
                timer: 3500
              });
              form.reset();
              $("#ventanaAgregarAhorroCapital").modal('toggle');
              }

          });

        }
      }, false)
    });


    // Formulario de gasto del capital

    const formularioGastos = document.querySelectorAll("#formAgregarGasto");

    Array.from(formularioGastos).forEach((form) => {
        form.addEventListener("submit", (evento) => {
            if (!form.checkValidity()) {
                evento.preventDefault();
                evento.stopPropagation();
                form.classList.add("was-validated");
            } else {
                evento.preventDefault();

                let monto = $("#txt-montoGasto").val();
                let descripcion = $("#txt-descripcionGasto").val();
                let presupuesto = $("#slc-presupuesto").val();
                let formaPago = $("#slc-formaPago").val();

                var objData = new FormData();
                objData.append("horaGasto", horaFormateada);
                objData.append("fechaGasto", fechaFormateada);
                objData.append("descripcionGasto", descripcion);
                objData.append("montoGasto", monto);
                objData.append("IdPresupuesto", presupuesto);
                objData.append("formaPagoGasto", formaPago);

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
                      title: response["mensaje"],
                      showConfirmButton: false,
                      timer: 2500,
                      customClass: {
                        title: 'swal'
                      }
                    });

                    form.reset();
                    $("#ventanaAgregarGastoCapital").modal('toggle');
                    instance.listarPresupuestos();

                    listarTransaccionesCapital();
      
                  } else {
                    Swal.fire({
                      position: 'center',
                      icon: 'error',
                      title: response["respuesta"],
                      showConfirmButton: false,
                      timer: 3500
                    });
                    form.reset();
                    $("#ventanaAgregarGAstoCapital").modal('toggle');
                    }
      
                });
      
              }
            
        });

    });





  // Función de listar Transacciones

  function listarTransaccionesCapital() {

        var objData = new FormData();
        objData.append("listaTransaccionesCapital", "ok");
        objData.append("regFechaTransacciones", fechaFormateada);
    
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
        var inicioCaja = 0;
        var totalIngreso = 0;  
        var totalAhorro = 0;
        var totalGasto = 0;
        var totalTransacciones = 0;
        response.forEach(listarDatos);

    function listarDatos(item, index) {
      var objBotones = '<div class="btn-group btn-groupTransacciones align-center">';

          if (item.tipoTransaccion === "Ingreso") {
            totalIngreso += parseFloat(item.montoTransaccion);
            totalTransacciones += parseFloat(item.montoTransaccion);
            // objBotones += '<button id="btnEditar" type="button" class="btn-transac" idTransaccion="' + item.idTransaccion + '" idCapital="' + item.idCapital + '" idFormaPago="' + item.idFormaPago + '" tipoTransaccion="' + item.tipoTransaccion + '" horaTransaccion="' + item.horaTransaccion + '" descripcionTransaccion="' + item.descripcionTransaccion + '" montoTransaccion="' + item.montoTransaccion + '" data-bs-toggle="modal" data-bs-target="#ventanaEditarIngresoCapital"><img src="src/Vista/img/editarTransaccion2.png" alt="" style="width:25px;" class="ms-2 p-1"></button>';
            objBotones += '<button id="btnEliminar" tipoTransaccion="' + item.tipoTransaccion + '" idTransaccion="' + item.idTransaccion + '" idCapital="' + item.idCapital + '" type="button" class="btn-transac"><img src="src/Vista/img/eliminarTransaccion2.png" alt="" style="width:30px;" class="p-2"></button>';
            item.tipoTransaccion = '<img src="src/Vista/img/ingresoBoton.png" alt="Ingreso" style="width:15px;">';
            
          } else if (item.tipoTransaccion === "Ahorro") {
            totalAhorro += parseFloat(item.montoTransaccion);
            totalTransacciones -= parseFloat(item.montoTransaccion);
           // objBotones += '<button id="btnEditar" type="button" class="btn-transac" idTransaccion="' + item.idTransaccion + '" idCapital="' + item.idCapital + '" idFormaPago="' + item.idFormaPago + '" tipoTransaccion="' + item.tipoTransaccion + '" horaTransaccion="' + item.horaTransaccion + '" descripcionTransaccion="' + item.descripcionTransaccion + '" montoTransaccion="' + item.montoTransaccion + '" data-bs-toggle="modal" data-bs-target="#ventanaEditarAhorroCapital"><img src="src/Vista/img/editarTransaccion2.png" alt="" style="width:25px;" class="ms-2 p-1"></button>';
            objBotones += '<button id="btnEliminar" tipoTransaccion="' + item.tipoTransaccion + '" idTransaccion="' + item.idTransaccion + '" idCapital="' + item.idCapital + '" type="button" class="btn-transac"><img src="src/Vista/img/eliminarTransaccion2.png" alt="" style="width:30px;" class="p-2"></button>';
            item.tipoTransaccion = '<img src="src/Vista/img/ahorroBoton.png" alt="Ingreso" style="width:19px;">';
          } else {
            totalGasto += parseFloat(item.montoTransaccion);
            totalTransacciones -= parseFloat(item.montoTransaccion);
            objBotones += '<button id="btnEliminar" tipoTransaccion="' + item.tipoTransaccion + '" idTransaccion="' + item.idTransaccion + '" idCapital="' + item.idCapital + '" type="button" class="btn-transac"><img src="src/Vista/img/eliminarTransaccion2.png" alt="" style="width:30px;" class="p-2"></button>';
            item.tipoTransaccion = '<img src="src/Vista/img/gastoBoton.png" alt="Ingreso" style="width:19px;">';
          }
          objBotones += '</div>';

      let date = new Date(`1970-01-01T${item.horaTransaccion}Z`);
      date.setHours(date.getHours() + 5);
      let strTime = date.toLocaleTimeString('es-CO', { hour: '2-digit', minute: '2-digit', hour12: true });
      item.horaTransaccion = strTime;

      dataSetTransaccionesCapital.push(['<div class="tr-tablaTransaccionesTipo py-2">' + item.tipoTransaccion + '</div>', '<div class="tr-tablaTransaccionesHora py-2 text-center"><b>' + item.horaTransaccion + '</b></div>', '<div class="tr-tablaTransaccionesDescripcion py-2"><b>' + item.descripcionTransaccion + '</b></div>', '<div class="tr-tablaTransaccionesMonto py-2"><b>' + parseFloat(item.montoTransaccion).toLocaleString('es-CO', { style: 'currency', currency: 'COP', minimumFractionDigits: 0 }) + '</b></div>', '<div class="tr-tablaTransaccionesAcciones">' + objBotones + '</div>']);
    }

    tablaTransacciones = $("#tablaTransaccionesCapital").DataTable({
      scrollY: 400,
      // buttons:[{
      //   extend: 'colvis',
      //   text: 'Columnas Visibles'
      // },'excel',{
      //   extend: 'print',text:'Imprimir'
      // }],
      // dom: 'Bfrtip',
      "language": {
        "emptyTable": '<div class="emptyTableHoy"><b>No se han hecho transacciones<br>en el día de hoy</b></div>',
      },
      ordering: false,
      paging: false,
      info: false,
      searching: false,
      destroy: true,
      data: dataSetTransaccionesCapital
    });
    
    let objDataCapital = { "listarCapital": "ok" };
    let objRespuesta = new CapitalUsuario(objDataCapital);
    objRespuesta.listarCapital();
    
    var objData = { listarPresupuesto: "ok" };
    var instance = new presupuestos(objData);
    instance.listarPresupuestos();

        let totalCaja = parseFloat($("#totalCapital").html()) + parseFloat($("#totalPresupuesto").html());
        var formattedTotalCaja = totalCaja.toLocaleString('es-CO', { style: 'currency', currency: 'COP', minimumFractionDigits: 0 });
        $(".actualCaja").html(formattedTotalCaja);
        $(".actualCajaForm").html(formattedTotalCaja);
        

        var formattedTotalIngreso = totalIngreso.toLocaleString('es-CO', { style: 'currency', currency: 'COP', minimumFractionDigits: 0 });
        var formattedTotalAhorro = totalAhorro.toLocaleString('es-CO', { style: 'currency', currency: 'COP', minimumFractionDigits: 0 });
        var formattedTotalGasto = totalGasto.toLocaleString('es-CO', { style: 'currency', currency: 'COP', minimumFractionDigits: 0 });
        $("#ingresoCaja").html('+'+formattedTotalIngreso);
        $("#ahorroCaja").html('-'+formattedTotalAhorro);
        $("#gastoCaja").html('-'+formattedTotalGasto);

        if (totalIngreso == 0 && totalAhorro == 0 && totalGasto == 0) {
          $("#inicioCaja").hide();
        } else {
          $("#inicioCaja").show();
        }
        if (totalIngreso == 0) {
          $("#ingresoCaja").hide();
        } else {
          $("#ingresoCaja").show();
        }
        if (totalAhorro == 0) {
          $("#ahorroCaja").hide();
        } else {
          $("#ahorroCaja").show();
        }
        if (totalGasto == 0) {
          $("#gastoCaja").hide();
        } else {
          $("#gastoCaja").show();
        }
        
        inicioCaja = totalCaja - totalTransacciones;
        var formattedInicioCaja = inicioCaja.toLocaleString('es-CO', { style: 'currency', currency: 'COP', minimumFractionDigits: 0 });
        $("#inicioCaja").html(formattedInicioCaja);
        
        objRespuesta.listarCapital();
        instance.listarPresupuestos();
        objRespuestaGrafico.traerValoresGrafico();

      };
      

  // Botón para editar Transacción

  // $("#tablaTransaccionesCapital").on("click", "#btnEditar", function () {
  //   var idtransaccion = $(this).attr('idTransaccion');
  //   var descripcionTransaccion = $(this).attr('idCapital');
  //   var montoTransaccion = $(this).attr('montoTransaccion');
  //   var formaPago = $(this).attr('idFormaPago');

  //   if ($(this).attr('tipoTransaccion') === "Ingreso") {
  //     // alert("Ingreso");
  //     $("#btnEditarIngresoCapital").attr("idingreso", idtransaccion);
  //     $("#txt-editmontoIngreso").val(montoTransaccion);
  //     $("#txt-editcapitalIngreso").val(descripcionTransaccion);
  //     $("#txt-editformaPagoIngreso").val(formaPago);
  //     alert(idtransaccion);
  //   }
  // });


  // Botón para eliminar Transacción

  $("#tablaTransaccionesCapital").on("click", "#btnEliminar", function () {
    var idtransaccion = $(this).attr('idTransaccion');
    alert($(this).attr('tipoTransaccion'));
    // alert($(this).attr('idCapital'));

    Swal.fire({
      title: '¿Estás seguro de eliminar esta transacción?',
      text: "Esta acción no se puede deshacer.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        var objData = new FormData();

        if ($(this).attr('tipoTransaccion') === "Ingreso") {
          objData.append("idingreso", idtransaccion);
        } else if ($(this).attr('tipoTransaccion') === "Ahorro") {
          objData.append("idahorro", idtransaccion);
        } else {
          objData.append("idgasto", idtransaccion);
        }

        fetch('src/controladores/interfazUsoDiarioControl.php', {
          method: 'POST',
          body: objData
        }).then(response => response.json()).catch(error => {
          console.log('error: ', error);
        }).then(response => {
          if (response["codigo"] === "200") {
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: response["respuesta"],
              showConfirmButton: false,
              timer: 2500
            });
            
            listarTransaccionesCapital();

          } else {
            Swal.fire({
              position: 'center',
              icon: 'error',
              title: 'Hubo un problema al eliminar la transacción',
              showConfirmButton: false,
              timer: 2500
            });
          }
        });
      }
    });
  });


});