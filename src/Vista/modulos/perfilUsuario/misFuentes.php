<div class="container p-2 jsContainer">
    <div>
        <div class="row mt-4 mb-4 p-4">
            <div class="col-md-12">
                <div class="titulo_categoria">
                    <h2>
                        <p style="font-size: 3rem;">
                            <span style="color: blue;">
                                Mis
                            </span>
                            Fuentes
                        </p>
                    </h2>
                    <button class="button1">
                        <span>
                          Agregar fuente  
                        </span>
                        
                    </button>
                </div>
            </div>
        </div>
        <hr size="5" color="#000000">
        <div class="row jsDivR p-4 ">
            <div class=" col-md-12 col-lg-1 sm-1 user-profile">
                <img class="col-md-2 user-profile-avatar" src="src\Vista\img\2.jpeg" />
                <i>Sebastian</i>
            </div>

            <div class="col-md-5 col-lg-5 sm-5 jsDiv">
                <h3 class="titulos">ahorros</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Monto Actual</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr >
                            <td>ahorros</td>
                            <td>1000</td>
                        </tr>
                        <tr>
                            <td>ahorros</td>

                            <td>2000</td>

                        </tr>

                    
                    </tbody>
                </table>
            </div>
            <div class="col-md-5 col-lg-5 sm-5  jsDiv">
                <h3 class="titulos">Ingresos</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Monto último ingreso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>negocio familiar</td>
                            <td>1000</td>
                        </tr>
                        <tr>
                            <td>negocio familiar</td>

                            <td>2000</td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!--Formulario pa ingresar efectivo a la caja y asi poder utilizarla como otra fuente-->

<div class="col-md-4 col-sm-8 jsDiv form-emerg" >
    <h3 class="titulos">Agregar efectivo a la caja</h3>
    <form>
        <div class="mb-3">
            <label for="" class="form-label">Efectivo</label>
            <input type="number" class="form-control" name="" id="" placeholder="$50.0000">

        </div>
        <button class="btn">Guardar</button>
    </form>
</div>


<!--Formulario pa ingresar la nueva fuente -->


<div class="col-md-4 col-sm-8 jsDiv form-emerg">
    <h3 class="titulos">Agregar fuente</h3>
    <form>
        <div class="mb-3">
            <label for="" class="form-label">nombre</label>
            <input type="text" class="form-control" name="" id="" placeholder="negocio familiar">
        </div>
        <div>
            <label for="" class="form-label">tipo de fuente</label>
            <select class="form-select" name="" id="">
                <option selected></option>
                <option value="">ahorros</option>
                <option value="">ingresos</option>
            </select>
        </div>
        
        <div>
            <label for="" class="form-label">monto inicial</label>
            <input type="number" class="form-control" name="" id="" placeholder="$50.0000">
        </div>
        <button class="btn" >Guardar</button>
    </form>
</div>