<div class="container p-2 jsContainer">
    <div class="row mt-4 mb-4 p-4">
        <div class="col-md-12">
            <div class="titulo_categoria">
                <h2>
                    <p style="font-size: 2rem;">
                        <span style="color: blue; font-size: 2rem;">
                            Mis
                        </span>
                        Ahorros
                    </p>
                </h2>
                <button class="button1" id="btn-agregarAhorro" type="button" data-bs-toggle="modal" data-bs-target="#ventanaAgregarAhorro">
                    <span> Agregar Ahorro</span>
                   
                </button>
            </div>
        </div>
    </div>
    <hr size="5" color="#455181">
    <div class="row jsDivR p-4">
        

        <div class="col-md-12 col-sm-12 col-lg-12 table-small jsDiv">
            <button id="editBtn" style="display: none;">Editar</button>
            <table id="tablaAhorros" class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Monto inicial</th>
                        <th scope="col">Monto actual</th>
                        <th scope="col">Monto Meta del ahorro</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-bordered">

                </tbody>
            </table>
        </div>
    </div>
</div>


<!--Formulario para ingresar Ahorros -->

<!-- The Modal -->
<div class="modal" id="ventanaAgregarAhorro">
    <div class="modal-dialog ">
        <div class="modal-content ">

            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="titulos">Agregar Ahorro</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <form id="formAgregarAhorro" class="needs-validation">
                    <div>
                        <label class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="txt-descripcionAhorro" placeholder="Ingrese la descripción del Ahorro" required>
                        <div class="valid-feedback">correcto</div>
                        <div class="invalid-feedback">error rellena el campo</div>
                    </div>
                    <div>
                        <label class="form-label">Monto inicial</label>
                        <input type="number" class="form-control" id="txt-montoInicialAhorro" placeholder="Ingrese el Monto inicial del Ahorro" required>
                        <div class="valid-feedback">correcto</div>
                        <div class="invalid-feedback">error rellena el campo</div>
                    </div>
                    <div>
                        <label class="form-label">Monto meta del ahorro</label>
                        <input type="number" class="form-control" id="txt-montoMetaAhorro" placeholder="Ingrese el Monto meta a alcanzar del Ahorro" required>
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


<!--Formulario para Editar ahorros-->


<!-- The Modal -->
<div class="modal" id="ventanaEditarAhorro">
    <div class="modal-dialog ">
        <div class="modal-content ">

            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="titulos">Editar Ahorro</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <form id="formEditarAhorro" class="needs-validation">
                    <div>
                        <label class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="txt-editdescripcionAhorro" placeholder="Ingrese la descripción del Ahorro" required>
                        <div class="valid-feedback">correcto</div>
                        <div class="invalid-feedback">error rellena el campo</div>
                    </div>
                    <div>
                        <label class="form-label">Monto inicial</label>
                        <input type="number" class="form-control" id="txt-editmontoInicialAhorro" placeholder="Ingrese el Monto inicial del Ahorro" required>
                        <div class="valid-feedback">correcto</div>
                        <div class="invalid-feedback">error rellena el campo</div>
                    </div>
                    <div>
                        <label class="form-label">Monto meta del ahorro</label>
                        <input type="number" class="form-control" id="txt-editmontoMetaAhorro" placeholder="Ingrese el Monto meta a alcanzar del Ahorro" required>
                        <div class="valid-feedback">correcto</div>
                        <div class="invalid-feedback">error rellena el campo</div>
                    </div>
                    <div class="col-12">
                        <button id="btnEditarAhorro" idahorro="" class="btn btn-primary" type="submit">Editar</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


</div>

