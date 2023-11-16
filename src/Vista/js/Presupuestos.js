$(document).ready(function () {

    "use strict";

    listarPresupuestos();




    // *******************************
    //   ¡CRUD PARA LOS PRESUPUESTOS!
    // *******************************


    var tablaPresupuesto = null;
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
                let tipo_Presupuesto = $("#select_tipoPresupuesto").val();
                let limitePresupuesto = $("#txt_Presupuesto").val();

                let objData = new FormData();
                objData.append("tipoPresupuesto", tipo_Presupuesto);
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
                                timer: 1000,
                                customClass: {
                                    title: 'swal'
                                }
                            });

                            $("#txt_Presupuesto").val("");

                            $("#select_tipoPresupuesto").empty();
                            listarTiposPresupuesto();

                            listarTiposPresupuesto();

                            $("#ventana_del_formulario_Presupuestos").hide();

                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: response["mensaje"],
                                showConfirmButton: false,
                                timer: 1000
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



    // Agrega un evento 'change' al <select>

    // function para listar presupuesto

    function listarPresupuestos() {
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

        var dataSet = [];
        console.log(response);

        var selectedOptionsEdit = [];
        var selectedOptions = "<option selected montoPresupuestoAsignado='0' nombrePresupuesto='' >seleccione el presupuesto </option>";

        response.forEach(listarDatosP);

        function listarDatosP(item, index) {
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////

            var objBotones = `
            <div class="button-container">
                <button class="button" id="btn_Agregar_Al_Presupuesto" idPresupuesto="${item.idPresupuesto}" idTipoPresupuesto="${item.idTipoPresupuesto}" nombreTipoPresupuesto="${item.NombreTipoPresupuesto}" limitePresupuesto="${item.ValorAsignado}">
                     <i class="bi bi-cash-coin"></i>
                </button>
                <!-boton para editar-->
                <button class="button" id="btn_Edit_Presupuesto" idPresupuesto="${item.idPresupuesto}" idTipoPresupuesto="${item.idTipoPresupuesto}" nombreTipoPresupuesto="${item.NombreTipoPresupuesto}" limitePresupuesto="${item.ValorAsignado}">
                    <i class="bi bi-pencil-square"></i>
                </button>

                <!-boton para eliminar-->
                
                <button class="button" id="btn_Eliminar_Presupuesto" idPresupuesto="${item.idPresupuesto}">
                    <i class="bi bi-trash"></i>
                </button>

            </div>`;

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////

            dataSet.push([item.NombreTipoPresupuesto, item.ValorAsignado, item.montoActual, objBotones]);


            selectedOptions += `<option value="${item.idPresupuesto}" montoactual="${montoactual}" montoPresupuestoAsignado="${item.ValorAsignado}" nombrePresupuesto="${item.NombreTipoPresupuesto}">   ${item.NombreTipoPresupuesto}</option>`;


        }
        $("#txt_montoactual").html(montoactual);



        // $("#select_Presupuesto").html(selectedOptions);
        if (tablaPresupuesto != null) {
            $("#Tabla_De_Presupuestos").dataTable().fnDestroy();
        }
        tablaPresupuesto = $("#Tabla_De_Presupuestos").DataTable({
            data: dataSet,
            paging: false,
            scrollY: 300,
            scrollX: true

        });

        $('button#btn_Edit_Presupuesto').click(function () {
            // Vacía el array
            var clickedButton = this; // Guarda una referencia al botón en el que se hizo clic

            $('button#btn_Edit_Presupuesto').each(function () {
                if (this !== clickedButton) { // Comprueba si este botón es diferente al botón en el que se hizo clic
                    var idTipoPresupuesto = $(this).attr('idtipoPresupuesto');
                    var nombreTipoPresupuesto = $(this).attr('nombreTipoPresupuesto');

                    // Agregamos el valor al array
                    selectedOptionsEdit.push(idTipoPresupuesto, nombreTipoPresupuesto);
                }
            });

        });



    }

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
                let idTipoPresupuesto = $("#select_edit_tipoPresupuesto").val();
                let limitePresupuesto = $("#txt_edit_Presupuesto").val();

                let objData = new FormData();
                objData.append("editIdPresupuesto", idPresupuesto);
                objData.append("editIdTipoPresupuesto", idTipoPresupuesto);
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
                        $("#txt_edit_Presupuesto").val("");
                        document.getElementById("ventana_del_formulario_Presupuesto_Edit").style.display = "none";
                        listarPresupuestos();
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        });
        document.getElementById("btn_Cancelar_edit_tipo_Presupuesto").addEventListener("click", function (event) {
            event.preventDefault(); // Evita el envío del formulario
            document.getElementById("ventana_del_formulario_Presupuesto_Edit").style.display = "none"; // Cierra la ventana
        });
    });

    /////////////////////////////////////////////////

    // function para eliminar presupuesto

    $("#Tabla_De_Presupuestos").on("click", "#btn_Eliminar_Presupuesto", function () {
        var id = $(this).attr("idPresupuesto");
        var objData = new FormData();
        objData.append("IdPresupuesto_Eliminar", id);

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
                listarPresupuestos();
            });
    }
    );

    ////////////////////////////////////////////////////
    //eventos para mostrar y ocultar ventanas de formularios
    $("#Btn_Presupuestos").on("click", function () {
        $("#ventana_del_formulario_Presupuestos").show();

    });
    $("#cerrar-ventana").on("click", function () {
        $("#ventana_del_formulario_Presupuestos").hide();
        $("#select_tipoPresupuesto").empty();
        listarTiposPresupuesto();


    });
    $("#Btn_Presupuestos").on("click", function () {
        $("#select_tipoPresupuesto").empty();

    });

    $("#btn_Cancelar_edit_tipo_Presupuesto").on("click", function () {
        $("#ventana_del_formulario_TG_Edit").hide();

    });
    document.getElementById("btn_Cancelar_edit_tipo_Presupuesto").addEventListener("click", function () {
        document.getElementById("ventana_del_formulario_TG_Edit").style.display = "none";
    });

    $(".cssbuttons-io-button").on("click", function () {
        $("#ventana_del_formulario_Presupuesto_Edit").hide();

    });
    $("#Tabla_De_Presupuestos").on("click", "#btn_Agregar_Al_Presupuesto", function () {
        $("#ventana_del_formulario_Capital_Has_Presupuesto").show();


    })

    $("#Tabla_De_Presupuestos").on("click", "#btn_Agregar_Al_Presupuesto", function () {
        var idPresupuesto = $(this).attr("idPresupuesto");
        var nombreTipoPresupuesto = $(this).attr("nombreTipoPresupuesto");
        var limitePresupuesto = $(this).attr("limitePresupuesto");

        $("#txt_presupuesto").attr("idPresupuesto", idPresupuesto);
        $("#txt_presupuesto").val(nombreTipoPresupuesto + limitePresupuesto);
    });


});