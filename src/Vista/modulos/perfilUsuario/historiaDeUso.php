<!--modulo del hidtorial de uso donde se podra descargar un informe ya sea de ese dia de esa semana  o de ese mes-->
<div class="container p-2 jsContainer">
    <div>
        <div class="row mt-4 mb-4 p-4">
            <div class="col-md-12">
                <div class="titulo_categoria">
                    <h2>
                        <p style="font-size: 3rem;">
                            <span style="color: blue;">
                                Historial
                            </span>
                            De uso
                        </p>
                    </h2>
                    <button class="button1" id="editSelectedButton">
                        <span>
                            Generar reporte
                        </span>

                    </button>
                </div>
            </div>
        </div>
        <hr size="5" color="#000000">
        <div class="row jsDivR p-4 ">
            <div class=" col-md-12 col-lg-12 sm-1 user-profile">
                <img class="col-md-2 user-profile-avatar" src="src\Vista\img\2.jpeg" />
                <i>Sebastian</i>
            </div>

            <div class="col-md-10 col-sm-12 col-lg-10  jsDiv">
                <button class="btn" id="editBtn" style="display:block ;">Editar</button>
                <table id="tabla_historialDeUso" class="table table-striped nowrap dataTables_scrollBody " style="width: 100%;">
                    <thead>
                        <tr>
                            <th> 
                                fecha
                            </th>
                            <th>5
                                monto
                            </th>
                            <th>
                                categoria
                            </th>
                     
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td >12/1rggcccccccccccccccccccccccccccccchhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhvhgjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj2/2020</td>
                            <td>1000</td>
                            <td>alimentacion</td>
                        </tr>
                        <tr>
                            <td>12/12/2020</td>
                            <td>2000</td>
                            <td>transporte</td>
                        </tr>
                        <tr>
                            <td>12/12/2020</td>
                            <td>1000</td>
                            <td>alimentacion</td>
                        </tr>
                        <tr>
                            <td>12/12/2020</td>
                            <td>2000</td>
                            <td>transporte</td>
                        </tr>
                        <tr>
                            <td>12/12/2020</td>
                            <td>1000</td>
                            <td>alimentacion</td>
                        </tr>
                        <tr>
                            <td>12/12/2020</td>
                            <td>2000</td>
                            <td>transporte</td>
                        </tr>
                        <tr>
                            <td>12/12/2020</td>
                            <td>1000</td>
                            <td>alimentacion</td>
                        </tr>
                        <tr>
                            <td>12/12/2020</td>
                            <td>2000</td>
                            <td>transporte</td>
                        </tr>
                        <tr>
                            <td>12/12/2020</td>
                            <td>1000</td>
                            <td>alimentacion</td>
                        </tr>
                        <tr>
                            <td>12/12/2020</td>
                            <td>2000</td>
                            <td>transporte</td>
                        </tr>
                        <tr>
                            <td>12/12/2020</td>
                            <td>1000</td>
                            <td>alimentacion</td>
                        </tr>
                        <tr>
                            <td>12/12/2020</td>
                            <td>2000</td>
                            <td>transporte</td>
                        </tr>
                    </tbody>
             
                </table>
            </div>


        </div>
    </div>
</div>

<div class="col-md-2 jsDiv">
    <form>
    <input type="radio" id="dia" name="tiempo" value="dia">
    <label for="dia">Día</label><br>
    <input type="radio" id="semana" name="tiempo" value="semana">
    <label for="semana">Semana</label><br>
    <input type="radio" id="mes" name="tiempo" value="mes">
    <label for="mes">Mes</label><br>
</form>
<button class="btn">Guardar</button>
</div>
