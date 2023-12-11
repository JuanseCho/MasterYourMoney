$(document).ready(function () {
    
    let objDataCapital = { "listarCapital": "ok" };
    let objRespuesta = new CapitalUsuario(objDataCapital);
    objRespuesta.listarCapital();

    "use strict"
    var tablaCapitalesDePresupuesto = null;
    $("#Tabla_De_Presupuestos").on("click", "#btn_Agregar_Al_Presupuesto", function () {

        objRespuesta.listarCapital();
        $("#ventana_del_formulario_Capital_Has_Presupuesto").show();
        var idPresupuesto = $(this).attr("idPresupuesto");
        var nombrePresupuesto = $(this).attr("nombrePresupuesto");
        var valorActual = $(this).attr("limitePresupuesto");
        $("#Btn_new_Capital_presupuesto").attr("idPresupuestoF", idPresupuesto);
        $("#txt_presupuesto").html(nombrePresupuesto + " tiene asignado: $" + valorActual);


    })


    // agregar capital al presupuesto a la tabla de capital_has_presupuesto

    const formsCapitalHasPresupuesto = document.querySelectorAll("#form_Agregar_Capital_Has_Presupuesto");

    formsCapitalHasPresupuesto.forEach(form => {
        form.querySelector("#Btn_new_Capital_presupuesto").addEventListener("click", function (event) {

            event.preventDefault();
            if (form.checkValidity()) {
                event.stopPropagation();
                form.classList.add("was-validated");

                const fecha = new Date();
                const año = fecha.getFullYear();
                const mes = fecha.getMonth() + 1; // Sumamos 1 para obtener un valor de mes entre 1 y 12
                const dia = fecha.getDate();
                const fechaFormateada = `${año}-${mes.toString().padStart(2, '0')}-${dia.toString().padStart(2, '0')}`;

                let idPresupuesto = $("#Btn_new_Capital_presupuesto").attr("idPresupuestoF");
                let idCapital = $("#select_tipoCapital").val();
                let valorAsignado = $("#txt_valorAsignado").val();

                let data = new FormData();
                data.append("fecha", fechaFormateada);
                data.append("idPresupuesto", idPresupuesto);
                data.append("idCapital", idCapital);
                data.append("valorAsignado", valorAsignado);

                fetch("src/controladores/ctr_capital_has_presupuesto.php", {
                    method: "POST",
                    body: data
                }).then(response => {
                    if (!response.ok) {
                        throw new Error("Error en la solicitud");
                    }
                    return response.json();
                }).then(response => {

                    if (response["codigo"] == "409") {
                        Swal.fire({
                            title: "este capital ya esta vinculado con el presupuesto . Puedes editarla si lo deseas.",
                            text: response.error,
                            icon: "info",
                            confirmButtonText: "Entendido"
                        });


                    } else if (response["codigo"] == "200") {
                        Swal.fire({
                            title: "Capital agregado al presupuesto",
                            icon: "success",
                            animation: false,
                            confirmButtonText: "Entendido",
                            onClose: function () {
                                location.reload();
                            },
                            allowOutsideClick: false,
                            backdrop: false,
                            showClass:
                            {
                                popup: 'swal2-show',
                                backdrop: 'swal2-backdrop-show',
                                icon: 'swal2-icon-show'
                            }
                        });

                    //hacer clic en un boton internamente para que se actualicen los presupuestos
                    $("#btnPresupuestos").click();

                    } else if (response["codigo"] == "401") {
                        Swal.fire({
                            title: "No tienes suficiente dinero en el capital para el presupuesto planeado.",
                            icon: "info",
                            confirmButtonText: "Entendido",
                            onClose: function () {
                                location.reload();
                            }
                        });


                    } else {
                        Swal.fire({
                            title: "Error al agregar el capital",
                            text: response.error,
                            icon: "error",
                            confirmButtonText: "Entendido"
                        });
                    }
                    //vaciar los campos
                    $("#txt_valorAsignado").val("");
                    $("#select_tipoCapital").val("");

                    let objPresupuesto = { "listarPresupuestos": "ok" };
                    let objRespuestaPre = new presupuestos(objPresupuesto);
                    objRespuestaPre.listarPresupuestos();


                }).catch(error => {
                    console.error("Error en la solicitud:", error);

                });




            }

        })
    })

    $("#Tabla_De_Presupuestos").on("click", "#btn_Edit_Presupuesto", function (e) {
        var idPresupuesto = $(this).attr('idPresupuesto');
        listarCapitalesDePresupuesto(idPresupuesto);
    });

    function listarCapitalesDePresupuesto(idPresupuesto) {


        var objData = new FormData();
        objData.append("listarCapitalesDePresupuesto", "ok");
        objData.append("IdPresupuesto", idPresupuesto);



        fetch("src/controladores/ctrCapitalesDePresupuesto.php", {
            method: "POST",
            body: objData,
        })
            .then((response) => response.json())
            .catch((error) => {
                console.log(error);
            })
            .then((response) => {
                console.log(response);
                cargarDatosCapitaDePresupuesto(response);

            });
    }

    function cargarDatosCapitaDePresupuesto(response) {
        console.log(response);
        var dataSet = [];
        response.forEach(listarDatosCDP);

        function listarDatosCDP(item, index) {
            var objBotones = `
            <div class="button-container">
              
    
                <!--boton para eliminar-->
                <button class="button" id="btn_Eliminar_CapitalDePresupuesto" idCapital="${item.idCapital}" valorDeducido="${item.valorDeducido}" idPresupuesto="${item.presupuestos_idPresupuesto}">
                    <i class="bi bi-trash"></i>
                </button>
            </div>`;
            dataSet.push([item.fecha, item.descipcion, item.valorDeducido, objBotones]);
        }

        if (tablaCapitalesDePresupuesto != null) {
            $("#tabla_capitalesDePresupuesto").dataTable().fnDestroy();
        }
        tablaCapitalesDePresupuesto = $("#tabla_capitalesDePresupuesto").DataTable({
            data: dataSet,

            search: {
                return: true
            },
            paging: false,
            scrollY: 300,
            responsive: {
                details: {
                    display: DataTable.Responsive.display.modal({
                     
                    }),
                    renderer: DataTable.Responsive.renderer.tableAll({
                        tableClass: 'table'
                    })
                }
            }
        });
    }

    //funcion Eliminar Capital de presupuesto
    $("#tabla_capitalesDePresupuesto").on("click", "#btn_Eliminar_CapitalDePresupuesto", function () {
        var idCapital = $(this).attr("idCapital");
        var idPresupuesto = $(this).attr("idPresupuesto");
        var valorDeducido = $(this).attr("valorDeducido");

        Swal.fire({
            title: "¿Estas seguro de eliminar este capital del presupuesto?",
            text: "Esta accion no se puede deshacer",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Eliminar",
            cancelButtonText: "Cancelar",
            confirmButton: {
                text: "Eliminar",
                id: "btnConfirmarEliminar",
            },
        }).then((result) => {
            if (result.isConfirmed) {
                var objData = new FormData();
                objData.append("idCapital", idCapital);
                objData.append("idPresupuesto", idPresupuesto);
                objData.append("valorDeducido", valorDeducido);
                objData.append("eliminarCapitalDePresupuesto", "ok");
                fetch("src/controladores/ctrCapitalesDePresupuesto.php", {
                    method: "POST",
                    body: objData,
                })
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }

                        // Verificar si la respuesta es un objeto JSON
                        const contentType = response.headers.get('Content-Type');
                        if (contentType && contentType.includes('application/json')) {
                            return response.json();
                        }

                        // Si la respuesta no es JSON, intenta obtener el texto de la respuesta
                        return response.text();
                    })
                    .then((responseData) => {
                        var response = JSON.parse(responseData);
                        if (response["codigo"] == 200) {
                            Swal.fire({
                                title: "Capital eliminado del presupuesto",
                                icon: "success",
                                confirmButtonText: "Entendido",
                                onClose: function () {
                                    location.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                title: "Error al eliminar el capital del presupuesto",
                                text: response.error,
                                icon: "error",
                                confirmButtonText: "Entendido",
                            });
                        }

                        listarCapitalesDePresupuesto(idPresupuesto);


                        let objPresupuesto = { "listarPresupuestos": "ok" };
                        let objRespuestaPre = new CapitalUsuario(objPresupuesto);
                        objRespuestaPre.listarPresupuestos();
                    })
                    .catch((error) => {
                        console.log(error);
                    });



            }
        });
    });



})



var objData = {listarValoresAmenu: "ok"};
var instance = new cartasMenuUsuario(objData);
instance.listarValoresAmenu();
