
$(document).ready(function () {

    "use strict";



    let objDataCapital = { "listarCapital": "ok" };
    let objRespuesta = new CapitalUsuario(objDataCapital);
    objRespuesta.listarCapital();

    let objPresupuesto = { "listarPresupuestos": "ok" };
    let objRespuestaPre = new presupuestos(objPresupuesto);
    objRespuestaPre.listarPresupuestos();
    ////////////////////////////////////////////////////

    document.getElementById("btn_Cancelar_edit_tipo_Presupuesto").addEventListener("click", function () {
        document.getElementById("ventana_del_formulario_TG_Edit").style.display = "none";

    });

    var tablaPresupuesto = null;

    // *******************************
    //   ¡CRUD PARA LOS PRESUPUESTOS!
    // *******************************



    // function para agregar presupuesto
    const formsPresupuesto = document.querySelectorAll("#form_Agregar_Presupuesto");

    Array.from(formsPresupuesto).forEach((form) => {
        form.addEventListener("submit", (event) => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add("was-validated");
            } else {
                event.preventDefault();
                let Presupuesto = $("#txt_NombrePresupuesto").val();
                let limitePresupuesto = $("#txt_Presupuesto").val();

                let objData = new FormData();
                objData.append("descripcionPresupuesto", Presupuesto);
                objData.append("limitePresupuesto", limitePresupuesto);

                fetch("src/controladores/ctr_presupuesto.php", {
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
                                title: response["mensaje"],
                                showConfirmButton: false,
                                timer: 1500,
                                customClass: {
                                    title: 'swal'
                                }
                            });

                            $("#txt_Presupuesto").val("");

                            $("#select_tipoPresupuesto").empty();
                            listarTiposPresupuesto();

                            listarTiposPresupuesto();

                            $("#ventana_del_formulario_Presupuestos").hide();

                        } else if (response["codigo"] == "300") {
                            Swal.fire({
                                position: 'center',
                                icon: 'info',
                                title: response["mensaje"],
                                showConfirmButton: false,
                                timer: 2500
                            });

                        }
                        else {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: response["mensaje"],
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }

                        listarPresupuestos();

                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        });
    });





    /*  function listarPresupuestos() {
          var objData = new FormData();
          objData.append("listarPresupuestos", "ok");
          fetch("src/controladores/ctr_presupuesto.php", {
              method: "POST",
              body: objData,
          })
              .then((response) => response.json())
              .catch((error) => {
                  console.log(error);
              })
              .then((response) => {
                  cargarDatosPresupuesto(response);
  
              });
      }
  
      // function para cargar datos en la tabla
      function cargarDatosPresupuesto(response) {
          console.log(response);
  
          var dataSet = [];
  
          var selectedOptionsEdit = [];
          var selectedOptions = "<option selected montoPresupuestoAsignado='0' nombrePresupuesto='' >seleccione el presupuesto </option>";
  
          response.forEach(listarDatosP);
  
          function listarDatosP(item, index) {
              /////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
              var objBotones = `
              <div class="button-container">
                  <button class="button" id="btn_Agregar_Al_Presupuesto" idPresupuesto="${item.idPresupuesto}" Presupuesto="${item.idPresupuesto}" nombrePresupuesto="${item.descripcionPresupuesto}" limitePresupuesto="${item.ValorAsignado}" data-bs-toggle="modal" data-bs-target="#ventana_del_formulario_Capital_Has_Presupuesto">
                       <i class="bi bi-cash-coin"></i>
                  </button>
                  <!-boton para editar-->
                  <button class="button" id="btn_Edit_Presupuesto" idPresupuesto="${item.idPresupuesto}" DescripcionPresupuesto="${item.descripcionPresupuesto}" nombreTipoPresupuesto="${item.NombreTipoPresupuesto}" limitePresupuesto="${item.ValorAsignado}" data-bs-toggle="modal" data-bs-target="#ventana_del_formulario_Presupuesto_Edit">
                      <i class="bi bi-pencil-square"></i>
                  </button>
  
                  <!-boton para eliminar-->
                  
                  <button class="button" id="btn_Eliminar_Presupuesto" idPresupuesto="${item.idPresupuesto}">
                      <i class="bi bi-trash"></i>
                  </button>
  
              </div>`;
  
              /////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
              dataSet.push([item.descripcionPresupuesto, item.ValorAsignado, item.montoActual, item.capitales, objBotones]);
  
  
              selectedOptions += `<option value="${item.idPresupuesto}" montoactual="${item.montoActual}" montoPresupuestoAsignado="${item.ValorAsignado}" nombrePresupuesto="${item.NombreTipoPresupuesto}">   ${item.NombreTipoPresupuesto}</option>`;
  
  
          }
  
  
  
  
          // $("#select_Presupuesto").html(selectedOptions);
          if (tablaPresupuesto != null) {
              $("#Tabla_De_Presupuestos").dataTable().fnDestroy();
          }
          tablaPresupuesto = $("#Tabla_De_Presupuestos").DataTable({
  
              data: dataSet,
              search: {
                  return: true
              },
              paging: false,
              scrollY: 300,
              responsive: true
          });
  
          $('button#btn_Edit_Presupuesto').click(function () {
              // Vacía el array
              var clickedButton = this; // Guarda una referencia al botón en el que se hizo clic
  
              $('button#btn_Edit_Presupuesto').each(function () {
                  if (this !== clickedButton) { // Comprueba si este botón es diferente al botón en el que se hizo clic
                      var DescripcionPresupuesto = $(this).attr('idtipoPresupuesto');
                      var nombreTipoPresupuesto = $(this).attr('nombreTipoPresupuesto');
  
                      // Agregamos el valor al array
                      selectedOptionsEdit.push(DescripcionPresupuesto, nombreTipoPresupuesto);
                  }
              });
  
          });
  
      }*/

    // function para editar presupuesto
    const formsEditPresupuesto = document.querySelectorAll("#form_Editar_Presupuesto");

    Array.from(formsEditPresupuesto).forEach((form) => {
        form.addEventListener("submit", (event) => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add("was-validated");
            } else {
                event.preventDefault();

                let idPresupuesto = $("#btn_Edit_Presupuesto_f").attr("idPresupuestoF");
                let DescripcionPresupuesto = $("#select_edit_tipoPresupuesto").val();
                let limitePresupuesto = $("#txt_edit_Presupuesto").val();

                let objData = new FormData();
                objData.append("editIdPresupuesto", idPresupuesto);
                objData.append("editIdTipoPresupuesto", DescripcionPresupuesto);
                objData.append("editLimitePresupuesto", limitePresupuesto);

                fetch("src/controladores/ctr_presupuesto.php", {
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
                                title: response["mensaje"],
                                showConfirmButton: false,
                                timer: 1500,
                                customClass: {
                                    title: 'swal'
                                }
                            });
                            listarPresupuestos();
                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: response["mensaje"],
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                        $("#txt_edit_Presupuesto").val("");

                        listarPresupuestos();
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        });
        document.getElementById("btn_Cancelar_edit_tipo_Presupuesto").addEventListener("click", function (event) {
            event.preventDefault(); // Evita el envío del formulario

        });
    });

    /////////////////////////////////////////////////

    // function para eliminar presupuesto

    $("#Tabla_De_Presupuestos").on("click", "#btn_Eliminar_Presupuesto", function () {
        var id = $(this).attr("idPresupuesto");
        Swal.fire({
            title: '¿Estas seguro de eliminar este presupuesto se eliminaran los gastos vinculados?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2F8BE6',
            cancelButtonColor: '#E2882B',
            confirmButtonText: 'Si, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Ingresa tu contraseña',
                    input: 'password',
                    inputPlaceholder: 'Contraseña',
                    inputAttributes: {
                        maxlength: 10,
                        autocapitalize: 'off',
                        autocorrect: 'off'
                    }
                }).then((result) => {
                    if (result.value) {
                        let objData = new FormData();
                        objData.append("IdPresupuesto_Eliminar", id);
                        objData.append("contrasena", result.value);

                        fetch("src/controladores/ctr_presupuesto.php", {
                            method: "POST",
                            body: objData,
                        })
                            .then((response) => response.json())
                            .catch((error) => {
                                console.log(error);
                            })
                            .then((response) => {
                                if (response["codigo"] == "200") {
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'success',
                                        title: response["mensaje"],
                                        showConfirmButton: false,
                                        timer: 1500,
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
                                        timer: 1500
                                    });
                                }
                                listarPresupuestos();
                            });
                    }
                });
            }
        })
    });

    ////////////////////////////////////////////////////
    //eventos para mostrar y ocultar ventanas de formularios
    $("#Btn_Presupuestos").on("click touchstart", function () {
        $("#ventana_del_formulario_Presupuestos").show();

    });
    $("#cerrar-ventana").on("click touchstart", function () {
        $("#ventana_del_formulario_Presupuestos").hide();
        listarTiposPresupuesto();


    });

    $("#Tabla_De_Presupuestos").on("click touchstart", "#btn_Agregar_Al_Presupuesto", function () {

        let objDataCapital = { "listarCapital": "ok" };
        let objRespuesta = new CapitalUsuario(objDataCapital);
        objRespuesta.listarCapital();

        $("#ventana_del_formulario_Capital_Has_Presupuesto").show();
        var idPresupuesto = $(this).attr("idPresupuesto");
        $("#Btn_new_Capital_presupuesto").attr("idPresupuestoF", idPresupuesto);


    })
    $("#Btn_new_Capital_presupuesto").on("click touchstart", function () {

        let objPresupuesto = { "listarPresupuestos": "ok" };
        let objRespuestaPre = new CapitalUsuario(objPresupuesto);
        objRespuestaPre.listarPresupuestos();
    });

})

