<!--Formulario de capital_has_presupuesto-->
<div class="col-md-6 col-lg-5 col-sm-12 jsDiv form-emerge" id="ventana_del_formulario_Capital_Has_Presupuesto" style="display: none;">
    <button class="cssbuttons-io-button" id="cerrar-ventanaCP">
        <i class="bi bi-x-lg"></i>
    </button>
    <h3 class="titulos">Asignar capital al presupuesto</h3>
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
        </div>


        <button class="btn" id="Btn_new_Capital_presupuesto" type="submit" idPresupuestoF="">Agregar</button>
    </form>

</div>