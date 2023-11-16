$(document).ready(function () {

    $("#Tabla_De_Presupuestos").on("click", "#btn_Agregar_Al_Presupuesto", function () {
        $("#ventana_del_formulario_Capital_Has_Presupuesto").show();
        var idPresupuesto = $(this).attr("idPresupuesto");
        var nombrePresupuesto = $(this).attr("nombreTipoPresupuesto");
        var valorActual = $(this).attr("limitePresupuesto");
        $("#Btn_new_Capital_presupuesto").attr("idPresupuestoF", idPresupuesto);
        $("#txt_presupuesto").html(nombrePresupuesto + " tiene asignado: $" + valorActual);


    })


    // agregar capital al presupuesto a la tabla de capital_has_presupuesto

    const formsCapitalHasPresupuesto = document.querySelectorAll("#form_Agregar_Capital_Has_Presupuesto");

    formsCapitalHasPresupuesto.forEach(form => {
        form.addEventListener("submit", function (event) {
            event.preventDefault();
            if (form.checkValidity()) {
                event.stopPropagation();
                form.classList.add("was-validated");
                let idPresupuesto = $("#Btn_new_Capital_presupuesto").attr("idPresupuestoF");
                let idCapital = $("#select_tipoCapital").val();
                let valorAsignado = $("#txt_valorAsignado").val();

                let data = new FormData();
                data.append("idPresupuesto", idPresupuesto);
                data.append("idCapital", idCapital);
                data.append("valorAsignado", valorAsignado);
                console.log(idPresupuesto);
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
                    $("#ventana_del_formulario_Capital_Has_Presupuesto").hide();
                }).catch(error => {
                    console.error("Error en la solicitud:", error);

                });




            }

        })
    })


})
