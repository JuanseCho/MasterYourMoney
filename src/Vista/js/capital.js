$(document).ready(function () {

    tablaCapital = null;
    listarCapital();

    var objData = {listarValoresAmenu: "ok"};
    var instance = new cartasMenuUsuario(objData);
    instance.listarValoresAmenu();
      

    //funcion para agregar Capital
    const forms = document.querySelectorAll("#form_Agregar_Capital");
    Array.from(forms).forEach((form) => {
        form.addEventListener("submit", (event) => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add("was-validated");
            } else {
                event.preventDefault();

                const fecha = new Date();
                const año = fecha.getFullYear();
                const mes = fecha.getMonth() + 1; // Sumamos 1 para obtener un valor de mes entre 1 y 12
                const dia = fecha.getDate();
                const fechaFormateada = `${año}-${mes.toString().padStart(2, '0')}-${dia.toString().padStart(2, '0')}`;

                let monto = $("#txt_monto").val();
                let descripcion = $("#txt_descripcion").val();
                let formaDePago = $("#txt_formaD_Pago").val();

                let objData = new FormData();
                objData.append("fecha", fechaFormateada);
                objData.append("monto", monto);
                objData.append("descripcion", descripcion);
                objData.append("formaDePago", formaDePago);

                fetch("src/controladores/ctr_capital.php", {
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
                                timer: 10000,
                                customClass: {
                                    title: 'swal'
                                }
                            });
                            // cerrar modal de agregar Capital
                            $("#modalFormulaioAgregarCapital").modal("hide");

                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: response["mensaje"],
                                showConfirmButton: false,
                                timer: 100000
                            });
                        }
                        $("#txt_monto").val("");
                        $("#txt_descripcion").val("");
                        $("#txt_formaD_Pago").val("");
                        let objDataCapital = { "listarCapital": "ok" };

                        listarCapital();

                        // instance.listarValoresAmenu();
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        });
    });

    //funcion para listar Capital
    function listarCapital() {
        var objData = new FormData();
        objData.append("listarCapital", "ok");
        fetch("src/controladores/ctr_capital.php", {
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
                cargarDatos(response);
            })
            .catch((error) => {
                console.log(error);
            });
    }
    // function para cargar datos en la tabla
    function cargarDatos(response) {
        var dataSet = [];
        var selectedOptions = [];
        response.forEach(listarDatosC);
        function listarDatosC(item, index) {

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////
            var objBotones = `
            <div class="button-container">
                <!-boton para editar-->
                <button class="button" id="Btn_Capital_Editar" idCapital="${item.idCapital}" monto="${item.Montoactual}" descripcion="${item.descipcion}" formaPago="${item.formapago_idFormaPago}" data-bs-toggle="modal" data-bs-target="#modalFormulaioEditarCapital">
                    <i class="bi bi-pencil-square"></i>
                </button>
    
                <!-boton para eliminar-->
                
                <button class="button" id="btn_Eliminar_Capital" idCapital="${item.idCapital}">
                    <i class="bi bi-trash"></i>
                </button>
    
            </div>`;

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////
            dataSet.push([item.fecha, item.Montoactual, item.descipcion, item.NombreFormaPago, objBotones]);
            selectedOptions += `<option value="${item.idCapital}">${item.descipcion}</option>`;
        }
        if (tablaCapital != null) {
            $("#tabla_Capital").dataTable().fnDestroy();
        }
        tablaCapital = $("#tabla_Capital").DataTable({
            data: dataSet,
            search: {
                return: true
            },
            paging: false,
            scrollY: 300,
            responsive: true,
            destroy: true
        });

        //sumar los datos de MontoActual
        var total = 0;
        tablaCapital.column(1).data().each(function (value, index) {
            total += parseFloat(value);
        });
        var formattedTotal = total.toLocaleString('es-MX', { style: 'currency', currency: 'MXN' });
        //mostrar en el div de id montoTotal
        $("#montoTotal").html(formattedTotal);
        $(".actualCajaForm").html(formattedTotal);
        $("#capitalActual").html(formattedTotal);
        $("#select_tipoCapital").html(selectedOptions);
        $("#txt-capitalIngreso").html(selectedOptions);
        $("#txt-editcapitalIngreso").html(selectedOptions);
        $("#txt-capitalAhorro").html(selectedOptions);
        $("#txt-capitalGasto").html(selectedOptions);

    }


    //funcion para eliminar Capital

    $("#tabla_Capital").on("click", "#btn_Eliminar_Capital", function () {
        var id = $(this).attr("idCapital");
        var objData = new FormData();
        objData.append("idCapitalEliminar", id);
        Swal.fire({
            title: '¿Estas seguro de eliminar este Capital?',
            text: "¡No podras revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2F8BE6',
            cancelButtonColor: '#E2882B',
            confirmButtonText: 'Si, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("src/controladores/ctr_capital.php", {
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
                                title: "tienes  gastos o ahorros de este capital no puedes eliminarlo",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }


                        listarCapital();
                        instance.listarValoresAmenu();
                    });
            }


        })

    });

    //funcion para editar Capital
    $("#tabla_Capital").on("click", "#Btn_Capital_Editar", function () {
        var id = $(this).attr("idCapital");
        var monto = $(this).attr("monto");
        var descripcion = $(this).attr("descripcion");
        var formaPago = $(this).attr("formaPago");

        $("#txt_idCapital").val(id);
        $("#BTN_editarCapital").attr("idcapital", id);

        $("#txt_montoEditar").val(monto);
        $("#txt_descripcionEditar").val(descripcion);
        $("#txt_formaD_PagoEditar").val(formaPago);
    });

    const formsEditar = document.querySelectorAll("#form_Editar_Capital");
    Array.from(formsEditar).forEach((form) => {
        form.addEventListener("submit", (event) => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add("was-validated");
            } else {
                event.preventDefault();

                let idCapital = $("#BTN_editarCapital").attr("idcapital");
                let monto = $("#txt_montoEditar").val();
                let descripcion = $("#txt_descripcionEditar").val();
                let formaDePago = $("#txt_formaD_PagoEditar").val();

                let objData = new FormData();
                objData.append("idCapitalEditar", idCapital);
                objData.append("MontoInicialEditar", monto);
                objData.append("descipcionEditar", descripcion);
                objData.append("idFormaPagoEditar", formaDePago);

                fetch("src/controladores/ctr_capital.php", {
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
                            $("#modalFormulaioEditarCapital").modal("hide");
                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: response["mensaje"],
                                showConfirmButton: false,
                                timer: 1000
                            });
                        }
                        let objDataCapital = { "listarCapital": "ok" };
                        let objRespuesta = new CapitalUsuario(objDataCapital);
                        objRespuesta.listarCapital();


                        instance.listarValoresAmenu();

                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        });
    });



});