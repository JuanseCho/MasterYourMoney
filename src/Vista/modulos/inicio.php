<h1>Inicio</h1>
<div class="row">
    <div class="col-6">
        <h1>PANEL <br>DE <br>CONTROL</h1>
    </div>

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


</div>