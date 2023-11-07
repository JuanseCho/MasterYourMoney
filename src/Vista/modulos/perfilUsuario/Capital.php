<div class="container p-2 jsContainer">
    <div>
        <div class="row mt-4 mb-4 p-4">
            <div class="col-md-12">
                <div class="titulo_categoria">
                    <div class="col-lg-4">
                        <h2>
                            <p style="font-size: 3rem;">
                                <span style="color: blue;">
                                    Mi
                                </span>
                                Capital
                            </p>
                        </h2>
                    </div>
                    <div style="display: flex; flex-wrap: wrap; justify-content: space-between;" class="col-lg-8">
                        <div id="montoTotal" style="flex-grow: 1;"></div>
                        
                        <button style="flex-grow: 0;" class="button1" data-bs-toggle="modal" data-bs-target="#modalFormCapital">
                            <span>
                                Agregar al capital
                            </span>
                        </button>
                    </div>

                </div>
            </div>

        </div>
        <hr size="5" color="#000000">
        <div class="row jsDivR p-4 ">
            <div class=" col-md-12 col-lg-1 sm-12 user-profile">
                <img class="col-md-2 user-profile-avatar" src="src\Vista\img\2.jpeg" />
                <i>Sebastian</i>
            </div>
            <div class="col-md-12 col-lg-8 sm-12  jsDiv">
                <h3 class="titulos">CAPITALES </h3>
                <table id="tabla_Capital" class="table table-striped nowrap dataTables_scrollBody " style="width: 100%;">
                    <thead>
                        <tr>
                            <th>monto</th>
                            <th>Descripcion</th>
                            <th>forma de pago </th>

                            <th> acciones </th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
</div>

<!--Formulario pa ingresar la nuevo Capital -->

<!-- The Modal -->
<div class="modal " id="modalFormCapital">
    <div class="modal-dialog ">
        <div class="modal-content ">

            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="titulos">Agregar capital</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <form id="form_Agregar_Capital">
                    <div>
                        <label class="form-label">Monto</label>
                        <input type="number" class="form-control" id="txt_monto" required>

                    </div>
                    <div>
                        <label class="form-label">Descripcion</label>
                        <input type="text" class="form-control" id="txt_descripcion" required>

                    </div>
                    <div>
                        <label class="form-label">Forma de pago</label>
                        <section>
                            <select class="form-select" id="txt_formaD_Pago" required>
                                <option selected>seleccione el tipo de pago </option>
                                <option value="1">efectivo</option>
                                <option value="2">tarjeta</option>
                                <option value="3">cheque</option>
                            </select>
                        </section>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Agregar</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!--Formulario pa editar algun Capital -->

<!-- The Modal -->

<div class="modal" id="modalFormulaioEditarCapital">

    <div class="modal-dialog ">
        <div class="modal-content ">

            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="titulos">editar capital</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <form id="form_Editar_Capital">
                    <div>
                        <label class="form-label">Monto</label>
                        <input type="number" class="form-control" id="txt_montoEditar" required>

                    </div>
                    <div>
                        <label class="form-label">Descripcion</label>
                        <input type="text" class="form-control" id="txt_descripcionEditar" required>

                    </div>
                    <div>
                        <label class="form-label">Forma de pago</label>
                        <section>
                            <select class="form-select" id="txt_formaD_PagoEditar" required>
                                <option selected>seleccione el tipo de pago </option>
                                <option value="1">efectivo</option>
                                <option value="2">tarjeta</option>
                                <option value="3">cheque</option>
                            </select>
                        </section>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" id="BTN_editarCapital" type="submit" idcapital="">Editar</button>

                    </div>
                </form>

            </div>
        </div>


    </div>