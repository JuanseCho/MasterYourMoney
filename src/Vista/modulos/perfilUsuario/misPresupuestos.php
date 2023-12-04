<div class="container p-2 jsContainer" id="presupuestos">
    <div>
        <div class="row mt- mb-4 p-4">
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
                        <button class="button1" id="Btn_Presupuestos" data-bs-toggle="modal" data-bs-target="#AgregarPresupuesto">
                            <span>
                                Inicializar presupuesto
                            </span>
                        </button>

                    </div>


                </div>
            </div>
        </div>

     
        <div class="row jsDivR p-4 ">
           

            <div class="col-md-12 col-sm-12 col-lg-12  jsDiv">

                <table class="table table-striped nowrap dataTables_scrollBody " style="width: 100%;" id="Tabla_De_Presupuestos">
                    <thead>
                        <tr>

                            <th> Descripcion </th>
                            <th>monto inicial</th>
                            <th>Monto actual</th>
                            <th>capitales de consumo</th>
                            <th>acciones <i class="bi bi-credit-card-2-front"></i></th>
                        </tr>
                    </thead>
                    <tbody>

                </table>
            </div>

        </div>
    </div>
</div>

<!--Formulario en modal para ingresar  Presupuestos -->
<div class="modal" id="AgregarPresupuesto">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
      <h3 class="titulos">Agregar presupuesto</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        
      <form id="form_Agregar_Presupuesto">
        <div>
            <label for="txt_NombrePresupuesto" class="form-label">Descripcion del presupuesto</label>
           <input type="text" class="form-control" name="txt_NombrePresupuesto" id="txt_NombrePresupuesto" placeholder="nombre descriptivo " maxlength="50" required>
            <div class="valid-feedback">Correcto</div>
            <div class="invalid-feedback">Por favor, ingresa un nombre válido</div>

        </div>
        <div hidden>
            <label for="txt_Presupuesto" class="form-label">Valor presupuestal</label>
            <input type="number" class="form-control" name="txt_Presupuesto" id="txt_Presupuesto" min="0" value="0" disabled required>
            <div class="valid-feedback">Correcto</div>
            <div class="invalid-feedback">Por favor, ingresa un valor presupuestal válido</div>
        </div>

        <button class="btn" id="Btn_new_presupuesto">Agregar</button>
    </form>

      </div>

    </div>
  </div>
</div>


<!-- The Modal para Editar presupuesto-->
<div class="modal modal-lg " id="ventana_del_formulario_Presupuesto_Edit">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="titulos">Editar presupuesto</h3>
            </div>
            <div class="modal-body">
                <form id="form_Editar_Presupuesto">

                    <div id="contenedor">
                        <div id="elemento1" style="display: inline-block; width: 70%;">
                            <label for="" class="form-label">Descripcion de Presupuesto</label>
                            <input type="text" class="form-control" name="" id="txt_edit_Presupuesto" placeholder="nueva Descripcion " >

                        </div>
                        <div id="elemento2" style="display: inline-block; width: 17%; margin-left: 2 vh;">
                            <button class="btn" id="btn_Edit_Presupuesto_f" idpresupuestoF="">Editar</button>
                        </div>
                    </div>


                </form>


                <hr size="5" color="#455181">

                <div class=" col-md-12" style="background-color: rgba(226, 225, 220, 0.397);">
                    <table id="tabla_capitalesDePresupuesto" class="table table-striped nowrap dataTables_scrollBody " style="width: 100%;">
                        <thead>
                            <tr>

                                <th>fecha</th>
                                <th> capitales </th>
                                <th>valor asignado</th>
                                <th>
                                    acciones <i class="bi bi-credit-card-2-front"></i>
                                </th>
                            </tr>
                        </thead>


                    </table>
                </div>
            </div>



        </div>
    </div>
</div>

<!-- Button to Open the Modal -->
<button class="btn" id="btnPresupuestos"  disabled style="display: none;">recarga</button>

<!-- The Modal -->
<div class="modal" id="ventana_del_formulario_Capital_Has_Presupuesto">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="titulos">Asignar capital al presupuesto</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="form_Agregar_Capital_Has_Presupuesto">
                    <div id="txt_presupuesto" idPresupuesto="" style="text-align: center; font-size: x-large;">


                    </div>


                    <div>

                        <label for="select_tipoCapital" class="form-label">capitales</label>
                        <select class="form-select" name="select_tipoCapital" id="select_tipoCapital" required>

                        </select>
                        <div class="valid-feedback">Correcto</div>
                        <div class="invalid-feedback">Por favor, selecciona un tipo de presupuesto</div>
                    </div>
                    <div>
                        <label for="txt_valorAsignado" class="form-label">Valor Asignado </label>
                        <input type="number" class="form-control" name="txt_valorAsignado" id="txt_valorAsignado" placeholder="$500000" required>
                        <div class="valid-feedback">Correcto</div>
                    </div>


                    <button class="btn" id="Btn_new_Capital_presupuesto" type="submit" idPresupuestoF="">Agregar</button>
                </form>
            </div>

        </div>
    </div>
</div>
