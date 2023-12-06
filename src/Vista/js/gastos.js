
$(Document).ready(function () {

    tablaGastos = null;
    listarGastos();
    const formularioGastos = document.querySelectorAll("#formAgregarGasto");

    Array.from(formularioGastos).forEach((form) => {
        form.addEventListener("submit", (evento) => {
            if (!form.checkValidity()) {
                evento.preventDefault();
                evento.stopPropagation();
                form.classList.add("was-validated");
            } else {
                evento.preventDefault();

                const fecha = new Date();
                const año = fecha.getFullYear();
                const mes = fecha.getMonth() + 1;
                const dia = fecha.getDate();
                const fechaFormateada = `${año}-${mes.toString().padStart(2, '0')}-${dia.toString().padStart(2, '0')}`;

                const hora = fecha.getHours();
                const minutos = fecha.getMinutes();
                const segundos = fecha.getSeconds();
                const horaFormateada = `${hora.toString().padStart(2, '0')}:${minutos.toString().padStart(2, '0')}:${segundos.toString().padStart(2, '0')}`;

                const monto = $("#txt-montoGasto").val();
                const descripcion = $("#txt-descripcionGasto").val();
                const presupuesto = $("#slc-presupuesto").val();
                const formaPago = $("#slc-formaPago").val();

                var objData = new FormData();
                objData.append("montoGasto", monto);
                objData.append("descripcionGasto", descripcion);
                objData.append("fechaGasto", fechaFormateada);
                objData.append("horaGasto", horaFormateada);
                objData.append("IdPresupuesto", presupuesto);
                objData.append("formaPagoGasto", formaPago);

                fetch("src/controladores/ctr_gastos.php", {
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

                            listarGastos();
                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: response["mensaje"],
                                showConfirmButton: false,
                                timer: 1000
                            });
                        }
                        $("#txt-montoGasto").val("");
                        $("#txt-descripcionGasto").val("");
                        $("#slc-presupuesto").val("");
                        $("#slc-formaPago").val("");
                        listarGastos();
                        // vaciar los campos

                        // cerrar modal
                        $("#modalFormularioAgregarGasto").modal("hide");
                        instance.listarValoresAmenu();

                    })
                    .catch((error) => {
                        console.error("Error:", error);
                    });

            }

        });

    });


    // listar gastos en la tabla

    function listarGastos() {
        const fecha = new Date();
        const año = fecha.getFullYear();
        const mes = fecha.getMonth() + 1;
        const dia = fecha.getDate();
        const fechaFormateada = `${año}-${mes.toString().padStart(2, '0')}-${dia.toString().padStart(2, '0')}`;


        var objData = new FormData();
        objData.append("listarGastos", "ok");
        objData.append("fechaActual", fechaFormateada);
        fetch("src/controladores/ctr_gastos.php", {
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
                cargarDatosGasto(response);
            })
            .catch((error) => {
                console.log(error);
            });
        function cargarDatosGasto(response) {
            var dataSet = [];
            response.forEach(listarDatosG);
            function listarDatosG(item, index) {
                var objBotones = `
                        <div class="button-container">
                            <!-boton para editar-->
                            <button class="button" id="Btn_Gasto_Editar" idGasto="${item.idGasto}" monto="${item.monto}" descripcion="${item.descipcionGasto}" formaPago="${item.formapago_idFormaPago}" idPresupuesto="${item.idPresupuesto}" data-bs-toggle="modal" data-bs-target="#modalFormulaioEditarCapital">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                
                            <!-boton para eliminar-->
                            
                            <button class="button btn_Eliminar_Gasto"  id="btn_Eliminar_Gasto" idGasto="${item.idGasto}" idPresupuesto="${item.idPresupuesto}"  monto="${item.monto}" >
                                <i class="bi bi-trash"></i>
                            </button>
                
                        </div>`;
                dataSet.push([item.hora, item.fecha, item.monto, item.descripcionGasto, item.NombreFormaPago, item.presupuesto, objBotones]);
            }
            if (tablaGastos != null) {
                $("#tabla_Gastos").dataTable().fnDestroy();
            }
            var tablaGastos = $("#tabla_Gastos").dataTable({
                data: dataSet,
                search: {
                    return: true
                },
                paging: false,
                scrollY: 300,
                responsive: true,
                bDestroy: true
            });
        }
    }

    // funcion para cargar los datos en la tabla



    // funcion para eliminar gastos
    $(document).on("click", "#btn_Eliminar_Gasto", function () {
        const idGasto = $(this).attr("idGasto");
        const idPresupuesto = $(this).attr("idPresupuesto");
        const monto = $(this).attr("monto");
        Swal.fire({
            title: '¿Está seguro de eliminar este gasto?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3CB371',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Sí, eliminar'
        }).then((result) => {
            if (result.isConfirmed) {
                var objData = new FormData();
                objData.append("idGastoEliminado", idGasto);
                objData.append("IdPresupuestoEliminado", idPresupuesto);
                objData.append("montoEliminado", monto);

                fetch("src/controladores/ctr_gastos.php", {
                    method: "POST",
                    body: objData,
                })
                    .then((response) => response.json())
                    .catch((error) => {
                        console.log(error);
                    })
                    .then((response) => {
                        listarGastos();
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

                        instance.listarValoresAmenu();
                    })
            }
        })
    });

});


class GastosUsuario {
    constructor(objData) {
        this._objCapital = objData;

    }

    ListarGastosInterfaz() {
        var objData = new FormData();
        objData.append("listarGastosInterfaz", this._objCapital.listarGastos);

        fetch("src/controladores/ctr_gastos.php", {
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
                cargarDatosGasto(response);
                var dataSet = [];
                response.forEach(listarDatosC);

                function listarDatosC(item, index) {
                    var objBotones = `
                    <div class="button-container">
                        <!-- Botón para editar -->
                        <button class="button" id="Btn_Gasto_Editar" idGasto="${item.idGasto}" monto="${item.monto}" descripcion="${item.descipcionGasto}" formaPago="${item.formapago_idFormaPago}" idPresupuesto="${item.idPresupuesto}" data-bs-toggle="modal" data-bs-target="#modalFormulaioEditarCapital">
                            <i class="bi bi-pencil-square"></i>
                        </button>

                        <!-- Botón para eliminar -->
                        <button class="button btn_Eliminar_Gasto" id="btn_Eliminar_Gasto" idGasto="${item.idGasto}" idPresupuesto="${item.idPresupuesto}" monto="${item.monto}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>`;

                    dataSet.push([item.hora, item.NombreFormaPago, item.descripcionGasto, item.monto, objBotones]);
                }

                if (tablaTransaccionesCapital != null) {
                    $("#tablaTransaccionesCapital").DataTable().destroy();
                }

                tablaTransaccionesCapital = $("#tablaTransaccionesCapital").DataTable({
                    destroy: true,
                    data: dataSet,
                    search: {
                        return: true
                    },
                    paging: false,
                    scrollY: 300,
                    responsive: true,
                });
            })
            .catch((error) => {
                console.log(error);
            });
    }
}

