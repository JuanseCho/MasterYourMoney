<body class="bodyInterfaz">
    <div class="containerInterfaz">
        <div class="container1Interfaz">
            <div class="containerFecha">
                <div class="barraFecha"></div>
                <div class="nombreDia"></div>
            </div>
            <div class="containerCaja d-flex flex-column">
                <div class="containerCaja1 d-flex flex-row">
                    <button class="botonAhorro" id="btn-agregarAhorroCapital" type="button" data-bs-toggle="modal" data-bs-target="#ventanaAgregarAhorroCapital"><img src="src/Vista/img/ahorroBoton.png" alt="" style="width:28px;" class="mx-4"></button>
                    <div class="cashflow1 me-5 mt-3">
                        <div class="inicioCaja">$50.000</div>
                        <div class="gastoCaja">-$6.200</div>
                    </div>
                </div>
                <div class="containerCaja2 d-flex flex-row">
                    <div class="d-flex flex-row">
                        <button class="botonIngreso" id="btn-agregarIngresoCapital" type="button" data-bs-toggle="modal" data-bs-target="#ventanaAgregarIngresoCapital"><img src="src/Vista/img/ingresoBoton.png" alt="" style="width:20px;" class="mx-4"></button>
                        <button class="botonGasto" id="btn-agregarGasto" type="button" data-bs-toggle="modal" data-bs-target="#ventanaAgregarGastoCapital"><img src="src/Vista/img/gastoBoton.png" alt="" style="width:20px;" class="mx-4"></button>
                    </div>
                    <div id="capitalActual" class="actualCaja"></div>
                </div>

            </div>
            <div class="containerListadoTransacciones table-responsive">
                <table id="tablaTransaccionesCapital" class="table table-striped table-bordered shadow-lg">
                    <thead class="table-dark shadow-lg">
                        <tr>
                            <th>Hora</th>
                            <th>Tipo de transacción</th>
                            <th>Descripción</th>
                            <th>Valor</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="table-light table-bordered">

                    </tbody>
                </table>
            </div>
        </div>
        <div class="container2Interfaz"></div>
    </div>

    <div class="containerListadoTransacciones">
        <table id="tablaGastosCapital" class="table table-striped table-bordered shadow-lg">
            <thead class="table-dark shadow-lg">
                <tr>
                    <th>Tipo de transacción</th>
                    <th>Hora</th>
                    <th>Descripción</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody class="table-light table-bordered">

            </tbody>
        </table>
    </div>

    <!-- Formulario modal Agregar Ingreso al Capital-->
    <div class="modal" id="ventanaAgregarIngresoCapital">
        <div class="modal-dialog">
            <div class="modal-content rounded-5">
                <form id="formAgregarIngresoCapital" action="" class="modal-body needs-validated shadow-lg rounded-5 text-center" novalidate>
                    <h5 class="pt-3">
                        <dt>AGREGAR INGRESO</dt>
                    </h5>
                    <div class="d-flex flex-around cajaDisponibleForm">
                        <h5 class="pt-3">
                            <dt>Disponible:</dt>
                        </h5>
                        <div id="actualCajaForm" class="actualCajaForm"></div>

                    </div>
                    <div class=" mx-3 mt-5">
                        <label for="txt-montoIngresoCapital" class="form-label">Monto:</label>
                        <input type="number" class="form-control py-1 shadow-sm" id="txt-montoIngreso" placeholder="Ingrese el monto a ingresar en el capital" name="desc" required>
                        <div class="valid-feedback">Correcto.</div>
                        <div class="invalid-feedback">Por favor llene este campo.</div>
                    </div>
                    <div class=" mx-3 mt-4">
                        <label for="txt-nombreCapitalIngreso" class="form-label">Capital:</label>
                        <select type="text" class="form-select py-1 shadow-sm  txt-capitalIngreso" id="txt-capitalIngreso" placeholder="Seleccione el Capital destino de ingreso" name="cat" required>
                            <option selected disabled>Seleccione el Capital destino de ingreso</option>

                        </select>
                        <div class="valid-feedback">Correcto.</div>
                        <div class="invalid-feedback">Por favor llene este campo.</div>
                    </div>
                    <div class=" mx-3 mt-4">
                        <label for="txt-FormaPagoIngresoCapital" class="form-label">Forma de pago:</label>
                        <select type="text" class="form-select py-1 shadow-sm" id="txt-formaPagoIngreso" placeholder="Seleccione la Forma de pago del Ingreso" name="cat" required>
                            <option selected disabled>Seleccione La forma de pago del Ingreso</option>
                        </select>
                        <div class="valid-feedback">Correcto.</div>
                        <div class="invalid-feedback">Por favor llene este campo.</div>
                    </div>
                    <button type="submit" class="btn btn-success px-5 mt-5 mb-4 shadow">Agregar</button>
                </form>
            </div>
        </div>
    </div>


    <!-- Formulario modal Editar Ingreso al Capital-->
    <div class="modal" id="ventanaEditarIngresoCapital">
        <div class="modal-dialog">
            <div class="modal-content rounded-5">
                <form id="formEditarIngresoCapital" action="" class="modal-body needs-validated shadow-lg rounded-5 text-center" novalidate>
                    <h5 class="pt-3">
                        <dt>EDITAR INGRESO</dt>
                    </h5>
                    <div class="d-flex flex-around cajaDisponibleForm">
                        <h5 class="pt-3">
                            <dt>Disponible:</dt>
                        </h5>
                        <div id="actualCajaForm" class="actualCajaForm"></div>

                    </div>
                    <div class=" mx-3 mt-5">
                        <label for="txt-editmontoIngreso" class="form-label">Monto:</label>
                        <input type="number" class="form-control py-1 shadow-sm" id="txt-editmontoIngreso" placeholder="Ingrese el monto a ingresar en el capital" name="desc" required>
                        <div class="valid-feedback">Correcto.</div>
                        <div class="invalid-feedback">Por favor llene este campo.</div>
                    </div>
                    <div class=" mx-3 mt-4">
                        <label for="txt-editcapitalIngreso" class="form-label">Capital:</label>
                        <select type="text" class="form-select py-1 shadow-sm" id="txt-editcapitalIngreso" placeholder="Seleccione el Capital destino de ingreso" name="cat" required>

                        </select>
                        <div class="valid-feedback">Correcto.</div>
                        <div class="invalid-feedback">Por favor llene este campo.</div>
                    </div>
                    <div class=" mx-3 mt-4">
                        <label for="txt-editformaPagoIngreso" class="form-label">Forma de pago:</label>
                        <select type="text" class="form-select py-1 shadow-sm" id="txt-editformaPagoIngreso" placeholder="Seleccione la Forma de pago del Ingreso" name="cat" required>
                            <option selected disabled>Seleccione la forma de pago del Ingreso</option>
                        </select>
                        <div class="valid-feedback">Correcto.</div>
                        <div class="invalid-feedback">Por favor llene este campo.</div>
                    </div>
                    <button id="btnEditarIngresoCapital" idingreso="" type="submit" class="btn btn-success px-5 mt-5 mb-4 shadow">Editar</button>
                </form>
            </div>
        </div>
    </div>


    <!-- Formulario modal Agregar Ahorro del Capital-->
    <div class="modal" id="ventanaAgregarAhorroCapital">
        <div class="modal-dialog">
            <div class="modal-content rounded-5">
                <form id="formAgregarAhorroCapital" action="" class="modal-body needs-validated shadow-lg rounded-5 text-center" novalidate>
                    <h5 class="pt-3">
                        <dt>AGREGAR AHORRO</dt>
                    </h5>
                    <div class="d-flex flex-around cajaDisponibleForm">
                        <h5 class="pt-3">
                            <dt>Disponible:</dt>
                        </h5>
                        <div id="actualCajaForm" class="actualCajaForm"></div>

                    </div>
                    <div class=" mx-3 mt-5">
                        <label for="txt-montoAhorro" class="form-label">Monto:</label>
                        <input type="number" class="form-control py-1 shadow-sm" id="txt-montoAhorro" placeholder="Ingrese el monto a ahorrar del capital" name="desc" required>
                        <div class="valid-feedback">Correcto.</div>
                        <div class="invalid-feedback">Por favor llene este campo.</div>
                    </div>
                    <div class=" mx-3 mt-5">
                        <label for="txt-descripcionAhorro" class="form-label">Descripción:</label>
                        <input type="text" class="form-control py-1 shadow-sm" id="txt-descripcionAhorro" placeholder="Ingrese una descripción del ahorro" name="desc" required>
                        <div class="valid-feedback">Correcto.</div>
                        <div class="invalid-feedback">Por favor llene este campo.</div>
                    </div>
                    <div class=" mx-3 mt-4">
                        <label for="txt-capitalAhorro" class="form-label">Capital:</label>
                        <select type="text" class="form-select py-1 shadow-sm" id="txt-capitalAhorro" placeholder="Seleccione el Capital origen del ahorro" name="cat" required>
                            <option selected disabled>Seleccione el Capital origen del ahorro</option>
                            <!-- <option value="1">Salario</option>
                            <option value="2">Cuenta bancaria</option>
                            <option value="3">sueldo</option> -->
                        </select>
                        <div class="valid-feedback">Correcto.</div>
                        <div class="invalid-feedback">Por favor llene este campo.</div>
                    </div>
                    <button type="submit" class="btn btn-success px-5 mt-5 mb-4 shadow">Agregar</button>
                </form>
            </div>
        </div>
    </div>


    <!-- Formulario modal Editar Ahorro del Capital-->
    <div class="modal" id="ventanaEditarAhorroCapital">
        <div class="modal-dialog">
            <div class="modal-content rounded-5">
                <form id="formEditarAhorroCapital" action="" class="modal-body needs-validated shadow-lg rounded-5 text-center" novalidate>
                    <h5 class="pt-3">
                        <dt>EDITAR AHORRO</dt>
                    </h5>
                    <div class="d-flex flex-around cajaDisponibleForm">
                        <h5 class="pt-3">
                            <dt>Disponible:</dt>
                        </h5>
                        <div id="actualCajaForm" class="actualCajaForm"></div>

                    </div>
                    <div class=" mx-3 mt-5">
                        <label for="txt-montoAhorro" class="form-label">Monto:</label>
                        <input type="number" class="form-control py-1 shadow-sm" id="txt-montoAhorro" placeholder="Ingrese el monto a ahorrar del capital" name="desc" required>
                        <div class="valid-feedback">Correcto.</div>
                        <div class="invalid-feedback">Por favor llene este campo.</div>
                    </div>
                    <div class=" mx-3 mt-5">
                        <label for="txt-descripcionAhorro" class="form-label">Descripción:</label>
                        <input type="text" class="form-control py-1 shadow-sm" id="txt-descripcionAhorro" placeholder="Ingrese una descripción del ahorro" name="desc" required>
                        <div class="valid-feedback">Correcto.</div>
                        <div class="invalid-feedback">Por favor llene este campo.</div>
                    </div>
                    <div class=" mx-3 mt-4">
                        <label for="txt-capitalAhorro" class="form-label">Capital:</label>
                        <select type="text" class="form-select py-1 shadow-sm" id="txt-capitalAhorro" placeholder="Seleccione el Capital origen del ahorro" name="cat" required>
                            <option selected disabled>Seleccione el Capital origen del ahorro</option>
                            <!-- <option value="1">Salario</option>
                            <option value="2">Cuenta bancaria</option>
                            <option value="3">sueldo</option> -->
                        </select>
                        <div class="valid-feedback">Correcto.</div>
                        <div class="invalid-feedback">Por favor llene este campo.</div>
                    </div>
                    <button type="submit" class="btn btn-success px-5 mt-5 mb-4 shadow">Agregar</button>
                </form>
            </div>
        </div>
    </div>


    <!-- Formulario modal agregar Gasto del Capital-->
    <div class="modal" id="ventanaAgregarGastoCapital">
        <div class="modal-dialog">
            <div class="modal-content rounded-5">
                <form id="formAgregarGasto" action="" class="modal-body needs-validated shadow-lg rounded-5 text-center" novalidate>
                    <h5 class="pt-3">
                        <dt>AGREGAR GASTO</dt>
                    </h5>
                    <div class="d-flex flex-around cajaDisponibleForm">
                        <h5 class="pt-3">
                            <dt>Disponible:</dt>
                        </h5>
                        <div class="actualCajaForm">$43.800</div>

                    </div>
                    <div class=" mx-3 mt-5">
                        <label for="txt-montoGasto" class="form-label">Monto:</label>
                        <input type="number" class="form-control py-1 shadow-sm" id="txt-montoGasto" placeholder="Ingrese el monto a gastar " name="desc" required>
                        <div class="valid-feedback">Correcto.</div>
                        <div class="invalid-feedback">Por favor llene este campo.</div>
                    </div>
                    <div class=" mx-3 mt-5">
                        <label for="txt-descripcionGasto" class="form-label">Descripción:</label>
                        <input type="text" class="form-control py-1 shadow-sm" id="txt-descripcionGasto" placeholder="Ingrese una descripción del gasto" name="desc" required>
                        <div class="valid-feedback">Correcto.</div>
                        <div class="invalid-feedback">Por favor llene este campo.</div>
                    </div>
                    <div class=" mx-3 mt-4">
                        <label for="txt-presupuesto" class="form-label">presupuesto:</label>
                        <select type="text" class="form-select py-1 shadow-sm" id="slc-presupuesto" placeholder="Seleccione el Capital origen del gasto" name="cat" required>
                            <option selected disabled>Seleccione el presupuesto de origen del gasto</option>
                        </select>
                        <div class="valid-feedback">Correcto.</div>
                        <div class="invalid-feedback">Por favor llene este campo.</div>
                    </div>
                    <div class=" mx-3 mt-4">
                        <label for="txt-FormaPagoIngresoCapital" class="form-label">Forma de pago:</label>
                        <select type="text" class="form-select py-1 shadow-sm" id="slc-formaPago" placeholder="Seleccione la Forma de pago del Ingreso" name="cat" required>
                            <option selected disabled>Seleccione La forma de pago del Ingreso</option>
                        </select>
                        <div class="valid-feedback">Correcto.</div>
                        <div class="invalid-feedback">Por favor llene este campo.</div>
                    </div>
                    <button type="submit" class="btn btn-success px-5 mt-5 mb-4 shadow">Agregar</button>
                </form>
            </div>
        </div>
    </div>




</body>