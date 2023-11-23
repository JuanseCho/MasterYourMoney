<div class="container p-2 jsContainer">
    <div>
        <div class="row mt-4 mb-4 p-4">
            <div class="col-md-12">
                <div class="titulo_categoria">
                    <h2>
                        <p style="font-size: 2rem;">
                            <span style="color: blue; font-size: 2rem;">
                                Metas de
                            </span>
                            Ahorro
                        </p>
                    </h2>
                    <button style="flex-grow: 0;" class="button1" data-bs-toggle="modal" data-bs-target="#modalFormCapital">
                        <span>
                            Agregar al capital
                        </span>
                    </button>
                    <!--Formulario pa ingresar la nuevo Capital -->

                    <!-- The Modal -->
                    <div class="modal " id="modalFormCapital">
                        <div class="modal-dialog ">
                            <div class="modal-content ">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h3 class="titulos">Agregar capital</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">

                                    <form id="form_Agregar_Capital">
                                        <div>
                                            <label class="form-label">Monto</label>
                                            <input type="number" class="form-control" id="txt_monto" required>

                                        </div>
                                        <div>
                                            <label class="form-label">Descripcion</label>
                                            <input type="text" class="form-control" id="txt_descripcion" required>

                                        </div>
                                        <div>
                                            <label class="form-label">Forma de pago</label>
                                            <section>
                                                <select class="form-select" id="txt_formaD_Pago" required>
                                                    <option selected>seleccione el tipo de pago </option>
                                                    <option value="1">efectivo</option>
                                                    <option value="2">tarjeta</option>
                                                    <option value="3">cheque</option>
                                                </select>
                                            </section>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary" type="submit">Agregar</button>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <hr size="5" color="#000000">
        <div class="row jsDivR p-4 ">
            <div class=" col-md-1 sm-1 user-profile">
                <img class="col-md-2 user-profile-avatar" src="src\Vista\img\lic.jpg" />
                <i>Sebastian</i>
            </div>

            <div class="col-md-7 sm-5 jsDiv">
                <h3 class="titulos">Ahorros</h3>
                <table id="tablaahorros">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Descripcion</th>
                            <th>Monto</th>

                        </tr>
                    </thead>
                </table>
            </div>


        </div>
    </div>
</div>