class CapitalUsuario{

    
    constructor(objData){
        this._objCapital = objData;
    }
    
    tablaCapital = null;
    totalCapital = 0;

    listarCapital(){
        var objData = new FormData();
        objData.append("listarCapital", this._objCapital.listarCapital);
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
            // if (tablaCapital != null) {
            //     $("#tabla_CapitalInterfaz").dataTable().fnDestroy();
            // }
            this.tablaCapital = $("#tabla_Capital").DataTable({
                destroy: true,
                data: dataSet,
                search: {
                    return: true
                },
                paging: false,
                scrollY: 300
            });
    
            //sumar los datos de MontoInicial
            totalCapital = 0;
            this.tablaCapital.column(1).data().each(function (value, index) {
                totalCapital += parseFloat(value);
            });
            var formattedTotal = totalCapital.toLocaleString('es-CO', { style: 'currency', currency: 'COP', minimumFractionDigits: 0 });
            //mostrar en el div de id montoTotal
            $("#montoTotal").html(formattedTotal);
            $("#totalCapital").html(totalCapital);

            $("#txt-capitalIngreso").html(selectedOptions);
            $("#txt-editcapitalIngreso").html(selectedOptions);
            $("#txt-capitalRegAhorro").html(selectedOptions);
            $("#txt-editcapitalRegAhorro").html(selectedOptions);
            $("#txt-capitalGasto").html(selectedOptions);
            $("#select_tipoCapital").html(selectedOptions);


        })
        .catch((error) => {
            console.log(error);
        });
    }
}

