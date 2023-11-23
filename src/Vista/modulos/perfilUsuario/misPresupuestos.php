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
                        <button class="button1" id="Btn_Presupuestos">
                            <span>
                                Agregar presupuesto
                            </span>
                        </button>
                        <button class="button1" id="Btn_T-Presupuesto">
                            <span>tipo Presupuestos</span>
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

<!--Formulario para ingresar nuevos presupuestos-->

<div class="col-md-6 col-lg-4 col-sm-10 jsDiv form-emerge" id="ventana_del_formulario_Presupuestos" style="display: none; background-image: url(src/Vista/img/pexels.jpg);min-height: 30vh;
  background-color: black;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
  max-height: 40vh;">
    <button class="cssbuttons-io-button" id="cerrar-ventana">
        <i class="bi bi-x-lg"></i>
    </button>
    <h3 class="titulos">Agregar presupuesto</h3>
    <form id="form_Agregar_Presupuesto">
        <div>
            <label for="select_tipoPresupuesto" class="form-label">Tipo de presupuesto</label>
            <select class="form-select" name="select_tipoPresupuesto" id="select_tipoPresupuesto" required>
                <!-- Opciones del tipo de presupuesto -->
            </select>
            <div class="valid-feedback">Correcto</div>
            <div class="invalid-feedback">Por favor, selecciona un tipo de presupuesto</div>
        </div>
        <div hidden>
            <label for="txt_Presupuesto" class="form-label">Valor presupuestal</label>
            <input type="number" class="form-control" name="txt_Presupuesto" id="txt_Presupuesto" value="0" disabled required>
            <div class="valid-feedback">Correcto</div>
            <div class="invalid-feedback">Por favor, ingresa un valor presupuestal válido</div>
        </div>

        <button class="btn" id="Btn_new_presupuesto">Agregar</button>
    </form>

</div>



<!--Formulario pa ingresar nuevos tipos de Presupuestos-->

<div class="col-md-6 col-lg-4 col-sm-8 jsDiv form-emerge" id="ventana_del_formulario_TG" style="padding: 2vh; display: none">
    <button class="cssbuttons-io-button">
        <i class="bi bi-x-lg"></i>
    </button>

    <h3 class="titulos">tipos de presupuesto</h3>

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <form id="form_Agregar_tipoDePresupuesto" class="needs-validation">
                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <label for="" class="form-label">nombre</label>
                        <input type="text" class="form-control" name="" id="txt_NombreTipoPresupuesto" placeholder="nombre describe " maxlength="50" required>


                        <div class="valid-feedback">correcto</div>
                        <div class="invalid-feedback">error rellena el campo</div>
                    </div>

                    <button class="btn col-md-3 col-sm-12">Agregar <i class="bi bi-plus-circle"></i></button>
                </div>


            </form>
        </div>

        <hr size="5" color="#455181">

        <div class=" col-md-12" style="background-color: rgba(226, 225, 220, 0.397);">
            <table id="tabla_tipoDePresupuesto" class="table table-striped nowrap dataTables_scrollBody" style="width: 100%;">
                <thead>
                    <tr>
                        <th> Presupuestos </th>
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

<!--Formulario para Editar tipos de Presupuestos-->

<div class="col-md-3 jsDiv form-emerge" id="ventana_del_formulario_TG_Edit" style="padding: 2vh; display: none;">
    <button class="cssbuttons-io-button">
        <i class="bi bi-x-lg"></i>
    </button>
    <h3 class="titulos">tipos de Presupuestos</h3>
    <div class="row">
        <div class="col-md-12 col-sm-10">
            <form id="form_Editar_tipoDePresupuesto" class="needs-validation">
                <div>
                    <label for="" class="form-label">nombre</label>
                    <input type="text" class="form-control" name="" id="txt_edit_NombreTipoPresupuesto" placeholder="nombre descriptivo " maxlength="50" required>


                    <div class="valid-feedback">correcto</div>
                    <div class="invalid-feedback">error rellena el campo</div>

                </div>

                <button class="btn" id="btn_Edit_tipo_Presupuesto_f" idTipoPresupuestof="">Editar <i class="bi bi-plus-circle"></i></button>

                <button class="btn" id="btn_Cancelar_edit_tipo_Presupuesto">Cancelar <i class="bi bi-plus-circle"></i></button>

            </form>

        </div>
    </div>

</div>

<!--Formulario para Editar presupuesto-->

<!-- The Modal -->
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
                            <select class="form-select" name="" id="select_edit_tipoPresupuesto">
                            </select>
                        </div>
                        <div id="elemento2" style="display: inline-block; width: 17%; margin-left: 2 vh;">
                            <button class="btn" id="btn_Edit_Presupuesto_f" idPresupuestoF="">Editar</button>
                        </div>
                    </div>



                    <div>
                        <label for="" class="form-label">
                            suma de capitales
                        </label>
                        <input type="number" class="form-control" name="" id="txt_edit_Presupuesto" placeholder="$50.0000" disabled>
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