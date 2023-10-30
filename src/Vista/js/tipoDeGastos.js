$(document).ready(function () {

    "use strict";
    listarTiposGastos()
    var tablaTipoGasto = null;

    // function para agregar tipo de gasto
    var forms = document.querySelectorAll("#form_Agregar_tipoDeGastos");

    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener(
            "submit",
            function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                    form.classList.add("was-validated");

                } else {
                    event.preventDefault();

                    var tipoGasto = $("#txt_NombreTipoGasto").val();

                    var objData = new FormData();
                    objData.append("nombreTipoDeGastos", tipoGasto);

                    fetch("src/controladores/ctr_tipoGastos.php", {
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
                                    timer: 1700,
                                    customClass: {
                                        title: 'swal'
                                    }

                                })
                            } else {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: response["mensaje"],
                                    showConfirmButton: false,
                                    timer: 1700
                                })
                            }
                            $("#txt_NombreTipoGasto").val("");
                            listarTiposGastos();

                        });
                }
            },
            
        );
    });

    // function para listar tipo de gasto

    function listarTiposGastos() {
        var objData = new FormData();
        objData.append("listarTiposDeGastos", "ok");
        fetch("src/controladores/ctr_tipoGastos.php", {
            method: "POST",
            body: objData,
        })
            .then((response) => response.json())
            .catch((error) => {
                console.log(error);
            })
            .then((response) => {
                cargarDatos(response);
            });
    }

    // function para cargar datos en la tabla
    function cargarDatos(response) {
        console.log(response);
        var dataSet = [];

        response.forEach(listarDatosTG);
        function listarDatosTG(item, index) {
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////
            var objBotones = `
            <div class="button-container">
                <!-boton para editar-->
                <button class="button" id="btn_Edit_tipo_gasto" idTipoGasto="${item.idtipo_gasto}" nombreTipoGasto="${item.nombre_tipo_gasto}">
                    <i class="bi bi-pencil-square"></i>
                </button>

                <!-boton para eliminar-->
                
                <button class="button" id="btn_Eliminar" idTipoGasto="${item.idtipo_gasto}">
                    <i class="bi bi-trash"></i>
                </button>

            </div>`;

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////

            dataSet.push([item.nombre_tipo_gasto, objBotones]);
        }
        if (tablaTipoGasto != null) {
            $("#tabla_tipoDeGastos").dataTable().fnDestroy();
        }
        tablaTipoGasto = $("#tabla_tipoDeGastos").DataTable({
            data: dataSet,

            search: {
                return: true
            },
            paging: false,
            scrollY: 300
        });
        $("#tabla_tipoDeGastos").on("click", "#btn_Edit_tipo_gasto", function () {
            var idTipoGasto = $(this).attr("idTipoGasto");
            var nombreTipoGasto = $(this).attr("nombreTipoGasto");

            
            
            $("#btn_Edit_tipo_gasto_f").attr("idTipoGastof", idTipoGasto);
            $("#txt_edit_NombreTipoGasto").val(nombreTipoGasto);
        });
    }


    var formularioEditar = document.querySelectorAll("#form_Editar_tipoDeGastos");

    // function para editar tipo de gasto
    Array.prototype.slice.call(formularioEditar).forEach(function (form) {
        form.addEventListener(
            "submit",

            function (event) {
                if (!form.checkValidity()) {

                    event.preventDefault();
                    event.stopPropagation();
                    form.classList.add("was-validated");

                } else {


                    event.preventDefault();
                    var nombreTipoGasto = $("#txt_edit_NombreTipoGasto").val();
              

                    var idTipoGasto = $("#btn_Edit_tipo_gasto_f").attr("idTipoGastof");

                    var objData = new FormData();

                    objData.append("editnobre_TipoGasto", nombreTipoGasto);
                    objData.append("editId", idTipoGasto);

                    fetch("src/controladores/ctr_tipoGastos.php", {
                        method: "POST",
                        body: objData,
                    })
                        .then((response) => response.json())
                        .catch((error) => {
                            console.log(error);
                        })
                        .then((response) => {
                            alert(response["mensaje"]);

                            listarTiposGastos();
                        });
                }
            },
            
        );
    });


    // function para eliminar tipo de gasto
    $("#tabla_tipoDeGastos").on("click", "#btn_Eliminar", function () {
        var idTipoGasto = $(this).attr("idTipoGasto");
        var objData = new FormData();
        objData.append("editId", idTipoGasto);
        fetch("src/controladores/ctr_tipoGastos.php", {
            method: "POST",
            body: objData,
        })
            .then((response) => response.json())
            .catch((error) => {
                console.log(error);
            })
            .then((response) => {
                alert(response["mensaje"]);
                listarTiposGastos();
            });
    });
})