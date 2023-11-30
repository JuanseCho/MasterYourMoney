$(document).ready(function () {



    // let obj_Gasto = { "listarGastos": "ok" };
    // let objRespuestaGastos = new gastos(obj_Gasto);
    // objRespuestaGastos.listarGastos();

    const forms = document.querySelectorAll("#formAgregarGasto");
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

                const hora = fecha.getHours();
                const minutos = fecha.getMinutes();
                const segundos = fecha.getSeconds();
                const horaFormateada = `${hora.toString().padStart(2, '0')}:${minutos.toString().padStart(2, '0')}:${segundos.toString().padStart(2, '0')}`;

                var descripcion = $("#txt-descripcionGasto").val();
                var monto = $("#txt-montoGasto").val();
                var presupuesto = $("#slc-presupuesto").val();
                var formaPago = $("#slc-formaPago").val();

                var objData = new FormData();
                objData.append("horaGasto", horaFormateada);
                objData.append("fechaGasto", fechaFormateada);
                objData.append("descripcionGasto", descripcion);
                objData.append("montoGasto", monto);
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
                            // cerrar modal
                            $("#btn_Cerrar_Modal_Gasto").click();

                        } else if (response["codigo"] == "425"){
                            Swal.fire({
                                position: 'center',
                                icon: 'info',
                                title: response["mensaje"],
                                showConfirmButton: false,
                                timer: 2000
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
                        $("#ventanaAgregarGasto").modal('toggle');
                        objRespuestaGastos.listarGastos();
                    })
                    .catch((error) => {
                        console.log(error);
                    });

            }
        });

    });



    class gastos {
        constructor(objData) {
            this._objData = objData;
        }

        tablaGastos = null;

        listarGastos() {
            var objData = new FormData();
            objData.append("listarGastos", this._objData.listarGastos);
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
                        dataSet.push([item.fecha, item.Montoactual, item.descipcion, item.nombreFormaPago, objBotones]);
                        selectedOptions += `<option value="${item.idCapital}">${item.descipcion}</option>`;
                    }
                    if (tablaCapital != null) {
                        $("#tabla_Capital").dataTable().fnDestroy();
                    }
                    tablaCapital = $("#tabla_Capital").DataTable({
                        destroy: true,
                        data: dataSet,
                        search: {
                            return: true
                        },
                        paging: false,
                        scrollY: 300
                    });

                    //sumar los datos de MontoInicial


                })
        }


    }

});