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
                        <button class="button1">
                            <span>
                                Agregar presupuesto
                            </span>
                        </button>
                        <button class="button1">
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
                <button class="btn  " id="editBtn" style="display:block ;">Editar</button>
                <table class="table table-striped nowrap dataTables_scrollBody" style="width: 100%;" id="Tabla_De_Presupuestos">
                    <thead>
                        <tr>
                            <th> tipo de gastos </th>
                            <th>
                                limite presupuestal
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr onclick="myFunction(event)">
                            <td>alimentacion</td>
                            <td>1000</td>
                        </tr>
                        <tr>
                            <td>transporte</td>

                            <td>2000</td>

                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<!--Formulario para ingresar nuevos presupuestos-->

<div class="col-md-4 col-sm-8 jsDiv form-emerg">
    <h3 class="titulos">Agregar presupuesto</h3>
    <form>
        <div>
            <label for="" class="form-label">tipo de de gasto</label>
            <select class="form-select" name="" id="" required>
                <option selected></option>
                <option value="">alimentacion</option>
                <option value="">transporte</option>
                <option value="">servicios</option>
                <option value="">salud</option>
                <option value="">educacion</option>
                <option value="">diversion</option>

            </select>
            <div class="valid-feedback">correcto</div>
            <div class="invalid-feedback">error rellena el campo</div>
        </div>
        <div>
            <label for="" class="form-label">
                limite presupuestal
            </label>
            <input type="number" class="form-control" name="" id="" placeholder="$50.0000" maxlength="15">
            <div class="valid-feedback">correcto</div>
            <div class="invalid-feedback">error rellena el campo</div>
        </div>
        <button class="btn">Agregar</button>
    </form>
</div>

<!--Formulario pa ingresar nuevos tipos de gastos-->

<div class="col-md-6 jsDiv form-emerg" style="padding: 2vh;">
    <h3 class="titulos">tipos de gastos</h3>
    <div class="row">
        <div class="col-md-4 col-sm-10">
            <form id="form_Agregar_tipoDeGastos" class="needs-validation">
                <div>
                    <label for="" class="form-label">nombre</label>
                    <input type="text" class="form-control" name="" id="txt_NombreTipoGasto" placeholder="nombre describe " maxlength="50" required>


                    <div class="valid-feedback">correcto</div>
                    <div class="invalid-feedback">error rellena el campo</div>
                </div>

                <button class="btn">Agregar <i class="bi bi-plus-circle"></i></button>

            </form>
        </div>


        <div class="jsDiv col-md-8">
            <table id="tabla_tipoDeGastos" class="table table-striped nowrap dataTables_scrollBody" style="width: 100%;">
                <thead>
                    <tr>
                        <th> gastos </th>
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

<div class="col-md-3 jsDiv form-emerg" style="padding: 2vh;">
    <h3 class="titulos">tipos de gastos</h3>
    <div class="row">
        <div class="col-md-12 col-sm-10">
            <form id="form_Editar_tipoDeGastos" class="needs-validation">
                <div>
                    <label for="" class="form-label">nombre</label>
                    <input type="text" class="form-control" name="" id="txt_edit_NombreTipoGasto" placeholder="nombre describe " maxlength="50" required >


                    <div class="valid-feedback">correcto</div>
                    <div class="invalid-feedback">error rellena el campo</div>

                </div>

                <button class="btn" id="btn_Edit_tipo_gasto_f" idTipoGastof="" >Editar <i class="bi bi-plus-circle"></i></button>
                
                <button class="btn" id="btn_Cancelar_edit_tipo_gasto" >Cancelar <i class="bi bi-plus-circle"></i></button>

            </form>
        </div>
    </div>

</div>


   
    
                
                


<!--Formulario para Editar presupuesto-->

<div class="col-md-4 col-sm-8 jsDiv form-emerg">
    <h3 class="titulos">Editar presupuesto</h3>
    <form>
        <div>
            <label for="" class="form-label">tipo de de gasto</label>
            <select class="form-select" name="" id="">
                <option selected>alimentacion</option>

                <option value="">transporte</option>
                <option value="">servicios</option>
                <option value="">salud</option>
                <option value="">educacion</option>
                <option value="">diversion</option>

            </select>
        </div>
        <div>
            <label for="" class="form-label">
                limite presupuestal
            </label>
            <input type="number" class="form-control" name="" id="" placeholder="$50.0000">
        </div>
        <button class="btn">Agregar</button>
    </form>
</div>