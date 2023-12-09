
$(document).ready(function () {

    "use strict";
    var tablaPresupuesto = null;
    listarPresupuestos();

    instance.listarValoresAmenu(); var objData = { listarValoresAmenu: "ok" };
    var instance = new cartasMenuUsuario(objData);
    instance.listarValoresAmenu();

    var objData = { listarPresupuesto: "ok" };
    var instance = new presupuestos(objData);
    instance.listarPresupuestos();
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
                alert(limitePresupuesto);

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
                                timer: 2500,
                                customClass: {
                                    title: 'swal'
                                }
                            });

                            $("#txt_Presupuesto").val("");

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
                                timer: 2500
                            });
                        }

                        listarPresupuestos();
                        instance.listarValoresAmenu(); 
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        });
    });





    // function listarPresupuestos() {
    //     var objData = new FormData();
    //     objData.append("listarPresupuestos", "ok");
    //     fetch("src/controladores/ctr_presupuesto.php", {
    //         method: "POST",
    //         body: objData,
    //     })
    //         .then((response) => response.json())
    //         .catch((error) => {
    //             console.log(error);
    //         })
    //         .then((response) => {
    //             cargarDatosPresupuesto(response);

    //         });
    // }

    // // function para cargar datos en la tabla
    // function cargarDatosPresupuesto(response) {
    //     console.log(response);

    //     var dataSetPresupuesto = [];

    //     var selectedOptionsEdit = [];
    //     var selectedOptions = "<option selected montoPresupuestoAsignado='0' nombrePresupuesto='' >seleccione el presupuesto </option>";

    //     response.forEach(listarDatosP);

    //     function listarDatosP(item, index) {
    //         /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //         var objBotones = `
    //           <div class="button-container">
    //               <button class="button" id="btn_Agregar_Al_Presupuesto" idPresupuesto="${item.idPresupuesto}" Presupuesto="${item.idPresupuesto}" nombrePresupuesto="${item.descripcionPresupuesto}" limitePresupuesto="${item.ValorAsignado}" data-bs-toggle="modal" data-bs-target="#ventana_del_formulario_Capital_Has_Presupuesto">
    //                    <i class="bi bi-cash-coin"></i>
    //               </button>
    //               <!-boton para editar-->
    //               <button class="button" id="btn_Edit_Presupuesto" idPresupuesto="${item.idPresupuesto}" DescripcionPresupuesto="${item.descripcionPresupuesto}" nombreTipoPresupuesto="${item.NombreTipoPresupuesto}" limitePresupuesto="${item.ValorAsignado}" data-bs-toggle="modal" data-bs-target="#ventana_del_formulario_Presupuesto_Edit">
    //                   <i class="bi bi-pencil-square"></i>
    //               </button>
  
    //               <!-boton para eliminar-->
                  
    //               <button class="button" id="btn_Eliminar_Presupuesto" idPresupuesto="${item.idPresupuesto}">
    //                   <i class="bi bi-trash"></i>
    //               </button>
  
    //           </div>`;

    //         /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //         dataSetPresupuesto.push([item.descripcionPresupuesto, item.ValorAsignado, item.montoActual, item.capitales, objBotones]);
    //         selectedOptions += `<option value="${item.idPresupuesto}" montoactual="${item.montoActual}" montoPresupuestoAsignado="${item.ValorAsignado}" nombrePresupuesto="${item.NombreTipoPresupuesto}">   ${item.NombreTipoPresupuesto}</option>`;
    //     }

    //     tablaPresupuesto = $("#Tabla_De_Presupuestos").DataTable({
    //         data: dataSetPresupuesto,
    //         search: {
    //             return: true
    //         },
    //         paging: false,
    //         scrollY: 300,
    //         responsive: true,
    //         destroy: true
    //     });

    //     //sumar los datos de MontoActual
    //     var totalPresupuesto = 0;
    //     tablaPresupuesto.column(2).data().each(function (value, index) {
    //         totalPresupuesto += parseFloat(value);
    //     });
    //     alert(totalPresupuesto);
    //     var formattedTotalPresupuesto = totalPresupuesto.toLocaleString('es-CO', { style: 'currency', currency: 'COP', minimumFractionDigits: 0 });

    //     $("#slc-presupuesto").html(selectedOptions);
    //     $("#totalPresupuesto").html(formattedTotalPresupuesto);


    // }





    $("#Tabla_De_Presupuestos").on("click", "#btn_Edit_Presupuesto", function () {
        var id = $(this).attr("idPresupuesto");
        var descripcionPresupuesto = $(this).attr("descripcionPresupuesto");

        $("#txt_edit_Presupuesto").val(descripcionPresupuesto);
        $("#btn_Edit_Presupuesto_f").attr("idPresupuestoF", id);
    });
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
                let PresupuestoDescription = $("#txt_edit_Presupuesto").val();


                let objData = new FormData();
                objData.append("editIdPresupuesto", idPresupuesto);
                objData.append("editPresupuesto", PresupuestoDescription);

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
                                timer: 2500,
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
                                timer: 2500
                            });
                        }
                        $("#txt_edit_Presupuesto").val("");

                        listarPresupuestos();


                        instance.listarValoresAmenu();
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
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
                                        timer: 2500,
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
                                        timer: 2500
                                    });
                                }
                                listarPresupuestos();

                                instance.listarValoresAmenu();
                            });
                    }
                });
            }
        })
    });



    ////////////////////////////////////////////////////
    

    $("#Tabla_De_Presupuestos").on("click touchstart", "#btn_Agregar_Al_Presupuesto", function () {
        $("#ventana_del_formulario_Capital_Has_Presupuesto").show();
        var idPresupuesto = $(this).attr("idPresupuesto");
        $("#Btn_new_Capital_presupuesto").attr("idPresupuestoF", idPresupuesto);

    })

    $("#Btn_new_Capital_presupuesto").on("click touchstart", function () {

        setTimeout(function () {
            listarPresupuestos();
        }, 2000);
    });
    $("#btnPresupuestos").on("click ", function () {

        listarPresupuestos();
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
                var dataSetP = [];
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

                    dataSetP.push([item.descripcionPresupuesto, item.ValorAsignado, item.montoActual, item.capitales, objBotones]);
                    selectedOptions += `<option value="${item.idPresupuesto}" montoactual="${item.montoActual}" montoPresupuestoAsignado="${item.ValorAsignado}" >${item.descripcionPresupuesto}</option>`;
                }

                // Usar this.tablaPresupuesto en lugar de tablaPresupuesto
                // if (this.tablaPresupuesto != null) {
                //     // Usar this en lugar de tablaPresupuesto
                //     this.tablaPresupuesto.destroy();
                // }

                // Usar this.tablaPresupuesto en lugar de tablaPresupuesto
                this.tablaPresupuesto = $("#Tabla_De_Presupuestos").DataTable({
                    data: dataSetP,
                    search: {
                        return: true
                    },
                    paging: false,
                    scrollY: 300,
                    responsive: true,
                    destroy: true
                });

                //sumar los datos de MontoActual
                var totalPresupuesto = 0;
                this.tablaPresupuesto.column(2).data().each(function (value, index) {
                    totalPresupuesto += parseFloat(value);
                });

                var formattedTotalPresupuesto = totalPresupuesto.toLocaleString('es-CO', { style: 'currency', currency: 'COP', minimumFractionDigits: 0 });
                $("#totalPresupuesto").html(totalPresupuesto);
                // alert(totalPresupuesto);

                $("#txt-presupuesto").html(selectedOptions);
                $("#slc-presupuesto").html(selectedOptions);

            })
            .catch((error) => {
                console.log(error);
            });
    }
}



