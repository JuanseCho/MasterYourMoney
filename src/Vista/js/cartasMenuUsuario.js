class cartasMenuUsuario {

    constructor(objData) {
        this._objMenuCartas = objData;

    }



    listarValoresAmenu() {
        var objData = new FormData();
        objData.append("listarValoresAmenu", this._objMenuCartas.listarValoresAmenu);
        fetch("src/controladores/ctr_menuCartas.php", {
            method: "POST",
            body: objData,
        }).then((response) => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        }).then((response) => {
            // sacar los valores de la respuesta y guardarlos en variables
            var capital = response.data.capital.MontoTotal;
            var gasto = response.data.gastos.MontoGasto;
            var presupuesto = response.data.presupuesto.MontoPresupuesto;
            var ahorro = response.data.ahorros.montoAhorro;
            // remplazar los valores de las cartas
            document.getElementById("cartCapital").innerHTML = capital;
            document.getElementById("cartGasto").innerHTML = gasto;
            document.getElementById("cartPresupuesto").innerHTML = presupuesto;
            document.getElementById("cartAhorro").innerHTML = ahorro;

        });

    }
}

var objData = { listarValoresAmenu: "ok" };
var instance = new cartasMenuUsuario(objData);
instance.listarValoresAmenu();


$(document).ready(function(){
    $(".card-responsive").each(function(){
        // Obtén la ruta del enlace de la carta
        var cartaRuta = $(this).attr("href").trim();

        // Obtén la ruta actual de la aplicación
        var rutaActual = window.location.pathname.trim();

        // Verifica si la carta apunta a la ruta actual
        if (rutaActual.includes(cartaRuta)) {
            $(this).hide();
        }
    });
});

