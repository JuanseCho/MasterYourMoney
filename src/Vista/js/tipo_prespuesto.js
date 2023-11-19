$(document).ready(function () {
    listarTiposPresupuesto();
   


    var tablaTipoPresupuesto = null;

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
            data: dataSet,
            search: {
                return: true
            },
            paging: false,
            scrollY: 300
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


            $("#ventana_del_formulario_Presupuesto_Edit").show();

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

})