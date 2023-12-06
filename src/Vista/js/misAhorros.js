$(function () {

  let months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
  let dayNames = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
  let date = new Date();
  let day = date.getDate();
  let dayNumber = date.getDay();
  let dayName = dayNames[dayNumber];
  let monthName = months[date.getMonth()];
  const mes = date.getMonth() + 1; // Sumamos 1 para obtener un valor de mes entre 1 y 12
  let year = date.getFullYear();
  // let horaActual = date.getHours();
  // let minutosActuales = date.getMinutes();
  // let segundosActuales = date.getSeconds();

  const fechaFormateada = `${year}-${mes.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
  // let horaFormateada = `${horaActual}:${minutosActuales.toString().padStart(2, '0')}:${segundosActuales.toString().padStart(2, '0')}`; 

    var tabla = null;
    // var dataSet = null;
    listarAhorros();

    const forms = document.querySelectorAll("#formAgregarAhorro");
    Array.from(forms).forEach((form) => {
        form.addEventListener("submit", (event) => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add("was-validated");
            } else {
                event.preventDefault();

                let descripcionAhorro = $("#txt-descripcionAhorro").val();
                let montoInicialAhorro = $("#txt-montoInicialAhorro").val();
                let montoMetaAhorro = $("#txt-montoMetaAhorro").val();
                alert(descripcionAhorro);

                let objData = new FormData();
                objData.append("regFechaAhorro", fechaFormateada);
                objData.append("regDescripcionAhorro", descripcionAhorro);
                objData.append("regMontoInicialAhorro", montoInicialAhorro);
                objData.append("regMontoMetaAhorro", montoMetaAhorro);

                fetch("src/controladores/misAhorrosControl.php", {
                    method: "POST",
                    body: objData,
                })
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then((response) => {
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
                            // cerrar modal
                            // $("#btn_Cerrar_Modal_Capital").click();

                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: response["mensaje"],
                                showConfirmButton: false,
                                timer: 1000
                            });
                        }
                        $("#ventanaAgregarAhorro").modal('toggle');
                        form.reset();
                        listarAhorros();
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        });
    });

    function listarAhorros() {
      var objData = new FormData();
      objData.append("listaAhorros", "ok");

      fetch("src/controladores/misAhorrosControl.php", {
        method: 'POST',
        body: objData
      }).then(response => response.json()).catch(error => {
        console.log(error);
      }).then(response => {
        cargarDatos(response);
      });
    }

    function cargarDatos(response) {
      var dataSet = [];
      var ahorros =[];
      ahorros += '<option selected disabled>Seleccione la ahorro del Ingreso</option>';

      response.forEach(listarDatos);

      function listarDatos(item, index) {

        var objBotones = `
        <div class="button-container">
            <!-boton para editar-->
            <button class="button" id="btnEditar" type="button" class="btn btn-warning" idahorro=" ${item.idAhorro}  " descripcionAhorro="${item.descripcion_ahorro}" montoInicialAhorro=" ${item.montoInicial_ahorro}" montoActualAhorro=" ${item.montoActual_ahorro}" montoMetaAhorro="${item.montoMeta_ahorro}" data-bs-toggle="modal" data-bs-target="#ventanaEditarAhorro">
                <i class="bi bi-pencil-square"></i>
            </button>

            <!-boton para eliminar-->
            
            <button class="button" id="btnEliminar" type="button" class="btn btn-danger" idahorro=" ${item.idAhorro}">
                <i class="bi bi-trash"></i>
            </button>

        </div>`;

        dataSet.push([item.fecha_ahorro, item.descripcion_ahorro, item.montoInicial_ahorro, item.montoActual_ahorro, item.montoMeta_ahorro, objBotones]);
        ahorros += '<option value="'+item.idAhorro+'">'+item.descripcion_ahorro+'</option>';
      }

      if (tabla != null) {
      $("#tablaAhorros").dataTable().fnDestroy();
      }
      tabla = $("#tablaAhorros").DataTable({
        data: dataSet
      });

      $("#txt-ahorroRegAhorro").html(ahorros);
      // $("#txt-editahorroIngreso").html(ahorros);
    }



    var formEdicion = document.querySelectorAll('#formEditarAhorro');

    Array.prototype.slice.call(formEdicion)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
            form.classList.add('was-validated')
          } else {
            event.preventDefault();

            var idahorro = $("#btnEditarAhorro").attr("idahorro");
            var descripcionAhorro = $("#txt-editdescripcionAhorro").val();

            var objData = new FormData();
            objData.append("editIdAhorro", idahorro);
            objData.append("regDescripcionAhorro", descripcionAhorro);

            fetch('src/controladores/misFormasDePagoControl.php', {
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
            $("#ventanaEditarAhorro").modal('toggle');
            listarAhorros();
            });

          }
        }, false)
      })


    $("#tablaAhorros").on("click", "#btnEditar", function () {
      var idahorro = $(this).attr('idahorro');
      var descripcionAhorro = $(this).attr('descripcionAhorro');
      var montoInicialAhorro = $(this).attr('montoInicialAhorro');
      var montoMetaAhorro = $(this).attr('montoMetaAhorro');

      $("#btnEditarAhorro").attr("idahorro",idahorro);
      $("#txt-editdescripcionAhorro").val(descripcionAhorro);
      $("#txt-editmontoInicialAhorro").val(montoInicialAhorro);
      $("#txt-editmontoMetaAhorro").val(montoMetaAhorro);
    });

   
    $("#tablaAhorros").on("click", "#btnEliminar", function () {
      var idahorro = $(this).attr('idahorro');
  
      Swal.fire({
          title: '¿Estás seguro de eliminar esta Ahorro?',
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
              objData.append("idahorro", idahorro);
  
              fetch('src/controladores/misFormasDePagoControl.php', {
                  method: 'POST',
                  body: objData
              }).then(response => response.json()).catch(error => {
                  console.log('error: ', error);
              }).then(response => {
                  listarAhorros();
  
                  if (response["codigo"] === "200") {
                      Swal.fire({
                          position: 'center',
                          icon: 'success',
                          title: response["respuesta"],
                          showConfirmButton: false,
                          timer: 2500
                      });
                  } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Hubo un problema al eliminar la ahorro',
                        showConfirmButton: false,
                        timer: 2500
                    });
                  }
              });
            }
      });
    });



  })