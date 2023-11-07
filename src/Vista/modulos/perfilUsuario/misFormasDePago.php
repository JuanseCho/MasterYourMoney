<div class="container p-2 jsContainer">
    <div class="row mt-4 mb-4 p-4">
        <div class="col-md-12">
            <div class="titulo_categoria">
                <h2>
                    <p style="font-size: 2rem;">
                        <span style="color: blue; font-size: 2rem;">
                            Mis
                        </span>
                        Formas de pago
                    </p>
                </h2>
                <button class="btn" id="btn-agregarFormaPago" type="button" data-bs-toggle="modal" data-bs-target="#ventanaAgregarFormaPago">
                    Agregar Forma de pago
                </button>
            </div>
        </div>
    </div>
    <hr size="5" color="#455181">
    <div class="row jsDivR p-4">
        <div class=" col-md-12 col-sm-12 col-lg-2  user-profile">
            <img class="col-md-2 user-profile-avatar" src="src\Vista\img\2.jpeg" />
            <i>Sebastian</i>
        </div>

        <div class="col-md-10 col-sm-12 col-lg-10 table-small jsDiv">
            <button id="editBtn" style="display: none;">Editar</button>
            <table id="tablaFormasPago" class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-bordered">

                </tbody>
            </table>
        </div>
    </div>
</div>


<!--Formulario para ingresar Formas de pago -->

<!-- The Modal -->
<div class="modal" id="ventanaAgregarFormaPago">
    <div class="modal-dialog ">
        <div class="modal-content ">

            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="titulos">Agregar Forma de pago</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <form id="formAgregarFormaPago" class="needs-validation">
                    <div>
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="txt-nombreFormaPago" placeholder="Ingrese el nombre de la Forma de Pago" required>
                        <div class="valid-feedback">correcto</div>
                        <div class="invalid-feedback">error rellena el campo</div>

                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Agregar</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<!--Formulario para Editar formas de pago-->


<!-- The Modal -->
<div class="modal" id="ventanaEditarFormaPago">
    <div class="modal-dialog ">
        <div class="modal-content ">

            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="titulos">Editar Forma de pago</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <form id="formEditarFormaPago" class="needs-validation">
                    <div>
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="txt-editnombreFormaPago" placeholder="Ingrese el nombre de la Forma de pago" required>
                        <div class="valid-feedback">correcto</div>
                        <div class="invalid-feedback">error rellena el campo</div>

                    </div>
                    <div class="col-12">
                        <button id="btnEditarFormaPago" idformaPago="" class="btn btn-primary" type="submit">Editar</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<!-- <div class="col-md-3 jsDiv modal" id="ventanaEditarFormaPago" style="padding: 2vh;">
<button class="cssbuttons-io-button">
        <i class="bi bi-x-lg"></i>
    </button>
    <h3 class="titulos">Editar Forma de pago</h3>
    <div class="row modal-dialog modal-content">
        <div class="col-md-12 col-sm-10 modal-body">
            <form id="form_Editar_tipoDeGastos" class="needs-validation">
                <div>
                    <label for="" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="" id="txt_edit_NombreTipoGasto" placeholder="Nombre" maxlength="50" required>


                    <div class="valid-feedback">correcto</div>
                    <div class="invalid-feedback">error rellena el campo</div>

                </div>

                <button class="btn" id="btn_Edit_tipo_gasto_f" idTipoGastof="">Editar <i class="bi bi-plus-circle"></i></button>

                <button class="btn" id="btn_Cancelar_edit_tipo_gasto">Cancelar <i class="bi bi-plus-circle"></i></button>

            </form>
        </div>
    </div>

</div> -->