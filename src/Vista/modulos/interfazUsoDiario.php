
<body class="bodyInterfaz">
    <div class="containerInterfaz">
        <div class="container1Interfaz">
            <div class="containerFecha">
                <div class="barraFecha"></div>
                <div class="nombreDia"></div>
            </div>
            <div class="containerCaja d-flex flex-column">
                    <div class="containerCaja1 d-flex flex-row">
                        <button class="botonAhorro"><a href="#myModal" data-toggle="modal"><img src="src/Vista/img/ahorroBoton.png" alt="" style="width:28px;" class="mx-4"></a></button>
                        <div class="cashflow1 me-5 mt-3">
                            <div class="inicioCaja">$50.000</div>    
                            <div class="gastoCaja">-$6.200</div>
                        </div>
                    </div>
                    <div class="containerCaja2 d-flex flex-row">
                        <div class="d-flex flex-row">
                            <button class="botonIngreso" id="btn-agregarIngresoCapital" type="button" data-bs-toggle="modal" data-bs-target="#ventanaAgregarIngresoCapital"><img src="src/Vista/img/ingresoBoton.png" alt="" style="width:20px;" class="mx-4"></button>
                            <button class="botonGasto"><a href="#myModal" data-toggle="modal"><img src="src/Vista/img/gastoBoton.png" alt="" style="width:20px;" class="mx-4"></a></button>
                        </div>                        
                        <div class="actualCaja">$43.800</div>    
                    </div>

            </div>
            <div class="containerListadoTransacciones">
                <table>
                    <tr>
                        <td class="tipoTransaccion">Tipo transacción</td>
                        <td class="descripcionTransaccion">Descripción</td>
                        <td class="valorTransaccion">Valor</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="container2Interfaz"></div>
    </div>
    

    <!-- Formulario modal agregar Ingreso al Capital-->
    <div class="modal" id="ventanaAgregarIngresoCapital">
            <div class="modal-dialog">
                <div class="modal-content rounded-5">
                    <form id="formAgregarIngresoCapital" action="" class="modal-body needs-validated shadow-lg rounded-5 text-center" novalidate>
                      <h5 class="pt-3"><dt>AGREGAR INGRESO</dt></h5>
                      <div class="d-flex flex-around cajaDisponibleForm">
                        <h5 class="pt-3"><dt>Disponible:</dt></h5>
                        <div class="actualCajaForm">$43.800</div>   

                      </div>
                      <div class=" mx-3 mt-5">
                          <label for="txt-montoIngresoCapital" class="form-label">Monto:</label>
                          <input type="number" class="form-control py-1 shadow-sm" id="txt-montoIngreso" placeholder="Ingrese el monto a ingresar en el capital" name="desc" required>
                          <div class="valid-feedback">Correcto.</div>
                          <div class="invalid-feedback">Por favor llene este campo.</div>
                      </div>
                      <div class=" mx-3 mt-4">
                          <label for="txt-nombreCapitalIngreso" class="form-label">Capital:</label>
                          <select type="text" class="form-select py-1 shadow-sm" id="txt-capitalIngreso" placeholder="Seleccione el Capital destino de ingreso" name="cat" required>
                          <option selected disabled>Seleccione el Capital destino de ingreso</option>
                            <option value="1">Salario</option>
                            <option value="2">Cuenta bancaria</option>
                            <option value="3">sueldo</option>
                            </select>
                          <div class="valid-feedback">Correcto.</div>
                          <div class="invalid-feedback">Por favor llene este campo.</div>
                      </div>
                      <div class=" mx-3 mt-4">
                          <label for="txt-FormaPagoIngresoCapital" class="form-label">Forma de pago:</label>
                          <select type="text" class="form-select py-1 shadow-sm" id="txt-formaPagoIngreso" placeholder="Seleccione la Forma de pago del Ingreso" name="cat" required>
                            <option value="1">Efectivo</option>
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