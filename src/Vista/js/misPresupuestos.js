
$(document).ready(function () {

    "use strict";
    listarTiposPresupuesto();
    listarPresupuestos();

    var tablaTipoPresupuesto = null;
    var tablaCapitalesDePresupuesto = null;

    // *******************************
    //   ¡CRUD PARA EL TIPO DE GASTOS!
    // *******************************
    // function para agregar tipo de Presupuesto
    const forms = document.querySelectorAll("#form_Agregar_tipoDePresupuesto");
    Array.from(forms).forEach((form) => {
        form.addEventListener("submit", (event) => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add("was-validated");
            } else {
                event.preventDefault();
                let tipoPresupuesto = $("#txt_NombreTipoPresupuesto").val();
                let objData = new FormData();
                objData.append("nombreTipoDePresupuesto", tipoPresupuesto);

                fetch("src/controladores/ctr_tipoPresupuesto.php", {
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
                        $("#txt_NombreTipoPresupuesto").val("");
                        listarTiposPresupuesto();
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        });
    });
    // function para listar tipo de Presupuesto
    function listarTiposPresupuesto() {
        var objData = new FormData();
        objData.append("listarTiposDePresupuesto", "ok");
        fetch("src/controladores/ctr_tipoPresupuesto.php", {
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
        var objSelect = `<option selected disabled> selecione la el tipo de Presupuesto </option>`;
        var objSelectEdit = `<option selected disabled> selecione el tipo de Presupuesto </option>`;
        var selectedOptions = [];
        var selectedOptionsEdit = [];

        response.forEach(listarDatosTG);
        function listarDatosTG(item, index) {

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////
            var objBotones = `
            <div class="button-container">
                <!-boton para editar-->
                <button class="button" id="btn_Edit_tipo_Presupuesto" idTipoPresupuesto="${item.idTipoPresupuesto}" nombreTipoPresupuesto="${item.NombreTipoPresupuesto}">
                    <i class="bi bi-pencil-square"></i>
                </button>

                <!-boton para eliminar-->
                
                <button class="button" id="btn_Eliminar" idTipoPresupuesto="${item.idTipoPresupuesto}">
                    <i class="bi bi-trash"></i>
                </button>

            </div>`;

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////
            dataSet.push([item.NombreTipoPresupuesto, objBotones]);
        }
        if (tablaTipoPresupuesto != null) {
            $("#tabla_tipoDePresupuesto").dataTable().fnDestroy();
        }
        tablaTipoPresupuesto = $("#tabla_tipoDePresupuesto").DataTable({
            search: {
                return: true
            },
            paging: false,
            scrollY: 300,
            responsive: true
        });

        $('button#btn_Edit_Presupuesto').each(function () {
            // Obtenemos el valor del atributo 'idtipoPresupuesto'
            var idTipoPresupuesto = $(this).attr('idtipoPresupuesto');

            // Agregamos el valor al array
            selectedOptions.push(idTipoPresupuesto);
        });



        response.forEach(function (item, index) {
            if (!selectedOptions.includes(item.idTipoPresupuesto)) {
                objSelect += `<option value="${item.idTipoPresupuesto}">${item.NombreTipoPresupuesto}</option>`;
            }
        });

        $("#select_tipoPresupuesto").html(objSelect);
        ///////////////////////////////////////////////////////////////////////////////////////////////

        $("#Tabla_De_Presupuestos").on("click", "#btn_Edit_Presupuesto", function () {


            var idPresupuesto = $(this).attr("idPresupuesto");
            var idTipoPresupuesto = $(this).attr("idTipoPresupuesto");
            var limitePresupuesto = $(this).attr("limitePresupuesto");


            $("#btn_Edit_Presupuesto_f").attr("idPresupuestoF", idPresupuesto);
            $("#txt_edit_Presupuesto").val(limitePresupuesto);
            $("#select_edit_tipoPresupuesto").val(idTipoPresupuesto);


        });
        //para que no se repita el tipo de Presupuesto en el select
        response.forEach(function (item, index) {
            if (!selectedOptionsEdit.includes(item.idTipoPresupuesto)) {
                objSelectEdit += `<option value="${item.idTipoPresupuesto}">${item.NombreTipoPresupuesto}</option>`;
            }
        });


        $("#select_edit_tipoPresupuesto").html(objSelectEdit);

        //////////////////////////////////////////////////////////////////////////////////



        $("#tabla_tipoDePresupuesto").on("click", "#btn_Edit_tipo_Presupuesto", function () {
            $("#ventana_del_formulario_TG_Edit").show();

            var idTipoPresupuesto = $(this).attr("idTipoPresupuesto");
            var nombreTipoPresupuesto = $(this).attr("nombreTipoPresupuesto");

            $("#btn_Edit_tipo_Presupuesto_f").attr("idTipoPresupuestof", idTipoPresupuesto);
            $("#txt_edit_NombreTipoPresupuesto").val(nombreTipoPresupuesto);
        });
    }
    // function para editar tipo de Presupuesto
    const formsEdit = document.querySelectorAll("#form_Editar_tipoDePresupuesto");
    Array.from(formsEdit).forEach((form) => {
        form.addEventListener("submit", (event) => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add("was-validated");
            } else {
                event.preventDefault();

                let idTipoPresupuesto = $("#btn_Edit_tipo_Presupuesto_f").attr("idTipoPresupuestof");
                let nombreTipoPresupuesto = $("#txt_edit_NombreTipoPresupuesto").val();

                let objData = new FormData();
                objData.append("editId", idTipoPresupuesto);
                objData.append("editnobre_TipoPresupuesto", nombreTipoPresupuesto);

                fetch("src/controladores/ctr_tipoPresupuesto.php", {
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
                        $("#txt_edit_NombreTipoPresupuesto").val("");
                        document.getElementById("ventana_del_formulario_TG_Edit").style.display = "none";
                        listarTiposPresupuesto();
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        });
    });
    // function para eliminar tipo de Presupuesto
    $("#tabla_tipoDePresupuesto").on("click", "#btn_Eliminar", function () {
        var id = $(this).attr("idTipoPresupuesto");
        var objData = new FormData();
        objData.append("editId_Eliminar", id);

        fetch("src/controladores/ctr_tipoPresupuesto.php", {
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
                listarTiposPresupuesto();
            });
    });
    ////////////////////////////////////////////////////
    //eventos para mostrar y ocultar ventanas de formularios
    $("#Btn_T-Presupuesto").on("click", function () {
        $("#ventana_del_formulario_TG").show();

    });
    $(".cssbuttons-io-button").on("click", function () {
        $("#ventana_del_formulario_TG").hide();

    });

    $("#btn_Cancelar_edit_tipo_Presupuesto").on("click", function () {
        $("#ventana_del_formulario_TG_Edit").hide();

    });
    document.getElementById("btn_Cancelar_edit_tipo_Presupuesto").addEventListener("click", function () {
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
        console.log(response);

        var dataSet = [];

        var selectedOptionsEdit = [];
        var selectedOptions = "<option selected montoPresupuestoAsignado='0' nombrePresupuesto='' >seleccione el presupuesto </option>";

        response.forEach(listarDatosP);

        function listarDatosP(item, index) {
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////

            var objBotones = `
            <div class="button-container">
                <button class="button" id="btn_Agregar_Al_Presupuesto" idPresupuesto="${item.idPresupuesto}" idTipoPresupuesto="${item.tipopresupuesto_idTipoPresupuesto}" nombreTipoPresupuesto="${item.NombreTipoPresupuesto}" limitePresupuesto="${item.ValorAsignado}">
                     <i class="bi bi-cash-coin"></i>
                </button>
                <!-boton para editar-->
                <button class="button" id="btn_Edit_Presupuesto" idPresupuesto="${item.idPresupuesto}" idTipoPresupuesto="${item.idTipoPresupuesto}" nombreTipoPresupuesto="${item.NombreTipoPresupuesto}" limitePresupuesto="${item.ValorAsignado}" data-bs-toggle="modal" data-bs-target="#ventana_del_formulario_Presupuesto_Edit">
                    <i class="bi bi-pencil-square"></i>
                </button>

                <!-boton para eliminar-->
                
                <button class="button" id="btn_Eliminar_Presupuesto" idPresupuesto="${item.idPresupuesto}">
                    <i class="bi bi-trash"></i>
                </button>

            </div>`;

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////

            dataSet.push([item.NombreTipoPresupuesto, item.ValorAsignado, item.montoActual, item.nombres_capitales ,objBotones ]);


            selectedOptions += `<option value="${item.idPresupuesto}" montoactual="${item.montoActual}" montoPresupuestoAsignado="${item.ValorAsignado}" nombrePresupuesto="${item.NombreTipoPresupuesto}">   ${item.NombreTipoPresupuesto}</option>`;


        }




        // $("#select_Presupuesto").html(selectedOptions);
        if (tablaPresupuesto != null) {
            $("#Tabla_De_Presupuestos").dataTable().fnDestroy();
        }
        tablaPresupuesto = $("#Tabla_De_Presupuestos").DataTable({

            data: dataSet,
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

 
      function listarCapitalesDePresupuesto() {
   var id = $('#btn_Edit_Presupuesto').attr('idPresupuesto');

        var objData = new FormData();
        objData.append("listarCapitalesDePresupuesto", "ok");
        objData.append("IdPresupuesto", id);



        fetch("src/controladores/ctrCapitalesDePresupuesto.php", {
            method: "POST",
            body: objData,
        })
            .then((response) => response.json())
            .catch((error) => {
                console.log(error);
            })
            .then((response) => {
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
                <!--boton para editar-->
                <button class="button" id="btn_Edit_CapitalDePresupuesto" idCapital="${item.idCapital}" nombreCapital="${item.descipcion}">
                    <i class="bi bi-pencil-square"></i>
                </button>
    
                <!--boton para eliminar-->
                <button class="button" id="btn_Eliminar_CapitalDePresupuesto" idCapital="${item.idCapital}">
                    <i class="bi bi-trash"></i>
                </button>
            </div>`;
            dataSet.push([ item.fecha, item.descipcion ,item.valorDeducido, objBotones ]);
        }
    
        if (tablaCapitalesDePresupuesto != null) {
            $("#tabla_capitalesDePresupuesto").dataTable().fnDestroy();
        }
        tablaCapitalesDePresupuesto = $("#tabla_capitalesDePresupuesto").DataTable({
            data: dataSet,
            columns: [
                { title: "Fecha" },
                { title: "Descripción" },
                { title: "Valor Deducido" },
                { title: "Acciones" }
            ],
            destroy: true, 
            search: {
                return: true
            },
            paging: false,
            scrollY: 300,
            responsive: true
        });
    }
    
    ////////////////////////////////////////////////////
    //eventos para mostrar y ocultar ventanas de formularios
    $("#Btn_Presupuestos").on("click touchstart", function () {
        $("#ventana_del_formulario_Presupuestos").show();

    });
    $("#cerrar-ventana").on("click touchstart", function () {
        $("#ventana_del_formulario_Presupuestos").hide();
        $("#select_tipoPresupuesto").empty();
        listarTiposPresupuesto();


    });

    $("#cerrar-ventanaCP").on("click touchstart", function () {
        $("#ventana_del_formulario_Capital_Has_Presupuesto").hide();
    });

    $("#Btn_Presupuestos").on("click touchstart", function () {
        $("#select_tipoPresupuesto").empty();
        listarTiposPresupuesto();
    });
    $(document).on('click touchstart', '#btn_Edit_Presupuesto', function() {
        listarCapitalesDePresupuesto();
    });
    

    $("#btn_Cancelar_edit_tipo_Presupuesto").on("click touchstart", function () {
        $("#ventana_del_formulario_TG_Edit").hide();

    });
    document.getElementById("btn_Cancelar_edit_tipo_Presupuesto").addEventListener("click", function () {
        document.getElementById("ventana_del_formulario_TG_Edit").style.display = "none";
    });

    $("#Tabla_De_Presupuestos").on("click touchstart", "#btn_Agregar_Al_Presupuesto", function () {
        $("#ventana_del_formulario_Capital_Has_Presupuesto").show();
        var idPresupuesto = $(this).attr("idPresupuesto");
        $("#Btn_new_Capital_presupuesto").attr("idPresupuestoF", idPresupuesto);


    })
    $("#Btn_new_Capital_presupuesto").on("click touchstart", function () {
        $("#ventana_del_formulario_Capital_Has_Presupuesto").hide();

        // Agrega un retraso de 2 segundos (ajusta según tus necesidades)
        setTimeout(function () {
            listarPresupuestos();
        }, 2000); // 2000 milisegundos = 2 segundos
    });




})


