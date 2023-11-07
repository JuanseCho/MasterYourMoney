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
                    <button id="ahorrosbtn" class="button1">
                        <span>MIS FUENTES</span>
                    </button>
                    <!-- Agrega esto después del botón "MIS FUENTES" -->
                    <div id="" style="display: none;">
                        <form id="formAhorros">
                            <label for="fecha">Fecha:</label><br>
                            <input type="date" id="fecha" name="fecha"><br>
                            <label for="descripcion">Descripcion:</label><br>
                            <input type="text" id="descripcion" name="descripcion"><br>
                            <label for="monto">Monto:</label><br>
                            <input type="number" id="monto" name="monto"><br>
                            <button type="button" id="registrar">Registrar</button>
                        </form>
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