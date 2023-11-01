$(document).ready(function () {

    "use strict";
    listarTiposGastos();
    listarPresupuestos();


    var tablaTipoGasto = null;

    // *******************************
    //   ¡CRUD PARA EL TIPO DE GASTOS!
    // *******************************
    // function para agregar tipo de gasto
    const forms = document.querySelectorAll("#form_Agregar_tipoDeGastos");
    Array.from(forms).forEach((form) => {
        form.addEventListener("submit", (event) => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add("was-validated");
            } else {
                event.preventDefault();
                let tipoGasto = $("#txt_NombreTipoGasto").val();
                let objData = new FormData();
                objData.append("nombreTipoDeGastos", tipoGasto);

                fetch("src/controladores/ctr_tipoGastos.php", {
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
                        $("#txt_NombreTipoGasto").val("");
                        listarTiposGastos();
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        });
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
        var objSelect = `<option selected disabled> selecione la el tipo de gasto </option>`;
        var objSelectEdit = `<option selected disabled> selecione el tipo de gasto </option>`;
        var selectedOptions = [];
        var selectedOptionsEdit = [];
        
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

        $('button#btn_Edit_Presupuesto').each(function () {
            // Obtenemos el valor del atributo 'idtipogasto'
            var idTipoGasto = $(this).attr('idtipogasto');

            // Agregamos el valor al array
            selectedOptions.push(idTipoGasto);
        });

        

        response.forEach(function (item, index) {
            if (!selectedOptions.includes(item.idtipo_gasto)) {
                objSelect += `<option value="${item.idtipo_gasto}">${item.nombre_tipo_gasto}</option>`;
            }
        });

        $("#select_tipoGasto").html(objSelect);
        ///////////////////////////////////////////////////////////////////////////////////////////////
        
        $("#Tabla_De_Presupuestos").on("click", "#btn_Edit_Presupuesto", function () {


            $("#ventana_del_formulario_Presupuesto_Edit").show();

            var idPresupuesto = $(this).attr("idPresupuesto");
            var idTipoGasto = $(this).attr("idTipoGasto");
            var limitePresupuesto = $(this).attr("limitePresupuesto");
            

            $("#btn_Edit_Presupuesto_f").attr("idPresupuestoF", idPresupuesto);
            $("#txt_edit_Presupuesto").val(limitePresupuesto);
            $("#select_edit_tipoGasto").val(idTipoGasto);


        });
        //para que no se repita el tipo de gasto en el select
        response.forEach(function (item, index) {
            if (!selectedOptionsEdit.includes(item.idtipo_gasto)) {
                objSelectEdit += `<option value="${item.idtipo_gasto}">${item.nombre_tipo_gasto}</option>`;
            }
        });


        $("#select_edit_tipoGasto").html(objSelectEdit);
        console.log(objSelectEdit);
        console.log(selectedOptionsEdit);

        //////////////////////////////////////////////////////////////////////////////////



        $("#tabla_tipoDeGastos").on("click", "#btn_Edit_tipo_gasto", function () {
            $("#ventana_del_formulario_TG_Edit").show();

            var idTipoGasto = $(this).attr("idTipoGasto");
            var nombreTipoGasto = $(this).attr("nombreTipoGasto");

            $("#btn_Edit_tipo_gasto_f").attr("idTipoGastof", idTipoGasto);
            $("#txt_edit_NombreTipoGasto").val(nombreTipoGasto);
        });
    }

    // function para editar tipo de gasto
    const formsEdit = document.querySelectorAll("#form_Editar_tipoDeGastos");

    Array.from(formsEdit).forEach((form) => {
        form.addEventListener("submit", (event) => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add("was-validated");
            } else {
                event.preventDefault();

                let idTipoGasto = $("#btn_Edit_tipo_gasto_f").attr("idTipoGastof");
                let nombreTipoGasto = $("#txt_edit_NombreTipoGasto").val();

                let objData = new FormData();
                objData.append("editId", idTipoGasto);
                objData.append("editnobre_TipoGasto", nombreTipoGasto);

                fetch("src/controladores/ctr_tipoGastos.php", {
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
                        $("#txt_edit_NombreTipoGasto").val("");
                        document.getElementById("ventana_del_formulario_TG_Edit").style.display = "none";
                        listarTiposGastos();
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        });
    });



    // function para eliminar tipo de gasto

    $("#tabla_tipoDeGastos").on("click", "#btn_Eliminar", function () {
        var id = $(this).attr("idTipoGasto");
        var objData = new FormData();
        objData.append("editId_Eliminar", id);

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
                listarTiposGastos();
            });
    });

    ////////////////////////////////////////////////////
    //eventos para mostrar y ocultar ventanas de formularios
    $("#Btn_T-Gastos").on("click", function () {
        $("#ventana_del_formulario_TG").show();

    });
    $(".cssbuttons-io-button").on("click", function () {
        $("#ventana_del_formulario_TG").hide();

    });

    $("#btn_Cancelar_edit_tipo_gasto").on("click", function () {
        $("#ventana_del_formulario_TG_Edit").hide();

    });
    document.getElementById("btn_Cancelar_edit_tipo_gasto").addEventListener("click", function () {
        document.getElementById("ventana_del_formulario_TG_Edit").style.display = "none";
    });

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
                let tipo_Gasto = $("#select_tipoGasto").val();
                let limitePresupuesto = $("#txt_Presupuesto").val();

                let objData = new FormData();
                objData.append("tipoGasto", tipo_Gasto);
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

                            $("#select_tipoGasto").empty();
                            listarTiposGastos();

                            listarTiposGastos();
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
       
        var selectedOptionsEdit = [];
        
        console.log(response);
        response.forEach(listarDatosP);
        function listarDatosP(item, index) {
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////
            var objBotones = `
            <div class="button-container">
                <!-boton para editar-->
                <button class="button" id="btn_Edit_Presupuesto" idPresupuesto="${item.idpresupuesto}" idTipoGasto="${item.idtipo_gasto}" nombreTipoGasto="${item.nombre_tipo_gasto}" limitePresupuesto="${item.limite_presupuestal}">
                    <i class="bi bi-pencil-square"></i>
                </button>

                <!-boton para eliminar-->
                
                <button class="button" id="btn_Eliminar_Presupuesto" idPresupuesto="${item.idpresupuesto}">
                    <i class="bi bi-trash"></i>
                </button>

            </div>`;

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////

            dataSet.push([item.nombre_tipo_gasto, item.limite_presupuestal, objBotones]);

        }


        if (tablaPresupuesto != null) {
            $("#Tabla_De_Presupuestos").dataTable().fnDestroy();
        }
        tablaPresupuesto = $("#Tabla_De_Presupuestos").DataTable({
            data: dataSet,
            search: {
                return: true
            },
            paging: false,
            scrollY: 300
        });

        $('button#btn_Edit_Presupuesto').click(function () {
            // Vacía el array
            var clickedButton = this; // Guarda una referencia al botón en el que se hizo clic

            $('button#btn_Edit_Presupuesto').each(function () {
                if (this !== clickedButton) { // Comprueba si este botón es diferente al botón en el que se hizo clic
                    var idTipoGasto = $(this).attr('idtipogasto');
                    var nombreTipoGasto = $(this).attr('nombreTipoGasto');

                    // Agregamos el valor al array
                    selectedOptionsEdit.push(idTipoGasto, nombreTipoGasto);
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
                let idTipoGasto = $("#select_edit_tipoGasto").val();
                let limitePresupuesto = $("#txt_edit_Presupuesto").val();

                let objData = new FormData();
                objData.append("editIdPresupuesto", idPresupuesto);
                objData.append("editIdTipoGasto", idTipoGasto);
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
        document.getElementById("btn_Cancelar_edit_tipo_gasto").addEventListener("click", function (event) {
            event.preventDefault(); // Evita el envío del formulario
            document.getElementById("ventana_del_formulario_Presupuesto_Edit").style.display = "none"; // Cierra la ventana
        });
    });

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
        $("#select_tipoGasto").empty();
        listarTiposGastos();


    });
    $("#Btn_Presupuestos").on("click", function () {
        $("#select_tipoGasto").empty();
        listarTiposGastos();
    });

    $("#btn_Cancelar_edit_tipo_gasto").on("click", function () {
        $("#ventana_del_formulario_TG_Edit").hide();

    });
    document.getElementById("btn_Cancelar_edit_tipo_gasto").addEventListener("click", function () {
        document.getElementById("ventana_del_formulario_TG_Edit").style.display = "none";
    });

    $(".cssbuttons-io-button").on("click", function () {
        $("#ventana_del_formulario_Presupuesto_Edit").hide();

    });

})

