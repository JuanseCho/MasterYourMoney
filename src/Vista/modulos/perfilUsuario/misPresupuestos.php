<div class="container p-2 jsContainer">
    <div>
        <div class="row mt-4 mb-4 p-4">
            <div class="col-md-12">
                <div class="titulo_categoria">
                    <h2>
                        <p style="font-size: 2rem;">
                            <span style="color: blue; font-size: 2rem;">
                                Mis
                            </span>
                            Presupuestos
                        </p>
                    </h2>
                    <div style="display: flex; flex-direction: row;">
                        <button class="button1" id="Btn_Presupuestos">
                            <span>
                                Agregar presupuesto
                            </span>
                        </button>
                        <button class="button1" id="Btn_T-Gastos">
                            <span>Gastos</span>
                        </button>
                    </div>


                </div>
            </div>
        </div>

        <hr size="5" color="#455181">
        <div class="row jsDivR p-4 ">
            <div class=" col-md-12 col-sm-12 col-lg-2  user-profile">
                <img class="col-md-2 user-profile-avatar" src="src\Vista\img\2.jpeg" />
                <i>Sebastian</i>
            </div>

            <div class="col-md-10 col-sm-12 col-lg-10  jsDiv">

                <table class="table table-striped nowrap dataTables_scrollBody" style="width: 100%;" id="Tabla_De_Presupuestos">
                    <thead>
                        <tr>
                            <th> tipo de gastos </th>
                            <th>
                                limite presupuestal
                            </th>
                            <th>
                                acciones
                                <i class="bi bi-credit-card-2-front"></i>
                        </tr>
                    </thead>
                    <tbody>

                </table>
            </div>

        </div>
    </div>
</div>

<!--Formulario para ingresar nuevos presupuestos-->

<div class="col-md-6 col-lg-4 col-sm-10 jsDiv form-emerg" id="ventana_del_formulario_Presupuestos" style="">
<button class="cssbuttons-io-button" id="cerrar-ventana">
        <i class="bi bi-x-lg"></i>
    </button>
    <h3 class="titulos">Agregar presupuesto</h3>
    <form id="form_Agregar_Presupuesto">
        <div>
            <label for="" class="form-label">tipo de de gasto</label>
            <select class="form-select" name="" id="select_tipoGasto" required>
            </select>
            <div class="valid-feedback">correcto</div>
            <div class="invalid-feedback">error rellena el campo</div>
        </div>
        <div>
            <label for="" class="form-label">limite presupuestal</label>
            <input type="number" class="form-control" name="" id="txt_Presupuesto" placeholder="$50.0000" maxlength="15" required>
            <div class="valid-feedback">correcto</div>
            <div class="invalid-feedback">error rellena el campo</div>
        </div>
        <button class="btn" id="Btn_new_presupuesto">Agregar</button>
    </form>
</div>

<!--Formulario pa ingresar nuevos tipos de gastos-->

<div class="col-md-6 col-lg-4 col-sm-8 jsDiv form-emerg" id="ventana_del_formulario_TG" style="padding: 2vh; display: no">
    <button class="cssbuttons-io-button">
        <i class="bi bi-x-lg"></i>
    </button>
    
    <h3 class="titulos">tipos de gastos</h3>

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <form id="form_Agregar_tipoDeGastos" class="needs-validation">
                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <label for="" class="form-label">nombre</label>
                        <input type="text" class="form-control" name="" id="txt_NombreTipoGasto" placeholder="nombre describe " maxlength="50" required>


                        <div class="valid-feedback">correcto</div>
                        <div class="invalid-feedback">error rellena el campo</div>
                    </div>

                    <button class="btn col-md-3 col-sm-12">Agregar <i class="bi bi-plus-circle"></i></button>
                </div>


            </form>
        </div>

        <hr size="5" color="#455181">

        <div class=" col-md-12" style="background-color: rgba(226, 225, 220, 0.397);">
            <table id="tabla_tipoDeGastos" class="table table-striped nowrap dataTables_scrollBody" style="width: 100%;">
                <thead  >
                    <tr>
                        <th > gastos </th>
                        <th>
                            acciones
                            <i class="bi bi-credit-card-2-front"></i>
                        </th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>

</div>

<!--Formulario para Editar tipos de gastos-->

<div class="col-md-3 jsDiv form-emerg" id="ventana_del_formulario_TG_Edit" style="padding: 2vh; display: non">
<button class="cssbuttons-io-button">
        <i class="bi bi-x-lg"></i>
    </button>
    <h3 class="titulos">tipos de gastos</h3>
    <div class="row">
        <div class="col-md-12 col-sm-10">
            <form id="form_Editar_tipoDeGastos" class="needs-validation">
                <div>
                    <label for="" class="form-label">nombre</label>
                    <input type="text" class="form-control" name="" id="txt_edit_NombreTipoGasto" placeholder="nombre descriptivo " maxlength="50" required>


                    <div class="valid-feedback">correcto</div>
                    <div class="invalid-feedback">error rellena el campo</div>

                </div>

                <button class="btn" id="btn_Edit_tipo_gasto_f" idTipoGastof="">Editar <i class="bi bi-plus-circle"></i></button>

                <button class="btn" id="btn_Cancelar_edit_tipo_gasto">Cancelar <i class="bi bi-plus-circle"></i></button>

            </form>
        </div>
    </div>

</div>

<!--Formulario para Editar presupuesto-->

<div class="col-md-4 col-sm-8 jsDiv form-emerge" id="ventana_del_formulario_Presupuesto_Edit" style="display: none;">
<button class="cssbuttons-io-button">
        <i class="bi bi-x-lg"></i>
    </button>
    <h3 class="titulos">Editar presupuesto</h3>
    <form id="form_Editar_Presupuesto">
        <div>
            <label for="" class="form-label">tipo de de gasto</label>
            <select class="form-select" name="" id="select_edit_tipoGasto">
            </select>
        </div>
        <div>
            <label for="" class="form-label">
                limite presupuestal
            </label>
            <input type="number" class="form-control" name="" id="txt_edit_Presupuesto" placeholder="$50.0000">
        </div>
        <button class="btn" id="btn_Edit_Presupuesto_f" idPresupuestoF= "" >Editar</button>
         
    </form>
</div>