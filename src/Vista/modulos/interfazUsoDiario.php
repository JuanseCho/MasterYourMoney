
<body class="bodyInterfaz mt-5" >
    <div class="containerInterfaz mt-5 row">
        <div class="container1Interfaz">
            <div class="containerFecha">
                <div id="barraFecha" class="barraFecha shadow shadow-lg"></div>
                <div id="nombreDia" class="nombreDia"></div>
            </div>
            <div class="containerCaja d-flex flex-column  shadow shadow-lg">
                    <div class="containerCaja1 d-flex flex-row"> 
                        <button class="botonAhorro shadow shadow-md border" id="btn-agregarAhorroCapital" type="button" data-bs-toggle="modal" data-bs-target="#ventanaAgregarAhorroCapital"><img src="src/Vista/img/ahorroBoton.png" alt="" style="width:28px;" class="mx-4"></button>
                        <div class="cashflow1 me-5 mt-3">
                            <div class="d-flex flex-row">
                                <div id="ahorroCaja" class="ahorroCaja me-3"></div> 
                                <div id="inicioCaja" class="inicioCaja"></div> 
                            </div>
                            <div id="gastoCaja" class="gastoCaja"></div>
                            <div id="ingresoCaja" class="ingresoCaja"></div>
                        </div>
                    </div>
                    <div class="containerCaja2 d-flex flex-row">
                        <div class="d-flex flex-row btn-groupTransacciones">
                            <button class="botonIngreso border shadow shadow-md" id="btn-agregarIngresoCapital" type="button" data-bs-toggle="modal" data-bs-target="#ventanaAgregarIngresoCapital"><img src="src/Vista/img/ingresoBoton.png" alt="" style="width:20px;" class="mx-4"></button>
                            <button class="botonGasto border shadow shadow-md" id="btn-agregarGastoCapital" type="button" data-bs-toggle="modal" data-bs-target="#ventanaAgregarGastoCapital"><img src="src/Vista/img/gastoBoton.png" alt="" style="width:20px;" class="mx-4"></button>
                        </div>                        
                        <div id="totalCapital" class="hidden"></div>    
                        <div id="totalPresupuesto" class="hidden"></div>    
                        <div id="actualCaja" class="actualCaja"></div>    
                    </div>

            </div>
            <div class="containerListadoTransacciones table-responsive shadow shadow-lg">
            <table id="tablaTransaccionesCapital" class="">
                    <thead class="thead-tablaTransacciones">
                        <tr>
                            <!-- <th class="col-num   text-center">#</th> -->
                            <th class="col-tipo text-center"></th>
                            <th class="col-hora text-center"></th>
                            <th class="col-descripcion text-end"></th>
                            <th class="col-monto text-end pe-4"></th>
                            <th class="col-acciones text-center"></th>
                        </tr>
                    </thead>
                    <tbody class="">

                    </tbody>
                </table>
            </div>
        </div>
        <div class="container2Interfaz">
            <!-- <div class="col-lg-11 col-lg-8 sm-12 m-5 jsDiv"> -->
                
            <div id="mychart-holder" class="col-6" style="display: flex; justify-content: center; align-items: center;">
                <div class="row">
                    <select id="selectChart">
                        <option value="general">General</option>
                        <option value="gastos">Gastos</option>
                        <option value="ahorros">Ahorros</option>
                        <option value="ingresos">Ingresos</option>
                    </select>
                </div>
                <div class="row">
                    <canvas id="myChart" style="width:100%; max-height: 300px"></canvas>
                </div>
            </div>

                <!-- <table id="tabla_CapitalInterfaz" class="table table-striped nowrap dataTables_scrollBody " style="width: 100%;">
                    <thead class="thead-tablaTransacciones"><h3 class="titulos">CAPITALES </h3>
                        <tr>
                            <th>fecha</th>
                            <th>monto</th>
                            <th>Descripcion</th>
                        </tr>
                    </thead>
                </table>
                
                <table id="tablaAhorros" class="table nowrap table-striped">
                    <thead><h3 class="titulos">AHORROS</h3>
                        <tr>
                            <th scope="col">Fecha</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Monto inicial</th>
                            <th scope="col">Monto actual</th>
                        </tr>
                    </thead>
                </table>
                
                <table id="Tabla_De_PresupuestosInterfaz" class="table nowrap table-striped">
                    <thead><h3 class="titulos">PRESUPUESTOS</h3>
                        <tr>
                            <th scope="col">Descripción</th>
                            <th scope="col">Valor Asignado</th>
                            <th scope="col">Monto actual</th>
                        </tr>
                    </thead>
                </table> -->
                


            <!-- </div> -->
        </div>
    </div>
    
    <div class="containerListadoTransacciones">
        <table id="tablaGastosCapital" class="table table-striped table-bordered shadow-lg">
                <thead class="table-dark shadow-lg">
                    <tr>
                        <th>Tipo de transacción</th>
                        <th>Hora</th>
                        <th></th>
                        <th></th>
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
                      <h5 class="pt-3"><dt>AGREGAR INGRESO</dt></h5>
                      <div class="d-flex flex-around cajaDisponibleForm">
                        <h5 class="pt-3"><dt>Disponible:</dt></h5>
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
                          <select type="text" class="form-select py-1 shadow-sm" id="txt-capitalIngreso" placeholder="Seleccione el Capital destino de ingreso" name="cat" required>
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
    <!-- <div class="modal" id="ventanaEditarIngresoCapital">
            <div class="modal-dialog">
                <div class="modal-content rounded-5">
                    <form id="formEditarIngresoCapital" action="" class="modal-body needs-validated shadow-lg rounded-5 text-center" novalidate>
                      <h5 class="pt-3"><dt>EDITAR INGRESO</dt></h5>
                      <div class="d-flex flex-around cajaDisponibleForm">
                        <h5 class="pt-3"><dt>Disponible:</dt></h5>
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
    </div> -->


    <!-- Formulario modal Agregar Ahorro del Capital-->
    <div class="modal" id="ventanaAgregarAhorroCapital">
            <div class="modal-dialog">
                <div class="modal-content rounded-5">
                    <form id="formAgregarAhorroCapital" action="" class="modal-body needs-validated shadow-lg rounded-5 text-center" novalidate>
                      <h5 class="pt-3"><dt>AGREGAR AHORRO</dt></h5> 
                      <div class="d-flex flex-around cajaDisponibleForm">
                        <h5 class="pt-3"><dt>Disponible:</dt></h5>
                        <div id="actualCajaForm" class="actualCajaForm"></div>   

                      </div>
                      <div class=" mx-3 mt-5">
                          <label for="txt-montoRegAhorro" class="form-label">Monto:</label>
                          <input type="number" class="form-control py-1 shadow-sm" id="txt-montoRegAhorro" placeholder="Ingrese el monto a ahorrar del capital" name="desc" required>
                          <div class="valid-feedback">Correcto.</div>
                          <div class="invalid-feedback">Por favor llene este campo.</div>
                      </div>
                      <div class=" mx-3 mt-5">
                          <label for="txt-descripcionRegAhorro" class="form-label">Ahorro:</label>
                          <select type="text" class="form-select py-1 shadow-sm" id="txt-ahorroRegAhorro" placeholder="Seleccione el Ahorro de destino" name="cat" required>
                          <option selected disabled>Seleccione el Ahorro de destino</option>
                            
                            </select>
                          <div class="valid-feedback">Correcto.</div>
                          <div class="invalid-feedback">Por favor llene este campo.</div>
                      </div>
                      <div class=" mx-3 mt-4">
                          <label for="txt-capitalRegAhorro" class="form-label">Capital:</label>
                          <select type="text" class="form-select py-1 shadow-sm" id="txt-capitalRegAhorro" placeholder="Seleccione el Capital origen del ahorro" name="cat" required>
                          <option selected disabled>Seleccione el Capital origen del ahorro</option>
                            
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
    <!-- <div class="modal" id="ventanaEditarRegAhorroCapital">
            <div class="modal-dialog">
                <div class="modal-content rounded-5">
                    <form id="formEditarRegAhorroCapital" action="" class="modal-body needs-validated shadow-lg rounded-5 text-center" novalidate>
                      <h5 class="pt-3"><dt>EDITAR AHORRO</dt></h5> 
                      <div class="d-flex flex-around cajaDisponibleForm">
                        <h5 class="pt-3"><dt>Disponible:</dt></h5>
                        <div id="actualCajaForm" class="actualCajaForm"></div>   

                      </div>
                      <div class=" mx-3 mt-5">
                          <label for="txt-editmontoRegAhorro" class="form-label">Monto:</label>
                          <input type="number" class="form-control py-1 shadow-sm" id="txt-editmontoRegAhorro" placeholder="Ingrese el monto a ahorrar del capital" name="desc" required>
                          <div class="valid-feedback">Correcto.</div>
                          <div class="invalid-feedback">Por favor llene este campo.</div>
                      </div>
                      <div class=" mx-3 mt-5">
                          <label for="txt-editahorroRegAhorro" class="form-label">Ahorro:</label>
                          <select type="text" class="form-select py-1 shadow-sm" id="txt-editahorroRegAhorro" placeholder="Seleccione el Ahorro de destino" name="cat" required>
                          <option selected disabled>Seleccione el Ahorro de destino</option>
                            
                            </select>
                          <div class="valid-feedback">Correcto.</div>
                          <div class="invalid-feedback">Por favor llene este campo.</div>
                      </div>
                      <div class=" mx-3 mt-4">
                          <label for="txt-editcapitalRegAhorro" class="form-label">Capital:</label>
                          <select type="text" class="form-select py-1 shadow-sm" id="txt-editcapitalRegAhorro" placeholder="Seleccione el Capital origen del ahorro" name="cat" required>
                          <option selected disabled>Seleccione el Capital origen del ahorro</option>
                            
                            </select>
                          <div class="valid-feedback">Correcto.</div>
                          <div class="invalid-feedback">Por favor llene este campo.</div>
                      </div>
                      <button id="btnEditarRegAhorroCapital" idregahorro="" type="submit" class="btn btn-success px-5 mt-5 mb-4 shadow">Agregar</button>
                    </form>                  
                </div>
            </div>
    </div> -->


    <!-- Formulario modal agregar Gasto del Capital-->

    <div class="modal" id="ventanaAgregarGastoCapital">
            <div class="modal-dialog">
                <div class="modal-content rounded-5">
                    <form id="formAgregarGasto" action="" class="modal-body needs-validated shadow-lg rounded-5 text-center" novalidate>
                      <h5 class="pt-3"><dt>AGREGAR GASTO</dt></h5> 
                      <div class="d-flex flex-around cajaDisponibleForm">
                        <h5 class="pt-3"><dt>Disponible:</dt></h5>
                        <div class="actualCajaForm">$43.800</div>   

                      </div>
                      <div class=" mx-3 mt-5">
                          <label for="txt-montoGasto" class="form-label">Monto:</label>
                          <input type="number" class="form-control py-1 shadow-sm" id="txt-montoGasto" placeholder="Ingrese el monto a gastar del capital" name="desc" required>
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
                          <label for="slc-presupuesto" class="form-label">Presupuesto:</label>
                          <select type="text" class="form-select py-1 shadow-sm" id="slc-presupuesto" placeholder="Seleccione el presupuesto para el gasto" name="cat" required>
                          <option selected disabled>Seleccione el presupuesto para el gasto</option>

                            </select>
                          <div class="valid-feedback">Correcto.</div>
                          <div class="invalid-feedback">Por favor llene este campo.</div>
                      </div>
                      <div class=" mx-3 mt-4">
                          <label for="slc-formaPago" class="form-label">forma de pago:</label>
                          <select type="text" class="form-select py-1 shadow-sm" id="slc-formaPago" placeholder="Seleccione el Capital origen del gasto" name="cat" required>
                          <option selected disabled>Seleccione la forma de pago del gasto</option>

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





        