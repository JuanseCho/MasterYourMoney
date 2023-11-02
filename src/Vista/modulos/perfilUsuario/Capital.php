<div class="container p-2 jsContainer">
    <div>
        <div class="row mt-4 mb-4 p-4">
            <div class="col-md-12">
                <div class="titulo_categoria">
                    <h2>
                        <p style="font-size: 3rem;">
                            <span style="color: blue;">
                                Mi
                            </span>
                            Capital
                        </p>
                    </h2>
                    <button class="button1">
                        <span>
                            Agregar
                        </span>

                    </button>
                </div>
            </div>
        </div>
        <hr size="5" color="#000000">

        <div class="row jsDivR p-4 ">
            <div class=" col-md-12 col-lg-1 sm-1 user-profile">
                <img class="col-md-2 user-profile-avatar" src="src\Vista\img\2.jpeg" />
                <i>Sebastian</i>
            </div>


            <div class="col-md-12 col-lg-10 col-sm-8  jsDiv">

                <table>
                    <thead>
                        <tr>
                            <th>CAPITALES</th>
                            <th>DESCRIPCÓN</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>
</div>





<div class="col-md-6 col-lg-4 col-sm-10 jsDiv form-emerge" id="ventana_del_formulario_Presupuestos" style="display: none;">
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




<!--Formulario pa ingresar nuevos capitales-->

<div class="col-md-6 col-lg-4 col-sm-8 jsDiv form-emerg" id="ventana_del_formulario_TG" style="padding: 2vh; display: nonee;">
    <button class="cssbuttons-io-button">
        <i class="bi bi-x-lg"></i>
    </button>

    <h3 class="titulos">nuevo capital</h3>

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <form id="form_Agregar_capitales" class="needs-validation">
                <div class="row">

                    <div class="col-md-8 col-sm-12">
                        <label for="" class="form-label">monto</label>
                        <input type="number" class="form-control" name="" id="txt_monto" placeholder="$50.0000" maxlength="15" required>
                        <div class="valid-feedback">correcto</div>
                        <div class="invalid-feedback">error rellena el campo</div>
                    </div>
                    <div class="col-md-8 col-sm-12">
                        <label for="" class="form-label">nombre</label>
                        <input type="text" class="form-control" name="" id="txt_nombre" placeholder="nombre descriptivo  " maxlength="50" required>
                        <div class="valid-feedback">correcto</div>
                        <div class="invalid-feedback">error rellena el campo</div>
                    </div>

                    <div class="col-md-8 col-sm-12">
                        <label for="" class="form-label">Tipo de pago</label>
                        <select class="form-select" aria-label="Default select example" id="tipoPago" required>
                            <option selected>Seleccione una opción</option>
                            <option value="1">Efectivo</option>
                            <option value="2">Tarjeta</option>
                        </select>
                    </div>
                    <div>
                        <button class="btn col-md-3 col-sm-12">Agregar <i class="bi bi-plus-circle"></i></button>
                    </div>
                </div>

            </form>
        </div>

    </div>

</div>















































<!--Formulario pa ingresar efectivo a la caja y asi poder utilizarla como otra fuente-->

<div class=" col-6 col-md-8 col-sm-10 jsDiv form-emerg">
    <h3 class="titulos">Agregar </h3>
    <form>
        <div class="mb-3">
            <label for="" class="form-label">Efectivo</label>
            <input type="number" class="form-control" name="" id="" placeholder="$50.0000">

        </div>
        <button class="btn">Guardar</button>
    </form>
</div>


<!--Formulario pa ingresar la nueva  de fuente -->
<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
    Open modal
</button>

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->

            <div class="modal-header" style="text-align: center; justify-content: center;">

                <h3 class="titulos modal-title">Agregar Tipo de fuente</h3>

            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form id="form_Agregar_Fuente">
                    <div class="mb-3">
                        <label for="" class="form-label">nombre</label>
                        <input type="text" class="form-control" name="" id="nombreFuente" placeholder="Ej: negocio familiar" required>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Tipo de fuente</label>
                        <select class="form-select" aria-label="Default select example" id="tipoFuente" required>
                            <option selected>Seleccione una opción</option>
                            <option value="1">Ahorros</option>
                            <option value="2">Ingresos</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Monto inicial</label>
                        <input type="number" class="form-control" name="" id="montoFuente" placeholder="$50.0000" required>
                    </div>


                    <button class="btn" type="button ">Guardar</button>

                </form>
            </div>


        </div>
    </div>
</div>

<!-- formulario para agregar nueva fuente -->