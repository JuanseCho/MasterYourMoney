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
                            Formas de pago
                        </p>
                    </h2>
                    <button class="btn">
                        Agregar Forma de pago
                    </button>
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
                <button id="editBtn" style="display: none;">Editar</button>
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr onclick="myFunction(event)">
                            <td>Nequi</td>
                        </tr>
                        <tr>
                            <td>Efectivo</td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <script>
                function myFunction(e) {
                    document.getElementById('editBtn').style.display = 'block';
                }
            </script>
        </div>
    </div>
</div>

<!--Formulario para ingresar nuevas formas de pago-->

<div class="col-md-6 col-lg-4 col-sm-10 jsDiv form-emerg" id="ventana_del_formulario_Presupuestos" style="">
<button class="cssbuttons-io-button" id="cerrar-ventana">
        <i class="bi bi-x-lg"></i>
    </button>
    <h3 class="titulos">Agregar Forma de pago</h3>
    <form id="form_Agregar_Presupuesto">
        <div>
            <label for="" class="form-label">Nombre</label>
            <select class="form-select" name="" id="select_tipoGasto" required>
            </select>
            <div class="valid-feedback">correcto</div>
            <div class="invalid-feedback">error rellena el campo</div>
        </div>
        <button class="btn" id="Btn_new_presupuesto">Agregar</button>
    </form>
</div>

<!--Formulario para Editar formas de pago-->

<div class="col-md-3 jsDiv form-emerg" id="ventana_del_formulario_TG_Edit" style="padding: 2vh; display: non">
<button class="cssbuttons-io-button">
        <i class="bi bi-x-lg"></i>
    </button>
    <h3 class="titulos">Editar Forma de pago</h3>
    <div class="row">
        <div class="col-md-12 col-sm-10">
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

</div>