class presupuestos {
    constructor(objData) {
        this._objPresupuesto = objData;
        this.tablaPresupuesto = null;
    }

    listarPresupuestos() {
        var objData = new FormData();
        objData.append("listarPresupuestos", this._objPresupuesto.listarPresupuesto);

        fetch("src/controladores/ctr_presupuesto.php", {
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
                console.log(response);
                var dataSet = [];
                var selectedOptions = [];

                response.forEach(listarDatosP);

                function listarDatosP(item, index) {
                    var objBotones = `
                        <div class="button-container">
                            <button class="button" id="btn_Agregar_Al_Presupuesto" idPresupuesto="${item.idPresupuesto}" Presupuesto="${item.idPresupuesto}" nombrePresupuesto="${item.descripcionPresupuesto}" limitePresupuesto="${item.ValorAsignado}" data-bs-toggle="modal" data-bs-target="#ventana_del_formulario_Capital_Has_Presupuesto">
                                <i class="bi bi-cash-coin"></i>
                            </button>
                            <button class="button" id="btn_Edit_Presupuesto" idPresupuesto="${item.idPresupuesto}" DescripcionPresupuesto="${item.descripcionPresupuesto}" nombreTipoPresupuesto="${item.NombreTipoPresupuesto}" limitePresupuesto="${item.ValorAsignado}" data-bs-toggle="modal" data-bs-target="#ventana_del_formulario_Presupuesto_Edit">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="button" id="btn_Eliminar_Presupuesto" idPresupuesto="${item.idPresupuesto}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>`;

                    dataSet.push([item.descripcionPresupuesto, item.ValorAsignado, item.montoActual, item.capitales, objBotones]);
                    selectedOptions += `<option value="${item.idPresupuesto}" montoactual="${item.montoActual}" montoPresupuestoAsignado="${item.ValorAsignado}" >${item.descripcionPresupuesto}</option>`;
                }

                // Usar this.tablaPresupuesto en lugar de tablaPresupuesto
                if (this.tablaPresupuesto != null) {
                    // Usar this en lugar de tablaPresupuesto
                    this.tablaPresupuesto.destroy();
                }

                // Usar this.tablaPresupuesto en lugar de tablaPresupuesto
                this.tablaPresupuesto = $("#Tabla_De_Presupuestos").DataTable({
                    data: dataSet,
                    search: {
                        return: true
                    },
                    paging: false,
                    scrollY: 300,
                    responsive: true
                });

                $("#txt-presupuesto").html(selectedOptions);
            })
            .catch((error) => {
                console.log(error);
            });
    }
}

