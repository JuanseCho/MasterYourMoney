class CapitalUsuario{

    constructor(objData){
        this._objCapital = objData;
    }

    tablaCapital = null;

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
                responsive: {
                    details: {
                        display: DataTable.Responsive.display.modal({
                        }),
                        renderer: DataTable.Responsive.renderer.tableAll({
                            tableClass: 'table'
                        })
                    }
                },
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


        })
        .catch((error) => {
            console.log(error);
        });
    }
}

