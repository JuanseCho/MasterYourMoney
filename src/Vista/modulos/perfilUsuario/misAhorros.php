<!-- <div class="container p-2 jsContainer">
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
                <button class="btn" id="btn-agregarAhorro" type="button" data-bs-toggle="modal" data-bs-target="#ventanaAgregarAhorro">
                    Agregar Ahorro
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
<!-- <div class="modal" id="ventanaAgregarAhorro">
    <div class="modal-dialog ">
        <div class="modal-content ">

            <!-- Modal Header -->
            <!-- <div class="modal-header">
                <h3 class="titulos">Agregar Ahorro</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div> -->

            <!-- Modal body -->
            <!-- <div class="modal-body">

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
</div> -->


<!--Formulario para Editar ahorros-->


<!-- The Modal -->
<!-- <div class="modal" id="ventanaEditarAhorro">
    <div class="modal-dialog ">
        <div class="modal-content ">

            <!-- Modal Header -->
            <!-- <div class="modal-header">
                <h3 class="titulos">Editar Ahorro</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div> -->

            <!-- Modal body -->
            <!-- <div class="modal-body">

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


</div> -->





<div class="container p-2 jsContainer" id="ahorros">
    <div>
        <div class="row mt-4 mb-4 p-4">
            <div class="col-md-12">
                <div class="titulo_categoria">
                    <div class="col-lg-4">
                        <h2>
                            <p style="font-size: 3rem;">
                                <span style="color: blue; font-size: 2rem;">
                                    Mis
                                </span>
                                Ahorros
                            </p>
                        </h2>
                    </div>
                    <div style="display: flex; flex-direction: row;">
                        <button style="flex-grow: 0;" class="button1" data-bs-toggle="modal" data-bs-target="#modalFormAhorro">
                            <span>
                                Agregar ahorro
                            </span>
                        </button>
                    </div>

                </div>
            </div>

        </div>
        <hr size="5" color="#000000">
        <div class="row jsDivR p-4 ">
    
            <div class="col-md-12 col-lg-12 sm-12  jsDiv">
                <h3 class="titulos">AHORROS</h3>
                <table id="tablaAhorros" class="table table-striped nowrap dataTables_scrollBody tabla_Capital" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Monto inicial</th>
                            <th>Monto actual</th>
                            <th>Monto Meta del ahorro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
</div>

<!--Formulario para ingresar un nuevo ahorro -->

<!-- The Modal -->
<div class="modal " id="modalFormAhorro">
    <div class="modal-dialog ">
        <div class="modal-content ">

            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="titulos">Agregar Ahorro</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <form id="formAgregarAhorro">
                    <div>
                        <label class="form-label">Descripción</label>
                        <input type="text" class="form-control" min="0" id="txt-descripcionAhorro" required>

                    </div>
                    <div>
                        <label class="form-label">Monto inicial</label>
                        <input type="text" class="form-control" id="txt-montoInicialAhorro" required>

                    </div>
                    <div>
                        <label class="form-label">Monto meta del ahorro</label>
                        <input type="text" class="form-control" id="txt-montoMetaAhorro" required>
                        
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Agregar</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!--Formulario para editar un Ahorro -->

<!-- The Modal -->

<div class="modal" id="modalFormularioEditarAhorro">

    <div class="modal-dialog ">
        <div class="modal-content ">

            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="titulos">Editar Ahorro</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <form id="formEditarAhorro">
                    <div>
                        <label class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="txt-editdescripcionAhorro" required>

                    </div>
                    <div>
                        <label class="form-label">Monto inicial</label>
                        <input type="text" class="form-control" id="txt-editmontoInicialAhorro" required>

                    </div>
                    <div>
                        <label class="form-label">Monto meta del ahorro</label>
                        <input type="text" class="form-control" id="txt-editmontoMetaAhorro" required>
                        
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" id="btnEditarAhorro" type="submit" idahorro="">Editar</button>

                    </div>
                </form>

            </div>
        </div>


    </div>
</div>