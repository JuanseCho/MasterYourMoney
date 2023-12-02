$(function () {

    var tabla = null;
    var dataSet = null;
    listarFormasPago();

    const forms = document.querySelectorAll("#formAgregarFormaPago");
    Array.from(forms).forEach((form) => {
        form.addEventListener("submit", (event) => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add("was-validated");
            } else {
                event.preventDefault();
                let nombreFormaPago = $("#txt-nombreFormaPago").val();
                let objData = new FormData();
                objData.append("regNombreFormaPago", nombreFormaPago);

                fetch("src/controladores/misFormasDePagoControl.php", {
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
                            $("#btn_Cerrar_Modal_Capital").click();

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
                        $("#ventanaAgregarFormaPago").modal('toggle');
                        listarFormasPago();
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        });
    });

    function listarFormasPago() {
      var objData = new FormData();
      objData.append("listaFormasPago", "ok");

      fetch("src/controladores/misFormasDePagoControl.php", {
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
      var formasPago ='';
      formasPago += '<option selected disabled>Seleccione la forma de pago del Ingreso</option>';

      response.forEach(listarDatos);

      function listarDatos(item, index) {

        var objBotones = `
        <div class="button-container">
            <!-boton para editar-->
            <button class="button" id="btnEditar" dformaPago="${item.idFormaPago }" nombreFormaPago="${item.NombreFormaPago}" data-bs-toggle="modal" data-bs-target="#ventanaEditarFormaPago">
                <i class="bi bi-pencil-square"></i>
            </button>

            <!-boton para eliminar-->
            
            <button class="button "  id="btnEliminar" idformaPago="${item.idFormaPago}">
                <i class="bi bi-trash"></i>
            </button>

        </div>`;

        dataSet.push([item.NombreFormaPago,objBotones]);
        formasPago += '<option value="'+item.idFormaPago+'">'+item.NombreFormaPago+'</option>';
      }

      if (tabla != null) {
      $("#tablaFormasPago").dataTable().fnDestroy();
      }
      tabla = $("#tablaFormasPago").DataTable({
        data: dataSet,
        search: {
            return: true
        },
        paging: false,
        scrollY: 300,
        responsive: true,
        bDestroy: true
      });

      $("#txt-formaPagoIngreso").html(formasPago);
      $("#txt_formaPagoIngreso").html(formasPago);

      $("#txt-editformaPagoIngreso").html(formasPago);
      $("#txt_formaD_Pago").html(formasPago);
      $("#slc-formaPago").html(formasPago);

    }

    var formEdicion = document.querySelectorAll('#formEditarFormaPago');

    Array.prototype.slice.call(formEdicion)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
            form.classList.add('was-validated')
          } else {
            event.preventDefault();

            var idformaPago = $("#btnEditarFormaPago").attr("idformaPago");
            var nombreFormaPago = $("#txt-editnombreFormaPago").val();

            var objData = new FormData();
            objData.append("editIdFormaPago", idformaPago);
            objData.append("regNombreFormaPago", nombreFormaPago);

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
            $("#ventanaEditarFormaPago").modal('toggle');
            listarFormasPago();
            });

          }
        }, false)
      })


    $("#tablaFormasPago").on("click", "#btnEditar", function () {
      var idformaPago = $(this).attr('idformaPago');
      var nombreFormaPago = $(this).attr('nombreFormaPago');

      $("#txt-editnombreFormaPago").val(nombreFormaPago);
      $("#btnEditarFormaPago").attr("idformaPago",idformaPago);
    });

   
    $("#tablaFormasPago").on("click", "#btnEliminar", function () {
      var idformaPago = $(this).attr('idformaPago');
  
      Swal.fire({
          title: '¿Estás seguro de eliminar esta Forma de pago?',
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
              objData.append("idformaPago", idformaPago);
  
              fetch('src/controladores/misFormasDePagoControl.php', {
                  method: 'POST',
                  body: objData
              }).then(response => response.json()).catch(error => {
                  console.log('error: ', error);
              }).then(response => {
                  listarFormasPago();
  
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
                        title: 'Hubo un problema al eliminar la forma de pago',
                        showConfirmButton: false,
                        timer: 2500
                    });
                  }
              });
            }
      });
    });



  })